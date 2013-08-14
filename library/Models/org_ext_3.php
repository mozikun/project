<?php
require_once ('db_oracle.php');
/**
 *注释:机构扩展表3设备信息
 *
 *
 **/
class Torg_ext_3 extends dao_oracle{
	 public $__table = 'org_ext_3';
	/**
 	 * 注释:设备信息id
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $id;
	 public $_id_type='number';
	/**
 	 * 注释:万元以上设备总价值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $equipment_total_value;
	 public $_equipment_total_value_type='number';
	/**
 	 * 注释:万元以上设备总数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $equipment_total_number;
	 public $_equipment_total_number_type='number';
	/**
 	 * 注释:50-100万元设备数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $five_equipment;
	 public $_five_equipment_type='number';
	/**
 	 * 注释:100万元以上设备数 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $over_100_equipment;
	 public $_over_100_equipment_type='number';
	/**
 	 * 注释:年份
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $year;
	 public $_year_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
}
