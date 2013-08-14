<?php
require_once ('db_oracle.php');
/**
 *注释:用血明细表
 *
 *
 **/
class Ttb_xz_used_blood_detail extends dao_oracle{
	 public $__table = 'tb_xz_used_blood_detail';
	/**
 	 * 注释:ID
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(22)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:血袋编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $xdbh;
	 public $_xdbh_type='varchar2';
	/**
 	 * 注释:机构代码
	 * 
	 * 
	 * @var VARCHAR2(22)
	 **/
 	 public $jgdm;
	 public $_jgdm_type='varchar2';
	/**
 	 * 注释:接收血液患者的姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jszxm;
	 public $_jszxm_type='varchar2';
	/**
 	 * 注释:接收者性别,0.未知的性别 1.男性 2.女性 9.未说明的性别。
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $jszxb;
	 public $_jszxb_type='char';
	/**
 	 * 注释:接收者证件-类别代码
	 * 
	 * 
	 * @var CHAR(2)
	 **/
 	 public $jszzj_lbdm;
	 public $_jszzj_lbdm_type='char';
	/**
 	 * 注释:接收者证件-号码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $jszzj_hm;
	 public $_jszzj_hm_type='varchar2';
	/**
 	 * 注释:接收者就诊流水号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jzlsh;
	 public $_jzlsh_type='varchar2';
	/**
 	 * 注释:交付时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jfsj;
	 public $_jfsj_type='date';
	/**
 	 * 注释:发放时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $ffsj;
	 public $_ffsj_type='date';
	/**
 	 * 注释:用血量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $yxl;
	 public $_yxl_type='number';
	/**
 	 * 注释:用血计量单位
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $yxjldw;
	 public $_yxjldw_type='varchar2';
	/**
 	 * 注释:用血机构名称
	 * 
	 * 
	 * @var VARCHAR2(70)
	 **/
 	 public $yxjgmc;
	 public $_yxjgmc_type='varchar2';
	/**
 	 * 注释:填报日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $tbrq;
	 public $_tbrq_type='date';
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
