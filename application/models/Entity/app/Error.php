<?php
namespace Entity\app;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Error Entity
 * @Entity
 * @Table(name="app_error")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Error {
	/**
	 * @Id
	 * @Column(name="error_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="error_date", type="datetime", nullable=false)
	 */
	protected $errorDate;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge"})
	 * @JoinColumn(name="error_type", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $errorType;
	/**
	 * @Column(name="message", type="text", nullable=false)
	 */
	protected $message;
	/**
	 * @Column(name="accept", type="boolean", nullable=false)
	 */
	protected $accept;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getErrorDate(){
		return $this->errorDate;
	}
	public function setErrorDate($errorDate){
		$this->errorDate = $errorDate;
		return $this;
	}
	public function getErrorType(){
		return $this->errorType;
	}
	public function setErrorType($errorType){
		$this->errorType = $errorType;
		return $this;
	}
	public function getMessage(){
		return $this->message;
	}
	public function setMessage($message){
		$this->message = $message;
		return $this;
	}
	public function getAccept(){
		return $this->accept;
	}
	public function setAccept($accept){
		$this->accept = $accept;
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