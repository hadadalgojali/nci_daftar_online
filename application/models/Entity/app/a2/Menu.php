<?php
namespace Entity\app\a2;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Menu Model
 * @Entity
 * @Table(name="app_menu",uniqueConstraints={@UniqueConstraint(name="uk_app_menu", columns={"menu_code"})})
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Menu {
	/**
	 * @Id
	 * @Column(name="menu_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="menu_code", type="string", length=16, nullable=false)
	 */
	protected $menuCode;
	/**
	 * @Column(name="menu_name", type="string", length=32, nullable=false)
	 */
	protected $menuName;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge"})
	 * @JoinColumn(name="menu_type", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $menuType;
	/**
	 * @Column(name="menu_command", type="string", length=128, nullable=true)
	 */
	protected $menuCommand;
	/**
	 * @Column(name="system_flag", type="boolean", nullable=false)
	 */
	protected $systemFlag;
	/**
	 * @Column(name="create_on", type="datetime", nullable=false)
	 */
	protected $createOn;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a2\Menu", inversedBy="menus", cascade={"merge"})
	 * @JoinColumn(name="parent_id", referencedColumnName="menu_id" , nullable=true, onDelete="NO ACTION")
	 */
	protected $parent;
	/**
	 * @Column(name="active_flag", type="boolean", nullable=false)
	 */
	protected $activeFlag;
	/**
	 * @Column(name="admin_flag", type="boolean", nullable=false)
	 */
	protected $adminFlag;
	/**
	 * @Column(name="window_flag", type="boolean", nullable=false)
	 */
	protected $window;
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
	/**
	 * @OneToMany(targetEntity="Entity\app\a2\Menu", mappedBy="parent" , cascade={"persist","remove","merge"}, orphanRemoval=true)
	 * @OrderBy({"menuCode" = "ASC"})
	 */
	protected $menus;
	public function __construct() {
		$this->menus = new ArrayCollection ();
	}
	public function addMenus($menus) {
		if (! $this->menus->contains ( $menus )) {
			$this->menus->add ( $menus );
		}
		return $this;
	}
	public function removeMenus($menus) {
		if ($this->menus->contains ( $menus )) {
			$this->menus->removeElement ( $menus );
		}
		return $this;
	}
	public function getMenuList() {
		return $this->menus->toArray ();
	}
	public function getMenus() {
		return $this->menus;
	}
	public function setMenus($menus) {
		$this->menus = $menus;
		return $this;
	}
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getMenuCode() {
		return $this->menuCode;
	}
	public function setMenuCode($menuCode) {
		$this->menuCode = $menuCode;
		return $this;
	}
	public function getMenuName() {
		return $this->menuName;
	}
	public function setMenuName($menuName) {
		$this->menuName = $menuName;
		return $this;
	}
	public function getMenuType() {
		return $this->menuType;
	}
	public function setMenuType($menuType) {
		$this->menuType = $menuType;
		return $this;
	}
	public function getMenuCommand() {
		return $this->menuCommand;
	}
	public function setMenuCommand($menuCommand) {
		$this->menuCommand = $menuCommand;
		return $this;
	}
	public function getSystemFlag() {
		return $this->systemFlag;
	}
	public function setSystemFlag($systemFlag) {
		$this->systemFlag = $systemFlag;
		return $this;
	}
	public function getAdminFlag() {
		return $this->adminFlag;
	}
	public function setAdminFlag($adminFlag) {
		$this->adminFlag = $adminFlag;
		return $this;
	}
	public function getCreateOn() {
		return $this->createOn;
	}
	public function setCreateOn($createOn) {
		$this->createOn = $createOn;
		return $this;
	}
	public function getParent() {
		return $this->parent;
	}
	public function setParent($parent) {
		$this->parent = $parent;
		if ($parent != null && ! $parent->getMenus()->contains ( $this )) {
			$parent->addMenus ( $this );
		}
		return $this;
	}
	public function getActiveFlag() {
		return $this->activeFlag;
	}
	public function setActiveFlag($activeFlag) {
		$this->activeFlag = $activeFlag;
		return $this;
	}
	public function getWindow() {
		return $this->window;
	}
	public function setWindow($window) {
		$this->window = $window;
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