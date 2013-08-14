<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrc00_03 extends dao_oracle{
	 public $__table = 'ws_hrc00_03';
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
 	 * 注释:住院机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrc00_03_101;
	 public $_hrc00_03_101_type='varchar2';
	/**
 	 * 注释:入院日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_03_102;
	 public $_hrc00_03_102_type='date';
	/**
 	 * 注释:住院患者住院次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_03_103;
	 public $_hrc00_03_103_type='number';
	/**
 	 * 注释:病案号
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrc00_03_104;
	 public $_hrc00_03_104_type='varchar2';
	/**
 	 * 注释:住院患者入院科室名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_03_105;
	 public $_hrc00_03_105_type='varchar2';
	/**
 	 * 注释:住院患者入院病情
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_03_106;
	 public $_hrc00_03_106_type='varchar2';
	/**
 	 * 注释:住院患者转科科室名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_03_107;
	 public $_hrc00_03_107_type='varchar2';
	/**
 	 * 注释:住院患者过敏源
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrc00_03_108;
	 public $_hrc00_03_108_type='varchar2';
	/**
 	 * 注释:住院患者过敏症状出现日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_03_109;
	 public $_hrc00_03_109_type='date';
	/**
 	 * 注释:住院患者医院感染名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_03_201;
	 public $_hrc00_03_201_type='varchar2';
	/**
 	 * 注释:住院患者损伤和中毒外部原因
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrc00_03_202;
	 public $_hrc00_03_202_type='varchar2';
	/**
 	 * 注释:住院患者血清学检查项目代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrc00_03_203;
	 public $_hrc00_03_203_type='varchar2';
	/**
 	 * 注释:住院患者血清学检查结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_03_204;
	 public $_hrc00_03_204_type='varchar2';
	/**
 	 * 注释:疾病诊断名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_03_205;
	 public $_hrc00_03_205_type='varchar2';
	/**
 	 * 注释:疾病诊断代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrc00_03_206;
	 public $_hrc00_03_206_type='varchar2';
	/**
 	 * 注释:确诊日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_03_207;
	 public $_hrc00_03_207_type='date';
	/**
 	 * 注释:患者疾病诊断对照
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrc00_03_208;
	 public $_hrc00_03_208_type='varchar2';
	/**
 	 * 注释:住院患者疾病诊断对照代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_03_209;
	 public $_hrc00_03_209_type='varchar2';
	/**
 	 * 注释:住院患者诊断符合情况-详细描述
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrc00_03_210;
	 public $_hrc00_03_210_type='varchar2';
	/**
 	 * 注释:住院患者诊断符合情况-代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_03_211;
	 public $_hrc00_03_211_type='varchar2';
	/**
 	 * 注释:住院患者疾病诊断类型-详细描述
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrc00_03_212;
	 public $_hrc00_03_212_type='varchar2';
	/**
 	 * 注释:住院患者疾病诊断类型-代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrc00_03_213;
	 public $_hrc00_03_213_type='varchar2';
	/**
 	 * 注释:手术/操作-名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_03_301;
	 public $_hrc00_03_301_type='varchar2';
	/**
 	 * 注释:手术/操作-代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $hrc00_03_302;
	 public $_hrc00_03_302_type='varchar2';
	/**
 	 * 注释:手术/操作-目标部位名称
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $hrc00_03_303;
	 public $_hrc00_03_303_type='varchar2';
	/**
 	 * 注释:麻醉-方法
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_03_304;
	 public $_hrc00_03_304_type='varchar2';
	/**
 	 * 注释:住院期间输血品种代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_03_307;
	 public $_hrc00_03_307_type='varchar2';
	/**
 	 * 注释:住院期间输血量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_03_308;
	 public $_hrc00_03_308_type='number';
	/**
 	 * 注释:住院患者输血量计量单位
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hrc00_03_309;
	 public $_hrc00_03_309_type='varchar2';
	/**
 	 * 注释:住院患者抢救次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_03_311;
	 public $_hrc00_03_311_type='number';
	/**
 	 * 注释:住院患者抢救成功次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_03_312;
	 public $_hrc00_03_312_type='number';
	/**
 	 * 注释:住院患者治疗结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_03_401;
	 public $_hrc00_03_401_type='varchar2';
	/**
 	 * 注释:出院日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_03_402;
	 public $_hrc00_03_402_type='date';
	/**
 	 * 注释:住院患者出院科室名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_03_403;
	 public $_hrc00_03_403_type='varchar2';
	/**
 	 * 注释:住院患者住院天数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_03_404;
	 public $_hrc00_03_404_type='number';
	/**
 	 * 注释:住院患者尸检标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_03_405;
	 public $_hrc00_03_405_type='number';
	/**
 	 * 注释:住院患者随诊标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_03_406;
	 public $_hrc00_03_406_type='number';
	/**
 	 * 注释:住院费用-分类
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrc00_03_501;
	 public $_hrc00_03_501_type='varchar2';
	/**
 	 * 注释:住院费用-分类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrc00_03_502;
	 public $_hrc00_03_502_type='varchar2';
	/**
 	 * 注释:住院费用-金额（元/人民币）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_03_503;
	 public $_hrc00_03_503_type='number';
	/**
 	 * 注释:住院费用-医疗付款方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_03_504;
	 public $_hrc00_03_504_type='varchar2';
	/**
 	 * 注释:相关医生角色名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrc00_03_601;
	 public $_hrc00_03_601_type='varchar2';
	/**
 	 * 注释:相关医生姓名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrc00_03_602;
	 public $_hrc00_03_602_type='varchar2';
	/**
 	 * 注释:住院患者示教病例标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_03_603;
	 public $_hrc00_03_603_type='number';
	/**
 	 * 注释:住院病例病案质量代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_03_604;
	 public $_hrc00_03_604_type='varchar2';
}
