<?php
/**
 * phe_personController
 * 
 * 完成突发公共卫生事件相关人员的相关功能
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class phe_personController extends controller
{
    /**
     * phe_personController::init()
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
        require_once __SITEROOT."library/Models/phe_person.php";
    }
    /**
     * phe_personController::indexAction()
     * 
     * 列表突发公共卫生事件相关人员
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
		$phe=new Tphe_person();
        $staff_core=new Tstaff_core();
        $phe->whereAdd($staff_core_region_path_domain);
        $phe->joinAdd('left',$phe,$staff_core,'staff_id','id');
		if($report_id)
		{
		    $search['uuid']=$report_id;
			$phe->whereAdd("phe_person.report_id='$report_id'");
		}
		$nums=$phe->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'phe/person/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$phe->limit($startnum,__ROWSOFPAGE);
        $phe->orderBy("phe_person.created DESC");
		$phe->find();
		$phes=array();
		$i=0;
		while ($phe->fetch())
		{
			$phes[$i]['uuid']=$phe->uuid;
			$phes[$i]['js_uuid']=@str_replace(".","_",$phe->uuid);
			$phes[$i]['person_role']=isset($phe_person_role[$phe->person_role][1])?$phe_person_role[$phe->person_role][1]:'';
            $phes[$i]['report_id']=$phe->report_id;
			$phes[$i]['name']=$phe->name;
			$phes[$i]['language']=$phe->language;
            $phes[$i]['contact_tel']=$phe->contact_tel;
            $phes[$i]['contact_addr']=$phe->contact_addr;
            $phe->sex=array_search_for_other($phe->sex,$sex);
            $phes[$i]['sex']=isset($sex[$phe->sex][1])?$sex[$phe->sex][1]:'';
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
     * phe_personController::editAction()
     * 
     * 添加或者编辑突发公共卫生事件相关人员界面展示
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
        $this->view->assign("race", $race);
        $this->view->assign("races", $races);
        $this->view->assign("marriage", $marriage);
        $this->view->phe_employment_status=$phe_employment_status;
        $this->view->sex=$sex;
        if($uuid)
        {
            $phe=new Tphe_person();
            $phe->whereAdd("uuid='$uuid'");
            $phe->find(true);
            //转换字典
            $phe->person_role=array_search_for_other($phe->person_role,$phe_person_role);
            $phe->sex=array_search_for_other($phe->sex,$sex);
            $phe->race=array_search_for_other($phe->race,$race);
            $phe->races=array_search_for_other($phe->races,$races);
            $phe->marital_status=array_search_for_other($phe->marital_status,$marriage);
            $phe->employment_status=array_search_for_other($phe->employment_status,$phe_employment_status);
            $this->view->phe=$phe;
        }
        $this->view->assign("report_id",$report_id);
        $this->view->display('edit.html');
    }
    /**
     * phe_personController::editinAction()
     * 
     * 添加或者编辑突发公共卫生事件相关人员写入数据库
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
        $phe_person=new Tphe_person();
        $phe_person->person_role=$this->_request->getParam('person_role')?array_code_change($this->_request->getParam('person_role'),$phe_person_role):'';
        $phe_person->sex=$this->_request->getParam('sex')?array_code_change($this->_request->getParam('sex'),$sex):'';
        $phe_person->race=$this->_request->getParam('race')?array_code_change($this->_request->getParam('race'),$race):'';
        $phe_person->races=$this->_request->getParam('races')?array_code_change($this->_request->getParam('races'),$races):'';
        $phe_person->marital_status=$this->_request->getParam('marital_status')?array_code_change($this->_request->getParam('marital_status'),$marriage):'';
        $phe_person->employment_status=$this->_request->getParam('employment_status')?array_code_change($this->_request->getParam('employment_status'),$phe_employment_status):'';
        $phe_person->name=$this->_request->getParam('name');
        $phe_person->identity_card_number=$this->_request->getParam('identity_card_number');
        $phe_person->country_code=$this->_request->getParam('country_code');
        $phe_person->nationality=$this->_request->getParam('nationality');
        $phe_person->birth_place=$this->_request->getParam('birth_place');
        $phe_person->language=$this->_request->getParam('language');
        $phe_person->contact_tel=$this->_request->getParam('contact_tel');
        $phe_person->contact_addr=$this->_request->getParam('contact_addr');
        if($uuid)
        {
            //编辑
            $phe_person->updated=time();
            $phe_person->staff_id=$this->user['uuid'];
            $phe_person->whereAdd("uuid='$uuid'");
            if($phe_person->update())
            {
                //更新成功
                $url=array("返回查看"=>__BASEPATH.'phe/person/edit/uuid/'.$uuid.'/report_id/'.$report_id,"人员列表"=>__BASEPATH.'phe/person/index/uuid/'.$report_id,"事件列表"=>__BASEPATH.'phe/index/index');
				message("编辑突发公共卫生事件相关人员成功",$url);
            }
            else
            {
                //失败
                $url=array("返回查看"=>__BASEPATH.'phe/person/edit/uuid/'.$uuid.'/report_id/'.$report_id,"人员列表"=>__BASEPATH.'phe/person/index/uuid/'.$report_id,"事件列表"=>__BASEPATH.'phe/index/index');
				message("编辑突发公共卫生事件相关人员失败",$url);
            }
        }
        else
        {
            //添加
            $phe_person->report_id=$report_id;
            $phe_person->updated=time();
            $phe_person->created=time();
            $phe_person->staff_id=$this->user['uuid'];
            $uuid=$phe_person->uuid=uniqid('phe_',true);
            if($phe_person->insert())
            {
                //成功，更新事件相关机构数
                $phe_report=new Tphe_report();
                $phe_report->whereAdd("uuid='$report_id'");
                $phe_report->find(true);
                $person_no=$phe_report->person_no+1;
                $phe_report->free_statement();
                
                $phe_report=new Tphe_report();
                $phe_report->person_no=$person_no;
                $phe_report->whereAdd("uuid='$report_id'");
                $phe_report->update();
                $phe_report->free_statement();
                $url=array("返回查看"=>__BASEPATH.'phe/person/edit/uuid/'.$uuid.'/report_id/'.$report_id,"人员列表"=>__BASEPATH.'phe/person/index/uuid/'.$report_id,"事件列表"=>__BASEPATH.'phe/index/index');
				message("添加突发公共卫生事件相关人员成功",$url);
            }
            else
            {
                //失败
                $url=array("返回查看"=>__BASEPATH.'phe/person/edit/uuid/'.$uuid.'/report_id/'.$report_id,"人员列表"=>__BASEPATH.'phe/person/index/uuid/'.$report_id,"事件列表"=>__BASEPATH.'phe/index/index');
				message("添加突发公共卫生事件相关人员失败",$url);
            }
        }
    }
    /**
     * phe_personController::deleteAction()
     * 
     * 删除突发卫生公共事件相关人员
     * 
     * @return void
     */
    public function deleteAction()
    {
        $uuid=$this->_request->getParam('uuid');
        if($uuid)
        {
            $phe_person=new Tphe_person();
            $phe_person->whereAdd("uuid='$uuid'");
            $phe_person->find(true);
            $report_id=$phe_person->report_id;
            $phe_person->free_statement();
            
            $phe_person=new Tphe_person();
            $phe_person->whereAdd("uuid='$uuid'");
            if($phe_person->delete())
            {
                $phe_report=new Tphe_report();
                $phe_report->whereAdd("uuid='$report_id'");
                $phe_report->find(true);
                $person_no=$phe_report->person_no-1;
                $phe_report->free_statement();
                
                $phe_report=new Tphe_report();
                $phe_report->person_no=$person_no>=0?$person_no:0;
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