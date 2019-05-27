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

			<h3  style="font-size:20px;"> <strong>SYARAT DAN KETENTUAN</strong> PENDAFTARAN ONLINE :</h3>
			
			<div class="menu-left" style="padding: 0px !important;">

					<div style="margin: 15px; padding-top:15px; padding-bottom:15px;">

						
						<!-- <label>SYARAT DAN KETENTUAN PENDAFTARAN ONLINE :</label><br> -->

						1. Pendaftaran online dapat dilakukan 1 (satu) hari sebelum kunjungan pada jam 06:00 s/d 21:00. <br>
						2. Pembayaran biaya pendaftaran untuk pasien umum dilakukan di loket kasir yang berlokasi di Rumah Sakit. <br>
						3. Untuk pasien BPJS harus ada surat rujukan yang masih berlaku. <br>
						<!-- 4. Pendaftaran online bisa dilakukan selama kuota masih ada. <br> -->
						4. Check in dapat dilakukan saat hari kunjungan pada jam 07:00 s/d 14:00. <br>
 
						
					</div>
					
			</div>
			
			

			<h4> <strong>Pendaftaran</strong> Pasien Baru</h4>

			<div class="menu-left" style="padding: 0px !important;">

				
					<div style="margin: 15px; padding-top:15px;">

						<!-- <label>SYARAT DAN KETENTUAN PENDAFTARAN ONLINE :</label><br> -->

						Untuk pasien yang <strong><u>belum memiliki nomer rekam medis</u></strong> di RSUD Dr. Soedono Madiun. <br>
						
					</div>
					<div style="margin-left: 15px; ">
						<!-- <a href="<?php echo base_url(); ?>/index.php/daftar/baru"> -->
						<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal_MessageWarning">Lanjut Daftar Pasien Baru &nbsp;<span class="glyphicon glyphicon-chevron-right"></span> </button> 
					</div>
			</div>
			<div class="menu-left" style="padding: 0px !important;">&nbsp;</div>
			
			<h4> <strong>Pendaftaran</strong> Pasien Lama</h4>


			<div class="menu-left" style="padding: 0px !important;">

				
					<div style="margin: 15px; padding-top:15px; ">

						<!-- <label>SYARAT DAN KETENTUAN PENDAFTARAN ONLINE :</label><br> -->

						Untuk pasien yang <strong><u>sudah memiliki nomer rekam medis</u></strong> di RSUD Dr. Soedono Madiun. <br>

					</div>
					
					<div style="margin-left: 15px; ">
						<a href="javascript: cekJam();">
							<button type="button" class="btn btn-primary " style="border-radius: 10px;"> Lanjut Daftar Pasien Lama &nbsp;  <span class="glyphicon glyphicon-chevron-right"></span> </button> 
						</a>
						
					</div>
			</div>
			<div class="menu-left" style="padding: 0px !important;">&nbsp;</div>
		</div>
		
		<!-- Modal -->
	  <div class="modal fade" id="myModal_MessageWarning" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Daftar Pasien Baru</h4>
			</div>
			<div class="modal-body">
			  <p>Fitur pendaftaran untuk Pasien Baru masih dalam proses pengembangan.</p>
			  <p>Silakan datang langsung ke loket pendaftaran pasien di RS Soedono Madiun.</p>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		  </div>
		  
		</div>
	  </div>
	  
	  <!-- Modal -->
	  <div class="modal fade" id="myModal_MessageWarningWaktuDaftar" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Warning</h4>
			</div>
			<div class="modal-body">
			  <p>Pendaftaran hanya bisa dilakukan pada jam 06.00 s/d 21.00</p>
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

<script type="text/javascript">

	function cekJam(){
		// kunjungan pada jam 06:00 s/d 21:00. 
		var date = new Date();
        var hours = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
        var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
        var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
        time = hours + ":" + minutes + ":" + seconds;
		console.log(time);
		if(hours >= "06" && hours <= "21"){ //bisa daftar jika diantara jam 6 sampai jam 9
			if(hours == "21" && minutes > "00"){ //jika jam 21.01 atau lebih tidak bisa daftar
				$('#myModal_MessageWarningWaktuDaftar').modal();
			}else{
				location.href = "<?php echo base_url(); ?>/index.php/daftar/lama";
			}
		}else{
			$('#myModal_MessageWarningWaktuDaftar').modal();
		}
		
	}

</script>
