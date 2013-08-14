<?php
require_once ('db_oracle.php');
/**
 *注释:会诊记录表
 *
 *
 **/
class Tconsultation_table extends dao_oracle{
	 public $__table = 'consultation_table';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:个人ID号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:会诊原因
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $consultation_reason;
	 public $_consultation_reason_type='varchar2';
	/**
 	 * 注释:会诊意见
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $consultation_subject;
	 public $_consultation_subject_type='varchar2';
	/**
 	 * 注释:会诊医生及其所在医疗机构
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $all_org;
	 public $_all_org_type='varchar2';
	/**
 	 * 注释:医生姓名签字
	 * 
	 * 
	 * @var VARCHAR2(26)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:签字时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
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
