<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Promo Model
 * @Entity
 * @Table(name="rs_promo")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Promo {
	/**
	 * @Id
	 * @Column(name="id_promo", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="tgl_promo", type="date", nullable=false)
	 */
	protected $tanggalPromo;
	/**
	 * @Column(name="judul", type="string",length=64, nullable=true)
	 */
	protected $judul;
	/**
	 * @Column(name="tgl_berlaku_promo", type="date", nullable=false)
	 */
	protected $tanggalBerlaku;
	/**
	 * @Column(name="isi_promo", type="text", nullable=true)
	 */
	protected $isi;
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
		return $this;
	}
	public function getJudul(){
		return $this->judul;
	}
	public function setJudul($judul){
		$this->judul = $judul;
		return $this;
	}
	public function getTanggalPromo(){
		return $this->tanggalPromo;
	}
	public function setTanggalPromo($tanggalPromo){
		$this->tanggalPromo = $tanggalPromo;
		return $this;
	}
	public function getTanggalBerlaku(){
		return $this->tanggalBerlaku;
	}
	public function setTanggalBerlaku($tanggalBerlaku){
		$this->tanggalBerlaku = $tanggalBerlaku;
		return $this;
	}
	public function getIsi(){
		return $this->isi;
	}
	public function setIsi($isi){
		$this->isi = $isi;
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