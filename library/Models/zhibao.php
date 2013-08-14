<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tzhibao extends dao_oracle{
	 public $__table = 'zhibao';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:发生地点
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $adress;
	 public $_adress_type='varchar2';
	/**
 	 * 注释:创建时间
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $created;
	 public $_created_type='varchar2';
	/**
 	 * 注释:发生时间
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $fasheng_time;
	 public $_fasheng_time_type='varchar2';
	/**
 	 * 注释:报告时间
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $baogao_time;
	 public $_baogao_time_type='varchar2';
	/**
 	 * 注释:事件内容
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $shijian;
	 public $_shijian_type='varchar2';
	/**
 	 * 注释:受伤人数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $shoushang_nums;
	 public $_shoushang_nums_type='number';
	/**
 	 * 注释:死亡人数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $die_nums;
	 public $_die_nums_type='number';
	/**
 	 * 注释:事件类型，1等待救援，2救援中，3救援完成
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $leixing;
	 public $_leixing_type='varchar2';
}
