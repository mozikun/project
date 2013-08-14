<?php
require_once ('db_oracle.php');
/**
 *注释:实验室检验报告表头
 *
 *
 **/
class Ttb_lis_report extends dao_oracle{
	 public $__table = 'lis_report_v';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:检验报告单号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $bgdh;
	 public $_bgdh_type='varchar2';
	/**
 	 * 注释:报告日期
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $bgrq;
	 public $_bgrq_type='varchar2';
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
 	 * 注释:性别
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $brxb;
	 public $_brxb_type='char';
	/**
 	 * 注释:年龄
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $brnl;
	 public $_brnl_type='varchar2';
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
 	 * 注释:病区
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bq;
	 public $_bq_type='varchar2';
	/**
 	 * 注释:床号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ch;
	 public $_ch_type='varchar2';
	/**
 	 * 注释:打印日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $dyrq;
	 public $_dyrq_type='date';
	/**
 	 * 注释:申请日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $sqrq;
	 public $_sqrq_type='date';
	/**
 	 * 注释:采集日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $cjrq;
	 public $_cjrq_type='date';
	/**
 	 * 注释:检验日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jyrq;
	 public $_jyrq_type='date';
	/**
 	 * 注释:报告备注
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $bgbz;
	 public $_bgbz_type='varchar2';
	/**
 	 * 注释:标本代码
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $bbdm;
	 public $_bbdm_type='varchar2';
	/**
 	 * 注释:标本名称
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $bbmc;
	 public $_bbmc_type='varchar2';
	/**
 	 * 注释:报告单类别编码
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $bgdlbbm;
	 public $_bgdlbbm_type='varchar2';
	/**
 	 * 注释:报告单类别名称
	 * 
	 * 
	 * @var VARCHAR2(256)
	 **/
 	 public $bgdlb;
	 public $_bgdlb_type='varchar2';
	/**
 	 * 注释:密级
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
	/**
 	 * 注释:文件链接
	 * 
	 * 
	 * @var VARCHAR2(256)
	 **/
 	 public $wjlj;
	 public $_wjlj_type='varchar2';
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
