<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tjbgl_lnrsfgl_v extends dao_oracle{
	 public $__table = 'jbgl_lnrsfgl_v';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(52)
	 **/
 	 public $sfjlid;
	 public $_sfjlid_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $lnrid;
	 public $_lnrid_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $sfbh;
	 public $_sfbh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $sfrq;
	 public $_sfrq_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $sffsdm;
	 public $_sffsdm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zg;
	 public $_zg_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $sfyy;
	 public $_sfyy_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $zgqt;
	 public $_zgqt_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $zz;
	 public $_zz_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $xlztzd;
	 public $_xlztzd_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tz;
	 public $_tz_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $yl;
	 public $_yl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jynl;
	 public $_jynl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jyrq;
	 public $_jyrq_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jl;
	 public $_jl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jjrq;
	 public $_jjrq_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jjnl;
	 public $_jjnl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(256)
	 **/
 	 public $ydfssm;
	 public $_ydfssm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ydpllb;
	 public $_ydpllb_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ydsj;
	 public $_ydsj_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jcydsc;
	 public $_jcydsc_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zydcs;
	 public $_zydcs_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ysqk;
	 public $_ysqk_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xltz;
	 public $_xltz_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zyxw;
	 public $_zyxw_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $ymjzqk;
	 public $_ymjzqk_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $gxbyfqk;
	 public $_gxbyfqk_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $gzssyfqk;
	 public $_gzssyfqk_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $sfjy;
	 public $_sfjy_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $xcsfmb;
	 public $_xcsfmb_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $xcsfrq;
	 public $_xcsfrq_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $sfysxm;
	 public $_sfysxm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $sfysgh;
	 public $_sfysgh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl1;
	 public $_ylyl1_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl2;
	 public $_ylyl2_type='varchar2';
}
