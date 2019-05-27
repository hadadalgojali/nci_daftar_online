<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Laporan Perbandingan Perndaftaran
class Lap3 extends MY_controller {
	public $MA='Lap3';
	public $WM=true;
	public function getVar() {
		$this->jsonresult->end();
	}
	public function getPerbandingan(){
		$common = $this->common;
		$result = $this->jsonresult;
		$start=new DateTime($this->get('f1'));
		$end=new DateTime($this->get('f2'));
		$arr=array();
		$data=array();
		$data['f1']='Online';
		$res=$common->createQuery("SELECT count(M) AS jumlah FROM ".$common->getModel('Visit')." M INNER JOIN
			M.jenisDaftar A WHERE
			M.entryDate>='".$start->format('Y-m-d')."' AND M.entryDate <='".$end->format('Y-m-d')."' AND
			A.optionCode='JNSDFTR_ONLINE'
			");
		if($res->getResult()){
			$o=$res->getSingleResult();
			$data['f2']=$o['jumlah'];
		}else{
			$data['f2']=0;
		}
		$arr[]=$data;
		$data=array();
		$data['f1']='Offline';
		$res=$common->createQuery("SELECT count(M) AS jumlah FROM ".$common->getModel('Visit')." M INNER JOIN
			M.jenisDaftar A WHERE
			M.entryDate>='".$start->format('Y-m-d')."' AND M.entryDate <='".$end->format('Y-m-d')."' AND
			A.optionCode='JNSDFTR_OFFLINE'
			");
		if($res->getResult()){
			$o=$res->getSingleResult();
			$data['f2']=$o['jumlah'];
		}else{
			$data['f2']=0;
		}
		$arr[]=$data;
		$data=array();
		$data['f1']='Rujukan';
		$res=$common->createQuery("SELECT count(M) AS jumlah FROM ".$common->getModel('Visit')." M INNER JOIN
			M.jenisDaftar A WHERE
			M.entryDate>='".$start->format('Y-m-d')."' AND M.entryDate <='".$end->format('Y-m-d')."' AND
			A.optionCode='JNSDFTR_RUJUKAN'
			");
		if($res->getResult()){
			$o=$res->getSingleResult();
			$data['f2']=$o['jumlah'];
		}else{
			$data['f2']=0;
		}
		$arr[]=$data;
		
		
		$res=$common->createQuery("SELECT count(M) AS jumlah FROM ".$common->getModel('Visit')." M WHERE
			M.entryDate>='".$start->format('Y-m-d')."' AND M.entryDate <='".$end->format('Y-m-d')."'
		");
		if($res->getResult()){
			$o=$res->getSingleResult();
			$jumlah=$o['jumlah'];
			for($i=0,$iLen=count($arr) ; $i<$iLen; $i++){
				if($arr[$i]['f2'] != 0){
					$arr[$i]['f3']=floor($arr[$i]['f2']*100/$jumlah);
					$arr[$i]['f1'].=' ( '.$arr[$i]['f2'].' ) ';
				}else{
					$arr[$i]['f3']=0;
					$arr[$i]['f1'].=' ( '.$arr[$i]['f2'].' ) ';
				}
			}
		}
		
		$result->setData($arr)->end();
	}
	public function toPDF(){
		$common = $this->common;
		$op=$common->getEmployee();
		$now=new DateTime();
		
		$start=new DateTime($this->get('f1'));
		$end=new DateTime($this->get('f2'));
		$klinik=$this->get('f3');
		$namaKlinik='SEMUA';
		if($klinik != null && $klinik != '' && $klinik != 'null'){
			$klinik=$common->find('Unit',$klinik);
			$namaKlinik=$klinik->getUnitName();
		}else{
			$klinik=null;
		}
		$no=1;
		$html='
				<div style="position:fixed;top: 0px; left: 0px; right: 0px;">
					<img src="include/header3.PNG" style="width: 100%;">
				</div>
				<div style="background:#f0ad4e;height: 30px;border: 1px solid #eea236;position:fixed;bottom: 0px; left: 0px; right: 0px;">
					<div style="font-size:8px;padding-left: 10px;margin-right: 10px;margin-top: 5px;color:white;text-shadow: 2px 2px 2px #398439;">
						Operator : '.$op->getFirstName().' '.$op->getLastName().', Tgl/Jam : '.$now->format('d M Y h:i:s').'
					</div>
				</div>
				<div class="header"><center>LAPORAN REGISTER</center></div>
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
				<table border="1">
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
			$q=' AND A.id='.$klinik->getId();
		}
		$res=$common->createQuery("SELECT M FROM ".$common->getModel('Visit')." M INNER JOIN 
				M.unit A WHERE
				M.entryDate>='".$start->format('Y-m-d')."' AND M.entryDate <='".$end->format('Y-m-d')."' ".$q."
				ORDER BY A.id ASC")->getResult();
		if($res){
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
			for($i=0,$iLen=count($res); $i<$iLen; $i++){
				$r=$res[$i];
				$unit=$r->getUnit();
				$patient=$r->getPatient();
				$kontraktor=$common->find('Kontraktor',$r->getCustomer()->getId());
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
				$jnsCus=$kontraktor->getJenisCust()->getOptionCode();
				if($jnsCus=='CUSTOMER_ANS'){
					$ans+=1;
				}else if($jnsCus=='CUSTOMER_ORG'){
					$umum+=1;
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
			}
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
		pdf(array('html'=>$html,'margin-top'=>100,'margin-bottom'=>50));
	}
}
