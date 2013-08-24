<?php
/**
 * @author mask
 * @todo 查询所用用户返回XML接口
 */
require_once __SITEROOT."application/api/models/api_phs_iha_comm.php";
class phsstaff extends api_phs_comm
{
	private $_error_message_start;
	private $_error_message_end;
	private $role_id;
	public function __construct()
	{

		require_once __SITEROOT.'/library/custom/comm_function.php';//公有函数
		require_once __SITEROOT."library/Models/organization.php";//机构表
		require_once __SITEROOT."library/Models/staff_core.php";//用户主表
		require_once __SITEROOT."library/Models/staff_archive.php";//用户表
		require_once __SITEROOT."application/api/models/api_phs_common.php";
		$this->_error_message_start="<?xml version='1.0' encoding='UTF-8'?><message>";
		$this->_error_message_end="</message>";
		$this->role_id='14c29a32c28c09';
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
		$core=new Tstaff_archive();
		if ($xml_string)
		{
			//条件不为空时，解析查询条件
			$where_xml=new SimpleXMLElement($xml_string);
			//反查个人uuid
			$identity_number=$where_xml->identity_card_number;
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
			$core->whereAdd("identity_card_number='".$identity_number."'");
			$core->whereAdd("ext_uuid='".$ext_uuid."'");
			$core->whereAdd("role_id='".$this->role_id."'");
		}
		else
		{
			return $this->_error_message_start."<return_code>2</return_code><return_string>请传递删除条件XML</return_string>".$this->_error_message_end;
		}
		$core->find(true);
		$core->free_statement();
		if ($core->user_id)
		{

			$staff_core=new Tstaff_core();
			$staff_core->whereAdd("id='$core->user_id'");
			$staff_core->startTransaction();

			
			if($staff_core->delete()){
				$staff_archive=new Tstaff_archive();
				$staff_archive->whereAdd("user_id='$core->user_id'");

				if($staff_archive->delete()){
					$return_string='删除成功！';
					$staff_core->commit();
				}else{
					$status=3;
					$return_string='删除失败！';
					$staff_core->rollBack();
				}
				
			}else {
				$status=3;
				$return_string='删除失败！';
				
			}


			return $this->_error_message_start."<return_code>".$status."</return_code><return_string>$return_string</return_string>".$this->_error_message_end;


			$staff_core->free_statement();
		}
		else
		{
			return $this->_error_message_start."<return_code>2</return_code><return_string>错误，没有你要的数据，请检查条件</return_string>".$this->_error_message_end;
		}
	}

	/**
	 * 查询单条数据
	 *
	 * @param string $token
	 * @param string $xml_string
	 */
	public function ws_select($token,$xml_string)
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
		$exclude_array=array("id");//排除部分不必要的字段在结果里
		//条件不为空时，解析查询条件
		$where_xml=new SimpleXMLElement($xml_string);
		//标准机构号
		$stand_org_id=$where_xml->org_id;
		//内部机构号
		$org_id=$this->get_org_id($stand_org_id);

		if(empty($org_id)){
			return $this->_error_message_start."<return_code>2</return_code><return_string>错误，标准机构码不正确org_id</return_string>".$this->_error_message_end;//错误，请提供业务号ext_uuid
		}else {
			$staff_core=new Tstaff_core();
			$staff_archive=new Tstaff_archive();
			$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
			$staff_core->whereAdd("org_id='$org_id'");
			$staff_core->whereAdd("role_id='".$this->role_id."'");
			//$staff_core->debug(3);
			if($staff_core->count()<1){
				return $this->_error_message_start."<return_code>2</return_code><return_string>没有机构对应的医生数据！</return_string>".$this->_error_message_end;//没有数据
			}else {
				$staff_core->find();
				$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables><table name='staff_archive'>";
				while ($staff_core->fetch()) {
					$xml_string.="<row>";
					$xml_string.=$staff_archive->toXML("",$exclude_array);
					$xml_string.="</row>";

				}
				$xml_string.="</table>";
				$xml_string.="</tables>";
				//echo $xml_string;
				return $xml_string;
			}

		}

	}

	/**
	 * 添加或者更新数据--社区、乡镇卫生院医生注册
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
			$user_id='';//插入主表的用户id
			$num=0;//写入记录数
			$action_token=0;//是插入还是更新标致
			//遍历表
			foreach ($data_xml as $tables)
			{
				$table_name=$tables->attributes();//表名
				$class_name="T".$table_name;//类名
				
				//遍历行
				foreach ($tables as $rows){

					if($table_name=='staff_core'){
						//业务号
						$ext_uuid			= $rows->ext_uuid;
						//登录显示名
						$name_login			= $rows->name_login;
						//密码
						$passwd				= $rows->passwd;
						//个人标准码
						$standard_code		= $rows->standard_code;
						//身份证号
						$identity_number_core= $rows->identity_card_number;
                                                                                                                   //中联内部id号
                                                                                                                   $zl_staff_code = $rows->zl_staff_code;
						$identity_number_length=strlen($identity_number_core);
						if ($identity_number_length!=15 && $identity_number_length!=18)
						{
							return $this->_error_message_start."<return_code>2</return_code><return_string>身份证号码不合法$identity_number_length</return_string>".$this->_error_message_end;
						}


						if(!$ext_uuid){
							return $this->_error_message_start."<return_code>2</return_code><error_transaction><row><org_id>".$rows->org_id."</org_id><ext_uuid>".$ext_uuid."</ext_uuid></row></error_transaction><return_string>业务id不能为空</return_string>".$this->_error_message_end;
						}
						if(!$name_login){
							return $this->_error_message_start."<return_code>2</return_code><error_transaction><row><org_id>".$rows->org_id."</org_id><ext_uuid>".$ext_uuid."</ext_uuid><name_login>".$name_login."</name_login></row></error_transaction><return_string>登录名不能为空</return_string>".$this->_error_message_end;
						}
						if(!$passwd){
							return $this->_error_message_start."<return_code>2</return_code><error_transaction><row><org_id>".$rows->org_id."</org_id><ext_uuid>".$ext_uuid."</ext_uuid><passwd>".$passwd."</passwd></row></error_transaction><return_string>密码不能为空</return_string>".$this->_error_message_end;
						}
						if(!$standard_code){
							return $this->_error_message_start."<return_code>2</return_code><error_transaction><row><org_id>".$rows->org_id."</org_id><ext_uuid>".$ext_uuid."</ext_uuid><standard_code>".$standard_code."</standard_code></row></error_transaction><return_string>个人标准代码不能为空</return_string>".$this->_error_message_end;
						}
						//机构array
						$org_array			= $this->get_org_info($rows->org_id);
						if(empty($org_array)){
							return $this->_error_message_start."<return_code>2</return_code><error_transaction><row><org_id>".$rows->org_id."</org_id><ext_uuid>".$ext_uuid."</ext_uuid></row></error_transaction><return_string>机构ID不存在</return_string>".$this->_error_message_end;
						}

						$region_id			= $org_array['region_id'];
						$org_id				= $org_array['org_id'];
						$region_path		= $org_array['region_path'];
						//只能是医生角色
						$role_id			= $this->role_id;
						$staff_archive	=new Tstaff_archive();
						$staff_archive->whereAdd("identity_card_number='$identity_number_core'");
						$staff_archive->find(true);
						$identity_number=$staff_archive->identity_card_number;//身份证
						$ext_uuid_self	=$staff_archive->ext_uuid;
						$staff_archive->free_statement();

						if($identity_number && empty($ext_uuid_self)){
							return $this->_error_message_start."<return_code>2</return_code><error_transaction><row><org_id>".$rows->org_id."</org_id><ext_uuid>".$ext_uuid."</ext_uuid><identity_card_number>$identity_number_core</identity_card_number></row></error_transaction><return_string>此医生身份证已经存在</return_string>".$this->_error_message_end;
						}

						$staff_core					= new Tstaff_core();
						$staff_core ->standard_code	= $standard_code;
						$staff_core ->name_login	= $name_login;
						$staff_core ->passwd		= $passwd;
						$staff_core ->region_id		= $region_id;
						$staff_core ->org_id		= $org_id;
						$staff_core ->region_path	= $region_path;
						$staff_core ->role_id		= $role_id;
                                                                                                                   $staff_code->zl_staff_code               = $zl_staff_code;
						$staff_core->startTransaction();
						//$staff_core->debug(3);
						if(empty($identity_number) && empty($ext_uuid_self)){
							//添加

							$uuid					= uniqid('',true);
							$staff_core ->id		= $uuid;
							$staff_core ->ext_uuid	= $ext_uuid;
							
							if($staff_core->insert()){
								$action_token=1;//insert
								$user_id=$uuid;
							}else{
								$user_id='';
								//return $this->_error_message_start."<row><org_id>".$rows->org_id."</org_id><ext_uuid>".$rows->ext_uuid."</ext_uuid></row>".$this->_error_message_end;
							}

						}else{
							//修改
							$staff_core->whereAdd("ext_uuid='$ext_uuid'");
							if($staff_core->update()){
								$action_token=2;//update
								$user_id_array		= get_fields_content('staff_core',array('ext_uuid'),"ext_uuid='$ext_uuid'");
								$user_id			= $user_id_array[0]['ext_uuid'];
								//$user_id=ext_uuid];
							}else{
								$user_id='';
								//return $this->_error_message_start."<row><org_id>".$rows->org_id."</org_id><ext_uuid>".$rows->ext_uuid."</ext_uuid></row>".$this->_error_message_end;
							}

						}


					}

					if($table_name=='staff_archive' && $user_id!=''){
						

						//业务号
						$ext_uuid			= $rows->ext_uuid;
						//身份证号
						$identity_number	= $rows->identity_card_number;

						$identity_number_length=strlen($identity_number);


						if(!$ext_uuid){
							return $this->_error_message_start."<return_code>2</return_code><error_transaction><row><org_id>".$rows->org_id."</org_id><ext_uuid>".$ext_uuid."</ext_uuid></row></error_transaction><return_string>业务id不能为空</return_string>".$this->_error_message_end;
						}
						if ($identity_number_length!=15 && $identity_number_length!=18)
						{
							return $this->_error_message_start."<return_code>2</return_code><return_string>身份证号码不合法</return_string>".$this->_error_message_end;
						}
						if($identity_number!=$identity_number){
							return $this->_error_message_start."<return_code>2</return_code><return_string>主表staff_core要与从表staff_archive身份证号码一致</return_string>".$this->_error_message_end;
						}

						$table_object=new $class_name();
						foreach ($rows as $colums){
							//给字段赋值
							$colums_name=$colums->getname();//字段名
							$colums_value=$rows->$colums_name;
							$table_object->$colums_name=$colums_value;
						}
						//$table_object->debug(2);

					
						
						if($action_token==1){
							$table_object->id=uniqid('',true);
							$table_object->user_id=$user_id;
							if($table_object->insert()){
								$staff_core->commit();
								$num++;
							}else{
								$staff_core->rollBack();
							}
						}elseif ($action_token==2){
							$table_object->whereAdd("user_id='$user_id'");
							if($table_object->update()){
								$staff_core->commit();
								$num++;
							}else{
								$staff_core->rollBack();
								//return $this->_error_message_start."<row><org_id>".$rows->org_id."</org_id><ext_uuid>".$rows->ext_uuid."</ext_uuid></row>".$this->_error_message_end;
							}
						}

					}

				}
			}
		}else{
			return $this->_error_message_start."<return_code>2</return_code><return_string>未传递任何数据xml</return_string>".$this->_error_message_end;
		}

		return $this->_error_message_start."<return_code>1</return_code><return_string>成功写入数据{$num}条</return_string>".$this->_error_message_end;

	}
	
}
?>