<?php 
/**
 * 
 * @author ct
 * Date : 2010-11-2
 * Summary : 新生儿家庭访视记录
 */
class children_newbornController extends controller{
	public function init(){
		require_once __SITEROOT.'library/privilege.php';
		require_once __SITEROOT.'library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'library/custom/comm_function.php';
		require_once __SITEROOT."library/Models/child_visits.php";
		require_once __SITEROOT."library/Models/staff_core.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
		require_once __SITEROOT."library/custom/pager.php";
		require_once __SITEROOT."library/Models/individual_core.php";
	}
    public function indexAction(){
    	//引用数据字典
    	require_once __SITEROOT.'library/data_arr/arrdata.php';
    	//var_dump($bb_f_hearing);
    	$this->view->disease_pregnancy    =   $bb_f_casesofmother;//母亲妊娠患病疾病情况
    	$this->view->disease_pregnancy_json = json_encode($bb_f_casesofmother);
    	$this->view->birth_complexion     =   $bb_f_births;//出生情况
    	$this->view->sleepy_baby          =   $bb_f_asphyxia;//新生儿窒息
    	$this->view->sleepy_baby_json     =   json_encode($bb_f_asphyxia);
    	$this->view->children_apgar       =   $children_apgar;//新生儿apgar评分
    	//新生儿窒息情况
    	$sexcategory = array("1"=>"轻","2"=>"中","3"=>"重");  
        $this->view->sexcategory          =   $sexcategory;
    	$this->view->deformity            =   $bb_f_abnormal;//是否有畸形     
    	$this->view->deformity_json       =   json_encode($bb_f_abnormal);
    	$this->view->hearing_screening    =   $bb_f_hearing;//新生儿听力筛查 
    	$this->view->neonatal_screening   =   $neonatal_screening;//新生儿疾病筛查  
    	$this->view->neonatal_json        =   json_encode($neonatal_screening);  
    	$this->view->hearing_screening_json = json_encode($bb_f_hearing);
    	$this->view->breast_milk          =   $bb_f_feeding;//新生儿喂养方式 
    	$this->view->complexion           =   $bb_f_complexion;//新生儿面色  
    	$this->view->children_jaundice    =   $children_jaundice;//黄疸部位
    	$this->view->bregma               =   $bb_f_fontanel;//新生儿前囟   
    	$this->view->bregma_json          =   json_encode($bb_f_fontanel);    
    	$this->view->children_vomit       =   $children_vomit;//新生儿呕吐
    	$this->view->children_defecate    =   $children_defecate;//新生儿大便
    	$this->view->eye                  =   $bb_exception;//眼
    	$this->view->limb                 =   $bb_exception;//四肢活动度
    	$this->view->ear                  =   $bb_exception;//耳
    	$this->view->cervical_mass        =   $bb_f_neckmass;//颈部包块
    	$this->view->nose                 =   $bb_exception;//鼻子
    	$this->view->skin                 =   $bb_f_skin;//皮肤
    	$this->view->oral_cavity          =   $bb_exception;//口腔
    	$this->view->gmzz                 =   $bb_exception;//肛门
    	$this->view->heart_lung           =   $bb_exception;//心肺
    	$this->view->pudendum             =   $bb_exception;//外生殖器
    	$this->view->abdomen              =   $bb_exception;//腹部
    	$this->view->rachis               =   $bb_exception;//脊柱
    	$this->view->umbilical_cord       =   $bb_f_cord;//脐带
    	$this->view->umbilical_cord_json  =   json_encode($bb_f_cord);
    	$this->view->referral_features    =   $bb_f_neckmass;//转诊
    	$this->view->advising             =   $bb_f_guide;//指导
    	$this->view->sexarray             =    $sex;//性别
    	//处理随访医生签名
		$staffList  =  region_users($this->user['current_region_path_domain']);//来自于comm_function.php
		$this->view->stafflist = $staffList;
		$this->view->currentstaffid        = $this->user['uuid'];//当前的医生ID
		$this->view->currentstaffname_real = $this->user['name_real'];//当前的医生名字
		$this->view->currentorgName        = $this->user['org_zh_name'];
    	//编辑时候传来的
    	$uuid=$this->_request->getParam("uuid",'');
		$this->view->uuid=$uuid;
        $individual_session=new Zend_Session_Namespace("individual_core");	
		if(empty($uuid)){
			if(empty($individual_session->uuid) || empty($individual_session->staff_id)){
				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			//2012-02-21仅添加正常档案
			if($individual_session->status_flag!=1){
	            message("你选择了一个非正常档案，请重新选择",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
	        }
			//添加时	
			$individual_core = new Tindividual_core();
			$individual_core->whereAdd("uuid='$individual_session->uuid'");	
			$individual_core->find(true);
			$this->view->invaluid       =    $individual_session->standard_code_1;
			$this->view->name           =    $individual_session->name;			
			$this->view->currentsex     =    $individual_session->sex;		
			$this->view->birthday       =    adodb_date("Y-m-d",$individual_core->date_of_birth);//出生日期
			$this->view->identity_number=    $individual_core->identity_number;//身份证
			$this->view->address        =    $individual_session->address;    
			$this->view->currentihaid   =    $individual_session->uuid;//当前的个人档案号
			//开始写入数据表中
			$child_visits= new Tchild_visits();
			$currentTime = time();			
			$child_visits->uuid                    = uniqid('b_',true);//编号
			$child_visits->staff_id                = $individual_core->staff_id;//医生档案号
			$child_visits->id                      = $individual_session->uuid;//个人档案号
			$child_visits->created                 = adodb_mktime(0,0,0,adodb_date("n",$currentTime),adodb_date("j",$currentTime),adodb_date("Y",$currentTime));//添加记录时
			$child_visits->father_name             = $this->_request->getParam('father_name');//父亲姓名|text
			$child_visits->father_occupation       = $this->_request->getParam('father_occupation');//父亲职业|text
			$child_visits->father_phone            = $this->_request->getParam('father_phone');//父亲电话|text
			if($this->_request->getParam('father_birth')){
				$father_birth_str   =  $this->_request->getParam('father_birth');
				$father_birth_array =  explode('-',$father_birth_str);
				$father_birth_real  =  adodb_mktime(0,0,0,$father_birth_array[1],$father_birth_array[2],$father_birth_array[0]);
				$child_visits->father_birth            = $father_birth_real;//父亲出生日期|text
			}
			//echo $father_birth_real;
			$child_visits->mum_name                = $this->_request->getParam('mum_name');//母亲姓名|text
			$child_visits->mum_occupation          = $this->_request->getParam('mum_occupation');//母亲职业|text
			$child_visits->mum_phone               = $this->_request->getParam('mum_phone');//母亲电话|text
		   if($this->_request->getParam('mum_birth')){
				$mum_birth_str   =  $this->_request->getParam('mum_birth');
				$mum_birth_array =  explode('-',$mum_birth_str);
				$mum_birth_real  =  adodb_mktime(0,0,0,$mum_birth_array[1],$mum_birth_array[2],$mum_birth_array[0]);
				$child_visits->mum_birth            = $mum_birth_real;//母亲出生日期|text
			}
			$child_visits->gestational_week        = $this->_request->getParam('gestational_week');//出生孕周|text
			$child_visits->disease_pregnancy       = array_code_change($this->_request->getParam('disease_pregnancy'),$bb_f_casesofmother);//母亲妊娠期患病疾病情况|radio|1=>糖尿病,2=>妊娠期高血压,3=>其它
			$child_visits->disease_pregnancy_other = $this->_request->getParam('disease_pregnancy_other');//母亲妊娠期患病疾病情况其它|text
			$child_visits->midwifery_name          = $this->_request->getParam('midwifery_name');//助产机构名称|text
			$birth_complexion_array                = $this->_request->getParam('birth_complexion');
			$birth_complexion_str = '';
			foreach((array)$birth_complexion_array as $k=>$v){
				$val = array_code_change($v,$bb_f_births);
				$birth_complexion_str.=$val.'|';
			}
			$child_visits->birth_complexion        = rtrim($birth_complexion_str,'|');//出生情况|checkbox|1=>顺产,2=>头吸,3=>产钳,4=>剖产,5=>双多胎,6=>臀位,7=>其它
			$child_visits->birth_complexion_other  = $this->_request->getParam('birth_complexion_other');//出生情况其它|text
			$child_visits->sleepy_baby             = array_code_change($this->_request->getParam('sleepy_baby'),$bb_f_asphyxia);//新生儿窒息|radio|1=>无,2=>有
			$child_visits->sleepy_baby_info        = $this->_request->getParam('sleepy_baby_info');//新生儿窒息情况|text
			$child_visits->apgar_score             = array_code_change($this->_request->getParam('apgar'),$children_apgar);//新生儿apgar评分 1=>1分钟2=>5分钟3=>不详
			$child_visits->deformity               = array_code_change($this->_request->getParam('deformity'),$bb_f_abnormal);//是否有畸形|radio|1=>无,2=>有
			$child_visits->deformity_info          = $this->_request->getParam('deformity_info');//畸形情况|text
			$child_visits->hearing_screening       = array_code_change($this->_request->getParam('hearing_screening'),$bb_f_hearing);//新生儿听力筛查|radio|1=>通过,2=>未通过,3=>未筛查
			$child_visits->neonatal_screening      = array_code_change($this->_request->getParam('neonatal_new'),$neonatal_screening);//新生儿疾病筛查1、甲低 2、苯丙酮尿症 3、其他遗传代谢病
			$child_visits->neonatal_screening_other= $this->_request->getParam('neonatal_bottom');//新生儿疾病筛查其他遗传病
			$child_visits->weight                  = $this->_request->getParam('weight');//新生儿出生体重kg|text
			$child_visits->current_weight          = $this->_request->getParam('current_weight');//新生儿目前体重
			$child_visits->height                  = $this->_request->getParam('height');//出生身高cm|text
			$child_visits->breast_milk             = array_code_change($this->_request->getParam('breast_milk'),$bb_f_feeding);//喂养方式|radio|1=>纯母乳,2=>混合,3=>人工
			$child_visits->feeding_amount          = $this->_request->getParam('feeding_amount');//新生儿吃奶量
			$child_visits->feeding_times           = $this->_request->getParam('feeding_times');//新生儿吃奶次数
			$child_visits->vomit                   = array_code_change($this->_request->getParam('vomit_new'),$children_vomit);//新生儿呕吐
			$child_visits->defecate                = array_code_change($this->_request->getParam('defecate_new'),$children_defecate);//新生儿大便
			$child_visits->stool_frequency         = $this->_request->getParam('stool_frequency');//新生儿大便次数
			$child_visits->body_temperature        = $this->_request->getParam('body_temperature');//体温|text
			$child_visits->respiratory_rate        = $this->_request->getParam('respiratory_rate');//呼吸频率|text
			$child_visits->pulses                  = $this->_request->getParam('pulses');//脉率|text
			$complexion_array                      = $this->_request->getParam('complexion');
			$complexion_str ='';
			foreach((array)$complexion_array as $k=>$v){
				$val = array_code_change($v,$bb_f_complexion);
				$complexion_str.=$val.'|';
			}
			$child_visits->complexion              = rtrim($complexion_str,'|');//面色|checkbox|1=>红润,2=>黄染,3=>其它
			$child_visits->complexion_other        = $this->_request->getParam('complexion_other');//面色其它|text
			$child_visits->jaundice_site           = array_code_change($this->_request->getParam('jaundice_new'),$children_jaundice);//新生儿黄疸部位
			$child_visits->bregma_width            = $this->_request->getParam('bregma_width');//前囟宽|text
			$child_visits->bregma_height           = $this->_request->getParam('bregma_height');//前囟高|text
			$child_visits->bregma                  = array_code_change($this->_request->getParam('bregma'),$bb_f_fontanel);//前囟|radio|1=>正常,2=>膨隆,3=>凹陷,4=>其它
			$child_visits->bregma_other            = $this->_request->getParam('bregma_other');//前囟其它|text
			$child_visits->eye                     = array_code_change($this->_request->getParam('eye'),$bb_exception);//眼|radio|1=>未见异常,2=>异常
			$child_visits->eye_info                = $this->_request->getParam('eye_info');//眼异常
			$child_visits->limb                    = array_code_change($this->_request->getParam('limb'),$bb_exception);//四肢活动度|radio|1=>未见异常,2=>异常
			$child_visits->limb_info               = $this->_request->getParam('limb_info');//四肢活动度异常
			$child_visits->ear                     = array_code_change($this->_request->getParam('ear'),$bb_exception);//耳|radio|1=>未见异常,2=>异常
			$child_visits->ear_info                = $this->_request->getParam('ear_info');//耳异常
			$child_visits->cervical_mass           = array_code_change($this->_request->getParam('cervical_mass'),$bb_f_neckmass);//颈部包块|radio|1=>无,2=>有
			$child_visits->cervical_mass_info      = $this->_request->getParam('cervical_mass_info');//颈部包块
			$child_visits->nose                    = array_code_change($this->_request->getParam('nose'),$bb_exception);//鼻|radio|1=>未见异常,2=>异常
			$child_visits->nose_info               = $this->_request->getParam('nose_info');//鼻异常
			$skin_array                            = $this->_request->getParam('skin');
			$skin_str = '';
			foreach((array)$skin_array as $k=>$v){
				$val = array_code_change($v,$bb_f_skin);
				$skin_str.=$val.'|';
			}
			$child_visits->skin                    = rtrim($skin_str,'|');//皮肤|checkbox|1=>未见异常,2=>湿疹,3=>糜烂,4=>其它
			$child_visits->skin_other              = $this->_request->getParam('skin_other');//皮肤其它
			$child_visits->oral_cavity             = array_code_change($this->_request->getParam('oral_cavity'),$bb_exception);//口腔|radio|1=>未见异常,2=>异常
			$child_visits->oral_cavity_info        = $this->_request->getParam('oral_cavity_info');//口腔异常
			$child_visits->gmzz                    = array_code_change($this->_request->getParam('gmzz'),$bb_exception);//肛门|radio|1=>未见异常,2=>异常
			$child_visits->gmzz_info               = $this->_request->getParam('gmzz_info');//肛门异常
			$child_visits->heart_lung              = array_code_change($this->_request->getParam('heart_lung'),$bb_exception);//心肺|radio|1=>未见异常,2=>异常
			$child_visits->heart_lung_info         = $this->_request->getParam('heart_lung_info');//心肺异常
			$child_visits->pudendum                = array_code_change($this->_request->getParam('pudendum'),$bb_exception);//外生殖器|radio|1=>未见异常,2=>异常
			$child_visits->pudendum_info           = $this->_request->getParam('pudendum_info');//外生殖器异常
			$child_visits->abdomen                 = array_code_change($this->_request->getParam('abdomen'),$bb_exception);//腹部|radio|1=>未见异常,2=>异常
			$child_visits->abdomen_info            = $this->_request->getParam('abdomen_info');//腹部异常
			$child_visits->rachis                  = array_code_change($this->_request->getParam('rachis'),$bb_exception);//脊柱|radio|1=>未见异常,2=>异常
			$child_visits->rachis_info             = $this->_request->getParam('rachis_info');//脊柱异常
			$child_visits->umbilical_cord          = array_code_change($this->_request->getParam('umbilical_cord'),$bb_f_cord);//脐带|radio|1=>未脱,2=>脱落,3=>脐部有渗出,4=>其它
			$child_visits->umbilical_cord_other    = $this->_request->getParam('umbilical_cord_other');//脐带其它
			$child_visits->referral_features       = array_code_change($this->_request->getParam('referral_features'),$bb_f_neckmass);//转诊|1=>无,2=>有
			$child_visits->reason                  = $this->_request->getParam('reason');//转诊原因
			$child_visits->agencies_departments    = $this->_request->getParam('agencies_departments');//转诊机构及科室
			$advising_array                        = $this->_request->getParam('advising');
			$advising_str = '';
			foreach((array)$advising_array as $k=>$v){
				$val = array_code_change($v,$bb_f_guide);
				$advising_str.=$val.'|';
			}
			$child_visits->advising                = rtrim($advising_str,'|');//指导|checkbox|1=>喂养指导,2=>母乳喂养,3=>护理指导,4=>疾病预防指导
			//处理本次随访日期
			$followup_time_year                    = $this->_request->getParam('followup_time_year');
			$followup_time_month                   = $this->_request->getParam('followup_time_month');
			$followup_time_day                     = $this->_request->getParam('followup_time_day');
			$realTime =   adodb_mktime(0,0,0,empty($followup_time_month)?adodb_date("n",$currentTime):(int)$followup_time_month,empty($followup_time_day)?adodb_date("j",$currentTime):(int)$followup_time_day,empty($followup_time_year)?adodb_date("Y",$currentTime):(int)$followup_time_year);
			$child_visits->followup_time           = $realTime;//本次随访日期
			$child_visits->next_followup_address   = $this->_request->getParam('next_followup_address');//下次随访地点
			//处理下次随访日期
			$next_followup_time_year               = $this->_request->getParam('next_followup_time_year');
			$next_followup_time_month              = $this->_request->getParam('next_followup_time_month');
			$next_followup_time_day                = $this->_request->getParam('next_followup_time_day');
			$next_realTime = adodb_mktime(0,0,0,empty($next_followup_time_month)?adodb_date("n",$currentTime):(int)$next_followup_time_month,empty($next_followup_time_day)?adodb_date("j",$currentTime):(int)$next_followup_time_day,empty($next_followup_time_year)?adodb_date("Y",$currentTime):(int)$next_followup_time_year);
			$child_visits->next_followup_time      = $next_realTime;//下次随访日期
			$child_visits->doctors_signature       = $this->_request->getParam('doctors_signature');//随访医生签名
			if($this->_request->getParam('ok')){
				if($child_visits->insert()){
					message("添加新生儿家庭访视记录成功",array("返回新生儿家庭访视列表"=>__BASEPATH.'children/newborn/list'));
				}
			}
		}else{
			//编辑时
			$child_visits_edit = new Tchild_visits();
			$child_visits_edit->whereAdd("uuid='$uuid'");
			$child_visits_edit->find(true);
			$ihaCore = new Tindividual_core();
			$ihaCore->whereAdd("uuid='$child_visits_edit->id'");
			$ihaCore->find(true);
			$this->view->invaluid                     = $ihaCore->standard_code_1;
			$this->view->name                         = $ihaCore->name;	
			$this->view->currentsex                   = $ihaCore->sex;
			$this->view->birthday                     = adodb_date("Y-m-d",$ihaCore->date_of_birth);
			$this->view->identity_number              = $ihaCore->identity_number;//身份证
			$this->view->address                      = $ihaCore->address;
			$this->view->father_name                  = $child_visits_edit->father_name;//父亲姓名
			$this->view->father_occupation            = $child_visits_edit->father_occupation;//父亲职业
			$this->view->father_phone                 = $child_visits_edit->father_phone;//父亲电话
			$this->view->father_birth                 = adodb_date("Y-m-d",$child_visits_edit->father_birth);//母亲生日
			$this->view->mum_name                     = $child_visits_edit->mum_name;//母亲姓名
			$this->view->mum_occupation               = $child_visits_edit->mum_occupation;//母亲职业
			$this->view->mum_phone                    = $child_visits_edit->mum_phone;//母亲电话
			$this->view->mum_birth                    = adodb_date("Y-m-d",$child_visits_edit->mum_birth);//母亲电话
			$this->view->gestational_week             = $child_visits_edit->gestational_week;//出生孕周|text
			$this->view->disease_pregnancy_edit       = array_search_for_other($child_visits_edit->disease_pregnancy,$bb_f_casesofmother);//母亲妊娠期患病疾病情况|radio|1=>糖尿病,2=>妊娠期高血压,3=>其它
			$this->view->disease_pregnancy_other_edit = $child_visits_edit->disease_pregnancy_other;//母亲妊娠期患病疾病情况其它|text
			$this->view->midwifery_name               = $child_visits_edit->midwifery_name;//助产机构名称|text
			$this->view->birth_complexion_other_edit  = $child_visits_edit->birth_complexion_other;//出生情况其他
			$birth_complexion_array    =   explode('|',$child_visits_edit->birth_complexion);
			$newbirth_str = '';
			foreach($birth_complexion_array as $k=>$v){
				$val = array_search_for_other($v,$bb_f_births);
				$newbirth_str.=$val.'|';
			}
			$this->view->birth_complexion_edit        = explode('|',rtrim($newbirth_str,'|'));//出生情况
			$this->view->sleepy_baby_edit             = array_search_for_other($child_visits_edit->sleepy_baby,$bb_f_asphyxia);//新生儿窒息
			$this->view->sleepy_baby_info_edit        = $child_visits_edit->sleepy_baby_info;//新生儿窒息情况
			$this->view->apgar_edit                   = array_search_for_other($child_visits_edit->apgar_score,$children_apgar);//新生儿apgar评分
			$this->view->deformity_edit               = array_search_for_other($child_visits_edit->deformity,$bb_f_abnormal);//是否有畸形|radio|1=>无,2=>有
			$this->view->deformity_info_edit          = $child_visits_edit->deformity_info;//畸形情况|text
			$this->view->hearing_screening_edit       = array_search_for_other($child_visits_edit->hearing_screening,$bb_f_hearing);//新生儿听力筛查
			$this->view->neonatal_new_edit            = array_search_for_other($child_visits_edit->neonatal_screening,$neonatal_screening);//新生儿疾病筛查情况
			$this->view->neonatal_bottom_edit         = $child_visits_edit->neonatal_screening_other;//新生儿疾病筛查遗传病
			$this->view->weight_edit                  = $child_visits_edit->weight;//新生儿出生体重kg|text
			$this->view->current_weight_edit          = $child_visits_edit->current_weight;//新生儿的当前体重
			$this->view->height_edit                  = $child_visits_edit->height;//出生身高cm|text
			$this->view->breast_milk_edit             = array_search_for_other($child_visits_edit->breast_milk,$bb_f_feeding);//喂养方式|radio|1=>纯母乳,2=>混合,3=>人工
			$this->view->feeding_amount_edit          = $child_visits_edit->feeding_amount;//新生儿吃奶量
			$this->view->feeding_times_edit           = $child_visits_edit->feeding_times;//新生儿吃奶次数
			$this->view->vomit_new_edit               = array_search_for_other($child_visits_edit->vomit,$children_vomit);//新生儿呕吐
			$this->view->defecate_new_edit            = array_search_for_other($child_visits_edit->defecate,$children_defecate);//新生儿大便
			$this->view->stool_frequency_edit         = $child_visits_edit->stool_frequency;//新生儿大便次数
			$this->view->body_temperature_edit        = $child_visits_edit->body_temperature;//体温|text
			$this->view->respiratory_rate_edit        = $child_visits_edit->respiratory_rate;//呼吸频率|text
			$this->view->pulses_edit                  = $child_visits_edit->pulses;//脉率|text
			$complexion_new_array  = explode('|',$child_visits_edit->complexion);
		    $newcomplexion_str = '';
			foreach($complexion_new_array as $k=>$v){
				$val = array_search_for_other($v,$bb_f_complexion);
				$newcomplexion_str.=$val.'|';
			}
			$this->view->complexion_edit              = explode('|',rtrim($newcomplexion_str,'|'));//面色|checkbox|1=>红润,2=>黄染,3=>其它
			$this->view->complexion_other_edit        = $child_visits_edit->complexion_other;//面色其它|text
			$this->view->jaundice_site_edit           = $child_visits_edit->jaundice_site;//新生儿黄疸部位
			$this->view->bregma_width_edit            = $child_visits_edit->bregma_width;//前囟宽|text
			$this->view->bregma_height_edit           = $child_visits_edit->bregma_height;//前囟高|text
			$this->view->bregma_edit                  = array_search_for_other($child_visits_edit->bregma,$bb_f_fontanel);//前囟|radio|1=>正常,2=>膨隆,3=>凹陷,4=>其它
			$this->view->bregma_other_edit            = $child_visits_edit->bregma_other;//前囟|radio|1=>正常,2=>膨隆,3=>凹陷,4=>其它
			$this->view->eye_edit                     = array_search_for_other($child_visits_edit->eye,$bb_exception);//眼|radio|1=>未见异常,2=>异常
			$this->view->eye_info_edit                = $child_visits_edit->eye_info;//眼异常
			$this->view->limb_edit                    = array_search_for_other($child_visits_edit->limb,$bb_exception);//四肢活动度|radio|1=>未见异常,2=>异常
			$this->view->limb_info_edit               = $child_visits_edit->limb_info;//四肢活动度异常
			$this->view->ear_edit                     = array_search_for_other($child_visits_edit->ear,$bb_exception);//耳|radio|1=>未见异常,2=>异常
			$this->view->ear_info_edit                = $child_visits_edit->ear_info;//耳异常
			$this->view->cervical_mass_edit           = array_search_for_other($child_visits_edit->cervical_mass,$bb_f_neckmass);//颈部包块|radio|1=>无,2=>有
			$this->view->cervical_mass_info_edit      = $child_visits_edit->cervical_mass_info;//颈部包块
			$this->view->nose_edit                    = array_search_for_other($child_visits_edit->nose,$bb_exception);//鼻|radio|1=>未见异常,2=>异常
			$this->view->nose_info_edit               = $child_visits_edit->nose_info;//鼻异常
			$skin_edit_array = explode('|',$child_visits_edit->skin);
			$skin_edit_str ='';
			foreach($skin_edit_array as $k=>$v){
				$val = array_search_for_other($v,$bb_f_skin);
				$skin_edit_str.=$val.'|';
			}
			$this->view->skin_edit                    = explode('|',rtrim($skin_edit_str,'|'));//皮肤
			$this->view->skin_other_edit              = $child_visits_edit->skin_other;//皮肤其它
			$this->view->oral_cavity_edit             = array_search_for_other($child_visits_edit->oral_cavity,$bb_exception);//口腔|radio|1=>未见异常,2=>异常
			$this->view->oral_cavity_info_edit        = $child_visits_edit->oral_cavity_info;//口腔异常
			$this->view->gmzz_edit                    = array_search_for_other($child_visits_edit->gmzz,$bb_exception);//肛门|radio|1=>未见异常,2=>异常
			$this->view->gmzz_info_edit               = $child_visits_edit->gmzz_info;//肛门异常
			$this->view->heart_lung_edit              = array_search_for_other($child_visits_edit->heart_lung,$bb_exception);//心肺|radio|1=>未见异常,2=>异常
			$this->view->heart_lung_info_edit         = $child_visits_edit->heart_lung_info;//心肺异常
			$this->view->pudendum_edit                = array_search_for_other($child_visits_edit->pudendum,$bb_exception);//外生殖器|radio|1=>未见异常,2=>异常
			$this->view->pudendum_info_edit           = $child_visits_edit->pudendum_info;//外生殖器异常
			$this->view->abdomen_edit                 = array_search_for_other($child_visits_edit->abdomen,$bb_exception);//腹部|radio|1=>未见异常,2=>异常
			$this->view->abdomen_info_edit            = $child_visits_edit->abdomen_info;//腹部异常
			$this->view->rachis_edit                  = array_search_for_other($child_visits_edit->rachis,$bb_exception);//脊柱|radio|1=>未见异常,2=>异常
			$this->view->rachis_info_edit             = $child_visits_edit->rachis_info;//脊柱异常
			$this->view->umbilical_cord_edit          = array_search_for_other($child_visits_edit->umbilical_cord,$bb_f_cord);//脐带|radio|1=>未脱,2=>脱落,3=>脐部有渗出,4=>其它
			$this->view->umbilical_cord_other_edit    = $child_visits_edit->umbilical_cord_other;//脐带其它
			$this->view->referral_features_edit       = array_search_for_other($child_visits_edit->referral_features,$bb_f_neckmass);//转诊|1=>无,2=>有
			$this->view->reason_edit                  = $child_visits_edit->reason;//转诊原因
			$this->view->agencies_departments_edit    = $child_visits_edit->agencies_departments;//转诊机构及科室
		    $advising_edit_array = explode('|',$child_visits_edit->advising);
			$advising_edit_str ='';
			foreach($advising_edit_array as $k=>$v){
				$val = array_search_for_other($v,$bb_f_guide);
				$advising_edit_str.=$val.'|';
			}
			$this->view->advising_edit                = explode('|',rtrim($advising_edit_str,'|'));//指导
			$nowTime      = adodb_date("Y-m-d",$child_visits_edit->followup_time);//本次随访时间
			$nowTimeArray = explode('-',$nowTime);
			$this->view->followup_time_edit_y         = $nowTimeArray[0];
			$this->view->followup_time_edit_m         = $nowTimeArray[1];
			$this->view->followup_time_edit_d         = $nowTimeArray[2];
			$this->view->next_followup_address_edit   = $child_visits_edit->next_followup_address;//下次随访地点
			$nextTime      = adodb_date("Y-m-d",$child_visits_edit->next_followup_time);// 下次随访时间
			$nextTimeArray = explode('-',$nextTime);
			$this->view->next_followup_time_edit_y         = $nextTimeArray[0];
			$this->view->next_followup_time_edit_m         = $nextTimeArray[1];
			$this->view->next_followup_time_edit_d         = $nextTimeArray[2];
			$this->view->doctors_signature_edit       = $child_visits_edit->doctors_signature;//随访医生签名
			//写入数据表中
			$child_visits = new Tchild_visits();
			$child_visits->whereAdd("uuid='$uuid'");
			$currentTime = time();			
			$child_visits->created                 = adodb_mktime(0,0,0,adodb_date("n",$currentTime),adodb_date("j",$currentTime),adodb_date("Y",$currentTime));//添加记录时
			$child_visits->father_name             = $this->_request->getParam('father_name');//父亲姓名|text
			$child_visits->father_occupation       = $this->_request->getParam('father_occupation');//父亲职业|text
			$child_visits->father_phone            = $this->_request->getParam('father_phone');//父亲电话|text
			if($this->_request->getParam('father_birth')){
				$father_birth_str   =  $this->_request->getParam('father_birth');
				$father_birth_array =  explode('-',$father_birth_str);
				$father_birth_real  =  adodb_mktime(0,0,0,$father_birth_array[1],$father_birth_array[2],$father_birth_array[0]);
				$child_visits->father_birth            = $father_birth_real;//父亲出生日期|text
			}
			//echo $father_birth_real;
			$child_visits->mum_name                = $this->_request->getParam('mum_name');//母亲姓名|text
			$child_visits->mum_occupation          = $this->_request->getParam('mum_occupation');//母亲职业|text
			$child_visits->mum_phone               = $this->_request->getParam('mum_phone');//母亲电话|text
		   if($this->_request->getParam('mum_birth')){
				$mum_birth_str   =  $this->_request->getParam('mum_birth');
				$mum_birth_array =  explode('-',$mum_birth_str);
				$mum_birth_real  =  adodb_mktime(0,0,0,$mum_birth_array[1],$mum_birth_array[2],$mum_birth_array[0]);
				$child_visits->mum_birth            = $mum_birth_real;//母亲出生日期|text
			}
			$child_visits->gestational_week        = $this->_request->getParam('gestational_week');//出生孕周|text
			$child_visits->disease_pregnancy       = array_code_change($this->_request->getParam('disease_pregnancy'),$bb_f_casesofmother);//母亲妊娠期患病疾病情况|radio|1=>糖尿病,2=>妊娠期高血压,3=>其它
			$child_visits->disease_pregnancy_other = $this->_request->getParam('disease_pregnancy_other');//母亲妊娠期患病疾病情况其它|text
			$child_visits->midwifery_name          = $this->_request->getParam('midwifery_name');//助产机构名称|text
			$birth_complexion_array                = $this->_request->getParam('birth_complexion');
			$birth_complexion_str = '';
			foreach((array)$birth_complexion_array as $k=>$v){
				$val = array_code_change($v,$bb_f_births);
				$birth_complexion_str.=$val.'|';
			}
			$child_visits->birth_complexion        = rtrim($birth_complexion_str,'|');//出生情况|checkbox|1=>顺产,2=>头吸,3=>产钳,4=>剖产,5=>双多胎,6=>臀位,7=>其它
			$child_visits->birth_complexion_other  = $this->_request->getParam('birth_complexion_other');//出生情况其它|text
			$child_visits->sleepy_baby             = array_code_change($this->_request->getParam('sleepy_baby'),$bb_f_asphyxia);//新生儿窒息|radio|1=>无,2=>有
			$child_visits->sleepy_baby_info        = $this->_request->getParam('sleepy_baby_info');//新生儿窒息情况|text
			$child_visits->apgar_score             = array_code_change($this->_request->getParam('apgar'),$children_apgar);//新生儿apgar评分 1=>1分钟2=>5分钟3=>不详
			$child_visits->deformity               = array_code_change($this->_request->getParam('deformity'),$bb_f_abnormal);//是否有畸形|radio|1=>无,2=>有
			$child_visits->deformity_info          = $this->_request->getParam('deformity_info');//畸形情况|text
			$child_visits->hearing_screening       = array_code_change($this->_request->getParam('hearing_screening'),$bb_f_hearing);//新生儿听力筛查|radio|1=>通过,2=>未通过,3=>未筛查
			$child_visits->neonatal_screening      = array_code_change($this->_request->getParam('neonatal_new'),$neonatal_screening);//新生儿疾病筛查1、甲低 2、苯丙酮尿症 3、其他遗传代谢病
			$child_visits->neonatal_screening_other= $this->_request->getParam('neonatal_bottom');//新生儿疾病筛查其他遗传病
			$child_visits->weight                  = $this->_request->getParam('weight');//新生儿出生体重kg|text
			$child_visits->current_weight          = $this->_request->getParam('current_weight');//新生儿目前体重
			$child_visits->height                  = $this->_request->getParam('height');//出生身高cm|text
			$child_visits->breast_milk             = array_code_change($this->_request->getParam('breast_milk'),$bb_f_feeding);//喂养方式|radio|1=>纯母乳,2=>混合,3=>人工
			$child_visits->feeding_amount          = $this->_request->getParam('feeding_amount');//新生儿吃奶量
			$child_visits->feeding_times           = $this->_request->getParam('feeding_times');//新生儿吃奶次数
			$child_visits->body_temperature        = $this->_request->getParam('body_temperature');//体温|text
			$child_visits->vomit                   = array_code_change($this->_request->getParam('vomit_new'),$children_vomit);//新生儿呕吐
			$child_visits->defecate                = array_code_change($this->_request->getParam('defecate_new'),$children_defecate);//新生儿大便
			$child_visits->stool_frequency         = $this->_request->getParam('stool_frequency');//新生儿大便次数
			$child_visits->respiratory_rate        = $this->_request->getParam('respiratory_rate');//呼吸频率|text
			$child_visits->pulses                  = $this->_request->getParam('pulses');//脉率|text
			$complexion_array                      = $this->_request->getParam('complexion');
			$complexion_str ='';
			foreach((array)$complexion_array as $k=>$v){
				$val = array_code_change($v,$bb_f_complexion);
				$complexion_str.=$val.'|';
			}
			$child_visits->complexion              = rtrim($complexion_str,'|');//面色|checkbox|1=>红润,2=>黄染,3=>其它
			$child_visits->complexion_other        = $this->_request->getParam('complexion_other');//面色其它|text
			$child_visits->jaundice_site           = array_code_change($this->_request->getParam('jaundice_new'),$children_jaundice);//新生儿黄疸部位
			$child_visits->bregma_width            = $this->_request->getParam('bregma_width');//前囟宽|text
			$child_visits->bregma_height           = $this->_request->getParam('bregma_height');//前囟高|text
			$child_visits->bregma                  = array_code_change($this->_request->getParam('bregma'),$bb_f_fontanel);//前囟|radio|1=>正常,2=>膨隆,3=>凹陷,4=>其它
			$child_visits->bregma_other            = $this->_request->getParam('bregma_other');//前囟其它|text
			$child_visits->eye                     = array_code_change($this->_request->getParam('eye'),$bb_exception);//眼|radio|1=>未见异常,2=>异常
			$child_visits->eye_info                = $this->_request->getParam('eye_info');//眼异常
			$child_visits->limb                    = array_code_change($this->_request->getParam('limb'),$bb_exception);//四肢活动度|radio|1=>未见异常,2=>异常
			$child_visits->limb_info               = $this->_request->getParam('limb_info');//四肢活动度异常
			$child_visits->ear                     = array_code_change($this->_request->getParam('ear'),$bb_exception);//耳|radio|1=>未见异常,2=>异常
			$child_visits->ear_info                = $this->_request->getParam('ear_info');//耳异常
			$child_visits->cervical_mass           = array_code_change($this->_request->getParam('cervical_mass'),$bb_f_neckmass);//颈部包块|radio|1=>无,2=>有
			$child_visits->cervical_mass_info      = $this->_request->getParam('cervical_mass_info');//颈部包块
			$child_visits->nose                    = array_code_change($this->_request->getParam('nose'),$bb_exception);//鼻|radio|1=>未见异常,2=>异常
			$child_visits->nose_info               = $this->_request->getParam('nose_info');//鼻异常
			$skin_array                            = $this->_request->getParam('skin');
			$skin_str = '';
			foreach((array)$skin_array as $k=>$v){
				$val = array_code_change($v,$bb_f_skin);
				$skin_str.=$val.'|';
			}
			$child_visits->skin                    = rtrim($skin_str,'|');//皮肤|checkbox|1=>未见异常,2=>湿疹,3=>糜烂,4=>其它
			$child_visits->skin_other              = $this->_request->getParam('skin_other');//皮肤其它
			$child_visits->oral_cavity             = array_code_change($this->_request->getParam('oral_cavity'),$bb_exception);//口腔|radio|1=>未见异常,2=>异常
			$child_visits->oral_cavity_info        = $this->_request->getParam('oral_cavity_info');//口腔异常
			$child_visits->gmzz                    = array_code_change($this->_request->getParam('gmzz'),$bb_exception);//肛门|radio|1=>未见异常,2=>异常
			$child_visits->gmzz_info               = $this->_request->getParam('gmzz_info');//肛门异常
			$child_visits->heart_lung              = array_code_change($this->_request->getParam('heart_lung'),$bb_exception);//心肺|radio|1=>未见异常,2=>异常
			$child_visits->heart_lung_info         = $this->_request->getParam('heart_lung_info');//心肺异常
			$child_visits->pudendum                = array_code_change($this->_request->getParam('pudendum'),$bb_exception);//外生殖器|radio|1=>未见异常,2=>异常
			$child_visits->pudendum_info           = $this->_request->getParam('pudendum_info');//外生殖器异常
			$child_visits->abdomen                 = array_code_change($this->_request->getParam('abdomen'),$bb_exception);//腹部|radio|1=>未见异常,2=>异常
			$child_visits->abdomen_info            = $this->_request->getParam('abdomen_info');//腹部异常
			$child_visits->rachis                  = array_code_change($this->_request->getParam('rachis'),$bb_exception);//脊柱|radio|1=>未见异常,2=>异常
			$child_visits->rachis_info             = $this->_request->getParam('rachis_info');//脊柱异常
			$child_visits->umbilical_cord          = array_code_change($this->_request->getParam('umbilical_cord'),$bb_f_cord);//脐带|radio|1=>未脱,2=>脱落,3=>脐部有渗出,4=>其它
			$child_visits->umbilical_cord_other    = $this->_request->getParam('umbilical_cord_other');//脐带其它
			$child_visits->referral_features       = array_code_change($this->_request->getParam('referral_features'),$bb_f_neckmass);//转诊|1=>无,2=>有
			$child_visits->reason                  = $this->_request->getParam('reason');//转诊原因
			$child_visits->agencies_departments    = $this->_request->getParam('agencies_departments');//转诊机构及科室
			$advising_array                        = $this->_request->getParam('advising');
			$advising_str = '';
			foreach((array)$advising_array as $k=>$v){
				$val = array_code_change($v,$bb_f_guide);
				$advising_str.=$val.'|';
			}
			$child_visits->advising                = rtrim($advising_str,'|');//指导|checkbox|1=>喂养指导,2=>母乳喂养,3=>护理指导,4=>疾病预防指导
			//处理本次随访日期
			$followup_time_year                    = $this->_request->getParam('followup_time_year');
			$followup_time_month                   = $this->_request->getParam('followup_time_month');
			$followup_time_day                     = $this->_request->getParam('followup_time_day');
			$realTime =   adodb_mktime(0,0,0,empty($followup_time_month)?adodb_date("n",$currentTime):(int)$followup_time_month,empty($followup_time_day)?adodb_date("j",$currentTime):(int)$followup_time_day,empty($followup_time_year)?adodb_date("Y",$currentTime):(int)$followup_time_year);
			$child_visits->followup_time           = $realTime;//本次随访日期
			$child_visits->next_followup_address   = $this->_request->getParam('next_followup_address');//下次随访地点
			//处理下次随访日期
			$next_followup_time_year               = $this->_request->getParam('next_followup_time_year');
			$next_followup_time_month              = $this->_request->getParam('next_followup_time_month');
			$next_followup_time_day                = $this->_request->getParam('next_followup_time_day');
			$next_realTime = adodb_mktime(0,0,0,empty($next_followup_time_month)?adodb_date("n",$currentTime):(int)$next_followup_time_month,empty($next_followup_time_day)?adodb_date("j",$currentTime):(int)$next_followup_time_day,empty($next_followup_time_year)?adodb_date("Y",$currentTime):(int)$next_followup_time_year);
			$child_visits->next_followup_time      = $next_realTime;//下次随访日期
			$child_visits->doctors_signature       = $this->_request->getParam('doctors_signature');//随访医生签名
			if($this->_request->getParam('edit')){
				if($child_visits->update()){
					message("数据更新成功！",array("返回新生儿家庭访视列表"=>__BASEPATH.'children/newborn/list/page/'.$this->_request->getParam('currentpage'),"返回新生儿家庭访视添加页面"=>__BASEPATH.'children/newborn/index'));
				}
			}
		}
		$this->view->assign( "basePath", __BASEPATH );
		$this->view->edituuid    = $uuid;
		$this->view->display('add.html');
	}
	/**
	 * 新生儿家庭访视列表
	 * 2010.11.4
	 */
	public function listAction(){
		//echo adodb_mktime(0,0,0,"12","7","1923");
		//echo adodb_date("Y-m-d","-1453881600");
		$staffList                  =  region_users($this->user['current_region_path_domain']);//医生列表
//		$region_path                =  $this->user['current_region_path'];

		$this->view->realstafflist  =  $staffList;
		$this->view->currentstaffid        = $this->user['uuid'];//当前的医生ID
		$this->view->currentstaffname_real = $this->user['name_real'];//当前的医生名字
		$username           = $this->_request->getParam('username');
		$standard_code      = $this->_request->getParam('standard_code');
		$identity_number    = $this->_request->getParam('identity_number');
		$staff_id           = $this->_request->getParam('staff_id');
		$sc                 = $this->_request->getParam('sc');
		$search             = $this->_request->getParam('search');
		//2013-5-21
		$display = $this->_request->getParam('display');//显示状态
		$created_start_time = $this->_request->getParam('created_start_time');//开始时间
		$created_end_time = $this->_request->getParam('created_end_time');//结束时间
		$org_id = $this->_request->getParam('region_p_id')?$this->_request->getParam('region_p_id'):$this->user['region_id'];//机构id
		$individual_core_region_path_domain = get_region_path(1, $org_id);

		$child_visits     = new Tchild_visits();
		$individual_core  = new Tindividual_core();
		$child_visits->joinAdd('left',$child_visits,$individual_core,'id','uuid');
	    if($search){
		    	if($staff_id!='-9'){
				    $child_visits->whereAdd("child_visits.doctors_signature='$staff_id'");
		    	}
		    	if($identity_number){
		    		$child_visits->whereAdd("individual_core.identity_number='$identity_number'");
		    	}
		    	if($standard_code){
		    		$child_visits->whereAdd("individual_core.standard_code_1='$standard_code'");
		    	}
		       if($username){
		    		$child_visits->whereAdd("individual_core.name  like '$username%' or individual_core.name_pinyin like '$username%'");
		    	}
		    	//开始时间查询
				if($created_start_time){
					$created_start_time_1=strtotime($created_start_time);
					$child_visits->whereAdd("child_visits.followup_time>='{$created_start_time_1}'");
				}		
				//结束时间查询
				if($created_end_time){
					$created_end_time_1=strtotime($created_end_time);
					$child_visits->whereAdd("child_visits.followup_time<='{$created_end_time_1}'");
				}	
		    	if($sc!=='-9')
		    	{
		    		switch ($sc)
		    		{
		    			case '1':
		    				$child_visits->whereAdd("child_visits.neonatal_screening is not null");
		    				break;
		    			case '2':
		    				$child_visits->whereAdd("child_visits.deformity='2'");
		    				break;
		    		}
		    	}	
		}
		$child_visits->whereAdd($individual_core_region_path_domain);
//		$child_visits->debugLevel(9);
//		$child_visits->count();
//		exit();
		$numCount = $child_visits->count("distinct child_visits.id");
		$pageCurrent = intval($this->_request->getParam('page'));
		$arrArg = array('username'=>$username,'standard_code'=>$standard_code,'identity_number'=>$identity_number,'staff_id'=>$staff_id,'sc'=>$sc,'region_p_id'=>$org_id,'created_start_time'=>$created_start_time,'created_end_time'=>$created_end_time,'display'=>$display,'search'=>$search);
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$numCount,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'children/newborn/list/page/',3,$arrArg);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
	    $child_visitslist     = new Tchild_visits();
		$individual_corelist  = new Tindividual_core();
		$child_visitslist->joinAdd('left',$child_visitslist,$individual_corelist,'id','uuid'); 
	    if($search){
	    	if($staff_id!='-9'){
			    $child_visitslist->whereAdd("child_visits.doctors_signature='$staff_id'");
	    	}
	    	if($identity_number){
	    		$child_visitslist->whereAdd("individual_core.identity_number='$identity_number'");
	    	}
	    	if($standard_code){
	    		$child_visitslist->whereAdd("individual_core.standard_code_1='$standard_code'");
	    	}
	       if($username){
	    		$child_visitslist->whereAdd("individual_core.name  like '$username%' or individual_core.name_pinyin like '$username%'");
	    	}
	    	//开始时间查询
			if($created_start_time){
				$created_start_time_2=strtotime($created_start_time);
				$child_visitslist->whereAdd("child_visits.followup_time>='{$created_start_time_2}'");
			}			
			//结束时间查询
			if($created_end_time){
				$created_end_time_2=strtotime($created_end_time);
				$child_visitslist->whereAdd("child_visits.followup_time<='{$created_end_time_2}'");
			}	
	    	if($sc!=='-9')
	    	{   		
	    		switch ($sc)
	    		{
	    			case '1':
	    				$child_visitslist->whereAdd("child_visits.neonatal_screening is not null");
	    				break;
	    			case '2':
	    				$child_visitslist->whereAdd("child_visits.deformity='2'");
	    				break;
	    		}
	    	}	
		}
		$child_visitslist->whereAdd($individual_core_region_path_domain);
		//$child_visitslist->orderby("child_visits.created DESC");
		$child_visitslist->selectAdd("distinct child_visits.id");	
		$child_visitslist->limit($startnum,__ROWSOFPAGE);
//		$child_visitslist->debugLevel(9);
		$child_visitslist->find();
		$arrcount = 0;
		$list     = array();
		while($child_visitslist->fetch()){
			$list[$arrcount]['name']           =  $individual_corelist->name;
			$list[$arrcount]['id']             =  $child_visitslist->id;
			$arrcount++;
		}
		foreach((array)$list as $k=>$v){ 
			$currentid = $v['id'];
			$content = new Tchild_visits();
			$content->whereAdd("id='$currentid'");
			$content->orderby("followup_time ASC");
			$content->find();
			$newcount = 0;
			while($content->fetch()){
			  $list[$k]['list'][$newcount]['uuid'] =  $content->uuid;
			  $list[$k]['list'][$newcount]['followup_time'] =  date("Y-m-d",$content->followup_time);
			  $newcount++;
			}
			$content->free_statement();
		}
		$this->view->list    = $list;
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->currentpage  = $pageCurrent;
		$this->view->assign( "basePath", __BASEPATH );
		//2013-5-21
        $this->view->assign('region_p_id', $org_id);//地区
        if($created_start_time!=''){
        	$this->view->assign('created_start_time', $created_start_time);//时间段开始
        }
        if($created_end_time!=''){
        	$this->view->assign('created_end_time',$created_end_time);//时间段结束
        }
        $this->view->assign("display",$display);
        
		$child_visitslist->free_statement();
		$child_visits->free_statement();
		$this->view->display("list.html");
	}
	/*
	 * 删除数据
	 * 2010.11.4
	 */
	public function delAction(){
		$uuid = $this->_request->getParam('delid');
		if($uuid){
			$child_visits = new Tchild_visits();
			$child_visits->whereAdd("uuid='$uuid'");
			if($child_visits->delete()){
			  message("删除成功！",array("返回新生儿家庭访视列表"=>__BASEPATH.'children/newborn/list',"返回新生儿家庭访视添加页面"=>__BASEPATH.'children/newborn/index'));	 
			}
		}else{
			message("删除失败,参数不合法！",array("返回新生儿家庭访视列表"=>__BASEPATH.'children/newborn/list'));
		}
	}
}
?>