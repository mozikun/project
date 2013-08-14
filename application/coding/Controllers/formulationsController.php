<?php
/**
 * 药品剂型管理
 *
 */
  class coding_formulationsController extends controller 
  {
  	public function init()
  	{
  		require_once __SITEROOT.'library/privilege.php';
  		require_once __SITEROOT.'library/Models/formulations.php'; 
  		require_once __SITEROOT.'library/custom/pager.php';
  		$this->view->basePath   =  __BASEPATH;
  	}
  	/**
  	 * 药品剂型列表
  	 */
  	public function indexAction()
  	{
  		$formulations = new Tformulations();
  		$numNumber = $formulations->count();
  		$currentPage = intval($this->_request->getParam('page'));
		$realPage    = empty($currentPage)?1:$currentPage;
		//获取总的记录数
		$arrArg = array();
		$links = new SubPages(__ROWSOFPAGE,$numNumber,$realPage,__goodsListRowOfPage,__BASEPATH.'coding/formulations/index/page/',3,$arrArg);
		$pageCurrent = $links->check_page($realPage);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$formulations->limit($startnum,__ROWSOFPAGE);
		$formulations->find();
		$formulations_array = array();
		$formulations_count = 0;
		while ($formulations->fetch())
		{
			$formulations_array[$formulations_count]['uuid'] = $formulations->uuid;
			$formulations_array[$formulations_count]['formulations_name'] = $formulations->formulations_name;
			$formulations_array[$formulations_count]['formulations_code'] = $formulations->formulations_code;
			$formulations_count++;
		}
		$this->view->formulations_array = $formulations_array;
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
  		$formulations_name = $this->_request->getParam('formulations_name');
  		$formulations_code = $this->_request->getParam('formulations_code');
  		if($id)
  		{
  			$add_tag = false;
  			//编辑
  			$formulations_lone = new Tformulations();
  			$formulations_lone->whereAdd("uuid='$id'");
  			$formulations_lone->find(true);
  			$this->view->formulations_name = $formulations_lone->formulations_name;
  			$this->view->formulations_code = $formulations_lone->formulations_code;
  			$formulations_lone->free_statement();
  			//重新写入表
  			if($this->_request->getParam('ok'))
  			{
  				$update_formulations = new Tformulations();
  				$update_formulations->whereAdd("uuid='$id'");
  				$update_formulations->formulations_code = $formulations_code;
  				$update_formulations->formulations_name = $formulations_name;
  				$update_formulations->formulations_en   = @getPinyin($formulations_name);
  				if($update_formulations->update())
  				{
  					$this->redirect(__BASEPATH.'coding/formulations/index/page/'.$page);
  				}
  			}
  		}
  		else 
  		{
  			//添加
  			$add_tag = true;
  			if($this->_request->getParam('ok'))
  			{
	  			$formulations = new Tformulations();
	  			$formulations->formulations_name = $formulations_name;
	  			$formulations->formulations_code = $formulations_code;
	  			$formulations->uuid = uniqid('m_',true);
	  			$formulations->formulations_en = @getPinyin($formulations_name);
	  			//var_dump($formulations);
	  			if($formulations->insert())
	  			{
	  				$this->redirect(__BASEPATH.'coding/formulations/index');
	  			}
  			}
  		}
  		$this->view->add_tag = $add_tag;
  		$this->view->display('add.html');
  	}
  }
?>