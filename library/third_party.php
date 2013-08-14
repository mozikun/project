<?php
/**
 * 更新表时更新到第三方银海数据库
 * 具体字段见svn/doc/雅安市居民健康卡数据采集方案
 *
 * @param unknown_type $table_name
 * @param unknown_type $array=array('field=value',...)
 * @param int token=1/2 插入/更新 
 * @param string $where 更新条件
 * @return string 
 */
function third_party($table_name,$array,$token=1,$where=''){

	//require __SITEROOT . '/library/data_arr/arrdata.php';
	$insert_field_string='';//插入数据的列
	$insert_field_values='';//插入的值
	$update_string='';//修改的语句串
	switch ($table_name){

		case 'individual_core':
			//$t_jk_card=new Tt_jk_card(1);
			foreach ($array as $field_value){
				$tmp_array=explode('=',$field_value);
				$field_name=$tmp_array[0];//字段名
				$field_val=$tmp_array[1];//字段对应的值
				switch ($field_name){
					case 'uuid':
						//$uuid=$field_val;//记录uuid
						if($token==1){
							//插入
							//$t_jk_card->aac001=$field_val;
							$insert_field_string.="aac001,";
							$insert_field_values.="$field_val,";

						}
						//判断照片
						if (file_exists(__SITEROOT . "upload/" . $field_val . ".gif"))
						{
							//$t_jk_card->zpdz=$field_val . ".gif";
							$insert_field_string.="zpdz,";
							$insert_field_values.="$field_val,";
							$update_string.="zpdz=$field_val,";
							// $t_jk_card->zpgxdt=time();
							$time=time();
							$insert_field_string.="zpgxdt,";
							$insert_field_values.="$time,";
							$update_string.="zpgxdt=$time,";

						}
						break;
					case 'identity_number':
						//$t_jk_card->aac002=$field_val;
						$insert_field_string.="aac002,";
						$insert_field_values.="$field_val,";
						$update_string.="aac002=$field_val,";
						break;
					case 'name':
						//$t_jk_card->aac003=$field_val;
						$insert_field_string.="aac003,";
						$insert_field_values.="$field_val,";
						$update_string.="aac003=$field_val,";
						break;
					case 'sex':

						//$sex_code=array_search_for_code($field_val,$sex);
						//print_r($sex_code);
						//print_r($field_val);
						//var_dump($sex_code);
						$insert_field_string.="aac004,";
						//$insert_field_values.="$sex_code,";
						$insert_field_values.="$field_val,";
						$update_string.="aac004=$field_val,";
						break;
					case 'race':
						if($field_val==1){
							//$t_jk_card->aac005=array_search_for_code($field_val, $race);
							//$race_code=array_search_for_code($field_val, $race);
							$insert_field_string.="aac005,";
							$insert_field_values.="$field_val,";
							$update_string.="aac005=$field_val,";
						}else{
							//$t_jk_card->aac005=array_search_for_code($field_val, $races);
							//$race_code=array_search_for_code($field_val, $races);
							$insert_field_string.="aac005,";
							$insert_field_values.="$field_val,";
							$update_string.="aac005=$field_val,";
						}
						break;
					case 'date_of_birth':
						//$t_jk_card->aac006=$field_val;
						$insert_field_string.="aac006,";
						$insert_field_values.="$field_val,";
						$update_string.="aac006=$field_val,";
						break;
					case 'standard_code_1':
						//$t_jk_card->jkdah=$field_val;
						$insert_field_string.="jkdah,";
						$insert_field_values.="$field_val,";
						$update_string.="jkdah=$field_val,";
						//$t_jk_card->xzqw_id=$field_val;
						$insert_field_string.="xzqw_id,";
						$insert_field_values.="$field_val,";
						$update_string.="xzqw_id=$field_val,";
						break;

					case 'updated':
						//$t_jk_card->gkgxdt=$field_val;
						$insert_field_string.="gkgxdt,";
						$insert_field_values.="$field_val,";
						$update_string.="gkgxdt=$field_val,";
						//$t_jk_card->sjgxdt=$field_val;
						$insert_field_string.="sjgxdt,";
						$insert_field_values.="$field_val,";
						$update_string.="sjgxdt=$field_val,";
						break;

					case 'identity_type':
						//$t_jk_card->zjlb=$field_val;
						$insert_field_string.="zjlb,";
						$insert_field_values.="$field_val,";
						$update_string.="zjlb=$field_val,";
						break;
					case 'identity_number':
						//$t_jk_card->zjhm=$field_val;
						$insert_field_string.="zjhm,";
						$insert_field_values.="$field_val,";
						$update_string.="zjhm=$field_val,";
						break;

					case 'phone_number':
						//$t_jk_card->brdh_1=$field_val;
						$insert_field_string.="brdh_1,";
						$insert_field_values.="$field_val,";
						$update_string.="brdh_1=$field_val,";
						break;
					case 'residence_address':
						//$t_jk_card->dz_1=$field_val;
						$insert_field_string.="dz_1,";
						$insert_field_values.="$field_val,";
						$update_string.="dz_1=$field_val,";
						break;
					case 'address':
						//$t_jk_card->dz_2=$field_val;
						$insert_field_string.="dz_2,";
						$insert_field_values.="$field_val,";
						$update_string.="dz_2=$field_val,";
						break;
					case 'org_id':
						//$t_jk_card->yljg_id=$field_val;
						$insert_field_string.="yljg_id,";
						$insert_field_values.="$field_val,";
						$update_string.="yljg_id=$field_val,";
						break;
						


				}
			}

	    if($token==1){
	    	break;
	    }

		case 'individual_archive':

			foreach ($array as $field_value){
				$tmp_array=explode('=',$field_value);
				$field_name=$tmp_array[0];//字段名
				$field_val=$tmp_array[1];//字段对应的值
				switch ($field_name){
					case 'marriage':
						//$t_jk_card->aac017=array_search_for_code($field_val, $marriage);
						//$marriage_code=array_search_for_code($field_val, $marriage);
						$insert_field_string.="aac017,";
						$insert_field_values.="$field_val,";
						$update_string.="aac017='$field_val',";
						break;
					case 'occupation':
						//$t_jk_card->zydm=array_search_for_code($field_val, $occupation);
						//$occupation_code=array_search_for_code($field_val, $occupation);
						$insert_field_string.="zydm,";
						$insert_field_values.="$field_val,";
						$update_string.="zydm='$field_val',";
						break;
					case 'study_history':
						//$t_jk_card->aac011=array_search_for_code($field_val,$school_type);
						//$school_type_code=array_search_for_code($field_val,$school_type);
						$insert_field_string.="aac011,";
						$insert_field_values.="'$field_val',";
						$update_string.="aac011='$field_val',";
						break;
					case 'contact':
						//$t_jk_card->lxrxm_1=$field_val;
						$insert_field_string.="lxrxm_1,";
						$insert_field_values.="$field_val,";
						$update_string.="lxrxm_1=$field_val,";
						break;
					case 'contact_number':
						//$t_jk_card->lxrdh_1=$field_val;
						$insert_field_string.="lxrdh_1,";
						$insert_field_values.="$field_val,";
						$update_string.="lxrdh_1=$field_val,";
						break;
				}
			}
		case 'charge_style':
			foreach ($array as $field_value){
				$tmp_array=explode('=',$field_value);
				$field_name=$tmp_array[0];//字段名
				$field_val=$tmp_array[1];//字段对应的值
				switch ($field_name){
					case 'charge_style':

						for($i=1; $i<4;$i++)
						{
							
							$params='ylzffs_'.$i;
							//$t_jk_card->$params=array_search_for_code($field_val, $charge_style);
							//$params_code=array_search_for_code($field_val, $charge_style);
							$insert_field_string.="$params,";
							$insert_field_values.="$field_val,";
							$update_string.="$params='$field_val',";

						}
				}
			}
			
		case 'blood_type':
			foreach ($array as $field_value){
				$tmp_array=explode('=',$field_value);
				$field_name=$tmp_array[0];//字段名
				$field_val=$tmp_array[1];//字段对应的值
				switch ($field_name){
					case 'abo_bloodtype':
						//$t_jk_card->aboxxdm=array_search_for_code($field_val, $ABO_bloodtype);
						//$ABO_bloodtype_code=array_search_for_code($field_val, $ABO_bloodtype);
						$insert_field_string.="aboxxdm,";
						$insert_field_values.="$field_val,";
						$update_string.="aboxxdm='$field_val',";
						break;
					case 'rh_bloodtype':
						//$t_jk_card->rhxxdm=array_search_for_code($field_val, $RH_bloodtype);
						//$RH_bloodtype_code=array_search_for_code($field_val, $RH_bloodtype);
						$insert_field_string.="rhxxdm,";
						$insert_field_values.="$field_val,";
						$update_string.="rhxxdm='$field_val',";
						break;

				}
			}

		case 'allergy':
			foreach ($array as $field_value){
				$tmp_array=explode('=',$field_value);
				$field_name=$tmp_array[0];//字段名
				$field_val=$tmp_array[1];//字段对应的值
				switch ($field_name){
					case 'allergy_code':
						for($i=1;$i<5;$i++){
							$params='gmwmc_'.$i;
							//$t_jk_card->$params=@$allergy_history[array_search_for_code($field_val, $allergy_history)][1];
							$params_code=@$allergy_history[$field_val][1];
							$insert_field_string.="$params,";
							$insert_field_values.="$params_code,";
							$update_string.="$params='$params_code',";
							
						}
				}
			}

		case 'clinical_history':
			foreach ($array as $field_value){
				$tmp_array=explode('=',$field_value);
				$field_name=$tmp_array[0];//字段名
				$field_val=$tmp_array[1];//字段对应的值
				switch ($field_name){
					case 'disease_code':
						if($field_val=='2'){

						}
						if($field_val=='3'){
							//糖尿病
							//$t_jk_card->tlbbz=1;
							$insert_field_string.="tlbbz,";
							$insert_field_values.="1,";
							$update_string.="tlbbz=1,";
						}
						if($field_val=='8'){
							//神经病
							//$t_jk_card->jsbbz=1;
							$insert_field_string.="jsbbz,";
							$insert_field_values.="1,";
							$update_string.="jsbbz=1,";
						}
				}
			}



	}

	if($token==1){
	    if(!empty($insert_field_string) &&  !empty($insert_field_values)){
			return  "insert into t_jk_card(".rtrim($insert_field_string,',') .") values( ".rtrim($insert_field_values,',').")";
	    }else {
	    	return '';
	    }
	}else{
		if($update_string){
			preg_match("|i_.*\d|i",$where,$match);
			//print_r($match);
			$uuid=$match[0];

			if(strlen($uuid)>16){
				return  "update t_jk_card set  ".rtrim($update_string,",")." where aac001='$uuid'";
			}else{
				return '';
			}
		}else{
				return '';
		}

	}

}


/**
 * 在给定的$array数据字典数组中查找$var，并返回其非标准的代码集
 * @author 我好笨
 * @param string $var
 * @param array() $array
 */
function array_search_for_code($var,$array)
{
	$var=trim($var,'\'');
	if (!is_empty_for_mul($array))
	{
		foreach ($array as $k=>$v)
		{
			if (is_array($v) && in_array($var,$v))
			{
				return $k;
			}
		}

		return "";
	}
	else
	{
		
		return "";
	}
}
/**
 * @author 我好笨
 * 判定给定的值是否为空
 * @param $var string or array()
 */
function is_empty_for_mul($var)
{
	if (is_array($var))
	{
		foreach ($var as $value)
		{
			if (!is_empty_for_mul($value))
			{
				return false;
			}
		}
	}
	elseif (!empty($var))
	{
		return false;
	}
	return true;
}