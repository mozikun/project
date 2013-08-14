<?php
require_once ('db_oracle.php');
/**
 *注释:2型糖尿病 体征
 *
 *
 **/
class Tdiabetes_physical_sign extends dao_oracle{
	 public $__table = 'diabetes_physical_sign';
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
 	 * 注释:收缩压
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $blood_pressure;
	 public $_blood_pressure_type='varchar2';
	/**
 	 * 注释:体重
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $weight;
	 public $_weight_type='varchar2';
	/**
 	 * 注释:预期体重
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $expectative_weight;
	 public $_expectative_weight_type='varchar2';
	/**
 	 * 注释:体质指数
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $bmi;
	 public $_bmi_type='varchar2';
	/**
 	 * 注释:足背动脉搏动
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $arteria_dorsalis_pedis;
	 public $_arteria_dorsalis_pedis_type='varchar2';
	/**
 	 * 注释:其它
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $other;
	 public $_other_type='varchar2';
	/**
 	 * 注释:舒张压
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $diastolic_blood_pressure;
	 public $_diastolic_blood_pressure_type='varchar2';
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
	/**
 	 * 注释:预期应该达到的体制指数
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $bmi_next;
	 public $_bmi_next_type='varchar2';
	/**
 	 * 注释:本次随访身高
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $height;
	 public $_height_type='varchar2';
	/**
 	 * 注释:下次随访身高
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $height_next;
	 public $_height_next_type='varchar2';
}
