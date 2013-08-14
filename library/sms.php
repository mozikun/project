<?php
/**
 *发送短信 
 */


class SMS{

//运营商1移动2联通3电信9其它
private $phone_token=1;	
//应用程序号
private $sms_application_id=__SMS_APPLICATIONID;
/**
 * 设置应用程序号
 *
 * @param String $sms_application_id
 */
public function setSMSApplicationID($sms_application_id){
	$this->sms_application_id=$sms_application_id;
	
}
/**
 * 取应用程序号
 *
 * @param String $sms_application_id
 * @return String
 */
public function getSMSApplicationID($sms_application_id){
	return $this->sms_application_id;
	
}

/**
 * 发送短信
 *
 * @param String $sms_id
 * @param String $telephone_number
 * @param String $content
 * @param String $requesttime 2012-12-12 H:i:s
 * @return Boolean
 */
public function sendSMS($sms_id,$telephone_number,$content,$requesttime){
	//返回结果 
	$result=false;
	if(__SMS==true){
		$this->telecomOperator($telephone_number);
		switch ($this->phone_token){
		case 1://移动
			require_once __SITEROOT."library/Models/sms_outbox.php";
			$sms_outbox=new Tsms_outbox(4);
			$sms_outbox->sismsid=$sms_id;
			$sms_outbox->extcode=$this->sms_application_id;
			$sms_outbox->destaddr=$telephone_number;
			$sms_outbox->messagecontent=$content;
			$sms_outbox->reqdeliveryreport=1;
			$sms_outbox->msgfmt=15;
			$sms_outbox->sendmethod=0;
			$sms_outbox->requesttime=$requesttime;
			$sms_outbox->applicationid=$this->sms_application_id;
			//$sms_outbox->debug(2);
			if($sms_outbox->insert()){
				 $result=true;
			}
			break;
		case 2:
			//2联通
			break;
		case 3:
			//3电信
			break;
		case 9:
			//9其它
			break;
		
		}
		
	
		
	}
	return $result;
	
}

/**
 * 返回短信状态 
 *
 * @param String $sms_id
 * @param String $telephone_number
 
 * @return Boolean
 */
public function resultSMS($sms_id,$telephone_number){
	//返回结果 
	$result=false;
	if(__SMS==true){
		
		$this->telecomOperator($telephone_number);
		switch ($this->phone_token){
		case 1://移动
			require_once __SITEROOT."library/Models/sms_sent.php";
			$sms_sent=new Tsms_sent(4);
			$sms_sent->whereAdd("sismsid='$sms_id'");
			$sms_sent->whereAdd("applicationid='".$this->sms_application_id."'");
			$sms_sent->whereAdd("sentresult=0");
			$sms_sent->whereAdd("smsstatus='DeliveryToTerminal'");
			//$sms_sent->debug(2);
			$counter=$sms_sent->count();
			if($counter>0){
				 $result=true;
			}
			break;
		case 2:
			//2联通
			break;
		case 3:
			//3电信
			break;
		case 9:
			//9其它
			break;
		
		}
		
		
	
		
	}
	return $result;
	
}

/**
 * 通过号码验证是哪个运营商1移动2联通3电信9其它
 *
 * @param string $telephone_number
 * @return int
 */
	
public  function telecomOperator($telephone_number){
	
	 if($this->isChinaMobile($telephone_number)){
	 	$this->phone_token=1;//移动
	 }elseif ($this->isChinaUnicom($telephone_number)){
	 	$this->phone_token=2;//联通
	 }elseif($this->isTelecom($telephone_number)){
	 	$this->phone_token=3;//电信
	 }else{
	 	$this->phone_token=9;//其它
	 }
	 return $this->phone_token;

}
	
/**
 * 验证电信号码
 *
 * @param string $telephone_nunber
 */
public function  isTelecom($telephone_nunber){
	$pattern_number=array('133','153','180','189','181');
	$pattern_string=implode('|',$pattern_number);
	$pattern="~{$pattern_string}[0-9]{8}~";//手机号正则
	$result=false;
    if(preg_match($pattern,$telephone_nunber)==1){
    	$result=true;
    }
    return $result;
}
/**
 * 验证移动号码
 *
 * @param string $telephone_nunber
 */
public function  isChinaMobile($telephone_nunber){
	$pattern_number=array('134','135','136','137','138','139','150','152','157','158','159','182','187','188');
	$pattern_string=implode('|',$pattern_number);
	$pattern="~{$pattern_string}[0-9]{8}~";//手机号正则
	$result=false;
    if(preg_match($pattern,$telephone_nunber)==1){
    	$result=true;
    }
    return $result;


}
/**
 * 验证联通号码
 *
 * @param string $telephone_nunber
 */
public  function isChinaUnicom($telephone_nunber){
	$pattern_number=array('130','131','132','155','156','186','185');
	$pattern_string=implode('|',$pattern_number);
	$pattern="~{$pattern_string}[0-9]{8}~";//手机号正则
	$result=false;
    if(preg_match($pattern,$telephone_nunber)==1){
    	$result=true;
    }
    return $result;
	
}
	




}