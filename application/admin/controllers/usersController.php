<?php
/**
 * 用户管理
 *
 */

class admin_usersController extends controller {

	public function init()
	{
		$this->view->basePath = $this->_request->getBasePath();
		//用户认证与权限
		require_once(__SITEROOT.'library/privilege.php');
		//require_once(__SITEROOT.'library/MyAcl.php');
		//$this->acl=MyAcl::getInstance()->getAcl() ;
		require_once(__SITEROOT.'library/Models/staff_core.php');//用户核心表
		require_once(__SITEROOT.'library/Models/staff_archive.php');//用户扩展表
		require_once(__SITEROOT."library/Models/individual_core.php");//居民核心表
		require_once(__SITEROOT.'library/Models/organization.php');//机构表
		require_once(__SITEROOT."application/admin/models/getRoles.php");//取得角色
		require_once(__SITEROOT."library/custom/adodb-time.inc.php");//日期处理类


	}
	public function indexAction(){
		//var_dump($this->user);

		$org_id=$this->_request->getParam("org_id",'');
		$region_id=$this->_request->getParam("region_id",'');


		if(!empty($org_id)){
			//---根据机构ID验证数据---start
			$organization=new Torganization();
			$organization->whereAdd("id={$org_id}");
			//$organization->debugLevel(9);
			$organization->find();
			$count=0;
			while ($organization->fetch()) {
				$this->view->org_name=$organization->zh_name;//机构名
				$this->view->url_org_name=urlencode($organization->zh_name);//url编码后的机构名
				$this->view->org_id=$organization->id;//机构ID
				$this->view->region_id=$region_id;//地区id
				$this->view->region_path=$organization->region_path;//所属区域
				$count++;
			}
			//输出异常
			if($count<1){
				throw new Exception("参数错误!");
			}
			//-----根据机构ID验证数据----end
			require_once(__SITEROOT.'library/custom/pager.php');
			//用户列表
			$staff_core		=	new Tstaff_core();
			$staff_archive	=	new Tstaff_archive();
			$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
			$staff_core->whereAdd("org_id={$org_id}");
			$nums=$staff_core->count();
			//$staff_core->debugLevel(9);
			
			$staff_core		=	new Tstaff_core();
			$staff_archive	=	new Tstaff_archive();
			$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
			$staff_core->whereAdd("org_id={$org_id}");
			$staff_core->orderby("standard_code ASC");
			
			$page_size=10;    //每页显示的条数
			$sub_pages=8;          //每次显示的页数
			$pageCurrent=$this->_request->getParam('page');
			$links=new SubPages($page_size,$nums,$pageCurrent,$sub_pages,$this->_request->getBasePath().$this->getModuleName().'/'.$this->getControllerName().'/'.$this->getActionName().'/org_id/'.$org_id.'/region_id/'.$region_id.'/page/',2,array());
			$pageCurrent=$links->check_page($pageCurrent);//检查当前页数是否合法
			$startnum=$page_size*($pageCurrent-1);  //计算开始记录数
			$staff_core->limit($startnum,$page_size);
			$staff_core->find();
			$row=array();
			$record_count=0;//记录数;
			while ($staff_core->fetch()) {
				$row[$record_count]['id']			=	$staff_core->id;//id
				$row[$record_count]['standard_code']=	$staff_core->standard_code;//standard_code
				$row[$record_count]['name_login']	=	$staff_core->name_login;//登录名
				$roles_arr							=	getRoles($staff_core->role_id);//取得角色数组
				$role								=	$roles_arr[0]['role_zh_name'];//得到角色中文名
				$row[$record_count]['role_name']	=	$role;//角色名 
                $row[$record_count]['role_id']      =   $staff_core->role_id=='14c29a32c28c09'?1:0;
                $row[$record_count]['user_id']      =   $staff_archive->id;
				$record_count++;
			}
            
			//print_r($row);
			$this->view->record_count=$record_count;//记录数
			$this->view->row=$row;
			$out=$links->subPageCss2(); //获取显示样式，$out在smarty中将输出如下：
			$this->view->out=$out;//显示分页
			$this->view->pageCurrent=$pageCurrent;//当前页
			$this->view->go_back=$this->_request->getParam("go_back",'');//返回标识 是否出现到机构的链接
			$this->view->display("users_list.html");
		}

	}
	/**
	 * 添加/编辑 页面
	 *
	 */
	public function addAction(){
		$org_id=$this->_request->getParam("org_id",'');//机构名
		$org_name=$this->_request->getParam("org_name",'');//机构id
		$region_id=$this->_request->getParam("region_id",'');//地区ID
		$id=$this->_request->getParam("id",'');//记录ID
		$region_path=$this->_request->getParam("region_path",'');//所属机构


		$staff_core=new Tstaff_core();
		$staff_archive=new Tstaff_archive();
		$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
		$staff_core->whereAdd("staff_core.id='{$id}'");
		//$staff_core->debugLevel(4);
		$staff_core->find();
		$staff_core->fetch();

		$this->view->id = $staff_core->id;
		$this->view->standard_code = $staff_core->standard_code;
		$this->view->name_login = $staff_core->name_login;
		$this->view->passwd = $staff_core->passwd;
		$this->view->region_id = $staff_core->region_id;
		$this->view->org_id = $staff_core->org_id;
		$this->view->role_id = $staff_core->role_id;

		$this->view->user_id = $staff_archive->user_id;
		$this->view->name_real = $staff_archive->name_real;
		/**
		 * 表注释:科室ID|select|1=>预防保健科,2=>全科医疗科,3=>药房,4=>检验室,5=>X光室,6=>B超室,7=>心电图室,8=>消毒供应室,9=>信息资料室,10=>其它
		 * 
		 * 
		 **/
		$section_office_id=array('1'=>'预防保健科','2'=>'全科医疗科','3'=>'药房','4'=>'检验室','5'=>'X光室','6'=>'B超室','7'=>'心电图室','8'=>'消毒供应室','9'=>'信息资料室','10'=>'其它');
		$this->view->section_office_id_options =$section_office_id; //科室ID|select|1=>预防保健科,2=>全科医疗科,3=>药房,4=>检验室,5=>X光室,6=>B超室,7=>心电图室,8=>消毒供应室,9=>信息资料室,10=>其它
		$this->view->section_office_id_current = $staff_archive->section_office_id;
		/**
		 * 表注释:删除标记|null|0=>未正常保持,1=>正常,2=>删除
		 * 
		 * 
		 **/
		$status_flag=array('0'=>'未正常保持','1'=>'正常','2'=>'删除');
		$this->view->status_flag_options =$status_flag; //删除标记|null|0=>未正常保持,1=>正常,2=>删除
		$this->view->status_flag_current = $staff_archive->status_flag;
		$this->view->identity_card_number = $staff_archive->identity_card_number;
		/**
		 * 表注释:性别|radio|1=>男,2=>女
		 * 
		 * 
		 **/
		$sex=array('1'=>'男','2'=>'女');
		$this->view->sex_options =$sex; //性别|radio|1=>男,2=>女
		$this->view->sex_current = $staff_archive->sex;

		$this->view->date_of_birth =empty($staff_archive->date_of_birth)?"":adodb_date("Y-m-d",$staff_archive->date_of_birth);

		/**
		 * 表注释:职称|select|1=>正高,2=>副高,3=>中级,4=>助理（师级）,5=>员（士）,6=>待聘
		 * 
		 * 
		 **/
		$title=array('1'=>'正高','2'=>'副高','3'=>'中级','4'=>'助理（师级）','5'=>'员（士）','6'=>'待聘');
		$this->view->title_options =$title; //职称|select|1=>正高,2=>副高,3=>中级,4=>助理（师级）,5=>员（士）,6=>待聘
		$this->view->title_current = $staff_archive->title;
		$this->view->duty = $staff_archive->duty;
		/**
		 * 表注释:学历|select|1=>无学历,2=>小学,3=>初中,4=>高中,5=>技校,6=>中专,7=>大专,8=>大学,9=>研究生
		 * 
		 * 
		 **/
		$study_history=array('1'=>'无学历','2'=>'小学','3'=>'初中','4'=>'高中','5'=>'技校','6'=>'中专','7'=>'大专','8'=>'大学','9'=>'研究生');
		$this->view->study_history_options =$study_history; //学历|select|1=>无学历,2=>小学,3=>初中,4=>高中,5=>技校,6=>中专,7=>大专,8=>大学,9=>研究生
		$this->view->study_history_current = $staff_archive->study_history;
		/**
		 * 表注释:学位|select|0=>无学位,1=>学士,2=>硕士,3=>博士
		 * 
		 * 
		 **/
		$degrees=array('0'=>'无学位','1'=>'学士','2'=>'硕士','3'=>'博士');
		$this->view->degrees_options =$degrees; //学位|select|0=>无学位,1=>学士,2=>硕士,3=>博士
		$this->view->degrees_current = $staff_archive->degrees;
		$this->view->graduate_date = empty($staff_archive->graduate_date)?"":adodb_date("Y-m-d",$staff_archive->graduate_date);
		$this->view->graduate_school = $staff_archive->graduate_school;
		$this->view->telephone_number = $staff_archive->telephone_number;
		$this->view->family_address = $staff_archive->family_address;
		$this->view->urgency_name = $staff_archive->urgency_name;
		$this->view->urgency_telephone_number = $staff_archive->urgency_telephone_number;
		/**
		 * 表注释:年内接受培训情况_可多选|checkbox|11=>住院医师培训已合格,12=>正接受住院医师培训,13=>接受继续医学教育≥25学分,14=>接受继续医学教育<25学分,15=>全科医学培训,20=>护理知识培,30=>疾病预防知识培训,40=>卫生监督知识培训,50=>院前急救培训,60=>管理知识培训,70=>计算机培训,80=>其他岗位培训,90=>进修半年以上
		 * 
		 * 
		 **/
		$continue_education=array('11'=>'住院医师培训已合格','12'=>'正接受住院医师培训','13'=>'接受继续医学教育≥25学分','14'=>'接受继续医学教育<25学分','15'=>'全科医学培训','20'=>'护理知识培','30'=>'疾病预防知识培训','40'=>'卫生监督知识培训','50'=>'院前急救培训','60'=>'管理知识培训','70'=>'计算机培训','80'=>'其他岗位培训','90'=>'进修半年以上');
		$this->view->continue_education_options =$continue_education; //年内接受培训情况_可多选|checkbox|11=>住院医师培训已合格,12=>正接受住院医师培训,13=>接受继续医学教育≥25学分,14=>接受继续医学教育<25学分,15=>全科医学培训,20=>护理知识培,30=>疾病预防知识培训,40=>卫生监督知识培训,50=>院前急救培训,60=>管理知识培训,70=>计算机培训,80=>其他岗位培训,90=>进修半年以上
		$this->view->continue_education_current = @explode("|",$staff_archive->continue_education);
		/**
		 * 表注释:所学专业名称|select|101=>基础医学,102=>预防医学,1031=>临床医学,1032=>医学技术,104=>口腔医学,105=>中医学,106=>法医学,107=>护理学,108=>药学,109=>卫生管理,01=>哲学,02=>经济学,03=>法学,04=>教育学,05=>文学,6=>历史学,07=>理学,08=>工学,09=>农学
		 * 
		 * 
		 **/
		$specialty_name=array('101'=>'基础医学','102'=>'预防医学','1031'=>'临床医学','1032'=>'医学技术','104'=>'口腔医学','105'=>'中医学','106'=>'法医学','107'=>'护理学','108'=>'药学','109'=>'卫生管理','01'=>'哲学','02'=>'经济学','03'=>'法学','04'=>'教育学','05'=>'文学','6'=>'历史学','07'=>'理学','08'=>'工学','09'=>'农学');
		$this->view->specialty_name_options =$specialty_name; //所学专业名称|select|101=>基础医学,102=>预防医学,1031=>临床医学,1032=>医学技术,104=>口腔医学,105=>中医学,106=>法医学,107=>护理学,108=>药学,109=>卫生管理,01=>哲学,02=>经济学,03=>法学,04=>教育学,05=>文学,6=>历史学,07=>理学,08=>工学,09=>农学
		$this->view->specialty_name_current = $staff_archive->specialty_name;
		$this->view->study_abroad = $staff_archive->study_abroad;
		/**
		 * 表注释:本月人员流动情况流入|select|11=>高中等院校毕业生,12=>其他卫生机构调入,13=>非卫生机构调入,14=>军转人员,19=>其他,21=>流出:调往其他卫生机构,22=>考取研究生,23=>出国留学,24=>退休,25=>辞职(辞退),26=>自然减员,29=>其他
		 * 
		 * 
		 **/
		$mobility=array('11'=>'高中等院校毕业生','12'=>'其他卫生机构调入','13'=>'非卫生机构调入','14'=>'军转人员','19'=>'其他','21'=>'流出:调往其他卫生机构','22'=>'考取研究生','23'=>'出国留学','24'=>'退休','25'=>'辞职(辞退)','26'=>'自然减员','29'=>'其他');
		$this->view->mobility_options =$mobility; //本月人员流动情况流入|select|11=>高中等院校毕业生,12=>其他卫生机构调入,13=>非卫生机构调入,14=>军转人员,19=>其他,21=>流出:调往其他卫生机构,22=>考取研究生,23=>出国留学,24=>退休,25=>辞职(辞退),26=>自然减员,29=>其他
		$this->view->mobility_current = $staff_archive->mobility;
		$this->view->mobility_date 	  = $staff_archive->mobility_date==''?'':date("Y-m-d",$staff_archive->mobility_date);
		/**
		 * 表注释:是否本单位返聘人员|radio|Y=>是,N=>否
		 * 
		 * 
		 **/
		$reengage=array('Y'=>'是','N'=>'否');
		$this->view->reengage_options =$reengage; //是否本单位返聘人员|radio|Y=>是,N=>否
		$this->view->reengage_current = $staff_archive->reengage;
		/**
		 * 表注释:编制|select|1=>在编,2=>非在编
		 * 
		 * 
		 **/
		$organizer=array('1'=>'在编','2'=>'非在编');
		$this->view->organizer_options =$organizer; //编制|select|1=>在编,2=>非在编
		$this->view->organizer_current = $staff_archive->organizer;
		/**
		 * 表注释:工种|select|1=>卫生技术人员,2=>其他技术人员,3=>管理人员,4=>工勤技能人员
		 * 
		 * 
		 **/
		$type_of_work=array('1'=>'卫生技术人员','2'=>'其他技术人员','3'=>'管理人员','4'=>'工勤技能人员');
		$this->view->type_of_work_options =$type_of_work; //工种|select|1=>卫生技术人员,2=>其他技术人员,3=>管理人员,4=>工勤技能人员
		$this->view->type_of_work_current = $staff_archive->type_of_work;
		/**
		 * 表注释:行政/业务管理职务代码 (要求科室副主任及以上人员填写)|select|1=>党委(副)书记,2=>院(所.站)长,3=>副院(所.站)长,4=>科室主任,5=>科室副主任
		 * 
		 * 
		 **/
		$manage_rank=array('1'=>'党委(副)书记','2'=>'院(所.站)长','3'=>'副院(所.站)长','4'=>'科室主任','5'=>'科室副主任');
		$this->view->manage_rank_options =$manage_rank; //行政/业务管理职务代码 (要求科室副主任及以上人员填写)|select|1=>党委(副)书记,2=>院(所.站)长,3=>副院(所.站)长,4=>科室主任,5=>科室副主任
		$this->view->manage_rank_current = $staff_archive->manage_rank;
		/**
		 * 表注释:从事专业类别代码|select|11=>执业医师,12=>执业助理医师,13=>见习医师,21=>注册护士,22=>助产士,31=>西药师(士),32=>中药师(士),41=>检验技师(士),42=>影像技师(士),50=>卫生监督员,69=>其他卫生技术人员,70=>其他技术人员,80=>管理人员,90=>工勤及技能人员
		 * 
		 * 
		 **/
		$specialty_code=array('11'=>'执业医师','12'=>'执业助理医师','13'=>'见习医师','21'=>'注册护士','22'=>'助产士','31'=>'西药师(士)','32'=>'中药师(士)','41'=>'检验技师(士)','42'=>'影像技师(士)','50'=>'卫生监督员','69'=>'其他卫生技术人员','70'=>'其他技术人员','80'=>'管理人员','90'=>'工勤及技能人员');
		$this->view->specialty_code_options =$specialty_code; //从事专业类别代码|select|11=>执业医师,12=>执业助理医师,13=>见习医师,21=>注册护士,22=>助产士,31=>西药师(士),32=>中药师(士),41=>检验技师(士),42=>影像技师(士),50=>卫生监督员,69=>其他卫生技术人员,70=>其他技术人员,80=>管理人员,90=>工勤及技能人员
		$this->view->specialty_code_current = $staff_archive->specialty_code;
		/**
		 * 表注释:医师执业类别代码|select|1=>临床,2=>口腔,3=>公共卫生,4=>中医
		 * 
		 * 
		 **/
		$physician_certified_type=array('1'=>'临床','2'=>'口腔','3'=>'公共卫生','4'=>'中医');
		$this->view->physician_certified_type_options =$physician_certified_type; //医师执业类别代码|select|1=>临床,2=>口腔,3=>公共卫生,4=>中医
		$this->view->physician_certified_type_current = $staff_archive->physician_certified_type;
		/**
		 * 表注释:医师执业范围代码|select|11=>内科专业,12=>外科专业,13=>妇产科专业,14=>儿科专业,15=>眼耳鼻咽喉科专业,16=>皮肤病与性病专业,17=>精神卫生专业,18=>职业病专业,19=>医学影像和放射治疗专业,20=>医学检验..病理专业,21=>全科医学专业,22=>急救医学专业,23=>康复医学专业,24=>预防保健专业,25=>特种医学与军事医学专业,26=>计划生育技术服务专业,31=>口腔科专业,41=>公共卫生类别专业,51=>中医专业,52=>中西医结合专业,53=>蒙医专业,54=>藏医专业,55=>维医专业,56=>傣医专业,57=>省级卫生行政部门规定的其他专业
		 * 
		 * 
		 **/
		$physician_certified_rang=array('11'=>'内科专业','12'=>'外科专业','13'=>'妇产科专业','14'=>'儿科专业','15'=>'眼耳鼻咽喉科专业','16'=>'皮肤病与性病专业','17'=>'精神卫生专业','18'=>'职业病专业','19'=>'医学影像和放射治疗专业','20'=>'医学检验..病理专业','21'=>'全科医学专业','22'=>'急救医学专业','23'=>'康复医学专业','24'=>'预防保健专业','25'=>'特种医学与军事医学专业','26'=>'计划生育技术服务专业','31'=>'口腔科专业','41'=>'公共卫生类别专业','51'=>'中医专业','52'=>'中西医结合专业','53'=>'蒙医专业','54'=>'藏医专业','55'=>'维医专业','56'=>'傣医专业','57'=>'省级卫生行政部门规定的其他专业');
		$this->view->physician_certified_rang_options =$physician_certified_rang; //医师执业范围代码|select|11=>内科专业,12=>外科专业,13=>妇产科专业,14=>儿科专业,15=>眼耳鼻咽喉科专业,16=>皮肤病与性病专业,17=>精神卫生专业,18=>职业病专业,19=>医学影像和放射治疗专业,20=>医学检验..病理专业,21=>全科医学专业,22=>急救医学专业,23=>康复医学专业,24=>预防保健专业,25=>特种医学与军事医学专业,26=>计划生育技术服务专业,31=>口腔科专业,41=>公共卫生类别专业,51=>中医专业,52=>中西医结合专业,53=>蒙医专业,54=>藏医专业,55=>维医专业,56=>傣医专业,57=>省级卫生行政部门规定的其他专业
		$this->view->physician_certified_rang_current = $staff_archive->physician_certified_rang;
		/**
		 * 表注释:是否中医见习医师|radio|1=>是,2=>否
		 * 
		 * 
		 **/
		$herbalist_noviciate_doctor=array('1'=>'是','2'=>'否');
		$this->view->herbalist_noviciate_doctor_options =$herbalist_noviciate_doctor; //是否中医见习医师|radio|1=>是,2=>否
		$this->view->herbalist_noviciate_doctor_current = $staff_archive->herbalist_noviciate_doctor;
		$this->view->join_job_data = empty($staff_archive->join_job_data)?"":adodb_date("Y-m-d",$staff_archive->join_job_data);
		$this->view->office_telephone_number = $staff_archive->office_telephone_number;
		$this->view->mobile_telephone_number = $staff_archive->mobile_telephone_number;

		$roles=getRoles();//取得所有的角色
		
		if($this->user['role_width_option']!=1){
			//角色为非管理员时
			foreach ($roles as $key=>$role){
				if($role['width_option']==1){
					unset($roles["$key"]);
				}
			}
		}
		
		$roles_arr=$this->toViewRole($roles);
		
		$this->view->roles=$roles_arr;


		$this->view->org_name=urldecode($org_name);//机构名
		$this->view->org_id=$org_id;//机构id
		$this->view->region_id=$region_id;//地区id
		$this->view->region_path=$region_path;//所属机构
		$this->view->display("users_add.html");
	}
	/**
	 * 添加、修改个人记录
	 *
	 */
	public function updateAction(){

		$id=$this->_request->getParam('id','');//内部用关键序号
		$staff_core_update_token=false;//用户核心表标识
		$staff_archive_update_token=false;//用户扩展表标识
		$staff_core_id="";//档案编号
		//用户核心表
		$staff_core=new Tstaff_core();

		$staff_core->standard_code = $this->_request->getParam('standard_code');//国家标准档案号

		$staff_core->name_login = $this->_request->getParam('name_login');//医生登录名

		$passwd=$this->_request->getParam('passwd');//密码

		$staff_core->region_id = $this->_request->getParam('region_id');//所属地区id

		$staff_core->org_id = $this->_request->getParam('org_id');//所属机构id

		$staff_core->role_id = $this->_request->getParam('role_id');//角色id

		$staff_core->region_path = $this->_request->getParam('region_path');//所属机构

		//$staff_core->debugLevel(9);
		if(empty($id)){
			$staff_core_id=uniqid();
			$staff_core->passwd = md5($passwd);
			$staff_core->id=$staff_core_id;
			if($staff_core->insert()){
				$staff_core_update_token=true;

			}

		}else{
			if(!empty($passwd)){//密码为空不改动密码
				$staff_core->passwd = md5($passwd);
			}
			$staff_core->whereAdd("id='{$id}'");
			if($staff_core->update()){
				$staff_core_update_token=true;
			}


		}



		//用户扩展表
		$staff_archive=new Tstaff_archive();

		$staff_archive->name_real = $this->_request->getParam('name_real');//真实姓名|text

		$staff_archive->section_office_id = $this->_request->getParam('section_office_id');//科室ID|select|1=>预防保健科,2=>全科医疗科,3=>药房,4=>检验室,5=>X光室,6=>B超室,7=>心电图室,8=>消毒供应室,9=>信息资料室,10=>其它

		$staff_archive->status_flag = $this->_request->getParam('status_flag');//删除标记|null|0=>未正常保持,1=>正常,2=>删除

		$staff_archive->identity_card_number = $this->_request->getParam('identity_card_number');//身份证号|text

		$staff_archive->sex = $this->_request->getParam('sex');//性别|radio|1=>男,2=>女

		$date_of_birth=$this->_request->getParam('date_of_birth');//出生日期|text
		$staff_archive->date_of_birth = empty($date_of_birth)?"0":mkunixstamp($date_of_birth);//出生日期|text

		$staff_archive->title = $this->_request->getParam('title');//职称|select|1=>正高,2=>副高,3=>中级,4=>助理（师级）,5=>员（士）,6=>待聘

		$staff_archive->duty = $this->_request->getParam('duty');//职务|text

		$staff_archive->study_history = $this->_request->getParam('study_history');//学历|select|1=>无学历,2=>小学,3=>初中,4=>高中,5=>技校,6=>中专,7=>大专,8=>大学,9=>研究生

		$staff_archive->degrees = $this->_request->getParam('degrees');//学位|select|0=>无学位,1=>学士,2=>硕士,3=>博士

		$graduate_date = $this->_request->getParam('graduate_date');//毕业时间|text
		$staff_archive->graduate_date = empty($graduate_date)?"":mkunixstamp($graduate_date);//毕业时间|text

		$staff_archive->graduate_school = $this->_request->getParam('graduate_school');//毕业学校|text

		$staff_archive->telephone_number = $this->_request->getParam('telephone_number');//联系电话|text

		$staff_archive->family_address = $this->_request->getParam('family_address');//居委会名称|text

		$staff_archive->urgency_name = $this->_request->getParam('urgency_name');//紧急联系人姓名|text

		$staff_archive->urgency_telephone_number = $this->_request->getParam('urgency_telephone_number');//紧急联系人电话|text

		$staff_archive->continue_education = @implode("|",$this->_request->getParam('continue_education'));//年内接受培训情况_可多选|checkbox|11=>住院医师培训已合格,12=>正接受住院医师培训,13=>接受继续医学教育≥25学分,14=>接受继续医学教育<25学分,15=>全科医学培训,20=>护理知识培,30=>疾病预防知识培训,40=>卫生监督知识培训,50=>院前急救培训,60=>管理知识培训,70=>计算机培训,80=>其他岗位培训,90=>进修半年以上

		$staff_archive->specialty_name = $this->_request->getParam('specialty_name');//所学专业名称|select|101=>基础医学,102=>预防医学,1031=>临床医学,1032=>医学技术,104=>口腔医学,105=>中医学,106=>法医学,107=>护理学,108=>药学,109=>卫生管理,01=>哲学,02=>经济学,03=>法学,04=>教育学,05=>文学,6=>历史学,07=>理学,08=>工学,09=>农学

		$staff_archive->study_abroad = $this->_request->getParam('study_abroad');//出国留学学习时间（月数）|text

		$staff_archive->mobility = $this->_request->getParam('mobility');//本月人员流动情况流入|select|11=>高中等院校毕业生,12=>其他卫生机构调入,13=>非卫生机构调入,14=>军转人员,19=>其他,21=>流出:调往其他卫生机构,22=>考取研究生,23=>出国留学,24=>退休,25=>辞职(辞退),26=>自然减员,29=>其他
		$mobility_date=$this->_request->getParam('mobility_date','');
		$staff_archive->mobility_date = $mobility_date==''?'':strtotime($mobility_date);//人员流动日期
		$staff_archive->reengage = $this->_request->getParam('reengage');//是否本单位返聘人员|radio|Y=>是,N=>否

		$staff_archive->organizer = $this->_request->getParam('organizer');//编制|select|1=>在编,2=>非在编

		$staff_archive->type_of_work = $this->_request->getParam('type_of_work');//工种|select|1=>卫生技术人员,2=>其他技术人员,3=>管理人员,4=>工勤技能人员

		$staff_archive->manage_rank = $this->_request->getParam('manage_rank');//行政/业务管理职务代码 (要求科室副主任及以上人员填写)|select|1=>党委(副)书记,2=>院(所.站)长,3=>副院(所.站)长,4=>科室主任,5=>科室副主任

		$staff_archive->specialty_code = $this->_request->getParam('specialty_code');//从事专业类别代码|select|11=>执业医师,12=>执业助理医师,13=>见习医师,21=>注册护士,22=>助产士,31=>西药师(士),32=>中药师(士),41=>检验技师(士),42=>影像技师(士),50=>卫生监督员,69=>其他卫生技术人员,70=>其他技术人员,80=>管理人员,90=>工勤及技能人员

		$staff_archive->physician_certified_type = $this->_request->getParam('physician_certified_type');//医师执业类别代码|select|1=>临床,2=>口腔,3=>公共卫生,4=>中医

		$staff_archive->physician_certified_rang = $this->_request->getParam('physician_certified_rang');//医师执业范围代码|select|11=>内科专业,12=>外科专业,13=>妇产科专业,14=>儿科专业,15=>眼耳鼻咽喉科专业,16=>皮肤病与性病专业,17=>精神卫生专业,18=>职业病专业,19=>医学影像和放射治疗专业,20=>医学检验..病理专业,21=>全科医学专业,22=>急救医学专业,23=>康复医学专业,24=>预防保健专业,25=>特种医学与军事医学专业,26=>计划生育技术服务专业,31=>口腔科专业,41=>公共卫生类别专业,51=>中医专业,52=>中西医结合专业,53=>蒙医专业,54=>藏医专业,55=>维医专业,56=>傣医专业,57=>省级卫生行政部门规定的其他专业

		$staff_archive->herbalist_noviciate_doctor = $this->_request->getParam('herbalist_noviciate_doctor');//是否中医见习医师|radio|1=>是,2=>否

		$join_job_data = $this->_request->getParam('join_job_data','');//参加工作日期|text
		$staff_archive->join_job_data = empty($join_job_data)?"":mkunixstamp($join_job_data);//参加工作日期|text

		$staff_archive->office_telephone_number = $this->_request->getParam('office_telephone_number');//办公室电话号码|text

		$staff_archive->mobile_telephone_number = $this->_request->getParam('mobile_telephone_number');//手机号码(机构负责人及应急救治专家填写)|text
		//主表更新成功后才能更新扩展表
		if($staff_core_update_token===true){
			if(empty($id)){

				$staff_archive->id =$staff_core_id;//内部用关键序号

				$staff_archive->user_id = $staff_core_id;//工作人员核心ID
				if($staff_archive->insert()){
					$staff_archive_update_token=true;

				}

			}else{
				$staff_archive->whereAdd("user_id='{$id}'");
				if($staff_archive->update()){
					$staff_archive_update_token=true;
				}


			}
		}
		//输出结果
		if($staff_core_update_token===true && $staff_archive_update_token===true){
			echo "更新成功!|".$staff_core_id.$id;

		}else{
			echo "更新失败!|".$staff_core_id.$id;
		}


	}
	/**
	 * 导出用户数据
	 *
	 */
	public function exportAction(){
		$hours=@intval(date('Gi',time()));//小时分钟
		require_once(__SITEROOT.'library/Models/region.php');//地区表
		require_once(__SITEROOT.'library/Models/organization.php');//机构表
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
        //按下次随访日期搜索，默认情况下列出下次随访日期是今天的所有人员
        $search = array();
        $time = time();
        
        
        $region_p_id=$this->_request->getParam('region_p_id'); //地区id   
        $region=new Tregion();
        $region->whereAdd("id='$region_p_id'");
        $region->find(true);
        $region_path=$region->region_path;    

        $is_excel = $this->_request->getParam('excel');
        $title = "医生信息";
        if ($is_excel != "do")
        {

            $this->view->search = $search;            
            $this->view->assign('region_id', $this->user['region_id']);
            $this->view->assign('region_p_id', $this->user['region_id']);
            $this->view->assign('hours', $hours);
            $this->view->display('users_export_index.html');
        }
        else
        {
            if($hours>=900 && $hours<=1630)
            {
                exit("请09:00之前，16:30之后使用导出数据功能");
            }
            $section_office_id_array=array('1'=>'预防保健科','2'=>'全科医疗科','3'=>'药房','4'=>'检验室','5'=>'X光室','6'=>'B超室','7'=>'心电图室','8'=>'消毒供应室','9'=>'信息资料室','10'=>'其它');
            $staff_core = new Tstaff_core();
            $staff_archive = new Tstaff_archive();           
            $staff_core->joinAdd('left', $staff_core, $staff_archive, 'id', 'user_id');
            $staff_core->whereAdd("region_path like '$region_path%'");
            $staff_core->orderby("staff_core.org_id DESC");
            //$staff_core->debug(3);
            $staff_core->find();
          
            //导出数据到浏览器，然后输出总共导出多少条数据
            /** PHPExcel */
            require_once __SITEROOT . 'library/phpexcel/Classes/PHPExcel.php';
            // Create new PHPExcel object
           
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()->setCreator("笨得很")->setLastModifiedBy("我好笨")->
                setTitle($title)->setSubject($title)->setDescription($title)->setKeywords("office 2007 openxml php")->
                setCategory($title);
            //电子表格的序号
            $excel_order = array(
                "A",
                "B",
                "C",
                "D",
                "E",
                "F",
                "G"         
               );
            // 填写标题
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($excel_order[0] . '1', '国家标准档案号')->
                setCellValue($excel_order[1] . '1', '工作人员登录名')->setCellValue($excel_order[2] . '1',
                '真实姓名')->setCellValue($excel_order[3] . '1', '身份证号')->setCellValue($excel_order[4] .
                '1', '科室')->setCellValue($excel_order[5] .'1', '所属机构')->setCellValue($excel_order[6] .'1', 'id');
            //设置单元格格式
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[0])->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[1])->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[2])->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[3])->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[4])->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[5])->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[6])->setWidth(20);
            $i = 2;
            while ($staff_core->fetch())
            {
                $id	= $staff_core->id;
                $stand_code	= $staff_core->standard_code;
                $name_login	= $staff_core->name_login;                
                $name_real	= $staff_archive->name_real;
                $identity_card_number	= $staff_archive->identity_card_number;
                $section_office_id	= empty($staff_archive->section_office_id)?'':$section_office_id_array[$staff_archive->section_office_id];
                $organization = new Torganization();
                $organization ->whereAdd("id='".$staff_core->org_id."'");
                $organization ->find(true);
                $org_name	= $organization->zh_name;

                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($excel_order[0] . $i, $stand_code)->
                    setCellValue($excel_order[1] . $i, $name_login)->setCellValue($excel_order[2] . $i, $name_real)->
                    setCellValue($excel_order[3] . $i, $identity_card_number . " ")->setCellValue($excel_order[4] .
                    $i, $section_office_id)->setCellValue($excel_order[5] .$i, $org_name)->setCellValue($excel_order[6] .$i, $id);
                $i++;
            }
            $staff_core->free_statement();
            // Rename sheet

            $objPHPExcel->getActiveSheet()->setTitle($title);
            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);
            // Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.iconv('utf-8','gb2312',$title).'.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
         
            $objWriter->save('php://output');
            exit;
        }
	}
	/**
	 * 删除用户
	 *
	 */
	public function deleteAction(){
		$id=$this->_request->getParam('id','');//内部用关键序号
		if($id==''){
			echo "非法操作！";
			exit();
		}
		//判断其是否是其自身，防止管理员自己把自己删除
		if($id==$this->user['uuid']){
			echo "管理员不能删除自己，非法操作！";
			exit();
		}
		//判断其是否已输入数据,如果已输入了数据，则不能删除
		//以后换成对log表的操作
		$individual=new Tindividual_core();
		$individual->whereAdd("staff_id='$id'");
		if($individual->count('*')>0){
			echo "此工作人员已开始工作，不能删除，非法操作！";
			exit();
		}
		//然后删除
		$staff_core_token=false;//用户主表删除标识
		$staff_core=new Tstaff_core();
		$staff_core->whereAdd("id='{$id}'");
		if($staff_core->delete()){
			$staff_archive=new Tstaff_archive();
			$staff_archive->whereAdd("user_id='{$id}'");
			if($staff_archive->delete()){

				echo "删除成功！";
			}else{
				echo "删除失败！";
			}


		}


	}
	/**
	 * 将角色 $row[$i]['role_id']  = $roles_table->role_id;
			$row[$i]['role_en_name']= $roles_table->role_en_name;
			$row[$i]['role_zh_name']= $roles_table->role_zh_name;
	 *  转成 $role_arr[$roles_arr['role_id']]=$roles_arr['role_zh_name']
	 * @param unknown_type $roles
	 * @return unknown
	 */
	private function toViewRole($roles){
		$role_arr=array();
		foreach ($roles as $roles_arr){
			$role_arr[$roles_arr['role_id']]=$roles_arr['role_zh_name'];

		}

		return $role_arr;
	}


}
