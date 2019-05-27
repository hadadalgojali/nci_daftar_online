<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$dokter=$this->common->find('Employee',$this->input->get('dokter_id'));
	$foto=$dokter->getFoto();
?>
<link href="<?php echo base_url()?>vendor/select2-3.5.4/select2.css" rel="stylesheet">
<script src="<?php echo base_url()?>vendor/select2-3.5.4/select2.min.js"></script>
<script src="<?php echo base_url()?>vendor/jquery.tabulate.js"></script>
<br>
<div class="container">
<div class="row">
	<div class="col-md-3">
		<?php include('menu.php'); ?>
	</div>
	<div class="col-md-9">
		<div class="menu-left-head">
			<h5> <strong><?php echo $dokter->getFirstName(); ?></strong><?php echo $dokter->getSecondName(); ?> <?php echo $dokter->getLastName(); ?></h5>
			<div class="menu-left">
				<div class="menu-left-head sub" style="padding-left: 0px;">
					<strong>Profile</strong>
					<div class="menu-left" style="padding: 10px;">
						<div class="form-group row">
							<div class="col-md-3">
								<img style="width: 150px;height: 170px;border: 10px solid white;margin: 0px 15px 15px 0px !important; box-shadow: 0px 15px 20px -10px rgba(0, 0, 0, 0.7); -webkit-box-shadow: 0px 15px 20px -10px rgba(0, 0, 0, 0.7); -moz-box-shadow: 0px 15px 20px -10px rgba(0, 0, 0, 0.7); " src='<?php echo base_url().'upload/'.$foto; ?>' >
							</div>
							<div class="col-md-9">
								<div class="form-group row">
									<div class="col-md-3">
										<label>Nama Lengkap</label>
									</div>
									<div class="col-md-8">
										: <?php echo $dokter->getFirstName().' '.$dokter->getSecondName().' '.$dokter->getLastName(); ?>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-3">
										<label>Tempat/Tgl Lahir</label>
									</div>
									<div class="col-md-8">
										: <?php echo $dokter->getBirthPlace().', '.$dokter->getBirthDate()->format('d M Y'); ?>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-3">
										<label>Email</label>
									</div>
									<div class="col-md-8">
										: <?php echo $dokter->getEmailAddress(); ?>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-3">
										<label>Telepon</label>
									</div>
									<div class="col-md-8">
										: <?php echo $dokter->getPhoneNumber1(); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="menu-left-head sub" style="padding-left: 0px;">
					<strong>Jadwal Dokter</strong>
					<div class="menu-left" style="padding: 10px;">
						<div class="form-group row">
							<div class="col-md-12">
								<table id="tab" class="table table-striped">
									<thead>
										<th>Poliklinik</th>
										<th>Hari(Jam)</th>
										<th>Daftar Online</th>
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
			</div>
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
				url: '<?php echo base_url() ;?>pelayanan/searchJadwalDokter?page='+page+'&dokter=<?php echo $this->input->get('dokter_id') ;?>',
				dataType: 'json'
			});
		};
		var renderer = function (r, c, item) {
			switch(c){
				case 0:
					return item.poli;

				case 1:
					return item.hari;

				case 2:
					return item.btnDaftar;

				default:
					return item.poli;
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
			console.error(arguments);
			alert('Failed!');
		});
		tab.trigger('load');
</script>