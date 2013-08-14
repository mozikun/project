<?php
require_once ('db_oracle.php');
/**
 *注释:检验结果指标表
 *
 *
 **/
class Ttb_lis_indicators extends dao_oracle{
	 public $__table = 'lis_indicators_v';
	/**
 	 * 注释:检验指标流水号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $jyzblsh;
	 public $_jyzblsh_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:检验报告单号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $bgdh;
	 public $_bgdh_type='varchar2';
	/**
 	 * 注释:报告日期
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $bgrq;
	 public $_bgrq_type='varchar2';
	/**
 	 * 注释:检测人工号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $jcrgh;
	 public $_jcrgh_type='varchar2';
	/**
 	 * 注释:检测人姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jcrxm;
	 public $_jcrxm_type='varchar2';
	/**
 	 * 注释:审核人工号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $shrgh;
	 public $_shrgh_type='varchar2';
	/**
 	 * 注释:审核人姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $shrxm;
	 public $_shrxm_type='varchar2';
	/**
 	 * 注释:检测收费代码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ybsfdm;
	 public $_ybsfdm_type='varchar2';
	/**
 	 * 注释:检测指标代码
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jczbdm;
	 public $_jczbdm_type='varchar2';
	/**
 	 * 注释:检测方法
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jcff;
	 public $_jcff_type='varchar2';
	/**
 	 * 注释:检测指标名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jczbmc;
	 public $_jczbmc_type='varchar2';
	/**
 	 * 注释:检测指标结果
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $jczbjg;
	 public $_jczbjg_type='varchar2';
	/**
 	 * 注释:LOINC编码
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $loinc;
	 public $_loinc_type='varchar2';
	/**
 	 * 注释:设备编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sbbm;
	 public $_sbbm_type='varchar2';
	/**
 	 * 注释:仪器编号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $yqbh;
	 public $_yqbh_type='varchar2';
	/**
 	 * 注释:仪器名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $yqmc;
	 public $_yqmc_type='varchar2';
	/**
 	 * 注释:参考值范围
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ckz;
	 public $_ckz_type='varchar2';
	/**
 	 * 注释:计量单位
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jldw;
	 public $_jldw_type='varchar2';
	/**
 	 * 注释:异常提示
	 * 
	 * 
	 * @var CHAR(2)
	 **/
 	 public $ycts;
	 public $_ycts_type='char';
	/**
 	 * 注释:相关医嘱ID或处方项目明细编号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $yzid;
	 public $_yzid_type='varchar2';
	/**
 	 * 注释:打印序号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $dyxh;
	 public $_dyxh_type='number';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='varchar2';
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
