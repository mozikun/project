<?php
require_once ('db_oracle.php');
/**
 *注释:角色对应的资源
 *
 *
 **/
class Trole_resource extends dao_oracle{
	 public $__table = 'role_resource';
	/**
 	 * 注释:角色对应的资源id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:角色ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $role_id;
	 public $_role_id_type='varchar2';
	/**
 	 * 注释:资源ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $resource_id;
	 public $_resource_id_type='varchar2';
	/**
 	 * 注释:角色对资源可读
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $read;
	 public $_read_type='number';
	/**
 	 * 注释:角色对资源可写
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $write;
	 public $_write_type='number';
	/**
 	 * 注释:资源的创建时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:资源的修改时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
}
