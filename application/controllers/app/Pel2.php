<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Promo
class Pel2 extends MY_controller {
	public $MA='PEL2';
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
		$result->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pid=$this->get('i');
		$ori=$common->find('Promo',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getJudul();
			$mod['f2']=$ori->getTanggalPromo()->format('Y-m-d');
			$mod['f3']=$ori->getTanggalBerlaku()->format('Y-m-d');
			$mod['f4']=$ori->getIsi();
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
		
		$startDate=$this->get('f1');
		$endDate=$this->get('f2');
		$startDate1=$this->get('f3');
		$endDate1=$this->get('f4');
		$judul=$this->get('f5');
		
		$entity=$common->getModel('Promo');
		
		$criteria='';
		$inner=' ';
		
		if(trim($startDate)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$dateStart=new DateTime($startDate);
			$criteria.=" M.tanggalPromo>='".$dateStart->format('Y-m-d')."' ";
		}
		if(trim($endDate)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$dateEnd=new DateTime($endDate);
			$criteria.=" M.tanggalPromo<='".$dateEnd->format('Y-m-d')."' ";
		}
		if(trim($startDate1)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$dateStart=new DateTime($startDate1);
			$criteria.=" M.tanggalBerlaku>='".$dateStart->format('Y-m-d')."' ";
		}
		if(trim($endDate1)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$dateEnd=new DateTime($endDate1);
			$criteria.=" M.tanggalBerlaku<='".$dateEnd->format('Y-m-d')."' ";
		}
		if(trim($judul)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.judul) like upper('%".$judul."%')";
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
		   	case "f1": 
		   		$orderBy.='A.tanggalPromo '.$direction;
		       	break;
	       	case "f2":
	       		$orderBy.='M.judul '.$direction;
	       		break;
       		case "f3":
       			$orderBy.='M.tanggalBerlaku '.$direction;
       			break;
		   	default:
		   		$orderBy.='M.tanggalPromo DESC ';
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
			$o['f1']=$r->getTanggalPromo()->format('d M Y');
			$o['f2']=$r->getJudul();
			$o['f3']=$r->getTanggalBerlaku()->format('d M Y');
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total['total'])->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pageType=$this->post('p');
		$pid=$this->post('i');
		
		$judul=$this->post('f1');
		$start=new DateTime($this->post('f2'));
		$end=new DateTime($this->post('f3'));
		$isi=$this->post('f4');
		
		if($pageType=='ADD'){
			$o=$common->newModel('Promo');
			$o->setTanggalPromo($start)
				->setJudul($judul)
				->setTanggalBerlaku($end)
				->setIsi($common->htmlEditor($isi,$o->getIsi()))
				->save();
			$result->setMessageSave (' Promo ', $judul )->end ();
		}else{
			$o=$common->find('Promo',$pid);
			if ($o != null) {
				$o->setTanggalPromo($start)
					->setJudul($judul)
					->setTanggalBerlaku($end)
					->setIsi($common->htmlEditor($isi,$o->getIsi()))
					->update();
				$result->setMessageEdit (' Promo ', $judul )->end ();
			}else
				$result->error()->setMessageNotExist()->end();
		}
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		
		$pid= $this->post('i');
		
		$code='';
		$imageName='';
		$description='';
		$res= $common->find('Promo',$pid);
		if ($res != null) {
			$code=$res->getJudul();
			$description=$res->getIsi();
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$common->htmlEditor(null,$description);
		$result->setMessageDelete(' Promo ', $code )->end ();
	}
}
