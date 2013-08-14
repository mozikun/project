<?php
require_once ('db_oracle.php');
/**
 *注释:坐诊字典表
 *
 *
 **/
class Tzuozhen_dictionary extends dao_oracle{
	 public $__table = 'zuozhen_dictionary';
	/**
 	 * 注释:编号
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $uuid;
	 public $_uuid_type='nvarchar2';
	/**
 	 * 注释:医护人员id
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $user_id;
	 public $_user_id_type='nvarchar2';
	/**
 	 * 注释:添加记录时间
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $created;
	 public $_created_type='nvarchar2';
	/**
 	 * 注释:日|radio|1=>上午,2=>下午,3=>全天
	 * 
	 * 
	 * @var NVARCHAR2(20)
	 **/
 	 public $day;
	 public $_day_type='nvarchar2';
	/**
 	 * 注释:总挂号数
	 * 
	 * 
	 * @var NVARCHAR2(40)
	 **/
 	 public $register_num_total;
	 public $_register_num_total_type='nvarchar2';
	/**
 	 * 注释:网络挂号数
	 * 
	 * 
	 * @var NVARCHAR2(40)
	 **/
 	 public $register_num_net;
	 public $_register_num_net_type='nvarchar2';
	/**
 	 * 注释:挂号费
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $registration_fee;
	 public $_registration_fee_type='nvarchar2';
	/**
 	 * 注释:诊疗费
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $medical_fees;
	 public $_medical_fees_type='nvarchar2';
	/**
 	 * 注释:手续费
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $fee;
	 public $_fee_type='nvarchar2';
	/**
 	 * 注释:状态|radio|1=>停用,2=>开放
	 * 
	 * 
	 * @var NVARCHAR2(20)
	 **/
 	 public $flag;
	 public $_flag_type='nvarchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $org_id;
	 public $_org_id_type='nvarchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(100)
	 **/
 	 public $week;
	 public $_week_type='nvarchar2';
	/**
 	 * 注释:号种
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $number_species;
	 public $_number_species_type='varchar2';
	/**
 	 * 注释:科室
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $department;
	 public $_department_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $clinic;
	 public $_clinic_type='varchar2';
}
