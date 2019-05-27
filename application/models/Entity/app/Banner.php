<?php
namespace Entity\app;
if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Banner Entity
 * @Entity
 * @Table(name="app_banner")
 * @author Asep Kamaludin <the_aska@yahoo.com>
 */
class Banner {
	/**
	 * @Id
	 * @Column(name="banner_id", type="decimal", nullable=false)
	 */
	protected $id;
	/**
	 * @Column(name="title", type="string",length=64, nullable=false)
	 */
	protected $title;
	/**
	 * @Column(name="banner", type="string",length=32, nullable=false)
	 */
	protected $banner;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getTitle(){
		return $this->title;
	}
	public function setTitle($title){
		$this->title = $title;
		return $this;
	}
	public function getBanner() {
		if($this->banner != null && $this->banner != '')
			return $this->banner;
		else
			return 'NO.GIF';
	}
	public function setBanner($banner) {
		$this->banner = $banner;
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