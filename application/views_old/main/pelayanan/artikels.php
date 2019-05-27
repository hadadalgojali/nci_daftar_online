<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$common=$this->common;
?>
<br>
<div class="container">
<div class="row">
	<div class="col-md-3">
		<?php include('menu.php'); ?>
	</div>
	<div class="col-md-9">
		<div class="menu-left-head">
			<h5> <strong>Artikel</strong></h5>
			<div class="menu-left" style="padding: 0px !important;">
			<?php 
				$now=new DateTime();
				$promos=$this->common->queryResult("SELECT M.*,A.first_name,A.last_name
							FROM rs_artikel M INNER JOIN app_employee A ON M.oleh=A.employee_id
							 ORDER BY tanggal");
				if($promos){
					for($i=0; $i<count($promos) ; $i++){
						$promo=$promos[$i];
						$tanggal=new DateTime($promo->tanggal);
			?>
			<div class="menu-left-head sub"  style="font-size: 12px;">
				<span><strong><a href="<?php echo base_url() ;?>pelayanan/artikel?i=<?php echo $promo->artikel_id; ?>"><?php echo $promo->judul; ?></a></strong></span> <span><font style="color:#777;font-size: 10px;"><?php echo $promo->first_name;  ?> <?php echo $promo->last_name;  ?> (<?php  echo $tanggal->format('d M Y'); ?>)</font></span>
				<div class="menu-left" style="padding: 10px;">
				<?php echo $common->stringLimit($promo->isi,20); ?><br>
				</div>
			</div>
			<?php 
					}
				}else{
					echo 'Tidak Isi.';
				}
			?>
			</div>
		</div>	
	</div>
</div>
</div>
