<?php
require_once ('db_oracle.php');
/**
 *注释:资源表
 *
 *
 **/
class Tresources extends dao_oracle{
	 public $__table = 'resources';
	/**
 	 * 注释:资源id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $resource_id;
	 public $_resource_id_type='varchar2';
	/**
 	 * 注释:资源英文名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $resource_en_name;
	 public $_resource_en_name_type='varchar2';
	/**
 	 * 注释:资源中文名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $resource_zh_name;
	 public $_resource_zh_name_type='varchar2';
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
