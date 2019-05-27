<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
		<?php 
			if($this->session->get('ERROR') != null){
		?>
			<div class="alert alert-danger" role="alert" >
				<?php echo $this->session->get('ERROR'); ?>
			</div>
		<?php
				$this->session->delete('ERROR');
			}
		?>
		<div class="menu-left-head">
			<h5> <strong>Jadwal</strong> Dokter</h5>
			<div class="menu-left" style="padding: 10px;">
				<div class="form-group row">
					<div class="col-md-2">
						<label for="kelurahan">Poliklinik:</label>
					</div>
					<div class="col-md-3">
						<input type="hidden" id="poliklinik" name="poliklinik" style="width: 100%">
						<script>
							$('#poliklinik').select2({
								placeholder:'Pilih',
								allowClear:true,
								  ajax: {
									url: "<?php echo base_url()?>daftar/getUnit",
									dataType: 'json',
									delay: 2000,
									data: function (params) {
										return {
											text: params
										};
									},
									processResults: function (data, page) {
										return {
											results: data.data
										};
									},
									cache: true
								},
							});
						</script>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-2">
						<label for="hari">Hari:</label>
					</div>
					<div class="col-md-3">
						<select id="hari" class="form-control" name="hari" required>
							<option value="">Pilih</option>
							<?php
								for($i=0; $i<count($DAY) ; $i++){
									$param=$DAY[$i];
									echo '<option value="'.$param['id'].'">'.$param['text'].'</option>';
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-2">
						<label for="kelurahan">Dokter:</label>
					</div>
					<div class="col-md-3">
						<input type="hidden" id="dokter" name="dokter" style="width: 100%">
						<script>
							$('#dokter').select2({
								placeholder:'Pilih',
								allowClear:true,
								  ajax: {
									url: "<?php echo base_url()?>daftar/getDokter",
									dataType: 'json',
									delay: 2000,
									data: function (params) {
										return {
											text: params
										};
									},
									processResults: function (data, page) {
										return {
											results: data.data
										};
									},
									cache: true
								},
							});
						</script>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-2">
					</div>
					<div class="col-md-3">
						<button type="submit" id="btnSearch" class="btn btn-success">Cari</button>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<table id="tab" class="table table-striped">
							<thead>
								<th>Hari(Jam)</th>
								<th>Poliklinik</th>
								<th>Nama Dokter</th>
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
<script type="text/javascript">
	var tab = $('#tab');
	$('#btnSearch').bind('click',function(){
		tab.trigger('load');
	});	
		var xhr = function () {
			console.log(arguments);
			var page=1;
			if(arguments[0] != undefined){
				page=arguments[0].page;
			}
			return $.ajax({
				url: '<?php echo base_url() ;?>pelayanan/searchJadwalDokter?page='+page+'&unit='+$('#poliklinik').val()+'&dokter='+$('#dokter').val()+'&hari='+$('#hari').val(),
				dataType: 'json'
			});
		};
		var renderer = function (r, c, item) {
			switch(c)
			{
				case 0:
					return item.hari;

				case 1:
					return item.poli;

				case 2:
					return item.dokter;

				case 3:
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