<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tdic_specimen_v extends dao_oracle{
	 public $__table = 'dic_specimen_v';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $bbdm;
	 public $_bbdm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $bbmc;
	 public $_bbmc_type='varchar2';
}
