<?php
require_once ('db_oracle.php');
/**
 *注释:住院就诊记录表
 *
 *
 **/
class Ttb_yl_zy_medical_record extends dao_oracle{
	 public $__table = 'tb_yl_zy_medical_record';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:住院就诊流水号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jzlsh;
	 public $_jzlsh_type='varchar2';
	/**
 	 * 注释:住院号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $cisid;
	 public $_cisid_type='varchar2';
	/**
 	 * 注释:卡号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $kh;
	 public $_kh_type='varchar2';
	/**
 	 * 注释:卡类型
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $klx;
	 public $_klx_type='varchar2';
	/**
 	 * 注释:患者姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $hzxm;
	 public $_hzxm_type='varchar2';
	/**
 	 * 注释:患者属性
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $hzsx;
	 public $_hzsx_type='varchar2';
	/**
 	 * 注释:就诊类型
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $jzlx;
	 public $_jzlx_type='varchar2';
	/**
 	 * 注释:入院科室编码
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $jzksbm;
	 public $_jzksbm_type='varchar2';
	/**
 	 * 注释:入院科室名称
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jzksmc;
	 public $_jzksmc_type='varchar2';
	/**
 	 * 注释:出院科室编码
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $cyksbm;
	 public $_cyksbm_type='varchar2';
	/**
 	 * 注释:出院科室名称
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $cyksmc;
	 public $_cyksmc_type='varchar2';
	/**
 	 * 注释:入院时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $rysj;
	 public $_rysj_type='date';
	/**
 	 * 注释:出院时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $cysj;
	 public $_cysj_type='date';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
	/**
 	 * 注释:密级
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
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
