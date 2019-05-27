<?php

namespace DoctrineProxies\__CG__\Entity\app\a16;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Job extends \Entity\app\a16\Job implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function getId()
    {
        $this->__load();
        return parent::getId();
    }

    public function setId($id)
    {
        $this->__load();
        return parent::setId($id);
    }

    public function getJobCode()
    {
        $this->__load();
        return parent::getJobCode();
    }

    public function setJobCode($jobCode)
    {
        $this->__load();
        return parent::setJobCode($jobCode);
    }

    public function getJobName()
    {
        $this->__load();
        return parent::getJobName();
    }

    public function setJobName($jobName)
    {
        $this->__load();
        return parent::setJobName($jobName);
    }

    public function getCreateOn()
    {
        $this->__load();
        return parent::getCreateOn();
    }

    public function setCreateOn($createOn)
    {
        $this->__load();
        return parent::setCreateOn($createOn);
    }

    public function getCreateBy()
    {
        $this->__load();
        return parent::getCreateBy();
    }

    public function setCreateBy($createBy)
    {
        $this->__load();
        return parent::setCreateBy($createBy);
    }

    public function getUpdateOn()
    {
        $this->__load();
        return parent::getUpdateOn();
    }

    public function setUpdateOn($updateOn)
    {
        $this->__load();
        return parent::setUpdateOn($updateOn);
    }

    public function getUpdateBy()
    {
        $this->__load();
        return parent::getUpdateBy();
    }

    public function setUpdateBy($updateBy)
    {
        $this->__load();
        return parent::setUpdateBy($updateBy);
    }

    public function getTenant()
    {
        $this->__load();
        return parent::getTenant();
    }

    public function setTenant($tenant)
    {
        $this->__load();
        return parent::setTenant($tenant);
    }

    public function getActiveFlag()
    {
        $this->__load();
        return parent::getActiveFlag();
    }

    public function setActiveFlag($activeFlag)
    {
        $this->__load();
        return parent::setActiveFlag($activeFlag);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'jobCode', 'jobName', 'createOn', 'activeFlag', 'updateOn', 'tenant', 'createBy', 'updateBy');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}