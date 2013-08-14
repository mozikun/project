<?php
/** 
 * @author ct
 * @created 2011-1-19
 */
class wsinfo_infmanageController extends controller{
	public function init(){
		require_once __SITEROOT.'library/Models/ws_module.php';
		require_once __SITEROOT.'library/Models/ws_info.php';
		require_once __SITEROOT.'application/wsinfo/models/createColumn.php';
		require_once(__SITEROOT.'library/Myauth.php');
		require_once(__SITEROOT.'library/privilege.php');
	}
	/**
	 * 标准代码的列表显示
	 */
	public function indexAction(){
		require_once __SITEROOT."/library/custom/pager.php";
		$this->view->basePath = __BASEPATH;
		$module_id = trim($this->_request->getParam('module_search'));
		$table_name  = trim($this->_request->getParam('table_search'));
		$currentPage = intval($this->_request->getParam('page'));
		$realPage    = empty($currentPage)?1:$currentPage;
		//获取总数
		$wsinfo = new Tws_info();
		if($module_id){
				$wsinfo->whereAdd("module_id like '$module_id%'");
			}
		if($table_name){
			    $wsinfo->whereAdd("table_name='$table_name'");
		}
		$numNumber = $wsinfo->count();
		$arrArg = array();
		$links = new SubPages(__ROWSOFPAGE,$numNumber,$realPage,__goodsListRowOfPage,__BASEPATH.'wsinfo/infmanage/index/module_search/'.$module_id.'/table_search/'.$table_name.'/page/',3,$arrArg);
		$pageCurrent = $links->check_page($realPage);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$listWsInfo = new Tws_info();
		if($module_id){
			$listWsInfo->whereAdd("module_id like '$module_id%'");
		}
		if($table_name){
			$listWsInfo->whereAdd("table_name='$table_name'");
		}
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
			$listArray[$listCount]['module_id']              = $listWsInfo->module_id;
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
	 * 标准代码的编辑和添加操作
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
	    $repeat_count             = $this->_request->getParam('repeat_count');
	    $coerciveness_token       = $this->_request->getParam('coerciveness_token');
		$this->view->module_search= $module_search;
		$this->view->table_search = $table_search;
		$this->view->currentpage  = $currentpage;
		$this->view->currentId    = $editId;
		$this->view->basePath     = __BASEPATH;
		if(empty($editId)){
			//获取模块下拉框
			$wsmodule = new Tws_module();
			$wsmodule->find();
			$wsmoduleArray = array();
			$count = 0;
			while($wsmodule->fetch()){
				$wsmoduleArray[$count]['module_id']   = $wsmodule->module_id;
				$wsmoduleArray[$count]['module_name'] = $wsmodule->module_name;
				$count++;
			}
			$this->view->wsmoduleArray = $wsmoduleArray;
			//添加新的记录
			if($this->_request->getParam('save')){
				if($internal_identifier){
					$checkwsinfo = new Tws_info();
					$checkwsinfo->whereAdd("internal_identifier='$internal_identifier'");
					if($checkwsinfo->count()>0){
						$message ='<script type="text/javascript">window.alert("对不起内部标识符不能重复,请重新输入！");history.go(-1);</script>';
		   	     		$this->view->message = $message;
					}else{
						$addwsinfo = new Tws_info();
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
						$addwsinfo->repeat_count        = $repeat_count;
						$addwsinfo->coerciveness_token  = $coerciveness_token;
						//echo createLoneColumn($module_id,$that_format,$dataelement,$dataelementname,$datatype);
						if($addwsinfo->insert()){
							if(createLoneColumn($module_id,$that_format,$dataelement,$dataelementname,$datatype)){
								//创建成功直接跳转
								$this->redirect(__BASEPATH.'wsinfo/infmanage/index/page/'.$currentpage);
							}else{
								//如果没有创建成功字段就删除该条记录让他返回再重新添加数据再进行创建
							   $delwsInfo = new Tws_info();
							   $delwsInfo->whereAdd("internal_identifier='$internal_identifier'");
							   $delwsInfo->delete();
							   $message ='<script type="text/javascript">window.alert("表字段创建失败,数据没能添加成功!");history.go(-1);</script>';
			   	     		   $this->view->message = $message;
							}
						}else{
							$message ='<script type="text/javascript">window.alert("数据保存失败!");history.go(-1);</script>';
			   	     		$this->view->message = $message;
						}
					}
				}
			}
		}else{
			$controlName = 'readonly="readonly" style="background:#cccccc;color:white;";';
			$editInfo = new Tws_info();
			$editInfo->whereAdd("internal_identifier='$editId'");
			$editInfo->find(true);
			$this->view->internal_identifier   = $editInfo->internal_identifier;
			$this->view->dataelement           = $editInfo->data_element;
			$this->view->dataelementname       = $editInfo->data_element_name;
			$this->view->dataaccess            = $editInfo->allowable_value;
			$this->view->definition            = $editInfo->definition;
			$this->view->datatype              = $editInfo->data_type;
			$this->view->that_format           = $editInfo->data_format;
			$this->view->table_name             = $editInfo->table_name;
			$this->view->fields                = $editInfo->fields;
			$this->view->module_id             = $editInfo->module_id;
			$this->view->repeat_count          = $editInfo->repeat_count;
			$this->view->coerciveness_token    = $editInfo->coerciveness_token;
			//获取模块下拉框
			$wsmodule = new Tws_module();
			$wsmodule->find();
			$wsmoduleArray = array();
			$count = 0;
			while($wsmodule->fetch()){
				$wsmoduleArray[$count]['module_id']   = $wsmodule->module_id;
				$wsmoduleArray[$count]['module_name'] = $wsmodule->module_name;
				if($editInfo->module_id==$wsmodule->module_id){
					$wsmoduleArray[$count]['selectname']= 'selected';
				}
				$count++;
			}
			$this->view->wsmoduleArray = $wsmoduleArray;
			//选中对应的模块
			$this->view->controlName   = $controlName;
			//先尝试修改字段如果未成功不执行下边的编辑
			if($this->_request->getParam('save')){
				//echo $internal_identifier;
				//echo editLoneColumn($module_id,$that_format,$dataelement,$dataelementname,$datatype,$editInfo->data_element);
//				if(editLoneColumn($module_id,$that_format,$dataelement,$dataelementname,$datatype,$editInfo->data_element))
//				    {
						//更新内容
						$updatewsinfo = new Tws_info();
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
						$updatewsinfo->repeat_count        = $repeat_count;
						$updatewsinfo->coerciveness_token  = $coerciveness_token;
						//echo editLoneColumn($module_id,$that_format,$dataelement,$dataelementname,$datatype,$editInfo->data_element);
						if(editLoneColumn($module_id,$that_format,$dataelement,$dataelementname,$datatype,$editInfo->data_element)){
							   $updatewsinfo->update();
						  	   $this->redirect(__BASEPATH.'wsinfo/infmanage/index/page/'.$currentpage.'/module_search/'.$module_search.'/table_search/'.$table_search);
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
	 * 标准代码的删除操作
	 */
	public function delAction(){
	        $delId         = $this->_request->getParam('delid');
   	    	$currentpage   = $this->_request->getParam('currentpage');
   	    	$module_search = $this->_request->getParam('module_search');
		    $table_search  = $this->_request->getParam('table_search');
   	    	if($delId){
   	    		//查找当前ID的信息
   	    		$currentDelInfo = new Tws_info();
   	    		$currentDelInfo->whereAdd("internal_identifier='$delId'");
   	    		$currentDelInfo->find(true);
   	    		//执行删除数据表的字段名称
   	    		$delObject = new Tws_info();
   	    		if($delObject->oracle_query("alter table ws_".$currentDelInfo->module_id." drop   column   ".str_replace('.','_',$currentDelInfo->data_element))){
	   	    		$delInfo = new Tws_info();
	   	    		$delInfo->whereAdd("internal_identifier='$delId'");
	   	    		if($delInfo->delete()){
	   	    			//执行删除当前信息
	   	    			$this->redirect(__BASEPATH.'wsinfo/infmanage/index/page/'.$currentpage.'/module_search/'.$module_search.'/table_search/'.$table_search);
	   	    		}
   	    		}
   	    	}
	}
	/**
	 * 生成所有的数据
	 * 
	 */
	public function allAction(){
		set_time_limit(0);
		require(__SITEROOT.'config/oracleConfig.php');
		$link=oci_pconnect($databaseConfig[1]['user'], $databaseConfig[1]['password'],$databaseConfig[1]['host'],$databaseConfig[1]['charset']) or exit("数据库连接失败!");
		//保证当前的要生成的表都存在
		$wsModule = "select * from WS_MODULE";
		$statement =oci_parse($link,$wsModule);
		oci_execute($statement);
		while ($row = oci_fetch_array ($statement,OCI_ASSOC) ){
			$moduleId = strtoupper($row['MODULE_ID']);
			$sql =  "select count(*) mycount from tabs where table_name='WS_".$moduleId."'";
			$sm =oci_parse($link,$sql);
			oci_execute($sm);
			$myrow = oci_fetch_array ($sm,OCI_ASSOC);
			//开始生成所有需要的表
			if($myrow['MYCOUNT']==0){
				$mysql = "create table WS_".$moduleId."(ws_id number)";
				$mystatement =oci_parse($link,$mysql);
				oci_execute($mystatement);
			}
		}
		//找出WS_INFO表中存在数据元有空值的情形(让他变成空值2011.3.15生成字符串类型的)
		$allNullColum   =  "select * from WS_INFO where DATA_TYPE IS NULL";
		$NullSta = oci_parse($link,$allNullColum);
		oci_execute($NullSta);
		while($nullRow = oci_fetch_array($NullSta,OCI_ASSOC)){
			$uuid      = $nullRow['INTERNAL_IDENTIFIER'];
			$updateSql = "update WS_INFO set DATA_TYPE='S',DATA_FORMAT='AN..60' where INTERNAL_IDENTIFIER='$uuid'";
			$upSta     = oci_parse($link,$updateSql);
			oci_execute($upSta);
		}
		
		//处理所有的内容生成表中的字段
		$allModulesql = "select * from WS_MODULE";
		$allSta  = oci_parse($link,$allModulesql);
		oci_execute($allSta);
		while($allinforow = oci_fetch_array($allSta,OCI_ASSOC)){
			$realModuleId = strtoupper($allinforow['MODULE_ID']);
		    //新添加入字段uuid 主键            varchar2(30),created创建时间 Number,doctor_id医生 varchar2(30),action动作  varcahr2(30)
			$newarray = array('uuid'=>array('varchar2(30)'=>'主键'),'created'=>array('number'=>'创建时间'),'doctor_id'=>array('varchar2(30)'=>'医生'),'action'=>array('varchar2(30)'=>'动作'),'org_id'=>array('varchar2(30)'=>'机构ID'),'identity_number'=>array('varchar2(30)'=>'身份证号'));
			//现在判断该字段是否存在如果不存在就创建 如果已经存在就不管他
			foreach($newarray as $k=>$v){
				$reapeatsql = "SELECT count(*) repeatnumber FROM USER_TAB_COLUMNS WHERE TABLE_NAME ='WS_".$realModuleId."' and COLUMN_NAME='$k'";
				$repeatsta  = oci_parse($link,$reapeatsql);
				oci_execute($repeatsta);
				$myresult = oci_fetch_array($repeatsta,OCI_ASSOC); 
				if($myresult['REPEATNUMBER']==0){
					//如果该字段不存在那么就创建字段
					foreach($v as $ka=>$va){
						if($k=='uuid'){
							$currentmysql = "alter table WS_".$realModuleId." add ".$k." ".$ka." primary key";
						}else{
					        $currentmysql = "alter table WS_".$realModuleId." add ".$k." ".$ka;
						}
					   $currentsta   = oci_parse($link,$currentmysql);
					   @oci_execute($currentsta);
					   //给字段加注释
					   $commentSql = "comment on column WS_".$realModuleId.".".$k." IS '".$va."'";
				       $commentSta = oci_parse($link,$commentSql);
				       oci_execute($commentSta);
					}
				 }
			}
			//echo $realModuleId.'<br/>';
			$infoSql      = "select * from WS_INFO where MODULE_ID like '$realModuleId%'";
			$infoSta      = oci_parse($link,$infoSql);
			oci_execute($infoSta);
			while($staRow = oci_fetch_array($infoSta,OCI_ASSOC)){
				$currentType = $staRow['DATA_TYPE'];
				$columName   = strtoupper($staRow['INTERNAL_IDENTIFIER']);
				$that_format = @$staRow['DATA_FORMAT'];
				$Explain     = $staRow['DATA_ELEMENT_NAME'];
	            $resultName  = str_replace('.','_',$columName);
	            $columSql  = "SELECT count(*) columnumber FROM USER_TAB_COLUMNS WHERE TABLE_NAME ='WS_".$realModuleId."' and COLUMN_NAME='$resultName'";
			    $columstatement = oci_parse($link,$columSql);
			    oci_execute($columstatement);
				//过滤掉已经在对应表中生成字段的记录
				$columrow  = oci_fetch_array($columstatement,OCI_ASSOC);
			    if($that_format==""){
					echo "<font color=\"red\">数据元的表示格式出现空值</font>表:ws_".$realModuleId."的".$resultName."字段将不能创建<br/>";
				}else{
                // echo $columrow['COLUMNUMBER']."<br/>";
					if($columrow['COLUMNUMBER']==0){
					    $dataArray  = array('S'=>'varchar2','D'=>'date','DT'=>'date','N'=>'number','L'=>'number');
					    foreach($dataArray as $k=>$v){
					    	if($k==$currentType){
					    		//这里还要判断输入没有数字的情形
					    		if($k!=='L'){
						    		preg_match_all('~[$0-9]{1,}~',$that_format,$pregResult);
									if($k=='S'){
									   $realDataLength = $pregResult[0][0]*3;
					    			}else{
					    			   $realDataLength = $pregResult[0][0];
					    			}
						    		//echo $pregResult[0][0].'<br/>';
									if($k=='D'||$k=='DT'){
					    				$addFirst = "alter table WS_".$realModuleId." add ".$resultName." ".$v;
					    			}else{
					    			    $addFirst = "alter table WS_".$realModuleId." add ".$resultName." ".$v."(".$realDataLength.")";
					    			}
					    			$sqlSta = oci_parse($link,$addFirst);
					    			@oci_execute($sqlSta);
					    			$exSql = "comment on column WS_".$realModuleId.".".$resultName." IS '".$Explain."'";
					    			$exSta = oci_parse($link,$exSql);
					    			oci_execute($exSta);
					    		}else{
					    			//现在是L型的
					    			$addFirst = "alter table WS_".$realModuleId." add ".$resultName." ".$v;
					    			$lSta = oci_parse($link,$addFirst);
					    			oci_execute($lSta);
					    			$exSql = "comment on column WS_".$realModuleId.".".$resultName." IS '".$Explain."'";
					    			$exSta = oci_parse($link,$exSql);
					    			oci_execute($exSta);
					    		}
					    	}
					    }
					}else{
						//这里就相当于编辑
					    $dataArray  = array('S'=>'varchar2','D'=>'date','DT'=>'date','N'=>'number','L'=>'number');
					    foreach($dataArray as $k=>$v){
					    	if($k==$currentType){
					    		//这里还要判断输入没有数字的情形
					    		if($k!=='L'){
						    		preg_match_all('~[$0-9]{1,}~',$that_format,$pregResult);
									if($k=='S'){
									   $realDataLength = $pregResult[0][0]*3;
					    			}else{
					    			   $realDataLength = $pregResult[0][0];
					    			}
						    		//echo $pregResult[0][0].'<br/>';
			                        //这里无法修改字段的名字了根本判断不出来哪个字段发生变化
									if($k=='D'||$k=='DT'){
					    				$addFirst = "alter table WS_".$realModuleId." MODIFY ( ".$resultName." ".$v." )";
					    			}else{
					    			    $addFirst = "alter table WS_".$realModuleId." MODIFY ( ".$resultName." ".$v."(".$realDataLength.") )";
					    			}
					    			$editThrid = "comment on column WS_".$realModuleId.".".$resultName." IS '".$Explain."'";
					    			$sqlSta = oci_parse($link,$addFirst);
					    		    @oci_execute($sqlSta);
					    		    $thirdSta  = oci_parse($link,$editThrid);
					    		    oci_execute($thirdSta);
					    		}else{
					    			//现在是L型的
					    			$addFirst = "alter table WS_".$realModuleId." MODIFY ( ".$resultName." ".$v." )";
					    			$editThrid = "comment on column WS_".$realModuleId.".".$resultName." IS '".$Explain."'";
					    			$lSta = oci_parse($link,$addFirst);
					    			oci_execute($lSta);	
					    		    $thirdSta  = oci_parse($link,$editThrid);
					    		    oci_execute($thirdSta);
					    		}   		
					    	}
					    }
					}
				}
			}
		}
	}	
}
?>