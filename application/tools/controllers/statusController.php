<?php
 class tools_statusController extends controller 
 {
 	public function init()
 	{
 		 require_once __SITEROOT . "library/Models/individual_core.php";
 		 require_once __SITEROOT . "library/Models/individual_status.php";
 		 require_once __SITEROOT . "library/Models/region.php";
 		 $this->view->basePath = __BASEPATH;
 	}
 	public function indexAction()
 	{
 		$status_array = array('6');
 		$error ='';
 		$success = '';
 		$identity_nu_array = $this->_request->getParam('identity_array');
 		$ok = $this->_request->getParam('ok');
 		if(!empty($ok))
 		{
 			foreach ($identity_nu_array as $k=>$v)
 			{
 				$identity_number = trim($v);
 				$individual_core = new Tindividual_core();
 				$individual_core->whereAdd("identity_number='$identity_number'");
 				if($individual_core->count()>0)
 				{
 					$individual_core->find(true);
 					//取得个人档案号
 					$uuid = $individual_core->uuid;
 					//删除status中的其他档案状态
 					$individual_status = new Tindividual_status();
 					$individual_status->whereAdd("id='$uuid'");
 					$individual_status->find();
 					while ($individual_status->fetch())
 					{
 						if(in_array($individual_status->status_flag,$status_array))
 						{
	 						$status = new Tindividual_status();
	 						$status->whereAdd("uuid='$individual_status->uuid'");
	 						$status->delete();
 						}
 					}
 					//更新个人表中的状态
 					$update_individual = new Tindividual_core();
 					$update_individual->whereAdd("uuid='$uuid'");
 					$update_individual->status_flag = 1;
 					if($update_individual->update())
 					{
 					  $success.='身份证号为<font color="red">'.$identity_number.'</font>的个人档案转换成功<br />';
 					}
 					else 
 					{
 						$error.= '身份证号为<font color="red">'.$identity_number.'</font>的个人档案转换失败<br />';
 						continue;
 					}
 				}
 				else 
 				{
 					$error.= '身份证号为<font color="red">'.$identity_number.'</font>的个人档案不存在<br />';
 					continue;
 				}
 			}
 		}
 		if(empty($error))
 		{
 			$this->view->msg  ='转换结果为：'.$success;
 		}
 		else 
 		{
 		    $this->view->msg  = '转换结果为：'.$error;
 		}
 		$this->view->display("status.html");
 	}
 }