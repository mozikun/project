<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb03_03 extends dao_oracle{
	 public $__table = 'ws_hrb03_03';
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
 	 * 注释:诊断机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_03_055;
	 public $_hrb03_03_055_type='varchar2';
	/**
 	 * 注释:药敏实验结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_037;
	 public $_hrb03_03_037_type='varchar2';
	/**
 	 * 注释:结核菌群检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_038;
	 public $_hrb03_03_038_type='varchar2';
	/**
 	 * 注释:肺外结核部位代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_039;
	 public $_hrb03_03_039_type='varchar2';
	/**
 	 * 注释:诊断结核病类型代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_040;
	 public $_hrb03_03_040_type='varchar2';
	/**
 	 * 注释:肺结核诊断结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_041;
	 public $_hrb03_03_041_type='varchar2';
	/**
 	 * 注释:肺结核标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_03_042;
	 public $_hrb03_03_042_type='number';
	/**
 	 * 注释:肝炎标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_03_043;
	 public $_hrb03_03_043_type='number';
	/**
 	 * 注释:结核病接触史标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_03_044;
	 public $_hrb03_03_044_type='number';
	/**
 	 * 注释:结核病合并症代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_045;
	 public $_hrb03_03_045_type='varchar2';
	/**
 	 * 注释:结核病治疗分类代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_046;
	 public $_hrb03_03_046_type='varchar2';
	/**
 	 * 注释:结核病患者始治方案代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_047;
	 public $_hrb03_03_047_type='varchar2';
	/**
 	 * 注释:结核病患者化疗方案代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_048;
	 public $_hrb03_03_048_type='varchar2';
	/**
 	 * 注释:药物副作用标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_03_049;
	 public $_hrb03_03_049_type='number';
	/**
 	 * 注释:停止治疗日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_03_050;
	 public $_hrb03_03_050_type='date';
	/**
 	 * 注释:停止治疗原因代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_051;
	 public $_hrb03_03_051_type='varchar2';
	/**
 	 * 注释:结核病人化疗管理方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_052;
	 public $_hrb03_03_052_type='varchar2';
	/**
 	 * 注释:规律服药标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_03_053;
	 public $_hrb03_03_053_type='number';
	/**
 	 * 注释:结核病管理机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_03_054;
	 public $_hrb03_03_054_type='varchar2';
	/**
 	 * 注释:诊断医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_03_056;
	 public $_hrb03_03_056_type='varchar2';
	/**
 	 * 注释:治疗机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_03_057;
	 public $_hrb03_03_057_type='varchar2';
	/**
 	 * 注释:治疗医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_03_058;
	 public $_hrb03_03_058_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_03_001;
	 public $_hrb03_03_001_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_002;
	 public $_hrb03_03_002_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_003;
	 public $_hrb03_03_003_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb03_03_004;
	 public $_hrb03_03_004_type='varchar2';
	/**
 	 * 注释:民族代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_03_005;
	 public $_hrb03_03_005_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_03_006;
	 public $_hrb03_03_006_type='date';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_007;
	 public $_hrb03_03_007_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_03_008;
	 public $_hrb03_03_008_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_03_009;
	 public $_hrb03_03_009_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_03_010;
	 public $_hrb03_03_010_type='varchar2';
	/**
 	 * 注释:地址-乡（镇、街道办事处）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_03_011;
	 public $_hrb03_03_011_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_03_012;
	 public $_hrb03_03_012_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_03_013;
	 public $_hrb03_03_013_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_03_014;
	 public $_hrb03_03_014_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_015;
	 public $_hrb03_03_015_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_03_016;
	 public $_hrb03_03_016_type='varchar2';
	/**
 	 * 注释:工作单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_03_017;
	 public $_hrb03_03_017_type='varchar2';
	/**
 	 * 注释:职业类别代码(国标)
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb03_03_018;
	 public $_hrb03_03_018_type='varchar2';
	/**
 	 * 注释:门诊号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hrb03_03_019;
	 public $_hrb03_03_019_type='varchar2';
	/**
 	 * 注释:住院号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hrb03_03_020;
	 public $_hrb03_03_020_type='varchar2';
	/**
 	 * 注释:疑似结核病人症状代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_021;
	 public $_hrb03_03_021_type='varchar2';
	/**
 	 * 注释:首次出现症状日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_03_022;
	 public $_hrb03_03_022_type='date';
	/**
 	 * 注释:首次就诊日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_03_023;
	 public $_hrb03_03_023_type='date';
	/**
 	 * 注释:确诊日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_03_024;
	 public $_hrb03_03_024_type='date';
	/**
 	 * 注释:首次治疗日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_03_025;
	 public $_hrb03_03_025_type='date';
	/**
 	 * 注释:结核病人发现方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_026;
	 public $_hrb03_03_026_type='varchar2';
	/**
 	 * 注释:痰检培养结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_027;
	 public $_hrb03_03_027_type='varchar2';
	/**
 	 * 注释:痰检涂片结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_028;
	 public $_hrb03_03_028_type='varchar2';
	/**
 	 * 注释:胸部X线检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_03_029;
	 public $_hrb03_03_029_type='varchar2';
	/**
 	 * 注释:CT检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_03_030;
	 public $_hrb03_03_030_type='varchar2';
	/**
 	 * 注释:肝功能检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_031;
	 public $_hrb03_03_031_type='varchar2';
	/**
 	 * 注释:粪常规检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_032;
	 public $_hrb03_03_032_type='varchar2';
	/**
 	 * 注释:尿常规检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_033;
	 public $_hrb03_03_033_type='varchar2';
	/**
 	 * 注释:血常规检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_034;
	 public $_hrb03_03_034_type='varchar2';
	/**
 	 * 注释:HIV抗体检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_035;
	 public $_hrb03_03_035_type='varchar2';
	/**
 	 * 注释:药敏实验所用药物代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_03_036;
	 public $_hrb03_03_036_type='varchar2';
}
