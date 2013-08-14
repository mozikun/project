<?php
/**
 * weixin_userController
 * 
 * 显示微信用户
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class weixin_userController extends controller
{
    /**
     * weixin_userController::init()
     * 
     * @return void
     */
    public function init()
    {
        $this->haveWritePrivilege = '';
        require_once (__SITEROOT . 'library/privilege.php');
        require_once __SITEROOT . "library/Models/organization.php";
        require_once __SITEROOT . "library/Models/weixin_user.php";
        require_once (__SITEROOT . 'library/Myauth.php');
        require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."/library/custom/pager.php";
        $this->view->assign("basePath", __BASEPATH);
    }
    /**
     * weixin_userController::index()
     * 
     * @return void
     */
    public function indexAction()
    {
        $org_id=$this->user['org_id'];
		$search=array();
		$user=new Tweixin_user();
        $user->whereAdd("org_id='$org_id'");
		$nums=$user->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'weixin/user/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$user->limit($startnum,__ROWSOFPAGE);
        $user->orderBy("add_time DESC");
		$user->find();
		$users=array();
		$i=0;
		while ($user->fetch())
		{
			$users[$i]['uuid']=$user->uuid;
			$users[$i]['js_uuid']=@str_replace(".","_",$user->uuid);
            $users[$i]['userid']=str_pad($user->userid,8,0,STR_PAD_LEFT);
			$users[$i]['add_time']=$user->add_time?adodb_date("Y-m-d H:i:s",$user->add_time):"";
			$users[$i]['wx_username']=$user->wx_username;
            $users[$i]['nickname']=$user->nickname;
            $users[$i]['fakeid']=$user->fakeid;
            $users[$i]['role_id']=$user->role_id;
			$i++;
		}
		$out = $links->subPageCss2();
		$this->view->assign("page",$pageCurrent);
		$this->view->assign("pager",$out);
		$this->view->assign("users",$users);
		$this->view->assign("search",$search);
		$this->view->display("index.html");
    }
    /**
     * weixin_userController::send_single()
     * 
     * 给用户推消息界面
     * 
     * @return void
     */
    public function send_singleAction()
    {
        $fakeid=$this->_request->getParam('id');
        $url=array("微信用户列表"=>__BASEPATH.'weixin/user/index');
        if($fakeid)
        {
            $this->view->assign("fakeid",$fakeid);
            $this->view->display("send_single.html");
        }
        else
        {
            message("关键参数获取错误，无法发送信息",$url);
        }
    }
    /**
     * weixin_userController::send_singlein()
     * 
     * 推送单条信息到用户
     * 
     * @return void
     */
    public function send_singleinAction()
    {
        require_once __SITEROOT . "library/custom/wechat.class.php";
        require_once __SITEROOT . "library/Models/weixin_setorg.php";
        $fakeid=$this->_request->getParam('uuid');
        $content=trim($this->_request->getParam('content'));
        $url=array("微信用户列表"=>__BASEPATH.'weixin/user/index');
        if($fakeid && $content)
        {
            $orgs=new Tweixin_setorg();
            $orgs->whereAdd("org_id='".$this->user['org_id']."'");
            $orgs->find(true);
            if($orgs->wx_platform_name && $orgs->wx_platform_pw)
            {
                $options = array('account'=>$orgs->wx_platform_name,'password'=>base64_decode($orgs->wx_platform_pw));
                $wechatObj = new Wechat($options);  //创建Wechat的实例并初始化参数
                $wechatObj->setCookiefilepath(__SITEROOT."cache/");  //设置cookie文件保存目录
                $wechatObj->setWebtokenStoragefile(__SITEROOT."cache/webtoken_".$this->user['org_id'].".txt");  //设置webtoken的保存路径（包括文件名），您不需要主动发送消息不需要设置
                if($wechatObj->login())
                {
                    $result=$wechatObj->send($fakeid,$content);
                    if($result==1)
                    {
                        message("发送信息成功",$url);
                    }
                    else
                    {
                        message("发送信息失败",$url);
                    }
                }
                else
                {
                    //写登录错误日志
                    message("登录微信公众平台发生错误，请检查您填写的登录账号和密码是否正确",$url);
                }
            }
            else
            {
                message("您还为设置微信公众平台的登录账号和密码，无法发送消息",$url);
            }
        }
        else
        {
            message("关键参数获取错误，无法发送信息",$url);
        }
    }
    /**
     * weixin_userController::send_allAction()
     * 
     * 给所有已关注用户群发信息
     * 
     * @return void
     */
    public function send_allAction()
    {
        
    }
}