<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class A12 extends MY_controller {
	public $MA = 'A12';
	public function getVar() {
		$lang = array ();
// 		$lang['menuCode']=lang('a2.menuCode');
// 		$lang['menuType']=lang('a2.menuType');
// 		$lang['program']=lang('a2.program');
// 		$lang['menuName']=lang('a2.menuName');
// 		$lang['menuCommand']=lang('a2.menuCommand');
// 		$lang['system']=lang('a2.system');
// 		$lang['window']=lang('a2.window');
// 		$lang['admin']=lang('a2.admin');
// 		$lang['menu']=lang('a2');
		$this->jsonresult->setData ( $lang )->end ();
	}
	public function getList() {
		$common = $this->common;
		$menus = $common->createQuery("SELECT M FROM ".$common->getModel('Menu')." M WHERE M.parent IS NULL" )->getResult ();
		$res = array();
		for($i=0;$i<count($menus);$i++){
			$menu = $menus [$i];
			$deleted = false;
			$a = array ();
			$a ['text'] = $menu->getMenuName () . ' (' . $menu->getMenuCode () . ')';
			$a ['menu_code'] = $menu->getMenuCode ();
			$a ['menu_type'] = $menu->getMenuType ()->getOptionCode ();
			if ($menu->getMenuType ()->getOptionCode () == 'MENUTYPE_FOLDER') {
				if (count ( $menu->getMenus () ) > 0) {
					$deleted = true;
					$a ['children'] = $this->getChild ( $menu->getMenus () );
					$a ['expanded'] = true;
				} else {
					$a ['children'] = array ();
				}
			} else {
				$a ['leaf'] = true;
			}
			if ($menu->getSystemFlag () == true) {
				$deleted = true;
			}
			$a ['deleted'] = $deleted;
			$res [] = $a;
		}
		$this->jsonresult->setData ( $res )->end ();
	}
	private function getChild($menus) {
		$res = array ();
		for($i = 0; $i < count ( $menus ); $i ++) {
			$menu = $menus [$i];
			$deleted = false;
			$a = array ();
			$a ['text'] = $menu->getMenuName () . ' (' . $menu->getMenuCode () . ')';
			$a ['menu_code'] = $menu->getMenuCode ();
			$a ['menu_type'] = $menu->getMenuType ()->getOptionCode ();
			if ($menu->getMenuType ()->getOptionCode () == 'MENUTYPE_FOLDER') {
				if (count ( $menu->getMenus () ) > 0) {
					$deleted = true;
					$a ['children'] = $this->getChild ( $menu->getMenus () );
				} else {
					$a ['children'] = array ();
				}
			} else {
				$a ['leaf'] = true;
			}
			if ($menu->getSystemFlag () == true) {
				$deleted = true;
			}
			$a ['deleted'] = $deleted;
			$res [] = $a;
		}
		return $res;
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pid = $this->get( 'pid' );
		$menuTypeList= $common->getParams ( 'MENU_TYPE' );
		$menuQuery = $common->createQuery ( "SELECT M FROM ".$common->getModel('Menu')." M WHERE M.menuCode='" . $pid  . "'" );
		if($menuQuery->getResult()){
			$menu=$menuQuery->getSingleResult();
			$arr=array();
			$arr['menuCode']=$menu->getMenuCode();
			$arr['menuName']=$menu->getMenuName();
			$arr['menuType']=$menu->getMenuType()->getOptionCode();
			$arr['menuCommand']=$menu->getMenuCommand();
			$arr['systemFlag']=$menu->getSystemFlag();
			$arr['activeFlag']=$menu->getActiveFlag();
			$arr['adminFlag']=$menu->getAdminFlag();
			$arr['windowFlag']=$menu->getWindow();
			$arr['child']=count($menu->getMenuList());
			$result->setData(array('menu'=>$arr,'menuTypeList'=>$menuTypeList))->end();
		}else{
			$result->error()->setMessageNotExist()->end();
		}
	}
	public function doInput() {
		$common = $this->common;
		$result = $this->jsonresult;
		$o = array ();
		$o ['menuTypeList'] = $common->getParams ( 'MENU_TYPE' );
		$result->setData ( $o )->end ();
	}
	public function save() {
		$common = $this->common;
		$result = $this->jsonresult;
		$menuType = $this->post ( 'menuType' );
		$menuCode = $this->post ( 'menuCode' );
		$menuName = $this->post ( 'menuName' );
		$pageType = $this->post ( 'pageType' );
		$systemFlag = $this->post ( 'systemFlag' );
		if($systemFlag=='true'){
			$systemFlag=true;
		}else{
			$systemFlag=false;
		}
		$activeFlag = $this->post ( 'activeFlag' );
		if($activeFlag=='true'){
			$activeFlag=true;
		}else{
			$activeFlag=false;
		}
		$adminFlag = $this->post ( 'adminFlag' );
		if($adminFlag=='true'){
			$adminFlag=true;
		}else{
			$adminFlag=false;
		}
		$menuCommand = $this->post ( 'menuCommand' );
		$windowFlag = $this->post ( 'windowFlag' );
		if($windowFlag=='true'){
			$windowFlag=true;
		}else{
			$windowFlag=false;
		}
		$parentCode = $this->post ( 'parentCode' );
		if($pageType=='ADD'){
			$menu = $common->createQuery ( "SELECT M FROM ".$common->getModel('Menu')." M WHERE M.menuCode='" . $menuCode . "'" );
			if (! $menu->getResult ()) {
				$parent = null;
				if ($parentCode != null) {
					$parent = $common->createQuery ( "SELECT M FROM ".$common->getModel('Menu')." M WHERE M.menuCode='" . $parentCode . "'" )->getSingleResult ();
				}
				$menu = $common->newModel('Menu');
				$menu->setMenuCode ( $menuCode )
					->setCreateBy ( $common->getEmployee () )
					->setUpdateBy ( $common->getEmployee () )
					->setMenuName ( $menuName )
					->setMenuCommand ($menuCommand)
					->setCreateOn ( $common->getDateTime () )
					->setMenuType ( $common->find ('ParameterOption', $menuType ) )
					->setParent ( $parent )
					->setUpdateOn ( $common->getDateTime () )
					->setWindow ($windowFlag)
					->setSystemFlag ($systemFlag)
					->setAdminFlag ($adminFlag)
					->setActiveFlag ($activeFlag)
					->save ();
				$result->setMessageSave ( lang ( 'a2.menuCode' ), $menuCode )->end ();
			} else {
				$result->warning ()->setMessageExist ( lang ( 'a2.menuCode' ), $menuCode )->end ();
			}
		}else if($pageType=='UPDATE'){
			$menuQuery = $common->createQuery ( "SELECT M FROM ".$common->getModel('Menu')." M WHERE M.menuCode='" . $menuCode . "'" );
			if ($menuQuery->getResult ()) {
				$menu = $menuQuery->getSingleResult();
				$menu->setUpdateBy ( $common->getEmployee () )
					->setMenuName ( $menuName )
					->setMenuCommand ($menuCommand)
					->setMenuType ( $common->find ('ParameterOption', $menuType ) )
					->setUpdateOn ( $common->getDateTime () )
					->setWindow ($windowFlag)
					->setSystemFlag ($systemFlag)
					->setAdminFlag ($adminFlag)
					->setActiveFlag ($activeFlag)
					->update ();
				$result->setMessageEdit ( lang ( 'a2.menuCode' ), $menuCode )->end ();
			} else {
				$result->error()->setMessageNotExist()->end();
			}
		}
	}
	public function delete() {
		$result = $this->jsonresult;
		$common = $this->common;
		$menuCode = $this->post ( 'menuCode' );
		$menu = $common->createQuery ( "SELECT M FROM ".$common->getModel('Menu')." M WHERE M.menuCode='" . $menuCode . "'" );
		if ($menu->getResult ()) {
			if ($menu->getSingleResult ()->getSystemFlag () == false) {
				$menu->getSingleResult ()->delete ();
			} else {
				$result->warning ()->setMessage (lang('main.block'))->end ();
			}
		} else {
			$result->error()->setMessageNotExist()->end();
		}
		$result->setMessageDelete ( lang ( 'a2.menuCode' ), $menuCode )->end ();
	}
}