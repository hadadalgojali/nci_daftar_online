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
			<!--
			<ul class="nav navbar-nav navbar-right" style="margin: 10px 0;">

				<li><a href="#"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>

			</ul>
			-->
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

}

else if($p=='HALAMAN_UTAMA'){
	include ('main/daftar/halaman_utama.php');
}

else if($p=='DAFTAR_BARU'){

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