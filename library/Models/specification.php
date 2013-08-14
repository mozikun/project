<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tspecification extends dao_oracle{
	 public $__table = 'specification';
	/**
 	 * 注释:唯一标示
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:规格
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $specification_name;
	 public $_specification_name_type='varchar2';
	/**
 	 * 注释:规格代码
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $specification_code;
	 public $_specification_code_type='varchar2';
	/**
 	 * 注释:规格拼音
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $specification_en;
	 public $_specification_en_type='varchar2';
}
