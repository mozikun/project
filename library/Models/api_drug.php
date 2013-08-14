<?php
require_once ('db_oracle.php');
/**
 *注释:电子病历用药
 *
 *
 **/
class Tapi_drug extends dao_oracle{
	 public $__table = 'api_drug';
	/**
 	 * 注释:唯一id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:处方id
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $document_id;
	 public $_document_id_type='varchar2';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $dignosis_time;
	 public $_dignosis_time_type='number';
	/**
 	 * 注释:药品名
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $drug_name;
	 public $_drug_name_type='varchar2';
	/**
 	 * 注释:药品code
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $drug_code;
	 public $_drug_code_type='varchar2';
	/**
 	 * 注释:基药1是2否
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $based_medicine;
	 public $_based_medicine_type='varchar2';
	/**
 	 * 注释:诊断机构号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
}
