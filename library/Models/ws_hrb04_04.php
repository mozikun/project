<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb04_04 extends dao_oracle{
	 public $__table = 'ws_hrb04_04';
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
 	 public $hrb04_04_001;
	 public $_hrb04_04_001_type='varchar2';
	/**
 	 * 注释:病案号
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb04_04_002;
	 public $_hrb04_04_002_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_04_003;
	 public $_hrb04_04_003_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_04_004;
	 public $_hrb04_04_004_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_04_005;
	 public $_hrb04_04_005_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb04_04_006;
	 public $_hrb04_04_006_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_04_007;
	 public $_hrb04_04_007_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb04_04_008;
	 public $_hrb04_04_008_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_04_009;
	 public $_hrb04_04_009_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_04_010;
	 public $_hrb04_04_010_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_04_011;
	 public $_hrb04_04_011_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_04_013;
	 public $_hrb04_04_013_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_04_014;
	 public $_hrb04_04_014_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb04_04_015;
	 public $_hrb04_04_015_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_04_016;
	 public $_hrb04_04_016_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_04_017;
	 public $_hrb04_04_017_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_04_018;
	 public $_hrb04_04_018_type='varchar2';
	/**
 	 * 注释:责任医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_04_019;
	 public $_hrb04_04_019_type='varchar2';
	/**
 	 * 注释:随访医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_04_020;
	 public $_hrb04_04_020_type='varchar2';
	/**
 	 * 注释:随访日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_04_021;
	 public $_hrb04_04_021_type='date';
	/**
 	 * 注释:精神症状代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb04_04_022;
	 public $_hrb04_04_022_type='varchar2';
	/**
 	 * 注释:自知力评价结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_04_023;
	 public $_hrb04_04_023_type='varchar2';
	/**
 	 * 注释:睡眠情况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_04_024;
	 public $_hrb04_04_024_type='varchar2';
	/**
 	 * 注释:饮食情况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_04_025;
	 public $_hrb04_04_025_type='varchar2';
	/**
 	 * 注释:社会功能情况分类代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_04_026;
	 public $_hrb04_04_026_type='varchar2';
	/**
 	 * 注释:社会功能情况评价代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_04_027;
	 public $_hrb04_04_027_type='varchar2';
	/**
 	 * 注释:躯体疾病名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_04_028;
	 public $_hrb04_04_028_type='varchar2';
	/**
 	 * 注释:药物名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb04_04_029;
	 public $_hrb04_04_029_type='varchar2';
	/**
 	 * 注释:药物使用-频率
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_04_030;
	 public $_hrb04_04_030_type='varchar2';
	/**
 	 * 注释:药物使用-剂量单位
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb04_04_031;
	 public $_hrb04_04_031_type='varchar2';
	/**
 	 * 注释:药物使用-次剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_04_032;
	 public $_hrb04_04_032_type='number';
	/**
 	 * 注释:药物使用-总剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_04_033;
	 public $_hrb04_04_033_type='number';
	/**
 	 * 注释:药物使用-途径代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb04_04_034;
	 public $_hrb04_04_034_type='varchar2';
	/**
 	 * 注释:药物副作用
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_04_035;
	 public $_hrb04_04_035_type='varchar2';
	/**
 	 * 注释:精神分裂症患者服药依从性
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_04_036;
	 public $_hrb04_04_036_type='varchar2';
	/**
 	 * 注释:康复措施指导
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_04_037;
	 public $_hrb04_04_037_type='varchar2';
	/**
 	 * 注释:转诊标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_04_038;
	 public $_hrb04_04_038_type='number';
	/**
 	 * 注释:转入医院名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb04_04_039;
	 public $_hrb04_04_039_type='varchar2';
	/**
 	 * 注释:检查（测）人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_04_040;
	 public $_hrb04_04_040_type='varchar2';
	/**
 	 * 注释:监护人姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_04_041;
	 public $_hrb04_04_041_type='varchar2';
	/**
 	 * 注释:监护人与本人关系
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb04_04_042;
	 public $_hrb04_04_042_type='varchar2';
	/**
 	 * 注释:辖区居委会名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_04_043;
	 public $_hrb04_04_043_type='varchar2';
	/**
 	 * 注释:居委会联系人姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_04_044;
	 public $_hrb04_04_044_type='varchar2';
	/**
 	 * 注释:精神疾患家族史标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_04_045;
	 public $_hrb04_04_045_type='number';
	/**
 	 * 注释:家族性精神疾病名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb04_04_046;
	 public $_hrb04_04_046_type='varchar2';
	/**
 	 * 注释:患家族病成员与本人关系代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb04_04_047;
	 public $_hrb04_04_047_type='varchar2';
	/**
 	 * 注释:精神分裂症患者初次发病年龄（岁）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_04_048;
	 public $_hrb04_04_048_type='number';
	/**
 	 * 注释:既往精神类疾病诊断名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb04_04_049;
	 public $_hrb04_04_049_type='varchar2';
	/**
 	 * 注释:首次确诊日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_04_050;
	 public $_hrb04_04_050_type='date';
	/**
 	 * 注释:既往精神专科医院住院次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_04_051;
	 public $_hrb04_04_051_type='number';
	/**
 	 * 注释:既往门诊治疗情况代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_04_052;
	 public $_hrb04_04_052_type='varchar2';
	/**
 	 * 注释:既往治疗效果类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_04_053;
	 public $_hrb04_04_053_type='varchar2';
	/**
 	 * 注释:既往主要精神症状代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb04_04_054;
	 public $_hrb04_04_054_type='varchar2';
	/**
 	 * 注释:发病对家庭社会的影响类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb04_04_055;
	 public $_hrb04_04_055_type='varchar2';
	/**
 	 * 注释:生活和劳动能力评价结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_04_056;
	 public $_hrb04_04_056_type='varchar2';
	/**
 	 * 注释:精神康复措施
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_04_057;
	 public $_hrb04_04_057_type='varchar2';
	/**
 	 * 注释:治疗形式建议代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_04_058;
	 public $_hrb04_04_058_type='varchar2';
	/**
 	 * 注释:药物治疗建议
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_04_059;
	 public $_hrb04_04_059_type='varchar2';
	/**
 	 * 注释:康复措施建议
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_04_060;
	 public $_hrb04_04_060_type='varchar2';
}
