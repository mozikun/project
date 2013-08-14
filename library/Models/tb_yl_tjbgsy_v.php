<?php
require_once ('db_oracle.php');
/**
 *注释:体检报告首页
 *
 *
 **/
class Ttb_yl_tjbgsy extends dao_oracle{
	 public $__table = 'yl_tjbgsy_v';
	/**
 	 * 注释:体检编号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $tjbh;
	 public $_tjbh_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(22)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:体检类别代码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $tjlbdm;
	 public $_tjlbdm_type='char';
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
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $xm;
	 public $_xm_type='varchar2';
	/**
 	 * 注释:性别
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xb;
	 public $_xb_type='char';
	/**
 	 * 注释:年龄
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $nl;
	 public $_nl_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $csrq;
	 public $_csrq_type='date';
	/**
 	 * 注释:婚姻状况
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $hyzk;
	 public $_hyzk_type='char';
	/**
 	 * 注释:职业名称
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zymc;
	 public $_zymc_type='varchar2';
	/**
 	 * 注释:职业类别代码
	 * 
	 * 
	 * @var CHAR(3)
	 **/
 	 public $zylbdm;
	 public $_zylbdm_type='char';
	/**
 	 * 注释:生活习惯-工作运动
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $shxg_gzyd;
	 public $_shxg_gzyd_type='varchar2';
	/**
 	 * 注释:生活习惯-睡眠
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $shxg_sm;
	 public $_shxg_sm_type='varchar2';
	/**
 	 * 注释:生活习惯-饮食情况
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $shxg_ysqk;
	 public $_shxg_ysqk_type='varchar2';
	/**
 	 * 注释:生活习惯-其它
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $shxg_j;
	 public $_shxg_j_type='varchar2';
	/**
 	 * 注释:曾患何种疾病
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $chhzjb;
	 public $_chhzjb_type='varchar2';
	/**
 	 * 注释:曾做过何种手术
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $czghzss;
	 public $_czghzss_type='varchar2';
	/**
 	 * 注释:外伤史
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $wss;
	 public $_wss_type='varchar2';
	/**
 	 * 注释:精神创伤史
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $jscs;
	 public $_jscs_type='varchar2';
	/**
 	 * 注释:女士月经初潮
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $nsyjscc;
	 public $_nsyjscc_type='varchar2';
	/**
 	 * 注释:女士月经周期
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $nsyjszq;
	 public $_nsyjszq_type='varchar2';
	/**
 	 * 注释:女士月经史-白带
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $nsyjs_bd;
	 public $_nsyjs_bd_type='varchar2';
	/**
 	 * 注释:女士月经史-绝经
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $nsyjs_jj;
	 public $_nsyjs_jj_type='varchar2';
	/**
 	 * 注释:女士月经史-流产
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $nsyjs_lc;
	 public $_nsyjs_lc_type='varchar2';
	/**
 	 * 注释:生产史
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $scs;
	 public $_scs_type='varchar2';
	/**
 	 * 注释:家庭史
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $jts;
	 public $_jts_type='varchar2';
	/**
 	 * 注释:过敏史
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $gms;
	 public $_gms_type='varchar2';
	/**
 	 * 注释:总检结果
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $zjjg;
	 public $_zjjg_type='varchar2';
	/**
 	 * 注释:建议
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $jy;
	 public $_jy_type='varchar2';
	/**
 	 * 注释:总检日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $zjrq;
	 public $_zjrq_type='date';
	/**
 	 * 注释:总检医生工号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $zjysgh;
	 public $_zjysgh_type='varchar2';
	/**
 	 * 注释:总检医生姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $zjys;
	 public $_zjys_type='varchar2';
	/**
 	 * 注释:密级
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
}
