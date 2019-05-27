<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Ext JS!</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/build/packages/ext-theme-classic/build/resources/ext-theme-classic-all.css">
		<script type="text/javascript" src="<?php echo base_url(); ?>lib/build/ext-all.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>lib/jquery/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>lib/build/packages/ext-theme-classic/build/ext-theme-classic.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>app.js"></script>
		<style>
			.x-form-text-wrap{
				display:block !important;
			}
			.x-form-text-default{
				padding : none !impotant;
			}
		</style>
		<script>
			var Lib={
				system:{
					name: 'MEDISmart V.6',
					corporate:'copyright@ Nuansa Cerah Informasi - MEDISMart V.6 2015'
				},
				baseUrl:'<?php echo base_url(); ?>',
				tabList:{},
				bodyList:{},
				form:{
					
				},
				ajaxError:function(jqXHR, exception){
					if (jqXHR.status === 0) {
						Ext.toast('Not connect.\n Verify Network.', 'Error', 'tr');
					} else if (jqXHR.status == 404) {
						Ext.toast('Requested page not found. [404]', 'Error', 'tr');
					} else if (jqXHR.status == 500) {
						Ext.toast('Internal Server Error [500].', 'Error', 'tr');
					} else if (exception === 'parsererror') {
						Ext.toast('Requested JSON parse failed.', 'Error', 'tr');
					} else if (exception === 'timeout') {
						Ext.toast('Time out error.', 'Error', 'tr');
					} else if (exception === 'abort') {
						Ext.toast('Ajax request aborted.', 'Error', 'tr');
					} else {
						Ext.toast('Uncaught Error.\n' + jqXHR.responseText, 'Error', 'tr');
					}
				},
				ajaxSuccess:function(r){
					if(r != undefined && r.result=='SUCCESS'){
						if(r.message!=''){
							Ext.toast(r.message, 'Success', 'tr');
						}
					}else if(r != undefined && r.result=='ERROR'){
						if(r.message!=''){
							Ext.toast(r.message, 'Error', 'tr');
						}
					}else if(r != undefined && r.result=='PRIVILEGE'){
						if(r.message!=''){
							Ext.toast('Anda Tidak Punya Hak Untuk Akses Menu ini.', 'Error', 'tr');
						}
					}else if(r != undefined && r.result=='SESSION'){
						if(r.message!=''){
							Ext.toast(r.message, 'Error', 'tr');
						}
					}else{
						Ext.toast('JSON Tidak dikenali', 'Error', 'tr');
					}
				}
			};
		</script>
	</head>
<body>
</body>
</html>