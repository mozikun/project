<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tdic_detail_medicine_v extends dao_oracle{
	 public $__table = 'dic_detail_medicine_v';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ybid;
	 public $_ybid_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ybsjid;
	 public $_ybsjid_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ypmc;
	 public $_ypmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ybbm;
	 public $_ybbm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ypjx;
	 public $_ypjx_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sfjbyw;
	 public $_sfjbyw_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $validation;
	 public $_validation_type='varchar2';
}
