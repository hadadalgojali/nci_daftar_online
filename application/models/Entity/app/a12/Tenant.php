<?php
namespace Entity\app\a12;
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
/**
 * Tenant Entity
 * @Entity
 * @Table(name="app_tenant",uniqueConstraints={@UniqueConstraint(name="uk_app_tenant", columns={"tenant_code"})})
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Tenant {
	/**
	 * @Id
	 * @Column(name="tenant_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="tenant_code", type="string", length=16, nullable=false)
	 */
	protected $tenantCode;
	/**
	 * @Column(name="tenant_name", type="string", length=32, nullable=false)
	 */
	protected $tenantName;
	/**
	 * @Column(name="tenant_address", type="string", length=256, nullable=true)
	 */
	protected $tenantAddress;
	/**
	 * @Column(name="city", type="string", length=64, nullable=true)
	 */
	protected $city;
	/**
	 * @Column(name="country", type="string", length=64, nullable=true)
	 */
	protected $country;
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
	 * @Column(name="coordinate1", type="string", length=32, nullable=true)
	 */
	protected $coordinate1;
	/**
	 * @Column(name="coordinate2", type="string", length=32, nullable=true)
	 */
	protected $coordinate2;
	/**
	 * @Column(name="email", type="string", length=64, nullable=true)
	 */
	protected $email;
	/**
	 * @Column(name="facebook_account", type="string", length=64, nullable=true)
	 */
	protected $facebookAccount;
	/**
	 * @Column(name="facebook_account_name", type="string", length=64, nullable=true)
	 */
	protected $facebookName;
	/**
	 * @Column(name="twitter_account", type="string", length=64, nullable=true)
	 */
	protected $twitterAccount;
	/**
	 * @Column(name="twitter_account_name", type="string", length=64, nullable=true)
	 */
	protected $twitterName;
	/**
	 * @Column(name="google_account", type="string", length=64, nullable=true)
	 */
	protected $googleAccount;
	/**
	 * @Column(name="google_account_name", type="string", length=64, nullable=true)
	 */
	protected $googleName;
	/**
	 * @Column(name="create_on", type="datetime", nullable=false)
	 */
	protected $createOn;
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
	 * @ManyToOne(targetEntity="Entity\app\a5\Employee", cascade={"merge"})
	 * @JoinColumn(name="update_by", referencedColumnName="employee_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $updateBy;
	/**
	 * @Column(name="update_on", type="datetime", nullable=false)
	 */
	protected $updateOn;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getTenantCode() {
		return $this->tenantCode;
	}
	public function setTenantCode($tenantCode) {
		$this->tenantCode = $tenantCode;
		return $this;
	}
	public function getTenantName() {
		return $this->tenantName;
	}
	public function setTenantName($tenantName) {
		$this->tenantName = $tenantName;
		return $this;
	}
	public function getTenantAddress() {
		return $this->tenantAddress;
	}
	public function setTenantAddress($tenantAddress) {
		$this->tenantAddress = $tenantAddress;
		return $this;
	}
	function getCity(){
		return $this->city;
	}
	function setCity($city){
		$this->city = $city;
		return $this;
	}
	function getCountry(){
		return $this->country;
	}
	function setCountry($country){
		$this->country = $country;
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
	public function getCoordinate1(){
		return $this->coordinate1;
	}
	public function setCoordinate1($coordinate1){
		$this->coordinate1 = $coordinate1;
		return $this;
	}
	public function getCoordinate2(){
		return $this->coordinate2;
	}
	public function setCoordinate2($coordinate2){
		$this->coordinate2 = $coordinate2;
		return $this;
	}
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$this->email = $email;
		return $this;
	}
	public function getFacebookAccount(){
		return $this->facebookAccount;
	}
	public function setFacebookAccount($facebookAccount){
		$this->facebookAccount = $facebookAccount;
		return $this;
	}
	public function getFacebookName(){
		return $this->facebookName;
	}
	public function setFacebookName($facebookName){
		$this->facebookName = $facebookAccount;
		return $this;
	}
	public function getTwitterAccount(){
		return $this->twitterAccount;
	}
	public function setTwitterAccount($twitterAccount){
		$this->twitterAccount = $twitterAccount;
		return $this;
	}
	public function getTwitterName(){
		return $this->twitterName;
	}
	public function setTwitterName($twitterName){
		$this->twitterName = $twitterName;
		return $this;
	}
	public function getGoogleAccount(){
		return $this->googleAccount;
	}
	public function setGoogleAccount($googleAccount){
		$this->googleAccount = $googleAccount;
		return $this;
	}
	public function getGoogleName(){
		return $this->googleName;
	}
	public function setGoogleName($googleName){
		$this->googleName = $googleName;
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
}