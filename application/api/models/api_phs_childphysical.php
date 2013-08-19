<?php
/**
 * @author mask
 * @todo 本类用于1岁以内健康检查接口功能的具体实现
 */
require_once __SITEROOT."application/api/models/api_phs_iha_comm.php";
class phschildphysical extends api_phs_comm
{
	private $_error_message_start;
	private $_error_message_end;
	public function __construct()
	{
		require_once __SITEROOT."library/Models/individual_core.php";//个人档案主表
		require_once __SITEROOT.'/library/custom/comm_function.php';//公有函数
		require_once __SITEROOT."library/Models/organization.php";//机构表
		require_once __SITEROOT."library/Models/staff_archive.php";//用户表
		require_once __SITEROOT."library/Models/child_physical.php";//1岁以内健康检查
		require_once __SITEROOT."application/api/models/api_phs_common.php";

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
		$status=1;
		$core=new Tindividual_core();
		if ($xml_string){
			//条件不为空时，解析查询条件
			$where_xml=new SimpleXMLElement($xml_string);
			//反查个人uuid
			$identity_number=$where_xml->identity_number;
			//月龄|radio|1=>满月,2=>3月龄,3=>6月龄,4=>8月龄
			$project=$where_xml->project;
			$project_array=array(1=>'满月',2=>'3月龄',3=>'6月龄',4=>'8月龄');
			$project=empty($project)?1:$project;
			$ext_uuid=$where_xml->ext_uuid;

			if ($ext_uuid==""){
				return $this->_error_message_start."<return_code>2</return_code><return_string>错误，请提供业务号ext_uuid</return_string>".$this->_error_message_end;
			}

			//月龄序号合法性
			if (!array_key_exists(intval($project),$project_array))	{
				return $this->_error_message_start."<return_code>2</return_code><return_string>错误，请提供正确的月龄project</return_string>".$this->_error_message_end;
			}
			//判断身份证号是否合法
			$identity_number_length=strlen($identity_number);
			if ($identity_number_length!=15 && $identity_number_length!=18){
				return $this->_error_message_start."<return_code>2</return_code><return_string>错误，身份证号只能是15或者18位</return_string>".$this->_error_message_end;
			}
			$core->whereAdd("individual_core.identity_number='".$identity_number."'");
		}
		else{
			return $this->_error_message_start."<return_code>2</return_code><return_string>请传递删除条件XML</return_string>".$this->_error_message_end;
		}
		$core->find(true);
		$core->free_statement();
		if ($core->uuid){
			//查询1岁以内健康检查的uuid
			$child_physical=new Tchild_physical();
			$child_physical->whereAdd("ext_uuid='$ext_uuid'");
			$child_physical->whereAdd("id='$core->uuid'");
			//月龄
			$child_physical->whereAdd("project='$project'");
			$child_physical->find(true);
			if($child_physical->uuid){
				$uuid=$child_physical->uuid;
				//删除1岁以内健康检查
				$child_physical_inner=new Tchild_physical();
				$child_physical_inner->whereAdd("uuid='$uuid'");
				$error=$child_physical_inner->showErrorMessage();
				if ($child_physical_inner->delete())
				{
					
					$org_id=$this->get_org_id($where_xml->org_id);
					//model_id：1个人档案2家庭档案3健康体检4高血压5糖尿病6重性精神分裂7孕产妇8儿童9婚前保健10预防接种
					//upload_token :1添加成功2修改成功3删除成功';
					$logs_array=array("ext_uuid"=>$ext_uuid,"org_id"=>$org_id,"model_id"=>8,"upload_time"=>time(),"upload_token"=>3 );
					$this->insert_api_logs($logs_array);
					$return_string='删除成功！';
					
				}else {
					$status=3;
					$return_string='删除失败！';
				}
				$child_physical_inner->free_statement();

				return $this->_error_message_start."<return_code>".$status."</return_code><return_string>$return_string</return_string>".$this->_error_message_end;
			}else{
				return $this->_error_message_start."<return_code>3</return_code><return_string>未能找到相关记录，删除失败</return_string><error_msg>$error</error_msg>".$this->_error_message_end;
			}
			$child_physical->free_statement();
		}else{
			return $this->_error_message_start."<return_code>2</return_code><return_string>错误，没有你要的数据，请检查条件</return_string>".$this->_error_message_end;
		}
	}
	/**
	 * 添加或者更新数据--1岁以内健康检查
	 *
	 * @param string $token
	 * @param string $xml_string
	 * @return mixed
	 */
	public function ws_update($token,$xml_string)
	{
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
		$status=1;//返回标志，默认为1
		$error_message_xml="";//用于存储失败返回的xml内容
		$success_message_xml="";//用于存储成功返回的xml内容
		if ($xml_string){
			$data_xml=new SimpleXMLElement($xml_string);
			//包含数据字典
			require_once __SITEROOT.'/library/data_arr/arrdata.php';
			//$dic['表名']=array("字段"=>"数据字典")
			$dic['child_physical']=array("complexion"=>"bb_complexion","skin"=>"bb_exception","bregma"=>"bb_bregma","cervical_mass"=>"bb_cervical_mass","eye"=>"bb_exception","ear"=>"bb_exception","oralcavity"=>"bb_exception","heart_lung"=>"bb_exception","abdomen"=>"bb_exception","umbilical_region"=>"bb_exception","umbilical_region"=>"bb_umbilical_region","limb"=>"bb_exception","gait"=>"bb_exception","rickets_symptom"=>"bb_rickets_symptom","rickets_signs"=>"bb_rickets_signs","gmzz"=>"bb_exception","developmental_assessment"=>"bb_developmental_assessment","between_and_vist_time"=>"bb_between_and_vist_time","referral_features"=>"bb_referral_features");
			//值中有'|'符号的
			$dic['special']=array("advising"=>"bb_advising");//定义添加还是修改状态标识
			$update_status=0;
			$update_num=0;//更新条数
			$insert_num=0;//插入条数
			//遍历表
			foreach ($data_xml as $tables){
				$table_name=$tables->attributes();//表名
				$class_name="T".$table_name;//类名
				//遍历行
				foreach ($tables as $rows){

					//条件不为空时，解析查询条件

					$identity_number=$rows->identity_number;
					$ext_uuid=$rows->ext_uuid;
					$project=$rows->project?intval($rows->project):1;

					//判断身份证号是否合法
					$identity_number_length=strlen($identity_number);
					if ($identity_number_length!=15 && $identity_number_length!=18)	{
						return $this->_error_message_start."<return_code>2</return_code><return_string>身份证号码不合法</return_string>".$this->_error_message_end;
					}
					//根据身份证查询此用户是否建档
					$core=new Tindividual_core();
					$core->whereAdd("individual_core.identity_number='".$identity_number."'");
					if (!$core->count("uuid")){
						return $this->_error_message_start."<return_code>2</return_code><error_transaction><row><org_id>".$org_id."</org_id><identity_number>".$identity_number."</identity_number><ext_uuid>".$ext_uuid."</ext_uuid></row></error_transaction><return_string>身份证号为：".$data_xml->identity_number."的用户未建档，请先调用建档接口</return_string>".$this->_error_message_end;
					}else{
						$core->find(true);
						$id=$core->uuid;//个人档案号
						if(!$id){
							return $this->_error_message_start."<return_code>2</return_code><error_transaction><row><org_id>".$org_id."</org_id><identity_number>".$identity_number."</identity_number><ext_uuid>".$ext_uuid."</ext_uuid></row></error_transaction><return_string>此用户的档案有错误，没有个人档案序号uuid值</return_string>".$this->_error_message_end;
						}
					}
					$org_id=$this->get_org_id($rows->org_id);
					if(!$org_id){
						return $this->_error_message_start."<return_code>2</return_code><error_transaction><row><org_id>".$rows->org_id."</org_id><identity_number>".$identity_number."</identity_number><ext_uuid>".$ext_uuid."</ext_uuid></row></error_transaction><return_string>机构ID不存在</return_string>".$this->_error_message_end;
					}

					//判定ext_uuid不能为空
					if ($ext_uuid==''){
						$status=3;
						$error_message_xml="<row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row>";
						continue;
					}
					//月龄不能为空，
					$project_array=array(1=>'满月',2=>'3月龄',3=>'6月龄',4=>'8月龄');

					if(array_key_exists($project,$project_array)){
						//-------start查询更新标志--------
						$table_object_=new $class_name();
						$table_object_->whereAdd("id='$id'");
						$table_object_->whereAdd("org_id='$org_id'");
						//$table_object_->whereAdd("ext_uuid='$ext_uuid'");
						$table_object_->whereAdd("project='$project'");
						if ($table_object_->count()){
							$update_status=1;
							$table_object_->find(true);
							$uuid_=$table_object_->uuid;
						}else{
							$update_status=0;
						}
					
						$table_object_->free_statement();
						//-------end查询更新标志--------

					}else{
						$status=3;
						$error_message_xml="<row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row>";
						continue;
					}


					$table_object=new $class_name();
					//遍历字段
					foreach ($rows as $colums){
						//给字段赋值
						$colums_name=$colums->getname();//字段名
						$colums_value=$rows->$colums_name;

						//排除身份证号字段
						if ($colums_name!="identity_number"){
							$table_object->$colums_name=$colums_value;//赋值
							//特殊处理有'|'字符的数据
							if(in_array($colums_name,$dic['special']))
							{
								if (strpos($colums_value,'|')===false){
									//有|才做转换
									$temp=array();
									$temp=explode('|',$colums_value);
									foreach ($temp as $k=>$v){

										if ($colums_value!="" && $table_object->$colums_name!="#^&*^&*#" && isset($dic["special"]["$colums_name"]) && isset($table_object->$colums_name))
										{
											$n=$dic["special"]["$colums_name"];
											$temp[$k]=array_code_change($v,$$n);
										}
									}
									$table_object->$colums_name=implode('|',$temp);
								}
							}else{
								if (isset($dic["$table_name"]) && !empty($dic["$table_name"]) && $colums_value!="" && $table_object->$colums_name!="#^&*^&*#" && isset($dic["$table_name"]["$colums_name"]) && isset($table_object->$colums_name))
								{
									$n=$dic["$table_name"]["$colums_name"];
									$table_object->$colums_name=array_code_change($colums_value,$$n);
								}
							}

						}
					}

					if (isset($table_object->staff_id)){
						$table_object->staff_id=$this->set_doctor_number($table_object->staff_id);//处理医生

					}

					if (isset($table_object->org_id)){
						$table_object->org_id=$this->get_org_id($table_object->org_id);//处理机构
					}
					//$table_object->debugLevel(3);
					//根据标致来确定是修改还是插入
					if ($update_status){
						$table_object->whereAdd("id='$id'");
						$table_object->whereAdd("org_id='$org_id'");
						//$table_object->whereAdd("ext_uuid='$ext_uuid'");
						$table_object->whereAdd("project='$project'");
						$update_except_array=array("uuid","id","org_id","staff_id","created");//更新时不能更新的字段数组
						foreach ($update_except_array as $v){
							if (isset($table_object->$v)){
								unset($table_object->$v);
							}
						}
						$error=$table_object->showErrorMessage();
						if ($table_object->update()){
							//接口日志-修改接口记录
							//$org_id=$this->get_org_id($where_xml->org_id);
							//model_id：1个人档案2家庭档案3健康体检4高血压5糖尿病6重性精神分裂7孕产妇8儿童9婚前保健10预防接种
							//upload_token :1添加成功2修改成功3删除成功';
							$logs_array=array("ext_uuid"=>$ext_uuid,"org_id"=>$org_id,"model_id"=>8,"upload_time"=>time(),"upload_token"=>2 );
							$this->insert_api_logs($logs_array);
							
							$update_num++;
							$success_message_xml="<row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>$error</error_msg>";
						}
						else{
							$status=3;
							$error_message_xml="<row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>$error</error_msg>";
							
						}
						$table_object->free_statement();
					}else{
						$table_object->org_id=$org_id;
						$table_object->id=$id;
						//插入数据时需要生成uuid
						$uuid_=$table_object->uuid=uniqid(strtoupper(substr($table_name,0,1))."_",true);
						$error=$table_object->showErrorMessage();
						if ($table_object->insert()){
							
							//接口日志-插入接口记录
							//$org_id=$this->get_org_id($where_xml->org_id);
							//model_id：1个人档案2家庭档案3健康体检4高血压5糖尿病6重性精神分裂7孕产妇8儿童9婚前保健10预防接种
							//upload_token :1添加成功2修改成功3删除成功';
							$logs_array=array("ext_uuid"=>$ext_uuid,"org_id"=>$org_id,"model_id"=>8,"upload_time"=>time(),"upload_token"=>1 );
							$this->insert_api_logs($logs_array);
							
							$insert_num++;
							$success_message_xml.="<row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>$error</error_msg>";
						}else{
							$status=3;
							$error_message_xml.="<row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row><error_msg>$error</error_msg>";
						}
						$table_object->free_statement();
					}

				}
			}
		}else{
			return $this->_error_message_start."<return_code>2</return_code><return_string>未传递任何数据xml</return_string>".$this->_error_message_end;
		}
		if ($status==3){
			return $this->_error_message_start."<return_code>3</return_code><success_transaction>".$success_message_xml."</success_transaction><error_transaction>".$error_message_xml."</error_transaction><return_string>数据未能成功更新，详情请看返回XML内容</return_string>".$this->_error_message_end;
		}else{
			return $this->_error_message_start."<return_code>1</return_code><return_string>成功写入数据!(插入{$insert_num}条，修改{$update_num}条)</return_string>".$this->_error_message_end;
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
		$exclude_array=array("uuid","id");//排除部分不必要的字段在结果里
		$core=new Tindividual_core();
		if ($xml_string)
		{
			//条件不为空时，解析查询条件
			$where_xml=new SimpleXMLElement($xml_string);
			//反查个人uuid
			$identity_number=$where_xml->identity_number;
			//月龄|radio|1=>满月,2=>3月龄,3=>6月龄,4=>8月龄
			$project=$where_xml->project;
			$project=empty($project)?1:$project;
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
		}else{
			return $this->_error_message_start."<return_code>2</return_code><return_string>请传递查询条件XML</return_string>".$this->_error_message_end;//请传递查询条件XML
		}
		$core->find(true);
		$core->free_statement();
		//$dic['表名']=array("字段"=>"数据字典")
		$dic['child_physical']=array("complexion"=>"bb_complexion","skin"=>"bb_exception","bregma"=>"bb_bregma","cervical_mass"=>"bb_cervical_mass","eye"=>"bb_exception","ear"=>"bb_exception","oralcavity"=>"bb_exception","heart_lung"=>"bb_exception","abdomen"=>"bb_exception","umbilical_region"=>"bb_exception","umbilical_region"=>"bb_umbilical_region","limb"=>"bb_exception","gait"=>"bb_exception","rickets_symptom"=>"bb_rickets_symptom","rickets_signs"=>"bb_rickets_signs","gmzz"=>"bb_exception","developmental_assessment"=>"bb_developmental_assessment","between_and_vist_time"=>"bb_between_and_vist_time","referral_features"=>"bb_referral_features");
		//值中有'|'符号的
		$dic['special']=array("advising"=>"bb_advising");
		if ($core->uuid){

			$child_physical 		=	new Tchild_physical();

			//$child_physical->whereAdd("ext_uuid='$ext_uuid'");

			$match_array = preg_match_all('~\w+\.\w+~i',$ext_uuid,$my_array);//判断是中联数据还是平台数据
			$tag=true;
			if(empty($my_array[0][0]))
			{
			     $tag=true;
                 $child_physical->whereAdd("ext_uuid='$ext_uuid'");
			}
			else 
			{
			     $tag=false;
                 $child_physical->whereAdd("uuid='$ext_uuid'");
			}
			$child_physical->whereAdd("id='$core->uuid'");
			//月龄
			//$child_physical->whereAdd("project='$project'");
			if (!$child_physical->count("uuid"))
			{
				return $this->_error_message_start."<return_code>2</return_code><return_string>未能查找到关于身份证号：".$identity_number."，业务ID为".$ext_uuid."的相关1岁以内健康检查记录</return_string>".$this->_error_message_end;//未能查找到关于身份证号：".$identity_number."，业务ID为".$ext_uuid."的相关1岁以内健康检查记录
			}
			$error=$child_physical->showErrorMessage();
			$child_physical->find(true);
			require_once __SITEROOT.'/library/data_arr/arrdata.php';
			$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables><table name='child_physical'><row><identity_number>".$identity_number."</identity_number>";
			//转换代码

			foreach ($dic['child_physical'] as $m=>$n)
			{
				if (isset($child_physical->$m) && isset($dic['child_physical'][$m]))
				{
					$child_physical->$m=array_search_for_other($child_physical->$m,$$n);
				}
			}
			//单独处理|
			foreach ($dic['special'] as $m=>$n)
			{
				if (isset($child_physical->$m) && isset($dic['special'][$m]))
				{
					if (strpos($child_physical->$m,'|')===false)
					{
						//有|才做转换
						$temp=$temp_implode=array();
						$temp=explode('|',$colums_value);
						foreach ($temp as $k=>$v)
						{
							if ($v!="")
							{
								$temp_implode[$k]=array_code_change($v,$$n);
							}
						}
						$child_physical->$m=implode('|',$temp_implode);
					}
				}
			}
			if (isset($child_physical->staff_id))
			{
				$child_physical->staff_id=$this->get_doctor_number($child_physical->staff_id);
			}
			if (isset($child_physical->org_id))
			{
				$child_physical->org_id=$this->set_org_id($child_physical->org_id);
			}
			if(!$tag)
            {
                //对ext_uuid重新赋值
                $child_physical->ext_uuid=$ext_uuid;
            }
			$xml_string.=$child_physical->toXML("",$exclude_array);

			$xml_string.="</row>";
			//$xml_string.="<error_msg>$error</error_msg>";
			$xml_string.="</table>";
			$xml_string.="</tables>";
			return $xml_string;
		}else{
			return $this->_error_message_start."<return_code>2</return_code><return_string>没有你要查询的数据，请检查查询条件</return_string>".$this->_error_message_end;//错误，没有你要查询的数据，请检查查询条件
		}
	}
	
		    /**
     * 取某个机构下边的所有人的uuid 身份证号 和 org_id
     * (2013年5月8号新增 为了让中联能取到平台中的数据  业务号为平台数据的uuid 为了调用下边的ws_select_single接口)
     */
    function ws_select_all($token,$xml_string)
    {
    	require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/child_physical.php";
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
				//
				$diabetes_core = new Tchild_physical();
				$diabetes_core->query("select count(*) as cou from child_physical where child_physical.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
				$diabetes_core->fetch();
				$number = $diabetes_core->cou;
				if($number>0)
				{
					$diabetes_core_select = new Tchild_physical();
					$diabetes_core_select->query("select * from child_physical where child_physical.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
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
					return $xmlhead."<return_code>2</return_code><return_string>机构号为".$org_id."的机构没有查询到随访病人</return_string>".$xmlend;
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
     * (2013年5月10号新增 为了让中联能取到平台中的数据  业务号为平台数据的uuid 为了调用下边的ws_select_single接口)
     */
    function ws_select_persons($token,$xml_string)
    {
    	require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/child_physical.php";
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
		//取得这个身份证和机构联查得到的所有随访数据
		$diabetes_core = new Tchild_physical();
		$diabetes_core->query("select count(*) as cou from child_physical where child_physical.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number' and individual_core.identity_number='$identity_number')");
		$diabetes_core->fetch();
		$count = $diabetes_core->cou;
		if($count>0)
		{   
			$response_str = '';
			$diabetes_core_select = new Tchild_physical();
			$diabetes_core_select->query("select * from child_physical where child_physical.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number' and individual_core.identity_number='$identity_number')");
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
			return $xmlhead."<return_code>2</return_code><return_string>身份证为".$identity_number."，机构号为".$org_id."的数据未查询到！</return_string>".$xmlend;
		}
    }
	
}
?>