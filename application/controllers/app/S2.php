<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Penyakit
class S2 extends MY_controller {
	public $MA='S2';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end();
	}
	public function initSearch(){
		$common = $this->common;
		$result = $this->jsonresult;
		$data=array();
		$data['l']=$common->getParams('ACTIVE_FLAG');
		$result->setData($data)->end();
	}
	public function initAdd(){
		$result = $this->jsonresult;
		$result->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pid=$this->get('i');
		$ori=$common->find('Penyakit',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getKodePenyakit();
			$mod['f2']=$ori->getParent();
			$mod['f3']=$ori->getPenyakit();
			$mod['f4']=$ori->getNonRujukanFlag();
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
		
		$code=$this->get('f1');
		$parent=$this->get('f2');
		$name=$this->get('f3');
		$rujuk=$this->get('f4');
		
		$entity=' rs_penyakit ';
		
		$criteria='';
		$inner='';
		
		if(trim($code)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(kd_penyakit) like upper('%".$code."%')";
		}
		
		if(trim($parent)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(parent) like upper('%".$parent."%')";
		}
		
		if(trim($name)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(penyakit) like upper('%".$name."%')";
		}
		
		if(trim($rujuk)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			if(trim($rujuk)=='Y')
				$criteria.=" non_rujukan_flag =true";
			else
				$criteria.=" non_rujukan_flag =false";
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
		   	case "f1": 
		   		$orderBy.='kd_penyakit '.$direction;
		       	break;
	       	case "f2":
	       		$orderBy.='parent '.$direction;
	       		break;
       		case "f3":
       			$orderBy.='penyakit '.$direction;
       			break;
		   	default:
		   		$orderBy.='kd_penyakit ASC ';
		       	break;
		}
		
		$total=$common->queryRow('SELECT count(kd_penyakit) AS total FROM '.$entity.' '.$inner.' '.$criteria);
		$res=$common->queryResult('SELECT kd_penyakit,parent,penyakit,non_rujukan_flag 
				FROM '.$entity.' '.$inner.' '.$criteria.' '.$orderBy.' LIMIT '.$size.' OFFSET '.$first);
		$list=array();
		for($i=0,$iLen=count($res); $i<$iLen; $i++){
			$r=$res[$i];
			$o=array();
			$o['f1']=$r->kd_penyakit;
			$o['f2']=$r->parent;
			$o['f3']=$r->penyakit;
			$o['f4']=$r->non_rujukan_flag;
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total->total)->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pageType=$this->post('p');
		$pid=$this->post('i');
		
		$code=$this->post('f1');
		$parent=$this->post('f2');
		$name=$this->post('f3');
		$rujuk=$this->post('f4');
		if($rujuk=='true')
			$rujuk=true;
		else
			$rujuk=false;
		
		if($pageType=='ADD'){
			$o=$common->newModel('Penyakit');
			$o->setPenyakit($name)
				->setKodePenyakit($code)
				->setParent($parent)
				->setNonRujukanFlag($rujuk)
				->save();
			$result->setMessageSave (' Kode Penyakit ', $name )->end ();
		}else{
			$o=$common->find('Penyakit',$pid);
			if ($o != null) {
				$o->setPenyakit($name)
					->setParent($parent)
					->setNonRujukanFlag($rujuk)
					->update();
				$result->setMessageEdit (' Kode Penyakit', $name )->end ();
			}else
				$result->error()->setMessageNotExist()->end();
		}
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		
		$pid= $this->post('i');
		
		$code='';
		$res= $common->find('Penyakit',$pid);
		if ($res != null) {
			$code=$res->getPenyakit();
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$result->setMessageDelete(' Nama Penyakit', $code )->end ();
	}
}
