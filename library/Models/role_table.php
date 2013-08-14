<?php
require_once ('db_oracle.php');
/**
 *注释:角色表
 *
 *
 **/
class Trole_table extends dao_oracle{
	 public $__table = 'role_table';
	/**
 	 * 注释:角色id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $role_id;
	 public $_role_id_type='varchar2';
	/**
 	 * 注释:角色英文名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $role_en_name;
	 public $_role_en_name_type='varchar2';
	/**
 	 * 注释:角色中文名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $role_zh_name;
	 public $_role_zh_name_type='varchar2';
	/**
 	 * 注释:角色的创建时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:角色的修改时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
	/**
 	 * 注释:管理权限
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $width_option;
	 public $_width_option_type='varchar2';
}
