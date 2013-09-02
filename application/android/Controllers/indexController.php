<?php
/**
 * android_indexController
 * 
 * 完成一个表格的显示
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class android_indexController extends controller
{
    public function init()
    {
        
        require_once(__SITEROOT.'library/Models/staff_core.php');//用户核心表
		require_once(__SITEROOT.'library/Models/staff_archive.php');//用户扩展表
		require_once(__SITEROOT.'library/MyAuth.php');
		$this->auth=Zend_Auth::getInstance();
		$this->view->basePath = $this->_request->getBasePath();
    }
    /**
     * android_indexController::listAction()
     * 
     * 列表页面展现
     * 
     * @return void
     */
    public function listAction()
    {
        $this->redirect(__BASEPATH."android/index/main");
        $this->view->time=date('Y-m-d');
        $this->view->display('list.html');
    }
    /**
     * android用户登录
     *
     */
    public function loginAction()
    {
		if ($this->auth->hasIdentity()) {
			$this->auth->clearIdentity();
			//清除 命名空间
			Zend_Session::namespaceUnset('individual_core');
		}
		
        $this->view->display('login.html');
    }
    /**
     * android主界面
     *
     */
    public function mainAction()
    {
        if (!$this->auth->hasIdentity()) {

			$this->redirect(__BASEPATH."android/index/login");
		}
        $this->view->display('index.html');
    }
    
    
    
     /**
     * 验证码
     */
    public function imageAction()
    {
        //session_start();
        $code = '';
        for ($i = 0; $i < 4; $i++) {
            $code .= dechex(rand(1, 15));
        }
    
        $im = imagecreatetruecolor(50, 20); //创建一个真彩色图片
        //创建颜色
        $bg = imagecolorallocate($im, 255, 255, 255); //背景色
        imagefill($im, 0, 0, $bg); //填充背景

        $te = imagecolorallocate($im, 0, 0, 0);
        //画线条(干扰线)
        $colors = imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255));
        imageline($im, 0, rand(0, 20), 100, rand(0, 30), $colors);
        //画点(噪点)
        for ($i = 0; $i < 100; $i++) {
            imagesetpixel($im, rand(0, 100), rand(0, 30), $te);
        }
        imagettftext($im, 12, 5, 10, 18, $te, __SITEROOT . 'arial.ttf', $code);
        $_SESSION['check_pic'] = $code;
       
        header('Content-type:image/png');
        imagepng($im);

    }

}