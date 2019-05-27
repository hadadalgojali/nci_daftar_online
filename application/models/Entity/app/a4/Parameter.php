<?php

namespace Entity\app\a4;

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Parameter Entity
 *
 * @Entity
 * @Table(name="app_parameter",uniqueConstraints={@UniqueConstraint(name="uk_app_parameter", columns={"parameter_code"})})
 *
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Parameter {
	/**
	 * @Id
	 * @Column(name="parameter_code", type="string", length=16, nullable=false)
	 */
	protected $parameterCode;
	/**
	 * @Column(name="parameter_name", type="string", length=32)
	 */
	protected $parameterName;
	/**
	 * @Column(name="description", type="string", length=64, nullable=true)
	 */
	protected $description;
	/**
	 * @Column(name="resume", type="text", nullable=true)
	 */
	protected $resume;
	/**
	 * @Column(name="active_flag", type="boolean")
	 */
	protected $activeFlag;
	/**
	 * @Column(name="system_flag", type="boolean")
	 */
	protected $systemFlag;
	/**
	 * @Column(name="create_on", type="datetime", nullable=true)
	 */
	protected $createOn;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a5\Employee", cascade={"merge"})
	 * @JoinColumn(name="create_by", referencedColumnName="employee_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $createBy;
	/**
	 * @Column(name="update_on", type="datetime", nullable=true)
	 */
	protected $updateOn;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a5\Employee", cascade={"merge"})
	 * @JoinColumn(name="update_by", referencedColumnName="employee_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $updateBy;
	/**
	 * @OneToMany(targetEntity="ParameterOption", mappedBy="parameter" , cascade={"persist","remove","merge"}, orphanRemoval=true)
	 * @OrderBy({"lineNumber" = "ASC"})
	 */
	protected $parameterOptions;
	public function __construct() {
		$this->parameterOptions = new ArrayCollection ();
	}
	public function addParameterOptions($parameterOptions) {
		if (! $this->parameterOptions->contains ( $parameterOptions )) {
			$this->parameterOptions->add ( $parameterOptions );
		}
		return $this;
	}
	public function removeParameterOptions($parameterOptions) {
		if ($this->parameterOptions->contains ( $parameterOptions )) {
			$this->parameterOptions->removeElement ( $parameterOptions );
		}
		return $this;
	}
	public function getParameterOptionList() {
		return $this->parameterOptions->toArray ();
	}
	public function getParameterOptions() {
		return $this->parameterOptions;
	}
	public function setParameterOptions($parameterOptions) {
		$this->parameterOptions = $parameterOptions;
		return $this;
	}
	public function getParameterCode() {
		return $this->parameterCode;
	}
	public function setParameterCode($parameterCode) {
		$this->parameterCode = $parameterCode;
		return $this;
	}
	public function getParameterName() {
		return $this->parameterName;
	}
	public function setParameterName($parameterName) {
		$this->parameterName = $parameterName;
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
	public function getSystemFlag() {
		return $this->systemFlag;
	}
	public function setSystemFlag($systemFlag) {
		$this->systemFlag = $systemFlag;
		return $this;
	}
	public function getCreateOn() {
		return $this->createOn;
	}
	public function setCreateOn($createOn) {
		$this->createOn = $createOn;
		return $this;
	}
	public function getResume() {
		return $this->resume;
	}
	public function setResume($resume) {
		$this->resume = $resume;
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