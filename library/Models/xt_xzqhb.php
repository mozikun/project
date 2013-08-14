<?php
require_once ('db_oracle.php');
/**
 *注释:行政区划表
 *
 *
 **/
class Txt_xzqhb extends dao_oracle{
	 public $__table = 'xt_xzqhb';
	/**
 	 * 注释:代码
	 * 
	 * 
	 * @var CHAR(6)
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
