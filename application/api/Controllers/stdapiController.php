<?php
class api_stdapiController  extends controller {
public function indexAction(){
}
//死亡医学证明基本数据死亡医学证明基本数据
public function hrb03_12Action(){
	require_once(__SITEROOT."application/api/models/update_hrb03_12.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb03_12'));
	$server->handle();
}
//传染病报告基本数据传染病报告基本数据
public function hrb03_02Action(){
	require_once(__SITEROOT."application/api/models/update_hrb03_02.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb03_02'));
	$server->handle();
}
//艾滋病防治基本数据艾滋病防治基本数据
public function hrb03_04Action(){
	require_once(__SITEROOT."application/api/models/update_hrb03_04.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb03_04'));
	$server->handle();
}
//门诊诊疗基本数据门诊诊疗基本数据
public function hrc00_01Action(){
	require_once(__SITEROOT."application/api/models/update_hrc00_01.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrc00_01'));
	$server->handle();
}
//住院诊疗基本数据集住院诊疗基本数据集
public function hrc00_02Action(){
	require_once(__SITEROOT."application/api/models/update_hrc00_02.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrc00_02'));
	$server->handle();
}
//住院病案首页基本数据住院病案首页基本数据
public function hrc00_03Action(){
	require_once(__SITEROOT."application/api/models/update_hrc00_03.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrc00_03'));
	$server->handle();
}
//电子病历基础模板：门(急)诊处方数据集EMR03.00电子病历基础模板：门(急)诊处方数据集
public function emr03_00Action(){
	require_once(__SITEROOT."application/api/models/update_emr03_00.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr03_00'));
	$server->handle();
}
//电子病历基础模板：病历概要数据集EMR01.00电子病历基础模板：病历概要数据集
public function emr01_00Action(){
	require_once(__SITEROOT."application/api/models/update_emr01_00.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr01_00'));
	$server->handle();
}
//电子病历基础模板：门(急)诊病历数据集EMR02.00电子病历基础模板：门(急)诊病历数据集
public function emr02_00Action(){
	require_once(__SITEROOT."application/api/models/update_emr02_00.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr02_00'));
	$server->handle();
}
//电子病历基础模板：检查检验记录数据集EMR04.00电子病历基础模板：检查检验记录数据集
public function emr04_00Action(){
	require_once(__SITEROOT."application/api/models/update_emr04_00.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr04_00'));
	$server->handle();
}
//电子病历基础模板：治疗处置-一般治疗处置记录数据集EMR05.01电子病历基础模板：治疗处置-一般治疗处置记录数据集
public function emr05_01Action(){
	require_once(__SITEROOT."application/api/models/update_emr05_01.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr05_01'));
	$server->handle();
}
//电子病历基础模板：治疗处置-助产记录数据集EMR05.02电子病历基础模板：治疗处置-助产记录数据集
public function emr05_02Action(){
	require_once(__SITEROOT."application/api/models/update_emr05_02.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr05_02'));
	$server->handle();
}
//电子病历基础模板：护理-护理操作记录数据集EMR06.01电子病历基础模板：护理-护理操作记录数据集
public function emr06_01Action(){
	require_once(__SITEROOT."application/api/models/update_emr06_01.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr06_01'));
	$server->handle();
}
//电子病历基础模板：护理-护理评估与计划数据集EMR06.02电子病历基础模板：护理-护理评估与计划数据集
public function emr06_02Action(){
	require_once(__SITEROOT."application/api/models/update_emr06_02.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr06_02'));
	$server->handle();
}
//电子病历基础模板：知情告知信息数据集EMR07.00电子病历基础模板：知情告知信息数据集
public function emr07_00Action(){
	require_once(__SITEROOT."application/api/models/update_emr07_00.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr07_00'));
	$server->handle();
}
//电子病历基础模板：住院病案首页数据集EMR08.00电子病历基础模板：住院病案首页数据集
public function emr08_00Action(){
	require_once(__SITEROOT."application/api/models/update_emr08_00.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr08_00'));
	$server->handle();
}
//电子病历基础模板：住院志数据集EMR09.00电子病历基础模板：住院志数据集
public function emr09_00Action(){
	require_once(__SITEROOT."application/api/models/update_emr09_00.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr09_00'));
	$server->handle();
}
//电子病历基础模板：住院病程记录数据集（一）EMR10.01电子病历基础模板：住院病程记录数据集（一）
public function emr10_01Action(){
	require_once(__SITEROOT."application/api/models/update_emr10_01.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr10_01'));
	$server->handle();
}
//电子病历基础模板：住院病程记录数据集（二）EMR10.02电子病历基础模板：住院病程记录数据集（二）
public function emr10_02Action(){
	require_once(__SITEROOT."application/api/models/update_emr10_02.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr10_02'));
	$server->handle();
}
//电子病历基础模板：住院病程记录数据集（三）EMR10.03电子病历基础模板：住院病程记录数据集（三）
public function emr10_03Action(){
	require_once(__SITEROOT."application/api/models/update_emr10_03.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr10_03'));
	$server->handle();
}
//电子病历基础模板：住院医嘱数据集EMR11.00电子病历基础模板：住院医嘱数据集
public function emr11_00Action(){
	require_once(__SITEROOT."application/api/models/update_emr11_00.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr11_00'));
	$server->handle();
}
//电子病历基础模板：出院记录数据集EMR12.00电子病历基础模板：出院记录数据集
public function emr12_00Action(){
	require_once(__SITEROOT."application/api/models/update_emr12_00.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr12_00'));
	$server->handle();
}
//电子病历基础模板：转院记录数据集EMR13.00电子病历基础模板：转院记录数据集
public function emr13_00Action(){
	require_once(__SITEROOT."application/api/models/update_emr13_00.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr13_00'));
	$server->handle();
}
//电子病历基础模板：转诊记录数据集EMR14.00电子病历基础模板：转诊记录数据集
public function emr14_00Action(){
	require_once(__SITEROOT."application/api/models/update_emr14_00.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr14_00'));
	$server->handle();
}
//电子病历基础模板：医疗机构信息数据集EMR15.00电子病历基础模板：医疗机构信息数据集
public function emr15_00Action(){
	require_once(__SITEROOT."application/api/models/update_emr15_00.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_emr15_00'));
	$server->handle();
}
//个人信息基本数据个人信息基本数据
public function hra00_01Action(){
	require_once(__SITEROOT."application/api/models/update_hra00_01.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hra00_01'));
	$server->handle();
}
//预防接种基本数据预防接种基本数据
public function hrb03_01Action(){
	require_once(__SITEROOT."application/api/models/update_hrb03_01.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb03_01'));
	$server->handle();
}
//儿童健康体检基本数据集标准HRB01.03儿童健康体检基本数据集标准
public function hrb01_03Action(){
	require_once(__SITEROOT."application/api/models/update_hrb01_03.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb01_03'));
	$server->handle();
}
//出生医学证明基本数据集标准HRB01.01出生医学证明基本数据集标准
public function hrb01_01Action(){
	require_once(__SITEROOT."application/api/models/update_hrb01_01.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb01_01'));
	$server->handle();
}
//新生儿疾病筛查基本数据集标准HRB01.02新生儿疾病筛查基本数据集标准
public function hrb01_02Action(){
	require_once(__SITEROOT."application/api/models/update_hrb01_02.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb01_02'));
	$server->handle();
}
//体弱儿童管理基本数据集标准HRB01.04体弱儿童管理基本数据集标准
public function hrb01_04Action(){
	require_once(__SITEROOT."application/api/models/update_hrb01_04.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb01_04'));
	$server->handle();
}
//婚前保健服务基本数据集标准HRB02.01婚前保健服务基本数据集标准
public function hrb02_01Action(){
	require_once(__SITEROOT."application/api/models/update_hrb02_01.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb02_01'));
	$server->handle();
}
//妇女病普查基本数据集标准HRB02.02妇女病普查基本数据集标准
public function hrb02_02Action(){
	require_once(__SITEROOT."application/api/models/update_hrb02_02.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb02_02'));
	$server->handle();
}
//计划生育技术服务基本数据集标准HRB02.03计划生育技术服务基本数据集标准
public function hrb02_03Action(){
	require_once(__SITEROOT."application/api/models/update_hrb02_03.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb02_03'));
	$server->handle();
}
//孕产期保健服务与高危管理基本数据集标准HRB02.04孕产期保健服务与高危管理基本数据集标准
public function hrb02_04Action(){
	require_once(__SITEROOT."application/api/models/update_hrb02_04.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb02_04'));
	$server->handle();
}
//产前筛查与诊断基本数据集标准HRB02.05产前筛查与诊断基本数据集标准
public function hrb02_05Action(){
	require_once(__SITEROOT."application/api/models/update_hrb02_05.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb02_05'));
	$server->handle();
}
//出生缺陷监测基本数据集标准HRB02.06出生缺陷监测基本数据集标准
public function hrb02_06Action(){
	require_once(__SITEROOT."application/api/models/update_hrb02_06.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb02_06'));
	$server->handle();
}
//结核病防治基本数据集标准HRB03.03结核病防治基本数据集标准
public function hrb03_03Action(){
	require_once(__SITEROOT."application/api/models/update_hrb03_03.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb03_03'));
	$server->handle();
}
//血吸虫病病人管理基本数据集标准HRB03.05血吸虫病病人管理基本数据集标准
public function hrb03_05Action(){
	require_once(__SITEROOT."application/api/models/update_hrb03_05.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb03_05'));
	$server->handle();
}
//慢性丝虫病病人管理基本数据集标准HRB03.06慢性丝虫病病人管理基本数据集标准
public function hrb03_06Action(){
	require_once(__SITEROOT."application/api/models/update_hrb03_06.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb03_06'));
	$server->handle();
}
//职业病报告基本数据集标准HRB03.07职业病报告基本数据集标准
public function hrb03_07Action(){
	require_once(__SITEROOT."application/api/models/update_hrb03_07.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb03_07'));
	$server->handle();
}
//职业性健康监护基本数据集标准HRB03.08职业性健康监护基本数据集标准
public function hrb03_08Action(){
	require_once(__SITEROOT."application/api/models/update_hrb03_08.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb03_08'));
	$server->handle();
}
//伤害监测报告基本数据集标准HRB03.09伤害监测报告基本数据集标准
public function hrb03_09Action(){
	require_once(__SITEROOT."application/api/models/update_hrb03_09.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb03_09'));
	$server->handle();
}
//中毒报告基本数据集标准HRB03.10中毒报告基本数据集标准
public function hrb03_10Action(){
	require_once(__SITEROOT."application/api/models/update_hrb03_10.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb03_10'));
	$server->handle();
}
//行为危险因素监测基本数据集标准HRB03.11行为危险因素监测基本数据集标准
public function hrb03_11Action(){
	require_once(__SITEROOT."application/api/models/update_hrb03_11.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb03_11'));
	$server->handle();
}
//高血压病例管理基本数据集标准HRB04.01高血压病例管理基本数据集标准
public function hrb04_01Action(){
	require_once(__SITEROOT."application/api/models/update_hrb04_01.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb04_01'));
	$server->handle();
}
//糖尿病病例管理基本数据集标准HRB04.02糖尿病病例管理基本数据集标准
public function hrb04_02Action(){
	require_once(__SITEROOT."application/api/models/update_hrb04_02.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb04_02'));
	$server->handle();
}
//肿瘤病例管理基本数据集标准HRB04.03肿瘤病例管理基本数据集标准
public function hrb04_03Action(){
	require_once(__SITEROOT."application/api/models/update_hrb04_03.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb04_03'));
	$server->handle();
}
//精神分裂症病例管理基本数据集标准HRB04.04精神分裂症病例管理基本数据集标准
public function hrb04_04Action(){
	require_once(__SITEROOT."application/api/models/update_hrb04_04.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb04_04'));
	$server->handle();
}
//老年人健康管理基本数据集标准HRB04.05老年人健康管理基本数据集标准
public function hrb04_05Action(){
	require_once(__SITEROOT."application/api/models/update_hrb04_05.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrb04_05'));
	$server->handle();
}
//成人健康体检基本数据集标准HRC00.04成人健康体检基本数据集标准
public function hrc00_04Action(){
	require_once(__SITEROOT."application/api/models/update_hrc00_04.php");
	$server=new SoapServer(null, array('uri' => 'yawsw'));
	$server->addFunction(array('update_hrc00_04'));
	$server->handle();
}
}
