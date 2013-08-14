<?php
require_once ('db_oracle.php');
/**
 *注释:工作计划维护表
 *
 *
 **/
class Ttips_type extends dao_oracle{
	 public $__table = 'tips_type';
	/**
 	 * 注释:唯一ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:项目ID号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $id;
	 public $_id_type='number';
	/**
 	 * 注释:工作计划类别中文名
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $tipszh_name;
	 public $_tipszh_name_type='varchar2';
	/**
 	 * 注释:上级ID
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tips_pid;
	 public $_tips_pid_type='number';
	/**
 	 * 注释:路径
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $tips_region;
	 public $_tips_region_type='varchar2';
	/**
 	 * 注释:所在级别
	 * 
	 * 
	 * @var VARCHAR2(26)
	 **/
 	 public $tips_level;
	 public $_tips_level_type='varchar2';
	/**
 	 * 注释:创建时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:角色的英文名称
	 * 
	 * 
	 * @var VARCHAR2(26)
	 **/
 	 public $role_en_name;
	 public $_role_en_name_type='varchar2';
	/**
 	 * 注释:当前的地区path
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $region_path;
	 public $_region_path_type='varchar2';
	/**
 	 * 注释:当前机构的id
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:操作人ID
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $doctor_id;
	 public $_doctor_id_type='varchar2';
}
