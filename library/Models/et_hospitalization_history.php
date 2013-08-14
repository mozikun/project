<?php
require_once ('db_oracle.php');
/**
 *注释:住院史
 *
 *
 **/
class Tet_hospitalization_history extends dao_oracle{
	 public $__table = 'et_hospitalization_history';
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
	 * @var VARCHAR2(30)
	 **/
 	 public $created;
	 public $_created_type='varchar2';
	/**
 	 * 注释:健康体检id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $examination_id;
	 public $_examination_id_type='varchar2';
	/**
 	 * 注释:入院日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $be_hospitalized_time;
	 public $_be_hospitalized_time_type='number';
	/**
 	 * 注释:出院日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $leave_hospital_time;
	 public $_leave_hospital_time_type='number';
	/**
 	 * 注释:原因
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $reason;
	 public $_reason_type='varchar2';
	/**
 	 * 注释:医疗机构名
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $organization;
	 public $_organization_type='varchar2';
	/**
 	 * 注释:病案号
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $record_no;
	 public $_record_no_type='varchar2';
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
}
