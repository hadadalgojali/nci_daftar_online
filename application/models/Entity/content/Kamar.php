<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Kamar Model
 * @Entity
 * @Table(name="rs_kamar")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Kamar {
	/**
	 * @Id
	 * @Column(name="no_kamar", type="integer", length=3,  nullable=false)
	 */
	protected $id;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Unit", cascade={"merge"})
	 * @JoinColumn(name="unit_id", referencedColumnName="unit_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $unit;
	/**
	 * @Column(name="nama_kamar", type="string", length=30, nullable=false)
	 */
	protected $namaKamar;
	/**
	 * @Column(name="jumlah_bed", type="integer", length=3, nullable=false)
	 */
	protected $jumlahBed;
	/**
	 * @Column(name="digunakan", type="integer", length=11, nullable=false)
	 */
	protected $digunakan;
	/**
	 * @Column(name="active_flag", type="boolean", nullable=true)
	 */
	protected $activeFlag;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getUnit() {
		return $this->unit;
	}
	public function setUnit($unit) {
		$this->unit = $unit;
		return $this;
	}
	function getNamaKamar(){
		return $this->namaKamar;
	}
	function setNamaKamar($namaKamar){
		$this->namaKamar = $namaKamar;
		return $this;
	}
	function getJumlahBed(){
		return $this->jumlahBed;
	}
	function setJumlahBed($jumlahBed){
		$this->jumlahBed = $jumlahBed;
		return $this;
	}
	function getDigunakan(){
		return $this->digunakan;
	}
	function setDigunakan($digunakan){
		$this->digunakan = $digunakan;
		return $this;
	}
	function getActiveFlag(){
		return $this->activeFlag;
	}
	function setActiveFlag($activeFlag){
		$this->activeFlag = $activeFlag;
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