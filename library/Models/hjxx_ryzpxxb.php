<?php
require_once ('db_oracle.php');
/**
 *注释:人员照片信息表
 *
 *
 **/
class Thjxx_ryzpxxb extends dao_oracle{
	 public $__table = 'hjxx_ryzpxxb';
	/**
 	 * 注释:照片ID
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zpid;
	 public $_zpid_type='number';
	/**
 	 * 注释:人员ID
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ryid;
	 public $_ryid_type='number';
	/**
 	 * 注释:公民身份号码
	 * 
	 * 
	 * @var CHAR(18)
	 **/
 	 public $gmsfhm;
	 public $_gmsfhm_type='char';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var NVARCHAR2(40)
	 **/
 	 public $xm;
	 public $_xm_type='nvarchar2';
	/**
 	 * 注释:照片
	 * 
	 * 
	 * @var LONG RAW(0)
	 **/
 	 public $zp;
	 public $_zp_type='long raw';
	/**
 	 * 注释:录入时间
	 * 
	 * 
	 * @var CHAR(14)
	 **/
 	 public $lrrq;
	 public $_lrrq_type='char';
}
