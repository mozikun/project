<?php
require_once ('db_oracle.php');
/**
 *注释:诊断明细表
 *
 *
 **/
class Ttb_ih_diagnosis_detail extends dao_oracle{
	 public $__table = 'tb_ih_diagnosis_detail';
	/**
 	 * 注释:诊断流水号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $zyzdlsh;
	 public $_zyzdlsh_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:就诊流水号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jzlsh;
	 public $_jzlsh_type='varchar2';
	/**
 	 * 注释:门诊/住院标志
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $mzzybz;
	 public $_mzzybz_type='varchar2';
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
 	 * 注释:诊断类型区分
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zdlxqf;
	 public $_zdlxqf_type='char';
	/**
 	 * 注释:诊断类别代码
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zdlb;
	 public $_zdlb_type='varchar2';
	/**
 	 * 注释:诊断时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $zdsj;
	 public $_zdsj_type='date';
	/**
 	 * 注释:诊断编码
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $zdbm;
	 public $_zdbm_type='varchar2';
	/**
 	 * 注释:诊断名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zdmc;
	 public $_zdmc_type='varchar2';
	/**
 	 * 注释:诊断编码类型
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $bmlx;
	 public $_bmlx_type='varchar2';
	/**
 	 * 注释:诊断说明
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $zdsm;
	 public $_zdsm_type='varchar2';
	/**
 	 * 注释:主要诊断标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $cyzdbz;
	 public $_cyzdbz_type='char';
	/**
 	 * 注释:疑似诊断标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $yzdbz;
	 public $_yzdbz_type='char';
	/**
 	 * 注释:出院情况编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $cyqkbm;
	 public $_cyqkbm_type='char';
	/**
 	 * 注释:密级
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
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
