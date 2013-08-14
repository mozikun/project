<?php
/**
 * 业务量统计表
 *
 */
class his_ywltjController extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		require_once(__SITEROOT.'library/Models/tb_yw_ywltj_v.php');
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
		
		//如何用户通过身份证查询，先查询患者基本信息表，通过身份证得到患者卡号和卡类型。再查询记录
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
		//总数
		$Ttb_yw_ywltj = new Ttb_yw_ywltj( 2 );
        $Ttb_yw_ywltj->whereAdd("yljgdm in (".$current_org.")");
		//$k是字段名$v是表单输入框的名字
		foreach($search as $k=>$v){
		     $myvalue = trim($v);
		     if(!empty($myvalue)){
		     	$Ttb_yw_ywltj->whereAdd("$k"."="."'$myvalue'");
		     }
		}
		$nums = $Ttb_yw_ywltj->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/ywltj/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		
		$Ttb_yw_ywltj->limit($startnum,__ROWSOFPAGE);
		$Ttb_yw_ywltj->find();
		$row = array();
		$count = 0;
		while($Ttb_yw_ywltj->fetch()) {
			$org   = new Torganization();
			$org->whereAdd("standard_code='".trim($Ttb_yw_ywltj->yljgdm)."'");
			$org->find(true);
			$row[$count]['id']               	= $Ttb_yw_ywltj->yljgdm;//医院机构代码
			$row[$count]['ksbm']                = $Ttb_yw_ywltj->ksbm;//科室编码
			
			$row[$count]['yljgdm']              = $org->zh_name;//机构名
			$row[$count]['ksmc']                = $Ttb_yw_ywltj->ksmc;//科室名称
			$row[$count]['mzrc']            	= $Ttb_yw_ywltj->mzrc;//门诊人次
			$row[$count]['jzrc']             	= $Ttb_yw_ywltj->jzrc;//急诊人次
			$row[$count]['ywsj']              	= $Ttb_yw_ywltj->ywsj;//业务时间
			$row[$count]['tbrq']              	= $Ttb_yw_ywltj->tbrq;//填报日期

			$count++;
		}
		$Ttb_yw_ywltj->free_statement();
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
		$id_array		=explode(',',$id);
		$tb_yw_ywlt = new Ttb_yw_ywltj( 2 );		
		$tb_yw_ywlt->whereAdd("yljgdm='".$id_array[0]."'");
		$tb_yw_ywlt->whereAdd("ksbm='".$id_array[1]."'");
		$tb_yw_ywlt->whereAdd("ywsj='".$id_array[2]."'");
		//$tb_yw_ywlt->debugLevel(2);
		$tb_yw_ywlt->find();
		$tb_yw_ywlt->fetch();
		$this->view->tb_yw_ywlt=$tb_yw_ywlt;	
		//print_r($tb_yw_ywlt)	;
		$tb_yw_ywlt->free_statement();
		$this->view->display('display.html');
	}
}