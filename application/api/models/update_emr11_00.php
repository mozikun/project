<?php
/**
电子病历基础模板：住院医嘱数据集EMR11.00电子病历基础模板：住院医嘱数据集
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $emr11_00_01_016  姓名-标识对象*
* @param string $emr11_00_01_017  姓名-标识对象代码
* @param string $emr11_00_01_018  姓名* 
* @param string $emr11_00_01_021  机构名称
* @param string $emr11_00_01_022  机构组织机构代码
* @param string $emr11_00_01_023  机构负责人（法人）
* @param string $emr11_00_01_024  机构地址
* @param string $emr11_00_01_025  科室名称
* @param string $emr11_00_01_026  机构角色
* @param string $emr11_00_01_027  机构角色代码
* @param string $emr11_00_01_031  服务者姓名*
* @param string $emr11_00_01_032  服务者职责（角色）*
* @param string $emr11_00_01_033  服务者职责（角色）代码
* @param string $emr11_00_01_034  服务者医师资格标志*
* @param string $emr11_00_01_035  服务者学历*
* @param string $emr11_00_01_036  服务者所学专业*
* @param string $emr11_00_01_037  服务者专业技术职称*
* @param string $emr11_00_01_038  服务者职务*
* @param dateTime $emr11_00_01_041  医嘱开嘱日期时间
* @param dateTime $emr11_00_01_042  长期医嘱停嘱日期时间
* @param dateTime $emr11_00_01_043  医嘱执行日期时间
* @param string $emr11_00_01_044  医嘱执行时间类别代码
* @param dateTime $emr11_00_01_045  医嘱取消日期时间
* @param string $emr11_00_01_046  医嘱类别
* @param string $emr11_00_01_047  医嘱内容
* @param string $emr11_00_01_001  文档标识-名称 
* @param string $emr11_00_01_002  文档标识-类别代码
* @param string $emr11_00_01_003  文档标识-管理机构名称
* @param string $emr11_00_01_004  文档标识-管理机构组织机构代码（法人代码）
* @param string $emr11_00_01_005  文档标识-号码 
* @param date $emr11_00_01_006  文档标识-生效日期 
* @param date $emr11_00_01_007  文档标识-失效日期 
* @param string $emr11_00_01_011  标识号-类别代码 
* @param string $emr11_00_01_012  标识号-号码 
* @param date $emr11_00_01_013  标识号-生效日期 
* @param date $emr11_00_01_014  标识号-失效日期 
* @param string $emr11_00_01_015  标识号-提供标识的机构名称 
* @return boolean
*/
function update_emr11_00($ws_id,$org_id,$doctor_id,$identity_number,$emr11_00_01_016='',$emr11_00_01_017='',$emr11_00_01_018='',$emr11_00_01_021='',$emr11_00_01_022='',$emr11_00_01_023='',$emr11_00_01_024='',$emr11_00_01_025='',$emr11_00_01_026='',$emr11_00_01_027='',$emr11_00_01_031='',$emr11_00_01_032='',$emr11_00_01_033='',$emr11_00_01_034='',$emr11_00_01_035='',$emr11_00_01_036='',$emr11_00_01_037='',$emr11_00_01_038='',$emr11_00_01_041='',$emr11_00_01_042='',$emr11_00_01_043='',$emr11_00_01_044='',$emr11_00_01_045='',$emr11_00_01_046='',$emr11_00_01_047='',$emr11_00_01_001='',$emr11_00_01_002='',$emr11_00_01_003='',$emr11_00_01_004='',$emr11_00_01_005='',$emr11_00_01_006='',$emr11_00_01_007='',$emr11_00_01_011='',$emr11_00_01_012='',$emr11_00_01_013='',$emr11_00_01_014='',$emr11_00_01_015=''){
require_once(__SITEROOT.'library/Models/ws_emr11_00.php');
$table_obj="Tws_emr11_00";
$ws_emr11_00=new $table_obj();
$ws_emr11_00 -> ws_id=$ws_id;
$ws_emr11_00 -> uuid=uniqid('',true);
$ws_emr11_00 -> created=time();
$ws_emr11_00 -> org_id=$org_id;
$ws_emr11_00 -> doctor_id=$doctor_id;
$ws_emr11_00 -> identity_number=$identity_number;//身份证号
$ws_emr11_00 -> action='insert';
$ws_emr11_00->emr11_00_01_016 = $emr11_00_01_016; //姓名-标识对象* 
$ws_emr11_00->emr11_00_01_017 = $emr11_00_01_017; //姓名-标识对象代码 
$ws_emr11_00->emr11_00_01_018 = $emr11_00_01_018; //姓名*  
$ws_emr11_00->emr11_00_01_021 = $emr11_00_01_021; //机构名称 
$ws_emr11_00->emr11_00_01_022 = $emr11_00_01_022; //机构组织机构代码 
$ws_emr11_00->emr11_00_01_023 = $emr11_00_01_023; //机构负责人（法人） 
$ws_emr11_00->emr11_00_01_024 = $emr11_00_01_024; //机构地址 
$ws_emr11_00->emr11_00_01_025 = $emr11_00_01_025; //科室名称 
$ws_emr11_00->emr11_00_01_026 = $emr11_00_01_026; //机构角色 
$ws_emr11_00->emr11_00_01_027 = $emr11_00_01_027; //机构角色代码 
$ws_emr11_00->emr11_00_01_031 = $emr11_00_01_031; //服务者姓名* 
$ws_emr11_00->emr11_00_01_032 = $emr11_00_01_032; //服务者职责（角色）* 
$ws_emr11_00->emr11_00_01_033 = $emr11_00_01_033; //服务者职责（角色）代码 
$ws_emr11_00->emr11_00_01_034 = $emr11_00_01_034; //服务者医师资格标志* 
$ws_emr11_00->emr11_00_01_035 = $emr11_00_01_035; //服务者学历* 
$ws_emr11_00->emr11_00_01_036 = $emr11_00_01_036; //服务者所学专业* 
$ws_emr11_00->emr11_00_01_037 = $emr11_00_01_037; //服务者专业技术职称* 
$ws_emr11_00->emr11_00_01_038 = $emr11_00_01_038; //服务者职务* 
$ws_emr11_00 ->emr11_00_01_041 = empty($emr11_00_01_041)?null : $ws_emr11_00 ->escape('emr11_00_01_041',to_date($emr11_00_01_041,'YYYY-MM-DD')); //医嘱开嘱日期时间 
$ws_emr11_00 ->emr11_00_01_042 = empty($emr11_00_01_042)?null : $ws_emr11_00 ->escape('emr11_00_01_042',to_date($emr11_00_01_042,'YYYY-MM-DD')); //长期医嘱停嘱日期时间 
$ws_emr11_00 ->emr11_00_01_043 = empty($emr11_00_01_043)?null : $ws_emr11_00 ->escape('emr11_00_01_043',to_date($emr11_00_01_043,'YYYY-MM-DD')); //医嘱执行日期时间 
$ws_emr11_00->emr11_00_01_044 = $emr11_00_01_044; //医嘱执行时间类别代码 
$ws_emr11_00 ->emr11_00_01_045 = empty($emr11_00_01_045)?null : $ws_emr11_00 ->escape('emr11_00_01_045',to_date($emr11_00_01_045,'YYYY-MM-DD')); //医嘱取消日期时间 
$ws_emr11_00->emr11_00_01_046 = $emr11_00_01_046; //医嘱类别 
$ws_emr11_00->emr11_00_01_047 = $emr11_00_01_047; //医嘱内容 
$ws_emr11_00->emr11_00_01_001 = $emr11_00_01_001; //文档标识-名称  
$ws_emr11_00->emr11_00_01_002 = $emr11_00_01_002; //文档标识-类别代码 
$ws_emr11_00->emr11_00_01_003 = $emr11_00_01_003; //文档标识-管理机构名称 
$ws_emr11_00->emr11_00_01_004 = $emr11_00_01_004; //文档标识-管理机构组织机构代码（法人代码） 
$ws_emr11_00->emr11_00_01_005 = $emr11_00_01_005; //文档标识-号码  
$ws_emr11_00 ->emr11_00_01_006 = empty($emr11_00_01_006)?null : $ws_emr11_00 ->escape('emr11_00_01_006',to_date($emr11_00_01_006,'YYYY-MM-DD')); //文档标识-生效日期  
$ws_emr11_00 ->emr11_00_01_007 = empty($emr11_00_01_007)?null : $ws_emr11_00 ->escape('emr11_00_01_007',to_date($emr11_00_01_007,'YYYY-MM-DD')); //文档标识-失效日期  
$ws_emr11_00->emr11_00_01_011 = $emr11_00_01_011; //标识号-类别代码  
$ws_emr11_00->emr11_00_01_012 = $emr11_00_01_012; //标识号-号码  
$ws_emr11_00 ->emr11_00_01_013 = empty($emr11_00_01_013)?null : $ws_emr11_00 ->escape('emr11_00_01_013',to_date($emr11_00_01_013,'YYYY-MM-DD')); //标识号-生效日期  
$ws_emr11_00 ->emr11_00_01_014 = empty($emr11_00_01_014)?null : $ws_emr11_00 ->escape('emr11_00_01_014',to_date($emr11_00_01_014,'YYYY-MM-DD')); //标识号-失效日期  
$ws_emr11_00->emr11_00_01_015 = $emr11_00_01_015; //标识号-提供标识的机构名称  
if($ws_emr11_00 ->insert()){
	return true;
}else{
	return false;
}
$ws_emr11_00 ->free_statement();
}
