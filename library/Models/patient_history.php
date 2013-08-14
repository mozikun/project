<?php
require_once ('db_oracle.php');
/**
 *注释:门诊病历
 *
 *
 **/
class Tpatient_history extends dao_oracle{
	 public $__table = 'patient_history';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:医院id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hospital_id;
	 public $_hospital_id_type='varchar2';
	/**
 	 * 注释:医生ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $doctor_id;
	 public $_doctor_id_type='varchar2';
	/**
 	 * 注释:身份证号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $id_card;
	 public $_id_card_type='varchar2';
	/**
 	 * 注释:就诊日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $diagnosis_time;
	 public $_diagnosis_time_type='number';
	/**
 	 * 注释:诊段结果（icd-10）
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $diagnosis;
	 public $_diagnosis_type='varchar2';
	/**
 	 * 注释:门诊病历小结
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $patient_history;
	 public $_patient_history_type='varchar2';
	/**
 	 * 注释:备注
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $remark;
	 public $_remark_type='varchar2';
	/**
 	 * 注释:个人档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $serial_number;
	 public $_serial_number_type='varchar2';
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
