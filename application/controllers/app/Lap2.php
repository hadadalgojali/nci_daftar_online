<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Laporan Index Perdaerah
class Lap2 extends MY_controller {
	public $MA='Lap2';
	public $WM=true;
	public function getVar() {
		$common = $this->common;
		$data=array();
		$data['l']=$common->getParams('WILAYAH');;
		$this->jsonresult->setData($data)->end();
	}
	public function toPDF(){
		$common = $this->common;
		$op=$common->getEmployee();
		$now=new DateTime();
		$type=$this->get('f3');
		$periode=new DateTime($this->get('f1'));
		$daerah=$this->get('f2');
		$no=1;
		$html='';
		if($type =='A'){
			$html='
				<div style="position:fixed;top: 0px; left: 0px; right: 0px;">
					<img src="include/header3.PNG" style="width: 100%;">
				</div>
				<div style="background:#f0ad4e;height: 30px;border: 1px solid #eea236;position:fixed;bottom: 0px; left: 0px; right: 0px;">
					<div style="font-size:8px;padding-left: 10px;margin-right: 10px;margin-top: 5px;color:white;text-shadow: 2px 2px 2px #398439;">
						Operator : '.$op->getFirstName().' '.$op->getLastName().', Tgl/Jam : '.$now->format('d M Y h:i:s').'
					</div>
				</div>';
		}
		
		$html.='<div class="header"><center>LAPORAN INDEX PERDAERAH</center></div>
				<table border="0">
					<tr>
						<td width="50">Periode</td>
						<td width="5">:</td>
						<td>'.$periode->format('M Y').'</td>	
					</tr>	
				</table>
				<table border="1" cellspacing="0.1">
					<thead>
						<tr>
							<th width="20" rowspan="2">No.</th>
							<th rowspan="2">Nama Daerah</th>
							<th colspan="2">Pasien Lama</th>
							<th colspan="2">Pasien Baru</th>
							<th colspan="2">Jumlah</th>
							<th width="50" rowspan="2">Total</th>
						</tr>
						<tr>
							<th width="30">L</th>
							<th width="30">P</th>
							<th width="30">L</th>
							<th width="30">P</th>
							<th width="30">L</th>
							<th width="30">P</th>
						</tr>
					</thead>
					<tbody>
		';
		$res=$common->createQuery("SELECT M FROM ".$common->getModel('Visit')." M WHERE
				M.entryDate>='".$periode->format('Y-m-')."1' AND M.entryDate <='".$periode->format('Y-m-')."31'
				")->getResult();
		if($res){
			$arr=array();
			$f2=0;
			$f3=0;
			$f4=0;
			$f5=0;
			$f6=0;
			$f7=0;
			$f8=0;
			for($i=0,$iLen=count($res); $i<$iLen; $i++){
				$r=$res[$i];
				$daerahId=null;
				$daerahName=null;
				$patient=$r->getPatient();
				if($daerah=='WILAYAH_PROV'){
					$province=$patient->getProvince();
					$daerahId=$province->getId();
					$daerahName=$province->getValue();
				}else if($daerah=='WILAYAH_KOTA'){
					$district=$patient->getDistrict();
					$daerahId=$district->getId();
					$daerahName=$district->getValue();
				}else if($daerah=='WILAYAH_KEC'){
					$districts=$patient->getDistricts();
					$daerahId=$districts->getId();
					$daerahName=$districts->getValue();
				}else{
					$kelurahan=$patient->getKelurahan();
					$daerahId=$kelurahan->getId();
					$daerahName=$kelurahan->getValue();
				}
				
				if(!isset($arr[$daerahId])){
					$o=array();
					$o['f1']=$daerahName;
					$o['f2']=0;
					$o['f3']=0;
					$o['f4']=0;
					$o['f5']=0;
					$o['f6']=0;
					$o['f7']=0;
					$o['f8']=0;
					$arr[$daerahId]=$o;
				}
				$gender=$patient->getGender()->getOptionCode();
				if($r->getBaru()==false){
					if($gender=='GENDER_L'){
						$arr[$daerahId]['f2']+=1;
						$f2+=1;
						$f6+=1;
						$f8+=1;
						$arr[$daerahId]['f6']+=1;
						$arr[$daerahId]['f8']+=1;
					}else{
						$arr[$daerahId]['f3']+=1;
						$f3+=1;
						$f7+=1;
						$f8+=1;
						$arr[$daerahId]['f7']+=1;
						$arr[$daerahId]['f8']+=1;
					}
				}else{
					if($gender=='GENDER_L'){
						$arr[$daerahId]['f4']+=1;
						$f4+=1;
						$f6+=1;
						$f8+=1;
						$arr[$daerahId]['f6']+=1;
						$arr[$daerahId]['f8']+=1;
					}else{
						$arr[$daerahId]['f5']+=1;
						$f5+=1;
						$f7+=1;
						$f8+=1;
						$arr[$daerahId]['f7']+=1;
						$arr[$daerahId]['f8']+=1;
					}
				}
			}
			foreach ($arr as $key=>$value){
				$html.='
				<tr>
					<td align="center">'.$no.'</td>
					<td>'.$arr[$key]['f1'].'</td>
					<td align="right">'.$arr[$key]['f2'].'</td>
					<td align="right">'.$arr[$key]['f3'].'</td>
					<td align="right">'.$arr[$key]['f4'].'</td>
					<td align="right">'.$arr[$key]['f5'].'</td>
					<td align="right">'.$arr[$key]['f6'].'</td>
					<td align="right">'.$arr[$key]['f7'].'</td>
					<td align="right">'.$arr[$key]['f8'].'</td>
				</tr>';
				$no++;
			}
			$html.='
				<tr>
					<th align="right" colspan="2">Total</th>
					<td align="right">'.$f2.'</td>
					<td align="right">'.$f3.'</td>
					<td align="right">'.$f4.'</td>
					<td align="right">'.$f5.'</td>
					<td align="right">'.$f6.'</td>
					<td align="right">'.$f7.'</td>
					<td align="right">'.$f8.'</td>
				</tr>';
			$no++;
		}else{
			$html.='
				<tr>
					<td colspan="9" align="center">Data Tidak Ada</td>
				</tr>';
		}
		$html.='
			</tbody>
		</table>
		';
		if($type=='A'){
			pdf(array('html'=>$html,'margin-top'=>100,'margin-bottom'=>50));
		}else if($type=='B'){
			$common->excel($html,'REGISTER.xls');
		}else{
			$common->word($html,'REGISTER.doc');
		}
	}
}
