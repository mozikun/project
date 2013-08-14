<?php
/**
 * 诊疗收费列表及查看详细
 * @author 我好笨
 */
class his_zydisController extends controller 
{
	/**
	 * 用于初始化
	 * 原来将包含文件写在这里，但新规范说不写里面了
	 */
	public function init()
	{
		require_once(__SITEROOT.'library/privilege.php');
		$this->view->basePath = $this->_request->getBasePath();
		require_once __SITEROOT.'application/his/models/getarrayvalue.php';
		$this->lgbz = array(0=>'住院',1=>'留院观察');//留观标志
		$this->bxlx=array(0 =>'具有本市干保局方面的医疗费用承担',1 =>'具有本市人保局条线的社会医疗保险费用承担',5 =>'军队的医疗费用承担',6 =>'具有市或区县卫生条线的新农合费用承担',7 =>'全自费',8 =>'具有协同关系的成都以外地区社会医疗保险的费用承担',9 =>'其它');//保险类型      
		$this->wdbz = array(1=>'本市',2=>'外地',3=>'境外（港澳台）',4=>'外国',5=>'未知');//外地标志
		$this->txbz=array(0=>'非特需',1=>'特需');//特需标志
		$this->zfbz=array(1=>'正常',2=>'作废');//作废标志
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
		require_once(__SITEROOT.'library/Models/tb_his_zy_dis_reg_v.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		$current_region_path = $this->user['current_region_path'];
		$this->view->basePath = __BASEPATH;
		$patientname      = $this->_request->getParam('patientname');
		$identity_number  = $this->_request->getParam('identity_number');
		$search = array('identity_number'=>$identity_number,'xm'=>$patientname);
		$this->view->search=$search;
		$current_org = get_organization_id($current_region_path);
		$tb_his_zy_dis_reg  = new Ttb_his_zy_dis_reg(2);
		$tb_yl_patient_information  = new Ttb_his_patinf(2);
		$tb_his_zy_dis_reg->joinAdd('inner',$tb_his_zy_dis_reg,$tb_yl_patient_information,'kh','kh');
		$tb_his_zy_dis_reg->joinAdd('inner',$tb_his_zy_dis_reg,$tb_yl_patient_information,'klx','klx');
		$tb_his_zy_dis_reg->whereAdd("his_zy_dis_reg_v.yljgdm in (".$current_org.")");
		if (isset($search['identity_number']) && $search['identity_number']!="")
		{
			$tb_his_zy_dis_reg->whereAdd("his_patinf_v.identity_number like '".$search['identity_number']."%'");
		}
		if (isset($search['xm']) && $search['xm']!="")
		{
			$tb_his_zy_dis_reg->whereAdd("his_patinf_v.xm like '".$search['xm']."%'");
		}
		$nums = $tb_his_zy_dis_reg->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/zydis/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_his_zy_dis_reg->limit($startnum,__ROWSOFPAGE);
        $tb_his_zy_dis_reg->orderBy('his_patinf_v.xm');
		$tb_his_zy_dis_reg->find();
		$i=0;
		$zy_dis_list=array();
		while ($tb_his_zy_dis_reg->fetch()) {
			$zy_dis_list[$i]['xm']=$tb_yl_patient_information->xm;
			$zy_dis_list[$i]['xb']=getarrayvalue($this->xb,$tb_yl_patient_information->xb);
			$zy_dis_list[$i]['zjhm']=$tb_yl_patient_information->zjhm;
			$zy_dis_list[$i]['zyid']=$tb_his_zy_dis_reg->zyid;
			$zy_dis_list[$i]['ryksmc']=$tb_his_zy_dis_reg->ryksmc;
			$zy_dis_list[$i]['rysj']=$tb_his_zy_dis_reg->rysj;
			$zy_dis_list[$i]['cyksmc']=$tb_his_zy_dis_reg->cyksmc;
			$zy_dis_list[$i]['cysj']=$tb_his_zy_dis_reg->cysj;
			$zy_dis_list[$i]['lgbz']=getarrayvalue($this->lgbz,$tb_his_zy_dis_reg->lgbz);
			$zy_dis_list[$i]['yljgdm']=get_organization_by_standard_code($tb_his_zy_dis_reg->yljgdm);
			$i++;
		}
		$this->view->zy_dis_list         =  $zy_dis_list;
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
		$zyid      = $this->_request->getparam('zyid');
		if ($zyid)
		{
			require_once(__SITEROOT.'library/Models/organization.php');
			require_once(__SITEROOT.'library/Models/tb_his_zy_dis_reg_v.php');
			require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
			$tb_his_zy_dis_reg  = new Ttb_his_zy_dis_reg(2);
			$tb_yl_patient_information  = new Ttb_his_patinf(2);
			$tb_his_zy_dis_reg->joinAdd('left',$tb_his_zy_dis_reg,$tb_yl_patient_information,'kh','kh');
			$tb_his_zy_dis_reg->joinAdd('left',$tb_his_zy_dis_reg,$tb_yl_patient_information,'klx','klx');
			$tb_his_zy_dis_reg->whereAdd("his_zy_dis_reg_v.zyid='$zyid'");
			$tb_his_zy_dis_reg->find(true);
			$tb_yl_patient_information->xb   = getarrayvalue($this->xb,$tb_yl_patient_information->xb);
			$tb_yl_patient_information->klx   = getarrayvalue($this->klx,$tb_yl_patient_information->klx);
			$tb_his_zy_dis_reg->lgbz   = getarrayvalue($this->lgbz,$tb_his_zy_dis_reg->lgbz);
			$tb_his_zy_dis_reg->bxlx   = getarrayvalue($this->bxlx,$tb_his_zy_dis_reg->bxlx);
			$tb_his_zy_dis_reg->zfbz   = getarrayvalue($this->zfbz,$tb_his_zy_dis_reg->zfbz);
			$tb_his_zy_dis_reg->txbz   = getarrayvalue($this->txbz,$tb_his_zy_dis_reg->txbz);
			$tb_his_zy_dis_reg->yljgdm=get_organization_by_standard_code($tb_his_zy_dis_reg->yljgdm);
			$this->view->tb_his_zy_dis_reg  = $tb_his_zy_dis_reg;
			$this->view->tb_yl_patient_information  = $tb_yl_patient_information;
			$this->view->display('display.html');
		}
		else 
		{
			message("没有你要查询的用户",array("进入出院记录一览表"=>__BASEPATH.'his/zydis/list'));
		}
	}
}