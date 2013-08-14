<?php
/**
 * @author 我好笨
 * @todo 导入社区系统数据需要用到的函数，因导入数据涉及过多逻辑，因此代码可能太长，分文件存储，导入重性精神分裂
 */


/**
 * 导入重性精神分裂随访记录
 *
 * @param string $uuid 个人档案号
 */
function import_schizophrenia($uuid,$newuuid,$staff_id,$org_id,$db,$dbname)
{
	mysql_select_db($dbname,$db);
	mysql_query("set names utf8");
    $time=time();
    //从MySQL中查询数据，其主表为ehr_hypertension_followup
    $result=mysql_query("select * from cm_schizophrenic_followup_new where serial_number='$uuid'");
    while ($rd=mysql_fetch_array($result))
    {
    	$hy_uuid='';
    	//只有在主表有记录时才执行后面的操作
    	if (!empty($rd))
    	{
    		require_once __SITEROOT."library/Models/schizophrenia.php";
    		$schizophrenia						= new Tschizophrenia();
    		$schizophrenia->staff_id = $staff_id;//医生档案号
    		$schizophrenia->id = $newuuid;
			$schizophrenia->fllowup_time 		= $rd['followup_date'];//随访日期
	        $schizophrenia->risk 				= $rd['wxx'];//危险性|radio|0=>(0级),1=>(1级),2=>(2级),3=>(3级),4=>(4级),5(5级)
	        $schizophrenia->shut_case 			= $rd['gsqk'];//关锁情况|radio|1=>无关锁,2=>关锁,3=>关锁已解除
			$schizophrenia->hospitalization		= $rd['zyqk'];//住院情况|radio|0=>从未住院,1=>目前正在住院,2=>既往住院，现未住院
			$schizophrenia->discharge_time		= $rd['mczysj'];//住院情况末次出院时间
			$schizophrenia->present_symptoms = $rd['present_symptoms'];//目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它
			$schizophrenia->present_symptoms_other = $rd['present_symptoms_other'];//目前症状其它
			$schizophrenia->insight 			= $rd['self_knowledge_force'];//自知力|radio|1=>自知力完全,2=>自知力不全,3=>自知力缺失
			$schizophrenia->sleep_quality 		= $rd['morpheus_condition'];//睡眠情况|radio|1=>良好,2=>一般,3=>较差
			$schizophrenia->diet 				= $rd['diet'];//饮食情况|radio|1=>良好,2=>一般,3=>较差
			$schizophrenia->personlife_do		= $rd['personal_life_cuisine'];//个人生活料理|radio|1=>良好,2=>一般,3=>较差
			$schizophrenia->housework 			= $rd['housework'];//家务劳动|radio|1=>良好,2=>一般,3=>较差
			$schizophrenia->work 				= $rd['labor_and_the_work'];//生产劳动及工作|radio|1=>良好,2=>一般,3=>较差,9=>此项不适用
			$schizophrenia->learning 			= $rd['ability_to_learn'];//学习能力|radio|1=>良好,2=>一般,3=>较差
			$schizophrenia->human_communication = $rd['social_interpersonal'];//社会人际交往|radio|1=>良好,2=>一般,3=>较差
			$schizophrenia->mild_trouble 		= $rd['sickoffamily1'];//轻度滋事
			$schizophrenia->accident			= $rd['sickoffamily2'];//肇事
			$schizophrenia->zhaohuo 			= $rd['sickoffamily3'];//肇祸
			$schizophrenia->self_wounding 		= $rd['sickoffamily4'];//自伤
			$schizophrenia->attmpted_suicide 	= $rd['sickoffamily5'];//自杀未遂
			$schizophrenia->compliance 			= $rd['medication_adherence'];//服药依从性|radio|1=>规律,2=>间断,3=>不服药
			$schizophrenia->adverse_drug 		= $rd['drug_reaction'];//药物不良反应|radio|1=>无,2=>有
			$schizophrenia->adverse_drug_info 	= $rd['drug_reaction_other'];//药物不良反应内容
			$schizophrenia->treatment_effect 	= $rd['therapeutic_effect'];//治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重
			$schizophrenia->followup_classification = $rd['follow_upclassification'];//此次随访分类|radio|1=>稳定,2=>基本稳定,3=>不稳定
			$schizophrenia->is_referral 		= $rd['whether_the_referral'];//是否转诊|radio|1=>否,2=>是
			$schizophrenia->reason_referral 	= $rd['whether_the_referral_other1'];//转诊原因
			$schizophrenia->hospital_referral 	= $rd['whether_the_referral_other2'];//转诊医院
			$schizophrenia->rehabilitation_measure_other = $rd['rehabilitation_measures_other'];//康复措施其它
			$schizophrenia->rehabilitation_measures= $rd['rehabilitation_measures'];
			$schizophrenia->next_followup_time  = $rd['next_followup_date'];//下次随访时间
			$schizophrenia->followup_content 	= $rd['instruction'];//随访内容
			$schizophrenia->followup_doctor 	= $staff_id;//随访医生签名
			$schizophrenia->org_id=$org_id;
    		$schizophrenia->created = $rd['created'];//添加记录时间
    		$hy_uuid=uniqid('cd_',true);
    		$schizophrenia->uuid = $hy_uuid;//随访编号
    		//取用药
    		$drugs=mysql_query("select * from cm_drug_use where cm_uuid='".$rd['uuid']."'");
    		$i=1;
    		while ($drug=mysql_fetch_array($drugs))
    		{
    			$drug_name='drug_name'.$i;
    			$drug_usage_frequency='drug_usage_frequency'.$i;
    			$drug_usage='drug_usage'.$i;
    			$drug_dose='drug_dose'.$i;
    			$schizophrenia->$drug_name 			= $rd['followup_date'];//药物名1
				$schizophrenia->$drug_usage_frequency = $rd['followup_date'];//用法1|radio|1=>每日,2=>每月
				$schizophrenia->$drug_usage 		= $rd['followup_date'];//用法多少次1
				$schizophrenia->$drug_dose 			= $rd['followup_date'];//每次剂量1
				if ($i<4)
				{
					$i++;
				}
    		}
    		$schizophrenia->insert();
    	}
    	echo ("有精神分裂随访导入，请检查<br />");
    }
}