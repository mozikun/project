<?php
//require_once __SITEROOT.'/library/data_arr/arrdata.php';//数据字典
require_once __SITEROOT.'/library/Models/clinical_history.php';//慢病确症表
//$disease_history=array('1'=>array('1','无'),'2'=>array('2','高血压'),'3'=>array('3','糖尿病'),'4'=>array('4','冠心病'),'5'=>array('5','慢性阻塞性肺疾病'),'6'=>array('6','恶性肿瘤'),'7'=>array('7','脑卒中'),'8'=>array('8','重性精神病'),'9'=>array('9','结核病'),'10'=>array('10','肝炎'),'11'=>array('11','其他法定传染病'),'12'=>array('-99','其他'));
/**
 * 既往病史确证
 *
 * @param string $iha_id 个人档案号
 * @param int $disease_code 确症疾病代码
 * @param int $disease_date 确症日期
 * @return number
 */
function is_clinical_history($iha_id,$disease_code,$disease_date=0){
	if($iha_id==='' && $disease_code==''){
		throw new Exception('参数错误！');
	}
	$clinical_history		= new Tclinical_history();
	$clinical_history ->whereAdd("id='$iha_id'");//
	if(!empty($disease_date)){
		$clinical_history->whereAdd("disease_date>=$disease_date");//确症时间
	}
	$clinical_history ->whereAdd("disease_code=$disease_code");//疾病代码
	$count					= $clinical_history ->count('*');
	$clinical_history ->free_statement();
	return $count;

}