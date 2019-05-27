<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Employee
class A5 extends MY_controller {
	public $MA='A5';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end ();
	}
	public function getById(){
		$common=$this->common;
		$pid=$this->get('i');
		$obj=$common->find('Employee',$pid);
		if($obj != null){
			$data=array();
			$data['f1']=$obj->getIdNumber();
			$data['f2']=$obj->getFirstName().' '.$obj->getLastName();
			$data['f3']=$obj->getBirthDate()->format('d/m/Y');
			$data['f4']=$obj->getBirthPlace();
			$data['f5']=$obj->getGender()->getOptionName();
			$religion=$obj->getReligion();
			if($religion != null){
				$data['f6']=$religion->getOptionName();
			}else{
				$data['f6']='';
			}
			$data['f7']=$obj->getAddress();
			$data['f8']=$obj->getEmailAddress();
			$data['f9']=$obj->getPhoneNumber1();
			$data['f10']=$obj->getFaxNumber1();
			$data['f11']=$obj->getFoto();
			$this->jsonresult->setData($data)->end();
		}else
			$result->error()->setMessageNotExist()->end();
	}
	public function initSearch(){
		$common = $this->common;
		$result = $this->jsonresult;
		$data=array();
		$data['l']=$common->getParams('ACTIVE_FLAG');
		$data['l1']=$common->getParams('GENDER');
		$result->setData($data)->end();
	}
	public function initAdd(){
		$common = $this->common;
		$data=array();
		$data['genderList']=$common->getParams('GENDER');
		$data['religionList']=$common->getParams('RELIGION');
		//job
		$jobs=array();
		if($common->getTenantFlag()==null){
			$data['tenantList']=$common->getTenants();
			$jobs=$common->createQuery ( "SELECT M FROM ".$common->getModel('Job')." M WHERE 
				M.activeFlag=true AND M.tenant is NULL ORDER BY M.jobName ASC" )->getResult();
		}else
			$jobs=$common->createQuery ( "SELECT M FROM ".$common->getModel('Job')." M INNER JOIN M.tenant A WHERE 
				M.activeFlag=true AND A.id=".$common->getTenantFlag()." ORDER BY M.jobName ASC" )->getResult();
		$jobList=array();
		for($i=0,$iLen=count($jobs); $i<$iLen ; $i++){
			$job=$jobs[$i];
			$jobObject=array();
			$jobObject['id']=$job->getId();
			$jobObject['text']=$job->getJobCode().' - '.$job->getJobName();
			$jobList[]=$jobObject;
		}
		$data['jobList']=$jobList;
		
		$this->jsonresult->setData($data)->end();
	}
	public function initTenant(){
		$common = $this->common;
		$pid=$this->get('pid');
		$data=array();
		//job
		if($pid != '')
			$jobs=$common->createQuery ( "SELECT M FROM ".$common->getModel('Job')." M INNER JOIN M.tenant A WHERE 
			M.activeFlag=true AND A.id=".$this->get('pid')." ORDER BY M.jobName ASC" )->getResult();
		else
			$jobs=$common->createQuery ( "SELECT M FROM ".$common->getModel('Job')." M WHERE 
			M.activeFlag=true AND M.tenant is NULL ORDER BY M.jobName ASC" )->getResult();
		$jobList=array();
		for($i=0,$iLen=count($jobs); $i< $iLen; $i++){
			$job=$jobs[$i];
			$jobObject=array();
			$jobObject['id']=$job->getId();
			$jobObject['text']=$job->getJobCode().' - '.$job->getJobName();
			$jobList[]=$jobObject;
		}
		$data['jobList']=$jobList;
		
		$this->jsonresult->setData($data)->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$pid=$this->get('pid');
		$employee=$common->find('Employee',$pid);
		if($employee != null){
			$data=array();
			$data['genderList']=$common->getParams('GENDER');
			$data['religionList']=$common->getParams('RELIGION');
			$jobs=array();
			if($employee->getTenant() != null)
				$jobs=$common->createQuery ( "SELECT M FROM ".$common->getModel('Job')." M INNER JOIN M.tenant A WHERE 
					M.activeFlag=true AND A.id=".$employee->getTenant()->getId()." ORDER BY M.jobName ASC" )->getResult();
			else
				$jobs=$common->createQuery ( "SELECT M FROM ".$common->getModel('Job')." M WHERE 
					M.activeFlag=true AND M.tenant is NULL ORDER BY M.jobName ASC" )->getResult();
			$jobList=array();
			for($i=0,$iLen=count($jobs); $i< $iLen; $i++){
				$job=$jobs[$i];
				$jobObject=array();
				$jobObject['id']=$job->getId();
				$jobObject['text']=$job->getJobCode().' - '.$job->getJobName();
				$jobList[]=$jobObject;
			}
			$data['jobList']=$jobList;
			
			$o=array();
			$o['idNumber']=$employee->getIdNumber();
			$oJob=$employee->getJob();
			if($oJob != null)
				$o['job']=$oJob->getId();
			else
				$o['job']=null;
			$o['firstName']=$employee->getFirstName();
			$o['secondName']=$employee->getSecondName();
			$o['lastName']=$employee->getLastName();
			$o['gender']=$employee->getGender()->getOptionCode();
			$religion=$employee->getReligion();
			if($religion != null){
				$o['religion']=$religion->getOptionCode();
			}else{
				$o['religion']=null;
			}
			$o['birthDate']=$employee->getBirthDate()->format('Y-m-d');
			$o['birthPlace']=$employee->getBirthPlace();
			$o['address']=$employee->getAddress();
			$o['foto'] =$employee->getFoto();
			$o['emailAddress']=$employee->getEmailAddress();
			$o['phoneNumber1']=$employee->getPhoneNumber1();
			$o['phoneNumber2']=$employee->getPhoneNumber2();
			$o['faxNumber1']=$employee->getFaxNumber1();
			$o['faxNumber2']=$employee->getFaxNumber2();
			$o['activeFlag']=$employee->getActiveFlag();
			$data['employee']=$o;
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
		
		$srchNumber=$this->get('f1');
		$srchName=$this->get('f2');
		$gender=$this->get('f3');
		$startDate=$this->get('f4');
		$endDate=$this->get('f5');
		$activeFlag=$this->get('f6');
		$job=$this->get('f7');
		$address=$this->get('f8');
		
		$entity=$common->getModel('Employee');
		
		$criteria="";
		$inner='';
		
		if(trim($srchNumber)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.idNumber) like upper('%".$srchNumber."%')";
		}
		if(trim($address)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.address) like upper('%".$address."%')";
		}
		if(trim($srchName)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" (upper(M.firstName) like upper('%".$srchName."%') OR upper(M.secondName) like upper('%".$srchName."%') OR upper(M.lastName) like upper('%".$srchName."%'))";
		}
		if(trim($gender)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$inner.='INNER JOIN M.gender A ';
			$criteria.=" A.optionCode='".$gender."'";
		}
		if(trim($job)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$inner.='INNER JOIN M.job B ';
			$criteria.=" B.jobName like'%".$job."%'";
		}
		if(trim($startDate)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$dateStart=new DateTime($startDate);
			$criteria.=" M.birthDate>='".$dateStart->format('Y-m-d')."' ";
		}
		if(trim($endDate)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$dateEnd=new DateTime($endDate);
			$criteria.=" M.birthDate<='".$dateEnd->format('Y-m-d')."' ";
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
			case "f2":
				$orderBy.='M.firstName '.$direction;
				break;
			case "f3":
				$orderBy.='M.gender '.$direction;
				break;
			case "f4":
				$orderBy.='M.birthDate '.$direction;
				break;
			case "f6":
				$orderBy.='M.job '.$direction;
				break;
			default:
				$orderBy.='M.idNumber '.$direction;
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
			$o['pid']=$r->getId();
			$o['f1']=$r->getIdNumber();
			$o['f3']=$r->getGender()->getOptionName();
			$o['f4']=$r->getBirthDate()->format('d M Y');
			$o['f2']='<a href="javascript:loadView(\'App.system.a5.View\','.$r->getId().')">'.$r->getFirstName()." ".$r->getLastName().'</a>';
			if($r->getJob() != null)
				$o['f6']=$r->getJob()->getJobName();
			else
				$o['f6']='-';
			$o['f5']=$r->getActiveFlag();
			$o['f7']=$r->getAddress();
			if($r->getTenant() != null)
				$o['t']=$r->getTenant()->getTenantName();
			else
				$o['t']='Owner';
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total['total'])->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pageType=$this->post('pageType');
		$pid=$this->post('pid');
		$tenantId=$this->post('tenant');
		
		$number=$this->post('number');
		$firstName=$this->post('firstName');
		$secondName=$this->post('secondName');
		$lastName=$this->post('lastName');
		$gender=$this->post('gender');
		$gender=$common->find('ParameterOption',$gender);
		$religion=$this->post('religion');
		if($religion !='')
			$religion=$common->find('ParameterOption',$religion);
		else
			$religion=null;
		$birthPlace=$this->post('birthPlace');
		$common->setDynamicOption($birthPlace,'DYNAMIC_CITY');
		$birthDate=$this->post('birthDate');
		$address=$this->post('address');
		$email=$this->post('email');
		$phone1=$this->post('phone1');
		$phone2=$this->post('phone2');
		$fax1=$this->post('fax1');
		$fax2=$this->post('fax2');
		$foto=$this->post('foto');
		$job=$this->post('job');
		$activeFlag=$this->post('activeFlag');
		if($activeFlag=='true')
			$activeFlag=true;
		else
			$activeFlag=false;
		if($job !='')
			$job=$common->find('Job',$job);
		else
			$job=null;
		if($pageType=='ADD'){
			$qTenant='';
			if($tenantId != null)
				$qTenant=" AND T.id=".$tenantId;
			else
				if($common->getTenantFlag()!=null)
					$qTenant=" AND T.id=".$common->getTenantFlag();	
				else
					$qTenant=" AND T.id is NULL";
			$res= $common->createQuery ( "SELECT M FROM ".$common->getModel('Employee')." M LEFT JOIN M.tenant T WHERE M.idNumber='" . $number . "' ".$qTenant);
			if (! $res->getResult ()) {
				$tenant=null;
				if($common->getTenantFlag()!=null)
					$tenant=$common->getUserTenant();
				else if($tenantId != null)
					$tenant=$common->getTenant($tenantId);
				$employee=$common->newModel('Employee');
				if($foto == null || $foto!='true')
					$employee->setFoto($common->uploadToFile($foto,'jpg'));
				$employee->setJob($job)
					->setIdNumber($number)
					->setTenant($tenant)
					->setFirstName($firstName)
					->setSecondName($secondName)
					->setLastName($lastName)
					->setGender($gender)
					->setReligion($religion)
					->setBirthDate(new DateTime($birthDate))
					->setBirthPlace($birthPlace)
					->setAddress($address)
					->setEmailAddress($email)
					->setPhoneNumber1($phone1)
					->setPhoneNumber2($phone2)
					->setFaxNumber1($fax1)
					->setFaxNumber2($fax2)
					->setCreateOn($common->getDateTime ())
					->setActiveFlag($activeFlag)
					->save();
				$result->setMessageSave ('ID Number', $number )->end ();
			}else
				$result->warning ()->setMessageExist ('ID Number', $number )->end ();
		}else{
			$employee=$common->find('Employee',$pid);
			if ($employee != null) {
				if($foto == null || $foto!='true')
					$employee->setFoto($common->uploadToFile($foto,'jpg',$employee->getFoto()));
				$employee->setJob($job)
					->setFirstName($firstName)
					->setSecondName($secondName)
					->setLastName($lastName)
					->setGender($gender)
					->setReligion($religion)
					->setBirthDate(new DateTime($birthDate))
					->setBirthPlace($birthPlace)
					->setAddress($address)
					->setEmailAddress($email)
					->setPhoneNumber1($phone1)
					->setPhoneNumber2($phone2)
					->setFaxNumber1($fax1)
					->setFaxNumber2($fax2)
					->setActiveFlag($activeFlag)
					->update();
			}else
				$result->error()->setMessageNotExist()->end();
			$result->setMessageEdit ('ID Number', $number )->end ();
		}
		echo json_encode($this->jsonresult);
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		$pid= $this->post('pid');
		$code='';
		$res= $common->find('Employee',$pid);
		$foto=null;
		if ($res != null) {
			$foto=$res->getFoto();
			$code=$res->getIdNumber();
			$res->delete();
		}else
			$result->error()->setMessageNotExist()->end();
		$common->uploadToFile(null,'jpg',$foto);
		$result->setMessageDelete('ID Number', $code )->end ();
	}
}
