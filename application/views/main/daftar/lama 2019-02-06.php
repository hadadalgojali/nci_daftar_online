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

			<h4> <strong>Pendaftaran </strong>Pasien Lama</h4>

			<div class="menu-left" style="padding: 0px !important;">

				

				<form id="form" class="form-signin" method="POST" autocomplete="off" action="<?php echo base_url()?>index.php/daftar/saveLama">

					
					<?php 

						$now=new DateTime();

						if($now->format('HH')<=7 || $now->format('HH')>=12)

						// {

							// echo '<br><center><label style="color:red;font-size:20px;"><blink>Pendaftaran di mulai jam 07.00 WIB sampai 12.00 WIB</blink></label></center>';



						// }else

						{

					?>

					<div class="menu-left-head sub">
						<div style="padding-top:7px; padding-bottom:7px; padding-left:2px;">
							<span class="glyphicon glyphicon-user"></span> &nbsp;<strong>Data</strong> Pasien
						</div>

						<div class="menu-left" style="padding: 10px;">

							<div class="row">

								<div class="col-md-6">

								<fieldset>

									<div class='form-group row'>

										<div class="col-md-4">

											<label for="tglReg">Tgl. Lahir:</label>

										</div>

										<div class="col-xs-8">

											<div id="tgllahira" class="input-group date">
<!--
												<input type="text"  data-format="dd-MM-yyyy" class="form-control add-on " value="<?php echo post('tgllahir') ?>" id="tgllahir" name="tgllahir" placeholder="(dd-mm-yyyy)" />

												<span class=" input-group-addon">

													<span class="glyphicon glyphicon-calendar"></span>

												</span>

-->
												 <input type="text" class="form-control item" value="<?php echo post('tgllahir') ?>"  id="tgllahir" placeholder="(dd-mm-yyyy)">
											</div>

											<script type="text/javascript">

											 /* $(function() {

												$('#tgllahira').datetimepicker({

												  language: 'pt-BR'

												}).on('changeDate', function(){

												       $('.bootstrap-datetimepicker-widget').hide();

												   });

											  });*/

											 </script>

										</div>

									</div>

									<div class="form-group row" style="display: none;">

										<div class="col-md-4">

											<label for="jk">Jenis Kelamin:</label>

										</div>

										<div class="col-md-8">

										<?php

											//if(post('jk')!= null && post('jk')=='GENDER_P'){
											if(post('jk')!= null && ((post('jk')==f) || (post('jk')=='f'))){

										?>	

											<input type="radio" name="jk" value="t" aria-label="..."> Laki-laki  <br>

											<input type="radio" name="jk" value="f" aria-label="..."  checked> Perempuan 

										<?php

											}else{

										?>

											<input type="radio" name="jk" value="t" aria-label="..."   checked> Laki-laki  <br>

											<input type="radio" name="jk" value="f" aria-label="..."> Perempuan 

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

											<label for="provinsi">No. Medrec:</label>

										</div>

										<div class="col-xs-8">
											<input type="text" class="form-control" id="txtMedrec"  name="txtMedrec" placeholder="(0-00-00-00)">
											
											<input type="hidden" id="rm" name="rm" value="<?php echo post('rm') ?>" style="width: 100%">

											<input type="hidden" id="hiddenRm" name="hiddenRm" value="<?php echo post('hiddenRm') ?>" >
											
											<script>

												/* $('#rm').select2({

													  ajax: {

														url: "<?php echo base_url()?>/index.php/daftar/getPatientList",

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

													   url: '<?php echo base_url()?>/index.php/daftar/getPatient',

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

														   console.log(o.blod);

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

												?> */

											</script>

										</div>

									</div>
									
									<div class="form-group row" style="margin-bottom:20px;">

										<div class="col-md-4">
											&nbsp;
										</div>

										<div class="col-md-8">
												<a href="javascript: cariPasien();">
													<button type="button" class="btn btn-primary " style="border-radius: 10px;"> Cari &nbsp;  <span class="glyphicon glyphicon-search"></span> </button> 
												</a>
												
											<script>
												function cariPasien(){
													var medrec_temp = formatnomedrec($('#txtMedrec').val());
													$('#txtMedrec').val(medrec_temp);
													
													if($('#txtMedrec').val() !='' && $('#tgllahir').val() != ''){
														console.log($('#txtMedrec').val(),$('#tgllahir').val());
														$.ajax({

														   url: '<?php echo base_url()?>/index.php/daftar/getPatientNew',

														   data: {

															  no_medrec: $('#txtMedrec').val(),
															  tgl_lahir: $('#tgllahir').val()

														   },

														   error: function() {

														   },

														   dataType: 'json',

														   success: function(data) {
																if(data.result == 'WARNING'){
																	$('#alamat').val('');
																	 $('#nama').val('');
																	 $('#telepon').val('');
																	$('#myModal_MessageWarningDataPasien').modal();
																}else{
																	var o=data.data;
																	$('#rm').val(o.rm);
																   $('#gelar').val(o.gelar);

																   $('#nama').val(o.nama);

																   $('#tampatLahir').val(o.tmpLahir);

																   $('#tgllahir').val(o.tglLahir);

																   $('#agama').val(o.religion);

																   console.log(o.blod);

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
																}
															   

														   },

														   type: 'GET'

														});

													}else{
														$('#myModal_MessageWarning').modal();
													}
												} 
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

									
									<!-- end tambah button cari pasien-->
									
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

											<label for="kdfaskes_lama">Golongan Darah:</label>

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

											<label for="nama">Nama Lengkap:</label>

										</div>

										<div class="col-md-8">

											<input type="text" readonly="true" maxlength="32" class="form-control" id="nama" value="<?php echo post('nama') ?>" name="nama" >

										</div>

									</div>
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

														url: "<?php echo base_url()?>/index.php/daftar/getCountry",

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

														url: "<?php echo base_url()?>/index.php/daftar/getProvince",

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

														url: "<?php echo base_url()?>/index.php/daftar/getDistrict",

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

														url: "<?php echo base_url()?>/index.php/daftar/getDistricts",

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

														url: "<?php echo base_url()?>/index.php/daftar/getKelurahan",

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

					<!-- HIDDEN -->



									<input type="hidden"  readonly="true" maxlength="66" class="form-control" id="hidden_kd_rujukan_lama" value="" name="hidden_kd_rujukan_lama" required  style="display:none">



									<input type="hidden"  readonly="true" maxlength="66" class="form-control" id="hidden_kd_diagnosa_lama" value="" name="hidden_kd_diagnosa_lama" required  style="display:none">



									<input type="hidden"  readonly="true" maxlength="66" class="form-control" id="hidden_kd_kelas_lama" value="" name="hidden_kd_kelas_lama" required  style="display:none">



									<input type="hidden"  readonly="true" maxlength="66" class="form-control" id="hidden_kd_poli_lama" value="" name="hidden_kd_poli_lama" required  style="display:none"> 

									<input type="hidden"  readonly="true" maxlength="26" class="form-control" id="hidden_nilai_faskes_lama" value="" name="hidden_nilai_faskes_lama" required  style="display:none"> 



								<!-- HIDDEN -->

					<div class="menu-left-head sub">
						<div style="padding-top:7px; padding-bottom:7px; padding-left:2px;">
							<span class="glyphicon glyphicon-list-alt"></span> &nbsp;<strong>Data</strong> Kunjungan
						</div>
						
						<div class="menu-left" style="padding: 10px;">

							<div class="row">

								<div class="col-md-6">

									<div class="form-group row">

										<div class="col-md-4">

											<label for="kelurahan">Penjamin:</label>

										</div>

										<div class="col-xs-8">

											<input type="hidden" id="kelompok" name="kelompok" value="<?php echo post('kelompok') ?>" style="width: 100%">

											<input type="hidden" id="hiddenKelompok" value="<?php echo post('hiddenKelompok') ?>" name="hiddenKelompok" >

											<script>

											var bpjs;

											var kd_bpjs;

												$('#kelompok').select2({

													  ajax: {

														url: "<?php echo base_url()?>/index.php/daftar/getCustomer",

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

												}).on("change", function (e){

													console.log(e);

													$.ajax({

													    type:"POST",

													    url: "<?php echo base_url()?>/index.php/daftar/getCustomer_bpjs",

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
														
   													  	document.getElementById("AreaBpjs").style.display='block';
   													  	document.getElementById("lbl_no_kartu").style.display='block';

														 document.getElementById("no_kartu").style.display='block';

														 document.getElementById("lbl_no_rujukan_lama").style.display='block';

														 document.getElementById("no_rujukan_lama").style.display='block';

														 document.getElementById("lbl_kelas_lama").style.display='block';

														 document.getElementById("kelas_lama").style.display='block';

														 document.getElementById("lbl_faskes_lama").style.display='block';

														 document.getElementById("faskes_lama").style.display='block';

														 document.getElementById("lbl_diagnosa_lama").style.display='block';

														 document.getElementById("diagnosa_lama").style.display='block';

														 document.getElementById("lbl_poli_lama").style.display='block';

														 document.getElementById("poli_lama").style.display='block';

														 document.getElementById("btn_cek_no_kartu_lama").style.display='block';
														 document.getElementById("div_id_faskes_lama").style.display='block';
														 
														 document.getElementById("lbl_tgl_rujukan_lama").style.display='block';
														 document.getElementById("tgl_rujukan_lama").style.display='block';
															document.getElementById("konten_NoDPJP_lama").style.display='block';
   													  }else {

   													  	 	console.log('else');
															document.getElementById("AreaBpjs").style.display='none';
   													  	 document.getElementById("lbl_no_kartu").style.display='none';

														 document.getElementById("no_kartu").style.display='none';

														 document.getElementById("lbl_no_rujukan_lama").style.display='none';

														 document.getElementById("no_rujukan_lama").style.display='none';

														 document.getElementById("lbl_kelas_lama").style.display='none';

														 document.getElementById("kelas_lama").style.display='none';

														 document.getElementById("lbl_faskes_lama").style.display='none';

														 document.getElementById("faskes_lama").style.display='none';

														 document.getElementById("lbl_diagnosa_lama").style.display='none';

														 document.getElementById("diagnosa_lama").style.display='none';

														 document.getElementById("lbl_poli_lama").style.display='none';

														 document.getElementById("poli_lama").style.display='none';

														 document.getElementById("btn_cek_no_kartu_lama").style.display='none';

														 document.getElementById("div_id_faskes_lama").style.display='none';
														 document.getElementById("lbl_tgl_rujukan_lama").style.display='none';
														 document.getElementById("tgl_rujukan_lama").style.display='none';
														 document.getElementById("konten_NoDPJP_lama").style.display='none';


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



									<div class="form-group row">

										<div class="col-md-4">

											<label for="kdfaskes_lama">Keluhan:</label>

										</div>

										<div class="col-md-8">

											<textarea class="form-control" id="keluhan" name="keluhan" style="text-transform:uppercase;" required><?php echo post('keluhan') ?></textarea>

										</div>

									</div>

									

									<div class='form-group row'>

										<div class="col-md-4">

											<label for="tglReg">Tanggal Berobat:</label>

										</div>

										<div class="col-xs-8">

											<div id="datetimepicker" class="input-group date">

												<input type="text"  data-format="dd-MM-yyyy" class="form-control add-on " value="<?php echo post('tglReg') ?>" id="tglReg" name="tglReg"  />

												<span class="input-group-addon">

													<span class="glyphicon glyphicon-calendar"></span>

												</span>


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
													now.setDate(now.getDate()+1); //date + 1
													var tgl_tmp = ("0" + (now.getDate())).slice(-2); // format 2 digit
													var bulan_tmp = ("0" + (now.getMonth()+1)).slice(-2); //format 2 digit
													$('#tglReg').val(tgl_tmp+'-'+bulan_tmp+'-'+now.getFullYear()); 
													$("#tglReg").prop('disabled', true); //disable tgl berobat
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

											<input type="text"  maxlength="16" class="form-control" id="telepon" value="<?php echo post('telepon') ?>" name="telepon" onkeypress="return hanyaAngka(event)" required>

										</div>

									</div>

									<div class="form-group row">

										<div class="col-md-4">

											<label for="kelurahan">Poliklinik:</label>

										</div>

										<div class="col-xs-8">

											<input type="hidden" id="poliklinik" name="poliklinik" value="<?php echo post('poliklinik') ?>" style="width: 100%">

											<input type="hidden" id="hiddenPoliklinik" value="<?php echo post('hiddenPoliklinik') ?>" name="hiddenPoliklinik" >

											<script>

												$('#poliklinik').select2({

													  ajax: {

														url: "<?php echo base_url()?>/index.php/daftar/getUnit",

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
														console.log('test1');
													$('#hiddenPoliklinik').val(e.added.text); 
														console.log('test2');
													$('#hiddenDokter').val('45'); 
													$('#dokter').val('45'); 
														console.log('test3');

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

									<div class="form-group row" style="display:none;">

										<div class="col-md-4">

											<label for="dokter">Dokter:</label>

										</div>

										<div class="col-xs-8">

											<input type="hidden" id="dokter" name="dokter" value="<?php echo post('dokter') ?>" style="width: 100%">

											<input type="hidden" id="hiddenDokter" value="<?php echo post('hiddenDokter') ?>" name="hiddenDokter" >

											<script>

												$('#dokter').select2({

													  ajax: {

														url: "<?php echo base_url()?>/index.php/daftar/getDokter",

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
										console.log('test');
										$('#div-cek-error').hide();

										$('#div-cek-success').hide();

										if($('#dokter').val() !='' && $('#poli_lamaklinik').val() !='' && $('#tglReg').val() !=''){

											$.ajax({

											   url: '<?php echo base_url()?>/index.php/daftar/cekAntrian',

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

									

								</div>



								<div class="col-md-6">

									<div class="form-group row">

										<div class="col-md-4">

											<label for="no_kartu" id="lbl_no_kartu" style="display:none"> No Kartu Peserta BPJS:</label>

										</div>

										<div class="col-md-8">

											<input type="text"  maxlength="26" class="form-control" id="no_kartu" value="" name="no_kartu"   style="display:none"> 

										</div>
									</div>
									
									<div class="form-group row" id="div_id_faskes_lama" style="display:none">

										<div class="col-md-4">

											<label for="jk">Faskes :</label>

										</div>

										<div class="col-md-4">
											<input type="radio" name="rbfaskeslama" value="1" id="rbfaskes1_lama" aria-label="..." checked> 1  <br>
											<input type="radio" name="rbfaskeslama" value="2" id="rbfaskes2_lama" aria-label="..."  > 2 	
										</div>
										
										<div class="col-md-4">
											<a href="javascript: sendSms();">
												<button type="button" id="btn_cek_no_kartu_lama" class="btn btn-primary " style="display:none" value="Cek" onclick="javascript: cek_no_kartu();" > Cek &nbsp;<span class="glyphicon glyphicon-refresh"> </span> </button> 
											</a>
										</div>
										

									</div>

								</div>
									
								<div class="col-md-6">

									<div class="form-group row">

										<div class="col-md-4">

											<label for="lbl_no_rujukan_lama" id="lbl_no_rujukan_lama" style="display:none">No Rujukan:</label>

										</div>

										<div class="col-md-8">

											<input type="text"  readonly="true" maxlength="26" class="form-control" id="no_rujukan_lama" value="" name="no_rujukan_lama" required  style="display:none"> 

										</div>

									</div>

								</div>

								<!-- TAMBAH ATRIBUT TGL RUJUKAN -->
								<div class="col-md-6" style="display:none" id="AreaBpjs">
									<div class="form-group row">
										<div class="col-md-4">
											<label for="lbl_tgl_rujukan_lama" id="lbl_tgl_rujukan_lama" style="display:none">Tgl. Rujukan:</label>
										</div>
										<div class="col-md-8">
											<input type="text"  readonly="true" maxlength="26" class="form-control" id="tgl_rujukan_lama" value=""
											 name="tgl_rujukan_lama" required  style="display:none"> 
										</div>
									</div>
									<div class="form-group row">

										<div class="col-md-4">

											<label for="lbl_faskes_lama" id="lbl_faskes_lama" style="display:none">Faskes Asal:</label>

										</div>

										<div class="col-md-8">

											<input type="text"  readonly="true" maxlength="26" class="form-control" id="faskes_lama" value="" name="faskes_lama" required  style="display:none"> 

										</div>

									</div>
									<div class="form-group row">

										<div class="col-md-4">

											<label for="lbl_kelas_lama" id="lbl_kelas_lama" style="display:none">Kelas:</label>

										</div>

										<div class="col-md-8">

											<input type="text"  readonly="true" maxlength="26" class="form-control" id="kelas_lama" value="" name="kelas_lama" required  style="display:none"> 

										</div>

									</div>
									<div class="form-group row">

										<div class="col-md-4">

											<label for="lbl_diagnosa_lama" id="lbl_diagnosa_lama" style="display:none">Diagnosa:</label>

										</div>

										<div class="col-md-8">

											<input type="text"  readonly="true" maxlength="26" class="form-control" id="diagnosa_lama" value="" name="diagnosa_lama" required  style="display:none"> 

										</div>

									</div>
									<div class="form-group row">

										<div class="col-md-4">

											<label for="lbl_poli_lama" id="lbl_poli_lama" style="display:none">Poliklinik Rujukan:</label>

										</div>

										<div class="col-md-8">

											<input type="text"  readonly="true" maxlength="26" class="form-control" id="poli_lama" value="" name="poli_lama" required  style="display:none"> 

										</div>

									</div>
									
									<div class="form-group row" id ="konten_NoDPJP_lama" style="display:none">
										<div class="col-md-4">
											<label for="kelurahan" >Pemberi Surat:</label>
										</div>

										<div class="col-xs-8">

											<input type="hidden" id="NoDPJP_lama" name="NoDPJP_lama" value="<?php echo post('NoDPJP_lama') ?>" style="width: 100%">

											<input type="hidden" id="hiddenNoDPJP_lama" value="<?php echo post('hiddenNoDPJP_lama') ?>" name="hiddenNoDPJP_lama" >

											<script>
												$('#NoDPJP_lama').select2({
													  ajax: {
														url: "<?php echo base_url()?>/index.php/daftar/getNoDPJP",
														dataType: 'json',
														delay: 2000,
														data: function (params) {
															return {
																text: params,
																poli: $('#hidden_kd_poli_lama').val()
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
													console.log(e);
													$('#hiddenNoDPJP_lama').val(e.added.id); 
													$('#div-cek-error').hide();
												});

												<?php
													if(post('NoDPJP_lama') != null){
												?>
														$('#NoDPJP_lama').select2('data', {id: '<?php echo post('NoDPJP_lama') ?>', text: '<?php echo post('hiddenNoDPJP_lama'); ?>'});
												<?php
													}
													if($this->input->get('kode') != null){
												?>
														$('#NoDPJP_lama').select2('data', {id: '<?php echo$this->input->get('kode') ?>', text: '<?php echo $this->input->get('nama') ?>'});
														$('#hiddenNoDPJP_lama').val('<?php echo $this->input->get('kode') ?>');
														console.log($('#hiddenNoDPJP_lama').val());
												<?php 
													}
												?> 
											</script>
										</div>
									</div>
								</div>
							</div>
							<div style="margin-top:-5px; margin-bottom:-5px;">
								<hr/>
							</div>
							<div  id="divBtnDaftar">

								<div class="menu-left" >

									<div class="form-group row">
										<div class="col-md-2">
										</div>
										<div class="col-md-4">

											<a href="javascript: sendSms();">
												<button type="button" class="btn btn-success " style="border-radius: 10px;"> Daftar &nbsp;<span class="glyphicon glyphicon-edit"> </span> </button> 
											</a>
											<script>

												function sendSms(){

													if($('#telepon').val() !='' && $('#telepon').val() != ''){

														if(kd_bpjs==1){
															if($('#no_rujukan_lama').val() !='' && $('#hiddenNoDPJP_lama').val() != '' ){
																$.ajax({
																   url: '<?php echo base_url()?>/index.php/daftar/sendSms',
																   data: {
																	  telepon: $('#telepon').val(),
																	  nama: $('#nama').val(),
																	  // poli_lamaklinik: $('#poli_lamaklinik').val(),
																	  // hiddenpoli_lamaklinik: $('#hiddenpoli_lamaklinik').val(),
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
																$('#divBtnVerifikasi').hide();
																$('#div-cek-error .message').html('Data belum lengkap, Harap Periksa Kembali!.');
															}
														
														}else{
															$.ajax({
															   url: '<?php echo base_url()?>/index.php/daftar/sendSms',
															   data: {
																  telepon: $('#telepon').val(),
																  nama: $('#nama').val(),
																  // poli_lamaklinik: $('#poli_lamaklinik').val(),
																  // hiddenpoli_lamaklinik: $('#hiddenpoli_lamaklinik').val(),
																  // tglReg: $('#tglReg').val(),
															   },
															   type:'POST',
															   error: function() {
																	$('#divBtnVerifikasi').hide();
																	$('#divBtnDaftar').show();
																	$('#div-cek-error').show();
																	$('#div-cek-error .message').html('Aplikasi Error Hubungi Admin');
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
														}

													}else{

														$('#div-cek-error').show();

														$('#divBtnDaftar').show();

														$('#divBtnVerifikasi').hode();

														$('#div-cek-error .message').html('Data belum lengkap, Harap Periksa Kembali!.');

													}

												}

											</script>

										</div>

									</div>

								</div>

							</div>

							<div  id="divBtnVerifikasi" style="display: none;">

								<div class="menu-left" style="padding-bottom: 10px;padding-left: 10px;">

									<div class="form-group row">
										<div class="col-md-6">

											<input type="text" name="captcha" placeholder="<?php 

												echo 'Masukan Kode Verifikasi'

											?>"  class="form-control">

										</div>
									</div>
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

									

								</div>

							</div>

						</div>

					</div>

					<?php } ?>

				</form>

			</div>
			
			<!-- Modal -->
		  <div class="modal fade" id="myModal_MessageWarning" role="dialog">
			<div class="modal-dialog">
			
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Warning</h4>
				</div>
				<div class="modal-body">
				  <p>Harap isi Tanggal Lahir dan No. Medrec untuk melakukan pencarian!</p>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
			  </div>
			  
			</div>
		  </div>
		  
		  <div class="modal fade" id="myModal_MessageWarningDataPasien" role="dialog">
			<div class="modal-dialog">
			
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Data Pasien</h4>
				</div>
				<div class="modal-body">
				  <p>Data Pasien tidak ditemukan!</p>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
			  </div>
			  
			</div>
		  </div>
		  
		  
		</div>

				

	</div>

</div>

</div>

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
 <script src="<?php echo base_url()?>vendor/script_birth_date.js"></script>

<script type="text/javascript">

	
	function cek_no_kartu(){

		var kd_poli=null;
		var nilai_faskes='1';
		if (document.getElementById('rbfaskes1_lama').checked) {
			nilai_faskes = document.getElementById('rbfaskes1_lama').value;
		}else if(document.getElementById('rbfaskes2_lama').checked){
			nilai_faskes = document.getElementById('rbfaskes2_lama').value;
		}
			
			
		if($('#no_kartu').val() !='' && $('#no_kartu').val() != ''){

			$.ajax({

				url: '<?php echo base_url()?>/index.php/daftar/cek_no_kartu',

					data: {

							no_kartu: $('#no_kartu').val(),
							nilai_faskes: nilai_faskes,
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

								console.log(data);

								$('#no_rujukan_lama').val(data.resp.response.rujukan.noKunjungan);

								$('#kelas_lama').val(data.resp.response.rujukan.peserta.hakKelas.keterangan);

								$('#diagnosa_lama').val(data.resp.response.rujukan.diagnosa.nama);

								$('#poli_lama').val(data.resp.response.rujukan.poliRujukan.nama);

								$('#faskes_lama').val(data.resp.response.rujukan.provPerujuk.nama);

								//HIDDEN

								$('#hidden_kd_rujukan_lama').val(data.resp.response.rujukan.provPerujuk.kode);

								$('#hidden_kd_diagnosa_lama').val(data.resp.response.rujukan.diagnosa.kode);

								$('#hidden_kd_kelas_lama').val(data.resp.response.rujukan.peserta.hakKelas.kode);

								$('#hidden_kd_poli_lama').val(data.resp.response.rujukan.poliRujukan.kode);

								kd_poli=data.resp.response.rujukan.poliRujukan.kode;

								auto_poli_bpjs(kd_poli);
								
								//2018-11-29
								$('#hidden_nilai_faskes_lama').val(nilai_faskes);
								$('#tgl_rujukan_lama').val(data.resp.response.rujukan.tglKunjungan);
								$('#div-cek-error').hide();

							}else if(status=='201'){
								
								$('#no_rujukan_lama').val('');
								$('#tgl_rujukan_lama').val('');
								$('#faskes_lama').val('');
								$('#kelas_lama').val('');
								$('#diagnosa_lama').val('');
								$('#poli_lama').val('');
								$('#poliklinik').val('');
								alert(data.resp.metaData.message);


							}

						},

			});

		}else{



		}

	}

	

</script>



<script>

function auto_poli_bpjs(kd_poli){

	console.log(kd_poli);

		$.ajax({

				url: '<?php echo base_url()?>/index.php/daftar/getKdPoliBPJS',

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
function hanyaAngka(evt) {
	
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
  return false;
  return true;

}
function str_pad(input, pad_length, pad_string, pad_type) {


  var half = '',
    pad_to_go;

  var str_pad_repeater = function(s, len) {
    var collect = '',
      i;

    while (collect.length < len) {
      collect += s;
    }
    collect = collect.substr(0, len);

    return collect;
  };

  input += '';
  pad_string = pad_string !== undefined ? pad_string : ' ';

  if (pad_type !== 'STR_PAD_LEFT' && pad_type !== 'STR_PAD_RIGHT' && pad_type !== 'STR_PAD_BOTH') {
    pad_type = 'STR_PAD_RIGHT';
  }
  if ((pad_to_go = pad_length - input.length) > 0) {
    if (pad_type === 'STR_PAD_LEFT') {
      input = str_pad_repeater(pad_string, pad_to_go) + input;
    } else if (pad_type === 'STR_PAD_RIGHT') {
      input = input + str_pad_repeater(pad_string, pad_to_go);
    } else if (pad_type === 'STR_PAD_BOTH') {
      half = str_pad_repeater(pad_string, Math.ceil(pad_to_go / 2));
      input = half + input + half;
      input = input.substr(0, pad_length);
    }
  }

  return input;
}
function formatnomedrec(noMedrec){
	if(noMedrec.length !== 0 && noMedrec.length < 10){
		var retVal=str_pad(noMedrec,7,'0','STR_PAD_LEFT');
		var getnewmedrec = retVal.substr(0,1) + '-' + retVal.substr(1,2) + '-' + retVal.substr(3,2) + '-' + retVal.substr(-2);
	}else{
		if (noMedrec.length === 10){
			var getnewmedrec = noMedrec;
		}else{
			var getnewmedrec = '';
		}
	}
	
	return getnewmedrec;
}											


</script>
