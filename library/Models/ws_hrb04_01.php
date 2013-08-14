<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb04_01 extends dao_oracle{
	 public $__table = 'ws_hrb04_01';
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
 	 * 注释:现存主要健康问题
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb04_01_071;
	 public $_hrb04_01_071_type='varchar2';
	/**
 	 * 注释:入院日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_01_072;
	 public $_hrb04_01_072_type='date';
	/**
 	 * 注释:入院原因
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_01_073;
	 public $_hrb04_01_073_type='varchar2';
	/**
 	 * 注释:出院日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_01_074;
	 public $_hrb04_01_074_type='date';
	/**
 	 * 注释:医疗机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb04_01_075;
	 public $_hrb04_01_075_type='varchar2';
	/**
 	 * 注释:家庭病床撤床日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_01_076;
	 public $_hrb04_01_076_type='date';
	/**
 	 * 注释:家庭病床建床日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_01_077;
	 public $_hrb04_01_077_type='date';
	/**
 	 * 注释:家庭病床建立原因
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_01_078;
	 public $_hrb04_01_078_type='varchar2';
	/**
 	 * 注释:吸氧时间(h)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_079;
	 public $_hrb04_01_079_type='number';
	/**
 	 * 注释:疫苗-名称代码
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $hrb04_01_080;
	 public $_hrb04_01_080_type='varchar2';
	/**
 	 * 注释:疫苗-批号
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_01_081;
	 public $_hrb04_01_081_type='varchar2';
	/**
 	 * 注释:疫苗接种日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_01_082;
	 public $_hrb04_01_082_type='date';
	/**
 	 * 注释:健康档案标识符
	 * 
	 * 
	 * @var VARCHAR2(69)
	 **/
 	 public $hrb04_01_001;
	 public $_hrb04_01_001_type='varchar2';
	/**
 	 * 注释:病案号
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb04_01_002;
	 public $_hrb04_01_002_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_01_003;
	 public $_hrb04_01_003_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_004;
	 public $_hrb04_01_004_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_005;
	 public $_hrb04_01_005_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb04_01_006;
	 public $_hrb04_01_006_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_007;
	 public $_hrb04_01_007_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb04_01_008;
	 public $_hrb04_01_008_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_01_009;
	 public $_hrb04_01_009_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_01_010;
	 public $_hrb04_01_010_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_01_011;
	 public $_hrb04_01_011_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_01_013;
	 public $_hrb04_01_013_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_01_014;
	 public $_hrb04_01_014_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb04_01_015;
	 public $_hrb04_01_015_type='varchar2';
	/**
 	 * 注释:责任医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_01_016;
	 public $_hrb04_01_016_type='varchar2';
	/**
 	 * 注释:随访医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_01_017;
	 public $_hrb04_01_017_type='varchar2';
	/**
 	 * 注释:随访方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_018;
	 public $_hrb04_01_018_type='varchar2';
	/**
 	 * 注释:随访日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_01_019;
	 public $_hrb04_01_019_type='date';
	/**
 	 * 注释:症状代码(健康检查)
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb04_01_020;
	 public $_hrb04_01_020_type='varchar2';
	/**
 	 * 注释:高血压随访评价结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_021;
	 public $_hrb04_01_021_type='varchar2';
	/**
 	 * 注释:体重（kg）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_022;
	 public $_hrb04_01_022_type='number';
	/**
 	 * 注释:体重指数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_023;
	 public $_hrb04_01_023_type='number';
	/**
 	 * 注释:收缩压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_024;
	 public $_hrb04_01_024_type='number';
	/**
 	 * 注释:舒张压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_025;
	 public $_hrb04_01_025_type='number';
	/**
 	 * 注释:日吸烟量(支)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_026;
	 public $_hrb04_01_026_type='number';
	/**
 	 * 注释:日饮酒量(两)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_027;
	 public $_hrb04_01_027_type='number';
	/**
 	 * 注释:随访饮食合理性评价类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_028;
	 public $_hrb04_01_028_type='varchar2';
	/**
 	 * 注释:随访周期建议代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_029;
	 public $_hrb04_01_029_type='varchar2';
	/**
 	 * 注释:随访遵医行为评价结果代码 
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_030;
	 public $_hrb04_01_030_type='varchar2';
	/**
 	 * 注释:服药依从性代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_031;
	 public $_hrb04_01_031_type='varchar2';
	/**
 	 * 注释:药物名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb04_01_032;
	 public $_hrb04_01_032_type='varchar2';
	/**
 	 * 注释:药物使用-频率
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_01_033;
	 public $_hrb04_01_033_type='varchar2';
	/**
 	 * 注释:药物使用-剂量单位
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb04_01_034;
	 public $_hrb04_01_034_type='varchar2';
	/**
 	 * 注释:药物使用-次剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_035;
	 public $_hrb04_01_035_type='number';
	/**
 	 * 注释:药物使用-总剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_036;
	 public $_hrb04_01_036_type='number';
	/**
 	 * 注释:药物使用-途径代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb04_01_037;
	 public $_hrb04_01_037_type='varchar2';
	/**
 	 * 注释:药物副作用标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_038;
	 public $_hrb04_01_038_type='number';
	/**
 	 * 注释:药物副作用
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_01_039;
	 public $_hrb04_01_039_type='varchar2';
	/**
 	 * 注释:转诊科别
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb04_01_040;
	 public $_hrb04_01_040_type='varchar2';
	/**
 	 * 注释:转诊原因
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_01_041;
	 public $_hrb04_01_041_type='varchar2';
	/**
 	 * 注释:检查（测）人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_01_042;
	 public $_hrb04_01_042_type='varchar2';
	/**
 	 * 注释:检查（测）日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_01_043;
	 public $_hrb04_01_043_type='date';
	/**
 	 * 注释:运动方式说明
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_01_044;
	 public $_hrb04_01_044_type='varchar2';
	/**
 	 * 注释:运动频率类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_045;
	 public $_hrb04_01_045_type='varchar2';
	/**
 	 * 注释:运动时间(min)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_046;
	 public $_hrb04_01_046_type='number';
	/**
 	 * 注释:坚持运动时长(年)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_047;
	 public $_hrb04_01_047_type='number';
	/**
 	 * 注释:周运动次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_048;
	 public $_hrb04_01_048_type='number';
	/**
 	 * 注释:饮食习惯代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_049;
	 public $_hrb04_01_049_type='varchar2';
	/**
 	 * 注释:吸烟状况代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_050;
	 public $_hrb04_01_050_type='varchar2';
	/**
 	 * 注释:开始吸烟年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_051;
	 public $_hrb04_01_051_type='number';
	/**
 	 * 注释:戒烟年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_052;
	 public $_hrb04_01_052_type='number';
	/**
 	 * 注释:饮酒频率代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_053;
	 public $_hrb04_01_053_type='varchar2';
	/**
 	 * 注释:饮酒种类代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_054;
	 public $_hrb04_01_054_type='varchar2';
	/**
 	 * 注释:开始饮酒年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_055;
	 public $_hrb04_01_055_type='number';
	/**
 	 * 注释:醉酒标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_056;
	 public $_hrb04_01_056_type='number';
	/**
 	 * 注释:戒酒标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_057;
	 public $_hrb04_01_057_type='number';
	/**
 	 * 注释:戒酒年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_058;
	 public $_hrb04_01_058_type='number';
	/**
 	 * 注释:心理状态代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_059;
	 public $_hrb04_01_059_type='varchar2';
	/**
 	 * 注释:遵医行为
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_060;
	 public $_hrb04_01_060_type='varchar2';
	/**
 	 * 注释:职业暴露标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_061;
	 public $_hrb04_01_061_type='number';
	/**
 	 * 注释:职业暴露危险因素名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb04_01_062;
	 public $_hrb04_01_062_type='varchar2';
	/**
 	 * 注释:职业暴露危险因素种类
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_063;
	 public $_hrb04_01_063_type='varchar2';
	/**
 	 * 注释:有危害因素的具体职业
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_01_064;
	 public $_hrb04_01_064_type='varchar2';
	/**
 	 * 注释:从事有危害因素职业时长(年)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_065;
	 public $_hrb04_01_065_type='number';
	/**
 	 * 注释:防护措施标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_066;
	 public $_hrb04_01_066_type='number';
	/**
 	 * 注释:家庭成员吸烟标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_067;
	 public $_hrb04_01_067_type='number';
	/**
 	 * 注释:家中煤火取暖标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_068;
	 public $_hrb04_01_068_type='number';
	/**
 	 * 注释:家中煤火取暖时间(年)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_01_069;
	 public $_hrb04_01_069_type='number';
	/**
 	 * 注释:常住地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_01_070;
	 public $_hrb04_01_070_type='varchar2';
}
