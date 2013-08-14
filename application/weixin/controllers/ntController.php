<?php
/**
 * weixin_ntController
 * 
 * @package yaan
 * @author lsm
 * @copyright 2013-6-19
 * 
 */
class weixin_ntController extends controller {
	/**
	 * weixin_ntController::init()
	 * 
	 */
	public function init(){
//		$this->haveWritePrivilege='';
//		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/weixin_notice.php');
		require_once(__SITEROOT.'/library/custom/comm_function.php');
		$this->view->basePath=$this->_request->getBasePath();
	}
	/**
	 * weixin_ntController::listAction()
	 * 
	 * return void
	 */
	public function listAction()
	{
		require_once (__SITEROOT."/library/custom/pager.php");
		$org_id=$this->_request->getParam('org');//默认按org传递
//		if(empty($org_id)){
//			$this->view->display("error.html");
//			exit();
//		}
		//获取当前信息的条数
		$num=$this->_request->getparam("num");
		//初始化分页数
		$num=$num?$num:0;
		//每页信息条数
		$page_num=8;
		//要输出的数
		$current_num=$num+$page_num;
		
		$notice=new Tweixin_notice();
//		$notice->debugLevel(9);
		$notice->whereAdd("org_id='$org_id'");//获取当前机构信息
		$notice->limit($num,$page_num);
		$notice->orderby("create_time DESC");
		$nuNumber=$notice->count();	
		$notice->find();
		$not_arr=array();
		$i=0;
		while ($notice->fetch()){
			$not_arr[$i]['uuid']=$notice->uuid;
			$not_arr[$i]['title']=$notice->title;
			$not_arr[$i]['org_id']=get_organization_name($notice->org_id);
			$not_arr[$i]['staff_id']=get_staff_name_byid($notice->staff_id);
			$not_arr[$i]['create_time']=date("Y-m-d",$notice->create_time);
			
			$i++;
		}
		if($current_num<$nuNumber){
			$this->view->num=$current_num;
		}	
		$this->view->row=$not_arr;
		$this->view->display("list.html");
		
	}
	/**
	 * weixin_ntController::detailAction()
	 * 
	 * return void
	 */
	public function detailAction()
	{
		$uuid=$this->_request->getParam('uuid');
		if(empty($uuid)){
			echo "ID参数获取失败";
			exit();
		}
		$notice=new Tweixin_notice();
		$notice->whereAdd("uuid='$uuid'");
		$notice->find(true);
		$result=$notice->toArray();//把结果直接存到变量
		$result['staff_id']=get_staff_name_byid($notice->staff_id);
		$result['create_time']=date("Y年m月d日",$notice->create_time);
		$this->view->result=$result;
		$this->view->display("detail.html");
	}
}