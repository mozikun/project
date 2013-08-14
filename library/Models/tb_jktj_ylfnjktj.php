<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ttb_jktj_ylfnjktj extends dao_oracle{
	 public $__table = 'tb_jktj_ylfnjktj';
	/**
 	 * 注释:体检ID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $tjid;
	 public $_tjid_type='varchar2';
	/**
 	 * 注释:体检机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:体检机构名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $tjjgmc;
	 public $_tjjgmc_type='varchar2';
	/**
 	 * 注释:个人标识符
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $hzgrdaid;
	 public $_hzgrdaid_type='varchar2';
	/**
 	 * 注释:标识符类型
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $bzflx;
	 public $_bzflx_type='varchar2';
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
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $xm;
	 public $_xm_type='varchar2';
	/**
 	 * 注释:编号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bh;
	 public $_bh_type='varchar2';
	/**
 	 * 注释:是否已婚
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $sfyh;
	 public $_sfyh_type='varchar2';
	/**
 	 * 注释:家庭住址
	 * 
	 * 
	 * @var VARCHAR2(120)
	 **/
 	 public $jtzz;
	 public $_jtzz_type='varchar2';
	/**
 	 * 注释:身份证号
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $sfzh;
	 public $_sfzh_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $csrq;
	 public $_csrq_type='date';
	/**
 	 * 注释:本人电话
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $brdh;
	 public $_brdh_type='varchar2';
	/**
 	 * 注释:联系人姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $lxrxm;
	 public $_lxrxm_type='varchar2';
	/**
 	 * 注释:联系人电话
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $lxrdh;
	 public $_lxrdh_type='varchar2';
	/**
 	 * 注释:体检日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $tjrq;
	 public $_tjrq_type='date';
	/**
 	 * 注释:症状编码
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zzbm;
	 public $_zzbm_type='varchar2';
	/**
 	 * 注释:乳腺情况
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $rxqk;
	 public $_rxqk_type='varchar2';
	/**
 	 * 注释:外阴情况
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $wyqk;
	 public $_wyqk_type='char';
	/**
 	 * 注释:阴道情况
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ydqk;
	 public $_ydqk_type='char';
	/**
 	 * 注释:宫颈情况
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $gjqk;
	 public $_gjqk_type='char';
	/**
 	 * 注释:宫体情况
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $gtqk;
	 public $_gtqk_type='char';
	/**
 	 * 注释:附件情况
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $fjqk;
	 public $_fjqk_type='char';
	/**
 	 * 注释:宫颈碘着色试验
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $gjdzssy;
	 public $_gjdzssy_type='char';
	/**
 	 * 注释:阴道分泌物镜检
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ydfmwjj;
	 public $_ydfmwjj_type='char';
	/**
 	 * 注释:B超（子宫、附件）
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $bcjc;
	 public $_bcjc_type='varchar2';
	/**
 	 * 注释:健康评价
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jkpj;
	 public $_jkpj_type='varchar2';
	/**
 	 * 注释:健康评价异常1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jtpjyc1;
	 public $_jtpjyc1_type='varchar2';
	/**
 	 * 注释:健康评价异常2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jtpjyc2;
	 public $_jtpjyc2_type='varchar2';
	/**
 	 * 注释:健康评价异常3
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jtpjyc3;
	 public $_jtpjyc3_type='varchar2';
	/**
 	 * 注释:健康评价异常4
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jtpjyc4;
	 public $_jtpjyc4_type='varchar2';
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
}
