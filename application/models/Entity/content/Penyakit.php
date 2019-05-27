<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Penyakit Model
 * @Entity
 * @Table(name="rs_penyakit")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Penyakit {
	/**
	 * @Id
	 * @Column(name="kd_penyakit", type="string", length=12, nullable=false)
	 */
	protected $kodePenyakit;
	/**
	 * @Column(name="parent", type="string", length=12, nullable=false)
	 */
	protected $parent;
	/**
	 * @Column(name="penyakit", type="string", length=1024, nullable=true)
	 */
	protected $penyakit;
	/**
	 * @Column(name="includes", type="string", length=1024, nullable=true)
	 */
	protected $includes;
	/**
	 * @Column(name="exclude", type="string", length=1024, nullable=true)
	 */
	protected $exclude;
	/**
	 * @Column(name="note", type="string", length=1024, nullable=true)
	 */
	protected $note;
	/**
	 * @Column(name="status", type="boolean", nullable=true)
	 */
	protected $status;
	/**
	 * @Column(name="description", type="string", length=1024, nullable=true)
	 */
	protected $description;
	/**
	 * @Column(name="non_rujukan_flag", type="boolean", nullable=false)
	 */
	protected $nonRujukanFlag;
	
	public function getKodePenyakit() {
		return $this->kodePenyakit;
	}
	public function setKodePenyakit($kodePenyakit) {
		$this->kodePenyakit = $kodePenyakit;
		return $this;
	}
	public function getParent() {
		return $this->parent;
	}
	public function setParent($parent) {
		$this->parent = $parent;
		return $this;
	}
	public function getPenyakit() {
		return $this->penyakit;
	}
	public function setPenyakit($penyakit) {
		$this->penyakit = $penyakit;
		return $this;
	}
	public function getIncludes() {
		return $this->includes;
	}
	public function setIncludes($includes) {
		$this->includes = $includes;
		return $this;
	}
	public function getExclude() {
		return $this->exclude;
	}
	public function setExclude($exclude) {
		$this->exclude = $exclude;
		return $this;
	}
	public function getNote() {
		return $this->note;
	}
	public function setNote($note) {
		$this->note = $note;
		return $this;
	}
	public function getStatus() {
		return $this->status;
	}
	public function setStatus($status) {
		$this->status = $status;
		return $this;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	public function getNonRujukanFlag() {
		return $this->nonRujukanFlag;
	}
	public function setNonRujukanFlag($nonRujukanFlag) {
		$this->nonRujukanFlag = $nonRujukanFlag;
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