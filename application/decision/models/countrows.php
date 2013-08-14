<?php 
   /**
    * created time:2010-9-14
    * 用于统计有多少个值
    * $arrid    当前所统计的机构ID数组
    * $userarr  数据字典中关于机构扩展信息的数组
    * $newtable 要用到的表
    * $id       需要查询的ID
    * $newstr   与数组匹配的数据库字段
    */
   function sumresult($arrid,$userarr,$newtable,$id,$newstr){
   	  $sumarr ='';
   	  foreach ($userarr as $k=>$v){
   	  	$sumcount = 0;
   	  	$realarr = explode(',',rtrim($arrid,','));
   	  	$key = $k+1;
   	  	//var_dump($realarr);
   	  	foreach ($realarr as $kk=>$vv){
   	  		//var_dump($key);
   	  		$objectnew = new $newtable();
   	  		$objectnew->whereAdd("$id='$vv'");
   	  		$objectnew->whereAdd("$newstr='$key'");
   	  		if($objectnew->count()>0){
   	  			$sumcount = $sumcount+1;
   	  		}else{
   	  			$sumcount = $sumcount+0;
   	  		}
   	  	}
   	    $sumarr.=$sumcount.',';
   	  }
   	  $realArr = rtrim($sumarr,',');
   	  return $realArr;	
   }
?>