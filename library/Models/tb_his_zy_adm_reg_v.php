<?php
require_once ('db_oracle.php');
/**
 *注释:入院登记表
 *
 *
 **/
class Ttb_his_zy_adm_reg extends dao_oracle{
	 public $__table = 'his_zy_adm_reg_v';
	/**
 	 * 注释:住院就诊流水号
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $zyid;
	 public $_zyid_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:入院科室
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $ryks;
	 public $_ryks_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $ksmc;
	 public $_ksmc_type='varchar2';
	/**
 	 * 注释:入院时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $rysj;
	 public $_rysj_type='date';
	/**
 	 * 注释:留观标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $lgbz;
	 public $_lgbz_type='char';
	/**
 	 * 注释:作废标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zfbz;
	 public $_zfbz_type='char';
	/**
 	 * 注释:预留一
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl1;
	 public $_ylyl1_type='varchar2';
	/**
 	 * 注释:预留二
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl2;
	 public $_ylyl2_type='varchar2';
}
