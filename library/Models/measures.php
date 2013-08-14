<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tmeasures extends dao_oracle{
	 public $__table = 'measures';
	/**
 	 * 注释:唯一标识
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:单位编码
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $measure_code;
	 public $_measure_code_type='varchar2';
	/**
 	 * 注释:单位名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $measure_name;
	 public $_measure_name_type='varchar2';
	/**
 	 * 注释:单位英文
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $measure_en;
	 public $_measure_en_type='varchar2';
}
