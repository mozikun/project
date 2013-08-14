<?php
require_once ('db_oracle.php');
/**
 *注释:一般状况
 *
 *
 **/
class Tet_general_condition extends dao_oracle{
	 public $__table = 'et_general_condition';
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
 	 * 注释:健康体检id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $examination_id;
	 public $_examination_id_type='varchar2';
	/**
 	 * 注释:体温|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $temperature;
	 public $_temperature_type='varchar2';
	/**
 	 * 注释:脉搏|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $pulse;
	 public $_pulse_type='varchar2';
	/**
 	 * 注释:呼吸频率|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $breathing_rate;
	 public $_breathing_rate_type='varchar2';
	/**
 	 * 注释:血压左收缩压|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $blood_pressure_left_s;
	 public $_blood_pressure_left_s_type='varchar2';
	/**
 	 * 注释:血压左舒张压|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $blood_pressure_left_p;
	 public $_blood_pressure_left_p_type='varchar2';
	/**
 	 * 注释:血压右收缩压|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $blood_pressure_right_s;
	 public $_blood_pressure_right_s_type='varchar2';
	/**
 	 * 注释:血压右舒张压|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $blood_pressure_right_p;
	 public $_blood_pressure_right_p_type='varchar2';
	/**
 	 * 注释:身高|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $height;
	 public $_height_type='varchar2';
	/**
 	 * 注释:体重|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $weight;
	 public $_weight_type='varchar2';
	/**
 	 * 注释:体质指数|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $bmi;
	 public $_bmi_type='varchar2';
	/**
 	 * 注释:腰围|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $waistline;
	 public $_waistline_type='varchar2';
	/**
 	 * 注释:臀围|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $hipcircumference;
	 public $_hipcircumference_type='varchar2';
	/**
 	 * 注释:腰臀围比值|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $whi;
	 public $_whi_type='varchar2';
	/**
 	 * 注释:老年人认知功能|checkbox|1=>粗筛阴性,2=>粗筛阳性
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $older_cognitive_functions;
	 public $_older_cognitive_functions_type='varchar2';
	/**
 	 * 注释:智力状态检查总分|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $mmse;
	 public $_mmse_type='varchar2';
	/**
 	 * 注释:老年人情感状态|checbox|1=>粗筛阴性,2=>粗筛阳性
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $older_affective_state;
	 public $_older_affective_state_type='varchar2';
	/**
 	 * 注释:老年人抑郁量表总分|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $depression;
	 public $_depression_type='varchar2';
	/**
 	 * 注释:老年人健康状态自我评估
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $elder_health_status;
	 public $_elder_health_status_type='varchar2';
	/**
 	 * 注释:老年人生活自理能力自我评估
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $elder_living_skills;
	 public $_elder_living_skills_type='varchar2';
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
