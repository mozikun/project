<?php
require_once ('db_oracle.php');
/**
 *注释:出院登记表
 *
 *
 **/
class Ttb_his_zy_dis_reg extends dao_oracle{
	 public $__table = 'his_zy_dis_reg_v';
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
 	 * 注释:入院科室名称
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $ryksmc;
	 public $_ryksmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $rysj;
	 public $_rysj_type='date';
	/**
 	 * 注释:出院科室
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $cyks;
	 public $_cyks_type='varchar2';
	/**
 	 * 注释:出院科室名称
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $cyksmc;
	 public $_cyksmc_type='varchar2';
	/**
 	 * 注释:出院时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $cysj;
	 public $_cysj_type='date';
	/**
 	 * 注释:留观标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $lgbz;
	 public $_lgbz_type='char';
	/**
 	 * 注释:保险类型
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bxlx;
	 public $_bxlx_type='varchar2';
	/**
 	 * 注释:外地标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $wdbz;
	 public $_wdbz_type='char';
	/**
 	 * 注释:特需标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $txbz;
	 public $_txbz_type='char';
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
