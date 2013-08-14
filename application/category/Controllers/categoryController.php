<?php
   class category_categoryController extends controller {
   	    public function init(){
   	        require_once(__SITEROOT.'library/Models/MENU.php');	
   	        //echo __SITEROOT;
   	    }
   	    public function indexAction(){
   	      //获取当前数据表如果没有任何数据就首先创建一个根节点
   	    	$category = new Tmenu();
   	        $nuNumber = $category->count();
   	       // echo $nu_number;
   	        if($nuNumber=='0'){
   	        	$id = '1';
   	        	$category->id = $id;
   	        	$category->parent_id = $id;
   	        	$category->path = $id;
   	        	$category->description = '这是根';
   	        	$category->uuid = $id;
   	        	$category->insert();
   	        }else{
   	        	//否则就列表显示除根目录外的第一级目录
   	            $this->redirect('listcategory');
   	        }
   	    }
   	    public function listcategoryAction(){
   	    	//获取需要添加类别的当前父ID
            $parentId = $this->_request->getParam('parent_id');
            $addNeedId = empty($parentId)?1:$parentId;
   	         //列表显示父ID等于1但是ID不等于1的所有数据(不显示根)
  	        $this->view->basePath = $this->_request->getBasePath();
            $menuClass = new Tmenu();
            $menuClass->whereAdd("id<>1");
            $menuClass->whereAdd("parent_id='$addNeedId' order by id ASC");
            $menuClass->find();
            $row = array();
            $rowCount = 0;
            while($menuClass->fetch()){
            	$row[$rowCount]['id'] = $menuClass->id;
            	$row[$rowCount]['description'] = $menuClass->description;
            	$row[$rowCount]['path'] = $menuClass->path;
            	$row[$rowCount]['parent_id'] = $menuClass->parent_id;
            	$rowCount++;
            }
            $this->view->assign('row',$row);
            $this->view->assign('add_need_id',$addNeedId);
            $this->view->assign('rootpath',__BASEPATH);
            //获取所有path
            $pathSel = new Tmenu();
            $pathSel->whereAdd("id='$addNeedId'");
           // $pathSel->debugLevel(9);
            $pathSel->find(true);
            $currentPath = $pathSel->path;
            $realPath = explode(',',$currentPath);
            $realCount = count($realPath);
            $rs = array();
            $rsCount = 0 ;
           foreach ($realPath as $k=>$v){
            	$realMenu = new Tmenu();
            	$realMenu->whereAdd("id='$v'");
            	$realMenu->find(true);
            	$rs[$rsCount]['description'] = $realMenu->description;
            	$rs[$rsCount]['id'] = $realMenu->id;
            	$rsCount++;
            }
           // var_dump($rs);
            $this->view->assign('rs',$rs);
            //获取当前表中所有栏目内容(除去根)
            $selAll = new Tmenu();
            $selAll->whereAdd("id<>1");
            $selAll->find();
            $selAllArr = array();
            $selAllCount = 0;
            while($selAll->fetch()){
            	$selAllArr[$selAllCount]['description'] = $selAll->description;
            	$selAllArr[$selAllCount]['parent_id']   = $selAll->parent_id;
            	$selAllArr[$selAllCount]['id']   = $selAll->id;
            	$selAllCount++;
            }
            $this->view->assign('selAllArr',$selAllArr);
            $this->view->display('listcategory.html');
	    }
	    public function addcategoryAction(){
	    	//$this->view->basePath = $this->_request->getBasePath();
	    	//查找数据库中当前最大的ID以便进行添加新的记录
	        $addNeedId = $this->_request->getParam('need_add_id');
	        $menuName = trim($this->_request->getParam('menu_name'));
	        $menu = new Tmenu();
	        $menu->orderby('id DESC');
	        $menu->limit(0,1);
	        $menu->find(true);
	       // echo $menu->id;
	        $menuNewid =intval($menu->id+1);
	        //echo $menuNewid;
	        //取出当前id需要添加类别的PATH
	        $menu->whereAdd("id='$addNeedId'");
	        $menu->find(true);
	        //echo $menu_newid;
	        $newPath = $menu->path.','.$menuNewid;
	        if($this->_request->getParam('ok')){
	        if(!empty($menuName)){
	        $menu->id = $menuNewid;
	        $menu->uuid = $menuNewid;
	        $menu->description = $menuName;
	        $menu->parent_id = $addNeedId;
	        $menu->path = $newPath;
	       // $menu->debugLevel(9);
	        $menu->insert();
	        $this->redirect(__BASEPATH.'category/category/listcategory/parent_id/'.$addNeedId);
	        }else{
	        	echo '<script type="text/javascript">window.alert("请输入您的栏目名称");history.go(-1);</script>';
	        }
	        }
	        //$this->view->display('add_category.html');
	    }
	    public function delcategoryAction(){
	    	$currentId = $this->_request->getParam('current_id');
	    	$delMenu = new Tmenu();
	    	$delMenu->whereAdd("id='$currentId'");
	    	$delMenu->find(true);
	    	$parentId = $delMenu->parent_id;
	    	$oldPath  = $delMenu->path;
	    	$realDel  = new Tmenu();
	    	$realDel->debugLevel(9);
	    	$realDel->whereAdd("path like '$oldPath%'");
	    	$delMenuCount = $realDel->count();
	    	if($delMenuCount>1){
	    		echo '<script type="text/javascript">window.alert("该栏目下已经有子类，不能删除！");window.location.href("'.__BASEPATH.'category/category/listcategory/parent_id/'.$parentId.'");</script>';	
	    	}else{
	    		$categoryId = new Tmenu();
	    		$categoryId->whereAdd("id='$currentId'");
	    		$categoryId->delete();
	    		echo '<script type="text/javascript">window.alert("删除成功！");window.location.href("'.__BASEPATH.'category/category/listcategory/parent_id/'.$parentId.'");</script>';	
	    	}
	    }
	  public function editcategoryAction(){
	  	   $getNewId = $this->_request->getParam('current_id');
	  	   $menuNameEdit = $this->_request->getParam('menu_name_edit');
	  	   $lastName  = $this->_request->getParam('last_name');
	  	   $ok2  = $this->_request->getParam('ok2');
	  	   //echo $getNewId;
	  	   //echo $menuNameEdit;
	  	   if($ok2){
	  	   	 if(!empty($menuNameEdit)){
	  	   	 	 	//获取path中含有$lastName的所有path(处理要移动节点的)
	  	   	 	 	if(!empty($lastName)){
	  	   	 	   //当path需要改变的时候
	  	   	 	 	$editMenu = new Tmenu();
	  	   	 	 	$editMenu->whereAdd("id='$getNewId'");
	  	   	 	 	$editMenu->find(true);
	  	   	 	    $oldParentId = $editMenu->parent_id;
	  	   	 	    $oldPath = $editMenu->path;
	  	   	 	    $currentMenu = new Tmenu();
	  	   	 	    $currentMenu->whereAdd("id='$lastName'");
	  	   	 	    $currentMenu->find(true);
	  	   	 	    $currentPath = $currentMenu->path;
	  	   	 	    /**
	  	   	 	     * 如'1,2,3'与'1,2,3'   返回int(0);
	  	   	 	     * 或者'1,2,3,4'与'1,2,3'  返回int(0);
	  	   	 	     */
	  	   	 	    $pos = strpos($currentPath,$oldPath);
                     //不将自身或者自己的子类移动
  	   	 	      if($pos===false){
	  	   	 	    	$newPath = $currentPath.','.$getNewId;
	  	   	 	    	$updateMenu = new Tmenu();
	  	   	 	    	$updateMenu->whereAdd("id='$getNewId'");
	  	   	 	    	$updateMenu->parent_id = $lastName;
	  	   	 	    	$updateMenu->path  = $newPath;
	  	   	 	    	$updateMenu->description  = $menuNameEdit;
	  	   	 	    	$updateMenu->update();
	  	   	 	    	//$this->redirect(__BASEPATH.'category/category/listcategory/parent_id/'.$lastName);
	  	   	 	    	$realNewMenu = new Tmenu();
	  	   	 	    	$realNewMenu->whereAdd("id='$getNewId'");
	  	   	 	    	$realNewMenu->find(true);
	  	   	 	    	$realNowPath = $realNewMenu->path;
	  	   	 	    	//当数据库中的path改变时改变所有的关联path
	  	   	 	    	if($oldPath!=$realNowPath){
//	  	   	 	    		echo $oldPath.'</br>';
//	  	   	 	    		echo $realNowPath.'</br>';
	  	   	 	    		$currentRealMenu = new Tmenu();
	  	   	 	    		$currentRealMenu->whereAdd("id<>'$getNewId'");//本身不处理
	  	   	 	    		$currentRealMenu->whereAdd("path like '$oldPath%'");
	  	   	 	    		$currentRealMenu->find();
	  	   	 	    		while ($currentRealMenu->fetch()){
	  	   	 	    		   	$changePath = new Tmenu();
	  	   	 	    		   	$changePath->whereAdd("id='$currentRealMenu->id'");
	  	   	 	    		   	$changePath->find();
	  	   	 	    		   	$changePath->fetch(true);
	  	   	 	    		   	echo $oldPath.'</br>';
	  	   	 	    		   	echo $currentRealMenu->path.'</br>';
	  	   	 	    		   	echo $currentPath.'</br>';
	  	   	 	    		   	$changePath->path = $currentPath.','.$getNewId.','.substr($changePath->path,strlen($oldPath)+1);
	  	   	 	    		   	//$changePath->description = $menuNameEdit;
	  	   	 	    		   	echo $changePath->path;
	  	   	 	    		   	$changePath->update();
	  	   	 	    		}
	  	   	 	    	}
	  	   	 	    $this->redirect(__BASEPATH.'category/category/listcategory/parent_id/'.$lastName);
	  	   	 	    }else{
	  	   	 	    	echo '<script type="text/javascript">window.alert("不能将自身或者自己的子类移动到该节点下边！");history.go(-1);</script>';
	  	   	 	    }  	   	 	     	 	 	
	  	   	 	 }else{
	  	   	 	 	//当前处理一级栏目先找他的父ID（为了跳转）
	  	   	 	 	$lonelyMenu = new Tmenu();
	  	   	 	 	$lonelyMenu->whereAdd("id='$getNewId'");
	  	   	 	 	$lonelyMenu->find(true);
	  	   	 	 	$currentParentid = $lonelyMenu->parent_id;
	  	   	 	 	//更新一级栏目名称
	  	   	 	 	$loneMneu = new Tmenu();
	  	   	 	 	$loneMneu->whereAdd("id='$getNewId'");
	  	   	 	 	$loneMneu->description = $menuNameEdit;
	  	   	 	 	$loneMneu->update();
	  	   	 	 	$this->redirect(__BASEPATH.'category/category/listcategory/parent_id/'.$currentParentid);
	  	   	 	 }	
	  	     }
	  	   }
	  }
   }