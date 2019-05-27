<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Admin extends MY_controller {
	function __construct() {
		parent::__construct ();
	}
	public function index() {
		if ($this->pagesession->cek ())
			$this->load->view ( 'admin/main_admin' );
		else
			$this->load->view ( 'admin/login' );
	}
	public function getUser(){
		$common = $this->common;
		$result = $this->jsonresult;
		if ($this->pagesession->cek ()){
			$employee=$common->getEmployee();
			$data=array();
			$data['name']=$employee->getFirstName().' '.$employee->getLastName();
			$data['foto']=$employee->getFoto();
			$result->setData($data)->end();
		}else
			$result->session()->end();
	}
	public function saveProfile(){
		$common = $this->common;
		$result = $this->jsonresult;
		if ($this->pagesession->cek ()){
			$pid=$this->post('i');
			$firstName=$this->post('f2');
			$secondName=$this->post('f3');
			$lastName=$this->post('f4');
			$gender=$this->post('f5');
			$gender=$common->find('ParameterOption',$gender);
			$religion=$this->post('f6');
			if($religion !='')
				$religion=$common->find('ParameterOption',$religion);
			else
				$religion=null;
			$birthPlace=$this->post('f7');
			$common->setDynamicOption($birthPlace,'DYNAMIC_CITY');
			$birthDate=$this->post('f8');
			$address=$this->post('f9');
			$email=$this->post('f10');
			$phone1=$this->post('f11');
			$phone2=$this->post('f12');
			$fax1=$this->post('f13');
			$fax2=$this->post('f14');
			$foto=$this->post('f15');
			$employee=$common->find('Employee',$pid);
			if ($employee != null) {
				if($foto == null || $foto!='true')
					$employee->setFoto($common->uploadToFile($foto,'jpg',$employee->getFoto()));
				$employee->setFirstName($firstName)
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
					->update();
				$result->setMessageEdit ('ID Number', $employee->getIdNumber() )->end ();
			}else
				$result->error()->setMessageNotExist()->end();
		}else
			$result->session()->end();
	}
	public function saveUsername(){
		$common = $this->common;
		$result = $this->jsonresult;
		if ($this->pagesession->cek ()){
			$new=$this->post('f1');
			$old=$this->post('f2');
			$password=$this->post('f3');
			$data = $common->createQuery ( "SELECT A FROM ".$common->getModel('User')." A INNER JOIN A.employee B
					WHERE A.userCode='" . $old . "' " );
			if ($data->getResult ()) {
				$user = $data->getSingleResult ();
				if ($user->getPassword() == hash ( 'md5', $password )) {
					if($new != $old){
						$cek = $common->createQuery ( "SELECT A FROM ".$common->getModel('User')." A 
							WHERE A.userCode='" . $new . "'" );
						if(!$cek->getResult ()){
							$user->setUserCode($new)->update();
							$result->setMessage ('Successful User Name changed.')->end();
						}else
							$result->warning()->setMessage ('Username is not available.')->end();
					}else
						$result->warning()->setMessage ('New User names may not be the same as the Old User Name.')->end();
				}else
					$result->warning()->setMessage ('The contents of the old user name and password correctly .')->end();
			}else
				$result->warning()->setMessage ('The contents of the old user name and password correctly .')->end();
		}else
			$result->session()->end();
	}
	public function savePassword(){
		$common = $this->common;
		$result = $this->jsonresult;
		if ($this->pagesession->cek ()){
			$new=$this->post('f1');
			$userName=$this->post('f2');
			$old=$this->post('f3');
			$data = $common->createQuery ( "SELECT A FROM ".$common->getModel('User')." A INNER JOIN A.employee B
					WHERE A.userCode='" . $userName . "' " );
			if ($data->getResult ()) {
				$user = $data->getSingleResult ();
				if ($user->getPassword() == hash ( 'md5', $old )) {
					if($new != $old){
						$user->setPassword(hash ( 'md5', $new ))->update();
						$result->setMessage ('Successful Password changed.')->end();
					}else
						$result->warning()->setMessage ('New Password may not be the same as the Old Password.')->end();
				}else
					$result->warning()->setMessage ('The contents of the User Name and Old Password correctly.[1]')->end();
			}else
				$result->warning()->setMessage ('The contents of the User Name and Old Password correctly.[0]')->end();
		}else
			$result->session()->end();
	}
	public function getProfile(){
		$common = $this->common;
		$result = $this->jsonresult;
		if ($this->pagesession->cek ()){
			$pid=$this->get('i');
			$employee=$common->find('Employee',$pid);
			if($employee != null){
				$data=array();
				$data['l']=$common->getParams('GENDER');
				$data['l1']=$common->getParams('RELIGION');
				$o=array();
				$o['f1']=$employee->getIdNumber();
				$o['f2']=$employee->getFirstName();
				$o['f3']=$employee->getSecondName();
				$o['f4']=$employee->getLastName();
				$o['f5']=$employee->getGender()->getOptionCode();
				$o['f6']=$employee->getReligion()->getOptionCode();
				$o['f7']=$employee->getBirthPlace();
				$o['f8']=$employee->getBirthDate()->format('Y-m-d');
				$o['f9']=$employee->getAddress();
				$o['f10']=$employee->getEmailAddress();
				$o['f11']=$employee->getPhoneNumber1();
				$o['f12']=$employee->getPhoneNumber2();
				$o['f13']=$employee->getFaxNumber1();
				$o['f14']=$employee->getFaxNumber2();
				$o['f15'] =$employee->getFoto();
				$data['o']=$o;
				$result->setData($data)->end();
			}else
				$result->error()->setMessageNotExist()->end();
		}else
			$result->session()->end();
	}
	public function login() {
		$username=$this->post('username');
		$password=$this->post('password');
		$sMenu=$this->post('menu',false);
		$sTab=$this->post('tab',false);
		$em = $this->doctrine->em;
		$data = $em->createQuery ( "SELECT A FROM Entity\app\a7\User A INNER JOIN A.employee B
				WHERE A.userCode='" . $username . "' OR B.emailAddress='" . $username . "'" );
		if ($data->getResult ()) {
			$user = $data->getSingleResult ();
			if ($user->getPassword () == hash ( 'md5', $password )) {
				if ($user->getFirstLogin()==null)
					$user->setFirstLogin ($this->common->getDateTime ());
				$user->setLastLogin ( $this->common->getDateTime () )
					->setLoginFlag(true)
					->update ();
				$tenantFlag=null;
				$tenant=$user->getTenant();
				if($tenant!=null)
					$tenantFlag=$tenant->getId();
				$r=$user->getRole()->getRoleMenuList();
				$roleList=array();
				for($i=0, $iLen=count($r); $i<$iLen ; $i++){
					$rm=$r[$i];
					$m=$rm->getMenu();
					$o=array(
						'role' => $m->getMenuCommand(),
						'text' => $m->getMenuName()
					);
					$roleList[$m->getMenuCode()]=$o;
				}
				$tab=array();
				$menu=array();
				if($sTab != null)
					$tab=json_decode($sTab);
				if($sMenu != null)
					$menu=json_decode($sMenu);
				else
					$menu=$this->doMenu ( $user );
				$menu=$this->doMenu($user);
				$this->pagesession
					->setUser ( $user )
					->setUserCode($username)
					->setTab ($tab)
					->setMenu ($menu)
					->setTenantFlag($tenantFlag)
					->setRole($roleList);
			}else{
				$this->jsonresult->error ();
				$this->jsonresult->setMessage ('Login Gagal Isi Data dengan benar.');
			}
		}else{
			$this->jsonresult->error ();
			$this->jsonresult->setMessage ('Login Gagal Isi Data dengan benar.');
		}
		$this->jsonresult->end ();
	}
	public function setSession(){
		$common = $this->common;
		$pageSession = $this->pagesession;
		$qb = $this->doctrine->em->createQueryBuilder();
		$q = $qb->update($common->getModel('User'), 'u')
			->set('u.lastLogin',$qb->expr()->literal($common->getDateTime()->format('Y-m-d H:i:s')))
			->set('u.loginFlag', $qb->expr()->literal(true))
			->where("u.userCode = '".$pageSession->getUserCode()."' ")
			->getQuery();
		$p = $q->execute();
		$qb = $this->doctrine->em->createQueryBuilder();
		$form =new \DateTime('-15 minute');
		$q = $qb->update($common->getModel('User'), 'u')
			->set('u.loginFlag', $qb->expr()->literal(false))
			->where("u.lastLogin < ?1 ")
			->setParameter(1, $form->format('Y-m-d H:i:s'))
			->getQuery();
		$p = $q->execute();
		$this->jsonresult->end ();
	}
	public function getVar() {
		$common = $this->common;
		$result = $this->jsonresult;
		
		$vars = array ();
		$user = $this->pagesession->getUser ();
		$tId=null;
		if($common->getTenantFlag()!= null)
			$tId=$common->getTenantFlag();
		$emp=$user->getEmployee();
		$session = array (
			'i'=>$emp->getId(),
			'tab'=>$this->pagesession->getTab (),
			'userName'=>$user->getUserCode (),
			'fullName'=>$emp->getFirstName () . ' ' . $emp->getLastName (),
			'menu'=>$this->pagesession->getMenu (),
			'tenant'=>$tId
		);
		$vars ['session'] = $session;
		$this->jsonresult->setData ( $vars )->end ();
	}
	public function getMenuChild($menus, $roleMenus) {
		$res = array ();
		for($i = 0, $iLen=count ( $menus ); $i <$iLen ; $i ++) {
			for($j = 0,$jLen=count ( $roleMenus ); $j < $jLen; $j ++) {
				if ($menus [$i]->getId () == $roleMenus [$j]->getMenu ()->getId ()) {
					$menu = $menus [$i];
					$a = array ();
					$a ['text'] = $menu->getMenuName ();
					if ($menu->getMenuType ()->getOptionCode () == 'MENUTYPE_FOLDER') {
						$m = $this->getMenuChild ( $menu->getMenuList(), $roleMenus );
						if (count ( $m ) > 0)
							$a ['menu'] = array ('items' => $m );
					} else {
						$a ['code'] = $menu->getMenuCode ();
						$a ['role'] = $menu->getMenuCommand ();
						$a ['win'] = $menu->getWindow ();
						$a ['handler'] = 'loadMenu';
					}
					$res [] = $a;
				}
			}
		}
		return $res;
	}
	private function doMenu($user) {
		$em = $this->doctrine->em;
		$menus = $em->createQuery ( "SELECT M FROM Entity\app\a2\Menu M WHERE M.parent IS NULL" )->getResult ();
		$roleMenus = array ();
		for($i = 0; $i < count ( $user->getRole ()->getRoleMenuList () ); $i ++){
			$rms = $user->getRole()->getRoleMenus();
			$roleMenus [] = $rms [$i];
		}
		$res = array ();
		for($i = 0,$iLen=count ( $menus ); $i < $iLen; $i ++) {
			for($j = 0,$jLen=count ( $roleMenus ); $j < $jLen; $j ++) {
				if($menus [$i]->getId () == $roleMenus [$j]->getMenu ()->getId ()){
					$menu = $menus [$i];
					$a = array ();
					$a ['text'] = $menu->getMenuName ();
					if($menu->getMenuType ()->getOptionCode () == 'MENUTYPE_FOLDER'){
						$m = $this->getMenuChild ( $menu->getMenuList (), $roleMenus );
						if (count ( $m ) > 0) 
							$a ['menu'] = array ('items' => $m );
					}else{
						$a['code']=$menu->getMenuCode ();
						$a['role']=$menu->getMenuCommand ();
						$a['win']=$menu->getWindow ();
						$a['handler']='loadMenu';
					}
					$res [] = $a;
				}
			}
		}
		return $res;
	}
	public function delTab() {
		$code = $this->post ( 'code' );
		$tab = $this->pagesession->getTab ();
		for($i = 0,$iLen=count ( $tab ); $i < $iLen; $i ++) {
			if ($tab [$i]->code == $code) {
				array_splice ( $tab, $i, 1 );
				break;
			}
		}
		$this->pagesession->setTab ( $tab );
		$this->jsonresult->end ();
	}
	public function logout() {
		$common = $this->common;
		$common->getUser()
			->setLoginFlag(false)
			->update();
		$this->pagesession->destroy ();
		$this->jsonresult->end ();
	}
}