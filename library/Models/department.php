<?php
require_once ('db_oracle.php');
/**
 *注释:科室表
 *
 *
 **/
class Tdepartment extends dao_oracle{
	 public $__table = 'department';
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
 	 * 注释:状态
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $status_flag;
	 public $_status_flag_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:科室名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $department_name;
	 public $_department_name_type='varchar2';
	/**
 	 * 注释:排序号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sort_number;
	 public $_sort_number_type='number';
}
