<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_emr08_00 extends dao_oracle{
	 public $__table = 'ws_emr08_00';
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
 	 public $emr08_00_01_001;
	 public $_emr08_00_01_001_type='varchar2';
	/**
 	 * 注释:文档标识-类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr08_00_01_002;
	 public $_emr08_00_01_002_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr08_00_01_003;
	 public $_emr08_00_01_003_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构组织机构代码（法人代码）
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr08_00_01_004;
	 public $_emr08_00_01_004_type='varchar2';
	/**
 	 * 注释:文档标识-号码 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_005;
	 public $_emr08_00_01_005_type='varchar2';
	/**
 	 * 注释:文档标识-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr08_00_01_006;
	 public $_emr08_00_01_006_type='date';
	/**
 	 * 注释:文档标识-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr08_00_01_007;
	 public $_emr08_00_01_007_type='date';
	/**
 	 * 注释:姓名-标识对象 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_011;
	 public $_emr08_00_01_011_type='varchar2';
	/**
 	 * 注释:姓名* 
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr08_00_01_013;
	 public $_emr08_00_01_013_type='varchar2';
	/**
 	 * 注释:标识号-类别代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr08_00_01_014;
	 public $_emr08_00_01_014_type='varchar2';
	/**
 	 * 注释:标识号-号码* 
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr08_00_01_015;
	 public $_emr08_00_01_015_type='varchar2';
	/**
 	 * 注释:标识号-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr08_00_01_016;
	 public $_emr08_00_01_016_type='date';
	/**
 	 * 注释:标识号-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr08_00_01_017;
	 public $_emr08_00_01_017_type='date';
	/**
 	 * 注释:标识号-提供标识的机构名称 
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr08_00_01_018;
	 public $_emr08_00_01_018_type='varchar2';
	/**
 	 * 注释:ABO血型
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr08_00_01_021;
	 public $_emr08_00_01_021_type='varchar2';
	/**
 	 * 注释:RH血型
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr08_00_01_022;
	 public $_emr08_00_01_022_type='varchar2';
	/**
 	 * 注释:出生日期 *
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr08_00_01_031;
	 public $_emr08_00_01_031_type='date';
	/**
 	 * 注释:出生地* 
	 * 
	 * 
	 * @var VARCHAR2(360)
	 **/
 	 public $emr08_00_01_032;
	 public $_emr08_00_01_032_type='varchar2';
	/**
 	 * 注释:性别代码 
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr08_00_01_033;
	 public $_emr08_00_01_033_type='varchar2';
	/**
 	 * 注释:年龄（岁）*
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr08_00_01_034;
	 public $_emr08_00_01_034_type='number';
	/**
 	 * 注释:国籍代码 
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr08_00_01_035;
	 public $_emr08_00_01_035_type='varchar2';
	/**
 	 * 注释:民族代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr08_00_01_036;
	 public $_emr08_00_01_036_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr08_00_01_037;
	 public $_emr08_00_01_037_type='varchar2';
	/**
 	 * 注释:职业编码系统名称 
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr08_00_01_038;
	 public $_emr08_00_01_038_type='varchar2';
	/**
 	 * 注释:职业代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr08_00_01_039;
	 public $_emr08_00_01_039_type='varchar2';
	/**
 	 * 注释:文化程度代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr08_00_01_040;
	 public $_emr08_00_01_040_type='varchar2';
	/**
 	 * 注释:姓名-标识对象 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_051;
	 public $_emr08_00_01_051_type='varchar2';
	/**
 	 * 注释:姓名 *
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr08_00_01_053;
	 public $_emr08_00_01_053_type='varchar2';
	/**
 	 * 注释:标识号-类别代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr08_00_01_054;
	 public $_emr08_00_01_054_type='varchar2';
	/**
 	 * 注释:标识号-号码 *
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr08_00_01_055;
	 public $_emr08_00_01_055_type='varchar2';
	/**
 	 * 注释:标识号-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr08_00_01_056;
	 public $_emr08_00_01_056_type='date';
	/**
 	 * 注释:标识号-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr08_00_01_057;
	 public $_emr08_00_01_057_type='date';
	/**
 	 * 注释:标识号-提供标识的机构名称 
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr08_00_01_058;
	 public $_emr08_00_01_058_type='varchar2';
	/**
 	 * 注释:标识地址类别的代码 
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr08_00_01_061;
	 public $_emr08_00_01_061_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）*
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_062;
	 public $_emr08_00_01_062_type='varchar2';
	/**
 	 * 注释:地址-市（地区）*
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_063;
	 public $_emr08_00_01_063_type='varchar2';
	/**
 	 * 注释:地址-县（区）*
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_064;
	 public $_emr08_00_01_064_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）*
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_066;
	 public $_emr08_00_01_066_type='varchar2';
	/**
 	 * 注释:地址-门牌号码*
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_067;
	 public $_emr08_00_01_067_type='varchar2';
	/**
 	 * 注释:邮政编码 *
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $emr08_00_01_068;
	 public $_emr08_00_01_068_type='varchar2';
	/**
 	 * 注释:行政区划代码 *
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $emr08_00_01_069;
	 public $_emr08_00_01_069_type='varchar2';
	/**
 	 * 注释:工作单位名称 *
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr08_00_01_070;
	 public $_emr08_00_01_070_type='varchar2';
	/**
 	 * 注释:联系电话-类别*
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_081;
	 public $_emr08_00_01_081_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码*
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr08_00_01_082;
	 public $_emr08_00_01_082_type='varchar2';
	/**
 	 * 注释:联系电话-号码*
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_083;
	 public $_emr08_00_01_083_type='varchar2';
	/**
 	 * 注释:电子邮件地址*
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_084;
	 public $_emr08_00_01_084_type='varchar2';
	/**
 	 * 注释:医疗保险-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_091;
	 public $_emr08_00_01_091_type='varchar2';
	/**
 	 * 注释:医疗保险-类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr08_00_01_092;
	 public $_emr08_00_01_092_type='varchar2';
	/**
 	 * 注释:机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr08_00_01_101;
	 public $_emr08_00_01_101_type='varchar2';
	/**
 	 * 注释:机构组织机构代码
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr08_00_01_102;
	 public $_emr08_00_01_102_type='varchar2';
	/**
 	 * 注释:机构负责人（法人）
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr08_00_01_103;
	 public $_emr08_00_01_103_type='varchar2';
	/**
 	 * 注释:机构地址
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr08_00_01_104;
	 public $_emr08_00_01_104_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr08_00_01_105;
	 public $_emr08_00_01_105_type='varchar2';
	/**
 	 * 注释:机构角色
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr08_00_01_106;
	 public $_emr08_00_01_106_type='varchar2';
	/**
 	 * 注释:机构角色代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr08_00_01_107;
	 public $_emr08_00_01_107_type='varchar2';
	/**
 	 * 注释:服务者姓名*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr08_00_01_111;
	 public $_emr08_00_01_111_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr08_00_01_112;
	 public $_emr08_00_01_112_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr08_00_01_113;
	 public $_emr08_00_01_113_type='varchar2';
	/**
 	 * 注释:服务者医师资格标志*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr08_00_01_114;
	 public $_emr08_00_01_114_type='varchar2';
	/**
 	 * 注释:服务者学历*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr08_00_01_115;
	 public $_emr08_00_01_115_type='varchar2';
	/**
 	 * 注释:服务者所学专业*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr08_00_01_116;
	 public $_emr08_00_01_116_type='varchar2';
	/**
 	 * 注释:服务者专业技术职称*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr08_00_01_117;
	 public $_emr08_00_01_117_type='varchar2';
	/**
 	 * 注释:服务者职务*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr08_00_01_118;
	 public $_emr08_00_01_118_type='varchar2';
	/**
 	 * 注释:事件分类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr08_00_01_122;
	 public $_emr08_00_01_122_type='varchar2';
	/**
 	 * 注释:事件开始时间
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr08_00_01_123;
	 public $_emr08_00_01_123_type='varchar2';
	/**
 	 * 注释:事件结束时间
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr08_00_01_124;
	 public $_emr08_00_01_124_type='varchar2';
	/**
 	 * 注释:事件发生地点
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr08_00_01_125;
	 public $_emr08_00_01_125_type='date';
	/**
 	 * 注释:事件发生场所
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr08_00_01_126;
	 public $_emr08_00_01_126_type='date';
	/**
 	 * 注释:事件参与方
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr08_00_01_127;
	 public $_emr08_00_01_127_type='varchar2';
	/**
 	 * 注释:事件发生原因
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr08_00_01_128;
	 public $_emr08_00_01_128_type='varchar2';
	/**
 	 * 注释:事件结局
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr08_00_01_129;
	 public $_emr08_00_01_129_type='varchar2';
	/**
 	 * 注释:观察-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_131;
	 public $_emr08_00_01_131_type='varchar2';
	/**
 	 * 注释:观察-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr08_00_01_132;
	 public $_emr08_00_01_132_type='varchar2';
	/**
 	 * 注释:观察项目名称
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr08_00_01_133;
	 public $_emr08_00_01_133_type='varchar2';
	/**
 	 * 注释:观察-项目代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $emr08_00_01_134;
	 public $_emr08_00_01_134_type='varchar2';
	/**
 	 * 注释:观察-结果描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr08_00_01_135;
	 public $_emr08_00_01_135_type='varchar2';
	/**
 	 * 注释:观察-结果(数值)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr08_00_01_136;
	 public $_emr08_00_01_136_type='number';
	/**
 	 * 注释:观察-计量单位
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_137;
	 public $_emr08_00_01_137_type='varchar2';
	/**
 	 * 注释:观察-结果代码
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr08_00_01_138;
	 public $_emr08_00_01_138_type='varchar2';
	/**
 	 * 注释:诊断机构名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_148;
	 public $_emr08_00_01_148_type='varchar2';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr08_00_01_149;
	 public $_emr08_00_01_149_type='varchar2';
	/**
 	 * 注释:诊断类别
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr08_00_01_150;
	 public $_emr08_00_01_150_type='varchar2';
	/**
 	 * 注释:诊断类别代码
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr08_00_01_151;
	 public $_emr08_00_01_151_type='varchar2';
	/**
 	 * 注释:诊断顺位（从属关系）代码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_152;
	 public $_emr08_00_01_152_type='varchar2';
	/**
 	 * 注释:疾病名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_153;
	 public $_emr08_00_01_153_type='varchar2';
	/**
 	 * 注释:疾病代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr08_00_01_154;
	 public $_emr08_00_01_154_type='varchar2';
	/**
 	 * 注释:诊断依据
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr08_00_01_155;
	 public $_emr08_00_01_155_type='varchar2';
	/**
 	 * 注释:诊断依据代码
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr08_00_01_156;
	 public $_emr08_00_01_156_type='date';
	/**
 	 * 注释:操作名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr08_00_01_161;
	 public $_emr08_00_01_161_type='varchar2';
	/**
 	 * 注释:操作编码体系名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr08_00_01_162;
	 public $_emr08_00_01_162_type='varchar2';
	/**
 	 * 注释:操作编码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $emr08_00_01_163;
	 public $_emr08_00_01_163_type='varchar2';
	/**
 	 * 注释:操作部位名称
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $emr08_00_01_164;
	 public $_emr08_00_01_164_type='varchar2';
	/**
 	 * 注释:操作部位编码体系名称
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $emr08_00_01_165;
	 public $_emr08_00_01_165_type='varchar2';
	/**
 	 * 注释:操作部位编码
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr08_00_01_166;
	 public $_emr08_00_01_166_type='varchar2';
	/**
 	 * 注释:介入物名称
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr08_00_01_167;
	 public $_emr08_00_01_167_type='varchar2';
	/**
 	 * 注释:操作方法
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr08_00_01_168;
	 public $_emr08_00_01_168_type='number';
	/**
 	 * 注释:操作次数
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr08_00_01_169;
	 public $_emr08_00_01_169_type='date';
	/**
 	 * 注释:操作日期/时间
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr08_00_01_170;
	 public $_emr08_00_01_170_type='varchar2';
	/**
 	 * 注释:麻醉观察项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr08_00_01_181;
	 public $_emr08_00_01_181_type='varchar2';
	/**
 	 * 注释:麻醉观察结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr08_00_01_182;
	 public $_emr08_00_01_182_type='varchar2';
	/**
 	 * 注释:住院期间输血品种代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr08_00_01_191;
	 public $_emr08_00_01_191_type='varchar2';
	/**
 	 * 注释:住院期间输血量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr08_00_01_192;
	 public $_emr08_00_01_192_type='number';
	/**
 	 * 注释:住院患者输血量计量单位
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $emr08_00_01_193;
	 public $_emr08_00_01_193_type='varchar2';
	/**
 	 * 注释:输血日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr08_00_01_195;
	 public $_emr08_00_01_195_type='date';
	/**
 	 * 注释:输血方法
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr08_00_01_196;
	 public $_emr08_00_01_196_type='varchar2';
	/**
 	 * 注释:拟做的检查
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr08_00_01_201;
	 public $_emr08_00_01_201_type='varchar2';
	/**
 	 * 注释:拟做的医学检验
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr08_00_01_202;
	 public $_emr08_00_01_202_type='varchar2';
	/**
 	 * 注释:今后治疗方案
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr08_00_01_203;
	 public $_emr08_00_01_203_type='varchar2';
	/**
 	 * 注释:随访标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr08_00_01_204;
	 public $_emr08_00_01_204_type='number';
	/**
 	 * 注释:随访间隔（随诊期限）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr08_00_01_205;
	 public $_emr08_00_01_205_type='number';
	/**
 	 * 注释:医嘱
	 * 
	 * 
	 * @var VARCHAR2(1500)
	 **/
 	 public $emr08_00_01_206;
	 public $_emr08_00_01_206_type='varchar2';
	/**
 	 * 注释:特别注意事项
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr08_00_01_207;
	 public $_emr08_00_01_207_type='varchar2';
	/**
 	 * 注释:住院患者治疗结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr08_00_01_211;
	 public $_emr08_00_01_211_type='varchar2';
	/**
 	 * 注释:住院患者抢救次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr08_00_01_212;
	 public $_emr08_00_01_212_type='number';
	/**
 	 * 注释:住院患者抢救成功次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr08_00_01_213;
	 public $_emr08_00_01_213_type='number';
	/**
 	 * 注释:患者去向代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr08_00_01_215;
	 public $_emr08_00_01_215_type='varchar2';
	/**
 	 * 注释:患者疾病诊断对照
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_221;
	 public $_emr08_00_01_221_type='varchar2';
	/**
 	 * 注释:住院患者疾病诊断对照代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr08_00_01_222;
	 public $_emr08_00_01_222_type='varchar2';
	/**
 	 * 注释:住院患者诊断符合情况-详细描述
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_223;
	 public $_emr08_00_01_223_type='varchar2';
	/**
 	 * 注释:住院患者诊断符合情况-代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr08_00_01_224;
	 public $_emr08_00_01_224_type='varchar2';
	/**
 	 * 注释:住院病例病案质量代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr08_00_01_225;
	 public $_emr08_00_01_225_type='varchar2';
	/**
 	 * 注释:入院后诊断时间（天）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr08_00_01_226;
	 public $_emr08_00_01_226_type='number';
	/**
 	 * 注释:诊疗过程名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr08_00_01_231;
	 public $_emr08_00_01_231_type='varchar2';
	/**
 	 * 注释:诊疗过程描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr08_00_01_232;
	 public $_emr08_00_01_232_type='varchar2';
	/**
 	 * 注释:门诊费用-分类
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_241;
	 public $_emr08_00_01_241_type='varchar2';
	/**
 	 * 注释:门诊费用-分类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr08_00_01_242;
	 public $_emr08_00_01_242_type='varchar2';
	/**
 	 * 注释:门诊费用-金额（元/人民币）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr08_00_01_243;
	 public $_emr08_00_01_243_type='number';
	/**
 	 * 注释:门诊费用-支付方式代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr08_00_01_244;
	 public $_emr08_00_01_244_type='varchar2';
	/**
 	 * 注释:住院费用-分类
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr08_00_01_245;
	 public $_emr08_00_01_245_type='varchar2';
	/**
 	 * 注释:住院费用-分类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr08_00_01_246;
	 public $_emr08_00_01_246_type='varchar2';
	/**
 	 * 注释:住院费用-金额（元/人民币）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr08_00_01_247;
	 public $_emr08_00_01_247_type='number';
	/**
 	 * 注释:住院费用-医疗付款方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr08_00_01_248;
	 public $_emr08_00_01_248_type='varchar2';
	/**
 	 * 注释:个人承担费用（元）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr08_00_01_249;
	 public $_emr08_00_01_249_type='number';
}
