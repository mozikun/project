<?php
/**
 * 疾病编码
 *
 */
   class coding_diseasenameController extends controller 
   {
   	 public function init()
   	 {
   	 	require_once __SITEROOT.'library/privilege.php';
   	 	require_once __SITEROOT.'library/Models/disease_category.php';
   	 	require_once __SITEROOT.'library/Models/disease_name.php';
   	 	$this->view->basePath = __BASEPATH;
   	 }
   	 public function indexAction()
   	 {
   	 	require_once __SITEROOT.'library/custom/pager.php';
   	 	$disease_name = new Tdisease_name();
   	 	$number = $disease_name->count();
   	 	$currentpage = intval($this->_request->getParam('page'));
		$realpage    = empty($currentpage)?1:$currentpage;
		$search = array();
		$links = new SubPages(__ROWSOFPAGE,$number,$realpage,__goodsListRowOfPage,__BASEPATH.'coding/diseasename/index/page/',3,$search);
		$pageCurrent = $links->check_page($realpage);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$disease_name->limit($startnum,__ROWSOFPAGE);
		$disease_name->find();
		$i = 0 ;
		$row =  array();
		while ($disease_name->fetch())
		{
			$row[$i]['standard_code'] = $disease_name->d_standard_code;
			$row[$i]['zh_name'] = $disease_name->d_zh_name;
			$row[$i]['uuid'] = $disease_name->uuid;
			$disease_category = new Tdisease_category();
			$disease_category->whereAdd("uuid='$disease_name->category_id'");
			$disease_category->find(true);
			$row[$i]['category_name'] = $disease_category->zh_name;
			$disease_category->free_statement();
			$i++;
		}
		$this->view->row = $row;
		$this->view->page = $links->subPageCss2();
		$this->view->currentpage = $currentpage;
   	 	$this->view->display("list.html");
   	 }
   	 public function addAction()
   	 {
   	 	//编码字符连接符数组
   	 	$str_array = array('.'=>'点号连接','xx'=>'其他连接');
   	 	$uuid = $this->_request->getParam('uuid');
   	 	$standard_code = $this->_request->getParam('d_standard_code');
   	 	$disease_category_uuid = $this->_request->getParam('disease_category');
   	 	$zh_name = $this->_request->getParam('d_zh_name');
   	 	$ok = $this->_request->getParam('ok');
   	 	$page = $this->_request->getParam('page');
   	 	$str = $this->_request->getParam('str');//编码链接字符串
   	 	$this->view->str_array = $str_array;
   	 	if(empty($uuid))
   	 	{
   	 		$add_tag = 1;
   	 		if(!empty($ok))
   	 		{
   	 			$disease_name = new Tdisease_name();
   	 			$disease_name->uuid = uniqid('dis_',true);
   	 			$disease_name->d_zh_name = $zh_name;
   	 			$disease_name->d_standard_code = $standard_code;
   	 			$disease_name->category_id = $disease_category_uuid;
   	 			$disease_name->insert();
   	 			$this->redirect(__BASEPATH.'coding/diseasename/index');
   	 		}
   	 	}
   	 	else 
   	 	{
   	 		$add_tag = 0;
   	 		$disease_edit = new Tdisease_name();
   	 		$disease_edit->whereAdd("uuid='$uuid'");
   	 		$disease_edit->find(true);
   	 		$category_id = $disease_edit->category_id;
   	 		$disease_category =  new Tdisease_category();
   	 		$disease_category->whereAdd("uuid='$category_id'");
   	 		$disease_category->find(true);
   	 		$this->view->zh_name = $disease_category->zh_name;//取得分类id
   	 		$this->view->category_id = $category_id;
   	 		$category_code_edit = $disease_category->standard_code;
   	 		//取得编码中的连接符
   	 		$result = '';
   	 		if(strpos($disease_edit->d_standard_code,'xx')!==false)
   	 		{
   	 			$result = 'xx';
   	 		}
   	 		if(strpos($disease_edit->d_standard_code,'.')!==false)
   	 		{
   	 			$result = '.';
   	 		}
   	 		if(!empty($result))
   	 		{
   	 			$this->view->result = $result;
   	 		}
            $this->view->d_standard_code = $disease_edit->d_standard_code;
            $this->view->d_zh_name = $disease_edit->d_zh_name;
   	 		if(!empty($ok))
   	 		{
   	 			$disease = new Tdisease_name();
   	 			$disease->whereAdd("uuid='$uuid'");
   	 			$disease->d_standard_code = $standard_code;
   	 			$disease->d_zh_name = $zh_name;
   	 			$disease->category_id = $disease_category_uuid;
   	 			$disease->update();
   	 			$this->redirect(__BASEPATH.'coding/diseasename/index/page/'.$page);
   	 		}
   	 	}
   	 	$this->view->add_tag = $add_tag;
   	 	$this->view->display("add.html");
   	 }
   	 
   	 
   	 public function getresultAction()
   	 {
   	 	$uuid = $this->_request->getParam('uuid');
   	 	$category = new Tdisease_category();
   	 	$category->whereAdd("uuid='$uuid'");
   	 	$category->find(true);
   	 	echo $category->standard_code;
   	 }
   	 
   	 public function delAction()
   	 {
   	 	$uuid = $this->_request->getParam("uuid");
   	 	if(!empty($uuid))
   	 	{
   	 		$disease_name = new Tdisease_name();
   	 		$disease_name->whereAdd("uuid='$uuid'");
   	 		$disease_name->delete();
   	 		$this->redirect(__BASEPATH.'coding/diseasename/index');
   	 	}
   	 }
   }
?>