<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hra00_01 extends dao_oracle{
	 public $__table = 'ws_hra00_01';
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
 	 * 注释:卫生事件名称
	 * 
	 * 
	 * @var VARCHAR2(120)
	 **/
 	 public $hra00_01_001;
	 public $_hra00_01_001_type='varchar2';
	/**
 	 * 注释:卫生事件发生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hra00_01_002;
	 public $_hra00_01_002_type='date';
	/**
 	 * 注释:卫生事件发生地点
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hra00_01_003;
	 public $_hra00_01_003_type='varchar2';
	/**
 	 * 注释:健康档案标识符
	 * 
	 * 
	 * @var VARCHAR2(69)
	 **/
 	 public $hra00_01_101;
	 public $_hra00_01_101_type='varchar2';
	/**
 	 * 注释:健康档案管理机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hra00_01_102;
	 public $_hra00_01_102_type='varchar2';
	/**
 	 * 注释:建档日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hra00_01_103;
	 public $_hra00_01_103_type='date';
	/**
 	 * 注释:姓名-标识对象
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hra00_01_201;
	 public $_hra00_01_201_type='varchar2';
	/**
 	 * 注释:姓名-标识对象代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hra00_01_202;
	 public $_hra00_01_202_type='varchar2';
	/**
 	 * 注释:标识号-类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hra00_01_203;
	 public $_hra00_01_203_type='varchar2';
	/**
 	 * 注释:标识号-号码
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hra00_01_204;
	 public $_hra00_01_204_type='varchar2';
	/**
 	 * 注释:标识号-生效日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hra00_01_205;
	 public $_hra00_01_205_type='date';
	/**
 	 * 注释:标识号-失效日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hra00_01_206;
	 public $_hra00_01_206_type='date';
	/**
 	 * 注释:标识号-提供标识的机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hra00_01_207;
	 public $_hra00_01_207_type='varchar2';
	/**
 	 * 注释:常住地址户籍标志
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hra00_01_208;
	 public $_hra00_01_208_type='varchar2';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hra00_01_209;
	 public $_hra00_01_209_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hra00_01_210;
	 public $_hra00_01_210_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hra00_01_211;
	 public $_hra00_01_211_type='varchar2';
	/**
 	 * 注释:电子邮件地址
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hra00_01_212;
	 public $_hra00_01_212_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hra00_01_301;
	 public $_hra00_01_301_type='date';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hra00_01_302;
	 public $_hra00_01_302_type='varchar2';
	/**
 	 * 注释:国籍代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hra00_01_303;
	 public $_hra00_01_303_type='varchar2';
	/**
 	 * 注释:民族代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hra00_01_304;
	 public $_hra00_01_304_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hra00_01_305;
	 public $_hra00_01_305_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hra00_01_306;
	 public $_hra00_01_306_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hra00_01_307;
	 public $_hra00_01_307_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hra00_01_308;
	 public $_hra00_01_308_type='varchar2';
	/**
 	 * 注释:地址-乡（镇、街道办事处）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hra00_01_309;
	 public $_hra00_01_309_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hra00_01_310;
	 public $_hra00_01_310_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hra00_01_311;
	 public $_hra00_01_311_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hra00_01_312;
	 public $_hra00_01_312_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hra00_01_313;
	 public $_hra00_01_313_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hra00_01_314;
	 public $_hra00_01_314_type='varchar2';
	/**
 	 * 注释:参加工作日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hra00_01_315;
	 public $_hra00_01_315_type='date';
	/**
 	 * 注释:职业类别代码(国标)
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hra00_01_316;
	 public $_hra00_01_316_type='varchar2';
	/**
 	 * 注释:文化程度代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hra00_01_317;
	 public $_hra00_01_317_type='varchar2';
	/**
 	 * 注释:医疗保险-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hra00_01_401;
	 public $_hra00_01_401_type='varchar2';
	/**
 	 * 注释:医疗保险-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hra00_01_402;
	 public $_hra00_01_402_type='varchar2';
	/**
 	 * 注释:既往观察-项目名称
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hra00_01_501;
	 public $_hra00_01_501_type='varchar2';
	/**
 	 * 注释:既往观察-项目分类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hra00_01_502;
	 public $_hra00_01_502_type='varchar2';
	/**
 	 * 注释:既往观察-项目代码名称
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $hra00_01_503;
	 public $_hra00_01_503_type='varchar2';
	/**
 	 * 注释:既往观察-项目代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $hra00_01_504;
	 public $_hra00_01_504_type='varchar2';
	/**
 	 * 注释:既往观察-方法代码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hra00_01_505;
	 public $_hra00_01_505_type='varchar2';
	/**
 	 * 注释:既往观察-结果
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $hra00_01_506;
	 public $_hra00_01_506_type='varchar2';
	/**
 	 * 注释:既往观察-结果代码
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hra00_01_507;
	 public $_hra00_01_507_type='varchar2';
	/**
 	 * 注释:观察结果开始（发现）日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hra00_01_508;
	 public $_hra00_01_508_type='date';
	/**
 	 * 注释:观察结果停止(治愈)日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hra00_01_509;
	 public $_hra00_01_509_type='date';
}
