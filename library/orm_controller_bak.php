<?php
//此文件不在使用，放到了setup目录下了
require_once(__SITEROOT."library/db.php");
require_once(__SITEROOT."config/model_config.php");
class orm_controller{
	public $database;
	public $model_path;//存储生成表对象的路径
	public $view_path;//存储生成表现层代码片段的路径
	public $enumerate_path;//存储生成的枚举数据的路径
	public $code_path;//存储生成控制器中用到的代码片段的存储路径
	public $view_type;//分用smarty,lamp与标准的
	public $sql_path;//存储生成的sql代码的路径
	//public $linker;
	public function __construct(){
		$db_instance=db_connect::getInstance();
		$this->model_path=__SITEROOT."temp/models";
		$this->model_path=__SITEROOT.$_model_config['model_files_path'];
		$this->view_path=__SITEROOT."temp/views";
		$this->enumerate_path=__SITEROOT."temp/enumerates";
		$this->code_path=__SITEROOT."temp/codes";		
		$this->sql_path=__SITEROOT."temp/sql";		
		$this->database=$db_instance->get('database');
		$this->view_type="lamp_html";
	}
	public function set_modle_path($path){
		//$root=$_SERVER['DOCUMENT_ROOT'];
		//$path=$root."/".$path;
		if(is_dir($path)){
			$this->model_path=$path;
		}
		else {
			echo "models path error";
			exit();
		}
	}
	public function set_sql_path($path){
		//$root=$_SERVER['DOCUMENT_ROOT'];
		//$path=$root."/".$path;
		if(is_dir($path))
		{
			$this->model_path=$path;
		}
		else 
		{
			echo "sql path error";
			exit();
		}
	}
	public function set_view_path($path){
		//$root=$_SERVER['DOCUMENT_ROOT'];
		//$path=$root."/".$path;
		if(is_dir($path)){
			$this->view_path=$path;
		}
		else {
			echo "views path error";
			exit();
		}
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
		}
		else {
			echo "code path error";
			exit();
		}
	}	
	public function start_mapping_action(){
		define('CR',"\r\n");
		define('BLANK',"    ");
		mysql_query("set names 'utf8'");
		$sql = "SHOW TABLES FROM $this->database";
		$result = mysql_query($sql);
		while ($row = mysql_fetch_array($result)) {
			//生成表对象文件
			$this->create_model($row['0']);
			$this->create_view($row['0']);
			$this->create_enumerate($row['0']);
			$this->create_code($row['0']);
			echo "table: {$row['0']} ORM-mapping finished<br />";
		}
		$this->generate_sql_action();
	}
	private function create_enumerate($table)
	{
		$result = mysql_query("SHOW FULL COLUMNS FROM $table");
		if (!$result) {
			echo 'Could not run query: ' . mysql_error();
			exit;
		}
		$enumerate_file=$this->enumerate_path."/".$table.".php";
		$fp=fopen($enumerate_file,"w+");
		if(!$fp)
		{
			echo "error creating file ".$table;
			exit();
		}
		//$line="";
		$line="<?php".CR;
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_array($result)) {
				//var_dump($row);
				$enumerate=explode("|",$row['Comment']);//comment 为 "xxxxx|xxx|xxx,xxx,xxx"的形式
				//if($table=='test')var_dump($enumerate);
				if(!empty($enumerate['2']))
				{
					//echo 'enumerate'.$enumerate[2];
					$line=$line."//".$row['Field'].$row['Comment'].CR;//显示枚举类型所属的字段名及中文名
					$enumerate_array=explode(",",$enumerate['2']);
					//$school[]=array('0'=>'大学',"1"=>"小学");
					$line=$line."$".$row['Field']."=array(";
					foreach ($enumerate_array as $value)
					{
						$enumerate_value=explode('=>',$value);
						$line=$line."'".$enumerate_value['0']."'=>'".$enumerate_value['1']."',";
					}
					$line=substr($line,0,strlen($line)-1).");".CR;
					//$line=$line."'127'=>'请选择');".CR;
				}
			}
		}	
		fwrite($fp,$line);
		fclose($fp);
	}
	/**
	 * 
	 * 自动生成代码片段
	 * 分成两类
	 * 1.用于显示的代码片段$this->view->name = $user->name; //类型|text
	 * 2.用于存储的代码片段$user->name = $this->_request->getParam('name')
	 * @param unknown_type $table
	 */
	private function create_code($table)
	{
		$result = mysql_query("SHOW FULL COLUMNS FROM $table");
		if (!$result) {
			echo 'Could not run query: ' . mysql_error()."<br>";
			exit;
		}
		$code_file=$this->code_path."/".$table.".php";
		//echo "<hr><br>file ".$view_file." <hr>";
		$fp=fopen($code_file,"w+");
		if(!$fp)
		{
			echo "error creating file ".$table." 生成后台相关的代码片段出错，错误行".__FILE__."<br>";
			exit();
		}
		$line="<?php".CR;
		$line=$line."/**".CR;
		$line=$line." * 注释:以下自动生成的代码主要用于display_action(显示)代码中，完成模型数据对表现层的自动赋值".CR;
		$line=$line." *".CR;
		$line=$line." *  ".CR;
		$line=$line." */".CR;
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_array($result)) 
			{
				//var_dump($row);
				$type=explode("|",$row['Comment']);//comment 为 "xxxxx|xxx|xxxxx"的形式如 性别|radio|1=>男,2=>女
				switch ($type['1'])
				{
					case "text":
					{
						if($this->view_type=='smarty')
						{
							//preg_match('/\((.*)\)/',$row['Type'], $length);
							//$line=$line."<input type='text' name='".$row['Field']."' id='".$row['Field']."' value='<{\$".$row['Field']."}>' length='".$length['1']."' _note='".$row['Comment']."'/>".CR;
							$line=$line.'$view->'.$row['Field'].' = $'.$table.'->'.$row['Field']."; //".$row['Comment'].CR.CR;
						}
						if($this->view_type=='html')
						{
							//preg_match('/\((.*)\)/',$row['Type'], $length);
							//$line=$line."<input type='text' name='".$row['Field']."' id='".$row['Field']."' value='<{\$".$row['Field']."}>' length='".$length['1']."' _note='".$row['Comment']."'/>".CR;
						}
						if($this->view_type=='lamp_html')
						{
							//preg_match('/\((.*)\)/',$row['Type'], $length);
							//$line=$line."<input type='text' name='".$row['Field']."' id='".$row['Field']."' value='<{\$".$row['Field']."}>' length='".$length['1']."' _note='".$row['Comment']."'/>".CR;
							$line=$line.'$view->'.$row['Field'].' = $'.$table.'->'.$row['Field']."; //".$row['Comment'].CR.CR;
						}
						
						break;
					}
					case "textarea":
					{
						if($this->view_type=='smarty')
						{
							//preg_match('/\((.*)\)/',$row['Type'], $length);
							//$line=$line."<input type='text' name='".$row['Field']."' id='".$row['Field']."' value='<{\$".$row['Field']."}>' length='".$length['1']."' _note='".$row['Comment']."'/>".CR;
							$line=$line.'$view->'.$row['Field'].' = $'.$table.'->'.$row['Field']."; //".$row['Comment'].CR.CR;
						}
						if($this->view_type=='html')
						{
							//preg_match('/\((.*)\)/',$row['Type'], $length);
							//$line=$line."<input type='text' name='".$row['Field']."' id='".$row['Field']."' value='<{\$".$row['Field']."}>' length='".$length['1']."' _note='".$row['Comment']."'/>".CR;
						}
						if($this->view_type=='lamp_html')
						{
							//preg_match('/\((.*)\)/',$row['Type'], $length);
							//$line=$line."<input type='text' name='".$row['Field']."' id='".$row['Field']."' value='<{\$".$row['Field']."}>' length='".$length['1']."' _note='".$row['Comment']."'/>".CR;
							$line=$line.'$view->'.$row['Field'].' = $'.$table.'->'.$row['Field']."; //".$row['Comment'].CR.CR;
						}
						
						break;
					}
					case "checkbox":
					{
						if($this->view_type=='smarty')
						{
							//$line=$line."<{html_checkboxes name='".$row['Field']."' options=$".$row['Field']."_checkboxes checked=$".$row['Field']."_current separator='<br />' _note='".$row['Comment']."' }> ".CR;
							$enumerate=explode("|",$row['Comment']);//comment 为 "xxxxx|xxx|xxx,xxx,xxx"的形式
							if(!empty($enumerate['2']))
							{
								$enumerate_array=explode(",",$enumerate['2']);
								$line=$line."$".$row['Field']."=array(";
								foreach ($enumerate_array as $value)
								{
									$enumerate_value=explode('=>',$value);
									$line=$line."'".$enumerate_value['0']."'=>'".$enumerate_value['1']."',";
								}
								$line=substr($line,0,strlen($line)-1).");".CR;
							}
							$line=$line.'$this->view->'.$row['Field'].'_checkboxes = $'.$row['Field']."; //".$row['Comment'].CR;
							$line=$line.'$this->view->'.$row['Field'].'_current = $'.$table.'->'.$row['Field']."; //".$row['Comment'].CR.CR;

						}
						if($this->view_type=='html')
						{
							//$line=$line."<input type='checkbox' name='".$row['Field']."[]' value='' _note='".$row['Comment']."' }> ".CR;

						}
						if($this->view_type=='lamp_html')
						{
							//preg_match('/\((.*)\)/',$row['Type'], $length);
							//$line=$line."<input type='text' name='".$row['Field']."' id='".$row['Field']."' value='<{\$".$row['Field']."}>' length='".$length['1']."' _note='".$row['Comment']."'/>".CR;
							//$line=$line.'$view->'.$row['Field'].' = $'.$table.'->'.$row['Field']."; //".$row['Comment'].CR.CR;
							$enumerate=explode("|",$row['Comment']);//comment 为 "xxxxx|xxx|xxx,xxx,xxx"的形式
							if(!empty($enumerate['2']))
							{
								$enumerate_array=explode(",",$enumerate['2']);
								$line=$line."$".$row['Field']."=array(";
								foreach ($enumerate_array as $value)
								{
									$enumerate_value=explode('=>',$value);
									$line=$line."'".$enumerate_value['0']."'=>'".$enumerate_value['1']."',";
								}
								$line=substr($line,0,strlen($line)-1).");".CR;
							}
							//形成如下的形式
							//$prefer=array('0'=>'苹果','1'=>'香蕉','2'=>'桔子','3'=>'西瓜');
							$line=$line."\$view->check_box('".$row['Field']."',\$view,\$".$row['Field'].",\$".$table."->".$row['Field']."); //".$row['Comment'].CR.CR;
							//$view->check_box('prefer',$view,$prefer,$user->prefer);
						}
						break;
					}
					case "radio":
					{
						if($this->view_type=='smarty')
						{
							//$line=$line."<{html_radios name='".$row['Field']."' options=$".$row['Field']."_checkboxes checked=$".$row['Field']."_current separator='<br />' _note='".$row['Comment']."' }> ".CR;
							$enumerate=explode("|",$row['Comment']);//comment 为 "xxxxx|xxx|xxx,xxx,xxx"的形式
							if(!empty($enumerate['2']))
							{
								$enumerate_array=explode(",",$enumerate['2']);
								$line=$line."$".$row['Field']."=array(";
								foreach ($enumerate_array as $value)
								{
									$enumerate_value=explode('=>',$value);
									$line=$line."'".$enumerate_value['0']."'=>'".$enumerate_value['1']."',";
								}
								$line=substr($line,0,strlen($line)-1).");".CR;
							}
							$line=$line.'$this->view->'.$row['Field'].'_radios = $'.$row['Field']."; //".$row['Comment'].CR;
							$line=$line.'$this->view->'.$row['Field'].'_current = $'.$table.'->'.$row['Field']."; //".$row['Comment'].CR.CR;
						}
						if($this->view_type=='html')
						{
							$line=$line."<input type='radio' name='".$row['Field']."[]' value='' _note='".$row['Comment']."' }--> ".CR.CR;
						}
						if($this->view_type=='lamp_html')
						{
							//preg_match('/\((.*)\)/',$row['Type'], $length);
							//$line=$line."<input type='text' name='".$row['Field']."' id='".$row['Field']."' value='<{\$".$row['Field']."}>' length='".$length['1']."' _note='".$row['Comment']."'/>".CR;
							//$line=$line.'$view->'.$row['Field'].' = $'.$table.'->'.$row['Field']."; //".$row['Comment'].CR.CR;
							$enumerate=explode("|",$row['Comment']);//comment 为 "xxxxx|xxx|xxx,xxx,xxx"的形式
							if(!empty($enumerate['2']))
							{
								$enumerate_array=explode(",",$enumerate['2']);
								$line=$line."$".$row['Field']."=array(";
								foreach ($enumerate_array as $value)
								{
									$enumerate_value=explode('=>',$value);
									$line=$line."'".$enumerate_value['0']."'=>'".$enumerate_value['1']."',";
								}
								$line=substr($line,0,strlen($line)-1).");".CR;
							}
							//形成如下的形式
							//$line=array('0'=>'苹果','1'=>'香蕉','2'=>'桔子','3'=>'西瓜');
							//$line=$line."\$view->radio_box('".$row['Field']."',\$view,\$line,\$".$table."->".$row['Field']."); //".$row['Comment'].CR.CR;
							$line=$line."\$view->radio_box('".$row['Field']."',\$view,\$".$row['Field'].",\$".$table."->".$row['Field']."); //".$row['Comment'].CR.CR;
							//$view->check_box('prefer',$view,$prefer,$user->prefer);
						}
						break;
					}
					case "select":
					{

						if($this->view_type=='smarty')
						{
							//$line=$line."<select name='".$row['Field']."' _note='".$row['Comment']."'>".CR;
							//$line=$line.BLANK."<{html_options options=$".$row['Field']."_options selected=$".$row['Field']."_current }> ".CR;
							//$line=$line."</select>".CR;

							$enumerate=explode("|",$row['Comment']);//comment 为 "xxxxx|xxx|xxx,xxx,xxx"的形式
							if(!empty($enumerate['2']))
							{
								$enumerate_array=explode(",",$enumerate['2']);
								$line=$line."$".$row['Field']."=array(";
								foreach ($enumerate_array as $value)
								{
									$enumerate_value=explode('=>',$value);
									$line=$line."'".$enumerate_value['0']."'=>'".$enumerate_value['1']."',";
								}
								$line=substr($line,0,strlen($line)-1).");".CR;
							}
							$line=$line.'$this->view->'.$row['Field'].'_options = $'.$row['Field']."; //".$row['Comment'].CR;
							$line=$line.'$this->view->'.$row['Field'].'_current = $'.$table.'->'.$row['Field']."; //".$row['Comment'].CR.CR;
						}
						if($this->view_type=='html')
						{
							$line=$line."<select name='".$row['Field']."' _note='".$row['Comment']."'>".CR;
							$line=$line.BLANK."<option value=''></option>".CR;
					    	$line=$line."</select>".CR.CR;
						}
						if($this->view_type=='lamp_html')
						{
							//preg_match('/\((.*)\)/',$row['Type'], $length);
							//$line=$line."<input type='text' name='".$row['Field']."' id='".$row['Field']."' value='<{\$".$row['Field']."}>' length='".$length['1']."' _note='".$row['Comment']."'/>".CR;
							//$line=$line.'$view->'.$row['Field'].' = $'.$table.'->'.$row['Field']."; //".$row['Comment'].CR.CR;
							$enumerate=explode("|",$row['Comment']);//comment 为 "xxxxx|xxx|xxx,xxx,xxx"的形式
							if(!empty($enumerate['2']))
							{
								$enumerate_array=explode(",",$enumerate['2']);
								$line=$line."$".$row['Field']."=array(";
								foreach ($enumerate_array as $value)
								{
									$enumerate_value=explode('=>',$value);
									$line=$line."'".$enumerate_value['0']."'=>'".$enumerate_value['1']."',";
								}
								$line=substr($line,0,strlen($line)-1).");".CR;
							}
							//形成如下的形式
							//$line=array('0'=>'苹果','1'=>'香蕉','2'=>'桔子','3'=>'西瓜');
							//$line=$line."\$view->select_box('".$row['Field']."',\$view,\$line,\$".$table."->".$row['Field']."); //".$row['Comment'].CR.CR;
							$line=$line."\$view->select_box('".$row['Field']."',\$view,\$".$row['Field'].",\$".$table."->".$row['Field']."); //".$row['Comment'].CR.CR;
							//$view->check_box('prefer',$view,$prefer,$user->prefer);
						}
						break;
					}
				}

			}
		}	
		$result = mysql_query("SHOW FULL COLUMNS FROM $table");
		$line=$line."/**".CR;
		$line=$line." * 注释:以下自动生成的代码主要用于editaction(编辑与更新)代码中，提交的数据对模型数据自动赋值".CR;
		$line=$line." *".CR;
		$line=$line." *  ".CR;
		$line=$line." */".CR;
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_array($result)) {
				//var_dump($row);
				$type=explode("|",$row['Comment']);//comment 为 "xxxxx|xxx|xxxxx"的形式如 性别|radio|1=>男,2=>女
				switch ($type['1'])
				{
					case "text":
					{
						if($this->view_type=='smarty')
						{
							//preg_match('/\((.*)\)/',$row['Type'], $length);
							//$line=$line."<input type='text' name='".$row['Field']."' id='".$row['Field']."' value='<{\$".$row['Field']."}>' length='".$length['1']."' _note='".$row['Comment']."'/>".CR;
							$line=$line.'$'.$table.'->'.$row['Field'].' = $this->_request->getParam('."'".$row['Field']."');//".$row['Comment'].CR.CR;
						}
						if($this->view_type=='html')
						{
							//preg_match('/\((.*)\)/',$row['Type'], $length);
							$line=$line.'$'.$table.'->'.$row['Field'].' = $this->_request->getParam('."'".$row['Field']."');//".$row['Comment'].CR.CR;
						}
						if($this->view_type=='lamp_html')
						{
							$line=$line.'$'.$table.'->'.$row['Field']." = \$_POST['".$row['Field']."'];//".$row['Comment'].CR.CR;
						}
						
						break;
					}
					case "textarea":
					{
						if($this->view_type=='smarty')
						{
							$line=$line.'$'.$table.'->'.$row['Field'].' = $this->_request->getParam('."'".$row['Field']."');//".$row['Comment'].CR.CR;
						}
						if($this->view_type=='html')
						{
							$line=$line.'$'.$table.'->'.$row['Field'].' = $this->_request->getParam('."'".$row['Field']."');//".$row['Comment'].CR.CR;
						}
						if($this->view_type=='lamp_html')
						{
							$line=$line.'$'.$table.'->'.$row['Field']." = \$_POST['".$row['Field']."'];//".$row['Comment'].CR.CR;
						}
						
						break;
					}
					case "checkbox":
					{
						if($this->view_type=='smarty')
						{
							$line=$line.'$'.$table.'->'.$row['Field'].' = $this->_request->getParam('."'".$row['Field']."');//".$row['Comment'].CR.CR;

						}
						if($this->view_type=='html')
						{
							$line=$line.'$'.$table.'->'.$row['Field'].' = $this->_request->getParam('."'".$row['Field']."');//".$row['Comment'].CR.CR;
						}
						if($this->view_type=='lamp_html')
						{
							$line=$line."\$view->check_box('".$row['Field']."',\$view,\$line,\$".$table."->".$row['Field']."); //".$row['Comment'].CR.CR;
							$line=$line."\$check_box_value=common::get_check_box_value(\$_POST['".$row['Field']."']);".CR;
							$line=$line.'$'.$table.'->'.$row['Field']." = \$check_box_value;//".$row['Comment'].CR.CR;
						}
						break;
					}
					case "radio":
					{
						if($this->view_type=='smarty')
						{
							$line=$line.'$'.$table.'->'.$row['Field'].' = $this->_request->getParam('."'".$row['Field']."');//".$row['Comment'].CR.CR;
						}
						if($this->view_type=='html')
						{
							$line=$line.'$'.$table.'->'.$row['Field'].' = $this->_request->getParam('."'".$row['Field']."');//".$row['Comment'].CR.CR;
						}
						if($this->view_type=='lamp_html')
						{
							$line=$line.'$'.$table.'->'.$row['Field']." = \$_POST['".$row['Field']."']['0'];//".$row['Comment'].CR.CR;
						}
						break;
					}
					case "select":
					{

						if($this->view_type=='smarty')
						{
							$line=$line.'$'.$table.'->'.$row['Field'].' = $this->_request->getParam('."'".$row['Field']."');//".$row['Comment'].CR.CR;
						}
						if($this->view_type=='html')
						{
							$line=$line.'$'.$table.'->'.$row['Field'].' = $this->_request->getParam('."'".$row['Field']."');//".$row['Comment'].CR.CR;
						}
						if($this->view_type=='lamp_html')
						{
							$line=$line.'$'.$table.'->'.$row['Field']." = \$_POST['".$row['Field']."']['0'];//".$row['Comment'].CR.CR;
						}
						break;
					}
				}				
			}	
		}
		fwrite($fp,$line);
		fclose($fp);
	}
	/**
	 * 生成表现层的html或是smarty格式的代码片段
	 *
	 * @param unknown_type $table
	 */
	private function create_view($table)
	{
		$result = mysql_query("SHOW FULL COLUMNS FROM $table");
		if (!$result) {
			echo 'Could not run query: ' . mysql_error();
			exit;
		}
		$view_file=$this->view_path."/".$table.".php";
		//echo "<hr><br>file ".$view_file." <hr>";
		$fp=fopen($view_file,"w+");
		if(!$fp)
		{
			echo "error creating file ".$table;
			exit();
		}
		$line="";
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_array($result)) {
				//var_dump($row);
				$type=explode("|",$row['Comment']);//comment 为 "xxxxx|xxx"的形式
				switch ($type['1'])
				{
					case "text":
					{
						if($this->view_type=='smarty')
						{
							preg_match('/\((.*)\)/',$row['Type'], $length);
							$line=$line."<input type='text' name='".$row['Field']."' id='".$row['Field']."' value='<!--{\$".$row['Field']."}-->' length='".$length['1']."' _note='".$row['Comment']."'/>".CR;
						}
						if($this->view_type=='html')
						{
							preg_match('/\((.*)\)/',$row['Type'], $length);
							$line=$line."<input type='text' name='".$row['Field']."' id='".$row['Field']."' value='<!--{\$".$row['Field']."}-->' length='".$length['1']."' _note='".$row['Comment']."'/>".CR;
						}
						if($this->view_type=='lamp_html')
						{
							preg_match('/\((.*)\)/',$row['Type'], $length);
							$line=$line."<input type='text' name='".$row['Field']."' id='".$row['Field']."' value='!--{\$".$row['Field']."}--' length='".$length['1']."' _note='".$row['Comment']."'/>".CR;
						}
						
						break;
					}
					case "textarea":
					{
						if($this->view_type=='smarty')
						{
							//preg_match('/\((.*)\)/',$row['Type'], $length);
							//$line=$line."<input type='text' name='".$row['Field']."' id='".$row['Field']."' value='<{\$".$row['Field']."}>' length='".$length['1']."' _note='".$row['Comment']."'/>".CR;
							$line=$line."<textarea name='".$row['Field']."' id='".$row['Field']."' _note='".$row['Comment']."'/><!--{\$".$row['Field']."}--></textarea>".CR;
						}
						if($this->view_type=='html')
						{
							preg_match('/\((.*)\)/',$row['Type'], $length);
							$line=$line."<input type='text' name='".$row['Field']."' id='".$row['Field']."' value='<!--{\$".$row['Field']."}-->' length='".$length['1']."' _note='".$row['Comment']."'/>".CR;
						}
						if($this->view_type=='lamp_html')
						{
							//单引号可以直写 '!--{$name}--'，双引号要加/"!--{/$name}--"
							preg_match('/\((.*)\)/',$row['Type'], $length);
							//$line=$line."<input type='text' name='".$row['Field']."' id='".$row['Field']."' value='!--{\$".$row['Field']."}--' length='".$length['1']."' _note='".$row['Comment']."'/>".CR;
							$line=$line."<textarea name='".$row['Field']."' id='".$row['Field']."' _note='".$row['Comment']."'/>!--{\$".$row['Field']."}--</textarea>".CR;
						}
						
						break;
					}
					case "checkbox":
					{
						if($this->view_type=='smarty')
						{
							$line=$line."<!--{html_checkboxes name='".$row['Field']."' options=$".$row['Field']."_checkboxes checked=$".$row['Field']."_current separator='<br />' _note='".$row['Comment']."' }--> ".CR;
						}
						if($this->view_type=='html')
						{
							$line=$line."<input type='checkbox' name='".$row['Field']."[]' value='' _note='".$row['Comment']."' > ".CR;
						}
						if($this->view_type=='lamp_html')
						{
							//'婚姻状态|checkbox|1=>已昏,2=>未昏',
							$comment_content=$type['2'];
							$options=explode(",",$comment_content);
							for($i=0;$i<count($options);$i++)
							{
								$option=explode("=>",$options[$i]);
								$selected_checkbox=$row['Field']."_".$i;
								$line=$line."<input type='checkbox' name='".$row['Field']."[]' id='".$row['Field']."_".($i+1)."' value='".$option['0']."' !--{\$".$selected_checkbox."}-- _note='".$row['Comment']."'>".$option[1].CR;
							}
						}
						break;
					}
					case "radio":
					{
						if($this->view_type=='smarty')
						{
							$line=$line."<!--{html_radios name='".$row['Field']."' options=$".$row['Field']."_radios checked=$".$row['Field']."_current separator='<br />' _note='".$row['Comment']."' }--> ".CR;
						}
						if($this->view_type=='html')
						{
							$line=$line."<input type='radio' name='".$row['Field']."[]' value='' _note='".$row['Comment']."' }--> ".CR;
						}
						if($this->view_type=='lamp_html')
						{
							//'婚姻状态|checkbox|1=>已昏,2=>未昏',
							$comment_content=$type['2'];
							$options=explode(",",$comment_content);
							for($i=0;$i<count($options);$i++)
							{
								//$option=explode("=>",$options[$i]);
								//$line=$line."<input type='radio' name='".$row['Field']."[]' value='".$option['0']."' _note='".$row['Comment']."'>".$option[1].CR;
								$option=explode("=>",$options[$i]);
								$selected_checkbox=$row['Field']."_".$i;
								$line=$line."<input type='radio' name='".$row['Field']."[]' id='".$row['Field']."_".($i+1)."' value='".$option['0']."' !--{\$".$selected_checkbox."}-- _note='".$row['Comment']."'>".$option[1].CR;
							}
						}
						break;
					}
					case "select":
					{

						if($this->view_type=='smarty')
						{
							$line=$line."<select name='".$row['Field']." id='".$row['Field']."' _note='".$row['Comment']."'>".CR;
							$line=$line.BLANK."<!--{html_options options=$".$row['Field']."_options selected=$".$row['Field']."_current }--> ".CR;
							$line=$line."</select>".CR;
						}
						if($this->view_type=='html')
						{
							$line=$line."<select name='".$row['Field']."' _note='".$row['Comment']."'>".CR;
							$line=$line.BLANK."<option value=''></option>".CR;
					    	$line=$line."</select>".CR;
						}
						if($this->view_type=='lamp_html')
						{
							//comment '学历|select|0=>硕士,1=>本科,2=>大专,3=>中专',
							$line=$line."<select name='".$row['Field']."' _note='".$row['Comment']."'>".CR;
							$comment_content=$type['2'];
							$options=explode(",",$comment_content);
							for($i=0;$i<count($options);$i++)
							{
								$option=explode("=>",$options[$i]);
								//$line=$line."<input type='checkbox' name='".$row['Field']."[]' value='".$option['0']."' _note='".$row['Comment']."'>".$option[1].CR;
								$selected_option=$row['Field']."_".$i;
								$line=$line.BLANK."<option value='".$option['0']."' !--{\$".$selected_option."}-- >".$option[1]."</option>".CR;
							}
					    	$line=$line."</select>".CR;
						}

						break;
					}
				}

			}
		}	
		fwrite($fp,$line);
		fclose($fp);
	}
	private function create_model($table){
		$result = mysql_query("SHOW create table $table");
		if (!$result) {
			echo 'Could not run query: ' . mysql_error();
			exit();
		}
		$classFile=$this->model_path."/".$table.".php";
		echo $classFile."<br />";
		$fp=fopen($classFile,"w+");
		if(!$fp){
			echo "创建$classFile时出错，请检查文件路径设置是否正确，文件是否已被打开";
			exit();
		}
		$line="<?php".CR;
		//$line=$line."require_once '".__SITEROOT."library/db.php';".CR;
		$row = mysql_fetch_array($result);
		//echo "<hr>";
		//echo $row[1];
		//echo "<hr>";
		preg_match('/COMMENT=[\'\"](.*)[\'\"]/',$row['1'], $table_name);
		//echo $table_name[1];
		//echo "<hr>";

		$line=$line."/**".CR;
		$line=$line." * 注释:".$table_name['1'].CR;
		$line=$line." *".CR;
		$line=$line." * @var ".CR;
		$line=$line." */".CR;

		
		$line=$line."class T".$table." extends dao".CR;
		$line=$line."{".CR;
		$line=$line.BLANK.'public $__table = '."'".$table."';". CR;
		$result = mysql_query("SHOW FULL COLUMNS FROM $table");
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_array($result)) {
				$line=$line.BLANK."/**".CR;
				$line=$line.BLANK." * 注释:".$row['Comment'].CR;
				$line=$line.BLANK." *".CR;
				$line=$line.BLANK." * @var ".$row['Type'].CR;
				$line=$line.BLANK." */".CR;
				$line=$line.BLANK."public $".$row['Field'].";".CR;

			}
		}	
  		//$line=$line.BLANK.'function staticGet($k,$v=NULL)'." { return DB_DataObject::staticGet('TBase_code',".'$k,$v); }'.CR;
		$line=$line."}".CR;
		fwrite($fp,$line);
		fclose($fp);
	}
	/**
	 * 生成sql代码主程序
	 *
	 */
	function generate_sql_action()
	{
		define('CR',"\r\n");
		define('BLANK',"    ");

		$sql_file=$this->sql_path."/sql.php";
		$fp=fopen($sql_file,"w+");
		if(!$fp)
		{
			echo "error creating file ".$sql_file.__LINE__;
			exit();
		}

		$sql = "SHOW TABLES FROM $this->database";
		$result = mysql_query($sql);
		$line="<?php".CR;

		while ($row = mysql_fetch_array($result)) 
		{
			$line=$line.$this->generate_sql($row['0'],$fp);//把表名与生成的
			echo "table: {$row['0']} sql finished<br>";
		}
		fwrite($fp,$line);
		fclose($fp);
	}
	
	function generate_sql($table,$fp)
	{
		$result = mysql_query("SHOW create table $table");
		if (!$result) {
			echo 'Could not run query: ' . mysql_error();
			fclose($fp);
			exit();
		}

		$row = mysql_fetch_array($result);
		//echo "<hr>";
		//echo $row[1];
		//echo "<hr>";
		preg_match('/COMMENT=[\'\"](.*)[\'\"]/',$row['1'], $table_name);
		//echo $table_name[1];
		//echo "<hr>";

		$line=$line."/**".CR;
		$line=$line." * 表中文名 : ".$table_name['1'].CR;
		$line=$line." * 表英文名 : ".$table.CR;
		$line=$line." * @var ".CR;
		$line=$line." */".CR;

//ALTER TABLE `Non_communicable_diseases` ADD `malnutrition`  char(10) NOT NULL DEFAULT '2' COMMENT '营养不良|radio|1=>是,2=>否';		

		$result = mysql_query("SHOW FULL COLUMNS FROM $table");
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_array($result)) {

			
				if($row['Null']=='YES')
				{
					$not_null='';		
				}
				else 
				{
					$not_null='NOT NULL';		
				}
				if($row['Default']==null)
				{
					$default='';		
				}
				else 
				{
					$default="DEFAULT '".$row['Default']."' ";		
				}
				if($row['Comment']=='')
				{
					$comment='';		
				}
				else 
				{
					$comment=" comment '".$row['Comment']."' ";		
				}
				$line=$line."mysql_query(\"ALTER TABLE `".$table."` ADD `".$row['Field']."` ".$row['Type']." ".$not_null." ".$default." ".$comment."\");".CR;
			}
		}	
  		//$line=$line.BLANK.'function staticGet($k,$v=NULL)'." { return DB_DataObject::staticGet('TBase_code',".'$k,$v); }'.CR;

		return $line;
	}
	
	function ceate_test_table_action()
	{
		
		
mysql_query("drop table table1");

mysql_query("drop table table2");
mysql_query("drop table table3");
mysql_query("drop table user");
mysql_query("drop table chat");


mysql_query("create table chat(
id char(14) comment '编号',
name char(12) comment '用户名|text',
sentence char(100) comment '内容|text'
) comment '用户表'");


mysql_query("create table table1 (id char(2), name char(6))");

mysql_query("insert into table1 (id,name) value('01','mike')");
mysql_query("insert into table1 (id,name) value('02','rose')");
mysql_query("insert into table1 (id,name) value('03','tom')");


mysql_query("create table table2 (id char(2), name char(6), address char(10))");

mysql_query("insert into table2 (id,name,address) values('01','mike','chendu')");
mysql_query("insert into table2 (id,name,address) values('02','rose','chongqing')");
mysql_query("insert into table2 (id,name,address) values('03','tom','beijing')");

mysql_query("create table table3 (id char(2), course char(20), score int)");

mysql_query("insert into table3 (id,course,score) value('01','english','78')");
mysql_query("insert into table3 (id,course,score) value('01','computer','79')");
mysql_query("insert into table3 (id,course,score) value('01','math','90')");


mysql_query("insert into table3 (id,course,score) value('02','english','98')");
mysql_query("insert into table3 (id,course,score) value('02','computer','79')");
mysql_query("insert into table3 (id,course,score) value('02','math','83')");

mysql_query("create table user(
id char(14) comment '编号',
name char(12) comment '用户名|text',
marriage char(2) comment '婚姻状态|radio|1=>已婚,2=>未婚',
sex char(2) comment 'user 性别|select|1=>男,2=>女',
school char(2) comment '学历|select|0=>硕士,1=>本科,2=>大专,3=>中专',
prefer char(7) comment '爱好|checkbox|0=>苹果,1=>香蕉,2=>桔子,3=>西瓜',
age int(3) comment '年龄|text',
note varchar(100) comment '备注|textarea'
) comment '用户表'");

mysql_query("insert into user(id,name,marriage,sex,school,prefer,age,note) value
('1234','mike','1','1','2','0|2|3','12','this is a good man')");

mysql_query("insert into user(id,name,marriage,sex,school,prefer,age,note) value
('1235','rose','2','1','2','2|3','14','this is a good woman')");


mysql_query("create table score(
id char(14) comment '编号',
english int comment '英语成绩',
computer int comment '计算机',
math int comment '数学'
) comment '成绩表'");

mysql_query("insert into score(id,english,computer,math) value ('1234','20','70','92')");

mysql_query("insert into score(id,english,computer,math) value ('1235','92','75','82')");


//以下为实验用表
/*

drop table table1;
drop table table2;
drop table table3;
drop table test_user;
drop table user;

create table table1 (id char(2), name char(6));

insert into table1 (id,name) value('01','mike');
insert into table1 (id,name) value('02','rose');
insert into table1 (id,name) value('03','tom');


create table table2 (id char(2), name char(6), address char(10));

insert into table2 (id,name,address) values('01','mike','chendu');
insert into table2 (id,name,address) values('02','rose','chongqing');
insert into table2 (id,name,address) values('03','tom','beijing');

create table table3 (id char(2), course char(20), score int);

insert into table3 (id,course,score) value('01','english','78');
insert into table3 (id,course,score) value('01','computer','79');
insert into table3 (id,course,score) value('01','math','90');


insert into table3 (id,course,score) value('02','english','98');
insert into table3 (id,course,score) value('02','computer','79');
insert into table3 (id,course,score) value('02','math','83');

create table user(
id char(14) comment '编号',
name char(12) comment '用户名|text',
marriage char(2) comment '婚姻状态|radio|1=>已婚,2=>未婚',
sex char(2) comment 'user 性别|select|1=>男,2=>女',
school char(2) comment '学历|select|0=>硕士,1=>本科,2=>大专,3=>中专',
prefer char(7) comment '爱好|checkbox|0=>苹果,1=>香蕉,2=>桔子,3=>西瓜',
age int(3) comment '年龄|text',
note varchar(100) comment '备注|textarea'
) comment '用户表';

insert into user(id,name,marriage,sex,school,prefer,age,note) value
('1234','mike','1','1','2','0|2|3','12','this is a good man');

insert into user(id,name,marriage,sex,school,prefer,age,note) value
('1235','rose','2','1','2','2|3','14','this is a good woman');


create table score(
id char(14) comment '编号',
english int comment '英语成绩',
computer int comment '计算机',
math int comment '数学'
) comment '成绩表';

insert into score(id,english,computer,math) value ('1234','20','70','92');

insert into score(id,english,computer,math) value ('1235','92','75','82');
*/
	}
}