<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ttb_chss_grjws extends dao_oracle{
	 public $__table = 'tb_chss_grjws';
	/**
 	 * 注释:既往史ID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $jwsid;
	 public $_jwsid_type='varchar2';
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
 	 * 注释:观察结果开始时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jbkssj;
	 public $_jbkssj_type='date';
	/**
 	 * 注释:观察结果结束时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jbjssj;
	 public $_jbjssj_type='date';
	/**
 	 * 注释:观察结果是否至今标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $jbsfzjbz;
	 public $_jbsfzjbz_type='char';
	/**
 	 * 注释:就诊医疗机构类别编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $jzyylbbm;
	 public $_jzyylbbm_type='varchar2';
	/**
 	 * 注释:既往观察项目名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $gcxdmc;
	 public $_gcxdmc_type='varchar2';
	/**
 	 * 注释:既往观察项目分类代码
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $gcxmfl;
	 public $_gcxmfl_type='varchar2';
	/**
 	 * 注释:既往观察项目代码名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $gcxmdmmc;
	 public $_gcxmdmmc_type='varchar2';
	/**
 	 * 注释:既往观察方法代码
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $gcff;
	 public $_gcff_type='varchar2';
	/**
 	 * 注释:既往观察结果（疾病名称）
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $gcjg;
	 public $_gcjg_type='varchar2';
	/**
 	 * 注释:既往观察结果代码（疾病编码）
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $gcjgmc;
	 public $_gcjgmc_type='varchar2';
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
