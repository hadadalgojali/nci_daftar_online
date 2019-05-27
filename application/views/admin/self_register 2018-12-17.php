<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$tenant=$this->common->getDefaultTenant();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Self Check In</title>
	<link href="<?php echo base_url()?>vendor/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url()?>vendor/jquery-ui/css/jquery-ui.min.css" rel="stylesheet">
	<link href="<?php echo base_url()?>vendor/Keyboard-master/css/keyboard.min.css" rel="stylesheet">
	<script src="<?php echo base_url()?>vendor/bootstrap-3.3.4-dist/js/jquery.min.js"></script>
	<script src="<?php echo base_url()?>vendor/jquery-ui/js/jquery-ui.min.js"></script>
	<script src="<?php echo base_url()?>vendor/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url()?>vendor/Keyboard-master/js/jquery.keyboard.min.js"></script>
	<script src="<?php echo base_url()?>vendor/qrcode/jsqrcode-combined.min.js"></script>
	<script src="<?php echo base_url()?>vendor/qrcode/html5-qrcode.min.js"></script>
	<style>
		.form-group{
			font-size:18px;
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
<div style="background:#f0ad4e;height: 50px;border: 1px solid #eea236;position:fixed;bottom: 0px; left: 0px; right: 0px;color:white;font-size:20px;">
<marquee>Selamat Datang di <?php echo $tenant->getTenantName(); ?>, Ini adalah Fasilitas Konfirmasi / Self Check In. Pendaftaran Online berlaku hanya untuk Pasien Umum dan Pasien Yang Sudah Terdaftar di 
<?php echo $tenant->getTenantName(); ?>, Fasilitas ini Berguna untuk Efisiensi Pendaftaran langsung, Sehingga tidak perlu Antri di loket Pendaftaran.</marquee>
</div>
<div style="background:#f0ad4e;height: 80px;border: 1px solid #eea236;">
        <div class="navbar-brand" style="float:left;background:white;border-radius: 0px 0px 100px 0px;height: 100px;">
            <div style="float:left;width: 100px;" class="hidden-xs">
				<img src="<?php echo base_url()?>include/logo.png" style="width: 100px;">
			</div>
			<div class="navbar-brand" style="float:left;font-size:30px;font-weight: bold;text-shadow: 1px 1px 1px white;">
				<?php echo $tenant->getTenantName(); ?>
				<br /><div style="margin-top: 5px;font-size: 13px;font-weight: normal;"><?php echo $tenant->getTenantAddress(); ?>, Kota <?php echo $tenant->getCity(); ?>.</div>
				<div style="font-size: 13px;font-weight: normal;">Telp. <?php echo $tenant->getPhoneNumber1(); ?>, Fax. <?php echo $tenant->getFaxNumber1(); ?>.</div>
			</div>
		</div>
		<b><div style="font-size:45px;text-align: right;margin-right: 10px;margin-top: 5px;color:white;text-shadow: 2px 2px 2px #398439;">SELF CHECK IN</div></b>
</div>
<div class="container" style="padding-top: 50px;">
	<div id="div-input" style="padding-top: 1px;">
	<i><h3 class="form-signin-heading"><center>QR Code Scanner</center></h3></i>
		<div id="reader" style="width:300px;height:250px;margin:0 auto"></div>
        <div id="read"></div>
		
	</div>
	<div id="div-input2" style="padding-top: 0px;">
	  <center><i><h3 class="form-signin-heading">MASUKAN NOMOR PENDAFTARAN :</h3></i></center>
		<div style="width: 710px;margin-left: auto; margin-right: auto;">
			<input type="text" id="nomorPendaftaran"  style="width: 600px; height: 70px;font-size:45px;float:left;" placeholder="Nomor Pendaftaran" name="nomorPendaftaran" class="form-control">
			<button id="btnSearch" type="button" style="float:left;margin-left: 10px;height: 70px;font-size:30px;" class="btn btn-success">CARI</button>
		</div>
	</div>
	<div id="div-loading" style="display: none;">
		<center><i><h3 class="form-signin-heading">SEDANG MENCARI . . . .</h3></i></center>
		<center><button id="btnCancel" type="button" style="height: 70px;font-size:30px;" class="btn btn-warning">Kembali</button></center>
	</div>
	<div id="div-loadingCetakSEP" style="display: none;">
		<center><i><h3 class="form-signin-heading">SEDANG MENCETAK SEP . . . .</h3></i></center>
		<center><button id="btnCancel" type="button" style="height: 70px;font-size:30px;" class="btn btn-warning">Kembali</button></center>
	
	</div>
	<div  id="div-output" style="display: none;margin-left: auto; margin-right: auto;width: 700px;">
		<div class="form-group row">
			<div class="col-md-4">
				<label for="t-pendaftaran">No Register :</label>
			</div>
			<div class="col-md-8" id="t-pendaftaran">
			</div>
		</div>

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
	<!-- </div> -->
		<br> <br>

	<!-- <div  id="div-output2" style="display: none;margin-left: auto; margin-right: auto;width: 700px;"> -->
		<div class="form-group row">
			<div class="col-md-4">
				<label for="t-pendaftaran">Kelompok Pasien :</label>
			</div>
			<div class="col-md-8" id="kelompok_pasien">
			</div>
		</div>

		<div class="form-group row">
			<div class="col-md-4">
				<label for="t-nama">No Peserta :</label>
			</div>
			<div class="col-md-8" id="no_peserta">
			</div>
		</div>

		<div class="form-group row">
			<div class="col-md-4">
				<label for="t-tgllahir">No Rujukan :</label>
			</div>
			<div class="col-md-8" id="no_rujukan">
			</div>
		</div>	

		<div class="form-group row">
			<div class="col-md-4">
				<label for="t-tgllahir">Kelas :</label>
			</div>
			<div class="col-md-8" id="kelas">
			</div>
		</div>

		<div class="form-group row">
			<div class="col-md-4">
				<label for="t-tgllahir">Faskes Asal :</label>
			</div>
			<div class="col-md-8" id="faskes_asal">
			</div>
		</div>

		<div class="form-group row">
			<div class="col-md-4">
				<label for="t-tgllahir">Poliklinik Tujuan :</label>
			</div>
			<div class="col-md-8" id="poli_tujuan">
			</div>
		</div>	
		
		<div class="form-group row">
			<div class="col-md-4">
				<label for="t-tgllahir">Diagnosa :</label>
			</div>
			<div class="col-md-8" id="diagnosa">
			</div>
		</div>	
		
		<div class="form-group row">
			<div class="col-md-4">
				<label for="t-tgllahir">Dokter :</label>
			</div>
			<div class="col-md-8" id="dokter">
			</div>
			<div class="col-md-8" id="noSEP_cetak" style="display:none;"></div>
		</div>	
		
		
			
		<button id="btnBatal" type="button" style="height: 70px;font-size:30px;" class="btn btn-warning">Kembali</button>
		<button id="btnDaftar" type="button" style="height: 70px;font-size:30px;" class="btn btn-success">Daftar</button>		
	</div>


	<!--<div id="div-output" style="display: none;margin-left: auto; margin-right: auto;width: 700px;">
		<div class="form-group row">
			<div class="col-md-4">
				<label for="t-pendaftaran">No Register :</label>
			</div>
			<div class="col-md-8" id="t-pendaftaran">
			</div>
		</div>
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
	</div> -->
	<div id="div-message-warning" style="display:none;">
		<div class="alert alert-danger warning" role="alert" >
		</div>
		<button id="btnKembali" type="button" style="height: 70px;font-size:30px;" class="btn btn-warning">Kembali</button>
	</div>
	<div id="div-message-success" style="display:none;">
		<div class="alert alert-success success" role="alert" >
		</div>
		<div class="form-group row">
			<div class="col-md-2">
				<button id="btnKembaliWarning" type="button" style="height: 70px;font-size:30px;" class="btn btn-warning">Kembali</button>
			</div>
			<div class="col-md-4">
				<button id="btnCetakSEP" type="button" style="height: 70px;font-size:30px; display: none;" class="btn btn-success" >Cetak SEP</button>
			</div>
		</div>
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
		var noregis=null;
		var kelompok_pasien=null;

		
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
			$('#reader').html5_qrcode(function(data){
			//$('#nomorPendaftaran').val(data);
			//$('#read').html(data);

			
			
				$('#div-input').hide();
				$('#div-input2').hide();
				
				$('#div-loading').fadeIn();
				batal=false;
				$.ajax({
					url:'<?php echo base_url(); ?>/index.php/app/rs2/getNomorPendaftaran?noRegister='+data,
					//data:'noRegister='+data,
					type:'GET',
					dataType:'JSON',
					success:function(r){
						if(r.result=='SUCCESS'){
							console.log('aaaaaaaaaaaaaaaaaaa');
							if(batal==false){
								var o=r.data;
								console.log(o);
								kelompok_pasien=val(o.f6);
								noregis=data;
								$('#div-loading').hide();
								$('#div-output').fadeIn();
								$('#t-pendaftaran').html(data);
								$('#t-nama').html(o.f1);
								$('#t-tgllahir').html(o.f2);
								$('#t-klinik').html(o.f3);
								$('#dokter').html(o.f4);
								$('#t-antrian').html(o.f5);
								$('#kelompok_pasien').val(o.f6);
								$('#no_peserta').val(o.f7);
								$('#no_rujukan').val(o.f8);
								$('#kelas').val(o.f9);
								$('#faskes_asal').val(o.f10);
								$('#diagnosa').val(o.f11);
								$('#poli_tujuan').val(o.f12);
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
			},
			function(error){
			$('#read_error').html(error);
			}, function(videoError){
			$('#vid_error').html(videoError);
			}
			);
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
			/// CETAK TOMBOL ULANG SEP
			$('#btnCetakSEP').bind('click',function(){
				$.ajax({
					url:'<?php echo base_url(); ?>app/rs2/cetak_ulang_sep',
					data:{
						noSEP:$('#noSEP_cetak').val(),
					},
					type:'GET',
					dataType:'JSON',
					success:function(r){
						console.log(r);
						//pesan cetak ulang sedang diproses
							
						$('#div-loadingCetakSEP').fadeIn();
						$('#div-message-success').hide();
						timeOut=setTimeout(function(){
							$('#div-loadingCetakSEP').hide();
							$('#div-message-success').fadeIn();
							$('.success').html('SEP telah dicetak.');
						},3000);
						
					},
					error:function(jqXHR, exception){
						//resetAll();
					}
				}); 
				
				
			});
			///
			$('#btnYa').bind('click',function(){
				$('#div-confirm').hide();
				$('#div-loading').fadeIn();
				$('#div-input2').hide();
				batal=false;
				if(kelompok_pasien=='BPJS PBI' || kelompok_pasien=='BPJS NON PBI'){
				   kel_pasien='1';
				 
				}else{
					kel_pasien='0';
				 
				}
				
				$.ajax({
					url:'<?php echo base_url(); ?>app/rs2/setNomorPendaftaran',
					data:{
						noRegister:$('#nomorPendaftaran').val(),
						jenis_pasien:kel_pasien
					},
					type:'GET',
					dataType:'JSON',
					success:function(r){
						$('#div-loading').hide();
						console.log(r);
						if(r.response == true || r.response == 'true'){
							$('#div-message-success').fadeIn();
							$('.success').html('Pendaftaran Berhasil, Silahkan Ambil No. Resi Untuk Pembayaran di Kasir.');		
							
							if(kel_pasien == '1'){
								document.getElementById("btnCetakSEP").style.display='block';
								$('#noSEP_cetak').val(r.no_sep); //untuk menyimpan no sep
								// var strWindowFeatures = "location=yes,height=570,width=820,scrollbars=yes,status=yes";
								// var URL = "http://localhost/rssm_online/index.php/app/rs2/preview_cetaksepbpjs/"+r.no_sep;
								// var win = window.open(URL, "_blank", strWindowFeatures);

							}else{
								 document.getElementById("btnCetakSEP").style.display='none';
							}
						}else{
							if(kel_pasien == '1'){
								 document.getElementById("btnCetakSEP").style.display='none';
								$('#div-message-warning').fadeIn();
								$('.warning').html('Pendaftaran Tidak Berhasil! (Ket: '+r.no_sep+')');	
							}else{
								$('#div-message-warning').fadeIn();
								$('.warning').html('Pendaftaran Tidak Berhasil, Harap Hubungi Petugas!.');	
							}
								
							
						}
						
					},
					error:function(jqXHR, exception){
						resetAll();
					}
				}); 
				/* var strWindowFeatures = "location=yes,height=570,width=820,scrollbars=yes,status=yes";
				var URL = "http://localhost/rssm_online/index.php/app/rs2/setNomorPendaftaran/"+noregis+"/jenis_pasien/"+kel_pasien+"/";
				var win = window.open(URL, "_blank", strWindowFeatures);
				$('#div-loading').hide();
				$('#div-message-success').fadeIn();
				$('.success').html('Pendaftaran Berhasil, Silahkan Ambil No. Resi Untuk Pembayaran di Kasir.');				
				  */
				
				
				/*$.ajax({
					url:'<?php// echo base_url(); ?>app/rs2/setNomorPendaftaran',
					data:{ noRegister:noregis,
						   jenis_pasien:kelompok_pasien},
					type:'GET',
					dataType:'JSON',
					success:function(r){
						console.log('t');
						if(r.result=='SUCCESS'){
							var strWindowFeatures = "location=yes,height=570,width=820,scrollbars=yes,status=yes";
							var URL = "http://localhost:85/rssm_online/app/rs2/cetaksepbpjs_direct"+result+";url=" + location.href;
							var win = window.open(URL, "_blank", strWindowFeatures);
							$('.success').html('Pendaftaran Berhasil, Harap tunggu di antrian.');
							if(batal==false){
								var o=r.data;
								$('#div-loading').hide();
								$('#div-message-success').fadeIn();
								$('.success').html('Pendaftaran Berhasil, Silahkan Ambil No. Resi Untuk Pembayaran di Kasir.');
								timeOut=setTimeout(function(){
									resetAll();
								},3000);
							}
						}else if(r.result!=''){
							var strWindowFeatures = "location=yes,height=570,width=820,scrollbars=yes,status=yes";
							var URL = "http://localhost:85/rssm_online/app/rs2/cetaksepbpjs_direct"+result+";url=" + location.href;
							var win = window.open(URL, "_blank", strWindowFeatures);
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
						console.log('e');
						var strWindowFeatures = "location=yes,height=570,width=820,scrollbars=yes,status=yes";
							var URL = "http://localhost:85/rssm_online/app/rs2/cetaksepbpjs_direct"+result+";url=" + location.href;
							var win = window.open(URL, "_blank", strWindowFeatures);
						resetAll();
					}
				});*/
			});
			/*$('#btnYa').bind('click',function(){
				$('#div-confirm').hide();
				$('#div-loading').fadeIn();
				batal=false;
				$.ajax({
					url:'<?php echo base_url(); ?>app/rs2/setNomorPendaftaran',
					data:{noRegister:$('#nomorPendaftaran').val()},
					type:'GET',
					dataType:'JSON',
					success:function(r){
						if(r.result=='SUCCESS'){
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
			});*/
			$('#btnSearch').bind('click',function(){
				$('#div-input').hide();
				$('#div-input2').hide();
				$('#div-loading').fadeIn();
				batal=false;
				$.ajax({
					url:'<?php echo base_url(); ?>/index.php/app/rs2/getNomorPendaftaran',
					data:{noRegister:$('#nomorPendaftaran').val()},
					type:'GET',
					dataType:'JSON',
					success:function(r){
						if(r.result=='SUCCESS'){
							if(batal==false){
								var o=r.data;
									console.log(o);
								noregis=$('#nomorPendaftaran').val();
								kelompok_pasien=o.f6;
								console.log(kelompok_pasien);
								$('#div-loading').hide();
								$('#div-output').fadeIn();
								//$('#t-pendaftaran').html(o.f13);
								$('#t-nama').html(o.f1);
								$('#t-tgllahir').html(o.f2);
								$('#t-klinik').html(o.f3);
								$('#dokter').html(o.f4);
								$('#t-antrian').html(o.f5);
								$('#kelompok_pasien').html(o.f6);
								$('#no_peserta').html(o.f7);
								$('#no_rujukan').html(o.f8);
								$('#kelas').html(o.f9);
								$('#faskes_asal').html(o.f10);
								$('#diagnosa').html(o.f11);
								$('#poli_tujuan').html(o.f12);
								$('#t-pendaftaran').html(o.f13);
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
				
				$('#nomorPendaftaran').keyboard({
				layout: 'custom',
				customLayout : {
					'normal': [
						'1 2 3 4 5 6 7 8 9 0 {bksp}',
						'{accept}'
					]
				}
			});
			
			});
			
			
			function resetAll(){
				$('#div-output').hide();
				$('#div-loading').hide();
				$('#div-message-warning').hide();
				$('#div-message-success').hide();
				$('#div-confirm').hide();
				$('#div-input2').fadeIn();
				$('#div-input').fadeIn();
				$('#nomorPendaftaran').val('');
				clearTimeout(timeOut);
				batal=true;
			}
		
	</script>
</body>
</html>