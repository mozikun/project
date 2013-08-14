<?php
require_once ('db_oracle.php');
/**
 *注释:个人检验表
 *
 *
 **/
class Tzj_clinic_lab_exam extends dao_oracle{
	 public $__table = 'zj_clinic_lab_exam';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $name;
	 public $_name_type='varchar2';
	/**
 	 * 注释:门诊ID
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $outpatient;
	 public $_outpatient_type='varchar2';
	/**
 	 * 注释:标本序号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $spe_number;
	 public $_spe_number_type='varchar2';
	/**
 	 * 注释:标本种类
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $spe_type;
	 public $_spe_type_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $departments;
	 public $_departments_type='varchar2';
	/**
 	 * 注释:床号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bed_number;
	 public $_bed_number_type='varchar2';
	/**
 	 * 注释:申请医生
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $medical_doctor;
	 public $_medical_doctor_type='varchar2';
	/**
 	 * 注释:检验仪器
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $test_equipment;
	 public $_test_equipment_type='varchar2';
	/**
 	 * 注释:性别
	 * 
	 * 
	 * @var VARCHAR2(24)
	 **/
 	 public $gender;
	 public $_gender_type='varchar2';
	/**
 	 * 注释:年龄
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $age;
	 public $_age_type='varchar2';
	/**
 	 * 注释:检验单号
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $lis_id;
	 public $_lis_id_type='varchar2';
	/**
 	 * 注释:采样日期
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $created;
	 public $_created_type='varchar2';
	/**
 	 * 注释:备注
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $remarks;
	 public $_remarks_type='varchar2';
	/**
 	 * 注释:机构id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:身份证号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $identity_number;
	 public $_identity_number_type='varchar2';
}
