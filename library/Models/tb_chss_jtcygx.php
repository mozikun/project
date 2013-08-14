<?php
require_once ('db_oracle.php');
/**
 *注释:家庭成员关系表
 *
 *
 **/
class Ttb_chss_jtcygx extends dao_oracle{
	 public $__table = 'tb_chss_jtcygx';
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
 	 * 注释:户主标识
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $hzbs;
	 public $_hzbs_type='varchar2';
	/**
 	 * 注释:户主个人标识符
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $hzgrdaid;
	 public $_hzgrdaid_type='varchar2';
	/**
 	 * 注释:与户主关系名称
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $yhzgxmc;
	 public $_yhzgxmc_type='varchar2';
	/**
 	 * 注释:与户主关系代码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $yhzgxdm;
	 public $_yhzgxdm_type='varchar2';
	/**
 	 * 注释:其他关系描述
	 * 
	 * 
	 * @var VARCHAR2(500)
	 **/
 	 public $qtgxms;
	 public $_qtgxms_type='varchar2';
	/**
 	 * 注释:是否户籍
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $sfhjmc;
	 public $_sfhjmc_type='varchar2';
	/**
 	 * 注释:居住状况名称
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jzzkmc;
	 public $_jzzkmc_type='varchar2';
	/**
 	 * 注释:居住状况编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $jzzkbm;
	 public $_jzzkbm_type='varchar2';
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
