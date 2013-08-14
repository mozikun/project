<?php
require_once ('db_oracle.php');
/**
 *注释:号种维护表
 *
 *
 **/
class Tnumber_species extends dao_oracle{
	 public $__table = 'number_species';
	/**
 	 * 注释:系统唯一标识符
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $uuid;
	 public $_uuid_type='nvarchar2';
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
 	 * 注释:删除时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $deleted;
	 public $_deleted_type='number';
	/**
 	 * 注释:状态标志
	 * 
	 * 
	 * @var NVARCHAR2(8)
	 **/
 	 public $status_flag;
	 public $_status_flag_type='nvarchar2';
	/**
 	 * 注释:号种名称
	 * 
	 * 
	 * @var NVARCHAR2(120)
	 **/
 	 public $no_species_name;
	 public $_no_species_name_type='nvarchar2';
	/**
 	 * 注释:挂号费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $registration_fee;
	 public $_registration_fee_type='number';
	/**
 	 * 注释:诊疗费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $medical_fee;
	 public $_medical_fee_type='number';
	/**
 	 * 注释:服务费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $service_fee;
	 public $_service_fee_type='number';
	/**
 	 * 注释:附加费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $surcharge;
	 public $_surcharge_type='number';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $org_id;
	 public $_org_id_type='number';
	/**
 	 * 注释:排序号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sort_number;
	 public $_sort_number_type='number';
}
