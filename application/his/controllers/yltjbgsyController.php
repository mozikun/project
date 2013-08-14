<?php
/**
 * 体检报告首页
 *
 */
class his_yltjbgsyController extends controller{
    private $xb;
    private $xgbz;
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/tb_yl_patient_information_v.php');
		require_once(__SITEROOT.'library/Models/tb_yl_tjbgsy_v.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->basePath = __BASEPATH;
        $this->xb=array(0=>'未知的性别',1=>'男',2=>'女',9=>'未说明的性别');
        $this->xgbz=array('1'=>'正常','2'=>'修改','3'=>'撤销');
	}
	/**
	 * 列表
	 *
	 */
	public function listAction(){
		$current_region_path = $this->user['current_region_path'];
		
		$patientname      = $this->_request->getParam('patientname');
		$identity_number  = $this->_request->getParam('identity_number');
		
		//如何用户通过身份证查询，先查询患者基本信息表，通过身份证得到患者卡号和卡类型。再查询门诊就诊表内的记录
		if( !empty( $identity_number ) ) {
			$tb_yl_patient_information  = new Ttb_yl_patient_information(2);
			$tb_yl_patient_information -> whereAdd('identity_number='.$identity_number);
			$tb_yl_patient_information -> find(true);
			$search = array('kh' => empty( $tb_yl_patient_information -> kh ) ? '000' : $tb_yl_patient_information -> kh , 
							'klx' => empty( $tb_yl_patient_information -> klx ) ? '000' : $tb_yl_patient_information -> klx,
							);
		}else {
			$search = array('xm'=>$patientname);
		}
		$current_org = get_organization_id($current_region_path);
		//查询体检报告首页总数
		$Ttb_yl_tjbgsy = new Ttb_yl_tjbgsy( 2 );
        $Ttb_yl_tjbgsy->whereAdd("yljgdm in (".$current_org.")");
		//$k是字段名$v是表单输入框的名字
		foreach($search as $k=>$v){
		     $myvalue = trim($v);
		     if(!empty($myvalue)){
		     	$Ttb_yl_tjbgsy->whereAdd("$k"."="."'$myvalue'");
		     }
		}
		$nums = $Ttb_yl_tjbgsy->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/yltjbgsy/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		
		$Ttb_yl_tjbgsy->limit($startnum,__ROWSOFPAGE);
		$Ttb_yl_tjbgsy->find();
		$row = array();
		$count = 0;
		while($Ttb_yl_tjbgsy->fetch()) {
			$org   = new Torganization();
			$org->whereAdd("standard_code='".trim($Ttb_yl_tjbgsy->yljgdm)."'");
			$org->find(true);
			$row[$count]['yljgdm']              = $org->zh_name;//机构名
			$row[$count]['id']              	= $Ttb_yl_tjbgsy->tjbh;//体检编号
			$row[$count]['xm']                	= $Ttb_yl_tjbgsy->xm;//病人姓名
			$row[$count]['xb']            		= $this->xb[$Ttb_yl_tjbgsy->xb];//病人性别
			$row[$count]['nl']             		= $Ttb_yl_tjbgsy->nl;//年龄
			$row[$count]['zjrq']              	= $Ttb_yl_tjbgsy->zjrq;//总检日期
			
			$count++;
		}
		$Ttb_yl_tjbgsy->free_statement();
		$this->view->row         =  $row;
		$page = $links->subPageCss2();
		$this->view->page  = $page;
		$this->view->display('list.html');

	}
	/**
	 * 详细信息
	 *
	 */
	public function displayAction(){
		$id      		= $this->_request->getParam('id');
		if(empty($id)){
			new Exception("参数错误！");
		}
		$tb_yl_tjbgsy 	= new Ttb_yl_tjbgsy( 2 );
		$tb_yl_tjbgsy->whereAdd("tjbh='$id'");
		//$tb_yl_tjbgsy->debugLevel(2);
		$tb_yl_tjbgsy->find();
		$tb_yl_tjbgsy->fetch();
		$this->view->tb_yl_tjbgsy=$tb_yl_tjbgsy;//体检报告首页
		//print_r($tb_yl_tjbgsy)	;
		$tb_yl_tjbgsy->free_statement();
		$tjbh			= $tb_yl_tjbgsy->tjbh;//体检编号
	
		if(!empty($tjbh)){
			require_once(__SITEROOT.'library/Models/tb_yl_tjbg_v.php');//体检分科（分组）报告
			require_once(__SITEROOT.'library/Models/tb_yl_tjmx_v.php');//体检明细表
			$tb_yl_tjbg 	= new Ttb_yl_tjbg();//体检分科（分组）报告
			$tb_yl_tjbg->whereAdd("tjbh='$tjbh'");
			$tb_yl_tjbg->find();
			$tb_yl_tjbg_array=array();//分科报告流水号返回结果
			$tb_yl_tjmx_array=array();//体检明细表返回结果
			while ($tb_yl_tjbg->fetch()) {
				$tb_yl_tjbg_array[]=$tb_yl_tjbg;
				$bglsh		= $tb_yl_tjbg->bglsh;//分科报告流水号

				if(!empty($bglsh)){
					$tb_yl_tjmx = new Ttb_yl_tjmx();//体检明细表
					$tb_yl_tjmx->whereAdd("bglsh='$bglsh'");
					$tb_yl_tjmx->find();
					while ($tb_yl_tjmx->fetch()) {
						$tb_yl_tjmx_array[]=$tb_yl_tjmx;
					}
					$tb_yl_tjmx->free_statement();
				}
				
			}
			$tb_yl_tjbg->free_statement();

			$this->view->tb_yl_tjbg_array=$tb_yl_tjbg_array;//分科报告流水号
			$this->view->tb_yl_tjmx_array=$tb_yl_tjmx_array;//体检明细表
		
		}
		$this->view->display('display.html');
	}
}