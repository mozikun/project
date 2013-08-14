<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tweixin_module extends dao_oracle{
	 public $__table = 'weixin_module';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:模块名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $module_name;
	 public $_module_name_type='varchar2';
	/**
 	 * 注释:模块编码
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $module_code;
	 public $_module_code_type='varchar2';
	/**
 	 * 注释:1已启用，2未启用
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $status;
	 public $_status_type='number';
	/**
 	 * 注释:列表URL地址
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $list_url;
	 public $_list_url_type='varchar2';
	/**
 	 * 注释:模块代码处理URL
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $api_url;
	 public $_api_url_type='varchar2';
	/**
 	 * 注释:1首页列出，2首页不列出
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $is_index;
	 public $_is_index_type='number';
	/**
 	 * 注释:显示排序
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $display;
	 public $_display_type='number';
}
