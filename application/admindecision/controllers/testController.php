<?php
class admindecision_testController extends controller{
	public function  init(){
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->basePath = $this->_request->getBasePath();
	}
	public function indexAction(){
		$region=$this->_request->getParam('region');
		$this->view->region=$region;
	}
	public function barAction()
	{
		$data[0]=array("20");
		$data[0]['axisname']="雨城区";
		$data[1]=array("31");
		$data[1]['axisname']="名山县";
		$data[2]=array("41");
		$data[2]['axisname']="荥经县";
		$data[3]=array("81");
		$data[3]['axisname']="汉源县";
		$data[4]=array("11");
		$data[4]['axisname']="石棉县";
		$data[5]=array("61");
		$data[5]['axisname']="天全县";
		$data[6]=array("21");
		$data[6]['axisname']="芦山县";
		$data[7]=array("55");
		$data[7]['axisname']="宝兴县";
		$x_array=array("2011-09-23");
		echo xml_draw_3d_bar($data,$x_array,"人数","人","测试柱状图","3d column",450,250);
		exit;
	}
	public function pieAction()
	{
		$data[0]=array("20");
		$data[0]['axisname']="雨城区";
		$data[1]=array("31");
		$data[1]['axisname']="名山县";
		$data[2]=array("41");
		$data[2]['axisname']="荥经县";
		$data[3]=array("81");
		$data[3]['axisname']="汉源县";
		$data[4]=array("11");
		$data[4]['axisname']="石棉县";
		$data[5]=array("61");
		$data[5]['axisname']="天全县";
		$data[6]=array("21");
		$data[6]['axisname']="芦山县";
		$data[7]=array("55");
		$data[7]['axisname']="宝兴县";
		$x_array=array("2011-09-21","2011-09-22","2011-09-23","2011-09-24","2011-09-25","2011-09-26");
		echo xml_draw_3d_pie($data,$x_array,"人数","人","测试饼形图",400,250);
		exit;
	}
	public function lineAction()
	{
		$data[0]=array("20","31","45","12","98","13");
		$data[0]['axisname']="雨城区";
		$data[1]=array("34","41","25","52","18","93");
		$data[1]['axisname']="名山县";
		$data[2]=array("42","11","95","22","48","63");
		$data[2]['axisname']="荥经县";
		$data[3]=array("10","61","55","32","58","23");
		$data[3]['axisname']="汉源县";
		$data[4]=array("24","41","75","62","28","83");
		$data[4]['axisname']="石棉县";
		$data[5]=array("14","21","65","72","38","73");
		$data[5]['axisname']="天全县";
		$data[6]=array("110","61","95","22","38","13");
		$data[6]['axisname']="芦山县";
		$data[7]=array("30","31","75","32","112","113");
		$data[7]['axisname']="宝兴县";
		$x_array=array("2011-09-21","2011-09-22","2011-09-23","2011-09-24","2011-09-25","2011-09-26");
		echo xml_draw_line($data,$x_array,"人数","人","测试线性图",450,250);
		exit;
	}
}