<?php
require_once ('db_oracle.php');
/**
 *注释:门诊就诊记录表
 *
 *
 **/
class Ttb_yl_mz_medical_record extends dao_oracle{
	 public $__table = 'tb_yl_mz_medical_record';
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
 	 * 注释:患者姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $hzxm;
	 public $_hzxm_type='varchar2';
	/**
 	 * 注释:患者属性
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $hzsx;
	 public $_hzsx_type='varchar2';
	/**
 	 * 注释:就诊类型
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $jzlx;
	 public $_jzlx_type='varchar2';
	/**
 	 * 注释:就诊科室编码
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $jzksbm;
	 public $_jzksbm_type='varchar2';
	/**
 	 * 注释:就诊科室名称
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jzksmc;
	 public $_jzksmc_type='varchar2';
	/**
 	 * 注释:门诊就诊日期
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $jzksrq;
	 public $_jzksrq_type='varchar2';
	/**
 	 * 注释:主诊医生工号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $zzysgh;
	 public $_zzysgh_type='varchar2';
	/**
 	 * 注释:主诊医生姓名
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $zzysxm;
	 public $_zzysxm_type='varchar2';
	/**
 	 * 注释:门诊诊断编码（主要诊断)
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $jzzdbm;
	 public $_jzzdbm_type='varchar2';
	/**
 	 * 注释:门诊诊断名称（主要诊断）
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $jzzdmc;
	 public $_jzzdmc_type='varchar2';
	/**
 	 * 注释:编码类型
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $bmlx;
	 public $_bmlx_type='varchar2';
	/**
 	 * 注释:门诊诊断说明
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $jzzdsm;
	 public $_jzzdsm_type='varchar2';
	/**
 	 * 注释:主诉
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $zs;
	 public $_zs_type='varchar2';
	/**
 	 * 注释:症状描述
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $zzms;
	 public $_zzms_type='varchar2';
	/**
 	 * 注释:收缩压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ssy;
	 public $_ssy_type='number';
	/**
 	 * 注释:舒张压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $szy;
	 public $_szy_type='number';
	/**
 	 * 注释:体温(℃)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tw;
	 public $_tw_type='number';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
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
