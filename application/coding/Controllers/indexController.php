<?php
  /**
   * 用于编码 设置属性
   */
  class coding_indexController extends controller 
  {
  	public function init()
  	{
  		require_once __SITEROOT.'library/privilege.php';
  		require_once __SITEROOT.'library/Models/coding_category.php';
  		require_once __SITEROOT.'library/Models/medicine.php';
  		require_once __SITEROOT.'library/custom/pager.php';
  		$this->view->basePath   =  __BASEPATH;
  	}
  	/**
  	 * 编码编码、属性列表
  	 *0=>分类,1=>分类属性
  	 */
  	public function indexAction()
  	{
  		//表中没有数据的时候进行添加一个根节点
  		$coding_category = new Tcoding_category();
  		if($coding_category->count()<1)
  		{
  			$coding_category->code_id        = '1';
  			$coding_category->p_id           = '0';
  			$coding_category->uuid           = uniqid('code_',true);
  			$coding_category->code_path      = '1';
  			$coding_category->code_name      = '全部分类';
  			$coding_category->flag_tag       = '0';
  			$coding_category->code_level     = '1';
  			$coding_category->standard_code  = '1';
  			//$coding_category->debuglevel(9);
  			$coding_category->insert();
  		}
  		$coding_category->free_statement();
  		//对数据进行列表条件
  		$id = $this->_request->getParam('id'); 		
  		$tag_val = $this->_request->getParam('flag_tag');
  		$flag_tag = empty($tag_val)?0:$tag_val; 		
  		$real_id = empty($id)?1:$id;//第一次进来的时候该ID是没有值的
  		$this->view->current_id = $real_id;
  		$coding_now = new Tcoding_category();
  		$coding_now->whereAdd("code_id='$real_id'");
  		$coding_now->find(true);
  		$region_path = explode(',',$coding_now->code_path);
  		$zh_name = '';
  		$mylink = '';
  		$mylink_array = '';
  		foreach ($region_path as $k=>$v)
  		{
  			$lone_code = new Tcoding_category();
  			$lone_code->whereAdd("code_id='$v'");
  			$lone_code->find(true);
  			$current_flag = $lone_code->flag_tag;
  			//echo $current_flag;
  			$direction ='';
  			if($v==$real_id)
  			{
                if($flag_tag)
  				{
  					$direction ='属性列表';
  					$link_val  = 1;
  				}
  				else
  				{
  					$link_val  = 0;
  				}
  				$mylink='<a href="'.__BASEPATH.'coding/index/index/id/'.$v.'/flag_tag/'.$link_val.'"><font color="red"><strong>'.$lone_code->code_name.$direction.'</strong></font></a>';
  			}
  			else
  			{
  				$mylink='<a href="'.__BASEPATH.'coding/index/index/id/'.$v.'/flag_tag/0"><strong>'.$lone_code->code_name.'</strong></a>->';
  			}
  			$mylink_array.=	$mylink.',';
  		}
  		$view_array = explode(',',$mylink_array);
  		$this->view->view_array = $view_array;
  		//对数据进行列表  原则上是显示分类 不选择属性
  		$listcoding = new Tcoding_category();
  		$listcoding->whereAdd("p_id='$real_id'");
  		$listcoding->whereAdd("flag_tag='$flag_tag'");
  		$listcoding->whereAdd("p_id<>0");
  		$numNumber = $listcoding->count();
  		$currentPage = intval($this->_request->getParam('page'));
		$realPage    = empty($currentPage)?1:$currentPage;
		//获取总的记录数
		$arrArg = array('id'=>$real_id,'flag_tag'=>$flag_tag);
		$links = new SubPages(__ROWSOFPAGE,$numNumber,$realPage,__goodsListRowOfPage,__BASEPATH.'coding/index/index/page/',3,$arrArg);
		$pageCurrent = $links->check_page($realPage);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$listcoding->orderby("standard_code ASC");
		$listcoding->limit($startnum,__ROWSOFPAGE);
		$listcoding->find();
		$count = 0;
		$row   = array();
		while ($listcoding->fetch())
		{
			$row[$count]['code_name']     = $listcoding->code_name;
			$row[$count]['standard_code'] = $listcoding->standard_code;
			$row[$count]['code_id']       = $listcoding->code_id;
			$row[$count]['flag_tag']      = $listcoding->flag_tag;
			$count++;
		}
		$this->view->page  = $links->subPageCss2();
		$this->view->mypage= $realPage;
		$this->view->row   = $row;
		$this->view->tag_val = $tag_val;
  		$this->view->display('listcoding.html');
  	}
  	/**
  	 * 编码、属性的添加
  	 */
  	public function addAction()
  	{
  		//获取分类或者属性标示
  		$falg_tag    = $this->_request->getParam('flag_tag');
  		$category_id = $this->_request->getParam('id');//要添加的父ID
  		$coding_code = $this->_request->getParam('coding_code');//编码代码
  		$coding_name = $this->_request->getParam('coding_name');//编码名称
  		$ok          = $this->_request->getParam('ok');
  		$mypage      = $this->_request->getParam('mypage');
  		if($ok)
  		{
	  		//查找数据表中最大ID
	  		$category = new Tcoding_category();
	  		$category->orderby("code_id DESC");
	  		$category->limit(0,1);
	  		$category->find(true);
	  		//查找上一级的region
	  		$path = new Tcoding_category();
	  		$path->whereAdd("code_id='$category_id'");
	  		$path->find(true);
	  		$last_path = $path->code_path;
	  		echo $last_path;
	  		$add_category = new Tcoding_category();
	  		$max_id =  $category->code_id;//最大ID
	  		if(isset($category_id))
	  		{
	  			$new_id     = intval($max_id)+1;//新的id编号
	  			$code_path  = $last_path.','.$new_id;//新的编码路径
	  			$add_category->code_id         =   $new_id;
	  			//echo $code_path;
		  		if(!in_array('1',explode(',',$code_path)))
		  		{
		  			exit('路径参数有误');
		  		}
	  			$add_category->p_id            =   $category_id;
	  		} 
	  		$add_category->uuid            =   uniqid('code_',true);  		
	  		$add_category->code_name       =   $coding_name;
	  		$add_category->standard_code   =   $coding_code;
	  		if($falg_tag)
	  		{
	  			//添加属性
	  			$add_category->flag_tag  =  1;
	  			$add_category->code_path       =  '0000';
	  			$add_category->code_level      =  '-1';
	  			$this->redirect(__BASEPATH.'coding/index/index/id/'.$category_id.'/flag_tag/1');
	  		}
	  		else
	  		{
	  			//添加分类
	  			$add_category->flag_tag  =  '0';
	  			$add_category->code_path       =   $code_path;
	  			$code_level = count(explode(',',$code_path));//写入级次
	  			$add_category->code_level      =   $code_level-1;
	  			$this->redirect(__BASEPATH.'coding/index/index/id/'.$category_id.'/flag_tag/0');
	  		}
	  		$add_category->insert();
	  		
  		}
  	}
  	/**
  	 * 编辑分类
  	 */
  	public function editAction()
  	{
  		$flag_tag      = $this->_request->getParam('flag_tag');
  		$id            = $this->_request->getParam('id');
  		$mypage        = $this->_request->getParam('mypage');
  		$coding_code   = $this->_request->getParam('coding_code');
  		$coding_name   = $this->_request->getParam('coding_name');
  		//获取上级ID
  		$last_category = new Tcoding_category();
  		$last_category->whereAdd("code_id='$id'");
  		$last_category->find(true);
  		$p_id = $last_category->p_id;
  		//更新
  		$edit_coding = new Tcoding_category();
  		$edit_coding->whereAdd("code_id='$id'");
  		$edit_coding->code_name     = $coding_name;
  		$edit_coding->standard_code = $coding_code;
  		$edit_coding->flag_tag      = $flag_tag;
  		if(@$this->_request->getParam('ok'))
  		{
  		 $edit_coding->update();
  		}
  		$edit_coding->free_statement();
  		$this->redirect(__BASEPATH.'coding/index/index/id/'.$p_id.'/page/'.$mypage.'/flag_tag/'.$flag_tag);
  	}
  	/**
  	 * ajax用于编辑
  	 * 结果
  	 */
  	public function ajaxAction()
  	{
  		$id = $this->_request->getParam('id');
  		if(isset($id))
  		{
  			$coding_category = new Tcoding_category();
  			$coding_category->whereAdd("code_id='$id'");
  			$coding_category->find(true);
  			$str = '';
  			if($coding_category->flag_tag)
  			{
  				$str.='<ul><li>属性编号：<input type="text" name="coding_code" value="'.$coding_category->standard_code.'" /></li><li>属性名称：<input type="text" name="coding_name" value="'.$coding_category->code_name.'" /></li><li><input type="submit" name="ok" value="修改" /></li></ul>';
  			}
  			else
  			{
  				$str.='<ul><li>编码编号：<input type="text" name="coding_code" value="'.$coding_category->standard_code.'" /></li><li>编码名称：<input type="text" name="coding_name" value="'.$coding_category->code_name.'" /></li><li><input type="submit" name="ok" value="修改" /></li></ul>';
  			}
  			echo $str;
  		}
  	}
  	/**
  	 * ajax
  	 * 下拉框生成
  	 */
  	public function dropmenuAction()
  	{
  		$category_id  =  $this->_request->getParam('ajax_category_id');//获取当前编辑分类的上级ID
     	$input_id     =  $this->_request->getParam('input_id');//获取表单中的隐藏域id号
     	$container_id =  $this->_request->getParam('container_id');//表单中ajax结果所要放置的地方 	
     	if($category_id&&$input_id&&$container_id)
     	{
     		//获取当前分类的path
	     	$category = new Tcoding_category();
	     	$category->whereAdd("code_id='$category_id'");
	     	$category->find(true);
	     	$path = $category->code_path;
	     	//将path字符串转化为数组进行循环形成下拉
	     	$path_array = explode(',',$path);
	     	//var_dump($path_array);
	     	$count_path_number = count($path_array)-1;
	     	$selectdown = '';
	     	$selectdown.= "<select onclick='oldValue=this.value' onchange='change_org(\"".$input_id."\",\"".$container_id."\",this.value,\"".__BASEPATH."\")' disabled=\"disabled\">";
	     	$selectdown.= '<option  value="0">全部分类</option>';
	     	$selectdown.= '</select>';
	     	foreach ($path_array as $k=>$v)
	     	{
	     		//查找当前path值中的
	     		$lone_category = new Tcoding_category();
	     		$lone_category->whereAdd("p_id='$v'");
	     		$lone_category->whereAdd("p_id<>0");
	     		$lone_category->whereAdd("code_path<>'0000'");
	     		$lone_category->find(); 
	     		//查找$v的path 对于前边的父级分类不希望让其进行操作
	     		$compare_path = new Tcoding_category();
	     		$compare_path->whereAdd("code_id='$v'");
	     		$compare_path->find(true);
	     		$lone_compare_path_array = explode(',',$compare_path->code_path);		
	     		if(count($lone_compare_path_array)<$count_path_number)
	     		{
	     		    $selectdown.= "<select onclick='oldValue=this.value' onchange='change_org(\"".$input_id."\",\"".$container_id."\",this.value,\"".__BASEPATH."\")' disabled=\"disabled\">";
	     		}
	     		else
	     		{
	     			$selectdown.= "<select onclick='oldValue=this.value' onchange='change_org(\"".$input_id."\",\"".$container_id."\",this.value,\"".__BASEPATH."\")'>";
	     		}
	     		$compare_path->free();
	     		$selectdown.='<option value="-9|'.$v.'" >请选择...</option>';
	     		while($lone_category->fetch())
	     		{
	     			//注意这里需要限定
	     			if(in_array($lone_category->code_id,$path_array))
	     			{
	     		        $selectdown.='<option value="'.$lone_category->code_id.'" selected="selected">'.$lone_category->code_name.'</option>';
	     			}
	     			else
	     			{
	     				$selectdown.='<option value="'.$lone_category->code_id.'" >'.$lone_category->code_name.'</option>';
	     			}
	     		}
	     		$selectdown.='</select>';
	     	}
	     	echo $selectdown;
     	}
  	}
  	/**
  	 * 删除分类
  	 */
  	public function delAction()
  	{
  		$uuid = $this->_request->getParam('current_id');
  		if(!empty($uuid))
  		{
  			$coding_category = new Tcoding_category();
  			$coding_category->whereAdd("code_id='$uuid'");
  			$coding_category->find(true);
  			$path = $coding_category->code_path;
  			//取得所有这种path的类别
  			$all_category = new Tcoding_category();
  			$all_category->whereAdd("code_path like '$path%'");
  			if($all_category->count()>1)
  			{
  				echo '<script type="text/javascript">alert("当前分类下还有其他分类，不能删除!");history.go(-1);</script>';
 				exit();
  			}
  			else 
  			{
  				$medicine = new Tmedicine();
  				$medicine->whereAdd("category_code='$coding_category->code_id'");
  				if($medicine->count()>0)
  				{
  					echo '<script type="text/javascript">alert("当前分类下已经有药品数据了，不能删除!");history.go(-1);</script>';
 				    exit();
  				}
  				else 
  				{
  					$medicine->delete();
 					$this->redirect(__BASEPATH.'coding/index/index/id/'.$coding_category->p_id);
  				}	
  			}
  		}
  	}
  }
?>