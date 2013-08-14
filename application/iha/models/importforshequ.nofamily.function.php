<?php
/**
 * @author 我好笨
 * @todo 导入社区系统数据需要用到的函数，因导入数据涉及过多逻辑，因此代码可能太长，分文件存储，导入高血压
 */


/**
 * 导入高血压随访记录
 *
 * @param string $uuid 个人档案号
 */
function import_nofamily($chsc_id,$staff_id,$org_id,$db,$dbname)
{
	mysql_select_db($dbname,$db);
	mysql_query("set names utf8");
	$time=time();
	$result=mysql_query("select * from `ha_individual_info` where `family_number` not in (select `family_number` from `ha_family_info` where `chsc_id`='$chsc_id') and `status_flag`='1");
	while ($rd=mysql_fetch_array($result))
	{
		$rd['relation_of_householder']=0;//因这些档案是无家庭的，所以直接重置所有家庭状态为0
		$identity_number=$this->q2b($rd['identity_card_number']);
		//取此人的居委会id
		$juweihui_uuid=$rd['community'];//原老系统编码
		$juweihui_code=$rd['juweihui_code'];//后来新系统编码
		//从原社区系统中取居委会名称，并去掉居委会名字
		$j_sql="select * from juweihui where uuid='$juweihui_uuid' or juweihui_code='$juweihui_code'";
		$j_result=mysql_query($j_sql);
		$j_rd=mysql_fetch_array($j_result);
		$j_rd['juweihui_name']=isset($j_rd['juweihui_name'])?$j_rd['juweihui_name']:"";
		$juweihui_zh=str_replace("居委会","",$j_rd['juweihui_name']);
		//查询此居委会在雅安平台下的机构id
		$region=new Tregion();
		$region->whereAdd("zh_name = '$juweihui_zh'");
		$region->whereAdd("region_level > 7");
		$region->whereAdd("region_path like '0,1,2,5,71,18268%' or region_path like '0,1,2,5,71,18269%'");//范围限制在雨城区的东城和西城办事处
		$region->find(true);
		$region_p_id=$region->id?$region->id:$region_p_id;
		$core=new Tindividual_core();
		$core->whereAdd("org_id='$org_id'");//2011-11-14增加判定区域
		$core->whereAdd("identity_number='$identity_number'");
		$core->whereAdd("identity_number!=''");
		$core->free_statement();
		//身份证不合法，重置为空
		$identity_number=strlen($identity_number)<15?"":$identity_number;
		//产生新的个人档案号
		$uuid=uniqid('i_',true);
		$name=$rd['name'];
		$namePinyin=$rd['name_pinyin']?$rd['name_pinyin']:@getPinyin($name);
		$data_of_birth=strlen($identity_number)==18?substr($identity_number,6,8):'19'.substr($identity_number,6,6);
		$data_of_birth=$rd['date_of_birth']?$rd['date_of_birth']:($data_of_birth);
		$address=str_replace("--","",$this->q2b($rd['family_address']));
		$residence_address=str_replace("--","",$this->q2b($rd['family_address']));
		$phone_number=intval(substr(str_replace("--","",$this->q2b($rd['telephone_number'])),0,20));
		$f_number=$rd['family_number'];
		$staff_id=$this->user['uuid'];
		$org_id=$this->user['org_id'];
		//自定义编号
		$standard_code=$rd['sn_self_define'];
		$region_last_id=$region_p_id;
		$regionPath=isset($regionInfo[$region_last_id]['2'])?$regionInfo[$region_last_id]['2']:"";
		$temp=explode(',',$regionPath);
		//获取从县级到街道，居委会，小区的编码
		$region_id_1=isset($temp[4])?$temp[4]:"";
		$region_id_2=isset($temp[5])?$temp[5]:"";
		$region_id_3=isset($temp[6])?$temp[6]:"";
		$region_id_4=isset($temp[7])?$temp[7]:"";
		//$regionPath1是用于生成国标档案号的
		$regionPath1=isset($regionInfo[$region_id_3]['2'])?$regionInfo[$region_id_3]['2']:"";
		$relation_of_householder=$rd['relation_of_householder'];
		$response_doctor=$staff_id;
		$archive_doctor=$staff_id;
		//建档时间
		$filing_time=$rd['created']?$rd['created']:time();
		$relation=array(0=>"1",1=>"2",2=>"3",3=>"4",4=>"5",5=>"6",6=>"7",7=>"8",8=>"8",9=>"8",10=>"8","0308"=>"3","0208"=>"2","0408"=>"4");
		//家庭档案
		//户主，新建家庭
		$family=new Tfamily_archive();
		$family->selectAdd('max(inner_id) as inner_id');
		//按省标，是到最后一级区域的流水号
		$family->whereAdd("region_path='$regionPath'");
		$family->find(true);
		$familyInnerId=$family->inner_id+1;
		$familyInnerId=@str_repeat('0',4-strlen($familyInnerId)).$familyInnerId;
		$family_address=$this->q2b($family->family_address);
		$family->free_statement();
		//保存数据 家庭档案数据
		$family=new Tfamily_archive();
		$family_number=$family->family_number=$family->uuid=uniqid('f_',true);
		$family->inner_id=$familyInnerId;
		$family->org_id=$org_id;
		$family->inner_id=$familyInnerId;
		$family->family_address=$family_address;
		$family->telephone_number=$phone_number;
		$family->householder_id=$uuid;
		$family->householder_name=$name;
		$family->region_path=$regionPath;
		$family->staff_id=$archive_doctor;
		$family->deleted=0;
		$family->status_flag=1;
		$family->created=time();
		$family->updated=time();
		$family->insert();
		$family->free_statement();
		//个人档案核心表
		$individualInnerId='01';
		//获取人个档案号流水号 非户主
		if($rd['relation_of_householder']!="0" && $family_number)
		{
			$individual=new Tindividual_core();
			$individual->whereAdd("family_number='$family_number'");
			$individual->orderby('inner_id desc');
			$individual->limit(0,1);
			//$individual->debugLevel(9);
			$individual->find(true);
			//echo $individual->inner_id."|";
			$individualInnerId=$individual->inner_id+1;
			//echo $individualInnerId."|";
			$individualInnerId=str_repeat('0',2-strlen($individualInnerId)).$individualInnerId;
			$individual->free_statement();
		}
		//获取到家庭号，出入数据，否则排除
		if($family_number)
		{
			//获取国标档案编码流水号
			$region_path_inner_id=$this->_request->getParam('region_path_inner_id','');
			$individual=new Tindividual_core();
			$individual->selectAdd('max(region_path_inner_id) as region_path_inner_id');
			//注意这是里是$regionPath1
			$individual->whereAdd("region_path like '$regionPath1%'");
			$individual->find(true);
			if($individual->region_path_inner_id!=''){
				$region_path_inner_id=$individual->region_path_inner_id+1;
			}else{
				$region_path_inner_id=1;
			}
			$region_path_inner_id=str_repeat('0',5-strlen($region_path_inner_id)).$region_path_inner_id;
			//国标档案号 2011－1－27号出现的档案号重的问题就出在这里
			$std1=$regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.substr($regionInfo[$region_id_3]['1'],1,2).'-'.$region_path_inner_id;
			//省标档案号
			$std2=$regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.$regionInfo[$region_id_3]['1'].'-'.$regionInfo[$region_id_4]['1'].'-'.$familyInnerId.'-'.$individualInnerId;
			$individual->free_statement();
			//插入个人档案数据
			$individual=new Tindividual_core();
			$individual->uuid=$uuid;
			$individual->sex=$rd['sex'];
			$individual->inner_id=$individualInnerId;
			$individual->region_path=$regionPath;
			$individual->name=$name;
			$individual->name_pinyin=$namePinyin;
			$individual->identity_number=$identity_number;
			$individual->date_of_birth=intval($data_of_birth);
			$individual->org_id=$org_id;
			$individual->staff_id=$archive_doctor;
			$individual->response_doctor=$response_doctor;
			$individual->address=$address;
			$individual->residence_address=$address;
			$individual->family_number=$family_number;
			$individual->family_inner_id=intval($familyInnerId);
			$individual->region_path_inner_id=intval($region_path_inner_id);
			$individual->relation_holder=$relation["$relation_of_householder"];
			$individual->inner_id=$individualInnerId;
			$individual->filing_time=$filing_time;
			$individual->created=$individual->updated=time();
			$individual->phone_number=str_replace("--","",$phone_number);
			$individual->standard_code=$standard_code;//手工
			$individual->standard_code_1=$std1;//国标
			$individual->standard_code_2=$std2;//省标
			$individual->status_flag=1;
			$individual->syn_flag=9;
			$individual->debugLevel(5);
			echo "<br />",$family_number;
			if($family_number && !$individual->insert())
			{
				$individual->free_statement;
				exit("写入个人表失败".$name);
			}
			else
			{
				$individual->free_statement();
				//个人档案扩展表
				$individual_archive=new Tindividual_archive();
				$individual_archive->nationality=$rd['nationality'];//国籍
				$individual_archive->native_place=$rd['native_place'];//籍贯
				$individual_archive->reside_place=$rd['reside_place'];//居住地区
				$individual_archive->reside_time=intval($rd['reside_time']);//居住年限
				$individual_archive->contact="";
				$individual_archive->contact_number=intval(substr(str_replace("--","",$this->q2b($rd['telephone_number'])),0,20));
				$individual_archive->family_address=str_replace("--","",$this->q2b($rd['family_address']));
				$individual_archive->uuid=uniqid("i_",true);
				$individual_archive->id=$uuid;
				$individual_archive->org_id=$org_id;
				$individual_archive->staff_id=$archive_doctor;
				//处理疾病史
				$sql="select * from ch_clinical_history where `serial_number`='".$rd['uuid']."' and status_flag='1' and disease_state='1'";
				$cl=mysql_query($sql);
				while($cd=mysql_fetch_array($cl))
				{
					//取出本人的疾病状态
					if($cd['disease_name']=="高血压")
					{
						diagnose_disease($uuid,2,isset($rd['disease_date'])?$rd['disease_date']:"",$disease_history,$staff_id,$org_id);
						$individual_archive->disease_history=1;
					}
					elseif($cd['disease_name']=="糖尿病")
					{
						diagnose_disease($uuid,3,isset($rd['disease_date'])?$rd['disease_date']:"",$disease_history,$staff_id,$org_id);
						$individual_archive->disease_history=1;
					}
					elseif($cd['disease_name']=="精神分裂症")
					{
						diagnose_disease($uuid,8,isset($rd['disease_date'])?$rd['disease_date']:"",$disease_history,$staff_id,$org_id);
						$individual_archive->disease_history=1;
					}
					elseif($cd['disease_name']=="冠心病")
					{
						diagnose_disease($uuid,4,isset($rd['disease_date'])?$rd['disease_date']:"",$disease_history,$staff_id,$org_id);
						$individual_archive->disease_history=1;
					}
					elseif($cd['disease_name']=="COPD")
					{
						diagnose_disease($uuid,5,isset($rd['disease_date'])?$rd['disease_date']:"",$disease_history,$staff_id,$org_id);
						$individual_archive->disease_history=1;
					}
					elseif($cd['disease_name']=="脑卒中")
					{
						diagnose_disease($uuid,7,isset($rd['disease_date'])?$rd['disease_date']:"",$disease_history,$staff_id,$org_id);
						$individual_archive->disease_history=1;
					}
					elseif($cd['disease_name']=="结核病")
					{
						diagnose_disease($uuid,9,isset($rd['disease_date'])?$rd['disease_date']:"",$disease_history,$staff_id,$org_id);
						$individual_archive->disease_history=1;
					}
					else
					{
						$individual_archive->disease_history=0;
					}
				}
				$individual_archive->status_flag=1;
				$individual_archive->insert();
				$individual_archive->free_statement();
				//导入高血压
				import_hyper($rd['uuid'],$uuid,$staff_id,$org_id,$db,$dbname);
				//导入糖尿病
				import_diabetes($rd['uuid'],$uuid,$staff_id,$org_id,$db,$dbname);
				//导入精神分裂
				import_schizophrenia($rd['uuid'],$uuid,$staff_id,$org_id,$db,$dbname);
				//导入健康体检表
				import_examination($rd['uuid'],$uuid,$staff_id,$org_id,$db,$dbname);
				$current++;
			}

		}
	}
}