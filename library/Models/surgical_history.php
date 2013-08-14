<?php
require_once ('db_oracle.php');
/**
 *注释:手术史
 *
 *
 **/
class Tsurgical_history extends dao_oracle{
	 public $__table = 'surgical_history';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:同个人档案的uuid关联
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $deleted;
	 public $_deleted_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $status_flag;
	 public $_status_flag_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $syn_flag;
	 public $_syn_flag_type='varchar2';
	/**
 	 * 注释:疾病名称
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $disease;
	 public $_disease_type='varchar2';
	/**
 	 * 注释:发病日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $taken_date;
	 public $_taken_date_type='number';
	/**
 	 * 注释:确诊日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $diagnose_date;
	 public $_diagnose_date_type='number';
	/**
 	 * 注释:住院日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hospitalization_date;
	 public $_hospitalization_date_type='number';
	/**
 	 * 注释:疾病诊断
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $disease_diagnosis;
	 public $_disease_diagnosis_type='varchar2';
	/**
 	 * 注释:手术日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $operation_date;
	 public $_operation_date_type='number';
	/**
 	 * 注释:术后情况
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $after_complexion;
	 public $_after_complexion_type='varchar2';
	/**
 	 * 注释:记录所属的生命周期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $life_cycle;
	 public $_life_cycle_type='number';
	/**
 	 * 注释:手术大类
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $operation_class;
	 public $_operation_class_type='varchar2';
	/**
 	 * 注释:手术名称
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $operation_id;
	 public $_operation_id_type='varchar2';
	/**
 	 * 注释:疾病大类
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $disease_class;
	 public $_disease_class_type='varchar2';
	/**
 	 * 注释:疾病分类名称
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $disease_id;
	 public $_disease_id_type='varchar2';
	/**
 	 * 注释:疾病诊断
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $diagnosis_class;
	 public $_diagnosis_class_type='varchar2';
	/**
 	 * 注释:疾病诊断
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $diagnosis_id;
	 public $_diagnosis_id_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $filing_time;
	 public $_filing_time_type='number';
	/**
 	 * 注释:扩展UUID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
}
