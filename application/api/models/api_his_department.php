<?php

/* * **
 * @author whx
 * @todo 科室表接口测试
 * @time 2013-05-15
 * *********** */
require_once __SITEROOT . "application/api/models/api_phs_iha_comm.php";

class hisdepartment extends api_phs_comm {

    private $_error_message_start;
    private $_error_message_end;
    private $role_id;

    public function __construct() {

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

    /*     * *****************
     * 科室添加 
     * ****************** */

    public function ws_insert($token, $xml_request) {
        $xml = new SimpleXMLElement($xml_request);
        if (empty($xml->uuid)) {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>uuid不能为空!</return_string>" . $this->_error_message_end;
        }
        //机构转码
        $organization = new Torganization();
        $organization->whereAdd("standard_code='$xml->org_id'");
        $organization->find(true);
        $org_id = $organization->id;
        if (!$org_id) {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>机构码不正确!</return_string>" . $this->_error_message_end;
        }
        if (empty($xml->department_name)) {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>科室名不能为空!</return_string>" . $this->_error_message_end;
        }
        $department = new Tdepartment();
        $department->uuid = $xml->uuid;
        $department->created = time();
        $department->status_flag = $xml->status_flag;
        $department->org_id = $org_id;
        $department->department_name = $xml->department_name;
        $department->sort_number = $xml->sort_number;
        $department->p_id = $xml->p_id; //没有可不填

        if ($department->insert()) {
            return $this->_error_message_start . "<return_code>1</return_code><return_string>新增成功!</return_string>" . $this->_error_message_end;
        } else {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>新增失败!</return_string>" . $this->_error_message_end;
        }
    }

    /*     * *****************
     * 科室查询
     * ****************** */

    public function ws_select($token, $xml_request) {
        $xml = new SimpleXMLElement($xml_request);
        if ($xml->org_id) {
            //机构转码
            $organization = new Torganization();
            $organization->whereAdd("standard_code='$xml->org_id'");
            $organization->find(true);
            $org_id = $organization->id;
            if (!$org_id) {
                return $this->_error_message_start . "<return_code>2</return_code><return_string>机构码不正确!</return_string>" . $this->_error_message_end;
            }
        }
        $department = new Tdepartment();
        if ($org_id) {
            $department->whereAdd("org_id='$org_id'");
        }
        if ($xml->uuid) {
            $department->whereAdd("uuid='$xml->uuid'");
        }

        $department->orderby("sort_number,org_id");
        $department->find();
        $xml_return = "<?xml version='1.0' encoding='UTF-8'?><table name='department'>";
        while ($department->fetch()) {
            $xml_return.="<row>";
            $xml_return.=$department->toXML();
            $xml_return.="</row>";
        }
        $xml_return.="</table>";
        return $xml_return;
    }

    /*     * *****************
     * 修改科室
     * ****************** */

   
    public function ws_update($token, $xml_request) {
        $xml = new SimpleXMLElement($xml_request);
        if (empty($xml->uuid)) {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>uuid不能为空!</return_string>" . $this->_error_message_end;
        }
        if (empty($xml->department_name)) {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>科室名称不能为空!</return_string>" . $this->_error_message_end;
        }
        //机构转码
        $organization = new Torganization();
        $organization->whereAdd("standard_code='$xml->org_id'");
        $organization->find(true);
        $org_id = $organization->id;
        if (!$org_id) {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>机构码不正确!</return_string>" . $this->_error_message_end;
        }
        $department = new Tdepartment();
        $department->whereAdd("uuid='$xml->uuid'");
        if ($department->count() < 1) {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到该记录!</return_string>" . $this->_error_message_end;
        }
        $department = new Tdepartment();
        $department->updated = time();
        $department->status_flag = $xml->status_flag;
        $department->org_id = $org_id;
        $department->department_name = $xml->department_name;
        $department->sort_number = $xml->sort_number;
        $department->p_id = $xml->p_id; //没有可不填
        $department->whereAdd("uuid='$xml->uuid'");
        if ($department->update()) {
            return $this->_error_message_start . "<return_code>1</return_code><return_string>修改成功!</return_string>" . $this->_error_message_end;
        } else {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>修改失败!</return_string>" . $this->_error_message_end;
        }
    }

    /*     * *****************
     * 删除科室
     * 可以以uuid删除一条记录，也可以以机构号删除某机构下所有科室

     * ****************** */

    public function ws_delete($token, $xml_request) {
        $xml = new SimpleXMLElement($xml_request);
        if ($xml->org_id) {
            //机构转码
            $organization = new Torganization();
            $organization->whereAdd("standard_code='$xml->org_id'");
            $organization->find(true);
            $org_id = $organization->id;
            if (!$org_id) {
                return $this->_error_message_start . "<return_code>2</return_code><return_string>机构码不正确!</return_string>" . $this->_error_message_end;
            }
        }
        $department = new Tdepartment();
        if ($org_id) {
            $department->whereAdd("org_id='$org_id'");
        }
        if ($xml->uuid) {
            $department->whereAdd("uuid='$xml->uuid'");
        }
        if (empty($org_id) && empty($xml->uuid)) {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>缺少删除条件</return_string>" . $this->_error_message_end;
        }
        if ($department->count() < 1) {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到该记录</return_string>" . $this->_error_message_end;
        }
        if ($department->delete()) {
            return $this->_error_message_start . "<return_code>1</return_code><return_string>删除成功!</return_string>" . $this->_error_message_end;
        } else {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>删除失败!</return_string>" . $this->_error_message_end;
        }
    }

}

?>