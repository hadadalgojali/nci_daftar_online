<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Artikel
class Pel6 extends MY_controller {
	public $MA='PEL6';
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
		$ori=$common->find('Artikel',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getJudul();
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
		
		$judul=$this->get('f5');
		
		$entity=$common->getModel('Artikel');
		
		$criteria='';
		$inner=' ';
		
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
		   	default:
		   		$orderBy.='M.judul '.$direction;
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
			$o['f2']=$r->getJudul();
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
		$isi=$this->post('f4');
		
		if($pageType=='ADD'){
			$o=$common->newModel('Artikel');
			$o->setJudul($judul)
				->setIsi($common->htmlEditor($isi,$o->getIsi()))
					->setOleh($common->getEmployee())
				->setTanggal($common->getDateTime())
				->save();
			$result->setMessageSave (' Artikel ', $judul )->end ();
		}else{
			$o=$common->find('Artikel',$pid);
			if ($o != null) {
				$o->setJudul($judul)
					->setIsi($common->htmlEditor($isi,$o->getIsi()))
						->setOleh($common->getEmployee())
				->setTanggal($common->getDateTime())
					->update();
				$result->setMessageEdit (' Artikel ', $judul )->end ();
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
		$res= $common->find('Artikel',$pid);
		if ($res != null) {
			$code=$res->getJudul();
			$description=$res->getIsi();
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$common->htmlEditor(null,$description);
		$result->setMessageDelete(' Artikel ', $code )->end ();
	}
}
