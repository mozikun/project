<?php
class data_indexController extends controller {
	//oracle orm
	public function indexAction(){
	
		set_time_limit(0);
		require(__SITEROOT.'config/oracleConfig.php');
		require(__SITEROOT.'application/data/models/oci8.php');
		require(__SITEROOT.'application/data/models/mysql.php');
		
		//echo $databaseConfig['user']. $databaseConfig['password'].$databaseConfig['host'].$databaseConfig['charset'];
		//exit();
		foreach ($databaseConfig as $key=>$value)
		{
			if($value['engine']=='mysql'){		

				$link=mysql_connect($value['host'], $value['user'],$value['password']) or exit("数据连接错误");
				

				//$path_root=dirname(__FILE__);
				$mysql=new orm_mysql($link,$value['database']);
				$mysql->set_modle_path(__SITEROOT.'library/Models/');
				$mysql->startMapping();
				
		
			}
			if($value['engine']=='oracle'){
				$link=oci_connect($value['user'], $value['password'],$value['host'],$value['charset']) or exit("数据连接错误");

				//$path_root=dirname(__FILE__);
				$oci=new Oci8($link);
		
				$oci->set_modle_path(__SITEROOT.'library/Models');
				
				//$oci->set_enumerate_path(__SITEROOT.'temp/enumerates');
				//$oci->set_code_path(__SITEROOT.'temp/codes');
				//$oci->set_view_path(__SITEROOT.'temp/views');
				//$oci->set_sql_path(__SITEROOT.'temp/sql');
				//$oci->set_xml_path(__SITEROOT.'temp/xml');
				//$oci->set_doc_path(__SITEROOT.'temp/doc');
				$oci->start_mapping();
			}

			
		}
	}
	public function importAction(){
		set_time_limit(0);
		require(__SITEROOT.'config/oracleConfig.php');
		require(__SITEROOT.'application/data/models/oci8.php');
		//echo $databaseConfig['user']. $databaseConfig['password'].$databaseConfig['host'].$databaseConfig['charset'];
		//exit();
		
		$link=oci_pconnect($databaseConfig['user'], $databaseConfig['password'],$databaseConfig['host'],$databaseConfig['charset']) or exit("asdf");

		//$path_root=dirname(__FILE__);
		$oci=new Oci8($link);

		$oci->set_sql_path(__SITEROOT.'temp/sql');
		$oci->import();
		
	}
	public function deleteAction(){
	   require(__SITEROOT.'config/oracleConfig.php');
       require(__SITEROOT.'application/data/models/oci8.php');
       $link=oci_pconnect($databaseConfig['user'], $databaseConfig['password'],$databaseConfig['host'],$databaseConfig['charset']) or exit("asdf");

		//$path_root=dirname(__FILE__);
		$oci=new Oci8($link);
        $oci->dropTables();
		
	}
	/**
	 * 我好笨的测试代码
	 *
	 */
	public function yqsAction()
	{
		require(__SITEROOT.'config/oracleConfig.php');
			$link=oci_connect($databaseConfig[2]['user'], $databaseConfig[2]['password'],$databaseConfig[2]['host'],$databaseConfig[2]['charset']) or exit("数据连接错误");
			$sql="SELECT
			    A.COLUMN_NAME COLUN_NAME,A.DATA_TYPE DATA_TYPE,A.DATA_LENGTH DATA_LENGTH,B.COMMENTS COMMENTS ,A.COLUMN_ID COLUMN_ID
			FROM
			    USER_TAB_COLUMNS A,USER_COL_COMMENTS B
			WHERE
			    A.TABLE_NAME = B.TABLE_NAME
			    AND A.COLUMN_NAME = B.COLUMN_NAME
			    AND A.TABLE_NAME = 'TB_HIS_ZY_ADM_REG' ORDER BY COLUMN_ID ASC" ;

			$statement =oci_parse($link,$sql);
			oci_execute($statement);
			$i=1;
			while ($row = oci_fetch_array ($statement,OCI_ASSOC) ) {
				$row['COLUN_NAME']=strtolower($row['COLUN_NAME']);//将字段名转成小写
				if ($i%2==0)
				{
					echo '<tr>
        <td>'.@$row['COMMENTS'].'</td><td><!--{$tb_his_zy_adm_reg->'.strtolower($row['COLUN_NAME']).'}--></td>';
				}
				else 
				{
					echo '<td>'.@$row['COMMENTS'].'</td><td><!--{$tb_his_zy_adm_reg->'.strtolower($row['COLUN_NAME']).'}--></td>
    </tr>';
				}
				$i++;
			}
	}
}	
?>	