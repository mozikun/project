<?php
/**
 * he_prescriptionController
 * 
 * 完成健康教育处方的管理
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class he_prescriptionController extends controller
{
    public function init()
	{
	   $this->haveWritePrivilege='';
    	require_once(__SITEROOT.'library/privilege.php');
    	require_once __SITEROOT."library/Models/organization.php";
    	require_once __SITEROOT."library/Models/health_prescription.php";
    	require_once(__SITEROOT.'library/MyAuth.php');
        require_once __SITEROOT.'/library/custom/comm_function.php';
	   require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
	   $this->view->assign( "basePath", __BASEPATH );
	}
    /**
     * he_prescriptionController::indexAction()
     * 
     * 健康教育处方列表
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
		$title=$this->_request->getParam('title','');
		$status_type=$this->_request->getParam('status_type','');
		$person_in_charge=$this->_request->getParam('person_in_charge','');
        $health_education_region_path_domain=get_region_path(1);
		$staff_core_region_path_domain=get_region_path(2);
		//医生列表
		$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$person_in_charge);
		$health_education=new Thealth_prescription();
        $staff_core=new Tstaff_core();
        $health_education->whereAdd($staff_core_region_path_domain);
        $health_education->joinAdd('left',$health_education,$staff_core,'doctor_id','id');
		if($title)
		{
			$search['title']=$title;
			$health_education->whereAdd("health_prescription.activity_address like '%$title%'");
		}
		if($status_type)
		{
			$search['status_type']=$status_type;
            if($status_type==1)
            {
                $health_education->whereAdd("health_prescription.status_type = '$status_type' and health_prescription.org_id='$org_id'");
            }
            elseif($status_type==2)
            {
                $health_education->whereAdd("health_prescription.status_type = '$status_type' or health_prescription.org_id='$org_id'");
            }
            else
            {
                $health_education->whereAdd("health_prescription.status_type = '$status_type' and health_prescription.org_id='$org_id'");
            }
		}
		if($person_in_charge && $person_in_charge!='-9')
		{
			$search['person_in_charge']=$person_in_charge;
			$health_education->whereAdd("health_prescription.doctor_id='$person_in_charge'");
		}
		$nums=$health_education->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'he/prescription/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$health_education->limit($startnum,__ROWSOFPAGE);
        $health_education->orderBy("health_prescription.edit_time DESC");
        //$health_education->debugLevel("4");
		$health_education->find();
		$he=array();
		$i=0;
		while ($health_education->fetch())
		{
			$he[$i]['uuid']=$health_education->uuid;
			$he[$i]['js_uuid']=@str_replace(".","_",$health_education->uuid);
			$he[$i]['edit_time']=$health_education->edit_time?adodb_date("Y-m-d",$health_education->edit_time):"";
			$he[$i]['title']=$health_education->title;
			$he[$i]['status_type']=($health_education->status_type==1)?'仅本机构':'开放所有机构';
			$he[$i]['views']=$health_education->views;
			$he[$i]['doctor_id']=get_staff_name_byid($health_education->doctor_id);
			$i++;
		}
		$out = $links->subPageCss2();
		$this->view->assign("page",$pageCurrent);
		$this->view->assign("pager",$out);
		$this->view->assign("he",$he);
		$this->view->assign("search_array",$search);
		$this->view->display("index.html");
    }
    /**
     * he_prescriptionController::editAction()
     * 
     * 添加/编辑展示健康教育处方
     * 
     * @return void
     */
    public function editAction()
    {
        $uuid=$this->_request->getParam('uuid');
        if($uuid)
        {
            //编辑
            $health_education = new Thealth_prescription();
            $health_education->whereAdd("uuid='$uuid'");
            $health_education->find(true);
            $health_education->edit_time=$health_education->edit_time?date("Y-m-d",$health_education->edit_time):'';
            $this->view->health_education=$health_education;
            //医生列表
            $doctor_list=get_doctor_list($this->user['current_region_path_domain'],$health_education->doctor_id);
        }
        else
        {
            //添加
            //初始化填表时间
            $this->view->assign("updated",adodb_date("Y-m-d",time()));
            //医生列表
            $doctor_list=get_doctor_list($this->user['current_region_path_domain'],$this->user['uuid']);
        }
        //填表医生列表
		$this->view->people_fillin_form=$doctor_list;
        $this->view->display('edit.html');
    }
    /**
     * he_prescriptionController::editinAction()
     * 
     * 添加/编辑健康教育处方写入数据库
     * 
     * @return void
     */
    public function editinAction()
    {
        $uuid=$this->_request->getParam('uuid');
        $title=trim($this->_request->getParam('title'));
        $content=$this->_request->getParam('content');
        $edit_time=$this->_request->getParam('updated');
        $edit_time=$edit_time?strtotime($edit_time):'';
        if($title=='' or $content=='')
        {
            $url=array("添加健康教育处方"=>__BASEPATH.'he/prescription/edit',"返回列表"=>__BASEPATH.'he/prescription/index');
            message("健康教育处方标题和内容不能为空",$url);
        }
        $doctor_id=$this->_request->getParam('people_fillin_form');
        $health_education = new Thealth_prescription();
        $health_education->edit_time=$edit_time;
        $health_education->title=$title;
        $health_education->content=$content;
        $health_education->doctor_id=$doctor_id;
        $health_education->status_type=$this->_request->getParam('status_type');
        if($uuid)
        {
            //编辑
            $health_education->whereAdd("uuid='$uuid'");
            if($health_education->update(array($this->user['uuid'],'updated')))
            {
                $url=array("修改健康教育处方"=>__BASEPATH.'he/prescription/edit/uuid/'.$uuid,"返回列表"=>__BASEPATH.'he/prescription/index');
                message("修改健康教育处方成功",$url);
            }
            else
            {
                $url=array("修改健康教育处方"=>__BASEPATH.'he/prescription/edit/uuid/'.$uuid,"返回列表"=>__BASEPATH.'he/prescription/index');
                message("修改健康教育处方失败",$url);
            }
        }
        else
        {
            //添加
            $health_education->views=0;
            $health_education->org_id=$this->user['org_id'];
            $health_education->add_time=time();
            $health_education->uuid=uniqid('P_',true);
            if($health_education->insert($this->user['uuid']))
            {
                $url=array("添加健康教育处方"=>__BASEPATH.'he/prescription/edit',"返回列表"=>__BASEPATH.'he/prescription/index');
                message("添加健康教育处方成功",$url);
            }
            else
            {
                $url=array("添加健康教育处方"=>__BASEPATH.'he/prescription/edit',"返回列表"=>__BASEPATH.'he/prescription/index');
                message("添加健康教育处方失败",$url);
            }
        }
    }
    /**
     * he_prescriptionController::delAction()
     * 
     * 删除健康教育处方
     * 
     * @return void
     */
    public function delAction()
    {
        //获取机构ID
		$org_id=$this->user['org_id'];
		//获取医生ID
		$staff_id=$this->user['uuid'];
		$uuid=$this->_request->getParam("uuid",'');
		if ($staff_id=="" || $uuid!="")
		{
			$health_education=new Thealth_prescription();
			$health_education->whereAdd("uuid='$uuid'");
			if ($health_education->delete($this->user['uuid']))
			{
				echo "ok";
				exit;
			}
			else 
			{
				echo "failed";
				exit;
			}
		}
		else 
		{
			echo "failed";
			exit;
		}
    }
    /**
     * he_prescriptionController::printAction()
     * 
     * 健康教育处方打印
     * 
     * @return void
     */
    public function printAction()
    {
        $uuid=$this->_request->getParam('uuid');
        if($uuid)
        {
            //编辑
            $health_education = new Thealth_prescription();
            $health_education->whereAdd("uuid='$uuid'");
            $health_education->find(true);
            $health_education->edit_time=$health_education->edit_time?date("Y-m-d",$health_education->edit_time):'';
            $this->view->health_education=$health_education;
            //医生列表
            $doctor_list=get_doctor_list($this->user['current_region_path_domain'],$health_education->doctor_id);
            //填表医生列表
    		$this->view->people_fillin_form=$doctor_list;
            $this->view->display('print.html');
        }
        else
        {
            $url=array("返回列表"=>__BASEPATH.'he/prescription/index');
            message("参数错误",$url);
        }
        
    }
}