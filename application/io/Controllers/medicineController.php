<?php
//药品数据导入

class io_medicineController extends controller {
	public function init(){
		require_once (__SITEROOT."library/Models/medicine.php");
		require_once (__SITEROOT."library/Models/measures.php");
		require_once (__SITEROOT."library/Models/formulations.php");
		require_once (__SITEROOT."library/Models/coding_category.php");
		require_once (__SITEROOT."library/Models/specification.php");
		require_once (__SITEROOT."library/Models/clinic_code.php");//诊疗项目
		require_once (__SITEROOT."library/Models/materials.php");//卫生耗材编码
		require_once (__SITEROOT."library/Models/consumables_category.php");//卫生耗材分类
		require_once (__SITEROOT."library/Models/con_measures.php");//卫生耗材单位
		require_once (__SITEROOT."library/Models/con_specification.php");//卫生耗材规格
		require_once (__SITEROOT."library/Models/disease_category.php");//疾病分类编码	
		require_once (__SITEROOT."library/Models/disease_name.php");//疾病名称
		require_once __SITEROOT.'library/pinyin/pinyin.php';
		
	}
	//药品编码
	public function indexAction(){
		
		
		$file = fopen("e:/m.csv","r");
		$i=0;
		while($arr=fgetcsv($file)){
			$code=substr($arr[2],0,6);
			$coding_category=new Tcoding_category();
			$coding_category->whereAdd("standard_code='$code'");
			$coding_category->find(true);
			if($coding_category->code_id){
				$medicine=new Tmedicine();
				$medicine->uuid="m_".uniqid();
				$medicine->medicine_name=$arr[1];
				$medicine->medicine_code=$arr[0];
				$medicine->category_code=$coding_category->code_id;
				$py=@getPinyin($arr[1]);

				$medicine->en_name=$py;
				
				$medicine->standard_code=$arr[2];
				$medicine->insert();
				
			
			}
		}
		echo "完毕";
		fclose($file);
	}
	//药品单位
	public function measuresAction(){
		
		$file=fopen("e:/coding_measures.csv","r");
		while($arr=fgetcsv($file)){
		//print_r($arr);
			$coding_measures=new Tmeasures();
			$coding_measures->uuid="m_".uniqid();
			$coding_measures->measure_code=$arr[0];
			$coding_measures->measure_name=$arr[1];
			$coding_measures->measure_en=@getPinyin($arr[1]);
			$coding_measures->insert();
		}
		fclose($file);
	}
	
	//药品规格
	public function  specificationAction(){
		$file=fopen("e:/medicine/guige.csv","r");
		while($arr=fgetcsv($file)){
		
			$specification=new Tspecification();
			$specification->uuid="m_".uniqid();
			$specification->specification_name=$arr[1];
			$specification->specification_code=$arr[0];
			$specification->specification_en=@getPinyin($arr[1]);
			$specification->insert();
		
	}
	echo "完毕";
	}
	//药品剂型
	public function formulationsAction(){
		$file=fopen("e:/medicine/jixin.csv","r");
		fgetcsv($file);
		while($arr=fgetcsv($file)){
			$formulations=new Tformulations();
			$formulations->uuid="m_".uniqid();
			$formulations->formulations_name=$arr[1];
			$formulations->formulations_code=$arr[0];
			$formulations->formulations_en=@getPinyin($arr[1]);
			$formulations->insert();
		}echo "完毕";	
	}
	//诊疗项目
	public function clinicAction(){
	
	//step 1 导入第一级数据
	$file=fopen("e:/medicine/clinic.csv","r");	
		while($arr=fgetcsv($file)){	
			//查找第一级	
			if(strlen($arr[0])==1)	
			{   
				//取出最大id值	
				$clinic=new Tclinic_code();	
				$clinic->orderby("id desc");	
				//$clinic->whereAdd("id is not null");	
				//$clinic->debug(1);	
				$clinic->find(true);	
				$id=$clinic->id+1;	
				//写入数据	
				$clinic=new Tclinic_code();	
				$clinic->uuid="c_".uniqid();	
				$clinic->id=$id;	
				$clinic->zh_name=$arr[1];	
				$clinic->path="1,".$clinic->id.",";	
				$clinic->p_id=1;	
				$clinic->standard_code=$arr[0];	
				$clinic->insert();	
			}	
				
		}	
	fclose($file);	
	
	
	//step 2 导入第二级数据
	$file=fopen("e:/medicine/clinic.csv","r");
			while($arr=fgetcsv($file)){
				if(strlen($arr[0])==3)
				{   
					//取出最大id值
					$clinic=new Tclinic_code();
					$clinic->orderby("id desc");
					$clinic->find(true);
					$id=$clinic->id+1; 
					//取出父级id
					$p_standard_code=substr($arr[0],0,1); 
					$clinic=new Tclinic_code();
					$clinic->whereAdd("standard_code='$p_standard_code'");
					$clinic->find(true);
					$p_id=$clinic->id;
					$path=($clinic->path).$id.",";
					//写入数据
					$clinic=new Tclinic_code();
					$clinic->uuid="c_".uniqid();
					$clinic->id=$id;
					$clinic->zh_name=$arr[1];
					$clinic->path=$path;
					$clinic->p_id=$p_id;
					$clinic->standard_code=$arr[0];
					$clinic->insert();
				}
				
			}
		fclose($file);	
	
	
	//step 3 导入第三级数据
	$file=fopen("e:/medicine/clinic.csv","r");
			while($arr=fgetcsv($file)){
				if(strlen($arr[0])==5)
				{   
					//取出最大id值
					$clinic=new Tclinic_code();
					$clinic->orderby("id desc");
					$clinic->find(true);
					$id=$clinic->id+1; 
					//取出父级id
					$p_standard_code=substr($arr[0],0,3); 
					$clinic=new Tclinic_code();
					$clinic->whereAdd("standard_code='$p_standard_code'");
					$clinic->find(true);
					$p_id=$clinic->id;
					$path=($clinic->path).$id.",";
					//写入数据
					$clinic=new Tclinic_code();
					$clinic->uuid="c_".uniqid();
					$clinic->id=$id;
					$clinic->zh_name=$arr[1];
					$clinic->path=$path;
					$clinic->p_id=$p_id;
					$clinic->standard_code=$arr[0];
					$clinic->insert();
				}
				
			}
		fclose($file);	
	
	
	
	//step 4 导入第四级数据
	$file=fopen("e:/medicine/clinic.csv","r");
			while($arr=fgetcsv($file)){
				if(strlen($arr[0])==6)
				{   
					//取出最大id值
					$clinic=new Tclinic_code();
					$clinic->orderby("id desc");
					$clinic->find(true);
					$id=$clinic->id+1; 
					//取出父级id
					$p_standard_code=substr($arr[0],0,5); 
					$clinic=new Tclinic_code();
					$clinic->whereAdd("standard_code='$p_standard_code'");
					$clinic->find(true);
					$p_id=$clinic->id;
					$path=($clinic->path).$id.",";
					//写入数据
					$clinic=new Tclinic_code();
					$clinic->uuid="c_".uniqid();
					$clinic->id=$id;
					$clinic->zh_name=$arr[1];
					$clinic->path=$path;
					$clinic->p_id=$p_id;
					$clinic->standard_code=$arr[0];
					$clinic->insert();
				}
				
			}
		fclose($file);	
	
	
	//step 4 导入第五级数据
	$file=fopen("e:/medicine/clinic.csv","r");
			while($arr=fgetcsv($file)){
				if(strlen($arr[0])==11)
				{   
					//取出最大id值
					$clinic=new Tclinic_code();
					$clinic->orderby("id desc");
					$clinic->find(true);
					$id=$clinic->id+1; 
					//取出父级id,如果在6位代码中找不到则在5位代码中寻找,如果还没找到则在3位代码中寻找
					$p_standard_code=substr($arr[0],0,6); 
					$clinic=new Tclinic_code();
					$clinic->whereAdd("standard_code='$p_standard_code'");
					if($clinic->count()<1){
						$p_standard_code=substr($arr[0],0,5); 
					}
					$clinic=new Tclinic_code();
					$clinic->whereAdd("standard_code='$p_standard_code'");
					if($clinic->count()<1) {
						$p_standard_code=substr($arr[0],0,3); 
					}
					$clinic=new Tclinic_code();
					$clinic->whereAdd("standard_code='$p_standard_code'");
					$clinic->find(true);
					$p_id=$clinic->id;
					$path=($clinic->path).$id.",";
					//写入数据
					$clinic=new Tclinic_code();
					$clinic->uuid="c_".uniqid();
					$clinic->id=$id;
					$clinic->zh_name=$arr[1];
					$clinic->path=$path;
					$clinic->p_id=$p_id;
					$clinic->standard_code=$arr[0];
					$clinic->insert();
				}
				
			}
		fclose($file);	
	
	}
	//卫生耗材单位
	public function con_measuresAction(){
		$file=fopen("e:/medicine/hcdw.csv","r");
		fgetcsv($file);
		while($arr=fgetcsv($file)){
			$con_measures=new Tcon_measures();
			$con_measures->uuid="m_".uniqid();
			$con_measures->measure_name=$arr[1];
			$con_measures->measure_code=$arr[0];
			$con_measures->measure_en=getpinyin($arr[1]);
			$con_measures->insert();
		}
		fclose($file);
	}
	
	//卫生耗材规格
	public function con_specificationAction(){
		$file=fopen("e:/medicine/hcgg.csv","r");
		fgetcsv($file);
		while($arr=fgetcsv($file)){
			$con_specification=new Tcon_specification();
			$con_specification->uuid="m_".uniqid();
			$con_specification->specification_name=$arr[1];
			$con_specification->specification_code=$arr[0];
			$con_specification->specification_en=getpinyin($arr[1]);
			$con_specification->insert();
		}
		fclose($file);
	}
	//卫生耗材编码
	public function materialsAction(){
		$file=fopen("e:/medicine/hcbm.csv","r");
		while($arr=fgetcsv($file)){
			if(!empty($arr[2])){
				$cat1=substr($arr[2],0,1);
				$cat2=substr($arr[2],1,2);
				//取出一级分类
				$consumables_category=new Tconsumables_category();
				$consumables_category->whereAdd("standard_code='$cat1'");
				$consumables_category->find(true);
				$cat1_id=$consumables_category->id;
				
				//取出二级分类
				$consumables_category=new Tconsumables_category();
				$consumables_category->whereAdd("standard_code='$cat2'");
				$consumables_category->find();
				//确定当前二级分类是否在该一级分类下
				while($consumables_category->fetch())
				{
					if($cat1_id==$consumables_category->p_id)
					$path=$consumables_category->path;
				}
				
				//如果找到了分类，创建插入对象
				if(!empty($path)){
					$materials=new Tmaterials();
					$materials->uuid="m_".uniqid();
					$materials->name_encod=$arr[0];
					$materials->zh_name=$arr[1];
					$materials->standard_code=$arr[2];
					$materials->path=$path;
					$materials->measure=substr($arr[2],-4,2);
					$materials->format=substr($arr[2],-8,4);
					$materials->domestic=substr($arr[2],-2,1);
					$materials->medicare=substr($arr[2],-1,1);
					$materials->en_name=getpinyin($arr[1]);
					$materials->insert();
					
				}
				
			}
		}
		fclose($file);
	}
	//疾病分类
	public function disease_categoryAction(){
		$file=fopen("e:/medicine/jbfl.csv","r");
		if(!$file) die("没有找到文件");
		fgetcsv($file);
		while($arr=fgetcsv($file)){
		   
			$disease_category=new Tdisease_category();
			$disease_category->uuid="d_".uniqid();
			$disease_category->zh_name=$arr[2];
			$disease_category->standard_code=$arr[0];
			$disease_category->pinyin=getpinyin($arr[2]);
			$disease_category->insert();
			
		}
		fclose($file);
		echo ("疾病分类导入完毕");
	}
	//疾病名称
	public function disease_nameAction(){
		$file=fopen("e:/medicine/jbbm.csv","r");
		while($arr=fgetcsv($file)){
			
			$disease_category=new Tdisease_category();
			$standard_code=substr($arr[0],0,3);
			$disease_category->whereAdd("standard_code='$standard_code'");
			if($disease_category->count()>0){
			$disease_category->find(true);
			$disease_name=new Tdisease_name();
			$disease_name->category_id=$disease_category->uuid;
			$disease_name->uuid="d_".uniqid();
			$disease_name->d_zh_name=$arr[1];
			$disease_name->d_standard_code=$arr[0];
			$disease_name->insert();
			}
		}
		fclose($file);
		echo "导入完毕";
	}
	
	public function testAction(){
		$file=fopen("e:/medicine/hcbm.csv","r");
		$i=0;
		while($arr=fgetcsv($file)){
		   if(empty($arr[2])){
		   print_r($arr);
		   }
		   else{
		   continue;
		   }
			$materials=new Tmaterials();
			$materials->whereAdd("STANDARD_CODE='$arr[2]'");
			if($materials->count()<1)
			{
			echo $i;
			print_r($arr);
			echo "<br/>";
			}
			$i++;
		}
		fclose($file);
	}
	
}
?>