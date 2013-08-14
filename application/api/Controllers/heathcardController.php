<?php
/**
 * @author mask
 * @todo  居民健康卡更新发卡状态
 * 
 */
class api_heathcardController extends controller 
{

	public function init()
	{

	}
	/**
	 * 更新卡状态服务端
	 *
	 */
	public function indexAction()
	{
		
		require_once(__SITEROOT."application/api/models/health_card.php");	//更新卡状态处理逻辑	
		//$h=new HealthCard();
		//$h->wsUpdate('513101195801025417',1);
		//SELECT * from INDIVIDUAL_CORE where IDENTITY_NUMBER='513101195801025417'
		//exit();
		$SoapServer = new SoapServer(null,array('uri' => 'yawsj.com'));
		$SoapServer->setClass("HealthCard");
		$SoapServer->handle();
		
	}

}
?>