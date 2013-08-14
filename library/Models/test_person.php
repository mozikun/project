<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ttest_person extends dao_oracle{
	 public $__table = 'test_person';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(10)
	 **/
 	 public $kh;
	 public $_kh_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(10)
	 **/
 	 public $xm;
	 public $_xm_type='char';
}
