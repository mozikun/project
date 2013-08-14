<?php
/**
* @author：Lake
* @filename: mzjzController.php
* @package：医疗业务 - 门诊就诊信息列表与显示
* @create：2011-09-20
*/
class his_mzjzController extends controller 
{
	public function init() {
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Myauth.php');
		require_once(__SITEROOT.'/library/custom/comm_function.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		$this->view->basePath = $this->_request->getBasePath();
		
		//门诊就诊记录表
		require_once __SITEROOT."library/Models/tb_yl_mz_medical_record_v.php";
		//门诊处方明细表
		require_once __SITEROOT."library/Models/tb_cis_prescription_detail.php";
		//住院就诊记录表
		require_once __SITEROOT."library/Models/tb_yl_zy_medical_record_v.php";
		//患者基本信息表
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		require_once __SITEROOT.'application/his/models/getarrayvalue.php';
		$this->xb = array('0'=>'未知的性别','1'=>'男','2'=>'女','9'=>'未说明的性别');//性别代码
		$this->klx = array('0' =>'社保卡','1'=>'新农合卡','2'=>'医疗机构系统内部号（保证唯一）','9'=>'其他');//卡类型
		$this->hzsx =  array('0'=>'无特别说明','1'=>'本市各类医保人群','2'=>'本市自费','3'=>'外地自费','4'=>'境外自费','5'=>'部队就医','6'=>'农保','7'=>'儿保','9'=>'其他');//患者属性
		$this->bmlx = array('01'=>'ICD-10','02'=>'国标-95','03'=>'国标-97');//编码类型
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
		$Ttb_yl_mz_medical_record = new Ttb_yl_mz_medical_record( 2 );
        $Ttb_yl_mz_medical_record->whereAdd("yljgdm in (".$current_org.")");
		//$k是字段名$v是表单输入框的名字
		foreach($search as $k=>$v){
		     $myvalue = trim($v);
		     if(!empty($myvalue)){
		     	$Ttb_yl_mz_medical_record->whereAdd("$k"."="."'$myvalue'");
		     }
		}
		$nums = $Ttb_yl_mz_medical_record->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/mzjz/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		
		$Ttb_yl_mz_medical_record->limit($startnum,__ROWSOFPAGE);
		$Ttb_yl_mz_medical_record->find();
		$row = array();
		$count = 0;
		while($Ttb_yl_mz_medical_record->fetch()) {
			$org   = new Torganization();
			$org->whereAdd("standard_code='$Ttb_yl_mz_medical_record->yljgdm'");
			$org->find(true);
			$row[$count]['yljgdm']              = $org->zh_name;//医疗机构代码	YLJGDM
			$row[$count]['hzxm']                = $Ttb_yl_mz_medical_record->hzxm;//患者姓名	HZXM
			$row[$count]['jzlsh']               = $Ttb_yl_mz_medical_record->jzlsh;//门诊就诊流水号	JZLSH
			$row[$count]['hzsx']                = getarrayvalue($this->hzsx,$Ttb_yl_mz_medical_record->hzsx);//患者属性	HZSX
			$row[$count]['jzlx']                = $Ttb_yl_mz_medical_record->jzlx;//就诊类型	JZLX
			$row[$count]['jzksmc']              = $Ttb_yl_mz_medical_record->jzksmc;//就诊科室名称	JZKSMC
			$row[$count]['zzysxm']              = $Ttb_yl_mz_medical_record->zzysxm;//主诊医生姓名	ZZYSXM
			$row[$count]['jzzdmc']              = $Ttb_yl_mz_medical_record->jzzdmc;//门诊诊断名称（主要诊断）	JZZDMC
			$row[$count]['jzksrq']              = $Ttb_yl_mz_medical_record->jzksrq;//门诊就诊日期	JZKSRQ 字符串	8	应填	日期；“YYYYMMDD”            
			$row[$count]['kh']                  = $Ttb_yl_mz_medical_record->kh;
			$row[$count]['klx']                 = $Ttb_yl_mz_medical_record->klx;
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
			message("没有你要查询的用户",array("进入门诊就诊信息一览表"=>__BASEPATH.'his/mzjz/list'));
		}else
		{
			$tb_yl_mz_medical_record    = new Ttb_yl_mz_medical_record(2);
			$tb_yl_patient_information  = new Ttb_his_patinf(2);
			$tb_yl_mz_medical_record->joinAdd('left',$tb_yl_mz_medical_record,$tb_yl_patient_information,'kh','kh');
			$tb_yl_mz_medical_record->joinAdd('left',$tb_yl_mz_medical_record,$tb_yl_patient_information,'klx','klx');
			$tb_yl_mz_medical_record->whereAdd("yl_mz_medical_record_v.jzlsh='$jzlsh'");
			$tb_yl_mz_medical_record->find(true);
			$tb_yl_patient_information->xb = getarrayvalue($this->xb,$tb_yl_patient_information->xb);
			$tb_yl_mz_medical_record->klx = getarrayvalue($this->klx,$tb_yl_mz_medical_record->klx);
			$date_hzsx = substr($tb_yl_mz_medical_record->hzsx,0,1);
			$tb_yl_mz_medical_record->hzsx = getarrayvalue($this->hzsx,$date_hzsx);
			$tb_yl_mz_medical_record->bmlx = getarrayvalue($this->bmlx,$tb_yl_mz_medical_record->bmlx);
			$tb_yl_mz_medical_record->yljgdm=get_organization_by_standard_code($tb_yl_mz_medical_record->yljgdm);
			$this->view->tb_yl_mz_medical_record    = $tb_yl_mz_medical_record;
			$this->view->tb_yl_patient_information  = $tb_yl_patient_information;
	        $this->view->display('detail.html');
		}
      }
}
?>