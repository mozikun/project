<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tcgxxxmx_zb extends dao_oracle{
	 public $__table = 'cgxxxmx_zb';
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
 	 * 注释:填报单位
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:填报人
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $tbr;
	 public $_tbr_type='varchar2';
	/**
 	 * 注释:联系电话
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $lxdh;
	 public $_lxdh_type='varchar2';
	/**
 	 * 注释:审核人
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $shr;
	 public $_shr_type='varchar2';
	/**
 	 * 注释:统计开始时间，精确到时分秒
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tjkssj;
	 public $_tjkssj_type='number';
	/**
 	 * 注释:统计结束时间，精确到时分秒
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tjjssj;
	 public $_tjjssj_type='number';
}
