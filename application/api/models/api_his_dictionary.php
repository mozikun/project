<?php

/**
 * @author mask
 * @todo  医疗数据字典逻辑处理
 */
require_once __SITEROOT . "application/api/models/api_phs_iha_comm.php";

class hisdictionary extends api_phs_comm
{

    private $_error_message_start;
    private $_error_message_end;
    private $role_id;

    public function __construct()
    {

        require_once __SITEROOT . '/library/custom/comm_function.php'; //公有函数
        require_once __SITEROOT . "library/Models/organization.php"; //机构表
        require_once __SITEROOT . "application/api/models/api_phs_common.php";
        require_once __SITEROOT . "library/Models/appointment_register.php"; //预约挂号表
        $this->_error_message_start = "<?xml version='1.0' encoding='UTF-8'?><message>";
        $this->_error_message_end = "</message>";
    }

    /**
     * 查询数据字典信息
     *
     * @param string $token
     * @param string $xml_string
     */
    public function dictionary_info($token, $xml_string)
    {
        /* $mask_token		= check_token($token);//验证令牌

          if($mask_token==2){
          //令牌错误
          $xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>令牌错误</return_string></message>";
          return $xml_string;
          }elseif($mask_token==3){
          //令牌过期
          $xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>3</return_code><return_string>令牌过期</return_string></message>";
          return $xml_string;
          }elseif($mask_token!==1){
          //请先登陆
          $xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>4$mask_token</return_code><return_string>请先登陆</return_string></message>";
          return $xml_string;
          } */

        //条件不为空时，解析查询条件
        $where_xml = new SimpleXMLElement($xml_string);
        //标准机构号
        $stand_org_id = $where_xml->org_id;
        //内部机构号
        $org_id = $this->get_org_id($stand_org_id);
        //逻辑 1.科室字典,2.诊室,3号种
        $number = $where_xml->number; //


        if (empty($org_id))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>错误，标准机构码 org_id 不正确</return_string>" . $this->_error_message_end; //错误，请提供业务号ext_uuid
        }
        if (!in_array($number, array(1, 2, 3)))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>错误，逻辑处理编号 number 不正确</return_string>" . $this->_error_message_end; //错误，请提供业务号ext_uuid
        }


        switch ($number)
        {
            //科室字典信息
            case 1:
                //不输出的字段
                $exclude_array = array('staff_id', 'created', 'updated', 'status_flag', 'org_id', 'sort_number');
                require_once(__SITEROOT . "library/Models/department.php");
                $department = new Tdepartment();
                $department->whereAdd("org_id='$org_id'"); //机构号
                $department->whereAdd("status_flag=1"); //状态 启用
                $department->orderby("sort_number ASC"); //排序
                if ($department->count() == 0)
                {
                    return $this->_error_message_start . "<return_code>2</return_code><return_string>没有机构对应的科室数据！</return_string>" . $this->_error_message_end; //没有数据
                } else
                {
                    $department->find();
                    $xml_string = "<?xml version='1.0' encoding='UTF-8'?><tables><table name='department'>";
                    while ($department->fetch())
                    {
                        $xml_string.="<row>";
                        $xml_string.=$department->toXML("", $exclude_array);
                        $xml_string.="</row>";
                    }

                    $xml_string.="</table>";
                    $xml_string.="</tables>";
                    //echo $xml_string;
                    return $xml_string;
                }
                break;
            //诊室字典信息
            case 2:

                //不输出的字段
                $exclude_array = array('staff_id', 'created', 'updated', 'deleted', 'status_flag', 'org_id', 'sort_number');
                require_once(__SITEROOT . "library/Models/clinic.php");
                $clinic = new Tclinic();
                $clinic->whereAdd("org_id='$org_id'"); //机构号
                $clinic->whereAdd("status_flag=1"); //状态 启用
                $clinic->orderby("sort_number ASC"); //排序

                if ($clinic->count() == 0)
                {
                    return $this->_error_message_start . "<return_code>2</return_code><return_string>没有机构对应的诊室数据！</return_string>" . $this->_error_message_end; //没有数据
                } else
                {
                    $clinic->find();
                    $xml_string = "<?xml version='1.0' encoding='UTF-8'?><tables><table name='clinic'>";
                    while ($clinic->fetch())
                    {
                        $xml_string.="<row>";
                        $xml_string.=$clinic->toXML("", $exclude_array);
                        $xml_string.="</row>";
                    }

                    $xml_string.="</table>";
                    $xml_string.="</tables>";
                    //echo $xml_string;
                    return $xml_string;
                }
                break;
            //号种信息
            case 3:


                //不输出的字段
                $exclude_array = array('staff_id', 'created', 'updated', 'deleted', 'status_flag', 'org_id', 'registration_fee', 'medical_fee', 'service_fee', 'surcharge', 'sort_number');
                require_once(__SITEROOT . "library/Models/number_species.php");
                $number_species = new Tnumber_species();
                $number_species->whereAdd("org_id='$org_id'"); //机构号
                $number_species->whereAdd("status_flag=1"); //状态 启用
                $number_species->orderby("sort_number ASC"); //排序

                if ($number_species->count() == 0)
                {
                    return $this->_error_message_start . "<return_code>2</return_code><return_string>没有机构对应的号种数据！</return_string>" . $this->_error_message_end; //没有数据
                } else
                {
                    $number_species->find();
                    $xml_string = "<?xml version='1.0' encoding='UTF-8'?><tables><table name='clinic'>";
                    while ($number_species->fetch())
                    {
                        $xml_string.="<row>";
                        $xml_string.=$number_species->toXML("", $exclude_array);
                        $xml_string.="</row>";
                    }

                    $xml_string.="</table>";
                    $xml_string.="</tables>";
                    //echo $xml_string;
                    return $xml_string;

                    break;
                }
        }
    }

}

?>