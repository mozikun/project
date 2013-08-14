<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb03_06 extends dao_oracle{
	 public $__table = 'ws_hrb03_06';
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
 	 * 注释:记录表单编号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_06_001;
	 public $_hrb03_06_001_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_06_002;
	 public $_hrb03_06_002_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_06_003;
	 public $_hrb03_06_003_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_06_004;
	 public $_hrb03_06_004_type='date';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_06_005;
	 public $_hrb03_06_005_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb03_06_006;
	 public $_hrb03_06_006_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_06_007;
	 public $_hrb03_06_007_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_06_008;
	 public $_hrb03_06_008_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_06_009;
	 public $_hrb03_06_009_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_06_010;
	 public $_hrb03_06_010_type='varchar2';
	/**
 	 * 注释:地址-乡（镇、街道办事处）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_06_011;
	 public $_hrb03_06_011_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_06_012;
	 public $_hrb03_06_012_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_06_013;
	 public $_hrb03_06_013_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb03_06_014;
	 public $_hrb03_06_014_type='varchar2';
	/**
 	 * 注释:建档日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_06_015;
	 public $_hrb03_06_015_type='date';
	/**
 	 * 注释:随访日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_06_016;
	 public $_hrb03_06_016_type='date';
	/**
 	 * 注释:年度随访第次
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_017;
	 public $_hrb03_06_017_type='number';
	/**
 	 * 注释:收缩压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_018;
	 public $_hrb03_06_018_type='number';
	/**
 	 * 注释:舒张压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_019;
	 public $_hrb03_06_019_type='number';
	/**
 	 * 注释:脉率（次/分钟）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_020;
	 public $_hrb03_06_020_type='number';
	/**
 	 * 注释:体温（℃）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_021;
	 public $_hrb03_06_021_type='number';
	/**
 	 * 注释:慢性丝虫病病人建档症状代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_06_022;
	 public $_hrb03_06_022_type='varchar2';
	/**
 	 * 注释:慢性丝虫病症状发作部位代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_06_023;
	 public $_hrb03_06_023_type='varchar2';
	/**
 	 * 注释:慢性丝虫病症状发作次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_024;
	 public $_hrb03_06_024_type='number';
	/**
 	 * 注释:慢性丝虫病症状发作开始日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_06_025;
	 public $_hrb03_06_025_type='date';
	/**
 	 * 注释:慢性丝虫病症状发作持续天数（d） 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_026;
	 public $_hrb03_06_026_type='number';
	/**
 	 * 注释:皮肤粗糙标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_027;
	 public $_hrb03_06_027_type='number';
	/**
 	 * 注释:皮肤苔藓样变标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_028;
	 public $_hrb03_06_028_type='number';
	/**
 	 * 注释:凹陷性水肿标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_029;
	 public $_hrb03_06_029_type='number';
	/**
 	 * 注释:溃疡标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_030;
	 public $_hrb03_06_030_type='number';
	/**
 	 * 注释:患肢畸形标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_031;
	 public $_hrb03_06_031_type='number';
	/**
 	 * 注释:下肢淋巴水肿分期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_032;
	 public $_hrb03_06_032_type='number';
	/**
 	 * 注释:慢性丝虫病病人照料形式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_06_033;
	 public $_hrb03_06_033_type='varchar2';
	/**
 	 * 注释:患肢清洗标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_034;
	 public $_hrb03_06_034_type='number';
	/**
 	 * 注释:外用药物防止感染标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_035;
	 public $_hrb03_06_035_type='number';
	/**
 	 * 注释:患肢抬高标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_036;
	 public $_hrb03_06_036_type='number';
	/**
 	 * 注释:患肢锻炼标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_037;
	 public $_hrb03_06_037_type='number';
	/**
 	 * 注释:淋巴管／结炎发作特点代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_06_038;
	 public $_hrb03_06_038_type='varchar2';
	/**
 	 * 注释:淋巴管／结炎发作伴随高热寒战标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_039;
	 public $_hrb03_06_039_type='number';
	/**
 	 * 注释:乳糜尿发作规律特点代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_06_040;
	 public $_hrb03_06_040_type='varchar2';
	/**
 	 * 注释:乳糜尿发作诱因代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_06_041;
	 public $_hrb03_06_041_type='varchar2';
	/**
 	 * 注释:低脂高蛋白饮食标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_042;
	 public $_hrb03_06_042_type='number';
	/**
 	 * 注释:每日饮水量代码（ml）
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_06_043;
	 public $_hrb03_06_043_type='varchar2';
	/**
 	 * 注释:劳作情况代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_06_044;
	 public $_hrb03_06_044_type='varchar2';
	/**
 	 * 注释:登高和剧烈运动标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_045;
	 public $_hrb03_06_045_type='number';
	/**
 	 * 注释:尿液外观
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_06_046;
	 public $_hrb03_06_046_type='varchar2';
	/**
 	 * 注释:排尿困难标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_047;
	 public $_hrb03_06_047_type='number';
	/**
 	 * 注释:乳糜试验结果
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_048;
	 public $_hrb03_06_048_type='number';
	/**
 	 * 注释:鞘膜积液-累及部位代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_06_049;
	 public $_hrb03_06_049_type='varchar2';
	/**
 	 * 注释:鞘膜积液-测量值（cm）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_050;
	 public $_hrb03_06_050_type='number';
	/**
 	 * 注释:压痛试验标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_051;
	 public $_hrb03_06_051_type='number';
	/**
 	 * 注释:透光试验标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_06_052;
	 public $_hrb03_06_052_type='number';
	/**
 	 * 注释:自理能力代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_06_053;
	 public $_hrb03_06_053_type='varchar2';
	/**
 	 * 注释:治疗情况代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_06_054;
	 public $_hrb03_06_054_type='varchar2';
	/**
 	 * 注释:慢性丝虫病转归代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_06_055;
	 public $_hrb03_06_055_type='varchar2';
	/**
 	 * 注释:根本死因代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrb03_06_056;
	 public $_hrb03_06_056_type='varchar2';
	/**
 	 * 注释:填报人姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_06_057;
	 public $_hrb03_06_057_type='varchar2';
	/**
 	 * 注释:填报日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_06_058;
	 public $_hrb03_06_058_type='date';
}
