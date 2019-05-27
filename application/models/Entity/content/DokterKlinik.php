<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * DokterKlinik Model
 * @Entity
 * @Table(name="rs_dokter_klinik")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class DokterKlinik {
	/**
	 * @Id
	 * @Column(name="dokter_klinik_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Unit", cascade={"merge"})
	 * @JoinColumn(name="unit_id", referencedColumnName="unit_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $unit;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a5\Employee")
	 * @JoinColumn(name="employee_id", referencedColumnName="employee_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $dokter;
	public function getId(){
		return $this->id;
	}
	public function setId($id){
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
	function getDokter(){
		return $this->dokter;
	}
	function setDokter($dokter){
		$this->dokter = $dokter;
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