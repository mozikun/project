<?php
/**
 * @author 我好笨
 * @todo 本类用于高血压接口功能的具体实现
 */
require_once __SITEROOT."application/api/models/api_phs_iha_comm.php";
class phshyper extends api_phs_comm
{
	private $_error_message_start;
	private $_error_message_end;
	public function __construct()
	{
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/hypertension_follow_up.php";
		require_once __SITEROOT."library/Models/hypertension_symptom.php";
		require_once __SITEROOT."library/Models/follow_up_drugs.php";
		require_once __SITEROOT."library/Models/individual_archive.php";
		require_once __SITEROOT.'library/custom/comm_function.php';
		require_once __SITEROOT."library/Models/organization.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
		$this->_error_message_start="<?xml version='1.0' encoding='UTF-8'?><message>";
		$this->_error_message_end="</message>";
	}
	/**
	 * 删除数据--家庭档案未单独提供删除功能
	 *
	 * @param string $token
	 * @param string $xml_string
	 */
	public function ws_delete($token,$xml_string)
	{
		$status=1;
		$core=new Tindividual_core();
		if ($xml_string) 
		{
			//条件不为空时，解析查询条件
			$where_xml=new SimpleXMLElement($xml_string);
			//反查个人uuid
			$identity_number=$where_xml->identity_number;
			$ext_uuid=$where_xml->ext_uuid;
			if ($ext_uuid=="")
			{
				return $this->_error_message_start."<return_code>2</return_code><return_string>错误，请提供业务号ext_uuid</return_string>".$this->_error_message_end;
			}
			//判断身份证号是否合法
			$identity_number_length=strlen($identity_number);
			if ($identity_number_length!=15 && $identity_number_length!=18)
			{
				return $this->_error_message_start."<return_code>2</return_code><return_string>错误，身份证号只能是15或者18位</return_string>".$this->_error_message_end;
			}
			$core->whereAdd("individual_core.identity_number='".$identity_number."'");
		}
		else 
		{
			return $this->_error_message_start."<return_code>2</return_code><return_string>请传递删除条件XML</return_string>".$this->_error_message_end;
		}
		$core->find(true);
		$core->free_statement();
		if ($core->uuid)
		{
			//查询高血压主表的uuid,供症状表和用药表使用
			$hypertension_follow_up=new Thypertension_follow_up();
			$hypertension_follow_up->whereAdd("ext_uuid='$ext_uuid'");
			$hypertension_follow_up->whereAdd("id='$core->uuid'");
			$hypertension_follow_up->find(true);
			if($hypertension_follow_up->uuid)
			{
				$uuid=$hypertension_follow_up->uuid;
                $org_id=$hypertension_follow_up->org_id;
				//删除高血压主表
				$hypertension_follow_up=new Thypertension_follow_up();
				$hypertension_follow_up->whereAdd("uuid='$uuid'");
				if (!$hypertension_follow_up->delete())
				{
					$status=3;
				}
				//删除高血压症状表
				$hypertension_symptom=new Thypertension_symptom();
				$hypertension_symptom->whereAdd("follow_up_uuid='$uuid'");
				$hypertension_symptom->delete();
				//删除高血压用药表
				$follow_up_drugs=new Tfollow_up_drugs();
				$follow_up_drugs->whereAdd("follow_uuid='$uuid'");
				$follow_up_drugs->whereAdd("call_module='hypertension'");
				$follow_up_drugs->delete();
                $logs_array=array("ext_uuid"=>$ext_uuid,"org_id"=>$org_id,"model_id"=>4,"upload_time"=>time(),"upload_token"=>3);
                $this->insert_api_logs($logs_array);
				return $this->_error_message_start."<return_code>".$status."</return_code><return_string></return_string>".$this->_error_message_end;
			}
			else 
			{
				return $this->_error_message_start."<return_code>3</return_code><return_string>未能找到相关记录，删除失败</return_string>".$this->_error_message_end;
			}
		}
		else 
		{
			return $this->_error_message_start."<return_code>2</return_code><return_string>错误，没有你要的数据，请检查条件</return_string>".$this->_error_message_end;
		}
	}
	/**
	 * 添加或者更新数据--家庭档案创建是在个人档案封面决定，此处只做更新
	 *
	 * @param string $token
	 * @param string $xml_string
	 * @return mixed
	 */
	public function ws_update($token,$xml_string)
	{
		$status=1;//返回标志，默认为1
		$error_message_xml="";//用于存储失败返回的xml内容
		$success_message_xml="";//用于存储成功返回的xml内容
        $error=0;
        $success=0;
		if ($xml_string) 
		{
			//条件不为空时，解析查询条件
			$data_xml=new SimpleXMLElement($xml_string);
			//包含数据字典
			require_once __SITEROOT.'library/data_arr/arrdata.php';
			$dic['hypertension_follow_up']=array("follow_type"=>"follow_type","pregnancy"=>"pregnancy","psychology"=>"psychology","treatment_compliance"=>"treatment_compliance","medication_compliance"=>"medication_compliance","adverse_drug"=>"adverse_drug","follow_up_result"=>"follow_up_result");
			$follwo_up_uuid="";//用于存储主从表关联ID
			$update_status=0;
			foreach ($data_xml as $tables)
			{
				$table_name=$tables->attributes();//表名
				$class_name="T".$table_name;//类名
				//这里必须首先处理高血压主表，否则插入症状表和用药表的关联ID无法获取
				if ($table_name=="hypertension_follow_up")
				{
						foreach ($tables as $rows)
						{
							$org_id=$this->get_org_id($rows->org_id);
                            $org_standard_code=$this->set_org_id($rows->org_id);
							if(!$org_id)
        					{
        						$error_message_xml.="<table name='$table_name'><row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>机构ID不存在</error_msg></table>";
                                $error++;
                                continue;
        					}
                            //判断身份证号是否合法
                            $identity_number=$rows->identity_number;
                			$identity_number_length=strlen($identity_number);
                			if ($identity_number_length!=15 && $identity_number_length!=18)
                			{
                			     $error_message_xml.="<table name='$table_name'><row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>错误，身份证号只能是15或者18位</error_msg></table>";
                                 $error++;
                                 continue;
                			}
                			//根据身份证查询此用户是否建档
                			$core=new Tindividual_core();
                			$core->whereAdd("individual_core.identity_number='".$identity_number."'");
                			if (!$core->count("uuid"))
                			{
                                $error_message_xml.="<table name='$table_name'><row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>身份证号为：".$rows->identity_number."的用户未建档，请先调用建档接口</error_msg></table>";
                                $error++;
                                $core->free_statement();
                                continue;
                			}
                			else 
                			{
                				$core->find(true);
                                $core->free_statement();
                				$id=$core->uuid;//个人档案号
                				if(!$id)
                				{
                                    $error_message_xml.="<table name='$table_name'><row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>此用户的档案有错误，没有个人档案序号uuid值</error_msg></table>";
                                    $error++;
                                    continue;
                				}
                			}
                            //判定ext_uuid不能为空
							if ($rows->ext_uuid=='')
							{
								$status=3;
								$error_message_xml.="<table name='$table_name'><row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>业务ID字段ext_uuid不能为空</error_msg></table>";
                                $error++;
								continue;
							}
							//查询更新标志
							$table_object=new $class_name();
							$table_object->whereAdd("id='$id'");
							$table_object->whereAdd("org_id='$org_id'");
							$table_object->whereAdd("ext_uuid='".$rows->ext_uuid."'");
							if ($table_object->count())
							{
								$update_status=1;
								$table_object->find(true);
								$follwo_up_uuid=$table_object->uuid;
							}
							$table_object->free_statement();
							$table_object=new $class_name();
							foreach ($rows as $colums)
							{
								$colums_name=$colums->getname();//字段名
								//排除除核心表之外的其他表里的身份证号字段
								if ($colums_name!="identity_number")
								{
									$colums_value=$rows->$colums_name;
									$table_object->$colums_name=$colums_value;//赋值
									if (isset($dic["$table_name"]) && !empty($dic["$table_name"]) && $colums_value!="" && $table_object->$colums_name!="#^&*^&*#" && isset($dic["$table_name"]["$colums_name"]) && isset($table_object->$colums_name))
									{
										$n=$dic["$table_name"]["$colums_name"];
										$table_object->$colums_name=array_code_change($colums_value,$$n);
									}
								}
							}
							if (isset($table_object->staff_id))
							{
								$table_object->staff_id=$this->set_doctor_number($table_object->staff_id);//处理医生
							}
							if (isset($table_object->org_id))
							{
								$table_object->org_id=$this->get_org_id($table_object->org_id);
							}
                            //$table_object->debug(5);
							if ($update_status)
							{
								$table_object->whereAdd("id='$id'");
								$table_object->whereAdd("org_id='$org_id'");
								$table_object->whereAdd("ext_uuid='".$rows->ext_uuid."'");
								$update_except_array=array("uuid","id","org_id","created");//更新时不能更新的字段数组
								foreach ($update_except_array as $v)
								{
									if (isset($table_object->$v))
									{
										unset($table_object->$v);
									}
								}
								if (!$table_object->update())
								{
									$status=3;
                                    $error_msg=$table_object->showErrorMessage();
									$error_message_xml.="<table name='$table_name'><row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>更新数据出错，出错信息：$error_msg</error_msg></table>";
                                    $error++;
                                    $table_object->free_statement();
                                    continue;
								}
								else 
								{
								    $logs_array=array("ext_uuid"=>$rows->ext_uuid,"org_id"=>$org_id,"model_id"=>4,"upload_time"=>time(),"upload_token"=>2);
                                    $this->insert_api_logs($logs_array);
									$success++;
								}
								$table_object->free_statement();
							}
							else 
							{
								$table_object->org_id=$org_id;
								$table_object->id=$id;
								//插入数据时需要生成uuid
								$follwo_up_uuid=$table_object->uuid=uniqid(strtoupper(substr($table_name,0,1))."_");
								if (!$table_object->insert())
								{
									$status=3;
                                    $error_msg=$table_object->showErrorMessage();
									$error_message_xml.="<table name='$table_name'><row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>写入数据出错，错误信息：$error_msg</error_msg></table>";
                                    $error++;
                                    $table_object->free_statement();
                                    continue;
								}
								else 
								{
								    $logs_array=array("ext_uuid"=>$rows->ext_uuid,"org_id"=>$org_id,"model_id"=>4,"upload_time"=>time(),"upload_token"=>1);
                                    $this->insert_api_logs($logs_array);
									$success++;
								}
								$table_object->free_statement();
							}
						}
				}
			}
			//有主表UUID之后，处理从表数据
			if ($follwo_up_uuid)
			{
				foreach ($data_xml as $tables)
				{
					$update_status=0;//更新标志放这里
					$table_name=$tables->attributes();//表名
					$class_name="T".$table_name;//类名
                    if ($table_name!="hypertension_follow_up")
					{
                        //查询更新标志
    					$table_object=new $class_name();
                        //$table_object->debug(5);
    					$table_object->whereAdd("id='$id'");
    					$table_object->whereAdd("org_id='$org_id'");
                        //采用涛哥的方式，先删除记录，再添加记录
    					$table_object->whereAdd("ext_uuid='".$rows->ext_uuid."'");
    					if ($table_object->delete())
    					{
    					   $update_status=0;
    					}
    					$table_object->free_statement();
                    }
					foreach ($tables as $rows)
					{
						$org_id=$this->get_org_id($rows->org_id);
                        $org_standard_code=$this->set_org_id($rows->org_id);
						if(!$org_id)
    					{
    						$error_message_xml.="<table name='$table_name'><row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>机构ID不存在</error_msg></table>";
                            $error++;
                            continue;
    					}
                        //判断身份证号是否合法
                        $identity_number=$rows->identity_number;
            			$identity_number_length=strlen($identity_number);
            			if ($identity_number_length!=15 && $identity_number_length!=18)
            			{
            			     $error_message_xml.="<table name='$table_name'><row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>错误，身份证号只能是15或者18位</error_msg></table>";
                             $error++;
                             continue;
            			}
            			//根据身份证查询此用户是否建档
            			$core=new Tindividual_core();
            			$core->whereAdd("individual_core.identity_number='".$identity_number."'");
            			if (!$core->count("uuid"))
            			{
                            $error_message_xml.="<table name='$table_name'><row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>身份证号为：".$rows->identity_number."的用户未建档，请先调用建档接口</error_msg></table>";
                            $error++;
                            $core->free_statement();
                            continue;
            			}
            			else 
            			{
            				$core->find(true);
                            $core->free_statement();
            				$id=$core->uuid;//个人档案号
            				if(!$id)
            				{
                                $error_message_xml.="<table name='$table_name'><row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>此用户的档案有错误，没有个人档案序号uuid值</error_msg></table>";
                                $error++;
                                continue;
            				}
            			}
						//这里处理从表数据
						if ($table_name!="hypertension_follow_up")
						{
								$table_object=new $class_name();
								foreach ($rows as $colums)
								{
									$colums_name=$colums->getname();//字段名
									//排除除核心表之外的其他表里的身份证号字段
									if ($colums_name!="identity_number")
									{
										$colums_value=$rows->$colums_name;
										$table_object->$colums_name=$colums_value;//赋值
									}
								}
								if (isset($table_object->staff_id))
								{
									$table_object->staff_id=$this->set_doctor_number($table_object->staff_id);//处理医生
								}
								if (isset($table_object->org_id))
								{
									$table_object->org_id=$this->get_org_id($table_object->org_id);
								}
								if ($update_status)
								{
									$table_object->whereAdd("id='$id'");
									$table_object->whereAdd("org_id='$org_id'");
									$table_object->whereAdd("ext_uuid='".$rows->ext_uuid."'");
									$update_except_array=array("uuid","follow_up_uuid","follow_uuid","id","org_id","created");//更新时不能更新的字段数组
									foreach ($update_except_array as $v)
									{
										if (isset($table_object->$v))
										{
											unset($table_object->$v);
										}
									}
                                    if ($table_name=="follow_up_drugs")
									{
                                        $table_object->call_module='hypertension';
									}
									if (!$table_object->update())
									{
										$status=3;
										$error_msg=$table_object->showErrorMessage();
            							$error_message_xml.="<table name='$table_name'><row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>$error_msg</error_msg></table>";
                                        $error++;
                                        $table_object->free_statement();
                                        continue;
									}
									else 
									{
									    $logs_array=array("ext_uuid"=>$rows->ext_uuid,"org_id"=>$org_id,"model_id"=>4,"upload_time"=>time(),"upload_token"=>2);
                                        $this->insert_api_logs($logs_array);
										$success++;
									}
									$table_object->free_statement();
								}
								else 
								{
									$table_object->org_id=$org_id;
									$table_object->id=$id;
									//根据表来写关联字段，因为这里字段未统一
									if ($table_name=="hypertension_symptom")
									{
										$table_object->follow_up_uuid=$follwo_up_uuid;
									}
									if ($table_name=="follow_up_drugs")
									{
										$table_object->follow_uuid=$follwo_up_uuid;
                                        $table_object->call_module='hypertension';
									}
									//插入数据时需要生成uuid
									$table_object->uuid=uniqid(strtoupper(substr($table_name,0,1))."_");
                                    //$table_object->debug(5);
									if (!$table_object->insert())
									{
										$status=3;
										$error_msg=$table_object->showErrorMessage();
            							$error_message_xml.="<table name='$table_name'><row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>$error_msg</error_msg></table>";
                                        $error++;
									}
									else 
									{
									    $logs_array=array("ext_uuid"=>$rows->ext_uuid,"org_id"=>$org_id,"model_id"=>4,"upload_time"=>time(),"upload_token"=>2);
                                        $this->insert_api_logs($logs_array);
										$success++;
									}
									$table_object->free_statement();
								}
						}
					}
				}
			}
            return $this->_error_message_start.$error_message_xml."<return_string>成功更新".$success."条记录，".$error."条记录更新失败</return_string>".$this->_error_message_end;
		}
		else 
		{
			return $this->_error_message_start."<return_code>2</return_code><return_string>未传递任何数据xml</return_string>".$this->_error_message_end;
		}
	}
	/**
	 * 查询单条数据
	 *
	 * @param string $token
	 * @param string $xml_string
	 */
	public function ws_select_single($token,$xml_string)
	{
		$exclude_array=array("uuid","syn_flag","deleted","id","call_module","follow_uuid","follow_up_uuid");//排除部分不必要的字段在结果里
		$core=new Tindividual_core();
		if ($xml_string) 
		{
			//条件不为空时，解析查询条件
			$where_xml=new SimpleXMLElement($xml_string);
			//反查个人uuid
			$identity_number=$where_xml->identity_number;
			$ext_uuid=$where_xml->ext_uuid;
			if ($ext_uuid=="")
			{
				return $this->_error_message_start."<return_code>2</return_code><return_string>错误，请提供业务号ext_uuid</return_string>".$this->_error_message_end;//错误，请提供业务号ext_uuid
			}
			//判断身份证号是否合法
			$identity_number_length=strlen($identity_number);
			if ($identity_number_length!=15 && $identity_number_length!=18)
			{
				return $this->_error_message_start."<return_code>2</return_code><return_string>错误，身份证号只能是15或者18位</return_string>".$this->_error_message_end;//错误，身份证号只能是15或者18位
			}
			$core->whereAdd("individual_core.identity_number='".$identity_number."'");
		}
		else 
		{
			return $this->_error_message_start."<return_code>2</return_code><return_string>请传递查询条件XML</return_string>".$this->_error_message_end;//请传递查询条件XML
		}
		$core->find(true);
		$core->free_statement();
		if ($core->uuid)
		{
			//查询高血压主表数据
			$hypertension_follow_up=new Thypertension_follow_up();
            //判断有当前这个数据没有
			$match_array = preg_match_all('~\w+\.\w+~i',$ext_uuid,$my_array);//判断是中联数据还是平台数据
            $tag=true;
			if(empty($my_array[0][0]))
			{
			     $tag=true;
                 $hypertension_follow_up->whereAdd("ext_uuid='$ext_uuid'");
			}
			else 
			{
			     $tag=false;
                 $hypertension_follow_up->whereAdd("uuid='$ext_uuid'");
			}
			$hypertension_follow_up->whereAdd("id='$core->uuid'");
			if (!$hypertension_follow_up->count("uuid"))
			{
				return $this->_error_message_start."<return_code>2</return_code><return_string>未能查找到关于身份证号：".$identity_number."，业务ID为".$ext_uuid."的相关高血压随访记录</return_string>".$this->_error_message_end;//未能查找到关于身份证号：".$identity_number."，业务ID为".$ext_uuid."的相关高血压随访记录
			}
			$hypertension_follow_up->find(true);
			require_once __SITEROOT.'library/data_arr/arrdata.php';
			$dic['hypertension_follow_up']=array("follow_type"=>"follow_type","pregnancy"=>"pregnancy","psychology"=>"psychology","treatment_compliance"=>"treatment_compliance","medication_compliance"=>"medication_compliance","adverse_drug"=>"adverse_drug","follow_up_result"=>"follow_up_result");
			$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables><table name='hypertension_follow_up'><row><identity_number>".$identity_number."</identity_number>";
			foreach ($dic['hypertension_follow_up'] as $m=>$n)
			{
				if (isset($hypertension_follow_up->$m) && isset($dic['hypertension_follow_up'][$m]))
				{
					$hypertension_follow_up->$m=array_search_for_other($hypertension_follow_up->$m,$$n);
				}
			}
			if (isset($hypertension_follow_up->staff_id))
			{
				$hypertension_follow_up->staff_id=$this->get_doctor_number($hypertension_follow_up->staff_id);
			}
			if (isset($hypertension_follow_up->org_id))
			{
				$hypertension_follow_up->org_id=$this->set_org_id($hypertension_follow_up->org_id);
			}
            if(!$tag)
            {
                //对ext_uuid重新赋值
                $hypertension_follow_up->ext_uuid=$ext_uuid;
            }
			$xml_string.=$hypertension_follow_up->toXML("",$exclude_array);
			$hypertension_follow_up->free_statement();
			$xml_string.="</row></table>";
			//症状表
			$xml_string.="<table name='hypertension_symptom'>";
			$hypertension_symptom=new Thypertension_symptom();
			$hypertension_symptom->whereAdd("follow_up_uuid='$hypertension_follow_up->uuid'");
			$hypertension_symptom->find();
			while ($hypertension_symptom->fetch())
			{
				$xml_string.="<row><identity_number>".$identity_number."</identity_number>";
				if (isset($hypertension_symptom->staff_id))
				{
					$hypertension_symptom->staff_id=$this->get_doctor_number($hypertension_symptom->staff_id);
				}
				if (isset($hypertension_symptom->org_id))
				{
					$hypertension_symptom->org_id=$this->set_org_id($hypertension_symptom->org_id);
				}
                if(!$tag)
                {
                    //对ext_uuid重新赋值
                    $hypertension_symptom->ext_uuid=$ext_uuid;
                }
				$xml_string.=$hypertension_symptom->toXML("",$exclude_array);
				$xml_string.="</row>";
			}
			$hypertension_symptom->free_statement();
			$xml_string.="</table>";
			//用药情况
			$xml_string.="<table name='follow_up_drugs'>";
			$follow_up_drugs=new Tfollow_up_drugs();
			$follow_up_drugs->whereAdd("follow_uuid='$hypertension_follow_up->uuid'");
			$follow_up_drugs->whereAdd("call_module='hypertension'");
			$follow_up_drugs->find();
			while ($follow_up_drugs->fetch())
			{
				$xml_string.="<row><identity_number>".$identity_number."</identity_number>";
				if (isset($follow_up_drugs->staff_id))
				{
					$follow_up_drugs->staff_id=$this->get_doctor_number($follow_up_drugs->staff_id);
				}
				if (isset($follow_up_drugs->org_id))
				{
					$follow_up_drugs->org_id=$this->set_org_id($follow_up_drugs->org_id);
				}
                if(!$tag)
                {
                    //对ext_uuid重新赋值
                    $follow_up_drugs->ext_uuid=$ext_uuid;
                }
				$xml_string.=$follow_up_drugs->toXML("",$exclude_array);
				$xml_string.="</row>";
			}
			$follow_up_drugs->free_statement();
			$xml_string.="</table>";
			$xml_string.="</tables>";
			return $xml_string;
		}
		else 
		{
			return $this->_error_message_start."<return_code>2</return_code><return_string>没有你要查询的数据，请检查查询条件</return_string>".$this->_error_message_end;//错误，没有你要查询的数据，请检查查询条件
		}
	}
    /**
     * phshyper::ws_select_all()
     * 
     * xml传一个机构号取得这个机构下边的对应的所有人的数据  返回  （中联传的数据时返回ext_uuid）如果是我们系统的时候就是uuid
返回  ext_uuid  org_id  identity_number  其中 中联传来的数据 ext_uuid为ext_uuid字段数据   我们系统的数据 ext_uuid为uuid字段数据
     * 
     * $xml_string 只有一个参数org_id
     * 
     * 此接口实际无任何用处，拉去数据时，百分之百内存溢出，待第三方测试结果
     * 
     * 2013-05-14
     * 
     * @param mixed $token
     * @param mixed $xml_string
     * @return void
     */
    public function ws_select_all($token,$xml_string)
    {
		$getxml = new SimpleXMLElement($xml_string);
		$org_id = $getxml->org_id;
		if(empty($org_id))
		{
			return $this->_error_message_start."<return_code>2</return_code><return_string>机构号为空，请检查</return_string>".$this->_error_message_end;
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
				//取得做过高血压随访的人
				$diabetes_core = new Thypertension_follow_up();
				$diabetes_core->query("select count(*) as cou from hypertension_follow_up where hypertension_follow_up.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
				$diabetes_core->fetch();
				$number = $diabetes_core->cou;
				if($number>0)
				{
					$diabetes_core_select = new Thypertension_follow_up();
					$diabetes_core_select->query("select * from hypertension_follow_up where hypertension_follow_up.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
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
				    return $this->_error_message_start.$response_str.$this->_error_message_end;
				}
				else 
				{
					return $this->_error_message_start."<return_code>2</return_code><return_string>机构号为".$org_id."的机构没有查询到高血压随访病人</return_string>".$this->_error_message_end;
				}
			}
			else 
			{
				return $this->_error_message_start."<return_code>2</return_code><return_string>机构号不存在</return_string>".$this->_error_message_end;
			}
		}
    }
    /**
     * phshyper::ws_select_persons()
     * 
     * 根据个人ID，查询个人的所有随访记录
     * 
     * 2013-05-14
     * 
     * @param mixed $token
     * @param mixed $xml_string
     * @return void
     */
    public function ws_select_persons($token,$xml_string)
    {
		$getxml = new SimpleXMLElement($xml_string);
        $org_id = $getxml->org_id;
        $identity_number = $getxml->identity_number;
	    if($org_id=='')
		{
			return $this->_error_message_start."<return_code>2</return_code><return_string>机构号为空，请检查</return_string>".$this->_error_message_end;
		}
		if($identity_number=='')
		{
			return $this->_error_message_start."<return_code>2</return_code><return_string>身份证为空，请检查</return_string>".$this->_error_message_end;
		}
		//转换org_id
		$organization = new Torganization();
		$organization->whereAdd("standard_code='$org_id'");
		$organization->find(true);
		$org_id_number = $organization->id;
		//取得这个身份证和机构联查得到的所有高血压随访数据
		$diabetes_core = new Thypertension_follow_up();
		$diabetes_core->query("select count(*) as cou from hypertension_follow_up where hypertension_follow_up.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number' and individual_core.identity_number='$identity_number')");
		$diabetes_core->fetch();
		$count = $diabetes_core->cou;
		if($count>0)
		{   
			$response_str = '';
			$diabetes_core_select = new Thypertension_follow_up();
			$diabetes_core_select->query("select * from hypertension_follow_up where hypertension_follow_up.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number' and individual_core.identity_number='$identity_number')");
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
			return $this->_error_message_start.$response_str.$this->_error_message_end;
		}
		else 
		{
			return $this->_error_message_start."<return_code>2</return_code><return_string>身份证为".$identity_number."，机构号为".$org_id."的高血压数据未查询到！</return_string>".$this->_error_message_end;
		}
    }
}
?>