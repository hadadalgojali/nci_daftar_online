<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Employee
class RS1 extends MY_controller {
	public $MA='RS1';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end ();
	}
	public function searchMedrec(){
		$common = $this->common;
		$medrec=$this->get('f1');
		$r=$common->createQuery("SELECT M FROM ".$common->getModel('Patient')." M WHERE M.patientCode='".$medrec."'");
		$data=array();
		$data['d']=$common->getSystemProperty('CUS_BPJS', $common->getSystemProperty('DEFAULT_TENANT', null)->getPropertyValue())->getPropertyValue();
		if($r->getResult()){
			$ori=$r->getSingleResult();
			$data['t']=1;
			$mod['i']=$ori->getId();
			$mod['f1']=$ori->getPatientCode();
			$mod['f2']=$ori->getName();
			$mod['f3']=$ori->getBirthPlace();
			$mod['f4']=$ori->getBirthDate()->format('Y-m-d');
			$mod['f5']=$ori->getGender()->getOptionCode();
			$mod['f6']=$ori->getReligion()->getOptionCode();
			$mod['f7']=$ori->getEdu()->getOptionCode();
			$mod['f8']=$ori->getAddress();
			$mod['f9']=$ori->getRt();
			$mod['f10']=$ori->getRw();
			$country=$ori->getCountry();
			$mod['f11']=$country->getId();
			$mod['f11t']=$country->getValue();
			$countryTemp=$ori->getCountryTemp();
			if($countryTemp != null)
				$mod['f12']=$countryTemp->getValue();
			else
				$mod['f12']='';
			$province=$ori->getProvince();
			$mod['f13']=(int)$province->getId();
			$provinceTemp=$ori->getProvinceTemp();
			if($provinceTemp != null)
				$mod['f14']=$provinceTemp->getValue();
			else
				$mod['f14']='';
			$district=$ori->getDistrict();			
			$mod['f15']=(int)$district->getId();
			$districtTemp=$ori->getDistrictTemp();
			if($districtTemp != null)
				$mod['f16']=$districtTemp->getValue();
			else
				$mod['f16']='';
			$districts=$ori->getDistricts();
			$mod['f17']=(int)$districts->getId();
			$districtsTemp=$ori->getDistrictsTemp();
			if($districtsTemp != null){
				$mod['f18']=$districtsTemp->getValue();
			}else{
				$mod['f18']='';
			}
			$kelurahan=$ori->getKelurahan();
			$mod['f19']=(int)$kelurahan->getId();
			$kelurahanTemp=$ori->getKelurahanTemp();
			if($kelurahanTemp != null)
				$mod['f20']=$kelurahanTemp->getValue();
			else
				$mod['f20']='';
			$mod['f21']=$ori->getPostalCode();
			$mod['f31']=$ori->getTitle();
			$mod['f30']=$ori->getBlod()->getOptionCode();
			$mod['f32']=$ori->getPhoneNumber();
			$mod['f33']=$ori->getKtp();
			$data['o']=$mod;
			$this->jsonresult->setMessage('Data Ditemukan.')->setData($data)->end();
		}else{
			$admin_db= $this->load->database('SIM', TRUE);
			$medrec_asli=$medrec;
			$medrec=str_replace("-","",$medrec);
			$query = $admin_db->query("select id,AES_DECRYPT(first_name, '2588E97311D9D') as first_name,AES_DECRYPT(last_name, '2588E97311D9D') as last_name,birth_place,
					address,rt,rw,postcode,salutation,phone,gender,dob from whms_patients WHERE mr='".$medrec."'");
			$count=count($query->result());
			if($count==1){
				$ori=$query->row();
				$mod=array();
				$data['t']=2;
				$mod['i']=$ori->id;
				$mod['f1']=$medrec_asli;
				$mod['f2']=$ori->first_name.' '.$ori->last_name;
				$mod['f3']=$ori->birth_place;
				$tglLahir=new DateTime($ori->dob);
				$mod['f4']=$tglLahir->format('Y-m-d');
				if($ori->gender != null){
					if($ori->gender=='F'){
						$mod['f5']='GENDER_P';
					}else{
						$mod['f5']='GENDER_L';
					}
				}else{
					$mod['f5']=null;
				}
				$mod['f6']=null;
				$mod['f7']=null;
				$mod['f8']=$ori->address;
				$mod['f9']=$ori->rt;
				$mod['f10']=$ori->rw;
				$mod['f11']=null;
				$mod['f12']='Lain-lain';
				$mod['f13']=null;
				$mod['f14']='Lain-lain';
				$mod['f15']=null;
				$mod['f16']='Lain-lain';
				$mod['f17']=null;
				$mod['f18']='Lain-lain';
				$mod['f19']=null;
				$mod['f20']='Lain-lain';
				$mod['f21']=$ori->postcode;
				$mod['f31']=$ori->salutation;
				$mod['f30']=null;
				$mod['f32']=$ori->phone;
				$mod['f33']='';
				$data['o']=$mod;
				$this->jsonresult->setMessage('Data Ditemukan Di Server SIM.')->setData($data)->end();
			}else if($count >1){
				$this->jsonresult->setMessage('Isi Nomor Medrec Lebih Detail.')->end();
			}else{
				$this->jsonresult->setMessage('Pasien Tidak Ditemukan.')->end();
			}
		}
	}
	public function cetakSep(){
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
		
		pdf(array('html'=>$html,'margin-top'=>15,'margin-left'=>15,'margin-right'=>15,'paper'=>array(0, 0, 595, 320),'page-number'=>false));
	}
	public function getById(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pid=$this->get('i');
		$ori=$common->find('Patient',$pid);
		if($ori != null){
			$data=array();
				
			$mod=array();
			$mr=$ori->getPatientCode();
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
			$mod['f1']=$mr;
			$mod['f2']=$ori->getTitle();
			$mod['f3']=$ori->getName();
			$mod['f4']=$ori->getBirthPlace();
			$birthdate=$ori->getBirthDate();
			if($birthdate != null){
				$mod['f5']=$birthdate->format('d M Y');
			}else{
				$mod['f5']='';
			}
			$gender=$ori->getGender();
			if($gender != null){
				$mod['f6']=$gender->getOptionName();
			}else{
				$mod['f6']='';
			}
			$religion=$ori->getReligion();
			if($religion != null){
				$mod['f7']=$religion->getOptionName();
			}else{
				$mod['f7']='';
			}
			$edu=$ori->getEdu();
			if($edu != null){
				$mod['f8']=$edu->getOptionName();
			}else{
				$mod['f8']='';
			}
			$blod=$ori->getBlod();
			if($blod != null){
				$mod['f9']=$blod->getOptionName();
			}else{
				$mod['f9']='';
			}
			$mod['f10']=$ori->getAddress();
			$mod['f11']=$ori->getPostalCode();
			$mod['f19']=$ori->getKtp();
			$mod['f12']=$ori->getPhoneNumber();
			$mod['f13']=$ori->getRt().'/'.$ori->getRw();
			$country=$ori->getCountry();
			if($country != null){
				if($country->getId()!= 0){
					$mod['f14']=$country->getValue();
				}else{
					$countryTemp=$ori->getCountryTemp();
					if($countryTemp != null)
						$mod['f14']=$countryTemp->getValue();
					else
						$mod['f14']='';
				}
			}else{
				$mod['f14']='';
			}
			
			$province=$ori->getProvince();
			if($province != null){
				if($province->getId() != 0){
					$mod['f15']=$province->getValue();
				}else{
					$provinceTemp=$ori->getProvinceTemp();
					if($provinceTemp != null)
						$mod['f15']=$provinceTemp->getValue();
					else
						$mod['f15']='';
				}
			}else{
				$mod['f15']='';
			}
			
			$district=$ori->getDistrict();
			if($district != null){
				if($district->getId()!= 0){
					$mod['f16']=$district->getValue();
				}else{
					$districtTemp=$ori->getDistrictTemp();
					if($districtTemp != null)
						$mod['f16']=$districtTemp->getValue();
					else
						$mod['f16']='';
				}
			}else{
				$mod['f16']='';
			}
			
			$districts=$ori->getDistricts();
			if($districts != null){
				if($districts->getId() != ''){
					$mod['f17']=$districts->getValue();
				}else{
					$districtsTemp=$ori->getDistrictsTemp();
					if($districtsTemp != null){
						$mod['f17']=$districtsTemp->getValue();
					}else{
						$mod['f17']='';
					}
				}
			}else{
				$mod['f17']='';
			}
			
			$kelurahan=$ori->getKelurahan();
			if($kelurahan != null){
				if($kelurahan->getId() != 0){
					$mod['f18']=$kelurahan->getValue();
				}else{
					$kelurahanTemp=$ori->getKelurahanTemp();
					if($kelurahanTemp != null)
						$mod['f18']=$kelurahanTemp->getValue();
					else
						$mod['f18']='';
				}
			}else{
				$mod['f18']='';
			}
			
			$this->jsonresult->setData($mod)->end();
		}else{
			$result->error()->setMessageNotExist()->end();
		}
	}
	public function initSearch(){
		$common = $this->common;
		$result = $this->jsonresult;
		$data=array();
		$data['l']=$common->getParams('GENDER');
		$result->setData($data)->end();
	}
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
		//echo json_encode($opts);
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
	public function initDaftar(){
		$common = $this->common;
		$pid=$this->get('i');
		$ori=$common->find('Patient',$pid);
		if($ori != null){
			$data=array();
			$data['l']=$common->getParams('GENDER');
			$data['l1']=$common->getParams('RELIGION');
			$data['l2']=$common->getParams('EDUCATION');
			$data['l5']=$common->getParams('BLOD');
			$cus=array();
			$cus=$common->queryResult("SELECT customer_id,customer_name FROM rs_customer ORDER BY customer_name ASC" );
			$oList=array();
			for($i=0,$iLen=count($cus); $i<$iLen ; $i++){
				$oO=$cus[$i];
				$oM=array();
				$oM['id']=$oO->customer_id;
				$oM['text']=$oO->customer_name;
				$oList[]=$oM;
			}
			$data['l3']=$oList;
			$units=array();
			$units=$common->queryResult("SELECT unit_id,unit_name,unit_code FROM rs_unit WHERE unit_type='UNITTYPE_RWJ' ORDER BY unit_name ASC" );
			$oList=array();
			for($i=0,$iLen=count($units); $i<$iLen ; $i++){
				$oO=$units[$i];
				$oM=array();
				$oM['id']=$oO->unit_id;
				$oM['text']=$oO->unit_name;
				$oM['code']=$oO->unit_code;
				$oList[]=$oM;
			}
			$data['l4']=$oList;
			$data['d']=$common->getSystemProperty('CUS_BPJS', $common->getSystemProperty('DEFAULT_TENANT', null)->getPropertyValue())->getPropertyValue();
			
			$mod=array();
			$mr=$ori->getPatientCode();
			if(is_numeric($mr)==true){
				$split=str_split(strval($mr),2);
				$mr='';
				for($j=0,$jLen=count($split); $j<$jLen ; $j++){
					if($mr!='')
						$mr.='-';
					$mr.=$split[$j];
				}
			}
			$mod['f1']=$mr;
			$mod['f2']=$ori->getName();
			$mod['f3']=$ori->getBirthPlace();
			$birthDate=$ori->getBirthDate();
			if($birthDate != null)
				$mod['f4']=$birthDate->format('Y-m-d');
			else
				$mod['f4']=null;
			$gender=$ori->getGender();
			if($gender != null)
				$mod['f5']=$gender->getOptionCode();
			else
				$mod['f5']=null;
			$religion=$ori->getReligion();
			if($religion != null)
				$mod['f6']=$religion->getOptionCode();
			else
				$mod['f6']=null;
			$edu=$ori->getEdu();
			if($edu != null)
				$mod['f7']=$edu->getOptionCode();
			else
				$mod['f7']=null;
			
			$mod['f8']=$ori->getAddress();
			$mod['f9']=$ori->getRt();
			$mod['f10']=$ori->getRw();
			$country=$ori->getCountry();
			if($country !=null)
				$mod['f11']=(int)$country->getId();
			else
				$mod['f11']=null;
			$countryTemp=$ori->getCountryTemp();
			if($countryTemp != null)
				$mod['f12']=$countryTemp->getValue();
			else
				$mod['f12']='';
			$province=$ori->getProvince();
			if($province != null)
				$mod['f13']=(int)$province->getId();
			else
				$mod['f13']=null;
			
			$provinceTemp=$ori->getProvinceTemp();
			if($provinceTemp != null)
				$mod['f14']=$provinceTemp->getValue();
			else
				$mod['f14']='';
			$district=$ori->getDistrict();	
			if($district != null)
				$mod['f15']=(int)$district->getId();
			else
				$mod['f15']=null;
			$districtTemp=$ori->getDistrictTemp();
			if($districtTemp != null)
				$mod['f16']=$districtTemp->getValue();
			else
				$mod['f16']='';
			$districts=$ori->getDistricts();
			if($districts != null)
				$mod['f17']=(int)$districts->getId();
			else
				$mod['f17']=null;
			$districtsTemp=$ori->getDistrictsTemp();
			if($districtsTemp != null)
				$mod['f18']=$districtsTemp->getValue();
			else
				$mod['f18']='';
			$kelurahan=$ori->getKelurahan();
			if($kelurahan != null)
				$mod['f19']=(int)$kelurahan->getId();
			else
				$mod['f19']=null;
			$kelurahanTemp=$ori->getKelurahanTemp();
			if($kelurahanTemp != null)
				$mod['f20']=$kelurahanTemp->getValue();
			else
				$mod['f20']='';
			$mod['f21']=$ori->getPostalCode();
			$mod['f31']=$ori->getTitle();
			$blod=$ori->getBlod();
			if($blod != null)
				$mod['f30']=$blod->getOptionCode();
			else
				$mod['f30']=null;
			$mod['f32']=$ori->getPhoneNumber();
			$mod['f33']=$ori->getKtp();
			$data['o']=$mod;
			$this->jsonresult->setData($data)->end();
		}else
			$result->error()->setMessageNotExist()->end();
	}
	public function initDaftarBaru(){
		$common = $this->common;
		$data=array();
		$data['l']=$common->getParams('GENDER');
		$data['l1']=$common->getParams('RELIGION');
		$data['l2']=$common->getParams('EDUCATION');
		$data['l5']=$common->getParams('BLOD');
		$cus=array();
		$cus=$common->queryResult("SELECT customer_id,customer_name FROM rs_customer ORDER BY customer_name ASC" );
		$oList=array();
		for($i=0,$iLen=count($cus) ; $i<$iLen; $i++){
			$oO=$cus[$i];
			$oM=array();
			$oM['id']=$oO->customer_id;
			$oM['text']=$oO->customer_name;
			$oList[]=$oM;
		}
		$data['l3']=$oList;
		$units=array();
		$units=$common->queryResult("SELECT unit_id,unit_name,unit_code FROM rs_unit WHERE unit_type='UNITTYPE_RWJ' ORDER BY unit_name ASC" );
		$oList=array();
		for($i=0,$iLen=count($units); $i< $iLen; $i++){
			$oO=$units[$i];
			$oM=array();
			$oM['id']=$oO->unit_id;
			$oM['text']=$oO->unit_name;
			$oM['code']=$oO->unit_code;
			$oList[]=$oM;
		}
		$data['l4']=$oList;
		$data['d']=$common->getSystemProperty('CUS_BPJS', $common->getSystemProperty('DEFAULT_TENANT', null)->getPropertyValue())->getPropertyValue();
		$this->jsonresult->setData($data)->end();
	}
	public function getProvinsi(){
		$common=$this->common;
		$text=$this->input->get('query');
		$parent=$this->input->get('i');
	
		$criteria='';
		if($parent != null && trim($parent) != '')
			$criteria='  AND country_id='.$parent;
		$res=$common->queryResult("SELECT province_id,province FROM area_province WHERE UPPER(province) LIKE UPPER('".$text."%') ".$criteria."  AND province_id !=0
		 ORDER BY province ASC LIMIT 10");
		$arr=array();
		$arr[]=array('id'=>0,'text'=>'Lain-lain');
		for($i=0,$iLen=count($res); $i< $iLen; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=(int)$country->province_id;
			$o['text']=$country->province;
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function getPenyakit(){
		$common=$this->common;
		$text=$this->input->get('query');
		$arr=array();
		$res=$common->queryResult("SELECT kd_penyakit,penyakit FROM rs_penyakit WHERE UPPER(penyakit) LIKE UPPER('".$text."%') OR 
				UPPER(kd_penyakit) LIKE UPPER('".$text."%') ORDER BY kd_penyakit ASC LIMIT 10");
		for($i=0,$iLen=count($res); $i<$iLen ; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=$country->kd_penyakit;
			$o['text']=$country->kd_penyakit.' - '.$country->penyakit;
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function getKota(){
		$common=$this->common;
		$text=$this->input->get('query');
		$parent=$this->input->get('i');
		$criteria='';
		if($parent != null && trim($parent) != '')
			$criteria='  AND province_id='.$parent;
		$res=$common->queryResult("SELECT district_id,district FROM area_district WHERE UPPER(district) LIKE UPPER('".$text."%') ".$criteria."  AND district_id !=0
		 	ORDER BY district ASC LIMIT 10");
		$arr=array();
		$arr[]=array('id'=>0,'text'=>'Lain-lain');
		for($i=0,$iLen=count($res) ; $i<$iLen; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=(int)$country->district_id;
			$o['text']=$country->district;
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function getKecamatan(){
		$common=$this->common;
		$text=$this->input->get('query');
		$parent=$this->input->get('i');
		$criteria='';
		if($parent != null && trim($parent) != '')
			$criteria='  AND district_id='.$parent;
		$res=$common->queryResult("SELECT districts_id,districts FROM area_districts WHERE UPPER(districts) LIKE UPPER('".$text."%') ".$criteria."  AND districts_id !=0
		 	ORDER BY districts ASC LIMIT 10");
		$arr=array();
		$arr[]=array('id'=>0,'text'=>'Lain-lain');
		for($i=0,$iLen=count($res); $i<$iLen ; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=(int)$country->districts_id;
			$o['text']=$country->districts;
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function getDokter(){
		$common=$this->common;
		$text=$this->input->get('query');
		$unit=$this->input->get('i');
		$arr=array();
		if(trim($unit) != ''){
			$res=$common->queryResult("SELECT A.employee_id,A.first_name,A.last_name FROM rs_dokter_klinik M INNER JOIN app_employee A ON M.employee_id=A.employee_id
					WHERE (UPPER(A.first_name) LIKE UPPER('%".$text."%') or UPPER(A.first_name) LIKE UPPER('%".$text."%') )
					AND unit_id=".$unit." ORDER BY A.first_name ASC LIMIT 10");
			for($i=0,$iLen=count($res); $i<$iLen ; $i++){
				$country=$res[$i];
				$o=array();
				$o['id']=$country->employee_id;
				$o['text']=$country->first_name." ".$country->last_name;
				$arr[]=$o;
			}
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function save(){
		$common=$this->common;
		$result = $this->jsonresult;
		$pid=$this->post('i');
		$pageType=$this->post('p');
		$gelar=$this->post('f31');
		$medrec=$this->post('f1');
		$nama=$this->post('f2');
		$tempatLahir=$this->post('f3');
		$common->setDynamicOption($tempatLahir,'DYNAMIC_CITY');
		$tanggalLahir=$this->post('f4');
		$jenisKelamin=$this->post('f5');
		$agama=$this->post('f6');
		$pendidikan=$this->post('f7');
		$alamat=$this->post('f8');
		$rt=$this->post('f9');
		$rw=$this->post('f10');
		$goldar=$this->post('f30');
		$kodePos=$this->post('f21');
		
		$klinik=$this->post('f25');
		$poliklinik=$common->find ( 'Unit',$klinik);
		$dokter=$this->post('f28');
		$dokterO=$common->find ( 'Employee',$dokter);
		$kelompok=$this->post('f22');
		$diagnosa=$this->post('f27');
		$noBpjs=$this->post('f23');
		$noSep=$this->post('f26');
		$namaPeserta=$this->post('f24');
		$phoneNumber=$this->post('f32');
		$ktp=$this->post('f33');
		$pbi=$this->post('f34');
		if($pbi=='true')
			$pbi=true;
		else
			$pbi=false;
		$negara=$this->post('f11');
		$negaraLain=$this->post('f12');
		$province=$this->post('f13');
		$provinceLain=$this->post('f14');
		$kota=$this->post('f15');
		$kotaLain=$this->post('f16');
		$kecamatan=$this->post('f17');
		$kecamatanLain=$this->post('f18');
		$kelurahan=$this->post('f19');
		$kelurahanLain=$this->post('f20');
		$bpjs=$this->post('bpjs');
		$sep=$this->post('sep');
		
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
			B.id=".$dokter."
			ORDER BY u.jam ASC")->getResult();
		$ObjectAntrian=$common->createQuery("SELECT u FROM ".$common->getModel('Antrian')." u 
			INNER JOIN u.unit A
			INNER JOIN u.dokter B
			WHERE 
			u.tglMasuk='".$now->format('Y-m-d')."' AND 
			A.id=".$klinik." AND 
			B.id=".$dokter);
		if($jadwal){
			$jumlah=0;
			for($i=0,$iLen=count($jadwal); $i<$iLen ; $i++){
				$jumlah+=$jadwal[$i]->getMaxAntrian();
			}
			if(!$ObjectAntrian->getResult() || ($jumlah>$ObjectAntrian->getSingleResult()->getAntrian())){
				$patient=null;
				if($pageType=='UPDATE')
					$patient=$common->find('Patient',$pid);
				else
					$patient=$common->newModel('Patient');
				$antri=1;
				$countryTemp=null;
				if($negara==0){
					$countryTemp=$common->newModel('Temp');
					$countryTemp->setValue($negaraLain)
						->save();
				}
				$provinceTemp=null;
				if($province==0){
					$provinceTemp=$common->newModel('Temp');
					$provinceTemp->setValue($provinceLain)
					->save();
				}
				$districtTemp=null;
				if($kota==0){
					$districtTemp=$common->newModel('Temp');
					$districtTemp->setValue($kotaLain)
					->save();
				}
				$districtsTemp=null;
				if($kecamatan==0){
					$districtsTemp=$common->newModel('Temp');
					$districtsTemp->setValue($kecamatanLain)
					->save();
				}
				$kelurahanTemp=null;
				if($kelurahan==0){
					$kelurahanTemp=$common->newModel('Temp');
					$kelurahanTemp->setValue($kelurahanLain)
					->save();
				}
				$patient->setTitle($gelar)
					->setName($nama)
					->setBirthPlace($tempatLahir)
					->setBirthDate(new \DateTime($tanggalLahir))
					->setGender($common->find ( 'ParameterOption',$jenisKelamin ))
					->setReligion($common->find ( 'ParameterOption',$agama))
					->setBlod($common->find ( 'ParameterOption', $goldar ))
					->setEdu($common->find ( 'ParameterOption',$pendidikan ))
					->setAddress($alamat)
					->setKtp($ktp)
					->setRt($rt)
					->setRw($rw)
					->setPhoneNumber($phoneNumber)
					->setCountry($common->find ( 'Country',$negara ))
					->setCountryTemp($countryTemp)
					->setProvince($common->find ( 'Province', $province))
					->setProvinceTemp($provinceTemp)
					->setDistrict($common->find ( 'District',$kota ))
					->setDistrictTemp($districtTemp)
					->setDistricts($common->find ( 'Districts', $kecamatan ))
					->setDistrictsTemp($districtsTemp)
					->setKelurahan($common->find ( 'Kelurahan', $kelurahan ))
					->setKelurahanTemp($kelurahanTemp)
					->setPostalCode($kodePos);
				if($pageType=='UPDATE'){
					$patient->update();
				}else{
					if($medrec != null && $medrec !=''){
						$patient->setPatientCode($medrec)
						->save();
					}else{
						$seq=$common->getNextSequence('MEDREC');
						$code=$seq['val'];
						$patient->setPatientCode($code)
							->save();
						$medrec=$code;
					}
					$this->common->nextSequence('MEDREC');
				}
				if($ObjectAntrian->getResult()){
					$antrian=$ObjectAntrian->getSingleResult();
					$antri=$antrian->getAntrian()+1;
					$antrian->setAntrian($antri)->update();
				}else{
					$antrian=$common->newModel('Antrian');
					$antrian->setTglMasuk($now)
						->setUnit($poliklinik)
						->setDokter($dokterO)
						->setAntrian($antri)
						->save();
				}
				$visit=null;
				$entrySeq=1;
				if($pageType=='UPDATE'){
					$visit=$common->createQuery("SELECT u FROM Entity\content\Visit u
							INNER JOIN u.unit A
							INNER JOIN u.patient C
							WHERE
							u.entryDate='".$now->format('Y-m-d')."' AND
							A.id=".$klinik." AND
							C.id=".$pid."
							ORDER BY u.entrySeq DESC
							")->setMaxResults(1);
					if($visit->getResult()){
						$obj=$visit->getSingleResult();
						$entrySeq=$obj->getEntrySeq()+1;
					}
				}
				$defaultTenant=$common->getSystemProperty('DEFAULT_TENANT', null)->getPropertyValue();
				$visit=$common->newModel('Visit');
				$seq=$this->common->getNextSequence('DAFTAR_ONLINE',$defaultTenant);
				$codeReg=$seq['val'];
				$visit->setUnit($poliklinik)
					->setEntryDate($now)
					->setEntrySeq($entrySeq)
					->setDokter($dokterO)
					->setAntrian($antri)
					->setNomorPendaftaran($codeReg)
					->setCustomer($common->find ( 'Customer',$kelompok ))
					->setPatient($patient)
					->setKodeSep($noSep)
					->setHadir(true)
					->setPenyakit($common->find('Penyakit',$diagnosa))
					->setJsonSep($sep)
					->setJsonBpjs($bpjs)
					->setJenisDaftar($common->find ( 'ParameterOption', 'JNSDFTR_OFFLINE' ))
					->setNamaPeserta($namaPeserta)
					->setNomorPeserta($noBpjs)
					->setStatus(false);
				if($noSep != null && $noSep != ''){
					if($pbi==true){
						$visit->setPbi(true);
					}else{
						$visit->setNonPbi(true);
					}
				}
				if($pageType=='UPDATE'){
					$visit->setBaru(false);
				}else{
					$visit->setBaru(true);
				}
				$visit->save();
				$this->common->nextSequence('DAFTAR_ONLINE',$defaultTenant);
				$jam=null;
				$last=0;
				if($ObjectAntrian->getResult()){
					$last=$ObjectAntrian->getSingleResult()->getAntrian()-1;
				}
				if(strtotime($now->format('Y-m-d'))>strtotime($now->format('Y-m-d')) || 
					(strtotime($now->format('Y-m-d'))==strtotime($now->format('Y-m-d')) && strtotime($now->format('H:i:s'))<strtotime($jadwal[0]->getJam()->format('H:i:s')))){
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
				$result->setData($medrec)->setMessage('Pendaftaran Berhasil.')->end();
			}else{
				$result->error()->setMessage('Pendaftaran Gagal, Poliklinik: '.$poliklinik->getUnitName().
					', Dokter : '.$dokterO->getFirstName().' '.$dokterO->getLastName().', Antrian Sudah Penuh. Harap Pilih Tanggal Jadwal Yang Lain.')->end();
			}
		}else{
			$result->error()->setMessage('Pendaftaran Gagal, Poliklinik: '.$poliklinik->getUnitName().
					', Dokter : '.$dokterO->getFirstName().' '.$dokterO->getLastName().', Sedang Tidak Ada Jadwal. Harap Pilih Tanggal Jadwal Yang Lain.')->end();
		}
	}
	public function getKelurahan(){
		$common=$this->common;
		$text=$this->input->get('query');
		$parent=$this->input->get('i');
		$criteria='';
		if($parent != null && trim($parent) != '')
			$criteria='  AND districts_id='.$parent;
		$res=$common->queryResult("SELECT kelurahan_id,kelurahan FROM area_kelurahan WHERE UPPER(kelurahan) LIKE UPPER('".$text."%') ".$criteria."  AND kelurahan_id !=0
		 	ORDER BY kelurahan ASC LIMIT 10");
		$arr=array();
		$arr[]=array('id'=>0,'text'=>'Lain-lain');
		for($i=0,$iLen=count($res); $i<$iLen ; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=(int)$country->kelurahan_id;
			$o['text']=$country->kelurahan;
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function getNegara(){
		$common=$this->common;
		$text=$this->input->get('query');
		$res=$common->queryResult("SELECT country_id,country_name FROM area_country WHERE UPPER(country_name) LIKE UPPER('".$text."%') AND country_id !=0
		 	ORDER BY country_id ASC LIMIT 10");
		$arr=array();
		$arr[]=array('id'=>0,'text'=>'Lain-lain');
		for($i=0,$iLen=count($res); $i<$iLen ; $i++){
			$country=$res[$i];
			$o=array();
			$o['id']=$country->country_id;
			$o['text']=$country->country_name;
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function getList(){
		ini_set('max_execution_time', 900);
		$common = $this->common;
		$result = $this->jsonresult;
		
		$first=$this->get('page');
		$size=$this->get('pageSize');
		$direction=$this->get('d',false);
		$sorting=$this->get('s',false);
		
		$noMedrec=$this->get('f1',false);
		$nama=$this->get('f2',false);
		$jk=$this->get('f3',false);
		$startDate=$this->get('f4',false);
		$endDate=$this->get('f5',false);
		$alamat=$this->get('f6',false);
		$telepon=$this->get('f7',false);
		$ktp=$this->get('f8',false);
		
		$entity=' rs_patient ';
		$criteria="";
		$inner='
				INNER JOIN app_parameter_option A ON M.gender=A.option_code
				';
		if($noMedrec != null && trim($noMedrec)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(patient_code) like upper('%".$noMedrec."%')";
		}
		if($ktp != null && trim($ktp)!=''){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
			$criteria.=" upper(no_ktp) like upper('%".$ktp."%')";
		}
		if($telepon != null && trim($telepon)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(phone_number) like upper('%".$telepon."%')";
		}
		if($alamat != null && trim($alamat)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(address) like upper('%".$alamat."%')";
		}
		if($nama != null && trim($nama)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(name) like upper('%".$nama."%')";
		}
		if($jk != null && trim($jk)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" A.option_code='".$jk."'";
		}
		if($startDate != null & trim($startDate)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$dateStart=new DateTime($startDate);
			$criteria.=" birth_date>='".$dateStart->format('Y-m-d')."' ";
		}
		if($endDate != null && trim($endDate)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$dateEnd=new DateTime($endDate);
			$criteria.=" birth_place<='".$dateEnd->format('Y-m-d')."' ";
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
			case "f2":
				$orderBy.='name '.$direction;
				break;
			case "f3":
				$orderBy.='A.option_name '.$direction;
				break;
			case "f4":
				$orderBy.='birth_date '.$direction;
				break;
			case "f5":
				$orderBy.='address '.$direction;
				break;
			default:
				$orderBy.='patient_code '.$direction;
				break;
		}
		$total=$common->queryRow("SELECT count(patient_id) AS total FROM ".$entity." M  ".$inner." ".$criteria);
		$res=$common->queryResult("SELECT patient_id,patient_code,A.option_name AS gender,birth_date,name,address,phone_number,no_ktp 
				FROM ".$entity." M ".$inner." ".$criteria." ".$orderBy.' LIMIT '.$size.' OFFSET '.$first);
		$list=array();
		for($i=0,$iLen=count($res); $i<$iLen; $i++){
			$r=$res[$i];
			$o=array();
			$o['i']=$r->patient_id;
			$mr=$r->patient_code;
			if(is_numeric($mr)==true){
				$split=str_split(strval($mr),2);
				$mr='';
				for($j=0,$jLen=count($split); $j<$jLen ; $j++){
					if($mr!='')
						$mr.='-';
					$mr.=$split[$j];
				}
			}
			$o['f1']=$mr;
			$gender=$r->gender;
			if($gender != null)
				$o['f3']=$gender;
			else
				$o['f3']='';
			if($r->birth_date!= null){
				$birthDate=new DateTime($r->birth_date);
				$o['f4']=$birthDate->format('d M Y');
			}else
				$o['f4']='';
			$o['f2']='<a href="javascript:loadView(\'App.content.rs1.View\','.$r->patient_id.')">'.$r->name.'</a>';
			$o['f5']=$r->address;
			$o['f6']=$r->phone_number;
			$o['f7']=$r->no_ktp;
			$list[]=$o;
		}
		$result->setData($list)->setTotal($total->total)->end();
	}
}
