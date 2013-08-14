<?php

require_once __SITEROOT."library/Models/tips.php";//工作计划
require_once __SITEROOT."library/Models/tips_type.php";//工作计划类型
/**
 * 添加、修改工作计划 参数 $staff_id(登录人id),$serial_number(居民档案号),$region_path(所属路径),$tips_time(计划完成时间戳),$tips_url(查看路径),$tips_serial(计划制定医生),$tips_info(备注),$tips_follow_time(随访时间)
 *
 * @param String $staff_id
 * @param String $serial_number
 * @param String $region_path
 * @param String $title
 * @param String $tips_type
 * @param String $tips_time
 * @param String $tips_url
 * @param String $tips_serial
 * @param String $tips_info
 * @param String $tips_follow_time
 */
function update_tips($staff_id,$serial_number,$region_path,$title,$tips_type,$tips_time,$tips_url,$tips_serial,$tips_info="",$tips_follow_time=""){
	$num=func_num_args();
	if($num<8){
		throw new Exception('参数错误！');
	}
	//检查工作计划类型存在与否
	if(!is_exist_tips_type($tips_type)){
		throw new Exception("你指定的 types_type 不存");
	}	
	$tips=new Ttips();
	$uuid=check_repeat_tips($tips_url)==""?'':check_repeat_tips($tips_url);//判断当前uuid是否重复
	
	//var_dump($uuid);
	$tips->staff_id=$staff_id;//记录本记录医生号
	$tips->id=$serial_number;//个人档案号
	$tips->region_path=$region_path;//路径
	$tips->title=$title;//标题
	$tips->tips_type=$tips_type;//工作计划类别
	$tips->tips_time=$tips_time;//工作计划完成时间
	$tips->tips_url=$tips_url;//查看工作计划页面
	$tips->tips_serial=$tips_serial;//制定工作计划医生号
	$tips->tips_info=$tips_info;//备注
	if($uuid){
		$tips->whereAdd("uuid='{$uuid}'");
		$tips->update();
	}else{
		if($tips_follow_time)
		{
			$tips->created=$tips_follow_time;
		}
		else 
		{
		    $tips->created=time();
		}
		$tips->state='0';//状态
		$tips->uuid=uniqid('tp_',true);
		$tips->insert();
	}
}
/**
 * 判断地址是否出现重复,如果重复返回uuid
 *
 * @param String $tips_url
 * @return String
 */
function check_repeat_tips($tips_url=""){
	$uuid='';
	if($tips_url!=''){
			$tips=new Ttips();
			//$tips->debugLevel(3);
			$tips->whereAdd("tips_url='{$tips_url}'");
			$tips->find();
			$tips->fetch();
			$uuid=$tips->uuid;
	}
	return $uuid;
}
/**
 * 查看工作计划类型的ID存在与否
 *
 * @param String $tips_type_id
 * @return number
 */
function is_exist_tips_type($tips_type_id){
	$tips_type=new Ttips_type();
	$tips_type->whereAdd("id='{$tips_type_id}'");
	$count=$tips_type->count();
	return $count;
}