<?php

/* * **
* @author whx
* @todo 健康教育处方
* @time 2013-10-25
* *********** */
class hishealth_prescription{

	private $_error_message_start;
	private $_error_message_end;
	private $role_id;

	public function __construct() {

		require_once __SITEROOT . '/library/custom/comm_function.php'; //公有函数
		require_once __SITEROOT . "library/Models/organization.php"; //机构表
		require_once __SITEROOT . "library/Models/health_prescription.php"; //健康教育处方
		require_once __SITEROOT . "library/Models/staff_archive.php";
		$this->_error_message_start = "<?xml version='1.0' encoding='UTF-8'?><message>";
		$this->_error_message_end = "</message>";
	}

	/*******************
	* 添加健康教育处方
	* ****************** */

	public function ws_insert($token="", $xml_request) {
		$xml = new SimpleXMLElement($xml_request);
		//机构转码
		if(!empty($xml->org_id)){
			$organization = new Torganization();
			$organization->whereAdd("standard_code='".trim($xml->org_id)."'");
			$organization->find(true);
			$org_id = $organization->id;
			if (empty($org_id)) {
				return $this->_error_message_start . "<return_code>2</return_code><return_string>机构码不正确,或者在本系统找不到该机构编码</return_string>" . $this->_error_message_end;
			}
		}else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>机构编码不能为空！</return_string>" . $this->_error_message_end;
		}
		//创建健康教育处方对象
		$he = new Thealth_prescription();
		$he->uuid ="P_".uniqid();
		$he->add_time = time();
		$he->org_id=$org_id;//机构
		$he->title=$xml->title;
		$he->content=$xml->content;
		$he->ext_uuid=$xml->ext_uuid;
		$staff=new Tstaff_archive();
		$staff->whereAdd("identity_card_number='".trim($xml->doctor_id)."'");
		$staff->find(true);
		if(empty($staff->user_id)){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到该医生信息！</return_string>" . $this->_error_message_end;
		}
		
		$he->doctor_id=$staff->user_id;
		$he->status_type=1;
		//return 1;
		if ($he->insert()) {
			return $this->_error_message_start . "<return_code>1</return_code><return_string>新增成功!</return_string>" . $this->_error_message_end;
		} else {
			return $this->_error_message_start . "<return_code>2</return_code><return_string>新增失败!</return_string>" . $this->_error_message_end;
		}
	}

	/*******************
	* 查询健康教育处方
	* ****************** */

	public function ws_select($token="",$xml_request) {
		$xml = new SimpleXMLElement($xml_request);
		if (!empty($xml->org_id)) {
			//机构转码
			$organization = new Torganization();
			$organization->whereAdd("standard_code='$xml->org_id'");
			$organization->find(true);
			$org_id = $organization->id;
			if (!$org_id) {
				return $this->_error_message_start . "<return_code>2</return_code><return_string>机构码不正确,或在本系统中找不到对应的机构。</return_string>" . $this->_error_message_end;
			}
		}else{
			//如果机构码为空，则直接返回
			return $this->_error_message_start . "<return_code>2</return_code><return_string>机构码不能为空！</return_string>" . $this->_error_message_end;
		}
		
		$he = new Thealth_prescription();
		//加入查询条件，org_id是必须的，其他参数可选
		//$org_id=17;
		if ($org_id) {
			$he->whereAdd("org_id='$org_id'");
		}
		if(!empty($xml->ext_uuid)){
			$he->whereAdd("ext_uuid='$xml->ext_uuid'");
		}
		$he->find();
		$xml_return = "<?xml version='1.0' encoding='UTF-8'?><table name='health_education'>";
		while ($he->fetch()) {
			$xml_return.="<row>";
			$xml_return.=$he->toXML();
			$xml_return.="</row>";
		}
		$xml_return.="</table>";
		return $xml_return;
	}

	/*******************
	* 更新健康教育处方
	* ****************** */


	public function ws_update($token="", $xml_request) {
		$xml = new SimpleXMLElement($xml_request);
		//机构转码
		if(!empty($xml->org_id)){
			$organization = new Torganization();
			$organization->whereAdd("standard_code='".trim($xml->org_id)."'");
			$organization->find(true);
			$org_id = $organization->id;
			if (!$org_id) {
				return $this->_error_message_start . "<return_code>2</return_code><return_string>机构码不正确,或者在本系统找不到该机构编码</return_string>" . $this->_error_message_end;
			}
		}else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>机构编码不能为空！</return_string>" . $this->_error_message_end;
		}
		//创建健康教育处方对象
		$he = new Thealth_prescription();
		//$he->uuid ="P_".uniqid();
		$he->edit_time = time();
		$he->org_id=$org_id;//机构
		$he->title=$xml->title;
		$he->content=$xml->content;
		//$he->ext_uuid=$xml->ext_uuid;
		$staff=new Tstaff_archive();
		$staff->whereAdd("identity_card_number='$xml->doctor_id'");
		$staff->find(true);
		if(empty($staff->user_id)){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到该医生信息！</return_string>" . $this->_error_message_end;
		}
		$he->doctor_id=$staff->user_id;
		//$he->$status_type=1;
		//$he->ext_uuid=$xml->ext_uuid;
		$he->whereAdd("ext_uuid='$xml->ext_uuid'");
		if ($he->update()) {
			return $this->_error_message_start . "<return_code>1</return_code><return_string>更新成功!</return_string>" . $this->_error_message_end;
		} else {
			return $this->_error_message_start . "<return_code>2</return_code><return_string>更新失败!</return_string>" . $this->_error_message_end;
		}
	}

	/*******************
	* 删除健康教育处方
	* ****************** */

	public function ws_delete($token="", $xml_request) {
		$he=new Thealth_prescription();
		$xml=new SimpleXMLElement($xml_request);
		if(!empty($xml->ext_uuid)){
			$he->whereAdd("ext_uuid='$xml->ext_uuid'");
			if($he->delete()){
				return $this->_error_message_start . "<return_code>1</return_code><return_string>删除成功!</return_string>" . $this->_error_message_end;
			} else {
				return $this->_error_message_start . "<return_code>2</return_code><return_string>删除失败!</return_string>" . $this->_error_message_end;
			}
		}else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>请填写删除条件</return_string>" . $this->_error_message_end;
		}
	}

}

?>