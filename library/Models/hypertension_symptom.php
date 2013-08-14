<?php
require_once ('db_oracle.php');
/**
 *注释:随访症状表
 *
 *
 **/
class Thypertension_symptom extends dao_oracle{
	 public $__table = 'hypertension_symptom';
	/**
 	 * 注释:
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
 	 * 注释:症状代码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $symptom_code;
	 public $_symptom_code_type='varchar2';
	/**
 	 * 注释:症状内容
	 * 
	 * 
	 * @var VARCHAR2(1000)
	 **/
 	 public $symptom_other;
	 public $_symptom_other_type='varchar2';
	/**
 	 * 注释:随访主表ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $follow_up_uuid;
	 public $_follow_up_uuid_type='varchar2';
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
