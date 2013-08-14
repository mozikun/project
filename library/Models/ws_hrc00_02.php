<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrc00_02 extends dao_oracle{
	 public $__table = 'ws_hrc00_02';
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
 	 * 注释:手术/操作-目标部位名称
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $hrc00_02_303;
	 public $_hrc00_02_303_type='varchar2';
	/**
 	 * 注释:住院机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrc00_02_101;
	 public $_hrc00_02_101_type='varchar2';
	/**
 	 * 注释:入院日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_02_102;
	 public $_hrc00_02_102_type='date';
	/**
 	 * 注释:住院原因
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_02_103;
	 public $_hrc00_02_103_type='varchar2';
	/**
 	 * 注释:病案号
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrc00_02_104;
	 public $_hrc00_02_104_type='varchar2';
	/**
 	 * 注释:住院患者入院科室名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_02_105;
	 public $_hrc00_02_105_type='varchar2';
	/**
 	 * 注释:住院症状-名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_02_106;
	 public $_hrc00_02_106_type='varchar2';
	/**
 	 * 注释:住院症状-代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrc00_02_107;
	 public $_hrc00_02_107_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrc00_02_108;
	 public $_hrc00_02_108_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_02_109;
	 public $_hrc00_02_109_type='date';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_02_110;
	 public $_hrc00_02_110_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_02_111;
	 public $_hrc00_02_111_type='varchar2';
	/**
 	 * 注释:住院患者入院诊断-名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_02_201;
	 public $_hrc00_02_201_type='varchar2';
	/**
 	 * 注释:住院患者入院诊断-代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrc00_02_202;
	 public $_hrc00_02_202_type='varchar2';
	/**
 	 * 注释:住院患者传染性标识
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_02_203;
	 public $_hrc00_02_203_type='number';
	/**
 	 * 注释:住院患者疾病状态
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_02_204;
	 public $_hrc00_02_204_type='varchar2';
	/**
 	 * 注释:发病日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_02_205;
	 public $_hrc00_02_205_type='date';
	/**
 	 * 注释:确诊日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_02_206;
	 public $_hrc00_02_206_type='date';
	/**
 	 * 注释:检查/检验-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_02_207;
	 public $_hrc00_02_207_type='varchar2';
	/**
 	 * 注释:检查/检验-项目名称
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrc00_02_208;
	 public $_hrc00_02_208_type='varchar2';
	/**
 	 * 注释:检查/检验-结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_02_209;
	 public $_hrc00_02_209_type='varchar2';
	/**
 	 * 注释:检查/检验-结果(定性)
	 * 
	 * 
	 * @var VARCHAR2(600)
	 **/
 	 public $hrc00_02_210;
	 public $_hrc00_02_210_type='varchar2';
	/**
 	 * 注释:检查/检验-结果(数值)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_02_211;
	 public $_hrc00_02_211_type='number';
	/**
 	 * 注释:检查/检验-计量单位
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrc00_02_212;
	 public $_hrc00_02_212_type='varchar2';
	/**
 	 * 注释:检查/检验-项目代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_02_213;
	 public $_hrc00_02_213_type='varchar2';
	/**
 	 * 注释:中药类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_02_214;
	 public $_hrc00_02_214_type='varchar2';
	/**
 	 * 注释:药物类型
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $hrc00_02_215;
	 public $_hrc00_02_215_type='varchar2';
	/**
 	 * 注释:药物名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_02_216;
	 public $_hrc00_02_216_type='varchar2';
	/**
 	 * 注释:药物剂型代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrc00_02_217;
	 public $_hrc00_02_217_type='varchar2';
	/**
 	 * 注释:用药天数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_02_218;
	 public $_hrc00_02_218_type='number';
	/**
 	 * 注释:药物使用-频率
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrc00_02_219;
	 public $_hrc00_02_219_type='varchar2';
	/**
 	 * 注释:药物使用-剂量单位
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrc00_02_220;
	 public $_hrc00_02_220_type='varchar2';
	/**
 	 * 注释:药物使用-次剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_02_221;
	 public $_hrc00_02_221_type='number';
	/**
 	 * 注释:药物使用-总剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_02_222;
	 public $_hrc00_02_222_type='number';
	/**
 	 * 注释:药物使用-途径代码
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrc00_02_223;
	 public $_hrc00_02_223_type='varchar2';
	/**
 	 * 注释:用药停止日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_02_224;
	 public $_hrc00_02_224_type='date';
	/**
 	 * 注释:手术/操作-名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_02_301;
	 public $_hrc00_02_301_type='varchar2';
	/**
 	 * 注释:手术/操作-代码
	 * 
	 * 
	 * @var VARCHAR2(180)
	 **/
 	 public $hrc00_02_302;
	 public $_hrc00_02_302_type='varchar2';
	/**
 	 * 注释:手术日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_02_304;
	 public $_hrc00_02_304_type='date';
	/**
 	 * 注释:麻醉-方法
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_02_305;
	 public $_hrc00_02_305_type='varchar2';
	/**
 	 * 注释:住院患者出院诊断-名称
	 * 
	 * 
	 * @var VARCHAR2(150)
	 **/
 	 public $hrc00_02_307;
	 public $_hrc00_02_307_type='varchar2';
	/**
 	 * 注释:住院患者出院诊断-代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_02_308;
	 public $_hrc00_02_308_type='varchar2';
	/**
 	 * 注释:住院患者治疗结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_02_401;
	 public $_hrc00_02_401_type='varchar2';
	/**
 	 * 注释:出院日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_02_402;
	 public $_hrc00_02_402_type='date';
	/**
 	 * 注释:根本死因代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrc00_02_403;
	 public $_hrc00_02_403_type='varchar2';
	/**
 	 * 注释:死亡日期时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrc00_02_404;
	 public $_hrc00_02_404_type='date';
	/**
 	 * 注释:住院费用-分类
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrc00_02_501;
	 public $_hrc00_02_501_type='varchar2';
	/**
 	 * 注释:住院费用-分类代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrc00_02_502;
	 public $_hrc00_02_502_type='varchar2';
	/**
 	 * 注释:住院费用-金额（元/人民币）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrc00_02_503;
	 public $_hrc00_02_503_type='number';
	/**
 	 * 注释:住院费用-医疗付款方式代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrc00_02_504;
	 public $_hrc00_02_504_type='varchar2';
}
