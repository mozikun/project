<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb04_02 extends dao_oracle{
	 public $__table = 'ws_hrb04_02';
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
 	 public $hrb04_02_001;
	 public $_hrb04_02_001_type='varchar2';
	/**
 	 * 注释:病案号
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb04_02_002;
	 public $_hrb04_02_002_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_02_003;
	 public $_hrb04_02_003_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_004;
	 public $_hrb04_02_004_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_005;
	 public $_hrb04_02_005_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb04_02_006;
	 public $_hrb04_02_006_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_007;
	 public $_hrb04_02_007_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb04_02_008;
	 public $_hrb04_02_008_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_02_009;
	 public $_hrb04_02_009_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_02_010;
	 public $_hrb04_02_010_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_02_011;
	 public $_hrb04_02_011_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_02_013;
	 public $_hrb04_02_013_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_02_014;
	 public $_hrb04_02_014_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb04_02_015;
	 public $_hrb04_02_015_type='varchar2';
	/**
 	 * 注释:责任医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_02_016;
	 public $_hrb04_02_016_type='varchar2';
	/**
 	 * 注释:随访医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_02_017;
	 public $_hrb04_02_017_type='varchar2';
	/**
 	 * 注释:随访方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_018;
	 public $_hrb04_02_018_type='varchar2';
	/**
 	 * 注释:随访日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_02_019;
	 public $_hrb04_02_019_type='date';
	/**
 	 * 注释:症状代码(健康检查)
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb04_02_020;
	 public $_hrb04_02_020_type='varchar2';
	/**
 	 * 注释:糖尿病随访评价代码 
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_021;
	 public $_hrb04_02_021_type='varchar2';
	/**
 	 * 注释:体重（kg）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_022;
	 public $_hrb04_02_022_type='number';
	/**
 	 * 注释:体重指数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_023;
	 public $_hrb04_02_023_type='number';
	/**
 	 * 注释:收缩压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_024;
	 public $_hrb04_02_024_type='number';
	/**
 	 * 注释:舒张压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_025;
	 public $_hrb04_02_025_type='number';
	/**
 	 * 注释:日吸烟量(支)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_026;
	 public $_hrb04_02_026_type='number';
	/**
 	 * 注释:日饮酒量(两)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_027;
	 public $_hrb04_02_027_type='number';
	/**
 	 * 注释:日主食量（g）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_028;
	 public $_hrb04_02_028_type='number';
	/**
 	 * 注释:随访饮食合理性评价类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_029;
	 public $_hrb04_02_029_type='varchar2';
	/**
 	 * 注释:随访周期建议代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_030;
	 public $_hrb04_02_030_type='varchar2';
	/**
 	 * 注释:随访遵医行为评价结果代码 
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_031;
	 public $_hrb04_02_031_type='varchar2';
	/**
 	 * 注释:服药依从性代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_032;
	 public $_hrb04_02_032_type='varchar2';
	/**
 	 * 注释:药物名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb04_02_033;
	 public $_hrb04_02_033_type='varchar2';
	/**
 	 * 注释:药物使用-频率
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_02_034;
	 public $_hrb04_02_034_type='varchar2';
	/**
 	 * 注释:药物使用-剂量单位
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb04_02_035;
	 public $_hrb04_02_035_type='varchar2';
	/**
 	 * 注释:药物使用-次剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_036;
	 public $_hrb04_02_036_type='number';
	/**
 	 * 注释:药物使用-总剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_037;
	 public $_hrb04_02_037_type='number';
	/**
 	 * 注释:药物使用-途径代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb04_02_038;
	 public $_hrb04_02_038_type='varchar2';
	/**
 	 * 注释:药物副作用标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_039;
	 public $_hrb04_02_039_type='number';
	/**
 	 * 注释:药物副作用
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_02_040;
	 public $_hrb04_02_040_type='varchar2';
	/**
 	 * 注释:胰岛素用药-使用频率(次/天)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_041;
	 public $_hrb04_02_041_type='number';
	/**
 	 * 注释:胰岛素用药-次剂量(mg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_042;
	 public $_hrb04_02_042_type='number';
	/**
 	 * 注释:转诊科别
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb04_02_043;
	 public $_hrb04_02_043_type='varchar2';
	/**
 	 * 注释:转诊原因
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_02_044;
	 public $_hrb04_02_044_type='varchar2';
	/**
 	 * 注释:检查（测）人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_02_045;
	 public $_hrb04_02_045_type='varchar2';
	/**
 	 * 注释:检查（测）日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_02_046;
	 public $_hrb04_02_046_type='date';
	/**
 	 * 注释:运动方式说明
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_02_047;
	 public $_hrb04_02_047_type='varchar2';
	/**
 	 * 注释:运动频率类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_048;
	 public $_hrb04_02_048_type='varchar2';
	/**
 	 * 注释:运动时间(min)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_049;
	 public $_hrb04_02_049_type='number';
	/**
 	 * 注释:坚持运动时长(年)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_050;
	 public $_hrb04_02_050_type='number';
	/**
 	 * 注释:周运动次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_051;
	 public $_hrb04_02_051_type='number';
	/**
 	 * 注释:饮食习惯代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_052;
	 public $_hrb04_02_052_type='varchar2';
	/**
 	 * 注释:吸烟状况代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_053;
	 public $_hrb04_02_053_type='varchar2';
	/**
 	 * 注释:开始吸烟年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_054;
	 public $_hrb04_02_054_type='number';
	/**
 	 * 注释:戒烟年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_055;
	 public $_hrb04_02_055_type='number';
	/**
 	 * 注释:饮酒频率代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_056;
	 public $_hrb04_02_056_type='varchar2';
	/**
 	 * 注释:饮酒种类代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_057;
	 public $_hrb04_02_057_type='varchar2';
	/**
 	 * 注释:开始饮酒年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_058;
	 public $_hrb04_02_058_type='number';
	/**
 	 * 注释:醉酒标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_059;
	 public $_hrb04_02_059_type='number';
	/**
 	 * 注释:戒酒标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_060;
	 public $_hrb04_02_060_type='number';
	/**
 	 * 注释:戒酒年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_061;
	 public $_hrb04_02_061_type='number';
	/**
 	 * 注释:心理状态代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_062;
	 public $_hrb04_02_062_type='varchar2';
	/**
 	 * 注释:遵医行为
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_063;
	 public $_hrb04_02_063_type='varchar2';
	/**
 	 * 注释:空腹血糖值(mmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_064;
	 public $_hrb04_02_064_type='number';
	/**
 	 * 注释:餐后两小时血糖值(mmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_065;
	 public $_hrb04_02_065_type='number';
	/**
 	 * 注释:糖化血红蛋白值(%)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_066;
	 public $_hrb04_02_066_type='number';
	/**
 	 * 注释:职业暴露标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_067;
	 public $_hrb04_02_067_type='number';
	/**
 	 * 注释:职业暴露危险因素名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb04_02_068;
	 public $_hrb04_02_068_type='varchar2';
	/**
 	 * 注释:职业暴露危险因素种类
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_069;
	 public $_hrb04_02_069_type='varchar2';
	/**
 	 * 注释:有危害因素的具体职业
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_02_070;
	 public $_hrb04_02_070_type='varchar2';
	/**
 	 * 注释:从事有危害因素职业时长(年)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_071;
	 public $_hrb04_02_071_type='number';
	/**
 	 * 注释:防护措施标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_072;
	 public $_hrb04_02_072_type='number';
	/**
 	 * 注释:家庭成员吸烟标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_073;
	 public $_hrb04_02_073_type='number';
	/**
 	 * 注释:家中煤火取暖标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_074;
	 public $_hrb04_02_074_type='number';
	/**
 	 * 注释:家中煤火取暖时间(年)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_075;
	 public $_hrb04_02_075_type='number';
	/**
 	 * 注释:常住地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_02_076;
	 public $_hrb04_02_076_type='varchar2';
	/**
 	 * 注释:现存主要健康问题
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb04_02_077;
	 public $_hrb04_02_077_type='varchar2';
	/**
 	 * 注释:入院日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_02_078;
	 public $_hrb04_02_078_type='date';
	/**
 	 * 注释:入院原因
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_02_079;
	 public $_hrb04_02_079_type='varchar2';
	/**
 	 * 注释:出院日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_02_080;
	 public $_hrb04_02_080_type='date';
	/**
 	 * 注释:医疗机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb04_02_081;
	 public $_hrb04_02_081_type='varchar2';
	/**
 	 * 注释:家庭病床撤床日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_02_082;
	 public $_hrb04_02_082_type='date';
	/**
 	 * 注释:家庭病床建床日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_02_083;
	 public $_hrb04_02_083_type='date';
	/**
 	 * 注释:家庭病床建立原因
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_02_084;
	 public $_hrb04_02_084_type='varchar2';
	/**
 	 * 注释:吸氧时间(h)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_02_085;
	 public $_hrb04_02_085_type='number';
	/**
 	 * 注释:疫苗-名称代码
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $hrb04_02_086;
	 public $_hrb04_02_086_type='varchar2';
	/**
 	 * 注释:疫苗-批号
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_02_087;
	 public $_hrb04_02_087_type='varchar2';
	/**
 	 * 注释:疫苗接种日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_02_088;
	 public $_hrb04_02_088_type='date';
}
