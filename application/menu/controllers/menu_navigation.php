<?php
//处理导航　此代码等同于分类列表中的导航
//navigation
$menu=new Tmenu();
$menu->whereAdd("id='$id'");
//$menu->debugLevel(9);
$menu->select();
$menu->fetch();
$path=$menu->path;
//echo $path;
//echo "<br />";
$pathArray=explode(',',$path);
//var_dump($pathArray);

$pathWhereString='';
for($i=0;$i<count($pathArray);$i++){
	$pathWhereString=$pathWhereString."'".$pathArray[$i]."',";
}
$pathWhereString=rtrim($pathWhereString,',');
// path 1,2,4,8  $pathWhereString '1','2','4','8'

//echo $pathWhereString;
//echo "<br />";
$menu=new Tmenu();
$menu->whereAdd("id in ($pathWhereString)");
//$menu->debugLevel(9);
$menu->select();
$menuArray=array();
while($menu->fetch()){
	//echo $menu->description;
	$menuArray[$menu->id]=$menu->description;
}
//var_dump($menuArray);
//$url="<a href='/management/menu/list/id/<!--{$parent_id}-->'>返回</a>";
$url='';
//echo count($pathArray);
//echo $pathArray[0];
for($i=0;$i<count($pathArray);$i++){
	$url=$url."<a href='".__BASEPATH."menu/menu/list/id/$pathArray[$i]'>".$menuArray[$pathArray[$i]]."</a>&nbsp;>&nbsp;";
//echo $url;
}
//echo $url;
$url=rtrim($url,'&nbsp;>&nbsp;');
//echo $url;
//导航
$smartyTag="navigation";
$this->view->assign($smartyTag,$url);