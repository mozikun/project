<?php
/**
 * hl7_iha
 * 
 * * 基于文档：
 * ICS 11.020 C07 中华人民共和国卫生行业标准   健康档案共享文档规范  第 1 部分：个人基本健康信息登记  （征求意见稿）
 * 完成个人基本健康信息的数据交换的具体数据处理
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2012
 * @version $Id$
 * @access public
 */
 require_once __SITEROOT . "application/api/models/api_phs_iha_comm.php";
 class hl7_iha
 {
    private $_message_start;
    private $_message_end;
    private $_error_message;
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
        //定义文档读取流水号
        if(file_exists(__SITEROOT.'cache/hl7_iha.php'))
        {
            $hl7=file_get_contents(__SITEROOT.'cache/hl7_iha.php');
        }
        else
        {
            $hl7=1;
        }
        file_put_contents(__SITEROOT.'cache/hl7_iha.php',$hl7+1);
        $this->_message_start = '<?xml version="1.0" encoding="UTF-8"?>  
<ClinicalDocument xmlns="urn:hl7-org:v3" xmlns:mif="urn:hl7-org:v3/mif" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="urn:hl7-org:v3 ..\cdaschemas\CDA.xsd">  
  
    <realmCode code="CN"/>  
    <typeId root="2.16.840.1.113883.1.3" extension="POCD_MT000040"/>  
    <templateId xsi:type="II" root="SD.10.1" assigningAuthorityName="个人基本健康信息登记" extension="DT'.date("Y").str_pad($hl7,3,'0',STR_PAD_LEFT).'"/>  
    <id root="SD.1.1.4" extension="D'.date("Y").str_pad($hl7,6,'0',STR_PAD_LEFT).'" displayable="true" xsi:type="II"/>  
    <code code="A010401" codeSystem="SD.6.3" codeSystemName="卫生信息共享文档分类编码系统"  
displayName="个人基本健康信息登记"/>  
    <title>个人基本健康信息登记</title>  
    <effectiveTime xsi:type="TS" value="'.date("YmdHis").'"/>  
    <confidentialityCode code="N" codeSystem="2.16.840.1.113883.5.25"  
codeSystemName="Confidentiality" displayName="一般保密级别"/>  
    <languageCode code="zh-cn"/>  
    <setId xsi:type="II" root="1.2.345.6789.33" extension="2"/>  
    <versionNumber value="2" xsi:type="INT"/>';
        $this->_message_end = "</ClinicalDocument>";
        //status记录状态1成功，2部分成功，3失败，error记录错误信息，warning 记录警告信息,info记录信息提示
        $this->_error_message='';
    }
    /**
     * hl7_iha::ws_delete()
     * 
     * 删除个人基本健康信息
     * 
     * @param mixed $token
     * @param mixed $xml_string
     * @return
     */
    public function ws_delete($token, $xml_string)
    {
        return "";
    }
    /**
     * hl7_iha::ws_update()
     * 
     * 更新个人基本健康信息，接收基于文档的xml文件
     * 
     * @param mixed $token
     * @param mixed $xml_string
     * @return void
     */
    public function ws_update($token, $xml_string)
    {
        
    }
    /**
     * hl7_iha::ws_select_single()
     * 
     * 查询指定身份证号码的个人基本信息，返回基于文档的xml文件
     * 
     * $xml_string='<?xml version="1.0" encoding="UTF-8"?><patient classCode="PSN" determinerCode="INSTANCE"><id root="SD.4.2" extension="ID420106201101011919" /></patient>'
     * 
     * @param mixed $token
     * @param mixed $xml_string
     * @return void
     */
    public function ws_select_single($token, $xml_string)
    {
        $time = time();
        if ($xml_string)
        {
            //条件不为空时，解析查询条件
            $data_xml = new SimpleXMLElement($xml_string);
            $return_string='';
            foreach($data_xml->id[0]->attributes() as $k=>$v)
            {
                if($k=='extension')
                {
                    $v=substr($v,2,-1);
                    $identity_length=strlen($v);
                    if($identity_length!=15 || $identity_length!=18)
                    {
                        $this->_error_message='<?xml version="1.0" encoding="UTF-8"?><status>3</status><info>给定的身份证号码['.$v.']格式错误，请检查</info><warning></warning><error>给定的身份证号码['.$v.']格式错误</error>';
                    }
                    else
                    {
                        //包含数据字典
                        require_once __SITEROOT . '/library/data_arr/arrdata.php';
                        $core=new Tindividual_core();
                        $core->whereAdd("identity_number='$v'");
                        $core->find(true);
                        if($core->identity_number)
                        {
                            $return_string.=$this->_message_start;
                            //构造个人基本信息
                            $return_string.='<recordTarget typeCode="RCT" contextControlCode="OP">';
                            $return_string.='<patientRole classCode="PAT"><!-- 健康档案标识号--><id root="SD.4.1" extension="HR'.$core->ext_uuid.'" /><addr use="H"><houseNumber>xx号xx小区xx栋xx单元</houseNumber><streetName>中山大道</streetName><county>天河区</county><city>广州市</city><state>广东省</state><postalCode>510000</postalCode></addr><telecom value="020-87815102" /><telecom value="niming@163.com" /><patient classCode="PSN" determinerCode="INSTANCE"><!-- 患者身份证号--><id root="SD.4.2" extension="ID'.$v.'" /><name>贾小明</name><administrativeGenderCode code="M" codeSystem="SD.11.3.4" codeSystemName="生理性别代码表（GB/T 2261.1）" /><birthTime xsi:type="TS" value="20080101" /><maritalStatusCode code="10" displayName="未婚" codeSystem="SD.11.3.5" codeSystemName="婚姻状况代码表（GB/T 2261.2）" /><ethnicGroupCode code="TJ" displayName="土家族" codeSystem="SD.11.3.3" codeSystemName="民族类别代码表（GB 3304）" /><birthplace><place classCode="PLC" determinerCode="INSTANCE"><addr>广东省广州市</addr></place></birthplace></patient></patientRole>';
                            $return_string.='</recordTarget>';
                            $return_string.=$this->_message_end;
                        }
                        else
                        {
                            $this->_error_message='<?xml version="1.0" encoding="UTF-8"?><status>3</status><info>平台上没有身份证号码为['.$v.']的数据</info><warning></warning><error>平台上没有身份证号码为['.$v.']的数据</error>';
                        }
                    }
                }
            }
            if($return_string)
            {
                return $return_string;
            }
        }
        else
        {
            $this->_error_message='<?xml version="1.0" encoding="UTF-8"?><status>3</status><info>请指定满足格式"<?xml version="1.0" encoding="UTF-8"?><patient classCode="PSN" determinerCode="INSTANCE"><id root="SD.4.2" extension="ID身份证号码" /></patient>"的xml条件</info><warning></warning><error>指定的查询条件为空</error>';
        }
        return $this->_error_message;
    }
    /**
     * hl7_iha::ws_select_all()
     * 
     * 查询指定机构的所有个人基本信息，仅返回部分基本信息，返回基于文档的xml文件
     * 
     * @param mixed $token
     * @param mixed $xml_string
     * @return void
     */
    public function ws_select_all($token, $xml_string)
    {
        
    }
 }