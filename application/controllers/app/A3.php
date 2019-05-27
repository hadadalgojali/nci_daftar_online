<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Role
class A3 extends MY_controller {
	public $MA='A3';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->setData ( $lang )->end ();
	}
	public function initAdd(){
		$common = $this->common;
		if($common->getTenantFlag()==null){
			$this->jsonresult->setData(array('tenantList'=>$common->getTenants()));
		}
		$this->jsonresult->end();
	}
	public function initSearch(){
		$data=array(
			'l'=>$this->common->getParams('ACTIVE_FLAG')
		);
		$this->jsonresult->setData($data)->end();
	}
	public function initUpdate(){
		$this->jsonresult->end();
	}
	public function getList(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$first=$this->get('page');
		$size=$this->get('pageSize');
		$direction=$this->get('d',false);
		$sorting=$this->get('s',false);
		
		$roleCode=$this->get('f1');
		$roleName=$this->get('f2');
		$Description=$this->get('f3');
		$activeFlag=$this->get('f4');
		
		$entity=$common->getModel('Role');
		
		$criteria="";
		$inner='';
		
		if(trim($roleCode)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.roleCode) like upper('%".$roleCode."%')";
		}
		if(trim($roleName)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.roleName) like upper('%".$roleName."%')";
		}
		if(trim($Description)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.description) like upper('%".$Description."%')";
		}
		if($common->getTenantFlag()!=null){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" T.id=".$common->getTenantFlag();
			$inner.=" INNER JOIN M.tenant T ";
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
			case "role_name":
				$orderBy.='M.roleName '.$direction;
				break;
			case "description":
				$orderBy.='M.description '.$direction;
				break;
			default:
				$orderBy.='M.roleCode '.$direction;
				break;
		}
		
		$total=$common->createQuery("SELECT count(M) AS total FROM ".$entity." M  ".$inner." ".$criteria)->getSingleResult();
		$res=$common->createQuery("SELECT M FROM ".$entity." M ".$inner." ".$criteria." ".$orderBy)
			->setFirstResult($first)
			->setMaxResults($size)
			->getResult();
		$list=array();
		
		for($i=0; $i<count($res); $i++){
			$r=$res[$i];
			$o=array();
			$o['id']=$r->getId();
			$o['role_code']=$r->getRoleCode();
			$o['role_name']=$r->getRoleName();
			$o['description']=$r->getDescription();
			$o['active_flag']=$r->getActiveFlag();
			$oTenant=$r->getTenant();
			if($oTenant != null){
				$o['tenant_id']=$oTenant->getId();
				$o['tenant_name']=$oTenant->getTenantName();
			}else{
				$o['tenant_id']='';
				$o['tenant_name']='Owner';
			}
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total['total'])->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pageType=$this->post('pageType');
		$id=$this->post('id');
		$roleCode=$this->post('roleCode');
		$roleName=$this->post('roleName');
		$description=$this->post('description');
		$activeFlag=$this->post('activeFlag');
		$tenantId=$this->post('tenant');
		if($activeFlag=='true')
			$activeFlag=1;
		else
			$activeFlag=0;
		if($pageType=='ADD'){
			$qTenant='';
			if($tenantId != null)
				$qTenant=" AND T.id=".$tenantId;
			else
				if($common->getTenantFlag()!=null)
					$qTenant=" AND T.id=".$common->getTenantFlag();	
				else
					$qTenant=" AND T.id is NULL";
			$res= $common->createQuery ( "SELECT M FROM ".$common->getModel('Role')." M LEFT JOIN 
					M.tenant T WHERE M.roleCode='" . $roleCode . "' ".$qTenant);
			if (! $res->getResult ()) {
				$tenant=null;
				if($common->getTenantFlag()!=null)
					$tenant=$common->getUserTenant();
				else if($tenantId != null)
					$tenant=$common->getTenant($tenantId);
				$role=$common->newModel('Role');
				$role->setRoleCode($roleCode)
					->setRoleName($roleName)
					->setDescription($description)
					->setCreateBy($common->getEmployee ())
					->setCreateOn($common->getDateTime ())
					->setUpdateBy($common->getEmployee ())
					->setUpdateOn($common->getDateTime ())
					->setActiveFlag($activeFlag)
					->setTenant($tenant)
					->save();
				$result->setMessageSave ('Role Code', $roleCode )->end ();
			}else 
				$result->warning ()->setMessageExist ('Role Code', $roleCode )->end ();
		}else{
			$res= $common->createQuery ( "SELECT M FROM ".$common->getModel('Role')." M WHERE 
					M.id='" . $id . "'" );
			if ($res->getResult ()) {
				$role=$res->getSingleResult();
				$role->setRoleName($roleName)
					->setDescription($description)
					->setUpdateBy($common->getEmployee ())
					->setUpdateOn($common->getDateTime ())
					->setActiveFlag($activeFlag)
					->update();
			} 
			$result->setMessageEdit ('Role Code', $roleCode )->end ();
		}
		echo json_encode($this->jsonresult);
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		$pid= $this->post('pid');
		
		$res= $common->createQuery ( "SELECT M FROM ".$common->getModel('Role')." M WHERE 
				M.id='" . $pid . "'" );
		if ($res->getResult ()) {
			$role=$res->getSingleResult();
			$role->delete();
		}else 
			$result->error()->setMessageNotExist()->end();
		$result->setMessageDelete('Role Code', $role->getRoleCode() )->end ();
	}
	public function getForMenu(){
		$common = $this->common;
		$result = $this->jsonresult;
		$session = $this->pagesession;
		
		$roleCode=$this->get('roleCode');
		$id=$this->get('id');
		$role=$common->createQuery("SELECT M FROM ".$common->getModel('Role')." M WHERE 
				M.id=".$id)->getSingleResult();
		$admin=true;
		if($role->getTenant() != null)
			$admin=false;
		$menus=$common->createQuery("SELECT M FROM ".$common->getModel('Menu')." M WHERE 
				M.parent is NULL")->getResult();
		$res=array();
		for($i=0,$iLen=count($menus); $i<$iLen; $i++){
			$menu=$menus[$i];
			if($admin==true || ($menu->getAdminFlag()==false && $admin==false)){
				$a=array();
				$a['text']=$menu->getMenuName();
				$a['menu_code']=$menu->getMenuCode();
				$check=$common->createQuery("SELECT M FROM ".$common->getModel('RoleMenu')." M 
					INNER JOIN M.role B
					INNER JOIN M.menu C
					WHERE B.id='".$id."' AND C.menuCode='".$menu->getMenuCode()."'")->getResult();
				if($check)
					$a['checked']=true;
				else
					$a['checked']=false;
				if($menu->getMenuType()->getOptionCode()=='MENUTYPE_FOLDER'){
					$result1=$menu->getMenuList();
					if(count($result1)>0){
						$a['children']=$this->getChild($result1,$id,$admin);
						$a['expanded']=true;
					}else
						$a['children']=array();
				}else
					$a['leaf']=true;
				$res[]=$a;
			}
		}
		$result->setData($res)->end();
	}
	private function getChild($result,$id,$admin){
		$common = $this->common;
		$res=array();
		for($i=0, $iLen=count($result); $i<$iLen; $i++){
			$menu=$result[$i];
			if($admin==true || ($menu->getAdminFlag()==false && $admin==false)){
				$a=array();
				$a['text']=$menu->getMenuName();
				$a['menu_code']=$menu->getMenuCode();
				$check=$common->createQuery("SELECT M FROM ".$common->getModel('RoleMenu')." M 
				INNER JOIN M.role B
				INNER JOIN M.menu C
				WHERE B.id='".$id."' AND C.menuCode='".$menu->getMenuCode()."'")->getResult();
				if(count($check)>0)
					$a['checked']=true;
				else
					$a['checked']=false;
				if($menu->getMenuType()->getOptionCode()=='MENUTYPE_FOLDER'){
					$result1=$menu->getMenuList();
					if(count($result1)>0)
						$a['children']=$this->getChild($result1,$id,$admin);
					else
						$a['children']=array();
				}else
					$a['leaf']=true;
				$res[]=$a;
			}
		}
		return $res;
	}
	public function saveMenu(){
		$common = $this->common;
		$result = $this->jsonresult;
		$roleCode=$this->post('roleCode');
		$id=$this->post('id');
		$menuCodes=json_decode($this->post('menuCode'));
		$res= $common->createQuery ( "SELECT M FROM ".$common->getModel('Role')." M WHERE 
				M.id='" . $id . "'" );
		if($res->getResult()){
			$role=$res->getSingleResult();
			$rms=$role->getRoleMenuList();
			for($i=0,$iLen=count($rms); $i<$iLen ; $i++){
				$ada=false;
				$rm=$rms[$i];
				for($j=0,$jLen=count($menuCodes); $j<$jLen; $j++){
					if($rm->getMenu()->getMenuCode()==$menuCodes[$j]){
						$ada=true;
						$rm->setUpdateOn($common->getDateTime ())
							->setUpdateBy($common->getUser ()->getEmployee ());
					}
				}
				if($ada==false)
					$role->removeRoleMenus($rm);
			}
			for($j=0,$jLen=count($menuCodes); $j<$jLen; $j++){
				$ada=false;
				for($i=0,$iLen=count($rms); $i<$iLen ; $i++){
					$rm=$rms[$i];
					if($rm->getMenu()->getMenuCode()==$menuCodes[$j])
						$ada=true;
				}
				if($ada==false){
					$roleMenu=$common->newModel('RoleMenu');
					$roleMenu->setMenu($common->createQuery("SELECT M FROM ".$common->getModel('Menu')." M WHERE 
							M.menuCode='".$menuCodes[$j]."'")->getSingleResult())
						->setRole($common->createQuery("SELECT M FROM ".$common->getModel('Role')." M WHERE 
								M.id='".$id."'")->getSingleResult())
						->setCreateOn($common->getDateTime ())
						->setCreateBy($common->getEmployee ())
						->setUpdateOn($common->getDateTime ())
						->setUpdateBy($common->getEmployee ());
					$role->addRoleMenus($roleMenu);
				}
			}
			$role->update();
		}else 
			$result->error()->setMessageNotExist()->end();
		$result->setMessageEdit ('Role Code', $roleCode )->end (); json_encode($this->jsonresult);
	}
}