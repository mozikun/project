<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_emr15_00 extends dao_oracle{
	 public $__table = 'ws_emr15_00';
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
 	 * 注释:工作单位名称 
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr15_00_001;
	 public $_emr15_00_001_type='varchar2';
	/**
 	 * 注释:标识地址类别的代码 
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr15_00_002;
	 public $_emr15_00_002_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr15_00_003;
	 public $_emr15_00_003_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr15_00_004;
	 public $_emr15_00_004_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr15_00_005;
	 public $_emr15_00_005_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr15_00_007;
	 public $_emr15_00_007_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr15_00_008;
	 public $_emr15_00_008_type='varchar2';
	/**
 	 * 注释:邮政编码 
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $emr15_00_009;
	 public $_emr15_00_009_type='varchar2';
	/**
 	 * 注释:行政区划代码 
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $emr15_00_010;
	 public $_emr15_00_010_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr15_00_021;
	 public $_emr15_00_021_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr15_00_022;
	 public $_emr15_00_022_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr15_00_023;
	 public $_emr15_00_023_type='varchar2';
	/**
 	 * 注释:电子邮件地址
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr15_00_024;
	 public $_emr15_00_024_type='varchar2';
	/**
 	 * 注释:机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr15_00_031;
	 public $_emr15_00_031_type='varchar2';
	/**
 	 * 注释:机构组织机构代码
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr15_00_032;
	 public $_emr15_00_032_type='varchar2';
	/**
 	 * 注释:机构负责人（法人）
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr15_00_033;
	 public $_emr15_00_033_type='varchar2';
	/**
 	 * 注释:机构地址
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr15_00_034;
	 public $_emr15_00_034_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr15_00_035;
	 public $_emr15_00_035_type='varchar2';
	/**
 	 * 注释:机构角色
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr15_00_036;
	 public $_emr15_00_036_type='varchar2';
	/**
 	 * 注释:机构角色代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr15_00_037;
	 public $_emr15_00_037_type='varchar2';
	/**
 	 * 注释:服务者姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr15_00_041;
	 public $_emr15_00_041_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr15_00_042;
	 public $_emr15_00_042_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr15_00_043;
	 public $_emr15_00_043_type='varchar2';
	/**
 	 * 注释:服务者医师资格标志
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr15_00_044;
	 public $_emr15_00_044_type='varchar2';
	/**
 	 * 注释:服务者学历
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr15_00_045;
	 public $_emr15_00_045_type='varchar2';
	/**
 	 * 注释:服务者所学专业
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr15_00_046;
	 public $_emr15_00_046_type='varchar2';
	/**
 	 * 注释:服务者专业技术职称
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr15_00_047;
	 public $_emr15_00_047_type='varchar2';
	/**
 	 * 注释:服务者职务
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr15_00_048;
	 public $_emr15_00_048_type='varchar2';
}
