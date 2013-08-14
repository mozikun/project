<?php
require_once ('db_oracle.php');
/**
 *注释:床位使用表
 *
 *
 **/
class Ttb_yw_cwsyl extends dao_oracle{
	 public $__table = 'yw_cwsyl_v';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:科室编码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $ksbm;
	 public $_ksbm_type='varchar2';
	/**
 	 * 注释:业务时间
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $ywsj;
	 public $_ywsj_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $ksmc;
	 public $_ksmc_type='varchar2';
	/**
 	 * 注释:编制床位数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $edcw;
	 public $_edcw_type='number';
	/**
 	 * 注释:每日实际床位数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sjcws;
	 public $_sjcws_type='number';
	/**
 	 * 注释:每日实际开放床位数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sjkfcws;
	 public $_sjkfcws_type='number';
	/**
 	 * 注释:每日实际使用床位数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sycw;
	 public $_sycw_type='number';
	/**
 	 * 注释:今日入院
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jrry;
	 public $_jrry_type='number';
	/**
 	 * 注释:今日出院
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jrcy;
	 public $_jrcy_type='number';
	/**
 	 * 注释:今日转入
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jrzr;
	 public $_jrzr_type='number';
	/**
 	 * 注释:今日转出
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jrzc;
	 public $_jrzc_type='number';
	/**
 	 * 注释:今日病重
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jrbz;
	 public $_jrbz_type='number';
	/**
 	 * 注释:今日病危
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jrbw;
	 public $_jrbw_type='number';
	/**
 	 * 注释:今日死亡
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jrsw;
	 public $_jrsw_type='number';
	/**
 	 * 注释:住院人数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zyrs;
	 public $_zyrs_type='number';
	/**
 	 * 注释:填报日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $tbrq;
	 public $_tbrq_type='date';
}
