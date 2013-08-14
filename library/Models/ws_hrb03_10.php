<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb03_10 extends dao_oracle{
	 public $__table = 'ws_hrb03_10';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ws_id;
	 public $_ws_id_type='number';
	/**
 	 * 注释:主键
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:创建时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:医生
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $doctor_id;
	 public $_doctor_id_type='varchar2';
	/**
 	 * 注释:动作
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $action;
	 public $_action_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:身份证号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $identity_number;
	 public $_identity_number_type='varchar2';
	/**
 	 * 注释:记录表单编号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_10_001;
	 public $_hrb03_10_001_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_10_002;
	 public $_hrb03_10_002_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_10_003;
	 public $_hrb03_10_003_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_10_004;
	 public $_hrb03_10_004_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb03_10_005;
	 public $_hrb03_10_005_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_10_006;
	 public $_hrb03_10_006_type='date';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_10_007;
	 public $_hrb03_10_007_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb03_10_008;
	 public $_hrb03_10_008_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_10_009;
	 public $_hrb03_10_009_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_10_010;
	 public $_hrb03_10_010_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_10_011;
	 public $_hrb03_10_011_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_10_013;
	 public $_hrb03_10_013_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_10_014;
	 public $_hrb03_10_014_type='varchar2';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_10_015;
	 public $_hrb03_10_015_type='date';
	/**
 	 * 注释:中毒农药名称代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_10_016;
	 public $_hrb03_10_016_type='varchar2';
	/**
 	 * 注释:农药中毒类型代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_10_017;
	 public $_hrb03_10_017_type='varchar2';
	/**
 	 * 注释:农药中毒转归代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_10_018;
	 public $_hrb03_10_018_type='varchar2';
}
