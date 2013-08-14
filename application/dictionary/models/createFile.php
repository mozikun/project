<?php 
    /**
     * 每个数组名生成一个数组
     * @param $fileName  目录名称
     * @param $category  生成数组名
     * @param $newString 写入数组的字符串
     * @return unknown_type
     */
     function createLone($fileName,$category,$newString){	 
            if(!is_dir($fileName)){
  	         //创建一个目录
                mkdir($fileName);
            //在该目录下创建一个文件
	            $newFileName = $category.'.php';
	           // echo $newFileName;
	            if(!file_exists($fileName.'/'.$newFileName)){
	            $handel = fopen($fileName.'/'.$newFileName,'w+');
	            //构造字符串
	            //echo $newString;
	            $useString = rtrim($newString,',');
	            //echo $useString;
	            //写入文件的内容
	            $content = "<?php\r\n$".$category."=array(".$useString.");\r\n?>";
	            echo $content;
	            fwrite($handel,$content);	
	            fclose($handel);
                }else{
            	echo '<script type="text/javascript">window.alert("文件已经创建,请换个名字重新创建!");history.go(-1);</script>';
  	          	exit();
                }
            }else{
             //在该目录下创建一个文件
	            $newFileName = $category.'.php';
	           // echo $newFileName;
	            if(!file_exists($fileName.'/'.$newFileName)){
	            $handel = fopen($fileName.'/'.$newFileName,'w+');
	            //构造字符串
	            // echo $newString;
	            $useString = rtrim($newString,',');
	            //echo $useString;
	            //写入文件的内容
	            $content = "<?php\r\n$".$category."=array(".$useString.");\r\n?>";
	            //echo $content;
	            fwrite($handel,$content);	
	            fclose($handel);
                }else{
            	echo '<script type="text/javascript">window.alert("文件已经创建,请换个名字重新创建!");history.go(-1);</script>';
  	          	exit();
                }
            }
     }
       /**
     * 每个数组名生成一个数组(生成所有数据的时候)
     * @param $fileName  目录名称
     * @param $category  生成数组名
     * @param $newString 写入数组的字符串
     * @return unknown_type
     */
     function createallLone($fileName,$category,$newString){	 
            if(!is_dir($fileName)){
  	         //创建一个目录
                mkdir($fileName);
            //在该目录下创建一个文件
	            $newFileName = $category.'.php';
	           // echo $newFileName;
	            if(!file_exists($fileName.'/'.$newFileName)){
	            $handel = fopen($fileName.'/'.$newFileName,'w+');
	            //构造字符串
	            //echo $newString;
	            $useString = rtrim($newString,',');
	            //echo $useString;
	            //写入文件的内容
	            $content = "<?php\r\n$".$category."=array(".$useString.");\r\n?>";
	            echo $content;
	            fwrite($handel,$content);	
	            fclose($handel);
                }else{
            	echo '<script type="text/javascript">window.alert("文件已经创建,请换个名字重新创建!");history.go(-1);</script>';
  	          	exit();
                }
            }else{
             //在该目录下创建一个文件
	            $newFileName = $category.'.php';
	           // echo $newFileName;
	            $handel = fopen($fileName.'/'.$newFileName,'w+');
	            //构造字符串
	            // echo $newString;
	            $useString = rtrim($newString,',');
	            //echo $useString;
	            //写入文件的内容
	            $content = "<?php\r\n$".$category."=array(".$useString.");\r\n?>";
	            //echo $content;
	            fwrite($handel,$content);	
	            fclose($handel);
            }
     }
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
	 * 所有数组生成一个文件
	 * @param $fileName   需要遍历的文件目录
	 * @param $folderName 需要创建的文件的名称
	 * @param $working_directory 创建的目录的名称
	 * @return unknown_type
	 */
     function createAllFile($fileName,$folderName,$working_directory){
         if(is_dir($fileName)){
  	          if($dir=opendir($fileName)){
  	          	     $writeStr = '';
  	          		 while(($currentName=readdir($dir))!==false){
  	          		   	  if($currentName!='.' and $currentName!='..'){
                               $replaceStr = str_replace('<?php','',@file_get_contents($fileName.'/'.$currentName));
                               $currReplace = str_replace('?>','',$replaceStr);
                               $writeStr.=$currReplace;
  	          		   	  	 }
  	          		}
        //在该目录下创建一个文件(用来存储所有数组)
            $strName = "<?php\r\n".$writeStr."\r\n?>";
            $loneFile = $working_directory.'/'.$folderName;
            $newHandel = fopen($loneFile,'w+');
            fwrite($newHandel,$strName);
            fclose($newHandel);
  	           }
  	      }
     }
     /**
      * 编辑文件时使用
      * @param $fileName
      * @param $category
      * @param $newString
      */
     function editFile($fileName,$category,$newString){
     	        if(!is_dir($fileName)){
     	        	mkdir($fileName);
     	        }
                $newFileName = $category.'.php';
	            $handel = fopen($fileName.'/'.$newFileName,'w+');
	            //构造字符串
	            $useString = rtrim($newString,',');
	            //写入文件的内容
	            $content = "<?php\r\n$".$category."=array(".$useString.");\r\n?>";
	            fwrite($handel,$content);	
	            fclose($handel);
     }
     
?>