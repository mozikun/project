<?php
/**
 * @package：用于个人档案刷姓名拼音
 * @copyright :
 * @create:2013-3-11
 */

class tools_refreshController extends controller {
	
	public function init()
	{
		require_once(__SITEROOT."library/Models/individual_core.php");
		$this->view->basePath = $this->_request->getBasePath();
	}
	public function indexAction()
	{
		require_once(__SITEROOT."library/pinyin/pinyin.php");
		//用于刷新多少条
		$limit=100;
		$current=$this->_request->getParam("page");
		$current=$current?$current:0;
		$individual=new Tindividual_core();
//		$individual->whereAdd("org_id=18");//用于查询那个机构的数据
		$num=$individual->count();
		$start_num=$current;
		$individual->limit($start_num,$limit);
		$individual->find();
		while ($individual->fetch())
		{
			$name=$individual->name;
			$namepinyin=getPinyin($name);//把名字转换成拼音
			$uuid=$individual->uuid;
			$individual_core=new Tindividual_core();
			$individual_core->name_pinyin=$namepinyin;	
			$individual_core->whereAdd("uuid='$uuid'");
			$individual_core->update();
			$individual_core->free_statement();
		    
			$current++;
		}
		$individual->free_statement();
		if($num>$start_num)
		{
			echo "每次刷新{$limit}条档案<br />";
			echo "<font color='red'>正在操作，共有".$num."条档案，当前第".$start_num."条档案....！</font>";
			echo "<script>
					var pgo=0;
    
          			function JumpUrl(){
    					
            		if(pgo==0){ location='".$this->_request->getBasePath()."tools/refresh/index/page/{$current}'; pgo=1; }
    
          			}
    
    				setTimeout('JumpUrl()',0);
    
    				</script>";
			
       	    exit;
		}
		else 
		{
		    exit("已完成任务，总共刷新".$num."条档案！");
		}	
	}
}

