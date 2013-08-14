<?php
require_once ('db_oracle.php');
/**
 *注释:体检明细表
 *
 *
 **/
class Ttb_yl_tjmx extends dao_oracle{
	 public $__table = 'yl_tjmx_v';
	/**
 	 * 注释:项目明细ID
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $xmmxid;
	 public $_xmmxid_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(22)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
	/**
 	 * 注释:报告流水号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bglsh;
	 public $_bglsh_type='varchar2';
	/**
 	 * 注释:项目代码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $xmdm;
	 public $_xmdm_type='varchar2';
	/**
 	 * 注释:项目名称
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $xmmc;
	 public $_xmmc_type='varchar2';
	/**
 	 * 注释:项目检查结果
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $xmjcjg;
	 public $_xmjcjg_type='varchar2';
	/**
 	 * 注释:检查异常标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $jcycbz;
	 public $_jcycbz_type='char';
}
