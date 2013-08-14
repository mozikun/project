<?php

/**
 * @author：whx

 * @create：2012-7-3
 */
class appointment_preferentialController extends controller
{

    public function init()
    {
        require_once(__SITEROOT . 'library/Models/staff_core.php'); //用户核心表
        require_once(__SITEROOT . 'library/Models/preferential.php'); //诊室表
        require_once(__SITEROOT . 'library/custom/pager.php');    //分页表
        require_once (__SITEROOT . '/library/custom/comm_function.php');

        $this->view->basePath = __BASEPATH;
    }

    /*
     * 优惠列表
     */

    public function indexAction()
    {
        require_once (__SITEROOT . '/library/data_arr/arrdata.php');
        $preferential = new Tpreferential();
        $org_id = $_SESSION['Zend_Auth']['storage']['org_id']; //机构id
        $region_id = $_SESSION['Zend_Auth']['storage']['region_id']; //机构id
        $preferential->whereAdd("org_id='$org_id'");
        $nums = $preferential->count();
        $page_size = 10;    //每页显示的条数
        $sub_pages = 8;          //每次显示的页数
        $pageCurrent = $this->_request->getParam('page');
        $links = new SubPages($page_size, $nums, $pageCurrent, $sub_pages, $this->_request->getBasePath() . $this->getModuleName() . '/' . $this->getControllerName() . '/' . $this->getActionName() . '/org_id/' . $org_id . '/region_id/' . $region_id . '/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = $page_size * ($pageCurrent - 1);  //计算开始记录数
        $preferential->limit($startnum, $page_size);
        $preferential->find();
        $i = 0;
        $rows = array();
        while ($preferential->fetch())
        {
            $rows[$i] = $preferential->toArray();
            $rows[$i]['charge_id'] = $charge_style[array_search_for_other($preferential->charge_id, $charge_style)][1];
            $i++;
        }
        if ($rows)
        {
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
     * 处理优惠项目添加的和修改
     */

    public function addAction()
    {

        require_once (__SITEROOT . '/library/data_arr/arrdata.php');
        $action = $this->_request->getParam("action");  //获取用户操作
        $org_id = $_SESSION['Zend_Auth']['storage']['org_id']; //机构id
        $uuid = $this->_request->getParam("uuid");

        //处理编辑操作
        if ($action == "edit")
        {
            $uuid = $this->_request->getParam("uuid");
            $preferential = new Tpreferential();
            $preferential->whereAdd("uuid='$uuid'");
            $preferential->find("true");
            $this->view->rows = $preferential->toArray();
            print_r($rows);
            $this->view->uuid = $uuid;
        }
        //处理保存操作
        if ($action == "save")
        {

            $preferential = new Tpreferential();
            $charge_id = $this->_request->getParam("charge_id");
            $preferential->favorable_ratio = $this->_request->getParam("favorable_ratio");
            $preferential->org_id = $org_id;
            //编辑操作
            if ($uuid)
            {
                $preferential->updated = strtotime("now");
                $preferential->where("uuid='$uuid'");
                if ($preferential->update())
                {
                    echo "更新成功";
                    exit();
                }
                else
                    echo "更新失败";
            }
            else
            {
                //检查优惠项目是否已经存在
                $preferential->where("charge_id='$charge_id'");
                if ($preferential->count() > 0)
                {
                    echo "该优惠类型已经存在,不能重复添加！";
                    exit();
                }

                $preferential = new Tpreferential();
                $preferential->charge_id = $charge_id;
                $preferential->favorable_ratio = $this->_request->getParam("favorable_ratio");
                $preferential->org_id = $org_id;
                $preferential->uuid = uniqid();
                $preferential->created = strtotime("now");

                if ($preferential->insert())
                {
                    echo "添加成功";
                    exit();
                }
                else
                    echo "添加失败";
            }
        }


        /*
         * 优惠项目数组
         */
        //print_r($charge_style);
        $this->view->charge_style = $charge_style;
        $this->view->display("add.html");
    }

    public function delAction()
    {
        $uuid = $this->_request->getParam("uuid");
        $preferential = new Tpreferential();
        $preferential->whereAdd("uuid='$uuid'");
        if ($preferential->count() > 0)
        {
            if ($preferential->delete())
            {
                echo "删除成功";
                exit();
            }
            else
                echo "删除失败";exit();
        }
        else
        {
            echo "信息不存在，删除失败";
            exit();
        }
    }

    public function toint($var)
    {
        return intval($var);
    }

}