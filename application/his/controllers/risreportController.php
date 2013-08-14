<?php
/**
 * 医学影像检查报告表
 *
 */
class his_risreportController extends controller{
    private $xb;
    private $mzzybz;
    private $examtype;
    private $yys;
    private $sfyyy;
    private $xgbz;
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
//		require_once(__SITEROOT.'library/Models/tb_yl_patient_information_v.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		require_once(__SITEROOT.'library/Models/tb_ris_report_v.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->basePath = __BASEPATH;
        $this->xb=array(0=>'未知的性别',1=>'男',2=>'女',9=>'未说明的性别');
        $this->mzzybz=array('1'=>'门诊','2'=>'住院');
        $this->examtype=array('01'=>'计算机X线断层摄影','02'=>'核磁共振成像','03'=>'数字减影血管造影','04'=>'普通X光摄影','05'=>'特殊X光摄影','06'=>'超声检查','07'=>'病理检查','08'=>'內镜检查','09'=>'核医学检查','10'=>'其他检查');
        $this->yys=array('0'=>'阴性','1'=>'阳性','2'=>'未定');
        $this->sfyyy=array('1'=>'有','2'=>'无','3'=>'未定');
        $this->xgbz=array('1'=>'正常','2'=>'修改','3'=>'撤销');
	}
	public function listAction(){
		$current_region_path = $this->user['current_region_path'];
		
		$patientname      = $this->_request->getParam('patientname');
		$identity_number  = $this->_request->getParam('identity_number');
		
		//如何用户通过身份证查询，先查询患者基本信息表，通过身份证得到患者卡号和卡类型。再查询门诊就诊表内的记录
		if( !empty( $identity_number ) ) {
//			$tb_yl_patient_information  = new Ttb_yl_patient_information(2);
//			$tb_yl_patient_information -> whereAdd('identity_number='.$identity_number);
//			$tb_yl_patient_information -> find(true);
//			$search = array('kh' => empty( $tb_yl_patient_information -> kh ) ? '000' : $tb_yl_patient_information -> kh , 
//							'klx' => empty( $tb_yl_patient_information -> klx ) ? '000' : $tb_yl_patient_information -> klx,
//							);
			$tb_his_patinf =new Ttb_his_patinf(2);
			$tb_his_patinf ->whereAdd('identity_number='.$identity_number);
			$tb_his_patinf ->find(true);
			$search =array('kh' =>empty( $tb_his_patinf->kh) ? '000' : $tb_his_patinf->kh,
			               'klx' =>empty( $tb_his_patinf->klx) ? '000' : $tb_his_patinf->klx
			               );
		}else {
			$search = array('brxm'=>$patientname);
		}
		$current_org = get_organization_id($current_region_path);
		//查询检查总数
		$Ttb_ris_report = new Ttb_ris_report( 2 );
        $Ttb_ris_report->whereAdd("yljgdm in (".$current_org.")");
		//$k是字段名$v是表单输入框的名字
		foreach($search as $k=>$v){
		     $myvalue = trim($v);
		     if(!empty($myvalue)){
		     	$Ttb_ris_report->whereAdd("$k"."="."'$myvalue'");
		     }
		}
		$nums = $Ttb_ris_report->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/risreport/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		
		$Ttb_ris_report->limit($startnum,__ROWSOFPAGE);
//		$Ttb_ris_report->debugLevel(9);
		$Ttb_ris_report->find();
		$row = array();
		$count = 0;
		while($Ttb_ris_report->fetch()) {
			$org   = new Torganization();
			$org->whereAdd("standard_code='".trim($Ttb_ris_report->yljgdm)."'");
			$org->find(true);
			$row[$count]['yljgdm']              = $org->zh_name;//机构名
			$row[$count]['id']              	= $Ttb_ris_report->studyuid;//检查号
			$row[$count]['brxm']                = $Ttb_ris_report->brxm;//病人姓名
			$row[$count]['brxb']            	= $this->xb[$Ttb_ris_report->brxb];//病人性别
			$row[$count]['jcmc']             	= $Ttb_ris_report->jcmc;//检查名称
			$row[$count]['jysj']              	= $Ttb_ris_report->jysj;//检查时间
			$row[$count]['bgsj']              	= $Ttb_ris_report->bgsj;//报告时间
			$row[$count]['jzlsh']              	= $Ttb_ris_report->jzlsh;//就诊流水号
			$count++;
		}
		$Ttb_ris_report->free_statement();
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
		$tb_ris_report = new Ttb_ris_report( 2 );
		$tb_ris_report->whereAdd("studyuid='$id'");
		//$tb_ris_report->debugLevel(2);
		$tb_ris_report->find();
		$tb_ris_report->fetch();
        //取得类的所有属性值，判断是否有数据字典
        $all_vars=array();
        $all_vars=get_class_vars(get_class($tb_ris_report));
        foreach($all_vars as $k=>$v)
        {
            if(isset($this->$k) && !empty($this->$k) && isset($tb_ris_report->$k))
            {
                $tmp_k=$this->$k;
                $tb_ris_report->$k=isset($tmp_k[$tb_ris_report->$k])?$tmp_k[$tb_ris_report->$k]:'';
            }
        }
		$this->view->tb_ris_report=$tb_ris_report;	
		//print_r($tb_ris_report)	;
		$tb_ris_report->free_statement();
		$this->view->display('display.html');
	}
}