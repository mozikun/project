<?php
/**
 * weixin_meetController
 * 
 * 现场会专用控制器
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class weixin_meetController extends controller
{
    public function init()
    {
        $this->view->basePath     =  __BASEPATH;
    }
    /**
     * weixin_meetController::index()
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