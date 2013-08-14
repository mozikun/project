<?php
/**
 * author：ct 
 * created 2012.3.31
 * 对于机构信息设置的所有操作
 */
  class api_system_org
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
		 * 用于获取机构的所有信息
		 *
		 * @param unknown_type $token
		 * @param unknown_type $xml_string
		 */
		function ws_org_register_get_info($token,$xml_string){
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
		     $return_string  = '<tables><table name="organization">'; 
		     foreach($row as $k=>$v)
		     {
		     	foreach($v->row as $kk=>$vv)
		     	{
			     	//查找机构是否存在
			     	$organization = new Torganization();
			     	$organization->whereAdd("standard_code='$vv->org_id'");
			     	if($organization->count()==0)
			     	{
			     		//不存在机构的时候
			     		$errorString.= "原因是：机构标准码为".$vv->org_id."的机构不存在";
			     		$errorNumber++;
			     		continue;
			     	}
			     	else
			     	{	
			     		//存在机构的时候
			     		$organization->find(true);
			     		$org_path                 =  $organization->region_path;//获取机构中的region_path
			     		//形成完整的机构名称
			     		$current_region_array     =  explode(',',$org_path);
			     		$current_region_array[count($current_region_array)-1] = '';
			     	    $last_val                 =  rtrim(implode(',',$current_region_array),',');
			     	    $need_region              =  explode(',',$last_val);      
			     	    $org_all_name             =  '';
			     	    foreach ($need_region as $k=>$v)
			     	    {
			     	    	$org_region = new Tregion();
			     	    	$org_region->whereAdd("id<>0");
			     	    	$org_region->whereAdd("id='$v'");
			     	    	$org_region->find(true);
			     	    	$org_all_name.=$org_region->zh_name;
			     	    	$org_region->free_statement();
			     	    }
			     	    $org_all_name.=$organization->zh_name;//形成的完整机构名称
			     		$org_region_path_domain   =  $organization->region_path_domain;//获取机构管辖范围
			     		$return_string.='<row><org_zh_name>'.$org_all_name.'</org_zh_name><org_standard_code>'.$organization->standard_code.'</org_standard_code><domain>';
			     		//echo $org_region_path_domain;
			     		$tag_name  =  strpos($org_region_path_domain,'|');//判字符串有没有竖线 如果没有说明默认情况下该机构管辖的是所在的region_path地区
			     		//var_dump($tag_name);
			     		if($tag_name!==false)
			     		{
			     			//echo "22222222222";
				     		$region_path_domain_array =  explode('|',$org_region_path_domain);
				     		$i = 1;
				     		
				     		foreach($region_path_domain_array as $k_domain=>$v_domain)
				     		{
				     			$region = new Tregion();
				     			$region->whereAdd("region_path = '$v_domain'");
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
				     				$return_string.='<region_zh_name>'.$zh_name.'</region_zh_name><region_standard_code_path>'.$standard_code_path.'</region_standard_code_path>';
				     			}
				     			$i++;
				     			$region->free_statement();	 
				     		}
			     		}
			     		else
			     		{
			     			//该机构所在的当前默认地区管理所有的地区
			     			$lone_region = new Tregion();
			     			$lone_region->whereAdd("region_path='$org_path'");
			     			$lone_region->find(true);
			     			$current_path        = $lone_region->region_path;
		     				$current_path_array  = explode(',',$current_path);
		     				$zh_name = '';
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
			     			$return_string.='<region_zh_name>'.$zh_name.'</region_zh_name><region_standard_code_path>'.$lone_region->standard_code_path.'</region_standard_code_path>';
			     			$lone_region->free();
			     		}
			     		$return_string.='</domain></row>'; 
			     		$successNumber++;//成功的条数
			     	}
		     	}		     	
		     	$organization->free_statement(); 	
		     }
		     $return_string.='</table></tables>'; 
		    return $xmlhead.$return_string.'<error_string>有'.$errorNumber.'条错误'.$errorString.'</error_string><success_string>'.$successNumber.'条数据获取机构信息成功</success_string>'.$xmlend;
		}
	/**
	 * author:ct
	 * 获取上一级的所有机构、医生、科室等信息
	 * created:2012.4.18
	 */
	function ws_get_org_info($token,$xml_string)
	{        
		     require_once(__SITEROOT.'library/Models/organization.php');
		     require_once(__SITEROOT.'library/custom/comm_function.php');
		     require_once(__SITEROOT.'library/Models/staff_core.php');
		     require_once(__SITEROOT.'library/Models/staff_archive.php');
		     //定义xml头和尾
		     $xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message><orgnizations>";
		     $xmlend  = "</message>";
		     $getxml  = new SimpleXMLElement($xml_string);
		     $row     = $getxml->table;
		     //var_dump($row);
		     $sussesString = '';//成功显示的字符串
		     $errorString  = '';//失败显示的字符串
		     $successNumber = 0;
		     $errorNumber  = 0;
		     $return_string  = '';
		     foreach ($row as $k=>$v)
		     {
		     	foreach($v->row as $kk=>$vv)
		     	{
			     	//查找机构是否存在
			     	$organization = new Torganization();
			     	$organization->whereAdd("standard_code='$vv->org_id'");
			     	//echo $organization->count();
			     	if($organization->count()==0)
			     	{
			     		//不存在机构的时候
			     		$errorString.= "失败原因是：机构标准码为".$vv->org_id."的机构不存在,";
			     		$errorNumber++;
			     		continue;
			     	}
			     	else
			     	{
			     		$title=array('1'=>'正高','2'=>'副高','3'=>'中级','4'=>'助理（师级）','5'=>'员（士）','6'=>'待聘');//职称代码 
			     		$section_office_id=array('1'=>'预防保健科','2'=>'全科医疗科','3'=>'药房','4'=>'检验室','5'=>'X光室','6'=>'B超室','7'=>'心电图室','8'=>'消毒供应室','9'=>'信息资料室','10'=>'其它');
			     		$specialty_name=array('101'=>'基础医学','102'=>'预防医学','1031'=>'临床医学','1032'=>'医学技术','104'=>'口腔医学','105'=>'中医学','106'=>'法医学','107'=>'护理学','108'=>'药学','109'=>'卫生管理','01'=>'哲学','02'=>'经济学','03'=>'法学','04'=>'教育学','05'=>'文学','6'=>'历史学','07'=>'理学','08'=>'工学','09'=>'农学');//专业
			     		$specialty_code=array('11'=>'执业医师','12'=>'执业助理医师','13'=>'见习医师','21'=>'注册护士','22'=>'助产士','31'=>'西药师(士)','32'=>'中药师(士)','41'=>'检验技师(士)','42'=>'影像技师(士)','50'=>'卫生监督员','69'=>'其他卫生技术人员','70'=>'其他技术人员','80'=>'管理人员','90'=>'工勤及技能人员');
			     		$organizer=array('1'=>'在编','2'=>'非在编');//编制
			     		$type_of_work=array('1'=>'卫生技术人员','2'=>'其他技术人员','3'=>'管理人员','4'=>'工勤技能人员');//工种
			     		$manage_rank=array('1'=>'党委(副)书记','2'=>'院(所.站)长','3'=>'副院(所.站)长','4'=>'科室主任','5'=>'科室副主任');//行政/业务管理职务代码
			     		$physician_certified_type=array('1'=>'临床','2'=>'口腔','3'=>'公共卫生','4'=>'中医');//医师执业类别代码
			     		$physician_certified_rang=array('11'=>'内科专业','12'=>'外科专业','13'=>'妇产科专业','14'=>'儿科专业','15'=>'眼耳鼻咽喉科专业','16'=>'皮肤病与性病专业','17'=>'精神卫生专业','18'=>'职业病专业','19'=>'医学影像和放射治疗专业','20'=>'医学检验..病理专业','21'=>'全科医学专业','22'=>'急救医学专业','23'=>'康复医学专业','24'=>'预防保健专业','25'=>'特种医学与军事医学专业','26'=>'计划生育技术服务专业','31'=>'口腔科专业','41'=>'公共卫生类别专业','51'=>'中医专业','52'=>'中西医结合专业','53'=>'蒙医专业','54'=>'藏医专业','55'=>'维医专业','56'=>'傣医专业','57'=>'省级卫生行政部门规定的其他专业');//医师执业范围代码
			     		$organization->find(true);
			     		$region_array =  explode(',',$organization->region_path);
			     		$organization->free_statement();
			     		array_pop($region_array);//弹出最后一维,就是直接上一级
			     		$new_region_path = implode(',',$region_array);//重新组合成字符串
			     		//echo $new_region_path;
			     		//查找当前region_path获取机构信息
			     		$org = new Torganization();
			     		$org->whereAdd("region_path='$new_region_path'");
			     		$org->find();
			     		while ($org->fetch())
			     		{
			     			$real_orgid = $org->id;
			     			if($org->type==3||$org->type==4||$org->type==5||$org->type==6)//只找医院和社区等 不需要执法机构和行政机构
			     			{	
				     			$return_string.='<orgnization>';
				     			$return_string.='<name>'.$org->zh_name.'</name><org_id>'.$org->standard_code.'</org_id>';
				     			$return_string.='<departments>';
				     			foreach($section_office_id as $k=>$v)
				     			{
				     				$return_string.='<name>'.$v.'</name><dep_id>'.$k.'</dep_id>';
				     				$return_string.='<staffs>';//医生开始
					     			//查找科室和医生
					     			$staff_core    = new Tstaff_core();
					     			$staff_archive = new Tstaff_archive();
					     			$staff_core->joinAdd('left',$staff_core,$staff_archive,'id','user_id');
					     			$staff_core->whereAdd("staff_core.org_id='$real_orgid'");
					     			$staff_core->whereAdd("staff_archive.section_office_id='$k'");
					     			$staff_core->find();
					     			while ($staff_core->fetch())
					     			{
					     				$return_string.='<staff>';	
					     				$return_string.='<name>'.$staff_core->name_login.'</name>';	
					     				//性别
					     				if(!empty($staff_archive->sex))
					     				{
						     				if($staff_core->sex=='1')
						     				{
						     					$return_string.='<gender>男</gender>';
						     				}
						     				else
						     				{
						     					$return_string.='<gender>女</gender>';
						     				}
					     				}
					     				//身份证号     				
					     				$return_string.='<identity_card_number>'.$staff_archive->identity_card_number.'</identity_card_number>';
					     				//编制
                                        $return_string.=getarrayval($organizer,'organizer',$staff_archive->organizer);
					     				//专业代码
					     				$return_string.=getarrayval($specialty_name,'specialty_name',$staff_archive->specialty_name);
					     				//职称
										$return_string.=getarrayval($title,'title',$staff_archive->title);
					     				//工种
					     				$return_string.=getarrayval($type_of_work,'type_of_work',$staff_archive->type_of_work);				
					     				//行政业务管理代码
					     				$return_string.=getarrayval($manage_rank,'manage_rank',$staff_archive->manage_rank);
					     				//从事专业类别代码
					     				$return_string.=getarrayval($specialty_code,'specialty',$staff_archive->specialty_code);
					     				//医师执业类别代码
					     				$return_string.=getarrayval($physician_certified_type,'physician_certified_type',$staff_archive->physician_certified_type);
					     				//医师执业范围代码
					     				$return_string.=getarrayval($physician_certified_rang,'physician_certified_rang',$staff_archive->physician_certified_rang);
					     				$return_string.='</staff>';	
					     			}	
					     			$return_string.='</staffs>';//医生结束
				     			}
				     			$return_string.='</departments>';
				     			$return_string.='</orgnization>';
				     			$successNumber++;
			     			}
			     			//echo $org->zh_name.'<br />';
			     		}
			     		$org->free_statement();
			     		$array_count = count($region_array);
			     		for($i=1;$i<$array_count-1;$i++)//$array_count-1是为了不需要最顶层的机构
			     		{
			     			array_pop($region_array);//循环弹出
			     			//形成新的字符串
			     			$every_region = implode(',',$region_array);
			     			$org = new Torganization();
				     		$org->whereAdd("region_path='$every_region'");
				     		$org->find();
				     		while ($org->fetch())
				     		{
				     			$real_orgid = $org->id;
				     			if($org->type==3||$org->type==4||$org->type==5||$org->type==6)//只找医院和社区等 不需要执法机构和行政机构
				     			{	
					     			$return_string.='<orgnization>';
					     			$return_string.='<name>'.$org->zh_name.'</name><org_id>'.$org->standard_code.'</org_id>';
					     			$return_string.='<departments>';
					     			foreach($section_office_id as $k=>$v)
					     			{
					     				$return_string.='<name>'.$v.'</name><dep_id>'.$k.'</dep_id>';
					     				$return_string.='<staffs>';//医生开始
						     			//查找科室和医生
						     			$staff_core    = new Tstaff_core();
						     			$staff_archive = new Tstaff_archive();
						     			$staff_core->joinAdd('left',$staff_core,$staff_archive,'id','user_id');
						     			$staff_core->whereAdd("staff_core.org_id='$real_orgid'");
						     			$staff_core->whereAdd("staff_archive.section_office_id='$k'");
						     			$staff_core->find();
						     			while ($staff_core->fetch())
						     			{
						     				$return_string.='<staff>';	
						     				$return_string.='<name>'.$staff_core->name_login.'</name>';	
						     				//性别
						     				if(!empty($staff_archive->sex))
						     				{
							     				if($staff_core->sex=='1')
							     				{
							     					$return_string.='<gender>男</gender>';
							     				}
							     				else
							     				{
							     					$return_string.='<gender>女</gender>';
							     				}
						     				}
						     				//身份证号     				
						     				$return_string.='<identity_card_number>'.$staff_archive->identity_card_number.'</identity_card_number>';
						     				//编制
	                                        $return_string.=getarrayval($organizer,'organizer',$staff_archive->organizer);
						     				//专业代码
						     				$return_string.=getarrayval($specialty_name,'specialty_name',$staff_archive->specialty_name);
						     				//职称
											$return_string.=getarrayval($title,'title',$staff_archive->title);
						     				//工种
						     				$return_string.=getarrayval($type_of_work,'type_of_work',$staff_archive->type_of_work);				
						     				//行政业务管理代码
						     				$return_string.=getarrayval($manage_rank,'manage_rank',$staff_archive->manage_rank);
						     				//从事专业类别代码
						     				$return_string.=getarrayval($specialty_code,'specialty',$staff_archive->specialty_code);
						     				//医师执业类别代码
						     				$return_string.=getarrayval($physician_certified_type,'physician_certified_type',$staff_archive->physician_certified_type);
						     				//医师执业范围代码
						     				$return_string.=getarrayval($physician_certified_rang,'physician_certified_rang',$staff_archive->physician_certified_rang);
						     				$return_string.='</staff>';	
						     			}	
						     			$return_string.='</staffs>';//医生结束
					     			}
					     			$return_string.='</departments>';
					     			$return_string.='</orgnization>';
					     			$successNumber++;
				     			}
				     			//echo $org->zh_name.'<br />';
				     		}
				     		$org->free_statement();
			     		}  		
			     	}
			     	
			     	$organization->free_statement();
		     	}
		     	$return_string.='</orgnizations>';
		     	return $xmlhead.$return_string.'<successstring>成功获取'.$successNumber.'个机构</successstring><errorstring>'.$errorString.'获取失败'.$errorNumber.'个机构</errorstring>'.$xmlend;
		     }
	  }
	 /**
	  * 通过地区标准码，注册该地区下的一个或者多个机构
	  */
	 function ws_set_org_info($token,$xml_string)
	 {
	 	     require_once(__SITEROOT.'library/Models/organization.php');
	 	     require_once(__SITEROOT.'library/Models/region.php');
	 	     require_once(__SITEROOT.'application/organization/models/createjs.php');
		     require_once(__SITEROOT.'library/custom/comm_function.php');
		     //定义xml头和尾
		     $xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message><region>";
		     $xmlend = "</message>";
		     $sussesString = '';//成功显示的字符串
		     $errorString  = '';//失败显示的字符串
		     $successNumber = 0;
		     $errorNumber  = 0;
		     $return_string  = '';
		     $getxml  = new SimpleXMLElement($xml_string);
		     $region_standard_code = $getxml->region_standard_code;
		     if(empty($region_standard_code))//地区标准码为空
		     {
		     	$errorString.='地区标准码为空';
		     	$errorNumber++;
		     }
		     else
		     {
		     	//判断这个地区标准码在表中是否存在
		     	$region = new Tregion();
		     	$region->whereAdd("standard_code='$region_standard_code'");
		     	if($region->count()==0)
		     	{
		     		$errorString.='地区标准码为'.$region_standard_code.'的地区不存在';
		     		$errorNumber++;
		     	}
		     	else 
		     	{
		     		//地区标准码不为空且标准码存在
		     		$region->find(true);
		     		$return_string.='<region_standard_code>'.$region_standard_code.'</region_standard_code>';
		     		$region_path =  $region->region_path;//取得当前地区的path
		     		$org_object = $getxml->organizations->organization;//数组
		     		$return_string.='<organizations>';		
		     		foreach ($org_object as $k=>$v)
		     		{ 
		     			if(empty($v->org_id))
		     			{
		     				//机构标准码为空
		     				$errorString.='机构标准码不能为空';
		     				$errorNumber++;
		     			}
		     			else 
		     			{
		     				//机构标准码不为空
		     				$organization = new Torganization();
		     				$organization->whereAdd("standard_code='$v->org_id'");
		     				if($organization->count()>0)
		     				{
		     					//机构标准码已经存在
		     					$errorString.='机构标准码为'.$v->org_id.'的机构已经存在';
		     					$errorNumber++;
		     				}
		     				else 
		     				{
		     					//机构标准码不存在(可以进行新增了)
		     					//构造org的id	
		     					$org_info = new Torganization();
		     					$org_info->orderby("id DESC");
		     					$org_info->limit(0,1);
		     					$org_info->find(true);
		     					$new_org_id = $org_info->id+1;
		     					//写入表中
		     					$org = new Torganization();
		     					$org->id = $new_org_id;
		     					$org->zh_name = $v->org_zh_name;
		     					$org->region_path_domain = $region_path;
		     					$org->region_path = $region_path;
		     					$org->type = $v->org_type;
		     					$org->standard_code = $v->org_id;
		     					$org->password = md5($v->password);
		     					$org->ext_uuid = $v->ext_uuid;
		     					if(empty($v->org_zh_name)||empty($v->ext_uuid)||empty($v->password)||empty($v->org_type))
		     					{
		     						$errorString.='机构名称，业务号，机构类型，机构密码不能为空';
		     						$errorNumber++;
		     					}
		     					else 
		     					{			
			     					if($org->insert())
			     					{
			     						$return_string.='<organization>';
			     						$return_string.='<org_zh_name>'.$v->org_zh_name.'</org_zh_name>';
			     						$return_string.='<org_id>'.$v->org_id.'</org_id>';
			     						$return_string.='<password>'.$v->password.'</password>';
			     						$return_string.='<org_type>'.$v->org_type.'</org_type>';
			     						$return_string.='<ext_uuid>'.$v->ext_uuid.'</ext_uuid>';
			     						$return_string.='</organization>';
			     						//生成一个js数组文件
										createjs(__SITEROOT.'views/js','organization.js','Torganization','organizationArray');
										//单个JS文件的生成用于首页flash点击
								        createlonejs(__SITEROOT.'views/js','5','organizationArray');
			     						$successNumber++;
			     					}
			     					else 
			     					{
			     						$errorNumber++;
			     					}
		     					}
		     				}
		     			}	
		     		}
		     		$return_string.='</organizations>';
		     	}
		     	
		     }
		     $return_string.='</region>';
		     if($errorNumber==0)
		     {
		     	$errorString='无';
		     }
		  return $xmlhead.$return_string.'<success_transaction>有'.$successNumber.'条数据插入成功</success_transaction><error_transaction>有'.$errorNumber.'条数据插入失败,失败原因是:'.$errorString.'</error_transaction>'.$xmlend;   
	 }
	 /**
	  * 修改机构信息
	  * 只能修改机构的名称和机构密码、机构类型
	  */
	function  ws_update_org_info($token,$xml_string)
	{
		 require_once(__SITEROOT.'library/Models/organization.php');
	     require_once(__SITEROOT.'library/custom/comm_function.php');
	     require_once(__SITEROOT.'library/Models/region.php');
	     require_once(__SITEROOT.'application/organization/models/createjs.php');
	     //定义xml头和尾
	     $xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
	     $xmlend = "</message>";
	     $sussesString = '';//成功显示的字符串
	     $errorString  = '';//失败显示的字符串
	     $successNumber = 0;
	     $errorNumber  = 0;
	     $return_string  = '';
	     $getxml  = new SimpleXMLElement($xml_string);
	     $organization = $getxml->organization;
	     $return_string.='<organizations>';
	     foreach ($organization as $k=>$v)
	     {
	     	if(empty($v->org_id))
	     	{
	     		$errorString.='机构id不能为空';
	     		$errorNumber++;
	     	}
	     	else 
	     	{
	     		//注意如果除了org_id之外的节点为空的话就不更新否则要进行更新
	     		//检测这个机构是否存在
	     		$org = new Torganization();
	     		$org->whereAdd("standard_code='$v->org_id'");
	     		if($org->count()==0)
	     		{
	     			$errorString.='机构id为'.$v->org_id.'的机构不存在';
	     			$errorNumber++;
	     		}
	     		else 
	     		{
	     			$return_string.='<organization><org_id>'.$v->org_id.'</org_id>';
	     			$org->find(true);
	     			$id  = $org->id;//真正的org_id
	     			$org_table = new Torganization();
	     			$org_table->whereAdd("id='$id'");
	     			if(!empty($v->org_zh_name))
	     			{
	     				$org_table->zh_name = $v->org_zh_name;
	     				$return_string.='<org_zh_name>'.$v->org_zh_name.'</org_zh_name>';
	     			}
	     			if(!empty($v->org_type))
	     			{
	     				$org_table->type = $v->org_type;
	     				$return_string.='<org_type>'.$v->org_type.'</org_type>';
	     			}
	     			if(!empty($v->org_password))
	     			{
	     				$org_table->password = md5($v->org_password);
	     				$return_string.='<org_password>'.$v->org_password.'</org_password>';
	     			}
	     			if($org_table->update())
	     			{
	     				//生成一个js数组文件
						createjs(__SITEROOT.'views/js','organization.js','Torganization','organizationArray');
						//单个JS文件的生成用于首页flash点击
				        createlonejs(__SITEROOT.'views/js','5','organizationArray');
	     				$successNumber++;
	     			}
	     			else 
	     			{
	     				$errorNumber++;
	     			}
	     			$return_string.='</organization>';
	     		}
	     	}
	     }
	     $return_string.='</organizations>';
	     if($errorNumber==0)
	     {
	     	$errorString='无';
	     }
	     return  $xmlhead.$return_string.'<success_transaction>成功更新：'.$successNumber.'条数据</success_transaction><error_transaction>更新失败'.$errorNumber.'条，失败原因：'.$errorString.'</error_transaction>'.$xmlend;
	}
	/**
	 * 删除机构信息
	 * 当删除机构的时候需要判断该机构是否已经被使用了 否则不能删除
	 */
	function ws_del_org_info($token,$xml_string)
	{
		 require_once(__SITEROOT.'library/Models/organization.php');
		 require_once(__SITEROOT.'library/Models/staff_core.php');
	     require_once(__SITEROOT.'library/custom/comm_function.php');
	     require_once(__SITEROOT.'library/Models/region.php');
	     require_once(__SITEROOT.'application/organization/models/createjs.php');
	     //定义xml头和尾
	     $xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
	     $xmlend = "</message>";
	     $sussesString = '';//成功显示的字符串
	     $errorString  = '';//失败显示的字符串
	     $successNumber = 0;
	     $errorNumber  = 0;
	     $return_string  = '';
	     $getxml  = new SimpleXMLElement($xml_string);
	     $organization = $getxml->organization;
	     $return_string.='<organizations>';
	     foreach ($organization as $k=>$v)
	     {
	     	if(empty($v->org_id))
	     	{
	     		$errorString.="机构id不能为空";
	     		$errorNumber++;
	     	}
	     	else 
	     	{
	     		//检测这个机构是否已经被使用了
	     		$org = new Torganization();
	     		$org->whereAdd("standard_code='$v->org_id'");
	     		if($org->count()==0)
	     		{
	     			$errorString.="机构号为:".$v->org_id."的机构不存在，无法进行删除";
	     			$errorNumber++;
	     		}
	     		else 
	     		{
		     		$org->find(true);
		     		$staff_core = new Tstaff_core();
		     		$staff_core->whereAdd("org_id='$org->id'");
		     		if($staff_core->count()>0)
		     		{
		     			$errorString.="机构号为".$v->org_id."的机构已经被使用，无法进行删除.";
		     			$errorNumber++;
		     		}
		     		else 
		     		{
		     			$del_org = new Torganization();
		     			$del_org->whereAdd("id='$org->id'");
		     			if($del_org->delete())
		     			{		
		     				$return_string.='<organization><org_id>'.$v->org_id.'</org_id></organization>';
		     				$successNumber++;
		     				//生成一个js数组文件
							createjs(__SITEROOT.'views/js','organization.js','Torganization','organizationArray');
							//单个JS文件的生成用于首页flash点击
					        createlonejs(__SITEROOT.'views/js','5','organizationArray');
		     			}
		     		}
	     		}
	     	}
	     }
	     $return_string.='</organizations>';
	     if($errorNumber==0)
	     {
	     	$errorString='无';
	     }
	     return $xmlhead.$return_string.'<success_transaction>成功删除：'.$successNumber.'条数据</success_transaction><error_transaction>删除失败'.$errorNumber.'条，失败原因：'.$errorString.'</error_transaction>'.$xmlend;
	}
  }
?>