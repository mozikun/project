<?php
require_once ('db_oracle.php');
/**
 *注释:业务收入统计表(
 *
 *
 **/
class Ttb_yw_ywsrtj extends dao_oracle{
	 public $__table = 'tb_yw_ywsrtj';
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
 	 * 注释:门急诊医疗费用
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mjzylfy;
	 public $_mjzylfy_type='number';
	/**
 	 * 注释:住院医疗费用
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zyylfy;
	 public $_zyylfy_type='number';
	/**
 	 * 注释:门急诊药品费用
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mjzypfy;
	 public $_mjzypfy_type='number';
	/**
 	 * 注释:住院药品费用
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zyypfy;
	 public $_zyypfy_type='number';
	/**
 	 * 注释:门急诊医保医疗费用
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mjzybylfy;
	 public $_mjzybylfy_type='number';
	/**
 	 * 注释:住院医保医疗费用
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zyybylfy;
	 public $_zyybylfy_type='number';
	/**
 	 * 注释:门急诊医保药品费用
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mjzybypfy;
	 public $_mjzybypfy_type='number';
	/**
 	 * 注释:住院医保药品费用
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zyybypfy;
	 public $_zyybypfy_type='number';
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
