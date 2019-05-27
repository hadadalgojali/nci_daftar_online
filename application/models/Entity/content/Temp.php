<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Temp Model
 * @Entity
 * @Table(name="rs_temp")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Temp {
	/**
	 * @Id
	 * @Column(name="temp_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="value", type="string",length=128, nullable=false)
	 */
	protected $value;
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
		return $this;
	}
	public function getValue(){
		return $this->value;
	}
	public function setValue($value){
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