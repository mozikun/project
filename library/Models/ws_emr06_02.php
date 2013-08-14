<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_emr06_02 extends dao_oracle{
	 public $__table = 'ws_emr06_02';
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
 	 * 注释:标识号-号码* 
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_02_02_012;
	 public $_emr06_02_02_012_type='varchar2';
	/**
 	 * 注释:标识号-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr06_02_02_013;
	 public $_emr06_02_02_013_type='date';
	/**
 	 * 注释:标识号-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr06_02_02_014;
	 public $_emr06_02_02_014_type='date';
	/**
 	 * 注释:标识号-提供标识的机构名称 
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr06_02_02_015;
	 public $_emr06_02_02_015_type='varchar2';
	/**
 	 * 注释:姓名-标识对象
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr06_02_02_016;
	 public $_emr06_02_02_016_type='varchar2';
	/**
 	 * 注释:姓名* 
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_02_02_018;
	 public $_emr06_02_02_018_type='varchar2';
	/**
 	 * 注释:性别代码 
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr06_02_02_021;
	 public $_emr06_02_02_021_type='varchar2';
	/**
 	 * 注释:年龄（岁）*
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr06_02_02_022;
	 public $_emr06_02_02_022_type='number';
	/**
 	 * 注释:国籍代码 
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr06_02_02_023;
	 public $_emr06_02_02_023_type='varchar2';
	/**
 	 * 注释:民族代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_02_02_024;
	 public $_emr06_02_02_024_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr06_02_02_025;
	 public $_emr06_02_02_025_type='varchar2';
	/**
 	 * 注释:职业编码系统名称 
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr06_02_02_026;
	 public $_emr06_02_02_026_type='varchar2';
	/**
 	 * 注释:职业代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr06_02_02_027;
	 public $_emr06_02_02_027_type='varchar2';
	/**
 	 * 注释:文化程度代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_02_02_028;
	 public $_emr06_02_02_028_type='varchar2';
	/**
 	 * 注释:出生日期* 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr06_02_02_029;
	 public $_emr06_02_02_029_type='date';
	/**
 	 * 注释:出生地* 
	 * 
	 * 
	 * @var VARCHAR2(360)
	 **/
 	 public $emr06_02_02_030;
	 public $_emr06_02_02_030_type='varchar2';
	/**
 	 * 注释:机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr06_02_02_041;
	 public $_emr06_02_02_041_type='varchar2';
	/**
 	 * 注释:机构组织机构代码
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr06_02_02_042;
	 public $_emr06_02_02_042_type='varchar2';
	/**
 	 * 注释:机构负责人（法人）
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_02_02_043;
	 public $_emr06_02_02_043_type='varchar2';
	/**
 	 * 注释:机构地址
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_02_02_044;
	 public $_emr06_02_02_044_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr06_02_02_045;
	 public $_emr06_02_02_045_type='varchar2';
	/**
 	 * 注释:机构角色
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr06_02_02_046;
	 public $_emr06_02_02_046_type='varchar2';
	/**
 	 * 注释:机构角色代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_02_02_047;
	 public $_emr06_02_02_047_type='varchar2';
	/**
 	 * 注释:服务者姓名*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_02_02_051;
	 public $_emr06_02_02_051_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_02_02_052;
	 public $_emr06_02_02_052_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_02_02_053;
	 public $_emr06_02_02_053_type='varchar2';
	/**
 	 * 注释:服务者医师资格标志*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_02_02_054;
	 public $_emr06_02_02_054_type='varchar2';
	/**
 	 * 注释:服务者学历
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_02_02_055;
	 public $_emr06_02_02_055_type='varchar2';
	/**
 	 * 注释:服务者所学专业*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_02_02_056;
	 public $_emr06_02_02_056_type='varchar2';
	/**
 	 * 注释:服务者专业技术职称*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_02_02_057;
	 public $_emr06_02_02_057_type='varchar2';
	/**
 	 * 注释:服务者职务*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr06_02_02_058;
	 public $_emr06_02_02_058_type='varchar2';
	/**
 	 * 注释:诊断机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr06_02_02_061;
	 public $_emr06_02_02_061_type='varchar2';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr06_02_02_062;
	 public $_emr06_02_02_062_type='date';
	/**
 	 * 注释:诊断类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr06_02_02_063;
	 public $_emr06_02_02_063_type='varchar2';
	/**
 	 * 注释:诊断类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_02_02_064;
	 public $_emr06_02_02_064_type='varchar2';
	/**
 	 * 注释:诊断顺位（从属关系）代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_02_02_065;
	 public $_emr06_02_02_065_type='varchar2';
	/**
 	 * 注释:疾病名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_02_02_066;
	 public $_emr06_02_02_066_type='varchar2';
	/**
 	 * 注释:疾病代码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr06_02_02_067;
	 public $_emr06_02_02_067_type='varchar2';
	/**
 	 * 注释:诊断依据
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr06_02_02_068;
	 public $_emr06_02_02_068_type='varchar2';
	/**
 	 * 注释:诊断依据代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_02_02_069;
	 public $_emr06_02_02_069_type='varchar2';
	/**
 	 * 注释:护理等级
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr06_02_02_071;
	 public $_emr06_02_02_071_type='varchar2';
	/**
 	 * 注释:护理类型代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr06_02_02_072;
	 public $_emr06_02_02_072_type='varchar2';
	/**
 	 * 注释:护理操作名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr06_02_02_073;
	 public $_emr06_02_02_073_type='varchar2';
	/**
 	 * 注释:护理操作项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_02_02_074;
	 public $_emr06_02_02_074_type='varchar2';
	/**
 	 * 注释:护理操作结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr06_02_02_075;
	 public $_emr06_02_02_075_type='varchar2';
	/**
 	 * 注释:文档标识-名称 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr06_02_02_001;
	 public $_emr06_02_02_001_type='varchar2';
	/**
 	 * 注释:文档标识-类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_02_02_002;
	 public $_emr06_02_02_002_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr06_02_02_003;
	 public $_emr06_02_02_003_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构组织机构代码（法人代码）
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr06_02_02_004;
	 public $_emr06_02_02_004_type='varchar2';
	/**
 	 * 注释:文档标识-号码 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr06_02_02_005;
	 public $_emr06_02_02_005_type='varchar2';
	/**
 	 * 注释:文档标识-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr06_02_02_006;
	 public $_emr06_02_02_006_type='date';
	/**
 	 * 注释:文档标识-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr06_02_02_007;
	 public $_emr06_02_02_007_type='date';
	/**
 	 * 注释:标识号-类别代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr06_02_02_011;
	 public $_emr06_02_02_011_type='varchar2';
}
