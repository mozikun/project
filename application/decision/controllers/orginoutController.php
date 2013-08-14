<?php 
class decision_orginoutController extends controller{
	public function init(){
		require_once __SITEROOT.'library/privilege.php';
  		require_once __SITEROOT.'library/Models/organization.php';
 		require_once __SITEROOT.'library/Models/org_ext_4.php';
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
				$org_ext_4 = new Torg_ext_4();
				$org_ext_4->whereAdd("id='$organization->id'");
				$org_ext_4->orderby("year DESC");
				$region_array[$region_count]['org'][$org_count]['org_ext'] = $org_ext_4->count();//某个机构下边机构资源添加的条数
				if($org_ext_4->count()>0)
				{
					$td_rowspan+=$org_ext_4->count();
				}
				else 
				{
					$td_rowspan+=1;
				}
				$region_array[$region_count]['org'][$org_count]['org_count'] = $org_number;
				$region_array[$region_count]['org'][$org_count]['ext'] = array();
				$ext_count = 0;
				$org_ext_4->find();
				while ($org_ext_4->fetch())
				{
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['year'] = $org_ext_4->year;			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['total_income'] = empty($org_ext_4->total_income)?0:$org_ext_4->total_income;//总收入合计 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['finance_income'] = empty($org_ext_4->finance_income)?0:$org_ext_4->finance_income;//财政补助收入 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['superior_income'] = empty($org_ext_4->superior_income)?0:$org_ext_4->superior_income;//上级补助收入			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['medical_income'] = empty($org_ext_4->medical_income)?0:$org_ext_4->medical_income;//医疗收入合计 			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['medical_outpatient_income'] = empty($org_ext_4->medical_outpatient_income)?0:$org_ext_4->medical_outpatient_income;//医疗门诊收入 			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['medical_hospital_income'] = empty($org_ext_4->medical_hospital_income)?0:$org_ext_4->medical_hospital_income;//医疗住院收入 			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['drug_income'] = empty($org_ext_4->drug_income)?0:$org_ext_4->drug_income;//药品收入 			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['drug_outpatient_income'] = empty($org_ext_4->drug_outpatient_income)?0:$org_ext_4->drug_outpatient_income;//药品门诊收入 			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['drug_hospital_income'] = empty($org_ext_4->drug_hospital_income)?0:$org_ext_4->drug_hospital_income;//药品住院收入 			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['drug_other_income'] = empty($org_ext_4->drug_other_income)?0:$org_ext_4->drug_other_income;//其他收入  			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['total_payout'] = empty($org_ext_4->total_payout)?0:$org_ext_4->total_payout;//总支出  			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['medical_payout'] = empty($org_ext_4->medical_payout)?0:$org_ext_4->medical_payout;//医疗支出   			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['drug_payout'] = empty($org_ext_4->drug_payout)?0:$org_ext_4->drug_payout;//药品支出   			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['drug_fee_payout'] = empty($org_ext_4->drug_fee_payout)?0:$org_ext_4->drug_fee_payout;//内：药品费   			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['finance_payout'] = empty($org_ext_4->finance_payout)?0:$org_ext_4->finance_payout;//财政专项支出   			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['other_payout'] = empty($org_ext_4->other_payout)?0:$org_ext_4->other_payout;//其他支出   			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['hr_payout'] = empty($org_ext_4->hr_payout)?0:$org_ext_4->hr_payout;//总支出中：人员支出   			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['retire_payout'] = empty($org_ext_4->retire_payout)?0:$org_ext_4->retire_payout;//总支出中：离退休费   			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['arrear_payout'] = empty($org_ext_4->arrear_payout)?0:$org_ext_4->arrear_payout;//病人累计欠费总额   			 			
					$region_array[$region_count]['org'][$org_count]['ext'][$ext_count]['arrear_payout_by_year'] = empty($org_ext_4->arrear_payout_by_year)?0:$org_ext_4->arrear_payout_by_year;//其中：年内病人欠费总额   			 			
  				$ext_count++;
  			}
  			$org_ext_4->free_statement();
				$org_count++;
			}
			$organization->free_statement();
			$region_array[$region_count]['rowspan'] = $td_rowspan;
			$region_count++;
		}
	$region->free_statement();
	$this->view->region_array = $region_array;
	$this->view->display('orginout.html');
  	}
}
?>