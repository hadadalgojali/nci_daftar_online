<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
/**
 * District Model
 * @Entity
 * @Table(name="area_district")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class District {
	/**
	 * @Id
	 * @Column(name="district_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="district", type="string", length=32, nullable=false)
	 */
	protected $value;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Province", cascade={"merge"})
	 * @JoinColumn(name="province_id", referencedColumnName="province_id" , nullable=false, onDelete="NO ACTION")
	 */
	protected $parent;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getValue() {
		return $this->value;
	}
	public function setValue($value) {
		$this->value = $value;
		return $this;
	}
	public function getParent() {
		return $this->parent;
	}
	public function setParent($parent) {
		$this->parent = $parent;
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