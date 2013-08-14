<?php
/**
 * @author ct
 * @todo 机构信息的接口
 */
class api_org_ext
{
	public  $org_ext_table;
	public function __construct()
	{
		require_once __SITEROOT."library/Models/chs_center.php";
		require_once __SITEROOT."library/Models/organization.php";
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT."library/Models/org_ext_1.php";
		require_once __SITEROOT."library/Models/org_ext_2.php";
		require_once __SITEROOT."library/Models/org_ext_3.php";
		require_once __SITEROOT."library/Models/org_ext_4.php";
		require_once __SITEROOT."library/Models/org_ext_5.php";
		require_once __SITEROOT."library/Models/org_ext_6.php";
		$this->org_ext_table= array(1=>'chs_center',2=>'org_ext_1',3=>'org_ext_2',4=>'org_ext_3',5=>'org_ext_4',6=>'org_ext_5',7=>'org_ext_6');
		$this->org_comment = array(1=>'机构基本信息',2=>'机构床位信息',3=>'机构房屋与建筑信息',4=>'机构设备信息',5=>'机构收入与支出信息',6=>'机构资产与负债信息',7=>'机构资源信息');
	}
	/**
	 * 取得机构的资源信息
	 * $this->org_comment = array(1=>'机构基本信息',2=>'机构床位信息',3=>'机构房屋与建筑信息',4=>'机构设备信息',5=>'机构收入与支出信息',6=>'机构资产与负债信息',7=>'机构资源信息');代表哪个类别的数据信息
	 * 形如：
	 * $xml_string = "<?xml version='1.0' encoding='UTF-8'?><where><org_id>组织机构编码</org_id><number>代表获取的哪个类别的信息</number></where>";
	 * @param string $token
	 * @param string $xml_string
	 * @return string
	 */
	public function  hospital_info($token,$xml_string)
	{   
		$errorstring = '';
		$returnstring = "<?xml version='1.0' encoding='UTF-8'?><message>";
		$error_number = 0;
		$success_number = 0;
		$getxml = new SimpleXMLElement($xml_string);
		$org_id = $getxml->org_id;//xml中的机构id号
		$status_tag = $getxml->number;//标志
		if(!empty($org_id)&&in_array($status_tag,array(1,2,3,4,5,6,7)))
		{
			//2个条件同时需要有 机构标准码和机构信息的标志
			$organization = new Torganization();
			$organization->whereAdd("standard_code='$org_id'");
			if($organization->count()!=0)
			{
				$organization->find(true);
				$table_org_id = $organization->id;//数据表中所对应的id
				//机构存在的情况
				foreach ($this->org_ext_table as $k=>$v)
				{

					if($k==$status_tag)
					{
						if($k==1)
						{ 
						    $colum_name = 'chsc_id';
						    //需要排除的字段
						    $exclude_array = array('created','updated','chsc_id','street');
						}
						else 
						{
							$colum_name = 'id';
							$exclude_array = array('id');
						}
						$org_info_table = 'T'.$v;
						$org_info_obj = new $org_info_table();
						$org_info_obj->whereAdd("$colum_name = '$table_org_id'");
						if($org_info_obj->count()>0)
						{
							//存在数据的时候
							$org_info_obj->find();
							$returnstring.= "<return_code>1</return_code><tables><table name='$v'><rows>";
							while ($org_info_obj->fetch())
							{
								$returnstring.='<row><org_id>'.$org_id.'</org_id>';
								$returnstring.=$org_info_obj->toXML("",$exclude_array);
								$returnstring.='</row>';
							}
							$returnstring.='</rows></table></tables></message>';
						}
						else 
						{
							$errorstring.=$this->org_comment[$k]."目前还没有数据";
				            $returnstring.='<return_code>2</return_code><errorstring>'.$errorstring.'</errorstring></message>';
						}
					}
				}
			}
			else 
			{
				$errorstring.="机构标准码为".$org_id."的机构不存在";
				$returnstring.='<return_code>2</return_code><errorstring>'.$errorstring.'</errorstring></message>';
			}
		}
		else 
		{
			$errorstring.="机构标准码或者所需查询的逻辑处理编号为空或者不正确";
			$returnstring.='<return_code>2</return_code><errorstring>'.$errorstring.'</errorstring></message>';
		}
		return $returnstring;
	}
	/**
	 * 机构资源信息的添加或修改
	 * @param string $token
	 * @param string $xml_string
	 * @return string
	 * 首先判断机构标准码是否存在 要判断这个机构下边的这个年份的数据是否存在（存在不能让其再添加），修改的时候不要更新年份
	 */
	public function ws_update($token,$xml_string)
	{
		$errorstring   = '';
		$successstring = '';
		$returnstring = "<?xml version='1.0' encoding='UTF-8'?><message><tables>";
		$returnstring_end = '</tables></message>';
		$error_number = 0;
		$success_number = 0;
		$getxml = new SimpleXMLElement($xml_string);
		foreach($getxml as $k=>$table)
		{		
			//chs_center表中的数据
			if($table['name']=='chs_center')
			{	
				$table_string_start= "<table name='chs_center'>";
				foreach ($table as $row)
				{
					$except_array = array('org_id');
					$table_name_t = 'T'.$table['name'];
					$table_obj = new $table_name_t();
					if(empty($row->ext_uuid))
					{
						$error = 2;
						//业务号
						$errorstring.="<row><return_code>".$error."</return_code><return_string>数据业务号不能为空</return_string></row>";
						$error_number++;
						continue;
					}
					else 
					{
						//var_dump($table);
						if(empty($row->org_id))
						{
							$error = 2;
							//机构标准码为空
							$errorstring.="<row><return_code>".$error."</return_code><return_string>组织机构编码不能为空</return_string></row>";
							$error_number++;
							continue;
						}
						else 
						{
							$organization = new Torganization();
							$organization->whereAdd("standard_code='$row->org_id'");
							$organization->find(true);
							if($organization->count()<1)
							{
								$error = 2;
								//不存在机构标准码的时候
								$errorstring.="<row><return_code>".$error."</return_code><return_string>机构不存在</return_string></row>";
								$error_number++;
								continue;
							}
							else 
							{
								//数据年限为空
								if(empty($row->year))
								{
									$error = 2;
									$errorstring.="<row><return_code>".$error."</return_code><return_string>数据年限不能为空</return_string></row>";
									$error_number++;
									continue;
								}
								else 
								{
									$chs_center = new Tchs_center();
									$chs_center->whereAdd("ext_uuid='$row->ext_uuid'");
									$chs_center->whereAdd("chsc_id'$organization->id'");
									$chs_center->whereAdd("year='$row->year'");
									$all_number = $chs_center->count();
									$table_obj->chsc_id  = $organization->id;
									$table_obj->org_code = $row->org_id;
									//echo $row->address;
									//数据年限存在的情况(需要对数据进行判断重复)
									foreach ($row as $colum=>$value)
									{  
										$table_obj->$colum = $value;
										$table_obj->created = strtotime($row->created);
										$table_obj->updated = strtotime($row->updated);
										$table_obj->build_date = strtotime($row->build_date);
										if(in_array($colum,$except_array))
									    {
											unset($table_obj->$colum);
									    }
									}
									if($all_number>0)
									{
										unset($table_obj->ext_uuid);//更新的时候不需要更新ext_uuid
										$table_obj->whereAdd("ext_uuid='$row->ext_uuid'");
										$table_obj->whereAdd("year='$row->year'");
										$table_obj->whereAdd("chsc_id='$organization->id'");
										//更新
										if($table_obj->update())
										{
											$error = 1;
											$successstring.="<row><return_code>".$error."</return_code><org_id>".$row->org_id."</org_id><ext_uuid>".$row->ext_uuid."</ext_uuid><year>".$row->year."</year><return_string>数据更新成功</return_string></row>";
											$success_number++;
										}
										else 
										{
											$error = 2;
											$errorstring.="<row><return_code>".$error."</return_code><org_id>".$row->org_id."</org_id><ext_uuid>".$row->ext_uuid."</ext_uuid><year>".$row->year."</year><return_string>数据更新失败</return_string></row>";
											$error_number++;
											continue;
										}	
									}
									else 
									{
										//添加
										if($table_obj->insert())
										{
											$error = 1;
											$successstring.="<row><return_code>".$error."</return_code><org_id>".$row->org_id."</org_id><ext_uuid>".$row->ext_uuid."</ext_uuid><year>".$row->year."</year><return_string>数据插入成功</return_string></row>";
											$success_number++;
										}
										else 
										{
											$error = 2;
											$errorstring.="<row><return_code>".$error."</return_code><org_id>".$row->org_id."</org_id><ext_uuid>".$row->ext_uuid."</ext_uuid><year>".$row->year."</year><return_string>数据插入失败</return_string></row>";
											$error_number++;
											continue;
										}
									}
								}
							}
						}
					}
				}
				$table_string_end="</table>";
				$returnstring.=$table_string_start.$successstring.$errorstring.$table_string_end;
			}
		}
		//return $returnstring;
		$c_tabe_start = '';
		$c_tabe_end = '';
		$return_c = '';
		$errorstring_c = '';
		$successstring_c = '';
		//从表数据的操作
		$c_table_array = array('org_ext_1','org_ext_2','org_ext_3','org_ext_4','org_ext_5','org_ext_6');
		foreach ($getxml as $k=>$table)
		{
			$table_name = $table['name'];
					
			if(in_array($table_name,$c_table_array))
			{
				$c_tabe_start = "<table name='".$table_name."'>";
				//echo $table_name;
				//var_dump($table)
				foreach ($table as $row)
				{	
					//主表中不存在数据
					if(empty($row->org_id))
					{
						$error=2;
						$errorstring_c.="<row><return_code>".$error."</return_code><return_string>机构标准码不能为空</return_string></row>";
						$error_number++;
						continue;
					}
					$organization = new Torganization();
					$organization->whereAdd("standard_code='$row->org_id'");
					$organization->find(true);
					$org_id = $organization->id;
					//判断当前这条数据在chs_center中是否存在
					$chs_center_b = new Tchs_center();
					$chs_center_b->whereAdd("year='$row->year'");
					$chs_center_b->whereAdd("chsc_id='$org_id'");
					if($chs_center_b->count()>0)
					{
						//判断是否存在ext_uuid
						if(empty($row->ext_uuid))
						{
							$error=2;
							$errorstring_c.="<row><return_code>".$error."</return_code><return_string>数据业务号不能为空</return_string></row>";
							$error_number++;
							continue;
						}
						else 
						{
							$table_obj_name = 'T'.$table_name;
							$table_obj = new $table_obj_name();
							//对所需数据进行搜集
							foreach($row as $colum=>$v)
							{
								$table_obj->$colum = $v;
							}
							//org_ext_1床位信息中的病床使用率要用程序计算出来
							if($table_name=='org_ext_1')
							{
								$percent = (floor($row->totalbed_days/$row->occupied_bed)*100).'%';
								$table_obj->percentage = $percent;
							}
							unset($table_obj->org_id);
							$table_obj->id = $org_id;
							$table_obj->whereAdd("year='$row->year'");
							$table_obj->whereAdd("id='$org_id'");
							$table_obj->whereAdd("ext_uuid='$row->ext_uuid'");
							if($table_obj->count()>0)
							{
								//更新
								if($table_obj->update())
								{
									$error = 1;
									$successstring_c.="<row><return_code>".$error."</return_code><org_id>".$row->org_id."</org_id><ext_uuid>".$row->ext_uuid."</ext_uuid><year>".$row->year."</year><return_string>数据更新成功</return_string></row>";
									$success_number++;
								}
								else 
								{
									$error = 2;
									$errorstring_c.="<row><return_code>".$error."</return_code><org_id>".$row->org_id."</org_id><ext_uuid>".$row->ext_uuid."</ext_uuid><year>".$row->year."</year><return_string>数据更新失败</return_string></row>";
									$error_number++;
									continue;
								}	
							}
							else 
							{
								//插入数据
								if($table_obj->insert())
								{
									$error = 1;
									$successstring_c.="<row><return_code>".$error."</return_code><org_id>".$row->org_id."</org_id><ext_uuid>".$row->ext_uuid."</ext_uuid><year>".$row->year."</year><return_string>数据插入成功</return_string></row>";
									$success_number++;
								}
								else 
								{
									$error = 2;
									$errorstring_c.="<row><return_code>".$error."</return_code><org_id>".$row->org_id."</org_id><ext_uuid>".$row->ext_uuid."</ext_uuid><year>".$row->year."</year><return_string>数据插入失败</return_string></row>";
									$error_number++;
									continue;
								}
							}
						}
					}
					else 
					{
						//主表中不存在数据
						$error=2;
						$errorstring_c.="<row><return_code>".$error."</return_code><return_string>chs_center中不存在基本信息，请先插入基本信息</return_string></row>";
						$error_number++;
						//return '222';
						continue;
					}
				}
				$c_tabe_end ='</tbale>';
				$returnstring.=$c_tabe_start.$successstring_c.$errorstring_c.$c_tabe_end;
			}	
			
		}
		
		return $returnstring.'<return_string>有'.$success_number.'条数据插入或者更新成功,有'.$error_number.'条数据插入或者更新失败</return_string>'.$returnstring_end;
	}
	/**
	 * 用于删除某条数据或者某个从表中的数据
	 * 
	 */
	public function ws_delete($token,$xml_string)
	{
		$errorstring   = '';
		$successstring = '';
		$returnstring = "<?xml version='1.0' encoding='UTF-8'?><message>";
		$returnstring_end = '</message>';
		$error_number = 0;
		$success_number = 0;
		$getxml = new SimpleXMLElement($xml_string);
		foreach ($getxml as $k=>$table)
		{
			foreach ($table->rows as $k=>$v)
			{
				$i =1;
				foreach ($v as $key=>$val)
				{	
					if(empty($val->org_id))
					{
						$error = 2;
						$errorstring.='<return_code></return_code>第'.$i.'条数据组织机构代码为空';
						$error_number++;
						$i++;
						continue;
					}
					if(empty($val->year))
					{
						$error = 2;
						$errorstring.='第'.$i.'条机构资源数据年限为空';
						$error_number++;
						$i++;
						continue;
					}
					//取得真正的机构id
					$organization = new Torganization();
					$organization->whereAdd("standard_code='$val->org_id'");
					if($organization->count()>0)
					{
						$organization->find(true);	
						//进行删除操作
						$table_arry = array('chs_center','org_ext_1','org_ext_2','org_ext_3','org_ext_4','org_ext_5','org_ext_6');
						
					}
					else 
					{
						$error = 2;
						$errorstring.='第'.$i.'条机构资源数据提供的机构组织代码所对应的机构不存在<br />';
						$error_number++;
						$i++;
						continue;
					}
					$i++;
				}
			}
		}
		return $errorstring;
	}
}
?>