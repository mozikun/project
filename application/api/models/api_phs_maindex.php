<?php
/**
 * @author 我好笨
 * @todo 本类用于孕产妇管理第一次产前随访接口功能的具体实现
 */
require_once __SITEROOT."application/api/models/api_phs_iha_comm.php";
class phsmaindex extends api_phs_comm
{
	private $_error_message_start;
	private $_error_message_end;
	public function __construct()
	{
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/prenatal_visit_first.php";
		require_once __SITEROOT."library/Models/individual_archive.php";
		require_once __SITEROOT.'library/custom/comm_function.php';
		require_once __SITEROOT."library/Models/organization.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
		$this->_error_message_start="<?xml version='1.0' encoding='UTF-8'?><message>";
		$this->_error_message_end="</message>";
	}
	/**
	 * 删除数据
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
			//查询uuid
			$prenatal_visit_first=new Tprenatal_visit_first();
			$prenatal_visit_first->whereAdd("ext_uuid='$ext_uuid'");
			$prenatal_visit_first->whereAdd("id='$core->uuid'");
			$prenatal_visit_first->find(true);
			if($prenatal_visit_first->uuid)
			{
				$uuid=$prenatal_visit_first->uuid;
                $org_id=$prenatal_visit_first->org_id;
				$prenatal_visit_first->free_statement();
				//删除第2-5次关联记录
				require_once __SITEROOT."library/Models/prenatal_visit_two.php";
				$prenatal_visit_two=new Tprenatal_visit_two();
				$prenatal_visit_two->whereAdd("fid='$uuid'");
				$prenatal_visit_two->delete();
				$prenatal_visit_two->free_statement();
				//删除产后访视
				require_once __SITEROOT."library/Models/postpartum_visit.php";
				$postpartum_visit=new Tpostpartum_visit();
				$postpartum_visit->whereAdd("fid='$uuid'");
				$postpartum_visit->delete();
				$postpartum_visit->free_statement();
				//删除产后42天健康检查
				require_once __SITEROOT."library/Models/postpartum_heathcheck.php";
				$postpartum_heathcheck=new Tpostpartum_heathcheck();
				$postpartum_heathcheck->whereAdd("fid='$uuid'");
				$postpartum_heathcheck->delete();
				$postpartum_heathcheck->free_statement();
				//删除
				$prenatal_visit_first=new Tprenatal_visit_first();
				$prenatal_visit_first->whereAdd("uuid='$uuid'");
				if (!$prenatal_visit_first->delete())
				{
					$prenatal_visit_first->free_statement();
					$status=3;
				}
                $logs_array=array("ext_uuid"=>$ext_uuid,"org_id"=>$org_id,"model_id"=>7,"upload_time"=>time(),"upload_token"=>3);
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
	 * 添加或者更新数据
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
			$dic['prenatal_visit_first']=array("fksss"=>"fksss","auscultation_heart"=>"ma_comm","auscultation_lung"=>"ma_comm","vulva"=>"ma_comm","vaginal"=>"ma_comm","cervix"=>"ma_comm","uterus"=>"ma_comm","dnexauteri"=>"ma_comm","vaginal_cleanliness"=>"vaginal_cleanliness","result_of_vdrl"=>"ma_vdrl","div_antibody_check"=>"ma_vdrl","overall_assessment"=>"ma_comm","referral"=>"fksss");
			$dic['special']=array("clinical_history"=>"ma_clinical_history","family_history"=>"ma_family_history","personal_history"=>"ma_personal_history","vaginal_fluid"=>"vaginal_fluid","health_guide"=>"ma_health_guide");//值中有'|'符号的
			$update_status=0;
			foreach ($data_xml as $tables)
			{
				$table_name=$tables->attributes();//表名
				$class_name="T".$table_name;//类名
				$prenatal_uuid='';
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
					//查询更新标志
					$table_object=new $class_name();
					$table_object->whereAdd("id='$id'");
					$table_object->whereAdd("org_id='$org_id'");
					$table_object->whereAdd("ext_uuid='".$rows->ext_uuid."'");
                    //$table_object->debug(5);
					if ($table_object->count())
					{
						$update_status=1;
						$table_object->find(true);
						$prenatal_uuid=$table_object->uuid;
					}
					$table_object->free_statement();
					$table_object=new $class_name();
                    //$table_object->debug(5);
					foreach ($rows as $colums)
					{
						$colums_name=(string)$colums->getname();//字段名
						$colums_value=$rows->$colums_name;
						//判定ext_uuid不能为空
						if ($colums_name=="ext_uuid" && $colums_value=='')
						{
							$error_message_xml.="<table name='$table_name'><row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>业务ID字段ext_uuid不能为空</error_msg></table>";
                            $error++;
							continue;
						}
						//排除除核心表之外的其他表里的身份证号字段
						if ($colums_name!="identity_number")
						{
							$table_object->$colums_name=$colums_value;//赋值      
							//特殊处理有'|'字符的数据
							if(isset($dic['special'][$colums_name]))
							{
                                $colums_value=(string)$colums_value;
								if (strpos($colums_value,'|')!==false)
								{
									//有|才做转换
									$temp=array();
									$temp=explode('|',$colums_value);
									foreach ($temp as $k=>$v)
									{
										
										if ($colums_value!="" && $table_object->$colums_name!="#^&*^&*#" && isset($dic["special"]["$colums_name"]) && isset($table_object->$colums_name))
										{
											$n=$dic["special"]["$colums_name"];
											$temp[$k]=array_code_change($v,$$n);
										}
									}
									$table_object->$colums_name=implode('|',$temp);
								}
                                else
                                {
                                    if ($colums_value!="" && $table_object->$colums_name!="#^&*^&*#" && isset($dic["special"]["$colums_name"]) && isset($table_object->$colums_name))
								    {
								        $n=$dic["special"]["$colums_name"];
								        $table_object->$colums_name=array_code_change($colums_value,$$n);
								    }
                                }
							}
							else 
							{
								if (isset($dic["$table_name"]) && !empty($dic["$table_name"]) && $colums_value!="" && $table_object->$colums_name!="#^&*^&*#" && isset($dic["$table_name"]["$colums_name"]) && isset($table_object->$colums_name))
								{
									$n=$dic["$table_name"]["$colums_name"];
									$table_object->$colums_name=array_code_change($colums_value,$$n);
								}
							}
						}
					}
					if (isset($table_object->staff_id))
					{
						$table_object->staff_id=$this->set_doctor_number($table_object->staff_id);//处理医生
					}
                    //2013-08-19增加，原来未处理
                    if (isset($table_object->follow_staff))
					{
						$table_object->follow_staff=$this->set_doctor_number($table_object->follow_staff);//处理医生
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
							$error_message_xml="<row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row>";
                            $error++;
                            $table_object->free_statement();
                            continue;
						}
						else
						{
						    $logs_array=array("ext_uuid"=>$rows->ext_uuid,"org_id"=>$org_id,"model_id"=>7,"upload_time"=>time(),"upload_token"=>2);
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
						$prenatal_uuid=$table_object->uuid=uniqid(strtoupper(substr($table_name,0,1))."_");
						if (!$table_object->insert())
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
                            $logs_array=array("ext_uuid"=>$rows->ext_uuid,"org_id"=>$org_id,"model_id"=>7,"upload_time"=>time(),"upload_token"=>1);
                            $this->insert_api_logs($logs_array);
							$success++;
						}
						$table_object->free_statement();
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
		$exclude_array=array("uuid","syn_flag","deleted","id");//排除部分不必要的字段在结果里
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
			$prenatal_visit_first=new Tprenatal_visit_first();
            //判断有当前这个数据没有
			$match_array = preg_match_all('~\w+\.\w+~i',$ext_uuid,$my_array);//判断是中联数据还是平台数据
            $tag=true;
			if(empty($my_array[0][0]))
			{
			     $tag=true;
                 $prenatal_visit_first->whereAdd("ext_uuid='$ext_uuid'");
			}
			else 
			{
			     $tag=false;
                 $prenatal_visit_first->whereAdd("uuid='$ext_uuid'");
			}
			$prenatal_visit_first->whereAdd("id='$core->uuid'");
			if (!$prenatal_visit_first->count("uuid"))
			{
				return $this->_error_message_start."<return_code>2</return_code><return_string>未能查找到关于身份证号：".$identity_number."，业务ID为".$ext_uuid."的相关第一次产前随访的记录</return_string>".$this->_error_message_end;
			}
			$prenatal_visit_first->find(true);
			require_once __SITEROOT.'library/data_arr/arrdata.php';
			$dic['prenatal_visit_first']=array("fksss"=>"fksss","auscultation_heart"=>"ma_comm","auscultation_lung"=>"ma_comm","vulva"=>"ma_comm","vaginal"=>"ma_comm","cervix"=>"ma_comm","uterus"=>"ma_comm","dnexauteri"=>"ma_comm","vaginal_cleanliness"=>"ma_vaginal_cleanliness","result_of_vdrl"=>"ma_vdrl","div_antibody_check"=>"ma_vdrl","overall_assessment"=>"ma_comm","referral"=>"fksss");
			$dic['special']=array("clinical_history"=>"ma_clinical_history","family_history"=>"ma_family_history","personal_history"=>"ma_personal_history","vaginal_fluid"=>"vaginal_fluid","health_guide"=>"ma_health_guide");//值中有'|'符号的
			$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables><table name='prenatal_visit_first'><row><identity_number>".$identity_number."</identity_number>";
			foreach ($dic['prenatal_visit_first'] as $m=>$n)
			{
				if (isset($prenatal_visit_first->$m) && isset($dic['prenatal_visit_first'][$m]))
				{
					$prenatal_visit_first->$m=array_search_for_other($prenatal_visit_first->$m,$$n);
				}
			}
			//单独处理|
			foreach ($dic['special'] as $m=>$n)
			{
				if (isset($prenatal_visit_first->$m) && isset($dic['special'][$m]))
				{
					if (strpos($prenatal_visit_first->$m,'|')!==false)
					{
						//有|才做转换
						$temp=$temp_implode=array();
						$temp=explode('|',$colums_value);
						foreach ($temp as $k=>$v)
						{
							if ($v!="")
							{
								$temp_implode[$k]=array_search_for_other($v,$$n);
							}
						}
						$prenatal_visit_first->$m=implode('|',$temp_implode);
					}
                    else
                    {
                        $postpartum_visit->$m=array_search_for_other($colums_value,$$n);
                    }
				}
			}
			if (isset($prenatal_visit_first->staff_id))
			{
				$prenatal_visit_first->staff_id=$this->get_doctor_number($prenatal_visit_first->staff_id);
			}
            //2013-08-19增加处理
            if (isset($prenatal_visit_first->follow_staff))
			{
				$prenatal_visit_first->follow_staff=$this->get_doctor_number($prenatal_visit_first->follow_staff);
			}
			if (isset($prenatal_visit_first->org_id))
			{
				$prenatal_visit_first->org_id=$this->set_org_id($prenatal_visit_first->org_id);
			}
            if(!$tag)
            {
                //对ext_uuid重新赋值
                $prenatal_visit_first->ext_uuid=$ext_uuid;
            }
			$xml_string.=$prenatal_visit_first->toXML("",$exclude_array);
			$prenatal_visit_first->free_statement();
			$xml_string.="</row></table>";
			$xml_string.="</tables>";
			return $xml_string;
		}
		else
		{
			return $this->_error_message_start."<return_code>2</return_code><return_string>没有你要查询的数据，请检查查询条件</return_string>".$this->_error_message_end;//错误，没有你要查询的数据，请检查查询条件
		}
	}
    /**
     * phsmaindex::ws_select_all()
     * 
     * 根据机构号，查询所有第一次产前随访记录
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
				//取得做过第一次产前随访的人
				$diabetes_core = new Tprenatal_visit_first();
				$diabetes_core->query("select count(*) as cou from prenatal_visit_first where prenatal_visit_first.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
				$diabetes_core->fetch();
				$number = $diabetes_core->cou;
				if($number>0)
				{
					$diabetes_core_select = new Tprenatal_visit_first();
					$diabetes_core_select->query("select * from prenatal_visit_first where prenatal_visit_first.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
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
					return $this->_error_message_start."<return_code>2</return_code><return_string>机构号为".$org_id."的机构没有查询到第一次产前随访病人</return_string>".$this->_error_message_end;
				}
			}
			else 
			{
				return $this->_error_message_start."<return_code>2</return_code><return_string>机构号不存在</return_string>".$this->_error_message_end;
			}
		}
    }
    /**
     * phsmaindex::ws_select_persons()
     * 
     * 根据个人身份证号码，查询所有第一次产前随访记录
     * 
     * 2013-05-14
     * 
     * @param mixed $token
     * @param mixed $xml_string
     * @return
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
		//取得这个身份证和机构联查得到的所有第一次产前随访数据
		$diabetes_core = new Tprenatal_visit_first();
		$diabetes_core->query("select count(*) as cou from prenatal_visit_first where prenatal_visit_first.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number' and individual_core.identity_number='$identity_number')");
		$diabetes_core->fetch();
		$count = $diabetes_core->cou;
		if($count>0)
		{   
			$response_str = '';
			$diabetes_core_select = new Tprenatal_visit_first();
			$diabetes_core_select->query("select * from prenatal_visit_first where prenatal_visit_first.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number' and individual_core.identity_number='$identity_number')");
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
			return $this->_error_message_start."<return_code>2</return_code><return_string>身份证为".$identity_number."，机构号为".$org_id."的第一次产前随访数据未查询到！</return_string>".$this->_error_message_end;
		}
    }
}
?>