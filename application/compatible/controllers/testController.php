<?php
/**
 * 测试框架兼容性
 * @author www.phpchengdu.com
 * http://localhost:8088/compatible/test/test/name/mike
 *
 */
class compatible_testController extends controller {
	public function test_updateAction(){
		require_once(__SITEROOT.'library/Models/student.php');
		$student=new Tstudent();
		echo '<pre>更新前<br />';
		var_dump($student);
		echo '</pre>';
		$student->whereAdd("name='399'");
		$student->uuid='11';
		$student->update();
		//var_dump($student);
		echo '<pre>更新后<br />';
		var_dump($student);
		echo '</pre>';			
		echo "<br />";
		echo '$student->uuid'.$student->uuid;
		
	}

	
	public function speed4Action(){
		$s=microtime(true);
		require_once(__SITEROOT.'library/Models/student.php');
		$obj=new Tstudent();
		$obj->test_property='dddddddddddddddddddddd';
		for($i=0;$i<=5000;$i++){
			$var=get_object_vars($obj);
		}
		var_dump($var);
		echo "<br>操作程序执行时间";
		$e=microtime(true);
		echo round(($e-$s),4);
		
		
	}

	public function speed2Action(){
		$s=microtime(true);
		for($i=0;$i<=5000;$i++){
			require('config/oracleConfig1.php');
			//$host[$i]=$databaseConfig[1]['host'];
		}
		$e=microtime(true);
		if(1){
			//__DEBUG的定义在config.php中
			echo "<br>ini配置文件操作程序执行时间";
			echo round(($e-$s),4);
		}
		$s=microtime(true);
		for($i=0;$i<=5000;$i++){
			//require('config/db_config.xml');
			$xml_file[$i]=file_get_contents('config/db_config.xml');

			//$xml[$i]=new SimpleXMLElement($xml_file[$i]);
			//$host=$xml[$i]->host;
			//echo $host;
		}
		$e=microtime(true);
		if(1){
			//__DEBUG的定义在config.php中
			echo "<br>xml配置文件操作程序执行时间";
			echo round(($e-$s),4);
		}

	}

	/**
	 * 测试同一对象连接不同数据库服务器
	 * $mult1=new Tmult(1);参数１或是空表示连接第一台数据库服务器
	 * $mult2=new Tmult(2);参数２及以上表示连接第二台及更多数据库服务
	 * 这样实现了在同一方法下访问不同数据库服务器的功能
	 *
	 */
	public function test_multAction(){
		require_once __SITEROOT."library/Models/mult.php";
		$mult1=new Tmult();
		//或写成$mult1=new Tmult(1);
		$mult1->find(true);
		echo $mult1->name;
		$mult2=new Tmult(2);
		$mult2->name=$mult1->name;
		$mult2->insert();
	}
	public function insert_studentAction(){
		set_time_limit(0);
		require_once(__SITEROOT.'library/Models/student.php');
		require_once(__SITEROOT.'library/Models/score1.php');
		require_once(__SITEROOT.'library/Models/score2.php');
		$student=new Tstudent();
		$score1=new Tscore1();
		$score2=new Tscore2();
		/*		for($i=100;$i<=10000;$i++){
		$student->name='stu_'.$i;
		$student->id=$student->uuid=$i;
		$student->insert();
		$score1->uuid=$score1->id=$i;
		$score1->computer=rand(0,100);
		$score1->insert();
		}*/
		for($i=10001;$i<=1000000;$i++){
			$student->name='stu_'.$i;
			$student->id=$student->uuid=$i;
			$student->insert();
			$score1->uuid=$score1->id=$i;
			$score1->computer=rand(0,100);
			$score1->insert();
		}
	}
	public function speedAction(){
		require_once(__SITEROOT.'library/Models/student.php');
		require_once(__SITEROOT.'library/Models/score1.php');
		require_once(__SITEROOT.'library/Models/score2.php');
		echo "<br><b>演示一对一多表关联的统计</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$score=new Tscore1();
		//$student->query('set names utf8');
		//myMVC的标准方法
		$student->joinAdd('inner',$student,$score,'id','id');
		//获取数据
		//$student->selectAdd("count(name) as number");出错，number为关键字
		$student->selectAdd("count(name) as number_of_student");
		$score->selectAdd("sum(computer) as computer_score");
		$student->debugLevel(9);
		$student->find();
		//$student->debugLevel(0);
		echo "学生人数　计算机总成绩<br>";
		while ($student->fetch()){
			echo $student->number_of_student."&nbsp;";
			echo $score->computer_score."&nbsp;";
		}
		echo "<br><b>演示一对一多表关联的统计2:分组统计</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$score=new Tscore1();
		//$student->query('set names utf8');
		//myMVC的标准方法
		$student->joinAdd('inner',$student,$score,'id','id');
		//获取数据
		//$student->selectAdd("count(name) as number");出错，number为关键字
		$student->selectAdd("count(name) as number_of_student,gender");
		$score->selectAdd("sum(computer) as computer_score");
		$student->groupby('gender');
		$student->debugLevel(9);
		$student->find();
		//$student->debugLevel(0);
		echo "性别　学生人数　计算机总成绩<br>";
		while ($student->fetch()){
			echo $student->gender;
			echo $student->number_of_student."&nbsp;";
			echo $score->computer_score."&nbsp;";
			echo "<br />";
		}
	}

	public function insertAction(){
		/*挂号表（TB_HIS_MZ_Reg）
		诊疗收费表（TB_HIS_MZ_Charge）
		患者信息表(TB_YL_Patient_Information)
		门诊就诊记录表(TB_YL_MZ_Medical_Record)*
		门诊处方明细表(TB_CIS_Prescription_Detail)*
		住院就诊记录表(TB_YL_ZY_Medical_Record)
		住院医嘱明细表(TB_CIS_DrAdvice_Detail)
		住院病案首页主体表(TB_CIS_Main)
		手术明细表(TB_Operation_Detail)
		出院小结表(TB_CIS_LeaveHospital_Summary)
		体检明细表(TB_YL_TJMX)*/
		//患者信息表(TB_YL_Patient_Information)
		require_once __SITEROOT."library/Models/tb_yl_patient_information.php";
		//门诊就诊记录表
		require_once __SITEROOT."library/Models/tb_yl_mz_medical_record.php";
		//门诊处方明细表
		require_once __SITEROOT."library/Models/tb_cis_prescription_detail.php";
		//住院就诊记录表
		require_once __SITEROOT."library/Models/tb_yl_zy_medical_record.php";
		//住院病案首页主体表
		require_once __SITEROOT."library/Models/tb_cis_main.php";
		//手术明细表
		require_once __SITEROOT."library/Models/tb_operation_detail.php";
		//体检明细表
		require_once __SITEROOT."library/Models/tb_yl_tjmx.php";

		$table=new Ttb_yl_patient_information(2);
		$table->yljgdm='00887943-1';

		$table->kh='511082199901010001';
		$table->klx='身份证号';
		$table->hzlx='1';
		$table->xgbz='1';
		$table->fkdq='511082';

		$table->identity_number='511082199901010001';
		$table->xm='石棉患者1';
		$table->xb='1';

		$table->jzdz='石棉';
		$table->insert();

		$table=new Ttb_yl_patient_information(2);
		$table->yljgdm='00887943-1';
		$table->kh='511082199901010002';
		$table->klx='身份证号';
		$table->hzlx='1';
		$table->xgbz='1';
		$table->fkdq='511082';
		$table->identity_number='511082199901010002';
		$table->xm='石棉患者2';
		$table->xb='1';
		$table->jzdz='石棉';
		$table->insert();
		$table=new Ttb_yl_patient_information(2);
		$table->yljgdm='00887943-2';
		$table->kh='511082199901010003';
		$table->klx='身份证号';
		$table->hzlx='1';
		$table->xgbz='1';
		$table->fkdq='511082';
		$table->identity_number='511082199901010003';
		$table->xm='荥经患者1';
		$table->xb='1';
		$table->jzdz='荥经';
		$table->insert();
		$table=new Ttb_yl_patient_information(2);
		$table->yljgdm='00887943-2';
		$table->kh='511082199901010004';
		$table->klx='身份证号';
		$table->hzlx='1';
		$table->xgbz='1';
		$table->fkdq='511082';
		$table->identity_number='511082199901010004';
		$table->xm='荥经患者2';
		$table->xb='1';
		$table->jzdz='荥经';
		$table->insert();
		//门诊就诊记录表
		$table=new Ttb_yl_mz_medical_record(2);
		$table->yljgdm='00887943-1';
		$table->jzlsh='0001';
		$table->kh='511082199901010002';
		$table->klx='身份证号';
		$table->hzxm='石棉患者1';
		$table->hzsx='1';
		$table->jzlx='100';
		$table->jzksbm='01';
		$table->jzksmc='外科';
		$table->jzksrq='20110101';
		$table->zzysgh='001';
		$table->zzysxm='石棉医生甲';
		$table->jzzdbm='A17.804+';
		$table->jzzdmc='结核性脑炎';
		$table->jzzdsm='此人有病';
		$table->zs='不安逸';
		$table->zzms='天天都吃不饱';
		$table->xgbz='1';
		//$table->csjph='dd';
		$table->insert();

		//$table->


	}
	public function test_arrayAction(){
		$array=array('mike','rose','tom');
		echo $array[0];
		array_shift($array);
		echo $array[0];
		array_shift($array);
		echo $array[0];
		array_shift($array);
		echo $array[0];
		array_shift($array);

	}
	/**
	 * 测试红缓存
	 *
	 */
	public function test_cacheAction(){
		$conn=oci_connect('yaanchis','yaanchis_2011','182.132.144.195:1521/orcl','UTF8');
		$s=microtime(true);
		$queryString="select count(*) as counter from clinical_history left join individual_core on clinical_history.id=individual_core.uuid where (disease_date<1317571200) and (disease_code=2) and (disease_state=1) and (individual_core.individual_core.region_path like '0,1,2,5,72%')";
		$queryString="select * from student where name='1'";
		$queryString="select * from student";
		$stid = oci_parse($conn, $queryString);
		//echo microtime(true)-$s." 1<br>";
		oci_execute($stid);
		//var_dump($row=oci_fetch_assoc($stid));
		$data_array=array();
		while (true){
			$row=oci_fetch_assoc($stid);
			$data_array[]=$row;

			if(!$row){
				break;
			}
			echo $row['NAME'];
			echo "<br />";
		}
		var_dump($row);
		exit();
		//echo microtime(true)-$s." 2<br>";
		/*		if(!file_exists('test.php')){
		$stid = oci_parse($conn, $queryString);
		oci_execute($stid);
		file_put_contents('test.php',serialize($stid));
		}else {
		$temp=file_get_contents('test.php');
		unserialize($temp);
		}


		var_dump($stid);*/

		$row = oci_fetch_array($stid, OCI_ASSOC);
		echo microtime(true)-$s." 3<br>";

		echo $row['COUNTER'];
		echo "<br />";
		echo "取一条记录输出用时<br />";
		$e=microtime(true);
		echo $e-$s."<br>";


		//var_dump($row);
		//echo $row['RESOURCE_ZH_NAME'];
		//echo $row['b_resource_zh_name'];
		//echo $row['B_RESOURCE_ZH_NAME'];
		while ($row = oci_fetch_array($stid, OCI_ASSOC)){
			//echo $row['B_RESOURCE_ZH_NAME'];
			//echo "<br />";
		}
		echo "取多条记录输出用时<br />";
		$e=microtime(true);
		echo $e-$s."<br>";

	}


	public function testAction(){

		//$this->view->baseUrl = $this->_request->getBaseUrl();
		$this->view->basePath = $this->_request->getBasePath();
		//echo __SITEROOT;
		echo "<br />";
		echo "in test test<br />";
		//echo $this->_request->getParam('name','noname');
		//用assign方式
		$this->view->assign('name',$this->_request->getParam('name','noname'));
		//用直接赋值方式
		$this->view->age=$this->_request->getParam('age','18');
		//显式调用
		$this->view->display('test.html');
	}
	/**
	 * 测试纯框架
	 * http://localhost:9004/compatible/test/test2
	 */	
	public function test1Action(){
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/individual_archive.php";
		$individual_core 		= new Tindividual_core();
		$individual_archive		= new Tindividual_archive();
		$individual_core->debugLevel(2);
		$individual_core->joinAdd('left',$individual_core,$individual_archive,'uuid','tom');
		
		$individual_core->whereAdd('id>0');
		echo $individual_core->count();
	}
	/**
	 * 测试手工sql
	 *
	 */
	public function test2Action(){
		$s=microtime(true);
		echo "测试手工sql<br />";

		//$conn=oci_connect('tom','oracle','172.15.208.20:1521/yaanchis','UTF8');
		$conn=oci_connect('luowei','luowei','127.0.0.1:1521/orcl','UTF8');
		$s=microtime(true);
		$queryString='select * from resources';
		$queryString='select role_resource.uuid as a_uuid,role_resource.role_id as a_role_id,role_resource.resource_id as a_resource_id,role_resource.read as a_read,role_resource.write as a_write,role_resource.created as a_created,role_resource.updated as a_updated,resources.resource_id as b_resource_id,resources.resource_en_name as b_resource_en_name,resources.resource_zh_name as b_resource_zh_name,resources.created as b_created,resources.updated as b_updated from role_resource inner join resources on role_resource.resource_id=resources.resource_id';
		$stid = oci_parse($conn, $queryString);
		oci_execute($stid);
		$row = oci_fetch_array($stid, OCI_ASSOC);
		echo "取一条记录输出用时<br />";
		$e=microtime(true);
		echo $e-$s."<br>";


		//var_dump($row);
		//echo $row['RESOURCE_ZH_NAME'];
		//echo $row['b_resource_zh_name'];
		//echo $row['B_RESOURCE_ZH_NAME'];
		while ($row = oci_fetch_array($stid, OCI_ASSOC)){
			//echo $row['B_RESOURCE_ZH_NAME'];
			//echo "<br />";
		}
		echo "取多条记录输出用时<br />";
		$e=microtime(true);
		echo $e-$s."<br>";

	}
	/**
	 * 测试面向对象数据
	 *
	 */
	public function test3Action(){
		require_once(__SITEROOT.'library/Models/resources.php');
		$resource=new Tresources();
		$resource->find();
		//$resource->fetch();
		while ($resource->fetch()){
			echo $resource->resource_zh_name;
			echo "<br />";
		}

	}
	public function test4Action(){
		$s=microtime(true);
		echo "测试面向对象sql<br />";

		require_once(__SITEROOT.'library/Models/role_resource.php');//角色对应的资源权限
		require_once(__SITEROOT.'library/Models/role_table.php');//角色表
		require_once(__SITEROOT.'library/Models/resources.php');//资源表



		$role_resource=new Trole_resource();
		$resource_table=new Tresources();
		$role_resource->joinAdd('inner',$role_resource,$resource_table,'resource_id','resource_id');
		//$role_resource->debugLevel(9);
		$role_resource->find();
		$role_resource->fetch();
		echo "取一条记录输出用时<br />";
		$e=microtime(true);
		echo $e-$s."<br>";

		while ($role_resource->fetch()) {
			$this->resource_arr[$resource_table->resource_id]=$resource_table->resource_en_name;
			echo $resource_table->resource_zh_name;
			echo "<br>";
			//$e=microtime(true);
			//echo $e-$s.__LINE__."<br>";
		}
		echo "取多条记录输出用时<br />";
		$e=microtime(true);
		echo $e-$s."<br>";
	}
}