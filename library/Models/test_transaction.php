<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ttest_transaction extends dao_oracle{
	 public $__table = 'test_transaction';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(10)
	 **/
 	 public $jzlsh;
	 public $_jzlsh_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(10)
	 **/
 	 public $doctor_id;
	 public $_doctor_id_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $data;
	 public $_data_type='number';
}
