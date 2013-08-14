<?php
/**
 * 药品库存表
 *
 */
class his_medstoreController extends controller{
    private $yplb;
    private $ypdlfl;
    private $sfjy;
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		require_once(__SITEROOT.'library/Models/wd_med_store.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->basePath = __BASEPATH;
        $this->yplb=array('1'=>'西药','2'=>'中成药','3'=>'中草药','9'=>'其他');
        $this->ypdlfl=array('1'=>'麻醉药','2'=>'毒性药','3'=>'精神I类','9'=>'精神II类','9'=>'普通药');
        $this->sfjy=array('0'=>'非基药','1'=>'基药');
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
		$Twd_med_store = new Twd_med_store(2);
        $Twd_med_store->whereAdd("yljgdm in (".$current_org.")");
		//$k是字段名$v是表单输入框的名字
		foreach($search as $k=>$v){
		     $myvalue = trim($v);
		     if(!empty($myvalue)){
		     	$Twd_med_store->whereAdd("$k"."="."'$myvalue'");
		     }
		}
		$nums = $Twd_med_store->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/medstore/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		//$Twd_med_store->debugLevel(9);
		$Twd_med_store->limit($startnum,__ROWSOFPAGE);
		$Twd_med_store->find();
		$row = array();
		$count = 0;
		while($Twd_med_store->fetch()) {
			$org   = new Torganization();
			$org->whereAdd("standard_code='".trim($Twd_med_store->yljgdm)."'");
			$org->find(true);
			$row[$count]['kcid']              = $Twd_med_store->kcid;//主健
			$row[$count]['yljgdm']              = $org->zh_name;//机构名
			$row[$count]['ypkf']                = $Twd_med_store->ypkf;//药品所在库房名
			$row[$count]['ypbm']            	= $Twd_med_store->ypbm;//药品编码
			$row[$count]['ypmc']             	= $Twd_med_store->ypmc;//药品名称
			$row[$count]['ypph']              	= $Twd_med_store->ypph;//药品批号
			$row[$count]['ypcd']              	= $Twd_med_store->ypcd;//药品产地
			$row[$count]['ypsxrq']              = $Twd_med_store->ypsxrq;//药品失效日期
			$count++;
		}
		$Twd_med_store->free_statement();
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
		$Twd_med_store = new Twd_med_store( 2 );
		$Twd_med_store->whereAdd("kcid='$id'");
		//$Twd_med_store->debugLevel(2);
		$Twd_med_store->find();
		$Twd_med_store->fetch();
        //取得类的所有属性值，判断是否有数据字典
        $all_vars=array();
        $all_vars=get_class_vars(get_class($Twd_med_store));
        foreach($all_vars as $k=>$v)
        {
            if(isset($this->$k) && !empty($this->$k) && isset($Twd_med_store->$k))
            {
                $tmp_k=$this->$k;
                $Twd_med_store->$k=isset($tmp_k[$Twd_med_store->$k])?$tmp_k[$Twd_med_store->$k]:'';
            }
        }
		$this->view->med_store=$Twd_med_store;	
		//print_r($Twd_med_store)	;
		$Twd_med_store->free_statement();
		$this->view->display('display.html');
	}
}