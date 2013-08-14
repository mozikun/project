<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tdrug_factory extends dao_oracle{
	 public $__table = 'drug_factory';
	/**
 	 * 注释:唯一标识符|TEXT
	 * 
	 * 
	 * @var NCHAR(60)
	 **/
 	 public $uuid;
	 public $_uuid_type='nchar';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var NCHAR(60)
	 **/
 	 public $org_id;
	 public $_org_id_type='nchar';
	/**
 	 * 注释:医生代码|TEXT
	 * 
	 * 
	 * @var NCHAR(60)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='nchar';
	/**
 	 * 注释:创建时间|TEXT
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:修改时间|TEXT
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
	/**
 	 * 注释:厂家名称
	 * 
	 * 
	 * @var NVARCHAR2(500)
	 **/
 	 public $factory_name;
	 public $_factory_name_type='nvarchar2';
	/**
 	 * 注释:FACTORY_NAME_PINYIN
	 * 
	 * 
	 * @var NCHAR(510)
	 **/
 	 public $factory_name_pinyin;
	 public $_factory_name_pinyin_type='nchar';
	/**
 	 * 注释:厂家地址 
	 * 
	 * 
	 * @var NVARCHAR2(500)
	 **/
 	 public $factory_address;
	 public $_factory_address_type='nvarchar2';
	/**
 	 * 注释:厂家说明
	 * 
	 * 
	 * @var NVARCHAR2(500)
	 **/
 	 public $factory_note;
	 public $_factory_note_type='nvarchar2';
	/**
 	 * 注释:厂家电话
	 * 
	 * 
	 * @var NVARCHAR2(50)
	 **/
 	 public $factory_phone;
	 public $_factory_phone_type='nvarchar2';
}
