<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Test extends MY_Controller {
	public function sendMail(){
	//setup variables from input    
		 $EMAIL = "the_aska@yahoo.com";    
		
		 //setup message    
		 $message = "Enquiry from: ";
		
		 $message = wordwrap($message, 70);   
		
		 $headers = "From: mseiz93@gmail.com\n";
		 $headers .= "MIME-Version: 1.0\n";
		 $headers .= "Content-type: text/plain\n";
		
		 //email enquiry details to site owner    
		 if (mail($EMAIL, "test", $message, $headers))    
		 {    
		  echo "Enquiry sent!";    
		 } else {
		  echo "fail!";    
		 }
	}
	public function splitString(){
		print_r(str_split(00324242,2));
		echo is_numeric('1awd');
	}
	/*
	public function exportExcel(){
		 //load our new PHPExcel library
		 $this->load->library('excel');
		 //activate worksheet number 1
		 $this->excel->setActiveSheetIndex(0);
		 $book=$this->excel->getActiveSheet();
		 //name the worksheet
		 $book->setTitle('test worksheet');
		 //set cell A1 content with some text
		 $book->setCellValue('A1', 'This is just some text value');
		 //change the font size
		 $book->getStyle('A1')->getFont()->setSize(20);
		 //make the font become bold
		 $book->getStyle('A1')->getFont()->setBold(true);
		 //merge cell A1 until D1
		 $book->mergeCells('A1:D1');
		 //set aligment to center for that merged cell (A1 to D1)
		 $book->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 
		 $filename='just_some_random_name.xls'; //save our workbook as this file name
		 header('Content-Type: application/vnd.ms-excel'); //mime type
		 header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		 header('Cache-Control: max-age=0'); //no cache
		
		 //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		 //if you want to save it as .XLSX Excel 2007 format
		 $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		 //force user to download the Excel file without writing it to server's HD
		 $objWriter->save('php://output');
	}
	*/
	public function encrypt(){
		$Pass = "Passwort";
		$Clear = "1000000";
		
		
		
		function fnEncrypt($sValue, $sSecretKey)
		{
			return rtrim(
					base64_encode(
							mcrypt_encrypt(
									MCRYPT_RIJNDAEL_256,
									$sSecretKey, $sValue,
									MCRYPT_MODE_ECB,
									mcrypt_create_iv(
											mcrypt_get_iv_size(
													MCRYPT_RIJNDAEL_256,
													MCRYPT_MODE_ECB
											),
											MCRYPT_RAND)
							)
					), "\0"
			);
		}
		
		function fnDecrypt($sValue, $sSecretKey)
		{
			return rtrim(
					mcrypt_decrypt(
							MCRYPT_RIJNDAEL_256,
							$sSecretKey,
							base64_decode($sValue),
							MCRYPT_MODE_ECB,
							mcrypt_create_iv(
									mcrypt_get_iv_size(
											MCRYPT_RIJNDAEL_256,
											MCRYPT_MODE_ECB
									),
									MCRYPT_RAND
							)
					), "\0"
			);
		}
		$crypted = fnEncrypt($Clear, $Pass);
		echo "Encrypred: ".$crypted."</br>";
		
		$newClear = fnDecrypt($crypted, $Pass);
		echo "Decrypred: ".$newClear."</br>";
		$this->load->library('encrypt');
		echo $this->encrypt->encode('ayam');
		//$this->encrypt->decode();
	}
	public function migratePenyakit(){
		$admin_db= $this->load->database('MEDISMART', TRUE);
		$query = $admin_db->query('select * from penyakit')->result();
		for($i=0,$iLen=count($query); $i<$iLen ; $i++){
			$o=$query[$i];
			$mod=$this->common->newModel('Penyakit');
			$penyakit=$this->common->find('Penyakit',$o->kd_penyakit);
			if($penyakit==null){
				$mod->setKodePenyakit($o->kd_penyakit)
				->setParent($o->parent)
				->setPenyakit($o->penyakit)
				->setIncludes($o->includes)
				->setExclude($o->excludes)
				->setNote($o->notes)
				->setStatus($o->status_app)
				->setDescription($o->description)
				->setNonRujukanFlag(false)
				->save();
			}
		}
		echo json_encode($query);
		
	}
	public function exportExcel(){
		header("Content-Type: application/vnd.ms-excel");
		header("Expires: 0");
		header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
		header("Content-disposition: attachment; filename=export.xls");
		echo '<table border="1">
				<tr>
					<td>
				awd
					</td>
				<td>
				dawdwd
				</td>
				</tr>
				</table>';
	}
	public function exportWord(){
		header("Content-Type: application/vnd.ms-word");
		header("Expires: 0");
		header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
		header("Content-disposition: attachment; filename=export.doc");
		echo 'ayam';
	}
	public function binary(){
		$ayam=decbin(ord('ayam'));
		echo $ayam;
	}
	public function getDb(){
		$admin_db= $this->load->database('SIM', TRUE);
		$query = $admin_db->query('select * from whms_patients')->row();
		echo json_encode($query);
	}
	public function index() {
		$date = date_create ( '08:00:00' );
		echo 'Waktu awal: 20-02-2012 19:30:20<br/>';
		date_add ( $date, date_interval_create_from_date_string ( '20 minutes' ) );
		date_add ( $date, date_interval_create_from_date_string ( '20 minutes' ) );
		echo 'Tambahkan 30 menit: ' . date_format ( $date, 'H:i:s' ) . '<br/><br/>';
		
		$now = new DateTime ();
		echo $now->format ( 'H:i:s' ) . '<br>';
		echo hash ( 'md5', '12345678' ) . '<br>';
		$seq = $this->common->getNextSequence ( 'MEDREC' );
		echo $seq ['val'] . '<br>';
		$this->load->helper('directory');
		//foreach ( directory_map ( './app/programs' ) as $key => $name ) {
		//	echo $key;
			//$c = array ();
			//$a = json_decode ( read_file ( './app/programs/' . $key . 'init.js' ) );
			//$c ['id'] = $a->code;
			//$c ['text'] = $a->name;
			//$o ['programList'] [] = $c;
		//}
		$url=base_url().'app';
		$map = directory_map ( './app' );
		$this->getDirectory($map,$url);
		
		date_default_timezone_set('UTC');
		$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
		$data = "22660";
		$secretKey = "5mMA57F0DE";
		// Computes the timestamp
		
		// Computes the signature by hashing the salt with the secret key as the key
		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		
		// base64 encode…
		$encodedSignature = base64_encode($signature);
		
		// urlencode…
		// $encodedSignature = urlencode($encodedSignature);
		
		echo "X-cons-id: " .$data ."<br>";
		echo "X-timestamp:" .$tStamp ."<br>";
		echo "X-signature: " .$encodedSignature;
		$content='<img width="217" height="113" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAY4AAADPCAYAAADidzYBAAASK0lEQVR4nO3dXYxc5X3H8e+FL3zhC69kyb5AsApVy0VAaBUJalGVl0ogQBVClpqoSYtcK4I2QkjEShAJ2hCpRKXEdbFKJUJDGingIGqRpEAbE0zqZNPSlJbIwSHlxRBMKcSYF7+vPb347+mcmZ3dnbN75jxzzvl+pEdaz779PT7j35zz/M/zgCRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiSp5iaA6b5xZbJqpHJcSe8xPZGwFqlxzgVm6H2R7cQXmuprEthG93jeDtyarhypec4lXmR5eow4I1FN/C+24CqNLxPH3vmpC2m4NUTr7XmpC1lAPkBOYoCMvYuJd3y24CqF49iCW4VPEneGjzsDpCb+GVtwlUbWgntr6kJa4LvAdSX9rLuJe0C2MbpJdgNkjK0jzjZswVUKb+GxV4V1wJvEyhArdRWxrtVZwPeJ1XRHaRNxB7oBMkayO8UfTl2IWifr5HssdSEt8BkG37exGZieGxO5x6dzY6r/JKYGPCY1kcEhSSrE4JAkFTKJq3pIkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkqTC/g9W561Faz0ASAAAAABJRU5ErkJggg==">
				<img width="217" height="113" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAY4AAADPCAYAAADidzYBAAASK0lEQVR4nO3dXYxc5X3H8e+FL3zhC69kyb5AsApVy0VAaBUJalGVl0ogQBVClpqoSYtcK4I2QkjEShAJ2hCpRKXEdbFKJUJDGingIGqRpEAbE0zqZNPSlJbIwSHlxRBMKcSYF7+vPb347+mcmZ3dnbN75jxzzvl+pEdaz779PT7j35zz/M/zgCRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiSp5iaA6b5xZbJqpHJcSe8xPZGwFqlxzgVm6H2R7cQXmuprEthG93jeDtyarhypec4lXmR5eow4I1FN/C+24CqNLxPH3vmpC2m4NUTr7XmpC1lAPkBOYoCMvYuJd3y24CqF49iCW4VPEneGjzsDpCb+GVtwlUbWgntr6kJa4LvAdSX9rLuJe0C2MbpJdgNkjK0jzjZswVUKb+GxV4V1wJvEyhArdRWxrtVZwPeJ1XRHaRNxB7oBMkayO8UfTl2IWifr5HssdSEt8BkG37exGZieGxO5x6dzY6r/JKYGPCY1kcEhSSrE4JAkFTKJq3pIkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkiRJkqTC/g9W561Faz0ASAAAAABJRU5ErkJggg==">';
		
		
		function data_to_img($match) {
			list(, $img, $type, $base64, $end) = $match;
		
			$bin = base64_decode($base64);
			$md5 = md5($bin);   // generate a new temporary filename
			$fn = "$md5.$type";
			file_exists($fn) or file_put_contents($fn, $bin);
		
			return "$img$fn$end";  // new <img> tag
		}
		echo preg_replace_callback('#(<img\s(?>(?!src=)[^>])*?src=")data:image/(gif|png|jpeg);base64,([\w=+/]++)("[^>]*>)#', "data_to_img", $content);
// 		$pdf=array('html'=>'ayam','name'=>'kamana');
// 		pdf($pdf);
	}
	private function getDirectory($map,$url){
		foreach ($map as $key=>$name){
			if(gettype($name)=='array'){
				$this->getDirectory($map[$key],$url.'/'.$key);
			}else{
				echo $url.'/'.$name.'<br>';
			}
			
		}
	}
}