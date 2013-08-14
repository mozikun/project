<?php
require_once ('db_oracle.php');
/**
 *注释:工作人员核心表
 *
 *
 **/
class Tstaff_core extends dao_oracle{
	 public $__table = 'staff_core';
	/**
 	 * 注释:内部用关键序号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:国家标准档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $standard_code;
	 public $_standard_code_type='varchar2';
	/**
 	 * 注释:医生登录名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $name_login;
	 public $_name_login_type='varchar2';
	/**
 	 * 注释:密码
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $passwd;
	 public $_passwd_type='varchar2';
	/**
 	 * 注释:所属地区id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $region_id;
	 public $_region_id_type='varchar2';
	/**
 	 * 注释:所属机构id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:角色id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $role_id;
	 public $_role_id_type='varchar2';
	/**
 	 * 注释:路径
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $region_path;
	 public $_region_path_type='varchar2';
	/**
 	 * 注释:外部业务id
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
}
