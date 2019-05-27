<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//PDF Template
class A9 extends MY_controller {
	public $MA='A9';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end ();
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
		$data['l']=$common->getParams('PDF_TYPE');
		$data['l1']=$common->getParams('PDF_DIRECTION');
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
		$ori=$common->find('PDFTemplate',$pid);
		if($ori != null){
			$data=array();
			$data['l']=$common->getParams('PDF_TYPE');
			$data['l1']=$common->getParams('PDF_DIRECTION');
			$mod=array();
			$mod['f1']=$ori->getTemplateCode();
			$mod['f2']=$ori->getTemplateName();
			$mod['f3']=$ori->getType()->getOptionCode();
			$mod['f4']=$ori->getDirection()->getOptionCode();
			$mod['f5']=$ori->getWidth();
			$mod['f6']=$ori->getHeight();
			$mod['f7']=$ori->getTop();
			$mod['f8']=$ori->getRight();
			$mod['f9']=$ori->getBottom();
			$mod['f10']=$ori->getLeft();
			$mod['f11']=$ori->getActiveFlag();
			$mod['f12']=$ori->getHtml();
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
		
		$entity=$common->getModel('PDFTemplate');
		
		$criteria="";
		$inner='
				LEFT JOIN M.tenant T';
		
		if(trim($propCode)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.propertyCode) like upper('%".$propCode."%')";
		}
		if(trim($propName)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.propertyName) like upper('%".$propName."%')";
		}
		if(trim($value)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.propertyValue) like upper('%".$value."%')";
		}
		if(trim($description)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.description) like upper('%".$description."%')";
		}
		if($common->getTenantFlag()!=null){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
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
		   		$orderBy.='M.templateName '.$direction;
		       	break;
		   	case "f3":
		   		$orderBy.='M.propertyValue '.$direction;
		       	break;
		   	default:
		   		$orderBy.='M.templateCode '.$direction;
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
			$o['f1']=$r->getTemplateCode();
			$o['f2']=$r->getTemplateName();
			$o['f3']=$r->getType()->getOptionName();
			$o['f4']=$r->getActiveFlag();
			$oTenant=$r->getTenant();
			if($oTenant != null)
				$o['t']=$oTenant->getTenantName();
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
		
		$code=$this->post('f1');
		$name=$this->post('f2');
		$type=$this->post('f3');
		$direction=$this->post('f4');
		$width=$this->post('f5');
		$height=$this->post('f6');
		$top=$this->post('f7');
		$right=$this->post('f8');
		$bottom=$this->post('f9');
		$left=$this->post('f10');
		$active=$this->post('f11');
		$html=$this->post('f12');
		if($active=='true')
			$active=true;
		else
			$active=false;
		if($pageType=='ADD'){
			$qTenant='';
			if($tenantId != null)
				$qTenant=" AND T.id=".$tenantId;
			else
				if($common->getTenantFlag()!=null)
					$qTenant=" AND T.id=".$common->getTenantFlag();	
				else
					$qTenant=" AND T.id is NULL";
			$res= $common->createQuery ( "SELECT M FROM ".$common->getModel('PDFTemplate')." M LEFT JOIN M.tenant T WHERE M.templateCode='" . $code . "' ".$qTenant);
			if (! $res->getResult ()) {
				$tenant=null;
				if($common->getTenantFlag()!=null)
					$tenant=$common->getUserTenant();
				else if($tenantId != null)
					$tenant=$common->getTenant($tenantId);
				$o=$common->newModel('PDFTemplate');
				$o->setTemplateCode($code)
					->setTemplateName($name)
					->setType($common->find('ParameterOption',$type))
					->setTenant($tenant)
					->setWidth($width)
					->setHeight($height)
					->setTop($top)
					->setRight($right)
					->setBottom($bottom)
					->setLeft($left)
					->setHtml($common->htmlEditor($html))
					->setActiveFlag($active)
					->setCreateOn($common->getDateTime ())
					->setCreateBy($common->getEmployee())
					->setUpdateOn($common->getDateTime ())
					->setUpdateBy($common->getEmployee());
				if($direction != null && $direction != '')
					$o->setDirection($common->find('ParameterOption',$direction));
				$o->save();
				$result->setMessageSave ('Template Code', $code )->end ();
			}else
				$result->warning ()->setMessageExist ('Template Code', $code )->end ();
		}else{
			$o=$common->find('PDFTemplate',$pid);
			if ($o != null) {
				$o->setTemplateName($name)
					->setType($common->find('ParameterOption',$type))
					->setWidth($width)
					->setHeight($height)
					->setTop($top)
					->setRight($right)
					->setBottom($bottom)
					->setLeft($left)
					->setHtml($common->htmlEditor($html,$o->getHtml()))
					->setActiveFlag($active)
					->setUpdateOn($common->getDateTime ())
					->setUpdateBy($common->getEmployee());
				if($direction != null && $direction != '')
					$o->setDirection($common->find('ParameterOption',$direction));
				$o->update();
			}else
				$result->error()->setMessageNotExist()->end();
			$result->setMessageEdit ('Template Code', $code )->end ();
		}
		echo json_encode($this->jsonresult);
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		$pid= $this->post('i');
		$code='';
		$html='';
		$res= $common->find('PDFTemplate',$pid);
		if ($res != null) {
			$code=$res->getTemplateCode();
			$html=$res->getHtml();
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$common->htmlEditor(null,$html);
		$result->setMessageDelete('Template Code', $code )->end ();
	}
}
