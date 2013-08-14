<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrc00_04 extends dao_oracle{
	 public $__table = 'ws_hrc00_04';
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
 	 * 注释:健康档案标识符
	 * 
	 * 
	 * @var VARCHAR2(69)
	 **/
 	 public $hrc00_04_001;
	 public $_hrc00_04_001_type='varchar2';
	/**
 	 * 注释:空腹血糖值(mmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_074;
	 public $_hrc00_04_074_type='number';
	/**
 	 * 注释:餐后两小时血糖值(mmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_075;
	 public $_hrc00_04_075_type='number';
	/**
 	 * 注释:糖化血红蛋白值(%)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_076;
	 public $_hrc00_04_076_type='number';
	/**
 	 * 注释:白蛋白浓度(g/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_077;
	 public $_hrc00_04_077_type='number';
	/**
 	 * 注释:丙氨酸氨基转移酶检测值(U/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_078;
	 public $_hrc00_04_078_type='number';
	/**
 	 * 注释:天冬氨酸氨基转移酶检测值(U/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_079;
	 public $_hrc00_04_079_type='number';
	/**
 	 * 注释:结合胆红素值(μmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_080;
	 public $_hrc00_04_080_type='number';
	/**
 	 * 注释:总胆红素值(μmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_081;
	 public $_hrc00_04_081_type='number';
	/**
 	 * 注释:血钾浓度(mmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_082;
	 public $_hrc00_04_082_type='number';
	/**
 	 * 注释:血钠浓度(mmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_083;
	 public $_hrc00_04_083_type='number';
	/**
 	 * 注释:血尿素氮检测值(mmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_084;
	 public $_hrc00_04_084_type='number';
	/**
 	 * 注释:血肌酐值(μmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_085;
	 public $_hrc00_04_085_type='number';
	/**
 	 * 注释:甘油三酯值(mmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_086;
	 public $_hrc00_04_086_type='number';
	/**
 	 * 注释:血清低密度脂蛋白胆固醇检测值(mmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_087;
	 public $_hrc00_04_087_type='number';
	/**
 	 * 注释:血清高密度脂蛋白胆固醇检测值(mmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_088;
	 public $_hrc00_04_088_type='number';
	/**
 	 * 注释:总胆固醇值(mmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_089;
	 public $_hrc00_04_089_type='number';
	/**
 	 * 注释:乙型肝炎病毒e抗体检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_090;
	 public $_hrc00_04_090_type='varchar2';
	/**
 	 * 注释:乙型肝炎病毒e抗原检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_091;
	 public $_hrc00_04_091_type='varchar2';
	/**
 	 * 注释:乙型肝炎病毒表面抗体检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_092;
	 public $_hrc00_04_092_type='varchar2';
	/**
 	 * 注释:乙型肝炎病毒表面抗原检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_093;
	 public $_hrc00_04_093_type='varchar2';
	/**
 	 * 注释:乙型肝炎病毒核心抗体检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_094;
	 public $_hrc00_04_094_type='varchar2';
	/**
 	 * 注释:甲胎蛋白值(μg/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_095;
	 public $_hrc00_04_095_type='number';
	/**
 	 * 注释:癌胚抗原浓度值(μg/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_096;
	 public $_hrc00_04_096_type='number';
	/**
 	 * 注释:老年人抑郁评分
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_097;
	 public $_hrc00_04_097_type='number';
	/**
 	 * 注释:老年人情感状态初筛结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_098;
	 public $_hrc00_04_098_type='varchar2';
	/**
 	 * 注释:老年人认知功能初筛结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_099;
	 public $_hrc00_04_099_type='varchar2';
	/**
 	 * 注释:老年人认知功能评分
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_100;
	 public $_hrc00_04_100_type='number';
	/**
 	 * 注释:胸部X线检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_101;
	 public $_hrc00_04_101_type='varchar2';
	/**
 	 * 注释:B超检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_102;
	 public $_hrc00_04_102_type='varchar2';
	/**
 	 * 注释:影像检查
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_103;
	 public $_hrc00_04_103_type='varchar2';
	/**
 	 * 注释:足背动脉搏动标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_104;
	 public $_hrc00_04_104_type='number';
	/**
 	 * 注释:颈静脉怒张标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_105;
	 public $_hrc00_04_105_type='number';
	/**
 	 * 注释:口唇紫绀标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_106;
	 public $_hrc00_04_106_type='number';
	/**
 	 * 注释:COPD咳嗽症状类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_107;
	 public $_hrc00_04_107_type='varchar2';
	/**
 	 * 注释:COPD咳痰症状类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_108;
	 public $_hrc00_04_108_type='varchar2';
	/**
 	 * 注释:哮鸣音种类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrc00_04_109;
	 public $_hrc00_04_109_type='varchar2';
	/**
 	 * 注释:呼吸困难症状类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_110;
	 public $_hrc00_04_110_type='varchar2';
	/**
 	 * 注释:一秒钟用力呼气量(ml)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_111;
	 public $_hrc00_04_111_type='number';
	/**
 	 * 注释:一秒钟用力呼气量/最大肺活量比值(%)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_112;
	 public $_hrc00_04_112_type='number';
	/**
 	 * 注释:血氧饱和度(%)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_113;
	 public $_hrc00_04_113_type='number';
	/**
 	 * 注释:六分钟步行距离(m)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_115;
	 public $_hrc00_04_115_type='number';
	/**
 	 * 注释:体检结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_116;
	 public $_hrc00_04_116_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrc00_04_002;
	 public $_hrc00_04_002_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_04_003;
	 public $_hrc00_04_003_type='date';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_004;
	 public $_hrc00_04_004_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_005;
	 public $_hrc00_04_005_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrc00_04_006;
	 public $_hrc00_04_006_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_007;
	 public $_hrc00_04_007_type='varchar2';
	/**
 	 * 注释:职业类别代码(国标)
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrc00_04_008;
	 public $_hrc00_04_008_type='varchar2';
	/**
 	 * 注释:责任医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrc00_04_009;
	 public $_hrc00_04_009_type='varchar2';
	/**
 	 * 注释:检查（测）日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_04_010;
	 public $_hrc00_04_010_type='date';
	/**
 	 * 注释:症状代码(健康检查)
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrc00_04_011;
	 public $_hrc00_04_011_type='varchar2';
	/**
 	 * 注释:身高(cm)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_012;
	 public $_hrc00_04_012_type='number';
	/**
 	 * 注释:体温(℃)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_013;
	 public $_hrc00_04_013_type='number';
	/**
 	 * 注释:体重（kg）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_014;
	 public $_hrc00_04_014_type='number';
	/**
 	 * 注释:体重指数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_015;
	 public $_hrc00_04_015_type='number';
	/**
 	 * 注释:臀围(cm)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_016;
	 public $_hrc00_04_016_type='number';
	/**
 	 * 注释:腰围(cm)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_017;
	 public $_hrc00_04_017_type='number';
	/**
 	 * 注释:腰臀围比值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_018;
	 public $_hrc00_04_018_type='number';
	/**
 	 * 注释:脉率（次/分钟）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_019;
	 public $_hrc00_04_019_type='number';
	/**
 	 * 注释:呼吸频率（次/分钟）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_020;
	 public $_hrc00_04_020_type='number';
	/**
 	 * 注释:皮肤巩膜检查结果类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_021;
	 public $_hrc00_04_021_type='varchar2';
	/**
 	 * 注释:口唇外观类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_022;
	 public $_hrc00_04_022_type='varchar2';
	/**
 	 * 注释:齿列类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_023;
	 public $_hrc00_04_023_type='varchar2';
	/**
 	 * 注释:咽部检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_024;
	 public $_hrc00_04_024_type='varchar2';
	/**
 	 * 注释:胸廓类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_025;
	 public $_hrc00_04_025_type='varchar2';
	/**
 	 * 注释:左眼矫正远视力值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_026;
	 public $_hrc00_04_026_type='number';
	/**
 	 * 注释:左眼裸眼远视力值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_027;
	 public $_hrc00_04_027_type='number';
	/**
 	 * 注释:右眼矫正远视力值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_028;
	 public $_hrc00_04_028_type='number';
	/**
 	 * 注释:右眼裸眼远视力值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_029;
	 public $_hrc00_04_029_type='number';
	/**
 	 * 注释:听力检测结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_030;
	 public $_hrc00_04_030_type='varchar2';
	/**
 	 * 注释:运动功能状态代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_031;
	 public $_hrc00_04_031_type='varchar2';
	/**
 	 * 注释:肺部罗音-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_032;
	 public $_hrc00_04_032_type='number';
	/**
 	 * 注释:肺部罗音-描述
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_033;
	 public $_hrc00_04_033_type='varchar2';
	/**
 	 * 注释:肺部异常呼吸音-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_034;
	 public $_hrc00_04_034_type='number';
	/**
 	 * 注释:肺部异常呼吸音-描述
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_035;
	 public $_hrc00_04_035_type='varchar2';
	/**
 	 * 注释:肝大-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_036;
	 public $_hrc00_04_036_type='number';
	/**
 	 * 注释:肝大-说明
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_037;
	 public $_hrc00_04_037_type='varchar2';
	/**
 	 * 注释:脾大-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_038;
	 public $_hrc00_04_038_type='number';
	/**
 	 * 注释:脾大-说明
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_039;
	 public $_hrc00_04_039_type='varchar2';
	/**
 	 * 注释:腹部包块-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_040;
	 public $_hrc00_04_040_type='number';
	/**
 	 * 注释:腹部包块-说明
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_041;
	 public $_hrc00_04_041_type='varchar2';
	/**
 	 * 注释:腹部压痛-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_042;
	 public $_hrc00_04_042_type='number';
	/**
 	 * 注释:腹部压痛-说明
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_043;
	 public $_hrc00_04_043_type='varchar2';
	/**
 	 * 注释:腹部移动性浊音-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_044;
	 public $_hrc00_04_044_type='number';
	/**
 	 * 注释:腹部移动性浊音-描述
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_045;
	 public $_hrc00_04_045_type='varchar2';
	/**
 	 * 注释:肾区叩痛部位说明
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_046;
	 public $_hrc00_04_046_type='varchar2';
	/**
 	 * 注释:肛门指诊检查结果-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_047;
	 public $_hrc00_04_047_type='varchar2';
	/**
 	 * 注释:肛门指诊检查结果-描述
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_048;
	 public $_hrc00_04_048_type='varchar2';
	/**
 	 * 注释:淋巴结检查结果-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_049;
	 public $_hrc00_04_049_type='varchar2';
	/**
 	 * 注释:淋巴结检查结果-描述
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_050;
	 public $_hrc00_04_050_type='varchar2';
	/**
 	 * 注释:前列腺异常-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_051;
	 public $_hrc00_04_051_type='number';
	/**
 	 * 注释:前列腺异常-说明
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_052;
	 public $_hrc00_04_052_type='number';
	/**
 	 * 注释:下肢水肿检查结果类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_053;
	 public $_hrc00_04_053_type='varchar2';
	/**
 	 * 注释:心率（次/分钟）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_054;
	 public $_hrc00_04_054_type='number';
	/**
 	 * 注释:心律类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_055;
	 public $_hrc00_04_055_type='varchar2';
	/**
 	 * 注释:心脏杂音-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_056;
	 public $_hrc00_04_056_type='number';
	/**
 	 * 注释:心脏杂音-描述
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_057;
	 public $_hrc00_04_057_type='varchar2';
	/**
 	 * 注释:眼底检查结果异常标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_058;
	 public $_hrc00_04_058_type='number';
	/**
 	 * 注释:眼底检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrc00_04_059;
	 public $_hrc00_04_059_type='varchar2';
	/**
 	 * 注释:收缩压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_060;
	 public $_hrc00_04_060_type='number';
	/**
 	 * 注释:舒张压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_061;
	 public $_hrc00_04_061_type='number';
	/**
 	 * 注释:血红蛋白值（g/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_062;
	 public $_hrc00_04_062_type='number';
	/**
 	 * 注释:白细胞计数值(G/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_063;
	 public $_hrc00_04_063_type='number';
	/**
 	 * 注释:血小板计数值(G/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_064;
	 public $_hrc00_04_064_type='number';
	/**
 	 * 注释:尿比重
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_065;
	 public $_hrc00_04_065_type='number';
	/**
 	 * 注释:尿蛋白定性检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_066;
	 public $_hrc00_04_066_type='varchar2';
	/**
 	 * 注释:尿蛋白定量检测值（mg/24h）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_067;
	 public $_hrc00_04_067_type='number';
	/**
 	 * 注释:尿糖定性检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_068;
	 public $_hrc00_04_068_type='varchar2';
	/**
 	 * 注释:尿糖定量检测(mmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_069;
	 public $_hrc00_04_069_type='number';
	/**
 	 * 注释:尿酮体定性检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_070;
	 public $_hrc00_04_070_type='varchar2';
	/**
 	 * 注释:尿液酸碱度
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_071;
	 public $_hrc00_04_071_type='number';
	/**
 	 * 注释:尿潜血检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_04_072;
	 public $_hrc00_04_072_type='varchar2';
	/**
 	 * 注释:粪便潜血标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_04_073;
	 public $_hrc00_04_073_type='number';
}
