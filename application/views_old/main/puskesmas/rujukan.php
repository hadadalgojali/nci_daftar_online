<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$common=$this->common;
$now=new DateTime();
$faskesAccount=$common->find ('FaskesAccount',$this->session->get('PUSKESMAS'));
$seq=$this->common->getNextSequence('RUJUKAN',null,array($faskesAccount->getFaskes()->getFaskesCode()));
$code=$seq['val'];
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
		<?php include('menu_main.php'); ?>
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
			<h5> <strong>Rujukan</strong> Online</h5>
			
			<div class="menu-left" style="padding: 0px !important;">
				<form id="form" class="form-signin" method="POST" autocomplete="off" action="<?php echo base_url()?>puskesmas/saveRujukan">
					<?php 
						$rujuk=$common->getSystemProperty('RUJUKAN', $common->getSystemProperty('DEFAULT_TENANT', null)->getPropertyValue())->getPropertyValue();
						if($rujuk=='Y'){
					?>
					<div class="menu-left-head sub">
						<strong>Data</strong> Faskes
						<div class="menu-left" style="padding: 10px;">
							<div class="form-group row">
								<div class="col-md-2" style="text-align: right;">
									<label for="kdFaskes">No Rujukan:</label>
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control" id="noRujukan" value="<?php echo $code; ?>" name="noRujukan" required>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2" style="text-align: right;">
									<label for="kdFaskes">Kode Faskes:</label>
								</div>
								<div class="col-md-3">
									<?php echo $faskesAccount->getFaskes()->getFaskesCode() ; ?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2" style="text-align: right;">
									<label for="kdFaskes">Nama Faskes:</label>
								</div>
								<div class="col-md-3">
									<?php echo $faskesAccount->getFaskes()->getFaskesName(); ?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2" style="text-align: right;">
									<label for="kdFaskes">Kabupaten / Kota:</label>
								</div>
								<div class="col-md-3">
									<?php 
									echo $faskesAccount->getFaskes()->getKota();
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="menu-left-head sub">
						<strong>Data</strong> Pasien
						<div class="menu-left" style="padding: 10px;">
							<div class="form-group row">
								<div class="col-md-2">
									<label for="jp">Jenis Pasien:</label>
								</div>
								<div class="col-md-3">
								<?php
									if(post('jp')!= null && post('jp')=='LAMA'){
								?>	
									<input type="radio" name="jp" value="BARU" aria-label="..."> Baru  <br>
									<input type="radio" name="jp" value="LAMA" aria-label="..."  checked> Lama 
								<?php
									}else{
								?>
									<input type="radio" name="jp" value="BARU" aria-label="..."   checked> Baru  <br>
									<input type="radio" name="jp" value="LAMA" aria-label="..."> Lama 
								<?php
									}
								?>
								</div>
								<script>
									$('input[type=radio][name=jp]').change(function() {
										if (this.value == 'BARU') {
											$('#medrec').hide();
											reset();
										}
										else if (this.value == 'LAMA') {
											$('#medrec').show();
											reset();
										}
									});
									function reset(){
										$('#gelar').val('');
									   $('#nama').val('');
									   $('#tampatLahir').val('');
									   $('#tgllahir').val('');
									   $('#agama').val('');
									   $('#goldar').val('');
									   $('#education').val('');
									   $('#alamat').val('');
									   $('#rt').val('');
									   $('#rw').val('');
									   $('#negara').select2('data', null);
									   $('#provinsi').select2('data', null);
									   $('#kota').select2('data', null);
									   $('#kecamatan').select2('data', null);
									   $('#kelurahan').select2('data', null);
									   $('#kdpos').val('');
									   $('#rowLainNegara').hide();
									   $('#rowLainProvinsi').hide();
									   $('#rowLainKota').hide();
									   $('#rowLainKecamatan').hide();
									   $('#rowLainKelurahan').hide();
									}
								</script>
							</div>
							<div id="lama">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group row" id="medrec" style="<?php 
											if((post('jp')!= null && post('jp')=='BARU') || post('jp')==null) {
												echo 'display: none;'; 
											}
											?>">
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
																	text: params
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
															   var tanggal = new Date();
															   $('#gelar').val(o.gelar);
															   $('#nama').val(o.nama);
															   $('#telepon').val(o.telepon);
															   $('#tampatLahir').val(o.tmpLahir);
															   $('#tgllahir').val(o.tglLahir);
															   var tglLahir=new Date(o.tglLahir);
															   var selisih = Date.parse(tanggal.toGMTString()) - Date.parse(tglLahir.toGMTString());
																var umur=Math.round(selisih/(1000*60*60*24*365));
																if(isNaN(umur)){
																	umur=0;
																}
																$('#umur').val(umur);
															   $('#agama').val(o.religion);
															   $('#goldar').val(o.blod);
															   $('#education').val(o.edu);
															   $('#ktp').val(o.ktp);
															   $('#alamat').val(o.address);
															   $('#rt').val(o.rt);
															   $('#rw').val(o.rw);
															   $('#negara').select2('data', {id: o.countryId, text: o.countryName});
															   if(o.countryId ==0){
																   $('#rowLainNegara').show();
																   $('#lainNegara').val(o.countryTemp);
															   }else{
																   $('#rowLainNegara').hide();
															   }
															   $('#provinsi').select2('data', {id: o.provinceId, text: o.provinceName});
															   if(o.provinceId ==0){
																   $('#rowLainProvinsi').show();
																   $('#lainProvinsi').val(o.provinceTemp);
															   }else{
																   $('#rowLainProvinsi').hide();
															   }
															   $('#kota').select2('data', {id: o.districtId, text: o.districtName});
															   if(o.districtId ==0){
																   $('#rowLainKota').show();
																   $('#lainKota').val(o.districtTemp);
															   }else{
																   $('#rowLainKota').hide();
															   }
															   $('#kecamatan').select2('data', {id: o.districtsId, text: o.districtsName});
															   if(o.districtsId ==0){
																   $('#rowLainKecamatan').show();
																   $('#lainKecamatan').val(o.districtsTemp);
															   }else{
																   $('#rowLainKecamatan').hide();
															   }
															   $('#kelurahan').select2('data', {id: o.kelurahanId, text: o.kelurahanName});
															   if(o.kelurahanId ==0){
																   $('#rowLainKelurahan').show();
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
										<div class="form-group row">
											<div class="col-md-4">
												<label for="nama">No. KTP:</label>
											</div>
											<div class="col-md-8">
												<input type="text" class="form-control" id="ktp" value="<?php echo post('ktp') ?>" name="ktp" required>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-4">
												<label for="nama">No. Telepon:</label>
											</div>
											<div class="col-md-8">
												<input type="text" class="form-control" id="telepon" value="<?php echo post('telepon') ?>" name="telepon" required>
											</div>
										</div>
										
										<div class="form-group row">
											<div class="col-md-4">
												<label for="gelar">Gelar:</label>
											</div>
											<div class="col-md-4">
												<input type="text" class="form-control" id="gelar" value="<?php echo post('gelar') ?>" name="gelar">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-4">
												<label for="nama">Nama Lengkap:</label>
											</div>
											<div class="col-md-8">
												<input type="text" class="form-control" id="nama" value="<?php echo post('nama') ?>" name="nama" required>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-4">
												<label for="tampatLahir">Tempat Lahir:</label>
											</div>
											<div class="col-md-8">
												<input type="text" class="form-control" id="tampatLahir" value="<?php echo post('tempatLahir') ?>" name="tempatLahir" required>
											</div>
										</div>
										<div class='form-group row'>
											<div class="col-md-4">
												<label for="tglReg">Tgl. Lahir:</label>
											</div>
											<div class="col-md-4">
												<div id="tgllahira" class="input-group date">
													<input type="text"  data-format="dd-MM-yyyy" class="form-control add-on " value="<?php echo post('tgllahir') ?>" id="tgllahir" name="tgllahir" required />
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
					</div>
					<div class="menu-left-head sub">
						<strong>Penanganan</strong> Pasien
						<div class="menu-left" style="padding: 10px;">		
							<div class='form-group row'>
								<div class="col-md-2">
									<label for="tglReg">Tanggal Rujuk:</label>
								</div>
								<div class="col-md-2">
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
								<div class="col-md-2">
									<label for="kelurahan">Poliklinik:</label>
								</div>
								<div class="col-md-4">
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
								<div class="col-md-2">
									<label for="kelurahan">Dokter:</label>
								</div>
								<div class="col-md-4">
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
							<div class="form-group row">
								<div class="col-md-2">
									<label for="penjamin">Penjamin:</label>
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control" disabled="true" value="<?php if(post('penjamin') !=null){echo post('penjamin');}else{ echo 'BPJS Kesehatan';} ?>" id="penjamin" name="penjamin" required>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									<label for="noBpjs">No Kartu BPJS:</label>
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control" value="<?php echo post('noBpjs') ?>" id="noBpjs" name="noBpjs" required>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									<label for="kdFaskes">Umur:</label>
								</div>
								<div class="col-md-1">
									<input type="text" class="form-control" value="<?php echo post('umur') ?>" id="umur" name="umur" required>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									<label for="status">Status:</label>
								</div>
								<div class="col-md-8">
								<?php
									if(post('status')!= null && post('status')=='GENDER_P'){
								?>	
									<input type="radio" name="status" value="UTAMA" aria-label="..."> Utama  <br>
									<input type="radio" name="status" value="TANGGUNGAN" aria-label="..."  checked> Tanggungan 
								<?php
									}else{
								?>
									<input type="radio" name="status" value="UTAMA" aria-label="..."   checked> Utama  <br>
									<input type="radio" name="status" value="TANGGUNGAN" aria-label="..."> Tanggungan 
								<?php
									}
								?>
									
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									<label for="noBpjs">Dokter Perujuk:</label>
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control" value="<?php echo post('dokterFaskes') ?>" id="dokterFaskes" name="dokterFaskes" required>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									<label for="jk">Status Rujukan:</label>
								</div>
								<div class="col-md-3">
								<input type="hidden" id="sr_hidden" value="<?php 
									if(post('sr')== null){
										echo 'RJKSTAT_NORMAL';
									}else{
										echo post('sr');
									}	
								?>">
								<?php
									if(post('sr')!= null && post('sr')=='RJKSTAT_DARURAT'){
								?>	
									<input type="radio" name="sr" value="RJKSTAT_NORMAL" aria-label="..."> Normal  <br>
									<input type="radio" name="sr" value="RJKSTAT_DARURAT" aria-label="..."   checked="checked" > Darurat 
								<?php
									}else{
								?>
									<input type="radio" name="sr" value="RJKSTAT_NORMAL" aria-label="..."    checked="checked" > Normal  <br>
									<input type="radio" name="sr" value="RJKSTAT_DARURAT" aria-label="..."> Darurat 
								<?php
									}
								?>
								<script type="text/javascript">
									$("input:radio[name=sr]").click(function() {
									   	$('#sr_hidden').val($(this).val());
									   	alert($('#sr_hidden').val());
									});
								</script>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									<label for="negara">Diagnosa ICDX:</label>
								</div>
								<div class="col-md-5">
									<input type="hidden" id="penyakit" name="penyakit" value="<?php echo post('negara') ?>" style="width: 100%">
									<input type="hidden" id="hiddenPenyakit" name="hiddenPenyakit" value="<?php echo post('hiddenPenyakit') ?>" >
									<script>
										$('#penyakit').select2({
											  ajax: {
												url: "<?php echo base_url()?>puskesmas/getPenyakit",
												dataType: 'json',
												delay: 2000,
												data: function (params) {
													return {
														text: params,
														status:$("#sr_hidden").val()
													};
												},
												processResults: function (data, page) {
													return {
														results: data.data
													};
												},
												cache: true
											},
										}).on("change", function (e) { $('#hiddenPenyakit').val(e.added.text); });
										<?php
											if(post('penyakit') != null){
										?>
										$('#penyakit').select2('data', {id: '<?php echo post('penyakit') ?>', text: '<?php echo post('hiddenPenyakit'); ?>'});
										<?php
											}
										?>
									</script>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="kdFaskes">Tindakan Yang Telah DiBerikan:</label>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<textarea class="form-control" id="tindakan" name="tindakan" required><?php echo post('tindakan') ?></textarea>
									<script>
										$(function(){
											$('#tindakan').keyup(function(){
												var a=$(this).val().replace('Control','').replace('control','').replace('Kontrol','').replace('kontrol','');
												$(this).val(a);
											});
										})
									</script>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="kdFaskes">Obat Yang Telah DiBerikan:</label>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<textarea class="form-control" id="obat" name="obat" required><?php echo post('obat') ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="kdFaskes">Pemeriksaan Penunjang Telah DiBerikan:</label>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<textarea class="form-control" id="penunjang" name="penunjang" required><?php echo post('penunjang') ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="kdFaskes">Catatan:</label>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<textarea class="form-control" id="catatan" name="catatan" required><?php echo post('catatan') ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									&nbsp;
								</div>
								<div class="col-md-3">
									<button type="submit" class="btn btn-success">Rujuk</button>
								</div>
							</div>
						</div>
					</div>
					<?php 
						}else{
					?>
						<div class="form-group row">
								<div class="col-md-12" style="text-align: center;margin: 10px;">
									<label for="kdFaskes">Layanan Rujukan Online Sementara ditutup, atau sedang ada proses Verifikasi, Harap Tunggu Beberapa menit.</label>
								</div>
							</div>
					<?php 
						}
					?>
				</form>
			</div>
		</div>	
	</div>
</div>
</div>