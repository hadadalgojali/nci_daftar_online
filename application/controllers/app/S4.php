<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Customer
class S4 extends MY_controller {
	public $MA='S4';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end();
	}
	public function initSearch(){
		$result = $this->jsonresult;
		$result->end();
	}
	public function initAdd(){
		$result = $this->jsonresult;
		$result->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pid=$this->get('i');
		$ori=$common->find('Customer',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getCustomerName();
			$mod['f2']=$ori->getCustomerCode();
			$data['o']=$mod;
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
		
		$namaCostumer=$this->get('f1');
		
		$entity=$common->getModel('Customer');
		
		$criteria='';
		$inner='';
		
		if(trim($namaCostumer)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.customerName) like upper('%".$namaCostumer."%')";
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
		   	case "f1": 
		   		$orderBy.='M.customerName '.$direction;
		       	break;
			case "f2": 
		   		$orderBy.='M.customerCode '.$direction;
		       	break;
		   	default:
		   		$orderBy.='M.customerName ASC ';
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
			$o['f1']=$r->getCustomerName();
			$o['f2']=$r->getCustomerCode();
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total['total'])->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pageType=$this->post('p');
		$pid=$this->post('i');
		
		$name=$this->post('f1');
		$code=$this->post('f2');
		if($pageType=='ADD'){
			$o=$common->newModel('Customer');
			$o->setCustomerName($name)
				->setCustomerCode($code)
				->save();
			$result->setMessageSave (' Customer Name ', $name )->end ();
		}else{
			$o=$common->find('Customer',$pid);
			if ($o != null) {
				$o->setCustomerName($name)
					->setCustomerCode($code)
					->update();
				$result->setMessageEdit (' Customer Name ', $name )->end ();
			}else
				$result->error()->setMessageNotExist()->end();
		}
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		
		$pid= $this->post('i');
		
		$code='';
		$res= $common->find('Customer',$pid);
		if ($res != null) {
			$code=$res->getCustomerName();
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$result->setMessageDelete(' Cutomer Name ', $code )->end ();
	}
}
