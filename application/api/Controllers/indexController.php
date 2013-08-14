<?php
class api_indexController  extends controller {
    /**
     * 门诊病历、出院证明接口
     *
     */
	public function indexAction(){
		require_once(__SITEROOT."application/api/models/api.php");//更新门诊病历、更新出院证明
		//update_patient_history('009-pat-09','00012-pat-01','511025190001011890','2009-10-19','hello');
		//update_hos_discharge_certificate('009-pat-09','00012-pat-01','512100192010100999','2009-10-19','2009-10-19','hello');
		//update_hos_discharge_certificate('ha_009','user_001','513101197009153211','2009-12-19','2009-12-19','rrrr','a','d');
		//exit();
		$wsdl=__SITEROOT."wsdl/api.wsdl";
		$server1=new SoapServer($wsdl, array('uri' => "yawsw"));
		$server1->addFunction(array("update_hos_discharge_certificate","update_patient_history","update_emr","update_clinic_lab_exam","update_indicators"));
		//$server->addFunction(SOAP_FUNCTIONS_ALL);
		//print_r($server1->getFunctions());
		$server1->handle();

	}
	/**
	 * 转诊接口
	 *
	 */
	public function referralAction(){
		require_once(__SITEROOT."application/api/models/api.php");//转诊接口处理函数		
		//patient_referral('3','4c2aa009285c2','');
		//exit();
		$wsdl=__SITEROOT."wsdl/referral.wsdl";//wsdl文件
		$server=new SoapServer($wsdl, array('uri' => "yawsw"));//指定wsdl和namespace
		$server->addFunction(array("patient_referral"));//添加函数到soap handle
		$server->handle();
		
	}
/**
 * 生成接口
 * 1.生成表model
 * 2.生成处理表逻辑函数
 * 3.生成wsdl
 *
 */
	public function generationAction(){
			

		//============start 生成表model==================
		//生成表数据结构
		require_once(__SITEROOT.'application/api/models/function.php');
		//标准数据所有表
		require_once(__SITEROOT.'library/Models/ws_module.php');
		$ws_module=new Tws_module();
		$ws_module->find();
		$table_name_array=array();//存放要生成modle的表名
		$table_comment_array=array();//表备注
		while ($ws_module->fetch()) {
			$table_name_array[]='WS_'.$ws_module->module_id;//表名
			$table_comment_array[]=$ws_module->module_name.$ws_module->module_content;
		}
		$ws_module->free_statement();
		$model_path=__SITEROOT.'library/Models';//
		//生成表名为$table_name的数据结构，文件存放到$model_path
		generation_table($table_name_array,$model_path);
		echo "生成表model<br/>";
		 

		//============end   生成表model==================

		//============start 生成处理表逻辑函数=============
		foreach ($table_name_array as $key=>$table_name){
			$table_name=strtolower($table_name);
			$table_comment=$table_comment_array[$key];//表备注
			generation_model($table_name,__SITEROOT."application/api/models",$table_comment);
		}
		echo "生成处理表逻辑函数<br/>";
		
		
		//============end   生成处理表逻辑函数=============

		//============start 生成wsdl=============
		foreach ($table_name_array as $key=>$table_name){
			$table_name=strtolower($table_name);
			$model_id=ltrim($table_name,'ws_');
			$table_comment=$table_comment_array[$key];//表备注
			generation_wsdl($table_name,__SITEROOT."wsdl","http://admin.yawsw.com/api/stdapi/{$model_id}",$table_comment);
		}
		echo "生成wsdl<br/>";
		
		
		//============end   生成wsdl=============

		//============start 生成访问接口=============
		$file_name=__SITEROOT."application/api/Controllers/stdapiController.php";
		if(($fp=fopen($file_name,'w+'))===false){
			throw new Exception("打开文件{$file_name}失败,请检查权限");
		}
		$content='';
		$content.="<?php\r\n";
		$content.="class api_stdapiController  extends controller {\r\n";
		$content.="public function indexAction(){\r\n";
		$content.="}\r\n";
		foreach ($table_name_array as $key=>$table_name){
			$table_name=strtolower($table_name);
			$model_id=ltrim($table_name,'ws_');
			$table_comment=$table_comment_array[$key];//表备注
			//echo $table_comment;
			$content.="//{$table_comment}\r\n";
			$content.="public function {$model_id}Action(){\r\n";			
			$content.="	require_once(__SITEROOT.\"application/api/models/update_{$model_id}.php\");\r\n";
			$content.="	\$server=new SoapServer(null, array('uri' => 'yawsw'));\r\n";
			$content.="	\$server->addFunction(array('update_{$model_id}'));\r\n";
			$content.="	\$server->handle();\r\n";
			$content.="}\r\n";
		}
		
		$content.="}\r\n";
		if (fwrite($fp, $content) === FALSE) {
			echo "写入文件失败！";
			exit;
		}
		unset($content);
		fclose($fp);
		echo "生成访问接口";

		
		
		//============end   生成访问接口=============
	}



}
