<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * FaskesDokter Model
 * @Entity
 * @Table(name="rs_faskes_dokter")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class FaskesDokter {
	/**
	 * @Id
	 * @Column(name="faskes_dokter_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Faskes", cascade={"merge"})
	 * @JoinColumn(name="kd_faskes", referencedColumnName="kd_faskes" , nullable=false, onDelete="SET NULL")
	 */
	protected $faskes;
	/**
	 * @Column(name="nama_dokter", type="string", length=64, nullable=false)
	 */
	protected $dokterName;
	/**
	 * @Column(name="active_flag", type="boolean", nullable=false)
	 */
	protected $activeFlag;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getFaskes() {
		return $this->faskes;
	}
	public function setFaskes($faskes) {
		$this->faskes = $faskes;
		return $this;
	}
	public function getDokterName() {
		return $this->dokterName;
	}
	public function setDokterName($dokterName) {
		$this->dokterName = $dokterName;
		return $this;
	}
	public function getActiveFlag() {
		return $this->activeFlag;
	}
	public function setActiveFlag($activeFlag) {
		$this->activeFlag = $activeFlag;
		return $this;
	}
}