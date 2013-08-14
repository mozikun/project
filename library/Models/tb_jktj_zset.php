<?php
require_once ('db_oracle.php');
/**
 *注释:0-1岁儿童健康体检表
 *
 *
 **/
class Ttb_jktj_zset extends dao_oracle{
	 public $__table = 'tb_jktj_zset';
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
	 * @var VARCHAR2(50)
	 **/
 	 public $grdaid;
	 public $_grdaid_type='varchar2';
	/**
 	 * 注释:标识符类型
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $bzflx;
	 public $_bzflx_type='varchar2';
	/**
 	 * 注释:周岁儿童健康体检表编号
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $zsetbh;
	 public $_zsetbh_type='varchar2';
	/**
 	 * 注释:体检日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $tjrq;
	 public $_tjrq_type='date';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $xm;
	 public $_xm_type='varchar2';
	/**
 	 * 注释:性别名称
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $xbmc;
	 public $_xbmc_type='varchar2';
	/**
 	 * 注释:性别编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $xbbm;
	 public $_xbbm_type='varchar2';
	/**
 	 * 注释:年龄
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $nl;
	 public $_nl_type='varchar2';
	/**
 	 * 注释:有无产伤
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ywcs;
	 public $_ywcs_type='char';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $csrq;
	 public $_csrq_type='date';
	/**
 	 * 注释:监护人姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jhrxm;
	 public $_jhrxm_type='varchar2';
	/**
 	 * 注释:监护人有效证件类型
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $jhrzjlx;
	 public $_jhrzjlx_type='varchar2';
	/**
 	 * 注释:监护人有效证件号
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $jhrzjh;
	 public $_jhrzjh_type='varchar2';
	/**
 	 * 注释:联系电话
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $lxdh;
	 public $_lxdh_type='varchar2';
	/**
 	 * 注释:胎次
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tc;
	 public $_tc_type='number';
	/**
 	 * 注释:产次
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $cc;
	 public $_cc_type='number';
	/**
 	 * 注释:产期名称
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $cqmc;
	 public $_cqmc_type='varchar2';
	/**
 	 * 注释:产期编码
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $cqbm;
	 public $_cqbm_type='varchar2';
	/**
 	 * 注释:生产情况名称
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $scqkmc;
	 public $_scqkmc_type='varchar2';
	/**
 	 * 注释:生产情况编码
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $scqkbm;
	 public $_scqkbm_type='varchar2';
	/**
 	 * 注释:出生体重（kg）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $cstz;
	 public $_cstz_type='number';
	/**
 	 * 注释:有无出生窒息
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $cszx;
	 public $_cszx_type='varchar2';
	/**
 	 * 注释:有无病理性黄疸
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $blxhd;
	 public $_blxhd_type='varchar2';
	/**
 	 * 注释:有无抽搐
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $ywcc;
	 public $_ywcc_type='varchar2';
	/**
 	 * 注释:抽搐初发时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $cccfsj;
	 public $_cccfsj_type='date';
	/**
 	 * 注释:出生身长（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $cssc;
	 public $_cssc_type='number';
	/**
 	 * 注释:萌牙时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $mysj;
	 public $_mysj_type='date';
	/**
 	 * 注释:12月牙齿数（只）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $yycs12;
	 public $_yycs12_type='number';
	/**
 	 * 注释:12月体重（kg）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ytz12;
	 public $_ytz12_type='number';
	/**
 	 * 注释:12月身长（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ysc12;
	 public $_ysc12_type='number';
	/**
 	 * 注释:视力是否正常
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sl;
	 public $_sl_type='char';
	/**
 	 * 注释:喂养情况
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $wyqk;
	 public $_wyqk_type='varchar2';
	/**
 	 * 注释:喂养情况编码
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $wybm;
	 public $_wybm_type='varchar2';
	/**
 	 * 注释:腹泻
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $fx;
	 public $_fx_type='varchar2';
	/**
 	 * 注释:曾患肺炎及其它疾病
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $fyjqtjb;
	 public $_fyjqtjb_type='varchar2';
	/**
 	 * 注释:有无佝偻病
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $ywglb;
	 public $_ywglb_type='varchar2';
	/**
 	 * 注释:有无贫血
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $ywpx;
	 public $_ywpx_type='varchar2';
	/**
 	 * 注释:体检责任医师工号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $tjysgh;
	 public $_tjysgh_type='varchar2';
	/**
 	 * 注释:体检责任医师姓名
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $tjysxm;
	 public $_tjysxm_type='varchar2';
	/**
 	 * 注释:科室编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ksbm;
	 public $_ksbm_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ksmc;
	 public $_ksmc_type='varchar2';
	/**
 	 * 注释:丹佛智力筛查（DDST）是否异常
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ddst;
	 public $_ddst_type='char';
	/**
 	 * 注释:DDST异常情况
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ddstqk;
	 public $_ddstqk_type='varchar2';
	/**
 	 * 注释:总结评价
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $zjpj;
	 public $_zjpj_type='varchar2';
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
