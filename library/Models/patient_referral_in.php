<?php
require_once ('db_oracle.php');
/**
 *注释:双向转诊单--转入
 *
 *
 **/
class Tpatient_referral_in extends dao_oracle{
	 public $__table = 'patient_referral_in';
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
 	 * 注释:年龄
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $age;
	 public $_age_type='varchar2';
	/**
 	 * 注释:病案号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $medical_report_no;
	 public $_medical_report_no_type='varchar2';
	/**
 	 * 注释:存根转入时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $referral_in_time;
	 public $_referral_in_time_type='number';
	/**
 	 * 注释:转回单位
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $rewind_unit;
	 public $_rewind_unit_type='varchar2';
	/**
 	 * 注释:接诊医生
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $my_doctor;
	 public $_my_doctor_type='varchar2';
	/**
 	 * 注释:存根转诊医生签字
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $stub_doctor;
	 public $_stub_doctor_type='varchar2';
	/**
 	 * 注释:存根填表时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $stub_fill_time;
	 public $_stub_fill_time_type='number';
	/**
 	 * 注释:转到的机构名
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $my_org_name;
	 public $_my_org_name_type='varchar2';
	/**
 	 * 注释:诊断结果
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $medical_result;
	 public $_medical_result_type='varchar2';
	/**
 	 * 注释:住院病案号
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $hospitalization_no;
	 public $_hospitalization_no_type='varchar2';
	/**
 	 * 注释:主要检查结果
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $result_of_examination;
	 public $_result_of_examination_type='varchar2';
	/**
 	 * 注释:治疗经过,下一步治疗方案及康复建议
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $suggestion;
	 public $_suggestion_type='varchar2';
	/**
 	 * 注释:转诊医生（签字）
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $in_of_doctor;
	 public $_in_of_doctor_type='varchar2';
	/**
 	 * 注释:联系电话
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $phone;
	 public $_phone_type='varchar2';
	/**
 	 * 注释:转入的机构名
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $dst_org_name;
	 public $_dst_org_name_type='varchar2';
	/**
 	 * 注释:转出填表时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $fill_time;
	 public $_fill_time_type='number';
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
