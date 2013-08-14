<?php
/**
 * tools_photoController
 * package:用于个人档案照片的删除
 * datetime:2013-2-27
 * 
 */
class tools_photoController extends controller {
	public function init()
	{
		$this->view->basePath = __BASEPATH;
	}
	public function indexAction()
	{
		$id=$this->_request->getParam("photo");
		$ok=$this->_request->getParam("ok");
		$msg="";
		if(!empty($ok))
		{
			$staus=unlink(__SITEROOT."upload/".$id.".gif");
			if($staus)
			{
				$msg="照片删除成功！";
			}
			else 
			{
				$msg="照片删除失败！";	
			}
		}
		$this->view->assign("msg",$msg);
		$this->view->display("index.html");
	}
}