<?php
namespace Entity\app\a9;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * PDFTemplate Model
 * @Entity
 * @Table(name="app_pdf_template")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class PDFTemplate {
	/**
	 * @Id
	 * @Column(name="pdf_template_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="pdf_template_code", type="string", length=16, nullable=false)
	 */
	protected $templateCode;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a12\Tenant")
	 * @JoinColumn(name="tenant_id", referencedColumnName="tenant_id" , nullable=true)
	 */
	protected $tenant;
	/**
	 * @Column(name="pdf_template_name", type="string", length=64, nullable=false)
	 */
	protected $templateName;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge"})
	 * @JoinColumn(name="type", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $type;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge"})
	 * @JoinColumn(name="type_direction", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $direction;
	/**
	 * @Column(name="width", type="integer", length=11, nullable=true)
	 */
	protected $width;
	/**
	 * @Column(name="height", type="integer", length=11, nullable=true)
	 */
	protected $height;
	/**
	 * @Column(name="top_size", type="integer", length=11, nullable=false)
	 */
	protected $top;
	/**
	 * @Column(name="right_size", type="integer", length=11, nullable=false)
	 */
	protected $right;
	/**
	 * @Column(name="bottom_size", type="integer", length=11, nullable=false)
	 */
	protected $bottom;
	/**
	 * @Column(name="left_size", type="integer", length=11, nullable=false)
	 */
	protected $left;
	/**
	 * @Column(name="html", type="text", nullable=false)
	 */
	protected $html;
	/**
	 * @Column(name="create_on", type="datetime", nullable=false)
	 */
	protected $createOn;
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
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getTemplateCode() {
		return $this->templateCode;
	}
	public function setTemplateCode($templateCode) {
		$this->templateCode = $templateCode;
		return $this;
	}
	public function getTenant() {
		return $this->tenant;
	}
	public function setTenant($tenant) {
		$this->tenant = $tenant;
		return $this;
	}
	public function getTemplateName() {
		return $this->templateName;
	}
	public function setTemplateName($templateName) {
		$this->templateName = $templateName;
		return $this;
	}
	public function getType() {
		return $this->type;
	}
	public function setType($type) {
		$this->type = $type;
		return $this;
	}
	public function getDirection() {
		return $this->direction;
	}
	public function setDirection($direction) {
		$this->direction = $direction;
		return $this;
	}
	public function getWidth() {
		return $this->width;
	}
	public function setWidth($width) {
		$this->width = $width;
		return $this;
	}
	public function getHeight() {
		return $this->height;
	}
	public function setHeight($height) {
		$this->height = $height;
		return $this;
	}
	public function getTop() {
		return $this->top;
	}
	public function setTop($top) {
		$this->top = $top;
		return $this;
	}
	public function getRight() {
		return $this->right;
	}
	public function setRight($right) {
		$this->right = $right;
		return $this;
	}
	public function getBottom() {
		return $this->bottom;
	}
	public function setBottom($bottom) {
		$this->bottom = $bottom;
		return $this;
	}
	public function getLeft() {
		return $this->left;
	}
	public function setLeft($left) {
		$this->left = $left;
		return $this;
	}
	public function getHtml() {
		return $this->html;
	}
	public function setHtml($html) {
		$this->html = $html;
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
	public function getActiveFlag() {
		return $this->activeFlag;
	}
	public function setActiveFlag($activeFlag) {
		$this->activeFlag = $activeFlag;
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