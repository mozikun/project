<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb02_06 extends dao_oracle{
	 public $__table = 'ws_hrb02_06';
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
 	 public $hrb02_06_001;
	 public $_hrb02_06_001_type='varchar2';
	/**
 	 * 注释:住院号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hrb02_06_002;
	 public $_hrb02_06_002_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_06_003;
	 public $_hrb02_06_003_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_06_004;
	 public $_hrb02_06_004_type='date';
	/**
 	 * 注释:民族代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_06_005;
	 public $_hrb02_06_005_type='varchar2';
	/**
 	 * 注释:文化程度代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_06_006;
	 public $_hrb02_06_006_type='varchar2';
	/**
 	 * 注释:家庭年人均收入类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_06_007;
	 public $_hrb02_06_007_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_06_008;
	 public $_hrb02_06_008_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb02_06_009;
	 public $_hrb02_06_009_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_06_010;
	 public $_hrb02_06_010_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_06_011;
	 public $_hrb02_06_011_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_06_012;
	 public $_hrb02_06_012_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_06_014;
	 public $_hrb02_06_014_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb02_06_015;
	 public $_hrb02_06_015_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb02_06_016;
	 public $_hrb02_06_016_type='varchar2';
	/**
 	 * 注释:常住地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_06_017;
	 public $_hrb02_06_017_type='varchar2';
	/**
 	 * 注释:孕次
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_06_018;
	 public $_hrb02_06_018_type='number';
	/**
 	 * 注释:产次
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_06_019;
	 public $_hrb02_06_019_type='number';
	/**
 	 * 注释:死胎例数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_06_020;
	 public $_hrb02_06_020_type='number';
	/**
 	 * 注释:自然流产次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_06_021;
	 public $_hrb02_06_021_type='number';
	/**
 	 * 注释:出生缺陷儿例数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_06_022;
	 public $_hrb02_06_022_type='number';
	/**
 	 * 注释:家族遗传性疾病史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb02_06_023;
	 public $_hrb02_06_023_type='varchar2';
	/**
 	 * 注释:家族近亲婚配标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_06_024;
	 public $_hrb02_06_024_type='number';
	/**
 	 * 注释:家族近亲婚配者与本人关系代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_06_025;
	 public $_hrb02_06_025_type='varchar2';
	/**
 	 * 注释:新生儿性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_06_026;
	 public $_hrb02_06_026_type='varchar2';
	/**
 	 * 注释:胎龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_06_027;
	 public $_hrb02_06_027_type='number';
	/**
 	 * 注释:分娩日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_06_028;
	 public $_hrb02_06_028_type='date';
	/**
 	 * 注释:体重（g）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_06_029;
	 public $_hrb02_06_029_type='number';
	/**
 	 * 注释:胎数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_06_030;
	 public $_hrb02_06_030_type='number';
	/**
 	 * 注释:多胎类型代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_06_031;
	 public $_hrb02_06_031_type='varchar2';
	/**
 	 * 注释:出生缺陷儿结局代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_06_032;
	 public $_hrb02_06_032_type='varchar2';
	/**
 	 * 注释:治疗性引产标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_06_033;
	 public $_hrb02_06_033_type='number';
	/**
 	 * 注释:出生缺陷诊断依据类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_06_034;
	 public $_hrb02_06_034_type='varchar2';
	/**
 	 * 注释:出生缺陷确诊时间类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_06_035;
	 public $_hrb02_06_035_type='varchar2';
	/**
 	 * 注释:出生缺陷类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_06_036;
	 public $_hrb02_06_036_type='varchar2';
	/**
 	 * 注释:孕早期患病-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb02_06_037;
	 public $_hrb02_06_037_type='number';
	/**
 	 * 注释:孕早期患病-情况
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb02_06_038;
	 public $_hrb02_06_038_type='varchar2';
	/**
 	 * 注释:孕早期服药类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_06_039;
	 public $_hrb02_06_039_type='varchar2';
	/**
 	 * 注释:药物名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb02_06_040;
	 public $_hrb02_06_040_type='varchar2';
	/**
 	 * 注释:孕早期接触有害因素-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb02_06_041;
	 public $_hrb02_06_041_type='varchar2';
	/**
 	 * 注释:孕早期接触有害因素-情况
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrb02_06_042;
	 public $_hrb02_06_042_type='varchar2';
	/**
 	 * 注释:填报日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_06_043;
	 public $_hrb02_06_043_type='date';
	/**
 	 * 注释:填报人姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_06_044;
	 public $_hrb02_06_044_type='varchar2';
	/**
 	 * 注释:填报人职称代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_06_045;
	 public $_hrb02_06_045_type='varchar2';
	/**
 	 * 注释:填报单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb02_06_046;
	 public $_hrb02_06_046_type='varchar2';
	/**
 	 * 注释:医院审表日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_06_047;
	 public $_hrb02_06_047_type='date';
	/**
 	 * 注释:医院审表人姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_06_048;
	 public $_hrb02_06_048_type='varchar2';
	/**
 	 * 注释:医院审表人职称代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_06_049;
	 public $_hrb02_06_049_type='varchar2';
	/**
 	 * 注释:省级审表日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb02_06_050;
	 public $_hrb02_06_050_type='date';
	/**
 	 * 注释:省级审表人姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb02_06_051;
	 public $_hrb02_06_051_type='varchar2';
	/**
 	 * 注释:省级审表人职称代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb02_06_052;
	 public $_hrb02_06_052_type='varchar2';
}
