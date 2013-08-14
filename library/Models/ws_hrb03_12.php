<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb03_12 extends dao_oracle{
	 public $__table = 'ws_hrb03_12';
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
 	 public $hrb03_12_001;
	 public $_hrb03_12_001_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_12_002;
	 public $_hrb03_12_002_type='varchar2';
	/**
 	 * 注释:民族代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_12_003;
	 public $_hrb03_12_003_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_12_004;
	 public $_hrb03_12_004_type='date';
	/**
 	 * 注释:死亡日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_12_005;
	 public $_hrb03_12_005_type='date';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_12_006;
	 public $_hrb03_12_006_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb03_12_007;
	 public $_hrb03_12_007_type='varchar2';
	/**
 	 * 注释:职业类别代码(国标)
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb03_12_008;
	 public $_hrb03_12_008_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_12_009;
	 public $_hrb03_12_009_type='varchar2';
	/**
 	 * 注释:文化程度代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_12_010;
	 public $_hrb03_12_010_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_12_011;
	 public $_hrb03_12_011_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb03_12_012;
	 public $_hrb03_12_012_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_12_013;
	 public $_hrb03_12_013_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_12_014;
	 public $_hrb03_12_014_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_12_015;
	 public $_hrb03_12_015_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_12_017;
	 public $_hrb03_12_017_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_12_018;
	 public $_hrb03_12_018_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb03_12_019;
	 public $_hrb03_12_019_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_12_020;
	 public $_hrb03_12_020_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_12_021;
	 public $_hrb03_12_021_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_12_022;
	 public $_hrb03_12_022_type='varchar2';
	/**
 	 * 注释:工作单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_12_023;
	 public $_hrb03_12_023_type='varchar2';
	/**
 	 * 注释:联系人姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_12_024;
	 public $_hrb03_12_024_type='varchar2';
	/**
 	 * 注释:住院号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hrb03_12_025;
	 public $_hrb03_12_025_type='varchar2';
	/**
 	 * 注释:死因链-顺序代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_12_026;
	 public $_hrb03_12_026_type='varchar2';
	/**
 	 * 注释:死因链-疾病代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrb03_12_027;
	 public $_hrb03_12_027_type='varchar2';
	/**
 	 * 注释:根本死因代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrb03_12_028;
	 public $_hrb03_12_028_type='varchar2';
	/**
 	 * 注释:时间间隔-时长
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_12_029;
	 public $_hrb03_12_029_type='number';
	/**
 	 * 注释:时间间隔-单位代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_12_030;
	 public $_hrb03_12_030_type='varchar2';
	/**
 	 * 注释:死亡医院
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_12_031;
	 public $_hrb03_12_031_type='varchar2';
	/**
 	 * 注释:死亡地点类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_12_032;
	 public $_hrb03_12_032_type='varchar2';
	/**
 	 * 注释:死亡最高诊断依据类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_12_033;
	 public $_hrb03_12_033_type='varchar2';
	/**
 	 * 注释:死亡最高诊断机构级别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_12_034;
	 public $_hrb03_12_034_type='varchar2';
}
