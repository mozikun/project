<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class T雅安市雨城区人民医院月度指标 extends dao_oracle{
	 public $__table = '雅安市雨城区人民医院月度指标';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(7)
	 **/
 	 public $时间;
	 public $_时间_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(20)
	 **/
 	 public $雅安市雨城区人民医院;
	 public $_雅安市雨城区人民医院_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $日门诊量;
	 public $_日门诊量_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $日急诊量;
	 public $_日急诊量_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $日专家量;
	 public $_日专家量_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $手术台次;
	 public $_手术台次_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $出院人数;
	 public $_出院人数_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $人均住院日;
	 public $_人均住院日_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $诊断符合率;
	 public $_诊断符合率_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $甲级愈合率;
	 public $_甲级愈合率_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $门诊例均费用;
	 public $_门诊例均费用_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $门诊检查费用比率;
	 public $_门诊检查费用比率_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $住院例均费用;
	 public $_住院例均费用_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $住院检查费比率;
	 public $_住院检查费比率_type='number';
}
