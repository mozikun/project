<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tconsumables_category extends dao_oracle{
	 public $__table = 'consumables_category';
	/**
 	 * 注释:唯一标识
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:分类名称
	 * 
	 * 
	 * @var VARCHAR2(500)
	 **/
 	 public $zh_name;
	 public $_zh_name_type='varchar2';
	/**
 	 * 注释:分类父id
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $p_id;
	 public $_p_id_type='number';
	/**
 	 * 注释:分类id
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $id;
	 public $_id_type='number';
	/**
 	 * 注释:分类路径
	 * 
	 * 
	 * @var VARCHAR2(500)
	 **/
 	 public $path;
	 public $_path_type='varchar2';
	/**
 	 * 注释:分类标准码
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $standard_code;
	 public $_standard_code_type='varchar2';
}
