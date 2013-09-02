<?php
require_once __SITEROOT . "application/api/models/api_phs_iha_comm.php";
class api_his_index extends api_phs_comm
{
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
	 * 用于中联his数据的新增和更新
	 * 
	 */
	function ws_update($token,$xml_string)
	{
		require_once __SITEROOT."library/Models/api_summary.php";
		require_once __SITEROOT."library/Models/api_xml.php";
		require_once __SITEROOT."library/Models/api_doctor.php";
		require_once __SITEROOT."library/Models/organization.php";
		require_once __SITEROOT."library/Models/staff_core.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
		require_once __SITEROOT."library/Models/api_disease.php";
		require_once __SITEROOT."library/Models/api_drug.php";
		require_once __SITEROOT."library/Models/patient_referral_out.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once(__SITEROOT.'library/sms.php');//发短信库
		$xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
		$xmlend  = "</message>";
		$error_string ='';
		if(!empty($xml_string))
		{
            $xml = new SimpleXMLElement($xml_string);
            $top_element = $xml->getName();//取得文档的第一个节点（即模块id）
            if(!empty($top_element))
            {
            	switch ($top_element)
            	{
            		//门急诊病历
            		case 'EMR02.00.01':
            			$insert_xml = new Tapi_summary();
            			$document_id = $this->getval($xml,'EMR02.00.01.005');//文档id号
            			if(empty($document_id))
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>门急诊病历中文档号不存在</return_string>".$xmlend;
            			}
            			//机构id
            			$org_str = $this->getval($xml,'EMR02.00.01.072');
            			$org_array = explode('|',$org_str);
            			$org_id = $this->get_org($org_array[0]);//可能会有多个 但是值是一样的取第0维
            			if(!empty($org_id))
            			{
            			    $insert_xml->org_id  = $org_id;
            			}
            			else 
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>门急诊病历中机构不存在</return_string>".$xmlend;
            			}
  		                //医生id
  		                $staff_id = $this->getval($xml,'ZLE02.00.01.198');//医生服务id号  
  		                $staff_array = explode('|',$staff_id);           
  		                $staff_standard_core = $staff_array[0];//组合id
  		                $staff_core_id =  $this->get_staff($org_array[0],$staff_standard_core);
  		                $insert_xml->doctor_id = empty($staff_core_id)?'':$staff_core_id;
            			$identity_type = $this->getval($xml,'EMR02.00.01.011');//类型
            			$identity_array = explode('|',$identity_type);
            			foreach ($identity_array as $k=>$v)
            			{
            				if($v=='01')
            				{
            					$identity_number = $this->getval($xml,'EMR02.00.01.012');
            					$identity_number_array = explode('|',$identity_number);
            					if(isset($identity_number_array[$k])&&!empty($identity_number_array[$k]))
            				    {
            						$insert_xml->patient_identity_card = $identity_number_array[$k];//身份证号
            				    }
            				}
            			}
                        //针对这些有电子病历的人在平台上可能没有档案存在 那么 判断一次
            			$patient_name = $this->getval($xml,'EMR02.00.01.018');
            			$patient_sex = $this->getval($xml,'EMR02.00.01.021');
            			$document_time = $this->getval($xml,'EMR02.00.01.006');
            			$emr02_time = $this->getval($xml,'EMR02.00.01.322');
            			$insert_xml->patient_name = empty($patient_name)?'':$patient_name;//姓名
            			$insert_xml->patient_sex = empty($patient_sex)?'':$patient_sex;//性别
            			$insert_xml->document_time = empty($document_time)?time():strtotime($document_time);//文档时间
                        $insert_xml->emr02_time = empty($emr02_time)?time():strtotime($emr02_time);//门急诊诊断时间
                        //判断数据是否是添加还是修改
                        $api_xml = new Tapi_xml();
                        $api_xml->whereAdd("document_id='$document_id'");
                        if($api_xml->count()!=0)
                        {
                        	//编辑
                        	$insert_xml->updated = time();
                        	$insert_xml->whereAdd("document_id='$document_id'");
                        	if($insert_xml->update())
                        	{
                        		//这里需要先删除api_xml表中之前存在的那条记录
                        		$del_xml = new Tapi_xml();
                        		$del_xml->whereAdd("document_id='$document_id'");
                        		$del_xml->delete();
                        		$xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>12,"upload_time"=>time(),"upload_token"=>2 );
									$this->insert_api_logs($logs_array); 
                        			return $xmlhead."<return_code>1</return_code><return_string>门急诊病历数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{	
                        			return $xmlhead."<return_code>2</return_code><return_string>门急诊病历数据交换失败</return_string>".$xmlend;
                        		} 	
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>门急诊病历数据交换失败</return_string>".$xmlend;
                        	}
                        }
                        else 
                        {
                        	//添加	
                        	$insert_xml->uuid = uniqid('a_',true);
                        	$insert_xml->created = time();
                        	$insert_xml->updated = time();
                        	$insert_xml->module_id = $top_element;
                        	$insert_xml->document_id = $document_id;
                        	if($insert_xml->insert())
                        	{
                                $xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			//接口日志-插入接口记录
									$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>12,"upload_time"=>time(),"upload_token"=>1 );
									$this->insert_api_logs($logs_array); 
                        			return $xmlhead."<return_code>1</return_code><return_string>门急诊病历数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			//这里要删除summary中的那条数据
                        			$xml_del = new Tapi_summary();
                        			$xml_del->whereAdd("document_id='$document_id'");
                        			$xml_del->delete();
                        			return $xmlhead."<return_code>2</return_code><return_string>门急诊病历数据交换失败</return_string>".$xmlend;
                        		} 		
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>门急诊病历数据交换失败</return_string>".$xmlend;
                        	}
                        }
            			break;
            			//西医处方
            		case 'EMR03.00.01':
            			
            			$insert_xml = new Tapi_summary();
            			$document_id = $this->getval($xml,'EMR03.00.01.005');//文档id号
            			if(empty($document_id))
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>西医处方中文档号不存在</return_string>".$xmlend;
            			}
            			
            			//机构id
            			$org_str = $this->getval($xml,'EMR03.00.01.082');
            			$org_array = explode('|',$org_str);
            			$org_id = $this->get_org($org_array[0]);
            			if(!empty($org_id))
            			{
            			    $insert_xml->org_id  = $org_id;
            			}
            			else 
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>西医处方中机构不存在</return_string>".$xmlend;
            			}
  		                //医生id
  		                $staff_id = $this->getval($xml,'ZLE03.00.01.012');//医生服务id号
  		                $staff_array = explode('|',$staff_id);
  		                $staff_standard_core = $staff_array[0];//组合id
  		                $staff_core_id =  $this->get_staff($org_array[0],$staff_standard_core);
  		                $insert_xml->doctor_id = empty($staff_core_id)?'':$staff_core_id;
            			$identity_type = $this->getval($xml,'EMR03.00.01.011');//类型
            			$all_medical = $this->getval($xml,'EMR03.00.01.157');//取得所有西医药品名称
            			$all_medical_array = explode('|',$all_medical);//西药医药品名称数组
            			$all_medical_code = $this->getval($xml,'EMR03.00.01.161');//取得所有西医药品名称代码
            			$all_medical_code_array = explode('|',$all_medical_code);//西医药品名称代码数组
            			$identity_array = explode('|',$identity_type);
            			foreach ($identity_array as $k=>$v)
            			{
            				if($v=='01')
            				{
            					$identity_number = $this->getval($xml,'EMR03.00.01.012');
            					$identity_number_array = explode('|',$identity_number);
            					if(isset($identity_number_array[$k])&&!empty($identity_number_array[$k]))
            				    {
            						$insert_xml->patient_identity_card = $identity_number_array[$k];//身份证号
            				    }
            				}
            			}
            			$patient_name = $this->getval($xml,'EMR03.00.01.018');
            			$patient_sex = $this->getval($xml,'EMR03.00.01.021');
            			$document_time = $this->getval($xml,'EMR03.00.01.006');
            			$emr02_time = $this->getval($xml,'EMR03.00.01.142');//诊断时间
            			$insert_xml->patient_name = empty($patient_name)?'':$patient_name;//姓名
            			$insert_xml->patient_sex = empty($patient_sex)?'':$patient_sex;//性别
            			$insert_xml->document_time = empty($document_time)?time():strtotime($document_time);//文档时间
                        $insert_xml->emr02_time = empty($document_time)?time():strtotime($document_time);//门急诊诊断时间
                        //判断数据是否是添加还是修改
                        $api_xml = new Tapi_xml();
                        $api_xml->whereAdd("document_id='$document_id'");
                        if($api_xml->count()!=0)
                        {
                        	//编辑
                        	$insert_xml->updated = time();
                        	$insert_xml->whereAdd("document_id='$document_id'");
                        	if($insert_xml->update())
                        	{
                        		//这里需要先删除api_xml表中之前存在的那条记录
                        		$del_xml = new Tapi_xml();
                        		$del_xml->whereAdd("document_id='$document_id'");
                        		$del_xml->delete();
                        		$xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			//更新用药信息
                        			//先删除用药信息  再插入进去
                        			$api_drug_del = new Tapi_drug();
                        			$api_drug_del->whereAdd("document_id='$document_id'");
                        			$api_drug_del->delete();
                        			foreach($all_medical_array as $k=>$v)
			            			{
			            				$api_drug = new Tapi_drug();
			            				$api_drug->uuid   = uniqid('drug_',true);
			            				//检查是否有基药存在
			            				$tag = strpos($v,'.');
			            				if($tag!==false)
			            				{
			            					$api_drug->based_medicine = 1;//为基本药物
			            				}
			            				else 
			            				{
			            					$api_drug->based_medicine = 2;//不是基本药物
			            				}
			            				$api_drug->document_id  = $document_id;
			            				$api_drug->dignosis_time  = strtotime($emr02_time);
			            				$api_drug->drug_name  = $v;
			            				$api_drug->drug_code  = $all_medical_code_array[$k];
			            				$api_drug->org_id  = $org_id;
			            				$api_drug->insert();
			            			}
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>13,"upload_time"=>time(),"upload_token"=>2 );
									$this->insert_api_logs($logs_array); 
									
                        			return $xmlhead."<return_code>1</return_code><return_string>西医处方数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			return $xmlhead."<return_code>2</return_code><return_string>西医处方数据交换失败</return_string>".$xmlend;
                        		} 	
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>西医处方数据交换失败</return_string>".$xmlend;
                        	}
                        }
                        else 
                        {
                        	//添加	
                        	$insert_xml->uuid = uniqid('a_',true);
                        	$insert_xml->created = time();
                        	$insert_xml->updated = time();
                        	$insert_xml->module_id = $top_element;
                        	$insert_xml->document_id = $document_id;
                        	if($insert_xml->insert())
                        	{
                                $xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			//药物信息
                        			foreach($all_medical_array as $k=>$v)
			            			{
			            				$api_drug = new Tapi_drug();
			            				$api_drug->uuid   = uniqid('drug_',true);
			            				//检查是否有基药存在
			            				$tag = strpos($v,'.');
			            				if($tag!==false)
			            				{
			            					$api_drug->based_medicine = 1;//为基本药物
			            				}
			            				else 
			            				{
			            					$api_drug->based_medicine = 2;//不是基本药物
			            				}
			            				$api_drug->document_id  = $document_id;
			            				$api_drug->dignosis_time  = strtotime($emr02_time);
			            				$api_drug->drug_name  = $v;
			            				$api_drug->drug_code  = $all_medical_code_array[$k];
			            				$api_drug->org_id  = $org_id;
			            				$api_drug->insert();
			            			}
			            			//日志信息
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>13,"upload_time"=>time(),"upload_token"=>1 );
									$this->insert_api_logs($logs_array); 	
                        			return $xmlhead."<return_code>1</return_code><return_string>西医处方数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			//这里要删除summary中的那条数据
                        			$xml_del = new Tapi_summary();
                        			$xml_del->whereAdd("document_id='$document_id'");
                        			$xml_del->delete();
                        			return $xmlhead."<return_code>2</return_code><return_string>西医处方数据交换失败</return_string>".$xmlend;
                        		} 		
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>西医处方数据交换失败</return_string>".$xmlend;
                        	}
                        }
            			break;
            		//中医处方
            		case 'EMR03.00.02':
            			$insert_xml = new Tapi_summary();
            			$document_id = $this->getval($xml,'EMR03.00.02.005');//文档id号
            			if(empty($document_id))
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>中医处方中文档号不存在</return_string>".$xmlend;
            			}
            			//机构id
            			$org_str = $this->getval($xml,'EMR03.00.02.082');
            			$org_array = explode('|',$org_str);
            			$org_id = $this->get_org($org_array[0]);
            			if(!empty($org_id))
            			{
            			    $insert_xml->org_id  = $org_id;
            			}
            			else 
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>中医处方机构不存在</return_string>".$xmlend;
            			}
  		                //医生id
  		                $staff_id = $this->getval($xml,'ZLE03.00.02.003');//医生服务id号
  		                $staff_array = explode('|',$staff_id);
  		                $staff_standard_core = $staff_array[0];//组合id
  		                $staff_core_id =  $this->get_staff($org_array[0],$staff_standard_core);
  		                $insert_xml->doctor_id = empty($staff_core_id)?'':$staff_core_id;
            			$identity_type = $this->getval($xml,'EMR03.00.02.011');//类型
            			$identity_array = explode('|',$identity_type);
            			foreach ($identity_array as $k=>$v)
            			{
            				if($v=='01')
            				{
            					$identity_number = $this->getval($xml,'EMR03.00.02.012');
            					$identity_number_array = explode('|',$identity_number);
            					if(isset($identity_number_array[$k])&&!empty($identity_number_array[$k]))
            				    {
            						$insert_xml->patient_identity_card = $identity_number_array[$k];//身份证号
            				    }
            				}
            			}
            			$patient_name = $this->getval($xml,'EMR03.00.02.018');
            			$patient_sex = $this->getval($xml,'EMR03.00.02.021');
            			$document_time = $this->getval($xml,'EMR03.00.02.006');
            			$emr02_time = $this->getval($xml,'EMR03.00.02.142');//诊断时间
            			$insert_xml->patient_name = empty($patient_name)?'':$patient_name;//姓名
            			$insert_xml->patient_sex = empty($patient_sex)?'':$patient_sex;//性别
            			$insert_xml->document_time = empty($document_time)?'':strtotime($document_time);//文档时间
                        $insert_xml->emr02_time = empty($emr02_time)?time():strtotime($emr02_time);//门急诊诊断时间
                        $all_medical = $this->getval($xml,'EMR03.00.02.157');//取得所有中医药品名称
            			$all_medical_array = explode('|',$all_medical);//中药医药品名称数组
            			$all_medical_code = $this->getval($xml,'EMR03.00.02.161');//取得所有中医药品名称代码
            			$all_medical_code_array = explode('|',$all_medical_code);//中医药品名称代码数组
                        //判断数据是否是添加还是修改
                        $api_xml = new Tapi_xml();
                        $api_xml->whereAdd("document_id='$document_id'");
                        if($api_xml->count()!=0)
                        {
                        	//编辑
                        	$insert_xml->updated = time();
                        	$insert_xml->whereAdd("document_id='$document_id'");
                        	if($insert_xml->update())
                        	{
                        		//这里需要先删除api_xml表中之前存在的那条记录
                        		$del_xml = new Tapi_xml();
                        		$del_xml->whereAdd("document_id='$document_id'");
                        		$del_xml->delete();
                        		$xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			
                        			//更新用药信息
                        			//先删除用药信息  再插入进去
                        			$api_drug_del = new Tapi_drug();
                        			$api_drug_del->whereAdd("document_id='$document_id'");
                        			$api_drug_del->delete();
                        			foreach($all_medical_array as $k=>$v)
			            			{
			            				$api_drug = new Tapi_drug();
			            				$api_drug->uuid   = uniqid('drug_',true);
			            				$api_drug->based_medicine = 2;//不是基本药物
			            				$api_drug->document_id  = $document_id;
			            				$api_drug->dignosis_time  = strtotime($emr02_time);
			            				$api_drug->drug_name  = $v;
			            				$api_drug->drug_code  = $all_medical_code_array[$k];
			            				$api_drug->org_id  = $org_id;
			            				$api_drug->insert();
			            			}
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>14,"upload_time"=>time(),"upload_token"=>2 );
									$this->insert_api_logs($logs_array); 
                        			return $xmlhead."<return_code>1</return_code><return_string>中医处方数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			return $xmlhead."<return_code>2</return_code><return_string>中医处方数据交换失败</return_string>".$xmlend;
                        		} 	
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>中医处方数据交换失败</return_string>".$xmlend;
                        	}
                        }
                        else 
                        {
                        	//添加	
                        	$insert_xml->uuid = uniqid('a_',true);
                        	$insert_xml->created = time();
                        	$insert_xml->updated = time();
                        	$insert_xml->module_id = $top_element;
                        	$insert_xml->document_id = $document_id;
                        	if($insert_xml->insert())
                        	{
                                $xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			//药物信息
                        			foreach($all_medical_array as $k=>$v)
			            			{
			            				$api_drug = new Tapi_drug();
			            				$api_drug->uuid   = uniqid('drug_',true);
			            				$api_drug->based_medicine = 2;//不是基本药物
			            				$api_drug->document_id  = $document_id;
			            				$api_drug->dignosis_time  = strtotime($emr02_time);
			            				$api_drug->drug_name  = $v;
			            				$api_drug->drug_code  = $all_medical_code_array[$k];
			            				$api_drug->org_id  = $org_id;
			            				$api_drug->insert();
			            			}
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>14,"upload_time"=>time(),"upload_token"=>1 );
									$this->insert_api_logs($logs_array); 
                        			return $xmlhead."<return_code>1</return_code><return_string>中医处方数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			//这里要删除summary中的那条数据
                        			$xml_del = new Tapi_summary();
                        			$xml_del->whereAdd("document_id='$document_id'");
                        			$xml_del->delete();
                        			return $xmlhead."<return_code>2</return_code><return_string>中医处方数据交换失败</return_string>".$xmlend;
                        		} 		
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>中医处方数据交换失败</return_string>".$xmlend;
                        	}
                        }
            			break;
            			//检查记录
            			case 'EMR04.00.01':
            			$insert_xml = new Tapi_summary();
            			$document_id = $this->getval($xml,'EMR04.00.01.005');//文档id号
            			if(empty($document_id))
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>检查记录中文档号不存在</return_string>".$xmlend;
            			}
            			//机构id
            			$org_str = $this->getval($xml,'EMR04.00.01.062');
            			$org_array = explode('|',$org_str);
            			$org_id = $this->get_org($org_array[0]);
            			if(!empty($org_id))
            			{
            			    $insert_xml->org_id  = $org_id;
            			}
            			else 
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>检查记录机构不存在</return_string>".$xmlend;
            			}
  		                //医生id
  		                $staff_id = $this->getval($xml,'ZLE04.00.01.003');//医生服务id号
  		                $staff_array = explode('|',$staff_id);
  		                $staff_standard_core = $staff_array[0];//组合id
  		                $staff_core_id =  $this->get_staff($org_array[0],$staff_standard_core);
  		                $insert_xml->doctor_id = empty($staff_core_id)?'':$staff_core_id;
            			$identity_type = $this->getval($xml,'EMR04.00.01.011');//类型
            			$identity_array = explode('|',$identity_type);
            			foreach ($identity_array as $k=>$v)
            			{
            				if($v=='01')
            				{
            					$identity_number = $this->getval($xml,'EMR04.00.01.012');
            					$identity_number_array = explode('|',$identity_number);
            					if(isset($identity_number_array[$k])&&!empty($identity_number_array[$k]))
            				    {
            						$insert_xml->patient_identity_card = $identity_number_array[$k];//身份证号
            				    }
            				}
            			}
            			$patient_name = $this->getval($xml,'EMR04.00.01.018');
            			$patient_sex = $this->getval($xml,'EMR04.00.01.021');
            			$document_time = $this->getval($xml,'EMR04.00.01.006');
            			$insert_xml->patient_name = empty($patient_name)?'':$patient_name;//姓名
            			$insert_xml->patient_sex = empty($patient_sex)?'':$patient_sex;//性别
            			$insert_xml->document_time = empty($document_time)?time():strtotime($document_time);//文档时间
                        //判断数据是否是添加还是修改
                        $api_xml = new Tapi_xml();
                        $api_xml->whereAdd("document_id='$document_id'");
                        if($api_xml->count()!=0)
                        {
                        	//编辑
                        	$insert_xml->updated = time();
                        	$insert_xml->whereAdd("document_id='$document_id'");
                        	if($insert_xml->update())
                        	{
                        		//这里需要先删除api_xml表中之前存在的那条记录
                        		$del_xml = new Tapi_xml();
                        		$del_xml->whereAdd("document_id='$document_id'");
                        		$del_xml->delete();
                        		$xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>15,"upload_time"=>time(),"upload_token"=>2);
									$this->insert_api_logs($logs_array); 
                        			return $xmlhead."<return_code>1</return_code><return_string>检查记录数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			return $xmlhead."<return_code>2</return_code><return_string>检查记录数据交换失败</return_string>".$xmlend;
                        		} 	
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>检查记录数据交换失败</return_string>".$xmlend;
                        	}
                        }
                        else 
                        {
                        	//添加	
                        	$insert_xml->uuid = uniqid('a_',true);
                        	$insert_xml->created = time();
                        	$insert_xml->updated = time();
                        	$insert_xml->module_id = $top_element;
                        	$insert_xml->document_id = $document_id;
                        	if($insert_xml->insert())
                        	{
                                $xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>15,"upload_time"=>time(),"upload_token"=>1);
									$this->insert_api_logs($logs_array); 
                        			return $xmlhead."<return_code>1</return_code><return_string>检查记录数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			//这里要删除summary中的那条数据
                        			$xml_del = new Tapi_summary();
                        			$xml_del->whereAdd("document_id='$document_id'");
                        			$xml_del->delete();
                        			return $xmlhead."<return_code>2</return_code><return_string>检查记录数据交换失败</return_string>".$xmlend;
                        		} 		
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>检查记录数据交换失败</return_string>".$xmlend;
                        	}
                        }
            			break;
            			//检验记录
            		case 'EMR04.00.02':
            			$insert_xml = new Tapi_summary();
            			$document_id = $this->getval($xml,'EMR04.00.02.005');//文档id号
            			if(empty($document_id))
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>检验记录中文档号不存在</return_string>".$xmlend;
            			}
            			//机构id
            			$org_str = $this->getval($xml,'EMR04.00.02.032');
            			$org_array = explode('|',$org_str);
            			$org_id = $this->get_org($org_array[0]);
            			if(!empty($org_id))
            			{
            			    $insert_xml->org_id  = $org_id;
            			}
            			else 
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>检查记录机构不存在</return_string>".$xmlend;
            			}
  		                //医生id
  		                $staff_id = $this->getval($xml,'ZLE04.00.02.082');//医生服务id号
  		                $staff_array = explode('|',$staff_id);
  		                $staff_standard_core = $staff_array[0];//组合id
  		                $staff_core_id =  $this->get_staff($org_array[0],$staff_standard_core);
  		                $insert_xml->doctor_id = empty($staff_core_id)?'':$staff_core_id;
            			$identity_type = $this->getval($xml,'EMR04.00.02.011');//类型
            			$identity_array = explode('|',$identity_type);
            			foreach ($identity_array as $k=>$v)
            			{
            				if($v=='01')
            				{
            					$identity_number = $this->getval($xml,'EMR04.00.02.012');
            					$identity_number_array = explode('|',$identity_number);
            					if(isset($identity_number_array[$k])&&!empty($identity_number_array[$k]))
            				    {
            						$insert_xml->patient_identity_card = $identity_number_array[$k];//身份证号
            				    }
            				}
            			}
            			$patient_name = $this->getval($xml,'EMR04.00.02.018');
            			$patient_sex = $this->getval($xml,'EMR04.00.02.021');
            			$document_time = $this->getval($xml,'EMR04.00.02.006');
            			$insert_xml->patient_name = empty($patient_name)?'':$patient_name;//姓名
            			$insert_xml->patient_sex = empty($patient_sex)?'':$patient_sex;//性别
            			$insert_xml->document_time = empty($document_time)?time():strtotime($document_time);//文档时间
                        //判断数据是否是添加还是修改
                        $api_xml = new Tapi_xml();
                        $api_xml->whereAdd("document_id='$document_id'");
                        if($api_xml->count()!=0)
                        {
                        	//编辑
                        	$insert_xml->updated = time();
                        	$insert_xml->whereAdd("document_id='$document_id'");
                        	if($insert_xml->update())
                        	{
                        		//这里需要先删除api_xml表中之前存在的那条记录
                        		$del_xml = new Tapi_xml();
                        		$del_xml->whereAdd("document_id='$document_id'");
                        		$del_xml->delete();
                        		$xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>16,"upload_time"=>time(),"upload_token"=>2);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>检验记录数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			return $xmlhead."<return_code>2</return_code><return_string>检验记录数据交换失败</return_string>".$xmlend;
                        		} 	
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>检验记录数据交换失败</return_string>".$xmlend;
                        	}
                        }
                        else 
                        {
                        	//添加	
                        	$insert_xml->uuid = uniqid('a_',true);
                        	$insert_xml->created = time();
                        	$insert_xml->updated = time();
                        	$insert_xml->module_id = $top_element;
                        	$insert_xml->document_id = $document_id;
                        	if($insert_xml->insert())
                        	{
                                $xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>16,"upload_time"=>time(),"upload_token"=>1);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>检验记录数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			//这里要删除summary中的那条数据
                        			$xml_del = new Tapi_summary();
                        			$xml_del->whereAdd("document_id='$document_id'");
                        			$xml_del->delete();
                        			return $xmlhead."<return_code>2</return_code><return_string>检验记录数据交换失败</return_string>".$xmlend;
                        		} 		
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>检验记录数据交换失败</return_string>".$xmlend;
                        	}
                        }
            			break;
            			//生命体征测量记录
            		case 'EMR06.01.04':
            			$insert_xml = new Tapi_summary();
            			$document_id = $this->getval($xml,'EMR06.01.04.005');//文档id号
            			if(empty($document_id))
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>生命体征测量记录中文档号不存在</return_string>".$xmlend;
            			}
            			//机构id
            			$org_str = $this->getval($xml,'EMR06.01.04.042');
            			$org_array = explode('|',$org_str);
            			$org_id = $this->get_org($org_array[0]);
            			if(!empty($org_id))
            			{
            			    $insert_xml->org_id  = $org_id;
            			}
            			else 
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>生命体征测量记录中机构不存在</return_string>".$xmlend;
            			}
  		                //医生id
  		                $staff_id = $this->getval($xml,'ZLE06.01.04.004');//医生服务id号
  		                $staff_array = explode('|',$staff_id);
  		                $staff_standard_core = $staff_array[0];//组合id
  		                $staff_core_id =  $this->get_staff($org_array[0],$staff_standard_core);
  		                $insert_xml->doctor_id = empty($staff_core_id)?'':$staff_core_id;
            			$identity_type = $this->getval($xml,'EMR06.01.04.014');//类型
            			$identity_array = explode('|',$identity_type);
            			foreach ($identity_array as $k=>$v)
            			{
            				if($v=='01')
            				{
            					$identity_number = $this->getval($xml,'EMR06.01.04.015');
            					$identity_number_array = explode('|',$identity_number);
            					if(isset($identity_number_array[$k])&&!empty($identity_number_array[$k]))
            				    {
            						$insert_xml->patient_identity_card = $identity_number_array[$k];//身份证号
            				    }
            				}
            			}
            			$patient_name = $this->getval($xml,'EMR06.01.04.013');
            			$patient_sex = $this->getval($xml,'EMR06.01.04.024');
            			$document_time = $this->getval($xml,'EMR06.01.04.006');
            			$insert_xml->patient_name = empty($patient_name)?'':$patient_name;//姓名
            			$insert_xml->patient_sex = empty($patient_sex)?'':$patient_sex;//性别
            			$insert_xml->document_time = empty($document_time)?time():strtotime($document_time);//文档时间
                        //判断数据是否是添加还是修改
                        $api_xml = new Tapi_xml();
                        $api_xml->whereAdd("document_id='$document_id'");
                        if($api_xml->count()!=0)
                        {
                        	//编辑
                        	$insert_xml->updated = time();
                        	$insert_xml->whereAdd("document_id='$document_id'");
                        	if($insert_xml->update())
                        	{
                        		//这里需要先删除api_xml表中之前存在的那条记录
                        		$del_xml = new Tapi_xml();
                        		$del_xml->whereAdd("document_id='$document_id'");
                        		$del_xml->delete();
                        		$xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>17,"upload_time"=>time(),"upload_token"=>2);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>生命体征测量记录数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			return $xmlhead."<return_code>2</return_code><return_string>生命体征测量记录数据交换失败</return_string>".$xmlend;
                        		} 	
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>生命体征测量记录数据交换失败</return_string>".$xmlend;
                        	}
                        }
                        else 
                        {
                        	//添加	
                        	$insert_xml->uuid = uniqid('a_',true);
                        	$insert_xml->created = time();
                        	$insert_xml->updated = time();
                        	$insert_xml->module_id = $top_element;
                        	$insert_xml->document_id = $document_id;
                        	if($insert_xml->insert())
                        	{
                                $xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>17,"upload_time"=>time(),"upload_token"=>1);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>生命体征测量记录数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			//这里要删除summary中的那条数据
                        			$xml_del = new Tapi_summary();
                        			$xml_del->whereAdd("document_id='$document_id'");
                        			$xml_del->delete();
                        			return $xmlhead."<return_code>2</return_code><return_string>生命体征测量记录数据交换失败</return_string>".$xmlend;
                        		} 		
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>生命体征测量记录数据交换失败</return_string>".$xmlend;
                        	}
                        }
            			break;
            	   //入院记录
            		case 'EMR09.00.01':
            			$insert_xml = new Tapi_summary();
            			$document_id = $this->getval($xml,'EMR09.00.01.005');//文档id号
            			if(empty($document_id))
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>入院记录中文档号不存在</return_string>".$xmlend;
            			}
            			//机构id
            			$org_str = $this->getval($xml,'EMR09.00.01.052');
            			$org_array = explode('|',$org_str);
            			$org_id = $this->get_org($org_array[0]);
            			if(!empty($org_id))
            			{
            			    $insert_xml->org_id  = $org_id;
            			}
            			else 
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>入院记录中机构不存在</return_string>".$xmlend;
            			}
  		                //医生id
  		                $staff_id = $this->getval($xml,'ZLE09.00.01.060');//医生服务id号
  		                $staff_array = explode('|',$staff_id);
  		                $staff_standard_core = $staff_array[0];//组合id
  		                $staff_core_id =  $this->get_staff($org_array[0],$staff_standard_core);
  		                $insert_xml->doctor_id = empty($staff_core_id)?'':$staff_core_id;
            			$identity_type = $this->getval($xml,'EMR09.00.01.011');//类型
            			$identity_array = explode('|',$identity_type);
            			foreach ($identity_array as $k=>$v)
            			{
            				if($v=='01')
            				{
            					$identity_number = $this->getval($xml,'EMR09.00.01.012');
            					$identity_number_array = explode('|',$identity_number);
            					if(isset($identity_number_array[$k])&&!empty($identity_number_array[$k]))
            				    {
            						$insert_xml->patient_identity_card = $identity_number_array[$k];//身份证号
            				    }
            				}
            				if($v=='14')
            				{
            				    $zy_time = $this->getval($xml,'EMR09.00.01.013');
            					$zy_time_array = explode('|',$zy_time);
            					if(isset($zy_time_array[$k])&&!empty($zy_time_array[$k]))
            				    {
            					  $insert_xml->emr09_time = strtotime($zy_time_array[$k]);//入院
            				    }
            				    if(isset($zy_time_array[$k])&&!empty($zy_time_array[$k]))
            				    {
            						$insert_xml->emr12_time = strtotime($zy_time_array[$k]);//出院
            				    }
            				}
            			}
            			$patient_name = $this->getval($xml,'EMR09.00.01.018');
            			$patient_sex = $this->getval($xml,'EMR09.00.01.021');
            			$document_time = $this->getval($xml,'EMR09.00.01.006');
            			$insert_xml->patient_name = empty($patient_name)?'':$patient_name;//姓名
            			$insert_xml->patient_sex = empty($patient_sex)?'':$patient_sex;//性别
            			$insert_xml->document_time = empty($document_time)?time():strtotime($document_time);//文档时间
                        //判断数据是否是添加还是修改
                        $api_xml = new Tapi_xml();
                        $api_xml->whereAdd("document_id='$document_id'");
                        if($api_xml->count()!=0)
                        {
                        	//编辑
                        	$insert_xml->updated = time();
                        	$insert_xml->whereAdd("document_id='$document_id'");
                        	if($insert_xml->update())
                        	{
                        		//这里需要先删除api_xml表中之前存在的那条记录
                        		$del_xml = new Tapi_xml();
                        		$del_xml->whereAdd("document_id='$document_id'");
                        		$del_xml->delete();
                        		$xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>19,"upload_time"=>time(),"upload_token"=>2);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>入院记录数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			return $xmlhead."<return_code>2</return_code><return_string>入院记录数据交换失败</return_string>".$xmlend;
                        		} 	
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>入院记录数据交换失败</return_string>".$xmlend;
                        	}
                        }
                        else 
                        {
                        	//添加	
                        	$insert_xml->uuid = uniqid('a_',true);
                        	$insert_xml->created = time();
                        	$insert_xml->updated = time();
                        	$insert_xml->module_id = $top_element;
                        	$insert_xml->document_id = $document_id;
                        	if($insert_xml->insert())
                        	{
                                $xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>19,"upload_time"=>time(),"upload_token"=>1);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>入院记录数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			//这里要删除summary中的那条数据
                        			$xml_del = new Tapi_summary();
                        			$xml_del->whereAdd("document_id='$document_id'");
                        			$xml_del->delete();
                        			return $xmlhead."<return_code>2</return_code><return_string>入院记录数据交换失败</return_string>".$xmlend;
                        		} 		
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>入院记录数据交换失败</return_string>".$xmlend;
                        	}
                        }
            			break;
            			//病程记录
            		case 'EMR10.00.99':
            			$insert_xml = new Tapi_summary();
            			$document_id = $this->getval($xml,'ZLE10.00.99.049');//文档id号
            			if(empty($document_id))
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>病程记录中文档号不存在</return_string>".$xmlend;
            			}
            			//机构id
            			$org_str = $this->getval($xml,'ZLE10.00.99.028');
            			$org_array = explode('|',$org_str);
            			$org_id = $this->get_org($org_array[0]);
            			if(!empty($org_id))
            			{
            			    $insert_xml->org_id  = $org_id;
            			}
            			else 
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>病程记录中机构不存在</return_string>".$xmlend;
            			}
  		                //医生id
  		                $staff_id = $this->getval($xml,'ZLE10.00.99.037');//医生服务id号
  		                $staff_array = explode('|',$staff_id);
  		                $staff_standard_core = $staff_array[0];//组合id
  		                $staff_core_id =  $this->get_staff($org_array[0],$staff_standard_core);
  		                $insert_xml->doctor_id = empty($staff_core_id)?'':$staff_core_id;
            			$identity_type = $this->getval($xml,'ZLE10.00.99.012');//类型
            			$identity_array = explode('|',$identity_type);
            			foreach ($identity_array as $k=>$v)
            			{
            				if($v=='01')
            				{
            					$identity_number = $this->getval($xml,'ZLE10.00.99.013');
            					$identity_number_array = explode('|',$identity_number);
            					if(isset($identity_number_array[$k])&&!empty($identity_number_array[$k]))
            				    {
            						$insert_xml->patient_identity_card = $identity_number_array[$k];//身份证号
            				    }
            				}
            				if($v=='14')
            				{
            				    $zy_time = $this->getval($xml,'ZLE10.00.99.014');
            					$zy_time_array = explode('|',$zy_time);
            					if(isset($zy_time_array[$k])&&!empty($zy_time_array[$k]))
            				    {
            					  $insert_xml->emr09_time = strtotime($zy_time_array[$k]);//入院
            				    }
            				    if(isset($zy_time_array[$k])&&!empty($zy_time_array[$k]))
            				    {
            						$insert_xml->emr12_time = strtotime($zy_time_array[$k]);//出院
            				    }
            				}
            			}
            			$patient_name = $this->getval($xml,'ZLE10.00.99.009');
            			$patient_sex = $this->getval($xml,'ZLE10.00.99.019');
            			$document_time = $this->getval($xml,'ZLE10.00.99.005');
            			$insert_xml->patient_name = empty($patient_name)?'':$patient_name;//姓名
            			$insert_xml->patient_sex = empty($patient_sex)?'':$patient_sex;//性别
            			$insert_xml->document_time = empty($document_time)?time():strtotime($document_time);//文档时间
                        //判断数据是否是添加还是修改
                        $api_xml = new Tapi_xml();
                        $api_xml->whereAdd("document_id='$document_id'");
                        if($api_xml->count()!=0)
                        {
                        	//编辑
                        	$insert_xml->updated = time();
                        	$insert_xml->whereAdd("document_id='$document_id'");
                        	if($insert_xml->update())
                        	{
                        		//这里需要先删除api_xml表中之前存在的那条记录
                        		$del_xml = new Tapi_xml();
                        		$del_xml->whereAdd("document_id='$document_id'");
                        		$del_xml->delete();
                        		$xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>20,"upload_time"=>time(),"upload_token"=>2);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>病程记录数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			return $xmlhead."<return_code>2</return_code><return_string>病程记录数据交换失败</return_string>".$xmlend;
                        		} 	
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>病程记录数据交换失败</return_string>".$xmlend;
                        	}
                        }
                        else 
                        {
                        	//添加	
                        	$insert_xml->uuid = uniqid('a_',true);
                        	$insert_xml->created = time();
                        	$insert_xml->updated = time();
                        	$insert_xml->module_id = $top_element;
                        	$insert_xml->document_id = $document_id;
                        	if($insert_xml->insert())
                        	{
                                $xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>20,"upload_time"=>time(),"upload_token"=>1);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>病程记录数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			//这里要删除summary中的那条数据
                        			$xml_del = new Tapi_summary();
                        			$xml_del->whereAdd("document_id='$document_id'");
                        			$xml_del->delete();
                        			return $xmlhead."<return_code>2</return_code><return_string>病程记录数据交换失败</return_string>".$xmlend;
                        		} 		
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>病程记录数据交换失败</return_string>".$xmlend;
                        	}
                        }
            			break;
            			//长期医嘱
            		case 'EMR11.00.01':
            			$insert_xml = new Tapi_summary();
            			$document_id = $this->getval($xml,'EMR11.00.01.005');//文档id号
            			if(empty($document_id))
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>长期医嘱中文档号不存在</return_string>".$xmlend;
            			}
            			//机构id
            			$org_str = $this->getval($xml,'EMR11.00.01.022');
            			$org_array = explode('|',$org_str);
            			$org_id = $this->get_org($org_array[0]);
            			if(!empty($org_id))
            			{
            			    $insert_xml->org_id  = $org_id;
            			}
            			else 
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>长期医嘱中机构不存在</return_string>".$xmlend;
            			}
  		                //医生id
  		                $staff_id = $this->getval($xml,'ZLE11.00.01.005');//医生服务id号
  		                $staff_array = explode('|',$staff_id);
  		                $staff_standard_core = $staff_array[0];//组合id
  		                $staff_core_id =  $this->get_staff($org_array[0],$staff_standard_core);
  		                $insert_xml->doctor_id = empty($staff_core_id)?'':$staff_core_id;
            			$identity_type = $this->getval($xml,'EMR11.00.01.011');//类型
            			$identity_array = explode('|',$identity_type);
            			foreach ($identity_array as $k=>$v)
            			{
            				if($v=='01')
            				{
            					$identity_number = $this->getval($xml,'EMR11.00.01.012');
            					$identity_number_array = explode('|',$identity_number);
            					if(isset($identity_number_array[$k])&&!empty($identity_number_array[$k]))
            				    {
            						$insert_xml->patient_identity_card = $identity_number_array[$k];//身份证号
            				    }
            				}
            				if($v=='14')
            				{
            				    $zy_time = $this->getval($xml,'EMR11.00.01.013');
            					$zy_time_array = explode('|',$zy_time);
            					if(isset($zy_time_array[$k])&&!empty($zy_time_array[$k]))
            				    {
            					  $insert_xml->emr09_time = strtotime($zy_time_array[$k]);//入院
            				    }
            				    if(isset($zy_time_array[$k])&&!empty($zy_time_array[$k]))
            				    {
            						$insert_xml->emr12_time = strtotime($zy_time_array[$k]);//出院
            				    }
            				}
            			}
            			$patient_name = $this->getval($xml,'EMR11.00.01.018');
            			$patient_sex = $this->getval($xml,'ZLE11.00.01.014');
            			$document_time = $this->getval($xml,'EMR11.00.01.006');
            			$insert_xml->patient_name = empty($patient_name)?'':$patient_name;//姓名
            			$insert_xml->patient_sex = empty($patient_sex)?'':$patient_sex;//性别
            			$insert_xml->document_time = empty($document_time)?time():strtotime($document_time);//文档时间
                        //判断数据是否是添加还是修改
                        $api_xml = new Tapi_xml();
                        $api_xml->whereAdd("document_id='$document_id'");
                        if($api_xml->count()!=0)
                        {
                        	//编辑
                        	$insert_xml->updated = time();
                        	$insert_xml->whereAdd("document_id='$document_id'");
                        	if($insert_xml->update())
                        	{
                        		//这里需要先删除api_xml表中之前存在的那条记录
                        		$del_xml = new Tapi_xml();
                        		$del_xml->whereAdd("document_id='$document_id'");
                        		$del_xml->delete();
                        		$xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>21,"upload_time"=>time(),"upload_token"=>2);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>长期医嘱数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			return $xmlhead."<return_code>2</return_code><return_string>长期医嘱数据交换失败</return_string>".$xmlend;
                        		} 	
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>长期医嘱数据交换失败</return_string>".$xmlend;
                        	}
                        }
                        else 
                        {
                        	//添加	
                        	$insert_xml->uuid = uniqid('a_',true);
                        	$insert_xml->created = time();
                        	$insert_xml->updated = time();
                        	$insert_xml->module_id = $top_element;
                        	$insert_xml->document_id = $document_id;
                        	if($insert_xml->insert())
                        	{
                                $xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>21,"upload_time"=>time(),"upload_token"=>1);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>长期医嘱数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			//这里要删除summary中的那条数据
                        			$xml_del = new Tapi_summary();
                        			$xml_del->whereAdd("document_id='$document_id'");
                        			$xml_del->delete();
                        			return $xmlhead."<return_code>2</return_code><return_string>长期医嘱数据交换失败</return_string>".$xmlend;
                        		} 		
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>长期医嘱数据交换失败</return_string>".$xmlend;
                        	}
                        }
            			break;
            			//EMR11.00.02临时医嘱
            		case 'EMR11.00.02':
            			$insert_xml = new Tapi_summary();
            			$document_id = $this->getval($xml,'EMR11.00.02.005');//文档id号
            			if(empty($document_id))
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>临时医嘱中文档号不存在</return_string>".$xmlend;
            			}
            			//机构id
            			$org_str = $this->getval($xml,'EMR11.00.02.022');
            			$org_array = explode('|',$org_str);
            			$org_id = $this->get_org($org_array[0]);
            			if(!empty($org_id))
            			{
            			    $insert_xml->org_id  = $org_id;
            			}
            			else 
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>临时医嘱中机构不存在</return_string>".$xmlend;
            			}
  		                //医生id
  		                $staff_id = $this->getval($xml,'ZLE11.00.02.005');//医生服务id号
  		                $staff_array = explode('|',$staff_id);
  		                $staff_standard_core = $staff_array[0];//组合id
  		                $staff_core_id =  $this->get_staff($org_array[0],$staff_standard_core);
  		                $insert_xml->doctor_id = empty($staff_core_id)?'':$staff_core_id;
            			$identity_type = $this->getval($xml,'EMR11.00.02.011');//类型
            			$identity_array = explode('|',$identity_type);
            			foreach ($identity_array as $k=>$v)
            			{
            				if($v=='01')
            				{
            					$identity_number = $this->getval($xml,'EMR11.00.02.012');
            					$identity_number_array = explode('|',$identity_number);
            					if(isset($identity_number_array[$k])&&!empty($identity_number_array[$k]))
            				    {
            						$insert_xml->patient_identity_card = $identity_number_array[$k];//身份证号
            				    }
            				}
            				if($v=='14')
            				{
            				    $zy_time = $this->getval($xml,'EMR11.00.02.013');
            					$zy_time_array = explode('|',$zy_time);
            					if(isset($zy_time_array[$k])&&!empty($zy_time_array[$k]))
            				    {
            					  $insert_xml->emr09_time = strtotime($zy_time_array[$k]);//入院
            				    }
            				    if(isset($zy_time_array[$k])&&!empty($zy_time_array[$k]))
            				    {
            						$insert_xml->emr12_time = strtotime($zy_time_array[$k]);//出院
            				    }
            				}
            			}
            			$patient_name = $this->getval($xml,'EMR11.00.02.018');
            			$patient_sex = $this->getval($xml,'ZLE11.00.02.014');
            			$document_time = $this->getval($xml,'EMR11.00.02.006');
            			$insert_xml->patient_name = empty($patient_name)?'':$patient_name;//姓名
            			$insert_xml->patient_sex = empty($patient_sex)?'':$patient_sex;//性别
            			$insert_xml->document_time = empty($document_time)?time():strtotime($document_time);//文档时间
                        //判断数据是否是添加还是修改
                        $api_xml = new Tapi_xml();
                        $api_xml->whereAdd("document_id='$document_id'");
                        if($api_xml->count()!=0)
                        {
                        	//编辑
                        	$insert_xml->updated = time();
                        	$insert_xml->whereAdd("document_id='$document_id'");
                        	if($insert_xml->update())
                        	{
                        		//这里需要先删除api_xml表中之前存在的那条记录
                        		$del_xml = new Tapi_xml();
                        		$del_xml->whereAdd("document_id='$document_id'");
                        		$del_xml->delete();
                        		$xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>22,"upload_time"=>time(),"upload_token"=>2);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>临时医嘱数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			return $xmlhead."<return_code>2</return_code><return_string>临时医嘱数据交换失败</return_string>".$xmlend;
                        		} 	
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>临时医嘱数据交换失败</return_string>".$xmlend;
                        	}
                        }
                        else 
                        {
                        	//添加	
                        	$insert_xml->uuid = uniqid('a_',true);
                        	$insert_xml->created = time();
                        	$insert_xml->updated = time();
                        	$insert_xml->module_id = $top_element;
                        	$insert_xml->document_id = $document_id;
                        	if($insert_xml->insert())
                        	{
                                $xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>22,"upload_time"=>time(),"upload_token"=>1);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>临时医嘱数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			//这里要删除summary中的那条数据
                        			$xml_del = new Tapi_summary();
                        			$xml_del->whereAdd("document_id='$document_id'");
                        			$xml_del->delete();
                        			return $xmlhead."<return_code>2</return_code><return_string>临时医嘱数据交换失败</return_string>".$xmlend;
                        		} 		
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>临时医嘱数据交换失败</return_string>".$xmlend;
                        	}
                        }
            			break;
            			//EMR12.00.01出院记录
            		case 'EMR12.00.01':
            			$insert_xml = new Tapi_summary();
            			$document_id = $this->getval($xml,'EMR12.00.01.005');//文档id号
            			if(empty($document_id))
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>出院记录中文档号不存在</return_string>".$xmlend;
            			}
            			//机构id
            			$org_str = $this->getval($xml,'EMR12.00.01.042');
            			$org_array = explode('|',$org_str);
            			$org_id = $this->get_org($org_array[0]);
            			if(!empty($org_id))
            			{
            			    $insert_xml->org_id  = $org_id;
            			}
            			else 
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>出院记录中机构不存在</return_string>".$xmlend;
            			}
  		                //医生id
  		                $staff_id = $this->getval($xml,'ZLE12.00.01.003');//医生服务id号
  		                $staff_array = explode('|',$staff_id);
  		                $staff_standard_core = $staff_array[0];//组合id
  		                $staff_core_id =  $this->get_staff($org_array[0],$staff_standard_core);
  		                $insert_xml->doctor_id = empty($staff_core_id)?'':$staff_core_id;
            			$identity_type = $this->getval($xml,'EMR12.00.01.011');//类型
            			$identity_array = explode('|',$identity_type);
            			foreach ($identity_array as $k=>$v)
            			{
            				if($v=='01')
            				{
            					$identity_number = $this->getval($xml,'EMR12.00.01.012');
            					$identity_number_array = explode('|',$identity_number);
            					if(isset($identity_number_array[$k])&&!empty($identity_number_array[$k]))
            				    {
            						$insert_xml->patient_identity_card = $identity_number_array[$k];//身份证号
            				    }
            				}
            				if($v=='14')
            				{
            				    $zy_time = $this->getval($xml,'EMR12.00.01.013');
            					$zy_time_array = explode('|',$zy_time);
            					if(isset($zy_time_array[$k])&&!empty($zy_time_array[$k]))
            				    {
            					  $insert_xml->emr09_time = strtotime($zy_time_array[$k]);//入院
            				    }
            				    if(isset($zy_time_array[$k])&&!empty($zy_time_array[$k]))
            				    {
            						$insert_xml->emr12_time = strtotime($zy_time_array[$k]);//出院
            				    }
            				}
            			}
            			
            			$patient_name = $this->getval($xml,'EMR12.00.01.018');
            			$patient_sex = $this->getval($xml,'EMR12.00.01.021');
            			$document_time = $this->getval($xml,'EMR12.00.01.006');
            			$insert_xml->patient_name = empty($patient_name)?'':$patient_name;//姓名
            			$insert_xml->patient_sex = empty($patient_sex)?'':$patient_sex;//性别
            			$insert_xml->document_time = empty($document_time)?time():strtotime($document_time);//文档时间
                        //判断数据是否是添加还是修改
                        $api_xml = new Tapi_xml();
                        $api_xml->whereAdd("document_id='$document_id'");
                        if($api_xml->count()!=0)
                        {
                        	//编辑
                        	$insert_xml->updated = time();
                        	$insert_xml->whereAdd("document_id='$document_id'");
                        	if($insert_xml->update())
                        	{
                        		//这里需要先删除api_xml表中之前存在的那条记录
                        		$del_xml = new Tapi_xml();
                        		$del_xml->whereAdd("document_id='$document_id'");
                        		$del_xml->delete();
                        		$xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>23,"upload_time"=>time(),"upload_token"=>2);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>出院记录数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			return $xmlhead."<return_code>2</return_code><return_string>出院记录数据交换失败</return_string>".$xmlend;
                        		} 	
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>出院记录数据交换失败</return_string>".$xmlend;
                        	}
                        }
                        else 
                        {
                        	//添加	
                        	$insert_xml->uuid = uniqid('a_',true);
                        	$insert_xml->created = time();
                        	$insert_xml->updated = time();
                        	$insert_xml->module_id = $top_element;
                        	$insert_xml->document_id = $document_id;
                        	if($insert_xml->insert())
                        	{
                                $xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>23,"upload_time"=>time(),"upload_token"=>1);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>出院记录数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			//这里要删除summary中的那条数据
                        			$xml_del = new Tapi_summary();
                        			$xml_del->whereAdd("document_id='$document_id'");
                        			$xml_del->delete();
                        			return $xmlhead."<return_code>2</return_code><return_string>出院记录数据交换失败</return_string>".$xmlend;
                        		} 		
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>出院记录数据交换失败</return_string>".$xmlend;
                        	}
                        }
            			break;
            			//EMR12.00.01转诊记录
            		case 'EMR13.00.01':
            			$insert_xml = new Tapi_summary();
            			$document_id = $this->getval($xml,'EMR13.00.01.005');//文档id号
            			if(empty($document_id))
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>转诊记录中文档号不存在</return_string>".$xmlend;
            			}
            			//机构id
            			$age = $this->getval($xml,'EMR13.00.01.022');//病人年龄
            			$referral_out_time = $this->getval($xml,'EMR13.00.01.103');//转诊时间
            			$org_str = $this->getval($xml,'EMR13.00.01.082');//机构
            			$org_type = $this->getval($xml,'EMR13.00.01.087');//机构类型  01为转入机构  02为转出机构
            			$stub_doccol = $this->getval($xml,'EMR13.00.01.085');//转入科室   
            			$firefight = $this->getval($xml,'EMR13.00.01.127');//初步诊断  
            			$firefight_type = $this->getval($xml,'EMR13.00.01.125');//诊断类别  为3就是初步诊断
            			$my_org_name = $this->getval($xml,'EMR13.00.01.125');//自己的机构名
            			$zr_org_name = $this->getval($xml,'EMR13.00.01.081');//转入机构名称
            			//医生id
  		                $staff_id = $this->getval($xml,'ZLE13.00.01.003');//医生服务id号
  		                $staff_array = explode('|',$staff_id);
            			$org_array = explode('|',$org_str);
            			$org_type_array = explode('|',$org_type);
            			$firefight_type_array = explode('|',$firefight_type);
            			$firefight_array = explode('|',$firefight);
            			$stub_doccol_array = explode('|',$stub_doccol);
            			$zr_org_name_array = explode('|',$zr_org_name);
            			//处理初步诊断 
            			foreach($firefight_type_array as $k=>$v)
            			{
            				if($v=='3')
            				{
            					$cbzd = $firefight_array[$k];
            				}
            			}
            			//处理转出或者转入
            			foreach ($org_array as $k=>$v)
            			{
            				if($org_type_array[$k]=='02')//取转出机构
            				{
            					$org_standard_code = $org_array[$k];
		            			$org_id = $this->get_org($org_array[$k]);
		            			if(!empty($org_id))
		            			{
		            			    $insert_xml->org_id  = $org_id;
		            			    $staff_standard_core = $staff_array[0];//组合id为平台中医生主表standard_code
		            			}
		            			else 
		            			{
		            				return  $xmlhead."<return_code>2</return_code><return_string>转诊记录中机构不存在</return_string>".$xmlend;
		            			}
            				}
            				if($org_type_array[$k]=='01')//取转入机构
            				{
            					$stub_unit_real_id = $this->get_org($org_array[$k]);
		            			if(!empty($stub_unit_real_id))
		            			{
            						$stub_unit_real = $stub_unit_real_id;
		            			}
            					$stub_doccol_real = $stub_doccol_array[$k];//转入科室
            					$zr_org_name_real = $zr_org_name_array[$k];//转入机构名
            				}
            			}	 
  		                $staff_core_id =  $this->get_staff($org_standard_code,$staff_standard_core);
//                                echo  $staff_core_id;
//                                exit();
  		                if(empty($staff_core_id))
  		                {
  		                	return $xmlhead."<return_code>2</return_code><return_string>转诊医生不存在</return_string>".$xmlend;
  		                }
  		                else 
  		                {
  		               		 $insert_xml->doctor_id = $staff_core_id;
  		                }
            			$identity_type = $this->getval($xml,'EMR13.00.01.011');//类型
            			$identity_array = explode('|',$identity_type);
            			foreach ($identity_array as $k=>$v)
            			{
            				if($v=='01')
            				{
            					
            					$identity_number = $this->getval($xml,'EMR13.00.01.012');
            					$identity_number_array = explode('|',$identity_number);
            				    if(isset($identity_number_array[$k])&&!empty($identity_number_array[$k]))
            				    {
            						$insert_xml->patient_identity_card = $identity_number_array[$k];//身份证号
            						$person_identity_number = $identity_number_array[$k];
            				    }
            				}
            				if($v=='14')
            				{
            				    $zy_time = $this->getval($xml,'EMR13.00.01.013');
            					$zy_time_array = explode('|',$zy_time);
            					if(isset($zy_time_array[$k])&&!empty($zy_time_array[$k]))
            				    {
            					  $insert_xml->emr09_time = strtotime($zy_time_array[$k]);//入院
            				    }
            				    if(isset($zy_time_array[$k])&&!empty($zy_time_array[$k]))
            				    {
            						$insert_xml->emr12_time = strtotime($zy_time_array[$k]);//出院
            				    }
            				}
            			}
            			$patient_name = $this->getval($xml,'EMR13.00.01.018');
            			$patient_sex = $this->getval($xml,'EMR13.00.01.021');
            			$document_time = $this->getval($xml,'EMR13.00.01.006');
            			$insert_xml->patient_name = empty($patient_name)?'':$patient_name;//姓名
            			$insert_xml->patient_sex = empty($patient_sex)?'':$patient_sex;//性别
            			$insert_xml->document_time = empty($document_time)?time():strtotime($document_time);//文档时间
                        //判断数据是否是添加还是修改
                        $api_xml = new Tapi_xml();
                        $api_xml->whereAdd("document_id='$document_id'");
                        if($api_xml->count()!=0)
                        {
                        	//编辑
                        	$insert_xml->updated = time();
                        	$insert_xml->whereAdd("document_id='$document_id'");
                        	if($insert_xml->update())
                        	{
                        		
                        		$pt_identity_number = $identity_number_array[$k];
                    		    //转换身份证为平台个人id
        						$individual_core = new Tindividual_core();
        						$individual_core->whereAdd("identity_number='$pt_identity_number'");
        						if($individual_core->count()>0)
        						{
        							$individual_core->find(true);
            						//向万双向转诊表中写入数据    
	                        		$patient_referral_out_info = new Tpatient_referral_out();
	                                $patient_referral_out_info->whereAdd("document_id='$document_id'");
	                        		$patient_referral_out_info->staff_id = $staff_core_id;//通过平台反转出来的医生id
	                        		$patient_referral_out_info->created = empty($document_time)?time():strtotime($document_time);	//创建时间 为文档创建时间
	                        		$patient_referral_out_info->id = $individual_core->uuid;//平台个人id号	
	                        		$patient_referral_out_info->age = $age;//病人年龄	
	                        		$patient_referral_out_info->referral_out_time = empty($referral_out_time)?time():strtotime($referral_out_time);//转诊时间
	                        		$patient_referral_out_info->stub_unit = $stub_unit_real;//转入单位
	                        		$patient_referral_out_info->stub_doccol = $stub_doccol_real;//转入科室
	                        		$patient_referral_out_info->stub_of_doctor = empty($staff_core_id)?'':$staff_core_id;//存根转诊医生
	                        		$patient_referral_out_info->stub_fill_time = empty($referral_out_time)?time():strtotime($referral_out_time);//存根转诊时间
	                        		$patient_referral_out_info->dst_org_name = $stub_unit_real;//转到机构名
	                        		$patient_referral_out_info->firefight = $cbzd;//初步诊断
	                        		$patient_referral_out_info->out_of_doctor = empty($staff_core_id)?'':$staff_core_id;//转诊医生
	                        		$patient_referral_out_info->my_org_name = $org_id;//自己的机构名
	                        		$patient_referral_out_info->fill_time = empty($document_time)?time():strtotime($document_time);	//转出填表时间
	                        		if($patient_referral_out_info->update())
	                        		{
	                        			
	                        		}
	                        		else 
	                        		{
	                        			//这里要删除summary中的那条数据
		                    			$xml_del = new Tapi_summary();
		                    			$xml_del->whereAdd("document_id='$document_id'");
		                    			$xml_del->delete();
	                        			return $xmlhead."<return_code>2</return_code><return_string>转诊记录数据交换失败</return_string>".$xmlend;
	                        		}
        						}
        						else 
        						{
        							return $xmlhead."<return_code>2</return_code><return_string>转诊记录中个人档案不存在</return_string>".$xmlend;
        						} 
                        		//这里需要先删除api_xml表中之前存在的那条记录
                        		$del_xml = new Tapi_xml();
                        		$del_xml->whereAdd("document_id='$document_id'");
                        		$del_xml->delete();
                        		$xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>24,"upload_time"=>time(),"upload_token"=>2);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>转诊记录数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			return $xmlhead."<return_code>2</return_code><return_string>转诊记录数据交换失败</return_string>".$xmlend;
                        		} 	
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>转诊记录数据交换失败</return_string>".$xmlend;
                        	}
                        }
                        else 
                        {
                        	//添加	
                        	$insert_xml->uuid = uniqid('a_',true);
                        	$insert_xml->created = time();
                        	$insert_xml->updated = time();
                        	$insert_xml->module_id = $top_element;
                        	$insert_xml->document_id = $document_id;
                        	if($insert_xml->insert())
                        	{   
                        		$pt_identity_number = $identity_number_array[$k];
                    		    //转换身份证为平台个人id
        						$individual_core = new Tindividual_core();
        						$individual_core->whereAdd("identity_number='$pt_identity_number'");
        						if($individual_core->count()>0)
        						{
        							$individual_core->find(true);
            						//向万双向转诊表中写入数据    
	                        		$patient_referral_out_info = new Tpatient_referral_out();
	                        		$patient_referral_out_info->uuid = uniqid('o_',true);
	                        		$patient_referral_out_info->document_id = $document_id;
	                        		$patient_referral_out_info->staff_id = $staff_core_id;//通过平台反转出来的医生id
	                        		$patient_referral_out_info->created = empty($document_time)?time():strtotime($document_time);	//创建时间 为文档创建时间
	                        		$patient_referral_out_info->id = $individual_core->uuid;//平台个人id号	
	                        		$patient_referral_out_info->age = $age;//病人年龄	
	                        		$patient_referral_out_info->referral_out_time = empty($referral_out_time)?time():strtotime($referral_out_time);//转诊时间
	                        		$patient_referral_out_info->stub_unit = $stub_unit_real;//转入单位
	                        		$patient_referral_out_info->stub_doccol = $stub_doccol_real;//转入科室
	                        		$patient_referral_out_info->stub_of_doctor = empty($staff_core_id)?'':$staff_core_id;//存根转诊医生
	                        		$patient_referral_out_info->stub_fill_time = empty($referral_out_time)?time():strtotime($referral_out_time);//存根转诊时间
	                        		$patient_referral_out_info->dst_org_name = $stub_unit_real;//转到机构名
	                        		$patient_referral_out_info->firefight = $cbzd;//初步诊断
	                        		$patient_referral_out_info->out_of_doctor = empty($staff_core_id)?'':$staff_core_id;//转诊医生
	                        		$patient_referral_out_info->my_org_name = $org_id;//自己的机构名
	                        		$patient_referral_out_info->fill_time = empty($document_time)?time():strtotime($document_time);	//转出填表时间
	                        		if($patient_referral_out_info->insert())
	                        		{
	                        			
	                        		}
	                        		else 
	                        		{
	                        			//这里要删除summary中的那条数据
		                    			$xml_del = new Tapi_summary();
		                    			$xml_del->whereAdd("document_id='$document_id'");
		                    			$xml_del->delete();
	                        			return $xmlhead."<return_code>2</return_code><return_string>转诊记录数据交换失败</return_string>".$xmlend;
	                        		}
        						}
        						else 
        						{
        							return $xmlhead."<return_code>2</return_code><return_string>转诊记录中个人档案不存在</return_string>".$xmlend;
        						} 		
                                $xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{	
                        			//取医生的电话号码
                        			$staff_archive =  new Tstaff_archive();
                        			$staff_archive->whereAdd("user_id='$staff_core_id'");
                        			$staff_archive->find(true);
                        			$phone_number = $staff_archive->telephone_number;
                                               		$sms=new SMS();
                        			$uuid = uniqid('zc_',true);
                                    $sms_date= date("Y-m-d H:i:s",time());
                                    $sms_content ='病人'.$individual_core->name.'，因病情需要于'.$sms_date.'将转入'.$zr_org_name_real.'就诊';
                                    $sms_status=$sms->sendSMS($uuid,$phone_number,$sms_content,$sms_date);//发送短信
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>24,"upload_time"=>time(),"upload_token"=>1);
                        			return $xmlhead."<return_code>1</return_code><return_string>转诊记录数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			//这里要删除summary中的那条数据
                        			$xml_del = new Tapi_summary();
                        			$xml_del->whereAdd("document_id='$document_id'");
                        			$xml_del->delete();
                        			return $xmlhead."<return_code>2</return_code><return_string>转诊记录数据交换失败</return_string>".$xmlend;
                        		} 		
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>转诊记录数据交换失败</return_string>".$xmlend;
                        	}
                        }
            			break;
            			//HRA00.01.01个人基本信息
            		case 'HRA00.01.01':
            			$insert_xml = new Tapi_summary();
            			//机构id   和中联沈强交流使用这个节点作为机构编码节点   而且这个再页面内是唯一的
            			//他说：“这个个人基本信息应该是独立于其他电子病历的 这个是最近一次的就医机构”
            			$org_str = $this->getval($xml,'ZLE00.001.012');
            			$document_id = $this->getval($xml,'HRA00.01.101');//文档id号  个人信息中没有文档号 万：开始说用身份证号作为文档号最后改为  HRA00.01.101  健康档案标识符
            			if(empty($document_id))
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>人基本信息中文档号不存在</return_string>".$xmlend;
            			}
            			$org_id = $this->get_org($org_str);
            			if(!empty($org_id))
            			{
            			    $insert_xml->org_id  = $org_id;
            			}
            			else 
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>人基本信息中机构不存在</return_string>".$xmlend;
            			}
            			$identity_type = $this->getval($xml,'HRA00.01.203');//类型
            			$identity_array = explode('|',$identity_type);
            			foreach ($identity_array as $k=>$v)
            			{
            				if($v=='01')
            				{
            					
            					$identity_number = $this->getval($xml,'HRA00.01.204');
            					$identity_number_array = explode('|',$identity_number);
            				    if(isset($identity_number_array[$k])&&!empty($identity_number_array[$k]))
            				    {
            						$insert_xml->patient_identity_card = $identity_number_array[$k];//身份证号	
            				    }
            				}
            				if($v=='14')
            				{
            				    $zy_time = $this->getval($xml,'HRA00.01.205');
            					$zy_time_array = explode('|',$zy_time);
            					if(isset($zy_time_array[$k])&&!empty($zy_time_array[$k]))
            				    {
            					  $insert_xml->emr09_time = strtotime($zy_time_array[$k]);//入院
            				    }
            				    if(isset($zy_time_array[$k])&&!empty($zy_time_array[$k]))
            				    {
            						$insert_xml->emr12_time = strtotime($zy_time_array[$k]);//出院
            				    }
            				}
            			}
            			$patient_name = $this->getval($xml,'ZLE00.001.001');
            			$patient_sex = $this->getval($xml,'HRA00.01.302');
            			$document_time = $this->getval($xml,'HRA00.01.103');
            			$insert_xml->patient_name = empty($patient_name)?'':$patient_name;//姓名
            			$insert_xml->patient_sex = empty($patient_sex)?'':$patient_sex;//性别
            			$insert_xml->document_time = empty($document_time)?time():strtotime($document_time);//文档时间
                        //判断数据是否是添加还是修改
                        $api_xml = new Tapi_xml();
                        $api_xml->whereAdd("document_id='$document_id'");
                        if($api_xml->count()!=0)
                        {
                        	//编辑
                        	$insert_xml->updated = time();
                        	$insert_xml->whereAdd("document_id='$document_id'");
                        	if($insert_xml->update())
                        	{
                        		//这里需要先删除api_xml表中之前存在的那条记录
                        		$del_xml = new Tapi_xml();
                        		$del_xml->whereAdd("document_id='$document_id'");           
                        		$del_xml->delete();
                        		$xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>11,"upload_time"=>time(),"upload_token"=>2);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>个人基本信息数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			return $xmlhead."<return_code>2</return_code><return_string>个人基本信息数据交换失败</return_string>".$xmlend;
                        		} 	
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>个人基本信息数据交换失败</return_string>".$xmlend;
                        	}
                        }
                        else 
                        {
                        	//添加	
                        	$insert_xml->uuid = uniqid('a_',true);
                        	$insert_xml->created = time();
                        	$insert_xml->updated = time();
                        	$insert_xml->module_id = $top_element;
                        	$insert_xml->document_id = $document_id;
                        	if($insert_xml->insert())
                        	{
                                $xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>11,"upload_time"=>time(),"upload_token"=>1);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>个人基本信息数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			//这里要删除summary中的那条数据
                        			$xml_del = new Tapi_summary();
                        			$xml_del->whereAdd("document_id='$document_id'");
                        			$xml_del->delete();
                        			return $xmlhead."<return_code>2</return_code><return_string>个人基本信息数据交换失败</return_string>".$xmlend;
                        		} 		
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>个人基本信息数据交换失败</return_string>".$xmlend;
                        	}
                        }
            			break;
            			//病案首页 涉及到 疾病和费用
            		case "EMR08.00.01":
            			$insert_xml = new Tapi_summary();
            			//机构id
            			$org_str = $this->getval($xml,'EMR08.01.01.102');
            			$document_id = $this->getval($xml,'EMR08.01.01.005');//文档id号  个人信息中没有文档号 万：开始说用身份证号作为文档号最后改为  HRA00.01.101  健康档案标识符
            			if(empty($document_id))
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>病案首页中文档号不存在</return_string>".$xmlend;
            			}
            			$org_array = explode('|',$org_str);
            			$org_id = $this->get_org($org_array[0]);
            			if(!empty($org_id))
            			{
            			    $insert_xml->org_id  = $org_id;
            			}
            			else 
            			{
            				return  $xmlhead."<return_code>2</return_code><return_string>病案首页中机构不存在</return_string>".$xmlend;
            			}
            			$identity_type = $this->getval($xml,'EMR08.01.01.015');//类型
            			$fee_type = $this->getval($xml,'EMR08.01.01.248');//费用类型
            			$identity_array = explode('|',$identity_type);
            			foreach ($identity_array as $k=>$v)
            			{
            				if($v=='01')
            				{
            					
            					$identity_number = $this->getval($xml,'EMR08.01.01.016');
            					$identity_number_array = explode('|',$identity_number);
            				    if(isset($identity_number_array[$k])&&!empty($identity_number_array[$k]))
            				    {
            						$insert_xml->patient_identity_card = $identity_number_array[$k];//身份证号	
            				    }
            				}
            				if($v=='14')
            				{
            				    $zy_time = $this->getval($xml,'EMR08.01.01.017');
            					$zy_time_array = explode('|',$zy_time);
            					if(isset($zy_time_array[$k])&&!empty($zy_time_array[$k]))
            				    {
            					  $insert_xml->emr09_time = strtotime($zy_time_array[$k]);//入院
            				    }
            				    if(isset($zy_time_array[$k])&&!empty($zy_time_array[$k]))
            				    {
            						$insert_xml->emr12_time = strtotime($zy_time_array[$k]);//出院
            				    }
            				}
            			}
            			$patient_name = $this->getval($xml,'EMR08.01.01.013');//姓名
            			$patient_sex = $this->getval($xml,'EMR08.01.01.033');//性别
            			$document_time = $this->getval($xml,'EMR08.01.01.006');//文档时间
            			$emr08_01_01_249 = $this->getval($xml,'EMR08.01.01.249');//个人承担费用
            			$fee = $this->getval($xml,'EMR08.01.01.246');//各项费用类别
            			$fee_array = explode('|',$fee);
            			$fee_code_array = array('05'=>'inspection_fees','01'=>'western_medicine','07'=>'treatment_costs','11'=>'bed_fee','12'=>'nursing_fees','06'=>'special_fee','99'=>'other_fee','03'=>'chinese_medicine');
            			$zd_type_code = array('11','12','13');
            			$sum_fee = 0;//费用总和
            			foreach ($fee_array as $k=>$v)
            			{
            				$fee_value = $this->getval($xml,'EMR08.01.01.247');//各项费用
            				$fee_value_array = explode('|',$fee_value);
            			   if($v=='05')
            			   {
            			   	 $insert_xml->inspection_fees = empty($fee_value_array[$k])?0:$fee_value_array[$k];
            			   	 $sum_fee+=$insert_xml->inspection_fees;
            			   }
            			   if($v=='01')
            			   {
            			   	 $insert_xml->western_medicine = empty($fee_value_array[$k])?0:$fee_value_array[$k];
            			   	 $sum_fee+=$insert_xml->western_medicine;
            			   }
            			   if($v=='07')
            			   {
            			   	 $insert_xml->treatment_costs = empty($fee_value_array[$k])?0:$fee_value_array[$k];
            			   	 $sum_fee+=$insert_xml->treatment_costs;
            			   }
            			   if($v=='11')
            			   {
            			   	 $insert_xml->bed_fee = empty($fee_value_array[$k])?0:$fee_value_array[$k];
            			   	 $sum_fee+=$insert_xml->bed_fee;
            			   }
            			    if($v=='12')
            			   {
            			   	 $insert_xml->nursing_fees = empty($fee_value_array[$k])?0:$fee_value_array[$k];
            			   	 $sum_fee+=$insert_xml->nursing_fees;
            			   }
            			   if($v=='06')
            			   {
            			   	 $insert_xml->special_fee = empty($fee_value_array[$k])?0:$fee_value_array[$k];
            			   	 $sum_fee+=$insert_xml->special_fee;
            			   }
            			   if($v=='99')
            			   {
            			   	 $insert_xml->other_fee = empty($fee_value_array[$k])?0:$fee_value_array[$k];
            			   	 $sum_fee+=$insert_xml->other_fee;
            			   }
            			   if($v=='03')
            			   {
            			   	 $insert_xml->chinese_medicine = empty($fee_value_array[$k])?0:$fee_value_array[$k];
            			   	 $sum_fee+=$insert_xml->chinese_medicine;
            			   }
            			}
            			$insert_xml->patient_name = empty($patient_name)?'':$patient_name;//姓名
            			$insert_xml->patient_sex = empty($patient_sex)?'':$patient_sex;//性别
            			$insert_xml->document_time = empty($document_time)?time():strtotime($document_time);//文档时间
            			$insert_xml->sum_fee = $sum_fee;//总费用写入
            			$insert_xml->emr08_01_01_249 = empty($emr08_01_01_249)?0:$emr08_01_01_249;//个人承担费用
            			$owner_fee = $insert_xml->emr08_01_01_249;
            			//医疗方式代码
            			$medicine_type = array('01','02','03','04','05','06','08');
            			foreach ($medicine_type as $k=>$v)
            			{
            				if($fee_type==$v)
            				{
            					$insert_xml->medical_code = $v;//费用代码
            					$insert_xml->difference_fee = $sum_fee-$owner_fee;//自费
            				}
            			}
                        //判断数据是否是添加还是修改
                        $api_xml = new Tapi_xml();
                        $api_xml->whereAdd("document_id='$document_id'");
                        if($api_xml->count()!=0)
                        {
                        	//编辑
                        	$insert_xml->updated = time();
                        	$insert_xml->whereAdd("document_id='$document_id'");
                        	if($insert_xml->update())
                        	{
                        		//这里需要先删除api_xml表中之前存在的那条记录
                        		$del_xml = new Tapi_xml();
                        		$del_xml->whereAdd("document_id='$document_id'");
                        		$del_xml->delete();    	
                        		$xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			//删除disease表中的记录
                        			$del_disease = new Tapi_disease();
                        			$del_disease->whereAdd("document_id='$document_id'");
                        			$del_disease->delete();
                        			//重新添加	
                        			$zd_time = $this->getval($xml,'EMR08.01.01.149');//诊断日期
                        			$zd_org_code = $this->getval($xml,'ZLE08.00.01.007');//诊断机构代码
                        			$disease_name = $this->getval($xml,'EMR08.01.01.154');//疾病名
                        			$disease_code = $this->getval($xml,'EMR08.01.01.155');//疾病代码
                        			$zd_type = $this->getval($xml,'EMR08.01.01.152');//诊断类别代码
                        		
                        			if(!empty($zd_time))
                        			{
                        				$zd_time_array = explode('|',$zd_time);
	                    				$zd_org_code_array = explode('|',$zd_org_code);
	                    				$disease_name_array = explode('|',$disease_name);
	                    				$disease_code_array = explode('|',$disease_code);
	                    				$zd_type_array = explode('|',$zd_type);
	                    				foreach ($zd_time_array as $k=>$v)
	                    				{				
	                    					if(!empty($zd_time_array[$k])||!empty($zd_org_code_array[$k])||!empty($disease_name_array[$k])||!empty($disease_code_array[$k])||!empty($zd_type_array[$k]))
	                    					{
	                    						if(in_array($zd_type_array[$k],$zd_type_code))
	                    						{
		                    						$api_disease = new Tapi_disease();//对疾病名称进行添加
		                    					    $disease_uuid = uniqid('d_',true);
		                    					    $api_disease->uuid = $disease_uuid;
		                    					    $api_disease->document_id = $document_id;    
		                    					    $org_id = $this->get_org($zd_org_code_array[$k]);
		                    					    if(empty($org_id))
		                    					    {
		                    					    	continue;//org_id出现空时不要
		                    					    }
		                    					    else 
		                    					    {
		                    					    	$api_disease->diagnosis_org_id = $org_id;
		                    					    }
		                    					    $api_disease->dignosis_date = strtotime($zd_time_array[$k]);
		                    					    $api_disease->disease_name = $disease_name_array[$k];
		                    					    $api_disease->disease_code = $disease_code_array[$k];
		                    					    $api_disease->insert();
	                    						}
	                    					}
	                    					else 
	                    					{
	                    						continue;
	                    					}                    					                        				
	                    				}
                        			}//添加疾病结束
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>18,"upload_time"=>time(),"upload_token"=>2);
									$this->insert_api_logs($logs_array);
                        			return $xmlhead."<return_code>1</return_code><return_string>病案首页数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			return $xmlhead."<return_code>2</return_code><return_string>病案首页数据交换失败</return_string>".$xmlend;
                        		} 	
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>病案首页数据交换失败</return_string>".$xmlend;
                        	}
                        }
                        else 
                        {
                        	//添加	
                        	$insert_xml->uuid = uniqid('a_',true);
                        	$insert_xml->created = time();
                        	$insert_xml->updated = time();
                        	$insert_xml->module_id = $top_element;
                        	$insert_xml->document_id = $document_id;
                        	if($insert_xml->insert())
                        	{
                                $xml_string = iconv('utf-8','gbk',$xml_string);
                        		if($this->insert_xml($document_id,$xml_string))
                        		{
                        			//添加		
                        			$zd_time = $this->getval($xml,'EMR08.01.01.149');//诊断日期
                        			$zd_org_code = $this->getval($xml,'ZLE08.00.01.007');//诊断机构代码
                        			$disease_name = $this->getval($xml,'EMR08.01.01.154');//疾病名
                        			$disease_code = $this->getval($xml,'EMR08.01.01.155');//疾病代码
                        			$zd_type = $this->getval($xml,'EMR08.01.01.152');//诊断类别代码
                        			if(!empty($zd_time))
                        			{
                        				$zd_time_array = explode('|',$zd_time);
	                    				$zd_org_code_array = explode('|',$zd_org_code);
	                    				$disease_name_array = explode('|',$disease_name);
	                    				$disease_code_array = explode('|',$disease_code);
	                    				$zd_type_array = explode('|',$zd_type);
	                    				foreach ($zd_time_array as $k=>$v)
	                    				{				
	                    					if(!empty($zd_time_array[$k])||!empty($zd_org_code_array[$k])||!empty($disease_name_array[$k])||!empty($disease_code_array[$k])||!empty($zd_type_array[$k]))
	                    					{
	                    						if(in_array($zd_type_array[$k],$zd_type_code))
	                    						{
		                    						$api_disease = new Tapi_disease();//对疾病名称进行添加
		                    					    $disease_uuid = uniqid('d_',true);
		                    					    $api_disease->uuid = $disease_uuid;
		                    					    $api_disease->document_id = $document_id;    
		                    					    $org_id = $this->get_org($zd_org_code_array[$k]);
		                    					    if(empty($org_id))
		                    					    {
		                    					    	continue;//org_id出现空时不要
		                    					    }
		                    					    else 
		                    					    {
		                    					    	$api_disease->diagnosis_org_id = $org_id;
		                    					    }
		                    					    $api_disease->dignosis_date = strtotime($zd_time_array[$k]);
		                    					    $api_disease->disease_name = $disease_name_array[$k];
		                    					    $api_disease->disease_code = $disease_code_array[$k];
		                    					    $api_disease->insert();
	                    						}
	                    					}
	                    					else 
	                    					{
	                    						continue;
	                    					}                    					                        				
	                    				}
                        			}
                        			$logs_array=array("ext_uuid"=>$document_id,"org_id"=>$org_id,"model_id"=>18,"upload_time"=>time(),"upload_token"=>1);
									$this->insert_api_logs($logs_array);
									//echo $org_id;
                        			return $xmlhead."<return_code>1</return_code><return_string>病案首页数据交换成功</return_string>".$xmlend;
                        		}
                        		else 
                        		{
                        			//这里要删除summary中的那条数据
                        			$xml_del = new Tapi_summary();
                        			$xml_del->whereAdd("document_id='$document_id'");
                        			$xml_del->delete();
                        			return $xmlhead."<return_code>2</return_code><return_string>病案首页数据交换失败</return_string>".$xmlend;
                        		} 		
                        	}
                        	else 
                        	{
                        		 return $xmlhead."<return_code>2</return_code><return_string>病案首页数据交换失败</return_string>".$xmlend;
                        	}
                        }
            			break;
            	}
            }
		}
	}
	/**
	 *   通过身份证和姓名查询这个人的一个his的列表
	 */
	function ws_select_single($taken,$identity_number,$name=null)
	{
		require_once __SITEROOT."library/Models/api_summary.php";	
		require_once __SITEROOT."library/Models/organization.php";
		$xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
		$xmlend  = "</message>";
		$success_str = '';
		if(empty($identity_number))
		{
			return $xmlhead."<return_code>2</return_code><return_string>身份证为空,请检查</return_string>".$xmlend;
		}
		else 
		{
			//定义模块数组
			$moudel_array = array('EMR02.00.01'=>'门急诊病历','EMR03.00.01'=>'西医处方','EMR03.00.02'=>'中医处方','EMR04.00.01'=>'检查记录','EMR04.00.02'=>'检验记录','EMR06.01.04'=>'生命体征测量记录','EMR08.00.01'=>'病案首页','EMR09.00.01'=>'入院记录','EMR10.00.99'=>'病程记录','EMR11.00.01'=>'长期医嘱','EMR11.00.02'=>'临时医嘱','EMR12.00.01'=>'出院记录','EMR13.00.01'=>'转诊记录','HRA00.01.01'=>'个人基本信息');
			$api_summary = new Tapi_summary();
			$api_summary->whereAdd("patient_identity_card='$identity_number'");
			if(!empty($name))
			{
				$api_summary->whereAdd("patient_name='$name'");
			}
			if($api_summary->count()>0)
			{
				$api_summary->find();
				while ($api_summary->fetch())
				{
					$org_id = $this->get_org_standard_code($api_summary->org_id);
					$real_org_id = empty($org_id)?'未知机构':$org_id;
					$success_str.='<row>';
					$success_str.='<数据集code>'.$api_summary->module_id.'</数据集code>';
					$success_str.='<数据集名称>'.$moudel_array[$api_summary->module_id].'</数据集名称>';
					$success_str.='<生成时间>'.date("Y-m-d",$api_summary->document_time).'</生成时间>';
					$success_str.='<就诊机构名称>'.$real_org_id.'</就诊机构名称>';
					$success_str.='<文档ID>'.$api_summary->document_id.'</文档ID>';
					$success_str.='</row>';
				}
				return $xmlhead.$success_str.$xmlend;
			}
			else 
			{
				return $xmlhead."<return_code>2</return_code><return_string>没有查询到任何内容</return_string>".$xmlend;
			}
		}
	}
	/**
	 * 
	 */
	function ws_get_xml($token,$document_id)
	{
		require_once __SITEROOT."library/Models/api_xml.php";
		$xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
		$xmlend  = "</message>";
		if(empty($document_id))
		{
			return $xmlhead."<return_code>2</return_code><return_string>文档号为空，请检查</return_string>".$xmlend;
		}
		else 
		{
			require __SITEROOT."config/oracleConfig.php";
    	    $conn = oci_connect($databaseConfig[1]['user'],$databaseConfig[1]['password'],$databaseConfig[1]['host']);
    	    $api_xml = new Tapi_xml();
    	    $api_xml->whereAdd("document_id='$document_id'");
    	    if($api_xml->count()>0)
    	    {
	    	    $query = "select xml_content from api_xml where document_id='$document_id'";
	            $stmt = oci_parse($conn,$query);
	            oci_execute($stmt);
	            while($result=oci_fetch_array($stmt,OCI_RETURN_LOBS))
	            {
	                 //$file_date = iconv('gbk','utf-8//IGNORE',$result[0]);
	                 $file_date = iconv('gbk','utf-8//IGNORE',base64_decode($result[0]));
	                 //var_dump($file_date);
	            }
	            oci_free_statement($stmt);
	            oci_close($conn);
	            return $file_date;  
    	    }
    	    else 
    	    {
    	    	return $xmlhead."<return_code>2</return_code><return_string>没有相关数据</return_string>".$xmlend;
    	    }
		}
	}
	/**
	 * 返回任意节点的val值
	 *
	 * @param unknown_type $xml
	 * @param unknown_type $node
	 * @return unknown
	 */
    function getval($xml,$node)
    {
    	$val='';
    	$node_array = $xml->xpath('//'.$node);
        foreach ($node_array as $k=>$v)
        {
        	$val.=$v.'|';
        }
//        echo $val;
//        exit();
        return rtrim($val,'|');
    }
    /**
     * 插入xml数据
     * clob类型字段
     *
     */
    function insert_xml($document_id,$xml_content)
    {
    	require __SITEROOT."config/oracleConfig.php";
    	$conn = oci_connect($databaseConfig[1]['user'],$databaseConfig[1]['password'],$databaseConfig[1]['host']);
    	$uuid = uniqid('x_',true);	
        $sql = "INSERT INTO api_xml 
          (uuid,document_id,xml_content) 
        VALUES 
          ('$uuid','$document_id',EMPTY_CLOB()) 
       RETURNING 
          xml_content INTO :xml_content"; 
        $stmt = oci_parse($conn, $sql); 
        $myLOB = oci_new_descriptor($conn, OCI_D_LOB); 
        //oci_bind_by_name($stmt, ":xml_content", $myLOB, -1, OCI_B_CLOB); 这句和下边那句是一个效果
        oci_bind_by_name($stmt, ":xml_content", $myLOB, -1, SQLT_CLOB); 
        if(oci_execute($stmt, OCI_DEFAULT))
        {
        	$xml_content = base64_encode($xml_content);
	        $myLOB->save($xml_content); 
			oci_commit($conn); 
			oci_free_statement($stmt); 
		    $myLOB->free(); 
		    return true;
        }
        else 
        {
        	return false;
        }	
    }
    /**
     * 返回平台机构id
     */
    function get_org($standard_code)
    {
    	$organization = new Torganization();
    	$organization->whereAdd("standard_code='$standard_code'");
    	$organization->find(true);
        return $organization->id;
    }
    /**
     * 
     *返回平台的医生信息
     */
    function get_staff($org_id,$staff_id)
    {
    	$api_doctor = new Tapi_doctor();
    	$api_doctor->whereAdd("org_id='$org_id'");
    	$api_doctor->whereAdd("doctor_code='$staff_id'");
    	if($api_doctor->count()>0)
    	{
    		$api_doctor->find(true);
	    	$staff_archive = new Tstaff_archive();
	    	$staff_archive->whereAdd("identity_card_number='$api_doctor->identity_number'");
	    	$staff_archive->find(true);
	    	return $staff_archive->user_id;
    	}
    }
    /**
     * 返回机构的 standard_code
     */
    function get_org_standard_code($org_id)
    {
    	$organization = new Torganization();
    	$organization->whereAdd("id='$org_id'");
    	$organization->find(true);
        return $organization->standard_code;
    }
}
?>