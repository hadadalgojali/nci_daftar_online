<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$common=$this->common;
	$pid=$this->input->get('i');
	$ori=$common->createQuery("SELECT M FROM ".$common->getModel('Visit')." M INNER JOIN M.rujukan A WHERE
			A.nomorRujukan='".$pid."'")->getSingleResult();
	$mod=array();
	
	$pasien=$ori->getPatient();
	$mod['d1']='<a href="'.base_url ().'puskesmas/lihatPasien?i='.$pasien->getId().'" >'.$pasien->getPatientCode().' - '.$pasien->getName().'</a>';
	$mod['d2']=$ori->getUnit()->getUnitName();
	$dokter=$ori->getDokter();
	$mod['d3']='<a href="' . base_url () . 'pelayanan/profileDokter?dokter_id=' . $dokter->getId () . '">' . $dokter->getFirstName () . " " . $dokter->getLastName () . '</a>';
	$rujukan=$ori->getRujukan();
	$mod['d4']=$rujukan->getPenjamin();
	$mod['d5']=$rujukan->getNomorBpjs();
	$mod['d6']=$rujukan->getPenyakit()->getPenyakit();
	$mod['d7']=$rujukan->getTindakan();
	$mod['d8']=$rujukan->getObat();
	$mod['d9']=$rujukan->getPenunjang();
	$mod['d10']=$rujukan->getCatatan();
	$status=$rujukan->getStatusVerifikasi();
	$mod['d11']=$status->getOptionName();
	$mod['d12']=$rujukan->getAlasanBlok();
	if($rujukan->getRujukBalik()==true){
		$mod['d13']=$rujukan->getDiagnosaRb()->getPenyakit();
		$mod['d14']=$rujukan->getTerapiRb();
		$mod['d15']=$rujukan->getObatRb();
		if($rujukan->getControlDateRb() != null){
			$mod['d16']=$rujukan->getControlDateRb()->format('d M Y');
		}else{
			$mod['d16']='Tidak Ada.';
		}
		$mod['d17']=$rujukan->getOtherRb();
		if($rujukan->getRwiRb()==true){
			$mod['d18']='Ya';
		}else{
			$mod['d18']='Tidak';
		}
		if($rujukan->getKonsultasiRb()==true){
			$mod['d19']='Ya';
		}else{
			$mod['d19']='Tidak';
		}
	}
?>
<br>
<div class="container">
<div class="row">
	<div class="col-md-3">
		<?php include('menu_main.php'); ?>
	</div>
	<div class="col-md-9">
		<div class="menu-left-head">
			<h5> <strong>Info</strong> Rujukan</h5>
			<div class="menu-left">
				<div class="menu-left-head sub" style="padding-left: 0px;">
					<strong>Rujukan</strong>
					<div class="menu-left" style="padding: 10px;">
						<div class="form-group row">
							<div class="col-md-3">
								<label>Nama Pasien</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d1']; ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Poliklinik</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d2'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Nama Dokter</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d3'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Penjamin</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d4'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>No. BPJS</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d5'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Diagnosa</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d6'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Tindakan yg dilakukan</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d7'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Obat yg diberikan</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d8'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Penunjang</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d9'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Catatan</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d10'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Status Verifikasi</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d11'] ?>
							</div>
						</div>
						<?php 
							if($status->getOptionCode()=='STATRUJ_BLOK'){
						?>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Alasan ditolak</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d12'] ?>
							</div>
						</div>
						<?php 					
							}
						?>
					</div>
					<a href="javascript:window.open('<?php echo base_url().'puskesmas/cetak?i='.$ori->getId();?>');" >Cetak Struk Rujukan</a>
					<?php 
						if($rujukan->getRujukBalik()==true){
					?>
					<strong>Rujukan Balik</strong>
					<div class="menu-left" style="padding: 10px;">
						<div class="form-group row">
							<div class="col-md-3">
								<label>Nama Pasien</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d13']; ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Terapi</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d14']; ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Obat</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d15']; ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Kontrol Kembali</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d16']; ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Lain-lain</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d17']; ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Perlu Rawat Inap ?</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d18']; ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Konsultasi Selesai ?</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['d19']; ?>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>	
	</div>
</div>
</div>