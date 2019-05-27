<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Rujukan
class RS3 extends MY_controller {
	public $MA='RS3';
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end ();
	}
	public function saveVerifikasi(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pid=$this->post('i');
		
		$status=$common->find('ParameterOption',$this->post('f1'));
		$alasan=$this->post('f2');
		
		$visit=$common->find('Visit',$pid);
		if($visit != null){
			$rujukan=$visit->getRujukan();
			$rujukan->setStatusVerifikasi($status)
				->setAlasanBlok($alasan)
				->update();
			$result->setMessage('Data Verifikasi Rujukan Telah Tersimpan.')->end();
		}else
			$result->error()->setMessageNotExist()->end();
	}
	public function initVerifikasi(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pid=$this->get('i');
		$ori=$common->find('Visit',$pid);
		if($ori != null){
			$data=array();
			$data['l']=$common->getParams('STATUS_RUJUKAN');
			$mod=array();
			$patient=$ori->getPatient();
			$mod['d1']='<a href="javascript:loadView(\'App.content.rs1.View\','.$patient->getId().')">'.$patient->getName().'</a>';
			$mod['d2']=$ori->getUnit()->getUnitName();
			$dokter=$ori->getDokter();
			$mod['d3']='<a href="javascript:loadView(\'App.system.a5.View\','.$dokter->getId().')">'.$dokter->getFirstName().' '.$dokter->getLastName().'</a>';
			$rujukan=$ori->getRujukan();
			$mod['d4']=$rujukan->getPenjamin();
			$mod['d5']=$rujukan->getNomorBpjs();
			$mod['d6']=$rujukan->getPenyakit()->getPenyakit();
			$mod['d7']=$rujukan->getTindakan();
			$mod['d8']=$rujukan->getObat();
			$mod['d9']=$rujukan->getPenunjang();
			$mod['d10']=$rujukan->getCatatan();
			$data['o']=$mod;
			$result->setData($data)->end();
		}else
			$result->error()->setMessageNotExist()->end();
	}
	public function initSearch(){
		$common = $this->common;
		$result = $this->jsonresult;
		$result->end();
	}
	public function initRujukBalik(){
		$common = $this->common;
		$result = $this->jsonresult;
		$result->end();
	}
	public function getDokter(){
		$em = $this->doctrine->em;
		$common=$this->common;
		$text=$this->input->get('query');
		$arr=array();
		$res=$common->createQuery("SELECT u.id,u.firstName,u.lastName FROM ".$common->getModel('Employee')." u INNER JOIN
			u.job A
			WHERE (UPPER(u.firstName) LIKE UPPER('%".$text."%') or UPPER(u.lastName) LIKE UPPER('%".$text."%') )
			AND A.jobCode='DOKTER'
	 		ORDER BY u.firstName ASC")
				 ->setMaxResults(10)
				 ->getResult();
		for($i=0,$iLen=count($res); $i<$iLen ; $i++){
			$r=$res[$i];
			$o=array();
			$o['id']=$r['id'];
			$o['text']=$r['firstName']." ".$r['lastName'];
			$arr[]=$o;
		}
		$this->jsonresult->setData($arr)->end();
	}
	public function getPenyakit(){
		$em = $this->doctrine->em;
		$common=$this->common;
		$text=$this->input->get('query');
		$arr=array();
		$res=$em->createQuery("SELECT u.kodePenyakit,u.penyakit FROM ".$common->getModel('Penyakit')." u
			WHERE UPPER(u.penyakit) LIKE UPPER('".$text."%') OR UPPER(u.kodePenyakit) LIKE UPPER('".$text."%')
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
	public function saveRujukanBalik(){
		$common = $this->common;
		$result = $this->jsonresult;
		$now=new DateTime();
		
		$noRujukan=$this->post('f1');
		$diagnosa=$this->post('f2');
		$terapi=$this->post('f3');
		$obat=$this->post('f4');
		$controlBack=$this->post('f5');
		if($controlBack != null && $controlBack != ''){
			$controlBack= new DateTime($controlBack);
		}else{
			$controlBack=null;
		}
		$other=$this->post('f6');
		$rwi=$this->post('f7');
		$selesai=$this->post('f8');
		$dokter=$common->find('Employee',$this->post('f9'));
		$rujukan=$common->find('Rujukan',$noRujukan);
		if($rujukan != null){
			$rujukan->setDiagnosaRb($common->find('Penyakit',$diagnosa))
				->setRujukBalik(true)
				->setTerapiRb($terapi)
				->setObatRb($obat)
				->setControlDateRb($controlBack)
				->setOtherRb($other)
				->setRwiRb($rwi)
				->setKonsultasiRb($selesai)
				->setTglRujukRb($now)
				->setDokterRb($dokter)
				->update();
			$result->setMessage("Rujukan Balik dengan Nomor Rujukan '".$noRujukan."' Telah Berhasil Tersimpan.")->end();
		}else{
			$result->error()->setMessageNotExist()->end();
		}
	}
	public function getList(){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$first=$this->get('page');
		$size=$this->get('pageSize');
		$direction=$this->get('d',false);
		$sorting=$this->get('s',false);
		
		$noRujukan=$this->get('f1',false);
		$faskes=$this->get('f2',false);
		$namaPasien=$this->get('f3',false);
		$faskesDokter=$this->get('f4',false);
		$startDate=$this->get('f5',false);
		$endDate=$this->get('f6',false);
		$diagnosa=$this->get('f7',false);
		
		$entity=$common->getModel('Visit');
		$criteria="";
		$inner='
				INNER JOIN M.patient A 
				
				INNER JOIN M.rujukan F
				INNER JOIN F.faskes G
				INNER JOIN F.penyakit I';
		if($noRujukan != null && trim($noRujukan)!=''){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
			$criteria.=" upper(F.nomorRujukan) like upper('%".$noRujukan."%')";
		}
		if($faskes != null && trim($faskes)!=''){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
			$criteria.=" (upper(G.faskesCode) like upper('%".$faskes."%') OR upper(G.faskesName) like upper('%".$faskes."%'))";
		}
		if($namaPasien != null && trim($namaPasien)!=''){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
			$criteria.=" upper(A.name) like upper('%".$namaPasien."%') ";
		}
		if($faskesDokter != null && trim($faskesDokter)!=''){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
			$criteria.=" upper(M.faskesDokter) like upper('%".$faskesDokter."%') ";
		}
		if($diagnosa != null && trim($diagnosa)!=''){
			if($criteria==''){
				$criteria.=" WHERE ";
			}else{
				$criteria.=" AND ";
			}
			$criteria.=" upper(I.penyakit) like upper('%".$diagnosa."%')";
		}
		
		$now=new DateTime();
		if($criteria=='')
			$criteria.=" WHERE ";
		else
			$criteria.=" AND ";
		if($startDate != null && trim($startDate)!=''){
			$dateStart=new DateTime($startDate);
			$criteria.=" M.entryDate>='".$dateStart->format('Y-m-d')."' ";
		}else{
			$criteria.=" M.entryDate>='".$now->format('Y-m-d')."' ";
		}
		if($criteria=='')
			$criteria.=" WHERE ";
		else
			$criteria.=" AND ";
		if($endDate != null && trim($endDate)!=''){
			$dateEnd=new DateTime($endDate);
			$criteria.=" M.entryDate<='".$dateEnd->format('Y-m-d')."' ";
		}else{
			$criteria.=" M.entryDate<='".$now->format('Y-m-d')."' ";
		}
		
		if($criteria=='')
			$criteria.=" WHERE ";
		else
			$criteria.=" AND ";
		$criteria.=" F.rujukBalik=false ";
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
			case "f1":
				$orderBy.='F.nomorRujukan '.$direction;
				break;
			case "f2":
				$orderBy.='G.faskesCode '.$direction;
				break;
			case "f3":
				$orderBy.='A.name '.$direction;
				break;
			case "f5":
				$orderBy.='M.entryDate '.$direction;
				break;
			case "f6":
				$orderBy.='I.penyakit '.$direction;
				break;
			default:
				$orderBy.='F.nomorRujukan DESC';
				break;
		}
		
		$total=$common->createQuery("SELECT count(M) AS total FROM ".$entity." M  ".$inner." ".$criteria)->getSingleResult();
		$res=$common->createQuery("SELECT M FROM ".$entity." M ".$inner." ".$criteria." ".$orderBy)
			->setFirstResult($first)
			->setMaxResults($size)
			->getResult();
		$list=array();
		
		for($i=0; $i<count($res); $i++){
			$r=$res[$i];
			$rujukan=$r->getRujukan();
			$o=array();
			$o['i']=$r->getId();
			$o['f1']=$rujukan->getNomorRujukan();
			$o['f2']=$rujukan->getFaskes()->getFaskesCode().' - '.$rujukan->getFaskes()->getFaskesName();
			$patient=$r->getPatient();
			$o['f3']='<a href="javascript:loadView(\'App.content.rs1.View\','.$patient->getId().')">'.$patient->getName().'</a>';
			$status=$rujukan->getStatusVerifikasi();
			$o['f4']=$status->getOptionName();
			$o['f5']=$rujukan->getTanggalRujuk()->format('d M Y');
			$o['f6']=$rujukan->getPenyakit()->getPenyakit();
			$dokter=$r->getDokter();
			$o['f7']=$dokter->getId();
			$o['f8']='<a href="javascript:loadView(\'App.system.a5.View\','.$dokter->getId().')">'.$dokter->getFirstName().' '.$dokter->getLastName().'</a>';
			$o['f9']=$status->getOptionCode();
			$o['f10']=$r->getPbi();
			$status->getOptionCode();
			$list[]=$o;
		}
		$result->setData($list)
			->setTotal($total['total'])
			->end();
	}
}
