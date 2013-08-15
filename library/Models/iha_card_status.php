<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tiha_card_status extends dao_oracle{
	 public $__table = 'iha_card_status';
	/**
 	 * 注释:唯一标识符
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:医生id号
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:机构号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $org_id;
	 public $_org_id_type='number';
	/**
 	 * 注释:当前科室ID 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $department_id;
	 public $_department_id_type='number';
	/**
 	 * 注释:当前科室名称
	 * 
	 * 
	 * @var VARCHAR2(500)
	 **/
 	 public $department_name;
	 public $_department_name_type='varchar2';
	/**
 	 * 注释:当前行为描述，描述患者当前正在进行的活动
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $actions;
	 public $_actions_type='varchar2';
	/**
 	 * 注释:门诊就诊流水号
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $serial_number;
	 public $_serial_number_type='varchar2';
	/**
 	 * 注释:业务号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
	/**
 	 * 注释:病人身份证号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $identity_number;
	 public $_identity_number_type='varchar2';
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
 	 * 注释:患者状态标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $status;
	 public $_status_type='number';
}
