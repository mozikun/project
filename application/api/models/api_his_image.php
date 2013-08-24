<?php
require_once __SITEROOT . "application/api/models/api_phs_iha_comm.php";
/**
 * api_his_image
 * 
 * 影像接口
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class api_his_image extends api_phs_comm
{
    private $_error_message_start;
    private $_error_message_end;
    public function __construct()
    {
        require_once __SITEROOT . "library/Models/individual_core.php";
        require_once __SITEROOT . 'library/custom/comm_function.php';
        require_once __SITEROOT . "library/Models/organization.php";
        require_once __SITEROOT . "library/Models/staff_archive.php";
        require_once __SITEROOT . "library/Models/his_image_info.php";
        $this->_error_message_start = "<?xml version='1.0' encoding='UTF-8'?><message>";
        $this->_error_message_end = "</message>";
    }
    /**
     * api_his_image::ws_update()
     * 
     * 影像地址数据的接收处理
     * 
     * @param mixed $token
     * @param mixed $xml_string
     * @return void
     */
    function ws_update($token,$xml_string)
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
            $tables = $data_xml;
            {
                $table_name = $tables->attributes(); //表名
                $class_name = "T" . $table_name; //类名
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
                    /*$core = new Tindividual_core();
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
                    $core->free_statement();*/
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
                    $table_object = new $class_name();
                    foreach ($rows as $colums)
                    {
                        $colums_name = $colums->getname(); //字段名
                        //排除除核心表之外的其他表里的身份证号字段
                        if ($colums_name != "identity_number")
                        {
                            $colums_value = $rows->$colums_name;
                            $table_object->$colums_name = $colums_value; //赋值
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
                        $logs_array=array("ext_uuid"=>$rows->ext_uuid,"org_id"=>$org_id,"model_id"=>26,"upload_time"=>time(),"upload_token"=>2);
                        $this->insert_api_logs($logs_array);
                        $success++;
                    }
                    $table_object->free_statement();
                }
            }
            if($error==0)
            {
                $return_code=1;
            }
            else
            {
                $return_code=2;
            }
            return $this->_error_message_start . $error_message_xml . "<return_code>".$return_code."</return_code><return_string>成功更新" .
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
}