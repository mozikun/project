<?php

/*
 * @author whx
 * @todo 预约挂号信息
 * @time 2012-11-15
 * 
 */
require_once __SITEROOT . "application/api/models/api_phs_iha_comm.php";

class hisappointment extends api_phs_comm
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
        require_once __SITEROOT . "library/Models/staff_core.php"; //医生
        require_once __SITEROOT . "library/Models/department.php"; //科室
        $this->_error_message_start = "<?xml version='1.0' encoding='UTF-8'?><message>";
        $this->_error_message_end = "</message>";
       
    }

    /* **********************
     * 查询预约挂号信息
     * @param string $token
     * @param string $xml_string
     * ******************* */

    public function ws_select($token, $xml_request)
    {    
        //条件不为空时，解析查询条件
        $where_xml = new SimpleXMLElement($xml_request);
		
        $org_id = $where_xml->org_id;
        $department_id = $where_xml->department_id;
        $number_species_id = $where_xml->number_species_id;
        $doctor_id = $where_xml->doctor_id;
        $start_date = $where_xml->start_date;
        $end_date = $where_xml->end_date;
        
        require_once __SITEROOT . "library/Models/appointment_register.php"; //预约挂号表
        $register = new Tappointment_register();
		if(!empty($where_xml->id))
		{
        $register->whereAdd("uuid='{$where_xml->id}'");
		}
		if(!empty($org_id))
		{
        $register->whereAdd("org_id='{$org_id}'");
		}
        if (!empty($department_id))
        {
            $register->whereAdd("department_id='{$department_id}'");
        }
        if (!empty($number_species_id))
        {
            $register->whereAdd("numberspecies_id='{$number_species_id}'");
        }
        if (!empty($doctor_id))
        {
            $register->whereAdd("doctor_id='{$doctor_id}'");
        }
        if (!empty($start_date))
        {
            $register->whereAdd("register_date>='" . strtotime($start_date) . "'");
        }
        if (!empty($end_date))
        {
            $register->whereAdd("register_date<='" . strtotime($end_date) . "'");
        }
		if($where_xml->identity_number){
			$register->whereAdd("identity_number='$where_xml->identity_number'");

		}
        
        $exclude_array = array(); //不输出的内容
        if ($register->count() == 0)
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到符合查询条件的挂号信息！</return_string>" . $this->_error_message_end; //没有数据
        } else
        {
            $register->find();
            $xml_string = "<?xml version='1.0' encoding='UTF-8'?><tables><table name='appointment'>";
            while ($register->fetch())
            {
                $xml_string.="<row>";
                $xml_string.=$register->toXML("", $exclude_array);
                $xml_string.="</row>";
            }

            $xml_string.="</table>";
            $xml_string.="</tables>";
           
            return $xml_string;
        }
    }

    /* ***************************
     * 添加、更新预约挂号信息
     * ************************** */

    public function ws_update($token, $xml_request)
    {   
        $xml = new SimpleXMLElement($xml_request);
		if (empty($xml->id))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>UUID不能为空</return_string>" . $this->_error_message_end; 
        }
        if (empty($xml->doctor_id))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>医生ID不能为空</return_string>" . $this->_error_message_end; //医生id不能为空
        }
        if (empty($xml->org_id))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>机构ID不能为空</return_string>" . $this->_error_message_end; //机构id不能为空
        }
        if (empty($xml->status))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>挂号信息状态的不能为空</return_string>" . $this->_error_message_end; //信息状态不为空
        }
		/*
        if (empty($xml->name))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>患者姓名不能为空</return_string>" . $this->_error_message_end;
        }
        if (empty($xml->gender))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>患者性别不能为空</return_string>" . $this->_error_message_end;
        }
        if (empty($xml->age))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>患者年龄不能为空</return_string>" . $this->_error_message_end;
        }
		
        if (empty($xml->department_id))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>科室ID不能为空</return_string>" . $this->_error_message_end;
        }
        if (empty($xml->number_species_id))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>号种不能为空</return_string>" . $this->_error_message_end;
        }
		*/
        if (empty($xml->register_date))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>预约日期不能为空</return_string>" . $this->_error_message_end;
        }
        if (empty($xml->register_time))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>预约时间不能为空</return_string>" . $this->_error_message_end;
        }
        if (empty($xml->identity_number))
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>患者身份证号不能为空</return_string>" . $this->_error_message_end;
        }
        
       //验证日期的合法性 
        $string=$xml->register_date;
        if ( preg_match("/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/",$string) )
       {
            
         $first_sep = strpos($string,"-");

         $year = substr($string,0,$first_sep);

         $part_month_day = substr($string,$first_sep+1);   

         $last_sep = strpos($part_month_day,"-");   

         $month = substr( $part_month_day,0,$last_sep );

         $day = substr($part_month_day,$last_sep+1);

         if ( checkdate($month, $day, $year) ) {

            ;

        }else{
             return $this->_error_message_start . "<return_code>2</return_code><return_string>预约日期的格式不正确，正确的格式形如：yyyy-mm-dd.</return_string>" . $this->_error_message_end;

        }

    }else {

        return $this->_error_message_start . "<return_code>2</return_code><return_string>预约日期的格式不正确，正确的格式形如：yyyy-mm-dd.</return_string>" . $this->_error_message_end;

    }

        $date=  strtotime($xml->register_date);
        $register = new Tappointment_register();
		
        $register->doctor_id = $xml->doctor_id;
        $register->org_id=$xml->org_id;
        $register->name = $xml->name;
        $register->gender = $xml->gender;
        $register->age = $xml->age;
        $register->identity_number=$xml->identity_number;
        $register->department_id = $xml->department_id;
        $register->number_species_id = $xml->number_species_id;
        $register->clinic_id = $xml->clinic_id;
        $register->register_date = $date;
        $register->register_time = $xml->register_time;
        $register->status = $xml->status;
        
        //判定是什么操作
        $register_test = new Tappointment_register();
        $register_test->whereAdd("uuid='{$xml->id}'");
        
        //新增记录
        if ($register_test->count() == 0)
        {   
			$register->uuid=$xml->id;
			$date=date("y-m-d",time());
            $register->created=  strtotime("now");
           // $register->uuid=  uniqid();
            if ($register->insert())
            {
                return $this->_error_message_start . "<return_code>1</return_code><return_string>记录添加成功！</return_string>" . $this->_error_message_end;
            } else
            {
                
                return $this->_error_message_start . "<return_code>2</return_code><return_string>记录添加失败!</return_string>" . $this->_error_message_end;
            }
        }
        //更新记录
        else
        {  
           $register->whereAdd("uuid='{$xml->id}'");
           $register->updated=  strtotime("now");
            if ($register->update())
            {
                return $this->_error_message_start . "<return_code>1</return_code><return_string>记录更新成功!</return_string>" . $this->_error_message_end;
            } else
            {
                return $this->_error_message_start . "<return_code>2</return_code><return_string>记录更新失败！</return_string>" . $this->_error_message_end;
            }
        }
    }
	 /* ***************************
     * 查询挂号详细信息
     * ************************** */
	public function ws_select_detail($token,$xml_request){
	//return $xml_request;
		$xml = new SimpleXMLElement($xml_request);
		$appointment=new Tappointment_register();
		$staff_core=new Tstaff_core();
		$department=new Tdepartment();
		$appointment->joinAdd("inner",$appointment,$staff_core,"doctor_id","id");
		$appointment->joinAdd("inner",$appointment,$department,"department_id","uuid");
		
		if($xml->identity_number){
			$appointment->whereAdd("identity_number='$xml->identity_number'");
		}
		if($appointment->count()<1){
			 return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到符合查询条件的挂号信息！</return_string>" . $this->_error_message_end; //没有数据
		}
		else{
		$appointment->find();
		$xml_string = "<?xml version='1.0' encoding='UTF-8'?><tables><table name='appointment'>";
         while ($appointment->fetch())
            {
                $xml_string.="<row>";
                $xml_string.=$appointment->toXML("", $exclude_array)."<department_name>".$department->department_name."</department_name>"."<doctor_name>".$staff_core->name_login."</doctor_name>";
                $xml_string.="</row>";
            }

            $xml_string.="</table>";
            $xml_string.="</tables>";
           
            return $xml_string;
	}
	}

}

?>
