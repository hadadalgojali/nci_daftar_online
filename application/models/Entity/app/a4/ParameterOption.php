<?php
namespace Entity\app\a4;
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
/**
 * ParameterObat Entity
 * @Entity
 * @Table(name="app_parameter_option",uniqueConstraints={@UniqueConstraint(name="uk_app_parameter_option", columns={"parameter_code","line_number"})})
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class ParameterOption {
	/**
	 * @Id
	 * @Column(name="option_code", type="string", length=16, nullable=false)
	 */
	protected $optionCode;
	/**
	 * @Column(name="option_name", type="string", length=32, nullable=false)
	 */
	protected $optionName;
	/**
	 * @ManyToOne(targetEntity="Parameter", inversedBy="parameterOptions", cascade={"merge"})
	 * @JoinColumn(name="parameter_code", referencedColumnName="parameter_code", onDelete="CASCADE")
	 */
	protected $parameter;
	/**
	 * @Column(name="create_on", type="datetime", nullable=false)
	 */
	protected $createOn;
	/**
	 * @Column(name="active_flag", type="boolean", nullable=false)
	 */
	protected $activeFlag;
	/**
	 * @Column(name="system_flag", type="boolean", nullable=false)
	 */
	protected $systemFlag;
	/**
	 * @Column(name="line_number", type="integer", nullable=false)
	 */
	protected $lineNumber;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a5\Employee", cascade={"merge"})
	 * @JoinColumn(name="update_by", referencedColumnName="employee_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $updateBy;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a5\Employee", cascade={"merge"})
	 * @JoinColumn(name="create_by", referencedColumnName="employee_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $createBy;
	/**
	 * @Column(name="update_on", type="datetime", nullable=false)
	 */
	protected $updateOn;
	public function getOptionCode() {
		return $this->optionCode;
	}
	public function setOptionCode($optionCode) {
		$this->optionCode = $optionCode;
		return $this;
	}
	public function getOptionName() {
		return $this->optionName;
	}
	public function setOptionName($optionName) {
		$this->optionName = $optionName;
		return $this;
	}
	public function getParameter() {
		return $this->parameter;
	}
	public function setParameter($parameter) {
		$this->parameter = $parameter;
		if (! $parameter->getParameterOptions ()->contains ( $this )) {
			$parameter->addParameterOptions ( $this );
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
	public function getLineNumber() {
		return $this->lineNumber;
	}
	public function setLineNumber($lineNumber) {
		$this->lineNumber = $lineNumber;
		return $this;
	}
	public function getUpdateBy() {
		return $this->updateBy;
	}
	public function setUpdateBy($updateBy) {
		$this->updateBy = $updateBy;
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
}