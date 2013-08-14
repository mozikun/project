<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb01_02 extends dao_oracle{
	 public $__table = 'ws_hrb01_02';
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
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_02_013;
	 public $_hrb01_02_013_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_02_015;
	 public $_hrb01_02_015_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_02_016;
	 public $_hrb01_02_016_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb01_02_017;
	 public $_hrb01_02_017_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_02_018;
	 public $_hrb01_02_018_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_02_019;
	 public $_hrb01_02_019_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_02_020;
	 public $_hrb01_02_020_type='varchar2';
	/**
 	 * 注释:标本编号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_02_021;
	 public $_hrb01_02_021_type='varchar2';
	/**
 	 * 注释:采血日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_02_022;
	 public $_hrb01_02_022_type='date';
	/**
 	 * 注释:采血方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_02_023;
	 public $_hrb01_02_023_type='varchar2';
	/**
 	 * 注释:采血部位代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_02_024;
	 public $_hrb01_02_024_type='varchar2';
	/**
 	 * 注释:采血机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb01_02_025;
	 public $_hrb01_02_025_type='varchar2';
	/**
 	 * 注释:采血人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_02_026;
	 public $_hrb01_02_026_type='varchar2';
	/**
 	 * 注释:新生儿疾病筛查项目代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_02_027;
	 public $_hrb01_02_027_type='varchar2';
	/**
 	 * 注释:新生儿疾病筛查方法代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_02_028;
	 public $_hrb01_02_028_type='varchar2';
	/**
 	 * 注释:新生儿疾病筛查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_02_029;
	 public $_hrb01_02_029_type='varchar2';
	/**
 	 * 注释:检查（测）日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_02_030;
	 public $_hrb01_02_030_type='date';
	/**
 	 * 注释:检查（测）人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_02_031;
	 public $_hrb01_02_031_type='varchar2';
	/**
 	 * 注释:检查（测）机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb01_02_032;
	 public $_hrb01_02_032_type='varchar2';
	/**
 	 * 注释:筛查结果通知日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_02_033;
	 public $_hrb01_02_033_type='date';
	/**
 	 * 注释:召回日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_02_034;
	 public $_hrb01_02_034_type='date';
	/**
 	 * 注释:检查结果通知形式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_02_035;
	 public $_hrb01_02_035_type='varchar2';
	/**
 	 * 注释:通知到达人姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_02_036;
	 public $_hrb01_02_036_type='varchar2';
	/**
 	 * 注释:通知到达人与新生儿关系代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb01_02_037;
	 public $_hrb01_02_037_type='varchar2';
	/**
 	 * 注释:通知者姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_02_038;
	 public $_hrb01_02_038_type='varchar2';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_02_039;
	 public $_hrb01_02_039_type='date';
	/**
 	 * 注释:诊断项目
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_02_040;
	 public $_hrb01_02_040_type='varchar2';
	/**
 	 * 注释:诊断方法
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_02_041;
	 public $_hrb01_02_041_type='varchar2';
	/**
 	 * 注释:诊断结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_02_042;
	 public $_hrb01_02_042_type='varchar2';
	/**
 	 * 注释:诊断机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb01_02_043;
	 public $_hrb01_02_043_type='varchar2';
	/**
 	 * 注释:新生儿姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_02_002;
	 public $_hrb01_02_002_type='varchar2';
	/**
 	 * 注释:记录表单编号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_02_001;
	 public $_hrb01_02_001_type='varchar2';
	/**
 	 * 注释:新生儿性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_02_003;
	 public $_hrb01_02_003_type='varchar2';
	/**
 	 * 注释:新生儿出生日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_02_004;
	 public $_hrb01_02_004_type='date';
	/**
 	 * 注释:母亲姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_02_005;
	 public $_hrb01_02_005_type='varchar2';
	/**
 	 * 注释:母亲出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_02_006;
	 public $_hrb01_02_006_type='date';
	/**
 	 * 注释:母亲身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_02_007;
	 public $_hrb01_02_007_type='varchar2';
	/**
 	 * 注释:母亲身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb01_02_008;
	 public $_hrb01_02_008_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_02_009;
	 public $_hrb01_02_009_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb01_02_010;
	 public $_hrb01_02_010_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_02_011;
	 public $_hrb01_02_011_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_02_012;
	 public $_hrb01_02_012_type='varchar2';
}
