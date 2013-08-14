<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tapi_doctor extends dao_oracle{
	 public $__table = 'api_doctor';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
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
	 * @var VARCHAR2(100)
	 **/
 	 public $org_name;
	 public $_org_name_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $doctor_code;
	 public $_doctor_code_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $doctor_name;
	 public $_doctor_name_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(19)
	 **/
 	 public $identity_number;
	 public $_identity_number_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $flag;
	 public $_flag_type='varchar2';
}
