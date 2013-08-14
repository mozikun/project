<?php
/**
 * @param unknown_type $org_id
 * @param unknown_type $password
 * @return unknown
 */
require_once('api_phs_common.php');
class api_phs_iha_cover{
	function ws_login($org_id,$password){
		return login($org_id,$password);
	}
	function ws_delete($token,$xml_string){
/*		if(checkToken($token)!=1){
			$xml_string="<?xml version='1.0' encoding='UTF-8'?><message><return_code>2</return_code><return_string>请先登陆后在进行数据处理</return_string></message>";
			return $xml_string;
		}*/
		require_once __SITEROOT."library/Models/individual_core.php";
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

		$response="<?xml version='1.0' encoding='UTF-8'?>".
		"<message>".
		"<return_code>1</return_code>".
		"<success_transaction>".$xml_row."</success_transaction>".
		"<return_string>成功删除数</return_string>".
		"</message>";
		return $response;

	}
	/**
 * 插入与更新数据
 *
 * @param unknown_type $org_id
 * @param unknown_type $xml_string
 * @return unknown
 */
	function ws_update($token,$xml_string){
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
		//require_once __SITEROOT."library/Models/logs.php";
		//require_once __SITEROOT.'library/Myauth.php';
		require_once __SITEROOT.'library/pinyin/pinyin.php';
		/*	$data_xml=new SimpleXMLElement($xml_string);
		$identity_number=$data_xml->children()->children()->children()->identity_number;
		$ext_uuid=$data_xml->children()->children()->children()->children()->ext_uuid;
		return $identity_number;*/
		//$individual=new Tindividual_core();
		$xml=new SimpleXMLElement($xml_string);
		$identity_number_error_number=0;
		$insert_number=0;
		$update_number=0;
		$region_path_error_number=0;
		$organization_error_number=0;
		$staff_id_error_number=0;
		$relation_of_householder_error_number=0;
		$temp='';
		$error=1;
		$xml_success_string='';
		$xml_error_string='';
		$return_string='';
		//$temp1=array();
		foreach ($xml as $table){
			//echo '表属性名'.$table['name'];

			foreach ($table as $row){
				$individual=new Tindividual_core();
				//判断机构号是否正确，如果为空则此记录不更新
				$organization = new Torganization();
				$organization->whereAdd("standard_code='$row->org_id'");
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
				$organization->free_statement();
				
				//处理医生id。由身份证号转为内部编号
				$staff_archive=new Tstaff_archive();
				$staff_archive->whereAdd("identity_card_number='$row->staff_id'");
				if($staff_archive->count('*')==1){
					$staff_archive->find(true);
					$staff_id=$staff_archive->user_id;
				}else{
					//$temp1[]=$row->staff_id;
					$staff_id_error_number++;
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
				//责任医生
				$staff_archive=new Tstaff_archive();
				$staff_archive->whereAdd("identity_card_number='$row->response_doctor'");
				if($staff_archive->count('*')==1){
					$staff_archive->find(true);
					$response_doctor=$staff_archive->user_id;
				}else{
					//$temp1[]=$row->staff_id;
					$staff_id_error_number++;
					continue;
				}
				$staff_archive->free_statement();
				//判断身份证号是否为空，如果为空则此记录不更新
				if($row->identity_number==''){
					$identity_number_error_number++;
					continue;
				}
				//测试是否是正确的region_path 这里在上线的时候，要给服务器加standard_code_path字段，还要刷其值
				$region=new Tregion();
				$region->where("standard_code_path='$row->region_path'");
				if($region->count('*')==1){
					$region->find(true);
					$region_path=$region->region_path;
				}else{
					$region_path_error_number++;
					continue;
				}
				$region->free_statement();
				//处理档案状态 外内映射
				$status_flag_array_e_i=array('1'=>'1','2'=>'4','3'=>'6','4'=>'8');
				$status_flag_array_i_e=array('1'=>'1','4'=>'2','6'=>'3','8'=>'4');
				//处理户主与家庭档案
				//国家标准家庭成员编号
				$relation_of_householder_array=array('0','1','2','3','4','5','6','7');
				//外内映射
				$relation_of_householder_array_e_i=array('0'=>'1','1'=>'2','2'=>'3','3'=>'4','4'=>'5','5'=>'6','6'=>'7','7'=>'8');
				//内外映射
				$relation_of_householder_array_i_e=array('0'=>'1','1'=>'2','2'=>'3','3'=>'4','4'=>'5','5'=>'6','6'=>'7','7'=>'8');
				if(!in_array($row->relation_holder,$relation_of_householder_array)){
					$relation_of_householder_error_number++;
					continue;
				}
				//如果没有<householder_identity_number>-</householder_identity_number>则用"-"
				//这时把此人自己当成户主处理
				if($row->relation_holder!=0 and $row->householder_identity_number=='-'){
					$row->relation_holder=0;
					$row->householder_identity_number=$row->identity_number;
				}
				
				//如果是户主档案先传，则传家庭成员的时候，就直接通过户主身份证号得到家庭档案号，如果户主后传，则处理户主的时候，会自动刷家庭档案号
				//判断如果是非户主 下面代码主要是处理户主档案先上传，家庭成员档案后上传的情况
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
					$individual_temp->free_statement();
				}

				//$debug_message="$row->relation_holder";
				//$debug_message='$row->relation_holder';
				//$debug_message=$relation_of_householder_array_e_i["$row->relation_holder"];
				//$debug_message="'$row->relation_holder'";
				foreach ($row as $column_name=>$column){
					//给对象赋值
					$individual->$column_name=$row->$column_name;
					//特殊数据值的处理
					$individual->region_path=$region_path;
					$individual->status_flag=$status_flag_array_e_i["$row->status_flag"];
					$individual->org_id=$org_id;
					$individual->staff_id=$staff_id;
					$individual->response_doctor=$response_doctor;
					$individual->relation_holder=$relation_of_householder_array_e_i["$row->relation_holder"];
					$individual->family_number=$family_number;
					$individual->name_pinyin=getPinyin($row->name);
					if(trim($row->ext_uuid)==''){
						$individual->ext_uuid=uniqid('ext_',true);
					}
				}
				//判断数据是否存在，存在做update，不存在做insert
				$individual->where("identity_number='$row->identity_number'");
				$counter=$individual->count();
				//$message1=$individual->showSQL();
				//更新
				if($counter==1){
					$individual->where("identity_number='$row->identity_number'");
					$individual->update();
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
				}
				//插入
				if($counter==0){
					//这里补充每张表数据所需要处理字段的内容，比如uuid的生成
					$individual->uuid=uniqid('i_',true);
					//家庭档案号
					if($individual->relation_holder=='1'){
						$family_number=$individual->family_number=uniqid('f_',true);
					}
					$individual->insert();
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
					}
					//已有家庭档案
					if($counter==1){
						$family->where("householder_id='$individual->uuid'");
						$family->update();
					}
					$family->free_statement();
					//更新个人档案核心表中家庭成员的家庭档案号，原因就是在于有可能是户主数据先上传。
					$individual_temp=new Tindividual_core();
					$individual_temp->family_number=$family_number;
					$individual_temp->where("householder_identity_number='$row->identity_number'");
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
		if($staff_id_error_number!=0){
			$staff_id_error_message='有'.$staff_id_error_number.'条记录的医生id为空或不正确，这些数据未处理<br />';
		}else{
			$staff_id_error_message='';
		}

		if($region_path_error_number!=0){
			$region_path_error_message='有'.$region_path_error_number.'条记录的区域路径有错，这些数据未处理<br />';
		}else{
			$region_path_error_message='';

		}
		$insert_message='插入个人档案数据成功'.$insert_number.'条<br />';
		$update_message='更新个人档案数据成功'.$update_number.'条<br />';
		$string=implode('-',$temp1);
		$return_string=$insert_message.$update_message.$identity_number_error_message.$region_path_error_message.$organization_error_message.$staff_id_error_message;
		//return $response;
		$response="<?xml version='1.0' encoding='UTF-8'?>".
		"<message>".
		"<return_code>$error</return_code>".
		"<success_transaction>".$xml_success_string."</success_transaction>".
		"<error_transaction>".$xml_error_string."</error_transaction>".
		"<return_string>$return_string</return_string>".
		"</message>";

		return $response;
	}
	function ws_select($token,$xml_string){
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
		*/	$xml=new SimpleXMLElement($xml_string);
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
		$individual->where("identity_number='$identity_number'");
		if($individual->count()!=1){
			$xml_string="<?xml version='1.0' encoding='UTF-8'?>".
			"<message>".
			"<return_code>3</return_code>".
			"<error_transaction>".$xml_row."</error_transaction>".
			"<return_string>没找到此人的数据,无法查询</return_string>".
			"</message>";
			return $xml_string;
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





		$response="<?xml version='1.0' encoding='UTF-8'?>".
		"<tables>".
		"<table name='individual_core'>".
		"<row>".
		"<org_id>$org_id</org_id>".
		"<identity_number>$individual->identity_number</identity_number>".
		"<ext_uuid>$individual->ext_uuid</ext_uuid>".
		"<staff_id>$staff_id</staff_id>".
		"<response_doctor>$response_doctor</response_doctor>".
		"<created>$individual->created</created>".
		"<updated>$individual->updated</updated>".
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
		"<householder_identity_number>$individual->householder_identity_number</householder_identity_number>".
		"<householder_name>$individual->householder_name</householder_name>".
		"<relation_holder>$relation_holder</relation_holder>".
		"<inner_id>$individual->inner_id</inner_id>".
		"<family_inner_id>$individual->family_inner_id</family_inner_id>".
		"<region_path>$region_path</region_path>".
		"</row>".
		"</table>".
		"</tables>";
		//对于select 要么返回错误的xml标准格式，要么返回一条记录的有效的xml数据
		return $response;

	}
}
/*$server = new SoapServer(__SITEROOT."wsdl/api_phs_iha_cover.wsdl");
$server->addFunction("ws_update");
$server->addFunction("ws_delete");
$server->addFunction("ws_select");
$server->addFunction("ws_login");
$server->handle();*/