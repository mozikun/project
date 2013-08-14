<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tdisease_category extends dao_oracle{
	 public $__table = 'disease_category';
	/**
 	 * 注释:唯一编号
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:编码名称
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $zh_name;
	 public $_zh_name_type='varchar2';
	/**
 	 * 注释:标准码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $standard_code;
	 public $_standard_code_type='varchar2';
	/**
 	 * 注释:疾病分类拼音
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $pinyin;
	 public $_pinyin_type='varchar2';
}
