<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome | <?php echo $this->common->getUser()->getEmployee()->getFirstName(); ?> <?php echo $this->common->getUser()->getEmployee()->getLastName(); ?></title>
	<meta name="viewport" content="initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,width=device-width,height=device-height,target-densitydpi=device-dpi,user-scalable=yes" />
</head>
<body>
</body>
</html>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendor/ext-4.2.1.883/resources/css/ext-all.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendor/admin_style.css">
<script type="text/javascript" src="<?php echo base_url(); ?>vendor/ext-4.2.1.883/ext-all.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>vendor/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>app/system/Common.js"></script>
<script>
	var url='<?php echo base_url(); ?>';
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>app.js"></script>