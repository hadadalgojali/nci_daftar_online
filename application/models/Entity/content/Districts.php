<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
/**
 * Districts Model
 * @Entity
 * @Table(name="area_districts")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Districts {
	/**
	 * @Id
	 * @Column(name="districts_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="districts", type="string", length=32, nullable=false)
	 */
	protected $value;
	/**
	 * @ManyToOne(targetEntity="Entity\content\District", cascade={"merge"})
	 * @JoinColumn(name="district_id", referencedColumnName="district_id" , nullable=false, onDelete="NO ACTION")
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