<?php
  /**
      * 在某个目录下再创建目录
      * @param $path  指定在哪个目录下创建目录
      * @return unknown_type
      */
     function createFolder($path){ 
		 if (!file_exists($path)) 
		  { 
		  createFolder(dirname($path)); 
		  mkdir($path, 0777); 
	} 
	}
	
 /**
  * 在当前目录下创建一个文件
  * $path 文件路径
  * $filename 要创建的文件名
  * $table   使用的tips_type的数据
  */
	function createFile($path,$filename,$table){
		if(!file_exists($filename)){
			$handel       = fopen($path.'/'.$filename.'.php','w+');
			$myString     = '';
			$conditionStr =	'bureau_admin,admin';
			$conditionArr = explode(',',$conditionStr);	
			$sqlStr = '';
			foreach($conditionArr as $k=>$v){
				$sqlStr.=" role_en_name='$v' or ";
			}
			$realSqlStr = rtrim($sqlStr,' or ');
			$mytips   = new $table();
			$mytips->whereAdd($realSqlStr);
			$mytips->whereAdd("tips_pid<>-1");
			$mytips->find();
			while($mytips->fetch()){
				$myString.='"'.$mytips->id.'"=>"'.$mytips->tipszh_name.'",';
			}
			$realString    = "<?php\r\n$".$filename.'=array('.rtrim($myString,',').");\r\n?>";
			fwrite($handel,$realString);
			fclose($handel);
		}
	}
?>