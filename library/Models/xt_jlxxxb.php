<?php
require_once ('db_oracle.php');
/**
 *注释:街路巷信息表
 *
 *
 **/
class Txt_jlxxxb extends dao_oracle{
	 public $__table = 'xt_jlxxxb';
	/**
 	 * 注释:代码
	 * 
	 * 
	 * @var CHAR(12)
	 **/
 	 public $dm;
	 public $_dm_type='char';
	/**
 	 * 注释:名称
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $mc;
	 public $_mc_type='nvarchar2';
	/**
 	 * 注释:中文拼音
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $zwpy;
	 public $_zwpy_type='varchar2';
	/**
 	 * 注释:五笔拼音
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $wbpy;
	 public $_wbpy_type='varchar2';
	/**
 	 * 注释:区划代码
	 * 
	 * 
	 * @var CHAR(6)
	 **/
 	 public $qhdm;
	 public $_qhdm_type='char';
	/**
 	 * 注释:备注
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $bz;
	 public $_bz_type='nvarchar2';
	/**
 	 * 注释:启用标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $qybz;
	 public $_qybz_type='char';
	/**
 	 * 注释:变动类型
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $bdlx;
	 public $_bdlx_type='char';
	/**
 	 * 注释:变动时间
	 * 
	 * 
	 * @var CHAR(14)
	 **/
 	 public $bdsj;
	 public $_bdsj_type='char';
}
