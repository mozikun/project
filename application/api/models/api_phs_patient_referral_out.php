<?php
/**
 * @author mask
 * @todo 本类用于双向转诊接口功能的具体实现-插入、更新、查询、删除操作
 */
require_once __SITEROOT."application/api/models/api_phs_iha_comm.php";
class phspatientout extends api_phs_comm
{
	private $_error_message_start;
	private $_error_message_end;
	public function __construct()
	{
		require_once __SITEROOT."library/Models/individual_core.php";//个人档案主表
		require_once __SITEROOT.'/library/custom/comm_function.php';//公有函数
		require_once __SITEROOT."library/Models/patient_referral_out.php";//双向转诊转出
		require_once __SITEROOT."library/Models/organization.php";//机构表


		$this->_error_message_start="<?xml version='1.0' encoding='UTF-8'?><message>";
		$this->_error_message_end="</message>";
	}
	/**
	 * 查询多条转诊数据
	 *
	 * @param string $token
	 * @param string $xml_string
	 */
	public function ws_patient_referral_out_select($token,$xml_string){

		/*$mask_token			= check_token($token);//验证令牌

		if($mask_token==2){
		//令牌错误
		$xml_string		= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>令牌错误</return_string></message>";
		return $xml_string;
		}elseif($mask_token==3){
		//令牌过期
		$xml_string		= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>3</return_code><return_string>令牌过期</return_string></message>";
		return $xml_string;
		}elseif($mask_token!==1){
		//请先登陆
		$xml_string		= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>4$mask_token</return_code><return_string>请先登陆</return_string></message>";
		return $xml_string;
		}*/

		$organization	= new Torganization();
		if ($xml_string){
			//条件不为空时，解析查询条件
			$where_xml		= new SimpleXMLElement($xml_string);

			$org_id			= $where_xml->org_id;//机构id
			$status			= $where_xml->status;//转诊状态 为空取所有的转诊信息 1=>转出机构发出申请,2=>接受机构收到申请,3=>接受机构同意申请,4=>授受机构拒绝申请,5=>上转执行,6=>上转完成请
			if ($org_id==""){
				return $this->_error_message_start."<return_code>2</return_code><return_string>错误，请提供机构号org_id</return_string>".$this->_error_message_end;//错误，请提供机构id
			}
			//验证标准机构码是否合法
			$organization->whereAdd("standard_code='$org_id'");
			if($organization->count("*")!=1){
				return $this->_error_message_start."<return_code>2</return_code><return_string>错误，提供的机构号org_id不正确</return_string>".$this->_error_message_end;//错误的机构id
			}

		}else{
			return $this->_error_message_start."<return_code>2</return_code><return_string>请传递查询条件XML</return_string>".$this->_error_message_end;//请传递查询条件XML
		}

		$organization->find(true);
		$inner_org_id=$organization->id;//机构内部码
		$organization->free_statement();


		if ($inner_org_id!=''){

			$patient_referral_out   = new Tpatient_referral_out();

			$patient_referral_out->whereAdd("dst_org_name='$inner_org_id'");//转到机构id
			if($status!=''){
				$patient_referral_out->whereAdd("status='$status'");//转到机构id
			}
			$error=$patient_referral_out->showErrorMessage();
			//$patient_referral_out->debug(2);
			$patient_referral_out->find();


			$xml_string="<?xml version='1.0' encoding='UTF-8'?><table name='patient_referral_out_info'>";
			//转换代码
			while ($patient_referral_out->fetch()) {
				$xml_string.='<row>';
				$xml_string.='<uuid>'.$patient_referral_out->uuid.'</uuid>';//业务号
				//处理
				$id=$patient_referral_out->id;//居民档案号
				$individual_core_obj=get_individual_info($id);//个人信息
				$xml_string.='<identity_number>'.$individual_core_obj->identity_number.'</identity_number>';//居民身份证号

				$xml_string.='<referral_time>'.$patient_referral_out->referral_out_time?date("Y-m-d",$patient_referral_out->referral_out_time):''.'</referral_time>';//存根转诊时间
				//处理
				$doctor_id=$patient_referral_out->in_of_doctor;//接诊医生号
				$doctor_identity_number='';//接诊医生身份证
				if($doctor_id!=''){
					$doctor_info_array		= get_staff_info($doctor_id);
					$doctor_identity_number	= $doctor_info_array[1]->identity_card_number;//身份证号
				}
				$xml_string			       .= '<referral_in_identity_number>'.$doctor_identity_number.'</referral_in_identity_number>';//接诊医生身份证

				$xml_string.='<firefight>'.$patient_referral_out->firefight.'</firefight>';//初步诊断
				$xml_string.='<present_illness>'.$patient_referral_out->present_illness.'</present_illness>';//主要现病史
				$xml_string.='<past_history>'.$patient_referral_out->past_history.'</past_history>';//主要既往史
				$xml_string.='<course_and_treatment>'.$patient_referral_out->course_and_treatment.'</course_and_treatment>';//治疗经过
				//处理
				$out_of_doctor_id=$patient_referral_out->out_of_doctor;//转诊医生id
				$out_doctor_identity_number='';//转诊医生身份证号
				if($out_of_doctor_id!==''){
					$doctor_info_array			= get_staff_info($out_of_doctor_id);
					$out_doctor_identity_number	= $doctor_info_array[1]->identity_card_number;//身份证号
				}
				$xml_string.='<referral_out_identity_number>'.$out_doctor_identity_number.'</referral_out_identity_number>';//转诊医生身份证
				//处理
				$my_org_id=$patient_referral_out->my_org_name;//转出机构id
				$my_stand_org_id		='';//转出机构标准id
				if($my_org_id!=''){
					$my_org_obj		 	= get_org_info($my_org_id);
					$my_stand_org_id 	= $my_org_obj->standard_code;//机构标准号
				}
				$xml_string.='<referral_out_org_id>'.$my_stand_org_id.'</referral_out_org_id>';//标准机构号

				$xml_string.='<fill_time>'.$patient_referral_out->fill_time?date("Y-m-d",$patient_referral_out->fill_time):''.'</fill_time>';//转出填表时间
				$xml_string.='<phone>'.$patient_referral_out->phone.'</phone>';//联系电话
				$xml_string.='<status>'.$patient_referral_out->status.'</status>';//中联接口状态
				$xml_string.='<remark>'.$patient_referral_out->remark.'</remark>';//中联接口备注

				$xml_string.='</row>';
			}


			$xml_string.="<error_msg>$error</error_msg></table>";
			//$xml_string.="</tables>";
			return $xml_string;
		}else{
			return $this->_error_message_start."<return_code>2</return_code><return_string>没有你要查询的数据，请检查查询条件</return_string>".$this->_error_message_end;//错误，没有你要查询的数据，请检查查询条件
		}
	}
	/**
	 * 插入转诊转出接口..
	 *
	 * @param string $token
	 * @param string $xml_string
	 */
	public function ws_patient_referral_out_insert($token,$xml_string){
		/*$mask_token			= check_token($token);//验证令牌

		if($mask_token==2){
		//令牌错误
		$xml_string		= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>令牌错误</return_string></message>";
		return $xml_string;
		}elseif($mask_token==3){
		//令牌过期
		$xml_string		= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>3</return_code><return_string>令牌过期</return_string></message>";
		return $xml_string;
		}elseif($mask_token!==1){
		//请先登陆
		$xml_string		= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>4$mask_token</return_code><return_string>请先登陆</return_string></message>";
		return $xml_string;
		}*/
		$where_xml		= new SimpleXMLElement($xml_string);
		$error_string	= '';//错误提示
		$i				= 0;//居民身份证为空计数
		$j				= 0;//接诊医生身份证为空计数
		$x				= 0;//转诊医生身份证为空计数

		$y				= 0;//插入记录数
		if($where_xml->attributes()=='patient_referral_out'){
			foreach ($where_xml as $row){
				$uuid						= $row->uuid;//业务id
				if($uuid==''){
					continue;
				}
				$identity_number			= $row->identity_number;//居民身份证号
				if($identity_number==""){
					$i++;
					continue;
				}


				$referral_time				= $row->referral_time;//存根转诊时间
				$referral_in_identity_number= $row->referral_in_identity_number;//接诊医生身份证号
				if(empty($referral_in_identity_number)){
					$j++;
					continue;
				}


				$firefight					= $row->firefight;//初步诊断-文本形式
				$present_illness			= $row->present_illness;//主要现病史
				$past_history				= $row->past_history;//主要既往史
				$course_and_treatment		= $row->course_and_treatment;//治疗经过
				$referral_out_identity_number= $row->referral_out_identity_number;//转诊医生身份证
				if(empty($referral_out_identity_number)){
					$x++;
					continue;
				}


				$stub_fill_time				= $row->stub_fill_time;//存根填表时间


				$phone						= $row->phone;//联系电话
				$fill_time					= $row->fill_time;//填表时间
				$remark						= $row->remark;//备注

				//数据处理
				//将身份证转成个人uuid

				$people_array				= get_fields_content('individual_core',array('uuid','date_of_birth'),"identity_number='$identity_number'");
				//echo count($people_array);
				if(count($people_array)!=1){
					$error_string.="居民身份证：{$identity_number}|";
					continue;
				}else{
					$persion_id				= $people_array[0]['uuid'];//个人档案uuid
					$age					= date('Y')-date('Y',$people_array[0]['date_of_birth']);//年龄

				}
				//接诊医生内部id
				$in_doctor_array			= get_fields_content('staff_archive',array('user_id','section_office_id'),"identity_card_number='$referral_in_identity_number'");
				
				if(count($in_doctor_array)!=1){
					$error_string.="接诊医生身份证号：{$referral_in_identity_number}|";
					continue;
				}else{
					$in_doctor_id			= $in_doctor_array[0]['user_id'];//医生内部id
					$section_office_id		= $in_doctor_array[0]['section_office_id'];//科室id
					$in_doctor_core_array	= get_fields_content('staff_core',array('org_id'),"id='$in_doctor_id'");
					$in_org_id				= $in_doctor_core_array[0]['org_id'];//接诊机构号

				}
				//转诊医生内部id
				$out_doctor_array			= get_fields_content('staff_archive',array('user_id'),"identity_card_number='$referral_out_identity_number'");
				if(count($out_doctor_array)!=1){
					$error_string.="转诊医生身份证号：{$referral_out_identity_number}|";
					continue;
				}else{
					$out_doctor_id			= $out_doctor_array[0]['user_id'];//内部id
					$out_doctor_core_array	= get_fields_content('staff_core',array('org_id'),"id='$out_doctor_id'");
					$out_org_id				= $out_doctor_core_array[0]['org_id'];//接诊机构号
				}


				$patient_referral_out   				= new Tpatient_referral_out();
				$patient_referral_out->uuid 			= $uuid;//编号

				$patient_referral_out->staff_id 		= $out_doctor_id;//医生档案号

				$patient_referral_out->id 				= $persion_id;//个人档案号

				$patient_referral_out->created  		= time();//添加记录时间

				$patient_referral_out->age 				= $age;//年龄

				if($referral_time!=''){
					$patient_referral_out->referral_out_time = strtotime($referral_time);//存根转诊时间
				}

				$patient_referral_out->stub_unit 		= $in_org_id;//转入单位

				$patient_referral_out->stub_doccol 		= $section_office_id;//转入科室

				$patient_referral_out->in_of_doctor 	= $in_doctor_id;//接诊医生

				$patient_referral_out->stub_of_doctor 	= $out_doctor_id;//存根转诊医生
				if($stub_fill_time!=''){
					$patient_referral_out->stub_fill_time 	= strtotime($stub_fill_time);//存根填表时间
				}
				$patient_referral_out->dst_org_name 	= $in_org_id;//转到机构名

				$patient_referral_out->firefight 		= $firefight;//初步诊断

				$patient_referral_out->present_illness 	= $present_illness;//主要现病史

				$patient_referral_out->past_history 	= $past_history;//主要既往史

				$patient_referral_out->course_and_treatment = $course_and_treatment;//治疗经过

				$patient_referral_out->out_of_doctor 	= $out_doctor_id;//转诊医生

				$patient_referral_out->phone 			= $phone;//联系电话

				$patient_referral_out->my_org_name 		= $out_org_id;//自己的机构名
				if($fill_time!=''){
					$patient_referral_out->fill_time 		= strtotime($fill_time);//转出填表时间
				}
				$patient_referral_out->ext_uuid			= uniqid('ex',true);//状态
				$patient_referral_out->status 			= '1';//状态
				$patient_referral_out->remark 			= $remark;//备注

				if($patient_referral_out->insert()){

					$y++;
				}else{
					$error_string.=$uuid.'|';
				}



			}
			//错误提示
			if($i!=0){
				$error_string.="居民身份证为空 {$i} 条！";
			}
			if($j!=0){
				$error_string.="接诊医生身份证为空 {$j} 条！";
			}
			if($x!=0){
				$error_string.="转诊医生身份证为空 {$x} 条！";
			}

			return $this->_error_message_start."<return_code>1</return_code><return_string>成功插入{$y}条.{$error_string}</return_string>".$this->_error_message_end;//执行结果
		}else{

			return $this->_error_message_start."<return_code>2</return_code><return_string>xml格式错误</return_string>".$this->_error_message_end;//错误，没有你要查询的数据，请检查查询条件
		}

	}
	/**
	 * 更新转诊单接口
	 *
	 * @param string $token
	 * @param string $xml_string
	 */
	public function ws_patient_referral_out_update($token,$xml_string){
		/*$mask_token			= check_token($token);//验证令牌

		if($mask_token==2){
		//令牌错误
		$xml_string		= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>令牌错误</return_string></message>";
		return $xml_string;
		}elseif($mask_token==3){
		//令牌过期
		$xml_string		= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>3</return_code><return_string>令牌过期</return_string></message>";
		return $xml_string;
		}elseif($mask_token!==1){
		//请先登陆
		$xml_string		= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>4$mask_token</return_code><return_string>请先登陆</return_string></message>";
		return $xml_string;
		}*/
		//
		$error_info	= '';//错误提示
		$i		 	= 0;//错误数
		$j			= 0;//更新出错数
		$z			= 0;//更新成功数
		if ($xml_string){
			//条件不为空时，解析查询条件
			$where_xml		= new SimpleXMLElement($xml_string);

			foreach ($where_xml as $row){

				$uuid			= $row->uuid;//uuid
				$org_id			= $row->org_id;//机构id
				$status			= $row->status;//转诊状态 为空取所有的转诊信息 1=>转出机构发出申请,2=>接受机构收到申请,3=>接受机构同意申请,4=>授受机构拒绝申请,5=>上转执行,6=>上转完成请
				$remark			= $row->remark;//备注
				if($org_id!='' || $status!='' || $uuid!=''){
					$patient_referral_out	= new Tpatient_referral_out();
					$patient_referral_out->whereAdd("uuid='$uuid'");
					$patient_referral_out->status=$status;
					$patient_referral_out->remark=$remark;
					if($patient_referral_out->update()){
						$z++;
					}else{

						$j++;//错误记数
						$error_info.=$uuid.'|';
					}
					$patient_referral_out->free_statement();
				}else{
					$i++;//错误记数

				}

			}
			//更新错误
			if($j!=0){
				$error_info.="更新错误:{$j}条;";
			}
			//更新机构、状态为空
			if($i!=0){
				$error_info.="业务号或机构或状态为空:{$i}条;";
			}

			return $this->_error_message_start."<return_code>1</return_code><return_string>更新记录数$z;$error_info</return_string>".$this->_error_message_end;//错误的机构id


		}else{
			return $this->_error_message_start."<return_code>2</return_code><return_string>请传递查询条件XML</return_string>".$this->_error_message_end;//请传递查询条件XML
		}

	}

	/**
	 * 删除转诊单接口
	 *
	 * @param string $token
	 * @param string $xml_string
	 */
	public function ws_patient_referral_out_delete($token,$xml_string){
		/*$mask_token			= check_token($token);//验证令牌

		if($mask_token==2){
		//令牌错误
		$xml_string		= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>令牌错误</return_string></message>";
		return $xml_string;
		}elseif($mask_token==3){
		//令牌过期
		$xml_string		= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>3</return_code><return_string>令牌过期</return_string></message>";
		return $xml_string;
		}elseif($mask_token!==1){
		//请先登陆
		$xml_string		= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>4$mask_token</return_code><return_string>请先登陆</return_string></message>";
		return $xml_string;
		}*/
		//
		$error_info	= '';//错误提示
		$i		 	= 0;//错误数
		$j			= 0;//更新出错数
		$z			= 0;//更新成功数
		if ($xml_string){
			//条件不为空时，解析查询条件
			$where_xml		= new SimpleXMLElement($xml_string);

			foreach ($where_xml as $row){

				$uuid			= $row->uuid;//uuid

				if($uuid!=''){
					$patient_referral_out	= new Tpatient_referral_out();
					$patient_referral_out->whereAdd("uuid='$uuid'");

					if($patient_referral_out->delete()){
						$z++;
					}else{

						$j++;//错误记数
						$error_info.=$uuid.'|';
					}
					$patient_referral_out->free_statement();
				}else{
					$i++;//错误记数

				}

			}
			//更新错误
			if($j!=0){
				$error_info.="删除错误:{$j}条;";
			}
			//更新机构、状态为空
			if($i!=0){
				$error_info.="业务号为空:{$i}条;";
			}

			return $this->_error_message_start."<return_code>1</return_code><return_string>删除记录数$z;$error_info</return_string>".$this->_error_message_end;//错误的机构id


		}else{
			return $this->_error_message_start."<return_code>2</return_code><return_string>请传递查询条件XML</return_string>".$this->_error_message_end;//请传递查询条件XML
		}

	}

}
?>