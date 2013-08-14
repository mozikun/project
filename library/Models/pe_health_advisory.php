<?php
require_once ('db_oracle.php');
/**
 *注释:婚前医学检查表-婚前卫生咨询
 *
 *
 **/
class Tpe_health_advisory extends dao_oracle{
	 public $__table = 'pe_health_advisory';
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
 	 * 注释:婚前卫生咨询
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $health_advisory;
	 public $_health_advisory_type='varchar2';
	/**
 	 * 注释:咨询指导结果|radio|1=>接受指导意见,2=>不接受指导意见，知情后选择结婚，后果自己承担
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $counseling_results;
	 public $_counseling_results_type='varchar2';
	/**
 	 * 注释:医师签名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $signature_of_doctor;
	 public $_signature_of_doctor_type='varchar2';
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
