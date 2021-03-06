<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb03_09 extends dao_oracle{
	 public $__table = 'ws_hrb03_09';
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
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_09_001;
	 public $_hrb03_09_001_type='varchar2';
	/**
 	 * 注释:记录表单编号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_09_002;
	 public $_hrb03_09_002_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_09_003;
	 public $_hrb03_09_003_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb03_09_004;
	 public $_hrb03_09_004_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_09_005;
	 public $_hrb03_09_005_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_09_006;
	 public $_hrb03_09_006_type='date';
	/**
 	 * 注释:职业类别代码(国标)
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb03_09_007;
	 public $_hrb03_09_007_type='varchar2';
	/**
 	 * 注释:文化程度代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_09_008;
	 public $_hrb03_09_008_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_09_009;
	 public $_hrb03_09_009_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_09_010;
	 public $_hrb03_09_010_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_09_011;
	 public $_hrb03_09_011_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_09_012;
	 public $_hrb03_09_012_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_09_014;
	 public $_hrb03_09_014_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_09_015;
	 public $_hrb03_09_015_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb03_09_016;
	 public $_hrb03_09_016_type='varchar2';
	/**
 	 * 注释:就诊机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_09_017;
	 public $_hrb03_09_017_type='varchar2';
	/**
 	 * 注释:就诊日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_09_018;
	 public $_hrb03_09_018_type='date';
	/**
 	 * 注释:伤害发生日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_09_019;
	 public $_hrb03_09_019_type='date';
	/**
 	 * 注释:伤害发生原因代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_09_020;
	 public $_hrb03_09_020_type='varchar2';
	/**
 	 * 注释:伤害发生地点代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_09_021;
	 public $_hrb03_09_021_type='varchar2';
	/**
 	 * 注释:伤害发生时活动类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_09_022;
	 public $_hrb03_09_022_type='varchar2';
	/**
 	 * 注释:伤害意图类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_09_023;
	 public $_hrb03_09_023_type='varchar2';
	/**
 	 * 注释:伤害性质代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_09_024;
	 public $_hrb03_09_024_type='varchar2';
	/**
 	 * 注释:伤害部位代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_09_025;
	 public $_hrb03_09_025_type='varchar2';
	/**
 	 * 注释:临床诊断
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_09_026;
	 public $_hrb03_09_026_type='varchar2';
	/**
 	 * 注释:伤害严重程度代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_09_027;
	 public $_hrb03_09_027_type='varchar2';
	/**
 	 * 注释:伤害转归代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_09_028;
	 public $_hrb03_09_028_type='varchar2';
}
