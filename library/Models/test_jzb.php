<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ttest_jzb extends dao_oracle{
	 public $__table = 'test_jzb';
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
 	 public $kh;
	 public $_kh_type='char';
}
