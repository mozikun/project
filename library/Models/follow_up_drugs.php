<?php
require_once ('db_oracle.php');
/**
 *注释:随访用药表
 *
 *
 **/
class Tfollow_up_drugs extends dao_oracle{
	 public $__table = 'follow_up_drugs';
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
 	 * 注释:药物名称
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $drug_name;
	 public $_drug_name_type='varchar2';
	/**
 	 * 注释:药物用量（mg）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $drug_amount;
	 public $_drug_amount_type='varchar2';
	/**
 	 * 注释:药物用法（次）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $drug_frequency;
	 public $_drug_frequency_type='varchar2';
	/**
 	 * 注释:随访主表ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $follow_uuid;
	 public $_follow_uuid_type='varchar2';
	/**
 	 * 注释:调用模块
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $call_module;
	 public $_call_module_type='varchar2';
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
