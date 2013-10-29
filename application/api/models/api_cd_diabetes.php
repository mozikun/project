<?php
/**
 * 二型糖尿病接口
 * @author CT
 */
require_once('api_phs_common.php');
class api_cd_diabetes{
	/**
	 * Enter description here...
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
     * 插入数据
     * @param unknown_type $token
     * @param unknown_type $xml_string
     */
    function ws_update($token,$xml_string){
          /*$xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>请先登陆后在进行数据处理</return_string></message>";
			return $xml_string;	
		   }
		   */
    	require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."library/Models/individual_archive.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
		require_once __SITEROOT."library/Models/individual_core.php";	
		require_once __SITEROOT."library/Models/diabetes_core.php";
		require_once __SITEROOT."library/Models/diabetes_symptom.php";
		require_once __SITEROOT."library/Models/diabetes_physical_sign.php";
		require_once __SITEROOT."library/Models/diabetes_lifestyle_guide.php";
		require_once __SITEROOT."library/Models/diabetes_accessory_examine.php";
		require_once __SITEROOT."library/Models/diabetes_patient_referral.php";
		require_once __SITEROOT."library/Models/follow_up_drugs.php";
		require_once __SITEROOT.'library/custom/comm_function.php';
		require_once __SITEROOT.'library/data_arr/arrdata.php';
		$xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
		$xmlend  = "</message>";
		$successsstring ='';
		$errorstring = '';
		$returnstring = '';
		$ext_uuid_str ='';
		$org_id_str   = '';
		$identity_number_str ='';
		$error =1;
		$errornumber = 0;
		$successnumber = 0;
                                       if(empty($xml_string))
                                       {
                                           return $xmlhead.'没有传入任何xml'.$xmlend;
                                       }
                                       else
                                       {
		$getxml = new SimpleXMLElement($xml_string);
		foreach ($getxml as $k=>$table){
			$realtable = $table['name'];
			//主表内容开始
			if($realtable=="diabetes_core")
			{	
				foreach ($table as $row)
				{ 
		        $uuid     = uniqid('D_',true);  
				$get_orgid           = $row->org_id;
			    $get_ext_uuid        = $row->ext_uuid;	    
			    $get_identity_number = $row->identity_number;	
			    if (!isset($get_ext_uuid)||$get_ext_uuid=="")
				{
					$error =2;
					$errorstring.="<table name='diabetes_core'><return_code>2</return_code><return_string>错误，请提供业务号</return_string></table>";
					$errornumber++;
					continue;
				}
			    $real_org = new Torganization();
			    $real_org->whereAdd("standard_code='$get_orgid'");	
			    $real_org->find(true);
			    $real_orgid =  $real_org->id;
			    $real_org->free_statement();     
				//判断在个人信息表中是否存在该数据（不存在不能传数据）
				$individual_core = new Tindividual_core();
				$individual_core->whereAdd("identity_number='$get_identity_number'");
				$individualNumber = $individual_core->count();
				if($individualNumber!=1){
					$error=2;
					$errorstring.="<table name='diabetes_core'><return_code>2</return_code><return_string>个人基本档案不存在</return_string></table>";
					$errornumber++;
					continue;
				}	
				$individual_core->free_statement();	
	            //这里需要判断是不是存在该条数据(添加和更新判断)
				$individual     = new Tindividual_core();
				$individual->whereAdd("identity_number='$get_identity_number'");
				$individual->find(true);
				$individual_id  = $individual->uuid;
				$individual->free_statement();
	            //确定记录的唯一性		
	           $corenumber    = new Tdiabetes_core();
			   $corenumber->whereAdd("id='$individual_id'");
		       $corenumber->whereAdd("ext_uuid='$get_ext_uuid'");
		       $corenumber->whereAdd("org_id='$real_orgid'");
		       $exam_number = $corenumber->count();
		       $core_array = array('type_of_followup'=>'type_of_followup','compliance'=>'compliance','adverse_drug_reaction'=>'adverse_drug_reaction','reactive_hypoglycemia'=>'reactive_hypoglycemia','followup_classification'=>'followup_classification');
			   $diabetes_core = new Tdiabetes_core();//实例化表对象	
			   //转换orgid
				$orgobj = new Torganization();
				$orgobj->whereAdd("standard_code='$row->org_id'");
				$orgobj->find(true);
				if ($orgobj->id=='')
				{
					$error =2;
					$errorstring.="<table name='diabetes_core'><return_code>2</return_code><return_string>机构不存在</return_string></table>";
					$errornumber++;
					continue;
				}
				foreach($row as $colum=>$value)
				{
					$diabetes_core->$colum = $row->$colum;//这句必须放前边要不值会覆盖
					unset($diabetes_core->identity_number);//不要身份证
					if(empty($row->created)||!isset($row->created))//处理时间
					{
						$diabetes_core->created = time();
					}
					else
					{
						$diabetes_core->created = $row->created;
					}
					$diabetes_core->org_id = $real_orgid;
					//转换staffid
					$staff_archive=new Tstaff_archive();
	                $staff_archive->whereAdd("identity_card_number='$row->staff_id'");
					$staff_archive->find(true);
					$diabetes_core->staff_id=$staff_archive->user_id;
					$staff_archive->free_statement();	
					//转换followup_doctor
					if(!empty($row->followup_doctor))
					{
						$followup_doctor = $row->followup_doctor;
						$staff_archive_doc = new Tstaff_archive();
						$staff_archive_doc->whereAdd("identity_card_number='$followup_doctor'");
						$staff_archive_doc->find(true);
						$diabetes_core->followup_doctor=$staff_archive_doc->user_id;
						$staff_archive_doc->free_statement();
					}
				    //转化数据字典
				    foreach($core_array as $k=>$v)
				    {
				    	if(strpos($row->$k,'|')===false)
				    	{
				    		//不存在竖线分隔的字符串
				    		$diabetes_core->$k = array_code_change($row->$k,$$v);
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
				    	    $diabetes_core->$k = rtrim(implode('|',$temp_array),'|');	    
				    	}
				     }								     		      
				 }							
				if($exam_number<1)
				{ 						
					$diabetes_core->uuid     = $uuid;
					$diabetes_core->id       = $individual_id;	
	   	            if($diabetes_core->insert())
	   	            {
	   	            	$error =1;
	       	            $successsstring.= "<table name='diabetes_core'><row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row></table>";
	       	            $successnumber++;
	   	            }
	   	            else
	   	            {
	   	            	$error =3;
	   	            	$sqlerror = $diabetes_core->showErrorMessage();
	   	                $errorstring.= "<table name='diabetes_core'><row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row></table>";
	   	                $returnstring.= $sqlerror."diabetes_core表信息未能成功插入数据";
	   	                $errornumber++;
	   	                continue;
	   	            }
	             }
		         else
	             {                     	 
	               	 $diabetes_core->whereAdd("id='$individual_id'");
					 $diabetes_core->whereAdd("ext_uuid='$get_ext_uuid'");
					 $diabetes_core->whereAdd("org_id='$real_orgid'");
					 if( $diabetes_core->update())
					 {
					 	    $error =1;
	           	            $successsstring.= "<table name='diabetes_core'><row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row></table>";
	           	            $successnumber++;
					 }
					 else
					 {
					 	    $error =3;
					 	    $sqlerror = $diabetes_core->showErrorMessage();
	       	                $errorstring.= "<table name='diabetes_core'><row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row></table>";
	       	                $returnstring.= $sqlerror."diabetes_core表信息未能成功更新数据";
	       	                $errornumber++;
	       	                continue;
	                 }
	            }
			}
	       $corenumber->free_statement();
	       $diabetes_core->free_statement();
	}        		
}//主表处理结束
         //删除用药表再插入来更新内容
         foreach ($getxml as $k=>$table)
         {
         	foreach ($table as $row)
         	{
         		//个人ID号
         		$individual     = new Tindividual_core();
				$individual->whereAdd("identity_number='$get_identity_number'");
				$individual->find(true);
				//转换orgid
				$orgobj = new Torganization();
				$orgobj->whereAdd("standard_code='$row->org_id'");
				$orgobj->find(true);
				$deldiabetes_core = new Tfollow_up_drugs();
				$deldiabetes_core->whereAdd("id='$individual->uuid'");
				$deldiabetes_core->whereAdd("ext_uuid='$row->ext_uuid'");
				$deldiabetes_core->whereAdd("org_id='$orgobj->id'");
				$deldiabetes_core->delete();
				$individual->free_statement();
				$orgobj->free_statement();
				$deldiabetes_core->free_statement();
         	}
         }
			//表中存在数据字典的情况
			$dic_table = array('diabetes_symptom'=>array('diabetes_symptom'=>'diabetes_symptom'),'diabetes_physical_sign'=>array('arteria_dorsalis_pedis'=>'arteria_dorsalis_pedis'),'diabetes_lifestyle_guide'=>array('complian'=>'complian','heart_adjustment'=>'heart_adjustment'));
			foreach($getxml as $table){
				$realtable = $table['name'];
				$tableobj  = 'T'.$realtable;
				if($realtable=='diabetes_core')
				{
					continue;
				}
				$manyrowstable = array('follow_up_drugs');								
				if(in_array($realtable,$manyrowstable))
				{
					foreach ($table as $row)
					{
						$get_orgid           = $row->org_id;
					    $get_ext_uuid        = $row->ext_uuid;
					    $get_identity_number = $row->identity_number;
					   // echo $get_orgid.'-----'.$get_ext_uuid.'----'.$get_identity_number.'<br/>';
					    //获取真正的机构ID
					    $orgobject =  new Torganization();
					    $orgobject->whereAdd("standard_code='$get_orgid'");
					    $orgobject->find(true);
					    $currentorgid = $orgobject->id;
					    $orgobject->free_statement();
					    $individual_core = new Tindividual_core();
						$individual_core->whereAdd("identity_number='$get_identity_number'");
						$individualNumber = $individual_core->count();
						if($individualNumber!=1){
							$error=2;
							$errorstring.="<table name='diabetes_core'><return_code>2</return_code><return_string>个人基本档案不存在</return_string></table>";
							$errornumber++;
							continue;
						}	
					    //获取个人ID号
					    $individual     = new Tindividual_core();
						$individual->whereAdd("identity_number='$get_identity_number'");
						$individual->find(true);
						$individual_id  = $individual->uuid;
						//获取真正的机构ID
					      $orgobject =  new Torganization();
					      $orgobject->whereAdd("standard_code='$get_orgid'");
					      $orgobject->find(true);
					      $currentorgid = $orgobject->id;
						//判断有无糖尿病随访主表数据
					      $diabetes_core = new Tdiabetes_core();
						  $diabetes_core->whereAdd("id='$individual_id'");
						  $diabetes_core->whereAdd("ext_uuid='$get_ext_uuid'");
						  $diabetes_core->whereAdd("org_id='$currentorgid'");
						  if($diabetes_core->count()<1)
						  {
							$error = 2;
							$errorstring.="<table name='$realtable'><return_code>2</return_code><return_string>身份证号为:".$get_identity_number."的病人糖尿病随访档案不存在</return_string></table>";
							$errornumber++;
							continue;
						  }
 else {
     $diabetes_core->find(true);
     $disabled_uuid = $diabetes_core->uuid;
 }
//						echo $individual_id;
//						exit();
						$individual->free_statement();
						$drugobj = new Tfollow_up_drugs();
						$drugobj->uuid    = uniqid('F_',true);
						$drugobj->org_id  = $currentorgid;
						$staff_id = $row->staff_id;
						$staff_archive=new Tstaff_archive();
                        $staff_archive->whereAdd("identity_card_number='$staff_id'");
                        if($staff_archive->count('*')==1){
							$staff_archive->find(true);
							$drugobj->staff_id=$staff_archive->user_id;	
                        }
                        $drugobj->drug_name = $row->drug_name;
                        $drugobj->id          = $individual_id;
                        $drugobj->ext_uuid    = $row->ext_uuid;
                        $drugobj->drug_amount = $row->drug_amount;
                        $drugobj->drug_frequency = $row->drug_frequency;
                        $drugobj->call_module = 'diabetes';
                        $drugobj->follow_uuid = $disabled_uuid;     
                        //$drugobj->debugLevel(9);
						$drugobj->insert();
						$drugobj->free_statement();
				    }	
				  }
				  else
				  {  
				  	 foreach ($table as $row)
					 {    
					 	  $get_orgid           = $row->org_id;
					      $get_ext_uuid        = $row->ext_uuid;
					      $get_identity_number = $row->identity_number;
					      //获取真正的机构ID
					      $orgobject =  new Torganization();
					      $orgobject->whereAdd("standard_code='$get_orgid'");
					      $orgobject->find(true);
					      $currentorgid = $orgobject->id;
					      if(empty($currentorgid))
						  {
							$error = 2;
							$errorstring.="<table name='$realtable'><return_code>2</return_code><return_string>身份证号为:".$get_identity_number."的机构不存在</return_string></table>";
							$errornumber++;
							continue;
						  }
					      $orgobject->free_statement();
					      //获取个人ID号
					      $individual     = new Tindividual_core();
						  $individual->whereAdd("identity_number='$get_identity_number'");
						  $individual->find(true);
						  $individual_id  = $individual->uuid;
						  $individual->free_statement();
					      //判断有无糖尿病随访主表数据
					      $diabetes_core = new Tdiabetes_core();
						  $diabetes_core->whereAdd("id='$individual_id'");
						  $diabetes_core->whereAdd("ext_uuid='$get_ext_uuid'");
						  $diabetes_core->whereAdd("org_id='$currentorgid'");
						  if($diabetes_core->count()<1)
						  {
							$error = 2;
							$errorstring.="<table name='$realtable'><return_code>2</return_code><return_string>身份证号为:".$get_identity_number."的病人糖尿病随访档案不存在</return_string></table>";
							$errornumber++;
							continue;
						  }
						  //获取主表的UUid
					      $diabetes_core_uuid = new Tdiabetes_core();
						  $diabetes_core_uuid->whereAdd("id='$individual_id'");
						  $diabetes_core_uuid->whereAdd("ext_uuid='$get_ext_uuid'");
						  $diabetes_core_uuid->whereAdd("org_id='$currentorgid'");
						  $diabetes_core_uuid->find(true);
						  $other_uuid  	 = 		$diabetes_core_uuid->uuid;
						  $diabetes_core_uuid->free_statement();		
						  $tag_name = new $tableobj();//实例化表对象
						  $tag_name->whereAdd("id='$individual_id'");
						  $tag_name->whereAdd("ext_uuid='$get_ext_uuid'");
						  $tag_name->whereAdd("org_id='$currentorgid'");
						  $exam_number = $tag_name->count();
						  $newtableobj = new $tableobj();
					  	  foreach($row as $colum=>$v)
					      {
						      	$newtableobj->$colum = $v;
//						      	if($realtable=='diabetes_accessory_examine')
//						      	{
//						      		if(empty($row->eamination_time)||!isset($row->eamination_time))
//						      		{
//						      			$row->eamination_time=time();
//						      		}
//						      	}
						      	//处理时间
						      	if(empty($row->created)||!isset($row->created))
								{
									$newtableobj->created = time();
								}
								else
								{
									$newtableobj->created = $row->created;
								}
								//医生ID
						     	$staff_id = $row->staff_id;
								$staff_archive=new Tstaff_archive();
						        $staff_archive->whereAdd("identity_card_number='$staff_id'");
								$staff_archive->find(true);
								$newtableobj->staff_id=$staff_archive->user_id;
								$staff_archive->free_statement();
								//机构ID转换
								$newtableobj->org_id=$currentorgid;
						     	unset($newtableobj->identity_number);//不需要身份证
								if(isset($dic_table["$realtable"]))
								{
								   foreach($dic_table["$realtable"] as $k=>$v)
							      {
							    	 if(strpos($row->$k,'|')===false)
							    	 {
							    		//不存在竖线分隔的字符串
							    		$newtableobj->$k = array_code_change($row->$k,$$v);
							    	 }
							    	 else
							    	 {	
							    		//存在竖线分隔的字符串
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
			  	             $newtableobj->uuid  = $other_uuid;
			  	             $newtableobj->id    = $individual_id;
	                       	 if($newtableobj->insert())
	                       	 {
	                       	 	$error =1; 
		                       	$successsstring.= "<table name='$realtable'><row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row></table>";
		                       	$successnumber++;
	                       	 }
	                       	 else
	                       	 {
	                       	 	$error =3;
	                       	 	$sqlerror = $newtableobj->showErrorMessage();
		                       	$errorstring = "<table name='$realtable'><row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row></table>";
		                       	$returnstring.= $sqlerror.$realtable.'部分数据未能成功插入';
		                       	$errornumber++;
		                       	continue;
	                       	 }  
                       }
                       else
                       {                     	 
                       	 $newtableobj->whereAdd("id='$individual_id'");
						 $newtableobj->whereAdd("ext_uuid='$get_ext_uuid'");
						 $newtableobj->whereAdd("org_id='$currentorgid'");
						 if( $newtableobj->update())
						 {
	                       	$successsstring.= "<table name='$realtable'><row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row></table>";
	                       	$successnumber++;
						 }
						 else
						 {
						 	$error = 3;
	                       	$errorstring.= "<table name='$realtable'><row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row></table>";
	                       	$errornumber++;
	                       	continue;
						  }
                       } 
               $newtableobj->free_statement();			         	   
			}		 		
       }
 }
                                     
      return $xmlhead.'<success_transaction>'.$successsstring.'</success_transaction><error_transaction>'.$errorstring.'</error_transaction><return_string>数据插入或者更新成功'.$successnumber.'条,插入或者更新失败'.$errornumber.'条</return_string>'.$xmlend;
        }
}
    /**
     * 取某个机构下边的所有人的uuid 身份证号 和 org_id
     * (2013年5月8号新增 为了让中联能取到平台中的糖尿病数据  业务号为平台数据的uuid 为了调用下边的ws_select_single接口)
     */
    function ws_select_all($token,$xml_string)
    {
    	require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/diabetes_core.php";
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
				//取得做过糖尿病随访的人
				$diabetes_core = new Tdiabetes_core();
				$diabetes_core->query("select count(*) as cou from diabetes_core where diabetes_core.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
				$diabetes_core->fetch();
				$number = $diabetes_core->cou;
				if($number>0)
				{
					$diabetes_core_select = new Tdiabetes_core();
					$diabetes_core_select->query("select * from diabetes_core where diabetes_core.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
					$response_str = '';
				    while ($diabetes_core_select->fetch())
				    {
				    	$response_str.='<row>';
				    	$ext_uuid = $diabetes_core_select->uuid;
			            //取得这个人的身份证号
			            $individual_core = new Tindividual_core();
			            $individual_core->whereAdd("uuid='$diabetes_core_select->id'");
			            $individual_core->find(true);
			            $identity_number = $individual_core->identity_number;
				    	$response_str.='<identity_number>'.$identity_number.'</identity_number>';
				    	$response_str.='<org_id>'.$org_id.'</org_id>';
				    	if($diabetes_core_select->ext_uuid=='')
				    	{
				    	  $response_str.='<ext_uuid>'.$ext_uuid.'</ext_uuid>';
				    	}
				    	else 
				    	{
				    		$response_str.='<ext_uuid>'.$diabetes_core_select->ext_uuid.'</ext_uuid>';
				    	}
				    	$response_str.='</row>';
				    	$individual_core->free_statement();
				    }
				    $diabetes_core_select->free_statement();
				    return $xmlhead.$response_str.$xmlend;
				}
				else 
				{
					return $xmlhead."<return_code>2</return_code><return_string>机构号为".$org_id."的机构没有查询到糖尿病随访病人</return_string>".$xmlend;
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
     * (2013年5月10号新增 为了让中联能取到平台中的糖尿病数据  业务号为平台数据的uuid 为了调用下边的ws_select_single接口)
     */
    function ws_select_persons($token,$xml_string)
    {
    	require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/diabetes_core.php";
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
		//取得这个身份证和机构联查得到的所有糖尿病随访数据
		$diabetes_core = new Tdiabetes_core();
		$diabetes_core->query("select count(*) as cou from diabetes_core where diabetes_core.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number' and individual_core.identity_number='$identity_number')");
		$diabetes_core->fetch();
		$count = $diabetes_core->cou;
		if($count>0)
		{   
			$response_str = '';
			$diabetes_core_select = new Tdiabetes_core();
			$diabetes_core_select->query("select * from diabetes_core where diabetes_core.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number' and individual_core.identity_number='$identity_number')");
			while ($diabetes_core_select->fetch())
			{
				$response_str.='<row>';
				$ext_uuid = $diabetes_core_select->uuid;
	            //取得这个人的身份证号
	            $individual_core = new Tindividual_core();
	            $individual_core->whereAdd("uuid='$diabetes_core_select->id'");
	            $individual_core->find(true);
	            $identity_number = $individual_core->identity_number;
		    	$response_str.='<identity_number>'.$identity_number.'</identity_number>';
		    	$response_str.='<org_id>'.$org_id.'</org_id>';
		    	if($diabetes_core_select->ext_uuid=='')
		    	{
		    	  $response_str.='<ext_uuid>'.$ext_uuid.'</ext_uuid>';
		    	}
		    	else 
		    	{
		    		$response_str.='<ext_uuid>'.$diabetes_core_select->ext_uuid.'</ext_uuid>';
		    	}
		    	$response_str.='</row>';
		    	$individual_core->free_statement();	
			}
			$diabetes_core_select->free_statement();
			return $xmlhead.$response_str.$xmlend;
		}
		else 
		{
			return $xmlhead."<return_code>2</return_code><return_string>身份证为".$identity_number."，机构号为".$org_id."的糖尿病数据未查询到！</return_string>".$xmlend;
		}
    }
    /**
     * 查询单条数据
     *
     * @param unknown_type $org_id
     * @param unknown_type $where_string
     * @return unknown
     */
    function ws_select_single($token,$xml_string){
          /*if(checkToken($token)!=1){
			$xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>请先登陆后在进行数据处理</return_string></message>";
			return $xml_string;	
		   }*/
    	    require_once(__SITEROOT.'library/Models/organization.php');
    	    require_once __SITEROOT."/library/Models/staff_archive.php";
			require_once __SITEROOT."/library/Models/individual_archive.php";
			require_once __SITEROOT."/library/Models/individual_core.php";
			require_once __SITEROOT."library/Models/diabetes_core.php";
			require_once __SITEROOT."library/Models/diabetes_symptom.php";
			require_once __SITEROOT."library/Models/diabetes_physical_sign.php";
			require_once __SITEROOT."library/Models/diabetes_lifestyle_guide.php";
			require_once __SITEROOT."library/Models/diabetes_accessory_examine.php";
			require_once __SITEROOT."library/Models/diabetes_patient_referral.php";
			require_once __SITEROOT."library/Models/follow_up_drugs.php";
			require_once __SITEROOT.'/library/custom/comm_function.php';
			require_once __SITEROOT.'/library/data_arr/arrdata.php';
			$xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
		    $xmlend  = "</message>";
		    $myarray=array('uuid','group_id','id','follow_uuid','call_module');//需要排除的字段
			$getxml = new SimpleXMLElement($xml_string);
			$get_orgid           = $getxml->org_id;
		    $get_ext_uuid        = $getxml->ext_uuid;
			$get_identity_number = $getxml->identity_number;
			if(empty($get_ext_uuid))
			{
				return $xmlhead."<return_code>2</return_code><return_string>业务号不存在</return_string>".$xmlend;
			}
			//通过standard_code查找我们系统中对应的机构ID
			$ourorg = new Torganization();
			$ourorg->whereAdd("standard_code='$get_orgid'");
			$ourorg->find(true);
			$myorgid = $ourorg->id;
			//判断在个人信息表中是否存在该数据（不存在不能传数据）
			$individual_core = new Tindividual_core();
			$individual_core->whereAdd("identity_number='$get_identity_number'");
			$individualNumber = $individual_core->count();
			if($individualNumber!=1){
				return $xmlhead."<return_code>2</return_code><return_string>身份证号为".$get_identity_number."的个人基本档案不存在</return_string>".$xmlend;
			}else{	
					$individual     = new Tindividual_core();
					$individual->whereAdd("identity_number='$get_identity_number'");
					$individual->find(true);
					$individual_id  = $individual->uuid;
					//判断有当前这个数据没有
					$match_array = preg_match_all('~^D_.*?\..*?$~',$get_ext_uuid,$my_array);//判断是中联数据还是平台数据
					if(empty($my_array[0][0]))
					{
						$tag=true;
					}
					else 
					{
						$tag=false;
					}
					$core = new Tdiabetes_core();
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
						return $xmlhead."<return_code>2</return_code><return_string>身份证为".$get_identity_number.",业务号为".$get_ext_uuid.",机构号为".$get_orgid."的预防接种随访数据不存在</return_string>".$xmlend;
					}
					else
					{
					$tag_name = new Tdiabetes_core();
					if($tag)
					{
						$tag_name->whereAdd("id='$individual_id'");
						$tag_name->whereAdd("ext_uuid='$get_ext_uuid'");
						$tag_name->whereAdd("org_id='$myorgid'");
					}
					else 
					{
						$tag_name->whereAdd("uuid='$get_ext_uuid'");
					}
					$tag_name->find(true);
					//反查二型糖尿病的主表找到主表的UUID		
					if($tag)
					{	
						$et_uuid = $tag_name->uuid; 
					}
					else 
					{
						$et_uuid = $get_ext_uuid;
					}
					$table_array=array('diabetes_lifestyle_guide'=>'二型糖尿病生活方式指导','diabetes_patient_referral'=>'2型糖尿病转诊','diabetes_physical_sign'=>'2型糖尿病体征','diabetes_symptom'=>'2型糖尿病症状','diabetes_accessory_examine'=>'2型糖尿病血糖');
					$dic_table = array('diabetes_symptom'=>array('diabetes_symptom'=>'diabetes_symptom'),'diabetes_physical_sign'=>array('arteria_dorsalis_pedis'=>'arteria_dorsalis_pedis'),'diabetes_lifestyle_guide'=>array('complian'=>'complian','heart_adjustment'=>'heart_adjustment'));
					//确定唯一记录.
					$response = "<?xml version='1.0' encoding='UTF-8'?><tables>";
					$response.="<table name='diabetes_core'><row><identity_number>".$get_identity_number."</identity_number>";
					//转换orgid
				    $tag_name->org_id = $get_orgid;
				   //转换staffid
					$staff_archive=new Tstaff_archive();
					$staff_archive->whereAdd("user_id='$tag_name->staff_id'");
					$staff_archive->find(true);
					$staff_identity_number = $staff_archive->identity_card_number;
					$tag_name->staff_id = $staff_identity_number;
					//转换followup_doctor
					$followup_doctor = $tag_name->followup_doctor;
					$staff_archive_doc = new Tstaff_archive();
					$staff_archive_doc->whereAdd("user_id='$followup_doctor'");
					$staff_archive_doc->find(true);
					$tag_name->followup_doctor=$staff_archive_doc->identity_card_number;
					//转换数据字典的内容
					$dic_table['diabetes_core'] = array('type_of_followup'=>'type_of_followup','compliance'=>'compliance','adverse_drug_reaction'=>'adverse_drug_reaction','reactive_hypoglycemia'=>'reactive_hypoglycemia','followup_classification'=>'followup_classification');
					 foreach($dic_table['diabetes_core'] as $k=>$v)
						     {
						     	if (strpos($tag_name->$k,'|')===false)
						     	{
						     		//没有竖线分隔的字符串
						     		$tag_name->$k=array_search_for_other($tag_name->$k,$$v);	
						     	}else
						     	{
						     		//有竖线分隔的字符串
						     		$temp=array();
						     		$temp_str=array();
									$temp=explode('|',$tag_name->$k);
									foreach($temp as $temp_k=>$temp_v)
									{
										if($temp_v!=='')
										{
											$temp_str[$temp_k] = array_search_for_other($temp_v,$$v);
										}
									}
									$tag_name->$k = rtrim(implode('|',$temp_str),'|');
						     	}
						     }
				   $tag_name->org_id  = $get_orgid;
				   if(!$tag)
				   {
				   	 $tag_name->ext_uuid = $get_ext_uuid;
				   }
						     //unset($tag_name->insulin_class);
					$response.=$tag_name->toXML('',$myarray);
					$response.="</row></table>";
					//主表要先创建
					foreach($table_array as $table=>$tablecomment){
						$tablobjname =  "T".$table;
						$tablobj     =  new $tablobjname();
						$tablobj->whereAdd("uuid='$et_uuid'");
						if($tablobj->count()>0)
						{
							$tablobj->find();
							while($tablobj->fetch()){			   
						   	     $tablobj->org_id = $get_orgid;
							   	  //转换医生id
								 $staff_archive=new Tstaff_archive();
								 $staff_archive->whereAdd("user_id='$tablobj->staff_id'");
								 $staff_archive->find(true);
								 $staff_identity_number = $staff_archive->identity_card_number;
								 $tablobj->staff_id = $staff_identity_number;
							     $response.="<table name='$table'><row><identity_number>".$get_identity_number."</identity_number>";
							     //转换数据字典
							     if(isset($dic_table[$table]))
							     {
							     foreach($dic_table[$table] as $k=>$v)
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
							   	 $tablobj->ext_uuid = $et_uuid;
							   }
							   $response.=$tablobj->toXML('',$myarray);
							   $response.="</row></table>";
							}		
						}
						else 
						{
							continue;
						}  
					}
					//此处还有个用药情况 
				   $drugsnumber  = new Tfollow_up_drugs();
				   $drugsnumber->whereAdd("follow_uuid='$et_uuid'");
				   if($drugsnumber->count()>0)
				   {
					   $response.="<table name='follow_up_drugs'>";
					   $drugs  = new Tfollow_up_drugs();
					   $drugs->whereAdd("follow_uuid='$et_uuid'");
					   $drugs->find();
					   while($drugs->fetch())
					   {
					   	 $response.="<row><identity_number>".$get_identity_number."</identity_number>";
					   	 $aa=$drugs->toArray(); 
					   	 //var_dump($aa);
					     foreach($aa as $ka=>$va)
					     {
						   $drugs->org_id = $get_orgid;
					   	  //转换医生id
						   	if($ka=='staff_id'){
								$staff_archive=new Tstaff_archive();
								$staff_archive->whereAdd("user_id='$va'");
								$staff_archive->find(true);
								$staff_identity_number = $staff_archive->identity_card_number;
								$drugs->$ka = $staff_identity_number;
						    }
						    if(!$tag)
						    {
						      $drugs->ext_uuid = $et_uuid;
						    }
					     }
					     $response.=$drugs->toXML('',$myarray);
					   	 $response.="</row>";
					   }
					   $response.="</table>";
				   }
			       $response.="</tables>";
			       return  $response;
					}
				}		
    }
    /**
     * 删除
     *
     * @param unknown_type $org_id
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
    	    require_once __SITEROOT."/library/Models/staff_archive.php";
			require_once __SITEROOT."/library/Models/individual_archive.php";
			require_once __SITEROOT."/library/Models/individual_core.php";
			require_once __SITEROOT."library/Models/diabetes_core.php";
			require_once __SITEROOT."library/Models/diabetes_symptom.php";
			require_once __SITEROOT."library/Models/diabetes_physical_sign.php";
			require_once __SITEROOT."library/Models/diabetes_lifestyle_guide.php";
			require_once __SITEROOT."library/Models/diabetes_accessory_examine.php";
			require_once __SITEROOT."library/Models/diabetes_patient_referral.php";
			require_once __SITEROOT."library/Models/follow_up_drugs.php";
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
		     if(empty($get_ext_uuid))
			 {
				return $xmlhead."<return_code>2</return_code><return_string>业务号不存在</return_string>".$xmlend;
			 }
			 $individual = new Tindividual_core();
			 $individual->whereAdd("identity_number='$get_identity_number'");
			 $individualNumber = $individual->count();
			 if($individualNumber!=1){
			 	    return $xmlhead.'<return_code>2</return_code><return_string>个人基本档案不存在</return_string>'.$xmlend;
					//return '该数据个人基本档案不存在,该数据根本不存在！';
			 }else{
			     //查询个人档案号
			     $individual_core  = new Tindividual_core();
			     $individual_core->whereAdd("identity_number='$get_identity_number'");
			     $individual_core->find(true);
			     $individual_id    = $individual_core->uuid;
			     $table_array=array('diabetes_core'=>'主表','diabetes_symptom'=>'症状表','diabetes_physical_sign'=>'体征','diabetes_lifestyle_guide'=>'生活方式指导','diabetes_accessory_examine'=>'辅助检查','diabetes_patient_referral'=>'转诊','follow_up_drugs'=>'用药');
			     foreach($table_array as $table=>$v){
			     	 $tablename = "T".$table;
			     	 $table_obiect = new $tablename();
			     	 $table_obiect->whereAdd("id='$individual_id'");
			     	 $table_obiect->whereAdd("org_id='$real_orgid'");
			     	 $table_obiect->whereAdd("ext_uuid='$get_ext_uuid'");
			     	 if(1 || $table_obiect->delete()){
			     	 	   $successsstring.= "<row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row>";
			     	 }else{
			     	 	    $error=3;
			     	 		$errorstring.= "<row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row>";
			     	 }
			     }
		     if($error=1){
				return $xmlhead."<return_code>1</return_code>".'<success_transaction>'.$successsstring.'</success_transaction><return_string>数据删除成功</return_string>'.$xmlend;
			}else{
				return $xmlhead."<return_code>3</return_code>".'<error_transaction>'.$errorstring.'</error_transaction><return_string>部分数据删除失败</return_string>'.$xmlend;
			}		 
			 }
    }
}
?>