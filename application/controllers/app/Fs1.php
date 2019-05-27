<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Faskes
class Fs1 extends MY_controller {
	public $MA='FS1';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end();
	}
	public function initSearch(){
		$result = $this->jsonresult;
		$result->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pid=$this->get('i');
		$ori=$common->find('Faskes',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getAccept();
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
		
		$kode=$this->get('f1');
		$name=$this->get('f2');
		$alamat=$this->get('f3');
		$telp=$this->get('f4');
		$email=$this->get('f5');
		
		$entity=$common->getModel('Faskes');
		$criteria='';
		$inner='';
		
		if(trim($kode)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.faskesCode) like upper('%".$kode."%')";
		}
		if(trim($name)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.faskesName) like upper('%".$name."%')";
		}
		if(trim($alamat)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.alamat) like upper('%".$alamat."%')";
		}
		if(trim($telp)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.telp) like upper('%".$telp."%')";
		}
		if(trim($email)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.email) like upper('%".$email."%')";
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
		   	case "f1": 
		   		$orderBy.='M.faskesCode '.$direction;
		       	break;
	       	case "f2":
	       		$orderBy.='M.faskesName '.$direction;
	       		break;
       		case "f3":
       			$orderBy.='M.alamat '.$direction;
       			break;
       		case "f4":
       			$orderBy.='M.telp '.$direction;
       			break;
       		case "f5":
       			$orderBy.='M.email '.$direction;
       			break;
		   	default:
		   		$orderBy.='M.faskesCode ASC ';
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
			$o['f1']=$r->getFaskesCode();
			$o['f2']=$r->getFaskesName();
			$o['f3']=$r->getAlamat();
			$o['f4']=$r->getTelp();
			$o['f5']=$r->getEmail();
			$o['f6']=$r->getAccept();
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total['total'])->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pid=$this->post('i');
		
		$username=$this->post('f2');
		$password=$this->post('f3');
		$o=$common->find('Faskes',$pid);
		if ($o != null) {
			$o->setAccept(true)
				->update();
			$faskesAccount=$common->newModel('FaskesAccount');
			$faskesAccount->setFaskes($o)
				->setAccountName($o->getFaskesName())
				->setEmail($o->getEmail())
				->setUserName($username)
				->setPassword(hash('md5',$password))
				->save();
			$tenant=$common->getDefaultTenant();
			$msg = "Terimakasi telah mendaftar.\n Username : ".$username."\n Password : ".$password;
			$msg = wordwrap($msg,70);
			mail($o->getEmail(),"RSUD - Embung Fatimah | Pendaftaran Faskes Tingkat 1",$msg);
			$result->setMessage(' Faskes Berhasil diVerifikasi dan Mengirim Email. ')->end ();
		}else
			$result->error()->setMessageNotExist()->end();
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		
		$pid= $this->post('i');
		$res= $common->find('Faskes',$pid);
		if ($res != null) {
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$result->setMessage(' Faskes Successfully Deleted ')->end ();
	}
}
