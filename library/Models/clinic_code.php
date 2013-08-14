<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tclinic_code extends dao_oracle{
	 public $__table = 'clinic_code';
	/**
 	 * 注释:唯一标识
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:id号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $id;
	 public $_id_type='number';
	/**
 	 * 注释:诊疗项目名称
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $zh_name;
	 public $_zh_name_type='varchar2';
	/**
 	 * 注释:路径
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $path;
	 public $_path_type='varchar2';
	/**
 	 * 注释:父id
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $p_id;
	 public $_p_id_type='number';
	/**
 	 * 注释:诊疗项目标准码
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $standard_code;
	 public $_standard_code_type='varchar2';
}
