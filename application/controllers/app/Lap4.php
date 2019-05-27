<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Laporan Register
class Lap4 extends MY_controller {
	public $MA='Lap4';
	public $WM=true;
	public function getVar() {
		$common = $this->common;
		$data=array();
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
			$oList[]=$oM;
		}

		$oM         = array();
		$oM['id']   = 0;
		$oM['text'] = 'Semua';
		$oList[]=$oM;

		$data['l']=$oList;
		$this->jsonresult->setData($data)->end();
	}

	private function getAge($age){
		// "12/17/1983"
		$birthDate = date_format(date_create($age), 'm/d/Y');
		//explode the date to get month, day and year
		$birthDate = explode("/", $birthDate);
		//get age from date or birthdate
		$age       = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
		? ((date("Y") - $birthDate[2]) - 1)
		: (date("Y") - $birthDate[2]));
		return $age;
	}

	private function getIconRS(){
		return "<table style='font-size: 9;font-family: Arial, Helvetica, sans-serif;' cellspacing='0' border='0'>
   			<tr>
   				<td width='50'>
   					<img src='include/LOGO.png' width='50' height='50' />
   				</td>
   				<td>
   					<b>RSUD dr. Soedono Madiun</b><br>
			   		<font style='font-size: 8px;'>Jl. dr. Soetomo No. 59, Madiun</font><br>
			   		<font style='font-size: 8px;'>Telp : (0351) 464325</font>, 
			   		<font style='font-size: 8px;'>Fax : (0351) 458054</font>
   				</td>
   			</tr>
   		</table>";
	}
	


	public function toPDF(){
		$common = $this->common;
		$op=$common->getEmployee();
		$now=new DateTime();
		
		$start=new DateTime($this->get('f1'));
		$end=new DateTime($this->get('f2'));
		$klinik=$this->get('f3');
		$type=$this->get('f4');
		$namaKlinik='SEMUA';
		if(($klinik != null || $klinik != 'null' ) && $klinik != '' && strtolower($klinik) != 'semua' && (int)$klinik != 0){
			$klinik=$common->find('Unit',$klinik);
			$namaKlinik=$klinik->getUnitName();
		}else{
			$klinik=null;
		}
		$no=1;
		$html='';
		if($type =='A'){
			$html .= $this->getIconRS();
		}
		$html.='		<div class="header"><center>LAPORAN REGISTER</center></div>
				<table border="0">
					<tr>
						<td width="50">Periode</td>
						<td width="5">:</td>
						<td>'.$start->format('d M Y').' s/d '.$end->format('d M Y').'</td>	
					</tr>	
					<tr>
						<td width="50">Poliklinik</td>
						<td width="5">:</td>
						<td>'.$namaKlinik.'</td>	
					</tr>
				</table>
				<table border="1" cellspacing="0" cellpadding="3">
					<thead>
						<tr>
							<th rowspan="2">No</th>
							<th rowspan="2">Medrec</th>
							<th rowspan="2">Nama</th>
							<th rowspan="2">Alamat</th>
							<th colspan="2">Kelamin</th>
							<th rowspan="2">Umur</th>
							<th colspan="2">Kunjungan</th>
							<th colspan="3">Kelompok</th>
							<th rowspan="2">Hadir</th>
							<th rowspan="2">Kd Diagnosa</th>
							<th rowspan="2">Diagnosa</th>
						</tr>
						<tr>
							<th>L</th>
							<th>P</th>
							<th>Baru</th>
							<th>Lama</th>
							<th>Umum</th>
							<th>Asuransi</th>
							<th>Perusahaan</th>
						</tr>
					</thead>
					<tbody>
		';
		$q='';
		if($klinik != null){
			$q=' AND A.id='.$klinik->getId();
		}
		$res=$common->createQuery("SELECT M FROM ".$common->getModel('Visit')." M INNER JOIN 
				M.unit A WHERE
				M.entryDate>='".$start->format('Y-m-d')."' AND M.entryDate <='".$end->format('Y-m-d')."' ".$q."
				ORDER BY A.id ASC")->getResult();

		if($res){
			$tmp_array = array();
			foreach ($res as $key => $value) {
				array_push($tmp_array, $value->getUnit()->getUnitName());
			}
			$tmp_array = array_unique($tmp_array);
			$unitId=null;
			$jumlahPasien=0;
			$no=0;
			$l=0;
			$p=0;
			$baru=0;
			$lama=0;
			$ans=0;
			$prshn=0;
			$umum=0;
			$hadir=0;
			foreach ($tmp_array as $key_ => $value_) {
				$html.='
				<tr>
					<td align="left" colspan="15"><b>'.$value_.'</b></td>
				</tr>';
				$no = 1;

				$tmp_laki=0;
				$tmp_perempuan=0;
				$tmp_baru=0;
				$tmp_lama=0;
				$tmp_ans=0;
				$tmp_prshn=0;
				$tmp_umum=0;
				$tmp_hadir=0;
				foreach ($res as $key => $value) {
					if($value_ == $value->getUnit()->getUnitName()){
						
						$kontraktor=null;
						if($value->getCustomer() != null){
							$kontraktor=$common->find('Kontraktor',$value->getCustomer()->getId());
						}

						$jnsCus=null;
						if($kontraktor!= null){
							$jnsCus=$kontraktor->getJenisCust()->getOptionCode();
						}
						

						if($jnsCus=='CUSTOMER_ANS'){
							$ans+=1;
						}else if($jnsCus=='CUSTOMER_ORG'){
							$umum+=1;
						}else{
							$prshn+=1;
						}

						$html.='
						<tr>
							<td align="center">'.$no.'</td>
							<td align="left">'.$value->getPatient()->getPatientCode().'</td>
							<td align="left">'.$value->getPatient()->getName().'</td>
							<td align="left">'.$value->getPatient()->getAddress().'</td>
						';
						if ($value->getPatient()->getGender() == 'f' || $value->getPatient()->getGender() === false) {
							$html .= '
								<td align="center"></td>
								<td align="center">X</td>
							';
							$tmp_perempuan++;
						}else{
							$html .= '
								<td align="center">X</td>
								<td align="center"></td>
							';
							$tmp_laki++;
						}
						$html.='<td align="center">'.$this->getAge($value->getPatient()->getBirthDate()->format('Y-m-d')).'</td>';

						if ($value->getBaru() == '0' || $value->getBaru() == 0) {
							$html .= '
								<td align="center"></td>
								<td align="center">X</td>
							';
							$tmp_lama++;
						}else{
							$html .= '
								<td align="center">X</td>
								<td align="center"></td>
							';
							$tmp_baru++; 
						}

						if ($jnsCus=='CUSTOMER_ANS') {
							$html .= '
								<td align="center"></td>
								<td align="center">X</td>
								<td align="center"></td>
							';
							$tmp_ans++;
						}else if($jnsCus=='CUSTOMER_ORG'){
							$html .= '
								<td align="center">X</td>
								<td align="center"></td>
								<td align="center"></td>
							';
							$tmp_umum++;
						}else{
							$html .= '
								<td align="center"></td>
								<td align="center"></td>
								<td align="center">X</td>
							';
							$tmp_prshn++;
						}

						if ($value->getHadir() == 1 || $value->getHadir() == '1') {
							$html .= '
								<td align="center">X</td>
							';
							$tmp_hadir++;
						}else{
							$html .= '
								<td align="center"></td>
							';
						}

						// $html.='
						// 	<td align="left">'.$value->getkdDiagnosa().'</td>
						// 	<td align="left">'.$value->getDiagnosa().'</td>
						// 	<td align="center">'.$value->getkd_dpjp().'</td>
						// </tr>';
						$html.='
							<td align="left">'.$value->getkdDiagnosa().'</td>
							<td align="left">'.$value->getDiagnosa().'</td>
							
						</tr>';
						$no++;
					}
				}
				$html.='
				<tr>
					<td align="center"></td>
					<td align="right" colspan="3"><b>Subtotal</b></td>
					<td align="center"><b>'.$tmp_laki.'</b></td>
					<td align="center"><b>'.$tmp_perempuan.'</b></td>
					<td align="center"><b></b></td>
					<td align="center"><b>'.$tmp_baru.'</b></td>
					<td align="center"><b>'.$tmp_lama.'</b></td>
					<td align="center"><b>'.$tmp_umum.'</b></td>
					<td align="center"><b>'.$tmp_ans.'</b></td>
					<td align="center"><b>'.$tmp_prshn.'</b></td>
					<td align="center"><b>'.$tmp_hadir.'</b></td>
					<td align="center"></td>
					<td align="center"></td>
				</tr>';

				$l 		+=$tmp_laki;
				$p 		+=$tmp_perempuan;
				$baru 	+=$tmp_baru;
				$lama 	+=$tmp_lama;
				$ans 	+=$tmp_ans;
				$prshn 	+=$tmp_prshn;
				$umum 	+=$tmp_umum;
				$hadir 	+=$tmp_hadir;
			}
			$html.='
			<tr>
				<td align="center"></td>
				<td align="right" colspan="3"><b>Grand total</b></td>
				<td align="center"><b>'.$l.'</b></td>
				<td align="center"><b>'.$p.'</b></td>
				<td align="center"><b></b></td>
				<td align="center"><b>'.$baru.'</b></td>
				<td align="center"><b>'.$lama.'</b></td>
				<td align="center"><b>'.$umum.'</b></td>
				<td align="center"><b>'.$ans.'</b></td>
				<td align="center"><b>'.$prshn.'</b></td>
				<td align="center"><b>'.$hadir.'</b></td>
				<td align="center"></td>
				<td align="center"></td>
			</tr>';
			$html.='
			<tr>
				<td align="center"></td>
				<td align="right" colspan="3"><b>Total Kunjungan</b></td>
				<td align="left" colspan="11"><b>'.((int)$l+(int)$p).'</b></td>
			</tr>';
			/*for($i=0,$iLen=count($res); $i<$iLen; $i++){
				$r=$res[$i];
				$unit=$r->getUnit();
				$patient=$r->getPatient();
				$kontraktor=null;
				if($r->getCustomer() != null){
					$kontraktor=$common->find('Kontraktor',$r->getCustomer()->getId());
				// var_dump($r->getCustomer())."<br>";
				// var_dump($common->find('Kontraktor',$r->getCustomer()->getId()))."<br>";
				// echo $r->getCustomer()->getId();die;
				}

				if($unitId != $unit->getId()){
					$jumlahPasien=0;
					$l=0;
					$p=0;
					$baru=0;
					$lama=0;
					$ans=0;
					$prshn=0;
					$umum=0;
					$unitId=$unit->getId();
				}
				$jumlahPasien+=1;
				if($patient->getGender()->getOptionCode()=='GENDER_L'){
					$l+=1;
				}else{
					$p+=1;
				}
				if($r->getBaru()==true){
					$baru+=1;
				}else{
					$lama+=1;
				}
				$jnsCus=null;
				if($kontraktor!= null){
					$jnsCus=$kontraktor->getJenisCust()->getOptionCode();
				}
				
				if($jnsCus=='CUSTOMER_ANS'){
					$ans+=1;
				}else if($jnsCus=='CUSTOMER_ORG'){
					$umum+=1;
				}else{
					$prshn+=1;
				}
				// if(($unitId != $unit->getId() || $i==($iLen-1)) && $i != 0 || ($i == 0 && $iLen==1)){
					$no++;
					$html.='
					<tr>
						<td align="center">'.$no.'</td>
						<td align="left"></td>
						<td align="left"></td>
						<td align="left"></td>
						<td align="left"></td>
						<td align="left"></td>
						<td align="left"></td>
						<td align="left"></td>
						<td align="left"></td>
						<td align="left"></td>
						<td align="left"></td>
						<td align="left"></td>
						<td align="left"></td>
					</tr>';
				// }
			}*/
		}else{
			$html.='
				<tr>
					<td colspan="10" align="center">Data Tidak Ada</td>
				</tr>';
		}
		$html.='
			</tbody>
		</table>
		';
		if($type=='A'){
			// echo $html;
			pdf(array('html'=>$html,'margin-top'=>100,'margin-bottom'=>50, 'type' => 'landscape'));
		}else if($type=='B'){
			$common->excel($html,'REGISTER.xls');
		}else{
			$common->word($html,'REGISTER.doc');
		}
	}
}
