<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');
class Common {
	protected $model=array(
			// app
			'Banner'=>'Entity\app\Banner',
			'DynamicOption'=> 'Entity\app\DynamicOption',
			'Employee'=> 'Entity\app\a5\Employee',
			'Error'=> 'Entity\app\Error',
			'Job'=> 'Entity\app\a16\Job',
			'Menu'=> 'Entity\app\a2\Menu',
			'Role'=> 'Entity\app\a3\Role',
			'RoleMenu'=> 'Entity\app\a3\RoleMenu',
			'ParameterOption'=> 'Entity\app\a4\ParameterOption',
			'Parameter'=> 'Entity\app\a4\Parameter',
			'PDFTemplate'=> 'Entity\app\a9\PDFTemplate',
			'Sequence'=> 'Entity\app\a8\Sequence',
			'SystemProperty'=> 'Entity\app\a6\SystemProperty',
			'Tenant'=> 'Entity\app\a12\Tenant',
			'User'=> 'Entity\app\a7\User',
			// content
			'Patient'=> 'Entity\content\Patient',
			'Country'=> 'Entity\content\Country',
			'Penyakit'=> 'Entity\content\Penyakit',
			'PenyakitNonRujukan'=> 'Entity\content\PenyakitNonRujukan',
			'Faskes'=> 'Entity\content\Faskes',
			'FaskesAccount'=> 'Entity\content\FaskesAccount',
			'SimulasiPembayaran'=> 'Entity\content\SimulasiPembayaran',
			'FaskesDokter'=> 'Entity\content\FaskesDokter',
			'JadwalPoli'=> 'Entity\content\JadwalPoli',
			'Antrian'=> 'Entity\content\Antrian',
			'Country'=> 'Entity\content\Country',
			'Province'=> 'Entity\content\Province',
			'District'=> 'Entity\content\District',
			'Districts'=> 'Entity\content\Districts',
			'Kelurahan'=> 'Entity\content\Kelurahan',
			'Unit'=> 'Entity\content\Unit',
			'Customer'=> 'Entity\content\Customer',
			'Rujukan'=> 'Entity\content\Rujukan',
			'Penyakit'=> 'Entity\content\Penyakit',
			'Visit'=> 'Entity\content\Visit',
			'PasienInap'=> 'Entity\content\PasienInap',
			'UnitAbout'=> 'Entity\content\UnitAbout' ,
			'Feedback'=> 'Entity\content\Feedback' ,
			'Promo'=> 'Entity\content\Promo' ,
			'Kontraktor'=> 'Entity\content\Kontraktor' ,
			'Kamar'=> 'Entity\content\Kamar' ,
			'Temp'=> 'Entity\content\Temp' ,
			'DokterKlinik'=> 'Entity\content\DokterKlinik' ,
			'Artikel'=> 'Entity\content\Artikel' ,
	);
	public function getEmployee(){
		$ci=& get_instance();
		$session=$ci->pagesession;
		return $session->getUser()->getEmployee();
	}
	public function getUserTenant(){
		$ci=& get_instance();
		$session=$ci->pagesession;
		return $session->getUser()->getTenant();
	}
	public function getTenantFlag(){
		$ci=& get_instance();
		$session=$ci->pagesession;
		return $session->getTenantFlag();
	}
	public function getUser(){
		$ci=& get_instance();
		$session=$ci->pagesession;
		return $session->getUser();
	}
	public function getDefaultTenant(){
		$code=$this->getSystemProperty('DEFAULT_TENANT', null)->getPropertyValue();
		$res=$this->createQuery("SELECT A FROM ".$this->getModel('Tenant')." A WHERE A.tenantCode='".$code."'");
		if($res->getResult())
			return $res->getSingleResult();
		else
			$ci->jsonresult->error()->setMessage("Tenant '".$code."' Tidak Ada.")->end();
	}
	public function getModel($model) {
		return $this->model [$model];
	}
	public function newModel($model) {
		$m=$this->model [$model];
		$mm=new $m();
		return $mm;
	}
	public function getDateTime() {
		return new DateTime();
	}
	public function getTenants() {
		$data=$this->createQuery("SELECT u FROM ".$this->getModel('Tenant')." u
				WHERE u.activeFlag=true")->getResult();
		$a=array();
		for($i=0,$iLen=count($data); $i <$iLen ; $i ++) {
			$o=array();
			$o ['id']=$data [$i]->getId();
			$o ['text']=$data [$i]->getTenantName();
			$a []=$o;
		}
		return $a;
	}
	public function nextSequence($code, $tenant=null, $params=array()) {
		$now=new DateTime();
		$arr=$this->getNextSequence($code, $tenant, $params);
		$val=$arr ['val'];
		$reset=$arr ['reset'];
		$sequence=$arr ['sequence'];
		$nextVal=$arr ['nextVal'];
		$sequence->setLastValue($nextVal);
		if($reset==true)
			$sequence->setLastOn($now);
		$sequence->update();
		return $arr;
	}
	private function getFormatSequence($val, $format, $params=array()) {
		$digit=strlen((string) $val);
		$now=new DateTime();
		if(strpos($format, '(d)') !==false)
			$format=str_replace("(d)", $now->format('d'), $format);
		if(strpos($format, '(D)') !==false)
			$format=str_replace("(D)", $now->format('D'), $format);
		if(strpos($format, '(m)') !==false)
			$format=str_replace("(m)", $now->format('m'), $format);
		if(strpos($format, '(M)') !==false)
			$format=str_replace("(M)", $now->format('M'), $format);
		if(strpos($format, '(y)') !==false)
			$format=str_replace("(y)", $now->format('y'), $format);
		if(strpos($format, '(Y)') !==false)
			$format=str_replace("(Y)", $now->format('Y'), $format);
		for($i=0; $i < $digit; $i ++)
			$format=str_replace("(N".$i.")", substr($val, $i, 1), $format);
		if($params !=null)
			for($i=0,$iLen=count($params); $i <$iLen ; $i ++)
				$format=str_replace("(S".$i.")", $params [$i], $format);
		return $format;
	}
	public function getNextSequence($code, $tenant=null, $params=array()) {
		$ci=& get_instance();
		$now=new DateTime();
		$query='';
		if($tenant==null)
			$query=$query=" AND A.id IS NULL";
		else
			$query=$query=" AND A.id=".$tenant;
		$sequenceQuery=$this->createQuery("SELECT u FROM ".$this->getModel('Sequence')." u 
		LEFT JOIN u.tenant A
		WHERE u.sequenceCode='".$code."' ".$query);
		if($sequenceQuery->getResult()) {
			$sequence=$sequenceQuery->getSingleResult();
			$repType=$sequence->getRepeatType()->getOptionCode();
			if($repType=='REPEAT_NONE') {
				$nextVal=$sequence->getLastValue() + 1;
				$reset=false;
				$jumlahDigit=strlen((string) $nextVal);
				if($jumlahDigit > $sequence->getDigit()) {
					$nextVal=1;
					$reset=true;
					$jumlahDigit=1;
				}
				$sisaDigit=$sequence->getDigit() - $jumlahDigit;
				$val='';
				for($i=0; $i < $sisaDigit; $i ++)
					$val.='0';
				$hasil=$this->getFormatSequence($val.$nextVal, $sequence->getFormat(), $params);
				$arr=array(
						'val'=> $hasil,
						'reset'=> $reset,
						'sequence'=> $sequence,
						'nextVal'=> $nextVal 
				);
				return $arr;
			} else if($repType=='REPEAT_DAY') {
				$reset=false;
				if(strtotime($sequence->getLastOn()->format('Y-m-d')) !=strtotime($now->format('Y-m-d'))) {
					$nextVal=1;
					$jumlahDigit=1;
					$reset=true;
					$sisaDigit=$sequence->getDigit() - $jumlahDigit;
					$val='';
					for($i=0; $i < $sisaDigit; $i ++)
						$val.='0';
					$hasil=$this->getFormatSequence($val.$nextVal, $sequence->getFormat(), $params);
					$arr=array(
							'val'=> $hasil,
							'reset'=> $reset,
							'sequence'=> $sequence,
							'nextVal'=> $nextVal 
					);
					return $arr;
				} else {
					$nextVal=$sequence->getLastValue() + 1;
					$jumlahDigit=strlen((string) $nextVal);
					if($jumlahDigit > $sequence->getDigit()) {
						$nextVal=1;
						$reset=true;
						$jumlahDigit=1;
					}
					$sisaDigit=$sequence->getDigit() - $jumlahDigit;
					$val='';
					for($i=0; $i < $sisaDigit; $i ++)
						$val.='0';
					$hasil=$this->getFormatSequence($val.$nextVal, $sequence->getFormat(), $params);
					$arr=array(
							'val'=> $hasil,
							'reset'=> $reset,
							'sequence'=> $sequence,
							'nextVal'=> $nextVal 
					);
					return $arr;
				}
			} else if($repType=='REPEAT_WEEK') {
				$reset=false;
				$datetime1=new DateTime($now->format('Y-m-d'));
				$datetime2=new DateTime($sequence->getLastOn()->format('Y-m-d'));
				$difference=$datetime1->diff($datetime2);
				if($difference->days > 7) {
					$nextVal=1;
					$jumlahDigit=1;
					$reset=true;
					$sisaDigit=$sequence->getDigit() - $jumlahDigit;
					$val='';
					for($i=0; $i < $sisaDigit; $i ++)
						$val.='0';
					$hasil=$this->getFormatSequence($val.$nextVal, $sequence->getFormat(), $params);
					$arr=array(
							'val'=> $hasil,
							'reset'=> $reset,
							'sequence'=> $sequence,
							'nextVal'=> $nextVal 
					);
					return $arr;
				} else {
					$nextVal=$sequence->getLastValue() + 1;
					$jumlahDigit=strlen((string) $nextVal);
					if($jumlahDigit > $sequence->getDigit()) {
						$nextVal=1;
						$reset=true;
						$jumlahDigit=1;
					}
					$sisaDigit=$sequence->getDigit() - $jumlahDigit;
					$val='';
					for($i=0; $i < $sisaDigit; $i ++)
						$val.='0';
					$hasil=$this->getFormatSequence($val.$nextVal, $sequence->getFormat(), $params);
					$arr=array(
							'val'=> $hasil,
							'reset'=> $reset,
							'sequence'=> $sequence,
							'nextVal'=> $nextVal 
					);
					return $arr;
				}
			} else if($repType=='REPEAT_MONTH') {
				$reset=false;
				$datetime1=new DateTime($now->format('Y-m-d'));
				$datetime2=new DateTime($sequence->getLastOn()->format('Y-m-d'));
				$difference=$datetime1->diff($datetime2);
				if($difference->days > 31) {
					$nextVal=1;
					$jumlahDigit=1;
					$reset=true;
					$sisaDigit=$sequence->getDigit() - $jumlahDigit;
					$val='';
					for($i=0; $i < $sisaDigit; $i ++)
						$val.='0';
					$hasil=$this->getFormatSequence($val.$nextVal, $sequence->getFormat(), $params);
					$arr=array(
							'val'=> $hasil,
							'reset'=> $reset,
							'sequence'=> $sequence,
							'nextVal'=> $nextVal 
					);
					return $arr;
				} else {
					$nextVal=$sequence->getLastValue() + 1;
					$jumlahDigit=strlen((string) $nextVal);
					if($jumlahDigit > $sequence->getDigit()) {
						$nextVal=1;
						$reset=true;
						$jumlahDigit=1;
					}
					$sisaDigit=$sequence->getDigit() - $jumlahDigit;
					$val='';
					for($i=0; $i < $sisaDigit; $i ++)
						$val.='0';
					$hasil=$this->getFormatSequence($val.$nextVal, $sequence->getFormat(), $params);
					$arr=array(
							'val'=> $hasil,
							'reset'=> $reset,
							'sequence'=> $sequence,
							'nextVal'=> $nextVal 
					);
					return $arr;
				}
			} else if($repType=='REPEAT_YEAR') {
				$reset=false;
				$datetime1=new DateTime($now->format('Y-m-d'));
				$datetime2=new DateTime($sequence->getLastOn()->format('Y-m-d'));
				$difference=$datetime1->diff($datetime2);
				if($difference->days > 365) {
					$nextVal=1;
					$jumlahDigit=1;
					$reset=true;
					$sisaDigit=$sequence->getDigit() - $jumlahDigit;
					$val='';
					for($i=0; $i < $sisaDigit; $i ++)
						$val.='0';
					$hasil=$this->getFormatSequence($val.$nextVal, $sequence->getFormat(), $params);
					$arr=array(
							'val'=> $hasil,
							'reset'=> $reset,
							'sequence'=> $sequence,
							'nextVal'=> $nextVal 
					);
					return $arr;
				}else{
					$nextVal=$sequence->getLastValue() + 1;
					$jumlahDigit=strlen((string) $nextVal);
					if($jumlahDigit > $sequence->getDigit()) {
						$nextVal=1;
						$reset=true;
						$jumlahDigit=1;
					}
					$sisaDigit=$sequence->getDigit() - $jumlahDigit;
					$val='';
					for($i=0; $i < $sisaDigit; $i ++)
						$val.='0';
					$hasil=$this->getFormatSequence($val.$nextVal, $sequence->getFormat(), $params);
					$arr=array(
							'val'=> $hasil,
							'reset'=> $reset,
							'sequence'=> $sequence,
							'nextVal'=> $nextVal 
					);
					return $arr;
				}
			}
		}else
			$ci->jsonresult->error()->setMessage("Kode Sequence '".$code."' Tidak Ada.")->end();
	}
	public function getTenant($id) {
		$ci=& get_instance();
		return $this->createQuery("SELECT u FROM ".$this->getModel('Tenant')." u WHERE u.id=".$id)->getSingleResult();
	}
	public function getParams($parameterCode) {
		$ci=& get_instance();
		$data=$this->queryResult("SELECT option_code,option_name FROM app_parameter_option
			WHERE parameter_code='".$parameterCode."' AND active_flag=true ORDER BY line_number ASC");
		$jum=count($data);
		if($jum != 0) {
			$a=array();
			for($i=0,$iLen=$jum; $i <$iLen ; $i++) {
				$d=$data[$i];
				$o=array();
				$o ['id']=$d->option_code;
				$o ['text']=$d->option_name;
				$a []=$o;
			}
			return $a;
		}else
			$ci->jsonresult->error()->setMessage("Parameter Code '".$parameterCode."' Not Found.")->end();
	}
	public function getParamsGelar($parameterCode) {
		$ci=& get_instance();
		$data=$this->queryResult("SELECT * from rs_gelar ORDER BY nama_gelar ASC");
		$jum=count($data);
		if($jum != 0) {
			$a=array();
			for($i=0,$iLen=$jum; $i <$iLen ; $i++) {
				$d=$data[$i];
				$o=array();
				$o ['id']=$d->id;
				$o ['text']=$d->nama_gelar;
				$a []=$o;
			}
			return $a;
		}else
			$ci->jsonresult->error()->setMessage("Parameter Code '".$parameterCode."' Not Found.")->end();
	}
	public function doctrineSave($entity) {
		$ci=& get_instance();
		$em=$ci->doctrine->em;
		$em->getConnection()->beginTransaction();
		try{
			$em->persist($entity);
			$em->flush();
			$em->getConnection()->commit();
		}catch(\Doctrine\DBAL\DBALException $e){
			$em->getConnection()->rollback();
			$this->setError('ERROR_ADD', $e->getMessage());
			$ci->jsonresult->error()->setMessage("Error tidak diketahui.Harap Hubungi Admin.")->end();
			
		}catch(Exception $e){
			$em->getConnection()->rollback();
			$this->setError('ERROR_ADD', $e->getMessage());
			$ci->jsonresult->error()->setMessage("Error tidak diketahui.Harap Hubungi Admin.")->end();
		}
	}
	public function doctrineDelete($entity) {
		$ci=& get_instance();
		$em=$ci->doctrine->em;
		$em->getConnection()->beginTransaction();
		try{
			$em->remove($entity);
			$em->flush();
			$em->getConnection()->commit();
		} catch(\Doctrine\DBAL\DBALException $e) {
			$em->getConnection()->rollback();
			$this->setError('ERROR_DELETE', $e->getMessage());
			$ci->jsonresult->error()->setMessage('Data Sudah Ada Di bagian Lain.')->end();
		} catch(Exception $e) {
			$em->getConnection()->rollback();
			$this->setError('ERROR_DELETE', $e->getMessage());
			$ci->jsonresult->error()->setMessage("Error tidak diketahui.Harap Hubungi Admin.")->end();
		}
	}
	public function setError($errorType,$message){
		$ci=& get_instance();
		$em=$ci->doctrine->em;
		if(!$em->isOpen()) {
			$em=$em->create(
			$em->getConnection(), $em->getConfiguration());
		}
		$error=$this->newModel('Error');
		$error->setErrorDate(new DateTime())
			->setErrorType($em->find($this->getModel('ParameterOption'), $errorType))
			->setMessage($message)
			->setAccept(false);
			$em->persist($error);
			$em->flush();
	}
	public function doctrineUpdate($entity) {
		$ci=& get_instance();
		$em=$ci->doctrine->em;
		$em->getConnection()->beginTransaction();
		try{
			$em->merge($entity);
			$em->flush();
			$em->getConnection()->commit();
		}catch(\Doctrine\DBAL\DBALException $e){
			$em->getConnection()->rollback();
			$this->setError('ERROR_UPDATE', $e->getMessage());
			$ci->jsonresult->error()->setMessage("Error tidak diketahui.Harap Hubungi Admin.")->end();
		}catch(Exception $e){
			$em->getConnection()->rollback();
			$this->setError('ERROR_UPDATE', $e->getMessage());
			$ci->jsonresult->error()->setMessage("Error tidak diketahui.Harap Hubungi Admin.")->end();
		}
	}
	public function find($model, $id) {
		$ci=& get_instance();
		$em=$ci->doctrine->em;
		$res=null;
		try{
			$res=$em->find($this->getModel($model), $id);
		}catch(\Doctrine\DBAL\DBALException $e){
			$this->setError('ERROR_FIND', $e->getMessage());
			$ci->jsonresult->error()->setMessage("Error tidak diketahui.Harap Hubungi Admin.")->end();
		}catch(Exception $e){
			$this->setError('ERROR_FIND', $e->getMessage());
			$ci->jsonresult->error()->setMessage("Error tidak diketahui.Harap Hubungi Admin.")->end();
		}
		return $res;
	}
	public function createQuery($query) {
		$ci=& get_instance();
		$em=$ci->doctrine->em;
		try{
			$res=$em->createQuery($query);
			//$res->getResult();
		}catch(\Doctrine\DBAL\DBALException $e){
			$this->setError('ERROR_QUERY', $e->getMessage());
			$ci->jsonresult->error()->setMessage("Error tidak diketahui.Harap Hubungi Admin.")->end();
		}catch(Exception $e){
			$this->setError('ERROR_QUERY', $e->getMessage());
			$ci->jsonresult->error()->setMessage("Error tidak diketahui.Harap Hubungi Admin.")->end();
		}
		return $res;
	}
	public function getSystemProperty($code, $tenant) {
		$ci=& get_instance();
		$query='';
		$innerJoin='';
		if($tenant !=null && $tenant !='null') {
			$innerJoin=' INNER JOIN u.tenant t ';
			$query=' AND t.id='.$tenant;
		} else {
			$query=' AND u.tenant IS NULL';
		}
		$dataResult=$this->createQuery("SELECT u FROM ".$this->getModel('SystemProperty')." u
			".$innerJoin." WHERE
			u.propertyCode='".$code."' ".$query."
		");
		if($dataResult->getResult())
			return $dataResult->getSingleResult();
		else
			$ci->jsonresult->error()->setMessage("Kode System Property '".$code."' Tidak Ada.")->end();
	}
	public function setDynamicOption($value,$type){
		if($value !=null && $value !=''){
			$res=$this->createQuery("SELECT A FROM ".$this->getModel('DynamicOption')." A
			INNER JOIN A.optionType B WHERE B.optionCode='".$type."' AND UPPER(A.value)=UPPER('".$value."')");
			if(!$res->getResult()){
				$do=$this->newModel('DynamicOption');
				$do->setOptionType($this->find('ParameterOption', $type))
				->setValue($value)
				->save();
			}
		}
	}
	public function getPDFTemplate($prop=array()) {
		$ci=& get_instance();
		$query='';
		$innerJoin='';
		$config=array(
				'name'=>'none',
				'param'=>array(),
				'tenant'=>null
		);
		foreach($prop as $value=>$isi)
			$config[$value]=$isi;
		if($config['tenant'] !=null && $config['tenant'] !='null') {
			$innerJoin=' INNER JOIN u.tenant t ';
			$query=' AND t.id='.$config['tenant'];
		}else
			$query=' AND u.tenant IS NULL';
		$dataResult=$this->createQuery("SELECT u FROM ".$this->getModel('PDFTemplate')." u
			".$innerJoin." WHERE
			u.templateCode='".$config['code']."' ".$query."
		");
		if($dataResult->getResult()) {
			$o=$dataResult->getSingleResult();
			$html=$o->getHtml();
			foreach($config['param'] as $key=>$isi)
				$html=str_replace("&lt;&lt;".$key."&gt;&gt;", $isi, $html);
			$paper;
			$type='potrait';
			$pType=$o->getType()->getOptionCode();
			if($pType=='PDF_CUSTOM')
				$paper=array(0, 0, $o->getHeight(), $o->getWidth());
			else if($pType=='PDF_A4')
				$paper='A4';
			else if($pType=='PDF_LETTER')
				$paper='letter';
			else
				$paper='legal';
			if($o->getDirection()->getOptionCode()=='PDFDIR_LANDSCAPE')
				$type='landscape';
			$pdf=array(
					'html'=>$html,
					'name'=>$config['name'],
					'type'=>$type,
					'paper'=>$paper,
					'margin-top'=>$o->getTop(),
					'margin-right'=>$o->getRight(),
					'margin-bottom'=>$o->getBottom(),
					'margin-left'=>$o->getLeft(),
			);
			pdf($pdf);
		}else
			$ci->jsonresult->error()->setMessage("PDF Template Code '".$config['code']."' Not Found.")->end();
	}
	public function uploadToFile($base64_string=null, $type,$replace=null) {
		$val=null;
		if($base64_string != null && $base64_string != '' && $base64_string != ''){
			$seq=$this->nextSequence('FILE_UPLOAD',null);
			$file_out='upload/'.$seq['val'].'.'.$type;
			$ifp = fopen($file_out, "wb");
			$data = explode(',', $base64_string);
			$s=null;
			if(count($data)>1)
				$s=$data[1];
			else
				$s=$data[0];
			fwrite($ifp, base64_decode($s));
			fclose($ifp);
			$val=$seq['val'].'.'.$type;
		}
	    if($replace != null && trim($replace) != '' && $replace!='NO.GIF')
	    	if (file_exists('upload/'.$replace))
	    		unlink('upload/'.$replace);
	    return $val;
	}
	public function htmlEditor($content,$before=null){
		$has=$content;
		if($before != null && $before != ''){
			preg_match_all('/<img[^>]+>/i',$before, $rBefore);
			preg_match_all('/<img[^>]+>/i',$content, $rContent);
			$imgBefore = array();
			$listBefore=array();
			foreach( $rBefore[0] as $img_tag){
				preg_match_all('/(src)=("[^"]*")/i',$img_tag,$imgBefore);
				$sub=$imgBefore[0][0];
				$url=substr($sub,5,strlen($sub)-6);
				if (base64_decode($url, true) === false)
					$listBefore[]=$url;
			}
			$imgContent = array();
			$listContent=array();
			foreach( $rContent[0] as $img_tag){
				preg_match_all('/(src)=("[^"]*")/i',$img_tag,$imgContent);
				$sub=$imgContent[0][0];
				$url=substr($sub,5,strlen($sub)-6);
				if (base64_decode($url, true) === false)
					$listContent[]=$url;
			}
			for($i=0, $iLen=count($listBefore); $i<$iLen; $i++){
				$iUrl=$listBefore[$i];
				$iData=explode('/', $iUrl);
				$iName=$iData[count($iData)-1];
				$ada=false;
				for($j=0, $jLen=count($listContent); $j<$jLen; $j++){
					$jUrl=$listContent[$j];
					if($iUrl==$jUrl){
						$ada=true;
						break;
					}
				}
				if($ada==false)
					if (file_exists('upload/editor/'.$iName)) 
						unlink('upload/editor/'.$iName);
			}
		}
		if($content != null && $content != ''){
			function data_to_img($match) {
				list(, $img, $type, $base64, $end) = $match;
				$now=new DateTime();
				$bin = base64_decode($base64);
				$md5 = md5($bin).$now->format('Ymdhis');
				$fn = 'upload/editor/'."$md5.$type";
				file_exists($fn) or file_put_contents($fn, $bin);
				return "$img$fn$end";
			}
 			$has=preg_replace_callback('#(<img\s(?>(?!src=)[^>])*?src=")data:image/(gif|png|jpeg);base64,([\w=+/]++)("[^>]*>)#', "data_to_img",$content);
		}	
		return $has;
	}
	public function excel($html,$name='default.xls'){
		header("Content-Type: application/vnd.ms-excel");
		header("Expires: 0");
		header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
		header("Content-disposition: attachment; filename=".$name);
		echo $html;
	}
	public function word($html,$name='default.doc'){
		header("Content-Type: application/vnd.ms-word");
		header("Expires: 0");
		header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
		header("Content-disposition: attachment; filename=".$name);
		echo $html;
	}
	function stringLimit($string, $word_limit){
		$akhir='';
		if(strlen($string)>$word_limit){
			$akhir=' ....';
		}
		$words = explode(" ",$string);
		
		return implode(" ",array_splice($words,0,$word_limit)).$akhir;
	}
	function encrypt($sValue){
		$sSecretKey='18051994';
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
	
	function decrypt($sValue){
		$sSecretKey='18051994';
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
	public function query($query){
		$ci=&get_instance();
		return $ci->db->query($query);
	}
	public function queryResult($query){
		$ci=&get_instance();
		return $ci->db->query($query)->result();
	}
	public function queryRow($query){
		$ci=&get_instance();
		return $ci->db->query($query)->row();
	}
	public function cache_start($name=null){
		function seourl($s) {
			$c = array (' ','\\',',','#',':',';','\'','”','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','é','_');
			$s = strtolower(str_replace($c,'-', $s));
			$panjangdiv=strlen($s);
			$isi=explode('–',$s);
			for($i=0;$i<$panjangdiv;$i++){
				$s = str_replace('–-','-',$s);
				$s = str_replace('---','-',$s);
			}
			return $s;
		}
		$cachefile='';
		if($name==null){
			$urlcache = $_SERVER['REQUEST_URI'];
			$breakcache = explode('/', $urlcache);
			$filecache="";
			foreach($breakcache as $joincache){
				$filecache=seourl($filecache).'-'.seourl($joincache);
			}
			$cachefile = './cache/T'.seourl($filecache).'.html';
		}else{
			$cachefile = './cache/N-'.$name.'.html';
		}
		$cachetime = rand(300,90000);

		if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)){
			include($cachefile);
			exit;
		}
		ob_start();
		return $cachefile;
	}
	public function cache_end($cachefile){
		$cached = fopen($cachefile,'w');
		fwrite($cached, ob_get_contents());
		fclose($cached);
		ob_end_flush();
	}

	public function getHeader(){
		$db=$this->load->database('other',true);
		// $kd_rs = $this->CI->session->userdata['user_id']['kd_rs'];
		$rs    = $db->query("SELECT * FROM db_rs")->row();
		$telp='';
		$fax='';
		if(($rs->phone1 != null && $rs->phone1 != '')|| ($rs->phone2 != null && $rs->phone2 != '')){
			$telp='Telp. ';
			$telp1=false;
			if($rs->phone1 != null && $rs->phone1 != ''){
				$telp1=true;
				$telp.=$rs->phone1;
			}
			if($rs->phone2 != null && $rs->phone2 != ''){
				if($telp1==true){
					$telp.='/'.$rs->phone2.'.';
				}else{
					$telp.=$rs->phone2.'.';
				}
			}else{
				$telp.='.';
			}
		}
		if($rs->fax != null && $rs->fax != ''){
			$fax='Fax. '.$rs->fax.'.';
				
		}
		return "<table style='font-size: 18;font-family: Arial, Helvetica, sans-serif;' cellspacing='0' border='0'>
   			<tr>
   				<td align='left'>
   					<img src='./ui/images/Logo/LOGO.png' width='62' height='82' />
   				</td>
   				<td align='left' width='90%'>
   					<font style='font-size: 10px;'>-<br></font>
   					<b>".strtoupper($rs->name)."</b><br>
			   		<font style='font-size: 9px;'>".$rs->address.", ".$rs->state.", ".$rs->zip."</font><br>
			   		<font style='font-size: 9px;'>Email : ".$rs->email.", Website : ".$rs->Website."</font><br>
			   		<font style='font-size: 8px;'>".$telp." ".$fax."</font>
   				</td>
   			</tr>
   		</table>";
	}
}
?>