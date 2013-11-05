<?php

/* * **
* @author whx
* @todo 健康教育处方
* @time 2013-10-25
* *********** */
require_once __SITEROOT . "application/api/models/base.php";//接口返回信息
class hishealth_prescription extends base{

	private $_error_message_start;
	private $_error_message_end;
	private $role_id;

	public function __construct() {

		require_once __SITEROOT . '/library/custom/comm_function.php'; //公有函数
		require_once __SITEROOT . "library/Models/organization.php"; //机构表
		require_once __SITEROOT . "library/Models/health_prescription.php"; //健康教育处方
		require_once __SITEROOT . "library/Models/staff_archive.php";
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
				return $this->api_failure("机构码不正确,或者在本系统找不到该机构编码");
			}
		}else{
			return $this->api_failure("机构编码不能为空！");
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
			return $this->api_failure("未找到该医生信息！");
		}
		
		$he->doctor_id=$staff->user_id;
		$he->status_type=1;
		//return 1;
		if ($he->insert()) {
			return $this->api_success("新增成功!");
		} else {
			return $this->api_failure("新增失败!");
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
			if (empty($org_id)) {
				return $this->api_failure("机构码不正确,或在本系统中找不到对应的机构。");
			}
		}else{
			//如果机构码为空，则直接返回
			return $this->api_failure("机构码不能为空！");
		}
		
		$he = new Thealth_prescription();
		//加入查询条件，org_id是必须的，其他参数可选
		//$org_id=17;
		if (!empty($org_id)) {
			$he->whereAdd("org_id='$org_id'");
		}
		if(!empty($xml->ext_uuid)){
			$he->whereAdd("ext_uuid='$xml->ext_uuid'");
		}
		if($he->count()==0){
			return $this->api_failure("查询失败，没有任何信息");
		}
		$he->find();
		$xml_return = "<table name='health_prescription'>";
	    //不输出的字段
		$ext=array("uuid");
		while ($he->fetch()) {
			$xml_return.="<row>";
			//机构转码
			$organization = new Torganization();
			$organization->whereAdd("id='$he->org_id'");
			$organization->find(true);
			$he->org_id = $organization->standard_code;
			//查询医生身份证号
			$staff=new Tstaff_archive();
			$staff->where("user_id='$he->doctor_id'");
			$staff->find(true);
			$he->doctor_id=$staff->identity_card_number;
			$xml_return.=$he->toXML("",array("uuid","views","status_type"));
			$xml_return.="</row>";
		}
		$xml_return.="</table>";
		return $this->api_success("查询成功！",$xml_return);
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
				return $this->api_failure("机构码不正确,或者在本系统找不到该机构编码");
			}
		}else{
			return $this->api_failure("机构编码不能为空！");
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
			return $this->api_failure("未找到该医生信息！");
		}
		$he->doctor_id=$staff->user_id;
		//$he->$status_type=1;
		//$he->ext_uuid=$xml->ext_uuid;
		$he->whereAdd("ext_uuid='$xml->ext_uuid'");
		if ($he->update()) {
			return $this->api_success("更新成功!");
		} else {
			return $this->api_failure("更新失败!");
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
				return $this->api_success("删除成功!");
			} else {
				return $this->api_failure("删除失败!");
			}
		}else{
			return $this->api_failure("请填写删除条件");
		}
	}

}

?>