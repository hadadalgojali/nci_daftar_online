<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
$common = $this->common;
$unitQuery = $common->createQuery ( "SELECT A FROM  " . $common->getModel ( 'UnitAbout' ) . " A
	INNER JOIN A.unit B
	WHERE B.id=" . $this->input->get ( 'page' ) );
if (($this->input->get ( 'type' ) != null && $this->input->get ( 'type' ) == 'UNITTYPE_RWJ') || ($this->input->get ( 'type' ) != null && $this->input->get ( 'type' ) == 'UNITTYPE_RWI')) {
?>
<script src="<?php echo base_url()?>vendor/jquery.tabulate.js"></script>
<?php 
	}
?>
<br>
<div class="container">
	<div class="row">
		<div class="col-md-3">
		<?php include('menu_layanan.php'); ?>
	</div>
		<div class="col-md-9">
			<div class="menu-left-head">
				<h5>
					<strong><?php echo $this->input->get('title');?></strong>
				</h5>
				<div class="menu-left" style="padding: 0px;">
				
			<?php 
				
				if($unitQuery->getResult()){
					$unitAbout=$unitQuery->getSingleResult();
					
			?>
				<div class="menu-left-head sub">
						<strong><?php echo $unitAbout->getJudul(); ?></strong>
						<div class="menu-left" style="padding: 10px;">
							<div
								style="-moz-column-count: 3; -moz-column-gap: 10px; -webkit-column-count: 2; -webkit-column-gap: 10px; column-count: 2; text-align: justify; column-gap: 10px;">
								<img
									style="border: 10px solid white;margin: 0px 15px 15px 0px !important; box-shadow: 0px 15px 20px -10px rgba(0, 0, 0, 0.7); -webkit-box-shadow: 0px 15px 20px -10px rgba(0, 0, 0, 0.7); -moz-box-shadow: 0px 15px 20px -10px rgba(0, 0, 0, 0.7); width: 95% !important;"
									src="<?php echo base_url().'upload/'.$unitAbout->getImageName(); ?>"></img>
							<?php echo $unitAbout->getDescription(); ?>
						</div>
							<p>
							
							
							<div class="form-group row">
								<div class="col-md-12">
									<label for="gelar">Telepon :</label>  <?php echo $unitAbout->getPhoneNumber(); ?>
							</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="gelar">Email :</label>  <?php echo $unitAbout->getEmail(); ?>
							</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="gelar">Informasi :</label>  <?php echo $unitAbout->getInformation(); ?>
							</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="gelar">Alamat :</label>  <?php echo $unitAbout->getAddress(); ?>
							</div>
							</div>
						</div>
					</div>
			<?php 
					}else{
			?>
				<div class="menu-left-head sub">
						<strong><?php echo $this->input->get('sub_title');?></strong>
						<div class="menu-left" style="padding: 10px;">Tidak Ada Informasi
						</div>
					</div>
			<?php 
					}
					if($this->input->get('type') != null && $this->input->get('type')=='UNITTYPE_RWJ'){
			?>
				<div class="menu-left-head sub">
						<strong>Jadwal Dokter</strong>
						<div class="menu-left" style="padding: 10px;">
							<div class="form-group row">
								<div class="col-md-12">
									<table id="tab" class="table table-striped">
										<thead>
											<th>Hari(Jam)</th>
											<th>Nama Dokter</th>
											<th>Pendaftaran Online</th>
										</thead>
										<tbody>
										</tbody>
										<tfoot>
										<td  colspan="4">
											<ul id="paging" class="pagination">
											</ul>
										</td>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>	
					<script type="text/javascript">
						var tab = $('#tab');
							var xhr = function () {
								console.log(arguments);
								var page=1;
								if(arguments[0] != undefined){
									page=arguments[0].page;
								}
								return $.ajax({
									url: '<?php echo base_url() ;?>pelayanan/searchJadwalDokter?page='+page+'&unit=<?php echo $this->input->get ( 'page' );?>',
									dataType: 'json'
								});
							};
							var renderer = function (r, c, item) {
								switch(c)
								{
									case 0:
										return item.hari;
					
									case 1:
										return item.dokter;

									case 2:
										return item.btnDaftar;
					
									default:
										return item.hari;
								}
							};
							tab.tabulate({
								source: xhr,
								renderer: renderer,
								pagination: $('#paging'),
								pagesI18n: function(str) {
									switch(str) {
										case 'next':
											return 'Aage';
					
										case 'prev':
											return 'Peeche';
									}
								}
							})
							.on('loadfailure', function (){
							});
							tab.trigger('load');
					</script>
						<?php 
					}else if($this->input->get('type') != null && $this->input->get('type')=='UNITTYPE_RWI'){
						?>
					<div class="menu-left-head sub">
							<strong>Info Kamar</strong>
							<div class="menu-left" style="padding: 10px;">
								<div class="form-group row">
									<div class="col-md-12">
										<table id="tab" class="table table-striped">
											<thead>
												<th>Nama Kamar</th>
												<th>Jumlah Bed</th>
												<th>Sisa</th>
											</thead>
											<tbody>
											</tbody>
											<tfoot>
											<td  colspan="4">
												<ul id="paging" class="pagination">
												</ul>
											</td>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>	
						<script type="text/javascript">
							var tab = $('#tab');
								var xhr = function () {
									console.log(arguments);
									var page=1;
									if(arguments[0] != undefined){
										page=arguments[0].page;
									}
									return $.ajax({
										url: '<?php echo base_url() ;?>pelayanan/searchKamar?page='+page+'&unit=<?php echo $this->input->get ( 'page' );?>',
										dataType: 'json'
									});
								};
								var renderer = function (r, c, item) {
									switch(c)
									{
										case 0:
											return item.namaKamar;
						
										case 1:
											return item.jumlahKasur;
	
										case 2:
											return item.sisa;
						
										default:
											return item.sisa;
									}
								};
								tab.tabulate({
									source: xhr,
									renderer: renderer,
									pagination: $('#paging'),
									pagesI18n: function(str) {
										switch(str) {
											case 'next':
												return 'Aage';
						
											case 'prev':
												return 'Peeche';
										}
									}
								})
								.on('loadfailure', function (){
								});
								tab.trigger('load');
						</script>
			<?php 
					}
			?>		
			</div>
			</div>
		</div>
	</div>
</div>