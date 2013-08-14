<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb04_03 extends dao_oracle{
	 public $__table = 'ws_hrb04_03';
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
 	 public $hrb04_03_001;
	 public $_hrb04_03_001_type='varchar2';
	/**
 	 * 注释:肿瘤病情告知病人情况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_03_002;
	 public $_hrb04_03_002_type='varchar2';
	/**
 	 * 注释:门诊号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hrb04_03_003;
	 public $_hrb04_03_003_type='varchar2';
	/**
 	 * 注释:住院号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hrb04_03_004;
	 public $_hrb04_03_004_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_03_005;
	 public $_hrb04_03_005_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb04_03_006;
	 public $_hrb04_03_006_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_03_007;
	 public $_hrb04_03_007_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_03_008;
	 public $_hrb04_03_008_type='varchar2';
	/**
 	 * 注释:民族代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb04_03_009;
	 public $_hrb04_03_009_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_03_010;
	 public $_hrb04_03_010_type='date';
	/**
 	 * 注释:职业类别代码(国标)
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb04_03_011;
	 public $_hrb04_03_011_type='varchar2';
	/**
 	 * 注释:工作单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb04_03_012;
	 public $_hrb04_03_012_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_03_013;
	 public $_hrb04_03_013_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb04_03_014;
	 public $_hrb04_03_014_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_03_015;
	 public $_hrb04_03_015_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_03_016;
	 public $_hrb04_03_016_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_03_017;
	 public $_hrb04_03_017_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_03_019;
	 public $_hrb04_03_019_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_03_020;
	 public $_hrb04_03_020_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb04_03_021;
	 public $_hrb04_03_021_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_03_022;
	 public $_hrb04_03_022_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_03_023;
	 public $_hrb04_03_023_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_03_024;
	 public $_hrb04_03_024_type='varchar2';
	/**
 	 * 注释:电子邮件地址
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb04_03_025;
	 public $_hrb04_03_025_type='varchar2';
	/**
 	 * 注释:肿瘤诊断代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrb04_03_026;
	 public $_hrb04_03_026_type='varchar2';
	/**
 	 * 注释:肿瘤学分类代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrb04_03_027;
	 public $_hrb04_03_027_type='varchar2';
	/**
 	 * 注释:病理号
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb04_03_028;
	 public $_hrb04_03_028_type='varchar2';
	/**
 	 * 注释:肿瘤TNM分期代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_03_029;
	 public $_hrb04_03_029_type='varchar2';
	/**
 	 * 注释:肿瘤临床分期代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_03_030;
	 public $_hrb04_03_030_type='varchar2';
	/**
 	 * 注释:首次就诊日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_03_031;
	 public $_hrb04_03_031_type='date';
	/**
 	 * 注释:确诊日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_03_032;
	 public $_hrb04_03_032_type='date';
	/**
 	 * 注释:肿瘤诊断依据代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb04_03_033;
	 public $_hrb04_03_033_type='varchar2';
	/**
 	 * 注释:填报单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb04_03_034;
	 public $_hrb04_03_034_type='varchar2';
	/**
 	 * 注释:报告医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_03_035;
	 public $_hrb04_03_035_type='varchar2';
	/**
 	 * 注释:填报日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_03_036;
	 public $_hrb04_03_036_type='date';
	/**
 	 * 注释:户口迁移日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_03_037;
	 public $_hrb04_03_037_type='date';
	/**
 	 * 注释:撤销随访管理日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_03_038;
	 public $_hrb04_03_038_type='date';
	/**
 	 * 注释:撤销随访管理原因代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_03_039;
	 public $_hrb04_03_039_type='varchar2';
	/**
 	 * 注释:肿瘤家族史标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_03_040;
	 public $_hrb04_03_040_type='number';
	/**
 	 * 注释:患者与本人关系代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb04_03_041;
	 public $_hrb04_03_041_type='varchar2';
	/**
 	 * 注释:肿瘤家族史瘤别
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrb04_03_042;
	 public $_hrb04_03_042_type='varchar2';
	/**
 	 * 注释:肿瘤病人治疗方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_03_043;
	 public $_hrb04_03_043_type='varchar2';
	/**
 	 * 注释:手术机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb04_03_044;
	 public $_hrb04_03_044_type='varchar2';
	/**
 	 * 注释:手术日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_03_045;
	 public $_hrb04_03_045_type='date';
	/**
 	 * 注释:肿瘤手术性质代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_03_046;
	 public $_hrb04_03_046_type='varchar2';
	/**
 	 * 注释:肿瘤放疗机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb04_03_047;
	 public $_hrb04_03_047_type='varchar2';
	/**
 	 * 注释:肿瘤化疗机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb04_03_048;
	 public $_hrb04_03_048_type='varchar2';
	/**
 	 * 注释:肿瘤化疗疗程次数
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb04_03_049;
	 public $_hrb04_03_049_type='varchar2';
	/**
 	 * 注释:肿瘤病人目前疾病情况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_03_050;
	 public $_hrb04_03_050_type='varchar2';
	/**
 	 * 注释:复发-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_03_051;
	 public $_hrb04_03_051_type='number';
	/**
 	 * 注释:复发-次数
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_03_052;
	 public $_hrb04_03_052_type='varchar2';
	/**
 	 * 注释:复发日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_03_053;
	 public $_hrb04_03_053_type='date';
	/**
 	 * 注释:肿瘤病人转移-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_03_054;
	 public $_hrb04_03_054_type='number';
	/**
 	 * 注释:肿瘤病人转移-部位
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb04_03_055;
	 public $_hrb04_03_055_type='varchar2';
	/**
 	 * 注释:肿瘤病人指导内容代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_03_056;
	 public $_hrb04_03_056_type='varchar2';
	/**
 	 * 注释:卡氏评分值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb04_03_057;
	 public $_hrb04_03_057_type='number';
	/**
 	 * 注释:社区管理医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb04_03_058;
	 public $_hrb04_03_058_type='varchar2';
	/**
 	 * 注释:随访日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb04_03_059;
	 public $_hrb04_03_059_type='date';
	/**
 	 * 注释:肿瘤诊疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb04_03_060;
	 public $_hrb04_03_060_type='varchar2';
}
