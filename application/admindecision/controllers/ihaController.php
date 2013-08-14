<?php
class admindecision_ihaController extends controller{

	private $regionDomain;
	private $start_time;
	private $end_time;
	private $p_id;
	private $cache_time=__CACHING_LEFTTIME;

	public function  init(){
		set_time_limit(0);
		//require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Myauth.php');
		$this->auth = Zend_Auth::getInstance();
		$this->user = $this->auth->getIdentity();
		$this->view->assign("basePath",__BASEPATH);
		$this->session=new Zend_Session_Namespace("admindecision_iha");
		require_once __SITEROOT.'library/custom/comm_function.php';
		
        
        //2012-10-26 我好笨增加以下查询条件
		//从日期控件传来的开始与结束日期
		$this->start_time='2010-06-24';
		$this->end_time='2011-09-24';
        $this->regionDomain = $this->user['region_id'];
		//获取父分类ID，选择下级分类的时候需要
		$start_time=$this->_request->getParam('start_time')?$this->_request->getParam('start_time'):'2000-01-01';
		$end_time=$this->_request->getParam('end_time')?$this->_request->getParam('end_time'):date("Y-m-d");
		$this->view->assign('start_time',$start_time);
		$this->view->assign('end_time',$end_time);
		$this->start_time=strtotime($start_time);
		$this->end_time=strtotime($end_time)+(24*3600);
		$p_id = $this->_request->getParam('region_id','');
		$this->p_id = empty($p_id)?$this->regionDomain:$p_id;
        $this->view->assign('region_id',$p_id);
        $this->getdata($this->regionDomain,$this->start_time,$this->end_time,$this->p_id);
	}
	public function indexAction(){
		$region=$this->_request->getParam('region');
		$this->view->region=$region;
		$this->view->assign('basePath',__BASEPATH);
		$this->view->display("index.html");
	}
    
	/**
	 * admindecision_ihaController::getData()
	 * 
     * 完成健康档案基本统计，我好笨已于2012-10-26完全重写，原代码可查看svn历史记录
     * 
	 * @param mixed $regionDomain
	 * @param mixed $start_time
	 * @param mixed $end_time
	 * @param mixed $p_id
	 * @return
	 */
	public function getData($regionDomain,$start_time,$end_time,$p_id){
		$file_md5=md5($regionDomain.$start_time.$end_time.$p_id);
		$filename=__SITEROOT."cache/admindecision_iha_$file_md5.php";
		if (!file_exists($filename) || (time()-filemtime($filename))>=$this->cache_time)
        {
    		require_once __SITEROOT."library/Models/individual_archive.php";
    		require_once __SITEROOT."library/Models/individual_core.php";
    		require_once __SITEROOT."library/Models/staff_core.php";
    		require_once __SITEROOT."library/Models/region.php";
    		require_once __SITEROOT.'library/Models/region.php' ;
    		require_once __SITEROOT.'library/Models/organization.php';
    		require_once __SITEROOT.'library/Models/region_ext_1.php';
    		//列表显示父ID等于1但是ID不等于1的所有数据(不显示根)
    		$region = new Tregion();
    		$region->whereAdd("id<>'0'");
    		$region->whereAdd("p_id='$p_id'");
    		$region->orderby('id asc');
    		//$region->limit($startnum,__ROWSOFPAGE);
    		//$region->debugLevel(9);
    		$region->find();
    		$row = array();
    		$rowCount = 0;
    		$sum_population=0;
    		$sum_archive=0;
    		$sum_archive_last_year=0;
            while($region->fetch())
            {
    			$row[$rowCount]['id'] = trim($region->id);
    			$row[$rowCount]['zh_name'] = substr($region->zh_name,0,6);
    			$row[$rowCount]['region_path'] = $region->region_path;
    			$row[$rowCount]['standard_code'] = $region->standard_code;
    			$row[$rowCount]['p_id'] = trim($region->p_id);
    			$row[$rowCount]['standard_code'] = trim($region->standard_code);
    			$current_level = count(explode(',',$region->region_path));
    			//统计各地区人口数，因此人口数输入在镇这一级，因此有如下处理方式
    			//镇以上地区
    			//2011-09-26
    			if($current_level<6)
                {
    				$region_ext_1=new Tregion_ext_1();
    				$region_ext_1->selectAdd('sum(population) as population_sum');
    				$region_ext_1->whereAdd("region_year>0");
    				$region1=new Tregion();
    				$region1->selectAdd('count(id) as region_number');
    				$region1->whereAdd("region_path like '".$region->region_path."%'");
    				$region_ext_1->joinAdd('inner',$region_ext_1,$region1,'region_id','id');
    				//$region_ext_1->debugLevel(9);
    				$region_ext_1->find();
    				$region_ext_1->fetch();
    				//echo
    				$row[$rowCount]['population']=$region_ext_1->population_sum;
    				$sum_population=$sum_population+$region_ext_1->population_sum;
    				$population=$region_ext_1->population_sum;
    			}
    			//总建档数
                $archive_rate=0;
                $temp=0;
    			$individual_core=new Tindividual_core();
    			$individual_core->whereAdd("individual_core.region_path like '".$region->region_path."%'");
    			$temp=$individual_core->count();
                $individual_core->free_statement();
    			$row[$rowCount]['archive']=$temp;
    			$sum_archive=$sum_archive+$temp;
                //总建档率
    			@$archive_rate=round($temp/$population,4);
    			$row[$rowCount]['archive_rate']=round(($archive_rate)*100,4);
    			
                //为线形图准备数据
                $j=0;
                for($i=12;$i>0;$i--)
                {
                    $temp=0;
                    $time=mktime(0,0,0,date('n',$end_time)-$i,date('d',$end_time),date('Y',$end_time));
                    $individual_core=new Tindividual_core();
    				$individual_core->whereAdd("individual_core.region_path like '".$region->region_path."%'");
    				$individual_core->whereAdd("individual_core.updated <='$time'");
    				$temp=$individual_core->count();
                    $row['line'][$rowCount]['archive'][$j]=$temp;
                    $row['line']['x'][$j]=date('Y/m/d',$time);
                    $j++;
                }
                $row['line']['axisname'][$rowCount]=$row[$rowCount]['zh_name'];
                
                //统计时间段内
                /*$archive_rate_last_year=0;
				$individual_core=new Tindividual_core();
				$individual_core->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$individual_core->whereAdd("individual_core.updated >='$start_time'");
				$individual_core->whereAdd("individual_core.updated <='$end_time'");
				$temp=$individual_core->count();
                $individual_core->free_statement();
                $sum_archive_last_year=$sum_archive_last_year+$temp;
				$row[$rowCount]['archive_last_year']=$temp;
    			//过去一年建档率
    			@$archive_rate_last_year=$temp/$population;
    			$row[$rowCount]['archive_rate_last_year']=round(($archive_rate_last_year)*100,2);*/
    			$rowCount++;
	      }
                $row['total']['sum_population']=$sum_population;
                $row['total']['sum_archive']=$sum_archive;
                $row['total']['sum_archive_rate']=round($sum_archive/$sum_population,2)*100;
                //$row['total']['sum_archive_last_year']=$sum_archive_last_year;
                //$row['total']['sum_archive_rate_last_year']=round($sum_archive_last_year/$sum_population,2)*100;
                create_php_cache($filename,$row);
		}
        else
        {
			require($filename);
            $row=$rows;
		}		
		return $row;
	}
	public function listAction(){
		//$_start_time=microtime(true);
		//echo $this->regionDomain.'}'.$this->p_id;
		$row=$this->getData($this->regionDomain,$this->start_time,$this->end_time,$this->p_id);
		$this->view->assign('sum_population',$row['total']['sum_population']);
		$this->view->assign('sum_archive',$row['total']['sum_archive']);
		$this->view->assign('sum_archive_rate',$row['total']['sum_archive_rate']);
		//$this->view->assign('sum_archive_last_year',$row['total']['sum_archive_last_year']);
		//$this->view->assign('sum_archive_rate_last_year',$row['total']['sum_archive_rate_last_year']);
		unset($row['total']);
        unset($row['line']);
		$this->view->assign("row",$row);
		$this->view->assign('basePath',__BASEPATH);

		//var_dump($data_array);
		/*		$this->session->data_pie=$data_array_pie;
		$this->session->data_bar=$data_array_bar;
		$this->session->data_line=$data_array_line;
		$this->session->data_pie_x_array=$x_array_pie;
		$this->session->data_bar_x_array=$x_array_bar;
		$this->session->data_line_x_array=$x_array_line;*/
		$this->view->display('list.html');
		//echo microtime(true)-$_start_time."<br />";
	}
	/**
	 * admindecision_ihaController::lineAction()
	 * 
     * 画线形图 2012-10-26 我好笨重写
     * 
	 * @return void
	 */
	public function lineAction()
    {
		$row=$this->getData($this->regionDomain,$this->start_time,$this->end_time,$this->p_id);
        $line=$row['line'];
		$data=array();
		$i=0;
        unset($row['line']['x'],$row['line']['axisname']);
		foreach ($row['line'] as $k=>$v)
		{
			$data[$k]=$v['archive'];
			$data[$k]['axisname']=$line['axisname'][$k];
		}
        $x_array=$line['x'];
		echo xml_draw_line($data,$x_array,"人数","人","建档进度表",341,230);
		exit;
	}
    /**
	 * admindecision_ihaController::lineAction()
	 * 
     * 2013-5-22 将建档数改为建档率 whx 
     * 
	 * @return void
	 */
	public function pieAction()
    {
		$row=$this->getData($this->regionDomain,$this->start_time,$this->end_time,$this->p_id);
		unset($row['total']);
        unset($row['line']);
		$data=array();
		$i=0;
		
		foreach ($row as $k=>$v)
		{	
			$data[0]['number']=$v['archive_rate'];
			$data[0]['axisname']="建档率";
			$x_array[$i]=$v['zh_name'];
            $i++;
		}
		echo xml_draw_3d_bar($data,$x_array,"人数","%","健康档案建档率","3d column",341,230);
		exit();
	}
    /**
	 * admindecision_ihaController::lineAction()
	 * 
     * 画柱形图 2012-10-26 我好笨重写
     * 
	 * @return void
	 */
	public function barAction()
    {
		$row=$this->getData($this->regionDomain,$this->start_time,$this->end_time,$this->p_id);
		unset($row['total']);
        unset($row['line']);
		$data=array();
		$i=0;
		foreach ($row as $k=>$v)
		{
			$data[0][$k]=$v['population'];
			$data[0]['axisname']="地区人口数";
			$data[1][$k]=$v['archive'];
			$data[1]['axisname']="已建档人数";
			$x_array[]=$v['zh_name'];
		}
		echo xml_draw_3d_bar($data,$x_array,"人数","人","健康档案建档数","3d column",341,230);
		exit();
	}
}