<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tdic_instrument_v extends dao_oracle{
	 public $__table = 'dic_instrument_v';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $yqbh;
	 public $_yqbh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $yqmc;
	 public $_yqmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sbbm;
	 public $_sbbm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='varchar2';
}
