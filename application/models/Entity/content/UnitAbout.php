<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * UnitAbout Model
 * @Entity
 * @Table(name="rs_unit_about",uniqueConstraints={@UniqueConstraint(name="uk_unit_about", columns={"unit_id"})})
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class UnitAbout {
	/**
	 * @Id
	 * @Column(name="unit_about_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Unit", cascade={"merge"})
	 * @JoinColumn(name="unit_id", referencedColumnName="unit_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $unit;
	/**
	 * @Column(name="description", type="text", nullable=false)
	 */
	protected $description;
	/**
	 * @Column(name="judul", type="string", length=128, nullable=false)
	 */
	protected $judul;
	/**
	 * @Column(name="phone_number", type="string", length=32, nullable=false)
	 */
	protected $phoneNumber;
	/**
	 * @Column(name="email", type="string", length=128, nullable=false)
	 */
	protected $email;
	/**
	 * @Column(name="information", type="string", length=128, nullable=false)
	 */
	protected $information;
	/**
	 * @Column(name="address", type="string", length=32, nullable=false)
	 */
	protected $address;
	/**
	 * @Column(name="image_name", type="string", length=32, nullable=true)
	 */
	protected $imageName;

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	function getUnit(){
		return $this->unit;
	}
	function setUnit($unit){
		$this->unit = $unit;
		return $this;
	}
	function getDescription(){
		return $this->description;
	}
	function setDescription($description){
		$this->description = $description;
		return $this;
	}
	function getJudul(){
		return $this->judul;
	}
	function setJudul($judul){
		$this->judul = $judul;
		return $this;
	}
	function getPhoneNumber(){
		return $this->phoneNumber;
	}
	function setPhoneNumber($phoneNumber){
		$this->phoneNumber = $phoneNumber;
		return $this;
	}
	function getEmail(){
		return $this->email;
	}
	function setEmail($email){
		$this->email = $email;
		return $this;
	}
	function getImageName(){
		if($this->imageName != null && $this->imageName != '')
			return $this->imageName;
		else
			return 'NO.GIF';
	}
	function setImageName($imageName){
		$this->imageName = $imageName;
		return $this;
	}
	function getInformation(){
		return $this->information;
	}
	function setInformation($information){
		$this->information = $information;
		return $this;
	}
	function getAddress(){
		return $this->address;
	}
	function setAddress($adress){
		$this->address = $adress;
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