<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ttb_xz_bloodbag_info extends dao_oracle{
	 public $__table = 'tb_xz_bloodbag_info';
	/**
 	 * 注释:血袋编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $xdbh;
	 public $_xdbh_type='varchar2';
	/**
 	 * 注释:血站机构代码
	 * 
	 * 
	 * @var VARCHAR2(22)
	 **/
 	 public $xzjgdm;
	 public $_xzjgdm_type='varchar2';
	/**
 	 * 注释:血站名称
	 * 
	 * 
	 * @var VARCHAR2(70)
	 **/
 	 public $xzmc;
	 public $_xzmc_type='varchar2';
	/**
 	 * 注释:献血序列号
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $xxxlh;
	 public $_xxxlh_type='varchar2';
	/**
 	 * 注释:产品码
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $cpm;
	 public $_cpm_type='varchar2';
	/**
 	 * 注释:全称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $cc;
	 public $_cc_type='varchar2';
	/**
 	 * 注释:换算单位
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hsdw;
	 public $_hsdw_type='number';
	/**
 	 * 注释:单位
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $dw;
	 public $_dw_type='varchar2';
	/**
 	 * 注释:采血日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $cxrq;
	 public $_cxrq_type='date';
	/**
 	 * 注释:制备日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $zbrq;
	 public $_zbrq_type='date';
	/**
 	 * 注释:失效日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $sxrq;
	 public $_sxrq_type='date';
	/**
 	 * 注释:出库日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $ckrqsj;
	 public $_ckrqsj_type='date';
	/**
 	 * 注释:血袋最终归属
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xdzzgs;
	 public $_xdzzgs_type='char';
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
 	 public $yl1;
	 public $_yl1_type='varchar2';
	/**
 	 * 注释:预留二
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $yl2;
	 public $_yl2_type='varchar2';
}
