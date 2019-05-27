<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$common=$this->common;
?>
<style>
.par{
	margin-top:15px;
	color:#fff;
}
.ket{
	margin:0 auto;
	position:absolute;
	left:0;
	right:0;
	text-align:center;
	padding:10px;
	background:#ffc;
	color:#666;
	font-size:12px;
	display:none;
}
.fill { 
    min-height: 100%;
    height: 100%;
}
.cursor{
	cursor:pointer;
	margin-top:30px;
}
    .ul-custom {
          padding:0 0 0 0;
          margin:0 0 0 0;
      }
      .ul-custom li {
          list-style:none;
          margin-bottom:10px;
      }
     .ul-custom li img {
          cursor: pointer;
      }
.desc{
    background-color: #000;
    bottom: 0;
    color: #fff;
    left: 0;
    opacity: 0.5;
    position: absolute;
    width: 92.8%;
    left: 15px;
    padding: 0px 10px;
	display:none;
}
.fix{
    width: 100%;
    padding: 0px;
}
.arrow-down {
	width: 0; 
	height: 0; 
	border-left: 10px solid transparent;
	border-right: 10px solid transparent;
	border-top: 10px solid #ffc;
	position: absolute;
    margin: 0 auto;
    left: 0;
    right: 0;
    bottom: -10px;
}
</style>
<div class="container-fluid" style="padding:30px 0;">
<div id="myCarousel" class="carousel slide" data-ride="carousel"  style="height: 380px !important; margin-bottom:0px;">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox" style="height:100%;">
      <?php 
//       	$tenant=$common->getDefaultTenant();
      	$files=$common->queryResult("SELECT banner FROM app_banner");
      	for($i=0; $i<count($files) ; $i++){
      		$file=$files[$i];
      		$active='';
      		if($i==0){
      			$active='active';
      		}
      ?>
      	<div class="item <?php echo $active; ?>">
      		<img style="width: 100%; height: 380px;"class="second-slide" style=" " src='<?php echo base_url().'upload/'.$file->banner ?>' alt="Second slide" >
        </div>
      <?php 
      	}
      ?>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
</div>
<div class="container-fluid" style="background:#5a9e25; margin-bottom:30px;" >
<div class="row" style="padding:40px 10px ;" >

		<div class="col-md-2 cursor" id="cursor-1" onMouseOver="loadHover('1','1')" onMouseOut="loadHover('0','1')">
        <div class="col-md-12 ket" id="keterangan-1">
       Klik Disini Untuk Mendaftar Secara Online.
        <div class="arrow-down"></div>
        </div>
        <a href="<?php echo base_url()?>daftar">
        <img src="<?php echo base_url()?>include/doc.png" class="center-block img-responsive" width="100px" ><p align="center" class="par">Pendaftaran Online</p>
        </a>
        </div>
        <div class="col-md-2 cursor" id="cursor-2" onMouseOver="loadHover('1','2')" onMouseOut="loadHover('0','2')">
         <div class="col-md-12 ket" id="keterangan-2">
        Klik Disini untuk Melihat Berbagai Pelayanan yang diberikan Rumah Sakit 
        <div class="arrow-down"></div>
        </div>
        <a href="<?php echo base_url()?>pelayanan/jadwaldokter">
        <img src="<?php echo base_url()?>include/hospital2.png" class="center-block img-responsive" width="100px" ><p align="center" class="par">Info Jadwal Dokter</p>
        </a>
        </div>
        <div class="col-md-2 cursor" id="cursor-3" onMouseOver="loadHover('1','3')" onMouseOut="loadHover('0','3')">
         <div class="col-md-12 ket" id="keterangan-3">
       Klik Disini untuk Melihat Info Pasien Rawat Inap.
       <div class="arrow-down"></div>
        </div>
        <a href="<?php echo base_url()?>pelayanan/inforawatinap">
         <img src="<?php echo base_url()?>include/icon.png" class="center-block img-responsive" width="100px"><p align="center" class="par">Info Pasien</p>
        </a>
        </div>
         <div class="col-md-2 cursor" id="cursor-4" onMouseOver="loadHover('1','4')" onMouseOut="loadHover('0','4')">
          <div class="col-md-12 ket" id="keterangan-4">
        Klik Disini untuk Melihat Semua Info Layanan Rumah Sakit.
        <div class="arrow-down"></div>
        </div>
        <a href="<?php echo base_url()?>pelayanan/pelayananrs?page=5&title=Rawat%20Jalan&sub_title=THT&type=UNITTYPE_RWJ">
         <img src="<?php echo base_url()?>include/bed.png" class="center-block img-responsive" width="100px"><p align="center" class="par">Layanan Rumah Sakit</p>
        </a>
        </div>
        <div class="col-md-2 cursor" id="cursor-5" onMouseOver="loadHover('1','5')" onMouseOut="loadHover('0','5')">
         <div class="col-md-12 ket" id="keterangan-5">
        Klik Disini untuk Melihat Semua Info Promo Kami.
        <div class="arrow-down"></div>
        </div>
        <a href="<?php echo base_url()?>pelayanan/promo">
         <img src="<?php echo base_url()?>include/icon.png" class="center-block img-responsive" width="100px"><p align="center" class="par">Promo</p>
        </a>
        </div>
        <div class="col-md-2 cursor" id="cursor-6" onMouseOver="loadHover('1','6')" onMouseOut="loadHover('0','6')">
         <div class="col-md-11 ket" id="keterangan-6">
        Klik Disini untuk Testimoni Umpan Balik Pasien.
        <div class="arrow-down"></div>
        </div>
        <a href="<?php echo base_url()?>pelayanan/feedback">
         <img src="<?php echo base_url()?>include/hospital2.png" class="center-block img-responsive" width="100px"><p align="center" class="par">Umpan Balik</p>
         </a>
        </div>
</div>
</div>
<div class="container" style="background: white; width:auto;">
	<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default" style="border-radius:0px;border:none !important;box-shadow:none !important;">
					<div class="panel-heading" style="background:none;">
						<h2 class="panel-title">Profile Dokter</h2>
					</div>
					<div class="panel-body" style="font-size: 12px;">
						<?php 
							$dokter=$common->queryRow("SELECT foto,first_name,second_name,last_name,birth_place,birth_date,email_address,phone_number1,employee_id 
								FROM app_employee M INNER JOIN app_job A ON M.job_id=A.job_id WHERE
								A.job_code='DOKTER' AND M.active_flag=true ORDER BY RAND() LIMIT 1");
							$fotoDokter='NO.GIF';
							if($dokter->foto != null && $dokter->foto != '')
								$fotoDokter=$dokter->foto;
							$tglLahir='Data Kosong';
							if($dokter->birth_date != null){
								$dateLahir=new DateTime($dokter->birth_date);
								$tglLahir=$dateLahir->format('d M Y');
							}
						?>
						<p class="text-danger">
						<div class="form-group row">
							<div class="col-md-5">
								<img style="width: 100%;height: 170px;margin: 0px 15px 15px 0px !important;border: 10px solid white; box-shadow: 0px 10px 10px -10px rgba(0, 0, 0, 0.7); -webkit-box-shadow: 0px 10px 10px -10px rgba(0, 0, 0, 0.7); -moz-box-shadow: 0px 10px 10px -10px rgba(0, 0, 0, 0.7); " src='<?php echo base_url().'upload/'.$fotoDokter; ?>' >
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<div class="col-md-12">
										<label><?php echo $dokter->first_name.' '.$dokter->second_name.' '.$dokter->last_name; ?></label>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<?php echo $dokter->birth_place.', '.$tglLahir ?>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<?php echo $dokter->email_address; ?>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<?php echo $dokter->phone_number1; ?>
									</div>
								</div>
								<a href="<?php echo base_url() ;?>pelayanan/profileDokter?dokter_id=<?php echo $dokter->employee_id;?>" class="btn btn-info">Selengkapnya >></a>
							</div>
						</div>
					</div>
				</div>
				</div>
                <div class="col-md-4">
		<div class="panel panel-default" style="border-radius:0px;border:none !important;box-shadow:none !important;">
						<?php 
							$testiQuery=$common->queryRow("SELECT tgl_feedback,nama_pengirim,telepon,description,ratting_kenyamanan,
									ratting_keramahan,ratting_keterjangkauan,ratting_kecepatan FROM rs_feedback WHERE status='FBSTATUS_OK'
								ORDER BY tgl_feedback ASC LIMIT 1");
							$tanggalITesti='';
							if($testiQuery){
								$dateFeedback=new DateTime($testiQuery->tgl_feedback);
								$tanggalITesti='<font style="color:#777;font-size: 10px;"><i>'.$dateFeedback->format('d M Y').'</i></font>';
							}
						?>
					<div class="panel-heading" style="background:none;">
						<h2 class="panel-title">Testimoni / Ratting <?php echo $tanggalITesti ; ?></h2>
					</div>
					<div class="panel-body" style="font-size: 12px;">
						
						<p class="text-danger">
						<?php 
							if($testiQuery){
								$testi=$testiQuery;
						?>
							<div class="form-group row">
								<div class="col-md-12">
									<span><label><?php echo $testi->nama_pengirim; ?></label></span> 
									<span><font style="color:#777;font-size: 10px;"><i><?php echo substr($testi->telepon,0,-4); ?>XXXX</i></font></span>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<i><?php echo $testi->description; ?></i>
								</div>
							</div>
							<p>
							<div class="form-group row">
								<div class="col-md-5" style="font-size: 10px;">
									<label>Kenyamanan Fasilitas :</label>
								</div>
								<div class="col-md-7">
									<input type="number" class="rating" id="test" name="kecepatan" data-min="1" data-max="5" value="<?php echo $testi->ratting_kenyamanan; ?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-5" style="font-size: 10px;">
									<label>Keramahan Petugas :</label>
								</div>
								<div class="col-md-7">
									<input type="number" class="rating" id="test" name="kecepatan" data-min="1" data-max="5" value="<?php echo $testi->ratting_keramahan; ?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-5" style="font-size: 10px;">
									<label>Keterjangkauan Biaya :</label>
								</div>
								<div class="col-md-7">
									<input type="number" class="rating" id="test" name="kecepatan" data-min="1" data-max="5" value="<?php echo $testi->ratting_keterjangkauan; ?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-5" style="font-size: 10px;">
									<label>Kecepatan Response :</label>
								</div>
								<div class="col-md-7">
									<input type="number" class="rating" id="test" name="kecepatan" data-min="1" data-max="5" value="<?php echo $testi->ratting_kecepatan; ?>">
								</div>
							</div>
						<?php 	
							}else{
						?>
							Tidak Ada Testimoni
						<?php 
							}
						?>
						
					</div>
				</div>
				</div>
                <div class="col-md-4">
				<div class="panel panel-default" style="border-radius:0px;border:none !important;box-shadow:none !important;">
					<?php 
						$now=new DateTime();
						$promoQuery=$common->queryRow("SELECT judul,description,image_name,A.unit_id,A.unit_name,A.unit_type
				FROM rs_unit_about M INNER JOIN rs_unit A ON M.unit_id=A.unit_id ORDER BY RAND() LIMIT 1");
					?>
					<div class="panel-heading" style="background:none;">
						<h2 class="panel-title">Layanan Rumah Sakit</h2>
					</div>
					<div class="panel-body"  style="font-size: 12px;">
						<?php 
						
						if($promoQuery){
							$promo=$promoQuery;
							echo '<label>'.$promo->judul.'</label><br>';
							echo $common->stringLimit($promo->description,50);
						?>
						<br><br>
						<a href="<?php echo base_url() ;?>pelayanan/pelayananrs?page=<?php echo $promoQuery->unit_id; ?>&title=Penunjang Medis&sub_title=<?php echo $promoQuery->unit_name; ?>&type=<?php echo $promoQuery->unit_type; ?>" class="btn btn-info">Selengkapnya >></a>
						<?php 
						}else{
						?>
						Tidak Ada Layanan.
						<?php 	
						}
						?>						
					</div>
				</div>
				</div>
        </div>
        </div>
        <div class="container-fluid" style=" background:#f4f4f4; box-shadow:0 1px 1px rgba(0,0,0,.05);">
	<ul class="ul-custom">
	<li style="padding: 10px;" class="row" onMouseOver="loadCaption('1','1')" onMouseOut="loadCaption('0','1')">
	<?php 
		$unitAbouts=$common->queryResult("SELECT tgl_promo,judul,isi_promo FROM rs_promo WHERE tgl_berlaku_promo > ".$now->format('Y-m-d')." ORDER BY tgl_promo DESC, id_promo DESC LIMIT 3");
		if($unitAbouts){
			for($i=0,$ilen=count($unitAbouts); $i<$ilen ; $i++){
				$unitAbout=$unitAbouts[$i];
				$datePromo=new DateTime($unitAbout->tgl_promo);
				
				preg_match_all('/<img[^>]+>/i',$unitAbout->isi_promo, $rContent);
				
				
				$unitAbout->isi_promo = preg_replace("/<img[^>]+\>/i", "", $unitAbout->isi_promo); 
				$tanggalPromoIndo='<font style="color:#777;font-size: 10px;"><i>'.$datePromo->format('d M Y').'</i></font>';
	?>
	
        <div class="col-md-6" style="font-size: 12px;">
			<div class="panel panel-default" style="border:none; background:none; box-shadow:none; text-align:left;">
                <div>
					<div  style="width: 100%;border-bottom: solid 1px #DDD;margin-bottom: 10px;"><b><?php echo $unitAbout->judul; ?></b> <?php echo $tanggalPromoIndo; ?></div>
				</div>
				<?php if(count($rContent[0])>0){ ?>
				<div id="myCarousel<?php echo $i; ?>" class="carousel slide panel-body col-md-4" data-ride="carousel"  style="height: 200px !important; margin-bottom:0px;">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
					<li data-target="#myCarousel<?php echo $i; ?>" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel<?php echo $i; ?>" data-slide-to="1"></li>
					<li data-target="#myCarousel<?php echo $i; ?>" data-slide-to="2"></li>
				  </ol>
				  <div class="carousel-inner" role="listbox" style="height:100%;">
				  <?php 
					$active=true;
					foreach( $rContent[0] as $img_tag){
						if($active===true){
							$active=false;
							echo '<div class="item active">';
						}else{
							echo '<div class="item">';
						}
						echo $img_tag;
						echo '</div>';
					}
				  ?>
				  </div>
				  <a class="left carousel-control" href="#myCarousel<?php echo $i; ?>" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#myCarousel<?php echo $i; ?>" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				  </a>
				</div>
				<?php } ?>
				<div class="panel-body <?php if(count($rContent[0])>0){echo 'col-md-8';}else{echo 'col-md-12';} ?>">
				<?php echo $common->stringLimit($unitAbout->isi_promo,100); ?>
				<p>
				<a href="<?php echo base_url() ;?>pelayanan/promo" class="btn btn-info">Lihat Semua Promo >></a>
				</div>
			</div>
        </div>
   
	<?php 
			}
		}
	?>
	 </li>
    </ul>
        </div>
       <!-- akhir tambahan -->  
 <script type="text/javascript">
 $(document).ready(function(e) {
    $( window ).resize(function() {
  	var h = $('.ul-custom li img').width();
	$('.desc').width(h-20);
	console.log(h);
	});
});
 function loadHover(status,id){
	if(status==1){
		$("#keterangan-"+id).show();
		$("#keterangan-"+id).stop().animate({
    
		top: -56,
		opacity:1
	  }, 1000, function() {
	  });
	}else{
		$("#keterangan-"+id).stop().animate({
    top: -76,
	opacity:0
	  }, 1000, function() {
		$("#keterangan-"+id).hide();
		$("#keterangan-"+id).css("top","-86px");
	  });
	}
	}
function loadCaption(status,id){
	if(status == 1){
		$("#capt-"+id).stop().animate({
	  }, 1000, function() {
	    $('#capt-'+id).show();
	  });
	}
	else{
	$("#capt-"+id).stop().animate({
	  }, 1000, function() {
		$("#capt-"+id).hide();
	  });
	}
}
(function ($) {
  $.fn.rating = function () {
    var element;
    function _paintValue(ratingInput, value) {
      var selectedStar = $(ratingInput).find('[data-value=' + value + ']');
      selectedStar.removeClass('glyphicon-star-empty').addClass('glyphicon-star');
      selectedStar.prevAll('[data-value]').removeClass('glyphicon-star-empty').addClass('glyphicon-star');
      selectedStar.nextAll('[data-value]').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
    }
    function _clearValue(ratingInput) {
      var self = $(ratingInput);
      self.find('[data-value]').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
      self.find('.rating-clear').hide();
      self.find('input').val('').trigger('change');
    }
    for (element = this.length - 1; element >= 0; element--) {
      var el, i, ratingInputs,
        originalInput = $(this[element]),
        max = originalInput.data('max') || 5,
        min = originalInput.data('min') || 0,
        clearable = originalInput.data('clearable') || null,
        stars = '';
      for (i = min; i <= max; i++) {
        stars += ['<span class="glyphicon glyphicon-star-empty" data-value="', i, '"></span>'].join('');
      }
      if (clearable) {
        stars += [
          ' <a class="rating-clear" style="display:none;" href="javascript:void">',
          '<span class="glyphicon glyphicon-remove"></span> ',
          clearable,
          '</a>'].join('');
      }
      el = [
        '<div class="rating-input">',
        stars,
        '<input type="hidden" name="',
        originalInput.attr('name'),
        '" value="',
        originalInput.val(),
        '" id="',
        originalInput.attr('id'),
        '" />',
        '</div>'].join('');
      originalInput.replaceWith(el);
    }
    $('.rating-input')
      .on('mouseenter', '[data-value]', function () {
        var self = $(this);
        _paintValue(self.closest('.rating-input'), self.data('value'));
      }).on('mouseleave', '[data-value]', function () {
        var self = $(this);
        var val = self.siblings('input').val();
        if (val) {
          _paintValue(self.closest('.rating-input'), val);
        } else {
          _clearValue(self.closest('.rating-input'));
        }
      })
      .on('click', '[data-value]', function (e) {
        var self = $(this);
        var val = self.data('value');
        self.siblings('input').val(val).trigger('change');
        self.siblings('.rating-clear').show();
        e.preventDefault();
        false
      }).on('click', '.rating-clear', function (e) {
        _clearValue($(this).closest('.rating-input'));
        e.preventDefault();
        false
      }) .each(function () {
        var val = $(this).find('input').val();
        if (val) {
          _paintValue(this, val);
          $(this).find('.rating-clear').show();
        }
      });
  };
  $(function () {
    if ($('input.rating[type=number]').length > 0) {
      $('input.rating[type=number]').rating();
    }
  });
}(jQuery));
	</script>       