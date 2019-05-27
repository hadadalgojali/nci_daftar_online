<?php   
if (!defined('BASEPATH')) exit('No direct script access allowed');  

function pdf($prop=array()){  
    require_once("dompdf/dompdf_config.inc.php");  
   // spl_autoload_register('DOMPDF_autoload');  
    $config=array(
    		'html'=>'Undefined',
    		'paper'=>'A4',
    		'name'=>'none',
    		'type'=>'potrait',
    		'margin-top'=>60,
    		'margin-right'=>60,
    		'margin-bottom'=>60,
    		'margin-left'=>60,
    		'page-number'=>true,
    );
    foreach($prop as $value=>$isi){
    	$config[$value]=$isi;
    }
    $ht="";
    $dompdf = new DOMPDF(); 
    $html="<html>
  				<body>
    		<style>
	    		@page { margin: 0px; }
				body { margin: ".$config['margin-top']."px ".$config['margin-right']."px ".$config['margin-bottom']."px ".$config['margin-left']."px ; }
				*{
					font-family: Arial, Helvetica, sans-serif;
				}
				.header{
					font-weight:bold;
					font-size: 12px;
					margin-bottom: 10px;
				}
				th{
					text-transform: uppercase;	
				}
				table{
	   				width: 100%;
   					border-collapse: collapse;
   					font-size: 10px;
   				}
    		</style>
						";
    $html.=$config['html'];
    $html.="</body></html>";
    $dompdf->load_html($html);
	$dompdf->set_paper($config['paper'],$config['type']);  
    $dompdf->render();  
    if($config['page-number']==true){
    	$canvas = $dompdf->get_canvas();
    	$font = Font_Metrics::get_font("helvetica", "bold");
    	$canvas->page_text($canvas->get_width()-50, $canvas->get_height()-20,"{PAGE_NUM} / {PAGE_COUNT}", $font, 9, array(0,0,0));
    }
	$dompdf->stream($config['name'].".pdf", array("Attachment" => 0));
}