<?php
require_once ('db_oracle.php');
/**
 *注释:婚前医学检查证明
 *
 *
 **/
class Tcertificate_premartial_exam extends dao_oracle{
	 public $__table = 'certificate_premartial_exam';
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
 	 * 注释:对方姓名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $partner_name;
	 public $_partner_name_type='varchar2';
	/**
 	 * 注释:直系、三代内旁系血亲关系
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $blood_kinship;
	 public $_blood_kinship_type='varchar2';
	/**
 	 * 注释:婚前医学检查结果
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $result_of_premarital_exam;
	 public $_result_of_premarital_exam_type='varchar2';
	/**
 	 * 注释:医学意见
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $medical_opinion;
	 public $_medical_opinion_type='varchar2';
	/**
 	 * 注释:主任医生签字医生ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $signature_of_doctor;
	 public $_signature_of_doctor_type='varchar2';
	/**
 	 * 注释:登记时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $record_time;
	 public $_record_time_type='number';
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
