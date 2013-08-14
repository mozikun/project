<?php
/**
*@author：我好笨
*@filename: indexController.php
*@package：院长查询
*@email：4049054@qq.com
*@create：2011-1-20
*/
class director_calworkController extends controller
{
	/*
	*等同于构造函数
	*/
	public function init()
	{
		$this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';


		$this->view->basePath = $this->_request->getBasePath();
	}
	/*
	* 院长查询
	*/
	public function  indexAction()
	{


		$this->view->assign('region_id',$this->user['region_id']);
		$this->view->assign('region_p_id',$this->user['region_id']);
		//开始时间
		$this->view->start_date=date("Y-m-d");
		//结束时间
		$this->view->end_date=date("Y-m-d");
		$this->view->display("main.html");
	}
	//统计数据
	public function totalAction()
	{
		
		//取当前区域ID
		$region_id		= $this->_request->getParam('region')?$this->_request->getParam('region'):$this->user['region_id'];
		//取选择的机构
		$org_id			= $this->_request->getParam('org_id');
		//开始时间工作量
		$start_date		= $this->_request->getParam('start_date')?$this->_request->getParam('start_date'):date("Y-m-d",time());
		//结束时间工作量
		$end_date		= $this->_request->getParam('end_date')?$this->_request->getParam('end_date'):date("Y-m-d H:i:s",time());
		//开始时间戳
		$start_time		= strtotime($start_date);
		//结束时间戳
		$end_time		= strtotime($end_date)+86400;

		if($org_id){
			//取得机构下面所有的医生
			$users_array	= get_all_staff_info($org_id);
			//print_r($users_array);
			//$this->view->users_array=$users_array;
			$td_num=count($users_array);
			
			$this->view->blankTd=$this->blankTd($td_num);
			//个人档案建档人数
			
			$individual_core=$this->statistical_work("individual_core",$users_array,'staff_id','count','filing_time',$start_time,$end_time);
			$this->view->individual_core=$individual_core;
			//print_r($individual_core);
			
			//家庭档案家庭档案数
			$family_archive=$this->statistical_work("family_archive",$users_array,'staff_id','count','created',$start_time,$end_time);
			$this->view->family_archive=$family_archive;

			//print_r($family_archive);
			//健康体检-体检次数
			$examination_table=$this->statistical_work("examination_table",$users_array,'staff_id','count','created',$start_time,$end_time);
			$this->view->examination_table=$examination_table;
	
			//健康体检-体检人数
			$examination_table_=$this->statistical_work("examination_table",$users_array,'staff_id','count','created',$start_time,$end_time,'id');
			$this->view->examination_table_=$examination_table_;

			//print_r($examination_table_);
			//诊疗记录门诊病历数
			$patient_history=$this->statistical_work("patient_history",$users_array,'doctor_id','count','diagnosis_time',$start_time,$end_time);	
			$this->view->patient_history=$patient_history;		

			//诊疗记录出院证明数
			$hos_discharge_certificate=$this->statistical_work("hos_discharge_certificate",$users_array,'doctor_id','count','admission_time',$start_time,$end_time);
			$this->view->hos_discharge_certificate=$hos_discharge_certificate;
			//其它医疗服务接诊记录数 
			$diagnosis_table=$this->statistical_work("diagnosis_table",$users_array,'staff_id','count','created',$start_time,$end_time);
			$this->view->diagnosis_table=$diagnosis_table;
		    //其它医疗服务会诊记录数 
		    $consultation_table=$this->statistical_work("consultation_table",$users_array,'staff_id','count','created',$start_time,$end_time);
		    $this->view->consultation_table=$consultation_table;
		    //其它医疗服务双向转诊转入 
		    $patient_referral_in=$this->statistical_work("patient_referral_in",$users_array,'staff_id','count','created',$start_time,$end_time);
		    $this->view->patient_referral_in=$patient_referral_in;
		    //其它医疗服务双向转诊转出 
		    $patient_referral_out=$this->statistical_work("patient_referral_out",$users_array,'staff_id','count','created',$start_time,$end_time);
		    $this->view->patient_referral_out=$patient_referral_out;
		    //健康教育数
		    $health_education=$this->statistical_work("health_education",$users_array,'staff_id','count','created',$start_time,$end_time);
		    $this->view->health_education=$health_education;

		    //儿童保健-新生儿家庭访视次数 
		    $child_visits=$this->statistical_work("child_visits",$users_array,'staff_id','count','created',$start_time,$end_time);
		    $this->view->child_visits=$child_visits;
  			//儿童保健-3岁以内健康检查次数  
  			$child_physical=$this->statistical_work("child_physical",$users_array,'staff_id','count','created',$start_time,$end_time);
  			$this->view->child_physical=$child_physical;
  			//儿童保健-3岁儿童健康检查次数 
			$child_physical_age_three=$this->statistical_work("child_physical_age_three",$users_array,'staff_id','count','created',$start_time,$end_time);
			$this->view->child_physical_age_three=$child_physical_age_three;
			//孕产妇健康管理-婚前保健服务次数 

			//孕产妇健康管理-医学婚检证明次数 
			$certificate_premartial_exam=$this->statistical_work("certificate_premartial_exam",$users_array,'staff_id','count','created',$start_time,$end_time);
			$this->view->certificate_premartial_exam=$certificate_premartial_exam;
			//孕产妇健康管理-婚前医学检查次数 
			$premarital_examination=$this->statistical_work("premarital_examination",$users_array,'staff_id','count','created',$start_time,$end_time);
			$this->view->premarital_examination=$premarital_examination;
			//预防接种次数
			$vac_card=$this->statistical_work("vac_card",$users_array,'staff_id','count','created',$start_time,$end_time);
			$this->view->vac_card=$vac_card;
			

			//高血压-确症人数
			$hypertension_num=$this->statistical_work("clinical_history",$users_array,'staff_id','count','disease_date',$start_time,$end_time,'',"and disease_code='2' and disease_state='1'");
			$this->view->hypertension_num=$hypertension_num;
			//糖尿病-确症人数
			$diabetes_num=$this->statistical_work("clinical_history",$users_array,'staff_id','count','disease_date',$start_time,$end_time,'',"and disease_code='3' and disease_state='1'");
			$this->view->diabetes_num=$diabetes_num;
			//精神分裂-确症人数
			$schizophrenia_num=$this->statistical_work("clinical_history",$users_array,'staff_id','count','disease_date',$start_time,$end_time,'',"and disease_code='8' and disease_state='1'");
			$this->view->schizophrenia_num=$schizophrenia_num;
			
			//高血压-次数
			$hypertension_follow_up=$this->statistical_work("hypertension_follow_up",$users_array,'staff_id','count','created',$start_time,$end_time);
			$this->view->hypertension_follow_up=$hypertension_follow_up;
			//糖尿病-次数
			$diabetes_core=$this->statistical_work("diabetes_core",$users_array,'staff_id','count','created',$start_time,$end_time);
			$this->view->diabetes_core=$diabetes_core;
			//精神分裂-次数
			$schizophrenia=$this->statistical_work("schizophrenia",$users_array,'staff_id','count','created',$start_time,$end_time);
			$this->view->schizophrenia=$schizophrenia;
			
			//高血压-人数
			$hypertension_follow_up_=$this->statistical_work("hypertension_follow_up",$users_array,'staff_id','count','created',$start_time,$end_time,'id');
			$this->view->hypertension_follow_up_=$hypertension_follow_up_;
			//糖尿病-人数
			$diabetes_core_=$this->statistical_work("diabetes_core",$users_array,'staff_id','count','created',$start_time,$end_time,'id');
			$this->view->diabetes_core_=$diabetes_core_;
			//精神分裂-人数
			$schizophrenia_=$this->statistical_work("schizophrenia",$users_array,'staff_id','count','created',$start_time,$end_time,'id');
			$this->view->schizophrenia_=$schizophrenia_;
			
		}else{
			//
			throw new Exception("参数错误！");
		}
		//开始时间
		//$this->view->start_date=$start_date;
		//结束时间
		//$this->view->end_date=$start_date;
		
		$this->view->display("calwork.html");
	}
	//取指定区域下的ID
	public function agencyAction()
	{
		//取当前区域ID
		$region_id=$this->_request->getParam('region')?$this->_request->getParam('region'):$this->user['region_id'];
		$org_id=$this->user['org_id'];
		$region=new Tregion();
		$region->whereAdd("id='$region_id'");
		$region->find(true);
		$region_path=$region->region_path;
		$org="<option value=''>-所属机构-</option>";
		if($region_path)
		{
			$organization=new Torganization();
			$organization->whereAdd("region_path like '$region_path%'");
			$organization->find();
			while($organization->fetch())
			{
				if($org_id==$organization->id)
				{
					$org.="<option value='".$organization->id."' selected='selected'>";
				}
				else
				{
					$org.="<option value='".$organization->id."'>";
				}
				$org.=$organization->zh_name."</option>";
			}
		}
		echo $org;
		exit;
	}
	/**
	 * 统计表名为$table_name,用户数组$users_array,统计的字段$doctor_id,动作(求和)$action='count',填表时间字段$fill_time,开始时间戳$start_time,结束时间戳$end_time。得出每个医生的工作量 
	 * $users_array 如 Array ( [0] => Array ( [id] =>111 [name_real] => 卫生部领导1 ) ) 
     * 返回结果 如 Array ( [0] => Array ( [id] =>111 [name_real] => 卫生部领导1 [counter]=1 ) ) 
     * 
	 * @param String $table_name
	 * @param String $users_array
	 * @param String $doctor_id
	 * @param String $action
	 * @param String $fill_time
	 * @param number $start_time
	 * @param number $end_time
	 * @param mixed $groupby
	 * @return array
	 */

	private function statistical_work($table_name='',$users_array=array(),$doctor_id='staff_id',$action='count',$fill_time='created',$start_time=0,$end_time=0,$groupby='',$where='',$debug=''){
		require_once __SITEROOT."library/Models/$table_name.php";//表名
		$tclass="T".$table_name;//类名
		$Ttable_name=new $tclass();
		$Ttable_name->selectAdd("$doctor_id AS doctor_id");
				
		if(!empty($groupby)){
			if(is_string($groupby)){
				if($action=='count'){
					$Ttable_name->selectAdd("count(DISTINCT $groupby) AS counter");
				}
				$Ttable_name->groupby("$doctor_id");
				
			}elseif(is_array($groupby)){
				
			}
		}else{
			if($action=='count'){
				$Ttable_name->selectAdd("count(*) AS counter");
			}
			$Ttable_name->groupby($doctor_id);
			
		}
		$having='';
		foreach ($users_array as $user){
			$having.=" $doctor_id='".$user['id']."'  OR";
		}
		$having=trim($having,"OR");
		if($table_name=='individual_core' || $table_name=='family_archive' || $table_name=='health_education'){
			//不与个个档案关联
			$Ttable_name->subquery("select * from $table_name where $fill_time>=$start_time AND $fill_time<=$end_time $where");
		}else{
			
			if($table_name=='patient_history' || $table_name=='hos_discharge_certificate' ){
				$Ttable_name->subquery("select $table_name.doctor_id as doctor_id from $table_name inner join individual_core on  $table_name.serial_number=individual_core.uuid where $table_name.$fill_time>=$start_time AND $table_name.$fill_time<=$end_time $where");
			}else{
				$Ttable_name->subquery("select $table_name.staff_id ,$table_name.id from $table_name inner join individual_core on  $table_name.id=individual_core.uuid where $table_name.$fill_time>=$start_time AND $table_name.$fill_time<=$end_time $where");
			}
		}
		$Ttable_name->having($having);
		//$Ttable_name->debugLevel(3);
		if($debug){
			$Ttable_name->debug(3);
			echo date("Y-m-d H:i:s",$start_time);
			echo "<br/>";
			echo date("Y-m-d H:i:s",$end_time);
		}
		$Ttable_name->find();
		$result=array();
		$i=0;
		while ($Ttable_name->fetch()) {
			$result[$i]['doctor_id']	= $Ttable_name->doctor_id;
			$result[$i]['counter']		= $Ttable_name->counter;
			$i++;
		}
		//print_r($result);
		//用户数组添加数量元素并且初始化为0
		foreach ($users_array as $key=>$user){
			$users_array[$key]['counter']=0;
		}
		//用户数组，数量元素修正
		foreach ($users_array as $key=>$user){
			foreach ($result as $tmp_result){
				if($user['id']==$tmp_result['doctor_id']){
					$users_array[$key]['counter']=$tmp_result['counter'];
				}
			}
		}
		//print_r($users_array);
		return $users_array;
	}
/**
 * 计算出N个<td></td>字符串
 *
 * @param int $num
 * @return string
 */
function blankTd($num=0){
		
		if(is_numeric($num)){
			$result='';
			$num=intval(abs($num));//数量
			$td_token='<td></td>';
			
			for ($i=0;$i<$num-1;$i++){
				$result.=$td_token;
			}
			///echo $result;
			return $result;
		}else{
			throw new Exception("");
		}
	}


}
?>