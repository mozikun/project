<?php
/**
* @author：Lake
* @filename: zybaController.php
* @package：医疗业务 - 住院病案首页
* @create：2011-09-20
*/
class his_zybaController extends controller 
{
	public function init() {
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/MyAuth.php');
		require_once(__SITEROOT.'/library/custom/comm_function.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		$this->view->basePath = $this->_request->getBasePath();
		
		//住院病案首页主体表
		require_once (__SITEROOT."library/Models/tb_cis_main_v.php");
		//患者基本信息表
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
	}
	
	/**
	 * 门诊就诊信息列表
	 */
	public function listAction() {
		$current_region_path = $this->user['current_region_path'];
		$this->view->basePath = __BASEPATH;
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
		//查询门诊总数
		$Ttb_cis_main = new Ttb_cis_main( 2 );
        $Ttb_cis_main->whereAdd("yljgdm in (".$current_org.")");
		//$k是字段名$v是表单输入框的名字
		foreach($search as $k=>$v){
		     $myvalue = trim($v);
		     if(!empty($myvalue)){
		     	$Ttb_cis_main->whereAdd("$k"."="."'$myvalue'");
		     }
		}
		$nums = $Ttb_cis_main->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/zyba/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		
		$Ttb_cis_main->limit($startnum,__ROWSOFPAGE);
		$Ttb_cis_main->find();
		$row = array();
		$count = 0;
		while($Ttb_cis_main->fetch()) {
			$org   = new Torganization();
			$org->whereAdd("standard_code='".trim($Ttb_cis_main->yljgdm)."'");
			$org->find(true);
			$row[$count]['yljgdm']              = $org->zh_name;
			$row[$count]['xm']              = $Ttb_cis_main->xm;
			$row[$count]['jzlsh']              = $Ttb_cis_main->jzlsh;
			$row[$count]['bxlx']              = $Ttb_cis_main->bxlx;
			$row[$count]['rysj']              = $Ttb_cis_main->rysj;
			$row[$count]['rylx']              = $Ttb_cis_main->rylx;
			$row[$count]['bah']              = $Ttb_cis_main->bah;
			$count++;
		}
		$this->view->row         =  $row;
		$page = $links->subPageCss2();
		$this->view->page  = $page;
		$this->view->display('list.html');
	}
}
?>