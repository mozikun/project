<?php
/**
 * 诊断明细列表及查看详细
 * @author 我好笨
 */
class his_ihdiagnosisController extends controller 
{
	private $gthbz=array();
    private $xb;
    private $cyzdbz;
    private $yzdbz;
    private $cyqkbm;
    private $xgbz;
    private $zdlb;
    private $mzzybz;
    private $zdlxqf;
	/**
	 * 用于初始化
	 * 原来将包含文件写在这里，但新规范说不写里面了
	 */
	public function init()
	{
		require_once(__SITEROOT.'library/privilege.php');
		$this->view->basePath = $this->_request->getBasePath();
		$this->gthbz=array(1=>'挂号',2=>'退号');
        $this->xb=array(0=>'未知的性别',1=>'男',2=>'女',9=>'未说明的性别');
        $this->cyzdbz=array('1'=>'主要诊断','2'=>'次要诊断');
        $this->yzdbz=array('1'=>'仍疑似','0'=>'已确诊');
        $this->cyqkbm=array('1'=>'治愈','2'=>'好转','3'=>'未愈','4'=>'死亡','5'=>'其它');
        $this->zdlb=array('1'=>'出院诊断','2'=>'门诊诊断','3'=>'入院初步诊断','4'=>'术前诊断','5'=>'术后诊断','6'=>'尸检诊断','7'=>'放射诊断','8'=>'超声诊断','9'=>'病理诊断','10'=>'并发症诊断','11'=>'院内感染诊断','12'=>'主要诊断','13'=>'次要诊断','99'=>'其他');
        $this->xgbz=array('1'=>'正常','3'=>'撤销');
        $this->mzzybz=array('1'=>'门诊','2'=>'住院');
        $this->zdlxqf=array('1'=>'西医','2'=>'中医');
	}
	/**
	 * 完成列表
     * 
     * 2012-10-31我好笨增加数据字典显示
     * 
	 * @author 我好笨
	 */
	public function listAction()
	{
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once(__SITEROOT.'library/Models/tb_ih_diagnosis_detail_v.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		$current_region_path = $this->user['current_region_path'];
		$this->view->basePath = __BASEPATH;
		$patientname      = $this->_request->getParam('patientname');
		$identity_number  = $this->_request->getParam('identity_number');
		$search = array('identity_number'=>$identity_number,'xm'=>$patientname);
		$this->view->search=$search;
		$current_org = get_organization_id($current_region_path);
		$tb_ih_diagnosis_detail  = new Ttb_ih_diagnosis_detail(2);
		$tb_yl_patient_information  = new Ttb_his_patinf(2);
		$tb_ih_diagnosis_detail->joinAdd('inner',$tb_ih_diagnosis_detail,$tb_yl_patient_information,'kh','kh');
		$tb_ih_diagnosis_detail->joinAdd('inner',$tb_ih_diagnosis_detail,$tb_yl_patient_information,'klx','klx');
		$tb_ih_diagnosis_detail->whereAdd("ih_diagnosis_detail_v.yljgdm in (".$current_org.")");      
		if (isset($search['identity_number']) && $search['identity_number']!="")
		{
			$tb_ih_diagnosis_detail->whereAdd("his_patinf_v.identity_number like '".$search['identity_number']."%'");
		}
		if (isset($search['xm']) && $search['xm']!="")
		{
			$tb_ih_diagnosis_detail->whereAdd("his_patinf_v.xm like '".$search['xm']."%'");
		}
		$nums = $tb_ih_diagnosis_detail->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/ihdiagnosis/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_ih_diagnosis_detail->limit($startnum,__ROWSOFPAGE);
        $tb_ih_diagnosis_detail->orderBy('his_patinf_v.xm desc');
		$tb_ih_diagnosis_detail->find();
		$i=0;
		$ih_diagnosis_list=array();
		while ($tb_ih_diagnosis_detail->fetch()) {
			$ih_diagnosis_list[$i]['xm']=$tb_yl_patient_information->xm;
			$ih_diagnosis_list[$i]['xb']=$tb_yl_patient_information->xb?$this->xb[$tb_yl_patient_information->xb]:"";
			$ih_diagnosis_list[$i]['zdlxqf']=$tb_yl_patient_information->zdlxqf;
			$ih_diagnosis_list[$i]['zdlb']=$tb_ih_diagnosis_detail->zdlb?$this->zdlb[$tb_ih_diagnosis_detail->zdlb]:'';
			$ih_diagnosis_list[$i]['zdsj']=$tb_ih_diagnosis_detail->zdsj;
			$ih_diagnosis_list[$i]['yljgdm']=get_organization_by_standard_code($tb_ih_diagnosis_detail->yljgdm);
			$ih_diagnosis_list[$i]['zdmc']=$tb_ih_diagnosis_detail->zdmc;
			$ih_diagnosis_list[$i]['cyzdbz']=$tb_ih_diagnosis_detail->cyzdbz?$this->cyzdbz[$tb_ih_diagnosis_detail->cyzdbz]:'';
			$ih_diagnosis_list[$i]['yzdbz']=$tb_ih_diagnosis_detail->yzdbz;
			$ih_diagnosis_list[$i]['cyqkbm']=$tb_ih_diagnosis_detail->cyqkbm;
			$ih_diagnosis_list[$i]['zyzdlsh']=$tb_ih_diagnosis_detail->zyzdlsh;
			$i++;
		}
		$this->view->ih_diagnosis_list         =  $ih_diagnosis_list;
		$page = $links->subPageCss2();
		$this->view->page  = $page;
		$this->view->display('list.html');
	}
	/**
	 * 完成详细信息显示
     * 
     * 2012-10-31我好笨增加数据字典显示
     * 
	 * @author 我好笨
	 */
	public function displayAction()
	{
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$zyzdlsh      = $this->_request->getParam('zyzdlsh');
		if ($zyzdlsh)
		{
			require_once(__SITEROOT.'library/Models/organization.php');
			require_once(__SITEROOT.'library/Models/tb_ih_diagnosis_detail_v.php');
			require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
			$tb_ih_diagnosis_detail  = new Ttb_ih_diagnosis_detail(2);
			$tb_yl_patient_information  = new Ttb_his_patinf(2);
			$tb_ih_diagnosis_detail->joinAdd('left',$tb_ih_diagnosis_detail,$tb_yl_patient_information,'kh','kh');
			$tb_ih_diagnosis_detail->joinAdd('left',$tb_ih_diagnosis_detail,$tb_yl_patient_information,'klx','klx');
			$tb_ih_diagnosis_detail->whereAdd("ih_diagnosis_detail_v.zyzdlsh='$zyzdlsh'");
			$tb_ih_diagnosis_detail->find(true);
			$tb_ih_diagnosis_detail->yljgdm=get_organization_by_standard_code($tb_ih_diagnosis_detail->yljgdm);
			//取得类的所有属性值，判断是否有数据字典
            $all_vars=array();
            $all_vars=get_class_vars(get_class($tb_ih_diagnosis_detail));
            foreach($all_vars as $k=>$v)
            {
                if(isset($this->$k) && !empty($this->$k) && isset($tb_ih_diagnosis_detail->$k))
                {
                    $tmp_k=$this->$k;
                    $tb_ih_diagnosis_detail->$k=isset($tmp_k[$tb_ih_diagnosis_detail->$k])?$tmp_k[$tb_ih_diagnosis_detail->$k]:'';
                }
            }
            $tb_yl_patient_information->xb=$tb_yl_patient_information->xb?$this->xb[$tb_yl_patient_information->xb]:"";
			$this->view->tb_ih_diagnosis_detail  = $tb_ih_diagnosis_detail;
			$this->view->tb_yl_patient_information  = $tb_yl_patient_information;
			$this->view->display('display.html');
		}
		else 
		{
			message("没有你要查询的用户",array("进入诊断明细一览表"=>__BASEPATH.'his/ihdiagnosis/list'));
		}
	}
}