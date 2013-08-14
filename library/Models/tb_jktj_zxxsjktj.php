<?php
require_once ('db_oracle.php');
/**
 *注释:中小学在校学生健康体检表
 *
 *
 **/
class Ttb_jktj_zxxsjktj extends dao_oracle{
	 public $__table = 'tb_jktj_zxxsjktj';
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
 	 public $grdaid;
	 public $_grdaid_type='varchar2';
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
 	 * 注释:性别名称
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $xbmc;
	 public $_xbmc_type='varchar2';
	/**
 	 * 注释:性别编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $xbbm;
	 public $_xbbm_type='varchar2';
	/**
 	 * 注释:年龄
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $nl;
	 public $_nl_type='varchar2';
	/**
 	 * 注释:身份证号
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $sfzh;
	 public $_sfzh_type='varchar2';
	/**
 	 * 注释:医保号
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ybh;
	 public $_ybh_type='varchar2';
	/**
 	 * 注释:民族编码
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $mzbm;
	 public $_mzbm_type='varchar2';
	/**
 	 * 注释:民族名称
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $mzmc;
	 public $_mzmc_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $csrq;
	 public $_csrq_type='date';
	/**
 	 * 注释:学校名称
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $xxmc;
	 public $_xxmc_type='varchar2';
	/**
 	 * 注释:班级
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bj;
	 public $_bj_type='varchar2';
	/**
 	 * 注释:家庭地址
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $jtzz;
	 public $_jtzz_type='varchar2';
	/**
 	 * 注释:建表日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jbrq;
	 public $_jbrq_type='date';
	/**
 	 * 注释:体检日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $tjrq;
	 public $_tjrq_type='date';
	/**
 	 * 注释:既往病史编码
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jwbsbm;
	 public $_jwbsbm_type='varchar2';
	/**
 	 * 注释:既往病史名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jwbsmc;
	 public $_jwbsmc_type='varchar2';
	/**
 	 * 注释:一般血压
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $ybxy;
	 public $_ybxy_type='varchar2';
	/**
 	 * 注释:一般心率
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $ybxl;
	 public $_ybxl_type='varchar2';
	/**
 	 * 注释:一般脉率
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $ybml;
	 public $_ybml_type='varchar2';
	/**
 	 * 注释:一般胸围
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $ybxw;
	 public $_ybxw_type='varchar2';
	/**
 	 * 注释:一般腰围
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $ybyw;
	 public $_ybyw_type='varchar2';
	/**
 	 * 注释:一般肺活量
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $ybffl;
	 public $_ybffl_type='varchar2';
	/**
 	 * 注释:一般体重
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $ybtz;
	 public $_ybtz_type='varchar2';
	/**
 	 * 注释:一般身高
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $ybsg;
	 public $_ybsg_type='varchar2';
	/**
 	 * 注释:一般BMI
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $ybbmi;
	 public $_ybbmi_type='varchar2';
	/**
 	 * 注释:内科心
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $nkx;
	 public $_nkx_type='varchar2';
	/**
 	 * 注释:内科肺
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $nkf;
	 public $_nkf_type='varchar2';
	/**
 	 * 注释:内科肝
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $nkg;
	 public $_nkg_type='varchar2';
	/**
 	 * 注释:内科脾
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $nkp;
	 public $_nkp_type='varchar2';
	/**
 	 * 注释:内科医生工号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $nkysgh;
	 public $_nkysgh_type='varchar2';
	/**
 	 * 注释:内科医生签名
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $nkysqm;
	 public $_nkysqm_type='varchar2';
	/**
 	 * 注释:外科身高
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $wksg;
	 public $_wksg_type='number';
	/**
 	 * 注释:外科体重
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $wktz;
	 public $_wktz_type='number';
	/**
 	 * 注释:外科头部
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $wktb;
	 public $_wktb_type='varchar2';
	/**
 	 * 注释:外科颈部
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $wkjb;
	 public $_wkjb_type='varchar2';
	/**
 	 * 注释:外科胸部
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $wkxb;
	 public $_wkxb_type='varchar2';
	/**
 	 * 注释:外科脊柱
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $wkjz;
	 public $_wkjz_type='varchar2';
	/**
 	 * 注释:外科四肢
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $wksz;
	 public $_wksz_type='varchar2';
	/**
 	 * 注释:外科皮肤
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $wkpf;
	 public $_wkpf_type='varchar2';
	/**
 	 * 注释:外科淋巴结
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $wklbj;
	 public $_wklbj_type='varchar2';
	/**
 	 * 注释:外科医生工号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $wkysgh;
	 public $_wkysgh_type='varchar2';
	/**
 	 * 注释:外科医生签名
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $wkysqm;
	 public $_wkysqm_type='varchar2';
	/**
 	 * 注释:五官科裸眼视力左
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $wgklyslz;
	 public $_wgklyslz_type='varchar2';
	/**
 	 * 注释:五官科裸眼视力右
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $wgklysly;
	 public $_wgklysly_type='varchar2';
	/**
 	 * 注释:五官科矫正视力左
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $wgkjzslz;
	 public $_wgkjzslz_type='varchar2';
	/**
 	 * 注释:五官科矫正视力右
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $wgkjzsly;
	 public $_wgkjzsly_type='varchar2';
	/**
 	 * 注释:五官科沙眼
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $wgksy;
	 public $_wgksy_type='varchar2';
	/**
 	 * 注释:五官科结膜炎
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $wgkjmy;
	 public $_wgkjmy_type='varchar2';
	/**
 	 * 注释:五官科耳喉鼻
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $wgkehb;
	 public $_wgkehb_type='varchar2';
	/**
 	 * 注释:五官科医生工号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $wgkysgh;
	 public $_wgkysgh_type='varchar2';
	/**
 	 * 注释:五官科医生签名
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $wgkysqm;
	 public $_wgkysqm_type='varchar2';
	/**
 	 * 注释:口腔科龋齿
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $kqkqc;
	 public $_kqkqc_type='varchar2';
	/**
 	 * 注释:口腔科牙周组织
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $kqkyzzz;
	 public $_kqkyzzz_type='varchar2';
	/**
 	 * 注释:口腔科医生工号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $kqkysgh;
	 public $_kqkysgh_type='varchar2';
	/**
 	 * 注释:口腔科医生签名
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $kqkysqm;
	 public $_kqkysqm_type='varchar2';
	/**
 	 * 注释:实验室结核菌素实验
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $sysjhjssy;
	 public $_sysjhjssy_type='varchar2';
	/**
 	 * 注释:实验室空腹血糖
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $syskfxt;
	 public $_syskfxt_type='varchar2';
	/**
 	 * 注释:实验室随机血糖
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $syssjxt;
	 public $_syssjxt_type='varchar2';
	/**
 	 * 注释:实验室血常规
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $sysxcg;
	 public $_sysxcg_type='varchar2';
	/**
 	 * 注释:实验室尿常规
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $sysncg;
	 public $_sysncg_type='varchar2';
	/**
 	 * 注释:实验室谷丙转氨酶
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $sysgbzam;
	 public $_sysgbzam_type='varchar2';
	/**
 	 * 注释:实验室胆红素
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $sysdhs;
	 public $_sysdhs_type='varchar2';
	/**
 	 * 注释:实验室心电图
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $sysxdt;
	 public $_sysxdt_type='varchar2';
	/**
 	 * 注释:实验室腹部黑白B超
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $syshbbc;
	 public $_syshbbc_type='varchar2';
	/**
 	 * 注释:实验室两对半
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $sysldb;
	 public $_sysldb_type='varchar2';
	/**
 	 * 注释:实验室其他检查
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $sysqtjc;
	 public $_sysqtjc_type='varchar2';
	/**
 	 * 注释:实验室医生工号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sysysgh;
	 public $_sysysgh_type='varchar2';
	/**
 	 * 注释:实验室医生签名
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $sysysqm;
	 public $_sysysqm_type='varchar2';
	/**
 	 * 注释:体检结论
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $tjjl;
	 public $_tjjl_type='varchar2';
	/**
 	 * 注释:体检责任医师工号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $tjysgh;
	 public $_tjysgh_type='varchar2';
	/**
 	 * 注释:体检责任医师姓名
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $tjysxm;
	 public $_tjysxm_type='varchar2';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='varchar2';
	/**
 	 * 注释:密级
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
}
