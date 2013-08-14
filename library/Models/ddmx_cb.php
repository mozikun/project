<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tddmx_cb extends dao_oracle{
	 public $__table = 'ddmx_cb';
	/**
 	 * 注释:uuid
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
 	 * 注释:“120”呼入呼出量（次）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrhcl;
	 public $_hrhcl_type='number';
	/**
 	 * 注释:实际派出救护车（驾次）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sjpcjhc;
	 public $_sjpcjhc_type='number';
	/**
 	 * 注释:协调市外救援队伍转运危重病人（人）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zywzbr;
	 public $_zywzbr_type='number';
	/**
 	 * 注释:院前急救地震伤病员（人）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jjdzsby;
	 public $_jjdzsby_type='number';
	/**
 	 * 注释:主表id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zb_uuid;
	 public $_zb_uuid_type='varchar2';
	/**
 	 * 注释:填表医生
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $tbys;
	 public $_tbys_type='varchar2';
}
