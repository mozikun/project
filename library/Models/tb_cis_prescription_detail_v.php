<?php
require_once ('db_oracle.php');
/**
 *注释:门诊处方明细表
 *
 *
 **/
class Ttb_cis_prescription_detail extends dao_oracle{
	 public $__table = 'cis_prescription_detail_v';
	/**
 	 * 注释:处方号码
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $cyh;
	 public $_cyh_type='varchar2';
	/**
 	 * 注释:处方项目明细号码
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $cfmxh;
	 public $_cfmxh_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:门诊就诊流水号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jzlsh;
	 public $_jzlsh_type='varchar2';
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
 	 * 注释:就诊科室代码
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $jzksdm;
	 public $_jzksdm_type='varchar2';
	/**
 	 * 注释:就诊科室名称
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $jzksmc;
	 public $_jzksmc_type='varchar2';
	/**
 	 * 注释:开方医生工号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $kfys;
	 public $_kfys_type='varchar2';
	/**
 	 * 注释:开方医生姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $kfysxm;
	 public $_kfysxm_type='varchar2';
	/**
 	 * 注释:开方时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $kfrq;
	 public $_kfrq_type='date';
	/**
 	 * 注释:项目编码
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $xmbm;
	 public $_xmbm_type='varchar2';
	/**
 	 * 注释:项目名称
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $xmmc;
	 public $_xmmc_type='varchar2';
	/**
 	 * 注释:项目分类编码
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $xmflbm;
	 public $_xmflbm_type='varchar2';
	/**
 	 * 注释:项目分类名称
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $xmflmc;
	 public $_xmflmc_type='varchar2';
	/**
 	 * 注释:是否药品
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $cflx;
	 public $_cflx_type='varchar2';
	/**
 	 * 注释:剂型代码
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $jxdm;
	 public $_jxdm_type='varchar2';
	/**
 	 * 注释:药品规格
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $ypgg;
	 public $_ypgg_type='varchar2';
	/**
 	 * 注释:发药数量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ypsl;
	 public $_ypsl_type='number';
	/**
 	 * 注释:发药数量单位
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $ypdw;
	 public $_ypdw_type='varchar2';
	/**
 	 * 注释:处方贴数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $cfts;
	 public $_cfts_type='number';
	/**
 	 * 注释:医嘱组号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $yzzh;
	 public $_yzzh_type='varchar2';
	/**
 	 * 注释:用药频次
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $sypc;
	 public $_sypc_type='varchar2';
	/**
 	 * 注释:每次使用剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jl;
	 public $_jl_type='number';
	/**
 	 * 注释:每次使用剂量单位
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $dw;
	 public $_dw_type='varchar2';
	/**
 	 * 注释:每次使用数量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mcsl;
	 public $_mcsl_type='number';
	/**
 	 * 注释:每次使用数量单位
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $mcdw;
	 public $_mcdw_type='varchar2';
	/**
 	 * 注释:用药途径代码
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $yf;
	 public $_yf_type='varchar2';
	/**
 	 * 注释:用药天数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $yyts;
	 public $_yyts_type='number';
	/**
 	 * 注释:中药煎煮法代码
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $jydm;
	 public $_jydm_type='varchar2';
	/**
 	 * 注释:皮试判别
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $sfps;
	 public $_sfps_type='varchar2';
	/**
 	 * 注释:检查部位
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jcbw;
	 public $_jcbw_type='varchar2';
	/**
 	 * 注释:备注信息
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $bz;
	 public $_bz_type='varchar2';
	/**
 	 * 注释:密级
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
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
