<?php
require_once ('db_oracle.php');
/**
 *注释:非免疫规划预防接种史
 *
 *
 **/
class Tet_nonepi_vaccination extends dao_oracle{
	 public $__table = 'et_nonepi_vaccination';
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
	 * @var VARCHAR2(30)
	 **/
 	 public $created;
	 public $_created_type='varchar2';
	/**
 	 * 注释:健康体检id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $examination_id;
	 public $_examination_id_type='varchar2';
	/**
 	 * 注释:名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $vaccination_name;
	 public $_vaccination_name_type='varchar2';
	/**
 	 * 注释:接种日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $vaccination_time;
	 public $_vaccination_time_type='number';
	/**
 	 * 注释:接种机构
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $vaccination_org;
	 public $_vaccination_org_type='varchar2';
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
