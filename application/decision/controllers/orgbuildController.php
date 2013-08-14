<?php 
class decision_orgbuildController extends controller{
	public function init(){
		require_once __SITEROOT.'library/privilege.php';
  		require_once __SITEROOT.'library/Models/organization.php';
  		require_once __SITEROOT.'library/Models/org_ext_2.php';
  		require_once __SITEROOT.'library/Models/region.php';
  		$this->view->basePath = __BASEPATH;
	}
	public function indexAction(){
  		//取得当前地区
  		$login_regionid = $this->user['region_id'];
  		$param = $this->_request->getParam('region_id');
  		$region_id = empty($param)?$login_regionid:$param;
		$region = new Tregion();
		$region->whereAdd("p_id='$region_id'");
		$region->find();
		$region_array = array();
		$region_count = 0;
		while ($region->fetch())
		{
			$region_array[$region_count]['zh_name'] = $region->zh_name;
			$region_array[$region_count]['id'] = $region->id;
			$region_level = count(explode(',',$region->region_path));
			$region_array[$region_count]['region_level'] = $region_level;//地区级次 为了不显示下边的村委会
			//取当前地区下的机构
			$organization = new Torganization();
			$organization->whereAdd("region_path='$region->region_path'");
			if($this->user['role_width_option']!=1)//最高身份没有过滤行政机构
			{
				$organization->whereAdd("type='3' or type='5'");//过滤掉行政机构
			}
			$org_number = $organization->count();
			$organization->find();
			$org_count = 0;	
			$td_rowspan = 0;
			$region_array[$region_count]['org'] = array();
			while ($organization->fetch())
			{
				$region_array[$region_count]['org'][$org_count]['zh_name'] = $organization->zh_name;			
				//查找这个机构下边有多少个机构资源信息
				$org_ext_2 = new Torg_ext_2();
				$org_ext_2->whereAdd("id='$organization->id'");
				$org_ext_2->orderby("year DESC");
				$region_array[$region_count]['org'][$org_count]['org_ext'] = $org_ext_2->count();//某个机构下边机构资源添加的条数
				if($org_ext_2->count()>0)
				{
					$td_rowspan+=$org_ext_2->count();
				}
				else 
				{
					$td_rowspan+=1;
				}
				$region_array[$region_count]['org'][$org_count]['org_count'] = $org_number;
				$region_array[$region_count]['org'][$org_count]['ext'] = array();
				$ext_count = 0;
				$org_ext_2->find();
				while ($org_ext_2->fetch())
				{
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['year'] = $org_ext_2->year;			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['area'] = empty($org_ext_2->area)?0:$org_ext_2->area;//房屋建筑面积 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['operation_area'] = empty($org_ext_2->operation_area)?0:$org_ext_2->operation_area;//业务用房面积			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['peril_area'] = empty($org_ext_2->peril_area)?0:$org_ext_2->peril_area;//危房面积			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['hire_area'] = empty($org_ext_2->hire_area)?0:$org_ext_2->hire_area;//租房面积总面积 			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['hire_operation_area'] = empty($org_ext_2->hire_operation_area)?0:$org_ext_2->hire_operation_area;//租房面积业务用房面积 			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['basic_build_pro'] = empty($org_ext_2->basic_build_pro)?0:$org_ext_2->basic_build_pro;//本年批准基建项目 			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['basic_build_area'] = empty($org_ext_2->basic_build_area)?0:$org_ext_2->basic_build_area;//本年批准基建项目建筑面积 			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['actual_invest'] = empty($org_ext_2->actual_invest)?0:$org_ext_2->actual_invest;//本年实际完成投资额总额 			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['finance_invest'] = empty($org_ext_2->finance_invest)?0:$org_ext_2->finance_invest;//财政性投资 			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['self_invest'] = empty($org_ext_2->self_invest)?0:$org_ext_2->self_invest;//单位自有资金  			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['bank_invest'] = empty($org_ext_2->bank_invest)?0:$org_ext_2->bank_invest;//银行贷款  			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['finish_area'] = empty($org_ext_2->finish_area)?0:$org_ext_2->finish_area;//本年房屋竣工面积   			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['new_fixed_assets'] = empty($org_ext_2->new_fixed_assets)?0:$org_ext_2->new_fixed_assets;//本年新增固定资产   			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['new_sickbed'] = empty($org_ext_2->new_sickbed)?0:$org_ext_2->new_sickbed;//本年因新扩建增加床位   			 			
  				$ext_count++;
  			}
  			$org_ext_2->free_statement();
				$org_count++;
			}
			$organization->free_statement();
			$region_array[$region_count]['rowspan'] = $td_rowspan;
			$region_count++;
		}
	$region->free_statement();
	$this->view->region_array = $region_array;
	$this->view->display('orgbuild.html');
  	}
}
?>