<?php
require_once ('db_oracle.php');
/**
 *注释:数据字典表
 *
 *
 **/
class Tstandard_code extends dao_oracle{
	 public $__table = 'standard_code';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $category;
	 public $_category_type='nvarchar2';
	/**
 	 * 注释:分类含义
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $category_name;
	 public $_category_name_type='nvarchar2';
	/**
 	 * 注释:内部编码
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $id;
	 public $_id_type='nvarchar2';
	/**
 	 * 注释:内部顺序号
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $inner_order;
	 public $_inner_order_type='nvarchar2';
	/**
 	 * 注释:对应的标准id
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $standard_code;
	 public $_standard_code_type='nvarchar2';
	/**
 	 * 注释:中文含义
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $c_name;
	 public $_c_name_type='nvarchar2';
	/**
 	 * 注释:排列序号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $my_order;
	 public $_my_order_type='number';
	/**
 	 * 注释:使用状态
	 * 
	 * 
	 * @var NVARCHAR2(20)
	 **/
 	 public $status;
	 public $_status_type='nvarchar2';
}
