<?php

namespace Entity\app\a8;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Sequence Model
 * @Entity
 * @Table(name="app_sequence")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Sequence {
	/**
	 * @Id
	 * @Column(name="sequence_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="sequence_code", type="string", length=16, nullable=false)
	 */
	protected $sequenceCode;
	/**
	 * @Column(name="sequence_name", type="string", length=64, nullable=false)
	 */
	protected $sequenceName;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a12\Tenant")
	 * @JoinColumn(name="tenant_id", referencedColumnName="tenant_id" , nullable=true)
	 */
	protected $tenant;
	/**
	 * @Column(name="digit", type="integer", length=11, nullable=false)
	 */
	protected $digit;
	/**
	 * @Column(name="last_value", type="decimal", nullable=false)
	 */
	protected $lastValue;
	/**
	 * @Column(name="last_on", type="date", nullable=false)
	 */
	protected $lastOn;
	/**
	 * @Column(name="format", type="string", length=128, nullable=false)
	 */
	protected $format;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge"})
	 * @JoinColumn(name="repeat_type", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $repeatType;
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
	public function getSequenceCode() {
		return $this->sequenceCode;
	}
	public function setSequenceCode($sequenceCode) {
		$this->sequenceCode = $sequenceCode;
		return $this;
	}
	public function getSequenceName() {
		return $this->sequenceName;
	}
	public function setSequenceName($sequenceName) {
		$this->sequenceName = $sequenceName;
		return $this;
	}
	public function getTenant() {
		return $this->tenant;
	}
	public function setTenant($tenant) {
		$this->tenant = $tenant;
		return $this;
	}
	public function getDigit() {
		return $this->digit;
	}
	public function setDigit($digit) {
		$this->digit = $digit;
		return $this;
	}
	public function getFormat() {
		return $this->format;
	}
	public function setFormat($format) {
		$this->format = $format;
		return $this;
	}
	public function getLastValue() {
		return $this->lastValue;
	}
	public function setLastValue($lastValue) {
		$this->lastValue = $lastValue;
		return $this;
	}
	public function getLastOn() {
		return $this->lastOn;
	}
	public function setLastOn($lastOn) {
		$this->lastOn = $lastOn;
		return $this;
	}
	public function getRepeatType() {
		return $this->repeatType;
	}
	public function setRepeatType($repeatType) {
		$this->repeatType = $repeatType;
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