<?php
/**
* @Author Ade jaenudin
* @Copyright NCI 2017
*/
class Pilihkertas
{
	public function PageLength($tipe)
	{
		if ($tipe==='laporan') # UKURAN KERTAS NORMAL 
		{
			return chr(27) . chr(67) . chr(66);
		} 
		elseif ($tipe==='laporan/2') # UKURAN KERTAS LAPORAN DIBAGI 2
		{
			return chr(27) . chr(67) . chr(33);
		} 
		elseif ($tipe==='laporan/3') # UKURAN KERTAS LAPORAN DIBAGI 3
		{
			return chr(27) . chr(67) . chr(22);
		}
	} 
}
?>