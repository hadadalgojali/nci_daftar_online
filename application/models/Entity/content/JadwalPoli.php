<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * JadwalPoli Model
 * @Entity
 * @Table(name="rs_jadwal_poli",uniqueConstraints={@UniqueConstraint(name="uk_rs_jadwal_poli", columns={"dokter_id","unit_id","hari","jam"})})
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class JadwalPoli {
	/**
	 * @Id
	 * @Column(name="id_jadwal_poli", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a5\Employee", cascade={"merge"})
	 * @JoinColumn(name="dokter_id", referencedColumnName="employee_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $dokter;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Unit",  cascade={"merge"})
	 * @JoinColumn(name="unit_id", referencedColumnName="unit_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $unit;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge"})
	 * @JoinColumn(name="hari", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $hari;
	/**
	 * @Column(name="jam", type="time", nullable=false)
	 */
	protected $jam;
	/**
	 * @Column(name="max_pelayanan", type="integer", nullable=false)
	 */
	protected $maxAntrian;
	/**
	 * @Column(name="durasi_periksa", type="integer", nullable=false)
	 */
	protected $duration;
	public function getDuration() {
		return $this->duration;
	}
	public function setDuration($duration) {
		$this->duration = $duration;
		return $this;
	}
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getDokter() {
		return $this->dokter;
	}
	public function setDokter($dokter) {
		$this->dokter = $dokter;
		return $this;
	}
	public function getUnit() {
		return $this->unit;
	}
	public function setUnit($unit) {
		$this->unit = $unit;
		return $this;
	}
	public function getHari() {
		return $this->hari;
	}
	public function setHari($hari) {
		$this->hari = $hari;
		return $this;
	}
	public function getJam() {
		return $this->jam;
	}
	public function setJam($jam) {
		$this->jam = $jam;
		return $this;
	}
	public function getMaxAntrian() {
		return $this->maxAntrian;
	}
	public function setMaxAntrian($maxAntrian) {
		$this->maxAntrian = $maxAntrian;
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