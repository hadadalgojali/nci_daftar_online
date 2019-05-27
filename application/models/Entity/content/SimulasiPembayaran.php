<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * SimulasiPembayaran Model
 * @Entity
 * @Table(name="rs_simulasi_pembayaran")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class SimulasiPembayaran {
	/**
	 * @Id
	 * @Column(name="simulasi_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Customer",  cascade={"merge"})
	 * @JoinColumn(name="customer_id", referencedColumnName="customer_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $customer;
	/**
	 * @Column(name="deskripsi", type="text", nullable=false)
	 */
	protected $deskripsi;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getCustomer() {
		return $this->customer;
	}
	public function setCustomer($customer) {
		$this->customer = $customer;
		return $this;
	}
	public function getDeskripsi() {
		return $this->deskripsi;
	}
	public function setDeskripsi($deskripsi) {
		$this->deskripsi = $deskripsi;
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