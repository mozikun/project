<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_emr11_00 extends dao_oracle{
	 public $__table = 'ws_emr11_00';
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
 	 public $emr11_00_01_001;
	 public $_emr11_00_01_001_type='varchar2';
	/**
 	 * 注释:文档标识-类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr11_00_01_002;
	 public $_emr11_00_01_002_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr11_00_01_003;
	 public $_emr11_00_01_003_type='varchar2';
	/**
 	 * 注释:文档标识-管理机构组织机构代码（法人代码）
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr11_00_01_004;
	 public $_emr11_00_01_004_type='varchar2';
	/**
 	 * 注释:文档标识-号码 
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr11_00_01_005;
	 public $_emr11_00_01_005_type='varchar2';
	/**
 	 * 注释:文档标识-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr11_00_01_006;
	 public $_emr11_00_01_006_type='date';
	/**
 	 * 注释:文档标识-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr11_00_01_007;
	 public $_emr11_00_01_007_type='date';
	/**
 	 * 注释:标识号-类别代码 
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr11_00_01_011;
	 public $_emr11_00_01_011_type='varchar2';
	/**
 	 * 注释:标识号-号码 
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr11_00_01_012;
	 public $_emr11_00_01_012_type='varchar2';
	/**
 	 * 注释:标识号-生效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr11_00_01_013;
	 public $_emr11_00_01_013_type='date';
	/**
 	 * 注释:标识号-失效日期 
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr11_00_01_014;
	 public $_emr11_00_01_014_type='date';
	/**
 	 * 注释:姓名-标识对象*
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emr11_00_01_016;
	 public $_emr11_00_01_016_type='varchar2';
	/**
 	 * 注释:姓名* 
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr11_00_01_018;
	 public $_emr11_00_01_018_type='varchar2';
	/**
 	 * 注释:机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr11_00_01_021;
	 public $_emr11_00_01_021_type='varchar2';
	/**
 	 * 注释:机构组织机构代码
	 * 
	 * 
	 * @var VARCHAR2(66)
	 **/
 	 public $emr11_00_01_022;
	 public $_emr11_00_01_022_type='varchar2';
	/**
 	 * 注释:机构负责人（法人）
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr11_00_01_023;
	 public $_emr11_00_01_023_type='varchar2';
	/**
 	 * 注释:机构地址
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr11_00_01_024;
	 public $_emr11_00_01_024_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr11_00_01_025;
	 public $_emr11_00_01_025_type='varchar2';
	/**
 	 * 注释:机构角色
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $emr11_00_01_026;
	 public $_emr11_00_01_026_type='varchar2';
	/**
 	 * 注释:机构角色代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr11_00_01_027;
	 public $_emr11_00_01_027_type='varchar2';
	/**
 	 * 注释:服务者姓名*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr11_00_01_031;
	 public $_emr11_00_01_031_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr11_00_01_032;
	 public $_emr11_00_01_032_type='varchar2';
	/**
 	 * 注释:服务者职责（角色）代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $emr11_00_01_033;
	 public $_emr11_00_01_033_type='varchar2';
	/**
 	 * 注释:服务者医师资格标志*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr11_00_01_034;
	 public $_emr11_00_01_034_type='varchar2';
	/**
 	 * 注释:服务者学历*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr11_00_01_035;
	 public $_emr11_00_01_035_type='varchar2';
	/**
 	 * 注释:服务者所学专业*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr11_00_01_036;
	 public $_emr11_00_01_036_type='varchar2';
	/**
 	 * 注释:服务者专业技术职称*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr11_00_01_037;
	 public $_emr11_00_01_037_type='varchar2';
	/**
 	 * 注释:服务者职务*
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $emr11_00_01_038;
	 public $_emr11_00_01_038_type='varchar2';
	/**
 	 * 注释:医嘱开嘱日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr11_00_01_041;
	 public $_emr11_00_01_041_type='date';
	/**
 	 * 注释:长期医嘱停嘱日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr11_00_01_042;
	 public $_emr11_00_01_042_type='date';
	/**
 	 * 注释:医嘱执行日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr11_00_01_043;
	 public $_emr11_00_01_043_type='date';
	/**
 	 * 注释:医嘱执行时间类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $emr11_00_01_044;
	 public $_emr11_00_01_044_type='varchar2';
	/**
 	 * 注释:医嘱取消日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $emr11_00_01_045;
	 public $_emr11_00_01_045_type='date';
	/**
 	 * 注释:医嘱类别
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $emr11_00_01_046;
	 public $_emr11_00_01_046_type='varchar2';
	/**
 	 * 注释:医嘱内容
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $emr11_00_01_047;
	 public $_emr11_00_01_047_type='varchar2';
	/**
 	 * 注释:标识号-提供标识的机构名称 
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $emr11_00_01_015;
	 public $_emr11_00_01_015_type='varchar2';
}
