<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_emr05_01 extends dao_oracle{
	 public $__table = 'ws_emr05_01';
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
 	 public $emr05_01_01_001;
	 public $_emr05_01_01_001_type='varchar2';
	/**
 	 * 注释:文档标识-类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr05_01_01_002;
	 public $_emr05_01_01_002_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr05_01_01_003;
	 public $_emr05_01_01_003_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构组织机构代码（法人代码）
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr05_01_01_004;
	 public $_emr05_01_01_004_type='varchar2';
	/**
 	 * 注释:文档标识-号码 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr05_01_01_005;
	 public $_emr05_01_01_005_type='varchar2';
	/**
 	 * 注释:文档标识-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr05_01_01_006;
	 public $_emr05_01_01_006_type='date';
	/**
 	 * 注释:文档标识-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr05_01_01_007;
	 public $_emr05_01_01_007_type='date';
	/**
 	 * 注释:标识号-类别代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr05_01_01_011;
	 public $_emr05_01_01_011_type='varchar2';
	/**
 	 * 注释:标识号-号码 
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr05_01_01_012;
	 public $_emr05_01_01_012_type='varchar2';
	/**
 	 * 注释:标识号-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr05_01_01_013;
	 public $_emr05_01_01_013_type='date';
	/**
 	 * 注释:标识号-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr05_01_01_014;
	 public $_emr05_01_01_014_type='date';
	/**
 	 * 注释:标识号-提供标识的机构名称 
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr05_01_01_015;
	 public $_emr05_01_01_015_type='varchar2';
	/**
 	 * 注释:姓名-标识对象
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr05_01_01_016;
	 public $_emr05_01_01_016_type='varchar2';
	/**
 	 * 注释:姓名-标识对象代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr05_01_01_017;
	 public $_emr05_01_01_017_type='varchar2';
	/**
 	 * 注释:姓名* 
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr05_01_01_018;
	 public $_emr05_01_01_018_type='varchar2';
	/**
 	 * 注释:性别代码 
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr05_01_01_021;
	 public $_emr05_01_01_021_type='varchar2';
	/**
 	 * 注释:年龄（岁）*
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr05_01_01_022;
	 public $_emr05_01_01_022_type='number';
	/**
 	 * 注释:国籍代码 
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr05_01_01_023;
	 public $_emr05_01_01_023_type='varchar2';
	/**
 	 * 注释:民族代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr05_01_01_024;
	 public $_emr05_01_01_024_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr05_01_01_025;
	 public $_emr05_01_01_025_type='varchar2';
	/**
 	 * 注释:职业编码系统名称 
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr05_01_01_026;
	 public $_emr05_01_01_026_type='varchar2';
	/**
 	 * 注释:职业代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr05_01_01_027;
	 public $_emr05_01_01_027_type='varchar2';
	/**
 	 * 注释:文化程度代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr05_01_01_028;
	 public $_emr05_01_01_028_type='varchar2';
	/**
 	 * 注释:出生日期*
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr05_01_01_029;
	 public $_emr05_01_01_029_type='date';
	/**
 	 * 注释:出生地*
	 * 
	 * 
	 * @var VARCHAR2(360)
	 **/
 	 public $emr05_01_01_030;
	 public $_emr05_01_01_030_type='varchar2';
	/**
 	 * 注释:机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr05_01_01_041;
	 public $_emr05_01_01_041_type='varchar2';
	/**
 	 * 注释:机构组织机构代码
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr05_01_01_042;
	 public $_emr05_01_01_042_type='varchar2';
	/**
 	 * 注释:机构负责人（法人）
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr05_01_01_043;
	 public $_emr05_01_01_043_type='varchar2';
	/**
 	 * 注释:机构地址
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr05_01_01_044;
	 public $_emr05_01_01_044_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr05_01_01_045;
	 public $_emr05_01_01_045_type='varchar2';
	/**
 	 * 注释:机构角色
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr05_01_01_046;
	 public $_emr05_01_01_046_type='varchar2';
	/**
 	 * 注释:机构角色代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr05_01_01_047;
	 public $_emr05_01_01_047_type='varchar2';
	/**
 	 * 注释:服务者姓名*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr05_01_01_051;
	 public $_emr05_01_01_051_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr05_01_01_052;
	 public $_emr05_01_01_052_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr05_01_01_053;
	 public $_emr05_01_01_053_type='varchar2';
	/**
 	 * 注释:服务者医师资格标志*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr05_01_01_054;
	 public $_emr05_01_01_054_type='varchar2';
	/**
 	 * 注释:服务者学历*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr05_01_01_055;
	 public $_emr05_01_01_055_type='varchar2';
	/**
 	 * 注释:服务者所学专业*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr05_01_01_056;
	 public $_emr05_01_01_056_type='varchar2';
	/**
 	 * 注释:服务者专业技术职称*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr05_01_01_057;
	 public $_emr05_01_01_057_type='varchar2';
	/**
 	 * 注释:服务者职务*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr05_01_01_058;
	 public $_emr05_01_01_058_type='varchar2';
	/**
 	 * 注释:诊断机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr05_01_01_061;
	 public $_emr05_01_01_061_type='varchar2';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr05_01_01_062;
	 public $_emr05_01_01_062_type='date';
	/**
 	 * 注释:诊断类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr05_01_01_063;
	 public $_emr05_01_01_063_type='varchar2';
	/**
 	 * 注释:诊断类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr05_01_01_064;
	 public $_emr05_01_01_064_type='varchar2';
	/**
 	 * 注释:诊断顺位（从属关系）代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr05_01_01_065;
	 public $_emr05_01_01_065_type='varchar2';
	/**
 	 * 注释:疾病名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr05_01_01_066;
	 public $_emr05_01_01_066_type='varchar2';
	/**
 	 * 注释:疾病代码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr05_01_01_067;
	 public $_emr05_01_01_067_type='varchar2';
	/**
 	 * 注释:诊断依据
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr05_01_01_068;
	 public $_emr05_01_01_068_type='varchar2';
	/**
 	 * 注释:诊断依据代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr05_01_01_069;
	 public $_emr05_01_01_069_type='varchar2';
	/**
 	 * 注释:手术/操作-名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr05_01_01_071;
	 public $_emr05_01_01_071_type='varchar2';
	/**
 	 * 注释:手术/操作-代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $emr05_01_01_072;
	 public $_emr05_01_01_072_type='varchar2';
	/**
 	 * 注释:手术/操作-目标部位名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr05_01_01_073;
	 public $_emr05_01_01_073_type='varchar2';
	/**
 	 * 注释:操作部位编码体系名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr05_01_01_074;
	 public $_emr05_01_01_074_type='varchar2';
	/**
 	 * 注释:操作部位编码
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $emr05_01_01_075;
	 public $_emr05_01_01_075_type='varchar2';
	/**
 	 * 注释:介入物名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr05_01_01_076;
	 public $_emr05_01_01_076_type='varchar2';
	/**
 	 * 注释:操作方法
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr05_01_01_077;
	 public $_emr05_01_01_077_type='varchar2';
	/**
 	 * 注释:操作次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr05_01_01_078;
	 public $_emr05_01_01_078_type='number';
	/**
 	 * 注释:操作日期/时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr05_01_01_079;
	 public $_emr05_01_01_079_type='date';
	/**
 	 * 注释:操作编码体系名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr05_01_01_080;
	 public $_emr05_01_01_080_type='varchar2';
	/**
 	 * 注释:拟做的检查
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr05_01_01_091;
	 public $_emr05_01_01_091_type='varchar2';
	/**
 	 * 注释:拟做的医学检验
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr05_01_01_092;
	 public $_emr05_01_01_092_type='varchar2';
	/**
 	 * 注释:今后治疗方案
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr05_01_01_093;
	 public $_emr05_01_01_093_type='varchar2';
	/**
 	 * 注释:随访标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr05_01_01_094;
	 public $_emr05_01_01_094_type='number';
	/**
 	 * 注释:随访间隔（随诊期限）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr05_01_01_095;
	 public $_emr05_01_01_095_type='number';
	/**
 	 * 注释:医嘱
	 * 
	 * 
	 * @var VARCHAR2(1500)
	 **/
 	 public $emr05_01_01_096;
	 public $_emr05_01_01_096_type='varchar2';
	/**
 	 * 注释:特别注意事项
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr05_01_01_097;
	 public $_emr05_01_01_097_type='varchar2';
	/**
 	 * 注释:门诊费用-分类
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr05_01_01_0101;
	 public $_emr05_01_01_0101_type='varchar2';
	/**
 	 * 注释:门诊费用-分类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr05_01_01_0102;
	 public $_emr05_01_01_0102_type='varchar2';
	/**
 	 * 注释:门诊费用-金额（元/人民币）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr05_01_01_0103;
	 public $_emr05_01_01_0103_type='number';
	/**
 	 * 注释:门诊费用-支付方式代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr05_01_01_0104;
	 public $_emr05_01_01_0104_type='varchar2';
	/**
 	 * 注释:住院费用-分类
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr05_01_01_0105;
	 public $_emr05_01_01_0105_type='varchar2';
	/**
 	 * 注释:住院费用-分类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr05_01_01_0106;
	 public $_emr05_01_01_0106_type='varchar2';
	/**
 	 * 注释:住院费用-金额（元/人民币）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr05_01_01_0107;
	 public $_emr05_01_01_0107_type='number';
	/**
 	 * 注释:住院费用-医疗付款方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr05_01_01_0108;
	 public $_emr05_01_01_0108_type='varchar2';
	/**
 	 * 注释:个人承担费用（元）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr05_01_01_0109;
	 public $_emr05_01_01_0109_type='number';
}
