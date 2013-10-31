<?php
/**
 *新生儿家庭访视
 * author CT
 */
require_once('api_phs_common.php');
class api_phs_visit{
	/**
	 * 验证是否登录
	 *
	 * @param unknown_type $org_id
	 * @param unknown_type $password
	 * @return unknowna
	 */
	function ws_login($org_id,$password){
		//return 'ok';
		return login($org_id,$password);
	}
	 /**
     * 取某个机构下边的所有人的uuid 身份证号 和 org_id
     * (2013年5月8号新增 为了让中联能取到平台中的新生儿数据  业务号为平台数据的uuid 为了调用下边的ws_select_single接口)
     */
    function ws_select_all($token,$xml_string)
    {
    	require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/child_visits.php";
		$xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
		$xmlend  = "</message>";
		$getxml = new SimpleXMLElement($xml_string);
		$org_id = $getxml->org_id;
		if(empty($org_id))
		{
			return $xmlhead."<return_code>2</return_code><return_string>机构号为空，请检查</return_string>".$xmlend;
		}
		else 
		{
			//转换org_id
			$organization = new Torganization();
			$organization->whereAdd("standard_code='$org_id'");
			$organization->find(true);
			$org_id_number = $organization->id;
			if(!empty($org_id_number))
			{
				//取得做新生儿访视的人
				$child_visits = new Tchild_visits();
				$child_visits->query("select count(*) as cou from child_visits where child_visits.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
				$child_visits->fetch();
				$number = $child_visits->cou;
				if($number>0)
				{
					$child_visits_select = new Tchild_visits();
					$child_visits_select->query("select * from child_visits where child_visits.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
					$response_str = '';
				    while ($child_visits_select->fetch())
				    {
				    	$response_str.='<row>';
				    	$ext_uuid = $child_visits_select->uuid;
			            //取得这个人的身份证号
			            $individual_core = new Tindividual_core();
			            $individual_core->whereAdd("uuid='$child_visits_select->id'");
			            $individual_core->find(true);
			            $identity_number = $individual_core->identity_number;
				    	$response_str.='<identity_number>'.$identity_number.'</identity_number>';
				    	$response_str.='<org_id>'.$org_id.'</org_id>';
				    	if($child_visits_select->ext_uuid=='')
				    	{
				    	  $response_str.='<ext_uuid>'.$ext_uuid.'</ext_uuid>';
				    	}
				    	else 
				    	{
				    		$response_str.='<ext_uuid>'.$child_visits_select->ext_uuid.'</ext_uuid>';
				    	}
				    	$response_str.='</row>';
				    	$individual_core->free_statement();
				    }
				    $child_visits_select->free_statement();
				    return $xmlhead.$response_str.$xmlend;
				}
				else 
				{
					return $xmlhead."<return_code>2</return_code><return_string>机构号为".$org_id."的机构没有查询到新生儿访视记录</return_string>".$xmlend;
				}
			}
			else 
			{
				return $xmlhead."<return_code>2</return_code><return_string>机构号不存在</return_string>".$xmlend;
			}
		}
    }
    /**
     * 取 身份证号 和 org_id
     * (2013年5月10号新增 为了让中联能取到平台中的新生儿访视数据  业务号为平台数据的uuid 为了调用下边的ws_select_single接口)
     */
    function ws_select_persons($token,$xml_string)
    {
    	require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/child_visits.php";
		$xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
		$xmlend  = "</message>";
		$getxml = new SimpleXMLElement($xml_string);
        $org_id = $getxml->org_id;
        $identity_number = $getxml->identity_number;
	    if($org_id=='')
		{
			return $xmlhead."<return_code>2</return_code><return_string>机构号为空，请检查</return_string>".$xmlend;
		}
		if($identity_number=='')
		{
			return $xmlhead."<return_code>2</return_code><return_string>身份证为空，请检查</return_string>".$xmlend;
		}
		//转换org_id
		$organization = new Torganization();
		$organization->whereAdd("standard_code='$org_id'");
		$organization->find(true);
		$org_id_number = $organization->id;
		//取得这个身份证和机构联查得到的所有新生儿随访数据
		$child_visits = new Tchild_visits();
		$child_visits->query("select count(*) as cou from child_visits where child_visits.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number' and individual_core.identity_number='$identity_number')");
		$child_visits->fetch();
		$count = $child_visits->cou;
		if($count>0)
		{   
			$response_str = '';
			$child_visits_select = new Tchild_visits();
			$child_visits_select->query("select * from child_visits where child_visits.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number' and individual_core.identity_number='$identity_number')");
			while ($child_visits_select->fetch())
			{
				$response_str.='<row>';
				$ext_uuid = $child_visits_select->uuid;
	            //取得这个人的身份证号
	            $individual_core = new Tindividual_core();
	            $individual_core->whereAdd("uuid='$child_visits_select->id'");
	            $individual_core->find(true);
	            $identity_number = $individual_core->identity_number;
		    	$response_str.='<identity_number>'.$identity_number.'</identity_number>';
		    	$response_str.='<org_id>'.$org_id.'</org_id>';
		    	if($child_visits_select->ext_uuid=='')
		    	{
		    	  $response_str.='<ext_uuid>'.$ext_uuid.'</ext_uuid>';
		    	}
		    	else 
		    	{
		    		$response_str.='<ext_uuid>'.$child_visits_select->ext_uuid.'</ext_uuid>';
		    	}
		    	$response_str.='</row>';
		    	$individual_core->free_statement();	
			}
			$child_visits_select->free_statement();
			return $xmlhead.$response_str.$xmlend;
		}
		else 
		{
			return $xmlhead."<return_code>2</return_code><return_string>身份证为".$identity_number."，机构号为".$org_id."的新生儿访视数据未查询到！</return_string>".$xmlend;
		}
    }
	/**
	 * 查询单条数据
	 *
	 * @param unknown_type $token
	 * @param unknown_type $xml_string
	 * @return unknown
	 */
     function ws_select_single($token,$xml_string){
         /* if(checkToken($token)!=1){
			$xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>请先登陆后在进行数据处理</return_string></message>";
			return $xml_string;	
		   }*/
    	    require_once(__SITEROOT.'library/Models/organization.php');
    	    require_once __SITEROOT."library/Models/staff_archive.php";
			require_once __SITEROOT."library/Models/individual_archive.php";
			require_once __SITEROOT."library/Models/individual_core.php";
			require_once __SITEROOT."library/Models/child_visits.php";
			require_once __SITEROOT.'library/custom/comm_function.php';
			require_once __SITEROOT.'library/data_arr/arrdata.php';
			$xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
		    $xmlend  = "</message>";
		    $myarray=array('uuid','id');//需要排除的字段
			$getxml = new SimpleXMLElement($xml_string);
			$get_orgid           = $getxml->org_id;
		    $get_ext_uuid        = $getxml->ext_uuid;
		    if ($get_ext_uuid=="")
			{
				return $xmlhead."<return_code>2</return_code><return_string>错误，请提供业务号</return_string>".$xmlend;
			}
			$get_identity_number = $getxml->identity_number;
			//通过standard_code查找我们系统中对应的机构ID
			$ourorg = new Torganization();
			$ourorg->whereAdd("standard_code='$get_orgid'");
			$ourorg->find(true);
			$myorgid = $ourorg->id;
			
			//判断在个人信息表中是否存在该数据（不存在不能传数据）
			$individual_core = new Tindividual_core();
			$individual_core->whereAdd("identity_number='$get_identity_number'");
			$individualNumber = $individual_core->count();
			if($individualNumber!=1)
			{
				return $xmlhead."<return_code>2</return_code><return_string>该数据个人基本档案不存在</return_string>".$xmlend;
			}
			else
			{	
				
					$individual     = new Tindividual_core();
					$individual->whereAdd("identity_number='$get_identity_number'");
					$individual->find(true);
					$individual_id  = $individual->uuid;
					//判断有当前这个数据没有
					$match_array = preg_match_all('~^b_.*?\..*?$~',$get_ext_uuid,$my_array);//判断是中联数据还是平台数据
					if(empty($my_array[0][0]))
					{
						$tag=true;
					}
					else 
					{
						$tag=false;
					}
					
					//判断有当前这个数据没有
					$core = new Tchild_visits();
					if($tag)
					{
						$core->whereAdd("id='$individual_id'");
						$core->whereAdd("ext_uuid='$get_ext_uuid'");
						$core->whereAdd("org_id='$myorgid'");
					}
					else 
					{
						$core->whereAdd("uuid='$get_ext_uuid'");
					}					
					if($core->count()!=1)
					{
						return $xmlhead."<return_code>2</return_code><return_string>当前条件下的新生儿访视数据不存在</return_string>".$xmlend;
					}
					else
					{
					$dic_table = array('disease_pregnancy'=>'bb_f_casesofmother','birth_complexion'=>'bb_f_births','sleepy_baby'=>'bb_f_asphyxia','deformity'=>'bb_f_abnormal','hearing_screening'=>'bb_f_hearing','breast_milk'=>'bb_f_feeding','complexion'=>'bb_f_births','bregma'=>'bb_f_fontanel','eye'=>'bb_exception','limb'=>'bb_exception','ear'=>'bb_exception','cervical_mass'=>'bb_f_neckmass','nose'=>'bb_exception','skin'=>'bb_f_skin','oral_cavity'=>'bb_exception','gmzz'=>'bb_exception','heart_lung'=>'bb_exception','pudendum'=>'bb_exception','abdomen'=>'bb_exception','rachis'=>'bb_exception','umbilical_cord'=>'bb_f_cord','referral_features'=>'bb_f_neckmass','advising'=>'bb_f_guide');
					$response = "<?xml version='1.0' encoding='UTF-8'?><tables>";
					$response.="<table name='child_visits'><row><identity_number>".$get_identity_number."</identity_number>";
					$tablobj     =  new Tchild_visits();
					if($tag)
					{
						$tablobj->whereAdd("id='$individual_id'");
						$tablobj->whereAdd("ext_uuid='$get_ext_uuid'");
						$tablobj->whereAdd("org_id='$myorgid'");
					}
					else 
					{
						$tablobj->whereAdd("uuid='$get_ext_uuid'");
					}		
					$tablobj->find();
					while($tablobj->fetch())
					{			   		
						    //转换机构id
					   	     $tablobj->org_id = $get_orgid;
						   	 //转换医生id   	
							 $staff_archive=new Tstaff_archive();
							 $staff_archive->whereAdd("user_id='$tablobj->staff_id'");
							 $staff_archive->find(true);
							 $staff_identity_number = $staff_archive->identity_card_number;
							 $tablobj->staff_id     = $staff_identity_number;
						     //转换数据字典
						     if(isset($dic_table))
						     {
							     foreach($dic_table as $k=>$v)
							     {
							     	if (strpos($tablobj->$k,'|')===false)
							     	{
							     		//没有竖线分隔的字符串
							     		$tablobj->$k=array_search_for_other($tablobj->$k,$$v);	
							     	}else
							     	{
							     		//有竖线分隔的字符串
							     		$temp=array();
							     		$temp_str=array();
										$temp=explode('|',$tablobj->$k);
										foreach($temp as $temp_k=>$temp_v)
										{
											if($temp_v!=='')
											{
												$temp_str[$temp_k] = array_search_for_other($temp_v,$$v);
											}
										}
										$tablobj->$k = rtrim(implode('|',$temp_str),'|');
							     	}
							     }
						     }
						    if(!$tag)
						    {
						    	$tablobj->ext_uuid = $get_ext_uuid;
						    }
				
						    $response.=$tablobj->toXML('',$myarray);
						    $response.="</row></table>";
						}		  
				       $response.="</tables>";
				       return  $response;
					}
				}		
           }
      /**
       * 插入或者更新数据
       *
       * @param unknown_type $token
       * @param unknown_type $xml_string
       */
      function ws_update($token,$xml_string)
      {
      	/*if(checkToken($token)!=1)
      	{
			$xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>请先登陆后在进行数据处理</return_string></message>";
			return $xml_string;	
		   }*/
    	require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/Models/individual_archive.php";
		require_once __SITEROOT."/library/Models/staff_archive.php";
		require_once __SITEROOT."/library/Models/individual_core.php";	
		require_once __SITEROOT."library/Models/child_visits.php";
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		$xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
		$xmlend  = "</message>";
		$successsstring ='';
		$errorstring = '';
		$returnstring = '';
		$error =1;
		$error_number = 0;
		$success_number = 0;
                                      if(empty($xml_string))
                                      {
                                          return $xmlhead.'没有传入任何的xml'.$xmlend;
                                      }
                                      else
                                      {
		$getxml = new SimpleXMLElement($xml_string);
		foreach ($getxml as $table)
		{
			$realtable = $table['name'];
			$tableobj  = 'T'.$realtable;
			foreach ($table as $row)
			{
			$uuid     = uniqid('b_',true);
			$get_orgid           = $row->org_id;
		    $get_ext_uuid        = $row->ext_uuid;
		    $get_identity_number = $row->identity_number;	
		    $real_org = new Torganization();
		    $real_org->whereAdd("standard_code='$get_orgid'");	
		    $real_org->find(true);
		    $real_orgid =  $real_org->id;  
		    $real_org->free_statement();   
			//判断在个人信息表中是否存在该数据（不存在不能传数据）
			$individual_core = new Tindividual_core();
			$individual_core->whereAdd("identity_number='$get_identity_number'");
			$individualNumber = $individual_core->count();
			$individual_core->free_statement();
			if($individualNumber!=1)
			{
				$error=2;
				$errorstring.="<table name='child_visits'><return_code>2</return_code><return_string>身份证号为".$get_identity_number."的个人基本档案不存在</return_string></table>";
				$error_number++;
				continue;
			}
			else
			{				
			   //这里需要判断是不是存在该条数据(添加和更新判断)
			   $individual     = new Tindividual_core();
	           $individual->whereAdd("identity_number='$get_identity_number'");
			   $individual->find(true);
			   $individual_id  = $individual->uuid;
			   $individual->free_statement();
               $corenumber    = new Tchild_visits();
			   $corenumber->whereAdd("id='$individual_id'");
		       $corenumber->whereAdd("ext_uuid='$get_ext_uuid'");
		       $corenumber->whereAdd("org_id='$real_orgid'");
		       $exam_number = $corenumber->count(); 
		       $corenumber->free_statement();  
		       $dic_table = array('disease_pregnancy'=>'bb_f_casesofmother','birth_complexion'=>'bb_f_births','sleepy_baby'=>'bb_f_asphyxia','deformity'=>'bb_f_abnormal','hearing_screening'=>'bb_f_hearing','breast_milk'=>'bb_f_feeding','complexion'=>'bb_f_births','bregma'=>'bb_f_fontanel','eye'=>'bb_exception','limb'=>'bb_exception','ear'=>'bb_exception','cervical_mass'=>'bb_f_neckmass','nose'=>'bb_exception','skin'=>'bb_f_skin','oral_cavity'=>'bb_exception','gmzz'=>'bb_exception','heart_lung'=>'bb_exception','pudendum'=>'bb_exception','abdomen'=>'bb_exception','rachis'=>'bb_exception','umbilical_cord'=>'bb_f_cord','referral_features'=>'bb_f_neckmass','advising'=>'bb_f_guide');
		        $newtableobj = new $tableobj();	
		        if($row->staff_id=='')
				{
					$error=2;
					$errorstring.="<table name='child_visits'><return_code>2</return_code><return_string>身份证号为".$get_identity_number."的数据医生身份证号为空请检查</return_string></table>";
					$error_number++;
					continue;
				}
					foreach($row as $colum=>$value)
				    {
				    	//判断医生是否存在
					     $staff_number = new Tstaff_archive();
					   	 $staff_number->whereAdd("identity_card_number='$row->staff_id'");
					   	 $mynumber = $staff_number->count();
					   	 $staff_card = $row->staff_id;
					   	 if($staff_number->count()<1)
					   	 {
					   	 	$error=2;
					   	 	$errorstring.="<table name='child_visits'><return_code>2</return_code><return_string>身份证号为".$get_identity_number."的数据医生身份证号不存在请检查</return_string></table>";
						    $error_number++;
						    continue;
				   	    }
						$newtableobj->$colum = $row->$colum;//这句必须放前边要不值会覆盖
						if(!isset($row->created)&&empty($row->created))
						{
							$newtableobj->created = time();
						}
						else
						{
							$newtableobj->created = $row->created;
						}
						unset($newtableobj->identity_number);//不要身份证
						//转换orgid
						$orgobj = new Torganization();
						$orgobj->whereAdd("standard_code='$row->org_id'");
						$orgobj->find(true);
						$newtableobj->org_id = $real_orgid;	
						$orgobj->free_statement();
						//转换staffid
						$staff_archive=new Tstaff_archive();
                        $staff_archive->whereAdd("identity_card_number='$row->staff_id'");
						$staff_archive->find(true);
						$newtableobj->staff_id=$staff_archive->user_id;	
						$staff_archive->free_statement();
						//转换签名医生
						$staff_archive_doctor =  new Tstaff_archive();
						$staff_archive_doctor->whereAdd("identity_card_number='$row->doctors_signature'");
						$staff_archive_doctor->find(true);
						$newtableobj->doctors_signature=$staff_archive->user_id;
						$staff_archive_doctor->free_statement();
						//转化数据字典
						foreach($dic_table as $k=>$v)
						{
					    	if(strpos($row->$k,'|')===false)
					    	{
					    		//不存在竖线分隔的字符串
					    		$newtableobj->$k = array_code_change($row->$k,$$v);
					    	}
					    	else
					    	{	
					    		//存在竖线分隔的字符串
					    		//var_dump($$v);
					    		$temp = array();
					    		$temp_array = array();
					    	    $temp=explode('|',$row->$k);
					    	    foreach($temp as $temp_k=>$temp_v)
					    	    {
					    	    	if($temp_v!=='')
					    	    	{
					    	    	 $temp_array[$temp_k] = array_code_change($temp_v,$$v);
					    	    	}
					    	    }
					    	    $newtableobj->$k = rtrim(implode('|',$temp_array),'|');	    
					    	}
						 }	
								     		      
					}
				}			
				if($exam_number!=1)
				{ 				
					$newtableobj->uuid     = $uuid;
					$newtableobj->id       = $individual_id;
					//var_dump($newtableobj);
       	            if($newtableobj->insert())
       	            {
           	            $successsstring.= "<table name='child_visits'><row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row></table>";
           	            $success_number++;
       	            }
       	            else
       	            {
       	            	$error =3;
       	            	$sqlerror = $newtableobj->showErrorMessage();
       	                $errorstring.= "<table name='child_visits'><row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row></table>";
       	                $returnstring.= $sqlerror."未能成功插入数据";
       	                $error_number++;
       	                continue;
       	            }
                  }
                  else
                  {                     	 
                   	 $newtableobj->whereAdd("id='$individual_id'");
					 $newtableobj->whereAdd("ext_uuid='$get_ext_uuid'");
					 $newtableobj->whereAdd("org_id='$real_orgid'");
					 if($newtableobj->update())
					 {
               	            $successsstring.= "<table name='child_visits'><row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row></table>";
               	            $success_number++;
					 }
					 else
					 {
					 	    $error =3;
					 	    $sqlerror = $newtableobj->showErrorMessage();
           	                $errorstring.= "<table name='child_visits'><row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row></table>";
           	                $returnstring.= $sqlerror."身份证号为".$get_identity_number."的数据未能成功更新";
           	                $error_number++;
       	                    continue;
                      }
                   }
              $newtableobj->free_statement();
		   }   				
		}
                                    
//			if($error=1)
//			{		
				return $xmlhead.'<success_transaction>'.$successsstring.'</success_transaction><error_transaction>'.$errorstring.'</error_transaction><return_string>数据插入或者更新成功'.$success_number.'条,数据插入或者更新失败'.$error_number.'条</return_string>'.$xmlend;
//			}
//			else
//			{	
//				return $xmlhead."<return_code>3</return_code>".'<error_transaction>'.$errorstring.'</error_transaction><return_string>'.$returnstring.'</return_string>'.$xmlend;
//      }
                                  }	
     }
     /**
      * 删除数据
      *
      * @param unknown_type $token
      * @param unknown_type $xml_string
      * @return unknown
      */
         function ws_delete($token,$xml_string){
            if(checkToken($token)!=1)
            {
			$xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>请先登陆后在进行数据处理</return_string></message>";
				return $xml_string;	
			}
    	    require_once(__SITEROOT.'library/Models/organization.php');
			require_once __SITEROOT."/library/Models/individual_archive.php";
			require_once __SITEROOT."/library/Models/staff_archive.php";
			require_once __SITEROOT."/library/Models/individual_core.php";	
			require_once __SITEROOT."library/Models/child_visits.php";
			$xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
			$xmlend  = "</message>";
			$successsstring = '';
			$errorstring = '';
			$error =1;	
		    //写入系统内部的机构号 
			 $getxml = new SimpleXMLElement($xml_string);
	    	 $get_orgid           = $getxml->org_id;
	    	 //获得平台内部的机构ID
	    	 $orgobject = new Torganization();
	    	 $orgobject->whereAdd("standard_code='$get_orgid'");
	    	 $orgobject->find(true);
	    	 $real_orgid = $orgobject->id;
		     $get_ext_uuid        = $getxml->ext_uuid;
		     $get_identity_number = $getxml->identity_number;
			 $individual = new Tindividual_core();
			 $individual->whereAdd("identity_number='$get_identity_number'");
			 $individualNumber = $individual->count();
			 if($individualNumber!=1){
			 	    return $xmlhead.'<return_code>2</return_code><return_string>个人基本档案不存在</return_string>'.$xmlend;
			 }else{
			     //查询个人档案号
			     $individual_core  = new Tindividual_core();
			     $individual_core->whereAdd("identity_number='$get_identity_number'");
			     $individual_core->find(true);
			     $individual_id    = $individual_core->uuid;
			     //删除符合条件的数据
		     	 $table_obiect = new Tchild_visits();
		     	 $table_obiect->whereAdd("id='$individual_id'");
		     	 $table_obiect->whereAdd("org_id='$real_orgid'");
		     	 $table_obiect->whereAdd("ext_uuid='$get_ext_uuid'");
			     if(1||$table_obiect->delete())
			     {
	     	 	    $successsstring.= "<row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row>";
			     }
			     else
			     {
	     	 	    $error=3;
	     	 		$errorstring.= "<row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row>";
			     }
			     if($error=1)
			     {
					return $xmlhead."<return_code>1</return_code>".'<success_transaction>'.$successsstring.'</success_transaction><return_string>数据删除成功</return_string>'.$xmlend;
				 }
				 else
				 {
					return $xmlhead."<return_code>3</return_code>".'<error_transaction>'.$errorstring.'</error_transaction><return_string>部分数据删除失败</return_string>'.$xmlend;
				 }		 
			 }
      }
}
?>