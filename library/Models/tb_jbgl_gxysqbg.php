<?php
require_once ('db_oracle.php');
/**
 *注释:高血压社区管理卡表
 *
 *
 **/
class Ttb_jbgl_gxysqbg extends dao_oracle{
	 public $__table = 'tb_jbgl_gxysqbg';
	/**
 	 * 注释:高血压管理卡ID
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $cid;
	 public $_cid_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:个人标识符
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $jkdabz;
	 public $_jkdabz_type='varchar2';
	/**
 	 * 注释:标识符类型
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $bzflx;
	 public $_bzflx_type='varchar2';
	/**
 	 * 注释:病案号
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $bah;
	 public $_bah_type='varchar2';
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
 	 * 注释:证件号码
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $zjhm;
	 public $_zjhm_type='varchar2';
	/**
 	 * 注释:证件类型
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zjlx;
	 public $_zjlx_type='varchar2';
	/**
 	 * 注释:管理组别编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $glzbbm;
	 public $_glzbbm_type='char';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzszz;
	 public $_dzszz_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzsq;
	 public $_dzsq_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzxq;
	 public $_dzxq_type='varchar2';
	/**
 	 * 注释:地址-乡（镇、街道办事处）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzxzj;
	 public $_dzxzj_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzcjln;
	 public $_dzcjln_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzmphm;
	 public $_dzmphm_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $yzbm;
	 public $_yzbm_type='varchar2';
	/**
 	 * 注释:建卡日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jkrq;
	 public $_jkrq_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $jctj;
	 public $_jctj_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $xm;
	 public $_xm_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $xbdm;
	 public $_xbdm_type='varchar2';
	/**
 	 * 注释:经常就诊地方
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $jcjzdf;
	 public $_jcjzdf_type='varchar2';
	/**
 	 * 注释:家族史
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $jzs;
	 public $_jzs_type='varchar2';
	/**
 	 * 注释:生活习惯吸烟
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $shxgxy;
	 public $_shxgxy_type='varchar2';
	/**
 	 * 注释:开始吸烟年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ksxynl;
	 public $_ksxynl_type='number';
	/**
 	 * 注释:生活习惯饮酒
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $shxgyj;
	 public $_shxgyj_type='varchar2';
	/**
 	 * 注释:开始饮酒年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ksyjnl;
	 public $_ksyjnl_type='number';
	/**
 	 * 注释:戒酒标志
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $jjbz;
	 public $_jjbz_type='varchar2';
	/**
 	 * 注释:生活习惯锻炼
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $shxgdl;
	 public $_shxgdl_type='varchar2';
	/**
 	 * 注释:身高
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sg;
	 public $_sg_type='number';
	/**
 	 * 注释:体重
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tz;
	 public $_tz_type='number';
	/**
 	 * 注释:体重指数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tzzs;
	 public $_tzzs_type='number';
	/**
 	 * 注释:未服药血压水平收缩压
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $wfysp;
	 public $_wfysp_type='number';
	/**
 	 * 注释:未服药血压水平舒张压
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $wfydp;
	 public $_wfydp_type='number';
	/**
 	 * 注释:高血压并发症情况
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $gxybfzqk;
	 public $_gxybfzqk_type='varchar2';
	/**
 	 * 注释:生活自理能力
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $shzlnl;
	 public $_shzlnl_type='varchar2';
	/**
 	 * 注释:高血压类型编码
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $gxylxbm;
	 public $_gxylxbm_type='varchar2';
	/**
 	 * 注释:血压分级
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $xyfj;
	 public $_xyfj_type='varchar2';
	/**
 	 * 注释:职业暴露标志
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $zyblbz;
	 public $_zyblbz_type='varchar2';
	/**
 	 * 注释:职业暴露危险因素名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $zyblysmc;
	 public $_zyblysmc_type='varchar2';
	/**
 	 * 注释:职业暴露危险因素种类
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $zyblyszl;
	 public $_zyblyszl_type='varchar2';
	/**
 	 * 注释:有危害因素的具体职业
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $whysjtzy;
	 public $_whysjtzy_type='varchar2';
	/**
 	 * 注释:从事有危害因素职业时长(年)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $float_cswhyszysc;
	 public $_float_cswhyszysc_type='number';
	/**
 	 * 注释:防护措施标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $fhcsbz;
	 public $_fhcsbz_type='char';
	/**
 	 * 注释:责任医师姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zrysxm;
	 public $_zrysxm_type='varchar2';
	/**
 	 * 注释:责任医师工号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zrysgh;
	 public $_zrysgh_type='varchar2';
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
