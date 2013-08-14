<?php
/****
 * @author whx
 * @todo 坐诊信息接口
 * @time 2012-11-15
 * *********** */
require_once __SITEROOT . "application/api/models/api_phs_iha_comm.php";

class hiszuozhen extends api_phs_comm
{

    private $_error_message_start;
    private $_error_message_end;
    private $role_id;

    public function __construct()
    {

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

    /* ******************
     * 坐诊信息查询
	 * 首先默认从平台坐诊字典生成坐诊表，然后按条件查询,可以按机构、科室、医生、坐诊时间组合进行查询
     * ****************** */

    public function ws_select($token, $xml_request)
    {
        //条件不为空时，解析查询条件
        $where_xml = new SimpleXMLElement($xml_request);
       
        $exclude_array=array('uuid','created','week');//不输出的字段
		//机构转码
		$organization=new Torganization();
		$organization->whereAdd("standard_code='$where_xml->org_id'");
		$organization->find(true);
		$org_id=$organization->id;
		if(!$org_id){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>机构码不正确!</return_string>" . $this->_error_message_end; 
		}
        //首先生成请求机构的医生坐诊信息
        $zuozhen = new Tzuozhen();
        $dictionary = new Tzuozhen_dictionary();
        //获取当前机构下的医生    
        $dictionary->whereAdd("org_id='{$org_id}'");
        $dictionary->whereAdd("flag=2");
        $dictionary->find(); // print_r($dictionary->toArray());exit();
        $arr = array();
        while ($dictionary->fetch())
        {
            $today = date("y-m-d"); //获取今天的格式化时间
            $nowtime = strtotime($today); //今天中午12点的时间戳
            for ($i = 0; $i <= 6; $i++)    
            { //循环从当天起的8天
                $consulting_time = strtotime("+" . $i . "day", $nowtime);
                $zuozhen->where("consulting_time='" . $consulting_time . "' and user_id='{$dictionary->user_id}'"); //查找该天是否已经存在于坐诊表，如存在就不再生成当日的记录

                if ($zuozhen->count() < 1)
                { //如果不存在当天的信息
                    $arr = $dictionary->toArray();
                    foreach ($arr as $key => $value)
                    {
                        $zuozhen->$key = $arr[$key]; //将字典的字段信息赋值给坐诊表
                    }
                    $zuozhen->uuid = uniqid();
                    $zuozhen->week = -1; //置星期字段初值为none
                    $zuozhen->consulting_time = $consulting_time;
                    $week = explode(",", $dictionary->week); //分割字典坐诊日为数组
                    foreach ($week as $index => $w)
                    {
                        $theweek = explode("|", $w);
                        if ($theweek[0] == date("w", $consulting_time))
                        { //如果当天在字典中能找到，则当天为有效的坐诊日如果当天能够在字典里面找到
                            $zuozhen->week = $theweek[0];
                            $zuozhen->day = $theweek[1];
                        }
                    }
                    $zuozhen->insert(); //插入记录
                }
            }
        }
        
        //查询坐诊信息
        $zuozhen = new Tzuozhen();
        $zuozhen->whereAdd("org_id='$org_id'");
		//验证科室
        if (!empty($where_xml->department))
        {   
			$department=new Tdepartment();
			$department->whereAdd("uuid='$where_xml->department'");
			if($department->count()==0){
				return $this->_error_message_start . "<return_code>2</return_code><return_string>科室编码不正确!</return_string>" . $this->_error_message_end;
			}
            $zuozhen->whereAdd("department='$where_xml->department'");
        }
       
		//验证医生
        if (!empty($where_xml->user_id)){
			$staff_core=new Tstaff_core();
			$staff_core->whereAdd("id='$where_xml->user_id'");
			if($staff_core->count()==0){
				return $this->_error_message_start . "<return_code>2</return_code><return_string>医生编码不正确!</return_string>" . $this->_error_message_end;
			}
            $zuozhen->whereAdd("user_id='$where_xml->user_id'");
		}
		//添加预约日期
		if($where_xml->consulting_time){
			$consulting_time=strtotime($where_xml->consulting_time);
			$zuozhen->whereAdd("consulting_time='$consulting_time'");
		}
		if($where_xml->start_date){
			$start_date=strtotime($where_xml->start_date);
			$zuozhen->whereAdd("consulting_time>='$start_date'");
		}
		if($where_xml->end_date){
			$end_date=strtotime($where_xml->end_date);
			$zuozhen->whereAdd("consulting_time<='$end_date'");
		}
		//过滤不坐诊的信息
		if($where_xml->day==2){
		$zuozhen->whereAdd("day>=1");
		
		}
	
        if ($zuozhen->count()==0)
        {
            return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到符合查询条件的坐诊信息!</return_string>" . $this->_error_message_end; //机构号必需
        } else
        {
            $zuozhen->find();
            $xml_return = "<?xml version='1.0' encoding='UTF-8'?><tables><table name='zuozhen'>";
            while ($zuozhen->fetch())
            {
                $xml_return.="<row>";
                $xml_return.=$zuozhen->toXML("",$exclude_array);
                $xml_return.="</row>";
            }

            $xml_return.="</table>";
            $xml_return.="</tables>";
            //echo $xml_string;
            return $xml_return;
        }
    }
	
	 /* ******************
     * 坐诊表添加、修改
	 * 以医生id和预约时间来确定唯一性
     * ****************** */
	public function ws_update($token, $xml_request){
		$xml = new SimpleXMLElement($xml_request);
		//检查医生id
		if($xml->user_id){
			$staff_core=new Tstaff_core();
			$staff_core->whereAdd("id='$xml->user_id'");
			if($staff_core->count()==0){
				return $this->_error_message_start . "<return_code>2</return_code><return_string>医生编码不正确!</return_string>" . $this->_error_message_end;
		    }
		}else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>医生编码不能为空!</return_string>" . $this->_error_message_end;
		}
		//机构转码
		$organization=new Torganization();
		$organization->whereAdd("standard_code='$xml->org_id'");
		$organization->find(true);
		$org_id=$organization->id;
		if(!$org_id){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>机构码不正确!</return_string>" . $this->_error_message_end; 
		}
		//检查科室
		if($xml->department){
			$department=new Tdepartment();
			$department->whereAdd("uuid='$xml->department'");
			if($department->count()==0){
				return $this->_error_message_start . "<return_code>2</return_code><return_string>科室编码不正确!</return_string>" . $this->_error_message_end; 
			}	
		}else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>科室编码不能为空!</return_string>" . $this->_error_message_end; 
		}
		//创建坐诊对象
		$zuozhen=new Tzuozhen();
		$zuozhen->org_id=$org_id;
		$zuozhen->day=$xml->day;
		$zuozhen->register_num_total=$xml->register_num_total;
		$zuozhen->register_num_net=$xml->register_num_net;
		$zuozhen->registration_fee=$xml->registration_fee;
		$zuozhen->medical_fees=$xml->medical_fees;
		$zuozhen->fee=$xml->fee;
		$zuozhen->flag=$xml->flag;
		$zuozhen->department=$xml->department;
		$zuozhen->clinic=$xml->clinic;
		$zuozhen->number_species=$xml->number_species;
		$consulting_time=strtotime($xml->consulting_time);
		
		//判断该更新还是新增记录,如果当天该医生有坐诊则更新，如果没有则新增
		$zz=new Tzuozhen();
		$zz->whereAdd("user_id='$xml->user_id'");
		$zz->whereAdd("consulting_time='$consulting_time'");
		if($zz->count()>0){ 
			//如果该坐诊已经有挂号，则不允许再修改
			$appointment_register=new Tappointment_register();
			$appointment_register->whereAdd("doctor_id='$xml->user_id' and register_date='$consulting_time'");
			if($appointment_register->count()>0){
				return $this->_error_message_start . "<return_code>2</return_code><return_string>修改失败，该坐诊信息已经有挂号!</return_string>" . $this->_error_message_end; 
			}
			$zuozhen->whereAdd("user_id='$xml->user_id'");
			$zuozhen->whereAdd("consulting_time='$consulting_time'");
			if($zuozhen->update()){
			
				return $this->_error_message_start . "<return_code>1</return_code><return_string>修改成功!</return_string>" . $this->_error_message_end;
			}
			else{   
				return $this->_error_message_start . "<return_code>2</return_code><return_string>修改失败!</return_string>" . $this->_error_message_end;
			}
		}else{
			$zuozhen->uuid=uniqid();
			$zuozhen->created=time();
			$zuozhen->user_id=$xml->user_id;
			$zuozhen->consulting_time=$consulting_time;
			if($zuozhen->insert()){
				return $this->_error_message_start . "<return_code>1</return_code><return_string>新增成功!</return_string>" . $this->_error_message_end;
			}else{
				return $this->_error_message_start . "<return_code>2</return_code><return_string>新增记录失败!</return_string>" . $this->_error_message_end;
			}
		}
		
	 }

	  /* ******************
     * 坐诊表删除
     * ****************** */
	public function ws_delete($token, $xml_request){
		$xml = new SimpleXMLElement($xml_request);
		$consulting_time=strtotime($xml->consulting_time);
		//判断该记录下是否已经有人挂号
		$appointment_register=new Tappointment_register();
		$appointment_register->whereAdd("doctor_id='$xml->user_id' and register_date='$consulting_time'");
		if($appointment_register->count()>0){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>删除失败，该坐诊信息已经有挂号!</return_string>" . $this->_error_message_end; 
		}
		
		$zuozhen=new Tzuozhen();
		$zuozhen->whereAdd("user_id='$xml->user_id' and consulting_time='$consulting_time'");
		if($zuozhen->count()<1){
			return $this->_error_message_start . "<return_code>2</return_code><return_string>未找到任何记录!</return_string>" . $this->_error_message_end; 
		}
		if($zuozhen->delete()){
			return $this->_error_message_start . "<return_code>1</return_code><return_string>删除成功!</return_string>" . $this->_error_message_end;
		}
		else{
			return $this->_error_message_start . "<return_code>2</return_code><return_string>删除失败!</return_string>" . $this->_error_message_end;
		}
		
	 }
	 


}

?>