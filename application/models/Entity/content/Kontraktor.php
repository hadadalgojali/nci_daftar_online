<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * UnitAbout Model
 * @Entity
 * @Table(name="rs_kontraktor")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Kontraktor {
	/**
	 * @Id
	 * @ManyToOne(targetEntity="Entity\content\Customer", cascade={"merge"})
	 * @JoinColumn(name="customer_id", referencedColumnName="customer_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $customer;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge"})
	 * @JoinColumn(name="jenis_cust", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $jenisCust;
	/**
	 * @Column(name="contact", type="string", length=64, nullable=true)
	 */
	protected $contact;
	
	public function getCustomer(){
		return $this->customer;
	}
	public function setCustomer($customer){
		$this->customer = $customer;
		return $this;
	}
	public function getJenisCust(){
		return $this->jenisCust;
	}
	public function setJenisCust($jenisCust){
		$this->jenisCust = $jenisCust;
		return $this;
	}
	public function getContact(){
		return $this->contact;
	}
	public function setContact($contact){
		$this->contact = $contact;
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