<?php

/*
 * @author whx
 * @time   2012-11-6
 * @descript 科室管理
 */

class appointment_departmentController extends controller
{

    public function init()
    {
        require_once(__SITEROOT . 'library/Models/staff_core.php'); //用户核心表
        require_once(__SITEROOT . 'library/Models/department.php'); //诊室表
        require_once(__SITEROOT . 'library/privilege.php');
         require_once (__SITEROOT . '/library/custom/comm_function.php');
          require_once(__SITEROOT . 'library/custom/pager.php');    //分页表
        $this->view->basePath = __BASEPATH;
    }

    /*
     * * **********************************
     * 科室列表
     * ******************************* */

    public function indexAction()
    {
        $department = new Tdepartment();
         $org_id = $_SESSION['Zend_Auth']['storage']['org_id']; //机构id
        $region_id = $_SESSION['Zend_Auth']['storage']['region_id']; //机构id
        $nums = $department->count();
        $page_size = 10;    //每页显示的条数
        $sub_pages = 8;          //每次显示的页数
        $pageCurrent = $this->_request->getParam('page');
        $links = new SubPages($page_size, $nums, $pageCurrent, $sub_pages, $this->_request->getBasePath() . $this->getModuleName() . '/' . $this->getControllerName() . '/' . $this->getActionName() . '/org_id/' . $org_id . '/region_id/' . $region_id . '/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = $page_size * ($pageCurrent - 1);  //计算开始记录数
        $department->limit($startnum, $page_size);
        $department->find();
        $status_array = array(1 => '启用', 0 => '禁用');
        $rows = array(); //存放科室结果集
        $i = 0; //素组索引
        while ($department->fetch())
        {
            $rows[$i]['department_name'] = $department->department_name;
            $rows[$i]['sort_number'] = $department->sort_number;
            $rows[$i]['status'] = $status_array[$department->status_flag];
            $rows[$i]['uuid'] = $department->uuid;
            $i++;
        }
       
         $this->view->row = $rows;
        $this->view->record_count = $nums; //记录数
        $out = $links->subPageCss2(); //获取显示样式，$out在smarty中将输出如下：
        $this->view->page = $out; //显示分页
        $this->view->pageCurrent = $pageCurrent; //当前页
        $this->view->rows = $rows;
        $this->view->display('index.html');
    }

    /*
     * **********************************
     * 添加科室
     * **********************************
     */

    public function addAction()
    {
        $uuid = $this->_request->getParam('uuid');
        //如果有uuid,编辑操作
        if ($uuid)
        {
            $department = new Tdepartment();
            $department->where("uuid='{$uuid}'");
            $department->find(true);
            // print_r($department->toArray());exit();
            $this->view->rows = $department->toArray();
        }
        $this->view->display('add.html');
    }

    /**
     * ***********************************
     * 保存数据
     * ***********************************
     */
    public function saveAction()
    {

        $uuid = $this->_request->getParam('uuid');
        //如果uuid不为空，修改操作
        if ($uuid)
        {
            $dpartment = new Tdepartment();

            $dpartment->updated = strtotime('now');
            $dpartment->status_flag = $this->_request->getParam('status');
            $dpartment->department_name = $this->_request->getParam('department_name');
            $dpartment->sort_number = $this->_request->getParam('sort_number');
            $dpartment->where("uuid='{$uuid}'");
            if ($dpartment->update())
            {
                echo '修改成功';
                exit();
            }
        }
        //如果uuid为空，新增操作
        else
        {
            $dpartment_name = $this->_request->getParam('department_name');

            $dpartment = new Tdepartment();
            $dpartment->where("department_name='{$dpartment_name}'");
            //判断科室名字是否重复
            if ($dpartment->count() > 0)
            {
                echo "科室名与现存科室名重复";
                exit();
            }

            $dpartment = new Tdepartment();
            $dpartment->uuid = uniqid();
            $dpartment->staff_id = $this->user['uuid'];
            $dpartment->created = strtotime('now');
            $dpartment->status_flag = $this->_request->getParam('status');
            $dpartment->org_id = $this->user['org_id'];
            $dpartment->department_name = $this->_request->getParam('department_name');

            $dpartment->sort_number = $this->_request->getParam('sort_number');
            if ($dpartment->insert())
            {
                echo '添加成功';
                exit();
            }
        }
    }

    /**
     * *************************
     * 删除科室
     * *************************
     */
    public function delAction()
    {
        $uuid = $this->_request->getParam('uuid');
        $department = new Tdepartment();
        $department->where("uuid='{$uuid}'");
        if ($department->delete())
        {
            echo "删除成功";
        } else
        {
            echo "删除失败";
        }
    }

}

?>
