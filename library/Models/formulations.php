<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tformulations extends dao_oracle{
	 public $__table = 'formulations';
	/**
 	 * 注释:唯一标识符
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:剂型
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $formulations_name;
	 public $_formulations_name_type='varchar2';
	/**
 	 * 注释:剂型编码
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $formulations_code;
	 public $_formulations_code_type='varchar2';
	/**
 	 * 注释:拼音
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $formulations_en;
	 public $_formulations_en_type='varchar2';
}
