<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="<?php echo base_url()?>vendor/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url()?>vendor/bootstrap-3.3.4-dist/css/other/signin.css" rel="stylesheet">
	<script src="<?php echo base_url()?>vendor/bootstrap-3.3.4-dist/js/jquery.min.js"></script>
	<script src="<?php echo base_url()?>vendor/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	<script>
		$(function(){
			$('#btnSubmit').click(function(){
				login();
			});
			$('#inputUsername,#inputPassword').keyup(function(e){
				if(e.keyCode==13){
					login();
				}
			});
			function login(){
				if($('#inputUsername').val() != '' && $('#inputPassword').val() !=''){
					$.ajax({
						url:'<?php echo base_url(); ?>index.php/admin/login',
						data:$('#form').serialize(),
						type:'POST',
						dataType:'JSON',
						success:function(r){
							if(r.result=='SUCCESS'){
								location.reload();
							}else{
								alert('isi data dengan benar');
							}
						},
						error:function(jqXHR, exception){
							alert('isi data dengan benar');
						}
					});
				}else{
					alert('isi data dengan benar');
				}
			}
		});
	</script>
</head>
<body>
<div class="container">
	<form id="form" class="form-signin panel panel-default" method="POST" autocomplete="off">
		<h2 class="form-signin-heading">Please sign in</h2>
		<label for="username" class="sr-only">Username</label>
		<input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
		<label for="password" class="sr-only">Password</label>
		<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
		<button id="btnSubmit" class="btn btn-lg btn-primary btn-block" type="button">Sign in</button>
	 </form>
</div>
</body>
</html>