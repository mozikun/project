<?php
/**
 * 检查权限示例子
 *
 */

class admin_testController extends controller {

	public function init()
	{
		$this->view->basePath = $this->_request->getBasePath();
		//用户验证和权限
		//require_once(__SITEROOT.'library/privilege.php');
		
	}
	public function indexAction(){
		
		//var_dump($this->getModuleName());
		//var_dump($this->getControllerName());
		//var_dump($this->getActionName());
		$resource=$this->getModuleName().'_'.$this->getControllerName();
		//aaaa=role action=resource
		

	}

	public function loginAction(){


		$this->view->display("display.html");
	}

	public function chkloginAction(){
        
		//require_once(__SITEROOT.'library/Models/staff_core.php');
		$user_name=$this->_request->getParam('user_name');//用户名
		$passwd=$this->_request->getParam('passwd');//密码
		//用户名密码只能是数字 ,字母,下划线和减号
		$pattern="~^[a-z0\-_]{1,}$~i";
		//echo $user_name.$passwd;
		if(!preg_match($pattern,$user_name) or !preg_match($pattern,$passwd)){
			echo "用户名和密码格式有错";
			exit();
		}		
		require_once(__SITEROOT.'library/Myauth.php');
		
		$auth = Zend_Auth::getInstance();//创建认证session的命名空间，并放到Zend_Auth的实例的存储器中
		//$auth->setStorage(new Zend_Auth_Storage_Session('userNamespace'));		
		$authAdapter = new MyAuth($user_name,$passwd);
		$result = $auth->authenticate($authAdapter);
		if ($result->isValid()) {
			print_r($result);
		}else{
		   print_r('asd');
		}		





	}

	public function authAction(){
				require_once('Zend/Auth.php');
				$auth = Zend_Auth::getInstance();
				
				
				if ($auth->hasIdentity()) {
				    // Identity exists; get it
				    $identity = $auth->getIdentity();
				    print_r($identity);
				}else{
					echo "false";
				}

	}
	
	public function logoutAction(){
				require_once('Zend/Auth.php');
				Zend_Auth::getInstance()->clearIdentity();


	}
	public function deleteAction(){
		set_time_limit(0);
		require(__SITEROOT.'config/oracleConfig.php');
		//$del_sql="select uuid from individual_core where region_path like '0,1,2,5,75%' and individual_core.identity_number is null";
		//$del_sql="select uuid from individual_core where region_path like '0,1,2,5,75%' and individual_core.criteria_rate <1";
		//echo $databaseConfig['user']. $databaseConfig['password'].$databaseConfig['host'].$databaseConfig['charset'];
		//exit();		
		$link=oci_pconnect($databaseConfig[1]['user'], $databaseConfig[1]['password'],$databaseConfig[1]['host'],$databaseConfig[1]['charset']) or exit("asdf");
		//$sql="select uuid from individual_core where region_path like '0,1,2,5,75%' and individual_core.identity_number is null";
		//所有表名,类型,表备注
		$sql="SELECT TABLE_NAME,TABLE_TYPE,COMMENTS FROM USER_TAB_COMMENTS";
		$statement =oci_parse($link,$sql);
		oci_execute($statement);		
		while ($row = oci_fetch_array ($statement,OCI_ASSOC) ) {
			//echo $row['TABLE_NAME'].$row['COMMENTS'];
			$table_name=$row['TABLE_NAME'];//表名
			//echo $table_name;
			//$table_comment=@$row['COMMENTS'];//表备注
			$sql_inner="SELECT
			    A.COLUMN_NAME COLUN_NAME
			FROM
			    USER_TAB_COLUMNS A,USER_COL_COMMENTS B
			WHERE
			    A.TABLE_NAME = B.TABLE_NAME
			    AND A.COLUMN_NAME = B.COLUMN_NAME
			    AND A.TABLE_NAME = '".$table_name."'" ;
			$statement_inner =oci_parse($link,$sql_inner);			
			oci_execute($statement_inner);
			while ($row_inner = oci_fetch_array ($statement_inner,OCI_ASSOC) ) {
				if($row_inner['COLUN_NAME']=='EXT_UUID'){
								
					//echo "delete from $table_name  where id in ($del_sql);<br/>";
					//echo "alter table  $table_name  modify EXT_UUID VARCHAR2(50);<br/>";
					echo "delete from  $table_name where ext_uuid is not null;<br/>";
					
				}
			}
		

		}
		//家庭档案
		//echo "delete from family_archive where householder_id in ($del_sql);<br/>";
		//个要档案
		//echo "delete from individual_core where uuid in ($del_sql);<br/>";
	}
	
	
}
