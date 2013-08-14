<?php
/**
 * weixin_noticeController
 * 
 * @package yaan
 * @author lsm
 * @copyright 2013-6-17
*/
class  weixin_noticeController extends controller {
	/**
	 * weixin_noticeController::init()
	 *
	 */
	public function init(){
		$this->haveWritePrivilege='';
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/weixin_notice.php');
		require_once(__SITEROOT.'/library/custom/comm_function.php');
		$this->view->basePath=__BASEPATH;
	}
	/**
	 * weixin_noticeController::indexAction()
	 *
	 */
	public function indexAction(){
		require_once (__SITEROOT."/library/custom/pager.php");
		$title=$this->_request->getParam('title');
		$start_time=$this->_request->getParam('start_time');
		$end_time=$this->_request->getParam('end_time');
		$notice=new Tweixin_notice();
		if(!empty($title))
		{
			$notice->whereAdd("title like '%$title%'");
		}
		if(!empty($start_time))
		{
			$start_time1=strtotime($start_time);
			$notice->whereAdd("create_time>='$start_time1'");
		}
		if(!empty($end_time))
		{
			$end_time1=strtotime($end_time);
			$notice->whereAdd("create_time<='$end_time1'");
		}
		$org_id=$this->user['org_id'];
		$notice->whereAdd("org_id='$org_id'");//当前机构
		$notice->orderby("create_time DESC");
		$nuNumber=$notice->count();
		$arrArg=array('title'=>$title,'start_time'=>$start_time,'end_time'=>$end_time);
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nuNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'weixin/notice/index/page/',3,$arrArg);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
        $notice->limit($startnum,__ROWSOFPAGE);				
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
		$this->view->row=$not_arr;
		$pager = $links->subPageCss2();
		$this->view->pager = $pager;
		$this->view->display("index.html");
	}
	/**
	 * weixin_noticeController::addAction()
	 *
	 */
	public function addAction()
	{
		$uuid=$this->_request->getParam('uuid');
		$title=$this->_request->getParam('title');
		$content=$this->_request->getParam('content');
		//添加
		if(empty($uuid)){
			$flag=true;
			if(!empty($_POST['submit']))
			{
				$notice=new Tweixin_notice();
				$notice->uuid=uniqid("n_",true);
				$notice->title=$title;
				$notice->content=$content;
				$notice->org_id=$this->user['org_id'];
				$notice->staff_id=$this->user['uuid'];
				$notice->create_time=time();
				if($notice->insert()){
					message("添加成功！",array("微信通知列表"=>__BASEPATH.'weixin/notice/index'));
				}else{
					message("添加失败！",array("微信通知列表"=>__BASEPATH.'weixin/notice/index'));
				}
				
			}
		}else{
			//修改
			$notice_get=new Tweixin_notice();
			$notice_get->whereAdd("uuid='$uuid'");
			$notice_get->find(true);
			$this->view->title=$notice_get->title;
			$this->view->content=$notice_get->content;
			$this->view->uuid=$notice_get->uuid;
			$flag=false;
			
			if(!empty($_POST['submit']))
			{
				$notice=new Tweixin_notice();
				$notice->title=$title;
				$notice->content=$content;
				$notice->whereAdd("uuid='$uuid'");
				if($notice->update()){
					message("修改成功！",array("微信通知列表"=>__BASEPATH.'weixin/notice/index'));
				}else 
				{
//					echo "修改失败！";
					message("修改失败！",array("微信通知列表"=>__BASEPATH.'weixin/notice/index'));
				}	
			}
		}
		$this->view->flag=$flag;
		$this->view->display("add.html");
	}
	/**
	 * weixin_noticeController::delAction()
	 *
	 */
	public function delAction()
	{
		$uuid=$this->_request->getParam('uuid');
		if(empty($uuid)){
			message("参数错误！",array("微信通知列表"=>__BASEPATH.'weixin/notice/index'));
		}
		else {
			$notice=new Tweixin_notice();
			$notice->whereAdd("uuid='$uuid'");
			if($notice->delete())
			{
				message("删除成功！",array("微信通知列表"=>__BASEPATH.'weixin/notice/index'));
			}
			else 
			{
				message("删除失败！",array("微信通知列表"=>__BASEPATH.'weixin/notice/index'));
			}
		}
	}
}