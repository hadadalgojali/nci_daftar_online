<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Laporan Register
class Lap1 extends MY_controller {
	public $MA='Lap1';
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
			/*$html='
				<div style="position:fixed;top: 0px; left: 0px; right: 0px;">
					<img src="include/header3.PNG" style="width: 100%;">
				</div>
				<div style="background:#f0ad4e;height: 30px;border: 1px solid #eea236;position:fixed;bottom: 0px; left: 0px; right: 0px;">
					<div style="font-size:8px;padding-left: 10px;margin-right: 10px;margin-top: 5px;color:white;text-shadow: 2px 2px 2px #398439;">
						Operator : '.$op->getFirstName().' '.$op->getLastName().', Tgl/Jam : '.$now->format('d M Y h:i:s').'
					</div>
				</div>';*/
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
				<table border="1" cellspacing="0.1">
					<thead>
						<tr>
							<th width="20" rowspan="2">No.</th>
							<th rowspan="2">Nama Unit</th>
							<th width="50" rowspan="2">Jumlah Pasien</th>
							<th colspan="2">Jenis Kelamin</th>
							<th colspan="2">Kunjungan</th>
							<th width="60" rowspan="2">Perusahaan</th>
							<th width="60" rowspan="2">Asuransi</th>
							<th width="60" rowspan="2">Umum</th>
						</tr>
						<tr>
							<th width="30">L</th>
							<th width="30">P</th>
							<th width="30">Baru</th>
							<th width="30">Lama</th>
						</tr>
					</thead>
					<tbody>
		';
		$q='';
		if($klinik != null){
			$q=' AND ru.unit_id ='.$klinik->getId();
		}

		// $res=$common->createQuery("SELECT M FROM ".$common->getModel('Visit')." M INNER JOIN 
		// 		M.unit A WHERE
		// 		M.entryDate>='".$start->format('Y-m-d')."' AND M.entryDate <='".$end->format('Y-m-d')."' ".$q."
		// 		ORDER BY A.id ASC")->getResult();
		$res = $this->db->query(
			"SELECT 
				ru.unit_name, 
				count(rv.no_pendaftaran) jumlah_pasien,  
				SUM(CASE WHEN rp.gender = 't' THEN 1 ELSE 0 END) as laki,  
				SUM(CASE WHEN rp.gender = 'f' THEN 1 ELSE 0 END) as perempuan,
				SUM(CASE WHEN rv.baru = 1 THEN 1 ELSE 0 END) as baru,  
				SUM(CASE WHEN rv.baru = 0 THEN 1 ELSE 0 END) as lama,  
				SUM(CASE WHEN rk.jenis_cust ='CUSTOMER_ORG'  THEN 1 ELSE 0 END) as umum,  
				SUM(CASE WHEN rk.jenis_cust = 'CUSTOMER_ANS' THEN 1 ELSE 0 END) as asuransi,  
				SUM(CASE WHEN rk.jenis_cust = 'CUSTOMER_PRSHN' THEN 1 ELSE 0 END) as perusahaan
			FROM 
				rs_visit rv
				INNER JOIN rs_patient rp ON rv.patient_id = rp.patient_id
				INNER JOIN rs_kontraktor rk ON rk.customer_id = rv.customer_id
				INNER JOIN rs_unit ru ON ru.unit_id = rv.unit_id
			WHERE rv.entry_date between '".$start->format('Y-m-d')."' AND '".$end->format('Y-m-d')."' ".$q."
			GROUP BY ru.unit_name;"
		);
		if($res->num_rows()){
			$unitId=null;
			$jumlahPasien=0;
			$l=0;
			$p=0;
			$no=0;
			$baru=0;
			$lama=0;
			$ans=0;
			$prshn=0;
			$umum=0;
			foreach ($res->result() as $value) {
				$no++;
				$html.='
				<tr>
					<td align="center">'.$no.'</td>
					<td>'.$value->unit_name.'</td>
					<td align="right">'.$value->jumlah_pasien.'</td>
					<td align="right">'.$value->laki.'</td>
					<td align="right">'.$value->perempuan.'</td>
					<td align="right">'.$value->baru.'</td>
					<td align="right">'.$value->lama.'</td>
					<td align="right">'.$value->perusahaan.'</td>
					<td align="right">'.$value->asuransi.'</td>
					<td align="right">'.$value->umum.'</td>
				</tr>';

				$jumlahPasien += (int)$value->jumlah_pasien;
				$l            += (int)$value->laki;
				$p            += (int)$value->perempuan;
				$baru         += (int)$value->baru;
				$lama         += (int)$value->lama;
				$ans          += (int)$value->asuransi;
				$prshn        += (int)$value->perusahaan;
				$umum         += (int)$value->umum;
			}
			$html.='
			<tr>
				<td align="center"></td>
				<td align="right"><b>Grand Total</b></td>
				<td align="right"><b>'.$jumlahPasien.'</b></td>
				<td align="right"><b>'.$l.'</b></td>
				<td align="right"><b>'.$p.'</b></td>
				<td align="right"><b>'.$baru.'</b></td>
				<td align="right"><b>'.$lama.'</b></td>
				<td align="right"><b>'.$prshn.'</b></td>
				<td align="right"><b>'.$ans.'</b></td>
				<td align="right"><b>'.$umum.'</b></td>
			</tr>';
			/*for($i=0,$iLen=count($res); $i<$iLen; $i++){
				$r=$res[$i];
				$unit=$r->getUnit();
				$patient=$r->getPatient();
				$kontraktor=null;
				if($r->getCustomer() != null){
					$kontraktor=$common->find('Kontraktor',$r->getCustomer()->getId());
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
				if($r->getCustomer() == '0000000001'){
					$umum+=1;
				}else if($r->getCustomer() == '0000000044' || $r->getCustomer() == '0000000043'){
					$ans+=1;
				}else{
					$prshn+=1;
				}
				if(($unitId != $unit->getId() || $i==($iLen-1)) && $i != 0 || ($i == 0 && $iLen==1)){
					$no++;
					$html.='
					<tr>
						<td align="center">'.$no.'</td>
						<td>'.$unit->getUnitName().'</td>
						<td align="right">'.$jumlahPasien.'</td>
						<td align="right">'.$l.'</td>
						<td align="right">'.$p.'</td>
						<td align="right">'.$baru.'</td>
						<td align="right">'.$lama.'</td>
						<td align="right">'.$prshn.'</td>
						<td align="right">'.$ans.'</td>
						<td align="right">'.$umum.'</td>
					</tr>';
				}
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
			pdf(array('html'=>$html,'margin-top'=>100,'margin-bottom'=>50));
		}else if($type=='B'){
			$common->excel($html,'REGISTER.xls');
		}else{
			$common->word($html,'REGISTER.doc');
		}
	}
}
