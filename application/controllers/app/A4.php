<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Employee
class A4 extends MY_controller {
	public $MA='A4';
	public function toExcel(){
		$common = $this->common;
		
		$parameterCode=$this->get('f1');
		$parameterName=$this->get('f2');
		$resume=$this->get('f3');
		$activeFlag=$this->get('f4');
		
		$html='
				<table border="1" >
					<thead>
						<tr>
							<th width="50">No.</th>
							<th width="150">Parameter Code</th>
							<th width="200">Parameter Name</th>
							<th width="500">Resume</th>
							<th width="50">Active</th>
						</tr>
					</thead>
					<tbody>
		';
		$res=$this->dataList('all');
		for($i=0,$iLen=count($res['data']); $i<$iLen; $i++){
			$r=$res['data'][$i];
			$html.='
					<tr>
						<td align="center">'.($i+1).'</td>
						<td>'.$r->getParameterCode().'</td>
						<td>'.$r->getParameterName().'</td>
						<td>'.$r->getResume().'</td>
						<td>'.$r->getActiveFlag().'</td>
					</tr>';
		}
		$html.='
			</tbody>
		</table>
		';
		$common->excel($html);
	}
	public function toPDF(){
		$common = $this->common;
		
		$parameterCode=$this->get('f1');
		$parameterName=$this->get('f2');
		$resume=$this->get('f3');
		$activeFlag=$this->get('f4');
		
		$html='
				<table border="1" >
					<thead>
						<tr>
							<th width="20">No.</th>
							<th width="100">Parameter Code</th>
							<th width="150">Parameter Name</th>
							<th>Resume</th>
							<th width="20">Active</th>
						</tr>
					</thead>
					<tbody>
		';
		$res=$this->dataList('all');
		for($i=0,$iLen=count($res['data']); $i<$iLen; $i++){
			$r=$res['data'][$i];
			$html.='
					<tr>
						<td align="center">'.($i+1).'</td>
						<td>'.$r->getParameterCode().'</td>
						<td>'.$r->getParameterName().'</td>
						<td>'.$r->getResume().'</td>
						<td>'.$r->getActiveFlag().'</td>
					</tr>';
		}
		$html.='
			</tbody>
		</table>
		';
		
		
		$pdf=array();
		$pdf['code']='A4';
		$pdf['name']='Parameter';
		$pdf['param']=array(
				'PARAM1'=>$html,
				'F1'=>$parameterCode,
				'F2'=>$parameterName,
				'F3'=>$resume,
				'F4'=>$activeFlag
		);
		$common->getPDFTemplate($pdf);
	}
	public function getVar() {
		$lang = array ();
		$this->jsonresult->end();
	}
	public function initAdd(){
		$this->jsonresult->end();
	}
	public function initUpdate(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pid=$this->get('i');
		$ori=$common->find('Parameter',$pid);
		if($ori != null){
			$data=array();
			$mod=array();
			$mod['f1']=$ori->getParameterCode();
			$mod['f2']=$ori->getParameterName();
			$mod['f3']=$ori->getDescription();
			$mod['f4']=$ori->getActiveFlag();
			$mod['f5']=$ori->getSystemFlag();
			$data['o']=$mod;
			$optionList=$ori->getParameterOptionList();
			$modL=array();
			for($i=0,$iLen=count($optionList); $i<$iLen; $i++){
				$ori1=$optionList[$i];
				$mod1=array();
				$mod1['f5']=$ori1->getOptionCode();
				$mod1['f6']=$ori1->getOptionName();
				$mod1['f7']=$ori1->getActiveFlag();
				$mod1['f9']=$ori1->getSystemFlag();
				$modL[]=$mod1;
			}
			$data['l']=$modL;
			$result->setData($data)->end();
		}else
			$result->error()->setMessageNotExist()->end();
	}
	public function initSearch(){
		$common = $this->common;
		$result = $this->jsonresult;
		$data=array();
		$data['l']=$common->getParams('ACTIVE_FLAG');
		$result->setData($data)->end();
	}
	private function dataList($type){
		$common = $this->common;
		$result = $this->jsonresult;
		
		$first=$this->get('page',false);
		$size=$this->get('pageSize',false);
		$direction=$this->get('d',false);
		$sorting=$this->get('s',false);
		
		$parameterCode=$this->get('f1');
		$parameterName=$this->get('f2');
		$resume=$this->get('f3');
		$activeFlag=$this->get('f4');
		
		$entity=$common->getModel('Parameter');
		
		$criteria="";
		$inner='';
		
		if(trim($parameterCode)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.parameterCode) like upper('%".$parameterCode."%')";
		}
		if(trim($parameterName)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.parameterName) like upper('%".$parameterName."%')  ";
		}
		if(trim($resume)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			$criteria.=" upper(M.resume) like upper('%".$resume."%')  ";
		}
		if($activeFlag = null && trim($activeFlag)!=''){
			if($criteria=='')
				$criteria.=" WHERE ";
			else
				$criteria.=" AND ";
			if(trim($activeFlag)=='Y')
				$criteria.=" M.activeFlag =true";
			else
				$criteria.=" M.activeFlag =false";
		}
		
		$orderBy=' ORDER BY ';
		if($direction == null)
			$direction='ASC';
		switch ($sorting){
			case "f2":
				$orderBy.='M.parameterName '.$direction;
				break;
			case "f3":
				$orderBy.='M.resume '.$direction;
				break;
			default:
				$orderBy.='M.parameterCode '.$direction;
				break;
		}
		
		$total=$common->createQuery("SELECT count(M) AS total FROM ".$entity." M  ".$inner." ".$criteria)->getSingleResult();
		$res=$common->createQuery("SELECT M FROM ".$entity." M ".$inner." ".$criteria." ".$orderBy);
		if($type=='list')
			$res->setFirstResult($first)->setMaxResults($size);
		return array('data'=>$res->getResult(),'total'=>$total['total']);
	}
	public function getList(){
		$result = $this->jsonresult;
		$res=$this->dataList('list');
		$list=array();
		for($i=0,$iLen=count($res['data']); $i<$iLen; $i++){
			$r=$res['data'][$i];
			$o=array();
			$o['f1']=$r->getParameterCode();
			$o['f2']=$r->getParameterName();
			$o['f3']=$r->getResume();
			$o['f4']=$r->getActiveFlag();
			$o['f5']=$r->getSystemFlag();
			$list[]=$o;
		}
		$result->setData($list)->setTotal($res['total'])->end();
	}
	public function save(){
		$common = $this->common;
		$result = $this->jsonresult;
		$pageType=$this->post('p');
		
		$parameterCode=$this->post('f1');
		$parameterName=$this->post('f2');
		$description=$this->post('f3');
		$activeFlag=$this->post('f4');
		$systemFlag=$this->post('f8');
		$optionCode=$this->post('f5');
		$optionName=$this->post('f6');
		$activeFlagOption=$this->post('f7');
		$systemFlagOption=$this->post('f9');
		if($activeFlag=='true')
			$activeFlag=true;
		else
			$activeFlag=false;
		if($systemFlag=='true')
			$systemFlag=true;
		else
			$systemFlag=false;
		$resume='';
		for($i=0,$iLen=count($activeFlagOption); $i<$iLen; $i++){
			$activeOption=$activeFlagOption[$i];
			$systemOption=$systemFlagOption[$i];
			if($activeOption=='true')
				$activeFlagOption[$i]=true;
			else
				$activeFlagOption[$i]=false;
			if($systemOption=='true')
				$systemFlagOption[$i]=true;
			else
				$systemFlagOption[$i]=false;
			if($resume !='')
				$resume.=', ';
			$resume.=$optionCode[$i];
		}
		if($pageType=='ADD'){
			$res= $common->createQuery ( "SELECT M FROM ".$common->getModel('Parameter')." M WHERE 
					M.parameterCode='" . $parameterCode . "'");
			if (! $res->getResult ()) {
				$parameter=$common->newModel('Parameter');
				for($i=0,$iLen=count($optionCode); $i<$iLen; $i++){
					$resOption= $common->createQuery ( "SELECT M FROM ".$common->getModel('ParameterOption')." M
						INNER JOIN M.parameter A
						WHERE
						M.optionCode='".$optionCode[$i]."' AND
						A.parameterCode!='" . $parameterCode . "'");
					if($resOption->getResult())
						$result->warning ()->setMessageExist ( 'Option Code', $optionCode[$i] )->end ();
					else{
						$parameterOption=$common->newModel('ParameterOption');
						$parameterOption->setOptionCode($optionCode[$i])
							->setOptionName($optionName[$i])
							->setActiveFlag($activeFlagOption[$i])
							->setSystemFlag($systemFlagOption[$i])
							->setParameter($parameter)
							->setLineNumber($i+1)
							->setCreateOn($common->getDateTime ())
							->setCreateBy($common->getEmployee())
							->setUpdateOn($common->getDateTime ())
							->setUpdateBy($common->getEmployee());
					}
				}
				$parameter->setParameterCode($parameterCode)
					->setParameterName($parameterName)
					->setDescription($description)
					->setActiveFlag($activeFlag)
					->setSystemFlag($systemFlag)
					->setResume($resume)
					->setCreateOn($common->getDateTime ())
					->setCreateBy($common->getEmployee())
					->setUpdateOn($common->getDateTime ())
					->setUpdateBy($common->getEmployee())
					->save();
				$result->setMessageSave ( 'Parameter Code', $parameterCode)->end ();
			}else
				$result->warning ()->setMessageExist ( 'Parameter Code', $parameterCode )->end ();
		}else{
			$ori=$common->find('Parameter',$parameterCode);
			if ($ori != null) {
				$ori->setParameterCode($parameterCode)
					->setParameterName($parameterName)
					->setDescription($description)
					->setActiveFlag($activeFlag)
					->setSystemFlag($systemFlag)
					->setResume($resume)
					->setUpdateOn($common->getDateTime ())
					->setUpdateBy($common->getEmployee())
					->save();
				$listOption=$ori->getParameterOptionList();
				for($i=0,$iLen=count($listOption); $i<$iLen; $i++){
					$option=$listOption[$i];
					$ada=false;
					for($j=0,$jLen=count($optionCode); $j<$jLen; $j++){
						if($optionCode[$j]==$option->getOptionCode()){
							$ada=true;
							$option->setOptionName($optionName[$j])
								->setActiveFlag($activeFlagOption[$j])
								->setSystemFlag($systemFlagOption[$j])
								->setUpdateOn($common->getDateTime ())
								->setUpdateBy($common->getEmployee());
						}
					}
					if($ada==false){
						$ori->removeParameterOptions($option);
					}
				}
				$ori->update();
				for($j=0,$jLen=count($optionCode); $j<$jLen; $j++){
					$ada=false;
					for($i=0,$iLen=count($listOption); $i<$iLen; $i++){
						$option=$listOption[$i];
						if($optionCode[$j]==$option->getOptionCode())
							$ada=true;
					}
					if($ada==false){
						$parameterOption=$common->newModel('ParameterOption');
						$resOption= $common->createQuery ( "SELECT M FROM ".$common->getModel('ParameterOption')." M
							INNER JOIN M.parameter A
							WHERE
							M.optionCode='".$optionCode[$j]."' AND
							A.parameterCode!='" . $parameterCode . "'");
						if($resOption->getResult())
							$result->warning ()->setMessageExist ( 'Option Code', $optionCode[$j] )->end ();
						else{
							$parameterOption->setOptionCode($optionCode[$j])
								->setOptionName($optionName[$j])
								->setActiveFlag($activeFlagOption[$j])
								->setSystemFlag($systemFlagOption[$j])
								->setParameter($ori)
								->setCreateOn($common->getDateTime ())
								->setCreateBy($common->getEmployee())
								->setUpdateOn($common->getDateTime ())
								->setUpdateBy($common->getEmployee());
						}
					}
				}
				$line=0;
				foreach ($ori->getParameterOptionList() as $i){
					$line++;
					$i->setLineNumber($line);
				}
				$ori->update();
			}else
				$result->error()->setMessageNotExist()->end();
			$result->setMessageEdit ('Parameter Code', $parameterCode )->end ();
		}
		echo json_encode($this->jsonresult);
	}
	public function delete(){
		$result = $this->jsonresult;
		$common = $this->common;
		$pid= $this->post('i');
		$res= $common->find('Parameter',$pid);
		if ($res != null) {
			if($res->getSystemFlag()==false)
				$res->delete();
			else
				$result->warning()->setMessage('Deleting in Block, Because Data is System.')->end();
		}else
			$result->error()->setMessageNotExist()->end();
		$result->setMessageDelete('Parameter Code', $pid )->end ();
	}
}
