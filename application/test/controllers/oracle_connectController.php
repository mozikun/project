<?php

class test_oracle_connectController extends controller 
{       
	 public function __construct()
    {
         
        require_once __SITEROOT . '/library/custom/comm_function.php'; //公有函数
        require_once __SITEROOT . "library/Models/organization.php"; //机构表
        require_once __SITEROOT . "application/api/models/api_phs_common.php";
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
        require_once __SITEROOT . "library/Models/vac_card.php"; //预防接种主表
        require_once __SITEROOT . "library/Models/vac_info.php"; //预防接种从表1
        require_once __SITEROOT . "library/Models/vac_second_info.php"; //预防接种从表2
		require_once __SITEROOT . "library/Models/individual_core.php"; //预防接种从表2
        $this->_error_message_start = "<?xml version='1.0' encoding='UTF-8'?><message>";
        $this->_error_message_end = "</message>";
       
    }
	public function indexAction(){
		$core=new Tindividual_core();
		$core->query("seclet * from individual_core");
		//while($core->fetch()){
		//$print_r($core->toArray());
		//}
	}
	
}
?>