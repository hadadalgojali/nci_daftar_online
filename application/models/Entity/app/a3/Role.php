<?php
namespace Entity\app\a3;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Role Model
 * @Entity
 * @Table(name="app_role",uniqueConstraints={@UniqueConstraint(name="uk_app_role", columns={"role_code","tenant_id"})})
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Role {
	/**
	 * @Id
	 * @Column(name="role_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="role_code", type="string", length=16, nullable=false)
	 */
	protected $roleCode;
	/**
	 * @Column(name="role_name", type="string", length=64, nullable=false)
	 */
	protected $roleName;
	/**
	 * @Column(name="description", type="string", length=128, nullable=true)
	 */
	protected $description;
	/**
	 * @Column(name="create_on", type="datetime", nullable=false)
	 */
	protected $createOn;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a12\Tenant", cascade={"merge"})
	 * @JoinColumn(name="tenant_id", referencedColumnName="tenant_id" , nullable=true, onDelete="NO ACTION")
	 */
	protected $tenant;
	/**
	 * @Column(name="active_flag", type="boolean", nullable=false)
	 */
	protected $activeFlag;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a5\Employee", cascade={"merge"})
	 * @JoinColumn(name="create_by", referencedColumnName="employee_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $createBy;
	/**
	 * @Column(name="update_on", type="datetime", nullable=false)
	 */
	protected $updateOn;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a5\Employee", cascade={"merge"})
	 * @JoinColumn(name="update_by", referencedColumnName="employee_id" , nullable=false , onDelete="NO ACTION")
	 */
	protected $updateBy;
	/**
	 * @OneToMany(targetEntity="Entity\app\a3\RoleMenu", mappedBy="role" , cascade={"persist","remove","merge"}, orphanRemoval=true)
	 * @OrderBy({"id" = "ASC"})
	 */
	protected $roleMenus;
	
	public function __construct() {
		$this->roleMenus = new ArrayCollection ();
	}
	
	public function addRoleMenus($roleMenus) {
		if (! $this->roleMenus->contains ( $roleMenus )) {
			$this->roleMenus->add ( $roleMenus );
		}
		return $this;
	}
	public function removeRoleMenus($roleMenus) {
		if ($this->roleMenus->contains ( $roleMenus )) {
			$this->roleMenus->removeElement ( $roleMenus );
		}
		return $this;
	}
	public function getRoleMenuList(){
		return $this->roleMenus->toArray ();
	}
	public function getRoleMenus() {
		return $this->roleMenus;
	}
	public function setRoleMenus($roleMenus) {
		$this->roleMenus = $roleMenus;
		return $this;
	}
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getRoleCode() {
		return $this->roleCode;
	}
	public function setRoleCode($roleCode) {
		$this->roleCode = $roleCode;
		return $this;
	}
	public function getRoleName() {
		return $this->roleName;
	}
	public function setRoleName($roleName) {
		$this->roleName = $roleName;
		return $this;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	public function getCreateOn() {
		return $this->createOn;
	}
	public function setCreateOn($createOn) {
		$this->createOn = $createOn;
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
	public function getCreateby() {
		return $this->createBy;
	}
	public function setCreateby($createBy) {
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
	public function getById($id) {
		$ci = & get_instance ();
		$em = $ci->doctrine->em;
		return $em->find ( 'Entity\app\a3\Role', $id );
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