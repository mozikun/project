<?php
require_once ('db_oracle.php');
/**
 *注释:第2-5次产前访视记录
 *
 *
 **/
class Tprenatal_visit_two extends dao_oracle{
	 public $__table = 'prenatal_visit_two';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:和第一次产前随访关联
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $fid;
	 public $_fid_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:随访日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $follow_time;
	 public $_follow_time_type='number';
	/**
 	 * 注释:孕周
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $gestational_weeks;
	 public $_gestational_weeks_type='varchar2';
	/**
 	 * 注释:主诉
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $subject_description;
	 public $_subject_description_type='varchar2';
	/**
 	 * 注释:体重
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $weight;
	 public $_weight_type='varchar2';
	/**
 	 * 注释:宫底高度
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $fundal_height;
	 public $_fundal_height_type='varchar2';
	/**
 	 * 注释:腹围
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $abdomen_circumference;
	 public $_abdomen_circumference_type='varchar2';
	/**
 	 * 注释:胎心率
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $heart_rate;
	 public $_heart_rate_type='varchar2';
	/**
 	 * 注释:收缩压
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $systolic_blood_pressure;
	 public $_systolic_blood_pressure_type='varchar2';
	/**
 	 * 注释:舒张压
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $diastolic_blood_pressure;
	 public $_diastolic_blood_pressure_type='varchar2';
	/**
 	 * 注释:血红蛋白值
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $hemoglobin;
	 public $_hemoglobin_type='varchar2';
	/**
 	 * 注释:尿蛋白
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $azoturia;
	 public $_azoturia_type='varchar2';
	/**
 	 * 注释:其他检查
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $other_check;
	 public $_other_check_type='varchar2';
	/**
 	 * 注释:B超
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $b_ultrasonic;
	 public $_b_ultrasonic_type='varchar2';
	/**
 	 * 注释:血糖筛查
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $blood_sugar;
	 public $_blood_sugar_type='varchar2';
	/**
 	 * 注释:孕妇分类
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $pregnant_sort;
	 public $_pregnant_sort_type='varchar2';
	/**
 	 * 注释:孕妇分类说明
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $pregnant_sort_info;
	 public $_pregnant_sort_info_type='varchar2';
	/**
 	 * 注释:指导
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $medical_advice;
	 public $_medical_advice_type='varchar2';
	/**
 	 * 注释:转诊
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $referral;
	 public $_referral_type='varchar2';
	/**
 	 * 注释:转诊原因
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $referral_reason;
	 public $_referral_reason_type='varchar2';
	/**
 	 * 注释:转诊机构
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $referral_org;
	 public $_referral_org_type='varchar2';
	/**
 	 * 注释:下次随访日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $follow_next_time;
	 public $_follow_next_time_type='number';
	/**
 	 * 注释:随访责任医生
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $follow_staff;
	 public $_follow_staff_type='varchar2';
	/**
 	 * 注释:用于控制次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $follow_count;
	 public $_follow_count_type='number';
	/**
 	 * 注释:胎位
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $fetal_position;
	 public $_fetal_position_type='varchar2';
	/**
 	 * 注释:指导其他项
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $medical_advice_info;
	 public $_medical_advice_info_type='varchar2';
	/**
 	 * 注释:扩展UUID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
}
