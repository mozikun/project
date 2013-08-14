<?php 
  class decision_orgbedcontroller extends  controller{
  	public function init(){
  		require_once(__SITEROOT.'library/privilege.php');
  		require_once __SITEROOT.'library/Models/organization.php';
  		require_once __SITEROOT.'library/Models/region.php';
 		require_once __SITEROOT.'library/Models/org_ext_1.php';
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
				$org_ext_1 = new Torg_ext_1();
				$org_ext_1->whereAdd("id='$organization->id'");
				$org_ext_1->orderby("year DESC");
				$region_array[$region_count]['org'][$org_count]['org_ext'] = $org_ext_1->count();//某个机构下边机构资源添加的条数
				if($org_ext_1->count()>0)
				{
					$td_rowspan+=$org_ext_1->count();
				}
				else 
				{
					$td_rowspan+=1;
				}
				$region_array[$region_count]['org'][$org_count]['org_count'] = $org_number;
				$region_array[$region_count]['org'][$org_count]['ext'] = array();
				$ext_count = 0;
				$org_ext_1->find();
				while ($org_ext_1->fetch())
				{
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['year'] = $org_ext_1->year;			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['bed_number'] = empty($org_ext_1->bed_number)?0:$org_ext_1->bed_number;//编制床位数			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['bed_allnumber'] = empty($org_ext_1->bed_allnumber)?0:$org_ext_1->bed_allnumber;//实有床位数总数			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['totalbed_days'] = empty($org_ext_1->totalbed_days)?0:$org_ext_1->totalbed_days;//实际开放总床日数			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['occupied_bed'] = empty($org_ext_1->occupied_bed)?0:$org_ext_1->occupied_bed;//实际占用总床日数			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['tbo_total'] = empty($org_ext_1->tbo_total)?0:$org_ext_1->tbo_total;//出院者占用总床日数			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['observation_bed'] = empty($org_ext_1->observation_bed)?0:$org_ext_1->observation_bed;//观察床			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['family_beds'] = empty($org_ext_1->family_beds)?0:$org_ext_1->family_beds;//全年开设家庭病床总数 			
  				$ext_count++;
  			}
  			$org_ext_1->free_statement();
				$org_count++;
			}
			$organization->free_statement();
			$region_array[$region_count]['rowspan'] = $td_rowspan;
			$region_count++;
		}
	$region->free_statement();
	$this->view->region_array = $region_array;
	$this->view->display('bedinfo.html');
  	}
  }
?>