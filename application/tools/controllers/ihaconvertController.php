<?php
/**
 * tools_ihaconvertController
 * 
 * 处理因接口问题导致个人档案部分信息丢失。
 * 
 * @package yaan
 * @author lsm
 * @copyright 2013-6-24
 */
class tools_ihaconvertController extends controller {
	public function init()
	{
//		$this->haveWritePrivilege='';
		require_once(__SITEROOT.'library/Models/individual_core.php');
		require_once(__SITEROOT.'library/Models/blood_type.php');
//		require_once(__SITEROOT.'library/privilege.php');
	}
	public function indexAction(){
		$individual_core=new Tindividual_core();//251数据库
		$individual_core2=new Tindividual_core(2);//20数据库
		
		$individual_core->whereAdd("ext_uuid is not null");
		$individual_core->whereAdd("identity_extra is not null");
		$individual_core->find();
		$i=0;
		$j=0;
		$n=0;
		while ($individual_core->fetch()) 
		{			
			$individual_core2->where("uuid='$individual_core->uuid'");
//			$individual_core2->debug(1);
//			$individual_core2->count();//打印count
			$individual_core2->find(true);
			$uuid=$individual_core2->uuid;
			if($uuid)
			{
				$individual_new=new Tindividual_core();
				$individual_new->whereAdd("uuid='$uuid'");
				$individual_new->status_flag=$individual_core2->status_flag;          //档案状态
				$individual_new->sex=$individual_core2->sex;                          //性别
				$individual_new->date_of_birth=$individual_core2->date_of_birth;      //出生年月
				$individual_new->relation_holder=$individual_core2->relation_holder;  //与户主关系
				$individual_new->address=$individual_core2->address;                  //地址
				$individual_new->region_path=$individual_core2->region_path;          //路径
				$individual_new->standard_code=$individual_core2->standard_code;      //国家标准档案号
				$individual_new->standard_code_1=$individual_core2->standard_code_1;  //标准码
				$individual_new->inner_id=$individual_core2->inner_id;                //家庭内部流水号
				$individual_new->response_doctor=$individual_core2->response_doctor;  //责任医生
				$individual_new->family_inner_id=$individual_core2->family_inner_id;  //家庭内部序号
				$individual_new->criteria_rate=$individual_core2->criteria_rate;      //档案完整率
				
				if($individual_new->update()){
//					echo "成功恢复第{$i}条数据。"."uuid={$uuid}";
//					echo "<br />";
					$i++;
				}
				else {
					$j++;
				}
			}
			else {
				$n++;	
			}
//			if($i=10)//跳出循环
//			{
//				break;
//			}
		}
		echo "成功".$i."条记录"."<br/>";
		echo "失败".$j."条记录"."<br/>";
		echo "没有更新".$n."条记录"."<br/>";
	}
	/**
	 * http://localhost:8080/tools/ihaconvert/blood
	 * 处理因接口问题导致blood_type部分信息丢失。
	 * @copyright 3013-7-3
	*/
	public function bloodAction(){
		$blood=new Tblood_type();//251数据库
		$blood2=new Tblood_type(2);//20数据库
		
		$blood->whereAdd("ext_uuid is not null");
		$blood->whereAdd("FILING_TIME is not null");
		$blood->find();
		$i=0;$j=0;$n=0;
		while ($blood->fetch())
		{
			$blood2->where("id='$blood->id'");
			$blood2->find(true);
			$id=$blood2->id;
			
			if($id){
				$blood_new=new Tblood_type();
				$blood_new->where("id='$id'");
				$blood_new->abo_bloodtype=$blood2->abo_bloodtype;
				$blood_new->rh_bloodtype=$blood2->rh_bloodtype;
				$blood_new->staff_id=$blood2->staff_id;//医生id
				$blood_new->created=$blood2->created;
				$blood_new->updated=$blood2->updated;
				
				if($blood_new->update())
				{
					$i++;
				}else {
					$j++;
				}
			}else {
				$n++;
			}	
		}
		echo "成功".$i."条记录"."<br/>";
		echo "失败".$j."条记录"."<br/>";
		echo "没有更新".$n."条记录"."<br/>";
	}
	/**
	 * 处理责任医生individual_core
	 * 成功1713条记录
	 * 失败0条记录
	 * 没有更新10条记录
	 * 2013-7-3
	 */
	public function doctorAction()
	{
		$individual_core=new Tindividual_core();//251数据库
		$individual_core2=new Tindividual_core(2);//20数据库
		
		$individual_core->whereAdd("EXT_UUID is not null");
		$individual_core->whereAdd("RESPONSE_DOCTOR='-'");
		$individual_core->find();
//		echo $count=$individual_core->count();
		$i=0;
		$j=0;
		$n=0;
		while ($individual_core->fetch())
		{
			$individual_core2->where("uuid='$individual_core->uuid'");
			$individual_core2->find(true);
			$uuid=$individual_core2->uuid;
			if($uuid)
			{
				$individual_new=new Tindividual_core();
				$individual_new->whereAdd("uuid='$uuid'");
				$individual_new->response_doctor=$individual_core2->response_doctor;  //责任医生
				
				if($individual_new->update()){
					$i++;
				}
				else {
					$j++;
				}
			}
			else {
				$n++;
			}
		}
		echo "成功".$i."条记录"."<br/>";
		echo "失败".$j."条记录"."<br/>";
		echo "没有更新".$n."条记录"."<br/>";
	}
	/**
	 * 测试20数据库的连接
	 *
	 */
	public function listAction()
	{
		$individual_core2=new Tindividual_core(2);//20数据库
		$num=$individual_core2->count();
		$individual_core2->find();
		echo $num;
	}
}