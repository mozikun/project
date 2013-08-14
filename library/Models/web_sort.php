<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tweb_sort extends dao_oracle{
	 public $__table = 'web_sort';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:分类名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $sortname;
	 public $_sortname_type='varchar2';
	/**
 	 * 注释:分类拼音
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $sortname_py;
	 public $_sortname_py_type='varchar2';
	/**
 	 * 注释:父分类
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $parent_uuid;
	 public $_parent_uuid_type='varchar2';
	/**
 	 * 注释:分类路径，|分隔
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $path;
	 public $_path_type='varchar2';
	/**
 	 * 注释:分类介绍
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $sortinfo;
	 public $_sortinfo_type='varchar2';
}
