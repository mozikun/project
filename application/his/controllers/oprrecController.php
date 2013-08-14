<?php
/**
 * 手术记录列表及查看详细
 * @author 我好笨
 */
class his_oprrecController extends controller 
{
    public $mzssbz;
    public $rjssbz;
    public $zfbz;
	/**
	 * 用于初始化
	 * 原来将包含文件写在这里，但新规范说不写里面了
	 */
	public function init()
	{
		require_once(__SITEROOT.'library/privilege.php');
		$this->view->basePath = $this->_request->getBasePath();
        $this->mzssbz=array(1=>'门急诊手术',2=>'住院手术');//门诊手术标志
        $this->rjssbz=array(1=>'日间手术',2=>'非日间手术');//日间手术标志
        $this->zfbz=array(1=>'正常',2=>'作废');//作废标志
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
		require_once(__SITEROOT.'library/Models/tb_his_opr_rec_v.php');
		$current_region_path = $this->user['current_region_path'];
		$this->view->basePath = __BASEPATH;
		$ssksmc      = $this->_request->getParam('ssksmc');//手术科室名称
		$ssysxm  = $this->_request->getParam('ssysxm');//手术医生姓名
		$search = array('ssksmc'=>$ssksmc,'ssysxm'=>$ssysxm);
		$this->view->search=$search;
		$current_org = get_organization_id($current_region_path);
		$tb_his_opr_rec  = new Ttb_his_opr_rec(2);
		$tb_his_opr_rec->whereAdd("his_opr_rec_v.yljgdm in (".$current_org.")");
		if (isset($search['ssksmc']) && $search['ssksmc']!="")
		{
			$tb_his_opr_rec->whereAdd("his_opr_rec_v.ssksmc like '".$search['ssksmc']."%'");
		}
		if (isset($search['ssysxm']) && $search['ssysxm']!="")
		{
			$tb_his_opr_rec->whereAdd("his_opr_rec_v.ssysxm like '".$search['ssysxm']."%'");
		}
		$nums = $tb_his_opr_rec->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/oprrec/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_his_opr_rec->limit($startnum,__ROWSOFPAGE);
		$tb_his_opr_rec->find();
		$i=0;
		$jz_opr_rec_list=array();
		while ($tb_his_opr_rec->fetch()) {
			$jz_opr_rec_list[$i]['ssid']=$tb_his_opr_rec->ssid;
			$jz_opr_rec_list[$i]['sqryxm']=$tb_his_opr_rec->sqryxm;
			$jz_opr_rec_list[$i]['djryxm']=$tb_his_opr_rec->djryxm;
			$jz_opr_rec_list[$i]['sqksmc']=$tb_his_opr_rec->sqksmc;
			$jz_opr_rec_list[$i]['ssksmc']=$tb_his_opr_rec->ssksmc;
			$jz_opr_rec_list[$i]['sqysxm']=$tb_his_opr_rec->sqysxm;
			$jz_opr_rec_list[$i]['ssysxm']=$tb_his_opr_rec->ssysxm;
			$jz_opr_rec_list[$i]['sssqrq']=$tb_his_opr_rec->sssqrq;
			$jz_opr_rec_list[$i]['ssrq']=$tb_his_opr_rec->ssrq;
			$jz_opr_rec_list[$i]['yljgdm']=get_organization_by_standard_code($tb_his_opr_rec->yljgdm);
			$i++;
		}
		$this->view->jz_opr_rec_list         =  $jz_opr_rec_list;
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
		$ssid      = $this->_request->getparam('ssid');
		if ($ssid)
		{
			require_once(__SITEROOT.'library/Models/organization.php');
			require_once(__SITEROOT.'library/Models/tb_his_opr_rec_v.php');
			$tb_his_opr_rec  = new Ttb_his_opr_rec(2);
			$tb_his_opr_rec->whereAdd("his_opr_rec_v.ssid='$ssid'");
			$tb_his_opr_rec->find(true);
			$tb_his_opr_rec->yljgdm=get_organization_by_standard_code($tb_his_opr_rec->yljgdm);
            $tb_his_opr_rec->mzssbz=$tb_his_opr_rec->mzssbz?$this->mzssbz[$tb_his_opr_rec->mzssbz]:'';
            $tb_his_opr_rec->rjssbz=$tb_his_opr_rec->rjssbz?$this->rjssbz[$tb_his_opr_rec->rjssbz]:'';
            $tb_his_opr_rec->zfbz=$tb_his_opr_rec->zfbz?$this->zfbz[$tb_his_opr_rec->zfbz]:'';
			$this->view->tb_his_opr_rec  = $tb_his_opr_rec;
			$this->view->display('display.html');
		}
		else 
		{
			message("没有你要查询的用户",array("进入手术记录一览表"=>__BASEPATH.'his/oprrec/list'));
		}
	}
}