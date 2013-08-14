<?php
require_once ('db_oracle.php');
/**
 *注释:体格检查-基本检查
 *
 *
 **/
class Tphysical_base extends dao_oracle{
	 public $__table = 'physical_base';
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
 	 * 注释:模块名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $module_name;
	 public $_module_name_type='varchar2';
	/**
 	 * 注释:引用模块的uuid
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $r_uuid;
	 public $_r_uuid_type='varchar2';
	/**
 	 * 注释:引用模块的url
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $r_url;
	 public $_r_url_type='varchar2';
	/**
 	 * 注释:身高(厘米)|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $height;
	 public $_height_type='varchar2';
	/**
 	 * 注释:体重(公斤)|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $weight;
	 public $_weight_type='varchar2';
	/**
 	 * 注释:体重指数|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bmi;
	 public $_bmi_type='varchar2';
	/**
 	 * 注释:收缩压(mmHg)|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $s_blood_pressure;
	 public $_s_blood_pressure_type='varchar2';
	/**
 	 * 注释:舒张压(mmHg)|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $p_blood_pressure;
	 public $_p_blood_pressure_type='varchar2';
	/**
 	 * 注释:医生签字|text
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $doctors_signature;
	 public $_doctors_signature_type='varchar2';
	/**
 	 * 注释:体检时间|text
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $experience_time;
	 public $_experience_time_type='number';
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
	/**
 	 * 注释:空腹血糖
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $blood_sugar;
	 public $_blood_sugar_type='varchar2';
}
