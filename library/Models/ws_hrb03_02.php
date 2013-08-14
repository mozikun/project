<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb03_02 extends dao_oracle{
	 public $__table = 'ws_hrb03_02';
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
 	 public $hrb03_02_001;
	 public $_hrb03_02_001_type='varchar2';
	/**
 	 * 注释:报卡类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_02_002;
	 public $_hrb03_02_002_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_02_003;
	 public $_hrb03_02_003_type='varchar2';
	/**
 	 * 注释:家长姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_02_004;
	 public $_hrb03_02_004_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_02_005;
	 public $_hrb03_02_005_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb03_02_006;
	 public $_hrb03_02_006_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_02_007;
	 public $_hrb03_02_007_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_02_008;
	 public $_hrb03_02_008_type='date';
	/**
 	 * 注释:工作单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_02_009;
	 public $_hrb03_02_009_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_02_010;
	 public $_hrb03_02_010_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_02_011;
	 public $_hrb03_02_011_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_02_012;
	 public $_hrb03_02_012_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_02_013;
	 public $_hrb03_02_013_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_02_014;
	 public $_hrb03_02_014_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_02_015;
	 public $_hrb03_02_015_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_02_016;
	 public $_hrb03_02_016_type='varchar2';
	/**
 	 * 注释:地址-乡（镇、街道办事处）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_02_017;
	 public $_hrb03_02_017_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_02_018;
	 public $_hrb03_02_018_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_02_019;
	 public $_hrb03_02_019_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb03_02_020;
	 public $_hrb03_02_020_type='varchar2';
	/**
 	 * 注释:职业代码（传染病）
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb03_02_021;
	 public $_hrb03_02_021_type='varchar2';
	/**
 	 * 注释:首次出现症状日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_02_022;
	 public $_hrb03_02_022_type='date';
	/**
 	 * 注释:传染病发病类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_02_023;
	 public $_hrb03_02_023_type='varchar2';
	/**
 	 * 注释:诊断状态代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_02_024;
	 public $_hrb03_02_024_type='varchar2';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_02_025;
	 public $_hrb03_02_025_type='date';
	/**
 	 * 注释:死亡日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_02_026;
	 public $_hrb03_02_026_type='date';
	/**
 	 * 注释:传染病类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_02_027;
	 public $_hrb03_02_027_type='varchar2';
	/**
 	 * 注释:传染病名称代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_02_028;
	 public $_hrb03_02_028_type='varchar2';
	/**
 	 * 注释:其他法定管理以及重点监测传染病名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_02_029;
	 public $_hrb03_02_029_type='varchar2';
	/**
 	 * 注释:订正病名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_02_030;
	 public $_hrb03_02_030_type='varchar2';
	/**
 	 * 注释:退卡原因
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_02_031;
	 public $_hrb03_02_031_type='varchar2';
	/**
 	 * 注释:报告医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_02_032;
	 public $_hrb03_02_032_type='varchar2';
	/**
 	 * 注释:填报单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_02_033;
	 public $_hrb03_02_033_type='varchar2';
	/**
 	 * 注释:填报日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_02_034;
	 public $_hrb03_02_034_type='date';
}
