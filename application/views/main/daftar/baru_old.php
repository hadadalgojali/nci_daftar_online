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

<link href="<?php echo base_url()?>vendor/bootstrap-datetimepicker-0.0.11/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<link href="<?php echo base_url()?>vendor/select2-3.5.4/select2.css" rel="stylesheet">
<script src="<?php echo base_url()?>vendor/bootstrap-datetimepicker-0.0.11/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url()?>vendor/select2-3.5.4/select2.min.js"></script>
<br>
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
			<h5> <strong>Pasien</strong> Baru</h5>
			<div class="menu-left" style="padding: 0px !important;">
				
				<form id="form" class="form-signin" method="POST" autocomplete="off" action="<?php echo base_url()?>daftar/saveBaru">
					
					<div class="menu-left-head sub">
						<strong>Data</strong> Pasien
						<div class="menu-left" style="padding: 10px;">
							<div class="row">
								<div class="col-md-6">
								
									<div class="form-group row">
										<div class="col-md-4">
											<label for="gelar">Gelar:</label>
										</div>
										<div class="col-md-4">
											<input type="text" class="form-control" id="gelar" maxlength="16" value="<?php echo post('gelar') ?>" name="gelar">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-4">
											<label for="nama">No. KTP:</label>
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="ktp" maxlength="16" value="<?php echo post('ktp') ?>" name="ktp" required>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-4">
											<label for="nama">Nama Lengkap:</label>
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="nama" maxlength="32" value="<?php echo post('nama') ?>" name="nama" required>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-4">
											<label for="nama">No. Telepon:</label>
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="telepon"  maxlength="16" value="<?php echo post('telepon') ?>" name="telepon" required>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-4">
											<label for="tampatLahir">Tempat Lahir:</label>
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="tampatLahir"  maxlength="32" value="<?php echo post('tempatLahir') ?>" name="tempatLahir" required>
										</div>
									</div>
									<div class='form-group row'>
										<div class="col-md-4">
											<label for="tglReg">Tgl. Lahir:</label>
										</div>
										<div class="col-md-4">
											<div id="tgllahir" class="input-group date">
												<input type="text"  data-format="dd-MM-yyyy" class="form-control add-on " value="<?php echo post('tgllahir') ?>" name="tgllahir" required />
												<span class="add-on input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
											<script type="text/javascript">
											  $(function() {
												$('#tgllahir').datetimepicker({
												  language: 'pt-BR'
												}).on('changeDate', function(){
												       $('.bootstrap-datetimepicker-widget').hide();
												   });
											  });
											 </script>
										</div>
									</div>
									<div class="form-group row">
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
									<div class="form-group row">
										<div class="col-md-4">
											<label for="agama">Agama:</label>
										</div>
										<div class="col-md-4">
											<select id="agama" class="form-control" name="agama" required>
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
									<div class="form-group row">
										<div class="col-md-4">
											<label for="kdFaskes">Golongan Darah:</label>
										</div>
										<div class="col-md-3">
											<select id="goldar" class="form-control" name="goldar" required>
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
									<div class="form-group row">
										<div class="col-md-4">
											<label for="education">Pendidikan Terakhir:</label>
										</div>
										<div class="col-md-4">
											<select id="education" class="form-control" name="education" required>
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
											<textarea class="form-control" id="alamat" name="alamat" required><?php echo post('alamat') ?></textarea>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-4">
											<label for="rt">RT:</label>
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control" id="rt" name="rt" value="<?php echo post('rt') ?>" required>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-4">
											<label for="rw">RW:</label>
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control" id="rw" name="rw" value="<?php echo post('rw') ?>" required>
										</div>
									</div>
									<div class="form-group row">
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
									<div class="form-group row" id="rowLainNegara" <?php if(post('lainNegara') == null){ ?> style="display:none" <?php } ?>>
										<div class="col-md-4">
											&nbsp;
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="lainNegara" name="lainNegara" value="<?php echo post('lainNegara') ?>">
										</div>
									</div>
									<div class="form-group row">
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
									<div class="form-group row">
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
									<div class="form-group row">
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
									<div class="form-group row">
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
									<div class="form-group row">
										<div class="col-md-4">
											<label for="kdpos">Kode Pos:</label>
										</div>
										<div class="col-md-3">
											<input type="text" class="form-control" id="kdpos" value="<?php echo post('kdpos') ?>" name="kdpos" required>
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
											var bpjs;
											var kd_bpjs;
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
															console.log(data);
															return {
																results: data.data
															};
														},
														cache: true
													},
												}).on("change", function (e){
													console.log(e);
													$.ajax({
													    type:"POST",
													    url: "<?php echo base_url()?>daftar/getCustomer_bpjs",
													    data: function (params) {
															return {
																text: params
															};
														},
													    success:function(data){
													    	 bpjs=data;
													    },
													    error: function(errorThrown){
													        alert(errorThrown);
													        alert("There is an error with AJAX!");
													    }               
													});
													console.log(bpjs);
													 $('#hiddenKelompok').val(e.added.text);
													  var kata = e.added.text; 
													  var x =kata.match(/BPJS/);
													  if(x==null || x==''){
													  	kd_bpjs=0;
													  }else{
													  	kd_bpjs=1;
													  }
													  console.log(kd_bpjs);
   													  if(kd_bpjs==1){
   													  	console.log('if');
   													  	document.getElementById("lbl_no_kartu_baru").style.display='block';
														 document.getElementById("no_kartu_baru").style.display='block';
														 document.getElementById("lbl_no_rujukan_baru").style.display='block';
														 document.getElementById("no_rujukan_baru").style.display='block';
														 document.getElementById("lbl_kelas_baru").style.display='block';
														 document.getElementById("kelas_baru").style.display='block';
														 document.getElementById("lbl_faskes_baru").style.display='block';
														 document.getElementById("faskes_baru").style.display='block';
														 document.getElementById("lbl_diagnosa_baru").style.display='block';
														 document.getElementById("diagnosa_baru").style.display='block';
														 document.getElementById("lbl_poli_baru").style.display='block';
														 document.getElementById("poli_baru").style.display='block';
														 document.getElementById("btn_cek_no_kartu_baru").style.display='block';
   													  }else {
   													  	 	console.log('else');
   													  	 document.getElementById("lbl_no_kartu_baru").style.display='none';
														 document.getElementById("no_kartu_baru").style.display='none';
														 document.getElementById("lbl_no_rujukan_baru").style.display='none';
														 document.getElementById("no_rujukan_baru").style.display='none';
														 document.getElementById("lbl_kelas_baru").style.display='none';
														 document.getElementById("kelas_baru").style.display='none';
														 document.getElementById("lbl_faskes_baru").style.display='none';
														 document.getElementById("faskes_baru").style.display='none';
														 document.getElementById("lbl_diagnosa_baru").style.display='none';
														 document.getElementById("diagnosa_baru").style.display='none';
														 document.getElementById("lbl_poli_baru").style.display='none';
														 document.getElementById("poli_baru").style.display='none';
														 document.getElementById("btn_cek_no_kartu_baru").style.display='none';

   													  }													 
													});
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
												  language: 'pt-BR'
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
											<label for="kdFaskes">Keluhan:</label>
										</div>
										<div class="col-md-8">
											<textarea class="form-control" id="keluhan" name="keluhan" required><?php echo post('keluhan') ?></textarea>
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
									<div class="form-group row">
										<div class="col-md-4">
											<label for="kelurahan">Dokter:</label>
										</div>
										<div class="col-md-8">
											<input type="hidden" id="dokter" name="dokter" value="<?php echo post('dokter') ?>" style="width: 100%">
											<input type="hidden" id="hiddenDokter" value="<?php echo post('hiddenDokter') ?>" name="hiddenDokter" >
											<script>
												$('#dokter').select2({
													  ajax: {
														url: "<?php echo base_url()?>daftar/getDokter",
														dataType: 'json',
														delay: 2000,
														data: function (params) {
															return {
																text: params,
																unit:$('#poliklinik').val()
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
													$('#hiddenDokter').val(e.added.text); 
													checkJadwal();
												});
												<?php
													if(post('dokter') != null){
												?>
												$('#dokter').select2('data', {id: '<?php echo post('dokter') ?>', text: '<?php echo post('hiddenDokter'); ?>'});
												<?php
													}
													if($this->input->get('dokter_id') != null){
												?>
												$('#dokter').select2('data', {id: '<?php echo$this->input->get('dokter_id') ?>', text: '<?php echo $this->input->get('dokter_name') ?>'});
												$('#hiddenDokter').val('<?php echo $this->input->get('dokter_name') ?>');
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
												  dokter: $('#dokter').val(),
												  hiddenDokter: $('#hiddenDokter').val(),
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
											<label for="lbl_no_kartu_baru" id="lbl_no_kartu_baru" style="display:none"> No Kartu Peserta BPJS:</label>
										</div>
										<div class="col-md-6">
											<input type="text"  maxlength="26" class="form-control" id="no_kartu_baru" value="" name="no_kartu_baru"   style="display:none"> 
										</div>

                           				<input id="btn_cek_no_kartu_baru" type="button" class="btn btn-success"  style="display:none" value="Cek" onclick="javascript: cek_no_kartu_baru();" />
                       					
									</div>
								</div>

								<!-- HIDDEN -->

									<input type="hidden"  readonly="true" maxlength="26" class="form-control" id="hidden_kd_rujukan" value="" name="hidden_kd_rujukan" required  style="display:none">

									<input type="hidden"  readonly="true" maxlength="26" class="form-control" id="hidden_kd_diagnosa" value="" name="hidden_kd_diagnosa" required  style="display:none">

									<input type="hidden"  readonly="true" maxlength="26" class="form-control" id="hidden_kd_kelas" value="" name="hidden_kd_kelas" required  style="display:none">

									<input type="hidden"  readonly="true" maxlength="26" class="form-control" id="hidden_kd_poli" value="" name="hidden_kd_poli" required  style="display:none"> 

								<!-- HIDDEN -->

								<div class="col-md-6">
									<div class="form-group row">
										<div class="col-md-4">
											<label for="lbl_no_rujukan_baru" id="lbl_no_rujukan_baru" style="display:none">No Rujukan:</label>
										</div>
										<div class="col-md-8">
											<input type="text"  readonly="true" maxlength="26" class="form-control" id="no_rujukan_baru" value=""
											 name="no_rujukan_baru" required  style="display:none"> 
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<div class="col-md-4">
											<label for="lbl_kelas_baru" id="lbl_kelas_baru" style="display:none">Kelas:</label>
										</div>
										<div class="col-md-8">
											<input type="text"  readonly="true" maxlength="26" class="form-control" id="kelas_baru" value="" name="kelas_baru" required  style="display:none"> 
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<div class="col-md-4">
											<label for="lbl_faskes_baru" id="lbl_faskes_baru" style="display:none">Faskes Asal:</label>
										</div>
										<div class="col-md-8">
											<input type="text"  readonly="true" maxlength="26" class="form-control" id="faskes_baru" value="" name="faskes_baru" required  style="display:none"> 
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<div class="col-md-4">
											<label for="lbl_diagnosa_baru" id="lbl_diagnosa_baru" style="display:none">Diagnosa:</label>
										</div>
										<div class="col-md-8">
											<input type="text"  readonly="true" maxlength="26" class="form-control" id="diagnosa_baru" value="" name="diagnosas_baru" required  style="display:none"> 
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<div class="col-md-4">
											<label for="lbl_poli_baru" id="lbl_poli_baru" style="display:none">Poliklinik:</label>
										</div>
										<div class="col-md-8">
											<input type="text"  readonly="true" maxlength="26" class="form-control" id="poli_baru" value="" name="poli_baru" required  style="display:none"> 
										</div>
									</div>
								</div>
							</div>
							<div class="menu-left-head sub col-md-8">
								<strong>Isi</strong> Captcha
								<div class="menu-left" style="padding: 10px;">
									<div class="form-group row">
										<div class="col-md-3">
											<img src="<?php echo base_url().'vendor/captcha/captcha.php' ?>" /> 
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-3">
											<input type="text" name="captcha" placeholder="Enter captcha here"  class="form-control"  required>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-2">
											<button type="submit" class="btn btn-success">Daftar</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</form>
			</div>
		</div>
				
	</div>
</div>
</div>
<script type="text/javascript">
	/*function validasi_input(form){
	  if (form.no_kartu_baru.value == ""){
	    alert("Username masih kosong!");
	    form.no_kartu_baru.focus();
	    return (false);
	  }
	return (true);
	}*/
	function cek_no_kartu_baru(){
		if($('#no_kartu').val() !='' && $('#no_kartu').val() != ''){
			$.ajax({
				url: '<?php echo base_url()?>daftar/cek_no_kartu',
					data: {
							no_kartu: $('#no_kartu_baru').val(),
						  },
					type:'POST',
						 error: function() {
							//$('#divBtnVerifikasi').hide();
							//$('#divBtnDaftar').show();
							//$('#div-cek-error').show();
							$('#div-cek-error .message').html('Aplikasi Error Hunbungi Admin');
						},
					dataType: 'json',
						success: function(data) {
							var status =JSON.parse(data.resp.metaData.code);
							if(status=='200'){
								console.log('baru yaaaa');
								console.log(data);
								$('#no_rujukan_baru').val(data.resp.response.rujukan.noKunjungan);
								$('#kelas_baru').val(data.resp.response.rujukan.peserta.hakKelas.keterangan);
								$('#diagnosa_baru').val(data.resp.response.rujukan.diagnosa.nama);
								$('#poli_baru').val(data.resp.response.rujukan.poliRujukan.nama);
								$('#faskes_baru').val(data.resp.response.rujukan.provPerujuk.nama);
							//	$('#kd_faskes_baru').val(data.resp.response.rujukan.provPerujuk.nama);
								/*HIDDEN*/
								$('#hidden_kd_rujukan').val(data.resp.response.rujukan.provPerujuk.kode);
								$('#hidden_kd_diagnosa').val(data.resp.response.rujukan.diagnosa.kode);
								$('#hidden_kd_kelas').val(data.resp.response.rujukan.peserta.hakKelas.kode);
								$('#hidden_kd_poli').val(data.resp.response.rujukan.poliRujukan.kode);
									kd_poli=data.resp.response.rujukan.poliRujukan.kode;
									auto_poli_bpjs(kd_poli);
							}else if(data.result=='ERROR'){
								//$('#divBtnVerifikasi').hide();
								//$('#divBtnDaftar').show();
								//$('#div-cek-error').show();
								//$('#div-cek-error .message').html(data.message);
							}
						},
			});
		}else{
			$('#div-cek-error').show();
			//$('#divBtnDaftar').show();
			$('#divBtnVerifikasi').hode();
			$('#div-cek-error .message').html('Data Tidak Ada.');
		}
	}
</script>
<script>
function auto_poli_bpjs(kd_poli){
	console.log(kd_poli);
		$.ajax({
				url: '<?php echo base_url()?>daftar/getKdPoliBPJS',
					data: {
							text: kd_poli,
						  },
					type:'POST',
						 error: function() {
							//$('#divBtnVerifikasi').hide();
							//$('#divBtnDaftar').show();
							//$('#div-cek-error').show();
							$('#div-cek-error .message').html('Aplikasi Error Hunbungi Admin');
						},
					dataType: 'json',
				    success:function(data, page){
				    	console.log(data);
				    	// $('#poliklinik').val(data[0].id);
						$('#poliklinik').select2('data', {id: data[0].id, text: data[0].text});
						$('#hiddenPoliklinik').val(data[0].text);
					},

													                 
		});
}
												
</script>