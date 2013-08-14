<?php
   /**
    * 用于图形
    * author:CT
    * created:2013.4.9
    *
    */
  class organization_orgsourceController extends  controller 
  {
  	 public function init()
  	 {
  	 	require_once __SITEROOT.'library/privilege.php';
  	 	require_once __SITEROOT.'library/custom/comm_function.php';
  	 	require_once __SITEROOT.'library/Models/organization.php';
 		require_once __SITEROOT.'library/Models/chs_center.php';
 	    require_once __SITEROOT.'library/Models/org_ext_1.php';
 	    require_once __SITEROOT.'library/Models/org_ext_2.php';
 	    require_once __SITEROOT.'library/Models/org_ext_3.php';
 	    require_once __SITEROOT.'library/Models/org_ext_4.php';
 	    require_once __SITEROOT.'library/Models/org_ext_5.php';
 	    require_once __SITEROOT.'library/Models/org_ext_6.php';
 	    $this->view->basePath = __BASEPATH;
  	 }
  	 public function bedAction()
  	 {	
		$row=$this->getData_bed();
		$data=array();	
		$x_array=$row['x'];
		foreach ($row['archive'] as $k=>$v)
		{
		   $i=0;
		   foreach ($v as $m=>$n)
		   {
		   	   $data[$k][$i] = $n;
		   	   $data[$k]['axisname'] = $row['axisname'][$k];
		   	   $i++;
		   }
		}
		echo xml_draw_line($data,$x_array,"个数","床位","床位数",500,500);
  	 } 	 
  	 public function buildingAction()
  	 {	
		$row=$this->getData_building();
		$data=array();	
		$x_array=$row['x'];
		foreach ($row['archive'] as $k=>$v)
		{
		   $i=0;
		   foreach ($v as $m=>$n)
		   {
		   	   $data[$k][$i] = $n;
		   	   $data[$k]['axisname'] = $row['axisname'][$k];
		   	   $i++;
		   }
		}
		echo xml_draw_line($data,$x_array,"平方","房屋与建筑信息","房屋与建筑信息",500,500);
  	 }
  	 public function equipmentAction()
  	 {	
		$row=$this->getData_equipment();
		$data=array();	
		$x_array=$row['x'];
		foreach ($row['archive'] as $k=>$v)
		{
		   $i=0;
		   foreach ($v as $m=>$n)
		   {
		   	   $data[$k][$i] = $n;
		   	   $data[$k]['axisname'] = $row['axisname'][$k];
		   	   $i++;
		   }
		}
		echo xml_draw_line($data,$x_array,"台数","设备信息","设备信息",500,500);
  	 }
  	 /**
  	  * 床位信息
  	  *
  	  * @return unknown
  	  */
  	 public function getData_bed()
  	 {     
  	 	    $colum_array = array('bed_number'=>'编制床位数','poverty_beds'=>'扶贫床位数','observation_bed'=>'观察床','bed_allnumber'=>'实有床位数总数');
 	        $org_id = $this->user['org_id'];
 	        $i = 0;
 	        foreach ($colum_array as $k=>$v)
 	        {
 	        	$org_ext_1 = new Torg_ext_1();
 	            $org_ext_1->whereAdd("id='$org_id'");
 	            $org_ext_1->orderby("year ASC");
 	            $org_ext_1->find();
 	            $rowCount = 0;
 	            $row[$i] = array();
                while ($org_ext_1->fetch())
                {
                	$row['archive'][$i][$rowCount]= empty($org_ext_1->$k)?0:$org_ext_1->$k;
                	$row['x'][$rowCount]= $org_ext_1->year;
                	$rowCount++;
                }
                $row['axisname'][$i]= $v;
                $i++;
 	        }  
			return $row;
	}
	/**
	 * 建筑面积信息
	 *
	 * @return unknown
	 */
	public function getData_building()
  	 {     
  	 	    $colum_array = array('area'=>'房屋建筑面积','operation_area'=>'业务用房面积');
 	        $org_id = $this->user['org_id'];
 	        $i = 0;
 	        foreach ($colum_array as $k=>$v)
 	        {
 	        	$org_ext_2 = new Torg_ext_2();
 	            $org_ext_2->whereAdd("id='$org_id'");
 	            $org_ext_2->orderby("year ASC");
 	            $org_ext_2->find();
 	            $rowCount = 0;
 	            $row[$i] = array();
                while ($org_ext_2->fetch())
                {
                	$row['archive'][$i][$rowCount]= empty($org_ext_2->$k)?0:$org_ext_2->$k;
                	$row['x'][$rowCount]= $org_ext_2->year;
                	$rowCount++;
                }
                $row['axisname'][$i]= $v;
                $i++;
 	        }  
			return $row;
	}
	/**
	 * 设备数信息
	 */
	public function getData_equipment()
  	 {     
  	 	    $colum_array = array('equipment_total_number'=>'万元以上设备总数','five_equipment'=>'50-100万元设备数','over_100_equipment'=>'100万元以上设备数');
 	        $org_id = $this->user['org_id'];
 	        $i = 0;
 	        foreach ($colum_array as $k=>$v)
 	        {
 	        	$org_ext_3 = new Torg_ext_3();
 	            $org_ext_3->whereAdd("id='$org_id'");
 	            $org_ext_3->orderby("year ASC");
 	            $org_ext_3->find();
 	            $rowCount = 0;
 	            $row[$i] = array();
                while ($org_ext_3->fetch())
                {
                	$row['archive'][$i][$rowCount]= empty($org_ext_3->$k)?0:$org_ext_3->$k;
                	$row['x'][$rowCount]= $org_ext_3->year;
                	$rowCount++;
                }
                $row['axisname'][$i]= $v;
                $i++;
 	        }  
 	        //print_r($row);
			return $row;
	}
  }
?>