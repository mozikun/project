<?php
require_once ('db_oracle.php');
/**
 *注释:患者信息表
 *
 *
 **/
class Ttb_yl_patient_information extends dao_oracle{
	 public $__table = 'tb_yl_patient_information';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:卡号
	 * 
	 * 
	 * @var VARCHAR2(32)
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
 	 * 注释:发卡地区
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $fkdq;
	 public $_fkdq_type='varchar2';
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
 	 * 注释:性别
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xb;
	 public $_xb_type='char';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $xm;
	 public $_xm_type='varchar2';
	/**
 	 * 注释:患者类型
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $hzlx;
	 public $_hzlx_type='varchar2';
	/**
 	 * 注释:婚姻状况
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $hyzk;
	 public $_hyzk_type='char';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $csrq;
	 public $_csrq_type='varchar2';
	/**
 	 * 注释:出生地
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $csd;
	 public $_csd_type='varchar2';
	/**
 	 * 注释:民族
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $mz;
	 public $_mz_type='varchar2';
	/**
 	 * 注释:国籍
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $gj;
	 public $_gj_type='varchar2';
	/**
 	 * 注释:电话号码
	 * 
	 * 
	 * @var VARCHAR2(24)
	 **/
 	 public $dhhm;
	 public $_dhhm_type='varchar2';
	/**
 	 * 注释:手机号码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sjhm;
	 public $_sjhm_type='varchar2';
	/**
 	 * 注释:工作单位邮编
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $gzdwyb;
	 public $_gzdwyb_type='varchar2';
	/**
 	 * 注释:工作单位名称
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $gzdwmc;
	 public $_gzdwmc_type='varchar2';
	/**
 	 * 注释:工作单位地址
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $gzdwdz;
	 public $_gzdwdz_type='varchar2';
	/**
 	 * 注释:居住地址
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $jzdz;
	 public $_jzdz_type='varchar2';
	/**
 	 * 注释:户口地址
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $hkdz;
	 public $_hkdz_type='varchar2';
	/**
 	 * 注释:户口地址邮编
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hkdzyb;
	 public $_hkdzyb_type='varchar2';
	/**
 	 * 注释:联系人姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $lxrxm;
	 public $_lxrxm_type='varchar2';
	/**
 	 * 注释:联系人关系
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $lxrgx;
	 public $_lxrgx_type='varchar2';
	/**
 	 * 注释:联系人地址
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $lxrdz;
	 public $_lxrdz_type='varchar2';
	/**
 	 * 注释:联系人邮编
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $lxryb;
	 public $_lxryb_type='varchar2';
	/**
 	 * 注释:联系人电话
	 * 
	 * 
	 * @var VARCHAR2(24)
	 **/
 	 public $lxrdh;
	 public $_lxrdh_type='varchar2';
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
 	 * 注释:数据生成时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $ywscsj;
	 public $_ywscsj_type='date';
	/**
 	 * 注释:医疗机构内部档案号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $yydah;
	 public $_yydah_type='varchar2';
	/**
 	 * 注释:预留一
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl1;
	 public $_ylyl1_type='varchar2';
	/**
 	 * 注释:预留二
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl2;
	 public $_ylyl2_type='varchar2';
	/**
 	 * 注释:患者身份证号码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $identity_number;
	 public $_identity_number_type='varchar2';
}
