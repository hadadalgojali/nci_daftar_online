<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Dokter Klinik
class S6 extends MY_controller {
	public $MA='S6';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end();
	}
	public function initSearch(){
		$result = $this->jsonresult;
		$result->end();
	}
	public function initAdd(){
		$common = $this->common;
		$result = $this->jsonresult;
		$data=array();
		$units=array();
		$units=$common->createQuery ( "SELECT M FROM ".$common->getModel('Unit')." M  INNER JOIN
				M.unitType A WHERE
				A.optionCode='UNITTYPE_RWJ' ORDER BY M.unitName ASC" )->getResult();
		$oList=array();
		for($i=0,$iLen=count($units); $i<$iLen ; $i++){
			$oO=$units[$i];
			$oM=array();
			$oM['id']=$oO->getId();
			$oM['text']=$oO->getUnitName();
			$oList[]=$oM;
		}
		$data['l']=$oList;
		$result->setData($data)->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pid=$this->get('i');
		$ori=$common->find('DokterKlinik',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getUnit()->getId();
			$dokter=$ori->getDokter();
			$mod['f2']=$dokter->getId();
			$data['o']=$mod;
			$units=array();
			$units=$common->createQuery ( "SELECT M FROM ".$common->getModel('Unit')." M  INNER JOIN
					M.unitType A WHERE
					A.optionCode='UNITTYPE_RWJ' ORDER BY M.unitName ASC" )->getResult();
			$oList=array();
			for($i=0,$iLen=count($units); $i<$iLen ; $i++){
				$oO=$units[$i];
				$oM=array();
				$oM['id']=$oO->getId();
				$oM['text']=$oO->getUnitName();
				$oList[]=$oM;
			}
			$data['l']=$oList;
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
		
		$klinik=$this->get('f1');
		$dokter=$this->get('f2');
		
		$entity=$common->getModel('DokterKlinik');
		$criteria='';
		$inner='
				INNER JOIN M.unit A 
				INNER JOIN M.dokter B ';
		
		if(trim($klinik)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" A.unitName='".$klinik."'";
		}
		if(trim($dokter)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" (upper(B.firstName) like upper('%".$dokter."%') OR upper(B.secondName) like upper('%".$dokter."%') OR upper(B.lastName) like upper('%".$dokter."%'))";
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
		   	case "f1": 
		   		$orderBy.='A.unitName '.$direction;
		       	break;
	       	case "f2":
	       		$orderBy.='B.firstName '.$direction;
	       		break;
		   	default:
		   		$orderBy.='A.unitName ASC ';
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
			$o['f1']=$r->getUnit()->getUnitName();
			$dokter=$r->getDokter();
			$o['f2']='<a href="javascript:loadView(\'App.system.a5.View\','.$dokter->getId().')">'.$dokter->getFirstName()." ".$dokter->getLastName().'</a>';
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total['total'])->end();
	}
	public function getDokter(){
		$em = $this->doctrine->em;
		$common=$this->common;
		$text=$this->input->get('query');
		$unit=$this->input->get('i');
		$arr=array();
		$criteria='';
		if(trim($unit) != ''){
			$res=$common->createQuery("SELECT u FROM ".$common->getModel('Employee')." u
					INNER JOIN u.job C
				WHERE u.id NOT IN (SELECT M.id FROM ".$common->getModel('DokterKlinik')." A INNER JOIN A.dokter M INNER JOIN A.unit B WHERE B.id=".$unit." ) AND (UPPER(u.firstName) LIKE UPPER('%".$text."%') or UPPER(u.lastName) LIKE UPPER('%".$text."%') )
				AND C.jobCode='DOKTER'
		 		ORDER BY u.firstName ASC")
					 ->setMaxResults(10)
					 ->getResult();
			for($i=0,$iLen=count($res); $i<$iLen ; $i++){
				$country=$res[$i];
				$o=array();
				$o['id']=$country->getId();
				$o['text']=$country->getFirstName()." ".$country->getLastName();
				$arr[]=$o;
			}
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pageType=$this->post('p');
		$pid=$this->post('i');
		
		$unit=$common->find('Unit',$this->post('f1'));
		$employee=$common->find('Employee',$this->post('f2'));
		if($pageType=='ADD'){
			$o=$common->newModel('DokterKlinik');
			$o->setUnit($unit)
				->setDokter($employee)
				->save();
			$result->setMessage(' Dokter Klinik Successfully Saved ')->end ();
		}else{
			$o=$common->find('DokterKlinik',$pid);
			if ($o != null) {
				$o->setUnit($unit)
					->setDokter($employee)
					->update();
				$result->setMessage(' Dokter Klinik Successfully Updated ')->end ();
			}else
				$result->error()->setMessageNotExist()->end();
		}
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		
		$pid= $this->post('i');
		
		$res= $common->find('DokterKlinik',$pid);
		if ($res != null) {
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$result->setMessage(' Dokter Klinik Successfully Deleted ')->end ();
	}
}
