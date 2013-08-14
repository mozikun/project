<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_emr06_01 extends dao_oracle{
	 public $__table = 'ws_emr06_01';
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
 	 public $emr06_01_01_001;
	 public $_emr06_01_01_001_type='varchar2';
	/**
 	 * 注释:文档标识-类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_01_01_002;
	 public $_emr06_01_01_002_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr06_01_01_003;
	 public $_emr06_01_01_003_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构组织机构代码（法人代码）
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr06_01_01_004;
	 public $_emr06_01_01_004_type='varchar2';
	/**
 	 * 注释:文档标识-号码 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr06_01_01_005;
	 public $_emr06_01_01_005_type='varchar2';
	/**
 	 * 注释:文档标识-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr06_01_01_006;
	 public $_emr06_01_01_006_type='date';
	/**
 	 * 注释:文档标识-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr06_01_01_007;
	 public $_emr06_01_01_007_type='date';
	/**
 	 * 注释:标识号-类别代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_01_01_011;
	 public $_emr06_01_01_011_type='varchar2';
	/**
 	 * 注释:标识号-号码 
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_01_01_012;
	 public $_emr06_01_01_012_type='varchar2';
	/**
 	 * 注释:标识号-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr06_01_01_013;
	 public $_emr06_01_01_013_type='date';
	/**
 	 * 注释:标识号-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr06_01_01_014;
	 public $_emr06_01_01_014_type='date';
	/**
 	 * 注释:标识号-提供标识的机构名称 
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr06_01_01_015;
	 public $_emr06_01_01_015_type='varchar2';
	/**
 	 * 注释:姓名-标识对象
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr06_01_01_016;
	 public $_emr06_01_01_016_type='varchar2';
	/**
 	 * 注释:姓名 *
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_01_01_018;
	 public $_emr06_01_01_018_type='varchar2';
	/**
 	 * 注释:机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr06_01_01_021;
	 public $_emr06_01_01_021_type='varchar2';
	/**
 	 * 注释:机构组织机构代码
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr06_01_01_022;
	 public $_emr06_01_01_022_type='varchar2';
	/**
 	 * 注释:机构负责人（法人）
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_01_01_023;
	 public $_emr06_01_01_023_type='varchar2';
	/**
 	 * 注释:机构地址
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_01_01_024;
	 public $_emr06_01_01_024_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr06_01_01_025;
	 public $_emr06_01_01_025_type='varchar2';
	/**
 	 * 注释:机构角色
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr06_01_01_026;
	 public $_emr06_01_01_026_type='varchar2';
	/**
 	 * 注释:机构角色代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_01_01_027;
	 public $_emr06_01_01_027_type='varchar2';
	/**
 	 * 注释:服务者姓名*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_01_01_031;
	 public $_emr06_01_01_031_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_01_01_032;
	 public $_emr06_01_01_032_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_01_01_033;
	 public $_emr06_01_01_033_type='varchar2';
	/**
 	 * 注释:服务者医师资格标志*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_01_01_034;
	 public $_emr06_01_01_034_type='varchar2';
	/**
 	 * 注释:服务者学历*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_01_01_035;
	 public $_emr06_01_01_035_type='varchar2';
	/**
 	 * 注释:服务者所学专业*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_01_01_036;
	 public $_emr06_01_01_036_type='varchar2';
	/**
 	 * 注释:服务者专业技术职称*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_01_01_037;
	 public $_emr06_01_01_037_type='varchar2';
	/**
 	 * 注释:服务者职务*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_01_01_038;
	 public $_emr06_01_01_038_type='varchar2';
	/**
 	 * 注释:事件分类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_01_01_042;
	 public $_emr06_01_01_042_type='varchar2';
	/**
 	 * 注释:事件开始时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr06_01_01_043;
	 public $_emr06_01_01_043_type='date';
	/**
 	 * 注释:事件结束时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr06_01_01_044;
	 public $_emr06_01_01_044_type='date';
	/**
 	 * 注释:事件发生地点
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr06_01_01_045;
	 public $_emr06_01_01_045_type='varchar2';
	/**
 	 * 注释:事件发生场所
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr06_01_01_046;
	 public $_emr06_01_01_046_type='varchar2';
	/**
 	 * 注释:事件参与方
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr06_01_01_047;
	 public $_emr06_01_01_047_type='varchar2';
	/**
 	 * 注释:事件发生原因
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_01_01_048;
	 public $_emr06_01_01_048_type='varchar2';
	/**
 	 * 注释:事件结局
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_01_01_049;
	 public $_emr06_01_01_049_type='varchar2';
	/**
 	 * 注释:观察-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr06_01_01_050;
	 public $_emr06_01_01_050_type='varchar2';
	/**
 	 * 注释:观察-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr06_01_01_051;
	 public $_emr06_01_01_051_type='varchar2';
	/**
 	 * 注释:观察项目名称
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_01_01_052;
	 public $_emr06_01_01_052_type='varchar2';
	/**
 	 * 注释:观察-项目代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $emr06_01_01_053;
	 public $_emr06_01_01_053_type='varchar2';
	/**
 	 * 注释:观察-结果描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr06_01_01_054;
	 public $_emr06_01_01_054_type='varchar2';
	/**
 	 * 注释:观察-结果(数值)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr06_01_01_055;
	 public $_emr06_01_01_055_type='number';
	/**
 	 * 注释:观察-计量单位
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr06_01_01_056;
	 public $_emr06_01_01_056_type='varchar2';
	/**
 	 * 注释:观察-结果代码
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_01_01_057;
	 public $_emr06_01_01_057_type='varchar2';
	/**
 	 * 注释:一般状态检查描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr06_01_01_061;
	 public $_emr06_01_01_061_type='varchar2';
	/**
 	 * 注释:一般状态检查体征代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_01_01_062;
	 public $_emr06_01_01_062_type='varchar2';
	/**
 	 * 注释:一般状态检查项目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_01_01_063;
	 public $_emr06_01_01_063_type='varchar2';
	/**
 	 * 注释:一般状态检查项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_01_01_064;
	 public $_emr06_01_01_064_type='varchar2';
	/**
 	 * 注释:一般状态检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_01_01_065;
	 public $_emr06_01_01_065_type='varchar2';
	/**
 	 * 注释:皮肤检查描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr06_01_01_066;
	 public $_emr06_01_01_066_type='varchar2';
	/**
 	 * 注释:皮肤检查体征代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_01_01_067;
	 public $_emr06_01_01_067_type='varchar2';
	/**
 	 * 注释:皮肤检查项目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_01_01_068;
	 public $_emr06_01_01_068_type='varchar2';
	/**
 	 * 注释:皮肤检查项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_01_01_069;
	 public $_emr06_01_01_069_type='varchar2';
	/**
 	 * 注释:皮肤检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_01_01_070;
	 public $_emr06_01_01_070_type='varchar2';
	/**
 	 * 注释:诊断机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr06_01_01_081;
	 public $_emr06_01_01_081_type='varchar2';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr06_01_01_082;
	 public $_emr06_01_01_082_type='date';
	/**
 	 * 注释:诊断类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr06_01_01_083;
	 public $_emr06_01_01_083_type='varchar2';
	/**
 	 * 注释:诊断类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_01_01_084;
	 public $_emr06_01_01_084_type='varchar2';
	/**
 	 * 注释:诊断顺位（从属关系）代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_01_01_085;
	 public $_emr06_01_01_085_type='varchar2';
	/**
 	 * 注释:疾病名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_01_01_086;
	 public $_emr06_01_01_086_type='varchar2';
	/**
 	 * 注释:疾病代码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr06_01_01_087;
	 public $_emr06_01_01_087_type='varchar2';
	/**
 	 * 注释:诊断依据
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr06_01_01_088;
	 public $_emr06_01_01_088_type='varchar2';
	/**
 	 * 注释:诊断依据代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_01_01_089;
	 public $_emr06_01_01_089_type='varchar2';
	/**
 	 * 注释:手术/操作-名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr06_01_01_091;
	 public $_emr06_01_01_091_type='varchar2';
	/**
 	 * 注释:手术/操作-代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $emr06_01_01_092;
	 public $_emr06_01_01_092_type='varchar2';
	/**
 	 * 注释:手术/操作-目标部位名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr06_01_01_093;
	 public $_emr06_01_01_093_type='varchar2';
	/**
 	 * 注释:操作部位编码体系名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr06_01_01_094;
	 public $_emr06_01_01_094_type='varchar2';
	/**
 	 * 注释:操作部位编码
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $emr06_01_01_095;
	 public $_emr06_01_01_095_type='varchar2';
	/**
 	 * 注释:介入物名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_01_01_096;
	 public $_emr06_01_01_096_type='varchar2';
	/**
 	 * 注释:操作方法
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr06_01_01_097;
	 public $_emr06_01_01_097_type='varchar2';
	/**
 	 * 注释:操作次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr06_01_01_098;
	 public $_emr06_01_01_098_type='number';
	/**
 	 * 注释:操作日期/时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr06_01_01_099;
	 public $_emr06_01_01_099_type='date';
	/**
 	 * 注释:操作编码体系名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr06_01_01_100;
	 public $_emr06_01_01_100_type='varchar2';
	/**
 	 * 注释:药物用法
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_01_01_111;
	 public $_emr06_01_01_111_type='varchar2';
	/**
 	 * 注释:药物使用-频率
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr06_01_01_112;
	 public $_emr06_01_01_112_type='varchar2';
	/**
 	 * 注释:药物使用-剂量单位
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $emr06_01_01_113;
	 public $_emr06_01_01_113_type='varchar2';
	/**
 	 * 注释:药物使用-次剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr06_01_01_114;
	 public $_emr06_01_01_114_type='number';
	/**
 	 * 注释:药物使用-总剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr06_01_01_115;
	 public $_emr06_01_01_115_type='number';
	/**
 	 * 注释:药物使用-途径代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr06_01_01_116;
	 public $_emr06_01_01_116_type='varchar2';
	/**
 	 * 注释:药物名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr06_01_01_117;
	 public $_emr06_01_01_117_type='varchar2';
	/**
 	 * 注释:药物剂型代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_01_01_118;
	 public $_emr06_01_01_118_type='varchar2';
	/**
 	 * 注释:中药类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr06_01_01_119;
	 public $_emr06_01_01_119_type='varchar2';
	/**
 	 * 注释:药物类型
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $emr06_01_01_120;
	 public $_emr06_01_01_120_type='varchar2';
	/**
 	 * 注释:药物名称代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $emr06_01_01_121;
	 public $_emr06_01_01_121_type='varchar2';
	/**
 	 * 注释:护理等级
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr06_01_01_131;
	 public $_emr06_01_01_131_type='varchar2';
	/**
 	 * 注释:护理类型代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr06_01_01_132;
	 public $_emr06_01_01_132_type='varchar2';
	/**
 	 * 注释:护理操作名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr06_01_01_133;
	 public $_emr06_01_01_133_type='varchar2';
	/**
 	 * 注释:护理操作项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_01_01_134;
	 public $_emr06_01_01_134_type='varchar2';
	/**
 	 * 注释:护理操作结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_01_01_135;
	 public $_emr06_01_01_135_type='varchar2';
}
