<?php
/**
* @author：Lake
* @filename: ylywController.php
* @package：个人健康档案综合统计 - 医疗业务对比图
* @create：2011-09-24
*/
class admindecision_ylywController extends controller{
	
	/**
		门诊人次	mzrc
		急诊人次	jzrc
		入院人次	ryrc
		出院人次	cyrc
		在院人数	zyrs
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
		
		require_once(__SITEROOT.'library/Myauth.php');
		$this->auth = Zend_Auth::getInstance();
		$this->user = $this->auth->getIdentity();
		
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Myauth.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->basePath = $this->_request->getBasePath();
		
		$this->regionDomain = $this->user['region_id'];
		//获取父分类ID，选择下级分类的时候需要
		$p_id = $this->_request->getParam('region_id','');
		$this -> p_id = empty($p_id)?$this -> regionDomain:$p_id;
		
		//医疗业务使用表
		require_once(__SITEROOT.'library/Models/tb_yw_ywltj.php');
		$this->view->region = $this->_request->getParam('region');
		
		$this->field = $this->_request->getParam('field','jzrc');
		$this->view->field = $this->field;
		//时间
		$this->start_time=$this->_request->getParam('start_time','2011-01-01');
		$this->end_time=$this->_request->getParam('end_time',date('Y-m-d'));
		
		$this -> getYlywData( $this->field );
		
	}
	
	public function indexAction(){
		
		$this->view->display("index.html");
	}
	
	public function barAction()
	{
		$zhName = array('mzrc'=>'门诊人次','jzrc'=>'急诊人次','ryrc'=>'入院人次','cyrc'=>'出院人次','zyrs'=>'在院人数');
		
		//门诊人数mzrc  入院人次ryrc
		if( $this->field == 'mzrc' || $this->field == 'ryrc') {
			$start_time = $this->start_time;
			$end_time = $this->end_time;
			$row = array();			
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
			for ( $i = 0; $i < $colSpnCount; $i++ ) {
				$start_time = $i==0?$start_time:date('Y-m-d',strtotime('+1months',strtotime($start_time)));
				$end_time = date('Y-m-d',strtotime('+1months',strtotime($start_time)));
				$x_array[] = $start_time;
				$data = array();
				$rows = array();
				$rows = $this->getYlywData($this->field,$start_time,$end_time);
				unset($rows['total']);
				$data = $this->formartTo3D( $rows );
				foreach ($data as $key => $val) {
					 $row[$key][]=empty($row[$key]['0']) ? $val['0'] : array_merge($row[$key]['0'],$val['0']);
					 $row[$key]['axisname']=$val['axisname'];
				}
			}
			echo xml_draw_line($row,$x_array,"人数","人",$zhName[$this->field]."对比图",311,220);
			exit;
		}
		
		$data = array();
		$rows = $this -> getYlywData( $this->field );
		unset($rows['total']);
		$data = $this -> formartTo3D( $rows );
		
		$x_array=array( $zhName[$this->field] );
		echo xml_draw_3d_bar($data,$x_array,"人数","人",$zhName[$this->field]."对比图","3d column",341,220);
		exit;
	}
	
	public function listAction() {
		
		if( $this->field == 'mzrc' || $this->field == 'ryrc') {
			//...无图
		}else {
			$rows = $this->getYlywData($this->field);
			$this->view->assign('total', $rows['total']);
			unset($rows['total']);
			$this->view->assign('row',$rows);
			$this->view->display('list.html');
		}
		
	}
	
	/**
	 * 返回指定数据
	 */
	private function getYlywData( $field = null, $start_time = 0, $end_time = 0 ) {
		
		$start_time=$start_time?$start_time:$this->start_time;
		$end_time=$end_time?$end_time:$this->end_time;
		
		$file_md5=md5($field.$start_time.$end_time.$this->p_id);
		$filename=__SITEROOT."cache/admindecision_ylyw_$file_md5.php";
		if (!file_exists($filename) || (time()-filemtime($filename))>=$this->cache_time)
		{
			//获取父分类ID，选择下级分类的时候需要
			$this->view->assign('start_time',$start_time);
			$this->view->assign('end_time',$end_time);
			$start_time=date("Ymd",strtotime($start_time));
			$end_time=date("Ymd",strtotime($end_time));
	
			$region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("p_id='$this->p_id'");
			$region->orderby('id asc');
			$region->find();
			$row = array();
			$rowCount=0;
			$sum_mzrc=0;
			$sum_jzrc=0;
			$sum_ryrc=0;
			$sum_cyrc=0;
			$sum_zyrs=0;
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
					$org->free();
					
				}
				//取本区域下的机构
				$row[$rowCount]['organization']=get_organization_id($region->region_path);
				//防止机构为空时报错
				$row[$rowCount]['organization']=$row[$rowCount]['organization']?$row[$rowCount]['organization']:"' '";
	
				//取统计数据
				$tb_yw_ywltj=new Ttb_yw_ywltj(2);
				$tb_yw_ywltj->selectAdd("sum(mzrc) mzrc,sum(jzrc) jzrc,sum(ryrc) ryrc,sum(cyrc) cyrc,sum(zyrs) zyrs");
				$tb_yw_ywltj->whereAdd("yljgdm in (".$row[$rowCount]['organization'].")");
				$tb_yw_ywltj->whereAdd("ywsj >= '$start_time'");
				$tb_yw_ywltj->whereAdd("ywsj <= '$end_time'");
				$tb_yw_ywltj->find(true);
				$row[$rowCount]['mzrc']=intval($tb_yw_ywltj->mzrc);
				$row[$rowCount]['jzrc']=intval($tb_yw_ywltj->jzrc);
				$row[$rowCount]['ryrc']=intval($tb_yw_ywltj->ryrc);
				$row[$rowCount]['cyrc']=intval($tb_yw_ywltj->cyrc);
				$row[$rowCount]['zyrs']=intval($tb_yw_ywltj->zyrs);
				$sum_mzrc+=$row[$rowCount]['mzrc'];
				$sum_jzrc+=$row[$rowCount]['jzrc'];
				$sum_ryrc+=$row[$rowCount]['ryrc'];
				$sum_cyrc+=$row[$rowCount]['cyrc'];
				$sum_zyrs+=$row[$rowCount]['zyrs'];
				$rowCount++;
				
				unset($current_level);
				unset($tb_yw_ywltj);
				
			}
			$row['total']['sum_mzrc'] = $sum_mzrc;
			$row['total']['sum_jzrc'] = $sum_jzrc;
			$row['total']['sum_ryrc'] = $sum_ryrc;
			$row['total']['sum_cyrc'] = $sum_cyrc;
			$row['total']['sum_zyrs'] = $sum_zyrs;

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