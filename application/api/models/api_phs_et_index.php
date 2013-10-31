<?php
require_once __SITEROOT . "application/api/models/api_phs_iha_comm.php";
//require_once('api_phs_common.php');
class api_phs_et_index extends api_phs_comm{
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $org_id
	 * @param unknown_type $password
	 * @return unknown
	 */
  public function ws_login($org_id,$password){
		//return 'ok';
		return 1;
	}
    /**
     * 插入数据
     * @param unknown_type $token
     * @param unknown_type $xml_string
     */
    function ws_update ($token, $xml_string){
    	/*if(checkToken($token)!=1){
			$xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>请先登陆后在进行数据处理</return_string></message>";
			return $xml_string;	
		}*/
    	require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."library/Models/individual_archive.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once(__SITEROOT.'library/Models/examination_table.php');
		require_once(__SITEROOT.'library/Models/et_symptom.php');
		require_once(__SITEROOT.'library/Models/et_general_condition.php');
		require_once(__SITEROOT.'library/Models/et_lifestyle.php');
		require_once(__SITEROOT.'library/Models/et_organ.php');
		require_once(__SITEROOT.'library/Models/et_examination.php');
		require_once(__SITEROOT.'library/Models/et_identification.php');
		require_once(__SITEROOT.'library/Models/et_mhealth.php');
		require_once(__SITEROOT.'library/Models/et_hospitalization_history.php');
		require_once(__SITEROOT.'library/Models/et_operation_history.php');
		require_once(__SITEROOT.'library/Models/et_main_drug_use.php');
		require_once(__SITEROOT.'library/Models/et_nonepi_vaccination.php');
		require_once(__SITEROOT.'library/Models/et_health_assessment.php');
		require_once(__SITEROOT.'library/Models/et_health_guidance.php');
		require_once(__SITEROOT.'library/Models/et_lifecase_assessment.php');
		require_once __SITEROOT.'library/custom/comm_function.php';
	    require_once __SITEROOT.'library/data_arr/arrdata.php';
		$xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
		$xmlend  = "</message>";
		$successsstring ='';
		$errorstring = '';
		$returnstring = '';
		$default_serial_number = '511802-204-03-00001';
		$error =1;
		$error_number = 0;
		$success_number = 0;
                                    if(empty($xml_string))
                                       {
                                           return $xmlhead.'没有传入任何xml'.$xmlend;
                                       }
                                       else
                                       {
		$getxml = new SimpleXMLElement($xml_string);
		foreach ($getxml as $k=>$table){
			    $realtable = $table['name'];
			    $tabobjname = 'T'.$realtable;	
			    $tabobj    = new $tabobjname();
				//主表内容
				if($realtable=="examination_table")
				{
					//实例化表对象
				    $examination_table = new Texamination_table();
					foreach ($table as $row)
					{						
							//业务号是否存在
						if (!isset($row->ext_uuid)||$row->ext_uuid=="")
						{
							$error=2;
						    $errorstring.="<table name='examination_table'><return_code>".$error."</return_code><return_string>该身份证号".$row->identity_number."所对应的业务没有提供业务号</return_string></table>";
						    $error_number++;
						    continue;
						} 
					    //判断个人档案号是否存在
					    $individual_core = new Tindividual_core();
						$individual_core->whereAdd("identity_number='$row->identity_number'");
						$individualNumber = $individual_core->count();
						if($individualNumber!=1)
						{
							$error=2;
							$errorstring.="<table name='examination_table'><return_code>".$error."</return_code><return_string>该身份证号".$row->identity_number."所对应的个人基本档案不存在</return_string></table>";
							$error_number++;
						    continue;
						}
						$individual_core->free_statement();
				        //查找个人档案号
						$individual     = new Tindividual_core();
						$individual->whereAdd("identity_number='$row->identity_number'");
						$individual->find(true);
						$individual_id  = $individual->uuid;
						$individual->free_statement();
						//转换真正的org_id
						$real_org = new Torganization();
					    $real_org->whereAdd("standard_code='$row->org_id'");	
					    $real_org->find(true);
					    $real_orgid =  $real_org->id; 
					    $real_org->free_statement();
						//判断在个人信息表中是否存在该数据（更新或者添加的标志）
						$tag_name = new Texamination_table();
						$tag_name->whereAdd("id='$individual_id'");
						$tag_name->whereAdd("ext_uuid='$row->ext_uuid'");
						$tag_name->whereAdd("org_id='$real_orgid'");
						$exam_number = $tag_name->count();			
					    foreach($row as $colum=>$value)
					    {
						//$tag_name->free_statement();
                        //开始赋值
						$examination_table->$colum = $row->$colum;
						//转换机构org_id
						$examination_table->org_id = $real_orgid;
						//转换医生examination_doctor  如果不存在与我们系统相匹配的医生列表中不会存在该数据
						$staff_archive=new Tstaff_archive();
                        $staff_archive->whereAdd("identity_card_number='$row->examination_doctor'");
						$staff_archive->find(true);
						$examination_table->examination_doctor = $staff_archive->user_id;
						$staff_archive->free_statement();
						//转换staff_id
						$staff_archive=new Tstaff_archive();
                        $staff_archive->whereAdd("identity_card_number='$row->staff_id'");
						$staff_archive->find(true);
						$staff_archive->free_statement();
						$examination_table->staff_id=$staff_archive->user_id;
						//转换serial_number
						if(!isset($row->serial_number)||empty($row->serial_number))
						{
							$examination_table->serial_number = '00000-000-00-00000';
						}
						else
						{
							$examination_table->serial_number = $row->serial_number;
						}
						//转换created时间
						if(!isset($row->created)||empty($row->created))
						{
							$examination_table->created = time();
						}
						else
						{
							$examination_table->created = $row->created;
						}						
						unset($examination_table->identity_number);			        
						}
						if($exam_number!=1)
							{ 	
								//添加
								$error=1;
								$uuid     = uniqid('et',true);
								$examination_table->uuid     = $uuid;
								$examination_table->id       = $individual_id;
                   	            if($examination_table->insert())
                   	            {   
									//写入接口日志
									$logs_array=array("ext_uuid"=>$row->ext_uuid,"org_id"=>$row->org_id,"model_id"=>3,"upload_time"=>time(),"upload_token"=>1 );
									$this->insert_api_logs($logs_array);
                       	            $successsstring.= "<table name='examination_table'><row><org_id>".$row->org_id."</org_id><identity_number>".$row->identity_number."</identity_number><ext_uuid>".$row->ext_uuid."</ext_uuid></row></table>";
                       	            $success_number++;
                   	            }
                   	            else
                   	            {
                   	            	$sqlerror = $examination_table->showErrorMessage();
                   	                $errorstring.= "<table name='examination_table'><row><org_id>".$row->org_id."</org_id><identity_number>".$row->identity_number."</identity_number><ext_uuid>".$row->ext_uuid."</ext_uuid></row></table>";
                   	                $returnstring.= $sqlerror."examination_table主表信息未能成功插入数据";
                   	                $error_number++;
						            continue;
                   	            }
                             }
                             else
                             {   
                             	//更新              	 
		                       	 $examination_table->whereAdd("id='$individual_id'");
								 $examination_table->whereAdd("ext_uuid='$row->ext_uuid'");
								 $examination_table->whereAdd("org_id='$real_orgid'");
								 if( $examination_table->update())
								 {      
										//写入接口日志
										$logs_array=array("ext_uuid"=>$row->ext_uuid,"org_id"=>$row->org_id,"model_id"=>3,"upload_time"=>time(),"upload_token"=>2 );
										$this->insert_api_logs($logs_array);
								 	    $error=1;
	                       	            $successsstring.= "<table name='examination_table'><row><org_id>".$row->org_id."</org_id><identity_number>".$row->identity_number."</identity_number><ext_uuid>".$row->ext_uuid."</ext_uuid></row></table>";
	                       	            $success_number++;
								 }
								 else
								 {
								 	    $sqlerror = $examination_table->showErrorMessage();
								 	    $error =3;
                       	                $errorstring.= "<table name='examination_table'><row><org_id>".$row->org_id."</org_id><identity_number>".$row->identity_number."</identity_number><ext_uuid>".$row->ext_uuid."</ext_uuid></row></table>";
                       	                $returnstring.= $sqlerror."examination_table主表信息未能成功更新数据";
	                   	                $error_number++;
							            continue;
                                  }
                            }
                            $examination_table->free_statement();		
					}
				  }//主表处理结束
		     }
		    // return $error_number.'------'.$success_number;
		    $manyrows = array('et_main_drug_use','et_operation_history','et_hospitalization_history','et_nonepi_vaccination','et_lifecase_assessment');
		    foreach ($getxml as $k=>$table){
	               foreach($table as $row)
	               {
					    foreach ($manyrows as $v)
						{
					        //查找个人档案号
							$individual     = new Tindividual_core();
							$individual->whereAdd("identity_number='$row->identity_number'");
							$individual->find(true);
							$individual_id  = $individual->uuid;
							$individual->free_statement();
							//转换真正的org_id
							$real_org = new Torganization();
						    $real_org->whereAdd("standard_code='$row->org_id'");	
						    $real_org->find(true);
						    $real_orgid =  $real_org->id; 
						    $real_org->free_statement();							
							$objname = 'T'.$v;
							$objname = new $objname();
							$objname->whereAdd("id='$individual_id'");
							$objname->whereAdd("org_id='$real_orgid'");
							$objname->whereAdd("ext_uuid='$row->ext_uuid'");
							$objname->delete();
							$objname->free_statement();
						}
	               }
		    }
			foreach ($getxml as $k=>$table){
				      $realtable = $table['name'];
				      $tabobjname = 'T'.$realtable;	
			          $tabobj    = new $tabobjname();
				       //处理主表以外的其他表	
						if(in_array($realtable,$manyrows))
				        {
				        	//处理手术用药等信息
						  	foreach($table as $row)
						  	{ 	
							  	 	   //业务号是否存在
										if (!isset($row->ext_uuid)||$row->ext_uuid=="")
										{
											$error=2;
										    $errorstring.="<table name='$realtable'><return_code>".$error."</return_code><return_string>该身份证号".$row->identity_number."所对应的业务没有提供业务号</return_string></table>";
										    $error_number++;
								            continue;
										} 
										$tabobj->uuid  = uniqid('et_',true);
										//个人uuid
								  	 	$individual_core = new Tindividual_core();
								  	 	$individual_core->whereAdd("identity_number='$row->identity_number'");
								  	 	$individual_core->find(true);
								  	 	$individual_id = $individual_core->uuid;
								  	 	$individual_core->free_statement();
								  	 	//机构真正ID
								  	 	$org  = new Torganization();
								  	 	$org->whereAdd("standard_code='$row->org_id'");
								  	 	$org->find(true);
								  	 	$real_orgid = $org->id;
								  	 	$org->free_statement();
								  	 	//取当前其他表的ext_uuid,个人ID,机构ID号看主表数据是否存在
								  	 	//echo $individual_id.'--------'.$row->ext_uuid.'----------'.$real_orgid.'<br/>';
								  	 	$exitdata = new Texamination_table();
								  	 	$exitdata->whereAdd("id='$individual_id'");
								  	 	$exitdata->whereAdd("ext_uuid='$row->ext_uuid'");
								  	 	$exitdata->whereAdd("org_id='$real_orgid'");
								  	 	$exitnumber = $exitdata->count();
								  	 	if($exitnumber!=1)
								  	 	{
								  	 		$error=2;
											$errorstring.="<table name='$realtable'><return_code>".$error."</return_code><return_string>该身份证号".$row->identity_number."所对应的健康体检主表档案不存在</return_string></table>";
											$error_number++;
								            continue;
								  	 	}
								  	 	$exitdata->free_statement();
									  	//取主表的uuid
										$coreuuid = new Texamination_table();
										$coreuuid->whereAdd("id='$individual_id'");
										$coreuuid->whereAdd("ext_uuid='$row->ext_uuid'");
										$coreuuid->whereAdd("org_id='$real_orgid'");
										$coreuuid->find(true);
										$examine_id =$coreuuid->uuid;						  							  		     
								  	 foreach($row as $colum=>$value)
								  	 {

										$tabobj->$colum  = $row->$colum;
										//处理examination_id
										if($realtable!='et_lifecase_assessment') //当不是老年人生活方式和情感评分的时候才有该项
										{
											$tabobj->examination_id   = $examine_id;
										}
										//处理个人id号
										$tabobj->id               = $individual_id;
										//处理机构号
										$tabobj->org_id           = $real_orgid;
										//转换created时间
										if(!isset($row->created)||empty($row->created))
										{
											$tabobj->created = time();
										}
										else
										{
											$tabobj->created = $row->created;
										}				
										//echo $tabobj->created;							
										//处理staffid
										$staff_archive=new Tstaff_archive();
				                        $staff_archive->whereAdd("identity_card_number='$row->staff_id'");
										$staff_archive->find(true);
										$tabobj->staff_id=$staff_archive->user_id;	
										$staff_archive->free_statement();
										unset($tabobj->identity_number);	
										$coreuuid->free_statement();	 		                        
								  	 }
								  	// var_dump($tabobj);
								  	 //进行插入或者更新数据
	                                 if($tabobj->insert())
	                                 {
	                                 	$error=1;
	                                 	$sqlerror = $tabobj->showErrorMessage();
	                                 	//echo $sqlerror;
	                                 	$successsstring.= "<table name='$realtable'><row><org_id>".$row->org_id."</org_id><identity_number>".$row->identity_number."</identity_number><ext_uuid>".$row->ext_uuid."</ext_uuid></row></table>";
	                                 	$success_number++;
	                                 }
	                                 else
	                                 {
	                                 	$error=3;
	                                 	$sqlerror = $tabobj->showErrorMessage();
	                   	                $errorstring.= "<table name='$realtable'><row><org_id>".$row->org_id."</org_id><identity_number>".$row->identity_number."</identity_number><ext_uuid>".$row->ext_uuid."</ext_uuid></row></table>";
	                   	                $returnstring.= $sqlerror.$realtable."表信息未能成功插入数据";
	                   	                $error_number++;
							            continue;
						  	         }
						  	   }
				         }
				         else
				         {
				         	if($realtable=='examination_table')
				         	{
				         		continue;
				         	}
				         	//不是用药表,手术表
				         	//表中存在数据字典的情况
							$dic_table = array('et_symptom'=>array('symptom'=>'et_symptom'),'et_general_condition'=>array('elder_health_status'=>'elder_health_status','elder_living_skills'=>'elder_living_skills','older_cognitive_functions'=>'et_older_cognitive_functions','older_affective_state'=>'et_older_affective_state'),'et_lifestyle'=>array('sport_frequence'=>'et_sport_frequence','food_habit'=>'et_food_habit','smoke'=>'et_smoke','drink_frequency'=>'et_drink_frequency','drink'=>'et_drink','last_year_ntoxication'=>'et_last_year_ntoxication','drink_style'=>'et_drink_style','occupational_exposure'=>'et_occupational_exposure','chemistry_protection'=>'et_chemistry_protection','ray_protection'=>'et_ray_protection','pest_protection'=>'et_pest_protection','dust_protection'=>'et_dust_protection','other_types_protection'=>'other_types'),'et_organ'=>array('lips'=>'et_lips','pharyngeal_portion'=>'et_pharyngeal_portion','hearing'=>'et_hearing','energizing_function'=>'et_energizing_function','skin'=>'et_skin','sclera'=>'et_sclera','lymph_node'=>'et_lymph_node','lung_barrel_chest'=>'et_lung_barrel_chest','lung_sounds'=>'et_lung_sounds','lung_rale'=>'et_lung_rale','heart_rhythm'=>'et_heart_rhythm','heart_noise'=>'et_heart_noise','abdominal_tenderness'=>'et_abdominal_tenderness','abdominal_mass'=>'et_abdominal_tenderness','abdominal_hepatomegaly'=>'et_abdominal_tenderness','abdominal_splenomegaly'=>'et_abdominal_tenderness','shifting_dullness'=>'et_abdominal_tenderness','ramus_inferior_edema'=>'et_ramus_inferior_edema','foot_arterial_pulse'=>'et_foot_arterial_pulse','rectal_touch'=>'et_rectal_touch','mammary_gland'=>'et_mammary_gland','gynae_vulva'=>'et_gynae_vulva','gynae_cunt'=>'et_gynae_cunt','gynae_cervix'=>'et_gynae_cervix','gynae_uterus'=>'et_gynae_uterus','gynae_appendix'=>'et_gynae_appendix'),'et_examination'=>array('fecalblood'=>'et_fecalblood','hbsurface'=>'et_hbsurface','fundus'=>'et_fundus','ecg'=>'et_ecg','xrayfilm'=>'et_xrayfilm','bc'=>'et_bc','csmear'=>'et_csmear'),'et_identification'=>array('physical_medicine_val'=>'et_physical_medicine_val'),'et_mhealth'=>array('ceredisease_status'=>'et_ceredisease_status','kidneydisease_status'=>'et_kidneydisease_status','heartdisease_status'=>'et_heartdisease_status','vasculardisease_status'=>'et_vasculardisease_status','eyedisease_status'=>'et_eyedisease_status','nervousdisease_status'=>'et_nervousdisease_status','otherdisease_status'=>'et_otherdisease_status'),'et_health_assessment'=>array('health_assessment'=>'et_health_evaluation'),'et_health_guidance'=>array('health_assessment'=>'et_health_assessment','risk_factor_col'=>'et_risk_factor_col'));      
							foreach($table as $row)
							{
								  //业务号是否存在
										if (!isset($row->ext_uuid)||$row->ext_uuid=="")
										{
											$error=2;
										    $errorstring.="<table name='$realtable'><return_code>".$error."</return_code><return_string>该身份证号".$row->identity_number."所对应的业务没有提供业务号</return_string>";
		                   	                $error_number++;
								            continue;
										} 
										//个人uuid
								  	 	$individual_core = new Tindividual_core();
								  	 	$individual_core->whereAdd("identity_number='$row->identity_number'");
								  	 	$individual_core->find(true);
								  	 	$individual_id = $individual_core->uuid;
								  	 	$individual_core->free_statement();
								  	 	//机构真正ID
								  	 	$org  = new Torganization();
								  	 	$org->whereAdd("standard_code='$row->org_id'");
								  	 	$org->find(true);
								  	 	$real_orgid = $org->id;
								  	 	$org->free_statement();
								  	 	//取当前其他表的ext_uuid,个人ID,机构ID号看主表数据是否存在
								  	 	//echo $individual_id.'--------'.$row->ext_uuid.'----------'.$real_orgid.'<br/>';
								  	 	//exit();
								  	 	$exitdata = new Texamination_table();
								  	 	$exitdata->whereAdd("id='$individual_id'");
								  	 	$exitdata->whereAdd("ext_uuid='$row->ext_uuid'");
								  	 	$exitdata->whereAdd("org_id='$real_orgid'");
								  	 	//$exitdata->debugLevel(9);
								  	 	$exitnumber = $exitdata->count();
								  	 	if($exitnumber!=1)
								  	 	{
								  	 		$error=2;
											$errorstring.="<table name='$realtable'><return_code>".$error."</return_code><return_string>该身份证号".$row->identity_number."所对应的健康体检主表档案不存在</return_string></table>";
											$error_number++;
							                continue;
								  	 	}
								  	 	$exitdata->free_statement();
									  	//取主表的uuid
										$coreuuid = new Texamination_table();
										$coreuuid->whereAdd("id='$individual_id'");
										$coreuuid->whereAdd("ext_uuid='$row->ext_uuid'");
										$coreuuid->whereAdd("org_id='$real_orgid'");
										$coreuuid->find(true);
										$examine_id =$coreuuid->uuid;
							    foreach($row as $colum=>$value)
							    {	  	 	 
										$tabobj->$colum  = $row->$colum;
										//处理examination_id
										$tabobj->examination_id   = $examine_id;
										//处理个人id号
										$tabobj->id               = $individual_id;
										//处理机构号
										$tabobj->org_id           = $real_orgid;
										//转换created时间
										if(!isset($row->created)||empty($row->created))
										{
											$tabobj->created = time();
										}
										else
										{
											$tabobj->created = $row->created;
										}
										//处理staffid
										$staff_archive=new Tstaff_archive();
				                        $staff_archive->whereAdd("identity_card_number='$row->staff_id'");
										$staff_archive->find(true);
										$tabobj->staff_id=$staff_archive->user_id;	
										$staff_archive->free_statement();
										unset($tabobj->identity_number);
										foreach($dic_table["$realtable"] as $k=>$v)
									    {
									    	if(strpos($row->$k,'|')===false)
									    	{
									    		//不存在竖线分隔的字符串
									    		$tabobj->$k = array_code_change($row->$k,$$v);
                                                                                        
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
									    	    $tabobj->$k = rtrim(implode('|',$temp_array),'|');	    
									    	}
									     }											
										$coreuuid->free_statement();							    	
							    }
								//个人uuid
						  	 	$individual_core = new Tindividual_core();
						  	 	$individual_core->whereAdd("identity_number='$row->identity_number'");
						  	 	$individual_core->find(true);
						  	 	$individual_id = $individual_core->uuid;
						  	 	$individual_core->free_statement();
						  	 	//机构真正ID
						  	 	$org  = new Torganization();
						  	 	$org->whereAdd("standard_code='$row->org_id'");
						  	 	$org->find(true);
						  	 	$real_orgid = $org->id;
						  	 	$org->free_statement();
						  	 	$number = new $tabobjname();
						  	 	$number->whereAdd("id='$individual_id'");
						  	 	$number->whereAdd("org_id='$real_orgid'");
						  	 	$number->whereAdd("ext_uuid='$row->ext_uuid'");
//						  	 	$number->debugLevel(9);
//						  	 	echo $realtable.'------'.$individual_id.'----'.$real_orgid.'------'.$row->ext_uuid.'-------'.$tabobj->count().'<br/>';
						  	 	if($number->count()<1)
						  	 	{
						  	 		//echo $tabobj->count();
						  	 		$tabobj->uuid  = uniqid('et_',true);
							        if($tabobj->insert())
							        {
										
										
							        	$error=1;
				                       	$successsstring.= "<table name='$realtable'><row><org_id>".$row->org_id."</org_id><identity_number>".$row->identity_number."</identity_number><ext_uuid>".$row->ext_uuid."</ext_uuid></row></table>";
				                       	$success_number++;
		                       	    }
		                       	    else
		                       	    {
			                       	 	$error =3;
			                       	 	$sqlerror = $tabobj->showErrorMessage();
				                       	$errorstring = "<table name='$realtable'><row><org_id>".$row->org_id."</org_id><identity_number>".$row->identity_number."</identity_number><ext_uuid>".$row->ext_uuid."</ext_uuid></row></table>";
				                       	$returnstring.= $realtable.$sqlerror.'部分数据未能成功插入';
				                       	$error_number++;
							            continue;
		                       	   }  
						  	 	}
						  	 	else 
						  	 	{
						  	 		 $tabobj->whereAdd("id='$individual_id'");
									 $tabobj->whereAdd("ext_uuid='$row->ext_uuid'");
									 $tabobj->whereAdd("org_id='$real_orgid'");
									 if($tabobj->update())
									 {
										
									 	$error=1;
				                       	$successsstring.= "<table name='$realtable'><row><org_id>".$row->org_id."</org_id><identity_number>".$row->identity_number."</identity_number><ext_uuid>".$row->ext_uuid."</ext_uuid></row></table>";
				                       	$success_number++;
									 }
									 else
									 {
									 	$error =3;
									 	$sqlerror = $tabobj->showErrorMessage();
				                       	$errorstring.= "<table name='$realtable'><row><org_id>".$row->org_id."</org_id><identity_number>".$row->identity_number."</identity_number><ext_uuid>".$row->ext_uuid."</ext_uuid></row></table>";
				                       	$returnstring.= $sqlerror.$realtable.'部分数据未能成功更新';
				                       	$error_number++;
							            continue;
									 }		 
						  	 	}
						  	 	$number->free_statement();
						  	 	$tabobj->free_statement();
				            }
				         }
				      }
//				     if($error=1)
//				         {
				                 return $xmlhead.'<success_transaction>'.$successsstring.'</success_transaction><error_transaction>'.$errorstring.'</error_transaction><return_string>数据插入或者更新成功'.$success_number.'条,数据插入或更新失败'.$error_number.'条</return_string>'.$xmlend;
//			             }
//			             else
//			             {
//								return $xmlhead."<return_code>3</return_code>".'<error_transaction>'.$errorstring.'</error_transaction><return_string>'.$returnstring.'数据插入或者更新成功'.$success_number.'条,数据插入或更新失败'.$error_number.'条</return_string>'.$xmlend;
			             }		            				
    }
    
    /**
     * 取某个机构下边的所有人的uuid 身份证号 和 org_id
     * (2013年5月9号新增 为了让中联能取到平台中的健康体检数据  业务号为平台数据的uuid 为了调用下边的ws_select_single接口)
     */
    function ws_select_all($token,$xml_sting)
    {
    	require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/examination_table.php";
		$xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
		$xmlend  = "</message>";
		$getxml = new SimpleXMLElement($xml_sting);
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
				//取得做过体检的人
				$examination_table = new Texamination_table();
				$examination_table->query("select count(*) as cou from examination_table where examination_table.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
				$examination_table->fetch();
				$number = $examination_table->cou;
				if($number>0)
				{
					$examination_table_select = new Texamination_table();
					$examination_table_select->query("select * from examination_table where examination_table.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
					$response_str = '';
				    while ($examination_table_select->fetch())
				    {
				    	$ext_uuid = $examination_table_select->uuid;
			            //取得这个人的身份证号
			            $individual_core = new Tindividual_core();
			            $individual_core->whereAdd("uuid='$examination_table_select->id'");
			            $individual_core->find(true);
			            $identity_number = $individual_core->identity_number;
				    	$response_str.='<identity_number>'.$identity_number.'</identity_number>';
				    	$response_str.='<org_id>'.$org_id.'</org_id>';
				    	if($examination_table_select->ext_uuid=='')
				    	{
				    	  $response_str.='<ext_uuid>'.$ext_uuid.'</ext_uuid>';
				    	}
				    	else 
				    	{
				    		$response_str.='<ext_uuid>'.$examination_table_select->ext_uuid.'</ext_uuid>';
				    	}
				    	$individual_core->free_statement();
				    }
				    $examination_table_select->free_statement();
				    return $xmlhead.$response_str.$xmlend;
				}
				else 
				{
					return $xmlhead."<return_code>2</return_code><return_string>没有查询到体检数据</return_string>".$xmlend;
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
     * (2013年5月10号新增 为了让中联能取到平台中的体检数据  业务号为平台数据的uuid 为了调用下边的ws_select_single接口)
     */
    function ws_select_persons($token,$xml_string)
    {
    	require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/examination_table.php";
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
		$examination_table = new Texamination_table();
		$examination_table->query("select count(*) as cou from examination_table where examination_table.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number' and individual_core.identity_number='$identity_number')");
		$examination_table->fetch();
		$count = $examination_table->cou;
		if($count>0)
		{   
			$response_str = '';
			$examination_table_select = new Texamination_table();
			$examination_table_select->query("select * from examination_table where examination_table.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number' and individual_core.identity_number='$identity_number')");
			while ($examination_table_select->fetch())
			{
				$response_str.='<row>';
				$ext_uuid = $examination_table_select->uuid;
	            //取得这个人的身份证号
	            $individual_core = new Tindividual_core();
	            $individual_core->whereAdd("uuid='$examination_table_select->id'");
	            $individual_core->find(true);
	            $identity_number = $individual_core->identity_number;
		    	$response_str.='<identity_number>'.$identity_number.'</identity_number>';
		    	$response_str.='<org_id>'.$org_id.'</org_id>';
		    	if($examination_table_select->ext_uuid=='')
		    	{
		    	  $response_str.='<ext_uuid>'.$ext_uuid.'</ext_uuid>';
		    	}
		    	else 
		    	{
		    		$response_str.='<ext_uuid>'.$examination_table_select->ext_uuid.'</ext_uuid>';
		    	}
		    	$response_str.='</row>';
		    	$individual_core->free_statement();	
			}
			$examination_table_select->free_statement();
			return $xmlhead.$response_str.$xmlend;
		}
		else 
		{
			return $xmlhead."<return_code>2</return_code><return_string>身份证为".$identity_number."，机构号为".$org_id."的体检数据未查询到！</return_string>".$xmlend;
		}
    }
    /**
     * 查询当前数据是不是已经存在数据表中
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
    	    require_once __SITEROOT."library/Models/staff_archive.php";
			require_once __SITEROOT."library/Models/individual_archive.php";
			require_once __SITEROOT."library/Models/individual_core.php";
			require_once(__SITEROOT.'library/Models/examination_table.php');
			require_once(__SITEROOT.'library/Models/et_symptom.php');
			require_once(__SITEROOT.'library/Models/et_general_condition.php');
			require_once(__SITEROOT.'library/Models/et_lifestyle.php');
			require_once(__SITEROOT.'library/Models/et_organ.php');
			require_once(__SITEROOT.'library/Models/et_examination.php');
			require_once(__SITEROOT.'library/Models/et_identification.php');
			require_once(__SITEROOT.'library/Models/et_mhealth.php');
			require_once(__SITEROOT.'library/Models/et_hospitalization_history.php');
			require_once(__SITEROOT.'library/Models/et_operation_history.php');
			require_once(__SITEROOT.'library/Models/et_main_drug_use.php');
			require_once(__SITEROOT.'library/Models/et_nonepi_vaccination.php');
			require_once(__SITEROOT.'library/Models/et_health_assessment.php');
			require_once(__SITEROOT.'library/Models/et_health_guidance.php');
			require_once(__SITEROOT.'library/Models/et_lifecase_assessment.php');
			require_once __SITEROOT.'library/custom/comm_function.php';
			require_once __SITEROOT.'library/data_arr/arrdata.php';
			$xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
		    $xmlend  = "</message>";
		    $myarray=array('uuid','examination_id','id','serial_number');//需要排除的字段
				$getxml = new SimpleXMLElement($xml_string);
				$get_orgid           = $getxml->org_id;
			    $get_ext_uuid        = $getxml->ext_uuid;
			    $get_identity_number = $getxml->identity_number;
			    if(empty($get_ext_uuid))
				{
					return $xmlhead."<return_code>2</return_code><return_string>业务号不存在</return_string>".$xmlend;
				}
			    $organization_org = new Torganization();
				$organization_org->whereAdd("standard_code='$get_orgid'");
				$organization_org->find(true);
				$real_orgid = $organization_org->id;	
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
					$match_array = preg_match_all('~^et.*?\..*?$~',$get_ext_uuid,$my_array);//判断是中联数据还是平台数据
					if(empty($my_array[0][0]))
					{
						$tag=true;
					}
					else 
					{
						$tag=false;
					}
					$examintable = new Texamination_table();
					if($tag)
					{
						$examintable->whereAdd("id='$individual_id'");
						$examintable->whereAdd("ext_uuid='$get_ext_uuid'");
						$examintable->whereAdd("org_id='$real_orgid'");
					}
					else 
					{
						$examintable->whereAdd("uuid='$get_ext_uuid'");
					}
					if($examintable->count()!=1)
					{
						return $xmlhead."<return_code>2</return_code><return_string>身份证号为".$get_identity_number."的个人健康体检档案不存在</return_string>".$xmlend;
					}
					else
					{
					$tag_name = new Texamination_table();
					if($tag)
					{
						$tag_name->whereAdd("id='$individual_id'");
						$tag_name->whereAdd("ext_uuid='$get_ext_uuid'");
						$tag_name->whereAdd("org_id='$real_orgid'");
					}
					else 
					{
						$tag_name->whereAdd("uuid='$get_ext_uuid'");
					}
					$tag_name->find(true);
					//反查健康体检主表找到主表的UUID	
					if($tag)
					{			
					  $et_uuid = $tag_name->uuid;
					}
					else 
					{
					  $et_uuid = $get_ext_uuid;
					}
					$table_array=array('et_examination'=>'现存主要健康问题','et_general_condition'=>'一般状况','et_health_assessment'=>'健康评价','et_health_guidance'=>'健康指导','et_identification'=>'中医体质辨识','et_lifestyle'=>'生活方式','et_mhealth'=>'现存主要健康问题','et_organ'=>'脏器功能','et_symptom'=>'症状');
					$dic_table = array('et_symptom'=>array('symptom'=>'et_symptom'),'et_general_condition'=>array('elder_health_status'=>'elder_health_status','elder_living_skills'=>'elder_living_skills','older_cognitive_functions'=>'et_older_cognitive_functions','older_affective_state'=>'et_older_affective_state'),'et_lifestyle'=>array('sport_frequence'=>'et_sport_frequence','food_habit'=>'et_food_habit','smoke'=>'et_smoke','drink_frequency'=>'et_drink_frequency','drink'=>'et_drink','last_year_ntoxication'=>'et_last_year_ntoxication','drink_style'=>'et_drink_style','occupational_exposure'=>'et_occupational_exposure','chemistry_protection'=>'et_chemistry_protection','ray_protection'=>'et_ray_protection','pest_protection'=>'et_pest_protection','dust_protection'=>'et_dust_protection','other_types_protection'=>'other_types'),'et_organ'=>array('lips'=>'et_lips','pharyngeal_portion'=>'et_pharyngeal_portion','hearing'=>'et_hearing','energizing_function'=>'et_energizing_function','skin'=>'et_skin','sclera'=>'et_sclera','lymph_node'=>'et_lymph_node','lung_barrel_chest'=>'et_lung_barrel_chest','lung_sounds'=>'et_lung_sounds','lung_rale'=>'et_lung_rale','heart_rhythm'=>'et_heart_rhythm','heart_noise'=>'et_heart_noise','abdominal_tenderness'=>'et_abdominal_tenderness','abdominal_mass'=>'et_abdominal_tenderness','abdominal_hepatomegaly'=>'et_abdominal_tenderness','abdominal_splenomegaly'=>'et_abdominal_tenderness','shifting_dullness'=>'et_abdominal_tenderness','ramus_inferior_edema'=>'et_ramus_inferior_edema','foot_arterial_pulse'=>'et_foot_arterial_pulse','rectal_touch'=>'et_rectal_touch','mammary_gland'=>'et_mammary_gland','gynae_vulva'=>'et_gynae_vulva','gynae_cunt'=>'et_gynae_cunt','gynae_cervix'=>'et_gynae_cervix','gynae_uterus'=>'et_gynae_uterus','gynae_appendix'=>'et_gynae_appendix'),'et_examination'=>array('fecalblood'=>'et_fecalblood','hbsurface'=>'et_hbsurface','fundus'=>'et_fundus','ecg'=>'et_ecg','xrayfilm'=>'et_xrayfilm','bc'=>'et_bc','csmear'=>'et_csmear'),'et_identification'=>array('physical_medicine_val'=>'et_physical_medicine_val'),'et_mhealth'=>array('ceredisease_status'=>'et_ceredisease_status','kidneydisease_status'=>'et_kidneydisease_status','heartdisease_status'=>'et_heartdisease_status','vasculardisease_status'=>'et_vasculardisease_status','eyedisease_status'=>'et_eyedisease_status','nervousdisease_status'=>'et_nervousdisease_status','otherdisease_status'=>'et_otherdisease_status'),'et_health_assessment'=>array('health_assessment'=>'et_health_evaluation'),'et_health_guidance'=>array('health_assessment'=>'et_health_assessment','risk_factor_col'=>'et_risk_factor_col'));
					//确定唯一记录.
					$response = "<?xml version='1.0' encoding='UTF-8'?><tables>";
					$response.="<table name='examination_table'><row><identity_number>".$get_identity_number."</identity_number>";
					$tag_name->org_id = $get_orgid;
					//转换staff_id
					$staff_archive=new Tstaff_archive();
					$staff_archive->whereAdd("user_id='$tag_name->staff_id'");
					$staff_archive->find(true);
					$staff_identity_number = $staff_archive->identity_card_number;
					$tag_name->staff_id = $staff_identity_number;
					//转换examination_doctor
					$staff_archive=new Tstaff_archive();
					$staff_archive->whereAdd("user_id='$tag_name->examination_doctor'");
					$staff_archive->find(true);
					$staff_identity_number = $staff_archive->identity_card_number;
					$tag_name->examination_doctor = $staff_identity_number;
					if(!$tag)
					{
						$tag_name->ext_uuid = $et_uuid;
					}
					$response.=$tag_name->toXML('',$myarray);
					$response.="</row></table>";
					//用药多个row
					$et_main_drug_use = new Tet_main_drug_use();
					$et_main_drug_use->whereAdd("examination_id='$et_uuid'");
					if($et_main_drug_use->count()>0)
					{  
						$response.="<table name='et_main_drug_use'>";
						$et_main_drug_use->find();
						while($et_main_drug_use->fetch())
						{
							$response.="<row><identity_number>".$get_identity_number."</identity_number>";
	                        $et_main_drug_use->org_id   = $get_orgid;
							//转换staffid
							$staff_arcdurg = new Tstaff_archive();
							$staff_archive->whereAdd("user_id='$et_main_drug_use->staff_id'");
							$staff_archive->find(true);
							$et_main_drug_use->staff_id = $staff_archive->identity_card_number;
							if(!$tag)
							{
								$et_main_drug_use->ext_uuid = $et_uuid;
							}
							$response.=$et_main_drug_use->toXML('',$myarray);
						   	$response.="</row>";
						}
						$response.="</table>";
					}
					//手术多个row	
					$et_operation_history = new Tet_operation_history();
					$et_operation_history->whereAdd("examination_id='$et_uuid'");
					if($et_operation_history->count()>0)
					{
						$response.="<table name='et_operation_history'>";
						$et_operation_history->find();
						while($et_operation_history->fetch())
						{
							$response.="<row><identity_number>".$get_identity_number."</identity_number>";
	                        $et_operation_history->org_id   = $get_orgid;
							//转换staffid
							$staff_arcdurg = new Tstaff_archive();
							$staff_archive->whereAdd("user_id='$et_operation_history->staff_id'");
							$staff_archive->find(true);
							$et_operation_history->staff_id = $staff_archive->identity_card_number;
							if(!$tag)
							{
								$et_operation_history->ext_uuid = $et_uuid;
							}
							$response.=$et_operation_history->toXML('',$myarray);
						   	$response.="</row>";
						}
						$response.="</table>";
					}
					//住院多个row				
					$et_hospitalization_history = new Tet_hospitalization_history();
					$et_hospitalization_history->whereAdd("examination_id='$et_uuid'");
					if($et_hospitalization_history->count()>0)
					{
						$response.="<table name='et_hospitalization_history'>";
						$et_hospitalization_history->find();
						while($et_hospitalization_history->fetch())
						{
							$response.="<row><identity_number>".$get_identity_number."</identity_number>";
	                        $et_hospitalization_history->org_id   = $get_orgid;
							//转换staffid
							$staff_arcdurg = new Tstaff_archive();
							$staff_archive->whereAdd("user_id='$et_hospitalization_history->staff_id'");
							$staff_archive->find(true);
							$et_hospitalization_history->staff_id = $staff_archive->identity_card_number;
							if(!$tag)
							{
								$et_hospitalization_history->ext_uuid = $et_uuid;
							}
							$response.=$et_hospitalization_history->toXML('',$myarray);
						   	$response.="</row>";
						}
						$response.="</table>";
					}
					//预防接种多个row			
					$et_nonepi_vaccination = new Tet_nonepi_vaccination();
					$et_nonepi_vaccination->whereAdd("examination_id='$et_uuid'");
					if($et_nonepi_vaccination->count()>0)
					{
						$response.="<table name='et_nonepi_vaccination'>";
						$et_nonepi_vaccination->find();
						while($et_nonepi_vaccination->fetch())
						{
							$response.="<row><identity_number>".$get_identity_number."</identity_number>";
	                        $et_nonepi_vaccination->org_id   = $get_orgid;
							//转换staffid
							$staff_arcdurg = new Tstaff_archive();
							$staff_archive->whereAdd("user_id='$et_nonepi_vaccination->staff_id'");
							$staff_archive->find(true);
							$et_nonepi_vaccination->staff_id = $staff_archive->identity_card_number;
							if(!$tag)
							{
								$et_nonepi_vaccination->ext_uuid = $et_uuid;
							}
							$response.=$et_nonepi_vaccination->toXML('',$myarray);
						   	$response.="</row>";
						}
						$response.="</table>";
					}
					//判断当前体检的病人是不是老年人 如果是老年人那么就将老年人的信息给读出来
					$et_lifecase_assessment = new Tet_lifecase_assessment();
					$et_lifecase_assessment->whereAdd("id='$individual_id'");
					if($et_lifecase_assessment->count()>0)
					{
						$response.="<table name='et_lifecase_assessment'>";
						$et_lifecase_assessment->find();
						while($et_lifecase_assessment->fetch()){
							$response.="<row><identity_number>".$get_identity_number."</identity_number>";
							$et_lifecase_assessment->org_id   = $get_orgid;
							//转换staffid
							$staff_arcdurg = new Tstaff_archive();
							$staff_archive->whereAdd("user_id='$et_lifecase_assessment->staff_id'");
							$staff_archive->find(true);
							$et_lifecase_assessment->staff_id = $staff_archive->identity_card_number;
							if(!$tag)
							{
								$et_lifecase_assessment->ext_uuid = $et_uuid;
							}
							$response.=$et_lifecase_assessment->toXML('',$myarray);
							$response.="</row>";
						}
						$response.="</table>";
					}
					//主表要先创建
					foreach($table_array as $table=>$tablecomment){
						$tablobjname =  "T".$table;
						$tablobj     =  new $tablobjname();
						$tablobj->whereAdd("examination_id='$et_uuid'");
						if($tablobj->count()>0)
						{
							$tablobj->find();
							while($tablobj->fetch()){		   
							   	//转换机构id
						   	  	 $orgobject = new Torganization();
						   	  	 $orgobject->whereAdd("id='$real_orgid'");
						   	  	 $orgobject->find(true);
						   	     $tablobj->org_id = $orgobject->standard_code;
							   	  //转换医生id
								 $staff_archive=new Tstaff_archive();
								 $staff_archive->whereAdd("user_id='$tablobj->staff_id'");
								 $staff_archive->find(true);
								 $staff_identity_number = $staff_archive->identity_card_number;
								 $tablobj->staff_id = $staff_identity_number;
							     $response.="<table name='$table'><row><identity_number>".$get_identity_number."</identity_number>";
							     //转换数据字典
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
                                                                                //echo $k .'====================>'.$tablobj->$k.'<br />';
							     	}
							     }
							   if(!$tag)
							   {
								 $tablobj->ext_uuid = $et_uuid;
							   }
							   if($table=='et_identification')
							   {
							   	  $physical_medicine_name = $tablobj->physical_medicine_name;
							   	  $physical_medicine_name_array = explode('|',$physical_medicine_name);
							   	  $val_str = '';
							   	  $physical_medicine_val = $tablobj->physical_medicine_val;
							   	  if($physical_medicine_val=='')
							   	  {
							   	  	$val_str =' | | | | | | | | |';
							   	  }
							   	  else 
							   	  {
							   	  	$physical_medicine_val_array = explode('|',$physical_medicine_val);
							   	  	//var_dump($physical_medicine_val);
							   	    foreach ($physical_medicine_name_array as $k=>$v)
							   	    {
                                        //echo $physical_medicine_val_array[$k].'<br />';
							   	    	if(empty($physical_medicine_val_array[$k])||!isset($physical_medicine_val_array[$k]))
							   	    	{
							   	    		//echo "1<br />";
							   	    		$val_str.=' |';
							   	    	}
							   	    	else 
							   	    	{
							   	    			$val_str.=$physical_medicine_val_array[$k].'|';
							   	    	}
							   	    	//echo $val_str.'<br />';
							   	    }
							   	  } 
							   	  $length = strlen($val_str);
							   	  $result = substr($val_str,0,$length-1);
							   	 // echo $result;
							   	  $tablobj->physical_medicine_val = $result;  
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
	/*
	    	if(checkToken($token)!=1){
				$xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>请先登陆后在进行数据处理</return_string></message>";
				return $xml_string;	
				
			}
	*/
		function checkToken(){
			return 1;
		}
    	require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/Models/individual_archive.php";
		require_once __SITEROOT."/library/Models/individual_core.php";
		require_once(__SITEROOT.'library/Models/examination_table.php');
		require_once(__SITEROOT.'library/Models/et_symptom.php');
		require_once(__SITEROOT.'library/Models/et_general_condition.php');
		require_once(__SITEROOT.'library/Models/et_lifestyle.php');
		require_once(__SITEROOT.'library/Models/et_organ.php');
		require_once(__SITEROOT.'library/Models/et_examination.php');
		require_once(__SITEROOT.'library/Models/et_identification.php');
		require_once(__SITEROOT.'library/Models/et_mhealth.php');
		require_once(__SITEROOT.'library/Models/et_hospitalization_history.php');
		require_once(__SITEROOT.'library/Models/et_operation_history.php');
		require_once(__SITEROOT.'library/Models/et_main_drug_use.php');
		require_once(__SITEROOT.'library/Models/et_nonepi_vaccination.php');
		require_once(__SITEROOT.'library/Models/et_health_assessment.php');
		require_once(__SITEROOT.'library/Models/et_health_guidance.php');	
		require_once(__SITEROOT.'library/Models/et_health_guidance.php');
		$xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
		$xmlend  = "</message>";
		$successsstring = '';
		$errorstring = '';
		$error =1;
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
			 if($individualNumber<1){
			 	    return $xmlhead.'<return_code>2</return_code><return_string>个人基本档案不存在</return_string>'.$xmlend;
					//return '该数据个人基本档案不存在,该数据根本不存在！';
			 }else{
			     //查询个人档案号
			     $individual_core  = new Tindividual_core();
			     $individual_core->whereAdd("identity_number='$get_identity_number'");
			     $individual_core->find(true);
			     $individual_id    = $individual_core->uuid;
			     //查询当条数据是否存在
			      $delexamin = new Texamination_table();
			      $delexamin->whereAdd("id='$individual_id'");
			      $delexamin->whereAdd("org_id='$real_orgid'");
			      $delexamin->whereAdd("ext_uuid='$get_ext_uuid'");
			      if($delexamin->count()!=1)
			      {
			      	return $xmlhead.'<return_code>2</return_code><return_string>个人健康档案不存在</return_string>'.$xmlend;
			      }
			      else
			      {
			      $table_array=array('examination_table'=>'主表','et_examination'=>'现存主要健康问题','et_general_condition'=>'一般状况','et_health_assessment'=>'健康评价','et_health_guidance'=>'健康指导','et_hospitalization_history'=>'住院史','et_identification'=>'中医体质辨识','et_lifestyle'=>'生活方式','et_main_drug_use'=>'主要用药情况','et_mhealth'=>'现存主要健康问题','et_nonepi_vaccination'=>'非免疫规划预防接种史','et_operation_history'=>'手術史','et_organ'=>'脏器功能','et_symptom'=>'症状');
			     foreach($table_array as $table=>$v)
			     {
			     	 $tablename = "T".$table;
			     	 $table_obiect = new $tablename();
			     	 $table_obiect->whereAdd("id='$individual_id'");
			     	 $table_obiect->whereAdd("org_id='$real_orgid'");
			     	 $table_obiect->whereAdd("ext_uuid='$get_ext_uuid'");
			     	 if($table_obiect->delete()){
						//写入接口日志
						$logs_array=array("ext_uuid"=>$getxml->ext_uuid,"org_id"=>$getxml->org_id,"model_id"=>3,"upload_time"=>time(),"upload_token"=>3 );
						$this->insert_api_logs($logs_array);
			     	 	   $successsstring.= "<row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row>";
			     	 }else{
			     	 	    $error=3;
			     	 		$errorstring.= "<row><org_id>".$get_orgid."</org_id><identity_number>".$get_identity_number."</identity_number><ext_uuid>".$get_ext_uuid."</ext_uuid></row>";
			     	 }
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
}
?>