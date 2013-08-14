<?php
class data_createtableController extends controller {

	public function createtableAction(){

		require_once(__SITEROOT."config/oracleConfig.php");
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
		$conn=oci_connect($this->user,$this->password,$this->host,$this->charset);
		//删除表
		//区域表
		$queryString="drop table region";
		oracl_query($queryString,$conn);
		echo "创建区域表<br />";
		$queryString="create table region(uuid number(12))";
		oracl_query($queryString,$conn);
		$queryString="comment on table region IS '区域表'";
		oracl_query($queryString,$conn);
		$queryString="alter table region add id number(12)";
		oracl_query($queryString,$conn);
		$queryString="comment on column region.id IS '区域id'";
		oracl_query($queryString,$conn);
		$queryString="alter table region add zh_name varchar2(100)";
		oracl_query($queryString,$conn);
		$queryString="comment on column region.zh_name IS '区域中文名'";
		oracl_query($queryString,$conn);
		$queryString="alter table region add p_id varchar2(30)";
		oracl_query($queryString,$conn);
		$queryString="comment on column region.p_id IS '父id'";
		oracl_query($queryString,$conn);
		$queryString="alter table region add region_path varchar2(100)";
		oracl_query($queryString,$conn);
		$queryString="comment on column region.region_path IS '路径'";
		oracl_query($queryString,$conn);
		$queryString="alter table region add standard_code varchar2(20)";
		oracl_query($queryString,$conn);
		$queryString="comment on column region.standard_code IS '内部码'";
		oracl_query($queryString,$conn);
		//插入测试数据
		
		echo "创建区域表完成<br />";
	}
}
function oracl_query($queryString,$conn){
	//global $conn;
	$stid = oci_parse($conn, $queryString);
	oci_execute($stid);
	return $stid;
}

