<?php
require_once ('db_oracle.php');
/**
 *注释:住院病案首页主体表
 *
 *
 **/
class Ttb_cis_main extends dao_oracle{
	 public $__table = 'tb_cis_main';
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
	 * @var CHAR(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='char';
	/**
 	 * 注释:入院时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $rysj;
	 public $_rysj_type='date';
	/**
 	 * 注释:入院类型（途径）
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $rylx;
	 public $_rylx_type='varchar2';
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
 	 * 注释:保险类型
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bxlx;
	 public $_bxlx_type='varchar2';
	/**
 	 * 注释:住院次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zycs;
	 public $_zycs_type='number';
	/**
 	 * 注释:病案号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $bah;
	 public $_bah_type='varchar2';
	/**
 	 * 注释:床号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $ch;
	 public $_ch_type='varchar2';
	/**
 	 * 注释:入院病区
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $rybq;
	 public $_rybq_type='varchar2';
	/**
 	 * 注释:出院病区
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $cybq;
	 public $_cybq_type='varchar2';
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
 	 * 注释:出生日期
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $csny;
	 public $_csny_type='varchar2';
	/**
 	 * 注释:婚姻状况
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $hyzk;
	 public $_hyzk_type='char';
	/**
 	 * 注释:民族
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $mz;
	 public $_mz_type='varchar2';
	/**
 	 * 注释:国籍
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $gj;
	 public $_gj_type='varchar2';
	/**
 	 * 注释:出生地
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $csd;
	 public $_csd_type='varchar2';
	/**
 	 * 注释:身份证号
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $sfz;
	 public $_sfz_type='varchar2';
	/**
 	 * 注释:联系电话
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $lxdh;
	 public $_lxdh_type='varchar2';
	/**
 	 * 注释:工作单位
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $gzdw;
	 public $_gzdw_type='varchar2';
	/**
 	 * 注释:工作单位邮编
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $gzdwyb;
	 public $_gzdwyb_type='varchar2';
	/**
 	 * 注释:职业
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $zybm;
	 public $_zybm_type='varchar2';
	/**
 	 * 注释:居住地
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $jzd;
	 public $_jzd_type='varchar2';
	/**
 	 * 注释:户口电话
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $hkdh;
	 public $_hkdh_type='varchar2';
	/**
 	 * 注释:地区
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $dqbm;
	 public $_dqbm_type='varchar2';
	/**
 	 * 注释:区县
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $qxbm;
	 public $_qxbm_type='varchar2';
	/**
 	 * 注释:街道
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $jdbm;
	 public $_jdbm_type='varchar2';
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
	 * @var VARCHAR2(4)
	 **/
 	 public $lxrgx;
	 public $_lxrgx_type='varchar2';
	/**
 	 * 注释:联系人电话
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $lxrdh;
	 public $_lxrdh_type='varchar2';
	/**
 	 * 注释:联系人通信地址
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $lxrtxdz;
	 public $_lxrtxdz_type='varchar2';
	/**
 	 * 注释:入院科室编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ryksbm;
	 public $_ryksbm_type='varchar2';
	/**
 	 * 注释:入院科室名称
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ryksmc;
	 public $_ryksmc_type='varchar2';
	/**
 	 * 注释:转科科室编码1
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zkksbm1;
	 public $_zkksbm1_type='varchar2';
	/**
 	 * 注释:转科科室名称1
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zkksmc1;
	 public $_zkksmc1_type='varchar2';
	/**
 	 * 注释:转科科室编码2
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zkksbm2;
	 public $_zkksbm2_type='varchar2';
	/**
 	 * 注释:转科科室名称2
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zkksmc2;
	 public $_zkksmc2_type='varchar2';
	/**
 	 * 注释:转科科室编码3
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zkksbm3;
	 public $_zkksbm3_type='varchar2';
	/**
 	 * 注释:转科科室名称3
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zkksmc3;
	 public $_zkksmc3_type='varchar2';
	/**
 	 * 注释:所转病区
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $szbq;
	 public $_szbq_type='varchar2';
	/**
 	 * 注释:出院时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $cysj;
	 public $_cysj_type='date';
	/**
 	 * 注释:出院科室编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $cyksbm;
	 public $_cyksbm_type='varchar2';
	/**
 	 * 注释:出院科室名称
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $cyksmc;
	 public $_cyksmc_type='varchar2';
	/**
 	 * 注释:实际住院天数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sjzyts;
	 public $_sjzyts_type='number';
	/**
 	 * 注释:出院方式
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $cyfs;
	 public $_cyfs_type='char';
	/**
 	 * 注释:入院时情况
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ryqk;
	 public $_ryqk_type='char';
	/**
 	 * 注释:入院前经外院诊治
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ryqwyzz;
	 public $_ryqwyzz_type='char';
	/**
 	 * 注释:确诊日期
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $qzrq;
	 public $_qzrq_type='varchar2';
	/**
 	 * 注释:医疗机构感染名称
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $yygrmc;
	 public $_yygrmc_type='varchar2';
	/**
 	 * 注释:医疗机构感染结果
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $yygrjg;
	 public $_yygrjg_type='char';
	/**
 	 * 注释:门诊出院诊断符合编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $mzcyzd;
	 public $_mzcyzd_type='char';
	/**
 	 * 注释:入院出院诊断符合编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $rycyzd;
	 public $_rycyzd_type='char';
	/**
 	 * 注释:术前术后诊断符合编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sqshzd;
	 public $_sqshzd_type='char';
	/**
 	 * 注释:临床病理诊断符合编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $lcblzd;
	 public $_lcblzd_type='char';
	/**
 	 * 注释:放射病理诊断符合编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $fsblzd;
	 public $_fsblzd_type='char';
	/**
 	 * 注释:损伤中毒的外部因素
	 * 
	 * 
	 * @var VARCHAR2(256)
	 **/
 	 public $sszd;
	 public $_sszd_type='varchar2';
	/**
 	 * 注释:药物过敏
	 * 
	 * 
	 * @var VARCHAR2(256)
	 **/
 	 public $ywgm;
	 public $_ywgm_type='varchar2';
	/**
 	 * 注释:HBSAG检查结果编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $hbsag_jg;
	 public $_hbsag_jg_type='char';
	/**
 	 * 注释:HCVab检查结果编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $hcvab_jg;
	 public $_hcvab_jg_type='char';
	/**
 	 * 注释:HIVab检查结果编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $hivab_jg;
	 public $_hivab_jg_type='char';
	/**
 	 * 注释:抢救次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $qjcs;
	 public $_qjcs_type='number';
	/**
 	 * 注释:成功次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $cgcs;
	 public $_cgcs_type='number';
	/**
 	 * 注释:住院是否出现危重、急症、疑难
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $sfcxwjn;
	 public $_sfcxwjn_type='varchar2';
	/**
 	 * 注释:手术治疗检查诊断为本院第一例
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $ssdyl;
	 public $_ssdyl_type='varchar2';
	/**
 	 * 注释:血型
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $xx;
	 public $_xx_type='varchar2';
	/**
 	 * 注释:红细胞输血量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hxbsxl;
	 public $_hxbsxl_type='number';
	/**
 	 * 注释:血小板输血量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xxbsxl;
	 public $_xxbsxl_type='number';
	/**
 	 * 注释:血浆输血量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xjsxl;
	 public $_xjsxl_type='number';
	/**
 	 * 注释:全血输血量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $qxsxl;
	 public $_qxsxl_type='number';
	/**
 	 * 注释:其它输血量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $qtsxl;
	 public $_qtsxl_type='number';
	/**
 	 * 注释:有输血反应
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sxfy;
	 public $_sxfy_type='char';
	/**
 	 * 注释:有传染病报告
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $crbbg;
	 public $_crbbg_type='char';
	/**
 	 * 注释:有肿瘤报告
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zlbg;
	 public $_zlbg_type='char';
	/**
 	 * 注释:有新生儿死亡报告
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xsebg;
	 public $_xsebg_type='char';
	/**
 	 * 注释:孕产妇死亡报告
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $swbg;
	 public $_swbg_type='char';
	/**
 	 * 注释:有其它报告
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $qtbg;
	 public $_qtbg_type='char';
	/**
 	 * 注释:是否随诊
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sz;
	 public $_sz_type='char';
	/**
 	 * 注释:随诊期限
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $szqx;
	 public $_szqx_type='number';
	/**
 	 * 注释:随诊期限单位
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $szqxdw;
	 public $_szqxdw_type='char';
	/**
 	 * 注释:是否示教病例
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sjbl;
	 public $_sjbl_type='char';
	/**
 	 * 注释:是否尸检
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sj;
	 public $_sj_type='char';
	/**
 	 * 注释:是否妊娠梅毒筛查
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $rsmdsc;
	 public $_rsmdsc_type='char';
	/**
 	 * 注释:新生儿疾病筛查
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xsejbsc;
	 public $_xsejbsc_type='char';
	/**
 	 * 注释:产后出血量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $chcyl;
	 public $_chcyl_type='number';
	/**
 	 * 注释:新生儿性别
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xse_xb;
	 public $_xse_xb_type='char';
	/**
 	 * 注释:新生儿体重
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xse_tz;
	 public $_xse_tz_type='number';
	/**
 	 * 注释:主任医师工号
	 * 
	 * 
	 * @var VARCHAR2(36)
	 **/
 	 public $zrysgh;
	 public $_zrysgh_type='varchar2';
	/**
 	 * 注释:主任医师姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $zrysxm;
	 public $_zrysxm_type='varchar2';
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
 	 * 注释:护士长工号
	 * 
	 * 
	 * @var VARCHAR2(36)
	 **/
 	 public $hszgh;
	 public $_hszgh_type='varchar2';
	/**
 	 * 注释:护士长姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $hszxm;
	 public $_hszxm_type='varchar2';
	/**
 	 * 注释:病案质量
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $bazl;
	 public $_bazl_type='char';
	/**
 	 * 注释:病理号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $blh;
	 public $_blh_type='varchar2';
	/**
 	 * 注释:死亡根本原因
	 * 
	 * 
	 * @var VARCHAR2(256)
	 **/
 	 public $swgbyy;
	 public $_swgbyy_type='varchar2';
	/**
 	 * 注释:死亡时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $swsj;
	 public $_swsj_type='date';
	/**
 	 * 注释:门诊医师工号
	 * 
	 * 
	 * @var VARCHAR2(36)
	 **/
 	 public $mzysgh;
	 public $_mzysgh_type='varchar2';
	/**
 	 * 注释:门诊医师姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $mzysxm;
	 public $_mzysxm_type='varchar2';
	/**
 	 * 注释:输液反应
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $syfy;
	 public $_syfy_type='char';
	/**
 	 * 注释:是否为科研病案
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sfkyba;
	 public $_sfkyba_type='char';
	/**
 	 * 注释:住院费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zyf;
	 public $_zyf_type='number';
	/**
 	 * 注释:诊疗费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zlf;
	 public $_zlf_type='number';
	/**
 	 * 注释:治疗费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zhf;
	 public $_zhf_type='number';
	/**
 	 * 注释:护理费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hlf;
	 public $_hlf_type='number';
	/**
 	 * 注释:手术材料费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ssclf;
	 public $_ssclf_type='number';
	/**
 	 * 注释:检查费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jcf;
	 public $_jcf_type='number';
	/**
 	 * 注释:化验费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hyf;
	 public $_hyf_type='number';
	/**
 	 * 注释:透视费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tsf;
	 public $_tsf_type='number';
	/**
 	 * 注释:摄片费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $spf;
	 public $_spf_type='number';
	/**
 	 * 注释:输血费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sxf;
	 public $_sxf_type='number';
	/**
 	 * 注释:输氧费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $syf;
	 public $_syf_type='number';
	/**
 	 * 注释:西药费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xyf;
	 public $_xyf_type='number';
	/**
 	 * 注释:中成药费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zcyf;
	 public $_zcyf_type='number';
	/**
 	 * 注释:中草药费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zcaf;
	 public $_zcaf_type='number';
	/**
 	 * 注释:其他费用
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $qtf;
	 public $_qtf_type='number';
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
	/**
 	 * 注释:预留二
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl2;
	 public $_ylyl2_type='varchar2';
}
