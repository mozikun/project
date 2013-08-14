<?php
 function getmyallnumber($regionid,$type){
 	    $region          = new Tregion();
		$region->whereAdd("p_id='$regionid'");
		$region->find();
		$regionArr   = array();
		$regionCount = 0;
		$allhospital  = 0;
		$allcount    = 0;
		$alladmin    = 0;
		$allcommunity= 0;
		$allzfjg     = 0;
		while($region->fetch()){
			//获取到了当前登录这级的直接下一级		
			$regionArr[$regionCount]['axisname'] = substr($region->zh_name,0,6);
			//获取这个直接下一级的所有信息(找机构表),
			//找执法机构
			$orgzfjgobj = new Torganization();
			$orgzfjgobj->whereAdd("region_path like '$region->region_path%'");
			$orgzfjgobj->whereAdd("type='$type'");
		    $orgzfjgobj->find();
			$loneorgzfjg = $orgzfjgobj->count();
			$regionArr[$regionCount]['orgzfjgcount']= $loneorgzfjg;
			$allzfjg = $allzfjg+$loneorgzfjg;
			$regionCount++;
		}
		return $regionArr;
 }
 
 
 
 function getuserinfo($regionId,$type){
 	    $region          = new Tregion();
		$region->whereAdd("p_id='$regionId'");
		$region->find();
		$count  = 0;
		$regionarr = array();
		$staffcountzyys = 0;
		while($region->fetch()){
			$region_path   = $region->region_path;
			$regionarr[$count]['axisname']   = substr($region->zh_name,0,6);
 			$staff_core    = new Tstaff_core();
			$staff_archive = new Tstaff_archive();
			$staff_core->whereAdd("region_path like '$region_path%'");
			$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
			$staff_core->find();
			$lonezyys = 0; 
			$staffarray = array();
			while ($staff_core->fetch()){
					if($staff_archive->specialty_code==$type){
	                           $lonezyys = $lonezyys+1;
					}
			}
			$regionarr[$count]['lonezyys'] = $lonezyys;
			$count++;
		}
		return $regionarr;
 }
 
 
 function getequipment($regionid){
 	    $region          = new Tregion();
		$region->whereAdd("p_id='$regionid'");
		$region->find();
		$count  = 0;
		$allnumber = 0;
		$regionarr = array();
		while($region->fetch()){
			$regionpath = $region->region_path;
			$org = new Torganization();
			$org->whereAdd("region_path like '$regionpath%'");
			$org->find();
			$orgcount = 0;
			while ($org->fetch()){
				$orgid = $org->id;
				$org_ext_3 = new Torg_ext_3();
				$org_ext_3->whereAdd("id='$orgid'");
				$org_ext_3->find(true);
				$equipment_total_number = $org_ext_3->equipment_total_number;
				$orgcount = $orgcount + $equipment_total_number;
			}
			$regionarr[$count]['equipment_total_number'] = $orgcount;
			$regionarr[$count]['axisname']               = substr($region->zh_name,0,6);
			$allnumber = $allnumber+$orgcount;
			$count++;
		}
		return $regionarr;
 }
 
 
function getbuilding($regionId){
	   $region          = new Tregion();
		$region->whereAdd("p_id='$regionId'");
		$region->find();
		$count  = 0;
		$allnumber = 0;
		$regionarr = array();
		while($region->fetch()){
			$regionpath = $region->region_path;
			$org = new Torganization();
			$org->whereAdd("region_path like '$regionpath%'");
			$org->find();
			$orgcount = 0;
			while ($org->fetch()){
				$orgid = $org->id;
				$org_ext_2 = new Torg_ext_2();
				$org_ext_2->whereAdd("id='$orgid'");
				$org_ext_2->find(true);
				$building_total_number = $org_ext_2->operation_area;
				$orgcount = $orgcount + $building_total_number;
			}
			$regionarr[$count]['operation_area'] = $orgcount;
			$regionarr[$count]['axisname']       = substr($region->zh_name,0,6);
			$allnumber = $allnumber+$orgcount;
			$count++;
		}
		return  $regionarr;
}