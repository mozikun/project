<?php
/**
 * @author mask
 * @todo 婚前保健
 * 
 * 婚检主表 premarital_examination
 * 体格检查 pe_physical
 * 男性 pe_second_sex_male
 * 女性 pe_second_sex_female
 * 实验室及特殊检查 pe_lab_examination
 * 婚前卫生咨询 pe_health_advisory
 */
require_once __SITEROOT."application/api/models/api_phs_iha_comm.php";
class premarital extends api_phs_comm
{
	private $_error_message_start;
	private $_error_message_end;
	public function __construct()
	{
		require_once __SITEROOT."library/Models/individual_core.php";//个人档案主表
		require_once __SITEROOT.'/library/custom/comm_function.php';//公有函数
		require_once __SITEROOT."library/Models/organization.php";//机构表
		require_once __SITEROOT."library/Models/staff_archive.php";//用户表
		require_once __SITEROOT."application/api/models/api_phs_common.php";
		require_once __SITEROOT."library/Models/premarital_examination.php";//婚检主表
		require_once __SITEROOT."library/Models/pe_physical.php";//体格检查
		require_once __SITEROOT."library/Models/pe_second_sex_male.php";//男性
		require_once __SITEROOT."library/Models/pe_second_sex_female.php";//女性
		require_once __SITEROOT."library/Models/pe_lab_examination.php";//实验室及特殊检查
		require_once __SITEROOT."library/Models/pe_health_advisory.php";//婚前卫生咨询

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
			//查询婚检主表的uuid
			$premarital_examination=new Tpremarital_examination();
			$premarital_examination->whereAdd("ext_uuid='$ext_uuid'");
			$premarital_examination->whereAdd("id='$core->uuid'");
			$premarital_examination->find(true);
			if($premarital_examination->uuid)
			{
				$uuid=$premarital_examination->uuid;
				//删除婚检主表
				$premarital_examination_inner=new Tpremarital_examination();
				$premarital_examination_inner->whereAdd("uuid='$uuid'");
				$error=$premarital_examination_inner->showErrorMessage();
				if ($premarital_examination_inner->delete())
				{
					//删除体格检查
					$pe_physical=new Tpe_physical();
					$pe_physical->whereAdd("uuid='$uuid'");
					$pe_physical->delete();
					//男性
					$pe_second_sex_male=new Tpe_second_sex_male();
					$pe_second_sex_male->whereAdd("uuid='$uuid'");
					$pe_second_sex_male->delete();
					//女性
					$pe_second_sex_female=new Tpe_second_sex_female();
					$pe_second_sex_female->whereAdd("uuid='$uuid'");
					$pe_second_sex_female->delete();
					//实验室及特殊检查
					$pe_lab_examination=new Tpe_lab_examination();
					$pe_lab_examination->whereAdd("uuid='$uuid'");
					$pe_lab_examination->delete();
					//婚前卫生咨询
					$pe_health_advisory=new Tpe_health_advisory();
					$pe_health_advisory->whereAdd("uuid='$uuid'");
					$pe_health_advisory->delete();
					$return_string='删除成功！';
				}else {
					$status=3;
					$return_string='删除失败！';
				}
				$child_physical_inner->free_statement();

				return $this->_error_message_start."<return_code>".$status."</return_code><return_string>$return_string</return_string><error_msg>$error</error_msg>".$this->_error_message_end;
			}
			else
			{
				return $this->_error_message_start."<return_code>3</return_code><return_string>未能找到相关记录，删除失败</return_string><error_msg>$error</error_msg>".$this->_error_message_end;
			}
			$premarital_examination->free_statement();
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
		if ($xml_string)
		{
			//条件不为空时，解析查询条件
			$data_xml=new SimpleXMLElement($xml_string);

			//定义添加还是修改状态标识
			$update_status=0;
			$update_num=0;//更新条数
			$insert_num=0;//插入条数
			//遍历表
			foreach ($data_xml as $tables)
			{
				$table_name=$tables->attributes();//表名
				$class_name="T".$table_name;//类名
				//遍历行
				foreach ($tables as $rows){
					$identity_number=$rows->identity_number;//身份证
					$ext_uuid=$rows->ext_uuid;//第三方id

					//判断身份证号是否合法
					$identity_number_length=strlen($identity_number);
					if($identity_number_length==0){
						//跳过身份证为空的情况
						continue;
					}
					if ($identity_number_length!=15 && $identity_number_length!=18)
					{
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
					//-------start查询更新标志--------
					$table_object=new $class_name();
					$table_object->whereAdd("id='$id'");
					$table_object->whereAdd("org_id='$org_id'");
					$table_object->whereAdd("ext_uuid='$ext_uuid'");
					//$table_object->debug(2);
					if ($table_object->count()){
						$update_status=1;
						$table_object->find(true);
						$uuid_=$table_object->uuid;
					}else{
						$update_status=0;
					}
					$table_object->free_statement();
					//echo "__{$update_status}__";
					//-------end查询更新标志--------
					$table_object=new $class_name();
					//$table_object->debug(2);
					//遍历字段
					foreach ($rows as $colums){
						//给字段赋值
						$colums_name=$colums->getname();//字段名
						$colums_value=$rows->$colums_name;
						//判定ext_uuid不能为空
						if ($colums_name=="ext_uuid" && $colums_value==''){
							$status=3;
							$error_message_xml="<row><org_id>".$rows->org_id."</org_id><identity_number>".$rows->identity_number."</identity_number><ext_uuid>".$rows->ext_uuid."</ext_uuid></row>";
							continue;
						}

						//排除身份证号字段
						if ($colums_name!="identity_number"){
							$table_object->$colums_name=$colums_value;//赋值


						}


					}
					if (isset($table_object->staff_id)){
						$table_object->staff_id=$this->set_doctor_number($table_object->staff_id);//处理医生
					}
					if (isset($table_object->org_id)){
						$table_object->org_id=$this->get_org_id($table_object->org_id);//处理医生
					}
					//根据标致来确定是修改还是插入
					if ($update_status){
						$table_object->whereAdd("id='$id'");
						$table_object->whereAdd("org_id='$org_id'");
						$table_object->whereAdd("ext_uuid='$ext_uuid'");
						$update_except_array=array("uuid","id","org_id","staff_id","created");//更新时不能更新的字段数组
						foreach ($update_except_array as $v){
							if (isset($table_object->$v)){
								unset($table_object->$v);
							}
						}
						$error=$table_object->showErrorMessage();
						if ($table_object->update()){
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
						$uuid_=$table_object->uuid=uniqid(strtoupper(substr($table_name,0,1))."_");
						$error=$table_object->showErrorMessage();
						if ($table_object->insert()){

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
		$dic['premarital_examination']=array();
		//值中有'|'符号的
		$dic['special']=array();
		if ($core->uuid){
			//性别
			$sex=$core->sex;
			$premarital_examination 		=	new Tpremarital_examination();

			//$premarital_examination->whereAdd("ext_uuid='$ext_uuid'");
			$match_array = preg_match_all('~\w+\.\w+~i',$ext_uuid,$my_array);//判断是中联数据还是平台数据
			$tag=true;
			if(empty($my_array[0][0]))
			{
				$tag=true;
				$premarital_examination->whereAdd("ext_uuid='$ext_uuid'");
			}
			else
			{
				$tag=false;
				$premarital_examination->whereAdd("uuid='$ext_uuid'");
			}
			$premarital_examination->whereAdd("id='$core->uuid'");
			$error=$premarital_examination->showErrorMessage();
			if (!$premarital_examination->count("uuid"))
			{
				return $this->_error_message_start."<return_code>2</return_code><return_string>未能查找到关于身份证号：".$identity_number."，业务ID为".$ext_uuid."的相关婚前保健记录</return_string>".$this->_error_message_end;//未能查找到关于身份证号：".$identity_number."，业务ID为".$ext_uuid."的相关婚前保健记录
			}

			$premarital_examination->find(true);
			require_once __SITEROOT.'/library/data_arr/arrdata.php';
			$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables><table name='premarital_examination'><row><identity_number>".$identity_number."</identity_number>";

			if (isset($premarital_examination->staff_id))
			{
				$premarital_examination->staff_id=$this->get_doctor_number($premarital_examination->staff_id);
			}
			if (isset($premarital_examination->org_id))
			{
				$premarital_examination->org_id=$this->set_org_id($premarital_examination->org_id);
			}
			if(!$tag)
			{
				//对ext_uuid重新赋值
				$premarital_examination->ext_uuid=$ext_uuid;
			}
			$xml_string.=$premarital_examination->toXML("",$exclude_array);
			$xml_string.="</row>";
			$xml_string.="</table>";

			//-- * 体格检查
			$pe_physical 		=	new Tpe_physical();
			$match_array = preg_match_all('~\w+\.\w+~i',$ext_uuid,$my_array);//判断是中联数据还是平台数据
			$tag=true;
			if(empty($my_array[0][0]))
			{
				$tag=true;
				$pe_physical->whereAdd("ext_uuid='$ext_uuid'");
			}
			else
			{
				$tag=false;
				$pe_physical->whereAdd("uuid='$ext_uuid'");
			}
			//$pe_physical->whereAdd("ext_uuid='$ext_uuid'");
			$pe_physical->whereAdd("id='$core->uuid'");
			$pe_physical->find(true);
			$xml_string.="<table name='pe_physical'><row>";


			if (isset($premarital_examination->staff_id))
			{
				$pe_physical->staff_id=$this->get_doctor_number($pe_physical->staff_id);
			}
			if (isset($pe_physical->org_id))
			{
				$pe_physical->org_id=$this->set_org_id($pe_physical->org_id);
			}
			if(!$tag)
			{
				//对ext_uuid重新赋值
				$pe_physical->ext_uuid=$ext_uuid;
			}
			$xml_string.=$pe_physical->toXML("",$exclude_array);
			$xml_string.="</row>";
			$xml_string.="</table>";


			if($sex==1){
				//----男

				$pe_second_sex_male 		=	new Tpe_second_sex_male();
				$match_array = preg_match_all('~\w+\.\w+~i',$ext_uuid,$my_array);//判断是中联数据还是平台数据
				$tag=true;
				if(empty($my_array[0][0]))
				{
					$tag=true;
					$pe_second_sex_male->whereAdd("ext_uuid='$ext_uuid'");
				}
				else
				{
					$tag=false;
					$pe_second_sex_male->whereAdd("uuid='$ext_uuid'");
				}
				//$pe_second_sex_male->whereAdd("ext_uuid='$ext_uuid'");
				$pe_second_sex_male->whereAdd("id='$core->uuid'");
				$pe_second_sex_male->find(true);
				$xml_string.="<table name='pe_second_sex_male'><row>";


				if (isset($pe_second_sex_male->staff_id))
				{
					$pe_second_sex_male->staff_id=$this->get_doctor_number($pe_second_sex_male->staff_id);
				}
				if (isset($pe_second_sex_male->org_id))
				{
					$pe_second_sex_male->org_id=$this->set_org_id($pe_second_sex_male->org_id);
				}
				if(!$tag)
				{
					//对ext_uuid重新赋值
					$pe_second_sex_male->ext_uuid=$ext_uuid;
				}
				$xml_string.=$pe_second_sex_male->toXML("",$exclude_array);
				$xml_string.="</row>";
				$xml_string.="</table>";
			}elseif ($sex==2){
				//-----女

				$pe_second_sex_female 		=	new Tpe_second_sex_female();
				$match_array = preg_match_all('~\w+\.\w+~i',$ext_uuid,$my_array);//判断是中联数据还是平台数据
				$tag=true;
				if(empty($my_array[0][0]))
				{
					$tag=true;
					$pe_second_sex_female->whereAdd("ext_uuid='$ext_uuid'");
				}
				else
				{
					$tag=false;
					$pe_second_sex_female->whereAdd("uuid='$ext_uuid'");
				}
				//$pe_second_sex_female->whereAdd("ext_uuid='$ext_uuid'");
				$pe_second_sex_female->whereAdd("id='$core->uuid'");
				$pe_second_sex_female->find(true);
				$xml_string.="<table name='pe_second_sex_female'><row>";


				if (isset($pe_second_sex_female->staff_id))
				{
					$pe_second_sex_female->staff_id=$this->get_doctor_number($pe_second_sex_female->staff_id);
				}
				if (isset($pe_second_sex_female->org_id))
				{
					$pe_second_sex_female->org_id=$this->set_org_id($pe_second_sex_female->org_id);
				}
				if(!$tag)
				{
					//对ext_uuid重新赋值
					$pe_second_sex_female->ext_uuid=$ext_uuid;
				}
				$xml_string.=$pe_second_sex_female->toXML("",$exclude_array);
				$xml_string.="</row>";
				$xml_string.="</table>";
			}

			//-----实验室及特殊检查

			$pe_lab_examination 		=	new Tpe_lab_examination();
			$match_array = preg_match_all('~\w+\.\w+~i',$ext_uuid,$my_array);//判断是中联数据还是平台数据
			$tag=true;
			if(empty($my_array[0][0]))
			{
				$tag=true;
				$pe_lab_examination->whereAdd("ext_uuid='$ext_uuid'");
			}
			else
			{
				$tag=false;
				$pe_lab_examination->whereAdd("uuid='$ext_uuid'");
			}
			//$pe_lab_examination->whereAdd("ext_uuid='$ext_uuid'");
			$pe_lab_examination->whereAdd("id='$core->uuid'");
			$pe_lab_examination->find(true);
			$xml_string.="<table name='pe_lab_examination'><row>";


			if (isset($pe_lab_examination->staff_id))
			{
				$pe_lab_examination->staff_id=$this->get_doctor_number($pe_lab_examination->staff_id);
			}
			if (isset($pe_lab_examination->org_id))
			{
				$pe_lab_examination->org_id=$this->set_org_id($pe_lab_examination->org_id);
			}
			if(!$tag)
			{
				//对ext_uuid重新赋值
				$pe_lab_examination->ext_uuid=$ext_uuid;
			}
			$xml_string.=$pe_lab_examination->toXML("",$exclude_array);
			$xml_string.="</row>";
			$xml_string.="</table>";

			//-----婚前卫生咨询

			$pe_health_advisory 		=	new Tpe_health_advisory();
			$match_array = preg_match_all('~\w+\.\w+~i',$ext_uuid,$my_array);//判断是中联数据还是平台数据
			$tag=true;
			if(empty($my_array[0][0]))
			{
				$tag=true;
				$pe_health_advisory->whereAdd("ext_uuid='$ext_uuid'");
			}
			else
			{
				$tag=false;
				$pe_health_advisory->whereAdd("uuid='$ext_uuid'");
			}
			//$pe_health_advisory->whereAdd("ext_uuid='$ext_uuid'");
			$pe_health_advisory->whereAdd("id='$core->uuid'");
			$pe_health_advisory->find(true);
			$xml_string.="<table name='pe_health_advisory'><row>";


			if (isset($pe_health_advisory->staff_id))
			{
				$pe_health_advisory->staff_id=$this->get_doctor_number($pe_health_advisory->staff_id);
			}
			if (isset($pe_health_advisory->org_id))
			{
				$pe_health_advisory->org_id=$this->set_org_id($pe_health_advisory->org_id);
			}
			if(!$tag)
			{
				//对ext_uuid重新赋值
				$pe_health_advisory->ext_uuid=$ext_uuid;
			}
			$xml_string.=$pe_health_advisory->toXML("",$exclude_array);
			$xml_string.="</row>";
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
		require_once __SITEROOT."library/Models/premarital_examination.php";
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
				$diabetes_core = new Tpremarital_examination();
				$diabetes_core->query("select count(*) as cou from premarital_examination where premarital_examination.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
				$diabetes_core->fetch();
				$number = $diabetes_core->cou;
				if($number>0)
				{
					$diabetes_core_select = new Tpremarital_examination();
					$diabetes_core_select->query("select * from premarital_examination where premarital_examination.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
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
		require_once __SITEROOT."library/Models/premarital_examination.php";
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
		$diabetes_core = new Tpremarital_examination();
		$diabetes_core->query("select count(*) as cou from premarital_examination where premarital_examination.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number' and individual_core.identity_number='$identity_number')");
		$diabetes_core->fetch();
		$count = $diabetes_core->cou;
		if($count>0)
		{
			$response_str = '';
			$diabetes_core_select = new Tpremarital_examination();
			$diabetes_core_select->query("select * from premarital_examination where premarital_examination.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number' and individual_core.identity_number='$identity_number')");
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