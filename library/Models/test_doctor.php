<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ttest_doctor extends dao_oracle{
	 public $__table = 'test_doctor';
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
	 * @var CHAR(10)
	 **/
 	 public $xm;
	 public $_xm_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(6)
	 **/
 	 public $gender;
	 public $_gender_type='char';
}
