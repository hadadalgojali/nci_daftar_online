<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link href="<?php echo base_url()?>vendor/select2-3.5.4/select2.css" rel="stylesheet">
<script src="<?php echo base_url()?>vendor/select2-3.5.4/select2.min.js"></script>
<br>
<div class="container">
<div class="row">
	<div class="col-md-3">
		<?php include('menu.php'); ?>
	</div>
	<div class="col-md-9">
		<div class="menu-left-head">
			<h5> <strong>Simulasi</strong> Pembayaran</h5>
			<div class="menu-left" style="padding: 10px;">
				<div class="form-group row">
					<div class="col-md-3">
						<label for="kelurahan">Kelompok Pasien :</label>
					</div>
					<div class="col-md-4">
						<input type="hidden" id="poliklinik" name="poliklinik" style="width: 100%">
						<script>
							$('#poliklinik').select2({
								placeholder:'Pilih',
								  ajax: {
									url: "<?php echo base_url()?>pelayanan/getAsuransi",
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
								$.ajax({
								   url: '<?php echo base_url()?>pelayanan/getSimulasi',
								   data: {
									  i: e.added.id
								   },
								   error: function() {
								   },
								   dataType: 'json',
								   success: function(data) {
									  $('#isi').html(data.data);
								   },
								   type: 'GET'
								});
							});
						</script>
					</div>
					
				</div>
				<div id="isi">
					
					</div>
			</div>
		</div>	
	</div>
</div>
</div>
