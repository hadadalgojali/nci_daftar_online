<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Employee
$no_sep_bpjs='';
class RS2 extends MY_controller {
	
	public $MA='RS2';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end ();
	}
	public function saveBridging(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pid=$this->post('i');
		$penyakit=$common->find('Penyakit',$this->post('codeDiagnosa'));
		$noSep=$this->post('f26');
		$sep=$this->post('sep');
		$bpjs=$this->post('bpjs');
		$pbi=$this->post('f34');
		if($pbi=='true'){
			$pbi=true;
		}else{
			$pbi=false;
		}
		$customer=$common->find('Customer',$this->post('f22'));
		$visit=$common->find('Visit',$pid);
		if($visit != null){
			$visit->setPenyakit($penyakit)
				->setKodeSep($noSep)
				->setJsonSep($sep)
				->setJsonBpjs($bpjs)
				->setPbi($pbi)
				->setCustomer($customer)
				->update();
			$result->setMessage('Bridging Berhasil Berhasil.')->end();
		}else{
			$result->error()->setMessageNotExist()->end();
		}
	}
	
	
	public function cetakSep2(){
		$common = $this->common;
		$op=$common->getEmployee();
		$now=new DateTime();
		$peserta=json_decode($this->get('bpjs'));
		$sep=json_decode($this->get('sep'));
		$medrec=$this->get('medrec');
		if(is_numeric($medrec)==true){
			$split=str_split(strval($medrec),2);
			$medrec='';
			for($j=0,$jLen=count($split); $j<$jLen ; $j++){
				if($medrec!=''){
					$medrec.='-';
				}
				$medrec.=$split[$j];
			}
		}
		$poli=$common->find('Unit',$this->get('poli'));
		$penyakit=$common->find('Penyakit',$this->get('diagnosa'));
		$tglLahir=new DateTime($peserta->tglLahir);
		$jk='PRIA';
		if($peserta->sex=='P')
			$jk='WANITA';
		$html='
			<table border="0"  style="font-size: 12px !important;">
				<tr>
					<td width="66%">
						<table>
							<tr>
								<td width="100" style="text-align: center;">
									<img src="include/logo.png" style="width: 50px;">
								</td>
								<td width="10">&nbsp;</td>
								<td style="text-align: center;">
									<div style="font-size: 19px !important;font-weight: bold;">SURAT ELEGIBILITAS PESERTA</div>
									<div style="font-size: 12px;">RSUD</div>
								</td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td>
									No. SEP
								</td>
								<td>:</td>
								<td>
									'.$sep->response.'
								</td>
							</tr>
							<tr>
								<td>
									Tgl. SEP
								</td>
								<td>:</td>
								<td>
									'.$now->format('d M Y').'
								</td>
							</tr>
							<tr>
								<td>
									No. Kartu
								</td>
								<td>:</td>
								<td>
									'.$peserta->noKartu.'
								</td>
							</tr>
							<tr>
								<td>
									Nama Peserta
								</td>
								<td>:</td>
								<td>
									'.$peserta->nama.'
								</td>
							</tr>
							<tr>
								<td>
									Tgl. Lahir
								</td>
								<td>:</td>
								<td>
									'.$tglLahir->format('d M Y').'
								</td>
							</tr>
							<tr>
								<td>
									Jns Kelamin
								</td>
								<td>:</td>
								<td>
									'.$jk.'
								</td>
							</tr>
							<tr>
								<td>
									Poli Tujuan
								</td>
								<td>:</td>
								<td>
									'.$poli->getUnitName().'
								</td>
							</tr>
							<tr>
								<td>
									Asal Faskes Tk. I
								</td>
								<td>:</td>
								<td>
									'.$peserta->provUmum->nmProvider.'
								</td>
							</tr>
							<tr>
								<td>
									Diagnosa Awal
								</td>
								<td>:</td>
								<td>
									'.$penyakit->getPenyakit().'
								</td>
							</tr>
							<tr>
								<td>
									Catatan
								</td>
								<td>:</td>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="3" style="font-size: 10px !important;"><i>*Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan</i></td>
							</tr>
							<tr>
								<td colspan="3" style="font-size: 10px !important;"><i>*SEP bukan sebagai bukti penjaminan peserta</i></td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;Catatan Ke 1</td>
							</tr>
						</table>
					</td>
					<td valign="top">
						<img src="include/Logo BPJS.png" style="width: 220px;margin-left: 20px;margin-top: 20px;margin-bottom: 20px;">
						<table border="0">
							<tr>
								<td colspan="3">
									&nbsp;
								</td>
							</tr>
							<tr>
								<td width="60">
									No. Mr
								</td>
								<td width="10">:</td>
								<td>
									'.$medrec.'
								</td>
							</tr>
							<tr>
								<td colspan="3">
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									Peserta
								</td>
								<td>:</td>
								<td>
									'.$peserta->jenisPeserta->nmJenisPeserta.'
								</td>
							</tr>
							<tr>
								<td colspan="3">
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									COB
								</td>
								<td>:</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>
									Jns. Rawat
								</td>
								<td>:</td>
								<td>Rawat Jalan</td>
							</tr>
							<tr>
								<td>
									Kls. Rawat
								</td>
								<td>:</td>
								<td>'.$peserta->kelasTanggungan->nmKelas.'</td>
							</tr>
						</table><br>
						<table>
							<tr>
								<td width="40%">Pasien / Keluarga Pasien</td>
								<td width="20%">&nbsp;</td>
								<td width="40%">Petugas BPJS Kesehatan</td>
							</tr>
							<tr>
								<td colspan="3" style="height: 30px;">&nbsp;</td>
							</tr>
							<tr>
								<td style="border-bottom: 1px solid black;">&nbsp;</td>
								<td>&nbsp;</td>
								<td style="border-bottom: 1px solid black;">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		';
	
		pdf(array('html'=>$html,'margin-top'=>15,'margin-left'=>15,'margin-right'=>15,'paper'=>array(0, 0, 595, 320),'page-number'=>false,array("Attachment" => false)));
	}
	public function cetakPasien(){
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
			$html='
				<div style="position:fixed;top: 0px; left: 0px; right: 0px;">
					<img src="include/header3.PNG" style="width: 100%;">
				</div>
				<div class="header"><center>DATA PASIEN</center></div>
				<table>
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
							 Tempat/Tanggal Lahir
						</td>
						<td width="10">:</td>
						<td>'.$patient->getBirthPlace().', '.$patient->getBirthDate()->format('d M Y').'</td>
					</tr>
					<tr>
						<td width="100">
							 Jenis Kelamin
						</td>
						<td width="10">:</td>
						<td>'.$patient->getGender()->getOptionName().'</td>
					</tr>
					<tr>
						<td width="100">
							 Agama
						</td>
						<td width="10">:</td>
						<td>'.$patient->getReligion()->getOptionName().'</td>
					</tr>
					<tr>
						<td width="100">
							 Pendidikan Terakhir
						</td>
						<td width="10">:</td>
						<td>'.$patient->getEdu()->getOptionName().'</td>
					</tr>
					<tr>
						<td width="100">
							 Alamat
						</td>
						<td width="10">:</td>
						<td>'.$patient->getAddress().'</td>
					</tr>
					<tr>
						<td width="100">
							 Kode Pos
						</td>
						<td width="10">:</td>
						<td>'.$patient->getPostalCode().'</td>
					</tr>
					<tr>
						<td width="100">
							 No Telepon
						</td>
						<td width="10">:</td>
						<td>'.$patient->getPhoneNumber().'</td>
					</tr>
					<tr>
						<td width="100">
							 RT/RW
						</td>
						<td width="10">:</td>
						<td>'.$patient->getRt().'/'.$patient->getRw().'</td>
					</tr>';
				$country=$patient->getCountry();
				if($country != null){
					$html.='<tr>
						<td width="100">
							 Negara
						</td>
						<td width="10">:</td>
						<td>'.$country->getValue().'</td>
					</tr>';
				}
				$province=$patient->getProvince();
				if($province != null){
					$html.='<tr>
						<td width="100">
							 Provinsi
						</td>
						<td width="10">:</td>
						<td>'.$province->getValue().'</td>
					</tr>';
				}
				$city=$patient->getDistrict();
				if($city != null){
					$html.='<tr>
						<td width="100">
							 Kota
						</td>
						<td width="10">:</td>
						<td>'.$city->getValue().'</td>
					</tr>';
				}
				$kelurahan=$patient->getDistricts();
				if($city != null){
					$html.='<tr>
						<td width="100">
							 Kelurahan
						</td>
						<td width="10">:</td>
						<td>'.$kelurahan->getValue().'</td>
					</tr>';
				}
		$html.='		</table>
		';
			pdf(array('html'=>$html,'margin-top'=>100,'margin-bottom'=>50));
		}else
			echo 'Data Not Found';
	}
	public function cetakTracer(){
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
			$html='
				<div style="position:fixed;top: 0px; left: 0px; right: 0px;">
					<img src="include/header3.PNG" style="width: 100%;">
				</div>
				<div class="header"><center>DATA PASIEN</center></div>
				<table>
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
							 Tanggal/Jam
						</td>
						<td width="10">:</td>
						<td>'.$visit->getEntryDate()->format('d M Y').'</td>
					</tr>
					<tr>
						<td width="100">
							 Poli Tujuan
						</td>
						<td width="10">:</td>
						<td>'.$visit->getUnit()->getUnitName().'</td>
					</tr>
					<tr>
						<td width="100">
							 Nama Dokter
						</td>
						<td width="10">:</td>
						<td>'.$dokter->getFirstName().' '.$dokter->getLastName().'</td>
					</tr>';
					
		$html.='		</table>
		';
			pdf(array('html'=>$html,'margin-top'=>100,'margin-bottom'=>50));
		}else
			echo 'Data Not Found';
	}
	public function getPenyakit(){
		$em = $this->doctrine->em;
		$common=$this->common;
		$text=$this->input->get('query');
		$arr=array();
		$res=$em->createQuery("SELECT u.kodePenyakit,u.penyakit FROM ".$common->getModel('Penyakit')." u
			WHERE (UPPER(u.penyakit) LIKE UPPER('".$text."%') OR UPPER(u.kodePenyakit) LIKE UPPER('".$text."%'))
			 ORDER BY u.kodePenyakit ASC")
				 ->setMaxResults(10)
				 ->getResult();
		for($i=0,$iLen=count($res); $i<$iLen ; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=$country['kodePenyakit'];
			$o['text']=$country['kodePenyakit'].' - '.$country['penyakit'];
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	/*
	public function getDataBpjs() {
		$common = $this->common;
		date_default_timezone_set('UTC');
		$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
		$defaultTenant=$common->getSystemProperty('DEFAULT_TENANT', null)->getPropertyValue();
		$data = $common->getSystemProperty('SIGNATURE_ID', $defaultTenant)->getPropertyValue();
		$secretKey = $common->getSystemProperty('SECRET_KEY', $defaultTenant)->getPropertyValue();
		$klinik=$this->input->post('klinik');
		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		$result=array(
				'id'=>$data,
				'timestamp'=>	$tStamp,
				'signature'=>	$encodedSignature,
				'kd_rs'=>	$common->getSystemProperty('KD_RS', $defaultTenant)->getPropertyValue(),
				'url_briging'=>$common->getSystemProperty('URL_BRIGING', $defaultTenant)->getPropertyValue(),
				'url_getSep'=>$common->getSystemProperty('URL_GETSEP', $defaultTenant)->getPropertyValue(),
		);
		$this->jsonresult->setData($result)->end();
	}
	*/
	public function getDataBpjs() {
		$common = $this->common;
		date_default_timezone_set('UTC');
		$type=$this->get('type');
		$no=$this->get('no');
		$addUrl='';
		$tStamp = time();//.strval(time()-strtotime('1970-01-01 00:00:00'));
		$defaultTenant=$common->getSystemProperty('DEFAULT_TENANT', null)->getPropertyValue();
		$data = $common->getSystemProperty('SIGNATURE_ID', $defaultTenant)->getPropertyValue();
		$secretKey = $common->getSystemProperty('SECRET_KEY', $defaultTenant)->getPropertyValue();
		$klinik=$this->input->post('klinik');
		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		$headers="X-cons-id: ".$data."\r\n" .
					  "X-timestamp: ".$tStamp."\r\n".
					  "X-signature: ".$encodedSignature."\r\n";
		$result=array(
			'headers'=>$headers,
			//'id'=>$data,
			//'timestamp'=>	$tStamp,
			//'signature'=>	$encodedSignature,
			'kd_rs'=>	$common->getSystemProperty('KD_RS', $defaultTenant)->getPropertyValue(),
			//'url_briging'=>$common->getSystemProperty('URL_BRIGING', $defaultTenant)->getPropertyValue(),
			'url_getSep'=>$common->getSystemProperty('URL_GETSEP', $defaultTenant)->getPropertyValue(),
		);
		if($type=='NIK'){
			$addUrl='nik/';
		}
		
		$opts = array(
		  'http'=>array(
			'method'=>"GET",
			'header'=>$headers
		  )
		);
		$context = stream_context_create($opts);
		$res=json_decode(file_get_contents($common->getSystemProperty('URL_BRIGING', $defaultTenant)->getPropertyValue().$addUrl.$no,false,$context));
		
		$hasil=array();
		$hasil['bpjs']=$res;
		$hasil['result']=$result;
		$this->jsonresult->setData($hasil)->end();
	}
	public function sep(){
		$common = $this->common;
		date_default_timezone_set('UTC');
		$tStamp = time();//.strval(time()-strtotime('1970-01-01 00:00:00'));
		$defaultTenant=$common->getSystemProperty('DEFAULT_TENANT', null)->getPropertyValue();
		$data = $common->getSystemProperty('SIGNATURE_ID', $defaultTenant)->getPropertyValue();
		$secretKey = $common->getSystemProperty('SECRET_KEY', $defaultTenant)->getPropertyValue();
		$klinik=$this->input->post('klinik');
		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		$headers="X-cons-id: ".$data."\r\n" .
					  "X-timestamp: ".$tStamp."\r\n".
					  "X-signature: ".$encodedSignature."\r\n";
		
		$data=$this->post('data');
		//$headers=$this->post('headers');
		$url=$this->post('urlBriging');
		$headers.='Content-type: Application/x-www-form-urlencoded\r\n';
		$opts = array(
		  'http'=>array(
			'method'=>"POST",
			'header'=>$headers,
			'content'=>$data
		  )
		);
		$context = stream_context_create($opts);
		echo file_get_contents($url,false,$context);
	}
	public function initBridging(){
		$common = $this->common;
		$pid=$this->get('i');
		$ori=$common->find('Visit',$pid);
		if($ori != null){
			$data=array();
			$cus=array();
			$cus=$common->createQuery ( "SELECT M.id,M.customerName FROM ".$common->getModel('Customer')." M  ORDER BY M.customerName ASC" )->getResult();
			$oList=array();
			for($i=0,$iLen=count($cus); $i<$iLen ; $i++){
				$oO=$cus[$i];
				$oM=array();
				$oM['id']=$oO['id'];
				$oM['text']=$oO['customerName'];
				$oList[]=$oM;
			}
			$data['l3']=$oList;
			$units=array();
			$units=$common->createQuery ( "SELECT M FROM ".$common->getModel('Unit')." M  INNER JOIN
				M.unitType A WHERE
				A.optionCode='UNITTYPE_RWJ' ORDER BY M.unitName ASC" )->getResult();
			$oList=array();
			for($i=0,$iLen=count($units); $i<$iLen ; $i++){
				$oO=$units[$i];
				$oM=array();
				$oM['id']=$oO->getId();
				$oM['text']=$oO->getUnitName();
				$oM['code']=$oO->getUnitCode();
				$oList[]=$oM;
			}
			$data['l4']=$oList;
			$data['d']=$common->getSystemProperty('CUS_BPJS', $common->getSystemProperty('DEFAULT_TENANT', null)->getPropertyValue())->getPropertyValue();
				
			$mod=array();
			$unit=$ori->getUnit();
			$mod['f1']=$unit->getId();
			$mod['f2']=$ori->getDokter()->getId();
			$penyakit=$ori->getPenyakit();
			if($penyakit != null){
				$mod['f3']=$penyakit->getKodePenyakit();
				$mod['f3t']=$penyakit->getPenyakit();
			}else{
				$mod['f3']=null;
				$mod['f3t']='';
			}
			
			$mod['f4']=$ori->getCustomer()->getId();
			$mod['f5']=$unit->getUnitCode();
			$patient=$ori->getPatient();
			$mod['f6']=$patient->getKtp();
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
			$mod['f7']=$mr;
			$mod['f8']=$ori->getNomorPeserta();
			$data['o']=$mod;
			$this->jsonresult->setData($data)->end();
		}else{
			$result->error()->setMessageNotExist()->end();
		}
	}
	public function toExcel(){
		$common = $this->common;
		$ht='';
		$res=$this->dataList(true);
		$now=new DateTime();
		for($i=0,$iLen=count($res['data']); $i<$iLen; $i++){
			$d=$res['data'][$i];
			$patient=$d->getPatient();
			$birthDate='';
			if($patient->getBirthDate() != null)
				$birthDate=$patient->getBirthDate()->format('Y-m-d');
			$religion='';
			
			$rel=$patient->getReligion();
			if($rel != null)
				$religion=$rel->getOptionName();
			$education='';
			$edu=$patient->getEdu();
			if($edu != null)
				$education=$edu->getOptionName();
			$blodType='';
			$blod=$patient->getBlod();
			if($blod != null)
				$blodType=$blod->getOptionName();
			$countryText='';
			$country=$patient->getCountry();
			$countryTemp=$patient->getCountryTemp();
			if($country != null){
				if($country->getId() != 0){
					$countryText=$country->getValue();
				}else{
					if($countryTemp != null){
						$countryText=$countryTemp->getValue();
					}
				}
			}
			$provinceText='';
			$province=$patient->getProvince();
			$provinceTemp=$patient->getProvinceTemp();
			if($province != null){
				if($province->getId() != 0){
					$provinceText=$province->getValue();
				}else{
					if($provinceTemp != null){
						$provinceText=$provinceTemp->getValue();
					}
				}
			}
			
			$districtText='';
			$district=$patient->getDistrict();
			$districtTemp=$patient->getDistrictTemp();
			if($district != null){
				if($district->getId() != 0){
					$districtText=$district->getValue();
				}else{
					if($districtTemp != null){
						$districtText=$districtTemp->getValue();
					}
				}
			}
			
			$districtsText='';
			$districts=$patient->getDistricts();
			$districtsTemp=$patient->getDistrictsTemp();
			if($districts != null){
				if($districts->getId() != 0){
					$districtsText=$districts->getValue();
				}else{
					if($districtsTemp != null){
						$districtsText=$districtsTemp->getValue();
					}
				}
			}
			$kelurahanText='';
			$kelurahan=$patient->getKelurahan();
			$kelurahanTemp=$patient->getKelurahanTemp();
			if($kelurahan != null){
				if($kelurahan->getId() != 0){
					$kelurahanText=$kelurahan->getValue();
				}else{
					if($kelurahanTemp != null){
						$kelurahanText=$kelurahanTemp->getValue();
					}
				}
			}
			$dokter=$d->getDokter();
			$penyakitText='';
			$penyakit=$d->getPenyakit();
			if($penyakit != null)
				$penyakitText=$penyakit->getPenyakit();
			$customerText='';
			$customer=$d->getCustomer();
			if($customer != null)
				$customerText=$customer->getCustomerName();
			$mod=array();
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
			$bepText='';
			if($d->getKodeSep() != null && $d->getKodeSep() != ''){
				$bepText=$d->getPbi();
			}
			// kolom 8
			//<td>'.$patient->getGender()->getOptionName().'</td>
			$ht.='
				<tr>
					<td>'.($i+1).'</td>
					<td>'.$mr.'</td>
					<td>'.$patient->getKtp().'</td>
					<td>'.$patient->getTitle().'</td>
					<td>'.$patient->getName().'</td>
					<td>'.$patient->getBirthPlace().'</td>
					<td>'.$birthDate.'</td>
					<td>'.$patient->getGender()->getOptionName().'</td>
					<td>'.$religion.'</td>
					<td>'.$education.'</td>
					<td>'.$blodType.'</td>
					<td>'.$patient->getAddress().'</td>
					<td>'.$patient->getPostalCode().'</td>
					<td>'.$patient->getPhoneNumber().'</td>
					<td>'.$patient->getRt().'</td>
					<td>'.$patient->getRw().'</td>
					<td>'.$countryText.'</td>
					<td>'.$provinceText.'</td>
					<td>'.$districtText.'</td>
					<td>'.$districtsText.'</td>
					<td>'.$kelurahanText.'</td>
					<td>'.$d->getNomorPendaftaran().'</td>
					<td>'.$d->getEntryDate()->format('Y-m-d').'</td>
					<td>'.$d->getUnit()->getUnitName().'</td>
					<td>'.$dokter->getFirstName().' '.$dokter->getLastName().'</td>
					<td>'.$penyakitText.'</td>
					<td>'.$d->getAntrian().'</td>
					<td>'.$customerText.'</td>
					<td>'.$d->getStatus().'</td>
					<td>'.$d->getKodeSep().'</td>
					<td>'.$bepText.'</td>		
					<td>'.$d->getNomorPeserta().'</td>
					<td>'.$d->getNamaPeserta().'</td>
					<td>'.$d->getJenisDaftar()->getOptionName().'</td>
				</tr>	
			';
		}
		$html="
			<table border='1'>
				<thead>
					<tr>
						<th rowspan='2'>No
						</th>
						<th colspan='20'>
							Data Pasien
						</th>
						<th colspan='12'>
							Data Kunjungan
						</th>
					</tr>
					<tr>
						<th>No. Medrec</th>
						<th>No. KTP</th>
						<th>Gelar</th>
						<th>Nama Pasien</th>
						<th>Tempat Lahir</th>
						<th>Tgl. Lahir</th>
						<th>J. Kelamin</th>
						<th>Agama</th>
						<th>Pen. Terakhir</th>
						<th>Gol. Darah</th>
						<th>Alamat</th>
						<th>Kode Pos</th>
						<th>Telepon</th>
						<th>RT</th>
						<th>RW</th>
						<th>Negara</th>
						<th>Provinsi</th>
						<th>Kota</th>
						<th>Kecamatan</th>
						<th>Kelurahan</th>
						<th>No. pendaftaran</th>
						<th>Tgl. Berobat</th>
						<th>Poliklinik</th>
						<th>Nama Dokter</th>
						<th>Diagnosa</th>
						<th>No. Antrian</th>
						<th>Jns. Pasien</th>
						<th>Status Dilayani</th>
						<th>Kode SEP</th>
						<th>BEP</th>
						<th>No. Peserta BPJS</th>
						<th>Nama Peserta BPJS</th>
						<th>Jns. Daftar</th>
					</tr>
				</thead>
				<tbody>
				".$ht."
				</tbody>
			</table>
		";
		
		$common->excel($html,'KUNJUNGAN-'.$now->format('Ymd').'.xls');
	}
	public function cetakSep($sep){
		$common = $this->common;
		
		$now=new DateTime();
	//	$kunjungan=$common->find('Visit',$this->get('i'));
	//	$peserta=json_decode($kunjungan->getJsonBpjs());
		$sep=json_decode($sep);
		//print_r($sep);
		//echo $response->sep->noSep;
		//die();
		//die();
		//$patient=$kunjungan->getPatient();
	//	$mr=$patient->getPatientCode();
		/*if(is_numeric($mr)==true){
			$split=str_split(strval($mr),2);
			$mr='';
			for($j=0,$jLen=count($split); $j<$jLen ; $j++){
				if($mr!=''){
					$mr.='-';
				}
				$mr.=$split[$j];
			}
		}*/
		//$poli=$kunjungan->getUnit();
		//$penyakit=$kunjungan->getPenyakit();
		//$tglLahir=new DateTime($sep->response->tglLahir);
		$jk='PRIA';
		//if($peserta->sex=='P')
			$jk='WANITA';
		$html='
			<table border="0"  style="font-size: 12px !important;">
				<tr>
					<td width="66%">
						<table>
							<tr>
								<td width="100" style="text-align: center;">
									<img src="include/logo.png" style="width: 50px;">
								</td>
								<td width="10">&nbsp;</td>
								<td style="text-align: center;">
									<div style="font-size: 19px !important;font-weight: bold;">SURAT ELEGIBILITAS PESERTA</div>
									<div style="font-size: 12px;">RSUD EMBUNG FATIMAH BATAM</div>
								</td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td>
									No. SEP
								</td>
								<td>:</td>
								<td>
									'.$sep->response->noSep.'
								</td>
							</tr>
							<tr>
								<td>
									Tgl. SEP
								</td>
								<td>:</td>
								<td>
									'.$sep->tglSep.'
								</td>
							</tr>
							<tr>
								<td>
									No. Kartu
								</td>
								<td>:</td>
								<td>
									'.$sep->response->peserta->noKartu.'
								</td>
							</tr>
							<tr>
								<td>
									Nama Peserta
								</td>
								<td>:</td>
								<td>
									'.$sep->response->peserta->nama.'
								</td>
							</tr>
							<tr>
								<td>
									Tgl. Lahir
								</td>
								<td>:</td>
								<td>
									'.$tglLahir.'
								</td>
							</tr>
							<tr>
								<td>
									Jns Kelamin
								</td>
								<td>:</td>
								<td>
									'.$sep->response->peserta->kelamin.'
								</td>
							</tr>
							<tr>
								<td>
									Poli Tujuan
								</td>
								<td>:</td>
								<td>
									'.$sep->response->poli.'
								</td>
							</tr>
							<tr>
								<td>
									Asal Faskes Tk. I
								</td>
								<td>:</td>
								<td>
								Faskes
								</td>
							</tr>
							<tr>
								<td>
									Diagnosa Awal
								</td>
								<td>:</td>
								<td>
									'.$sep->response->diagnosa.'
								</td>
							</tr>
							<tr>
								<td>
									'.$sep->response->catatan.'
								</td>
								<td>:</td>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="3" style="font-size: 10px !important;"><i>*Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan</i></td>
							</tr>
							<tr>
								<td colspan="3" style="font-size: 10px !important;"><i>*SEP bukan sebagai bukti penjaminan peserta</i></td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;Catatan Ke 1</td>
							</tr>
						</table>
					</td>
					<td valign="top">
						<img src="include/Logo BPJS.png" style="width: 220px;margin-left: 20px;margin-top: 20px;margin-bottom: 20px;">
						<table border="0">
							<tr>
								<td colspan="3">
									&nbsp;
								</td>
							</tr>
							<tr>
								<td width="60">
									No. Mr
								</td>
								<td width="10">:</td>
								<td>
									no medrec
								</td>
							</tr>
							<tr>
								<td colspan="3">
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									Peserta
								</td>
								<td>:</td>
								<td>
									BPJS()
								</td>
							</tr>
							<tr>
								<td colspan="3">
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									COB
								</td>
								<td>:</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>
									Jns. Rawat
								</td>
								<td>:</td>
								<td>Rawat Jalan</td>
							</tr>
							<tr>
								<td>
									Kls. Rawat
								</td>
								<td>:</td>
								<td>$sep->response->hakKelas</td>
							</tr>
						</table><br>
						<table>
							<tr>
								<td width="40%">Pasien / Keluarga Pasien</td>
								<td width="20%">&nbsp;</td>
								<td width="40%">Petugas BPJS Kesehatan</td>
							</tr>
							<tr>
								<td colspan="3" style="height: 30px;">&nbsp;</td>
							</tr>
							<tr>
								<td style="border-bottom: 1px solid black;">&nbsp;</td>
								<td>&nbsp;</td>
								<td style="border-bottom: 1px solid black;">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		';
	//	echo $html;
 	pdf(array('html'=>$html,'margin-top'=>15,'margin-left'=>15,'margin-right'=>15,'paper'=>array(0, 0, 595, 320),'page-number'=>false,array("Attachment" => false)));
	}
	public function save(){
		$common=$this->common;
		$result = $this->jsonresult;
		$pid=$this->post('i');
		$kunjungan=$common->find('Visit',$pid);
		$klinik=$this->post('f1');
		$poliklinik=$common->find('Unit',$klinik);
		$dokter_id=$this->post('f2');
		$dokter=$common->find('Employee',$dokter_id);
		$alasan=$this->post('f3');
	
		$now=new DateTime();
		$codeHari='';
		$namaHari='';
		if($now->format('D')=='Mon'){
			$codeHari='DAY_1';
			$namaHari='Senin';
		}else if($now->format('D')=='Tue'){
			$codeHari='DAY_2';
			$namaHari='Selasa';
		}else if($now->format('D')=='Wed'){
			$codeHari='DAY_3';
			$namaHari='Rabu';
		}else if($now->format('D')=='Thu'){
			$codeHari='DAY_4';
			$namaHari='Kamis';
		}else if($now->format('D')=='Fri'){
			$codeHari='DAY_5';
			$namaHari='Jumat';
		}else if($now->format('D')=='Sat'){
			$codeHari='DAY_6';
			$namaHari='Sabtu';
		}else{
			$codeHari='DAY_7';
			$namaHari='Minggu';
		}
		$jadwal=$common->createQuery("SELECT u FROM ".$common->getModel('JadwalPoli')." u
			INNER JOIN u.unit A
			INNER JOIN u.dokter B
			INNER JOIN u.hari C
			WHERE
			A.id=".$klinik." AND
			C.optionCode='".$codeHari."' AND
			B.id=".$dokter_id."
			ORDER BY u.jam ASC")->getResult();
		$ObjectAntrian=$common->createQuery("SELECT u FROM ".$common->getModel('Antrian')." u
			INNER JOIN u.unit A
			INNER JOIN u.dokter B
			WHERE
			u.tglMasuk='".$now->format('Y-m-d')."' AND
			A.id=".$klinik." AND
			B.id=".$dokter_id);
		if($jadwal){
			$jumlah=0;
			for($i=0,$iLen=count($jadwal); $i<$iLen ; $i++){
				$jumlah+=$jadwal[$i]->getMaxAntrian();
			}
			if(!$ObjectAntrian->getResult() || ($jumlah>$ObjectAntrian->getSingleResult()->getAntrian())){
				$antri=1;
				if($ObjectAntrian->getResult()){
					$antrian=$ObjectAntrian->getSingleResult();
					$antri=$antrian->getAntrian()+1;
					$antrian->setAntrian($antri)->update();
				}else{
					$antrian=$common->newModel('Antrian');
					$antrian->setTglMasuk($now)
					->setUnit($poliklinik)
					->setDokter($dokter)
					->setAntrian($antri)
					->save();
				}
				$visit=null;
				$entrySeq=1;
				if($pid != null && $pid != ''){
					$visit=$common->createQuery("SELECT u FROM ".$common->getModel('Visit')." u
							INNER JOIN u.unit A
							INNER JOIN u.patient C
							WHERE
							u.entryDate='".$now->format('Y-m-d')."' AND
							A.id=".$klinik." AND
							C.id=".$kunjungan->getPatient()->getId()."
							ORDER BY u.entrySeq DESC
							")->setMaxResults(1);
					if($visit->getResult()){
						$obj=$visit->getSingleResult();
						$entrySeq=$obj->getEntrySeq()+1;
					}
				}
				$kunjungan->setUnit($poliklinik)
					->setDokter($dokter)
					->setAntrian($antri)
					->setEntrySeq($entrySeq)
					->setCatatanPerubahan($alasan)
					->update();
				$result->setMessage('Kunjungan Berhasil diubah.')->end();
			}else{
				$result->error()->setMessage('Pendaftaran Gagal, Poliklinik: '.$poliklinik->getUnitName().
						', Dokter : '.$dokterO->getFirstName().' '.$dokterO->getLastName().', Antrian Sudah Penuh. Harap Pilih Tanggal Jadwal Yang Lain.')->end();
			}
		}else{
			$result->error()->setMessage('Pendaftaran Gagal, Poliklinik: '.$poliklinik->getUnitName().
					', Dokter : '.$dokterO->getFirstName().' '.$dokterO->getLastName().', Sedang Tidak Ada Jadwal. Harap Pilih Tanggal Jadwal Yang Lain.')->end();
		}
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
	
		$pid=$this->get('i');
		$ori=$common->find('Visit',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getUnit()->getId();
			$dokter=$ori->getDokter();
			$mod['f2']=$dokter->getId();
			$data['o']=$mod;
			$units=array();
			$units=$common->createQuery ( "SELECT M.id,M.unitName FROM ".$common->getModel('Unit')." M  INNER JOIN
					M.unitType A WHERE
					A.optionCode='UNITTYPE_RWJ' ORDER BY M.unitName ASC" )->getResult();
			$oList=array();
			for($i=0,$iLen=count($units); $i<$iLen ; $i++){
				$oO=$units[$i];
				$oM=array();
				$oM['id']=$oO['id'];
				$oM['text']=$oO['unitName'];
				$oList[]=$oM;
			}
			$data['l']=$oList;
			$result->setData($data)->end();
		}else
			$result->error()->setMessageNotExist()->end();
	}
	public function getDokter(){
		$em = $this->doctrine->em;
		$common=$this->common;
		$text=$this->input->get('query');
		$unit=$this->input->get('i');
		$arr=array();
		$criteria='';
		if(trim($unit) != ''){
			$criteria='AND A.id='.$unit;
		}
		$res=$common->createQuery("
									SELECT B.id, B.firstName, B.lastName 
									FROM ".$common->getModel('DokterKlinik')." u
										INNER JOIN u.unit A
										INNER JOIN u.dokter B
									WHERE (UPPER(B.firstName) LIKE UPPER('%".$text."%') or UPPER(B.lastName) LIKE UPPER('%".$text."%') )
										".$criteria."
								 	ORDER BY B.firstName ASC
								")
		 		->setMaxResults(10)
		 		->getResult();
		for($i=0,$iLen=count($res); $i<$iLen ; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=$country['id'];
			$o['text']=$country['firstName']." ".$country['lastName'];
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function setStatus(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pid=$this->post('i');
		$status=$this->post('f2');
		if($status=='true')
			$status=true;
		else
			$status=false;
		$kunjungan=$common->find('Visit',$pid);
		if($kunjungan != null){
			$kunjungan->setStatus($status)
				->update();
			$result->setMessage('Status dilayani Berhasil diubah.')->end();
		}else 
			$result->error()->setMessageNotExist()->end();
	}
	public function setHadir(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pid=$this->post('i');
		$status=$this->post('f2');
		if($status=='true')
			$status=true;
		else
			$status=false;
		$kunjungan=$common->find('Visit',$pid);
		if($kunjungan != null){
			$kunjungan->setHadir($status)
			->update();
			$result->setMessage('Status Hadir Berhasil diubah.')->end();
		}else
			$result->error()->setMessageNotExist()->end();
	}
	public function initSearch(){
		$common = $this->common;
		$result = $this->jsonresult;
		$data=array();
		$units=array();
		$units=$common->createQuery ( "SELECT M.id,M.unitName FROM ".$common->getModel('Unit')." M  INNER JOIN 
				M.unitType A WHERE
				A.optionCode='UNITTYPE_RWJ' ORDER BY M.unitName ASC" )->getResult();
		$oList=array();
		for($i=0,$iLen=count($units); $i< $iLen; $i++){
			$oO=$units[$i];
			$oM=array();
			$oM['id']=$oO['id'];
			$oM['text']=$oO['unitName'];
// 			$oM['code']=$oO->getUnitCode();
			$oList[]=$oM;
		}
		$data['l']=$oList;
		$data['l1']=$common->getParams('ACTIVE_FLAG');
		$data['l3']=$common->getParams('JNS_DAFTAR');
		$cus=array();
		$cus=$common->createQuery ( "SELECT M.id,M.customerName FROM ".$common->getModel('Customer')." M  ORDER BY M.customerName ASC" )->getResult();
		$oList=array();
		for($i=0,$iLen=count($cus); $i<$iLen ; $i++){
			$oO=$cus[$i];
			$oM=array();
			$oM['id']=$oO['id'];
			$oM['text']=$oO['customerName'];
			$oList[]=$oM;
		}
		$data['l2']=$oList;
		$result->setData($data)->end();
	}
	public function selfWindow(){
		$this->load->view ( 'admin/self_register' );
	}
	public function getNomorPendaftaran(){
		$common = $this->common;
		$result = $this->jsonresult;
		$noRegistrasi=$this->get('noRegister');
		$res=$common->createQuery("SELECT M FROM ".$common->getModel('Visit')." M INNER JOIN M.customer C WHERE M.nomorPendaftaran='".$noRegistrasi."' AND M.hadir=false");
	//	echo $res->getSql();
		if($res->getResult()){
			$ori=$res->getSingleResult();
			$patient=$ori->getPatient();
			//$customer=$ori->getCustomerName();
			$o=array();
			$o['f1']=$patient->getName();
			$o['f2']=$patient->getBirthDate()->format('d M Y');
			$o['f3']=$ori->getUnit()->getUnitName();
			$dokter=$ori->getDokter();
			$o['f4']=$dokter->getFirstName()." ".$dokter->getLastName();
			$o['f5']=$ori->getAntrian();
			$o['f6']=$ori->getCustomer()->getCustomerName();
			$o['f7']=$ori->getNomorPeserta();
			$o['f8']=$ori->getnoRujukan();
			$o['f9']=$ori->getKelas();
			$o['f10']=$ori->getFaskesAsal();
			$o['f11']=$ori->getDiagnosa();
			$o['f12']=$ori->getPoliTujuan();
			$o['f13']=$ori->getNomorPendaftaran();
			$result->setData($o)->end();
		}else{
			$result->error()->setMessage("Nomor Pendaftaran '".$noRegistrasi."' tidak ditemukan, Masukan Data yang Benar.")->end();
		}
	}
	public function setNomorPendaftaran(){
		
		$this->load->library('fpdf/FPDF');
		$db=$this->load->database('other',true);
		$noRegistrasi=$this->get('noRegister');
		$jenis_pasien=$this->get('jenis_pasien');
		
		/* $noRegistrasi=$this->uri->segment(4); 
		$jenis_pasien=$this->uri->segment(6); */
	//	echo $jenis_pasien;
		if($jenis_pasien==1){
			$pasien_bpjs='true';
		}else{
			$pasien_bpjs='false';
		}
		$common = $this->common;
		$result = $this->jsonresult;
		$res=$common->createQuery("SELECT M FROM ".$common->getModel('Visit')." M WHERE M.nomorPendaftaran='".$noRegistrasi."' AND M.hadir=false");
		if($res->getResult()){
			$ori=$res->getSingleResult();
			$ori->setHadir(true)
				->update();
			$medrec_lama=$ori->getPatient()->getPatientCode();
			$unit=$ori->getUnit()->getUnitCode();
			$customer=$ori->getCustomer()->getCustomerCode();
			
			
			/******************************************************************
				 VALIDASI PASIEN BARU LAMA 2018-11-28
			*******************************************************************/
			
			
			$medrec_lama_tampung = str_replace('-', '', $medrec_lama);
			
			if(strlen($medrec_lama_tampung) == 8){
				$baru = 'true';
			}else{
				$baru = 'false';
			}
			
			
			
			/********************************************************************/
			
			
			if($pasien_bpjs=='true' && $baru=='true'){
				//echo "1";
				$save=$this->save_bpjs_pasien_baru($noRegistrasi,$baru,$unit,$customer,$ori,$medrec_lama);
				echo json_encode(array('response'=>$save[0],'no_sep'=>$save[1]));
	
				//$this->insert_transaksi_cetak_no_antrian();

			}else if ($pasien_bpjs =='true' && $baru=='false'){
				//echo "2";
				$save=$this->save_bpjs_pasien_lama($noRegistrasi,$baru,$medrec_lama,$unit,$customer,$ori);
				echo json_encode(array('response'=>$save[0],'no_sep'=>$save[1]));
	
				// echo $save;
				//$this->insert_transaksi_cetak_no_antrian();

			}elseif ($pasien_bpjs=='false' && $baru=='true') {
				//echo "3";
				$save=$this->save_pasien_baru_umum($noRegistrasi,$baru,$unit,$customer,$ori,$medrec_lama);
				echo json_encode(array('response'=>$save[0]));
				// echo 'Pendaftaran Berhasil, Silahkan Ambil No. Resi Untuk Pembayaran di Kasir.';
			//	$this->insert_transaksi_cetak_no_antrian();

			}elseif ($pasien_bpjs=='false' && $baru=='false') {
			//	echo "4";
				$save=$this->save_pasien_lama_umum($noRegistrasi,$baru,$medrec_lama,$unit,$customer,$ori);
				echo json_encode(array('response'=>$save[0]));
				// echo 'Pendaftaran Berhasil, Silahkan Ambil No. Resi Untuk Pembayaran di Kasir.';
				//$this->insert_transaksi_cetak_no_antrian();
			}
			
			// $result=$save;	
			
			// var_dump($result);		
		}else{
			$result->error()->setMessage("Nomor Pendaftaran '".$noRegistrasi."' tidak ditemukan, Masukan Data yang Benar.")->end();
		}
	}
	public function dataList($type=false){
		$common = $this->common;
		
		$first=$this->get('page',false);
		$size=$this->get('pageSize',false);
		$direction=$this->get('d',false);
		$sorting=$this->get('s',false);
		
		$noMedrec=$this->get('f1',false);
		$noPendaftran=$this->get('f2',false);
		$namaPasien=$this->get('f3',false);
		$unit=$this->get('f4',false);
		$namaDokter=$this->get('f5',false);
		$startDate=$this->get('f6',false);
		$endDate=$this->get('f7',false);
		$antrian=$this->get('f8',false);
		$status=$this->get('f9',false);
		$hadir=$this->get('f10',false);
		$jnsPasien=$this->get('f11',false);
		$kdSep=$this->get('f12',false);
		$jnsReg=$this->get('f13',false);
		
		$entity=$common->getModel('Visit');
		$criteria="";
		$inner='
				INNER JOIN M.patient
				INNER JOIN M.unit B
				INNER JOIN M.dokter C
				LEFT JOIN M.customer D
				INNER JOIN M.jenisDaftar E';
		if($noMedrec != null && trim($noMedrec)!=''){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
			$criteria.=" upper(A.patientCode) like upper('%".$noMedrec."%')";
		}
		if($jnsReg != null && trim($jnsReg)!=''){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
			$criteria.=" E.optionCode='".$jnsReg."'";
		}
		if($noPendaftran != null && trim($noPendaftran)!=''){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
			$criteria.=" upper(M.nomorPendaftaran) like upper('%".$noPendaftran."%')";
		}
		if($namaPasien != null && trim($namaPasien)!=''){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
			$criteria.=" upper(A.name) like upper('%".$namaPasien."%') ";
		}
		if($unit != null && trim($unit)!=''){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
			$criteria.=" B.id=".$unit;
		}
		if($unit != null && trim($namaDokter)!=''){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
			$criteria.=" (upper(C.firstName) like upper('%".$namaDokter."%') OR upper(C.secondName) like upper('%".$namaDokter."%') OR upper(C.lastName) like upper('%".$namaDokter."%'))";
		}
		
		$now=new DateTime();
		if($criteria=='')
			$criteria.=" WHERE ";
		else
			$criteria.=" AND ";

		if($startDate != null && $startDate !='null' && trim($startDate)!=''){
			$dateStart=new DateTime($startDate);
			$criteria.=" M.entryDate>='".$dateStart->format('Y-m-d')."' ";
		}else{
			$criteria.=" M.entryDate>='".$now->format('Y-m-d')."' ";
		}
		if($criteria=='')
			$criteria.=" WHERE ";
		else
			$criteria.=" AND ";

		if($endDate != null && $endDate!= 'null' && trim($endDate)!=''){
			$dateEnd=new DateTime($endDate);
			$criteria.=" M.entryDate<='".$dateEnd->format('Y-m-d')."' ";
		}else{
			//$criteria.=" M.entryDate<='".$now->format('Y-m-d')."' ";
			$date_besok = new DateTime();
			$date_besok->modify('+1 day');
			$criteria.=" M.entryDate<='".$date_besok->format('Y-m-d')."' ";
		}
		if($antrian != null && trim($antrian)!=''){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
			$criteria.=" M.antrian=".$antrian;
		}
		
		if($criteria=='')
			$criteria.=" WHERE ";
		else
			$criteria.=" AND ";
		if(trim($status)!=''){
			if(trim($status)=='Y')
				$criteria.=" M.status =true";
			else
				$criteria.=" M.status =false";
		}else{
			$criteria.=" M.status =false";
		}
		
		
		if(trim($hadir)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			if(trim($hadir)=='Y')
				$criteria.=" M.hadir =true";
			else
				$criteria.=" M.hadir =false";
		}
		
		if(trim($jnsPasien)!=''){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
			$criteria.=" D.id=".$jnsPasien;
		}
		if(trim($kdSep)!=''){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
			$criteria.=" upper(M.kodeSep) like upper('%".$kdSep."%')";
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
			case "f1":
				$orderBy.='A.patientCode '.$direction;
				break;
			case "f2":
				$orderBy.='A.name '.$direction;
				break;
			case "f3":
				$orderBy.='B.unitName '.$direction;
				break;
			case "f4":
				$orderBy.='C.firstName '.$direction;
				break;
			case "f5":
				$orderBy.='M.entryDate '.$direction;
				break;
			case "f6":
				$orderBy.='M.antrian '.$direction;
				break;
			case "f8":
				$orderBy.='M.nomorPendaftaran '.$direction;
				break;
			case "f11":
				$orderBy.='M.kodeSep '.$direction;
				break;
			default:
				$orderBy.='M.entryDate,B.unitName,C.firstName,M.antrian ASC';
				break;
		}
		
		$total=$common->createQuery("SELECT count(M) AS total FROM ".$entity." M  ".$inner." ".$criteria)->getSingleResult();
		$res=$common->createQuery("SELECT M FROM ".$entity." M ".$inner." ".$criteria." ".$orderBy);
		if($type==false)
			$res->setFirstResult($first)->setMaxResults($size);
		return array('data'=>$res->getResult(),'total'=>$total['total']);
	}
	public function getList(){
		$result = $this->jsonresult;
		$res=$this->dataList();
		$list=array();
		for($i=0,$iLen=count($res['data']); $i<$iLen; $i++){
			$r=$res['data'][$i];
			$o=array();
			$o['i']=$r->getId();
			$patient=$r->getPatient();
			$mod=array();
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
			$o['f1']=$mr;
			$o['f2']='<a href="javascript:loadView(\'App.content.rs1.View\','.$patient->getId().')">'.$patient->getName().'</a>';
			$o['f3']=$r->getUnit()->getUnitName();
			$dokter=$r->getDokter();
			$o['f4']='<a href="javascript:loadView(\'App.system.a5.View\','.$dokter->getId().')">'.$dokter->getFirstName()." ".$dokter->getLastName().'</a>';
			$o['f5']=$r->getEntryDate()->format('d M Y');
			$o['f6']=$r->getAntrian();
			$o['f7']=$r->getStatus();
			$o['f8']=$r->getNomorPendaftaran();
			$o['f9']=$r->getHadir();
			$o['f12']=$r->getJenisDaftar()->getOptionName();
			$rujukan=$r->getRujukan();
			if($rujukan != null){
				$o['f13']=$rujukan->getNomorRujukan();
			}else{
				$o['f13']='';
			}
			$cus=$r->getCustomer();
			if($cus != null){
				$o['f10']=$cus->getCustomerName();
			}else{
				$o['f10']='';
			}
			$o['f11']=$r->getKodeSep();
			$list[]=$o;
		}
		$result->setData($list)->setTotal($res['total'])->end();
	}

	
	/************************************ Fungsi generate SEP 2018-11-30 ************************************************/
	public function generateSEP($noRegistrasi,$baru,$medrec){
		$db=$this->load->database('other',true);
		$no_sep='';
		$this->load->library('curl');
		
		//$url="http://api.bpjs-kesehatan.go.id:8080/VClaim-rest/SEP/insert";

		/*URL BRIDIGING BPJS*/
	
		//$url="https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/SEP/1.1/insert"; //BPJS REAL

		$url="https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/SEP/1.1/insert";
		$get_data_bpjs=$this->db->query("select * from rs_visit a inner join rs_patient b on a.patient_id=b.patient_id where no_pendaftaran='$noRegistrasi'");
		
		$getNoSurat  = $db->query("select * from sys_setting where key_data= 'rwj_nosurat_dpjp'")->row();
		$noSurat	 = '';
		if(count($getNoSurat) > 0){
			$noSurat = $getNoSurat->setting;
			$noSurat =  $getNoSurat->setting+1;
			$noSurat = str_pad($noSurat, 6, '0', STR_PAD_LEFT); 
		}else{
			$noSurat = '000001';
		}
		
		
		$getJson=$this->getJsonReq($get_data_bpjs,$baru,$medrec,$noSurat);
		
		
		$headers=$this->getSignatureVedika();
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $getJson);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE); //HARUS PAKE JIKA HTTPS URLNYA
		$response = curl_exec($ch);
		curl_close ($ch);
		
		$no_sep=json_decode($response);
		
		if($no_sep->metaData->code=='201'){
			$no_sep=str_replace("1.Peserta NoKa 0002033273777 telah mendapat Pelayanan R.Jalan di Poli MAT pada hari yg sama di RSUD DR.SOEDONO Dgn No.SEP", "", $no_sep->metaData->message);
			return array('false',$no_sep);
		}else{
			//BERHASIL CREATE SEP
			//UPDATE NO DPJP DI TABEL SYS_SETTING (rwj_nosurat_dpjp)
			$update= $db->query("update sys_setting set setting =".$noSurat." where key_data='rwj_nosurat_dpjp' ");
		
			// $this->cetaksepbpjs($no_sep->response->sep->noSep); //preview sep
			$this->print_cetak_sep($no_sep->response->sep->noSep); //cetakan direct sep
			return array('true',$no_sep->response->sep->noSep,$noSurat);
		}
	}
	
	/* URL BRIDIGING BPJS
		SET CUSTOMERID DAN SECRETKEY
	*/

	private function getSignatureVedika(){
		//BPJS REAL
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
	
	
	public function getJsonReq($getJsonReq,$baru,$medrec,$no_surat){
		$no_medrec='';
		$db=$this->load->database('other',true);
		if($baru=='false'){
			$no_medrec=$medrec;
			
		}else{
			$no_medrec=$this->getNoMedrec();
		}
		
		
		
		$kodeDPJP='12708'; // DIAMBIL DARI INPUTAN USER [pemberi surat], dikarenakan dokter yang berada dipilihan kombo tidak sesuai (menggunakan sample no asuransi 0000104951406) makanya dipatok dulu
		 /* $kodeDPJP=$getJsonReq->row()->kd_dpjp; //NANTI PAKENYA YANG INI */
		$json='{
           "request": {
              "t_sep": {
                 "noKartu": "'.$getJsonReq->row()->nomor_peserta.'",
                 "tglSep": "'. date("Y-m-d").'",
                 "ppkPelayanan": "1308R001",
                 "jnsPelayanan": "2",
                 "klsRawat": "'.$getJsonReq->row()->kd_kelas.'",
                 "noMR": "'.$no_medrec.'",
                 "rujukan": {
                    "asalRujukan": "'.$getJsonReq->row()->faskes.'",
                    "tglRujukan": "'.$getJsonReq->row()->tgl_rujukan.'",
                    "noRujukan": "'.$getJsonReq->row()->no_rujukan.'",
                    "ppkRujukan": "'.$getJsonReq->row()->kd_rujukan.'"
                 },
                 "catatan": "Pendaftaran Online",
                 "diagAwal": "'.$getJsonReq->row()->kd_diagnosa.'",
                 "poli": {
                    "tujuan": "'.$getJsonReq->row()->kd_poli.'",
                    "eksekutif": "0"
                 },
                 "cob": {
                    "cob": "0"
                 },
                 "katarak": {
                    "katarak": "0"
                 },
                 "jaminan": {
                    "lakaLantas": "0",
                    "penjamin": {
                        "penjamin": "0" ,
                        "tglKejadian": "'.date('Y-m-d').'",
                        "keterangan": "",
                        "suplesi": {
                            "suplesi": "0",
                            "noSepSuplesi":  "0",
                            "lokasiLaka": {
                                "kdPropinsi":  "0",
                                "kdKabupaten":  "0",
                                "kdKecamatan":  "0"
                                }
                        }
                    }
                 },
                 "skdp": {
                    "noSurat": "'.$no_surat.'",
                    "kodeDPJP": "'.$kodeDPJP.'"
                 },
                 "noTelp": "'.$getJsonReq->row()->phone_number.'",
                 "user": "Coba Ws"
              }
           }
        }';
       return $json; 	
		
	}
	
	/*********************************************************************************************************/
	private function getSignatureVedikaAsal(){
		$tmp_secretKey="3cDAEE1ED1";
		$tmp_costumerID= "15081";
		date_default_timezone_set('UTC');
		$tStamp = time();
		$signature = hash_hmac('sha256', $tmp_costumerID."&".$tStamp, $tmp_secretKey, true);
		$encodedSignature = base64_encode($signature);
		return array("X-Cons-ID: ".$tmp_costumerID,"X-Timestamp: ".$tStamp,"X-Signature: ".$encodedSignature);
	}
	
	/*asal*/
	public function getJsonReqAsal($getJsonReq,$baru,$medrec){
		$no_medrec='';
		$db=$this->load->database('other',true);
		if($baru=='false'){
			$no_medrec=$medrec;
			
		}else{
			$no_medrec=$this->getNoMedrec();
		}
		$xml='<data>' .
										'<request>' .
											'<t_sep>' .
											'<noKartu>' .$getJsonReq->row()->nomor_peserta. '</noKartu>' .
											'<tglSep>' . date("Y-m-d"). '</tglSep>' .
											'<ppkPelayanan>1308R001</ppkPelayanan>' .
											'<jnsPelayanan>2</jnsPelayanan>' .
											'<klsRawat>'.$getJsonReq->row()->kd_kelas.'</klsRawat>' .
											'<noMR>'.$no_medrec.'</noMR>' .
											'<rujukan>'.
												'<asalRujukan>1</asalRujukan>'.
												'<ppkRujukan>'.$getJsonReq->row()->kd_rujukan.'</ppkRujukan>'.
												'<noRujukan>'.$getJsonReq->row()->no_rujukan.'</noRujukan>'.
												'<tglRujukan>'. date("Y-m-d") .'</tglRujukan>'.
											'</rujukan>' .
											'<catatan>0</catatan>'.
											'<diagAwal>'.$getJsonReq->row()->kd_diagnosa.'</diagAwal>'.
											'<poli>'.
												'<tujuan>'.$getJsonReq->row()->kd_poli.'</tujuan>'.
												'<eksekutif>0</eksekutif>'.
											'</poli>'.
											'<cob>'.
												'<cob>0</cob>'.
											'</cob>'.
											'<jaminan>'.
												'<lakaLantas>0</lakaLantas>'.
												'<penjamin>0</penjamin>'.
												'<lokasiLaka>0</lokasiLaka>'.
											'</jaminan>'.
											'<noTelp>'.$getJsonReq->row()->phone_number.'</noTelp>'.
											'<user>Test WS</user>'.
											'</t_sep>'.
										'</request>' .
										'</data>';
						return $xml;
	}
	
	public function generateSEPAsal($noRegistrasi,$baru,$medrec){
		$no_sep='';
		$this->load->library('curl');
		//$url="http_date()://localhost/rssm_online/get/test";
		$url="http://api.bpjs-kesehatan.go.id:8080/VClaim-rest/SEP/insert";
		$get_data_bpjs=$this->db->query("select * from rs_visit a inner join rs_patient b on a.patient_id=b.patient_id where no_pendaftaran='$noRegistrasi'");
		$getJson=$this->getJsonReqAsal($get_data_bpjs,$baru,$medrec);
		$headers=$this->getSignatureVedikaAsal();
		$xml   = simplexml_load_string($getJson);
		$json  = json_encode($xml);
		$array = json_decode($json,TRUE); 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		$headers[]='Content-Type: Application/x-www-form-urlencoded';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
		$response = curl_exec($ch);
		curl_close ($ch);
		//echo $response;
		//die();
		$no_sep=json_decode($response);
		if($no_sep->metaData->code=='201'){
			echo "if";
			$no_sep=str_replace("1.Peserta NoKa 0002033273777 telah mendapat Pelayanan R.Jalan di Poli MAT pada hari yg sama di RSUD DR.SOEDONO Dgn No.SEP", "", $no_sep->metaData->message);
			$this->cetaksepbpjs(str_replace(" ", "", $no_sep));
		}else{
			$this->cetaksepbpjs($no_sep->response->sep->noSep);
		}
	
		return $no_sep->response->sep->noSep;


		
	}
	/* end asal*/
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

	public function cetaksepbpjs($no_sep){
		
		$this->load->library('fpdf/FPDF');
		$db=$this->load->database('SIM',true);
		$uri = $_SERVER["REQUEST_URI"];
		$uriArray = explode('/', $uri);
		$param1 = $no_sep;
		$catatantambahan = str_replace('~~_~~','/',$uriArray[(count($uriArray)-1)]);
		$catatantambahanasli = str_replace('%20',' ',$catatantambahan);
	 	$html='';
		$style='<style>
	 			.normal{
					width: 100%;
					font-family: Times New Roman, Helvetica, sans-serif;
   					border-collapse: none;
				} 
				
					
				.bottom{
					border-bottom: none;
	 				font-size: 12px;
				}
	 			
				div{
	 				text-align: justify;
					border:1px none;
    				text-justify: inter-word;
	 			}
				@media print{
					.no-print, .no-print *{
						display: none !important;
					}
				}
           </style>';
		$kd_rs='3577015';
		//echo $kd_rs;
		$rs=$db->query("SELECT * FROM db_rs WHERE code='".$kd_rs."'")->row();
		//<script>
			//	window.print();
		//	</script>
		$html.="
		<html>
		<head>
			".$style."
		</head>
		<body style='padding-top:100px;'>
		<table style='margin: 50px 50px 0px 50px;' cellspacing='0' border='0'>
   			<tr align=justify>
   				<th border='0';  width='10%' align='center'>
   					<img src='".base_url()."include/logo.png' width='50' height='35'/>
   				</th>
   				<th align='center'  >
					<font style='font-size: 12px;font-family: Calibri;line-height:90%;letter-spacing: 2px;'><b>SURAT ELEGIBILITAS PESERTA</b></font><br>
					<font style='font-size: 8px;font-family: Calibri;line-height:90%;letter-spacing: 2px;'>".strtoupper($rs->name)."</font><br>
   				</th>
				<th border='0' width='30%' align='center'>
   					<img src='".base_url()."include/BPJS.png' width='170' height='20'/>
   				</th>
   			</tr>
   		</table>
		<br/>";
		// $url= "http://api.bpjs-kesehatan.go.id:8080/VClaim-rest/SEP/"; //url cari sep

		/*URL BRIDIGING BPJS*/
		
		//$url= "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/SEP/"; //BPJS REAL
		$url= "https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/SEP/"; //url cari sep
		$opts = array(
		  'http'=>array(
			'method'=>'GET',
			'header'=>$this->getSignatureVedika()
		  )
		);
		$kelasRawat='';
		$no_telepon = "-";
		$context = stream_context_create($opts);
		// print_r(file_get_contents($url.$param1,false,$context));die();
		$res = json_decode(file_get_contents($url.$param1,false,$context),false);
		//echo json_encode($res);
		$no_kartu_peserta=$res->response->peserta->noKartu;
		$catatan=$res->response->catatan;
		$pasien=$this->db->query("select * from rs_visit where nomor_peserta='$no_kartu_peserta'")->result();
		foreach ($pasien as  $value) {
			$faskes_asal_peserta=$value->faskes_asal;
		}
		$no_telepon='';
		$faskes_asal='';
		if($res->metaData->code=='200'){
			if($res->response->peserta->kelamin == 'P'){
				$jk='WANITA';
			} else{
				$jk='PRIA';
			} 
			$kelasRawat=$res->response->peserta->hakKelas;
			$nama=$res->response->peserta->nama;
			$peserta=$res->response->peserta->jnsPeserta;
			$tglsep=date("d/m/Y", strtotime($res->response->tglSep));
			$tgl_lahir=date("d/m/Y", strtotime($res->response->peserta->tglLahir));
			//ob_start();
			$html.='<table background="white" cellspacing="0" border="0" style="font-color:#000000;font-size: 9px;font-family:  Calibri; margin: 0px 10px;line-height:90%;letter-spacing: 1px;font-stretch: condensed;">

					<tr style="height: 5px;">
						<td width="100">No. SEP</td>
						<td width="6">:</td>
						<td width="200" style="font-size:12px;"><b>'.$no_sep.'</b></td>
						<td width="10">&nbsp;</td>
						<td width="100">No. Mr</td>
						<td width="8">:</td>
						<td width="100">'.$res->response->peserta->noMr.'</td>
					</tr>
					
					<tr>
						<td height="5" ></td>
					</tr>

					<tr>
						<td width="100">Tgl. SEP</td>
						<td width="6">:</td>
						<td>'.$tglsep.'</td>
						<td width="26"></td>
						<td></td>
						<td width="8"></td>
						<td></td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>

					<tr>
						<td width="100">No. Kartu</td>
						<td width="6">:</td>
						<td style="font-size:12px;"><b>'.$res->response->peserta->noKartu.'</b></td>
						<td width="26">&nbsp;</td>
						<td>Peserta</td>
						<td width="8">:</td>
						<td rowspan="2" valign="top">'.$peserta.'</td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Nama Peserta</td>
						<td width="6">:</td>
						<td>'.strtoupper($nama).'</td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Tgl. Lahir</td>
						<td width="6">:</td>
						<td>'.$tgl_lahir.'</td> 
						<td width="26"></td>
						<td>COB</td>
						<td width="8">:</td>
						<td></td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Jns Kelamin</td>
						<td width="6">:</td>
						<td>'.$jk.'</td>
						<td width="26">&nbsp;</td>
						<td>Jns. Rawat</td>
						<td width="8">:</td>
						<td>'.$res->response->jnsPelayanan.'</td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Poli Tujuan</td>
						<td width="6">:</td>
						<td>'.$res->response->poli.'</td>
						<td width="26">&nbsp;</td>
						<td>Kls. Rawat</td>
						<td width="8">:</td>
						<td>'.$kelasRawat.'</td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Asal Faskes Tk. 1</td>
						<td width="6">:</td>
						<td>'.$faskes_asal_peserta.'</td>
						<td width="26">&nbsp;</td>
						<td>Operator</td>
						<td width="8">:</td>
						<td>operator</td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Diagnosa Awal</td>
						<td width="6">:</td>
						<td>'.$res->response->diagnosa.'</td>
						<td width="26">&nbsp;</td>
						<td></td>
						<td width="8"></td>
						<td></td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>

					<tr>
						<td width="100">Catatan</td>
						<td width="6">:</td>
						<td>'.$catatan.'</td>
						<td width="26">&nbsp;</td>
						<td align="center">Pasien / Keluarga</td>
						<td width="8"></td>
						<td align="center"></td>	
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>

					<tr>
						<td width="100"></td>
						<td width="6"></td>
						<td></td>
						<td width="26">&nbsp;</td>
						<td align="center">Pasien</td>
						<td width="8"></td>
						<td align="center"></td>
					</tr>

					
					<tr>
						<td height="15" ></td>
					</tr>


					 <tr>
						<td colspan="3";><font style="font-weight:bold;font-size: 7px;font-family: Arial;"><i>*Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan</i></font> </td>
					</tr>

					</table>
					</body>
					</html>'; 
			pdf(array('html'=>$html,'margin-top'=>15,'margin-left'=>15,'margin-right'=>15,'paper'=>array(0, 0, 665, 320),'page-number'=>false,array("Attachment" => false)));
		}
		
	}		

	
	public function preview_cetaksepbpjs(){
		$no_sep = $this->uri->segment(4);
		
		$this->load->library('fpdf/FPDF');
		$db=$this->load->database('SIM',true);
		$uri = $_SERVER["REQUEST_URI"];
		$uriArray = explode('/', $uri);
		$param1 = $no_sep;
		$catatantambahan = str_replace('~~_~~','/',$uriArray[(count($uriArray)-1)]);
		$catatantambahanasli = str_replace('%20',' ',$catatantambahan);
	 	$html='';
		$style='<style>
	 			.normal{
					width: 100%;
					font-family: Times New Roman, Helvetica, sans-serif;
   					border-collapse: none;
				} 
				
					
				.bottom{
					border-bottom: none;
	 				font-size: 12px;
				}
	 			
				div{
	 				text-align: justify;
					border:1px none;
    				text-justify: inter-word;
	 			}
				@media print{
					.no-print, .no-print *{
						display: none !important;
					}
				}
           </style>';
		$kd_rs='3577015';
		//echo $kd_rs;
		$rs=$db->query("SELECT * FROM db_rs WHERE code='".$kd_rs."'")->row();
		//<script>
			//	window.print();
		//	</script>
		$html.="
		<html>
		<head>
			".$style."
		</head>
		<body style='padding-top:100px;'>
		<table style='margin: 50px 50px 0px 50px;' cellspacing='0' border='0'>
   			<tr align=justify>
   				<th border='0';  width='10%' align='center'>
   					<img src='".base_url()."include/logo.png' width='50' height='35'/>
   				</th>
   				<th align='center'  >
					<font style='font-size: 12px;font-family: Calibri;line-height:90%;letter-spacing: 2px;'><b>SURAT ELEGIBILITAS PESERTA</b></font><br>
					<font style='font-size: 8px;font-family: Calibri;line-height:90%;letter-spacing: 2px;'>".strtoupper($rs->name)."</font><br>
   				</th>
				<th border='0' width='30%' align='center'>
   					<img src='".base_url()."include/BPJS.png' width='170' height='20'/>
   				</th>
   			</tr>
   		</table>
		<br/>";
		// $url= "http://api.bpjs-kesehatan.go.id:8080/VClaim-rest/SEP/"; //url cari sep

		/*URL BRIDIGING BPJS*/
		
		//$url= "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/SEP/"; //BPJS REAL
		$url= "https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/SEP/"; //url cari sep
		$opts = array(
		  'http'=>array(
			'method'=>'GET',
			'header'=>$this->getSignatureVedika()
		  )
		);
		$kelasRawat='';
		$no_telepon = "-";
		$context = stream_context_create($opts);
		// print_r(file_get_contents($url.$param1,false,$context));die();
		$res = json_decode(file_get_contents($url.$param1,false,$context),false);
		//echo json_encode($res);
		$no_kartu_peserta=$res->response->peserta->noKartu;
		$catatan=$res->response->catatan;
		$pasien=$this->db->query("select * from rs_visit where nomor_peserta='$no_kartu_peserta'")->result();
		foreach ($pasien as  $value) {
			$faskes_asal_peserta=$value->faskes_asal;
		}
		$no_telepon='';
		$faskes_asal='';
		if($res->metaData->code=='200'){
			if($res->response->peserta->kelamin == 'P'){
				$jk='WANITA';
			} else{
				$jk='PRIA';
			} 
			$kelasRawat=$res->response->peserta->hakKelas;
			$nama=$res->response->peserta->nama;
			$peserta=$res->response->peserta->jnsPeserta;
			$tglsep=date("d/m/Y", strtotime($res->response->tglSep));
			$tgl_lahir=date("d/m/Y", strtotime($res->response->peserta->tglLahir));
			//ob_start();
			$html.='<table background="white" cellspacing="0" border="0" style="font-color:#000000;font-size: 9px;font-family:  Calibri; margin: 0px 10px;line-height:90%;letter-spacing: 1px;font-stretch: condensed;">

					<tr style="height: 5px;">
						<td width="100">No. SEP</td>
						<td width="6">:</td>
						<td width="200" style="font-size:12px;"><b>'.$no_sep.'</b></td>
						<td width="10">&nbsp;</td>
						<td width="100">No. Mr</td>
						<td width="8">:</td>
						<td width="100">'.$res->response->peserta->noMr.'</td>
					</tr>
					
					<tr>
						<td height="5" ></td>
					</tr>

					<tr>
						<td width="100">Tgl. SEP</td>
						<td width="6">:</td>
						<td>'.$tglsep.'</td>
						<td width="26"></td>
						<td></td>
						<td width="8"></td>
						<td></td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>

					<tr>
						<td width="100">No. Kartu</td>
						<td width="6">:</td>
						<td style="font-size:12px;"><b>'.$res->response->peserta->noKartu.'</b></td>
						<td width="26">&nbsp;</td>
						<td>Peserta</td>
						<td width="8">:</td>
						<td rowspan="2" valign="top">'.$peserta.'</td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Nama Peserta</td>
						<td width="6">:</td>
						<td>'.strtoupper($nama).'</td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Tgl. Lahir</td>
						<td width="6">:</td>
						<td>'.$tgl_lahir.'</td> 
						<td width="26"></td>
						<td>COB</td>
						<td width="8">:</td>
						<td></td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Jns Kelamin</td>
						<td width="6">:</td>
						<td>'.$jk.'</td>
						<td width="26">&nbsp;</td>
						<td>Jns. Rawat</td>
						<td width="8">:</td>
						<td>'.$res->response->jnsPelayanan.'</td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Poli Tujuan</td>
						<td width="6">:</td>
						<td>'.$res->response->poli.'</td>
						<td width="26">&nbsp;</td>
						<td>Kls. Rawat</td>
						<td width="8">:</td>
						<td>'.$kelasRawat.'</td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Asal Faskes Tk. 1</td>
						<td width="6">:</td>
						<td>'.$faskes_asal_peserta.'</td>
						<td width="26">&nbsp;</td>
						<td>Operator</td>
						<td width="8">:</td>
						<td>operator</td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Diagnosa Awal</td>
						<td width="6">:</td>
						<td>'.$res->response->diagnosa.'</td>
						<td width="26">&nbsp;</td>
						<td></td>
						<td width="8"></td>
						<td></td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>

					<tr>
						<td width="100">Catatan</td>
						<td width="6">:</td>
						<td>'.$catatan.'</td>
						<td width="26">&nbsp;</td>
						<td align="center">Pasien / Keluarga</td>
						<td width="8"></td>
						<td align="center"></td>	
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>

					<tr>
						<td width="100"></td>
						<td width="6"></td>
						<td></td>
						<td width="26">&nbsp;</td>
						<td align="center">Pasien</td>
						<td width="8"></td>
						<td align="center"></td>
					</tr>

					
					<tr>
						<td height="15" ></td>
					</tr>


					 <tr>
						<td colspan="3";><font style="font-weight:bold;font-size: 7px;font-family: Arial;"><i>*Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan</i></font> </td>
					</tr>

					</table>
					</body>
					</html>'; 
			pdf(array('html'=>$html,'margin-top'=>15,'margin-left'=>15,'margin-right'=>15,'paper'=>array(0, 0, 665, 320),'page-number'=>false,array("Attachment" => false)));
		}
		 
	}
	// public function cetak_antrian(){
	public function print_cetak_sep($no_sep){
		$this->load->library('Pilihkertas');
		$setpage 	= new Pilihkertas;
		// $this->load->library('fpdf/FPDF');

		/*URL BRIDIGING BPJS*/ 

		//$url= "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/SEP/"; //BPJS REAL
		//$url2= "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Rujukan/Peserta/";

		$url= "https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/SEP/";
		$url2= "https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/Rujukan/Peserta/";
		
		$opts = array(
		  'http'=>array(
			'method'=>'GET',
			'header'=>$this->getSignatureVedika()
		  )
		);
		$context = stream_context_create($opts);
		$res  = json_decode(file_get_contents($url.$no_sep,false,$context),false);
		$noka = $res->response->peserta->noKartu;
		$res2 = json_decode(file_get_contents($url2.'/'.$noka,false,$context),false);
		$faskes_lvl_1='';
		if($res2->response !==null){
			$faskes_lvl_1=$res2->response->rujukan->provPerujuk->nama;
		}
		
		$nama =$res->response->peserta->nama;
		$peserta=$res->response->peserta->jnsPeserta;
		$tglsep=$res->response->tglSep;
		if($res->response->peserta->kelamin == 'P'){
			$jk='WANITA';
		} else{
			$jk='PRIA';
		} 
		$kelasRawat='';
		if($res->response->jnsPelayanan=='Rawat Inap'){
			$kelasRawat = $res->response->peserta->hakKelas;
		}
		//$printer = '//192.168.0.173/EPSON_LX-310';
		$printer = '//192.168.1.251/EPSON_LX_300II';
		$tmpdir = sys_get_temp_dir();   # ambil direktori temporary untuk simpan file.
		//$file =  tempnam($tmpdir, 'ctk');  # nama file temporary yang akan dicetak
		$file =  'C:\xampp\htdocs\rssm_online\sep_temp.txt';
		
		// $header =  'http://192.168.1.25/medismart_/ui/images/Logo/header-sep.prn';
		//$header =  base_url().'include/header-sep.prn';
		$header =  'C:\xampp\htdocs\rssm_online\include\header-sep.prn';
		$handle = fopen($file, 'w');
		$condensed = Chr(27) . Chr(33) . Chr(4);
		$feed        = chr(27) . chr(67) . chr(20); # menentuka panjang halaman setelah cetak selesai chr(27) . chr(67) . chr(xx)
		$reversefeed = chr(27).chr(106).chr(4320); # load halaman keatas sebelum printing dimulai chr(27).chr(106).chr(xx) / xx/216 => 216/216= 1 baris
		$formfeed    = chr(12); # mengeksekusi $feed
		$bold1 = Chr(27) . Chr(69);
		$bold0 = Chr(27) . Chr(70);
		$initialized = chr(27).chr(64);
		$condensed2 = Chr(27).Chr(33).Chr(30);
		$condensed1 = chr(15);
		$condensed0 = chr(18);
		$margin      = chr(27) . chr(78). chr(90);
		$margin_off  = chr(27) . chr(79);

		$Data  = $initialized;
		$Data .= $setpage->PageLength('laporan/3'); # PEMANGGILAN UKURAN KERTAS (UKURAN KERTAS BIASA DIBAGI 3)
		// $Data .= $margin;
		$Data .= $condensed1;
		// $Data .= $formfeed;
		$Data .= "No. Sep             : ".str_pad($condensed2.$bold1.$no_sep.$bold0.$condensed,65," ")."\n";
		$Data .= "Tgl. Sep            : ".str_pad($bold1.$tglsep.$bold0,69," ")."No. Mr         : ".$res->response->peserta->noMr."\n";
		$Data .= "No. Kartu           : ".str_pad($condensed2.$bold1.$res->response->peserta->noKartu.$bold0.$condensed,67," ")."Peserta        : ".$peserta."\n";
		$Data .= "Nama Peserta        : ".str_pad($nama,65," ")."\n";
		$Data .= "Tgl. Lahir          : ".str_pad($res->response->peserta->tglLahir,65," ")."COB            : -\n";
		$Data .= "Jns. Kelamin        : ".str_pad($jk,65," ")."Jns. Rawat     : ".$res->response->jnsPelayanan."\n";
		// $Data .= "Poli Tujuan         : ".str_pad($res->response->poliTujuan->nmPoli,65," ")."Kls. Rawat     : ".$kelasRawat."\n";
		$Data .= "Poli Tujuan         : ".str_pad($res->response->poli,65," ")."Kls. Rawat     : ".$kelasRawat."\n";
		// $Data .= "Asal Faskes TK 1    : ".str_pad($res->response->peserta->provUmum->nmProvider,65," ")."Operator       : ".$operator."\n";
		$Data .= "Asal Faskes TK 1    : ".str_pad($faskes_lvl_1,65," ")."Operator       : operator\n";
		$Data .= "Diagnosa Awal       : ".str_pad($res->response->diagnosa,65," ")."\n";
		// $Data .= "Catatan             : ".str_pad($res->response->catatan ,65," ")."Pasien / Keluarga      Petugas BPJS \n";
		$Data .= "Catatan             : ".str_pad($res->response->catatan ,65," ")."                     Pasien / Keluarga pasien\n";
		// $Data .= "                                                                                             Pasien            Kesehatan\n";
		$Data .= "*Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan\n";
		$Data .= "*SEP bukan sebagai bukti penjamin peserta\n";
		$Data .= "Cetakan Ke 1 : ".str_pad(gmdate("d-M-Y H:i:s", time()+60*61*7),71," ")."                     .................\n";
		$Data .= " \n";
		$Data .= " \n";
		$Data .= " \n";
		fwrite($handle, $Data);
		fclose($handle);
		//$cmd = 'lpr -P //localhost/epson-lx-310-me '.$file;
		//shell_exec("lpr -P ".$printer." -r ".$header);
		//
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		
			// echo $file;die();
			// copy($file, $printer);  # Lakukan cetak //DONAT
			// unlink($file);
			# printer windows -> nama "printer" di komputer yang sharing printer
			copy($header, $printer);  # Lakukan cetak
			copy($file, $printer);  # Lakukan cetak
		} else{
			shell_exec("lpr -P ".$printer." /var/www/html/medismart/ui/images/Logo/header-sep.prn");
			shell_exec("lpr -P ".$printer." ".$file); # Lakukan cetak linux
		} 
		  
	}	
	
	public function cetak_ulang_sep(){
		$no_sep=$this->get('noSEP');
		$this->load->library('Pilihkertas');
		$setpage 	= new Pilihkertas;
		// $this->load->library('fpdf/FPDF');

		/*URL BRIDIGING BPJS*/
		//$url= "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/SEP/"; //BPJS REAL
		//$url2= "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Rujukan/Peserta/";

		$url= "https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/SEP/";
		$url2= "https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/Rujukan/Peserta/";
		
		$opts = array(
		  'http'=>array(
			'method'=>'GET',
			'header'=>$this->getSignatureVedika()
		  )
		);
		$context = stream_context_create($opts);
		$res  = json_decode(file_get_contents($url.$no_sep,false,$context),false);
		$noka = $res->response->peserta->noKartu;
		$res2 = json_decode(file_get_contents($url2.'/'.$noka,false,$context),false);
		$faskes_lvl_1='';
		if($res2->response !==null){
			$faskes_lvl_1=$res2->response->rujukan->provPerujuk->nama;
		}
		
		$nama =$res->response->peserta->nama;
		$peserta=$res->response->peserta->jnsPeserta;
		$tglsep=$res->response->tglSep;
		if($res->response->peserta->kelamin == 'P'){
			$jk='WANITA';
		} else{
			$jk='PRIA';
		} 
		$kelasRawat='';
		if($res->response->jnsPelayanan=='Rawat Inap'){
			$kelasRawat = $res->response->peserta->hakKelas;
		}
	//	$printer = '//192.168.0.173/EPSON_LX-310';
		$printer = '//192.168.1.251/EPSON_LX_300II';
		$tmpdir = sys_get_temp_dir();   # ambil direktori temporary untuk simpan file.
		//$file =  tempnam($tmpdir, 'ctk');  # nama file temporary yang akan dicetak
		$file =  'C:\xampp\htdocs\rssm_online\sep_temp.txt';
		
		// $header =  'http://192.168.1.25/medismart_/ui/images/Logo/header-sep.prn';
		//$header =  base_url().'include/header-sep.prn';
		$header =  'C:\xampp\htdocs\rssm_online\include\header-sep.prn';
		$handle = fopen($file, 'w');
		$condensed = Chr(27) . Chr(33) . Chr(4);
		$feed        = chr(27) . chr(67) . chr(20); # menentuka panjang halaman setelah cetak selesai chr(27) . chr(67) . chr(xx)
		$reversefeed = chr(27).chr(106).chr(4320); # load halaman keatas sebelum printing dimulai chr(27).chr(106).chr(xx) / xx/216 => 216/216= 1 baris
		$formfeed    = chr(12); # mengeksekusi $feed
		$bold1 = Chr(27) . Chr(69);
		$bold0 = Chr(27) . Chr(70);
		$initialized = chr(27).chr(64);
		$condensed2 = Chr(27).Chr(33).Chr(30);
		$condensed1 = chr(15);
		$condensed0 = chr(18);
		$margin      = chr(27) . chr(78). chr(90);
		$margin_off  = chr(27) . chr(79);

		$Data  = $initialized;
		$Data .= $setpage->PageLength('laporan/3'); # PEMANGGILAN UKURAN KERTAS (UKURAN KERTAS BIASA DIBAGI 3)
		// $Data .= $margin;
		$Data .= $condensed1;
		// $Data .= $formfeed;
		$Data .= "No. Sep             : ".str_pad($condensed2.$bold1.$no_sep.$bold0.$condensed,65," ")."\n";
		$Data .= "Tgl. Sep            : ".str_pad($bold1.$tglsep.$bold0,69," ")."No. Mr         : ".$res->response->peserta->noMr."\n";
		$Data .= "No. Kartu           : ".str_pad($condensed2.$bold1.$res->response->peserta->noKartu.$bold0.$condensed,67," ")."Peserta        : ".$peserta."\n";
		$Data .= "Nama Peserta        : ".str_pad($nama,65," ")."\n";
		$Data .= "Tgl. Lahir          : ".str_pad($res->response->peserta->tglLahir,65," ")."COB            : -\n";
		$Data .= "Jns. Kelamin        : ".str_pad($jk,65," ")."Jns. Rawat     : ".$res->response->jnsPelayanan."\n";
		// $Data .= "Poli Tujuan         : ".str_pad($res->response->poliTujuan->nmPoli,65," ")."Kls. Rawat     : ".$kelasRawat."\n";
		$Data .= "Poli Tujuan         : ".str_pad($res->response->poli,65," ")."Kls. Rawat     : ".$kelasRawat."\n";
		// $Data .= "Asal Faskes TK 1    : ".str_pad($res->response->peserta->provUmum->nmProvider,65," ")."Operator       : ".$operator."\n";
		$Data .= "Asal Faskes TK 1    : ".str_pad($faskes_lvl_1,65," ")."Operator       : operator\n";
		$Data .= "Diagnosa Awal       : ".str_pad($res->response->diagnosa,65," ")."\n";
		// $Data .= "Catatan             : ".str_pad($res->response->catatan ,65," ")."Pasien / Keluarga      Petugas BPJS \n";
		$Data .= "Catatan             : ".str_pad($res->response->catatan ,65," ")."                     Pasien / Keluarga pasien\n";
		// $Data .= "                                                                                             Pasien            Kesehatan\n";
		$Data .= "*Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan\n";
		$Data .= "*SEP bukan sebagai bukti penjamin peserta\n";
		$Data .= "Cetakan Ke 1 : ".str_pad(gmdate("d-M-Y H:i:s", time()+60*61*7),71," ")."                     .................\n";
		$Data .= " \n";
		$Data .= " \n";
		$Data .= " \n";
		fwrite($handle, $Data);
		fclose($handle);
		//$cmd = 'lpr -P //localhost/epson-lx-310-me '.$file;
		//shell_exec("lpr -P ".$printer." -r ".$header);
		//
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		
			// echo $file;die();
			// copy($file, $printer);  # Lakukan cetak //DONAT
			// unlink($file);
			# printer windows -> nama "printer" di komputer yang sharing printer
			copy($header, $printer);  # Lakukan cetak
			copy($file, $printer);  # Lakukan cetak
			echo json_encode(array('response'=>'true'));
		} else{
			shell_exec("lpr -P ".$printer." /var/www/html/medismart/ui/images/Logo/header-sep.prn");
			shell_exec("lpr -P ".$printer." ".$file); # Lakukan cetak linux
		} 
		  
	}
	public function getNoMedrec(){
		$db=$this->load->database('other',true);
		$no_medrec    = "";
		$strNomor     = "";
		$getnewmedrec = "";
		$result = $db->query("SELECT replace(kd_pasien, '-', '') as kd_pasien FROM pasien WHERE kd_pasien like '%-%' ORDER BY kd_pasien DESC LIMIT 1");
		if ($result->num_rows() > 0 ) {
			$no_medrec = $result->row()->kd_pasien; 
			$nomor     = (int) $no_medrec + 1;
			if ($nomor < 999999) {
				$retVal = str_pad($nomor, 8, "0", STR_PAD_LEFT);
			} else {
				$retVal = str_pad($nomor, 7, "0", STR_PAD_LEFT);
			}
			$getnewmedrec = substr($retVal, 0, 1) . '-' . substr($retVal, 1, 2) . '-' . substr($retVal, 3, 2) . '-' . substr($retVal, -2);
		}else {
			$strNomor     = "0-00-" . str_pad("00-", 2, '0', STR_PAD_LEFT);
			$getnewmedrec = $strNomor . "01";
		}
		//$this->dbSQL->close();
        return $getnewmedrec;
	}
	
	public function save_bpjs_pasien_lama($noRegistrasi,$baru,$medrec_lama,$unit,$customer,$ori){
	
		
		$db=$this->load->database('other',true);
		$sqlbagianshift = $db->query("SELECT   shift FROM BAGIAN_SHIFT  where KD_BAGIAN='2'")->row()->shift;
		$lastdate = $db->query("SELECT   to_char(lastdate,'YYYY-mm-dd') as lastdate FROM BAGIAN_SHIFT  where KD_BAGIAN='2'")->row()->lastdate;
		$datnow = date('Y-m-d');
		if ($lastdate <> $datnow && $sqlbagianshift === '3') {
			$Shiftbagian = '4';
		} else {
			$Shiftbagian = $sqlbagianshift;
		}
		$Shiftbagian = (int) $Shiftbagian;
		//--- URUT KUNJUNGAN
		$retVal = 0;
		$res =$db->query("select urut_masuk from kunjungan where 
			kd_pasien = '" . $medrec_lama . "' and kd_unit = '" . $unit . "' and 
			tgl_masuk = '" . date('Y-m-d') . "' order by urut_masuk desc limit 1");
		if (count($res->result()) > 0) {
			$nm = $res->row()->urut_masuk;
			$nomor = (int) $nm + 1;
			$retVal = $nomor;
		}
		$urutMasuk=$retVal;
		//--CARI ASAL PASIEN
		$JamKunjungan = "1900-01-01".gmdate(" H:i:s", time()+60*60*7);
		$cari_kd_unit=$db->query("select setting from sys_setting where key_data='rwj_default_kd_unit'")->row()->setting;
		$asal_pasien=$db->query("select kd_asal from asal_pasien where kd_unit='$cari_kd_unit'")->row()->kd_asal;
		//echo $medrec;
		$keluhan=$ori->getKeluhan();
		$now= date('Y-m-d');
		
		
		$cetak_sep=$this->generateSEP($noRegistrasi,$baru,$medrec_lama);
		
		if($cetak_sep[0] == 'true'){
			$no_sjp = $cetak_sep[1];
			$no_dpjp = $cetak_sep[2];
			$sql="INSERT INTO kunjungan (kd_pasien,kd_unit,tgl_masuk,urut_masuk,jam_masuk,cara_penerimaan,asal_pasien,kd_rujukan,	no_sjp,kd_dokter,baru,kd_customer,shift,karyawan,kontrol,antrian,online,anamnese)
					VALUES('$medrec_lama','$unit','$now','$retVal','$JamKunjungan',99,'$asal_pasien',0,'$no_sjp','000','$baru',
						'$customer','$Shiftbagian','0','false',0,TRUE,'$keluhan')";
			$db->query($sql);
			
			//insert sjp kunjungan 2018-11-29
			$insert_sjp_kunjungan="INSERT INTO sjp_kunjungan 
					(kd_pasien,kd_unit,tgl_masuk,urut_masuk,no_sjp,no_dpjp)
				VALUES ('$medrec_lama','$unit','$now','$retVal','$no_sjp','$no_dpjp')";
			$db->query($insert_sjp_kunjungan);
			$this->insert_transaksi_cetak_no_antrian($medrec_lama,$unit,$urutMasuk,$customer,$Shiftbagian,$noRegistrasi,$ori);
		}
		
			
		// return $cetak_sep[0]; 
		return array($cetak_sep[0],$cetak_sep[1]);
		


	}

	public function save_bpjs_pasien_baru($noRegistrasi,$baru,$unit,$customer,$ori,$medrec_lama){
			$db=$this->load->database('other',true);
			$medrec=$this->getNoMedrec();
			//echo "JIKA PASIEN BPJS DAN PASIEN BARU";
			//$cetak_sep='1308R0010818V000519';
			
			$sqlbagianshift = $db->query("SELECT   shift FROM BAGIAN_SHIFT  where KD_BAGIAN='2'")->row()->shift;
			$lastdate = $db->query("SELECT   to_char(lastdate,'YYYY-mm-dd') as lastdate FROM BAGIAN_SHIFT  where KD_BAGIAN='2'")->row()->lastdate;
			$datnow = date('Y-m-d');
			if ($lastdate <> $datnow && $sqlbagianshift === '3') {
				$Shiftbagian = '4';
			} else {
				$Shiftbagian = $sqlbagianshift;
			}
			$Shiftbagian = (int) $Shiftbagian;
			//--- URUT KUNJUNGAN
			$retVal = 0;
			$res =$db->query("select urut_masuk from kunjungan where 
					kd_pasien = '" . $medrec . "' and kd_unit = '" . $unit . "' and 
					tgl_masuk = '" . date('Y-m-d') . "' order by urut_masuk desc limit 1");
			if (count($res->result()) > 0) {
				$nm = $res->row()->urut_masuk;
				$nomor = (int) $nm + 1;
				$retVal = $nomor;
			}
			$urutMasuk=$retVal;
			//--CARI ASAL PASIEN
			$JamKunjungan = "1900-01-01".gmdate(" H:i:s", time()+60*60*7);
			$cari_kd_unit=$db->query("select setting from sys_setting where key_data='rwj_default_kd_unit'")->row()->setting;
			$asal_pasien=$db->query("select kd_asal from asal_pasien where kd_unit='$cari_kd_unit'")->row()->kd_asal;
		//	echo $medrec;
			$now =date('Y-m-d');
			$keluhan=$ori->getKeluhan() ;
			$kd_pasien=$ori->getKeluhan() ;
			$keluhan=$ori->getKeluhan() ;
			//$get_pasien=$this->db->query("select patient_code,name,birth_date from rs_patient where patient_code='$medrec_lama'")->result();

			/***/
			$get_pasien=$this->db->query("
				select 
					patient_id,
					patient_code,
					name,
					birth_date,
					no_ktp,
					birth_place,
					gender,
					religion,
					blod,
					education,
					address,
					kelurahan_id,
					postal_code,
					phone_number
				from rs_patient where patient_code='$medrec_lama'
				")->result();
			foreach ($get_pasien as $key) {
				$patient_id 		= $key->patient_id;
				$kd_pasien			= $medrec;
				$nama_pasien		= $key->name;
				$tgl_lahir_pasien	= $key->birth_date;
				$no_ktp				= $key->no_ktp;
				$birth_place		= $key->birth_place;
				$gender				= $key->gender;
				$religion			= $key->religion;
				$blod				= $key->blod;
				$education			= $key->education;
				$address			= $key->address;
				$kelurahan_id		= $key->kelurahan_id;
				$postal_code		= $key->postal_code;
				$phone_number		= $key->phone_number;
			}
			
			$insert_pasien_baru="INSERT INTO pasien 
			(
				kd_pasien,nama,tgl_lahir,no_pengenal,tempat_lahir,jenis_kelamin,kd_agama,gol_darah,
				kd_pendidikan,alamat,kd_pos,telepon,kd_kelurahan
			)
			VALUES(
				 '".$medrec."',
				 '".$nama_pasien."',
				 '".$tgl_lahir_pasien."',
				 '".$no_ktp."',
				 '".$birth_place."',
				 '".$gender."',
				 '".$religion."',
				 '".$blod."',
				 '".$education."',
				 '".$address."',
				 '".$postal_code."',
				 '".$phone_number."',
				 '".$kelurahan_id."'
				)";
			$insert_pasien_hasil = $db->query($insert_pasien_baru);

			/**/

			
			/*UPDATE PATIENT_CODE DI TABEL RS_PATIENT */
			$update_rs_patient=$this->db->query("
				UPDATE rs_patient set patient_code='".$kd_pasien."' 
				WHERE patient_id='$patient_id'
			");
			// $cetak_sep=$this->generateSEP($noRegistrasi,$baru,$medrec); //editing
			
			$cetak_sep=$this->generateSEP($noRegistrasi,$baru,$medrec); //editing
			
			if($cetak_sep[0] == 'true'){
				$no_sjp = $cetak_sep[1];
				$no_dpjp = $cetak_sep[2];
				
				$sql="INSERT INTO kunjungan (kd_pasien,kd_unit,tgl_masuk,urut_masuk,jam_masuk,cara_penerimaan,asal_pasien,kd_rujukan,no_sjp,kd_dokter,baru,kd_customer,shift,karyawan,kontrol,antrian,online,anamnese)
				VALUES('$medrec','$unit','$now','$retVal','$JamKunjungan',99,'$asal_pasien',0,'$no_sjp','000','$baru','$customer',
					   '$Shiftbagian',0,'false',0,t,'$keluhan' )";
				$db->query($sql);
				
				
				//insert sjp kunjungan 2018-11-29
				$insert_sjp_kunjungan="INSERT INTO sjp_kunjungan 
						(kd_pasien,kd_unit,tgl_masuk,urut_masuk,no_sjp,no_dpjp)
					VALUES ('$medrec','$unit','$now','$retVal','$no_sjp','$no_dpjp')";
				$db->query($insert_sjp_kunjungan);
				
				$this->insert_transaksi_cetak_no_antrian($medrec,$unit,$urutMasuk,$customer,$Shiftbagian,$noRegistrasi,$ori);
				
			}
			
			return array($cetak_sep[0],$cetak_sep[1]);
	}

	public function save_pasien_baru_umum($noRegistrasi,$baru,$unit,$customer,$ori,$medrec_lama){
			$now=	 date('Y-m-d');
			$db=$this->load->database('other',true);
			//echo "JIKA PASIEN BUKAN BPJS DAN  PASIEN BARU";
			//JIKA PASIEN BUKAN BPJS DAN  PASIEN BARU//
			$medrec=$this->getNoMedrec();
			$sqlbagianshift = $db->query("SELECT   shift FROM BAGIAN_SHIFT  where KD_BAGIAN='2'")->row()->shift;
			$lastdate = $db->query("SELECT   to_char(lastdate,'YYYY-mm-dd') as lastdate FROM BAGIAN_SHIFT  where KD_BAGIAN='2'")->row()->lastdate;
			$datnow = date('Y-m-d');
			if ($lastdate <> $datnow && $sqlbagianshift === '3') {
				$Shiftbagian = '4';
			} else {
				$Shiftbagian = $sqlbagianshift;
			}
			$Shiftbagian = (int) $Shiftbagian;
			//--- URUT KUNJUNGAN
			$retVal = 0;
			$res =$db->query("select urut_masuk from kunjungan where 
					kd_pasien = '" . $medrec . "' and kd_unit = '" . $unit . "' and 
					tgl_masuk = '" . date('Y-m-d') . "' order by urut_masuk desc limit 1");
			if (count($res->result()) > 0) {
				$nm = $res->row()->urut_masuk;
				$nomor = (int) $nm + 1;
				$retVal = $nomor;
			}
			$urutMasuk=$retVal;
				//--CARI ASAL PASIEN
			$keluhan=$ori->getKeluhan();
			$JamKunjungan = "1900-01-01".gmdate(" H:i:s", time()+60*60*7);
			$cari_kd_unit=$db->query("select setting from sys_setting where key_data='rwj_default_kd_unit'")->row()->setting;
			$asal_pasien=$db->query("select kd_asal from asal_pasien where kd_unit='$cari_kd_unit'")->row()->kd_asal;
			
			
			/***/
			$get_pasien=$this->db->query("
				select 
					patient_id,
					patient_code,
					name,
					birth_date,
					no_ktp,
					birth_place,
					gender,
					religion,
					blod,
					education,
					address,
					kelurahan_id,
					postal_code,
					phone_number
				from rs_patient where patient_code='$medrec_lama'
				")->result();
			foreach ($get_pasien as $key) {
				$patient_id 		= $key->patient_id;
				$kd_pasien			= $medrec;
				$nama_pasien		= $key->name;
				$tgl_lahir_pasien	= $key->birth_date;
				$no_ktp				= $key->no_ktp;
				$birth_place		= $key->birth_place;
				$gender				= $key->gender;
				$religion			= $key->religion;
				$blod				= $key->blod;
				$education			= $key->education;
				$address			= $key->address;
				$kelurahan_id		= $key->kelurahan_id;
				$postal_code		= $key->postal_code;
				$phone_number		= $key->phone_number;
			}	
			$insert_pasien_baru="INSERT INTO pasien 
			(
				kd_pasien,nama,tgl_lahir,no_pengenal,tempat_lahir,jenis_kelamin,kd_agama,gol_darah,
				kd_pendidikan,alamat,kd_pos,telepon,kd_kelurahan
			)
			VALUES(
				 '".$medrec."',
				 '".$nama_pasien."',
				 '".$tgl_lahir_pasien."',
				 '".$no_ktp."',
				 '".$birth_place."',
				 '".$gender."',
				 '".$religion."',
				 '".$blod."',
				 '".$education."',
				 '".$address."',
				 '".$postal_code."',
				 '".$phone_number."',
				 '".$kelurahan_id."'
				)";
			$insert_pasien_hasil = $db->query($insert_pasien_baru);
			/***/
			/*UPDATE PATIENT_CODE DI TABEL RS_PATIENT */
			$update_rs_patient=$this->db->query("
				UPDATE rs_patient set patient_code='".$kd_pasien."' 
				WHERE patient_id='$patient_id'
			");
			
			/**********END UPDATE****************/
			
			$sql="INSERT INTO kunjungan (kd_pasien,kd_unit,tgl_masuk,urut_masuk,jam_masuk,cara_penerimaan,asal_pasien,kd_rujukan,no_sjp,kd_dokter,baru,kd_customer,shift,karyawan,kontrol,antrian,online,anamnese)
			VALUES('$medrec','$unit','$now','$retVal','$JamKunjungan',99,'$asal_pasien',0,0,'000','$baru','$customer',
				   '$Shiftbagian',0,'false',0,TRUE,'$keluhan' )";
			$kunjungan = $db->query($sql);
			$this->insert_transaksi_cetak_no_antrian($medrec,$unit,$urutMasuk,$customer,$Shiftbagian,$noRegistrasi,$ori);

			if($kunjungan > 0){
				return array('true');
			}else{
				return array('false');
			}
	}
	public function save_pasien_lama_umum($noRegistrasi,$baru,$medrec_lama,$unit,$customer,$ori){
			$db=$this->load->database('other',true);
			$sqlbagianshift = $db->query("SELECT   shift FROM BAGIAN_SHIFT  where KD_BAGIAN='2'")->row()->shift;
			$lastdate = $db->query("SELECT   to_char(lastdate,'YYYY-mm-dd') as lastdate FROM BAGIAN_SHIFT  where KD_BAGIAN='2'")->row()->lastdate;
			$datnow = date('Y-m-d');
			if ($lastdate <> $datnow && $sqlbagianshift === '3') {
				$Shiftbagian = '4';
			} else {
				$Shiftbagian = $sqlbagianshift;
			}
			$Shiftbagian = (int) $Shiftbagian;
			//--- URUT KUNJUNGAN
			$retVal = 0;
			$res =$db->query("select urut_masuk from kunjungan where 
				kd_pasien = '" . $medrec_lama . "' and kd_unit = '" . $unit . "' and 
				tgl_masuk = '" . date('Y-m-d') . "' order by urut_masuk desc limit 1");
			if (count($res->result()) > 0) {
				$nm = $res->row()->urut_masuk;
				$nomor = (int) $nm + 1;
				$retVal = $nomor;
			}
			$urutMasuk=$retVal;
			//--CARI ASAL PASIEN
			$JamKunjungan = "1900-01-01".gmdate(" H:i:s", time()+60*60*7);
			$cari_kd_unit=$db->query("select setting from sys_setting where key_data='rwj_default_kd_unit'")->row()->setting;
			$asal_pasien=$db->query("select kd_asal from asal_pasien where kd_unit='$cari_kd_unit'")->row()->kd_asal;
			//echo $medrec;
			$keluhan=$ori->getKeluhan();
			$now= date('Y-m-d');
			$sql="INSERT INTO kunjungan (kd_pasien,kd_unit,tgl_masuk,urut_masuk,jam_masuk,cara_penerimaan,asal_pasien,kd_rujukan,	no_sjp,kd_dokter,baru,kd_customer,shift,karyawan,kontrol,antrian,online,anamnese)
					VALUES('$medrec_lama','$unit','$now','$retVal','$JamKunjungan',99,'$asal_pasien',0,0,'000','$baru',
						'$customer','$Shiftbagian','0','false',0,TRUE,'$keluhan')";
			$kunjungan = $db->query($sql);
			$data_print_tracer=$this->insert_transaksi_cetak_no_antrian($medrec_lama,$unit,$urutMasuk,$customer,$Shiftbagian,$noRegistrasi,$ori);
			if($kunjungan > 0){
				return array($data_print_tracer);
			}else{
				return array('false');
			}
	}
	
	public function insert_transaksi_cetak_no_antrian($medrec,$unit,$urutMasuk,$customer,$Shiftbagian,$noRegistrasi,$ori){
			$db=$this->load->database('other',true);
			$_kduser = '0';
			$kd_kasir = $db->query("select setting from sys_setting where key_data = 'default_kd_kasir_rwj'")->row()->setting;
			$now=date('Y-m-d');
			$Schkasir = $db->query("select setting from sys_setting where key_data = 'default_kd_kasir_rwj'")->row()->setting;
			$loop=true;
			while($loop==true){
				
				$counter =$db->query("select counter from kasir where kd_kasir = '$kd_kasir'")->row();
				$no = $counter->counter;
				$retVal = $no + 1;
				$query = "update kasir set counter=$retVal where kd_kasir='$kd_kasir'";
				$update = $db->query($query);
				//-----------insert to sq1 server Database---------------//
				$db->query($query);
				
				
				//-----------akhir insert ke database sql server----------------//
				if (strlen($retVal) == 1) {
					$retValreal = "000000".$retVal;

				}else if (strlen($retVal) == 2){
					$retValreal = "00000".$retVal;
				}else if (strlen($retVal) == 3){
					$retValreal = "0000".$retVal;
				}else if (strlen($retVal) == 4){
					$retValreal = "000".$retVal;
				}else if (strlen($retVal) == 5){
					$retValreal = "00".$retVal;
				}else if (strlen($retVal) == 6){
					$retValreal = "0".$retVal;
				}else{
					$retValreal = $retVal;
				}
				$notrans=$retValreal;
				$criteria = "no_transaksi = '".$notrans."' and kd_kasir = '".$Schkasir."'";
				$queryPG = $db->query('select * from transaksi where '.$criteria)->result();
				if(count($queryPG)==0){
					$loop=false;
				}
			}
			$insert_transaksi="insert INTO transaksi
								(kd_kasir, no_transaksi, kd_pasien, kd_unit, tgl_transaksi, urut_masuk, tgl_co, co_status, 
								  ispay, app, kd_user, tag, lunas, tgl_lunas) 
								 VALUES ( '$kd_kasir', 
										 '$notrans', 
										 '$medrec',
										 '$unit', 
										 '$now',
										 $urutMasuk, 
										 NULL, 
										 'False',
								 
										 'False',
										 'False', 
										 '$_kduser',
										 NULL,
										 'False',
										 NULL)";
			$db->query($insert_transaksi);
			$kdtarifcus = $db->query("Select getkdtarifcus('" . $customer . "')")->result();
			foreach ($kdtarifcus as $getkdtarifcus) {
				$KdTarifpasien = $getkdtarifcus->getkdtarifcus;
			}
			$gettglberlaku = $db->query("Select gettanggalberlakufromklas('$KdTarifpasien','" . date('Y-m-d') . "','" . date('Y-m-d') . "','71')")->result();
			foreach ($gettglberlaku as $gettanggalberlakufromklas) {
				$Tglberlaku_pasien = $gettanggalberlakufromklas->gettanggalberlakufromklas;
			}
			if($Tglberlaku_pasien==""||$Tglberlaku_pasien==""){
				$Tglberlaku_pasien=date('Y-m-d');
			}
			$sqlAutoCas="INSERT INTO detail_transaksi
						(kd_kasir, no_transaksi, urut,tgl_transaksi, kd_user, kd_tarif,kd_produk,kd_unit,
						tgl_berlaku,charge,adjust,folio,qty,harga,shift,tag,no_faktur)
						select  
							'".$Schkasir."',
							'".$notrans."',
							row_number() OVER () as rnum,
							'" . date('Y-m-d') . "',
							" . $_kduser . ",
							rn.kd_tarif,
							rn.kd_produk,
							rn.kd_unit,
							rn.tglberlaku,
							'true',
							'true',
							'A'
							,1,
							rn.tarifx,
							" . $Shiftbagian . ",
							'false',
							''  
							from(
							Select AutoCharge.appto,
							tarif.kd_tarif,
							AutoCharge.kd_produk,
							AutoCharge.kd_unit,
							max (tarif.tgl_berlaku) as tglberlaku,
							tarif.tarif as tarifx,
							row_number() over(partition by AutoCharge.kd_produk order by tarif.tgl_berlaku desc) as rn
							From AutoCharge inner join tarif on 
							tarif.kd_produk=autoCharge.kd_Produk and tarif.kd_unit=autoCharge.kd_unit
							inner join produk on produk.kd_produk = tarif.kd_produk  
							Where 
							AutoCharge.kd_unit='" . $unit . "'
							and AutoCharge.appto in (2,0,4)
							and LOWER(kd_tarif)=LOWER('".$KdTarifpasien."')
							and tgl_berlaku <= '".$Tglberlaku_pasien."'
							group by  AutoCharge.kd_unit,AutoCharge.kd_produk,AutoCharge.shift,
							tarif.kd_tarif,tarif.tarif,AutoCharge.appto,tarif.tgl_berlaku 
							order by tglberlaku desc
							) as rn
							where rn = 1";
			$db->query($sqlAutoCas);
			$querySelectSetTrans = $db->query("
				select * from(
				Select row_number() OVER (ORDER BY AutoCharge.kd_produk )AS rnum,
				tarif.kd_tarif,
				AutoCharge.kd_produk,
				AutoCharge.kd_unit,
				max (tarif.tgl_berlaku) as tglberlaku,
				max(tarif.tarif) as tarifx
				From AutoCharge inner join tarif on 
				tarif.kd_produk=autoCharge.kd_Produk and tarif.kd_unit=autoCharge.kd_unit
				inner join produk on produk.kd_produk = tarif.kd_produk  
				Where AutoCharge.kd_unit='" . $unit . "'
				and AutoCharge.appto in (2,0,4)
				and LOWER(kd_tarif)=LOWER('".$KdTarifpasien."')
				and tgl_berlaku <= '".$Tglberlaku_pasien."'
				group by  AutoCharge.kd_unit,AutoCharge.kd_produk,AutoCharge.shift,
				tarif.kd_tarif order by AutoCharge.kd_produk asc) as  rn where rn.rnum=1");
			if ($querySelectSetTrans->num_rows() > 0){
				$kdjasadok  = $db->query("select setting from sys_setting where key_data = 'pel_jasa_dok'")->row()->setting;
				$kdjasaanas = $db->query("select setting from sys_setting where key_data = 'pel_JasaDokterAnestasi'")->row()->setting;
				foreach ($querySelectSetTrans->result() as $row){
					$kdprodukpasien = $row->kd_produk;
					$kdTarifpasien = $row->kd_tarif;
					$tglberlakupasien = $row->tglberlaku;
					$kd_unitpasein = $row->kd_unit;
					$urutpasein = $row->rnum;
					$query = $db->query("INSERT INTO Detail_Component 
						(Kd_Kasir, No_Transaksi, Urut,Tgl_Transaksi,Kd_Component,Tarif, Disc)
						Select '".$Schkasir."','".$notrans."',".$urutpasein.",'" . date('Y-m-d') . "',kd_component, tarif as FieldResult,0
						From Tarif_Component 
						Where KD_Unit='".$kd_unitpasein."' And Tgl_Berlaku='".$tglberlakupasien."' And KD_Tarif='".$kdTarifpasien."' And Kd_Produk=".$kdprodukpasien);	
					if ($query){
						$data_tarifpg=$db->query("Select * From Tarif_Component
							Where 
							(KD_Unit='".$kd_unitpasein."' 
							And Tgl_Berlaku='".$tglberlakupasien."'
							And KD_Tarif='".$kdTarifpasien."'
							And Kd_Produk=".$kdprodukpasien." 
							and kd_component = '".$kdjasadok."')
							 OR   (KD_Unit='".$kd_unitpasein."' 
							 And Tgl_Berlaku='".$tglberlakupasien."'
							 And KD_Tarif='".$kdTarifpasien."'
							 And Kd_Produk=".$kdprodukpasien." 
							and kd_component = '".$kdjasaanas."')");
						$getkodejobpg=$db->query("select kd_job from dokter_inap_int where kd_component='".$kdjasadok."'")->row()->kd_job;
						if (count($data_tarifpg->result())>0){
							$trDokter = $db->query("insert into detail_trdokter (kd_kasir,no_transaksi,urut,kd_dokter,tgl_transaksi,kd_component,jp,pajak,bayar)
										values
										('".$Schkasir."','".$notrans."',".$urutpasein.",'000','".date('Y-m-d')."',0,".$data_tarifpg->row()->tarif.",0,0)");
						}else{
							// $strError="tidak";
						}
					}
				}
			
			
			
			}
			
			
			
			$sqlCekReg="select count(kd_pasien) as jum from reg_unit where kd_unit='".$unit."' AND kd_pasien='".$medrec."'";
			$arrCekReg=$db->query($sqlCekReg)->row()->jum;
			if($arrCekReg==0){
				$sqlReg="select max(no_register) as no from reg_unit where kd_unit='".$unit."'";
				$resReg = $db->query($sqlReg)->row()->no;
				$resReg++;
				$arrReg=array(
					'kd_pasien'=>$medrec,
					'kd_unit'=>$unit,
					'no_register'=>$resReg,
					'urut_masuk'=>0
				);
				$db->insert('reg_unit', $arrReg);
			}
			
			date_default_timezone_set("Asia/Jakarta");
			$TglAntrian = gmdate("Y-m-d H:i:s", time()+60*60*7);
			$conv_tglmasuk = date('Y/m/d');
			$tglmasuk = date('Y-m-d');
			$kdunitprioritas = $db->query("select setting from sys_setting where key_data='rwj_kd_unit_no_antrian_prioritas'")->row()->setting;
			$sqlTracer_no_antrian_prioritas = $db->query("select count(*) as jum_prioritas 
				from kunjungan 
				where tgl_masuk='".$tglmasuk."' and kd_unit in(".$kdunitprioritas.")")->row()->jum_prioritas;
			if($sqlTracer_no_antrian_prioritas == 0){
				$no_prioritas=1;
			} else{
				$no_prioritas=$sqlTracer_no_antrian_prioritas + 1;
			}
			# No Antrian Cetak
			$cek_dulu_atrian_polinya=$db->query("select no_urut from antrian_poliklinik 
			where tgl_transaksi ='".$conv_tglmasuk."' and kd_unit='".$unit."' order by no_urut desc limit 1")->result();
			if (count($cek_dulu_atrian_polinya)==0){
				$urutCetak=1;
			}else{
				$sqlTracer_no_antrian_poli = $db->query("select no_urut from antrian_poliklinik 
				where tgl_transaksi ='".$conv_tglmasuk."' and kd_unit='".$unit."' order by no_urut desc limit 1")->row()->no_urut;
				if($sqlTracer_no_antrian_poli == 0){
					$urutCetak=1;
				} else{
					$urutCetak=$sqlTracer_no_antrian_poli + 1;
				}
			}
			$q_simpan_antrian_poli=$db->query("insert into antrian_poliklinik 
				 (kd_unit,tgl_transaksi,no_urut,kd_pasien,kd_user,id_status_antrian,sts_ditemukan,no_antrian,no_prioritas) values 
				 ('".$unit."','".$tglmasuk."',".$urutCetak.",'".$medrec."',".$_kduser.",1,FALSE,0,".$no_prioritas." )");
			if ($db->trans_status() === FALSE){
//				$db->trans_rollback();
			}else{
//				$db->trans_commit();
			}
			//
			$now=new DateTime();
			$tmpdir = sys_get_temp_dir();   # ambil direktori temporary untuk simpan file.
			// $file =  tempnam($tmpdir, 'ctk');  # nama file temporary yang akan dicetak
			$printer = '//192.168.1.251/EPSON_TM-T88V'; //printer cetak resi//
			//$printer = '//192.168.0.27/LX310_NEW';
			$file =  'C:\xampp\htdocs\rssm_online\resi_temp.txt';
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
			// $Data .= $condensed1;
			// $Data .= $condensed;
			$Data .= $condensed.str_pad('RSUD dr. Soedono'.$bold0,35," ",STR_PAD_BOTH)."\n";
			$Data .= $condensed.str_pad('Jl. Dr.Soetomo No.59 Kota Madiun.',20," ",STR_PAD_BOTH)."\n";
			$Data .= $condensed.str_pad('Telp. (0351) 454657.',30," ",STR_PAD_BOTH)."\n";
			$Data .= $condensed."--------------------------------\n";
			$Data .= $condensed.str_pad("CHECK IN REG. ONLINE",30," ",STR_PAD_BOTH)."\n";
			$Data .= $condensed."--------------------------------\n";
			$Data .= $condensed."No. Reg          : " .$condensed2.$noRegistrasi."\n";
			$Data .= $condensed."No. MR           : " .$condensed2.$medrec."\n";
			$Data .= $condensed."Nama Pasien      : " .$condensed2.$ori->getPatient()->getName()."\n";
			$Data .= $condensed."Poliklinik       : " .$condensed2.$ori->getUnit()->getUnitName()."\n";
			$Data .= $condensed."Tgl. Kunjungan   : " .$condensed2.$now->format('d M Y')."\n";
			$Data .= $condensed."Jam Masuk        : " .$condensed2.$now->format('H:i:s')."\n";
			$Data .= "\n";
			$Data .= "\n";
			$Data .= "\n";
			$Data .= "\n";
			$Data .= "\n";
			$Data .= "\n";
			$Data .= "\n";
			$Data .= "\n";
			$Data .= "\n";
			$Data .= chr(29) . chr(86) . chr(0) . chr(48);// autocutter
		//	echo $Data;
			fwrite($handle, $Data);
			fclose($handle);
			/*echo "<div></div>";
			echo '<script>var cmd = "doPrint#//192.168.0.27/LX310_NEW#'.base64_encode($Data).'; ws.send(cmd);</script>';*/
		//	copy($file, $printer); 
			//$result->end();
			return $this->printing_tracer($medrec);
	}

	public function printing_tracer($medrec){
		$db=$this->load->database('other',true);
		$cari_pasien=$db->query("SELECT b.nama, u.nama_unit,a.kd_unit,a.kd_dokter,a.tgl_masuk,a.jam_masuk,b.alamat,d.nama as nama_dokter
								 FROM kunjungan A INNER JOIN pasien b ON A.kd_pasien = b.kd_pasien 
								 INNER join unit u on a.kd_unit=u.kd_unit
								 INNER JOIN dokter d on a.kd_dokter=d.kd_dokter	
								 WHERE A.kd_pasien = '".$medrec."' and a.online='t' limit 1")->result();
		foreach ($cari_pasien as $value) {
			$kd_unit=$value->kd_unit;
			$tgl_masuk=$value->tgl_masuk;
			$namapasien=$value->nama;
			$urutCetak=$db->query("select no_urut from antrian_poliklinik WHERE KD_PASIEN = '".$medrec."' And kd_unit = '".$value->kd_unit."' And tgl_transaksi = '".$value->tgl_masuk."' order by no_urut desc")->row()->no_urut;

			$jumlah = $db->query("select count(*) as jumkunjungan from kunjungan where kd_pasien='".$medrec."'")->row()->jumkunjungan;
			if ($jumlah==0 || $jumlah==1){
				$anyar="(B)";
				$jumlah=1;
			}else{
				$anyar="";
			}

			$no_prioritas=$db->query("select no_prioritas from antrian_poliklinik WHERE KD_PASIEN = '".$medrec."' And kd_unit = '".$value->kd_unit."' And tgl_transaksi = '".$value->tgl_masuk."' order by no_urut desc")->row()->no_prioritas;

			$data = array(
				"kd_pasien"     => $medrec,
				"nama_pasien"   => $value->nama,
				"nama_unit"     => $value->nama_unit,
				"nama_dokter"   => $value->nama_dokter,
				"tgl_masuk"     => $value->tgl_masuk,
				"jam_masuk"     => $value->jam_masuk,
				"alamat"        => $value->alamat,
				"no_urut_cetak" => $urutCetak
			);
		}
		$save=$db->insert('tracer',$data);
		if($save){
			$cari_tracer=$db->query("SELECT t.nama_pasien,t.kd_pasien,t.tgl_masuk,u.nama_unit,t.nama_dokter,t.alamat,u.kd_unit,
									k.kd_rujukan,c.customer,k.jam_masuk, CASE WHEN k.baru = 't' THEN '(B)' ELSE '' END AS baru,
									no_antrian, age ( p.tgl_lahir ) AS tgl_lahir FROM tracer t 
									INNER JOIN kunjungan k ON k.kd_pasien = t.kd_pasien 
									AND t.tgl_masuk = k.tgl_masuk 
									INNER JOIN unit u ON k.kd_unit = u.kd_unit
									INNER JOIN pasien p ON p.kd_pasien = t.kd_pasien
									INNER JOIN customer c ON k.kd_customer = c.kd_customer
									INNER JOIN antrian_poliklinik ap ON ap.kd_pasien = t.kd_pasien 
									AND ap.TGL_TRANSAKSI = t.tgl_masuk 
									AND u.kd_unit = ap.kd_unit 
									WHERE k.KD_PASIEN = '".$medrec."' AND k.kd_unit = '".$kd_unit."' 
								 AND k.tgl_masuk = '".$tgl_masuk."'");

		if($cari_tracer->num_rows() == 0){
			$nama = '1';
			$kd_pasien = '2';
			$tgl_masuk = '3';
			$unit = '4';
			$dokter = '5';
			$alamat = '6';
			$customer = '7';
			$jam = '8';
			$baru = '9';
		}else {
			$tmpumur = '';
			foreach($cari_tracer->result() as $row){
				$nama      = $row->nama_pasien;
				$kd_pasien = $row->kd_pasien;
				$tgl_masuk = $row->tgl_masuk;
				$unit      = $row->nama_unit;
				$dokter    = $row->nama_dokter;
				$alamat    = $row->alamat;
				$customer  = $row->customer;
				$jam       = substr($row->jam_masuk,11);
				$baru      = $row->baru;
				$antrian   = $row->no_antrian;
				$Split1    = explode(" ", $row->tgl_lahir, 6);
				if (count($Split1) == 6){
					$tmp1 = $Split1[0];
					$tmp2 = $Split1[1];
					$tmp3 = $Split1[2];
					$tmp4 = $Split1[3];
					$tmp5 = $Split1[4];
					$tmp6 = $Split1[5];
					$tmpumur = $tmp1.'th';
				}else if (count($Split1) == 4){
					$tmp1 = $Split1[0];
					$tmp2 = $Split1[1];
					$tmp3 = $Split1[2];
					$tmp4 = $Split1[3];
					if ($tmp2 == 'years'){
						$tmpumur = $tmp1.'th';
					}else if ($tmp2 == 'mon'){
						$tmpumur = $tmp1.'bl';
					}else if ($tmp2 == 'days'){
						$tmpumur = $tmp1.'hr';
					}
				} else{
					$tmp1 = $Split1[0];
					$tmp2 = $Split1[1];
					if ($tmp2 == 'years') {
						$tmpumur = $tmp1.'th';
					}else if ($tmp2 == 'mons'){
						$tmpumur = $tmp1.'bl';
					} else if ($tmp2 == 'days'){
						$tmpumur = $tmp1.'hr';
					}
				}
			}
		}
		$rs=$db->query("SELECT * from db_rs")->result();
		foreach ($rs as $rs1) {
			$NameRS=$rs1->name;
			$Address=$rs1->address;
			$TLP=$rs1->phone1;
		}
		//$printer = '//192.168.1.251/EPSON_TM-T88V'; //printer cetak resi//
		$printer = '//192.168.0.27/LX310_NEW';
		$waktu = explode(" ",$tgl_masuk);
		$tanggal = $waktu[0];
		$t1 = 4;
		$t3 = 20;
		$t2 = 60 - ($t3 + $t1);
		$x = 0;
		$file =  'C:\xampp\htdocs\rssm_online\tracer_temp.txt';
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
		//$Data .= $condensed.str_pad($bold1.$NameRS.$bold0,64," ",STR_PAD_BOTH)."\n";$x++;
		//$Data .= $condensed.str_pad($bold1.$Address.$bold0,64," ",STR_PAD_BOTH)."\n";$x++;
		//$Data .= $condensed.str_pad($bold1.$TLP.$bold0,64," ",STR_PAD_BOTH)."\n";$x++;
		$Data .= $condensed."----------------------------------------------------------------\n"; $x++;
		$Data .= $condensed.str_pad($bold1."TRACER".$bold0,64," ",STR_PAD_BOTH)."\n";
		$Data .= $condensed."----------------------------------------------------------------\n"; $x++; //64
		$Data .= $condensed."No. Antrian Prioritas   : " .$condensed2.$no_prioritas."\n";$x++;
		$Data .= $condensed."No. Antrian Poli	: " .$condensed2.$urutCetak."\n";$x++;
		$Data .= $condensed."No. MR           	: " .$condensed2.$kd_pasien."\n";$x++;
		$Data .= $condensed."Nama             	: " .$condensed2.$namapasien." ".$anyar."\n";$x++;
		//$Data .= $condensed."Usia             	: " .$condensed2.$tmpumur."\n";$x++;
		$Data .= $condensed."Poliklinik       	: " .$condensed2.$unit."\n";$x++;
		//$Data .= $condensed."No. Antrian      : " .$condensed2.$antrian."\n";$x++;
		$Data .= $condensed."Kelompok Pasien  	: " .$condensed2.$customer."\n";$x++;
		$Data .= $condensed."Tgl Periksa      	: " .$condensed2.$tanggal. " " .$condensed2.$jam."\n";$x++;
		$Data .= $condensed."Jumlah Kunjungan 	: " .$condensed2.$jumlah."\n";$x++;
		$Data .= "\n";$x++;
		$Data .= "\n";$x++;
		$Data .= "\n";$x++;
		$Data .= "\n";$x++;
		$Data .= "   Pengirim            Penerima   ";
		$Data .= "\n";$x++;
		$Data .= "\n";$x++;
		$Data .= "\n";$x++;
		$Data .= "\n";$x++;
		$Data .= "\n";$x++;
		$Data .= "_______________     _______________";
		$Data .= "\n";$x++;
		$Data .= "\n";$x++;
		$Data .= "\n";$x++;
		$Data .= "\n";$x++;
		$Data .= "\n";$x++;
		$Data .= "\n";$x++;
		$counter = $db->query("select setting from sys_setting where key_data = 'setmarginprint'")->row()->setting;
		if($counter == '7'){
			$Data .=''; 
			$newVal = 1; 
			$update = $db->query("update sys_setting set setting = '$newVal' where key_data = 'setmarginprint'") ;
		}else{
			$Data .= "\n";
			$Data .= "\n";
			$Data .= "\n";
			$newVal = (int)$counter + 1; 
			$update = $db->query("update sys_setting set setting = '$newVal' where key_data = 'setmarginprint'") ;
		}
		if ($x < 17){
			$y = $x-17;
			for ($z = 1; $z<=$y;$z++){
				$Data .= "\n";
			}
		}
		fwrite($handle, $Data);
		fclose($handle);
		$success=false;
		$message='';
		//echo '1.'.$this->session->userdata['user_id']['id'].'<br>';
		$message='Tracer Berhasil diCetak.';
		//$cmd = 'lpr -P //localhost/epson-lx-310-me '.$file;
		//shell_exec("lpr -P ".$printer." -r ".$header);
			
		//
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		
			// echo $file;die();
			// copy($file, $printer);  # Lakukan cetak //DONAT
			// unlink($file);
			# printer windows -> nama "printer" di komputer yang sharing printer
		//	copy($header, $printer);  # Lakukan cetak
			//copy($file, $printer);  # Lakukan cetak
			//echo "{result:'SUCCESS'}";

		} else{
			//shell_exec("lpr -P ".$printer." /var/www/html/medismart/ui/images/Logo/header-sep.prn");
			//shell_exec("lpr -P ".$printer." ".$file); # Lakukan cetak linux
		    //echo "{result:'SUCCESS'}";
		} 
	 }
	 return base64_encode($Data);
		
	}
	
	public function cetaksepbpjs_direct(){
		$no_sep=$this->generateSEP();
		print_r(json_decode($no_sep));
		die();
		if(json_decode($no_sep))
		$this->load->library('fpdf/FPDF');
		$db=$this->load->database('SIM',true);
		$uri = $_SERVER["REQUEST_URI"];
		$uriArray = explode('/', $uri);
		$param1 = $no_sep;
		$catatantambahan = str_replace('~~_~~','/',$uriArray[(count($uriArray)-1)]);
		$catatantambahanasli = str_replace('%20',' ',$catatantambahan);
	 	$html='';
		$style='<style>
	 			.normal{
					width: 100%;
					font-family: Times New Roman, Helvetica, sans-serif;
   					border-collapse: none;
				} 
				
					
				.bottom{
					border-bottom: none;
	 				font-size: 12px;
				}
	 			
				div{
	 				text-align: justify;
					border:1px none;
    				text-justify: inter-word;
	 			}
				@media print{
					.no-print, .no-print *{
						display: none !important;
					}
				}
           </style>';
		$kd_rs='3577015';
		//echo $kd_rs;
		$rs=$db->query("SELECT * FROM db_rs WHERE code='".$kd_rs."'")->row();
		//<script>
			//	window.print();
		//	</script>
		$html.="
		<html>
		<head>
			".$style."
		</head>
		<body style='padding-top:100px;'>
		<table style='margin: 50px 50px 0px 50px;' cellspacing='0' border='0'>
   			<tr align=justify>
   				<th border='0';  width='10%' align='center'>
   					<img src='".base_url()."include/logo.png' width='50' height='35'/>
   				</th>
   				<th align='center'  >
					<font style='font-size: 12px;font-family: Calibri;line-height:90%;letter-spacing: 2px;'><b>SURAT ELEGIBILITAS PESERTA</b></font><br>
					<font style='font-size: 8px;font-family: Calibri;line-height:90%;letter-spacing: 2px;'>".strtoupper($rs->name)."</font><br>
   				</th>
				<th border='0' width='30%' align='center'>
   					<img src='".base_url()."include/BPJS.png' width='170' height='20'/>
   				</th>
   			</tr>
   		</table>
		<br/>";
		$url= "http://api.bpjs-kesehatan.go.id:8080/VClaim-rest/SEP/";
		$opts = array(
		  'http'=>array(
			'method'=>'GET',
			'header'=>$this->getSignatureVedika()
		  )
		);
		$kelasRawat='';
		$no_telepon = "-";
		$context = stream_context_create($opts);
		// print_r(file_get_contents($url.$param1,false,$context));die();
		$res = json_decode(file_get_contents($url.$param1,false,$context),false);
		//echo json_encode($res);
		$no_kartu_peserta=$res->response->peserta->noKartu;
		$catatan=$res->response->catatan;
		$pasien=$this->db->query("select * from rs_visit where nomor_peserta='$no_kartu_peserta'")->result();
		foreach ($pasien as  $value) {
			$faskes_asal_peserta=$value->faskes_asal;
		}
		$no_telepon='';
		$faskes_asal='';
		if($res->metaData->code=='200'){
			if($res->response->peserta->kelamin == 'P'){
				$jk='WANITA';
			} else{
				$jk='PRIA';
			} 
			$kelasRawat=$res->response->peserta->hakKelas;
			$nama=$res->response->peserta->nama;
			$peserta=$res->response->peserta->jnsPeserta;
			$tglsep=date("d/m/Y", strtotime($res->response->tglSep));
			$tgl_lahir=date("d/m/Y", strtotime($res->response->peserta->tglLahir));
			//ob_start();
			$html.='<table background="white" cellspacing="0" border="0" style="font-color:#000000;font-size: 9px;font-family:  				Calibri; margin: 0px 10px;line-height:90%;letter-spacing: 1px;font-stretch: condensed;">

					<tr style="height: 5px;">
						<td width="100">No. SEP</td>
						<td width="6">:</td>
						<td width="300" style="font-size:12px;"><b>'.$no_sep.'</b></td>
						<td width="26">&nbsp;</td>
						<td width="100">No. Mr</td>
						<td width="8">:</td>
						<td width="100">'.$res->response->peserta->noMr.'</td>
					</tr>
					
					<tr>
						<td height="5" ></td>
					</tr>

					<tr>
						<td width="100">Tgl. SEP</td>
						<td width="6">:</td>
						<td>'.$tglsep.'</td>
						<td width="26"></td>
						<td></td>
						<td width="8"></td>
						<td></td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>

					<tr>
						<td width="100">No. Kartu</td>
						<td width="6">:</td>
						<td style="font-size:12px;"><b>'.$res->response->peserta->noKartu.'</b></td>
						<td width="26">&nbsp;</td>
						<td>Peserta</td>
						<td width="8">:</td>
						<td rowspan="2" valign="top">'.$peserta.'</td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Nama Peserta</td>
						<td width="6">:</td>
						<td>'.strtoupper($nama).'</td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Tgl. Lahir</td>
						<td width="6">:</td>
						<td>'.$tgl_lahir.'</td> 
						<td width="26"></td>
						<td>COB</td>
						<td width="8">:</td>
						<td></td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Jns Kelamin</td>
						<td width="6">:</td>
						<td>'.$jk.'</td>
						<td width="26">&nbsp;</td>
						<td>Jns. Rawat</td>
						<td width="8">:</td>
						<td>'.$res->response->jnsPelayanan.'</td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Poli Tujuan</td>
						<td width="6">:</td>
						<td>'.$res->response->poli.'</td>
						<td width="26">&nbsp;</td>
						<td>Kls. Rawat</td>
						<td width="8">:</td>
						<td>'.$kelasRawat.'</td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Asal Faskes Tk. 1</td>
						<td width="6">:</td>
						<td>'.$faskes_asal_peserta.'</td>
						<td width="26">&nbsp;</td>
						<td>Operator</td>
						<td width="8">:</td>
						<td>operator</td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>


					<tr>
						<td width="100">Diagnosa Awal</td>
						<td width="6">:</td>
						<td>'.$res->response->diagnosa.'</td>
						<td width="26">&nbsp;</td>
						<td></td>
						<td width="8"></td>
						<td></td>
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>

					<tr>
						<td width="100">Catatan</td>
						<td width="6">:</td>
						<td>'.$catatan.'</td>
						<td width="26">&nbsp;</td>
						<td align="center">Pasien / Keluarga</td>
						<td width="8"></td>
						<td align="center"></td>	
					</tr>

					
					<tr>
						<td height="5" ></td>
					</tr>

					<tr>
						<td width="100"></td>
						<td width="6"></td>
						<td></td>
						<td width="26">&nbsp;</td>
						<td align="center">Pasien</td>
						<td width="8"></td>
						<td align="center"></td>
					</tr>

					
					<tr>
						<td height="15" ></td>
					</tr>


					 <tr>
						<td colspan="3";><font style="font-weight:bold;font-size: 7px;font-family: Arial;"><i>*Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan</i></font> </td>
					</tr>

					</table>
					</body>
					</html>'; 
			pdf(array('html'=>$html,'margin-top'=>15,'margin-left'=>15,'margin-right'=>15,'paper'=>array(0, 0, 665, 320),'page-number'=>false,array("Attachment" => false)));

		}
		
	}		

}

