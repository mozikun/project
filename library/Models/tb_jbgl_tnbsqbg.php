<?php
require_once ('db_oracle.php');
/**
 *注释:糖尿病社区管理卡表
 *
 *
 **/
class Ttb_jbgl_tnbsqbg extends dao_oracle{
	 public $__table = 'tb_jbgl_tnbsqbg';
	/**
 	 * 注释:糖尿病管理卡ID
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
 	 * 注释:个人标识符
	 * 
	 * 
	 * @var VARCHAR2(60)
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
 	 * 注释:建卡日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jkrq;
	 public $_jkrq_type='date';
	/**
 	 * 注释:分组类型
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $fzlx;
	 public $_fzlx_type='varchar2';
	/**
 	 * 注释:责任医师姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zrys;
	 public $_zrys_type='varchar2';
	/**
 	 * 注释:责任医师工号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zrysgh;
	 public $_zrysgh_type='varchar2';
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
	 * @var VARCHAR2(2)
	 **/
 	 public $xb;
	 public $_xb_type='varchar2';
	/**
 	 * 注释:婚姻状况
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $hyzk;
	 public $_hyzk_type='varchar2';
	/**
 	 * 注释:职业
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zy;
	 public $_zy_type='varchar2';
	/**
 	 * 注释:文化程度
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $whcd;
	 public $_whcd_type='varchar2';
	/**
 	 * 注释:住址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzszz;
	 public $_dzszz_type='varchar2';
	/**
 	 * 注释:住址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzsq;
	 public $_dzsq_type='varchar2';
	/**
 	 * 注释:住址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzxq;
	 public $_dzxq_type='varchar2';
	/**
 	 * 注释:住址-乡（镇、街道办事处）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzxzj;
	 public $_dzxzj_type='varchar2';
	/**
 	 * 注释:住址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzcjln;
	 public $_dzcjln_type='varchar2';
	/**
 	 * 注释:住址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzmphm;
	 public $_dzmphm_type='varchar2';
	/**
 	 * 注释:病例种类
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $blzl;
	 public $_blzl_type='varchar2';
	/**
 	 * 注释:糖尿病临床确诊年数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $lcqzns;
	 public $_lcqzns_type='number';
	/**
 	 * 注释:餐后血糖
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jkschxt;
	 public $_jkschxt_type='number';
	/**
 	 * 注释:空腹血糖
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jkskfxt;
	 public $_jkskfxt_type='number';
	/**
 	 * 注释:IGR确诊时间年数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $igrqzns;
	 public $_igrqzns_type='number';
	/**
 	 * 注释:糖尿病并发症类型
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $tnbbfzlx;
	 public $_tnbbfzlx_type='varchar2';
	/**
 	 * 注释:糖尿病家族史
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $jzs;
	 public $_jzs_type='varchar2';
	/**
 	 * 注释:属地确认标志
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $sdqrbz;
	 public $_sdqrbz_type='varchar2';
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
