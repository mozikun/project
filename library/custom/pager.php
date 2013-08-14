<?php
class SubPages{

	private  $each_disNums;//每页显示的条目数
	private  $nums;//总条目数
	private  $current_page;//当前被选中的页
	private  $sub_pages;//每次显示的页数
	private  $pageNums;//总页数
	private  $page_array = array();//用来构造分页的数组
	private  $subPage_link;//每个分页的链接
	private  $subPage_type;//显示分页的类型
	private  $urlarray;//URL参数数组//2007-9-7
	private  $urlparam;//2007-9-7
	/*
	__construct是SubPages的构造函数，用来在创建类的时候自动运行.
	@$each_disNums  每页显示的条目数
	@nums    总条目数
	@current_num    当前被选中的页
	@sub_pages      每次显示的页数
	@subPage_link   每个分页的链接
	@subPage_type   显示分页的类型

	当@subPage_type=1的时候为普通分页模式
	example：  共4523条记录,每页显示10条,当前第1/453页 [首页] [上页] [下页] [尾页]
	当@subPage_type=2的时候为经典分页样式
	example：  当前第1/453页 [首页] [上页] 1 2 3 4 5 6 7 8 9 10 [下页] [尾页]
	*/
	function __construct($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type,$urlarray){//2007-9-7
		$this->each_disNums=intval($each_disNums);
		$this->nums=intval($nums);
		/*if(!$current_page){
			$this->current_page=1;
		}else{
			$this->current_page=intval($current_page);
		}*/
		$this->sub_pages=intval($sub_pages);
		$this->pageNums=ceil($nums/$each_disNums);
		$this->current_page=$this->check_page($current_page);
		$this->subPage_link=$subPage_link;
		$this->show_SubPages($subPage_type);
		$this->urlparam=$this->Url($urlarray);//2007-9-7
	}


	/*
	__destruct析构函数，当类不在使用的时候调用，该函数用来释放资源。
	*/
	function __destruct(){
		unset($each_disNums);
		unset($nums);
		unset($current_page);
		unset($sub_pages);
		unset($pageNums);
		unset($page_array);
		unset($subPage_link);
		unset($subPage_type);
		unset($urlarray);//2007-9-7
	}

	/*
	show_SubPages函数用在构造函数里面。而且用来判断显示什么样子的分页
	*/
	function show_SubPages($subPage_type){
		if($subPage_type == 1){
			$this->subPageCss1();
		}elseif ($subPage_type == 2){
			$this->subPageCss2();
		}
	}


	/*
	用来给建立分页的数组初始化的函数。
	*/
	function initArray(){
		for($i=0;$i<$this->sub_pages;$i++){
			$this->page_array[$i]=$i;
		}
		return $this->page_array;
	}
	/*
	用来转换参数到URL里面//2007-9-7
	*/
	function Url($ary)
	{
		$Linkstr = "";
		if (count($ary) > 0) {
			foreach ($ary as $key => $val) {
				$Linkstr .= "/".$key."/".$val;
			}
		}
		return $Linkstr;
	}
	function check_page($current_page)
	{
		$temp_page='';
		if(!isset($current_page) || $current_page=='0')  //判断空值及相关问题
			{
				$temp_page=1;
			}
			else
			{
				if ($current_page>0) {            //判断李哥说的负数问题
					$temp_page=$current_page;  //得到当前是第几页
				}
				else
				{
					$temp_page=1;
				}
			}
			//$pagenums=ceil($nums/$page_size); //计算总条数
			if($current_page>$this->pageNums)
			{
				$temp_page=$this->pageNums;  //判断是否是手工乱输入的大于总页数的页码
			}
		return $temp_page;
	}
	/*
	construct_num_Page该函数使用来构造显示的条目
	即使：[1][2][3][4][5][6][7][8][9][10]
	*/
	function construct_num_Page(){
		if($this->pageNums < $this->sub_pages){
			$current_array=array();
			for($i=0;$i<$this->pageNums;$i++){
				$current_array[$i]=$i+1;
			}
		}else{
			$current_array=$this->initArray();
			if($this->current_page <= 3){
				for($i=0;$i<count($current_array);$i++){
					$current_array[$i]=$i+1;
				}
			}elseif ($this->current_page <= $this->pageNums && $this->current_page > $this->pageNums - $this->sub_pages + 1 ){
				for($i=0;$i<count($current_array);$i++){
					$current_array[$i]=($this->pageNums)-($this->sub_pages)+1+$i;
				}
			}else{
				for($i=0;$i<count($current_array);$i++){
					$current_array[$i]=$this->current_page-2+$i;
				}
			}
		}

		return $current_array;
	}

	/*
	构造普通模式的分页
	共4523条记录,每页显示10条,当前第1/453页 [首页] [上页] [下页] [尾页]
	*/
	function subPageCss1(){
		$subPageCss1Str="";
		$subPageCss1Str.="共".$this->nums."条记录，";
		$subPageCss1Str.="每页显示".$this->each_disNums."条，";
		$subPageCss1Str.="当前第".$this->current_page."/".$this->pageNums."页 ";
		if($this->current_page > 1){
			$firstPageUrl=$this->subPage_link."1".$this->urlparam;//2007-9-7
			$prewPageUrl=$this->subPage_link.($this->current_page-1);//2007-9-7
			$prewPageUrl.=$this->urlparam;
			echo $this->urlparam;
			$subPageCss1Str.="[<a href='$firstPageUrl'>首页</a>] ";
			$subPageCss1Str.="[<a href='$prewPageUrl'>上一页</a>] ";
		}else {
			$subPageCss1Str.="[首页] ";
			$subPageCss1Str.="[上一页] ";
		}

		if($this->current_page < $this->pageNums){
			$lastPageUrl=$this->subPage_link.$this->pageNums.$this->urlparam;//2007-9-7
			$nextPageUrl=$this->subPage_link.($this->current_page+1).$this->urlparam;//2007-9-7
			$subPageCss1Str.=" [<a href='$nextPageUrl'>下一页</a>] ";
			$subPageCss1Str.="[<a href='$lastPageUrl'>尾页</a>] ";
		}else {
			$subPageCss1Str.="[下一页] ";
			$subPageCss1Str.="[尾页] ";
		}

		return  $subPageCss1Str;

	}


	/*
	构造经典模式的分页
	当前第1/453页 [首页] [上页] 1 2 3 4 5 6 7 8 9 10 [下页] [尾页]
	*/
	function subPageCss2(){
		$subPageCss2Str="共".$this->nums."条记录&nbsp;每页显示".$this->each_disNums."条&nbsp;";
		$subPageCss2Str.="当前第".$this->current_page."/".$this->pageNums."页 ";


		if($this->current_page > 1){
			$firstPageUrl=$this->subPage_link."1".$this->urlparam;//2007-9-7
			$prewPageUrl=$this->subPage_link.($this->current_page-1).$this->urlparam;//2007-9-7
			//echo $this->urlparam;
			$subPageCss2Str.="<a href='$firstPageUrl'>首页</a> ";
			$subPageCss2Str.="<a href='$prewPageUrl'>上一页</a> ";
		}else {
			$subPageCss2Str.="首页 ";
			$subPageCss2Str.="上一页 ";
		}

		$a=$this->construct_num_Page();
		for($i=0;$i<count($a);$i++){
			$s=$a[$i];
			if($s == $this->current_page ){
				$subPageCss2Str.="&nbsp;<span style='margin:0px 0px 0px 0px;padding:0px 5px 0px 5px;border:1px solid #DEDEB8;color:red;font-weight:bold;background:#FFFFD9;'>".$s."</span>";
			}else{
				$url=$this->subPage_link.$s.$this->urlparam;//2007-9-7
				$subPageCss2Str.="&nbsp;<a href='$url'><span style='margin:0px 0px 0px 0px;padding:0px 5px 0px 5px;border:1px solid #DEDEB8;'>".$s."</span></a>";
			}
		}

		if($this->current_page < $this->pageNums){
			$lastPageUrl=$this->subPage_link.$this->pageNums.$this->urlparam;//2007-9-7
			$nextPageUrl=$this->subPage_link.($this->current_page+1).$this->urlparam;//2007-9-7
			$subPageCss2Str.="&nbsp;&nbsp;<a href='$nextPageUrl'>下一页</a> ";
			$subPageCss2Str.="<a href='$lastPageUrl'>尾页</a> ";
		}else {
			$subPageCss2Str.="&nbsp;&nbsp;下一页 ";
			$subPageCss2Str.="尾页 ";
		}
		return  $subPageCss2Str;
	}
	/**
	 * 用于ajax分页
	 */
	function subPageCss3(){
		$subPageCss2Str="共".$this->nums."条记录&nbsp;每页显示".$this->each_disNums."条&nbsp;";
		$subPageCss2Str.="当前第".$this->current_page."/".$this->pageNums."页 ";


		if($this->current_page > 1){
			$firstPageUrl=$this->subPage_link."1".$this->urlparam;//2007-9-7
			$prewPageUrl=$this->subPage_link.($this->current_page-1).$this->urlparam;//2007-9-7
			//echo $this->urlparam;
			$subPageCss2Str.="<a href='###' onclick='ajaxpage(\"$firstPageUrl\")'>首页</a> ";
			$subPageCss2Str.="<a href='###' onclick='ajaxpage(\"$prewPageUrl\")'>上一页</a> ";
		}else {
			$subPageCss2Str.="首页 ";
			$subPageCss2Str.="上一页 ";
		}

		$a=$this->construct_num_Page();
		for($i=0;$i<count($a);$i++){
			$s=$a[$i];
			if($s == $this->current_page ){
				$subPageCss2Str.="&nbsp;<span style='margin:0px 0px 0px 0px;padding:0px 5px 0px 5px;border:1px solid #DEDEB8;color:red;font-weight:bold;background:#FFFFD9;'>".$s."</span>";
			}else{
				$url=$this->subPage_link.$s.$this->urlparam;//2007-9-7
				$subPageCss2Str.="&nbsp;<a href='###' onclick='ajaxpage(\"$url\")'><span style='margin:0px 0px 0px 0px;padding:0px 5px 0px 5px;border:1px solid #DEDEB8;'>".$s."</span></a>";
			}
		}

		if($this->current_page < $this->pageNums){
			$lastPageUrl=$this->subPage_link.$this->pageNums.$this->urlparam;//2007-9-7
			$nextPageUrl=$this->subPage_link.($this->current_page+1).$this->urlparam;//2007-9-7
			$subPageCss2Str.="&nbsp;&nbsp;<a href='###' onclick='ajaxpage(\"$nextPageUrl\")'>下一页</a> ";
			$subPageCss2Str.="<a href='###' onclick='ajaxpage(\"$lastPageUrl\")'>尾页</a> ";
		}else {
			$subPageCss2Str.="&nbsp;&nbsp;下一页 ";
			$subPageCss2Str.="尾页 ";
		}
		$nextPage=(($this->current_page+1)<$this->pageNums)?$this->current_page+1:$this->pageNums;
		$subPageCss2Str.="&nbsp;&nbsp;跳转到第<input type='text' name='pager_num' id='pager_num' value='$nextPage' style='border:0px;border-bottom:1px solid #ccc;width:32px;' />页 <input type='button' name='bt_pager' id='bt_pager' value='跳转' onclick=\"ajaxpage('$this->subPage_link'+((isNaN(parseInt($('#pager_num').val())) || (parseInt($('#pager_num').val())>$this->pageNums))?1:parseInt($('#pager_num').val()))+'$this->urlparam')\" /> ";
		return  $subPageCss2Str;
	}
          
          function subPageCss4(){
            $subPageCss2Str = '';
            if($this->current_page > 1)
             {
                $prewPageUrl=$this->subPage_link.($this->current_page-1).$this->urlparam;
                $subPageCss2Str.="<a href='$prewPageUrl'>上一页</a> ";
            }
            else
            {
                $subPageCss2Str.="上一页 ";
            }
            if($this->current_page < $this->pageNums)
             {
                $nextPageUrl=$this->subPage_link.($this->current_page+1).$this->urlparam;//2007-9-7
                $subPageCss2Str.="&nbsp;&nbsp;<a href='$prewPageUrl'>下一页</a> ";
             }
             else
             {
                 $subPageCss2Str.="&nbsp;&nbsp;下一页 ";
             }
             return  $subPageCss2Str;
        }
}
?>