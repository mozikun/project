<?php
/**
* @author：Lake
* @filename: ywsrtjController.php
* @package：个人健康档案综合统计 - 业务收入对比图
* @create：2011-09-25
*/
class admindecision_ywsrtjController extends controller{
	
	/**
		门急诊医疗费用	mjzylfy
		住院医疗费用	zyylfy
		门急诊药品费用	mjzypfy
		住院药品费用	zyypfy
		门急诊医保医疗费用	mjzybylfy
		住院医保医疗费用	zyybylfy
		门急诊医保药品费用	mjzybypfy
		住院医保药品费用	zyybypfy
	 */
	private $field;//指定获取哪一个字段的统计图
	private $start_time;//开始时间 0000-00-00
	private $end_time;//结束时间0000-00-00
	private $regionDomain;
	private $p_id;
	private $cache_time=__CACHING_LEFTTIME;
	
	public function  init(){
		set_time_limit(0);
		//require_once(__SITEROOT.'library/privilege.php');
		
		require_once(__SITEROOT.'library/MyAuth.php');
		$this->auth = Zend_Auth::getInstance();
		$this->user = $this->auth->getIdentity();
		
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->basePath = $this->_request->getBasePath();
		
		$this->regionDomain = $this->user['region_id'];
		//获取父分类ID，选择下级分类的时候需要
		$p_id = $this->_request->getParam('region_id','');
		$this -> p_id = empty($p_id)?$this -> regionDomain:$p_id;
		
		//业务收入统计表
		require_once(__SITEROOT.'library/Models/tb_yw_ywsrtj.php');
		$this->view->region = $this->_request->getParam('region');
		$this->field = $this->_request->getParam('field','zyylfy');
		$this->view->field = $this->field;
		
		//时间
		$this->start_time=$this->_request->getParam('start_time','2011-01-01');
		$this->end_time=$this->_request->getParam('end_time',date('Y-m-d'));
		
		$this -> getYwsrtjData( $this->field );
		
	}
	
	public function indexAction(){
		
		$this->view->display("index.html");
	}
	
	public function barAction()
	{
		$zhName = array('mjzylfy'=>'门急诊医疗费用','zyylfy'=>'住院医疗费用','mjzypfy'=>'门急诊药品费用',
		'zyypfy'=>'住院药品费用','mjzybylfy'=>'门急诊医保医疗费用','zyybylfy'=>'住院医保医疗费用',
		'mjzybypfy'=>'门急诊医保药品费用','zyybypfy'=>'住院医保药品费用');
		//mjzylfymjzylfy 显示折线图
		if( $this->field=='mjzylfy') {
			$start_time=$this->start_time;
			$end_time=$this->end_time;
			$row=array();		
			//获取从start_time到end_time一共有多个月
			$now=explode("-",date("Y-m-d",strtotime($start_time)));
			$second=mktime(23,59,59,$now['1'],$now['2'],$now['0']);
			$colSpnCount=0;
			while ($second<=strtotime($end_time)){
				$startAndEndDateArray[$colSpnCount]['endDate']=$second;
				//得到x轴的时间列表$x_array=array("2011-09-21","2011-09-22","2011-09-23","2011-09-24","2011-09-25","2011-09-26");
				$x_array_line[]=date("Y-m",$second);
				$now=explode("-",date("Y-m-d",$second));
				$second=mktime(0,0,0,$now['1']+1,$now['2'],$now['0']);
				$startAndEndDateArray[$colSpnCount]['startDate']=$second;
				$colSpnCount++;//统计有多少个月份,用于显示表格时确定列的跨度
			}
			/**
			 * 格式化数据
			 * 目标数据：折线图
			 * $data[0]=array("20","31","45","12","98","13");
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
			 */
			for ( $i = 0; $i < $colSpnCount + 1; $i++ ) {
				$start_time = $i==0?$start_time:date('Y-m-d',strtotime('+1months',strtotime($start_time)));
				$end_time = date('Y-m-d',strtotime('+1months',strtotime($start_time)));
				$x_array[] = $start_time;
				$data = array();
				$rows = array();
				$rows = $this->getYwsrtjData($this->field,$start_time,$end_time);
				unset($rows['total']);
				$data = $this->formartTo3D( $rows );
				foreach ($data as $key => $val) {
					 $row[$key][]=empty($row[$key]['0']) ? $val['0'] : array_merge($row[$key]['0'],$val['0']);
					 $row[$key]['axisname']=$val['axisname'];
				}
			}
			echo xml_draw_line($row,$x_array,"人数","人",$zhName[$this->field]."对比图",309,190);
			exit;
		}
		
		$data = array();
		$rows = $this -> getYwsrtjData( $this->field );
		unset($rows['total']);
		$data = $this -> formartTo3D( $rows );
		
		$x_array=array( $zhName[$this->field] );
		echo xml_draw_3d_bar($data,$x_array,"人数","人",$zhName[$this->field].'对比图',"3d column",309,220);
		exit;
	}
	
	public function listAction() {
		$region=$this->_request->getParam('region');
		if( $this->field == 'mjzylfy') {
			//...无图
		}else {
			$rows = $this->getYwsrtjData($this->field);
			$this->view->assign('total', $rows['total']);
			unset($rows['total']);
			$this->view->assign('row',$rows);
			$this->view->display('list.html');
		}
		
	}
	
	/**
	 * 返回指定数据
	 */
	private function getYwsrtjData( $field = null, $start_time = 0, $end_time = 0 ) {
		
		$start_time=$start_time?$start_time:$this->start_time;
		$end_time=$end_time?$end_time:$this->end_time;
		
		$file_md5=md5($field.$start_time.$end_time.$this->p_id);
		$filename=__SITEROOT."cache/admindecision_ywsrtj_$file_md5.php";
		if (!file_exists($filename) || (time()-filemtime($filename))>=$this->cache_time)
		{
		
			//获取父分类ID，选择下级分类的时候需要
			$this->view->assign('start_time',$start_time);
			$this->view->assign('end_time',$end_time);
			$start_time = date('Ymd',strtotime($start_time));
			$end_time   = date('Ymd',strtotime($end_time));
	
			$region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("p_id='$this->p_id'");
			$region->orderby('id asc');
			$region->find();
			$row = array();
			$rowCount=0;
			$sum_mjzylfy =0;
			$sum_zyylfy =0;
			$sum_mjzypfy =0;
			$sum_zyypfy =0;
			$sum_mjzybylfy =0;
			$sum_zyybylfy =0;
			$sum_mjzybypfy =0;
			$sum_zyybypfy =0;
			while($region->fetch())
			{
				$row[$rowCount]['id'] = trim($region->id);
				$row[$rowCount]['zh_name'] = $region->zh_name;
				$row[$rowCount]['region_path'] = $region->region_path;
				$row[$rowCount]['p_id'] = trim($region->p_id);
				$row[$rowCount]['standard_code'] = trim($region->standard_code);
				$current_level = count(explode(',',$region->region_path));
				//显示建档机构名称，用于最后一级
				if($current_level==6)
				{
					$org=new Torganization();
					$org->whereAdd("region_path='$region->region_path'");
					$org->find(true);
					$row[$rowCount]['org_zh_name'] =$org->zh_name;
					$this->view->td_title='2';
				}
				//取本区域下的机构
				$row[$rowCount]['organization']=get_organization_id($region->region_path);
				$row[$rowCount]['organization']=$row[$rowCount]['organization']?$row[$rowCount]['organization']:"' '";
				//取统计数据
				$tb_yw_ywsrtj=new Ttb_yw_ywsrtj(2);
				$tb_yw_ywsrtj->selectAdd("sum(mjzylfy) mjzylfy,sum(zyylfy) zyylfy,sum(mjzypfy) mjzypfy,sum(zyypfy) zyypfy,sum(mjzybylfy) mjzybylfy,sum(zyybylfy) zyybylfy,sum(mjzybypfy) mjzybypfy,sum(zyybypfy) zyybypfy");
				$tb_yw_ywsrtj->whereAdd("yljgdm in (".$row[$rowCount]['organization'].")");
				$tb_yw_ywsrtj->whereAdd("ywsj >= '$start_time'");
				$tb_yw_ywsrtj->whereAdd("ywsj <= '$end_time'");
				$tb_yw_ywsrtj->find(true);
				$row[$rowCount]['mjzylfy']=intval($tb_yw_ywsrtj->mjzylfy);
				$row[$rowCount]['zyylfy']=intval($tb_yw_ywsrtj->zyylfy);
				$row[$rowCount]['mjzypfy']=intval($tb_yw_ywsrtj->mjzypfy);
				$row[$rowCount]['zyypfy']=intval($tb_yw_ywsrtj->zyypfy);
				$row[$rowCount]['mjzybylfy']=intval($tb_yw_ywsrtj->mjzybylfy);
				$row[$rowCount]['zyybylfy']=intval($tb_yw_ywsrtj->zyybylfy);
				$row[$rowCount]['mjzybypfy']=intval($tb_yw_ywsrtj->mjzybypfy);
				$row[$rowCount]['zyybypfy']=intval($tb_yw_ywsrtj->zyybypfy);
				$sum_mjzylfy+=$row[$rowCount]['mjzylfy'];
				$sum_zyylfy+=$row[$rowCount]['zyylfy'];
				$sum_mjzypfy+=$row[$rowCount]['mjzypfy'];
				$sum_zyypfy+=$row[$rowCount]['zyypfy'];
				$sum_mjzybylfy+=$row[$rowCount]['mjzybylfy'];
				$sum_zyybylfy+=$row[$rowCount]['zyybylfy'];
				$sum_mjzybypfy+=$row[$rowCount]['mjzybypfy'];
				$sum_zyybypfy+=$row[$rowCount]['zyybypfy'];
				$rowCount++;
			}

			$row['total']['sum_mjzylfy'] = $sum_mjzylfy;
			$row['total']['sum_zyylfy'] = $sum_zyylfy;
			$row['total']['sum_mjzypfy'] = $sum_mjzypfy;
			$row['total']['sum_zyypfy'] = $sum_zyypfy;
			$row['total']['sum_mjzybylfy'] = $sum_mjzybylfy;
			$row['total']['sum_zyybylfy'] = $sum_zyybylfy;
			$row['total']['sum_mjzybypfy'] = $sum_mjzybypfy;
			$row['total']['sum_zyybypfy'] = $sum_zyybypfy;

			create_php_cache($filename,$row);
		}else {
			$row = array();
			require($filename);
			$row=$rows;
		}
			return $row;
		
	}
	
	private function formartTo3D( $row ) {
		//格式化 返回数据，指定返回哪一个字段的值，是指统计一个字段的值$field
		$reRow = array();
		$reNu = 0;
		
		foreach ( $row as $key => $val ) {
			$reRow[$reNu] = array($val[$this->field]);
			$reRow[$reNu]['axisname'] = $val['zh_name'];
			$reNu++;
		}
		return $reRow;
	}
	
}