<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ttb_jktj_jmjbqk extends dao_oracle{
	 public $__table = 'tb_jktj_jmjbqk';
	/**
 	 * 注释:体检ID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $tjid;
	 public $_tjid_type='varchar2';
	/**
 	 * 注释:体检机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:体检机构名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $tjjgmc;
	 public $_tjjgmc_type='varchar2';
	/**
 	 * 注释:个人标识符
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $hzgrdaid;
	 public $_hzgrdaid_type='varchar2';
	/**
 	 * 注释:标识符类型
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $bzflx;
	 public $_bzflx_type='varchar2';
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
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
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
 	 * 注释:身份证号
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $sfzh;
	 public $_sfzh_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $csrq;
	 public $_csrq_type='date';
	/**
 	 * 注释:文化程度代码
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $whcddm;
	 public $_whcddm_type='varchar2';
	/**
 	 * 注释:婚姻状况代码
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $hyzkdm;
	 public $_hyzkdm_type='varchar2';
	/**
 	 * 注释:本人电话
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $brdh;
	 public $_brdh_type='varchar2';
	/**
 	 * 注释:联系人姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $lxrxm;
	 public $_lxrxm_type='varchar2';
	/**
 	 * 注释:联系人电话
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $lxrdh;
	 public $_lxrdh_type='varchar2';
	/**
 	 * 注释:家庭住址
	 * 
	 * 
	 * @var VARCHAR2(120)
	 **/
 	 public $jtzz;
	 public $_jtzz_type='varchar2';
	/**
 	 * 注释:所在社区
	 * 
	 * 
	 * @var VARCHAR2(120)
	 **/
 	 public $szsq;
	 public $_szsq_type='varchar2';
	/**
 	 * 注释:所在居委
	 * 
	 * 
	 * @var VARCHAR2(120)
	 **/
 	 public $szjw;
	 public $_szjw_type='varchar2';
	/**
 	 * 注释:常住类型
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $czlx;
	 public $_czlx_type='char';
	/**
 	 * 注释:工作单位
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $gzdw;
	 public $_gzdw_type='varchar2';
	/**
 	 * 注释:体检日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $tjrq;
	 public $_tjrq_type='date';
	/**
 	 * 注释:血型
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xxbm;
	 public $_xxbm_type='char';
	/**
 	 * 注释:RH阴性
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $rhyx;
	 public $_rhyx_type='char';
	/**
 	 * 注释:过敏史
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $gms;
	 public $_gms_type='varchar2';
	/**
 	 * 注释:既往史
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $jws;
	 public $_jws_type='varchar2';
	/**
 	 * 注释:体育锻炼频率
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $tydlpl;
	 public $_tydlpl_type='char';
	/**
 	 * 注释:体育锻炼每次锻炼时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tydlmcdlsj;
	 public $_tydlmcdlsj_type='number';
	/**
 	 * 注释:坚持锻炼时间
	 * 
	 * 
	 * @var FLOAT(22)
	 **/
 	 public $jcdlsj;
	 public $_jcdlsj_type='float';
	/**
 	 * 注释:体育锻炼方式
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $tydlfs;
	 public $_tydlfs_type='varchar2';
	/**
 	 * 注释:饮食习惯
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ysxg;
	 public $_ysxg_type='char';
	/**
 	 * 注释:吸烟状况
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xyzk;
	 public $_xyzk_type='char';
	/**
 	 * 注释:平均日吸烟量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $pjrxyl;
	 public $_pjrxyl_type='number';
	/**
 	 * 注释:开始吸烟年龄
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $ksxynl;
	 public $_ksxynl_type='varchar2';
	/**
 	 * 注释:戒烟年龄
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $jynl;
	 public $_jynl_type='varchar2';
	/**
 	 * 注释:饮酒频率
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $yjpl;
	 public $_yjpl_type='char';
	/**
 	 * 注释:平均日饮酒量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $pjryjl;
	 public $_pjryjl_type='number';
	/**
 	 * 注释:是否戒酒
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sfjj;
	 public $_sfjj_type='char';
	/**
 	 * 注释:戒酒年龄
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $jjnl;
	 public $_jjnl_type='varchar2';
	/**
 	 * 注释:开始饮酒年龄
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $ksyjnl;
	 public $_ksyjnl_type='varchar2';
	/**
 	 * 注释:近一年内是否曾醉酒
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $jynnsfyj;
	 public $_jynnsfyj_type='char';
	/**
 	 * 注释:饮酒种类
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $yjzl;
	 public $_yjzl_type='varchar2';
	/**
 	 * 注释:职业暴露
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zybl;
	 public $_zybl_type='varchar2';
	/**
 	 * 注释:职业接触毒物-化学品
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zyjcdw_hxp;
	 public $_zyjcdw_hxp_type='varchar2';
	/**
 	 * 注释:职业接触毒物-化学品-防护措施
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zyjcdw_hxp_fhcs;
	 public $_zyjcdw_hxp_fhcs_type='varchar2';
	/**
 	 * 注释:职业接触毒物-毒物
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zyjcdw_dw;
	 public $_zyjcdw_dw_type='varchar2';
	/**
 	 * 注释:职业接触毒物-毒物-防护措施
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zyjcdw_dw_fhcs;
	 public $_zyjcdw_dw_fhcs_type='varchar2';
	/**
 	 * 注释:职业接触毒物-射线
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zyjcdw_sx;
	 public $_zyjcdw_sx_type='varchar2';
	/**
 	 * 注释:职业接触毒物-射线-防护措施
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zyjcdw_sx_fhcs;
	 public $_zyjcdw_sx_fhcs_type='varchar2';
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
}
