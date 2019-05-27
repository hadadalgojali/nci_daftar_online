<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Faskes Model
 * @Entity
 * @Table(name="rs_faskes")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Faskes {
	/**
	 * @Id
	 * @Column(name="kd_faskes", type="string", length=16, nullable=false)
	 */
	protected $faskesCode;
	/**
	 * @Column(name="nama_faskes", type="string", length=64, nullable=false)
	 */
	protected $faskesName;
	/**
	 * @Column(name="alamat", type="string", length=128, nullable=true)
	 */
	protected $alamat;
	/**
	 * @Column(name="telp", type="string", length=16, nullable=true)
	 */
	protected $telp;
	/**
	 * @Column(name="kota", type="string", length=32, nullable=false)
	 */
	protected $kota;
	/**
	 * @Column(name="fax", type="string", length=16, nullable=true)
	 */
	protected $fax;
	/**
	 * @Column(name="email", type="string", length=64, nullable=false)
	 */
	protected $email;
	/**
	 * @Column(name="accept", type="boolean", nullable=false)
	 */
	protected $accept;
	public function getFaskesCode() {
		return $this->faskesCode;
	}
	public function setFaskesCode($faskesCode) {
		$this->faskesCode = $faskesCode;
		return $this;
	}
	public function getFaskesName() {
		return $this->faskesName;
	}
	public function setFaskesName($faskesName) {
		$this->faskesName = $faskesName;
		return $this;
	}
	public function getAlamat() {
		return $this->alamat;
	}
	public function setAlamat($alamat) {
		$this->alamat = $alamat;
		return $this;
	}
	public function getTelp() {
		return $this->telp;
	}
	public function setTelp($telp) {
		$this->telp = $telp;
		return $this;
	}
	public function getFax() {
		return $this->fax;
	}
	public function setFax($fax) {
		$this->fax = $fax;
		return $this;
	}
	public function getKota() {
		return $this->kota;
	}
	public function setKota($kota) {
		$this->kota = $kota;
		return $this;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	public function getAccept() {
		return $this->accept;
	}
	public function setAccept($accept) {
		$this->accept = $accept;
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