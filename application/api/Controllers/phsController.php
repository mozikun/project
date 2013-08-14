<?php
/**
 * ph public health service
 *
 */
class api_phsController  extends controller {
	public function init(){
		//用户权限和认证

	}
	public function ihaAction(){
		require_once(__SITEROOT."application/api/models/api_phs_iha.php");
	}
	public function setAction(){

	}
	public function getXMLAction(){
		$client=new SoapClient("http://localhost:8889/wsdl/api_phs_iha.wsdl");
		//header('Content-Type:text/xml');
		//echo $client->getXML();
		//return ;
		$xml=new SimpleXMLElement($client->getXML());
		//echo $client->getXML();
/*		echo '<pre>';
		var_dump($xml);
		echo '</pre>';*/
		//echo $xml->name;
		//遍历数据
		foreach ($xml as $individual){
			echo $individual->name;
			echo $individual->region_path;
			echo '<br />';
		}

	}

	public function setXMLAction(){
		$client=new SoapClient("http://localhost:9004/wsdl/api_phs_iha.wsdl");
		$xml_string="<row><name>mike</name><age>18</age></row>";
		$xml_string1="<?xml version='1.0' encoding='UTF-8'?><row><name>mike</name><age>18</age></row>";
		$xml_string2="<?xml version='1.0' encoding='UTF-8'?><rows><row><name>罗维</name><age>18</age></row><row><name>rose</name><age>19</age></row></rows>";

		echo $client->setXML($xml_string2);

	}
	public function testAction(){
		$client=new SoapClient("http://localhost:9004/wsdl/api_phs_iha.wsdl");
		echo "<pre>";
		var_dump($client->__getFunctions());
		var_dump($client);
		echo "</pre>";
		//echo $client->add(2,3);
		/*		if($client->isAllow()){
		echo "ok";
		}else{
		echo "bad";
		}*/
		echo $client->individualMasterIndex('87878');
		$client->login('512233331111','96e79218965eb72c92a549dd5a330112');
		/*		if($client->isAllow('512233331111')){
		echo "ok";
		}else{
		echo "bad";
		}*/
		echo "<br />";
		echo $client->individualMasterIndex('512233331111');

		//echo $client->individualMasterIndex('2','','','','512233331111','96e79218965eb72c92a549dd5a330112');
	}
}