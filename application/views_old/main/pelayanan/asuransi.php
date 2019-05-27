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
		<div class="menu-left-head">
			<h5> <strong>Asuransi / Perusahaan yang bekerja sama</strong></h5>
			<div class="menu-left" style="padding: 0px !important;">
				
			<div class="menu-left" style="padding: 10px;">
				<div class="form-group row">
					<div class="col-md-4">
						<label>&nbsp; &nbsp; Nama Perusahaan/ Asuransi:</label>
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
								<th>Nama Perusahaan</th>
								<th>Jenis</th>
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
				url: '<?php echo base_url() ;?>pelayanan/searchCustomer?page='+page+'&text='+$('#nama').val(),
				dataType: 'json'
			});
		};
		var renderer = function (r, c, item) {
			switch(c)
			{
				case 0:
					return item.f1;

				case 1:
					return item.f2;

				default:
					return item.f1;
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