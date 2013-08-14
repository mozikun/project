<?php
/**
 * 出院小结列表及查看详细
 * @author 我好笨
 */
class his_cisleavehospitalController extends controller 
{
	private $gthbz=array();
    private $xb;
    private $xgbz;
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
        $this->xgbz=array('1'=>'正常','2'=>'修改','3'=>'撤销');
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
		require_once(__SITEROOT.'library/Models/tb_cis_leavehospital_summary_v.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		$current_region_path = $this->user['current_region_path'];
		$this->view->basePath = __BASEPATH;
		$patientname      = $this->_request->getParam('patientname');
		$identity_number  = $this->_request->getParam('identity_number');
		$search = array('identity_number'=>$identity_number,'xm'=>$patientname);
		$this->view->search=$search;
		$current_org = get_organization_id($current_region_path);
		$tb_cis_leavehospital_summary  = new Ttb_cis_leavehospital_summary(2);
		$tb_yl_patient_information  = new Ttb_his_patinf(2);
		$tb_cis_leavehospital_summary->joinAdd('inner',$tb_cis_leavehospital_summary,$tb_yl_patient_information,'kh','kh');
		$tb_cis_leavehospital_summary->joinAdd('inner',$tb_cis_leavehospital_summary,$tb_yl_patient_information,'klx','klx');
		$tb_cis_leavehospital_summary->whereAdd("cis_leavehospital_summary_v.yljgdm in (".$current_org.")");
		if (isset($search['identity_number']) && $search['identity_number']!="")
		{
			$tb_cis_leavehospital_summary->whereAdd("his_patinf_v.identity_number like '".$search['identity_number']."%'");
		}
		if (isset($search['xm']) && $search['xm']!="")
		{
			$tb_cis_leavehospital_summary->whereAdd("his_patinf_v.xm like '".$search['xm']."%'");
		}
		$nums = $tb_cis_leavehospital_summary->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/cisleavehospital/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_cis_leavehospital_summary->limit($startnum,__ROWSOFPAGE);
        $tb_cis_leavehospital_summary->orderBy('his_patinf_v.xm');
		$tb_cis_leavehospital_summary->find();
		$i=0;
		$cis_leavehospital_list=array();
		while ($tb_cis_leavehospital_summary->fetch()) {
			$cis_leavehospital_list[$i]['xm']=$tb_yl_patient_information->xm;
			$cis_leavehospital_list[$i]['xb']=$this->xb[$tb_yl_patient_information->xb];
			$cis_leavehospital_list[$i]['rysj']=$tb_yl_patient_information->rysj;
			$cis_leavehospital_list[$i]['cysj']=$tb_cis_leavehospital_summary->cysj;
			$cis_leavehospital_list[$i]['zyts']=$tb_cis_leavehospital_summary->zyts;
			$cis_leavehospital_list[$i]['yljgdm']=get_organization_by_standard_code($tb_cis_leavehospital_summary->yljgdm);
			$cis_leavehospital_list[$i]['mzzd']=$tb_cis_leavehospital_summary->mzzd;
			$cis_leavehospital_list[$i]['ryzd']=$tb_cis_leavehospital_summary->ryzd;
			$cis_leavehospital_list[$i]['cyzd']=$tb_cis_leavehospital_summary->cyzd;
			$cis_leavehospital_list[$i]['cyyz']=$tb_cis_leavehospital_summary->cyyz;
			$cis_leavehospital_list[$i]['jzlsh']=$tb_cis_leavehospital_summary->jzlsh;
			$i++;
		}
		$this->view->cis_leavehospital_list         =  $cis_leavehospital_list;
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
		$jzlsh      = $this->_request->getParam('jzlsh');
		if ($jzlsh)
		{
			require_once(__SITEROOT.'library/Models/organization.php');
			require_once(__SITEROOT.'library/Models/tb_cis_leavehospital_summary_v.php');
			require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
			$tb_cis_leavehospital_summary  = new Ttb_cis_leavehospital_summary(2);
			$tb_yl_patient_information  = new Ttb_his_patinf(2);
			$tb_cis_leavehospital_summary->joinAdd('left',$tb_cis_leavehospital_summary,$tb_yl_patient_information,'kh','kh');
			$tb_cis_leavehospital_summary->joinAdd('left',$tb_cis_leavehospital_summary,$tb_yl_patient_information,'klx','klx');
			$tb_cis_leavehospital_summary->whereAdd("jzlsh='$jzlsh'");
			$tb_cis_leavehospital_summary->find(true);
			$tb_cis_leavehospital_summary->yljgdm=get_organization_by_standard_code($tb_cis_leavehospital_summary->yljgdm);
			$tb_cis_leavehospital_summary->gthbz=isset($this->gthbz[$tb_cis_leavehospital_summary->gthbz])?$this->gthbz[$tb_cis_leavehospital_summary->gthbz]:"";
            $tb_cis_leavehospital_summary->xgbz=$this->xgbz[$tb_cis_leavehospital_summary->xgbz];
            $tb_yl_patient_information->xb=$this->xb[$tb_yl_patient_information->xb];
			$this->view->tb_cis_leavehospital_summary  = $tb_cis_leavehospital_summary;
			$this->view->tb_yl_patient_information  = $tb_yl_patient_information;
			$this->view->display('display.html');
		}
		else 
		{
			message("没有你要查询的用户",array("进入出院小结一览表"=>__BASEPATH.'his/ihdiagnosis/list'));
		}
	}
}