<?php

/*
 * @author whx
 * @todo 预防接种卡
 * @time 2013-1-8
 * 
 */
require_once __SITEROOT . "application/api/models/api_phs_iha_comm.php";

class hisvaccinate extends api_phs_comm
{
    
    private $_error_message_start;
    private $_error_message_end;
    private $role_id;

    public function __construct()
    {
        require_once __SITEROOT . '/library/custom/comm_function.php'; //公有函数
        require_once __SITEROOT . "library/Models/organization.php"; //机构表
        require_once __SITEROOT . "application/api/models/api_phs_common.php";
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
        require_once __SITEROOT . "library/Models/vac_card.php"; //预防接种主表
        require_once __SITEROOT . "library/Models/vac_info.php"; //预防接种从表1
        require_once __SITEROOT . "library/Models/vac_second_info.php"; //预防接种从表2
		require_once __SITEROOT . "library/Models/individual_core.php"; //预防接种从表2
		require_once __SITEROOT . "library/Models/staff_archive.php"; 
        $this->_error_message_start = "<?xml version='1.0' encoding='UTF-8'?><message>";
        $this->_error_message_end = "</message>";
       
    }
    
    /**
     * 取某个机构下边的所有人的uuid 身份证号 和 org_id
     * (2013年5月8号新增 为了让中联能取到平台中的预防接种数据  业务号为平台数据的uuid 为了调用下边的ws_select_single接口)
     */
    function ws_select_all($token,$xml_string)
    {
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
				//取得做过预防接种随访的人
				$vac_card = new Tvac_card();
				$vac_card->query("select count(*) as cou from vac_card where vac_card.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
				$vac_card->fetch();
				$number = $vac_card->cou;
				if($number>0)
				{
					$vac_card_select = new Tvac_card();
					$vac_card_select->query("select * from vac_card where vac_card.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number')");//没有剔除死亡的人
					$response_str = '';
				    while ($vac_card_select->fetch())
				    {
				    	$response_str.='<row>';
				    	$ext_uuid = $vac_card_select->uuid;
			            //取得这个人的身份证号
			            $individual_core = new Tindividual_core();
			            $individual_core->whereAdd("uuid='$vac_card_select->id'");
			            $individual_core->find(true);
			            $identity_number = $individual_core->identity_number;
				    	$response_str.='<identity_number>'.$identity_number.'</identity_number>';
				    	$response_str.='<org_id>'.$org_id.'</org_id>';
				    	if($vac_card_select->ext_uuid=='')
				    	{
				    	  $response_str.='<ext_uuid>'.$ext_uuid.'</ext_uuid>';
				    	}
				    	else 
				    	{
				    		$response_str.='<ext_uuid>'.$vac_card_select->ext_uuid.'</ext_uuid>';
				    	}
				    	$response_str.='</row>';
				    	$individual_core->free_statement();
				    }
				    $vac_card_select->free_statement();
				    return $xmlhead.$response_str.$xmlend;
				}
				else 
				{
					return $xmlhead."<return_code>2</return_code><return_string>机构号为".$org_id."的机构没有查询到预防接种数据</return_string>".$xmlend;
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
     * (2013年5月10号新增 为了让中联能取到平台中的预防接种数据  业务号为平台数据的uuid 为了调用下边的ws_select_single接口)
     */
    function ws_select_persons($token,$xml_string)
    {
    	require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/vac_card.php";
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
		//取得这个身份证和机构联查得到的所有预防接种随访数据
		$vac_card = new Tvac_card();
		$vac_card->query("select count(*) as cou from vac_card where vac_card.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number' and individual_core.identity_number='$identity_number')");
		$vac_card->fetch();
		$count = $vac_card->cou;
		if($count>0)
		{   
			$response_str = '';
			$vac_card_select = new Tvac_card();
			$vac_card_select->query("select * from vac_card where vac_card.id in (select individual_core.uuid from individual_core where individual_core.org_id='$org_id_number' and individual_core.identity_number='$identity_number')");
			while ($vac_card_select->fetch())
			{
				$response_str.='<row>';
				$ext_uuid = $vac_card_select->uuid;
	            //取得这个人的身份证号
	            $individual_core = new Tindividual_core();
	            $individual_core->whereAdd("uuid='$vac_card_select->id'");
	            $individual_core->find(true);
	            $identity_number = $individual_core->identity_number;
		    	$response_str.='<identity_number>'.$identity_number.'</identity_number>';
		    	$response_str.='<org_id>'.$org_id.'</org_id>';
		    	if($vac_card_select->ext_uuid=='')
		    	{
		    	  $response_str.='<ext_uuid>'.$ext_uuid.'</ext_uuid>';
		    	}
		    	else 
		    	{
		    		$response_str.='<ext_uuid>'.$vac_card_select->ext_uuid.'</ext_uuid>';
		    	}
		    	$response_str.='</row>';
		    	$individual_core->free_statement();	
			}
			$vac_card_select->free_statement();
			return $xmlhead.$response_str.$xmlend;
		}
		else 
		{
			return $xmlhead."<return_code>2</return_code><return_string>身份证为".$identity_number."，机构号为".$org_id."的预防接种数据未查询到！</return_string>".$xmlend;
		}
    }
    /* **********************
     * 查询预防接种信息
     * @param string $token
     * @param string $xml_string
     * ******************* */

    public function ws_select_single($token, $xml_string)
    {    
    	$xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
		$xmlend  = "</message>";
		$myarray=array('uuid','id','sex');//需要排除的字段
		$table_array=array('vac_info'=>'预防接种从表1','vac_second_info'=>'预防接种从表2');
		//条件不为空时，解析查询条件
        $where_xml = new SimpleXMLElement($xml_string);
        $get_orgid = $where_xml->org_id;
        $get_ext_uuid = $where_xml->ext_uuid;
        $get_identity_number = $where_xml->identity_number;
        if(empty($get_ext_uuid))
		{
			return $xmlhead."<return_code>2</return_code><return_string>业务号不存在</return_string>".$xmlend;
		}
		//通过standard_code查找我们系统中对应的机构ID
		$ourorg = new Torganization();
		$ourorg->whereAdd("standard_code='$get_orgid'");
		$ourorg->find(true);
		$myorgid = $ourorg->id;
		//判断在个人信息表中是否存在该数据（不存在不能传数据）
		$individual_core = new Tindividual_core();
		$individual_core->whereAdd("identity_number='$get_identity_number'");
		$individualNumber = $individual_core->count();
		if($individualNumber!=1)
		{
			return $xmlhead."<return_code>2</return_code><return_string>身份证号为".$get_identity_number."的个人基本档案不存在</return_string>".$xmlend;
		}
		else
		{	
			$individual     = new Tindividual_core();
			$individual->whereAdd("identity_number='$get_identity_number'");
			$individual->find(true);
			$individual_id  = $individual->uuid;
			//判断有当前这个数据没有
			$match_array = preg_match_all('~^va.*?\..*?$~',$get_ext_uuid,$my_array);//判断是中联数据还是平台数据
			if(empty($my_array[0][0]))
			{
				$tag=true;
			}
			else 
			{
				$tag=false;
			}
			$core = new Tvac_card();
			if($tag)
			{
				$core->whereAdd("id='$individual_id'");
				$core->whereAdd("ext_uuid='$get_ext_uuid'");
				$core->whereAdd("org_id='$myorgid'");
			}
			else 
			{
				$core->whereAdd("uuid='$get_ext_uuid'");
			}
			if($core->count()!=1)
			{
				return $xmlhead."<return_code>2</return_code><return_string>身份证为".$get_identity_number.",业务号为".$get_ext_uuid.",机构号为".$get_orgid."的预防接种随访数据不存在</return_string>".$xmlend;
			}
			else 
			{
				$tag_name = new Tvac_card();
				if($tag)
				{
					$tag_name->whereAdd("id='$individual_id'");
					$tag_name->whereAdd("ext_uuid='$get_ext_uuid'");
					$tag_name->whereAdd("org_id='$myorgid'");
				}
				else 
				{
					$tag_name->whereAdd("uuid='$get_ext_uuid'");
				}
				$tag_name->find(true);
				//反查预防接种的主表找到主表的UUID		
				if($tag)
				{	
					$et_uuid = $tag_name->uuid; 
				}
				else 
				{
					$et_uuid = $get_ext_uuid;
				}
				$response = "<?xml version='1.0' encoding='UTF-8'?><tables>";
				$response.="<table name='vac_card'><row><identity_number>".$get_identity_number."</identity_number>";
				//转换orgid
			    $tag_name->org_id = $get_orgid;
			   //转换staffid
				$staff_archive=new Tstaff_archive();
				$staff_archive->whereAdd("user_id='$tag_name->staff_id'");
				$staff_archive->find(true);
				$staff_identity_number = $staff_archive->identity_card_number;
				$tag_name->staff_id = $staff_identity_number;
                if(!$tag)
			   {
			   	 $tag_name->ext_uuid = $get_ext_uuid;
			   }
				$response.=$tag_name->toXML('',$myarray);
				$response.="</row></table>";	
				//创建其他表数据
				foreach($table_array as $table=>$tablecomment)
				{
						$tablobjname =  "T".$table;
						$tablobj     =  new $tablobjname();
						$tablobj->whereAdd("uuid='$et_uuid'");
						if($tablobj->count()>0)
						{
							$tablobj->find();
							while($tablobj->fetch())
							{			   
						   	     $tablobj->org_id = $get_orgid;
							   	  //转换医生id
								 $staff_archive=new Tstaff_archive();
								 $staff_archive->whereAdd("user_id='$tablobj->staff_id'");
								 $staff_archive->find(true);
								 $staff_identity_number = $staff_archive->identity_card_number;
								 $tablobj->staff_id = $staff_identity_number;
							     $response.="<table name='$table'><row><identity_number>".$get_identity_number."</identity_number>";         
							     if(!$tag)
							     {
							   	  $tablobj->ext_uuid = $et_uuid;
							     }
							     $response.=$tablobj->toXML('',$myarray);
							     $response.="</row></table>";
							}
						}
				}
				$response.="</tables>";
				return $response;
			}
		}  
    }

    /* ***************************
     * 添加、修改预防接种信息
     * ************************** */

    public function vaccinate_update($token, $xml_string)
    {   
	
	    
        $xml = new SimpleXMLElement($xml_string);
		
		 if (empty($xml->id))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>个人档案号不能为空</return_string>" . $this->_error_message_end; //错误，请提供业务号ext_uuid
        }
		if (empty($xml->ext_uuid))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>ext_uuid不能为空</return_string>" . $this->_error_message_end; 
        }
		$core=new Tindividual_core();
		$core->whereAdd("uuid='$xml->id'");
		if($core->count()<1){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到该居民</return_string>" . $this->_error_message_end;
		}
		//$uuid=$this->_request->getParam("id",'');
		$_uid=uniqid('va',true);//档案唯一编码
		
		$time = time();
		//预防接种卡主表
		$vac_card = new Tvac_card();
		$vac_card->ext_uuid = $xml->ext_uuid;//
		
		
	 	 $vac_card->staff_id = $xml->staff_id;//

		 $vac_card->id = $xml->id;//

		 $vac_card->sex = $xml->sex;//

		 $vac_card->date_of_birth = check_utime($xml->date_of_birth);//

		 $vac_card->guardian = $xml->guardian;//

		 $vac_card->relation = $xml->relation;//

		 $vac_card->telephone = $xml->telephone;//

		 $vac_card->family_address_city = $xml->family_address_city;//

		 $vac_card->family_address_street = $xml->family_address_street;//

		 $vac_card->census_register = $xml->census_register;//

		 $vac_card->census_register_province = $xml->census_register_province;//

		 $vac_card->census_register_city = $xml->census_register_city;//

		 $vac_card->census_register_area = $xml->census_register_area;//

		 $vac_card->census_register_street = $xml->census_register_street;//

		 $vac_card->immigration_time = check_utime($xml->immigration_time);//

		 $vac_card->emigration_time = check_utime($xml->emigration_time);//

		 $vac_card->emigration_cause = $xml->emigration_cause;//

		 $vac_card->vaccinum_unusual_history = $xml->vaccinum_unusual_history;//

		  $vac_card->vaccinate_no_no = $xml->vaccinate_no_no;//

		  $vac_card->infect_history = $xml->infect_history;//
		  $vac_card->created_card_time = check_utime($xml->created_card_time);//
		  $vac_card->created_doc = $xml->created_doc;// 
		
		//疫苗信息
		$vac_info = new Tvac_info();
		//$vac_info->uuid = $xml->uuid;//
        $vac_info->ext_uuid = $xml->ext_uuid;//
		$vac_info->id = $xml->id;//

		//$vac_info->created = $time;//

		$vac_info->hepatitis_time_1 = check_utime($xml->hepatitis_time_1);//

		$vac_info->hepatitis_part_1 = $xml->hepatitis_part_1;//

		$vac_info->hepatitis_batch_1 = $xml->hepatitis_batch_1;//

		$vac_info->hepatitis_effective_1 = check_utime($xml->hepatitis_effective_1);//

		$vac_info->hepatitis_enterprises_1 = $xml->hepatitis_enterprises_1;//

		$vac_info->hepatitis_doctor_1 = $xml->hepatitis_doctor_1;//

		$vac_info->hepatitis_remark_1 = $xml->hepatitis_remark_1;//

		$vac_info->hepatitis_time_2 = check_utime($xml->hepatitis_time_2);//

		$vac_info->hepatitis_part_2 = $xml->hepatitis_part_2;//

		$vac_info->hepatitis_batch_2 = $xml->hepatitis_batch_2;//

		$vac_info->hepatitis_effective_2 = check_utime($xml->hepatitis_effective_2);//

		$vac_info->hepatitis_enterprises_2 = $xml->hepatitis_enterprises_2;//

		$vac_info->hepatitis_doctor_2 = $xml->hepatitis_doctor_2;//

		$vac_info->hepatitis_remark_2 = $xml->hepatitis_remark_2;//

		$vac_info->hepatitis_time_3 = check_utime($xml->hepatitis_time_3);//

		$vac_info->hepatitis_part_3 = $xml->hepatitis_part_3;//

		$vac_info->hepatitis_batch_3 = $xml->hepatitis_batch_3;//

		$vac_info->hepatitis_effective_3 = check_utime($xml->hepatitis_effective_3);//

		$vac_info->hepatitis_enterprises_3 = $xml->hepatitis_enterprises_3;//

		$vac_info->hepatitis_doctor_3 = $xml->hepatitis_doctor_3;//

		$vac_info->hepatitis_remark_3 = $xml->hepatitis_remark_3;//

		$vac_info->bcg_time = check_utime($xml->bcg_time);//

		$vac_info->bcg_part = $xml->bcg_part;//

		$vac_info->bcg_batch = $xml->bcg_batch;//

		$vac_info->bcg_effective = check_utime($xml->bcg_effective);//

		$vac_info->bcg_enterprises = $xml->bcg_enterprises;//

		$vac_info->bcg_doctor = $xml->bcg_doctor;//

		$vac_info->bcg_remark = $xml->bcg_remark;//

		$vac_info->polio_time_1 = check_utime($xml->polio_time_1);//

		$vac_info->polio_part_1 = $xml->polio_part_1;//

		$vac_info->polio_batch_1 = $xml->polio_batch_1;//

		$vac_info->polio_effective_1 = check_utime($xml->polio_effective_1);//

		$vac_info->polio_enterprises_1 = $xml->polio_enterprises_1;//

		$vac_info->polio_doctor_1 = $xml->polio_doctor_1;//

		$vac_info->polio_remark_1 = $xml->polio_remark_1;//

		$vac_info->polio_time_2 = check_utime($xml->polio_time_2);//

		$vac_info->polio_part_2 = $xml->polio_part_2;//

		$vac_info->polio_batch_2 = $xml->polio_batch_2;//

		$vac_info->polio_effective_2 = check_utime($xml->polio_effective_2);//

		$vac_info->polio_enterprises_2 = $xml->polio_enterprises_2;//

		$vac_info->polio_doctor_2 = $xml->polio_doctor_2;//

		$vac_info->polio_remark_2 = $xml->polio_remark_2;//

		$vac_info->polio_time_3 = check_utime($xml->polio_time_3);//

		$vac_info->polio_part_3 = $xml->polio_part_3;//

		$vac_info->polio_batch_3 = $xml->polio_batch_3;//

		$vac_info->polio_effective_3 = check_utime($xml->polio_effective_3);//

		$vac_info->polio_enterprises_3 = $xml->polio_enterprises_3;//

		$vac_info->polio_doctor_3 = $xml->polio_doctor_3;//

		$vac_info->polio_remark_3 = $xml->polio_remark_3;//

		$vac_info->polio_time_4 = check_utime($xml->polio_time_4);//

		$vac_info->polio_part_4 = $xml->polio_part_4;//

		$vac_info->polio_batch_4 = $xml->polio_batch_4;//

		$vac_info->polio_effective_4 = check_utime($xml->polio_effective_4);//

		$vac_info->polio_enterprises_4 = $xml->polio_enterprises_4;//

		$vac_info->polio_doctor_4 = $xml->polio_doctor_4;//

		$vac_info->polio_remark_4 = $xml->polio_remark_4;//

		$vac_info->dpt_time_1 = check_utime($xml->dpt_time_1);//

		$vac_info->dpt_part_1 = $xml->dpt_part_1;//

		$vac_info->dpt_batch_1 = $xml->dpt_batch_1;//

		$vac_info->dpt_effective_1 = check_utime($xml->dpt_effective_1);//

		$vac_info->dpt_enterprises_1 = $xml->dpt_enterprises_1;//

		$vac_info->dpt_doctor_1 = $xml->dpt_doctor_1;//

		$vac_info->dpt_remark_1 = $xml->dpt_remark_1;//

		$vac_info->dpt_time_2 = check_utime($xml->dpt_time_2);//

		$vac_info->dpt_part_2 = $xml->dpt_part_2;//

		$vac_info->dpt_batch_2 = $xml->dpt_batch_2;//

		$vac_info->dpt_effective_2 = check_utime($xml->dpt_effective_2);//

		$vac_info->dpt_enterprises_2 = $xml->dpt_enterprises_2;//

		$vac_info->dpt_doctor_2 = $xml->dpt_doctor_2;//

		$vac_info->dpt_remark_2 = $xml->dpt_remark_2;//

		$vac_info->dpt_time_3 = check_utime($xml->dpt_time_3);//

		$vac_info->dpt_part_3 = $xml->dpt_part_3;//

		$vac_info->dpt_batch_3 = $xml->dpt_batch_3;//

		$vac_info->dpt_effective_3 = check_utime($xml->dpt_effective_3);//

		$vac_info->dpt_enterprises_3 = $xml->dpt_enterprises_3;//

		$vac_info->dpt_doctor_3 = $xml->dpt_doctor_3;//

		$vac_info->dpt_remark_3 = $xml->dpt_remark_3;//

		$vac_info->dpt_time_4 = check_utime($xml->dpt_time_4);//

		$vac_info->dpt_part_4 = $xml->dpt_part_4;//

		$vac_info->dpt_batch_4 = $xml->dpt_batch_4;//

		$vac_info->dpt_effective_4 = check_utime($xml->dpt_effective_4);//

		$vac_info->dpt_enterprises_4 = $xml->dpt_enterprises_4;//

		$vac_info->dpt_doctor_4 = $xml->dpt_doctor_4;//

		$vac_info->dpt_remark_4 = $xml->dpt_remark_4;//

		$vac_info->rubella_time = check_utime($xml->rubella_time);//

		$vac_info->rubella_part = $xml->rubella_part;//

		$vac_info->rubella_batch = $xml->rubella_batch;//

		$vac_info->rubella_effective = check_utime($xml->rubella_effective);//

		$vac_info->rubella_enterprises = $xml->rubella_enterprises;//

		$vac_info->rubella_doctor = $xml->rubella_doctor;//

		$vac_info->rubella_remark = $xml->rubella_remark;//

		$vac_info->lepra_time = check_utime($xml->lepra_time);//

		$vac_info->lepra_part = $xml->lepra_part;//

		$vac_info->lepra_batch = $xml->lepra_batch;//

		$vac_info->lepra_effective = check_utime($xml->lepra_effective);//

		$vac_info->lepra_enterprises = $xml->lepra_enterprises;//

		$vac_info->lepra_doctor = $xml->lepra_doctor;//

		$vac_info->lepra_remark = $xml->lepra_remark;//

		$vac_info->mmr_time_1 = check_utime($xml->mmr_time_1);//

		$vac_info->mmr_part_1 = $xml->mmr_part_1;//

		$vac_info->mmr_batch_1 = $xml->mmr_batch_1;//

		$vac_info->mmr_effective_1 = check_utime($xml->mmr_effective_1);//

		$vac_info->mmr_enterprises_1 = $xml->mmr_enterprises_1;//

		$vac_info->mmr_doctor_1 = $xml->mmr_doctor_1;//

		$vac_info->mmr_remark_1 = $xml->mmr_remark_1;//

		$vac_info->mmr_time_2 = check_utime($xml->mmr_time_2);//

		$vac_info->mmr_part_2 = $xml->mmr_part_2;//

		$vac_info->mmr_batch_2 = $xml->mmr_batch_2;//

		$vac_info->mmr_effective_2 = check_utime($xml->mmr_effective_2);//

		$vac_info->mmr_enterprises_2 = $xml->mmr_enterprises_2;//

		$vac_info->mmr_doctor_2 = $xml->mmr_doctor_2;//

		$vac_info->mmr_remark_2 = $xml->mmr_remark_2;//

		$vac_info->mm_time = check_utime($xml->mm_time);//

		$vac_info->mm_part = $xml->mm_part;//

		$vac_info->mm_batch = $xml->mm_batch;//

		$vac_info->mm_effective = check_utime($xml->mm_effective);//

		$vac_info->mm_enterprises = $xml->mm_enterprises;//

		$vac_info->mm_doctor = $xml->mm_doctor;//

		$vac_info->mm_remark = $xml->mm_remark;//

		$vac_info->measles_time_1 = check_utime($xml->measles_time_1);//

		$vac_info->measles_part_1 = $xml->measles_part_1;//

		$vac_info->measles_batch_1 = $xml->measles_batch_1;//

		$vac_info->measles_effective_1 = check_utime($xml->measles_effective_1);//

		$vac_info->measles_enterprises_1 = $xml->measles_enterprises_1;//

		$vac_info->measles_doctor_1 = $xml->measles_doctor_1;//

		$vac_info->measles_remark_1 = $xml->measles_remark_1;//

		$vac_info->measles_time_2 = check_utime($xml->measles_time_2);//

		$vac_info->measles_part_2 = $xml->measles_part_2;//

		$vac_info->measles_batch_2 = $xml->measles_batch_2;//

		$vac_info->measles_effective_2 = check_utime($xml->measles_effective_2);//

		$vac_info->measles_enterprises_2 = $xml->measles_enterprises_2;//

		$vac_info->measles_doctor_2 = $xml->measles_doctor_2;//

		$vac_info->measles_remark_2 = $xml->measles_remark_2;//

		$vac_info->a_time_1 = check_utime($xml->a_time_1);//

		$vac_info->a_part_1 = $xml->a_part_1;//

		$vac_info->a_batch_1 = $xml->a_batch_1;//

		$vac_info->a_effective_1 = check_utime($xml->a_effective_1);//

		$vac_info->a_enterprises_1 = $xml->a_enterprises_1;//

		$vac_info->a_doctor_1 = $xml->a_doctor_1;//

		$vac_info->a_remark_1 = $xml->a_remark_1;//

		$vac_info->a_time_2 = check_utime($xml->a_time_2);//

		$vac_info->a_part_2 = $xml->a_part_2;//

		$vac_info->a_batch_2 = $xml->a_batch_2;//

		$vac_info->a_effective_2 = check_utime($xml->a_effective_2);//

		$vac_info->a_enterprises_2 = $xml->a_enterprises_2;//

		$vac_info->a_doctor_2 = $xml->a_doctor_2;//

		$vac_info->a_remark_2 = $xml->a_remark_2;//

		$vac_info->ac_time_1 = check_utime($xml->ac_time_1);//

		$vac_info->ac_part_1 = $xml->ac_part_1;//

		$vac_info->ac_batch_1 = $xml->ac_batch_1;//

		$vac_info->ac_effective_1 = check_utime($xml->ac_effective_1);//

		$vac_info->ac_enterprises_1 = $xml->ac_enterprises_1;//

		$vac_info->ac_doctor_1 = $xml->ac_doctor_1;//

		$vac_info->ac_remark_1 = $xml->ac_remark_1;//

		$vac_info->ac_time_2 = check_utime($xml->ac_time_2);//

		$vac_info->ac_part_2 = $xml->ac_part_2;//

		$vac_info->ac_batch_2 = $xml->ac_batch_2;//

		$vac_info->ac_effective_2 = check_utime($xml->ac_effective_2);//

		$vac_info->ac_enterprises_2 = $xml->ac_enterprises_2;//

		$vac_info->ac_doctor_2 = $xml->ac_doctor_2;//

		$vac_info->ac_remark_2 = $xml->ac_remark_2;//

		$vac_info->att_time_1 = check_utime($xml->att_time_1);//

		$vac_info->att_part_1 = $xml->att_part_1;//

		$vac_info->att_batch_1 = $xml->att_batch_1;//

		$vac_info->att_effective_1 = check_utime($xml->att_effective_1);//

		$vac_info->att_enterprises_1 = $xml->att_enterprises_1;//

		$vac_info->att_doctor_1 = $xml->att_doctor_1;//

		$vac_info->att_remark_1 = $xml->att_remark_1;//

		$vac_info->att_time_2 = check_utime($xml->att_time_2);//

		$vac_info->att_part_2 = $xml->att_part_2;//

		$vac_info->att_batch_2 = $xml->att_batch_2;//

		$vac_info->att_effective_2 = check_utime($xml->att_effective_2);//

		$vac_info->att_enterprises_2 = $xml->att_enterprises_2;//

		$vac_info->att_doctor_2 = $xml->att_doctor_2;//

		$vac_info->att_remark_2 = $xml->att_remark_2;//

		$vac_info->ina_time_1 = check_utime($xml->ina_time_1);//

		$vac_info->ina_part_1 = $xml->ina_part_1;//

		$vac_info->ina_batch_1 = $xml->ina_batch_1;//

		$vac_info->ina_effective_1 = check_utime($xml->ina_effective_1);//

		$vac_info->ina_enterprises_1 = $xml->ina_enterprises_1;//

		$vac_info->ina_doctor_1 = $xml->ina_doctor_1;//

		$vac_info->ina_remark_1 = $xml->ina_remark_1;//

		$vac_info->ina_time_2 = check_utime($xml->ina_time_2);//

		$vac_info->ina_part_2 = $xml->ina_part_2;//

		$vac_info->ina_batch_2 = $xml->ina_batch_2;//

		$vac_info->ina_effective_2 = check_utime($xml->ina_effective_2);//

		$vac_info->ina_enterprises_2 = $xml->ina_enterprises_2;//

		$vac_info->ina_doctor_2 = $xml->ina_doctor_2;//

		$vac_info->ina_remark_2 = $xml->ina_remark_2;//


		$vac_info->ina_time_3 = check_utime($xml->ina_time_3);//

		$vac_info->ina_part_3 = $xml->ina_part_3;//

		$vac_info->ina_batch_3 = $xml->ina_batch_3;//

		$vac_info->ina_effective_3 = check_utime($xml->ina_effective_3);//

		$vac_info->ina_enterprises_3 = $xml->ina_enterprises_3;//

		$vac_info->ina_doctor_3 = $xml->ina_doctor_3;//

		$vac_info->ina_remark_3 = $xml->ina_remark_3;//

		$vac_info->ina_time_4 = check_utime($xml->ina_time_4);//

		$vac_info->ina_part_4 = $xml->ina_part_4;//

		$vac_info->ina_batch_4 = $xml->ina_batch_4;//

		$vac_info->ina_effective_4 = check_utime($xml->ina_effective_4);//

		$vac_info->ina_enterprises_4 = $xml->ina_enterprises_4;//

		$vac_info->ina_doctor_4 = $xml->ina_doctor_4;//

		$vac_info->ina_remark_4 = $xml->ina_remark_4;//



		$vac_info->hepatt_time = check_utime($xml->hepatt_time);//

		$vac_info->hepatt_part = $xml->hepatt_part;//

		$vac_info->hepatt_batch = $xml->hepatt_batch;//

		$vac_info->hepatt_effective = check_utime($xml->hepatt_effective);//

		$vac_info->hepatt_enterprises = $xml->hepatt_enterprises;//

		$vac_info->hepatt_doctor = $xml->hepatt_doctor;//

		$vac_info->hepatt_remark = $xml->hepatt_remark;//

		$vac_info->hepa_time_1 = check_utime($xml->hepa_time_1);//

		$vac_info->hepa_part_1 = $xml->hepa_part_1;//

		$vac_info->hepa_batch_1 = $xml->hepa_batch_1;//

		$vac_info->hepa_effective_1 = check_utime($xml->hepa_effective_1);//

		$vac_info->hepa_enterprises_1 = $xml->hepa_enterprises_1;//

		$vac_info->hepa_doctor_1 = $xml->hepa_doctor_1;//

		$vac_info->hepa_remark_1 = $xml->hepa_remark_1;//

		$vac_info->hepa_time_2 = check_utime($xml->hepa_time_2);//

		$vac_info->hepa_part_2 = $xml->hepa_part_2;//

		$vac_info->hepa_batch_2 = $xml->hepa_batch_2;//

		$vac_info->hepa_effective_2 = check_utime($xml->hepa_effective_2);//

		$vac_info->hepa_enterprises_2 = $xml->hepa_enterprises_2;//

		$vac_info->hepa_doctor_2 = $xml->hepa_doctor_2;//

		$vac_info->hepa_remark_2 = $xml->hepa_remark_2;//
		

		//二类疫苗
		$vac_second_info = new Tvac_second_info();
		//$vac_second_info->uuid = $xml->uuid;//
		$vac_second_info->ext_uuid = $xml->ext_uuid;//
		$vac_second_info->id = $xml->id;//

		//$vac_second_info->created = $time;//

		$vac_second_info->vaccinum_name_1 = $xml->vaccinum_name_1;//

		$vac_second_info->vaccinum_time_1 = check_utime($xml->vaccinum_time_1);//

		$vac_second_info->vaccinum_part_1 = $xml->vaccinum_part_1;//

		$vac_second_info->vaccinum_batch_1 = $xml->vaccinum_batch_1;//

		$vac_second_info->vaccinum_effective_1 = check_utime($xml->vaccinum_effective_1);//

		$vac_second_info->vaccinum_enterprises_1 = $xml->vaccinum_enterprises_1;//

		$vac_second_info->vaccinum_doctor_1 = $xml->vaccinum_doctor_1;//

		$vac_second_info->vaccinum_remark_1 = $xml->vaccinum_remark_1;//
		$vac_second_info->vaccinum_name_2 = $xml->vaccinum_name_2;//

		$vac_second_info->vaccinum_time_2 = check_utime($xml->vaccinum_time_2);//

		$vac_second_info->vaccinum_part_2 = $xml->vaccinum_part_2;//

		$vac_second_info->vaccinum_batch_2 = $xml->vaccinum_batch_2;//

		$vac_second_info->vaccinum_effective_2 = check_utime($xml->vaccinum_effective_2);//

		$vac_second_info->vaccinum_enterprises_2 = $xml->vaccinum_enterprises_2;//

		$vac_second_info->vaccinum_doctor_2 = $xml->vaccinum_doctor_2;//

		$vac_second_info->vaccinum_remark_2 = $xml->vaccinum_remark_2;//

		$vac_second_info->vaccinum_name_3 = $xml->vaccinum_name_3;//
		$vac_second_info->vaccinum_time_3 = check_utime($xml->vaccinum_time_3);//

		$vac_second_info->vaccinum_part_3 = $xml->vaccinum_part_3;//

		$vac_second_info->vaccinum_batch_3 = $xml->vaccinum_batch_3;//

		$vac_second_info->vaccinum_effective_3 = check_utime($xml->vaccinum_effective_3);//

		$vac_second_info->vaccinum_enterprises_3 = $xml->vaccinum_enterprises_3;//

		$vac_second_info->vaccinum_doctor_3 = $xml->vaccinum_doctor_3;//

		$vac_second_info->vaccinum_remark_3 = $xml->vaccinum_remark_3;//

		
		
		$vac_check=new Tvac_info();//检查某居民是否存在预防接种信息
		$vac_check->whereAdd("id='$xml->id'");
		
		$err_code='';
		$flag=1;
		if($vac_check->count()>0){
		
			//暂时关闭更新
			return 0;
			$vac_second_info->whereAdd("id = '$xml->id'");
			$vac_info->whereAdd("id = '$xml->id'");
			$vac_card->whereAdd("id = '$xml->id'");
	
			if(!$vac_card->update()){
			    
				$flag=0;
				$err_code.="vac_card 更新失败 ";
			}
			
			if(!$vac_info->update()){
				$flag=0;
				$err_code.="vac_info 更新失败 ";
			}
			
			if(!$vac_second_info->update()){
				$flag=0;
				$err_code="vac_second_info 更新失败 ";
			}
			
			if($flag==1){
			
			//写入接口日志
			$logs_array=array("ext_uuid"=>$xml->ext_uuid,"org_id"=>$xml->org_id,"model_id"=>10,"upload_time"=>time(),"upload_token"=>2 );
			$this->insert_api_logs($logs_array);
		
			return $this->_error_message_start . "<return_code>1</return_code><return_string>预防接种信息更新成功</return_string>" . $this->_error_message_end; 
			}
			else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>更新失败：".$err_code."</return_string>" . $this->_error_message_end; 
			}
		}else{
		
		
			$vac_second_info->uuid = $_uid;
			$vac_info->uuid = $_uid;
			$vac_card->uuid = $_uid;
			$vac_card->created = time();
			$vac_info->created = time();
			$vac_second_info->created = time();
			if(!$vac_card->insert()){
				$flag=0;
				$err_code.="vac_card 新增失败 ";
			}
			
			if(!$vac_info->insert()){
				$flag=0;
				$err_code.="vac_info 新增失败 ";
			}
			
			if(!$vac_second_info->insert()){
				$flag=0;
				$err_code.="vac_second_info 新增失败 ";
			}
			if($flag==1){
			
			//写入接口日志
			$logs_array=array("ext_uuid"=>$xml->ext_uuid,"org_id"=>$xml->org_id,"model_id"=>10,"upload_time"=>time(),"upload_token"=>1 );
			$this->insert_api_logs($logs_array);
			
			return $this->_error_message_start . "<return_code>1</return_code><return_string>预防接种信息新增成功</return_string>" . $this->_error_message_end; 
			}
			else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>新增失败： ".$err_code."</return_string>" . $this->_error_message_end; 
			}
		}
    }
	/*************************
	 *删除预防接种信息
	 *接口只允许删除由外部创建的预防接种信息
	 *************************/
	public function vaccinate_delete($token, $xml_string){
	    
		//暂时关闭删除方法
		return 0;
		$xml = new SimpleXMLElement($xml_string);
		$_id = $xml->id;
		 if (empty($xml->id))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>个人档案号不能为空</return_string>" . $this->_error_message_end; //错误，请提供业务号ext_uuid
        }
		$core=new Tindividual_core();
		$core->whereAdd("uuid='$xml->id'");
		if($core->count()<1){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到该居民</return_string>" . $this->_error_message_end;
		}
		$err_code='';
		$flag=0;
		$vac_card = new Tvac_card();
		$vac_card->whereAdd("id = '$_id'");
		if(!$vac_card->delete()){
			$err_code.= 'vac_card 删除失败 ';
		}else {
			$flag=1;
		}
		$vac_info = new Tvac_info();
		$vac_info->whereAdd("id = '$_id' and ext_uuid is not null");
		if(!$vac_info->delete()){
			$err_code.= 'vac_info 删除失败 ';
			$flag=0;
		}
		else {
			$flag=1;
		}
		$vac_second_info = new Tvac_second_info();
		$vac_second_info->whereAdd("id = '$_id'");
		if(!$vac_second_info->delete()){
			$err_code.= 'vac_second_info 删除失败 ';
			$flag=0;
		}else{
			$flag=1;
		}
		//写入接口日志
		$logs_array=array("ext_uuid"=>$xml_string->ext_uuid,"org_id"=>$xml_string->org_id,"model_id"=>10,"upload_time"=>time(),"upload_token"=>3 );
		$this->insert_api_logs($logs_array);
		
		//删除成功
		if($flag==1){
			return $this->_error_message_start . "<return_code>1</return_code><return_string>删除成功</return_string>" . $this->_error_message_end; 
		}
		else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>删除失败 ：".$err_code."</return_string>" . $this->_error_message_end; 
		}
		
	}
}

?>
