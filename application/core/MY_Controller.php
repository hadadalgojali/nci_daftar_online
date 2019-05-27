<?php
if(! defined( 'BASEPATH' )) exit( 'No direct script access allowed' );
class MY_controller extends CI_Controller {
	function __construct() {
		parent::__construct();
		$pageSession = $this->pagesession;
		$common = $this->common;
		$result = $this->jsonresult;
		$r=end($this->uri->segments);
		if($r!='getById')
			if($pageSession->cek()==true){
				if(isset( $this->MA )) {
					$tab = $pageSession->getTab();
					$roleList=$pageSession->getRole();
					if(!isset($roleList[$this->MA]) && !isset( $this->WM ))
						$result->privilege()->setMessage('Access Block.')->end();
					$ada = false;
					for($i = 0,$iLen=count($tab); $i < $iLen ; $i++)
						if($tab [$i]->code==$this->MA)
							$ada = true;
					if($ada==false && !isset( $this->WM )) {
						$tab [] = array(
							'code' => $this->MA,
							'role' => $roleList[$this->MA]['role'],
							'text' => $roleList[$this->MA]['text']
						);
						$pageSession->setTab( $tab );
					}
				}
			}else if(isset( $this->MA )) {
				$result->session()->end();
			}
	}
	public function get($param, $allow = true) {
		$result = $this->jsonresult;
		if(isset($_GET[$param])){
			if($_GET[$param]=='null'){
				return null;
			}else{
				return $_GET[$param];
			}
		}else
			if($allow==false)
				return null;
			else
				$result->error()->setMessage("Parameter '".$param."' Not Found")->end();
	}
	public function post($param, $allow = true) {
		$result=$this->jsonresult;
		if(isset($_POST[$param])){
			if($_POST[$param]=='null'){
				return null;
			}else{
				return $_POST[$param];
			}
		}else
			if($allow==false)
				return null;
			else
				$result->error()->setMessage("Parameter '".$param."' Not Found")->end();
	}
}
?>