<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$em = $this->doctrine->em;
$now=new DateTime();
$faskesAccount=$em->find ( 'Entity\content\FaskesAccount',$this->session->get('PUSKESMAS'));
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
<script src="<?php echo base_url()?>vendor/select2-3.5.4/select2.js"></script>
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
			<h5> <strong>Rujukan</strong> Balik</h5>
			<div class="menu-left" style="padding: 0px !important;">
				<form id="form" class="form-signin" method="POST" autocomplete="off" action="<?php echo base_url()?>puskesmas/saveRujukan">
					<div class="menu-left-head sub">
						<strong>Data</strong> Pasien
						<div class="menu-left" style="padding: 10px;">
							<div class="form-group row">
								<div class="col-md-2">
									<label for="provinsi">No Rujukan:</label>
								</div>
								<div class="col-md-4">
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
												   $('#alamat').val(o.address);
												   $('#rt').val(o.rt);
												   $('#rw').val(o.rw);
												   $('#negara').select2('data', {id: o.countryId, text: o.countryName});
												   $('#provinsi').select2('data', {id: o.provinceId, text: o.provinceName});
												   $('#kota').select2('data', {id: o.districtId, text: o.districtName});
												   $('#kecamatan').select2('data', {id: o.districtsId, text: o.districtsName});
												   $('#kelurahan').select2('data', {id: o.kelurahanId, text: o.kelurahanName});
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
								<div class="col-md-2">
									<label for="nama">Nama Lengkap:</label>
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control" id="nama" value="<?php echo post('nama') ?>" name="nama" required>
								</div>
							</div>
						</div>
					</div>
					<div class="menu-left-head sub">
						<strong>Penanganan</strong> Pasien
						<div class="menu-left" style="padding: 10px;">
							<div class="form-group row">
								<div class="col-md-2">
									<label for="negara">Diagnosa ICDX:</label>
								</div>
								<div class="col-md-4">
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
									<label for="terapi">Terapi:</label>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<textarea class="form-control" id="terapi" name="terapi" required><?php echo post('terapi') ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="obat">Tindak Lanjut Obat:</label>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<textarea class="form-control" id="obat" name="obat" required><?php echo post('obat') ?></textarea>
								</div>
							</div>
							<div class='form-group row'>
								<div class="col-md-2">
									<label for="tgl">Kontrol Kembali Ke RS:</label>
								</div>
								<div class="col-md-2">
									<div id="datetimepicker" class="input-group date">
										<input type="text"  data-format="dd-MM-yyyy" class="form-control add-on " value="<?php echo post('tgl') ?>" id="tgl" name="tgl" required />
										<span class="add-on input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
									<script type="text/javascript">
									  $(function() {
										$('#datetimepicker').datetimepicker({
										  language: 'pt-BR'
										});
										<?php 
											if(post('tgl') == null){
										?>
											var now=new Date();
											$('#tgl').val(now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear());
										<?php
											}
										?>
									  });
									 </script>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									<label for="inap">Pelu Inap:</label>
								</div>
								<div class="col-md-8">
								<?php
									if(post('inap')!= null && post('inap')=='TIDAK'){
								?>	
									<input type="radio" name="inap" value="YA" aria-label="..."> Ya  <br>
									<input type="radio" name="inap" value="TIDAK" aria-label="..."  checked> Tidak 
								<?php
									}else{
								?>
									<input type="radio" name="inap" value="YA" aria-label="..."   checked> Ya  <br>
									<input type="radio" name="inap" value="TIDAK" aria-label="..."> Tidak 
								<?php
									}
								?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									<label for="inap">Selesai:</label>
								</div>
								<div class="col-md-8">
								<?php
									if(post('selesai')!= null && post('selesai')=='TIDAK'){
								?>	
									<input type="radio" name="selesai" value="YA" aria-label="..."> Ya  <br>
									<input type="radio" name="selesai" value="TIDAK" aria-label="..."  checked> Tidak 
								<?php
									}else{
								?>
									<input type="radio" name="selesai" value="YA" aria-label="..."   checked> Ya  <br>
									<input type="radio" name="selesai" value="TIDAK" aria-label="..."> Tidak 
								<?php
									}
								?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="kdFaskes">Lain- lain:</label>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<textarea class="form-control" id="lain" name="lain" required><?php echo post('lain') ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									&nbsp;
								</div>
								<div class="col-md-3">
									<button type="submit" class="btn btn-success">Rujuk Balik</button>
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