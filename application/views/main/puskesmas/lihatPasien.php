<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$common=$this->common;
	$ori=$common->find('Patient',$this->input->get('i'));
	$mod=array();
	$mod['f1']=$ori->getPatientCode();
	$mod['f2']=$ori->getTitle();
	$mod['f3']=$ori->getName();
	$mod['f4']=$ori->getBirthPlace();
	$mod['f5']=$ori->getBirthDate()->format('d M Y');
	$mod['f6']=$ori->getGender()->getOptionName();
	$mod['f7']=$ori->getReligion()->getOptionName();
	$mod['f8']=$ori->getEdu()->getOptionName();
	$mod['f9']=$ori->getBlod()->getOptionName();
	$mod['f10']=$ori->getAddress();
	$mod['f11']=$ori->getPostalCode();
	$mod['f19']=$ori->getKtp();
	$mod['f12']=$ori->getPhoneNumber();
	$mod['f13']=$ori->getRt().'/'.$ori->getRw();
	$country=$ori->getCountry();
	if($country->getId()!= 0){
		$mod['f14']=$country->getValue();
	}else{
		$countryTemp=$ori->getCountryTemp();
		if($countryTemp != null)
			$mod['f14']=$countryTemp->getValue();
		else
			$mod['f14']='';
	}
	$province=$ori->getProvince();
	if($province->getId() != 0){
		$mod['f15']=$province->getValue();
	}else{
		$provinceTemp=$ori->getProvinceTemp();
		if($provinceTemp != null)
			$mod['f15']=$provinceTemp->getValue();
		else
			$mod['f15']='';
	}
	$district=$ori->getDistrict();
	if($district->getId()!= 0){
		$mod['f16']=$district->getValue();
	}else{
		$districtTemp=$ori->getDistrictTemp();
		if($districtTemp != null)
			$mod['f16']=$districtTemp->getValue();
		else
			$mod['f16']='';
	}
	$districts=$ori->getDistricts();
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
	$kelurahan=$ori->getKelurahan();
	if($kelurahan->getId() != 0){
		$mod['f18']=$kelurahan->getValue();
	}else{
		$kelurahanTemp=$ori->getKelurahanTemp();
		if($kelurahanTemp != null)
			$mod['f18']=$kelurahanTemp->getValue();
		else
			$mod['f18']='';
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
			<h5> <strong><?php echo $mod['f3'] ?></h5>
			<div class="menu-left">
				<div class="menu-left-head sub" style="padding-left: 0px;">
					<strong>Profile</strong>
					<div class="menu-left" style="padding: 10px;">
						<div class="form-group row">
							<div class="col-md-3">
								<label>No. Medrec</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f1'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>No. Identitas</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f19'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Nama Pasien</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f3'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Tempat/Tgl Lahir</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f4'] ?>, <?php echo $mod['f5'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Jenis Kelamin</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f6'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Agama</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f7'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Pend. Terakhir</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f8'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Gol. Darah</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f9'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Telepon</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f12'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Alamat</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f10'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>RT/RW</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f13'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Negara</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f14'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Provinsi</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f15'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Kota</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f16'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Kecamatan</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f17'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Kelurahan</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f18'] ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Kode Pos</label>
							</div>
							<div class="col-md-8" style="font-weight: normal;">
								: <?php echo $mod['f11'] ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
</div>