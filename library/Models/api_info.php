<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tapi_info extends dao_oracle{
	 public $__table = 'api_info';
	/**
 	 * 注释:内部标识符
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $internal_identifier;
	 public $_internal_identifier_type='varchar2';
	/**
 	 * 注释:数据元标识符（DE）
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $data_element;
	 public $_data_element_type='varchar2';
	/**
 	 * 注释:数据元名称
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $data_element_name;
	 public $_data_element_name_type='varchar2';
	/**
 	 * 注释:定义
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $definition;
	 public $_definition_type='varchar2';
	/**
 	 * 注释:数据元值的数据类型
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $data_type;
	 public $_data_type_type='varchar2';
	/**
 	 * 注释:表示格式 
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $data_format;
	 public $_data_format_type='varchar2';
	/**
 	 * 注释:数据元允许值
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $allowable_value;
	 public $_allowable_value_type='varchar2';
	/**
 	 * 注释:表名
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $table_name;
	 public $_table_name_type='varchar2';
	/**
 	 * 注释:字段名
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $fields;
	 public $_fields_type='varchar2';
	/**
 	 * 注释:雅安字段是否与数据元素标识符一致1=>一致
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $same_as_de;
	 public $_same_as_de_type='varchar2';
	/**
 	 * 注释:排序
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $order_by;
	 public $_order_by_type='varchar2';
	/**
 	 * 注释:模块id号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $module_id;
	 public $_module_id_type='varchar2';
}
