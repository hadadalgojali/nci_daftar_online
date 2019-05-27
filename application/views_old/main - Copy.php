<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$tenant=$this->common->getDefaultTenant();
?><!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $tenant->getTenantName(); ?></title>
	<link href="<?php echo base_url()?>vendor/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url()?>vendor/bootstrap-3.3.4-dist/css/other/carousel.css" rel="stylesheet">
	<link href="<?php echo base_url()?>include/style.css" rel="stylesheet">
	<script src="<?php echo base_url()?>vendor/bootstrap-3.3.4-dist/js/jquery.min.js"></script>
	<script src="<?php echo base_url()?>vendor/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script type="application/javascript">
// 	    navigator.geolocation.getCurrentPosition(success);
// 	    function success(position) {
// 	         var lat = position.coords.latitude;
// 	         var longi = position.coords.longitude;
// 	         var mapCanvas = document.getElementById('map');
// 			var myLatlng = new google.maps.LatLng(lat, longi);
// 			var marker = new google.maps.Marker({
//     			position: myLatlng,
//     			title:"Hello World!"
// 			});
//     		var mapOptions = {
//       			center: myLatlng,
//       			zoom: 17,
//       			mapTypeId: google.maps.MapTypeId.ROADMAP
//     		}
//     		var map = new google.maps.Map(mapCanvas, mapOptions);
//   			marker.setMap(map);
// 	    }
 		function initialize() {
    		var mapCanvas = document.getElementById('map');
			var myLatlng = new google.maps.LatLng(<?php echo $tenant->getCoordinate1(); ?>, <?php echo $tenant->getCoordinate2(); ?>);
			var marker = new google.maps.Marker({
    			position: myLatlng,
    			title:"RS"
			});
			var marker = new google.maps.Marker({
    			position: myLatlng,
    			title:"RS"
			});
    		var mapOptions = {
      			center: myLatlng,
      			zoom: 17,
      			mapTypeId: google.maps.MapTypeId.ROADMAP
    		}
    		var map = new google.maps.Map(mapCanvas, mapOptions);
  			marker.setMap(map);
  		}
  		google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>
<body style="">
<nav class="navbar navbar-default main-menu" style="margin-bottom:0px !important;">
    <div class="container">
		<div class="navbar-header" >
        <div class="navbar-brand" style="float:left;">
				<!--<div style="float:left;margin: 10px; width: 50px;">-->
                <div style="float:left;margin: -7px 9px; width: 50px;" class="hidden-xs">
					<img src="<?php echo base_url()?>include/logo.png" style="width: 40px;opacity: 0.8;">
				</div>
				<div class="navbar-brand" style="margin-top:-24px;float:left;;font-weight: bold;text-shadow: 2px 2px 2px #CCCCCC;">
					<?php echo $tenant->getTenantName(); ?>
					<br />Kota <?php echo $tenant->getCity(); ?>
				</div>
			</div>
			<button class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" type="button" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo base_url()?>"></a>
		</div>
		<div id="bs-example-navbar-collapse-1" class="navbar-collapse collapse menu-utama" aria-expanded="false" style="height: 1px;">
			<ul class="nav navbar-nav navbar-right" style="margin: 10px 0;">
				<li><a href="<?php echo base_url()?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
				<li><a href="http://ppid.rssoedono.jatimprov.go.id/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> PPID</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon glyphicon-th-list" aria-hidden="true"></span> Pelayanan <span class="caret"></span></a>
					<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
						<li><a href="<?php echo base_url() ;?>pelayanan/artikel?i=11"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Pelayanan Pasien Umum</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url() ;?>pelayanan/artikel?i=8"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Pelayanan Pasien BPJS/JKN</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url() ;?>pelayanan/artikel?i=9"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Jadwal Imunisasi</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url() ;?>pelayanan/artikel?i=10"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Jam Pelayanan RS</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url()?>pelayanan/inforawatinap"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Info Pasien RWI</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url()?>pelayanan/pelayananrs?page=5&title=Rawat%20Jalan&sub_title=THT&type=UNITTYPE_RWJ"><span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span> Layanan RS</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url()?>pelayanan/asuransi"><span class="glyphicon glyphicon-road" aria-hidden="true"></span> Asuransi/Perusahaan</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url()?>pelayanan/jadwaldokter"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Jadwal Dokter</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url()?>pelayanan/promo"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span> Promo</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url()?>pelayanan/simulasi"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> Simulasi Pembayaran</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url()?>pelayanan/feedback"><span class=" glyphicon glyphicon-inbox" aria-hidden="true"></span> Umpan Balik</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
						 Pendaftaran Online <span class="caret"></span>
					</a>
					<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
						<li style="display:none;"><a href="<?php echo base_url()?>daftar"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> Pasien Baru</a></li>
						<li  style="display:none;" class="divider"></li>
						<li><a href="<?php echo base_url()?>daftar/lama"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Pasien Lama</a></li>
					</ul>
				</li>
				<li class="dropdown" style="display:none;">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<span class="glyphicon glyphicon-bed" aria-hidden="true"></span> 
						FasKes I <span class="caret"></span>
					</a>
					<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
						<?php 
							$ses=$this->session->get('PUSKESMAS');
							if($ses == null){
						?>
						<li><a href="<?php echo base_url()?>puskesmas"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Login Faskes</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url()?>puskesmas/daftar"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Daftar Faskes</a></li>
						<!-- <li class="divider"></li>
						<li><a href="<?php echo base_url()?>puskesmas/aktivasi"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Aktivasi Faskes</a></li> -->
						<?php 
							}else{
						?>
						<!-- <li><a href="<?php echo base_url()?>puskesmas"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home Faskes</a></li>
						<li class="divider"></li> -->
						<li><a href="<?php echo base_url()?>puskesmas/rujukan"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> Rujukan Online</a></li>
						<li class="divider"></li>
						<!-- <li><a href="<?php echo base_url()?>puskesmas/rujukanBalik"><span class="glyphicon  glyphicon-share-alt" aria-hidden="true"></span> Rujukan Balik</a></li>
						<li class="divider"></li> -->
						<li><a href="<?php echo base_url()?>puskesmas/logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Keluar</a></li>
						<?php
							}
						?>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
<?php
if($p=='HOME'){
	include ('main/home/main.php');
}else if($p=='PUSKESMAS'){
	$ses=$this->session->get('PUSKESMAS');
	if($ses != null){
		include ('main/puskesmas/main.php');
	}else{
		include ('main/puskesmas/login.php');
	}
}else if($p=='DAFTAR_FASKES'){
	$ses=$this->session->get('PUSKESMAS');
	if($ses != null){
		include ('main/puskesmas/main.php');
	}else{
		include ('main/puskesmas/daftar.php');
	}
}else if($p=='AKTIVASI_FASKES'){
	$ses=$this->session->get('PUSKESMAS');
	if($ses != null){
		include ('main/puskesmas/main.php');
	}else{
		include ('main/puskesmas/aktivasi.php');
	}
}else if($p=='RUJUKAN'){
	$ses=$this->session->get('PUSKESMAS');
	if($ses != null){
		include ('main/puskesmas/rujukan.php');
	}else{
		include ('main/puskesmas/login.php');
	}
}else if($p=='RUJUKAN_BALIK'){
	$ses=$this->session->get('PUSKESMAS');
	if($ses != null){
		include ('main/puskesmas/rujukan_balik.php');
	}else{
		include ('main/puskesmas/login.php');
	}
}else if($p=='LIST_RUJUKAN'){
	$ses=$this->session->get('PUSKESMAS');
	if($ses != null){
		include ('main/puskesmas/listRujukan.php');
	}else{
		include ('main/puskesmas/login.php');
	}
}else if($p=='LIST_RUJUKAN_BALIK'){
	$ses=$this->session->get('PUSKESMAS');
	if($ses != null){
		include ('main/puskesmas/listRujukanBalik.php');
	}else{
		include ('main/puskesmas/login.php');
	}
}else if($p=='LIHAT_RUJUKAN'){
	$ses=$this->session->get('PUSKESMAS');
	if($ses != null){
		include ('main/puskesmas/lihatRujukan.php');
	}else{
		include ('main/puskesmas/login.php');
	}
}else if($p=='DAFTAR_BARU'){
	include ('main/daftar/baru.php');
}else if($p=='DAFTAR_LAMA'){
	include ('main/daftar/lama.php');
}else if($p=='INFO_RAWAT_INAP'){
	include ('main/pelayanan/info_rawat_inap.php');
}else if($p=='JADWAL_DOKTER'){
	include ('main/pelayanan/jadwal_dokter.php');
}else if($p=='PELAYANAN_RS'){
	include ('main/pelayanan/layanan_rs.php');
}else if($p=='PELAYANAN_PROFILE_DOKTER'){
	include ('main/pelayanan/profile_dokter.php');
}else if($p=='FEED_BACK'){
	include ('main/pelayanan/feed_back.php');
}else if($p=='PROMO'){
	include ('main/pelayanan/promo.php');
}else if($p=='ASURANSI'){
	include ('main/pelayanan/asuransi.php');
}else if($p=='SIMULASI'){
	include ('main/pelayanan/simulasi.php');
}else if($p=='LIHAT_PASIEN'){
	include ('main/puskesmas/lihatPasien.php');
}else if($p=='ARTIKEL'){
	include ('main/pelayanan/artikel.php');
}else if($p=='ARTIKELS'){
	include ('main/pelayanan/artikels.php');
}
?>
<footer>
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
				 	<p align="left"><b>Temui Kami :</b></p>
                 	<div class="col-sm-5" id="map" style="width:100%; height:330px; border:1px solid #ccc; background:#fff;"></div>
				</div>
                <div class="col-sm-6" style="color:#333;">
                <div class="col-sm-12" style="margin-top:30px; padding:10px 10px 0px 10px; border:1px solid #ccc;background:#fff;">
				 	<p align="left"><b>Hubungi Kami :</b></p>
                </div>
                <div class="col-sm-12" style="margin:10px 0; padding:10px; border:1px solid #ccc;background:#fff;">
                 	<p align="left"><b><?php echo $tenant->getTenantName(); ?></b></p>
                 	<p><label>Alamat :</label> <?php echo $tenant->getTenantAddress(); ?> <?php echo $tenant->getCity(); ?> <?php echo $tenant->getCountry(); ?></p>
                 	<p><label>Telepon / Fax :</label> <?php echo $tenant->getPhoneNumber1(); ?> / <?php echo $tenant->getFaxNumber1(); ?></p>
                 	<p><label>Email :</label>  <?php echo $tenant->getEmail(); ?></p>
                </div>
                </div>
			</div>
		</div>
	</div>
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
				Powered By <b>PT. Nuansa Cerah Informasi</b> &copy; 2015 
				</div>
			</div>
		</div>
	</div>
</footer>
</body>
</html>