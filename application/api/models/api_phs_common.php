<?php

/**
 * 检查令牌是否正确
 *
 * @param string $token
 * @return string
 */
function check_token($token){
	
	/*if(substr_count($token,'|')!=1){
		//检查令牌格式
		$xml_string	= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>4</return_code><return_string>令牌格式错误</return_string></message>";
		return $xml_string;
	}*/
	$token_array		= explode('|',$token);
	
	$token_mask			= $token_array[0];//令牌头
	//$token_session_id	= $token_array[1];//令牌session_id
	$token_time			= $token_array[1];//令牌时间戳
	
	$mask				= md5('chinachis_2006_2011').md5($_SERVER['REMOTE_ADDR']);//默认认定的令牌头
	//$session_id			= session_id();//session_id
	//$session_id			= $_COOKIE['yaan_token'];//session_id 减少中联工作人员的麻烦去掉
	$time				= time();//现在时间戳
	
	
	if($token_mask!=$mask){
		//令牌错误 
		/*
		$xml_string	= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>令牌错误</return_string></message>";
		*/

		$xml_string=2;
	}elseif(($time-$token_time)>60*60){
		//检查令牌过期	
		/*
		$xml_string	= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>3</return_code><return_string>令牌过期</return_string></message>";
		*/
		$xml_string=3;
	}else{
		//正确
		/*
		$xml_string	= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>1</return_code><return_string>令牌正常</return_string></message>";
		*/
		$xml_string=1;
	}
	
	return $xml_string;
}