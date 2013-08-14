<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ticd extends dao_oracle{
	 public $__table = 'icd';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $icd_id;
	 public $_icd_id_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $icd_zh_name;
	 public $_icd_zh_name_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(120)
	 **/
 	 public $icd_py;
	 public $_icd_py_type='nvarchar2';
}
