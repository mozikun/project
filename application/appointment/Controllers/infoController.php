<?php

/**
 * @author：whx

 * @create：2012-7-3
 */
class appointment_infoController extends controller {

    public function init() {
        require_once(__SITEROOT . 'library/Models/staff_core.php'); //用户核心表
        require_once(__SITEROOT . 'library/Models/clinic.php'); //诊室表
        require_once(__SITEROOT . 'library/custom/pager.php');    //分页表
        require_once (__SITEROOT . '/library/custom/comm_function.php');
		require_once(__SITEROOT . 'library/Models/department.php'); 
		require_once(__SITEROOT . 'library/Models/zuozhen_dictionary.php'); 
		require_once(__SITEROOT . 'library/Models/organization.php'); 
		require_once(__SITEROOT . 'library/Models/zuozhen.php');
		
        $this->view->basePath = __BASEPATH;
    }

    

    public function indexAction() {
		/*
		$org_id=$this->_request->getParam("org_id");
		$this->view->org_id=$org_id;
		$staff_core=new Tstaff_core();
		$department=new Tdepartment();
		$dictionary=new Tzuozhen_dictionary();
		$organization=new Torganization();
		$organization->where("id='$org_id'");
		$staff_core->whereAdd("staff_core.role_id='14c29a32c28c09'");
		$organization->find(true);
		$this->view->organization=$organization->toArray();
		$dictionary->whereAdd("zuozhen_dictionary.org_id='$org_id'");
		$dictionary->joinAdd("inner",$dictionary,$department,"department","uuid");
		$dictionary->joinAdd("inner",$dictionary,$staff_core,"user_id","id");
		$dictionary->find();
		$count=0;
		$rows=array();
		while($dictionary->fetch()){
			$rows[$count]['doctor']=$staff_core->name_login;
			$rows[$count]['department']=$department->department_name;
			$count++;
			
		}
		*/
		
		$org_id = $this->_request->getParam("org_id"); //获取机构id
		//获取机构名字
		$organization=new Torganization();
		$organization->where("id='$org_id'");
		$organization->find(true);
		$this->view->organization=$organization->toArray();
		$this->view->org_id=$org_id;
		//获取科室
		$departments=new Tdepartment();
		$departments->whereAdd("org_id='$org_id'");
		$departments->find();
		$department_rows=array();
		$count=0;
		while($departments->fetch()){
			$department_rows[$count]=$departments->toArray();
			$count++;
		}
		$this->view->department_rows=$department_rows;
        $department=$this->_request->getParam("department");
		if(!empty($department))
		$this->view->department_id=$department;
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
					$zuozhen_list->whereAdd("zuozhen.org_id='" . $org_id . "' and zuozhen.user_id='" . $dict->user_id . "' and zuozhen.CONSULTING_TIME>'" . strtotime("-1 day") ."'and zuozhen.CONSULTING_TIME<'".strtotime("+2 day"). "'");
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
 //print_r($rows);
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
        for ($i = 0; $i <= 2; $i++)
        {
            $thedays = strtotime("+" . $i . "day");
            $days[$j]['day'] = date("m月d日", $thedays); //日期
            $days[$j]['week'] = $week[date("w", $thedays)]; //星期
            $days[$j]['date'] = $thedays;
            $j++;
        }
        $this->view->days = $days;
		$this->view->rows=$rows;
		$this->view->display("info.html");
        }

}