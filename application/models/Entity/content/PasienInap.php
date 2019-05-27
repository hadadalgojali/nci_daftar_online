<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * PasienInap Model
 * @Entity
 * @Table(name="rs_pasien_inap")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class PasienInap {
	/**
	 * @Id
	 * @Column(name="pasien_inap_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Visit", cascade={"merge"})
	 * @JoinColumn(name="id_kunjungan", referencedColumnName="visit_id" , nullable=false, onDelete="SET NULL")
	 */
	protected $visit;
	
	/**
	 * @ManyToOne(targetEntity="Entity\content\Kamar", cascade={"merge"})
	 * @JoinColumn(name="no_kamar", referencedColumnName="no_kamar" , nullable=false, onDelete="SET NULL")
	 */
	protected $kamar;
	/**
	 * @Column(name="kd_spesial", type="integer", length=5, nullable=true)
	 */
	protected $kodeSpesial;
	
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getVisit() {
		return $this->visit;
	}
	public function setVisit($visit) {
		$this->visit = $visit;
		return $this;
	}
	public function getKamar() {
		return $this->kamar;
	}
	public function setKamar($kamar) {
		$this->kamar = $kamar;
		return $this;
	}
	public function getKodeSpesial() {
		return $this->kodeSpesial;
	}
	public function setKodeSpesial($kodeSpesial) {
		$this->kodeSpesial = $kodeSpesial;
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