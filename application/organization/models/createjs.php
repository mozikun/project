<?php 
    /**
     * 用于生成一个JS数组
     * $path       文件路径
     * $fileName   生成文件名称
     * $table      访问的数据表
     * $arrName    生成的JS数组名称
     */
    require_once __SITEROOT.'/library/pinyin/pinyin.php';
    function createjs($path,$fileName,$table,$arrName){
    	$tableObject = new $table();
    	$tableObject->orderby('region_path ASC');
    	$tableObject->find();    	
    	$count = 0;
    	$result='';
    	//$row=array();
    	while($tableObject->fetch()){
    		
    		$result.=$arrName."[".$count."]=new Array('".$tableObject->id."','".$tableObject->zh_name."','".getPinyin($tableObject->zh_name)."','$tableObject->standard_code');\r\n";
    		//$row[$count]['id']=$tableObject->id;
    		//$row[$count]['zh_name']=$tableObject->id;
    		//$row[$count]['zh_name_py']=getPinyin($tableObject->zh_name);
    		//$row[$count]['standard_code']=$tableObject->standard_code;
    		//$row[$count]['region_path']=$tableObject->region_path;
    		$count++;
    	}
    	//print_r($row);
    	
    	$handel = fopen($path.'/'.$fileName,'w+');
    	$writeStr = "var ".$arrName."=new Array();\r\n".$result;
    	fwrite($handel,$writeStr);
    	fclose($handel);
    }
    /**
     * 用于生成单个JS数组文件
     * $cityId  传入一个市的Id
     * $arrName    生成的JS数组名称
     */
    function createlonejs($path,$cityId,$arrName){
    	$region = new Tregion();
    	$region->whereAdd("p_id='$cityId'");
    	$region->find();	
    	while ($region->fetch()) {
    		$result='';
    		$count = 0;
    		$currentId     = $region->id;
    		$currentregion = $region->region_path;
    		$myorg = new Torganization();
    		$myorg->whereAdd("region_path like '$currentregion%'");
    		$myorg->orderby('region_path ASC');
    		$myorg->find();
    		while ($myorg->fetch()){
    			$result.=$arrName."[".$count."]=new Array('".$myorg->id."','".$myorg->zh_name."','".getPinyin($myorg->zh_name)."','$myorg->standard_code');\r\n";
    			$count++;
    		}
    		//生成一次JS文件
    		$handel = fopen($path.'/'.$currentId.'.js','w+');
	    	$writeStr = "var ".$arrName."=new Array();\r\n".$result;
	    	fwrite($handel,$writeStr);
	    	fclose($handel);
    	}
    }
?>