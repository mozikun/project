<?php
/**
 * 编码验证接口
 * @author CT
 */
require_once('api_phs_common.php');
class api_phs_verify
{
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $org_id
	 * @param unknown_type $password
	 * @return unknowna
	 */
	function ws_login($org_id,$password)
	{
		//return 'ok';
		return login($org_id,$password);
	}
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $token
	 * @param unknown_type $xml_string
	 */
	 function ws_verify($token,$xml_string)
	 {
	 	require_once __SITEROOT."library/Models/medicine.php";//药品表
	 	require_once __SITEROOT.'library/Models/disease_name.php';//疾病表
	 	require_once __SITEROOT.'library/Models/materials.php';//耗材表
	 	require_once __SITEROOT.'library/Models/clinic_code.php';;//诊疗项目表
	 	$xml_obj = new SimpleXMLElement($xml_string);
	 	$xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
		$xmlend  = "</message>";
	 	$error_number = 0;
	 	$empty_number = 0;
	 	$success_number = 0;
	 	$errorstring = '';
	 	$successstring = '';
	 	$success_str = '';
	 	foreach ($xml_obj as $k=>$table)
	 	{
	 		$table_name = $table['name'];//数据表名称	
	 		foreach ($table as $row)
	 		{
	 			foreach($row as $key=>$val)
	 			{
		 			if(empty($row->standard_code))
		 			{
		 				$empty_number++;		
		 				continue;
		 			}
		 			else 
		 			{
		 				$obj_name = 'T'.$table_name;
		 				$obj = new $obj_name();
		 				if($table_name=='disease_name')
		 				{
		 					$colum_name='d_standard_code';
		 				}
		 				else 
		 				{
		 					$colum_name = 'standard_code';
		 				}
		 				$obj->whereAdd("$colum_name = '$row->standard_code'");
		 				if($obj->count()>0)
		 				{
		 					$success_number++;
		 					$success_str.="<table name='".$table_name."'><row><standard_code>".$row->standard_code."</standard_code></row></table>";
		 				}
		 				else 
		 				{
		 					$error_number++;
		 					$errorstring.="<table name='".$table_name."'><return_string>编码为".$row->standard_code."的数据校验失败</return_string></table>";
		 					continue;
		 				}
		 			}
	 		   }
	 	    }
	 	}
	 	return $xmlhead.$success_str.$errorstring.'<error_message>有'.$error_number.'条编码校验错误,有'.$empty_number.'条编码为空</error_message><success_message>有'.$success_number.'条编码校验成功</success_message>'.$xmlend;
	 }
}
