<?php
/** 
 * @author whx
 * @created 2012-6-26
 */
class wsinfo_moduleinfoController extends controller{
	public function init(){
		require_once __SITEROOT.'library/Models/api_info.php';
                require_once __SITEROOT.'library/Models/api_module.php';
		require_once __SITEROOT.'application/wsinfo/models/Column.php';
		require_once(__SITEROOT.'library/MyAuth.php');
		require_once(__SITEROOT.'library/privilege.php');
	}
	/**
	 * 模块详细列表
	 */
	public function indexAction(){
		require_once __SITEROOT."/library/custom/pager.php";
		$this->view->basePath = __BASEPATH;
		$module_id = trim($this->_request->getParam('module_search'));
		$table_name  = trim($this->_request->getParam('table_search'));
		$currentPage = intval($this->_request->getParam('page'));
		$realPage    = empty($currentPage)?1:$currentPage;
		//记录条数
		$moduleinfo = new Tapi_info(); 
		if($module_id){
				$moduleinfo->whereAdd("module_id like '$module_id%'");
			}
		if($table_name){
			    $moduleinfo->whereAdd("table_name='$table_name'");
		}
		$numNumber = $moduleinfo->count();
		$arrArg = array();
		$links = new SubPages(__ROWSOFPAGE,$numNumber,$realPage,__goodsListRowOfPage,__BASEPATH.'wsinfo/moduleinfo/index/module_search/'.$module_id.'/table_search/'.$table_name.'/page/',3,$arrArg);
		$pageCurrent = $links->check_page($realPage);
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  
		$listWsInfo = new Tapi_info();
		if($module_id){
			$listWsInfo->whereAdd("module_id like '$module_id%'");
		}
		if($table_name){
			$listWsInfo->whereAdd("table_name='$table_name'");
		}
                $module=new Tapi_module();
		$listWsInfo->limit($startnum,__ROWSOFPAGE);
		$listWsInfo->orderby("module_id ASC");
		$listWsInfo->find();
		$listArray = array();
		$listCount = 0;
		while($listWsInfo->fetch()){
			$listArray[$listCount]['internal_identifier'] = $listWsInfo->internal_identifier;
			$listArray[$listCount]['data_element']        = $listWsInfo->data_element;
			$listArray[$listCount]['definition']          = $listWsInfo->definition;
			$listArray[$listCount]['table_name']          = $listWsInfo->table_name;
			$listArray[$listCount]['fields']              = $listWsInfo->fields;
            $uuid=$listWsInfo->module_id;
            $module->where("uuid='$uuid'");
            $module->find(true);
			$listArray[$listCount]['module_name']           = $module->module_name;
			$listCount++;
		}
		$this->view->listArray = $listArray;
		$page = $links->subPageCss2();
		$this->view->page        = $page;
		$this->view->pageCurrent = $pageCurrent;
		$this->view->module_id   = $module_id;
		$this->view->table_name  = $table_name;
		$this->view->display('list.html');
        
	}
	/**
	 * 编辑和添加操作
	 */
	public function manageAction(){  
		$editId      = $this->_request->getParam('editid');
		$currentpage = $this->_request->getParam('currentpage');
		//获取表单传值
		$internal_identifier      = trim($this->_request->getParam('internal_identifier'));//主键
		$dataelement              = trim($this->_request->getParam('dataelement'));
		$dataelementname          = $this->_request->getParam('dataelementname');
		$dataaccess               = $this->_request->getParam('dataaccess');
		$definition               = $this->_request->getParam('definition');
		$datatype                 = trim($this->_request->getParam('datatype'));
		$that_format              = trim($this->_request->getParam('that_format'));
		$table_name               = $this->_request->getParam('table_name');
		$fields                   = $this->_request->getParam('fields');
		$module_id                = $this->_request->getParam('module_id');
		$module_search            = $this->_request->getParam('module_search');
		$table_search             = $this->_request->getParam('table_search');
	    $same_as_de               = $this->_request->getParam("same_as_de");
        $order_by                 = $this->_request->getParam("order_by");        
		$this->view->module_search= $module_search;
		$this->view->table_search = $table_search;
		$this->view->currentpage  = $currentpage;
		$this->view->currentId    = $editId;
		$this->view->basePath     = __BASEPATH;
		if(empty($editId)){
			//获取模块下拉框
			$api_module = new Tapi_module();
			$api_module->find();
			$wsmoduleArray = array();
			$count = 0;
			while($api_module->fetch()){
				$wsmoduleArray[$count]['module_id']   = $api_module->uuid;
				$wsmoduleArray[$count]['module_name'] = $api_module->module_name;
				$count++;
			}
			$this->view->wsmoduleArray = $wsmoduleArray;
			//添加新的记录
			if($this->_request->getParam('save')){
				if($internal_identifier){
					$checkwsinfo = new Tapi_info();
					$checkwsinfo->whereAdd("internal_identifier='$internal_identifier'");
					if($checkwsinfo->count()>0){ 
						$message ='<script type="text/javascript">window.alert("对不起内部标识符不能重复,请重新输入！");history.go(-1);</script>';
		   	     		$this->view->message = $message;
					}else{
						$addwsinfo = new Tapi_info();
						$addwsinfo->internal_identifier = $internal_identifier;
						$addwsinfo->data_element        = $dataelement;
						$addwsinfo->data_element_name   = $dataelementname;
						$addwsinfo->data_format         = $that_format;
						$addwsinfo->allowable_value     = $dataaccess;
						$addwsinfo->data_type           = $datatype;
						$addwsinfo->definition          = $definition;
						$addwsinfo->table_name          = $table_name;
						$addwsinfo->fields              = $fields;
						$addwsinfo->module_id           = $module_id;
                        $addwsinfo->same_as_de          = $same_as_de;
                        $addwsinfo->order_by            = $order_by;
						if($addwsinfo->insert()){ 
							
								//创建成功直接跳							
                                $this->redirect(__BASEPATH.'wsinfo/moduleinfo/index/page/'.$currentpage);
                        }
							else{
							$message ='<script type="text/javascript">window.alert("数据保存失败!");history.go(-1);</script>';
			   	     		$this->view->message = $message;
						}
					}
				}
			}
		}else{
			$controlName = 'readonly="readonly" style="background:#cccccc;color:white;";';
			$editInfo = new Tapi_info();
			$editInfo->whereAdd("internal_identifier='$editId'");
			$editInfo->find(true);
			$this->view->internal_identifier   = $editInfo->internal_identifier;
			$this->view->dataelement           = $editInfo->data_element;
			$this->view->dataelementname       = $editInfo->data_element_name;
			$this->view->dataaccess            = $editInfo->allowable_value;
			$this->view->definition            = $editInfo->definition;
			$this->view->datatype              = $editInfo->data_type;
			$this->view->that_format           = $editInfo->data_format;
			$this->view->table_name            = $editInfo->table_name;
			$this->view->fields                = $editInfo->fields;
			$this->view->module_id             = $editInfo->module_id;
            $this->view->order_by              = $editInfo->order_by;
            $this->view->same_as_de            = $editInfo->same_as_de;
			//获取模块下拉框
			$api_module = new Tapi_module();
			$api_module->find();
			$wsmoduleArray = array();
			$count = 0;
			while($api_module->fetch()){
				$wsmoduleArray[$count]['module_id']   = $api_module->uuid;
				$wsmoduleArray[$count]['module_name'] = $api_module->module_name;
				if($editInfo->module_id==$api_module->uuid){
					$wsmoduleArray[$count]['selectname']= 'selected';
				}
				$count++;
			}
			$this->view->wsmoduleArray = $wsmoduleArray;
			//选中对应的模块
			$this->view->controlName   = $controlName;
			//先尝试修改字段如果未成功不执行下边的编辑
			if($this->_request->getParam('save')){
				
						//更新内容
						$updatewsinfo = new Tapi_info();
						$updatewsinfo->whereAdd("internal_identifier='$internal_identifier'");
						$updatewsinfo->data_element        = $dataelement;
						$updatewsinfo->data_element_name   = $dataelementname;
						$updatewsinfo->data_format         = $that_format;
						$updatewsinfo->allowable_value     = $dataaccess;
						$updatewsinfo->data_type           = $datatype;
						$updatewsinfo->definition          = $definition;
						$updatewsinfo->table_name          = $table_name;
						$updatewsinfo->fields              = $fields;
						$updatewsinfo->module_id           = $module_id;
                        $updatewsinfo->same_as_de          = $same_as_de;
					

							  if( $updatewsinfo->update()){
						  	   $this->redirect(__BASEPATH.'wsinfo/moduleinfo/index/page/'.$currentpage.'/module_search/'.$module_search.'/table_search/'.$table_search);
						     }	
							else{
								$message ='<script type="text/javascript">window.alert("表字段更新失败!");history.go(-1);</script>';
								$this->view->message = $message;
						    }	
			}
		}
		$this->view->display('add.html');
	}
	/**
	 * 删除操作
	 */
	public function delAction(){
	        $delId         = $this->_request->getParam('delid');
   	    	$currentpage   = $this->_request->getParam('currentpage');
   	    	$module_search = $this->_request->getParam('module_search');
		    $table_search  = $this->_request->getParam('table_search');
   	    	if($delId){
   	    		//查找当前ID的信息
   	    		$currentDelInfo = new Tapi_info();
   	    		$currentDelInfo->whereAdd("internal_identifier='$delId'");
   	    		if($currentDelInfo->count()>0)
                {
                    if($currentDelInfo->delete());
                    $this->redirect(__BASEPATH.'wsinfo/moduleinfo/index/page/'.$currentpage.'/module_search/'.$module_search.'/table_search/'.$table_search);
                }
   	    		
   	    		}
   	    	}
	}
	

?>