<?php
/**
 * author：ct 
 * created 2012.3.29
 * 对于地区信息设置的所有操作
 */
  class api_system_region
  {
	  	/**
		 * 验证是否登录
		 *
		 * @param unknown_type $org_id
		 * @param unknown_type $password
		 * @return unknowna
		 */
		function ws_login($org_id,$password){
			return login($org_id,$password);
		}
		/**
		 * 用于获取地区的所有信息
		 *
		 * @param unknown_type $token
		 * @param unknown_type $xml_string
		 */
		function ws_region_register_get_all_region_info($token,$xml_string){
		     require_once(__SITEROOT.'library/Models/region.php');
		     require_once(__SITEROOT.'library/Models/organization.php');
		     //定义xml头和尾
		     $xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
		     $xmlend  = "</message>";
		     $getxml  = new SimpleXMLElement($xml_string);
		     $row     = $getxml->table;
		     $sussesString = '';//成功显示的字符串
		     $errorString  = '';//失败显示的字符串
		     $successNumber = 0;
		     $errorNumber  = 0;
		     $return_string  = '<tables><table name="region">'; 
		     foreach($row as $k=>$v)
		     {
		     	foreach($v->row as $kk=>$vv)
		     	{
			     	//查找机构是否存在
			     	$organization = new Torganization();
			     	$organization->whereAdd("standard_code='$vv->org_id'");
			     	if($organization->count()!=1)
			     	{
			     		//不存在机构的时候
			     		$errorString.= "机构标准码为".$vv->org_id."的机构不存在";
			     		$errorNumber++;
			     		continue;
			     	}
			     	else
			     	{	
			     		//存在机构的时候
			     		$organization->find(true);
			     		$org_path                 =  $organization->region_path;//获取机构中的region_path
			     		$org_region_path_domain   =  $organization->region_path_domain;//获取机构管辖范围
			     		$region_path_domain_array =  explode('|',$org_region_path_domain);
			     		foreach($region_path_domain_array as $k_domain=>$v_domain)
			     		{
			     			$region = new Tregion();
			     			$region->whereAdd("region_path like '$v_domain%'");
			     			$region->find();
			     			while ($region->fetch())
			     			{
			     				$zh_name = '';
			     				$standard_code_path  = $region->standard_code_path;//地区标准码
			     				//获取查询到的region_path
			     				$current_path        = $region->region_path;
			     				$current_path_array  = explode(',',$current_path);
			     				//取出region_path的每个ID查找中文名称
			     				foreach ($current_path_array as $k=>$v)
			     				{
			     				    $current_region      = new Tregion();
			     				    $current_region->whereAdd("id='$v'");
			     				    $current_region->whereAdd("id<>'0'");
			     				    $current_region->find(true);
			     				    $zh_name.=$current_region->zh_name;
			     				    $current_region->free_statement();
			     				}
			     				$return_string.='<row><zh_name>'.$zh_name.'</zh_name><standard_code_path>'.$standard_code_path.'</standard_code_path></row>';
			     			}
			     			$region->free_statement();	 
			     		} 
			     		$successNumber++;//成功的条数
			     	}
		     	}		     	
		     	$organization->free_statement(); 	
		     }
		     $return_string.='</table></tables>'; 
		    return $xmlhead.$return_string.'<error_string>有'.$errorNumber.'条错误'.$errorString.'</error_string><success_string>'.$successNumber.'条数据获取地区信息成功</success_string>'.$xmlend;
		}
	/**
	 * 设置区域信息ws_region_register_set_region_info
	 * 用于取得地区信息后对地区信息进行改变
	 * 只修改地区名和地区标准码
	 */
	function ws_region_register_set_region_info($token,$xml_string)
	{
	    //获取登录机构权限
		/*$mask_token		= check_token($token);//验证令牌 	
		if($mask_token==2){
			//令牌错误
			$xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>令牌错误</return_string></message>";
			return $xml_string;	
		}elseif($mask_token==3){
			//令牌过期
			$xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>3</return_code><return_string>令牌过期</return_string></message>";
			return $xml_string;
		}elseif($mask_token!==1){
			//请先登陆
			$xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>4$mask_token</return_code><return_string>请先登陆</return_string></message>";
			return $xml_string;
		}*/
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/Models/organization.php');	 
		//定义xml头和尾
	     $xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
	     $xmlend  = "</message>";
	     $getxml  = new SimpleXMLElement($xml_string);
	     $row     = $getxml->table;
	     $sussesString = '';//成功显示的字符串
	     $errorString  = '';//失败显示的字符串
	     $successNumber = 0;
	     $errorNumber  = 0;
	     $return_string  = '<tables><table name="region">'; 
	     foreach($row as $k=>$v)
	     {
	     	foreach($v->row as $kk=>$vv)
	     	{
	     	   //判断地区标准编码
	     	   if($vv->standard_code_path=="")
	     	   {
	     	   	   //判断standard_code_path为空的时候
	     			$errorString.='地区标准代码路径不能为空';
	     			$errorNumber++;
	     			continue;
	     	   } 
	     	   else
	     	   {
	     	   	   //判断地区路径不存在的时候
	     	   	   $region = new Tregion();
	     	   	   $region->whereAdd("standard_code_path='$vv->standard_code_path'");
	     	   	   if($region->count()!=1)
	     			{
	     				$errorString.= "地区标准代码路径为".$vv->standard_code_path."的地区不存在";
			     		$errorNumber++;
			     		continue;
	     			}
	     			else
	     			{
	     				$region->find(true);
	     				$regionid   =   $region->id;
	     				//不为空且存在地区标准代码路径的情况
	     				$region_update = new Tregion();
	     				$region_update->whereAdd("id='$regionid'");
	     				if(!empty($vv->zh_name))
	     				{
	     					//地区名称不为空时进行更新
	     					$region_update->zh_name       =  $vv->zh_name;
	     				}
	     				if(!empty($vv->standard_code))
	     				{
	     					//sttandard_code不为空时进行更新 然后还需要更新 standard_code_path
	     					$region_update->standard_code =  $vv->standard_code;
	     					$standard_code_array = explode(',',$vv->standard_code_path);
	     					$array_count = count($standard_code_array);
	     					$standard_code_array[$array_count-1] = $vv->standard_code;
	                        $newstring   = implode(',',$standard_code_array);
	                        $region_update->standard_code_path  = $newstring;
	     				}
	     				if($region_update->update())
	     				{
	     					//查询得到的新的值
	     					$newregion  = new Tregion();
	     					$newregion->whereAdd("id='$regionid'");
	     					$newregion->find(true);
	     					$return_string.="<row><standard_code_path>$newregion->standard_code_path</standard_code_path><zh_name>$newregion->zh_name</zh_name><standard_code>$newregion->standard_code</standard_code></row>";
	     					$newregion->free_statement();
	     					$successNumber++;
	     				}
	     				else
	     				{
	     					$errorString.= "地区标准代码路径为".$vv->standard_code_path."的地区更新失败";
	     					$errorNumber++;
	     					continue;
	     				}
	     			}
	     			$region_update->free();
	     			$region->free();
	     	   }     	   
	     	}
	     }
	     $return_string.="</table></tables>";
	     return  $xmlhead.$return_string.$xmlend."<error_string>".$errorString."更新失败".$errorNumber."条</error_string><success_string>成功更新".$successNumber."条</success_string>".$xmlend;
	}
  }
?>