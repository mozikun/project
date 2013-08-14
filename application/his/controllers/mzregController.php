<?php
/**
 * 门诊挂号列表及查看详细
 * @author 我好笨
 */
class his_mzregController extends controller 
{
	private $gthbz=array();
	/**
	 * 用于初始化
	 * 原来将包含文件写在这里，但新规范说不写里面了
	 */
	public function init()
	{
		require_once(__SITEROOT.'library/privilege.php');
		$this->view->basePath = $this->_request->getBasePath();
		require_once __SITEROOT.'application/his/models/getarrayvalue.php';
		$this->gthbz=array(1=>'挂号',2=>'退号');
		$this->txbz=array(0=>'非特需',1=>'特需');//特需标志
		$this->ghlb=array(100 =>'普通门诊',101=>'专科门诊',102=>'专家门诊',103=>'特需门诊',104=>'专病门诊',105 =>'预约挂号',200=>'急诊',600=>'体检',999=>'其他');//挂号类别
		$this->bxlx=array(0 =>'具有本市干保局方面的医疗费用承担',1 =>'具有本市人保局条线的社会医疗保险费用承担',5 =>'军队的医疗费用承担',6 =>'具有市或区县卫生条线的新农合费用承担',7 =>'全自费',8 =>'具有协同关系的成都以外地区社会医疗保险的费用承担',9 =>'其它');//（5）	保险类型
		$this->wdbz = array(1=>'本市',2=>'外地',3=>'境外（港澳台）',4=>'外国',5=>'未知');//外地标志
		$this->klx = array('0' =>'社保卡','1'=>'新农合卡','2'=>'医疗机构系统内部号（保证唯一）','9'=>'其他');//卡类型
		$this->xb = array('0'=>'未知的性别','1'=>'男','2'=>'女','9'=>'未说明的性别');//性别代码
	}
	/**
	 * 完成列表
	 * @author 我好笨
	 */
	public function listAction()
	{
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once(__SITEROOT.'library/Models/tb_his_mz_reg_v.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		$current_region_path = $this->user['current_region_path'];
		$this->view->basePath = __BASEPATH;
		$patientname      = $this->_request->getParam('patientname');
		$identity_number  = $this->_request->getParam('identity_number');
		$search = array('identity_number'=>$identity_number,'xm'=>$patientname);
		$this->view->search=$search;
		$current_org = get_organization_id($current_region_path);
		$tb_his_mz_reg  = new Ttb_his_mz_reg(2);
		$tb_yl_patient_information  = new Ttb_his_patinf(2);
		$tb_his_mz_reg->joinAdd('inner',$tb_his_mz_reg,$tb_yl_patient_information,'kh','kh');
		$tb_his_mz_reg->joinAdd('inner',$tb_his_mz_reg,$tb_yl_patient_information,'klx','klx');
		$tb_his_mz_reg->whereAdd("his_mz_reg_v.yljgdm in (".$current_org.")");
		if (isset($search['identity_number']) && $search['identity_number']!="")
		{
			$tb_his_mz_reg->whereAdd("his_patinf_v.identity_number like '".$search['identity_number']."%'");
		}
		if (isset($search['xm']) && $search['xm']!="")
		{
			$tb_his_mz_reg->whereAdd("his_patinf_v.xm like '".$search['xm']."%'");
		}
		$nums = $tb_his_mz_reg->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/mzreg/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_his_mz_reg->limit($startnum,__ROWSOFPAGE);
        $tb_his_mz_reg->orderBy('his_patinf_v.xm');
		$tb_his_mz_reg->find();
		$i=0;
		$mz_reg_list=array();
		while ($tb_his_mz_reg->fetch()) {
			$mz_reg_list[$i]['xm']=$tb_yl_patient_information->xm;
			$mz_reg_list[$i]['xb']=getarrayvalue($this->xb,$tb_yl_patient_information->xb);
			$mz_reg_list[$i]['zjhm']=$tb_yl_patient_information->zjhm;
			$mz_reg_list[$i]['ghrq']=$tb_his_mz_reg->ghrq;
			$mz_reg_list[$i]['ghbm']=$tb_his_mz_reg->ghbm;
			$mz_reg_list[$i]['gthbz']=isset($this->gthbz[$tb_his_mz_reg->gthbz])?$this->gthbz[$tb_his_mz_reg->gthbz]:"";
			$mz_reg_list[$i]['yljgdm']=get_organization_by_standard_code($tb_his_mz_reg->yljgdm);
			$mz_reg_list[$i]['stfbh']=$tb_his_mz_reg->stfbh;
			$mz_reg_list[$i]['gthsj']=$tb_his_mz_reg->gthsj;
			$mz_reg_list[$i]['ghlb']=getarrayvalue($this->ghlb,$tb_his_mz_reg->ghlb);
			$mz_reg_list[$i]['bxlx']=$tb_his_mz_reg->bxlx;
			$mz_reg_list[$i]['ksmc']=$tb_his_mz_reg->ksmc;
			$i++;
		}
		$this->view->mz_reg_list         =  $mz_reg_list;
		$page = $links->subPageCss2();
		$this->view->page  = $page;
		$this->view->display('list.html');
	}
	/**
	 * 完成详细信息显示
	 * @author 我好笨
	 */
	public function displayAction()
	{
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$ghbm      = $this->_request->getParam('ghbm');
		if ($ghbm)
		{
			require_once(__SITEROOT.'library/Models/organization.php');
			require_once(__SITEROOT.'library/Models/tb_his_mz_reg_v.php');
			require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
			$tb_his_mz_reg  = new Ttb_his_mz_reg(2);
			$tb_yl_patient_information  = new Ttb_his_patinf(2);
			$tb_his_mz_reg->joinAdd('left',$tb_his_mz_reg,$tb_yl_patient_information,'kh','kh');
			$tb_his_mz_reg->joinAdd('left',$tb_his_mz_reg,$tb_yl_patient_information,'klx','klx');
			$tb_his_mz_reg->whereAdd("his_mz_reg_v.ghbm='$ghbm'");
			$tb_his_mz_reg->find(true);
			$tb_yl_patient_information->xb  = getarrayvalue($this->xb,$tb_yl_patient_information->xb);
			$tb_yl_patient_information->klx  = getarrayvalue($this->klx,$tb_yl_patient_information->klx);
			$tb_his_mz_reg->bxlx  = getarrayvalue($this->bxlx,$tb_his_mz_reg->bxlx);
			$tb_his_mz_reg->ghlb  = getarrayvalue($this->ghlb,$tb_his_mz_reg->ghlb);
			$tb_his_mz_reg->txbz  = getarrayvalue($this->txbz,$tb_his_mz_reg->txbz);
			$tb_his_mz_reg->wdbz  = getarrayvalue($this->wdbz,$tb_his_mz_reg->wdbz);
			$tb_his_mz_reg->yljgdm=get_organization_by_standard_code($tb_his_mz_reg->yljgdm);
			$tb_his_mz_reg->gthbz=isset($this->gthbz[$tb_his_mz_reg->gthbz])?$this->gthbz[$tb_his_mz_reg->gthbz]:"";
			$this->view->tb_his_mz_reg  = $tb_his_mz_reg;
			$this->view->tb_yl_patient_information  = $tb_yl_patient_information;
			$this->view->display('display.html');
		}
		else 
		{
			message("没有你要查询的用户",array("进入挂号一览表"=>__BASEPATH.'his/mzreg/list'));
		}
	}
}