<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="menu-left-head">
	<h5> <strong>Layanan</strong> Faskes</h5>
<!--	<a href="<?php echo base_url(); ?>puskesmas"><div class="menu-left button first" style=""><h5><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <strong>Home</strong> Faskes</h5></div></a>  -->
	<a href="<?php echo base_url(); ?>puskesmas/rujukan"><div class="menu-left button" style=""><h5><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> <strong>Rujukan</strong> Online</h5></div></a>
	<a href="<?php echo base_url(); ?>puskesmas/ListRujukan"><div class="menu-left button" style=""><h5><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> <strong>List</strong> Rujukan</h5></div></a>
	<a href="<?php echo base_url(); ?>puskesmas/ListRujukanBalik"><div class="menu-left button" style=""><h5><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> <strong>Rujukan</strong> Balik</h5></div></a>
<!-- 	<a href="<?php echo base_url(); ?>puskesmas/rujukanBalik"><div class="menu-left button" style=""><h5><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> <strong>Rujukan</strong> Balik</h5></div></a>  -->
	<a href="<?php echo base_url(); ?>puskesmas/logout"><div class="menu-left button last" style=""><h5><span class="glyphicon glyphicon-off" aria-hidden="true"></span> <strong>Keluar</strong> Faskes</h5></div></a>
</div>