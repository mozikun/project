<?php
require_once ('db_oracle.php');
/**
 *注释:标准档案规范化完整率
 *
 *
 **/
class Tstandard_archive_rate extends dao_oracle{
	 public $__table = 'standard_archive_rate';
	/**
 	 * 注释:表名
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $table_name;
	 public $_table_name_type='nvarchar2';
	/**
 	 * 注释:表中文名
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $table_zh_name;
	 public $_table_zh_name_type='nvarchar2';
	/**
 	 * 注释:模块名(就是存储完整率字段的主表名)
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $module_name;
	 public $_module_name_type='nvarchar2';
	/**
 	 * 注释:模块中文名
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $module_zh_name;
	 public $_module_zh_name_type='nvarchar2';
	/**
 	 * 注释:字段名
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $column_name;
	 public $_column_name_type='nvarchar2';
	/**
 	 * 注释:字段中文名
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $column_zh_name;
	 public $_column_zh_name_type='nvarchar2';
	/**
 	 * 注释:是否必填
	 * 
	 * 
	 * @var NVARCHAR2(2)
	 **/
 	 public $criteria;
	 public $_criteria_type='nvarchar2';
	/**
 	 * 注释:相关条件（保留）
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $criteria_rule;
	 public $_criteria_rule_type='nvarchar2';
	/**
 	 * 注释:取值范围
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $allowed_value;
	 public $_allowed_value_type='nvarchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $uuid;
	 public $_uuid_type='nvarchar2';
	/**
 	 * 注释:地区路径，用于区分多个地区
	 * 
	 * 
	 * @var NVARCHAR2(400)
	 **/
 	 public $region_path;
	 public $_region_path_type='nvarchar2';
}
