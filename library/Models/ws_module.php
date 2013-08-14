<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_module extends dao_oracle{
	 public $__table = 'ws_module';
	/**
 	 * 注释:模块id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $module_id;
	 public $_module_id_type='varchar2';
	/**
 	 * 注释:模块名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $module_name;
	 public $_module_name_type='varchar2';
	/**
 	 * 注释:备注
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $module_content;
	 public $_module_content_type='varchar2';
}
