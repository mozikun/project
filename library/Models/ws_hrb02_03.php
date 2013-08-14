<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb02_03 extends dao_oracle{
	 public $__table = 'ws_hrb02_03';
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
 	 public $hrb02_03_001;
	 public $_hrb02_03_001_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_03_002;
	 public $_hrb02_03_002_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_03_003;
	 public $_hrb02_03_003_type='date';
	/**
 	 * 注释:门诊号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hrb02_03_004;
	 public $_hrb02_03_004_type='varchar2';
	/**
 	 * 注释:住院号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hrb02_03_005;
	 public $_hrb02_03_005_type='varchar2';
	/**
 	 * 注释:职业类别代码(国标)
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb02_03_006;
	 public $_hrb02_03_006_type='varchar2';
	/**
 	 * 注释:工作单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_03_007;
	 public $_hrb02_03_007_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_008;
	 public $_hrb02_03_008_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_009;
	 public $_hrb02_03_009_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb02_03_010;
	 public $_hrb02_03_010_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_03_011;
	 public $_hrb02_03_011_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_03_012;
	 public $_hrb02_03_012_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_03_013;
	 public $_hrb02_03_013_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_03_015;
	 public $_hrb02_03_015_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_03_016;
	 public $_hrb02_03_016_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb02_03_017;
	 public $_hrb02_03_017_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_03_018;
	 public $_hrb02_03_018_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_019;
	 public $_hrb02_03_019_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_03_020;
	 public $_hrb02_03_020_type='varchar2';
	/**
 	 * 注释:既往疾病史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_021;
	 public $_hrb02_03_021_type='varchar2';
	/**
 	 * 注释:过敏史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_022;
	 public $_hrb02_03_022_type='varchar2';
	/**
 	 * 注释:避孕史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_023;
	 public $_hrb02_03_023_type='varchar2';
	/**
 	 * 注释:主诉
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_024;
	 public $_hrb02_03_024_type='varchar2';
	/**
 	 * 注释:初潮年龄（岁）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_025;
	 public $_hrb02_03_025_type='number';
	/**
 	 * 注释:月经持续时间（d）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_026;
	 public $_hrb02_03_026_type='number';
	/**
 	 * 注释:月经周期（d）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_027;
	 public $_hrb02_03_027_type='number';
	/**
 	 * 注释:月经出血量类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_028;
	 public $_hrb02_03_028_type='varchar2';
	/**
 	 * 注释:痛经程度代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_029;
	 public $_hrb02_03_029_type='varchar2';
	/**
 	 * 注释:末次月经日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_03_030;
	 public $_hrb02_03_030_type='date';
	/**
 	 * 注释:孕次
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_031;
	 public $_hrb02_03_031_type='number';
	/**
 	 * 注释:产次
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_032;
	 public $_hrb02_03_032_type='number';
	/**
 	 * 注释:末次妊娠终止日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_03_033;
	 public $_hrb02_03_033_type='date';
	/**
 	 * 注释:末次妊娠终止方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_034;
	 public $_hrb02_03_034_type='varchar2';
	/**
 	 * 注释:流产总次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_035;
	 public $_hrb02_03_035_type='number';
	/**
 	 * 注释:体温(℃)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_036;
	 public $_hrb02_03_036_type='number';
	/**
 	 * 注释:舒张压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_037;
	 public $_hrb02_03_037_type='number';
	/**
 	 * 注释:收缩压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_038;
	 public $_hrb02_03_038_type='number';
	/**
 	 * 注释:心率（次/分钟）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_039;
	 public $_hrb02_03_039_type='number';
	/**
 	 * 注释:心脏听诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_040;
	 public $_hrb02_03_040_type='varchar2';
	/**
 	 * 注释:肺部听诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_041;
	 public $_hrb02_03_041_type='varchar2';
	/**
 	 * 注释:外阴检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_042;
	 public $_hrb02_03_042_type='varchar2';
	/**
 	 * 注释:阴道检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_043;
	 public $_hrb02_03_043_type='varchar2';
	/**
 	 * 注释:宫颈检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_044;
	 public $_hrb02_03_044_type='varchar2';
	/**
 	 * 注释:子宫检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_045;
	 public $_hrb02_03_045_type='varchar2';
	/**
 	 * 注释:子宫位置代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_046;
	 public $_hrb02_03_046_type='varchar2';
	/**
 	 * 注释:子宫大小代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_047;
	 public $_hrb02_03_047_type='varchar2';
	/**
 	 * 注释:左侧输卵管检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_048;
	 public $_hrb02_03_048_type='varchar2';
	/**
 	 * 注释:右侧输卵管检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_049;
	 public $_hrb02_03_049_type='varchar2';
	/**
 	 * 注释:左侧卵巢检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_050;
	 public $_hrb02_03_050_type='varchar2';
	/**
 	 * 注释:右侧卵巢检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_051;
	 public $_hrb02_03_051_type='varchar2';
	/**
 	 * 注释:左侧附件检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_052;
	 public $_hrb02_03_052_type='varchar2';
	/**
 	 * 注释:右侧附件检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_053;
	 public $_hrb02_03_053_type='varchar2';
	/**
 	 * 注释:左侧附睾检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_054;
	 public $_hrb02_03_054_type='varchar2';
	/**
 	 * 注释:右侧附睾检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_055;
	 public $_hrb02_03_055_type='varchar2';
	/**
 	 * 注释:左侧睾丸检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_056;
	 public $_hrb02_03_056_type='varchar2';
	/**
 	 * 注释:右侧睾丸检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_057;
	 public $_hrb02_03_057_type='varchar2';
	/**
 	 * 注释:左侧输精管检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_058;
	 public $_hrb02_03_058_type='varchar2';
	/**
 	 * 注释:右侧输精管检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_059;
	 public $_hrb02_03_059_type='varchar2';
	/**
 	 * 注释:阴囊检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_060;
	 public $_hrb02_03_060_type='varchar2';
	/**
 	 * 注释:精索检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_061;
	 public $_hrb02_03_061_type='varchar2';
	/**
 	 * 注释:红细胞计数值（G/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_062;
	 public $_hrb02_03_062_type='number';
	/**
 	 * 注释:血红蛋白值（g/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_063;
	 public $_hrb02_03_063_type='number';
	/**
 	 * 注释:血小板计数值(G/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_064;
	 public $_hrb02_03_064_type='number';
	/**
 	 * 注释:白细胞计数值(G/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_065;
	 public $_hrb02_03_065_type='number';
	/**
 	 * 注释:白细胞分类结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_066;
	 public $_hrb02_03_066_type='varchar2';
	/**
 	 * 注释:出血时间（s）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_067;
	 public $_hrb02_03_067_type='number';
	/**
 	 * 注释:凝血时间（s）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_068;
	 public $_hrb02_03_068_type='number';
	/**
 	 * 注释:阴道分泌物性状描述
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_069;
	 public $_hrb02_03_069_type='varchar2';
	/**
 	 * 注释:滴虫检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_070;
	 public $_hrb02_03_070_type='varchar2';
	/**
 	 * 注释:念珠菌检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_071;
	 public $_hrb02_03_071_type='varchar2';
	/**
 	 * 注释:阴道分泌物清洁度代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_072;
	 public $_hrb02_03_072_type='varchar2';
	/**
 	 * 注释:淋球菌检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_073;
	 public $_hrb02_03_073_type='varchar2';
	/**
 	 * 注释:梅毒血清学试验结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_074;
	 public $_hrb02_03_074_type='varchar2';
	/**
 	 * 注释:HIV抗体检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_075;
	 public $_hrb02_03_075_type='varchar2';
	/**
 	 * 注释:尿妊娠试验结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_076;
	 public $_hrb02_03_076_type='varchar2';
	/**
 	 * 注释:血β-绒毛膜促性腺激素值（IU/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_077;
	 public $_hrb02_03_077_type='number';
	/**
 	 * 注释:乙型肝炎病毒表面抗原检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_078;
	 public $_hrb02_03_078_type='varchar2';
	/**
 	 * 注释:B超检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_079;
	 public $_hrb02_03_079_type='varchar2';
	/**
 	 * 注释:疾病诊断代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrb02_03_080;
	 public $_hrb02_03_080_type='varchar2';
	/**
 	 * 注释:手术/操作-名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb02_03_081;
	 public $_hrb02_03_081_type='varchar2';
	/**
 	 * 注释:宫内节育器放置年限
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_082;
	 public $_hrb02_03_082_type='number';
	/**
 	 * 注释:宫内节育器放置时期代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_083;
	 public $_hrb02_03_083_type='varchar2';
	/**
 	 * 注释:宫内节育器取出-情况代码
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_084;
	 public $_hrb02_03_084_type='number';
	/**
 	 * 注释:宫内节育器取出-异常情况描述
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_085;
	 public $_hrb02_03_085_type='varchar2';
	/**
 	 * 注释:宫内节育器种类代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_086;
	 public $_hrb02_03_086_type='varchar2';
	/**
 	 * 注释:皮下埋植剂埋植时期代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_087;
	 public $_hrb02_03_087_type='varchar2';
	/**
 	 * 注释:皮下埋植剂埋植年限
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_088;
	 public $_hrb02_03_088_type='number';
	/**
 	 * 注释:皮下埋植剂埋植部位代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_089;
	 public $_hrb02_03_089_type='varchar2';
	/**
 	 * 注释:取出皮下埋植剂检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_090;
	 public $_hrb02_03_090_type='varchar2';
	/**
 	 * 注释:输卵管结扎手术方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_091;
	 public $_hrb02_03_091_type='varchar2';
	/**
 	 * 注释:输卵管结扎部位代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_092;
	 public $_hrb02_03_092_type='varchar2';
	/**
 	 * 注释:输精管结扎手术方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_093;
	 public $_hrb02_03_093_type='varchar2';
	/**
 	 * 注释:左侧输精管切除长度（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_094;
	 public $_hrb02_03_094_type='number';
	/**
 	 * 注释:右侧输精管切除长度（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_095;
	 public $_hrb02_03_095_type='number';
	/**
 	 * 注释:左侧附睾端包埋操作标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_096;
	 public $_hrb02_03_096_type='number';
	/**
 	 * 注释:右侧附睾端包埋操作标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_097;
	 public $_hrb02_03_097_type='number';
	/**
 	 * 注释:宫颈扩张标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_098;
	 public $_hrb02_03_098_type='number';
	/**
 	 * 注释:见到绒毛标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_099;
	 public $_hrb02_03_099_type='number';
	/**
 	 * 注释:胚囊-可见标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_100;
	 public $_hrb02_03_100_type='number';
	/**
 	 * 注释:胚囊-平均直径（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_101;
	 public $_hrb02_03_101_type='number';
	/**
 	 * 注释:清宫操作标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_102;
	 public $_hrb02_03_102_type='number';
	/**
 	 * 注释:流产方法代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_103;
	 public $_hrb02_03_103_type='varchar2';
	/**
 	 * 注释:药物流产使用药物类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_104;
	 public $_hrb02_03_104_type='varchar2';
	/**
 	 * 注释:呕吐次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_106;
	 public $_hrb02_03_106_type='number';
	/**
 	 * 注释:腹泻次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_107;
	 public $_hrb02_03_107_type='number';
	/**
 	 * 注释:腹痛程度代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_108;
	 public $_hrb02_03_108_type='varchar2';
	/**
 	 * 注释:病理检查-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_109;
	 public $_hrb02_03_109_type='number';
	/**
 	 * 注释:病理检查-结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_110;
	 public $_hrb02_03_110_type='varchar2';
	/**
 	 * 注释:药物名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb02_03_111;
	 public $_hrb02_03_111_type='varchar2';
	/**
 	 * 注释:药物用法
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_112;
	 public $_hrb02_03_112_type='varchar2';
	/**
 	 * 注释:胚囊排出日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_03_113;
	 public $_hrb02_03_113_type='date';
	/**
 	 * 注释:清宫日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_03_114;
	 public $_hrb02_03_114_type='date';
	/**
 	 * 注释:手术过程顺利标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_115;
	 public $_hrb02_03_115_type='number';
	/**
 	 * 注释:手术出血量（ml）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_03_116;
	 public $_hrb02_03_116_type='number';
	/**
 	 * 注释:手术过程描述
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_117;
	 public $_hrb02_03_117_type='varchar2';
	/**
 	 * 注释:手术并发症-标志
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_03_118;
	 public $_hrb02_03_118_type='varchar2';
	/**
 	 * 注释:手术并发症-详细描述
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_119;
	 public $_hrb02_03_119_type='varchar2';
	/**
 	 * 注释:特殊情况记录
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_120;
	 public $_hrb02_03_120_type='varchar2';
	/**
 	 * 注释:处理及指导意见
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_121;
	 public $_hrb02_03_121_type='varchar2';
	/**
 	 * 注释:随诊检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_03_122;
	 public $_hrb02_03_122_type='varchar2';
	/**
 	 * 注释:手术者姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_03_123;
	 public $_hrb02_03_123_type='varchar2';
	/**
 	 * 注释:手术机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_03_124;
	 public $_hrb02_03_124_type='varchar2';
	/**
 	 * 注释:手术日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_03_125;
	 public $_hrb02_03_125_type='date';
	/**
 	 * 注释:检查（测）人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_03_126;
	 public $_hrb02_03_126_type='varchar2';
	/**
 	 * 注释:检查（测）机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_03_127;
	 public $_hrb02_03_127_type='varchar2';
	/**
 	 * 注释:检查（测）日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_03_128;
	 public $_hrb02_03_128_type='date';
}
