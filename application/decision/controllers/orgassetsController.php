<?php 
class decision_orgassetsController extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
  		require_once __SITEROOT.'library/Models/organization.php';
 		require_once __SITEROOT.'library/Models/org_ext_5.php';
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
				$org_ext_5 = new Torg_ext_5();
				$org_ext_5->whereAdd("id='$organization->id'");
				$org_ext_5->orderby("year DESC");
				$region_array[$region_count]['org'][$org_count]['org_ext'] = $org_ext_5->count();//某个机构下边机构资源添加的条数
				if($org_ext_5->count()>0)
				{
					$td_rowspan+=$org_ext_5->count();
				}
				else 
				{
					$td_rowspan+=1;
				}
				$region_array[$region_count]['org'][$org_count]['org_count'] = $org_number;
				$region_array[$region_count]['org'][$org_count]['ext'] = array();
				$ext_count = 0;
				$org_ext_5->find();
				while ($org_ext_5->fetch())
				{
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['year'] = $org_ext_5->year;			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['current_assets'] = empty($org_ext_5->current_assets)?0:$org_ext_5->current_assets;//流动资产			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['invest'] = empty($org_ext_5->invest)?0:$org_ext_5->invest;//对外投资			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['capital_asserts'] = empty($org_ext_5->capital_asserts)?0:$org_ext_5->capital_asserts;//固定资产			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['immateriality_assets'] = empty($org_ext_5->immateriality_assets)?0:$org_ext_5->immateriality_assets;//无形资产及开办费			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['owes_assets'] = empty($org_ext_5->owes_assets)?0:$org_ext_5->owes_assets;//负债合计			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['long_standing_assets'] = empty($org_ext_5->long_standing_assets)?0:$org_ext_5->long_standing_assets;//长期负债			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['net_assets'] = empty($org_ext_5->net_assets)?0:$org_ext_5->net_assets;//净资产合计  			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['project_assets'] = empty($org_ext_5->project_assets)?0:$org_ext_5->project_assets;//事业基金   			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['fixed_assets'] = empty($org_ext_5->fixed_assets)?0:$org_ext_5->fixed_assets;//固定基金   			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['special_assets'] = empty($org_ext_5->special_assets)?0:$org_ext_5->special_assets;//专用基金    			
  				$ext_count++;
  			}
  			$org_ext_5->free_statement();
				$org_count++;
			}
			$organization->free_statement();
			$region_array[$region_count]['rowspan'] = $td_rowspan;
			$region_count++;
		}
	$region->free_statement();
	$this->view->region_array = $region_array;
	$this->view->display('orgassets.html');
  	}
}
?>