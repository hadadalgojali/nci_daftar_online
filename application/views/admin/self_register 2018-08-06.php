<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$tenant=$this->common->getDefaultTenant();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Self Register</title>
	<link href="<?php echo base_url()?>vendor/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url()?>vendor/jquery-ui/css/jquery-ui.min.css" rel="stylesheet">
	<link href="<?php echo base_url()?>vendor/Keyboard-master/css/keyboard.min.css" rel="stylesheet">
	<script src="<?php echo base_url()?>vendor/bootstrap-3.3.4-dist/js/jquery.min.js"></script>
	<script src="<?php echo base_url()?>vendor/jquery-ui/js/jquery-ui.min.js"></script>
	<script src="<?php echo base_url()?>vendor/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url()?>vendor/Keyboard-master/js/jquery.keyboard.min.js"></script>
	<style>
		.form-group{
			font-size:25px;
		}
		.alert{
			font-size:20px;
		}
		.ui-widget-content{
			background:white;
			color:black;
		}
	</style>
</head>
<body>
<div style="background:#f0ad4e;height: 50px;border: 1px solid #eea236;position:fixed;bottom: 0px; left: 0px; right: 0px;">
</div>
<div style="background:#f0ad4e;height: 80px;border: 1px solid #eea236;">
        <div class="navbar-brand" style="float:left;background:#5cb85c;border-radius: 0px 0px 100px 0px;height: 100px;border: 1px solid #398439;box-shadow: 1px 1px 1px #398439;">
            <div style="float:left;width: 100px;" class="hidden-xs">
				<img src="<?php echo base_url()?>include/logo.png" style="width: 100px;">
			</div>
			<div class="navbar-brand" style="float:left;font-size:30px;font-weight: bold;text-shadow: 1px 1px 1px white;">
				<?php echo $tenant->getTenantName(); ?>
				<br /><div style="margin-top: 5px;font-size: 13px;font-weight: normal;"><?php echo $tenant->getTenantAddress(); ?>, Kota <?php echo $tenant->getCity(); ?>.</div>
				<div style="font-size: 13px;font-weight: normal;">Telp. <?php echo $tenant->getPhoneNumber1(); ?>, Fax. <?php echo $tenant->getFaxNumber1(); ?>.</div>
			</div>
		</div>
		<b><div style="font-size:45px;text-align: right;margin-right: 10px;margin-top: 5px;color:white;text-shadow: 2px 2px 2px #398439;">SELF REGISTER</div></b>
</div>
<div class="container" style="padding-top: 50px;">
	<div id="div-input" style="padding-top: 100px;">
		<center><i><h3 class="form-signin-heading">MASUKAN NOMOR PENDAFTARAN :</h3></i></center>
		<div style="width: 710px;margin-left: auto; margin-right: auto;">
			<input type="text" id="nomorPendaftaran" style="width: 600px; height: 70px;font-size:45px;float:left;" placeholder="Nomor Pendaftaran" name="nomorPendaftaran" class="form-control">
			<button id="btnSearch" type="button" style="float:left;margin-left: 10px;height: 70px;font-size:30px;" class="btn btn-success">CARI</button>
		</div>
	</div>
	<div id="div-loading" style="display: none;">
		<center><i><h3 class="form-signin-heading">SEDANG MENCARI . . . .</h3></i></center>
		<center><button id="btnCancel" type="button" style="height: 70px;font-size:30px;" class="btn btn-warning">Kembali</button></center>
	</div>
	<div id="div-output" style="display: none;margin-left: auto; margin-right: auto;width: 700px;">
		<div class="form-group row">
			<div class="col-md-4">
				<label for="t-nama">Nama Pasien :</label>
			</div>
			<div class="col-md-8" id="t-nama">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-4">
				<label for="t-tgllahir">Tanggal Lahir :</label>
			</div>
			<div class="col-md-8" id="t-tgllahir">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-4">
				<label for="gelar">Klinik Tujuan :</label>
			</div>
			<div class="col-md-8" id="t-klinik">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-4">
				<label for="gelar">Nama Dokter :</label>
			</div>
			<div class="col-md-8" id="t-dokter">awdwd
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-4">
				<label for="gelar">Nomor Antrian :</label>
			</div>
			<div class="col-md-8" id="t-antrian">
			</div>
		</div>
		<button id="btnBatal" type="button" style="height: 70px;font-size:30px;" class="btn btn-warning">Kembali</button>
		<button id="btnDaftar" type="button" style="height: 70px;font-size:30px;" class="btn btn-success">Daftar</button>
	</div>
	<div id="div-message-warning" style="display:none;">
		<div class="alert alert-danger warning" role="alert" >
		</div>
		<button id="btnKembali" type="button" style="height: 70px;font-size:30px;" class="btn btn-warning">Kembali</button>
	</div>
	<div id="div-message-success" style="display:none;">
		<div class="alert alert-success success" role="alert" >
		</div>
		<button id="btnKembaliWarning" type="button" style="height: 70px;font-size:30px;" class="btn btn-warning">Kembali</button>
	</div>
	<div id="div-confirm" style="display: none;margin-left: auto; margin-right: auto;width: 500px;">
		<div class="form-group row">
			<div class="col-md-12">
				<label for="t-nama">Apakah data yang di tampilkan sudah benar?</label>
			</div>
		</div>
		<button id="btnTidak" type="button" style="height: 70px;font-size:30px;" class="btn btn-warning">Tidak</button>
		<button id="btnYa" type="button" style="height: 70px;font-size:30px;" class="btn btn-success">Ya</button>
	</div>
		<script>
		var batal=false;
		var timeOut=null;
		$(function(){
			$('#nomorPendaftaran').keyboard({
				layout: 'custom',
				customLayout : {
					'normal': [
						'1 2 3 4 5 6 7 8 9 0 {bksp}',
						'{accept}'
					]
				}
			});
			$('#btnBatal, #btnCancel, #btnKembali, #btnTidak, #btnKembaliWarning').bind('click',function(){
				resetAll();
			});
			$('#btnDaftar').bind('click',function(){
				$('#div-output').hide();
				$('#div-confirm').fadeIn();
			});
			$('#btnDaftar').bind('click',function(){
				$('#div-output').hide();
				$('#div-confirm').fadeIn();
			});
			$('#btnYa').bind('click',function(){
				$('#div-confirm').hide();
				$('#div-loading').fadeIn();
				batal=false;
				$.ajax({
					url:'<?php echo base_url(); ?>app/rs2/setNomorPendaftaran',
					data:{noRegister:$('#nomorPendaftaran').val()},
					type:'GET',
					dataType:'JSON',
					success:function(r){
						console.log('t');
						if(r.SUCCESS=='true'){
							if(batal==false){
								var o=r.data;
								$('#div-loading').hide();
								$('#div-message-success').fadeIn();
								$('.success').html('Pendaftaran Berhasil, Harap tunggu di antrian.');
								timeOut=setTimeout(function(){
									resetAll();
								},3000);
							}
						}else{
							console.log('f');
							$('#div-loading').hide();
							$('#div-message-warning').fadeIn();
							$('.warning').html(r.message);
							timeOut=setTimeout(function(){
								resetAll();
							},3000);
						}
					},
					error:function(jqXHR, exception){
						console.log('error');
						resetAll();
					}
				});
			});
			$('#btnSearch').bind('click',function(){
				$('#div-input').hide();
				$('#div-loading').fadeIn();
				batal=false;
				$.ajax({
					url:'<?php echo base_url(); ?>app/rs2/getNomorPendaftaran',
					data:{noRegister:$('#nomorPendaftaran').val()},
					type:'GET',
					dataType:'JSON',
					success:function(r){
						if(r.result=='SUCCESS'){
							if(batal==false){
								var o=r.data;
								$('#div-loading').hide();
								$('#div-output').fadeIn();
								$('#t-nama').html(o.f1);
								$('#t-tgllahir').html(o.f2);
								$('#t-klinik').html(o.f3);
								$('#t-dokter').html(o.f4);
								$('#t-antrian').html(o.f5);
							}
						}else{
							$('#div-loading').hide();
							$('#div-message-warning').fadeIn();
							$('.warning').html(r.message);
							timeOut=setTimeout(function(){
								resetAll();
							},3000);
						}
					},
					error:function(jqXHR, exception){
						resetAll();
					}
				});
			});
			function resetAll(){
				$('#div-output').hide();
				$('#div-loading').hide();
				$('#div-message-warning').hide();
				$('#div-message-success').hide();
				$('#div-confirm').hide();
				$('#div-input').fadeIn();
				$('#nomorPendaftaran').val('');
				clearTimeout(timeOut);
				batal=true;
			}
		});
	</script>
</body>
</html>