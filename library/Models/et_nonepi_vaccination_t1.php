<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tet_nonepi_vaccination_t1 extends dao_oracle{
	 public $__table = 'et_nonepi_vaccination_t1';
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
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:
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
	 * @var VARCHAR2(30)
	 **/
 	 public $created;
	 public $_created_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $examination_id;
	 public $_examination_id_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $vaccination_name;
	 public $_vaccination_name_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $vaccination_time;
	 public $_vaccination_time_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $vaccination_org;
	 public $_vaccination_org_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
}
