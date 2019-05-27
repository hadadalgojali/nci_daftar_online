<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Kelurahan
class Drh5 extends MY_controller {
	public $MA='DRH5';
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
		$ori=$common->find('Kelurahan',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getParent()->getId();
			$mod['f2']=$ori->getValue();
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
		
		$parent=$this->get('f1');
		$name=$this->get('f2');
		
		$entity=$common->getModel('Kelurahan');
		
		$criteria='';
		$inner='
				INNER JOIN M.parent A ';
		
		if(trim($name)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.value) like upper('%".$name."%')";
		}
		
		if(trim($parent)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(A.value) like upper('%".$parent."%')";
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
		   		$orderBy.='A.value '.$direction;
		       	break;
	       	case "f2":
	       		$orderBy.='M.value '.$direction;
	       		break;
		   	default:
		   		$orderBy.='A.value,M.value ASC ';
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
			$parent=$r->getParent();
			$o['f1']=$parent->getValue().' - '.$parent->getParent()->getValue();
			$o['f2']=$r->getValue();
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total['total'])->end();
	}
	public function getDistricts(){
		$common=$this->common;
		$text=$this->input->get('query');
		$res=$common->createQuery("SELECT u FROM ".$common->getModel('Districts')." u
			WHERE UPPER(u.value) LIKE UPPER('".$text."%') AND u.id !=0
		 	ORDER BY u.value ASC")
			 	->setMaxResults(10)
			 	->getResult();
		$arr=array();
		for($i=0,$iLen=count($res); $i<$iLen ; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=$country->getId();
			$o['text']=$country->getValue().' - '.$country->getParent()->getValue();
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pageType=$this->post('p');
		$pid=$this->post('i');
		
		$parent=$common->find('Districts',$this->post('f1'));
		$name=$this->post('f2');
		if($pageType=='ADD'){
			$o=$common->newModel('Kelurahan');
			$o->setValue($name)
				->setParent($parent)
				->save();
			$result->setMessageSave ('Kelurahan ', $name )->end ();
		}else{
			$o=$common->find('Kelurahan',$pid);
			if ($o != null) {
				$o->setValue($name)
					->update();
				$result->setMessageEdit ('Kelurahan ', $name )->end ();
			}else
				$result->error()->setMessageNotExist()->end();
		}
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		
		$pid= $this->post('i');
		
		$code='';
		$res= $common->find('Kelurahan',$pid);
		if ($res != null) {
			$code=$res->getValue();
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$result->setMessageDelete('Kelurahan ', $code )->end ();
	}
}
