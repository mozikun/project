<?php
 /**
  * 诊疗项目
  */
 class coding_clinicController extends controller 
 {
 	public function init()
 	{
 		require_once __SITEROOT.'library/Models/clinic_code.php';
   	 	$this->view->basePath = __BASEPATH;
 	}
 	public function indexAction()
 	{
 		require_once __SITEROOT.'library/custom/pager.php';
 		//当表中没有数据的时候先子新增一条
 		$clinic_code = new Tclinic_code();
 		$all_number = $clinic_code->count();
 		if($all_number<1)
 		{
 			$clinic_code->uuid  = uniqid('c_',true);
 			$clinic_code->zh_name  = '全部分类';
 			$clinic_code->p_id  = '0';
 			$clinic_code->id  = 1;
 			$clinic_code->path  = '1,';
 			$clinic_code->standard_code  = '000000';
 			$clinic_code->insert();
 		}
 		//对数据进行列表条件
 		$p_id = $this->_request->getParam('p_id');
 		$p_id = empty($p_id)?1:$p_id;
 		//顶部导航处理
 		$nav_category = new Tclinic_code();
 		$nav_category->whereAdd("id='$p_id'");
 		$nav_category->find(true);
 		$nav_array = explode(',',$nav_category->path);
 		$max_tag = count($nav_array);
 		unset($nav_array[$max_tag-1]);
 		$navlink = '';
 		foreach ($nav_array as $k=>$v)
 		{
 			$array_clinic_code = new Tclinic_code();
 			$array_clinic_code->whereAdd("id='$v'");
 			$array_clinic_code->find(true);
 			if($p_id==$v)
 			{
 				$navlink.='<a href="'.__BASEPATH.'coding/clinic/index/p_id/'.$v.'"><strong><font color="red">'.$array_clinic_code->zh_name.'</font></strong></a>';
 			}
 			else 
 			{
 				$navlink.='<a href="'.__BASEPATH.'coding/clinic/index/p_id/'.$v.'"><strong>'.$array_clinic_code->zh_name.'</strong></a>->';
 			}
 			$array_clinic_code->free_statement();
 		}
 		$this->view->navlink = $navlink;
 		//开始列表
 		$category = new Tclinic_code();
 		$category->whereAdd("p_id='$p_id'");
 		$number = $category->count();
 		$currentPage = intval($this->_request->getParam('page'));
		$realPage    = empty($currentPage)?1:$currentPage;
		//获取总的记录数
		$search = array('p_id'=>$p_id);
		$links = new SubPages(__ROWSOFPAGE,$number,$realPage,__goodsListRowOfPage,__BASEPATH.'coding/clinic/index/page/',3,$search);
		$pageCurrent = $links->check_page($realPage);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$category->orderby("id ASC");
		$category->limit($startnum,__ROWSOFPAGE);
 		$category->find();
 		$count = 0 ;
 		$row = array();
 		while ($category->fetch())
 		{
 			$row[$count]['zh_name'] = $category->zh_name;
 			$row[$count]['standard_code'] = $category->standard_code;
 			$row[$count]['id'] = $category->id;
 			$row[$count]['p_id'] = $category->p_id;
 			$count++;
 		}
 		$this->view->row = $row;
 		$this->view->mypage = $realPage;
 		$this->view->p_id = $p_id;
 		$this->view->page = $links->subPageCss2();
 		$this->view->display('list.html');
 	}
 	public function addAction()
 	{
 		$id = $this->_request->getParam('id');//编辑的id
 		$p_id = $this->_request->getParam('p_id');//需要在其上进行添加分类的id
 		$standard_code = $this->_request->getParam('standard_code');//分类编码
 		$zh_name = $this->_request->getParam('zh_name');//分类名称
 		$ok = $this->_request->getParam('ok');
 		$edit_id = $this->_request->getParam('edit_id');//编辑的父id
 		if(!empty($p_id))
 		{
 			$add_tag = 1;
 			//构建编码的部分数据
 			if($p_id!='1')
 			{
 				//取得父级的所有编码
 				$p_clinic_code = new Tclinic_code();
 				$p_clinic_code->whereAdd("id='$p_id'");
 				$p_clinic_code->find(true);
 				$p_clinic_code->free_statement();
 				$input_val = $p_clinic_code->standard_code;
 			}
 			else 
 			{
 				$input_val ='';
 			}
 			$this->view->input_val = $input_val;
 			//添加
 			//取得数据表中最大的一个id
 			$max_clinic_code = new Tclinic_code();
 			$max_clinic_code->orderby('id DESC');
 			$max_clinic_code->limit(0,1);
 			$max_clinic_code->find(true);
 			$max_id = $max_clinic_code->id+1;
 			$max_clinic_code->free_statement();
 			//构造新的path
 			$path_clinic_code = new Tclinic_code();
 			$path_clinic_code->whereAdd("id='$p_id'");
 			$path_clinic_code->find(true);
 			$parent_path = $path_clinic_code->path;
 			$path = $parent_path.$max_id.',';
 			//写入
 			$insert_clinic_code =  new Tclinic_code();
 			$insert_clinic_code->uuid = uniqid('c_',true);
 			$insert_clinic_code->id   = $max_id;
 			$insert_clinic_code->p_id  = $p_id;
 			$insert_clinic_code->path  = $path;
 			$insert_clinic_code->zh_name  = $zh_name;
 			$insert_clinic_code->standard_code = $standard_code;
 			if(!empty($ok))
 			{
 				$insert_clinic_code->insert();
 				$this->redirect(__BASEPATH.'coding/clinic/index/p_id/'.$p_id);
 			}
 		}
 		else 
 		{
 			$add_tag = 0;
 			$edit_clinic_code = new Tclinic_code();
 			$edit_clinic_code->whereAdd("id=$id");
 			$edit_clinic_code->find(true);
 			$edit_pid = $edit_clinic_code->p_id;
 			$path = $edit_clinic_code->path;//当前路径
 			$edit_clinic_code->free_statement();
 			$this->view->zh_name = $edit_clinic_code->zh_name;
 			$this->view->standard_code = $edit_clinic_code->standard_code;
 			$this->view->edit_pid = $edit_pid;
 			//取得父类的path
 			$parent = new Tclinic_code();
 			$parent->whereAdd("id='$edit_id'");
 			$parent->find(true);
 			$parent_path = $parent->path;
 			$parent->free_statement();
 			if(!empty($ok))
 			{
 				if(strpos($parent_path,$path)===false)
 				{
 					$change = true;
 				}
 				else 
 				{
 					echo '<script type="text/javascript">alert("不能将当前类移动到本类或者下级分类去!");history.go(-1);</script>';
 					exit();
 				}
 				if($change)
 				{
 					$new_category = new Tclinic_code();
 					$new_category->whereAdd("path like '$path%'");
 					$new_category->path = $parent_path.$id.',';
 					$new_category->update();
 				}
 				$update_category = new Tclinic_code();
 				$update_category->whereAdd("id='$id'");
 				$update_category->zh_name = $zh_name;
 				$update_category->p_id = $edit_id;
 				$update_category->standard_code = $standard_code;
 				$update_category->update();
 				$this->redirect(__BASEPATH.'coding/clinic/index/p_id/'.$edit_id);
 			}
 		   //编辑
 		 //  echo '编辑';
 		}
 		$this->view->add_tag = $add_tag;
 		$this->view->p_id = $p_id;
 		$this->view->quiet_id = empty($p_id)?$edit_pid:$p_id;
 		$this->view->display("add.html");
 	}
 	/**
 	 * 取得分类结果
 	 *
 	 */
 	public  function getresultAction()
 	{
 		$p_id = $this->_request->getParam('p_id');
 		$category = new Tclinic_code();
 		$category->whereAdd("id='$p_id'");
 		$category->find(true);
 		$path = $category->path;
 		$path_array = explode(',',$path);
 	    $count = count($path_array)-1;
 	    unset($path_array[$count]);
 	    //var_dump($path_array);
 	    $count_disabled = count($path_array)-2;
 	    $str='';
 	    $str.='<select disabled="disabled">';
 	    $str.='<option value="">全部分类</option>';
 	    $str.='</select>';
 	    foreach ($path_array as $k=>$v)
 	    {
	    	if($k<$count_disabled)
	    	{
	    		$disabled='disabled="disabled"';
	    	}
	    	else 
	    	{
	    		$disabled='';
	    	}
	 	     $category_lone = new Tclinic_code();
	 	     $category_lone->whereAdd("p_id='$v'");
	 	     $category_lone->find();
	 	     $str.= '<select '.$disabled.' onchange="change_org(\'edit_id\',\'result\',this.value,\''.__BASEPATH.'\');">';
	 	     $str.='<option value="-9|'.$v.'");">请选择...</option>';
	 	     while ($category_lone->fetch())
	 	     {   
	 	     	//echo $v.'============================='.$category_lone->id.'<br />';
	 	     	 if(in_array($category_lone->id,$path_array))
	 	     	 {
	 	     	 	$selected='selected="selected"';
	 	     	 }
	 	     	 else 
	 	     	 {
	 	     	 	$selected='';
	 	     	 } 	 
 	    		 $str.='<option value="'.$category_lone->id.'" '.$selected.'>'.$category_lone->zh_name.'</option>';	 
	 	     }
	 	     $category_lone->free_statement();
	 	     $str.='</select>';
 	    }
 	    
 	    echo $str;
 	}
 	//取得上一级的code
 	public function getcodeAction()
 	{
 		$p_id = $this->_request->getParam('p_id');
 		if(!empty($p_id)&&$p_id!='1')
 		{
 			$clinic_code = new Tclinic_code();
 			$clinic_code->whereAdd("id='$p_id'");
 			$clinic_code->find(true);
 			echo $clinic_code->standard_code;
 		}
 		else 
 		{
 			echo '';
 		}
 	}
 	//删除操作
 	public function delAction()
 	{
 		$uuid = $this->_request->getParam('uuid');
 		$p_id = $this->_request->getParam('p_id');
 		if(!empty($uuid)&&!empty($p_id))
 		{
 			$current_category = new Tclinic_code();
 			$current_category->whereAdd("id='$uuid'");
 			$current_category->find(true);
 			$path = $current_category->path;
 			//取得所有的这种path的看当前下边还有其他分类没有没得就可以删除
 			$all_category = new Tclinic_code();
 			$all_category->whereAdd("path like '$path%'");
 			if($all_category->count()>1)
 			{
 				echo '<script type="text/javascript">alert("当前诊疗项目下还有其他项目，不能删除!");history.go(-1);</script>';
 				exit();
 			}
 			else 
 			{
 				$all_category->delete();
 				$this->redirect(__BASEPATH.'coding/clinic/index/p_id/'.$p_id);
 			}
 		}
 	}
 }
?>