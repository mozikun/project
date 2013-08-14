<?php
require_once ('db_oracle.php');
/**
 *注释:血型
 *
 *
 **/
class Tblood_type extends dao_oracle{
	 public $__table = 'blood_type';
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
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:同个人档案的uuid关联
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
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
	 * @var VARCHAR2(4)
	 **/
 	 public $status_flag;
	 public $_status_flag_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $syn_flag;
	 public $_syn_flag_type='varchar2';
	/**
 	 * 注释:ABO血型
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $abo_bloodtype;
	 public $_abo_bloodtype_type='varchar2';
	/**
 	 * 注释:RH阴性
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $rh_bloodtype;
	 public $_rh_bloodtype_type='varchar2';
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
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
}
