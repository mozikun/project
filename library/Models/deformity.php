<?php
require_once ('db_oracle.php');
/**
 *注释:残疾状况
 *
 *
 **/
class Tdeformity extends dao_oracle{
	 public $__table = 'deformity';
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
 	 * 注释:
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
 	 * 注释:残疾类型
	 * 
	 * 
	 * @var NVARCHAR2(8)
	 **/
 	 public $deformity_type;
	 public $_deformity_type_type='nvarchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $filing_time;
	 public $_filing_time_type='number';
	/**
 	 * 注释:用于存储其他项的文字说明
	 * 
	 * 
	 * @var NVARCHAR2(400)
	 **/
 	 public $deformity_comment;
	 public $_deformity_comment_type='nvarchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(100)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='nvarchar2';
}
