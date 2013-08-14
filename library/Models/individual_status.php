<?php
require_once ('db_oracle.php');
/**
 *注释:档案状态表-解决统计分时段统计
 *
 *
 **/
class Tindividual_status extends dao_oracle{
	 public $__table = 'individual_status';
	/**
 	 * 注释:编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:医生档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:个人档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:添加记录时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:更新记录时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
	/**
 	 * 注释:档案状态时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $status_time;
	 public $_status_time_type='number';
	/**
 	 * 注释:档案状态
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $status_flag;
	 public $_status_flag_type='varchar2';
	/**
 	 * 注释:状态备注
	 * 
	 * 
	 * @var VARCHAR2(500)
	 **/
 	 public $mark;
	 public $_mark_type='varchar2';
}
