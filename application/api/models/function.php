<?php
/**
 * 生成表名为$table_name的数据结构，文件存放到$model_path
 *
 * @param mixed $table_name
 * @param string $model_path
 * @return void
 */
function generation_table($table_name,$model_path){
	if(!isset($table_name) || $table_name=='' || !isset($model_path) || $model_path==''){
		throw new Exception("参数错误,必须指定table_name,model_path的值!");
	}
	//数据库连接配置文件
	require(__SITEROOT.'config/oracleConfig.php');
	//生成表结构类
	require(__SITEROOT.'application/data/models/oci8.php');
	//echo $databaseConfig['user']. $databaseConfig['password'].$databaseConfig['host'].$databaseConfig['charset'];
	//exit();
	//连接数据库
	$link=oci_connect($databaseConfig['user'], $databaseConfig['password'],$databaseConfig['host'],$databaseConfig['charset']) or exit("数据连接错误");

	//$path_root=dirname(__FILE__);
	$oci=new Oci8($link);
	//指定生成model的路径
	$oci->set_modle_path($model_path);
	//$table_name是字符串生成一个model,是数组则遍历数组生成model
	if(is_string($table_name)){
		$oci->create_model($table_name);
	}elseif(is_array($table_name)){
		foreach ($table_name as $table_name_var){
			if(is_string($table_name_var)){
				$oci->create_model($table_name_var);
			}else{

			}
		}
	}
	return ;


}
/**
 * 生成处理函数$table_name表名,$model_path路径,$table_comment表备注
 *
 * @param String $table_name
 * @param String $model_path
 * @param String $table_comment
 * 
 */
function generation_model($table_name,$model_path,$table_comment=''){
	if(!isset($table_name) || $table_name=='' || !isset($model_path) || $model_path==''){
		throw new Exception("参数错误,必须指定table_name,model_path的值!");
	}
	require_once(__SITEROOT."library/Models/ws_info.php");
	
	$module_id=ltrim(strtoupper($table_name),'WS_');
	$ws_info=new Tws_info();
	$ws_info->whereAdd("module_id like '$module_id%'");
	//$ws_info->debugLevel(3);
	$ws_info->find();
	$field_array=array();//存放表所有字段和类型
	$i=0;
	while ($ws_info->fetch()) {
		$data_element	= strtolower($ws_info->internal_identifier);//字段名称
		
		$data_type		= strtolower($ws_info->data_type);//字段类型
        
        $data_element_name=$ws_info->data_element_name;//数据元名称
		switch ($data_type){
			case 's':
				$data_type='string';
				break;
			case 'd':
				$data_type='date';
				break;
			case 'dt':
				$data_type='dateTime';
				break;	
			case 'n':
				$data_type='decimal';
				break;
			case 'l':
				$data_type='boolean';
				break;
			default:
				$data_type='string';
		}
		$field_array[$i]['field_name']	= str_replace('.','_',$data_element);
		$field_array[$i]['field_type']	= $data_type;
        $field_array[$i]['element_name']= $data_element_name;
		
		$i++;
	}
	$ws_info->free_statement();
	//print_r($field_array);
	
	//生成的文件名
	$module_id=strtolower($module_id);
	$file_name=$model_path.'/update_'.$module_id.'.php';
	//打开文件
	if(($fp=fopen($file_name,'w+'))===false){
		throw new Exception("打开文件{$file_name}失败,请检查权限");
	}
	$table_name=strtolower($table_name);
	$comment=$table_comment."\r\n";//生成函数注释
	$comment.="* @param string \$ws_id \r\n";
	$comment.="* @param string \$org_id 机构id\r\n";
    $comment.="* @param string \$doctor_id  医生id\r\n";
    $comment.="* @param string \$identity_number  身份证号\r\n";
    
	foreach ($field_array as $fields){
		$field_name=$fields['field_name'];//字段名
		$field_type=$fields['field_type'];//字段备注
        $element_name=$fields['element_name'];//数据元名称
		$comment.="* @param $field_type \${$field_name}  $element_name\r\n";
	}
	$comment.="* @return boolean\r\n";
	$param='$ws_id,';//参数
	$param.='$org_id,';//机构id
    $param.='$doctor_id,';//医生id
    $param.='$identity_number,';//身份证号
	foreach ($field_array as $fields){
		if($fields['field_type']=='decimal'){
			$param.='$'.$fields['field_name'].'=0,';//字段名
		}elseif($fields['field_type']=='boolean'){
			$param.='$'.$fields['field_name'].'=false,';//字段名
		}else{
			$param.='$'.$fields['field_name'].'=\'\',';//字段名
		}
	}
	$param=rtrim($param,",");//去掉右逗号
	$insert_content="\$$table_name -> ws_id=\$ws_id;\r\n";//要插入的数据
    $insert_content.="\$$table_name -> uuid=uniqid('',true);\r\n";
    $insert_content.="\$$table_name -> created=time();\r\n";
    $insert_content.="\$$table_name -> org_id=\$org_id;\r\n";//机构id
    $insert_content.="\$$table_name -> doctor_id=\$doctor_id;\r\n";  //
    $insert_content.="\$$table_name -> identity_number=\$identity_number;//身份证号\r\n";  
    $insert_content.="\$$table_name -> action='insert';\r\n";
    
	$type='';//类型
	foreach ($field_array as $fields){
		
		$field=$fields['field_name'];//字段名
		$type=$fields['field_type'];//字段名
        $element_name=$fields['element_name'];//数据元名称//数据元名称
		if($type=='date' || $type=='dateTime' ){
			//$ws_hrb03_02->hr85_00_002 = $ws_hrb03_02->escape('hr85_00_002',to_date($hr85_00_002,'YYYY-MM-DD'));//死亡日期时间
			$insert_content.="\$$table_name ->$field = empty(\$$field)?null : \$$table_name ->escape('$field',to_date(\$$field,'YYYY-MM-DD')); //$element_name \r\n";
		}else{
			$insert_content.="\$$table_name->$field = \$$field; //$element_name \r\n";
		}
	}
	//待写入的内容
	$content="<?php\r\n";
	$content.="/**\r\n";
	$content.=$comment;//备注
	$content.="*/\r\n";
	$content.="function update_$module_id($param){\r\n";
	$content.="require_once(__SITEROOT.'library/Models/$table_name.php');\r\n";
	$content.="\$table_obj=\"T$table_name\";\r\n";
	$content.="\$$table_name=new \$table_obj();\r\n";
	$content.=$insert_content;
	$content.="if(\$$table_name ->insert()){\r\n";
	$content.="	return true;\r\n";
	$content.="}else{\r\n";
	$content.="	return false;\r\n";
	$content.="}\r\n";
	$content.="\$$table_name ->free_statement();\r\n";
	$content.="}\r\n";
	if (fwrite($fp, $content) === FALSE) {
        echo "写入文件失败！";
        exit;
    }

	unset($field_array);
	unset($content);
	fclose($fp);
	return ;
}
/**
 * 生成表名$table_name的wsdl文件，$wsdl_path wsdl生成路径,$wsdl_location wsdl处理url,$table_comment 表备注
 *
 * @param string $table_name
 * @param string $wsdl_path
 * @param string $wsdl_location
 * @param string $table_comment
 */
function generation_wsdl($table_name,$wsdl_path,$wsdl_location='',$table_comment=''){
	if(!isset($table_name) || $table_name=='' || !isset($wsdl_path) || $wsdl_path==''){
		throw new Exception("参数错误,必须指定table_name,wsdl_path的值!");
	}
	require_once(__SITEROOT."library/Models/ws_info.php");
	
	$module_id=ltrim(strtoupper($table_name),'WS_');
	$ws_info=new Tws_info();
	$ws_info->whereAdd("module_id like '$module_id%'");
	//$ws_info->debugLevel(3);
	$ws_info->find();
	$field_array=array();//存放表所有字段和类型
	$i=0;
	while ($ws_info->fetch()) {
		$data_element	= strtolower($ws_info->internal_identifier);//字段名称
		
		$data_type		= strtolower($ws_info->data_type);//字段类型
		switch ($data_type){
			case 's':
				$data_type='string';
				break;
			case 'd':
				//$data_type='date';
				$data_type='string';
				break;
			case 'dt':
				//$data_type='dateTime';
				$data_type='string';
				break;	
			case 'n':
				$data_type='decimal';
				break;
			case 'l':
				$data_type='boolean';
				break;
			default:
				$data_type='string';
		}
		$field_array[$i]['field_name']	= str_replace('.','_',$data_element);
		$field_array[$i]['field_type']	= $data_type;
		
		$i++;
	}
	$ws_info->free_statement();
	//生成的文件名
	$module_id=strtolower($module_id);
	$file_name=$wsdl_path.'/update_'.$module_id.'.wsdl';
	//打开文件
	if(($fp=fopen($file_name,'w+'))===false){
		throw new Exception("打开文件{$file_name}失败,请检查权限");
	}
	$table_name=strtolower($table_name);
	$comment=$table_comment."\r\n";//生成函数注释	
	
	$param='<part name="ws_id" type="xsd:integer"/>';//参数
	$param.='<part name="org_id" type="xsd:string"/>';//参数
    $param.='<part name="doctor_id" type="xsd:string"/>';//参数
    $param.='<part name="identity_number" type="xsd:string"/>';//参数
	foreach ($field_array as $fields){
		$field_name=$fields['field_name'];//字段名
		$field_type=$fields['field_type'];//字段类型
		$param.="<part name=\"{$field_name}\" type=\"xsd:{$field_type}\"/>\r\n";
		
	}
	
	$content='';//wsdl内容
	$content.="<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
	$content.="<definitions name=\"yaanchis\" targetNamespace=\"urn:yaanchis\" xmlns:typens=\"urn:yaanchis\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/wsdl/soap/\" xmlns:soapenc=\"http://schemas.xmlsoap.org/soap/encoding/\" xmlns:wsdl=\"http://schemas.xmlsoap.org/wsdl/\" xmlns=\"http://schemas.xmlsoap.org/wsdl/\">\r\n";
	//=====start函数参数=========
	$content.="<message name=\"update_{$module_id}\">\r\n";
	$content.="$param\r\n";
	$content.="</message>\r\n";
	//=====end函数参数=========
	//====start函数返回值=========
	$content.="<message name=\"update_{$module_id}Response\">\r\n";
	$content.="	<part name=\"update_{$module_id}Return\" type=\"xsd:boolean\"/>\r\n";
	$content.="</message>\r\n";
	//====end函数名和返回值=========
	//====start portType====
	$content.="<portType name=\"update_{$module_id}PortType\">\r\n";
	$content.="	<operation name=\"update_{$module_id}\">\r\n";
	$content.="		<documentation>\r\n";
	$content.="			$comment\r\n";
	$content.="		</documentation>\r\n";
	$content.="		<input message=\"typens:update_{$module_id}\"/>\r\n";
	$content.="		<output message=\"typens:update_{$module_id}Response\"/>\r\n";
	$content.="	</operation>\r\n";
	$content.="</portType>\r\n";
	//====end portType====
	//====start binding====
	$content.="<binding name=\"update_hrb03_02Binding\" type=\"typens:update_{$module_id}PortType\">\r\n";
	$content.="	<soap:binding style=\"rpc\" transport=\"http://schemas.xmlsoap.org/soap/http\"/>\r\n";
	$content.="	<operation name=\"update_{$module_id}\">\r\n";
	$content.="		<soap:operation soapAction=\"urn:update_{$module_id}Action\"/>\r\n";
	$content.="		<input>\r\n";
	$content.="			<soap:body namespace=\"urn:yaanchis\" use=\"encoded\" encodingStyle=\"http://schemas.xmlsoap.org/soap/encoding/\"/>\r\n";
	$content.="		</input>\r\n";
	$content.="		<output>\r\n";
	$content.="			<soap:body namespace=\"urn:yaanchis\" use=\"encoded\" encodingStyle=\"http://schemas.xmlsoap.org/soap/encoding/\"/>\r\n";
	$content.="		</output>\r\n";
	$content.="	</operation>\r\n";
	$content.="</binding>\r\n";
	//====end binding====
	//====start service====
	$content.="<service name=\"yaanchisService\">\r\n";
	$content.="	<port name=\"update_hrb03_02Port\" binding=\"typens:update_hrb03_02Binding\">\r\n";
	$content.="		<soap:address location=\"{$wsdl_location}\"/>\r\n";
	$content.="	</port>\r\n";
	$content.="</service>\r\n";
	//====end service====
	$content.="</definitions>\r\n";
	if (fwrite($fp, $content) === FALSE) {
        echo "写入文件失败！";
        exit;
    }

	unset($field_array);
	unset($content);
	fclose($fp);
	return ;
}

