<?php
/**
 * @author :hailang
 * @copyright :用于不同机构上传数据的统计
 * @date:2013-3-15
 */
class decision_logsController extends controller {
	/**
	 * 自动加载
	 */
	public function init()
	{
		$this->haveWritePrivilege='';
		require_once(__SITEROOT . '/library/custom/adodb-time.inc.php'); //引入时间处理
		require_once(__SITEROOT."library/privilege.php");
		require_once(__SITEROOT."library/Models/region.php");
		require_once(__SITEROOT."library/Models/organization.php");
		require_once(__SITEROOT."library/Models/api_logs.php");
		$this->view->assign("basePath",__BASEPATH);
		$this->view->assign("baseUrl",__BASEPATH);
	}
	public function indexAction()
	{
		$type=$this->_request->getParam("type");//日报月报年报类型
		$this->view->type=$type;
		$form_model=$this->_request->getParam("form_model");//模块类型
		$model=$this->_request->getParam("model");
		if(!empty($form_model))
		{
			$model=$form_model;
		}
		if(!empty($model))
		{
			$model=$model;
		}
		$model=$model ? $model : 1;//默认是个人档案模块
		$this->view->model=$model;
		
		$decision_time = $this->_request->getParam('decision_time');
        $search_time = $this->_request->getParam('search_time');
        $start_time=$this->_request->getParam("start_time");
        $form_start_time=$this->_request->getParam("form_start_time");
        if(!empty($form_start_time))
        {
        	$start_time=$form_start_time;
        }
        if(!empty($start_time))
        {
        	$start_time=$start_time;
        }
        if (!empty($decision_time))
        {
                $decision_time = strtotime($decision_time);
        }
        if(!empty($search_time))
        {
                $decision_time=  strtotime($search_time);
        }
        
        if($type=='day')
        {
        	$decision_time = $decision_time ? mktime(23, 59, 59, date("m", $decision_time), date("d", $decision_time), date("Y", $decision_time)) : mktime(23, 59, 59, date("m", time()), date("d", time()), date("Y", time()));
	        $start_time =empty($start_time) ? mktime(0, 0, 0, date("m",$decision_time), date("d",$decision_time), date('Y', $decision_time)):  strtotime($start_time);
        }
        if($type=='month')
        {
        	$decision_time = $decision_time ? mktime(23, 59, 59, date("m", $decision_time), date("d", $decision_time), date("Y", $decision_time)) : mktime(23, 59, 59, date("m", time()), date("d", time()), date("Y", time()));
	        $start_time =empty($start_time) ? mktime(0, 0, 0, date("m",$decision_time)-1, date("d",$decision_time), date('Y', $decision_time)):  strtotime($start_time);
        }
        if($type=='year')
        {
        	$decision_time = $decision_time ? mktime(23, 59, 59, date("m", $decision_time), date("d", $decision_time), date("Y", $decision_time)) : mktime(23, 59, 59, date("m", time()), date("d", time()), date("Y", time()));
	        $start_time =empty($start_time) ? mktime(0, 0, 0, date("m",$decision_time), date("d",$decision_time), date('Y', $decision_time)-1):  strtotime($start_time);
	       
        }
        $this->view->decision_time = date('Y-m-d', $decision_time);
        $this->view->start_time = date('Y-m-d', $start_time);
        
        $model_array=array(1=>'个人档案',2=>'家庭档案',3=>'健康体检',4=>'高血压',5=>'糖尿病',6=>'重性精神分裂',7=>'孕产妇',8=>'儿童',9=>'婚前保健',10=>'预防接种',11=>'个人基本信息',12=>'门急诊病历',13=>'西医处方',14=>'中医处方',15=>'检查记录'
        ,16=>'检验记录',17=>'生命体征测量记录',18=>'病案首页',19=>'入院记录',20=>'病程记录',21=>'长期医嘱',22=>'临时医嘱',23=>'出院记录',24=>'转诊记录',25=>'就诊状态',26=>'医疗影像',27=>'健康教育活动',28=>'健康教育处方');//模块
        $this->view->model_array=$model_array;
        
		$p_id=$this->_request->getParam("parent_id",'');
		$regionDomain = $this->user['region_id'];
//        echo $regionDomain;
        $p_id = empty($p_id) ? $regionDomain : $p_id;
        $this->view->caching = __CACHING; //开启缓存
        $this->view->cache_lifetime = __CACHING_LEFTTIME; //缓存时间
        if(!$this->view->is_cached("index.html", $p_id.$type.$model.$decision_time.$start_time))
        {
        	$regionDomain = $this->user['region_id'];
			$p_id = empty($p_id)?$regionDomain:$p_id;
			$this->view->basePath = $this->_request->getBasePath();
			//列表显示父ID等于1但是ID不等于1的所有数据(不显示根)
        	$region=new Tregion();
        	$region->whereAdd("id<>'0'");
        	$region->whereAdd("p_id='$p_id'");
        	$region->orderby("id asc");
//        	$region->debugLevel(9);
        	$region->find();
        	
        	$row=array();
        	$rowCount=0;
        	$sum_total_1=0;//统计总数
        	$sum_total_2=0;//统计总数
        	$sum_total_3=0;//统计总数
        	while ($region->fetch())
        	{
        		$row[$rowCount]['id']=$region->id;
        		$row[$rowCount]['zh_name']=$region->zh_name;
        		$row[$rowCount]['p_id']=$region->p_id;
        		$row[$rowCount]['standard_code']=$region->standard_code;
        		$row[$rowCount]['region_path']=$region->region_path;
        		$current_level=count(explode(',',$region->region_path));
        		 //显示建档机构名称
                if ($current_level == 6)
                {
                        require_once __SITEROOT . "library/Models/organization.php";
                        $org = new Torganization();
                        $org->whereAdd("region_path='$region->region_path'");
                        $org->find(true);
                        $row[$rowCount]['org_zh_name'] = $org->zh_name;
                        $this->view->td_title = '2';
                }
                
               	$logs_1=new Tapi_logs();
               	$orgs_1=new Torganization();
               	$logs_1->joinAdd("left",$logs_1,$orgs_1,'org_id','id');
               	$logs_1->whereAdd("organization.region_path like '".$region->region_path."%'");
               	$logs_1->whereAdd("api_logs.upload_token='1'");//添加成功
               	if($model!=99)//99表示查询全部
               	{
               		$logs_1->whereAdd("api_logs.model_id='$model'");//模块
               	}
               	$logs_1->whereAdd("api_logs.upload_time>='$start_time'");
               	$logs_1->whereAdd("api_logs.upload_time<='$decision_time'");
               	$num_1=$logs_1->count("*");
//               	$logs_1->debugLevel(9);
//               	$logs_1->find();
               	$row[$rowCount]['sum_logs_1']=$num_1;
                $sum_total_1=$sum_total_1+$num_1;
               	
               	$logs_2=new Tapi_logs();
               	$orgs_2=new Torganization();
               	$logs_2->joinAdd("left",$logs_2,$orgs_2,'org_id','id');
               	$logs_2->whereAdd("organization.region_path like '".$region->region_path."%'");
               	$logs_2->whereAdd("api_logs.upload_token='2'");//修改成功
               	if($model!=99)
               	{
               		$logs_2->whereAdd("api_logs.model_id='$model'");//模块
               	}
               	$logs_2->whereAdd("api_logs.upload_time>='$start_time'");
               	$logs_2->whereAdd("api_logs.upload_time<='$decision_time'");
               	$num_2=$logs_2->count("*");
               	$row[$rowCount]['sum_logs_2']=$num_2;
               	$sum_total_2=$sum_total_2+$num_2;	
               	
               	$logs_3=new Tapi_logs();
               	$orgs_3=new Torganization();
               	$logs_3->joinAdd("left",$logs_3,$orgs_3,'org_id','id');
               	$logs_3->whereAdd("organization.region_path like '".$region->region_path."%'");
               	$logs_3->whereAdd("api_logs.upload_token='3'");//删除成功
               	if($model!=99)
               	{
               		$logs_3->whereAdd("api_logs.model_id='$model'");//模块
               	}
               	$logs_3->whereAdd("api_logs.upload_time>='$start_time'");
               	$logs_3->whereAdd("api_logs.upload_time<='$decision_time'");
               	$num_3=$logs_3->count("*");
               	$row[$rowCount]['sum_logs_3']=$num_3;
               	$sum_total_3=$sum_total_3+$num_3;

                
                if ($current_level < 6)
                {
                        $this->view->td_title = '1';
                }
                if ($current_level == 6)
                {
                        $this->view->td_title = '2';
                }
        		$rowCount++;
        	}

        	$this->view->assign("row",$row);
        	$this->view->assign('add_need_id', $p_id);
        	$this->view->assign('sum_total_1',$sum_total_1);
        	$this->view->assign('sum_total_2',$sum_total_2);
        	$this->view->assign('sum_total_3',$sum_total_3);
        	
        	//获取所有path 根据登录者的地区id，限制导航条只能在该用户所在的区域内
            $pathSel = new Tregion();
            $pathSel->whereAdd("id='$p_id'");
            $pathSel->find(true);
            $currentPath = $pathSel->region_path; //处理path
            $nuNumber = strpos($currentPath, $regionDomain);
            $strNumber = intval(strlen($currentPath) - $nuNumber);
            $newCurrentPath = substr($currentPath, $nuNumber, $strNumber);
            $realPath = explode(',', $newCurrentPath);
            $realCount = count($realPath);
            $rs = array();
            $rsCount = 0;
            foreach ($realPath as $k => $v)
            {
                    $realMenu = new Tregion();
                    $realMenu->whereAdd("id='$v'");
                    $realMenu->find(true);
                    $rs[$rsCount]['zh_name'] = $realMenu->zh_name;
                    $rs[$rsCount]['id'] = trim($realMenu->id);
                    $rs[$rsCount]['p_id'] = trim($realMenu->p_id);
                    $rsCount++;
            }
            $this->view->assign('rs', $rs);
            //获取当前表中所有栏目内容(除去根)
            $length = count(explode(',', $pathSel->region_path));
            //echo $length;
            if ($length <= 4)
            {
                    $this->view->standard_code_size = 6;
            }
            else
            {
                    $this->view->standard_code_size = 3;
            }
        }
		$this->view->display("index.html",$p_id.$type.$model);
    }	
    /**
     * 统计图
     */
    public function imageAction()
    {
    	$start_time=$this->_request->getParam("start_time");
    	$end_time=$this->_request->getParam("end_time");
    	$id=$this->_request->getParam("id");
    	$model=$this->_request->getParam("model");
    	$type=$this->_request->getParam("type");
    	$this->view->start_time=$start_time;
    	$this->view->end_time=$end_time;
    	$this->view->id=$id;
    	//获取传递地区的父p_id
    	$region=new Tregion();
    	$region->whereAdd("id='$id'");
    	$region->find(true);
    	$p_id=$region->p_id;
    	$this->view->p_id=$p_id;
    	$this->view->region_name=$region->zh_name;
    	$this->view->model=$model;    	
    	$this->view->type=$type;
    	$model_array=array(1=>'个人档案',2=>'家庭档案',3=>'健康体检',4=>'高血压',5=>'糖尿病',6=>'重性精神分裂',7=>'孕产妇',8=>'儿童',9=>'婚前保健',10=>'预防接种',11=>'个人基本信息',12=>'门急诊病历',13=>'西医处方',14=>'中医处方',15=>'检查记录'
        ,16=>'检验记录',17=>'生命体征测量记录',18=>'病案首页',19=>'入院记录',20=>'病程记录',21=>'长期医嘱',22=>'临时医嘱',23=>'出院记录',24=>'转诊记录',25=>'就诊状态',26=>'医疗影像',27=>'健康教育活动',28=>'健康教育处方',99=>'全部');//模块
        $this->view->model_array=$model_array;
    	//判断有无数据传过去
    	$start_time_temp=strtotime($start_time);
    	$end_time_temp=strtotime($end_time);
    	$region=new Tregion();
    	$region->whereAdd("id='$id'");
    	$region->find(true);
    	$logs=new Tapi_logs();
       	$orgs=new Torganization();
       	$logs->selectAdd("count(*) as total_record,api_logs.upload_token");
       	$logs->joinAdd("left",$logs,$orgs,'org_id','id');
       	$logs->whereAdd("organization.region_path like '".$region->region_path."%'");
       	if($model!=99)//99表示查询全部
       	{
       		$logs->whereAdd("api_logs.model_id='$model'");//模块
       	}
       	$logs->whereAdd("api_logs.upload_time>='$start_time_temp'");
       	$logs->whereAdd("api_logs.upload_time<='$end_time_temp'");
       	$logs->groupby("api_logs.upload_token");
       	$num=$logs->count("*");

       	$this->view->nuNumber=$num;
    	$this->view->display("image.html");
    }
    public function imagedataAction()
    {
    	require_once __SITEROOT.'library/custom/comm_function.php';
    	$token 	= $this->_request->getParam('token');//标致
    	$id = $this->_request->getParam("id");
    	$model = $this->_request->getParam("model");
    	$start_time = strtotime($this->_request->getParam("start_time"));
    	$end_time = strtotime($this->_request->getParam("end_time"));
    	   	
    	$region=new Tregion();
    	$region->whereAdd("id='$id'");
    	$region->find(true);
    	
    	$logs=new Tapi_logs();
       	$orgs=new Torganization();
       	$logs->selectAdd("count(*) as total_record,api_logs.upload_token");
       	$logs->joinAdd("left",$logs,$orgs,'org_id','id');
       	$logs->whereAdd("organization.region_path like '".$region->region_path."%'");
       	if($model!=99)//99表示查询全部
       	{
       		$logs->whereAdd("api_logs.model_id='$model'");//模块
       	}
       	$logs->whereAdd("api_logs.upload_time>='$start_time'");
       	$logs->whereAdd("api_logs.upload_time<='$end_time'");
       	$logs->groupby("api_logs.upload_token");
       	//$logs->debugLevel(9);
       	$logs->find();
       	$logsArr=array();
       	$logsArrCount=0;
       	$x_array=array();
       	while($logs->fetch()){
       		$upload_token=$logs->upload_token;
       		$logsArr[0][$logsArrCount]=$logs->total_record;
       		$logsArr[0]['axisname']='日志统计';//柱状图的说明
       		$x_array[]=$this->getUploadToken($upload_token);
       		$logsArrCount++;
       	}
       	$logs->free_statement();
       	$orgs->free_statement();

       	//柱形图
    	if($token==1){
        echo xml_draw_3d_bar($logsArr,$x_array,'条数',"条","日志添加修改删除条数","3d column",800,300);
       
    	}else{
        //饼形图
        echo xml_draw_3d_pie($logsArr,$x_array,"条数","条","日志添加修改删除所占百分比",800,300);
    	}
    	exit();  	
    }
    /**
     * 
     */
    function getUploadToken($upload_token)
    {
    	$token=array(1=>'添加',2=>'修改',3=>'删除');
    	foreach ($token as $k=>$v)
    	{
	    	if($upload_token==$k)
	    	{
	    		return $v;
	    	}
    	}
    }
}
