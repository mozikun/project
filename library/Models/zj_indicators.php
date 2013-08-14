<?php
require_once ('db_oracle.php');
/**
 *注释:指标类别表
 *
 *
 **/
class Tzj_indicators extends dao_oracle{
	 public $__table = 'zj_indicators';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:检查指标中文名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $zh_name;
	 public $_zh_name_type='varchar2';
	/**
 	 * 注释:检查指标英文名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $en_name;
	 public $_en_name_type='varchar2';
	/**
 	 * 注释:检查结果
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $exam_result;
	 public $_exam_result_type='varchar2';
	/**
 	 * 注释:计量单位
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $exam_unit;
	 public $_exam_unit_type='varchar2';
	/**
 	 * 注释:参考值
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $reference;
	 public $_reference_type='varchar2';
	/**
 	 * 注释:检验单号
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $lis_id;
	 public $_lis_id_type='varchar2';
	/**
 	 * 注释:机构id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:身份证号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $identity_number;
	 public $_identity_number_type='varchar2';
}
