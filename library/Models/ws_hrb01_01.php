<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb01_01 extends dao_oracle{
	 public $__table = 'ws_hrb01_01';
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
 	 * 注释:出生医学证明编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hrb01_01_001;
	 public $_hrb01_01_001_type='varchar2';
	/**
 	 * 注释:新生儿姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_01_002;
	 public $_hrb01_01_002_type='varchar2';
	/**
 	 * 注释:新生儿性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_01_003;
	 public $_hrb01_01_003_type='varchar2';
	/**
 	 * 注释:新生儿出生日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_01_004;
	 public $_hrb01_01_004_type='date';
	/**
 	 * 注释:出生地
	 * 
	 * 
	 * @var VARCHAR2(360)
	 **/
 	 public $hrb01_01_005;
	 public $_hrb01_01_005_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_01_006;
	 public $_hrb01_01_006_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb01_01_007;
	 public $_hrb01_01_007_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_01_008;
	 public $_hrb01_01_008_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_01_009;
	 public $_hrb01_01_009_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_01_010;
	 public $_hrb01_01_010_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_01_012;
	 public $_hrb01_01_012_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_01_013;
	 public $_hrb01_01_013_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb01_01_014;
	 public $_hrb01_01_014_type='varchar2';
	/**
 	 * 注释:出生地点类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_01_015;
	 public $_hrb01_01_015_type='varchar2';
	/**
 	 * 注释:新生儿健康状况代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_01_016;
	 public $_hrb01_01_016_type='varchar2';
	/**
 	 * 注释:出生孕周
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_01_017;
	 public $_hrb01_01_017_type='number';
	/**
 	 * 注释:出生身长（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_01_018;
	 public $_hrb01_01_018_type='number';
	/**
 	 * 注释:出生体重（g）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_01_019;
	 public $_hrb01_01_019_type='number';
	/**
 	 * 注释:母亲姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_01_020;
	 public $_hrb01_01_020_type='varchar2';
	/**
 	 * 注释:母亲国籍代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb01_01_021;
	 public $_hrb01_01_021_type='varchar2';
	/**
 	 * 注释:母亲民族代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb01_01_022;
	 public $_hrb01_01_022_type='varchar2';
	/**
 	 * 注释:母亲身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_01_023;
	 public $_hrb01_01_023_type='varchar2';
	/**
 	 * 注释:母亲身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb01_01_024;
	 public $_hrb01_01_024_type='varchar2';
	/**
 	 * 注释:父亲姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_01_025;
	 public $_hrb01_01_025_type='varchar2';
	/**
 	 * 注释:父亲国籍代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb01_01_026;
	 public $_hrb01_01_026_type='varchar2';
	/**
 	 * 注释:父亲民族代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb01_01_027;
	 public $_hrb01_01_027_type='varchar2';
	/**
 	 * 注释:父亲身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_01_028;
	 public $_hrb01_01_028_type='varchar2';
	/**
 	 * 注释:父亲身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb01_01_029;
	 public $_hrb01_01_029_type='varchar2';
	/**
 	 * 注释:助产人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_01_030;
	 public $_hrb01_01_030_type='varchar2';
	/**
 	 * 注释:助产机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb01_01_031;
	 public $_hrb01_01_031_type='varchar2';
	/**
 	 * 注释:签发日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_01_032;
	 public $_hrb01_01_032_type='date';
	/**
 	 * 注释:签证机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb01_01_033;
	 public $_hrb01_01_033_type='varchar2';
}
