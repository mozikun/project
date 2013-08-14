<?php
require_once ('db_oracle.php');
/**
 *注释:体检分科
 *
 *
 **/
class Ttb_yl_tjbg extends dao_oracle{
	 public $__table = 'tb_yl_tjbg';
	/**
 	 * 注释:分科报告流水号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bglsh;
	 public $_bglsh_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(22)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
	/**
 	 * 注释:体检编号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $tjbh;
	 public $_tjbh_type='varchar2';
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
	 * @var VARCHAR2(50)
	 **/
 	 public $ksmc;
	 public $_ksmc_type='varchar2';
	/**
 	 * 注释:组合名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $zhmc;
	 public $_zhmc_type='varchar2';
	/**
 	 * 注释:体检小结
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $tjxj;
	 public $_tjxj_type='varchar2';
	/**
 	 * 注释:报告日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $bgrq;
	 public $_bgrq_type='date';
	/**
 	 * 注释:报告医师工号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $bgysgh;
	 public $_bgysgh_type='varchar2';
	/**
 	 * 注释:报告医师姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $bgysxm;
	 public $_bgysxm_type='varchar2';
}
