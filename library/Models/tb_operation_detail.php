<?php
require_once ('db_oracle.php');
/**
 *注释:手术明细表
 *
 *
 **/
class Ttb_operation_detail extends dao_oracle{
	 public $__table = 'tb_operation_detail';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:手术明细流水号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $ssmxlsh;
	 public $_ssmxlsh_type='varchar2';
	/**
 	 * 注释:卡号
	 * 
	 * 
	 * @var VARCHAR2(40)
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
 	 * 注释:就诊流水号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jzlsh;
	 public $_jzlsh_type='varchar2';
	/**
 	 * 注释:门诊/住院标志
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $mzzybz;
	 public $_mzzybz_type='varchar2';
	/**
 	 * 注释:日间手术标志
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $rjssbz;
	 public $_rjssbz_type='varchar2';
	/**
 	 * 注释:手术类型
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $sslx;
	 public $_sslx_type='varchar2';
	/**
 	 * 注释:手术操作编码
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ssczbm;
	 public $_ssczbm_type='varchar2';
	/**
 	 * 注释:手术操作名称
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $ssczmc;
	 public $_ssczmc_type='varchar2';
	/**
 	 * 注释:手术前诊断
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ssqzd;
	 public $_ssqzd_type='varchar2';
	/**
 	 * 注释:手术后诊断
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $sshzd;
	 public $_sshzd_type='varchar2';
	/**
 	 * 注释:手术起始时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $sskssj;
	 public $_sskssj_type='date';
	/**
 	 * 注释:手术结束时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $ssjssj;
	 public $_ssjssj_type='date';
	/**
 	 * 注释:手术医生工号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $ssysgh;
	 public $_ssysgh_type='varchar2';
	/**
 	 * 注释:手术医生姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $ssysxm;
	 public $_ssysxm_type='varchar2';
	/**
 	 * 注释:手术医生I助工号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $ssysz1gh;
	 public $_ssysz1gh_type='varchar2';
	/**
 	 * 注释:手术医生I助姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $ssysz1xm;
	 public $_ssysz1xm_type='varchar2';
	/**
 	 * 注释:手术医生II助工号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $ssysz2gh;
	 public $_ssysz2gh_type='varchar2';
	/**
 	 * 注释:手术医生II助姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $ssysz2xm;
	 public $_ssysz2xm_type='varchar2';
	/**
 	 * 注释:麻醉医师工号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mzysgh;
	 public $_mzysgh_type='varchar2';
	/**
 	 * 注释:麻醉医师姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $mzysxm;
	 public $_mzysxm_type='varchar2';
	/**
 	 * 注释:麻醉方式编码
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $mzfs;
	 public $_mzfs_type='varchar2';
	/**
 	 * 注释:切口愈合等级编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $qkyhdj;
	 public $_qkyhdj_type='char';
	/**
 	 * 注释:密级
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
	/**
 	 * 注释:预留一
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl1;
	 public $_ylyl1_type='varchar2';
}
