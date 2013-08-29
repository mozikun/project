<?php

/*
 * 居民核心表的比对
 */

class cmp_indexController
{
    
	public function init(){
	
		require_once __SITEROOT."library/Models/individual_core.php";	
		require_once __SITEROOT."library/Models/hjxx_czrkjbxxb.php";	
		require_once __SITEROOT."library/Models/xt_jlxxxb_all.php";	
		require_once __SITEROOT."library/Models/xt_xzqhb.php";	
		require_once __SITEROOT."library/Models/organization.php";	
		require_once(__SITEROOT.'library/Models/region.php');	
	}
    public function indexAction()
    {   
		require_once __SITEROOT."library/Models/individual_core.php";	
		require_once __SITEROOT."library/Models/hjxx_czrkjbxxb.php";	
		require_once __SITEROOT."library/Models/xt_jlxxxb_all.php";	
		require_once __SITEROOT."library/Models/xt_jlxxxb.php";	
		require_once __SITEROOT."library/Models/xt_xzqhb.php";	
		$core=new Tindividual_core();
		$hjxx=new Thjxx_czrkjbxxb(2);
		$hjxx->whereAdd("ssxq=511821");//查找名山县的人口
		$hjxx->orderby("jlx asc");
		$hjxx->find();
		$i=0;

		while($hjxx->fetch()){
		    $lower_id=strtolower($hjxx->gmsfhm);
			$core->where("identity_number='$hjxx->gmsfhm' or identity_number='$lower_id' ");
			//$core->debug(1);
			if($core->count()==0){
			
				$base_info=new Thjxx_czrkjbxxb(2);
				$jlx=new Txt_jlxxxb(2);
				$xq=new Txt_xzqhb(2);
				$base_info->whereAdd("gmsfhm='$hjxx->gmsfhm'");
				$base_info->joinAdd("inner",$base_info,$jlx,"jlx","dm");
				$base_info->joinAdd("inner",$base_info,$xq,"ssxq","dm");
				$base_info->find(true);
				if(!empty($jlx->mc)){
				$i+=1;
				$arr=array();
				$arr['name']=$base_info->xm;
				$arr['id']="'$base_info->gmsfhm'";
				$arr['sex']=($base_info->xb=='1')?"男":"女";
				$arr['mz']=($base_info->mz=='01')?"汉":"不详";
				$arr['address']=$xq->mc.$jlx->mc.$base_info->mlph.$base_info->mlxz;
				$file=fopen("e:/data/yaan_no_have.csv","a+");
				fputcsv($file,$arr);
				//print_r($arr);
				fclose($file);
				//print_r($base_info->toArray());echo "<br/>";
				//print_r($jlx->toArray());echo "<br/>";
				//print_r($xq->toArray());echo "<br/>";
				if($i>5000){
					echo $i;
					exit();
				}
				}
				
			}
			
		}
		
	 
     }
	 
	public function testAction(){
		$test=new Tregion();
		$test->query("SELECT COLUMN_NAME as name, COMMENTS as comment FROM user_col_comments WHERE TABLE_NAME = 'SCHIZOPHRENIA'");
		while($test->fetch()){
			echo $test->name;
		}
	} 
}

?>