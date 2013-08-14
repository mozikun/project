<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Txz_used_blood_detail_v extends dao_oracle{
	 public $__table = 'xz_used_blood_detail_v';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
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
	 * @var VARCHAR2(30)
	 **/
 	 public $xdbh;
	 public $_xdbh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(22)
	 **/
 	 public $jgdm;
	 public $_jgdm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jszxm;
	 public $_jszxm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $jszxb;
	 public $_jszxb_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(2)
	 **/
 	 public $jszzj_lbdm;
	 public $_jszzj_lbdm_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $jszzj_hm;
	 public $_jszzj_hm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jzlsh;
	 public $_jzlsh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jfsj;
	 public $_jfsj_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $ffsj;
	 public $_ffsj_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $yxl;
	 public $_yxl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $yxjldw;
	 public $_yxjldw_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(70)
	 **/
 	 public $yxjgmc;
	 public $_yxjgmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $tbrq;
	 public $_tbrq_type='date';
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
