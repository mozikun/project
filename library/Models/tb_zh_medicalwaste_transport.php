<?php
require_once ('db_oracle.php');
/**
 *注释:医疗废物转移记录表
 *
 *
 **/
class Ttb_zh_medicalwaste_transport extends dao_oracle{
	 public $__table = 'tb_zh_medicalwaste_transport';
	/**
 	 * 注释:流水号
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
 	 * 注释:医疗废物处置单位的名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ylfwczdw;
	 public $_ylfwczdw_type='varchar2';
	/**
 	 * 注释:医疗废物转移的日期：年月日
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $zyrq;
	 public $_zyrq_type='date';
	/**
 	 * 注释:感染性废物及其他-体积（箱）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $grxfwtj;
	 public $_grxfwtj_type='number';
	/**
 	 * 注释:感染性废物及其他-重量（KG）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $grxfwzl;
	 public $_grxfwzl_type='number';
	/**
 	 * 注释:损伤性废物-体积（盒）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ssxfwtj;
	 public $_ssxfwtj_type='number';
	/**
 	 * 注释:损伤性废物-重量（KG）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ssxfwzl;
	 public $_ssxfwzl_type='number';
	/**
 	 * 注释:医疗机构交接人员
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $yljgjjry;
	 public $_yljgjjry_type='varchar2';
	/**
 	 * 注释:废物运送人员的姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $fwysry;
	 public $_fwysry_type='varchar2';
	/**
 	 * 注释:医疗废物转移的交接时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jjsj;
	 public $_jjsj_type='date';
	/**
 	 * 注释:机构向区域平台数据中心填报数据当天的日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $tbrq;
	 public $_tbrq_type='date';
	/**
 	 * 注释:备注
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $bz;
	 public $_bz_type='varchar2';
}
