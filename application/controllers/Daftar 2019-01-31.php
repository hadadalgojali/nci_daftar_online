<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {
	public function testPrint(){
		$now=new DateTime();
			$tmpdir = sys_get_temp_dir();   # ambil direktori temporary untuk simpan file.
			$file =  tempnam($tmpdir, 'ctk');  # nama file temporary yang akan dicetak
			$handle = fopen($file, 'w');
			$condensed = Chr(27).Chr(33).Chr(4);
			$condensed2 = Chr(27).Chr(33).Chr(8);
			$bold1 = Chr(27) . Chr(69);
			$bold0 = Chr(27) . Chr(70);
			$initialized = chr(27).chr(64);
			$condensed1 = chr(15);
			$condensed0 = chr(18);
			$size0 = Chr(27).Chr(109);
			$Data  = $initialized;
			$Data .= $condensed1;
			$Data .= $condensed;
			$Data .= $condensed.str_pad($bold1.'RSUD dr. Soedono'.$bold0,64," ",STR_PAD_BOTH)."\n";
			$Data .= $condensed.str_pad($bold1.'Jl. Dr.Soetomo No.59 Kota Madiun.'.$bold0,64," ",STR_PAD_BOTH)."\n";
			$Data .= $condensed.str_pad($bold1.'Telp. (0351) 454657.'.$bold0,64," ",STR_PAD_BOTH)."\n";
			$Data .= $condensed."----------------------------------------------------------------\n";
			$Data .= $condensed.str_pad($bold1."CHECK IN REG. ONLINE".$bold0,64," ",STR_PAD_BOTH)."\n";
			$Data .= $condensed."----------------------------------------------------------------\n";
			$Data .= $condensed."Tgl. Kunjungan   : " .$condensed2.$now->format('d M Y')."\n";
			$Data .= $condensed."Jam Masuk        : " .$condensed2.$now->format('H:i:s')."\n";
			$Data .= "\n";
			$Data .= "\n";
			fwrite($handle, $Data);
			fclose($handle);
			$printer='\\\\NUANSA\\EPSON310_NUANSA';
			shell_exec("lpr -P ".$printer." -r ".$file);
			
			
			$printer = printer_open($printer);  
				printer_set_option($printer, PRINTER_MODE, "RAW"); 
				//printer_start_doc($printer, "Tes Printer"); 
				//printer_start_page($printer); 
				printer_write($printer, $Data);  
				//printer_end_page($printer); 
				//printer_end_doc($printer); 		 
				printer_close($printer);
	}
	public function getKunjungan(){
		$common=$this->common;
		$tgl=$this->input->get('tgl');
		$unit=$this->input->get('unit');
		$status=$this->input->get('status');
		$criteria='';
		if($unit != null && $unit !=''){
			$criteria.=" AND M2.unit_code='".$unit."' ";
		}
		if($status != null && $status !=''){
			$criteria.=" AND M.status=".$status;
		}
		// $tgl=new DateTime($tgl);
		$res=$common->queryResult("SELECT M.no_pendaftaran,M1.patient_code AS kd_pasien,
			unit_code AS kd_unit,M3.customer_code AS kd_customer,M.keluhan,M1.name AS nama,M2.unit_name AS nama_unit,M.status FROM rs_visit M 
		INNER JOIN rs_patient M1 ON M1.patient_id=M.patient_id 
		INNER JOIN rs_unit M2 ON M2.unit_id=M.unit_id
		INNER JOIN rs_customer M3 ON M3.customer_id=M.customer_id
			WHERE M.entry_date='".$tgl."' ".$criteria." order by M.status ASC");
		$this->jsonresult->setData($res)->end();
	}
	public function getImport(){
		ini_set('max_execution_time', 90000);
		$common=$this->common;
		$db=$this->load->database('other',true);
		// $res=$db->query("select kd_pasien,nama,tgl_lahir,alamat from pasien order by kd_pasien ASC limit 100000 offset 600000")->result();
		$res=$db->query("select kd_pasien,jenis_kelamin,telepon from pasien order by kd_pasien ASC limit 100000 offset 0")->result();
		for($i=0,$iLen=count($res); $i<$iLen; $i++){
			$arr=array();
			$o=$res[$i];

			if($o->jenis_kelamin=='t'){
				$arr['gender']='GENDER_L';//GENDER_L
			}else{
				$arr['gender']='GENDER_P';
			}
			$arr['phone_number']=$o->handphone;
			$this->db->where('patient_code',$o->kd_pasien);
			$this->db->update('rs_patient',$arr);
			// $arr['patient_code']=$o->kd_pasien;
			// if($o->nama!=null && $o->nama !=''){
				// $arr['name']=$o->nama;
			// }else{
				// $arr['name']='UNDEFINED';
			// }
			// $arr['birth_date']=$o->tgl_lahir;
			// $arr['address']=$o->alamat;
			// $this->db->insert('rs_patient',$arr);
		}
		$this->jsonresult->end();
	}	
	public function index(){
		$this->load->helper('captcha');
		$religion=$this->common->getParams('RELIGION');
		$blod=$this->common->getParams('BLOD');
		$edu=$this->common->getParams('EDUCATION');
		$this->load->view('main',array('p'=>'DASHBOARD','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu));
		//$this->load->view('main',array('p'=>'main/daftar/home'));
	}
	public function halaman_utama(){
		$this->load->helper('captcha');
		$religion=$this->common->getParams('RELIGION');
		$gelar=$this->common->getParamsGelar('GELAR');
		$blod=$this->common->getParams('BLOD');
		$edu=$this->common->getParams('EDUCATION');
		$this->load->view('main',array('p'=>'HALAMAN_UTAMA','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu,'GELAR'=>$gelar));
	}
	public function lama(){
		$this->load->helper('captcha');
		$religion=$this->common->getParams('RELIGION');
		$blod=$this->common->getParams('BLOD');
		$edu=$this->common->getParams('EDUCATION');
		$this->load->view('main',array('p'=>'DAFTAR_LAMA','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu));
	}
	public function baru(){
		$this->load->helper('captcha');
		$religion=$this->common->getParams('RELIGION');
		$gelar=$this->common->getParamsGelar('GELAR');
		$blod=$this->common->getParams('BLOD');
		$edu=$this->common->getParams('EDUCATION');
		$this->load->view('main',array('p'=>'DAFTAR_BARU','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu,'GELAR'=>$gelar));
	}
	public function cetak(){
		include "application/third_party/qr_code/qrlib.php";
		$common=$this->common;
		$visit=$common->find('Visit',$this->input->get('i'));
		if($visit != null){
			$patient=$visit->getPatient();
			$dokter=$visit->getDokter();
			$mr=$patient->getPatientCode();
			if(is_numeric($mr)==true){
				$split=str_split(strval($mr),2);
				$mr='';
				for($j=0,$jLen=count($split); $j<$jLen ; $j++){
					if($mr!=''){
						$mr.='-';
					}
					$mr.=$split[$j];
				}
			}
		QRcode::png($visit->getNomorPendaftaran(),"qrcode.png","H",5,5);
// <div style="position:fixed;top: 0px; left: 0px; right: 0px;">
// 					<img src="include/header3.PNG" style="width: 100%;">
// 				</div>
			$html='
				<div class="header"><center>BUKTI PENDAFTARAN ONLINE</center></div>
				<table border="0" cellspacing="0.1">
					<tr>
						<td width="100">
							 Nomor Pendaftaran
						</td>
						<td width="10">:</td>
						<td><h1>'.$visit->getNomorPendaftaran().'</h1></td>
						<td width="402" rowspan="9" align="center" valign="top"><img src="qrcode.png"/></td>
					</tr>
					<tr>
						<td width="100">
							 Nomor Medrec
						</td>
						<td width="10">:</td>
						<td>'.$mr.'</td>
					</tr>
					<tr>
						<td width="100">
							 Nomor KTP
						</td>
						<td width="10">:</td>
						<td>'.$patient->getKtp().'</td>
					</tr>
					<tr>
						<td width="100">
							 Nama Pasien
						</td>
						<td width="10">:</td>
						<td>'.$patient->getName().'</td>
					</tr>
					<tr>
						<td width="100">
							 Tanggal Lahir
						</td>
						<td width="10">:</td>
						<td>'.$patient->getBirthDate()->format('d M Y').'</td>
					</tr>
					<tr>
						<td width="100">
							 Poliklinik
						</td>
						<td width="10">:</td>
						<td>'.$visit->getUnit()->getUnitName().'</td>
					</tr>
					<tr>
						<td width="100">
							 Dokter
						</td>
						<td width="10">:</td>
						<td>'.$dokter->getFirstName().' '.$dokter->getLastName().'</td>
					</tr>
					<tr>
						<td width="100">
							 Tanggal Berobat
						</td>
						<td width="10">:</td>
						<td>'.$visit->getEntryDate()->format('d M Y').'</td>
					</tr>
					<tr>
						<td width="100">
							 Nomor Antrian
						</td>
						<td width="10">:</td>
						<td><h1>'.$visit->getAntrian().'</h1></td>
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
			pdf(array('html'=>$html,'margin-top'=>50,'margin-bottom'=>50,'paper'=>'A4'));
		//echo $html;
		}else
			echo 'Data Not Found';
	}
	public function getCountry(){
		$common=$this->common;
		$text=$this->input->get('text');
		$res=$common->queryResult("SELECT country_id,country_name FROM area_country WHERE UPPER(country_name) LIKE UPPER('".$text."%') AND country_id != 0
		 	ORDER BY country_name ASC LIMIT 10");
		$arr=array();
		$arr[]=array('id'=>0,'text'=>'Lain-lain');
		for($i=0; $i<count($res) ; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=$country->country_id;
			$o['text']=$country->country_name;
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function getPatient(){
		$em = $this->doctrine->em;
		$text=$this->input->get('id');
		$res=$em->createQuery("SELECT u FROM Entity\content\Patient u 
		WHERE u.id=".$text)->getSingleResult();
		$o=array();
		$o['gelar']=$res->getTitle();
		$o['nama']=$res->getName();
		$o['tmpLahir']=$res->getBirthPlace();
		$birthDate=$res->getBirthDate();
		if($birthDate != null){
			$o['tglLahir']=$birthDate->format('d-m-Y');
		}else{
			$o['tglLahir']='';
		}
		$o['jk']=$res->getGender()->getOptionCode();
		$religion=$res->getReligion();
		if($religion != null){
			$o['religion']=$religion->getOptionCode();
		}else{
			$o['religion']=null;
		}
		$blod=$res->getBlod();
		if($blod != null){
			$o['blod']=$blod->getOptionCode();
		}else{
			$o['blod']=null;
		}
		$edu=$res->getEdu();
		if($edu != null){
			$o['edu']=$edu->getOptionCode();
		}else{
			$o['edu']=null;
		}
		$o['address']=$res->getAddress();
		$o['ktp']=$res->getKtp();
		$o['telepon']=$res->getPhoneNumber();
		$o['rt']=$res->getRt();
		$o['rw']=$res->getRw();
		if($res->getCountry() != null && $res->getCountry()->getId()!=0){
			$o['countryId']=$res->getCountry()->getId();
			$o['countryName']=$res->getCountry()->getValue();
		}else{
			$o['countryId']=0;
			$o['countryName']='Lain-lain';
			$countryTemp=$res->getCountryTemp();
			if($countryTemp != null){
				$o['countryTemp']=$countryTemp->getValue();
			}else{
				$o['countryTemp']='';
			}
		}
		if($res->getProvince() != null && $res->getProvince()->getId()!=0){
			$o['provinceId']=$res->getProvince()->getId();
			$o['provinceName']=$res->getProvince()->getValue();
		}else{
			$o['provinceId']=0;
			$o['provinceName']='Lain-lain';
			$provinceTemp=$res->getProvinceTemp();
			if($provinceTemp != null){
				$o['provinceTemp']=$provinceTemp->getValue();
			}else{
				$o['provinceTemp']='';
			}
		}
		if($res->getDistrict() != null && $res->getDistrict()->getId()!=0){
			$o['districtId']=$res->getDistrict()->getId();
			$o['districtName']=$res->getDistrict()->getValue();
		}else{
			$o['districtId']=0;
			$o['districtName']='Lain-lain';
			$districtTemp=$res->getDistrictTemp();
			if($districtTemp != null){
				$o['districtTemp']=$res->getDistrictTemp()->getValue();
			}else{
				$o['districtTemp']='';
			}
		}
		if($res->getDistricts() != null && $res->getDistricts()->getId()!=0){
			$o['districtsId']=$res->getDistricts()->getId();
			$o['districtsName']=$res->getDistricts()->getValue();
		}else{
			$o['districtsId']=0;
			$o['districtsName']='Lain-lain';
			$districtsTemp=$res->getDistrictsTemp();
			if($districtsTemp != null){
				$o['districtsTemp']=$res->getDistrictsTemp()->getValue();
			}else{
				$o['districtsTemp']='';
			}
		}
		if($res->getKelurahan() != null && $res->getKelurahan()->getId()!=0){
			$o['kelurahanId']=$res->getKelurahan()->getId();
			$o['kelurahanName']=$res->getKelurahan()->getValue();
		}else{
			$o['kelurahanId']=0;
			$o['kelurahanName']='Lain-lain';
			$kelurahanTemp=$res->getKelurahanTemp();
			if($kelurahanTemp!= null){
				$o['kelurahanTemp']=$res->getKelurahanTemp()->getValue();
			}else{
				$o['kelurahanTemp']='';
			}			
		}
		$o['postalCode']=$res->getPostalCode();
		$this->jsonresult->setData($o)->end();
	}
	public function getPatientList(){
		$common = $this->common;
		$text=$this->input->get('text');
		$tgl_lahir=$this->input->get('tgl_lahir');
		$jk=$this->input->get('jk');
		// $telp=$this->input->get('telp');
		// $ktp=$this->input->get('ktp');
		$criteria='';
		$innerJoin='';
		if($tgl_lahir!= null && trim($tgl_lahir)!=''){
			$tgl=new DateTime($tgl_lahir);
			$criteria.=" AND birth_date='".$tgl->format('Y-m-d')."' ";
		}
		// if($jk!= null && trim($jk)!=''){
			// $innerJoin.=' INNER JOIN u.gender A ';
			// $criteria.=" AND gender='".$jk."' ";
		// }
		// if($telp!= null && trim($telp)!=''){
			// $criteria.=" AND phone_number LIKE'%".$telp."%' ";
		// }
		// if($ktp!= null && trim($ktp)!=''){
			// $criteria.=" AND no_ktp LIKE'%".$ktp."%' ";
		// }
		$res=$common->queryResult("
									SELECT p.patient_id,p.patient_code,upper(p.name) as name 
									FROM rs_patient p  
									WHERE 
										(
											UPPER(p.patient_code) LIKE UPPER('%".$text."%') OR
											UPPER(name) LIKE UPPER('%".$text."%')
										) ".$criteria." 
									ORDER BY p.patient_code ASC 
									LIMIT 10
								");
		$arr=array();
		for($i=0,$iLen=count($res); $i< $iLen; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=$country->patient_id;
			$mr=$country->patient_code;
			if(is_numeric($mr)==true){
				$split=str_split(strval($mr),2);
				$mr='';
				for($j=0,$jLen=count($split); $j<$jLen ; $j++){
					if($mr!='')
						$mr.='-';
					$mr.=$split[$j];
				}
			}
			$o['text']=$mr." - ".$country->name;
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	
	/************************************************************/
	/********************PROSES SAVING PASIEN BARU **************/
	/************************************************************/
	public function saveBaru(){

		//session_start();
		//$this->load->helper('captcha');
		$common=$this->common;
		$religion=$this->common->getParams('RELIGION');
		$blod=$this->common->getParams('BLOD');
		$edu=$this->common->getParams('EDUCATION');
		if($this->input->post('captcha')!=null){
			 if($this->input->post('captcha')!=null){	
				$error=false;
				$erorMessage='';
				if($this->input->post('negara') ==''){
					$erorMessage.='&nbsp; &bull; Harap Pilih Negara.<br>';
					$error=true;
				}
				if($this->input->post('provinsi') ==''){
					$erorMessage.='&nbsp; &bull; Harap Pilih Provinsi.<br>';
					$error=true;
				}
				if($this->input->post('kota') ==''){
					$erorMessage.='&nbsp; &bull; Harap Pilih Kota.<br>';
					$error=true;
				}
				if($this->input->post('kecamatan') ==''){
					$erorMessage.='&nbsp; &bull; Harap Pilih Kecamatan.<br>';
					$error=true;
				}
				if($this->input->post('kelurahan') ==''){
					$erorMessage.='&nbsp; &bull; Harap Pilih Kelurahan.<br>';
					$error=true;
				}
				if($this->input->post('kelompok') ==''){
					$erorMessage.='&nbsp; &bull; Harap Pilih Kelompok Pasien.<br>';
					$error=true;
				}
				if($this->input->post('dokter') ==''){
					$erorMessage.='&nbsp; &bull; Harap Pilih Dokter.<br>';
					$error=true;
				}
				if($this->input->post('poliklinik') ==''){
					$erorMessage.='&nbsp; &bull; Harap Pilih Poliklinik.<br>';
					$error=true;
				}
				if($error==false){				
					$tglReg=new DateTime($this->input->post('tglReg'));
					$now=new DateTime();
					if(strtotime($tglReg->format('Y-m-d'))>strtotime($now->format('Y-m-d'))){
						//$em = $this->doctrine->em;
						$codeHari='';
						$namaHari='';
						if($tglReg->format('D')=='Mon'){
							$codeHari='DAY_1';
							$namaHari='Senin';
						}else if($tglReg->format('D')=='Tue'){
							$codeHari='DAY_2';
							$namaHari='Selasa';
						}else if($tglReg->format('D')=='Wed'){
							$codeHari='DAY_3';
							$namaHari='Rabu';
						}else if($tglReg->format('D')=='Thu'){
							$codeHari='DAY_4';
							$namaHari='Kamis';
						}else if($tglReg->format('D')=='Fri'){
							$codeHari='DAY_5';
							$namaHari='Jumat';
						}else if($tglReg->format('D')=='Sat'){
							$codeHari='DAY_6';
							$namaHari='Sabtu';
						}else{
							$codeHari='DAY_7';
							$namaHari='Minggu';
						}


						$jadwal=$common->createQuery("SELECT u FROM Entity\content\JadwalPoli u 
							INNER JOIN u.unit A
							INNER JOIN u.dokter B
							INNER JOIN u.hari C
							WHERE 
							A.id=".$this->input->post('poliklinik')." AND 
							C.optionCode='".$codeHari."' AND 
							B.id=".$this->input->post('dokter')."
							ORDER BY u.jam ASC")->getResult();
						$ObjectAntrian=$common->createQuery("SELECT u FROM Entity\content\Antrian u 
							INNER JOIN u.unit A
							INNER JOIN u.dokter B
							WHERE 
							u.tglMasuk='".$tglReg->format('Y-m-d')."' AND 
							A.id=".$this->input->post('poliklinik')." AND 
							B.id=".$this->input->post('dokter'));
						if($jadwal){
							$jumlah=0;
							for($i=0,$iLen=count($jadwal); $i<$iLen ; $i++){
								$jumlah+=$jadwal[$i]->getMaxAntrian();
							}
							if(!$ObjectAntrian->getResult() || ($jumlah>$ObjectAntrian->getSingleResult()->getAntrian())){
								$seq=$this->common->getNextSequence('MEDREC');
								$code=$seq['val'];
								$patient=new Entity\content\Patient();
								$antri=1;
								$countryTemp=null;
								if($this->input->post('negara')==0){
									$countryTemp=$common->newModel('Temp');
									$countryTemp->setValue($this->input->post('lainNegara'))
										->save();
								}
								$provinceTemp=null;
								if($this->input->post('provinsi')==0){
									$provinceTemp=$common->newModel('Temp');
									$provinceTemp->setValue($this->input->post('lainProvinsi'))
									->save();
								}
								$districtTemp=null;
								if($this->input->post('kota')==0){
									$districtTemp=$common->newModel('Temp');
									$districtTemp->setValue($this->input->post('lainKota'))
									->save();
								}
								$districtsTemp=null;
								if($this->input->post('kecamatan')==0){
									$districtsTemp=$common->newModel('Temp');
									$districtsTemp->setValue($this->input->post('lainKecamatan'))
									->save();
								}
								$kelurahanTemp=null;
								if($this->input->post('kelurahan')==0){
									$kelurahanTemp=$common->newModel('Temp');
									$kelurahanTemp->setValue($this->input->post('lainKelurahan'))
									->save();
								}
								$patient->setTitle($this->input->post('gelar'))
									->setPatientCode($code)
									->setName($this->input->post('nama'))
									->setKtp($this->input->post('ktp'))
									->setBirthPlace($this->input->post('tempatLahir'))
									->setBirthDate(new \DateTime($this->input->post('tgllahir')))
									->setGender($common->find ( 'ParameterOption', $this->input->post('jk') ))
									->setReligion($common->find ( 'ParameterOption', $this->input->post('agama') ))
									->setBlod($common->find ( 'ParameterOption', $this->input->post('goldar') ))
									->setEdu($common->find ( 'ParameterOption', $this->input->post('education') ))
									->setAddress($this->input->post('alamat'))
									->setRt($this->input->post('rt'))
									->setRw($this->input->post('rw'))
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
									->setPostalCode($this->input->post('kdpos'))
									->save();
								
								$poliklinik=$common->find ( 'Unit',$this->input->post('poliklinik') );
								$dokter=$common->find ( 'Employee', $this->input->post('dokter') );
								if($ObjectAntrian->getResult()){
									$antrian=$ObjectAntrian->getSingleResult();
									$antri=$antrian->getAntrian()+1;
									$antrian->setAntrian($antri)->update();
								}else{
									$antrian=new Entity\content\Antrian();
									$antrian->setTglMasuk(new \DateTime($this->input->post('tglReg')))
										->setUnit($poliklinik)
										->setDokter($dokter)
										->setAntrian($antri)
										->save();
								}
								$visit=new Entity\content\Visit();
								$seq=$this->common->getNextSequence('DAFTAR_ONLINE',$common->getSystemProperty('DEFAULT_TENANT', null)->getPropertyValue());
								$codeReg=$seq['val'];
								
								if($_POST['tgl_rujukan_baru'] == ''){
									$_POST['tgl_rujukan_baru'] = $now->format('Y-m-d');
								} 
								
								$visit->setUnit($poliklinik)
									->setEntryDate(new \DateTime($this->input->post('tglReg')))
									->setEntrySeq(1)
									->setDokter($dokter)
									->setAntrian($antri)
									->setHadir(false)
									->setBaru(true)
									->setNomorPeserta($this->input->post('no_kartu_baru'))
									->setnoRujukan($this->input->post('no_rujukan_baru'))
									->setkdRujukan($this->input->post('hidden_kd_rujukan'))
									->setPoliTujuan($this->input->post('poli_baru'))
									->setKelas($this->input->post('kelas_baru'))
									->setDiagnosa($this->input->post('diagnosas_baru'))
									->setFaskesAsal($this->input->post('faskes_baru'))
									->setNomorPendaftaran($codeReg)
									->setCustomer($common->find ( 'Customer', $this->input->post('kelompok') ))
									->setPatient($patient)
									->setJenisDaftar($common->find ( 'ParameterOption', 'JNSDFTR_ONLINE' ))
									->setStatus(false)
									->setKeluhan($this->input->post('keluhan'))
									->setkdKelas($this->input->post('hidden_kd_kelas'))
									->setkdPoli($this->input->post('hidden_kd_poli'))
									->setkdDiagnosa($this->input->post('hidden_kd_diagnosa'))
									->setkdFaskes($this->input->post('hidden_nilai_faskes'))
									->setkd_dpjp($this->input->post('hiddenNoDPJP_baru'))
									->settglRujukan(new \DateTime($_POST['tgl_rujukan_baru']))
									->save();
								$this->common->nextSequence('DAFTAR_ONLINE',$common->getSystemProperty('DEFAULT_TENANT', null)->getPropertyValue());
								$jam=null;
								$last=0;
								if($ObjectAntrian->getResult()){
									$last=$ObjectAntrian->getSingleResult()->getAntrian()-1;
								}
								if(strtotime($tglReg->format('Y-m-d'))>strtotime($now->format('Y-m-d')) || 
									(strtotime($tglReg->format('Y-m-d'))==strtotime($now->format('Y-m-d')) && strtotime($now->format('H:i:s'))<strtotime($jadwal[0]->getJam()->format('H:i:s')))){
									for($i=0,$iLen=count($jadwal); $i<$iLen ; $i++){
										if($last<$jadwal[$i]->getMaxAntrian()){
											$jam=date_create($jadwal[$i]->getJam()->format('h:i:s'));
											date_add($jam, date_interval_create_from_date_string(($last*$jadwal[$i]->getDuration()).' minutes'));
											break;
										}else{
											$last-=$jadwal[$i]->getMaxAntrian();
										}
									}	
								}else{
									if(strtotime($jadwal[0]->getJam()->format('H:i:s'))<strtotime($now->format('H:i:s'))){
										$jam=date_create($now->format('H:i:s'));
										date_add($jam, date_interval_create_from_date_string(($last*$jadwal[0]->getDuration()).' minutes'));
									}
								}
								$mr=$code;
								if(is_numeric($mr)==true){
									$split=str_split(strval($mr),2);
									$mr='';
									for($j=0,$jLen=count($split); $j<$jLen ; $j++){
										if($mr!=''){
											$mr.='-';
										}
										$mr.=$split[$j];
									}
								}
								$_SESSION['caption_button']='';
								$msg='';
								$msg.='Pendaftaran Berhasil.<br> Harap Catan Data dibawah ini untuk kunjungan Rumah Sakit:<br>';
								$msg.='<b><h3>'.$codeReg.'</h3></b><br>';
								$msg.='Atas :<br>';
								$msg.='&bull; Nama : '.$this->input->post('gelar').'. '.$this->input->post('nama').'<br>';
								$msg.='&bull; No. Medrec : '.$mr.'<br>';
								$msg.='&bull; No. Antrian : '.$antri.'<br>';
								$msg.='&bull; Hari/Tanggal : '.$namaHari.', '.$tglReg->format('d-m-Y').'<br>';
								$msg.='&bull; Prakiraan Waktu : '.date_format($jam, 'H:i:s').'<br>';
								$msg.='&bull; Poli Klinik : '.$poliklinik->getUnitName().'<br>';
								$msg.='&bull; Nama Dokter : '.$dokter->getFirstName().' '.$dokter->getLastName().'<br>';
								//$msg.='<a href="javascript:window.open(\''.base_url().'daftar/cetak?i='.$visit->getId().'\');" >Cetak Bukti Pendaftaran</a>';
								$msg.='<a href="'.base_url().'daftar/cetak?i='.$visit->getId().'" download="HTML 5 PDF">Download Bukti Pendaftaran</a>';
								$this->session->set('SUCCESS',$msg);
								$this->common->nextSequence('MEDREC');
								header('Location:'.base_url().'daftar/baru');
							}else{
								$this->session->set('ERROR','Pendaftaran Gagal, Poliklinik: '.$this->input->post('hiddenPoliklinik').
									', Dokter : '.$this->input->post('hiddenDokter').', Tanggal : '.$tglReg->format('d-m-Y').' Antrian Sudah Penuh. Harap Pilih Tanggal Jadwal Yang Lain.'
								);
								$this->load->view('main',array('p'=>'DAFTAR_BARU','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu));
							}
						}else{
							$this->session->set('ERROR','Pendaftaran Gagal, Poliklinik: '.$this->input->post('hiddenPoliklinik').
								', Dokter : '.$this->input->post('hiddenDokter').', Tanggal : '.$tglReg->format('d-m-Y').' Sedang Tidak Ada Jadwal. Harap Pilih Tanggal Jadwal Yang Lain.'
							);
							$this->load->view('main',array('p'=>'DAFTAR_BARU','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu));
						}
					}else{
						$this->session->set('ERROR','Maaf Tanggal Pendaftaran Harus Lebih dari Tanggal Hari Ini.');
						$this->load->view('main',array('p'=>'DAFTAR_BARU','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu));
					}
				}else{
					$this->session->set('ERROR',$erorMessage);
					$this->load->view('main',array('p'=>'DAFTAR_BARU','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu));
				}
			//}
		 }else{
			if (isset($_POST['cek']))
			{
				ini_set('max_execution_time', 3000);
				$_SESSION['random_verif']=substr(md5(microtime()),rand(0,26),6);//random kode verifikasi sms, disimpan di session
				$_SESSION['caption_button']='daftar';
				$nohp=$this->input->post('telepon');
				$kode="182654"; //isikan sesuai dengan keinginan anda, tapi jangan masukkan huruf. hanya digit angka.
				// Script Kirim SMS Api Zenziva
				$userkey="drekni"; // userkey lihat di zenziva
				$passkey="hendra123456";
				$message='Terima Kasih, pendaftar atas nama :'.$this->input->post('nama').', silahkan isi verifikasi kode :'.$_SESSION['random_verif'];
				$url = 'https://reguler.zenziva.net/apps/smsapi.php';
				$curlHandle = curl_init();
				curl_setopt($curlHandle, CURLOPT_URL, $url);
				curl_setopt($curlHandle, CURLOPT_HTTPGET, 1);
				curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$nohp.'&pesan='.urlencode($message));
				curl_setopt($curlHandle, CURLOPT_HEADER, 1);
				curl_setopt($curlHandle, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
				curl_setopt($curlHandle, CURLOPT_DNS_CACHE_TIMEOUT, 2 );
				curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
				curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
				curl_setopt($curlHandle, CURLOPT_POST, 1);
				$results = curl_exec($curlHandle);
				curl_close($curlHandle); 
				$msg='';
				$msg.='Silahkan Cek inbox pada handphone anda dan masukan kode verifikasi'.'<br>';
				$this->session->set('SUCCESS',$msg);
				$this->load->view('main',array('p'=>'DAFTAR_BARU','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu));
		
			}else{
				$erorMessage='Centang Kirim Sms untuk mengirim verifikasi '.'<br>';
				$erorMessage.='jangan isi verifikasi sebelum mendapat kode verifikasi '.'<br>';
				$this->session->set('ERROR',$erorMessage);
				$this->load->view('main',array('p'=>'DAFTAR_BARU','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu));
			}
			
		} 
	}
}
	public function saveLama(){
		//$this->load->helper('captcha');
		$common=$this->common;
		$religion=$this->common->getParams('RELIGION');
		$blod=$this->common->getParams('BLOD');
		$edu=$this->common->getParams('EDUCATION');
		if($this->input->post('captcha')!=null){
			if(strtolower($_SESSION['random_verif_lama'])!=strtolower($this->input->post('captcha'))){
				$this->session->set('ERROR','Isi Verifikasi dengan Benar.');
				$this->load->view('main',array('p'=>'DAFTAR_LAMA','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu));
				$_SESSION['caption_button_lama']='daftar';
			}else{
				$error=false;
				$erorMessage='';
				// if($this->input->post('negara') ==''){
					// $erorMessage.='&nbsp; &bull; Harap Pilih Negara.<br>';
					// $error=true;
				// }
				// if($this->input->post('provinsi') ==''){
					// $erorMessage.='&nbsp; &bull; Harap Pilih Provinsi.<br>';
					// $error=true;
				// }
				// if($this->input->post('kota') ==''){
					// $erorMessage.='&nbsp; &bull; Harap Pilih Kota.<br>';
					// $error=true;
				// }
				// if($this->input->post('kecamatan') ==''){
					// $erorMessage.='&nbsp; &bull; Harap Pilih Kecamatan.<br>';
					// $error=true;
				// }
				// if($this->input->post('kelurahan') ==''){
					// $erorMessage.='&nbsp; &bull; Harap Pilih Kelurahan.<br>';
					// $error=true;
				// }
				if($this->input->post('kelompok') ==''){
					$erorMessage.='&nbsp; &bull; Harap Pilih Kelompok Pasien.<br>';
					$error=true;
				}
				// if($this->input->post('dokter') ==''){
					// $erorMessage.='&nbsp; &bull; Harap Pilih Dokter.<br>';
					// $error=true;
				// }
				if($this->input->post('poliklinik') ==''){
					$erorMessage.='&nbsp; &bull; Harap Pilih Poliklinik.<br>';
					$error=true;
				}
				if($error==false){				
					$tglReg=new DateTime($this->input->post('tglReg'));
					$now=new DateTime();
					if(strtotime($tglReg->format('Y-m-d'))>strtotime($now->format('Y-m-d'))){
						$em = $this->doctrine->em;
						$codeHari='';
						$namaHari='';
						if($tglReg->format('D')=='Mon'){
							$codeHari='DAY_1';
							$namaHari='Senin';
						}else if($tglReg->format('D')=='Tue'){
							$codeHari='DAY_2';
							$namaHari='Selasa';
						}else if($tglReg->format('D')=='Wed'){
							$codeHari='DAY_3';
							$namaHari='Rabu';
						}else if($tglReg->format('D')=='Thu'){
							$codeHari='DAY_4';
							$namaHari='Kamis';
						}else if($tglReg->format('D')=='Fri'){
							$codeHari='DAY_5';
							$namaHari='Jumat';
						}else if($tglReg->format('D')=='Sat'){
							$codeHari='DAY_6';
							$namaHari='Sabtu';
						}else{
							$codeHari='DAY_7';
							$namaHari='Minggu';
						}
						$jadwal=$em->createQuery("SELECT u FROM Entity\content\JadwalPoli u 
							INNER JOIN u.unit A
							INNER JOIN u.dokter B
							INNER JOIN u.hari C
							WHERE 
							A.id=".$this->input->post('poliklinik')." AND 
							C.optionCode='".$codeHari."' AND 
							B.id=45
							ORDER BY u.jam ASC")->getResult();
						$ObjectAntrian=$em->createQuery("SELECT u FROM Entity\content\Antrian u 
							INNER JOIN u.unit A
							INNER JOIN u.dokter B
							WHERE 
							u.tglMasuk='".$tglReg->format('Y-m-d')."' AND 
							A.id=".$this->input->post('poliklinik')." AND 
							B.id=45");
						if($jadwal){
							$jumlah=0;
							for($i=0,$iLen=count($jadwal); $i<$iLen ; $i++){
								$jumlah+=$jadwal[$i]->getMaxAntrian();
							}
							if(!$ObjectAntrian->getResult() || ($jumlah>$ObjectAntrian->getSingleResult()->getAntrian())){
								$code='';
								$patient=$em->find ( 'Entity\content\Patient', $this->input->post('rm') );
								$code=$patient->getPatientCode();
								$antri=1;
								$seq=$this->common->getNextSequence('DAFTAR_ONLINE',$common->getSystemProperty('DEFAULT_TENANT', null)->getPropertyValue());
								$codeReg=$seq['val'];
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
								$patient->setTitle($this->input->post('gelar'))
									->setPatientCode($code)
									->setKtp($this->input->post('ktp'))
									->setName($this->input->post('nama'))
									->setBirthPlace($this->input->post('tempatLahir'))
									->setBirthDate(new \DateTime($this->input->post('tgllahir')))
									->setGender($em->find ( 'Entity\app\a4\ParameterOption', $this->input->post('jk') ))
									->setReligion($em->find ( 'Entity\app\a4\ParameterOption', $this->input->post('agama') ))
									->setBlod($em->find ( 'Entity\app\a4\ParameterOption', $this->input->post('goldar') ))
									->setEdu($em->find ( 'Entity\app\a4\ParameterOption', $this->input->post('education') ))
									->setAddress($this->input->post('alamat'))
									->setRt($this->input->post('rt'))
									->setRw($this->input->post('rw'))
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
									->setPostalCode($this->input->post('kdpos'))
									->update();
								
								$poliklinik=$em->find ( 'Entity\content\Unit',$this->input->post('poliklinik') );
								$dokter=$em->find ( 'Entity\app\a5\Employee', 45 );
								if($ObjectAntrian->getResult()){
									$antrian=$ObjectAntrian->getSingleResult();
									$antri=$antrian->getAntrian()+1;
									$antrian->setAntrian($antri)->update();
								}else{
									$antrian=new Entity\content\Antrian();
									$antrian->setTglMasuk(new \DateTime($this->input->post('tglReg')))
										->setUnit($poliklinik)
										->setDokter($dokter)
										->setAntrian($antri)
										->save();
								}
								
								$visit=$em->createQuery("SELECT u FROM Entity\content\Visit u 
									INNER JOIN u.unit A
									INNER JOIN u.patient C
									WHERE 
									u.entryDate='".$tglReg->format('Y-m-d')."' AND 
									A.id=".$this->input->post('poliklinik')." AND 
									C.id=".$patient->getId()." 
									ORDER BY u.entrySeq DESC
									")->setMaxResults(1);
								
								if($_POST['tgl_rujukan_lama'] == ''){
									$_POST['tgl_rujukan_lama'] = $now->format('Y-m-d');
								} 
								if($visit->getResult()){
									$obj=$visit->getSingleResult();
									$entrySeq=$obj->getEntrySeq()+1;
// 									$obj->setEntrySeq($entrySeq)
// 										->setNomorPendaftaran($codeReg)
// 										->setHadir(false)
// 										->setAntrian($antri)
// 										->setStatus(false)
// 										->update();
									$visit=new Entity\content\Visit();
									
									$visit->setUnit($poliklinik)
										->setEntryDate(new \DateTime($this->input->post('tglReg')))
										->setEntrySeq($entrySeq)
										->setDokter($dokter)
										->setHadir(false)
										->setBaru(false)
										->setNomorPendaftaran($codeReg)
										->setAntrian($antri)
										->setJenisDaftar($common->find ( 'ParameterOption', 'JNSDFTR_ONLINE' ))
										->setCustomer($em->find ( 'Entity\content\Customer', $this->input->post('kelompok') ))
										->setPatient($patient)
										->setStatus(false)
										->setStatusData(0)
										->setKeluhan($this->input->post('keluhan'))
										->setNomorPeserta($this->input->post('no_kartu'))
										->setnoRujukan($this->input->post('no_rujukan_lama'))
										->setkdRujukan($this->input->post('hidden_kd_rujukan_lama'))
										->setPoliTujuan($this->input->post('poli_lama'))
										->setKelas($this->input->post('kelas_lama'))
										->setDiagnosa($this->input->post('diagnosa_lama'))
										->setFaskesAsal($this->input->post('faskes_lama'))
										->setkdKelas($this->input->post('hidden_kd_kelas_lama'))
										->setkdPoli($this->input->post('hidden_kd_poli_lama'))
										->setkdDiagnosa($this->input->post('hidden_kd_diagnosa_lama'))
										->setkdFaskes($this->input->post('hidden_nilai_faskes_lama'))
										->setkd_dpjp($this->input->post('hiddenNoDPJP_lama'))
										->settglRujukan(new \DateTime($_POST['tgl_rujukan_lama']))
										->save();
								}else{
									$visit=new Entity\content\Visit();
									$visit->setUnit($poliklinik)
										->setEntryDate(new \DateTime($this->input->post('tglReg')))
										->setEntrySeq(1)
										->setDokter($dokter)
										->setHadir(false)
										->setNomorPendaftaran($codeReg)
										->setAntrian($antri)
										->setBaru(false)
										->setJenisDaftar($common->find ( 'ParameterOption', 'JNSDFTR_ONLINE' ))
										->setCustomer($em->find ( 'Entity\content\Customer', $this->input->post('kelompok') ))
										->setPatient($patient)
										->setStatus(false)
										->setKeluhan($this->input->post('keluhan'))
										->setNomorPeserta($this->input->post('no_kartu'))
										->setnoRujukan($this->input->post('no_rujukan_lama'))
										->setkdRujukan($this->input->post('hidden_kd_rujukan_lama'))
										->setPoliTujuan($this->input->post('poli_lama'))
										->setKelas($this->input->post('kelas_lama'))
										->setDiagnosa($this->input->post('diagnosa_lama'))
										->setFaskesAsal($this->input->post('faskes_lama'))
										->setkdKelas($this->input->post('hidden_kd_kelas_lama'))
										->setkdPoli($this->input->post('hidden_kd_poli_lama'))
										->setkdDiagnosa($this->input->post('hidden_kd_diagnosa_lama'))
										->setkdFaskes($this->input->post('hidden_nilai_faskes_lama'))
										->setkd_dpjp($this->input->post('hiddenNoDPJP_lama'))
										->settglRujukan(new \DateTime($_POST['tgl_rujukan_lama']))
										->save();
								}	
								$this->common->nextSequence('DAFTAR_ONLINE',$common->getSystemProperty('DEFAULT_TENANT', null)->getPropertyValue());
								$jam=null;
								$last=0;
								if($ObjectAntrian->getResult()){
									$last=$ObjectAntrian->getSingleResult()->getAntrian()-1;
								}
								if(strtotime($tglReg->format('Y-m-d'))>strtotime($now->format('Y-m-d')) || 
									(strtotime($tglReg->format('Y-m-d'))==strtotime($now->format('Y-m-d')) && strtotime($now->format('H:i:s'))<strtotime($jadwal[0]->getJam()->format('H:i:s')))){
									for($i=0,$iLen=count($jadwal); $i<$iLen ; $i++){
										if($last<$jadwal[$i]->getMaxAntrian()){
											$jam=date_create($jadwal[$i]->getJam()->format('h:i:s'));
											date_add($jam, date_interval_create_from_date_string(($last*$jadwal[$i]->getDuration()).' minutes'));
											break;
										}else{
											$last-=$jadwal[$i]->getMaxAntrian();
										}
									}	
								}else{
									if(strtotime($jadwal[0]->getJam()->format('H:i:s'))<strtotime($now->format('H:i:s'))){
										$jam=date_create($now->format('H:i:s'));
										date_add($jam, date_interval_create_from_date_string(($last*$jadwal[0]->getDuration()).' minutes'));
									}
								}
								$mr=$code;
								if(is_numeric($mr)==true){
									$split=str_split(strval($mr),2);
									$mr='';
									for($j=0,$jLen=count($split); $j<$jLen ; $j++){
										if($mr!=''){
											$mr.='-';
										}
										$mr.=$split[$j];
									}
								}
								$_SESSION['caption_button_lama']='';
								$msg='';
								$msg.='Pendaftaran Berhasil.<br> Harap Catan Nomor Pendaftaran dibawah ini untuk kunjungan Rumah Sakit:<br>';
								$msg.='<b><h3>'.$codeReg.'</h3></b><br>';
								$msg.='Atas :<br>';
								$msg.='&bull; Nama : '.$this->input->post('gelar').'. '.$this->input->post('nama').'<br>';
								$msg.='&bull; No. Medrec : '.$mr.'<br>';
								$msg.='&bull; No. Antrian : '.$antri.'<br>';
								$msg.='&bull; Hari/Tanggal : '.$namaHari.', '.$tglReg->format('d-m-Y').'<br>';
								$msg.='&bull; Prakiraan Waktu : '.date_format($jam, 'H:i:s').'<br>';
								$msg.='&bull; Poli Klinik : '.$poliklinik->getUnitName().'<br>';
								$msg.='&bull; Nama Dokter : '.$dokter->getFirstName().' '.$dokter->getLastName().'<br><br>';
								//$msg.='<a href="javascript:window.open(\''.base_url().'daftar/cetak?i='.$visit->getId().'\');" >Cetak Bukti Pendaftaran</a>';
								$msg.='<a href="'.base_url().'daftar/cetak?i='.$visit->getId().'" download="HTML 5 PDF">Download Bukti Pendaftaran</a>';
								$this->session->set('SUCCESS',$msg);
								header('Location:'.base_url().'daftar/lama');
							}else{
								$this->session->set('ERROR','Pendaftaran Gagal, Poliklinik: '.$this->input->post('hiddenPoliklinik').
									', Dokter : '.$this->input->post('hiddenDokter').', Tanggal : '.$tglReg->format('d-m-Y').' Antrian Sudah Penuh. Harap Pilih Tanggal Jadwal Yang Lain.'
								);
								$this->load->view('main',array('p'=>'DAFTAR_LAMA','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu));
							}
						}else{
							$this->session->set('ERROR','Pendaftaran Gagal, Poliklinik: '.$this->input->post('hiddenPoliklinik').
								', Dokter : '.$this->input->post('hiddenDokter').', Tanggal : '.$tglReg->format('d-m-Y').' Sedang Tidak Ada Jadwal. Harap Pilih Tanggal Jadwal Yang Lain.'
							);
							$this->load->view('main',array('p'=>'DAFTAR_LAMA','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu));
						}
					}else{
						$this->session->set('ERROR','Maaf Tanggal Pendaftaran Harus Lebih dari Tanggal Hari Ini.');
						$this->load->view('main',array('p'=>'DAFTAR_LAMA','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu));
					}
				}else{
					$this->session->set('ERROR',$erorMessage);
					$this->load->view('main',array('p'=>'DAFTAR_LAMA','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu));
				}
			}
		}else{
			if (isset($_POST['cek']))
			{
				ini_set('max_execution_time', 3000);
				$_SESSION['random_verif_lama']=substr(md5(microtime()),rand(0,26),6);
				$_SESSION['caption_button_lama']='daftar';
				$nohp=$this->input->post('telepon');
				//$kode="182654"; //isikan sesuai dengan keinginan anda, tapi jangan masukkan huruf. hanya digit angka.
				// Script Kirim SMS Api Zenziva
				$userkey="drekni"; // userkey lihat di zenziva
				$passkey="hendra123456";
				$message='Terima Kasih, pendaftar atas nama :'.$this->input->post('nama').', silahkan isi verifikasi kode :'.$_SESSION['random_verif_lama'];
				$url = 'https://reguler.zenziva.net/apps/smsapi.php';
				$curlHandle = curl_init();
				curl_setopt($curlHandle, CURLOPT_URL, $url);
				curl_setopt($curlHandle, CURLOPT_HTTPGET, 1);
				curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$nohp.'&pesan='.urlencode($message));
				curl_setopt($curlHandle, CURLOPT_HEADER, 1);
				curl_setopt($curlHandle, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
				curl_setopt($curlHandle, CURLOPT_DNS_CACHE_TIMEOUT, 2 );
				curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
				curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
				curl_setopt($curlHandle, CURLOPT_POST, 1);
				$results = curl_exec($curlHandle);
				curl_close($curlHandle); 
				$msg='';
				$msg.='Silahkan Cek inbox pada handphone anda dan masukan kode verifikasi'.'<br>';
				$this->session->set('SUCCESS',$msg);
				$this->load->view('main',array('p'=>'DAFTAR_LAMA','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu));
			}else{
				$erorMessage='Centang Kirim Sms untuk mengirim verifikasi '.'<br>';
				$erorMessage.='jangan isi verifikasi sebelum mendapat kode verifikasi '.'<br>';
				$this->session->set('ERROR',$erorMessage);
				$this->load->view('main',array('p'=>'DAFTAR_LAMA','RELIGION'=>$religion,'BLOD'=>$blod,'EDU'=>$edu));
			}
			//header('Location:'.base_url().'daftar/lama');
		}
	}
	public function sendSms(){
		ini_set('max_execution_time', 3000);
		$_SESSION['random_verif_lama']=substr(md5(microtime()),rand(0,26),6);//random kode verifikasi sms, disimpan di session
		$_SESSION['caption_button']='daftar';
		$nohp=$this->input->post('telepon');
		$kode="182654"; //isikan sesuai dengan keinginan anda, tapi jangan masukkan huruf. hanya digit angka.
		// Script Kirim SMS Api Zenziva
		$userkey="drekni"; // userkey lihat di zenziva
		$passkey="hendra12345678";
		$message='Terima Kasih, pendaftar atas nama :'.$this->input->post('nama').', silahkan isi verifikasi kode :'.$_SESSION['random_verif_lama'];
		$url = 'https://reguler.zenziva.net/apps/smsapi.php';
		$curlHandle = curl_init();
		curl_setopt($curlHandle, CURLOPT_URL, $url);
		curl_setopt($curlHandle, CURLOPT_HTTPGET, 1);
		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$nohp.'&pesan='.urlencode($message));
		curl_setopt($curlHandle, CURLOPT_HEADER, 1);
		//curl_setopt($curlHandle, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
		curl_setopt($curlHandle, CURLOPT_DNS_CACHE_TIMEOUT, 2 );
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
		curl_setopt($curlHandle, CURLOPT_POST, 1);
		$results = curl_exec($curlHandle);
		curl_close($curlHandle); 
		$msg='';
		$msg.='Silahkan Cek inbox pada handphone anda dan masukan kode verifikasi'.'<br>';
		$this->session->set('SUCCESS',$msg);
		$this->jsonresult->setData($_SESSION['random_verif_lama']);
		$this->jsonresult->end();
	}
	public function getProvince(){
		$common=$this->common;
		$text=$this->input->get('text');
		$parent=$this->input->get('country');
		if(trim($parent) != ''){
			$res=$common->queryResult("SELECT province_id,province FROM area_province WHERE UPPER(province) LIKE UPPER('".$text."%') AND country_id=".$parent." 
					AND province_id !=0 ORDER BY province ASC LIMIT 10");
			$arr=array();
			$arr[]=array('id'=>0,'text'=>'Lain-lain');
			for($i=0,$iLen=count($res); $i<$iLen ; $i++){
				$country=$res[$i];
				$o=array();
				$o['id']=$country->province_id;
				$o['text']=$country->province;
				$arr[]=$o;
			}
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function getDistrict(){
		$common=$this->common;
		$text=$this->input->get('text');
		$parent=$this->input->get('district');
		if(trim($parent) != ''){
			$res=$common->queryResult("SELECT district_id,district FROM area_district WHERE UPPER(district) LIKE UPPER('".$text."%') AND province_id=".$parent." 
					AND district_id !=0 ORDER BY district ASC LIMIT 10");
			$arr=array();
			$arr[]=array('id'=>0,'text'=>'Lain-lain');
			for($i=0; $i<count($res) ; $i++){
				$country=$res[$i];
				$o=array();
				$o['id']=$country->district_id;
				$o['text']=$country->district;
				$arr[]=$o;
			}
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function getDistricts(){
		$common=$this->common;
		$text=$this->input->get('text');
		$parent=$this->input->get('districts');
		if(trim($parent) != ''){
			$res=$common->queryResult("SELECT districts_id,districts FROM area_districts
			WHERE UPPER(districts) LIKE UPPER('".$text."%') AND district_id=".$parent."  AND districts_id !=0
			 ORDER BY districts ASC LIMIT 10");
			$arr=array();
			$arr[]=array('id'=>0,'text'=>'Lain-lain');
			for($i=0; $i<count($res) ; $i++){
				$country=$res[$i];
				$o=array();
				$o['id']=$country->districts_id;
				$o['text']=$country->districts;
				$arr[]=$o;
			}
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function getKelurahan(){
		$common=$this->common;
		$text=$this->input->get('text');
		$parent=$this->input->get('kelurahan');
		if(trim($parent) != ''){
			$res=$common->queryResult("SELECT kelurahan_id,kelurahan FROM area_kelurahan WHERE UPPER(kelurahan) LIKE UPPER('".$text."%') AND districts_id=".$parent." 
					AND kelurahan_id !=0 ORDER BY kelurahan ASC LIMIT 10");
			$arr=array();
			$arr[]=array('id'=>0,'text'=>'Lain-lain');
			for($i=0; $i<count($res) ; $i++){
				$country=$res[$i];
				$o=array();
				$o['id']=$country->kelurahan_id;
				$o['text']=$country->kelurahan;
				$arr[]=$o;
			}
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function getCustomer(){
		$common=$this->common;
		$text=$this->input->get('text');
		$arr=array();
		$res=$common->queryResult("SELECT customer_id,customer_name,customer_code FROM rs_customer WHERE UPPER(customer_name) LIKE UPPER('%".$text."%') 
		 	ORDER BY customer_name ASC LIMIT 10");
		for($i=0; $i<count($res) ; $i++){
			$country=$res[$i];
			$o=array();
			$o['id_bpjs']=$country->customer_code;
			$o['id']=$country->customer_id;
			$o['text']=$country->customer_name;
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function getCustomer_bpjs(){
		$common=$this->common;
		$text=$this->input->get('text');
		$arr=array();
		$res=$common->queryResult("SELECT * FROM sys_setting where keterangan='kode default bpjs'");
		for($i=0; $i<count($res) ; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=$country->id_sys;
			$o['text']=$country->setting;
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	
	public function getDokter(){
		$common = $this->common;
		$text=$this->input->get('text');
		$unit=$this->input->get('unit');
		$arr=array();
		if(trim($unit) !=''){
			$res=$common->queryResult("SELECT A.employee_id,A.first_name,A.last_name FROM rs_dokter_klinik M INNER JOIN app_employee A ON M.employee_id=A.employee_id
					WHERE (UPPER(A.first_name) LIKE UPPER('%".$text."%') or UPPER(A.first_name) LIKE UPPER('%".$text."%') )
					AND unit_id=".$unit." ORDER BY A.first_name ASC LIMIT 10");
			for($i=0; $i<count($res) ; $i++){
				$country=$res[$i];
				$o=array();
				$o['id']=$country->employee_id;
				$o['text']=$country->first_name." ".$country->last_name;
				$arr[]=$o;
			}
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function cekAntrian(){			
		$common=$this->common;
		date_default_timezone_set("Asia/Jakarta");
		$tglReg=new DateTime($this->input->get('tglReg'));
		$now=new DateTime("now");
		// cek tanggal berobat dengan tgl hari ini
		
		if( (strtotime($tglReg->format('Y-m-d'))>strtotime($now->format('Y-m-d'))) || ($tglReg->format('Y-m-d') != $now->format('Y-m-d')) ){
			$em = $this->doctrine->em;
			$codeHari='';
			$namaHari='';
			if($tglReg->format('D')=='Mon'){
				$codeHari='DAY_1';
				$namaHari='Senin';
			}else if($tglReg->format('D')=='Tue'){
				$codeHari='DAY_2';
				$namaHari='Selasa';
			}else if($tglReg->format('D')=='Wed'){
				$codeHari='DAY_3';
				$namaHari='Rabu';
			}else if($tglReg->format('D')=='Thu'){
				$codeHari='DAY_4';
				$namaHari='Kamis';
			}else if($tglReg->format('D')=='Fri'){
				$codeHari='DAY_5';
				$namaHari='Jumat';
			}else if($tglReg->format('D')=='Sat'){
				$codeHari='DAY_6';
				$namaHari='Sabtu';
			}else{
				$codeHari='DAY_7';
				$namaHari='Minggu';
			}
			$jadwalQUery=$common->queryResult("SELECT max_pelayanan,jam,durasi_periksa FROM rs_jadwal_poli WHERE 
				unit_id=".$this->input->get('poliklinik')." AND 
				hari='".$codeHari."' AND 
				dokter_id=".$this->input->get('dokter')."
				ORDER BY jam ASC");
			$jadwal=$jadwalQUery;
			$ObjectAntrian=$common->queryRow("SELECT no_antrian FROM rs_antrian_poliklinik
				WHERE 
				tgl_masuk='".$tglReg->format('Y-m-d')."' AND 
				unit_id=".$this->input->get('poliklinik')." AND 
				dokter_id=".$this->input->get('dokter'));
			if($jadwal){
				$jumlah=0;
				for($i=0; $i<count($jadwal) ; $i++){
					$jumlah+=$jadwal[$i]->max_pelayanan;
				}
				if($ObjectAntrian == null || ($jumlah>$ObjectAntrian->no_antrian)){
					$antri=1;
					$poliklinik=$em->find ($common->getModel('Unit'),$this->input->get('poliklinik') );
					$dokter=$em->find ($common->getModel('Employee'), $this->input->get('dokter'));
					if($ObjectAntrian){
						$antrian=$ObjectAntrian;
						$antri=$antrian->no_antrian+1;
					}
					$jam=null;
					$last=0;
					$last1=0;
					$sisa=0;
					if($ObjectAntrian){
						$last=$ObjectAntrian->no_antrian;
						$last1=$ObjectAntrian->no_antrian;
					}
					$dJam=new DateTime($jadwal[0]->jam);
					if(strtotime($tglReg->format('Y-m-d'))>strtotime($now->format('Y-m-d')) || 
						(strtotime($tglReg->format('Y-m-d'))==strtotime($now->format('Y-m-d')) && strtotime($now->format('H:i:s'))<strtotime($dJam->format('H:i:s')))){
						for($i=0; $i<count($jadwal) ; $i++){
							$sisa=$jadwal[$i]->max_pelayanan-$last1;
							if($last<$jadwal[$i]->max_pelayanan){
								$dJam1=new DateTime($jadwal[$i]->jam);
								$jam=date_create($dJam1->format('h:i:s'));
								date_add($jam, date_interval_create_from_date_string(($last*$jadwal[$i]->durasi_periksa).' minutes'));
								break;
							}else{
								$last-=$jadwal[$i]->max_pelayanan;
							}
							
						}	
					}else{
						$sisa=$jadwal[0]->max_pelayanan-$last1;
						if(strtotime($dJam->format('H:i:s'))<strtotime($now->format('H:i:s'))){
							
							$jam=date_create($now->format('H:i:s'));
							date_add($jam, date_interval_create_from_date_string(($last*$jadwal[0]->durasi_periksa).' minutes'));
						}
					}
					$msg='';
					$msg.='&bull; No. Antrian(Hanya Prakiraan) : '.$antri.'<br>';
					$msg.='&bull; Hari/Tanggal : '.$namaHari.', '.$tglReg->format('d-m-Y').'<br>';
					$msg.='&bull; Prakiraan Waktu : '.date_format($jam, 'H:i:s').'<br>';
					$msg.='&bull; Poli Klinik : '.$poliklinik->getUnitName().'<br>';
					$msg.='&bull; Nama Dokter : '.$dokter->getFirstName().' '.$dokter->getLastName().'<br>';
					$msg.='&bull; Sisa Antrian : '.($sisa-1).'<br>';
					$this->jsonresult->setMessage($msg);
				}else{
					$this->jsonresult->error();
					$this->jsonresult->setMessage('Poliklinik: '.$this->input->get('hiddenPoliklinik').
						', Dokter : '.$this->input->get('hiddenDokter').', Tanggal : '.$tglReg->format('d-m-Y').' Antrian Sudah Penuh. Harap Pilih Tanggal Jadwal Yang Lain.'
					);
				}
			}else{
				$this->jsonresult->error();
				$this->jsonresult->setMessage('Poliklinik: '.$this->input->get('hiddenPoliklinik').
					', Dokter : '.$this->input->get('hiddenDokter').', Tanggal : '.$tglReg->format('d-m-Y').' Sedang Tidak Ada Jadwal. Harap Pilih Tanggal Jadwal Yang Lain.');
			}
		}else{
			$this->jsonresult->error();
			$this->jsonresult->setMessage('Maaf Tanggal Pendaftaran Harus Lebih dari Tanggal Hari Ini.');
		}
		$this->jsonresult->end();
	}
	private function ajax($type,$url,$content=null,$header=null){
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $type);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		if($content != null){
			//echo json_encode($content);
			curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($content));
		}
		if($header != null){
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		}
		if($type=='POST'){
			curl_setopt($curl, CURLOPT_POST, true);
		}
		$response = curl_exec($curl);
		if($response === FALSE){
			die(curl_error($curl));
		}
		//echo $response;
		$res=json_decode($response);
		curl_close($curl);
		return $res;
	}
	private function searchMessage($arr){
		$message='';
		if(gettype($arr)=='object'){
			foreach($arr as $key=>$value){
				if(gettype($value)!='object' && gettype($value)!='array'){
					if($key=='field'){
						$message.=$value;
					}
					if($key=='message'){
						$message.=' '.$value.'<br>';
					}
				}else{
					$message.=$this->searchMessage($value);
				}
			}
		}else if(gettype($arr)=='array'){
			for($i=0,$iLen=count($arr);$i<$iLen;$i++){
				$message.=$this->searchMessage($arr[$i]);
			}
		}else if(gettype($arr)=='string'){
			$message.=$arr;
		}
		return $message;
	}
	private function generateHeaderArray(){
		date_default_timezone_set('UTC');
		$tStamp = time();
		$data = '15081';
		$secretKey = '3cDAEE1ED1';
		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		return array("X-cons-id: ".$data,"X-timestamp: ".$tStamp,"X-signature: ".$encodedSignature);
	}
	private function generateHeader(){
		date_default_timezone_set('UTC');
		$tStamp = time();
		$data = '15081';
		$secretKey = '3cDAEE1ED1';
		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		$headers="X-cons-id: ".$data."\r\n" .
					  "X-timestamp: ".$tStamp."\r\n".
					  "X-signature: ".$encodedSignature."\r\n";
		return $headers;
	}
	
	private function getSignatureVedika(){
		/* $tmp_secretKey="3cDAEE1ED1";
		$tmp_costumerID= "15081"; */
		
		$tmp_secretKey  = "1kSB7D0168";
		$tmp_costumerID = "10542";
		date_default_timezone_set('UTC');
		$tStamp = time();
		$signature = hash_hmac('sha256', $tmp_costumerID."&".$tStamp, $tmp_secretKey, true);
		$encodedSignature = base64_encode($signature);
		// return array("X-Cons-ID: ".$tmp_costumerID,"X-Timestamp: ".$tStamp,"X-Signature: ".$encodedSignature);
		return array("X-Cons-ID: ".$tmp_costumerID,"X-Timestamp: ".$tStamp,"X-Signature: ".$encodedSignature);
		
	}
	
	public function cek_no_kartu(){
		$no_kartu    	= $this->input->post('no_kartu');
		$nilai_faskes   = $this->input->post('nilai_faskes');
		$headers		= $this->getSignatureVedika();
		 $opts = array(
		  'http'=>array(
		  'method'=>'GET',
		  'header'=>$headers
		  )
		);
		$context = stream_context_create($opts);
		if($nilai_faskes == '1'){
			/*URL GET RUJUKAN FASKES 1 SINGLE RECORD*/
			$res= json_decode(file_get_contents('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/Rujukan/Peserta/'.$no_kartu,false,$context));
		}else{
			/*URL GET RUJUKAN FASKES 2 SINGLE RECORD*/
			$res= json_decode(file_get_contents('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/Rujukan/RS/Peserta/'.$no_kartu,false,$context));
		}
		
		$data = array(
		  'resp'      => $res,
		);

		echo json_encode($data);
	
	}

	public function getKdPoliBPJS(){
		$common=$this->common;
		$text=$this->input->post('text');
		$arr=array();
		$res=$common->queryResult("SELECT * from rs_unit WHERE kd_unit_bpjs='".$text."' ");
		for($i=0; $i<count($res) ; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=$country->unit_id;
			$o['text']=$country->unit_name;
			$arr[]=$o;
		}
		echo json_encode($arr);
		//$this->jsonresult->setData($arr)->end();
	}
	public function getUnit(){
		$common=$this->common;
		$text=$this->input->get('text');
		$arr=array();
		$res=$common->queryResult("
									SELECT unit_id,unit_name 
									FROM rs_unit 
									WHERE UPPER(unit_name) LIKE UPPER('%".$text."%') 
										AND unit_type='UNITTYPE_RWJ'
										AND active_flag = '1'
		 							ORDER BY unit_name ASC 
		 						");
		for($i=0; $i<count($res) ; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=$country->unit_id;
			$o['text']=$country->unit_name;
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function getNoDPJP(){
		$common=$this->common;
		$text		= $this->input->get('text');
		// $kd_poli	= 'BSY';
		$kd_poli	= $this->input->get('poli');
		$url= "https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/referensi/dokter/pelayanan/2/tglPelayanan/".date("Y-m-d")."/Spesialis/".$kd_poli." ";
		
		$headers=$this->getSignatureVedika();
		$opts = array(
		  'http'=>array(
			'method'=>'GET',
			'header'=>$headers
		  )
		);
		$context = stream_context_create($opts);
		$res = json_decode(file_get_contents($url,false,$context));
		
		$res2 = $res->response->list;
		$arr=array(); 
		for($i=0; $i<count($res2) ; $i++){
			$country=$res2[$i];
			$o=array();
			$o['id']=$country->kode;
			$o['text']=$country->nama;
			$arr[]=$o;
		}
		//print_r($arr);
		$this->jsonresult->setData($arr)->end();   
	}

	public function cek_pasien_daftar(){
		$common=$this->common;
		$arr=array();
		$res=$common->queryResult("SELECT * from rs_patient WHERE no_ktp='".$this->input->post('no_ktp')."' ");
		if(count($res)>=1){
			echo json_encode(array('response'=>'false'));
		}else{
			echo json_encode(array('response'=>'true'));	
		}
			
	}
	public function get_gelar(){
		$common=$this->common;
		$res=$common->queryResult("SELECT * from rs_gelar ");
		$this->jsonresult->setData($res)->end();
	}
	public function getPatientNew(){
		$em = $this->doctrine->em;
		$no_medrec = $this->input->get('no_medrec');
		$tgl_lahir=new DateTime( $this->input->get('tgl_lahir'));
		
		/* $res=$em->createQuery("SELECT u FROM Entity\content\Patient u 
		WHERE u.patientCode=".$no_medrec ." and u.birthDate = ".$tgl_lahir." ")->getSingleResult();
		 */
		$res=$em->createQuery("SELECT u FROM Entity\content\Patient u 
		WHERE u.patientCode='".$no_medrec."'  and u.birthDate = '".$tgl_lahir->format('Y-m-d')."' " )->getSingleResult();
		$o=array();
		$o['rm']=$res->getId();
		$o['gelar']=$res->getTitle();
		$o['nama']=$res->getName();
		$o['tmpLahir']=$res->getBirthPlace();
		$birthDate=$res->getBirthDate();
		if($birthDate != null){
			$o['tglLahir']=$birthDate->format('d-m-Y');
		}else{
			$o['tglLahir']='';
		}
		$o['jk']=$res->getGender()->getOptionCode();
		$religion=$res->getReligion();
		if($religion != null){
			$o['religion']=$religion->getOptionCode();
		}else{
			$o['religion']=null;
		}
		$blod=$res->getBlod();
		if($blod != null){
			$o['blod']=$blod->getOptionCode();
		}else{
			$o['blod']=null;
		}
		$edu=$res->getEdu();
		if($edu != null){
			$o['edu']=$edu->getOptionCode();
		}else{
			$o['edu']=null;
		}
		$o['address']=$res->getAddress();
		$o['ktp']=$res->getKtp();
		$o['telepon']=$res->getPhoneNumber();
		$o['rt']=$res->getRt();
		$o['rw']=$res->getRw();
		if($res->getCountry() != null && $res->getCountry()->getId()!=0){
			$o['countryId']=$res->getCountry()->getId();
			$o['countryName']=$res->getCountry()->getValue();
		}else{
			$o['countryId']=0;
			$o['countryName']='Lain-lain';
			$countryTemp=$res->getCountryTemp();
			if($countryTemp != null){
				$o['countryTemp']=$countryTemp->getValue();
			}else{
				$o['countryTemp']='';
			}
		}
		if($res->getProvince() != null && $res->getProvince()->getId()!=0){
			$o['provinceId']=$res->getProvince()->getId();
			$o['provinceName']=$res->getProvince()->getValue();
		}else{
			$o['provinceId']=0;
			$o['provinceName']='Lain-lain';
			$provinceTemp=$res->getProvinceTemp();
			if($provinceTemp != null){
				$o['provinceTemp']=$provinceTemp->getValue();
			}else{
				$o['provinceTemp']='';
			}
		}
		if($res->getDistrict() != null && $res->getDistrict()->getId()!=0){
			$o['districtId']=$res->getDistrict()->getId();
			$o['districtName']=$res->getDistrict()->getValue();
		}else{
			$o['districtId']=0;
			$o['districtName']='Lain-lain';
			$districtTemp=$res->getDistrictTemp();
			if($districtTemp != null){
				$o['districtTemp']=$res->getDistrictTemp()->getValue();
			}else{
				$o['districtTemp']='';
			}
		}
		if($res->getDistricts() != null && $res->getDistricts()->getId()!=0){
			$o['districtsId']=$res->getDistricts()->getId();
			$o['districtsName']=$res->getDistricts()->getValue();
		}else{
			$o['districtsId']=0;
			$o['districtsName']='Lain-lain';
			$districtsTemp=$res->getDistrictsTemp();
			if($districtsTemp != null){
				$o['districtsTemp']=$res->getDistrictsTemp()->getValue();
			}else{
				$o['districtsTemp']='';
			}
		}
		if($res->getKelurahan() != null && $res->getKelurahan()->getId()!=0){
			$o['kelurahanId']=$res->getKelurahan()->getId();
			$o['kelurahanName']=$res->getKelurahan()->getValue();
		}else{
			$o['kelurahanId']=0;
			$o['kelurahanName']='Lain-lain';
			$kelurahanTemp=$res->getKelurahanTemp();
			if($kelurahanTemp!= null){
				$o['kelurahanTemp']=$res->getKelurahanTemp()->getValue();
			}else{
				$o['kelurahanTemp']='';
			}			
		}
		$o['postalCode']=$res->getPostalCode();
		$this->jsonresult->setData($o)->end();
	}
	
}