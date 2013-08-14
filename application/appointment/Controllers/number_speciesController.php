<?php

/**
 * @author：whx

 * @create：2012-7-3
 */
class appointment_number_speciesController extends controller {

    public function init() {
        require_once(__SITEROOT . 'library/Models/staff_core.php'); //用户核心表
        require_once(__SITEROOT . 'library/Models/clinic.php');
        require_once(__SITEROOT . 'library/Models/number_species.php');
        require_once(__SITEROOT . 'library/custom/pager.php');    //分页表
        require_once (__SITEROOT . '/library/custom/comm_function.php');
        $this->view->basePath = __BASEPATH;
    }

    public function indexAction() {
        $org_id = $_SESSION['Zend_Auth']['storage']['org_id']; //机构id
        $region_id = $_SESSION['Zend_Auth']['storage']['region_id']; //机构id
        $number_species = new Tnumber_species();
        $number_species->whereAdd("org_id='$org_id'");
        $nums = $number_species->count();
        $page_size = 10;    //每页显示的条数
        $sub_pages = 8;          //每次显示的页数
        $pageCurrent = $this->_request->getParam('page');
        $links = new SubPages($page_size, $nums, $pageCurrent, $sub_pages, $this->_request->getBasePath() . $this->getModuleName() . '/' . $this->getControllerName() . '/' . $this->getActionName() . '/org_id/' . $org_id . '/region_id/' . $region_id . '/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = $page_size * ($pageCurrent - 1);  //计算开始记录数
        $number_species->limit($startnum, $page_size);
        $number_species->find();
        $i = 0;
        $rows = array();
        $status_array=array(0=>'禁用',1=>'启用');
        while ($number_species->fetch()) {
            $rows[$i] = $number_species->toArray();
            $rows[$i]['status']=$status_array[$number_species->status_flag];
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

    public function addAction() {
        $action = $this->_request->getParam("action");
        $uuid = $this->_request->getParam("uuid");
        $number_species = new Tnumber_species();
        $org_id = $_SESSION['Zend_Auth']['storage']['org_id']; //机构id
        //编辑操作
        if ($action == "edit") {
            $number_species->whereAdd("uuid='$uuid'");
            $number_species->find(true);
            $this->view->rows = $number_species->toArray();
            $this->view->uuid = $uuid;
        }
        //保存操作
        if ($action == "save") {
            $number_species = new Tnumber_species();
            if ($uuid) {
                $name = $this->_request->getParam("no_species_name");
                $number_species->where("no_species_name='$name'and uuid<>'$uuid'");
                if ($number_species->count() > 0) {
                    echo "更新失败，该号种已经存在";
                    exit();
                }
                $number_species = new Tnumber_species();
                $number_species->no_species_name = $this->_request->getParam("no_species_name");
                $number_species->registration_fee = $this->_request->getParam("registration_fee");
                $number_species->medical_fee = $this->_request->getParam("medical_fee");
                $number_species->service_fee = $this->_request->getParam("service_fee");
                $number_species->surcharge = $this->_request->getParam("surcharge");
                $number_species->sort_number=$this->_request->getParam("sort_number");
                $number_species->status_flag=$this->_request->getParam("status");
                $number_species->org_id = $org_id;
                $number_species->whereAdd("uuid='$uuid'");
                $number_species->updated = strtotime("now");
                if ($number_species->update()) {
                    echo "更新成功";
                    exit();
                }
            } else {
                $name = $this->_request->getParam("no_species_name");
                $number_species->where("no_species_name='$name'");
                if ($number_species->count() > 0) {
                    echo "该号种已经存在,不能重复添加";
                    exit();
                }
                $number_species->no_species_name = $this->_request->getParam("no_species_name");
                $number_species->registration_fee = $this->_request->getParam("registration_fee");
                $number_species->medical_fee = $this->_request->getParam("medical_fee");
                $number_species->service_fee = $this->_request->getParam("service_fee");
                $number_species->surcharge = $this->_request->getParam("surcharge");
                 $number_species->sort_number=$this->_request->getParam("sort_number");
                $number_species->status_flag=$this->_request->getParam("status");
                $number_species->org_id = $org_id;
                $number_species->uuid = uniqid();
                $number_species->created = strtotime("now");
                if ($number_species->insert()) {
                    echo "添加成功";
                    exit();
                }
            }
        }
        $this->view->display("add.html");
       
    }
     public function delAction() {
        $uuid = $this->_request->getParam("uuid");
        $number_species = new Tnumber_species();
        $number_species->whereAdd("uuid='$uuid'");
        if ($number_species->count() > 0) {
            if ($number_species->delete()) {
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