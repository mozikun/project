<?php
/**
 * @param unknown_type $org_id
 * @param unknown_type $password
 * @return unknown
 */
require_once __SITEROOT."application/api/models/api_phs_iha_comm.php";
class api_phs_iha_cover extends api_phs_comm{
	public function ws_login($org_id,$password){
		return login($org_id,$password);
	}
	public function ws_delete($token,$xml_string){
		return false;
		/*		if(checkToken($token)!=1){
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>请先登陆后在进行数据处理</return_string></message>";
		return $xml_string;
		}*/
		require_once __SITEROOT."library/Models/individual_core.php";
        require_once __SITEROOT."library/Models/individual_status.php";
		require_once __SITEROOT."library/Models/individual_archive.php";
		require_once __SITEROOT."library/Models/family_archive.php";
		$xml=new SimpleXMLElement($xml_string);
		$response='';
		$found=false;
		$org_id='';
		$identity_number='';
		$ext_uuid='';
		foreach ($xml as $key=>$value){
			//$response=$row->org_id;
			$response=$response.$key.'=>'.$value.'<br />';
			if($key=='org_id'){
				$org_id=$value;
			}
			if($key=='identity_number'){
				$identity_number=$value;
				$found=true;
			}
			if($key=='ext_uuid'){
				$ext_uuid=$value;
			}
		}
		$xml_row=
		"<row>".
		"<org_id>$org_id</org_id>".
		"<identity_number>$identity_number</identity_number>".
		"<ext_uuid>$ext_uuid</ext_uuid>".
		"</row>";
		if(!$found){
			$xml_string="<?xml version='1.0' encoding='UTF-8'?>".
			"<message>".
			"<return_code>2</return_code>".
			"<error_transaction>".$xml_row."</error_transaction>".
			"<return_string>参数中缺少身份证号码项目</return_string>".
			"</message>";
			return $xml_string;
		}
		$individual=new Tindividual_core();
		$individual->where("identity_number='$identity_number'");
		//$string=$individual->showErrorMessage();
		if($individual->count()!=1){
			$xml_string="<?xml version='1.0' encoding='UTF-8'?>".
			"<message>".
			"<return_code>3</return_code>".
			"<error_transaction>".$xml_row."</error_transaction>".
			"<return_string>没找到此人的数据,无法删除</return_string>".
			"</message>";
			return $xml_string;
		}
		$individual->find(true);
		$uuid=$individual->uuid;
		$family_number=$individual->family_number;
		if($individual->relation_holder=='1'){
			//判断是否还有家庭成员
			$individual=new Tindividual_core();
			$individual->whereAdd("family_number='$family_number'");
			if($individual->count('*')>1){
				$xml_string="<?xml version='1.0' encoding='UTF-8'?>".
				"<message>".
				"<return_code>3</return_code>".
				"<error_transaction>".$xml_row."</error_transaction>".
				"<return_string>此户主还有家庭成员，不能删除</return_string>".
				"</message>";
				return $xml_string;
			}
			//如果是户主，同时删除家庭档案
			$family=new Tfamily_archive();
			$family->where("family_number='$family_number'");
			$family->delete();
		}


		//删除主档案
		$individual->delete();
		$individual_archive=new Tindividual_archive();
		$individual_archive->where("id='$uuid");
		$individual_archive->delete();
        //2012-12-03 我好笨 删除档案状态
        $individual_status=new Tindividual_status();
        $individual_status->where("id='$uuid");
		$individual_status->delete();
		$response="<?xml version='1.0' encoding='UTF-8'?>".
		"<message>".
		"<return_code>1</return_code>".
		"<success_transaction>".$xml_row."</success_transaction>".
		"<return_string>成功删除数</return_string>".
		"</message>";
        $logs_array=array("ext_uuid"=>$ext_uuid,"org_id"=>$org_id,"model_id"=>1,"upload_time"=>time(),"upload_token"=>3);
        $this->insert_api_logs($logs_array);
		return $response;

	}
	/**
 * 插入与更新数据
 *
 * @param unknown_type $org_id
 * @param unknown_type $xml_string
 * @return unknown
 */
	public function ws_update($token,$xml_string){
		set_time_limit(0);
		/*		if(checkToken($token)!=1){
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>请先登陆后在进行数据处理</return_string></message>";
		return $xml_string;
		}*/

		//require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT."library/Models/individual_archive.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/family_archive.php";
		require_once __SITEROOT."library/Models/organization.php";
		require_once __SITEROOT."library/Models/staff_core.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
		require_once __SITEROOT."library/Models/region.php";
        require_once __SITEROOT."library/Models/individual_status.php";
		//require_once __SITEROOT."library/Models/logs.php";
		//require_once __SITEROOT.'library/MyAuth.php';
		require_once __SITEROOT.'library/pinyin/pinyin.php';
		/*	$data_xml=new SimpleXMLElement($xml_string);
		$identity_number=$data_xml->children()->children()->children()->identity_number;
		$ext_uuid=$data_xml->children()->children()->children()->children()->ext_uuid;
		return $identity_number;*/

		//$individual=new Tindividual_core();

		//sleep(60);
		//return $xml_string;
		$xml=new SimpleXMLElement($xml_string);
		$identity_number_error_number=0;
		$insert_number=0;
		$update_number=0;
		$region_path_error_number=0;
		$organization_error_number=0;
		$staff_id_error_number_1=0;
		$staff_id_error_number_2=0;
		$relation_holder_error_number=0;//关系错误
		$relation_of_householder_error_number=0;//代码错误
		$temp='';
		$error=1;
		$xml_success_string='';
		$xml_error_string='';
		$return_string='';
  
		$org_array=array();
		$reg_path_array=array();
		$staff_id_array=array();
		$org1=new Torganization();
		$org1->find();
		while ($org1->fetch()){
			$org_array['standard_code'][]=$org1->standard_code;
			$org_array['id'][]=$org1->id;
		}

		$region1=new Tregion();
		$region1->find();
		while ($region1->fetch()){
			$reg_path_array['standard_code_path'][]=$region1->standard_code_path;
			$reg_path_array['region_path'][]=$region1->region_path;
		}
		$staff1=new Tstaff_archive();
		$staff1->find();
		while ($staff1->fetch()){
			$staff_id_array['identity_card_number'][]=$staff1->identity_card_number;
			$staff_id_array['user_id'][]=$staff1->user_id;
		}

		//$temp1=array();

		foreach ($xml as $table){
			//echo '表属性名'.$table['name'];

			foreach ($table as $row){
				//array_search('green', $array); // $key = 2;
				$individual=new Tindividual_core();
				//得出操作类型，如果仅有一条，则是更新，如果没有，则是插入
                //2013-03-27我好笨增加修改档案身份证号问题，判定字段old_identity_number是否有值
                if($row->old_identity_number && $row->identity_number)
                {
                    //读取原身份证号码档案
                    $individual->where("identity_number='$row->old_identity_number' or identity_number='$row->identity_number'");
                }
                else
                {
                    $individual->where("identity_number='$row->identity_number'");
                }
				$insert_or_update_archive=$individual->count();
				//如果档案已存在，则读此人的数据
				if($insert_or_update_archive==1){
					$individual_old=new Tindividual_core();
					$individual_old->where("identity_number='$row->identity_number'");
					$individual_old->find(true);
				}

				//return $insert_or_update_archive;

				if($key=array_search($row->org_id,$org_array['standard_code'])){
					//$organization->find(true);
					//取系统内部的org id号
					$org_id=$org_array['id'][$key];
				}else{
					//$temp=$temp.$organization->showSQL();
					$organization_error_number++;
					$error=3;
					$xml_error_string=$xml_error_string.
					"<row>".
					"<org_id>$row->org_id</org_id>".
					"<identity_number>$row->identity_number</identity_number>".
					"<ext_uuid>$row->ext_uuid</ext_uuid>".
					"</row>";
					continue;
				}


				/*			foreach ($table as $row){
				//判断机构号是否正确，如果为空则此记录不更新
				$organization = new Torganization();
				$organization->where("standard_code='$row->org_id'");
				//if($org_id=swap_org_id('i',$row->org_id))
				if($organization->count()==1){
				$organization->find(true);
				//取系统内部的org id号
				$org_id=$organization->id;
				}else{
				//$temp=$temp.$organization->showSQL();
				$organization_error_number++;
				$error=3;
				$xml_error_string=$xml_error_string.
				"<row>".
				"<org_id>$row->org_id</org_id>".
				"<identity_number>$row->identity_number</identity_number>".
				"<ext_uuid>$row->ext_uuid</ext_uuid>".
				"</row>";
				continue;
				}
				$organization->free_statement();*/

				//sleep(1);
				//处理医生id。由身份证号转为内部编号
				if($key=array_search($row->staff_id,$staff_id_array['identity_card_number'])){
					$staff_id=$staff_id_array['user_id'][$key];
				}else{
					//$temp1[]=$row->staff_id;
					$staff_id_error_number_1++;
					$error=3;
					$xml_error_string=$xml_error_string.
					"<row>".
					"<org_id>$row->org_id</org_id>".
					"<identity_number>$row->identity_number</identity_number>".
					"<ext_uuid>$row->ext_uuid</ext_uuid>".
					"</row>";
					continue;
				}


				/*				$staff_archive=new Tstaff_archive();
				//$staff_archive->whereAdd("identity_card_number='$row->staff_id'");
				$staff_archive->whereAdd("identity_card_number='$row->staff_id'");
				if($staff_archive->count('*')==1){
				$staff_archive->find(true);
				$staff_id=$staff_archive->user_id;
				}else{
				//$temp1[]=$row->staff_id;
				$staff_id_error_number_1++;
				$error=3;
				$xml_error_string=$xml_error_string.
				"<row>".
				"<org_id>$row->org_id</org_id>".
				"<identity_number>$row->identity_number</identity_number>".
				"<ext_uuid>$row->ext_uuid</ext_uuid>".
				"</row>";
				continue;
				}
				$staff_archive->free_statement();
				*/
				//责任医生
				if($key=array_search($row->response_doctor,$staff_id_array['identity_card_number'])){
					$response_doctor=$staff_id_array['user_id'][$key];
				}else{
					//$temp1[]=$row->staff_id;
					$staff_id_error_number_2++;
					$error=3;
					$xml_error_string=$xml_error_string.
					"<row>".
					"<org_id>$row->org_id</org_id>".
					"<identity_number>$row->identity_number</identity_number>".
					"<ext_uuid>$row->ext_uuid</ext_uuid>".
					"</row>";
					continue;
				}
				//家庭关系与户主身份证号错误处理
				
				if($row->relation_holder==0 and trim($row->householder_identity_number)!=trim($row->identity_number)){
//return $row->relation_holder.'|'.$row->householder_identity_number.'|'.$row->identity_number.'|';
					$relation_holder_error_number++;
					$error=3;
					$xml_error_string=$xml_error_string.
					"<row>".
					"<org_id>$row->org_id</org_id>".
					"<identity_number>$row->identity_number</identity_number>".
					"<ext_uuid>$row->ext_uuid</ext_uuid>".
					"</row>";
					//return $xml_error_string;
					continue;
				}
				/*				$staff_archive=new Tstaff_archive();
				$staff_archive->whereAdd("identity_card_number='$row->response_doctor'");
				if($staff_archive->count('*')==1){
				$staff_archive->find(true);
				$response_doctor=$staff_archive->user_id;
				}else{
				//$temp1[]=$row->staff_id;
				$staff_id_error_number_2++;
				continue;
				}
				$staff_archive->free_statement();
				//判断身份证号是否为空，如果为空则此记录不更新
				if($row->identity_number==''){
				$identity_number_error_number++;
				continue;
				}*/
				//测试是否是正确的region_path 这里在上线的时候，要给服务器加standard_code_path字段，还要刷其值
				//$region=new Tregion();
				//$region->where("standard_code_path='$row->region_path'");

				if($key=array_search($row->region_path,$reg_path_array['standard_code_path'])){
					//$region->find(true);
					$region_path=$reg_path_array['region_path'][$key];
				}else{
					$region_path_error_number++;
					continue;
				}
                //region_path不符合规定，报错
                if(count(explode(',',$row->region_path))<8)
                {
                    $region_path_error_number++;
					continue;
                }
				/*if($region->count('*')==1){
				$region->find(true);
				$region_path=$region->region_path;
				}else{
				$region_path_error_number++;
				continue;
				}*/
				//$region->free_statement();
				//处理档案状态 外内映射
				$status_flag_array_e_i=array('1'=>'1','2'=>'4','3'=>'6','4'=>'8');
				$status_flag_array_i_e=array('1'=>'1','4'=>'2','6'=>'3','8'=>'4');
				//处理户主与家庭档案
				//国家标准家庭成员编号
				$relation_of_householder_array=array('0','1','2','3','4','5','6','7');
				//外-内映射
				$relation_of_householder_array_e_i=array('0'=>'1','1'=>'2','2'=>'3','3'=>'4','4'=>'5','5'=>'6','6'=>'7','7'=>'8');
				//内-外映射
				$relation_of_householder_array_i_e=array('0'=>'1','1'=>'2','2'=>'3','3'=>'4','4'=>'5','5'=>'6','6'=>'7','7'=>'8');
				if(!in_array($row->relation_holder,$relation_of_householder_array)){
					$relation_of_householder_error_number++;
					continue;
				}
				//家庭档案处理流程说明
				//第一次　户主


				//如果没有<householder_identity_number>-</householder_identity_number>则用"-"或空起
				//如果是新增无户主身份证档案时，把此人自己当成户主处理
				//if($insert_or_update_archive==0 and $row->relation_holder!=0 and ($row->householder_identity_number=='-' or $row->householder_identity_number=='')){
				if($row->relation_holder!=0 and ($row->householder_identity_number=='-' or $row->householder_identity_number=='')){
					$row->relation_holder=0;
					$row->householder_identity_number=$row->identity_number;
				}
				//本身是户主，转成了非户主或是本身是家庭成员，转成了户主的处理
				if($insert_or_update_archive==1 and $row->householder_identity_number!=$individual_old->householder_identity_number){
					//满足此条件说明换户主了
					//如果此人原来是户主，则要先删除此人的家庭档案
					if($individual_old->relation_holder==1){
						//　删除家庭档案
					}
				}
				//如果是户主档案先传，则传家庭成员的时候，就直接通过户主身份证号得到家庭档案号，如果户主后传，则处理户主的时候，会自动刷家庭档案号
				//麻烦在于成员传了后，户主档案不传，很难处理了。
				//判断如果是非户主 下面代码主要是处理户主档案先上传，家庭成员档案后上传的情况
                $family_number='';
                $individual_temp_identity_number='';
				if($row->relation_holder!=0){
					//通过个人档案里的户主档案号找到家庭档案号，然后更新
					$individual_temp=new Tindividual_core();
					//$individual_temp->family_number=$family_number;
					$individual_temp->where("identity_number='$row->householder_identity_number'");
					if($individual_temp->count()==1){
						$individual_temp->find(true);
						$family_number=$individual_temp->family_number;
						//$house_holder_name=$individual_temp->name;
					}else{
						$family_number='';
					}
                    $individual_temp_identity_number=$individual_temp->identity_number;
					//return 'family_number'.$family_number;
					$individual_temp->free_statement();
				}
				//
				if($insert_or_update_archive==1 and $row->relation_holder==0 and $row->identity_number!=$individual_temp_identity_number){
					//说明此人原来是某个户主的家庭成员，但现在独立成户主了
					$family_number=uniqid('f_',true);
				}


				//}


				//$debug_message="$row->relation_holder";
				//$debug_message='$row->relation_holder';
				//$debug_message=$relation_of_householder_array_e_i["$row->relation_holder"];
				//$debug_message="'$row->relation_holder'";
                $dead_time='';
				foreach ($row as $column_name=>$column){
					//给对象赋值
                    if($column_name!='old_identity_number' && $column_name!='response_doctor')
                    {
                        $individual->$column_name=$row->$column_name;
                    }
					//特殊数据值的处理
					$individual->region_path=$region_path;
					$individual->status_flag=$status_flag_array_e_i["$row->status_flag"];
					$individual->org_id=$org_id;
                    //原方法，罗老师使用的数组技术
					//$individual->staff_id=$staff_id;
					//$individual->response_doctor=$response_doctor;
                    //2013-10-28 我好笨 使用通用处理方法
                    $individual->response_doctor=$this->set_doctor_number($row->response_doctor);
                    $individual->staff_id=$this->set_doctor_number($row->staff_id);
					$individual->relation_holder=$relation_of_householder_array_e_i["$row->relation_holder"];
					$individual->family_number=$family_number;
					$individual->name_pinyin=getPinyin($row->name);
                    $dead_time=$row->dead_time;
					if(trim($row->ext_uuid)==''){
						$individual->ext_uuid=uniqid('ext_',true);
					}
				}
				//判断数据是否存在，存在做update，不存在做insert
				//return 'd';

				//$individual->where("identity_number='$row->identity_number'");
				//return 'd';

				//$counter=$individual->count();
				//$message1=$individual->showSQL();
                //$individual->debug(5);
				//更新
				if($insert_or_update_archive==1){
				    //2013-03-27我好笨增加修改档案身份证号问题，判定字段old_identity_number是否有值
                    if($row->old_identity_number && $row->identity_number)
                    {
                        //修改身份证号码
                        $individual->where("identity_number='$row->old_identity_number'");
                    }
					else
                    {
                        $individual->where("identity_number='$row->identity_number'");
                    }
                    //2013-06-24清除几个接口错误数据，稍后再修复
                    {
                        //处理更新数据,原始数据存在，更新的数据不存在则不保存新数据
                        if($individual->status_flag!=1)
                        {
                            $individual->status_flag=1;
                        }
                        if(!$individual->sex && $individual_old->sex)
                        {
                            unset($individual->sex);
                        }
                        if(!$individual->date_of_birth && $individual_old->date_of_birth)
                        {
                            unset($individual->date_of_birth);
                        }
                        if(!$individual->relation_holder && $individual_old->relation_holder)
                        {
                            unset($individual->relation_holder);
                        }
                        if(!$individual->address && $individual_old->address)
                        {
                            unset($individual->address);
                        }
                        if(!$individual->region_path && $individual_old->region_path)
                        {
                            unset($individual->region_path);
                        }
                        if(!$individual->standard_code_1 && $individual_old->standard_code_1)
                        {
                            unset($individual->standard_code_1);
                        }
                        if(!$individual->inner_id && $individual_old->inner_id)
                        {
                            unset($individual->inner_id);
                        }
                        if(!$individual->response_doctor && $individual_old->response_doctor)
                        {
                            unset($individual->response_doctor);
                        }
                        if(!$individual->family_inner_id && $individual_old->family_inner_id)
                        {
                            unset($individual->family_inner_id);
                        }
                        if(!$individual->criteria_rate && $individual_old->criteria_rate)
                        {
                            unset($individual->criteria_rate);
                        }
                    }
					$individual->update();
                    //2012-12-04 我好笨增加死亡时间的写入
                    if($individual->status_flag==6)
                    {
                        $individual_status=new Tindividual_status();
                        $individual_status->uuid=uniqid('sta_',true);
                        $individual_status->staff_id=$individual->staff_id;
                        $individual_status->id=$individual->uuid;
                        $individual_status->created=time();
                        $individual_status->updated=time();
                        $individual_status->status_time=$dead_time;
                        $individual_status->status_flag=$individual->status_flag;
                        $individual_status->insert();
                        $individual_status->free_statement();
                    }
					//$message="<br />".$individual->showSQL()."<br />";
					//$message="<br />".$individual->oracle_error()."<br />";
					//$message='更新数据成功';
					$message='';
					$update_number++;
					$xml_success_string=$xml_success_string.
					"<row>".
					"<org_id>$row->org_id</org_id>".
					"<identity_number>$row->identity_number</identity_number>".
					"<ext_uuid>$row->ext_uuid</ext_uuid>".$message.
					"</row>";
					//$message=$individual->oracle_error();
					$individual->free_statement();
                    $logs_array=array("ext_uuid"=>$row->ext_uuid,"org_id"=>$org_id,"model_id"=>1,"upload_time"=>time(),"upload_token"=>2);
                    $this->insert_api_logs($logs_array);
				}
				//插入
				if($insert_or_update_archive==0){
					//这里补充每张表数据所需要处理字段的内容，比如uuid的生成
					$individual->uuid=uniqid('i_',true);
					//家庭档案号
					if($individual->relation_holder=='1'){
						$family_number=$individual->family_number=uniqid('f_',true);
					}
                    $individual->response_doctor=$response_doctor;
					$individual->insert();
                    //2012-12-04 我好笨 增加档案状态插入
                    $individual_status=new Tindividual_status();
                    $individual_status->uuid=uniqid('sta_',true);
                    $individual_status->staff_id=$individual->staff_id;
                    $individual_status->id=$individual->uuid;
                    $individual_status->created=time();
                    $individual_status->updated=time();
                    $individual_status->status_time=time();
                    $individual_status->status_flag=$individual->status_flag;
                    $individual_status->insert();
                    $individual_status->free_statement();
					$message='插入数据成功';
					$insert_number++;
					$xml_success_string=$xml_success_string.
					"<row>".
					"<org_id>$row->org_id</org_id>".
					"<identity_number>$row->identity_number</identity_number>".
					"<ext_uuid>$row->ext_uuid</ext_uuid>".
					"</row>";
					//$message=$individual->showErrorMessage();
					//$message=$individual->showSQL();
					$individual->free_statement();
                    $logs_array=array("ext_uuid"=>$row->ext_uuid,"org_id"=>$org_id,"model_id"=>1,"upload_time"=>time(),"upload_token"=>1);
                    $this->insert_api_logs($logs_array);
				}
				//说明，如果先传家庭成员，正常处理，家庭档案号空起
				//等上传户主的时候，遍个人档案核心表，找到户主身份证号一致的成员，更新家庭档案号即可，处理家庭档案号
				//判断如果是户主，做相应的家庭档案的处理流程
				//注意，这里一定是1了，前面已转成内部代码
				if($individual->relation_holder==1){
					//$debug_message='判断如果是户主，做相应的家庭档案的处理流程';
					$individual->where("identity_number='$row->identity_number'");
					$individual->find(true);
					$family=new Tfamily_archive();
					$family->where("householder_id='$individual->uuid'");
					$counter=$family->count();
					//准备数据
					$family->org_id=$individual->org_id;
					$family->householder_id=$individual->uuid;
					$family_number=$family->uuid=$family->family_number=$individual->family_number;
					//$individual->family_number;
					$family->householder_name=$individual->name;
					//没有家庭档案
					if($counter==0){
						//新增的时候，生成uuid与family_number
						//$family->family_number=$family_number;
						$family->insert();
                        $logs_array=array("ext_uuid"=>$row->ext_uuid,"org_id"=>$org_id,"model_id"=>2,"upload_time"=>time(),"upload_token"=>1);
                        $this->insert_api_logs($logs_array);
					}
					//已有家庭档案
					if($counter==1){
						$family->where("householder_id='$individual->uuid'");
                        $family->update();
                        $logs_array=array("ext_uuid"=>$row->ext_uuid,"org_id"=>$org_id,"model_id"=>2,"upload_time"=>time(),"upload_token"=>2);
                        $this->insert_api_logs($logs_array);
					}
					$family->free_statement();
					//更新个人档案核心表中家庭成员的家庭档案号，原因就是在于有可能是户主数据先上传。
					$individual_temp=new Tindividual_core();
					$individual_temp->family_number=$family_number;
					$individual_temp->where("householder_identity_number='$row->identity_number'");
                    //临时关闭
					$individual_temp->update();
					$individual_temp->free_statement();
				}
			}
		}
		if($identity_number_error_number!=0){
			$identity_number_error_message='有'.$identity_number_error_number.'条记录的身份证为空或不正确，这些数据未处理<br />';
		}else{
			$identity_number_error_message='';
		}
		if($organization_error_number!=0){
			$organization_error_message='有'.$organization_error_number.'条记录的机构代码为空或不正确，这些数据未处理<br />';
		}else{
			$organization_error_message='';
		}
		if($staff_id_error_number_1!=0){
			$staff_id_error_message_1='有'.$staff_id_error_number_1.'条记录的医生(建档)id为空或不正确，这些数据未处理<br />';
		}else{
			$staff_id_error_message_1='';
		}
		if($staff_id_error_number_2!=0){
			$staff_id_error_message_2='有'.$staff_id_error_number_2.'条记录的医生(责任)id为空或不正确，这些数据未处理<br />';
		}else{
			$staff_id_error_message_2='';
		}
		if($region_path_error_number!=0){
			$region_path_error_message='有'.$region_path_error_number.'条记录的区域路径有错，这些数据未处理<br />';
		}else{
			$region_path_error_message='';
		}
		if($relation_holder_error_number!=0){
			$relation_holder_error_message='有'.$relation_holder_error_message.'条记录关系被设置为户主，但户主身份证号不是本人<br />';
		}else{
			$relation_holder_error_message='';
		}		
		
		$insert_message='插入个人档案数据成功'.$insert_number.'条';
		$update_message='更新个人档案数据成功'.$update_number.'条';
		//$string=implode('-',$temp1);
		$return_string=$insert_message.$update_message."<br />".$identity_number_error_message.$region_path_error_message.$organization_error_message.$staff_id_error_message_1.$staff_id_error_message_2.$relation_holder_error_message;
		//return $response;

		$response="<?xml version='1.0' encoding='UTF-8'?>".
		"<message>".
		"<return_code>$error</return_code>".
		"<success_transaction>".$xml_success_string."</success_transaction>".
		"<error_transaction>".$xml_error_string."</error_transaction>".
		"<return_string>".$return_string."</return_string>".
		"</message>";

		return $response;
	}
	public function ws_select($token,$xml_string){
		/*		if(checkToken($token)!=1){
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>请先登陆后在进行数据处理</return_string></message>";
		return $xml_string;
		//return checkToken($token);
		}*/
		//return $xml_string;
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/organization.php";
		require_once __SITEROOT."library/Models/staff_core.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
		require_once __SITEROOT."library/Models/region.php";
		/*		if($org_id!='510103'){
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>机构代码错</return_string></message>";
		return $xml_string;
		}*/

		require_once __SITEROOT."library/Models/individual_core.php";
		/*	require_once __SITEROOT."library/Models/individual_archive.php";
		require_once __SITEROOT."library/Models/family_archive.php";
		*/	
		$xml=new SimpleXMLElement($xml_string);
		$response='';
		$found=false;
		$org_id='';
		$identity_number='';
		$ext_uuid='';
		foreach ($xml as $key=>$value){
			//$response=$row->org_id;
			$response=$response.$key.'=>'.$value.'<br />';
			if($key=='org_id'){
				$org_id=$value;
			}
			if($key=='identity_number'){
				$identity_number=$value;
				$found=true;
			}
			if($key=='ext_uuid'){
				$ext_uuid=$value;
			}
		}
		$xml_row=
		"<row>".
		"<org_id>$org_id</org_id>".
		"<identity_number>$identity_number</identity_number>".
		"<ext_uuid>$ext_uuid</ext_uuid>".
		"</row>";
		//return $xml_string;
		if(!$found){
			$xml_string="<?xml version='1.0' encoding='UTF-8'?>".
			"<message>".
			"<return_code>2</return_code>".
			"<error_transaction>".$xml_row."</error_transaction>".
			"<return_string>参数中缺少身份证号码项目</return_string>".
			"</message>";
			return $xml_string;
		}
		$individual=new Tindividual_core();
        //取机构管辖范围
        $org_id_tmp=$this->get_org_id($org_id);
        if($org_id_tmp)
        {
            $organization = new Torganization();
      		$organization->whereAdd("id='$org_id_tmp'");
      		$organization->find(true);
            if($organization->region_path_domain)
            {
                $tmp_region=@explode('|',$organization->region_path_domain);
                if(!empty($tmp_region))
                {
                    $where='';
                    foreach($tmp_region as $k=>$v)
                    {
                        $where.="individual_core.region_path like '$v%' or ";
                    }
                    $where=rtrim($where,' or ');
                    if($where)
                    {
                        $individual->whereAdd("$where");
                    }
                }
            }
        }
		$individual->whereAdd("identity_number='$identity_number'");
        $nums=$individual->count();
		if($nums>1){
			$xml_string="<?xml version='1.0' encoding='UTF-8'?>".
			"<message>".
			"<return_code>3</return_code>".
			"<error_transaction>".$xml_row."</error_transaction>".
			"<return_string>平台存在重复的档案，暂时无法提供查询</return_string>".
			"</message>";
			return $xml_string;
		}
        elseif($nums==0)
        {
            $xml_string="<?xml version='1.0' encoding='UTF-8'?>".
			"<message>".
			"<return_code>3</return_code>".
			"<error_transaction>".$xml_row."</error_transaction>".
			"<return_string>没找到此人的数据,无法查询</return_string>".
			"</message>";
			return $xml_string;
        }
        else
        {
            
        }
		$individual->find(true);
		//将一些内部数据处理成为标准代码
		//处理机构
		$organization = new Torganization();
		$organization->whereAdd("id='$individual->org_id'");
		$organization->find(true);
		$org_id=$organization->standard_code;
		//处理医生
		$staff=new Tstaff_archive();
		$staff->where("user_id='$individual->staff_id'");
		$staff->find(true);
		$staff_id=$staff->identity_card_number;
		$staff->where("user_id='$individual->response_doctor'");
		$staff->find(true);
		$response_doctor=$staff->identity_card_number;
		//处理档案状态 外内映射
		$status_flag_array_e_i=array('1'=>'1','2'=>'4','3'=>'6','4'=>'8');
		$status_flag_array_i_e=array('1'=>'1','4'=>'2','6'=>'3','8'=>'4');
		$status_flag=$status_flag_array_i_e["$individual->status_flag"];
		//处理户主与家庭档案
		//国家标准家庭成员编号
		$relation_of_householder_array=array('0','1','2','3','4','5','6','7');
		//外内映射
		$relation_of_householder_array_e_i=array('0'=>'1','1'=>'2','2'=>'3','3'=>'4','4'=>'5','5'=>'6','6'=>'7','7'=>'8');
		//内外映射
		$relation_of_householder_array_i_e=array('1'=>'0','2'=>'1','3'=>'2','4'=>'3','5'=>'4','6'=>'5','7'=>'6','8'=>'7');
		$relation_holder=$relation_of_householder_array_i_e["$individual->relation_holder"];
		//处理region_path
		$region=new Tregion();
		$region->where("region_path='$individual->region_path'");
		$region->find(true);
		$region_path=$region->standard_code_path;
        $region_neigh=$region->region_path;
        $region->free_statement();

        //我好笨2012-12-27增加户主信息
        $hz=new Tindividual_core();
        $hz->whereAdd("family_number='$individual->family_number'");
        $hz->whereAdd("relation_holder=1");
        $hz->find(true);
        //我好笨2013-01-15增加显示居委会名称
        $tmp_region=@explode(',',$region_neigh);
        $nregion='';
        if(count($tmp_region)>6)
        {
            for($i=0;$i<7;$i++)
            {
                $nregion.=$tmp_region[$i].',';
            }
            $nregion=rtrim($nregion,',');
        }
        $region=new Tregion();
		$region->where("region_path='$nregion'");
		$region->find(true);
		$neighborhood_committees=$region->zh_name;
        $region->free_statement();
		$response="<?xml version='1.0' encoding='UTF-8'?>".
		"<tables>".
		"<table name='individual_core'>".
		"<row>".
		"<org_id>$org_id</org_id>".
        "<neighborhood_committees>$neighborhood_committees</neighborhood_committees>".
		"<identity_number>$individual->identity_number</identity_number>".
		"<ext_uuid>$individual->ext_uuid</ext_uuid>".
		"<staff_id>$staff_id</staff_id>".
		"<response_doctor>$response_doctor</response_doctor>".
		"<created>$individual->created</created>".
		"<updated>$individual->updated</updated>".
        "<filing_time>$individual->filing_time</filing_time>".
		"<standard_code>$individual->standard_code</standard_code>".
		"<standard_code_1>$individual->standard_code_1</standard_code_1>".
		"<region_path_inner_id>$individual->region_path_inner_id</region_path_inner_id>".
		"<standard_code_2>$individual->standard_code_2</standard_code_2>".
		"<status_flag>$status_flag</status_flag>".
		"<name>$individual->name</name>".
		"<identity_extra>$individual->identity_extra</identity_extra>".
		"<phone_number>$individual->phone_number</phone_number>".
		"<address>$individual->address</address>".
		"<residence_address>$individual->residence_address</residence_address>".
		"<householder_identity_number>$hz->identity_number</householder_identity_number>".
		"<householder_name>$hz->name</householder_name>".
		"<relation_holder>$relation_holder</relation_holder>".
		"<family_number>$individual->family_number</family_number>".
		"<inner_id>$individual->inner_id</inner_id>".
		"<family_inner_id>$individual->family_inner_id</family_inner_id>".
		"<region_path>$region_path</region_path>".
        "<census>$individual->census</census>".
		"</row>".
		"</table>".
		"</tables>";
		//对于select 要么返回错误的xml标准格式，要么返回一条记录的有效的xml数据
		return $response;

	}
	  /**
     * phsiha::ws_select_all()
     * 
     * @todo
     * 在api_phs_iha_cover增加一个模糊查询功能，可实现条件and查询。
     * Api为public function ws_select_all($token,$xml_string)
     * 其中$xml_string格式如下
     * $xml_string="<?xml version='1.0' encoding='UTF-8'?>".
     * "<where>".
     * "<org_id>必填并有效</org_id>".
     * "<region_path>选填（默认为空）</region_path>".
     * "<created>选填（默认为空）</created>".
     * "<updated>选填（默认为空）</updated>".
     * "<relation_holder>选填（默认为空）</relation_holder>".
     * "</where>";
     * 
     * 逻辑处理：根据org_id加上（and方式）非空条件去查询individual_core表，得到身份证号与ext_uuid的xml返回串，返回的xml格式为
     * $xml_return="<?xml version='1.0' encoding='UTF-8'?>
     * <tables>
     * <table name='individual_core'>
     * <row>
     * <identity_number>510103199901011679</identity_number>
     * <ext_uuid>43242342</ext_uuid>
     * </row> 
     * <row>
     * <identity_number>510103199901015679</identity_number>
     * <ext_uuid>43242341</ext_uuid>
     * </row>
     * </table>
     * <tables>";
     * 错误处理：
     * 缺少org_id，或是org_id错误判断与ws_select一致。
     * @param mixed $token
     * @param mixed $xml_string
     * @return void
     */
    public function ws_select_all($token, $xml_string)
    {
    	require_once __SITEROOT."library/Models/individual_core.php";
    	require_once __SITEROOT."library/Models/organization.php";
        require_once __SITEROOT.'library/data_arr/arrdata.php';
        require_once __SITEROOT.'library/custom/comm_function.php';
        $this->_error_message_start = "<?xml version='1.0' encoding='UTF-8'?><message>";
        $this->_error_message_end = "</message>";
        $core = new Tindividual_core();
        if ($xml_string)
        {
            //条件不为空时，解析查询条件
            $where_xml = new SimpleXMLElement($xml_string);
            $organization = new Torganization();
			$organization->whereAdd("standard_code='$where_xml->org_id'");
			$organization->find(true);
			$organization->free_statement();
			//var_dump($where_xml);
            //$org_id = $this->get_org_id($where_xml->org_id);
            $org_id = $organization->id;
            if (empty($org_id))
            {
                return $this->_error_message_start .
                    "<return_code>2</return_code><return_string>机构ID" . $where_xml->org_id .
                    "不存在</return_string>" . $this->_error_message_end;
            }     
            
            $region_path = $where_xml->region_path;
            if ($region_path!='')
            {   	
                $region_path = str_replace("%", "\%", $region_path);
                $region_path = str_replace("_", "\_", $region_path);
                $core->whereAdd("individual_core.region_path ='" . $region_path .
                    "' or individual_core.region_path like '" . $region_path . "%'");
            }
            else 
            {
            	//取管辖范围  2013年5月23号 新增 解决部分取到身份证的数据得不到档案首页详细
	            $select_region_path = '';
	            $region_domain = $organization->region_path_domain;  
	            $region_domain_array = explode('|',$region_domain);
	            foreach ($region_domain_array as $k=>$v)
	            {
	            	$select_region_path.=" individual_core.region_path like '$v%' or ";
	            }
	            $select_region_path = rtrim($select_region_path,'or ');
	            $core->whereAdd($select_region_path);
            }
            
            $createdstarttime = $where_xml->createdstarttime;
            if ($createdstarttime!='')
            {
            	$createdstarttime=strtotime($createdstarttime);
                $core->whereAdd("individual_core.created>='" . $createdstarttime . "'");
            }
            $createdendtime = $where_xml->createdendtime;
            if ($createdendtime!='')
            {
            	$createdendtime = strtotime($createdendtime);
                $core->whereAdd("individual_core.created<='" . $createdendtime . "'");
            }
            //更新日期
             $updatestarttime = $where_xml->updatestarttime;
             if ($updatestarttime!='')
            {
            	$updatestarttime = strtotime($updatestarttime);
                $core->whereAdd("individual_core.updated>='" . $updatestarttime . "'");
            }
            $updateendtime = $where_xml->updateendtime;
             if ($updateendtime!='')
            {
            	$updateendtime = strtotime($updateendtime);
                $core->whereAdd("individual_core.updated<='" . $updateendtime . "'");
            }
            $relation_holder = @array_code_change($where_xml->relation_holder, $relation_of_householder);
            
            if ($relation_holder !== '')
            {
                $core->whereAdd("individual_core.relation_holder='" . $relation_holder . "'");
            }
        }
        $nums = $core->count();
       // $core->debugLevel(9);
        if ($nums)
        {
            $core->find(); 
            $xml_string = "<?xml version='1.0' encoding='UTF-8'?><tables><table name='individual_core'>";
            while ($core->fetch())
            {
                $xml_string .= "<row>";
                $xml_string .= "<identity_number>" . $core->identity_number . "</identity_number>";
                $xml_string .= "<ext_uuid>" . $core->ext_uuid . "</ext_uuid>";
                $xml_string .= "</row>";
            }
            $xml_string .= "</table></tables>";
            return $xml_string;
            $core->free_statement();
        }
        else
        {
            return $this->_error_message_start .
                "<return_code>2</return_code><return_string>没有你要查询的数据，请检查查询条件</return_string>" .
                $this->_error_message_end; //错误，没有你要查询的数据，请检查查询条件
        }
    }
	
}
/*$server = new SoapServer(__SITEROOT."wsdl/api_phs_iha_cover.wsdl");
$server->addFunction("ws_update");
$server->addFunction("ws_delete");
$server->addFunction("ws_select");
$server->addFunction("ws_login");
$server->handle();*/