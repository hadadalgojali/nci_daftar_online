<?php
namespace Entity\content;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * FeedbAck Model
 * @Entity
 * @Table(name="rs_feedback")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Feedback {
	/**
	 * @Id
	 * @Column(name="id_feedback", type="decimal", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(name="tgl_feedback", type="datetime", nullable=false)
	 */
	protected $tanggalFeedback;
	/**
	 * @Column(name="email_pengirim", type="string", length=64, nullable=true)
	 */
	protected $email;
	/**
	 * @Column(name="telepon", type="string", length=16, nullable=false)
	 */
	protected $telepon;
	/**
	 * @Column(name="nama_pengirim", type="string", length=64, nullable=false)
	 */
	protected $nama;
	/**
	 * @Column(name="description", type="text", nullable=false)
	 */
	protected $description;
	/**
	 * @Column(name="ratting_kenyamanan", type="integer",length=1,  nullable=false)
	 */
	protected $rattingKenyamanan;
	/**
	 * @Column(name="ratting_keramahan", type="integer",length=1,  nullable=false)
	 */
	protected $rattingKeramahan;
	/**
	 * @Column(name="ratting_keterjangkauan", type="integer",length=1,  nullable=false)
	 */
	protected $rattingKeterjangkauan;
	/**
	 * @Column(name="ratting_kecepatan", type="integer",length=1,  nullable=false)
	 */
	protected $rattingKecepatan;
	/**
	 * @ManyToOne(targetEntity="Entity\app\a4\ParameterOption", cascade={"merge"})
	 * @JoinColumn(name="status", referencedColumnName="option_code" , nullable=false, onDelete="NO ACTION")
	 */
	protected $status;
	public function getTelepon(){
		return $this->telepon;
	}
	public function setTelepon($telepon){
		$this->telepon=$telepon;
		return $this;
	}
	public function getStatus(){
		return $this->status;
	}
	public function setStatus($status){
		$this->status=$status;
		return $this;
	}
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
		return $this;
	}
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$this->email = $email;
		return $this;
	}
	public function getTanggalFeedback(){
		return $this->tanggalFeedback;
	}
	public function setTanggalFeedback($tanggalFeedback){
		$this->tanggalFeedback = $tanggalFeedback;
		return $this;
	}
	public function getNama(){
		return $this->nama;
	}
	public function setNama($nama){
		$this->nama = $nama;
		return $this;
	}
	public function getDescription(){
		return $this->description;
	}
	public function setDescription($description){
		$this->description = $description;
		return $this;
	}
	public function getRattingKenyamanan(){
		return $this->rattingKenyamanan;
	}
	public function setRattingKenyamanan($rattingKenyamanan){
		$this->rattingKenyamanan = $rattingKenyamanan;
		return $this;
	}
	public function getRattingKeramahan(){
		return $this->rattingKeramahan;
	}
	public function setRattingKeramahan($rattingKeramahan){
		$this->rattingKeramahan = $rattingKeramahan;
		return $this;
	}
	public function getRattingKeterjangkauan(){
		return $this->rattingKeterjangkauan;
	}
	public function setRattingKeterjangkauan($rattingKeterjangkauan){
		$this->rattingKeterjangkauan = $rattingKeterjangkauan;
		return $this;
	}
	public function getRattingKecepatan(){
		return $this->rattingKecepatan;
	}
	public function setRattingKecepatan($rattingKecepatan){
		$this->rattingKecepatan = $rattingKecepatan;
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