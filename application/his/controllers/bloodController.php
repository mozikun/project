<?php
/**
 *用血明细表
 *
 */
class his_bloodController extends controller{
    private $xb;
    private $xgbz;
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/tb_yl_patient_information_v.php');
		require_once(__SITEROOT.'library/Models/tb_xz_used_blood_detail_v.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->basePath = __BASEPATH;
        $this->xb=array(0=>'未知的性别',1=>'男',2=>'女',9=>'未说明的性别');
        $this->xgbz=array('1'=>'正常','2'=>'修改','3'=>'撤销');
	}
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
		//总数
		$Ttb_xz_used_blood_detail = new Ttb_xz_used_blood_detail( 2 );
        $Ttb_xz_used_blood_detail->whereAdd("yljgdm in (".$current_org.")");
		//$k是字段名$v是表单输入框的名字
		foreach($search as $k=>$v){
		     $myvalue = trim($v);
		     if(!empty($myvalue)){
		     	$Ttb_xz_used_blood_detail->whereAdd("$k"."="."'$myvalue'");
		     }
		}
		$nums = $Ttb_xz_used_blood_detail->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/blood/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		
		$Ttb_xz_used_blood_detail->limit($startnum,__ROWSOFPAGE);
		$Ttb_xz_used_blood_detail->find();
		$row = array();
		$count = 0;
		while($Ttb_xz_used_blood_detail->fetch()) {
			$org   = new Torganization();
			$org->whereAdd("standard_code='".trim($Ttb_xz_used_blood_detail->yljgdm)."'");
			$org->find(true);
			$row[$count]['id']              	= $Ttb_xz_used_blood_detail->id;//id
			$row[$count]['yljgdm']              = $org->zh_name;//机构名
			$row[$count]['jszxm']                = $Ttb_xz_used_blood_detail->jszxm;//接收者姓名
			$row[$count]['jszxb']            	= $this->xb[$Ttb_xz_used_blood_detail->jszxb];//接收者性别
			$row[$count]['ffsj']              	= $Ttb_xz_used_blood_detail->ffsj;//发放时间
			$row[$count]['tbrq']              	= $Ttb_xz_used_blood_detail->tbrq;//填报日期
			$row[$count]['jzlsh']              	= $Ttb_xz_used_blood_detail->jzlsh;//接收者就诊流水号
			$count++;
		}
		$Ttb_xz_used_blood_detail->free_statement();
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
		$tb_xz_used_blood_detail = new Ttb_xz_used_blood_detail( 2 );
		$tb_xz_used_blood_detail->whereAdd("id='$id'");
		//$tb_yw_cwsyl->debugLevel(2);
		$tb_xz_used_blood_detail->find();
		$tb_xz_used_blood_detail->fetch();
        //取得类的所有属性值，判断是否有数据字典
        $all_vars=array();
        $all_vars=get_class_vars(get_class($tb_xz_used_blood_detail));
        foreach($all_vars as $k=>$v)
        {
            if(isset($this->$k) && !empty($this->$k) && isset($tb_xz_used_blood_detail->$k))
            {
                $tmp_k=$this->$k;
                $tb_xz_used_blood_detail->$k=isset($tmp_k[$tb_xz_used_blood_detail->$k])?$tmp_k[$tb_xz_used_blood_detail->$k]:'';
            }
        }
		$this->view->blood=$tb_xz_used_blood_detail;	
		//print_r($tb_xz_used_blood_detail)	;
		$tb_xz_used_blood_detail->free_statement();
		$this->view->display('display.html');
	}
}