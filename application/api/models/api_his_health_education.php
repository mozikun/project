<?php

/* * **
* @author whx
* @todo 健康教育活动
* @time 2013-10-25
* *********** */
class hishealth_education{

	private $_error_message_start;
	private $_error_message_end;
	private $role_id;

	public function __construct() {

		require_once __SITEROOT . '/library/custom/comm_function.php'; //公有函数
		require_once __SITEROOT . "library/Models/organization.php"; //机构表
		require_once __SITEROOT . "library/Models/health_education.php"; //健康教育活动表
		require_once __SITEROOT . "library/Models/staff_core.php";
		require_once __SITEROOT . "library/Models/staff_archive.php";
		
		$this->_error_message_start = "<?xml version='1.0' encoding='UTF-8'?><message>";
		$this->_error_message_end = "</message>";
	}

	/*******************
	* 添加健康教育活动
	* ****************** */

	public function ws_insert($token="", $xml_request) {
		require_once __SITEROOT.'library/data_arr/arrdata.php';
		$xml = new SimpleXMLElement($xml_request);
		
		//机构转码
		if(!empty($xml->org_id)){
			$organization = new Torganization();
			$organization->whereAdd("standard_code='$xml->org_id'");
			$organization->find(true);
			$org_id = $organization->id;
			if (!$org_id) {
				return $this->_error_message_start . "<return_code>2</return_code><return_string>机构码不正确,或者在本系统找不到该机构编码</return_string>" . $this->_error_message_end;
			}
		}else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>机构编码不能为空！</return_string>" . $this->_error_message_end;
		}
		//创建健康教育对象
		$he = new Thealth_education();
		$he->uuid ="H_".uniqid();
		$he->created = time();
		$he->org_id=$org_id;//机构
		//判断活动时间是否为时间戳形式
		if(preg_match("/^\d{10}$/",$xml->activity_time)){
			$he->activity_time=$xml->activity_time;
		}else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>活动时间应该为时间戳形式</return_string>" . $this->_error_message_end;
		}
		$he->activity_address=$xml->activity_address;//活动地点
		
		//活动类型
		if(($xml->activity_type)){
			$activity_type=explode("|",$xml->activity_type);
			foreach($activity_type as $k=>$v){
				//如果未找到该活动类型，直接返回
				if(!array_search_for_other($v,$he_active_type)){
					return $this->_error_message_start . "<return_code>2</return_code><return_string>未定义的活动类型编号:".$v."，请联系平台方核对！</return_string>" . $this->_error_message_end;
				}
			}
		}else{
			if(!array_search_for_other($v,$he_active_type)){
				return $this->_error_message_start . "<return_code>2</return_code><return_string>未定义的活动类型编号:".$xml->activity_type."，请联系平台方核对！</return_string>" . $this->_error_message_end;
			}
		}
		$he->activity_type=$xml->activity_type;//活动形式,这里需要验证一下是否为规定的形式 
		$he->sponsor=$xml->sponsor;//主办单位
		$he->partner=$xml->partner;//合作伙伴
		$he->person_num=$xml->person_num;//参与人数
		$he->promo_type=$xml->promo_type;//宣传品发放种类   
		$he->promo_num=$xml->promo_num;//宣传品发放种数量
		$he->activity_theme=$xml->activity_theme;//活动主题
		
		$he->doctor=$xml->doctor;//宣传人  这里要由身份证转换而来
		$he->active_summary=$xml->active_summary;//活动小结
		$he->activity_juggde=$xml->activity_juggde;//活动评价
		if(($xml->more_info)){
			$more_info=explode("|",$xml->more_info);
			foreach($more_info as $k=>$v){
				if(!empty($v)){
					//如果未找到该材料类型，直接返回
					if(!array_search_for_other($v,$health_more_info)){
						return $this->_error_message_start . "<return_code>2</return_code><return_string>未定义的存档材料类型编号:".$v."，请联系平台方核对！</return_string>" . $this->_error_message_end;
					}
				}
			}
		}else{
			if(!array_search_for_other($v,$health_more_info)){
				return $this->_error_message_start . "<return_code>2</return_code><return_string>未定义的存档材料类型编号:".$xml->more_info."，请联系平台方核对！</return_string>" . $this->_error_message_end;
			}
		}
		$he->more_info=$xml->more_info;//活动材料 需验证
		//查询填表人
		$staff=new Tstaff_archive();
		$staff->whereAdd("identity_card_number='$xml->person_in_charge'");
		$staff->find(true);
		if($staff->user_id){
			$he->person_in_charge=$staff->user_id;//负责人 需转换
		}else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到负责人</return_string>" . $this->_error_message_end;
		}
		$he->person_category=$xml->person_category;//健康教育人员类别
		//查找负责人
		$staff=new Tstaff_archive();
		$staff->whereAdd("identity_card_number='$xml->people_fillin_form'");
		$staff->find(true);
		if($staff->user_id){
			$he->people_fillin_form=$staff->user_id;//填表人
		}else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到填表人！$xml->people_fillin_form</return_string>" . $this->_error_message_end;
		}
		$he->created=$xml->created;    //填表时间
		$he->ext_uuid=$xml->ext_uuid;
		
		if ($he->insert()) {
			return $this->_error_message_start . "<return_code>1</return_code><return_string>ext_uuid为".$xml->ext_uuid."的信息新增成功!</return_string>" . $this->_error_message_end;
		} else {
			return $this->_error_message_start . "<return_code>2</return_code><return_string>ext_uuid为".$xml->ext_uuid."的信息新增失败!</return_string>" . $this->_error_message_end;
		}
	}

	/*******************
	* 查询健康教育活动
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
		
		$he = new Thealth_education();
		//加入查询条件，org_id是必须的，其他参数可选
		//$org_id=17;
		if ($org_id) {
			$he->whereAdd("org_id='$org_id'");
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
	* 更新健康教育活动
	* ****************** */


	public function ws_update($token="", $xml_request) {
		$xml = new SimpleXMLElement($xml_request);
		
		//机构转码
		if(!empty($xml->org_id)){
			$organization = new Torganization();
			$organization->whereAdd("standard_code='$xml->org_id'");
			$organization->find(true);
			$org_id = $organization->id;
			if (empty($org_id)) {
				return $this->_error_message_start . "<return_code>2</return_code><return_string>机构码不正确,或者在本系统找不到该机构编码</return_string>" . $this->_error_message_end;
			}
		}else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>机构编码不能为空！</return_string>" . $this->_error_message_end;
		}
		//创建健康教育对象
		$he = new Thealth_education();
		$he->uuid ="H_".uniqid();
		$he->created = time();
		$he->org_id=$org_id;//机构
		//判断活动时间是否为时间戳形式
		if(preg_match("/^\d{10}$/",$xml->activity_time)){
			$he->activity_time=$xml->activity_time;
		}else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>活动时间应该为时间戳形式</return_string>" . $this->_error_message_end;
		}
		$he->activity_address=$xml->activity_address;//活动地点
		
		//活动类型
		if(($xml->activity_type)){
			$activity_type=explode("|",$xml->activity_type);
			foreach($activity_type as $k=>$v){
				//如果未找到该活动类型，直接返回
				if(!array_search_for_other($v,$he_active_type)){
					return $this->_error_message_start . "<return_code>2</return_code><return_string>未定义的活动类型编号:".$v."，请联系平台方核对！</return_string>" . $this->_error_message_end;
				}
			}
		}else{
			if(!array_search_for_other($v,$he_active_type)){
				return $this->_error_message_start . "<return_code>2</return_code><return_string>未定义的活动类型编号:".$xml->activity_type."，请联系平台方核对！</return_string>" . $this->_error_message_end;
			}
		}
		$he->activity_type=$xml->activity_type;//活动形式,这里需要验证一下是否为规定的形式 
		$he->sponsor=$xml->sponsor;//主办单位
		$he->partner=$xml->partner;//合作伙伴
		$he->person_num=$xml->person_num;//参与人数
		$he->promo_type=$xml->promo_type;//宣传品发放种类   
		$he->promo_num=$xml->promo_num;//宣传品发放种数量
		$he->activity_theme=$xml->activity_theme;//活动主题
		
		$he->doctor=$xml->doctor;//宣传人  这里要由身份证转换而来
		$he->active_summary=$xml->active_summary;//活动小结
		$he->activity_juggde=$xml->activity_juggde;//活动评价
		if(($xml->more_info)){
			$more_info=explode("|",$xml->more_info);
			foreach($more_info as $k=>$v){
				if(!empty($v)){
					//如果未找到该材料类型，直接返回
					if(!array_search_for_other($v,$health_more_info)){
						return $this->_error_message_start . "<return_code>2</return_code><return_string>未定义的存档材料类型编号:".$v."，请联系平台方核对！</return_string>" . $this->_error_message_end;
					}
				}
			}
		}else{
			if(!array_search_for_other($v,$health_more_info)){
				return $this->_error_message_start . "<return_code>2</return_code><return_string>未定义的存档材料类型编号:".$xml->more_info."，请联系平台方核对！</return_string>" . $this->_error_message_end;
			}
		}
		$he->more_info=$xml->more_info;//活动材料 需验证
		//查询填表人
		$staff=new Tstaff_archive();
		$staff->whereAdd("identity_card_number='$xml->person_in_charge'");
		$staff->find(true);
		if($staff->user_id){
			$he->person_in_charge=$staff->user_id;//负责人 需转换
		}else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到负责人</return_string>" . $this->_error_message_end;
		}
		$he->person_category=$xml->person_category;//健康教育人员类别
		//查找负责人
		$staff=new Tstaff_archive();
		$staff->whereAdd("identity_card_number='$xml->people_fillin_form'");
		$staff->find(true);
		if($staff->user_id){
			$he->people_fillin_form=$staff->user_id;//填表人
		}else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到填表人！$xml->people_fillin_form</return_string>" . $this->_error_message_end;
		}
		$he->created=$xml->created;    //填表时间
		$he->whereAdd("ext_uuid='$xml->ext_uuid'");
		if ($he->update()) {
			return $this->_error_message_start . "<return_code>1</return_code><return_string>更新成功!</return_string>" . $this->_error_message_end;
		} else {
			return $this->_error_message_start . "<return_code>2</return_code><return_string>更新失败!</return_string>" . $this->_error_message_end;
		}
	}

	/*******************
	* 删除健康教育活动
	* ****************** */

	public function ws_delete($token="", $xml_request) {
		$he=new Thealth_education();
		$xml=SimpleXMLElement($xml_request);
		$he->whereAdd("ext_uuid='$xml->ext_uuid'");
		if($he->delete()){
			return $this->_error_message_start . "<return_code>1</return_code><return_string>ext_uuid为".$xml->ext_uuid."的信息删除成功!</return_string>" . $this->_error_message_end;
		} else {
			return $this->_error_message_start . "<return_code>2</return_code><return_string>ext_uuid为".$xml->ext_uuid."的信息删除失败!</return_string>" . $this->_error_message_end;
		}
	}

}

?>