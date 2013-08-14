<?php
require_once ('db_oracle.php');
/**
 *注释:机构扩展表6机构资源
 *
 *
 **/
class Torg_ext_6 extends dao_oracle{
	 public $__table = 'org_ext_6';
	/**
 	 * 注释:机构扩展表6机构资源id
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $id;
	 public $_id_type='number';
	/**
 	 * 注释:占地面积 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $area;
	 public $_area_type='number';
	/**
 	 * 注释:床位数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sickbed_number;
	 public $_sickbed_number_type='number';
	/**
 	 * 注释:病床使用率
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sickbed_use_rate;
	 public $_sickbed_use_rate_type='number';
	/**
 	 * 注释:年诊疗量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $outpatient_per_year;
	 public $_outpatient_per_year_type='number';
	/**
 	 * 注释:年门诊量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emergency_per_year;
	 public $_emergency_per_year_type='number';
	/**
 	 * 注释:年急诊量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $iatrology_man_count;
	 public $_iatrology_man_count_type='number';
	/**
 	 * 注释:医技人员数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $gp_team_count;
	 public $_gp_team_count_type='number';
	/**
 	 * 注释:社区医生数 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $gp_count;
	 public $_gp_count_type='number';
	/**
 	 * 注释:社区护士数 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $community_nurse_count;
	 public $_community_nurse_count_type='number';
	/**
 	 * 注释:每位医生服务人数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $residenter_per_gp;
	 public $_residenter_per_gp_type='number';
	/**
 	 * 注释:每位护士服务人数 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $residenter_per_nurse;
	 public $_residenter_per_nurse_type='number';
	/**
 	 * 注释:科室设置 
	 * 
	 * 
	 * @var VARCHAR2(500)
	 **/
 	 public $officesetting;
	 public $_officesetting_type='varchar2';
	/**
 	 * 注释:提供的服务
	 * 
	 * 
	 * @var VARCHAR2(500)
	 **/
 	 public $service_setting;
	 public $_service_setting_type='varchar2';
	/**
 	 * 注释:设备
	 * 
	 * 
	 * @var VARCHAR2(500)
	 **/
 	 public $equipment_setting;
	 public $_equipment_setting_type='varchar2';
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
