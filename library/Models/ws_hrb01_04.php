<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb01_04 extends dao_oracle{
	 public $__table = 'ws_hrb01_04';
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
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_04_002;
	 public $_hrb01_04_002_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_04_003;
	 public $_hrb01_04_003_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_04_004;
	 public $_hrb01_04_004_type='date';
	/**
 	 * 注释:母亲姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_04_005;
	 public $_hrb01_04_005_type='varchar2';
	/**
 	 * 注释:父亲姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_04_006;
	 public $_hrb01_04_006_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_04_007;
	 public $_hrb01_04_007_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb01_04_008;
	 public $_hrb01_04_008_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_04_009;
	 public $_hrb01_04_009_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_04_010;
	 public $_hrb01_04_010_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_04_011;
	 public $_hrb01_04_011_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_04_013;
	 public $_hrb01_04_013_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_04_014;
	 public $_hrb01_04_014_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb01_04_015;
	 public $_hrb01_04_015_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_04_016;
	 public $_hrb01_04_016_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_04_017;
	 public $_hrb01_04_017_type='varchar2';
	/**
 	 * 注释:喂养方式类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_04_019;
	 public $_hrb01_04_019_type='varchar2';
	/**
 	 * 注释:随诊月龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_04_020;
	 public $_hrb01_04_020_type='number';
	/**
 	 * 注释:儿童体弱原因类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb01_04_021;
	 public $_hrb01_04_021_type='varchar2';
	/**
 	 * 注释:症状
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_04_022;
	 public $_hrb01_04_022_type='varchar2';
	/**
 	 * 注释:体征
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_04_023;
	 public $_hrb01_04_023_type='varchar2';
	/**
 	 * 注释:辅助检查-项目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_04_024;
	 public $_hrb01_04_024_type='varchar2';
	/**
 	 * 注释:辅助检查-结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_04_025;
	 public $_hrb01_04_025_type='varchar2';
	/**
 	 * 注释:处理及指导意见
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_04_026;
	 public $_hrb01_04_026_type='varchar2';
	/**
 	 * 注释:预约日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_04_027;
	 public $_hrb01_04_027_type='date';
	/**
 	 * 注释:检查（测）日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_04_028;
	 public $_hrb01_04_028_type='date';
	/**
 	 * 注释:检查（测）人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_04_029;
	 public $_hrb01_04_029_type='varchar2';
	/**
 	 * 注释:检查（测）机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb01_04_030;
	 public $_hrb01_04_030_type='varchar2';
	/**
 	 * 注释:体弱儿童转归代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_04_031;
	 public $_hrb01_04_031_type='varchar2';
	/**
 	 * 注释:结案日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_04_032;
	 public $_hrb01_04_032_type='date';
	/**
 	 * 注释:结案医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_04_033;
	 public $_hrb01_04_033_type='varchar2';
	/**
 	 * 注释:结案单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb01_04_034;
	 public $_hrb01_04_034_type='varchar2';
	/**
 	 * 注释:建档日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_04_035;
	 public $_hrb01_04_035_type='date';
	/**
 	 * 注释:记录表单编号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_04_001;
	 public $_hrb01_04_001_type='varchar2';
}
