<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
		<div class="menu-left-head">
			<h5> <strong>Login</strong> Faskes</h5>
			<div class="menu-left" style="padding: 10px;">
				<form id="form" class="form-signin" method="POST" autocomplete="off" action="<?php echo base_url()?>puskesmas/login">
					<div class="form-group row">
						<div class="col-md-2">
							<label for="kdFaskes col-xs-4">Kode Faskes:</label>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" id="kdFaskes" name="kdFaskes">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="email col-xs-4">User:</label>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" id="email" name="email">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="pwd">Password:</label>
						</div>
						<div class="col-md-3">
							<input type="password" class="form-control" id="pwd" name="password">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							&nbsp;
						</div>
						<div class="col-md-3">
							<button type="submit" class="btn btn-success">Login</button>
						</div>
					</div>
				</form>
			</div>
		</div>
				
	</div>
</div>
	 
	<!--
	<form id="form" class="form-signin panel panel-default" method="POST" autocomplete="off" action="<?php echo base_url()?>puskesmas/login">
		<h2 class="form-signin-heading">Masuk</h2>
		<label for="username" class="sr-only">Email / Nama Pengguna</label>
		<input type="text" id="inputUsername" name="username" class="form-control" placeholder="Email / Nama Pengguna" required autofocus>
		<label for="password" class="sr-only">Kata Sandi</label>
		<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Kata Sandi" required>
		<button id="btnSubmit" class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button>
		<button id="btnDaftar" class="btn btn-lg btn-primary btn-success" type="button">Daftar</button>
	</form>!-->
</div>