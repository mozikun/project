<?php
require_once ('db_oracle.php');
/**
 *注释:遗传病史
 *
 *
 **/
class Tgenetic_diseases extends dao_oracle{
	 public $__table = 'genetic_diseases';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $org_id;
	 public $_org_id_type='nvarchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='nvarchar2';
	/**
 	 * 注释:同个人档案的uuid关联
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $id;
	 public $_id_type='nvarchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $deleted;
	 public $_deleted_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(8)
	 **/
 	 public $status_flag;
	 public $_status_flag_type='nvarchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(8)
	 **/
 	 public $syn_flag;
	 public $_syn_flag_type='nvarchar2';
	/**
 	 * 注释:疾病名称
	 * 
	 * 
	 * @var NVARCHAR2(400)
	 **/
 	 public $disease_name;
	 public $_disease_name_type='nvarchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $filing_time;
	 public $_filing_time_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(100)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='nvarchar2';
}
