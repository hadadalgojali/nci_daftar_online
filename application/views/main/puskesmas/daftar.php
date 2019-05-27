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
<script src="<?php echo base_url()?>vendor/bootstrap-datetimepicker-0.0.11/js/bootstrap-datetimepicker.min.js"></script>
<br>
<div class="container">
<div class="row">
	<div class="col-md-2">
		<?php include('menu_login.php'); ?>
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
			<h5> <strong>Daftar</strong> Faskes</h5>
			<div class="menu-left" style="padding: 10px;">
				<form id="form" class="form-signin" method="POST" autocomplete="off" action="<?php echo base_url()?>puskesmas/save">
					<div class="form-group row">
						<div class="col-md-2">
							<label for="kdFaskes">Kode Faskes:</label>
						</div>
						<div class="col-md-3">
								<input type="text" class="form-control" id="kdFaskes" name="kdFaskes" value="<?php echo post('kdFaskes') ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="nama">Nama Faskes:</label>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" id="nama" name="nama" value="<?php echo post('nama') ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="nama">Kota:</label>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" id="kota" name="kota" value="<?php echo post('kota') ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="kota">Alamat:</label>
						</div>
						<div class="col-md-3">
							<textarea type="text" class="form-control" id="alamat" name="alamat" value="<?php echo post('alamat') ?>" required></textarea>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="telp">Telepon:</label>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" id="telp" name="telp" value="<?php echo post('telp') ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="fax">Fax:</label>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" id="fax" name="fax" value="<?php echo post('fax') ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="fax">Email:</label>
						</div>
						<div class="col-md-3">
							<input type="email" class="form-control" name="email" id="email" value="<?php echo post('email') ?>"  required>
						</div>
					</div>
					<div class="form-group row">
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
				</form>
			</div>
		</div>
				
	</div>
</div>
</div>