<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrc00_01 extends dao_oracle{
	 public $__table = 'ws_hrc00_01';
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
 	 * 注释:就诊机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrc00_01_101;
	 public $_hrc00_01_101_type='varchar2';
	/**
 	 * 注释:就诊日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_01_102;
	 public $_hrc00_01_102_type='date';
	/**
 	 * 注释:门诊号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hrc00_01_103;
	 public $_hrc00_01_103_type='varchar2';
	/**
 	 * 注释:就诊患者就医科室名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrc00_01_104;
	 public $_hrc00_01_104_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrc00_01_201;
	 public $_hrc00_01_201_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_01_202;
	 public $_hrc00_01_202_type='date';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_01_203;
	 public $_hrc00_01_203_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_01_204;
	 public $_hrc00_01_204_type='varchar2';
	/**
 	 * 注释:门诊症状-名称
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_01_205;
	 public $_hrc00_01_205_type='number';
	/**
 	 * 注释:门诊症状-诊断代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrc00_01_206;
	 public $_hrc00_01_206_type='varchar2';
	/**
 	 * 注释:疾病诊断名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_01_207;
	 public $_hrc00_01_207_type='varchar2';
	/**
 	 * 注释:疾病诊断代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrc00_01_208;
	 public $_hrc00_01_208_type='varchar2';
	/**
 	 * 注释:发病日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_01_209;
	 public $_hrc00_01_209_type='date';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_01_210;
	 public $_hrc00_01_210_type='date';
	/**
 	 * 注释:检查/检验-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_01_301;
	 public $_hrc00_01_301_type='varchar2';
	/**
 	 * 注释:检查/检验-项目名称
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrc00_01_302;
	 public $_hrc00_01_302_type='varchar2';
	/**
 	 * 注释:检查/检验-结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_01_303;
	 public $_hrc00_01_303_type='varchar2';
	/**
 	 * 注释:检查/检验-结果(定性)
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $hrc00_01_304;
	 public $_hrc00_01_304_type='varchar2';
	/**
 	 * 注释:检查/检验-结果(数值)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_01_305;
	 public $_hrc00_01_305_type='number';
	/**
 	 * 注释:检查/检验-计量单位
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrc00_01_306;
	 public $_hrc00_01_306_type='varchar2';
	/**
 	 * 注释:中药类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_01_401;
	 public $_hrc00_01_401_type='varchar2';
	/**
 	 * 注释:药物类型
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $hrc00_01_402;
	 public $_hrc00_01_402_type='varchar2';
	/**
 	 * 注释:药物名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_01_403;
	 public $_hrc00_01_403_type='varchar2';
	/**
 	 * 注释:药物剂型代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrc00_01_404;
	 public $_hrc00_01_404_type='varchar2';
	/**
 	 * 注释:用药天数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_01_405;
	 public $_hrc00_01_405_type='number';
	/**
 	 * 注释:药物使用-频率
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrc00_01_406;
	 public $_hrc00_01_406_type='varchar2';
	/**
 	 * 注释:药物使用-剂量单位
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrc00_01_407;
	 public $_hrc00_01_407_type='varchar2';
	/**
 	 * 注释:药物使用-次剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_01_408;
	 public $_hrc00_01_408_type='number';
	/**
 	 * 注释:药物使用-总剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_01_409;
	 public $_hrc00_01_409_type='number';
	/**
 	 * 注释:药物使用-途径代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrc00_01_410;
	 public $_hrc00_01_410_type='varchar2';
	/**
 	 * 注释:用药停止日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_01_411;
	 public $_hrc00_01_411_type='date';
	/**
 	 * 注释:手术/操作-名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_01_501;
	 public $_hrc00_01_501_type='varchar2';
	/**
 	 * 注释:手术/操作-代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $hrc00_01_502;
	 public $_hrc00_01_502_type='varchar2';
	/**
 	 * 注释:手术/操作-目标部位名称
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $hrc00_01_503;
	 public $_hrc00_01_503_type='varchar2';
	/**
 	 * 注释:门诊费用-分类
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrc00_01_601;
	 public $_hrc00_01_601_type='varchar2';
	/**
 	 * 注释:门诊费用-分类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrc00_01_602;
	 public $_hrc00_01_602_type='varchar2';
	/**
 	 * 注释:门诊费用-金额（元/人民币）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_01_603;
	 public $_hrc00_01_603_type='number';
	/**
 	 * 注释:门诊费用-支付方式代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrc00_01_604;
	 public $_hrc00_01_604_type='varchar2';
}
