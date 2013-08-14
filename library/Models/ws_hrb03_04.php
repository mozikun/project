<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb03_04 extends dao_oracle{
	 public $__table = 'ws_hrb03_04';
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
 	 public $hrb03_04_001;
	 public $_hrb03_04_001_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_04_002;
	 public $_hrb03_04_002_type='varchar2';
	/**
 	 * 注释:父亲姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_04_003;
	 public $_hrb03_04_003_type='varchar2';
	/**
 	 * 注释:母亲姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_04_004;
	 public $_hrb03_04_004_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_04_005;
	 public $_hrb03_04_005_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb03_04_006;
	 public $_hrb03_04_006_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_04_007;
	 public $_hrb03_04_007_type='date';
	/**
 	 * 注释:职业代码（传染病）
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb03_04_008;
	 public $_hrb03_04_008_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_04_009;
	 public $_hrb03_04_009_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_04_010;
	 public $_hrb03_04_010_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_04_011;
	 public $_hrb03_04_011_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_04_012;
	 public $_hrb03_04_012_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_04_013;
	 public $_hrb03_04_013_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_04_014;
	 public $_hrb03_04_014_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_04_015;
	 public $_hrb03_04_015_type='varchar2';
	/**
 	 * 注释:地址-乡（镇、街道办事处）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_04_016;
	 public $_hrb03_04_016_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_04_017;
	 public $_hrb03_04_017_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_04_018;
	 public $_hrb03_04_018_type='varchar2';
	/**
 	 * 注释:民族代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_04_019;
	 public $_hrb03_04_019_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_04_020;
	 public $_hrb03_04_020_type='varchar2';
	/**
 	 * 注释:文化程度代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_04_021;
	 public $_hrb03_04_021_type='varchar2';
	/**
 	 * 注释:艾滋病接触史代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_04_022;
	 public $_hrb03_04_022_type='varchar2';
	/**
 	 * 注释:性病史代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_04_023;
	 public $_hrb03_04_023_type='varchar2';
	/**
 	 * 注释:艾滋病阳性检测方法代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_04_024;
	 public $_hrb03_04_024_type='varchar2';
	/**
 	 * 注释:艾滋病病毒感染诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_04_025;
	 public $_hrb03_04_025_type='date';
	/**
 	 * 注释:诊断机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_04_026;
	 public $_hrb03_04_026_type='varchar2';
	/**
 	 * 注释:CD4+检测结果（个/ul）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_027;
	 public $_hrb03_04_027_type='number';
	/**
 	 * 注释:CD4+检测日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_04_028;
	 public $_hrb03_04_028_type='date';
	/**
 	 * 注释:艾滋病病人标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_029;
	 public $_hrb03_04_029_type='number';
	/**
 	 * 注释:确诊日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_04_030;
	 public $_hrb03_04_030_type='date';
	/**
 	 * 注释:艾滋病抗病毒治疗标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_031;
	 public $_hrb03_04_031_type='number';
	/**
 	 * 注释:艾滋病抗病毒治疗编号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_032;
	 public $_hrb03_04_032_type='number';
	/**
 	 * 注释:艾滋病抗病毒治疗开始日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_04_033;
	 public $_hrb03_04_033_type='date';
	/**
 	 * 注释:艾滋病抗病毒治疗终止日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_04_034;
	 public $_hrb03_04_034_type='date';
	/**
 	 * 注释:艾滋病抗病毒治疗终止原因代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_04_035;
	 public $_hrb03_04_035_type='varchar2';
	/**
 	 * 注释:艾滋病抗病毒治疗停药原因代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_04_036;
	 public $_hrb03_04_036_type='varchar2';
	/**
 	 * 注释:美沙酮维持治疗标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_037;
	 public $_hrb03_04_037_type='number';
	/**
 	 * 注释:美沙酮维持治疗编号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_038;
	 public $_hrb03_04_038_type='number';
	/**
 	 * 注释:美沙酮维持治疗开始日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_04_039;
	 public $_hrb03_04_039_type='date';
	/**
 	 * 注释:美沙酮维持治疗终止日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_04_040;
	 public $_hrb03_04_040_type='date';
	/**
 	 * 注释:美沙酮维持治疗终止原因代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_04_041;
	 public $_hrb03_04_041_type='varchar2';
	/**
 	 * 注释:死亡日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_04_042;
	 public $_hrb03_04_042_type='date';
	/**
 	 * 注释:根本死因代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrb03_04_043;
	 public $_hrb03_04_043_type='varchar2';
	/**
 	 * 注释:配偶/固定性伴标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_044;
	 public $_hrb03_04_044_type='number';
	/**
 	 * 注释:配偶/固定性伴感染状况代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_04_045;
	 public $_hrb03_04_045_type='varchar2';
	/**
 	 * 注释:子女标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_046;
	 public $_hrb03_04_046_type='number';
	/**
 	 * 注释:子女感染状况代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_04_047;
	 public $_hrb03_04_047_type='varchar2';
	/**
 	 * 注释:避孕措施标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_048;
	 public $_hrb03_04_048_type='number';
	/**
 	 * 注释:怀孕标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_049;
	 public $_hrb03_04_049_type='number';
	/**
 	 * 注释:分娩标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_050;
	 public $_hrb03_04_050_type='number';
	/**
 	 * 注释:分娩活产个数
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_04_051;
	 public $_hrb03_04_051_type='varchar2';
	/**
 	 * 注释:育龄妇女预防母婴传播干预措施代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_04_052;
	 public $_hrb03_04_052_type='varchar2';
	/**
 	 * 注释:身高（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_053;
	 public $_hrb03_04_053_type='number';
	/**
 	 * 注释:体重（kg）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_054;
	 public $_hrb03_04_054_type='number';
	/**
 	 * 注释:头围（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_055;
	 public $_hrb03_04_055_type='number';
	/**
 	 * 注释:出生身长（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_056;
	 public $_hrb03_04_056_type='number';
	/**
 	 * 注释:身长（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_057;
	 public $_hrb03_04_057_type='number';
	/**
 	 * 注释:出生体重（g）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_058;
	 public $_hrb03_04_058_type='number';
	/**
 	 * 注释:出生头围（cm)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_04_059;
	 public $_hrb03_04_059_type='number';
	/**
 	 * 注释:儿童预防母婴传播干预措施代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_04_060;
	 public $_hrb03_04_060_type='varchar2';
}
