<?php
require_once ('db_oracle.php');
/**
 *注释:医学影像检查报告表
 *
 *
 **/
class Ttb_ris_report extends dao_oracle{
	 public $__table = 'ris_report_v';
	/**
 	 * 注释:检查号
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $studyuid;
	 public $_studyuid_type='varchar2';
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
	 * @var VARCHAR2(32)
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
 	 * 注释:病人姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $brxm;
	 public $_brxm_type='varchar2';
	/**
 	 * 注释:病人性别
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $brxb;
	 public $_brxb_type='char';
	/**
 	 * 注释:影像号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $patientid;
	 public $_patientid_type='varchar2';
	/**
 	 * 注释:检查项目代码
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jcxmdm;
	 public $_jcxmdm_type='varchar2';
	/**
 	 * 注释:申请单号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $sqdh;
	 public $_sqdh_type='varchar2';
	/**
 	 * 注释:开单时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $kdsj;
	 public $_kdsj_type='date';
	/**
 	 * 注释:检查时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jysj;
	 public $_jysj_type='date';
	/**
 	 * 注释:检查类型
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $examtype;
	 public $_examtype_type='varchar2';
	/**
 	 * 注释:检查设备仪器型号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $sbbm;
	 public $_sbbm_type='varchar2';
	/**
 	 * 注释:检查仪器号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $yqbm;
	 public $_yqbm_type='varchar2';
	/**
 	 * 注释:申请科室编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sqks;
	 public $_sqks_type='varchar2';
	/**
 	 * 注释:申请科室名称
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sqksmc;
	 public $_sqksmc_type='varchar2';
	/**
 	 * 注释:申请人工号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $sqrgh;
	 public $_sqrgh_type='varchar2';
	/**
 	 * 注释:申请人姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $sqrxm;
	 public $_sqrxm_type='varchar2';
	/**
 	 * 注释:检查科室编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jcks;
	 public $_jcks_type='varchar2';
	/**
 	 * 注释:检查科室名称
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jcksmc;
	 public $_jcksmc_type='varchar2';
	/**
 	 * 注释:检查医生姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jcys;
	 public $_jcys_type='varchar2';
	/**
 	 * 注释:检查医生工号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $jcysgh;
	 public $_jcysgh_type='varchar2';
	/**
 	 * 注释:报告日期
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $bgrq;
	 public $_bgrq_type='varchar2';
	/**
 	 * 注释:报告时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $bgsj;
	 public $_bgsj_type='date';
	/**
 	 * 注释:报告人工号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $bgrgh;
	 public $_bgrgh_type='varchar2';
	/**
 	 * 注释:报告人姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $bgrxm;
	 public $_bgrxm_type='varchar2';
	/**
 	 * 注释:审核人工号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $shrgh;
	 public $_shrgh_type='varchar2';
	/**
 	 * 注释:审核人姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $shrxm;
	 public $_shrxm_type='varchar2';
	/**
 	 * 注释:检查部位
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jcbw;
	 public $_jcbw_type='varchar2';
	/**
 	 * 注释:检查部位ACR编码
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $bwacr;
	 public $_bwacr_type='varchar2';
	/**
 	 * 注释:检查名称
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $jcmc;
	 public $_jcmc_type='varchar2';
	/**
 	 * 注释:阴阳性
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $yys;
	 public $_yys_type='char';
	/**
 	 * 注释:报告临床诊断
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $bglczd;
	 public $_bglczd_type='varchar2';
	/**
 	 * 注释:影像表现或检查所见
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $yxbx;
	 public $_yxbx_type='varchar2';
	/**
 	 * 注释:检查诊断或提示
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $yxzd;
	 public $_yxzd_type='varchar2';
	/**
 	 * 注释:备注或建议
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $bzhjy;
	 public $_bzhjy_type='varchar2';
	/**
 	 * 注释:是否有影像
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sfyyy;
	 public $_sfyyy_type='char';
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
