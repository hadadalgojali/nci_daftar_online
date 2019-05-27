<?php

namespace Entity\app\a3;

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

/**
 * RoleMenu Model
 *
 * @Entity
 * @Table(name="app_role_menu",uniqueConstraints={@UniqueConstraint(name="uk_app_role_menu", columns={"role_id", "menu_id"})})
 *
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class RoleMenu {
	/**
	 * @Id
	 * @Column(name="role_menu_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a3\Role", inversedBy="roleMenus", cascade={"merge"})
	 * @JoinColumn(name="role_id", referencedColumnName="role_id" , nullable=false, onDelete="CASCADE")
	 */
	protected $role;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a2\Menu", cascade={"merge"})
	 * @JoinColumn(name="menu_id", referencedColumnName="menu_id" , nullable=false, onDelete="CASCADE")
	 */
	protected $menu;
	/**
	 * @Column(name="create_on", type="datetime", nullable=false)
	 */
	protected $createOn;
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
	 * @JoinColumn(name="update_by", referencedColumnName="employee_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $updateBy;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getMenu() {
		return $this->menu;
	}
	public function setMenu($menu) {
		$this->menu = $menu;
		return $this;
	}
	public function getRole() {
		return $this->role;
	}
	public function setRole($role) {
		$this->role = $role;
		if (! $role->getRoleMenus ()->contains ( $this )) {
			$role->addRoleMenus ( $this );
		}
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
}