<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ttb_dic_specimen1 extends dao_oracle{
	 public $__table = 'tb_dic_specimen1';
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
