<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Antrian Model
 * @Entity
 * @Table(name="rs_antrian_poliklinik",uniqueConstraints={@UniqueConstraint(name="uk_rs_antrian_poliklinik", columns={"tgl_masuk","kd_unit","kd_dokter","no_antrian"})})
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Antrian {
	/**
	 * @Id
	 * @Column(name="antrian_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="tgl_masuk", type="date", nullable=false)
	 */
	protected $tglMasuk;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Unit",  cascade={"merge"})
	 * @JoinColumn(name="unit_id", referencedColumnName="unit_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $unit;	
	/**
	 * @ManyToOne(targetEntity="Entity\app\a5\Employee", cascade={"merge"})
	 * @JoinColumn(name="dokter_id", referencedColumnName="employee_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $dokter;
	/**
	 * @Column(name="no_antrian", type="integer", nullable=false)
	 */
	protected $antrian;
	
	
	function getId(){
		return $this->id;
	}
	function setId($id){
		$this->id = $id;
		return $this;
	}
	
	public function getTglMasuk() {
		return $this->tglMasuk;
	}
	public function setTglMasuk($tglMasuk) {
		$this->tglMasuk = $tglMasuk;
		return $this;
	}
	public function getUnit() {
		return $this->unit;
	}
	public function setUnit($unit) {
		$this->unit = $unit;
		return $this;
	}
	public function getDokter() {
		return $this->dokter;
	}
	public function setDokter($dokter) {
		$this->dokter = $dokter;
		return $this;
	}
	public function getAntrian() {
		return $this->antrian;
	}
	public function setAntrian($antrian) {
		$this->antrian = $antrian;
		return $this;
	}
	public function getSystem() {
		return $this->system;
	}
	public function setSystem($system) {
		$this->system = $system;
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