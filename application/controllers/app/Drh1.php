<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Negara
class Drh1 extends MY_controller {
	public $MA='DRH1';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end();
	}
	public function initSearch(){
		$common = $this->common;
		$result = $this->jsonresult;
		$result->end();
	}
	public function initAdd(){
		$common = $this->common;
		$this->jsonresult->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pid=$this->get('i');
		$ori=$common->find('Country',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getValue();
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
		
		$name=$this->get('f1');
		
		$entity=$common->getModel('Country');
		
		$criteria='';
		$inner='';
		
		if(trim($name)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.value) like upper('%".$name."%')";
		}
		
		if($criteria=='')
			$criteria.=' WHERE ';
		else
			$criteria.=' AND ';
		$criteria.=" M.id !=0";
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
		   	case "f1": 
		   		$orderBy.='M.value '.$direction;
		       	break;
		   	default:
		   		$orderBy.='M.value ASC ';
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
			$o['f1']=$r->getValue();
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
		if($pageType=='ADD'){
			$o=$common->newModel('Country');
			$o->setValue($name)
				->save();
			$result->setMessageSave ('Country Name ', $name )->end ();
		}else{
			$o=$common->find('Country',$pid);
			if ($o != null) {
				$o->setValue($name)
					->update();
				$result->setMessageEdit ('Country Name ', $name )->end ();
			}else
				$result->error()->setMessageNotExist()->end();
		}
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		
		$pid= $this->post('i');
		
		$code='';
		$res= $common->find('Country',$pid);
		if ($res != null) {
			$code=$res->getValue();
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$result->setMessageDelete('Country Name ', $code )->end ();
	}
}
