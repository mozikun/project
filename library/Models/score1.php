<?php
require_once ('db_oracle.php');
/**
 *注释:学生成绩表
 *
 *
 **/
class Tscore1 extends dao_oracle{
	 public $__table = 'score1';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(10)
	 **/
 	 public $id;
	 public $_id_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $english;
	 public $_english_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $chinese;
	 public $_chinese_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $computer;
	 public $_computer_type='number';
}
