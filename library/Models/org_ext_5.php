<?php
require_once ('db_oracle.php');
/**
 *注释:机构扩展表5资产和负债
 *
 *
 **/
class Torg_ext_5 extends dao_oracle{
	 public $__table = 'org_ext_5';
	/**
 	 * 注释:机构扩展表5资产和负债id
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $id;
	 public $_id_type='number';
	/**
 	 * 注释:总资产合计 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $total_assets;
	 public $_total_assets_type='number';
	/**
 	 * 注释:流动资产
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $current_assets;
	 public $_current_assets_type='number';
	/**
 	 * 注释:对外投资
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $invest;
	 public $_invest_type='number';
	/**
 	 * 注释:固定资产
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $capital_asserts;
	 public $_capital_asserts_type='number';
	/**
 	 * 注释:无形资产及开办费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $immateriality_assets;
	 public $_immateriality_assets_type='number';
	/**
 	 * 注释:负债合计
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $owes_assets;
	 public $_owes_assets_type='number';
	/**
 	 * 注释:长期负债
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $long_standing_assets;
	 public $_long_standing_assets_type='number';
	/**
 	 * 注释:净资产合计 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $net_assets;
	 public $_net_assets_type='number';
	/**
 	 * 注释:事业基金 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $project_assets;
	 public $_project_assets_type='number';
	/**
 	 * 注释:固定基金
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $fixed_assets;
	 public $_fixed_assets_type='number';
	/**
 	 * 注释:专用基金 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $special_assets;
	 public $_special_assets_type='number';
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
