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
			<h5> <strong>Artikel</strong></h5>
			<div class="menu-left" style="padding: 0px !important;">
			<?php 
				
				$artikel=$this->common->queryRow("SELECT M.*,A.first_name,A.last_name
							FROM rs_artikel M INNER JOIN app_employee A ON M.oleh=A.employee_id
							WHERE artikel_id=".$_GET['i']);
				if($artikel){
						$now=new DateTime($artikel->tanggal);
			?>
			<div class="menu-left-head sub"  style="font-size: 12px;">
				<span><strong><?php echo $artikel->judul; ?></strong></span> <span><font style="color:#777;font-size: 10px;"></font></span>
				<div class="menu-left" style="padding: 10px;">
				<?php echo $artikel->isi; ?><br>
				</div>
			</div>
			<?php 
				}else{
					echo 'Tidak Isi.';
				}
			?>
			
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.6";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-comments" data-href="<?php echo base_url(); ?>pelayanan/artikel?i=<?php echo $artikel->artikel_id; ?>" data-numposts="5"></div>
			
			</div>
			
		</div>	
	</div>
</div>
</div>
