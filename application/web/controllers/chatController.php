<?php
/**
 * web_chatController
 * 
 * 聊天处理
 * 
 * @package yaan
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class web_chatController extends controller
{
    public function init()
    {
        require_once __SITEROOT."library/Models/organization.php";
        require_once __SITEROOT."library/Models/chat.php";
        require_once __SITEROOT."library/Models/appointment_register.php";
        require_once __SITEROOT."library/Models/staff_core.php";
        require_once __SITEROOT."library/Models/web_sort.php";
        require_once __SITEROOT."library/Models/web_article_base.php";
        require_once __SITEROOT."library/Models/web_article_content.php";
        require_once __SITEROOT."library/Models/department.php";
        require_once __SITEROOT."library/custom/comm_function.php";
        $this->view->basePath = $this->_request->getBasePath();
        //取公共顶部内容
        //取首页栏目
        $web_sort=new Tweb_sort();
        $web_sort->whereAdd("parent_uuid='0'");
        $web_sort->limit(0,20);
        $web_sort->find();
        $i=0;
        $sorts=array();
        while($web_sort->fetch())
        {
            $sorts[$i]['uuid']=$web_sort->uuid;
            $sorts[$i]['py']=$web_sort->sortname_py;
            $sorts[$i]['name']=$web_sort->sortname;
            $i++;
        }
        $this->view->sorts=$sorts;
        $arr=array("天","一","二","三","四","五","六");
        $this->view->timer=date("Y年m月d日 ").' 星期'.$arr[date('w')];
        //取公共底部内容
        //取医院
        $org=new Torganization();
        $org->whereAdd("type=5");
        $org->limit(0,4);
        $org->find();
        $orgs=array();
        $i=0;
        while($org->fetch())
        {
            $orgs[$i]['id']=$org->id;
            $orgs[$i]['zh_name']=$org->zh_name;
            $i++;
        }
        $this->view->orgs=$orgs;
    }
    /**
     * 
     * 聊天页面
     * 
     * @return void
     */
    public function indexAction()
    {	//获取医生id
		$doctor_id=$this->_request->getParam("doctor_id");
		//获取患者id
		$search_session=new Zend_Session_Namespace("iha_search");
		$identity_number=$search_session->identity_number;
		$this->view->doctor_id=$doctor_id;
		$this->view->identity_number=$identity_number;
		$this->view->display("index.html");
    }
	/**
     * 
     * 发送信息
     * 
     * @return void
     */
    public function sendAction(){
		$fromuser=$this->_request->getParam("fromuser");
		$touser=$this->_request->getParam("touser");
		$content=$this->_request->getParam("info");
		//序号+1
		$chat=new Tchat();
		$chat->query("SELECT max(ORDER_ID) as order_id FROM chat");
		$chat->fetch();
		$order_id=$chat->order_id+1;
		//写入数据
		$chat=new Tchat();
		$chat->uuid=uniqid();
		$chat->sender=$fromuser;
		$chat->receiver=$touser;
		$chat->sendtime=time();
		$chat->content=$content;
		$chat->order_id=$order_id;
		if($chat->insert()){
			echo "发送成功！";
		}
		
		
	}
}