<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Feedback
class Pel1 extends MY_controller {
	public $MA='PEL1';
	public function getVar() {
		$this->jsonresult->end();
	}
	public function initSearch(){
		$common = $this->common;
		$result = $this->jsonresult;
		$data=array();
		$data['l']=$common->getParams('FEEDBACK_STATUS');
		$result->setData($data)->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pid=$this->get('i');
		$ori=$common->find('Feedback',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getStatus()->getOptionCode();
			$data['o']=$mod;
			$data['l']=$common->getParams('FEEDBACK_STATUS');
			$result->setData($data)->end();
		}else
			$result->error()->setMessageNotExist()->end();
	}
	public function getList(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$first=$this->get('page');
		$size=$this->get('pageSize');
		$direction=$this->get('d',false);
		$sorting=$this->get('s',false);
		
		$startDate=$this->get('f1');
		$endDate=$this->get('f2');
		$email=$this->get('f3');
		$nama=$this->get('f4');
		$telepon=$this->get('f5');
		$deskripsi=$this->get('f6');
		$status=$this->get('f7');
		
		$entity=$common->getModel('Feedback');
		
		$criteria='';
		$inner='
				INNER JOIN M.status A ';
		
		if(trim($startDate)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$dateStart=new DateTime($startDate);
			$criteria.=" M.tanggalFeedback>='".$dateStart->format('Y-m-d')."' ";
		}
		if(trim($endDate)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$dateEnd=new DateTime($endDate);
			$criteria.=" M.tanggalFeedback<='".$dateEnd->format('Y-m-d')."' ";
		}
		if(trim($email)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
					$criteria.=' AND ';
			$criteria.=" upper(M.email) like upper('%".$email."%')";
		}
		if(trim($nama)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.nama) like upper('%".$nama."%')";
		}
		if(trim($telepon)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.telepon) like upper('%".$telepon."%')";
		}
		if(trim($deskripsi)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.description) like upper('%".$deskripsi."%')";
		}
		
		if(trim($status)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" A.optionCode='".$status."'";
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
		   	case "f1": 
		   		$orderBy.='A.tanggal '.$direction;
		       	break;
	       	case "f2":
	       		$orderBy.='M.email '.$direction;
	       		break;
       		case "f3":
       			$orderBy.='M.nama '.$direction;
       			break;
       		case "f4":
       			$orderBy.='M.description '.$direction;
       			break;
       		case "f5":
       			$orderBy.='A.optionName '.$direction;
       			break;
       		case "f6":
       			$orderBy.='M.telepon '.$direction;
       			break;
		   	default:
		   		$orderBy.='M.tanggalFeedback DESC ';
		       	break;
		}
		
		$total=$common->createQuery('SELECT count(M) AS total FROM '.$entity.' M '.$inner.' '.$criteria)->getSingleResult();
		$res=$common->createQuery('SELECT M FROM '.$entity.' M '.$inner.' '.$criteria.' '.$orderBy)
			->setFirstResult($first)
			->setMaxResults($size)
			->getResult();
		$list=array();
		
		for($i=0,$iLen=count($res); $i<$iLen; $i++){
			$r=$res[$i];
			$o=array();
			$o['i']=$r->getId();
			$o['f1']=$r->getTanggalFeedback()->format('d M Y');
			$o['f2']=$r->getEmail();
			$o['f3']=$r->getNama();
			$o['f4']=$r->getDescription();
			$o['f5']=$r->getStatus()->getOptionName();
			$o['f6']=$r->getTelepon();
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total['total'])->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pid=$this->post('i');
		
		$status=$common->find('ParameterOption',$this->post('f1'));
		
		$o=$common->find('Feedback',$pid);
		if ($o != null) {
			$o->setStatus($status)
				->update();
			$result->setMessage('Feedback Succcessfully Updated')->end ();
		}else
			$result->error()->setMessageNotExist()->end();
	}
}
