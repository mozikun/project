<?php
require_once ('db_oracle.php');
/**
 *注释:2.6.2 心脑血管社区A2、A3核实表
 *
 *
 **/
class Ttb_jbgl_xlxgsqa2a3hs extends dao_oracle{
	 public $__table = 'tb_jbgl_xlxgsqa2a3hs';
	/**
 	 * 注释:报告卡编号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $bgkbh;
	 public $_bgkbh_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:首次发病日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $scfbrq;
	 public $_scfbrq_type='date';
	/**
 	 * 注释:首次发病或死亡诱因
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $scfahswyy;
	 public $_scfahswyy_type='varchar2';
	/**
 	 * 注释:首次发病或死亡诱因其他
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $scfahswyyqt;
	 public $_scfahswyyqt_type='varchar2';
	/**
 	 * 注释:资料来源
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zlly;
	 public $_zlly_type='varchar2';
	/**
 	 * 注释:资料来源其他
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $zllyqt;
	 public $_zllyqt_type='varchar2';
	/**
 	 * 注释:有无高血压
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ywgxy;
	 public $_ywgxy_type='char';
	/**
 	 * 注释:有无糖尿病
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ywtnb;
	 public $_ywtnb_type='char';
	/**
 	 * 注释:有无高脂血症
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ywgzxz;
	 public $_ywgzxz_type='char';
	/**
 	 * 注释:有无冠心病
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ywgxb;
	 public $_ywgxb_type='char';
	/**
 	 * 注释:有无其他心脏病
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ywqtxzb;
	 public $_ywqtxzb_type='char';
	/**
 	 * 注释:其他心脏病名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $qtxzbmc;
	 public $_qtxzbmc_type='varchar2';
	/**
 	 * 注释:有无吸烟
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ywxy;
	 public $_ywxy_type='char';
	/**
 	 * 注释:有无肥胖或超重
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ywfphcz;
	 public $_ywfphcz_type='char';
	/**
 	 * 注释:有无过量饮酒
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ywglyj;
	 public $_ywglyj_type='char';
	/**
 	 * 注释:有无家族史
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ywjzs;
	 public $_ywjzs_type='char';
	/**
 	 * 注释:行为其他
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $xwqt;
	 public $_xwqt_type='varchar2';
	/**
 	 * 注释:调查人
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dcr;
	 public $_dcr_type='varchar2';
	/**
 	 * 注释:调查单位
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $dcdw;
	 public $_dcdw_type='varchar2';
	/**
 	 * 注释:发病调查日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $fbdcrq;
	 public $_fbdcrq_type='date';
	/**
 	 * 注释:死亡调查日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $swdcrq;
	 public $_swdcrq_type='date';
	/**
 	 * 注释:卒中史_脑梗死
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zzngs;
	 public $_zzngs_type='char';
	/**
 	 * 注释:卒中史_脑出血
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zzncx;
	 public $_zzncx_type='char';
	/**
 	 * 注释:卒中史_蛛网膜下腔出血
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zzzwmxqcx;
	 public $_zzzwmxqcx_type='char';
	/**
 	 * 注释:卒中史_未分类
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zzwfx;
	 public $_zzwfx_type='char';
	/**
 	 * 注释:死亡地点
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $swdd;
	 public $_swdd_type='varchar2';
	/**
 	 * 注释:死亡地点其他
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $swddqt;
	 public $_swddqt_type='varchar2';
	/**
 	 * 注释:主要死因
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zysy;
	 public $_zysy_type='varchar2';
	/**
 	 * 注释:主要死因其他
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $zysyqt;
	 public $_zysyqt_type='varchar2';
	/**
 	 * 注释:前次心肌梗死
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $qcxjgs;
	 public $_qcxjgs_type='varchar2';
	/**
 	 * 注释:发作后存活时间小时
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $fzhchsjxs;
	 public $_fzhchsjxs_type='number';
	/**
 	 * 注释:发作后存活时间分钟
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $fzhchsjfz;
	 public $_fzhchsjfz_type='varchar2';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
	/**
 	 * 注释:上传时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $scsj;
	 public $_scsj_type='date';
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
