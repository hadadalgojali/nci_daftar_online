<?php

namespace DoctrineProxies\__CG__\Entity\app\a4;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class ParameterOption extends \Entity\app\a4\ParameterOption implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function getOptionCode()
    {
        if ($this->__isInitialized__ === false) {
            return $this->_identifier["optionCode"];
        }
        $this->__load();
        return parent::getOptionCode();
    }

    public function setOptionCode($optionCode)
    {
        $this->__load();
        return parent::setOptionCode($optionCode);
    }

    public function getOptionName()
    {
        $this->__load();
        return parent::getOptionName();
    }

    public function setOptionName($optionName)
    {
        $this->__load();
        return parent::setOptionName($optionName);
    }

    public function getParameter()
    {
        $this->__load();
        return parent::getParameter();
    }

    public function setParameter($parameter)
    {
        $this->__load();
        return parent::setParameter($parameter);
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

    public function getSystemFlag()
    {
        $this->__load();
        return parent::getSystemFlag();
    }

    public function setSystemFlag($systemFlag)
    {
        $this->__load();
        return parent::setSystemFlag($systemFlag);
    }

    public function getLineNumber()
    {
        $this->__load();
        return parent::getLineNumber();
    }

    public function setLineNumber($lineNumber)
    {
        $this->__load();
        return parent::setLineNumber($lineNumber);
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


    public function __sleep()
    {
        return array('__isInitialized__', 'optionCode', 'optionName', 'createOn', 'activeFlag', 'systemFlag', 'lineNumber', 'updateOn', 'parameter', 'updateBy', 'createBy');
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