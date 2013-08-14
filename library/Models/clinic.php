<?php
require_once ('db_oracle.php');
/**
 *注释:诊室表
 *
 *
 **/
class Tclinic extends dao_oracle{
	 public $__table = 'clinic';
	/**
 	 * 注释:系统唯一标识符
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $uuid;
	 public $_uuid_type='nvarchar2';
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
 	 * 注释:删除时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $deleted;
	 public $_deleted_type='number';
	/**
 	 * 注释:状态标志
	 * 
	 * 
	 * @var NVARCHAR2(8)
	 **/
 	 public $status_flag;
	 public $_status_flag_type='nvarchar2';
	/**
 	 * 注释:诊室名称
	 * 
	 * 
	 * @var NVARCHAR2(120)
	 **/
 	 public $clinic_name;
	 public $_clinic_name_type='nvarchar2';
	/**
 	 * 注释:机构id
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $org_id;
	 public $_org_id_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $doctor;
	 public $_doctor_type='nvarchar2';
	/**
 	 * 注释:排序号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sort_number;
	 public $_sort_number_type='number';
	/**
 	 * 注释:科室
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $department_id;
	 public $_department_id_type='varchar2';
}
