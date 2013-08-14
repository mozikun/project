<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tlogs extends dao_oracle{
	 public $__table = 'logs';
	/**
 	 * 注释:唯一编码
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:表名
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $table_name;
	 public $_table_name_type='varchar2';
	/**
 	 * 注释:字段名
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $column_name;
	 public $_column_name_type='varchar2';
	/**
 	 * 注释:旧值
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $old_value;
	 public $_old_value_type='varchar2';
	/**
 	 * 注释:新值
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $new_value;
	 public $_new_value_type='varchar2';
	/**
 	 * 注释:操作者
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:更新时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $update_time;
	 public $_update_time_type='number';
	/**
 	 * 注释:动作
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $action;
	 public $_action_type='varchar2';
}
