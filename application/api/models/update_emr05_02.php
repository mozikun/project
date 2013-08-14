<?php
/**
电子病历基础模板：治疗处置-助产记录数据集EMR05.02电子病历基础模板：治疗处置-助产记录数据集
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $emr05_02_01_001  文档标识-名称 
* @param string $emr05_02_01_002  文档标识-类别代码
* @param string $emr05_02_01_003  文档标识-管理机构名称
* @param string $emr05_02_01_004  文档标识-管理机构组织机构代码（法人代码）
* @param string $emr05_02_01_005  文档标识-号码 
* @param date $emr05_02_01_006  文档标识-生效日期 
* @param date $emr05_02_01_007  文档标识-失效日期 
* @param string $emr05_02_01_011  姓名-标识对象 
* @param string $emr05_02_01_012  姓名-标识对象代码 
* @param string $emr05_02_01_013  姓名* 
* @param string $emr05_02_01_014  标识号-类别代码 
* @param string $emr05_02_01_015  标识号-号码*
* @param date $emr05_02_01_016  标识号-生效日期
* @param date $emr05_02_01_017  标识号-失效日期 
* @param string $emr05_02_01_018  标识号-提供标识的机构名称 
* @param date $emr05_02_01_021  出生日期*
* @param string $emr05_02_01_022  出生地*
* @param string $emr05_02_01_023  性别代码 
* @param decimal $emr05_02_01_024  年龄（岁）*
* @param string $emr05_02_01_025  国籍代码
* @param string $emr05_02_01_026  民族代码 
* @param string $emr05_02_01_027  婚姻状况类别代码
* @param string $emr05_02_01_028  职业编码系统名称 
* @param string $emr05_02_01_029  职业代码
* @param string $emr05_02_01_030  文化程度代码 
* @param string $emr05_02_01_041  机构名称
* @param string $emr05_02_01_042  机构组织机构代码
* @param string $emr05_02_01_043  机构负责人（法人）
* @param string $emr05_02_01_044  机构地址
* @param string $emr05_02_01_045  科室名称
* @param string $emr05_02_01_046  机构角色
* @param string $emr05_02_01_047  机构角色代码
* @param string $emr05_02_01_051  服务者姓名*
* @param string $emr05_02_01_052  服务者职责（角色）
* @param string $emr05_02_01_053  服务者职责（角色）代码
* @param string $emr05_02_01_054  服务者医师资格标志 *
* @param string $emr05_02_01_055  服务者学历 *
* @param string $emr05_02_01_056  服务者所学专业* 
* @param string $emr05_02_01_057  服务者专业技术职称*
* @param string $emr05_02_01_058  服务者职务* 
* @param string $emr05_02_01_061  观察-类别
* @param string $emr05_02_01_062  观察-类别代码
* @param string $emr05_02_01_063  观察项目名称
* @param string $emr05_02_01_064  观察-项目代码
* @param string $emr05_02_01_065  观察-结果描述
* @param decimal $emr05_02_01_066  观察-结果(数值)
* @param string $emr05_02_01_067  观察-计量单位
* @param string $emr05_02_01_068  观察-结果代码
* @param string $emr05_02_01_069  体格检查项目类目名称
* @param string $emr05_02_01_070  体格检查观察结果
* @param string $emr05_02_01_081  生育史观察项目数据组
* @param string $emr05_02_01_082  生育史观察结果
* @param date $emr05_02_01_091  预产期
* @return boolean
*/
function update_emr05_02($ws_id,$org_id,$doctor_id,$identity_number,$emr05_02_01_001='',$emr05_02_01_002='',$emr05_02_01_003='',$emr05_02_01_004='',$emr05_02_01_005='',$emr05_02_01_006='',$emr05_02_01_007='',$emr05_02_01_011='',$emr05_02_01_012='',$emr05_02_01_013='',$emr05_02_01_014='',$emr05_02_01_015='',$emr05_02_01_016='',$emr05_02_01_017='',$emr05_02_01_018='',$emr05_02_01_021='',$emr05_02_01_022='',$emr05_02_01_023='',$emr05_02_01_024=0,$emr05_02_01_025='',$emr05_02_01_026='',$emr05_02_01_027='',$emr05_02_01_028='',$emr05_02_01_029='',$emr05_02_01_030='',$emr05_02_01_041='',$emr05_02_01_042='',$emr05_02_01_043='',$emr05_02_01_044='',$emr05_02_01_045='',$emr05_02_01_046='',$emr05_02_01_047='',$emr05_02_01_051='',$emr05_02_01_052='',$emr05_02_01_053='',$emr05_02_01_054='',$emr05_02_01_055='',$emr05_02_01_056='',$emr05_02_01_057='',$emr05_02_01_058='',$emr05_02_01_061='',$emr05_02_01_062='',$emr05_02_01_063='',$emr05_02_01_064='',$emr05_02_01_065='',$emr05_02_01_066=0,$emr05_02_01_067='',$emr05_02_01_068='',$emr05_02_01_069='',$emr05_02_01_070='',$emr05_02_01_081='',$emr05_02_01_082='',$emr05_02_01_091=''){
require_once(__SITEROOT.'library/Models/ws_emr05_02.php');
$table_obj="Tws_emr05_02";
$ws_emr05_02=new $table_obj();
$ws_emr05_02 -> ws_id=$ws_id;
$ws_emr05_02 -> uuid=uniqid('',true);
$ws_emr05_02 -> created=time();
$ws_emr05_02 -> org_id=$org_id;
$ws_emr05_02 -> doctor_id=$doctor_id;
$ws_emr05_02 -> identity_number=$identity_number;//身份证号
$ws_emr05_02 -> action='insert';
$ws_emr05_02->emr05_02_01_001 = $emr05_02_01_001; //文档标识-名称  
$ws_emr05_02->emr05_02_01_002 = $emr05_02_01_002; //文档标识-类别代码 
$ws_emr05_02->emr05_02_01_003 = $emr05_02_01_003; //文档标识-管理机构名称 
$ws_emr05_02->emr05_02_01_004 = $emr05_02_01_004; //文档标识-管理机构组织机构代码（法人代码） 
$ws_emr05_02->emr05_02_01_005 = $emr05_02_01_005; //文档标识-号码  
$ws_emr05_02 ->emr05_02_01_006 = empty($emr05_02_01_006)?null : $ws_emr05_02 ->escape('emr05_02_01_006',to_date($emr05_02_01_006,'YYYY-MM-DD')); //文档标识-生效日期  
$ws_emr05_02 ->emr05_02_01_007 = empty($emr05_02_01_007)?null : $ws_emr05_02 ->escape('emr05_02_01_007',to_date($emr05_02_01_007,'YYYY-MM-DD')); //文档标识-失效日期  
$ws_emr05_02->emr05_02_01_011 = $emr05_02_01_011; //姓名-标识对象  
$ws_emr05_02->emr05_02_01_012 = $emr05_02_01_012; //姓名-标识对象代码  
$ws_emr05_02->emr05_02_01_013 = $emr05_02_01_013; //姓名*  
$ws_emr05_02->emr05_02_01_014 = $emr05_02_01_014; //标识号-类别代码  
$ws_emr05_02->emr05_02_01_015 = $emr05_02_01_015; //标识号-号码* 
$ws_emr05_02 ->emr05_02_01_016 = empty($emr05_02_01_016)?null : $ws_emr05_02 ->escape('emr05_02_01_016',to_date($emr05_02_01_016,'YYYY-MM-DD')); //标识号-生效日期 
$ws_emr05_02 ->emr05_02_01_017 = empty($emr05_02_01_017)?null : $ws_emr05_02 ->escape('emr05_02_01_017',to_date($emr05_02_01_017,'YYYY-MM-DD')); //标识号-失效日期  
$ws_emr05_02->emr05_02_01_018 = $emr05_02_01_018; //标识号-提供标识的机构名称  
$ws_emr05_02 ->emr05_02_01_021 = empty($emr05_02_01_021)?null : $ws_emr05_02 ->escape('emr05_02_01_021',to_date($emr05_02_01_021,'YYYY-MM-DD')); //出生日期* 
$ws_emr05_02->emr05_02_01_022 = $emr05_02_01_022; //出生地* 
$ws_emr05_02->emr05_02_01_023 = $emr05_02_01_023; //性别代码  
$ws_emr05_02->emr05_02_01_024 = $emr05_02_01_024; //年龄（岁）* 
$ws_emr05_02->emr05_02_01_025 = $emr05_02_01_025; //国籍代码 
$ws_emr05_02->emr05_02_01_026 = $emr05_02_01_026; //民族代码  
$ws_emr05_02->emr05_02_01_027 = $emr05_02_01_027; //婚姻状况类别代码 
$ws_emr05_02->emr05_02_01_028 = $emr05_02_01_028; //职业编码系统名称  
$ws_emr05_02->emr05_02_01_029 = $emr05_02_01_029; //职业代码 
$ws_emr05_02->emr05_02_01_030 = $emr05_02_01_030; //文化程度代码  
$ws_emr05_02->emr05_02_01_041 = $emr05_02_01_041; //机构名称 
$ws_emr05_02->emr05_02_01_042 = $emr05_02_01_042; //机构组织机构代码 
$ws_emr05_02->emr05_02_01_043 = $emr05_02_01_043; //机构负责人（法人） 
$ws_emr05_02->emr05_02_01_044 = $emr05_02_01_044; //机构地址 
$ws_emr05_02->emr05_02_01_045 = $emr05_02_01_045; //科室名称 
$ws_emr05_02->emr05_02_01_046 = $emr05_02_01_046; //机构角色 
$ws_emr05_02->emr05_02_01_047 = $emr05_02_01_047; //机构角色代码 
$ws_emr05_02->emr05_02_01_051 = $emr05_02_01_051; //服务者姓名* 
$ws_emr05_02->emr05_02_01_052 = $emr05_02_01_052; //服务者职责（角色） 
$ws_emr05_02->emr05_02_01_053 = $emr05_02_01_053; //服务者职责（角色）代码 
$ws_emr05_02->emr05_02_01_054 = $emr05_02_01_054; //服务者医师资格标志 * 
$ws_emr05_02->emr05_02_01_055 = $emr05_02_01_055; //服务者学历 * 
$ws_emr05_02->emr05_02_01_056 = $emr05_02_01_056; //服务者所学专业*  
$ws_emr05_02->emr05_02_01_057 = $emr05_02_01_057; //服务者专业技术职称* 
$ws_emr05_02->emr05_02_01_058 = $emr05_02_01_058; //服务者职务*  
$ws_emr05_02->emr05_02_01_061 = $emr05_02_01_061; //观察-类别 
$ws_emr05_02->emr05_02_01_062 = $emr05_02_01_062; //观察-类别代码 
$ws_emr05_02->emr05_02_01_063 = $emr05_02_01_063; //观察项目名称 
$ws_emr05_02->emr05_02_01_064 = $emr05_02_01_064; //观察-项目代码 
$ws_emr05_02->emr05_02_01_065 = $emr05_02_01_065; //观察-结果描述 
$ws_emr05_02->emr05_02_01_066 = $emr05_02_01_066; //观察-结果(数值) 
$ws_emr05_02->emr05_02_01_067 = $emr05_02_01_067; //观察-计量单位 
$ws_emr05_02->emr05_02_01_068 = $emr05_02_01_068; //观察-结果代码 
$ws_emr05_02->emr05_02_01_069 = $emr05_02_01_069; //体格检查项目类目名称 
$ws_emr05_02->emr05_02_01_070 = $emr05_02_01_070; //体格检查观察结果 
$ws_emr05_02->emr05_02_01_081 = $emr05_02_01_081; //生育史观察项目数据组 
$ws_emr05_02->emr05_02_01_082 = $emr05_02_01_082; //生育史观察结果 
$ws_emr05_02 ->emr05_02_01_091 = empty($emr05_02_01_091)?null : $ws_emr05_02 ->escape('emr05_02_01_091',to_date($emr05_02_01_091,'YYYY-MM-DD')); //预产期 
if($ws_emr05_02 ->insert()){
	return true;
}else{
	return false;
}
$ws_emr05_02 ->free_statement();
}
