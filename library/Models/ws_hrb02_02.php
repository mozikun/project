<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb02_02 extends dao_oracle{
	 public $__table = 'ws_hrb02_02';
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
 	 public $hrb02_02_001;
	 public $_hrb02_02_001_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_02_002;
	 public $_hrb02_02_002_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_02_003;
	 public $_hrb02_02_003_type='date';
	/**
 	 * 注释:民族代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_02_004;
	 public $_hrb02_02_004_type='varchar2';
	/**
 	 * 注释:职业类别代码(国标)
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb02_02_005;
	 public $_hrb02_02_005_type='varchar2';
	/**
 	 * 注释:工作单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_02_006;
	 public $_hrb02_02_006_type='varchar2';
	/**
 	 * 注释:文化程度代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_02_007;
	 public $_hrb02_02_007_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_02_008;
	 public $_hrb02_02_008_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb02_02_009;
	 public $_hrb02_02_009_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_02_010;
	 public $_hrb02_02_010_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_02_011;
	 public $_hrb02_02_011_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb02_02_012;
	 public $_hrb02_02_012_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_02_013;
	 public $_hrb02_02_013_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_02_014;
	 public $_hrb02_02_014_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_02_015;
	 public $_hrb02_02_015_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_02_017;
	 public $_hrb02_02_017_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_02_018;
	 public $_hrb02_02_018_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb02_02_019;
	 public $_hrb02_02_019_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_02_020;
	 public $_hrb02_02_020_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_02_021;
	 public $_hrb02_02_021_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_02_022;
	 public $_hrb02_02_022_type='varchar2';
	/**
 	 * 注释:性交出血史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_02_023;
	 public $_hrb02_02_023_type='varchar2';
	/**
 	 * 注释:妊娠合并症/并发症史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_02_024;
	 public $_hrb02_02_024_type='varchar2';
	/**
 	 * 注释:既往疾病史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_02_025;
	 public $_hrb02_02_025_type='varchar2';
	/**
 	 * 注释:家族肿瘤史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_02_026;
	 public $_hrb02_02_026_type='varchar2';
	/**
 	 * 注释:妇科及乳腺不适症状代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_02_027;
	 public $_hrb02_02_027_type='varchar2';
	/**
 	 * 注释:心率（次/分钟）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_028;
	 public $_hrb02_02_028_type='number';
	/**
 	 * 注释:收缩压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_029;
	 public $_hrb02_02_029_type='number';
	/**
 	 * 注释:舒张压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_030;
	 public $_hrb02_02_030_type='number';
	/**
 	 * 注释:初潮年龄（岁）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_031;
	 public $_hrb02_02_031_type='number';
	/**
 	 * 注释:月经周期（d）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_032;
	 public $_hrb02_02_032_type='number';
	/**
 	 * 注释:月经持续时间（d）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_033;
	 public $_hrb02_02_033_type='number';
	/**
 	 * 注释:月经出血量类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_02_034;
	 public $_hrb02_02_034_type='varchar2';
	/**
 	 * 注释:痛经标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_035;
	 public $_hrb02_02_035_type='number';
	/**
 	 * 注释:末次月经日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_02_036;
	 public $_hrb02_02_036_type='date';
	/**
 	 * 注释:绝经标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_037;
	 public $_hrb02_02_037_type='number';
	/**
 	 * 注释:手术绝经标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_038;
	 public $_hrb02_02_038_type='number';
	/**
 	 * 注释:绝经年龄（岁）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_039;
	 public $_hrb02_02_039_type='number';
	/**
 	 * 注释:孕次
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_040;
	 public $_hrb02_02_040_type='number';
	/**
 	 * 注释:产次
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_041;
	 public $_hrb02_02_041_type='number';
	/**
 	 * 注释:自然流产次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_042;
	 public $_hrb02_02_042_type='number';
	/**
 	 * 注释:人工流产次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_043;
	 public $_hrb02_02_043_type='number';
	/**
 	 * 注释:阴道助产次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_044;
	 public $_hrb02_02_044_type='number';
	/**
 	 * 注释:剖宫产次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_045;
	 public $_hrb02_02_045_type='number';
	/**
 	 * 注释:死胎例数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_046;
	 public $_hrb02_02_046_type='number';
	/**
 	 * 注释:死产例数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_047;
	 public $_hrb02_02_047_type='number';
	/**
 	 * 注释:出生缺陷儿例数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_02_048;
	 public $_hrb02_02_048_type='number';
	/**
 	 * 注释:末次妊娠终止日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_02_049;
	 public $_hrb02_02_049_type='date';
	/**
 	 * 注释:末次妊娠终止方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_02_050;
	 public $_hrb02_02_050_type='varchar2';
	/**
 	 * 注释:末次分娩日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_02_051;
	 public $_hrb02_02_051_type='date';
	/**
 	 * 注释:末次分娩方式代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_02_052;
	 public $_hrb02_02_052_type='varchar2';
	/**
 	 * 注释:避孕方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_02_053;
	 public $_hrb02_02_053_type='varchar2';
	/**
 	 * 注释:左侧附件检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_02_054;
	 public $_hrb02_02_054_type='varchar2';
	/**
 	 * 注释:右侧附件检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_02_055;
	 public $_hrb02_02_055_type='varchar2';
	/**
 	 * 注释:宫颈检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_02_056;
	 public $_hrb02_02_056_type='varchar2';
	/**
 	 * 注释:阴道检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_02_057;
	 public $_hrb02_02_057_type='varchar2';
	/**
 	 * 注释:外阴检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_02_058;
	 public $_hrb02_02_058_type='varchar2';
	/**
 	 * 注释:子宫检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_02_059;
	 public $_hrb02_02_059_type='varchar2';
	/**
 	 * 注释:左侧乳腺检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_02_060;
	 public $_hrb02_02_060_type='varchar2';
	/**
 	 * 注释:右侧乳腺检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_02_061;
	 public $_hrb02_02_061_type='varchar2';
	/**
 	 * 注释:阴道细胞学诊断结果代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_02_062;
	 public $_hrb02_02_062_type='varchar2';
	/**
 	 * 注释:乳腺X线检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_02_063;
	 public $_hrb02_02_063_type='varchar2';
	/**
 	 * 注释:乳腺B超检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_02_064;
	 public $_hrb02_02_064_type='varchar2';
	/**
 	 * 注释:阴道镜检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_02_065;
	 public $_hrb02_02_065_type='varchar2';
	/**
 	 * 注释:阴道分泌物性状描述
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_02_066;
	 public $_hrb02_02_066_type='varchar2';
	/**
 	 * 注释:滴虫检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_02_067;
	 public $_hrb02_02_067_type='varchar2';
	/**
 	 * 注释:念珠菌检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_02_068;
	 public $_hrb02_02_068_type='varchar2';
	/**
 	 * 注释:阴道分泌物清洁度代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_02_069;
	 public $_hrb02_02_069_type='varchar2';
	/**
 	 * 注释:淋球菌检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_02_070;
	 public $_hrb02_02_070_type='varchar2';
	/**
 	 * 注释:梅毒血清学试验结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_02_071;
	 public $_hrb02_02_071_type='varchar2';
	/**
 	 * 注释:体检结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_02_072;
	 public $_hrb02_02_072_type='varchar2';
	/**
 	 * 注释:处理及指导意见
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_02_073;
	 public $_hrb02_02_073_type='varchar2';
	/**
 	 * 注释:主检医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_02_074;
	 public $_hrb02_02_074_type='varchar2';
	/**
 	 * 注释:检查（测）日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_02_075;
	 public $_hrb02_02_075_type='date';
	/**
 	 * 注释:检查（测）人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_02_076;
	 public $_hrb02_02_076_type='varchar2';
	/**
 	 * 注释:检查（测）机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_02_077;
	 public $_hrb02_02_077_type='varchar2';
}
