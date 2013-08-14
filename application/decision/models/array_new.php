<?php
 function change_array($array_name)
 {
 	$str ='';
 	foreach($array_name as $k=>$v)
 	{
 		$str.="'".$v[0]."'=>'".$v[1]."',";
 	}
 	$str = rtrim($str,',');
 	$str = 'array('.$str.');';
 	return $str;
 }
?>