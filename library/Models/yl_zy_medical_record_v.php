<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tyl_zy_medical_record_v extends dao_oracle{
	 public $__table = 'yl_zy_medical_record_v';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jzlsh;
	 public $_jzlsh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $cisid;
	 public $_cisid_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $kh;
	 public $_kh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $klx;
	 public $_klx_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $hzxm;
	 public $_hzxm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $hzsx;
	 public $_hzsx_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $jzlx;
	 public $_jzlx_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $jzksbm;
	 public $_jzksbm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jzksmc;
	 public $_jzksmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $cyksbm;
	 public $_cyksbm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $cyksmc;
	 public $_cyksmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $rysj;
	 public $_rysj_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $cysj;
	 public $_cysj_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl1;
	 public $_ylyl1_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl2;
	 public $_ylyl2_type='varchar2';
}
