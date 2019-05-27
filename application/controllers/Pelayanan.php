<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Pelayanan extends CI_Controller {
	public function inforawatinap() {
		$this->load->view ( 'main', array ('p' => 'INFO_RAWAT_INAP' ) );
	}
	public function jadwaldokter() {
		$day = $this->common->getParams ( 'DAY' );
		$this->load->view ( 'main', array ('p' => 'JADWAL_DOKTER','DAY' => $day ) );
	}
	public function pelayananrs() {
		$this->load->view ( 'main', array ('p' => 'PELAYANAN_RS'));
	}
	public function artikels() {
		$this->load->view ( 'main', array ('p' => 'ARTIKELS') );
	}
	public function artikel() {
		$this->load->view ( 'main', array ('p' => 'ARTIKEL') );
	}
	public function profileDokter() {
		$this->load->view ( 'main', array ('p' => 'PELAYANAN_PROFILE_DOKTER' ) );
	}
	public function feedback() {
		$this->load->view ( 'main', array ('p' => 'FEED_BACK' ) );
	}
	public function promo() {
		$this->load->view ( 'main', array ('p' => 'PROMO') );
	}
	public function asuransi() {
		$this->load->view ( 'main', array ('p' => 'ASURANSI') );
	}
	public function simulasi() {
		$this->load->view ( 'main', array ('p' => 'SIMULASI'	) );
	}
	public function getSimulasi(){
		$pid=$this->input->get('i');
		$common=$this->common;
		$simulasi=$common->find('SimulasiPembayaran',$pid);
		if($simulasi != null){
			$this->jsonresult->setData($simulasi->getDeskripsi())->end();
		}else{
			$this->jsonresult->setData('Data Tidak Ada')->end();
		}
	}
	public function getAsuransi(){
		$common=$this->common;
		$em = $this->doctrine->em;
		$text=$this->input->get('text');
		$arr=array();
		$res=$em->createQuery("SELECT u FROM ".$common->getModel('SimulasiPembayaran')." u INNER JOIN u.customer A
		WHERE UPPER(A.customerName) LIKE UPPER('%".$text."%')
		 ORDER BY A.customerName ASC")
			 ->setMaxResults(10)
			 ->getResult();
		for($i=0; $i<count($res) ; $i++){
			$ori=$res[$i];
			$o=array();
			$o['id']=$ori->getId();
			$o['text']=$ori->getCustomer()->getCustomerName();
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function saveFeedback(){
		$common=$this->common;
		$email=$this->input->post('email');
		$nama=$this->input->post('nama');
		$deskripsi=$this->input->post('deskripsi');
		$kenyamanan=$this->input->post('kenyamanan');
		$keramahan=$this->input->post('keramahan');
		$keterjangkauan=$this->input->post('keterjangkauan');
		$kecepatan=$this->input->post('kecepatan');
		$telepon=$this->input->post('phone');
		$feedback=$this->common->newModel('Feedback');
		$feedback->setTanggalFeedback(new DateTime())
			->setEmail($email)
			->setNama($nama)
			->setDescription($deskripsi)
			->setRattingKenyamanan($kenyamanan)
			->setRattingKeramahan($keramahan)
			->setRattingKeterjangkauan($keterjangkauan)
			->setRattingKecepatan($kecepatan)
			->setTelepon($telepon)
			->setStatus($common->find('ParameterOption','FBSTATUS_NOT'))
			->save();
		$this->session->set('SUCCESS','Umpan Balik Telah Terkirim, Terima Kasih Atas Kepercayaan Pada Kami.');
		header('Location:'.base_url().'pelayanan/feedback');
	}
	public function searchRWI() {
		$em = $this->doctrine->em;
		$common = $this->common;
		$text = $this->input->get ( 'text' );
		$page = $this->input->get ( 'page' );
		$arr = array ();
		$arr ['items'] = array ();
		$query = "FROM " . $common->getModel ( 'PasienInap' ) . " A
			INNER JOIN A.visit B
			INNER JOIN B.patient C
			WHERE (UPPER(C.name) LIKE UPPER('%" . $text . "%') OR
			UPPER(C.patientCode) LIKE UPPER('%" . $text . "%'))
			ORDER BY C.name ASC";
		$total = $em->createQuery ( "SELECT count(A) AS total " . $query )->getSingleResult ();
		if ($page == 'last') {
			$page = $total ['total'];
		} else if ($page == 'first') {
			$page = 1;
		}
		$resQuery = $em->createQuery ( "SELECT A " . $query )->setFirstResult ( $page - 1 )->setMaxResults ( 20 );
		$res = $resQuery->getResult ();
		for($i = 0; $i < count ( $res ); $i ++) {
			$country = $res [$i];
			$o = array ();
			$o ['no_medrec'] = $country->getVisit ()->getPatient ()->getPatientCode ();
			$o ['nama'] = $country->getVisit ()->getPatient ()->getName ();
			$o ['no'] = $country->getKamar ()->getNamaKamar ();
			$arr ['items'] [] = $o;
		}
		$arr ['totalPages'] = ceil ( $total ['total'] / 20 );
		$arr ['currPage'] = $page;
		
		echo json_encode ( $arr );
	}
	public function searchCustomer() {
		$em = $this->doctrine->em;
		$common = $this->common;
		$text = $this->input->get ( 'text' );
		$page = $this->input->get ( 'page' );
		$arr = array ();
		$arr ['items'] = array ();
		$query = "FROM " . $common->getModel ( 'Kontraktor' ) . " A
			INNER JOIN A.customer B
			WHERE UPPER(B.customerName) LIKE UPPER('%" . $text . "%')
			ORDER BY B.customerName ASC";
		$total = $em->createQuery ( "SELECT count(A) AS total " . $query )->getSingleResult ();
		if ($page == 'last') {
			$page = $total ['total'];
		} else if ($page == 'first') {
			$page = 1;
		}
		$resQuery = $em->createQuery ( "SELECT A " . $query )->setFirstResult ( $page - 1 )->setMaxResults ( 20 );
		$res = $resQuery->getResult ();
		for($i = 0; $i < count ( $res ); $i ++) {
			$country = $res [$i];
			$o = array ();
			$o ['f1'] = $country->getCustomer()->getCustomerName();
			$o ['f2'] = $country->getJenisCust()->getOptionName();
			$arr ['items'] [] = $o;
		}
		$arr ['totalPages'] = ceil ( $total ['total'] / 20 );
		$arr ['currPage'] = $page;
	
		echo json_encode ( $arr );
	}
	public function searchJadwalDokter() {
		$em = $this->doctrine->em;
		$common = $this->common;
		$text = $this->input->get ( 'text' );
		$page = $this->input->get ( 'page' );
		$unit = $this->input->get ( 'unit' );
		$hari = $this->input->get ( 'hari' );
		$dokter = $this->input->get ( 'dokter' );
		$criteria = '';
		if ($unit != null && $unit != '') {
			if ($criteria == '') {
				$criteria .= ' WHERE ';
			} else {
				$criteria .= ' AND ';
			}
			$criteria .= ' C.id=' . $unit;
		}
		if ($hari != null && $hari != '') {
			if ($criteria == '') {
				$criteria .= ' WHERE ';
			} else {
				$criteria .= ' AND ';
			}
			$criteria .= " D.optionCode='" . $hari . "'";
		}
		if ($dokter != null && $dokter != '') {
			if ($criteria == '') {
				$criteria .= ' WHERE ';
			} else {
				$criteria .= ' AND ';
			}
			$criteria .= ' B.id=' . $dokter;
		}
		$arr = array ();
		$arr ['items'] = array ();
		
		$query = "FROM " . $common->getModel ( 'JadwalPoli' ) . " A
			INNER JOIN A.dokter B
			INNER JOIN A.unit C
			INNER JOIN A.hari D
			" . $criteria . "
			ORDER BY B.firstName, D.lineNumber,A.jam ASC";
		$total = $em->createQuery ( "SELECT count(A) AS total " . $query )->getSingleResult ();
		if ($page == 'last') {
			$page = $total ['total'];
		} else if ($page == 'first') {
			$page = 1;
		}
		$resQuery = $em->createQuery ( "SELECT A " . $query )->setFirstResult ( $page - 1 )->setMaxResults ( 20 );
		$res = $resQuery->getResult ();
		for($i = 0; $i < count ( $res ); $i ++) {
			$country = $res [$i];
			$o = array ();
			$o ['poli'] = $country->getUnit ()->getUnitName ();
			$o ['hari'] = $country->getHari ()->getOptionName () . " (" . $country->getJam ()->format ( 'H:m' ) . ")";
			$dokter=$country->getDokter ();
			$o ['dokter'] = '<a href="' . base_url () . 'pelayanan/profileDokter?dokter_id=' . $dokter->getId () . '">' . $dokter->getFirstName () . " " . $dokter->getLastName () . '</a>';
			$get = '?unit_id=' . $country->getUnit ()->getId () . '&unit_name=' . $country->getUnit ()->getUnitName () . '&dokter_id=' . $country->getDokter ()->getId () . '&dokter_name=' . $country->getDokter ()->getFirstName () . " " . $country->getDokter ()->getLastName ();
			$o ['btnDaftar'] = '<a href="' . base_url () . 'daftar' . $get . '" class="btn btn-success">Baru</a>&nbsp;<a href="' . base_url () . 'daftar/lama' . $get . '" class="btn btn-info">Lama</a>';
			$arr ['items'] [] = $o;
		}
		$arr ['totalPages'] = ceil ( $total ['total'] / 20 );
		$arr ['currPage'] = $page;
		
		echo json_encode ( $arr );
	}
	public function searchKamar() {
		$em = $this->doctrine->em;
		$common = $this->common;
		$page = $this->input->get ( 'page' );
		$unit = $this->input->get ( 'unit' );
		$criteria = '';
		if ($unit != null && $unit != '') {
			if ($criteria == '') {
				$criteria .= ' WHERE ';
			} else {
				$criteria .= ' AND ';
			}
			$criteria .= ' C.id=' . $unit;
		}
		$arr = array ();
		$arr ['items'] = array ();
	
		$query = "FROM " . $common->getModel ( 'Kamar' ) . " A
			INNER JOIN A.unit C
			" . $criteria . "
			ORDER BY A.namaKamar ASC";
		$total = $em->createQuery ( "SELECT count(A) AS total " . $query )->getSingleResult ();
		if ($page == 'last') {
			$page = $total ['total'];
		} else if ($page == 'first') {
			$page = 1;
		}
		$resQuery = $em->createQuery ( "SELECT A " . $query )->setFirstResult ( $page - 1 )->setMaxResults ( 20 );
		$res = $resQuery->getResult ();
		for($i = 0; $i < count ( $res ); $i ++) {
			$country = $res [$i];
			$o = array ();
			$o ['namaKamar'] = $country->getNamaKamar();
			$o ['jumlahKasur'] = $country->getJumlahBed()." Unit";
			$o ['sisa'] = ($country->getJumlahBed()-$country->getDigunakan())." Unit";
			$arr ['items'] [] = $o;
		}
		$arr ['totalPages'] = ceil ( $total ['total'] / 20 );
		$arr ['currPage'] = $page;
	
		echo json_encode ( $arr );
	}
}