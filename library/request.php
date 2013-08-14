<?php
class request{
	private $request=array();
	public function __construct(){
		if($_POST){
			foreach ($_POST as $key=>$value){
				$this->request[$key]=$value;
				//echo 'post'.$key.'|'.$value."<br />";
			}
		}
		if($_FILES){
			$this->request['_FILES']=$_FILES;
		}else{
			//echo "no file";
		}
	}
	public function setParam($key,$value){
		//$this->request[$key]=trim($value);
		$this->request[$key]=$value;
	}	
/*	2010-06-11　商量后去掉此功能，仅留下与zf兼容的版本
	public function setParameter($key,$value){
		$this->request[$key]=$value;
	}
	public function getParameter($key='',$value=''){
		if(isset($this->request[$key])){
			return $this->request[$key];
		}else{
			return $value;
		}
	}*/
	/**
	 * 兼容zf的写法
	 * @param string $key 键
	 * @param string $value 默认值
	 */
	public function getParam($key='',$value=''){
		if(isset($this->request[$key])){
			//去掉可能潜在的前后空格 这里不能去空格，否则如果提交的值是一个数组，就会出错
			//return trim($this->request[$key]);
			return $this->request[$key];
		}else{
			return $value;
		}
	}
	public function getBasePath(){
		return __BASEPATH;
	}
	
}