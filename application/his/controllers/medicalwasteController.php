<?php
/**
 * 医疗废物转移记录表
 *
 */
class his_medicalwasteController extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/tb_yl_patient_information_v.php');
		require_once(__SITEROOT.'library/Models/tb_zh_medicalwaste_transport_v.php');
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
		
		//如何用户通过身份证查询，先查询患者基本信息表，通过身份证得到患者卡号和卡类型。再查询表内的记录
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
		//查询总数
		$Ttb_zh_medicalwaste_transport = new Ttb_zh_medicalwaste_transport( 2 );
        $Ttb_zh_medicalwaste_transport->whereAdd("yljgdm in (".$current_org.")");
		//$k是字段名$v是表单输入框的名字
		foreach($search as $k=>$v){
		     $myvalue = trim($v);
		     if(!empty($myvalue)){
		     	$Ttb_zh_medicalwaste_transport->whereAdd("$k"."="."'$myvalue'");
		     }
		}
		$nums = $Ttb_zh_medicalwaste_transport->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/medicalwaste/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		
		$Ttb_zh_medicalwaste_transport->limit($startnum,__ROWSOFPAGE);
		$Ttb_zh_medicalwaste_transport->find();
		$row = array();
		$count = 0;
		while($Ttb_zh_medicalwaste_transport->fetch()) {
			$org   = new Torganization();
			$org->whereAdd("standard_code='".trim($Ttb_zh_medicalwaste_transport->yljgdm)."'");
			$org->find(true);
			$row[$count]['id']            			= $Ttb_zh_medicalwaste_transport->id;//ID
			$row[$count]['yljgdm']            		= $org->zh_name;//机构名
			$row[$count]['ylfwczdw']                = $Ttb_zh_medicalwaste_transport->ylfwczdw;//医疗废物处置单位
			$row[$count]['grxfwtj']            		= $Ttb_zh_medicalwaste_transport->grxfwtj;//感染性废物及其他-体积（箱）
			$row[$count]['grxfwzl']             	= $Ttb_zh_medicalwaste_transport->grxfwzl;//感染性废物及其他-重量（KG）
			$row[$count]['ssxfwtj']              	= $Ttb_zh_medicalwaste_transport->ssxfwtj;//损伤性废物-体积（盒）
			$row[$count]['ssxfwzl']              	= $Ttb_zh_medicalwaste_transport->ssxfwzl;//损伤性废物-重量（KG）
			$row[$count]['jjsj']              		= $Ttb_zh_medicalwaste_transport->jjsj;//交接时间
			$row[$count]['tbrq']              		= $Ttb_zh_medicalwaste_transport->tbrq;//填报日期
			$count++;
		}
		$Ttb_zh_medicalwaste_transport->free_statement();
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
		$id      					= $this->_request->getParam('id');
		if(empty($id)){
			new Exception("参数错误！");
		}
		$tb_zh_medicalwaste_transport  = new Ttb_zh_medicalwaste_transport(2);
		$tb_zh_medicalwaste_transport->whereAdd("id='$id'");
		$tb_zh_medicalwaste_transport->find();
		$tb_zh_medicalwaste_transport->fetch();
		$this->view->medicalwaste_transport=$tb_zh_medicalwaste_transport;		
		$tb_zh_medicalwaste_transport->free_statement();
		$this->view->display('display.html');
		
		
	}
}