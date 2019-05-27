<?php

namespace DoctrineProxies\__CG__\Entity\app\a12;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Tenant extends \Entity\app\a12\Tenant implements \Doctrine\ORM\Proxy\Proxy
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

    public function getTenantCode()
    {
        $this->__load();
        return parent::getTenantCode();
    }

    public function setTenantCode($tenantCode)
    {
        $this->__load();
        return parent::setTenantCode($tenantCode);
    }

    public function getTenantName()
    {
        $this->__load();
        return parent::getTenantName();
    }

    public function setTenantName($tenantName)
    {
        $this->__load();
        return parent::setTenantName($tenantName);
    }

    public function getTenantAddress()
    {
        $this->__load();
        return parent::getTenantAddress();
    }

    public function setTenantAddress($tenantAddress)
    {
        $this->__load();
        return parent::setTenantAddress($tenantAddress);
    }

    public function getCity()
    {
        $this->__load();
        return parent::getCity();
    }

    public function setCity($city)
    {
        $this->__load();
        return parent::setCity($city);
    }

    public function getCountry()
    {
        $this->__load();
        return parent::getCountry();
    }

    public function setCountry($country)
    {
        $this->__load();
        return parent::setCountry($country);
    }

    public function getPhoneNumber1()
    {
        $this->__load();
        return parent::getPhoneNumber1();
    }

    public function setPhoneNumber1($phoneNumber1)
    {
        $this->__load();
        return parent::setPhoneNumber1($phoneNumber1);
    }

    public function getPhoneNumber2()
    {
        $this->__load();
        return parent::getPhoneNumber2();
    }

    public function setPhoneNumber2($phoneNumber2)
    {
        $this->__load();
        return parent::setPhoneNumber2($phoneNumber2);
    }

    public function getFaxNumber1()
    {
        $this->__load();
        return parent::getFaxNumber1();
    }

    public function setFaxNumber1($faxNumber1)
    {
        $this->__load();
        return parent::setFaxNumber1($faxNumber1);
    }

    public function getFaxNumber2()
    {
        $this->__load();
        return parent::getFaxNumber2();
    }

    public function setFaxNumber2($faxNumber2)
    {
        $this->__load();
        return parent::setFaxNumber2($faxNumber2);
    }

    public function getCoordinate1()
    {
        $this->__load();
        return parent::getCoordinate1();
    }

    public function setCoordinate1($coordinate1)
    {
        $this->__load();
        return parent::setCoordinate1($coordinate1);
    }

    public function getCoordinate2()
    {
        $this->__load();
        return parent::getCoordinate2();
    }

    public function setCoordinate2($coordinate2)
    {
        $this->__load();
        return parent::setCoordinate2($coordinate2);
    }

    public function getEmail()
    {
        $this->__load();
        return parent::getEmail();
    }

    public function setEmail($email)
    {
        $this->__load();
        return parent::setEmail($email);
    }

    public function getFacebookAccount()
    {
        $this->__load();
        return parent::getFacebookAccount();
    }

    public function setFacebookAccount($facebookAccount)
    {
        $this->__load();
        return parent::setFacebookAccount($facebookAccount);
    }

    public function getFacebookName()
    {
        $this->__load();
        return parent::getFacebookName();
    }

    public function setFacebookName($facebookName)
    {
        $this->__load();
        return parent::setFacebookName($facebookName);
    }

    public function getTwitterAccount()
    {
        $this->__load();
        return parent::getTwitterAccount();
    }

    public function setTwitterAccount($twitterAccount)
    {
        $this->__load();
        return parent::setTwitterAccount($twitterAccount);
    }

    public function getTwitterName()
    {
        $this->__load();
        return parent::getTwitterName();
    }

    public function setTwitterName($twitterName)
    {
        $this->__load();
        return parent::setTwitterName($twitterName);
    }

    public function getGoogleAccount()
    {
        $this->__load();
        return parent::getGoogleAccount();
    }

    public function setGoogleAccount($googleAccount)
    {
        $this->__load();
        return parent::setGoogleAccount($googleAccount);
    }

    public function getGoogleName()
    {
        $this->__load();
        return parent::getGoogleName();
    }

    public function setGoogleName($googleName)
    {
        $this->__load();
        return parent::setGoogleName($googleName);
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

    public function getCreateby()
    {
        $this->__load();
        return parent::getCreateby();
    }

    public function setCreateby($createBy)
    {
        $this->__load();
        return parent::setCreateby($createBy);
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


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'tenantCode', 'tenantName', 'tenantAddress', 'city', 'country', 'phoneNumber1', 'phoneNumber2', 'faxNumber1', 'faxNumber2', 'coordinate1', 'coordinate2', 'email', 'facebookAccount', 'facebookName', 'twitterAccount', 'twitterName', 'googleAccount', 'googleName', 'createOn', 'activeFlag', 'updateOn', 'createBy', 'updateBy');
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