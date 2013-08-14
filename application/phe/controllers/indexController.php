<?php
/**
 * phe_indexController
 * 
 * 完成突发公共卫生事件的相关功能
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class phe_indexController extends controller
{
    /**
     * phe_indexController::init()
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
		require_once(__SITEROOT.'library/Myauth.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		$this->view->assign("baseUrl",__BASEPATH);
		$this->view->assign( "basePath", __BASEPATH );
    }
    /**
     * phe_indexController::indexAction()
     * 
     * 列表突发公共卫生事件
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
		$time_start=$this->_request->getParam('time_start','');
		$time_end=$this->_request->getParam('time_end','');
		$address=$this->_request->getParam('address','');
		$sponsor=$this->_request->getParam('sponsor','');
		$person_in_charge=$this->_request->getParam('person_in_charge','');
        $health_education_region_path_domain=get_region_path(1);
		$staff_core_region_path_domain=get_region_path(2);
		$phe=new Tphe_report();
        $staff_core=new Tstaff_core();
        $phe->whereAdd($staff_core_region_path_domain);
        $phe->joinAdd('left',$phe,$staff_core,'staff_id','id');
		if($time_start)
		{
			$search['time_start']=$time_start;
			$time_start=mkunixstamp($time_start);
			$phe->whereAdd("phe_report.report_time>='$time_start'");
		}
		if($time_end)
		{
			$search['time_end']=$time_end;
			$time_end=mkunixstamp($time_end);
			$phe->whereAdd("phe_report.report_time<='$time_end'");
		}
		$nums=$phe->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'phe/index/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$phe->limit($startnum,__ROWSOFPAGE);
        $phe->orderBy("phe_report.created DESC");
		$phe->find();
		$phes=array();
		$i=0;
		while ($phe->fetch())
		{
			$phes[$i]['uuid']=$phe->uuid;
			$phes[$i]['js_uuid']=@str_replace(".","_",$phe->uuid);
			$phes[$i]['area']=get_region_zhname($phe->rep_region);
            $phe->event_cat=array_search_for_other($phe->event_cat,$phe_event_cat);
            $phe->event_grade=array_search_for_other($phe->event_grade,$phe_event_grade);
			$phes[$i]['event_cat']=isset($phe_event_cat[$phe->event_cat][1])?$phe_event_cat[$phe->event_cat][1]:'';
            $phes[$i]['event_name']=$phe->event_name;
			$phes[$i]['event_grade']=isset($phe_event_grade[$phe->event_grade][1])?$phe_event_grade[$phe->event_grade][1]:'';;
			$phes[$i]['affected_population']=$phe->affected_population;
			$phes[$i]['influenced_no']=$phe->influenced_no;
            $phes[$i]['dead_no']=$phe->dead_no;
            $phes[$i]['dept_no']=intval($phe->dept_no);
            $phes[$i]['person_no']=intval($phe->person_no);
			$i++;
		}
		$out = $links->subPageCss2();
		$this->view->assign("page",$pageCurrent);
		$this->view->assign("pager",$out);
		$this->view->assign("phe",$phes);
		$this->view->assign("search_array",$search);
		$this->view->display("index.html");
    }
    /**
     * phe_indexController::editAction()
     * 
     * 添加或者编辑突发公共卫生事件界面展示
     * 
     * @return void
     */
    public function editAction()
    {
        $uuid=$this->_request->getParam('uuid');
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        $this->view->phe_event_cat=$phe_event_cat;
        $this->view->phe_event_grade=$phe_event_grade;
        $this->view->phe_person_role=$phe_person_role;
        $this->view->phe_report_cat=$phe_report_cat;
        $this->view->phe_stakeholder_type=$phe_stakeholder_type;
        if($uuid)
        {
            $phe=new Tphe_report();
            $phe->whereAdd("uuid='$uuid'");
            $phe->find(true);
            //转换字典
            $phe->report_cat=array_search_for_other($phe->report_cat,$phe_report_cat);
            $phe->event_cat=array_search_for_other($phe->event_cat,$phe_event_cat);
            $phe->event_grade=array_search_for_other($phe->event_grade,$phe_event_grade);
            //转换时间
            $phe->event_time=$phe->event_time?date('Y-m-d H:i:s',$phe->event_time):'';
            $phe->report_time=$phe->report_time?date('Y-m-d H:i:s',$phe->report_time):'';
            $phe->receive_time=$phe->receive_time?date('Y-m-d H:i:s',$phe->receive_time):'';
            $phe->first_patient_tme=$phe->first_patient_tme?date('Y-m-d H:i:s',$phe->first_patient_tme):'';
            $this->view->phe=$phe;
        }
        //初始化报告事件地区和事件发生地区
        $take_place_region=isset($phe->take_place_region)?$phe->take_place_region:$this->user['region_id'];
        $rep_region=isset($phe->rep_region)?$phe->rep_region:$this->user['region_id'];
        $this->view->take_place_region=$take_place_region;
        $this->view->rep_region=$rep_region;
        $this->view->display('edit.html');
    }
    /**
     * phe_indexController::editinAction()
     * 
     * 添加或者编辑突发公共卫生事件写入数据库
     * 
     * @return void
     */
    public function editinAction()
    {
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        $uuid=$this->_request->getParam('uuid');
        $phe_report=new Tphe_report();
        $phe_report->report_cat=$this->_request->getParam('report_cat')?array_code_change($this->_request->getParam('report_cat'),$phe_report_cat):'';
        $phe_report->event_time=$this->_request->getParam('event_time')?strtotime($this->_request->getParam('event_time')):'';
        $phe_report->report_time=$this->_request->getParam('report_time')?strtotime($this->_request->getParam('report_time')):'';
        $phe_report->rep_region=$this->_request->getParam('rep_region');
        $phe_report->receive_time=$this->_request->getParam('receive_time')?strtotime($this->_request->getParam('receive_time')):'';
        $phe_report->event_cat=$this->_request->getParam('event_cat')?array_code_change($this->_request->getParam('event_cat'),$phe_event_cat):'';
        $phe_report->event_name=$this->_request->getParam('event_name');
        $phe_report->event_grade=$this->_request->getParam('event_grade')?array_code_change($this->_request->getParam('event_grade'),$phe_event_grade):'';;
        $phe_report->take_place_region=$this->_request->getParam('take_place_region');
        $phe_report->detailed_loc=$this->_request->getParam('detailed_loc');
        $phe_report->occurrence_place_type=$this->_request->getParam('occurrence_place_type');
        $phe_report->affected_population=$this->_request->getParam('affected_population');
        $phe_report->event_cause=$this->_request->getParam('event_cause');
        $phe_report->influenced_no=$this->_request->getParam('influenced_no');
        $phe_report->dead_no=$this->_request->getParam('dead_no');
        $phe_report->controlling_measurement=$this->_request->getParam('controlling_measurement');
        $phe_report->direct_economic_lost=$this->_request->getParam('direct_economic_lost');
        $phe_report->first_patient_tme=$this->_request->getParam('first_patient_tme')?strtotime($this->_request->getParam('first_patient_tme')):'';
        $phe_report->main_symptom=$this->_request->getParam('main_symptom');
        $phe_report->main_body_character=$this->_request->getParam('main_body_character');
        $phe_report->first_diagnosis=$this->_request->getParam('first_diagnosis');
        $phe_report->disease_factors=$this->_request->getParam('disease_factors');
        $phe_report->patient_process=$this->_request->getParam('patient_process');
        if($uuid)
        {
            //编辑
            $phe_report->updated=time();
            $phe_report->staff_id=$this->user['uuid'];
            $phe_report->whereAdd("uuid='$uuid'");
            if($phe_report->update())
            {
                //更新成功
                $url=array("返回查看"=>__BASEPATH.'phe/index/edit/uuid/'.$uuid,"事件列表"=>__BASEPATH.'phe/index/index');
				message("编辑突发公共卫生事件成功",$url);
            }
            else
            {
                //失败
                $url=array("返回查看"=>__BASEPATH.'phe/index/edit/uuid/'.$uuid,"事件列表"=>__BASEPATH.'phe/index/index');
				message("编辑突发公共卫生事件失败",$url);
            }
        }
        else
        {
            //添加
            $phe_report->updated=time();
            $phe_report->created=time();
            $phe_report->staff_id=$this->user['uuid'];
            $uuid=$phe_report->uuid=uniqid('phe_',true);
            //$phe_report->debugLevel(5);
            if($phe_report->insert())
            {
                //成功
                $url=array("返回查看"=>__BASEPATH.'phe/index/edit/uuid/'.$uuid,"事件列表"=>__BASEPATH.'phe/index/index');
				message("添加突发公共卫生事件成功",$url);
            }
            else
            {
                //失败
                $url=array("返回查看"=>__BASEPATH.'phe/index/edit/uuid/'.$uuid,"事件列表"=>__BASEPATH.'phe/index/index');
				message("添加突发公共卫生事件失败",$url);
            }
        }
    }
    /**
     * phe_indexController::deleteAction()
     * 
     * 删除突发卫生公共事件
     * 
     * @return void
     */
    public function deleteAction()
    {
        $uuid=$this->_request->getParam('uuid');
        require_once __SITEROOT."library/Models/phe_dept.php";
        require_once __SITEROOT."library/Models/phe_person.php";
        if($uuid)
        {
            $phe_report=new Tphe_report();
            $phe_report->whereAdd("uuid='$uuid'");
            if($phe_report->delete())
            {
                //删除相关机构
                $phe_dept=new Tphe_dept();
                $phe_dept->whereAdd("report_id='$uuid'");
                $phe_dept->delete();
                //删除相关人员
                $phe_person=new Tphe_person();
                $phe_person->whereAdd("report_id='$uuid'");
                $phe_person->delete();
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