<?php

/**
 * 删除一个人的所有数据
 * @param  string $uuid
 */
function delete_iha_function($uuid){
	set_time_limit(0);
	
	require(__SITEROOT.'config/oracleConfig.php');
	//$del_sql="select uuid from individual_core where region_path like '0,1,2,5,75%' and individual_core.identity_number is null";
	//$del_sql="select uuid from individual_core where region_path like '$region_path%'";
	//echo $databaseConfig['user']. $databaseConfig['password'].$databaseConfig['host'].$databaseConfig['charset'];
	//exit();
	$link=oci_pconnect($databaseConfig[1]['user'], $databaseConfig[1]['password'],$databaseConfig[1]['host'],$databaseConfig[1]['charset']) or exit("数据库连接失败！");
	//$sql="select uuid from individual_core where region_path like '0,1,2,5,75%' and individual_core.identity_number is null";
	//所有表名,类型,表备注
	$sql="SELECT TABLE_NAME,TABLE_TYPE,COMMENTS FROM USER_TAB_COMMENTS";
	$statement =oci_parse($link,$sql);
	oci_execute($statement);
	while ($row = oci_fetch_array ($statement,OCI_ASSOC) ) {
		//echo $row['TABLE_NAME'].$row['COMMENTS'];
		$table_name=$row['TABLE_NAME'];//表名
		//echo $table_name;
		//$table_comment=@$row['COMMENTS'];//表备注
		$sql_inner="SELECT
			    A.COLUMN_NAME COLUN_NAME
			FROM
			    USER_TAB_COLUMNS A,USER_COL_COMMENTS B
			WHERE
			    A.TABLE_NAME = B.TABLE_NAME
			    AND A.COLUMN_NAME = B.COLUMN_NAME
			    AND A.TABLE_NAME = '".$table_name."'" ;
		$statement_inner =oci_parse($link,$sql_inner);
		oci_execute($statement_inner);
		while ($row_inner = oci_fetch_array ($statement_inner,OCI_ASSOC) ) {
			if($row_inner['COLUN_NAME']=='ID'){

				$sql= "delete from $table_name  where id ='$uuid'";
				$statement_inner =oci_parse($link,$sql);
				oci_execute($statement_inner);

			}
		}


	}
	//家庭档案
	$sql_family= "delete from family_archive where householder_id ='$uuid'";
	$statement_family =oci_parse($link,$sql_family);
	oci_execute($statement_family);
	//个要档案
	$sql_individual_core= "delete from individual_core where uuid ='$uuid'";
	$statement_individual_core =oci_parse($link,$sql_individual_core);
	oci_execute($statement_individual_core);

}