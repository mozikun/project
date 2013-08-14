<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb03_01 extends dao_oracle{
	 public $__table = 'ws_hrb03_01';
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
 	 public $hrb03_01_001;
	 public $_hrb03_01_001_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_01_002;
	 public $_hrb03_01_002_type='date';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_01_003;
	 public $_hrb03_01_003_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_01_004;
	 public $_hrb03_01_004_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb03_01_005;
	 public $_hrb03_01_005_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_01_006;
	 public $_hrb03_01_006_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_01_007;
	 public $_hrb03_01_007_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_01_008;
	 public $_hrb03_01_008_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_01_009;
	 public $_hrb03_01_009_type='varchar2';
	/**
 	 * 注释:地址-乡（镇、街道办事处）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_01_010;
	 public $_hrb03_01_010_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_01_011;
	 public $_hrb03_01_011_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_01_012;
	 public $_hrb03_01_012_type='varchar2';
	/**
 	 * 注释:出生医学证明编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hrb03_01_013;
	 public $_hrb03_01_013_type='varchar2';
	/**
 	 * 注释:父亲姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_01_014;
	 public $_hrb03_01_014_type='varchar2';
	/**
 	 * 注释:母亲姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_01_015;
	 public $_hrb03_01_015_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_01_016;
	 public $_hrb03_01_016_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_01_017;
	 public $_hrb03_01_017_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_01_018;
	 public $_hrb03_01_018_type='varchar2';
	/**
 	 * 注释:过敏症状
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_01_019;
	 public $_hrb03_01_019_type='varchar2';
	/**
 	 * 注释:过敏原
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_01_020;
	 public $_hrb03_01_020_type='varchar2';
	/**
 	 * 注释:疫苗接种者姓名 
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_01_021;
	 public $_hrb03_01_021_type='varchar2';
	/**
 	 * 注释:疫苗接种单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_01_022;
	 public $_hrb03_01_022_type='varchar2';
	/**
 	 * 注释:疫苗接种日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_01_023;
	 public $_hrb03_01_023_type='date';
	/**
 	 * 注释:免疫类型代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_01_024;
	 public $_hrb03_01_024_type='varchar2';
	/**
 	 * 注释:疫苗-名称代码
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $hrb03_01_025;
	 public $_hrb03_01_025_type='varchar2';
	/**
 	 * 注释:疫苗-批号
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_01_026;
	 public $_hrb03_01_026_type='varchar2';
	/**
 	 * 注释:疫苗生产厂家代码
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_01_027;
	 public $_hrb03_01_027_type='varchar2';
	/**
 	 * 注释:引起预防接种后不良反应的可疑疫苗名称代码
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $hrb03_01_028;
	 public $_hrb03_01_028_type='varchar2';
	/**
 	 * 注释:预防接种后不良反应症状代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_01_029;
	 public $_hrb03_01_029_type='varchar2';
	/**
 	 * 注释:预防接种后不良反应发生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_01_030;
	 public $_hrb03_01_030_type='date';
	/**
 	 * 注释:预防接种后不良反应处理结果
	 * 
	 * 
	 * @var VARCHAR2(3000)
	 **/
 	 public $hrb03_01_031;
	 public $_hrb03_01_031_type='varchar2';
}
