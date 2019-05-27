<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//System Property
class A6 extends MY_controller {
	public $MA='A6';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end();
	}
	public function initSearch(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$data=array();
		$data['l']=$common->getParams('ACTIVE_FLAG');
		$result->setData($data)->end();
	}
	public function initAdd(){
		$common = $this->common;
		$data=array();
		if($common->getTenantFlag()==null)
			$data['tl']=$common->getTenants();
		$this->jsonresult->setData($data)->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pid=$this->get('i');
		$ori=$common->find('SystemProperty',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getPropertyCode();
			$mod['f2']=$ori->getPropertyName();
			$mod['f3']=$ori->getPropertyValue();
			$mod['f4']=$ori->getDescription();
			$mod['f5']=$ori->getActiveFlag();
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
		
		$propCode=$this->get('f1');
		$propName=$this->get('f2');
		$value=$this->get('f3');
		$description=$this->get('f4');
		$activeFlag=$this->get('f5');
		
		$entity=$common->getModel('SystemProperty');
		
		$criteria='';
		$inner='
				LEFT JOIN M.tenant T';
		
		if(trim($propCode)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.propertyCode) like upper('%".$propCode."%')";
		}
		if(trim($propName)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.propertyName) like upper('%".$propName."%')";
		}
		if(trim($value)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.propertyValue) like upper('%".$value."%')";
		}
		if(trim($description)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" upper(M.description) like upper('%".$description."%')";
		}
		if($common->getTenantFlag()!=null){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			$criteria.=" T.id=".$common->getTenantFlag();
		}
		if(trim($activeFlag)!=''){
			if($criteria=='')
				$criteria.=' WHERE ';
			else
				$criteria.=' AND ';
			if(trim($activeFlag)=='Y')
				$criteria.=' M.activeFlag =true';
			else
				$criteria.=' M.activeFlag =false';
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
		   	case "f2": 
		   		$orderBy.='M.propertyName '.$direction;
		       	break;
		   	case "f3":
		   		$orderBy.='M.propertyValue '.$direction;
		       	break;
	       	case "f4":
	       		$orderBy.='M.description '.$direction;
	       		break;
		   	default:
		   		$orderBy.='M.propertyCode '.$direction;
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
			$o['f1']=$r->getPropertyCode();
			$o['f2']=$r->getPropertyName();
			$o['f3']=$r->getPropertyValue();
			$o['f4']=$r->getDescription();
			$o['f5']=$r->getActiveFlag();
			$t=$r->getTenant();
			if($t != null)
				$o['t']=$t->getTenantName();
			else
				$o['t']='Owner';
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total['total'])->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pageType=$this->post('p');
		$pid=$this->post('i');
		$tenantId=$this->post('t');
		
		$propCode=$this->post('f1');
		$propName=$this->post('f2');
		$value=$this->post('f3');
		$description=$this->post('f4');
		$activeFlag=$this->post('f5');
		if($activeFlag=='true')
			$activeFlag=true;
		else
			$activeFlag=false;
		if($pageType=='ADD'){
			$qTenant='';
			if($tenantId != null)
				$qTenant=" AND T.id=".$tenantId;
			else
				if($common->getTenantFlag()!=null)
					$qTenant=" AND T.id=".$common->getTenantFlag();	
				else
					$qTenant=" AND T.id is NULL";
			$res= $common->createQuery ( "SELECT M FROM ".$common->getModel('SystemProperty')." M LEFT JOIN M.tenant T WHERE M.propertyCode='" . $propCode . "' ".$qTenant);
			if (! $res->getResult ()) {
				$tenant=null;
				if($common->getTenantFlag()!=null)
					$tenant=$common->getUseTenant();
				else if($tenantId != null)
					$tenant=$common->getTenant($tenantId);
				$o=$common->newModel('SystemProperty');
				$o->setPropertyCode($propCode)
					->setPropertyName($propName)
					->setPropertyValue($value)
					->setTenant($tenant)
					->setDescription($description)
					->setActiveFlag($activeFlag)
					->setCreateOn($common->getDateTime ())
					->setCreateBy($common->getEmployee())
					->setUpdateOn($common->getDateTime ())
					->setUpdateBy($common->getEmployee())
					->save();
				$result->setMessageSave ('Property Code', $propCode )->end ();
			}else
				$result->warning ()->setMessageExist ('Property Code', $propCode )->end ();
		}else{
			$o=$common->find('SystemProperty',$pid);
			if ($o != null) {
				$o->setPropertyCode($propCode)
					->setPropertyName($propName)
					->setPropertyValue($value)
					->setDescription($description)
					->setActiveFlag($activeFlag)
					->setUpdateOn($common->getDateTime ())
					->setUpdateBy($common->getEmployee())
					->update();
			}else
				$result->error()->setMessageNotExist()->end();
			$result->setMessageEdit ('Property Code', $propCode )->end ();
		}
		echo json_encode($this->jsonresult);
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		
		$pid= $this->post('i');
		
		$code='';
		$res= $common->find('SystemProperty',$pid);
		if ($res != null) {
			$code=$res->getPropertyCode();
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$result->setMessageDelete('Property Code', $code )->end ();
	}
}
