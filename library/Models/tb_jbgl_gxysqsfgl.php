<?php
require_once ('db_oracle.php');
/**
 *注释:高血压社区随访表
 *
 *
 **/
class Ttb_jbgl_gxysqsfgl extends dao_oracle{
	 public $__table = 'tb_jbgl_gxysqsfgl';
	/**
 	 * 注释:高血压随访卡ID
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $vid;
	 public $_vid_type='varchar2';
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
 	 * 注释:随访日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $sfrq;
	 public $_sfrq_type='date';
	/**
 	 * 注释:随访编号
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $sfbh;
	 public $_sfbh_type='varchar2';
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
 	 * 注释:并发症情况
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $bfzqk;
	 public $_bfzqk_type='varchar2';
	/**
 	 * 注释:目前症状
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $mqzz;
	 public $_mqzz_type='varchar2';
	/**
 	 * 注释:目前症状其他
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $qtmqzz;
	 public $_qtmqzz_type='varchar2';
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
 	 * 注释:不规律服药原因
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $bglfyyy;
	 public $_bglfyyy_type='varchar2';
	/**
 	 * 注释:不服药原因
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $bfyyy;
	 public $_bfyyy_type='varchar2';
	/**
 	 * 注释:目前的非药物治疗原因
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $mqfywzlyy;
	 public $_mqfywzlyy_type='varchar2';
	/**
 	 * 注释:健康处方建议（编号）
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $jkcfjy;
	 public $_jkcfjy_type='varchar2';
	/**
 	 * 注释:患者接受程度
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hzjscd;
	 public $_hzjscd_type='varchar2';
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
 	 * 注释:转归状态
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zgzt;
	 public $_zgzt_type='varchar2';
	/**
 	 * 注释:随访方式代码
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $sffsdm;
	 public $_sffsdm_type='varchar2';
	/**
 	 * 注释:症状代码(健康检查)
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zzdm;
	 public $_zzdm_type='varchar2';
	/**
 	 * 注释:高血压随访评价结果代码
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $gxysfpjjgdm;
	 public $_gxysfpjjgdm_type='varchar2';
	/**
 	 * 注释:身高
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
 	 * 注释:心率
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $xl;
	 public $_xl_type='varchar2';
	/**
 	 * 注释:体征其他
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $tzqt;
	 public $_tzqt_type='varchar2';
	/**
 	 * 注释:摄盐情况
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $syqk;
	 public $_syqk_type='varchar2';
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
 	 * 注释:随访饮食合理性评价类别代码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $yshlxlblb;
	 public $_yshlxlblb_type='char';
	/**
 	 * 注释:随访周期建议代码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sfzqjy;
	 public $_sfzqjy_type='char';
	/**
 	 * 注释:随访遵医行为评价结果代码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zyxwjg;
	 public $_zyxwjg_type='char';
	/**
 	 * 注释:服药依从性代码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $fyycx;
	 public $_fyycx_type='char';
	/**
 	 * 注释:药物不良反应
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ywblfy;
	 public $_ywblfy_type='char';
	/**
 	 * 注释:此次随访分类
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ccsffl;
	 public $_ccsffl_type='char';
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
 	 * 注释:戒烟年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jynl;
	 public $_jynl_type='number';
	/**
 	 * 注释:戒酒年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jjnl;
	 public $_jjnl_type='number';
	/**
 	 * 注释:饮食习惯代码
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $ysxgdm;
	 public $_ysxgdm_type='varchar2';
	/**
 	 * 注释:吸烟状况代码
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $xyzkdm;
	 public $_xyzkdm_type='varchar2';
	/**
 	 * 注释:饮酒频率代码
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $yjpldm;
	 public $_yjpldm_type='varchar2';
	/**
 	 * 注释:饮酒种类代码
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $yjzldm;
	 public $_yjzldm_type='varchar2';
	/**
 	 * 注释:心理状态代码
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $xlztdm;
	 public $_xlztdm_type='varchar2';
	/**
 	 * 注释:心理调整
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xltz;
	 public $_xltz_type='char';
	/**
 	 * 注释:遵医行为
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $zyxw;
	 public $_zyxw_type='varchar2';
	/**
 	 * 注释:辅助检查
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $fzjc;
	 public $_fzjc_type='varchar2';
	/**
 	 * 注释:家庭成员吸烟标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $jtcybz;
	 public $_jtcybz_type='char';
	/**
 	 * 注释:现存主要健康问题
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $xczyjkwt;
	 public $_xczyjkwt_type='varchar2';
	/**
 	 * 注释:吸氧时间(h)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xysj;
	 public $_xysj_type='number';
	/**
 	 * 注释:转诊原因
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $zzyy;
	 public $_zzyy_type='varchar2';
	/**
 	 * 注释:转诊机构及科别
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zzjgjkb;
	 public $_zzjgjkb_type='varchar2';
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
 	 * 注释:下次随访日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $xcsfrq;
	 public $_xcsfrq_type='date';
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
}
