<?php

/*
 * todo：坐诊表的生成与修改
 * author:whx
 * time:2012-11-13
 */

class appointment_zuozhenController extends controller
{

    public function init()
    {
        require_once (__SITEROOT . '/library/custom/comm_function.php');
        require_once (__SITEROOT . 'library/Models/zuozhen_dictionary.php');
        require_once (__SITEROOT . 'library/Models/appointment_register.php');
        require_once (__SITEROOT . 'library/Models/staff_archive.php');
        require_once (__SITEROOT . 'library/Models/department.php');
        require_once (__SITEROOT . 'library/Models/clinic.php');
        require_once (__SITEROOT . 'library/Models/number_species.php');
        require_once(__SITEROOT . 'library/Models/zuozhen.php');
        require_once(__SITEROOT . 'library/Models/staff_core.php'); //用户核心表
        require_once(__SITEROOT . "application/admin/models/getRoles.php"); //取得角色
        require_once(__SITEROOT . 'library/custom/pager.php'); //分页表
        $this->view->basePath = $this->_request->getBasePath();
    }

    /************************
     * 列出坐诊表
     * ********************** */

    public function listAction()
    {
        $zuozhen = new Tzuozhen();
        $dictionary = new Tzuozhen_dictionary();
        $org_id = $_SESSION['Zend_Auth']['storage']['org_id'];
        $region_id = $_SESSION['Zend_Auth']['storage']['region_id'];
        //获取当前机构下的医生    
        $dictionary->whereAdd("org_id='{$org_id}'");
        $dictionary->whereAdd("flag=2");
        // $dictionary->whereAdd("flag='1'");
        //$dictionary->whereAdd("org_id='17'");
        //如果还没有添加医生坐诊字典，则前往添加
        if ($dictionary->count() < 1)
        {
            $url = array("前往添加" => __BASEPATH . "appointment/dictionary/list/region_id/{$region_id}/org_id/{$org_id}");
            message("还没有坐诊字典,请先添加坐诊字典", $url);
            exit();
        }
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
                //$zuozhen->where("user_id='{$dictionary->user_id}'");
                if ($zuozhen->count() < 1)
                { //如果不存在当天的信息
                    $arr = $dictionary->toArray();
                    foreach ($arr as $key => $value)
                    {
                        $zuozhen->$key = $arr[$key]; //将字典的字段信息赋值给坐诊表
                    }
                    $zuozhen->uuid = uniqid();
                    $zuozhen->week = -1; //置星期字段初值为none
                    $zuozhen->flag=1;
                    $zuozhen->consulting_time = $consulting_time;
                    $week = explode(",", $dictionary->week); //分割字典坐诊日为数组
                    foreach ($week as $index => $w)
                    {
                        $theweek = explode("|", $w);
                        if ($theweek[0] == date("w", $consulting_time))
                        { //如果当天在字典中能找到，则当天为有效的坐诊日
                            $zuozhen->flag=2;
                            $zuozhen->week = $theweek[0];
                            $zuozhen->day = $theweek[1];
                            
                        }
                    }
                    $zuozhen->insert(); //插入记录
                }
            }
        }

        $staff_core = new Tstaff_core();
        $department = new Tdepartment();
        $clinic = new Tclinic();
        $number_species = new Tnumber_species();
        $dict = new Tzuozhen_dictionary();
        $zuozhen_list = new Tzuozhen();
        $zuozhen_list->joinAdd("left", $zuozhen_list, $department, "department", "uuid");
        $zuozhen_list->joinAdd("left", $zuozhen_list, $clinic, "clinic", "uuid");
        $zuozhen_list->joinAdd("left", $zuozhen_list, $number_species, "number_species", "uuid");
        $dict->whereAdd("org_id='" . $org_id . "'");
        $dict->whereAdd("flag='2'");
        //分页处理
        $nums = $dict->count();
        $page_size = 10; //每页显示的条数
        $sub_pages = 8; //每次显示的页数
        $pageCurrent = $this->_request->getParam('page');
        $links = new SubPages($page_size, $nums, $pageCurrent, $sub_pages, $this->_request->getBasePath() . $this->getModuleName() . '/' . $this->getControllerName() . '/' . $this->getActionName() . '/org_id/' . $org_id . '/region_id/' . $region_id . '/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = $page_size * ($pageCurrent - 1); //计算开始记录数
        $dict->limit($startnum, $page_size);
        $dict->find();
        $count = 0; //结果集数组下标
        $rows = array(); //存放所有医生的信息
        while ($dict->fetch())
        {
            $staff_core->orderby("org_id");
            $staff_core->where("id='{$dict->user_id}'");
            $staff_core->find(true);
            $rows[$count]['name'] = $staff_core->name_login; //用户登录名
            $rows[$count]['id'] = $staff_core->id;
            $zuozhen_list->where("zuozhen.org_id='" . $org_id . "' and zuozhen.user_id='" . $dict->user_id . "' and zuozhen.CONSULTING_TIME>'" . strtotime("-1 day") . "'");
            $zuozhen_list->orderby("CONSULTING_TIME asc");
            $zuozhen_list->find();
            $index = 0; //医生坐诊时间的下标
            while ($zuozhen_list->fetch())
            {
                $rows[$count]['uuid'] = $zuozhen_list->uuid;
                $rows[$count]['cols'][$index] = $zuozhen_list->toArray();
                $rows[$count]['cols'][$index]['department_name'] = $department->department_name;
                $rows[$count]['cols'][$index]['clinic_name'] = $clinic->clinic_name;
                $rows[$count]['cols'][$index]['number_species_name'] = $number_species->no_species_name;
                $rows[$count]['cols'][$index]['date'] = $zuozhen_list->consulting_time;
                $index++;
            }
            $count++;
        }


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
        $this->view->section_office_id_options = $section_office_id; //科室ID|select|1=>预防保健科,2=>全科医疗科,3=>药房,4=>检验室,5=>X光室,6=>B超室,7=>心电图室,8=>消毒供应室,9        =>信息资料室,10=>其它
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
        //print_r($rows);
        //分页
        $this->view->row = $rows;
        $this->view->record_count = $i; //记录数
        $out = $links->subPageCss2(); //获取显示样式，$out在smarty中将输出如下：
        $this->view->page = $out; //显示分页
        $this->view->pageCurrent = $pageCurrent; //当前页
        $this->view->days = $days;
        $this->view->rows = $rows;
        $this->view->display("list.html");
    }

    
    /***********************
     * 编辑坐诊表
     ************************/
  public function editAction()
      { 
        $datas = $this->_request->getParam("datas");
        $action = $this->_request->getParam("action");
        $user_id = $this->_request->getParam("user_id");
        $name = $this->_request->getParam("name");
        if ($action == "edit")
        {
            $days = array();
            for ($i = 0; $i <= 6; $i++)
            {
                $today = strtotime("+" . $i . "day", strtotime(date('y-m-d')));
                $days[$i]['day'] = date("m月d日", $today); //日期
                $days[$i]['stamptime'] = $today;
            }

            $zuozhen = new Tzuozhen();
            $zuozhen->whereAdd("user_id='$user_id'");
            $todaytime = strtotime("-1 day");
            $zuozhen->whereAdd("consulting_time>'$todaytime'");
            $zuozhen->orderby("CONSULTING_TIME asc");
            $zuozhen->find();
            $rows = array();
            $i = 0;
            while ($zuozhen->fetch())
            {
                $rows[$i] = $zuozhen->toArray();
                $rows[$i]['date']=  date("y-m-d",$zuozhen->consulting_time);
                $i++;
            }
           
            //获取科室
            $department = new Tdepartment();
            $department->whereAdd("status_flag=1");
            $department_array = array();
            $i = 1;
            $department_array[0]['department_name']="--请选择--";
            $department->find();
            while ($department->fetch())
            {
                $department_array[$i] = $department->toArray();
                $i++;
            }
            
            //获取诊室
            $clinic = new Tclinic();
            $clinic->where("status_flag=1");
            $clinic_array = array();
            $i = 1;
            $clinic_array[0]['clinic_name']="--请选择--";
            $clinic->find();
            while ($clinic->fetch())
            {
                $clinic_array[$i] = $clinic->toArray();
                $i++;
            }
            //获取号种
            $number_species = new Tnumber_species();
            $number_species->where("status_flag=1");
            $number_species_array = array();
            $i = 1;
            $number_species_array[0]['no_species_name']="--请选择--";
            $number_species->find();
            while ($number_species->fetch())
            {
                $number_species_array[$i] = $number_species->toArray();
                $i++;
            }
            $this->view->department = $department_array;
            $this->view->clinic = $clinic_array;
            $this->view->number_species = $number_species_array;
            $this->view->user_id = $user_id;
            $this->view->days = $days;
            $this->view->rows = $rows;
            $this->view->name = $name;
            $this->view->display("edit.html");
        }
        if ($action == "save")
        { 
            $datas = $this->_request->getParam("datas"); //获取表单传值
            $flag=0;
            foreach ($datas as $k => $v)
            {   
                $zuozhen = new Tzuozhen();
                if (!empty($v['flag']))  
                { //如果提交过来的数据，选择了当天，则当天有效，修改当天的数据
               
                    if (!empty($v['time']))
                    { //如果选择了坐诊时间 1.上午、2.下午、3.全天
                        $zuozhen->day = $v['time'];
                    } else
                    {
                        $zuozhen->day = 3; //如果没选择时间，则默认为全天
                    }
                    $zuozhen->flag=2;
                    $zuozhen->week = date("w", $k);
                    $zuozhen->department = $v['department'];
                    $zuozhen->clinic = $v['clinic'];
                    $zuozhen->number_species = $v['number_species'];
                } else
                {
                    $zuozhen->week = -1; //如果没有选择当天
                    $zuozhen->flag=1;
                }
                $zuozhen->where("user_id='$user_id' and consulting_time='$k'");
                if ($zuozhen->update())
                {
                    $flag = 1;
                } else
                {
                    $flag = 0;
                }
              
            }
            if ($flag == 1)
                { 
                    echo "1|修改该成功";
                } else
                {
                    echo "2|修改失败";
                }
        } 
        
    }

}

?>