<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Customer Model
 * @Entity
 * @Table(name="rs_customer")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Customer {
	/**
	 * @Id
	 * @Column(name="customer_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="customer_name", type="string", length=128, nullable=false)
	 */
	protected $customerName;
	/**
	 * @Column(name="customer_code", type="string", length=32, nullable=false)
	 */
	protected $customerCode;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getCustomerName() {
		return $this->customerName;
	}
	public function setCustomerName($customerName) {
		$this->customerName = $customerName;
		return $this;
	}
	public function getCustomerCode() {
		return $this->customerCode;
	}
	public function setCustomerCode($customerCode) {
		$this->customerCode = $customerCode;
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