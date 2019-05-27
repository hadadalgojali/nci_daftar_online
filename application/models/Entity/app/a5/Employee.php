<?php
namespace Entity\app\a5;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Employee Entity
 * @Entity
 * @Table(name="app_employee",uniqueConstraints={@UniqueConstraint(name="uk_app_employee", columns={"tenant_id", "id_number"})})
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Employee {
	/**
	 * @Id
	 * @Column(name="employee_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="id_number", type="string", length=32, nullable=false)
	 */
	protected $idNumber;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a12\Tenant", cascade={"merge"})
	 * @JoinColumn(name="tenant_id", referencedColumnName="tenant_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $tenant;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a16\Job", cascade={"merge"})
	 * @JoinColumn(name="job_id", referencedColumnName="job_id" , nullable=true, onDelete="NO ACTION")
	 */
	protected $job;
	/**
	 * @Column(name="first_name", type="string", length=32, nullable=false)
	 */
	protected $firstName;
	/**
	 * @Column(name="second_name", type="string", length=32, nullable=true)
	 */
	protected $secondName;
	/**
	 * @Column(name="last_name", type="string", length=32, nullable=true)
	 */
	protected $lastName;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge"})
	 * @JoinColumn(name="gender", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $gender;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge"})
	 * @JoinColumn(name="religion", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $religion;
	/**
	 * @Column(name="birth_date", type="date", nullable=false)
	 */
	protected $birthDate;
	/**
	 * @Column(name="birth_place", type="string", length=32, nullable=true)
	 */
	protected $birthPlace;
	/**
	 * @Column(name="address", type="string", length=256, nullable=true)
	 */
	protected $address;
	/**
	 * @Column(name="email_address", type="string", length=64, nullable=false)
	 */
	protected $emailAddress;
	/**
	 * @Column(name="phone_number1", type="string", length=16, nullable=true)
	 */
	protected $phoneNumber1;
	/**
	 * @Column(name="phone_number2", type="string", length=16, nullable=true)
	 */
	protected $phoneNumber2;
	/**
	 * @Column(name="fax_number1", type="string", length=16, nullable=true)
	 */
	protected $faxNumber1;
	/**
	 * @Column(name="fax_number2", type="string", length=16, nullable=true)
	 */
	protected $faxNumber2;
	/**
	 * @Column(name="active_flag", type="boolean", nullable=false)
	 */
	protected $activeFlag;
	/**
	 * @Column(name="create_on", type="datetime", nullable=false)
	 */
	protected $createOn;
	/**
	 * @Column(name="foto", type="string", length=32, nullable=true)
	 */
	protected $foto;

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getJob() {
		return $this->job;
	}
	public function setJob($job) {
		$this->job = $job;
		return $this;
	}
	public function getIdNumber() {
		return $this->idNumber;
	}
	public function setIdNumber($idNumber) {
		$this->idNumber = $idNumber;
		return $this;
	}
	public function getTenant() {
		return $this->tenant;
	}
	public function setTenant($tenant) {
		$this->tenant = $tenant;
		return $this;
	}
	public function getFirstName() {
		return $this->firstName;
	}
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
		return $this;
	}
	public function getSecondName() {
		return $this->secondName;
	}
	public function setSecondName($secondName) {
		$this->secondName = $secondName;
		return $this;
	}
	public function getLastName() {
		return $this->lastName;
	}
	public function setLastName($lastName) {
		$this->lastName = $lastName;
		return $this;
	}
	public function getGender() {
		return $this->gender;
	}
	public function setGender($gender) {
		$this->gender = $gender;
		return $this;
	}
	public function getReligion() {
		return $this->religion;
	}
	public function setReligion($religion) {
		$this->religion = $religion;
		return $this;
	}
	public function getBirthDate() {
		return $this->birthDate;
	}
	public function setBirthDate($birthDate) {
		$this->birthDate = $birthDate;
		return $this;
	}
	public function getBirthPlace() {
		return $this->birthPlace;
	}
	public function setBirthPlace($birthPlace) {
		$this->birthPlace = $birthPlace;
		return $this;
	}
	public function getAddress() {
		return $this->address;
	}
	public function setAddress($address) {
		$this->address = $address;
		return $this;
	}
	public function getEmailAddress() {
		return $this->emailAddress;
	}
	public function setEmailAddress($emailAddress) {
		$this->emailAddress = $emailAddress;
		return $this;
	}
	public function getPhoneNumber1() {
		return $this->phoneNumber1;
	}
	public function setPhoneNumber1($phoneNumber1) {
		$this->phoneNumber1 = $phoneNumber1;
		return $this;
	}
	public function getPhoneNumber2() {
		return $this->phoneNumber2;
	}
	public function setPhoneNumber2($phoneNumber2) {
		$this->phoneNumber2 = $phoneNumber2;
		return $this;
	}
	public function getFaxNumber1() {
		return $this->faxNumber1;
	}
	public function setFaxNumber1($faxNumber1) {
		$this->faxNumber1 = $faxNumber1;
		return $this;
	}
	public function getFaxNumber2() {
		return $this->faxNumber2;
	}
	public function setFaxNumber2($faxNumber2) {
		$this->faxNumber2 = $faxNumber2;
		return $this;
	}
	public function getActiveFlag() {
		return $this->activeFlag;
	}
	public function setActiveFlag($activeFlag) {
		$this->activeFlag = $activeFlag;
		return $this;
	}
	public function getCreateOn() {
		return $this->createOn;
	}
	public function setCreateOn($createOn) {
		$this->createOn = $createOn;
		return $this;
	}
	public function getFoto() {
		if($this->foto != null && $this->foto != '')
			return $this->foto;
		else
			return 'NO.GIF';
	}
	public function setFoto($foto) {
		$this->foto = $foto;
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