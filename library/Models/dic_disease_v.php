<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tdic_disease_v extends dao_oracle{
	 public $__table = 'dic_disease_v';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $id;
	 public $_id_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $fdmz;
	 public $_fdmz_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dmxz;
	 public $_dmxz_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $dmxmc;
	 public $_dmxmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $pyzjm;
	 public $_pyzjm_type='varchar2';
}
