<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<br>
<link href="<?php echo base_url()?>vendor/bootstrap-datetimepicker-0.0.11/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="<?php echo base_url()?>vendor/bootstrap-datetimepicker-0.0.11/js/bootstrap-datetimepicker.min.js"></script>
<div class="container">
<div class="row">
	<div class="col-md-2">
		<?php include('menu_login.php'); ?>
	</div>
	<div class="col-md-10">
		<div class="menu-left-head">
			<h5> <strong>Aktivasi</strong> Faskes</h5>
			<div class="menu-left" style="padding: 10px;">
				<form id="form" class="form-signin" method="POST" autocomplete="off" action="<?php echo base_url()?>puskesmas/login">
					<div class="form-group row">
						<div class="col-md-2">
							<label for="kdFaskes">Kode Faskes:</label>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" id="kdFaskes" name="kdFaskes" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="nama">Nama Faskes:</label>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" id="nama" name="nama" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="kota">Kabupaten/Kota:</label>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" id="kota" name="kota" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="kec">Kecamatan:</label>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" id="kec" name="kec" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="telp">Telepon:</label>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" id="telp" name="telp" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="fax">Fax:</label>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" id="fax" name="fax" required>
						</div>
					</div>
					<div class='form-group row'>
						<div class="col-md-2">
							<label for="tglReg">Tgl. Register:</label>
						</div>
						<div class="col-md-3">
							<div id="datetimepicker" class="input-group date">
								<input type="text"  data-format="dd/MM/yyyy" class="form-control add-on " id="tglReg" name="tglReg" required />
								<span class="add-on input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
							<script type="text/javascript">
							  $(function() {
								$('#datetimepicker').datetimepicker({
								  language: 'pt-BR'
								});
							  });
							 </script>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="kdAktivasi">Kode Aktivasi:</label>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" id="kdAktivasi" name="kdAktivasi" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							&nbsp;
						</div>
						<div class="col-md-3">
							<button type="submit" class="btn btn-success">Aktivasi</button>
						</div>
					</div>
				</form>
			</div>
		</div>
				
	</div>
</div>
</div>