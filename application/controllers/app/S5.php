<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Kontrakrtor
class S5 extends MY_controller {
	public $MA='S5';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end();
	}
	public function initSearch(){
		$common = $this->common;
		$result = $this->jsonresult;
		$data=array();
		$data['l']=$common->getParams('CUSTOMER');
		$result->setData($data)->end();
	}
	public function initAdd(){
		$common = $this->common;
		$result = $this->jsonresult;
		$data=array();
		$units=array();
		$units=$common->createQuery ( "SELECT M FROM ".$common->getModel('Customer')." M WHERE
				M.id not in(SELECT B.id FROM ".$common->getModel('Kontraktor')." A INNER JOIN A.customer B) ORDER BY M.customerName ASC" )->getResult();
		$oList=array();
		for($i=0,$iLen=count($units); $i<$iLen ; $i++){
			$oO=$units[$i];
			$oM=array();
			$oM['id']=$oO->getId();
			$oM['text']=$oO->getCustomerName();
			$oList[]=$oM;
		}
		$data['l']=$oList;
		$data['l1']=$common->getParams('CUSTOMER');
		$result->setData($data)->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pid=$this->get('i');
		$ori=$common->find('Kontraktor',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getCustomer()->getId();
			$mod['f2']=$ori->getJenisCust()->getOptionCode();
			$mod['f3']=$ori->getContact();
			$data['o']=$mod;
			$units=array();
			$units=$common->createQuery ( "SELECT M FROM ".$common->getModel('Customer')." M ORDER BY M.customerName ASC" )->getResult();
			$oList=array();
			for($i=0,$iLen=count($units); $i<$iLen ; $i++){
				$oO=$units[$i];
				$oM=array();
				$oM['id']=$oO->getId();
				$oM['text']=$oO->getCustomerName();
				$oList[]=$oM;
			}
			$data['l']=$oList;
			$data['l1']=$common->getParams('CUSTOMER');
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
		
		$customer=$this->get('f1');
		$jenisCust=$this->get('f2');
		$kontak=$this->get('f3');
		
		$entity=$common->getModel('Kontraktor');
		
		$criteria='';
		$inner='INNER JOIN M.customer A 
				INNER JOIN M.jenisCust B ';
		
		if(trim($jenisCust)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" B.optionCode='".$jenisCust."'";
		}
		
		if(trim($customer)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(A.customerName) like upper('%".$customer."%')";
		}
		
		if(trim($kontak)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.contact) like upper('%".$kontak."%')";
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
		   		$orderBy.='A.customerName ASC ';
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
			$cus=$r->getCustomer();
			$o['i']=$cus->getId();
			$o['f1']=$cus->getCustomerName();
			$o['f2']=$r->getJenisCust()->getOptionName();
			$o['f3']=$r->getContact();
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total['total'])->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pageType=$this->post('p');
		$pid=$this->post('i');
		
		$customer=$common->find('Customer',$this->post('f1'));
		$jenisCust=$common->find('ParameterOption',$this->post('f2'));
		$contact=$this->post('f3');
		
		if($pageType=='ADD'){
			$o=$common->newModel('Kontraktor');
			$o->setCustomer($customer)
				->setJenisCust($jenisCust)
				->setContact($contact)
				->save();
			$result->setMessageSave ('Kontraktor ', $customer->getCustomerName() )->end ();
		}else{
			$o=$common->find('Kontraktor',$pid);
			if ($o != null) {
				$o->setJenisCust($jenisCust)
					->setContact($contact)
					->update();
				$result->setMessageEdit ('Kontraktor ', $customer->getCustomerName() )->end ();
			}else
				$result->error()->setMessageNotExist()->end();
		}
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		
		$pid= $this->post('i');
		
		$code='';
		$res= $common->find('Kontraktor',$pid);
		if ($res != null) {
			$code=$res->getCustomer()->getCustomerName();
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$result->setMessageDelete('Kontraktor ', $code )->end ();
	}
}
