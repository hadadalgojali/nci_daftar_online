<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Unit Model
 * @Entity
 * @Table(name="rs_unit")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Unit {
	/**
	 * @Id
	 * @Column(name="unit_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="unit_name", type="string", length=32, nullable=false)
	 */
	protected $unitName;
	/**
	 * @Column(name="unit_code", type="string", length=32, nullable=true)
	 */
	protected $unitCode;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge"})
	 * @JoinColumn(name="unit_type", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $unitType;
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
	public function getUnitName() {
		return $this->unitName;
	}
	public function setUnitName($unitName) {
		$this->unitName = $unitName;
		return $this;
	}
	public function getUnitCode() {
		return $this->unitCode;
	}
	public function setUnitCode($unitCode) {
		$this->unitCode = $unitCode;
		return $this;
	}
	public function getUnitType() {
		return $this->unitType;
	}
	public function setUnitType($unitType) {
		$this->unitType = $unitType;
		return $this;
	}
	public function getActiveFlag() {
		return $this->activeFlag;
	}
	public function setActiveFlag($activeFlag) {
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