<?php
require_once ('db_oracle.php');
/**
 *注释:输血史
 *
 *
 **/
class Ttransfusion extends dao_oracle{
	 public $__table = 'transfusion';
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
 	 * 注释:输血时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $transfusion_date;
	 public $_transfusion_date_type='number';
	/**
 	 * 注释:输血地点
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $transfusion_place;
	 public $_transfusion_place_type='varchar2';
	/**
 	 * 注释:输血情况
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $quantity;
	 public $_quantity_type='varchar2';
	/**
 	 * 注释:输血规律性
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $regularly;
	 public $_regularly_type='varchar2';
	/**
 	 * 注释:记录所属的生命周期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $life_cycle;
	 public $_life_cycle_type='number';
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
