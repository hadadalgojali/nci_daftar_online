<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Get extends MY_controller {
	public function getFile(){
		$common=$this->common;
		$pid=$this->get('pid');
		$file=$common->find('File',$pid);
		echo $file->getFile();
	}

	public function test(){
		print_r($_POST);
	}

	public function getDynamicOption(){
		$text=$this->get('query');
		$type=$this->get('type');
		$common=$this->common;
		
		$arr=array();
		$res=$common->createQuery("SELECT u FROM ".$common->getModel('DynamicOption')." u
		INNER JOIN u.optionType A
		WHERE UPPER(u.value) LIKE UPPER('%".$text."%')
		AND A.optionCode='".$type."'
		 ORDER BY u.value ASC")
				 ->setMaxResults(10)
				 ->getResult();
		for($i=0; $i<count($res) ; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=$country->getValue();
			$o['text']=$country->getValue();
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function getEmployeeList(){
		$common=$this->common;
		$text=$this->get('query');
		$tenant=$this->get('tenant',false);
		$job=$this->get('job',false);
		$innerJoin='';
		$criteria='';
		
		if($tenant != NULL && $tenant !='null'){
			$innerJoin.=' INNER JOIN u.tenant A ';
			$criteria.=' AND A.id='.$tenant;
		}else{
			$criteria.=' AND u.tenant IS NULL';
		}
		
		if($job != null && $job != null){
			$innerJoin.=' INNER JOIN u.job B ';
			$criteria.=' AND B.id='.$job;
		}
		
		$arr=array();
		$res=$common->createQuery("SELECT u FROM ".$common->getModel('Employee')." u
		".$innerJoin."
		WHERE (UPPER(u.firstName) LIKE UPPER('%".$text."%') or UPPER(u.lastName) LIKE UPPER('%".$text."%') or UPPER(u.idNumber) LIKE UPPER('%".$text."%'))
		AND u.activeFlag=true
		".$criteria."
		 ORDER BY u.firstName ASC")
		 ->setMaxResults(10)
		 ->getResult();
		for($i=0; $i<count($res) ; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=$country->getId();
			$o['text']=$country->getIdNumber().' - '.$country->getFirstName()." ".$country->getLastName();
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
}