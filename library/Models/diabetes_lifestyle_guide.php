<?php
require_once ('db_oracle.php');
/**
 *注释:2型糖尿病 生活方式指导
 *
 *
 **/
class Tdiabetes_lifestyle_guide extends dao_oracle{
	 public $__table = 'diabetes_lifestyle_guide';
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
 	 * 注释:类别id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $group_id;
	 public $_group_id_type='varchar2';
	/**
 	 * 注释:日吸烟量
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $smoking;
	 public $_smoking_type='varchar2';
	/**
 	 * 注释:预期日吸烟量
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $expert_smoking;
	 public $_expert_smoking_type='varchar2';
	/**
 	 * 注释:日饮酒量
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $drinking;
	 public $_drinking_type='varchar2';
	/**
 	 * 注释:预期日饮酒量
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $expert_drinking;
	 public $_expert_drinking_type='varchar2';
	/**
 	 * 注释:运动频率次/周
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $frequency;
	 public $_frequency_type='varchar2';
	/**
 	 * 注释:运动频率分钟/次
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $frequency_time;
	 public $_frequency_time_type='varchar2';
	/**
 	 * 注释:预期运动频率次/周
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $expert_frequency;
	 public $_expert_frequency_type='varchar2';
	/**
 	 * 注释:预期运动频率分钟/次
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $expert_frequency_time;
	 public $_expert_frequency_time_type='varchar2';
	/**
 	 * 注释:主食
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $main_course;
	 public $_main_course_type='varchar2';
	/**
 	 * 注释:预期主食
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $expert_main_course;
	 public $_expert_main_course_type='varchar2';
	/**
 	 * 注释:心理调整
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $heart_adjustment;
	 public $_heart_adjustment_type='varchar2';
	/**
 	 * 注释:遵医行为
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $complian;
	 public $_complian_type='varchar2';
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
