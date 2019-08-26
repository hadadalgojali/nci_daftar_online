<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Visit Model
 * @Entity
 * @Table(name="rs_visit",uniqueConstraints={@UniqueConstraint(name="uk_rs_visit", columns={"patient_id","kd_unit","entry_date","entry_seq"})})
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Visit {
	/**
	 * @Id
	 * @Column(name="visit_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Patient", inversedBy="visits", cascade={"merge"})
	 * @JoinColumn(name="patient_id", referencedColumnName="patient_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $patient;	
	 /**
	 * @ManyToOne(targetEntity="Entity\content\Unit", cascade={"merge"})
	 * @JoinColumn(name="unit_id", referencedColumnName="unit_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $unit;
	/**
	 * @Column(name="entry_date", type="date", nullable=false)
	 */
	protected $entryDate;
	/**
	 * @Column(name="entry_seq", type="integer", nullable=false)
	 */
	protected $entrySeq;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a5\Employee", cascade={"merge"})
	 * @JoinColumn(name="dokter_id", referencedColumnName="employee_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $dokter;
	/**
	 * @Column(name="no_antrian", type="integer", length=10, nullable=false)
	 */
	protected $antrian;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Customer", cascade={"merge"})
	 * @JoinColumn(name="customer_id", referencedColumnName="customer_id" , nullable=true, onDelete="NO ACTION")
	 */
	protected $customer;
	/**
	 * @Column(name="status_dilayani", type="boolean", nullable=false)
	 */
	protected $status;	
	/**
	 * @Column(name="kode_sep", type="string", length=32, nullable=true)
	 */
	protected $kodeSep;
	/**
	 * @Column(name="nama_peserta", type="string", length=128, nullable=true)
	 */
	protected $namaPeserta;
	/**
	 * @Column(name="catatan_perubahan", type="string", length=128, nullable=true)
	 */
	protected $catatanPerubahan;
	/**
	 * @Column(name="nomor_peserta", type="string", length=32, nullable=true)
	 */
	protected $nomorPeserta;

	/**
	 * @Column(name="no_rujukan", type="string", length=32, nullable=true)
	 */
	protected $nomorRujukan;

	/**
	 * @Column(name="no_pendaftaran", type="string", length=32, nullable=true)
	 */

	protected $nomorPendaftaran;
	/**
	 * @Column(name="hadir", type="boolean",  nullable=false)
	 */
	protected $hadir;
	/**
	 * @Column(name="baru", type="boolean",  nullable=false)
	 */
	protected $baru;
	/**
	 * @Column(name="pbi", type="boolean",  nullable=true)
	 */
	protected $pbi=false;
	/**
	 * @Column(name="non_pbi", type="boolean",  nullable=true)
	 */
	protected $nonPbi=false;
	/**
	 * @Column(name="keluhan", type="string", length=256, nullable=true)
	 */
	protected $keluhan;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge"})
	 * @JoinColumn(name="jenis_daftar", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $jenisDaftar;
	
	/**
	 * @Column(name="json_bpjs", type="text",  nullable=true)
	 */
	protected $jsonBpjs;
	/**
	 * @Column(name="json_sep", type="text",  nullable=true)
	 */
	protected $jsonSep;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Penyakit", cascade={"merge"})
	 * @JoinColumn(name="penyakit", referencedColumnName="kd_penyakit" , nullable=true, onDelete="NO ACTION")
	 */
	protected $penyakit;
	/**
	 * @Column(name="status", type="integer", length=10, nullable=false)
	 */
	protected $statusData;
	
	/**
	 * @Column(name="kd_rujukan", type="text",  nullable=true)
	 */
	protected $kdRujukan;

	/**
	 * @Column(name="poli_tujuan", type="text",  nullable=true)
	 */
	protected $poliTujuan;

	/**
	 * @Column(name="diagnosa", type="text",  nullable=true)
	 */
	protected $diagnosa;

	/**
	 * @Column(name="faskes_asal", type="text",  nullable=true)
	 */
	protected $faskesAsal;

	/**
	 * @Column(name="kelas", type="text",  nullable=true)
	 */
	protected $kelas;


	/**
	 * @Column(name="kd_kelas", type="text",  nullable=true)
	 */
	protected $kdKelas;

	/**
	 * @Column(name="kd_poli", type="text",  nullable=true)
	 */
	protected $kdPoli;

	/**
	 * @Column(name="kd_diagnosa", type="text",  nullable=true)
	 */
	protected $kdDiagnosa;

	/**
	 * @Column(name="rujukan", type="text",  nullable=true)
	 */
	protected $rujukan;
	
	/**
	 * @Column(name="faskes", type="text", nullable=true)
	 */
	protected $kdFaskes;
	
	/**
	 * @Column(name="tgl_rujukan", type="date", nullable=true)
	 */
	
	protected $tglRujukan;

	
	/**
	 * @Column(name="kd_dpjp", type="text", nullable=true)
	 */
	
	protected $kd_dpjp;
	/**
	* @Column(name="tgl_daftar", type="date", nullable=true)
	*/
	protected $tgl_daftar;
	
	/**
	 * @Column(name="jenis_kunjungan_bpjs", type="integer", nullable=true)
	 */
	
	protected $jenis_kunjungan_bpjs;
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getJsonSep() {
		return $this->jsonSep;
	}
	public function setJsonSep($jsonSep) {
		$this->jsonSep = $jsonSep;
		return $this;
	}
	public function getStatusData() {
		return $this->statusData;
	}
	public function setStatusData($statusData) {
		$this->statusData = $statusData;
		return $this;
	}
	public function getJsonBpjs() {
		return $this->jsonBpjs;
	}
	public function setJsonBpjs($jsonBpjs) {
		$this->jsonBpjs = $jsonBpjs;
		return $this;
	}
	public function getPenyakit() {
		return $this->penyakit;
	}
	public function setPenyakit($penyakit) {
		$this->penyakit = $penyakit;
		return $this;
	}
	public function getPbi() {
		return $this->pbi;
	}
	public function setPbi($pbi) {
		$this->pbi = $pbi;
		return $this;
	}
	public function getNonPbi() {
		return $this->nonPbi;
	}
	public function setNonPbi($nonPbi) {
		$this->nonPbi = $nonPbi;
		return $this;
	}
	public function getPatient() {
		return $this->patient;
	}
	public function setPatient($patient) {
		$this->patient = $patient;
		if (! $patient->getVisits ()->contains ( $this )) {
			$patient->addVisits ( $this );
		}
		return $this;
	}
	public function getUnit() {
		return $this->unit;
	}
	public function setUnit($unit) {
		$this->unit = $unit;
		return $this;
	}
	public function getEntryDate() {
		return $this->entryDate;
	}
	public function setEntryDate($entryDate) {
		$this->entryDate = $entryDate;
		return $this;
	}
	public function getEntrySeq() {
		return $this->entrySeq;
	}
	public function setEntrySeq($entrySeq) {
		$this->entrySeq = $entrySeq;
		return $this;
	}
	public function getCatatanPerubahan() {
		return $this->catatanPerubahan;
	}
	public function setCatatanPerubahan($catatanPerubahan) {
		$this->catatanPerubahan = $catatanPerubahan;
		return $this;
	}
	public function getDokter() {
		return $this->dokter;
	}
	public function setDokter($dokter) {
		$this->dokter = $dokter;
		return $this;
	}
	public function getBaru() {
		return $this->baru;
	}
	public function setBaru($baru) {
		$this->baru = $baru;
		return $this;
	}
	public function getRujukan() {
		return $this->rujukan;
	}
	public function setRujukan($rujukan) {
		$this->rujukan = $rujukan;
		return $this;
	}
	public function getAntrian() {
		return $this->antrian;
	}
	public function setAntrian($antrian) {
		$this->antrian = $antrian;
		return $this;
	}
	public function getCustomer() {
		return $this->customer;
	}
	public function setCustomer($customer) {
		$this->customer = $customer;
		return $this;
	}
	public function getStatus() {
		return $this->status;
	}
	public function setStatus($status) {
		$this->status = $status;
		return $this;
	}
	public function getJenisDaftar() {
		return $this->jenisDaftar;
	}
	public function setJenisDaftar($jenisDaftar) {
		$this->jenisDaftar = $jenisDaftar;
		return $this;
	}
	public function getKodeSep() {
		return $this->kodeSep;
	}
	public function setKodeSep($kodeSep) {
		$this->kodeSep = $kodeSep;
		return $this;
	}
	public function getNamaPeserta() {
		return $this->namaPeserta;
	}
	public function setNamaPeserta($namaPeserta) {
		$this->namaPeserta = $namaPeserta;
		return $this;
	}
	public function getNomorPeserta() {
		return $this->nomorPeserta;
	}
	public function setNomorPeserta($nomorPeserta) {
		$this->nomorPeserta = $nomorPeserta;
		return $this;
	}
	public function getNomorPendaftaran() {
		return $this->nomorPendaftaran;
	}
	public function setNomorPendaftaran($nomorPendaftaran) {
		$this->nomorPendaftaran = $nomorPendaftaran;
		return $this;
	}
	public function getHadir() {
		return $this->hadir;
	}
	public function setHadir($hadir) {
		$this->hadir = $hadir;
		return $this;
	}
	public function getKeluhan() {
		return $this->keluhan;
	}
	public function setKeluhan($keluhan) {
		$this->keluhan = $keluhan;
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

	public function setnoRujukan($nomorRujukan) {
		$this->nomorRujukan = $nomorRujukan;
		return $this;
	}
	public function getnoRujukan() {
		return $this->nomorRujukan;
	}

	public function setkdRujukan($kdRujukan) {
		$this->kdRujukan = $kdRujukan;
		return $this;
	}
	public function getkdRujukan() {
		return $this->kdRujukan;
	}

	public function setPoliTujuan($poliTujuan) {
		$this->poliTujuan = $poliTujuan;
		return $this;
	}
	public function getPoliTujuan() {
		return $this->poliTujuan;
	}

	public function setDiagnosa($diagnosa) {
		$this->diagnosa = $diagnosa;
		return $this;
	}
	public function getDiagnosa() {
		return $this->diagnosa;
	}


	public function setFaskesAsal($faskesAsal) {
		$this->faskesAsal = $faskesAsal;
		return $this;
	}
	public function getFaskesAsal() {
		return $this->faskesAsal;
	}


	public function setKelas($kelas) {
		$this->kelas = $kelas;
		return $this;
	}
	public function getKelas() {
		return $this->kelas;
	}


	public function setkdKelas($kdKelas) {
		$this->kdKelas = $kdKelas;
		return $this;
	}
	public function getkdKelas() {
		return $this->kdKelas;
	}

	public function setkdPoli($kdPoli) {
		$this->kdPoli = $kdPoli;
		return $this;
	}
	public function getkdPoli() {
		return $this->kdPoli;
	}

	public function setkdDiagnosa($kdDiagnosa) {
		$this->kdDiagnosa = $kdDiagnosa;
		return $this;
	}
	public function getkdDiagnosa() {
		return $this->kdDiagnosa;
	}

	public function setkdFaskes($kdFaskes) {
		$this->kdFaskes = $kdFaskes;
		return $this;
	}
	public function getkdFaskes() {
		return $this->kdFaskes;
	}
	
	public function settglRujukan($tglRujukan) {
		$this->tglRujukan = $tglRujukan;
		return $this;
	}
	public function gettglRujukan() {
		return $this->tglRujukan;
	}
	
	public function setkd_dpjp($kd_dpjp) {
		$this->kd_dpjp = $kd_dpjp;
		return $this;
	}
	public function getkd_dpjp() {
		return $this->kd_dpjp;
	}

	
	public function setjenis_kunjungan_bpjs($jenis_kunjungan_bpjs) {
		$this->jenis_kunjungan_bpjs = $jenis_kunjungan_bpjs;
		return $this;
	}
	public function getjenis_kunjungan_bpjs() {
		return $this->jenis_kunjungan_bpjs;
	}

	public function settgl_daftar($tgl_daftar) {
		$this->tgl_daftar = $tgl_daftar;
		return $this;
	}
	public function gettgl_daftar() {
		return $this->tgl_daftar;
	}
	
}