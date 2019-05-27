<?php
namespace Entity\app;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * DynamicOption Entity
 *
 * @Entity
 * @Table(name="app_dynamic_option",uniqueConstraints={@UniqueConstraint(name="uk_dynamic_option", columns={"option_type", "value"})})
 *
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class DynamicOption {
	/**
	 * @Id
	 * @Column(name="id_dynamic_option", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge","persist"})
	 * @JoinColumn(name="option_type", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $optionType;
	/**
	 * @Column(name="value", type="string",length=64, nullable=false)
	 */
	protected $value;

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getOptionType(){
		return $this->optionType;
	}
	public function setOptionType($optionType){
		$this->optionType = $optionType;
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