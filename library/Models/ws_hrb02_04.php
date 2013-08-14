<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb02_04 extends dao_oracle{
	 public $__table = 'ws_hrb02_04';
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
 	 public $hrb02_04_001;
	 public $_hrb02_04_001_type='varchar2';
	/**
 	 * 注释:住院号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hrb02_04_002;
	 public $_hrb02_04_002_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_04_003;
	 public $_hrb02_04_003_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_04_004;
	 public $_hrb02_04_004_type='date';
	/**
 	 * 注释:民族代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_04_005;
	 public $_hrb02_04_005_type='varchar2';
	/**
 	 * 注释:文化程度代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_04_006;
	 public $_hrb02_04_006_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_007;
	 public $_hrb02_04_007_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb02_04_008;
	 public $_hrb02_04_008_type='varchar2';
	/**
 	 * 注释:职业类别代码(国标)
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb02_04_009;
	 public $_hrb02_04_009_type='varchar2';
	/**
 	 * 注释:工作单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_04_010;
	 public $_hrb02_04_010_type='varchar2';
	/**
 	 * 注释:配偶姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_04_011;
	 public $_hrb02_04_011_type='varchar2';
	/**
 	 * 注释:配偶出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_04_012;
	 public $_hrb02_04_012_type='date';
	/**
 	 * 注释:配偶民族代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_04_013;
	 public $_hrb02_04_013_type='varchar2';
	/**
 	 * 注释:配偶文化程度代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_04_014;
	 public $_hrb02_04_014_type='varchar2';
	/**
 	 * 注释:配偶身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_015;
	 public $_hrb02_04_015_type='varchar2';
	/**
 	 * 注释:配偶身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb02_04_016;
	 public $_hrb02_04_016_type='varchar2';
	/**
 	 * 注释:配偶职业类别代码(国标)
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb02_04_017;
	 public $_hrb02_04_017_type='varchar2';
	/**
 	 * 注释:配偶工作单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_04_018;
	 public $_hrb02_04_018_type='varchar2';
	/**
 	 * 注释:母亲姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_04_019;
	 public $_hrb02_04_019_type='varchar2';
	/**
 	 * 注释:新生儿姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_04_020;
	 public $_hrb02_04_020_type='varchar2';
	/**
 	 * 注释:新生儿性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_021;
	 public $_hrb02_04_021_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_022;
	 public $_hrb02_04_022_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb02_04_023;
	 public $_hrb02_04_023_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_04_024;
	 public $_hrb02_04_024_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_04_025;
	 public $_hrb02_04_025_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_04_026;
	 public $_hrb02_04_026_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_04_028;
	 public $_hrb02_04_028_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_04_029;
	 public $_hrb02_04_029_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb02_04_030;
	 public $_hrb02_04_030_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_04_031;
	 public $_hrb02_04_031_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_032;
	 public $_hrb02_04_032_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_04_033;
	 public $_hrb02_04_033_type='varchar2';
	/**
 	 * 注释:现病史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_034;
	 public $_hrb02_04_034_type='varchar2';
	/**
 	 * 注释:既往疾病史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_035;
	 public $_hrb02_04_035_type='varchar2';
	/**
 	 * 注释:手术史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_036;
	 public $_hrb02_04_036_type='varchar2';
	/**
 	 * 注释:过敏史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_037;
	 public $_hrb02_04_037_type='varchar2';
	/**
 	 * 注释:家族遗传性疾病史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_038;
	 public $_hrb02_04_038_type='varchar2';
	/**
 	 * 注释:初潮年龄（岁）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_039;
	 public $_hrb02_04_039_type='number';
	/**
 	 * 注释:月经持续时间（d）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_040;
	 public $_hrb02_04_040_type='number';
	/**
 	 * 注释:月经出血量类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_041;
	 public $_hrb02_04_041_type='varchar2';
	/**
 	 * 注释:月经周期（d）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_042;
	 public $_hrb02_04_042_type='number';
	/**
 	 * 注释:末次月经日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_04_043;
	 public $_hrb02_04_043_type='date';
	/**
 	 * 注释:痛经程度代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_044;
	 public $_hrb02_04_044_type='varchar2';
	/**
 	 * 注释:孕次
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_045;
	 public $_hrb02_04_045_type='number';
	/**
 	 * 注释:产次
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_046;
	 public $_hrb02_04_046_type='number';
	/**
 	 * 注释:早产次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_047;
	 public $_hrb02_04_047_type='number';
	/**
 	 * 注释:自然流产次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_048;
	 public $_hrb02_04_048_type='number';
	/**
 	 * 注释:人工流产次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_049;
	 public $_hrb02_04_049_type='number';
	/**
 	 * 注释:剖宫产次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_050;
	 public $_hrb02_04_050_type='number';
	/**
 	 * 注释:阴道助产次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_051;
	 public $_hrb02_04_051_type='number';
	/**
 	 * 注释:死胎例数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_052;
	 public $_hrb02_04_052_type='number';
	/**
 	 * 注释:死产例数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_053;
	 public $_hrb02_04_053_type='number';
	/**
 	 * 注释:前次分娩方式代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_04_054;
	 public $_hrb02_04_054_type='varchar2';
	/**
 	 * 注释:前次妊娠终止方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_055;
	 public $_hrb02_04_055_type='varchar2';
	/**
 	 * 注释:前次分娩日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_04_056;
	 public $_hrb02_04_056_type='date';
	/**
 	 * 注释:前次妊娠终止日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_04_057;
	 public $_hrb02_04_057_type='date';
	/**
 	 * 注释:收缩压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_058;
	 public $_hrb02_04_058_type='number';
	/**
 	 * 注释:舒张压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_059;
	 public $_hrb02_04_059_type='number';
	/**
 	 * 注释:基础收缩压（mmHg）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_060;
	 public $_hrb02_04_060_type='number';
	/**
 	 * 注释:基础舒张压（mmHg）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_061;
	 public $_hrb02_04_061_type='number';
	/**
 	 * 注释:体温(℃)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_062;
	 public $_hrb02_04_062_type='number';
	/**
 	 * 注释:新生儿体温（℃）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_063;
	 public $_hrb02_04_063_type='number';
	/**
 	 * 注释:症状
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_064;
	 public $_hrb02_04_064_type='varchar2';
	/**
 	 * 注释:体征
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_065;
	 public $_hrb02_04_065_type='varchar2';
	/**
 	 * 注释:心率（次/分钟）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_066;
	 public $_hrb02_04_066_type='number';
	/**
 	 * 注释:胎心率（次/分钟）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_067;
	 public $_hrb02_04_067_type='number';
	/**
 	 * 注释:新生儿心率（次/分钟）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_068;
	 public $_hrb02_04_068_type='number';
	/**
 	 * 注释:分娩孕周
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_069;
	 public $_hrb02_04_069_type='number';
	/**
 	 * 注释:分娩日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_04_070;
	 public $_hrb02_04_070_type='date';
	/**
 	 * 注释:分娩方式代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_04_071;
	 public $_hrb02_04_071_type='varchar2';
	/**
 	 * 注释:总产程时长（min）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_072;
	 public $_hrb02_04_072_type='number';
	/**
 	 * 注释:第一产程时长（min）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_073;
	 public $_hrb02_04_073_type='number';
	/**
 	 * 注释:第二产程时长（min）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_074;
	 public $_hrb02_04_074_type='number';
	/**
 	 * 注释:第三产程时长（min）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_075;
	 public $_hrb02_04_075_type='number';
	/**
 	 * 注释:产后开奶时长（min）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_076;
	 public $_hrb02_04_076_type='number';
	/**
 	 * 注释:产后天数（d）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_077;
	 public $_hrb02_04_077_type='number';
	/**
 	 * 注释:产时并发症代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_04_078;
	 public $_hrb02_04_078_type='varchar2';
	/**
 	 * 注释:分娩结局
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb02_04_079;
	 public $_hrb02_04_079_type='varchar2';
	/**
 	 * 注释:总出血量（ml）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_080;
	 public $_hrb02_04_080_type='number';
	/**
 	 * 注释:产时出血量（ml）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_081;
	 public $_hrb02_04_081_type='number';
	/**
 	 * 注释:产后两小时出血量（ml）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_082;
	 public $_hrb02_04_082_type='number';
	/**
 	 * 注释:体重（g）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_083;
	 public $_hrb02_04_083_type='number';
	/**
 	 * 注释:身长（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_084;
	 public $_hrb02_04_084_type='number';
	/**
 	 * 注释:身高(cm)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_085;
	 public $_hrb02_04_085_type='number';
	/**
 	 * 注释:基础体重（kg）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_086;
	 public $_hrb02_04_086_type='number';
	/**
 	 * 注释:体重（kg）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_087;
	 public $_hrb02_04_087_type='number';
	/**
 	 * 注释:头围（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_088;
	 public $_hrb02_04_088_type='number';
	/**
 	 * 注释:胸围（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_089;
	 public $_hrb02_04_089_type='number';
	/**
 	 * 注释:恶露状况
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_090;
	 public $_hrb02_04_090_type='varchar2';
	/**
 	 * 注释:预产期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_04_091;
	 public $_hrb02_04_091_type='date';
	/**
 	 * 注释:孕期异常情况记录
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_092;
	 public $_hrb02_04_092_type='varchar2';
	/**
 	 * 注释:早孕反应开始孕周
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_093;
	 public $_hrb02_04_093_type='number';
	/**
 	 * 注释:早孕反应标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_094;
	 public $_hrb02_04_094_type='number';
	/**
 	 * 注释:危重孕产妇标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_095;
	 public $_hrb02_04_095_type='number';
	/**
 	 * 注释:孕产期高危因素-代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_04_096;
	 public $_hrb02_04_096_type='varchar2';
	/**
 	 * 注释:孕产期高危因素-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_097;
	 public $_hrb02_04_097_type='number';
	/**
 	 * 注释:高危评分日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_04_098;
	 public $_hrb02_04_098_type='date';
	/**
 	 * 注释:高危评分孕周
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_099;
	 public $_hrb02_04_099_type='number';
	/**
 	 * 注释:高危评分值（分）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_100;
	 public $_hrb02_04_100_type='number';
	/**
 	 * 注释:高危妊娠级别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_101;
	 public $_hrb02_04_101_type='varchar2';
	/**
 	 * 注释:腹围（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_102;
	 public $_hrb02_04_102_type='number';
	/**
 	 * 注释:宫底高度（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_103;
	 public $_hrb02_04_103_type='number';
	/**
 	 * 注释:骶耻外径（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_104;
	 public $_hrb02_04_104_type='number';
	/**
 	 * 注释:髂棘间径（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_105;
	 public $_hrb02_04_105_type='number';
	/**
 	 * 注释:髂嵴间径（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_106;
	 public $_hrb02_04_106_type='number';
	/**
 	 * 注释:坐骨结节间径（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_107;
	 public $_hrb02_04_107_type='number';
	/**
 	 * 注释:骨盆测量日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_04_108;
	 public $_hrb02_04_108_type='date';
	/**
 	 * 注释:骨盆测量孕周
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_109;
	 public $_hrb02_04_109_type='number';
	/**
 	 * 注释:口腔检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_110;
	 public $_hrb02_04_110_type='varchar2';
	/**
 	 * 注释:心脏听诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_111;
	 public $_hrb02_04_111_type='varchar2';
	/**
 	 * 注释:新生儿心脏听诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_112;
	 public $_hrb02_04_112_type='varchar2';
	/**
 	 * 注释:肺部听诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_113;
	 public $_hrb02_04_113_type='varchar2';
	/**
 	 * 注释:新生儿肺部听诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_114;
	 public $_hrb02_04_114_type='varchar2';
	/**
 	 * 注释:肝脏触诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_115;
	 public $_hrb02_04_115_type='varchar2';
	/**
 	 * 注释:脾脏触诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_116;
	 public $_hrb02_04_116_type='varchar2';
	/**
 	 * 注释:宫颈检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_117;
	 public $_hrb02_04_117_type='varchar2';
	/**
 	 * 注释:阴道检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_118;
	 public $_hrb02_04_118_type='varchar2';
	/**
 	 * 注释:会阴-切开标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_119;
	 public $_hrb02_04_119_type='number';
	/**
 	 * 注释:会阴-缝合针数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_120;
	 public $_hrb02_04_120_type='number';
	/**
 	 * 注释:会阴裂伤程度代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_121;
	 public $_hrb02_04_121_type='varchar2';
	/**
 	 * 注释:子宫检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_122;
	 public $_hrb02_04_122_type='varchar2';
	/**
 	 * 注释:左侧附件检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_123;
	 public $_hrb02_04_123_type='varchar2';
	/**
 	 * 注释:右侧附件检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_124;
	 public $_hrb02_04_124_type='varchar2';
	/**
 	 * 注释:左侧乳腺检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_125;
	 public $_hrb02_04_125_type='varchar2';
	/**
 	 * 注释:右侧乳腺检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_126;
	 public $_hrb02_04_126_type='varchar2';
	/**
 	 * 注释:脊柱检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_127;
	 public $_hrb02_04_127_type='varchar2';
	/**
 	 * 注释:甲状腺检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_128;
	 public $_hrb02_04_128_type='varchar2';
	/**
 	 * 注释:皮肤毛发检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_129;
	 public $_hrb02_04_129_type='varchar2';
	/**
 	 * 注释:脐部检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_130;
	 public $_hrb02_04_130_type='varchar2';
	/**
 	 * 注释:外阴检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_131;
	 public $_hrb02_04_131_type='varchar2';
	/**
 	 * 注释:乳头检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_132;
	 public $_hrb02_04_132_type='varchar2';
	/**
 	 * 注释:乳汁量代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_133;
	 public $_hrb02_04_133_type='varchar2';
	/**
 	 * 注释:四肢检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_134;
	 public $_hrb02_04_134_type='varchar2';
	/**
 	 * 注释:浮肿程度代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_135;
	 public $_hrb02_04_135_type='varchar2';
	/**
 	 * 注释:衔接标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_136;
	 public $_hrb02_04_136_type='number';
	/**
 	 * 注释:B超检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_137;
	 public $_hrb02_04_137_type='varchar2';
	/**
 	 * 注释:新生儿睡眠状况
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_138;
	 public $_hrb02_04_138_type='varchar2';
	/**
 	 * 注释:胎动孕周
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_139;
	 public $_hrb02_04_139_type='number';
	/**
 	 * 注释:胎方位代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_04_140;
	 public $_hrb02_04_140_type='varchar2';
	/**
 	 * 注释:胎数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_141;
	 public $_hrb02_04_141_type='number';
	/**
 	 * 注释:胎先露代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_142;
	 public $_hrb02_04_142_type='varchar2';
	/**
 	 * 注释:ABO血型代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_143;
	 public $_hrb02_04_143_type='varchar2';
	/**
 	 * 注释:Rh血型代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_144;
	 public $_hrb02_04_144_type='varchar2';
	/**
 	 * 注释:新生儿黄疸程度代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_145;
	 public $_hrb02_04_145_type='varchar2';
	/**
 	 * 注释:肝功能检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_146;
	 public $_hrb02_04_146_type='varchar2';
	/**
 	 * 注释:肾功能检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_147;
	 public $_hrb02_04_147_type='varchar2';
	/**
 	 * 注释:血β-绒毛膜促性腺激素值（IU/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_148;
	 public $_hrb02_04_148_type='number';
	/**
 	 * 注释:血糖检测值（mmol/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_149;
	 public $_hrb02_04_149_type='number';
	/**
 	 * 注释:白细胞计数值(G/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_150;
	 public $_hrb02_04_150_type='number';
	/**
 	 * 注释:红细胞计数值（G/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_151;
	 public $_hrb02_04_151_type='number';
	/**
 	 * 注释:血小板计数值(G/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_152;
	 public $_hrb02_04_152_type='number';
	/**
 	 * 注释:出血时间（s）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_153;
	 public $_hrb02_04_153_type='number';
	/**
 	 * 注释:凝血时间（s）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_154;
	 public $_hrb02_04_154_type='number';
	/**
 	 * 注释:血红蛋白值（g/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_155;
	 public $_hrb02_04_155_type='number';
	/**
 	 * 注释:血清谷丙转氨酶值（U/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_156;
	 public $_hrb02_04_156_type='number';
	/**
 	 * 注释:尿比重
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_157;
	 public $_hrb02_04_157_type='number';
	/**
 	 * 注释:尿蛋白定量检测值（mg/24h）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_158;
	 public $_hrb02_04_158_type='number';
	/**
 	 * 注释:尿糖定量检测(mmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_159;
	 public $_hrb02_04_159_type='number';
	/**
 	 * 注释:尿液酸碱度
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_160;
	 public $_hrb02_04_160_type='number';
	/**
 	 * 注释:尿蛋白定量检测值（mg/24h）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_161;
	 public $_hrb02_04_161_type='number';
	/**
 	 * 注释:阴道分泌物性状描述
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_162;
	 public $_hrb02_04_162_type='varchar2';
	/**
 	 * 注释:滴虫检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_163;
	 public $_hrb02_04_163_type='varchar2';
	/**
 	 * 注释:念珠菌检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_164;
	 public $_hrb02_04_164_type='varchar2';
	/**
 	 * 注释:阴道分泌物清洁度代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_165;
	 public $_hrb02_04_165_type='varchar2';
	/**
 	 * 注释:乙型肝炎病毒表面抗原检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_166;
	 public $_hrb02_04_166_type='varchar2';
	/**
 	 * 注释:梅毒血清学试验结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_167;
	 public $_hrb02_04_167_type='varchar2';
	/**
 	 * 注释:淋球菌检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_168;
	 public $_hrb02_04_168_type='varchar2';
	/**
 	 * 注释:HIV抗体检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_169;
	 public $_hrb02_04_169_type='varchar2';
	/**
 	 * 注释:喂养方式类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_170;
	 public $_hrb02_04_170_type='varchar2';
	/**
 	 * 注释:臀红标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_171;
	 public $_hrb02_04_171_type='number';
	/**
 	 * 注释:Apgar评分值（分）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_172;
	 public $_hrb02_04_172_type='number';
	/**
 	 * 注释:小便状况记录
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_173;
	 public $_hrb02_04_173_type='varchar2';
	/**
 	 * 注释:新生儿小便状况记录
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_174;
	 public $_hrb02_04_174_type='varchar2';
	/**
 	 * 注释:大便状况记录
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_175;
	 public $_hrb02_04_175_type='varchar2';
	/**
 	 * 注释:新生儿大便状况记录
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_176;
	 public $_hrb02_04_176_type='varchar2';
	/**
 	 * 注释:特殊情况记录
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_177;
	 public $_hrb02_04_177_type='varchar2';
	/**
 	 * 注释:新生儿特殊情况记录
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_178;
	 public $_hrb02_04_178_type='varchar2';
	/**
 	 * 注释:辅助检查-结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_179;
	 public $_hrb02_04_179_type='varchar2';
	/**
 	 * 注释:辅助检查-项目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_180;
	 public $_hrb02_04_180_type='varchar2';
	/**
 	 * 注释:产后42天检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_181;
	 public $_hrb02_04_181_type='varchar2';
	/**
 	 * 注释:转诊记录
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_182;
	 public $_hrb02_04_182_type='varchar2';
	/**
 	 * 注释:孕产妇高危筛查机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_04_183;
	 public $_hrb02_04_183_type='varchar2';
	/**
 	 * 注释:高危妊娠转归代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_184;
	 public $_hrb02_04_184_type='varchar2';
	/**
 	 * 注释:妊娠合并症/并发症史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_185;
	 public $_hrb02_04_185_type='varchar2';
	/**
 	 * 注释:妊娠诊断方法代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_186;
	 public $_hrb02_04_186_type='varchar2';
	/**
 	 * 注释:伤口愈合状况代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_187;
	 public $_hrb02_04_187_type='varchar2';
	/**
 	 * 注释:出生缺陷标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_188;
	 public $_hrb02_04_188_type='number';
	/**
 	 * 注释:出生缺陷类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_04_189;
	 public $_hrb02_04_189_type='varchar2';
	/**
 	 * 注释:出生缺陷儿例数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_190;
	 public $_hrb02_04_190_type='number';
	/**
 	 * 注释:新生儿并发症-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_191;
	 public $_hrb02_04_191_type='number';
	/**
 	 * 注释:新生儿并发症-代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrb02_04_192;
	 public $_hrb02_04_192_type='varchar2';
	/**
 	 * 注释:新生儿疾病筛查标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_193;
	 public $_hrb02_04_193_type='number';
	/**
 	 * 注释:新生儿抢救标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_194;
	 public $_hrb02_04_194_type='number';
	/**
 	 * 注释:新生儿抢救方法代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_195;
	 public $_hrb02_04_195_type='varchar2';
	/**
 	 * 注释:孕产妇死亡时间类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_04_196;
	 public $_hrb02_04_196_type='varchar2';
	/**
 	 * 注释:处理及指导意见
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_197;
	 public $_hrb02_04_197_type='varchar2';
	/**
 	 * 注释:新生儿处理及指导意见
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_198;
	 public $_hrb02_04_198_type='varchar2';
	/**
 	 * 注释:计划生育指导内容
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_199;
	 public $_hrb02_04_199_type='varchar2';
	/**
 	 * 注释:宣教内容
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_04_200;
	 public $_hrb02_04_200_type='varchar2';
	/**
 	 * 注释:检查（测）人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_04_201;
	 public $_hrb02_04_201_type='varchar2';
	/**
 	 * 注释:检查（测）机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_04_202;
	 public $_hrb02_04_202_type='varchar2';
	/**
 	 * 注释:检查（测）日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_04_203;
	 public $_hrb02_04_203_type='date';
	/**
 	 * 注释:助产人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_04_204;
	 public $_hrb02_04_204_type='varchar2';
	/**
 	 * 注释:助产机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_04_205;
	 public $_hrb02_04_205_type='varchar2';
	/**
 	 * 注释:建档孕周
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_04_206;
	 public $_hrb02_04_206_type='number';
	/**
 	 * 注释:建档人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_04_207;
	 public $_hrb02_04_207_type='varchar2';
	/**
 	 * 注释:建档机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_04_208;
	 public $_hrb02_04_208_type='varchar2';
	/**
 	 * 注释:结案日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_04_209;
	 public $_hrb02_04_209_type='date';
	/**
 	 * 注释:结案单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_04_210;
	 public $_hrb02_04_210_type='varchar2';
	/**
 	 * 注释:预约日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_04_211;
	 public $_hrb02_04_211_type='date';
	/**
 	 * 注释:访视日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_04_212;
	 public $_hrb02_04_212_type='date';
	/**
 	 * 注释:访视人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_04_213;
	 public $_hrb02_04_213_type='varchar2';
	/**
 	 * 注释:访视机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_04_214;
	 public $_hrb02_04_214_type='varchar2';
}
