<?php
/**
 * 药品规格管理
 *
 */
  class coding_specificationController extends controller 
  {
  	public function init()
  	{
  		require_once __SITEROOT.'library/privilege.php';
  		require_once __SITEROOT.'library/Models/specification.php'; 
  		require_once __SITEROOT.'library/custom/pager.php';
  		$this->view->basePath   =  __BASEPATH;
  	}
  	/**
  	 * 药品剂型列表
  	 */
  	public function indexAction()
  	{
  		$specification = new Tspecification();
  		$numNumber = $specification->count();
  		$currentPage = intval($this->_request->getParam('page'));
		$realPage    = empty($currentPage)?1:$currentPage;
		//获取总的记录数
		$arrArg = array();
		$links = new SubPages(__ROWSOFPAGE,$numNumber,$realPage,__goodsListRowOfPage,__BASEPATH.'coding/specification/index/page/',3,$arrArg);
		$pageCurrent = $links->check_page($realPage);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$specification->limit($startnum,__ROWSOFPAGE);
		$specification->find();
		$specification_array = array();
		$specification_count = 0;
		while ($specification->fetch())
		{
			$specification_array[$specification_count]['uuid'] = $specification->uuid;
			$specification_array[$specification_count]['specification_name'] = $specification->specification_name;
			$specification_array[$specification_count]['specification_code'] = $specification->specification_code;
			$specification_count++;
		}
		$this->view->specification_array = $specification_array;
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->display('index.html');
  	}
  	/**
  	 * 添加或者编辑
  	 */
  	public function addAction()
  	{
  		require_once __SITEROOT.'library/pinyin/pinyin.php';
  		$page = $this->_request->getParam('page');
  		$id = $this->_request->getParam('id');
  		$specification_name = $this->_request->getParam('specification_name');
  		$specification_code = $this->_request->getParam('specification_code');
  		if($id)
  		{
  			$add_tag = false;
  			//编辑
  			$specification_lone = new Tspecification();
  			$specification_lone->whereAdd("uuid='$id'");
  			$specification_lone->find(true);
  			$this->view->specification_name = $specification_lone->specification_name;
  			$this->view->specification_code = $specification_lone->specification_code;
  			$specification_lone->free_statement();
  			//重新写入表
  			if($this->_request->getParam('ok'))
  			{
  				$update_specification = new Tspecification();
  				$update_specification->whereAdd("uuid='$id'");
  				$update_specification->specification_code = $specification_code;
  				$update_specification->specification_name = $specification_name;
  				$update_specification->specification_en   = @getPinyin($specification_name);
  				if($update_specification->update())
  				{
  					$this->redirect(__BASEPATH.'coding/specification/index/page/'.$page);
  				}
  			}
  		}
  		else 
  		{
  			//添加
  			$add_tag = true;
  			if($this->_request->getParam('ok'))
  			{
	  			$specification = new Tspecification();
	  			$specification->specification_name = $specification_name;
	  			$specification->specification_code = $specification_code;
	  			$specification->uuid = uniqid('m_',true);
	  			$specification->specification_en = @getPinyin($specification_name);
	  			//var_dump($specification);
	  			if($specification->insert())
	  			{
	  				$this->redirect(__BASEPATH.'coding/specification/index');
	  			}
  			}
  		}
  		$this->view->add_tag = $add_tag;
  		$this->view->display('add.html');
  	}
  }
?>