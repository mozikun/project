<?php
/**
*@author：我好笨
*@filename: indexController.php
*@package：用于档案完整率的卫生局管理部分
*@email：4049054@qq.com
*@create：2010-9-26
*/
class rate_indexController extends controller
{
	/**
	 * 等同于构造函数
	 */
	public function init()
	{
		$this->haveWritePrivilege='';
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT."library/Models/organization.php";
		require_once __SITEROOT."library/Models/standard_archive_rate.php";
		require_once(__SITEROOT.'library/MyAuth.php');
		require_once __SITEROOT."library/Models/region.php";
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->assign("baseUrl",__BASEPATH);
		$this->view->assign( "basePath", __BASEPATH );
	}
	public function indexAction()
	{
		require_once __SITEROOT."/library/custom/pager.php";
		$search=array();
		//取搜索值
		$search_cols_zh_name=$this->_request->getParam('search_cols_zh_name','');
		$search_model_zh_name=$this->_request->getParam('search_model_zh_name','');
		$region_path=$this->_request->getParam('path','');
		//遍历地级市
		$regions=new Tregion();
		$regions->whereAdd("region_level='4'");
		$regions->whereAdd("region_path like '".$this->user['current_region_path']."%'");
		$regions->find();
		$i=0;
		while ($regions->fetch())
		{
			$region[$i]['path']=$regions->region_path;
			$region[$i]['name']=$regions->zh_name;
			$i++;
		}
		if ($region_path=="")
		{
			$region_path=$region[0]['path'];
		}
		$search['path']=$region_path;
		
		//取所有模块中文名
		$standard_archive_rate=new Tstandard_archive_rate();
		$standard_archive_rate->whereAdd("region_path='$region_path'");
		$standard_archive_rate->selectAdd("module_name as module_name,module_zh_name as module_zh_name");
		$standard_archive_rate->groupBy("module_name,module_zh_name");
		$standard_archive_rate->find();
		$module_search=array();
		$i=0;
		while ($standard_archive_rate->fetch())
		{
			$module_search[$i]['module_zh_name']=$standard_archive_rate->module_zh_name;
			$module_search[$i]['module_name']=$standard_archive_rate->module_name;
			$i++;
		}
		$this->view->assign("search",$module_search);
		
		$standard_archive_rate=new Tstandard_archive_rate();
		$standard_archive_rate->whereAdd("region_path='$region_path'");
		if($search_cols_zh_name)
		{
			$standard_archive_rate->whereAdd("column_zh_name like '$search_cols_zh_name%'");
			$search['search_cols_zh_name']=$search_cols_zh_name;
		}
		if($search_model_zh_name)
		{
			$standard_archive_rate->whereAdd("module_name='$search_model_zh_name'");
			$search['search_model_zh_name']=$search_model_zh_name;
		}
		$nums=$standard_archive_rate->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'rate/index/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$standard_archive_rate->limit($startnum,__ROWSOFPAGE);
		$standard_archive_rate->find();
		$rate=array();
		$i=0;
		while ($standard_archive_rate->fetch())
		{
			$rate[$i]['uuid']=$standard_archive_rate->uuid;
			$rate[$i]['table_name']=$standard_archive_rate->table_name;
			$rate[$i]['table_zh_name']=$standard_archive_rate->table_zh_name;
			$rate[$i]['module_name']=$standard_archive_rate->module_name;
			$rate[$i]['module_zh_name']=$standard_archive_rate->module_zh_name;
			$rate[$i]['column_name']=$standard_archive_rate->column_name;
			$rate[$i]['column_zh_name']=$standard_archive_rate->column_zh_name;
			$rate[$i]['criteria']=$standard_archive_rate->criteria;
			$i++;
		}
		$out = $links->subPageCss2();
		$this->view->assign("page",$pageCurrent);
		$this->view->assign("pager",$out);
		$this->view->assign("rate",$rate);
		$this->view->assign("region_path",$region_path);
		$this->view->assign("region",$region);
		$this->view->assign("search_array",$search);
		$this->view->display("index.html");
	}
	/**
	 * 卫生局只能修改是否必填
	 */
	public function editAction()
	{
		$region_path=$this->user['current_region_path'];
		if ($region_path)
		{
			$uuid_array=$this->_request->getParam('uuid','');
			if (is_empty_for_multi($uuid_array))
			{
				$url=array("字段列表"=>__BASEPATH.'rate/index/index');
				message("更新失败，未选择更新的项目",$url);
			}
			else 
			{
				//更新字段
				$i=0;
				foreach ($uuid_array as $k=>$v)
				{
					$criteria=$this->_request->getParam('criteria_'.str_replace(".","_",$v),'0');
					//$module_zh_name=$this->_request->getParam('module_zh_name_'.str_replace(".","_",$v),'');
					//$column_zh_name=$this->_request->getParam('column_zh_name_'.str_replace(".","_",$v),'');
					$standard_archive_rate=new Tstandard_archive_rate();
					$standard_archive_rate->whereAdd("region_path like '$region_path%'");
					$standard_archive_rate->whereAdd("uuid='$v'");
					$standard_archive_rate->criteria=$criteria;
//					if ($module_zh_name)
//					{
//						$standard_archive_rate->module_zh_name=$module_zh_name;
//					}
//					if($column_zh_name)
//					{
//						$standard_archive_rate->column_zh_name=$column_zh_name;
//					}
					$standard_archive_rate->update();
					$i++;
				}
				$url=array("字段列表"=>__BASEPATH.'rate/index/index');
				message("修改信息成功",$url);
			}
		}
		else 
		{
			$url=array("字段列表"=>__BASEPATH.'rate/index/index');
			message("修改失败，错误原因可能是你登陆已经失效，请重新登录以解决问题",$url);
		}
	}
}
?>