<?php
require_once ('db_oracle.php');
/**
 *注释:挂号表
 *
 *
 **/
class Ttb_his_mz_reg extends dao_oracle{
	 public $__table = 'tb_his_mz_reg';
	/**
 	 * 注释:挂/退号日期
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $ghrq;
	 public $_ghrq_type='varchar2';
	/**
 	 * 注释:门诊就诊流水号
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ghbm;
	 public $_ghbm_type='varchar2';
	/**
 	 * 注释:退号标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $gthbz;
	 public $_gthbz_type='char';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:收/退费编号
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $stfbh;
	 public $_stfbh_type='varchar2';
	/**
 	 * 注释:挂/退号时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $gthsj;
	 public $_gthsj_type='date';
	/**
 	 * 注释:挂号类别
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $ghlb;
	 public $_ghlb_type='varchar2';
	/**
 	 * 注释:保险类型（患者属性）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bxlx;
	 public $_bxlx_type='varchar2';
	/**
 	 * 注释:科室编码
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $ksbm;
	 public $_ksbm_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $ksmc;
	 public $_ksmc_type='varchar2';
	/**
 	 * 注释:特需标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $txbz;
	 public $_txbz_type='char';
	/**
 	 * 注释:外地标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $wdbz;
	 public $_wdbz_type='char';
	/**
 	 * 注释:诊疗费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zlf;
	 public $_zlf_type='number';
	/**
 	 * 注释:挂号费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ghf;
	 public $_ghf_type='number';
	/**
 	 * 注释:其他费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $qtf;
	 public $_qtf_type='number';
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
