<?php
require_once __SITEROOT."library/Models/region.php";
function getRegionArray($region_id){
	$region =new Tregion();
	$region ->whereAdd("p_id='$region_id'");
	$region ->find();
	$region_array=array();
	$i=0;
	while ($region->fetch()) {
		$region_array[$i]['id']			= $region->id;//机构号
		$region_array[$i]['p_id']		= $region->p_id;//上级机构号
		$region_array[$i]['zh_name']	= $region->zh_name;//机构名
		$region_array[$i]['region_path']= $region->region_path;//机构路径		
		$i++;
	}
	$region->free_statement();
	return  $region_array;
}

/**
	 * 每年按照规范要求进行管理的确诊慢病患者数
	 *
	 * @param String $area_id region_path路径
	 * @param string $table_name 表名
	 * @param string $followup_time 随访时间的时段
	 * @param integer $end_time 结束时间
	 * @param integer $disease_code 确症疾病代码
	 * @return String
	 */
	function standard($area_id,$table_name,$followup_time,$end_time,$disease_code){
		require_once __SITEROOT."library/Models/{$table_name}.php";
		$clinical_history = new Tclinical_history();//疾病确症
		$individual_core= new Tindividual_core();//个人档案
		$individual_core->selectAdd('individual_core.uuid');
		$clinical_history->selectAdd('id');
		$clinical_history->joinAdd('left',$clinical_history,$individual_core,'id','uuid');
		$clinical_history->whereAdd("clinical_history.disease_code='$disease_code'");//确症疾病代码
		$clinical_history->whereAdd("disease_state=1");//确症
		$clinical_history->whereAdd("INSTR(individual_core.region_path,'$area_id')>0");//指定区域
		$clinical_history->whereAdd("disease_date<$end_time");//确症时间小于结束时间
		//$clinical_history->debugLevel(3);
		$clinical_history->find();
		$serial_number_arr=array();
		while ($clinical_history->fetch()) {
			$serial_number_arr[]=$clinical_history->id;
		}
		$number=0;

		if(!empty($serial_number_arr)){
			$serial_number_list=implode('\',\'',$serial_number_arr);
			$start_time=mktime(0,0,0,1,1,date('Y',$end_time));//某一年的一月一日
			$ttable_name="T".$table_name;
			$table_name=new $ttable_name();
			$table_name->whereAdd("$followup_time>$start_time");
			$table_name->whereAdd("$followup_time<$end_time");
			$table_name->whereAdd("id in ('$serial_number_list')");
			$number=$table_name->count("DISTINCT id");
		}

		return  $number;
	}