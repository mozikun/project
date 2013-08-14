<?php
require_once ('db_oracle.php');
/**
 *注释:健康体检表主表
 *
 *
 **/
class Texamination_table extends dao_oracle{
	 public $__table = 'examination_table';
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
 	 * 注释:档案编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $serial_number;
	 public $_serial_number_type='varchar2';
	/**
 	 * 注释:添加记录时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:体检日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $examination_date;
	 public $_examination_date_type='number';
	/**
 	 * 注释:责任医生
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $examination_doctor;
	 public $_examination_doctor_type='varchar2';
	/**
 	 * 注释:扩展UUID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:更新时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
}
