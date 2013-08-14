<?php
/**
 * 
 * 突发事件报告
 * @package yaan
 * @author whx
 * @access public
 */
class android_emergencyController extends controller
{
    public function init()
    {
        
        require_once(__SITEROOT.'library/Models/staff_core.php');//用户核心表
		require_once(__SITEROOT.'library/Models/staff_archive.php');//用户扩展表
		require_once(__SITEROOT.'library/Models/zhibao.php');//用户扩展表
		require_once(__SITEROOT.'library/Myauth.php');
		require_once (__SITEROOT . '/library/custom/comm_function.php');
		 require_once(__SITEROOT . 'library/custom/pager.php'); //分页表
		$this->auth=Zend_Auth::getInstance();
		$this->view->basePath = $this->_request->getBasePath();
    }
	
	//显示添加事件页面
    public function addAction(){
		
		$this->view->display("add.html");
	}
	
	//保持数据
	
	public function saveAction(){
	
		$adress=$this->_request->getParam("adress");
		$fasheng_time=$this->_request->getParam("fasheng_time");
		$baogao_time=$this->_request->getParam("baogao_time");
		$shijian=$this->_request->getParam("shijian");
		$shoushang_nums=$this->_request->getParam("shoushang_nums");
		$die_nums=$this->_request->getParam("die_nums");
		$leixing=$this->_request->getParam("leixing");
		//print_r($leixing);
		$emergency=new Tzhibao();
		$emergency->uuid="e_".uniqid();
		$emergency->org_id=$_SESSION['organization_core']['organization_id'];
		$emergency->created=time();
		$emergency->adress=$adress;
		$emergency->fasheng_time=strtotime($fasheng_time);
		//echo $fasheng_time;exit();
		$emergency->baogao_time=strtotime($baogao_time);
		$emergency->shijian=$shijian;
		$emergency->shoushang_nums=$shoushang_nums;
		$emergency->die_nums=$die_nums;
		$emergency->leixing=$leixing;
		if($emergency->insert()){
			echo "保存成功!";
		}else{
			echo "保存失败!";
		}
		
	}
	
	//列表
	public function  indexAction(){
	
		$emergency=new Tzhibao();
		$nums = $emergency->count();
        $page_size = 10; //每页显示的条数
        $sub_pages = 8; //每次显示的页数
        $pageCurrent = $this->_request->getParam('page');
        $links = new SubPages($page_size, $nums, $pageCurrent, $sub_pages, $this->_request->getBasePath() . $this->getModuleName() . '/' . $this->getControllerName() . '/' . $this->getActionName() . '/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = $page_size * ($pageCurrent - 1); //计算开始记录数
        $emergency->limit($startnum, $page_size);
		$shoushang_nums=0;
		$die_nums=0;
		
		$emergency->find();
		$result=array();
		$index=0;
		while($emergency->fetch()){
			$result[$index]['fasheng_time']=date("Y-m-d",$emergency->fasheng_time);
			$result[$index]['adress']=$emergency->adress;
			$result[$index]['shijian']=$emergency->shijian;
			$result[$index]['shoushang_nums']=$emergency->shoushang_nums;
			$result[$index]['die_nums']=$emergency->die_nums;
			$shoushang_nums+=$emergency->shoushang_nums;
			$die_nums+=$emergency->die_nums;
			if($emergency->leixing==1){
				$leixing="等待救援";
			}
			if($emergency->leixing==2){
				$leixing="救援中";
			}
			if($emergency->leixing==3){
				$leixing="已经救援";
			}
			$result[$index]['leixing']=$leixing;
			$index++;
		}
		$this->view->shoushang_nums=$shoushang_nums;
		$this->view->die_nums=$die_nums;
		$this->view->nums=$nums;
		$this->view->record_count = $index; //记录数
		$out = $links->subPageCss2(); //获取显示样式，$out在smarty中将输出如下：
        $this->view->page = $out; //显示分页
        $this->view->pageCurrent = $pageCurrent; //当前页
		$this->view->emergency=$result;
		$this->view->display("list.html");
	}
    

}