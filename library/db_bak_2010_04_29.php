<?php
require_once(__SITEROOT."/library/db_abstract.php");
/**
 * 一种基于反射机制的高效dao实现
 *
 */
class dao  implements db_abstract{
	/**
	 * dao的成员变量必须全部是private型，否则会被视为表对象生成sql语句导致出错
	 */
	/**
	 * 记录集
	 *
	 * @var unknown_type
	 */
	private $_dao_linker;
	//fetch时存储记录集
	//private $_dao_rs=array();
	private $_dao_rs;
	private $_dao_where=null;
	private $_dao_orderby;
	private $_dao_limit_start;
	private $_dao_limit_number;
	private $_dao_groupby;
	private $_dao_having;
	private $_dao_count;
	private $_dao_join=array();
	/**
	 * 用于存储用户自定义的字段表达式
	 *
	 * @var unknown_type
	 */
	private $_dao_field_list;
	/**
	 * 用于是否将用户自定义字段与原始字段融合在一起
	 * 默认是仅处理用户自定义字段
	 *
	 * @var unknown_type
	 */
	private $_dao_field_list_add=false;
	/**
	 * 用于存储用户自定义字段名
	 *
	 * @var unknown_type
	 */
	private $_dao_filed_array=array();
	private $_dao_init_value;
	/**
	 * 用于存储分组或是用户自定义字段列表时的 变量名->值 的存储
	 *
	 * @var unknown_type
	 */
	private $_dao_key_value=array();
	/**
	 * 从表对象数组
	 *
	 * @var unknown_type
	 */
	private $_dao_join_table=array();
	/**
	 * 用户自定义字段
	 *
	 * @var unknown_type
	 */
	private $_dao_user_define_columns=array();
	/**
	 * 调试开关
	 *
	 * @var unknown_type
	 */
	private $_dao_debug;
	/**
	 * 连接数据库
	 * 
	 */
	public function __construct(){
		//单例 连接数据库
		db_connect::getInstance();
		$this->_dao_init_value="#^&*^&*#";
		//初始化成员变量的初值
		$var=get_object_vars($this);
		//排除dao自身的成员变量
		foreach ($var as $key=>$value){
			/*			if($key!='__table' and strpos($key,'_dao_')===false){
			$this->$key=$this->_dao_init_value;
			}
			*/
			if(substr($key,0,1)!='_'){
				$this->$key=$this->_dao_init_value;
			}
		}

		//echo $this->linker;
	}
	/**
	 * 给指定的定段赋值。
	 * 使用方法：
	 * 1.$student->setValue($student->_name,'mike')
	 * 2.$student->setValue('name','mike')
	 * 代替$object->name='mike'这种方式
	 *
	 * @param string $fieldName
	 * @param string $fieldValue
	 * @return true or false
	 */
	public function setValue(string $fieldName,string $fieldValue){
		return true;
	}
	/**
	 * 获取指定定段的值。
	 * 使用方法：
	 * 1.$name=$student->getValue($student->_name) 
	 * 2.$name=$student->getValue('name')
	 * 代替$name=$object->name这种方式
	 *
	 * @param string $fieldName
	 * @param string $fieldValue
	 * @return value
	 */	
	public function getValue(string $fieldName){
		return $value;
	}
	public function query($query_string){
		//echo $query_string."<br>";
		return mysql_query($query_string);
	}
	public function insert(){
		//获取成员变量列表
		//$var=get_class_vars(__CLASS__);
		$var=get_object_vars($this);
		//生成insert的sql语句
		$queryString="insert into `".$var['__table']."`(";
		$columns="";
		$columnsValue=" values(";
		foreach ($var as $key=>$value){
			//反射形成的表对象属性包括表名，因此生成sql语句时将表名排除，也将没有初值的数据排除
			//if($key!='__table' and strpos($key,'_dao_')===false and $var[$key]!=$this->_dao_init_value){
			if(substr($key,0,1)!='_' and $var[$key]!=$this->_dao_init_value){
				$columns=$columns."`".$key."`,";
				$columnsValue=$columnsValue."'".$value."',";
			}
		}
		//insert into xxxx(name,id,age) values('ddd','12','1323')
		//去掉尾部多于的','号
		$columns=rtrim($columns,',').")";
		$columnsValue=rtrim($columnsValue,',').")";

		$queryString=$queryString.$columns.$columnsValue;
		if($this->_dao_debug==1){
			echo "<br />".$queryString."<br />";
		}
		if(!mysql_query($queryString)){
			$this->showSqlErrorMessage($queryString,mysql_error(),__FILE__,__LINE__);
			return false;
		}else{
			return true;
		}
	}
	public function update(){
		//有值才更新
		if(empty($this->_dao_where)){
			echo "<br />必须要有更新条件才能执行本功能<br />";
			exit();
		}
		//取对象的所有属性以数组的形式存于$vars中
		$var=get_object_vars($this);
		//var_dump($var);
		$update_string="";
		foreach ($var as $key=>$value){
			//if($key!='__table' and (strpos($key,'_dao_')===false) and $var[$key]!=$this->_dao_init_value){
			if(substr($key,0,1)!='_' and $var[$key]!=$this->_dao_init_value){
				//在db类的构造函数中将成员变量的初值全部成为"#^&*^&*#",这样就可以根据用户是否改变了初值
				//而是否参加形成sql串，这样，用户没有指定值的字段就原始值就不会被误改变
				//因为要update 则程序中必然有$user->name='mike'这样的语句，没有设定的属性，则其值一定为"#^&*^&*#"
				$update_string=$update_string."`".$key."`='".$var[$key]."',";
			}
			//echo $update_string."<br>";
		}
		if(!empty($update_string)){
			//$update_string=substr($update_string,0,strlen($update_string)-1)." ";
			$update_string=rtrim($update_string,',')." ";
			$query_string="update `".$var['__table']."` set ".$update_string." where ".$this->_dao_where;
			//echo $query_string;
			if($this->_dao_debug==1){
				echo "<br />".$query_string."<br />";
			}
			if(!mysql_query($query_string)){
				$this->showSqlErrorMessage($query_string,mysql_error(),__FILE__,__LINE__);
				return false;
			}else{
				return true;
			}
		}
	}
	public function delete(){
		//有条件才删除
		if(empty($this->_dao_where)){
			echo "<br />必须要有删除条件<br />";
			exit();
		}
		$var=get_object_vars($this);
		$query_string="delete from `".$var['__table']."`  where ".$this->_dao_where;
		if($this->_dao_debug==1){
			echo "<br>".$query_string."<br>";
		}
		if(!mysql_query($query_string)){
			$this->showSqlErrorMessage($query_string,mysql_error(),__FILE__,__LINE__);
			return false;
		}else{
			return true;
		}


	}
	public function select(){
		//生成sql语句
		$field_list="";
		//如果有用户自定义字段，且类型是add，则将用户自定义字段拼在前面生成的$field_list后
		//用户自定义字段的有效性已在selectAdd中做一定的检查 保证至少是  name as myName 型的

		//不分组（如果有分组操作一定有自定义字段列表）或是没有用户定义字段列表，则自动生成相应的字段列表　形成　select * 这一部分
		/**
			* 在有多表关联的情况下，分主表与从表分别取出类的成员变量，遍历成员变量数组，形成相应的字段列表
			* 原理：
			* 形成的字段列表应该是如下形式 table1.id as table1_id,table1.name as table1_name,table2.id as table2_id,table2.score as table2_score
		*/
		$var=get_object_vars($this);
		//先处理主表，即使只有一张表，也这样生成。这样，单表与多表的处理方式就一致了
		$tempFiledList='';
		foreach ($var as $key=>$value){
			//if($key!='__table' and strpos($key,'_dao_')===false){
			//过滤内部dao变量，这里有一个不完善的地方，也就是说，字段名不能用_开头
			if(substr($key,0,1)!='_'){
				//生成形如user.name as user_name,user.age as user_age的字段列表
				$tempFiledList=$tempFiledList.$var['__table'].".".$key." as ".$var['__table']."_".$key.",";
			}
		}
		if($this->_dao_field_list!='' and $this->_dao_field_list_add){
			$tempFiledList=$tempFiledList.$this->_dao_field_list.',';
		}elseif($this->_dao_field_list!='' and !$this->_dao_field_list_add){
			$tempFiledList=$this->_dao_field_list.',';
		}
		$field_list=$field_list.$tempFiledList;
		//echo "<pre>";
		//var_dump($this->_dao_join_table);
		//echo "</pre>";
		//$this->_dao_join_table是关联表数组，里面存储了主表所对应的多个关联表，可以一个一个取出表名来处理
		//如果有关联表，自动处理关联表
		for($counter=0;$counter<count($this->_dao_join_table);$counter++){
			//取表对象
			$table=$this->_dao_join_table[$counter];
			//echo $table;
			//获取实例的成员变量及其值
			$var=get_object_vars($table);
			$tempFiledList='';
			//生成主表的字段列表
			foreach ($var as $key=>$value){
				//if($key!='__table'and strpos($key,'_dao_')===false){
				//过滤内部dao变量，这里有一个不完善的地方，也就是说，字段名不能用_开头
				if(substr($key,0,1)!='_'){
					//生成形如user.name as user_name,user.age as user_age的字段列表
					//echo $var['__table'];
					$tempFiledList=$tempFiledList.$var['__table'].".".$key." as ".$var['__table']."_".$key.",";
				}
			}
			//生成从表的自定义字段列表
			if($table->_dao_field_list!='' and $table->_dao_field_list_add){
				$tempFiledList=$tempFiledList.$table->_dao_field_list.',';
			}elseif($table->_dao_field_list!='' and !$table->_dao_field_list_add){
				$tempFiledList=$table->_dao_field_list.',';
			}
			$field_list=$field_list.$tempFiledList;



		}
		//形成主表与从表的字段列表
		//只有主表　select user.name as user_name,user.age as user_age.....
		//有主从表　select user.name as user_name,user.age as user_age,score.english as score_english,score.chinese as score_chinese .....
		//$field_list=substr($field_list,0,strlen($field_list)-1)." ";
		$field_list=rtrim($field_list,',')." ";

		//echo $field_list;

		//如果是count操作，则只形成一个count(*) as conter 或是count(指定字段) as counter的字段列表
		if(!empty($this->_dao_count)){
			//$var=get_object_vars($this);
			$field_list="count($this->_dao_count) as counter";
		}
		$var=get_object_vars($this);
		$query_string="select $field_list from ".$var['__table']." ";
		$join_string=" ";
		//形成多表关联的join代码部份
		for($counter=0;$counter<count($this->_dao_join_table);$counter++){
			$join_string=$join_string.$this->_dao_join[$counter]." ";
		}
		$query_string=$query_string.$join_string;
		if($this->_dao_where){
			$query_string=$query_string." where ".$this->_dao_where." ";
		}


		//注：不能用$this->_dao_limit_start来判断是否需要取部分数据，因为有可能limit_start是从0开始的，则limit不起作用
		if($this->_dao_groupby){
			$query_string=$query_string." group by  ".$this->_dao_groupby." ";
		}
		if($this->_dao_having){
			$query_string=$query_string." having  ".$this->_dao_having." ";
		}
		//order by 
		if($this->_dao_orderby){
			$var=get_object_vars($this);
			$array_orderby=explode(",",$this->_dao_orderby);
			$temp_string=' order by ';
			//加表前缀 order by aaa.id,aaa.name
			foreach ($array_orderby as $value){
				//$temp_string=$temp_string.$var['__table'].".".$value.",";不自动加表名了
				//临时使用以下代码，如果order by里的字段没有表名，自动加上，
				if(strpos($value,'.')===false){
					$temp_string=$temp_string.$var['__table'].".".$value.",";
				}else{
					$temp_string=$temp_string.$value.",";
				}

			}
			
			$temp_string=rtrim($temp_string,',');
			$query_string=$query_string.$temp_string;
		}
		if($this->_dao_limit_number){
			$query_string=$query_string." limit ".$this->_dao_limit_start." , ".$this->_dao_limit_number." ";
		}
				
		//echo "<br>".$query_string."<br>";
		//echo '$this->_dao_debug'.$this->_dao_debug;
		if($this->_dao_debug==1){
			echo "<br>".$query_string."<br>";
		}else{
			//echo "<br />未开调试<br />";
			//echo "dddddddddddddddddddddddddd";
		}
		//echo "<br>".$query_string."<br>";
		if(!$this->_dao_rs=mysql_query($query_string)){
			$this->showSqlErrorMessage($query_string,mysql_error(),__FILE__,__LINE__);
		}

	}
	public function select_bak(){
		//生成sql语句
		$field_list="";
		//判断是否有用户自定义的字段 如   name as myName或是有没有分组数操作
		//不分组（如果有分组操作一定有自定义字段列表）或是没有用户定义字段列表，则自动生成相应的字段列表　形成　select * 这一部分
		if(empty($this->_dao_field_list)){
			/**
			 * 在有多表关联的情况下，分主表与从表分别取出类的成员变量，遍历成员变量数组，形成相应的字段列表
			 * 原理：
			 * 形成的字段列表应该是如下形式 table1.id as table1_id,table1.name as table1_name,table2.id as table2_id,table2.score as table2_score
			 */
			$var=get_object_vars($this);
			//先处理主表，即使只有一张表，也这样生成。这样，单表与多表的处理方式就一致了
			foreach ($var as $key=>$value){
				//if($key!='__table' and strpos($key,'_dao_')===false){
				//过滤内部dao变量，这里有一个不完善的地方，也就是说，字段名不能用_开头
				if(substr($key,0,1)!='_'){
					//生成形如user.name as user_name,user.age as user_age的字段列表
					$field_list=$field_list.$var['__table'].".".$key." as ".$var['__table']."_".$key.",";
				}
			}
			//$this->_dao_join_table是关联表数组，里面存储了主表所对应的多个关联表，可以一个一个取出表名来处理
			//如果有关联表，自动处理关联表
			//echo "<pre>";
			//var_dump($this->_dao_join_table);
			//echo "</pre>";
			for($counter=0;$counter<count($this->_dao_join_table);$counter++){
				//取表名
				$table=$this->_dao_join_table[$counter];
				//echo $table;
				//获取实例的成员变量及其值
				$var=get_object_vars($table);
				foreach ($var as $key=>$value){
					//if($key!='__table'and strpos($key,'_dao_')===false){
					//过滤内部dao变量，这里有一个不完善的地方，也就是说，字段名不能用_开头
					if(substr($key,0,1)!='_'){
						//生成形如user.name as user_name,user.age as user_age的字段列表
						//echo $var['__table'];
						$field_list=$field_list.$var['__table'].".".$key." as ".$var['__table']."_".$key.",";
					}
				}

			}
			//形成主表与从表的字段列表
			//只有主表　select user.name as user_name,user.age as user_age.....
			//有主从表　select user.name as user_name,user.age as user_age,score.english as score_english,score.chinese as score_chinese .....
			//$field_list=substr($field_list,0,strlen($field_list)-1)." ";
			$field_list=rtrim($field_list,',')." ";
			//echo $field_list;
		}else{
			//有用户自定义字段或是要分组，则按用户自定义字段处理
			//这里有一个问题，如果用户既要自定字段，又要用原始的所有字段，则无法处理。因此这里必须要改进 2010-04-04
			$field_list=$this->_dao_field_list;
		}
		//如果是count操作，则只形成一个count(*) as conter 或是count(指定字段) as counter的字段列表
		if(!empty($this->_dao_count)){
			//$var=get_object_vars($this);
			$field_list="count($this->_dao_count) as counter";
		}
		$var=get_object_vars($this);
		$query_string="select $field_list from ".$var['__table']." ";
		$join_string=" ";
		//形成多表关联的join代码部份
		for($counter=0;$counter<count($this->_dao_join_table);$counter++){
			$join_string=$join_string.$this->_dao_join[$counter]." ";
		}
		$query_string=$query_string.$join_string;
		if($this->_dao_where){
			$query_string=$query_string." where ".$this->_dao_where." ";
		}
		if($this->_dao_groupby){
			$query_string=$query_string." group by  ".$this->_dao_groupby." ";
		}
		if($this->_dao_having){
			$query_string=$query_string." having  ".$this->_dao_having." ";
		}

		if($this->_dao_orderby){
			$var=get_object_vars($this);
			$array_orderby=explode(",",$this->_dao_orderby);
			$temp_string=' order by ';
			//加表前缀 order by aaa.id,aaa.name
			foreach ($array_orderby as $value){
				//$temp_string=$temp_string.$var['__table'].".".$value.",";不自动加表名了
				//临时使用以下代码，如果order by里的字段没有表名，自动加上，
				if(strpos($value,'.')===false){
					$temp_string=$temp_string.$var['__table'].".".$value.",";
				}else{
					$temp_string=$temp_string.$value.",";
				}

			}
			$temp_string=rtrim($temp_string,',');
			$query_string=$query_string.$temp_string;
		}
		//注：不能用$this->_dao_limit_start来判断是否需要取部分数据，因为有可能limit_start是从0开始的，则limit不起作用
		if($this->_dao_limit_number){
			$query_string=$query_string." limit ".$this->_dao_limit_start." , ".$this->_dao_limit_number." ";
		}
		//echo "<br>".$query_string."<br>";
		//echo '$this->_dao_debug'.$this->_dao_debug;
		if($this->_dao_debug==1){
			echo "<br>".$query_string."<br>";
		}else{
			//echo "<br />未开调试<br />";
			//echo "dddddddddddddddddddddddddd";
		}
		//echo "<br>".$query_string."<br>";
		if(!$this->_dao_rs=mysql_query($query_string)){
			$this->showSqlErrorMessage($query_string,mysql_error(),__FILE__,__LINE__);
		}

	}
	//用于兼容pear
	public function find($autoFetch=false){
		$this->select();
		if($autoFetch){
			$this->fetch();
		}
	}
	/**
	 * 如果是counte操作，则返回的是$table->counter
	 * 经过select方法取得了数据集，数据集分为了三种情况
	 * 1原始表字段
	 * 2纯用户自定义字段
	 * 3原始表字段与用户自定义字段混合
	 * 处理的时候可先取原始表字段数据
	 * 然后根据是否有自定义字段在读取自定义字段的数据
	 *
	 * @return unknown
	 */
	public function fetch(){
		//首先单独处理count操作
		//如果是count操作,取出结果后直接返回
		if(!empty($this->_dao_count)){
			$row=mysql_fetch_array($this->_dao_rs);
			return $row['counter'];
		}
		//有数据
		//if($row=mysql_fetch_array($this->_dao_rs)){
		if($row=mysql_fetch_assoc($this->_dao_rs)){
		}else{
			//如无数据，则返回
			return false;
		}
		//var_dump($row);
		//先处理主表
		//如果仅为用户自定义字段
		if(!empty($this->_dao_field_list) and $this->_dao_field_list_add==false){
			//必须在这里清空一次，否则出错
			$this->_dao_key_value=array();
			//通过遍历获取的mysql数据来重建表成员对象
			foreach ($row as $key=>$value){
				//数字不能做字段名，过滤掉
				if(!is_numeric($key)){
					//echo $key."=>".$value."<br>";
					$this->__set($key,$value);
					//通过__set方法来模拟生成成员变量名与值。 也就是说如果用户自定义了一个新的字段别名，这个字段别名在
					//类的定义文件中是没有的，就可以用set方法来生成如：select name as my_name
					//通过__set方法形成一个虚似的$table->my_name="mike"的形式，这个形式的数据保存在
					//$this->_dao_key_value中，通过__get方法中的foreach可以取出
				}
			}

		}
		//如果为有用户自定义字段并且为添加模式 或是没有用户自定义字段
		if(empty($this->_dao_field_list) or (!empty($this->_dao_field_list) and $this->_dao_field_list_add==true)){
			$var=get_object_vars($this);//取主表
			//先处理原生字段
			foreach ($var as $key=>$value){
				//if($key!='__table' and strpos($key,'_dao_')===false){
				if(substr($key,0,1)!='_'){
					//形成字段名，对于非用户自定义字段的情况下，现在字段名在select方法中被统一处理成为了 表名_字段名[user_name]这种形式了
					$field=$var['__table']."_".$key;
					//echo '------key----'.$key.'-----field-----'.$field.'------value----'.$row[$field].'----------';
					//echo "<br />";
					//将取得的值填充到表对象属性中
					$this->$key=$row[$field];//相当于$this->name=$row[user_name];
				}
			}
			//再处理自定义字段
			foreach ($row as $key=>$value){
				//数字不能做字段名，过滤掉
				//不是用户自定义的字段名，也过滤掉
				if(!is_numeric($key) and in_array($key,$this->_dao_filed_array)){
					//echo $key."=>".$value."<br>";
					$this->__set($key,$value);
					//通过__set方法来模拟生成成员变量名与值。 也就是说如果用户自定义了一个新的字段别名，这个字段别名在
					//类的定义文件中是没有的，就可以用set方法来生成如：select name as my_name
					//通过__set方法形成一个虚似的$table->my_name="mike"的形式，这个形式的数据保存在
					//$this->_dao_key_value中，通过__get方法中的foreach可以取出
				}
			}


		}
		//再处理关联表。
		//取关联表 有多表关联，按多表关联的方法取数据。字段名为 表名_字段名
		//var_dump($this->_dao_join_table);
		//_dao_join_table里存储着关联表对象
		for($counter=0;$counter<count($this->_dao_join_table);$counter++){
			//echo "<br>=======================================================================================<br>";
			$table=$this->_dao_join_table[$counter];
			//echo "<br>table:".$table->__table."<br";
			//如果仅为用户自定义字段
			if(!empty($table->_dao_field_list) and $table->_dao_field_list_add==false){
				//必须在这里清空一次，否则出错
				$table->_dao_key_value=array();
				//通过遍历获取的mysql数据来重建表成员对象
				foreach ($row as $key=>$value){
					//数字不能做字段名，过滤掉
					if(!is_numeric($key)){
						//echo $key."=>".$value."<br>";
						$table->__set($key,$value);
						//通过__set方法来模拟生成成员变量名与值。 也就是说如果用户自定义了一个新的字段别名，这个字段别名在
						//类的定义文件中是没有的，就可以用set方法来生成如：select name as my_name
						//通过__set方法形成一个虚似的$table->my_name="mike"的形式，这个形式的数据保存在
						//$this->_dao_key_value中，通过__get方法中的foreach可以取出
					}
				}

			}
			//如果为有用户自定义字段并且为添加模式 或是没有用户自定义字段
			if(empty($table->_dao_field_list) or (!empty($table->_dao_field_list) and $table->_dao_field_list_add==true)){
				$var=get_object_vars($table);//取主表
				//先处理原生字段
				foreach ($var as $key=>$value){
					//if($key!='__table' and strpos($key,'_dao_')===false){
					if(substr($key,0,1)!='_'){
						//形成字段名，对于非用户自定义字段的情况下，现在字段名在select方法中被统一处理成为了 表名_字段名[user_name]这种形式了
						$field=$var['__table']."_".$key;
						//echo '------key----'.$key.'-----field-----'.$field.'------value----'.$row[$field].'----------';
						//echo "<br />";
						//将取得的值填充到表对象属性中
						$table->$key=$row[$field];//相当于$this->name=$row[user_name];
					}
				}
				//再处理自定义字段
				foreach ($row as $key=>$value){
					//数字不能做字段名，过滤掉
					//不是用户自定义的字段名，也过滤掉
					if(!is_numeric($key) and in_array($key,$table->_dao_filed_array)){
						//echo $key."=>".$value."<br>";
						$table->__set($key,$value);
						//通过__set方法来模拟生成成员变量名与值。 也就是说如果用户自定义了一个新的字段别名，这个字段别名在
						//类的定义文件中是没有的，就可以用set方法来生成如：select name as my_name
						//通过__set方法形成一个虚似的$table->my_name="mike"的形式，这个形式的数据保存在
						//$this->_dao_key_value中，通过__get方法中的foreach可以取出
					}
				}

			}
			
		}
		return true;

	}
	public function fetch_bak(){
		//首先单独处理count操作
		//如果是count操作,取出结果后直接返回
		if(!empty($this->_dao_count)){
			$row=mysql_fetch_array($this->_dao_rs);
			return $row['counter'];
		}
		//有数据
		if($row=mysql_fetch_array($this->_dao_rs)){
			//无分组或是无自定义字段
			if(empty($this->_dao_field_list)){
				//先处理主表
				$var=get_object_vars($this);//取主表
				foreach ($var as $key=>$value){
					//if($key!='__table' and strpos($key,'_dao_')===false){
					if(substr($key,0,1)!='_'){
						//形成字段名，在无自定义字段的情况下，现在字段名在select方法中被统一处理成为了 表名_字段名[user_name]这种形式了
						$field=$var['__table']."_".$key;
						//echo '------key----'.$key.'-----field-----'.$field.'------value----'.$row[$field].'----------';
						//echo "<br />";
						//将取得的值填充到表对象属性中
						$this->$key=$row[$field];//相当于$this->name=$row[user_name];
					}
				}
				//再处理关联表。
				//取关联表 有多表关联，按多表关联的方法取数据。字段名为 表名_字段名
				//var_dump($this->_dao_join_table);
				//_dao_join_table里存储着关联表对象
				for($counter=0;$counter<count($this->_dao_join_table);$counter++){
					//echo "<br>=======================================================================================<br>";
					$table=$this->_dao_join_table[$counter];
					//echo "<br>table:".$table->__table."<br";
					//取每张关联表各自表对象的字段名
					$var=get_object_vars($table);
					foreach ($var as $key=>$value){
						//if($key!='__table' and strpos($key,'_dao_')===false){
						if(substr($key,0,1)!='_'){
							//生成如下的代码user_name，score_english 这样如果有多张表也不会出现因为同名字段相矛盾的事了
							$field=$table->__table."_".$key;
							//echo $field
							//echo '------key----'.$key.'-----field-----'.$field.'------value----'.$row[$field].'----------';
							//echo "<br />";
							//将取得的值填充到表对象属性中
							$table->$key=$row[$field];
						}
					}
				}
				//如果要保持与pear的兼容性，则要做如下处理
				//pear对于关联表的处理是按无论所有的表，对用主对象输入方式进行的。而myMVC实现的方式更胜一筹，是按不同的表对象进行输出
				if(__COMPATIBLE_PEAR){
					$masterTable=$this;
					for($counter=0;$counter<count($this->_dao_join_table);$counter++){
						$table=$this->_dao_join_table[$counter];
						//$table=$this->__table;
						//取每张关联表各自表对象的字段名
						$var=get_object_vars($table);
						foreach ($var as $key=>$value){
							//if($key!='__table' and strpos($key,'_dao_')===false){
							if(substr($key,0,1)!='_'){
								//生成如下的代码user_name，score_english 这样如果有多张表也不会出现因为同名字段相矛盾的事了
								$field=$table->__table."_".$key;
								$masterTable->$key=$row[$field];
							}
						}
					}

				}
			}
			else //有分组或是有自定义字段
			{
				//必须在这里清空一次，否则出错
				$this->_dao_key_value=array();
				//通过遍历获取的mysql数据来重建表成员对象
				foreach ($row as $key=>$value){
					//数字不能做字段名，过滤掉
					if(!is_numeric($key)){
						//echo $key."=>".$value."<br>";
						$this->__set($key,$value);
						//通过__set方法来模拟生成成员变量名与值。 也就是说如果用户自定义了一个新的字段别名，这个字段别名在
						//类的定义文件中是没有的，就可以用set方法来生成如：select name as my_name
						//通过__set方法形成一个虚似的$table->my_name="mike"的形式，这个形式的数据保存在
						//$this->_dao_key_value中，通过__get方法中的foreach可以取出
					}
				}
			}
			return true;
		}else{
			//无数据，将对象初值设为空
			/*			$var=get_object_vars($this);
			foreach ($var as $key=>$value)
			{
			if($key!='__table')
			{
			$this->$key='无';
			}
			}*/
			return false;
		}

	}
	public function where($where){
		$this->_dao_where=$where;
	}
	/**
	 * 重要说明
	 * where 方法没有实现自动加表前缀的功能 如  $news->where("id='1'"); 生成的代码是 where id='1' ,并不自动生成where news.id='1',因此在多表操作时，要自行加表前缀区分同名字段
	 * 以后有机会再实现这种功能
	 *
	 * @param unknown_type $where
	 */
	public function whereAdd($where){
		if($this->_dao_where==null){
			$this->_dao_where=$where;
		}else{
			$this->_dao_where=$this->_dao_where." and ".$where;
		}

	}
	public function orderby($orderby){
		$this->_dao_orderby=$orderby;
	}
	public function limit($start,$number){
		$this->_dao_limit_start=$start;
		$this->_dao_limit_number=$number;
	}
	public function groupby($groupby){
		$this->_dao_groupby=$groupby;
	}
	public function groupby_columns_define($columns_define){
		//自定义的字段列表正确性的检查

		$this->_dao_field_list=$columns_define;
	}
	public function having($having){
		$this->_dao_having=$having;
	}
	/**
	 * 本函数完成用户自定义字段的处理
	 * 由
	 *
	 * @param unknown_type $key
	 * @param unknown_type $value
	 */
	public function __set($key,$value){
		//当自定义字段名与实际字段名有同名是，会出现取不到自定义字段的值。如
		//$student->groupby_columns_define("max(birthday) as oldperson,class");
		//则$student->class 输入不出值，分析后发现__GET的优先级低于 内置属性。因此可修改成为
		//$student->groupby_columns_define("max(birthday) as oldperson,class as class1");
		//按$student->class1输出或是重新给内置属性赋值
		//2010-02-16修改此bug

		$this->$key=$value;
		$temp=array($key=>$value);

		$this->_dao_key_value=array_merge($temp,$this->_dao_key_value);
		//var_dump($this->_dao_key_value);
		return true;
		//注意如果是表记录的遍历，在每条记录循环时必须清空一次
	}
	public function __get($column){
		//$this->_dao_key_value里存储的是由用户自定义字段的名称与对应的值，仅为一条记录的数据
		//var_dump($this->_dao_key_value);

		foreach ($this->_dao_key_value as $key=>$value){

			if($column==$key){
				//控制不了public的属性，只有private的成员属性或是不存在的成员属性才受__get控制
				if($value!=$this->_dao_init_value){
					return $value;
				}else{
					return '';
				}

			}
		}
	}
	/**
	 * 多表关联操作，每关联一个表都要调用一次本成员函数
	 *
	 * @param unknown_type $method
	 * @param 这是一个类 $slaver_table
	 * @param unknown_type $key_column
	 */
	public function join($method='inner',$slaver_table,$key_column){

		//$table_name=$slaver_table->__table;
		$var=get_object_vars($this);
		//生成insert的sql语句
		$master_table=$var['__table'];
		$join_string="";
		switch ($method){
			case "inner":
				$join_string=$join_string." inner join ".$slaver_table->__table." on ".$master_table.".".$key_column."=".$slaver_table->__table.".".$key_column." ";
				break;
			case "left":
				$join_string=$join_string." left join ".$slaver_table->__table." on ".$master_table.".".$key_column."=".$slaver_table->__table.".".$key_column." ";
				break;
		}
		array_push($this->_dao_join,$join_string);
		array_push($this->_dao_join_table,$slaver_table);
		//将关联表名与形成的关联查询字串写进成员数组变量中存储
	}
	/**
	 * 用于根据表的uuid 或是id 取指定字段的值
	 *
	 * @param unknown_type $key
	 * @param unknown_type $column
	 */
	public function getKeyValue($key,$keyValue,$column){
		$this->_dao_where="`$key`='$keyValue'";
		//$this->debug(1);
		$this->select();
		if($this->fetch()){
			return $this->$column;
		}else{
			return '';
		}
	}
	/**
	 * 获取whereString
	 * _dao_where是private的，不能直接取
	 * 主要用于join时，实现对从表记录的过滤
	 *
	 * @return unknown
	 */
	public function getWhereString(){
		return $this->_dao_where;
	}
	/**
	 * 新的join方法，在joinAdd的时候就生成   inner(left) join slaveTable on masterTable.key=slaveTable.key
	 *
	 * @param string $method 关联方式
	 * @param object $masterTable 主表对象
	 * @param object $slaveTable 从表对象
	 * @param string $masterKeyColumn 主表关键字段
	 * @param string $slaveKeyColumn 从表关键字段
	 */
	public function joinAdd($method='inner',$masterTable='',$slaveTable='',$masterKeyColumn='',$slaveKeyColumn=''){
		//pear db 兼容模式 2010-3-8增加了$masterKeyColumn，$slaveKeyColumn，不在兼容pear 有时间在改
		if(is_array($method)){
			//在这种模式下$method存储的是关联信息
			//$masterTable存储的是关联方式
			$array=$method;
			$method=$masterTable==''?'inner':$masterTable;
			//这是pear db 的兼容用法
			//@$student->joinAdd(array('id','score1:id'));

			$keyColumn=$array['0'];
			//$slaveTable
			$masterTable=$this;
			$a=explode(':',$array['1']);

			$slaveTableName='T'.$a['0'];
			$slaveTable=new $slaveTableName;
			//var_dump($slaveTable);
			//echo $slaveTableName;
			//echo "pear db 用法";
			//exit();
		}
		$join_string="";
		switch ($method){
			case "inner":
				$join_string=$join_string." inner join ".$slaveTable->__table." on ".$masterTable->__table.".".$masterKeyColumn."=".$slaveTable->__table.".".$slaveKeyColumn." ";
				//如果关联的从表本身也要对数据进行过滤，则在此处理
				if($slaveTable->getWhereString()!=''){
					$join_string=$join_string.' and ('.$slaveTable->getWhereString().')';
				}
				break;
			case "left":
				$join_string=$join_string." left join ".$slaveTable->__table." on ".$masterTable->__table.".".$masterKeyColumn."=".$slaveTable->__table.".".$slaveKeyColumn." ";
				if($slaveTable->getWhereString()!=''){
					$join_string=$join_string.' and ('.$slaveTable->getWhereString().')';
				}
				break;
		}
		//echo $join_string."<br />";
		//exit();
		array_push($this->_dao_join,$join_string);
		array_push($this->_dao_join_table,$slaveTable);
		//将关联表名与形成的关联查询字串写进成员数组变量中存储
	}
	/**
	 * 统计满足条件的记录数。其中当参数为空时，清楚统计，常用于翻页代码
	 *
	 * @param unknown_type $column
	 * @return unknown
	 */
	public function count($column='*'){
		//if($column=='*')
		$this->_dao_count=$column;
		$this->select();//主动调用select方法
		$counter=$this->fetch();//主动fetch
		return $counter;
	}
	public function columns_define($columns)
	{
		$this->_dao_field_list=$columns;
	}
	/**
	 * 添加自定义自段 如
	 * sum('salary') as sum_salary,average('salary') as average_salary
	 * 处理后将生成
	 * sum('salary') as tableName_sum_salary,average('salary') as tableName_average_salary
	 * $type 为空时，将仅使用用户自定义的字段。为add的时候，则会将用户自定义字段与所有表字段融合在一起
	 *
	 * @param string $columns
	 * @param string $method
	 */
	public function selectAdd($columns='*',$type=''){
		/*		if($columns==''){
		return ;
		}
		if($method!='add'){
		$this->_dao_field_list=$columns;
		return ;
		}
		*/

		//对用户添加的自定义字段进行分析
		$level1=explode('1',$columns);
		foreach ($level1 as $key=>$value){
			$level2=explode(' as ',$value);
			if(count($level2)<2){
				echo "语法错误，必须使用 name as myName 的方式进行定义 ";
				exit();
			}else{
				$this->_dao_filed_array[]=$level2[1];
			}
		}
		$this->_dao_field_list=$this->_dao_field_list.','.$columns;
		$this->_dao_field_list=ltrim($this->_dao_field_list,',');
		if($type=='add'){
			$this->_dao_field_list_add=true;
		}

		return ;


	}
	public function debug($debug=0){
		//echo '--------------------------'.$debug;
		$this->_dao_debug=$debug;
	}
	public function debugLevel($debug=0){
		//echo '--------------------------'.$debug;
		if($debug){
			$this->debug(1);
		}
	}

	/**
	 * 释放对象
	 *
	 */
	public function free()
	{
		unset($this);
	}
	/**
	 * 处理复选框值的小程序，主要用于列表中显示复选框中的多值
	 * 界面上的复选框的显示由view层的check_box函数来完成
	 *
	 * @param unknown_type $check_box
	 * @param unknown_type $current_value
	 */
	public function get_check_box_value($check_box_value_list,$current_value,$separator)
	{
		//将  0|1|2|3这将的表中的存储的值拆分为数组
		$return_value='';
		$current_value_array=explode("|",$current_value);
		foreach ($current_value_array as $value){
			$return_value=$return_value.$check_box_value_list[$value].$separator;
		}
		return $return_value;
	}
	public function showSqlErrorMessage($queryString,$errorString,$file,$line){
		echo "<br />数据库操作出错了，请检查。[".$file."],[".$line."]<br />";
		echo "<br />SQL代码为：".$queryString."<br />";
		echo "<br />错误信息为：".$errorString."<br />";
		exit();
	}
}
class db_connect{
	public $host;
	public $user;
	public $password;
	public $database;
	public $charset;

	private static $instance=null;
	private function __construct(){
		/*基于XML的配置实现
		$doc = new DOMDocument();
		$doc->load( __SITEROOT."config/db_config.xml" );
		$elements = $doc->getElementsByTagName( "db_connect" );
		foreach( $elements as $element )
		{
		$_node = $element->getElementsByTagName( "host" );
		$host = $_node->item(0)->nodeValue;
		$_node = $element->getElementsByTagName( "user" );
		$user = $_node->item(0)->nodeValue;
		$_node = $element->getElementsByTagName( "password" );
		$password = $_node->item(0)->nodeValue;
		$_node = $element->getElementsByTagName( "database" );
		$database = $_node->item(0)->nodeValue;
		}
		$this->host=trim($host);
		$this->user=trim($user);
		$this->password=trim($password);
		$this->database=trim($database);*/


		require_once(__SITEROOT."config/databaseConfig.php");
		//对读入的参数的结构进行判断
		if(isset($databaseConfig['host']) and
		isset($databaseConfig['user']) and
		isset($databaseConfig['password']) and
		isset($databaseConfig['charset'])){
			//一切正常
		}else{
			echo "配置文件中还有规定的参数没有设置";
			exit();
		}

		$this->host=$databaseConfig['host'];
		$this->user=$databaseConfig['user'];
		$this->password=$databaseConfig['password'];
		$this->database=$databaseConfig['database'];
		$this->charset=$databaseConfig['charset'];
		//普通连接
		if($databaseConfig['connectType']==1){
			$linker=mysql_connect(
			$this->host,
			$this->user,
			$this->password);
		}elseif($databaseConfig['connectType']==2){
			//长连接
			$linker=mysql_pconnect(
			$this->host,
			$this->user,
			$this->password);
		}
		//设定字符集
		mysql_query("set names ".$this->charset);
		if(!mysql_select_db($this->database)){
			echo "数据库出错";
			//exit();
		};
		//return $linker;
	}
	public static function getInstance(){
		if(self::$instance === null){
			self::$instance = new db_connect();
		}

		return self::$instance;
	}
	public function get($para){
		switch ($para){
			case 'database':
				return $this->database;
				break;
		}
	}
}

/*

第一种情况：单表 	无count与group操作

第二种情况：单表 	有count与group操作

第三种情况：关联表 无count与group操作

第四种情况：关联表 有count与group操作
*/
