<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_emr09_00 extends dao_oracle{
	 public $__table = 'ws_emr09_00';
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
 	 * 注释:症状观察结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_087;
	 public $_emr09_00_01_087_type='varchar2';
	/**
 	 * 注释:观察-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr09_00_01_091;
	 public $_emr09_00_01_091_type='varchar2';
	/**
 	 * 注释:观察-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_092;
	 public $_emr09_00_01_092_type='varchar2';
	/**
 	 * 注释:观察项目名称
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_093;
	 public $_emr09_00_01_093_type='varchar2';
	/**
 	 * 注释:观察-项目代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $emr09_00_01_094;
	 public $_emr09_00_01_094_type='varchar2';
	/**
 	 * 注释:观察-结果描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_095;
	 public $_emr09_00_01_095_type='varchar2';
	/**
 	 * 注释:观察-结果(数值)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr09_00_01_096;
	 public $_emr09_00_01_096_type='number';
	/**
 	 * 注释:观察-计量单位
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr09_00_01_097;
	 public $_emr09_00_01_097_type='varchar2';
	/**
 	 * 注释:观察-结果代码
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_098;
	 public $_emr09_00_01_098_type='varchar2';
	/**
 	 * 注释:体格检查项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_099;
	 public $_emr09_00_01_099_type='varchar2';
	/**
 	 * 注释:体格检查观察结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_100;
	 public $_emr09_00_01_100_type='varchar2';
	/**
 	 * 注释:一般状态检查描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_111;
	 public $_emr09_00_01_111_type='varchar2';
	/**
 	 * 注释:一般状态检查体征代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_112;
	 public $_emr09_00_01_112_type='varchar2';
	/**
 	 * 注释:一般状态检查项目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_113;
	 public $_emr09_00_01_113_type='varchar2';
	/**
 	 * 注释:一般状态检查项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_114;
	 public $_emr09_00_01_114_type='varchar2';
	/**
 	 * 注释:一般状态检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_121;
	 public $_emr09_00_01_121_type='varchar2';
	/**
 	 * 注释:皮肤检查描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_122;
	 public $_emr09_00_01_122_type='varchar2';
	/**
 	 * 注释:皮肤检查体征代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_123;
	 public $_emr09_00_01_123_type='varchar2';
	/**
 	 * 注释:皮肤检查项目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_124;
	 public $_emr09_00_01_124_type='varchar2';
	/**
 	 * 注释:皮肤检查项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_125;
	 public $_emr09_00_01_125_type='varchar2';
	/**
 	 * 注释:皮肤检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_126;
	 public $_emr09_00_01_126_type='varchar2';
	/**
 	 * 注释:浅表淋巴结检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_131;
	 public $_emr09_00_01_131_type='varchar2';
	/**
 	 * 注释:淋巴管／结炎发作特点代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_132;
	 public $_emr09_00_01_132_type='varchar2';
	/**
 	 * 注释:淋巴管／结炎发作伴随高热寒战标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr09_00_01_133;
	 public $_emr09_00_01_133_type='number';
	/**
 	 * 注释:淋巴结检查结果-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_134;
	 public $_emr09_00_01_134_type='varchar2';
	/**
 	 * 注释:淋巴结检查结果-描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_135;
	 public $_emr09_00_01_135_type='varchar2';
	/**
 	 * 注释:淋巴结检查体征代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_136;
	 public $_emr09_00_01_136_type='varchar2';
	/**
 	 * 注释:淋巴结检查项目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_137;
	 public $_emr09_00_01_137_type='varchar2';
	/**
 	 * 注释:头部检查描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_141;
	 public $_emr09_00_01_141_type='varchar2';
	/**
 	 * 注释:头部检查体征代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_142;
	 public $_emr09_00_01_142_type='varchar2';
	/**
 	 * 注释:头部检查项目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_143;
	 public $_emr09_00_01_143_type='varchar2';
	/**
 	 * 注释:头部检查项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_144;
	 public $_emr09_00_01_144_type='varchar2';
	/**
 	 * 注释:头部检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_145;
	 public $_emr09_00_01_145_type='varchar2';
	/**
 	 * 注释:甲状腺检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_151;
	 public $_emr09_00_01_151_type='varchar2';
	/**
 	 * 注释:喉结检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_152;
	 public $_emr09_00_01_152_type='varchar2';
	/**
 	 * 注释:颈静脉怒张标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr09_00_01_153;
	 public $_emr09_00_01_153_type='number';
	/**
 	 * 注释:颈部检查描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_154;
	 public $_emr09_00_01_154_type='varchar2';
	/**
 	 * 注释:颈部检查体征代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_155;
	 public $_emr09_00_01_155_type='varchar2';
	/**
 	 * 注释:颈部检查项目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_156;
	 public $_emr09_00_01_156_type='varchar2';
	/**
 	 * 注释:胸部检查描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_161;
	 public $_emr09_00_01_161_type='varchar2';
	/**
 	 * 注释:胸部检查体征代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_162;
	 public $_emr09_00_01_162_type='varchar2';
	/**
 	 * 注释:胸部检查项目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_163;
	 public $_emr09_00_01_163_type='varchar2';
	/**
 	 * 注释:胸部检查项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_164;
	 public $_emr09_00_01_164_type='varchar2';
	/**
 	 * 注释:胸部检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_165;
	 public $_emr09_00_01_165_type='varchar2';
	/**
 	 * 注释:腹部检查描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_171;
	 public $_emr09_00_01_171_type='varchar2';
	/**
 	 * 注释:腹部检查体征代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_172;
	 public $_emr09_00_01_172_type='varchar2';
	/**
 	 * 注释:腹部检查项目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_173;
	 public $_emr09_00_01_173_type='varchar2';
	/**
 	 * 注释:腹部检查项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_174;
	 public $_emr09_00_01_174_type='varchar2';
	/**
 	 * 注释:腹部检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_175;
	 public $_emr09_00_01_175_type='varchar2';
	/**
 	 * 注释:生殖器、肛门、直肠检查描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_181;
	 public $_emr09_00_01_181_type='varchar2';
	/**
 	 * 注释:性别代码 
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_021;
	 public $_emr09_00_01_021_type='varchar2';
	/**
 	 * 注释:年龄（岁）*
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr09_00_01_022;
	 public $_emr09_00_01_022_type='number';
	/**
 	 * 注释:国籍代码 
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr09_00_01_023;
	 public $_emr09_00_01_023_type='varchar2';
	/**
 	 * 注释:民族代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_024;
	 public $_emr09_00_01_024_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_025;
	 public $_emr09_00_01_025_type='varchar2';
	/**
 	 * 注释:职业编码系统名称 
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr09_00_01_026;
	 public $_emr09_00_01_026_type='varchar2';
	/**
 	 * 注释:职业代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr09_00_01_027;
	 public $_emr09_00_01_027_type='varchar2';
	/**
 	 * 注释:文化程度代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_028;
	 public $_emr09_00_01_028_type='varchar2';
	/**
 	 * 注释:出生日期* 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr09_00_01_029;
	 public $_emr09_00_01_029_type='date';
	/**
 	 * 注释:出生地*
	 * 
	 * 
	 * @var VARCHAR2(360)
	 **/
 	 public $emr09_00_01_030;
	 public $_emr09_00_01_030_type='varchar2';
	/**
 	 * 注释:标识号-类别代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_041;
	 public $_emr09_00_01_041_type='varchar2';
	/**
 	 * 注释:标识号-号码*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_042;
	 public $_emr09_00_01_042_type='varchar2';
	/**
 	 * 注释:标识号-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr09_00_01_043;
	 public $_emr09_00_01_043_type='date';
	/**
 	 * 注释:标识号-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr09_00_01_044;
	 public $_emr09_00_01_044_type='date';
	/**
 	 * 注释:标识号-提供标识的机构名称 
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr09_00_01_045;
	 public $_emr09_00_01_045_type='varchar2';
	/**
 	 * 注释:姓名-标识对象
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr09_00_01_046;
	 public $_emr09_00_01_046_type='varchar2';
	/**
 	 * 注释:姓名*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_048;
	 public $_emr09_00_01_048_type='varchar2';
	/**
 	 * 注释:机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr09_00_01_051;
	 public $_emr09_00_01_051_type='varchar2';
	/**
 	 * 注释:机构组织机构代码
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr09_00_01_052;
	 public $_emr09_00_01_052_type='varchar2';
	/**
 	 * 注释:机构负责人（法人）
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_053;
	 public $_emr09_00_01_053_type='varchar2';
	/**
 	 * 注释:机构地址
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_054;
	 public $_emr09_00_01_054_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr09_00_01_055;
	 public $_emr09_00_01_055_type='varchar2';
	/**
 	 * 注释:机构角色
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr09_00_01_056;
	 public $_emr09_00_01_056_type='varchar2';
	/**
 	 * 注释:机构角色代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_057;
	 public $_emr09_00_01_057_type='varchar2';
	/**
 	 * 注释:服务者姓名*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_061;
	 public $_emr09_00_01_061_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_062;
	 public $_emr09_00_01_062_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_063;
	 public $_emr09_00_01_063_type='varchar2';
	/**
 	 * 注释:服务者医师资格标志*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_064;
	 public $_emr09_00_01_064_type='varchar2';
	/**
 	 * 注释:服务者学历*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_065;
	 public $_emr09_00_01_065_type='varchar2';
	/**
 	 * 注释:服务者所学专业*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_066;
	 public $_emr09_00_01_066_type='varchar2';
	/**
 	 * 注释:服务者专业技术职称*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_067;
	 public $_emr09_00_01_067_type='varchar2';
	/**
 	 * 注释:服务者职务*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_068;
	 public $_emr09_00_01_068_type='varchar2';
	/**
 	 * 注释:事件分类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_072;
	 public $_emr09_00_01_072_type='varchar2';
	/**
 	 * 注释:事件开始时间
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr09_00_01_073;
	 public $_emr09_00_01_073_type='varchar2';
	/**
 	 * 注释:事件结束时间
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_074;
	 public $_emr09_00_01_074_type='varchar2';
	/**
 	 * 注释:事件发生地点
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr09_00_01_075;
	 public $_emr09_00_01_075_type='date';
	/**
 	 * 注释:事件发生场所
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr09_00_01_076;
	 public $_emr09_00_01_076_type='date';
	/**
 	 * 注释:事件参与方
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr09_00_01_077;
	 public $_emr09_00_01_077_type='varchar2';
	/**
 	 * 注释:事件发生原因
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr09_00_01_078;
	 public $_emr09_00_01_078_type='varchar2';
	/**
 	 * 注释:事件结局
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_079;
	 public $_emr09_00_01_079_type='varchar2';
	/**
 	 * 注释:主诉
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_081;
	 public $_emr09_00_01_081_type='varchar2';
	/**
 	 * 注释:症状代码编码体系名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr09_00_01_082;
	 public $_emr09_00_01_082_type='varchar2';
	/**
 	 * 注释:症状代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $emr09_00_01_083;
	 public $_emr09_00_01_083_type='varchar2';
	/**
 	 * 注释:症状开始日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr09_00_01_084;
	 public $_emr09_00_01_084_type='date';
	/**
 	 * 注释:症状停止日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr09_00_01_085;
	 public $_emr09_00_01_085_type='date';
	/**
 	 * 注释:个人史危险因素代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_271;
	 public $_emr09_00_01_271_type='varchar2';
	/**
 	 * 注释:个人史观察项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_272;
	 public $_emr09_00_01_272_type='varchar2';
	/**
 	 * 注释:个人史观察结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_273;
	 public $_emr09_00_01_273_type='varchar2';
	/**
 	 * 注释:婚姻史观察项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_281;
	 public $_emr09_00_01_281_type='varchar2';
	/**
 	 * 注释:婚姻史观察结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_282;
	 public $_emr09_00_01_282_type='varchar2';
	/**
 	 * 注释:月经史观察项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_291;
	 public $_emr09_00_01_291_type='varchar2';
	/**
 	 * 注释:月经史观察结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_292;
	 public $_emr09_00_01_292_type='varchar2';
	/**
 	 * 注释:生育史观察项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_301;
	 public $_emr09_00_01_301_type='varchar2';
	/**
 	 * 注释:生育史观察结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_302;
	 public $_emr09_00_01_302_type='varchar2';
	/**
 	 * 注释:家族史观察项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_311;
	 public $_emr09_00_01_311_type='varchar2';
	/**
 	 * 注释:家族史观察结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_312;
	 public $_emr09_00_01_312_type='varchar2';
	/**
 	 * 注释:暴露史观察项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_321;
	 public $_emr09_00_01_321_type='varchar2';
	/**
 	 * 注释:暴露史观察结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_322;
	 public $_emr09_00_01_322_type='varchar2';
	/**
 	 * 注释:观察-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr09_00_01_331;
	 public $_emr09_00_01_331_type='varchar2';
	/**
 	 * 注释:观察-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_332;
	 public $_emr09_00_01_332_type='varchar2';
	/**
 	 * 注释:观察项目名称
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_333;
	 public $_emr09_00_01_333_type='varchar2';
	/**
 	 * 注释:观察-项目代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $emr09_00_01_334;
	 public $_emr09_00_01_334_type='varchar2';
	/**
 	 * 注释:观察-结果描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_335;
	 public $_emr09_00_01_335_type='varchar2';
	/**
 	 * 注释:观察-结果(数值)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr09_00_01_336;
	 public $_emr09_00_01_336_type='number';
	/**
 	 * 注释:观察-计量单位
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr09_00_01_337;
	 public $_emr09_00_01_337_type='varchar2';
	/**
 	 * 注释:观察-结果代码
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_338;
	 public $_emr09_00_01_338_type='varchar2';
	/**
 	 * 注释:检查部位
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_339;
	 public $_emr09_00_01_339_type='varchar2';
	/**
 	 * 注释:检查部位代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_340;
	 public $_emr09_00_01_340_type='varchar2';
	/**
 	 * 注释:观察-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr09_00_01_351;
	 public $_emr09_00_01_351_type='varchar2';
	/**
 	 * 注释:观察-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_352;
	 public $_emr09_00_01_352_type='varchar2';
	/**
 	 * 注释:观察项目名称
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_353;
	 public $_emr09_00_01_353_type='varchar2';
	/**
 	 * 注释:观察-项目代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $emr09_00_01_354;
	 public $_emr09_00_01_354_type='varchar2';
	/**
 	 * 注释:观察-结果描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_355;
	 public $_emr09_00_01_355_type='varchar2';
	/**
 	 * 注释:观察-结果(数值)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emr09_00_01_356;
	 public $_emr09_00_01_356_type='number';
	/**
 	 * 注释:观察-计量单位
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr09_00_01_357;
	 public $_emr09_00_01_357_type='varchar2';
	/**
 	 * 注释:观察-结果代码
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_358;
	 public $_emr09_00_01_358_type='varchar2';
	/**
 	 * 注释:诊断机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr09_00_01_361;
	 public $_emr09_00_01_361_type='varchar2';
	/**
 	 * 注释:诊断日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr09_00_01_362;
	 public $_emr09_00_01_362_type='date';
	/**
 	 * 注释:诊断类别 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr09_00_01_363;
	 public $_emr09_00_01_363_type='varchar2';
	/**
 	 * 注释:诊断类别代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_364;
	 public $_emr09_00_01_364_type='varchar2';
	/**
 	 * 注释:诊断顺位（从属关系）代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_365;
	 public $_emr09_00_01_365_type='varchar2';
	/**
 	 * 注释:疾病名称 
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_366;
	 public $_emr09_00_01_366_type='varchar2';
	/**
 	 * 注释:疾病代码 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr09_00_01_367;
	 public $_emr09_00_01_367_type='varchar2';
	/**
 	 * 注释:诊断依据 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr09_00_01_368;
	 public $_emr09_00_01_368_type='varchar2';
	/**
 	 * 注释:诊断依据代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_369;
	 public $_emr09_00_01_369_type='varchar2';
	/**
 	 * 注释:疫苗接种日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr09_00_01_371;
	 public $_emr09_00_01_371_type='date';
	/**
 	 * 注释:免疫类型代码 
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_372;
	 public $_emr09_00_01_372_type='varchar2';
	/**
 	 * 注释:免疫接种方法代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_373;
	 public $_emr09_00_01_373_type='varchar2';
	/**
 	 * 注释:免疫接种状态代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_374;
	 public $_emr09_00_01_374_type='varchar2';
	/**
 	 * 注释:疫苗-名称代码 
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $emr09_00_01_375;
	 public $_emr09_00_01_375_type='varchar2';
	/**
 	 * 注释:疫苗-批号
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_376;
	 public $_emr09_00_01_376_type='varchar2';
	/**
 	 * 注释:疫苗-名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr09_00_01_377;
	 public $_emr09_00_01_377_type='varchar2';
	/**
 	 * 注释:生殖器、肛门、直肠检查体征代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_182;
	 public $_emr09_00_01_182_type='varchar2';
	/**
 	 * 注释:生殖器、肛门、直肠检查项目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_183;
	 public $_emr09_00_01_183_type='varchar2';
	/**
 	 * 注释:生殖器、肛门、直肠检查项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_184;
	 public $_emr09_00_01_184_type='varchar2';
	/**
 	 * 注释:生殖器、肛门、直肠检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_185;
	 public $_emr09_00_01_185_type='varchar2';
	/**
 	 * 注释:四肢检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_191;
	 public $_emr09_00_01_191_type='varchar2';
	/**
 	 * 注释:脊柱检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_192;
	 public $_emr09_00_01_192_type='varchar2';
	/**
 	 * 注释:脊柱与四肢检查描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_193;
	 public $_emr09_00_01_193_type='varchar2';
	/**
 	 * 注释:脊柱与四肢检查体征代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_194;
	 public $_emr09_00_01_194_type='varchar2';
	/**
 	 * 注释:脊柱与四肢检查项目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_195;
	 public $_emr09_00_01_195_type='varchar2';
	/**
 	 * 注释:功能检查描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_201;
	 public $_emr09_00_01_201_type='varchar2';
	/**
 	 * 注释:功能检查体征代码
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_202;
	 public $_emr09_00_01_202_type='varchar2';
	/**
 	 * 注释:功能检查项目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_203;
	 public $_emr09_00_01_203_type='varchar2';
	/**
 	 * 注释:残疾情况代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_204;
	 public $_emr09_00_01_204_type='varchar2';
	/**
 	 * 注释:功能检查项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_205;
	 public $_emr09_00_01_205_type='varchar2';
	/**
 	 * 注释:功能检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_206;
	 public $_emr09_00_01_206_type='varchar2';
	/**
 	 * 注释:起病时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr09_00_01_211;
	 public $_emr09_00_01_211_type='date';
	/**
 	 * 注释:起病情况描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_212;
	 public $_emr09_00_01_212_type='varchar2';
	/**
 	 * 注释:症状开始原因/诱因
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_213;
	 public $_emr09_00_01_213_type='varchar2';
	/**
 	 * 注释:症状特点
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_214;
	 public $_emr09_00_01_214_type='varchar2';
	/**
 	 * 注释:伴随症状
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_215;
	 public $_emr09_00_01_215_type='varchar2';
	/**
 	 * 注释:本疾病既往诊疗经过
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_216;
	 public $_emr09_00_01_216_type='varchar2';
	/**
 	 * 注释:起病后一般情况
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_217;
	 public $_emr09_00_01_217_type='varchar2';
	/**
 	 * 注释:基础疾病诊疗情况
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_218;
	 public $_emr09_00_01_218_type='varchar2';
	/**
 	 * 注释:感染途径
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_221;
	 public $_emr09_00_01_221_type='varchar2';
	/**
 	 * 注释:感染途径代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_222;
	 public $_emr09_00_01_222_type='varchar2';
	/**
 	 * 注释:家族史观察项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_223;
	 public $_emr09_00_01_223_type='varchar2';
	/**
 	 * 注释:家族史观察结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_224;
	 public $_emr09_00_01_224_type='varchar2';
	/**
 	 * 注释:既往疾病史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_231;
	 public $_emr09_00_01_231_type='varchar2';
	/**
 	 * 注释:既往精神类疾病诊断名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr09_00_01_232;
	 public $_emr09_00_01_232_type='varchar2';
	/**
 	 * 注释:既往疾病名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr09_00_01_233;
	 public $_emr09_00_01_233_type='varchar2';
	/**
 	 * 注释:既往疾病代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $emr09_00_01_234;
	 public $_emr09_00_01_234_type='varchar2';
	/**
 	 * 注释:既往疾病诊断机构
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr09_00_01_235;
	 public $_emr09_00_01_235_type='varchar2';
	/**
 	 * 注释:既往疾病诊断机构级别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_236;
	 public $_emr09_00_01_236_type='varchar2';
	/**
 	 * 注释:既往疾病诊断时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr09_00_01_237;
	 public $_emr09_00_01_237_type='date';
	/**
 	 * 注释:疾病当前状态代码
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_238;
	 public $_emr09_00_01_238_type='varchar2';
	/**
 	 * 注释:手术史标识
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_241;
	 public $_emr09_00_01_241_type='varchar2';
	/**
 	 * 注释:手术方式代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $emr09_00_01_242;
	 public $_emr09_00_01_242_type='varchar2';
	/**
 	 * 注释:手术体位代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_243;
	 public $_emr09_00_01_243_type='varchar2';
	/**
 	 * 注释:手术过程描述
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr09_00_01_244;
	 public $_emr09_00_01_244_type='varchar2';
	/**
 	 * 注释:输血史标识代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_251;
	 public $_emr09_00_01_251_type='varchar2';
	/**
 	 * 注释:输血史观察项目数据组
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_252;
	 public $_emr09_00_01_252_type='varchar2';
	/**
 	 * 注释:输血史观察结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_253;
	 public $_emr09_00_01_253_type='varchar2';
	/**
 	 * 注释:过敏史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_261;
	 public $_emr09_00_01_261_type='varchar2';
	/**
 	 * 注释:过敏原
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr09_00_01_262;
	 public $_emr09_00_01_262_type='varchar2';
	/**
 	 * 注释:过敏症状
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_263;
	 public $_emr09_00_01_263_type='varchar2';
	/**
 	 * 注释:过敏症状代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_264;
	 public $_emr09_00_01_264_type='varchar2';
	/**
 	 * 注释:过敏原代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_265;
	 public $_emr09_00_01_265_type='varchar2';
	/**
 	 * 注释:过敏药物名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr09_00_01_266;
	 public $_emr09_00_01_266_type='varchar2';
	/**
 	 * 注释:过敏病情状态代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_267;
	 public $_emr09_00_01_267_type='varchar2';
	/**
 	 * 注释:过敏严重性代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_268;
	 public $_emr09_00_01_268_type='varchar2';
	/**
 	 * 注释:过敏史标识代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr09_00_01_269;
	 public $_emr09_00_01_269_type='varchar2';
	/**
 	 * 注释:文档标识-名称 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr09_00_01_001;
	 public $_emr09_00_01_001_type='varchar2';
	/**
 	 * 注释:文档标识-类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_002;
	 public $_emr09_00_01_002_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr09_00_01_003;
	 public $_emr09_00_01_003_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构组织机构代码（法人代码）
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr09_00_01_004;
	 public $_emr09_00_01_004_type='varchar2';
	/**
 	 * 注释:文档标识-号码 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr09_00_01_005;
	 public $_emr09_00_01_005_type='varchar2';
	/**
 	 * 注释:文档标识-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr09_00_01_006;
	 public $_emr09_00_01_006_type='date';
	/**
 	 * 注释:文档标识-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr09_00_01_007;
	 public $_emr09_00_01_007_type='date';
	/**
 	 * 注释:标识号-类别代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr09_00_01_011;
	 public $_emr09_00_01_011_type='varchar2';
	/**
 	 * 注释:标识号-号码 *
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_012;
	 public $_emr09_00_01_012_type='varchar2';
	/**
 	 * 注释:标识号-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr09_00_01_013;
	 public $_emr09_00_01_013_type='date';
	/**
 	 * 注释:标识号-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr09_00_01_014;
	 public $_emr09_00_01_014_type='date';
	/**
 	 * 注释:标识号-提供标识的机构名称 
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr09_00_01_015;
	 public $_emr09_00_01_015_type='varchar2';
	/**
 	 * 注释:姓名-标识对象
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr09_00_01_016;
	 public $_emr09_00_01_016_type='varchar2';
	/**
 	 * 注释:姓名 *
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr09_00_01_018;
	 public $_emr09_00_01_018_type='varchar2';
	/**
 	 * 注释:症状观察项目类目名称
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr09_00_01_086;
	 public $_emr09_00_01_086_type='varchar2';
}
