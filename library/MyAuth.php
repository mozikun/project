<?php

require_once('Zend/Auth.php');
require_once('Zend/Auth/Result.php');
require_once('Zend/Auth/Adapter/Interface.php');
require_once(__SITEROOT.'library/Zend/Auth/Storage/Session.php');
//require_once(__SITEROOT.'library/Models/staff_core.php');//用户核心表
//require_once(__SITEROOT.'library/Models/staff_archive.php');//用户扩展表
require_once("verificaUser.php");

class MyAuth implements Zend_Auth_Adapter_Interface{

//private $username;
//private $password;
private $user;
/**
* Sets username andpassword for authentication
* @return void
*/
public function __construct($username, $password){
	//$this->username=$username;
	//$this->password=$password;
	$this->user=verificaUser($username,$password);
}
	/**
* Performs an authentication attempt
* @throws Zend_Auth_Adapter_Exception If authentication cannot be performed
* @return Zend_Auth_Result
* Zend_Auth_Result::SUCCESS
* Zend_Auth_Result::FAILURE
* Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND
* Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS
* Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID
* Zend_Auth_Result::FAILURE_UNCATEGORIZED
*/
	public function authenticate(){
		if(empty($this->user)){
			$result = new Zend_Auth_Result(Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID, null); 

		}else{
			$result = new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $this->user); 
		}
		return $result;
	}
	
}

