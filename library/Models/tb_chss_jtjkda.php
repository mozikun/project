<?php
require_once ('db_oracle.php');
/**
 *注释:家庭健康档案表
 *
 *
 **/
class Ttb_chss_jtjkda extends dao_oracle{
	 public $__table = 'tb_chss_jtjkda';
	/**
 	 * 注释:家庭档案ID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $jtdaid;
	 public $_jtdaid_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:户主个人标识符
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
 	 * 注释:家庭电话
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jtdh;
	 public $_jtdh_type='varchar2';
	/**
 	 * 注释:家庭所在地行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jt_xzqh;
	 public $_jt_xzqh_type='varchar2';
	/**
 	 * 注释:家庭所在地-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jt_she;
	 public $_jt_she_type='varchar2';
	/**
 	 * 注释:家庭所在地-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jt_shi;
	 public $_jt_shi_type='varchar2';
	/**
 	 * 注释:家庭所在地-县（区）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jt_xia;
	 public $_jt_xia_type='varchar2';
	/**
 	 * 注释:家庭所在地-乡（镇、街道）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jt_xng;
	 public $_jt_xng_type='varchar2';
	/**
 	 * 注释:家庭所在地-村（路、街、弄）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jt_cun;
	 public $_jt_cun_type='varchar2';
	/**
 	 * 注释:家庭所在地-门牌号(包括"室")
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jt_mph;
	 public $_jt_mph_type='varchar2';
	/**
 	 * 注释:家庭所属社区编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jtsssqbm;
	 public $_jtsssqbm_type='varchar2';
	/**
 	 * 注释:家庭详细地址
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jtxxdz;
	 public $_jtxxdz_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $yzbm;
	 public $_yzbm_type='varchar2';
	/**
 	 * 注释:责任医生姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zrysxm;
	 public $_zrysxm_type='varchar2';
	/**
 	 * 注释:责任医生工号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zrysgh;
	 public $_zrysgh_type='varchar2';
	/**
 	 * 注释:是否签约
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $sfqy;
	 public $_sfqy_type='varchar2';
	/**
 	 * 注释:签约日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $qyrq;
	 public $_qyrq_type='date';
	/**
 	 * 注释:家庭档案状态
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $jtdazt;
	 public $_jtdazt_type='varchar2';
	/**
 	 * 注释:调查人工号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $dcrgh;
	 public $_dcrgh_type='varchar2';
	/**
 	 * 注释:调查人姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $dcrxm;
	 public $_dcrxm_type='varchar2';
	/**
 	 * 注释:调查日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $dcrq;
	 public $_dcrq_type='date';
	/**
 	 * 注释:登记人工号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $djrgh;
	 public $_djrgh_type='varchar2';
	/**
 	 * 注释:登记人姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $djrxm;
	 public $_djrxm_type='varchar2';
	/**
 	 * 注释:登记日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $djrq;
	 public $_djrq_type='date';
	/**
 	 * 注释:登记机构编码
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $djjgbm;
	 public $_djjgbm_type='varchar2';
	/**
 	 * 注释:登记机构名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $djjgmc;
	 public $_djjgmc_type='varchar2';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='varchar2';
	/**
 	 * 注释:密级
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
}
