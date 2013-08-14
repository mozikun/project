<?php
require_once ('db_oracle.php');
/**
 *注释:优惠管理
 *
 *
 **/
class Tpreferential extends dao_oracle{
	 public $__table = 'preferential';
	/**
 	 * 注释:系统唯一标识符
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $uuid;
	 public $_uuid_type='nvarchar2';
	/**
 	 * 注释:创建时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:更新时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
	/**
 	 * 注释:删除时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $deleted;
	 public $_deleted_type='number';
	/**
 	 * 注释:状态标志
	 * 
	 * 
	 * @var NVARCHAR2(8)
	 **/
 	 public $status_flag;
	 public $_status_flag_type='nvarchar2';
	/**
 	 * 注释:支付方式ID
	 * 
	 * 
	 * @var NVARCHAR2(120)
	 **/
 	 public $charge_id;
	 public $_charge_id_type='nvarchar2';
	/**
 	 * 注释:优惠比例
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $favorable_ratio;
	 public $_favorable_ratio_type='number';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $org_id;
	 public $_org_id_type='number';
}
