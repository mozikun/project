<?php
/**
 * 疾病分类编码
 *
 */
   class coding_diseaseController extends controller 
   {
   	 public function init()
   	 {
   	 	require_once __SITEROOT.'library/privilege.php';
   	 	require_once __SITEROOT.'library/Models/disease_category.php';
   	 	$this->view->basePath = __BASEPATH;
   	 }
   	 public function indexAction()
   	 {
   	 	require_once __SITEROOT.'library/custom/pager.php';
   	 	$disease_category = new Tdisease_category();
   	 	$number = $disease_category->count();
   	 	$currentpage = intval($this->_request->getParam('page'));
		$realpage    = empty($currentpage)?1:$currentpage;
		$search = array();
		$links = new SubPages(__ROWSOFPAGE,$number,$realpage,__goodsListRowOfPage,__BASEPATH.'coding/disease/index/page/',3,$search);
		$pageCurrent = $links->check_page($realpage);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$disease_category->limit($startnum,__ROWSOFPAGE);
		$disease_category->find();
		$i = 0 ;
		$row =  array();
		while ($disease_category->fetch())
		{
			$row[$i]['standard_code'] = $disease_category->standard_code;
			$row[$i]['zh_name'] = $disease_category->zh_name;
			$row[$i]['uuid'] = $disease_category->uuid;
			$i++;
		}
		$this->view->row = $row;
		$this->view->page = $links->subPageCss2();
		$this->view->currentpage = $currentpage;
   	 	$this->view->display("list.html");
   	 }
   	 public function addAction()
   	 {
   	 	require_once __SITEROOT.'/library/pinyin/pinyin.php';
   	 	$uuid = $this->_request->getParam('uuid');
   	 	$standard_code = $this->_request->getParam('standard_code');
   	 	$zh_name = $this->_request->getParam('zh_name');
   	 	$ok = $this->_request->getParam('ok');
   	 	$page = $this->_request->getParam('page');
   	 	if(empty($uuid))
   	 	{
   	 		$add_tag = 1;
   	 		if(!empty($ok))
   	 		{
   	 			$disease_add = new Tdisease_category();
   	 			$disease_add->uuid = uniqid('d_',true);
   	 			$disease_add->standard_code = $standard_code;
   	 			$disease_add->zh_name = $zh_name;
   	 			$disease_add->insert();
   	 			$this->redirect(__BASEPATH.'coding/disease/index');
   	 		}
   	 	}
   	 	else 
   	 	{
   	 		$add_tag = 0;
   	 		$disease_edit = new Tdisease_category();
   	 		$disease_edit->whereAdd("uuid='$uuid'");
   	 		$disease_edit->find(true);
   	 		$this->view->standard_code = $disease_edit->standard_code;
   	 		$this->view->zh_name = $disease_edit->zh_name;
   	 		if(!empty($ok))
   	 		{
   	 			$disease = new Tdisease_category();
   	 			$disease->whereAdd("uuid='$uuid'");
   	 			$disease->standard_code = $standard_code;
   	 			$disease->zh_name = $zh_name;
   	 			$disease->update();
   	 			$this->redirect(__BASEPATH.'coding/disease/index/page/'.$page);
   	 		}
   	 	}
   	 	//取得所有的数据生成新的js
   	 	$category_str = '';
   	 	$writestr = '';
   	 	$pinyin = new Tdisease_category();
   	 	$pinyin->find();
   	 	$count = 0;
   	 	while ($pinyin->fetch())
   	 	{
   	 		$category_str.='disease_Array'."[".$count."]=new Array('".$pinyin->uuid."','".$pinyin->zh_name."','".getPinyin($pinyin->zh_name)."','$pinyin->standard_code');\r\n";
   	 		$count++;
   	 	}
   	 	$writestr.= "var disease_Array=new Array();\r\n".$category_str;
   	 	$handel = fopen(__SITEROOT.'views/js/disease_category.js','w+');
   	 	fwrite($handel,$writestr);
    	fclose($handel);
   	 	$this->view->add_tag = $add_tag;
   	 	$this->view->display("add.html");
   	 }
   	 /**
   	  * 删除
   	  *
   	  */
   	 public  function delAction()
   	 {
   	 	require_once __SITEROOT.'library/Models/disease_name.php';
   	 	$uuid = $this->_request->getParam('uuid');
   	 	if(!empty($uuid))
   	 	{
   	 		$disease_name = new Tdisease_name();
   	 		$disease_name->whereAdd("category_id='$uuid'");
   	 		$number = $disease_name->count();
   	 		if($number>0)
   	 		{
   	 			echo '<script type="text/javascript">alert("该分类下边还有其他数据，不能删除");history.go(-1);</script>';
   	 			//$this->redirect(__BASEPATH."coding/disease/index");
   	 		}
   	 		else 
   	 		{
   	 			$disease_category =  new Tdisease_category();
   	 			$disease_category->whereAdd("uuid='$uuid'");
   	 			$disease_category->delete();
   	 			$this->redirect(__BASEPATH."coding/disease/index");
   	 		}
   	 	}
   	 }
   }
?>