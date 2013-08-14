<?php 
/**
 * 对于所有列的生成字段
 * 这个没有使用
 * @param $module_id
 */
    function createAllColumn(){
    	$dataArray = array('S'=>'varchar2','D'=>'date','DT'=>'date','N'=>'number','L'=>'number');
		
    }
/**
 * 对于单个输入的值进行生成字段
 * 使用于添加字段的时候
 * $module_id       数据表的名称
 * $that_format     表示格式(使用正则从中提取字段的长度)
 * $data_element    字段的名称
 * $dataelementname 字段的注释
 * $data_type       字段的数据类型
 */
    function createLoneColumn($module_id,$that_format,$data_element,$dataelementname,$data_type){
    	$dataArray  = array('S'=>'varchar2','D'=>'date','DT'=>'date','N'=>'number','L'=>'number');
    	$changgeDataElement = str_replace('.','_',$data_element);
    	$pregResult = array();
    	//echo $that_format;
    	foreach ($dataArray as $k=>$v){
    		if($k==$data_type){
    			if($k!=='L'){
	    			preg_match_all('~[$0-9]{1,}~',$that_format,$pregResult);
	    			if($k=='S'){
					   $realDataLength = $pregResult[0][0]*3;
	    			}else{
	    			   $realDataLength = $pregResult[0][0];
	    			}
	    			//echo $changgeDataElement;
	    			if($k=='D'||$k=='DT'){
	    				$addFirst = "alter table ws_".$module_id." add ".$changgeDataElement." ".$v;
	    			}else{
	    			    $addFirst = "alter table ws_".$module_id." add ".$changgeDataElement." ".$v."(".$realDataLength.")";
	    			}
	    			$addSecond= "comment on column ws_".$module_id.".".$changgeDataElement." IS '".$dataelementname."'";	
    			  }else{
    				$addFirst = "alter table ws_".$module_id." add ".$changgeDataElement." ".$v;
    				$addSecond= "comment on column ws_".$module_id.".".$changgeDataElement." IS '".$dataelementname."'";
    			  }
    		       $creatColumn    = new Tws_info();
					if(
						@$creatColumn->oracle_query($addFirst)&&@$creatColumn->oracle_query($addSecond)
					){
						return true;
					}else{
						return false;
					}
//                echo $addFirst.'<br/>';
//                echo $addSecond.'<br/>';
				//echo "comment on colum ws_".$module_id.".".$changgeDataElement." IS '".$dataelementname."'";
    		}
    	}
    	
    }
/**
 * 用于编辑字段属性
 * $oldDataElement 没编辑以前的字段的名称
 * $data_element   编辑后重新输入的字段名
 */
  function editLoneColumn($module_id,$that_format,$data_element,$dataelementname,$data_type,$oldDataElement){
  	    $dataArray  = array('S'=>'varchar2','D'=>'date','DT'=>'date','N'=>'number','L'=>'number');
    	$pregResult = array();
    	$changgeDataElement = str_replace('.','_',$data_element);
	    $changeOldElement   = str_replace('.','_',$oldDataElement);
    	//echo $data_type;
    	foreach ($dataArray as $k=>$v){
    		if($k==$data_type){
    			if($k!=='L'){
	    			preg_match_all('~[$0-9]{1,}~',$that_format,$pregResult);	
	    			if($k=='S'){
					   $realDataLength = $pregResult[0][0]*3;
	    			}else{
	    			   $realDataLength = $pregResult[0][0];
	    			}				
	    			$editfirst = "ALTER TABLE ws_".$module_id." RENAME COLUMN ".$changeOldElement." TO ".$changgeDataElement;
	    			if($k=='D'||$k=='DT'){
	    			  $editsecond= "ALTER TABLE ws_".$module_id." MODIFY ( ".$changgeDataElement." ".$v." )";
	    			}else{
	    			  $editsecond= "ALTER TABLE ws_".$module_id." MODIFY ( ".$changgeDataElement." ".$v."(".$realDataLength.") )";
	    			}
	    			$editThrid = "comment on column ws_".$module_id.".".$changgeDataElement." IS '".$dataelementname."'";
    			}else{
    				$changgeDataElement = str_replace('.','_',$data_element);
	    			$changeOldElement   = str_replace('.','_',$oldDataElement);	
	    			$editfirst = "ALTER TABLE ws_".$module_id." RENAME COLUMN ".$changeOldElement." TO ".$changgeDataElement;
	    			$editsecond= "ALTER TABLE ws_".$module_id." MODIFY ( ".$changgeDataElement." ".$v." )";
	    			$editThrid = "comment on column ws_".$module_id.".".$changgeDataElement." IS '".$dataelementname."'";
    			}
    			$editColumn = new Tws_info();
    			//这里为了控制已经添加的数据表中的存在的列
    			if($editColumn->oracle_query($editfirst)){
    				
    			}else{
    				if($k=='D'||$k=='DT'){
    				   $editColumn->oracle_query("alter table ws_".$module_id." add ".$changgeDataElement." ".$v);
    			     }else{
    				   $editColumn->oracle_query("alter table ws_".$module_id." add ".$changgeDataElement." ".$v."(".$realDataLength.")");
    			     }
    			}
    			if(@$editColumn->oracle_query($editsecond)&&@$editColumn->oracle_query($editThrid)){
					return true;
				}else{
					return false;
				}

    		 }	
    	}
  }      
?>     