<?php
/**
*@author：我好笨
*@filename: indexController.php
*@package：用于档案完整率的系统管理部分
*@email：4049054@qq.com
*@create：2010-9-26
*/
class rate_manageController extends controller
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
	/**
	 * 列出地区
	 */
	public function indexAction()
	{
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
		$this->view->assign("region_path",$region_path);
		$this->view->assign("region",$region);
		$this->view->display("index.html");
	}
	/**
	 * 用于更新表结构
	 * 自动从数据库中读取表并写入到standard_archive_rate表中，如果更新了表或者增加了表要控制的话
	 * 需要运行一次本动作，本动作不覆盖之前的记录，如果需要确定哪些表属于哪些模块，需要手动修改
	 */
	public function createlistAction()
	{
		set_time_limit(0);
		error_reporting(0);
		$region=array();
		$region_path=$this->_request->getParam('path','');//用于增加单个地级市的时候使用
		if (@count(@explode(",",$this->user['current_region_path']))>=4 && $region_path=='')
		{
			$url=array("初始化首页"=>__BASEPATH.'rate/manage/index');
			message("初始化数据表字段失败，你没有权限初始化所有地区的信息",$url);
		}
		if (isset($region_path) && $region_path!="")
		{
			$region[0]=$region_path;
		}
		else 
		{
			//遍历地级市
			$regions=new Tregion();
			$regions->whereAdd("region_level='4'");
			$regions->find();
			while ($regions->fetch())
			{
				$region[]=$regions->region_path;
			}
		}
		require(__SITEROOT.'config/oracleConfig.php');
		$link=oci_connect($databaseConfig['user'], $databaseConfig['password'],$databaseConfig['host'],$databaseConfig['charset']) or exit("数据连接错误");
		//所有表名,类型,表备注
		$sql="SELECT TABLE_NAME,COMMENTS FROM USER_TAB_COMMENTS";
		$statement =oci_parse($link,$sql);
		oci_execute($statement);
		//需要排除的字典
		$comm=array("uuid","org_id","staff_id","id","created","updated","deleted","status_flag","syn_flag","org_id_1");
		//需要排除的表
		$comm_table=array("LOGIN_LOG","LOGS","TEST","STUDENT","TEACHER","SCORE1","SCORE2","STANDARD_CODE","STANDARD_ARCHIVE_RATE","REGION","REGION_EXT_1",
		"ORG_EXT_1","ORG_EXT_2","ORG_EXT_3","ORG_EXT_4","ORG_EXT_5","ORG_EXT_6","ORGANIZATION","MENU","RESOURCES","ROLE_RESOURCE","ROLE_TABLE");
		while ($table = oci_fetch_array ($statement,OCI_ASSOC) ) 
		{
			if (!in_array($table['TABLE_NAME'],$comm_table))
			{
				//取每个表的所有字段进行比较
				$cols_sql="SELECT
				    A.COLUMN_NAME COLUN_NAME,B.COMMENTS COMMENTS
				FROM
				    USER_TAB_COLUMNS A,USER_COL_COMMENTS B
				WHERE
				    A.TABLE_NAME = B.TABLE_NAME
				    AND A.COLUMN_NAME = B.COLUMN_NAME
				    AND A.TABLE_NAME = '".$table['TABLE_NAME']."'";
				$cols_stat =oci_parse($link,$cols_sql);
				oci_execute($cols_stat);
				while ($row=oci_fetch_array ($cols_stat,OCI_ASSOC))
				{
					if (!empty($region) && $region[0]!='')
					{
						//根据区域数组来生成数据
						foreach ($region as $k=>$v)
						{
							$standard_archive_rate=new Tstandard_archive_rate();
							$standard_archive_rate->whereAdd("column_name='".$row['COLUN_NAME']."'");
							$temp=@explode("|",$row['COMMENTS']);
							$row['COMMENTS']=$temp[0];
							$standard_archive_rate->find(true);
							if ($standard_archive_rate->uuid)
							{
								$uuid=$standard_archive_rate->uuid;
								//存在，则更新注释
								$standard_archive_rate=new Tstandard_archive_rate();
								$standard_archive_rate->table_name=strtolower($table['TABLE_NAME']);
								$standard_archive_rate->table_zh_name=$table['COMMENTS'];
								$standard_archive_rate->column_zh_name=$row['COMMENTS'];
								$standard_archive_rate->whereAdd("uuid='$uuid'");
								$standard_archive_rate->update();
							}
							else 
							{
								//去掉常用字段
								if(!in_array(strtolower($row['COLUN_NAME']),$comm))
								{
									//写入字段值
									$standard_archive_rate=new Tstandard_archive_rate();
									$standard_archive_rate->uuid=uniqid("r_",true);
									$standard_archive_rate->region_path=$v;
									$standard_archive_rate->table_name=strtolower($table['TABLE_NAME']);
									$standard_archive_rate->table_zh_name=$table['COMMENTS'];
									$standard_archive_rate->column_name=strtolower($row['COLUN_NAME']);
									$standard_archive_rate->column_zh_name=$row['COMMENTS'];
									$standard_archive_rate->criteria=0;
									$standard_archive_rate->insert();
								}
							}
						}
					}
				}	
			}
		}
		//提示生成完成
		$url=array("初始化首页"=>__BASEPATH.'rate/manage/index');
		message("初始化数据表字段完成",$url);
	}
	/**
	 * 列表页
	 */
	public function listAction()
	{
		require_once __SITEROOT."/library/custom/pager.php";
		$search=array();
		//取搜索值
		$search_cols_zh_name=$this->_request->getParam('search_cols_zh_name','');
		$search_model_zh_name=$this->_request->getParam('search_model_zh_name','');
		$search_table_name=$this->_request->getParam('search_table_name','');
		$search_table_zh_name=$this->_request->getParam('search_table_zh_name','');
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
		if($search_table_name)
		{
			$standard_archive_rate->whereAdd("table_name like '$search_table_name%'");
			$search['search_table_name']=$search_table_name;
		}
		if($search_table_zh_name)
		{
			$standard_archive_rate->whereAdd("table_zh_name like '$search_table_zh_name%'");
			$search['search_table_zh_name']=$search_table_zh_name;
		}
		$nums=$standard_archive_rate->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'rate/manage/list/page/',2,$search);
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
		$this->view->assign("search_array",$search);
		$this->view->assign("region_path",$region_path);
		$this->view->assign("region",$region);
		$this->view->display("edit.html");
	}
	/**
	 * 系统管理员可修改所有信息
	 */
	public function editAction()
	{
		$region_path=$this->user['current_region_path'];
		if ($region_path)
		{
			$uuid_array=$this->_request->getParam('uuid','');
			if (is_empty_for_multi($uuid_array))
			{
				$url=array("字段列表"=>__BASEPATH.'rate/manage/list');
				message("更新失败，未选择更新的项目",$url);
			}
			else 
			{
				//更新字段
				$i=0;
				foreach ($uuid_array as $k=>$v)
				{
					$criteria=$this->_request->getParam('criteria_'.str_replace(".","_",$v),'0');
					$module_zh_name=$this->_request->getParam('module_zh_name_'.str_replace(".","_",$v),'');
					$column_zh_name=$this->_request->getParam('column_zh_name_'.str_replace(".","_",$v),'');
					$table_name=$this->_request->getParam('table_name_'.str_replace(".","_",$v),'');
					$table_zh_name=$this->_request->getParam('table_zh_name_'.str_replace(".","_",$v),'');
					$module_name=$this->_request->getParam('module_name_'.str_replace(".","_",$v),'');
					
					//因为一张表里的字段一般只属于一个模块，所以根据表名刷新模块名和模块
					$standard_archive_rate=new Tstandard_archive_rate();
					$standard_archive_rate->whereAdd("region_path like '$region_path%'");
					$standard_archive_rate->whereAdd("table_name='$table_name'");
					if ($module_name)
					{
						$standard_archive_rate->module_name=$module_name;
					}
					if ($module_zh_name)
					{
						$standard_archive_rate->module_zh_name=$module_zh_name;
					}
					if ($table_zh_name)
					{
						$standard_archive_rate->table_zh_name=$table_zh_name;
					}
					$standard_archive_rate->update();
					//更新内容
					$standard_archive_rate=new Tstandard_archive_rate();
					$standard_archive_rate->whereAdd("region_path like '$region_path%'");
					$standard_archive_rate->whereAdd("uuid='$v'");
					$standard_archive_rate->criteria=$criteria;
					if ($module_zh_name)
					{
						$standard_archive_rate->module_zh_name=$module_zh_name;
					}
					if($column_zh_name)
					{
						$standard_archive_rate->column_zh_name=$column_zh_name;
					}
					if ($table_zh_name)
					{
						$standard_archive_rate->table_zh_name=$table_zh_name;
					}
					if ($module_name)
					{
						$standard_archive_rate->module_name=$module_name;
					}
					$standard_archive_rate->update();					
					$i++;
				}
                //生成模块必填字段缓存
                $standard_archive_rate=new Tstandard_archive_rate();
        		//取本模块的所有必填字段数组
        		$standard_archive_rate->whereAdd("region_path like '$region_path%'");
        		$standard_archive_rate->whereAdd("criteria='1'");
        		$standard_archive_rate->find();
        		$rate=array();
        		while ($standard_archive_rate->fetch())
        		{
        			$rate[$standard_archive_rate->region_path][$standard_archive_rate->module_name][$standard_archive_rate->table_name][$standard_archive_rate->column_name]=$standard_archive_rate->column_zh_name;
        		}
                $cache_tmp="<?php\n
						//author:我好笨\n
						//time:".@date('Y-m-d H:i:s',time())."\n
						//本文件是一个完整率缓存文件.\n
						\$rate=";
                $cache_tmp.=var_export($rate,1);
                $cache_tmp.=";\n\n?>";
                $e=fopen(__SITEROOT."cache/standard_archive_rate_cache.php","wb");
                fputs($e,$cache_tmp);
                fclose($e);
                unset($e);
				$url=array("字段列表"=>__BASEPATH.'rate/manage/list');
				message("修改信息成功",$url);
			}
		}
		else 
		{
			$url=array("字段列表"=>__BASEPATH.'rate/manage/list');
			message("修改失败，错误原因可能是你登陆已经失效，请重新登录以解决问题",$url);
		}
	}
	/**
	 * 删除
	 */
	public function delAction()
	{
		$uuid=$this->_request->getParam('uuid','');
		if ($uuid)
		{
			$standard_archive_rate=new Tstandard_archive_rate();
			$standard_archive_rate->whereAdd("uuid='$uuid'");
			if ($standard_archive_rate->delete())
			{
				echo "ok";
				exit;
			}
			else 
			{
				echo "failed";
				exit;
			}
		}
		else 
		{
			echo "failed";
			exit;
		}
	}
}