<?php
require_once ('db_oracle.php');
/**
 *注释:老年人专项表
 *
 *
 **/
class Ttb_jbgl_lnrzx extends dao_oracle{
	 public $__table = 'tb_jbgl_lnrzx';
	/**
 	 * 注释:老年人专项表ID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $lnrid;
	 public $_lnrid_type='varchar2';
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
 	 public $jkdabzf;
	 public $_jkdabzf_type='varchar2';
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
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $sfzjhm;
	 public $_sfzjhm_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sfzjlbdm;
	 public $_sfzjlbdm_type='char';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $xm;
	 public $_xm_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xbdm;
	 public $_xbdm_type='char';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $csrq;
	 public $_csrq_type='date';
	/**
 	 * 注释:签名日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $qmrq;
	 public $_qmrq_type='date';
	/**
 	 * 注释:日常生活能力评价内容
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $rcshpjnr;
	 public $_rcshpjnr_type='varchar2';
	/**
 	 * 注释:日常生活能力评价分数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $rcshnlpj;
	 public $_rcshnlpj_type='number';
	/**
 	 * 注释:开始吸烟年龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ksxynl;
	 public $_ksxynl_type='number';
	/**
 	 * 注释:开始饮酒年龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ksyjnl;
	 public $_ksyjnl_type='number';
	/**
 	 * 注释:日吸烟量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $rxyl;
	 public $_rxyl_type='number';
	/**
 	 * 注释:日饮酒量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ryjl;
	 public $_ryjl_type='number';
	/**
 	 * 注释:生活能力评价结果编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $shnlpjbm;
	 public $_shnlpjbm_type='varchar2';
	/**
 	 * 注释:生活能力评价结果名称
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $shnlpjmc;
	 public $_shnlpjmc_type='varchar2';
	/**
 	 * 注释:生活赡养方式编码
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $shsyfsbm;
	 public $_shsyfsbm_type='varchar2';
	/**
 	 * 注释:生活赡养方式名称
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $shsyfsmc;
	 public $_shsyfsmc_type='varchar2';
	/**
 	 * 注释:视力指数情况编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $slzsqkbm;
	 public $_slzsqkbm_type='varchar2';
	/**
 	 * 注释:视力指数情况名称
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $slzsqkmc;
	 public $_slzsqkmc_type='varchar2';
	/**
 	 * 注释:现存主要健康问题
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $xczyjkwt;
	 public $_xczyjkwt_type='varchar2';
	/**
 	 * 注释:心理状态代码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xlztdm;
	 public $_xlztdm_type='char';
	/**
 	 * 注释:牙齿残缺情况编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $yccqbm;
	 public $_yccqbm_type='varchar2';
	/**
 	 * 注释:牙齿残缺情况
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $yccqmc;
	 public $_yccqmc_type='varchar2';
	/**
 	 * 注释:常住地址类别代码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $czdzlbdm;
	 public $_czdzlbdm_type='char';
	/**
 	 * 注释:常住地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzszzqzxs;
	 public $_dzszzqzxs_type='varchar2';
	/**
 	 * 注释:常住地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzsdq;
	 public $_dzsdq_type='varchar2';
	/**
 	 * 注释:常住地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzxq;
	 public $_dzxq_type='varchar2';
	/**
 	 * 注释:常住地址-乡（镇、街道办事处）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzxzjdbsc;
	 public $_dzxzjdbsc_type='varchar2';
	/**
 	 * 注释:常住地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzcjln;
	 public $_dzcjln_type='varchar2';
	/**
 	 * 注释:常住地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dzmphm;
	 public $_dzmphm_type='varchar2';
	/**
 	 * 注释:调查日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $dcrq;
	 public $_dcrq_type='date';
	/**
 	 * 注释:调查者工号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $dczgh;
	 public $_dczgh_type='varchar2';
	/**
 	 * 注释:调查者姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $dczxm;
	 public $_dczxm_type='varchar2';
	/**
 	 * 注释:防护措施标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $fhcsbz;
	 public $_fhcsbz_type='char';
	/**
 	 * 注释:护理照顾情况编码
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $hlzgbm;
	 public $_hlzgbm_type='varchar2';
	/**
 	 * 注释:护理照顾情况名称
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $hlzgmc;
	 public $_hlzgmc_type='varchar2';
	/**
 	 * 注释:检查中发现的妇科疾病编码
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $jckjbbm;
	 public $_jckjbbm_type='varchar2';
	/**
 	 * 注释:检查中是否发现妇科疾病
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sffxfkjb;
	 public $_sffxfkjb_type='char';
	/**
 	 * 注释:检查中发现的妇科疾病名称
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $fxfkjbmc;
	 public $_fxfkjbmc_type='varchar2';
	/**
 	 * 注释:近两年内是否做过妇科检查
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $jlnnfkjc;
	 public $_jlnnfkjc_type='char';
	/**
 	 * 注释:目前妇科症状情况编码
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $fkzzqkbm;
	 public $_fkzzqkbm_type='varchar2';
	/**
 	 * 注释:目前妇科症状情况名称
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $fkzzqkmc;
	 public $_fkzzqkmc_type='varchar2';
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
 	 public $yl1;
	 public $_yl1_type='varchar2';
	/**
 	 * 注释:预留二
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $yl2;
	 public $_yl2_type='varchar2';
}
