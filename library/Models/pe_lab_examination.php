<?php
require_once ('db_oracle.php');
/**
 *注释:婚前医学检查表-第二性征男性
 *
 *
 **/
class Tpe_lab_examination extends dao_oracle{
	 public $__table = 'pe_lab_examination';
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
 	 * 注释:检查结果
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $check_result;
	 public $_check_result_type='varchar2';
	/**
 	 * 注释:检查结果详细
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $check_result_info;
	 public $_check_result_info_type='varchar2';
	/**
 	 * 注释:医学意见|radio|1=>未发现医学上不宜结婚的情形,2=>建议暂缓结婚,3=>建议不宜生育,4=>建议不宜结婚,5=>建议采取医学措施，尊重受检者意愿
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $disease_diagnosis;
	 public $_disease_diagnosis_type='varchar2';
	/**
 	 * 注释:医学意见
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $medical_opinion;
	 public $_medical_opinion_type='varchar2';
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
