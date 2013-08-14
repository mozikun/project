<?php 
/**
 * 
 * @author ct
 * @created 2011-1-18
 */
class wsmodule_wsmanageController extends controller{
   	     public function init(){   	
   	     	require_once(__SITEROOT.'library/Myauth.php');
		    require_once(__SITEROOT.'library/privilege.php');
   	     	require_once __SITEROOT.'library/Models/ws_module.php';
   	     	require_once __SITEROOT.'library/Models/ws_info.php';
   	     }
   	     /**
   	      * 用于列表进行查看
   	      */
   	     public function indexAction(){
   	     	require_once __SITEROOT."/library/custom/pager.php";
   	     	$this->view->basePath = __BASEPATH;
   	     	//$myConnect = new oracle_connect();
//   	     	require_once(__SITEROOT."config/oracleConfig.php");
//   	     	var_dump($databaseConfig['user']);
   	     	//获取分页参数
			$currentPage = intval($this->_request->getParam('page'));
			$realPage    = empty($currentPage)?1:$currentPage;
			$wsModule    = new Tws_module();
			$numNumber   = $wsModule->count();
			$arrArg = array();
			$links = new SubPages(__ROWSOFPAGE,$numNumber,$realPage,__goodsListRowOfPage,__BASEPATH.'wsmodule/wsmanage/index/page/',3,$arrArg);
			$pageCurrent = $links->check_page($realPage);//检查当前页数是否合法
			$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
			$listMsModule = new Tws_module();
			$listMsModule->limit($startnum,__ROWSOFPAGE);
			$listMsModule->orderby("module_id ASC");
			$listMsModule->find();
			$listArray  = array();
			$count = 0;
			while($listMsModule->fetch()){
				$listArray[$count]['module_id']     = $listMsModule->module_id;
				$listArray[$count]['module_name']   = $listMsModule->module_name;
				$listArray[$count]['module_content']= $listMsModule->module_content;
				$count++;
			}
			$this->view->listArray = $listArray;
			$page = $links->subPageCss2();
			$this->view->page        = $page;
			$this->view->pageCurrent = $pageCurrent;
			//createTable();
   	     	$this->view->display('list.html');
   	     }
   	     /**
   	      * 用于添加和修改
   	      */
   	     public function manageAction(){	
   	     	$this->view->basePath = __BASEPATH;
   	     	$module_name = $this->_request->getParam('module_name');
   	     	$module_con  = $this->_request->getParam('module_con');
   	     	$editId      = $this->_request->getParam('editid');
   	     	$moduleId    = trim($this->_request->getParam('module_id'));
   	     	$currentpage = $this->_request->getParam('currentpage');
   	     	$this->view->currentId  = $editId;
            if(!empty($editId)){
        		//编辑数据
        			$editModule = new Tws_module();
        			$editModule->whereAdd("module_id='$editId'");
        			$editModule->find(true);
        			$this->view->moduleName    = $editModule->module_name;
        			$this->view->moduleContent = $editModule->module_content;
        			$this->view->moduleId      = $editModule->module_id;
        			$controlName = 'readonly="readonly" style="background:#cccccc;color:white;";';
        			$this->view->controlName = $controlName;
        			if(!empty($module_name)){
        				if($this->_request->getParam('save')){
        					$saveModule = new Tws_module();
        					$saveModule->whereAdd("module_id='$editId'");
        					$saveModule->module_name    = $module_name;
        					$saveModule->module_content = $module_con;
        					if($saveModule->update()){
        						$this->redirect(__BASEPATH.'wsmodule/wsmanage/index/page/'.$currentpage);
//        						$message ='<script type="text/javascript">window.alert("数据更新成功");</script>';
//		   	     				$this->view->message = $message;
        					}else{
        						$message ='<script type="text/javascript">window.alert("数据更新失败");</script>';
		   	     				$this->view->message = $message;
        					}
        				}
        			}
        		}else{
        			//添加数据
        			if(!empty($module_name)){
        			  if($this->_request->getParam('save')){
        			  	$pdmodule = new Tws_module();
        			  	$pdmodule->whereAdd("module_id='$moduleId'");
        			  	if($pdmodule->count()>0){
        			  		$message ='<script type="text/javascript">window.alert("对不起模块编号不能重复,请重新输入！");history.go(-1);</script>';
		   	     			$this->view->message = $message;
        			  	}else{
		   	     			$wsModule = new Tws_module();
		   	     			$wsModule->module_id      = $moduleId;
		   	     			$wsModule->module_name    = $module_name;
		   	     			$wsModule->module_content = $module_con;
			   	     		if($wsModule->insert()){
//			   	     				$message ='<script type="text/javascript">window.alert("数据保存成功");history.go(-1);</script>';
//			   	     				$this->view->message = $message;
                                    //创建数据表
                                    $createNew = new Tws_module();
                                    if($createNew->oracle_query("create table ws_".$moduleId."(ws_id number)"))
                                    {
                                      //创建必须的字段
                                      $newarray = array('uuid'=>array('varchar2(30)'=>'主键'),'created'=>array('number'=>'创建时间'),'doctor_id'=>array('varchar2(30)'=>'医生'),'action'=>array('varchar2(30)'=>'动作'),'org_id'=>array('varchar2(30)'=>'机构ID'),'identity_number'=>array('varchar2(30)'=>'身份证号'));
                                      foreach($newarray as $k=>$v){
                                      	   foreach($v as $kk=>$vv){
	                                      	   	if($k=='uuid'){
	                                      	   		$createNew->oracle_query("alter table ws_".$moduleId." add ".$k." ".$kk." primary key");
	                                      	   	}else{
	                                      	   	   $createNew->oracle_query("alter table ws_".$moduleId." add ".$k." ".$kk);
	                                      	   	}
	                                      	   	$createNew->oracle_query("comment on column ws_".$moduleId.".".$k." IS '".$vv."'");
	                                      	   	
                                      	   }
                                      }
                                      $this->redirect(__BASEPATH.'wsmodule/wsmanage/index/page/'.$currentpage);
                                    }else{
                                      $delNew = new Tws_module();
                                      $delNew->whereAdd("module_id='$moduleId'");
                                      $delNew->delete();
                                      $message ='<script type="text/javascript">window.alert("数据表创建失败!");history.go(-1);</script>';
			   	     				  $this->view->message = $message;
                                    }
		   	     			  }else{
		   	     			  	    $message ='<script type="text/javascript">window.alert("数据保存失败");history.go(-1);</script>';
			   	     				$this->view->message = $message;
		   	     			  }
        			  	}
        		      }
        	       }
               }	
            $this->view->currentpage  = $currentpage;
   	     	$this->view->display('add.html');
   	     }
   	     /**
   	      * 用于删除当前内容
   	      */
   	    public function delAction(){
   	    	$delId       = $this->_request->getParam('delid');
   	    	$currentpage = $this->_request->getParam('currentpage');
   	    	if($delId){
   	    		//删除标准代码表中的相关数据
   	    		$delInfo   = new Tws_info();
   	    		$delInfo->whereAdd("module_id='$delId'");
   	    		$delInfo->find();
   	    		while($delInfo->fetch()){
   	    			$realdelInfo = new Tws_info();
   	    			$realdelInfo->whereAdd("internal_identifier='$delInfo->internal_identifier'");
   	    			$realdelInfo->delete();
   	    		}
   	    		//删除模块表中的数据
   	    		$delModule = new Tws_module();
   	    		$delModule->whereAdd("module_id='$delId'");
   	    		if($delModule->delete()){
   	    			$dropTable = new Tws_module();
   	    			$dropTable->oracle_query("drop table ws_".$delId);
   	    			$this->redirect(__BASEPATH.'wsmodule/wsmanage/index/page/'.$currentpage);
   	    		}
   	    	}
   	    }
   }
?>