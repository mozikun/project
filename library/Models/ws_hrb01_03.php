<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb01_03 extends dao_oracle{
	 public $__table = 'ws_hrb01_03';
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
 	 public $hrb01_03_001;
	 public $_hrb01_03_001_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_03_002;
	 public $_hrb01_03_002_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_03_003;
	 public $_hrb01_03_003_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_03_004;
	 public $_hrb01_03_004_type='date';
	/**
 	 * 注释:父亲姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_03_005;
	 public $_hrb01_03_005_type='varchar2';
	/**
 	 * 注释:父亲出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_03_006;
	 public $_hrb01_03_006_type='date';
	/**
 	 * 注释:父亲职业类别代码(国标)
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb01_03_007;
	 public $_hrb01_03_007_type='varchar2';
	/**
 	 * 注释:父亲工作单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb01_03_008;
	 public $_hrb01_03_008_type='varchar2';
	/**
 	 * 注释:母亲姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_03_009;
	 public $_hrb01_03_009_type='varchar2';
	/**
 	 * 注释:母亲出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_03_010;
	 public $_hrb01_03_010_type='date';
	/**
 	 * 注释:母亲职业类别代码(国标)
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb01_03_011;
	 public $_hrb01_03_011_type='varchar2';
	/**
 	 * 注释:母亲工作单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb01_03_012;
	 public $_hrb01_03_012_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_03_013;
	 public $_hrb01_03_013_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb01_03_014;
	 public $_hrb01_03_014_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_03_015;
	 public $_hrb01_03_015_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_03_016;
	 public $_hrb01_03_016_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_03_017;
	 public $_hrb01_03_017_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_03_019;
	 public $_hrb01_03_019_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_03_020;
	 public $_hrb01_03_020_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb01_03_021;
	 public $_hrb01_03_021_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_03_022;
	 public $_hrb01_03_022_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_03_023;
	 public $_hrb01_03_023_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb01_03_024;
	 public $_hrb01_03_024_type='varchar2';
	/**
 	 * 注释:分娩方式代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb01_03_025;
	 public $_hrb01_03_025_type='varchar2';
	/**
 	 * 注释:出生孕周
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_026;
	 public $_hrb01_03_026_type='number';
	/**
 	 * 注释:体重（g）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_027;
	 public $_hrb01_03_027_type='number';
	/**
 	 * 注释:身长（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_028;
	 public $_hrb01_03_028_type='number';
	/**
 	 * 注释:Apgar评分值（分）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_029;
	 public $_hrb01_03_029_type='number';
	/**
 	 * 注释:出生缺陷标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_030;
	 public $_hrb01_03_030_type='number';
	/**
 	 * 注释:出生缺陷类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb01_03_031;
	 public $_hrb01_03_031_type='varchar2';
	/**
 	 * 注释:新生儿疾病筛查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_032;
	 public $_hrb01_03_032_type='varchar2';
	/**
 	 * 注释:抬头月龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_033;
	 public $_hrb01_03_033_type='number';
	/**
 	 * 注释:翻身月龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_034;
	 public $_hrb01_03_034_type='number';
	/**
 	 * 注释:独坐月龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_035;
	 public $_hrb01_03_035_type='number';
	/**
 	 * 注释:爬行月龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_036;
	 public $_hrb01_03_036_type='number';
	/**
 	 * 注释:ABO血型代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_03_037;
	 public $_hrb01_03_037_type='varchar2';
	/**
 	 * 注释:Rh血型代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_03_038;
	 public $_hrb01_03_038_type='varchar2';
	/**
 	 * 注释:家族遗传性疾病史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_039;
	 public $_hrb01_03_039_type='varchar2';
	/**
 	 * 注释:患者与本人关系代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb01_03_040;
	 public $_hrb01_03_040_type='varchar2';
	/**
 	 * 注释:过敏史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_041;
	 public $_hrb01_03_041_type='varchar2';
	/**
 	 * 注释:儿童体检年龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_042;
	 public $_hrb01_03_042_type='number';
	/**
 	 * 注释:喂养方式类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_03_043;
	 public $_hrb01_03_043_type='varchar2';
	/**
 	 * 注释:辅食种类代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_03_044;
	 public $_hrb01_03_044_type='varchar2';
	/**
 	 * 注释:维生素D/钙剂添加标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_045;
	 public $_hrb01_03_045_type='number';
	/**
 	 * 注释:身高(cm)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_046;
	 public $_hrb01_03_046_type='number';
	/**
 	 * 注释:体重（kg）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_047;
	 public $_hrb01_03_047_type='number';
	/**
 	 * 注释:头围（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_048;
	 public $_hrb01_03_048_type='number';
	/**
 	 * 注释:胸围（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_049;
	 public $_hrb01_03_049_type='number';
	/**
 	 * 注释:前囟闭合标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_050;
	 public $_hrb01_03_050_type='number';
	/**
 	 * 注释:前囟横径（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_051;
	 public $_hrb01_03_051_type='number';
	/**
 	 * 注释:前囟纵径（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_052;
	 public $_hrb01_03_052_type='number';
	/**
 	 * 注释:心脏听诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_053;
	 public $_hrb01_03_053_type='varchar2';
	/**
 	 * 注释:肺部听诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_054;
	 public $_hrb01_03_054_type='varchar2';
	/**
 	 * 注释:肝脏触诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_055;
	 public $_hrb01_03_055_type='varchar2';
	/**
 	 * 注释:脾脏触诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_056;
	 public $_hrb01_03_056_type='varchar2';
	/**
 	 * 注释:皮肤毛发检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_057;
	 public $_hrb01_03_057_type='varchar2';
	/**
 	 * 注释:浅表淋巴结检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_058;
	 public $_hrb01_03_058_type='varchar2';
	/**
 	 * 注释:四肢检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_059;
	 public $_hrb01_03_059_type='varchar2';
	/**
 	 * 注释:脊柱检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_060;
	 public $_hrb01_03_060_type='varchar2';
	/**
 	 * 注释:腹部检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_061;
	 public $_hrb01_03_061_type='varchar2';
	/**
 	 * 注释:外生殖器检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_062;
	 public $_hrb01_03_062_type='varchar2';
	/**
 	 * 注释:症状
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_063;
	 public $_hrb01_03_063_type='varchar2';
	/**
 	 * 注释:体征
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_064;
	 public $_hrb01_03_064_type='varchar2';
	/**
 	 * 注释:沙眼标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_065;
	 public $_hrb01_03_065_type='number';
	/**
 	 * 注释:左眼视力
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_066;
	 public $_hrb01_03_066_type='varchar2';
	/**
 	 * 注释:右眼视力
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_067;
	 public $_hrb01_03_067_type='varchar2';
	/**
 	 * 注释:左耳检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_068;
	 public $_hrb01_03_068_type='varchar2';
	/**
 	 * 注释:右耳检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_069;
	 public $_hrb01_03_069_type='varchar2';
	/**
 	 * 注释:左侧听力检测结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_070;
	 public $_hrb01_03_070_type='varchar2';
	/**
 	 * 注释:右侧听力检测结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_071;
	 public $_hrb01_03_071_type='varchar2';
	/**
 	 * 注释:鼻部检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_072;
	 public $_hrb01_03_072_type='varchar2';
	/**
 	 * 注释:咽部检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_073;
	 public $_hrb01_03_073_type='varchar2';
	/**
 	 * 注释:扁桃体检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_074;
	 public $_hrb01_03_074_type='varchar2';
	/**
 	 * 注释:出牙月龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_075;
	 public $_hrb01_03_075_type='number';
	/**
 	 * 注释:出牙数（颗）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_076;
	 public $_hrb01_03_076_type='number';
	/**
 	 * 注释:龋齿数（颗）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_077;
	 public $_hrb01_03_077_type='number';
	/**
 	 * 注释:血红蛋白值（g/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_078;
	 public $_hrb01_03_078_type='number';
	/**
 	 * 注释:年龄别体重评价结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_03_079;
	 public $_hrb01_03_079_type='varchar2';
	/**
 	 * 注释:年龄别身高评价结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_03_080;
	 public $_hrb01_03_080_type='varchar2';
	/**
 	 * 注释:身高别体重评价结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb01_03_081;
	 public $_hrb01_03_081_type='varchar2';
	/**
 	 * 注释:儿童神经精神发育筛查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_082;
	 public $_hrb01_03_082_type='varchar2';
	/**
 	 * 注释:体弱儿童标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb01_03_083;
	 public $_hrb01_03_083_type='number';
	/**
 	 * 注释:体检结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_084;
	 public $_hrb01_03_084_type='varchar2';
	/**
 	 * 注释:处理及指导意见
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb01_03_085;
	 public $_hrb01_03_085_type='varchar2';
	/**
 	 * 注释:检查（测）日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_03_086;
	 public $_hrb01_03_086_type='date';
	/**
 	 * 注释:检查（测）人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_03_087;
	 public $_hrb01_03_087_type='varchar2';
	/**
 	 * 注释:检查（测）机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb01_03_088;
	 public $_hrb01_03_088_type='varchar2';
	/**
 	 * 注释:建档日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb01_03_089;
	 public $_hrb01_03_089_type='date';
	/**
 	 * 注释:建档人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb01_03_090;
	 public $_hrb01_03_090_type='varchar2';
	/**
 	 * 注释:建档机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb01_03_091;
	 public $_hrb01_03_091_type='varchar2';
}
