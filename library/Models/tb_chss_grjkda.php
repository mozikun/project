<?php
require_once ('db_oracle.php');
/**
 *注释:个人健康档案表
 *
 *
 **/
class Ttb_chss_grjkda extends dao_oracle{
	 public $__table = 'tb_chss_grjkda';
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
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $xm;
	 public $_xm_type='varchar2';
	/**
 	 * 注释:性别名称
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $xbmc;
	 public $_xbmc_type='varchar2';
	/**
 	 * 注释:性别编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xbbm;
	 public $_xbbm_type='char';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $csrq;
	 public $_csrq_type='date';
	/**
 	 * 注释:文化程度
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $whcd;
	 public $_whcd_type='varchar2';
	/**
 	 * 注释:文化程度编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $whcdbm;
	 public $_whcdbm_type='varchar2';
	/**
 	 * 注释:目前职业名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $mqzymc;
	 public $_mqzymc_type='varchar2';
	/**
 	 * 注释:目前职业编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $mqzybm;
	 public $_mqzybm_type='varchar2';
	/**
 	 * 注释:手机号码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sjhm;
	 public $_sjhm_type='varchar2';
	/**
 	 * 注释:民族名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $mzmc;
	 public $_mzmc_type='varchar2';
	/**
 	 * 注释:民族编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $mzbm;
	 public $_mzbm_type='varchar2';
	/**
 	 * 注释:婚姻状况名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hyzkmc;
	 public $_hyzkmc_type='varchar2';
	/**
 	 * 注释:婚姻状况编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $hyzkbm;
	 public $_hyzkbm_type='varchar2';
	/**
 	 * 注释:户口类别
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $hklb;
	 public $_hklb_type='varchar2';
	/**
 	 * 注释:医疗负担形式名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ylfdxsmc;
	 public $_ylfdxsmc_type='varchar2';
	/**
 	 * 注释:医疗负担形式编码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $ylfdxsbm;
	 public $_ylfdxsbm_type='varchar2';
	/**
 	 * 注释:外、祖父母辈疾病情况名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $wzfmbjbqkmc;
	 public $_wzfmbjbqkmc_type='varchar2';
	/**
 	 * 注释:外、祖父母辈疾病编码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $wzfmbjbbm;
	 public $_wzfmbjbbm_type='varchar2';
	/**
 	 * 注释:父母辈疾病情况名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $fmbjbqkmc;
	 public $_fmbjbqkmc_type='varchar2';
	/**
 	 * 注释:父母辈疾病编码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $fmbjbbm;
	 public $_fmbjbbm_type='varchar2';
	/**
 	 * 注释:同辈疾病情况名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $tbjbqkmc;
	 public $_tbjbqkmc_type='varchar2';
	/**
 	 * 注释:同辈疾病编码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $tbjbbm;
	 public $_tbjbbm_type='varchar2';
	/**
 	 * 注释:目前不适症状情况名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $mqbszzqkmc;
	 public $_mqbszzqkmc_type='varchar2';
	/**
 	 * 注释:目前不适症状情况编码
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $mqbszzqkbm;
	 public $_mqbszzqkbm_type='varchar2';
	/**
 	 * 注释:目前不适症状名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $mqbszzmc;
	 public $_mqbszzmc_type='varchar2';
	/**
 	 * 注释:目前不适症状编码
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $mqbszzbm;
	 public $_mqbszzbm_type='varchar2';
	/**
 	 * 注释:残疾情况名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $cjqkmc;
	 public $_cjqkmc_type='varchar2';
	/**
 	 * 注释:残疾情况编码
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $cjqkbm;
	 public $_cjqkbm_type='varchar2';
	/**
 	 * 注释:是否领残疾证名称
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $sflcjzmc;
	 public $_sflcjzmc_type='varchar2';
	/**
 	 * 注释:残疾证号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $cjzh;
	 public $_cjzh_type='varchar2';
	/**
 	 * 注释:是否过敏史名称
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $sfgmsmc;
	 public $_sfgmsmc_type='varchar2';
	/**
 	 * 注释:是否过敏史编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $sfgmsbm;
	 public $_sfgmsbm_type='varchar2';
	/**
 	 * 注释:过敏物质名称
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $gmwzmc;
	 public $_gmwzmc_type='varchar2';
	/**
 	 * 注释:暴露史
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $bls;
	 public $_bls_type='char';
	/**
 	 * 注释:心率
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xl;
	 public $_xl_type='number';
	/**
 	 * 注释:收缩压
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ssy;
	 public $_ssy_type='number';
	/**
 	 * 注释:舒张压
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $szy;
	 public $_szy_type='number';
	/**
 	 * 注释:档案状态
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $dazt;
	 public $_dazt_type='varchar2';
	/**
 	 * 注释:责任医生姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zrysxm;
	 public $_zrysxm_type='varchar2';
	/**
 	 * 注释:责任医生工号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zrysgh;
	 public $_zrysgh_type='varchar2';
	/**
 	 * 注释:计划外免疫名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jhwmymc;
	 public $_jhwmymc_type='varchar2';
	/**
 	 * 注释:计划外免疫编码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $jhwmybm;
	 public $_jhwmybm_type='varchar2';
	/**
 	 * 注释:身高值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sgz;
	 public $_sgz_type='number';
	/**
 	 * 注释:体重值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tzz;
	 public $_tzz_type='number';
	/**
 	 * 注释:血型
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xx;
	 public $_xx_type='char';
	/**
 	 * 注释:RH阴性
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $rhxx;
	 public $_rhxx_type='char';
	/**
 	 * 注释:饮食习惯编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ysxgbm;
	 public $_ysxgbm_type='varchar2';
	/**
 	 * 注释:饮食习惯名称
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $ysxgmc;
	 public $_ysxgmc_type='varchar2';
	/**
 	 * 注释:是否吸烟情况名称
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sfxyqkmc;
	 public $_sfxyqkmc_type='varchar2';
	/**
 	 * 注释:是否吸烟编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $sfxyqkbm;
	 public $_sfxyqkbm_type='varchar2';
	/**
 	 * 注释:平均每天吸烟支数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $pjmtxyzs;
	 public $_pjmtxyzs_type='number';
	/**
 	 * 注释:开始吸烟年龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ksxynl;
	 public $_ksxynl_type='number';
	/**
 	 * 注释:戒烟年龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jynl;
	 public $_jynl_type='number';
	/**
 	 * 注释:家中煤火取暖
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $jzmhqn;
	 public $_jzmhqn_type='char';
	/**
 	 * 注释:家中煤火取暖已有年限
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jzmhqnyynx;
	 public $_jzmhqnyynx_type='number';
	/**
 	 * 注释:家庭成员吸烟情况编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $rcshgzhjzbdxyq2;
	 public $_rcshgzhjzbdxyq2_type='char';
	/**
 	 * 注释:长期居住地编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $cqjzd;
	 public $_cqjzd_type='char';
	/**
 	 * 注释:饮酒频率名称
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sfyjqkmc;
	 public $_sfyjqkmc_type='varchar2';
	/**
 	 * 注释:饮酒频率编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $sfyjbm;
	 public $_sfyjbm_type='varchar2';
	/**
 	 * 注释:是否戒酒
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sfjj;
	 public $_sfjj_type='char';
	/**
 	 * 注释:戒酒年龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jjnl;
	 public $_jjnl_type='number';
	/**
 	 * 注释:开始饮酒时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ksyjsj;
	 public $_ksyjsj_type='number';
	/**
 	 * 注释:是否醉酒
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sfzj;
	 public $_sfzj_type='char';
	/**
 	 * 注释:平均每次饮酒
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $yjl;
	 public $_yjl_type='number';
	/**
 	 * 注释:主要饮酒品种编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $zyyjpzbm;
	 public $_zyyjpzbm_type='varchar2';
	/**
 	 * 注释:心理状况编码
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $xlzkbm;
	 public $_xlzkbm_type='varchar2';
	/**
 	 * 注释:心理状况其他
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $xlzkqt;
	 public $_xlzkqt_type='varchar2';
	/**
 	 * 注释:遵医行为
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zyxw;
	 public $_zyxw_type='char';
	/**
 	 * 注释:脑血管疾病编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $nxgjbbm;
	 public $_nxgjbbm_type='varchar2';
	/**
 	 * 注释:脑血管疾病名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $mnhbjhwsjys;
	 public $_mnhbjhwsjys_type='varchar2';
	/**
 	 * 注释:脑血管疾病其他描述
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $myhbjhwsjcs;
	 public $_myhbjhwsjcs_type='varchar2';
	/**
 	 * 注释:肾脏疾病编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $pjmchbjhwsjls;
	 public $_pjmchbjhwsjls_type='varchar2';
	/**
 	 * 注释:肾脏疾病名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $mnzhptjhhjys;
	 public $_mnzhptjhhjys_type='varchar2';
	/**
 	 * 注释:肾脏疾病其他描述
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $myhptjhhjcs;
	 public $_myhptjhhjcs_type='varchar2';
	/**
 	 * 注释:心脏疾病编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $pjmchptjhhjls;
	 public $_pjmchptjhhjls_type='varchar2';
	/**
 	 * 注释:心脏疾病名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $mnhpjys;
	 public $_mnhpjys_type='varchar2';
	/**
 	 * 注释:心脏疾病其他描述
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $myhpjcs;
	 public $_myhpjcs_type='varchar2';
	/**
 	 * 注释:血管疾病编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $pjmchpjps;
	 public $_pjmchpjps_type='varchar2';
	/**
 	 * 注释:血管疾病名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $pjmzchzfddswts1;
	 public $_pjmzchzfddswts1_type='varchar2';
	/**
 	 * 注释:血管疾病其他描述
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $pjmzchzfddswts2;
	 public $_pjmzchzfddswts2_type='varchar2';
	/**
 	 * 注释:眼部疾病编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $pjmzcyzhxzdsst1;
	 public $_pjmzcyzhxzdsst1_type='varchar2';
	/**
 	 * 注释:眼部疾病名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $pjmzcyzhxzdswt2;
	 public $_pjmzcyzhxzdswt2_type='varchar2';
	/**
 	 * 注释:眼部疾病其他描述
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $pjmzcyzdsptsmc;
	 public $_pjmzcyzdsptsmc_type='varchar2';
	/**
 	 * 注释:神经系统问题编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $pjmzcyzdsptsbm;
	 public $_pjmzcyzdsptsbm_type='char';
	/**
 	 * 注释:神经系统问题描述
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $pjmzctstsmc;
	 public $_pjmzctstsmc_type='varchar2';
	/**
 	 * 注释:其他疾病1
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $qtjb1;
	 public $_qtjb1_type='varchar2';
	/**
 	 * 注释:其他疾病2
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $qtjb2;
	 public $_qtjb2_type='varchar2';
	/**
 	 * 注释:其他疾病3
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $qtjb3;
	 public $_qtjb3_type='varchar2';
	/**
 	 * 注释:住院史（入/出院时间1）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zysrcysj1;
	 public $_zysrcysj1_type='varchar2';
	/**
 	 * 注释:住院史（原因1）
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $zysyy1;
	 public $_zysyy1_type='varchar2';
	/**
 	 * 注释:住院史（医疗机构名称1）
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zysyljgmc1;
	 public $_zysyljgmc1_type='varchar2';
	/**
 	 * 注释:住院史（病案号1）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zysbah1;
	 public $_zysbah1_type='varchar2';
	/**
 	 * 注释:住院史（入/出院时间2）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zysrcysj2;
	 public $_zysrcysj2_type='varchar2';
	/**
 	 * 注释:住院史（原因2）
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $zysyy2;
	 public $_zysyy2_type='varchar2';
	/**
 	 * 注释:住院史（医疗机构名称2）
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zysyljgmc2;
	 public $_zysyljgmc2_type='varchar2';
	/**
 	 * 注释:住院史（病案号2）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zysbah2;
	 public $_zysbah2_type='varchar2';
	/**
 	 * 注释:住院史（入/出院时间3）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zysrcysj3;
	 public $_zysrcysj3_type='varchar2';
	/**
 	 * 注释:住院史（原因3）
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $zysyy3;
	 public $_zysyy3_type='varchar2';
	/**
 	 * 注释:住院史（医疗机构名称3）
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zysyljgmc3;
	 public $_zysyljgmc3_type='varchar2';
	/**
 	 * 注释:住院史（病案号3）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zysbah3;
	 public $_zysbah3_type='varchar2';
	/**
 	 * 注释:住院史（入/出院时间4）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zysrcysj4;
	 public $_zysrcysj4_type='varchar2';
	/**
 	 * 注释:住院史（原因4）
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $zysyy4;
	 public $_zysyy4_type='varchar2';
	/**
 	 * 注释:住院史（医疗机构名称4）
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zysyljgmc4;
	 public $_zysyljgmc4_type='varchar2';
	/**
 	 * 注释:住院史（病案号4）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zysbah4;
	 public $_zysbah4_type='varchar2';
	/**
 	 * 注释:家庭病床史（建/撤床时间1）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jtbcsccsj1;
	 public $_jtbcsccsj1_type='varchar2';
	/**
 	 * 注释:家庭病床史（原因1）
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $jtbcsyy1;
	 public $_jtbcsyy1_type='varchar2';
	/**
 	 * 注释:家庭病床史（医疗机构名称1）
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jtbcsyljgmc1;
	 public $_jtbcsyljgmc1_type='varchar2';
	/**
 	 * 注释:家庭病床史（病案号1）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jtbcsbah1;
	 public $_jtbcsbah1_type='varchar2';
	/**
 	 * 注释:家庭病床史（建/撤床时间2）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jtbcsccsj2;
	 public $_jtbcsccsj2_type='varchar2';
	/**
 	 * 注释:家庭病床史（原因2）
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $jtbcsyy2;
	 public $_jtbcsyy2_type='varchar2';
	/**
 	 * 注释:家庭病床史（医疗机构名称2）
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jtbcsyljgmc2;
	 public $_jtbcsyljgmc2_type='varchar2';
	/**
 	 * 注释:家庭病床史（病案号2）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jtbcsbah2;
	 public $_jtbcsbah2_type='varchar2';
	/**
 	 * 注释:家庭病床史（建/撤床时间3）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jtbcsccsj3;
	 public $_jtbcsccsj3_type='varchar2';
	/**
 	 * 注释:家庭病床史（原因3）
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $jtbcsyy3;
	 public $_jtbcsyy3_type='varchar2';
	/**
 	 * 注释:家庭病床史（医疗机构名称3）
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jtbcsyljgmc3;
	 public $_jtbcsyljgmc3_type='varchar2';
	/**
 	 * 注释:家庭病床史（病案号3）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jtbcsbah3;
	 public $_jtbcsbah3_type='varchar2';
	/**
 	 * 注释:家庭病床史（建/撤床时间4）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jtbcsccsj4;
	 public $_jtbcsccsj4_type='varchar2';
	/**
 	 * 注释:家庭病床史（原因4）
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $jtbcsyy4;
	 public $_jtbcsyy4_type='varchar2';
	/**
 	 * 注释:家庭病床史（医疗机构名称4）
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jtbcsyljgmc4;
	 public $_jtbcsyljgmc4_type='varchar2';
	/**
 	 * 注释:家庭病床史（病案号4）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jtbcsbah4;
	 public $_jtbcsbah4_type='varchar2';
	/**
 	 * 注释:服药依从性
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $fyycx;
	 public $_fyycx_type='char';
	/**
 	 * 注释:药物名称1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ywmc1;
	 public $_ywmc1_type='varchar2';
	/**
 	 * 注释:药物用法1
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ywyf1;
	 public $_ywyf1_type='varchar2';
	/**
 	 * 注释:药物名称2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ywmc2;
	 public $_ywmc2_type='varchar2';
	/**
 	 * 注释:药物用法2
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ywyf2;
	 public $_ywyf2_type='varchar2';
	/**
 	 * 注释:药物名称3
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ywmc3;
	 public $_ywmc3_type='varchar2';
	/**
 	 * 注释:药物用法3
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ywyf3;
	 public $_ywyf3_type='varchar2';
	/**
 	 * 注释:平均每日吸氧
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $pjmrxy;
	 public $_pjmrxy_type='number';
	/**
 	 * 注释:预防接种流感疫苗编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $yfjzlgymbm;
	 public $_yfjzlgymbm_type='char';
	/**
 	 * 注释:预防接种肺炎球菌疫苗编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $yfjzfyqjymbm;
	 public $_yfjzfyqjymbm_type='char';
	/**
 	 * 注释:预防接种其他疫苗名称1
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $yfjzqtymmc1;
	 public $_yfjzqtymmc1_type='varchar2';
	/**
 	 * 注释:预防接种其他疫苗名称2
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $yfjzqtymmc2;
	 public $_yfjzqtymmc2_type='varchar2';
	/**
 	 * 注释:参加体育锻炼的频度名称
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mzcjzdqdtydldc1;
	 public $_mzcjzdqdtydldc1_type='varchar2';
	/**
 	 * 注释:参加体育锻炼的频度编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $mzcjzdqdtydldc2;
	 public $_mzcjzdqdtydldc2_type='char';
	/**
 	 * 注释:每次花在体育锻炼上的时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mchzzdqdtydlsds;
	 public $_mchzzdqdtydlsds_type='number';
	/**
 	 * 注释:坚持锻炼时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jcdlsj;
	 public $_jcdlsj_type='number';
	/**
 	 * 注释:日常生活中经常出现的精神状况名称
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $rcshzjccxdjszk1;
	 public $_rcshzjccxdjszk1_type='varchar2';
	/**
 	 * 注释:日常生活中经常出现的精神状况编码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $rcshzjccxdjszk2;
	 public $_rcshzjccxdjszk2_type='varchar2';
	/**
 	 * 注释:倾诉对象情况名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $qsdxqkmc;
	 public $_qsdxqkmc_type='varchar2';
	/**
 	 * 注释:倾诉对象情况编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $qsdxqkbm;
	 public $_qsdxqkbm_type='varchar2';
	/**
 	 * 注释:压力感受程度情况名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ylgscdqkmc;
	 public $_ylgscdqkmc_type='varchar2';
	/**
 	 * 注释:压力感受程度情况编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $ylgscdqkbm;
	 public $_ylgscdqkbm_type='varchar2';
	/**
 	 * 注释:约定医疗机构名称
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $ydyymc;
	 public $_ydyymc_type='varchar2';
	/**
 	 * 注释:约定医疗机构编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $ydyybm;
	 public $_ydyybm_type='varchar2';
	/**
 	 * 注释:身体不适时采取的措施名称
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $stbsscqdcsmc;
	 public $_stbsscqdcsmc_type='varchar2';
	/**
 	 * 注释:身体不适时采取的措施编码
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $stbsscqdcsbm;
	 public $_stbsscqdcsbm_type='varchar2';
	/**
 	 * 注释:需要卫生服务情况名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $xywsfwqkmc;
	 public $_xywsfwqkmc_type='varchar2';
	/**
 	 * 注释:需要卫生服务情况编码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $xywsfwqkbm;
	 public $_xywsfwqkbm_type='varchar2';
	/**
 	 * 注释:建档日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jdrq;
	 public $_jdrq_type='date';
	/**
 	 * 注释:建档医疗机构名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $jdyljgmc;
	 public $_jdyljgmc_type='varchar2';
	/**
 	 * 注释:建档医疗机构编码
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jdyljgbm;
	 public $_jdyljgbm_type='varchar2';
	/**
 	 * 注释:登记人工号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $djrgh;
	 public $_djrgh_type='varchar2';
	/**
 	 * 注释:登记人姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $djrxm;
	 public $_djrxm_type='varchar2';
	/**
 	 * 注释:登记日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $djrq;
	 public $_djrq_type='date';
	/**
 	 * 注释:被调查者姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $bdczxm;
	 public $_bdczxm_type='varchar2';
	/**
 	 * 注释:签名日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $qmrq;
	 public $_qmrq_type='date';
	/**
 	 * 注释:调查者姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $dczxm;
	 public $_dczxm_type='varchar2';
	/**
 	 * 注释:调查者工号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $dczgh;
	 public $_dczgh_type='varchar2';
	/**
 	 * 注释:调查日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $dcrq;
	 public $_dcrq_type='date';
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
