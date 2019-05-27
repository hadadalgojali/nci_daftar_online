<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//System Property
class A8 extends MY_controller {
	public $MA='A8';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end ();
	}
	public function initSearch(){
		$common = $this->common;
		$result = $this->jsonresult;
		$data=array();
		$data['l']=$common->getParams('ACTIVE_FLAG');
		$data['l1']=$common->getParams('REPEAT_TYPE');
		$result->setData($data)->end();
	}
	public function initAdd(){
		$common = $this->common;
		$data=array();
		$data['l']=$common->getParams('REPEAT_TYPE');
		//job
		if($common->getTenantFlag()==null){
			$data['tl']=$common->getTenants();
		}
		$this->jsonresult->setData($data)->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pid=$this->get('i');
		$ori=$common->find('Sequence',$pid);
		if($ori != null){
			$data=array();
			$data['l']=$common->getParams('REPEAT_TYPE');
			$mod=array();
			$mod['f1']=$ori->getSequenceCode();
			$mod['f2']=$ori->getSequenceName();
			$mod['f3']=$ori->getDigit();
			$mod['f4']=$ori->getLastValue();
			$mod['f5']=$ori->getFormat();
			$mod['f6']=$ori->getRepeatType()->getOptionCode();
			$mod['f7']=$ori->getActiveFlag();
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
		
		$seqCode=$this->get('f1');
		$seqName=$this->get('f2');
		$repeatType=$this->get('f3');
		$format=$this->get('f4');
		$activeFlag=$this->get('f5');
		
		$entity=$common->getModel('Sequence');
		
		$criteria="";
		$inner='
				LEFT JOIN M.tenant T
				LEFT JOIN M.repeatType P1';
		
		if(trim($seqCode)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.sequenceCode) like upper('%".$seqCode."%')";
		}
		if(trim($seqName)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.sequenceName) like upper('%".$seqName."%')";
		}
		if(trim($repeatType)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" P1.optionCode='".$repeatType."'";
		}
		if(trim($format)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.format) like upper('%".$format."%')";
		}
		if($common->getTenantFlag()!=null){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" T.id=".$common->getTenantFlag();
		}
		if(trim($activeFlag)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			if(trim($activeFlag)=='Y')
				$criteria.=" M.activeFlag =true";
			else
				$criteria.=" M.activeFlag =false";
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
		   	case "f2": 
		   		$orderBy.='M.sequenceName '.$direction;
		       	break;
		   	case "f3":
		   		$orderBy.='M.lastValue '.$direction;
		       	break;
	       	case "f4":
	       		$orderBy.='M.format '.$direction;
	       		break;
       		case "f6":
       			$orderBy.='P1.optionName '.$direction;
       			break;
		   	default:
		   		$orderBy.='M.sequenceCode '.$direction;
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
			$o['f1']=$r->getSequenceCode();
			$o['f2']=$r->getSequenceName();
			$o['f3']=$r->getLastValue();
			$o['f4']=$r->getFormat();
			$o['f5']=$r->getActiveFlag();
			$o['f6']=$r->getRepeatType()->getOptionName();
			$oTenant=$r->getTenant();
			if($oTenant != null){
				$o['t']=$oTenant->getTenantName();
			}else{
				$o['t']='Owner';
			}
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
		
		$seqCode=$this->post('f1');
		$seqName=$this->post('f2');
		$digit=$this->post('f3');
		$last=$this->post('f4');
		$format=$this->post('f5');
		$repeat=$this->post('f6');
		$activeFlag=$this->post('f7');
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
			$res= $common->createQuery ( "SELECT M FROM ".$common->getModel('Sequence')." M LEFT JOIN M.tenant T WHERE M.sequenceCode='" . $seqCode . "' ".$qTenant);
			if (! $res->getResult ()) {
				$tenant=null;
				if($common->getTenantFlag()!=null)
					$tenant=$common->getUserTenant();
				else if($tenantId != null)
					$tenant=$common->getTenant($tenantId);
				$o=$common->newModel('Sequence');
				$o->setSequenceCode($seqCode)
					->setSequenceName($seqName)
					->setDigit($digit)
					->setTenant($tenant)
					->setLastValue($last)
					->setFormat($format)
					->setRepeatType($common->find('ParameterOption',$repeat))
					->setLastOn($common->getDateTime ())
					->setActiveFlag($activeFlag)
					->setCreateOn($common->getDateTime ())
					->setCreateBy($common->getEmployee())
					->setUpdateOn($common->getDateTime ())
					->setUpdateBy($common->getEmployee())
					->save();
				$result->setMessageSave ('Sequence Code', $seqCode )->end ();
			}else
				$result->warning ()->setMessageExist ('Sequence Code', $seqCode )->end ();
		}else{
			$o=$common->find('Sequence',$pid);
			if ($o != null) {
				$o->setSequenceName($seqName)
					->setDigit($digit)
					->setLastValue($last)
					->setFormat($format)
					->setRepeatType($common->find('ParameterOption',$repeat))
					->setActiveFlag($activeFlag)
					->setUpdateOn($common->getDateTime ())
					->setUpdateBy($common->getEmployee())
					->save();
			}else
				$result->error()->setMessageNotExist()->end();
			$result->setMessageEdit ('Sequence Code', $seqCode )->end ();
		}
		echo json_encode($this->jsonresult);
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		$pid= $this->post('i');
		$code='';
		$res= $common->find('Sequence',$pid);
		if ($res != null) {
			$code=$res->getSequenceCode();
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$result->setMessageDelete('Sequence Code', $code )->end ();
	}
}
