<?php
/**
 * weixin_helpController
 * 
 * 用户帮助
 * 
 * @package yaan
 * @author whx
 * @copyright 2013
 */
class weixin_helpController extends controller
{	
	
    public function init()
    {
        
		$this->view->basePath = $this->_request->getBasePath();
		
    }
    /**
     * 
     *用户帮助
     * 
     * @return void
     */
   
	public function indexAction(){
		$this->view->display("index.html");
	}
}