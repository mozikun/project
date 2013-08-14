<?php 
  class decision_orgbasecontroller extends  controller{
  	public function init(){
  		require_once(__SITEROOT.'library/privilege.php');
  		require_once __SITEROOT.'library/Models/organization.php';
 		require_once __SITEROOT.'library/Models/chs_center.php';
 		require_once __SITEROOT.'library/Models/region.php';
 		$this->view->basePath = __BASEPATH;
  	}
  	public function indexAction(){
  		require_once __SITEROOT.'library/data_arr/arrdata.php';
  		require_once(__SITEROOT.'application/decision/models/array_new.php');
  		//政府办机构隶属关系
         $org_under_typearr = array();
         foreach ($org_under_type as $k=>$v)
         {
         	$org_under_typearr[$v[0]] = $v[1];
         }
 		 $org_under_typearr_nu  = count($org_under_typearr);
 		 //基本信息设置/主办单位
 		 $org_typearr = array();
 		 foreach ($org_type as $k=>$v)
 		 {
 		 	$org_typearr[$v[0]] = $v[1];
 		 }
 		 $org_type_nu     = count($org_typearr);//数组个数
 		 //非独立法人挂靠单位
 		 $mount_typearr = array();
 		 foreach ($org_type as $k=>$v)
 		 {
 		 	$mount_typearr[$v[0]] = $v[1];
 		 }
 		 $mount_typearr_get_nu = count($mount_typearr);;
 		 $this->view->org_under_typearr_get = $org_under_typearr;
 		 $this->view->org_under_typearr_nu  = $org_under_typearr_nu;
 		 $this->view->org_typearr_get       = $org_typearr;
 		 $this->view->org_type_nu           = $org_type_nu;
 		 $this->view->mount_typearr_get     = $mount_typearr;
 		 $this->view->mount_typearr_get_nu  = $mount_typearr_get_nu;
 		 $this->view->rows_org_ext = $mount_typearr_get_nu+$org_under_typearr_nu+1;//没有数据的时候显示的列数(机构资源没有数据)
 		 $this->view->rows_org = $mount_typearr_get_nu+$org_under_typearr_nu+2;//没有数据的时候显示的列数(机构没有数据)
  		//取得当前地区
  		$login_regionid = $this->user['region_id'];
  		$param = $this->_request->getParam('region_id');
  		$region_id = empty($param)?$login_regionid:$param;
		$region = new Tregion();
		$region->whereAdd("p_id='$region_id'");
		$region->find();
		$region_array = array();
		$region_count = 0;
		$img_tag = '<img src="'.__BASEPATH.'views/images/checked.gif" />';
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
				$chs_center = new Tchs_center();
				$chs_center->whereAdd("chsc_id='$organization->id'");
				$chs_center->orderby("year DESC");
				$region_array[$region_count]['org'][$org_count]['org_ext'] = $chs_center->count();//某个机构下边机构资源添加的条数
				if($chs_center->count()>0)
				{
					$td_rowspan+=$chs_center->count();
				}
				else 
				{
					$td_rowspan+=1;
				}
				$region_array[$region_count]['org'][$org_count]['org_count'] = $org_number;
				$region_array[$region_count]['org'][$org_count]['ext'] = array();
				$ext_count = 0;
				$chs_center->find();
				while ($chs_center->fetch())
				{
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['year'] = $chs_center->year;			         //设置/主办单位
					$a_org_type = array();
					foreach ($mount_typearr as $k=>$v)
					{
						if($k==$chs_center->org_type)
						{
							$a_org_type[$k] = '<img src="'.__BASEPATH.'views/images/checked.gif" />';
						}
						else 
						{
							$a_org_type[$k] = '';
						}
					}
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['org_type'] = $a_org_type;//非独立法人挂靠单位	
					//政府办机构隶属关系
					$a_org_under_type = array();
					foreach ($org_under_typearr as $k=>$v)
					{
						if($k==$chs_center->org_type)
						{
							$a_org_under_type[$k] = '<img src="'.__BASEPATH.'views/images/checked.gif" />';
						}
						else 
						{
							$a_org_under_type[$k] = '';
						}
					}
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['org_under_type'] = $a_org_under_type;//政府办机构隶属关系	
					//是否民族区域自治
					if(empty($chs_center->is_nation_autonomy))
					{
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['is_nation_autonomy_y'] = '';//是民族区域自治			
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['is_nation_autonomy_n'] = $img_tag;//否民族区域自治			
					}
					else 
					{
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['is_nation_autonomy_y'] = $img_tag;//是民族区域自治			
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['is_nation_autonomy_n'] = '';//否民族区域自治			
					}
					//是否公费医疗/医疗保险定点医院
					if(empty($chs_center->is_medicare_point_hospital))
					{
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['is_medicare_point_hospital_y'] = '';//是公费医疗/医疗保险定点医院			
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['is_medicare_point_hospital_n'] = $img_tag;//否公费医疗/医疗保险定点医院			
					}
					else 
					{
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['is_medicare_point_hospital_y'] = $img_tag;//是公费医疗/医疗保险定点医院			
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['is_medicare_point_hospital_n'] = '';//否公费医疗/医疗保险定点医院		
					}
					//是否新型农村合作医疗定点医院
					if(empty($chs_center->is_medicare_point_hospital))
					{
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['is_new_point_hospital_y'] = '';//是新型农村合作医疗定点医院			
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['is_new_point_hospital_n'] = $img_tag;//否新型农村合作医疗定点医院			
					}
					else 
					{
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['is_new_point_hospital_y'] = $img_tag;//是新型农村合作医疗定点医院			
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['is_new_point_hospital_n'] = '';//否新型农村合作医疗定点医院			
					}
					//是否直报疫情及突发公共卫生事件
					if(empty($chs_center->is_common_event_report))
					{
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['is_common_event_report_y'] = '';//是直报疫情及突发公共卫生事件			
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['is_common_event_report_n'] = $img_tag;//否直报疫情及突发公共卫生事件			
					}
					else 
					{
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['is_common_event_report_y'] = $img_tag;//是直报疫情及突发公共卫生事件			
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['is_common_event_report_n'] = '';//否直报疫情及突发公共卫生事件			
					}
					//计算机台数
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['computer_count'] = empty($chs_center->computer_count)?0:$chs_center->computer_count;//计算机台数			
					//是否配置健康教育录(放)像设备
					if(empty($chs_center->has_health_edu_equipment))
					{
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['has_health_edu_equipment_y'] = '';//配置健康教育录(放)像设备			
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['has_health_edu_equipment_n'] = $img_tag;//否配置健康教育录(放)像设备		
					}
					else 
					{
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['has_health_edu_equipment_y'] = $img_tag;//配置健康教育录(放)像设备			
						$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['has_health_edu_equipment_n'] = '';//否配置健康教育录(放)像设备			
					}
					//下设直属分站(院、所)个数
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['child_chss_count'] = empty($chs_center->child_chss_count)?0:$chs_center->child_chss_count;//下设直属分站(院、所)个数			
  				$ext_count++;
  			}
  			$chs_center->free_statement();
				$org_count++;
			}
			$organization->free_statement();
			$region_array[$region_count]['rowspan'] = $td_rowspan;
			$region_count++;
		}
	$region->free_statement();
	$this->view->region_array = $region_array;
	$this->view->display('orgbase.html');
  	}
  }
?>