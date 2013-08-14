<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tyl_tjbgsy_v extends dao_oracle{
	 public $__table = 'yl_tjbgsy_v';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $tjbh;
	 public $_tjbh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(22)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $tjlbdm;
	 public $_tjlbdm_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $kh;
	 public $_kh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $klx;
	 public $_klx_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $xm;
	 public $_xm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xb;
	 public $_xb_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $nl;
	 public $_nl_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $csrq;
	 public $_csrq_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $hyzk;
	 public $_hyzk_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zymc;
	 public $_zymc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(3)
	 **/
 	 public $zylbdm;
	 public $_zylbdm_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $shxg_gzyd;
	 public $_shxg_gzyd_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $shxg_sm;
	 public $_shxg_sm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $shxg_ysqk;
	 public $_shxg_ysqk_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $shxg_j;
	 public $_shxg_j_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $chhzjb;
	 public $_chhzjb_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $czghzss;
	 public $_czghzss_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $wss;
	 public $_wss_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $jscs;
	 public $_jscs_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $nsyjscc;
	 public $_nsyjscc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $nsyjszq;
	 public $_nsyjszq_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $nsyjs_bd;
	 public $_nsyjs_bd_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $nsyjs_jj;
	 public $_nsyjs_jj_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $nsyjs_lc;
	 public $_nsyjs_lc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $scs;
	 public $_scs_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $jts;
	 public $_jts_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $gms;
	 public $_gms_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $zjjg;
	 public $_zjjg_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $jy;
	 public $_jy_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $zjrq;
	 public $_zjrq_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $zjysgh;
	 public $_zjysgh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $zjys;
	 public $_zjys_type='varchar2';
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
}
