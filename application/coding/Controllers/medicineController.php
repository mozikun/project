<?php
  /**
   * 用于设置药品
   */
  class coding_medicineController extends controller 
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
  	 * 药品列表
  	 *
  	 */
  	public function indexAction()
  	{
  	    $currentPage = intval($this->_request->getParam('page'));
		$realPage    = empty($currentPage)?1:$currentPage;
		$medicine  = new Tmedicine();
		$numNumber = $medicine->count();
		//获取总的记录数
		$arrArg = array();
		$links = new SubPages(__ROWSOFPAGE,$numNumber,$realPage,__goodsListRowOfPage,__BASEPATH.'coding/medicine/index/page/',3,$arrArg);
		$pageCurrent = $links->check_page($realPage);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$medicine->orderby("category_code ASC");
		$medicine->limit($startnum,__ROWSOFPAGE);
		$medicine->find();
		$medicine_array = array();
		$medicine_count = 0;
		while ($medicine->fetch())
		{
		   	$medicine_array[$medicine_count]['uuid'] = $medicine->uuid;
		   	$medicine_array[$medicine_count]['medicine_code'] = $medicine->medicine_code;
		   	$medicine_array[$medicine_count]['medicine_name'] = $medicine->medicine_name;
		   	//取得分类名称
		   	$all_category = new Tcoding_category();
		   	$all_category->whereAdd("code_id='$medicine->category_code'");
		   	$all_category->find(true);
		   	$category_code_path = explode(',',$all_category->code_path);
		   	$category_name = '';
		   	$category_code = '';
		   	foreach ($category_code_path as $k=>$v)
		   	{
		   		$coding_category = new Tcoding_category();
		   		$coding_category->whereAdd("code_id='$v'");
		   		$coding_category->whereAdd("p_id<>0");
		   		$coding_category->find(true);
		   		$category_name.=$coding_category->code_name.'→';
		   		//$category_code.=$coding_category->standard_code;
		   		$coding_category->free_statement();
		   	}
		   	$medicine_array[$medicine_count]['category_name'] = trim($category_name,'→');
		   	//获取通用名分类编码
		   	$medicine_array[$medicine_count]['category_code'] = $medicine->standard_code;
		   	$medicine_count++;
		}
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->medicine_array = $medicine_array;
		$this->view->pageCurrent   = $pageCurrent;
       $this->view->display('index.html');
  	}
  	/**
  	 * 药品的添加或编辑
  	 */
  	public function addAction()
  	{
  		require_once __SITEROOT.'library/pinyin/pinyin.php';
  		$id   = $this->_request->getParam('id');
  		$page = $this->_request->getParam('page');
  		if($id)
  		{
  			//编辑
  			$add_tag = false;
  			$medicine_edit = new Tmedicine();
  			$medicine_edit->whereAdd("uuid='$id'");
  			$medicine_edit->find(true);
  			$medicine_edit->free_statement();
  			$this->view->ajax_category_id = $medicine_edit->category_code;
  			$this->view->medicine_name    = $medicine_edit->medicine_name;
  			$this->view->medicine_code    = $medicine_edit->medicine_code;
  			if($this->_request->getParam('ok'))
  			{
  				$medicine_code = $this->_request->getParam('medicine_code');
  				$ajax_category_id = $this->_request->getParam('ajax_category_id');
  				$medicine_name   =  $this->_request->getParam('medicine_name');
  				if($ajax_category_id==1)
  				{
  					$msg = 'alert("请选择药品通用名类别！")';
  					$this->view->msg = $msg;
  				}
  				else 
  				{
  					//取得分类编码
  					$coding_category_edit = new Tcoding_category();
  					$coding_category_edit->whereAdd("code_id='$ajax_category_id'");
  					$coding_category_edit->find(true);
  					$coding_standard_code = $coding_category_edit->standard_code;
  					//重新写入表
  					$update_medicine = new Tmedicine();
  					$update_medicine->medicine_code = $medicine_code;
  					$update_medicine->category_code = $ajax_category_id;
  					$update_medicine->standard_code = $coding_standard_code.$medicine_code;
  					$update_medicine->medicine_name = $medicine_name;
  					$update_medicine->en_name       = @getPinyin($medicine_name);
  					$update_medicine->whereAdd("uuid='$id'");
  					if($update_medicine->update())
  					{
  						$this->redirect(__BASEPATH.'coding/medicine/index/page/'.$page);
  					}
  				}
  			}
  		}
  		else 
  		{
  			//添加
  			$add_tag = true;
  			if($this->_request->getParam('ok'))
  			{
  				$medicine_code = $this->_request->getParam('medicine_code');
  				$ajax_category_id = $this->_request->getParam('ajax_category_id');
  				$medicine_name   =  $this->_request->getParam('medicine_name');
  				if($ajax_category_id==1)
  				{
  					$msg = 'alert("请选择药品通用名类别！")';
  					$this->view->msg = $msg;
  				}
  				else
  				{
  					//取得分类编码
  					$coding_category_add = new Tcoding_category();
  					$coding_category_add->whereAdd("code_id='$ajax_category_id'");
  					$coding_category_add->find(true);
  					$coding_standard_code = $coding_category_add->standard_code;
	  				$add_medicine = new Tmedicine();
	  				$add_medicine->uuid = uniqid('m_',true);
	  				$add_medicine->medicine_code =  $medicine_code;
	  				$add_medicine->category_code = $ajax_category_id;
	  				$add_medicine->standard_code = $coding_standard_code.$medicine_code;
	  				$add_medicine->medicine_name = $medicine_name;
	  				$add_medicine->en_name       = @getPinyin($medicine_name);
	  				if($add_medicine->insert())
	  				{
	  					$this->redirect(__BASEPATH.'coding/medicine/index');
	  				}
  				}
  			}
  		}
  		$this->view->add_tag = $add_tag;
  		$this->view->display('add.html');
  	}
  	public function delAction()
  	{
  		$uuid = $this->_request->getParam('id');
  		if(!empty($uuid))
  		{
  			$medicine = new Tmedicine();
  			$medicine->whereAdd("uuid='$uuid'");
  			$medicine->delete();
  			$this->redirect(__BASEPATH.'coding/medicine/index');
  		}
  	}
  }