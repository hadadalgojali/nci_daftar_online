<?php

namespace Entity\app\a7;

if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * User Model
 *
 * @Entity
 * @Table(name="app_user")
 *
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class User {
	/**
	 * @Id
	 * @Column(name="user_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="user_code", type="string", length=32, nullable=false)
	 */
	protected $userCode;
	/**
	 * @Column(name="password", type="string", length=32, nullable=false)
	 */
	protected $password;
	/**
	 * @Column(name="first_login_on", type="datetime", nullable=true)
	 */
	protected $firstLogin;
	/**
	 * @Column(name="last_login_on", type="datetime", nullable=true)
	 */
	protected $lastLogin;
	/**
	 * @Column(name="login_flag", type="boolean", nullable=false)
	 */
	protected $loginFlag;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a5\Employee")
	 * @JoinColumn(name="employee_id", referencedColumnName="employee_id" , nullable=false)
	 */
	protected $employee;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a3\Role")
	 * @JoinColumn(name="role_id", referencedColumnName="role_id" , nullable=false)
	 */
	protected $role;
	/**
	 * @Column(name="create_on", type="datetime", nullable=false)
	 */
	protected $createOn;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a12\Tenant")
	 * @JoinColumn(name="tenant_id", referencedColumnName="tenant_id" , nullable=true)
	 */
	protected $tenant;
	/**
	 * @Column(name="active_flag", type="boolean", nullable=false)
	 */
	protected $activeFlag;
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
	/**
	 * @Column(name="lang_default", type="string", length=4, nullable=false)
	 */
	protected $language;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getUserCode() {
		return $this->userCode;
	}
	public function setUserCode($userCode) {
		$this->userCode = $userCode;
		return $this;
	}
	public function getPassword() {
		return $this->password;
	}
	public function setPassword($password) {
		$this->password = $password;
		return $this;
	}
	public function getFirstLogin() {
		return $this->firstLogin;
	}
	public function setFirstLogin($firstLogin) {
		$this->firstLogin = $firstLogin;
		return $this;
	}
	public function getLastLogin() {
		return $this->lastLogin;
	}
	public function setLastLogin($lastLogin) {
		$this->lastLogin = $lastLogin;
		return $this;
	}
	public function getLoginFlag() {
		return $this->loginFlag;
	}
	public function setLoginFlag($loginFlag) {
		$this->loginFlag = $loginFlag;
		return $this;
	}
	public function getEmployee() {
		return $this->employee;
	}
	public function setEmployee($employee) {
		$this->employee = $employee;
		return $this;
	}
	public function getRole() {
		return $this->role;
	}
	public function setRole($role) {
		$this->role = $role;
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
	public function getTenant() {
		return $this->tenant;
	}
	public function setTenant($tenant) {
		$this->tenant = $tenant;
		return $this;
	}
	public function getActiveFlag() {
		return $this->activeFlag;
	}
	public function setActiveFlag($activeFlag) {
		$this->activeFlag = $activeFlag;
		return $this;
	}
	public function getLanguage() {
		return $this->language;
	}
	public function setLanguage($language) {
		$this->language = $language;
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