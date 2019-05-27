<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="menu-left-head">
	<h5> <strong>Layanan</strong> Lainnya</h5>
	<a href="<?php echo base_url()?>pelayanan/pelayananrs?page=1&title=UGD&sub_title=UGD&type=UNITTYPE_UGD"><div class="menu-left button first" style=""><h5><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <strong> UGD </strong></h5></div></a>
	<a href="javascript:void(0);"  id="btnRwj" show="N"><div class="menu-left button first" style=""><h5><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <strong> R. Jalan </strong></h5></div></a>
<?php 
	$common=$this->common;
	$rwjList=$common->createQuery("SELECT A FROM ".$common->getModel('Unit')." A 
			INNER JOIN A.unitType B WHERE B.optionCode='UNITTYPE_RWJ' AND A.activeFlag=true")->getResult();
	for($i=0; $i<count($rwjList) ;$i++){
		$unit=$rwjList[$i];
?>
	<a href="<?php echo base_url()?>pelayanan/pelayananrs?page=<?php echo $unit->getId(); ?>&title=Rawat Jalan&sub_title=<?php echo $unit->getUnitName(); ?>&type=<?php echo $unit->getUnitType()->getOptionCode(); ?>" class="btn-rwj" style="display: none;"><div class="menu-left button first" style=""><h5>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> &nbsp;<?php echo $unit->getUnitName(); ?></h5></div></a>
<?php
	}
?>
	<a href="javascript:void(0);" id="btnRwi" show="N"><div class="menu-left button first" style=""><h5><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <strong> R. Inap</strong></h5></div></a>
<?php 
	$rwjList=$common->createQuery("SELECT A FROM ".$common->getModel('Unit')." A 
			INNER JOIN A.unitType B WHERE B.optionCode='UNITTYPE_RWI' AND A.activeFlag=true")->getResult();
	for($i=0; $i<count($rwjList) ;$i++){
		$unit=$rwjList[$i];
?>
	<a href="<?php echo base_url()?>pelayanan/pelayananrs?page=<?php echo $unit->getId(); ?>&title=Rawat Inap&sub_title=<?php echo $unit->getUnitName(); ?>&type=<?php echo $unit->getUnitType()->getOptionCode(); ?>" class="btn-rwi" style="display: none;"><div class="menu-left button first" style=""><h5>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> &nbsp;<?php echo $unit->getUnitName(); ?></h5></div></a>
<?php
	}
?>
	<a href="javascript:void(0);"  id="btnPen" show="N"><div class="menu-left button first" style=""><h5><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <strong> Penunjang </strong>Medis</h5></div></a>
	<?php 
	$rwjList=$common->createQuery("SELECT A FROM ".$common->getModel('Unit')." A 
			INNER JOIN A.unitType B WHERE B.optionCode IN('UNITTYPE_LAB','UNITTYPE_RAD','UNITTYPE_PEN') AND A.activeFlag=true")->getResult();
	for($i=0; $i<count($rwjList) ;$i++){
		$unit=$rwjList[$i];
?>
	<a href="<?php echo base_url()?>pelayanan/pelayananrs?page=<?php echo $unit->getId(); ?>&title=Penunjang Medis&sub_title=<?php echo $unit->getUnitName(); ?>&type=<?php echo $unit->getUnitType()->getOptionCode(); ?>" class="btn-pen" style="display: none;"><div class="menu-left button first" style=""><h5>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> &nbsp;<?php echo $unit->getUnitName(); ?></h5></div></a>
<?php
	}
?>
</div>
<script>
	$(function(){
		$('#btnRwi').bind('click',function(){
			if($('#btnRwi').attr('show')=='N'){
				$('.btn-rwi').show();
				$('#btnRwi').attr('show','Y');
			}else{
				$('.btn-rwi').hide();
				$('#btnRwi').attr('show','N');
			}
		});
		$('#btnRwj').bind('click',function(){
			if($('#btnRwj').attr('show')=='N'){
				$('.btn-rwj').show();
				$('#btnRwj').attr('show','Y');
			}else{
				$('.btn-rwj').hide();
				$('#btnRwj').attr('show','N');
			}
		});
		$('#btnPen').bind('click',function(){
			if($('#btnPen').attr('show')=='N'){
				$('.btn-pen').show();
				$('#btnPen').attr('show','Y');
			}else{
				$('.btn-pen').hide();
				$('#btnPen').attr('show','N');
			}
		});
	});
	
</script>