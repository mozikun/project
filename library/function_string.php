<?php
function sub_str_ch($string,$start=0,$length=0){
	//echo $start;
	$strlen=strlen($string);
	if($start>$strlen){
		echo "参数值有错!";
		exit();

	}
	if(($start+$length)<=$strlen){

	}
	else{
		$length=$strlen-$start;
	}
	//中国china中国
	//检查开始位置是否是在一个汉字的中间,如果是，则向前退一自动包括一个完整的汉字
	$gb2312=0;
	for($counter=0;$counter<=$start;$counter++)
	{
		if(ord($string[$counter])<=122)//英文字符及数字
		{
			//do nothing here
			//echo "e";
			$gb2312=0;
		}
		if(ord($string[$counter])>=161 and $gb2312==0)//一个汉字开始
		{
			//echo "c1";
			$gb2312=1;
		}
		elseif(ord($string[$counter])>=161 and $gb2312==1)//一个汉字结束
		{
			//echo "c2";
			//$counter++;
			$gb2312=0;
		}
	}
	//echo $counter;
	if(ord($string[$start])>=161 and $gb2312==0)
	{
		//echo "half char";
		$start=$start-1;
	}

	//检查结束位置是否是在一个汉字的中间如果是，则向前退一

	$gb2312=0;
	for($counter=$start;$counter<=$start+$length;$counter++)
	{
		if(ord($string[$counter])<=122)//英文字符及数字
		{
			//do nothing here
			//echo "e";
			$gb2312=0;
		}
		if(ord($string[$counter])>=161 and $gb2312==0)//一个汉字开始
		{
			//echo "c1";
			$gb2312=1;
		}
		elseif(ord($string[$counter])>=161 and $gb2312==1)//一个汉字结束
		{
			//echo "c2";
			//$counter++;
			$gb2312=0;
		}
	}
	//echo $counter;
	if(ord($string[$start+$length])>=161 and $gb2312==0)
	{
		//echo "half char";
		$length=$length-1;
	}

	return substr($string,$start,$length);
}