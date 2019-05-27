<?php
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
class JsonResult {
	public $result = 'SUCCESS', $message = '', $total = 0, $data = array ();
	public function error() {
		$this->result = 'ERROR';
		return $this;
	}
	public function warning() {
		$this->result = 'WARNING';
		return $this;
	}
	public function privilege() {
		$this->result = 'PRIVILEGE';
		return $this;
	}
	public function session() {
		$this->result = 'SESSION';
		return $this;
	}
	public function setMessage($message) {
		$this->message = $message;
		return $this;
	}
	public function setMessageSave($string1, $string2) {
		$this->message = $string1 . " '" . $string2 . "' Successfully Saved.";
		return $this;
	}
	public function setMessageEdit($string1, $string2) {
		$this->message = $string1 . " '" . $string2 . "' Successfully Update. ";
		return $this;
	}
	public function setMessageDelete($string1, $string2) {
		$this->message = $string1 . " '" . $string2 . "' Successfully Deleted. ";
		return $this;
	}
	public function setMessageExist($string1, $string2) {
		$this->message = $string1 . " '" . $string2 . "' Not Exist.";
		return $this;
	}
	public function setMessageNotExist() {
		$this->message = 'Data Not Found.';
		return $this;
	}
	public function setData($data) {
		$this->data = $data;
		return $this;
	}
	public function setTotal($data) {
		$this->total = $data;
		return $this;
	}
	public function end() {
		if($this->result=='SUCCESS')
			echo json_encode ( $this );
		else{
			if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {
				echo json_encode ( $this );
			}else{
				if($this->message !=''){
					echo $this->message;
				}else{
					echo 'Error.';
				}
			}
		}
		exit ();
	}
}
?>