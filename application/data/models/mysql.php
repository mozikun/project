<?php
class orm_mysql{
	public $database;
	public $model_path;//存储生成表对象的路径
	public $view_path;//存储生成表现层代码片段的路径
	public $enumerate_path;//存储生成的枚举数据的路径
	public $code_path;//存储生成控制器中用到的代码片段的存储路径
	public $view_type;//分用smarty,lamp与标准的
	public $sql_path;//存储生成的sql代码的路径
	public $link;
	/**
	 * 类初始化 指定 连接ORACLE的resource
	 *
	 * @param resourse $link
	 */
	public function __construct($link,$database){
		if(is_resource($link)){
			$this->link=$link;
			$this->database=$database;
			mysql_select_db($this->database,$this->link);
		}else{
			throw new Exception('请先建立数据库连接!');
		}
	}
	public function startMapping(){
		//$host=$this->_request->getParam('host',1);
	
		//$this->model_path=__SITE_ROOT."temp/models";
		//$this->model_path=__SITE_ROOT."model";
		//require_once(__SITE_ROOT."config/model_config.php");

		//$this->model_path=__MODEL_PATH;
		//$this->sql_path=__MODEL_PATH;

		/*		$this->view_path=__SITE_ROOT."temp/views";
		$this->enumerate_path=__SITE_ROOT."temp/enumerates";
		$this->code_path=__SITE_ROOT."temp/codes";
		$this->sql_path=__SITE_ROOT."temp/sql";		*/
		//$this->database=$db_instance->get('database');
		//$this->view_type="lamp_html";

		define('CR',"\r\n");
		define('BLANK',"    ");
		mysql_query("set names utf8",$this->link);
		$sql = "SHOW TABLES FROM ".$this->database;
		//echo $sql;

		$result = mysql_query($sql,$this->link);
		$i=1;
		while ($row = mysql_fetch_array($result)) {
			$this->create_model($row['0']);
			//以下生成辅助功能的生成器暂时先关闭
			//$this->create_view($row['0']);
			//$this->create_enumerate($row['0']);
			//$this->create_code($row['0']);
			//echo "table: {$row['0']} ORM-mapping finished<br>";
			echo $i++." 表: {$row['0']} 生成成功<br>";
		}
		//清除缓存文件
		//echo "清除编译文件<br />";
		//$this->deleteDir($this->view->compile_dir);
		//echo "清除缓存文件<br />";
		//$this->deleteDir($this->view->cache_dir);
		//$this->generate_sql_action();
	}

	/**
	 * 
	 * 自动生成代码片段
	 * 分成两类
	 * 1.用于显示的代码片段$this->view->name = $user->name; //类型|text
	 * 2.用于存储的代码片段$user->name = $this->_request->getParam('name')
	 * @param unknown_type $table
	 */

	private function create_model($table){
		$result = mysql_query("show create table $table",$this->link);
		if (!$result) {
			echo "show create table $table"."<br />";
			echo '代码有错: ' . mysql_error();
			exit();
		}
		$class_file=$this->model_path.$table.".php";
		//echo $class_file."<br />";
		$fp=fopen($class_file,"w+");
		if(!$fp){
			echo "创建文件出错： ".$table;
			exit();
		}
		$line="<?php".CR;
		$row = mysql_fetch_array($result);
		preg_match('/COMMENT=[\'\"](.*)[\'\"]/',$row['1'], $table_name);
		//var_dump($row['1']);
        $line=$line."require_once ('db_mysql.php');".CR;
		$line=$line."/**".CR;
		$line=$line." * 注释:".$table_name.CR;
		$line=$line." *".CR;
		$line=$line." * @var ".CR;
		$line=$line." */".CR;


		$line=$line."class ".__MODEL_CLASS_PREFIX.$table." extends dao_mysql".CR;
		$line=$line."{".CR;
		$line=$line.BLANK.'public $__table = '."'".$table."';". CR;
		$result = mysql_query("SHOW FULL COLUMNS FROM $table",$this->link);
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_array($result)) {
				if(substr($row['Field'],0,1)=='_'){
					echo "字段名在本框架下不能以_开头,请修改字段名";
					exit();
				}
				$line=$line.BLANK."/**".CR;
				$line=$line.BLANK." * 注释:".$row['Comment'].CR;
				$line=$line.BLANK." *".CR;
				$line=$line.BLANK." * @var ".$row['Type'].CR;
				$line=$line.BLANK." */".CR;
				$line=$line.BLANK."public $".$row['Field'].";".CR;
				$line=$line.BLANK."/**".CR;
				$line=$line.BLANK." * 注释:".$row['Comment'].CR;
				$line=$line.BLANK." *".CR;
				$line=$line.BLANK." * @var ".$row['Type'].CR;
				$line=$line.BLANK." */".CR;
				$line=$line.BLANK.'public $_'.$row['Field']."='".$table.'.'.$row['Field']."';".CR;

			}
		}

		$line=$line."}".CR;
		fwrite($fp,$line);
		fclose($fp);
	}


	public function set_enumerate_path($path){
		//$root=$_SERVER['DOCUMENT_ROOT'];
		//$path=$root."/".$path;
		if(is_dir($path)){
			$this->enumerate_path=$path;
		}
		else{
			echo "enums path error";
			exit();
		}
	}
	public function set_code_path($path){
		//$root=$_SERVER['DOCUMENT_ROOT'];
		//$path=$root."/".$path;
		if(is_dir($path)){
			$this->code_path=$path;
		}else {
			echo "code path error";
			exit();
		}
	}
	public function set_modle_path($path){
		//$root=$_SERVER['DOCUMENT_ROOT'];
		//$path=$root."/".$path;
		if(is_dir($path)){
			$this->model_path=$path;
		}else {
			echo "models path error";
			exit();
		}
	}
	public function set_sql_path($path){
		//$root=$_SERVER['DOCUMENT_ROOT'];
		//$path=$root."/".$path;
		if(is_dir($path)){
			$this->model_path=$path;
		}else{
			echo "sql path error";
			exit();
		}
	}
	public function set_view_path($path){
		//$root=$_SERVER['DOCUMENT_ROOT'];
		//$path=$root."/".$path;
		if(is_dir($path)){
			$this->view_path=$path;
		}else{
			echo "views path error";
			exit();
		}
	}

}