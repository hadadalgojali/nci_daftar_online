<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<br>
<div class="container">
<div class="row">
	<div class="col-md-3">
		<?php include('menu.php'); ?>
	</div>
	<div class="col-md-9">
		<div class="menu-left-head">
			<h5> <strong>Promo</strong> Rumah Sakit</h5>
			<div class="menu-left" style="padding: 0px !important;">
			<?php 
				$now=new DateTime();
				$promos=$this->common->createQuery("SELECT A FROM ".$this->common->getModel('Promo')." A WHERE A.tanggalBerlaku > ".$now->format('Y-m-d')." ORDER BY A.tanggalPromo DESC , A.id DESC ")->getResult();
				if($promos){
					for($i=0; $i<count($promos) ; $i++){
						$promo=$promos[$i];
			?>
			<div class="menu-left-head sub">
				<span><strong><?php echo $promo->getJudul(); ?></strong></span> <span><font style="color:#777;font-size: 10px;"><i><?php echo $promo->getTanggalPromo()->format('d M Y'); ?></i></font></span>
				<div class="menu-left" style="padding: 10px;">
				<?php echo $promo->getIsi(); ?><br>
				<br>
				<label>Berlaku s/d </label> <i><?php echo $promo->getTanggalBerlaku()->format('d M Y'); ?></i>
				</div>
			</div>
			<?php 
					}
				}else{
					echo 'Tidak Ada Promo.';
				}
			?>
			</div>
		</div>	
	</div>
</div>
</div>
