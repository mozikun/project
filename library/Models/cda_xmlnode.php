<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tcda_xmlnode extends dao_oracle{
	 public $__table = 'cda_xmlnode';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:字段名
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $cols_name;
	 public $_cols_name_type='varchar2';
	/**
 	 * 注释:平台表名
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $table_name;
	 public $_table_name_type='varchar2';
	/**
 	 * 注释:数据源标识符
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $de_code;
	 public $_de_code_type='varchar2';
	/**
 	 * 注释:数据元标识符名称
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $de_name;
	 public $_de_name_type='varchar2';
	/**
 	 * 注释:数据元类型
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $de_type;
	 public $_de_type_type='varchar2';
	/**
 	 * 注释:是否必填，1是，2否
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $is_required;
	 public $_is_required_type='number';
	/**
 	 * 注释:xml节点名称
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $xml_node;
	 public $_xml_node_type='varchar2';
}
