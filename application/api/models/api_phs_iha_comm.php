<?php
class api_phs_comm
{
	public function __construct()
	{
		require_once __SITEROOT."library/Models/organization.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
	}
	/**
	 * 根据机构代码获取内部机构号
	 *
	 * @param string $standard_code
	 * @return string
	 */
	protected function get_org_id($standard_code)
	{
		$organization = new Torganization();
		$organization->whereAdd("standard_code='$standard_code'");
		$organization->find(true);
		$organization->free_statement();
		return $organization->id;
	}

	/**
	 * 根据机构代的所有信息
	 *
	 * @param string $standard_code
	 * @return string
	 */
	protected function get_org_info($standard_code)
	{
		require_once __SITEROOT."library/Models/region.php";

		$org_array=array();
		$organization = new Torganization();
		$organization->whereAdd("standard_code='$standard_code'");
		$organization->find(true);
		$organization->free_statement();
		$region_path=$organization->region_path;
		if($region_path!=''){
			$org_array['org_id']=$organization->id;
			$org_array['region_path']=$region_path;
			$region=new Tregion();
			$region->whereAdd("region_path='$region_path'");
			$region->find(true);
			$region->free_statement();
			$org_array['region_id']=$region->id;
		}
		return $org_array;
	}
	/**
	 * 根据内部机构号获取机构代码
	 *
	 * @param string $org_id
	 * @return string
	 */
	protected function set_org_id($org_id)
	{
		$organization = new Torganization();
		$organization->whereAdd("id='$org_id'");
		$organization->find(true);
		$organization->free_statement();
		return $organization->standard_code;
	}
	/**
	 * 用于处理医生ID，返回医生对应身份证号码
	 *
	 * @param string $doctor_uuid
	 * @return string
	 */
	protected function get_doctor_number($doctor_uuid)
	{
		$staff=new Tstaff_archive();
		$staff->where("user_id='$doctor_uuid'");
		$staff->find(true);
		$staff->free_statement();
		return $staff->identity_card_number;
	}
	/**
	 * 处理医生ID，返回医生身份证号对应的医生ID
	 *
	 * @param string $identity_card_number
	 * @return string
	 */
	protected function set_doctor_number($identity_card_number)
	{
		$staff=new Tstaff_archive();
		$staff->where("identity_card_number='$identity_card_number'");
		$staff->find(true);
		$staff->free_statement();
		return $staff->user_id;
	}
	/**
	 * 接口身份验证，验证机构的标准代码和机构密码
	 *
	 * @param string $org_id
	 * @param string $password
	 * @return string
	 */
	public function login($org_id,$password){
		require_once __SITEROOT."library/Models/organization.php";
		$organization	= new Torganization();
		$password		= md5($password);
		$organization->whereAdd("standard_code='$org_id'");//机构标准代码
		$organization->whereAdd("password='$password'");//机构密码

		if($organization->count()==1){
			//机构标准代码和密码正确
			//$session_id			= session_id();
			//setcookie('yaan_token',$session_id);
			//$session_id=$_COOKIE['yaan_token'];//

			$mask				= md5('chinachis_2006_2011').md5($_SERVER['REMOTE_ADDR']);//
			$time				= time();
			//$token				= $mask.'|'.$session_id.'|'.$time;//令排串
			$token				= $mask.'|'.$time;//令排串
			$xml_string	= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>1</return_code><return_string>$token</return_string></message>";

		}else{
			$xml_string	= "<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>机构代码错或是密码不正确</return_string></message>";

		}
		return $xml_string;
	}
	/**
	 * 接口日志
	 * model_id：模块：1个人档案2家庭档案3健康体检4高血压5糖尿病6重性精神分裂7孕产妇8儿童9婚前保健10预防接种
			11个人基本信息(HIS)12门急诊病历(HIS)13西医处方(HIS)14中医处方(HIS)15检查记录(HIS)16检验记录(HIS)17生命体征测量记录(HIS)18病案首页(HIS)19入院记录(HIS)
			20病程记录(HIS)21长期医嘱(HIS)222临时医嘱(HIS)23出院记录(HIS)24转诊记录(HIS)
	 * upload_token：1插入成功2修改成功3删除成功
	 * @param array $logs_array=array("ext_uuid"=>value,"model_id"=number,"upload_time"=>time,"upload_token"=>number);
	 * @return boolean
	 */
	public  function insert_api_logs($logs_array){
		$result	= false;//返回结果

		if(is_array($logs_array)){
			//模块：1个人档案2家庭档案3健康体检4高血压5糖尿病6重性精神分裂7孕产妇8儿童9婚前保健10预防接种
			//11个人基本信息(HIS)12门急诊病历(HIS)13西医处方(HIS)14中医处方(HIS)15检查记录(HIS)16检验记录(HIS)17生命体征测量记录(HIS)18病案首页(HIS)19入院记录(HIS)
			//20病程记录(HIS)21长期医嘱(HIS)222临时医嘱(HIS)23出院记录(HIS)24转诊记录(HIS)
			$model_id_array		= array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25);
			//1插入成功2修改成功3删除成功
			$upload_token_array	= array(1,2,3);
			//必填的字段
			$field_array=array("ext_uuid","org_id","model_id","upload_time","upload_token");
			//标致-验证参数
			$token=true;

			foreach ($field_array as $field){
				if(!array_key_exists($field,$logs_array)){
					//throw new Exception("字段$field是必填字段！");
					$token	= false;
					break;
				}
				if(!in_array($logs_array['model_id'],$model_id_array)){
					$token = false;
					break;
				}
				if(!in_array($logs_array['upload_token'],$upload_token_array)){
					$token = false;
					break;
				}


			}
			if($token===true){
			 
				//接口日志
				require_once __SITEROOT."library/Models/api_logs.php";
				$api_logs	= new Tapi_logs();
				$api_logs->whereAdd("ext_uuid='".$logs_array['ext_uuid']."'");
				$api_logs->whereAdd("org_id='".$logs_array['org_id']."'");
				$api_logs->whereAdd("model_id=".$logs_array['model_id']);
				$start_time=mktime(0,0,0,date('m'),date('d'),date('Y'));
				$end_time=mktime(23,59,59,date('m'),date('d'),date('Y'));
				$api_logs->whereAdd("upload_time>".$start_time);
				$api_logs->whereAdd("upload_time<".$end_time);
				//$api_logs->debug(2);
				if($api_logs->count()==0){
					$api_logs_action=new Tapi_logs();
					$api_logs_action->uuid=uniqid('al',true);
					foreach ($logs_array as $key=>$value){
						$api_logs_action-> {$key} = $value;
					}
					//$api_logs_action->debug(2);
					if($api_logs_action->insert()){
						$result=true;
					}
				}

				$api_logs->free_statement();
			}

		}
		return $result;
	}
	
	//信息返回方法
	/*	返回接口操作成功信息
	 *	 参数：msg 提示信息 other_info 其它返回信息
	 *	 返回值:执行成功的提示信息
	 */	
	public function api_success($msg,$other_info=""){
		$message="<?xml version='1.0' encoding='UTF-8'?>
		<message>
			<code>1</code>
			<info>$msg</info>
			$other_info	
		</message>";
		return  $message;
	}
	/*	返回接口操作失败信息信息
	 *	 参数：msg 提示信息
	 *	 返回值:失败的提示信息
	 */	
	public function api_failure($msg){
		$message="<?xml version='1.0' encoding='UTF-8'?>
		<message>
			<code>2</code>
			<info>$msg</info>	
		</message>";
		return  $message;
	}
}
?>