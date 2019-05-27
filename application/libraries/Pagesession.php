<?php
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
class PageSession {
	protected $APP_USER='APP_USER';
	protected $APP_TAB='APP_TAB';
	protected $APP_MENU='APP_MENU';
	protected $APP_ROLE='APP_ROLE';
	protected $APP_TENANT_FLAG='APP_TENANT_FLAG';
	protected $APP_USER_CODE='APP_USER_CODE';
	public function getTab(){
		$ci = & get_instance();
		return json_decode($ci->session->get($this->APP_TAB));
	}
	public function setTab($tab) {
		$ci = & get_instance();
		$ci->session->set($this->APP_TAB,json_encode($tab));
		return $this;
	}
	public function getUserCode(){
		$ci = & get_instance();
		return $ci->session->get($this->APP_USER_CODE);
	}
	public function setUserCode($userCode) {
		$ci = & get_instance();
		$ci->session->set($this->APP_USER_CODE,$userCode);
		return $this;
	}
	public function getRole() {
		$ci = & get_instance ();
		return json_decode($ci->session->get($this->APP_ROLE),true);
	}
	public function setRole($role) {
		$ci = & get_instance ();
		$ci->session->set($this->APP_ROLE,json_encode($role));
		return $this;
	}
	public function getTenantFlag() {
		$ci = & get_instance();
		return $ci->session->get($this->APP_TENANT_FLAG);
	}
	public function setTenantFlag($tenant) {
		$ci = & get_instance();
		$ci->session->set($this->APP_TENANT_FLAG,$tenant);
		return $this;
	}
	public function getUser(){
		$ci = & get_instance();
		$em = $ci->doctrine->em;
		return $em->find('Entity\app\a7\User',$ci->session->get($this->APP_USER));
	}
	public function setUser($user) {
		$ci = & get_instance();
		$ci->session->set($this->APP_USER,$user->getId());
		return $this;
	}
	public function getMenu() {
		$ci = & get_instance();
		return json_decode($ci->session->get($this->APP_MENU));
	}
	public function setMenu($menu) {
		$ci = & get_instance ();
		$ci->session->set($this->APP_MENU,json_encode($menu));
		return $this;
	}
	public function cek() {
		$a = false;
		$ci = & get_instance ();
		if(isset($_SESSION[$this->APP_USER]) && $_SESSION[$this->APP_USER] != '')
			$a = true;
		return $a;
	}
	public function destroy() {
		$ci = & get_instance();
		$ci->session->delete( $this->APP_TAB )->delete($this->APP_MENU)->delete($this->APP_USER);
	}
}
?>