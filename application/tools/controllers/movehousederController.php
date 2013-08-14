<?php
/**
 * @package :用于修改互为户主问题
 * @copyright :
 * @create:2013-4-19
 */

class tools_movehousederController extends controller {
	
	public function init()
	{
		require_once(__SITEROOT."library/Models/individual_core.php");
		$this->view->basePath=$this->_request->getBasePath();
	}
	public function indexAction()
	{
		$this->view->display("index.html");
	}
	public function moveviewAction()
	{
		$card_array=$this->_request->getParam("card");
		$core_array = array();
		$i = 0;
		foreach ($card_array as $k=>$v)
		{
			$card=trim($v);
			$core = new Tindividual_core();
			$core->whereAdd("individual_core.identity_number='$card'");
			$num=$core->count();
            //$core->debugLevel(9);
			$core->find(true);
			$core_array[$i]['name'] = $core->name;
            $core_array[$i]['identity_number'] = $core->identity_number;
            $core_array[$i]['standard_code'] = $core->standard_code_1;
            $core_array[$i]['address'] = $core->address;
            $i++;	  
		}
		$this->view->assign("iha", $core_array);
        $this->view->display("moveview.html");
	}
	public function updateAction()
	{
		$identity_number=$this->_request->getParam("selectFlag");
		$token=false;//修改标志
//		var_dump($identity_number);
//		exit();
		if(!empty($identity_number))
		{
			foreach ($identity_number as $uuid)
			{			
				$individual_core=new Tindividual_core();
				$individual_core->relation_holder="";
				$individual_core->whereAdd("identity_number='{$uuid}'");
				if($individual_core->update())
				{
					$token=true;
				}
			}
			if($token==true){
				echo '修改成功！';
			}else{
				echo '修改失败！';
			}
		}
		else 
		{
			echo "选项为空";
		}
		
	}
}