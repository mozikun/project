<?php
require_once ('db_oracle.php');
/**
 *注释:住院收费明细表
 *
 *
 **/
class Ttb_his_zy_fee_detail extends dao_oracle{
	 public $__table = 'his_zy_fee_detail_v';
	/**
 	 * 注释:_医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:收费明细ID
	 * 
	 * 
	 * @var VARCHAR2(36)
	 **/
 	 public $sfmxid;
	 public $_sfmxid_type='varchar2';
	/**
 	 * 注释:退费标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
	/**
 	 * 注释:住院就诊流水号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jzlsh;
	 public $_jzlsh_type='varchar2';
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
 	 * 注释:相关医嘱ID
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $yzid;
	 public $_yzid_type='varchar2';
	/**
 	 * 注释:发票号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $fph;
	 public $_fph_type='varchar2';
	/**
 	 * 注释:明细费用类别
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $mxfylb;
	 public $_mxfylb_type='varchar2';
	/**
 	 * 注释:收费/退费时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $stfsj;
	 public $_stfsj_type='date';
	/**
 	 * 注释:明细项目编码
	 * 
	 * 
	 * @var VARCHAR2(36)
	 **/
 	 public $mxxmbm;
	 public $_mxxmbm_type='varchar2';
	/**
 	 * 注释:明细项目名称
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $mxxmmc;
	 public $_mxxmmc_type='varchar2';
	/**
 	 * 注释:项目分类编码
	 * 
	 * 
	 * @var VARCHAR2(36)
	 **/
 	 public $xmflbm;
	 public $_xmflbm_type='varchar2';
	/**
 	 * 注释:项目分类名称
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $xmflmc;
	 public $_xmflmc_type='varchar2';
	/**
 	 * 注释:明细项目单位
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $mxxmdw;
	 public $_mxxmdw_type='varchar2';
	/**
 	 * 注释:明细项目单价
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mxxmdj;
	 public $_mxxmdj_type='number';
	/**
 	 * 注释:明细项目数量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mxxmsl;
	 public $_mxxmsl_type='number';
	/**
 	 * 注释:明细项目金额
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mxxmje;
	 public $_mxxmje_type='number';
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
