<?php
//require_once(__SITEROOT."/library/db_abstract.php");
/**
 * 一种基于反射机制的高效dao实现
 * 请勿自行更改本模块，不利于升级
 * 采用面向对象方式，封装了常用的SQL操作，相比于其它的PHP oracle组件，拥有如下特点
 * 增强的多表关联操作
 * 支持子查询
 * 支持XML输出
 * 支持缓存
 * 支持多数据库服务器
 * 支持日志
 * 支持事务处理
 * 支持转义
 * 
 *
 */
//暂时不用抽象类，它就是一传说
//class dao_oracle implements db_abstract{
class dao_oracle{
	/**
	 * dao的成员变量必须全部是private型，否则会被视为表对象生成sql语句导致出错
	 * 表字段不能用_dao开头，在oracle的DAO版本里,字段名长度不应该超过28个字符
	 */
	/**
	 * 记录集
	 *
	 * @var unknown_type
	 */
	private $_dao_linker;
	//fetch时存储记录集
	private $_dao_rs;
	private $_dao_where=null;
	private $_dao_orderby;
	private $_dao_limit_start;
	private $_dao_limit_number;
	private $_dao_groupby='';
	private $_dao_having;
	private $_dao_count;
	private $_dao_subquery;
	private $_dao_distinct='';

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
	/**
	 * 存储不转义值，用于$student->name=$student->escape('name','substr(name,1,2)')
	 *
	 * @var unknown_type
	 */
	private $_dao_escape_value=array();
	/**
	 * Enter description here...
	 *
	 * @var unknown_type
	 */
	private $_dao_join_table=array();
	/**
	 * Enter description here...
	 *
	 * @var unknown_type
	 */
	private $_dao_query_string='';
	/**
	 * 别名数组 解决加上表名字段名后超过三十个字符的情况
	 *
	 * @var unknown_type
	 */
	private $_dao_join_table_alias=array();
	/**
	 * 用户自定义字段
	 *
	 * @var array
	 */
	private $_dao_user_define_columns=array();
	/**
	 * 调试开关
	 *
	 * @var unknown_type
	 */
	private $_dao_debug=0;
	//oracle的连接资源定义
	/**
	 * Enter description here...
	 *
	 * @var oracle_connect
	 */
	private $_dao_conn;
	/**
	 * 用于区分不同的host
	 *
	 * @var unknown_type
	 */
	private $_dao_host;

	/**
	 * 错误信息
	 *
	 * @var char
	 */
	private $_dao_error_message;
	/**
	 * 提交模式
	 * OCI_COMMIT_ON_SUCCESS 1　自动
	 * OCI_NO_AUTO_COMMIT 2　手动
	 *
	 * @var int
	 */
	private $_dao_commit_modle='1';
	/**
	 * 当用fetch第一次取数后，如果能正确取得所有的值，则把对象名与表名填进这个数组，第二次的时候，直接通过这个组数来取，能大大提高速度多次取记录的速度
	 */
	private $_dao_fetch_rest_rows=null;
	/**
	 * 严格意义上讲to_array操作会导致速度变慢，看能不能改成调用时才处理20110817
	 */
	private $_dao_to_array=array();
	/**
	 * 缓存一次select请求所获取的所有数据
	 *
	 * @var unknown_type
	 */
	private $_dao_cache_rows=array();
	/**
	 * cache仅支持select，可进行分布式存储
	 *
	 * @param unknown_type $token 启用或禁用缓存
	 * @param unknown_type $url　存储路径
	 * @param unknown_type $age　缓存时间
	 */
	private $_dao_cache_token=false;
	private $_dao_cache_url='';
	private $_dao_cache_timeout='';
	private $_dao_cache_filename='';
	private $_dao_cache_available=false;
	private $_dao_direct_query=false;
	private $_dao_engine='';

	public function setCache($token,$url='',$timeout=60){
		$this->_dao_cache_token=$token;
		//增加对路径有效性的检查
		$this->_dao_cache_url=($url!=''?$url:__SITEROOT.'cache/database_cache/');
		//echo $this->_dao_cache_url;
		$this->_dao_cache_timeout=$timeout;
	}

	/**
	 * 连接数据库
	 * 
	 */
	public function __construct($host=1){
		//echo 'host is'.$host.'<br />';
		//单例 连接数据库

		$this->_dao_conn=oracle_connect::getInstance($host);
		$this->_dao_engine=$this->_dao_conn->engine;

		//echo $this->conn->conn;
		$this->_dao_init_value="#^&*^&*#";
		$this->initKeyValue($this->_dao_init_value);
		return true;

		//echo $this->linker;
	}
	private function initKeyValue($initKeyValue){
		//初始化成员变量的初值
		$var=get_object_vars($this);
		//排除dao自身的成员变量
		foreach ($var as $key=>$value){
			/*if($key!='__table' and strpos($key,'_dao_')===false){
			$this->$key=$this->_dao_init_value;
			}
			*/
			//数据表字段不能用_开头
			if(substr($key,0,1)!='_'){
				$this->$key=$initKeyValue;
			}
		}
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
	/**
	 * 
	 * 20111107把内部调用与外部调用分开
	 * update后，变量值被重置，一直没有找到原因，后来发现query又用作直接执行手工写的query，因此导致出错
	 *
	 * @param unknown_type $query_string
	 * @return unknown
	 */
	private function innerQuery($query_string){
		if($this->_dao_engine=='oracle'){
			if($this->_dao_rs=$this->oracle_query($query_string)){
				return true;
			}else{
				return false;
			}
		}
		if($this->_dao_engine=='mysql'){
			if($this->_dao_rs=$this->mysql_query($query_string)){
				return true;
			}else{
				return false;
			}
		}
	}
	public function query($query_string){
		//echo $query_string."<br>";
        if($this->_dao_debug!=0){
			echo "<br />".$query_string."<br />";
		}
		if($this->_dao_engine=='oracle'){
			if($this->_dao_rs=$this->oracle_query($query_string)){
				//var_dump($this->_dao_rs);
				$this->_dao_direct_query=true;
				//在直接操作的情况下，把所有的初值设置为''
				$this->initKeyValue('');
				return true;
			}else{
				return false;
			}
		}
		if($this->_dao_engine=='mysql'){
			if($this->_dao_rs=$this->mysql_query($query_string)){
				//var_dump($this->_dao_rs);
				$this->_dao_direct_query=true;
				//在直接操作的情况下，把所有的初值设置为''
				$this->initKeyValue('');
				return true;
			}else{
				return false;
			}
		}
	}
	/**
	 * 插入数据
	 *
	 * @return true or false
	 */
	public function insert($log=''){
		//获取成员变量列表
		//$var=get_class_vars(__CLASS__);
		$var=get_object_vars($this);
		//生成insert的sql语句
		$query_string="insert into ".$var['__table']."(";
		$columns="";
		$columnsValue=" values(";
		foreach ($var as $key=>$value){
			//反射形成的表对象属性包括表名，因此生成sql语句时将表名排除，也将没有初值的数据排除
			//if($key!='__table' and strpos($key,'_dao_')===false and $var[$key]!=$this->_dao_init_value){
			if(substr($key,0,1)!='_' and $var[$key]!=$this->_dao_init_value){
				$columns=$columns.$key.",";
				$keyType='_'.$key.'_type';
				/*保留
				if($this->$keyType=='date'){
				$columnsValue=$columnsValue."to_date('".$value."','yyyy-mm-dd hh24:mi:ss'),";
				//echo $temp_filed_list;
				}else{
				$columnsValue=$columnsValue."'".$value."',";
				}
				}*/
				if(isset($this->_dao_escape_value[$key])){
					//$update_string=$update_string.$key."=".$this->_dao_escape_value[$key].",";
					//echo '_dao_escape_value'.'<br />';
					$columnsValue=$columnsValue.$this->_dao_escape_value[$key].",";
				}else{
					//$update_string=$update_string.$key."='".$var[$key]."',";
					$columnsValue=$columnsValue."'".$value."',";
					//var_dump($this->_dao_escape_value);
					//echo 'no _dao_escape_value'.'<br />';
				}

			}
		}
		//echo $columnsValue;
		//insert into xxxx(name,id,age) values('ddd','12','1323')
		//去掉尾部多于的','号
		$columns=rtrim($columns,',').")";
		$columnsValue=rtrim($columnsValue,',').")";

		$query_string=$query_string.$columns.$columnsValue;
		if($this->_dao_debug!=0){
			echo "<br />".$query_string."<br />";

		}
		$this->_dao_query_string=$query_string;

		if(!$this->innerQuery($query_string)){
			//$e = oci_error($this->_dao_conn->conn);
			//$this->_dao_error_message=$query_string.'<br />'.$e['message'].'<br />'.__FILE__.__LINE__;
			//$this->showSqlErrorMessage($query_string,$e['message'],__FILE__,__LINE__);
			return false;
		}else{
			//$this->_dao_error_message='操作已完成';
			if($this->_dao_engine=='oracle'){
				if($log!=''){
					$logTableName=$var['__table'];
					$update_time=time();
					$staff_id=$log;
					$uuid=uniqid('l_',true);
					$newValue=str_replace("'","",$query_string);
					$query_string="insert into logs (uuid,table_name,column_name,old_value,new_value,staff_id,update_time,action)
					values('$uuid','$logTableName','','','$newValue','$staff_id','$update_time','insert')";
					//echo $query_string;
					//exit();
					//oracl_query($query_string);
					//$this->innerQuery('set escape on');
					$this->innerQuery($query_string);

				}
			}
			return true;
		}

	}
	public function oracle_error(){
		return $this->_dao_error_message;
	}
	/**
	 * 请慎用update的log功能,仅能对唯一记录进行log
	 * //$log=array('操作者id','该次操作中不需要做日志被排除的字段1|被排除的字段2','操作表中操作者字段名')
	 * $log=array('操作者id','该次操作中不需要做日志被排除的字段1|被排除的字段2')
	 * @param array
	 *
	 * @return unknown
	 */
	public function update($log=array('','')){
		//有更新条件才能更新
		if(empty($this->_dao_where)){
			echo "update必须要有更新条件才能执行本功能";
			exit();
		}
		//取对象的所有属性以数组的形式存于$vars中
		$var=get_object_vars($this);
		if($this->_dao_engine=='oracle'){
			$logToken=0;
			//注意，在测试的时候，如果发现修改了数据没有增加日志，则
			if($log[0]!='' and 0){
				//强加的一项，如果字段中存储操作者的字段名不是staff_id，则要修改代码
				$log[2]='staff_id';
				$logTableName=$var['__table'];
				$query_string="select * from $logTableName where ".$this->_dao_where;
				$this->log_dao_rs=$this->oracle_query($query_string);
				$row=oci_fetch_array($this->log_dao_rs,OCI_RETURN_NULLS);
				if($row[strtoupper($log[2])]!=$log[0]){
					$logToken=oci_num_rows($this->_stid);
					$removeArray=explode('|',$log[1]);
					$logArray=array();
				}
			}
			if($log[0]!=''){
				//强加的一项，如果字段中存储操作者的字段名不是staff_id，则要修改代码
				$log[2]='staff_id';
				$logTableName=$var['__table'];
				$query_string="select * from $logTableName where ".$this->_dao_where;
				$this->log_dao_rs=$this->oracle_query($query_string);
				$row=oci_fetch_array($this->log_dao_rs,OCI_RETURN_NULLS);
				//if($row[strtoupper($log[2])]!=$log[0]){
				$logToken=oci_num_rows($this->_stid);
				$removeArray=array();
				if(isset($log[1])){
					$removeArray=explode('|',$log[1]);
				}
				$logArray=array();
			}
		}
		$update_string="";
		foreach ($var as $key=>$value){
			//if($key!='__table' and (strpos($key,'_dao_')===false) and $var[$key]!=$this->_dao_init_value){
			if(substr($key,0,1)!='_' and $var[$key]!=$this->_dao_init_value){
				//echo $var[$key].'---'.$key."<br />";
				/*在db类的构造函数中将成员变量的初值全部成为"#^&*^&*#",这样就可以根据用户是否改变了初值决定
				而是否参加形成sql串，这样，用户没有指定值的字段就原始值就不会被误改变
				因为要update 则程序中必然有$user->name='mike'这样的语句，没有设定的属性，则其值一定为"#^&*^&*#"
				$keyType='_'.$key.'_type';
				if($this->$keyType=='date'){
				//$columnsValue=$columnsValue."to_date('".$value."','yyyy-mm-dd hh24:mi:ss'),";
				$update_string=$update_string.$key."=to_date('".$var[$key]."','yyyy-mm-dd hh24:mi:ss'),";
				//echo $temp_filed_list;
				}else{
				$update_string=$update_string.$key."='".$var[$key]."',";
				}*/
				if(isset($this->_dao_escape_value[$key])){
					$update_string=$update_string.$key."=".$this->_dao_escape_value[$key].",";
					//echo '_dao_escape_value'.'<br />';
				}else{
					$update_string=$update_string.$key."='".$var[$key]."',";
					//var_dump($this->_dao_escape_value);
					//echo 'no _dao_escape_value'.'<br />';
				}
				if($this->_dao_engine=='oracle'){
					if($logToken==1){
						//值被修改
						if(count($removeArray)>0 and !in_array($key,$removeArray) and $row[strtoupper($key)]!=$var[$key]){
							$logArray[$key]['old']=$row[strtoupper($key)];
							$logArray[$key]['new']=$var[$key];
						}
					}
				}
			}
			//echo $update_string."<br>";
		}

		$this->_dao_query_string=$update_string;
		if(!empty($update_string)){
			//$update_string=substr($update_string,0,strlen($update_string)-1)." ";
			$update_string=rtrim($update_string,',')." ";
			$query_string="update ".$var['__table']." set ".$update_string." where ".$this->_dao_where;
			//echo $query_string;
			if($this->_dao_debug!=0){
				echo "<br />".$query_string."<br />";
			}

			if($this->innerQuery($query_string)){
				if($this->_dao_engine=='oracle'){
					if(isset($logArray) and (count($logArray)!=0)){
						$update_time=time();
						//var_dump($logArray);

						foreach ($logArray as $key=>$value){
							$oldValue=$value['old'];
							$newValue=$value['new'];
							$staff_id=$log[0];
							$uuid=uniqid('l_',true);
							$query_string="insert into logs (uuid,table_name,column_name,old_value,new_value,staff_id,update_time,action)
					values('$uuid','$logTableName','$key','$oldValue','$newValue','$staff_id','$update_time','update')";
							//echo $query_string;
							//exit();
							//oracl_query($query_string);
							$this->innerQuery($query_string);
						}

					}else{
						//echo "on";
					}
				}
				return true;
			}else{
				//$this->_dao_error_message='操作已完成';
				return false;
			}
		}
	}
	public function distinct($column=''){
		$this->_dao_distinct=$column;
	}
	public function delete($log=''){
		//有条件才删除
		if(empty($this->_dao_where)){
			echo "<br />必须要有删除条件<br />";
			exit();
		}
		$var=get_object_vars($this);
		$query_string="delete from ".$var['__table']."  where ".$this->_dao_where;
		//echo "<br>-----------------".$this->_dao_debug."<br>";
		//echo $this->_dao_debug;
		if($this->_dao_debug!=0){
			echo "<br>".$query_string."<br>";

		}
		$this->_dao_query_string=$query_string;
		if(!$this->innerQuery($query_string)){
			//$e = oci_error($this->_dao_conn->conn);
			//$this->_dao_error_message=$query_string.'<br />'.$e['message'].'<br />'.__FILE__.__LINE__;
			//$this->showSqlErrorMessage($query_string,$e['message'],__FILE__,__LINE__);
			return false;
		}else{
			//$this->_dao_error_message='操作已完成';
			if($this->_dao_engine=='oracle'){
				if($log!=''){
					$logTableName=$var['__table'];
					$update_time=time();
					$staff_id=$log;
					$uuid=uniqid('l_',true);
					$oldValue=str_replace("'","",$this->_dao_where);
					$query_string="insert into logs (uuid,table_name,column_name,old_value,new_value,staff_id,update_time,action)
					values('$uuid','$logTableName','','$oldValue','','$staff_id','$update_time','delete')";
					//echo $query_string;
					//exit();
					//oracl_query($query_string);
					//$this->innerQuery('set escape on');
					$this->innerQuery($query_string);

				}
			}
			return true;
		}


	}
	/**
	 * 子查询
	 * 
	 *
	 * @param string $type 子查询类型
	 * @param dao_oracle $table 子表对象
	 * @param dao_oracle $table 关键字段
	 * $master_table->whereAdd($master_table->subSelect('in',$slave_table,'id'))
	 * 子查询的对象不能输出值了，与关联对象不一样。
	 * 
	 */
	public function subSelect($type,$table,$column=''){
		//以后补对参数有效性的判断
		//如果子表有自定义字段
		if($table->_dao_field_list!=''){
		}else{
			$table->selectAdd($table->__table.".".$column);
		}

		$table->select(false);
		//return $table->_dao_query_string;
		return $this->__table.".".$column.' '.$type.'('.$table->_dao_query_string.')';
	}
	/**
	 * $invoke主要用于子查询，当调用子查询的时候，需要生成SQL串，但并不需要实际执行
	 *
	 * @param int $invoke 自动执行
	 * @return boolen
	 */

	public function select($invoke=true){
		$this->_dao_direct_query=false;
		//生成sql语句
		$field_list="";
		/**
			用户自定义字段的有效性已在selectAdd中做一定的检查 保证至少是  name as myName 型的
			不分组（如果有分组操作一定有自定义字段列表）或是没有用户定义字段列表，则自动生成相应的字段列表　形成　select * 这一部分
			在有多表关联的情况下，分主表与从表分别取出类的成员变量，遍历成员变量数组，形成相应的字段列表
			原理：
			形成的字段列表应该是如下形式 table1.id as table1_id,table1.name as table1_name,table2.id as table2_id,table2.score as table2_score
		*/
		$var=get_object_vars($this);
		//先处理主表，即使只有一张表，也这样处理。这样，单表与多表的处理方式就一致了
		$temp_filed_list='';
		foreach ($var as $key=>$value){
			//if($key!='__table' and strpos($key,'_dao_')===false){
			//过滤内部dao变量，这里有一个不完善的地方，也就是说，表的字段名不能用'_'开头，否则冲突，一下个版本升级为'__'好一些
			if(substr($key,0,1)!='_'){
				//生成形如user.name user_name,user.age user_age的字段列表 oracle 兼容　as
				//$temp_filed_list=$temp_filed_list.$var['__table'].".".$key." as ".$var['__table']."_".$key.",";
				//解决oracle不用能表名做前缀,否则会导致字段名过长的问题,其中主表的别名固定为a，从表依次
				$alias='a';
				//按不同的字段类型做不同的处理2010-6-7 luowei
				/*				$keyType='_'.$key.'_type';
				if($this->$keyType=='date'){
				//echo $keyType;
				$temp_filed_list=$temp_filed_list.'to_char('.$var['__table'].'.'.$key.",'yyyy-mm-dd hh24:mi:ss') as ".$alias."_".$key.",";
				//echo $temp_filed_list;
				}else{
				$temp_filed_list=$temp_filed_list.$var['__table'].".".$key." as ".$alias."_".$key.",";
				}*/
				//不在进行类型判断了
				$temp_filed_list=$temp_filed_list.$var['__table'].".".$key." as ".$alias."_".$key.",";
			}
		}
		/*		if(!empty($this->_dao_distinct)){
		//$var=get_object_vars($this);
		//$field_list="distinct $this->_dao_distinct";
		$this->_dao_field_list="distinct $this->_dao_distinct";
		$this->_dao_field_list_add=false;
		}	*/

		//这里把字段命名冲突的事交给使用者本身了，如果自定义字段与已有字段冲突，执行后系统报错
		if($this->_dao_field_list!='' and $this->_dao_field_list_add){
			$temp_filed_list=$temp_filed_list.$this->_dao_field_list.',';
		}elseif($this->_dao_field_list!='' and !$this->_dao_field_list_add){
			$temp_filed_list=$this->_dao_field_list.',';
		}
		$field_list=$field_list.$temp_filed_list;
		//echo "<pre>";
		//var_dump($this->_dao_join_table);
		//echo "</pre>";
		//$this->_dao_join_table是关联表数组，里面存储了主表所对应的多个关联表，可以一个一个取出表名来处理
		//如果有关联表，自动处理关联表 但如果有分组操作，则关联表的字段全不做处理 否则将生成　select count(*) as counter,score1.english as aaaa from student inner join score1 on student.id=score1.id and(score1.english>20) group by class having count(*)>1 order by class desc　这样的代码，sql是错误的
		//if(!$this->_dao_groupby){
		//$query_string=$query_string." group by  ".$this->_dao_groupby." ";
		//$temp_counter=count($this->_dao_join_table);
		//for($counter=0;$counter<$temp_counter;$counter++){
		//20110920
		foreach ($this->_dao_join_table as $k=>$v){
			//取表对象
			$table=$v;
			//echo $table;
			//获取实例的成员变量及其值
			$var=get_object_vars($table);
			//生成从表的字段列表
			$temp_filed_list='';
			//对是否进行了分组操作进行处理，如果主表有分组操作，则从表不能直接出现字段列表，只能从从表的selectAdd中取字段，否则从表的字段不出现
			if($this->_dao_groupby==''){

				foreach ($var as $key=>$value){


					//if($key!='__table'and strpos($key,'_dao_')===false){
					//过滤内部dao变量，这里有一个不完善的地方，也就是说，字段名不能用_开头
					if(substr($key,0,1)!='_'){
						//生成形如user.name as user_name,user.age as user_age的字段列表
						//echo $var['__table'];
						//$temp_filed_list=$temp_filed_list.$var['__table'].".".$key." as ".$var['__table']."_".$key.",";
						//echo $this->_dao_join_table_alias[$var['__table']].'<br />';
						//解决oracle不用能表名做前缀导致过长的问题,
						$alias=$this->_dao_join_table_alias[$var['__table']];
						//$temp_filed_list=$temp_filed_list.$var['__table'].".".$key." as ".$alias."_".$key.",";
						//$keyType='_'.$key.'_type';
						//不在进行类型判断了

						/*						if($this->$keyType=='date'){
						//echo $keyType;
						$temp_filed_list=$temp_filed_list.'to_char('.$var['__table'].'.'.$key.",'yyyy-mm-dd hh24:mi:ss') as ".$alias."_".$key.",";
						//echo $temp_filed_list;
						}else{
						$temp_filed_list=$temp_filed_list.$var['__table'].".".$key." as ".$alias."_".$key.",";
						}
						*/
						$temp_filed_list=$temp_filed_list.$var['__table'].".".$key." as ".$alias."_".$key.",";
					}
				}
				//生成从表的自定义字段列表 下面的代码是正确的20111022
				if($table->_dao_field_list!='' and $table->_dao_field_list_add){
					$temp_filed_list=$temp_filed_list.$table->_dao_field_list.',';
				}elseif($table->_dao_field_list!='' and !$table->_dao_field_list_add){
					$temp_filed_list=$table->_dao_field_list.',';
				}
			}else{
				//如主表有分组，仅添加从表的自定义字段到从表字段列表
				if($table->_dao_field_list!=''){
					$temp_filed_list=$temp_filed_list.$table->_dao_field_list.',';
				}
			}
			//这句很重要，否则子查询带join时出错
			if(!$invoke and $this->_dao_field_list!=''){
				//$field_list=$field_list.$temp_filed_list;
			}
			//把得到的从表的字段列表与主表连在一起。分不同的条件处理
			if($invoke){
				$field_list=$field_list.$temp_filed_list;
			}
			//$field_list=$field_list.$temp_filed_list;
		}
		//形成主表与从表的字段列表
		//只有主表　select user.name as user_name,user.age as user_age.....
		//有主从表　select user.name as user_name,user.age as user_age,score.english as score_english,score.chinese as score_chinese .....
		//$field_list=substr($field_list,0,strlen($field_list)-1)." ";

		//}
		$field_list=rtrim($field_list,',')." ";
		//echo $field_list;
		//如果是count操作，则只形成一个count(*) as conter 或是count(指定字段) as counter的字段列表
		if(!empty($this->_dao_count)){
			//$var=get_object_vars($this);
			$field_list="count($this->_dao_count) as counter";
		}
		if(!empty($this->_dao_distinct)){
			//$var=get_object_vars($this);
			//$field_list="distinct $this->_dao_distinct";
			$this->_dao_field_list="distinct $this->_dao_distinct";
			$this->_dao_field_list_add=false;
			$field_list="distinct $this->_dao_distinct";
		}

		$var=get_object_vars($this);
		//增加对子查询的处理 luowei2011-02-15
		if($this->_dao_subquery!=''){
			$query_string="select $field_list from (".$this->_dao_subquery.") ";
		}else{
			$query_string="select $field_list from ".$var['__table']." ";
		}

		$join_string=" ";
		//形成多表关联的join代码部份
		$temp_counter=count($this->_dao_join_table);
		//2011-0920
		/*		for($counter=0;$counter<$temp_counter;$counter++){
		$join_string=$join_string.$this->_dao_join[$counter]." ";
		}*/
		foreach ($this->_dao_join_table as $k=>$v){
			$join_string=$join_string.$this->_dao_join[$k]." ";
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
		//order by 不在自动加表名了，自动加表名会出一些小问题
		if($this->_dao_orderby and 0){
			//$var=get_object_vars($this);
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
		if($this->_dao_orderby){
			$temp_string=' order by '.$this->_dao_orderby;
			$query_string=$query_string.$temp_string;
		}
		//注：不能用$this->_dao_limit_start来判断是否需要取部分数据，因为有可能limit_start是从0开始的，则limit不起作用

		//$query_string="select * from (select A.*,ROWNUM RN from (select * from student where gender='男' order by name) A where ROWNUM <= 6) where RN >= 4";
		//如果有limit操作


		if($this->_dao_limit_number){

			if($this->_dao_engine=='oracle'){
				$tempLimitNumber=$this->_dao_limit_number+$this->_dao_limit_start;
				//$query_string="select B.*,NAME my_name from (select A.*,ROWNUM RN from (select * from student where gender='男' order by name) A where ROWNUM <= 3) B where RN >= 1";
				$temp_filed_list=strtoupper($field_list);
				//$temTableName=strtoupper($this->__table);
				//$query_string="select studentB.* from (select studentA.*,ROWNUM RN from (select name as my_name,class as my_class from student where gender='男' order by name) studentA where ROWNUM <= 3) studentB where RN >= 1";
				$query_string="select * from (select A.*,ROWNUM as RN from ($query_string) A where ROWNUM <= $tempLimitNumber) where RN > $this->_dao_limit_start";
				//$query_string="select $field_list from (select A.*,ROWNUM RN from ($query_string) A where ROWNUM <= 6) where RN >= 4";
			}
			if($this->_dao_engine=='mysql'){
				$tempLimitNumber=$this->_dao_limit_number+$this->_dao_limit_start;
				$temp_filed_list=strtolower($field_list);
				$query_string=$query_string." limit ".$this->_dao_limit_start.",".$tempLimitNumber;
			}
		}
		//将生成成功的sql串写入成员变量_dao_query_string
		$this->_dao_query_string=$query_string;
		//如果设置了调试开关
		if($this->_dao_debug!=0){
			echo "<br>".$this->_dao_query_string."<br>";
		}else{
			//echo "<br />未开调试<br />";
		}
		//$invoke默认为true，为false时，为一些只需要生成where语句的功能服务。
		if($invoke){
			if($this->_dao_cache_token){
				$this->_dao_cache_filename='cache_'.md5($query_string).'.php';
				$path_to_file=$this->_dao_cache_url.$this->_dao_cache_filename;
				//如果处于缓存周期内
				if(file_exists($path_to_file) and (time()-filemtime($path_to_file))<=$this->_dao_cache_timeout){
					$this->_dao_cache_available=true;
					$this->_dao_cache_rows=unserialize(file_get_contents($path_to_file));
					return true;
				}
			}
			//需要缓存处理的就是这句
			if($this->_dao_engine=='mysql'){
				$this->_dao_rs=$this->mysql_query($query_string);
			}
			if($this->_dao_engine=='oracle'){
				$this->_dao_rs=$this->oracle_query($query_string);
			}


		}
		return true;
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
	 * 对于关联操作，在处理完主表后，在循环处理从表，处理方法与主表一致
	 *
	 * @return unknown
	 */
	public function fetch(){
		if($this->_dao_direct_query){
			//var_dump($this->_dao_rs);
			//echo "<br />";
			//var_dump(oci_fetch_array($this->_dao_rs,OCI_ASSOC));
			if($this->_dao_engine=='oracle'){
				if($row=oci_fetch_array($this->_dao_rs,OCI_ASSOC)){
					foreach ($row as $key=>$value){
						$this->{strtolower($key)}=$value;
					}
					return true;
				}else{
					return false;
				}
			}
			if($this->_dao_engine=='mysql'){
				if($row=mysql_fetch_assoc($this->_dao_rs)){
					foreach ($row as $key=>$value){
						$this->{strtolower($key)}=$value;
					}
					return true;
				}else{
					return false;
				}
			}

		}
		//首先单独处理count操作
		//如果是count操作,取出结果后直接返回
		//var_dump($this->_dao_rs);
		if(!empty($this->_dao_count)){
			if($this->_dao_cache_token and $this->_dao_cache_available){
				$row=$this->_dao_cache_rows[0];
			}
			if(!($this->_dao_cache_token and $this->_dao_cache_available)){

				if($this->_dao_engine=='oracle'){
					$row=oci_fetch_array($this->_dao_rs,OCI_RETURN_NULLS);
				}
				if($this->_dao_engine=='mysql'){
					$row=mysql_fetch_assoc($this->_dao_rs);
				}

				//$row=oci_fetch_array($this->_dao_rs,OCI_ASSOC);


				$this->_dao_cache_rows[0]=$row;
				//加记录结束标志
				$this->_dao_cache_rows[1]=false;
				//使用缓存时才进行,并且对于count的缓存单独进行,且没有缓存过。
				if($this->_dao_cache_token){
					$temp_data=serialize($this->_dao_cache_rows);
					$path_to_file=$this->_dao_cache_url.$this->_dao_cache_filename;
					file_put_contents($path_to_file,$temp_data);
				}

			}
			if($this->_dao_engine=='oracle'){
				$row_counter=$row['COUNTER'];
				$this->free_statement();
			}
			if($this->_dao_engine=='mysql'){
				$row_counter=$row['counter'];
			}
			//注意字段名大小写
			return $row_counter;
		}
		//取数据
		//如果有缓存文件与缓存数据
		if($this->_dao_cache_token and $this->_dao_cache_available){
			$row=$this->_dao_cache_rows[0];
			//取得记录后从数组中删除一条
			array_shift($this->_dao_cache_rows);
		}
		//如果不设置缓存或是设置了缓存但过期或是第一次
		if(!$this->_dao_cache_token or ($this->_dao_cache_token and !$this->_dao_cache_available)){
			if($this->_dao_engine=='oracle'){
				$row=oci_fetch_array($this->_dao_rs,OCI_RETURN_NULLS);
			}
			if($this->_dao_engine=='mysql'){
				$row=mysql_fetch_assoc($this->_dao_rs);
			}

			$this->_dao_cache_rows[]=$row;
		}

		//未取到数据
		if(!$row){
			//如无数据或是取完数据，则返回
			//2010-06-28 luo wan
			//如无数据时，将表对象文件的初值重置为'';
			$this->initKeyValue('');
			//2011-09-20
			foreach ($this->_dao_join_table as $k=>$v){
				$table=$v;
				$table->initKeyValue('');
			}
			//启用缓存并且缓存文件不存在或是缓存已过期，最新生成缓存信息
			if($this->_dao_cache_token and !$this->_dao_cache_available){
				$temp_data=serialize($this->_dao_cache_rows);
				$path_to_file=$this->_dao_cache_url.$this->_dao_cache_filename;
				//echo $path_to_file;
				file_put_contents($path_to_file,$temp_data);
			}
			return false;
		}
		if($this->_dao_fetch_rest_rows!=null){
			foreach ($this->_dao_fetch_rest_rows as $value){
				if(!is_object($value[0]) and $value[0]=='this'){
					$value[0]=$this;
				}

				if($value[1]==''){
					//用户自定义字段，没有表名与别名前缀

					if($this->_dao_engine=='mysql'){
						$value[0]->$value[2]=$row[strtolower($value[2])];
					}
					if($this->_dao_engine=='oracle'){
						$value[0]->$value[2]=$row[strtoupper($value[2])];
					}
				}else{
					if($this->_dao_engine=='mysql'){
						$value[0]->$value[2]=$row[strtolower($value[1].'_'.$value[2])];
					}
					if($this->_dao_engine=='oracle'){
						$value[0]->$value[2]=$row[strtoupper($value[1].'_'.$value[2])];
					}


				}
				//这里比mysql版本实现得更巧妙一些
				$value[0]->_dao_to_array[$value[2]]=$value[0]->$value[2];
			}
			return true;
		}else{
			$this->_dao_fetch_rest_rows=array();
		}
		//先处理主表
		//如果仅为用户自定义字段 这时_dao_field_list_add参数一定为false
		if(!empty($this->_dao_field_list) and $this->_dao_field_list_add==false){
			//必须在这里清空一次，否则出错
			//var_dump($this->_dao_key_value);
			$this->_dao_key_value=array();
			//通过遍历获取的oracle数据来重建表成员对象
			foreach ($row as $key=>$value){
				//数字不能做字段名，过滤掉
				if(!is_numeric($key)){
					$this->__set(strtolower($key),$value);
					//通过__set方法来模拟生成成员变量名与值。 也就是说如果用户自定义了一个新的字段别名，这个字段别名在
					//类的定义文件中是没有的，就可以用set方法来生成如：select name as my_name
					//通过__set方法形成一个虚似的$table->my_name="mike"的形式，这个形式的数据保存在
					//$this->_dao_key_value中，通过__get方法中的foreach可以取出
					//注入到_fetch_rest_rows
					$this->_dao_fetch_rest_rows[]=array('this','',strtolower($key));
					$this->_dao_to_array[$key]=$value;
				}
			}
		}
		//如果为有用户自定义字段并且为添加模式 或是没有用户自定义字段
		if(empty($this->_dao_field_list) or (!empty($this->_dao_field_list) and $this->_dao_field_list_add==true)){
			$var=get_object_vars($this);//取主表
			//var_dump($var);
			//先处理原生字段
			foreach ($var as $key=>$value){
				//if($key!='__table' and strpos($key,'_dao_')===false){
				if(substr($key,0,1)!='_'){
					//形成字段名，对于非用户自定义字段的情况下，现在字段名在select方法中被统一处理成为了 表名_字段名[user_name]这种形式了
					//解决oracle字段名30个字符的限制
					//$field=strtoupper($var['__table']."_".$key);
					//主表的别名为a
					$alias='a';


					if($this->_dao_engine=='mysql'){
						//echo "ddddddddddddddddddddddddddddddd";
						$field=strtolower($alias."_".$key);
					}
					if($this->_dao_engine=='oracle'){
						$field=strtoupper($alias."_".$key);
					}
					//echo '------key----'.$key.'-----field-----'.$field.'------value----'.$row[$field].'----------';
					//echo "<br />";
					//将取得的值填充到表对象属性中
					//注意，如果有用户自定义字段，并且是添加模块，则取记录时，到了第二条就要报notice错误，这是正常的，
					//因为在第一条的时候，一切正常，但在处理用户自定义字段时，已将用户自定义自段用__set方法添加给了表对象，
					//所以在处理第二条的时间，get_object_vars将自定义的字段也反射出来，但由于自定义字段未按正常字段这样规范化处理
					//因此在按正常取值的时候　就取不到，因此报notice 就是说
					//name as myname
					//正常字段　$this->name=$row['sutdnet_name'];
					//自定义字段 $this->myName=$row['sutdnet_myname'];//找不到了
					//if(isset($row[$field])){
					//	$this->$key=$row[$field];//相当于$this->name=$row[user_name];
					//}
					//oracle对于没有值的字段，在正常模式中，没有值的字段根本不出现，因为会导致下一条记录出现上一条记录值的情况，现修正，不在用
					//(isset($row[$field])去判断这个字段是否存在了，强行进行赋值操作。此注释请保留
					$this->$key=$row[$field];
					//注入到_fetch_rest_rows
					$this->_dao_fetch_rest_rows[]=array('this',$alias,strtolower($key));
					$this->_dao_to_array[$key]=$row[$field];
				}

			}
			//再处理自定义字段
			foreach ($row as $key=>$value){
				//数字不能做字段名，过滤掉
				//不是用户自定义的字段名，也过滤掉
				//if(!is_numeric($key) and in_array($key,$this->_dao_filed_array)){
				//oracle 方式
				//var_dump($this->_dao_filed_array);
				//var_dump(strtoupper($this->_dao_filed_array));
				//$fieldList=strtoupper(implode(',',$this->_dao_filed_array));

				if($this->_dao_engine=='mysql'){

					$fieldList=strtolower(implode(',',$this->_dao_filed_array));
				}
				if($this->_dao_engine=='oracle'){
					$fieldList=strtoupper(implode(',',$this->_dao_filed_array));
				}

				//mysql
				//if(!is_numeric($key) and in_array($key,$this->_dao_filed_array)){
				//oracle
				if(!is_numeric($key) and strpos($fieldList,$key)!==false){
					//echo $key."=>".$value."<br>";
					$tempKey=strtolower($key);
					$this->__set($tempKey,$value);
					//通过__set方法来模拟生成成员变量名与值。 也就是说如果用户自定义了一个新的字段别名，这个字段别名在
					//类的定义文件中是没有的，就可以用set方法来生成如：select name as my_name
					//通过__set方法形成一个虚似的$table->my_name="mike"的形式，这个形式的数据保存在
					//$this->_dao_key_value中，通过__get方法中的foreach可以取出
					//注入到_fetch_rest_rows
					$this->_dao_fetch_rest_rows[]=array('this','',strtolower($key));
					$this->_dao_to_array[$key]=$value;
				}
			}
		}
		//再处理关联表。
		//取关联表 有多表关联，按多表关联的方法取数据。字段名为 表名_字段名
		//var_dump($this->_dao_join_table);
		//_dao_join_table里存储着关联表对象
		//如果有关联表，自动处理关联表
		foreach ($this->_dao_join_table as $k=>$v){
			//这里很垃圾，没有像其它字段一样，分别处理主表的distinct字段，从表的distinct，而全部由主表对象输出
			if($this->_dao_distinct!=''){
				continue;
			}
			$table=$v;
			//如果仅为用户自定义字段
			if(!empty($table->_dao_field_list) and $table->_dao_field_list_add==false){
				//必须在这里清空一次，否则出错
				$table->_dao_key_value=array();
				//通过遍历获取的mysql数据来重建表成员对象
				foreach ($row as $key=>$value){
					//数字不能做字段名，过滤掉
					if(!is_numeric($key)){
						//echo $key."=>".$value."<br>";
						//$table->__set($key,$value);
						$table->__set(strtolower($key),$value);
						//通过__set方法来模拟生成成员变量名与值。 也就是说如果用户自定义了一个新的字段别名，这个字段别名在
						//类的定义文件中是没有的，就可以用set方法来生成如：select name as my_name
						//通过__set方法形成一个虚似的$table->my_name="mike"的形式，这个形式的数据保存在
						//$this->_dao_key_value中，通过__get方法中的foreach可以取出
						//注入到_fetch_rest_rows
						$this->_dao_fetch_rest_rows[]=array($table,'',strtolower($key));
						$table->_dao_to_array[$key]=$value;
					}
				}
			}
			//如果主表无分级，且从表有用户自定义字段并且为添加模式 或是没有用户自定义字段
			if(($this->_dao_groupby=='' and empty($table->_dao_field_list)) or ($this->_dao_groupby=='' and !empty($table->_dao_field_list) and $table->_dao_field_list_add==true)){
				$var=get_object_vars($table);//取主表
				//先处理原生字段
				foreach ($var as $key=>$value){
					//if($key!='__table' and strpos($key,'_dao_')===false){
					if(substr($key,0,1)!='_'){
						//形成字段名，对于非用户自定义字段的情况下，现在字段名在select方法中被统一处理成为了 表名_字段名[user_name]这种形式了
						//解决oracle字段30字符的问题
						$alias=$this->_dao_join_table_alias[$var['__table']];
						//$field=strtoupper($alias."_".$key);
						if($this->_dao_engine=='mysql'){
							$tempField=strtolower($alias."_".$key);
						}
						if($this->_dao_engine=='oracle'){
							$tempField=strtoupper($alias."_".$key);
						}
						//$field=$var['__table']."_".$key;
						//echo $field;
						//$tempField=strtoupper($field);
						//echo '------key----'.$key.'-----field-----'.$field.'------value----'.$row[$field].'----------';
						//echo "<br />";
						//将取得的值填充到表对象属性中
						//oracle生成的大小字段转小写
						$tempKey=strtolower($key);
						$table->$tempKey=$row[$tempField];//相当于$this->name=$row[user_name];
						//注入到_fetch_rest_rows
						$this->_dao_fetch_rest_rows[]=array($table,$alias,strtolower($key));
						$table->_dao_to_array[$tempKey]=$row[$tempField];
					}
				}
				//再处理自定义字段
				foreach ($row as $key=>$value){
					//数字不能做字段名，过滤掉
					//不是用户自定义的字段名，也过滤掉

					if($this->_dao_engine=='mysql'){
						//$field=strtolower($alias."_".$key);
						$fieldList=strtolower(implode(',',$this->_dao_filed_array));
					}
					if($this->_dao_engine=='oracle'){
						$fieldList=strtoupper(implode(',',$this->_dao_filed_array));
					}

					//mysql
					//if(!is_numeric($key) and in_array($key,$this->_dao_filed_array)){
					//oracle
					if(!is_numeric($key) and strpos($fieldList,$key)!==false){
						//echo $key."=>".$value."<br>";
						$table->__set(strtolower($key),$value);
						//$table->__set($key,$value);
						//通过__set方法来模拟生成成员变量名与值。 也就是说如果用户自定义了一个新的字段别名，这个字段别名在
						//类的定义文件中是没有的，就可以用set方法来生成如：select name as my_name
						//通过__set方法形成一个虚似的$table->my_name="mike"的形式，这个形式的数据保存在
						//$this->_dao_key_value中，通过__get方法中的foreach可以取出
						//注入到_dao_fetch_rest_rows
						$this->_dao_fetch_rest_rows[]=array($table,'',strtolower($key));
						$this->_dao_to_array[$key]=$value;
					}
				}
			}
		}
		return true;
	}
	/**
	 * 以数组的形式返回一条记录,因为有可能存在主调程序对数据进行修改的情况，因此在输出时，重新生成一次
	 *
	 * @return unknown
	 */	
	public function toArray(){
		/*		echo "<pre>";
		var_dump($this->_dao_to_array);
		echo "</pre>";*/
		foreach ($this->_dao_to_array as $key=>$value){
			$this->_dao_to_array[$key]=$this->$key;
		}
		//var_dump($this->_dao_to_array);
		return $this->_dao_to_array;
	}
	/**
	 * 以XML的形式返回一条记录
	 * 如果是主表对象，则$obj参数可为空，如果是从表对象，则将此对象直接传入。
	 * $notation参数表示生成的XML的标签名，可自定义，默认为row
	 * 
	 * 2011-09-12 修正为默认不产生外标签
	 * $notation为生成的xml外标签
	 * $deny_array为不需要出现在xml中的字段
	 * @param string $obj
	 * @param string $notation
	 * @return string
	 */
	public function toXML($notation='',$deny_array=array()){
		/*		if($obj==''){
		$obj=$this;
		}*/
		$string='';//定义字符串，避免出现notice
		if($notation!=''){
			$string='<'.$notation.'>';
		}
		foreach ($this->_dao_to_array as $key=>$value){
			if(in_array($key,$deny_array)){
				continue;
			}
			$string=$string.'<'.$key.'>'.$this->$key.'</'.$key.'>';
		}
		if($notation!=''){
			$string=$string.'</'.$notation.'>';
		}
		return $string;
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
			$this->_dao_where='('.$where.')';
		}else{
			$this->_dao_where=$this->_dao_where." and (".$where.")";
		}

	}
	public function subquery($string){
		$this->_dao_subquery=$string;
	}

	public function orderby($orderby){
		$this->_dao_orderby=$orderby;
	}
	public function limit($start,$number){
		$this->_dao_limit_start=$start;
		$this->_dao_limit_number=$number;
	}
	/**
	 * 如果有字段命名冲突，请自行加表前缀或是使用$table_obj->_name的方式
	 *
	 * @param unknown_type $groupby
	 */
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
	 * 使用方法
	 * $student->name=$student->escape('name','substr(name,1,2)')
	 * 
	 */
	public function escape($key,$value){
		//echo "-------------in escape----------------";
		$this->_dao_escape_value[$key]=$value;
		//var_dump($this->_dao_escape_value);
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
			case "right":
				$join_string=$join_string." right join ".$slaver_table->__table." on ".$master_table.".".$key_column."=".$slaver_table->__table.".".$key_column." ";
				break;
		}
		array_push($this->_dao_join,$join_string);
		//array_push($this->_dao_join_table,$slaver_table);
		$apaher='bcdefghijklmnopqrstuvwxyz';
		$tableAlias=substr($apaher,count($this->_dao_join_table_alias,1));
		$this->_dao_join_table_alias[$slaver_table]=$tableAlias;
		//将关联表名与形成的关联查询字串写进成员数组变量中存储
		//同时形成相应的别名字段
	}
	/**
	 * 用于根据表的uuid 或是id 取指定字段的值
	 *
	 * @param unknown_type $key
	 * @param unknown_type $column
	 */
	public function getKeyValue($key,$keyValue,$column){
		$this->_dao_where="$key='$keyValue'";
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
	 * 本框架支持 一主多从的连接方式。暂不支持　主－从－从的连接方式，此方式可转换为一主多从的方式来完成
	 * 如学生基本表，成绩表，教师表
	 *
	 * @param string $method 关联方式
	 * @param object $masterTable 主表对象
	 * @param object $slaveTable 从表对象
	 * @param mixed $masterKeyColumn 主表关键字段
	 * @param mixed $slaveKeyColumn 从表关键字段
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
			//require_once(__SITEROOT.'config');
			$slaveTableName='T'.$a['0'];
			$slaveTable=new $slaveTableName;
			//var_dump($slaveTable);
			//echo $slaveTableName;
			//echo "pear db 用法";
			//exit();
		}
		//----join on 后条件------start
		$join_on_str='';//join on on后面条件
		if(is_array($masterKeyColumn) && is_array($slaveKeyColumn)){
			if(count($masterKeyColumn)!=count($slaveKeyColumn)){
				new Exception("masterKeyColumn 和 slaveKeyColumn 字段数必须一致！");
			}
			$masterKeyColumn=array_values($masterKeyColumn);
			$slaveKeyColumn =array_values($slaveKeyColumn);

			foreach ($masterKeyColumn as $key=>$value){
				$join_on_str.=$masterTable->__table.'.'.$value.'='.$slaveTable->__table.'.'.$slaveKeyColumn[$key] .' and ';
			}
			$join_on_str=rtrim($join_on_str,'and ');//去掉末尾的 and

		}else {
			//join on on后面条件
			$join_on_str=$masterTable->__table.".".$masterKeyColumn."=".$slaveTable->__table.".".$slaveKeyColumn." ";
		}
		//------join on 后条件------end
		$join_string="";
		$new_join_table=true;
		switch ($method){
			case "inner":
				if(!in_array($slaveTable,$this->_dao_join_table)){
					$join_string=$join_string." inner join ".$slaveTable->__table." on ".$join_on_str;
					//如果关联的从表本身也要对数据进行过滤，则在此处理
					if($slaveTable->getWhereString()!=''){
						$join_string=$join_string.' and ('.$slaveTable->getWhereString().')';
					}
				}else{
					//当同一对象多字段关联时 就是二个表对象用二个以上的字段关联，而用的是两个joinAdd来完成，而不是用数组参数的方式时
					//$join_string=$join_string." and ".$slaveTable->__table." on ".$masterTable->__table.".".$masterKeyColumn."=".$slaveTable->__table.".".$slaveKeyColumn." ";
					/*					//如果关联的从表本身也要对数据进行过滤，则在此处理
					if($slaveTable->getWhereString()!=''){
					$join_string=$join_string.' and ('.$slaveTable->getWhereString().')';
					}*/
					$join_string=$this->_dao_join[$slaveTable->__table]." and ".$masterTable->__table.".".$masterKeyColumn."=".$slaveTable->__table.".".$slaveKeyColumn." ";
					$new_join_table=false;
				}
				break;
			case "left":
				if(!in_array($slaveTable,$this->_dao_join_table)){
					$join_string=$join_string." left join ".$slaveTable->__table." on ".$join_on_str;
					if($slaveTable->getWhereString()!=''){
						$join_string=$join_string.' and ('.$slaveTable->getWhereString().')';
					}
				}else{
					$join_string=$this->_dao_join[$slaveTable->__table]." and ".$masterTable->__table.".".$masterKeyColumn."=".$slaveTable->__table.".".$slaveKeyColumn." ";
					$new_join_table=false;
				}
				break;
			case "right":
				if(!in_array($slaveTable,$this->_dao_join_table)){
					$join_string=$join_string." right join ".$slaveTable->__table." on ".$join_on_str;
					if($slaveTable->getWhereString()!=''){
						$join_string=$join_string.' and ('.$slaveTable->getWhereString().')';
					}
				}else{
					$join_string=$this->_dao_join[$slaveTable->__table]." and ".$masterTable->__table.".".$masterKeyColumn."=".$slaveTable->__table.".".$slaveKeyColumn." ";
					$new_join_table=false;

				}
				break;
		}
		//echo $join_string."<br />";
		//exit();
		//array_push($this->_dao_join,$join_string);
		$this->_dao_join[$slaveTable->__table]=$join_string;
		if($new_join_table){
			$this->_dao_join_table[$slaveTable->__table]=$slaveTable;
			//array_push($this->_dao_join_table,$slaveTable);
			//将关联表名与形成的关联查询字串写进成员数组变量中存储
			$alphabet='bcdefghijklmnopqrstuvwxyz';
			//echo count($this->_dao_join_table_alias);
			$tableAlias=substr($alphabet,count($this->_dao_join_table_alias),1);
			//echo $tableAlias;
			$this->_dao_join_table_alias[$slaveTable->__table]=$tableAlias;
		}

	}
	/**
	 * 统计满足条件的记录数。
	 * count 操作完成后，可不用重新实例化对象，继续原来的实例进行select操作。
	 *
	 * @param unknown_type $column
	 * @return unknown
	 */
	public function count($column='*'){
		//if($column=='*')
		$this->_dao_count=$column;
		$this->select();//主动调用select方法
		//echo "<br>".$this->_dao_query_string."<br>";
		$counter=$this->fetch();//主动fetch
		//在count操作完成后，主动把$this->_dao_count置为空，目的在于可以完成count操作后不用
		//实例化新对应继续进行select 等操作
		$this->_dao_count='';
		//把几个与缓存操作相关的变量恢复初值
		$this->_dao_cache_rows=array();
		$this->_dao_cache_available=false;
		return $counter;
	}
	public function columns_define($columns){
		$this->_dao_field_list=$columns;
	}
	/**
	 * 添加自定义自段 如
	 * sum('salary') as sum_salary,average('salary') as average_salary
	 * 处理后将生成
	 * sum('salary') as tableName_sum_salary,average('salary') as tableName_average_salary
	 * $type 为空时，将仅使用用户自定义的字段。为add的时候，则会将用户自定义字段与所有表字段融合在一起
	 * 
	 *
	 * @param string $columns
	 * @param string $method
	 */
	public function selectAdd($columns='*',$type=''){
		//对用户添加的自定义字段进行分析
		//2010-6-28 不在进行此判断了 luo ye
		$level1=explode(',',$columns);

		//var_dump($level1);
		//2010 4 29 偿试了自定义字段规范化的操作，结果不行，还是按原来　的方法完成//$tempColumns=$tempColumns.$key.' as '.$this->__table.'_'.$value;
		//$tempColumns='';
		/*		foreach ($level1 as $key=>$value){
		$level2=explode(' as ',$value);
		if(count($level2)<2){
		echo "语法错误，必须使用 name as myName 的方式进行定义 ";
		exit();
		}else{
		$this->_dao_filed_array[]=$level2[1];
		//$this->_dao_filed_array[]=$this->__table.'_'.$level2[1];
		}
		//$tempColumns=$tempColumns.$key.' as '.$this->__table.'_'.$value;
		}*/

		foreach ($level1 as $key=>$value){
			$level2=explode(' as ',$value);
			if(count($level2)<=1){
				//echo "您的selectAdd使用上有错";
				continue;
			}
			//var_dump($level2);
			$this->_dao_filed_array[]=$level2[1];
		}
		$this->_dao_field_list=$this->_dao_field_list.','.$columns;
		//$this->_dao_field_list=$this->_dao_field_list.','.$columns;
		$this->_dao_field_list=ltrim($this->_dao_field_list,',');
		if($type=='add'){
			$this->_dao_field_list_add=true;
		}

		return ;


	}
	/**
	 * 开始事务功能
	 * 注意，默认方式为自动提交
	 * 请不在要select 操作中使用事务模式
	 *
	 */
	public function startTransaction(){
		$this->_dao_commit_modle='2';
	}
	/**
	 * 结束事务功能
	 *
	 */
	public function endTransaction(){
		$this->_dao_commit_modle='1';
	}
	/**
	 * 事务方式下提交修改后的数据
	 *
	 */
	public function commit(){
		//echo $this->_dao_engine.'ddd';
		if($this->_dao_engine=='oracle'){
			//非自动模式才主动提交
			if($this->_dao_commit_modle=='2'){
				if(oci_commit($this->_dao_conn->conn)){
					$this->_dao_error_message='操作执行成功';
					return true;
				}else{
					$e=oci_error($this->_stid);
					$this->_dao_error_message=$e['message'].'<br />'.$e['sqltext'];
					return false;
				}
			}
		}
		if($this->_dao_engine=='mysql'){
			//echo $this->_dao_commit_modle;
			if($this->_dao_commit_modle=='2'){
				if(mysql_query("commit")){
					$this->_dao_error_message='操作执行成功';
					//echo $this->_dao_error_message;
					return true;
				}else{
					return false;
				}
			}
		}
	}
	/**
	 * 事务回滚
	 *
	 */
	public function rollBack(){
		if($this->_dao_engine=='oracle'){
			if(oci_rollback($this->_dao_conn->conn)){
				//echo "rollback<br />";
			}else {
				$e=oci_error($this->_stid);
				$this->_dao_error_message=$e['message'].'<br />'.$e['sqltext'];
			}
		}
		if($this->_dao_engine=='mysql'){
			mysql_query("rollback");
		}

	}

	public function debug($debug=0){
		//echo '--------------------------'.$debug;
		$this->_dao_debug=$debug;
	}
	public function debugLevel($debug=0){
		//echo '--------------------------'.$debug;
		$this->_dao_debug=$debug;
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
	//此方法暂时无用
	private function showSqlErrorMessage($query_string,$errorString,$file,$line){
		echo "<br />数据库操作出错了，请检查。[".$file."],[".$line."]<br />";
		echo "<br />SQL代码为：".$query_string."<br />";
		echo "<br />错误信息为：".$errorString."<br />";
		exit();
	}
	public function showErrorMessage(){
		return $this->_dao_error_message;
	}
	public function showSQL(){
		return $this->_dao_query_string;
	}
	protected function mysql_query($query_string){
		//echo $query_string;
		//根据用户的设置确定事务方式
		if($this->_dao_commit_modle=='1'){
			mysql_query("SET AUTOCOMMIT=1");
		}
		if($this->_dao_commit_modle=='2'){
			mysql_query("SET AUTOCOMMIT=0");
		}
		//$rs=mysql_query($query_string,$this->_dao_conn->conn);
		return mysql_query($query_string,$this->_dao_conn->conn);
		//return mysql_query($query_string);
	}

	protected function oracle_query($query_string){
		$this->_stid=$stid=oci_parse($this->_dao_conn->conn, $query_string);
		//echo __LINE__;
		//根据用户的设置确定事务方式
		if($this->_dao_commit_modle=='1'){
			$commitModel=OCI_COMMIT_ON_SUCCESS;
		}
		if($this->_dao_commit_modle=='2'){
			$commitModel=OCI_NO_AUTO_COMMIT;
		}
		/*		echo  	$this->_dao_commit_modle;
		echo "<br />";
		echo  	$commitModel;
		echo "<br />";*/
		if(oci_execute($stid,$commitModel)){

			$this->_dao_error_message=$query_string;
			return $stid;
		}else{
			//$e=oci_error($this->_dao_conn);
			$e=oci_error($stid);
			$this->_dao_error_message=$e['message'].'<br />'.$e['sqltext'];
			/*
			if(strpos($query_string,'insert')!==false){
			echo $query_string." bad<br />";
			echo $this->_dao_error_message;
			}
			*/
			return false;
			//echo "erro";
			//var_dump(oci_error($stid));
		}
		//return $stid;
	}
	public function getTableName(){
		return $table->__table;
	}
	/**
	 * 释放关联于语句或游标的所有资源
	 *
	 */
	public function free_statement(){
		//@oci_free_statement($this->_dao_rs);
		@oci_free_statement($this->_stid);
		//return ;
	}

}
class oracle_connect{
	private $host;
	private $user;
	private $password;
	private $database;
	private $charset;
	public $conn;
	public $engine;
	private static $instance=array();
	private function __construct($host=1){
		/*基于XML的配置实现
		$doc = new DOMDocument();
		$doc->load( __SITEROOT."config/db_config.xml" );
		$elements = $doc->getElementsByTagName( "oracle_connect" );
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

		//echo $host;
		//根据传入的参数记取不同的配置文件
		/*		if($host==1){
		//echo "默认服务器";
		//exit();
		//require_once(__SITEROOT."config/oracleConfig_1.php");

		}
		if($host==2){
		//echo "第二台服务器";
		//exit();
		//require_once(__SITEROOT."config/oracleConfig_2.php");
		}
		if($host==3){
		//echo "第三台服务器";
		//exit();
		require_once(__SITEROOT."config/oracleConfig_3.php");
		}*/
		//require_once(__SITEROOT."config/oracleConfig.php");
		//很奇怪，不能用require_once2011-09-18
		require(__SITEROOT."config/oracleConfig.php");
		//var_dump($databaseConfig);
		//对读入的参数的结构进行判断
		if(isset($databaseConfig[$host]['host']) and
		isset($databaseConfig[$host]['user']) and
		isset($databaseConfig[$host]['password']) and
		isset($databaseConfig[$host]['charset'])){
			//一切正常
		}else{
			var_dump($databaseConfig);
			echo "配置文件中还有规定的参数没有设置".$host;
			exit();
		}
		$this->host=$databaseConfig[$host]['host'];
		$this->user=$databaseConfig[$host]['user'];
		$this->password=$databaseConfig[$host]['password'];
		$this->charset=$databaseConfig[$host]['charset'];
		$this->engine=$databaseConfig[$host]['engine'];
		@$this->port=$databaseConfig[$host]['port'];
		@$this->database=$databaseConfig[$host]['database'];


		//根据不同的engine进行连接
		if($this->engine=='mysql'){
			//$temp_arry=explode('/',$this->host);
			//var_dump($temp_arry);
			if($databaseConfig[$host]['connectType']==1){
				$conn=mysql_connect(
				$this->host,
				$this->user,
				$this->password);
			}elseif($databaseConfig[$host]['connectType']==2){
				//长连接
				$conn=mysql_pconnect(
				$this->host,
				$this->user,
				$this->password);
			}
			mysql_query("set names ".$this->charset);
			mysql_query("use ".$this->database);
			//$this->engine='mysql';
		}
		if($this->engine=='oracle'){
			//普通连接
			if($databaseConfig[$host]['connectType']==1){
				$conn=oci_connect($this->user,$this->password,$this->host,$this->charset);
			}elseif($databaseConfig[$host]['connectType']==2){
				//长连接
				$conn=oci_pconnect($this->user,$this->password,$this->host,$this->charset);
			}
			//$this->engine='oracle';

		}

		if($conn){
			$this->conn=$conn;
			return true;
			//return $conn;
		}else{
			echo "无法连接到指定的数据库服务器:".$this->host;
			exit();
		}
	}
	public static function getInstance($host=1){
		//if(isset(self::$instance[$host])){
		if(!isset(self::$instance[$host])){
			self::$instance[$host] = new oracle_connect($host);
		}
		//return new oracle_connect($host);
		return self::$instance[$host];
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
