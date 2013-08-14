<?php
require_once ('db_oracle.php');
/**
 *注释:供血统计信息表
 *
 *
 **/
class Ttb_xz_provide_blood_stat extends dao_oracle{
	 public $__table = 'tb_xz_provide_blood_stat';
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
 	 * 注释:血站名称
	 * 
	 * 
	 * @var VARCHAR2(70)
	 **/
 	 public $xzmc;
	 public $_xzmc_type='varchar2';
	/**
 	 * 注释:供向医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(22)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:供向医疗机构名称
	 * 
	 * 
	 * @var VARCHAR2(70)
	 **/
 	 public $yljgmc;
	 public $_yljgmc_type='varchar2';
	/**
 	 * 注释:血液大类类型
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xydllx;
	 public $_xydllx_type='char';
	/**
 	 * 注释:血液品种编号
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $xypzbh;
	 public $_xypzbh_type='varchar2';
	/**
 	 * 注释:血液品种名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $xypzmc;
	 public $_xypzmc_type='varchar2';
	/**
 	 * 注释:血型代码
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xxdm;
	 public $_xxdm_type='number';
	/**
 	 * 注释:血型名称
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $xxmc;
	 public $_xxmc_type='varchar2';
	/**
 	 * 注释:实际合计血量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sjhjxl;
	 public $_sjhjxl_type='number';
	/**
 	 * 注释:实际合计血量单位
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $sjhjxld;
	 public $_sjhjxld_type='varchar2';
	/**
 	 * 注释:合计血量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hjxl;
	 public $_hjxl_type='number';
	/**
 	 * 注释:合计血量单位
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $hjxldw;
	 public $_hjxldw_type='varchar2';
	/**
 	 * 注释:1：正常、2：修改、3：撤销
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
