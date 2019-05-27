<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$common=$this->common;
$now=new DateTime();

?>
<br>
<script src="<?php echo base_url()?>vendor/jquery.tabulate.js"></script>
<div class="container">
<div class="row">
	<div class="col-md-2">
		<?php include('menu_main.php'); ?>
	</div>
	<div class="col-md-10">
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
		<?php 
			if($this->session->get('SUCCESS') != null){
		?>
			<div class="alert alert-success" role="alert" >
				<?php echo $this->session->get('SUCCESS'); ?>
			</div>
		<?php
				$this->session->delete('SUCCESS');
			}
		?>
		<div class="menu-left-head">
			<h5> <strong>List</strong> Rujukan Balik</h5>
			
			<div class="menu-left" style="padding: 0px !important;">
				<div class="menu-left" style="padding: 10px;">
				<div class="form-group row">
					<div class="col-md-4">
						<label>&nbsp; &nbsp; Nomor Rujukan:</label>
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
								<th>No. Rujukan</th>
								<th>Tgl Rujukan</th>
								<th>Pasien</th>
								<th>Aksi</th>
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
				url: '<?php echo base_url() ;?>puskesmas/searchListRujukanBalik?page='+page+'&text='+$('#nama').val(),
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
				case 2:
					return item.f3;
				case 3:
					return item.f4;
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