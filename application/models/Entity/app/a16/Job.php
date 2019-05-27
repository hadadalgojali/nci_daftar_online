<?php
namespace Entity\app\a16;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Job Model
 *
 * @Entity
 * @Table(name="app_job")
 *
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Job {
	/**
	 * @Id
	 * @Column(name="job_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="job_code", type="string", length=32, nullable=false)
	 */
	protected $jobCode;
	/**
	 * @Column(name="job_name", type="string", length=32, nullable=false)
	 */
	protected $jobName;
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

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getJobCode() {
		return $this->jobCode;
	}
	public function setJobCode($jobCode) {
		$this->jobCode = $jobCode;
		return $this;
	}
	public function getJobName() {
		return $this->jobName;
	}
	public function setJobName($jobName) {
		$this->jobName = $jobName;
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
}