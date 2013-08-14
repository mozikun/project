<?php
/**
 * @author 我好笨
 * @todo 本类用于家庭档案接口功能的具体实现
 */
require_once __SITEROOT."application/api/models/api_phs_iha_comm.php";
class phsfamily extends api_phs_comm
{
	private $_error_message_start;
	private $_error_message_end;
	public function __construct()
	{
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/family_archive.php";
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
			require_once __SITEROOT.'/library/data_arr/arrdata.php';
			$dic['family_archive']=array("bide_style"=>"family_bide_style","building_style"=>"family_building_style","drinking_water_source"=>"family_drinking_water_source","sanitation"=>"family_sanitation","fuel"=>"family_fuel","home_month_income"=>"family_home_month_income","home_phone"=>"family_home_phone","home_refrigeratory"=>"family_home_refrigeratory","secondhand_smoke"=>"family_secondhand_smoke","fat_food"=>"family_fat_food","deepfry_food"=>"family_deepfry_food","bloat_food"=>"family_bloat_food","sweet_food"=>"family_sweet_food","greenstuff"=>"family_greenstuff");
			//按照规范，虽然家庭档案目前仅有一个表，不排除以后有多个表，因此同样遍历表
			foreach ($data_xml as $tables)
			{
				$table_name=$tables->attributes();//表名
				$class_name="T".$table_name;//类名
				//遍历行
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
					$table_object=new $class_name();
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
                        $core->free_statement();
                        $error++;
                        continue;
        			}
        			else 
        			{
        				$core->find(true);
                        $core->free_statement();
        				$family_number=$core->family_number;//家庭档案号
        				if(!$family_number)
        				{
                            $error_message_xml.="<table name='$table_name'><row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>获取家庭档案信息错误，无法更新信息</error_msg></table>";
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
					//遍历字段
					foreach ($rows as $colums)
					{
						//给字段赋值
						$colums_name=$colums->getname();//字段名
						$colums_value=$rows->$colums_name;
                        
						//排除身份证号字段
						if ($colums_name!="identity_number")
						{
							$table_object->$colums_name=$colums_value;//赋值
							//需要做数据字典处理的数据，做数据字典替换
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
						$table_object->org_id=$this->get_org_id($table_object->org_id);//处理医生
					}
					$table_object->whereAdd("org_id='$org_id'");
					if ($table_name=="family_archive")
					{
						//只做更新，家庭档案只能依靠家庭档案号来更新
						$table_object->whereAdd("family_number='$family_number'");
					}
					else 
					{
						$table_object->whereAdd("ext_uuid='$ext_uuid'");
					}
					$update_except_array=array("uuid","family_number","org_id","created","region_path","householder_name");//更新时不能更新的字段数组
					foreach ($update_except_array as $v)
					{
						if (isset($table_object->$v))
						{
							unset($table_object->$v);
						}
					}
					if ($family_number=="" || !$table_object->update())
					{
						$status=3;
						$error_msg=$table_object->showErrorMessage();
						$error_message_xml.="<table name='$table_name'><row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>$error_msg</error_msg></table>";
                        $error++;
					}
					else 
					{					   					   
					    $logs_array=array("ext_uuid"=>$rows->ext_uuid,"org_id"=>$org_id,"model_id"=>2,"upload_time"=>time(),"upload_token"=>2);
                        $this->insert_api_logs($logs_array);
						$success++;
					}
					$table_object->free_statement();
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
		$exclude_array=array("uuid","syn_flag","deleted","id","family_number","householder_id");//排除部分不必要的字段在结果里
		$core=new Tindividual_core();
		$individual_archive=new Tindividual_archive();
		$core->joinAdd('left',$core,$individual_archive,'uuid','id');
		if ($xml_string) 
		{
			//条件不为空时，解析查询条件
			$where_xml=new SimpleXMLElement($xml_string);
			$identity_number=$where_xml->identity_number;
			//判断身份证号是否合法
			$identity_number_length=strlen($identity_number);
			if ($identity_number_length!=15 && $identity_number_length!=18)
			{
				return $this->_error_message_start."<return_code>2</return_code><return_string>错误，身份证号只能是15或者18位</return_string>".$this->_error_message_end;//错误，身份证号只能是15或者18位
			}
			$core->whereAdd("individual_core.identity_number='".$identity_number."'");
		}
		$core->find(true);
		$core->free_statement();
		$dic['family_archive']=array("bide_style"=>"family_bide_style","building_style"=>"family_building_style","drinking_water_source"=>"family_drinking_water_source","sanitation"=>"family_sanitation","fuel"=>"family_fuel","home_month_income"=>"family_home_month_income","home_phone"=>"family_home_phone","home_refrigeratory"=>"family_home_refrigeratory","secondhand_smoke"=>"family_secondhand_smoke","fat_food"=>"family_fat_food","deepfry_food"=>"family_deepfry_food","bloat_food"=>"family_bloat_food","sweet_food"=>"family_sweet_food","greenstuff"=>"family_greenstuff");
		if ($core->uuid)
		{
			if ($core->family_number)
			{
				$family=new Tfamily_archive();
				$family->whereAdd("uuid='$core->family_number'");
				$family->find(true);
				require_once __SITEROOT.'library/data_arr/arrdata.php';
				$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables><table name='family_archive'><row><identity_number>".$identity_number."</identity_number>";
				//转换代码
				$family->family_address=$core->residence_address;
	            foreach ($dic['family_archive'] as $m=>$n)
	            {
	            	if (isset($family->$m) && isset($dic['family_archive'][$m]))
	            	{
	            		$family->$m=array_search_for_other($family->$m,$$n);
	            	}
	            }
	            if (isset($family->staff_id))
				{
					$family->staff_id=$this->get_doctor_number($family->staff_id);
				}
				if (isset($family->org_id))
				{
					$family->org_id=$this->set_org_id($family->org_id);
				}
	            $xml_string.=$family->toXML("",$exclude_array);
	            $xml_string.="</row></table>";
	            $xml_string.="</tables>";
				return $xml_string;
			}
			else 
			{
				return $this->_error_message_start."<return_code>2</return_code><return_string>你给定的用户没有家庭信息</return_string>".$this->_error_message_end;//你给定的用户没有家庭信息
			}
		}
		else 
		{
			return $this->_error_message_start."<return_code>2</return_code><return_string>没有你要查询的数据，请检查查询条件</return_string>".$this->_error_message_end;//错误，没有你要查询的数据，请检查查询条件
		}
	}
    /**
     * phsfamily::ws_select_single()
     * 
     * 根据机构ID 返回机构下所有家庭户主身份证号及家庭档案号
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
				//取得家庭信息
				$diabetes_core = new Tfamily_archive();
				$diabetes_core->query("select count(*) as cou from family_archive where family_archive.family_number in (select individual_core.family_number from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
				$diabetes_core->fetch();
				$number = $diabetes_core->cou;
				if($number>0)
				{
					$diabetes_core_select = new Tfamily_archive();
					$diabetes_core_select->query("select * from family_archive where family_archive.family_number in (select individual_core.family_number from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
					$response_str = '';
				    while ($diabetes_core_select->fetch())
				    {
				    	$response_str.='<row>';
				    	$ext_uuid = $diabetes_core_select->uuid;
			            //取得这个人的身份证号
			            $individual_core = new Tindividual_core();
			            $individual_core->whereAdd("uuid='$diabetes_core_select->householder_id'");
			            $individual_core->find(true);
			            $identity_number = $individual_core->identity_number;
                        $response_str.='<family_number>'.$individual_core->family_number.'</family_number>';
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
					return $this->_error_message_start."<return_code>2</return_code><return_string>机构号为".$org_id."的机构没有查询到家庭信息</return_string>".$this->_error_message_end;
				}
			}
			else 
			{
				return $this->_error_message_start."<return_code>2</return_code><return_string>机构号不存在</return_string>".$this->_error_message_end;
			}
		}
    }
}
?>