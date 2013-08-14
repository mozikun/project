<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb02_05 extends dao_oracle{
	 public $__table = 'ws_hrb02_05';
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
 	 public $hrb02_05_001;
	 public $_hrb02_05_001_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_05_002;
	 public $_hrb02_05_002_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_05_003;
	 public $_hrb02_05_003_type='date';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_05_004;
	 public $_hrb02_05_004_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb02_05_005;
	 public $_hrb02_05_005_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_05_006;
	 public $_hrb02_05_006_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb02_05_007;
	 public $_hrb02_05_007_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_05_008;
	 public $_hrb02_05_008_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_05_009;
	 public $_hrb02_05_009_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_05_010;
	 public $_hrb02_05_010_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_05_012;
	 public $_hrb02_05_012_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_05_013;
	 public $_hrb02_05_013_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb02_05_014;
	 public $_hrb02_05_014_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_05_015;
	 public $_hrb02_05_015_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_05_016;
	 public $_hrb02_05_016_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_05_017;
	 public $_hrb02_05_017_type='varchar2';
	/**
 	 * 注释:体重（kg）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_05_018;
	 public $_hrb02_05_018_type='number';
	/**
 	 * 注释:产前筛查孕周
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_05_019;
	 public $_hrb02_05_019_type='number';
	/**
 	 * 注释:产前筛查项目
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_05_020;
	 public $_hrb02_05_020_type='varchar2';
	/**
 	 * 注释:产前筛查方法代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_05_021;
	 public $_hrb02_05_021_type='varchar2';
	/**
 	 * 注释:产前筛查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_05_022;
	 public $_hrb02_05_022_type='varchar2';
	/**
 	 * 注释:产前诊断孕周
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_05_023;
	 public $_hrb02_05_023_type='number';
	/**
 	 * 注释:诊断项目
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_05_024;
	 public $_hrb02_05_024_type='varchar2';
	/**
 	 * 注释:诊断方法
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_05_025;
	 public $_hrb02_05_025_type='varchar2';
	/**
 	 * 注释:诊断结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_05_026;
	 public $_hrb02_05_026_type='varchar2';
	/**
 	 * 注释:产前诊断医学意见
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_05_027;
	 public $_hrb02_05_027_type='varchar2';
	/**
 	 * 注释:妊娠结局
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb02_05_028;
	 public $_hrb02_05_028_type='varchar2';
	/**
 	 * 注释:检查（测）日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_05_029;
	 public $_hrb02_05_029_type='date';
	/**
 	 * 注释:产前筛查医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_05_030;
	 public $_hrb02_05_030_type='varchar2';
	/**
 	 * 注释:产前筛查机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_05_031;
	 public $_hrb02_05_031_type='varchar2';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_05_032;
	 public $_hrb02_05_032_type='date';
	/**
 	 * 注释:产前诊断医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_05_033;
	 public $_hrb02_05_033_type='varchar2';
	/**
 	 * 注释:诊断机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_05_034;
	 public $_hrb02_05_034_type='varchar2';
}
