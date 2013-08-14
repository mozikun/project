<?php

/**
 * @author：whx

 * @create：2012-7-3
 */
class appointment_clinicController extends controller {

    public function init() {
        require_once(__SITEROOT . 'library/Models/staff_core.php'); //用户核心表
        require_once(__SITEROOT . 'library/Models/clinic.php'); //诊室表
        require_once(__SITEROOT . 'library/custom/pager.php');    //分页表
        require_once (__SITEROOT . '/library/custom/comm_function.php');
        $this->view->basePath = __BASEPATH;
    }

    /*
     * 诊室列表
     */

    public function indexAction() {

        $clinic = new Tclinic();
        $staff_core = new Tstaff_core();
        $org_id = $_SESSION['Zend_Auth']['storage']['org_id']; //机构id
        $region_id = $_SESSION['Zend_Auth']['storage']['region_id']; //机构id
        $clinic->whereAdd("org_id='$org_id'");
        $nums = $clinic->count();
        $page_size = 10;    //每页显示的条数
        $sub_pages = 8;          //每次显示的页数
        $pageCurrent = $this->_request->getParam('page');
        $links = new SubPages($page_size, $nums, $pageCurrent, $sub_pages, $this->_request->getBasePath() . $this->getModuleName() . '/' . $this->getControllerName() . '/' . $this->getActionName() . '/org_id/' . $org_id . '/region_id/' . $region_id . '/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = $page_size * ($pageCurrent - 1);  //计算开始记录数
        $clinic->limit($startnum, $page_size);
        $clinic->find();
        $i = 0;
        $rows = array();
         $status_array = array(1 => '启用', 0 => '禁用');
        while ($clinic->fetch()) {
            $rows[$i] = $clinic->toArray();
            $staff_core->where("id='$clinic->doctor'");
            $staff_core->find(true);
            $rows[$i]['doctor'] = $staff_core->name_login;
            $rows[$i]['status'] =  $status_array[$clinic->status_flag];
            $i++;
            
            }

        if ($rows) {
            $this->view->rows = $rows;
        }
        //分页
        $this->view->row = $rows;
        $this->view->record_count = $i; //记录数
        $out = $links->subPageCss2(); //获取显示样式，$out在smarty中将输出如下：
        $this->view->page = $out; //显示分页
        $this->view->pageCurrent = $pageCurrent; //当前页

        $this->view->display("index.html");
    }

    /*
     * 处理诊室的添加的和修改
     */

    public function addAction() {
        $action = $this->_request->getParam("action");  //获取用户操作
        $org_id = $_SESSION['Zend_Auth']['storage']['org_id']; //机构id
        $uuid = $this->_request->getParam("uuid");
        $staff_core = new Tstaff_core();
        $staff_core->whereAdd("org_id='$org_id'");
       // $staff_core->whereAdd("role_id='14c29a32c28c09'");//只取医生角色
        if ($staff_core->count() > 0) {
            $staff_core->find();
            $doctors = array();
            $i = 0;
            while ($staff_core->fetch()) {
                $doctors[$i]['name'] = $staff_core->name_login;
                $doctors[$i]['id'] = $staff_core->id;
                $i++;
            }
        }
        //处理编辑操作
        if ($action == "edit") {
            $clinic = new Tclinic();
            $clinic->whereAdd("uuid='$uuid'");
            $clinic->orderby('sort_number');
            $clinic->find("true");
            $this->view->rows = $clinic->toArray();
            $this->view->uuid = $uuid;
        }
        //处理保存操作
        if ($action == "save") {
            $clinic = new Tclinic();
            $name = $this->_request->getParam("name");
            $sort_number=$this->_request->getParam('sort_number');
            //更新操作
            if ($uuid) {
                $clinic->where("clinic_name='$name' and uuid<>'$uuid'");
                if ($clinic->count() > 0) {
                    echo "更新失败，诊室已经存在";
                    exit();
                }
                $clinic = new Tclinic();
                $clinic->whereAdd("uuid='$uuid'");
                $clinic->status_flag = 1;
                $clinic->clinic_name = $this->_request->getParam("name");
                $clinic->org_id = $org_id;
                $clinic->sort_number=$sort_number;
                   $clinic->status_flag=$this->_request->getParam('status');
               // $clinic->doctor = $this->_request->getParam("doctor");
                $clinic->updated = strtotime("now");
                if($clinic->update()){
                echo "更新成功";
                exit();
                }
            }
            //添加操作
            else {
                $clinic->where("clinic_name='$name' and org_id={$org_id}");
                if ($clinic->count() > 0) {
                    echo "诊室已经存在，不能重复添加！";
                    exit();
                }
                $clinic = new Tclinic();
                $clinic->status_flag = 1;
                $clinic->clinic_name = $this->_request->getParam("name");
                $clinic->org_id = $org_id;
                $clinic->sort_number=$sort_number;
                $clinic->status_flag=$this->_request->getParam('status');
               // $clinic->doctor = $this->_request->getParam("doctor");
                $clinic->uuid = uniqid();
                $clinic->created = strtotime("now");
                $clinic->insert();
                echo "添加成功!";
                exit();
            }
        }
        // print_r($doctors);
        if (!empty($doctors)) {
            $this->view->doctors = $doctors;
        }
        $this->view->display("add.html");
    }

    public function delAction() {
        $uuid = $this->_request->getParam("uuid");
        $clinic = new Tclinic();
        $clinic->whereAdd("uuid='$uuid'");
        if ($clinic->count() > 0) {
            if ($clinic->delete()) {
                echo "删除成功";
                exit();
            }
            else
                echo "删除失败";exit();
        }
        else {
            echo "信息不存在，删除失败";
            exit();
        }
    }

}