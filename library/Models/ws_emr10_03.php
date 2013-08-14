<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_emr10_03 extends dao_oracle{
	 public $__table = 'ws_emr10_03';
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
 	 * 注释:机构地址
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_14_044;
	 public $_emr10_00_14_044_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr10_00_14_045;
	 public $_emr10_00_14_045_type='varchar2';
	/**
 	 * 注释:机构角色
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr10_00_14_046;
	 public $_emr10_00_14_046_type='varchar2';
	/**
 	 * 注释:机构角色代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_14_047;
	 public $_emr10_00_14_047_type='varchar2';
	/**
 	 * 注释:服务者姓名*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_14_051;
	 public $_emr10_00_14_051_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_14_052;
	 public $_emr10_00_14_052_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_14_053;
	 public $_emr10_00_14_053_type='varchar2';
	/**
 	 * 注释:服务者医师资格标志*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_14_054;
	 public $_emr10_00_14_054_type='varchar2';
	/**
 	 * 注释:服务者学历*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_14_055;
	 public $_emr10_00_14_055_type='varchar2';
	/**
 	 * 注释:服务者所学专业*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_14_056;
	 public $_emr10_00_14_056_type='varchar2';
	/**
 	 * 注释:服务者专业技术职称*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_14_057;
	 public $_emr10_00_14_057_type='varchar2';
	/**
 	 * 注释:服务者职务*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_14_058;
	 public $_emr10_00_14_058_type='varchar2';
	/**
 	 * 注释:事件分类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_14_062;
	 public $_emr10_00_14_062_type='varchar2';
	/**
 	 * 注释:事件开始时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_14_063;
	 public $_emr10_00_14_063_type='date';
	/**
 	 * 注释:事件结束时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_14_064;
	 public $_emr10_00_14_064_type='date';
	/**
 	 * 注释:事件发生地点
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr10_00_14_065;
	 public $_emr10_00_14_065_type='varchar2';
	/**
 	 * 注释:事件发生场所
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr10_00_14_066;
	 public $_emr10_00_14_066_type='varchar2';
	/**
 	 * 注释:事件参与方
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr10_00_14_067;
	 public $_emr10_00_14_067_type='varchar2';
	/**
 	 * 注释:事件发生原因
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_14_068;
	 public $_emr10_00_14_068_type='varchar2';
	/**
 	 * 注释:事件结局
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_14_069;
	 public $_emr10_00_14_069_type='varchar2';
	/**
 	 * 注释:观察-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_14_070;
	 public $_emr10_00_14_070_type='varchar2';
	/**
 	 * 注释:观察-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr10_00_14_071;
	 public $_emr10_00_14_071_type='varchar2';
	/**
 	 * 注释:观察项目名称
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_14_072;
	 public $_emr10_00_14_072_type='varchar2';
	/**
 	 * 注释:观察-项目代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $emr10_00_14_073;
	 public $_emr10_00_14_073_type='varchar2';
	/**
 	 * 注释:观察-结果描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr10_00_14_074;
	 public $_emr10_00_14_074_type='varchar2';
	/**
 	 * 注释:观察-结果(数值)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr10_00_14_075;
	 public $_emr10_00_14_075_type='number';
	/**
 	 * 注释:观察-计量单位
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_14_076;
	 public $_emr10_00_14_076_type='varchar2';
	/**
 	 * 注释:观察-结果代码
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_14_077;
	 public $_emr10_00_14_077_type='varchar2';
	/**
 	 * 注释:诊断机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr10_00_14_081;
	 public $_emr10_00_14_081_type='varchar2';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_14_082;
	 public $_emr10_00_14_082_type='date';
	/**
 	 * 注释:诊断类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_14_083;
	 public $_emr10_00_14_083_type='varchar2';
	/**
 	 * 注释:诊断类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_14_084;
	 public $_emr10_00_14_084_type='varchar2';
	/**
 	 * 注释:诊断顺位（从属关系）代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_14_085;
	 public $_emr10_00_14_085_type='varchar2';
	/**
 	 * 注释:疾病名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_14_086;
	 public $_emr10_00_14_086_type='varchar2';
	/**
 	 * 注释:疾病代码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_14_087;
	 public $_emr10_00_14_087_type='varchar2';
	/**
 	 * 注释:诊断依据
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_14_088;
	 public $_emr10_00_14_088_type='varchar2';
	/**
 	 * 注释:诊断依据代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_14_089;
	 public $_emr10_00_14_089_type='varchar2';
	/**
 	 * 注释:患者知情同意类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_14_091;
	 public $_emr10_00_14_091_type='varchar2';
	/**
 	 * 注释:患者知情同意记录结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_14_092;
	 public $_emr10_00_14_092_type='varchar2';
	/**
 	 * 注释:诊疗过程名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr10_00_14_101;
	 public $_emr10_00_14_101_type='varchar2';
	/**
 	 * 注释:诊疗过程描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr10_00_14_102;
	 public $_emr10_00_14_102_type='varchar2';
	/**
 	 * 注释:文档标识-名称 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_14_001;
	 public $_emr10_00_14_001_type='varchar2';
	/**
 	 * 注释:文档标识-类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_14_002;
	 public $_emr10_00_14_002_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr10_00_14_003;
	 public $_emr10_00_14_003_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构组织机构代码（法人代码）
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr10_00_14_004;
	 public $_emr10_00_14_004_type='varchar2';
	/**
 	 * 注释:文档标识-号码 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_14_005;
	 public $_emr10_00_14_005_type='varchar2';
	/**
 	 * 注释:文档标识-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_14_006;
	 public $_emr10_00_14_006_type='date';
	/**
 	 * 注释:文档标识-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_14_007;
	 public $_emr10_00_14_007_type='date';
	/**
 	 * 注释:标识号-类别代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_14_011;
	 public $_emr10_00_14_011_type='varchar2';
	/**
 	 * 注释:标识号-号码 
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_14_012;
	 public $_emr10_00_14_012_type='varchar2';
	/**
 	 * 注释:标识号-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_14_013;
	 public $_emr10_00_14_013_type='date';
	/**
 	 * 注释:标识号-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_14_014;
	 public $_emr10_00_14_014_type='date';
	/**
 	 * 注释:标识号-提供标识的机构名称 
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr10_00_14_015;
	 public $_emr10_00_14_015_type='varchar2';
	/**
 	 * 注释:姓名-标识对象*
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr10_00_14_016;
	 public $_emr10_00_14_016_type='varchar2';
	/**
 	 * 注释:姓名*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_14_018;
	 public $_emr10_00_14_018_type='varchar2';
	/**
 	 * 注释:性别代码 
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr10_00_14_021;
	 public $_emr10_00_14_021_type='varchar2';
	/**
 	 * 注释:年龄（岁）*
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr10_00_14_022;
	 public $_emr10_00_14_022_type='number';
	/**
 	 * 注释:国籍代码 
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr10_00_14_023;
	 public $_emr10_00_14_023_type='varchar2';
	/**
 	 * 注释:民族代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_14_024;
	 public $_emr10_00_14_024_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr10_00_14_025;
	 public $_emr10_00_14_025_type='varchar2';
	/**
 	 * 注释:职业编码系统名称 
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr10_00_14_026;
	 public $_emr10_00_14_026_type='varchar2';
	/**
 	 * 注释:职业代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr10_00_14_027;
	 public $_emr10_00_14_027_type='varchar2';
	/**
 	 * 注释:文化程度代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr10_00_14_028;
	 public $_emr10_00_14_028_type='varchar2';
	/**
 	 * 注释:出生日期*
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr10_00_14_029;
	 public $_emr10_00_14_029_type='date';
	/**
 	 * 注释:出生地*
	 * 
	 * 
	 * @var VARCHAR2(360)
	 **/
 	 public $emr10_00_14_030;
	 public $_emr10_00_14_030_type='varchar2';
	/**
 	 * 注释:机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr10_00_14_041;
	 public $_emr10_00_14_041_type='varchar2';
	/**
 	 * 注释:机构组织机构代码
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr10_00_14_042;
	 public $_emr10_00_14_042_type='varchar2';
	/**
 	 * 注释:机构负责人（法人）
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr10_00_14_043;
	 public $_emr10_00_14_043_type='varchar2';
}
