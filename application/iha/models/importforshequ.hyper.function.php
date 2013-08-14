<?php
/**
 * @author 我好笨
 * @todo 导入社区系统数据需要用到的函数，因导入数据涉及过多逻辑，因此代码可能太长，分文件存储，导入高血压
 */


/**
 * 导入高血压随访记录
 *
 * @param string $uuid 个人档案号
 */
function import_hyper($uuid,$newuuid,$staff_id,$org_id,$db,$dbname)
{
	mysql_select_db($dbname,$db);
	mysql_query("set names utf8");
    $time=time();
    //从MySQL中查询数据，其主表为ehr_hypertension_followup
    $result=mysql_query("select * from ehr_hypertension_followup where serial_number='$uuid'");
    while ($rd=mysql_fetch_array($result))
    {
    	$hy_uuid='';
    	//只有在主表有记录时才执行后面的操作
    	if (!empty($rd))
    	{
    		require_once __SITEROOT."library/Models/hypertension_follow_up.php";
    		$hypertension_follow_up=new Thypertension_follow_up();
    		$hypertension_follow_up->staff_id = $staff_id;//医生档案号
    		$hypertension_follow_up->id = $newuuid;
    		$hypertension_follow_up->follow_time = $rd['time_of_followup'];//随访日期
    		//数据字典
    		$hypertension_follow_up->follow_type = $rd['type_of_followup'];//随访方式
    		$hypertension_follow_up->pregnancy = $rd['pregnancy'];//否是为妊娠或哺乳期
    		//数据字典
    		$hypertension_follow_up->psychology = $rd['mind_adjust'];//心里调整
    		//数据字典
    		$hypertension_follow_up->treatment_compliance = $rd['medical_order'];//遵医行为
    		$hypertension_follow_up->auxiliary_check = $rd['checkup_other'];//辅助检查
    		$hypertension_follow_up->smoking_after = $rd['quantity_smoking_nexttarget']; //下次随访吸烟量
    		$hypertension_follow_up->drinking_after = $rd['quantity_drinking_nexttarget']; //下次随访饮酒量
    		$hypertension_follow_up->sport_amount_after = $rd['view_exercise_everyweek']; //下次随访每周运动次数
    		$hypertension_follow_up->sport_time_after = $rd['minute_exercise_everytime']; //下次随访每次运动时间
    		$hypertension_follow_up->salt_intake_after = $rd['salt_info_next_11']; //下次随访摄盐量
    		$hypertension_follow_up->follow_next_time = $rd['nexttime_of_followup'];
    		$hypertension_follow_up->weight_after = $rd['next_weight']; //下次随访体重
    		$hypertension_follow_up->heart_rate_after = $rd['next_pulse_rate']; //下次随访心率
    		//数据字典
    		$hypertension_follow_up->medication_compliance = $rd['medication_compliance'];//服药依从性

			$hypertension_follow_up->adverse_drug = $rd['badness_feedback_code'];//药物不良反应
    		$hypertension_follow_up->adverse_drug_info = $rd['badness_feeeback_value'];//药物不良反应详细说明
    		$hypertension_follow_up->follow_result=$rd['result_of_followup'];
    		$hypertension_follow_up->org_id=$org_id;
    		$hypertension_follow_up->created = $rd['created'];//添加记录时间
    		$hy_uuid=uniqid('h_',true);
    		$hypertension_follow_up->uuid = $hy_uuid;//随访编号
    		//以下内容不再表ehr_hypertension_followup里
    		
    		//读取体格检查-》基本检查 ph_evaluation_checkup_base
    		$ph_base=mysql_query("select * from ph_evaluation_checkup_base where uuid='".$rd['ph_base_uuid']."' limit 1");
    		$ph_base_rd=mysql_fetch_array($ph_base);
    		$hypertension_follow_up->blood_pressure = $ph_base_rd['s_blood_pressure'];//血压
    		$hypertension_follow_up->diastolic_blood_pressure = $ph_base_rd['p_blood_pressure'];//舒张压
    		$hypertension_follow_up->height = $ph_base_rd['height'];//身高
    		$hypertension_follow_up->weight_begin = $ph_base_rd['weight'];//体重
    		$hypertension_follow_up->body_mass_index = $ph_base_rd['bmi'];//体质指数
    		$hypertension_follow_up->signs_other = $ph_base_rd['physical_other'];//体征其他
    		//读取体格检查-》一般检查 ph_evaluation_checkup_comm
    		$ph_comm=mysql_query("select * from ph_evaluation_checkup_comm where uuid='".$rd['ph_comm_uuid']."' limit 1");
    		$ph_comm_rd=mysql_fetch_array($ph_comm);
    		$hypertension_follow_up->heart_rate_begin = $ph_comm_rd['heart_rate'];//心率
    		//smoking_status
    		$smoking=mysql_query("select * from smoking_status where uuid='".$rd['smoking_uuid']."' limit 1");
    		$smoking_rd=mysql_fetch_array($smoking);
    		$hypertension_follow_up->smoking_begin = $smoking_rd['smoke_quantity'];//日吸烟量
    		//drinking
    		$drinking=mysql_query("select * from drinking where uuid='".$rd['drinking_uuid']."' limit 1");
    		$drinking_rd=mysql_fetch_array($drinking);
    		$hypertension_follow_up->drinking_begin = $drinking_rd['drink_scalar1'];//日饮酒量
    		//exercise
    		$exercise=mysql_query("select * from exercise where uuid='".$rd['exercise_uuid']."' limit 1");
    		$exercise_rd=mysql_fetch_array($exercise);
    		$hypertension_follow_up->sport_amount_begin = $exercise_rd['quantity_week'];//运动次数（次/周）
    		$hypertension_follow_up->sport_time_begin = $exercise_rd['exercise_every_day'];//运动频率（分钟/次）
    		//diet_features
    		$diet=mysql_query("select * from diet_features where uuid='".$rd['diet_uuid']."' limit 1");
    		$diet_rd=mysql_fetch_array($diet);
    		$hypertension_follow_up->salt_intake_begin = $diet_rd['salt_info_11'];//摄盐情况（克/天）
    		
    		$hypertension_follow_up->insert();
    		$hypertension_follow_up->free_statement();
    		//导入症状表--经查询所有人的随访记录本字段都为1无症状或者Null值，放弃导入
    		//require_once __SITEROOT."library/Models/hypertension_symptom.php";
    		//$symptoms_code = $rd['symptoms_code'];//状态
    		//导入用药表
    		require_once __SITEROOT."library/Models/follow_up_drugs.php";
    		$drugs=mysql_query("select * from cm_drug_use where cm_uuid='".$rd['uuid']."'");
    		while ($drugs_rd=mysql_fetch_array($drugs))
    		{
    			$follow_up_drugs=new Tfollow_up_drugs();
	    		$follow_up_drugs->uuid = uniqid("D_",true);//
	    		$follow_up_drugs->staff_id = $staff_id;//医生档案号
	    		$follow_up_drugs->id = $newuuid;//个人档案号
	    		$follow_up_drugs->created = $time;//添加记录时间
	    		$follow_up_drugs->drug_name = $drugs_rd['drug_name'];//药物名称
	    		$follow_up_drugs->drug_amount = $drugs_rd['drug_usage'];
	    		$follow_up_drugs->drug_frequency = $drugs_rd['drug_frequency'];
	    		$follow_up_drugs->follow_uuid = $hy_uuid;//随访主表ID
	    		$follow_up_drugs->call_module = "hypertension";//调用模块
	    		$follow_up_drugs->org_id=$org_id;
	    		$follow_up_drugs->insert();
	    		$follow_up_drugs->free_statement();
    		}
    	}
    	echo ("有高血压随访导入，请检查<br />");
    }
}