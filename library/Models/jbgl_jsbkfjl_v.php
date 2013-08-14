<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tjbgl_jsbkfjl_v extends dao_oracle{
	 public $__table = 'jbgl_jsbkfjl_v';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
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
	 * @var VARCHAR2(30)
	 **/
 	 public $jsjbglkid;
	 public $_jsjbglkid_type='varchar2';
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
	 * @var VARCHAR2(30)
	 **/
 	 public $sfysxm;
	 public $_sfysxm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sfysgh;
	 public $_sfysgh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $qzjbmc;
	 public $_qzjbmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $mqzz;
	 public $_mqzz_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $zyzz;
	 public $_zyzz_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zlqkzlxs;
	 public $_zlqkzlxs_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zlqkfyqk;
	 public $_zlqkfyqk_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zlqkkfcs;
	 public $_zlqkkfcs_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zlqkkfcsqt;
	 public $_zlqkkfcsqt_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $dckssj;
	 public $_dckssj_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $dcjssj;
	 public $_dcjssj_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $effect1;
	 public $_effect1_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $effect2;
	 public $_effect2_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $effect3;
	 public $_effect3_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $effect4;
	 public $_effect4_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $effect5;
	 public $_effect5_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $effect6;
	 public $_effect6_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $gsjl;
	 public $_gsjl_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zyhgz;
	 public $_zyhgz_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $hyzn;
	 public $_hyzn_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $fmzn;
	 public $_fmzn_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $shxts;
	 public $_shxts_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $jtwdshhd;
	 public $_jtwdshhd_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $jtnhd;
	 public $_jtnhd_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $jtzn;
	 public $_jtzn_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $grshzl;
	 public $_grshzl_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $dwjxqhgx;
	 public $_dwjxqhgx_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zrxhjhx;
	 public $_zrxhjhx_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $sdsszf;
	 public $_sdsszf_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zzl;
	 public $_zzl_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $smqk;
	 public $_smqk_type='char';
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
 	 public $grshll;
	 public $_grshll_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $jwld;
	 public $_jwld_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $scldjgz;
	 public $_scldjgz_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xxnl;
	 public $_xxnl_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $shrjjw;
	 public $_shrjjw_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $qtjb;
	 public $_qtjb_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $sysjc;
	 public $_sysjc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $mqfyyw1;
	 public $_mqfyyw1_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mqfyywyf1;
	 public $_mqfyywyf1_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mqfyywmcjl1;
	 public $_mqfyywmcjl1_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $mqfyyw2;
	 public $_mqfyyw2_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mqfyywyf2;
	 public $_mqfyywyf2_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mqfyywmcjl2;
	 public $_mqfyywmcjl2_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $mqfyyw3;
	 public $_mqfyyw3_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mqfyywyf3;
	 public $_mqfyywyf3_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mqfyywmcjl3;
	 public $_mqfyywmcjl3_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ywblfybm;
	 public $_ywblfybm_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ywfzy;
	 public $_ywfzy_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zlxg;
	 public $_zlxg_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ccsffl;
	 public $_ccsffl_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $fyycx;
	 public $_fyycx_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $pgfl;
	 public $_pgfl_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sfzz;
	 public $_sfzz_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zzyy;
	 public $_zzyy_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $zzyljgmc;
	 public $_zzyljgmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $zlyj;
	 public $_zlyj_type='varchar2';
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
	 * @var DATE(7)
	 **/
 	 public $xcsfrq;
	 public $_xcsfrq_type='date';
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
 	 public $yly;
	 public $_yly_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $yle;
	 public $_yle_type='varchar2';
}
