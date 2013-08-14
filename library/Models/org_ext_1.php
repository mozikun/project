<?php
require_once ('db_oracle.php');
/**
 *注释:机构扩展表1
 *
 *
 **/
class Torg_ext_1 extends dao_oracle{
	 public $__table = 'org_ext_1';
	/**
 	 * 注释:机构扩展表id
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $id;
	 public $_id_type='number';
	/**
 	 * 注释:编制床位数 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $bed_number;
	 public $_bed_number_type='number';
	/**
 	 * 注释:实有床位数总数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $bed_allnumber;
	 public $_bed_allnumber_type='number';
	/**
 	 * 注释:扶贫床位
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $poverty_beds;
	 public $_poverty_beds_type='number';
	/**
 	 * 注释:实际开放总床日数 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $totalbed_days;
	 public $_totalbed_days_type='number';
	/**
 	 * 注释:实际占用床日数总数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $occupied_bed;
	 public $_occupied_bed_type='number';
	/**
 	 * 注释:扶贫床位占用床日数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $poverty_occupiedbed;
	 public $_poverty_occupiedbed_type='number';
	/**
 	 * 注释:出院者占用总床日数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tbo_total;
	 public $_tbo_total_type='number';
	/**
 	 * 注释:观察床
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $observation_bed;
	 public $_observation_bed_type='number';
	/**
 	 * 注释:全年开设家庭病床总数 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $family_beds;
	 public $_family_beds_type='number';
	/**
 	 * 注释:病床使用率
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $percentage;
	 public $_percentage_type='varchar2';
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
