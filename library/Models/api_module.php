<?php
require_once ('db_oracle.php');
/**
 *注释:接口模块
 *
 *
 **/
class Tapi_module extends dao_oracle{
	 public $__table = 'api_module';
	/**
 	 * 注释:唯一id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:医生id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $doctor_id;
	 public $_doctor_id_type='varchar2';
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
 	 * 注释:模块代码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $module_id;
	 public $_module_id_type='varchar2';
	/**
 	 * 注释:模块名
	 * 
	 * 
	 * @var VARCHAR2(80)
	 **/
 	 public $module_name;
	 public $_module_name_type='varchar2';
	/**
 	 * 注释:排序号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $order_by;
	 public $_order_by_type='number';
	/**
 	 * 注释:xml排序号
	 * 
	 * 
	 * @var VARCHAR2(80)
	 **/
 	 public $xml_template;
	 public $_xml_template_type='varchar2';
}
