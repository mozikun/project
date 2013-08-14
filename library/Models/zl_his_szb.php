<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tzl_his_szb extends dao_oracle{
	 public $__table = 'zl_his_szb';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(7)
	 **/
 	 public $shijian;
	 public $_shijian_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(20)
	 **/
 	 public $yasycqrmyy;
	 public $_yasycqrmyy_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $rmzl;
	 public $_rmzl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $rjzl;
	 public $_rjzl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $rzjl;
	 public $_rzjl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sstc;
	 public $_sstc_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $cyrs;
	 public $_cyrs_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $rjzyr;
	 public $_rjzyr_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zdfhl;
	 public $_zdfhl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jjyhl;
	 public $_jjyhl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mzljfy;
	 public $_mzljfy_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mzjcfybl;
	 public $_mzjcfybl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zyljfy;
	 public $_zyljfy_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zyjcfbl;
	 public $_zyjcfbl_type='number';
}
