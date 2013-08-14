<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb03_11 extends dao_oracle{
	 public $__table = 'ws_hrb03_11';
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
 	 public $hrb03_11_001;
	 public $_hrb03_11_001_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_11_002;
	 public $_hrb03_11_002_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_11_003;
	 public $_hrb03_11_003_type='date';
	/**
 	 * 注释:职业类别代码(国标)
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb03_11_004;
	 public $_hrb03_11_004_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_11_005;
	 public $_hrb03_11_005_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_11_006;
	 public $_hrb03_11_006_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_11_007;
	 public $_hrb03_11_007_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_11_008;
	 public $_hrb03_11_008_type='varchar2';
	/**
 	 * 注释:地址-乡（镇、街道办事处）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_11_009;
	 public $_hrb03_11_009_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_11_010;
	 public $_hrb03_11_010_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_11_011;
	 public $_hrb03_11_011_type='varchar2';
	/**
 	 * 注释:民族代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_11_012;
	 public $_hrb03_11_012_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_11_013;
	 public $_hrb03_11_013_type='varchar2';
	/**
 	 * 注释:文化程度代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_11_014;
	 public $_hrb03_11_014_type='varchar2';
	/**
 	 * 注释:吸烟频率代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_11_015;
	 public $_hrb03_11_015_type='varchar2';
	/**
 	 * 注释:开始每天吸烟年龄（岁）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_11_016;
	 public $_hrb03_11_016_type='number';
	/**
 	 * 注释:开始吸烟年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_11_017;
	 public $_hrb03_11_017_type='number';
	/**
 	 * 注释:吸食烟草种类代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_11_018;
	 public $_hrb03_11_018_type='varchar2';
	/**
 	 * 注释:日吸烟量(支)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_11_019;
	 public $_hrb03_11_019_type='number';
	/**
 	 * 注释:停止吸烟时长（d）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_11_020;
	 public $_hrb03_11_020_type='number';
	/**
 	 * 注释:戒烟方法类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_11_021;
	 public $_hrb03_11_021_type='varchar2';
	/**
 	 * 注释:接触二手烟代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_11_022;
	 public $_hrb03_11_022_type='varchar2';
	/**
 	 * 注释:接触二手烟天数（d）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_11_023;
	 public $_hrb03_11_023_type='number';
	/**
 	 * 注释:被动吸烟场所类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_11_024;
	 public $_hrb03_11_024_type='varchar2';
	/**
 	 * 注释:饮酒频率代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_11_025;
	 public $_hrb03_11_025_type='varchar2';
	/**
 	 * 注释:饮酒种类代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_11_026;
	 public $_hrb03_11_026_type='varchar2';
	/**
 	 * 注释:日饮酒量(两)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_11_027;
	 public $_hrb03_11_027_type='number';
	/**
 	 * 注释:饮酒标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_11_028;
	 public $_hrb03_11_028_type='number';
	/**
 	 * 注释:开始饮酒年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_11_029;
	 public $_hrb03_11_029_type='number';
	/**
 	 * 注释:饮食种类代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_11_030;
	 public $_hrb03_11_030_type='varchar2';
	/**
 	 * 注释:饮食频率（次/天）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_11_031;
	 public $_hrb03_11_031_type='number';
	/**
 	 * 注释:身体活动类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_11_032;
	 public $_hrb03_11_032_type='varchar2';
	/**
 	 * 注释:身体活动强度分类代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_11_033;
	 public $_hrb03_11_033_type='varchar2';
	/**
 	 * 注释:身体活动频率代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_11_034;
	 public $_hrb03_11_034_type='varchar2';
	/**
 	 * 注释:步行或骑自行车累计时长（min）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_11_035;
	 public $_hrb03_11_035_type='number';
	/**
 	 * 注释:日静态行为时长（min）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_11_036;
	 public $_hrb03_11_036_type='number';
	/**
 	 * 注释:中午及其他时间睡眠时长（min）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_11_037;
	 public $_hrb03_11_037_type='number';
	/**
 	 * 注释:晚上睡眠时长（min）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_11_038;
	 public $_hrb03_11_038_type='number';
}
