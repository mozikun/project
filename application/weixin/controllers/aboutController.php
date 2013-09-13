<?php
/**
 * weixin_aboutController
 * 
 * 关于我们
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class weixin_aboutController extends controller
{
    public function init()
    {
        $this->view->basePath     =  __BASEPATH;
    }
    /**
     * weixin_aboutController::index()
     * 
     * 展示会议主要内容
     * 
     * @return void
     */
    public function indexAction()
    {
        $this->view->display('index.html');
    }
}