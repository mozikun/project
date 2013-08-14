<?php
//author whx
//time 2013.3.27
//接口模块管理
class wsinfo_manageController extends controller{
	public function init(){
		 $this->view->basePath = $this->_request->getBasePath();
		 require_once(__SITEROOT."library/Models/api_module.php");
		 require_once(__SITEROOT."library/Models/staff_core.php");
		 require_once(__SITEROOT.'library/privilege.php');
		 require_once(__SITEROOT."/library/custom/pager.php");//引入分页处理文件
	}
	//列表
	public function indexAction(){
		$api_module=new Tapi_module();
		$staff_core=new Tstaff_core();
		$api_module->joinAdd("inner",$api_module,$staff_core,"doctor_id","id");
		$api_module->orderby("api_module.order_by");
		$count=$api_module->count();
		$currentPage = intval($this->_request->getParam('page'));
        $realPage    = empty($currentPage)?1:$currentPage;
		$arrArg=array();
		$links = new SubPages(__ROWSOFPAGE,$count,$realPage,__goodsListRowOfPage,__BASEPATH.'wsinfo/manage/index/module_search/'.'/table_search/'.'/page/',3,$arrArg);
        $pageCurrent = $links->check_page($realPage);//检查当前页数是否合法
        $startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
        $api_module->limit($startnum,__ROWSOFPAGE);
		$api_module->find();
		$index=0;
		$result=array();
		while($api_module->fetch()){
			$result[$index]['module_id']=$api_module->module_id;
			$result[$index]['module_name']=$api_module->module_name;
			$result[$index]['created']=date("Y-m-d",$api_module->created);
			$result[$index]['staff']=$staff_core->name_login;
			$result[$index]['order_by']=$api_module->order_by;
			$result[$index]['xml']=$api_module->xml_template;
			$result[$index]['uuid']=$api_module->uuid;
			$index++;
		}
		$page = $links->subPageCss2();
        $this->view->page        = $page;
        $this->view->pageCurrent = $pageCurrent;
		$this->view->rows=$result;
		$this->view->display("index.html");
	}
	//添加
	public function addAction(){
		$this->view->display("add.html");
	}
	//编辑
	public function editAction(){
		$uuid=$this->_request->getParam("uuid");
		$api_module=new Tapi_module();
		$api_module->whereAdd("uuid='$uuid'");
		$api_module->find(true);
		$this->view->row=$api_module->toArray();
		$this->view->display("edit.html");
	}
	//保存数据
	public function savedataAction(){
		$action=$this->_request->getParam("action");
		$uuid=$this->_request->getParam("uuid");
		$api_module=new Tapi_module();
		$api_module->module_id=$this->_request->getParam("id");
		$api_module->module_name=$this->_request->getParam("name");
		$api_module->order_by=$this->_request->getParam("order_by");
		$api_module->xml_template=$this->_request->getParam("xml");
		$api_module->doctor_id=$this->user['uuid'];
		$api_module->updated=time();
		if($action=="add"){
			$api_module->uuid="m_".uniqid();
			$api_module->created=time();
			$api_module->insert();
			echo "添加成功";exit();
			
		}
		if($action=="edit"){
			$api_module->whereAdd("uuid='$uuid'");
			
			$api_module->update();
				
			echo "更新成功";
			
			
		}
	}
	//删除数据
	public function delAction(){
		$id=$this->_request->getParam("id");
		$api_module=new Tapi_module();
		$api_module->whereAdd("uuid='$id'");
		if($api_module->count()>0){
			$api_module->delete();
			echo "删除成功";
		}
		else echo "没有找到相关信息";
	}
}
?>