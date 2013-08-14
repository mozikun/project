<?php
require_once ('db_oracle.php');
/**
 *注释:献血者个人信息表
 *
 *
 **/
class Ttb_xz_donor_information extends dao_oracle{
	 public $__table = 'tb_xz_donor_information';
	/**
 	 * 注释:献血者识别码
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $xxzsbm;
	 public $_xxzsbm_type='varchar2';
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
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
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
 	 * 注释:卡号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $kh;
	 public $_kh_type='varchar2';
	/**
 	 * 注释:0 = 社保卡
1 = 新农合卡
2 = 医疗机构系统内部号（保证唯一）
医疗机构代码 = 自费就诊卡（意指若填写医疗机构代码，则卡类型为医疗机构自费就诊卡）
	9 = 其它
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $klx;
	 public $_klx_type='varchar2';
	/**
 	 * 注释:01 = 居民身份证
	02 = 居民户口簿
	03 = 护照
	04 = 军官证（士兵证）
	05 = 驾驶执照
	99 = 其他
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zjlx;
	 public $_zjlx_type='varchar2';
	/**
 	 * 注释:证件号码
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $zjhm;
	 public $_zjhm_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $csrq;
	 public $_csrq_type='date';
	/**
 	 * 注释:现住地址
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $xzdz;
	 public $_xzdz_type='varchar2';
	/**
 	 * 注释:联系电话
	 * 
	 * 
	 * @var VARCHAR2(24)
	 **/
 	 public $lxdh;
	 public $_lxdh_type='varchar2';
	/**
 	 * 注释:ABO血型
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $abo_xx;
	 public $_abo_xx_type='varchar2';
	/**
 	 * 注释:Rh血型  0.Rh阳性 1.Rh阴性 3.不详
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $rh_xx;
	 public $_rh_xx_type='varchar2';
	/**
 	 * 注释:0：无须病种控制；1：恶性肿瘤；2：性病艾滋病；3：其它不治之症；4.精神类病；9：其它。第二位用于填写本人对本档案是否申明被特控调阅。其中0：无特控；1：患者申明特控（无特殊原因不予调阅）。（目前医疗机构可暂不执行。）其余各位预留备用，可均填0。
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
	/**
 	 * 注释:1：正常、2：修改、3：撤销
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
