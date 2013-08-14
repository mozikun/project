<?php
require_once ('db_oracle.php');
/**
 *注释:区域扩展表
 *
 *
 **/
class Tregion_ext_1 extends dao_oracle{
	 public $__table = 'region_ext_1';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $region_id;
	 public $_region_id_type='number';
	/**
 	 * 注释:年度
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $region_year;
	 public $_region_year_type='number';
	/**
 	 * 注释:唯一标志
	 * 
	 * 
	 * @var NVARCHAR2(50)
	 **/
 	 public $uuid;
	 public $_uuid_type='nvarchar2';
	/**
 	 * 注释:人口总数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $population;
	 public $_population_type='number';
	/**
 	 * 注释:城市人口
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $urban_population;
	 public $_urban_population_type='number';
	/**
 	 * 注释:农业人口
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $agral_population;
	 public $_agral_population_type='number';
	/**
 	 * 注释:地理面积
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $graph_area;
	 public $_graph_area_type='number';
}
