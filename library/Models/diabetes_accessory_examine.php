<?php
require_once ('db_oracle.php');
/**
 *注释:2型糖尿病 生活方式指导
 *
 *
 **/
class Tdiabetes_accessory_examine extends dao_oracle{
	 public $__table = 'diabetes_accessory_examine';
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
 	 * 注释:空腹血糖值
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $fasting_bloodglucose;
	 public $_fasting_bloodglucose_type='varchar2';
	/**
 	 * 注释:糖化血红蛋白
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hbclc;
	 public $_hbclc_type='varchar2';
	/**
 	 * 注释:检查日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $eamination_time;
	 public $_eamination_time_type='number';
	/**
 	 * 注释:检查内容
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $eamination_info;
	 public $_eamination_info_type='varchar2';
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
