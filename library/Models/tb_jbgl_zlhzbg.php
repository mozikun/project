<?php
require_once ('db_oracle.php');
/**
 *注释:肿瘤病例报告卡
 *
 *
 **/
class Ttb_jbgl_zlhzbg extends dao_oracle{
	 public $__table = 'tb_jbgl_zlhzbg';
	/**
 	 * 注释:报告卡编号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $bgkbh;
	 public $_bgkbh_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:个人标识符
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $jkdabz;
	 public $_jkdabz_type='varchar2';
	/**
 	 * 注释:标识符类型
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $bzflx;
	 public $_bzflx_type='varchar2';
	/**
 	 * 注释:个人保健号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $grbjh;
	 public $_grbjh_type='varchar2';
	/**
 	 * 注释:卡号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $kh;
	 public $_kh_type='varchar2';
	/**
 	 * 注释:卡类型
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $klx;
	 public $_klx_type='varchar2';
	/**
 	 * 注释:证件号码
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $zjhm;
	 public $_zjhm_type='varchar2';
	/**
 	 * 注释:证件类型
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zjlx;
	 public $_zjlx_type='varchar2';
	/**
 	 * 注释:门诊号
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $mzh;
	 public $_mzh_type='varchar2';
	/**
 	 * 注释:住院号
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $zyh;
	 public $_zyh_type='varchar2';
	/**
 	 * 注释:病人姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $xm;
	 public $_xm_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xb;
	 public $_xb_type='char';
	/**
 	 * 注释:民族代码
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $mz;
	 public $_mz_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $csny;
	 public $_csny_type='date';
	/**
 	 * 注释:工种
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zlgz;
	 public $_zlgz_type='varchar2';
	/**
 	 * 注释:职业
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $zlzy;
	 public $_zlzy_type='varchar2';
	/**
 	 * 注释:工作单位
	 * 
	 * 
	 * @var VARCHAR2(70)
	 **/
 	 public $gzdw;
	 public $_gzdw_type='varchar2';
	/**
 	 * 注释:家庭电话
	 * 
	 * 
	 * @var VARCHAR2(24)
	 **/
 	 public $jthm;
	 public $_jthm_type='varchar2';
	/**
 	 * 注释:户口详细地址
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hkxxdz;
	 public $_hkxxdz_type='varchar2';
	/**
 	 * 注释:实住详细地址
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $xzxxdz;
	 public $_xzxxdz_type='varchar2';
	/**
 	 * 注释:病情已告知病人
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $bqygz;
	 public $_bqygz_type='char';
	/**
 	 * 注释:ICD9
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $icd9;
	 public $_icd9_type='varchar2';
	/**
 	 * 注释:ICD10
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $icd10;
	 public $_icd10_type='varchar2';
	/**
 	 * 注释:ICDO
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $icdo;
	 public $_icdo_type='varchar2';
	/**
 	 * 注释:病理学类型
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $blxlx;
	 public $_blxlx_type='varchar2';
	/**
 	 * 注释:病理号
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $blh;
	 public $_blh_type='varchar2';
	/**
 	 * 注释:确诊时肿瘤T分期
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $zdsqbt;
	 public $_zdsqbt_type='varchar2';
	/**
 	 * 注释:确诊时肿瘤N分期
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $zdsqbn;
	 public $_zdsqbn_type='varchar2';
	/**
 	 * 注释:确诊时肿瘤M分期
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $zdsqbm;
	 public $_zdsqbm_type='varchar2';
	/**
 	 * 注释:首次诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $sczdrq;
	 public $_sczdrq_type='date';
	/**
 	 * 注释:诊断根据
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $zdgj;
	 public $_zdgj_type='varchar2';
	/**
 	 * 注释:诊断根据--X射线等
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $zdgjxx;
	 public $_zdgjxx_type='varchar2';
	/**
 	 * 注释:诊断根据--手术/尸检
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zdgjss;
	 public $_zdgjss_type='varchar2';
	/**
 	 * 注释:诊断根据--生化免疫
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zdgjsh;
	 public $_zdgjsh_type='varchar2';
	/**
 	 * 注释:诊断根据--血片/细胞学
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zdgjxb;
	 public $_zdgjxb_type='varchar2';
	/**
 	 * 注释:报告区县编码
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $bgqxbm;
	 public $_bgqxbm_type='varchar2';
	/**
 	 * 注释:报告科室名称
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bgks;
	 public $_bgks_type='varchar2';
	/**
 	 * 注释:报告医师工号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $bgysgh;
	 public $_bgysgh_type='varchar2';
	/**
 	 * 注释:报告医师姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $bgysxm;
	 public $_bgysxm_type='varchar2';
	/**
 	 * 注释:报告日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $bgrq;
	 public $_bgrq_type='date';
	/**
 	 * 注释:录入日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $lrrq;
	 public $_lrrq_type='date';
	/**
 	 * 注释:死亡标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $swbz;
	 public $_swbz_type='char';
	/**
 	 * 注释:死亡日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $swrq;
	 public $_swrq_type='date';
	/**
 	 * 注释:死亡原因
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $swyy;
	 public $_swyy_type='varchar2';
	/**
 	 * 注释:死亡ICD编码
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $swicd;
	 public $_swicd_type='varchar2';
	/**
 	 * 注释:卡状态
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $kzt;
	 public $_kzt_type='char';
	/**
 	 * 注释:删除卡原因
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $scyy;
	 public $_scyy_type='char';
	/**
 	 * 注释:删除卡其他原因
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $scqtyy;
	 public $_scqtyy_type='varchar2';
	/**
 	 * 注释:多部位原发合并
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $dbwyf;
	 public $_dbwyf_type='varchar2';
	/**
 	 * 注释:质控日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $zkrq;
	 public $_zkrq_type='date';
	/**
 	 * 注释:质控状态
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $zlkz;
	 public $_zlkz_type='varchar2';
	/**
 	 * 注释:质控次数
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zkcs;
	 public $_zkcs_type='varchar2';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='varchar2';
	/**
 	 * 注释:预留一
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $yl1;
	 public $_yl1_type='varchar2';
	/**
 	 * 注释:预留二
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $yl2;
	 public $_yl2_type='varchar2';
}
