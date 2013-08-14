<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tmedicine extends dao_oracle{
	 public $__table = 'medicine';
	/**
 	 * 注释:唯一标识码
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:药品通用名名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $medicine_name;
	 public $_medicine_name_type='varchar2';
	/**
 	 * 注释:药品通用名编码
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $medicine_code;
	 public $_medicine_code_type='varchar2';
	/**
 	 * 注释:药品通用名分类id
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $category_code;
	 public $_category_code_type='number';
	/**
 	 * 注释:拼音
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $en_name;
	 public $_en_name_type='varchar2';
	/**
 	 * 注释:药品通用名分类编码
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $standard_code;
	 public $_standard_code_type='varchar2';
}
