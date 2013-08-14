<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tjbgl_lnrzx_v extends dao_oracle{
	 public $__table = 'jbgl_lnrzx_v';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $lnrid;
	 public $_lnrid_type='varchar2';
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
	 * @var VARCHAR2(50)
	 **/
 	 public $jkdabzf;
	 public $_jkdabzf_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $bzflx;
	 public $_bzflx_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(64)
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
	 * @var VARCHAR2(18)
	 **/
 	 public $sfzjhm;
	 public $_sfzjhm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sfzjlbdm;
	 public $_sfzjlbdm_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $xm;
	 public $_xm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xbdm;
	 public $_xbdm_type='char';
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
	 * @var DATE(7)
	 **/
 	 public $qmrq;
	 public $_qmrq_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $rcshpjnr;
	 public $_rcshpjnr_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $rcshnlpj;
	 public $_rcshnlpj_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ksxynl;
	 public $_ksxynl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ksyjnl;
	 public $_ksyjnl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $rxyl;
	 public $_rxyl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ryjl;
	 public $_ryjl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $shnlpjbm;
	 public $_shnlpjbm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $shnlpjmc;
	 public $_shnlpjmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $shsyfsbm;
	 public $_shsyfsbm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $shsyfsmc;
	 public $_shsyfsmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $slzsqkbm;
	 public $_slzsqkbm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $slzsqkmc;
	 public $_slzsqkmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $xczyjkwt;
	 public $_xczyjkwt_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xlztdm;
	 public $_xlztdm_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $yccqbm;
	 public $_yccqbm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $yccqmc;
	 public $_yccqmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $czdzlbdm;
	 public $_czdzlbdm_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzszzqzxs;
	 public $_dzszzqzxs_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzsdq;
	 public $_dzsdq_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzxq;
	 public $_dzxq_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzxzjdbsc;
	 public $_dzxzjdbsc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzcjln;
	 public $_dzcjln_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzmphm;
	 public $_dzmphm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $dcrq;
	 public $_dcrq_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $dczgh;
	 public $_dczgh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $dczxm;
	 public $_dczxm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $fhcsbz;
	 public $_fhcsbz_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $hlzgbm;
	 public $_hlzgbm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $hlzgmc;
	 public $_hlzgmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $jckjbbm;
	 public $_jckjbbm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sffxfkjb;
	 public $_sffxfkjb_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $fxfkjbmc;
	 public $_fxfkjbmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $jlnnfkjc;
	 public $_jlnnfkjc_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $fkzzqkbm;
	 public $_fkzzqkbm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $fkzzqkmc;
	 public $_fkzzqkmc_type='varchar2';
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
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $yl1;
	 public $_yl1_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $yl2;
	 public $_yl2_type='varchar2';
}
