<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ttb_dic_detail_medicine extends dao_oracle{
	 public $__table = 'dic_detail_medicine_v';
	/**
 	 * 注释:药品编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ybid;
	 public $_ybid_type='varchar2';
	/**
 	 * 注释:药品上级编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ybsjid;
	 public $_ybsjid_type='varchar2';
	/**
 	 * 注释:药品名称
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ypmc;
	 public $_ypmc_type='varchar2';
	/**
 	 * 注释:对应药品编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ybbm;
	 public $_ybbm_type='varchar2';
	/**
 	 * 注释:药品对应剂型
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ypjx;
	 public $_ypjx_type='varchar2';
	/**
 	 * 注释:是否基本药物
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sfjbyw;
	 public $_sfjbyw_type='char';
	/**
 	 * 注释:有效性
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $validation;
	 public $_validation_type='varchar2';
}
