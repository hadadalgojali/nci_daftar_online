<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Puskesmas extends CI_Controller {
	public function index() {
		$this->load->view ( 'main', array (
				'p' => 'PUSKESMAS' 
		) );
	}
	public function login() {
		$em = $this->doctrine->em;
		$common = $this->common;
		$kdFaskes = $this->input->post ( 'kdFaskes' );
		$username = $this->input->post ( 'email' );
		$password = $this->input->post ( 'password' );
		$faskesAccount = $em->createQuery ( "SELECT A FROM " . $common->getModel ( 'FaskesAccount' ) . " A 
		INNER JOIN A.faskes B
		WHERE
			A.email='" . $username . "' OR A.userName='" . $username . "' AND A.password='" . hash ( 'md5', $password ) . "' AND B.faskesCode='" . $kdFaskes . "'
		" );
		if ($faskesAccount->getResult ()) {
			$this->session->set ( 'PUSKESMAS', $faskesAccount->getSingleResult ()->getId () );
		} else {
			$this->session->set ( 'ERROR', 'Isi Data Dengan Benar.' );
		}
		header ( 'Location:' . base_url () . 'puskesmas/rujukan' );
	}
	public function logout() {
		$this->session->delete ( 'PUSKESMAS' );
		header ( 'Location:' . base_url () . 'puskesmas' );
	}
	public function daftar() {
		$this->load->view ( 'main', array (
				'p' => 'DAFTAR_FASKES' 
		) );
	}
	public function aktivasi() {
		$this->load->view ( 'main', array (
				'p' => 'AKTIVASI_FASKES' 
		) );
	}
	public function listRujukan() {
		$this->load->view ( 'main', array (
				'p' => 'LIST_RUJUKAN'
		) );
	}
	public function listRujukanBalik() {
		$this->load->view ( 'main', array (
				'p' => 'LIST_RUJUKAN_BALIK'
		) );
	}
	public function lihatPasien() {
		$this->load->view ( 'main', array (
				'p' => 'LIHAT_PASIEN'
		) );
	}
	public function lihatRujukan() {
		$this->load->view ( 'main', array (
				'p' => 'LIHAT_RUJUKAN'
		) );
	}
	public function rujukan() {
		$religion = $this->common->getParams ( 'RELIGION' );
		$blod = $this->common->getParams ( 'BLOD' );
		$edu = $this->common->getParams ( 'EDUCATION' );
		$this->load->view ( 'main', array (
				'p' => 'RUJUKAN',
				'RELIGION' => $religion,
				'BLOD' => $blod,
				'EDU' => $edu 
		) );
	}
	public function save(){
		$this->load->helper('captcha');
		$common=$this->common;
		if($this->input->post('captcha')!=null){
			if(strtolower($_SESSION['captcha'])!=strtolower($this->input->post('captcha'))){
				$this->session->set('ERROR','Isi Captcha dengan Benar.');
				$this->load->view('main',array('p'=>'DAFTAR_FASKES'));
			}else{
				$kdFaskes=$this->input->post('kdFaskes');
				$faskes=$common->find('Faskes',$kdFaskes);
				if($faskes == null){
					$faskes=$common->newModel('Faskes');
					$faskes->setFaskesCode($kdFaskes)
						->setFaskesName($this->input->post('nama'))
						->setAlamat($this->input->post('alamat'))
						->setTelp($this->input->post('telp'))
						->setKota($this->input->post('kota'))
						->setFax($this->input->post('fax'))
						->setEmail($this->input->post('email'))
						->setAccept(false)
						->save();
					$msg='';
					$msg.='Pendaftaran Faskes Berhasil.<br> Tunggu 2x24 Jam untuk Proses Verifikasi. Harap Cek Email Secara Berkala.<br>';
					$this->session->set('SUCCESS',$msg);
					header('Location:'.base_url().'puskesmas/daftar');
				}else{
					$this->session->set('ERROR',"Kode Faskes '".$kdFaskes."' sudah terdaftar.");
					$this->load->view('main',array('p'=>'DAFTAR_FASKES'));
				}
			}
		}else{
			header('Location:'.base_url().'puskesmas/daftar');
		}
	}
	public function rujukanBalik() {
		$religion = $this->common->getParams ( 'RELIGION' );
		$blod = $this->common->getParams ( 'BLOD' );
		$edu = $this->common->getParams ( 'EDUCATION' );
		$this->load->view ( 'main', array (
				'p' => 'RUJUKAN_BALIK',
				'RELIGION' => $religion,
				'BLOD' => $blod,
				'EDU' => $edu 
		) );
	}
	public function hapusRujukan(){
		$common=$this->common;
		$pid=$this->input->get('i');
		$rujukan=$common->find('Rujukan',$pid);
		$rujukan->setDeleteFlag(true)
			->update();
		$this->session->set ( 'SUCCESS', 'Rujukan berhasil dihapus.' );
		header('Location:'.base_url().'puskesmas/ListRujukan');
	}
	public function hapusRujukanBalik(){
		$common=$this->common;
		$pid=$this->input->get('i');
		$rujukan=$common->find('Rujukan',$pid);
		$rujukan->setDeleteBalikFlag(true)
			->update();
		$this->session->set ( 'SUCCESS', 'Rujukan Balik berhasil dihapus.' );
		header('Location:'.base_url().'puskesmas/ListRujukanBalik');
	}
	public function searchListRujukan(){
		$em = $this->doctrine->em;
		$common = $this->common;
		$text = $this->input->get ( 'text' );
		$page = $this->input->get ( 'page' );
		$arr = array ();
		$faskesAccount = $common->find ('FaskesAccount', $this->session->get ( 'PUSKESMAS' ) );
		$arr ['items'] = array ();
		//
		$query = "FROM " . $common->getModel ( 'Visit' ) . " A
			INNER JOIN A.rujukan B
			INNER JOIN B.faskes C
			WHERE C.faskesCode='".$faskesAccount->getFaskes()->getFaskesCode()."' AND
					UPPER(B.nomorRujukan) LIKE UPPER('%" . $text . "%') AND
					B.deleteFlag=false
			ORDER BY B.tanggalRujuk DESC";
		$total = $em->createQuery ( "SELECT count(A) AS total " . $query )->getSingleResult ();
		if ($page == 'last') {
			$page = $total ['total'];
		} else if ($page == 'first') {
			$page = 1;
		}
		$resQuery = $em->createQuery ( "SELECT A " . $query )->setFirstResult ( $page - 1 )->setMaxResults ( 20 );
		$res = $resQuery->getResult ();
		for($i = 0; $i < count ( $res ); $i ++) {
			$mod = $res [$i];
			$o = array ();
			$rujukan=$mod->getRujukan();
			$o ['f1'] = '<a href="'.base_url ().'puskesmas/lihatRujukan?i='.$rujukan->getNomorRujukan().'" >'.$rujukan->getNomorRujukan().'</a>';
			$o ['f2'] = $rujukan->getTanggalRujuk()->format('d M Y');
			$pasien=$rujukan->getPasien();
			$o ['f3'] = '<a href="'.base_url ().'puskesmas/lihatPasien?i='.$pasien->getId().'" >'.$pasien->getPatientCode().' - '.$pasien->getName().'</a>';
			$o ['f4'] = $rujukan->getStatusVerifikasi()->getOptionName();
			$o['f5']='<a href="' . base_url () . 'puskesmas/hapusRujukan?i=' . $rujukan->getNomorRujukan() . '" class="btn btn-info">Hapus</a>';
			$arr ['items'] [] = $o;
		}
		$arr ['totalPages'] = ceil ( $total ['total'] / 20 );
		$arr ['currPage'] = $page;
	
		echo json_encode ( $arr );
	}
	public function searchListRujukanBalik(){
		$em = $this->doctrine->em;
		$common = $this->common;
		$text = $this->input->get ( 'text' );
		$page = $this->input->get ( 'page' );
		$arr = array ();
		$faskesAccount = $common->find ('FaskesAccount', $this->session->get ( 'PUSKESMAS' ) );
		$arr ['items'] = array ();
		//
		$query = "FROM " . $common->getModel ( 'Visit' ) . " A
			INNER JOIN A.rujukan B
			INNER JOIN B.faskes C
			WHERE C.faskesCode='".$faskesAccount->getFaskes()->getFaskesCode()."' AND
					UPPER(B.nomorRujukan) LIKE UPPER('%" . $text . "%') AND
					B.rujukBalik=true AND
					B.deleteBalikFlag=false
			ORDER BY B.tanggalRujuk DESC";
		$total = $em->createQuery ( "SELECT count(A) AS total " . $query )->getSingleResult ();
		if ($page == 'last') {
			$page = $total ['total'];
		} else if ($page == 'first') {
			$page = 1;
		}
		$resQuery = $em->createQuery ( "SELECT A " . $query )->setFirstResult ( $page - 1 )->setMaxResults ( 20 );
		$res = $resQuery->getResult ();
		for($i = 0; $i < count ( $res ); $i ++) {
			$mod = $res [$i];
			$o = array ();
			$rujukan=$mod->getRujukan();
			$o ['f1'] = '<a href="'.base_url ().'puskesmas/lihatRujukan?i='.$rujukan->getNomorRujukan().'" >'.$rujukan->getNomorRujukan().'</a>';
			$o ['f2'] = $rujukan->getTanggalRujuk()->format('d M Y');
			$pasien=$rujukan->getPasien();
			$o ['f3'] = '<a href="'.base_url ().'puskesmas/lihatPasien?i='.$pasien->getId().'" >'.$pasien->getPatientCode().' - '.$pasien->getName().'</a>';
			$o['f4']='<a href="' . base_url () . 'puskesmas/hapusRujukanBalik?i=' . $rujukan->getNomorRujukan() . '" class="btn btn-info">Hapus</a>';
			$arr ['items'] [] = $o;
		}
		$arr ['totalPages'] = ceil ( $total ['total'] / 20 );
		$arr ['currPage'] = $page;
	
		echo json_encode ( $arr );
	}
// 	public function getDokter() {
// 		$em = $this->doctrine->em;
// 		$common = $this->common;
// 		$faskesAccount = $em->find ( $common->getModel ( 'FaskesAccount' ), $this->session->get ( 'PUSKESMAS' ) );
// 		$text = $this->input->get ( 'text' );
// 		$arr = array ();
		
// 		$res = $em->createQuery ( "SELECT u FROM " . $common->getModel ( 'FaskesDokter' ) . " u
// 		INNER JOIN u.faskes j
// 		WHERE 
// 		UPPER(u.dokterName) LIKE UPPER('%" . $text . "%')
// 		AND j.faskesCode='" . $faskesAccount->getFaskes ()->getFaskesCode () . "'
// 		 ORDER BY u.dokterName ASC" )->setMaxResults ( 10 )->getResult ();
		
// 		for($i = 0; $i < count ( $res ); $i ++) {
// 			$country = $res [$i];
// 			$o = array ();
// 			$o ['id'] = $country->getId ();
// 			$o ['text'] = $country->getDokterName ();
// 			$arr [] = $o;
// 		}
// 		$this->jsonresult->setData ( $arr )->end ();
// 	}
	public function getPenyakit() {
		$em = $this->doctrine->em;
		$text = $this->input->get ( 'text' );
		$status=$this->input->get('status');
		$subQuery="AND u.nonRujukanFlag=false";
		if($status != null && $status=='RJKSTAT_DARURAT'){
			$subQuery='';
		}
		$common = $this->common;
		$arr = array ();
		$res = $em->createQuery ( "SELECT u FROM " . $common->getModel ( 'Penyakit' ) . " u
		WHERE 
		(UPPER(u.penyakit) LIKE UPPER('%" . $text . "%') OR
		UPPER(u.kodePenyakit) LIKE UPPER('%" . $text . "%')) 
		".$subQuery."
		 ORDER BY u.penyakit ASC" )->setMaxResults ( 10 )->getResult ();
		for($i = 0; $i < count ( $res ); $i ++) {
			$country = $res [$i];
			$o = array ();
			$o ['id'] = $country->getKodePenyakit ();
			$o ['text'] = $country->getKodePenyakit () . " - " . $country->getPenyakit ();
			$arr [] = $o;
		}
		$this->jsonresult->setData ( $arr )->end ();
	}
	public function cetak(){
		$common=$this->common;
		$visit=$common->find('Visit',$this->input->get('i'));
		if($visit != null){
			$patient=$visit->getPatient();
			$dokter=$visit->getDokter();
			$rujukan=$visit->getRujukan();
			$faskes=$rujukan->getFaskes();
			$html='
				<style>
					.value{
						font-family:courier !important;
					}
				</style>
				<div style="position:fixed;top: 0px; left: 0px; right: 0px;">
					<img src="include/header3.PNG" style="width: 100%;">
				</div>
				<div class="header"><center>STRUK RUJUKAN ONLINE</center></div>
				<table>
					<tr>
						<th colspan="6" align="left"><u>Faskes</u></th>
					</tr>
					<tr>
						<td width="100" align="left">
							 Puskesmas
						</td>
						<td width="10">:</td>
						<td width="200" class="value">'.$faskes->getFaskesName().'</td>
						<td width="50">
							 Kode Faskes
						</td>
						<td width="10">:</td>
						<td class="value">'.$faskes->getFaskesCode().'</td>
					</tr>
					<tr>
						<td width="100">
							 Kota
						</td>
						<td width="10">:</td>
						<td  class="value">'.$faskes->getKota().'</td>
					</tr>
					<tr>
						<th colspan="6" align="left">
							 <u>Data Pasien</u>
						</th>
					</tr>
					<tr>
						<td width="100">
							 Nomor Medrec
						</td>
						<td width="10">:</td>
						<td class="value">'.$patient->getPatientCode().'</td>
					</tr>
					<tr>
						<td width="100">
							 Nomor KTP
						</td>
						<td width="10">:</td>
						<td class="value">'.$patient->getKtp().'</td>
					</tr>
					<tr>
						<td width="100">
							 Nama Pasien
						</td>
						<td width="10">:</td>
						<td class="value">'.$patient->getName().'</td>
						<td width="50">
							 J. Kelamin
						</td>
						<td width="10">:</td>
						<td class="value">'.$patient->getGender()->getOptionName().'</td>
					</tr>
					<tr>
						<td width="100">
							 Tanggal Lahir
						</td>
						<td width="10">:</td>
						<td width="200" class="value">'.$patient->getBirthDate()->format('d M Y').'</td>
						<td width="50">
							 Umur
						</td>
						<td width="10">:</td>
						<td class="value">'.$rujukan->getUmur().' Tahun</td>
					</tr>
					<tr>
						<th colspan="6" align="left">
							 <u>Data Kunjungan</u>
						</th>
					</tr>
					<tr>
						<td width="100">
							 Nomor Pendaftaran
						</td>
						<td width="10">:</td>
						<td class="value"><b>'.$visit->getNomorPendaftaran().'</b></td>
					</tr>
					<tr>
						<td width="100">
							 Poliklinik
						</td>
						<td width="10">:</td>
						<td class="value">'.$visit->getUnit()->getUnitName().'</td>
					</tr>
					<tr>
						<td width="100">
							 Dokter
						</td>
						<td width="10">:</td>
						<td class="value">'.$dokter->getFirstName().' '.$dokter->getLastName().'</td>
					</tr>
					<tr>
						<td width="100">
							 Tanggal Berobat
						</td>
						<td width="10">:</td>
						<td class="value">'.$visit->getEntryDate()->format('d M Y').'</td>
					</tr>
					<tr>
						<td width="100">
							 Nomor Antrian
						</td>
						<td width="10">:</td>
						<td class="value">'.$visit->getAntrian().'</td>
					</tr>
					<tr>
						<th colspan="6" align="left">
							 <u>Data Rujukan</u>
						</th>
					</tr>
					<tr>
						<td width="100">
							 Nomor Rujukan
						</td>
						<td width="10">:</td>
						<td class="value"><b>'.$rujukan->getNomorRujukan().'</b></td>
					</tr>
					<tr>
						<td width="100">
							 No. Peserta BPJS
						</td>
						<td width="10">:</td>
						<td class="value">'.$rujukan->getNomorBpjs().'</td>
					</tr>
					<tr>
						<td width="100">
							 Status Rujukan
						</td>
						<td width="10">:</td>
						<td class="value">'.$rujukan->getStatus()->getOptionName().'</td>
					</tr>
					<tr>
						<td width="100">
							 Diagnosa
						</td>
						<td width="10">:</td>
						<td class="value" colspan="4">'.$rujukan->getPenyakit()->getPenyakit().'</td>
					</tr>
					<tr>
						<td width="100">
							 Dokter Perujuk
						</td>
						<td width="10">:</td>
						<td class="value" colspan="4">'.$rujukan->getFaskesDokter().'</td>
					</tr>
					<tr>
						<td colspan="6">Tindakan yang telah diberikan :</td>
					</tr>
					<tr>
						<td colspan="6" class="value" >'.$rujukan->getTindakan().'</td>
					</tr>
					<tr>
						<td colspan="6">Obat yang telah diberikan :</td>
					</tr>
					<tr>
						<td colspan="6" class="value" >'.$rujukan->getObat().'</td>
					</tr>
					<tr>
						<td colspan="6">Pemeriksaan Penunjang Telah DiBerikan :</td>
					</tr>
					<tr>
						<td colspan="6" class="value" >'.$rujukan->getPenunjang().'</td>
					</tr>
					<tr>
						<td colspan="6">Catatan :</td>
					</tr>
					<tr>
						<td colspan="6" class="value" >'.$rujukan->getCatatan().'</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">*) - Konfirmasikan Nomor Pendaftaran pada tanda bukti ini kepada petugas rumah sakit.</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;&nbsp;&nbsp;- Jadwal Dokter Sewaktu-waktu dapat berubah.</td>
					</tr>
				</table>
		';
			pdf(array('html'=>$html,'margin-top'=>100,'margin-bottom'=>50));
		}else{
			echo 'Data Not Found';
		}
	}
	public function saveRujukan() {
		$em = $this->doctrine->em;
		$this->load->helper ( 'captcha' );
		$common = $this->common;
		$religion = $common->getParams ( 'RELIGION' );
		$blod = $common->getParams ( 'BLOD' );
		$edu = $common->getParams ( 'EDUCATION' );
		$faskesAccount = $common->find ('FaskesAccount', $this->session->get ( 'PUSKESMAS' ) );
		$seq = $common->getNextSequence ( 'RUJUKAN', null, array (
				$faskesAccount->getFaskes ()->getFaskesCode () 
		) );
		$noRujukan = $seq ['val'];
		$next=true;
		if($this->input->post('noRujukan') != $noRujukan){
			$noRujukan=$this->input->post('noRujukan');
			$next=false;
		}
		$error = false;
		$erorMessage = '';
		if ($this->input->post ( 'negara' ) == '') {
			$erorMessage .= '&nbsp; &bull; Harap Pilih Negara.<br>';
			$error = true;
		}
		if ($this->input->post ( 'provinsi' ) == '') {
			$erorMessage .= '&nbsp; &bull; Harap Pilih Provinsi.<br>';
			$error = true;
		}
		if ($this->input->post ( 'kota' ) == '') {
			$erorMessage .= '&nbsp; &bull; Harap Pilih Kota.<br>';
			$error = true;
		}
		if ($this->input->post ( 'kecamatan' ) == '') {
			$erorMessage .= '&nbsp; &bull; Harap Pilih Kecamatan.<br>';
			$error = true;
		}
		if ($this->input->post ( 'kelurahan' ) == '') {
			$erorMessage .= '&nbsp; &bull; Harap Pilih Kelurahan.<br>';
			$error = true;
		}
		if ($this->input->post ( 'dokter' ) == '') {
			$erorMessage .= '&nbsp; &bull; Harap Pilih Dokter.<br>';
			$error = true;
		}
		if ($this->input->post ( 'poliklinik' ) == '') {
			$erorMessage .= '&nbsp; &bull; Harap Pilih Poliklinik.<br>';
			$error = true;
		}
		if ($this->input->post ( 'penyakit' ) == '') {
			$erorMessage .= '&nbsp; &bull; Harap Pilih Diagnosa ICDX.<br>';
			$error = true;
		}
		if ($error == false) {
			$tglReg = new DateTime ( $this->input->post ( 'tglReg' ) );
			$now = new DateTime ();
			if (strtotime ( $tglReg->format ( 'Y-m-d' ) ) >= strtotime ( $now->format ( 'Y-m-d' ) )) {
				
				$codeHari = '';
				$namaHari = '';
				if ($tglReg->format ( 'D' ) == 'Mon') {
					$codeHari = 'DAY_1';
					$namaHari = 'Senin';
				} else if ($tglReg->format ( 'D' ) == 'Tue') {
					$codeHari = 'DAY_2';
					$namaHari = 'Selasa';
				} else if ($tglReg->format ( 'D' ) == 'Wed') {
					$codeHari = 'DAY_3';
					$namaHari = 'Rabu';
				} else if ($tglReg->format ( 'D' ) == 'Thu') {
					$codeHari = 'DAY_4';
					$namaHari = 'Kamis';
				} else if ($tglReg->format ( 'D' ) == 'Fri') {
					$codeHari = 'DAY_5';
					$namaHari = 'Jumat';
				} else if ($tglReg->format ( 'D' ) == 'Sat') {
					$codeHari = 'DAY_6';
					$namaHari = 'Sabtu';
				} else {
					$codeHari = 'DAY_7';
					$namaHari = 'Minggu';
				}
				$jadwal = $common->createQuery ( "SELECT u FROM " . $common->getModel ( 'JadwalPoli' ) . " u 
					INNER JOIN u.unit A
					INNER JOIN u.dokter B
					INNER JOIN u.hari C
					WHERE 
					A.id=" . $this->input->post ( 'poliklinik' ) . " AND 
					C.optionCode='" . $codeHari . "' AND 
					B.id=" . $this->input->post ( 'dokter' ) . "
					ORDER BY u.jam ASC" )->getResult ();
				$ObjectAntrian = $common->createQuery ( "SELECT u FROM " . $common->getModel ( 'Antrian' ) . " u 
					INNER JOIN u.unit A
					INNER JOIN u.dokter B
					WHERE 
					u.tglMasuk='" . $tglReg->format ( 'Y-m-d' ) . "' AND 
					A.id=" . $this->input->post ( 'poliklinik' ) . " AND 
					B.id=" . $this->input->post ( 'dokter' ) );
				if ($jadwal) {
					$code = '';
					$jumlah = 0;
					for($i = 0,$iLen=count ( $jadwal ); $i <$iLen ; $i ++) {
						$jumlah += $jadwal [$i]->getMaxAntrian ();
					}
					if (! $ObjectAntrian->getResult () || ($jumlah > $ObjectAntrian->getSingleResult ()->getAntrian ())) {
						$patient = $common->newModel('Patient');
						if ($this->input->post ( 'jp' ) == 'LAMA') {
							$patient = $common->find ('Patient' , $this->input->post ( 'rm' ) );
						}
						$antri = 1;
						$countryTemp=null;
						if($this->input->post('negara')==0){
							if($patient->getCountryTemp() != null){
								$countryTemp=$patient->getCountryTemp();
								$countryTemp->setValue($this->input->post('lainNegara'))
								->update();
							}else{
								$countryTemp=$common->newModel('Temp');
								$countryTemp->setValue($this->input->post('lainNegara'))
								->save();
							}
						}
						$provinceTemp=null;
						if($this->input->post('provinsi')==0){
							if($patient->getProvinceTemp() != null){
								$provinceTemp=$patient->getProvinceTemp();
								$provinceTemp->setValue($this->input->post('lainProvinsi'))
								->update();
							}else{
								$provinceTemp=$common->newModel('Temp');
								$provinceTemp->setValue($this->input->post('lainProvinsi'))
								->save();
							}
						}
						$districtTemp=null;
						if($this->input->post('kota')==0){
							if($patient->getDistrictTemp() != null){
								$districtTemp=$patient->getDistrictTemp();
								$districtTemp->setValue($this->input->post('lainKota'))
								->update();
							}else{
								$districtTemp=$common->newModel('Temp');
								$districtTemp->setValue($this->input->post('lainKota'))
								->save();
							}
						}
						$districtsTemp=null;
						if($this->input->post('kecamatan')==0){
							if($patient->getDistrictsTemp() != null){
								$districtsTemp=$patient->getDistrictsTemp();
								$districtsTemp->setValue($this->input->post('lainKecamatan'))
								->update();
							}else{
								$districtsTemp=$common->newModel('Temp');
								$districtsTemp->setValue($this->input->post('lainKecamatan'))
								->save();
							}
						}
						$kelurahanTemp=null;
						if($this->input->post('kelurahan')==0){
							if($patient->getKelurahanTemp() != null){
								$kelurahanTemp=$patient->getKelurahanTemp();
								$kelurahanTemp->setValue($this->input->post('lainKelurahan'))
								->update();
							}else{
								$kelurahanTemp=$common->newModel('Temp');
								$kelurahanTemp->setValue($this->input->post('lainKelurahan'))
								->save();
							}
						}
						$patient->setTitle ( $this->input->post ( 'gelar' ) )
							->setName ( $this->input->post ( 'nama' ) )
							->setBirthPlace ( $this->input->post ( 'tempatLahir' ) )
							->setBirthDate ( new \DateTime ( $this->input->post ( 'tgllahir' ) ) )
							->setGender ( $common->find ('ParameterOption' , $this->input->post ( 'jk' ) ) )
							->setReligion ( $common->find ('ParameterOption' , $this->input->post ( 'agama' ) ) )
							->setBlod ( $common->find ('ParameterOption' , $this->input->post ( 'goldar' ) ) )
							->setEdu ( $common->find ('ParameterOption' , $this->input->post ( 'education' ) ) )
							->setAddress ( $this->input->post ( 'alamat' ) )
							->setRt ( $this->input->post ( 'rt' ) )
							->setKtp($this->input->post('ktp'))
							->setRw ( $this->input->post ( 'rw' ) )
							->setPhoneNumber($this->input->post('telepon'))
							->setCountry($common->find ( 'Country', $this->input->post('negara') ))
							->setCountryTemp($countryTemp)
							->setProvince($common->find ( 'Province', $this->input->post('provinsi') ))
							->setProvinceTemp($provinceTemp)
							->setDistrict($common->find ( 'District', $this->input->post('kota') ))
							->setDistrictTemp($districtTemp)
							->setDistricts($common->find ( 'Districts', $this->input->post('kecamatan') ))
							->setDistrictsTemp($districtsTemp)
							->setKelurahan($common->find ( 'Kelurahan', $this->input->post('kelurahan') ))
							->setKelurahanTemp($kelurahanTemp)
							->setPostalCode($this->input->post('kdpos'));
						if ($this->input->post ( 'jp' ) == 'BARU') {
							$seq = $this->common->getNextSequence ( 'MEDREC' );
							$code = $seq ['val'];
							$patient->setPatientCode ( $code )
								->save ();
							$this->common->nextSequence ( 'MEDREC' );
						} else {
							$code = $patient->getPatientCode ();
							$patient->update ();
						}
						
						$rujukan = $common->newModel ( 'Rujukan' );
						$rujukan->setNomorRujukan ( $noRujukan )
							->setPasien ($patient)
							->setRujukBalik(false)
							->setFaskes ( $faskesAccount->getFaskes () )
							->setTanggalRujuk ( new \DateTime ( $this->input->post ( 'tglReg' ) ) )
							->setFaskesDokter ($this->input->post ( 'dokterFaskes' ) )
							->setPenyakit ( $common->find ('Penyakit' , $this->input->post ( 'penyakit' ) ) )
							->setTindakan ( $this->input->post ( 'tindakan' ) )
							->setObat ( $this->input->post ( 'obat' ) )
							->setStatus($common->find('ParameterOption',$this->input->post ( 'sr' )))
							->setUmur ( $this->input->post ( 'umur' ) )
							->setDeleteFlag(false)
							->setDeleteBalikFlag(false)
							->setStatusVerifikasi ($common->find('ParameterOption','STATRUJ_NONE' ))
							->setPenjamin ( $this->input->post ( 'penjamin' ) )
							->setNomorBpjs ( $this->input->post ( 'noBpjs' ) )
							->setCatatan ( $this->input->post ( 'catatan' ) )
							->setPenunjang ( $this->input->post ( 'penunjang' ) )->save ();
						if($next==true){
							$common->nextSequence ( 'RUJUKAN', null, array (
									$faskesAccount->getFaskes ()->getFaskesCode ()
							) );
						}
						
						$poliklinik = $common->find ('Unit', $this->input->post ( 'poliklinik' ) );
						$dokter = $common->find ('Employee', $this->input->post ( 'dokter' ) );
						if ($ObjectAntrian->getResult ()) {
							$antrian = $ObjectAntrian->getSingleResult ();
							$antri = $antrian->getAntrian () + 1;
							$antrian->setAntrian ( $antri )->update ();
						} else {
							$antrian = $common->newModel ( 'Antrian' );
							$antrian->setTglMasuk ( new \DateTime ( $this->input->post ( 'tglReg' ) ) )
								->setUnit ( $poliklinik )
								->setDokter ( $dokter )
								->setAntrian ( $antri )
								->save ();
						}
						$visit = $common->newModel ( 'Visit' );
						$tglReg=new \DateTime ( $this->input->post ( 'tglReg' ) );
						$resultVisit=$common->createQuery("SELECT A FROM ".$common->getModel('Visit')." A INNER JOIN
								A.unit B INNER JOIN
								A.dokter C INNER JOIN 
								A.patient D WHERE 
								A.entryDate='".$tglReg->format('Y-m-d')."' AND 
								B.id=".$this->input->post ( 'poliklinik' )." AND 
								C.id=".$this->input->post ( 'dokter' )." AND 
								D.id=".$patient->getId())->getResult();
						$urutKunjungan=count($resultVisit)+1;
						$defaultTenant=$common->getSystemProperty('DEFAULT_TENANT', null)->getPropertyValue();
						$seq=$this->common->getNextSequence('DAFTAR_ONLINE',$defaultTenant);
						$codeReg=$seq['val'];
						$idBpjs=$common->getSystemProperty('CUS_BPJS', $defaultTenant)->getPropertyValue();;
						$visit->setUnit ( $poliklinik )
							->setEntryDate ( new \DateTime ( $this->input->post ( 'tglReg' ) ) )
							->setEntrySeq ( $urutKunjungan )
							->setDokter ( $dokter )
							->setAntrian ( $antri )
							->setRujukan($rujukan)
							->setPatient ( $patient )
							->setPenyakit( $common->find ('Penyakit' , $this->input->post ( 'penyakit' ) ) )
							->setNomorPendaftaran($codeReg)
							->setJenisDaftar($common->find ( 'ParameterOption', 'JNSDFTR_RUJUKAN' ))
							->setNomorPeserta( $this->input->post ( 'noBpjs' ) )
							->setCustomer($common->find ( 'Customer',$idBpjs ))
							->setStatus ( false )
							->setHadir(false)
							->setNomorPendaftaran($codeReg);
						if ($this->input->post ( 'jp' ) == 'BARU') {	
							$visit->setBaru(true);
						}else{
							$visit->setBaru(false);
						}
						$visit->save ();
							
						$this->common->nextSequence('DAFTAR_ONLINE',$defaultTenant);
						$jam = null;
						$last = 0;
						if ($ObjectAntrian->getResult ()) {
							$last = $ObjectAntrian->getSingleResult ()->getAntrian ()-1;
						}
						if (strtotime ( $tglReg->format ( 'Y-m-d' ) ) > strtotime ( $now->format ( 'Y-m-d' ) ) || (strtotime ( $tglReg->format ( 'Y-m-d' ) ) == strtotime ( $now->format ( 'Y-m-d' ) ) && strtotime ( $now->format ( 'H:i:s' ) ) < strtotime ( $jadwal [0]->getJam ()->format ( 'H:i:s' ) ))) {
							for($i = 0,$iLen=count ( $jadwal ); $i <$iLen ; $i ++) {
								if ($last < $jadwal [$i]->getMaxAntrian ()) {
									$jam = date_create ( $jadwal [$i]->getJam ()->format ( 'h:i:s' ) );
									date_add ( $jam, date_interval_create_from_date_string ( ($last * $jadwal [$i]->getDuration ()) . ' minutes' ) );
									break;
								} else {
									$last -= $jadwal [$i]->getMaxAntrian ();
								}
							}
						} else {
							if (strtotime ( $jadwal [0]->getJam ()->format ( 'H:i:s' ) ) < strtotime ( $now->format ( 'H:i:s' ) )) {
								$jam = date_create ( $now->format ( 'H:i:s' ) );
								date_add ( $jam, date_interval_create_from_date_string ( ($last * $jadwal [0]->getDuration ()) . ' minutes' ) );
							}
						}
						$msg = '';
						$msg .= 'Pendaftaran Berhasil.<br> Harap Catan Nomor Pendaftaran dibawah ini untuk kunjungan Rumah Sakit:<br>';
						$msg.='<b><h3>'.$codeReg.'</h3></b><br>';
						$msg.='Atas :<br>';
						$msg .= '&bull; Nama : ' . $this->input->post ( 'gelar' ) . '. ' . $this->input->post ( 'nama' ) . '<br>';
						$msg .= '&bull; No. Rujukan : ' . $noRujukan . '<br>';
						$msg .= '&bull; No. Medrec : ' . $code . '<br>';
						$msg .= '&bull; No. Antrian : ' . $antri . '<br>';
						$msg .= '&bull; Hari/Tanggal : ' . $namaHari . ', ' . $tglReg->format ( 'd-m-Y' ) . '<br>';
						$msg .= '&bull; Prakiraan Waktu : ' . date_format ( $jam, 'H:i:s' ) . '<br>';
						$msg .= '&bull; Poli Klinik : ' . $poliklinik->getUnitName () . '<br>';
						$msg .= '&bull; Nama Dokter : ' . $dokter->getFirstName () . ' ' . $dokter->getLastName () . '<br><br>';
						$msg.='<a href="javascript:window.open(\''.base_url().'puskesmas/cetak?i='.$visit->getId().'\');" >Cetak Struk Rujukan</a>';
						$this->session->set ( 'SUCCESS', $msg );
						$this->common->nextSequence ( 'MEDREC' );
						header ( 'Location:' . base_url () . 'puskesmas/rujukan' );
					} else {
						$this->session->set ( 'ERROR', 'Pendaftaran Gagal, Poliklinik: ' . $this->input->post ( 'hiddenPoliklinik' ) . ', Dokter : ' . $this->input->post ( 'hiddenDokter' ) . ', Tanggal : ' . $tglReg->format ( 'd-m-Y' ) . ' Antrian Sudah Penuh. Harap Pilih Tanggal Jadwal Yang Lain.' );
						$this->load->view ( 'main', array (
								'p' => 'RUJUKAN',
								'RELIGION' => $religion,
								'BLOD' => $blod,
								'EDU' => $edu 
						) );
					}
				} else {
					$this->session->set ( 'ERROR', 'Pendaftaran Gagal, Poliklinik: ' . $this->input->post ( 'hiddenPoliklinik' ) . ', Dokter : ' . $this->input->post ( 'hiddenDokter' ) . ', Tanggal : ' . $tglReg->format ( 'd-m-Y' ) . ' Sedang Tidak Ada Jadwal. Harap Pilih Tanggal Jadwal Yang Lain.' );
					$this->load->view ( 'main', array (
							'p' => 'RUJUKAN',
							'RELIGION' => $religion,
							'BLOD' => $blod,
							'EDU' => $edu 
					) );
				}
			} else {
				$this->session->set ( 'ERROR', 'Maaf Tanggal Pendaftaran Tidak Boleh Kurang Dari Tanggal Hari Ini.' );
				$this->load->view ( 'main', array (
						'p' => 'RUJUKAN',
						'RELIGION' => $religion,
						'BLOD' => $blod,
						'EDU' => $edu 
				) );
			}
		} else {
			$this->session->set ( 'ERROR', $erorMessage );
			$this->load->view ( 'main', array (
					'p' => 'RUJUKAN',
					'RELIGION' => $religion,
					'BLOD' => $blod,
					'EDU' => $edu 
			) );
		}
	}
}