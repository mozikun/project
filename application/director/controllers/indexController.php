<?php
/**
*@author：我好笨
*@filename: indexController.php
*@package：院长查询
*@email：4049054@qq.com
*@create：2011-1-20
*/
class director_indexController extends controller
{
	/*
	 *等同于构造函数 
	 */
	public function init()
	{
		$this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."library/Models/hypertension_follow_up.php";
		require_once __SITEROOT."library/Models/hypertension_symptom.php";
		require_once __SITEROOT."library/Models/follow_up_drugs.php";
		require_once __SITEROOT."library/Models/staff_core.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
		require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT."library/Models/individual_core.php";
        require_once __SITEROOT."library/Models/region.php";
        require_once __SITEROOT."library/Models/organization.php";
        require_once __SITEROOT."application/gp/models/insert_physical_base.php";//引入基本检查函数
		$this->view->basePath = $this->_request->getBasePath();
	}
	/*
	 * 院长查询
	 */
	public function  indexAction()
	{
        $statistics_time=time();
        $this->view->statistics_time=date("Y-m-d",$statistics_time);
        $this->view->assign('region_id',$this->user['region_id']);
		$this->view->assign('region_p_id',$this->user['region_id']);
		$this->view->display("main.html");
	}
    //统计数据
    public function totalAction()
    {
        //取当前区域ID
        $region_id=$this->_request->getParam('region')?$this->_request->getParam('region'):$this->user['region_id'];
        //取选择的机构
        $org_id=$this->_request->getParam('org_id')?$this->_request->getParam('org_id'):$this->user['org_id'];
        //统计时间
        $statistics_time=$this->_request->getParam('statistics_time')?strtotime($this->_request->getParam('statistics_time')):time();
        $start_time=mktime(0,0,0,date("n",$statistics_time),date("j",$statistics_time),date("Y",$statistics_time));
        $end_time=mktime(0,0,0,date("n",$statistics_time),date("j",$statistics_time)+1,date("Y",$statistics_time));
        if($region_id)
        {
            //有区域ID
            $region_path=array();
            if($org_id)
            {
                //选择了具体的机构
                $organization=new Torganization();
                $organization->whereAdd("id = '$org_id'");
                $organization->find(true);
                $region_path[0]=$organization->region_path;
            }
            else
            {
                //统计所属机构(管辖的所有机构)
                $region=new Tregion();
                $region->whereAdd("id='$region_id'");
                $region->find(true);
                $region_path=$region->region_path;
                if($region_path)
                {
                    $organization=new Torganization();
                    $organization->whereAdd("region_path like '$region_path%'");
                    $organization->find();
                    $i=0;
                    while($organization->fetch())
                    {
                        $region_path[$i]=$organization->id;
                        $i++;
                    }
                }
            }
            //开始取数据
            //个人建档数
            $individual_core=new Tindividual_core();
            $individual_core->whereAdd("updated>='$start_time'");
            $individual_core->whereAdd("updated<'$end_time'");
            foreach($region_path as $k=>$v)
            {
                $individual_core->whereAdd("region_path like '$v%'","or");
            }
            $individual_nums=$individual_core->count();
            $this->view->individual_nums=$individual_nums;
            //家庭建档数
            require_once __SITEROOT."library/Models/family_archive.php";
            $family_archive=new Tfamily_archive();
            $family_archive->whereAdd("updated>='$start_time'");
            $family_archive->whereAdd("updated<'$end_time'");
            foreach($region_path as $k=>$v)
            {
                $family_archive->whereAdd("region_path like '$v%'","or");
            }
            $family_nums=$family_archive->count();
            $this->view->family_nums=$family_nums;
            //体检人数
            require_once __SITEROOT."library/Models/examination_table.php";
            $examination_table=new Texamination_table();
            $individual_core=new Tindividual_core();
            $examination_table->joinAdd('left',$examination_table,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $examination_table->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $examination_table->whereAdd("examination_table.created>='$start_time'");
            $examination_table->whereAdd("examination_table.created<'$end_time'");
            $examination_p_nums=$examination_table->count("distinct individual_core.uuid");
            $this->view->examination_p_nums=$examination_p_nums;
            //体检次数
            require_once __SITEROOT."library/Models/examination_table.php";
            $examination_table=new Texamination_table();
            $individual_core=new Tindividual_core();
            $examination_table->joinAdd('left',$examination_table,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $examination_table->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $examination_table->whereAdd("examination_table.created>='$start_time'");
            $examination_table->whereAdd("examination_table.created<'$end_time'");
            $examination_nums=$examination_table->count();
            $this->view->examination_nums=$examination_nums;
            //诊疗记录
            require_once __SITEROOT."library/Models/patient_history.php";
            $patient_history=new Tpatient_history();
            $individual_core=new Tindividual_core();
            $patient_history->joinAdd('left',$patient_history,$individual_core,'serial_number','uuid');
            foreach($region_path as $k=>$v)
            {
                $patient_history->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $patient_history->whereAdd("patient_history.diagnosis_time>='$start_time'");
            $patient_history->whereAdd("patient_history.diagnosis_time<'$end_time'");
            $patient_nums=$patient_history->count();
            $this->view->patient_nums=$patient_nums;
            //入院证明数
            require_once __SITEROOT."library/Models/hos_discharge_certificate.php";
            $hos_discharge_certificate=new Thos_discharge_certificate();
            $individual_core=new Tindividual_core();
            $hos_discharge_certificate->joinAdd('left',$hos_discharge_certificate,$individual_core,'serial_number','uuid');
            foreach($region_path as $k=>$v)
            {
                $hos_discharge_certificate->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $hos_discharge_certificate->whereAdd("hos_discharge_certificate.admission_time>='$start_time'");
            $hos_discharge_certificate->whereAdd("hos_discharge_certificate.admission_time<'$end_time'");
            $hos_discharge_certificate_admission_nums=$hos_discharge_certificate->count();
            $this->view->hos_discharge_certificate_admission_nums=$hos_discharge_certificate_admission_nums;
            //出院证明数
            require_once __SITEROOT."library/Models/hos_discharge_certificate.php";
            $hos_discharge_certificate=new Thos_discharge_certificate();
            $individual_core=new Tindividual_core();
            $hos_discharge_certificate->joinAdd('left',$hos_discharge_certificate,$individual_core,'serial_number','uuid');
            foreach($region_path as $k=>$v)
            {
                $hos_discharge_certificate->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $hos_discharge_certificate->whereAdd("hos_discharge_certificate.discharged_time>='$start_time'");
            $hos_discharge_certificate->whereAdd("hos_discharge_certificate.discharged_time<'$end_time'");
            $hos_discharge_certificate_nums=$hos_discharge_certificate->count();
            $this->view->hos_discharge_certificate_nums=$hos_discharge_certificate_nums;
            //健康教育数
            require_once __SITEROOT."library/Models/health_education.php";
            $health_education=new Thealth_education();
            $staff_core=new Tstaff_core();
            $health_education->joinAdd('left',$health_education,$staff_core,'staff_id','id');
            foreach($region_path as $k=>$v)
            {
                $health_education->whereAdd("staff_core.region_path like '$v%'","or");
            }
            $health_education->whereAdd("health_education.created>='$start_time'");
            $health_education->whereAdd("health_education.created<'$end_time'");
            $health_education_nums=$health_education->count();
            $this->view->health_education_nums=$health_education_nums;
            //儿童保健次数=新生儿家庭访视次数+3岁以内健康检查次数+3岁儿童健康检查次数
            //新生儿家庭访视次数
            require_once __SITEROOT."library/Models/child_visits.php";
            $child_visits=new Tchild_visits();
            $individual_core=new Tindividual_core();
            $child_visits->joinAdd('left',$child_visits,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $child_visits->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $child_visits->whereAdd("child_visits.created>='$start_time'");
            $child_visits->whereAdd("child_visits.created<'$end_time'");
            $child_visits_nums=$child_visits->count();
            $this->view->child_visits_nums=$child_visits_nums;
            //新生儿家庭访视人数
            $child_visits=new Tchild_visits();
            $individual_core=new Tindividual_core();
            $child_visits->joinAdd('left',$child_visits,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $child_visits->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $child_visits->whereAdd("child_visits.created>='$start_time'");
            $child_visits->whereAdd("child_visits.created<'$end_time'");
            $child_visits_p_nums=$child_visits->count("distinct individual_core.uuid");
            $this->view->child_visits_p_nums=$child_visits_p_nums;
            //3岁以内健康检查次数
            require_once __SITEROOT."library/Models/child_physical.php";
            $child_physical=new Tchild_physical();
            $individual_core=new Tindividual_core();
            $child_physical->joinAdd('left',$child_physical,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $child_physical->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $child_physical->whereAdd("child_physical.created>='$start_time'");
            $child_physical->whereAdd("child_physical.created<'$end_time'");
            $child_physical_nums=$child_physical->count();
            $this->view->child_physical_nums=$child_physical_nums;
            //3岁儿童健康检查次数
            require_once __SITEROOT."library/Models/child_physical_age_three.php";
            $child_physical_age_three=new Tchild_physical_age_three();
            $individual_core=new Tindividual_core();
            $child_physical_age_three->joinAdd('left',$child_physical_age_three,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $child_physical_age_three->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $child_physical_age_three->whereAdd("child_physical_age_three.created>='$start_time'");
            $child_physical_age_three->whereAdd("child_physical_age_three.created<'$end_time'");
            $child_physical_age_three_nums=$child_physical_age_three->count();
            $this->view->child_physical_age_three_nums=$child_physical_age_three_nums;
            $child_total=0;
            $child_total=$child_visits_nums+$child_physical_nums+$child_physical_age_three_nums;
            $this->view->child_total=$child_total;
            //第1次产前随访次数
            require_once __SITEROOT."library/Models/prenatal_visit_first.php";
            $prenatal_visit_first=new Tprenatal_visit_first();
            $individual_core=new Tindividual_core();
            $prenatal_visit_first->joinAdd('left',$prenatal_visit_first,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $prenatal_visit_first->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $prenatal_visit_first->whereAdd("prenatal_visit_first.created>='$start_time'");
            $prenatal_visit_first->whereAdd("prenatal_visit_first.created<'$end_time'");
            $prenatal_visit_first_nums=$prenatal_visit_first->count();
            $this->view->prenatal_visit_first_nums=$prenatal_visit_first_nums;
            //第2-5次产前随访次数
            require_once __SITEROOT."library/Models/prenatal_visit_two.php";
            $prenatal_visit_two=new Tprenatal_visit_two();
            $individual_core=new Tindividual_core();
            $prenatal_visit_two->joinAdd('left',$prenatal_visit_two,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $prenatal_visit_two->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $prenatal_visit_two->whereAdd("prenatal_visit_two.created>='$start_time'");
            $prenatal_visit_two->whereAdd("prenatal_visit_two.created<'$end_time'");
            $prenatal_visit_two_nums=$prenatal_visit_two->count();
            $this->view->prenatal_visit_two_nums=$prenatal_visit_two_nums;
            //产后随访次数
            require_once __SITEROOT."library/Models/postpartum_visit.php";
            $postpartum_visit=new Tpostpartum_visit();
            $individual_core=new Tindividual_core();
            $postpartum_visit->joinAdd('left',$postpartum_visit,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $postpartum_visit->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $postpartum_visit->whereAdd("postpartum_visit.created>='$start_time'");
            $postpartum_visit->whereAdd("postpartum_visit.created<'$end_time'");
            $postpartum_visit_nums=$postpartum_visit->count();
            $this->view->postpartum_visit_nums=$postpartum_visit_nums;
            //产后42天检查次数
            require_once __SITEROOT."library/Models/postpartum_heathcheck.php";
            $postpartum_heathcheck=new Tpostpartum_heathcheck();
            $individual_core=new Tindividual_core();
            $postpartum_heathcheck->joinAdd('left',$postpartum_heathcheck,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $postpartum_heathcheck->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $postpartum_heathcheck->whereAdd("postpartum_heathcheck.created>='$start_time'");
            $postpartum_heathcheck->whereAdd("postpartum_heathcheck.created<'$end_time'");
            $postpartum_heathcheck_nums=$postpartum_heathcheck->count();
            $this->view->postpartum_heathcheck_nums=$postpartum_heathcheck_nums;
            $prenatal_total=0;
            $prenatal_total=$prenatal_visit_first_nums+$prenatal_visit_two_nums+$postpartum_visit_nums+$postpartum_heathcheck_nums;
            $this->view->prenatal_total=$prenatal_total;
            //婚前保健服务次数
            //医学婚检证明次数
            require_once __SITEROOT."library/Models/certificate_premartial_exam.php";
            $certificate_premartial_exam=new Tcertificate_premartial_exam();
            $individual_core=new Tindividual_core();
            $certificate_premartial_exam->joinAdd('left',$certificate_premartial_exam,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $certificate_premartial_exam->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $certificate_premartial_exam->whereAdd("certificate_premartial_exam.created>='$start_time'");
            $certificate_premartial_exam->whereAdd("certificate_premartial_exam.created<'$end_time'");
            $certificate_premartial_exam_nums=$certificate_premartial_exam->count();
            $this->view->certificate_premartial_exam_nums=$certificate_premartial_exam_nums;
            //婚前医学检查次数
            require_once __SITEROOT."library/Models/premarital_examination.php";
            $premarital_examination=new Tpremarital_examination();
            $individual_core=new Tindividual_core();
            $premarital_examination->joinAdd('left',$premarital_examination,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $premarital_examination->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $premarital_examination->whereAdd("premarital_examination.created>='$start_time'");
            $premarital_examination->whereAdd("premarital_examination.created<'$end_time'");
            $premarital_examination_nums=$premarital_examination->count();
            $this->view->premarital_examination_nums=$premarital_examination_nums;
            $certificate_premartial_exam_total=0;
            $certificate_premartial_exam_total=$certificate_premartial_exam_nums+$premarital_examination_nums;
            $this->view->certificate_premartial_exam_total=$certificate_premartial_exam_total;
            //预防接种次数
            require_once __SITEROOT."library/Models/vac_card.php";
            $vac_card=new Tvac_card();
            $individual_core=new Tindividual_core();
            $vac_card->joinAdd('left',$vac_card,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $vac_card->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $vac_card->whereAdd("vac_card.created>='$start_time'");
            $vac_card->whereAdd("vac_card.created<'$end_time'");
            $vac_card_nums=$vac_card->count();
            $this->view->vac_card_nums=$vac_card_nums;
            //高血压确诊人数
            require_once __SITEROOT."library/Models/clinical_history.php";
            $clinical_history_hy=new Tclinical_history();
            $individual_core=new Tindividual_core();
            $clinical_history_hy->joinAdd('left',$clinical_history_hy,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $clinical_history_hy->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $clinical_history_hy->whereAdd("clinical_history.created>='$start_time'");
            $clinical_history_hy->whereAdd("clinical_history.created<'$end_time'");
            $clinical_history_hy->whereAdd("clinical_history.disease_state='1'");
            $clinical_history_hy->whereAdd("clinical_history.disease_code='2'");
            $clinical_history_hy_nums=$clinical_history_hy->count();
            $this->view->clinical_history_hy_nums=$clinical_history_hy_nums;
            //高血压管理人数
            require_once __SITEROOT."library/Models/hypertension_follow_up.php";
            $hypertension_follow_up=new Thypertension_follow_up();
            $individual_core=new Tindividual_core();
            $hypertension_follow_up->joinAdd('left',$hypertension_follow_up,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $hypertension_follow_up->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $hypertension_follow_up->whereAdd("hypertension_follow_up.created>='$start_time'");
            $hypertension_follow_up->whereAdd("hypertension_follow_up.created<'$end_time'");
            $hypertension_follow_up_p_nums=$hypertension_follow_up->count("distinct individual_core.uuid");
            $this->view->hypertension_follow_up_p_nums=$hypertension_follow_up_p_nums;
            //高血压随访次数
            $hypertension_follow_up=new Thypertension_follow_up();
            $individual_core=new Tindividual_core();
            $hypertension_follow_up->joinAdd('left',$hypertension_follow_up,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $hypertension_follow_up->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $hypertension_follow_up->whereAdd("hypertension_follow_up.created>='$start_time'");
            $hypertension_follow_up->whereAdd("hypertension_follow_up.created<'$end_time'");
            $hypertension_follow_up_nums=$hypertension_follow_up->count();
            $this->view->hypertension_follow_up_nums=$hypertension_follow_up_nums;
            //糖尿病确诊人数
            $clinical_history_cd=new Tclinical_history();
            $individual_core=new Tindividual_core();
            $clinical_history_cd->joinAdd('left',$clinical_history_cd,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $clinical_history_cd->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $clinical_history_cd->whereAdd("clinical_history.created>='$start_time'");
            $clinical_history_cd->whereAdd("clinical_history.created<'$end_time'");
            $clinical_history_cd->whereAdd("clinical_history.disease_state='1'");
            $clinical_history_cd->whereAdd("clinical_history.disease_code='3'");
            $clinical_history_cd_nums=$clinical_history_cd->count();
            $this->view->clinical_history_cd_nums=$clinical_history_cd_nums;
            //糖尿病管理人数
            require_once __SITEROOT."library/Models/diabetes_core.php";
            $diabetes_core=new Tdiabetes_core();
            $individual_core=new Tindividual_core();
            $diabetes_core->joinAdd('left',$diabetes_core,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $diabetes_core->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $diabetes_core->whereAdd("diabetes_core.created>='$start_time'");
            $diabetes_core->whereAdd("diabetes_core.created<'$end_time'");
            $diabetes_core_p_nums=$diabetes_core->count("distinct individual_core.uuid");
            $this->view->diabetes_core_p_nums=$diabetes_core_p_nums;
            //糖尿病随访次数
            $diabetes_core=new Tdiabetes_core();
            $individual_core=new Tindividual_core();
            $diabetes_core->joinAdd('left',$diabetes_core,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $diabetes_core->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $diabetes_core->whereAdd("diabetes_core.created>='$start_time'");
            $diabetes_core->whereAdd("diabetes_core.created<'$end_time'");
            $diabetes_core_nums=$diabetes_core->count();
            $this->view->diabetes_core_nums=$diabetes_core_nums;
            
            //精神分裂确诊人数
            $clinical_history_schizophrenia=new Tclinical_history();
            $individual_core=new Tindividual_core();
            $clinical_history_schizophrenia->joinAdd('left',$clinical_history_schizophrenia,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $clinical_history_schizophrenia->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $clinical_history_schizophrenia->whereAdd("clinical_history.created>='$start_time'");
            $clinical_history_schizophrenia->whereAdd("clinical_history.created<'$end_time'");
            $clinical_history_schizophrenia->whereAdd("clinical_history.disease_state='1'");
            $clinical_history_schizophrenia->whereAdd("clinical_history.disease_code='8'");
            $clinical_history_schizophrenia_nums=$clinical_history_schizophrenia->count();
            $this->view->clinical_history_schizophrenia_nums=$clinical_history_schizophrenia_nums;
            //精神分裂管理人数
            require_once __SITEROOT."library/Models/schizophrenia.php";
            $schizophrenia=new Tschizophrenia();
            $individual_core=new Tindividual_core();
            $schizophrenia->joinAdd('left',$schizophrenia,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $schizophrenia->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $schizophrenia->whereAdd("schizophrenia.created>='$start_time'");
            $schizophrenia->whereAdd("schizophrenia.created<'$end_time'");
            $schizophrenia_p_nums=$schizophrenia->count("distinct individual_core.uuid");
            $this->view->schizophrenia_p_nums=$schizophrenia_p_nums;
            //精神分裂随访次数
            $schizophrenia=new Tschizophrenia();
            $individual_core=new Tindividual_core();
            $schizophrenia->joinAdd('left',$schizophrenia,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $schizophrenia->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $schizophrenia->whereAdd("schizophrenia.created>='$start_time'");
            $schizophrenia->whereAdd("schizophrenia.created<'$end_time'");
            $schizophrenia_nums=$schizophrenia->count();
            $this->view->schizophrenia_nums=$schizophrenia_nums;
            //其他确诊人数
            $clinical_history_other=new Tclinical_history();
            $individual_core=new Tindividual_core();
            $clinical_history_other->joinAdd('left',$clinical_history_other,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $clinical_history_other->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $clinical_history_other->whereAdd("clinical_history.created>='$start_time'");
            $clinical_history_other->whereAdd("clinical_history.created<'$end_time'");
            $clinical_history_other->whereAdd("clinical_history.disease_state='1'");
            $clinical_history_other->whereAdd("clinical_history.disease_code!='8'");
            $clinical_history_other->whereAdd("clinical_history.disease_code!='2'");
            $clinical_history_other->whereAdd("clinical_history.disease_code!='3'");
            $clinical_history_other_nums=$clinical_history_other->count();
            $this->view->clinical_history_other_nums=$clinical_history_other_nums;
            // 接诊记录
            require_once __SITEROOT."library/Models/diagnosis_table.php";
            $diagnosis_table=new Tdiagnosis_table();
            $individual_core=new Tindividual_core();
            $diagnosis_table->joinAdd('left',$diagnosis_table,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $diagnosis_table->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $diagnosis_table->whereAdd("diagnosis_table.created>='$start_time'");
            $diagnosis_table->whereAdd("diagnosis_table.created<'$end_time'");
            $diagnosis_table_nums=$diagnosis_table->count();
            $this->view->diagnosis_table_nums=$diagnosis_table_nums;
            // 会诊记录
            require_once __SITEROOT."library/Models/consultation_table.php";
            $consultation_table=new Tconsultation_table();
            $individual_core=new Tindividual_core();
            $consultation_table->joinAdd('left',$consultation_table,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $consultation_table->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $consultation_table->whereAdd("consultation_table.created>='$start_time'");
            $consultation_table->whereAdd("consultation_table.created<'$end_time'");
            $consultation_table_nums=$consultation_table->count();
            $this->view->consultation_table_nums=$consultation_table_nums;
            // 转入
            require_once __SITEROOT."library/Models/patient_referral_in.php";
            $patient_referral_in=new Tpatient_referral_in();
            $individual_core=new Tindividual_core();
            $patient_referral_in->joinAdd('left',$patient_referral_in,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $patient_referral_in->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $patient_referral_in->whereAdd("patient_referral_in.created>='$start_time'");
            $patient_referral_in->whereAdd("patient_referral_in.created<'$end_time'");
            $patient_referral_in_nums=$patient_referral_in->count();
            $this->view->patient_referral_in_nums=$patient_referral_in_nums;
            //patient_referral_out 转出
            require_once __SITEROOT."library/Models/patient_referral_out.php";
            $patient_referral_out=new Tpatient_referral_out();
            $individual_core=new Tindividual_core();
            $patient_referral_out->joinAdd('left',$patient_referral_out,$individual_core,'id','uuid');
            foreach($region_path as $k=>$v)
            {
                $patient_referral_out->whereAdd("individual_core.region_path like '$v%'","or");
            }
            $patient_referral_out->whereAdd("patient_referral_out.created>='$start_time'");
            $patient_referral_out->whereAdd("patient_referral_out.created<'$end_time'");
            $patient_referral_out_nums=$patient_referral_out->count();
            $this->view->patient_referral_out_nums=$patient_referral_out_nums;
        }
        else
        {
            //未选择区域错误
        }
        $this->view->display("total.html");
    }
    //取指定区域下的ID
    public function agencyAction()
    {
        //取当前区域ID
        $region_id=$this->_request->getParam('region')?$this->_request->getParam('region'):$this->user['region_id'];
        $org_id=$this->user['org_id'];
        $region=new Tregion();
        $region->whereAdd("id='$region_id'");
        $region->find(true);
        $region_path=$region->region_path;
        $org="<option value=''>-所属机构-</option>";
        if($region_path)
        {
            $organization=new Torganization();
            $organization->whereAdd("region_path like '$region_path%'");
            $organization->find();
            while($organization->fetch())
            {
                if($org_id==$organization->id)
                {
                    $org.="<option value='".$organization->id."' selected='selected'>";
                }
                else
                {
                    $org.="<option value='".$organization->id."'>";
                }
                $org.=$organization->zh_name."</option>";
            }
        }
        echo $org;
        exit;
    }

}
?>