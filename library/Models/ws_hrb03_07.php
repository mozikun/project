<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb03_07 extends dao_oracle{
	 public $__table = 'ws_hrb03_07';
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
 	 * 注释:报告卡编码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_07_001;
	 public $_hrb03_07_001_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_07_002;
	 public $_hrb03_07_002_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_07_003;
	 public $_hrb03_07_003_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_07_004;
	 public $_hrb03_07_004_type='date';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_07_005;
	 public $_hrb03_07_005_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb03_07_006;
	 public $_hrb03_07_006_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_07_007;
	 public $_hrb03_07_007_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb03_07_008;
	 public $_hrb03_07_008_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_07_009;
	 public $_hrb03_07_009_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_07_010;
	 public $_hrb03_07_010_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_07_011;
	 public $_hrb03_07_011_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_07_013;
	 public $_hrb03_07_013_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_07_014;
	 public $_hrb03_07_014_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb03_07_015;
	 public $_hrb03_07_015_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_07_016;
	 public $_hrb03_07_016_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_07_017;
	 public $_hrb03_07_017_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_07_018;
	 public $_hrb03_07_018_type='varchar2';
	/**
 	 * 注释:文化程度代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_07_019;
	 public $_hrb03_07_019_type='varchar2';
	/**
 	 * 注释:工作单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_07_020;
	 public $_hrb03_07_020_type='varchar2';
	/**
 	 * 注释:统计工种
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_07_021;
	 public $_hrb03_07_021_type='varchar2';
	/**
 	 * 注释:受照史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_07_022;
	 public $_hrb03_07_022_type='varchar2';
	/**
 	 * 注释:职业照射种类代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_07_023;
	 public $_hrb03_07_023_type='varchar2';
	/**
 	 * 注释:开始从事放射工作日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_07_024;
	 public $_hrb03_07_024_type='date';
	/**
 	 * 注释:开始接尘日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_07_025;
	 public $_hrb03_07_025_type='date';
	/**
 	 * 注释:实际接害工龄（年）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_07_026;
	 public $_hrb03_07_026_type='number';
	/**
 	 * 注释:放射工龄（年）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_07_027;
	 public $_hrb03_07_027_type='number';
	/**
 	 * 注释:累积受照时长（小时/年）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_07_028;
	 public $_hrb03_07_028_type='number';
	/**
 	 * 注释:受照日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_07_029;
	 public $_hrb03_07_029_type='date';
	/**
 	 * 注释:首次出现症状日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_07_030;
	 public $_hrb03_07_030_type='date';
	/**
 	 * 注释:受照剂量（Gy）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_07_031;
	 public $_hrb03_07_031_type='number';
	/**
 	 * 注释:受照类型代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_07_032;
	 public $_hrb03_07_032_type='varchar2';
	/**
 	 * 注释:受照原因代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_07_033;
	 public $_hrb03_07_033_type='varchar2';
	/**
 	 * 注释:职业病种类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_07_034;
	 public $_hrb03_07_034_type='varchar2';
	/**
 	 * 注释:尘肺类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_07_035;
	 public $_hrb03_07_035_type='varchar2';
	/**
 	 * 注释:尘肺期别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_07_036;
	 public $_hrb03_07_036_type='varchar2';
	/**
 	 * 注释:职业病名称代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrb03_07_037;
	 public $_hrb03_07_037_type='varchar2';
	/**
 	 * 注释:职业病伤残等级代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_07_038;
	 public $_hrb03_07_038_type='varchar2';
	/**
 	 * 注释:职业病转归代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_07_039;
	 public $_hrb03_07_039_type='varchar2';
	/**
 	 * 注释:职业性放射性疾病代码
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_07_040;
	 public $_hrb03_07_040_type='varchar2';
	/**
 	 * 注释:放射性疾病的分度代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_07_041;
	 public $_hrb03_07_041_type='varchar2';
	/**
 	 * 注释:放射性疾病的分期代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_07_042;
	 public $_hrb03_07_042_type='varchar2';
	/**
 	 * 注释:尘肺合并肺结核的标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_07_043;
	 public $_hrb03_07_043_type='number';
	/**
 	 * 注释:职业性放射性疾病处理类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_07_044;
	 public $_hrb03_07_044_type='varchar2';
	/**
 	 * 注释:死亡日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_07_045;
	 public $_hrb03_07_045_type='date';
	/**
 	 * 注释:根本死因代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrb03_07_046;
	 public $_hrb03_07_046_type='varchar2';
	/**
 	 * 注释:诊断机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_07_047;
	 public $_hrb03_07_047_type='varchar2';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_07_048;
	 public $_hrb03_07_048_type='date';
	/**
 	 * 注释:诊断医师姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_07_049;
	 public $_hrb03_07_049_type='varchar2';
}
