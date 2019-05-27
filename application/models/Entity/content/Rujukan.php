<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Rujukan Model
 * @Entity
 * @Table(name="rs_rujukan")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Rujukan {
	/**
	 * @Id
	 * @Column(name="no_rujukan", type="string", length=12, nullable=false)
	 */
	protected $nomorRujukan;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Patient", cascade={"merge"})
	 * @JoinColumn(name="patient_id", referencedColumnName="patient_id" , nullable=false, onDelete="SET NULL")
	 */
	protected $pasien;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Faskes", cascade={"merge"})
	 * @JoinColumn(name="kd_faskes", referencedColumnName="kd_faskes" , nullable=false, onDelete="SET NULL")
	 */
	protected $faskes;
	/**
	 * @Column(name="tgl_rujuk", type="date", nullable=false)
	 */
	protected $tanggalRujuk;
	/**
	 * @Column(name="faskes_dokter", type="string", length=64, nullable=false)
	 */
	protected $faskesDokter;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge"})
	 * @JoinColumn(name="status", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $status;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Penyakit", cascade={"merge"})
	 * @JoinColumn(name="kd_penyakit", referencedColumnName="kd_penyakit" , nullable=false, onDelete="SET NULL")
	 */
	protected $penyakit;
	/**
	 * @Column(name="tindakan", type="string", length=1024, nullable=true)
	 */
	protected $tindakan;
	/**
	 * @Column(name="obat", type="string", length=1024, nullable=true)
	 */
	protected $obat;
	/**
	 * @Column(name="umur", type="integer", length=3, nullable=true)
	 */
	protected $umur;
	/**
	 * @Column(name="penjamin", type="string", length=32, nullable=true)
	 */
	protected $penjamin;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge"})
	 * @JoinColumn(name="status_verifikasi", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $statusVerifikasi;
	/**
	 * @Column(name="alasan_blok", type="string", length=128, nullable=true)
	 */
	protected $alasanBlok;
	/**
	 * @Column(name="no_bpjs", type="string", length=32, nullable=true)
	 */
	protected $nomorBpjs;
	/**
	 * @Column(name="catatan", type="string", length=1024, nullable=true)
	 */
	protected $catatan;
	/**
	 * @Column(name="penunjang", type="string", length=1024, nullable=true)
	 */
	protected $penunjang;
	/**
	 * @Column(name="rujuk_balik", type="boolean",  nullable=false)
	 */
	protected $rujukBalik;
	/**
	 * @Column(name="delete_flag", type="boolean",  nullable=false)
	 */
	protected $deleteFlag;
	/**
	 * @Column(name="delete_balik_flag", type="boolean",  nullable=false)
	 */
	protected $deleteBalikFlag;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Penyakit", cascade={"merge"})
	 * @JoinColumn(name="diagnosa_rb", referencedColumnName="kd_penyakit" , nullable=true, onDelete="SET NULL")
	 */
	protected $diagnosaRb;
	/**
	 * @Column(name="terapi_rb", type="string", length=128, nullable=true)
	 */
	protected $terapiRb;
	/**
	 * @Column(name="obat_rb", type="string", length=256, nullable=true)
	 */
	protected $obatRb;
	/**
	 * @Column(name="control_date_rb", type="date", nullable=true)
	 */
	protected $controlDateRb;
	/**
	 * @Column(name="other_rb", type="string", length=128, nullable=true)
	 */
	protected $otherRb;
	/**
	 * @Column(name="rwi_rb", type="boolean",  nullable=true)
	 */
	protected $rwiRb;
	/**
	 * @Column(name="konsultasi_rb", type="boolean",  nullable=true)
	 */
	protected $konsultasiRb;
	/**
	 * @Column(name="tgl_rujuk_rb", type="date", nullable=true)
	 */
	protected $tglRujukRb;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a5\Employee", cascade={"merge"})
	 * @JoinColumn(name="dokter_rb", referencedColumnName="employee_id" , nullable=true, onDelete="NO ACTION")
	 */
	protected $dokterRb;
	public function getNomorRujukan() {
		return $this->nomorRujukan;
	}
	public function setNomorRujukan($nomorRujukan) {
		$this->nomorRujukan = $nomorRujukan;
		return $this;
	}
	public function getPasien() {
		return $this->pasien;
	}
	public function setPasien($pasien) {
		$this->pasien = $pasien;
		return $this;
	}
	public function getDeleteFlag() {
		return $this->deleteFlag;
	}
	public function setDeleteFlag($deleteFlag) {
		$this->deleteFlag = $deleteFlag;
		return $this;
	}
	public function getDeleteBalikFlag() {
		return $this->deleteBalikFlag;
	}
	public function setDeleteBalikFlag($deleteBalikFlag) {
		$this->deleteBalikFlag = $deleteBalikFlag;
		return $this;
	}
	public function getAlasanBlok() {
		return $this->alasanBlok;
	}
	public function setAlasanBlok($alasanBlok) {
		$this->alasanBlok = $alasanBlok;
		return $this;
	}
	public function getRujukBalik() {
		return $this->rujukBalik;
	}
	public function setRujukBalik($rujukBalik) {
		$this->rujukBalik = $rujukBalik;
		return $this;
	}
	public function getFaskes() {
		return $this->faskes;
	}
	public function setFaskes($faskes) {
		$this->faskes = $faskes;
		return $this;
	}
	public function getStatusVerifikasi() {
		return $this->statusVerifikasi;
	}
	public function setStatusVerifikasi($statusVerifikasi) {
		$this->statusVerifikasi = $statusVerifikasi;
		return $this;
	}
	public function getTglRujukRb() {
		return $this->tglRujukRb;
	}
	public function setTglRujukRb($tglRujukRb) {
		$this->tglRujukRb = $tglRujukRb;
		return $this;
	}
	public function getKonsultasiRb() {
		return $this->konsultasiRb;
	}
	public function setKonsultasiRb($konsultasiRb) {
		$this->konsultasiRb = $konsultasiRb;
		return $this;
	}
	public function getRwiRb() {
		return $this->rwiRb;
	}
	public function setRwiRb($rwiRb) {
		$this->rwiRb = $rwiRb;
		return $this;
	}
	public function getDokterRb() {
		return $this->dokterRb;
	}
	public function setDokterRb($dokterRb) {
		$this->dokterRb = $dokterRb;
		return $this;
	}
	public function getOtherRb() {
		return $this->otherRb;
	}
	public function setOtherRb($otherRb) {
		$this->otherRb = $otherRb;
		return $this;
	}
	public function getControlDateRb() {
		return $this->controlDateRb;
	}
	public function setControlDateRb($controlDateRb) {
		$this->controlDateRb = $controlDateRb;
		return $this;
	}
	public function getObatRb() {
		return $this->obatRb;
	}
	public function setObatRb($obatRb) {
		$this->obatRb = $obatRb;
		return $this;
	}
	public function getTerapiRb() {
		return $this->terapiRb;
	}
	public function setTerapiRb($terapiRb) {
		$this->terapiRb = $terapiRb;
		return $this;
	}
	public function getDiagnosaRb() {
		return $this->diagnosaRb;
	}
	public function setDiagnosaRb($diagnosaRb) {
		$this->diagnosaRb = $diagnosaRb;
		return $this;
	}
	public function getTanggalRujuk() {
		return $this->tanggalRujuk;
	}
	public function setTanggalRujuk($tanggalRujuk) {
		$this->tanggalRujuk = $tanggalRujuk;
		return $this;
	}
	public function getFaskesDokter() {
		return $this->faskesDokter;
	}
	public function setFaskesDokter($faskesDokter) {
		$this->faskesDokter = $faskesDokter;
		return $this;
	}
	public function getStatus(){
		return $this->status;
	}
	public function setStatus($status){
		$this->status=$status;
		return $this;
	}
	public function getPenyakit() {
		return $this->penyakit;
	}
	public function setPenyakit($penyakit) {
		$this->penyakit = $penyakit;
		return $this;
	}
	public function getTindakan() {
		return $this->tindakan;
	}
	public function setTindakan($tindakan) {
		$this->tindakan = $tindakan;
		return $this;
	}
	public function getObat() {
		return $this->obat;
	}
	public function setObat($obat) {
		$this->obat = $obat;
		return $this;
	}
	public function getUmur() {
		return $this->umur;
	}
	public function setUmur($umur) {
		$this->umur = $umur;
		return $this;
	}
	public function getPenjamin() {
		return $this->penjamin;
	}
	public function setPenjamin($penjamin) {
		$this->penjamin = $penjamin;
		return $this;
	}
	public function getNomorBpjs() {
		return $this->nomorBpjs;
	}
	public function setNomorBpjs($nomorBpjs) {
		$this->nomorBpjs = $nomorBpjs;
		return $this;
	}
	public function getCatatan() {
		return $this->catatan;
	}
	public function setCatatan($catatan) {
		$this->catatan = $catatan;
		return $this;
	}
	public function getPenunjang() {
		return $this->penunjang;
	}
	public function setPenunjang($penunjang) {
		$this->penunjang = $penunjang;
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