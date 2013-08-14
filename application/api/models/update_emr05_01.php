<?php
/**
电子病历基础模板：治疗处置-一般治疗处置记录数据集EMR05.01电子病历基础模板：治疗处置-一般治疗处置记录数据集
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $emr05_01_01_001  文档标识-名称 
* @param string $emr05_01_01_002  文档标识-类别代码
* @param string $emr05_01_01_003  文档标识-管理机构名称
* @param string $emr05_01_01_004  文档标识-管理机构组织机构代码（法人代码）
* @param string $emr05_01_01_005  文档标识-号码 
* @param date $emr05_01_01_006  文档标识-生效日期 
* @param date $emr05_01_01_007  文档标识-失效日期 
* @param string $emr05_01_01_011  标识号-类别代码 
* @param string $emr05_01_01_012  标识号-号码 
* @param date $emr05_01_01_013  标识号-生效日期 
* @param date $emr05_01_01_014  标识号-失效日期 
* @param string $emr05_01_01_015  标识号-提供标识的机构名称 
* @param string $emr05_01_01_016  姓名-标识对象
* @param string $emr05_01_01_017  姓名-标识对象代码
* @param string $emr05_01_01_018  姓名* 
* @param string $emr05_01_01_021  性别代码 
* @param decimal $emr05_01_01_022  年龄（岁）*
* @param string $emr05_01_01_023  国籍代码 
* @param string $emr05_01_01_024  民族代码 
* @param string $emr05_01_01_025  婚姻状况类别代码
* @param string $emr05_01_01_026  职业编码系统名称 
* @param string $emr05_01_01_027  职业代码
* @param string $emr05_01_01_028  文化程度代码 
* @param date $emr05_01_01_029  出生日期*
* @param string $emr05_01_01_030  出生地*
* @param string $emr05_01_01_041  机构名称
* @param string $emr05_01_01_042  机构组织机构代码
* @param string $emr05_01_01_043  机构负责人（法人）
* @param string $emr05_01_01_044  机构地址
* @param string $emr05_01_01_045  科室名称
* @param string $emr05_01_01_046  机构角色
* @param string $emr05_01_01_047  机构角色代码
* @param string $emr05_01_01_051  服务者姓名*
* @param string $emr05_01_01_052  服务者职责（角色）
* @param string $emr05_01_01_053  服务者职责（角色）代码
* @param string $emr05_01_01_054  服务者医师资格标志*
* @param string $emr05_01_01_055  服务者学历*
* @param string $emr05_01_01_056  服务者所学专业*
* @param string $emr05_01_01_057  服务者专业技术职称*
* @param string $emr05_01_01_058  服务者职务*
* @param string $emr05_01_01_061  诊断机构名称
* @param date $emr05_01_01_062  诊断日期
* @param string $emr05_01_01_063  诊断类别
* @param string $emr05_01_01_064  诊断类别代码
* @param string $emr05_01_01_065  诊断顺位（从属关系）代码
* @param string $emr05_01_01_066  疾病名称
* @param string $emr05_01_01_067  疾病代码
* @param string $emr05_01_01_068  诊断依据
* @param string $emr05_01_01_069  诊断依据代码
* @param string $emr05_01_01_071  手术/操作-名称
* @param string $emr05_01_01_072  手术/操作-代码
* @param string $emr05_01_01_073  手术/操作-目标部位名称
* @param string $emr05_01_01_074  操作部位编码体系名称
* @param string $emr05_01_01_075  操作部位编码
* @param string $emr05_01_01_076  介入物名称
* @param string $emr05_01_01_077  操作方法
* @param decimal $emr05_01_01_078  操作次数
* @param dateTime $emr05_01_01_079  操作日期/时间
* @param string $emr05_01_01_080  操作编码体系名称
* @param string $emr05_01_01_091  拟做的检查
* @param string $emr05_01_01_092  拟做的医学检验
* @param string $emr05_01_01_093  今后治疗方案
* @param boolean $emr05_01_01_094  随访标志
* @param decimal $emr05_01_01_095  随访间隔（随诊期限）
* @param string $emr05_01_01_096  医嘱
* @param string $emr05_01_01_097  特别注意事项
* @param string $emr05_01_01_0101  门诊费用-分类
* @param string $emr05_01_01_0102  门诊费用-分类代码
* @param decimal $emr05_01_01_0103  门诊费用-金额（元/人民币）
* @param string $emr05_01_01_0104  门诊费用-支付方式代码
* @param string $emr05_01_01_0105  住院费用-分类
* @param string $emr05_01_01_0106  住院费用-分类代码
* @param decimal $emr05_01_01_0107  住院费用-金额（元/人民币）
* @param string $emr05_01_01_0108  住院费用-医疗付款方式代码
* @param decimal $emr05_01_01_0109  个人承担费用（元）
* @return boolean
*/
function update_emr05_01($ws_id,$org_id,$doctor_id,$identity_number,$emr05_01_01_001='',$emr05_01_01_002='',$emr05_01_01_003='',$emr05_01_01_004='',$emr05_01_01_005='',$emr05_01_01_006='',$emr05_01_01_007='',$emr05_01_01_011='',$emr05_01_01_012='',$emr05_01_01_013='',$emr05_01_01_014='',$emr05_01_01_015='',$emr05_01_01_016='',$emr05_01_01_017='',$emr05_01_01_018='',$emr05_01_01_021='',$emr05_01_01_022=0,$emr05_01_01_023='',$emr05_01_01_024='',$emr05_01_01_025='',$emr05_01_01_026='',$emr05_01_01_027='',$emr05_01_01_028='',$emr05_01_01_029='',$emr05_01_01_030='',$emr05_01_01_041='',$emr05_01_01_042='',$emr05_01_01_043='',$emr05_01_01_044='',$emr05_01_01_045='',$emr05_01_01_046='',$emr05_01_01_047='',$emr05_01_01_051='',$emr05_01_01_052='',$emr05_01_01_053='',$emr05_01_01_054='',$emr05_01_01_055='',$emr05_01_01_056='',$emr05_01_01_057='',$emr05_01_01_058='',$emr05_01_01_061='',$emr05_01_01_062='',$emr05_01_01_063='',$emr05_01_01_064='',$emr05_01_01_065='',$emr05_01_01_066='',$emr05_01_01_067='',$emr05_01_01_068='',$emr05_01_01_069='',$emr05_01_01_071='',$emr05_01_01_072='',$emr05_01_01_073='',$emr05_01_01_074='',$emr05_01_01_075='',$emr05_01_01_076='',$emr05_01_01_077='',$emr05_01_01_078=0,$emr05_01_01_079='',$emr05_01_01_080='',$emr05_01_01_091='',$emr05_01_01_092='',$emr05_01_01_093='',$emr05_01_01_094=false,$emr05_01_01_095=0,$emr05_01_01_096='',$emr05_01_01_097='',$emr05_01_01_0101='',$emr05_01_01_0102='',$emr05_01_01_0103=0,$emr05_01_01_0104='',$emr05_01_01_0105='',$emr05_01_01_0106='',$emr05_01_01_0107=0,$emr05_01_01_0108='',$emr05_01_01_0109=0){
require_once(__SITEROOT.'library/Models/ws_emr05_01.php');
$table_obj="Tws_emr05_01";
$ws_emr05_01=new $table_obj();
$ws_emr05_01 -> ws_id=$ws_id;
$ws_emr05_01 -> uuid=uniqid('',true);
$ws_emr05_01 -> created=time();
$ws_emr05_01 -> org_id=$org_id;
$ws_emr05_01 -> doctor_id=$doctor_id;
$ws_emr05_01 -> identity_number=$identity_number;//身份证号
$ws_emr05_01 -> action='insert';
$ws_emr05_01->emr05_01_01_001 = $emr05_01_01_001; //文档标识-名称  
$ws_emr05_01->emr05_01_01_002 = $emr05_01_01_002; //文档标识-类别代码 
$ws_emr05_01->emr05_01_01_003 = $emr05_01_01_003; //文档标识-管理机构名称 
$ws_emr05_01->emr05_01_01_004 = $emr05_01_01_004; //文档标识-管理机构组织机构代码（法人代码） 
$ws_emr05_01->emr05_01_01_005 = $emr05_01_01_005; //文档标识-号码  
$ws_emr05_01 ->emr05_01_01_006 = empty($emr05_01_01_006)?null : $ws_emr05_01 ->escape('emr05_01_01_006',to_date($emr05_01_01_006,'YYYY-MM-DD')); //文档标识-生效日期  
$ws_emr05_01 ->emr05_01_01_007 = empty($emr05_01_01_007)?null : $ws_emr05_01 ->escape('emr05_01_01_007',to_date($emr05_01_01_007,'YYYY-MM-DD')); //文档标识-失效日期  
$ws_emr05_01->emr05_01_01_011 = $emr05_01_01_011; //标识号-类别代码  
$ws_emr05_01->emr05_01_01_012 = $emr05_01_01_012; //标识号-号码  
$ws_emr05_01 ->emr05_01_01_013 = empty($emr05_01_01_013)?null : $ws_emr05_01 ->escape('emr05_01_01_013',to_date($emr05_01_01_013,'YYYY-MM-DD')); //标识号-生效日期  
$ws_emr05_01 ->emr05_01_01_014 = empty($emr05_01_01_014)?null : $ws_emr05_01 ->escape('emr05_01_01_014',to_date($emr05_01_01_014,'YYYY-MM-DD')); //标识号-失效日期  
$ws_emr05_01->emr05_01_01_015 = $emr05_01_01_015; //标识号-提供标识的机构名称  
$ws_emr05_01->emr05_01_01_016 = $emr05_01_01_016; //姓名-标识对象 
$ws_emr05_01->emr05_01_01_017 = $emr05_01_01_017; //姓名-标识对象代码 
$ws_emr05_01->emr05_01_01_018 = $emr05_01_01_018; //姓名*  
$ws_emr05_01->emr05_01_01_021 = $emr05_01_01_021; //性别代码  
$ws_emr05_01->emr05_01_01_022 = $emr05_01_01_022; //年龄（岁）* 
$ws_emr05_01->emr05_01_01_023 = $emr05_01_01_023; //国籍代码  
$ws_emr05_01->emr05_01_01_024 = $emr05_01_01_024; //民族代码  
$ws_emr05_01->emr05_01_01_025 = $emr05_01_01_025; //婚姻状况类别代码 
$ws_emr05_01->emr05_01_01_026 = $emr05_01_01_026; //职业编码系统名称  
$ws_emr05_01->emr05_01_01_027 = $emr05_01_01_027; //职业代码 
$ws_emr05_01->emr05_01_01_028 = $emr05_01_01_028; //文化程度代码  
$ws_emr05_01 ->emr05_01_01_029 = empty($emr05_01_01_029)?null : $ws_emr05_01 ->escape('emr05_01_01_029',to_date($emr05_01_01_029,'YYYY-MM-DD')); //出生日期* 
$ws_emr05_01->emr05_01_01_030 = $emr05_01_01_030; //出生地* 
$ws_emr05_01->emr05_01_01_041 = $emr05_01_01_041; //机构名称 
$ws_emr05_01->emr05_01_01_042 = $emr05_01_01_042; //机构组织机构代码 
$ws_emr05_01->emr05_01_01_043 = $emr05_01_01_043; //机构负责人（法人） 
$ws_emr05_01->emr05_01_01_044 = $emr05_01_01_044; //机构地址 
$ws_emr05_01->emr05_01_01_045 = $emr05_01_01_045; //科室名称 
$ws_emr05_01->emr05_01_01_046 = $emr05_01_01_046; //机构角色 
$ws_emr05_01->emr05_01_01_047 = $emr05_01_01_047; //机构角色代码 
$ws_emr05_01->emr05_01_01_051 = $emr05_01_01_051; //服务者姓名* 
$ws_emr05_01->emr05_01_01_052 = $emr05_01_01_052; //服务者职责（角色） 
$ws_emr05_01->emr05_01_01_053 = $emr05_01_01_053; //服务者职责（角色）代码 
$ws_emr05_01->emr05_01_01_054 = $emr05_01_01_054; //服务者医师资格标志* 
$ws_emr05_01->emr05_01_01_055 = $emr05_01_01_055; //服务者学历* 
$ws_emr05_01->emr05_01_01_056 = $emr05_01_01_056; //服务者所学专业* 
$ws_emr05_01->emr05_01_01_057 = $emr05_01_01_057; //服务者专业技术职称* 
$ws_emr05_01->emr05_01_01_058 = $emr05_01_01_058; //服务者职务* 
$ws_emr05_01->emr05_01_01_061 = $emr05_01_01_061; //诊断机构名称 
$ws_emr05_01 ->emr05_01_01_062 = empty($emr05_01_01_062)?null : $ws_emr05_01 ->escape('emr05_01_01_062',to_date($emr05_01_01_062,'YYYY-MM-DD')); //诊断日期 
$ws_emr05_01->emr05_01_01_063 = $emr05_01_01_063; //诊断类别 
$ws_emr05_01->emr05_01_01_064 = $emr05_01_01_064; //诊断类别代码 
$ws_emr05_01->emr05_01_01_065 = $emr05_01_01_065; //诊断顺位（从属关系）代码 
$ws_emr05_01->emr05_01_01_066 = $emr05_01_01_066; //疾病名称 
$ws_emr05_01->emr05_01_01_067 = $emr05_01_01_067; //疾病代码 
$ws_emr05_01->emr05_01_01_068 = $emr05_01_01_068; //诊断依据 
$ws_emr05_01->emr05_01_01_069 = $emr05_01_01_069; //诊断依据代码 
$ws_emr05_01->emr05_01_01_071 = $emr05_01_01_071; //手术/操作-名称 
$ws_emr05_01->emr05_01_01_072 = $emr05_01_01_072; //手术/操作-代码 
$ws_emr05_01->emr05_01_01_073 = $emr05_01_01_073; //手术/操作-目标部位名称 
$ws_emr05_01->emr05_01_01_074 = $emr05_01_01_074; //操作部位编码体系名称 
$ws_emr05_01->emr05_01_01_075 = $emr05_01_01_075; //操作部位编码 
$ws_emr05_01->emr05_01_01_076 = $emr05_01_01_076; //介入物名称 
$ws_emr05_01->emr05_01_01_077 = $emr05_01_01_077; //操作方法 
$ws_emr05_01->emr05_01_01_078 = $emr05_01_01_078; //操作次数 
$ws_emr05_01 ->emr05_01_01_079 = empty($emr05_01_01_079)?null : $ws_emr05_01 ->escape('emr05_01_01_079',to_date($emr05_01_01_079,'YYYY-MM-DD')); //操作日期/时间 
$ws_emr05_01->emr05_01_01_080 = $emr05_01_01_080; //操作编码体系名称 
$ws_emr05_01->emr05_01_01_091 = $emr05_01_01_091; //拟做的检查 
$ws_emr05_01->emr05_01_01_092 = $emr05_01_01_092; //拟做的医学检验 
$ws_emr05_01->emr05_01_01_093 = $emr05_01_01_093; //今后治疗方案 
$ws_emr05_01->emr05_01_01_094 = $emr05_01_01_094; //随访标志 
$ws_emr05_01->emr05_01_01_095 = $emr05_01_01_095; //随访间隔（随诊期限） 
$ws_emr05_01->emr05_01_01_096 = $emr05_01_01_096; //医嘱 
$ws_emr05_01->emr05_01_01_097 = $emr05_01_01_097; //特别注意事项 
$ws_emr05_01->emr05_01_01_0101 = $emr05_01_01_0101; //门诊费用-分类 
$ws_emr05_01->emr05_01_01_0102 = $emr05_01_01_0102; //门诊费用-分类代码 
$ws_emr05_01->emr05_01_01_0103 = $emr05_01_01_0103; //门诊费用-金额（元/人民币） 
$ws_emr05_01->emr05_01_01_0104 = $emr05_01_01_0104; //门诊费用-支付方式代码 
$ws_emr05_01->emr05_01_01_0105 = $emr05_01_01_0105; //住院费用-分类 
$ws_emr05_01->emr05_01_01_0106 = $emr05_01_01_0106; //住院费用-分类代码 
$ws_emr05_01->emr05_01_01_0107 = $emr05_01_01_0107; //住院费用-金额（元/人民币） 
$ws_emr05_01->emr05_01_01_0108 = $emr05_01_01_0108; //住院费用-医疗付款方式代码 
$ws_emr05_01->emr05_01_01_0109 = $emr05_01_01_0109; //个人承担费用（元） 
if($ws_emr05_01 ->insert()){
	return true;
}else{
	return false;
}
$ws_emr05_01 ->free_statement();
}
