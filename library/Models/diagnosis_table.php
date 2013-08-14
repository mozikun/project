<?php
require_once ('db_oracle.php');
/**
 *注释:接诊记录表
 *
 *
 **/
class Tdiagnosis_table extends dao_oracle{
	 public $__table = 'diagnosis_table';
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
 	 public $iha_id;
	 public $_iha_id_type='varchar2';
	/**
 	 * 注释:就诊者的主观资料
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $subjective_data;
	 public $_subjective_data_type='varchar2';
	/**
 	 * 注释:就诊者的客观资料
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $objective_data;
	 public $_objective_data_type='varchar2';
	/**
 	 * 注释:评估
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $assessment;
	 public $_assessment_type='varchar2';
	/**
 	 * 注释:处置计划
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $disposal_plan;
	 public $_disposal_plan_type='varchar2';
	/**
 	 * 注释:医生姓名签字
	 * 
	 * 
	 * @var VARCHAR2(26)
	 **/
 	 public $doctor_name;
	 public $_doctor_name_type='varchar2';
	/**
 	 * 注释:签字时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $current_time;
	 public $_current_time_type='number';
	/**
 	 * 注释:个人ID号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
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
