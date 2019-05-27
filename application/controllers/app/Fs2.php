<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Faskes Account
class Fs2 extends MY_controller {
	public $MA='FS2';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end();
	}
	public function initSearch(){
		$result = $this->jsonresult;
		$result->end();
	}
	public function getFaskesList(){
		$common=$this->common;
		$text=$this->get('query',false);
		$innerJoin='';
		$criteria='';
	
		$arr=array();
		$res=$common->createQuery("SELECT u FROM ".$common->getModel('Faskes')." u
			".$innerJoin."
			WHERE (UPPER(u.faskesCode) LIKE UPPER('%".$text."%') or UPPER(u.faskesName) LIKE UPPER('%".$text."%') )
			".$criteria."
			 ORDER BY u.faskesName ASC")
				 ->setMaxResults(10)
				 ->getResult();
		for($i=0,$iLen=count($res); $i<$iLen ; $i++){
			$ori=$res[$i];
			$o=array();
			$o['id']=$ori->getFaskesCode();
			$o['text']=$ori->getFaskesCode().' - '.$ori->getFaskesName();
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function initAdd(){
		$result = $this->jsonresult;
		$result->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pid=$this->get('i');
		$ori=$common->find('FaskesAccount',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getFaskes()->getFaskesCode();
			$mod['f2']=$ori->getAccountName();
			$mod['f3']=$ori->getEmail();
			$mod['f4']=$ori->getUserName();
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
		
		$faskes=$this->get('f1');
		$nama=$this->get('f2');
		$email=$this->get('f3');
		$user=$this->get('f4');
		
		$entity=$common->getModel('FaskesAccount');
		
		$criteria='';
		$inner=' 
				INNER JOIN M.faskes A ';
		
		if(trim($faskes)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(A.faskesName) like upper('%".$faskes."%')";
		}
		if(trim($nama)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.accountName) like upper('%".$nama."%')";
		}
		if(trim($email)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.email) like upper('%".$email."%')";
		}
		if(trim($user)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.userName) like upper('%".$user."%')";
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
		   	case "f1": 
		   		$orderBy.='A.customerName '.$direction;
		       	break;
	       	case "f2":
	       		$orderBy.='B.optionName '.$direction;
	       		break;
       		case "f3":
       			$orderBy.='M.contact '.$direction;
       			break;
		   	default:
		   		$orderBy.='A.faskesName ASC ';
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
			$o['f1']=$r->getFaskes()->getFaskesName();
			$o['f2']=$r->getAccountName();
			$o['f3']=$r->getEmail();
			$o['f4']=$r->getUserName();
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total['total'])->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pageType=$this->post('p');
		$pid=$this->post('i');
		
		$faskes=$common->find('Faskes',$this->post('f1'));
		$name=$this->post('f2');
		$email=$this->post('f3');
		$user=$this->post('f4');
		$password=hash('md5',$this->post('f5'));
		if($pageType=='ADD'){
			$cek=$common->createQuery("SELECT M FROM ".$common->getModel('FaskesAccount')." M INNER JOIN
					 M.faskes A WHERE 
					A.faskesCode='".$faskes->getFaskesCode()."' AND M.userName='".$user."'")->getResult();
			if(!$cek){
				$o=$common->newModel('FaskesAccount');
				$o->setFaskes($faskes)
				->setAccountName($name)
				->setEmail($email)
				->setUserName($user)
				->setPassword($password)
				->save();
				$result->setMessageSave ('Faskes Account ', $faskes->getFaskesName() )->end ();
			}else{
				$result->setMessage('User Name Sudah ada, Harap pilih User Name yang lain.')->end();
			}
		}else if($pageType=='UPDATE'){
			$cek=$common->createQuery("SELECT M FROM ".$common->getModel('FaskesAccount')." M INNER JOIN
					 M.faskes A WHERE
					A.faskesCode='".$faskes->getFaskesCode()."' AND M.userName='".$user."' AND M.id !=".$pid)->getResult();
			if(!$cek){
				$o=$common->find('FaskesAccount',$pid);
				if ($o != null) {
					$o->setFaskes($faskes)
						->setAccountName($name)
						->setEmail($email)
						->setUserName($user)
						->update();
					$result->setMessageEdit ('Faskes Account ', $faskes->getFaskesName() )->end ();
				}else
					$result->error()->setMessageNotExist()->end();
			}else{
				$result->setMessage('User Name Sudah ada, Harap pilih User Name yang lain.')->end();
			}
		}else{
			$o=$common->find('FaskesAccount',$pid);
			if ($o != null) {
				$o->setPassword($password)
				->update();
				$result->setMessageEdit ('Faskes Account ', $faskes->getFaskesName() )->end ();
			}else
				$result->error()->setMessageNotExist()->end();
		}
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		
		$pid= $this->post('i');
		
		$code='';
		$res= $common->find('FaskesAccount',$pid);
		if ($res != null) {
			$code=$res->getFaskes()->getFaskesName();
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$result->setMessageDelete('Faskes Account ', $code )->end ();
	}
}
