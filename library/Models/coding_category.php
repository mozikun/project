<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tcoding_category extends dao_oracle{
	 public $__table = 'coding_category';
	/**
 	 * 注释:编码id号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $code_id;
	 public $_code_id_type='number';
	/**
 	 * 注释:编码上级id号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $p_id;
	 public $_p_id_type='number';
	/**
 	 * 注释:编码唯一标识符
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $uuid;
	 public $_uuid_type='nvarchar2';
	/**
 	 * 注释:编码路径
	 * 
	 * 
	 * @var NVARCHAR2(400)
	 **/
 	 public $code_path;
	 public $_code_path_type='nvarchar2';
	/**
 	 * 注释:中文名称含义
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $code_name;
	 public $_code_name_type='nvarchar2';
	/**
 	 * 注释:状态 区分属性还是分类
	 * 
	 * 
	 * @var NVARCHAR2(20)
	 **/
 	 public $flag_tag;
	 public $_flag_tag_type='nvarchar2';
	/**
 	 * 注释:分类级次
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $code_level;
	 public $_code_level_type='nvarchar2';
	/**
 	 * 注释:编码
	 * 
	 * 
	 * @var NVARCHAR2(80)
	 **/
 	 public $standard_code;
	 public $_standard_code_type='nvarchar2';
}
