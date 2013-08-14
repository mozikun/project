<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tmaterials extends dao_oracle{
	 public $__table = 'materials';
	/**
 	 * 注释:唯一标识
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:品名编码
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $name_encod;
	 public $_name_encod_type='varchar2';
	/**
 	 * 注释:品名（含规格）
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $zh_name;
	 public $_zh_name_type='varchar2';
	/**
 	 * 注释:标准编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $standard_code;
	 public $_standard_code_type='varchar2';
	/**
 	 * 注释:分类路径
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $path;
	 public $_path_type='varchar2';
	/**
 	 * 注释:单位
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $measure;
	 public $_measure_type='varchar2';
	/**
 	 * 注释:规格
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $format;
	 public $_format_type='varchar2';
	/**
 	 * 注释:是否国产
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $domestic;
	 public $_domestic_type='varchar2';
	/**
 	 * 注释:品名拼音
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $en_name;
	 public $_en_name_type='varchar2';
	/**
 	 * 注释:医保等级
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $medicare;
	 public $_medicare_type='varchar2';
}
