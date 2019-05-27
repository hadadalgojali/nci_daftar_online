<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//User
class A7 extends MY_controller {
	public $MA='A7';
	public function initSearch(){
		$common = $this->common;
		$result = $this->jsonresult;
		$data=array();
		$data['l']=$common->getParams('ACTIVE_FLAG');
		$result->setData($data)->end();
	}
	public function getVar() {
		$this->jsonresult->end ();
	}
	public function initTenant(){
		$common = $this->common;
		$session = $this->pagesession;
		$pid=$this->get('pid');
		$data=array();
		//job
		if($pid != '')
			$jobs=$common->createQuery ( "SELECT M FROM ".$common->getModel('Role')." M INNER JOIN M.tenant A WHERE 
				M.activeFlag=true AND A.id=".$this->get('pid')." ORDER BY M.roleName ASC" )->getResult();
		else
			$jobs=$common->createQuery ( "SELECT M FROM ".$common->getModel('Role')." M WHERE 
			M.activeFlag=true AND M.tenant is NULL ORDER BY M.roleName ASC" )->getResult();
		$jobList=array();
		for($i=0, $iLen=count($jobs); $i<$iLen ; $i++){
			$job=$jobs[$i];
			$jobObject=array();
			$jobObject['id']=$job->getId();
			$jobObject['text']=$job->getRoleCode().' - '.$job->getRoleName();
			$jobList[]=$jobObject;
		}
		$data['roleList']=$jobList;
		
		$this->jsonresult->setData($data)->end();
	}
	public function initAdd(){
		$common = $this->common;
		$data=array();
		$jobs=array();
		if($common->getTenantFlag()==null){
			$data['tenantList']=$common->getTenants();
			$jobs=$common->createQuery ( "SELECT M FROM ".$common->getModel('Role')." M WHERE 
				M.activeFlag=true AND M.tenant is NULL ORDER BY M.roleName ASC" )->getResult();
		}else
			$jobs=$common->createQuery ( "SELECT M FROM ".$common->getModel('Role')." M INNER JOIN M.tenant A WHERE 
				M.activeFlag=true AND A.id=".$common->getTenantFlag()." ORDER BY M.roleName ASC" )->getResult();
		$jobList=array();
		for($i=0,$iLen=count($jobs); $i<$iLen ; $i++){
			$job=$jobs[$i];
			$jobObject=array();
			$jobObject['id']=$job->getId();
			$jobObject['text']=$job->getRoleCode().' - '.$job->getRoleName();
			$jobList[]=$jobObject;
		}
		$data['roleList']=$jobList;
		$this->jsonresult->setData($data)->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$session = $this->pagesession;
		$result = $this->jsonresult;
		
		$pid=$this->get('pid');
		$user=$common->find('User',$pid);
		if($user != null){
			$data=array();
			$roles=array();
			if($user->getTenant() != null){
				$roles=$common->createQuery ( "SELECT M FROM ".$common->getModel('Role')." M INNER JOIN M.tenant A WHERE 
					M.activeFlag=true AND A.id=".$user->getTenant()->getId()." ORDER BY M.roleName ASC" )->getResult();
			}else{
				$roles=$common->createQuery ( "SELECT M FROM ".$common->getModel('Role')." M WHERE 
					M.activeFlag=true AND M.tenant is NULL ORDER BY M.roleName ASC" )->getResult();
			}
			$roleList=array();
			for($i=0,$iLen=count($roles); $i<$iLen ; $i++){
				$role=$roles[$i];
				$roleObject=array();
				$roleObject['id']=$role->getId();
				$roleObject['text']=$role->getRoleCode().' - '.$role->getRoleName();
				$roleList[]=$roleObject;
			}
			$data['roleList']=$roleList;
			$userObject=array();
			$userObject['userCode']=$user->getUserCode();
			$userObject['role']=$user->getRole()->getId();
			$emp=$user->getEmployee();
			$userObject['employee']=$emp->getIdNumber()." - ".$emp->getFirstName().' '.$emp->getLastName();
			$userObject['activeFlag']=$user->getActiveFlag();
			$data['user']=$userObject;
			$result->setData($data)->end();
		}else{
			$result->error()->setMessageNotExist()->end();
		}
	}
	public function getList(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$first=$this->get('page');
		$size=$this->get('pageSize');
		$direction=$this->get('d',false);
		$sorting=$this->get('s',false);
		
		$srchUserCode=$this->get('f1');
		$idNumber=$this->get('f2');
		$srchName=$this->get('f3');
		$role=$this->get('f4');
		$startDate=$this->get('f5');
		$endDate=$this->get('f6');
		$activeFlag=$this->get('f7');
		
		$entity=$common->getModel('User');
		
		$criteria="";
		$innerJoin='
				LEFT JOIN M.tenant T
				LEFT JOIN M.employee E 
				LEFT JOIN M.role R
				';
		
		if(trim($srchUserCode)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.userCode) like upper('%".$srchUserCode."%')";
		}
		if(trim($srchName)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" (upper(E.firstName) like upper('%".$srchName."%') OR upper(E.secondName) like upper('%".$srchName."%') OR upper(E.lastName) like upper('%".$srchName."%'))";
		}
		if(trim($idNumber)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(E.idNumber) like upper('%".$idNumber."%')";
		}
		if(trim($startDate)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$dateStart=new DateTime($startDate);
			$criteria.=" E.birthDate>='".$dateStart->format('Y-m-d')."' ";
		}
		if(trim($endDate)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$dateEnd=new DateTime($endDate);
			$criteria.=" E.birthDate<='".$dateEnd->format('Y-m-d')."' ";
		}
		if(trim($role)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(R.roleName) like upper('%".$role."%')";
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
		if($common->getTenantFlag()!=null){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
			$criteria.=" T.id=".$common->getTenantFlag();
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
			case "id_number":
				$orderBy.='E.idNumber '.$direction;
				break;
			case "name":
				$orderBy.='E.firstName '.$direction;
				break;
			case "role":
				$orderBy.='R.roleName '.$direction;
				break;
			case "birthDate":
				$orderBy.='E.birthDate '.$direction;
				break;
			default:
				$orderBy.='M.userCode '.$direction;
				break;
		}
		
		$total=$common->createQuery("SELECT count(M) AS total FROM ".$entity." M  ".$innerJoin." ".$criteria)->getSingleResult();
		$res=$common->createQuery("SELECT M FROM ".$entity." M ".$innerJoin." ".$criteria." ".$orderBy)
			->setFirstResult($first)
			->setMaxResults($size)
			->getResult();
		$list=array();
		
		for($i=0,$iLen=count($res); $i<$iLen; $i++){
			$r=$res[$i];
			$o=array();
			$o['pid']=$r->getId();
			$o['user_code']=$r->getUserCode();
			$emp=$r->getEmployee();
			$o['id_number']=$emp->getIdNumber();
			$o['role']='<a href="javascript:loadView(\'App.system.a5.View\','.$r->getRole()->getId().')">'.$r->getRole()->getRoleName().'</a>';
			$o['name']='<a href="javascript:loadView(\'App.system.a5.View\','.$emp->getId().')">'.$emp->getFirstName()." ".$emp->getLastName().'</a>';
			$o['birthDate']=$r->getEmployee()->getBirthDate()->format('d M Y');
			$o['active_flag']=$r->getActiveFlag();
			$ten=$r->getTenant();
			if($ten != null)
				$o['t']='<a href="javascript:loadView(\'App.system.a12.View\','.$ten->getId().')">'.$ten->getTenantName().'</a>';
			else
				$o['t']='Owner';
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total['total'])->end();
	}
	public function getEmployeeList(){
		$common=$this->common;
		$text=$this->get('query',false);
		$tenant=$this->get('tenant',false);
		$job=$this->get('job',false);
		$innerJoin='';
		$criteria='';
		
		if($tenant != NULL && $tenant !='null'){
			$innerJoin.=' INNER JOIN u.tenant A ';
			$criteria.=' AND A.id='.$tenant;
		}else
			$criteria.=' AND u.tenant IS NULL';
		
		if($job != null && $job != null){
			$innerJoin.=' INNER JOIN u.job B ';
			$criteria.=' AND B.id='.$job;
		}
		
		$arr=array();
		$res=$common->createQuery("SELECT u FROM ".$common->getModel('Employee')." u
			".$innerJoin."
			WHERE (UPPER(u.firstName) LIKE UPPER('%".$text."%') or UPPER(u.lastName) LIKE UPPER('%".$text."%') or UPPER(u.idNumber) LIKE UPPER('%".$text."%'))
			AND u.activeFlag=true
			AND u.id NOT IN(SELECT e.id FROM ".$common->getModel('User')." i INNER JOIN i.employee e)
			".$criteria."
			 ORDER BY u.firstName ASC")
			 ->setMaxResults(10)
			 ->getResult();
		for($i=0,$iLen=count($res); $i<$iLen ; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=$country->getId();
			$o['text']=$country->getIdNumber().' - '.$country->getFirstName()." ".$country->getLastName();
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		$session = $this->pagesession;
		
		$pageType=$this->post('pageType');
		$pid=$this->post('pid');
		$tenantId=$this->post('tenant');
		
		$userCode=$this->post('userCode');
		$password=$this->post('password');
		$role=$this->post('role');
		$role=$common->find('Role',$role);
		$employee=$this->post('employee');
		$employee=$common->find('Employee',$employee);
		$activeFlag=$this->post('activeFlag');
		if($activeFlag=='true')
			$activeFlag=true;
		else
			$activeFlag=false;
		if($pageType=='ADD'){
			$res= $common->createQuery ( "SELECT M FROM ".$common->getModel('User')." M  WHERE M.userCode='" . $userCode . "' ");
			if (! $res->getResult ()) {
				$tenant=null;
				if($common->getTenantFlag()!=null){
					$tenant=$common->getUserTenant();
				}else if($tenantId != null){
					$tenant=$common->getTenant($tenantId);
				}
				$user=$common->newModel('User');
				$user->setUserCode($userCode)
					->setPassword(hash('md5',$password))
					->setTenant($tenant)
					->setFirstLogin(null)
					->setLastLogin(null)
					->setLoginFlag(false)
					->setEmployee($employee)
					->setRole($role)
					->setLanguage($common->getSystemProperty('DEFAULT_LANG',null)->getPropertyValue())
					->setCreateBy($common->getEmployee ())
					->setCreateOn($common->getDateTime ())
					->setUpdateBy($common->getEmployee ())
					->setUpdateOn($common->getDateTime ())
					->setActiveFlag($activeFlag)
					->save();
				$result->setMessageSave ('User Name', $userCode )->end ();
			}else
				$result->warning ()->setMessageExist ('User Name', $userCode )->end ();
		}else if($pageType=='UPDATE'){
			$res= $common->createQuery ( "SELECT M FROM ".$common->getModel('User')." M  WHERE M.userCode='" . $userCode . "' AND M.id != ".$pid);
			if (! $res->getResult ()) {
				$user=$common->find('User',$pid);
				if ($user != null) {
					$user->setUserCode($userCode)
						->setRole($role)
						->setUpdateBy($session->getUser ()->getEmployee ())
						->setUpdateOn($common->getDateTime ())
						->setActiveFlag($activeFlag)
						->update();
						$result->setMessageEdit ('User Name', $userCode )->end ();
				}else
					$result->error()->setMessageNotExist()->end();
			}else
				$result->warning ()->setMessageExist ('User Name', $userCode )->end ();
		}else if($pageType=='CHANGE'){
			$user=$common->find('User',$pid);
			if ($user != null) {
				$user->setPassword(hash('md5',$password))
					->setUpdateBy($session->getUser ()->getEmployee ())
					->setUpdateOn($common->getDateTime ())
					->update();
					$result->setMessageEdit ('User Name', $userCode )->end ();
			}else
				$result->error()->setMessageNotExist()->end();
		}
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		
		$pid= $this->post('pid');
		$code='';
		$res= $common->find('User',$pid);
		if ($res != null) {
			$code=$res->getUserCode();
			if($res->getLoginFlag()==false){
				$res->delete();
			}else{
				$result->error()->setMessage("User Name '".$code ."' currently logged, can not be removed.");
			}
		}else
			$result->error()->setMessageNotExist()->end();
		$result->setMessageDelete('User Name', $code )->end ();
	}
}
