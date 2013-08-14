<?php

/**
 * @author：whx
 * @create：2012-5-15
 */
class appointment_indexController extends controller
{

    public function init()
    {
        $this->haveWritePrivilege = '';
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

    public function dictionaryAction()
    { //输出添加坐诊字典页面
        
        $uuid = $this->_request->getParam('uuid');
        $user_id = $this->_request->getParam('user_id');
        $org_id = $this->_request->getParam('org_id');
        $dictionary = new Tzuozhen_dictionary();
        $staff=new Tstaff_core();
        $staff->where("id='{$user_id}'");
        $staff->find(true);
        $this->view->staff_name=$staff->name_login;
        $dictionary->whereAdd("zuozhen_dictionary.user_id='{$uuid}'");
        //判断用户挂号字典是否存在，确定是否读取数据库显示用户挂号字典信息
        $week = array();
        if ($dictionary->count() > 0)
        {
            $dictionary->find(true);
            $rows = $dictionary->toArray();  
            $weeks = explode(",", $dictionary->week);
            $week = array();
            foreach ($weeks as $k => $v)
            {
                if (!empty($v))
                {
                    $data = explode("|", $v);
                    $w = $data[0];
                    $time = $data[1];
                    $week[$w]['week'] = $w;
                    $week[$w]['time'] = $time;
                }
            }
            $this->view->row = $rows;
        }
        //获取科室
        $department = new Tdepartment();
        $department->whereAdd("status_flag=1");
        $department_array = array();
        $i = 1;
        $department_array[0]="";
        $department->find();
        while ($department->fetch())
        {
            $department_array[$i] = $department->toArray();
            $i++;
        }
        //获取诊室
        $clinic = new Tclinic();
        $clinic->whereAdd("status_flag=1");
        $clinic_array = array();
        $i = 1;
        $clinic_array[0]="";
        $clinic->find();
        while ($clinic->fetch())
        {
            $clinic_array[$i] = $clinic->toArray();
            $i++;
        }
        //获取号种
        $number_species = new Tnumber_species();
        $number_species->whereAdd("status_flag=1");
        $number_species_array = array();
        $i = 1;
        $number_species_array[0]="";
        $number_species->find();
        while ($number_species->fetch())
        {
            $number_species_array[$i] = $number_species->toArray();
            $i++;
        }
        $this->view->department = $department_array;
        $this->view->clinic = $clinic_array;
        $this->view->number_species = $number_species_array;
        $this->view->week = $week;
        $this->view->assign('org_id', $org_id);
        $this->view->assign('uuid', $uuid);
        $this->view->assign('user_id', $user_id);
        $this->view->display('dictionary.html');
    }

    public function dictionary_addAction()
    {    // print_r($_POST);exit();
        //添加坐诊字典到数据库
        $week = $this->_request->getParam('week');
        $appointment = new Tzuozhen_dictionary();
        $app = array();
        $app['uuid'] = uniqid();
        // $app['week'] = implode(',', $week);
        $app['user_id'] = $this->_request->getParam('uuid');
        $app['org_id'] = $this->_request->getParam('org_id');
        $app['CREATED'] = strtotime("now");
        $app['day'] = $this->_request->getParam('day');
        $app['REGISTER_NUM_TOTAL'] = $this->_request->getParam('REGISTER_NUM_TOTAL');
        $app['REGISTER_NUM_NET'] = $this->_request->getParam('REGISTER_NUM_NET');
        $app['REGISTRATION_FEE'] = $this->_request->getParam('REGISTRATION_FEE');
        $app['MEDICAL_FEES'] = $this->_request->getParam('MEDICAL_FEES');
        $app['FEE'] = $this->_request->getParam('FEE');
        $app['flag'] = $this->_request->getParam('flag');
        $app['department'] = $this->_request->getParam('department');
        $app['clinic'] = $this->_request->getParam('clinic');
        $app['number_species'] = $this->_request->getParam('number_species');
        $time = $this->_request->getParam('time'); //坐诊时间

        $weeks = "";
        foreach ($week as $k => $v)
        {
            if (!empty($time[$v]))
            {
                $weeks.=$v . "|" . $time[$v] . ",";
            }
        }
        $app['week'] = $weeks;
        // 将数据赋给数据对象
        foreach ($app as $index => $v)
        {
            $appointment->$index = $v;
        }
        $appointment->whereAdd("user_id='{$app['user_id']}'"); // echo $appointment->count();exit();
        //若记录不存在，新增记录
        if ($appointment->count() < 1)
        {
            if ($appointment->insert())
            {
                echo "1|添加成功！";
                exit();
            } else
            {
                echo "3|添加失败!";
                exit();
            }
        } //记录已存在，更新记录
        else
        {
            if ($appointment->update())
            {
                echo "2|更新成功！";
                exit();
            } else
            {
                echo "4|更新失败!";
                exit();
            }
        }
    }

    /*
     * 坐诊列表的生成与修改
     */

    public function dictionary_listAction()
    {
        $zuozhen = new Tzuozhen();
        $dictionary = new Tzuozhen_dictionary();
        $org_id = $_SESSION['Zend_Auth']['storage']['org_id'];
        $region_id = $_SESSION['Zend_Auth']['storage']['region_id'];
        //获取当前机构下的医生    
        $dictionary->whereAdd("org_id='{$org_id}'");
        // $dictionary->whereAdd("flag='1'");
        //$dictionary->whereAdd("org_id='17'");
        //如果还没有添加医生坐诊字典，则前往添加
        if ($dictionary->count() < 1)
        {
            $url = array("前往添加" => __BASEPATH . "appointment/index/dictionaryindex/region_id/{$region_id}/org_id/{$org_id}");
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
// message("生成成功!"); exit();

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
        $dict->whereAdd("flag='1'");
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
                // $rows[$count]['department_name'] = $department->department_name;
                //  $rows[$count]['clinic_name'] = $clinic->clinic_name;
                //  $rows[$count]['number_species_name'] = $number_species->no_species_name;
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
//print_r($rows);
//分页
        $this->view->row = $rows;
        $this->view->record_count = $i; //记录数
        $out = $links->subPageCss2(); //获取显示样式，$out在smarty中将输出如下：
        $this->view->page = $out; //显示分页
        $this->view->pageCurrent = $pageCurrent; //当前页
        $this->view->days = $days;
        $this->view->rows = $rows;
        $this->view->display("zz_list.html");
    }

    public function doctorAction()
    { //前端输出医生坐诊信息
        $org_id = $this->_request->getParam("organize_code"); //获取机构id
        $staff_core = new Tstaff_core();
        $dict = new Tzuozhen_dictionary();
        $zuozhen_list = new Tzuozhen();
        $dict->whereAdd("flag='1'");
        $dict->whereAdd("org_id='" . $org_id . "'");
        $dict->find();
        $count = 0; //结果集数组下标
        $rows = array(); //存放所有医生的信息
        while ($dict->fetch())
        {
            $staff_core->where("id='{$dict->user_id}'");
            $staff_core->find(true);
            $rows[$count]['name'] = $staff_core->name_login; //用户登录名
            $rows[$count]['id'] = $staff_core->id;
            $zuozhen_list->where("org_id='" . $org_id . "' and user_id='" . $dict->user_id . "' and CONSULTING_TIME>='" . strtotime(date('y-m-d')) . "'");
            $zuozhen_list->find();
            $index = 0; //医生坐诊时间的下标
            while ($zuozhen_list->fetch())
            {
                $rows[$count]['uuid'] = $zuozhen_list->uuid;
                $rows[$count]['cols'][$index] = $zuozhen_list->toArray();
                $index++;
            }
            $count++;
        }
//  print_r($rows);
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
        $this->view->display("doctor.html");
    }

    public function appointment_indexAction()
    { //输出添加挂号信息页面
        $section_office_id = array('1' => '预防保健科', '2' => '全科医疗科', '3' => '药房', '4' => '检验室', '5' => 'X光室', '6' => 'B超室', '7' => '心电图室', '8' => '消毒供应室', '9' => '信息资料室', '10' => '其它');
        $this->view->section_office_id_options = $section_office_id; //科室ID|select|1=>预防保健科,2=>全科医疗科,3=>药房,4=>检验室,5=>X光室,6=>B超室,7=>心电图室,8=>消毒供应室,9=>信息资料室,10=>其它
        $info['org_id'] = $this->_request->getParam('org_id');
        $info['doctor_id'] = $this->_request->getParam('doctor_id');
        $info['user_name'] = $this->_request->getParam('user_name');
        $info['day'] = $this->_request->getParam('day');
        $this->view->assign("org_id", $info['org_id']);
        $this->view->assign("doctor_id", $info['doctor_id']);
        $this->view->assign("user_name", $info['user_name']);
        $this->view->assign("day", $info['day']);
        $this->view->display("appointment_add.html");
    }

    public function appointment_addAction()
    { //插入挂号信息到数据库
        $zuozhen = new Tzuozhen();
        $app_add = new Tappointment_register();
        $day = $this->_request->getParam('day');
        $app_add->register_time = $day;
        $app_add->uuid = uniqid();
        $app_add->doctor_id = $this->_request->getParam('doctor_id');
        $app_add->org_name = $this->_request->getParam('org_id');
        $zuozhen->whereAdd("user_id='{$app_add->doctor_id}'");
        $zuozhen->whereAdd("consulting_time='" . $day . "'");
        $zuozhen->find(true);
        $app_add->created = strtotime("now"); //创建时间
        $app_add->name = $this->_request->getParam('name');
        $app_add->gender = $org_id = $this->_request->getParam('sex');
        $app_add->identity_number = $org_id = $this->_request->getParam('id_card');
        $app_add->age = $this->_request->getParam('age');
        $app_add->doctor_name = $this->_request->getParam('user_name');
        if ($zuozhen->register_num_net > 1)
        { //更新记录
            if ($app_add->insert())
            {
                $zuozhen->register_num_net -= 1;
                $zuozhen->update();
                $url = array(
                    "选择其它医生" => __BASEPATH . 'appointment/index/doctor',);
                message("挂号成功！", $url);
            }
        }
//数据为0时不能更新，单独处理
        if ($zuozhen->register_num_net == 1)
        {
            $zuozhen->register_num_net = -1;
            $zuozhen->update();
            $app_add->insert();
            $url = array(
                "选择其它医生" => __BASEPATH . 'appointment/index/doctor',);
            message("挂号成功！", $url);
        }

//$day=$this->_request->getParam('day');
    }

    public function appointment_listAction()
    { //后台挂号列表
        $staff_core = new Tstaff_core();
        $guahao_list = new Tappointment_register();
        $org_id = $_SESSION['Zend_Auth']['storage']['org_id'];
        $region_id = $_SESSION['Zend_Auth']['storage']['region_id'];
        $guahao_list->whereAdd("org_name='{$org_id}'");
        $nums = $guahao_list->count();

        $page_size = 10; //每页显示的条数
        $sub_pages = 8; //每次显示的页数
        $pageCurrent = $this->_request->getParam('page');
        $links = new SubPages($page_size, $nums, $pageCurrent, $sub_pages, $this->_request->getBasePath() . $this->getModuleName() . '/' . $this->getControllerName() . '/' . $this->getActionName() . '/org_id/' . $org_id . '/region_id/' . $region_id . '/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = $page_size * ($pageCurrent - 1); //计算开始记录数
        $guahao_list->limit($startnum, $page_size);
        $guahao_list->find();
        $rows = array();
        $count = 0;
        while ($guahao_list->fetch())
        {

            $rows[$count] = $guahao_list->toArray();
            $rows[$count]['register_time'] = date("y-m-d", $guahao_list->register_time); //格式化预约时间
            $rows[$count]['doctor_name'] = $guahao_list->doctor_name;
            $count++;
        }
        $a = 0;
        $this->view->row = $rows;
        $this->view->record_count = $count; //记录数
        $out = $links->subPageCss2(); //获取显示样式，$out在smarty中将输出如下：
        $this->view->out = $out; //显示分页
        $this->view->pageCurrent = $pageCurrent; //当前页
        $this->view->go_back = $this->_request->getParam("go_back", ''); //返回标识 是否出现到机构的链接
        $this->view->display("appointment_list.html");
    }

    /*
     * 修改坐诊表
     */

    public function zz_table_editAction()
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
            $department_array[0]="";
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
            $clinic_array[0]="";
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
            $number_species_array[0]="";
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
            $this->view->display("zz_edit.html");
        }
        if ($action == "save")
        {
            $datas = $this->_request->getParam("datas"); //获取表单传值
            $flag=0;
            foreach ($datas as $k => $v)
            {   
                $zuozhen = new Tzuozhen();
                if (!empty($v['day']))
                { //如果提交过来的数据，选择了当天，则当天有效，修改当天的数据
                    if (!empty($v['time']))
                    { //如果选择了坐诊时间 1.上午、2.下午、3.全天
                        $zuozhen->day = $v['time'];
                    } else
                    {
                        $zuozhen->day = 3; //如果没选择时间，则默认为全天
                    }
                    $zuozhen->week = date("w", $k);
                    $zuozhen->department = $v['department'];
                    $zuozhen->clinic = $v['clinic'];
                    $zuozhen->number_species = $v['number_species'];
                } else
                {
                    $zuozhen->week = -1; //如果没有选择当天
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
                    echo "修改该成功";
                } else
                {
                    echo "修改失败";
                }
        } 
        
    }

    public function dictionaryindexAction()
    {
        require_once(__SITEROOT . 'library/Models/organization.php'); //机构表
        $org_id = $this->_request->getParam("org_id", '');
        $region_id = $this->_request->getParam("region_id", '');


        if (!empty($org_id))
        {
            //---根据机构ID验证数据---start
            $organization = new Torganization();
            $organization->whereAdd("id={$org_id}");
            //$organization->debugLevel(9);
            $organization->find();
            $count = 0;
            while ($organization->fetch())
            {
                $this->view->org_name = $organization->zh_name; //机构名
                $this->view->url_org_name = urlencode($organization->zh_name); //url编码后的机构名
                $this->view->org_id = $organization->id; //机构ID
                $this->view->region_id = $region_id; //地区id
                $this->view->region_path = $organization->region_path; //所属区域
                $count++;
            }
            //输出异常
            if ($count < 1)
            {
                throw new Exception("参数错误!");
            }
            //-----根据机构ID验证数据----end
            require_once(__SITEROOT . 'library/custom/pager.php');
            //用户列表
            $staff_core = new Tstaff_core();
            $staff_archive = new Tstaff_archive();
            $staff_core->joinAdd('inner', $staff_core, $staff_archive, 'id', 'user_id');
            $staff_core->whereAdd("org_id={$org_id}");
            $nums = $staff_core->count();
            //$staff_core->debugLevel(9);

            $staff_core = new Tstaff_core();
            $staff_archive = new Tstaff_archive();
            $staff_core->joinAdd('inner', $staff_core, $staff_archive, 'id', 'user_id');
            $staff_core->whereAdd("org_id={$org_id}");
            //$staff_core->whereAdd("role_id<>'14c57779e5c21f'");
            $staff_core->orderby("standard_code ASC");

            $page_size = 10; //每页显示的条数
            $sub_pages = 8; //每次显示的页数
            $pageCurrent = $this->_request->getParam('page');
            $links = new SubPages($page_size, $nums, $pageCurrent, $sub_pages, $this->_request->getBasePath() . $this->getModuleName() . '/' . $this->getControllerName() . '/' . $this->getActionName() . '/org_id/' . $org_id . '/region_id/' . $region_id . '/page/', 2, array());
            $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
            $startnum = $page_size * ($pageCurrent - 1); //计算开始记录数
            $staff_core->limit($startnum, $page_size);
            $staff_core->find();
            $row = array();
            $record_count = 0; //记录数;
            while ($staff_core->fetch())
            {
                $row[$record_count]['id'] = $staff_core->id; //id
                $row[$record_count]['standard_code'] = $staff_core->standard_code; //standard_code
                $row[$record_count]['name_login'] = $staff_core->name_login; //登录名
                $roles_arr = getRoles($staff_core->role_id); //取得角色数组
                $role = $roles_arr[0]['role_zh_name']; //得到角色中文名
                $row[$record_count]['role_name'] = $role; //角色名 
                //$row[$record_count]['role_id'] = $staff_core->role_id == '14c29a32c28c09' ? 1 : 0;
                $row[$record_count]['user_id'] = $staff_archive->id;
                $record_count++;
            }

            //print_r($row);
            $this->view->record_count = $record_count; //记录数
            $this->view->row = $row;
            $out = $links->subPageCss2(); //获取显示样式，$out在smarty中将输出如下：
            $this->view->out = $out; //显示分页
            $this->view->pageCurrent = $pageCurrent; //当前页
            $this->view->go_back = $this->_request->getParam("go_back", ''); //返回标识 是否出现到机构的链接
            $this->view->display("dictionaryindex.html");
        }
    }

}

?>
