<?php
require_once ('db_oracle.php');
/**
 *注释:主要用药情况
 *
 *
 **/
class Tet_main_drug_use extends dao_oracle{
	 public $__table = 'et_main_drug_use';
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
	 * @var VARCHAR2(30)
	 **/
 	 public $created;
	 public $_created_type='varchar2';
	/**
 	 * 注释:健康体检id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $examination_id;
	 public $_examination_id_type='varchar2';
	/**
 	 * 注释:药物名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $drug_name;
	 public $_drug_name_type='varchar2';
	/**
 	 * 注释:用法
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $drug_usage;
	 public $_drug_usage_type='varchar2';
	/**
 	 * 注释:用量
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $drug_dosage;
	 public $_drug_dosage_type='varchar2';
	/**
 	 * 注释:用药时间
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $drug_time;
	 public $_drug_time_type='varchar2';
	/**
 	 * 注释:服药依从性|radio|1=>规律,2=>间断,3=>不服药
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $drug_compliance;
	 public $_drug_compliance_type='varchar2';
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
