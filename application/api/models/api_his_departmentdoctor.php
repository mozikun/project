<?php
/****
 * @author whx
 * @todo 医生科室对照
 * *********** */
require_once __SITEROOT . "application/api/models/api_phs_iha_comm.php";

class hisdepartmentdoctor extends api_phs_comm
{

    private $_error_message_start;
    private $_error_message_end;
    private $role_id;

    public function __construct()
    {

        require_once __SITEROOT . "library/Models/department_doctor.php"; //坐诊表
      
        $this->_error_message_start = "<?xml version='1.0' encoding='UTF-8'?><message>";
        $this->_error_message_end = "</message>";
    }
	 
	/* ******************
     * 添加信息
     * ****************** */
	public function ws_insert($token, $xml_request){
		$xml = new SimpleXMLElement($xml_request);
		$department_doctor=new Tdepartment_doctor();
		$doctor_id=$xml->doctor_id;
		$department_id=$xml->department_id;
		if(empty($doctor_id)){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>医生id不能为空!</return_string>" . $this->_error_message_end;
		}
		if(empty($department_id)){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>科室id不能为空!</return_string>" . $this->_error_message_end;
		}
		$department_doctor->uuid=uniqid();
		$department_doctor->doctor_id=$doctor_id;
		$department_doctor->department_id=$department_id;
		$department_doctor->default=$xml->default;
		return 1;
		
		if($department_doctor->insert()){
			return $this->_error_message_start . "<return_code>1</return_code><return_string>新增成功!</return_string>" . $this->_error_message_end;
		}
		else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>新增失败!</return_string>" . $this->_error_message_end;
		}
	}
	/* ******************
     * 查询信息
     * ****************** */
	public function ws_select(){
		$department_doctor=new Tdepartment_doctor();
		if($department_doctor->count()==0)
		{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>没找到任何记录!</return_string>" . $this->_error_message_end; 
		}
		$department_doctor->find();
		$xml_return = "<?xml version='1.0' encoding='UTF-8'?><table name='department_doctor'>";
		while($department_doctor->fetch()){
			$xml_return.="<row>";
            $xml_return.=$department_doctor->toXML();
            $xml_return.="</row>";
		}
		$xml_return.="</table>";
		return $xml_return;
		
	}	
	
}

?>