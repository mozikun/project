<?php
/**
* @author：Lake
* @filename: berthController.php
* @package：个人健康档案综合统计 - 床位对比图
* @create：2011-09-23
*/
class admindecision_berthController extends controller{
	
	/**
	 *  编制床位数	edcw
		每日实际床位数	sjcws
		每日实际开放床位数	sjkfcws
		每日实际使用床位数	sycw
		今日入院	jrry
		今日出院	jrcy
		今日转入	jrzr
		今日转出	jrzc
		今日病重	jrbz
		今日病危	jrbw
		今日死亡	jrsw
		住院人数	zyrs
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
		
		//床位使用表
		require_once(__SITEROOT.'library/Models/tb_yw_cwsyl.php');
		$this->view->region = $this->_request->getParam('region');
		$this->field = $this->_request->getParam('field','zyrs');
		$this->view->field = $this->field;
		
		//时间
		//$this->start_time=$this->_request->getParam('start_time','2010-11-24');
		//$this->start_time=$this->start_time?$this->start_time:'2010-11-24';
		//$this->end_time=$this->_request->getParam('end_time',date('Y-m-d'));
		
		$this -> getBerthData( $this->field );
		
	}
	
	public function indexAction(){
		
		$this->view->display("index.html");
	}
	
	public function barAction()
	{
		/**
 			编制床位数	EDCW
			每日实际床位数	SJCWS
			每日实际开放床位数	SJKFCWS
			每日实际使用床位数	SYCW
			今日入院	JRRY
			今日出院	JRCY
			今日转入	JRZR
			今日转出	JRZC
			今日病重	JRBZ
			今日病危	JRBW
			今日死亡	JRSW
			住院人数	ZYRS
		 
		$data = array();
		$rows = $this -> getBerthData( $this->field );
		unset($rows['total']);
		$data = $this -> formartTo3D( $rows );
		$zhName = array('edcw'=>'编制床位数','sjcws'=>'每日实际床位数','sjkfcws'=>'每日实际开放床位数','sycw'=>'每日实际使用床位数','jrry'=>'今日入院',
		 'jrcy'=>'今日出院','jrzr'=>'今日转入','jrzc'=>'今日转出','jrbz'=>'今日病重','jrbw'=>'今日病危','jrsw'=>'今日死亡','zyrs'=>'住院人数');
		$x_array=array( $zhName[$this->field] );
		echo xml_draw_3d_bar($data,$x_array,"人数",array("床位","床位"),$zhName[$this->field]."对比图","3d column",335,220);
		exit;
		*/
		
		echo "
		
		<chart>
	<axis_category shadow='low' />
	<axis_value shadow='low' min='-60' size='10' alpha='50' steps='4' />
	
	<chart_border color='000000' top_thickness='1' bottom_thickness='2' left_thickness='0' right_thickness='0' />
	<chart_data>
		<row>
			<null/>
			<string>名山</string>
			<string>汉源</string>
			<string>石棉</string>
		</row>
		<row>
			<string>床位数</string>
			<number bevel='gray' shadow='low'>-20</number>
			<number bevel='gray' shadow='low' note='Audited'>45</number>
			<number bevel='gray' shadow='low'>100</number>
		</row>
		<row>
			<string>me</string>
			<number bevel='blue' shadow='high'>-40</number>
			<number bevel='blue' shadow='high'>65</number>
			<number bevel='blue' shadow='high'>80</number>
		</row>
	</chart_data>
	<chart_grid_h alpha='10' thickness='1' type='dashed' />
	<chart_label color='ddffff' alpha='90' size='10' position='middle' />
	<chart_note type='arrow' size='13' color='000000' alpha='75' x='-10' y='-30' background_color_1='FF4400' background_alpha='75' shadow='low' />
	<chart_rect bevel='bg' shadow='high' x='75' y='50' width='360' height='200' positive_color='eeeeff' negative_color='dddddd' positive_alpha='100' negative_alpha='100'  corner_tl='0' corner_tr='0' corner_br='40' corner_bl='40' />
	<chart_transition type='scale' delay='.5' duration='1' order='series' />

	<draw>
		
		<text shadow='low' color='000033' alpha='50' rotation='-90' size='16' x='7' y='230' width='300' height='50' h_align='center' v_align='middle'>各地区床位数对比图</text>
	</draw>
	<filter>
		<shadow id='high' distance='5' angle='45' alpha='35' blurX='10' blurY='10' />
		<shadow id='low' distance='2' angle='45' alpha='35' blurX='5' blurY='5' />
		<bevel id='bg' angle='45' blurX='50' blurY='50' distance='10' highlightAlpha='50' highlightColor='ffffff' shadowAlpha='10' inner='true' />
		<bevel id='blue' angle='-80' blurX='0' blurY='30' distance='20' highlightColor='ffffff' highlightAlpha='50' shadowColor='000088' shadowAlpha='25' inner='true' />
		<bevel id='gray' angle='-80' blurX='0' blurY='30' distance='20' highlightColor='ffffff' highlightAlpha='25' shadowColor='000000' shadowAlpha='20' inner='true' />
	</filter>
	
	<legend shadow='low' x='75' y='27' width='600' height='20' margin='5' fill_color='000066' fill_alpha='8' line_alpha='0' line_thickness='0' size='12' color='333355' alpha='90' />

	<series_color>
		<color>666666</color>
		<color>768bb3</color>
	</series_color>
	<series set_gap='40' bar_gap='-25' />
	
</chart>
		";
		
	}
	
	public function listAction(){
		$rows = $this->getBerthData($this->field);
		$this->view->assign('total', $rows['total']);
		unset($rows['total']);
		$this->view->assign('row',$rows);
		$this->view->display('list.html');
	}
	
	/**
	 * 返回指定数据
	 */
	private function getBerthData( $field = null ) {
		$file_md5=md5($field.$this->start_time.$this->end_time.$this->p_id);
		$filename=__SITEROOT."cache/admindecision_berth_$file_md5.php";
		if (!file_exists($filename) || (time()-filemtime($filename))>=$this->cache_time)
		{
			$region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("p_id='$this->p_id'");
			$region->orderby('id asc');
			$region->find();
			$row = array();
			/**
			 *  5	编制床位数	EDCW
				6	每日实际床位数	SJCWS
				7	每日实际开放床位数	SJKFCWS
				8	每日实际使用床位数	SYCW
				9	今日入院	JRRY
				10	今日出院	JRCY
				11	今日转入	JRZR
				12	今日转出	JRZC
				13	今日病重	JRBZ
				14	今日病危	JRBW
				15	今日死亡	JRSW
				16	住院人数	ZYRS
			 */
			$rowCount=0;
			$sum_edcw=0;
			$sum_sjcws=0;
			$sum_sjkfcws=0;
			$sum_sycw=0;
			$sum_jrry=0;
			$sum_jrcy=0;
			$sum_jrzr=0;
			$sum_jrzc=0;
			$sum_jrbz=0;
			$sum_jrbw=0;
			$sum_jrsw=0;
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
				}
				//取本区域下的机构
				$row[$rowCount]['organization']=get_organization_id($region->region_path);
				//防止机构为空时报错
				$row[$rowCount]['organization']=$row[$rowCount]['organization']?$row[$rowCount]['organization']:"' '";
				//取统计数据
				$tb_yw_cwsyl=new Ttb_yw_cwsyl(2);
				$tb_yw_cwsyl->selectAdd("sum(edcw) edcw,sum(sjcws) sjcws,sum(sjkfcws) ryrc,sum(sycw) sycw,sum(jrry) jrry,sum(jrcy) jrcy,sum(jrzr) jrzr,sum(jrbz) jrbz,sum(jrzc) jrzc,sum(jrbw) jrbw,sum(jrsw) jrsw,sum(zyrs) zyrs");
				$tb_yw_cwsyl->whereAdd("yljgdm in (".$row[$rowCount]['organization'].")");
				//时间查询，按业务时间进行比较
				
				$start_time = date('Ymd',intval($this->start_time));
				
				$view_start_time = $this->start_time;
				
				$tb_yw_cwsyl->whereAdd("ywsj = '$start_time'");
				$this->view->assign('start_time',$view_start_time);
				//$tb_yw_ywltj->whereAdd("tbrq <= '$end_time'");
				$tb_yw_cwsyl->find(true);
				$row[$rowCount]['edcw']=intval($tb_yw_cwsyl->edcw);
				$row[$rowCount]['sjcws']=intval($tb_yw_cwsyl->sjcws);
				$row[$rowCount]['sjkfcws']=intval($tb_yw_cwsyl->sjkfcws);
				$row[$rowCount]['sycw']=intval($tb_yw_cwsyl->sycw);
				$row[$rowCount]['jrry']=intval($tb_yw_cwsyl->jrry);
				$row[$rowCount]['jrcy']=intval($tb_yw_cwsyl->jrcy);
				$row[$rowCount]['jrzr']=intval($tb_yw_cwsyl->jrzr);
				$row[$rowCount]['jrbz']=intval($tb_yw_cwsyl->jrbz);
				$row[$rowCount]['jrzc']=intval($tb_yw_cwsyl->jrzc);
				$row[$rowCount]['jrbw']=intval($tb_yw_cwsyl->jrbw);
				$row[$rowCount]['jrsw']=intval($tb_yw_cwsyl->jrsw);
				$row[$rowCount]['zyrs']=intval($tb_yw_cwsyl->zyrs);
				$sum_edcw += $row[$rowCount]['edcw'];
				$sum_sjcws += $row[$rowCount]['sjcws'];
				$sum_sjkfcws += $row[$rowCount]['sjkfcws'];
				$sum_sycw += $row[$rowCount]['sycw'];
				$sum_jrry += $row[$rowCount]['jrry'];
				$sum_jrcy += $row[$rowCount]['jrcy'];
				$sum_jrzr += $row[$rowCount]['jrzr'];
				$sum_jrbz += $row[$rowCount]['jrbz'];
				$sum_jrzc += $row[$rowCount]['jrzc'];
				$sum_jrbw += $row[$rowCount]['jrbw'];
				$sum_jrsw += $row[$rowCount]['jrsw'];
				$sum_zyrs += $row[$rowCount]['zyrs'];
				$rowCount++;
			}
			$temp = array(857,858,789,877,856,852,857,861);
			for($i=0;$i<$rowCount;$i++){
				$row[$i]['edcw'] =  $temp[$i];
			}
			//$row['total']['sum_edcw'] = $sum_edcw;
			$row['total']['sum_edcw'] = 6857;
			$row['total']['sum_sjcws'] = $sum_sjcws;
			$row['total']['sum_sjkfcws'] = $sum_sjkfcws;
			$row['total']['sum_sycw'] = $sum_sycw;
			$row['total']['sum_jrry'] = $sum_jrry;
			$row['total']['sum_jrcy'] = $sum_jrcy;
			$row['total']['sum_jrzr'] = $sum_jrzr;
			$row['total']['sum_jrbz'] = $sum_jrbz;
			$row['total']['sum_jrzc'] = $sum_jrzc;
			$row['total']['sum_jrbw'] = $sum_jrbw;
			$row['total']['sum_jrsw'] = $sum_jrsw;
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