<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tcgxxxmx_cb extends dao_oracle{
	 public $__table = 'cgxxxmx_cb';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:创建时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:更新时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
	/**
 	 * 注释:献血点（个）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xxd;
	 public $_xxd_type='number';
	/**
 	 * 注释:献血人数（人）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xxrs;
	 public $_xxrs_type='number';
	/**
 	 * 注释:采血量（单位）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $cxl;
	 public $_cxl_type='number';
	/**
 	 * 注释:红细胞悬液（单位）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hxbxx;
	 public $_hxbxx_type='number';
	/**
 	 * 注释:血浆（单位）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xj;
	 public $_xj_type='number';
	/**
 	 * 注释:血小板（袋）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xxb;
	 public $_xxb_type='number';
	/**
 	 * 注释:血液库存（单位）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xxkc;
	 public $_xxkc_type='number';
	/**
 	 * 注释:预约献血登记团体（人）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xxdjgr;
	 public $_xxdjgr_type='number';
	/**
 	 * 注释:预约献血登记个人（人）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xxdjtt;
	 public $_xxdjtt_type='number';
}
