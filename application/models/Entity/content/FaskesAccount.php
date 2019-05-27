<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * FaskesAccount Model
 * @Entity
 * @Table(name="rs_faskes_account")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class FaskesAccount {
	/**
	 * @Id
	 * @Column(name="faskes_account_id", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @ManyToOne(targetEntity="Entity\content\Faskes", cascade={"merge"})
	 * @JoinColumn(name="kd_faskes", referencedColumnName="kd_faskes" , nullable=false, onDelete="SET NULL")
	 */
	protected $faskes;
	/**
	 * @Column(name="account_name", type="string", length=32, nullable=false)
	 */
	protected $accountName;
	/**
	 * @Column(name="email", type="string", length=128, nullable=false)
	 */
	protected $email;
	/**
	 * @Column(name="user_name", type="string", length=64, nullable=false)
	 */
	protected $userName;
	/**
	 * @Column(name="password", type="string", length=32, nullable=false)
	 */
	protected $password;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getFaskes() {
		return $this->faskes;
	}
	public function setFaskes($faskes) {
		$this->faskes = $faskes;
		return $this;
	}
	public function getAccountName() {
		return $this->accountName;
	}
	public function setAccountName($accountName) {
		$this->accountName = $accountName;
		return $this;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	public function getUserName() {
		return $this->userName;
	}
	public function setUserName($userName) {
		$this->userName = $userName;
		return $this;
	}
	public function getPassword() {
		return $this->password;
	}
	public function setPassword($password) {
		$this->password = $password;
		return $this;
	}
	public function update() {
		$ci = & get_instance ();
		$ci->common->doctrineUpdate ( $this );
	}
	public function save() {
		$ci = & get_instance ();
		$ci->common->doctrineSave ( $this );
	}
	public function delete() {
		$ci = & get_instance ();
		$ci->common->doctrineDelete ( $this );
	}
}