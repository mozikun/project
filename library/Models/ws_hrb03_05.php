<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb03_05 extends dao_oracle{
	 public $__table = 'ws_hrb03_05';
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
 	 public $hrb03_05_001;
	 public $_hrb03_05_001_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_002;
	 public $_hrb03_05_002_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_05_003;
	 public $_hrb03_05_003_type='date';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_004;
	 public $_hrb03_05_004_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb03_05_005;
	 public $_hrb03_05_005_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_006;
	 public $_hrb03_05_006_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_05_007;
	 public $_hrb03_05_007_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_05_008;
	 public $_hrb03_05_008_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_05_009;
	 public $_hrb03_05_009_type='varchar2';
	/**
 	 * 注释:地址-乡（镇、街道办事处）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_05_010;
	 public $_hrb03_05_010_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_05_011;
	 public $_hrb03_05_011_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_05_012;
	 public $_hrb03_05_012_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb03_05_013;
	 public $_hrb03_05_013_type='varchar2';
	/**
 	 * 注释:文化程度代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_05_014;
	 public $_hrb03_05_014_type='varchar2';
	/**
 	 * 注释:职业类别代码(国标)
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb03_05_015;
	 public $_hrb03_05_015_type='varchar2';
	/**
 	 * 注释:身高（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_016;
	 public $_hrb03_05_016_type='number';
	/**
 	 * 注释:体重（kg）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_017;
	 public $_hrb03_05_017_type='number';
	/**
 	 * 注释:腹围（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_018;
	 public $_hrb03_05_018_type='number';
	/**
 	 * 注释:脾切除史标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_019;
	 public $_hrb03_05_019_type='number';
	/**
 	 * 注释:脾切除日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_05_020;
	 public $_hrb03_05_020_type='date';
	/**
 	 * 注释:腹水标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_021;
	 public $_hrb03_05_021_type='number';
	/**
 	 * 注释:末次腹水日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_05_022;
	 public $_hrb03_05_022_type='date';
	/**
 	 * 注释:上消化道出血史标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_023;
	 public $_hrb03_05_023_type='number';
	/**
 	 * 注释:末次上消化道出血日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_05_024;
	 public $_hrb03_05_024_type='date';
	/**
 	 * 注释:肝昏迷史标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_025;
	 public $_hrb03_05_025_type='number';
	/**
 	 * 注释:末次肝昏迷日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_05_026;
	 public $_hrb03_05_026_type='date';
	/**
 	 * 注释:肝炎标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_027;
	 public $_hrb03_05_027_type='number';
	/**
 	 * 注释:肝炎类型代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_028;
	 public $_hrb03_05_028_type='varchar2';
	/**
 	 * 注释:血吸虫病合并症代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_029;
	 public $_hrb03_05_029_type='varchar2';
	/**
 	 * 注释:既往救治情况标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_030;
	 public $_hrb03_05_030_type='number';
	/**
 	 * 注释:外科救治日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_05_031;
	 public $_hrb03_05_031_type='date';
	/**
 	 * 注释:内科救治日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_05_032;
	 public $_hrb03_05_032_type='date';
	/**
 	 * 注释:感染日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_05_033;
	 public $_hrb03_05_033_type='date';
	/**
 	 * 注释:血吸虫病感染地点
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_05_034;
	 public $_hrb03_05_034_type='varchar2';
	/**
 	 * 注释:血吸虫病感染环境名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_05_035;
	 public $_hrb03_05_035_type='varchar2';
	/**
 	 * 注释:血吸虫病感染方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_036;
	 public $_hrb03_05_036_type='varchar2';
	/**
 	 * 注释:首次出现症状日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_05_037;
	 public $_hrb03_05_037_type='date';
	/**
 	 * 注释:发热标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_038;
	 public $_hrb03_05_038_type='number';
	/**
 	 * 注释:咳嗽标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_039;
	 public $_hrb03_05_039_type='number';
	/**
 	 * 注释:头痛标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_040;
	 public $_hrb03_05_040_type='number';
	/**
 	 * 注释:头昏标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_041;
	 public $_hrb03_05_041_type='number';
	/**
 	 * 注释:腹痛标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_042;
	 public $_hrb03_05_042_type='number';
	/**
 	 * 注释:腹泻标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_043;
	 public $_hrb03_05_043_type='number';
	/**
 	 * 注释:腹胀标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_044;
	 public $_hrb03_05_044_type='number';
	/**
 	 * 注释:恶心标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_045;
	 public $_hrb03_05_045_type='number';
	/**
 	 * 注释:呕吐标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_046;
	 public $_hrb03_05_046_type='number';
	/**
 	 * 注释:呕血标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_047;
	 public $_hrb03_05_047_type='number';
	/**
 	 * 注释:便血标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_048;
	 public $_hrb03_05_048_type='number';
	/**
 	 * 注释:黄疸标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_049;
	 public $_hrb03_05_049_type='number';
	/**
 	 * 注释:腹壁静脉显露标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_050;
	 public $_hrb03_05_050_type='number';
	/**
 	 * 注释:肝质地类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_051;
	 public $_hrb03_05_051_type='varchar2';
	/**
 	 * 注释:肝脏剑突下测量值（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_052;
	 public $_hrb03_05_052_type='number';
	/**
 	 * 注释:肝脏肋下测量值（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_053;
	 public $_hrb03_05_053_type='number';
	/**
 	 * 注释:脾质地类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_054;
	 public $_hrb03_05_054_type='varchar2';
	/**
 	 * 注释:脾肿大分级代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_055;
	 public $_hrb03_05_055_type='varchar2';
	/**
 	 * 注释:血小板计数值(G/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_056;
	 public $_hrb03_05_056_type='number';
	/**
 	 * 注释:红细胞计数值（G/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_057;
	 public $_hrb03_05_057_type='number';
	/**
 	 * 注释:白细胞计数值(G/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_058;
	 public $_hrb03_05_058_type='number';
	/**
 	 * 注释:中性粒细胞百分率（％）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_059;
	 public $_hrb03_05_059_type='number';
	/**
 	 * 注释:淋巴细胞百分率（％）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_060;
	 public $_hrb03_05_060_type='number';
	/**
 	 * 注释:嗜酸性粒细胞百分率（％）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_061;
	 public $_hrb03_05_061_type='number';
	/**
 	 * 注释:贫血分级代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_062;
	 public $_hrb03_05_062_type='varchar2';
	/**
 	 * 注释:血吸虫病检查方法代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_063;
	 public $_hrb03_05_063_type='varchar2';
	/**
 	 * 注释:血吸虫病免疫学检查方法代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_064;
	 public $_hrb03_05_064_type='varchar2';
	/**
 	 * 注释:血吸虫病原学检查方法代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_065;
	 public $_hrb03_05_065_type='varchar2';
	/**
 	 * 注释:血吸虫病检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_066;
	 public $_hrb03_05_066_type='varchar2';
	/**
 	 * 注释:检查（测）日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_05_067;
	 public $_hrb03_05_067_type='date';
	/**
 	 * 注释:B超检查标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_068;
	 public $_hrb03_05_068_type='number';
	/**
 	 * 注释:肝脏前后径（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_069;
	 public $_hrb03_05_069_type='number';
	/**
 	 * 注释:肝脏斜径（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_070;
	 public $_hrb03_05_070_type='number';
	/**
 	 * 注释:实质纤维化程度代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_071;
	 public $_hrb03_05_071_type='varchar2';
	/**
 	 * 注释:门静脉内径（mm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_072;
	 public $_hrb03_05_072_type='number';
	/**
 	 * 注释:脾脏长径（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_073;
	 public $_hrb03_05_073_type='number';
	/**
 	 * 注释:脾脏厚度（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_074;
	 public $_hrb03_05_074_type='number';
	/**
 	 * 注释:脾脏肋下（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_075;
	 public $_hrb03_05_075_type='number';
	/**
 	 * 注释:诊断状态代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_076;
	 public $_hrb03_05_076_type='varchar2';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_05_077;
	 public $_hrb03_05_077_type='date';
	/**
 	 * 注释:首次诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_05_078;
	 public $_hrb03_05_078_type='date';
	/**
 	 * 注释:首次诊断血吸虫病依据代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_079;
	 public $_hrb03_05_079_type='varchar2';
	/**
 	 * 注释:首次确诊日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_05_080;
	 public $_hrb03_05_080_type='date';
	/**
 	 * 注释:首次诊断为晚期血吸虫病病例类型代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_081;
	 public $_hrb03_05_081_type='varchar2';
	/**
 	 * 注释:病原治疗标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_082;
	 public $_hrb03_05_082_type='number';
	/**
 	 * 注释:病原治疗次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_083;
	 public $_hrb03_05_083_type='number';
	/**
 	 * 注释:末次血吸虫病原治疗日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_05_084;
	 public $_hrb03_05_084_type='date';
	/**
 	 * 注释:血吸虫病治疗方案代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_085;
	 public $_hrb03_05_085_type='varchar2';
	/**
 	 * 注释:药物名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb03_05_086;
	 public $_hrb03_05_086_type='varchar2';
	/**
 	 * 注释:治疗药物剂量（mg/kg）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_087;
	 public $_hrb03_05_087_type='number';
	/**
 	 * 注释:治疗药物疗程（d）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_088;
	 public $_hrb03_05_088_type='number';
	/**
 	 * 注释:血吸虫病诊断机构级别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_089;
	 public $_hrb03_05_089_type='varchar2';
	/**
 	 * 注释:血吸虫病治疗机构级别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_090;
	 public $_hrb03_05_090_type='varchar2';
	/**
 	 * 注释:劳动能力分级代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_091;
	 public $_hrb03_05_091_type='varchar2';
	/**
 	 * 注释:血吸虫病转归代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_092;
	 public $_hrb03_05_092_type='varchar2';
	/**
 	 * 注释:根本死因代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrb03_05_093;
	 public $_hrb03_05_093_type='varchar2';
	/**
 	 * 注释:门诊费用-分类
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_05_094;
	 public $_hrb03_05_094_type='varchar2';
	/**
 	 * 注释:门诊费用-分类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_05_095;
	 public $_hrb03_05_095_type='varchar2';
	/**
 	 * 注释:门诊费用-金额（元/人民币）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_096;
	 public $_hrb03_05_096_type='number';
	/**
 	 * 注释:门诊费用-支付方式代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_05_097;
	 public $_hrb03_05_097_type='varchar2';
	/**
 	 * 注释:住院费用-分类
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_05_098;
	 public $_hrb03_05_098_type='varchar2';
	/**
 	 * 注释:住院费用-分类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_05_099;
	 public $_hrb03_05_099_type='varchar2';
	/**
 	 * 注释:住院费用-金额（元/人民币）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_100;
	 public $_hrb03_05_100_type='number';
	/**
 	 * 注释:住院费用-医疗付款方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_05_101;
	 public $_hrb03_05_101_type='varchar2';
	/**
 	 * 注释:个人承担费用（元/人民币） 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_05_102;
	 public $_hrb03_05_102_type='number';
	/**
 	 * 注释:调查者姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_05_103;
	 public $_hrb03_05_103_type='varchar2';
	/**
 	 * 注释:调查日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_05_104;
	 public $_hrb03_05_104_type='date';
}
