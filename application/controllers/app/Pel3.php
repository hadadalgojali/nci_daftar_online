<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Jadwal Dokter
class Pel3 extends MY_controller {
	public $MA='PEL3';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end();
	}
	public function initSearch(){
		$common = $this->common;
		$result = $this->jsonresult;
		$data=array();
		$data['l']=$common->getParams('DAY');
		$result->setData($data)->end();
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
		$data['l1']=$common->getParams('DAY');
		$result->setData($data)->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pid=$this->get('i');
		$ori=$common->find('JadwalPoli',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getUnit()->getId();
			$dokter=$ori->getDokter();
			$mod['f2']=$dokter->getId();
			$mod['f3']=$ori->getHari()->getOptionCode();
			$mod['f4']=$ori->getJam()->format('H:i');
			$mod['f5']=$ori->getMaxAntrian();
			$mod['f6']=$ori->getDuration();
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
			$data['l1']=$common->getParams('DAY');
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
		$hari=$this->get('f3');
		$pukul=$this->get('f4');
		$max=$this->get('f5');
		$durasi=$this->get('f6');
		
		$entity=$common->getModel('JadwalPoli');
		$criteria='';
		$inner='
				INNER JOIN M.unit A 
				INNER JOIN M.dokter B 
				INNER JOIN M.hari C ';
		
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
		if(trim($hari)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" C.optionCode='".$hari."'";
		}
		if(trim($pukul)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" M.jam='".$pukul."'";
		}
		if(trim($max)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" M.maxAntrian=".$max;
		}
		if(trim($durasi)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" M.duration=".$durasi;
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
		   	case "f1": 
		   		$orderBy.='A.unitName '.$direction;
		       	break;
	       	case "f2":
	       		$orderBy.='M.unitCode '.$direction;
	       		break;
       		case "f3":
       			$orderBy.='M.unitName '.$direction;
       			break;
		   	default:
		   		$orderBy.='A.unitName,B.firstName,C.lineNumber ASC ';
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
			$o['f3']=$r->getHari()->getOptionName();
			$o['f4']=$r->getJam()->format('H:i');
			$o['f5']=$r->getMaxAntrian();
			$o['f6']=$r->getDuration();
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
			$criteria='AND A.id='.$unit;
		}
		$res=$common->createQuery("SELECT u FROM ".$common->getModel('DokterKlinik')." u
			INNER JOIN u.unit A
			INNER JOIN u.dokter B
			WHERE (UPPER(B.firstName) LIKE UPPER('%".$text."%') or UPPER(B.lastName) LIKE UPPER('%".$text."%') )
			".$criteria."
	 		ORDER BY B.firstName ASC")
				 ->setMaxResults(10)
				 ->getResult();
		for($i=0,$iLen=count($res); $i<$iLen ; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=$country->getDokter()->getId();
			$o['text']=$country->getDokter()->getFirstName()." ".$country->getDokter()->getLastName();
			$arr[]=$o;
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
		$hari=$common->find('ParameterOption',$this->post('f3'));
		$jam=new DateTime($this->post('f4'));
		$max=$this->post('f5');
		$durasi=$this->post('f6');
		if($pageType=='ADD'){
			$o=$common->newModel('JadwalPoli');
			$o->setUnit($unit)
				->setDokter($employee)
				->setHari($hari)
				->setJam($jam)
				->setMaxAntrian($max)
				->setDuration($durasi)
				->save();
			$result->setMessage(' Jadwal Poli Successfully Saved ')->end ();
		}else{
			$o=$common->find('JadwalPoli',$pid);
			if ($o != null) {
				$o->setUnit($unit)
					->setDokter($employee)
					->setHari($hari)
					->setJam($jam)
					->setMaxAntrian($max)
					->setDuration($durasi)
					->update();
				$result->setMessage(' Jadwal Poli Successfully Updated ')->end ();
			}else
				$result->error()->setMessageNotExist()->end();
		}
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		
		$pid= $this->post('i');
		
		$res= $common->find('JadwalPoli',$pid);
		if ($res != null) {
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$result->setMessage(' Jadwal Poli Successfully Deleted ')->end ();
	}
}
