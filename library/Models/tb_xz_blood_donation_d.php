<?php
require_once ('db_oracle.php');
/**
 *注释:献血过程信息表
 *
 *
 **/
class Ttb_xz_blood_donation_d extends dao_oracle{
	 public $__table = 'tb_xz_blood_donation_d';
	/**
 	 * 注释:献血序列号
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $xxxlh;
	 public $_xxxlh_type='varchar2';
	/**
 	 * 注释:血站机构代码
	 * 
	 * 
	 * @var VARCHAR2(22)
	 **/
 	 public $xzjgdm;
	 public $_xzjgdm_type='varchar2';
	/**
 	 * 注释:血站名称
	 * 
	 * 
	 * @var VARCHAR2(70)
	 **/
 	 public $xzmc;
	 public $_xzmc_type='varchar2';
	/**
 	 * 注释:外键，关联到《献血者个人信息表》
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $xxzsbm;
	 public $_xxzsbm_type='varchar2';
	/**
 	 * 注释:1 有尝献血 2 无尝献血 3 其它
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xxlx;
	 public $_xxlx_type='char';
	/**
 	 * 注释:采血类型 1.全血、2.单采
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $cxlx;
	 public $_cxlx_type='char';
	/**
 	 * 注释:采血量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $cxl;
	 public $_cxl_type='number';
	/**
 	 * 注释:采血地址
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $cxdz;
	 public $_cxdz_type='varchar2';
	/**
 	 * 注释:采血日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $cxrq;
	 public $_cxrq_type='date';
	/**
 	 * 注释:ABO血型
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $abo_xx;
	 public $_abo_xx_type='char';
	/**
 	 * 注释:Rh血型 0.Rh阳性 1.Rh阴性 3.不详
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $rh_xx;
	 public $_rh_xx_type='char';
	/**
 	 * 注释:检验结论  1.合格、2.不合格
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $jyjl;
	 public $_jyjl_type='char';
	/**
 	 * 注释:0：无须病种控制；1：恶性肿瘤；2：性病艾滋病；3：其它不治之症；4.精神类病；9：其它。第二位用于填写本人对本档案是否申明被特控调阅。其中0：无特控；1：患者申明特控（无特殊原因不予调阅）。（目前医疗机构可暂不执行。）其余各位预留备用，可均填0。
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
	/**
 	 * 注释:1：正常、2：修改、3：撤销；
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
	/**
 	 * 注释:预留1
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
