<?php
require_once ('db_oracle.php');
/**
 *注释:细菌结果
 *
 *
 **/
class Ttb_lis_bacteria_result extends dao_oracle{
	 public $__table = 'lis_bacteria_result_v';
	/**
 	 * 注释:细菌结果流水号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $xjjglsh;
	 public $_xjjglsh_type='varchar2';
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
	 * @var CHAR(8)
	 **/
 	 public $bgrq;
	 public $_bgrq_type='char';
	/**
 	 * 注释:细菌代号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $xjdh;
	 public $_xjdh_type='varchar2';
	/**
 	 * 注释:细菌名称
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $xjmc;
	 public $_xjmc_type='varchar2';
	/**
 	 * 注释:菌落计数
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $jljs;
	 public $_jljs_type='varchar2';
	/**
 	 * 注释:培养基
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $byj;
	 public $_byj_type='varchar2';
	/**
 	 * 注释:培养时间
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $bysj;
	 public $_bysj_type='varchar2';
	/**
 	 * 注释:培养条件
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $pytj;
	 public $_pytj_type='varchar2';
	/**
 	 * 注释:发现方式
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $fxfs;
	 public $_fxfs_type='varchar2';
	/**
 	 * 注释:检测结果
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jcjg;
	 public $_jcjg_type='varchar2';
	/**
 	 * 注释:检测结果文字描述
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $jcjgwz;
	 public $_jcjgwz_type='varchar2';
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
