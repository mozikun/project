<?php
/**
 * 床位使用表
 *
 */
class his_cwsylController extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		require_once(__SITEROOT.'library/Models/tb_yw_cwsyl_v.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->basePath = __BASEPATH;
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
			$tb_yl_patient_information  = new Ttb_his_patinf(2);
			$tb_yl_patient_information -> whereAdd('identity_number='.$identity_number);
			$tb_yl_patient_information -> find(true);
			$search = array('kh' => empty( $tb_yl_patient_information -> kh ) ? '000' : $tb_yl_patient_information -> kh , 
							'klx' => empty( $tb_yl_patient_information -> klx ) ? '000' : $tb_yl_patient_information -> klx,
							);
		}else {
			$search = array('xm'=>$patientname);
		}
		$current_org = get_organization_id($current_region_path);
		//查询总数
		$Ttb_yw_cwsyl = new Ttb_yw_cwsyl( 2 );
        $Ttb_yw_cwsyl->whereAdd("yljgdm in (".$current_org.")");
		//$k是字段名$v是表单输入框的名字
		foreach($search as $k=>$v){
		     $myvalue = trim($v);
		     if(!empty($myvalue)){
		     	$Ttb_yw_cwsyl->whereAdd("$k"."="."'$myvalue'");
		     }
		}
		$nums = $Ttb_yw_cwsyl->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/cwsyl/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		
		$Ttb_yw_cwsyl->limit($startnum,__ROWSOFPAGE);
		$Ttb_yw_cwsyl->find();
		$row = array();
		$count = 0;
		while($Ttb_yw_cwsyl->fetch()) {
			$org   = new Torganization();
			$org->whereAdd("standard_code='".trim($Ttb_yw_cwsyl->yljgdm)."'");
			$org->find(true);
			$row[$count]['id']             		= $Ttb_yw_cwsyl->yljgdm;//
			$row[$count]['yljgdm']              = $org->zh_name;//机构名
			$row[$count]['ksmc']                = $Ttb_yw_cwsyl->ksmc;//科室名称
			$row[$count]['edcw']            	= $Ttb_yw_cwsyl->edcw;//编制床位数
			$row[$count]['sjcws']             	= $Ttb_yw_cwsyl->sjcws;//每日实际床位数
			$row[$count]['sjkfcws']             = $Ttb_yw_cwsyl->sjkfcws;//每日实际开放床位数
			$row[$count]['sycw']              	= $Ttb_yw_cwsyl->sycw;//每日实际使用床位数
			$row[$count]['tbrq']              	= $Ttb_yw_cwsyl->tbrq;//填报日期
			$count++;
		}
		$Ttb_yw_cwsyl->free_statement();
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
		$tb_yw_cwsyl = new Ttb_yw_cwsyl( 2 );
		$tb_yw_cwsyl->whereAdd("yljgdm='$id'");
		//$tb_yw_cwsyl->debugLevel(2);
		$tb_yw_cwsyl->find();
		$tb_yw_cwsyl->fetch();
		$this->view->tb_yw_cwsyl=$tb_yw_cwsyl;	
		//print_r($tb_yw_cwsyl)	;
		$tb_yw_cwsyl->free_statement();
		$this->view->display('display.html');
	}
}