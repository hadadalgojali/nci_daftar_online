<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Poliklinik
class S1 extends MY_controller {
	public $MA='S1';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end();
	}
	public function initSearch(){
		$common = $this->common;
		$result = $this->jsonresult;
		$data=array();
		$data['l']=$common->getParams('UNIT_TYPE');
		$data['l1']=$common->getParams('ACTIVE_FLAG');
		$result->setData($data)->end();
	}
	public function initAdd(){
		$common = $this->common;
		$result = $this->jsonresult;
		$data=array();
		$data['l']=$common->getParams('UNIT_TYPE');
		$result->setData($data)->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pid=$this->get('i');
		$ori=$common->find('Unit',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getUnitType()->getOptionCode();
			$mod['f2']=$ori->getUnitCode();
			$mod['f3']=$ori->getUnitName();
			$mod['f4']=$ori->getActiveFlag();
			$data['o']=$mod;
			$data['l']=$common->getParams('UNIT_TYPE');
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
		
		$type=$this->get('f1');
		$code=$this->get('f2');
		$name=$this->get('f3');
		$active=$this->get('f4');
		
		$entity=$common->getModel('Unit');
		
		$criteria='';
		$inner='
				INNER JOIN M.unitType A ';
		
		if(trim($type)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" A.optionCode='".$type."'";
		}
		
		if(trim($code)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.unitCode) like upper('%".$code."%')";
		}
		
		if(trim($name)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.unitName) like upper('%".$name."%')";
		}
		
		if(trim($active)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			if(trim($active)=='Y')
				$criteria.=" M.activeFlag =true";
			else
				$criteria.=" M.activeFlag =false";
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
		   	case "f1": 
		   		$orderBy.='A.optionName '.$direction;
		       	break;
	       	case "f2":
	       		$orderBy.='M.unitCode '.$direction;
	       		break;
       		case "f3":
       			$orderBy.='M.unitName '.$direction;
       			break;
		   	default:
		   		$orderBy.='M.unitName ASC ';
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
			$o['f1']=$r->getUnitType()->getOptionName();
			$o['f2']=$r->getUnitCode();
			$o['f3']=$r->getUnitName();
			$o['f4']=$r->getActiveFlag();
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total['total'])->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pageType=$this->post('p');
		$pid=$this->post('i');
		
		$type=$common->find('ParameterOption',$this->post('f1'));
		$code=$this->post('f2');
		$name=$this->post('f3');
		$activeFlag=$this->post('f4');
		if($activeFlag=='true')
			$activeFlag=true;
		else
			$activeFlag=false;
		
		if($pageType=='ADD'){
			$o=$common->newModel('Unit');
			$o->setUnitName($name)
				->setUnitCode($code)
				->setUnitType($type)
				->setActiveFlag($activeFlag)
				->save();
			$result->setMessageSave ('Unit Name ', $name )->end ();
		}else{
			$o=$common->find('Unit',$pid);
			if ($o != null) {
				$o->setUnitName($name)
					->setUnitCode($code)
					->setUnitType($type)
					->setActiveFlag($activeFlag)
					->update();
				$result->setMessageEdit ('Unit Name ', $name )->end ();
			}else
				$result->error()->setMessageNotExist()->end();
		}
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		
		$pid= $this->post('i');
		
		$code='';
		$res= $common->find('Unit',$pid);
		if ($res != null) {
			$code=$res->getUnitName();
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$result->setMessageDelete('Unit Name ', $code )->end ();
	}
}
