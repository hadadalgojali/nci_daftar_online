<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function post($dat){
	if(isset($_POST[$dat])){
		return $_POST[$dat];
	}else{
		return '';
	}
}
?>
<br>
<link href="<?php echo base_url()?>vendor/bootstrap-datetimepicker-0.0.11/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<link href="<?php echo base_url()?>vendor/select2-3.5.4/select2.css" rel="stylesheet">
<script src="<?php echo base_url()?>vendor/bootstrap-datetimepicker-0.0.11/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url()?>vendor/select2-3.5.4/select2.min.js"></script>

<div class="container">
<div class="row">
	<div class="col-md-2">
		<?php include('menu.php'); ?>
	</div>
	<div class="col-md-10">
		
		<?php 
			if($this->session->get('ERROR') != null){
		?>
			<div class="alert alert-danger" role="alert" >
				<?php echo $this->session->get('ERROR'); ?>
			</div>
		<?php
				$this->session->delete('ERROR');
			}
		?>
		<?php 
			if($this->session->get('SUCCESS') != null){
		?>
			<div class="alert alert-success" role="alert" >
				<?php echo $this->session->get('SUCCESS'); ?>
			</div>
		<?php
				$this->session->delete('SUCCESS');
			}
		?>
		
		<div class="menu-left-head">
			<h5> <strong>Pasien</strong> Lama</h5>
			<div class="menu-left" style="padding: 0px !important;">
				
				<form id="form" class="form-signin" method="POST" autocomplete="off" action="<?php echo base_url()?>daftar/saveLama">
					<div style="margin: 15px;">
						<label>SYARAT DAN KETENTUAN PENDAFTARAN ONLINE :</label><br>
						1.Pendaftaran untuk pasien umum.<br>		 
						2.Pendaftaran online dilakukan paling lambat satu hari sebelum berkunjung ke rumah sakit atau (H-1).<br>
						3.Jam Batas Pendaftaran di mulai jam 07.00 WIB sampai 12.00 WIB.<br>
						4.Jam registrasi ulang dicantumkan di bukti registrasi ulang.<br>
						5.Membayar biaya pendaftaran di bank jatim (Berlokasi Di Rumah Sakit).<br>
					</div>
					<?php 
						$now=new DateTime();
						if($now->format('HH')<=7 || $now->format('HH')>=12)
						// {
							// echo '<br><center><label style="color:red;font-size:20px;"><blink>Pendaftaran di mulai jam 07.00 WIB sampai 12.00 WIB</blink></label></center>';

						// }else
						{
					?>
					<div class="menu-left-head sub">
						<strong>Data</strong> Pasien
						<div class="menu-left" style="padding: 10px;">
							<div class="row">
								<div class="col-md-6">
								<fieldset>
									<div class='form-group row'>
										<div class="col-md-4">
											<label for="tglReg">Tgl. Lahir:</label>
										</div>
										<div class="col-md-4">
											<div id="tgllahira" class="input-group date">
												<input type="text"  data-format="dd-MM-yyyy" class="form-control add-on " value="<?php echo post('tgllahir') ?>" id="tgllahir" name="tgllahir"  />
												<span class="add-on input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
											<script type="text/javascript">
											  $(function() {
												$('#tgllahira').datetimepicker({
												  language: 'pt-BR'
												}).on('changeDate', function(){
												       $('.bootstrap-datetimepicker-widget').hide();
												   });
											  });
											 </script>
										</div>
									</div>
									<div class="form-group row" style="display: none;">
										<div class="col-md-4">
											<label for="jk">Jenis Kelamin:</label>
										</div>
										<div class="col-md-8">
										<?php
											if(post('jk')!= null && post('jk')=='GENDER_P'){
										?>	
											<input type="radio" name="jk" value="GENDER_L" aria-label="..."> Laki-laki  <br>
											<input type="radio" name="jk" value="GENDER_P" aria-label="..."  checked> Perempuan 
										<?php
											}else{
										?>
											<input type="radio" name="jk" value="GENDER_L" aria-label="..."   checked> Laki-laki  <br>
											<input type="radio" name="jk" value="GENDER_P" aria-label="..."> Perempuan 
										<?php
											}
										?>
											
										</div>
									</div>
									
									<div class="form-group row" style="display: none;">
										<div class="col-md-4">
											<label for="nama">No. KTP:</label>
										</div>
										<div class="col-md-8">
											<input type="text" maxlength="16" class="form-control" id="ktp" value="<?php echo post('ktp') ?>" name="ktp" >
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-4">
											<label for="provinsi">No Medrec(Cari):</label>
										</div>
										<div class="col-md-8">
											<input type="hidden" id="rm" name="rm" value="<?php echo post('rm') ?>" style="width: 100%">
											<input type="hidden" id="hiddenRm" name="hiddenRm" value="<?php echo post('hiddenRm') ?>" >
											<script>
												$('#rm').select2({
													  ajax: {
														url: "<?php echo base_url()?>daftar/getPatientList",
														dataType: 'json',
														delay: 2000,
														data: function (params) {
															return {
																text: params,
																tgl_lahir:$('#tgllahir').val(),
																jk:$('input[name=jk]:checked').val(),
																telp:$('#telepon').val(),
																ktp:$('#ktp').val()
															};
														},
														processResults: function (data, page) {
															return {
																results: data.data
															};
														},
														cache: true
													}
												}).on("change", function (e) { 
													$('#hiddenRm').val(e.added.text); 
													$.ajax({
													   url: '<?php echo base_url()?>daftar/getPatient',
													   data: {
														  id: e.added.id
													   },
													   error: function() {
													   },
													   dataType: 'json',
													   success: function(data) {
														   var o=data.data;
														   $('#gelar').val(o.gelar);
														   $('#nama').val(o.nama);
														   $('#tampatLahir').val(o.tmpLahir);
														   $('#tgllahir').val(o.tglLahir);
														   $('#agama').val(o.religion);
														   $('#goldar').val(o.blod);
														   $('#education').val(o.edu);
														   $('#ktp').val(o.ktp);
														   $('#alamat').val(o.address);
														   $('#telepon').val(o.telepon);
														   $('#rt').val(o.rt);
														   $('#rw').val(o.rw);
														   $('#negara').select2('data', {id: o.countryId, text: o.countryName});
														   if(o.countryId ==0){
															   // $('#rowLainNegara').show();
															   $('#lainNegara').val(o.countryTemp);
														   }else{
															   $('#rowLainNegara').hide();
														   }
														   $('#provinsi').select2('data', {id: o.provinceId, text: o.provinceName});
														   if(o.provinceId ==0){
															   // $('#rowLainProvinsi').show();
															   $('#lainProvinsi').val(o.provinceTemp);
														   }else{
															   $('#rowLainProvinsi').hide();
														   }
														   $('#kota').select2('data', {id: o.districtId, text: o.districtName});
														   if(o.districtId ==0){
															   // $('#rowLainKota').show();
															   $('#lainKota').val(o.districtTemp);
														   }else{
															   $('#rowLainKota').hide();
														   }
														   $('#kecamatan').select2('data', {id: o.districtsId, text: o.districtsName});
														   if(o.districtsId ==0){
															   // $('#rowLainKecamatan').show();
															   $('#lainKecamatan').val(o.districtsTemp);
														   }else{
															   $('#rowLainKecamatan').hide();
														   }
														   $('#kelurahan').select2('data', {id: o.kelurahanId, text: o.kelurahanName});
														   if(o.kelurahanId ==0){
															   // $('#rowLainKelurahan').show();
															   $('#lainKelurahan').val(o.kelurahanTemp);
														   }else{
															   $('#rowLainKelurahan').hide();
														   }
														   $('#kdpos').val(o.postalCode);
													   },
													   type: 'GET'
													});
												});
												<?php
													if(post('rm') != null){
												?>
												$('#rm').select2('data', {id: '<?php echo post('rm') ?>', text: '<?php echo post('hiddenRm'); ?>'});
												<?php
													}
												?>
											</script>
										</div>
									</div>
								</fieldset>
									<div class="form-group row" style="display: none;">
										<div class="col-md-4">
											<label for="gelar">Gelar:</label>
										</div>
										<div class="col-md-4">
											<input type="text" maxlength="16" class="form-control" id="gelar" value="<?php echo post('gelar') ?>" name="gelar">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-4">
											<label for="nama">Nama Lengkap:</label>
										</div>
										<div class="col-md-8">
											<input type="text" readonly="true" maxlength="32" class="form-control" id="nama" value="<?php echo post('nama') ?>" name="nama" >
										</div>
									</div>
									<div class="form-group row" style="display: none;">
										<div class="col-md-4">
											<label for="tampatLahir">Tempat Lahir:</label>
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="tampatLahir" value="<?php echo post('tempatLahir') ?>" name="tempatLahir" >
										</div>
									</div>
									<div class="form-group row" style="display: none;">
										<div class="col-md-4">
											<label for="agama">Agama:</label>
										</div>
										<div class="col-md-4">
											<select id="agama" class="form-control" name="agama" >
												<option value="">Pilih</option>
												<?php
													for($i=0; $i<count($RELIGION) ; $i++){
														$param=$RELIGION[$i];
														if(post('agama')==$param['id']){
															echo '<option value="'.$param['id'].'" selected="selected">'.$param['text'].'</option>';
														}else{
															echo '<option value="'.$param['id'].'">'.$param['text'].'</option>';
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group row" style="display: none;">
										<div class="col-md-4">
											<label for="kdFaskes">Golongan Darah:</label>
										</div>
										<div class="col-md-3">
											<select id="goldar" class="form-control" name="goldar" >
												<option value="">Pilih</option>
												<?php
													for($i=0; $i<count($BLOD) ; $i++){
														$param=$BLOD[$i];
														if(post('goldar')==$param['id']){
															echo '<option value="'.$param['id'].'" selected="selected">'.$param['text'].'</option>';
														}else{
															echo '<option value="'.$param['id'].'">'.$param['text'].'</option>';
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group row" style="display: none;">
										<div class="col-md-4">
											<label for="education">Pendidikan Terakhir:</label>
										</div>
										<div class="col-md-4">
											<select id="education" class="form-control" name="education" >
												<option value="">Pilih</option>
												<?php
													for($i=0; $i<count($EDU) ; $i++){
														$param=$EDU[$i];
														if(post('education')==$param['id']){
															echo '<option value="'.$param['id'].'" selected="selected">'.$param['text'].'</option>';
														}else{
															echo '<option value="'.$param['id'].'">'.$param['text'].'</option>';
														}
													}
												?>
											</select>
										</div>
									</div>
									
								</div>
								<div class="col-md-6">
									<div class="form-group row">
										<div class="col-md-4">
											<label for="alamat">Alamat:</label>
										</div>
										<div class="col-md-8">
											<textarea class="form-control" readonly="true" maxlength="128" id="alamat" name="alamat" ><?php echo post('alamat') ?></textarea>
										</div>
									</div>
									<div class="form-group row" style="display: none;">
										<div class="col-md-4">
											<label for="rt">RT:</label>
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control" maxlength="16" id="rt" name="rt" value="<?php echo post('rt') ?>" >
										</div>
									</div>
									<div class="form-group row" style="display: none;">
										<div class="col-md-4">
											<label for="rw">RW:</label>
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control" maxlength="16" id="rw" name="rw" value="<?php echo post('rw') ?>" >
										</div>
									</div>
									<div class="form-group row" style="display: none;">
										<div class="col-md-4">
											<label for="negara">Negara:</label>
										</div>
										<div class="col-md-8">
											<input type="hidden" id="negara" name="negara" value="<?php echo post('negara') ?>" style="width: 100%">
											<input type="hidden" id="hiddenNegara" name="hiddenNegara" value="<?php echo post('hiddenNegara') ?>" >
											<script>
												$('#negara').select2({
													  ajax: {
														url: "<?php echo base_url()?>daftar/getCountry",
														dataType: 'json',
														delay: 2000,
														data: function (params) {
															return {
																text: params
															};
														},
														processResults: function (data, page) {
															return {
																results: data.data
															};
														},
														cache: true
													},
												}).on("change", function (e) { 
													$('#hiddenNegara').val(e.added.text); 
													if($(this).val()==0){
														$('#rowLainNegara').show();
													}else{
														$('#rowLainNegara').hide();
													}
												});
												<?php
													if(post('negara') != null){
												?>
												$('#negara').select2('data', {id: '<?php echo post('negara') ?>', text: '<?php echo post('hiddenNegara'); ?>'});
												<?php
													}
												?>
											</script>
										</div>
									</div>
									<div class="form-group row" style="display: none;" id="rowLainNegara" <?php if(post('lainNegara') == null){ ?> style="display:none" <?php } ?>>
										<div class="col-md-4">
											&nbsp;
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="lainNegara" name="lainNegara" value="<?php echo post('lainNegara') ?>">
										</div>
									</div>
									<div class="form-group row" style="display: none;">
										<div class="col-md-4">
											<label for="provinsi">Provinsi:</label>
										</div>
										<div class="col-md-8">
											<input type="hidden" id="provinsi" name="provinsi" value="<?php echo post('provinsi') ?>" style="width: 100%">
											<input type="hidden" id="hiddenProvinsi" name="hiddenProvinsi" value="<?php echo post('hiddenProvinsi') ?>" >
											<script>
												$('#provinsi').select2({
													  ajax: {
														url: "<?php echo base_url()?>daftar/getProvince",
														dataType: 'json',
														delay: 2000,
														value:{id:'awdw',text:'ayam'},
														data: function (params) {
															return {
																text: params,
																country:$('#negara').val()
															};
														},
														processResults: function (data, page) {
															return {
																results: data.data
															};
														},
														cache: true
													}
												}).on("change", function (e) { 
													$('#hiddenProvinsi').val(e.added.text); 
													if($(this).val()==0){
														$('#rowLainProvinsi').show();
													}else{
														$('#rowLainProvinsi').hide();
													}
												});
												<?php
													if(post('provinsi') != null){
												?>
												$('#provinsi').select2('data', {id: '<?php echo post('provinsi') ?>', text: '<?php echo post('hiddenProvinsi'); ?>'});
												<?php
													}
												?>
											</script>
										</div>
									</div>
									<div class="form-group row" id="rowLainProvinsi" <?php if(post('lainProvinsi') == null){ ?> style="display:none" <?php } ?>>
										<div class="col-md-4">
											&nbsp;
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="lainProvinsi" name="lainProvinsi" value="<?php echo post('lainProvinsi') ?>">
										</div>
									</div>
									<div class="form-group row" style="display: none;">
										<div class="col-md-4">
											<label for="kota">Kabupaten / Kota:</label>
										</div>
										<div class="col-md-8">
											<input type="hidden" id="kota" name="kota" value="<?php echo post('kota') ?>" style="width: 100%">
											<input type="hidden" id="hiddenKota" name="hiddenKota" value="<?php echo post('hiddenKota') ?>" >
											<script>
												$('#kota').select2({
													  ajax: {
														url: "<?php echo base_url()?>daftar/getDistrict",
														dataType: 'json',
														delay: 2000,
														data: function (params) {
															return {
																text: params,
																district:$('#provinsi').val()
															};
														},
														processResults: function (data, page) {
															return {
																results: data.data
															};
														},
														cache: true
													},
												}).on("change", function (e) { 
													$('#hiddenKota').val(e.added.text); 
													if($(this).val()==0){
														$('#rowLainKota').show();
													}else{
														$('#rowLainKota').hide();
													}
												});
												<?php
													if(post('kota') != null){
												?>
												$('#kota').select2('data', {id: '<?php echo post('kota') ?>', text: '<?php echo post('hiddenKota'); ?>'});
												<?php
													}
												?>
											</script>
										</div>
									</div>
									<div class="form-group row" id="rowLainKota" <?php if(post('lainKota') == null){ ?> style="display:none" <?php } ?>>
										<div class="col-md-4">
											&nbsp;
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="lainKota" name="lainKota" value="<?php echo post('lainKota') ?>">
										</div>
									</div>
									<div class="form-group row" style="display: none;">
										<div class="col-md-4">
											<label for="kecamatan">Kecamatan:</label>
										</div>
										<div class="col-md-8">
											<input type="hidden" id="kecamatan" name="kecamatan" value="<?php echo post('kecamatan') ?>" style="width: 100%">
											<input type="hidden" id="hiddenKecamatan" name="hiddenKecamatan" value="<?php echo post('hiddenKecamatan') ?>" >
											<script>
												$('#kecamatan').select2({
													  ajax: {
														url: "<?php echo base_url()?>daftar/getDistricts",
														dataType: 'json',
														delay: 2000,
														data: function (params) {
															return {
																text: params,
																districts:$('#kota').val()
															};
														},
														processResults: function (data, page) {
															return {
																results: data.data
															};
														},
														cache: true
													},
												}).on("change", function (e) { 
													$('#hiddenKecamatan').val(e.added.text); 
													if($(this).val()==0){
														$('#rowLainKecamatan').show();
													}else{
														$('#rowLainKecamatan').hide();
													}
												});
												<?php
													if(post('kecamatan') != null){
												?>
												$('#kecamatan').select2('data', {id: '<?php echo post('kecamatan') ?>', text: '<?php echo post('hiddenKecamatan'); ?>'});
												<?php
													}
												?>
											</script>
										</div>
									</div>
									<div class="form-group row" id="rowLainKecamatan" <?php if(post('lainKecamatan') == null){ ?> style="display:none" <?php } ?>>
										<div class="col-md-4">
											&nbsp;
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="lainKecamatan" name="lainKecamatan" value="<?php echo post('lainKecamatan') ?>">
										</div>
									</div>
									<div class="form-group row" style="display: none;">
										<div class="col-md-4">
											<label for="kelurahan">Kelurahan:</label>
										</div>
										<div class="col-md-8">
											<input type="hidden" id="kelurahan" name="kelurahan" value="<?php echo post('kelurahan') ?>" style="width: 100%">
											<input type="hidden" id="hiddenKelurahan" name="hiddenKelurahan" value="<?php echo post('hiddenKelurahan') ?>" >
											<script>
												$('#kelurahan').select2({
													  ajax: {
														url: "<?php echo base_url()?>daftar/getKelurahan",
														dataType: 'json',
														delay: 2000,
														data: function (params) {
															return {
																text: params,
																kelurahan:$('#kecamatan').val()
															};
														},
														processResults: function (data, page) {
															return {
																results: data.data
															};
														},
														cache: true
													},
												}).on("change", function (e) { 
													$('#hiddenKelurahan').val(e.added.text); 
													if($(this).val()==0){
														$('#rowLainKelurahan').show();
													}else{
														$('#rowLainKelurahan').hide();
													}
												});
												<?php
													if(post('kelurahan') != null){
												?>
												$('#kelurahan').select2('data', {id: '<?php echo post('kelurahan') ?>', text: '<?php echo post('hiddenKelurahan'); ?>'});
												<?php
													}
												?>
											</script>
										</div>
									</div>
									<div class="form-group row" id="rowLainKelurahan" <?php if(post('lainKelurahan') == null){ ?> style="display:none" <?php } ?>>
										<div class="col-md-4">
											&nbsp;
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="lainKelurahan" name="lainKelurahan" value="<?php echo post('lainKelurahan') ?>">
										</div>
									</div>
									<div class="form-group row" style="display: none;">
										<div class="col-md-4">
											<label for="kdpos">Kode Pos:</label>
										</div>
										<div class="col-md-3">
											<input type="text" class="form-control" id="kdpos" value="<?php echo post('kdpos') ?>" name="kdpos" >
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="menu-left-head sub">
						<strong>Data</strong> Kunjungan
						<div class="menu-left" style="padding: 10px;">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group row">
										<div class="col-md-4">
											<label for="kelurahan">Kelompok Pasien:</label>
										</div>
										<div class="col-md-8">
											<input type="hidden" id="kelompok" name="kelompok" value="<?php echo post('kelompok') ?>" style="width: 100%">
											<input type="hidden" id="hiddenKelompok" value="<?php echo post('hiddenKelompok') ?>" name="hiddenKelompok" >
											<script>
												$('#kelompok').select2({
													  ajax: {
														url: "<?php echo base_url()?>daftar/getCustomer",
														dataType: 'json',
														delay: 2000,
														data: function (params) {
															return {
																text: params
															};
														},
														processResults: function (data, page) {
															return {
																results: data.data
															};
														},
														cache: true
													},
												}).on("change", function (e) { $('#hiddenKelompok').val(e.added.text); });
												<?php
													if(post('kelompok') != null){
												?>
												$('#kelompok').select2('data', {id: '<?php echo post('kelompok') ?>', text: '<?php echo post('hiddenKelompok'); ?>'});
												<?php
													}
												?>
											</script>
										</div>
									</div>
									<div class='form-group row'>
										<div class="col-md-4">
											<label for="tglReg">Tanggal Berobat:</label>
										</div>
										<div class="col-md-3">
											<div id="datetimepicker" class="input-group date">
												<input type="text"  data-format="dd-MM-yyyy" class="form-control add-on " value="<?php echo post('tglReg') ?>" id="tglReg" name="tglReg" required />
											</div>
											<script type="text/javascript">
											  $(function() {
												$('#datetimepicker').datetimepicker({
												  language: 'pt-BR',
												}).on('changeDate', function(){
											       $('.bootstrap-datetimepicker-widget').hide();
											   });
												$('#tglReg').bind("blur", function (e) { 
													checkJadwal();
												});
												<?php 
													if(post('tglReg') == null){
														
												?>
													var now=new Date();
													$('#tglReg').val(now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear());
												<?php
													}
												?>
											  });
											 </script>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-4">
											<label for="nama">No. Telepon:</label>
										</div>
										<div class="col-md-8">
											<input type="text"  maxlength="16" class="form-control" id="telepon" value="<?php echo post('telepon') ?>" name="telepon" required>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-4">
											<label for="kelurahan">Poliklinik:</label>
										</div>
										<div class="col-md-8">
											<input type="hidden" id="poliklinik" name="poliklinik" value="<?php echo post('poliklinik') ?>" style="width: 100%">
											<input type="hidden" id="hiddenPoliklinik" value="<?php echo post('hiddenPoliklinik') ?>" name="hiddenPoliklinik" >
											<script>
												$('#poliklinik').select2({
													  ajax: {
														url: "<?php echo base_url()?>daftar/getUnit",
														dataType: 'json',
														delay: 2000,
														data: function (params) {
															return {
																text: params
															};
														},
														processResults: function (data, page) {
															return {
																results: data.data
															};
														},
														cache: true
													},
												}).on("change", function (e) { 
													$('#hiddenPoliklinik').val(e.added.text); 
													checkJadwal();
												});
												<?php
													if(post('poliklinik') != null){
												?>
												$('#poliklinik').select2('data', {id: '<?php echo post('poliklinik') ?>', text: '<?php echo post('hiddenPoliklinik'); ?>'});
												<?php
													}
												if($this->input->get('unit_id') != null){
												?>
												$('#poliklinik').select2('data', {id: '<?php echo$this->input->get('unit_id') ?>', text: '<?php echo $this->input->get('unit_name') ?>'});
												$('#hiddenPoliklinik').val('<?php echo $this->input->get('unit_name') ?>');
												<?php 
													}
												?>
											</script>
										</div>
									</div>
									
									<script>
									function checkJadwal(){
										$('#div-cek-error').hide();
										$('#div-cek-success').hide();
										if($('#dokter').val() !='' && $('#poliklinik').val() !='' && $('#tglReg').val() !=''){
											$.ajax({
											   url: '<?php echo base_url()?>daftar/cekAntrian',
											   data: {
												  dokter: 45,
												  hiddenDokter: 45,
												  poliklinik: $('#poliklinik').val(),
												  hiddenPoliklinik: $('#hiddenPoliklinik').val(),
												  tglReg: $('#tglReg').val(),
											   },
											   type:'GET',
											   error: function() {
											   },
											   dataType: 'json',
											   success: function(data) {
												   if(data.result=='SUCCESS'){
													   $('#div-cek-success').show();
													   $('#div-cek-success .message').html(data.message);
												   }else if(data.result=='ERROR'){
													   $('#div-cek-error').show();
													   $('#div-cek-error .message').html(data.message);
												   }
											   },
											   type: 'GET'
											});
										}
									}
									</script>
									<div class="form-group row" id="div-cek-error" style="display: none;">
										<div class="col-md-12">
											<div class="alert alert-danger" role="alert" >
												<span class="message"></span>
											</div>
										</div>
									</div>
									<div class="form-group row" id="div-cek-success" style="display: none;">
										<div class="col-md-12">
											<div class="alert alert-success" role="alert" >
												<span class="message"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group row">
										<div class="col-md-4">
											<label for="kdFaskes">Keluhan:</label>
										</div>
										<div class="col-md-8">
											<textarea class="form-control" id="keluhan" name="keluhan" required><?php echo post('keluhan') ?></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="menu-left-head sub col-md-8" id="divBtnDaftar">
								<div class="menu-left" style="padding: 10px;">
									<div class="form-group row">
										<div class="col-md-5">
											<input type="button" class="btn btn-success" value="Daftar" onclick="javascript: sendSms();" />
											<script>
												function sendSms(){
													if($('#telepon').val() !='' && $('#telepon').val() != ''){
														$.ajax({
														   url: '<?php echo base_url()?>daftar/sendSms',
														   data: {
															  telepon: $('#telepon').val(),
															  nama: $('#nama').val(),
															  // poliklinik: $('#poliklinik').val(),
															  // hiddenPoliklinik: $('#hiddenPoliklinik').val(),
															  // tglReg: $('#tglReg').val(),
														   },
														   type:'POST',
														   error: function() {
																$('#divBtnVerifikasi').hide();
																$('#divBtnDaftar').show();
																$('#div-cek-error').show();
																$('#div-cek-error .message').html('Aplikasi Error Hunbungi Admin');
														   },
														   dataType: 'json',
														   success: function(data) {
															   if(data.result=='SUCCESS'){
																	$('#divBtnVerifikasi').show();
																	$('#divBtnDaftar').hide();
																	$('#div-cek-error').hide();
															   }else if(data.result=='ERROR'){
																	$('#divBtnVerifikasi').hide();
																	$('#divBtnDaftar').show();
																   $('#div-cek-error').show();
																   $('#div-cek-error .message').html(data.message);
															   }
														   },
														});
													}else{
														$('#div-cek-error').show();
														$('#divBtnDaftar').show();
														$('#divBtnVerifikasi').hode();
														$('#div-cek-error .message').html('Data Tidak Ada.');
													}
												}
											</script>
										</div>
									</div>
								</div>
							</div>
							<div class="menu-left-head sub col-md-8" id="divBtnVerifikasi" style="display: none;">
								<div class="menu-left" style="padding: 10px;">
									<div class="form-group row">
										<div class="col-md-5">
											<span><button type="submit" class="btn btn-success">
												<?php 
												If(isset( $_SESSION['caption_button_lama'])){
													If($_SESSION['caption_button_lama']=='daftar'){
													//$_SESSION['caption_button_lama']='';
													echo'Daftar';
													}else{
													//$_SESSION['caption_button_lama']='daftar';
													echo'Kirim verif sms';
													}
												}else{
												echo'Kirim verif sms';
												}?>
												</button>
											</span><span>&nbsp;<a href="javascript: sendSms();" >Kirim Ulang</a></span>
												
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-5">
											<input type="text" name="captcha" placeholder="<?php 
												echo 'Masukan Kode Verifikasi'
												// If(isset( $_SESSION['caption_button_lama'])){
													// If($_SESSION['caption_button_lama']=='daftar'){
														// echo'Harap isi untuk mendaftar';
													// }
													// else{
														// echo'Harap Kosongkan untuk kirim sms';
													// }
												// }else{
													// echo'Harap Kosongkan untuk kirim sms';
												// }
											?>"  class="form-control">
										</div>
										
									</div>
									
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</form>
			</div>
		</div>
				
	</div>
</div>
</div>