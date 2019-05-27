<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Simulasi Pembayaran
class Pel4 extends MY_controller {
	public $MA='PEL4';
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
		$units=$common->createQuery ( "SELECT M FROM ".$common->getModel('Kontraktor')." M INNER JOIN 
					M.customer B WHERE
					B.id NOT IN(SELECT C.id FROM ".$common->getModel('SimulasiPembayaran')." D INNER JOIN D.customer C) ORDER BY B.customerName ASC" )->getResult();
		$oList=array();
		for($i=0,$iLen=count($units); $i<$iLen ; $i++){
			$oO=$units[$i];
			$oM=array();
			$cus=$oO->getCustomer();
			$oM['id']=$cus->getId();
			$oM['text']=$cus->getCustomerName();
			$oList[]=$oM;
		}
		$data['l']=$oList;
		$result->setData($data)->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pid=$this->get('i');
		$ori=$common->find('SimulasiPembayaran',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$customer=$ori->getCustomer();
			$mod['f1']=$customer->getId();
			$mod['f2']=$ori->getDeskripsi();
			$data['o']=$mod;
			$units=array();
			$units=$common->createQuery ( "SELECT M FROM ".$common->getModel('Kontraktor')." M INNER JOIN 
					M.customer B WHERE
					B.id NOT IN(SELECT C.id FROM ".$common->getModel('SimulasiPembayaran')." D INNER JOIN D.customer C) ORDER BY B.customerName ASC" )->getResult();
			$oList=array();
			$oList[]=array('id'=>$customer->getId(),'text'=>$customer->getCustomerName());
			for($i=0,$iLen=count($units); $i<$iLen ; $i++){
				$oO=$units[$i];
				$oM=array();
				$cus=$oO->getCustomer();
				$oM['id']=$cus->getId();
				$oM['text']=$cus->getCustomerName();
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
		
		$customer=$this->get('f1');
		
		$entity=$common->getModel('SimulasiPembayaran');
		
		$criteria='';
		$inner='
				INNER JOIN M.customer A ';
		
		if(trim($customer)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(A.customerName) like upper('%".$customer."%')";
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
		   	case "f1": 
		   		$orderBy.='A.customerName '.$direction;
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
			$o['i']=$r->getId();
			$o['f1']=$r->getCustomer()->getCustomerName();
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
		$desc=$this->post('f2');
		
		if($pageType=='ADD'){
			$o=$common->newModel('SimulasiPembayaran');
			$o->setCustomer($customer)
				->setDeskripsi($common->htmlEditor($desc,$o->getDeskripsi()))
				->save();
			$result->setMessageSave ('Simulasi Pembayaran ', $customer->getCustomerName() )->end ();
		}else{
			$o=$common->find('SimulasiPembayaran',$pid);
			if ($o != null) {
				$o->setCustomer($customer)
					->setDeskripsi($common->htmlEditor($desc,$o->getDeskripsi()))
					->update();
				$result->setMessageEdit ('Simulasi Pembayaran ', $customer->getCustomerName() )->end ();
			}else
				$result->error()->setMessageNotExist()->end();
		}
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		
		$pid= $this->post('i');
		
		$code='';
		$desc='';
		$res= $common->find('SimulasiPembayaran',$pid);
		if ($res != null) {
			$code=$res->getCustomer()->getCustomerName();
			$desc=$res->getDeskripsi();
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$common->htmlEditor(null,$desc);
		$result->setMessageDelete('Simulasi Pembayaran ', $code )->end ();
	}
}
