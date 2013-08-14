<?php
/****
 * @author whx
 * @todo 中联上传医生信息
 * @time 2013-4-19
 * *********** */
require_once __SITEROOT . "application/api/models/api_phs_iha_comm.php";

class hisdoctor extends api_phs_comm
{

    private $_error_message_start;
    private $_error_message_end;
    private $role_id;

    public function __construct()
    {

        require_once __SITEROOT . '/library/custom/comm_function.php'; //公有函数
        require_once __SITEROOT . "library/Models/api_doctor.php"; 
        require_once __SITEROOT . "library/Models/organization.php"; 
        $this->_error_message_start = "<?xml version='1.0' encoding='UTF-8'?><message>";
        $this->_error_message_end = "</message>";
    }

    /* ******************
     * 新增医生
     * ****************** */

    public function doctor_insert($xml_string)
    {	
		
        //条件不为空时，解析查询条件
        $xml = new SimpleXMLElement($xml_string);
        $uuid=$xml->uuid;
		$org_id=$xml->org_id;
		$org_name=$xml->org_name;
        $doctor_code = $xml->doctor_code;//医生编码
		$doctor_name=$xml->doctor_name;
		$identity_number=$xml->identity_number;
		$flag=$xml->flag;
		//return $uuid;
		if(empty($doctor_code)){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>医生编码不能为空</return_string>" . $this->_error_message_end; 
		}
		//$organization=new Torganization();
		//$organization->whereAdd("");
		$doctor=new Tapi_doctor();
		$doctor->whereAdd("doctor_code='$doctor_code'");
		if($doctor->count()>0){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>该医生已经存在</return_string>" . $this->_error_message_end; 
		}
		$api_doctor=new Tapi_doctor();
		$api_doctor->uuid=uniqid();
		$api_doctor->org_id=$org_id;
		$api_doctor->org_name=$org_name;
		$api_doctor->doctor_code=$doctor_code;
		$api_doctor->doctor_name=$doctor_name;
		$api_doctor->identity_number=$identity_number;
		$api_doctor->flag=$flag;
		
		if($api_doctor->insert()){
			return $this->_error_message_start . "<return_code>1</return_code><return_string>插入成功</return_string>" . $this->_error_message_end; 
		}else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>插入失败</return_string>" . $this->_error_message_end; 
		}
        }
		
    /* ******************
     * 更新医生信息
     * ****************** */
     public function doctor_update($xml_string){
		 //条件不为空时，解析查询条件
        $xml = new SimpleXMLElement($xml_string);
        $uuid=$xml->uuid;
		$org_id=$xml->org_id;
		$org_name=$xml->org_name;
        $doctor_code = $xml->doctor_code;//医生编码
		$doctor_name=$xml->doctor_name;
		$identity_number=$xml->identity_number;
		$flag=$xml->flag;
		//return $uuid;
		if(empty($doctor_code)){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>医生编码不能为空</return_string>" . $this->_error_message_end; 
		}
		$api_doctor=new Tapi_doctor();
		$api_doctor->doctor_code=$doctor_code;
		$api_doctor->whereAdd("doctor_code='$doctor_code'");
		if($api_doctor->count()<1){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到该编码对应的医生</return_string>" . $this->_error_message_end; 
		}
		$api_doctor=new Tapi_doctor();
		$api_doctor->org_id=$org_id;
		$api_doctor->org_name=$org_name;
		//$api_doctor->doctor_code=$doctor_code;
		$api_doctor->doctor_name=$doctor_name;
		$api_doctor->identity_number=$identity_number;
		$api_doctor->flag=$flag;
		$api_doctor->whereAdd("doctor_code='$doctor_code'");
		if($api_doctor->update()){
			return $this->_error_message_start . "<return_code>1</return_code><return_string>修改成功</return_string>" . $this->_error_message_end; 
		}else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>修改失败</return_string>" . $this->_error_message_end; 
		}
		
	 }

    /* ******************
     * 查询医生信息
     * ****************** */	 
    
	public function doctor_select($xml_string){
		 $xml = new SimpleXMLElement($xml_string);
		 $doctor_code=$xml->doctor_code;
		 if(empty($doctor_code)){
			return $this->_error_message_start . "<return_code>1</return_code><return_string>医生编码不能为空</return_string>" . $this->_error_message_end; 
		 }
		 $api_doctor=new Tapi_doctor();
		 $api_doctor->whereAdd("doctor_code='$doctor_code'");
		 if($api_doctor->count()<1){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到该编码对应的医生</return_string>" . $this->_error_message_end; 
		}
		$api_doctor->find(true);
			return "<?xml version='1.0' encoding='UTF-8'?>"."<doctor_info>".$api_doctor->toxml()."</doctor_info>";
		 
	}
	
	 /* ******************
     * 删除医生信息
     * ****************** */
	public function doctor_delete($xml_string){
		 $xml = new SimpleXMLElement($xml_string);
		 $doctor_code=$xml->doctor_code;
		 if(empty($doctor_code)){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>医生编码不能为空</return_string>" . $this->_error_message_end; 
		 }
		 $api_doctor=new Tapi_doctor();
		 $api_doctor->whereAdd("doctor_code='$doctor_code'");
		 if($api_doctor->count()<1){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到该编码对应的医生</return_string>" . $this->_error_message_end; 
		}
		if($api_doctor->delete()){
			return $this->_error_message_start . "<return_code>1</return_code><return_string>删除成功</return_string>" . $this->_error_message_end;
		}else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>删除失败</return_string>" . $this->_error_message_end;
		}
	
	}
 }
	


?>