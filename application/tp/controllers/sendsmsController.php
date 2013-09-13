<?php
/**
 * tp_sendsmsController
 * 
 * 完成短信群发功能
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class tp_sendsmsController extends controller
{
    public function init()
    {
        $this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->basePath = $this->_request->getBasePath();
    }
    /**
     * tp_sendsmsController::indexAction()
     * 
     * 群发短信界面
     * 
     * @return void
     */
    public function indexAction()
    {
        $_SESSION['token']=time();
        $this->view->token=$_SESSION['token'];
        $this->view->display("index.html");
    }
    /**
     * tp_sendsmsController::resultAction()
     * 
     * 展示发送结果
     * 
     * @return void
     */
    public function resultAction()
    {
        $message=$this->_request->getParam('message');
        if($message)
        {
            $_SESSION['message']=$message;
        }
        else
        {
            message("对不起，你没有填写短信内容",array("短信发送"=>__BASEPATH.'tp/sendsms/index'));
        }
        $number=$this->_request->getParam('number');
        $token=$this->_request->getParam('token');
        if(isset($_SESSION['token']) && $token==$_SESSION['token'])
        {
            $tmp=explode(',',$number);
            $this->view->message=$message;
            $this->view->number=$tmp;
            $this->view->token=$token;
            $this->view->display('result.html');
        }
        else
        {
            message("对不起，请不要重复提交表单",array("短信发送"=>__BASEPATH.'tp/sendsms/index'));
        }
    }
    /**
     * tp_sendsmsController::sendAction()
     * 
     * 完成信息发送
     * 
     * @return void
     */
    public function sendAction()
    {
        $number=$this->_request->getParam('number');
        $token=$this->_request->getParam('token');
        if($token==$_SESSION['token'])
        {
            require_once(__SITEROOT.'library/sms.php');//发短信库
            $sms=new SMS();
            $sms_date= date("Y-m-d H:i:s");
            $uuid=uniqid('s_',true);
            $sms_status=$sms->sendSMS($uuid,$number,$_SESSION['message'],$sms_date);//发送短信
            if($sms_status==1)
            {
                echo 'ok';
                exit;
            }
            else
            {
                echo 'failed|'.$sms_status;
                exit;
            }
        }
        else
        {
            echo 'token_error';
            exit;
        }
    }
}