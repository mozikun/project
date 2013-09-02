<?php
/**
 * phe_orgController
 * 
 * 完成突发公共卫生事件相关机构的相关功能
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class phe_orgController extends controller
{
    /**
     * phe_orgController::init()
     * 
     * 初始化动作
     * 
     * @return void
     */
    public function init()
    {
        $this->haveWritePrivilege='';
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT."library/Models/phe_report.php";
		require_once(__SITEROOT.'library/MyAuth.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		$this->view->assign("baseUrl",__BASEPATH);
		$this->view->assign( "basePath", __BASEPATH );
        require_once __SITEROOT."library/Models/phe_dept.php";
    }
    /**
     * phe_orgController::indexAction()
     * 
     * 列表突发公共卫生事件相关机构
     * 
     * @return void
     */
    public function indexAction()
    {
        require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		$org_id=$this->user['org_id'];
		$search=array();
		//取搜索值
		$report_id=$this->_request->getParam('uuid','');
        $health_education_region_path_domain=get_region_path(1);
		$staff_core_region_path_domain=get_region_path(2);
		$phe=new Tphe_dept();
        $staff_core=new Tstaff_core();
        $phe->whereAdd($staff_core_region_path_domain);
        $phe->joinAdd('left',$phe,$staff_core,'staff_id','id');
		if($report_id)
		{
            $search['uuid']=$report_id;
			$phe->whereAdd("phe_dept.report_id='$report_id'");
		}
		$nums=$phe->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'phe/org/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$phe->limit($startnum,__ROWSOFPAGE);
        $phe->orderBy("phe_dept.created DESC");
		$phe->find();
		$phes=array();
		$i=0;
		while ($phe->fetch())
		{
			$phes[$i]['uuid']=$phe->uuid;
			$phes[$i]['js_uuid']=@str_replace(".","_",$phe->uuid);
			//$phes[$i]['area']=get_region_zhname($phe->rep_region);
            $phe->stakeholder_type=array_search_for_other($phe->stakeholder_type,$phe_stakeholder_type);
			$phes[$i]['stakeholder_type']=isset($phe_stakeholder_type[$phe->stakeholder_type][1])?$phe_stakeholder_type[$phe->stakeholder_type][1]:'';
            $phes[$i]['report_id']=$phe->report_id;
			$phes[$i]['org_name']=$phe->org_name;
			$phes[$i]['org_addr']=$phe->org_addr;
            $phes[$i]['legal_rep_nm']=$phe->legal_rep_nm;
            $phes[$i]['legal_rep_tel']=$phe->legal_rep_tel;
			$i++;
		}
		$out = $links->subPageCss2();
		$this->view->assign("page",$pageCurrent);
        $this->view->assign("report_id",$report_id);
		$this->view->assign("pager",$out);
		$this->view->assign("phe",$phes);
		$this->view->assign("search_array",$search);
		$this->view->display("index.html");
    }
    /**
     * phe_orgController::editAction()
     * 
     * 添加或者编辑突发公共卫生事件相关机构界面展示
     * 
     * @return void
     */
    public function editAction()
    {
        $uuid=$this->_request->getParam('uuid');
        $report_id=$this->_request->getParam('report_id');
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        $this->view->phe_event_cat=$phe_event_cat;
        $this->view->phe_event_grade=$phe_event_grade;
        $this->view->phe_person_role=$phe_person_role;
        $this->view->phe_report_cat=$phe_report_cat;
        $this->view->phe_stakeholder_type=$phe_stakeholder_type;
        if($uuid)
        {
            $phe=new Tphe_dept();
            $phe->whereAdd("uuid='$uuid'");
            $phe->find(true);
            //转换字典
            $phe->stakeholder_type=array_search_for_other($phe->stakeholder_type,$phe_stakeholder_type);
            $this->view->phe=$phe;
        }
        //初始化报告事件地区和事件发生地区
        $org_dist_code=isset($phe->org_dist_code)?$phe->org_dist_code:$this->user['region_id'];
        $this->view->org_dist_code=$org_dist_code;
        $this->view->assign("report_id",$report_id);
        $this->view->display('edit.html');
    }
    /**
     * phe_orgController::editinAction()
     * 
     * 添加或者编辑突发公共卫生事件相关机构写入数据库
     * 
     * @return void
     */
    public function editinAction()
    {
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        $uuid=$this->_request->getParam('uuid');
        $report_id=$this->_request->getParam('report_id');
        if(!$report_id)
        {
            $url=array("返回事件列表"=>__BASEPATH.'phe/index/index',"事件列表"=>__BASEPATH.'phe/index/index');
            message("参数错误，无法保存数据",$url);
        }
        $phe_dept=new Tphe_dept();
        $phe_dept->stakeholder_type=$this->_request->getParam('stakeholder_type')?array_code_change($this->_request->getParam('stakeholder_type'),$phe_stakeholder_type):'';
        $phe_dept->org_code=$this->_request->getParam('org_code');
        $phe_dept->org_name=$this->_request->getParam('org_name');
        $phe_dept->org_dist_code=$this->_request->getParam('org_dist_code');
        $phe_dept->org_addr=$this->_request->getParam('org_addr');
        $phe_dept->zipcode=$this->_request->getParam('zipcode');
        $phe_dept->org_email=$this->_request->getParam('org_email');
        $phe_dept->org_website=$this->_request->getParam('org_website');
        $phe_dept->legal_rep_nm=$this->_request->getParam('legal_rep_nm');
        $phe_dept->legal_rep_tel=$this->_request->getParam('legal_rep_tel');
        if($uuid)
        {
            //编辑
            $phe_dept->updated=time();
            $phe_dept->staff_id=$this->user['uuid'];
            $phe_dept->whereAdd("uuid='$uuid'");
            if($phe_dept->update())
            {
                //更新成功
                $url=array("返回查看"=>__BASEPATH.'phe/org/edit/uuid/'.$uuid.'/report_id/'.$report_id,"机构列表"=>__BASEPATH.'phe/org/index/uuid/'.$report_id,"事件列表"=>__BASEPATH.'phe/index/index');
				message("编辑突发公共卫生事件相关机构成功",$url);
            }
            else
            {
                //失败
                $url=array("返回查看"=>__BASEPATH.'phe/org/edit/uuid/'.$uuid.'/report_id/'.$report_id,"机构列表"=>__BASEPATH.'phe/org/index/uuid/'.$report_id,"事件列表"=>__BASEPATH.'phe/index/index');
				message("编辑突发公共卫生事件相关机构失败",$url);
            }
        }
        else
        {
            //添加
            $phe_dept->report_id=$report_id;
            $phe_dept->updated=time();
            $phe_dept->created=time();
            $phe_dept->staff_id=$this->user['uuid'];
            $uuid=$phe_dept->uuid=uniqid('phe_',true);
            if($phe_dept->insert())
            {
                //成功，更新事件相关机构数
                $phe_report=new Tphe_report();
                $phe_report->whereAdd("uuid='$report_id'");
                $phe_report->find(true);
                $dept_no=$phe_report->dept_no+1;
                $phe_report->free_statement();
                
                $phe_report=new Tphe_report();
                $phe_report->dept_no=$dept_no;
                $phe_report->whereAdd("uuid='$report_id'");
                $phe_report->update();
                $phe_report->free_statement();
                $url=array("返回查看"=>__BASEPATH.'phe/org/edit/uuid/'.$uuid.'/report_id/'.$report_id,"机构列表"=>__BASEPATH.'phe/org/index/uuid/'.$report_id,"事件列表"=>__BASEPATH.'phe/index/index');
				message("添加突发公共卫生事件相关机构成功",$url);
            }
            else
            {
                //失败
                $url=array("返回查看"=>__BASEPATH.'phe/org/edit/uuid/'.$uuid.'/report_id/'.$report_id,"机构列表"=>__BASEPATH.'phe/org/index/uuid/'.$report_id,"事件列表"=>__BASEPATH.'phe/index/index');
				message("添加突发公共卫生事件相关机构失败",$url);
            }
        }
    }
    /**
     * phe_orgController::deleteAction()
     * 
     * 删除突发卫生公共事件相关机构
     * 
     * @return void
     */
    public function deleteAction()
    {
        $uuid=$this->_request->getParam('uuid');
        if($uuid)
        {
            $phe_dept=new Tphe_dept();
            $phe_dept->whereAdd("uuid='$uuid'");
            $phe_dept->find(true);
            $report_id=$phe_dept->report_id;
            $phe_dept->free_statement();
            
            $phe_dept=new Tphe_dept();
            $phe_dept->whereAdd("uuid='$uuid'");
            if($phe_dept->delete())
            {
                $phe_report=new Tphe_report();
                $phe_report->whereAdd("uuid='$report_id'");
                $phe_report->find(true);
                $dept_no=$phe_report->dept_no-1;
                $phe_report->free_statement();
                
                $phe_report=new Tphe_report();
                $phe_report->dept_no=$dept_no>=0?$dept_no:0;
                $phe_report->whereAdd("uuid='$report_id'");
                $phe_report->update();
                $phe_report->free_statement();
                exit('ok');
            }
            else
            {
                exit('failed');
            }
        }
        else
        {
            exit('failed');
        }
    }
}
?>