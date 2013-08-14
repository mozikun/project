<?php
require_once ('db_oracle.php');
/**
 *注释:随访基础表
 *
 *
 **/
class Thypertension_follow_up extends dao_oracle{
	 public $__table = 'hypertension_follow_up';
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
 	 public $follow_time;
	 public $_follow_time_type='number';
	/**
 	 * 注释:下次随访日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $follow_next_time;
	 public $_follow_next_time_type='number';
	/**
 	 * 注释:随访方式
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $follow_type;
	 public $_follow_type_type='varchar2';
	/**
 	 * 注释:收缩压
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $blood_pressure;
	 public $_blood_pressure_type='varchar2';
	/**
 	 * 注释:体重
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $weight_begin;
	 public $_weight_begin_type='varchar2';
	/**
 	 * 注释:预期体重
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $weight_after;
	 public $_weight_after_type='varchar2';
	/**
 	 * 注释:体质指数
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $body_mass_index;
	 public $_body_mass_index_type='varchar2';
	/**
 	 * 注释:心率
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $heart_rate_begin;
	 public $_heart_rate_begin_type='varchar2';
	/**
 	 * 注释:期望心率
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $heart_rate_after;
	 public $_heart_rate_after_type='varchar2';
	/**
 	 * 注释:体征其他
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $signs_other;
	 public $_signs_other_type='varchar2';
	/**
 	 * 注释:日吸烟量
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $smoking_begin;
	 public $_smoking_begin_type='varchar2';
	/**
 	 * 注释:期望日吸烟量
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $smoking_after;
	 public $_smoking_after_type='varchar2';
	/**
 	 * 注释:日饮酒量
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $drinking_begin;
	 public $_drinking_begin_type='varchar2';
	/**
 	 * 注释:期望日饮酒量
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $drinking_after;
	 public $_drinking_after_type='varchar2';
	/**
 	 * 注释:运动次数（次/周）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sport_amount_begin;
	 public $_sport_amount_begin_type='varchar2';
	/**
 	 * 注释:期望运动次数（次/周）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sport_amount_after;
	 public $_sport_amount_after_type='varchar2';
	/**
 	 * 注释:运动频率（分钟/次）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sport_time_begin;
	 public $_sport_time_begin_type='varchar2';
	/**
 	 * 注释:期望运动频率（分钟/次）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sport_time_after;
	 public $_sport_time_after_type='varchar2';
	/**
 	 * 注释:摄盐情况（克/天）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $salt_intake_begin;
	 public $_salt_intake_begin_type='varchar2';
	/**
 	 * 注释:期望摄盐情况（克/天）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $salt_intake_after;
	 public $_salt_intake_after_type='varchar2';
	/**
 	 * 注释:心理调整
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $psychology;
	 public $_psychology_type='varchar2';
	/**
 	 * 注释:遵医行为
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $treatment_compliance;
	 public $_treatment_compliance_type='varchar2';
	/**
 	 * 注释:辅助检查
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $auxiliary_check;
	 public $_auxiliary_check_type='varchar2';
	/**
 	 * 注释:服药依从性
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $medication_compliance;
	 public $_medication_compliance_type='varchar2';
	/**
 	 * 注释:药物不良反应
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $adverse_drug;
	 public $_adverse_drug_type='varchar2';
	/**
 	 * 注释:药物不良反应详细说明
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $adverse_drug_info;
	 public $_adverse_drug_info_type='varchar2';
	/**
 	 * 注释:此次随访分类
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $follow_up_result;
	 public $_follow_up_result_type='varchar2';
	/**
 	 * 注释:转诊原因
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $referral_reason;
	 public $_referral_reason_type='varchar2';
	/**
 	 * 注释:机构及科别
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $organization;
	 public $_organization_type='varchar2';
	/**
 	 * 注释:症状内容
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $symptom_other;
	 public $_symptom_other_type='varchar2';
	/**
 	 * 注释:舒张压
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $diastolic_blood_pressure;
	 public $_diastolic_blood_pressure_type='varchar2';
	/**
 	 * 注释:随访结果
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $follow_result;
	 public $_follow_result_type='varchar2';
	/**
 	 * 注释:是否妊娠期或哺乳期
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $pregnancy;
	 public $_pregnancy_type='varchar2';
	/**
 	 * 注释:体检基本信息表ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $physical_base_uuid;
	 public $_physical_base_uuid_type='varchar2';
	/**
 	 * 注释:身高
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $height;
	 public $_height_type='varchar2';
	/**
 	 * 注释:双侧血压差值
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $blood_difference;
	 public $_blood_difference_type='varchar2';
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
