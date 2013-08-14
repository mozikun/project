<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_emr10_02 extends dao_oracle{
	 public $__table = 'ws_emr10_02';
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
 	 public $emr10_00_08_001;
	 public $_emr10_00_08_001_type='varchar2';
	/**
 	 * 注释:文档标识-类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_08_002;
	 public $_emr10_00_08_002_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr10_00_08_003;
	 public $_emr10_00_08_003_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构组织机构代码（法人代码）
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr10_00_08_004;
	 public $_emr10_00_08_004_type='varchar2';
	/**
 	 * 注释:文档标识-号码* 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_08_005;
	 public $_emr10_00_08_005_type='varchar2';
	/**
 	 * 注释:文档标识-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_08_006;
	 public $_emr10_00_08_006_type='date';
	/**
 	 * 注释:文档标识-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_08_007;
	 public $_emr10_00_08_007_type='date';
	/**
 	 * 注释:标识号-类别代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_08_011;
	 public $_emr10_00_08_011_type='varchar2';
	/**
 	 * 注释:标识号-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_08_013;
	 public $_emr10_00_08_013_type='date';
	/**
 	 * 注释:标识号-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_08_014;
	 public $_emr10_00_08_014_type='date';
	/**
 	 * 注释:标识号-提供标识的机构名称 
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr10_00_08_015;
	 public $_emr10_00_08_015_type='varchar2';
	/**
 	 * 注释:姓名-标识对象
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_08_016;
	 public $_emr10_00_08_016_type='varchar2';
	/**
 	 * 注释:姓名 *
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_08_018;
	 public $_emr10_00_08_018_type='varchar2';
	/**
 	 * 注释:性别代码 
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr10_00_08_021;
	 public $_emr10_00_08_021_type='varchar2';
	/**
 	 * 注释:年龄（岁）*
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr10_00_08_022;
	 public $_emr10_00_08_022_type='number';
	/**
 	 * 注释:国籍代码 
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr10_00_08_023;
	 public $_emr10_00_08_023_type='varchar2';
	/**
 	 * 注释:民族代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_08_024;
	 public $_emr10_00_08_024_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr10_00_08_025;
	 public $_emr10_00_08_025_type='varchar2';
	/**
 	 * 注释:职业编码系统名称 
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr10_00_08_026;
	 public $_emr10_00_08_026_type='varchar2';
	/**
 	 * 注释:职业代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr10_00_08_027;
	 public $_emr10_00_08_027_type='varchar2';
	/**
 	 * 注释:文化程度代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_08_028;
	 public $_emr10_00_08_028_type='varchar2';
	/**
 	 * 注释:出生日期* 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_08_029;
	 public $_emr10_00_08_029_type='date';
	/**
 	 * 注释:出生地* 
	 * 
	 * 
	 * @var VARCHAR2(360)
	 **/
 	 public $emr10_00_08_030;
	 public $_emr10_00_08_030_type='varchar2';
	/**
 	 * 注释:服务者姓名*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_08_041;
	 public $_emr10_00_08_041_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_08_042;
	 public $_emr10_00_08_042_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_08_043;
	 public $_emr10_00_08_043_type='varchar2';
	/**
 	 * 注释:服务者医师资格标志*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_08_044;
	 public $_emr10_00_08_044_type='varchar2';
	/**
 	 * 注释:服务者学历*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_08_045;
	 public $_emr10_00_08_045_type='varchar2';
	/**
 	 * 注释:服务者所学专业*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_08_046;
	 public $_emr10_00_08_046_type='varchar2';
	/**
 	 * 注释:服务者专业技术职称*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_08_047;
	 public $_emr10_00_08_047_type='varchar2';
	/**
 	 * 注释:服务者职务*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_08_048;
	 public $_emr10_00_08_048_type='varchar2';
	/**
 	 * 注释:主诉
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_08_051;
	 public $_emr10_00_08_051_type='varchar2';
	/**
 	 * 注释:症状代码编码体系名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr10_00_08_052;
	 public $_emr10_00_08_052_type='varchar2';
	/**
 	 * 注释:症状代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $emr10_00_08_053;
	 public $_emr10_00_08_053_type='varchar2';
	/**
 	 * 注释:症状开始日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_08_054;
	 public $_emr10_00_08_054_type='date';
	/**
 	 * 注释:症状停止日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_08_055;
	 public $_emr10_00_08_055_type='date';
	/**
 	 * 注释:症状观察项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_08_056;
	 public $_emr10_00_08_056_type='varchar2';
	/**
 	 * 注释:症状观察结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_08_057;
	 public $_emr10_00_08_057_type='varchar2';
	/**
 	 * 注释:观察-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_08_061;
	 public $_emr10_00_08_061_type='varchar2';
	/**
 	 * 注释:观察-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr10_00_08_062;
	 public $_emr10_00_08_062_type='varchar2';
	/**
 	 * 注释:观察项目名称
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_08_063;
	 public $_emr10_00_08_063_type='varchar2';
	/**
 	 * 注释:观察-项目代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $emr10_00_08_064;
	 public $_emr10_00_08_064_type='varchar2';
	/**
 	 * 注释:观察-结果描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr10_00_08_065;
	 public $_emr10_00_08_065_type='varchar2';
	/**
 	 * 注释:观察-结果(数值)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr10_00_08_066;
	 public $_emr10_00_08_066_type='number';
	/**
 	 * 注释:观察-计量单位
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_08_067;
	 public $_emr10_00_08_067_type='varchar2';
	/**
 	 * 注释:观察-结果代码
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_08_068;
	 public $_emr10_00_08_068_type='varchar2';
	/**
 	 * 注释:体格检查项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_08_069;
	 public $_emr10_00_08_069_type='varchar2';
	/**
 	 * 注释:体格检查观察结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_08_070;
	 public $_emr10_00_08_070_type='varchar2';
	/**
 	 * 注释:观察-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_08_081;
	 public $_emr10_00_08_081_type='varchar2';
	/**
 	 * 注释:观察-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr10_00_08_082;
	 public $_emr10_00_08_082_type='varchar2';
	/**
 	 * 注释:观察项目名称
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_08_083;
	 public $_emr10_00_08_083_type='varchar2';
	/**
 	 * 注释:观察-项目代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $emr10_00_08_084;
	 public $_emr10_00_08_084_type='varchar2';
	/**
 	 * 注释:观察-结果描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr10_00_08_085;
	 public $_emr10_00_08_085_type='varchar2';
	/**
 	 * 注释:观察-结果(数值)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr10_00_08_086;
	 public $_emr10_00_08_086_type='number';
	/**
 	 * 注释:观察-计量单位
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_08_087;
	 public $_emr10_00_08_087_type='varchar2';
	/**
 	 * 注释:观察-结果代码
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_08_088;
	 public $_emr10_00_08_088_type='varchar2';
	/**
 	 * 注释:检查部位
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_08_089;
	 public $_emr10_00_08_089_type='varchar2';
	/**
 	 * 注释:检查部位代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr10_00_08_090;
	 public $_emr10_00_08_090_type='varchar2';
	/**
 	 * 注释:检查报告单—机构（科室）
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr10_00_08_101;
	 public $_emr10_00_08_101_type='varchar2';
	/**
 	 * 注释:检查报告单—编号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_08_102;
	 public $_emr10_00_08_102_type='varchar2';
	/**
 	 * 注释:检查报告结果-客观所见
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr10_00_08_103;
	 public $_emr10_00_08_103_type='varchar2';
	/**
 	 * 注释:检查报告结果-主观提示
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr10_00_08_104;
	 public $_emr10_00_08_104_type='varchar2';
	/**
 	 * 注释:检查日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_08_105;
	 public $_emr10_00_08_105_type='date';
	/**
 	 * 注释:检查报告日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_08_106;
	 public $_emr10_00_08_106_type='date';
	/**
 	 * 注释:检查报告备注
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr10_00_08_107;
	 public $_emr10_00_08_107_type='varchar2';
	/**
 	 * 注释:观察-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_08_111;
	 public $_emr10_00_08_111_type='varchar2';
	/**
 	 * 注释:观察-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr10_00_08_112;
	 public $_emr10_00_08_112_type='varchar2';
	/**
 	 * 注释:观察项目名称
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_08_113;
	 public $_emr10_00_08_113_type='varchar2';
	/**
 	 * 注释:观察-项目代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $emr10_00_08_114;
	 public $_emr10_00_08_114_type='varchar2';
	/**
 	 * 注释:观察-结果描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr10_00_08_115;
	 public $_emr10_00_08_115_type='varchar2';
	/**
 	 * 注释:观察-结果(数值)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr10_00_08_116;
	 public $_emr10_00_08_116_type='number';
	/**
 	 * 注释:观察-计量单位
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_08_117;
	 public $_emr10_00_08_117_type='varchar2';
	/**
 	 * 注释:观察-结果代码
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_08_118;
	 public $_emr10_00_08_118_type='varchar2';
	/**
 	 * 注释:检验报告单—机构（科室）
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr10_00_08_121;
	 public $_emr10_00_08_121_type='varchar2';
	/**
 	 * 注释:检验报告单—编号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_08_122;
	 public $_emr10_00_08_122_type='varchar2';
	/**
 	 * 注释:检验报告结果-客观所见
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr10_00_08_123;
	 public $_emr10_00_08_123_type='varchar2';
	/**
 	 * 注释:检验报告结果-主观提示
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr10_00_08_124;
	 public $_emr10_00_08_124_type='varchar2';
	/**
 	 * 注释:检验日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_08_125;
	 public $_emr10_00_08_125_type='date';
	/**
 	 * 注释:检验报告日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_08_126;
	 public $_emr10_00_08_126_type='date';
	/**
 	 * 注释:检验报告备注
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr10_00_08_127;
	 public $_emr10_00_08_127_type='varchar2';
	/**
 	 * 注释:诊断机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr10_00_08_131;
	 public $_emr10_00_08_131_type='varchar2';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_08_132;
	 public $_emr10_00_08_132_type='date';
	/**
 	 * 注释:诊断类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_08_133;
	 public $_emr10_00_08_133_type='varchar2';
	/**
 	 * 注释:诊断类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_08_134;
	 public $_emr10_00_08_134_type='varchar2';
	/**
 	 * 注释:诊断顺位（从属关系）代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_08_135;
	 public $_emr10_00_08_135_type='varchar2';
	/**
 	 * 注释:疾病名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_08_136;
	 public $_emr10_00_08_136_type='varchar2';
	/**
 	 * 注释:疾病代码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_08_137;
	 public $_emr10_00_08_137_type='varchar2';
	/**
 	 * 注释:诊断依据
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_08_138;
	 public $_emr10_00_08_138_type='varchar2';
	/**
 	 * 注释:诊断依据代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_08_139;
	 public $_emr10_00_08_139_type='varchar2';
	/**
 	 * 注释:手术/操作-名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr10_00_08_141;
	 public $_emr10_00_08_141_type='varchar2';
	/**
 	 * 注释:手术/操作-代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $emr10_00_08_142;
	 public $_emr10_00_08_142_type='varchar2';
	/**
 	 * 注释:手术/操作-目标部位名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr10_00_08_143;
	 public $_emr10_00_08_143_type='varchar2';
	/**
 	 * 注释:操作部位编码体系名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr10_00_08_144;
	 public $_emr10_00_08_144_type='varchar2';
	/**
 	 * 注释:操作部位编码
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $emr10_00_08_145;
	 public $_emr10_00_08_145_type='varchar2';
	/**
 	 * 注释:介入物名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_08_146;
	 public $_emr10_00_08_146_type='varchar2';
	/**
 	 * 注释:操作方法
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr10_00_08_147;
	 public $_emr10_00_08_147_type='varchar2';
	/**
 	 * 注释:操作次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr10_00_08_148;
	 public $_emr10_00_08_148_type='number';
	/**
 	 * 注释:操作日期/时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_08_149;
	 public $_emr10_00_08_149_type='date';
	/**
 	 * 注释:操作编码体系名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr10_00_08_150;
	 public $_emr10_00_08_150_type='varchar2';
	/**
 	 * 注释:药物用法
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_08_161;
	 public $_emr10_00_08_161_type='varchar2';
	/**
 	 * 注释:药物使用-频率
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_08_162;
	 public $_emr10_00_08_162_type='varchar2';
	/**
 	 * 注释:药物使用-剂量单位
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $emr10_00_08_163;
	 public $_emr10_00_08_163_type='varchar2';
	/**
 	 * 注释:药物使用-次剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr10_00_08_164;
	 public $_emr10_00_08_164_type='number';
	/**
 	 * 注释:药物使用-总剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr10_00_08_165;
	 public $_emr10_00_08_165_type='number';
	/**
 	 * 注释:药物使用-途径代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr10_00_08_166;
	 public $_emr10_00_08_166_type='varchar2';
	/**
 	 * 注释:药物名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr10_00_08_167;
	 public $_emr10_00_08_167_type='varchar2';
	/**
 	 * 注释:药物剂型代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_08_168;
	 public $_emr10_00_08_168_type='varchar2';
	/**
 	 * 注释:中药类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr10_00_08_169;
	 public $_emr10_00_08_169_type='varchar2';
	/**
 	 * 注释:药物类型
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $emr10_00_08_170;
	 public $_emr10_00_08_170_type='varchar2';
	/**
 	 * 注释:药物名称代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $emr10_00_08_171;
	 public $_emr10_00_08_171_type='varchar2';
	/**
 	 * 注释:拟做的检查
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_08_181;
	 public $_emr10_00_08_181_type='varchar2';
	/**
 	 * 注释:拟做的医学检验
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_08_182;
	 public $_emr10_00_08_182_type='varchar2';
	/**
 	 * 注释:今后治疗方案
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr10_00_08_183;
	 public $_emr10_00_08_183_type='varchar2';
	/**
 	 * 注释:随访标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr10_00_08_184;
	 public $_emr10_00_08_184_type='number';
	/**
 	 * 注释:随访间隔（随诊期限）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr10_00_08_185;
	 public $_emr10_00_08_185_type='number';
	/**
 	 * 注释:医嘱
	 * 
	 * 
	 * @var VARCHAR2(1500)
	 **/
 	 public $emr10_00_08_186;
	 public $_emr10_00_08_186_type='varchar2';
	/**
 	 * 注释:特别注意事项
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr10_00_08_187;
	 public $_emr10_00_08_187_type='varchar2';
	/**
 	 * 注释:诊疗过程名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_08_191;
	 public $_emr10_00_08_191_type='varchar2';
	/**
 	 * 注释:诊疗过程描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr10_00_08_192;
	 public $_emr10_00_08_192_type='varchar2';
}
