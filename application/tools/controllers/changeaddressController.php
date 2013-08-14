<?php
/**
 * @package :用于修改现住址和户籍地址(根据individual_core表中的region_path修改),主要针对中坝乡全部转到灵关镇后，现住址和户籍地址没有修改。
 * @copyright :
 * @author :lsm
 * @create:2013-7-15
 */
class tools_changeaddressController extends controller 
{
	public function init()
	{
//		require_once(__SITEROOT.'library/privilege.php');//权限控制
//		$this->haveWritePrivilege;
		require_once(__SITEROOT."library/Models/individual_core.php");
		require_once(__SITEROOT."library/Models/region.php");
		require_once(__SITEROOT."library/Models/organization.php");
		require_once(__SITEROOT."library/Models/staff_core.php");
		$this->view->basePath=$this->_request->getBasePath();
	}
	/**
	 * 修改现住址和户籍地址
	 *
	 */
	public function indexAction()
	{
		//查询机构
		$zh_name=trim($this->_request->getParam("zh_name"));
		$ogranization=new Torganization();
		$ogranization->whereAdd("zh_name='$zh_name'");
		$ogranization->find(true);
		$org_id=$ogranization->id;
		
		if(!empty($org_id))
		{
			//根据机构id查询所有档案
			$individual=new Tindividual_core();
			$individual->whereAdd("org_id='$org_id'");
			$individual->orderby("name");
//			$individual->limit(0,1);
			$individual->find();
			$i=0;
			$j=0;
			while ($individual->fetch())
			{
				$region_path=$individual->region_path;
//				echo $region_path;
				$region_array=explode(",",$region_path);//把region_path字符串分割为数组
				$current_array=array();//从县级地址开始取地区名称
				$current_array[0]=$region_array[4];
				$current_array[1]=$region_array[5];
				$current_array[2]=$region_array[6];
				$current_array[3]=$region_array[7];
//				print_r($current_array);
				$string="";
				foreach ($current_array as $k=>$v)
				{
					$region=new Tregion();
					$region->whereAdd("id=$v");
					$region->find(true);
					$string.=$region->zh_name;
				}
//				echo $string;
				$individual_core=new Tindividual_core();
				$individual_core->whereAdd("uuid='$individual->uuid'");
//				$individual_core->find(true);
//				echo $individual_core->identity_number;
//				echo $individual_core->name;
				
				$individual_core->address=$string;
				$individual_core->residence_address=$string;
				if($individual_core->update())
				{
					$i++;
				}
				else 
				{
					$j++;
				}
			}
			
			$this->view->assign("i",$i);
			$this->view->assign("j",$j);
		}else 
		{
			echo "<script>alert('机构名称不对！')</script>";
		}
		$this->view->assign("org_id",$org_id);
		$this->view->assign("name",$zh_name);
		$this->view->display("index.html");
	}
	/**
	 * 修改建档医生
	 * 
	 */
	public  function modifydoctorAction()
	{
		$staff_id=$this->_request->getParam('staff_id');
		$new_staff_id=$this->_request->getParam('new_staff_id');
		$ok=$this->_request->getParam('ok');
		//获取中坝乡建档医生
		$organization=new Torganization();
		$staff=new Tstaff_core();
		$staff->joinAdd("left",$staff,$organization,"org_id","id");
		$staff->whereAdd("organization.id=39");
		$staff->find();
		$staff_array=array();
		$m=0;
		while($staff->fetch())
		{
			$staff_array[$m]['id']=$staff->id;
			$staff_array[$m]['name']=$staff->name_login;
			$m++;
			
		}
		//获取灵关镇建档医生
		$organization2=new Torganization();
		$staff2=new Tstaff_core();
		$staff2->joinAdd("left",$staff2,$organization2,"org_id","id");
		$staff2->whereAdd("organization.id=35");
		$staff2->find();
		$staff_array2=array();
		$n=0;
		while($staff2->fetch())
		{
			$staff_array2[$n]['id']=$staff2->id;
			$staff_array2[$n]['name']=$staff2->name_login;
			$n++;
			
		}
		if(!empty($ok))
		{
			$individual=new Tindividual_core();
			$individual->whereAdd("staff_id='$staff_id'");
			$individual->whereAdd("org_id=39");//
			$individual->orderby("staff_id desc");
//			$individual->limit(0,1);
			$num=$individual->count();
			$individual->find();
			$i=0;
			$j=0;
			while ($individual->fetch())
			{
				$individual_core=new Tindividual_core();
				$individual_core->whereAdd("uuid='$individual->uuid'");	
//				$individual_core->find(true);
				//echo $individual_core->uuid;
				$individual_core->staff_id=$new_staff_id;
				$individual_core->response_doctor=$new_staff_id;
				if($individual_core->update())
				{
					$i++;
				}
				else 
				{
					$j++;
				}
			}
			$this->view->assign("i",$i);
			$this->view->assign("j",$j);
			$this->view->assign("num",empty($num)?0:$num);
		}
		
		$this->view->assign("current_staff",$staff_id);
		$this->view->assign("new_current_staff",$new_staff_id);
		$this->view->assign("staff",$staff_array);
		$this->view->assign("staff2",$staff_array2);
		$this->view->display("modifydoctor.html");
	}
	/**
	 * 修改蜂桶寨乡的建档医生和责任医生，因为删掉原机构（民治乡）前没有处理建档医生和责任医生，现在这两项都读不出来！
	 *
	 */
	public function chdoctorAction()
	{
		//获取蜂桶寨乡的建档医生
		$staff=new Tstaff_core();
		$staff->whereAdd("org_id=44");
		$staff->find();
		$staff_array=array();
		$count=0;
		while ($staff->fetch())
		{
			$staff_array[$count]['id']=$staff->id;
			$staff_array[$count]['name']=$staff->name_login;
			
			$count++;
		}
//		print_r($staff_array);
		$id=$staff_array[5]['id'];
//		echo $id;
		
		$str="select uuid,staff_id,name from INDIVIDUAL_CORE where ORG_ID=44 and STAFF_ID not in(select id from STAFF_CORE where ORG_ID=44)";
		$individual=new Tindividual_core();
		$individual->query($str);
		$i=0;
		$j=0;
		while($individual->fetch())
		{
			$individual_core=new Tindividual_core();
			$individual_core->whereAdd("uuid='$individual->uuid'");
			$individual_core->staff_id=$id;
			$individual_core->response_doctor=$id;
			if($individual_core->update())
			{
				$i++;
			}
			else 
			{
				$j++;
			}
		}
		echo "处理成功{$i}条";
		echo "处理失败{$j}条";
	}
	/**
	 * 2013-7-30
	 * 重新处理蜂桶寨乡的建档医生和责任医生
	 *刘老师！邦把光明村，民和村，新华村，新康村的建档人改成罗世保，责任医生改成刘体华
	 * REGION_PATH
		0,1,2,5,78,3147,3949光明村 处理成功576条
		0,1,2,5,78,3147,3981民和村 处理成功534条
		0,1,2,5,78,3147,3965新华村 处理成功574条
		0,1,2,5,78,3147,3997新康村 处理成功382条
	 */
	public function olddoctorAction()
	{
		//获取蜂桶寨乡的建档医生
		$staff=new Tstaff_core();
		$staff->whereAdd("org_id=44");
		$staff->find();
		$staff_array=array();
		$count=0;
		while ($staff->fetch())
		{
			$staff_array[$count]['id']=$staff->id;
			$staff_array[$count]['name']=$staff->name_login;
			
			$count++;
		}
//		print_r($staff_array);
		$doctor_id=$staff_array[3]['id'];//罗世保
		$response_id=$staff_array[2]['id'];//刘体华
		
		$str="select uuid,staff_id,name,ADDRESS from INDIVIDUAL_CORE where ORG_ID=44 and REGION_PATH LIKE '0,1,2,5,78,3147,3949%'";
//		$str="select uuid,staff_id,name,ADDRESS from INDIVIDUAL_CORE where ORG_ID=44 and REGION_PATH LIKE '0,1,2,5,78,3147,3997%'";
		$individual=new Tindividual_core();
		$individual->query($str);
		$i=0;
		$j=0;
		while($individual->fetch())
		{
			$individual_core=new Tindividual_core();
			$individual_core->whereAdd("uuid='$individual->uuid'");
			$individual_core->staff_id=$doctor_id;
			$individual_core->response_doctor=$response_id;
			if($individual_core->update())
			{
				$i++;
			}
			else 
			{
				$j++;
			}
		}
		echo "处理成功{$i}条";
		echo "处理失败{$j}条";
		
	}
}