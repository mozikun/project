<?php
/**
 * @author 我好笨
 * @todo 导入社区系统数据需要用到的函数，导入二型糖尿病
 */

/**
 * 导入二型糖尿病随访记录
 *
 * @param string $uuid 个人档案号
 */
function import_diabetes($uuid,$newuuid,$staff_id,$org_id,$db,$dbname)
{
	mysql_select_db($dbname,$db);
	mysql_query("set names utf8");
    $time=time();
    $diabetes_uuid="";
    //MySQL主表为ehr_diabetes_followup
    $result=mysql_query("select * from ehr_diabetes_followup where serial_number='$uuid'");
    while ($rd=mysql_fetch_array($result))
    {
    	if (!empty($rd))
    	{
    		//区域平台糖尿病主表
    		$diabetes_uuid=uniqid('D_',true);
    		require_once __SITEROOT."library/Models/diabetes_core.php";
    		$diabetes_core = new Tdiabetes_core();
			$diabetes_core->uuid                     =  $diabetes_uuid;
			$diabetes_core->id                       =  $newuuid;
			$diabetes_core->staff_id                 =  $staff_id;
			$diabetes_core->created                  = $time;//添加记录时间
			$diabetes_core->followup_time            =  $rd['time_of_followup'];
			$diabetes_core->type_of_followup         =  $rd['type_of_followup'];//随访方式
			$diabetes_core->created                  = $rd['created'];
			$diabetes_core->time_of_next_followup    = $rd['nexttime_of_followup'];
			$diabetes_core->compliance               = $rd['medication_compliance'];//服药依从性
			$diabetes_core->adverse_drug_reaction    = $rd['badness_feedback_code'];//药物不良反应
		    $diabetes_core->reactive_hypoglycemia    = $rd['lg_reation'];//低血糖反应
		    $diabetes_core->followup_classification  = $rd['followup_category'];//此次随访分类
		    $diabetes_core->followup_doctor          = $staff_id;//随访医生签名
		    $diabetes_core->followup_result          = $rd['result_of_followup'];//随访结果
		    $diabetes_core->insert();
		    $diabetes_core->free_statement();
    		//区域平台体征表
    		require_once __SITEROOT."library/Models/diabetes_physical_sign.php";
    		$ph_base=mysql_query("select * from ph_evaluation_checkup_base where uuid='".$rd['ph_base_uuid']."' limit 1");
    		$ph_base_rd=mysql_fetch_array($ph_base);
    		$diabetes_physical_sign = new Tdiabetes_physical_sign();
			$diabetes_physical_sign->staff_id                 = $staff_id;//医生档案号
			$diabetes_physical_sign->id                       = $newuuid;//个人档案号
			$diabetes_physical_sign->created                  = $time;//添加记录时间
			$diabetes_physical_sign->uuid                     = $diabetes_uuid;
			$diabetes_physical_sign->blood_pressure           = $ph_base_rd['s_blood_pressure'];//血压
			$diabetes_physical_sign->diastolic_blood_pressure = $ph_base_rd['p_blood_pressure'];
			$diabetes_physical_sign->weight                   = $ph_base_rd['weight'];//体重
			$diabetes_physical_sign->expectative_weight       = $rd['next_weight'];//体重			
			$diabetes_physical_sign->bmi                      = $ph_base_rd['bmi'];//体质指数
			$diabetes_physical_sign->arteria_dorsalis_pedis   = $rd['foot_arteriopalmus'];//足背动脉搏动
			$diabetes_physical_sign->other                    = $ph_base_rd['physical_other'];//其他
			$diabetes_physical_sign->insert();
		    $diabetes_physical_sign->free_statement();
    		//区域平台生活方式指导
    		require_once __SITEROOT."library/Models/diabetes_lifestyle_guide.php";
    		$diabetes_lifestyle_guide = new Tdiabetes_lifestyle_guide();
			$diabetes_lifestyle_guide->staff_id               = $staff_id;//医生档案号
			$diabetes_lifestyle_guide->id                     = $newuuid;//个人档案号
			$diabetes_lifestyle_guide->uuid                   = $diabetes_uuid;
			$diabetes_lifestyle_guide->created                = $time;//添加时间
			$diabetes_lifestyle_guide->expert_smoking         = $rd['quantity_drinking_nexttarget'];//预期日吸烟量
			$diabetes_lifestyle_guide->expert_drinking        = $rd['quantity_drinking_nexttarget'];//预期日饮酒量
			$diabetes_lifestyle_guide->expert_frequency       = $rd['view_exercise_everyweek'];//运动频率分钟/周
			$diabetes_lifestyle_guide->expert_frequency_time  = $rd['minute_exercise_everytime'];//预期频率分钟/次
			$diabetes_lifestyle_guide->expert_main_course     = $rd['quantity_food_nexttarget'];//主食天
			$diabetes_lifestyle_guide->heart_adjustment       = $rd['mind_adjust'];//心理调整
			$diabetes_lifestyle_guide->complian               = $rd['medical_order'];//遵医行为
			//smoking_status
    		$smoking=mysql_query("select * from smoking_status where uuid='".$rd['smoking_uuid']."' limit 1");
    		$smoking_rd=mysql_fetch_array($smoking);
			$diabetes_lifestyle_guide->smoking                = $smoking_rd['smoke_quantity'];//日吸烟量
			//drinking
    		$drinking=mysql_query("select * from drinking where uuid='".$rd['drinking_uuid']."' limit 1");
    		$drinking_rd=mysql_fetch_array($drinking);
			$diabetes_lifestyle_guide->drinking               = $drinking_rd['drink_scalar1'];//日饮酒量
			//diet_features
    		$diet=mysql_query("select * from diet_features where uuid='".$rd['diet_uuid']."' limit 1");
    		$diet_rd=mysql_fetch_array($diet);
			$diabetes_lifestyle_guide->main_course            = $diet_rd['food_regularly'];//主食克
			//exercise
    		$exercise=mysql_query("select * from exercise where uuid='".$rd['exercise_uuid']."' limit 1");
    		$exercise_rd=mysql_fetch_array($exercise);
			$diabetes_lifestyle_guide->frequency              = $exercise_rd['quantity_week'];//运动频率次/周
			$diabetes_lifestyle_guide->frequency_time         = $exercise_rd['exercise_every_day'];//运动频率分钟/次
			$diabetes_lifestyle_guide->insert();
		    $diabetes_lifestyle_guide->free_statement();
    		//区域平台辅助检查
    		require_once __SITEROOT."library/Models/diabetes_accessory_examine.php";
    		$diabetes_accessory_examine = new Tdiabetes_accessory_examine();
			$diabetes_accessory_examine->staff_id             = $staff_id;//医生档案号
			$diabetes_accessory_examine->id                   = $newuuid;//个人档案号
			$diabetes_accessory_examine->uuid                 = $diabetes_uuid;
			$diabetes_accessory_examine->created              = $time;//添加时间
			$lab_bio=mysql_query("select * from lab_inspection_biochemistry where uuid='".$rd['lab_bio_uuid']."' limit 1");
    		$lab_bio_rd=mysql_fetch_array($lab_bio);
    		$blood_glucose=explode('|',$lab_bio_rd['blood_glucose']);
			$diabetes_accessory_examine->fasting_bloodglucose = $blood_glucose[0];//空腹血糖值
			$lab_hema=mysql_query("select * from lab_inspection_hematology where uuid='".$rd['lab_hema_uuid']."' limit 1");
    		$lab_hema_rd=mysql_fetch_array($lab_hema);
			$diabetes_accessory_examine->hbclc                = $lab_hema_rd['haematoglobin'];//糖化血红蛋白
			$diabetes_accessory_examine->eamination_time      = $rd['created'];//检查日期
			$diabetes_accessory_examine->insert();
			$diabetes_accessory_examine->free_statement();
    		//区域平台转诊
    		require_once __SITEROOT."library/Models/diabetes_patient_referral.php";
    		$diabetes_patient_referral = new Tdiabetes_patient_referral();
			$diabetes_patient_referral->staff_id              = $staff_id;
			$diabetes_patient_referral->id                    = $newuuid;
			$diabetes_patient_referral->created               = $time;
			$diabetes_patient_referral->uuid                  = $diabetes_uuid;
			$transfer=mysql_query("select * from mt_transfer_out_record where uuid='".$rd['lab_hema_uuid']."' limit 1");
    		$transfer_rd=mysql_fetch_array($transfer);
			$diabetes_patient_referral->reason                = $transfer_rd['our_reason'];//转诊原因
			$diabetes_patient_referral->organization          = $transfer_rd['out_organ'];//机构及科别
    		//区域平台用药表
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
	    		$follow_up_drugs->follow_uuid = $diabetes_uuid;//随访主表ID
	    		$follow_up_drugs->call_module = "diabetes";//调用模块
	    		$follow_up_drugs->org_id=$org_id;
	    		$follow_up_drugs->insert();
	    		$follow_up_drugs->free_statement();
    		}
    	}
    	echo ("有糖尿病随访导入，请检查<br />");
    }
}