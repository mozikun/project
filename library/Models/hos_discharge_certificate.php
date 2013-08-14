<?php
require_once ('db_oracle.php');
/**
 *注释:出院证明
 *
 *
 **/
class Thos_discharge_certificate extends dao_oracle{
	 public $__table = 'hos_discharge_certificate';
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
 	 * 注释:入院日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $admission_time;
	 public $_admission_time_type='number';
	/**
 	 * 注释:出院日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $discharged_time;
	 public $_discharged_time_type='number';
	/**
 	 * 注释:诊断小结
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $diagnosis;
	 public $_diagnosis_type='varchar2';
	/**
 	 * 注释:出院医嘱建议
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $suggestion;
	 public $_suggestion_type='varchar2';
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
