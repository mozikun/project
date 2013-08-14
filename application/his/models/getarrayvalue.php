<?php
 function getarrayvalue($arrname,$datavalue)
 {
	 	if(isset($arrname)&&isset($datavalue))
	 	{
	 		
		 	foreach ($arrname as $k=>$v)
		 	{
		 		
		 		if($k==$datavalue)
		 		{
		 			return $v;
		 		}
		 	}
	   }
 }
?>