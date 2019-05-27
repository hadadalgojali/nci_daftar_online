<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Patien Model
 * @Entity
 * @Table(name="rs_patient",uniqueConstraints={@UniqueConstraint(name="uk_rs_visit", columns={"patient_id","kd_unit","entry_date","entry_seq"})})
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Patient {
	/**
	 * @Id
	 * @Column(name="patient_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="patient_code", type="string", length=32, nullable=false)
	 */
	protected $patientCode;
	/**
	 * @Column(name="no_ktp", type="string", length=16, nullable=false)
	 */
	protected $ktp;
	/**
	 * @Column(name="title", type="string", length=16, nullable=true)
	 */
	protected $title;
	/**
	 * @Column(name="name", type="string", length=32, nullable=false)
	 */
	protected $name;
	/**
	 * @Column(name="birth_place", type="string", length=32, nullable=false)
	 */
	protected $birthPlace;
	/**
	 * @Column(name="birth_date", type="date", nullable=false)
	 */
	protected $birthDate;
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
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge"})
	 * @JoinColumn(name="blod", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $blod;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge"})
	 * @JoinColumn(name="education", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $edu;
	/**
	 * @Column(name="address", type="string", length=128, nullable=false)
	 */
	protected $address;
	/**
	 * @Column(name="rt", type="string", length=16, nullable=true)
	 */
	protected $rt;
	/**
	 * @Column(name="rw", type="string", length=16, nullable=true)
	 */
	protected $rw;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Country", cascade={"merge"})
	 * @JoinColumn(name="country_id", referencedColumnName="country_id" , nullable=false, onDelete="SET NULL")
	 */
	protected $country;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Temp", cascade={"merge"})
	 * @JoinColumn(name="country_temp", referencedColumnName="temp_id" , nullable=true, onDelete="SET NULL")
	 */
	protected $countryTemp;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Province", cascade={"merge"})
	 * @JoinColumn(name="province_id", referencedColumnName="province_id" , nullable=false, onDelete="SET NULL")
	 */
	protected $province;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Temp", cascade={"merge"})
	 * @JoinColumn(name="province_temp", referencedColumnName="temp_id" , nullable=true, onDelete="SET NULL")
	 */
	protected $provinceTemp;
	/**
	 * @ManyToOne(targetEntity="Entity\content\District", cascade={"merge"})
	 * @JoinColumn(name="district_id", referencedColumnName="district_id" , nullable=false, onDelete="SET NULL")
	 */
	protected $district;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Temp", cascade={"merge"})
	 * @JoinColumn(name="district_temp", referencedColumnName="temp_id" , nullable=true, onDelete="SET NULL")
	 */
	protected $districtTemp;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Districts", cascade={"merge"})
	 * @JoinColumn(name="districts_id", referencedColumnName="districts_id" , nullable=false, onDelete="SET NULL")
	 */
	protected $districts;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Temp", cascade={"merge"})
	 * @JoinColumn(name="districts_temp", referencedColumnName="temp_id" , nullable=true, onDelete="SET NULL")
	 */
	protected $districtsTemp;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Kelurahan", cascade={"merge"})
	 * @JoinColumn(name="kelurahan_id", referencedColumnName="kelurahan_id" , nullable=false, onDelete="SET NULL")
	 */
	protected $kelurahan;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Temp", cascade={"merge"})
	 * @JoinColumn(name="kelurahan_temp", referencedColumnName="temp_id" , nullable=true, onDelete="SET NULL")
	 */
	protected $kelurahanTemp;
	/**
	 * @Column(name="postal_code", type="string", length=16, nullable=true)
	 */
	protected $postalCode;
	/**
	 * @Column(name="phone_number", type="string", length=16, nullable=false)
	 */
	protected $phoneNumber;
	/**
	 * @OneToMany(targetEntity="Entity\content\Visit", mappedBy="patient" , cascade={"persist","remove","merge"}, orphanRemoval=true)
	 * @OrderBy({"id" = "ASC"})
	 */
	protected $visits;

	public function __construct() {
		$this->visits = new ArrayCollection ();
	}
	public function addVisits($visits) {
		if (! $this->visits->contains ( $visits )) {
			$this->visits->add ( $visits );
		}
		return $this;
	}
	public function removeVisits($visits) {
		if ($this->visits->contains ( $visits )) {
			$this->visits->removeElement ( $visits );
		}
		return $this;
	}
	public function getVistsList(){
		return $this->visits->toArray ();
	}
	public function getVisits() {
		return $this->visits;
	}
	public function setVists($visits) {
		$this->visits = $visits;
		return $this;
	}
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getKtp() {
		return $this->ktp;
	}
	public function setKtp($ktp) {
		$this->ktp = $ktp;
		return $this;
	}
	public function getPostalCode() {
		return $this->postalCode;
	}
	public function setPostalCode($postalCode) {
		$this->postalCode = $postalCode;
		return $this;
	}
	public function getPatientCode() {
		return $this->patientCode;
	}
	public function setPatientCode($patientCode) {
		$this->patientCode = $patientCode;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	public function getBirthPlace() {
		return $this->birthPlace;
	}
	public function setBirthPlace($birthPlace) {
		$this->birthPlace = $birthPlace;
		return $this;
	}
	public function getBirthDate() {
		return $this->birthDate;
	}
	public function setBirthDate($birthDate) {
		$this->birthDate = $birthDate;
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
	public function getBlod() {
		return $this->blod;
	}
	public function setBlod($blod) {
		$this->blod = $blod;
		return $this;
	}
	public function getEdu() {
		return $this->edu;
	}
	public function setEdu($edu) {
		$this->edu = $edu;
		return $this;
	}
	public function getPhoneNumber() {
		return $this->phoneNumber;
	}
	public function setPhoneNumber($phoneNumber) {
		$this->phoneNumber = $phoneNumber;
		return $this;
	}
	public function getAddress() {
		return $this->address;
	}
	public function setAddress($address) {
		$this->address = $address;
		return $this;
	}
	public function getRt() {
		return $this->rt;
	}
	public function setRt($rt) {
		$this->rt = $rt;
		return $this;
	}
	public function getRw() {
		return $this->rw;
	}
	public function setRw($rw) {
		$this->rw = $rw;
		return $this;
	}
	public function getCountry() {
		return $this->country;
	}
	public function setCountry($country) {
		$this->country = $country;
		return $this;
	}
	public function getProvince() {
		return $this->province;
	}
	public function setProvince($province) {
		$this->province = $province;
		return $this;
	}
	public function getDistrict() {
		return $this->district;
	}
	public function setDistrict($district) {
		$this->district = $district;
		return $this;
	}
	public function getDistricts() {
		return $this->districts;
	}
	public function setDistricts($districts) {
		$this->districts = $districts;
		return $this;
	}
	public function getKelurahan() {
		return $this->kelurahan;
	}
	public function setKelurahan($kelurahan) {
		$this->kelurahan = $kelurahan;
		return $this;
	}
	public function getCountryTemp(){
		return $this->countryTemp;
	}
	public function setCountryTemp($countryTemp){
		$this->countryTemp = $countryTemp;
		return $this;
	}
	public function getProvinceTemp(){
		return $this->provinceTemp;
	}
	public function setProvinceTemp($provinceTemp){
		$this->provinceTemp = $provinceTemp;
		return $this;
	}
	public function getDistrictTemp(){
		return $this->districtTemp;
	}
	public function setDistrictTemp($districtTemp){
		$this->districtTemp = $districtTemp;
		return $this;
	}
	public function getDistrictsTemp(){
		return $this->districtsTemp;
	}
	public function setDistrictsTemp($districtsTemp){
		$this->districtsTemp = $districtsTemp;
		return $this;
	}
	public function getKelurahanTemp(){
		return $this->kelurahanTemp;
	}
	public function setKelurahanTemp($kelurahanTemp){
		$this->kelurahanTemp = $kelurahanTemp;
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