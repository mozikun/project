<?php
require_once ('db_oracle.php');
/**
 *注释:2型糖尿病 症状
 *
 *
 **/
class Tdiabetes_symptom extends dao_oracle{
	 public $__table = 'diabetes_symptom';
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
 	 * 注释:症状
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $diabetes_symptom;
	 public $_diabetes_symptom_type='varchar2';
	/**
 	 * 注释:症状其它
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $symptom_other;
	 public $_symptom_other_type='varchar2';
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
