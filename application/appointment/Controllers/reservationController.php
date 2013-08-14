<?php
/*
 * todo:预约页面
 * author:whx
 * time:2012-11-13
 */
class appointment_reservationController extends controller{
    public function init()
    {
        require_once (__SITEROOT . '/library/custom/comm_function.php');
        require_once (__SITEROOT . 'library/Models/zuozhen_dictionary.php');
        require_once (__SITEROOT . 'library/Models/appointment_register.php');
        require_once (__SITEROOT . 'library/Models/staff_archive.php');
        require_once (__SITEROOT . 'library/Models/department.php');
        require_once (__SITEROOT . 'library/Models/clinic.php');
        require_once (__SITEROOT . 'library/Models/number_species.php');
		require_once (__SITEROOT . 'library/Models/organization.php');
        require_once(__SITEROOT . 'library/Models/zuozhen.php');
        require_once(__SITEROOT . 'library/Models/staff_core.php'); //用户核心表
        require_once(__SITEROOT . 'library/Models/tips_message.php'); //用户核心表
        require_once(__SITEROOT . "application/admin/models/getRoles.php"); //取得角色
        require_once(__SITEROOT . 'library/custom/pager.php'); //分页表
        $this->view->basePath = $this->_request->getBasePath();
    }
    
    /*************************
     * 预约页面
     ************************/
    public function indexAction()
     { 
	    
	    //前端输出医生坐诊信息
        $org_id = $this->_request->getParam("org_id"); //获取机构id
		$this->view->org_id=$org_id;   
        $department=$this->_request->getParam("department"); 
        $dict = new Tzuozhen_dictionary();
		$organization=new Torganization();
		$organization->orderby("id");
		$organization->find();
		$n=1;
		$org=array();
		$orgs[0]['org_name']="请选择";
		while($organization->fetch()){
			$orgs[$n]['org_name']=$organization->zh_name;
			$orgs[$n]['org_id']=$organization->id;
			$n++;
		}
		$this->view->orgs=$orgs;
        //$dict->whereAdd("flag='1'");
        $dict->whereAdd("org_id='" . $org_id . "'");
        $dict->find();
        $count = 0; //结果集数组下标
        $rows = array(); //存放所有医生的信息
        while ($dict->fetch())
        {  
		   
		    $staff_core = new Tstaff_core();
			$staff_core->orderby("org_id");
            $staff_core->where("id='$dict->user_id'");
            $staff_core->find(true);
			if(($department!=-1)&&!empty($department))
			{
			$zuozhen_test= new Tzuozhen();
            $zuozhen_test->whereAdd("department='$department'");
            $zuozhen_test->whereAdd("user_id='$dict->user_id'");
			if($zuozhen_test->count()>0)
				{
					$zuozhen_list = new Tzuozhen();
					$zuozhen_list->whereAdd("zuozhen.org_id='" . $org_id . "' and zuozhen.user_id='" . $dict->user_id . "' and zuozhen.CONSULTING_TIME>'" . strtotime("-1 day") ."'");
					$zuozhen_list->orderby("CONSULTING_TIME asc");
					//$zuozhen_list->debug(1);
					$zuozhen_list->find();
			
            $index = 0; //医生坐诊时间的下标
            while ($zuozhen_list->fetch())
            {   
				$rows[$count]['name'] = $staff_core->name_login; //用户登录名
                $rows[$count]['id'] = $staff_core->id;
                $rows[$count]['uuid'] = $zuozhen_list->uuid;  
                $rows[$count]['cols'][$index] = $zuozhen_list->toArray();
                $rows[$count]['cols'][$index]['date'] = $zuozhen_list->consulting_time;
                $index++;
            }
            $count++;
        }
		}
        }
// print_r($rows);
//星期数组
        $week = array();
        $week[0] = '星期日';
        $week[1] = '星期一';
        $week[2] = '星期二';
        $week[3] = '星期三';
        $week[4] = '星期四';
        $week[5] = '星期五';
        $week[6] = '星期六';
//时间数组
        $day = array();
        $day[1] = '上午';
        $day[2] = '下午';
        $day[3] = '全天';
//启用状态
        $status = array();
        $status[0] = '关闭';
        $status[1] = '开启';
        $section_office_id = array('1' => '预防保健科', '2' => '全科医疗科', '3' => '药房', '4' => '检验室', '5' => 'X光室', '6' => 'B超室', '7' => '心电图室', '8' => '消毒供应室', '9' => '信息资料室', '10' => '其它');
        $this->view->section_office_id_options = $section_office_id; //科室ID|select|1=>预防保健科,2=>全科医疗科,3=>药房,4=>检验室,5=>X光室,6=>B超室,7=>心电图室,8=>消毒供应室,9=>信息资料室,10=>其它
//获取未来的7天时间
        $days = array();
        $j = 0; //为了数组下标从0开始，但是又能正确取到从明天开始的天数
        for ($i = 0; $i <= 6; $i++)
        {
            $thedays = strtotime("+" . $i . "day");
            $days[$j]['day'] = date("m月d日", $thedays); //日期
            $days[$j]['week'] = $week[date("w", $thedays)]; //星期
            $j++;
        }
        $this->view->days = $days;
        $this->view->rows = $rows;
        $this->view->display("index.html");
    }
    
    /*************************
     * 用户填写信息页面
     **************************/
    public function infoAction(){
        $section_office_id = array('1' => '预防保健科', '2' => '全科医疗科', '3' => '药房', '4' => '检验室', '5' => 'X光室', '6' => 'B超室', '7' => '心电图室', '8' => '消毒供应室', '9' => '信息资料室', '10' => '其它');
        $this->view->section_office_id_options = $section_office_id; //科室ID|select|1=>预防保健科,2=>全科医疗科,3=>药房,4=>检验室,5=>X光室,6=>B超室,7=>心电图室,8=>消毒供应室,9=>信息资料室,10=>其它
        $info['org_id'] = $this->_request->getParam('org_id');
        $info['doctor_id'] = $this->_request->getParam('doctor_id');
        $info['user_name'] = $this->_request->getParam('user_name');
        $info['day'] = $this->_request->getParam('day');
		$uuid=$this->_request->getParam("uuid");
        $register_time = $this->_request->getParam('register_time');
        $this->view->assign("org_id", $info['org_id']);
		$this->view->uuid=$uuid;
        $this->view->assign("doctor_id", $info['doctor_id']);
        $this->view->assign("user_name", $info['user_name']);
        $this->view->assign("register_time", $register_time);
        $this->view->assign("day", $info['day']);
        $this->view->display("info.html");
    }
    
    /****************************
     * 保存挂号信息
     *****************************/
    public function saveAction()
      { 
	    $uuid = $this->_request->getParam('uuid');
        $zuozhen = new Tzuozhen();
		$zuozhen->whereAdd("uuid='$uuid'");
		$zuozhen->find(true);
		$app_add = new Tappointment_register();
		$register_uuid=uniqid(); 
		$app_add->uuid = $register_uuid;
		
		$app_add->doctor_id =$zuozhen->user_id;
		$app_add->created = strtotime("now"); //创建时间
        $app_add->name = $this->_request->getParam('name');
        $app_add->gender = $this->_request->getParam('sex');
        $app_add->identity_number == $this->_request->getParam('id_card');
        $app_add->age = $this->_request->getParam("age");
		$phone_number=$this->_request->getParam("phone_number");
        $app_add->phone_number = $phone_number;
	
        $app_add->register_date =$zuozhen->consulting_time;
		$org_id=$zuozhen->org_id;
		$app_add->org_id=$org_id;
		$app_add->department_id=$zuozhen->department;
		$app_add->number_species_id=$zuozhen->number_species;
		$app_add->clinic_id=$zuozhen->clinic;
		
        $zuozhen = new Tzuozhen();
        $time = $this->_request->getParam('register_time');
		$app_add->register_time=$time;
       
        $zuozhen->whereAdd("uuid='" .$uuid."'"); 
        $zuozhen->find(true);
		$flag=0;
        if ($zuozhen->register_num_net > 1)
        { //更新记录
            if ($app_add->insert())
            {
                $zuozhen->register_num_net -= 1;
                $zuozhen->update();
                $flag=1;
            }
        }
       //数据为0时不能更新，单独处理
        if ($zuozhen->register_num_net == 1)
        {
            $zuozhen->register_num_net = -1;
            $zuozhen->update();
            $app_add->insert();
            $flag=1;
        }
		//发送短信
		if($flag==1){
			$message_id=uniqid('',true);
			require_once(__SITEROOT.'library/sms.php');//发短信库
			$sms=new SMS();
			$appointment_register=new Tappointment_register();
			$staff_core=new Tstaff_core();
			//$staff_core->whereAdd("id='4c5bae3d977f7'");
			//$staff_core->find(true);
			$organization =new Torganization();
			$department=new Tdepartment();
			$appointment_register->whereAdd("appointment_register.uuid='$register_uuid'");
			$appointment_register->joinAdd("left",$appointment_register,$staff_core,"doctor_id","id");
			$appointment_register->joinAdd("left",$appointment_register,$organization,"org_id","id");
			$appointment_register->joinAdd("left",$appointment_register,$department,"department_id","uuid");
			//echo $register_uuid
			$appointment_register->find(true);
			$sms_content='';
			//print_r( $appointment_register->register_date);exit();
			$sms_content='您已成功预约医生【'.$staff_core->name_login.'】,请于'.date("Y-m-d",$appointment_register->register_date).'日';
			$sms_content.=$appointment_register->consting_time==1?'上午':'下午'."准时到".$organization->zh_name.$department->department_name."就诊。";
			//echo $sms_content; exit();
			//echo $staff_core->name_login; echo  date("Y-m-d",$appointment_register->register_date) ;exit();
			$sms_date=date("Y-m-d H:i:s",time());
			$sms_status=$sms->sendSMS($message_id,$phone_number,$sms_content,$sms_date);//发送短信
            
			//插入短信记录表
			$tips_massage=new Ttips_message();
			$tips_massage->uuid=uniqid();
			$tips_massage->created=time();
			$tips_massage->content=$sms_content;
			$tips_massage->phone=$phone_number;
			$tips_massage->org_id=$org_id;
			$tips_massage->tips_type='11';
			$tips_massage->insert();
			
			
			for($i=1;$i<7;$i++){
			sleep($i);
			$sms_result_status=$sms->resultSMS($message_id,$phone_number);//短信返回结果
			if($sms_status && $sms_result_status){
				echo "挂号成功!";
				break;
				}
			
			}
		}
		if($zuozhen->register_num_net < 1)
			echo "该号已满";

    }
    
    /***********************
     * ajax获取科室信息
     ***********************/
    public function getinfoAction(){
        $org_id=$this->_request->getParam("org_id");
        $department=new Tdepartment();
       // $department->whereAdd("org_id='$org_id'");
		if($department->count()<1)
		$disabled='disabled';
		else
		$disabled='';
		$rows="<select id='department_id'" .$disabled." >";
		$rows.="<option value='-1'>请选择</option>";
        if(!empty($org_id)){
			$department=new Tdepartment();
            //$department->whereAdd("org_id='$org_id'");
			//if($department->count()>0)
            $department->find();
			
           while($department->fetch()){ 
				$rows.="<option value='".$department->uuid."'>".$department->department_name."</option>";
			}
			
        }
	   $rows.="</select>";
       echo $rows;
    }
}
?>