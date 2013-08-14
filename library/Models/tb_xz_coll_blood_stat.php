<?php
require_once ('db_oracle.php');
/**
 *注释:采血统计信息表
 *
 *
 **/
class Ttb_xz_coll_blood_stat extends dao_oracle{
	 public $__table = 'tb_xz_coll_blood_stat';
	/**
 	 * 注释:ID
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:血站机构代码
	 * 
	 * 
	 * @var VARCHAR2(22)
	 **/
 	 public $xzjgdm;
	 public $_xzjgdm_type='varchar2';
	/**
 	 * 注释:血站的机构名称
	 * 
	 * 
	 * @var VARCHAR2(70)
	 **/
 	 public $xzmc;
	 public $_xzmc_type='varchar2';
	/**
 	 * 注释:开始时间：yyyy-mm-dd
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $kssj;
	 public $_kssj_type='date';
	/**
 	 * 注释:结束时间：yyyy-mm-dd
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jssj;
	 public $_jssj_type='date';
	/**
 	 * 注释:编码， 1.全血、2.单采
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $cxlx;
	 public $_cxlx_type='char';
	/**
 	 * 注释:血型A+
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xxa;
	 public $_xxa_type='number';
	/**
 	 * 注释:血型B+
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xxb;
	 public $_xxb_type='number';
	/**
 	 * 注释:血型O+
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xxo;
	 public $_xxo_type='number';
	/**
 	 * 注释:血型AB+
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xxab;
	 public $_xxab_type='number';
	/**
 	 * 注释:血型A-
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xx_a;
	 public $_xx_a_type='number';
	/**
 	 * 注释:血型B-
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xx_b;
	 public $_xx_b_type='number';
	/**
 	 * 注释:血型O-
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xx_o;
	 public $_xx_o_type='number';
	/**
 	 * 注释:血型AB-
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xx_ab;
	 public $_xx_ab_type='number';
	/**
 	 * 注释:修改标志 1：正常、2：修改、3：撤销
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
	/**
 	 * 注释:为系统处理该数据而预留
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $yl1;
	 public $_yl1_type='varchar2';
	/**
 	 * 注释:为系统处理该数据而预留
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $yl2;
	 public $_yl2_type='varchar2';
}
