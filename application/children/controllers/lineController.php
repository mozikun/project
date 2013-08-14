<?php
/**
 * author:CT
 * created:2013.5.20
 *
 */
   class children_lineController extends controller
   {
  	 public function init()
  	 {
  	 	require_once __SITEROOT.'library/privilege.php';
  		require_once __SITEROOT.'library/Models/individual_core.php';
  		require_once __SITEROOT.'library/Models/child_physical.php';
  		require_once __SITEROOT.'library/Models/child_physical_two.php';
  		require_once __SITEROOT.'library/Models/child_physical_age_three.php';
  		require_once __SITEROOT.'library/Models/region.php';
  		require_once __SITEROOT.'library/Models/organization.php';
  		require_once __SITEROOT.'library/custom/comm_function.php';
 		$this->view->basePath  = __BASEPATH;
  	 }
  	 public function indexAction()
  	 { 	
  	 	require_once __SITEROOT."/library/custom/pager.php";//分页类
  	 	$display_sign =  $this->_request->getParam('display_sign')?$this->_request->getParam('display_sign'):'none';
		$this->view->display_sign = $display_sign;
  	 	$table_array = array('child_physical','child_physical_two','child_physical_age_three');
  	 	$search = array();	
  	 	/*$search['start_time'] = $this->_request->getParam('start_time');
  	 	$search['end_time'] = $this->_request->getParam('end_time'); 	
  	 	$start_time = strtotime($search['start_time']);
  	 	$end_time   = strtotime($search['end_time']);*/
  	 	$search['identity_number'] = trim($this->_request->getParam('identity_number'));
  	 	//管辖范围
  	 	$org_region_domain=$this->user['current_region_path_domain'];
  	 	$region_path_domain = explode('|',$org_region_domain);
  	 	$select_where = '';
  	 	foreach ($region_path_domain as $k=>$v)
  	 	{
  	 		$select_where.=" individual_core.region_path like '$v%' or";
  	 	}
  	 	$select_where = rtrim($select_where,'or');
  	 	
  	 	//处理时间搜索
  	 	$table_0_where='';
  	 	$table_1_where='';
  	 	$table_2_where='';
  	 	/*
  	 	if(!empty($search['start_time'])&&!empty($search['end_time']))
  	 	{
  	 		$table_0_where = " where ".$table_array[0].".created >=$start_time and ".$table_array[0].".created<=$end_time";
  	 		$table_1_where = " where ".$table_array[1].".created >=$start_time and ".$table_array[1].".created<=$end_time";
  	 		$table_2_where = " where ".$table_array[2].".created >=$start_time and ".$table_array[2].".created<=$end_time";
  	 	}
  	 	elseif (!empty($search['start_time'])) 
  	 	{
  	 		$table_0_where = " where ".$table_array[0].".created >=$start_time";
  	 		$table_1_where = " where ".$table_array[1].".created >=$start_time";
  	 		$table_2_where = " where ".$table_array[2].".created >=$start_time";
  	 	}elseif (!empty($search['end_time']))
  	 	{
  	 		$table_0_where = " where ".$table_array[0].".created <=$end_time";
  	 		$table_1_where = " where ".$table_array[1].".created <=$end_time";
  	 		$table_2_where = " where ".$table_array[2].".created <=$end_time";
  	 	}*/
  	 	$select_identity = '';
  	 	if(!empty($search['identity_number']))
  	 	{
  	 		$select_identity = " and individual_core.identity_number='".$search['identity_number']."'";
  	 	}
  	 	$child_physical = new Tchild_physical();
  	 	$child_physical->query("select count(id) as cou from (select child_physical.id from child_physical $table_0_where union select child_physical_two.id from child_physical_two $table_1_where union select child_physical_age_three.id from child_physical_age_three $table_2_where) where id in (select individual_core.uuid from individual_core where $select_where $select_identity)");
  	 	$child_physical->fetch();
  	 	$nums = $child_physical->cou;
  	 	$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'children/line/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$endrow = __ROWSOFPAGE+$startnum;
		$child_physical_list = new Tchild_physical();
		$child_physical_list->query("select * from (select a.*, rownum rn from (select * from (select child_physical.id from child_physical $table_0_where union select child_physical_two.id from child_physical_two $table_1_where union select child_physical_age_three.id from child_physical_age_three $table_2_where) where id in (select individual_core.uuid from individual_core where $select_where $select_identity)) a where rownum <= $endrow)where rn >= $startnum");
		$row =  array();
		$count = 0;
		while($child_physical_list->fetch())
		{
			//var_dump($child_physical_list->id);
			$individual_core = new Tindividual_core();
			$individual_core->whereAdd("uuid='$child_physical_list->id'");
			$individual_core->find(true);
			//$individual_core->whereAdd("");
			$row[$count]['name'] = $individual_core->name;
			$row[$count]['identity_number'] = $individual_core->identity_number;
			$individual_core->free_statement();
			$row[$count]['id'] = $child_physical_list->id;
			$count++;
		}	
  	 	$out = $links->subPageCss2();
  	 	$this->view->assign("pager",$out);
  	 	$this->view->row = $row;
  	 	$this->view->pagecurrent = $pageCurrent;
  	 	$this->view->display("index.html");
  	 }
  	 
  	 
  	 public function imageAction()
  	 {
  	 	$id = $this->_request->getParam("id");	
  	 	$tag = $this->_request->getParam("y");//指标
  	 	$page = $this->_request->getParam("page");//指标
  	 	$tag = empty($tag)?1:$tag;
  	 	$this->view->tag = $tag;
  	 	$this->view->page = $page;
  	 	//echo $id;
  	 	$this->view->id = $id;
  	 	if(!empty($id))
  	 	{

	  	 	$individual_core  = new Tindividual_core();
	  	 	$individual_core->whereAdd("uuid='$id'");
	  	 	$individual_core->find(true);
	  	 	$name = $individual_core->name;
	  	 	$this->view->name = $name;
	  	 	$gender_array = array('1','2');
	  	 	$gender_array_explan = array('1'=>'男','2'=>'女');
	  	 	if(in_array($individual_core->sex,$gender_array))
	  	 	{
	  	 		$this->view->gender_explain = $gender_array_explan[$individual_core->sex];
	  	 		$this->view->gender = $individual_core->sex;
	  	 	}
	  	 	else 
	  	 	{
	  	 		$this->view->gender_explain = '未知性别';
	  	 		$this->view->gender = '';
	  	 	}
	  	 	$select_array = array('1'=>'身高','2'=>'体重','3'=>'头围');
	  	 	$this->view->select_array = $select_array;
  	 	}
  	 	$this->view->display('image.html');
  	 }
  	 public function getdataAction()
  	 {
  	 	$id = $this->_request->getParam("id");
  	 	$gender = $this->_request->getParam("gender");
  	 	$y = $this->_request->getParam("y");
  	 	if(!empty($id)&&!empty($gender))
  	 	{
  	 		//凑数组   
	  	    	if($gender==1)
	  	    	{
	  	    		if($y==1)
	  	    		{
	  	    		    $zws = array(1=>'56.9',2=>'64.3',3=>'70.8',4=>'73.7',5=>'79.3',6=>'85.8',7=>'92.1',8=>'97.1',9=>'101.4',10=>'108.2',11=>'115.7',12=>'122.4');//因为有些值没有填写所以这里取中位数的值来填充
	  	    		}
	  	    		elseif($y==2)
	  	    		{
	  	    			$zws = array(1=>'4.51',2=>'6.70',3=>'8.41',4=>'9.05',5=>'10.05',6=>'11.29',7=>'12.54',8=>'13.64',9=>'14.65',10=>'16.64',11=>'18.98',12=>'21.26');
	  	    		}
	  	    	    elseif($y==3)
	  	    	    {
                        $zws = array(1=>'36.9',2=>'40.5',3=>'43.6',4=>'44.8',5=>'46.4',6=>'47.6',7=>'48.4',8=>'49.1',9=>'49.6',10=>'50.3',11=>'51.0',12=>'51.5');
	  	    	    }
	  	    		//实测数据
	  	    		$str = '';
	  	    		for ($i=1;$i<=4;$i++)
	  	    		{
		  	    		$child_physical = new Tchild_physical();//0-1岁
		  	    		$child_physical->whereAdd("id='$id'");
		  	    		$child_physical->whereAdd("project='$i'");
		  	    		$child_physical->find(true);
		  	    		if($y==1)
		  	    		{
		  	    			if(empty($child_physical->height))
		  	    			{
		  	    				$str.=$zws[$i].'|';//由于部分数据未填写所以取中位数来替代
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->height.'|';
		  	    			}
		  	    		}
		  	    		elseif($y==2)
		  	    		{
		  	    			if(empty($child_physical->weight))
		  	    			{
		  	    				$str.=$zws[$i].'|';
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->weight.'|';
		  	    			}
		  	    		}
		  	    		elseif($y==3)
		  	    		{
		  	    			if(empty($child_physical->head_size))
		  	    			{
		  	    				$str.=$zws[$i].'|';
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->head_size.'|';
		  	    			}
		  	    		}
	  	    		}
	  	    		for ($i=5;$i<=8;$i++)
	  	    		{
		  	    		$child_physical = new Tchild_physical_two();
		  	    		$child_physical->whereAdd("id='$id'");
		  	    		$child_physical->whereAdd("project='$i'");
		  	    		$child_physical->find(true);
		  	    		if($y==1)
		  	    		{
		  	    			if(empty($child_physical->height))
		  	    			{
		  	    				$str.=$zws[$i].'|';
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->height.'|';
		  	    			}
		  	    		}
		  	    		elseif($y==2)
		  	    		{
		  	    			if(empty($child_physical->weight))
		  	    			{
		  	    				$str.=$zws[$i].'|';
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->weight.'|';
		  	    			}
		  	    		}
		  	    		elseif($y==3)
		  	    		{
		  	    			if(empty($child_physical->head_size))
		  	    			{
		  	    				$str.=$zws[$i].'|';
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->head_size.'|';
		  	    			}
		  	    		}
	  	    		}
	  	    		for ($i=9;$i<=12;$i++)
	  	    		{
		  	    		$child_physical = new Tchild_physical_age_three();
		  	    		$child_physical->whereAdd("id='$id'");
		  	    		$child_physical->whereAdd("age='$i'");
		  	    		$child_physical->find(true);
		  	    		if($y==1)
		  	    		{
		  	    			if(empty($child_physical->height))
		  	    			{
		  	    				$str.=$zws[$i].'|';
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->height.'|';
		  	    			}
		  	    		}
		  	    		elseif($y==2)
		  	    		{
		  	    			if(empty($child_physical->weight))
		  	    			{
		  	    				$str.=$zws[$i].'|';
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->weight.'|';
		  	    			}
		  	    		}
		  	    		elseif($y==3)
		  	    		{
		  	    			if(empty($child_physical->head_size))
		  	    			{
		  	    				$str.=$zws[$i].'|';
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->head_size.'|';
		  	    			}
		  	    		}
	  	    		}
	  	    		$str = rtrim($str,'|');
	  	    		$row[7]['archive'] = explode('|',$str);
	  	    		if($y==1)
	  	    		{
	  	    		    $row[7]['axisname'] = '实测身高';
	  	    		}
	  	    		elseif($y==2)
	  	    		{
	  	    			$row[7]['axisname'] = '实测体重';
	  	    		}
	  	    	    elseif($y==3)
	  	    	    {
	  	    	    	$row[7]['axisname'] = '实测头围';
	  	    	    }
	  	    	    
	  	    		//男孩 身高
	  	    		if($y==1)
	  	    		{
		  	    		$row[0]['archive'] = array('48.7','55.3','61.4','63.9','68.6','73.6','78.3','82.4','86.3','92.5','98.7','104.1');
		  	    		$row[0]['axisname'] = '-3SD';
		  	    		$row[1]['archive'] = array('50.7','57.5','63.7','66.3','71.2','76.6','81.6','85.9','90.0','96.3','102.8','108.6');
		  	    		$row[1]['axisname'] = '-2SD';
		  	    		$row[2]['archive'] = array('52.7','59.7','66.0','68.7','73.8','79.6','85.1','89.6','93.7','100.2','107.0','113.1');
		  	    		$row[2]['axisname'] = '-1SD';
		  	    		$row[3]['archive'] = array('54.8','62.0','68.4','71.2','76.5','82.7','88.5','93.3','97.5','104.1','111.3','117.7');
		  	    		$row[3]['axisname'] = '中位数';
		  	    		$row[4]['archive'] = array('56.9','64.3','70.8','73.7','79.3','85.8','92.1','97.1','101.4','108.2','115.7','122.4');
		  	    		$row[4]['axisname'] = '+1SD';
		  	    		$row[5]['archive'] = array('59.0','66.6','73.3','76.3','82.1','89.1','95.8','101.0','105.3','112.3','120.1','127.2');
		  	    		$row[5]['axisname'] = '+2SD';
		  	    		$row[6]['archive'] = array('61.2','69.0','75.8','78.9','85.0','92.4','99.5','105.0','109.4','116.5','124.7','132.1');
		  	    		$row[6]['axisname'] = '+3SD';
	  	    		}
	  	    		elseif($y==2)
	  	    		{
	  	    			$row[0]['archive'] = array('3.09','4.69','5.97','6.46','7.21','8.13','9.06','9.86','10.61','12.01','13.50','14.74');
		  	    		$row[0]['axisname'] = '-3SD';
		  	    		$row[1]['archive'] = array('3.52','5.29','6.70','7.23','8.06','9.07','10.09','10.97','11.79','13.35','15.06','16.56');
		  	    		$row[1]['axisname'] = '-2SD';
		  	    		$row[2]['archive'] = array('3.99','5.97','7.51','8.09','9.00','10.12','11.24','12.22','13.13','14.88','16.87','18.71');
		  	    		$row[2]['axisname'] = '-1SD';
		  	    		$row[3]['archive'] = array('4.51','6.70','8.41','9.05','10.05','11.29','12.54','13.64','14.65','16.64','18.98','21.26');
		  	    		$row[3]['axisname'] = '中位数';
		  	    		$row[4]['archive'] = array('5.07','5.07','9.41','10.11','11.23','12.61','14.01','15.24','16.39','18.67','21.46','24.32');
		  	    		$row[4]['axisname'] = '+1SD';
		  	    		$row[5]['archive'] = array('5.67','8.40','10.50','11.29','12.54','14.09','15.67','17.06','18.37','21.01','24.38','28.03');
		  	    		$row[5]['axisname'] = '+2SD';
		  	    		$row[6]['archive'] = array('6.33','9.37','11.72','12.60','14.00','15.75','17.54','19.13','20.64','23.73','27.85','32.57');
		  	    		$row[6]['axisname'] = '+3SD';
	  	    		}
	  	    		elseif($y==3)
	  	    		{
	  	    			$row[0]['archive'] = array('33.3','36.7','39.8','41.0','42.6','43.7','44.6','45.3','45.7','46.5','47.2','47.8');
		  	    		$row[0]['axisname'] = '-3SD';
		  	    		$row[1]['archive'] = array('34.5','37.9','39.8','41.0','42.2','43.8','45.0','45.9','46.5','47.0','47.8','48.4');
		  	    		$row[1]['axisname'] = '-2SD';
		  	    		$row[2]['archive'] = array('35.7','39.2','42.3','43.5','45.1','46.3','47.1','47.8','48.3','49.0','49.7','50.2');
		  	    		$row[2]['axisname'] = '-1SD';
		  	    		$row[3]['archive'] = array('36.9','40.5','43.6','44.8','46.4','47.6','48.4','49.1','49.6','50.3','51.0','51.5');
		  	    		$row[3]['axisname'] = '中位数';
		  	    		$row[4]['archive'] = array('38.2','41.8','44.9','46.1','47.7','48.9','49.8','50.4','50.9','51.6','52.2','52.8');
		  	    		$row[4]['axisname'] = '+1SD';
		  	    		$row[5]['archive'] = array('39.4','43.2','46.3','47.5','49.1','50.2','51.1','51.7','52.2','52.9','53.6','54.1');
		  	    		$row[5]['axisname'] = '+2SD';
		  	    		$row[6]['archive'] = array('40.7','44.6','47.7','48.9','50.5','51.6','52.5','53.1','53.5','54.2','54.9','55.4');
		  	    		$row[6]['axisname'] = '+3SD';
	  	    		}
	  	    	}
	  	    	else 
	  	    	{
	  	    		//女孩数据
	  	    		 if($y==1)
	  	    		{
	  	    		    $zws = array(1=>'53.7',2=>'60.6',3=>'66.8',4=>'69.6',5=>'75.0',6=>'81.5',7=>'87.2',8=>'92.1',9=>'96.3',10=>'103.1',11=>'110.2',12=>'116.6');//因为有些值没有填写所以这里取中位数的值来填充
	  	    		}
	  	    		elseif($y==2)
	  	    		{
	  	    			$zws = array(1=>'4.20',2=>'6.13',3=>'7.77',4=>'8.41',5=>'9.40',6=>'10.65',7=>'11.92',8=>'13.05',9=>'14.13',10=>'16.17',11=>'18.26',12=>'20.37');
	  	    		}
	  	    	    elseif($y==3)
	  	    	    {
                        $zws = array(1=>'36.2',2=>'39.5',3=>'42.4',4=>'43.6',5=>'45.1',6=>'46.4',7=>'47.3',8=>'48.0',9=>'48.5',10=>'49.4',11=>'50.0',12=>'50.5');
	  	    	    }
	  	    		//实测数据
	  	    		$str = '';
	  	    		for ($i=1;$i<=4;$i++)
	  	    		{
		  	    		$child_physical = new Tchild_physical();//0-1岁
		  	    		$child_physical->whereAdd("id='$id'");
		  	    		$child_physical->whereAdd("project='$i'");
		  	    		$child_physical->find(true);
		  	    		if($y==1)
		  	    		{
		  	    			if(empty($child_physical->height))
		  	    			{
		  	    				$str.=$zws[$i].'|';//由于部分数据未填写所以取中位数来替代
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->height.'|';
		  	    			}
		  	    		}
		  	    		elseif($y==2)
		  	    		{
		  	    			if(empty($child_physical->weight))
		  	    			{
		  	    				$str.=$zws[$i].'|';
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->weight.'|';
		  	    			}
		  	    		}
		  	    		elseif($y==3)
		  	    		{
		  	    			if(empty($child_physical->head_size))
		  	    			{
		  	    				$str.=$zws[$i].'|';
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->head_size.'|';
		  	    			}
		  	    		}
	  	    		}
	  	    		for ($i=5;$i<=8;$i++)
	  	    		{
		  	    		$child_physical = new Tchild_physical_two();
		  	    		$child_physical->whereAdd("id='$id'");
		  	    		$child_physical->whereAdd("project='$i'");
		  	    		$child_physical->find(true);
		  	    		if($y==1)
		  	    		{
		  	    			if(empty($child_physical->height))
		  	    			{
		  	    				$str.=$zws[$i].'|';
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->height.'|';
		  	    			}
		  	    		}
		  	    		elseif($y==2)
		  	    		{
		  	    			if(empty($child_physical->weight))
		  	    			{
		  	    				$str.=$zws[$i].'|';
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->weight.'|';
		  	    			}
		  	    		}
		  	    		elseif($y==3)
		  	    		{
		  	    			if(empty($child_physical->head_size))
		  	    			{
		  	    				$str.=$zws[$i].'|';
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->head_size.'|';
		  	    			}
		  	    		}
	  	    		}
	  	    		for ($i=9;$i<=12;$i++)
	  	    		{
		  	    		$child_physical = new Tchild_physical_age_three();
		  	    		$child_physical->whereAdd("id='$id'");
		  	    		$child_physical->whereAdd("age='$i'");
		  	    		$child_physical->find(true);
		  	    		if($y==1)
		  	    		{
		  	    			if(empty($child_physical->height))
		  	    			{
		  	    				$str.=$zws[$i].'|';
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->height.'|';
		  	    			}
		  	    		}
		  	    		elseif($y==2)
		  	    		{
		  	    			if(empty($child_physical->weight))
		  	    			{
		  	    				$str.=$zws[$i].'|';
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->weight.'|';
		  	    			}
		  	    		}
		  	    		elseif($y==3)
		  	    		{
		  	    			if(empty($child_physical->head_size))
		  	    			{
		  	    				$str.=$zws[$i].'|';
		  	    			}
		  	    			else 
		  	    			{
		  	    				$str.=$child_physical->head_size.'|';
		  	    			}
		  	    		}
	  	    		}
	  	    		$str = rtrim($str,'|');
	  	    		$row[7]['archive'] = explode('|',$str);
	  	    		if($y==1)
	  	    		{
	  	    		    $row[7]['axisname'] = '实测身高';
	  	    		}
	  	    		elseif($y==2)
	  	    		{
	  	    			$row[7]['axisname'] = '实测体重';
	  	    		}
	  	    	    elseif($y==3)
	  	    	    {
	  	    	    	$row[7]['axisname'] = '实测头围';
	  	    	    }
	  	    	    
	  	    		//女孩 身高
	  	    		if($y==1)
	  	    		{
		  	    		$row[0]['archive'] = array('47.9','54.2','60.1','62.5','67.2','72.8','77.3','81.4','85.4','91.7','97.8','103.2');
		  	    		$row[0]['axisname'] = '-3SD';
		  	    		$row[1]['archive'] = array('49.8','56.3','62.3','64.8','69.7','75.6','80.5','84.8','88.9','95.4','101.8','107.6');
		  	    		$row[1]['axisname'] = '-2SD';
		  	    		$row[2]['archive'] = array('51.7','58.4','64.5','67.2','72.3','78.5','83.8','88.4','92.5','99.2','106.0','112.0');
		  	    		$row[2]['axisname'] = '-1SD';
		  	    		$row[3]['archive'] = array('53.7','60.6','66.8','69.6','75.0','81.5','87.2','92.1','96.3','103.1','110.2','116.6');
		  	    		$row[3]['axisname'] = '中位数';
		  	    		$row[4]['archive'] = array('55.7','62.8','69.1','72.1','77.7','84.6','90.7','95.9','100.1','107.0','114.5','121.2');
		  	    		$row[4]['axisname'] = '+1SD';
		  	    		$row[5]['archive'] = array('57.8','65.1','71.5','74.7','80.5','87.7','94.3','99.8','104.1','111.1','118.9','126.0');
		  	    		$row[5]['axisname'] = '+2SD';
		  	    		$row[6]['archive'] = array('59.9','67.5','74.0','77.3','83.4','91.0','98.0','103.8','108.1','115.3','123.4','130.8');
		  	    		$row[6]['axisname'] = '+3SD';
	  	    		}
	  	    		elseif($y==2)
	  	    		{
	  	    			$row[0]['archive'] = array('2.98','4.40','5.64','6.13','6.87','7.79','8.70','9.48','10.23','11.62','12.93','14.11');
		  	    		$row[0]['axisname'] = '-3SD';
		  	    		$row[1]['archive'] = array('3.33','4.90','6.26','6.79','7.61','8.63','9.64','10.52','11.36','12.93','14.44','15.87');
		  	    		$row[1]['axisname'] = '-2SD';
		  	    		$row[2]['archive'] = array('3.74','5.47','6.96','7.55','8.45','9.57','10.70','11.70','12.65','14.44','16.20','17.94');
		  	    		$row[2]['axisname'] = '-1SD';
		  	    		$row[3]['archive'] = array('4.20','6.13','7.77','8.41','9.40','10.65','11.92','13.05','14.13','16.17','18.26','20.37');
		  	    		$row[3]['axisname'] = '中位数';
		  	    		$row[4]['archive'] = array('4.74','6.87','8.68','9.39','10.48','11.88','13.31','14.60','15.83','18.19','20.66','23.27');
		  	    		$row[4]['axisname'] = '+1SD';
		  	    		$row[5]['archive'] = array('5.35','7.73','9.73','10.51','11.73','13.29','14.92','16.39','17.81','20.54','23.50','26.74');
		  	    		$row[5]['axisname'] = '+2SD';
		  	    		$row[6]['archive'] = array('6.05','8.71','10.93','11.80','13.15','14.90','16.77','18.47','20.10','23.30','26.87','30.94');
		  	    		$row[6]['axisname'] = '+3SD';
	  	    		}
	  	    		elseif($y==3)
	  	    		{
	  	    			$row[0]['archive'] = array('32.6','36.0','38.9','40.1','41.5','42.8','43.6','44.3','44.8','45.7','46.3','46.8');
		  	    		$row[0]['axisname'] = '-3SD';
		  	    		$row[1]['archive'] = array('33.8','37.1','40.0','41.2','42.7','43.9','44.8','45.5','46.0','46.9','47.5','48.0');
		  	    		$row[1]['axisname'] = '-2SD';
		  	    		$row[2]['archive'] = array('35.0','38.3','41.2','42.4','43.9','45.1','46.0','46.7','47.3','48.1','48.7','49.2');
		  	    		$row[2]['axisname'] = '-1SD';
		  	    		$row[3]['archive'] = array('36.2','39.5','42.4','43.6','45.1','46.4','47.3','48.0','48.5','49.4','50.0','50.5');
		  	    		$row[3]['axisname'] = '中位数';
		  	    		$row[4]['archive'] = array('37.4','40.8','43.7','44.9','46.5','47.7','48.6','49.3','49.8','50.6','51.3','51.8');
		  	    		$row[4]['axisname'] = '+1SD';
		  	    		$row[5]['archive'] = array('38.6','42.1','45.1','46.3','47.8','49.1','50.0','50.7','51.2','52.0','52.6','53.1');
		  	    		$row[5]['axisname'] = '+2SD';
		  	    		$row[6]['archive'] = array('39.9','43.4','46.5','47.7','49.3','50.5','51.4','52.1','52.6','53.3','53.9','54.4');
		  	    		$row[6]['axisname'] = '+3SD';
	  	    		}   
	  	    	}
  	 		$row['x'] =array(1,3,6,8,12,18,24,30,36,48,60,72);
  	 		$x_array = $row['x'];//横轴为月份
	  	     //开始构造数据
	  	    unset($row['x']);
	  	    $data = array();
	  	    foreach($row as $k=>$v)
	  	    {
	  	    	foreach ($v['archive'] as $h=>$f)
	  	    	{
	  	    		$data[$k][$h] = $f;
	  	    	}
	  	    	$data[$k]['axisname'] = $v['axisname'];
	  	    } 
	  	    if($y==1)
    		{
    		    $measure = 'cm';
    		    $bz = '身高';
    		    $title = '身高信息';
    		}
    		elseif($y==2)
    		{
    			$measure = 'kg';
    		    $bz = '体重';
    		    $title = '体重信息';
    		}
    	    elseif($y==3)
    	    {
    	    	$measure = 'cm';
    		    $bz = '头围';
    		    $title = '头围信息';
    	    }
	  	  echo xml_draw_line_children($data,$x_array,$bz,$measure,$title,1000,500);
  	 	}
  	 }
   }
?>