<?php
/**
电子病历基础模板：住院病程记录数据集（一）EMR10.01电子病历基础模板：住院病程记录数据集（一）
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $emr10_00_01_001  文档标识-名称 
* @param string $emr10_00_01_002  文档标识-类别代码
* @param string $emr10_00_01_003  文档标识-管理机构名称
* @param string $emr10_00_01_004  文档标识-管理机构组织机构代码（法人代码）
* @param string $emr10_00_01_005  文档标识-号码 
* @param date $emr10_00_01_006  文档标识-生效日期 
* @param date $emr10_00_01_007  文档标识-失效日期 
* @param string $emr10_00_01_011  标识号-类别代码 
* @param string $emr10_00_01_012  标识号-号码* 
* @param date $emr10_00_01_013  标识号-生效日期 
* @param date $emr10_00_01_014  标识号-失效日期 
* @param string $emr10_00_01_015  标识号-提供标识的机构名称 
* @param string $emr10_00_01_016  姓名-标识对象
* @param string $emr10_00_01_017  姓名-标识对象代码
* @param string $emr10_00_01_018  姓名* 
* @param string $emr10_00_01_021  性别代码 
* @param decimal $emr10_00_01_022  年龄（岁）*
* @param string $emr10_00_01_023  国籍代码 
* @param string $emr10_00_01_024  民族代码 
* @param string $emr10_00_01_025  婚姻状况类别代码
* @param string $emr10_00_01_026  职业编码系统名称 
* @param string $emr10_00_01_027  职业代码
* @param string $emr10_00_01_028  文化程度代码 
* @param date $emr10_00_01_029  出生日期 *
* @param string $emr10_00_01_030  出生地* 
* @param string $emr10_00_01_041  服务者姓名*
* @param string $emr10_00_01_042  服务者职责（角色）
* @param string $emr10_00_01_043  服务者职责（角色）代码
* @param string $emr10_00_01_044  服务者医师资格标志
* @param string $emr10_00_01_045  服务者学历*
* @param string $emr10_00_01_046  服务者所学专业*
* @param string $emr10_00_01_047  服务者专业技术职称*
* @param string $emr10_00_01_048  服务者职务*
* @param string $emr10_00_01_051  主诉
* @param string $emr10_00_01_052  症状代码编码体系名称
* @param string $emr10_00_01_053  症状代码
* @param dateTime $emr10_00_01_054  症状开始日期时间
* @param dateTime $emr10_00_01_055  症状停止日期时间
* @param string $emr10_00_01_056  症状观察项目类目名称
* @param string $emr10_00_01_057  症状观察结果
* @param string $emr10_00_01_061  观察-类别
* @param string $emr10_00_01_062  观察-类别代码
* @param string $emr10_00_01_063  观察项目名称
* @param string $emr10_00_01_064  观察-项目代码
* @param string $emr10_00_01_065  观察-结果描述
* @param decimal $emr10_00_01_066  观察-结果(数值)
* @param string $emr10_00_01_067  观察-计量单位
* @param string $emr10_00_01_068  观察-结果代码
* @param string $emr10_00_01_069  体格检查项目类目名称
* @param string $emr10_00_01_070  体格检查观察结果
* @param dateTime $emr10_00_01_081  起病时间
* @param string $emr10_00_01_082  起病情况描述
* @param string $emr10_00_01_083  症状开始原因/诱因
* @param string $emr10_00_01_084  症状特点
* @param string $emr10_00_01_085  伴随症状
* @param string $emr10_00_01_086  本疾病既往诊疗经过
* @param string $emr10_00_01_087  起病后一般情况
* @param string $emr10_00_01_088  基础疾病诊疗情况
* @param string $emr10_00_01_091  既往观察-项目名称
* @param string $emr10_00_01_092  既往观察-项目分类代码
* @param string $emr10_00_01_093  既往观察-项目代码名称
* @param string $emr10_00_01_094  既往观察-项目代码
* @param string $emr10_00_01_095  既往观察-方法代码
* @param string $emr10_00_01_096  既往观察-结果
* @param string $emr10_00_01_097  既往史观察项目类目名称
* @param string $emr10_00_01_098  既往史观察结果
* @param string $emr10_00_01_101  观察-类别
* @param string $emr10_00_01_102  观察-类别代码
* @param string $emr10_00_01_103  观察项目名称
* @param string $emr10_00_01_104  观察-项目代码
* @param string $emr10_00_01_105  观察-结果描述
* @param decimal $emr10_00_01_106  观察-结果(数值)
* @param string $emr10_00_01_107  观察-计量单位
* @param string $emr10_00_01_108  观察-结果代码
* @param string $emr10_00_01_109  检查部位
* @param string $emr10_00_01_110  检查部位代码
* @param string $emr10_00_01_121  观察-类别
* @param string $emr10_00_01_122  观察-类别代码
* @param string $emr10_00_01_123  观察项目名称
* @param string $emr10_00_01_124  观察-项目代码
* @param string $emr10_00_01_125  观察-结果描述
* @param decimal $emr10_00_01_126  观察-结果(数值)
* @param string $emr10_00_01_127  观察-计量单位
* @param string $emr10_00_01_128  观察-结果代码
* @param string $emr10_00_01_131  诊断机构名称
* @param date $emr10_00_01_132  诊断日期
* @param string $emr10_00_01_133  诊断类别
* @param string $emr10_00_01_134  诊断类别代码
* @param string $emr10_00_01_135  诊断顺位（从属关系）代码
* @param string $emr10_00_01_136  疾病名称
* @param string $emr10_00_01_137  疾病代码
* @param string $emr10_00_01_138  诊断依据
* @param string $emr10_00_01_139  诊断依据代码
* @param string $emr10_00_01_141  拟做的检查
* @param string $emr10_00_01_142  拟做的医学检验
* @param string $emr10_00_01_143  今后治疗方案
* @param boolean $emr10_00_01_144  随访标志
* @param decimal $emr10_00_01_145  随访间隔（随诊期限）
* @param string $emr10_00_01_146  医嘱
* @param string $emr10_00_01_147  特别注意事项
* @return boolean
*/
function update_emr10_01($ws_id,$org_id,$doctor_id,$identity_number,$emr10_00_01_001='',$emr10_00_01_002='',$emr10_00_01_003='',$emr10_00_01_004='',$emr10_00_01_005='',$emr10_00_01_006='',$emr10_00_01_007='',$emr10_00_01_011='',$emr10_00_01_012='',$emr10_00_01_013='',$emr10_00_01_014='',$emr10_00_01_015='',$emr10_00_01_016='',$emr10_00_01_017='',$emr10_00_01_018='',$emr10_00_01_021='',$emr10_00_01_022=0,$emr10_00_01_023='',$emr10_00_01_024='',$emr10_00_01_025='',$emr10_00_01_026='',$emr10_00_01_027='',$emr10_00_01_028='',$emr10_00_01_029='',$emr10_00_01_030='',$emr10_00_01_041='',$emr10_00_01_042='',$emr10_00_01_043='',$emr10_00_01_044='',$emr10_00_01_045='',$emr10_00_01_046='',$emr10_00_01_047='',$emr10_00_01_048='',$emr10_00_01_051='',$emr10_00_01_052='',$emr10_00_01_053='',$emr10_00_01_054='',$emr10_00_01_055='',$emr10_00_01_056='',$emr10_00_01_057='',$emr10_00_01_061='',$emr10_00_01_062='',$emr10_00_01_063='',$emr10_00_01_064='',$emr10_00_01_065='',$emr10_00_01_066=0,$emr10_00_01_067='',$emr10_00_01_068='',$emr10_00_01_069='',$emr10_00_01_070='',$emr10_00_01_081='',$emr10_00_01_082='',$emr10_00_01_083='',$emr10_00_01_084='',$emr10_00_01_085='',$emr10_00_01_086='',$emr10_00_01_087='',$emr10_00_01_088='',$emr10_00_01_091='',$emr10_00_01_092='',$emr10_00_01_093='',$emr10_00_01_094='',$emr10_00_01_095='',$emr10_00_01_096='',$emr10_00_01_097='',$emr10_00_01_098='',$emr10_00_01_101='',$emr10_00_01_102='',$emr10_00_01_103='',$emr10_00_01_104='',$emr10_00_01_105='',$emr10_00_01_106=0,$emr10_00_01_107='',$emr10_00_01_108='',$emr10_00_01_109='',$emr10_00_01_110='',$emr10_00_01_121='',$emr10_00_01_122='',$emr10_00_01_123='',$emr10_00_01_124='',$emr10_00_01_125='',$emr10_00_01_126=0,$emr10_00_01_127='',$emr10_00_01_128='',$emr10_00_01_131='',$emr10_00_01_132='',$emr10_00_01_133='',$emr10_00_01_134='',$emr10_00_01_135='',$emr10_00_01_136='',$emr10_00_01_137='',$emr10_00_01_138='',$emr10_00_01_139='',$emr10_00_01_141='',$emr10_00_01_142='',$emr10_00_01_143='',$emr10_00_01_144=false,$emr10_00_01_145=0,$emr10_00_01_146='',$emr10_00_01_147=''){
require_once(__SITEROOT.'library/Models/ws_emr10_01.php');
$table_obj="Tws_emr10_01";
$ws_emr10_01=new $table_obj();
$ws_emr10_01 -> ws_id=$ws_id;
$ws_emr10_01 -> uuid=uniqid('',true);
$ws_emr10_01 -> created=time();
$ws_emr10_01 -> org_id=$org_id;
$ws_emr10_01 -> doctor_id=$doctor_id;
$ws_emr10_01 -> identity_number=$identity_number;//身份证号
$ws_emr10_01 -> action='insert';
$ws_emr10_01->emr10_00_01_001 = $emr10_00_01_001; //文档标识-名称  
$ws_emr10_01->emr10_00_01_002 = $emr10_00_01_002; //文档标识-类别代码 
$ws_emr10_01->emr10_00_01_003 = $emr10_00_01_003; //文档标识-管理机构名称 
$ws_emr10_01->emr10_00_01_004 = $emr10_00_01_004; //文档标识-管理机构组织机构代码（法人代码） 
$ws_emr10_01->emr10_00_01_005 = $emr10_00_01_005; //文档标识-号码  
$ws_emr10_01 ->emr10_00_01_006 = empty($emr10_00_01_006)?null : $ws_emr10_01 ->escape('emr10_00_01_006',to_date($emr10_00_01_006,'YYYY-MM-DD')); //文档标识-生效日期  
$ws_emr10_01 ->emr10_00_01_007 = empty($emr10_00_01_007)?null : $ws_emr10_01 ->escape('emr10_00_01_007',to_date($emr10_00_01_007,'YYYY-MM-DD')); //文档标识-失效日期  
$ws_emr10_01->emr10_00_01_011 = $emr10_00_01_011; //标识号-类别代码  
$ws_emr10_01->emr10_00_01_012 = $emr10_00_01_012; //标识号-号码*  
$ws_emr10_01 ->emr10_00_01_013 = empty($emr10_00_01_013)?null : $ws_emr10_01 ->escape('emr10_00_01_013',to_date($emr10_00_01_013,'YYYY-MM-DD')); //标识号-生效日期  
$ws_emr10_01 ->emr10_00_01_014 = empty($emr10_00_01_014)?null : $ws_emr10_01 ->escape('emr10_00_01_014',to_date($emr10_00_01_014,'YYYY-MM-DD')); //标识号-失效日期  
$ws_emr10_01->emr10_00_01_015 = $emr10_00_01_015; //标识号-提供标识的机构名称  
$ws_emr10_01->emr10_00_01_016 = $emr10_00_01_016; //姓名-标识对象 
$ws_emr10_01->emr10_00_01_017 = $emr10_00_01_017; //姓名-标识对象代码 
$ws_emr10_01->emr10_00_01_018 = $emr10_00_01_018; //姓名*  
$ws_emr10_01->emr10_00_01_021 = $emr10_00_01_021; //性别代码  
$ws_emr10_01->emr10_00_01_022 = $emr10_00_01_022; //年龄（岁）* 
$ws_emr10_01->emr10_00_01_023 = $emr10_00_01_023; //国籍代码  
$ws_emr10_01->emr10_00_01_024 = $emr10_00_01_024; //民族代码  
$ws_emr10_01->emr10_00_01_025 = $emr10_00_01_025; //婚姻状况类别代码 
$ws_emr10_01->emr10_00_01_026 = $emr10_00_01_026; //职业编码系统名称  
$ws_emr10_01->emr10_00_01_027 = $emr10_00_01_027; //职业代码 
$ws_emr10_01->emr10_00_01_028 = $emr10_00_01_028; //文化程度代码  
$ws_emr10_01 ->emr10_00_01_029 = empty($emr10_00_01_029)?null : $ws_emr10_01 ->escape('emr10_00_01_029',to_date($emr10_00_01_029,'YYYY-MM-DD')); //出生日期 * 
$ws_emr10_01->emr10_00_01_030 = $emr10_00_01_030; //出生地*  
$ws_emr10_01->emr10_00_01_041 = $emr10_00_01_041; //服务者姓名* 
$ws_emr10_01->emr10_00_01_042 = $emr10_00_01_042; //服务者职责（角色） 
$ws_emr10_01->emr10_00_01_043 = $emr10_00_01_043; //服务者职责（角色）代码 
$ws_emr10_01->emr10_00_01_044 = $emr10_00_01_044; //服务者医师资格标志 
$ws_emr10_01->emr10_00_01_045 = $emr10_00_01_045; //服务者学历* 
$ws_emr10_01->emr10_00_01_046 = $emr10_00_01_046; //服务者所学专业* 
$ws_emr10_01->emr10_00_01_047 = $emr10_00_01_047; //服务者专业技术职称* 
$ws_emr10_01->emr10_00_01_048 = $emr10_00_01_048; //服务者职务* 
$ws_emr10_01->emr10_00_01_051 = $emr10_00_01_051; //主诉 
$ws_emr10_01->emr10_00_01_052 = $emr10_00_01_052; //症状代码编码体系名称 
$ws_emr10_01->emr10_00_01_053 = $emr10_00_01_053; //症状代码 
$ws_emr10_01 ->emr10_00_01_054 = empty($emr10_00_01_054)?null : $ws_emr10_01 ->escape('emr10_00_01_054',to_date($emr10_00_01_054,'YYYY-MM-DD')); //症状开始日期时间 
$ws_emr10_01 ->emr10_00_01_055 = empty($emr10_00_01_055)?null : $ws_emr10_01 ->escape('emr10_00_01_055',to_date($emr10_00_01_055,'YYYY-MM-DD')); //症状停止日期时间 
$ws_emr10_01->emr10_00_01_056 = $emr10_00_01_056; //症状观察项目类目名称 
$ws_emr10_01->emr10_00_01_057 = $emr10_00_01_057; //症状观察结果 
$ws_emr10_01->emr10_00_01_061 = $emr10_00_01_061; //观察-类别 
$ws_emr10_01->emr10_00_01_062 = $emr10_00_01_062; //观察-类别代码 
$ws_emr10_01->emr10_00_01_063 = $emr10_00_01_063; //观察项目名称 
$ws_emr10_01->emr10_00_01_064 = $emr10_00_01_064; //观察-项目代码 
$ws_emr10_01->emr10_00_01_065 = $emr10_00_01_065; //观察-结果描述 
$ws_emr10_01->emr10_00_01_066 = $emr10_00_01_066; //观察-结果(数值) 
$ws_emr10_01->emr10_00_01_067 = $emr10_00_01_067; //观察-计量单位 
$ws_emr10_01->emr10_00_01_068 = $emr10_00_01_068; //观察-结果代码 
$ws_emr10_01->emr10_00_01_069 = $emr10_00_01_069; //体格检查项目类目名称 
$ws_emr10_01->emr10_00_01_070 = $emr10_00_01_070; //体格检查观察结果 
$ws_emr10_01 ->emr10_00_01_081 = empty($emr10_00_01_081)?null : $ws_emr10_01 ->escape('emr10_00_01_081',to_date($emr10_00_01_081,'YYYY-MM-DD')); //起病时间 
$ws_emr10_01->emr10_00_01_082 = $emr10_00_01_082; //起病情况描述 
$ws_emr10_01->emr10_00_01_083 = $emr10_00_01_083; //症状开始原因/诱因 
$ws_emr10_01->emr10_00_01_084 = $emr10_00_01_084; //症状特点 
$ws_emr10_01->emr10_00_01_085 = $emr10_00_01_085; //伴随症状 
$ws_emr10_01->emr10_00_01_086 = $emr10_00_01_086; //本疾病既往诊疗经过 
$ws_emr10_01->emr10_00_01_087 = $emr10_00_01_087; //起病后一般情况 
$ws_emr10_01->emr10_00_01_088 = $emr10_00_01_088; //基础疾病诊疗情况 
$ws_emr10_01->emr10_00_01_091 = $emr10_00_01_091; //既往观察-项目名称 
$ws_emr10_01->emr10_00_01_092 = $emr10_00_01_092; //既往观察-项目分类代码 
$ws_emr10_01->emr10_00_01_093 = $emr10_00_01_093; //既往观察-项目代码名称 
$ws_emr10_01->emr10_00_01_094 = $emr10_00_01_094; //既往观察-项目代码 
$ws_emr10_01->emr10_00_01_095 = $emr10_00_01_095; //既往观察-方法代码 
$ws_emr10_01->emr10_00_01_096 = $emr10_00_01_096; //既往观察-结果 
$ws_emr10_01->emr10_00_01_097 = $emr10_00_01_097; //既往史观察项目类目名称 
$ws_emr10_01->emr10_00_01_098 = $emr10_00_01_098; //既往史观察结果 
$ws_emr10_01->emr10_00_01_101 = $emr10_00_01_101; //观察-类别 
$ws_emr10_01->emr10_00_01_102 = $emr10_00_01_102; //观察-类别代码 
$ws_emr10_01->emr10_00_01_103 = $emr10_00_01_103; //观察项目名称 
$ws_emr10_01->emr10_00_01_104 = $emr10_00_01_104; //观察-项目代码 
$ws_emr10_01->emr10_00_01_105 = $emr10_00_01_105; //观察-结果描述 
$ws_emr10_01->emr10_00_01_106 = $emr10_00_01_106; //观察-结果(数值) 
$ws_emr10_01->emr10_00_01_107 = $emr10_00_01_107; //观察-计量单位 
$ws_emr10_01->emr10_00_01_108 = $emr10_00_01_108; //观察-结果代码 
$ws_emr10_01->emr10_00_01_109 = $emr10_00_01_109; //检查部位 
$ws_emr10_01->emr10_00_01_110 = $emr10_00_01_110; //检查部位代码 
$ws_emr10_01->emr10_00_01_121 = $emr10_00_01_121; //观察-类别 
$ws_emr10_01->emr10_00_01_122 = $emr10_00_01_122; //观察-类别代码 
$ws_emr10_01->emr10_00_01_123 = $emr10_00_01_123; //观察项目名称 
$ws_emr10_01->emr10_00_01_124 = $emr10_00_01_124; //观察-项目代码 
$ws_emr10_01->emr10_00_01_125 = $emr10_00_01_125; //观察-结果描述 
$ws_emr10_01->emr10_00_01_126 = $emr10_00_01_126; //观察-结果(数值) 
$ws_emr10_01->emr10_00_01_127 = $emr10_00_01_127; //观察-计量单位 
$ws_emr10_01->emr10_00_01_128 = $emr10_00_01_128; //观察-结果代码 
$ws_emr10_01->emr10_00_01_131 = $emr10_00_01_131; //诊断机构名称 
$ws_emr10_01 ->emr10_00_01_132 = empty($emr10_00_01_132)?null : $ws_emr10_01 ->escape('emr10_00_01_132',to_date($emr10_00_01_132,'YYYY-MM-DD')); //诊断日期 
$ws_emr10_01->emr10_00_01_133 = $emr10_00_01_133; //诊断类别 
$ws_emr10_01->emr10_00_01_134 = $emr10_00_01_134; //诊断类别代码 
$ws_emr10_01->emr10_00_01_135 = $emr10_00_01_135; //诊断顺位（从属关系）代码 
$ws_emr10_01->emr10_00_01_136 = $emr10_00_01_136; //疾病名称 
$ws_emr10_01->emr10_00_01_137 = $emr10_00_01_137; //疾病代码 
$ws_emr10_01->emr10_00_01_138 = $emr10_00_01_138; //诊断依据 
$ws_emr10_01->emr10_00_01_139 = $emr10_00_01_139; //诊断依据代码 
$ws_emr10_01->emr10_00_01_141 = $emr10_00_01_141; //拟做的检查 
$ws_emr10_01->emr10_00_01_142 = $emr10_00_01_142; //拟做的医学检验 
$ws_emr10_01->emr10_00_01_143 = $emr10_00_01_143; //今后治疗方案 
$ws_emr10_01->emr10_00_01_144 = $emr10_00_01_144; //随访标志 
$ws_emr10_01->emr10_00_01_145 = $emr10_00_01_145; //随访间隔（随诊期限） 
$ws_emr10_01->emr10_00_01_146 = $emr10_00_01_146; //医嘱 
$ws_emr10_01->emr10_00_01_147 = $emr10_00_01_147; //特别注意事项 
if($ws_emr10_01 ->insert()){
	return true;
}else{
	return false;
}
$ws_emr10_01 ->free_statement();
}
