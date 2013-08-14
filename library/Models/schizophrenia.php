<?php
require_once ('db_oracle.php');
/**
 *注释:重情精神疾病患者随访服务记录表
 *
 *
 **/
class Tschizophrenia extends dao_oracle{
	 public $__table = 'schizophrenia';
	/**
 	 * 注释:编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:医生档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:个人档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:添加记录时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:随访日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $fllowup_time;
	 public $_fllowup_time_type='number';
	/**
 	 * 注释:目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $present_symptoms;
	 public $_present_symptoms_type='varchar2';
	/**
 	 * 注释:目前症状其它
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $present_symptoms_other;
	 public $_present_symptoms_other_type='varchar2';
	/**
 	 * 注释:自知力|radio|1=>自知力完全,2=>自知力不全,3=>自知力缺失
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $insight;
	 public $_insight_type='varchar2';
	/**
 	 * 注释:睡眠情况|radio|1=>良好,2=>一般,3=>较差
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $sleep_quality;
	 public $_sleep_quality_type='varchar2';
	/**
 	 * 注释:饮食情况|radio|1=>良好,2=>一般,3=>较差
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $diet;
	 public $_diet_type='varchar2';
	/**
 	 * 注释:个人生活料理|radio|1=>良好,2=>一般,3=>较差
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $personlife_do;
	 public $_personlife_do_type='varchar2';
	/**
 	 * 注释:家务劳动|radio|1=>良好,2=>一般,3=>较差
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $housework;
	 public $_housework_type='varchar2';
	/**
 	 * 注释:生产劳动及工作|radio|1=>良好,2=>一般,3=>较差,9=>此项不适用
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $work;
	 public $_work_type='varchar2';
	/**
 	 * 注释:学习能力|radio|1=>良好,2=>一般,3=>较差
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $learning;
	 public $_learning_type='varchar2';
	/**
 	 * 注释:社会人际交往|radio|1=>良好,2=>一般,3=>较差
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $human_communication;
	 public $_human_communication_type='varchar2';
	/**
 	 * 注释:轻度滋事
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $mild_trouble;
	 public $_mild_trouble_type='varchar2';
	/**
 	 * 注释:肇事
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $accident;
	 public $_accident_type='varchar2';
	/**
 	 * 注释:肇祸
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $zhaohuo;
	 public $_zhaohuo_type='varchar2';
	/**
 	 * 注释:自伤
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $self_wounding;
	 public $_self_wounding_type='varchar2';
	/**
 	 * 注释:自杀未遂
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $attmpted_suicide;
	 public $_attmpted_suicide_type='varchar2';
	/**
 	 * 注释:室验室检查
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $lab_examination;
	 public $_lab_examination_type='varchar2';
	/**
 	 * 注释:服药依从性|radio|1=>规律,2=>间断,3=>不服药
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $compliance;
	 public $_compliance_type='varchar2';
	/**
 	 * 注释:药物不良反应|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $adverse_drug;
	 public $_adverse_drug_type='varchar2';
	/**
 	 * 注释:药物不良反应内容
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $adverse_drug_info;
	 public $_adverse_drug_info_type='varchar2';
	/**
 	 * 注释:治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $treatment_effect;
	 public $_treatment_effect_type='varchar2';
	/**
 	 * 注释:此次随访分类|radio|1=>稳定,2=>基本稳定,3=>不稳定
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $followup_classification;
	 public $_followup_classification_type='varchar2';
	/**
 	 * 注释:是否转诊|radio|1=>否,2=>是
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $is_referral;
	 public $_is_referral_type='varchar2';
	/**
 	 * 注释:转诊原因
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $reason_referral;
	 public $_reason_referral_type='varchar2';
	/**
 	 * 注释:转诊医院
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $hospital_referral;
	 public $_hospital_referral_type='varchar2';
	/**
 	 * 注释:药物名1
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $drug_name1;
	 public $_drug_name1_type='varchar2';
	/**
 	 * 注释:用法1|radio|1=>每日,2=>每月
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $drug_usage_frequency1;
	 public $_drug_usage_frequency1_type='varchar2';
	/**
 	 * 注释:用法多少次1
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $drug_usage1;
	 public $_drug_usage1_type='varchar2';
	/**
 	 * 注释:每次剂量1
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $drug_dose1;
	 public $_drug_dose1_type='varchar2';
	/**
 	 * 注释:药物名2
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $drug_name2;
	 public $_drug_name2_type='varchar2';
	/**
 	 * 注释:用法2|radio|1=>每日,2=>每月
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $drug_usage_frequency2;
	 public $_drug_usage_frequency2_type='varchar2';
	/**
 	 * 注释:用法多少次2
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $drug_usage2;
	 public $_drug_usage2_type='varchar2';
	/**
 	 * 注释:每次剂量2
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $drug_dose2;
	 public $_drug_dose2_type='varchar2';
	/**
 	 * 注释:药物名3
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $drug_name3;
	 public $_drug_name3_type='varchar2';
	/**
 	 * 注释:用法3|radio|1=>每日,2=>每月
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $drug_usage_frequency3;
	 public $_drug_usage_frequency3_type='varchar2';
	/**
 	 * 注释:用法多少次3
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $drug_usage3;
	 public $_drug_usage3_type='varchar2';
	/**
 	 * 注释:每次剂量3
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $drug_dose3;
	 public $_drug_dose3_type='varchar2';
	/**
 	 * 注释:康复措施|checkbox|1=>生活劳动能力,2=>职业训练,3=>学习能力,4=>社会交往,5=>其它
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $rehabilitation_measures;
	 public $_rehabilitation_measures_type='varchar2';
	/**
 	 * 注释:康复措施其它
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $rehabilitation_measure_other;
	 public $_rehabilitation_measure_other_type='varchar2';
	/**
 	 * 注释:下次随访日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $next_followup_time;
	 public $_next_followup_time_type='number';
	/**
 	 * 注释:随访医生签名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $followup_doctor;
	 public $_followup_doctor_type='varchar2';
	/**
 	 * 注释:随访结果
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $followup_content;
	 public $_followup_content_type='varchar2';
	/**
 	 * 注释:危险性|radio|0=>(0级),1=>(1级),2=>(2级),3=>(3级),4=>(4级),5(5级)
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $risk;
	 public $_risk_type='varchar2';
	/**
 	 * 注释:关锁情况|radio|1=>无关锁,2=>关锁,3=>关锁已解除
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $shut_case;
	 public $_shut_case_type='varchar2';
	/**
 	 * 注释:住院情况|radio|0=>从未住院,1=>目前正在住院,2=>既往住院，现未住院
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $hospitalization;
	 public $_hospitalization_type='varchar2';
	/**
 	 * 注释:住院情况末次出院时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $discharge_time;
	 public $_discharge_time_type='number';
	/**
 	 * 注释:实验室检查|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $is_lab_examination;
	 public $_is_lab_examination_type='varchar2';
	/**
 	 * 注释:扩展UUID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
}
