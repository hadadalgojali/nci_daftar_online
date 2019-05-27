<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Banner
class A10 extends MY_controller {
	public $MA='A10';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end ();
	}
	public function initSearch(){
		$this->jsonresult->end();
	}
	public function initAdd(){
		$this->jsonresult->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pid=$this->get('i');
		$ori=$common->find('Banner',$pid);
		if($ori != null){
			$data=array();
			$o=array();
			$o['f1']=$ori->getTitle();
			$o['f2']=$ori->getBanner();
			$data['o']=$o;
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
		
		$title=$this->get('f1');
		
		$entity=$common->getModel('Banner');
		
		$criteria="";
		$inner='';
		
		if(trim($title)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.title) like upper('%".$title."%')";
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
			case "f1":
				$orderBy.='M.title '.$direction;
				break;
			default:
				$orderBy.='M.title '.$direction;
				break;
		}
		$total=$common->createQuery("SELECT count(M) AS total FROM ".$entity." M  ".$inner." ".$criteria)->getSingleResult();
		$res=$common->createQuery("SELECT M FROM ".$entity." M ".$inner." ".$criteria." ".$orderBy)
			->setFirstResult($first)
			->setMaxResults($size)
			->getResult();
		$list=array();
		for($i=0,$iLen=count($res); $i<$iLen; $i++){
			$r=$res[$i];
			$o=array();
			$o['i']=$r->getId();
			$o['f1']=$r->getTitle();
			$o['f2']=$r->getBanner();
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total['total'])->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pageType=$this->post('p');
		$pid=$this->post('i');
		
		$title=$this->post('f1');
		$banner=$this->post('f2');
		
		if($pageType=='ADD'){
			$o=$common->newModel('Banner');
			if($banner == null || $banner!='true')
				$o->setBanner($common->uploadToFile($banner,'jpg'));
			$seq=$common->nextSequence('BANNER',null);
			$o->setId($seq['val'])
				->setTitle($title)
				->save();
			$result->setMessageSave (' Judul ', $title )->end ();
		}else{
			$o=$common->find('Banner',$pid);
			if ($o != null) {
				if($banner == null || $banner!='true')
					$o->setBanner($common->uploadToFile($banner,'jpg',$o->getBanner()));
				$o->setTitle($title)
					->update();
				$result->setMessageEdit (' Judul ', $title )->end ();
			}else
				$result->error()->setMessageNotExist()->end();
		}
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		$pid= $this->post('i');
		$code='';
		$res= $common->find('Banner',$pid);
		$foto=null;
		if ($res != null) {
			$foto=$res->getBanner();
			$code=$res->getTitle();
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$common->uploadToFile(null,'jpg',$foto);
		$result->setMessageDelete('Judul', $code )->end ();
	}
}
