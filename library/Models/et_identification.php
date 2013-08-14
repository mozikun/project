<?php
require_once ('db_oracle.php');
/**
 *注释:中医体质辨识
 *
 *
 **/
class Tet_identification extends dao_oracle{
	 public $__table = 'et_identification';
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
 	 * 注释:中医生体质名字|checkbox|1=>平和质,2=>气虚质,3=>阳虚质,4=>阴虚质,5=>痰湿质,6=>湿热质,7=>血瘀质,8=>气郁质,9=>特秉质
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $physical_medicine_name;
	 public $_physical_medicine_name_type='varchar2';
	/**
 	 * 注释:中医生体质值|radio|1=>是,2=>倾向是
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $physical_medicine_val;
	 public $_physical_medicine_val_type='varchar2';
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
