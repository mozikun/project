<?php
/**
 * 耗材单位管理
 *
 */
  class coding_conmeasureController extends controller 
  {
  	public function init()
  	{
  		require_once __SITEROOT.'library/privilege.php';
  		require_once __SITEROOT.'library/Models/con_measures.php';
  		require_once __SITEROOT.'library/custom/pager.php';
  		$this->view->basePath   =  __BASEPATH;
  	}
  	/**
  	 * 药品单位列表
  	 */
  	public function indexAction()
  	{
  		$measures = new Tcon_measures();
  		$numNumber = $measures->count();
  		$currentPage = intval($this->_request->getParam('page'));
		$realPage    = empty($currentPage)?1:$currentPage;
		//获取总的记录数
		$arrArg = array();
		$links = new SubPages(__ROWSOFPAGE,$numNumber,$realPage,__goodsListRowOfPage,__BASEPATH.'coding/conmeasure/index/page/',3,$arrArg);
		$pageCurrent = $links->check_page($realPage);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$measures->limit($startnum,__ROWSOFPAGE);
		$measures->find();
		$measures_array = array();
		$measures_count = 0;
		while ($measures->fetch())
		{
			$measures_array[$measures_count]['uuid'] = $measures->uuid;
			$measures_array[$measures_count]['measure_name'] = $measures->measure_name;
			$measures_array[$measures_count]['measure_code'] = $measures->measure_code;
			$measures_count++;
		}
		$this->view->measures_array = $measures_array;
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
  		$measure_name = $this->_request->getParam('measure_name');
  		$measure_code = $this->_request->getParam('measure_code');
  		if($id)
  		{
  			$add_tag = false;
  			//编辑
  			$measure_lone = new Tcon_measures();
  			$measure_lone->whereAdd("uuid='$id'");
  			$measure_lone->find(true);
  			$this->view->measure_name = $measure_lone->measure_name;
  			$this->view->measure_code = $measure_lone->measure_code;
  			$measure_lone->free_statement();
  			//重新写入表
  			if($this->_request->getParam('ok'))
  			{
  				$update_measure = new Tcon_measures();
  				$update_measure->whereAdd("uuid='$id'");
  				$update_measure->measure_code = $measure_code;
  				$update_measure->measure_name = $measure_name;
  				$update_measure->measure_en   = @getPinyin($measure_name);
  				if($update_measure->update())
  				{
  					$this->redirect(__BASEPATH.'coding/conmeasure/index/page/'.$page);
  				}
  			}
  		}
  		else 
  		{
  			//添加
  			$add_tag = true;
  			if($this->_request->getParam('ok'))
  			{
	  			$measure = new Tcon_measures();
	  			$measure->measure_name = $measure_name;
	  			$measure->measure_code = $measure_code;
	  			$measure->uuid = uniqid('m_',true);
	  			$measure->measure_en = @getPinyin($measure_name);
	  			//var_dump($measure);
	  			if($measure->insert())
	  			{
	  				$this->redirect(__BASEPATH.'coding/conmeasure/index');
	  			}
  			}
  		}
  		$this->view->add_tag = $add_tag;
  		$this->view->display('add.html');
  	}
  }
?>