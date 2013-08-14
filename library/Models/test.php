<?php
require_once ('db_oracle.php');
/**
 *注释:测试表
 *
 *
 **/
class Ttest extends dao_oracle{
	 public $__table = 'test';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $name;
	 public $_name_type='varchar2';
	/**
 	 * 注释:年龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $age;
	 public $_age_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $id;
	 public $_id_type='number';
}
