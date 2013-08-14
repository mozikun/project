<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb02_01 extends dao_oracle{
	 public $__table = 'ws_hrb02_01';
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
 	 public $hrb02_01_001;
	 public $_hrb02_01_001_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_01_002;
	 public $_hrb02_01_002_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_01_003;
	 public $_hrb02_01_003_type='date';
	/**
 	 * 注释:民族代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_01_004;
	 public $_hrb02_01_004_type='varchar2';
	/**
 	 * 注释:文化程度代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_01_005;
	 public $_hrb02_01_005_type='varchar2';
	/**
 	 * 注释:国籍代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb02_01_006;
	 public $_hrb02_01_006_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_007;
	 public $_hrb02_01_007_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb02_01_008;
	 public $_hrb02_01_008_type='varchar2';
	/**
 	 * 注释:职业类别代码(国标)
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb02_01_009;
	 public $_hrb02_01_009_type='varchar2';
	/**
 	 * 注释:工作单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_01_010;
	 public $_hrb02_01_010_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_011;
	 public $_hrb02_01_011_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb02_01_012;
	 public $_hrb02_01_012_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_01_013;
	 public $_hrb02_01_013_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_01_014;
	 public $_hrb02_01_014_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_01_015;
	 public $_hrb02_01_015_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_01_017;
	 public $_hrb02_01_017_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_01_018;
	 public $_hrb02_01_018_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb02_01_019;
	 public $_hrb02_01_019_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_01_020;
	 public $_hrb02_01_020_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_021;
	 public $_hrb02_01_021_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_01_022;
	 public $_hrb02_01_022_type='varchar2';
	/**
 	 * 注释:对方记录表单编号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_01_023;
	 public $_hrb02_01_023_type='varchar2';
	/**
 	 * 注释:对方姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_01_024;
	 public $_hrb02_01_024_type='varchar2';
	/**
 	 * 注释:血缘关系代码
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $hrb02_01_025;
	 public $_hrb02_01_025_type='varchar2';
	/**
 	 * 注释:既往疾病史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_026;
	 public $_hrb02_01_026_type='varchar2';
	/**
 	 * 注释:手术史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_027;
	 public $_hrb02_01_027_type='varchar2';
	/**
 	 * 注释:现病史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_028;
	 public $_hrb02_01_028_type='varchar2';
	/**
 	 * 注释:家族遗传性疾病史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_029;
	 public $_hrb02_01_029_type='varchar2';
	/**
 	 * 注释:患者与本人关系代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_01_030;
	 public $_hrb02_01_030_type='varchar2';
	/**
 	 * 注释:初潮年龄（岁）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_031;
	 public $_hrb02_01_031_type='number';
	/**
 	 * 注释:月经持续时间（d）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_032;
	 public $_hrb02_01_032_type='number';
	/**
 	 * 注释:月经出血量类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_033;
	 public $_hrb02_01_033_type='varchar2';
	/**
 	 * 注释:月经周期（d）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_034;
	 public $_hrb02_01_034_type='number';
	/**
 	 * 注释:痛经程度代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_035;
	 public $_hrb02_01_035_type='varchar2';
	/**
 	 * 注释:末次月经日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_01_036;
	 public $_hrb02_01_036_type='date';
	/**
 	 * 注释:足月产次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_037;
	 public $_hrb02_01_037_type='number';
	/**
 	 * 注释:早产次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_038;
	 public $_hrb02_01_038_type='number';
	/**
 	 * 注释:流产总次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_039;
	 public $_hrb02_01_039_type='number';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_040;
	 public $_hrb02_01_040_type='varchar2';
	/**
 	 * 注释:生育女数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_041;
	 public $_hrb02_01_041_type='number';
	/**
 	 * 注释:生育子数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_042;
	 public $_hrb02_01_042_type='number';
	/**
 	 * 注释:子女患遗传性疾病情况
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_043;
	 public $_hrb02_01_043_type='varchar2';
	/**
 	 * 注释:家族近亲婚配标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_044;
	 public $_hrb02_01_044_type='number';
	/**
 	 * 注释:家族近亲婚配者与本人关系代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_045;
	 public $_hrb02_01_045_type='varchar2';
	/**
 	 * 注释:收缩压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_046;
	 public $_hrb02_01_046_type='number';
	/**
 	 * 注释:舒张压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_047;
	 public $_hrb02_01_047_type='number';
	/**
 	 * 注释:特殊体态检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_048;
	 public $_hrb02_01_048_type='varchar2';
	/**
 	 * 注释:精神状态代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_049;
	 public $_hrb02_01_049_type='varchar2';
	/**
 	 * 注释:特殊面容检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_050;
	 public $_hrb02_01_050_type='varchar2';
	/**
 	 * 注释:五官检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_051;
	 public $_hrb02_01_051_type='varchar2';
	/**
 	 * 注释:智力发育
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_052;
	 public $_hrb02_01_052_type='varchar2';
	/**
 	 * 注释:心律
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_053;
	 public $_hrb02_01_053_type='varchar2';
	/**
 	 * 注释:心率（次/分钟）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_054;
	 public $_hrb02_01_054_type='number';
	/**
 	 * 注释:心脏听诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_055;
	 public $_hrb02_01_055_type='varchar2';
	/**
 	 * 注释:肺部听诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_056;
	 public $_hrb02_01_056_type='varchar2';
	/**
 	 * 注释:肝脏触诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_057;
	 public $_hrb02_01_057_type='varchar2';
	/**
 	 * 注释:四肢检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_058;
	 public $_hrb02_01_058_type='varchar2';
	/**
 	 * 注释:脊柱检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_059;
	 public $_hrb02_01_059_type='varchar2';
	/**
 	 * 注释:皮肤毛发检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_060;
	 public $_hrb02_01_060_type='varchar2';
	/**
 	 * 注释:甲状腺检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_061;
	 public $_hrb02_01_061_type='varchar2';
	/**
 	 * 注释:阴茎检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_062;
	 public $_hrb02_01_062_type='varchar2';
	/**
 	 * 注释:包皮检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_063;
	 public $_hrb02_01_063_type='varchar2';
	/**
 	 * 注释:左侧睾丸检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_064;
	 public $_hrb02_01_064_type='varchar2';
	/**
 	 * 注释:右侧睾丸检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_065;
	 public $_hrb02_01_065_type='varchar2';
	/**
 	 * 注释:左侧附睾检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_066;
	 public $_hrb02_01_066_type='varchar2';
	/**
 	 * 注释:右侧附睾检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_067;
	 public $_hrb02_01_067_type='varchar2';
	/**
 	 * 注释:附睾异常情况
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_068;
	 public $_hrb02_01_068_type='varchar2';
	/**
 	 * 注释:喉结检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_069;
	 public $_hrb02_01_069_type='varchar2';
	/**
 	 * 注释:精索静脉曲张-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_070;
	 public $_hrb02_01_070_type='number';
	/**
 	 * 注释:精索静脉曲张-部位
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_071;
	 public $_hrb02_01_071_type='varchar2';
	/**
 	 * 注释:精索静脉曲张-程度代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_072;
	 public $_hrb02_01_072_type='varchar2';
	/**
 	 * 注释:妇科检查方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_073;
	 public $_hrb02_01_073_type='varchar2';
	/**
 	 * 注释:知情同意标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_074;
	 public $_hrb02_01_074_type='number';
	/**
 	 * 注释:阴毛检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_075;
	 public $_hrb02_01_075_type='varchar2';
	/**
 	 * 注释:外阴检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_076;
	 public $_hrb02_01_076_type='varchar2';
	/**
 	 * 注释:阴道检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_077;
	 public $_hrb02_01_077_type='varchar2';
	/**
 	 * 注释:子宫检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_078;
	 public $_hrb02_01_078_type='varchar2';
	/**
 	 * 注释:左侧附件检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_079;
	 public $_hrb02_01_079_type='varchar2';
	/**
 	 * 注释:右侧附件检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_080;
	 public $_hrb02_01_080_type='varchar2';
	/**
 	 * 注释:宫颈检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_081;
	 public $_hrb02_01_081_type='varchar2';
	/**
 	 * 注释:左侧乳腺检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_082;
	 public $_hrb02_01_082_type='varchar2';
	/**
 	 * 注释:右侧乳腺检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_083;
	 public $_hrb02_01_083_type='varchar2';
	/**
 	 * 注释:阴道分泌物性状描述
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_084;
	 public $_hrb02_01_084_type='varchar2';
	/**
 	 * 注释:胸部X线检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_085;
	 public $_hrb02_01_085_type='varchar2';
	/**
 	 * 注释:白细胞分类结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_086;
	 public $_hrb02_01_086_type='varchar2';
	/**
 	 * 注释:白细胞计数值(G/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_087;
	 public $_hrb02_01_087_type='number';
	/**
 	 * 注释:红细胞计数值（G/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_088;
	 public $_hrb02_01_088_type='number';
	/**
 	 * 注释:血红蛋白值（g/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_089;
	 public $_hrb02_01_089_type='number';
	/**
 	 * 注释:血小板计数值(G/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_090;
	 public $_hrb02_01_090_type='number';
	/**
 	 * 注释:尿比重
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_091;
	 public $_hrb02_01_091_type='number';
	/**
 	 * 注释:尿蛋白定量检测值（mg/24h）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_092;
	 public $_hrb02_01_092_type='number';
	/**
 	 * 注释:尿糖定量检测(mmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_093;
	 public $_hrb02_01_093_type='number';
	/**
 	 * 注释:尿液酸碱度
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_094;
	 public $_hrb02_01_094_type='number';
	/**
 	 * 注释:血清谷丙转氨酶值（U/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_01_095;
	 public $_hrb02_01_095_type='number';
	/**
 	 * 注释:乙型肝炎病毒表面抗原检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_096;
	 public $_hrb02_01_096_type='varchar2';
	/**
 	 * 注释:淋球菌检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_097;
	 public $_hrb02_01_097_type='varchar2';
	/**
 	 * 注释:梅毒血清学试验结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_098;
	 public $_hrb02_01_098_type='varchar2';
	/**
 	 * 注释:HIV抗体检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_099;
	 public $_hrb02_01_099_type='varchar2';
	/**
 	 * 注释:滴虫检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_100;
	 public $_hrb02_01_100_type='varchar2';
	/**
 	 * 注释:念珠菌检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_101;
	 public $_hrb02_01_101_type='varchar2';
	/**
 	 * 注释:阴道分泌物清洁度代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_102;
	 public $_hrb02_01_102_type='varchar2';
	/**
 	 * 注释:疾病诊断代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrb02_01_103;
	 public $_hrb02_01_103_type='varchar2';
	/**
 	 * 注释:婚前医学检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_104;
	 public $_hrb02_01_104_type='varchar2';
	/**
 	 * 注释:婚检医学意见代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_105;
	 public $_hrb02_01_105_type='varchar2';
	/**
 	 * 注释:婚前卫生指导内容
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_106;
	 public $_hrb02_01_106_type='varchar2';
	/**
 	 * 注释:婚前卫生咨询内容
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_01_107;
	 public $_hrb02_01_107_type='varchar2';
	/**
 	 * 注释:婚检咨询指导结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_01_108;
	 public $_hrb02_01_108_type='varchar2';
	/**
 	 * 注释:检查（测）日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_01_109;
	 public $_hrb02_01_109_type='date';
	/**
 	 * 注释:检查（测）人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_01_110;
	 public $_hrb02_01_110_type='varchar2';
	/**
 	 * 注释:检查（测）机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_01_111;
	 public $_hrb02_01_111_type='varchar2';
	/**
 	 * 注释:填报日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_01_112;
	 public $_hrb02_01_112_type='date';
	/**
 	 * 注释:首诊医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_01_113;
	 public $_hrb02_01_113_type='varchar2';
	/**
 	 * 注释:主检医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_01_114;
	 public $_hrb02_01_114_type='varchar2';
	/**
 	 * 注释:转诊日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_01_115;
	 public $_hrb02_01_115_type='date';
	/**
 	 * 注释:转入医院名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_01_116;
	 public $_hrb02_01_116_type='varchar2';
	/**
 	 * 注释:预约日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_01_117;
	 public $_hrb02_01_117_type='date';
	/**
 	 * 注释:出具《婚前医学检查证明》日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_01_118;
	 public $_hrb02_01_118_type='date';
}
