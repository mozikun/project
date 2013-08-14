<?php
require_once ('db_oracle.php');
/**
 *注释:业务量统计表
 *
 *
 **/
class Ttb_yw_ywltj extends dao_oracle{
	 public $__table = 'yw_ywltj_v';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:科室编码
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $ksbm;
	 public $_ksbm_type='varchar2';
	/**
 	 * 注释:业务时间
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $ywsj;
	 public $_ywsj_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $ksmc;
	 public $_ksmc_type='varchar2';
	/**
 	 * 注释:门诊人次
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mzrc;
	 public $_mzrc_type='number';
	/**
 	 * 注释:急诊人次
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jzrc;
	 public $_jzrc_type='number';
	/**
 	 * 注释:入院人次
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ryrc;
	 public $_ryrc_type='number';
	/**
 	 * 注释:出院人次
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $cyrc;
	 public $_cyrc_type='number';
	/**
 	 * 注释:在院人数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zyrs;
	 public $_zyrs_type='number';
	/**
 	 * 注释:预留统计字段1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tjyl1;
	 public $_tjyl1_type='number';
	/**
 	 * 注释:预留统计字段2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tjyl2;
	 public $_tjyl2_type='number';
	/**
 	 * 注释:预留统计字段3
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tjyl3;
	 public $_tjyl3_type='number';
	/**
 	 * 注释:预留统计字段4
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tjyl4;
	 public $_tjyl4_type='number';
	/**
 	 * 注释:预留统计字段5
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tjyl5;
	 public $_tjyl5_type='number';
	/**
 	 * 注释:预留统计字段6
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tjyl6;
	 public $_tjyl6_type='number';
	/**
 	 * 注释:预留统计字段7
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tjyl7;
	 public $_tjyl7_type='number';
	/**
 	 * 注释:预留统计字段8
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tjyl8;
	 public $_tjyl8_type='number';
	/**
 	 * 注释:填报日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $tbrq;
	 public $_tbrq_type='date';
}
