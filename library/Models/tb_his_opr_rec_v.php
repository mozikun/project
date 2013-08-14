<?php
require_once ('db_oracle.php');
/**
 *注释:手术记录表
 *
 *
 **/
class Ttb_his_opr_rec extends dao_oracle{
	 public $__table = 'his_opr_rec_v';
	/**
 	 * 注释:手术ID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ssid;
	 public $_ssid_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:申请人员工号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $sqrygh;
	 public $_sqrygh_type='varchar2';
	/**
 	 * 注释:申请人员姓名
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $sqryxm;
	 public $_sqryxm_type='varchar2';
	/**
 	 * 注释:登记人员工号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $djrygh;
	 public $_djrygh_type='varchar2';
	/**
 	 * 注释:登记人员姓名
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $djryxm;
	 public $_djryxm_type='varchar2';
	/**
 	 * 注释:申请科室代码
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $sqksdm;
	 public $_sqksdm_type='varchar2';
	/**
 	 * 注释:申请科室名称
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $sqksmc;
	 public $_sqksmc_type='varchar2';
	/**
 	 * 注释:手术科室
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $ssks;
	 public $_ssks_type='varchar2';
	/**
 	 * 注释:手术科室名称
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $ssksmc;
	 public $_ssksmc_type='varchar2';
	/**
 	 * 注释:申请医生工号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $sqysgh;
	 public $_sqysgh_type='varchar2';
	/**
 	 * 注释:申请医生姓名
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $sqysxm;
	 public $_sqysxm_type='varchar2';
	/**
 	 * 注释:手术医生工号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $ssysgh;
	 public $_ssysgh_type='varchar2';
	/**
 	 * 注释:手术医生姓名
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $ssysxm;
	 public $_ssysxm_type='varchar2';
	/**
 	 * 注释:手术内容
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $ssnr;
	 public $_ssnr_type='varchar2';
	/**
 	 * 注释:手术申请日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $sssqrq;
	 public $_sssqrq_type='date';
	/**
 	 * 注释:手术日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $ssrq;
	 public $_ssrq_type='date';
	/**
 	 * 注释:门诊手术标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $mzssbz;
	 public $_mzssbz_type='char';
	/**
 	 * 注释:日间手术标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $rjssbz;
	 public $_rjssbz_type='char';
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
