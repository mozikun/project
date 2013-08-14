<?php
   class coding_materialsController extends controller 
  {
  	public function init()
  	{
  		require_once __SITEROOT.'library/privilege.php';
  		require_once __SITEROOT.'library/Models/materials.php'; //品名表
  		require_once __SITEROOT.'library/Models/con_measures.php';//耗材单位表
  		require_once __SITEROOT.'library/Models/con_specification.php';//耗材规格表
  		require_once __SITEROOT.'library/Models/consumables_category.php';//耗材分类表
  		require_once __SITEROOT.'library/custom/pager.php';
  		$this->view->basePath   =  __BASEPATH;
  	}
  	public function indexAction()
   	 {
   	 	//是否国产
   	 	$domestic_array = array('1'=>'是','2'=>'否');
   	 	//医保等级
   	 	$medicare_array = array('1'=>'一级');
   	 	$materials = new Tmaterials();
   	 	$number = $materials->count();
   	 	$currentpage = intval($this->_request->getParam('page'));
		$realpage    = empty($currentpage)?1:$currentpage;
		$search = array();
		$links = new SubPages(__ROWSOFPAGE,$number,$realpage,__goodsListRowOfPage,__BASEPATH.'coding/materials/index/page/',3,$search);
		$pageCurrent = $links->check_page($realpage);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$materials->limit($startnum,__ROWSOFPAGE);
		$materials->find();
		$i = 0 ;
		$row =  array();
		while ($materials->fetch())
		{
			$row[$i]['standard_code'] = $materials->standard_code;
			$row[$i]['name_encod'] = $materials->name_encod;
			$row[$i]['zh_name'] = $materials->zh_name;
			$row[$i]['uuid'] = $materials->uuid;
			//取得分类
			$path = $materials->path;
			$path_array = explode(',',$path);
			$count = count($path_array)-1;
			unset($path_array[$count]);
			unset($path_array[0]);
			$str = '';
			foreach ($path_array as $k=>$v)
			{
				$consumables_category = new Tconsumables_category();
				$consumables_category->whereAdd("id='$v'");
				$consumables_category->find(true);
				$str.=$consumables_category->zh_name.'→';
				$consumables_category->free_statement();
			}
			$row[$i]['str'] = rtrim($str,'→');//
			$row[$i]['domestic_array'] = $domestic_array[$materials->domestic];
			$row[$i]['medicare_array'] = $medicare_array[$materials->medicare];
			$i++;
		}
		$this->view->row = $row;
		$this->view->page = $links->subPageCss2();
		$this->view->currentpage = $currentpage;
   	 	$this->view->display("list.html");
   	 }
   	 /**
   	  * 添加或者编辑操作
   	  *
   	  */
   	 public function addAction()
   	 {
   	 	require_once __SITEROOT.'/library/pinyin/pinyin.php';
   	 	//是否国产
   	 	$domestic_array = array('1'=>'是','2'=>'否');
   	 	//医保等级
   	 	$medicare_array = array('1'=>'一级');
   	 	//取得单位
   	 	$measure = new Tcon_measures();
   	 	$measure->find();
   	 	$i =0;
   	 	$m_array = array();
   	 	while ($measure->fetch())
   	 	{
   	 		$m_array[$i]['uuid'] = $measure->uuid;
   	 		$m_array[$i]['measure_name'] = $measure->measure_name;
   	 		$i++;
   	 	}
   	 	$this->view->m_array = $m_array;
   	 	$measure->free_statement();
   	 	//取得规格
   	 	$con_specification = new Tcon_specification();
   	 	$con_specification->find();
   	 	$i = 0;
   	 	$s_array = array();
   	 	while ($con_specification->fetch())
   	 	{
   	 		$s_array[$i]['uuid'] = $con_specification->uuid;
   	 		$s_array[$i]['specification_name'] = $con_specification->specification_name;
   	 		$i++;
   	 	}
   	 	$this->view->s_array = $s_array;
   	 	$measure->free_statement();
   	 	$domestic = $this->_request->getParam('domestic');//是否国产
        $uuid = $this->_request->getParam('uuid');
        $name_encod = $this->_request->getParam('name_encod');//品名编码
        $format = $this->_request->getParam('format');//品名规格
        $measure = $this->_request->getParam('measure');//耗材单位
        $zh_name = $this->_request->getParam('zh_name');//耗材名称
        $medicare = $this->_request->getParam('medicare');//医保等级
        $edit_id = $this->_request->getParam('edit_id');//路径
        $page = $this->_request->getParam('page');
        $ok = $this->_request->getParam('ok');
        if(!empty($uuid))
        {
        	//编辑
        	$add_tag =0;
        	$edit_materials = new Tmaterials();
        	$edit_materials->whereAdd("uuid='$uuid'");
        	$edit_materials->find(true);
        	//取得分类
        	$path = $edit_materials->path;
        	$path_array = explode(',',$path);
        	$count = count($path_array)-2;
        	$path_pid = $path_array[$count];
        	//品名编码
        	$name_encoding =  $edit_materials->name_encod;
        	//品名名称
        	$zh_name =  $edit_materials->zh_name;
        	$this->view->path_pid = $path_pid;
        	$this->view->name_encoding = $name_encoding;
        	$this->view->zh_name = $zh_name;
        	$this->view->measure = $edit_materials->measure;
        	$this->view->format = $edit_materials->format;
        	$this->view->domestic = $edit_materials->domestic;
        	$this->view->medicare = $edit_materials->medicare;
        	//开始编辑写入
        	if(!empty($ok))
        	{
        		//取得路径
        		$consumables_category = new Tconsumables_category();
        		$consumables_category->whereAdd("id='$edit_id'");
        		$consumables_category->find(true);
        		$path = $consumables_category->path;
        		$consumables_category->free_statement();
        		//生成标准编码
        		$category_obj = new Tconsumables_category();
        		$category_obj->whereAdd("id='$consumables_category->p_id'");
        		$category_obj->find(true);
        		$first_code = $category_obj->standard_code;
        		$second_code = $consumables_category->standard_code;
        		$third_code  = $name_encod;
        		//取得规格标准代码
        		if(!empty($format))
        		{
	        		$specification = new Tcon_specification();
	        		$specification->whereAdd("uuid='$format'");
	        		$specification->find(true);
	        		$fourth_code  = $specification->specification_code;
        		}
        		else 
        		{
        			exit('规格代码为空');
        		}
        		//取得单位标准代码
        		if(!empty($measure))
        		{
	        		$measures = new Tcon_measures();
	        		$measures->whereAdd("uuid='$measure'");
	        		$measures->find(true);
	        		$fifth_code = $measures->measure_code;
        		}
        		else 
        		{
        			exit('单位代码为空');
        		}		
        		$sixth_code  = $domestic;
        		$seventh_code = $medicare;
        		$materials_edit = new Tmaterials();
        		$materials_edit->whereAdd("uuid='$uuid'");;
        		$materials_edit->name_encod =  $name_encod;
        		$materials_edit->zh_name =  $zh_name;
        		$materials_edit->en_name =  getPinyin($zh_name);
        		$materials_edit->measure =  $measure;
        		$materials_edit->format =  $format;
        		$materials_edit->domestic =  $domestic;
        		$materials_edit->medicare =  $medicare;
        		$materials_edit->standard_code =  $first_code.$second_code.$third_code.$fourth_code.$fifth_code.$sixth_code.$seventh_code;
        		$materials_edit->path =  $path;
        		//$materials_edit->debugLevel(9);
        		$materials_edit->update();
        		$this->redirect(__BASEPATH.'coding/materials/index/page/'.$page);
        	}
        }
        else 
        {
        	//添加
        	$add_tag =1;
        	if(!empty($ok))
        	{
        		//取得路径
        		$consumables_category = new Tconsumables_category();
        		$consumables_category->whereAdd("id='$edit_id'");
        		$consumables_category->find(true);
        		$path = $consumables_category->path;
        		$consumables_category->free_statement();
        		//生成标准编码
        		$category_obj = new Tconsumables_category();
        		$category_obj->whereAdd("id='$consumables_category->p_id'");
        		$category_obj->find(true);
        		$first_code = $category_obj->standard_code;
        		$second_code = $consumables_category->standard_code;
        		$third_code  = $name_encod;
        		//取得规格标准代码
        		if(!empty($format))
        		{
	        		$specification = new Tcon_specification();
	        		$specification->whereAdd("uuid='$format'");
	        		$specification->find(true);
	        		$fourth_code  = $specification->specification_code;
        		}
        		else 
        		{
        			exit('规格代码为空');
        		}
        		//取得单位标准代码
        		if(!empty($measure))
        		{
	        		$measures = new Tcon_measures();
	        		$measures->whereAdd("uuid='$measure'");
	        		$measures->find(true);
	        		$fifth_code = $measures->measure_code;
        		}
        		else 
        		{
        			exit('单位代码为空');
        		}		
        		$sixth_code  = $domestic;
        		$seventh_code = $medicare;
        		$materials_add = new Tmaterials();
        		$materials_add->uuid = uniqid('m_',true);
        		$materials_add->name_encod =  $name_encod;
        		$materials_add->zh_name =  $zh_name;
        		$materials_add->en_name =  getPinyin($zh_name);
        		$materials_add->measure =  $measure;
        		$materials_add->format =  $format;
        		$materials_add->domestic =  $domestic;
        		$materials_add->medicare =  $medicare;
        		$materials_add->standard_code =  $first_code.$second_code.$third_code.$fourth_code.$fifth_code.$sixth_code.$seventh_code;
        		$materials_add->path =  $path;
        		//$materials_add->debugLevel(9);
        		$materials_add->insert();
        		$this->redirect(__BASEPATH.'coding/materials/index');
        	}
        }
        $this->view->add_tag = $add_tag;
        $this->view->domestic_array = $domestic_array;
        $this->view->medicare_array = $medicare_array;
        $this->view->display("add.html");
   	 }
   	 /**
   	  * 删除操作
   	  */
   	 public function delAction()
   	 {
   	 	$uuid = $this->_request->getParam('uuid');
   	 	if(!empty($uuid))
   	 	{
   	 		$materials = new Tmaterials();
   	 		$materials->whereAdd("uuid='$uuid'");
   	 		$materials->delete();
   	 		$this->redirect(__BASEPATH.'coding/materials/index');
   	 	}
   	 }
  }
?>