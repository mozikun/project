<?php 
  class dictionary_dictionaryController extends controller{
  	    public function init(){
  	    	//用户认证与权限
			require_once(__SITEROOT.'library/privilege.php');
  	    	require_once (__SITEROOT.'library/Models/standard_code.php');
  	    }
  	    /**
  	     * 列表显示数据类型属性
  	     * @return unknown_type
  	     */
  	    public function indexAction(){
  	    	require_once __SITEROOT."/library/custom/pager.php";
  	    	//处理参数
  	        $arrName = $this->_request->getParam('arrname');
  	    	$zhName  = $this->_request->getParam('zhname');
  	    	$str = $arrName.'|'.$zhName;
  	    	$dicCount = new Tstandard_code();
  	    	$arrArg = explode('|',$str);
  	        if($arrName){
  	    	$dicCount->whereAdd("category like '$arrName%'");
  	    	}
  	    	if($zhName){
  	    	$dicCount->whereAdd("category_name like '%$zhName%'");
  	    	}
  	    	$numCount = $dicCount->count('distinct category');
  	    	$pageCurrent = intval($this->_request->getParam('page'));
			$pageCurrent = $pageCurrent?$pageCurrent:1;
			//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
			$links = new SubPages(__ROWSOFPAGE,$numCount,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'dictionary/dictionary/index/page/',3,$arrArg);
			$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
			$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
  	    	$this->view->basePath = $this->_request->getBasePath();
  	    	$this->view->assign('basePath',__BASEPATH);
  	    	$dictionaryNu =  new Tstandard_code();
  	    	$nuNumber = $dictionaryNu->count();
  	    	$dictionary = new Tstandard_code();
  	    	//$dictionary->debugLevel(9);
  	    	$dictionary->selectAdd("distinct category as category");
  	    	if($arrName){
  	    	$dictionary->whereAdd("category like '$arrName%'");
  	    	}
  	    	if($zhName){
  	    	$dictionary->whereAdd("category_name like '%$zhName%'");
  	    	}
  	    	$dictionary->orderby("category ASC");
  	    	$dictionary->limit($startnum,__ROWSOFPAGE);
  	    	$dictionary->find();
  	    	$dicArr = array();
  	    	$dicArrCount = 0;
  	    	while($dictionary->fetch()){
  	    		$condition = $dictionary->category;
  	    		$dicName = new Tstandard_code();
  	    		//$dicName->debugLevel(9);
  	    		$dicName->whereAdd("category='$condition'");
  	    		//$dicName->limit(0,1);
  	    		$dicName->find(true);
  	    		$dicArr[$dicArrCount]['category_name'] = $dicName->category_name;
  	    		$dicArr[$dicArrCount]['category']      = $dictionary->category;
  	    		$dicArr[$dicArrCount]['inner_order']   = $dicName->inner_order;
  	    		$dicArr[$dicArrCount]['status']        = $dicName->status;
  	    		$dicArr[$dicArrCount]['scode_name']    = urlencode($dicName->category_name);
  	    		$dicArrCount++;
  	    	}
  	    	$page = $links->subPageCss2();
  	    	$this->view->page   = $page;
  	    	$this->view->dicArr = $dicArr;
  	    	$this->view->nuNumber = $numCount;
  	    	$this->view->display('index.html');
  	    }
  	    /**
  	     * 添加数据类型属性
  	     * @return unknown_type
  	     */
  	    public function addAction(){
  	    	require_once (__SITEROOT.'application/dictionary/models/createFile.php');
  	    	$this->view->basePath = $this->_request->getBasePath();
  	    	$this->view->assign('basePath',__BASEPATH);
  	    	$getData      = $this->_request->getParam('scode');
  	    	$currentname  = $this->_request->getParam('currentname');//获取表单中的一个标识
  	    	$arrName      = $this->_request->getParam('arrname');//用于判断是添加还是删除
  	    	$category     = $this->_request->getParam('category');//分类名
  	    	$categoryName = $this->_request->getParam('category_name');//分类中文名
  	    	$status       = $this->_request->getParam('status');//使用状态
  	    	$statusAdd    = 'checked="checked"';
  	    	$this->view->statusAdd = $statusAdd;
  	    	$this->view->arrname = $arrName;
  	    	if(empty($arrName)){
  	    	if($this->_request->getParam('ok')){
  	    	$arrCount = count($getData);
  	    	//判断当前是不是输入相应的编码
  	    	if($arrCount==1){
  	    		echo '<script type="text/javascript">window.alert("您还没有输入相应的编码！");history.go(-1);</script>';
  	    	}else{
  	    	$dictionary = new Tstandard_code();
  	    	$userString = '';
  	    	for($a=0;$a<ceil($arrCount/3);$a++){
  	    		//添加数据
      		   $dictionary->category      = $category; //分类英文名
      		   $dictionary->category_name = $categoryName;//分类中文名
      		   $dictionary->inner_order   = uniqid(); //唯一标识符号
               $dictionary->id            = $getData[$a*3];  //内部码
               $dictionary->standard_code = $getData[$a*3+1];//国家标准
               $dictionary->c_name        = $getData[$a*3+2];//中文含义
               $dictionary->my_order      = intval($a+1);//自定义顺序
               $dictionary->status        = $status;//使用状态
               $userString.="'".$getData[$a*3]."'=>array('".$getData[$a*3+1]."','".$getData[$a*3+2]."'),";
               $dictionary->insert($this->user['uuid']);  	
               }
             createLone('data_arr',$category,$userString); 
             createFolder('library/data_arr');
  	    	 createAllFile('data_arr','arrdata.php','library/data_arr');
  	    	 $this->redirect(__BASEPATH.'dictionary/dictionary/index');
  	    	}
  	    	}
  	    	}else{
                //编辑数据
                $tagName                 = 'readonly="readonly"';
                $zhName                  = urldecode($this->_request->getParam('zhname'));
                $editGetArr              = $this->_request->getParam('editcode');
                $addGetArr               = $this->_request->getParam('scode');
                $editCategory            = $this->_request->getParam('category');
                $editCategoryName        = $this->_request->getParam('category_name');
                $statusnow               = $this->_request->getParam('statusnow');
                $status                  = $this->_request->getParam('status');
                if($statusnow=="s"){
                	$statusTag = '';
                }else{
                	$statusTag = 'checked="checked"';
                }
                $this->view->statusTag   = $statusTag;
                $this->view->editArrName = $arrName;
                $this->view->zhName      = $zhName;
                $this->view->tagName     = $tagName;
                //取出当前arrname中的所有数据
                $editData = new Tstandard_code();
                $editData->whereAdd("category='$arrName'");
                $editData->orderby("to_number(id) ASC");
                $editData->find(); 
                $currentCount = 0;
                $editArr = array();
                while($editData->fetch()){
                	$editArr[$currentCount]['id']            = $editData->id;
                	$editArr[$currentCount]['category']      = $editData->category;
                	$editArr[$currentCount]['standard_code'] = $editData->standard_code;
                	$editArr[$currentCount]['c_name']        = $editData->c_name;
                	$editArr[$currentCount]['inner_order']   = $editData->inner_order;
                	$editArr[$currentCount]['category_name'] = urlencode($editData->category_name);
                	$currentCount++;
                  }
                $this->view->editArr = $editArr;
                if($this->_request->getParam('ok')){
                	//编辑数据库中的数据
                	$editCount  = count($editGetArr);
                	for($i=0;$i<ceil($editCount/4);$i++){
                		//有待考证
                		 $editName  = 'editUpdate'.$i;
                		 $$editName = new Tstandard_code();
                		 $editId    = $editGetArr[$i*4+3];
                		 //$$editName->debugLevel(9);
                		 $$editName->whereAdd("inner_order='$editId'");
                		 $$editName->id            = $editGetArr[$i*4];
                		 $$editName->standard_code = $editGetArr[$i*4+1];
                		 $$editName->c_name        = $editGetArr[$i*4+2];
                		 $$editName->category_name = $editCategoryName;
                		 $$editName->status        = $status;
                		 $$editName->update(array($this->user['uuid'])); 
                	}
                	//新增数据
                	$newAddData = count($addGetArr);
                    //处理传递过来的值
                	if($newAddData==1){
                		$countNow = 0;
                	}else{
                		$countNow = count($addGetArr);
                	}
                	//获取数据库中当前最大的顺序号
                	$selMyOrder = new Tstandard_code();
                	//$selMyOrder->debugLevel(9);
                    $selMyOrder->whereAdd("category='$editCategory'");
                    $selMyOrder->orderby("my_order DESC");
                    $selMyOrder->limit(0,1);
                    $selMyOrder->find(true);
                    $maxOrder    = $selMyOrder->my_order;
                    $newMaxOrder = intval($maxOrder+1);
                	$newAdd = new Tstandard_code();
                    for($j=0;$j<ceil($countNow/3);$j++){
                       //插入新增数据
                    	$newAdd->category       = $editCategory;
                    	$newAdd->category_name  = $editCategoryName;  
                    	$newAdd->id             = $addGetArr[$j*3];
                    	$newAdd->standard_code  = $addGetArr[$j*3+1];
                    	$newAdd->c_name         = $addGetArr[$j*3+2];
                    	$newAdd->my_order       = $newMaxOrder;
                    	$newAdd->inner_order    = uniqid();
                    	$newAdd->insert();
                     }
                     //重新写文件,取出当前数组名的所有数据
                     $newFile = new Tstandard_code();
                     $newFile->whereAdd("category='$editCategory'");
                     $newFile->orderby("to_number(id) ASC");
                     $newFile->find();
                     $rWriteStr = '';
                     while($newFile->fetch()){
                     	$rWriteStr.= "'".$newFile->id."'=>array('".$newFile->standard_code."','".$newFile->c_name."'),";
                     }
                     //写入文件
                     if($status=='s'){
                        editFile('data_arr',$editCategory,$rWriteStr);
                     }else{
                     	@unlink('data_arr/'.$editCategory.'.php');
                     }
                     createFolder('library/data_arr');
                     createAllFile('data_arr','arrdata.php','library/data_arr');
		  	    	 $this->redirect(__BASEPATH.'dictionary/dictionary/add/arrname/'.$editCategory.'/statusnow/'.$status.'/zhname/'.urlencode($zhName));
                }   
               }
  	    	$this->view->display('add.html');
  	    }
  	    function delAction(){
  	    	require_once (__SITEROOT.'application/dictionary/models/createFile.php');
  	    	$delId   = $this->_request->getParam('delid');
  	    	$delName = $this->_request->getParam('delname');
  	    	$zhName = urldecode($this->_request->getParam('zhname'));
  	        //echo $delName;
  	    	if($delId&&$delName){
	  	        //还存在记录的情形
  	    		$dictionary = new Tstandard_code();
  	    		$dictionary->whereAdd("inner_order='$delId'");
  	    		$dictionary->delete($this->user['uuid']);
  	    		//重新写文件,取出当前数组名的所有数据
                $newFile = new Tstandard_code();
                $newFile->whereAdd("category='$delName'");
                $newFile->orderby("id ASC");
                $newFile->find();
                $rWriteStr = '';
                while($newFile->fetch()){
                 $rWriteStr.= "'".$newFile->id."'=>array('".$newFile->standard_code."','".$newFile->c_name."'),";
                 }
                 //写入文件
	            editFile('data_arr',$delName,$rWriteStr);
	  	    	createAllFile('data_arr','arrdata.php','library/data_arr');
	  	        //判断数据库中是不是还有记录,如果没有则删除对应的文件，再重新生成文件
	  	    	$delData = new Tstandard_code();
	  	    	$delData->whereAdd("category='$delName'");
	  	    	if($delData->count()==0){
	  	    	@unlink('data_arr/'.$delName.'.php');
	  	    	createAllFile('data_arr','arrdata.php','library/data_arr');
	  	    	$this->redirect(__BASEPATH.'dictionary/dictionary/index');
	  	    	}else{
	  	    	$this->redirect(__BASEPATH.'dictionary/dictionary/add/arrname/'.$delName.'/zhname/'.urlencode($zhName));	
	  	    	}
  	    	}
  	    }
  	   /**
  	    * 生成所有的文件
  	    */ 
  	    public function createallAction(){
  	    	require_once (__SITEROOT.'application/dictionary/models/createFile.php');
  	    	//先找出有哪些不同的数据字典的分类
  	    	$standerCode = new Tstandard_code();
  	    	$standerCode->selectAdd("distinct category as category");
  	    	$standerCode->find();
  	    	while($standerCode->fetch()){
  	    	   $standar = new  Tstandard_code();
  	    	   $standar->whereAdd("category='$standerCode->category'");
  	    	   $standar->whereAdd("status='s'");//只创建正在使用的数组
  	    	   $standar->orderby("to_number(id) ASC");
  	    	   $standar->find();
  	    	   $realStr = '';
  	    	   while($standar->fetch()){
  	    	   	  //拼凑要组成的数组内容
  	    	   	  $realStr.="'".$standar->id."'=>array('".$standar->standard_code."','".$standar->c_name."'),";
  	    	   }
  	    	   $strResult = rtrim($realStr,',');
  	    	   createallLone('data_arr',$standerCode->category,$strResult); 
  	    	   createFolder('library/data_arr');
               createAllFile('data_arr','arrdata.php','library/data_arr');
               $this->redirect(__BASEPATH.'dictionary/dictionary/index');
  	    	}
  	    }
  }
?>