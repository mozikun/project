<?php
require_once ('db_oracle.php');
/**
 *注释:出院小结表
 *
 *
 **/
class Ttb_cis_leavehospital_summary extends dao_oracle{
	 public $__table = 'cis_leavehospital_summary_v';
	/**
 	 * 注释:住院就诊流水号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jzlsh;
	 public $_jzlsh_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(22)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:科室
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $ks;
	 public $_ks_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $ksmc;
	 public $_ksmc_type='varchar2';
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
 	 * 注释:床号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $ch;
	 public $_ch_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $xm;
	 public $_xm_type='varchar2';
	/**
 	 * 注释:性别
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xb;
	 public $_xb_type='char';
	/**
 	 * 注释:年龄
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $nl;
	 public $_nl_type='varchar2';
	/**
 	 * 注释:入院时间
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $rysj;
	 public $_rysj_type='varchar2';
	/**
 	 * 注释:出院时间
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $cysj;
	 public $_cysj_type='varchar2';
	/**
 	 * 注释:住院天数
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $zyts;
	 public $_zyts_type='varchar2';
	/**
 	 * 注释:门诊诊断
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $mzzd;
	 public $_mzzd_type='varchar2';
	/**
 	 * 注释:入院诊断
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $ryzd;
	 public $_ryzd_type='varchar2';
	/**
 	 * 注释:出院诊断
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $cyzd;
	 public $_cyzd_type='varchar2';
	/**
 	 * 注释:入院时主要症状及体征
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $ryzztz;
	 public $_ryzztz_type='varchar2';
	/**
 	 * 注释:实验室检查及主要会诊
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $jchz;
	 public $_jchz_type='varchar2';
	/**
 	 * 注释:住院期间特殊检查
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $tsjc;
	 public $_tsjc_type='varchar2';
	/**
 	 * 注释:诊疗过程
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $zlgc;
	 public $_zlgc_type='varchar2';
	/**
 	 * 注释:合并症
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $hbz;
	 public $_hbz_type='varchar2';
	/**
 	 * 注释:出院时情况
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $cyqk;
	 public $_cyqk_type='varchar2';
	/**
 	 * 注释:出院医嘱
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $cyyz;
	 public $_cyyz_type='varchar2';
	/**
 	 * 注释:治疗结果
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $zljg;
	 public $_zljg_type='varchar2';
	/**
 	 * 注释:主治医师工号
	 * 
	 * 
	 * @var VARCHAR2(36)
	 **/
 	 public $zzysgh;
	 public $_zzysgh_type='varchar2';
	/**
 	 * 注释:主治医师姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $zzysxm;
	 public $_zzysxm_type='varchar2';
	/**
 	 * 注释:住院医师工号
	 * 
	 * 
	 * @var VARCHAR2(36)
	 **/
 	 public $zyysgh;
	 public $_zyysgh_type='varchar2';
	/**
 	 * 注释:住院医师姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $zyysxm;
	 public $_zyysxm_type='varchar2';
	/**
 	 * 注释:医疗机构自填报内容1
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $yyztb1;
	 public $_yyztb1_type='varchar2';
	/**
 	 * 注释:医疗机构自填报内容2
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $yyztb2;
	 public $_yyztb2_type='varchar2';
	/**
 	 * 注释:文件链接
	 * 
	 * 
	 * @var VARCHAR2(256)
	 **/
 	 public $wjlj;
	 public $_wjlj_type='varchar2';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
	/**
 	 * 注释:密级
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
	/**
 	 * 注释:预留一
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl1;
	 public $_ylyl1_type='varchar2';
}
