<?php

namespace Entity\app\a6;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * SystemProperty Model
 *
 * @Entity
 * @Table(name="app_system_property")
 *
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class SystemProperty {
	/**
	 * @Id
	 * @Column(name="system_property_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="system_property_code", type="string", length=16, nullable=false)
	 */
	protected $propertyCode;
	/**
	 * @Column(name="system_property_name", type="string", length=64, nullable=false)
	 */
	protected $propertyName;
	/**
	 * @Column(name="system_property_value", type="string", length=128, nullable=true)
	 */
	protected $propertyValue;
	/**
	 * @Column(name="description", type="string", length=128, nullable=true)
	 */
	protected $description;
	/**
	 * @Column(name="active_flag", type="boolean", nullable=false)
	 */
	protected $activeFlag;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a12\Tenant")
	 * @JoinColumn(name="tenant_id", referencedColumnName="tenant_id" , nullable=true)
	 */
	protected $tenant;
	/**
	 * @Column(name="create_on", type="datetime", nullable=false)
	 */
	protected $createOn;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a5\Employee")
	 * @JoinColumn(name="create_by", referencedColumnName="employee_id" , nullable=false)
	 */
	protected $createBy;
	/**
	 * @Column(name="update_on", type="datetime", nullable=false)
	 */
	protected $updateOn;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a5\Employee")
	 * @JoinColumn(name="update_by", referencedColumnName="employee_id" , nullable=false)
	 */
	protected $updateBy;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getPropertyCode() {
		return $this->propertyCode;
	}
	public function setPropertyCode($propertyCode) {
		$this->propertyCode = $propertyCode;
		return $this;
	}
	public function getPropertyName() {
		return $this->propertyName;
	}
	public function setPropertyName($propertyName) {
		$this->propertyName = $propertyName;
		return $this;
	}
	public function getPropertyValue() {
		return $this->propertyValue;
	}
	public function setPropertyValue($propertyValue) {
		$this->propertyValue = $propertyValue;
		return $this;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	public function getActiveFlag() {
		return $this->activeFlag;
	}
	public function setActiveFlag($activeFlag) {
		$this->activeFlag = $activeFlag;
		return $this;
	}
	public function getTenant() {
		return $this->tenant;
	}
	public function setTenant($tenant) {
		$this->tenant = $tenant;
		return $this;
	}
	public function getCreateOn() {
		return $this->createOn;
	}
	public function setCreateOn($createOn) {
		$this->createOn = $createOn;
		return $this;
	}
	public function getCreateBy() {
		return $this->createBy;
	}
	public function setCreateBy($createBy) {
		$this->createBy = $createBy;
		return $this;
	}
	public function getUpdateOn() {
		return $this->updateOn;
	}
	public function setUpdateOn($updateOn) {
		$this->updateOn = $updateOn;
		return $this;
	}
	public function getUpdateBy() {
		return $this->updateBy;
	}
	public function setUpdateBy($updateBy) {
		$this->updateBy = $updateBy;
		return $this;
	}
	public function update() {
		$ci = & get_instance ();
		$ci->common->doctrineUpdate ( $this );
	}
	public function save() {
		$ci = & get_instance ();
		$ci->common->doctrineSave ( $this );
	}
	public function delete() {
		$ci = & get_instance ();
		$ci->common->doctrineDelete ( $this );
	}
}