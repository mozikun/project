<?php
/**
 * tools_policeController
 * 公安系统数据与雅安系统数据处理
 * @author 万
 */
class tools_policeController extends controller
{
	public function init()
	{
		$this->view->basePath = $this->_request->getBasePath();
	}

	/**
     * 
     * 
     * 身份证在公安系统与雅安系统都存在时，以公安系统数据为准，更新雅安系统中的 姓名、性别、民族、户籍住址
     * 
     * @return void
     */
	public function indexAction()
	{
		//设置php运行时间
		set_time_limit(0);
		//连接雅安系统数据库
		$link_yaan=oci_pconnect('yaanchis', 'yaanchis','172.16.11.251:1521/orcl','utf8') or exit("yaan kao");
		//连接公安系统数据库
		$link_police=oci_pconnect('hz2004', 'hz2004','172.16.11.246:1521/orcl','UTF8') or exit("police kao");
		$sex_yaan_array=array('1'=>'未知的性别','2'=>'男','3'=>'女','4'=>'未说明的性别');
		$sex_police_array=array('1'=>'男','2'=>'女');
		$race_yaan=array('1','汉族','2'=>'少数民族');
		$races_yaan=array('2'=>'蒙古族','3'=>'回族','4'=>'藏族','5'=>'维吾尔族','6'=>'苗族','7'=>'彝族','8'=>'壮族','9'=>'布依族','10'=>'朝鲜族','11'=>'满族','12'=>'侗族','13'=>'瑶族','14'=>'白族','15'=>'土家族','16'=>'哈尼族','17'=>'哈萨克族','18'=>'傣族','19'=>'黎族','20'=>'傈傈族','21'=>'佤族','22'=>'畲族','23'=>'高山族','24'=>'拉祜族','25'=>'水族','26'=>'东乡族','27'=>'纳西族','28'=>'景颇族','29'=>'柯尔克孜族','30'=>'土族','31'=>'达斡尔族','32'=>'仫佬族','33'=>'羌族','34'=>'布朗族','35'=>'撒拉族','36'=>'毛难族','37'=>'仡佬族','38'=>'锡伯族','39'=>'阿昌族','40'=>'普米族','41'=>'塔吉克族','42'=>'怒族','43'=>'乌孜别克族','44'=>'俄罗斯族','45'=>'鄂温克族','46'=>'德昂族','47'=>'保安族','48'=>'裕固族','49'=>'京族','50'=>'塔塔尔族','51'=>'独龙族','52'=>'鄂伦春族','53'=>'赫哲族','54'=>'门巴族','55'=>'珞巴族','56'=>'基诺族');
		//检索出雅安系统中身份证存在的数据
		$sql_yaan="SELECT
                        uuid,
						identity_number,
						name,
						sex,
						race,
						race_detail,
						residence_address
					FROM
						individual_core
					WHERE
						identity_number IS NOT NULL
					OR identity_number <> ''";
		$statement_yaan =oci_parse($link_yaan,$sql_yaan);
		oci_execute($statement_yaan);
		$i=0;
		while ($row = oci_fetch_array ($statement_yaan,OCI_ASSOC) ) {
			$identity_number=$row['IDENTITY_NUMBER'];//身份证号
			//print_r($row);
			//exit();
			$sql_police="SELECT
							XM,XB,GMSFHM,MZ,SSXQ,XT_XZQHB.MC SSXQMC,JLX,XT_JLXXXB.MC JLXMC ,MLPH,MLXZ
						FROM
							HJXX_CZRKJBXXB left join XT_XZQHB on HJXX_CZRKJBXXB.SSXQ=XT_XZQHB.DM
							left join XT_JLXXXB on HJXX_CZRKJBXXB.JLX=XT_JLXXXB.DM
						WHERE
							hjxx_czrkjbxxb.GMSFHM = '$identity_number'";
			$statement_police =oci_parse($link_police,$sql_police);
			oci_execute($statement_police);
			while ($row_police = oci_fetch_array ($statement_police,OCI_ASSOC) ) {

				//uuid
				$uuid=$row['UUID'];
				//门路牌号
				$mlph=isset($row_police['MLPH'])?$this->make_semiangle($row_police['MLPH']):'';
				//门路详址
				$mlxz=isset($row_police['MLXZ'])?$this->make_semiangle($row_police['MLXZ']):'';
				//户籍住址
				$hj_address=$row_police['SSXQMC'].$row_police['JLXMC'].$mlph.$mlxz;
				//echo $hj_address;
				if($row['NAME'] != $row_police['XM'] ||  (intval($row['SEX']) != intval($row_police['XB'])+1)  || ((intval($row['RACE'])==2 && intval($row_police['MZ'])!= $row['RACE_DETAIL'])) || (intval($row_police['MZ'])==1 && $row['RACE']!=1)  )
				{

					//公安民族
					$police_mz=intval($row_police['MZ']);
					//公安局性别
					$police_xb=intval($row_police['XB'])+1;
					//要执行的sql
					if($police_mz==1){
						$execute_sql="update individual_core set Name='".$row_police['XM']."',sex='".$police_xb."', race='1' ,residence_address='$hj_address' where uuid='$uuid'";
					}else{
						$execute_sql="update individual_core set Name='".$row_police['XM']."',sex='".$police_xb."', race='2' ,race_detail=$police_mz,residence_address='$hj_address' where uuid='$uuid'";
					}
					//echo $execute_sql."<br/>";
					$statement_execute_yaan =oci_parse($link_yaan,$execute_sql);

					oci_execute($statement_execute_yaan);//执行更新操作
					$i++;


					//print_r($row);
					//print_r($row_police);
					//echo "<br/>";
					//if($i>10){

					///	echo $i;
					//	exit();
					//}
				}else{
					//$hj_sql="update individual_core set residence_address='$hj_address' where uuid='$uuid'";

					//$statement_hj_yaan =oci_parse($link_yaan,$hj_sql);

					//oci_execute($statement_hj_yaan);//执行更新操作
					//echo $hj_sql;
					//echo "<br/>";
					//}
				}
				

			}
			oci_free_statement($statement_police);

			

		}
		oci_free_statement($statement_yaan);
		echo $i;
	}
	/**
	 * 读取身份证照片
	 *
	 */
	public function picAction(){

		//设置php运行时间
		set_time_limit(0);
		header('Content-Type: text/html; charset=utf-8');

		//连接雅安系统数据库
		$link_yaan=oci_pconnect('yaanchis', 'yaanchis','172.16.11.251:1521/orcl','utf8') or exit("yaan kao");
		//连接公安系统数据库
		$link_police=oci_pconnect('hz2004', 'hz2004','172.16.11.246:1521/orcl','UTF8') or exit("police kao");

		$pic_path=__SITEROOT.'upload/';
		//检索出雅安系统中身份证存在的数据
		$sql_yaan="SELECT
                        uuid,
						identity_number,
						name,
						sex,
						race,
						race_detail,
						residence_address
					FROM
						individual_core
					WHERE
						identity_number IS NOT NULL
					OR identity_number <> ''";
		$statement_yaan =oci_parse($link_yaan,$sql_yaan);
		oci_execute($statement_yaan);
		$i=0;
		while ($row = oci_fetch_array ($statement_yaan,OCI_ASSOC) ) {
			$identity_number=$row['IDENTITY_NUMBER'];//身份证号
			$uuid=$row['UUID'];//个人id

			//print_r($row);
			//exit();
			$sql_police="SELECT
							HJXX_RYZPXXB.ZP as ZP
						FROM
							HJXX_CZRKJBXXB, HJXX_RYZPXXB 
						WHERE
						    hjxx_czrkjbxxb.GMSFHM=HJXX_RYZPXXB.GMSFHM 
						    AND
							hjxx_czrkjbxxb.GMSFHM = '$identity_number'";
			$statement_police =oci_parse($link_police,$sql_police);
			oci_execute($statement_police);
			while ($row_police = oci_fetch_array ($statement_police,OCI_ASSOC) ) {



				$zp=$row_police['ZP'];//照片
				$pic_name=$pic_path.$uuid.'.gif';
				if(!file_exists($pic_name)){
					$fp=fopen($pic_name,'x');
					fwrite($fp,$zp);
					fclose($fp);
					$i++;
				}

			}
			oci_free_statement($statement_police);

			

		}
		echo  $i;
		oci_free_statement($statement_yaan);

	}
	/**
	 * 读取身份证照片
	 *
	 */
	public function pictotalAction(){

		//设置php运行时间
		set_time_limit(0);
		header('Content-Type: text/html; charset=utf-8');

		//连接雅安系统数据库
		$link_yaan=oci_pconnect('yaanchis', 'yaanchis','172.16.11.251:1521/orcl','utf8') or exit("yaan kao");
		//连接公安系统数据库
		$link_police=oci_pconnect('hz2004', 'hz2004','172.16.11.246:1521/orcl','UTF8') or exit("police kao");

		$pic_path=__SITEROOT.'upload/';
		//检索出雅安系统中身份证存在的数据
		$sql_yaan="SELECT
                        uuid,
						identity_number,
						name,
						sex,
						race,
						race_detail,
						residence_address
					FROM
						individual_core
					WHERE
						identity_number IS NOT NULL
					OR identity_number <> ''";
		$statement_yaan =oci_parse($link_yaan,$sql_yaan);
		oci_execute($statement_yaan);
		$i=0;
		while ($row = oci_fetch_array ($statement_yaan,OCI_ASSOC) ) {
			$identity_number=$row['IDENTITY_NUMBER'];//身份证号
			$uuid=$row['UUID'];//个人id

			//print_r($row);
			//exit();
			$sql_police="SELECT
							*
						FROM
							HJXX_CZRKJBXXB 
						WHERE						    
							hjxx_czrkjbxxb.GMSFHM = '$identity_number'";
			$statement_police =oci_parse($link_police,$sql_police);
			oci_execute($statement_police);
			while ($row_police = oci_fetch_array ($statement_police,OCI_ASSOC) ) {
				$i++;


			}
			oci_free_statement($statement_police);

			

		}
		echo  $i;
		oci_free_statement($statement_yaan);

	}
	/**
	 * 修改家庭档案房主姓名
	 *
	 */
	public function updatefamilynameAction(){
		//设置php运行时间
		set_time_limit(0);
		header('Content-Type: text/html; charset=utf-8');

		//连接雅安系统数据库
		$link_yaan=oci_pconnect('yaanchis', 'yaanchis','172.16.11.251:1521/orcl','utf8') or exit("yaan kao");
		//取家庭档案在的房主名和个人档案号
		$sql="SELECT
	HOUSEHOLDER_ID,
	HOUSEHOLDER_NAME
FROM
	FAMILY_ARCHIVE
WHERE
	EXISTS (
		SELECT
			NAME,
			FAMILY_NUMBER
		FROM
			INDIVIDUAL_CORE
		WHERE
			RELATION_HOLDER = '1'
		AND RESIDENCE_ADDRESS LIKE '四川省%'
		AND FAMILY_ARCHIVE.FAMILY_NUMBER = INDIVIDUAL_CORE.FAMILY_NUMBER
	)";
		$statement_yaan =oci_parse($link_yaan,$sql);
		oci_execute($statement_yaan);
		$i=0;
		while ($row = oci_fetch_array ($statement_yaan,OCI_ASSOC) ) {
			$uuid=$row['HOUSEHOLDER_ID'];//个人id号
			$name=$row['HOUSEHOLDER_NAME'];//户主名
			$individual_sql="SELECT NAME FROM INDIVIDUAL_CORE WHERE UUID='$uuid'";
			$statement_individual =oci_parse($link_yaan,$individual_sql);
			oci_execute($statement_individual);
			while ($row_individual = oci_fetch_array ($statement_individual,OCI_ASSOC) ) {
				 if($row_individual['NAME']!=$name){
				 	//更新家庭档案姓名
				 	$update_family_sql="update FAMILY_ARCHIVE set HOUSEHOLDER_NAME='".$row_individual['NAME']."' where FAMILY_ARCHIVE.HOUSEHOLDER_ID='$uuid'";
				 	echo $update_family_sql;
					//oci_execute(oci_parse($link_yaan,$update_family_sql));
				 }
			}
			oci_free_statement($statement_individual);
			
		}
		oci_free_statement($statement_yaan);
	}

	// 全角半角转
	public function make_semiangle($str)
	{
		$arr = array('０' => '0', '１' => '1', '２' => '2', '３' => '3', '４' => '4',
		'５' => '5', '６' => '6', '７' => '7', '８' => '8', '９' => '9',
		'Ａ' => 'A', 'Ｂ' => 'B', 'Ｃ' => 'C', 'Ｄ' => 'D', 'Ｅ' => 'E',
		'Ｆ' => 'F', 'Ｇ' => 'G', 'Ｈ' => 'H', 'Ｉ' => 'I', 'Ｊ' => 'J',
		'Ｋ' => 'K', 'Ｌ' => 'L', 'Ｍ' => 'M', 'Ｎ' => 'N', 'Ｏ' => 'O',
		'Ｐ' => 'P', 'Ｑ' => 'Q', 'Ｒ' => 'R', 'Ｓ' => 'S', 'Ｔ' => 'T',
		'Ｕ' => 'U', 'Ｖ' => 'V', 'Ｗ' => 'W', 'Ｘ' => 'X', 'Ｙ' => 'Y',
		'Ｚ' => 'Z', 'ａ' => 'a', 'ｂ' => 'b', 'ｃ' => 'c', 'ｄ' => 'd',
		'ｅ' => 'e', 'ｆ' => 'f', 'ｇ' => 'g', 'ｈ' => 'h', 'ｉ' => 'i',
		'ｊ' => 'j', 'ｋ' => 'k', 'ｌ' => 'l', 'ｍ' => 'm', 'ｎ' => 'n',
		'ｏ' => 'o', 'ｐ' => 'p', 'ｑ' => 'q', 'ｒ' => 'r', 'ｓ' => 's',
		'ｔ' => 't', 'ｕ' => 'u', 'ｖ' => 'v', 'ｗ' => 'w', 'ｘ' => 'x',
		'ｙ' => 'y', 'ｚ' => 'z',
		'（' => '(', '）' => ')', '〔' => '[', '〕' => ']', '【' => '[',
		'】' => ']', '〖' => '[', '〗' => ']', '“' => '[', '”' => ']',
		'‘' => '[', '’' => ']', '｛' => '{', '｝' => '}', '《' => '<',
		'》' => '>',
		'％' => '%', '＋' => '+', '—' => '-', '－' => '-', '～' => '-',
		'：' => ':', '。' => '.', '、' => ',', '，' => '.', '、' => '.',
		'；' => ',', '？' => '?', '！' => '!', '…' => '-', '‖' => '|',
		'”' => '"', '’' => '`', '‘' => '`', '｜' => '|', '〃' => '"',
		'　' => ' ','＄'=>'$','＠'=>'@','＃'=>'#','＾'=>'^','＆'=>'&','＊'=>'*',
		'＂'=>'"');

		return strtr($str, $arr);
	}



}
