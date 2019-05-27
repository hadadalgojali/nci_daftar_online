<?php
namespace Doctrine\ORM;
use Doctrine\Common\Util\ClassUtils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Cache\QueryCacheProfile;
use Doctrine\ORM\Query\QueryException;
abstract class AbstractQuery{
    const HYDRATE_OBJECT = 1;
    const HYDRATE_ARRAY = 2;
    const HYDRATE_SCALAR = 3;
    const HYDRATE_SINGLE_SCALAR = 4;
    const HYDRATE_SIMPLEOBJECT = 5;
    protected $parameters;
    protected $_resultSetMapping;
    protected $_em;
    protected $_hints = array();
    protected $_hydrationMode = self::HYDRATE_OBJECT;
    protected $_queryCacheProfile;
    protected $_expireResultCache = false;
    protected $_hydrationCacheProfile;
    public function __construct(EntityManager $em){
        $this->_em = $em;
        $this->parameters = new ArrayCollection();
    }
    abstract public function getSQL();
    public function getEntityManager() {
        return $this->_em;
    }
    public function free(){
        $this->parameters = new ArrayCollection();
        $this->_hints = array();
    }
    public function getParameters(){
        return $this->parameters;
    }
    public function getParameter($key){
        $filteredParameters = $this->parameters->filter(
            function ($parameter) use ($key){
                return ($key == $parameter->getName());
            }
        );
        return count($filteredParameters) ? $filteredParameters->first() : null;
    }
    public function setParameters($parameters){
        if (is_array($parameters)) {
            $parameterCollection = new ArrayCollection();
            foreach ($parameters as $key => $value) {
                $parameter = new Query\Parameter($key, $value);
                $parameterCollection->add($parameter);
            }
            $parameters = $parameterCollection;
        }
        $this->parameters = $parameters;
        return $this;
    }
    public function setParameter($key, $value, $type = null){
        $filteredParameters = $this->parameters->filter(
            function ($parameter) use ($key){
                return ($key == $parameter->getName());
            }
        );
        if (count($filteredParameters)) {
            $parameter = $filteredParameters->first();
            $parameter->setValue($value, $type);
            return $this;
        }
        $parameter = new Query\Parameter($key, $value, $type);
        $this->parameters->add($parameter);
        return $this;
    }
    public function processParameterValue($value){
        switch (true) {
            case is_array($value):
                foreach ($value as $key => $paramValue) {
                    $paramValue  = $this->processParameterValue($paramValue);
                    $value[$key] = is_array($paramValue) ? $paramValue[key($paramValue)] : $paramValue;
                }
                return $value;
            case is_object($value) && $this->_em->getMetadataFactory()->hasMetadataFor(ClassUtils::getClass($value)):
                return $this->convertObjectParameterToScalarValue($value);

            default:
                return $value;
        }
    }
    private function convertObjectParameterToScalarValue($value){
        $class = $this->_em->getClassMetadata(get_class($value));
        if ($class->isIdentifierComposite) {
            throw new \InvalidArgumentException(
                "Binding an entity with a composite primary key to a query is not supported. " .
                "You should split the parameter into the explicit fields and bind them seperately."
            );
        }
        $values = ($this->_em->getUnitOfWork()->getEntityState($value) === UnitOfWork::STATE_MANAGED)
            ? $this->_em->getUnitOfWork()->getEntityIdentifier($value)
            : $class->getIdentifierValues($value);
        $value = $values[$class->getSingleIdentifierFieldName()];
        if (null === $value) {
            throw new \InvalidArgumentException(
                "Binding entities to query parameters only allowed for entities that have an identifier."
            );
        }
        return $value;
    }
    public function setResultSetMapping(Query\ResultSetMapping $rsm){
        $this->_resultSetMapping = $rsm;
        return $this;
    }
    public function setHydrationCacheProfile(QueryCacheProfile $profile = null)
    {
        if ( ! $profile->getResultCacheDriver()) {
            $resultCacheDriver = $this->_em->getConfiguration()->getHydrationCacheImpl();
            $profile = $profile->setResultCacheDriver($resultCacheDriver);
        }

        $this->_hydrationCacheProfile = $profile;

        return $this;
    }

    /**
     * @return \Doctrine\DBAL\Cache\QueryCacheProfile
     */
    public function getHydrationCacheProfile()
    {
        return $this->_hydrationCacheProfile;
    }

    /**
     * Set a cache profile for the result cache.
     *
     * If no result cache driver is set in the QueryCacheProfile, the default
     * result cache driver is used from the configuration.
     *
     * @param \Doctrine\DBAL\Cache\QueryCacheProfile $profile
     * @return \Doctrine\ORM\AbstractQuery
     */
    public function setResultCacheProfile(QueryCacheProfile $profile = null)
    {
        if ( ! $profile->getResultCacheDriver()) {
            $resultCacheDriver = $this->_em->getConfiguration()->getResultCacheImpl();
            $profile = $profile->setResultCacheDriver($resultCacheDriver);
        }

        $this->_queryCacheProfile = $profile;

        return $this;
    }

    /**
     * Defines a cache driver to be used for caching result sets and implictly enables caching.
     *
     * @param \Doctrine\Common\Cache\Cache $driver Cache driver
     * @return \Doctrine\ORM\AbstractQuery
     */
    public function setResultCacheDriver($resultCacheDriver = null)
    {
        if ($resultCacheDriver !== null && ! ($resultCacheDriver instanceof \Doctrine\Common\Cache\Cache)) {
            throw ORMException::invalidResultCacheDriver();
        }

        $this->_queryCacheProfile = $this->_queryCacheProfile
            ? $this->_queryCacheProfile->setResultCacheDriver($resultCacheDriver)
            : new QueryCacheProfile(0, null, $resultCacheDriver);

        return $this;
    }

    /**
     * Returns the cache driver used for caching result sets.
     *
     * @deprecated
     * @return \Doctrine\Common\Cache\Cache Cache driver
     */
    public function getResultCacheDriver()
    {
        if ($this->_queryCacheProfile && $this->_queryCacheProfile->getResultCacheDriver()) {
            return $this->_queryCacheProfile->getResultCacheDriver();
        }

        return $this->_em->getConfiguration()->getResultCacheImpl();
    }

    /**
     * Set whether or not to cache the results of this query and if so, for
     * how long and which ID to use for the cache entry.
     *
     * @param boolean $bool
     * @param integer $lifetime
     * @param string $resultCacheId
     * @return \Doctrine\ORM\AbstractQuery This query instance.
     */
    public function useResultCache($bool, $lifetime = null, $resultCacheId = null)
    {
        if ($bool) {
            $this->setResultCacheLifetime($lifetime);
            $this->setResultCacheId($resultCacheId);

            return $this;
        }

        $this->_queryCacheProfile = null;

        return $this;
    }

    /**
     * Defines how long the result cache will be active before expire.
     *
     * @param integer $lifetime How long the cache entry is valid.
     * @return \Doctrine\ORM\AbstractQuery This query instance.
     */
    public function setResultCacheLifetime($lifetime)
    {
        $lifetime = ($lifetime !== null) ? (int) $lifetime : 0;

        $this->_queryCacheProfile = $this->_queryCacheProfile
            ? $this->_queryCacheProfile->setLifetime($lifetime)
            : new QueryCacheProfile($lifetime, null, $this->_em->getConfiguration()->getResultCacheImpl());

        return $this;
    }

    /**
     * Retrieves the lifetime of resultset cache.
     *
     * @deprecated
     * @return integer
     */
    public function getResultCacheLifetime()
    {
        return $this->_queryCacheProfile ? $this->_queryCacheProfile->getLifetime() : 0;
    }

    /**
     * Defines if the result cache is active or not.
     *
     * @param boolean $expire Whether or not to force resultset cache expiration.
     * @return \Doctrine\ORM\AbstractQuery This query instance.
     */
    public function expireResultCache($expire = true)
    {
        $this->_expireResultCache = $expire;

        return $this;
    }

    /**
     * Retrieves if the resultset cache is active or not.
     *
     * @return boolean
     */
    public function getExpireResultCache()
    {
        return $this->_expireResultCache;
    }

    /**
     * @return QueryCacheProfile
     */
    public function getQueryCacheProfile()
    {
        return $this->_queryCacheProfile;
    }

    /**
     * Change the default fetch mode of an association for this query.
     *
     * $fetchMode can be one of ClassMetadata::FETCH_EAGER or ClassMetadata::FETCH_LAZY
     *
     * @param  string $class
     * @param  string $assocName
     * @param  int $fetchMode
     * @return AbstractQuery
     */
    public function setFetchMode($class, $assocName, $fetchMode)
    {
        if ($fetchMode !== Mapping\ClassMetadata::FETCH_EAGER) {
            $fetchMode = Mapping\ClassMetadata::FETCH_LAZY;
        }

        $this->_hints['fetchMode'][$class][$assocName] = $fetchMode;

        return $this;
    }

    /**
     * Defines the processing mode to be used during hydration / result set transformation.
     *
     * @param integer $hydrationMode Doctrine processing mode to be used during hydration process.
     *                               One of the Query::HYDRATE_* constants.
     * @return \Doctrine\ORM\AbstractQuery This query instance.
     */
    public function setHydrationMode($hydrationMode)
    {
        $this->_hydrationMode = $hydrationMode;

        return $this;
    }

    /**
     * Gets the hydration mode currently used by the query.
     *
     * @return integer
     */
    public function getHydrationMode()
    {
        return $this->_hydrationMode;
    }

    /**
     * Gets the list of results for the query.
     *
     * Alias for execute(null, $hydrationMode = HYDRATE_OBJECT).
     *
     * @return array
     */
    public function getResult($hydrationMode = self::HYDRATE_OBJECT)
    {
        return $this->execute(null, $hydrationMode);
    }

    /**
     * Gets the array of results for the query.
     *
     * Alias for execute(null, HYDRATE_ARRAY).
     *
     * @return array
     */
    public function getArrayResult()
    {
        return $this->execute(null, self::HYDRATE_ARRAY);
    }

    /**
     * Gets the scalar results for the query.
     *
     * Alias for execute(null, HYDRATE_SCALAR).
     *
     * @return array
     */
    public function getScalarResult()
    {
        return $this->execute(null, self::HYDRATE_SCALAR);
    }

    /**
     * Get exactly one result or null.
     *
     * @throws NonUniqueResultException
     * @param int $hydrationMode
     * @return mixed
     */
    public function getOneOrNullResult($hydrationMode = null)
    {
        $result = $this->execute(null, $hydrationMode);

        if ($this->_hydrationMode !== self::HYDRATE_SINGLE_SCALAR && ! $result) {
            return null;
        }

        if ( ! is_array($result)) {
            return $result;
        }

        if (count($result) > 1) {
            throw new NonUniqueResultException;
        }

        return array_shift($result);
    }

    /**
     * Gets the single result of the query.
     *
     * Enforces the presence as well as the uniqueness of the result.
     *
     * If the result is not unique, a NonUniqueResultException is thrown.
     * If there is no result, a NoResultException is thrown.
     *
     * @param integer $hydrationMode
     * @return mixed
     * @throws NonUniqueResultException If the query result is not unique.
     * @throws NoResultException If the query returned no result.
     */
    public function getSingleResult($hydrationMode = null)
    {
        $result = $this->execute(null, $hydrationMode);

        if ($this->_hydrationMode !== self::HYDRATE_SINGLE_SCALAR && ! $result) {
            throw new NoResultException;
        }

        if ( ! is_array($result)) {
            return $result;
        }

        if (count($result) > 1) {
            throw new NonUniqueResultException;
        }

        return array_shift($result);
    }

    /**
     * Gets the single scalar result of the query.
     *
     * Alias for getSingleResult(HYDRATE_SINGLE_SCALAR).
     *
     * @return mixed
     * @throws QueryException If the query result is not unique.
     */
    public function getSingleScalarResult()
    {
        return $this->getSingleResult(self::HYDRATE_SINGLE_SCALAR);
    }

    /**
     * Sets a query hint. If the hint name is not recognized, it is silently ignored.
     *
     * @param string $name The name of the hint.
     * @param mixed $value The value of the hint.
     * @return \Doctrine\ORM\AbstractQuery
     */
    public function setHint($name, $value)
    {
        $this->_hints[$name] = $value;

        return $this;
    }

    /**
     * Gets the value of a query hint. If the hint name is not recognized, FALSE is returned.
     *
     * @param string $name The name of the hint.
     * @return mixed The value of the hint or FALSE, if the hint name is not recognized.
     */
    public function getHint($name)
    {
        return isset($this->_hints[$name]) ? $this->_hints[$name] : false;
    }

    /**
     * Return the key value map of query hints that are currently set.
     *
     * @return array
     */
    public function getHints()
    {
        return $this->_hints;
    }

    /**
     * Executes the query and returns an IterableResult that can be used to incrementally
     * iterate over the result.
     *
     * @param \Doctrine\Common\Collections\ArrayCollection|array $parameters The query parameters.
     * @param integer $hydrationMode The hydration mode to use.
     * @return \Doctrine\ORM\Internal\Hydration\IterableResult
     */
    public function iterate($parameters = null, $hydrationMode = null)
    {
        if ($hydrationMode !== null) {
            $this->setHydrationMode($hydrationMode);
        }

        if ( ! empty($parameters)) {
            $this->setParameters($parameters);
        }

        $stmt = $this->_doExecute();

        return $this->_em->newHydrator($this->_hydrationMode)->iterate(
            $stmt, $this->_resultSetMapping, $this->_hints
        );
    }

    /**
     * Executes the query.
     *
     * @param \Doctrine\Common\Collections\ArrayCollection|array $parameters Query parameters.
     * @param integer $hydrationMode Processing mode to be used during the hydration process.
     * @return mixed
     */
    public function execute($parameters = null, $hydrationMode = null)
    {
        if ($hydrationMode !== null) {
            $this->setHydrationMode($hydrationMode);
        }

        if ( ! empty($parameters)) {
            $this->setParameters($parameters);
        }

        $setCacheEntry = function() {};

        if ($this->_hydrationCacheProfile !== null) {
            list($cacheKey, $realCacheKey) = $this->getHydrationCacheId();

            $queryCacheProfile = $this->getHydrationCacheProfile();
            $cache             = $queryCacheProfile->getResultCacheDriver();
            $result            = $cache->fetch($cacheKey);

            if (isset($result[$realCacheKey])) {
                return $result[$realCacheKey];
            }

            if ( ! $result) {
                $result = array();
            }

            $setCacheEntry = function($data) use ($cache, $result, $cacheKey, $realCacheKey, $queryCacheProfile) {
                $result[$realCacheKey] = $data;

                $cache->save($cacheKey, $result, $queryCacheProfile->getLifetime());
            };
        }

        $stmt = $this->_doExecute();

        if (is_numeric($stmt)) {
            $setCacheEntry($stmt);

            return $stmt;
        }

        $data = $this->_em->getHydrator($this->_hydrationMode)->hydrateAll(
            $stmt, $this->_resultSetMapping, $this->_hints
        );

        $setCacheEntry($data);

        return $data;
    }

    /**
     * Get the result cache id to use to store the result set cache entry.
     * Will return the configured id if it exists otherwise a hash will be
     * automatically generated for you.
     *
     * @return array ($key, $hash)
     */
    protected function getHydrationCacheId()
    {
        $parameters = array();

        foreach ($this->getParameters() as $parameter) {
            $parameters[$parameter->getName()] = $this->processParameterValue($parameter->getValue());
        }

        $sql                    = $this->getSQL();
        $queryCacheProfile      = $this->getHydrationCacheProfile();
        $hints                  = $this->getHints();
        $hints['hydrationMode'] = $this->getHydrationMode();

        ksort($hints);

        return $queryCacheProfile->generateCacheKeys($sql, $parameters, $hints);
    }

    /**
     * Set the result cache id to use to store the result set cache entry.
     * If this is not explicitly set by the developer then a hash is automatically
     * generated for you.
     *
     * @param string $id
     * @return \Doctrine\ORM\AbstractQuery This query instance.
     */
    public function setResultCacheId($id)
    {
        $this->_queryCacheProfile = $this->_queryCacheProfile
            ? $this->_queryCacheProfile->setCacheKey($id)
            : new QueryCacheProfile(0, $id, $this->_em->getConfiguration()->getResultCacheImpl());

        return $this;
    }

    /**
     * Get the result cache id to use to store the result set cache entry if set.
     *
     * @deprecated
     * @return string
     */
    public function getResultCacheId()
    {
        return $this->_queryCacheProfile ? $this->_queryCacheProfile->getCacheKey() : null;
    }

    /**
     * Executes the query and returns a the resulting Statement object.
     *
     * @return \Doctrine\DBAL\Driver\Statement The executed database statement that holds the results.
     */
    abstract protected function _doExecute();

    /**
     * Cleanup Query resource when clone is called.
     *
     * @return void
     */
    public function __clone()
    {
        $this->parameters = new ArrayCollection();

        $this->_hints = array();
    }
}
