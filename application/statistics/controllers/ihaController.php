<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class statistics_ihaController extends controller
{
    /**
     * The default action - show the home page
     */
    public function init()
    {
        $this->view->assign("baseUrl", __BASEPATH);
        $this->view->assign("basePath", __BASEPATH);
        require_once __SITEROOT . "library/Models/individual_archive.php";
        require_once __SITEROOT . "library/Models/individual_core.php";
        require_once __SITEROOT . "library/Models/organization.php";
        require_once __SITEROOT . "library/custom/pager.php";
        require_once __SITEROOT . 'library/custom/adodb-time.inc.php'; //引入时间处理
        //require_once __SITEROOT . 'library/custom/iha_comm.php';
        require_once __SITEROOT . 'library/custom/comm_function.php';
        require_once (__SITEROOT . 'library/Myauth.php');
        require_once (__SITEROOT . 'library/privilege.php');
    }
    public function indexAction()
    {
        $time = time();
        $time_start = $this->_request->getParam('startDate') ? $this->_request->
            getParam('startDate') : date("Y-m-d");
        $time_end = $this->_request->getParam('endDate') ? $this->_request->getParam('endDate') :
            date("Y-m-d");
        $serach_type = $this->_request->getParam('serach_type') ? $this->_request->
            getParam('serach_type') : "day"; //默认按天算
        $this->view->assign("serach_type", $serach_type);
        $this->view->assign("startDate", $time_start);
        $this->view->assign("endDate", $time_end);
        $this->view->display("index.html");
    }
    public function totalAction()
    {
        require_once (__SITEROOT . 'library/custom/region_array.php');
        //2010-12-13修正
        $staff_core_region_path_domain = get_region_path(2);
        $time = time();
        $time_start = $this->_request->getParam('startDate') ? $this->_request->
            getParam('startDate') : date("Y-m-d");
        $time_end = $this->_request->getParam('endDate') ? $this->_request->getParam('endDate') :
            date("Y-m-d");
        $serach_type = $this->_request->getParam('serach_type') ? $this->_request->
            getParam('serach_type') : "day"; //默认按天算
        $this->view->assign("serach_type", $serach_type);
        $this->view->assign("startDate", $time_start);
        $this->view->assign("endDate", $time_end);
        $unit = array(
            'day' => '日',
            'week' => '周',
            'quarter' => '季',
            'month' => '月',
            'year' => '年');
        $this->view->assign("unit", $unit); //单位数组
        $times = $time_start . "-" . $time_end;

        $time_start = mkunixstamp($time_start);
        $time_end = mkunixstamp($time_end);
        $time_start = adodb_mktime(0, 0, 0, date("n", $time_start), date("j", $time_start),
            date("Y", $time_start));
        $time_end = adodb_mktime(0, 0, 0, date("n", $time_end), date("j", $time_end) + 1,
            date("Y", $time_end));
        //分组统计人数
        $core = new Tindividual_core();
        $staff_core = new Tstaff_core();
        $core->joinAdd('inner', $core, $staff_core, 'staff_id', 'id');
        $core->whereAdd($staff_core_region_path_domain);
        $core->whereAdd("individual_core.updated>$time_start");
        $core->whereAdd("individual_core.updated<$time_end");
        //2012-02-22 我好笨修改，仅统计正常档案（罗老师QQ回复）
        $core->whereAdd("individual_core.status_flag=1");
        //$core->whereAdd("org_id='$org_id'"); 叶
        //$core->whereAdd($individual_core_region_path_domain);//罗
        switch ($serach_type)
        {
            case 'day':
                {
                    $serach_type = "DD";
                    $core->groupBy("individual_core.staff_id,to_char(unixts_to_date(individual_core.updated),'yyyy-mm-$serach_type')");
                    $core->selectAdd("to_char(unixts_to_date(individual_core.updated),'yyyy-mm-$serach_type') as day,individual_core.staff_id as staff_id,count(distinct individual_core.uuid) as nums,max(individual_core.criteria_rate) as max_criteria_rate,min(individual_core.criteria_rate) as min_criteria_rate,avg(individual_core.criteria_rate) as avg_criteria_rate");
                    break;
                }
            case 'week':
                {
                    $serach_type = "iw";
                    $core->groupBy("individual_core.staff_id,to_char(unixts_to_date(individual_core.updated),'yyyy($serach_type)')");
                    $core->selectAdd("to_char(unixts_to_date(individual_core.updated),'yyyy($serach_type)') as day,individual_core.staff_id as staff_id,count(distinct individual_core.uuid) as nums,max(individual_core.criteria_rate) as max_criteria_rate,min(individual_core.criteria_rate) as min_criteria_rate,avg(individual_core.criteria_rate) as avg_criteria_rate");
                    break;
                }
            case 'quarter':
                {
                    $serach_type = "q";
                    $core->groupBy("individual_core.staff_id,to_char(unixts_to_date(individual_core.updated),'yyyy($serach_type)')");
                    $core->selectAdd("to_char(unixts_to_date(individual_core.updated),'yyyy($serach_type)') as day,individual_core.staff_id as staff_id,count(distinct individual_core.uuid) as nums,max(individual_core.criteria_rate) as max_criteria_rate,min(individual_core.criteria_rate) as min_criteria_rate,avg(individual_core.criteria_rate) as avg_criteria_rate");
                    break;
                }
            case 'month':
                {
                    $serach_type = "mm";
                    $core->groupBy("individual_core.staff_id,to_char(unixts_to_date(individual_core.updated),'yyyy-$serach_type')");
                    $core->selectAdd("to_char(unixts_to_date(individual_core.updated),'yyyy-$serach_type') as day,individual_core.staff_id as staff_id,count(distinct individual_core.uuid) as nums,max(individual_core.criteria_rate) as max_criteria_rate,min(individual_core.criteria_rate) as min_criteria_rate,avg(individual_core.criteria_rate) as avg_criteria_rate");
                    break;
                }
            case 'year':
                {
                    $serach_type = "yyyy";
                    $core->groupBy("individual_core.staff_id,to_char(unixts_to_date(individual_core.updated),'$serach_type')");
                    $core->selectAdd("to_char(unixts_to_date(individual_core.updated),'$serach_type') as day,individual_core.staff_id as staff_id,count(distinct individual_core.uuid) as nums,max(individual_core.criteria_rate) as max_criteria_rate,min(individual_core.criteria_rate) as min_criteria_rate,avg(individual_core.criteria_rate) as avg_criteria_rate");
                    break;
                }
            default:
                {
                    $serach_type = "DD";
                    $core->groupBy("individual_core.staff_id,to_char(unixts_to_date(individual_core.updated),'yyyy-mm-$serach_type')");
                    $core->selectAdd("to_char(unixts_to_date(individual_core.updated),'yyyy-mm-$serach_type') as day,individual_core.staff_id as staff_id,count(distinct individual_core.uuid) as nums,max(individual_core.criteria_rate) as max_criteria_rate,min(individual_core.criteria_rate) as min_criteria_rate,avg(individual_core.criteria_rate) as avg_criteria_rate");
                    break;
                }
        }
        //$core->debugLevel(9);
        $core->find();
        $se = array();
        $i = 0;
        require_once __SITEROOT . '/library/custom/region_array.php';
        while ($core->fetch())
        {
            $se[$core->staff_id][$i]['day'] = $core->day;
            $staff = get_staff_byid($core->staff_id);
            $se[$core->staff_id][$i]['doctor_name'] = $staff->name_login ? $staff->
                name_login : "未知的错误";
            $doctor_path = @explode(",", str_replace($this->user['current_region_path'] .
                ",", "", $staff->region_path));
            $doctor_address = "";
            foreach ($doctor_path as $k => $v)
            {
                if ($v != '0')
                {
                    if ($v != '1')
                    {
                        $doctor_address .= @$regionInfo[$v][0];
                    }
                }
            }
            $se[$core->staff_id][$i]['doctor_path'] = $doctor_address;
            $se[$core->staff_id][$i]['nums'] = $core->nums;
            $se[$core->staff_id][$i]['max_criteria_rate'] = $core->max_criteria_rate * 100;
            $se[$core->staff_id][$i]['min_criteria_rate'] = $core->min_criteria_rate * 100;
            $se[$core->staff_id][$i]['avg_criteria_rate'] = round($core->avg_criteria_rate,
                4) * 100;
            $i++;
        }
        //print_r($se);
        $this->view->assign("core", $se);
        $this->view->display("total.html");
    }
    /**
     * 完成线性图绘图
     */
    public function totalimgAction()
    {
        require_once (__SITEROOT . 'library/custom/region_array.php');
        //2010-12-13修正
        $staff_core_region_path_domain = get_region_path(2);
        $time = time();
        $time_start = $this->_request->getParam('startDate') ? $this->_request->
            getParam('startDate') : date("Y-m-d");
        $time_end = $this->_request->getParam('endDate') ? $this->_request->getParam('endDate') :
            date("Y-m-d");
        $serach_type = $this->_request->getParam('serach_type') ? $this->_request->
            getParam('serach_type') : "day"; //默认按天算
        $this->view->assign("serach_type", $serach_type);
        $this->view->assign("startDate", $time_start);
        $this->view->assign("endDate", $time_end);
        $unit = array(
            'day' => '日',
            'week' => '周',
            'quarter' => '季',
            'month' => '月',
            'year' => '年');
        $this->view->assign("unit", $unit); //单位数组
        $units = $unit[$serach_type];
        $times = "";
        $times = $time_start . "-" . $time_end;
        $time_start = mkunixstamp($time_start);
        $time_end = mkunixstamp($time_end);
        $time_start = adodb_mktime(0, 0, 0, date("n", $time_start), date("j", $time_start) -
            1, date("Y", $time_start));
        $time_end = adodb_mktime(0, 0, 0, date("n", $time_end), date("j", $time_end) + 1,
            date("Y", $time_end));
        $t = list_time($time_start, $time_end, $serach_type);
        //分组统计人数
        $core = new Tindividual_core();
        $staff_core = new Tstaff_core();
        $core->joinAdd('inner', $core, $staff_core, 'staff_id', 'id');
        $core->whereAdd($staff_core_region_path_domain);
        $core->whereAdd("individual_core.updated>=$time_start");
        $core->whereAdd("individual_core.updated<=$time_end");
        //2012-02-22 我好笨修改，仅统计正常档案（罗老师QQ回复）
        $core->whereAdd("individual_core.status_flag=1");
        switch ($serach_type)
        {
            case 'day':
                {
                    $serach_type = "DD";
                    $core->groupBy("individual_core.staff_id,to_char(unixts_to_date(individual_core.updated),'yyyy-mm-$serach_type')");
                    $core->selectAdd("to_char(unixts_to_date(individual_core.updated),'yyyy-mm-$serach_type') as day,individual_core.staff_id as staff_id,count(distinct individual_core.uuid) as nums,max(individual_core.criteria_rate) as max_criteria_rate,min(individual_core.criteria_rate) as min_criteria_rate,avg(individual_core.criteria_rate) as avg_criteria_rate");
                    break;
                }
            case 'week':
                {
                    $serach_type = "iw";
                    $core->groupBy("individual_core.staff_id,to_char(unixts_to_date(individual_core.updated),'yyyy($serach_type)')");
                    $core->selectAdd("to_char(unixts_to_date(individual_core.updated),'yyyy($serach_type)') as day,individual_core.staff_id as staff_id,count(distinct individual_core.uuid) as nums,max(individual_core.criteria_rate) as max_criteria_rate,min(individual_core.criteria_rate) as min_criteria_rate,avg(individual_core.criteria_rate) as avg_criteria_rate");
                    break;
                }
            case 'quarter':
                {
                    $serach_type = "q";
                    $core->groupBy("individual_core.staff_id,to_char(unixts_to_date(individual_core.updated),'yyyy($serach_type)')");
                    $core->selectAdd("to_char(unixts_to_date(individual_core.updated),'yyyy($serach_type)') as day,individual_core.staff_id as staff_id,count(distinct individual_core.uuid) as nums,max(individual_core.criteria_rate) as max_criteria_rate,min(individual_core.criteria_rate) as min_criteria_rate,avg(individual_core.criteria_rate) as avg_criteria_rate");
                    break;
                }
            case 'month':
                {
                    $serach_type = "mm";
                    $core->groupBy("individual_core.staff_id,to_char(unixts_to_date(individual_core.updated),'yyyy-$serach_type')");
                    $core->selectAdd("to_char(unixts_to_date(individual_core.updated),'yyyy-$serach_type') as day,individual_core.staff_id as staff_id,count(distinct individual_core.uuid) as nums,max(individual_core.criteria_rate) as max_criteria_rate,min(individual_core.criteria_rate) as min_criteria_rate,avg(individual_core.criteria_rate) as avg_criteria_rate");
                    break;
                }
            case 'year':
                {
                    $serach_type = "yyyy";
                    $core->groupBy("individual_core.staff_id,to_char(unixts_to_date(individual_core.updated),'$serach_type')");
                    $core->selectAdd("to_char(unixts_to_date(individual_core.updated),'$serach_type') as day,individual_core.staff_id as staff_id,count(distinct individual_core.uuid) as nums,max(individual_core.criteria_rate) as max_criteria_rate,min(individual_core.criteria_rate) as min_criteria_rate,avg(individual_core.criteria_rate) as avg_criteria_rate");
                    break;
                }
            default:
                {
                    $serach_type = "DD";
                    $core->groupBy("individual_core.staff_id,to_char(unixts_to_date(individual_core.updated),'yyyy-mm-$serach_type')");
                    $core->selectAdd("to_char(unixts_to_date(individual_core.updated),'yyyy-mm-$serach_type') as day,individual_core.staff_id as staff_id,count(distinct individual_core.uuid) as nums,max(individual_core.criteria_rate) as max_criteria_rate,min(individual_core.criteria_rate) as min_criteria_rate,avg(individual_core.criteria_rate) as avg_criteria_rate");
                    break;
                }
        }
        //$core->debugLevel(9);

        $core->find();
        $se = array();
        $i = 0;
        while ($core->fetch())
        {
            $se[$core->staff_id]['data'][$core->day] = $core->nums ? $core->nums : 0;
            $se[$core->staff_id]['seriename'] = get_staff_name_byid($core->staff_id);
            $i++;
        }
        $pic_data = array();
        foreach ($t as $j => $h)
        {
            foreach ($se as $k => $v)
            {
                if (!isset($v['data'][$h]))
                {
                    $pic_data[$k]['data'][$h] = 0;
                }
                else
                {
                    $pic_data[$k]['data'][$h] = $se[$k]['data'][$h];
                }
                $pic_data[$k]['seriename'] = $se[$k]['seriename'];
            }
        }
        //绘图
        $title = "健康档案建档按" . $units . "统计($times)线性图";
        @drawline($pic_data, $t, "", "建档人数(人)", $units, "", $title);
        //@drawbar($pic_data,$t,"","建档人数(人)",$units,"",$title);
    }
    /**
     * 档案综合统计，按性别、按血型等统计
     */
    public function compositeAction()
    {
        //		$time=time();
        //		$time_start=$this->_request->getParam('startDate')?$this->_request->getParam('startDate'):"2010-06-09";
        //		$time_end=$this->_request->getParam('endDate')?$this->_request->getParam('endDate'):"2010-06-29";
        //		$time_start=mkunixstamp($time_start);
        //		$time_end=mkunixstamp($time_end);
        //		$time_start=adodb_mktime(0,0,0,date("n",$time_start),date("j",$time_start)+1,date("Y",$time_start));
        //		$time_end=adodb_mktime(0,0,0,date("n",$time_end),date("j",$time_end)+1,date("Y",$time_end));
        //		$s=ihaStatistics("individual_core",$time_start,$time_end,"race","count(*) as nums,race as name");
        $time = time();
        $time_start = $this->_request->getParam('startDate') ? $this->_request->
            getParam('startDate') : date("Y-m-d");
        $time_end = $this->_request->getParam('endDate') ? $this->_request->getParam('endDate') :
            date("Y-m-d");
        $serach_type = $this->_request->getParam('serach_type') ? $this->_request->
            getParam('serach_type') : "all"; //默认按天算
        $this->view->assign("serach_type", $serach_type);
        $this->view->assign("startDate", $time_start);
        $this->view->assign("endDate", $time_end);
        $this->view->display("composite.html");
    }
    public function allAction()
    {
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        $org_id = $this->user['org_id'];
        $org = new Torganization();
        $org->whereAdd("id='$org_id'");
        $org->find(true);
        //$region_path_domain=$org->region_path_domain;
        $temp = explode("|", $org->region_path_domain);
        $individual_core_region_path_domain = '';
        $staff_core_region_path_domain = '';
        foreach ($temp as $k1 => $v1)
        {
            $individual_core_region_path_domain = $individual_core_region_path_domain .
                "individual_core.region_path like '" . $v1 . "%' or ";
        }
        $individual_core_region_path_domain = rtrim($individual_core_region_path_domain,
            ' or ');
        $time = time();
        $is_pic = $this->_request->getParam('pic');
        $pic_type = $this->_request->getParam('pictype');
        $time_start = $this->_request->getParam('startDate') ? $this->_request->
            getParam('startDate') : date("Y-m-d");
        $time_end = $this->_request->getParam('endDate') ? $this->_request->getParam('endDate') :
            date("Y-m-d");
        $serach_type = $this->_request->getParam('serach_type') ? $this->_request->
            getParam('serach_type') : "all"; //
        $this->view->assign("startDate", $time_start);
        $this->view->assign("serach_type", $serach_type);
        $this->view->assign("endDate", $time_end);
        $times = $time_start . "-" . $time_end;
        $time_start = mkunixstamp($time_start);
        $time_end = mkunixstamp($time_end);
        $time_start = adodb_mktime(0, 0, 0, date("n", $time_start), date("j", $time_start),
            date("Y", $time_start));
        $time_end = adodb_mktime(0, 0, 0, date("n", $time_end), date("j", $time_end) + 1,
            date("Y", $time_end));
        $s = array();
        $i = 0;
        if ($serach_type == 'sex' || $serach_type == 'all')
        {
            $s[$i]['data'] = ihaStatistics("individual_archive", $org_id, $time_start, $time_end,
                "sex", "count(*) as nums,sex as name", $sex, $individual_core_region_path_domain);
            $s[$i]['title'] = "按性别统计(统计时间：$times)";
            $s[$i]['picname'] = "sex"; //给统计图定位标签
            $temp[0] = isset($s[$i]['data']['data']) ? $s[$i]['data']['data'] : "";
            $temp[0]['axisname'] = "人数";
            //加载饼状图
            if ($is_pic)
            {
                if ($pic_type == "pie")
                {
                    echo xml_draw_3d_pie($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
                if ($pic_type == "bar")
                {
                    //加载柱形图
                    echo xml_draw_3d_bar($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
            }
            $i++;
        }
        if ($serach_type == 'race' || $serach_type == 'all')
        {
            $s[$i]['data'] = ihaStatistics("individual_archive", $org_id, $time_start, $time_end,
                "race", "count(*) as nums,race as name", $race, $individual_core_region_path_domain);
            $s[$i]['title'] = "按民族统计(统计时间：$times)";
            $s[$i]['picname'] = "race"; //给统计图定位标签
            $temp[0] = isset($s[$i]['data']['data']) ? $s[$i]['data']['data'] : "";
            $temp[0]['axisname'] = "人数";
            //加载饼状图
            if ($is_pic)
            {
                if ($pic_type == "pie")
                {
                    echo xml_draw_3d_pie($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
                if ($pic_type == "bar")
                {
                    //加载柱形图
                    echo xml_draw_3d_bar($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
            }
            $i++;
        }
        if ($serach_type == 'occupation' || $serach_type == 'all')
        {
            $s[$i]['data'] = ihaStatistics("individual_archive", $org_id, $time_start, $time_end,
                "individual_archive.occupation",
                "count(distinct individual_archive.id) as nums,individual_archive.occupation as name",
                $occupation, $individual_core_region_path_domain);
            $s[$i]['title'] = "按职业统计(统计时间：$times)";
            $s[$i]['picname'] = "occupation"; //给统计图定位标签
            $temp[0] = isset($s[$i]['data']['data']) ? $s[$i]['data']['data'] : "";
            $temp[0]['axisname'] = "人数";
            //加载饼状图
            if ($is_pic)
            {
                if ($pic_type == "pie")
                {
                    echo xml_draw_3d_pie($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
                if ($pic_type == "bar")
                {
                    //加载柱形图
                    echo xml_draw_3d_bar($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
            }
            $i++;
        }
        if ($serach_type == 'residence' || $serach_type == 'all')
        {
            $s[$i]['data'] = ihaStatistics("individual_archive", $org_id, $time_start, $time_end,
                "individual_archive.residence",
                "count(distinct individual_archive.id) as nums,individual_archive.residence as name",
                $registered_permanent_residence, $individual_core_region_path_domain);
            $s[$i]['title'] = "按常住类型统计(统计时间：$times)";
            $s[$i]['picname'] = "residence"; //给统计图定位标签
            $temp[0] = isset($s[$i]['data']['data']) ? $s[$i]['data']['data'] : "";
            $temp[0]['axisname'] = "人数";
            //加载饼状图
            if ($is_pic)
            {
                if ($pic_type == "pie")
                {
                    echo xml_draw_3d_pie($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
                if ($pic_type == "bar")
                {
                    //加载柱形图
                    echo xml_draw_3d_bar($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
            }
            $i++;
        }
        if ($serach_type == 'ABO_bloodtype' || $serach_type == 'all')
        {
            $s[$i]['data'] = ihaStatistics("blood_type", $org_id, $time_start, $time_end,
                "blood_type.ABO_bloodtype",
                "count(distinct blood_type.id) as nums,blood_type.ABO_bloodtype as name", $ABO_bloodtype,
                $individual_core_region_path_domain);
            $s[$i]['title'] = "按血型统计(统计时间：$times)";
            $s[$i]['picname'] = "ABO_bloodtype"; //给统计图定位标签
            $temp[0] = isset($s[$i]['data']['data']) ? $s[$i]['data']['data'] : "";
            $temp[0]['axisname'] = "人数";
            //加载饼状图
            if ($is_pic)
            {
                if ($pic_type == "pie")
                {
                    echo xml_draw_3d_pie($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
                if ($pic_type == "bar")
                {
                    //加载柱形图
                    echo xml_draw_3d_bar($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
            }
            $i++;
        }
        if ($serach_type == 'school_type' || $serach_type == 'all')
        {
            $s[$i]['data'] = ihaStatistics("individual_archive", $org_id, $time_start, $time_end,
                "individual_archive.study_history",
                "count(distinct individual_archive.id) as nums,individual_archive.study_history as name",
                $school_type, $individual_core_region_path_domain);
            $s[$i]['title'] = "按文化程度统计(统计时间：$times)";
            $s[$i]['picname'] = "school_type"; //给统计图定位标签
            $temp[0] = isset($s[$i]['data']['data']) ? $s[$i]['data']['data'] : "";
            $temp[0]['axisname'] = "人数";
            //加载饼状图
            if ($is_pic)
            {
                if ($pic_type == "pie")
                {
                    echo xml_draw_3d_pie($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
                if ($pic_type == "bar")
                {
                    //加载柱形图
                    echo xml_draw_3d_bar($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
            }
            $i++;
        }
        if ($serach_type == 'marriage' || $serach_type == 'all')
        {
            $s[$i]['data'] = ihaStatistics("individual_archive", $org_id, $time_start, $time_end,
                "individual_archive.marriage",
                "count(distinct individual_archive.id) as nums,individual_archive.marriage as name",
                $marriage, $individual_core_region_path_domain);
            $s[$i]['title'] = "按婚姻状况统计(统计时间：$times)";
            $s[$i]['picname'] = "marriage"; //给统计图定位标签
            $temp[0] = isset($s[$i]['data']['data']) ? $s[$i]['data']['data'] : "";
            $temp[0]['axisname'] = "人数";
            //加载饼状图
            if ($is_pic)
            {
                if ($pic_type == "pie")
                {
                    echo xml_draw_3d_pie($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
                if ($pic_type == "bar")
                {
                    //加载柱形图
                    echo xml_draw_3d_bar($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
            }
            $i++;
        }
        if ($serach_type == 'charge_style' || $serach_type == 'all')
        {
            $s[$i]['data'] = ihaStatistics("charge_style", $org_id, $time_start, $time_end,
                "charge_style.charge_style",
                "count(charge_style.id) as nums,charge_style.charge_style as name", $charge_style,
                $individual_core_region_path_domain);
            $s[$i]['title'] = "按医疗支付方式统计(统计时间：$times)";
            $s[$i]['picname'] = "charge_style"; //给统计图定位标签
            $temp[0] = isset($s[$i]['data']['data']) ? $s[$i]['data']['data'] : "";
            $temp[0]['axisname'] = "人数";
            //加载饼状图
            if ($is_pic)
            {
                if ($pic_type == "pie")
                {
                    echo xml_draw_3d_pie($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
                if ($pic_type == "bar")
                {
                    //加载柱形图
                    echo xml_draw_3d_bar($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
            }
            $i++;
        }
        if ($serach_type == 'allergy' || $serach_type == 'all')
        {
            $s[$i]['data'] = ihaStatistics("allergy", $org_id, $time_start, $time_end,
                "allergy.allergy_code", "count(allergy.id) as nums,allergy.allergy_code as name",
                $allergy_history, $individual_core_region_path_domain);
            $s[$i]['title'] = "按药物过敏史统计(统计时间：$times)";
            $s[$i]['picname'] = "allergy"; //给统计图定位标签
            $temp[0] = isset($s[$i]['data']['data']) ? $s[$i]['data']['data'] : "";
            $temp[0]['axisname'] = "人数";
            //加载饼状图
            if ($is_pic)
            {
                if ($pic_type == "pie")
                {
                    echo xml_draw_3d_pie($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
                if ($pic_type == "bar")
                {
                    //加载柱形图
                    echo xml_draw_3d_bar($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
            }
            $i++;
        }
        if ($serach_type == 'disease_history' || $serach_type == 'all')
        {
            $s[$i]['data'] = ihaStatistics("individual_archive", $org_id, $time_start, $time_end,
                "individual_archive.disease_history",
                "count(distinct individual_archive.id) as nums,individual_archive.disease_history as name",
                $comm, $individual_core_region_path_domain);
            $s[$i]['title'] = "按疾病史统计(统计时间：$times)";
            $s[$i]['picname'] = "disease_history"; //给统计图定位标签
            $temp[0] = isset($s[$i]['data']['data']) ? $s[$i]['data']['data'] : "";
            $temp[0]['axisname'] = "人数";
            //加载饼状图
            if ($is_pic)
            {
                if ($pic_type == "pie")
                {
                    echo xml_draw_3d_pie($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
                if ($pic_type == "bar")
                {
                    //加载柱形图
                    echo xml_draw_3d_bar($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
            }
            $i++;
        }
        if ($serach_type == 'surgery_history' || $serach_type == 'all')
        {
            $s[$i]['data'] = ihaStatistics("individual_archive", $org_id, $time_start, $time_end,
                "individual_archive.surgery_history",
                "count(distinct individual_archive.id) as nums,individual_archive.surgery_history as name",
                $comm, $individual_core_region_path_domain);
            $s[$i]['title'] = "按手术史统计(统计时间：$times)";
            $s[$i]['picname'] = "surgery_history"; //给统计图定位标签
            $temp[0] = isset($s[$i]['data']['data']) ? $s[$i]['data']['data'] : "";
            $temp[0]['axisname'] = "人数";
            //加载饼状图
            if ($is_pic)
            {
                if ($pic_type == "pie")
                {
                    echo xml_draw_3d_pie($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
                if ($pic_type == "bar")
                {
                    //加载柱形图
                    echo xml_draw_3d_bar($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
            }
            $i++;
        }
        if ($serach_type == 'trauma_history' || $serach_type == 'all')
        {
            $s[$i]['data'] = ihaStatistics("individual_archive", $org_id, $time_start, $time_end,
                "individual_archive.trauma_history",
                "count(distinct individual_archive.id) as nums,individual_archive.trauma_history as name",
                $comm, $individual_core_region_path_domain);
            $s[$i]['title'] = "按外伤史统计(统计时间：$times)";
            $s[$i]['picname'] = "trauma_history"; //给统计图定位标签
            $temp[0] = isset($s[$i]['data']['data']) ? $s[$i]['data']['data'] : "";
            $temp[0]['axisname'] = "人数";
            //加载饼状图
            if ($is_pic)
            {
                if ($pic_type == "pie")
                {
                    echo xml_draw_3d_pie($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
                if ($pic_type == "bar")
                {
                    //加载柱形图
                    echo xml_draw_3d_bar($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
            }
            $i++;
        }
        if ($serach_type == 'blood_history' || $serach_type == 'all')
        {
            $s[$i]['data'] = ihaStatistics("individual_archive", $org_id, $time_start, $time_end,
                "individual_archive.blood_history",
                "count(distinct individual_archive.id) as nums,individual_archive.blood_history as name",
                $comm, $individual_core_region_path_domain);
            $s[$i]['title'] = "按输血史统计(统计时间：$times)";
            $s[$i]['picname'] = "blood_history"; //给统计图定位标签
            $temp[0] = isset($s[$i]['data']['data']) ? $s[$i]['data']['data'] : "";
            $temp[0]['axisname'] = "人数";
            //加载饼状图
            if ($is_pic)
            {
                if ($pic_type == "pie")
                {
                    echo xml_draw_3d_pie($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
                if ($pic_type == "bar")
                {
                    //加载柱形图
                    echo xml_draw_3d_bar($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
            }
            $i++;
        }
        if ($serach_type == 'genetic_diseases_history' || $serach_type == 'all')
        {
            $s[$i]['data'] = ihaStatistics("individual_archive", $org_id, $time_start, $time_end,
                "individual_archive.genetic_diseases_history",
                "count(distinct individual_archive.id) as nums,individual_archive.genetic_diseases_history as name",
                $comm, $individual_core_region_path_domain);
            $s[$i]['title'] = "按遗传病史统计(统计时间：$times)";
            $s[$i]['picname'] = "genetic_diseases_history"; //给统计图定位标签
            $temp[0] = isset($s[$i]['data']['data']) ? $s[$i]['data']['data'] : "";
            $temp[0]['axisname'] = "人数";
            //加载饼状图
            if ($is_pic)
            {
                if ($pic_type == "pie")
                {
                    echo xml_draw_3d_pie($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
                if ($pic_type == "bar")
                {
                    //加载柱形图
                    echo xml_draw_3d_bar($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
            }
            $i++;
        }
        if ($serach_type == 'disability' || $serach_type == 'all')
        {
            $s[$i]['data'] = ihaStatistics("individual_archive", $org_id, $time_start, $time_end,
                "individual_archive.disability",
                "count(distinct individual_archive.id) as nums,individual_archive.disability as name",
                $comm, $individual_core_region_path_domain);
            $s[$i]['title'] = "按残疾状况统计(统计时间：$times)";
            $s[$i]['picname'] = "disability"; //给统计图定位标签
            $temp[0] = isset($s[$i]['data']['data']) ? $s[$i]['data']['data'] : "";
            $temp[0]['axisname'] = "人数";
            //加载饼状图
            if ($is_pic)
            {
                if ($pic_type == "pie")
                {
                    echo xml_draw_3d_pie($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
                if ($pic_type == "bar")
                {
                    //加载柱形图
                    echo xml_draw_3d_bar($temp, $s[$i]['data']['name'], "人数", "人", $s[$i]['title']);
                    exit;
                }
            }
            $i++;
        }
        $this->view->assign("data", $s);
        $this->view->display("all.html");
    }
    /**
     * statistics_ihaController::cdAction()
     * 
     * 完成慢病按年统计的展示
     * 
     * @author 我好笨
     * @return void
     */
    public function cdAction()
    {
        $time = time();
        $time_start = $this->_request->getParam('startDate') ? $this->_request->
            getParam('startDate') : date("Y");
        $time_end = $this->_request->getParam('endDate') ? $this->_request->getParam('endDate') :
            date("Y");
        $serach_type = "year"; //按年统计
        $this->view->assign("serach_type", $serach_type);
        $this->view->assign("startDate", $time_start);
        $this->view->assign("endDate", $time_end);
        $this->view->display("cd.html");
    }
    /**
     * statistics_ihaController::cdnumsAction()
     * 
     * 完成慢病按年统计的实际统计
     * 
     * @author 我好笨
     * @return void
     */
    public function cdnumsAction()
    {
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        $serach_type = "yyyy";
        $individual_uuid = "select uuid from individual_core where region_path = '" . $this->
            user['current_region_path'] . "' or region_path like '" . $this->user['current_region_path'] .
            ",%' and status_flag=1"; //2012-02-21仅查询正常档案，我好笨
        //分组统计人数
        $core = new Tindividual_core();
        $serach_type = "yyyy";
        $core->query("select to_char(unixts_to_date(clinical_history.disease_date),'yyyy') as daay,count(*) as nums,disease_code from clinical_history where clinical_history.id in (" .
            $individual_uuid . ") group by to_char(unixts_to_date(clinical_history.disease_date),'yyyy'),disease_code order by to_char(unixts_to_date(clinical_history.disease_date),'yyyy') desc");
        $se = array();
        $i = 0;
        while ($core->fetch())
        {
            if ($core->daay)
            {
                $se[$core->daay][$core->disease_code] = $core->nums;
            }
            else
            {
                $se['无确诊日期'][$core->disease_code] = $core->nums;
            }
            $i++;
        }
        $this->view->assign("disease_history", $disease_history);
        $this->view->assign("core", $se);
        $this->view->display("cdnums.html");
    }
    /**
     * statistics_ihaController::ihaAction()
     * 
     * 个人档案按年龄段统计
     * 
     * @author 我好笨
     * @return void
     */
    public function ihaAction()
    {
        $serach_type = "year"; //按年统计
        $this->view->display("iha.html");
    }
    /**
     * statistics_ihaController::ihanumsAction()
     * 
     * 个人档案按年龄段统计实现计算
     * 
     * @author 我好笨
     * @return void
     */
    public function ihanumsAction()
    {
        //按年龄段统计时，无数据字典，需要构建一个数据字典数组
        $dic_array = array(
            '1' => array('1', '0-10岁'),
            '2' => array('2', '11-20岁'),
            '3' => array('3', '21-30岁'),
            '4' => array('4', '31-40岁'),
            '5' => array('5', '41-50岁'),
            '6' => array('6', '51-60岁'),
            '7' => array('7', '61-70岁'),
            '8' => array('8', '71-80岁'),
            '9' => array('9', '81-90岁'),
            '10' => array('10', '91-100岁'),
            '11' => array('11', '其他'));
        $serach_type = "yyyy";
        $individual_uuid = "select uuid from individual_core where region_path = '" . $this->
            user['current_region_path'] . "' or region_path like '" . $this->user['current_region_path'] .
            ",%' and status_flag=1"; //2012-02-21仅查询正常档案，我好笨
        //分组统计人数
        $core = new Tindividual_core();
        $serach_type = "yyyy";
        $sql_case = '';
        //因为是时间戳，构建查询条件
        foreach ($dic_array as $k => $v)
        {
            if ($k < count($dic_array))
            {
                $sql_case .= " when individual_core.date_of_birth<" . (mktime(0, 0, 0, date("n"),
                    date("j"), (date("Y") - ($k - 1) * 10))) .
                    " and individual_core.date_of_birth>=" . (mktime(0, 0, 0, date("n"), date("j"),
                    date("Y") - ($k * 10))) . " then '" . $k . "' ";
            }
            else
            {
                $sql_case .= " else '" . $k . "' ";
            }
        }
        //$core->debugLevel(5);
        $core->query("select nnd,count(distinct uuid) as counter from (select case $sql_case end as nnd,individual_core.uuid as uuid from individual_core where individual_core.status_flag=1 and (individual_core.region_path = '".$this->user['current_region_path']."' or individual_core.region_path like '".$this->user['current_region_path'].",%')) group by nnd");
        $se = array();
        $i = 0;
        while ($core->fetch())
        {
            $se[$core->nnd] = $core->counter;
            $i++;
        }
        $this->view->assign("dic_array", $dic_array);
        $this->view->assign("core", $se);
        $this->view->display("ihanums.html");
    }
    /**
     * statistics_ihaController::maternalAction()
     * 
     * 孕妇按年统计界面
     * 
     * @author 我好笨
     * @return void
     */
    public function maternalAction()
    {
        $serach_type = "year"; //按年统计
        $this->view->display("maternal.html");
    }
    /**
     * statistics_ihaController::maternalnumsAction()
     * 
     * 孕产妇按年统计实现计算
     * 
     * @author 我好笨
     * @return void
     */
    public function maternalnumsAction()
    {
        $serach_type = "yyyy";
        $individual_uuid = "select uuid from individual_core where region_path = '" . $this->
            user['current_region_path'] . "' or region_path like '" . $this->user['current_region_path'] .
            ",%' and status_flag=1"; //2012-02-21仅查询正常档案，我好笨
        //分组统计人数
        $core = new Tindividual_core();
        $serach_type = "yyyy";
        //$core->debugLevel(5);
        $core->query("select to_char(unixts_to_date(prenatal_visit_first.last_menstrual),'yyyy') as daay,count(distinct id) as nums from prenatal_visit_first where id in($individual_uuid) group by to_char(unixts_to_date(prenatal_visit_first.last_menstrual),'yyyy') order by to_char(unixts_to_date(prenatal_visit_first.last_menstrual),'yyyy') desc");
        $se = array();
        $i = 0;
        while ($core->fetch())
        {
            $se[$i]['daay'] = $core->daay;
            $se[$i]['nums'] = $core->nums;
            $i++;
        }
        $this->view->assign("core", $se);
        $this->view->display("maternalnums.html");
    }
}
