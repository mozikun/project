<?php
require_once ('db_oracle.php');
/**
 *注释:预约挂号
 *
 *
 **/
class Tappointment_register extends dao_oracle{
	 public $__table = 'appointment_register';
	/**
 	 * 注释:编号
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $uuid;
	 public $_uuid_type='nvarchar2';
	/**
 	 * 注释:医护人员id
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $doctor_id;
	 public $_doctor_id_type='nvarchar2';
	/**
 	 * 注释:添加记录时间
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $created;
	 public $_created_type='nvarchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $name;
	 public $_name_type='nvarchar2';
	/**
 	 * 注释:身份证号
	 * 
	 * 
	 * @var NVARCHAR2(36)
	 **/
 	 public $identity_number;
	 public $_identity_number_type='nvarchar2';
	/**
 	 * 注释:性别
	 * 
	 * 
	 * @var NVARCHAR2(20)
	 **/
 	 public $gender;
	 public $_gender_type='nvarchar2';
	/**
 	 * 注释:年龄
	 * 
	 * 
	 * @var NVARCHAR2(20)
	 **/
 	 public $age;
	 public $_age_type='nvarchar2';
	/**
 	 * 注释:预约挂号日期
	 * 
	 * 
	 * @var NVARCHAR2(20)
	 **/
 	 public $register_date;
	 public $_register_date_type='nvarchar2';
	/**
 	 * 注释:1=>上午,2=>下午,
	 * 
	 * 
	 * @var NVARCHAR2(20)
	 **/
 	 public $register_time;
	 public $_register_time_type='nvarchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var NVARCHAR2(20)
	 **/
 	 public $org_id;
	 public $_org_id_type='nvarchar2';
	/**
 	 * 注释:科室ID
	 * 
	 * 
	 * @var VARCHAR2(80)
	 **/
 	 public $department_id;
	 public $_department_id_type='varchar2';
	/**
 	 * 注释:号种
	 * 
	 * 
	 * @var VARCHAR2(80)
	 **/
 	 public $number_species_id;
	 public $_number_species_id_type='varchar2';
	/**
 	 * 注释:诊室ID
	 * 
	 * 
	 * @var VARCHAR2(80)
	 **/
 	 public $clinic_id;
	 public $_clinic_id_type='varchar2';
	/**
 	 * 注释:状态：1=>正常,2=>已经改号，3=>退号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $status;
	 public $_status_type='number';
	/**
 	 * 注释:更新时间
	 * 
	 * 
	 * @var NVARCHAR2(20)
	 **/
 	 public $updated;
	 public $_updated_type='nvarchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(13)
	 **/
 	 public $phone_number;
	 public $_phone_number_type='varchar2';
	/**
 	 * 注释:坐诊表id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zuozhen_id;
	 public $_zuozhen_id_type='varchar2';
}
