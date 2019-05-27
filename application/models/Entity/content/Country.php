<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Country Model
 * @Entity
 * @Table(name="area_country")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Country {
	/**
	 * @Id
	 * @Column(name="country_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="country_name", type="string", length=32, nullable=false)
	 */
	protected $value;
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