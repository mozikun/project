<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb04_05 extends dao_oracle{
	 public $__table = 'ws_hrb04_05';
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
 	 * 注释:健康档案标识符
	 * 
	 * 
	 * @var VARCHAR2(69)
	 **/
 	 public $hrb04_05_001;
	 public $_hrb04_05_001_type='varchar2';
	/**
 	 * 注释:病案号
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb04_05_002;
	 public $_hrb04_05_002_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_05_003;
	 public $_hrb04_05_003_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_004;
	 public $_hrb04_05_004_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_005;
	 public $_hrb04_05_005_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb04_05_006;
	 public $_hrb04_05_006_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_007;
	 public $_hrb04_05_007_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb04_05_008;
	 public $_hrb04_05_008_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_05_009;
	 public $_hrb04_05_009_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_05_010;
	 public $_hrb04_05_010_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_05_011;
	 public $_hrb04_05_011_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_05_013;
	 public $_hrb04_05_013_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_05_014;
	 public $_hrb04_05_014_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb04_05_015;
	 public $_hrb04_05_015_type='varchar2';
	/**
 	 * 注释:责任医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_05_016;
	 public $_hrb04_05_016_type='varchar2';
	/**
 	 * 注释:随访医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_05_017;
	 public $_hrb04_05_017_type='varchar2';
	/**
 	 * 注释:随访方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_018;
	 public $_hrb04_05_018_type='varchar2';
	/**
 	 * 注释:随访日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_05_019;
	 public $_hrb04_05_019_type='date';
	/**
 	 * 注释:症状代码(健康检查)
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb04_05_020;
	 public $_hrb04_05_020_type='varchar2';
	/**
 	 * 注释:体重（kg）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_021;
	 public $_hrb04_05_021_type='number';
	/**
 	 * 注释:日吸烟量(支)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_022;
	 public $_hrb04_05_022_type='number';
	/**
 	 * 注释:日饮酒量(两)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_023;
	 public $_hrb04_05_023_type='number';
	/**
 	 * 注释:随访饮食合理性评价类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_024;
	 public $_hrb04_05_024_type='varchar2';
	/**
 	 * 注释:随访周期建议代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_025;
	 public $_hrb04_05_025_type='varchar2';
	/**
 	 * 注释:随访遵医行为评价结果代码 
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_026;
	 public $_hrb04_05_026_type='varchar2';
	/**
 	 * 注释:随访心理指导-详细描述
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_05_027;
	 public $_hrb04_05_027_type='varchar2';
	/**
 	 * 注释:随访心理指导-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_028;
	 public $_hrb04_05_028_type='number';
	/**
 	 * 注释:服药依从性代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_029;
	 public $_hrb04_05_029_type='varchar2';
	/**
 	 * 注释:药物名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb04_05_030;
	 public $_hrb04_05_030_type='varchar2';
	/**
 	 * 注释:药物使用-频率
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_05_031;
	 public $_hrb04_05_031_type='varchar2';
	/**
 	 * 注释:药物使用-剂量单位
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb04_05_032;
	 public $_hrb04_05_032_type='varchar2';
	/**
 	 * 注释:药物使用-次剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_033;
	 public $_hrb04_05_033_type='number';
	/**
 	 * 注释:药物使用-总剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_034;
	 public $_hrb04_05_034_type='number';
	/**
 	 * 注释:药物使用-途径代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb04_05_035;
	 public $_hrb04_05_035_type='varchar2';
	/**
 	 * 注释:检查（测）人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_05_036;
	 public $_hrb04_05_036_type='varchar2';
	/**
 	 * 注释:检查（测）日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_05_037;
	 public $_hrb04_05_037_type='date';
	/**
 	 * 注释:运动方式说明
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_05_038;
	 public $_hrb04_05_038_type='varchar2';
	/**
 	 * 注释:运动频率类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_039;
	 public $_hrb04_05_039_type='varchar2';
	/**
 	 * 注释:运动时间(min)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_040;
	 public $_hrb04_05_040_type='number';
	/**
 	 * 注释:坚持运动时长(年)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_041;
	 public $_hrb04_05_041_type='number';
	/**
 	 * 注释:周运动次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_042;
	 public $_hrb04_05_042_type='number';
	/**
 	 * 注释:饮食习惯代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_043;
	 public $_hrb04_05_043_type='varchar2';
	/**
 	 * 注释:吸烟状况代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_044;
	 public $_hrb04_05_044_type='varchar2';
	/**
 	 * 注释:开始吸烟年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_045;
	 public $_hrb04_05_045_type='number';
	/**
 	 * 注释:戒烟年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_046;
	 public $_hrb04_05_046_type='number';
	/**
 	 * 注释:饮酒频率代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_047;
	 public $_hrb04_05_047_type='varchar2';
	/**
 	 * 注释:饮酒种类代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_048;
	 public $_hrb04_05_048_type='varchar2';
	/**
 	 * 注释:开始饮酒年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_049;
	 public $_hrb04_05_049_type='number';
	/**
 	 * 注释:醉酒标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_050;
	 public $_hrb04_05_050_type='number';
	/**
 	 * 注释:戒酒标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_051;
	 public $_hrb04_05_051_type='number';
	/**
 	 * 注释:戒酒年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_052;
	 public $_hrb04_05_052_type='number';
	/**
 	 * 注释:心理状态代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_053;
	 public $_hrb04_05_053_type='varchar2';
	/**
 	 * 注释:遵医行为
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_054;
	 public $_hrb04_05_054_type='varchar2';
	/**
 	 * 注释:职业暴露标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_055;
	 public $_hrb04_05_055_type='number';
	/**
 	 * 注释:职业暴露危险因素名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb04_05_056;
	 public $_hrb04_05_056_type='varchar2';
	/**
 	 * 注释:职业暴露危险因素种类
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_057;
	 public $_hrb04_05_057_type='varchar2';
	/**
 	 * 注释:有危害因素的具体职业
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_05_058;
	 public $_hrb04_05_058_type='varchar2';
	/**
 	 * 注释:从事有危害因素职业时长(年)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_059;
	 public $_hrb04_05_059_type='number';
	/**
 	 * 注释:防护措施标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_060;
	 public $_hrb04_05_060_type='number';
	/**
 	 * 注释:家庭成员吸烟标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_061;
	 public $_hrb04_05_061_type='number';
	/**
 	 * 注释:家中煤火取暖标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_062;
	 public $_hrb04_05_062_type='number';
	/**
 	 * 注释:家中煤火取暖时间(年)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_063;
	 public $_hrb04_05_063_type='number';
	/**
 	 * 注释:常住地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_05_064;
	 public $_hrb04_05_064_type='varchar2';
	/**
 	 * 注释:现存主要健康问题
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb04_05_065;
	 public $_hrb04_05_065_type='varchar2';
	/**
 	 * 注释:入院日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_05_066;
	 public $_hrb04_05_066_type='date';
	/**
 	 * 注释:入院原因
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_05_067;
	 public $_hrb04_05_067_type='varchar2';
	/**
 	 * 注释:出院日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_05_068;
	 public $_hrb04_05_068_type='date';
	/**
 	 * 注释:医疗机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb04_05_069;
	 public $_hrb04_05_069_type='varchar2';
	/**
 	 * 注释:家庭病床撤床日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_05_070;
	 public $_hrb04_05_070_type='date';
	/**
 	 * 注释:家庭病床建床日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_05_071;
	 public $_hrb04_05_071_type='date';
	/**
 	 * 注释:家庭病床建立原因
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_05_072;
	 public $_hrb04_05_072_type='varchar2';
	/**
 	 * 注释:吸氧时间(h)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_05_073;
	 public $_hrb04_05_073_type='number';
	/**
 	 * 注释:疫苗-名称代码
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $hrb04_05_074;
	 public $_hrb04_05_074_type='varchar2';
	/**
 	 * 注释:疫苗-批号
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_05_075;
	 public $_hrb04_05_075_type='varchar2';
	/**
 	 * 注释:疫苗接种日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_05_076;
	 public $_hrb04_05_076_type='date';
}
