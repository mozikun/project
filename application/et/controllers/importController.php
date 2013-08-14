<?php
/**
 * author :CT
 * 健康体检导出
 *
 */
  class et_importController extends controller 
  {
  	public function init()
  	{
  		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'library/Models/staff_archive.php';
		require_once __SITEROOT.'library/Models/examination_table.php';
		require_once __SITEROOT.'library/Models/staff_core.php';
		require_once __SITEROOT.'library/Models/region.php';
		require_once __SITEROOT.'library/Models/individual_archive.php';
		require_once __SITEROOT.'library/Models/individual_core.php';
		require_once __SITEROOT.'library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'library/custom/comm_function.php';
  	}
  	/**
	 * excel导出体检数据
	 */
	public function importAction()
	{
		$tag_time = array('900','1630');
		$date_array = explode(':',date('H:i:s'),time());
		$current_time = intval($date_array[0].$date_array[1]);
		if($current_time<=$tag_time[1]&&$current_time>=$tag_time[0])
		{
			//echo "2222";
			$this->view->mywarning = '<script language="javascript">alert("请在09:00之前,16:30之后使用导出数据功能");</script>';
			$this->view->mytag = 1;
			//exit();
		}
		//echo "2222";
		require_once __SITEROOT."library/custom/pager.php";
		require_once __SITEROOT.'library/data_arr/arrdata.php';
		$this->view->basePath    =  __BASEPATH;
		$this->view->sex_array         = $sex;//取得性别信息
		$time=time();
		$search=array();
        $search['age_start'] = intval($this->_request->getParam('age_start'))?intval($this->_request->getParam('age_start')):0; //年龄段
        $search['age_end']   = (intval($this->_request->getParam('age_end'))>=$search['age_start'])?intval($this->_request->getParam('age_end')) : '';
        $search['region_id'] = $this->_request->getParam('region_p_id');
        $search['sex']       = $this->_request->getParam('sex');
        $region_path_domain = get_region_path(1, $search['region_id']);
		$currentorg  = $this->user['org_zh_name'];
		$this->view->currentorg  = $currentorg;	
		$region_id   = $this->user['region_id'];
		$this->view->region_p_id = empty($search['region_id'])?$this->user['region_id']:$this->_request->getParam('region_p_id');
		$this->view->region_id = $region_id;
		$this->view->sex = $search['sex'];
		$this->view->age_start = $search['age_start'];
		$this->view->age_end = $search['age_end'];
		//健康体检
		$module_dicreption = $currentorg.'健康体检excel导出';
		$this->view->module_dicreption  = $module_dicreption;
		//列表
		$examin_table    = new Texamination_table();
		$individual_core = new Tindividual_core();
		foreach ($search as $k => $v)
	    {
            if ($k=="age_start"&&$v!=''&&$v != 0)
            {
                $v = adodb_mktime(0,0,0,adodb_date("n",$time), adodb_date("j",$time),adodb_date("Y",$time)-$v);
                $examin_table->whereAdd("individual_core.date_of_birth <= $v");
            }
            if ($k=="age_end"&&$v!=''&&$v!= 0)
            {
                $v = $v + 1;
                $v = adodb_mktime(0,0,0,adodb_date("n",$time), adodb_date("j",$time),adodb_date("Y",$time)-$v);
                $examin_table->whereAdd("individual_core.date_of_birth >= $v");
            }
            if ($k=="sex"&&$v!='')
            {
                $examin_table->whereAdd("individual_core.$k = '$v'");
            }
	     }
		$examin_table->joinAdd('left',$examin_table,$individual_core,'id','uuid');
		$examin_table->whereAdd($region_path_domain);
        $examin_table->orderby("examination_table.examination_date DESC");
		//var_dump('1');
		$nums  =  $examin_table->count();
		//处理分页
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'et/import/import/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$examin_table->limit($startnum,__ROWSOFPAGE);
        $examin_table->find();
        $et_array = array();
        $count = 0;
        while ($examin_table->fetch())
        {
        	$et_array[$count]['name']             =   $individual_core->name;
        	$et_array[$count]['address']          =   $individual_core->address;
        	if($individual_core->phone_number)
        	{
        	    $et_array[$count]['phone_number']    =   $individual_core->phone_number;
        	}
        	else
        	{
        		$et_array[$count]['phone_number']     =   '无';
        	}
        	//处理性别信息
        	$sextag  =   $individual_core->sex;
        	if(empty($sextag))
        	{
        		$et_array[$count]['sex'] = '未知';
        	}
        	else
        	{
        		foreach ($sex as $k=>$v)
	        	{
	        		if($v[0]==$sextag&&$v[1]!=="")
	        		{
	        			$et_array[$count]['sex']  = $v[1];
	        		}
	        	}
        	}
        	//年龄
        	$et_array[$count]['date_of_birth']  =     floor(($time-$individual_core->date_of_birth)/3600/24/365).'岁';
        	$et_array[$count]['examination_date'] =   date("Y-m-d",$examin_table->examination_date);
        	$staff = new Tstaff_core();
        	$staff->whereAdd("id='$examin_table->staff_id'");
        	$staff->find(true);
        	$et_array[$count]['name_login'] =   $staff->name_login;
        	$staff->free_statement();
        	$count++;
        } 
        $examin_table->free_statement();          
        $individual_core->free_statement();       
       // var_dump($et_array);   
        $tag_name    =  $this->_request->getParam('import_do');
        if(!empty($tag_name))
        {
        	$examin_table    = new Texamination_table();
			$individual_core = new Tindividual_core();
			foreach ($search as $k => $v)
		    {
	            if ($k=="age_start"&&$v!=''&&$v != 0)
	            {
	                $v = adodb_mktime(0,0,0,adodb_date("n",$time), adodb_date("j",$time),adodb_date("Y",$time)-$v);
	                $examin_table->whereAdd("individual_core.date_of_birth <= $v");
	            }
	            if ($k=="age_end"&&$v!=''&&$v!= 0)
	            {
	                $v = $v + 1;
	                $v = adodb_mktime(0,0,0,adodb_date("n",$time), adodb_date("j",$time),adodb_date("Y",$time)-$v);
	                $examin_table->whereAdd("individual_core.date_of_birth >= $v");
	            }
	            if ($k=="sex"&&$v!='')
	            {
	                $examin_table->whereAdd("individual_core.$k = '$v'");
	            }
		     }
			$examin_table->joinAdd('left',$examin_table,$individual_core,'id','uuid');
			$examin_table->whereAdd($region_path_domain);
	        $examin_table->orderby("examination_table.examination_date DESC");
	        //$examin_table->debugLevel(9);
			$examin_table->find();
			$array_data = array();
			$i = 0;
			while ($examin_table->fetch())
			{
				$array_data[$i]['name']             =   $individual_core->name;
				//处理性别信息
            	$sextag  =   $individual_core->sex;
            	if(empty($sextag))
	        	{
	        		$array_data[$i]['sex'] = '未知';
	        	}
	        	else
	        	{
		        	foreach ($sex as $k=>$v)
		        	{
		        		if($v[0]==$sextag&&$v[1]!=="")
		        		{
		        			$array_data[$i]['sex']  = $v[1];
		        		}
		        	}
	        	}
            	$array_data[$i]['address']          =   $individual_core->address; 	
            	if($individual_core->phone_number)
            	{
            	    $array_data[$i]['phone_number']     =   $individual_core->phone_number;
            	}
            	else
            	{
            		$array_data[$i]['phone_number']     =   '无';
            	}
	        	//年龄
	        	$array_data[$i]['date_of_birth']  =  floor(($time-$individual_core->date_of_birth)/3600/24/365).'岁';
            	$array_data[$i]['examination_date'] =   date("Y-m-d",$examin_table->examination_date);
            	$staff = new Tstaff_core();
            	$staff->whereAdd("id='$examin_table->staff_id'");
            	$staff->find(true);
            	$staff->free_statement();
            	$array_data[$i]['name_login'] =   $staff->name_login;
            	$i++;
			}
			$examin_table->free_statement();
			$individual_core->free_statement();
//			var_dump($array_data);
			//exit();
			//导出数据到浏览器，然后输出总共导出多少条数据
            /** PHPExcel */
            require_once __SITEROOT.'library/phpexcel/Classes/PHPExcel.php';
            // Create new PHPExcel object
            $title_1=$currentorg."未进行健康体检表";
            $title = iconv('UTF-8','GBK',$title_1);
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()->setCreator("TT")
            							 ->setLastModifiedBy("TT")
            							 ->setTitle($title)
            							 ->setSubject($title)
            							 ->setDescription($title)
            							 ->setKeywords("office 2007 openxml php")
            							 ->setCategory($title);
            //电子表格的序号
            $excel_order=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","BB","CC");      
            //设置第一行为黑体
            for($k=0;$k<=6;$k++)
            {
               $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($k,1)->getFont()->setBold(true);
            }
            // 填写标题
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($excel_order[0].'1', '姓名')
                        ->setCellValue($excel_order[1].'1', '性别')
                        ->setCellValue($excel_order[2].'1', '年龄')
                        ->setCellValue($excel_order[3].'1', '地址')
                        ->setCellValue($excel_order[4].'1', '联系电话')
                        ->setCellValue($excel_order[5].'1', '体检日期')
                        ->setCellValue($excel_order[6].'1', '责任医生');
            //设置单元格格式
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[0])->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[1])->setWidth(30); 
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[2])->setWidth(30); 
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[3])->setWidth(40); 
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[4])->setWidth(30);   
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[5])->setWidth(30);   
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[6])->setWidth(30);   
            $j=2;
            foreach($array_data as $k=>$v)
            {
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($excel_order[0].$j, $v['name'])
                        ->setCellValue($excel_order[1].$j, $v['sex'])
                        ->setCellValue($excel_order[2].$j, $v['date_of_birth'])
                        ->setCellValue($excel_order[3].$j, $v['address'])
                        ->setCellValue($excel_order[4].$j, $v['phone_number'])
                        ->setCellValue($excel_order[5].$j, $v['examination_date'])
                        ->setCellValue($excel_order[6].$j, $v['name_login']);
                $j++;
            }
            
            // Rename sheet
            
            $objPHPExcel->getActiveSheet()->setTitle($currentorg."健康体检");
            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);
            // Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$title.'.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }else
        {
        	$this->view->et_array   =   $et_array;
            $out = $links->subPageCss2();
            $this->view->page   =  $out;
            $this->view->display('etimport.html');
        }
	}	
	/**
	 * excel导出未体检数据
	 */
	public function noexamineAction(){
		$tag_time = array('900','1630');
		$date_array = explode(':',date('H:i:s'),time());
		$current_time = intval($date_array[0].$date_array[1]);
		if($current_time<=$tag_time[1]&&$current_time>=$tag_time[0])
		{
			$this->view->mywarning = '<script language="javascript">alert("请在09:00之前,16:30之后使用导出数据功能");</script>';
			$this->view->mytag = 1;
		}
		
		require_once __SITEROOT."library/custom/pager.php";
		require_once __SITEROOT.'library/data_arr/arrdata.php';
		$this->view->basePath    =  __BASEPATH;
		$this->view->sex_array         = $sex;//取得性别信息
		$time=time();
		$created_start_time=$this->_request->getParam('created_start_time');
		$created_end_time=$this->_request->getParam('created_end_time');

		$search=array();
        $search['age_start'] = intval($this->_request->getParam('age_start'))?intval($this->_request->getParam('age_start')):0; //年龄段
        $search['age_end']   = (intval($this->_request->getParam('age_end'))>=$search['age_start'])?intval($this->_request->getParam('age_end')) : '';
        $search['region_p_id'] = $this->_request->getParam('region_p_id');
        $search['sex']       = $this->_request->getParam('sex');
        $search['created_start_time']=empty($created_start_time) ? date("Y-m-d",mktime(0, 0, 0, 1, 1, date('Y', $time))):  $created_start_time;
        $search['created_end_time']=empty($created_end_time)? date("Y-m-d",mktime(0, 0, 0, date("m",$time), date("d",$time), date('Y', $time))):  $created_end_time;
        $region_path_domain = get_region_path(1, $search['region_p_id']);
		$currentorg  = $this->user['org_zh_name'];
		$this->view->currentorg  = $currentorg;	
		$region_id   = $this->user['region_id'];
		$this->view->region_p_id = empty($search['region_p_id'])?$this->user['region_id']:$this->_request->getParam('region_p_id');
		$this->view->region_id = $region_id;
		$this->view->sex = $search['sex'];
		$this->view->age_start = $search['age_start'];
		$this->view->age_end = $search['age_end'];
		$this->view->created_start_time=$search['created_start_time'];
		$this->view->created_end_time=$search['created_end_time'];

		//未健康体检
		$module_dicreption = $currentorg.'未健康体检excel导出';
		$this->view->module_dicreption  = $module_dicreption;
		//列表
		$where='';
		$where1='';
		$where.=' and '.$region_path_domain;
		$where.=" and individual_core.status_flag='1'";//正常档案
		$examin_table = new Texamination_table();
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
				$where.=" and individual_core.date_of_birth >=$v";
            }
            if ($k=="sex"&&$v!='')
            {
                $where.=" and individual_core.$k = '$v'";
            }
            if($k=='created_start_time'&&$v!='')
            {
            	$v=strtotime($v);
            	$where1.=" and examination_table.examination_date>=$v";
            }
            if($k=='created_end_time'&&$v!='')
            {
            	$v=strtotime($v);
            	$where1.=" and examination_table.examination_date<=$v";
            }
	     }	
		if(empty($where1)){
			$examin_table->query("select count(*) as nums from individual_core where not exists(select 1 from examination_table where examination_table.id=individual_core.uuid)".$where."");
		}else{
			$examin_table->query("select count(*) as nums from individual_core where not exists(select 1 from examination_table where examination_table.id=individual_core.uuid ".$where1.")".$where."");
		}
		$examin_table->fetch();
		$nums  =  $examin_table->nums;
//		echo $nums;
//		exit();
		//处理分页
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'et/import/noexamine/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$examin = new Texamination_table();
		if(empty($where1))
		{
			$examin->query("select * from (select A.*,ROWNUM as RN from (select * from individual_core where not exists (select 1 from examination_table where examination_table.id=individual_core.uuid)".$where." ) A where ROWNUM <= ".(__ROWSOFPAGE+$startnum).") where RN > ".$startnum."");	
		}else {
			$examin->query("select * from (select A.*,ROWNUM as RN from (select * from individual_core where not exists (select 1 from examination_table where examination_table.id=individual_core.uuid ".$where1.")".$where." ) A where ROWNUM <= ".(__ROWSOFPAGE+$startnum).") where RN > ".$startnum."");	
		}
		  
//        echo "select * from individual_core where not exists (select 1 from examination_table where examination_table.id=individual_core.uuid ".$where1.")".$where ;
		$et_array = array();
        $count = 0;
        while ($examin->fetch())
        {
        	$et_array[$count]['name']             =   $examin->name;
        	$et_array[$count]['address']          =   $examin->address;
        	if($examin->phone_number)
        	{
        	    $et_array[$count]['phone_number']    =   $examin->phone_number;
        	}
        	else
        	{
        		$et_array[$count]['phone_number']     =   '无';
        	}
        	//处理性别信息
        	$sextag  =   $examin->sex;
        	if(empty($sextag))
        	{
        		$et_array[$count]['sex'] = '未知';
        	}
        	else
        	{
        		foreach ($sex as $k=>$v)
	        	{
	        		if($v[0]==$sextag&&$v[1]!=="")
	        		{
	        			$et_array[$count]['sex']  = $v[1];
	        		}
	        	}
        	}
        	//年龄
        	$et_array[$count]['date_of_birth']  =     floor(($time-$examin->date_of_birth)/3600/24/365).'岁';
        	$et_array[$count]['identity_number'] =   $examin->identity_number;
        	$staff = new Tstaff_core();
        	$staff->whereAdd("id='$examin->staff_id'");
        	$staff->find(true);
        	$et_array[$count]['name_login'] =   $staff->name_login;
        	$staff->free_statement();
        	$count++;
        } 
        $examin->free_statement();               
       // var_dump($et_array);   
        $tag_name    =  $this->_request->getParam('import_do');
        if(!empty($tag_name))
        {
        	$examin_table    = new Texamination_table();
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
	                $where.=" and individual_core.$k = $v";
	            }
	            if($k=='created_start_time'&&$v!='')
	            {
	            	$v=strtotime($v);
	            	$where1.=" and examination_table.examination_date>=$v";
	            }
	            if($k=='created_end_time'&&$v!='')
	            {
	            	$v=strtotime($v);
	            	$where1.=" and examination_table.examination_date<=$v";
	            }
		     }
			if(empty($where1))
			{
//				$examin_table->query("select * from (select A.*,ROWNUM as RN from (select * from individual_core where not exists (select 1 from examination_table where examination_table.id=individual_core.uuid)".$where." ) A where ROWNUM <= ".(__ROWSOFPAGE+$startnum).") where RN > ".$startnum."");	
				$examin_table->query("select * from individual_core where not exists (select 1 from examination_table where examination_table.id=individual_core.uuid)".$where);	
			}else {
//				$examin_table->query("select * from (select A.*,ROWNUM as RN from (select * from individual_core where not exists (select 1 from examination_table where examination_table.id=individual_core.uuid ".$where1.")".$where." ) A where ROWNUM <= ".(__ROWSOFPAGE+$startnum).") where RN > ".$startnum."");	
				$examin_table->query("select * from individual_core where not exists (select 1 from examination_table where examination_table.id=individual_core.uuid ".$where1.")".$where);	
			}
			$array_data = array();
			$i = 0;
			while ($examin_table->fetch())
			{
				$array_data[$i]['name']             =   $examin_table->name;
				//处理性别信息
            	$sextag  =   $examin_table->sex;
            	if(empty($sextag))
	        	{
	        		$array_data[$i]['sex'] = '未知';
	        	}
	        	else
	        	{
		        	foreach ($sex as $k=>$v)
		        	{
		        		if($v[0]==$sextag&&$v[1]!=="")
		        		{
		        			$array_data[$i]['sex']  = $v[1];
		        		}
		        	}
	        	}
            	$array_data[$i]['address']          =   $examin_table->address; 	
            	if($examin_table->phone_number)
            	{
            	    $array_data[$i]['phone_number']     =   $examin_table->phone_number;
            	}
            	else
            	{
            		$array_data[$i]['phone_number']     =   '无';
            	}
	        	//年龄
	        	$array_data[$i]['date_of_birth']  =  floor(($time-$examin_table->date_of_birth)/3600/24/365).'岁';
            	$array_data[$i]['identity_number'] =   $examin_table->identity_number;
            	$staff = new Tstaff_core();
            	$staff->whereAdd("id='$examin_table->staff_id'");
            	$staff->find(true);
            	$staff->free_statement();
            	$array_data[$i]['name_login'] =   $staff->name_login;
            	$i++;
			}
			$examin_table->free_statement();
//			var_dump($array_data);
			//exit();
			//导出数据到浏览器，然后输出总共导出多少条数据
            /** PHPExcel */
            require_once __SITEROOT.'library/phpexcel/Classes/PHPExcel.php';
            // Create new PHPExcel object
            $title_1=$currentorg.$search['created_start_time'].'至'.$search['created_end_time']."未进行健康体检表";
            $title = iconv('UTF-8','GBK',$title_1);
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()->setCreator("TT")
            							 ->setLastModifiedBy("TT")
            							 ->setTitle($title)
            							 ->setSubject($title)
            							 ->setDescription($title)
            							 ->setKeywords("office 2007 openxml php")
            							 ->setCategory($title);
            //电子表格的序号
            $excel_order=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","BB","CC");      
            //设置第一行为黑体
            for($k=0;$k<=6;$k++)
            {
               $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($k,1)->getFont()->setBold(true);
            }
            // 填写标题
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($excel_order[0].'1', '姓名')
                        ->setCellValue($excel_order[1].'1', '性别')
                        ->setCellValue($excel_order[2].'1', '年龄')
                        ->setCellValue($excel_order[3].'1', '地址')
                        ->setCellValue($excel_order[4].'1', '联系电话')
                        ->setCellValue($excel_order[5].'1', '身份证号')
                        ->setCellValue($excel_order[6].'1', '责任医生');
            //设置单元格格式
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[0])->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[1])->setWidth(20); 
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[2])->setWidth(20); 
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[3])->setWidth(40); 
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[4])->setWidth(20);   
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[5])->setWidth(30);   
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[6])->setWidth(20);   
            $j=2;
            foreach($array_data as $k=>$v)
            {
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($excel_order[0].$j, $v['name'])
                        ->setCellValue($excel_order[1].$j, $v['sex'])
                        ->setCellValue($excel_order[2].$j, $v['date_of_birth'])
                        ->setCellValue($excel_order[3].$j, $v['address'])
                        ->setCellValue($excel_order[4].$j, $v['phone_number'])
                        ->setCellValue($excel_order[5].$j, ' '.$v['identity_number'])//加空字符串防止excel出现5.11025E+17
                        ->setCellValue($excel_order[6].$j, $v['name_login']);
                $j++;
            }
            
            // Rename sheet
            
            $objPHPExcel->getActiveSheet()->setTitle($currentorg."健康体检");
            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);
            // Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$title.'.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }else
        {
        	$this->view->et_array   =   $et_array;
            $out = $links->subPageCss2();
            $this->view->page   =  $out;
			$this->view->display("noexamine.html");
        }
	}
  }