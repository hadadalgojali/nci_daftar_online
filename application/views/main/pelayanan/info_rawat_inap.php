<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
			<h5> <strong>Info</strong> Rawat Inap</h5>
			<div class="menu-left" style="padding: 10px;">
				<div class="form-group row">
					<div class="col-md-2">
						Nama Pasien:
					</div>
					<div class="col-md-4">
						<div id="tgllahira" class="input-group">
							<input type="text" class="form-control" id="nama" name="nama" required>
							<span class="add-on input-group-addon" id="btnSearch">
								<span class="glyphicon glyphicon-search"></span>
							</span>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<table id="tab" class="table table-striped">
							<thead>
								<th>No. Medrec</th>
								<th>Nama Pasien</th>
								<th>Ruangan</th>
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
	$('#nama').keyup(function(e){
		if(e.keyCode==13){
			tab.trigger('load');
		}
	});	
		var xhr = function () {
			console.log(arguments);
			var page=1;
			if(arguments[0] != undefined){
				page=arguments[0].page;
			}
			return $.ajax({
				url: '<?php echo base_url() ;?>pelayanan/searchRWI?page='+page+'&text='+$('#nama').val(),
				dataType: 'json'
			});
		};
		var renderer = function (r, c, item) {
			switch(c)
			{
				case 0:
					return item.no_medrec;

				case 1:
					return item.nama;

				case 2:
					return item.no;

				default:
					return item.no;
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