<?php
require_once ('db_oracle.php');
/**
 *注释:机构扩展表2房屋和建筑
 *
 *
 **/
class Torg_ext_2 extends dao_oracle{
	 public $__table = 'org_ext_2';
	/**
 	 * 注释:机构扩展表2房屋和建筑id
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $id;
	 public $_id_type='number';
	/**
 	 * 注释:房屋建筑面积 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $area;
	 public $_area_type='number';
	/**
 	 * 注释:业务用房面积
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $operation_area;
	 public $_operation_area_type='number';
	/**
 	 * 注释:危房面积
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $peril_area;
	 public $_peril_area_type='number';
	/**
 	 * 注释:租房面积总面积
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hire_area;
	 public $_hire_area_type='number';
	/**
 	 * 注释:租房面积业务用房面积
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hire_operation_area;
	 public $_hire_operation_area_type='number';
	/**
 	 * 注释:本年批准基建项目
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $basic_build_pro;
	 public $_basic_build_pro_type='number';
	/**
 	 * 注释:本年批准基建项目建筑面积
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $basic_build_area;
	 public $_basic_build_area_type='number';
	/**
 	 * 注释:本年实际完成投资额总额
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $actual_invest;
	 public $_actual_invest_type='number';
	/**
 	 * 注释:本年新增固定资产 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $finance_invest;
	 public $_finance_invest_type='number';
	/**
 	 * 注释:单位自有资金 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $self_invest;
	 public $_self_invest_type='number';
	/**
 	 * 注释:银行贷款
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $bank_invest;
	 public $_bank_invest_type='number';
	/**
 	 * 注释:本年房屋竣工面积 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $finish_area;
	 public $_finish_area_type='number';
	/**
 	 * 注释:本年新增固定资产
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $new_fixed_assets;
	 public $_new_fixed_assets_type='number';
	/**
 	 * 注释:本年因新扩建增加床位
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $new_sickbed;
	 public $_new_sickbed_type='number';
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
