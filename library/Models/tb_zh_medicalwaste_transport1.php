<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ttb_zh_medicalwaste_transport1 extends dao_oracle{
	 public $__table = 'tb_zh_medicalwaste_transport1';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(22)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ylfwczdw;
	 public $_ylfwczdw_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $zyrq;
	 public $_zyrq_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $grxfwtj;
	 public $_grxfwtj_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $grxfwzl;
	 public $_grxfwzl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ssxfwtj;
	 public $_ssxfwtj_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ssxfwzl;
	 public $_ssxfwzl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $yljgjjry;
	 public $_yljgjjry_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $fwysry;
	 public $_fwysry_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jjsj;
	 public $_jjsj_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $tbrq;
	 public $_tbrq_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $bz;
	 public $_bz_type='varchar2';
}
