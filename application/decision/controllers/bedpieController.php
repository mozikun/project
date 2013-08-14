<?php
   /**
    * 用于图形
    * author:CT
    * created:2013.4.9
    *
    */
  class decision_bedpieController extends  controller 
  {
  	 public function init()
  	 {
  	 	ini_set('max_execution_time','1200');
  	 	require_once __SITEROOT.'library/privilege.php';
  	 	require_once __SITEROOT.'library/custom/comm_function.php';
  	 	require_once __SITEROOT.'library/Models/organization.php';
  	 	require_once __SITEROOT.'library/Models/region.php';
 		require_once __SITEROOT.'library/Models/chs_center.php';
 	    require_once __SITEROOT.'library/Models/org_ext_1.php';
 	    $this->view->basePath = __BASEPATH;
  	 }
  	 public function indexAction()
  	 {
  	 	$this->end_year = date("Y",time())+1;
  	 	//取得当前地区
  		$login_regionid = $this->user['region_id'];
  		$param = $this->_request->getParam('region_id');
  		$region_id = empty($param)?$login_regionid:$param;
  		//顶部导航
  		$lone_region = new Tregion();
  		$lone_region->whereAdd("id='$region_id'");
  		$lone_region->find(true);
  		//取得path
  		$path_array = explode(',',$lone_region->region_path);
  		$path_number = count($path_array);
  		if($path_number<7)
  		{
  			unset($path_array[0]);
  			$url = '';
  			foreach ($path_array as $k=>$v)
  			{
  				$url_path =  new Tregion();
  				$url_path->whereAdd("id='$v'");
  				$url_path->find(true);
  				if($url_path->id==$region_id)
  				{
  					$url.= '<a href="'.__BASEPATH.'decision/bedpie/index/region_id/'.$url_path->id.'"><font color="red">'.$url_path->zh_name.'</font><a>';
  				}
  				else 
  				{
  					$url.= '<a href="'.__BASEPATH.'decision/bedpie/index/region_id/'.$url_path->id.'">'.$url_path->zh_name.'<a>&nbsp;&nbsp;&nbsp;&nbsp;>';
  				}
  				$url_path->free_statement();
  			}
  		}
  		$this->view->url = $url;
		$region = new Tregion();
		$region->whereAdd("p_id='$region_id'");
		$region->find();
		$region_array = array();
		$region_count = 0;
		while ($region->fetch())
		{
			$region_array[$region_count]['zh_name'] = $region->zh_name;
			$region_array[$region_count]['id'] = $region->id;
			$region_level = count(explode(',',$region->region_path));
			$region_array[$region_count]['region_level'] = $region_level;//地区级次 为了不显示下边的村委会
			$region_count++;
		}
		$region->free_statement();
	    $this->view->region_array = $region_array;
	    $this->view->end_year = $this->end_year;
		$this->view->display('index.html');
  	 }
  	 public function imageAction()
  	 {
  	 	$region_id = $this->_request->getParam("id");
  	 	$end_time = $this->_request->getParam("end_time");
  	 	$y = $this->_request->getParam("y");//控制最近几年的统计图
  	 	$year_array = array(2=>'近二年',3=>'近三年',4=>'近四年',5=>'近五年',6=>'近六年');
  	 	$this->view->year_array = $year_array;
  	 	//取得地区名称
  		$region_lone = new Tregion();
  		$region_lone->whereAdd("id=$region_id");
  		$region_lone->find(true);
  	 	$this->view->region_id = $region_id;
  	 	$this->view->end_time = $end_time;
  	 	$this->view->zh_name = $region_lone->zh_name;
  	 	$this->view->p_id = $region_lone->p_id;
  	 	$this->view->y = empty($y)?3:$y;
  	 	$this->view->display('image.html');
  	 }
  	public function getdataAction()
  	{
  		$y = $this->_request->getParam('y');
  		$o = empty($y)?3:$y;
  		//取得一个地区下的每年的所有机构的床位数
  		$region_id = $this->_request->getParam('region_id');
  		$end_time = $this->_request->getParam('end_time');
  	    $colum_array = array('bed_number'=>'编制床位数','poverty_beds'=>'扶贫床位数','observation_bed'=>'观察床','bed_allnumber'=>'实有床位数总数');
  	    $row = array();
  	    $j = 0;
  	     foreach ($colum_array as $k=>$v)
  	     {
  	     	$region =  new Tregion();
  	     	$region->whereAdd("id='$region_id'");
  	     	$region->find(true);
  	     	$r=0;
	     	for($i=$o;$i>0;$i--)//近3年内的数据
	  	    {
  	     		$temp=0;
                $year = $end_time-$i;//获得年限
  	     		//取每个地区下边的机构
  	     		$organization = new Torganization();
  	     		//$organization->whereAdd("region_path like '$region->region_path%'");
  	     		$organization->whereAdd("INSTR(organization.region_path,'$region->region_path')>0");
  	     		$organization->find();
  	     		$bed_number = 0;//每个床位数
  	     		while ($organization->fetch())
  	     		{	
                    $org_ext_1 =  new Torg_ext_1();
//                    $org_ext_1->whereAdd("year=$year");
//                    $org_ext_1->whereAdd("id=$organization->id");
//                    $org_ext_1->find(true);
                    $org_ext_1->query("select * from org_ext_1 where year=$year and id=$organization->id");
                    $org_ext_1->fetch();
                    $bed_number_lone = empty($org_ext_1->$k)?0:$org_ext_1->$k;
                    $bed_number+=$bed_number_lone;
	  	     	}
     			$organization->free_statement();
     			$row['x'][$r] = $year;
     			$row[$j]['archive'][$r] = $bed_number;
     			$r++;
  	     	}
  	     	$row[$j]['axisname'] = $v;
  	     	$region->free_statement();
  	     	$j++;
  	     }
  	    // print_r($row);
  	     $x_array = $row['x'];//横轴为年份
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
  	   // print_r($data);
  	  echo xml_draw_line($data,$x_array,"床数","床数","床位信息",500,500);
  	}
  }
?>