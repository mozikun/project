<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class This_patinf_v extends dao_oracle{
	 public $__table = 'his_patinf_v';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $zjhm;
	 public $_zjhm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zjlx;
	 public $_zjlx_type='varchar2';
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
	 * @var VARCHAR2(50)
	 **/
 	 public $grdaid;
	 public $_grdaid_type='varchar2';
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
	 * @var DATE(7)
	 **/
 	 public $zjexsj;
	 public $_zjexsj_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $zjixsj;
	 public $_zjixsj_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(70)
	 **/
 	 public $fzjjgmc;
	 public $_fzjjgmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $xb;
	 public $_xb_type='varchar2';
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
	 * @var VARCHAR2(2)
	 **/
 	 public $hyzk;
	 public $_hyzk_type='varchar2';
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
	 * @var VARCHAR2(32)
	 **/
 	 public $csd;
	 public $_csd_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jg;
	 public $_jg_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $mz;
	 public $_mz_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $gj;
	 public $_gj_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $yydah;
	 public $_yydah_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sjhm;
	 public $_sjhm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $cjgzrq;
	 public $_cjgzrq_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $gzdwyb;
	 public $_gzdwyb_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $gzdwmc;
	 public $_gzdwmc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $gzdwdz;
	 public $_gzdwdz_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(24)
	 **/
 	 public $gzdwdh;
	 public $_gzdwdh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $zylb;
	 public $_zylb_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $jzd_xzqh;
	 public $_jzd_xzqh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jzd_she;
	 public $_jzd_she_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jzd_shi;
	 public $_jzd_shi_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jzd_xia;
	 public $_jzd_xia_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jzd_xng;
	 public $_jzd_xng_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jzd_cun;
	 public $_jzd_cun_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jzd_mph;
	 public $_jzd_mph_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $jtdz;
	 public $_jtdz_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(24)
	 **/
 	 public $jtdhhm;
	 public $_jtdhhm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $jtdzyb;
	 public $_jtdzyb_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $czdzhjbz;
	 public $_czdzhjbz_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hjd_xzqh;
	 public $_hjd_xzqh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $hjd_she;
	 public $_hjd_she_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $hjd_shi;
	 public $_hjd_shi_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $hjd_xia;
	 public $_hjd_xia_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $hjd_xng;
	 public $_hjd_xng_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $hjd_cun;
	 public $_hjd_cun_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $hjd_mph;
	 public $_hjd_mph_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $hkdz;
	 public $_hkdz_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hkdzyb;
	 public $_hkdzyb_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $email;
	 public $_email_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $lxrxm;
	 public $_lxrxm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $lxrgx;
	 public $_lxrgx_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $lxrdz;
	 public $_lxrdz_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $lxryb;
	 public $_lxryb_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(24)
	 **/
 	 public $lxrdh;
	 public $_lxrdh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='varchar2';
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
	 * @var DATE(7)
	 **/
 	 public $tbrq;
	 public $_tbrq_type='date';
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
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $identity_number;
	 public $_identity_number_type='varchar2';
}
