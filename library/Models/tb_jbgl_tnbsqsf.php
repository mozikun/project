<?php
require_once ('db_oracle.php');
/**
 *注释:糖尿病社区随访表
 *
 *
 **/
class Ttb_jbgl_tnbsqsf extends dao_oracle{
	 public $__table = 'tb_jbgl_tnbsqsf';
	/**
 	 * 注释:随访记录ID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $sfjlid;
	 public $_sfjlid_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:糖尿病管理卡ID
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $bgkbh;
	 public $_bgkbh_type='varchar2';
	/**
 	 * 注释:随访编号
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $sfbh;
	 public $_sfbh_type='varchar2';
	/**
 	 * 注释:分组类型
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $fzlx;
	 public $_fzlx_type='varchar2';
	/**
 	 * 注释:随访记录日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $sfrq;
	 public $_sfrq_type='date';
	/**
 	 * 注释:随访方式代码
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $sffsdm;
	 public $_sffsdm_type='varchar2';
	/**
 	 * 注释:下次随访日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $xcsfrq;
	 public $_xcsfrq_type='date';
	/**
 	 * 注释:转归情况
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zg;
	 public $_zg_type='varchar2';
	/**
 	 * 注释:迁出地址
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $qcdz;
	 public $_qcdz_type='varchar2';
	/**
 	 * 注释:失访原因
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $sfyy;
	 public $_sfyy_type='varchar2';
	/**
 	 * 注释:转归其它
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $zgqt;
	 public $_zgqt_type='varchar2';
	/**
 	 * 注释:病例种类
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $blzl;
	 public $_blzl_type='varchar2';
	/**
 	 * 注释:是否发生转型
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $sfzx;
	 public $_sfzx_type='varchar2';
	/**
 	 * 注释:临床状态(症状)
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $lczt;
	 public $_lczt_type='varchar2';
	/**
 	 * 注释:其他临床状态
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $qtclxtgl;
	 public $_qtclxtgl_type='varchar2';
	/**
 	 * 注释:测量血糖规律
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $clxtgl;
	 public $_clxtgl_type='varchar2';
	/**
 	 * 注释:酮症酸中毒情况及诊断年数
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jbfzns1;
	 public $_jbfzns1_type='varchar2';
	/**
 	 * 注释:乳酸性酸中毒情况及诊断年数
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jbfzns2;
	 public $_jbfzns2_type='varchar2';
	/**
 	 * 注释:非酮症高渗综合症情况及诊断年数
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jbfzns3;
	 public $_jbfzns3_type='varchar2';
	/**
 	 * 注释:低血糖性昏迷情况及诊断年数
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jbfzns4;
	 public $_jbfzns4_type='varchar2';
	/**
 	 * 注释:视网膜病变情况及诊断年数
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mbfzns1;
	 public $_mbfzns1_type='varchar2';
	/**
 	 * 注释:糖尿病足情况及诊断年数
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mbfzns2;
	 public $_mbfzns2_type='varchar2';
	/**
 	 * 注释:糖尿病肾病情况及诊断年数
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mbfzns3;
	 public $_mbfzns3_type='varchar2';
	/**
 	 * 注释:冠心病（心肌梗死）情况及诊断年数
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mbfzns4;
	 public $_mbfzns4_type='varchar2';
	/**
 	 * 注释:大血管病变情况及诊断年数
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mbfzns5;
	 public $_mbfzns5_type='varchar2';
	/**
 	 * 注释:周围神经病变情况及诊断年数
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mbfzns6;
	 public $_mbfzns6_type='varchar2';
	/**
 	 * 注释:皮肤感染情况及诊断年数
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mbfzns7;
	 public $_mbfzns7_type='varchar2';
	/**
 	 * 注释:收缩压
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $dbp;
	 public $_dbp_type='number';
	/**
 	 * 注释:舒张压
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sbp;
	 public $_sbp_type='number';
	/**
 	 * 注释:身高(cm)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sg;
	 public $_sg_type='number';
	/**
 	 * 注释:体重
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tz;
	 public $_tz_type='number';
	/**
 	 * 注释:腰围
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $yw;
	 public $_yw_type='number';
	/**
 	 * 注释:臀围
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tw;
	 public $_tw_type='number';
	/**
 	 * 注释:足背动脉搏动
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zbdmbd;
	 public $_zbdmbd_type='char';
	/**
 	 * 注释:体征其他
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $tzqt;
	 public $_tzqt_type='varchar2';
	/**
 	 * 注释:眼底检查
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $ydjc;
	 public $_ydjc_type='varchar2';
	/**
 	 * 注释:服药依从性
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $fyzl;
	 public $_fyzl_type='varchar2';
	/**
 	 * 注释:药物不良反应
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ywblfy;
	 public $_ywblfy_type='char';
	/**
 	 * 注释:低血糖反应
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $dxtfy;
	 public $_dxtfy_type='char';
	/**
 	 * 注释:此次随访分类
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ccsffl;
	 public $_ccsffl_type='char';
	/**
 	 * 注释:用药种类
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $yyzl;
	 public $_yyzl_type='varchar2';
	/**
 	 * 注释:目前服药药物名称1
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $mqfyywmc1;
	 public $_mqfyywmc1_type='varchar2';
	/**
 	 * 注释:目前服药药物用法1
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $mqfyywyf1;
	 public $_mqfyywyf1_type='varchar2';
	/**
 	 * 注释:目前服药药物名称2
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $mqfyywmc2;
	 public $_mqfyywmc2_type='varchar2';
	/**
 	 * 注释:目前服药药物用法2
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $mqfyywyf2;
	 public $_mqfyywyf2_type='varchar2';
	/**
 	 * 注释:目前服药药物名称3
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $mqfyywmc3;
	 public $_mqfyywmc3_type='varchar2';
	/**
 	 * 注释:目前服药药物用法3
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $mqfyywyf3;
	 public $_mqfyywyf3_type='varchar2';
	/**
 	 * 注释:其他服药药物名称
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $qtfyywymc;
	 public $_qtfyywymc_type='varchar2';
	/**
 	 * 注释:其他服药药物用法
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $qtfyywyf;
	 public $_qtfyywyf_type='varchar2';
	/**
 	 * 注释:胰岛素
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $yds;
	 public $_yds_type='varchar2';
	/**
 	 * 注释:用药种类其它
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $yyzlqt;
	 public $_yyzlqt_type='varchar2';
	/**
 	 * 注释:休闲时体力活动
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $xxstyhd;
	 public $_xxstyhd_type='varchar2';
	/**
 	 * 注释:休闲活动时间
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $xxstyhdsj;
	 public $_xxstyhdsj_type='varchar2';
	/**
 	 * 注释:日吸烟量(支)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $yl;
	 public $_yl_type='number';
	/**
 	 * 注释:日饮酒量(两)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jl;
	 public $_jl_type='number';
	/**
 	 * 注释:运动方式说明
	 * 
	 * 
	 * @var VARCHAR2(256)
	 **/
 	 public $ydfssm;
	 public $_ydfssm_type='varchar2';
	/**
 	 * 注释:运动频率类别代码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ydpllb;
	 public $_ydpllb_type='char';
	/**
 	 * 注释:运动时间(min)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ydsj;
	 public $_ydsj_type='number';
	/**
 	 * 注释:坚持运动时长(年)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jcydsc;
	 public $_jcydsc_type='number';
	/**
 	 * 注释:周运动次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zydcs;
	 public $_zydcs_type='number';
	/**
 	 * 注释:精神状况
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jszk;
	 public $_jszk_type='varchar2';
	/**
 	 * 注释:饮食状况
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $yszk;
	 public $_yszk_type='varchar2';
	/**
 	 * 注释:主食情况
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $zsqk;
	 public $_zsqk_type='varchar2';
	/**
 	 * 注释:心理调整
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xltz;
	 public $_xltz_type='char';
	/**
 	 * 注释:随访遵医行为评价结果代码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zyxwjg;
	 public $_zyxwjg_type='char';
	/**
 	 * 注释:空腹血糖值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $kfxtz;
	 public $_kfxtz_type='number';
	/**
 	 * 注释:随机血糖
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sjxtz;
	 public $_sjxtz_type='number';
	/**
 	 * 注释:总胆固朜
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zdgc;
	 public $_zdgc_type='number';
	/**
 	 * 注释:HDL-C
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hdlc;
	 public $_hdlc_type='number';
	/**
 	 * 注释:LDL-C
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ldlc;
	 public $_ldlc_type='number';
	/**
 	 * 注释:甘油三脂
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $gysz;
	 public $_gysz_type='number';
	/**
 	 * 注释:尿微量蛋白
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $wndb;
	 public $_wndb_type='number';
	/**
 	 * 注释:辅助检查（糖化血红蛋白）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $thxhdb;
	 public $_thxhdb_type='number';
	/**
 	 * 注释:辅助检查日期
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $fzjcrq;
	 public $_fzjcrq_type='varchar2';
	/**
 	 * 注释:辅助检查描述
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $fzjcms;
	 public $_fzjcms_type='varchar2';
	/**
 	 * 注释:本月诊疗费用
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zlfy;
	 public $_zlfy_type='number';
	/**
 	 * 注释:每季度参加糖尿病健康教育活动次数
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $tnbhdcs;
	 public $_tnbhdcs_type='varchar2';
	/**
 	 * 注释:随访建议
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $sfjy;
	 public $_sfjy_type='varchar2';
	/**
 	 * 注释:转诊原因
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $zzyx;
	 public $_zzyx_type='varchar2';
	/**
 	 * 注释:转诊机构及类别
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $zzjg;
	 public $_zzjg_type='varchar2';
	/**
 	 * 注释:登记人员工号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $djrygh;
	 public $_djrygh_type='varchar2';
	/**
 	 * 注释:登记人员姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $djryxm;
	 public $_djryxm_type='varchar2';
	/**
 	 * 注释:随访医师姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ysqm;
	 public $_ysqm_type='varchar2';
	/**
 	 * 注释:随访医师工号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sfysgh;
	 public $_sfysgh_type='varchar2';
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
	/**
 	 * 注释:预留二
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl2;
	 public $_ylyl2_type='varchar2';
}
