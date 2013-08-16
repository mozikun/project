<?php

/**
 * @author 我好笨
 * @todo 个人健康档案基本信息接口
 */
require_once __SITEROOT . "application/api/models/api_phs_iha_comm.php";
class phsiha extends api_phs_comm
{
    /**
     * 用于写入健康档案基本信息到数据表
     *
     * @param string $org_id
     * @param string $xml_string
     * @return mixed 正确返回1，错误返回错误信息字符串
     */
    private $_error_message_start;
    private $_error_message_end;
    public function __construct()
    {
        require_once __SITEROOT . "library/Models/individual_archive.php";
        require_once __SITEROOT . "library/Models/individual_core.php";
        require_once __SITEROOT . 'library/Models/blood_type.php';
        require_once __SITEROOT . 'library/Models/charge_style.php';
        require_once __SITEROOT . 'library/Models/allergy.php';
        require_once __SITEROOT . 'library/Models/exposure_history.php';
        require_once __SITEROOT . 'library/Models/clinical_history.php';
        require_once __SITEROOT . 'library/Models/surgical_history.php';
        require_once __SITEROOT . 'library/Models/trauma.php';
        require_once __SITEROOT . 'library/Models/transfusion.php';
        require_once __SITEROOT . 'library/Models/family_history.php';
        require_once __SITEROOT . 'library/Models/genetic_diseases.php';
        require_once __SITEROOT . 'library/Models/deformity.php';
        require_once __SITEROOT . 'library/custom/comm_function.php';
        require_once __SITEROOT . "library/Models/organization.php";
        require_once __SITEROOT . "library/Models/staff_archive.php";
        $this->_error_message_start = "<?xml version='1.0' encoding='UTF-8'?><message>";
        $this->_error_message_end = "</message>";
    }
    /**
     * 删除数据--个人基本信息表不提供删除功能，删除功能集成在封面删除
     *
     * @param string $token
     * @param string $xml_string
     */
    public function ws_delete($token, $xml_string)
    {
        return "";
    }
    /**
     * 添加或者更新数据
     *
     * @param string $token
     * @param string $xml_string
     * @return mixed
     */
    public function ws_update($token, $xml_string)
    {
        $time = time(); //执行时间，用于疾病史等表删除时关联
        $status = 1; //返回标志，默认为1
        $error_message_xml = ""; //用于存储失败返回的xml内容
        $success_message_xml = ""; //用于存储成功返回的xml内容
        $error = 0;
        $success = 0;
        if ($xml_string)
        {
            //条件不为空时，解析查询条件
            $data_xml = new SimpleXMLElement($xml_string);
            //包含数据字典
            require_once __SITEROOT . '/library/data_arr/arrdata.php';
            //需要删除并添加的数据
            $dic['individual_core'] = array("sex" => "sex", "race" => "race");
            $dic['individual_archive'] = array(
                "residence" => "registered_permanent_residence",
                "study_history" => "school_type",
                "occupation" => "occupation",
                "marriage" => "marriage",
                "kitchen_exhaust" => "iha_kitchen_exhaust",
                "fuel_type" => "iha_fuel_type",
                "water" => "iha_water",
                "toilet" => "iha_toilet",
                "livestock_column" => "iha_livestock_column");
            $dic['blood_type'] = array("abo_bloodtype" => "ABO_bloodtype", "rh_bloodtype" =>
                    "RH_bloodtype");
            $dic['charge_style'] = array("charge_style" => "charge_style");
            $dic['exposure_history'] = array("exposure_code" => "iha_exposure_history");
            $dic['allergy'] = array("allergy_code" => "allergy_history");
            $dic['clinical_history'] = array("disease_code" => "disease_history");
            $dic['family_history'] = array("disease_code" => "disease_history");
            $dic['deformity'] = array("deformity_type" => "deformity_type");
            $dic['surgical_history'] = array();
            $dic['trauma'] = array();
            $dic['transfusion'] = array();
            $dic['genetic_diseases'] = array();
            foreach ($data_xml as $tables)
            {
                $table_name = $tables->attributes(); //表名
                $class_name = "T" . $table_name; //类名
                //判定是更新还是删除,实际上在这个模板里，只需要判定individual_archive是更新还是插入，其他表都不需要，因为核心表只能更新，其他的业务表都是先插入后删除的，在这里实现先删除后插入
                $update_status = 0; //更新或者插入的标志
                foreach ($tables as $rows)
                {
                    //取系统内部的org id号
                    $org_id = $this->get_org_id($rows->org_id);
                    $org_standard_code = $this->set_org_id($rows->org_id);
                    if (!$org_id)
                    {
                        $error_message_xml .= "<table name='$table_name'><row><org_id>" . $rows->org_id .
                            "</org_id><identity_number>" . $rows->identity_number .
                            "</identity_number><ext_uuid>" . $rows->ext_uuid .
                            "</ext_uuid></row><error_msg>机构ID不存在" . $rows->org_id . "</error_msg></table>";
                        $error++;
                        continue;
                    }
                    //判断身份证号是否合法
                    $identity_number = $rows->identity_number;
                    $identity_number_length = strlen($identity_number);
                    if ($identity_number_length != 15 && $identity_number_length != 18)
                    {
                        $error_message_xml .= "<table name='$table_name'><row><org_id>" . $rows->org_id .
                            "</org_id><identity_number>" . $rows->identity_number .
                            "</identity_number><ext_uuid>" . $rows->ext_uuid .
                            "</ext_uuid></row><error_msg>错误，身份证号只能是15或者18位</error_msg></table>";
                        $error++;
                        continue;
                    }
                    //根据身份证查询此用户是否建档
                    $core = new Tindividual_core();
                    $core->whereAdd("individual_core.identity_number='" . $identity_number . "'");
                    $core->find(true);
                    $id = $core->uuid; //个人档案号
                    if (!$id)
                    {
                        $error_message_xml .= "<table name='$table_name'><row><org_id>" . $rows->org_id .
                            "</org_id><identity_number>" . $rows->identity_number .
                            "</identity_number><ext_uuid>" . $rows->ext_uuid .
                            "</ext_uuid></row><error_msg>身份证号为：" . $rows->identity_number .
                            "的用户未建档，请先调用建档接口</error_msg></table>";
                        $core->free_statement();
                        $error++;
                        continue;
                    }
                    else
                    {
                        $family_number = $core->family_number; //家庭档案号
                        if (!$id)
                        {
                            $error_message_xml .= "<table name='$table_name'><row><org_id>" . $rows->org_id .
                                "</org_id><identity_number>" . $rows->identity_number .
                                "</identity_number><ext_uuid>" . $rows->ext_uuid .
                                "</ext_uuid></row><error_msg>此用户的档案有错误，没有个人档案序号uuid值</error_msg></table>";
                            $core->free_statement();
                            $error++;
                            continue;
                        }
                    }
                    $core->free_statement();
                    //判定ext_uuid不能为空
                    if ($rows->ext_uuid == '')
                    {
                        $status = 3;
                        $error_message_xml .= "<table name='$table_name'><row><org_id>" . $rows->org_id .
                            "</org_id><identity_number>" . $rows->identity_number .
                            "</identity_number><ext_uuid>" . $rows->ext_uuid .
                            "</ext_uuid></row><error_msg>业务ID字段ext_uuid不能为空</error_msg></table>";
                        $error++;
                        continue;
                    }
                    //遍历多行
                    if ($table_name == "individual_archive")
                    {
                        $table_object = new $class_name();
                        $table_object->whereAdd("id='$id'");
                        $table_object->whereAdd("org_id='$org_id'");
                        //$table_object->whereAdd("ext_uuid='$ext_uuid'");
                        $table_object->find(true);
                        if ($table_object->id == $id)
                        {
                            $update_status = 1;
                        }
                        $table_object->free_statement();
                    }
                    $table_object = new $class_name();
                    foreach ($rows as $colums)
                    {
                        $colums_name = $colums->getname(); //字段名
                        //排除除核心表之外的其他表里的身份证号字段
                        if ($colums_name != "identity_number")
                        {
                            $colums_value = $rows->$colums_name;
                            $table_object->$colums_name = $colums_value; //赋值
                            if (isset($dic["$table_name"]) && !empty($dic["$table_name"]) && $colums_value !=
                                "" && $table_object->$colums_name != "#^&*^&*#" && isset($dic["$table_name"]["$colums_name"]) &&
                                isset($table_object->$colums_name))
                            {
                                $n = $dic["$table_name"]["$colums_name"];
                                $table_object->$colums_name = array_code_change($colums_value, $$n);
                            }
                        }
                        //判定identity_number
                        if ($colums_name == 'identity_number' && $colums_value != '')
                        {
                            //每条记录获取一次
                            $core = new Tindividual_core();
                            $core->whereAdd("individual_core.identity_number='" . $rows->identity_number .
                                "'");
                            $core->find(true);
                            if ($core->uuid != '')
                            {
                                $id = $core->uuid;
                            }
                            $core->free_statement();
                        }
                        //判定family_number
                        if ($colums_name == "family_number" && $family_number != "")
                        {
                            $table_object->family_number = $family_number;
                        }
                    }
                    if (isset($table_object->staff_id))
                    {
                        $table_object->staff_id = $this->set_doctor_number($table_object->staff_id); //处理医生
                    }
                    //判定id
                    if (isset($table_object->id))
                    {
                        //每条记录获取一次
                        $core = new Tindividual_core();
                        $core->whereAdd("individual_core.identity_number='" . $rows->identity_number .
                            "'");
                        $core->find(true);
                        if ($core->uuid != '')
                        {
                            $id = $core->uuid;
                            $table_object->id = $id;
                        }
                        $core->free_statement();
                    }
                    //个人核心表，只做更新
                    if (($update_status && $table_name == "individual_archive") || $table_name ==
                        "individual_core")
                    {
                        if ($table_name == "individual_core")
                        {
                            $table_object->whereAdd("identity_number='$identity_number'");
                        }
                        else
                        {
                            $table_object->whereAdd("id='$id'");
                            $table_object->whereAdd("org_id='$org_id'");
                            $table_object->whereAdd("ext_uuid='$rows->ext_uuid'");
                        }
                        $update_except_array = array(
                            "uuid",
                            "id",
                            "org_id",
                            "created"); //更新时不能更新的字段数组
                        foreach ($update_except_array as $v)
                        {
                            if (isset($table_object->$v))
                            {
                                unset($table_object->$v);
                            }
                        }
                        //扩展表如果无数据，可以使用插入
                        if($table_name=='individual_archive' && !$table_object->count())
                        {
                            $table_object->uuid=uniqid(strtoupper(substr($table_name, 0, 1)) . "_");
                            $table_object->org_id = $org_id;
                            $table_object->id = $id;
                            $table_object->insert();
                            $success++;
                            continue;
                        }
                        if (!$table_object->update())
                        {
                            $status = 3;
                            $error_msg = $table_object->showErrorMessage();
                            $error_message_xml .= "<table name='$table_name'><row><org_id>" . $rows->org_id .
                                "</org_id><identity_number>" . $rows->identity_number .
                                "</identity_number><ext_uuid>" . $rows->ext_uuid . "</ext_uuid></row><error_msg>$error_msg</error_msg></table>";
                            $table_object->free_statement();
                            $error++;
                            continue;
                        }
                        else
                        {
                            $logs_array=array("ext_uuid"=>$rows->ext_uuid,"org_id"=>$org_id,"model_id"=>1,"upload_time"=>time(),"upload_token"=>2);
                            $this->insert_api_logs($logs_array);
                            $success++;
                        }
                        $table_object->free_statement();
                    }
                    else
                    {
                        if ($table_name != "individual_archive")
                        {
                            //先删除掉个人原来的数据
                            $table_object->whereAdd("org_id='$org_id'");
                            $table_object->whereAdd("id='$id'");
                            $table_object->whereAdd("created!='$time'");
                            $table_object->delete();
                            $table_object->free_statement();
                            $table_object->created = $time;
                        }
                        $table_object->org_id = $org_id;
                        $table_object->id = $id;
                        //插入数据时需要生成uuid
                        $table_object->uuid = uniqid(strtoupper(substr($table_name, 0, 1)) . "_");
                        if (!$table_object->insert())
                        {
                            $status = 3;
                            $error_msg = $table_object->showErrorMessage();
                            $error_message_xml .= "<table name='$table_name'><row><org_id>" . $rows->org_id .
                                "</org_id><identity_number>" . $rows->identity_number .
                                "</identity_number><ext_uuid>" . $rows->ext_uuid . "</ext_uuid></row><error_msg>$error_msg</error_msg></table>";
                            $table_object->free_statement();
                            $error++;
                            continue;
                        }
                        else
                        {
                            $logs_array=array("ext_uuid"=>$rows->ext_uuid,"org_id"=>$org_id,"model_id"=>1,"upload_time"=>time(),"upload_token"=>2);
                            $this->insert_api_logs($logs_array);
                            $success++;
                        }
                        $table_object->free_statement();
                    }
                }
            }
            return $this->_error_message_start . $error_message_xml . "<return_string>成功更新" .
                $success . "条记录，" . $error . "条记录更新失败</return_string>" . $this->
                _error_message_end;
        }
        else
        {
            return $this->_error_message_start .
                "<return_code>2</return_code><return_string>未传递任何数据xml</return_string>" . $this->
                _error_message_end;
        }
    }
    /**
     * 查询单条数据
     *
     * @param string $token
     * @param string $xml_string
     */
    public function ws_select_single($token, $xml_string)
    {
        $exclude_array = array(
            "uuid",
            "syn_flag",
            "deleted",
            "id",
            "nationality",
            "native_place",
            "reside_place",
            "reside_time",
            "community",
            "police_station",
            "need_service",
            "nursery_date",
            "nursery_name",
            "kindergarten_date",
            "kindergarten_name",
            "elementary_date",
            "elementary_name",
            "high_school_date",
            "high_school_name",
            "end_school_date",
            "school_type",
            "school_name",
            "specialty",
            "begin_work_date",
            "degree",
            "spouse_name",
            "close_relative",
            "marriage_date",
            "divorce_date",
            "child_number",
            "child_health",
            "father_name",
            "mather_name",
            "father_age",
            "mather_age",
            "father_health",
            "mather_health",
            "height",
            "weight",
            "parter_code",
            "identity_type",
            "identity_extra",
            "group_order",
            "groups",
            "life_cycle"); //排除部分不必要的字段在结果里
        $core = new Tindividual_core();
        $individual_archive = new Tindividual_archive();
        $core->joinAdd('left', $core, $individual_archive, 'uuid', 'id');
        if ($xml_string)
        {
            //条件不为空时，解析查询条件
            $where_xml = new SimpleXMLElement($xml_string);
            $identity_number = $where_xml->identity_number;
            //判断身份证号是否合法
            /*$identity_number_length = strlen($identity_number);
            if ($identity_number_length != 15 && $identity_number_length != 18)
            {
                return $this->_error_message_start .
                    "<return_code>2</return_code><return_string>错误，身份证号只能是15或者18位</return_string>" .
                    $this->_error_message_end; //错误，身份证号只能是15或者18位
            }*/
            //取机构管辖范围
            $org_id=$this->get_org_id($where_xml->org_id);
            if($org_id)
            {
                $organization = new Torganization();
        		$organization->whereAdd("id='$org_id'");
        		$organization->find(true);
                if($organization->region_path_domain)
                {
                    $tmp_region=@explode('|',$organization->region_path_domain);
                    if(!empty($tmp_region))
                    {
                        $where='';
                        foreach($tmp_region as $k=>$v)
                        {
                            $where.="individual_core.region_path like '$v%' or ";
                        }
                        $where=rtrim($where,' or ');
                        if($where)
                        {
                            $core->whereAdd("$where");
                        }
                    }
                }
            }
            $core->whereAdd("individual_core.identity_number='" . $identity_number . "'");
        }
        if($core->count()>1)
        {
            return $this->_error_message_start .
                "<return_code>2</return_code><return_string>该身份证号存在多条重复档案，暂不提供查询</return_string>" .
                $this->_error_message_end; //错误，没有你要查询的数据，请检查查询条件
        }
        $core->find(true);
        $core->free_statement();
        if ($core->uuid)
        {
            $core_uuid = $core->uuid; //临时存储，因后面要注销core->uuid
            require_once __SITEROOT . '/library/data_arr/arrdata.php';
            $xml_string = "<?xml version='1.0' encoding='UTF-8'?><tables><table name='individual_core'><row>";
            //核心表
            $exclude_core_array = array(
                "uuid",
                "org_id_1",
                "standard_code",
                "deleted",
                "status_flag",
                "syn_flag",
                "name_pinyin",
                "relation_holder",
                "householder_name",
                "identity_type",
                "identity_extra",
                "record_state",
                "address",
                "residence_address",
                "townsid",
                "neighborhood",
                "filing_time",
                "region_path",
                "standard_code_1",
                "inner_id",
                "standard_code_2",
                "family_inner_id",
                "region_path_inner_id",
                "criteria_rate",
                "householder_identity_number");
            $core->date_of_birth=$core->date_of_birth?date('Y-m-d',$core->date_of_birth):'';
            $core->sex = @array_search_for_other($core->sex, $sex);
            $core->race = @array_search_for_other($core->race, $race);
            $core->response_doctor = $this->get_doctor_number($core->response_doctor);
            $core->staff_id = $this->get_doctor_number($core->staff_id);
            $core->org_id = $this->set_org_id($core->org_id);
            $xml_string .= @$core->toXML("", $exclude_core_array);
            $xml_string .= "</row></table>";
            //基本信息表
            $xml_string .= "<table name='individual_archive'><row><identity_number>" . $identity_number .
                "</identity_number>";
            $individual_archive->study_history = @array_search_for_other($individual_archive->
                study_history, $school_type);
            $individual_archive->residence = @array_search_for_other($individual_archive->
                residence, $registered_permanent_residence);
            $individual_archive->occupation = @array_search_for_other($individual_archive->
                occupation, $occupation);
            $individual_archive->marriage = @array_search_for_other($individual_archive->
                marriage, $marriage);
            $individual_archive->surgery_history = @array_search_for_other($individual_archive->
                surgery_history, $comm);
            $individual_archive->trauma_history = @array_search_for_other($individual_archive->
                trauma_history, $comm);
            $individual_archive->blood_history = @array_search_for_other($individual_archive->
                blood_history, $comm);
            $individual_archive->genetic_diseases_history = @array_search_for_other($individual_archive->
                genetic_diseases_history, $comm);
            $individual_archive->kitchen_exhaust = @array_search_for_other($individual_archive->
                kitchen_exhaust, $iha_kitchen_exhaust);
            $individual_archive->fuel_type = @array_search_for_other($individual_archive->
                fuel_type, $iha_fuel_type);
            $individual_archive->water = @array_search_for_other($individual_archive->water,
                $iha_water);
            $individual_archive->toilet = @array_search_for_other($individual_archive->
                toilet, $iha_toilet);
            $individual_archive->livestock_column = @array_search_for_other($individual_archive->
                livestock_column, $iha_livestock_column);
            $individual_archive->staff_id = $this->get_doctor_number($individual_archive->
                staff_id);
            $individual_archive->org_id = $this->set_org_id($individual_archive->org_id);
            $xml_string .= @$individual_archive->toXML("", $exclude_array);
            $xml_string .= "</row></table>";
            //要替换数据字典的数组，写数组是为了下面循环能更好实现
            $dic['blood_type'] = array("abo_bloodtype" => "ABO_bloodtype", "rh_bloodtype" =>
                    "RH_bloodtype");
            $dic['charge_style'] = array("charge_style" => "charge_style");
            $dic['exposure_history'] = array("exposure_code" => "iha_exposure_history");
            $dic['allergy'] = array("allergy_code" => "allergy_history");
            $dic['clinical_history'] = array("disease_code" => "disease_history");
            $dic['family_history'] = array("disease_code" => "disease_history");
            $dic['deformity'] = array("deformity_type" => "deformity_type");
            //单条记录的扩展表
            $table_array_extra_single = array("blood_type" => "血型", "genetic_diseases" =>
                    "遗传病史");
            foreach ($table_array_extra_single as $k => $v)
            {
                $class_name = "T" . $k;
                $table_object = new $class_name();
                $table_object->whereAdd("id='$core_uuid'");
                $table_object->find(true);
                $table_object->free_statement();
                if (isset($dic[$k]))
                {
                    foreach ($dic[$k] as $m => $n)
                    {
                        if (isset($table_object->$m) && isset($dic[$k][$m]))
                        {
                            $table_object->$m = array_search_for_other($table_object->$m, $$n);
                        }
                    }
                }
                $xml_string .= "<table name='$k'><row><identity_number>" . $identity_number .
                    "</identity_number>";
                if (isset($table_object->staff_id))
                {
                    $table_object->staff_id = $this->get_doctor_number($table_object->staff_id);
                }
                if (isset($table_object->org_id))
                {
                    $table_object->org_id = $this->set_org_id($table_object->org_id);
                }
                $xml_string .= @$table_object->toXML("", $exclude_array);
                $xml_string .= "</row></table>";
            }
            //多条记录的扩展表
            $table_array_extra_mult = array(
                "charge_style" => "医疗支付方式",
                "allergy" => "药物过敏史",
                "exposure_history" => "暴露史",
                "clinical_history" => "疾病史",
                "surgical_history" => "手术史",
                "trauma" => "外伤史",
                "transfusion" => "输血史",
                "family_history" => "家族史",
                "deformity" => "残疾状况");
            foreach ($table_array_extra_mult as $k => $v)
            {
                $class_name = "T" . $k;
                $table_object = new $class_name();
                $table_object->whereAdd("id='$core_uuid'");
                $table_object->find();
                $xml_string .= "<table name='$k'>";
                while ($table_object->fetch())
                {
                    $xml_string .= "<row><identity_number>" . $identity_number .
                        "</identity_number>";
                    if (isset($dic[$k]))
                    {
                        foreach ($dic[$k] as $m => $n)
                        {
                            if (isset($table_object->$m) && isset($dic[$k][$m]))
                            {
                                $table_object->$m = array_search_for_other($table_object->$m, $$n);
                            }
                        }
                    }
                    if (isset($table_object->staff_id))
                    {
                        $table_object->staff_id = $this->get_doctor_number($table_object->staff_id);
                    }
                    if (isset($table_object->org_id))
                    {
                        $table_object->org_id = $this->set_org_id($table_object->org_id);
                    }
                    $xml_string .= @$table_object->toXML("", $exclude_array);
                    $xml_string .= "</row>";
                }
                $table_object->free_statement();
                $xml_string .= "</table>";
            }
            $xml_string .= "</tables>";
            return $xml_string;
        }
        else
        {
            return $this->_error_message_start .
                "<return_code>2</return_code><return_string>没有你要查询的数据，请检查查询条件</return_string>" .
                $this->_error_message_end; //错误，没有你要查询的数据，请检查查询条件
        }
    }
    /**
     * phsiha::ws_select_all()
     * 
     * @todo wei  2012-03-13 09:58:20
     * 在api_phs_iha_cover增加一个模糊查询功能，可实现条件and查询。
     * Api为public function ws_select_all($token,$xml_string)
     * 其中$xml_string格式如下
     * $xml_string="<?xml version='1.0' encoding='UTF-8'?>".
     * "<where>".
     * "<org_id>必填并有效</org_id>".
     * "<region_path>选填（默认为空）</region_path>".
     * "<created>选填（默认为空）</created>".
     * "<updated>选填（默认为空）</updated>".
     * "<relation_holder>选填（默认为空）</relation_holder>".
     * "</where>";
     * 
     * 逻辑处理：根据org_id加上（and方式）非空条件去查询individual_core表，得到身份证号与ext_uuid的xml返回串，返回的xml格式为
     * $xml_return="<?xml version='1.0' encoding='UTF-8'?>
     * <tables>
     * <table name='individual_core'>
     * <row>
     * <identity_number>510103199901011679</identity_number>
     * <ext_uuid>43242342</ext_uuid>
     * </row> 
     * <row>
     * <identity_number>510103199901015679</identity_number>
     * <ext_uuid>43242341</ext_uuid>
     * </row>
     * </table>
     * <tables>";
     * 错误处理：
     * 缺少org_id，或是org_id错误判断与ws_select一致。
     * @param mixed $token
     * @param mixed $xml_string
     * @return void
     */
    public function ws_select_all($token, $xml_string)
    {
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        $core = new Tindividual_core();
        if ($xml_string)
        {
            //条件不为空时，解析查询条件
            $where_xml = new SimpleXMLElement($xml_string);
            $org_id = $this->get_org_id($where_xml->org_id);
            if ($org_id)
            {
                $core->whereAdd("individual_core.org_id='" . $org_id . "'");
            }
            else
            {
                return $this->_error_message_start .
                    "<return_code>2</return_code><return_string>机构ID" . $where_xml->org_id .
                    "不存在</return_string>" . $this->_error_message_end;
            }
            $region_path = $where_xml->region_path;
            if ($region_path)
            {
                $region_path = str_replace("%", "\%", $region_path);
                $region_path = str_replace("_", "\_", $region_path);
                $core->whereAdd("individual_core.region_path ='" . $region_path .
                    "' or individual_core.region_path like '" . $region_path . "%'");
            }
            $created = $where_xml->created;
            if ($created)
            {
                $core->whereAdd("individual_core.created='" . $created . "'");
            }
            $updated = $where_xml->updated;
            if ($updated)
            {
                $core->whereAdd("individual_core.updated='" . $updated . "'");
            }
            $relation_holder = @array_code_change($where_xml->relation_holder, $relation_of_householder);
            if ($relation_holder !== '')
            {
                $core->whereAdd("individual_core.relation_holder='" . $relation_holder . "'");
            }
        }
        $nums = $core->count();
        if ($nums)
        {
            $core->find();
            $xml_string = "<?xml version='1.0' encoding='UTF-8'?><tables><table name='individual_core'>";
            while ($core->fetch())
            {
                $xml_string .= "<row>";
                $xml_string .= "<identity_number>" . $core->identity_number . "</identity_number>";
                $xml_string .= "<ext_uuid>" . $core->ext_uuid . "</ext_uuid>";
                $xml_string .= "</row>";

            }
            $xml_string .= "</table>";
            $core->free_statement();
            return $xml_string;
        }
        else
        {
            return $this->_error_message_start .
                "<return_code>2</return_code><return_string>没有你要查询的数据，请检查查询条件</return_string>" .
                $this->_error_message_end; //错误，没有你要查询的数据，请检查查询条件
        }
    }
}

?>