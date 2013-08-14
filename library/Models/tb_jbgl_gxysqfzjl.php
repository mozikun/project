<?php
require_once ('db_oracle.php');
/**
 *注释:高血压社区分组记录表
 *
 *
 **/
class Ttb_jbgl_gxysqfzjl extends dao_oracle{
	 public $__table = 'tb_jbgl_gxysqfzjl';
	/**
 	 * 注释:高血压分组记录ID
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $fid;
	 public $_fid_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:高血压管理卡ID
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $cid;
	 public $_cid_type='varchar2';
	/**
 	 * 注释:定（转）组日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $dzzrq;
	 public $_dzzrq_type='date';
	/**
 	 * 注释:血压值(收缩压)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xysbp;
	 public $_xysbp_type='number';
	/**
 	 * 注释:血压值(舒张压)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xydbp;
	 public $_xydbp_type='number';
	/**
 	 * 注释:高血压分级
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $gxyfj;
	 public $_gxyfj_type='varchar2';
	/**
 	 * 注释:危险因素
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $wxys;
	 public $_wxys_type='varchar2';
	/**
 	 * 注释:靶器官损害
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $bqgsh;
	 public $_bqgsh_type='varchar2';
	/**
 	 * 注释:并存临床情况
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $bclcqk;
	 public $_bclcqk_type='varchar2';
	/**
 	 * 注释:危险分层
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $wxfc;
	 public $_wxfc_type='varchar2';
	/**
 	 * 注释:血压控制情况
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $xykzqk;
	 public $_xykzqk_type='varchar2';
	/**
 	 * 注释:高血压管理分组
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $gxyglfz;
	 public $_gxyglfz_type='varchar2';
	/**
 	 * 注释:定转组情况
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $dzzqk;
	 public $_dzzqk_type='varchar2';
	/**
 	 * 注释:医师签名
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ysqm;
	 public $_ysqm_type='varchar2';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
	/**
 	 * 注释:上传时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $sbsj;
	 public $_sbsj_type='date';
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
	/**
 	 * 注释:预留二
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl2;
	 public $_ylyl2_type='varchar2';
	/**
 	 * 注释:是否规范管理
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $sfgfgl;
	 public $_sfgfgl_type='varchar2';
}
