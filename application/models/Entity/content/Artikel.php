<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Artikel Model
 * @Entity
 * @Table(name="rs_artikel")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Artikel {
	/**
	 * @Id
	 * @Column(name="artikel_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="judul", type="string",length=64, nullable=true)
	 */
	protected $judul;
	/**
	 * @Column(name="isi", type="text", nullable=true)
	 */
	protected $isi;
	/**
	 * @Column(name="tanggal", type="datetime", nullable=false)
	 */
	protected $tanggal;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a5\Employee", cascade={"merge"})
	 * @JoinColumn(name="oleh", referencedColumnName="employee_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $oleh;
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
	public function getIsi(){
		return $this->isi;
	}
	public function setIsi($isi){
		$this->isi = $isi;
		return $this;
	}
	public function getTanggal(){
		return $this->tanggal;
	}
	public function setTanggal($tanggal){
		$this->tanggal = $tanggal;
		return $this;
	}
	public function getOleh(){
		return $this->oleh;
	}
	public function setOleh($oleh){
		$this->oleh = $oleh;
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