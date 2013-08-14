<?php
/**
 * @author mask
 * @todo 居民健康卡通过身份证更新个人档案发卡状态
 */

class HealthCard 
{

	public function __construct()
	{
		require_once __SITEROOT."library/Models/individual_core.php";//个人档案主表
		
	}
	
	
	/**
	 * 更新个人档案发卡状态
	 *
	 * @param string $identity_number
	 * @param string $card_status
	 * @return mixed
	 */
	public function wsUpdate($identity_number,$card_status=2)
	{
		$pattern_identity_number="~[0-9]{17}[0-9x]{1}~i";//身份证正则
		$result=false;//返回结果 
		if(preg_match($pattern_identity_number,$identity_number)){
			$individual_core=new Tindividual_core();
			$individual_core->whereAdd("identity_number='$identity_number'");
			//$individual_core->debug(2);
			$individual_core->card_status=$card_status;//更新卡状态
			if($individual_core->update()){
				$result=true;
			}
		}
		return $result;
	}
	
}
?>