<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tdisease_name extends dao_oracle{
	 public $__table = 'disease_name';
	/**
 	 * 注释:唯一标示
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:疾病诊断名称
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $d_zh_name;
	 public $_d_zh_name_type='varchar2';
	/**
 	 * 注释:疾病诊断编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $d_standard_code;
	 public $_d_standard_code_type='varchar2';
	/**
 	 * 注释:疾病分类id
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $category_id;
	 public $_category_id_type='varchar2';
}
