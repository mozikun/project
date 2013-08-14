<?php
/****
 * @author whx
 * @todo 诊室信息接口
 * @time 2013-05-15
 * *********** */
require_once __SITEROOT . "application/api/models/api_phs_iha_comm.php";

class hisclinic extends api_phs_comm
{

    private $_error_message_start;
    private $_error_message_end;
    private $role_id;

    public function __construct()
    {

        require_once __SITEROOT . '/library/custom/comm_function.php'; //公有函数
        require_once __SITEROOT . "library/Models/organization.php"; //机构表
        require_once __SITEROOT . "application/api/models/api_phs_common.php";
        require_once __SITEROOT . "library/Models/zuozhen.php"; //坐诊表
        require_once __SITEROOT . "library/Models/zuozhen_dictionary.php"; //机构表
        require_once __SITEROOT . "library/Models/department.php"; //科室表
        require_once __SITEROOT . "library/Models/clinic.php"; //诊室表
        require_once __SITEROOT . "library/Models/appointment_register.php";
        require_once __SITEROOT . "library/Models/staff_core.php";
        $this->_error_message_start = "<?xml version='1.0' encoding='UTF-8'?><message>";
        $this->_error_message_end = "</message>";
    }
	 
	/* ******************
     * 诊室添加
	 * 诊室属于科室 uuid。org_id department_id必需
     * ****************** */
	public function ws_insert($token, $xml_request){
		$xml = new SimpleXMLElement($xml_request);
		if(empty($xml->uuid)){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>uuid不能为空!</return_string>" . $this->_error_message_end; 
		}
		//机构转码
		$organization=new Torganization();
		$organization->whereAdd("standard_code='$xml->org_id'");
		$organization->find(true);
		$org_id=$organization->id;
		if(!$org_id){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>机构码不正确!</return_string>" . $this->_error_message_end; 
		}
		
		//检查科室是否存在
		$department=new Tdepartment();
		$department->whereAdd("uuid='$xml->department_id'");
		if($department->count()<1){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>科室编码不正确!</return_string>" . $this->_error_message_end; 
		}
		$clinic=new Tclinic();
		$clinic->uuid=$xml->uuid;
		$clinic->created=time();
		$clinic->status_flag=$xml->status_flag;
		$clinic->org_id=$org_id;
		$clinic->clinic_name=$xml->clinic_name;
		$clinic->sort_number=$xml->sort_number;
		$clinic->department_id=$xml->department_id;
		
		if($clinic->insert()){
			return $this->_error_message_start . "<return_code>1</return_code><return_string>新增成功!</return_string>" . $this->_error_message_end;
		}
		else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>新增失败!</return_string>" . $this->_error_message_end;
		}
	}	 
	
	 /* ******************
     * 诊室修改
     * ****************** */
	public function ws_update($token, $xml_request){
		$xml = new SimpleXMLElement($xml_request);
		if(empty($xml->uuid)){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>uuid不能为空!</return_string>" . $this->_error_message_end; 
		}
		//机构转码
		$organization=new Torganization();
		$organization->whereAdd("standard_code='$xml->org_id'");
		$organization->find(true);
		$org_id=$organization->id;
		if(!$org_id){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>机构码不正确!</return_string>" . $this->_error_message_end; 
		}
		
		//检查科室是否存在
		$department=new Tdepartment();
		$department->whereAdd("uuid='$xml->department_id'");
		if($department->count()<1){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>科室编码不正确!</return_string>" . $this->_error_message_end; 
		}
		$clinic=new Tclinic();
		$clinic->updated=time();
		$clinic->status_flag=$xml->status_flag;
		$clinic->org_id=$org_id;
		$clinic->clinic_name=$xml->clinic_name;
		$clinic->sort_number=$xml->sort_number;
		$clinic->department_id=$xml->department_id;
		$clinic->whereAdd("uuid='$xml->uuid'");
		if($clinic->update()){
			return $this->_error_message_start . "<return_code>1</return_code><return_string>修改成功!</return_string>" . $this->_error_message_end;
		}
		else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>修改失败!</return_string>" . $this->_error_message_end;
		}
	}

	/* ******************
     * 删除诊室
	 * 可以以uuid删除一条记录，可以删除某科室下的所有诊室，也可以以机构号删除某机构下所有诊室
	 
     * ****************** */
	public function ws_delete($token, $xml_request){
		$xml = new SimpleXMLElement($xml_request);
		if($xml->org_id){
		//机构转码
			$organization=new Torganization();
			$organization->whereAdd("standard_code='$xml->org_id'");
			$organization->find(true);
			$org_id=$organization->id;
			if(!$org_id){
				return $this->_error_message_start . "<return_code>2</return_code><return_string>机构码不正确!</return_string>" . $this->_error_message_end; 
			}
		}
		$clinic=new Tclinic();
		if($org_id){
			$clinic->whereAdd("org_id='$org_id'");
		}
		if($xml->uuid){
			$clinic->whereAdd("uuid='$xml->uuid'");
		}
		if($xml->department_id){
			//检查科室是否存在
			$department=new Tdepartment();
			$department->whereAdd("uuid='$xml->department_id'");
			if($department->count()<1){
				return $this->_error_message_start . "<return_code>2</return_code><return_string>科室编码不正确!</return_string>" . $this->_error_message_end; 
			}
		$clinic->whereAdd("department_id='$department_id'");	
		}
		if(empty($org_id)&&empty($xml->uuid)&&empty($xml->department_id)){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>缺少删除条件</return_string>" . $this->_error_message_end;
		}
		if($clinic->count()<1){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到该记录</return_string>" . $this->_error_message_end;
		}
		if($clinic->delete()){
			return $this->_error_message_start . "<return_code>1</return_code><return_string>删除成功!</return_string>" . $this->_error_message_end;
		}
		else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>删除失败!</return_string>" . $this->_error_message_end;
		}
		
	}
	
	 /* ******************
     * 诊室查询
	 * 可以以uuid查询一条记录，可以删除某科室下的所有诊室，也可以以机构号删除某机构下所有诊室
     * ****************** */
	public function ws_select($token, $xml_request){
		$xml = new SimpleXMLElement($xml_request);
		if($xml->org_id){
		//机构转码
			$organization=new Torganization();
			$organization->whereAdd("standard_code='$xml->org_id'");
			$organization->find(true);
			$org_id=$organization->id;
			if(!$org_id){
				return $this->_error_message_start . "<return_code>2</return_code><return_string>机构码不正确!</return_string>" . $this->_error_message_end; 
			}
		}
		$clinic=new Tclinic();
		if($org_id){
			$clinic->whereAdd("org_id='$org_id'");
		}
		if($xml->uuid){
			$clinic->whereAdd("uuid='$xml->uuid'");
		}
		if($xml->department_id){
			//检查科室是否存在
			$department=new Tdepartment();
			$department->whereAdd("uuid='$xml->department_id'");
			if($department->count()<1){
				return $this->_error_message_start . "<return_code>2</return_code><return_string>科室编码不正确!</return_string>" . $this->_error_message_end; 
			}
		$clinic->whereAdd("department_id='$department_id'");	
		}
		if($clinic->count()==0){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>没找到任何记录!</return_string>" . $this->_error_message_end; 
		}
		$clinic->orderby("sort_number,org_id");
		$clinic->find();
		$xml_return = "<?xml version='1.0' encoding='UTF-8'?><table name='clinic'>";
		while($clinic->fetch()){
			$xml_return.="<row>";
            $xml_return.=$clinic->toXML();
            $xml_return.="</row>";
		}
		$xml_return.="</table>";
		return $xml_return;
	 }


}

?>