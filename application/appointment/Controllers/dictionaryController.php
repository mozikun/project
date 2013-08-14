<?php

/*
 * todo: 坐诊字典管理
 * author: whx
 * time:2012-11-13
 */

class appointment_dictionaryController extends controller
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
        require_once (__SITEROOT . 'library/Models/zuozhen.php');
        require_once (__SITEROOT . 'library/Models/staff_core.php'); //用户核心表
        require_once (__SITEROOT . "application/admin/models/getRoles.php"); //取得角色
        require_once (__SITEROOT . 'library/custom/pager.php'); //分页表
        $this->view->basePath = $this->_request->getBasePath();
    }

    /*     * *******************
     * 坐诊字典列表
     * ******************** */

    public function listAction()
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
            $this->view->display("list.html");
        }
    }

    /*     * *********************
     * 坐诊字典的添加与修改
     * ******************** */

    public function addAction()
    {
        $uuid = $this->_request->getParam('uuid');
        $user_id = $this->_request->getParam('user_id');
        $org_id = $this->_request->getParam('org_id');
        $dictionary = new Tzuozhen_dictionary();
        $staff = new Tstaff_core();
        $staff->where("id='{$user_id}'");
        $staff->find(true);
        $this->view->staff_name = $staff->name_login;
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
        $department_array[0]['department_name'] = "--请选择--";
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
        $clinic_array[0]['clinic_name'] = "--请选择--";
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
        $number_species_array[0]['no_species_name']= "--请选择--";
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
        $this->view->display('add.html');
    }

    /*****************************
     * 保存数据
     ***************************/
    public function saveAction()
    {
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

}

?>