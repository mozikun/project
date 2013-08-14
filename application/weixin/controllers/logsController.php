<?php
/**
 * weixin_logsController
 * 
 * 微信接口请求日志
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class weixin_logsController extends controller
{
    public function init()
    {
        $this->haveWritePrivilege = '';
        require_once (__SITEROOT . 'library/privilege.php');
        require_once __SITEROOT . "library/Models/organization.php";
        require_once __SITEROOT . "library/Models/weixin_logs.php";
        require_once (__SITEROOT . 'library/Myauth.php');
        require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."/library/custom/pager.php";
        $this->view->assign("basePath", __BASEPATH);
    }
    /**
     * weixin_logsController::indexAction()
     * 
     * @return void
     */
    public function indexAction()
    {
        $org_id=$this->user['org_id'];
		$search=array();
        $search['wx_event']=$this->_request->getParam('event');
		$log=new Tweixin_logs();
        if($search['wx_event'])
        {
            $log->whereAdd("wx_event='".$search['wx_event']."'");
        }
        $log->whereAdd("org_id='$org_id'");
		$nums=$log->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'weixin/logs/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$log->limit($startnum,__ROWSOFPAGE);
        $log->orderBy("add_time DESC");
		$log->find();
		$logs=array();
		$i=0;
        $event=array(1=>'关注',2=>'取消关注',3=>'文本请求',4=>'图文请求',5=>'图片请求',6=>'地址请求',7=>'连接请求',8=>'其他');
		while ($log->fetch())
		{
			$logs[$i]['uuid']=$log->uuid;
			$logs[$i]['js_uuid']=@str_replace(".","_",$log->uuid);
            $logs[$i]['userid']=str_pad($log->userid,8,0,STR_PAD_LEFT);
			$logs[$i]['add_time']=$log->add_time?adodb_date("Y-m-d H:i:s",$log->add_time):"";
			$logs[$i]['weixin_id']=$log->weixin_id;
            $logs[$i]['content']=$log->content;
            $logs[$i]['reply']=$log->reply==1?'成功':'失败';
            $logs[$i]['event']=$event[$log->wx_event];
			$i++;
		}
		$out = $links->subPageCss2();
		$this->view->assign("page",$pageCurrent);
		$this->view->assign("pager",$out);
		$this->view->assign("logs",$logs);
        $this->view->assign("event",$event);
		$this->view->assign("search",$search);
		$this->view->display("index.html");
    }
    /**
     * weixin_logsController::deleteAction()
     * 
     * @return void
     */
    public function deleteAction()
    {
        $uuid=trim($this->_request->getParam('uuid'));
        if($uuid)
        {
            $log=new Tweixin_logs();
            $log->whereAdd("uuid='$uuid'");
            if($log->delete())
            {
                echo 'ok';
                exit;
            }
            else
            {
                echo 'failed';
                exit;
            }
        }
        else
        {
            echo 'failed';
            exit;
        }
    }
    /**
     * weixin_logsController::deleteallAction()
     * 
     * @return void
     */
    public function deleteallAction()
    {
        
    }
}