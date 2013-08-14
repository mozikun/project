<?php
require_once ('db_oracle.php');
/**
 *注释:手術史
 *
 *
 **/
class Tet_operation_history extends dao_oracle{
	 public $__table = 'et_operation_history';
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
 	 * 注释:建床日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $put_bed_time;
	 public $_put_bed_time_type='number';
	/**
 	 * 注释:撤床日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $receive_bed_time;
	 public $_receive_bed_time_type='number';
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
