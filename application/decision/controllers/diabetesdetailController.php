<?php
    class decision_diabetesdetailController extends controller {
    	public function init()
    	{
    		require_once __SITEROOT."library/Models/diabetes_core.php";
    		$this->view->basePath = __BASEPATH ;
    	}
    	public function indexAction()
    	{
    		$this->view->display("list.html");
    	}
    }
?>