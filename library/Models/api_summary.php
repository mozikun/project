<?php
require_once ('db_oracle.php');
/**
 *注释:接口概要
 *
 *
 **/
class Tapi_summary extends dao_oracle{
	 public $__table = 'api_summary';
	/**
 	 * 注释:唯一id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:创建时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:更新时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
	/**
 	 * 注释:模块id
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $module_id;
	 public $_module_id_type='varchar2';
	/**
 	 * 注释:机构id
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:医生id
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $doctor_id;
	 public $_doctor_id_type='varchar2';
	/**
 	 * 注释:病人姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $patient_name;
	 public $_patient_name_type='varchar2';
	/**
 	 * 注释:病人性别
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $patient_sex;
	 public $_patient_sex_type='varchar2';
	/**
 	 * 注释:病人身份证号
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $patient_identity_card;
	 public $_patient_identity_card_type='varchar2';
	/**
 	 * 注释:文档id
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $document_id;
	 public $_document_id_type='varchar2';
	/**
 	 * 注释:文档时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $document_time;
	 public $_document_time_type='number';
	/**
 	 * 注释:门急诊诊断时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr02_time;
	 public $_emr02_time_type='number';
	/**
 	 * 注释:入院时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr09_time;
	 public $_emr09_time_type='number';
	/**
 	 * 注释:出院时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr12_time;
	 public $_emr12_time_type='number';
	/**
 	 * 注释:自费
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $emr08_01_01_249;
	 public $_emr08_01_01_249_type='varchar2';
	/**
 	 * 注释:检验费
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $inspection_fees;
	 public $_inspection_fees_type='varchar2';
	/**
 	 * 注释:治疗费
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $treatment_costs;
	 public $_treatment_costs_type='varchar2';
	/**
 	 * 注释:床位费
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bed_fee;
	 public $_bed_fee_type='varchar2';
	/**
 	 * 注释:护理费
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $nursing_fees;
	 public $_nursing_fees_type='varchar2';
	/**
 	 * 注释:特检费
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $special_fee;
	 public $_special_fee_type='varchar2';
	/**
 	 * 注释:其他费
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $other_fee;
	 public $_other_fee_type='varchar2';
	/**
 	 * 注释:中成药费
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $chinese_medicine;
	 public $_chinese_medicine_type='varchar2';
	/**
 	 * 注释:西药费
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $western_medicine;
	 public $_western_medicine_type='varchar2';
	/**
 	 * 注释:报销费用
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $difference_fee;
	 public $_difference_fee_type='varchar2';
	/**
 	 * 注释:费用代码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $medical_code;
	 public $_medical_code_type='varchar2';
	/**
 	 * 注释:总费用
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sum_fee;
	 public $_sum_fee_type='varchar2';
}
