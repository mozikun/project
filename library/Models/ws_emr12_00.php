<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_emr12_00 extends dao_oracle{
	 public $__table = 'ws_emr12_00';
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
 	 * 注释:文档标识-名称 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr12_00_01_001;
	 public $_emr12_00_01_001_type='varchar2';
	/**
 	 * 注释:文档标识-类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr12_00_01_002;
	 public $_emr12_00_01_002_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr12_00_01_003;
	 public $_emr12_00_01_003_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构组织机构代码（法人代码）
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr12_00_01_004;
	 public $_emr12_00_01_004_type='varchar2';
	/**
 	 * 注释:文档标识-号码 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr12_00_01_005;
	 public $_emr12_00_01_005_type='varchar2';
	/**
 	 * 注释:文档标识-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr12_00_01_006;
	 public $_emr12_00_01_006_type='date';
	/**
 	 * 注释:文档标识-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr12_00_01_007;
	 public $_emr12_00_01_007_type='date';
	/**
 	 * 注释:标识号-类别代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr12_00_01_011;
	 public $_emr12_00_01_011_type='varchar2';
	/**
 	 * 注释:标识号-号码 
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr12_00_01_012;
	 public $_emr12_00_01_012_type='varchar2';
	/**
 	 * 注释:标识号-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr12_00_01_013;
	 public $_emr12_00_01_013_type='date';
	/**
 	 * 注释:标识号-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr12_00_01_014;
	 public $_emr12_00_01_014_type='date';
	/**
 	 * 注释:标识号-提供标识的机构名称 
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr12_00_01_015;
	 public $_emr12_00_01_015_type='varchar2';
	/**
 	 * 注释:姓名-标识对象*
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr12_00_01_016;
	 public $_emr12_00_01_016_type='varchar2';
	/**
 	 * 注释:姓名* 
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr12_00_01_018;
	 public $_emr12_00_01_018_type='varchar2';
	/**
 	 * 注释:性别代码 
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr12_00_01_021;
	 public $_emr12_00_01_021_type='varchar2';
	/**
 	 * 注释:年龄（岁）*
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr12_00_01_022;
	 public $_emr12_00_01_022_type='number';
	/**
 	 * 注释:国籍代码 
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr12_00_01_023;
	 public $_emr12_00_01_023_type='varchar2';
	/**
 	 * 注释:民族代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr12_00_01_024;
	 public $_emr12_00_01_024_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr12_00_01_025;
	 public $_emr12_00_01_025_type='varchar2';
	/**
 	 * 注释:职业编码系统名称 
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr12_00_01_026;
	 public $_emr12_00_01_026_type='varchar2';
	/**
 	 * 注释:职业代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr12_00_01_027;
	 public $_emr12_00_01_027_type='varchar2';
	/**
 	 * 注释:文化程度代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr12_00_01_028;
	 public $_emr12_00_01_028_type='varchar2';
	/**
 	 * 注释:出生日期* 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr12_00_01_029;
	 public $_emr12_00_01_029_type='date';
	/**
 	 * 注释:出生地* 
	 * 
	 * 
	 * @var VARCHAR2(360)
	 **/
 	 public $emr12_00_01_030;
	 public $_emr12_00_01_030_type='varchar2';
	/**
 	 * 注释:机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr12_00_01_041;
	 public $_emr12_00_01_041_type='varchar2';
	/**
 	 * 注释:机构组织机构代码
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr12_00_01_042;
	 public $_emr12_00_01_042_type='varchar2';
	/**
 	 * 注释:机构负责人（法人）
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr12_00_01_043;
	 public $_emr12_00_01_043_type='varchar2';
	/**
 	 * 注释:机构地址
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr12_00_01_044;
	 public $_emr12_00_01_044_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr12_00_01_045;
	 public $_emr12_00_01_045_type='varchar2';
	/**
 	 * 注释:机构角色
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr12_00_01_046;
	 public $_emr12_00_01_046_type='varchar2';
	/**
 	 * 注释:机构角色代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr12_00_01_047;
	 public $_emr12_00_01_047_type='varchar2';
	/**
 	 * 注释:服务者姓名*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr12_00_01_051;
	 public $_emr12_00_01_051_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr12_00_01_052;
	 public $_emr12_00_01_052_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr12_00_01_053;
	 public $_emr12_00_01_053_type='varchar2';
	/**
 	 * 注释:服务者医师资格标志*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr12_00_01_054;
	 public $_emr12_00_01_054_type='varchar2';
	/**
 	 * 注释:服务者学历*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr12_00_01_055;
	 public $_emr12_00_01_055_type='varchar2';
	/**
 	 * 注释:服务者所学专业*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr12_00_01_056;
	 public $_emr12_00_01_056_type='varchar2';
	/**
 	 * 注释:服务者专业技术职称*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr12_00_01_057;
	 public $_emr12_00_01_057_type='varchar2';
	/**
 	 * 注释:服务者职务*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr12_00_01_058;
	 public $_emr12_00_01_058_type='varchar2';
	/**
 	 * 注释:事件分类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr12_00_01_062;
	 public $_emr12_00_01_062_type='varchar2';
	/**
 	 * 注释:事件开始时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr12_00_01_063;
	 public $_emr12_00_01_063_type='date';
	/**
 	 * 注释:事件结束时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr12_00_01_064;
	 public $_emr12_00_01_064_type='date';
	/**
 	 * 注释:事件发生地点
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr12_00_01_065;
	 public $_emr12_00_01_065_type='varchar2';
	/**
 	 * 注释:事件发生场所
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr12_00_01_066;
	 public $_emr12_00_01_066_type='varchar2';
	/**
 	 * 注释:事件参与方
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr12_00_01_067;
	 public $_emr12_00_01_067_type='varchar2';
	/**
 	 * 注释:事件发生原因
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr12_00_01_068;
	 public $_emr12_00_01_068_type='varchar2';
	/**
 	 * 注释:事件结局
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr12_00_01_069;
	 public $_emr12_00_01_069_type='varchar2';
	/**
 	 * 注释:观察-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr12_00_01_070;
	 public $_emr12_00_01_070_type='varchar2';
	/**
 	 * 注释:观察-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr12_00_01_071;
	 public $_emr12_00_01_071_type='varchar2';
	/**
 	 * 注释:观察项目名称
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr12_00_01_072;
	 public $_emr12_00_01_072_type='varchar2';
	/**
 	 * 注释:观察-项目代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $emr12_00_01_073;
	 public $_emr12_00_01_073_type='varchar2';
	/**
 	 * 注释:观察-结果描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr12_00_01_074;
	 public $_emr12_00_01_074_type='varchar2';
	/**
 	 * 注释:观察-结果(数值)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr12_00_01_075;
	 public $_emr12_00_01_075_type='number';
	/**
 	 * 注释:观察-计量单位
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr12_00_01_076;
	 public $_emr12_00_01_076_type='varchar2';
	/**
 	 * 注释:观察-结果代码
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr12_00_01_077;
	 public $_emr12_00_01_077_type='varchar2';
	/**
 	 * 注释:主诉
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr12_00_01_081;
	 public $_emr12_00_01_081_type='varchar2';
	/**
 	 * 注释:症状代码编码体系名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr12_00_01_082;
	 public $_emr12_00_01_082_type='varchar2';
	/**
 	 * 注释:症状代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $emr12_00_01_083;
	 public $_emr12_00_01_083_type='varchar2';
	/**
 	 * 注释:症状开始日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr12_00_01_084;
	 public $_emr12_00_01_084_type='date';
	/**
 	 * 注释:症状停止日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr12_00_01_085;
	 public $_emr12_00_01_085_type='date';
	/**
 	 * 注释:症状观察项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr12_00_01_086;
	 public $_emr12_00_01_086_type='varchar2';
	/**
 	 * 注释:症状观察结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr12_00_01_087;
	 public $_emr12_00_01_087_type='varchar2';
	/**
 	 * 注释:观察-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr12_00_01_091;
	 public $_emr12_00_01_091_type='varchar2';
	/**
 	 * 注释:观察-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr12_00_01_092;
	 public $_emr12_00_01_092_type='varchar2';
	/**
 	 * 注释:观察项目名称
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr12_00_01_093;
	 public $_emr12_00_01_093_type='varchar2';
	/**
 	 * 注释:观察-项目代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $emr12_00_01_094;
	 public $_emr12_00_01_094_type='varchar2';
	/**
 	 * 注释:观察-结果描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr12_00_01_095;
	 public $_emr12_00_01_095_type='varchar2';
	/**
 	 * 注释:观察-结果(数值)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr12_00_01_096;
	 public $_emr12_00_01_096_type='number';
	/**
 	 * 注释:观察-计量单位
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr12_00_01_097;
	 public $_emr12_00_01_097_type='varchar2';
	/**
 	 * 注释:观察-结果代码
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr12_00_01_098;
	 public $_emr12_00_01_098_type='varchar2';
	/**
 	 * 注释:体格检查项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr12_00_01_099;
	 public $_emr12_00_01_099_type='varchar2';
	/**
 	 * 注释:体格检查观察结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr12_00_01_100;
	 public $_emr12_00_01_100_type='varchar2';
	/**
 	 * 注释:观察-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr12_00_01_111;
	 public $_emr12_00_01_111_type='varchar2';
	/**
 	 * 注释:观察-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr12_00_01_112;
	 public $_emr12_00_01_112_type='varchar2';
	/**
 	 * 注释:观察项目名称
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr12_00_01_113;
	 public $_emr12_00_01_113_type='varchar2';
	/**
 	 * 注释:观察-项目代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $emr12_00_01_114;
	 public $_emr12_00_01_114_type='varchar2';
	/**
 	 * 注释:观察-结果描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr12_00_01_115;
	 public $_emr12_00_01_115_type='varchar2';
	/**
 	 * 注释:观察-结果(数值)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr12_00_01_116;
	 public $_emr12_00_01_116_type='number';
	/**
 	 * 注释:观察-计量单位
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr12_00_01_117;
	 public $_emr12_00_01_117_type='varchar2';
	/**
 	 * 注释:观察-结果代码
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr12_00_01_118;
	 public $_emr12_00_01_118_type='varchar2';
	/**
 	 * 注释:诊断机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr12_00_01_121;
	 public $_emr12_00_01_121_type='varchar2';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr12_00_01_122;
	 public $_emr12_00_01_122_type='date';
	/**
 	 * 注释:诊断类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr12_00_01_123;
	 public $_emr12_00_01_123_type='varchar2';
	/**
 	 * 注释:诊断类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr12_00_01_124;
	 public $_emr12_00_01_124_type='varchar2';
	/**
 	 * 注释:诊断顺位（从属关系）代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr12_00_01_125;
	 public $_emr12_00_01_125_type='varchar2';
	/**
 	 * 注释:疾病名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr12_00_01_126;
	 public $_emr12_00_01_126_type='varchar2';
	/**
 	 * 注释:疾病代码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr12_00_01_127;
	 public $_emr12_00_01_127_type='varchar2';
	/**
 	 * 注释:诊断依据
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr12_00_01_128;
	 public $_emr12_00_01_128_type='varchar2';
	/**
 	 * 注释:诊断依据代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr12_00_01_129;
	 public $_emr12_00_01_129_type='varchar2';
	/**
 	 * 注释:诊疗过程名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr12_00_01_131;
	 public $_emr12_00_01_131_type='varchar2';
	/**
 	 * 注释:诊疗过程描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr12_00_01_132;
	 public $_emr12_00_01_132_type='varchar2';
	/**
 	 * 注释:医嘱开嘱日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr12_00_01_141;
	 public $_emr12_00_01_141_type='date';
	/**
 	 * 注释:长期医嘱停嘱日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr12_00_01_142;
	 public $_emr12_00_01_142_type='date';
	/**
 	 * 注释:医嘱执行日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr12_00_01_143;
	 public $_emr12_00_01_143_type='date';
	/**
 	 * 注释:医嘱执行时间类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr12_00_01_144;
	 public $_emr12_00_01_144_type='varchar2';
	/**
 	 * 注释:医嘱取消日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr12_00_01_145;
	 public $_emr12_00_01_145_type='date';
	/**
 	 * 注释:医嘱类别
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr12_00_01_146;
	 public $_emr12_00_01_146_type='varchar2';
	/**
 	 * 注释:医嘱内容
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr12_00_01_147;
	 public $_emr12_00_01_147_type='varchar2';
}
