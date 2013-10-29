<?php
/**
 * @package 用于处理荥经县妇幼保健院个人档案封面显示荥经县人民医院-公卫职能科的问题  和把荥经县妇幼保健院下面的医生转到 荥经县妇幼保健院-公卫职能科下面
 * @author lsm
 * @date 2013-8-28
 */
class tools_changedoctorController extends controller 
{
	public function init()
	{
		require_once(__SITEROOT."library/Models/individual_core.php");
		require_once(__SITEROOT."library/Models/staff_core.php");
		require_once(__SITEROOT."library/Models/organization.php");
	}
	/**
	 * 处理个人档案封面显示荥经县人民医院-公卫职能科 
	 * 
	 * ORGANIZATION 
	   id=189  荥经县人民医院-公卫职能科
	   id=190  荥经县妇幼保健院
	   id=191  荥经县妇幼保健院-公卫职能科
	 *
	 */
	public function indexAction()
	{
		$individual_core= new Tindividual_core();
		$individual_core->query("select * from INDIVIDUAL_CORE where ORG_ID=189 and STAFF_ID  in (select id from STAFF_CORE where ORG_ID=190)");
		$i=0;
		$j=0;
		while($individual_core->fetch())
		{
			$individual= new Tindividual_core();
			$individual->whereAdd("uuid='$individual_core->uuid'");
			$individual->syn_flag='111';
			$individual->org_id='191';
			if($individual->update())
			{
				$i++;
			}
			else 
			{
				$j++;
			}
		}
		echo "成功更新".$i."条记录"."<br />";
		echo "更新失败".$j."条记录";
	}
	/**
	 * 把荥经县妇幼保健院下面的医生转到 荥经县妇幼保健院-公卫职能科下面
	 *
	 */
	public function doctorAction()
	{
		$staff= new Tstaff_core();
		$staff->whereAdd("org_id='191'");
		$staff->limit(0,1);
		$staff->find(true);
		$region_path=$staff->region_path;
		$org_id=$staff->org_id;
		$region_id=$staff->region_id;
		
		//更新
		$staff_core= new Tstaff_core();
		$staff_core->whereAdd("org_id='190'");
		$staff_core->whereAdd("id not in('4c89a014d93a5')");//系统管理员 陈浩  刘会 唐晓红、唐琼秀 
		$staff_core->find();
		$i=0;
		while($staff_core->fetch())
		{
			$s=new Tstaff_core();
			$s->whereAdd("id='$staff_core->id'");
			$s->whereAdd("role_id='14c29a32c28c09'");
			$s->region_id=$region_id;
			$s->region_path=$region_path;
			$s->org_id=$org_id;
			$s->ext_uuid='111';
			if($s->update())
			{
				$i++;
			}
		}
		echo "成功更新".$i."条记录!";
	}
}