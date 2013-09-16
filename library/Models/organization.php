<?php
require_once ('db_oracle.php');
/**
 *注释:机构表
 *
 *
 **/
class Torganization extends dao_oracle{
	 public $__table = 'organization';
	/**
 	 * 注释:机构id
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $id;
	 public $_id_type='number';
	/**
 	 * 注释:机构中文名
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zh_name;
	 public $_zh_name_type='varchar2';
	/**
 	 * 注释:所管辖地区
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $region_path_domain;
	 public $_region_path_domain_type='varchar2';
	/**
 	 * 注释:机构所属区域
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $region_path;
	 public $_region_path_type='varchar2';
	/**
 	 * 注释:机构类型
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $type;
	 public $_type_type='varchar2';
	/**
 	 * 注释:内部码
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $standard_code;
	 public $_standard_code_type='varchar2';
	/**
 	 * 注释:机构密码
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $password;
	 public $_password_type='varchar2';
	/**
 	 * 注释:唯一标识符
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
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
	/**
 	 * 注释:经度
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $longitude;
	 public $_longitude_type='number';
	/**
 	 * 注释:纬度
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $latitude;
	 public $_latitude_type='number';
	/**
 	 * 注释:机构地址
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $address;
	 public $_address_type='varchar2';
	/**
 	 * 注释:机构电话，含区号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $phone;
	 public $_phone_type='varchar2';
	/**
 	 * 注释:机构简介
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $org_info;
	 public $_org_info_type='varchar2';
	/**
 	 * 注释:中联机构号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zl_org_code;
	 public $_zl_org_code_type='varchar2';
}
