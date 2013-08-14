<?
require_once "color_schema.php";

//date_default_timezone_set('PRC');//设定时区



function backup_data($table,$field,$value)
{
	
}//备份要删除的数据
function calender($year='',$month='',$day='',$controler='',$type='date',$hour='',$minute='',$second='')
{
	if($year==1999)
	{
		$year=date('Y');
		$month=date('m');
		$day=date('d');
	}
	//echo $year.$month.$day;
	//必须要区别不同的下拉框名称，因为同一界面上有多个框存在
	$control_name=$controler.'calender_year';
	echo  "<select name=$control_name id=$control_name onchange=\"gen_canlender('".$controler."','".$type."')\">";
	for($i=1900;$i<=2030;$i++)
	{
		$select_value=$i;
		$select_display_value=$i;
		if($select_value==$year)
		{
			echo  "<option value='$select_value' selected>$select_display_value</option>";
		}
		else
		{
			echo  "<option value=$select_value>$select_display_value</option>";
		}
		
	}
	echo "</select>";
	$control_name=$controler.'calender_month';
	echo  "<select name=$control_name id=$control_name onchange=\"gen_canlender('".$controler."','".$type."')\">";
	for($i=1;$i<=12;$i++)
	{
		if($i<=9)
		{
			$select_value='0'.$i;
			$select_display_value='0'.$i;
		}
		else
		{
			$select_value=$i;
			$select_display_value=$i;
		}
		if($select_value==$month)
		{
			echo  "<option value='$select_value' selected>$select_display_value</option>";
		}
		else
		{
			echo  "<option value=$select_value>$select_display_value</option>";
		}
		
	}
	echo "</select>";
	$control_name=$controler.'calender_day';
	echo  "<select name=$control_name id=$control_name onchange=\"gen_canlender('".$controler."','".$type."')\">";
	for($i=1;$i<=31;$i++)
	{
		if($i<=9)
		{
			$select_value='0'.$i;
			$select_display_value='0'.$i;
		}
		else
		{
			$select_value=$i;
			$select_display_value=$i;
		}
		if($select_value==$day)
		{
			echo  "<option value='$select_value' selected>$select_display_value</option>";
		}
		else
		{
			echo  "<option value=$select_value>$select_display_value</option>";
		}
		
	}
	echo "</select>";
	//在PHP代码中嵌入JavaScript代码时注意其中最好不要有注释，因为这样会将注释行后的所有行也给注释掉，导致出错
	echo "<script language=\"JavaScript\">";
	echo "function gen_canlender(controler,type)";
	echo "{";
		echo "obj_controler=document.all(controler);";
		echo "obj_year=document.all(controler+'calender_year');";
		echo "obj_month=document.all(controler+'calender_month');";
		echo "obj_day=document.all(controler+'calender_day');";
		echo "month=obj_month.options[obj_month.selectedIndex].value;";
		echo "day=obj_day.options[obj_day.selectedIndex].value;";
		echo "if(month=='02' && day>'28')";
		echo "{";
			echo "alert('2月份的日期有错,数据无法正确保存。');";
			//echo "alert(obj_day.selectedIndex);";
			echo "obj_day.selectedIndex=0;";
			//echo "obj_day.options[obj_day.selectedIndex].value;";
		echo "}";
		echo "if((month=='04' || month=='06' || month=='09'  ||  month=='11') && day>'30')";
		echo "{";
			echo "alert('该月为小月，日期有错,数据无法正确保存。');";
			echo "obj_day.selectedIndex=0;";
		echo "}";

		
		echo "if(type=='date')";
		echo "{";
			echo "obj_controler.value=obj_year.options[obj_year.selectedIndex].value+'-'+obj_month.options[obj_month.selectedIndex].value+'-'+obj_day.options[obj_day.selectedIndex].value+' '+'00:00:00';";
		echo "}";
		//echo "alert(obj_controler.value);";
	echo "}";
	echo "</script>";
	
}


function check_news_exist($news_id)
{
	$table='news_main';
	$query_string="select * from $table where id='".$news_id."'";
	$rs=mysql_query($query_string);
	//echo "record ".mysql_num_rows($rs);
	if(mysql_num_rows($rs)<=0)//用户对像表中没有数据，则表示此信息并不存在或是已被删除
	{
		return false;
	}
	else
	{
		return true;
	}

}

function check_news_reader($news_id,$staff_id)
{
	$table='news_reader';
	$query_string="select * from $table where news_id='".$news_id."'";
	$rs=mysql_query($query_string);
	//echo mysql_num_rows($rs);
	if(mysql_num_rows($rs)<=0)//用户对像表中没有数据，则表示此信息是对公
	{
		return true;
	}
	//用户对像表中有数据，但此用户没有登陆，也退出
	if(mysql_num_rows($rs)>0  and empty($staff_id))
	{
		return false;
	}
	//echo "pass";
	//exit();
	while($row=mysql_fetch_array($rs))
	{
		if($staff_id==$row[staff_id])
		{
			return true;
		}
		$table='organization';
		$organization_id=(get_organization_id_by_staff_id($staff_id));		
		$root_id=get_root_id($table);
		//echo $organization_id."  ".$root_id;
		$family_tree=family_tree($table,$organization_id,$root_id);
		//print_r($family_tree[0]);
		//echo "<br>";
		//print_r($family_tree[1]);
		if(is_parent($table,$organization_id,$row[organization_id]) and $row[staff_id]=='全部')
		{
			return true;
		}
	}
	
	return false;
	//用户存在

}//检查一个人是否具有本信息的查看权限


function family_tree($table,$id,$end_id)//从下到上取得family_tree
{
	$family_tree=array();//注意一定要定义为数组
	//get_all_parent_id($table,$id,$end_id,&$family_tree);
	get_all_parent_id($table,$id,$end_id,$family_tree);
	return $family_tree;
}//从下到上取得family_tree
function field_exist($table,$field,$link)
{
	//开关参数
	$exist=false;
	$query_string = "show columns from  $table";
	$rs = mysql_query($query_string);
	while ($row = mysql_fetch_row($rs))
	{
		if($field==$row[0])
		{
			//如果指定字段存在
			$exist=true;
		}
	}
	return $exist;
}//判断指定的字段是否存在
function generate_child_parent_table($table,$id='')
{
	$query_string="delete from child_parent where table_name='$table'";
	mysql_query($query_string);
	$query_string="select * from $table";
	//echo $query_string."<br>";
	$rs=mysql_query($query_string);
	while ($row=mysql_fetch_array($rs)) 
	{
		$id=$row[id];
		$original_id=$row[id];
		$parent_id=$row[parent_id];
		generate_child_parent($original_id,$id,$parent_id,$table);
	}
}//生成有冗余的层次表
function generate_child_parent($original_id,$id,$parent_id,$table)
{
	
	if($id==get_root_id($table))//已到最高层,此时的ID与parent_id是一样的了，都是000000
	{
		if($original_id==get_root_id($table))//如果是根结点自身，则插入，否则直接返回
		{
			$query_string="insert into child_parent(id,parent_id,table_name) values('$original_id','$parent_id','$table')";
			//echo $query_string."<br>";
			mysql_query($query_string);
		}
		return true;
	}
	else
	{
		$query_string="insert into child_parent(id,parent_id,table_name) values('$original_id','$parent_id','$table')";
		//echo $query_string."<br>";
		mysql_query($query_string);
		$query_string="select * from $table where id='$parent_id'";
		$rs=mysql_query($query_string);
		$row=mysql_fetch_array($rs);
		$id=$row[id];
		//$original_id=$row[id];
		$parent_id=$row[parent_id];
		//完成本级的数据插入后开始递归
		generate_child_parent($original_id,$id,$parent_id,$table);
		return true;
	}

}//在生成冗余表中的递归函数
function get_acl_staff_list($table_name,$id,$type='staff_name')
{
	$staff_list='';
	$query_string="select * from acl_management where table_name='$table_name' and id='$id'";
	//echo $query_string;
	$rs=mysql_query($query_string);

	while($row=mysql_fetch_array($rs))
	{
		if($type=='staff_name')
		{
			$staff_list=$staff_list.get_staff_name($row[staff_id]).":";
		}
		if($type=='staff_id')
		{
			$staff_list=$staff_list.$row[staff_id].":";
		}
	}
	$staff_list=substr($staff_list,0,strlen($staff_list)-1);//去尾部逗号，在本模块中只能用这种方法去掉末尾逗号
	
	return $staff_list;
}//多管理员列表，对于知识库这类表，一个知识项可有多个操作员，因为此函数可返回所有的操作员
function get_acl_authority($table_name,$id,$acl_staff_id,$type='edit_or_audit',$recursion='no')
{
	/*
		$recursion='no' 不递归仅判断当是否对当前记录有操作权限
		$recursion='yes' 递归判断当是否对当前记录或是其父记录有操作权限
		$type='edit or andit' 判断只要有其中一种权限即可
		$type='edit and  andit' 判断同时具有这两种权限
		$type='edit' 判断是否具有编辑权限
		$type='andit' 判断是否具有审核权限
	*/
	if($recursion=='no')
	{
		$query_string="select * from acl_management where table_name='$table_name' and id='$id' and staff_id='$acl_staff_id'";
		$rs=mysql_query($query_string);
		//echo mysql_num_rows($rs);
		if(mysql_num_rows($rs)==0)
		{
			return 0;
		}
		$row=mysql_fetch_array($rs);
		//echo $row[audit];
		if($type=='edit_or_audit')
		{
		//echo $query_string;
			return true;
		}
		if($type=='edit_and_audit')
		{
			return true;
		}
		if($type=='edit')
		{
			return $row[edit];
		}
		if($type=='audit')
		{
			return $row[audit];
		}
	}
	if($recursion=='yes')
	{
		$end_id=get_root_id($table_name);
		$family_tree=array();
		get_all_parent_id($table_name,$id,$end_id,$family_tree);
		$is_valid=false;//假设不是此栏目的管理员
		foreach($family_tree as $key=>$value)
		{
			//echo "type".$type;
			$query_string="select * from acl_management where table_name='$table_name' and id='$value[id]' and staff_id='$acl_staff_id'";
			//echo $query_string;
			$rs=mysql_query($query_string);
			//echo mysql_num_rows($rs);
			if(mysql_num_rows($rs)==0)
			{
				continue;
			}
			$row=mysql_fetch_array($rs);
			//echo $row[audit];
			if($type=='edit_or_audit')
			{
			//echo $query_string;
				return true;
			}
			if($type=='edit_and_audit')
			{
				return true;
			}
			if($type=='edit')
			{
				return $row[edit];
			}
			if($type=='audit')
			{
				return $row[audit];
			}
		}	
	return $is_valid;	
	}
	
	
}//返回某人具有权限
function get_acl_management_staff_id($table,$id)
{
	$query_string="select * from acl_management where table_name='$table' and id='$id' ";
	//echo $query_string;
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	return $row[staff_id];	
}//通过表与栏目ID取该栏目的操作员
function get_acl_management_id($table,$staff_id)
{
	$query_string="select * from acl_management where table_name='$table' and staff_id='$staff_id' ";
	//echo $query_string;
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	return $row[id];	
	
}//通过表与操作员ID取该栏目的ID
function get_news_audit_type($news_item_id)
{
	$query_string="select * from news_item where id='$news_item_id'";
	//echo $query_string;
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	return $row[audit_type];
}//取得某栏目的审核方式
function get_news_operator_scope_type($news_item_id)
{
	$query_string="select * from news_item where id='$news_item_id'";
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	return $row[operator_scope];
}//取得某栏目的操作用户类型

function get_child_node_sum($table,$field,$value)
{
	$querystring="select count(*) as counter from $table where $field='$value' ";
	//这里很巧妙，自动阻止了根节点的删除。因为根节点的id=parent_id,所以根节点总会有一个子节点，返回值永远为1，而不是0
	//echo $querystring;
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	//echo $row[counter];
	return $row[counter];
}//取节点的下级子节点数目,其实际功能为取某表某字段等于某值的记录的数量,$field一般应为parent_id,$value一般就为一个id值
function get_course_id_from_knowledge_by_property($id)
{
	$family_tree=array();
	$table='knowledge';
	$end_id=get_root_id($table);
	get_all_parent_id($table,$id,$end_id,$family_tree);
	//var_dump($family_tree);
	for($counter=0;$counter<=count($family_tree);$counter++)
	{
		if(get_knowledge_property($family_tree[$counter][id])=='2')
		{
			return $family_tree[$counter][id];
		}
	}
}//取所属的课程代码，用于新增试题，这样就能方便的实现按课程随机抽题

function get_data_from_db($table,$id,$field='id')//从表中取数据（类型：只有一行，且由ID字段及其值唯一确定一行)
{
	$query_string="select * from $table where $field='$id'";
	//echo $query_string;
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	$call_function=$table."_ddl";//根据表名生成要调用的函数名
	$table_structure=$call_function('structure');//取表结构数据
	$number_of_field=count($table_structure);//从表结构数组中取得字段数
	$temp_table='';//待构建的表数组
	for($counter=0;$counter<$number_of_field;$counter++)
	{
		$field=$table_structure[$counter]['name'];//取字段名
		//echo $field.$row[$field];
		//echo $row[id].$row[caption];
		$temp_table[$field]['value']=$row[$field];//字段值
		$temp_table[$field]['length']=$table_structure[$counter]['length'];//字段长度
		$temp_table[$field]['control_name']=$table."_".$field;//用于html控件时的名称。由"表名_字段名"构成
	}
	//print_r($temp_table);
	return $temp_table;
}//从表中取数据(类型：只有一行，且由ID唯一确定一行)
function get_data_from_post()//通过POST取提交的数据
{
	//$post_date=$_POST;
	//print_r($_POST[]);
}//通过POST取提交的数据
function get_data_from_get()//通过GET取提交的数据
{
	if($_GET[$id])
	{
		$id=$_GET[$id];
		return $id;
	}
	else
	{
		return false;
	}
}//通过GET取提交的数据
function get_knowledge_property($id,&$new_caption='',&$new_property='')
{

	$query_string="select * from knowledge where id='$id'";
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	$property=$row[property];
	//echo $property;
	switch ($property)
	{
		case  '0':
		$new_caption='新学科';
		$new_property='1';//如果父结点是根，返回1
		return '0';
		case '1':
		$new_caption='新课程';
		$new_property='2';//如果父结点是学科，返回2
		return '1';
		case  '2':
		$new_caption='新章节';
		$new_property='3';//如果父结点是课程，返回3
		return '2';
		case  '3':
		$new_caption='新章节';
		$new_property='3';//如果父结点是知识点，也返回3
		return '3';
	}
	return;
	//返回的是当前ID的真正属性，但同时可生成下级的默认属性与默认标题，用引用完成值传递
}//返回父结点的属性，用于根据父结点的属性生成本节点的默认属性

function get_key_id($key_id)//取用于整个页面处理的主关键字的函数
{
	//echo $key_id;
	if(!$_GET[$key_id] and !$_POST[$key_id])//如果没有传ID值过来，则先显示欢迎页
	{
		$location="welcome.php";
		auto_jump_back($location,1);//返回
	}
	if($_GET[$key_id])
	{
		$key_id=$_GET[$key_id];
	}
	if($_POST[$key_id])
	{
		$key_id=$_POST[$key_id];
	}
	return $key_id;
}//取用于整个页面处理的主关键字的函数

function get_news_item_id_by_news_id($news_id)
{
	$query_string="select news_item_id from news_main where id='$news_id'";
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	return $row[news_item_id];
}


function get_news_item_by_position($position_name,$type='url')
{
	//type(id,caption,url)
	//$position=split('_',$position_name);
	//print_r($position);
	$query_string="select * from index_position where  id='".$position_name."'";
	//echo $query_string;
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);	
	if(!empty($row[url]))
	{	
		if($type=='id')
		{
			return $row[url];
		}
		if($type=='caption')
		{
			$caption=get_caption('news_item',$row[news_item_id]);
			$caption=my_sub_str($row[url_description],0,$row[news_item_length]);
			//echo $caption;
			return $caption;
		}

	}
	
	if($type=='id')
	{
		return $row[news_item_id];
	}
	if($type=='caption')
	{
		$caption=get_caption('news_item',$row[news_item_id]);
		$caption=my_sub_str($caption,0,$row[news_item_length]);
		//echo $caption;
		return $caption;
	}
}


function get_organization_caption($id)
{
	$query_string="select * from organization where id= '$id'";
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	$caption=$row[caption];//
	return $caption;
}//取机构名
function get_organization_id_by_staff_id($staff_id)
{
	$query_string="select * from staff where id= '$staff_id'";
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	$organization_id=$row[organization_id];//取得现在最大的ID号
	return $organization_id;
}//通过职员号取得部门代码
function get_all_child_id($table,$id,&$family_tree)//取子ID,返回的是一个数组，用引用实现，数据中有此ID的所有父ID，请区别的is_parent()
{
	//此函数有错误，暂不用
	//static $layer=0;
	//echo $layer."<br>";
	$child_node_number=get_child_node_sum($table,'parent_id',$id);//计算此节点的字节点数量
	//echo $child_node_number;
	if($child_node_number>0)//此子节点还有更下一级的子节点则读入数据并开始递归
	{
		$query_string="select * from $table where parent_id= '$id' and id!='$id'";//排除根节点
		$rs=mysql_query($query_string);
		$row=mysql_fetch_array($rs);
		$layer=count($family_tree);//取当前层数
		$family_tree[$layer]['id']=$row[id];
		//echo "dd".$family_tree[$layer]['id'].$row[id]."<br>";
		$family_tree[$layer]['parent_id']=$row[parent_id];
		$family_tree[$layer]['caption']=$row[caption];
		get_all_child_id($table,$row[id],$family_tree);//继续递归
	}
	else
	{
		return true;
	}
}//取子ID取父ID,返回的是一个数据，用引用实现，数据中有此ID的所有父ID，请区别的is_parent()

function get_all_parent_id($table,$id,$end_id,&$family_tree)//取父ID,返回的是一个数组，用引用实现，数据中有此ID的所有父ID，请区别的is_parent()
{
	//static $layer=0;
	//echo $layer."<br>";
	$query_string="select * from $table where id= '$id'";
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	$layer=count($family_tree);
	$family_tree[$layer]['id']=$row[id];
	//echo "dd".$family_tree[$layer]['id'].$row[id]."<br>";
	$family_tree[$layer]['parent_id']=$row[parent_id];
	$family_tree[$layer]['caption']=$row[caption];
	//echo $layer."<br>";
	//echo "hh".$family_tree[$layer]['id']." ".$end_id."<br>";
	if($family_tree[$layer]['id']==$end_id)//如果达到所要求的层，则停止递归(此层不一定要是根,这样就解决了判断某个节点是否属于另一个节点的问题)
	{
		return true;
	}
	else//否则递归
	{
		//$layer=$layer+1;
		//get_all_parent_id($table,$row[parent_id],$end_id,&$family_tree);
		get_all_parent_id($table,$row[parent_id],$end_id,$family_tree);
	}

}//取父ID取父ID,返回的是一个数据，用引用实现，数据中有此ID的所有父ID，请区别的is_parent()
function get_password($table,$staff_id)
{
	$query_string="select * from $table where id='$staff_id'";
	//echo $query_string;
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	return $row[password];
}//取职员的密码
function get_parent_id($table,$id)//取父ID,返回的是当前ID的直接父ID，请区别的get_all_parent_id()
{
	$query_string="select * from $table where id= '$id'";
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	return $row[parent_id];
}//取父ID,返回的是当前ID的直接父ID，请区别的get_all_parent_id()
function get_root_id($table)
{
	//$query_string="select $field from $table  order by $field asc limit 0,1 ";//
	$query_string="select id from  $table  where id=parent_id";//只有根的id=parent_id
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	$id=$row[id];//取得现在最大的ID号
	return $id;
}//取根ID

function get_site_key_word()
{
	$query_string="select * from organization_detail where id= '0000000000'";
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	$caption=$row[site_key_word];//
	return $caption;
}

function get_new_id($table,$field,$condition='')//此函数专门用于生成唯一的ID
{
	//$time_start=explode(" ",microtime());
	if(empty($condition))
	{
		$query_string="select $field from $table  order by $field desc limit 0,1 ";//取二级表的自增长代码
	}
	else
	{
		$query_string="select $field from $table where $condition  order by $field desc limit 0,1 ";//取二级表的自增长代码
	}
	
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	$id=$row[$field];//取得现在最大的ID号

	$call_function=$table."_ddl";//根据表名生成要调用的函数名
	$table_structure=$call_function('structure');//取表结构数据
	$number_of_field=count($table_structure);//从表结构数组中取得字段数
	for($counter=0;$counter<$number_of_field;$counter++)
	{
		if($field==$table_structure[$counter]['name'])
		{
			$field_len=$table_structure[$counter]['length'];//取字段长度
		}
	}	
	$new_id=intval($id)+1;//生成新的ID号
	$new_id=strval($new_id);
	$repeat_times=$field_len-strlen($new_id);
	$new_id=str_repeat('0',$repeat_times).$new_id;
	//echo $new_id;
	//$time_end=explode(" ",microtime());
	//$c=$time_end[0]+$time_end[1]-$time_start[0]-$time_start[1];
	//echo "<center>查询所用时间：".$c."秒</center>"; 
	return $new_id;
}//此函数专门用于生成新的唯一的ID
function get_staff_name($id)
{
	$query_string="select * from staff where id='$id' ";
	//echo $query_string;
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	return $row[name];
}//取用户名称的函数
function get_student_name($id)
{
	$query_string="select * from student where id='$id' ";
	//echo $query_string;
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	return $row[name];
}//取学生名称的函数
function get_caption($table,$id)//取ID的CAPTION
{
	$query_string="select * from $table where id='$id'";
	//echo $query_string;
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	return $row[caption];
}//取ID的CAPTION;

function is_post($key)//检查用户是否提交数据
{
	if($_POST[$key])
	{
		return true;
	}
	else
	{
		return false;
	}
}//检查用户是否提交数据
function is_parent($table,$id,$end_id)//$id要找的ID，$end_id父ID
{
	static $is_parent=false;
	$query_string="select * from $table where id= '$id'";
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	//$id=$row[id];
	$parent_id=$row[parent_id];
	//echo "<br>";
	//echo "c ".$parent_id;
	//echo " ";
	//echo "e ".$end_id;
	//if($parent_id==$end_id)//如果达到所要求的层，则停止递归(此层不一定要是根,这样就解决了判断某个节点是否属于另一个节点的问题)
	if($parent_id==$end_id)
	{
		$is_parent=true;
		return true;
	}
	elseif($parent_id==get_root_id($table,'id'))//都达到根了还没有找到
	{
		$is_parent=false;
		return false;
	}
	else//否则递归
	{
		is_parent($table,$parent_id,$end_id);
		//get_all_parent_id($table,$parent_id,$end_id);
	}
	return $is_parent;
}//判断某ID是否是另一ID的父ID，可以是多级关系,区别于get_all_parent_id($table,$id,$end_id,&$family_tree)
function is_admin($id)
{ 
	if($id=='0000000000')
	{
		return true;
	}
	else
	{
		return false;
	}
}//是管理员


function page_process($query_string,$rows_of_page=15,$current_page=0,$return_value_type='query_string')
{	
//处理分页
//return_value_type='query_string' 返回值是查询字符串
//return_value_type='page_statistic' 返回值是数组，里面存储的是当前页与一共有多少页的数据

	//统计在当前状态下记录数与页数
	$rs_number=mysql_query($query_string);
	$amount_of_rows=mysql_num_rows($rs_number);//当前条件下总记录数
	//$rows_of_page=15;//每页显示记录数
	//如每页3条，当有0-2条时$amount_of_pages＝0。当为3，6时，则要做$amount_of_pages-1
	$amount_of_pages=intval($amount_of_rows/$rows_of_page);//当前条件下总页数
	if($amount_of_rows%$rows_of_page==0)//刚好是整页，则把求得的页码减1，否则出错
	{
		$amount_of_pages=$amount_of_pages-1;
	}
	if(isset($_POST[current_page]))//如果用户按下翻页键，则取提交的当前页，否则就从传入的参数中取得（在staff_edit 与 staff_management中的实现的例子），这样样可以实现下页反回时回来调页,这个功能的实现在每个具体的调用程序中
	{
		$current_page=$_POST[current_page];//取当前页码
	}
	//echo "<br>page_process:current_page:".$current_page;
	if($_POST[page_top])
	{
		$current_page=0;
		//echo "top";
	}
	if($_POST[page_previous])
	{
		$current_page=$current_page-1;
		if($current_page<0)
		{
			$current_page=0;
		}
	}
	if($_POST[page_next])
	{
		//echo "next";
		//echo $current_page;
		$current_page=$current_page+1;
		if($current_page>$amount_of_pages)
		{
			$current_page=$amount_of_pages;
		}
	}
	if($_POST[page_bottom])
	{
		$current_page=$amount_of_pages;
	}
	if($_POST[page_go])
	{
		$current_page=$_POST[select_page];
	}
	//echo $current_page;
	$start_row=$current_page*$rows_of_page;//起始行
	$query_string=$query_string." limit $start_row,$rows_of_page";
	echo "<input type='hidden' name='current_page' value=$current_page>"; 
    echo "<input type='hidden' name='rows_of_page' value=$rows_of_page>";
//return_value_type='query_string' 返回值是查询字符串
//return_value_type='page_statistic' 返回值是数组，里面存储的是当前页与一共有多少页的数据
	//return $query_string;
	//echo $query_string;
	//echo 'return_value_type'.$return_value_type;
	if($return_value_type=='query_string')
	{
		return $query_string;
	}
	if($return_value_type=='page_statistic')
	{
		$page_statistic=array();
		$page_statistic['query_string']=$query_string;
		$page_statistic['current_page']=$current_page+1;
		$page_statistic['amount_of_pages']=$amount_of_pages+1;
		//echo $current_page,$amount_of_pages;
		return $page_statistic;
	}
	
}//处理分页 根据用户选择作出处理
function page_process_single($table,$parent_field,$field,$value)
{	
//本功能的分页用于对单一记录显示时进行的翻页操作（如显示一个职员的详细信息时看下一位或上一位职员的信息)
//$parent_field是赖以分组的字段，$field是关键字段
	//处理分页
	$query_string="select * from $table where $field='".$value."'";
		//echo $query_string;
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	$parent_value=$row[$parent_field];//因为不同的表，分类列的字段名并不一样，因此这样处理
	$inner_id=$row[inner_id];
	//echo $inner_id;
	if($_POST[page_top])
	{
		//$current_page=0;
		$query_string="select * from $table where $parent_field='".$parent_value."' order by inner_id limit 0,1";
		//echo $query_string;
		$rs=mysql_query($query_string);
		$row=mysql_fetch_array($rs);
		$value=$row[$field];//因为不同的表，分类列的字段名并不一样，因此这样处理
		//echo "top";
	}
	if($_POST[page_previous])
	{
		$query_string="select * from $table where $parent_field='".$parent_value."' and inner_id<'".$inner_id."' order by inner_id desc limit 0,1";
		$rs=mysql_query($query_string);
		$row=mysql_fetch_array($rs);
		$value=$row[$field];//因为不同的表，分类列的字段名并不一样，因此这样处理
		//exit();
		if(empty($value))//如果已是第一个，则处理一下
		{
			$query_string="select * from $table where $parent_field='".$parent_value."' order by inner_id limit 0,1";
			$rs=mysql_query($query_string);
			$row=mysql_fetch_array($rs);
			$value=$row[$field];//因为不同的表，分类列的字段名并不一样，因此这样处理
		}
	}
	if($_POST[page_next])
	{
		$query_string="select * from $table where $parent_field='".$parent_value."' and inner_id>'".$inner_id."' order by inner_id limit 0,1";
		$rs=mysql_query($query_string);
		$row=mysql_fetch_array($rs);
		$value=$row[$field];//因为不同的表，分类列的字段名并不一样，因此这样处理
		if(empty($value))//如果已是最后一个，则处理一下
		{
			$query_string="select * from $table where $parent_field='".$parent_value."'order by inner_id desc limit 0,1";
			$rs=mysql_query($query_string);
			$row=mysql_fetch_array($rs);
			$value=$row[$field];//因为不同的表，分类列的字段名并不一样，因此这样处理
		}
	}
	if($_POST[page_bottom])
	{
		$query_string="select * from $table where $parent_field='".$parent_value."'order by inner_id desc limit 0,1";
		$rs=mysql_query($query_string);
		$row=mysql_fetch_array($rs);
		$value=$row[$field];//因为不同的表，分类列的字段名并不一样，因此这样处理
	}
	if($_POST[page_go])
	{
		$current_page=$_POST[select_page];
	}
	return $value;
}//处理分页 根据用户选择作出处理
function page_buttons($rows_of_page,$button_url='')
{
	echo "<input type='submit' name='page_top' value='首页'>";
	echo "<input type='submit' name='page_previous' value='上一页'>";

	//select_page_list_menu($current_page,'none',get_file_name($type='form'),$amount_of_pages);
     
	echo "<input type='submit' name='page_next' value='下一页'>";
	echo "<input type='submit' name='page_bottom' value='末页'>";
	if(empty($button_url) or empty($_SESSION[staff_id]))
	{
	}
	else
	{
		//echo $button_url;
		echo "<input type='button' name='button' value='增加新信息' onClick=\"document.location='".$button_url."'\">";
			//document.location='news_add_new.php?news_item_id='+parameter1;
	}
}//显示分页按钮
function refresh_leftframe($id='')
{
	echo "<script language=\"JavaScript\">";
	if(!empty($id))
	{
		$id="'".$id."'";
		//echo "alert($id);";
		echo "obj=window.parent.leftFrame.document.all('tree_view_current_node');";
		//echo "alert(obj.value);";
		echo "obj.value=".$id.";";
		//echo "alert(obj.value);";
	}
	echo "window.parent.leftFrame.document.forms[0].submit();";
	echo "</script>";
}//刷新左窗口，一般情况下是右窗口做了对当前结点如增加，删除，移动操作，保存后需要改变左窗口TREE的当前结点（tree_view_current_node）值

function rewrite()
{
	$file="http://".$_SERVER[SERVER_NAME]."/index_mate.php";
	//define(ROOT,$_SERVER['DOCUMENT_ROOT']);
	//$file=ROOT."/index_mate.php";
	
	$fp = fopen($file,'r');
	if (!$fp)
	{
		echo "不能打开源文件<br>";
	} 
	$fp1=fopen('../index_mate.htm','w');
	if (!$fp1)
	{
		echo "不能打目标文件<br>";
	} 
	if (!$fp)
	{
		//echo "$errstr ($errno)<br />\n";
	} 
	else 
	{
	
		while (!feof($fp)) {
			$str=fgets($fp, 8096);
			fwrite($fp1,$str);
		}
		fclose($fp);
		fclose($fp1);
	}
}

function row_exist($table,$filed='',$value='',$condition='')
{
	//开关参数
	$exist=0;
	if(empty($condition))
	{
		$query_string = "select count(*) as counter from $table where $filed='$value'";
	}
	else
	{
		$query_string = "select count(*) as counter from $table where $condition";
	}
		//echo $query_string;
	$rs = mysql_query($query_string);
	$row = mysql_fetch_array($rs);
	if($row[counter]>0)
	{
		//如果有记录存在
		$exist=$row[counter];
	}
	else
	{
		$exist=0;
	}
	//echo 'exist'.$exist;
	return $exist;//返回的是一个具体的数。如5条记录
}//判断指定值的行是否存在
function save_data_to_db($is_valid,$table,$key_field,$id)//把数据写入数据库表中(类型：只有一行，且由ID唯一确定一行
{
	//$key_field 要更新表的关键字段
	//$id 传过来的关键值 只有$key_field='$id'的行才衩更新
	//echo "asfsdfs";
	if(!$is_valid)
	{
		return false;
	}
	//处理$table表的相关数据
	//echo "dddd";

	$call_function=$table."_ddl";//根据表名生成要调用的函数名
	$table_structure=$call_function('structure');//取表结构数据
	$number_of_field=count($table_structure);//从表结构数组中取得字段数
	$temp_table='';//待构建的表数组
	$query_string='';
	for($counter=0;$counter<$number_of_field;$counter++)
	{
		$field=$table_structure[$counter]['name'];//取字段名
		//根据字段名生成相应的html控件名称
		$control_name=$table."_".$field;
		if(isset($_POST[$control_name]))//因为不是每个字段在页面里都显示并处理，因此通过判断后只处理在页面中处理过的数据（被处理的字段由相应的控件名）来生成SQL语句
		{
			$query_string=$query_string." ".$field." = '".$_POST[$control_name]."',";
		}
	}
	$query_string=substr($query_string,0,strlen($query_string)-1);//去尾部逗号，在本模块中只能用这种方法去掉末尾逗号
	//echo $query_string;
	if(empty($query_string))
	{
		echo "没有相应的数据可写入$table表";
		return false;
	}
	$query_string="update ".$table." set ".$query_string;
	$query_string=$query_string." where ".$key_field."='".$id."'";
	//echo $id;
	//echo $query_string;
	$operate=mysql_query($query_string);
	if($operate)
	{
		//$error_message="数据已成功保存！！！";
	}
	else
	{
		$error_message="保存$table表时出错！！！";
		echo "<font color='red'><center>".$error_message."</center></font>";
	}
	return $operate;//返回数据操作是否成功
	//$location="management.php";
	//auto_jump_back($location,'1200');//返回
}//把数据写入数据库表中(类型：只有一行，且由ID唯一确定一行
function show_family_tree($family_tree)//显示family_tree
{
	$number=count($family_tree)-1;
	//因为family_tree中最底层的节点在数组中的索引号为0，而根节点为索引最大值，所以要写成$counter=$number;$counter>=0;$counter--
	for($counter=$number;$counter>=0;$counter--)
	{
		echo $family_tree[$counter][caption];
		if($counter>0)
		{
			echo "->";
		}
	}
}//显示层次结构如中国->四川省->成都市->区
function show_all_auditor_admit($news_id)
{
	echo "所有审核意见";
	echo "<br>";
	$query_string="select * from news_auditor where news_id='$news_id'";
	$rs=mysql_query($query_string);
//echo $query_string;

	while($row=mysql_fetch_array($rs))
	{
			$table='news_main';
			$field='editor';
			$auditor=$row[staff_id];
			$table='organization';
			$organization_id=(get_organization_id_by_staff_id($auditor));		
			$root_id=get_root_id('organization');
			$family_tree=family_tree($table,$organization_id,$root_id);
			show_family_tree($family_tree);
			echo "  ".get_staff_name($auditor)." : ";
			//echo "<br>";
			echo $row[admit];
			echo "<br>";
			echo "<textarea  cols=\"100\" rows=\"4\" >$row[content]</textarea>";
			echo "<br>";
	
	}

}

function show_drop_down_box($table,$parent_id,&$drop_down_box_node)
{
	$querystring="select * from $table where parent_id='$parent_id' and id!='$parent_id' ";
	//echo $querystring;
	$rs=mysql_query($querystring);
	$drop_down_box="select_".$table.$parent_id;//生成的下拉框的名称为select_表名_节点ID名
	if($_POST[$drop_down_box])
	{
		$current_id=$_POST[$drop_down_box];//注意这句不要理解错了。是取名为$parent_id的下拉框所承载的值
	}
	else
	{
		$current_id=$parent_id;
	}
	echo  "<select name=$drop_down_box onchange='document.forms[0].submit()'>";
	if(get_root_id($table)==$parent_id)
	{
		echo  "<option value='$parent_id'>".get_caption($table,$parent_id)."</option>";
	}
	else
	{
		echo  "<option value='$parent_id'>全部</option>";
	}
	
	while($row=mysql_fetch_array($rs))
	{
		$select_value=$row[id];
		$select_display_value=$row[caption];
		if($select_value==$current_id)
		{
			echo  "<option value='$select_value' selected>$select_display_value</option>";
		}
		else
		{
			echo  "<option value=$select_value>$select_display_value</option>";
		}
	}
	echo  "</select>";
	if($current_id!=$parent_id and get_child_node_sum($table,'parent_id',$current_id)>0)//选了当前框的一项，且此项有子项，则进行递归显示下一个下拉列表框
	{
		show_drop_down_box($table,$current_id,$drop_down_box_node);
		return;
	}
	else
	{
		//echo $current_id;
		//此值用于存放下拉列表框组最后点选的值，用引用进行值传递,在这里进行赋值操作。
		$drop_down_box_node=$current_id;//递归无法用return返回值，只能用引用解决
		return ;
	}
}//多级联动下拉列表框
function show_drop_down_box_one($table,$filter_field,$filter_value,$key_field,$caption_field,$condition='')
{
	if(empty($condition))
	{
		$query_string="select * from $table where $filter_field='$filter_value'";
	}
	else
	{
		$query_string="select * from $table where $condition";
	}
	//echo $query_string;
	$rs=mysql_query($query_string);
	$drop_down_box="select_".$table.$key_field;//生成的下拉框的名称为select_表名_节点ID名
	if($_POST[$drop_down_box] and mysql_num_rows($rs)>0)
	//假如提交并且根据关联的下拉列表框传过来的数据在本列表框内有相关的子项，则处理，否则将当前项设为空
	//根据部门下拉列表框中的数据，在人员列表框中显示相应的人名列表。但如果此部门没能人员，则人员下拉框的当前值就应设为空
	{
		$current_id=$_POST[$drop_down_box];//注意这句不要理解错了。是取名为$parent_id的下拉框所承载的值
	}
	else
	{
		$current_id='';
	}
	echo  "<select name=$drop_down_box onchange='document.forms[0].submit()'>";
	echo  "<option value='$parent_id'>全部</option>";
	while($row=mysql_fetch_array($rs))
	{
		$select_value=$row[$key_field];
		$select_display_value=$row[$caption_field];
		if($select_value==$current_id)
		{
			echo  "<option value='$select_value' selected>$select_display_value</option>";
		}
		else
		{
			echo  "<option value=$select_value>$select_display_value</option>";
		}
	}
	echo  "</select>";
	return $current_id;
}//单级联动下拉列表框
function table_relation_update($master_table,$master_field,$old_value,$new_value)
{
	//此函数完成对有关系表的数据的同步更新，如果表间全是用ID关联，此功能的实际用处值得考虑。考虑是一对一还是多对一
	//本函数不需要考虑子表联动的问题与联动删除的函数有差异。
	$query_string="select * from table_relation where master_table='$master_table' and master_field='$master_field'";
	$rs=mysql_query($query_string);
	while($table_relation=mysql_fetch_array($rs))
	{
		$slave_table=$table_relation['slave_table'];
		$slave_field=$table_relation['slave_field'];
		$query_string="update  $slave_table set $slave_field='$new_value' where  $slave_field='$old_value'";
		$result=mysql_query($query_string);
	}
}//此函数完成对有关系表的数据的同步更新，如果表间全是用ID关联，此功能的实际用处值得考虑。考虑是一对一还是多对一


function table_relation_insert($master_table='',$master_field='',$value='',$slave_table='')
{
	if(!empty($master_table))//如果主表存在，则表示为主表有数据插入，根据主表自动更新从表。
	{
		$query_string="select * from table_relation where master_table='$master_table' and master_field='$master_field' and relation_type='one_to_one'";

		//echo "<br>";
		//echo "<font color=red>";
		//echo "realtion".$query_string;
		//exit();
		//echo "</font>";
		$rs=mysql_query($query_string);
		while($table_relation=mysql_fetch_array($rs))
		{
			$slave_table=$table_relation['slave_table'];
			$slave_field=$table_relation['slave_field'];
			//$query_string="update  $slave_table set $slave_field='$new_value' where  $slave_field='$old_value'";
			$query_string="insert into  ".$slave_table."(".$slave_field.") values('".$value."')";
			//echo "<font color=red>";
			//echo $query_string;
			//echo "</font>";
			$result=mysql_query($query_string);
		}
	}
	if(!empty($slave_table))//如果从表存在，则表示根据从表找到相应的主表，再根据主表中的数据来更新从表中的数据
	{
		$query_string="select * from table_relation where slave_table='$slave_table' and  relation_type='one_to_one'";
		$rs_table_relation=mysql_query($query_string);
		while($table_relation=mysql_fetch_array($rs_table_relation))//从关系表中取关系，因为是一对一关系，所以一般情况下只有一条记录，但如果从表与主表有多个字段有一对一的关系，则会有多条记录。但实际上这是不可能的。因此以下的循环语句意义不太
		{
			$master_table=$table_relation['master_table'];
			$master_field=$table_relation['master_field'];
			$slave_table=$table_relation['slave_table'];
			$slave_field=$table_relation['slave_field'];
			$query_string="select ".$master_field." from ".$master_table."";
			$rs_master_table=mysql_query($query_string);
			while($master_table=mysql_fetch_array($rs_master_table))//取主表中所有的记录
			{
				$master_field_value=$master_table[$master_field];
				$query_string="select * from ".$slave_table." where ".$slave_field." = '".$master_field_value."'";
				$rs_slave_table=mysql_query($query_string);
				if(mysql_num_rows($rs_slave_table)==0)//从表中还没有主表中已有的数据，则插入
				{
					$query_string="insert into  ".$slave_table."(".$slave_field.") values('".$master_field_value."')";
					$result=mysql_query($query_string);
				}
			}
		}
	}
}//此函数完成对有关系表的数据的同步插入,此函数只能完成一对一关系的表的数据的插入
function table_realtion_delete($master_table,$master_field,$value)
{
	$query_string="select * from table_relation where master_table='$master_table' and master_field='$master_field'";
	$rs=mysql_query($query_string);
	while($table_relation=mysql_fetch_array($rs))
	{
		$slave_table=$table_relation['slave_table'];
		$slave_field=$table_relation['slave_field'];
		
		//判断从表在“表关系表”中是否充当主表，如果充当主表，则还要联动删除
		if(row_exist('table_relation','master_table',$slave_table))//有且为主表
		{
			//开始递归

			$query_string="select * from $slave_table where  $slave_field='$value'";
			$rs_recursion=mysql_query($query_string);
			while($row_recursion=mysql_fetch_array($rs_recursion))
			{
				$value_recursion=$row_recursion[id];
				table_realtion_delete($slave_table,'id',$value_recursion);
			}
			//递归结束
		}
	
		$query_string="delete from $slave_table where  $slave_field='$value'";
		$result=mysql_query($query_string);
	}
	return true;
}//此函数完成对有关系表的数据的同步删除，考虑是一对一还是多对一

function table_exist($database,$table,$link)
{
	//开关参数
	$exist=false;
	$query_string = "show tables from  $database";
	$rs = mysql_query($query_string);
	while ($row = mysql_fetch_row($rs))
	{
		if($table==$row[0])
		{
			//如果指定的数据库存在
			$exist=true;
		}
	}
	return $exist;
}//判断指定的表是否存在





//以上为新增加的函数2006.1.25

//取某栏目的第一条记录

function get_edit_point($news_item_id)
{
	$query_string="select * from news_item where id='$news_item_id'";
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	return $row[edit_point];
}//取相关栏目发信的点数
function get_reply_point($news_item_id)
{
	$query_string="select * from news_item where id='$news_item_id'";
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	return $row[reply_point];
}//取相关栏目发信的点数
function get_read_point($news_id)
{
	$query_string="select * from news_main where id='$news_id'";
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	$point_value=array();
	$point_value[read_point]=$row[read_point];
	$point_value[reduce_point]=$row[reduce_point];
	return $point_value;//以数组的形式返回本条新闻所需要的阅读点数与用户阅读该信息后的扣除点数
}//取相关要求阅读点数
function get_staff_point($staff_id)
{
	$query_string="select * from staff where id='$staff_id'";
	$rs=mysql_query($query_string);
	$row=mysql_fetch_array($rs);
	return $row[edit_point]+$row[reply_point]+$row[visit_point];
}//取某人的积分



function get_first_info_id($item_id,$condition)
{
	$querystring="select distinct information_main.* from information_main inner join information_destination
	on 
	information_main.info_id=information_destination.info_id  and 
	$condition
	 where 
	information_main.item_id='$item_id' and information_main.audit_staff_id_final!=''   
	order by information_main.info_date limit 1";
	//echo $querystring;
	//exit();
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$info_id=$row[info_id];
	//echo $info_id;
	return $info_id;
}


//取论坛栏目是否显示投票结果
//2005-9-18
function get_bbs_item_show_vote($bbs_item_id)
{
	$querystring="select * from bbs_item  where bbs_item_id='$bbs_item_id'";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$bbs_item_show_vote=$row[bbs_item_show_vote];
	//echo $querystring.$bbs_item_audit;
	if($bbs_item_show_vote=='1')//要显示
	{
		return 1;
	}
	else//对公
	{
		return 0;

	}

}


//取论坛栏目是否对私
//2005-9-13
function get_bbs_item_private_state($bbs_item_id)
{
	$querystring="select * from bbs_item  where bbs_item_id='$bbs_item_id'";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$bbs_item_private=$row[bbs_item_private];
	//echo $querystring.$bbs_item_audit;
	if($bbs_item_private=='1')//对私
	{
		return 1;
	}
	else//对公
	{
		return 0;

	}

}


//查看指定的用户是否存在，用于私聊
//2005-9-13

function get_bbs_dest_user_id_exist($bbs_dest_user_id)
{
	$querystring="select count(*) as counter from bbs_user  where bbs_user_id='$bbs_dest_user_id'";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$counter=$row[counter];
	//echo $querystring;
	if($counter==1)//存在
	{
		return 1;
	}
	else//对公
	{
		return 0;

	}

}




function get_web_site_name()
{

	$root=$_SERVER['DOCUMENT_ROOT'];
	$posstion=strrpos("$root","/");
	$length=strlen(trim($root))-$posstion;
	$web_site=trim(substr($root,$posstion+1,$length));
	return $web_site;
	//echo $web_site;
}



//取某贴的目标用户
function get_bbs_dest_user_id($bbs_information_id)
{
	$querystring="select * from bbs_information_main  where bbs_information_id='$bbs_information_id'";
	//echo $querystring;
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$bbs_dest_user_id=$row[bbs_dest_user_id];
	return $bbs_dest_user_id;
}

//取某贴的发贴者

function get_bbs_edit_user_id($bbs_information_id)
{
	$querystring="select * from bbs_information_main  where bbs_information_id='$bbs_information_id'";
	//echo $querystring;
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$bbs_edit_user_id=$row[bbs_edit_user_id];
	return $bbs_edit_user_id;
}

//取返回时的页码与位置
function get_return_position($bbs_information_parent_id,$bbs_information_id,$anchorname,$amount_of_pages)
{
	$bbs_information_inner_index=get_bbs_information_inner_index($bbs_information_parent_id,$bbs_information_id);
	//计算返回时bbs_information_show 的页码
	$querystring="select * from bbs_information_main where
	bbs_information_parent_id='$bbs_information_parent_id' and 
	bbs_information_title!='' and
	bbs_information_inner_index<='$bbs_information_inner_index'
	order by bbs_information_inner_index";
	//echo $querystring;
	$rs_number=mysql_query($querystring);
	$amount_of_rows=mysql_num_rows($rs_number);//当前条件下总记录数
	//echo "amount_of_rows".$amount_of_rows;
	$rows_of_page=30;//每页显示记录数,如果此值被 修改，应同时修改bbs_information_(edit ,audit,show)中的值
	//如每页3条，当有0-2条时$amount_of_pages＝0。当为3，6时，则要做$amount_of_pages-1
	$amount_of_pages=intval($amount_of_rows/$rows_of_page);//当前条件下总页数
	if($amount_of_rows%$rows_of_page==0)//刚好是整页，则把求得的页码减1，否则出错
	{
		$amount_of_pages=$amount_of_pages-1;
	}
	//$_SESSION[bbs_information_show_current_page]=$amount_of_pages;
	//$_SESSION[bbs_information_parent_id]=$bbs_information_parent_id;
	//返回的锚点
	$anchorname='#a'.$bbs_information_inner_index;
	//return $anchorname;

}


//取论坛栏目是否需要审核
function get_bbs_item_aduit_state($bbs_item_id)
{
	$querystring="select * from bbs_item  where bbs_item_id='$bbs_item_id'";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$bbs_item_audit=$row[bbs_item_audit];
	//echo $querystring.$bbs_item_audit;
	if($bbs_item_audit=='1')//要审核
	{
		return 1;
	}
	else//无需要审核
	{
		return 0;

	}

}

//取论坛信息锁定状态
function get_bbs_information_lock_state($bbs_information_id)
{
	$querystring="select * from bbs_information_main  where bbs_information_id='$bbs_information_id'";
	//echo $querystring;
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$bbs_information_lock=$row[bbs_information_lock];
	if($bbs_information_lock=='1')//
	{
		return 1;
	}
	else
	{
		return 0;

	}

}


//取论坛栏目锁定状态
function get_bbs_item_lock_state($bbs_item_id)
{
	$querystring="select * from bbs_item  where bbs_item_id='$bbs_item_id'";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$bbs_item_lock=$row[bbs_item_lock];
	if($bbs_item_lock=='1')//如果用户传了自定义栏目名称来，就用自定义的名称，否则用栏目名称
	{
		return 1;
	}
	else
	{
		return 0;

	}

}
//取论坛栏目
function get_bbs_item($start_row=0,$rows_of_page=1,$bbs_item_name='',$colorsheme='black')
{
	$querystring="select * from bbs_item  order by  bbs_item_id  limit $start_row,$rows_of_page";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$bbs_item_id=$row[bbs_item_id];
	if(empty($bbs_item_name))//如果用户传了自定义栏目名称来，就用自定义的名称，否则用栏目名称
	{
		$bbs_item_name=$row[bbs_item_name];
	}
	echo "<font size=2 color=$colorsheme>";
	echo "·";
	echo "</font>";
	echo "<a href=\"/bbs/bbs_information_list.php?bbs_item_id=$bbs_item_id&current_page=0\" class=a3>";
	echo "<font color=$colorsheme>";
	echo $bbs_item_name;
	echo "</font>";
	echo "</a>";
}



//取用户发贴数
function get_bbs_user_information_number($bbs_item_id,$bbs_edit_user_id)
{
	$querystring="select * from bbs_information_main where
	bbs_item_id='$bbs_item_id'   and  
	bbs_edit_user_id='$bbs_edit_user_id'  and
	bbs_information_title!=''
	";
	$querystring="select * from bbs_information_main where
	bbs_edit_user_id='$bbs_edit_user_id'  and
	bbs_information_title!=''
	";
	$rs_number=mysql_query($querystring);
	$amount_of_rows=mysql_num_rows($rs_number);//当前条件下总记录数
	return $amount_of_rows;
}

//取本贴的子贴数
function get_bbs_information_child_number($bbs_information_id)
{
	$querystring="select * from bbs_information_main where
		bbs_information_parent_id='$bbs_information_id' and bbs_information_title!=''";
	//这里是取本贴的子贴数，但要排除废贴
	//echo $querystring;
	$rs_number=mysql_query($querystring);
	$amount_of_rows=mysql_num_rows($rs_number);//当前条件下总记录数
	return $amount_of_rows;
}

//取被引用贴的相关信息
function get_bbs_relation_information($bbs_information_id)
{
	$querystring="select * from bbs_information_main where
	bbs_information_id='$bbs_information_id'
	";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$bbs_edit_user_id=$row[bbs_edit_user_id];
	$bbs_information_date=$row[bbs_information_date];
	$bbs_information_title=$row[bbs_information_title];
	$bbs_information_inner_index=$row[bbs_information_inner_index];

	//echo "第".(intval($bbs_information_inner_index)/2)."楼";
	//	echo $bbs_information_title;
	//exit();

	$bbs_relation_information="引用 ".$bbs_edit_user_id." 于 ".$bbs_information_date." 在 "
	.(intval($bbs_information_inner_index)/2)." 楼发表 ".$bbs_information_title;
	//以下是对回复的引用
	$querystring_content="select * from bbs_information_content where
	bbs_information_id='$bbs_information_id'";
	$rs_content=mysql_query($querystring_content);
	$row_content=mysql_fetch_array($rs_content);
	$bbs_information_content=$row_content[bbs_information_content];
	//$bbs_relation_information=$bbs_relation_information." ".$bbs_information_content
	//	echo $bbs_relation_information;
	//exit();

	return $bbs_relation_information;


}



function get_bbs_user_level($bbs_item_id,$bbs_user_information_number)
{



	$querystring="select * from bbs_item_role where
	bbs_item_id='$bbs_item_id'   and  
	bbs_item_role_required_info_number>='$bbs_user_information_number'
	order by bbs_item_role_required_info_number
	limit 1
	";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$bbs_item_role=$row[bbs_item_role];
	return $bbs_item_role;


}


function get_bbs_information_title($bbs_information_parent_id)
{
	$querystring="select * from bbs_information_main where
		bbs_information_parent_id='$bbs_information_parent_id'   and  
		bbs_information_parent_id=bbs_information_id  and
		bbs_information_title!=''
		";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);//当前条件下总记录数
	$bbs_information_title=$row[bbs_information_title];
	return $bbs_information_title;

}

function get_recent_bbs_information($bbs_item_id,$number=4,$colorsheme='white')
{
	$querystring="select * from bbs_information_main where
	bbs_item_id='$bbs_item_id'   and  
	bbs_information_parent_id=bbs_information_id  and
	bbs_information_title!='' and 
	bbs_information_audit='1'
	order by bbs_information_date desc limit 0,$number";
	$rs=mysql_query($querystring);
	while($row=mysql_fetch_array($rs))//当前条件下总记录数
	{
		$bbs_information_id=$row[bbs_information_id];
		$bbs_information_parent_id=$row[bbs_information_parent_id];
		$bbs_information_title=$row[bbs_information_title];
		$current_page=0;
		echo "<font size=2 color=$colorsheme>";
		echo "·";
		echo "</font>";

		echo "<a href=\"bbs\bbs_information_show.php?
		bbs_information_parent_id=$bbs_information_parent_id&
		bbs_information_list_current_page=$current_page&
		bbs_item_id=$bbs_item_id
		\">";
		echo "<font color=$colorsheme>";
		echo my_sub_str($bbs_information_title,0,20);
		echo "</font>";
		echo "</a>";
		echo "<br>";
	}
}


function get_last_bbs_information($bbs_item_id,$bbs_information_id='')
{
	if(empty($bbs_information_id))//最后的主题
	{
		$querystring="select * from bbs_information_main where
		bbs_item_id='$bbs_item_id'   and  
		bbs_information_parent_id=bbs_information_id  and
		bbs_information_title!='' and 
		bbs_information_audit='1'
		order by bbs_information_date desc limit 1";
		$rs=mysql_query($querystring);
		$row=mysql_fetch_array($rs);//当前条件下总记录数
		$bbs_information_title=$row[bbs_information_title];
		$bbs_edit_user_id=$row[bbs_edit_user_id];
		$bbs_information_date=$row[bbs_information_date];
		echo $bbs_information_title;
		echo "<br>";
		echo "由 ".$bbs_edit_user_id." 发表于 ".$bbs_information_date;
	}
	else//最后的回贴
	{
		$querystring="select * from bbs_information_main where
		bbs_item_id='$bbs_item_id'   and  
		bbs_information_parent_id='$bbs_information_id'  and
		bbs_information_title!=''
		order by bbs_information_inner_index desc limit 1";
		$rs=mysql_query($querystring);
		$row=mysql_fetch_array($rs);//当前条件下总记录数
		$bbs_information_title=$row[bbs_information_title];
		$bbs_edit_user_id=$row[bbs_edit_user_id];
		$bbs_information_date=$row[bbs_information_date];
		//echo $bbs_information_title;
		echo "由 ".$bbs_edit_user_id;
		echo "<br>";
		echo " 发表于 ".$bbs_information_date;

	}

}
//统计主题数
function count_bbs_information_main($bbs_item_id)
{
	$querystring="select * from bbs_information_main where
		bbs_item_id='$bbs_item_id'   and  
		bbs_information_parent_id=bbs_information_id  and
		bbs_information_title!=''
		order by bbs_information_date desc";
	$rs_number=mysql_query($querystring);
	$amount_of_rows=mysql_num_rows($rs_number);//当前条件下总记录数
	return $amount_of_rows;
}
//统计贴数
function count_bbs_information_reply($bbs_item_id,$bbs_information_id='',$show='false')
{
	if(empty($bbs_information_id))//最后的主题
	{
		$querystring="select * from bbs_information_main where
		bbs_item_id='$bbs_item_id'   and  
		bbs_information_title!=''
		order by bbs_information_date desc";
		$rs_number=mysql_query($querystring);
		$amount_of_rows=mysql_num_rows($rs_number);//当前条件下总记录数
		return $amount_of_rows;
	}
	elseif($show=='false')
	{
		$querystring="select * from bbs_information_main where
		bbs_item_id='$bbs_item_id'   and  
		bbs_information_parent_id='$bbs_information_id'  and
		bbs_information_title!=''
		";
		//echo $querystring;
		$rs_number=mysql_query($querystring);
		$amount_of_rows=mysql_num_rows($rs_number)+1;//当前条件下总记录数
		//将此值写入主贴中
		$query_string="update bbs_information_main set
		bbs_information_reply_counter=$amount_of_rows
		where  bbs_information_id='$bbs_information_id'";
		//echo $query_string;
		$operate=mysql_query($query_string);
		//echo 	$query_string;
		return $amount_of_rows;

	}else
	{
		$querystring="select * from bbs_information_main where
		bbs_item_id='$bbs_item_id'   and  
		bbs_information_parent_id='$bbs_information_id'  and
		bbs_information_title!=''
		";
		//echo $querystring;
		$rs_number=mysql_query($querystring);
		$amount_of_rows=mysql_num_rows($rs_number)+1;//当前条件下总记录数
		return $amount_of_rows;
	}
}

function get_attachment($bbs_information_id)//看看是否有附件
{
	$querystring="select * from bbs_information_attachment where bbs_information_id='$bbs_information_id'";
	$rs_number=mysql_query($querystring);
	$num_rows=mysql_num_rows($rs_number);
	if($num_rows>0)
	{
		return 1;
	}
	else
	{
		return 0;
	}

}

function bbs_operator($bbs_item_id,$bbs_user_id)//测试是否是版主
{
	$querystring="select * from bbs_item_operator  where bbs_item_id='$bbs_item_id' and bbs_user_id='$bbs_user_id' ";
	//echo $querystring;
	$rs_number=mysql_query($querystring);
	$num_rows=mysql_num_rows($rs_number);
	if($num_rows==1)
	{
		return 1;
	}
	else
	{
		return 0;
	}

}
function get_bbs_operator_list($bbs_item_id)//返回版主列表
{
	$querystring="select * from bbs_item_operator  where bbs_item_id='$bbs_item_id'";
	//echo $querystring;
	$rs=mysql_query($querystring);
	$operator_list="";
	while($row=mysql_fetch_array($rs))
	{
		$operator_list=$operator_list.$row[bbs_user_id]."\n";
	}
	return $operator_list;
}


//取bbs同一主题回复的内部序号
function  get_bbs_information_inner_index($bbs_information_parent_id,$bbs_information_id)
{
	$querystring="select * from bbs_information_main where bbs_information_id='$bbs_information_id'  and
	 bbs_information_parent_id='$bbs_information_parent_id' ";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	//$bbs_item_id=$row[bbs_item_id];
	$bbs_information_inner_index=$row[bbs_information_inner_index];
	return $bbs_information_inner_index;

}

function  get_bbs_information_parent_id($bbs_information_id)
{
	$querystring="select * from bbs_information_main where bbs_information_id='$bbs_information_id'";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	//$bbs_item_id=$row[bbs_item_id];
	$bbs_information_parent_id=$row[bbs_information_parent_id];
	return $bbs_information_parent_id;

}
function  user_has_bbs_information_id($bbs_user_id,$bbs_information_id)//判断是否是BBS用户自己在修改自己的信息
{
	$querystring="select * from bbs_information_main where bbs_information_id='$bbs_information_id'";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	//$bbs_item_id=$row[bbs_item_id];
	$bbs_edit_user_id=$row[bbs_edit_user_id];
	if($bbs_edit_user_id==$bbs_user_id)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
function  get_user_face($bbs_user_id)//返回用户自定义头像
{
	$querystring="select * from bbs_user where bbs_user_id='$bbs_user_id'";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$bbs_user_face=$row[bbs_user_face];
	return $bbs_user_face;

}
function  get_bbs_user_self_description($bbs_user_id)//返回用户签名
{
	$querystring="select * from bbs_user where bbs_user_id='$bbs_user_id'";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$bbs_user_self_description=$row[bbs_user_self_description];
	return $bbs_user_self_description;
}

function get_bbs_item_name($bbs_item_id='')
{
	$querystring="select * from bbs_item  where   bbs_item_id='$bbs_item_id'";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	return $row[bbs_item_name];
}
function bbs_item_list_menu($current_bbs_item_id='',$type='none',$form_name='form1')
{
	$querystring="select * from bbs_item  order by  bbs_item_id";
	$rs=mysql_query($querystring);
	if($type=='none')
	{
		echo  "<select name=\"bbs_item_id\" >";
	}
	if($type=='auto_post_back')
	{
		echo  "<select name=\"bbs_item_id\"  onchange=document.$form_name.submit()>";
	}

	while($row=mysql_fetch_array($rs))
	{
		$select_vlaue=$row[bbs_item_id];
		$select_display_value=$row[bbs_item_name];
		if($select_vlaue==$current_bbs_item_id)
		{
			echo  "<option value='$select_vlaue' selected>$select_display_value</option>";
		}
		else
		{
			echo  "<option value=$select_vlaue>$select_display_value</option>";

		}

	}
	echo  "</select>";
}
//用于悄悄话的对象设定

function bbs_dest_user_list_menu($current_bbs_dest_user_id='公众',$bbs_item_id='',$bbs_information_parent_id='',$type='none',$form_name='form1')
{
	//本函数按先取‘公众’ 再取 ‘版主’ 再取回贴人的顺序取值

	if($type=='none')
	{
		echo  "<select name=\"bbs_dest_user_id\" >";
	}
	if($type=='auto_post_back')
	{
		echo  "<select name=\"bbs_dest_user_id\"  onchange=document.$form_name.submit()>";
	}
	//全部
	$select_value='公众';
	$select_display_value='公众';
	if($select_value==$current_bbs_dest_user_id)
	{
		echo  "<option value='$select_value' selected>$select_display_value</option>";
	}
	else
	{
		echo  "<option value=$select_value>$select_display_value</option>";

	}

	//从版主表内取数据
	$querystring="select distinct bbs_user_id from bbs_item_operator order by  bbs_user_id";
	$rs=mysql_query($querystring);
	while($row=mysql_fetch_array($rs))
	{
		$select_value=$row[bbs_user_id];
		$select_display_value=$row[bbs_user_id];
		if($select_value==$current_bbs_dest_user_id)
		{
			echo  "<option value='$select_value' selected>$select_display_value</option>";
		}
		else
		{
			echo  "<option value=$select_value>$select_display_value</option>";

		}

	}

	$querystring="select distinct t1.bbs_user_id from bbs_item_operator as t1
	LEFT JOIN bbs_information_main as t2  ON t1.bbs_user_id=t2.bbs_edit_user_id
	where t1.bbs_item_id='$bbs_item_id'  and t2.bbs_edit_user_id IS NULL order by  t1.bbs_user_id";

	//从回贴内取数据
	//$querystring="select  distinct bbs_edit_user_id  from bbs_information_main where  bbs_information_parent_id='$bbs_information_parent_id'  and bbs_information_title!='' order by  bbs_edit_user_id";

	$querystring="select distinct t1.bbs_edit_user_id from bbs_information_main as t1
	LEFT JOIN bbs_item_operator as t2  ON t1.bbs_edit_user_id=t2.bbs_user_id
	where  t2.bbs_user_id IS NULL and bbs_information_parent_id='$bbs_information_parent_id'  and bbs_information_title!='' order by  bbs_edit_user_id";


	$rs=mysql_query($querystring);
	while($row=mysql_fetch_array($rs))
	{
		$select_value=$row[bbs_edit_user_id];
		$select_display_value=$row[bbs_edit_user_id];
		if($select_value==$current_bbs_dest_user_id)
		{
			echo  "<option value='$select_value' selected>$select_display_value</option>";
		}
		else
		{
			echo  "<option value=$select_value>$select_display_value</option>";

		}

	}
	//从版主表内取数据

	echo  "</select>";

}


function bbs_user_list_menu($current_bbs_user_id='',$type='none',$form_name='form1')
{
	$querystring="select * from bbs_user  order by  bbs_user_id";
	$rs=mysql_query($querystring);
	if($type=='none')
	{
		echo  "<select name=\"bbs_user_id\" >";
	}
	if($type=='auto_post_back')
	{
		echo  "<select name=\"bbs_user_id\"  onchange=document.$form_name.submit()>";
	}

	while($row=mysql_fetch_array($rs))
	{
		$select_vlaue=$row[bbs_user_id];
		$select_display_value=$row[bbs_user_id];
		if($select_vlaue==$current_bbs_user_id)
		{
			echo  "<option value='$select_vlaue' selected>$select_display_value</option>";
		}
		else
		{
			echo  "<option value=$select_vlaue>$select_display_value</option>";

		}

	}
	echo  "</select>";

}


function used($table,$condition)
{
	$querystring="select * from $table  where $condition";
	//echo $querystring;
	$rs_number=mysql_query($querystring);
	$num_rows=mysql_num_rows($rs_number);
	if($num_rows>0)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}


function edit_after_audit($item_id)
{
	$querystring="select * from item  where  item_id='$item_id' ";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$edit_after_audit=$row[edit_after_audit];
	if($edit_after_audit)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}



function get_condition($unit_id='',$department_id='',$staff_id='',$staff_level_id='')
{
	$condition="
	(
		(information_destination.scope='outer') or 
		(
			(
				(information_destination.scope='inner' and information_destination.dest_unit_id='".get_bottom_id('unit','unit_id')."' and information_destination.dest_department_id='".get_bottom_id('department','department_id')."' and dest_staff_id='".get_bottom_id('staff','staff_id')."') or
				(information_destination.scope='inner' and information_destination.dest_unit_id='$unit_id' and information_destination.dest_department_id='".get_bottom_id('department','department_id')."' and dest_staff_id='".get_bottom_id('staff','staff_id')."') or
				(information_destination.scope='inner' and information_destination.dest_unit_id='$unit_id' and information_destination.dest_department_id='$department_id' and information_destination.dest_staff_id='".get_bottom_id('staff','staff_id')."') or
				(information_destination.scope='inner' and information_destination.dest_unit_id='$unit_id' and information_destination.dest_department_id='$department_id' and information_destination.dest_staff_id='$staff_id')
			)
			and
			(
				information_destination.dest_staff_level_id>='$staff_level_id'		
			)
		)
	)";
	return $condition;
	//注information_destination.dest_staff_level_id>='$staff_level_id'
	//人员级别的ID是先定义级别最高的，如院级01 处级02  科级03 如果目标级别是科级，则小于目标级别的都在范围之内，处级与
	//院 级就能查看堆放了
}



//建立取多条信息标题的函数 get_info_title_list($table,$field_name,$condition)

function info_title_list($item_id,$start_row=0,$rows_of_page=10,$condition='1',$colorsheme='white',$title_length=46,$show_date="show_date")
{

	$querystring="select distinct information_main.* from information_main inner join information_destination
	on 
	information_main.info_id=information_destination.info_id  and 
	$condition
	 where 
	information_main.item_id='$item_id' and information_main.audit_staff_id_final!=''   
	order by information_main.info_date desc limit $start_row,$rows_of_page ";
	//echo $querystring;
	$rs=mysql_query($querystring);
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	while($row=mysql_fetch_array($rs))
	{

		$info_id=$row[info_id];
		$info_date=$row[info_date];
		$info_title=$row[info_title];
		$info_date=my_sub_str($info_date,0,10);
		$info_title=my_sub_str($info_title,0,$title_length);
		echo  "<tr>";
		if($show_date=="show_date")
		{
			echo "<td width=\"5%\">";
			echo " ";
			echo "</td>";
			echo  "<tr>";
			echo "<td width=\"5%\" align=\"center\">";
			//echo "<div align=\"center\"><img src=\"/images/pics/dot2.jpg\" width=\"9\" height=\"8\"></div> ";
			echo "<font size=1 color=$colorsheme>";
			echo "◆";
			echo "</font>";
			echo "</td>";
			echo "<td width=\"70%\">";
			echo "<a href=\"./information_management/information_show.php?info_id=$info_id\" target='_blank'>";
			echo "<font color=$colorsheme>";
			echo $info_title;
			echo "</font>";
			echo "</a>";
			echo "</td>";
			echo "<td width=\"15%\">";
			echo "<font color=$colorsheme>";
			echo $info_date;
			echo "</font>";
			echo "</td>";
		}
		else
		{
			echo "<td width=\"5%\">";
			echo " ";
			echo "</td>";
			echo  "<tr>";
			echo "<td width=\"5%\" align=\"center\">";
			//echo "<div align=\"center\"><img src=\"/images/pics/dot2.jpg\" width=\"9\" height=\"8\"></div> ";
			echo "<font size=1 color=$colorsheme>";
			echo "◆";
			echo "</font>";
			echo "</td>";
			echo "<td width=\"85%\"  colspan='2'>";
			echo "<a href=\"./information_management/information_show.php?info_id=$info_id\" target='_blank'>";
			echo "<font color=$colorsheme>";
			echo $info_title;
			echo "</font>";
			echo "</a>";
			echo "</td>";

		}
		//echo $value;
		echo  "</tr>";
	}
	echo  "<tr>";
	echo "<td width=\"5%\">";
	echo " ";
	echo "</td>";
	echo "<td width=\"70%\">";
	echo "&nbsp;";
	echo "</td>";
	echo "<td width=\"30%\">";

	echo "<a href=\"/information_management/information_show_more.php?item_id=$item_id\">";
	echo "<font color=$colorsheme>";
	if($show_date=="show_date")
	{
		echo "更多......";
	}
	if($show_date=="not_show_date")
	{
		echo "更多";
	}

	echo "</font>";

	echo "</a>";
	echo "</td>";
	echo  "</tr>";
	echo "</table>";

}
//建立取多条信息标题的函数 按指定字段排序,就是热点信息,此信息并不分栏目
function info_title_list_by_order($index,$start_row=0,$rows_of_page=10,$condition='1',$colorsheme='white',$title_length=46)
{

	$querystring="select distinct information_main.* from information_main inner join information_destination
	on 
	information_main.info_id=information_destination.info_id  and 
	$condition
	 where 
	information_main.audit_staff_id_final!=''   
	order by information_main.".$index." desc limit $start_row,$rows_of_page ";
	//echo $querystring;
	$rs=mysql_query($querystring);
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	while($row=mysql_fetch_array($rs))
	{
		$item_id=$row[item_id];
		if(hot_item($item_id)=='true')
		{
			$info_id=$row[info_id];
			$info_date=$row[info_date];
			$info_title=$row[info_title];
			$info_date=my_sub_str($info_date,0,10);
			$info_title=my_sub_str($info_title,0,$title_length);
			echo  "<tr>";
			echo "<td width=\"10%\" align=\"center\">";
			//echo "<div align=\"center\"><img src=\"/images/pics/dot2.jpg\" width=\"9\" height=\"8\"></div> ";
			echo "<font size=1 color=$colorsheme>";
			echo "◆";
			echo "</font>";
			echo "</td>";
			echo "<td width=\"90%\">";
			echo "<a href=\"information_show.php?info_id=$info_id\" target='_blank'>";
			echo "<font color=$colorsheme>";
			echo $info_title;
			echo "</font>";
			echo "</a>";
			echo "</td>";
			//echo $value;
			echo  "</tr>";
		}
	}
	echo "</table>";

}
//测试是否是热点栏目
function hot_item($item_id)
{
	$querystring="select * from item  where	item_id='$item_id'";
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	return $row[hot_item];
}
//建立通过点击标题显示更多信息的函数 20051005
function information_show_more($item_id,$color_scheme='black',$size='5')
{
	echo "<a href=\"/information_management/information_show_more.php?item_id=$item_id\">";
	echo "<font color=$color_scheme size=$size><strong>";
	echo get_item_name($item_id,"white");
	echo "</strong></font>";

}

//建立取多条信息与图片的函数 get_info_title_list($table,$field_name,$condition)

function info_title_picture_show($item_id,$start=0,$number=10,$condition='1')
{


	$querystring="select * from information_main  where
	item_id='$item_id' and audit_staff_name!=''  and $condition 
	order by info_date desc limit $start,$number ";
	//echo $querystring;
	$rs=mysql_query($querystring);
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	echo  "<tr>";
	echo "<td width=\"100%\"  align=\"center\">";
	echo "<marquee  scrollamount=2   direction=up  width=150 height=150 onmouseover='this.stop()' onmouseout='this.start()'>";
	while($row=mysql_fetch_array($rs))
	{

		$info_id=$row[info_id];
		$info_date=$row[info_date];
		$info_title=$row[info_title];
		$info_date=my_sub_str($info_date,0,10);
		$info_title=my_sub_str($info_title,0,60);

		$querystring="select * from information_content where info_id='$info_id'";
		$rs1=mysql_query($querystring);
		$row1=mysql_fetch_array($rs1);
		$picture1_name=$row1[picture1_name];
		$picture2_name=$row1[picture2_name];
		$picture3_name=$row1[picture3_name];
		$picture4_name=$row1[picture4_name];

		//显示相关图片
		for($counter=1;$counter<=4;$counter++)
		{
			//echo $picture.trim(strval($counter))."_name";
			$picture_name="picture".trim(strval($counter))."_name";
			//echo $$picture_name;
			if(!empty($$picture_name))
			{
				$$picture_name="/information_management/upload/".basename($$picture_name);
				$size=@GetImageSize($$picture_name);
				$x=$size[0];

				$y=$size[1];
				//echo $x.$y;
				if($x<=150)
				{
					echo "<br>";
					echo "<img src='".$$picture_name."' width=$x height=$y></img>";
				}
				else
				{
					$y=150*$y/$x;
					$x=150;
					echo "<br>";
					echo "<img src='".$$picture_name."' width=$x height=$y></img>";
				}
			}
		}


		echo "<a href=\"/information_management/information_show.php?info_id=$info_id\" target='_blank'>";
		echo "<br>";
		echo $info_title;
		echo "</a>";
	}
	echo "</marquee>";
	echo "</td>";
	//echo $value;
	echo  "</tr>";
	echo "</table>";


}

//建立取多条图片的函数 get_info_title_list($table,$field_name,$condition)

function info_picture_show($item_id,$start_row=0,$rows_of_page=10,$condition='1',$root='',$picture_path='information_management/upload/',$picture_type="normal",$direction='up',$show_title='title',$require_x=120,$require_y=100)
{

	if(empty($picture_path))
	{
		echo "缺少文件路径";
		exit();
	}
	$querystring="select information_main.* from information_main inner join information_destination
	on 
	information_main.info_id=information_destination.info_id  and 
	$condition
	 where 
	information_main.item_id='$item_id' and information_main.audit_staff_id_final!=''   
	order by information_main.info_date desc limit $start_row,$rows_of_page ";
	//echo $querystring;
	$rs=mysql_query($querystring);
	echo "<table width=\"100%\" height=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">";
	echo  "<tr>";
	echo "<td align=\"center\" valign=\"top\">";
	// echo "<marquee  scrollamount=2   direction=up  width=120 height=140 onmouseover='this.stop()' onmouseout='this.start()'>";
	if($direction!='still')
	{
		echo "<marquee  scrollamount=2 direction=$direction width='100%' height='100%' onmouseover='this.stop()' onmouseout='this.start()'>";
	}
	else
	{
		//echo "still";
		//exit();
	}
	while($row=mysql_fetch_array($rs))
	{
		$info_id=$row[info_id];
		//$full_name=$root.$path."/information_management/information_show.php";
		$info_date=$row[info_date];
		$info_title=my_sub_str($row[info_title],0,12);//一般为人名或是新产品名称，只取前６个汉字
		$info_date=my_sub_str($info_date,0,10);
		//在本模块中只取每条信息的第一张图片
		$querystring="select * from information_attachment where info_id='$info_id'  and attachment_type='picture' and attachment_picture_name!='' order by attachment_index desc limit 1";
		$rs1=mysql_query($querystring);
		$row1=mysql_fetch_array($rs1);
		$attachment_picture_name=$row1[attachment_picture_name];
		$attachment_picture_title=$row1[attachment_picture_title];
		$attachment_picture_url=$row1[attachment_picture_url];

		$extend_name=substr(strrchr($attachment_picture_name,"."),1);
		$extend_name = strtolower($extend_name);


		if(!empty($attachment_picture_name) and ($extend_name=='jpg' or $extend_name=='jpeg' or $extend_name=='gif'))//有图片文件才显示
		{

			if($show_title=='title')
			{
				echo "<center><strong>$info_title</strong></center>";
			}
			//$root=$_SERVER['DOCUMENT_ROOT'];
			$path='/information_management/';
			$full_name=$path."information_show.php?info_id=$info_id";
			if(!empty($attachment_picture_url))//如果图片本身不带url，则将其url指定为某一信息的入口
			{

			}
			else
			{
				$attachment_picture_url=$full_name;
			}

			//echo "<a href=\"$full_name\" target='_blank'>";

			//$picture_path='information_management/upload/';

			if($picture_type=='normal')
			{
				$full_name=$picture_path.$attachment_picture_name;

			}
			if($picture_type=='small')//显示缩略图
			{
				$full_name=$picture_path."small_".$attachment_picture_name;

			}

			show_image($full_name,$require_x,$require_y,$direction,$attachment_picture_url);
			//echo "</a>";
			//echo "<br>";
		}

	}
	if($direction!='still')
	{
		echo "</marquee>";
	}
	else
	{

	}
	echo "</td>";
	//echo $value;
	echo  "</tr>";
	echo "</table>";


}



//做图片的等比变化
function adjust_image(&$x,&$y,$required_x,$required_y)
{
	if(($x/$required_x)>=($y/$required_y))//按x做缩放
	{
		$y=$y/($x/$required_x);
		$x=$required_x;
	}
	else//按y做缩放
	{
		$x=$x/($y/$required_y);
		$y=$required_y;
	}
}
//图片类的显示

function show_image($full_name,$require_x,$require_y,$direction='',$url='',$target="target='_blank'")
{
	//direction用于当垂直滚动或是水平滚动是的居中
	//echo $full_name;
	//echo $require_x;
	//echo $require_y;
	$extend_name=substr(strrchr($full_name,"."),1);
	$extend_name = strtolower($extend_name);

	if($extend_name=='mp3' or $extend_name=='wma')//mp3类
	{
		//echo "<object classid=\"clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95\" id=\"MediaPlayer1\"  width=$require_x height=$require_y>";
		echo "<object classid=\"clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95\" id=\"MediaPlayer1\"  width=200 height=40>";
		echo "<param name=\"Filename\" value=$full_name>";
		echo "</object>";

	}

	if($extend_name=='mpeg' or $extend_name=='mpg' or $extend_name=='wmv')//电影类
	{
		echo "<object classid=\"clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95\" id=\"MediaPlayer1\"  width=$require_x height=$require_y>";
		echo "<param name=\"Filename\" value=$full_name>";
		echo "</object>";

	}
	//echo $direction;
	if($direction=='up' or empty($direction))
	{
		echo "<div   align=\"center\">";
		//echo "ddd";
	}
		//echo "<div   align=\"center\">";
	if($extend_name=='jpg' or $extend_name=='jpeg' or $extend_name=='gif')
	{

		$size=@GetImageSize($full_name);
		//print_r($size);
		$x=$size[0];
		$y=$size[1];
		if($x>$require_x or $y>$require_y)
		{
			adjust_image($x,$y,$require_x,$require_y);
		}
		//echo $x."  dd ".$y;
		if(!empty($url))
		{
			echo "<a href=$url $target><img src=$full_name width=$x height=$y  border='0'></img></a>";
		}
		else
		{
			echo "<img src=$full_name width=$x height=$y  border='0'></img>";
		}
		//echo $direction;
		if($direction=='left')
		{
			echo "&nbsp;";
		}
		else
		{
			echo "<br>";
		}
	}
	if($direction=='up' or empty($direction))
	{
		echo "</div>";
	}
	//echo "<br>";
	if($extend_name=='swf')//flash;
	{
					?>
					<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width=<? echo $require_x;?> height=<? echo $require_y; ?>>
					<param name="movie" value="<? echo $full_name;?>">
					<param name="quality" value="high">
					<embed src="flash/<? echo $full_name;?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width=<? echo $require_x;?> height=<? echo $require_y; ?>></embed></object>
					<?
	}



}

function show_blank_line($span=1)
{
 		echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' >";
        echo "<tr>";
        echo "<td height=".$span."></td>";
        echo "<tr>";
 		echo "</table>";
}

//建立取多条调查问题标题的函数 vote_title_list($table,$field_name,$condition)

function vote_title_list($start_row=0,$rows_of_page=10,$condition='1',$colorsheme='black')
{

	$querystring="select * from vote_item
	 where 
	vote_item_secrecy!='*'  
	order by vote_item_date desc limit $start_row,$rows_of_page ";
	//echo $querystring;
	$rs=mysql_query($querystring);
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	$current_page=0;//用于点击项目时计算所在页数，在本模块中一页只有一项
	while($row=mysql_fetch_array($rs))
	{

		$vote_item_id=$row[vote_item_id];
		$vote_item_name=$row[vote_item_name];
		$vote_item_date=$row[vote_item_date];
		$vote_item_secrecy=$row[vote_item_secrecy];
		echo  "<tr>";
		echo "<td>";
		echo "<font size=2 color=$colorsheme>";
		echo " ◆ ";
		echo "</font>";
		echo "</td>";
		echo "<td>";
		echo "<a href=\"\information_management\vote_show.php?vote_item_id=$vote_item_id&current_page=$current_page\">";
		echo "<font color=$colorsheme>";
		echo my_sub_str($vote_item_name,0,30);
		echo "</font>";

		echo "</td>";
		echo  "</tr>";
		$current_page=$current_page+1;//用于点击项目时计算所在页数，在本模块中一页只有一项

	}
	echo "</table>";

}





//建立取信息标题的函数 get_info_title($table,$field_name,$condition)
function get_info_title($table,$field_name,$condition='0')
{
	$querystring="select $field_name from $table  where $condition ";
	//echo $querystring;
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$value=$row[$field_name];
	return $value;
}


function my_sub_str($string,$start=0,$length=0)
{
	//echo $start;
	$strlen=strlen($string);
	if($start>$strlen)
	{
		echo "参数值有错!";
		exit();

	}
	if(($start+$length)<=$strlen)
	{

	}
	else
	{
		$length=$strlen-$start;
	}
	//中国china中国
	//检查开始位置是否是在一个汉字的中间,如果是，则向前退一自动包括一个完整的汉字
	$gb2312=0;
	for($counter=0;$counter<=$start;$counter++)
	{
		if(ord($string[$counter])<=122)//英文字符及数字
		{
			//do nothing here
			//echo "e";
			$gb2312=0;
		}
		if(ord($string[$counter])>=161 and $gb2312==0)//一个汉字开始
		{
			//echo "c1";
			$gb2312=1;
		}
		elseif(ord($string[$counter])>=161 and $gb2312==1)//一个汉字结束
		{
			//echo "c2";
			//$counter++;
			$gb2312=0;
		}
	}
	//echo $counter;
	if(ord($string[$start])>=161 and $gb2312==0)
	{
		//echo "half char";
		$start=$start-1;
	}

	//检查结束位置是否是在一个汉字的中间如果是，则向前退一

	$gb2312=0;
	for($counter=$start;$counter<=$start+$length;$counter++)
	{
		if(ord($string[$counter])<=122)//英文字符及数字
		{
			//do nothing here
			//echo "e";
			$gb2312=0;
		}
		if(ord($string[$counter])>=161 and $gb2312==0)//一个汉字开始
		{
			//echo "c1";
			$gb2312=1;
		}
		elseif(ord($string[$counter])>=161 and $gb2312==1)//一个汉字结束
		{
			//echo "c2";
			//$counter++;
			$gb2312=0;
		}
	}
	//echo $counter;
	if(ord($string[$start+$length])>=161 and $gb2312==0)
	{
		//echo "half char";
		$length=$length-1;
	}

	return substr($string,$start,$length);
}


//本函数可以返回此人是否是指定的审核人员
function is_audit($unit_id,$department_id,$staff_id,$info_id)
{
	$querystring="select * from information_audit  where
	audit_staff_id='$staff_id' and audit_unit_id='$unit_id' and audit_department_id='$department_id' and info_id='$info_id' ";
	$rs_number=mysql_query($querystring);
	$num_rows=mysql_num_rows($rs_number);
	if($num_rows==1)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

//本函数可以返回此人是否是本信息的编辑者
function is_editer($unit_id,$department_id,$staff_id,$info_id)
{
	$querystring="select * from information_main  where
	edit_staff_id='$staff_id' and edit_unit_id='$unit_id' and edit_department_id='$department_id' and info_id='$info_id' ";
	$rs_number=mysql_query($querystring);
	$num_rows=mysql_num_rows($rs_number);
	if($num_rows==1)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}


function operator($unit_id,$department_id,$staff_id,$item_id="",$role_column="")
{
	//本函数可以返回此人是否是操作员，如果有item and role还能返回是否具有某种权限
	if(empty($item_id) or empty($role_column))//仅测试是否是操作员
	{
		$querystring="SELECT * from operator where unit_id='$unit_id' and department_id='$department_id'  and staff_id='$staff_id'";
	}
	else//测试对某栏目是否具有某种操作能力
	{
		$querystring="SELECT * from operator where unit_id='$unit_id' and department_id='$department_id'  and staff_id='$staff_id' and item_id='$item_id' and $role_column='true'";
		//echo $querystring;
	}
	//echo $querystring;
	$rs=mysql_query($querystring);
	$row_number=mysql_num_rows($rs);
	if($row_number>=1)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
//栏目是否需要审定
function need_audit($item_id)
{
	$querystring="select * from item  where item_id='$item_id'";
	//echo $querystring;
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$audit=$row[audit];
	//echo $audit;
	if($audit=='false')//如果不需要审定
	{
		return 0;
	}
	else
	{
		return 1;
	}
}


function true_or_false_list_menu($temp_item,$current_audit="true",$show_type='drop_down_box')
{
	if($show_type=='drop_down_box')
	{
		echo "<select name=$temp_item>";
		if($current_audit=="true")
		{
			echo  "<option value='true' selected>是</option>";
			echo  "<option value='false'>否</option>";
		}
		else
		{
			echo  "<option value='true'>是</option>";
			echo  "<option value='false' selected>否</option>";
		}
		echo "</select>";
	}
	if($show_type=='text')
	{
		if($current_audit=="true")
		{
			echo  "是";
		}
		else
		{
			echo  "否";
		}

	}
}


function sub_empty($table,$field_name,$field_value,$condition='')//此功能为测试下级是否为空，多用于判断是否能删除
{
	//用condition的原因是有一些表的下级是由二个以上的条件确定，按以前的方法不行，就增加了此条件
	if(empty($condition))
	{
		$querystring="select * from $table  where $field_name=$field_value";
	}
	else
	{
		$querystring="select * from $table  where $condition";

	}
	//echo $querystring;
	$rs_number=mysql_query($querystring);
	$num_rows=mysql_num_rows($rs_number);
	//echo $num_rows;
	if($num_rows>1)//这里取大于1是因为有一条初值999...
	{
		return false;
	}
	else
	{
		return true;

	}
}



//翻页用页码下拉框
function select_page_list_menu($current_page=0,$type='none',$form_name='forms[0]',$amount_of_pages=0)
{

	
	echo "<input name=\"go\" type=\"submit\" id=\"go\" value=\"到\">";
	if($type=='auto_post_back')
	{
		echo  "<select name=\"select_page\"  onchange=document.$form_name.submit()>";
	}
	else
	{
		echo  "<select name=\"select_page\" >";
	}
	//因为amount_of_pages也是从零开始计数的，所以这里是<=$amount_of_pages
	for($counter=0;$counter<=$amount_of_pages;$counter++)
	{
		$disp=strval($counter+1)."页";
		if($counter==$current_page)
		{
			echo "<option value=$current_page selected>$disp</option>";
		}
		else
		{
			echo "<option value=$counter>$disp</option>";
		}
	}
	echo "</select>";
	//echo $current_page;
	//echo $amount_of_pages;
	//在调用模块里必须加如下代码以接收参数
	//if($_POST[go])
	//{
	//	$current_page=$_POST[select_page];
	//}

}



function item_list_menu($current_item_id="",$type='none',$form_name='form1',$unit_id='',$department_id='',$staff_id='',$staff_level_id='')
{
	//如果有$staff_level_id的作用在于当用户进入信息发布模块时，只将用户有权限的栏目显示出来，这样，就要
	//从权限表中取栏目名称

	if(empty($staff_id))//一般性的取栏目名称
	{
		$querystring="select * from item  order by  item_id";
	}
	elseif(!empty($staff_id) and empty($staff_level_id)) //操作员进入
	{
		$querystring="select * from operator
		where unit_id='$unit_id' and department_id='$department_id' and staff_id='$staff_id' order by  item_id";

	}
	elseif(!empty($staff_id) and !empty($staff_level_id)) //用户进入个人收件
	{
		$condition=get_condition($unit_id,$department_id,$staff_id,$staff_level_id);
		$querystring="select distinct(information_main.item_id) from information_main inner join information_destination
		on 
		information_main.info_id=information_destination.info_id  and 
		$condition
		 where 
		information_main.audit_staff_id_final!=''   
		order by information_main.item_id desc";

	}

	//echo $querystring;
	$rs=mysql_query($querystring);
	if($type=='none')
	{
		echo  "<select name=\"item_id\" >";
	}
	if($type=='auto_post_back')
	{
		echo  "<select name=\"item_id\"  onchange=document.$form_name.submit()>";
	}

	while($row=mysql_fetch_array($rs))
	{
		$select_vlaue=$row[item_id];
		$select_display_value=get_item_name($select_vlaue);
		if($select_vlaue==$current_item_id)
		{
			echo  "<option value='$select_vlaue' selected>$select_display_value</option>";
		}
		else
		{
			echo  "<option value=$select_vlaue>$select_display_value</option>";

		}

	}
	echo  "</select>";


}



function unit_list_menu($current_unit_id='',$type='none',$form_name='form1')
{
	if($current_unit_id=='')//第一次进入，初始化为全部
	{
		$current_unit_id=get_bottom_id('unit','unit_id');
	}
	echo "<input type='hidden'  name='old_unit_id_temp'   value=$current_unit_id>";//记录上个值
	$querystring="select * from unit  order by  unit_id desc";
	//echo $querystring;
	$rs=mysql_query($querystring);
	if($type=='none')
	{
		echo  "<select name=\"unit_id\" >";
	}
	if($type=='auto_post_back')
	{
		echo  "<select name=\"unit_id\"  onchange=document.$form_name.submit()>";
	}

	while($row=mysql_fetch_array($rs))
	{
		$select_value=$row[unit_id];
		$select_display_value=$row[unit_name];
		if($select_value==$current_unit_id)
		{
			echo  "<option value='$select_value' selected>$select_display_value</option>";
		}
		else
		{
			echo  "<option value=$select_value>$select_display_value</option>";

		}

	}
	echo  "</select>";


}


function department_list_menu($current_unit_id='',$current_department_id='',$type='none',$form_name='form1')
{
	if($current_unit_id=='')
	{
		$current_unit_id=get_bottom_id('unit','unit_id');
	}
	if($current_department_id=='')//初始化为‘全部’
	{
		$current_department_id=get_bottom_id('department','department_id');
	}
	echo "<input type='hidden'  name='old_department_id_temp'   value=$current_department_id>";//记录上个值

	if($current_unit_id!=get_bottom_id('unit','unit_id'))//用户选择了一个正常的一级部门
	{
		$querystring="select * from department where unit_id='$current_unit_id' order by  department_id desc";
	}
	//如果用户换了一级部门(一个正确的部门而不是全部)，就让二级部门当前值为全部

	if(isset($_POST[old_unit_id_temp]) and ($current_unit_id!=$_POST[old_unit_id_temp]))
	{
		$current_department_id=get_bottom_id('department','department_id');
		//重新取值
		$querystring="select * from department where unit_id='$current_unit_id' order by  department_id desc";
		//echo "change unit";
	}

	if($current_unit_id==get_bottom_id('unit','unit_id'))//如果一级部门是全部，二级也设为全部
	{
		//$querystring="select * from department  order by department_id desc limit 0,1 ";//一定注意是0,1因为有一代表全部的9的代码
		$current_department_id=get_bottom_id('department','department_id');
		//只取一个全部值999...999
		$querystring="select distinct * from department where department_id='$current_department_id' limit 0,1";

	}
	//echo $querystring;
	//echo $current_department_id;
	$rs=mysql_query($querystring);
	if($type=='auto_post_back')
	{
		echo  "<select name=\"department_id\"  onchange=document.$form_name.submit()>";
	}
	else
	{
		echo  "<select name=\"department_id\" >";
	}

	while($row=mysql_fetch_array($rs))
	{
		$select_value=$row[department_id];
		$select_display_value=$row[department_name];
		if($select_value==$current_department_id)
		{
			echo  "<option value='$select_value' selected>$select_display_value</option>";
		}
		else
		{
			echo  "<option value=$select_value>$select_display_value</option>";

		}

	}
	echo  "</select>";

	//echo $current_unit_id." ".$current_department_id." ".$current_staff_id."<br>";

}


function staff_list_menu($current_unit_id="",$current_department_id="",$current_staff_id="",$type='none',$form_name='form1')
{
	//echo $current_unit_id." ".$current_department_id." ".$current_staff_id."<br>";
	if($current_unit_id=='')
	{
		$current_unit_id=get_bottom_id('unit','unit_id');
	}
	if($current_department_id=='')//初始化为‘全部’
	{
		$current_department_id=get_bottom_id('department','department_id');
	}
	if($current_staff_id=='')//第一次进入初始化为‘全部’
	{
		$current_staff_id=get_bottom_id('staff','staff_id');
	}
	//echo $current_unit_id." ".$current_department_id." ".$current_staff_id."<br>";

	echo "<input type='hidden'  name='old_staff_id_temp'   value=$current_staff_id>";//记录上个值
	//if(isset($_POST[old_unit_id_temp]) and ($current_unit_id!=$_POST[old_unit_id_temp]  or $current_unit_id==get_bottom_id('unit','unit_id')))//如果用户换了一级部门，就让二级部门为全部

	//用户选择了一个正常的一级部门与二级部门

	if($current_unit_id!=get_bottom_id('unit','unit_id')  and $current_department_id!=get_bottom_id('department','department_id'))//用户选择了一个正常的一级部门
	{
		$querystring="select * from staff where unit_id='$current_unit_id' and  department_id='$current_department_id' order by  staff_id desc";
	}

	//如果用户换了一级部门，就让二级部门与人员当前值为全部


	if(isset($_POST[old_unit_id_temp]) and ($current_unit_id!=$_POST[old_unit_id_temp]))
	{
		//echo "如果用户换了一级部门，就让二级部门与人员当前值为全部"."<br>";
		$current_department_id=get_bottom_id('department','department_id');
		$current_staff_id=get_bottom_id('staff','staff_id');
		//$querystring="select distinct * from staff where unit_id='$current_unit_id' and  department_id='$current_department_id' order by  staff_id desc";
		//只取一个全部值999...999
		$querystring="select distinct * from staff where staff_id='$current_staff_id' limit 0,1";

	}
	//如果用户换了二级部门，就让人员当前值为全部


	if(isset($_POST[old_department_id_temp]) and ($current_department_id!=$_POST[old_department_id_temp]))
	{
		//echo "如果用户换了二级部门，就让人员当前值为全部"."<br>";
		$current_staff_id=get_bottom_id('staff','staff_id');
		//只取一个全部值999...999
		$querystring="select * from staff where unit_id='$current_unit_id' and  department_id='$current_department_id' order by  staff_id desc";
	}

	//如果一级部门被设定为全部，二级部门与人员也设为全部

	if($current_unit_id==get_bottom_id('unit','unit_id'))//如果一级部门是全部，二级也设为全部
	{
		//echo "如果一级部门被设定为全部，二级部门与人员也设为全部"."<br>";
		$current_department_id=get_bottom_id('department','department_id');
		$current_staff_id=get_bottom_id('staff','staff_id');
		$querystring="select distinct * from staff where staff_id='$current_staff_id' limit 0,1";

	}
	//如果二级部门被设定为全部，人员也设为全部

	if($current_department_id==get_bottom_id('department','department_id'))//如果一级部门是全部，二级也设为全部
	{
		//echo "如果二级部门被设定为全部，人员也设为全"."<br>";
		$current_staff_id=get_bottom_id('staff','staff_id');
		$querystring="select distinct * from staff where staff_id='$current_staff_id' limit 0,1";

	}


	//echo $querystring;
	$rs=mysql_query($querystring);
	if($type=='auto_post_back')
	{
		echo  "<select name=\"staff_id\"  onchange=document.$form_name.submit()>";
	}
	else
	{
		echo  "<select name=\"staff_id\" >";
	}

	while($row=mysql_fetch_array($rs))
	{
		$select_value=trim($row[staff_id]);
		$select_display_value=$row[staff_name];
		if($select_value==$current_staff_id)
		{
			echo  "<option value='$select_value' selected>$select_display_value</option>";
		}
		else
		{
			echo  "<option value=$select_value>$select_display_value</option>";

		}

	}
	echo  "</select>";
	//echo $current_unit_id." ".$current_department_id." ".$current_staff_id."<br>";

}

function staff_level_list_menu($current_staff_level_id="",$type='none',$form_name='form1',$condition='')
{
	//$querystring="select * from staff where unit_id='$unit_id' and  department_id='$department_id' order by  staff_id ";
	if(empty($current_staff_level_id))//第一次进入初始化为‘全部’
	{
		$current_staff_level_id=get_bottom_id('staff_level','staff_level_id');
	}
	if($condition=='only_staff')
	{
		$bottom_id=get_bottom_id('staff_level','staff_level_id');
		$querystring="select * from staff_level  where staff_level_id<>$bottom_id   order by staff_level_id ";
	}
	if($condition=='')
	{
		$querystring="select * from staff_level  order by staff_level_id ";
	}
	//echo $querystring;
	$rs=mysql_query($querystring);
	if($type=='auto_post_back')
	{
		echo  "<select name=\"staff_level_id\"  onchange=document.$form_name.submit()>";
	}
	else
	{
		echo  "<select name=\"staff_level_id\" >";
	}

	while($row=mysql_fetch_array($rs))
	{
		$select_vlaue=$row[staff_level_id];
		$select_display_value=$row[staff_level_name];
		if($select_vlaue==$current_staff_level_id)
		{
			echo  "<option value='$select_vlaue' selected>$select_display_value</option>";
		}
		else
		{
			echo  "<option value=$select_vlaue>$select_display_value</option>";

		}

	}
	echo  "</select>";


}

//建立取用户职称的函数

function get_staff_technic_type($unit_id,$department_id,$staff_id)
{
	$querystring="select * from staff  where   unit_id='$unit_id' and department_id='$department_id' and staff_id='$staff_id'";
	//echo $querystring;
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$staff_technic_type=$row[staff_technic_type];
	return $staff_technic_type;
}









//建立取栏目名称的函数
//$length栏目字符串长度
function get_item_name($item_id,$length=40)
{
	$querystring="select * from item  where  item_id='$item_id'";
	echo $querystring;
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$item_name=$row[item_name];
	if(strlen(trim($item_name))<=$length)
	{
		return trim($item_name);
	}
	else
	{
		return my_sub_str($item_name,0,40);
	}
}

function get_staff_level_name($staff_level_id)
{
	//$querystring="select * from unit  where  unit_id='$unit_id'";
	$querystring="select * from staff_level  where  staff_level_id='$staff_level_id' ";
	//echo $querystring;
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$staff_level_name=$row[staff_level_name];
	return $staff_level_name;
}

function get_unit_name($unit_id)
{
	$querystring="select * from unit  where  unit_id='$unit_id'";
	//echo $querystring;
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$unit_name=$row[unit_name];
	return $unit_name;
}

function get_department_name($unit_id,$department_id)
{
	if($department_id==get_bottom_id('department','department_id'))
	{
		return '全部';
	}
	$querystring="select * from department  where  unit_id='$unit_id' and department_id='$department_id'";
	//echo $querystring;
	$rs=mysql_query($querystring);
	$row=mysql_fetch_array($rs);
	$department_name=$row[department_name];
	return $department_name;
}

function get_field_length($table,$field_name)
{
	$querystring="select * from $table  order by $field_name desc limit 1,1 ";
	//echo $querystring;
	$rs_getuniqueid=mysql_query($querystring);

	$i = 0;
	while ($i < mysql_num_fields($rs_getuniqueid))
	{
		//$meta = mysql_fetch_field($rs_getuniqueid, $i);
		if(mysql_field_name($rs_getuniqueid,$i)==$field_name)
		{
			$max_field_len=mysql_field_len($rs_getuniqueid,$i) ;

		}
		$i = $i+1;

	}
	return $max_field_len;

}


function get_file_name($type='file')//用于取得当前页面的命名与去掉扩展名后的主文件名
{
	if($type=='file')
	{
		$file_name=basename($_SERVER['PHP_SELF']);
	}
	if($type=='form')
	{
		$file_name=basename($_SERVER['PHP_SELF']);
		$extend_name=substr(strrchr($file_name,"."),1);
		$file_name=substr($file_name,0,strlen($file_name)-strlen($extend_name)-1);
		//文件名总长度-扩展名长度-点所占的一位strlen($file_name)-strlen($extend_name)-1
	}
	return $file_name;
}//用于取得当前页面的命名与去掉扩展名后的主文件名
function	auto_jump_back($location,$time=1200,$message='返回')
{
	if($location=='close')
	{
		echo "<a href=\"#\" id=\"previouspage\" onclick=\"window.close();\">$message</a>";
		echo "<script language=\"JavaScript\">";
		echo "function timeelapse()";
		echo "{";
		echo "window.clearInterval(my_timer);";
		echo "this.previouspage.click();";
		echo "}";
		echo "my_timer=window.setInterval(\"timeelapse()\",$time);";
		echo "</script>";
		exit();

	}
	else
	{
		echo "<center><a href=$location id=\"previouspage\">$message</a></center>";
		echo "<script language=\"JavaScript\">";
		echo "function timeelapse()";
		echo "{";
		echo "window.clearInterval(my_timer);";
		echo "this.previouspage.click();";
		echo "}";
		echo "my_timer=window.setInterval(\"timeelapse()\",$time);";
		echo "</script>";
		exit();
	}
}


function get_max_id($table,$field_name,$condition='',$begin_row='1',$type="add_one")
{

	//注意：本系统 可能出现当不小心将代表全部的99..99的记录删除时，则会出现加上的数据编号不变的情况，如第一条是02，第二条又是02
	if(empty($condition))
	{
		$querystring="select * from $table  order by $field_name desc limit $begin_row,1 ";
		//begin_row一定注意是 0或1,0代表没有999..99这种代表全部的编号，1代表有一个999...99的全部号因为有一代表全部的9的代码，此为一级表的自增长代码
	}
	else
	{
		$querystring="select * from $table  where $condition order by $field_name desc limit $begin_row,1 ";//取二级表的自增长代码

	}
	//echo $querystring;
	//exit();
	$rs_getuniqueid=mysql_query($querystring);

	$i = 0;
	while ($i < mysql_num_fields($rs_getuniqueid))
	{
		//$meta = mysql_fetch_field($rs_getuniqueid, $i);
		//echo mysql_field_name($rs_getuniqueid,$i)." ".mysql_field_len($rs_getuniqueid,$i);
		//echo "<br>";
		//echo "<br>";
		if(mysql_field_name($rs_getuniqueid,$i)==$field_name)
		{
		//echo mysql_field_name($rs_getuniqueid,$i);
		//echo "<br>";
			
			$max_field_len=mysql_field_len($rs_getuniqueid,$i) ;
		//echo $max_field_len."  ".$i;
		//echo "<br>";

		}
		$i = $i+1;
	}
	//取该字段的长度用于后面补零
	
	$row_nu=mysql_num_rows($rs_getuniqueid);
	$max_field_len=$max_field_len;
	if($row_nu>0)//已经有代码，则加步长后返回
	{
		$row_getuniqueid = mysql_fetch_array($rs_getuniqueid);
		$seedid=intval($row_getuniqueid[$field_name]);
		if($type=="add_one")//如果是返回增加后的数据
		{
			$seedid=$seedid+2;//以2为等差步长增长
		}
		$seedid=trim(strval($seedid));
		$seedidlen=strlen($seedid);
		for($i=0;$i<($max_field_len-$seedidlen);$i++)
		{
			$seedid="0".$seedid;
		}
	}
	else//如果没有，则按以下处理
	{
		$seedid="2";
		for($i=0;$i<$max_field_len-1;$i++)
		{
			$seedid="0".$seedid;
		}
	}
	//echo $seedid;
	return $seedid;

}


function get_bottom_id($table,$field_name)//取代表全部的999...99的代码
{
	$querystring="select * from $table  order by $field_name desc limit 0,1 ";//只取一条
	//echo $querystring;
	$rs_getuniqueid=mysql_query($querystring);

	$i = 0;
	while ($i < mysql_num_fields($rs_getuniqueid))
	{
		//$meta = mysql_fetch_field($rs_getuniqueid, $i);
		if(mysql_field_name($rs_getuniqueid,$i)==$field_name)
		{
			$max_field_len=mysql_field_len($rs_getuniqueid,$i) ;

		}
		$i = $i+1;
	}
	//遍历取此字段的长度，以生成相应的9的位数，就是有多少个9

	$seedid="9";
	for($i=0;$i<$max_field_len-1;$i++)
	{
		$seedid="9".$seedid;
	}

	return $seedid;

}

function get_top_id($table,$field_name,$condition='')//
{
	if(empty($condition))
	{
		$querystring="select * from $table  order by $field_name  limit 0,1 ";//一定注意是0,1因为有一代表全部的9的代码
	}
	else
	{
		$querystring="select * from $table  where $condition order by $field_name  limit 0,1 ";//一定注意是0,1因为有一代表全部的9的代码

	}
	$rs_getuniqueid=mysql_query($querystring);

	$i = 0;
	while ($i < mysql_num_fields($rs_getuniqueid))
	{
		//$meta = mysql_fetch_field($rs_getuniqueid, $i);
		if(mysql_field_name($rs_getuniqueid,$i)==$field_name)
		{
			$max_field_len=mysql_field_len($rs_getuniqueid,$i) ;

		}
		$i = $i+1;

	}

	$seedid="9";
	for($i=0;$i<$max_field_len-1;$i++)
	{
		$seedid="9".$seedid;
	}



	return $seedid;

}

function getuniqueid($tablename,$field)
{

	$rs_getuniqueid=mysql_query("SELECT $field from $tablename order by $field DESC");

	$row_nu=mysql_num_rows($rs_getuniqueid);

	if($row_nu>0)
	{

		$row_getuniqueid = mysql_fetch_array($rs_getuniqueid);


		$max_field_len=mysql_field_len($rs_getuniqueid,$field);

		$seedid=intval($row_getuniqueid[$field]);
		$seedid=$seedid+1;
		$seedid=trim(strval($seedid));
		$seedidlen=strlen($seedid);
		for($i=0;$i<($max_field_len-$seedidlen);$i++)
		{
			$seedid="0".$seedid;
		}
	}
	else
	{
		//echo "no more id";
		$max_field_len=mysql_field_len($rs_getuniqueid,$field);
		$seedid="1";
		for($i=0;$i<$max_field_len-1;$i++)
		{
			$seedid="0".$seedid;
		}
	}

	return $seedid;
}
//****************endofgetuniqueid

//************************************
//start function datetimetostring
//***********************************
function datetostring()
{
	$date=strval(date("Y-m-d H:i:s"));
	$year=substr($date,0,4);
	$month=substr($date,5,2);
	$day=substr($date,8,2);
	$hour=substr($date,11,2);
	$minute=substr($date,14,2);
	$second=substr($date,17,2);
	/*
	echo $year;
	echo $month;
	echo $day;
	echo $hour;
	echo $minute;
	echo $second;
	*/
	$datestring=$year.$month.$day.$hour.$minute.$second;
	return $datestring;
}

//************************************
//end function datetimetostring
//***********************************


function administrator()
{
	if ($_SESSION['staff_name']=='admin' and $_SESSION["department_id"]=="" and $_SESSION["unit_id"]=="")
	{
		return 1;
	}
	else
	{
		return 0;
	}

}




function count_hit_times()
{

	$web_name=$_SERVER['PHP_SELF'];
	$querystring="select * from  hit_counter where web_name='$web_name'";
	$rs_number=mysql_query($querystring);
	$num_rows=mysql_num_rows($rs_number);
	$step=rand(1,2);
	//$step=1;

	if($num_rows>0)
	{
		$querystring="update  hit_counter set hit_time = hit_time+$step where web_name='$web_name'";
		mysql_query($querystring);

	}
	else
	{
		$querystring="insert into hit_counter(web_name,hit_time)  values('$web_name','$step')";
		//echo $querystring;
		$operate=mysql_query($querystring);

	}
}
function show_hit_times()
{
	$web_name=$_SERVER['PHP_SELF'];
	//echo $web_name;
	$web_name="/index.php";
	
	$querystring="select * from  hit_counter where web_name='$web_name'";
	$rs_temp=mysql_query($querystring);
	$row_temp=mysql_fetch_array($rs_temp);
	$hit_time=$row_temp[hit_time];
	return $hit_time;

}

?>
