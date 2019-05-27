<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Tentang Unit
class S3 extends MY_controller {
	public $MA='S3';
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
		$units=$common->createQuery ( "SELECT M FROM ".$common->getModel('Unit')." M WHERE 
				M.id not in(SELECT B.id FROM ".$common->getModel('UnitAbout')." A INNER JOIN A.unit B ) ORDER BY M.unitName ASC" )->getResult();
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
		$ori=$common->find('UnitAbout',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getUnit()->getUnitName();
			$mod['f2']=$ori->getDescription();
			$mod['f3']=$ori->getJudul();
			$mod['f4']=$ori->getPhoneNumber();
			$mod['f5']=$ori->getEmail();
			$mod['f6']=$ori->getInformation();
			$mod['f7']=$ori->getAddress();
			$mod['f8']=$ori->getImageName();
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
		
		$klinik=$this->get('f1');
		$judul=$this->get('f2');
		$email=$this->get('f3');
		$alamat=$this->get('f4');
		$telp=$this->get('f5');
		
		$entity=$common->getModel('UnitAbout');
		
		$criteria='';
		$inner='
				INNER JOIN M.unit A ';
		
		if(trim($klinik)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(A.unitName) like upper('%".$klinik."%')";
		}
		
		if(trim($judul)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.judul) like upper('%".$judul."%')";
		}
		
		if(trim($email)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.email) like upper('%".$email."%')";
		}
		
		if(trim($alamat)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.address) like upper('%".$alamat."%')";
		}
		
		if(trim($telp)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.phoneNumber) like upper('%".$telp."%')";
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
		   	case "f1": 
		   		$orderBy.='A.unitName '.$direction;
		       	break;
	       	case "f2":
	       		$orderBy.='M.judul '.$direction;
	       		break;
       		case "f3":
       			$orderBy.='M.email '.$direction;
       			break;
	       	case "f4":
	       		$orderBy.='M.address '.$direction;
	       		break;
	       	case "f5":
	       		$orderBy.='M.phoneNumber '.$direction;
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
			$o['f2']=$r->getJudul();
			$o['f3']=$r->getEmail();
			$o['f4']=$r->getAddress();
			$o['f5']=$r->getPhoneNumber();
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total['total'])->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pageType=$this->post('p');
		$pid=$this->post('i');
		
		$klinik=$common->find('Unit',$this->post('f1'));
		$description=$this->post('f2');
		$judul=$this->post('f3');
		$telp=$this->post('f4');
		$email=$this->post('f5');
		$info=$this->post('f6');
		$address=$this->post('f7');
		$image=$this->post('f8');
		
		if($pageType=='ADD'){
			$o=$common->newModel('UnitAbout');
			if($image == null || $image!='true'){
				$o->setImageName($common->uploadToFile($image,'jpg'));
			}
			$o->setUnit($klinik)
				->setDescription($common->htmlEditor($description,null))
				->setJudul($judul)
				->setPhoneNumber($telp)
				->setEmail($email)
				->setInformation($info)
				->setAddress($address)
				->save();
			$result->setMessageSave (' Unit About ', $judul )->end ();
		}else{
			$o=$common->find('UnitAbout',$pid);
			if ($o != null) {
				if($image == null || $image!='true'){
					$o->setImageName($common->uploadToFile($image,'jpg',$o->getImageName()));
				}
				$o->setDescription($common->htmlEditor($description,$o->getDescription()))
					->setJudul($judul)
					->setPhoneNumber($telp)
					->setEmail($email)
					->setInformation($info)
					->setAddress($address)
					->update();
				$result->setMessageEdit (' Unit About ', $judul )->end ();
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
		$res= $common->find('UnitAbout',$pid);
		if ($res != null) {
			$code=$res->getUnit()->getUnitName();
			$imageName=$res->getImageName();
			$description=$res->getDescription();
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$common->uploadToFile(null,'jpg',$imageName);
		$common->htmlEditor(null,$description);
		$result->setMessageDelete(' Unit About ', $code )->end ();
	}
}
