<?php
/**
*@author：
*@filename: repeatController.php
*@create：2012-6-28
*/
class iha_blankController extends controller
{
	public function init()
	{
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/individual_core.php');
		require_once(__SITEROOT.'library/Models/individual_archive.php');
		require_once(__SITEROOT.'library/Models/family_archive.php');
		require_once(__SITEROOT.'library/Models/clinical_history.php');
		require_once(__SITEROOT.'library/Models/hypertension_follow_up.php');
		require_once(__SITEROOT.'library/Models/diabetes_core.php');
		require_once(__SITEROOT.'library/Models/diabetes_physical_sign.php');
		require_once(__SITEROOT.'library/Models/schizophrenia.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/custom/comm_function.php');
		$this->view->assign("baseUrl",__BASEPATH);
		$this->view->assign( "basePath", __BASEPATH );
	}
	public function indexAction()
	{
		require_once(__SITEROOT . '/library/data_arr/arrdata.php');
		require_once(__SITEROOT.'library/custom/pager.php');
		$search=array();
		$search['username']=trim($this->_request->getParam('username'));
		$individual_core=new Tindividual_core();
		$individual_core->whereAdd("identity_number is null");
		$search['org_id'] = $this->_request->getParam('org_id')?$this->_request->getParam('org_id'):$this->user['region_id']; //地区
        $individual_core_region_path_domain = get_region_path(1, $search['org_id']); 
        $individual_core->whereAdd($individual_core_region_path_domain);
        if($search['username'])
        {
        	$individual_core->whereAdd("individual_core.name like '" . $search['username'] .
                "%' or individual_core.name_pinyin like '" . $search['username'] . "%'");
        }
		$nums=$individual_core->count();
		$pageCurrent=intval($this->_request->getParam("page"));
		$pageCurrent=$pageCurrent?$pageCurrent:1;
//        $search=array();
        //new subpages(每页显示条数，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
        $pageofnumber=40;
        $links=new SubPages($pageofnumber,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'iha/blank/index/page/',2,$search);
        $pageCurrent=$links->check_page($pageCurrent);
        $startnum=$pageofnumber*($pageCurrent-1);
        $individual_core->limit($startnum,$pageofnumber);
		$individual_core->find();
		
		$individual=array();
		$m=0;
		while($individual_core->fetch())
		{
			$individual[$m]['uuid']=$individual_core->uuid;
			$individual[$m]['name']=$individual_core->name;
			$individual[$m]['householder_name']=get_househoder_name($individual_core->family_number);
			$individual[$m]['created']=date("Y-m-d",$individual_core->created);
			$individual[$m]['address']=$individual_core->address;
			$individual[$m]['sex']=@$sex[array_search_for_other($individual_core->sex,$sex)][1];
			$individual[$m]['criteria_rate']=$individual_core->criteria_rate*100;
			
			$m++;
		}
		$pager=$links->subPageCss2();
		$this->view->assign("pager",$pager);
		$this->view->assign("individual",$individual);
		$this->view->assign('org_id', $search['org_id']);
		$this->view->display("index.html");
	}
	public function delAction()
	{
		$uuid=$this->_request->getParam("uuid");
		if($uuid)
		{
			//删除个人核心表信息
			$individual_core=new Tindividual_core();
			$individual_core->whereAdd("uuid='$uuid'");
			if($individual_core->delete())
			{
				//删除个人扩展表信息
				$individual_archive=new Tindividual_archive();
				$individual_archive->whereAdd("id='$uuid'");
				$individual_archive->delete();
				//删除家庭档案表信息
				$family_archive=new Tfamily_archive();
				$family_archive->whereAdd("householder_id='$uuid'");
				$family_archive->delete();
				//慢病史
				$clinical_history=new Tclinical_history();
				$clinical_history->whereAdd("id='$uuid'");
				$clinical_history->delete();
				//随访基础表
				$hypertension_follow_up=new Thypertension_follow_up();
				$hypertension_follow_up->whereAdd("id='$uuid'");
				$hypertension_follow_up->delete();
				//2型糖尿病主表
				$diabetes_core=new Tdiabetes_core();
				$diabetes_core->whereAdd("id='$uuid'");
				$diabetes_core->delete();
				//2型糖尿病 体征
				$diabetes_physical_sign=new Tdiabetes_physical_sign();
				$diabetes_physical_sign->whereAdd("id='$uuid'");
				$diabetes_physical_sign->delete();
				//重情精神疾病患者随访服务记录表
				$schizophrenia=new Tschizophrenia();
				$schizophrenia->whereAdd("id='$uuid'");
				$schizophrenia->delete();		
			}
			$this->redirect(__BASEPATH.'iha/blank/index');
		}
		else 
		{
			echo "参数错误！";
		}
	}
	public function delallAction()
	{
		$uuid_array=$this->_request->getParam('selectFlag');
//		var_dump($uuid_array);
		$token=false;//删除标志
		foreach ($uuid_array as $uuid)
		{			
			$individual_core=new Tindividual_core();
			$individual_core->whereAdd("uuid='$uuid'");;
			if($individual_core->delete()){
				//删除个人扩展表信息
				$individual_archive=new Tindividual_archive();
				$individual_archive->whereAdd("id='$uuid'");
				$individual_archive->delete();
				//删除家庭档案表信息
				$family_archive=new Tfamily_archive();
				$family_archive->whereAdd("householder_id='$uuid'");
				$family_archive->delete();
				//慢病史
				$clinical_history=new Tclinical_history();
				$clinical_history->whereAdd("id='$uuid'");
				$clinical_history->delete();
				//随访基础表
				$hypertension_follow_up=new Thypertension_follow_up();
				$hypertension_follow_up->whereAdd("id='$uuid'");
				$hypertension_follow_up->delete();
				//2型糖尿病主表
				$diabetes_core=new Tdiabetes_core();
				$diabetes_core->whereAdd("id='$uuid'");
				$diabetes_core->delete();
				//2型糖尿病 体征
				$diabetes_physical_sign=new Tdiabetes_physical_sign();
				$diabetes_physical_sign->whereAdd("id='$uuid'");
				$diabetes_physical_sign->delete();
				//重情精神疾病患者随访服务记录表
				$schizophrenia=new Tschizophrenia();
				$schizophrenia->whereAdd("id='$uuid'");
				$schizophrenia->delete();	
				$token=true;	
			}
		}
		if($token==true){
			echo '删除成功！';
		}else{
			echo '删除失败！';	
		}
	}
}