<?php
/**
 * weixin_heaController
 * 
 * 微信健康教育活动展示
 * 
 * @package yaan
 * @author whx
 * @copyright 2013
 */
class weixin_heaController extends controller
{	
	
    public function init()
    {
        //$this->haveWritePrivilege='';
		//权限验证
		//require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT."/library/Models/health_education.php";
		$this->view->basePath = $this->_request->getBasePath();
		
    }
    /**
     * 
     * 健康教育活动列表
     * 
     * @return void
     */
    public function listAction()
    {	
		//首先获取机构号
		$org_id=$this->_request->getparam("org");
                $org_id=  intval($org_id);
		//当前页数
		$page=$this->_request->getparam("page");
		if(empty($page)&&($page<=1)){
			$page=1;
		}
		//每页显示条数
		$num=8;
		/*
		if(empty($org_id)){
			$this->view->display("error.html");
			exit();
		}
		*/
               
		$health_education=new Thealth_education();
		$health_education->whereAdd("org_id='$org_id'");
		$count=$health_education->count();
		//总页数
		$total_page=ceil($count/$num);
		$health_education->limit(($page-1)*$num,$num);
		$this->view->current_page=$page;
		$this->view->total_page=$total_page;
		//下一页
		if($page+1<=$total_page){
		$this->view->next_page=$page+1;
		}
		$this->view->pre_page=$page-1;
		$health_education->orderby("activity_time desc");
		
		$health_education->find();
		$result=array();
		$index=0;
		while($health_education->fetch()){ 
			$result[$index]['activity_theme']=$health_education->activity_theme;
                        $result[$index]['activity_time']=date("Y-m-d",$health_education->activity_time);
			$result[$index]['id']=$health_education->uuid;
			$index++;
		}
		$this->view->org=$org_id;
		$this->view->result=$result;
		$this->view->display("list.html");
    }
	 /**
     * 
     * 健康教育活动详细信息
     * 
     * @return void
     */
	public function detailAction(){
	//sleep(3000);
		require_once __SITEROOT."/library/Models/staff_core.php";
		$id=$this->_request->getparam("id");
		if(empty($id)){
			echo "ID号获取失败!";
			exit();
		}
		//活动形式数组
		$activity_type=array("发放印刷资料","播放音像资料","设置健康教育宣传栏 ","开展公众健康咨询活动 ","举办健康知识讲座","其它");
		
		$staff_core=new Tstaff_core();
		$health_education=new Thealth_education();
		$health_education->whereAdd("uuid='$id'");
		$health_education->find(true);
		$result=$health_education->toArray();
		$result['created']=date("Y年m月d日",$health_education->created);
		$result['activity_time']=date("Y年m月d日",$health_education->activity_time);
		$result['staff']=$staff_core->name_login;//创建者
		$result['person_in_charge']=$staff_core->person_in_charge;//负责人
		$result['people_fillin_form']=$staff_core->people_fillin_form;//填表人
		$result['activity_type']=$activity_type[$health_education->activity_type-1];
		
		//找出填表人
		if($health_education->people_fillin_form){
			$staff=new Tstaff_core();
			$staff->whereAdd("id='$health_education->people_fillin_form'");
			$staff->find(true);
			$result['people_fillin_form']=$staff->name_login;
		}
		//找出负责人
		if($health_education->person_in_charge){
			$staff=new Tstaff_core();
			$staff->whereAdd("id='$health_education->person_in_charge'");
			$staff->find(true);
			$result['person_in_charge']=$staff->name_login;
		}
		$this->view->result=$result;
		$this->view->display("detail.html");
		
	} 
}