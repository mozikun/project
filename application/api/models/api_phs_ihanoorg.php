<?php
/**
 * phsihanoorg
 * 
 * 完成根据个人身份证号查询个人信息的功能
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2012
 * @version $Id$
 * @access public
 */
require_once __SITEROOT . "application/api/models/api_phs_iha_comm.php";
class phsihanoorg extends api_phs_comm
{
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
        require_once __SITEROOT . 'library/custom/comm_function.php';
        require_once __SITEROOT . "library/Models/organization.php";
        require_once __SITEROOT . "library/Models/staff_archive.php";
        $this->_error_message_start = "<?xml version='1.0' encoding='UTF-8'?><message>";
        $this->_error_message_end = "</message>";
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
            "residence",
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
            $identity_number_length = strlen($identity_number);
            if ($identity_number_length != 15 && $identity_number_length != 18)
            {
                return $this->_error_message_start .
                    "<return_code>2</return_code><return_string>错误，身份证号只能是15或者18位</return_string>" .
                    $this->_error_message_end; //错误，身份证号只能是15或者18位
            }
            $core->whereAdd("individual_core.identity_number='" . $identity_number . "'");
        }
        $core->find(true);
        $core->free_statement();
        if ($core->uuid)
        {
            $core_uuid = $core->uuid; //临时存储，因后面要注销core->uuid
            require_once __SITEROOT . '/library/data_arr/arrdata.php';
            $xml_string = "<?xml version='1.0' encoding='UTF-8'?><tables><table name='individual_core'><row><identity_number>" .
                $identity_number . "</identity_number>";
            //核心表
            $exclude_core_array = array(
                "uuid",
                "org_id_1",
                "standard_code",
                "deleted",
                "status_flag",
                "syn_flag",
                "name_pinyin",
                "date_of_birth",
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
                "family_number",
                "region_path",
                "standard_code_1",
                "inner_id",
                "standard_code_2",
                "family_inner_id",
                "region_path_inner_id",
                "criteria_rate",
                "householder_identity_number");
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
}

?>