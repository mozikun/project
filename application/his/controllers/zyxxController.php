<?php
/**
* @author：Lake
* @filename: zyxxController.php
* @package：医疗业务 - 住院信息一览表
* @create：2011-09-21
*/
class his_zyxxController extends controller 
{
	public function init() {
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Myauth.php');
		require_once(__SITEROOT.'/library/custom/comm_function.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		$this->view->basePath = $this->_request->getBasePath();	
		//住院就诊记录表
		require_once __SITEROOT."library/Models/tb_yl_zy_medical_record_v.php";
		//患者基本信息表
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		require_once __SITEROOT.'application/his/models/getarrayvalue.php';
		//就诊类型标志
		$this->jzlx = array('300'=>'急诊观察','400'=>'普通住院','401'=>'特需住院','500'=>'家床','999'=>'其他');
		$this->hzsx =  array('0'=>'无特别说明','1'=>'本市各类医保人群','2'=>'本市自费','3'=>'外地自费','4'=>'境外自费','5'=>'部队就医','6'=>'农保','7'=>'儿保','9'=>'其他');//患者属性
		$this->klx = array('0' =>'社保卡','1'=>'新农合卡','2'=>'医疗机构系统内部号（保证唯一）','9'=>'其他');//卡类型
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
			$search = array('hzxm'=>$patientname);
		}
		$current_org = get_organization_id($current_region_path);
		//查询门诊总数
		$Ttb_yl_zy_medical_record = new Ttb_yl_zy_medical_record( 2 );
        $Ttb_yl_zy_medical_record->selectAdd("to_char(rysj,'yyyy-mm-dd') as rysj");
		$Ttb_yl_zy_medical_record->selectAdd("to_char(cysj,'yyyy-mm-dd') as cysj");
		$Ttb_yl_zy_medical_record->selectAdd("hzxm");
		$Ttb_yl_zy_medical_record->selectAdd("jzlsh");
		$Ttb_yl_zy_medical_record->selectAdd("jzlx");
		$Ttb_yl_zy_medical_record->selectAdd("jzksmc");
		$Ttb_yl_zy_medical_record->selectAdd("cyksmc");	
		$Ttb_yl_zy_medical_record->selectAdd("yljgdm");	
		$Ttb_yl_zy_medical_record->selectAdd("kh");	
		$Ttb_yl_zy_medical_record->selectAdd("klx");	
        $Ttb_yl_zy_medical_record->whereAdd("yljgdm in (".$current_org.")");
		//$k是字段名$v是表单输入框的名字
		foreach($search as $k=>$v){
		     $myvalue = trim($v);
		     if(!empty($myvalue)){
		     	$Ttb_yl_zy_medical_record->whereAdd("$k"."="."'$myvalue'");
		     }
		}
		
		$nums = $Ttb_yl_zy_medical_record->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/zyxx/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		
		$Ttb_yl_zy_medical_record->limit($startnum,__ROWSOFPAGE);
		$Ttb_yl_zy_medical_record->find();
		$row = array();
		$count = 0;
		while($Ttb_yl_zy_medical_record->fetch()) {
//			$org   = new Torganization();
//			$org->whereAdd("standard_code='$Ttb_yl_zy_medical_record->yljgdm'");
//			$org->find(true);
			$row[$count]['yljgdm']              = get_organization_by_standard_code($Ttb_yl_zy_medical_record->yljgdm);
			$row[$count]['hzxm']              = $Ttb_yl_zy_medical_record->hzxm;
			$row[$count]['jzlsh']              = $Ttb_yl_zy_medical_record->jzlsh;
			$row[$count]['jzlx']                = getarrayvalue($this->jzlx,$Ttb_yl_zy_medical_record->jzlx);
			$row[$count]['jzksmc']              = $Ttb_yl_zy_medical_record->jzksmc;
			$row[$count]['cyksmc']              = $Ttb_yl_zy_medical_record->cyksmc;
			$row[$count]['rysj']              = $Ttb_yl_zy_medical_record->rysj;
			$row[$count]['cysj']              = $Ttb_yl_zy_medical_record->cysj;
			$row[$count]['kh']              = $Ttb_yl_zy_medical_record->kh;
			$row[$count]['klx']              = $Ttb_yl_zy_medical_record->klx;
			$count++;
		}
		$this->view->row         =  $row;
		$page = $links->subPageCss2();
		$this->view->page  = $page;
		$this->view->display('list.html');
	}
	public  function displayAction(){
		$kh        =  $this->_request->getParam("kh");
		$klx       =  $this->_request->getParam("klx");
		$jzlsh     =  $this->_request->getParam("jzlsh");
		if(empty($kh)&&empty($klx)&&empty($sfmxid))
		{
			message("没有你要查询的用户",array("进入住院就诊记录信息一览表"=>__BASEPATH.'his/zyxx/list'));
		}else
		{
			$tb_yl_zy_medical_record    = new Ttb_yl_zy_medical_record(2);
			$tb_yl_patient_information  = new Ttb_his_patinf(2);
			$tb_yl_zy_medical_record->whereAdd("kh='$kh'");
			$tb_yl_zy_medical_record->whereAdd("klx='$klx'");
			$tb_yl_zy_medical_record->whereAdd("jzlsh='$jzlsh'");
			$tb_yl_zy_medical_record->find(true);
			$tb_yl_zy_medical_record->hzsx = getarrayvalue($this->hzsx,$tb_yl_zy_medical_record->hzsx);
			$tb_yl_zy_medical_record->klx = getarrayvalue($this->klx,$tb_yl_zy_medical_record->klx);
			$tb_yl_zy_medical_record->jzlx = getarrayvalue($this->jzlx,$tb_yl_zy_medical_record->jzlx);
			$tb_yl_zy_medical_record->yljgdm=get_organization_by_standard_code($tb_yl_zy_medical_record->yljgdm);
			$this->view->tb_yl_zy_medical_record       = $tb_yl_zy_medical_record;
			$this->view->tb_yl_patient_information     = $tb_yl_patient_information;
	        $this->view->display('detail.html');
		}
      }
}
?>