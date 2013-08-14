<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ttb_dic_ris_type extends dao_oracle{
	 public $__table = 'tb_dic_ris_type';
	/**
 	 * 注释:计算机X线断层摄影
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ct;
	 public $_ct_type='varchar2';
	/**
 	 * 注释:核磁共振成像
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mr;
	 public $_mr_type='varchar2';
	/**
 	 * 注释:数字减影血管造影
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dsa;
	 public $_dsa_type='varchar2';
	/**
 	 * 注释:普通X光摄影
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $xray;
	 public $_xray_type='varchar2';
	/**
 	 * 注释:超声检查
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $us;
	 public $_us_type='varchar2';
	/**
 	 * 注释:病理检查
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $microscopy;
	 public $_microscopy_type='varchar2';
	/**
 	 * 注释:內镜检查
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $es;
	 public $_es_type='varchar2';
	/**
 	 * 注释:核医学检查
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $nm;
	 public $_nm_type='varchar2';
	/**
 	 * 注释:其他检查
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ot;
	 public $_ot_type='varchar2';
}
