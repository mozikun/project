<?php
   class iha_extsearchController extends controller 
   {
   	 public function init()
   	 {
   	 	require_once __SITEROOT.'library/Models/individual_archive.php';
        require_once __SITEROOT.'library/Models/individual_core.php';
        require_once __SITEROOT.'library/Models/staff_core.php';
        require_once __SITEROOT.'library/Models/health_education.php';
        require_once __SITEROOT.'library/Models/organization.php';
        require_once __SITEROOT.'library/Models/examination_table.php';
        require_once __SITEROOT.'library/Models/et_general_condition.php';
        require_once __SITEROOT.'library/Models/et_health_assessment.php';
        require_once __SITEROOT.'library/Models/hypertension_follow_up.php';//高血压随访
        require_once __SITEROOT.'library/Models/diabetes_core.php';//糖尿病随访
        require_once __SITEROOT.'library/Models/schizophrenia.php';//重性精神疾病随访
        $this->view->basePath =  __BASEPATH;
   	 }
   	 public function extsearchAction()
   	 {
   	 	require_once __SITEROOT.'library/custom/comm_function.php';
   	 	require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
   	 	$identity_number  = $this->_request->getParam('id');
   	 	$org  = $this->_request->getParam('org');
   	 	$action  = $this->_request->getParam('action');
   	 	//防止未登录直接输url
   	 	if(!empty($action))
   	 	{
   	 		$mobile = new Zend_Session_Namespace("mobile");
   	 		$moblie_identity = $mobile->identity_number;
   	 		$moblie_device_id = $mobile->device_id;
   	 		//$moblie_card = $mobile->card;
   	 		if(empty($moblie_identity)&&empty($moblie_device_id))
   	 		{
   	 			$url=array("未能通过验证，请重新登录"=>__BASEPATH.'iha/login/index');
			    message("重新登录！",$url);
   	 		}
   	 	}
   	 	//$org = '888888';
   	 	//$identity_number = '51310119761005381x';
        if(!empty($identity_number)&&!empty($org))
        {
        	//取得机构信息
        	$organization  = new Torganization();
        	$organization->whereAdd("standard_code='$org'");
        	if($organization->count()>0)
        	{
        		//$organization->debug(9);
        		$organization->find(true);
        		//取得个人信息
        		$individual_core = new Tindividual_core();
        		$individual_archive = new Tindividual_archive();
        		$individual_core->joinAdd("left",$individual_core,$individual_archive,'uuid','id');
        		$individual_core->whereAdd("individual_core.identity_number='$identity_number'");
        		if(empty($action))
        		{
        			$individual_core->whereAdd("individual_core.org_id='$organization->id'");//为了手机访问
        		}
				//$individual_core->debugLevel(9);
        		if($individual_core->count()>0)
        		{
        			//$individual_core->debugLevel(9);
		    		$individual_core->find(true);
		    		$individual_core->sex=@$sex[array_search_for_other($individual_core->sex,$sex)][1];
		    		$individual_core->race=@$race[array_search_for_other($individual_core->race,$race)][1];
		            $individual_core->age=getBirthday($individual_core->date_of_birth,time());
		            $individual_core->date_of_birth=adodb_date("Y-m-d",$individual_core->date_of_birth);
		            $main_img = $individual_core->uuid.'.gif';
		            //echo __SITEROOT."upload/".$main_img;
		    		if(!file_exists(__SITEROOT."upload/".$main_img))
		    		{
		    			$main_img_src = __BASEPATH.'views/images/nopic.gif';
		    		}
		    		else 
		    		{
		    			$main_img_src = __BASEPATH."upload/".$main_img;
		    		}
		            $individual_core->main_img_src = $main_img_src;
		            //取得血型
		            require_once __SITEROOT.'/library/Models/blood_type.php';
					$blood=new Tblood_type();
					$blood->whereAdd("id='$individual_core->uuid'");
					$blood->find(true);
					$abo_bloodtype=$blood->abo_bloodtype;
	                if($abo_bloodtype)
	                {
	                    $blood->abo_bloodtype=$ABO_bloodtype[$abo_bloodtype][1];
	                }
	                else
	                {
	                    $blood->abo_bloodtype="未说明";
	                }
	                $blood->free_statement();
				    $this->view->assign("blood",$blood);
				    //基本健康信息
				    //读取药物过敏史
	                require_once __SITEROOT . '/library/Models/allergy.php';
	                $allergy = new Tallergy();
	                $allergy->whereAdd("id='$individual_core->uuid'");
	                if($allergy->count()>0)
	                {
		                $allergy->find();
		                $allergy_array = array();
		                $str = '';
		                while ($allergy->fetch())
		                {
		                    $str.=$allergy_history[array_search_for_other($allergy->allergy_code, $allergy_history)][1].',';
		                }
		                $individual_core->allergy_code = rtrim($str,',');
	                }
	                else 
	                {
	                	$individual_core->allergy_code = '未填写';
	                }
				    //暴露史
		            require_once __SITEROOT . '/library/Models/exposure_history.php';
	                $exposure = new Texposure_history();
	                $exposure->whereAdd("id='$individual_core->uuid'");                
	                $exposure_str = '';
	                if($exposure->count()>0)
	                {
	                	$exposure->find();
		                while ($exposure->fetch())
		                {
		                    $exposure_str.= $iha_exposure_history[array_search_for_other($exposure->exposure_code, $iha_exposure_history)][1].',';
		                }
		                $individual_core->exposure_code = rtrim($exposure_str,',');
	                }
	                else 
	                {
	                	$individual_core->exposure_code = '未填写';
	                }
	                //l既往史 
	                //读取疾病史
	                require_once __SITEROOT . '/library/Models/clinical_history.php';
	                $clinical_history = new Tclinical_history();
	                $clinical_history->whereAdd("id='$individual_core->uuid'");
	                $clinical_history->find();
	                $clinical_array = array();
	                $i = 0;
	                while ($clinical_history->fetch())
	                {     
	                	$clinical_array[$i]['year'] = $clinical_history->disease_date ? adodb_date("Y",$clinical_history->disease_date) : "";
	                    $clinical_array[$i]['month'] = $clinical_history->disease_date ? adodb_date("m",$clinical_history->disease_date) : "";
	                    $clinical_array[$i]['day'] = $clinical_history->disease_date ? adodb_date("d", $clinical_history->disease_date) : "";
	                    $clinical_array[$i]['mycode'] = $clinical_array[$i]['year'].'-'.$clinical_array[$i]['month'].'-'.$clinical_array[$i]['day'].'，'.$disease_history[array_search_for_other($clinical_history->disease_code, $disease_history)][1];  
	                    $i++;
	                }
	                $this->view->clinical_array = $clinical_array;
	                //读取手术史
	                require_once __SITEROOT . '/library/Models/surgical_history.php';
	                $surgical_history = new Tsurgical_history();
	                $surgical_history->whereAdd("id='$individual_core->uuid'");
	                $surgical_history->whereAdd("operation_id is not null");
	                $surgical_history->find();
	                $surgical_array = array();
	                $i = 0;
	                while ($surgical_history->fetch())
	                {
	                	$surgical_array[$i]['year'] = $surgical_history->operation_date ? adodb_date("Y-m-d",
	                        $surgical_history->operation_date) : "";
	                    $surgical_array[$i]['code'] = $surgical_array[$i]['year'].'，'.$surgical_history->operation_id;
	                    $i++;
	                }
	                $this->view->surgical_array = $surgical_array;
	                //遗传病史
		            require_once __SITEROOT . '/library/Models/genetic_diseases.php';
		            $genetic_diseases = new Tgenetic_diseases();
		            $genetic_diseases->whereAdd("id='$individual_core->uuid'");
		            $genetic_diseases->find(true);
		            $genetic_diseases->disease_name = empty($genetic_diseases->disease_name)?'无':$genetic_diseases->disease_name;
		            $this->view->genetic_diseases = $genetic_diseases;
		            //残疾状况
	                require_once __SITEROOT . '/library/Models/deformity.php';
	                $deformity = new Tdeformity();
	                $deformity->orderby("deformity_type asc");
	                $deformity->whereAdd("id='$individual_core->uuid'");
	                if($deformity->count()>0)
	                {
		                $deformity->find();
		                $deformity_str = '';
		                while ($deformity->fetch())
		                {
		                    $deformity_str.= $deformity_type[array_search_for_other($deformity->deformity_type, $deformity_type)][1].',';
		                }
		                $individual_core->deformity_str = rtrim($deformity_str,','); 
	                }
	                else 
	                {
	                	$individual_core->deformity_str = '未填写';
	                }
		            $this->view->individual_core = $individual_core;
		            //体检信息
		            $examination_table = new Texamination_table();
		            $examination_table->whereAdd("id='$individual_core->uuid'");
		            $examination_table->orderby("created DESC");
		            $examination_table->limit(0,1);
		            //$examination_table->debugLevel(9);
		            $examination_table->find(true);
		            $examination_uuid = $examination_table->uuid;
		            $et_general_condition = new Tet_general_condition();
		            $et_general_condition->whereAdd("uuid='$examination_uuid'");
		            $et_general_condition->find(true);
		            $et_general_condition->temperature = empty($et_general_condition->temperature)?'未填写':$et_general_condition->temperature.'℃';
		            $et_general_condition->pulse = empty($et_general_condition->pulse)?'未填写':$et_general_condition->pulse.'次/分钟';
		            $et_general_condition->breathing_rate = empty($et_general_condition->breathing_rate)?'未填写':$et_general_condition->breathing_rate.'次/分钟';
		            
		            $et_general_condition->waistline = empty($et_general_condition->waistline)?'未填写':$et_general_condition->waistline.'cm';
		            //血压左右侧
		            $left_one = empty($et_general_condition->blood_pressure_left_s)?'未填写':$et_general_condition->blood_pressure_left_s;
		            $right_one = empty($et_general_condition->blood_pressure_right_s)?'未填写':$et_general_condition->blood_pressure_right_s;
		            $left_two = empty($et_general_condition->blood_pressure_left_p)?'未填写':$et_general_condition->blood_pressure_left_p;
		            $right_two = empty($et_general_condition->blood_pressure_right_p)?'未填写':$et_general_condition->blood_pressure_right_p;
		            $et_general_condition->blood_pressure_left_s = $left_one.'/'.$left_two;
		            
		            $et_general_condition->blood_pressure_left_p = $right_one.'/'.$right_two;
		            $et_general_condition->height = empty($et_general_condition->height)?'未填写':$et_general_condition->height.'(cm)';
		            $et_general_condition->weight = empty($et_general_condition->weight)?'未填写':$et_general_condition->weight.'(kg)';         
		            
		            require_once __SITEROOT . '/library/Models/et_examination.php';
		            $et_examination = new Tet_examination();
		            $et_examination->whereAdd("uuid='$examination_uuid'");
		            $et_examination->find(true);
		            //空腹血糖
		            $et_general_condition->fbglucoseh = empty($et_examination->fbglucoseh)?'未填写':$et_examination->fbglucoseh.'mmol/L';
		            //尿微量白蛋白
		            $et_general_condition->microurine = empty($et_examination->microurine)?'未填写':$et_examination->microurine.'mg/dl';
		            $this->view->et_general_condition = $et_general_condition;
		            //慢病随访情况
		            $disease_modules = array('hypertension_follow_up'=>'高血压','diabetes_core'=>'糖尿病','schizophrenia'=>'重性精神疾病');
		            $disease_array = array();
		            $count = 0;
		            $time_name = '';
		            $result = '';
		            foreach($disease_modules as $k=>$v)
		            {
		            	$tabname = 'T'.$k;
		            	$obj =  new $tabname();
		            	$obj->whereAdd("id='$individual_core->uuid'");
		            	if($k=='hypertension_follow_up')
		            	{
		            		$time_name = 'follow_time';
		            	}
		            	if($k=='diabetes_core')
		            	{
		            		$time_name = 'followup_time';
		            	}
		            	if($k=='schizophrenia')
		            	{
		            		$time_name = 'fllowup_time';
		            	}
		            	$obj->orderby("$time_name DESC");
		            	$obj->limit(0,1);
		            	$obj->find(true);
		            	if($k=='hypertension_follow_up')
		            	{
		            		$result ='follow_result';
		            	}
		            	if($k=='diabetes_core')
		            	{
		            		$result = 'followup_result';
		            	}
		            	if($k=='schizophrenia')
		            	{
		            		$result = 'followup_content';
		            	}      
		            	$disease_array[$count]['disease_name'] = $v;
		            	$disease_array[$count]['followup_content'] = empty($obj->$result)?'未随访':$obj->$result;
		            	$disease_array[$count]['fllowup_time'] = empty($obj->$time_name)?'未随访':date("Y-m-d",$obj->$time_name);
		            	$count++;
		            }
		            $this->view->disease_array = $disease_array;
		            //门诊信息
                require_once __SITEROOT."library/Models/tb_his_patinf.php";
                require_once __SITEROOT."library/Models/tb_yl_mz_medical_record.php";
                require_once __SITEROOT."library/Models/tb_his_mz_fee_detail.php";
                $tb_yl_patient_information=new Ttb_his_patinf(2);
                $tb_yl_mz_medical_record=new Ttb_yl_mz_medical_record(2);
                $tb_yl_patient_information->joinAdd('left',$tb_yl_patient_information,$tb_yl_mz_medical_record,'kh','kh');
                $tb_yl_patient_information->joinAdd('left',$tb_yl_patient_information,$tb_yl_mz_medical_record,'klx','klx');
                $tb_yl_patient_information->whereAdd("tb_his_patinf.identity_number='$identity_number'");
                $tb_yl_patient_information->orderby("tb_yl_mz_medical_record.jzksrq desc");
                $tb_yl_patient_information->find();
                $tb_yl_mz_medical_record_array=array();
                $i=0;
                while ($tb_yl_patient_information->fetch())
                {
                	$tb_yl_mz_medical_record_array[$i]['jzksrq']=$tb_yl_mz_medical_record->jzksrq;
                	$tb_yl_mz_medical_record_array[$i]['yljgdm']=get_organization_by_standard_code($tb_yl_mz_medical_record->yljgdm);
                	$tb_yl_mz_medical_record_array[$i]['zzysxm']=$tb_yl_mz_medical_record->zzysxm;
                	$tb_yl_mz_medical_record_array[$i]['hzxm']=$tb_yl_mz_medical_record->hzxm;
                	$tb_yl_mz_medical_record_array[$i]['jzzdmc']=empty($tb_yl_mz_medical_record->jzzdmc)?'未说明':$tb_yl_mz_medical_record->jzzdmc;
                	$tb_yl_mz_medical_record_array[$i]['fee']=$this->get_fee($tb_yl_mz_medical_record->jzlsh);
                	$tb_yl_mz_medical_record_array[$i]['fee_count']=count($tb_yl_mz_medical_record_array[$i]['fee']);
                	$tb_yl_mz_medical_record_array[$i]['myorder'] = $i+1;
                	$i++;
                }
                $tb_yl_patient_information->free_statement();
                $this->view->tb_yl_mz_medical_record=$tb_yl_mz_medical_record_array;
                //处方显示：门诊处方明细表(TB_CIS_Prescription_Detail)：处方号码，医疗机构，就诊科室名称，开方医生姓名，开方时间，发药数量，用药频次
                require_once __SITEROOT."library/Models/tb_cis_prescription_detail.php";
                $tb_yl_patient_information=new Ttb_his_patinf(2);
                $tb_yl_mz_medical_record=new Ttb_yl_mz_medical_record(2);
                $tb_yl_patient_information->joinAdd('left',$tb_yl_patient_information,$tb_yl_mz_medical_record,'kh','kh');
                $tb_yl_patient_information->joinAdd('left',$tb_yl_patient_information,$tb_yl_mz_medical_record,'klx','klx');
                $tb_yl_patient_information->whereAdd("tb_his_patinf.identity_number='$identity_number'");
                $tb_yl_patient_information->orderby("tb_yl_mz_medical_record.jzksrq desc");
                $tb_yl_patient_information->find();
                $tb_cis_prescription_detail_array=array();
                $i=0;
                while ($tb_yl_patient_information->fetch())
                {
                	$tb_cis_prescription_detail_array[$i]['jzksrq']=$tb_yl_mz_medical_record->jzksrq;
                	$tb_cis_prescription_detail_array[$i]['yljgdm']=get_organization_by_standard_code($tb_yl_mz_medical_record->yljgdm);
                	$tb_cis_prescription_detail_array[$i]['zzysxm']=$tb_yl_mz_medical_record->zzysxm;
                	$tb_cis_prescription_detail_array[$i]['hzxm']=$tb_yl_mz_medical_record->hzxm;
                	$tb_cis_prescription_detail_array[$i]['jzzdmc']=$tb_yl_mz_medical_record->jzzdmc;
                	$tb_cis_prescription_detail_array[$i]['cis']=$this->get_cis($tb_yl_mz_medical_record->jzlsh);
                	$tb_cis_prescription_detail_array[$i]['cis_count']=count($tb_cis_prescription_detail_array[$i]['cis']);	                $tb_cis_prescription_detail_array[$i]['myorder'] = $i+1;
                	$i++;
                }
                $tb_yl_patient_information->free_statement();
                $this->view->tb_cis_prescription_detail=$tb_cis_prescription_detail_array;
                //健康教育
                $health_education=new Thealth_education();
		        $staff_core=new Tstaff_core();
		        $health_education->joinAdd('left',$health_education,$staff_core,'staff_id','id');
		        $health_education->orderby("created DESC");
		        $health_education->limit(0,10);
		       // $health_education->debugLevel(9);
		        $health_education->find();
		        $j = 0;
		        $he = array();
		        while ($health_education->fetch())
		        {
			        $he[$j]['activity_time']=$health_education->activity_time?adodb_date("Y-m-d",$health_education->activity_time):"";
					$he[$j]['activity_address']=$health_education->activity_address;
					$he[$j]['sponsor']=$health_education->sponsor;
					$he[$j]['person_in_charge']=get_staff_name_byid($health_education->person_in_charge);
		        	$j++;
		        }
		        $this->view->he = $he;
		        //针对手机用户的
		         if(!empty($action))
		         {
		         	switch ($action)
		         	{
		         		case '1':
		         			$this->view->title = '个人基本信息';
		         			$this->view->display('base.html');//个人基本信息
		         			break;
		         		case '2':
		         			$this->view->title = '基本健康信息';
		         			$this->view->display('basehealth.html');//基本健康信息
		         			break;
		         		case '3':
		         			$this->view->title = '最近一次体检记录';
		         			$this->view->display('et.html');//体检信息
		         			break;
		         	    case '4':
		         			$this->view->title = '最近一次慢病随访';
		         			$this->view->display('disease.html');//体检信息
		         			break;
		         		case '5':
		         			$this->view->title = '最近二次就诊记录';
		         			$this->view->display('mzrecord.html');//体检信息
		         			break;
	         			case '6':
	         			$this->view->title = '门诊处方记录';
	         			$this->view->display('chufang.html');//体检信息
	         			break;
	         			case '7':
	         			$this->view->title = '健康教育';
	         			$this->view->display('edu.html');//体检信息
	         			break;
		         	}
		         	exit();
		         }
		    	}
		    	else 
		    	{
		    		exit('居民不存在');
		    	}
		    	//
        	}
        	else 
        	{
        		exit('机构不存在');
        	}
        }
        else 
        {
        	exit('参数不完全');
        }
   	 	$this->view->display('extsearch.html');
   	 }
   	 
   	 /**
     * 获取门诊费用详情
     *
     * @param string $jzlsh
     * @return string
     */
    private function get_fee($jzlsh)
    {
    	$mxfylb=array("02" => "诊疗费","03" => "治疗费","05" => "手术材料费","06" => "检查费","07" => "化验费","08" => "摄片费","09" => "透视费","10" => "输血费","11" => "输氧费","12" => "西药费","13" => "中成药费","14" => "中草药费","15" => "其它费用","00" => "挂号费");
    	$tb_his_mz_fee_detail=new Ttb_his_mz_fee_detail(2);
    	$tb_his_mz_fee_detail->whereAdd("jzlsh='$jzlsh'");
    	$tb_his_mz_fee_detail->whereAdd("tb_his_mz_fee_detail.xgbz=1");//收费
    	$tb_his_mz_fee_detail->find();
    	$fee=array();
    	$i=0;
    	while ($tb_his_mz_fee_detail->fetch())
    	{
    		$fee[$i]['mxfylb']=@$mxfylb[$tb_his_mz_fee_detail->mxfylb];
	    	$fee[$i]['stfsj']=$tb_his_mz_fee_detail->stfsj;
	    	$fee[$i]['mxxmbm']=$tb_his_mz_fee_detail->mxxmbm;
	    	$fee[$i]['mxxmmc']=$tb_his_mz_fee_detail->mxxmmc;
	    	$fee[$i]['mxxmdw']=$tb_his_mz_fee_detail->mxxmdw;
	    	$fee[$i]['mxxmdj']=@floatval($tb_his_mz_fee_detail->mxxmdj);
	    	$fee[$i]['mxxmsl']=$tb_his_mz_fee_detail->mxxmsl;
	    	$fee[$i]['mxxmje']=@floatval($tb_his_mz_fee_detail->mxxmje);
	    	$i++;
    	}
    	$tb_his_mz_fee_detail->free_statement();
    	return $fee;
    }
      /**
     * 获取处方详情
     *
     * @param string $jzlsh
     * @return string
     */
    private function get_cis($jzlsh)
    {
    	$tb_cis_prescription_detail=new Ttb_cis_prescription_detail(2);
    	$tb_cis_prescription_detail->whereAdd("jzlsh='$jzlsh'");
    	$tb_cis_prescription_detail->find();
    	$fee=array();
    	$i=0;
    	while ($tb_cis_prescription_detail->fetch())
    	{
    		$fee[$i]['cyh']=$tb_cis_prescription_detail->cyh;
	    	$fee[$i]['yljgdm']=get_organization_by_standard_code($tb_cis_prescription_detail->yljgdm);
	    	$fee[$i]['jzksmc']=$tb_cis_prescription_detail->jzksmc;
	    	$fee[$i]['kfysxm']=$tb_cis_prescription_detail->kfysxm;
	    	$fee[$i]['kfrq']=$tb_cis_prescription_detail->kfrq;
	    	$fee[$i]['ypsl']=$tb_cis_prescription_detail->ypsl;
	    	$fee[$i]['sypc']=$tb_cis_prescription_detail->sypc;
	    	$fee[$i]['ypdw']=$tb_cis_prescription_detail->ypdw;
			$fee[$i]['xmmc']=$tb_cis_prescription_detail->xmmc;
	    	$i++;
    	}
    	$tb_cis_prescription_detail->free_statement();
    	return $fee;
    }
   }