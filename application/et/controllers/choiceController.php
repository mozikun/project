<?php
   /**
    * 
    * 
    */
  class et_choiceController extends controller 
  {
  	 public function init()
  	 {
        require_once (__SITEROOT . 'library/privilege.php');
  	 	require_once __SITEROOT . "library/Models/individual_core.php";
  	 	require_once __SITEROOT . "library/Models/region.php";
  	 	require_once __SITEROOT . "library/Models/staff_core.php";
  	 	require_once __SITEROOT . '/library/custom/comm_function.php';
  	 	require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
  	 	$this->view->basePath = $this->_request->getBasePath();
  	 }
  	 public function indexAction()
  	 {
  	 	require_once __SITEROOT."library/custom/pager.php";
  	 	require_once __SITEROOT.'library/data_arr/arrdata.php';
//  	 	$table_comment  = $this->_request->getParam('table_comment');
//  	 	$this->view->table_comment = $table_comment;
  	 	$search =  array();
  	 	$time   = time();
  	 	//获取时间
  	 	$start_time=$this->_request->getParam('starts_time');
  	 	$end_time=$this->_request->getParam('ends_time');
  	 	$search['start_time']=$start_time;
  	 	$search['end_time']=$end_time;
  	 	//获取地区的信息
  	 	$region_id =  $this->user['region_id'];
  	 	$this->view->region_id   = $region_id;
  	 	$this->view->region_p_id = $region_id;
  	 	$search['region_p_id']   = $this->_request->getParam('region_p_id');
  	 	$current_id =  empty($search['region_p_id'])?$region_id:$search['region_p_id'];//地区的父ID
        $region_path_domain = get_region_path(1, $current_id);
        //获取年龄
        $search['age_start'] = intval($this->_request->getParam('age_start'))?intval($this->_request->getParam('age_start')):0; //年龄段
        $search['age_end']   = (intval($this->_request->getParam('age_end'))>=$search['age_start'])?intval($this->_request->getParam('age_end')) : '';
        $search['sex']       = $this->_request->getParam('sex');
        $search['name']		 =trim($this->_request->getParam('name'));
        $search['identity_number']=trim($this->_request->getParam('identity_number'));
        //echo $region_path_domain;
  	 	$basepath = $this->_request->getBasePath();	 	
  	 	require_once __SITEROOT . "/library/custom/pager.php";  	 	
  	 	$searchtable = $this->_request->getParam('chiocetable');
  	 	$search['chiocetable'] = $searchtable;
  	 	$where = '';   
  	 	$wheres= '';
  	 	if( $searchtable !=  "")
  	 	{
  	 		if(file_exists(__SITEROOT.'library/Models/'.$searchtable.'.php'))
  	 		{		
  	 			require_once(__SITEROOT.'library/Models/'.$searchtable.'.php');	 			
  	 			$objtabname = "T".$searchtable;
  	 			$tabobj = new $objtabname(); 	 			
  	 			$where.=" and ".$region_path_domain;
  	 			$where.=" and individual_core.status_flag='1'";//正常档案
  	 			foreach ($search as $k => $v)
			    {
		            if ($k=="age_start"&&$v!=''&&$v != 0)
		            {
		                $v = adodb_mktime(0,0,0,adodb_date("n",$time), adodb_date("j",$time),adodb_date("Y",$time)-$v);
		                $where.=" and individual_core.date_of_birth <= $v";
		            }
		            if ($k=="age_end"&&$v!=''&&$v!= 0)
		            {
		                $v = $v + 1;
		                $v = adodb_mktime(0,0,0,adodb_date("n",$time), adodb_date("j",$time),adodb_date("Y",$time)-$v);
		                $where.=" and individual_core.date_of_birth >= $v";
		            }
		            if ($k=="sex"&&$v!='')
		            {
		                $where.=" and individual_core.$k = '$v'";
		            }
		            if($k=='name'&&$v!='')
		            {
		            	$where.=" and individual_core.$k = '$v'";
		            }
		            if($k=='identity_number'&&$v!='')
		            {
		            	$where.=" and individual_core.$k = '$v'";
		            }
		            if ($k=='start_time'&& $v!='')
		            {
		            	$v=strtotime($v);
		            	$starttime=adodb_mktime(0,0,0,adodb_date("m",$v),adodb_date("d",$v),adodb_date("Y",$v));
		            	$wheres.=" and examination_table.examination_date >=$starttime";
		            }
		            if ($k=='end_time' && $v!='')
		            {
		            	$v=strtotime($v);
		            	$endtime=adodb_mktime(23,59,59,adodb_date("m",$v),adodb_date("d",$v),adodb_date("Y",$v));
		            	$wheres.=" and examination_table.examination_date <=$endtime";
		            }
			     }
			     //print_r($search);
			     //点击绿色小叉没有传递查询时间段，这里获取时间段（默认为本年时间）
			     if(empty($search['start_time']))
			     {
	            	$starttime=adodb_mktime(0,0,0,01,01,adodb_date("Y",$time));
	            	$wheres.=" and examination_table.examination_date >=$starttime";
	            	$search['start_time']=date("Y-m-d",$starttime);
  	 	
			     }
			     if(empty($search['end_time']))
			     {
			     	$endtime=adodb_mktime(23,59,59,adodb_date("m",$time),adodb_date("d",$time),adodb_date("Y",$time));
		            $wheres.=" and examination_table.examination_date <=$endtime";
		            $search['end_time']=date("Y-m-d",$endtime);
			     }
			    //echo $where;
  	 			$tabobj->query("select count(*) as nums from individual_core where not exists(select 1 from ".$searchtable." where ".$searchtable.".id=individual_core.uuid ".$wheres.")".$where."");
  	 			//echo "select count(*) as nums from individual_core where  not exists(select 1 from ".$searchtable." where ".$searchtable.".id=individual_core.uuid".$wheres.")".$where;
  	 			$tabobj->fetch();
  	 			$nums = $tabobj->nums;
  	 			$pageCurrent = intval($this->_request->getParam('page'));
		        $pageCurrent = $pageCurrent ? $pageCurrent : 1;
		        //echo $pageCurrent;
		        //new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		        $links = new SubPages(__ROWSOFPAGE, $nums, $pageCurrent, __goodsListRowOfPage,__BASEPATH.'et/choice/index/page/', 2, $search);
		        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
		        $startnum = __ROWSOFPAGE * ($pageCurrent - 1); //计算开始记录数
		        $newtabobj = new $objtabname(); 
		        $newtabobj->query("select * from (select A.*,ROWNUM as RN from (select * from individual_core where not exists (select 1 from ".$searchtable." where ".$searchtable.".id=individual_core.uuid".$wheres.")".$where." ) A where ROWNUM <= ".(__ROWSOFPAGE+$startnum).") where RN > ".$startnum."");
		        //echo "select * from (select A.*,ROWNUM as RN from (select * from individual_core where not exists (select 1 from ".$searchtable." where ".$searchtable.".id=individual_core.uuid".$wheres.")".$where." ) A where ROWNUM <= ".(__ROWSOFPAGE+$startnum).") where RN > ".$startnum;
		        $row   = array();
		        $count = 0;
  	 			while ($newtabobj->fetch())
  	 			{
  	 				$row[$count]['name']  =  $newtabobj->name;//姓名
  	 				$row[$count]['identity_number'] = $newtabobj->identity_number;
  	 				$row[$count]['uuid']  =  $newtabobj->uuid;
  	 				//性别
  	 				foreach($sex as $k=>$v)
  	 				{
	  	 					if($v[0]==$newtabobj->sex)
	  	 					{
	  	 						$row[$count]['sex']  = $v[1];
	  	 					}
  	 				}
  	 				//地区
  	 				$row[$count]['address']  = $newtabobj->address;
  	 				//年龄
  	 				$row[$count]['date_of_birth']  = floor(($time-$newtabobj->date_of_birth)/3600/24/365);
  	 				$staff = new Tstaff_core();
  	 				$staff->whereAdd("id='$newtabobj->staff_id'");
  	 				$staff->find(true);
  	 				$row[$count]['doctor_name'] = $staff->name_login;
  	 				$staff->free_statement();
  	 				$count++;
  	 			}
  	 			$page = $links->subPageCss3();
  	 			$this->view->page      =  $page;
  	 			$this->view->para_page = $pageCurrent;
  	 			$this->view->row       =  $row;
  	 			$newtabobj->free_statement();	
  	 			$tabobj->free_statement();
  	 		}
  	 	}
  	 	$this->view->display("list_extra.html");
  	 }
  }
?>