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
						<a href="<?php echo base_url(); ?>/index.php/daftar/baru">
						<button type="button" class="btn btn-primary ">Lanjut Daftar Pasien Baru</button> 
						</a>
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
						<a href="<?php echo base_url(); ?>/index.php/daftar/lama">
						<button type="button" class="btn btn-primary ">Lanjut Daftar Pasien Lama</button> 
						</a>
					</div>
			</div>
			<div class="menu-left" style="padding: 0px !important;">&nbsp;</div>
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
		var nilai_faskes='1';
		if (document.getElementById('rbfaskes1').checked) {
			nilai_faskes = document.getElementById('rbfaskes1').value;
		}else if(document.getElementById('rbfaskes2').checked){
			nilai_faskes = document.getElementById('rbfaskes2').value;
		}
		
		if($('#no_kartu').val() !='' && $('#no_kartu').val() != ''){

			$.ajax({

				url: '<?php echo base_url()?>/index.php/daftar/cek_no_kartu',

					data: {

							no_kartu: $('#no_kartu_baru').val(),
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
							console.log(status);
							console.log(data.resp.metaData.message);
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

								$('#hidden_kd_rujukan').val(data.resp.response.rujukan.provPerujuk.kode); //PPK RUJUKAN

								$('#hidden_kd_diagnosa').val(data.resp.response.rujukan.diagnosa.kode);

								$('#hidden_kd_kelas').val(data.resp.response.rujukan.peserta.hakKelas.kode);

								$('#hidden_kd_poli').val(data.resp.response.rujukan.poliRujukan.kode);
								
								/* TAMBAHAN */

								kd_poli=data.resp.response.rujukan.poliRujukan.kode;

								auto_poli_bpjs(kd_poli);
								
								//2018-11-29
								$('#hidden_nilai_faskes').val(nilai_faskes);
								$('#tgl_rujukan_baru').val(data.resp.response.rujukan.tglKunjungan);
								$('#div-cek-error').hide();

							}else if(status=='201'){
								$('#no_rujukan_baru').val('');
								$('#tgl_rujukan_baru').val('');
								$('#faskes_baru').val('');
								$('#kelas_baru').val('');
								$('#diagnosa_baru').val('');
								$('#poli_baru').val('');
								$('#poliklinik').val('');
								alert(data.resp.metaData.message);
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
//COMBO POLI DARI DATABASE
function auto_poli_bpjs(kd_poli){

	console.log(kd_poli);

	$.ajax({
		url: '<?php echo base_url()?>/index.php/daftar/getKdPoliBPJS',
		data: {
				text: kd_poli,
			  },
		type:'POST',
		error: function() {
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

 

												

</script>