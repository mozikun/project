<?php
class page{
	public $currentPage;
	public $rowsOfPage;
	public $maxPage;
	function __construct($rowsOfPage,$max_rows){
		$this->rowsOfPage=$rowsOfPage;
		//echo $rowsOfPage;
		//echo $max_rows;
		@$this->maxPage=(intval($max_rows/$rowsOfPage)==$max_rows/$rowsOfPage ? $max_rows/$rowsOfPage : intval($max_rows/$rowsOfPage)+1);
		if($this->maxPage>0){
			$this->maxPage=$this->maxPage-1;//
		}
		else {
			$this->maxPage=0;
		}

		if(isset($_GET['currentPage']) and $_GET['currentPage']!=''){
			$this->currentPage=$_GET['currentPage'];
		}
		else{
			$this->currentPage=0;
		}
	}
	function pageAction(){
		//echo  $this->currentPage;
		//echo "<br />";
		if(isset($_GET['pageAction']) and $_GET['pageAction']=='top'){
			$this->currentPage=0;
		}
		if(isset($_GET['pageAction']) and $_GET['pageAction']=='next'){
			if($this->currentPage<$this->maxPage){
				$this->currentPage++;
				//echo  $this->currentPage;
			}
		}
		if(isset($_GET['pageAction']) and $_GET['pageAction']=='pre'){
			if($this->currentPage!=0){
				$this->currentPage--;
			}

		}
		if(isset($_GET['pageAction']) and $_GET['pageAction']=='bottom'){
			$this->currentPage=$this->maxPage;
		}
		//echo  $this->currentPage;
		//echo "<br />";

	}
}

class common
{
	/**
	 * 获取复选框的值
	 *
	 * @param unknown_type $values
	 * @return unknown
	 */
	public static function get_check_box_value($values){
		$check_box_value='';
		for ($i=0;$i<count($values);$i++){
			$check_box_value=$check_box_value.$values[$i]."|";
		}
		$check_box_value=substr($check_box_value,0,strlen($check_box_value)-1);
		return $check_box_value;
	}
	public static function getUserName($userID){
		//取作者名与部门名
		require_once(__SITEROOT."model/user.php");
		$user=new Tuser();
		$user->where("user_id='$userID'");
		$user->debug(0);
		$user->select();
		$user->fetch();
		return $user->user_name; //作者姓名|text
	}
	/**
	 * 通过newsId取子栏目的名称与id，用于显示导航
	 *
	 * @param unknown_type $newsId
	 */
	public static function getSubMenuInfoByNewsId($newsId){
		$news=new Tnews();
		$sub_menu=new Tsub_menu();
		$news->join("left",$sub_menu,"sub_menu_id");
		$news->where("news_id='".$newsId."'");
		$news->select();
		$news->debug(0);
		$news->fetch();
		$subMenuArray=array("id"=>$sub_menu->sub_menu_id,"description"=>$sub_menu->description);
		//var_dump($subMenuArray);
		return $subMenuArray;

	}
	/**
	 * 通过subMenuId取子栏目的名称与id，用于显示导航
	 *
	 * @param unknown_type $newsId
	 */
	public static function getMenuInfoByMenuId($menuId){
		$menu=new Tmenu();
		$menu->where("id='".$menuId."'");
		$menu->select();
		$menu->debug(0);
		$menu->fetch();
		$menuArray=array("id"=>$menu->id,"description"=>$menu->description);
		//var_dump($subMenuArray);
		return $menuArray;
	}
	/**
	 * 获取某栏目下最新的第一条新闻
	 */
	public static function getFirstNews($menuId){
		$news=new Tnews();
		//$news->whereAdd("sub_menu_id='".$subMenuId."'");

		$news->whereAdd("menuId='$menuId' and auditorStaffId!='-9'");
		$news->orderby("dateUpdate desc");
		$news->limit(0,1);
		//$news->debug(1);
		$news->select();
		$news->fetch();
		return $news->id;
	}
	/**
	 * 处理首页及列表页的标题
	 * 1.超长标题切断
	 * 2.最近时间标题加红
	 *
	 */
	public static function processTitle($news,$titleLength=60,$titleColor='red'){

		$title=$news->title;
		//超长标题处理
		//echo mb_strlen($title)."|".$titleLength;
		//echo "<br />";
		if(mb_strlen($title)>$titleLength){
			$title=mb_substr($title,0,$titleLength,'utf-8').'...';
		}
		/*		//url类型标题处理
		if($news->url!=''){
		$title="<a href='http://".$news->url."' taget='_blank'>".$title."</a>";
		return $title;
		}*/
		//最近三天的信息标题红色显示
		if((time()-$news->date_update)<3*24*60*60){
			$title="<font color='$titleColor'>".$title."</font>";
		}
		else{
			//$title=$news->title;
		}
		return $title;
		//$newsList[$newsListCounter]['title']=mb_substr($title,0,40,'utf-8');
		//echo count($title);
		//mb_substr("测试1测aa试测试3测试测试测试测试测试",0,12,'utf-8');
	}
	/**
	 * 现在传进来的$content已是按当时的__BASEPATH进行了处理的content
	 *
	 * @param unknown_type $content
	 */
	public static function convertImagePathToSmallImagePath($content){
		//echo $content;
		preg_match_all("/\<img.*?src=\"(.*?)\"/i", $content,$matchedImages);
		//用$matchedImages[1]里存的是取出来的图片路径 如果有多个图，则对应的就是
		//$matchedImages[1][0] $matchedImages[1][1]......
		//$smartyTag="body_image_".$counter;
		//因为是首页显示，将大图换为小图，替换图片路径
		$tempElements=explode('/',$matchedImages[1][0]);
		$temp=$tempElements;
		$find=false;
		foreach ($tempElements as $key=>$value) {
			if($value=='upload'){
				$find=true;
			}
			if($find==false){
				array_shift($temp);
			}
		}
		//$tempElements[3]=''
		$tempElements=$temp;
		$tempElements[2]='small_image';
		
		//重构缩略图片路径
		//$imagePath="/".$tempElements[1]."/".$tempElements[2]."/".$tempElements[3]."/".$tempElements[4];
		//$imagePath=$tempElements[1]."/".$tempElements[2]."/".$tempElements[3]."/".$tempElements[4];
		$imagePath=$tempElements[0]."/".$tempElements[1]."/".$tempElements[2]."/".$tempElements[3];
		
		//如果实际的图片文件不存在，则用"暂无图片"代替
		//echo $imagePath;
		//echo "<br />";
		//echo __SITEROOT.$imagePath;
		//echo "<br />";
		//echo __SITEROOT;
		//echo "<br />";
		return $imagePath;
	}
	/**
	 * 根据当时的路径，重构正文中图片的路径
	 * 这里有一个重大bug，如果一篇文章中同一图片文章中出现了二次，则在进行路径替换时会出错。请注意 此ug已修正2010-04-05
	 *
	 * @param unknown_type $content
	 * @return unknown
	 */
	public static function convertImagePathToBasePath($content){
		preg_match_all("/\<img.*?src=\"(.*?)\"/i",$content ,$match1);
		$images=array();
		//这是正则匹配生成的内容部分，是一个数组，如果有多个图片，则有多个元素
		$images=$match1['1'];
		//除去重复的文件，否则如果有二个同样的图片内容中出理，路径替换时会出错
		//array_unique并不改变键，因此有可能出现数字键不连续的情况,因为不能用for循环来处理
		$images=array_unique($images);
		foreach ($images as $key=>$value){
			$imagePathArray=explode('/',$value);
			$newImagePath=__BASEPATH;
			$find=false;
			for($j=0;$j<count($imagePathArray);$j++){
				if($imagePathArray[$j]=='upload'){
					$find=true;
				}
				if($find){
					$newImagePath=$newImagePath.$imagePathArray[$j].'/';
				}
			}
			$newImagePath=rtrim($newImagePath,'/');
			//echo "<br />";
			//echo $newImagePath;
			//echo "<br />";
			$content=str_replace($value,$newImagePath,$content);			
		}
		return $content;
		
/*		
		echo "<pre>";
		var_dump($images);
		echo "</pre>";
		$imagesNumber=count($images);
		echo $imagesNumber." ";
		//echo __LINE__;
		echo "<br />";
		for($i=0;$i<$imagesNumber;$i++){
			//按当前的__BASEPATH重构图片路径
			echo '$i='.$i." ";
			echo $images[$i];
			echo "<br />";
			$imagePathArray=explode('/',$images[$i]);
			$newImagePath=__BASEPATH;
			$find=false;
			for($j=0;$j<count($imagePathArray);$j++){
				if($imagePathArray[$j]=='upload'){
					$find=true;
				}
				if($find){
					$newImagePath=$newImagePath.$imagePathArray[$j].'/';
				}
			}
			$newImagePath=rtrim($newImagePath,'/');
			//echo "<br />";
			//echo $newImagePath;
			//echo "<br />";
			$content=str_replace($images[$i],$newImagePath,$content);

		}
		return $content;*/
	}
}
