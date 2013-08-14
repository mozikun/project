<?php
require_once ('db_oracle.php');
/**
 *注释:api疾病统计
 *
 *
 **/
class Tapi_disease extends dao_oracle{
	 public $__table = 'api_disease';
	/**
 	 * 注释:唯一id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:档案id
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $document_id;
	 public $_document_id_type='varchar2';
	/**
 	 * 注释:诊断机构代码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $diagnosis_org_id;
	 public $_diagnosis_org_id_type='varchar2';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $dignosis_date;
	 public $_dignosis_date_type='number';
	/**
 	 * 注释:疾病名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $disease_name;
	 public $_disease_name_type='varchar2';
	/**
 	 * 注释:疾病代码
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $disease_code;
	 public $_disease_code_type='varchar2';
}
