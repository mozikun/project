<?php
/**
 * 本模块演示5dMVC DB层的具体用法
 * http://localhost:9004/compatible/dataDemo/test
 * @author www.phpchengdu.com 罗维
 *
 */
class compatible_dataDemoController extends controller {
	//不读取数据表的空动作
	public function list1Action(){
		echo "in list action";
	}
	//读取数据表的动作
	public function list2Action(){
		mysql_pconnect("localhost","root","123456");
		mysql_query("use student");
		mysql_query("set names 'utf8'");
		$queryString="select * from student";
		$rs=mysql_query($queryString);
		while ($row=mysql_fetch_array($rs)){
			//echo $row['name'];
			//echo "<br />";
		}
	}
	//面向对象方式的读取数据表的动作
	public function list3Action(){
		require_once(__SITEROOT.'model/student.php');
		//实例化一个表对象
		$student=new Tstudent();
		$student->query('set names utf8');
		//获取数据
		$student->find();
		while ($student->fetch()){
			//$smarty->assign('name',$student->name);
			echo $student->name."&nbsp;";
			//echo "<br />";
		}
	}


	/**
	 * 演示基于db_oracle的各种操作
	 * @www.phpchengdu.com
	 *
	 */
	public function testAction(){
		//phpinfo();
		//exit();
		/*
		分别测试mysql与oracle
		其中oracle 为1 mysql为3
		见oracleConfig.php配置文件
		*/
		$engine=1;
		$engine_name='oracle';
		$engine=1;
		$engine_name='mysql';
		//引入本页面中用到的表对象定义文件
		require_once(__SITEROOT.'library/Models/student.php');
		require_once(__SITEROOT.'library/Models/score1.php');
		require_once(__SITEROOT.'library/Models/score2.php');

		echo "<br /><b>演示直传SQL1-$engine_name</b><br />";
		$student=new Tstudent($engine);
		$student->query("select * from student inner join score1 on student.id=score1.id where computer>=60");
		//echo $student->count('*');
		while($student->fetch()){
			echo $student->name."&nbsp;";
			echo $student->computer."&nbsp;";
			echo "<br />";
		}

		echo "<br /><b>演示直传SQL2-$engine_name</b><br />";
		$student=new Tstudent();
		//select * from tb_his_zy_adm_reg left join (select * from tb_yl_zy_medical_record left join tb_yl_patient_information on (tb_yl_zy_medical_record.kh=tb_yl_patient_information.kh and tb_yl_zy_medical_record.klx=tb_yl_patient_information.klx))a on tb_his_zy_adm_reg.zyid=a.jzlsh
		$student->query("select * from student inner join(select * from score1 where computer>60) a on a.id=student.id");
		while($student->fetch($engine)){
			echo $student->name."&nbsp;";
			echo $student->computer."&nbsp;";
			echo "<br />";
		}
		echo "<br /><b>演示直传SQL3-$engine_name</b><br />";
		$student=new Tstudent();
		//select * from tb_his_zy_adm_reg left join (select * from tb_yl_zy_medical_record left join tb_yl_patient_information on (tb_yl_zy_medical_record.kh=tb_yl_patient_information.kh and tb_yl_zy_medical_record.klx=tb_yl_patient_information.klx))a on tb_his_zy_adm_reg.zyid=a.jzlsh
		$student->query("select student.name,score1.computer from student inner join score1 on student.id=score1.id where computer>=60");
		while($student->fetch($engine)){
			echo $student->name."&nbsp;";
			echo $student->computer."&nbsp;";
			echo "<br />";
		}

		echo "<br /><b>演示从表中读取所有数据-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		//获取数据
		$student->find();
		while ($student->fetch()){
			echo $student->name."&nbsp;";
			echo $student->class."&nbsp;";
			echo $student->gender."&nbsp;";
			echo "<br />";
		}
		echo "<br /><b>演示从表中读取男生数据-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		//选择运算
		$student->whereAdd("gender='男'");
		//获取数据
		$student->find();
		while ($student->fetch()){
			echo $student->name."&nbsp;";
			echo $student->class."&nbsp;";
			echo $student->gender."&nbsp;";
			echo "<br />";
		}


		echo "<br /><b>演示从表中读取一条记录-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		$student->whereAdd("id='1'");
		//$student->whereAdd("name='mike'");
		//获取数据
		//$student->debugLevel(9);
		//仅一条数据，在find的时候加true参数，会自动完成fetch动作
		$student->find(true);
		echo $student->id."&nbsp;";
		echo $student->name."&nbsp;";
		echo $student->class."&nbsp;";
		echo $student->gender."&nbsp;";
		echo "<br />";

		echo "<br /><b>演示从表中读取取前二条数据-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		//指定要获取数据的起始位置与数量
		$student->limit(0,2);
		//获取数据
		$student->find();
		while ($student->fetch()){
			echo $student->name."&nbsp;";
			echo $student->class."&nbsp;";
			echo $student->gender."&nbsp;";
			echo "<br />";
		}
		echo "<br /><b>演示统计表中的男生记录数-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		//获取数据
		$student->whereAdd("gender='男'");
		echo $student->count('*');
		echo "<br />";

		echo "<br /><b>演示从表中读取不重复的班级名称-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		$student->selectAdd("distinct class as distinct_class");
		//获取数据
		//$student->debugLevel(9);
		$student->find();
		while ($student->fetch()){
			echo $student->distinct_class."&nbsp;";
			echo "<br />";
		}



		echo "<br /><b>演示从表中读取不重复的班级与性别名称-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		$student->selectAdd("distinct class as distinct_class,gender as gender");
		//获取数据
		$student->find();
		while ($student->fetch()){
			echo $student->distinct_class."&nbsp;";
			echo $student->gender."&nbsp;";
			echo "<br />";
		}

		echo "<br /><b>演示从表中读取不重复的班级与性别名称,并按班级排序-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		$student->selectAdd("distinct class as distinct_class,gender as gender");
		//按班级排序
		$student->orderby("distinct_class");
		//获取数据
		$student->find();
		while ($student->fetch()){
			echo $student->distinct_class."&nbsp;";
			echo $student->gender."&nbsp;";
			echo "<br />";
		}


		echo "<br /><b>演示通过转义函数获取值，在select方法中，此功能取消，原因在于性能，可取出数据后，用php的相关函数去转换成所需要的结果</b><br />";
		//实例化一个表对象
		$student=new Tstudent();
		$student->escape('name','substr(name,1,2)');
		$student->debugLevel(9);
		//获取数据
		$student->find();
		while ($student->fetch()){
			echo $student->name."&nbsp;";
			echo "<br />";
		}

		echo "<br /><b>演示分组统计每班人数-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		$student->groupBy('class');
		$student->selectAdd("count(*) as classperson,class as class");
		//$student->debugLevel(9);
		$student->find();
		//$student->debugLevel(0);
		while ($student->fetch()){
			echo $student->class."&nbsp;";
			echo $student->classperson."&nbsp;";
			echo "<br />";
		}
		echo "<br /><b>演示分组统计每班人数，仅显示大于２个以上的班级-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		$student->orderby('class desc');
		$student->groupBy('class');
		$student->selectAdd("count(class) as classperson,class as class");
		//如果有字段名冲突，请加表名 student.classperson>2
		$student->having("count(class)>2");
		//$student->limit(2,3);
		$student->debugLevel(9);
		$student->find();
		//$student->debugLevel(0);
		while ($student->fetch()){
			echo $student->class."&nbsp;";
			echo $student->classperson."&nbsp;";
			echo "<br />";
		}
		echo "<br /><b>演示分组统计每班男生人数，仅显示大于２个以上的班级-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		$student->whereAdd("gender='男'");
		$student->orderby('class desc');
		$student->groupBy('class');
		$student->selectAdd("count(*) classperson,class as class");
		//如果出现字段名冲突，请加表名前缀如： student.classperson>2
		$student->having("count(*)>2");
		//$student->limit(2,3);
		//$student->debugLevel(9);
		$student->find();
		//$student->debugLevel(0);
		while ($student->fetch()){
			echo $student->class."&nbsp;";
			echo $student->classperson."&nbsp;";
			echo "<br />";
		}

		echo "<br /><b>演示一对一多表关联的数据读取-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		$score=new Tscore1($engine);
		//$student->query('set names utf8');
		//myMVC的标准方法
		$student->joinAdd('inner',$student,$score,'id','id');
		//兼容pearDB的方法
		//$student->joinAdd(array('id','score1:id'));

		$student->whereAdd("score1.computer>90");
		//不起作用，为什么？没有实现按从表数据过滤的操作
		//$score->whereAdd("score1.computer>90");
		$student->debugLevel(9);
		$student->find();
		//获取数据
		//$student->debugLevel(0);
		while ($student->fetch()){
			echo $student->name."&nbsp;";
			echo $student->class."&nbsp;";
			echo $student->gender."&nbsp;";
			echo $score->english."&nbsp;";
			echo $score->chinese."&nbsp;";
			echo $score->computer."&nbsp;";
			echo "<br />";
		}
		echo "<br /><b>演示一对一多表关联的数据读取二，多个字段关联-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		$score=new Tscore1($engine);
		//$student->query('set names utf8');
		//myMVC的标准方法
		$student->joinAdd('inner',$student,$score,'id','id');
		$student->joinAdd('inner',$student,$score,'uuid','uuid');
		//获取数据
		$student->debugLevel(9);
		$student->find();
		//$student->debugLevel(0);
		while ($student->fetch()){
			echo $student->name."&nbsp;";
			echo $student->class."&nbsp;";
			echo $student->gender."&nbsp;";
			echo $score->english."&nbsp;";
			echo $score->chinese."&nbsp;";
			echo $score->computer."&nbsp;";
			echo "<br />";
		}

		echo "<br /><b>演示一对一多表关联的统计-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		$score=new Tscore1($engine);
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
		echo "学生人数　计算机总成绩<br />";
		while ($student->fetch()){
			echo $student->number_of_student."&nbsp;";
			echo $score->computer_score."&nbsp;";
		}
		echo "<br /><b>演示一对一多表关联的统计2:分组统计-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		$student->count('*');
		$score=new Tscore1($engine);
		$score->count('*');
		//$student->query('set names utf8');
		//myMVC的标准方法
		$student->joinAdd('inner',$student,$score,'id','id');
		//获取数据
		//$student->selectAdd("count(name) as number");出错，number为关键字
		$student->selectAdd("count(name) as number_of_student,gender");
		//$score->selectAdd("sum(computer) as computer_score");
		$student->groupby('gender');
		$student->debugLevel(9);
		$student->find();
		//$student->debugLevel(0);
		echo "性别　学生人数　计算机总成绩<br />";
		while ($student->fetch()){
			echo $student->gender;
			echo $student->number_of_student."&nbsp;";
			echo $score->computer_score."&nbsp;";
			echo "<br />";
		}
		//多表关联的设计
		/*
		$a=new ta;
		$b=new tb;
		$c=new tc;
		$b->joinAdd('inner',$b,$c,'id','id');
		$a->joinAdd('inner',$a,$b,'id','id');
		//select * from a inner join b on a.id=b.id

		问题:要显示个人基本信息列表，采用方案一与方案二在实际工作中，谁优

		个人基本信息表:base_info{id,name,id_gender,id_race,id_region}
		方案一：
		性别代码表 gender{id_gender,gender_hz,gender_py,gender_std_code}
		民族代码表 race{id_race,race_hz,race_py,race_std_code}
		可直接用selct join完成

		方案二：
		单级分类代码表 category(id,category,item_hz,item_py,item_std_code)//category表示分类，如性别，则分类名为gender，民族为race
		直接无法查询，我们现在用的是生成数组缓存的方式

		就诊记录表
		疾病分类代码表
		*/



		echo "<br /><b>演示subselect-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		$score=new Tscore1($engine);
		$student->whereAdd("name='李7'");
		$student->selectAdd('id as id');
		$score->debugLevel(9);
		//$score->whereAdd($score->subSelect('in',$student,'id'));
		$score->whereAdd($score->subSelect('in',$student,'id'));

		$score->find();

		while ($score->fetch()){
			echo $score->computer."&nbsp;";
			echo "<br />";
		}

		echo "<br /><b>演示别名字段数据读取-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		$student->selectAdd("name as new_name",'add');
		$student->selectAdd("class as new_class,gender as new_gender",'add');
		//$student->selectAdd("class as newClass");
		//$student->selectAdd("gender as newGender");

		$score=new Tscore1($engine);
		$score->selectAdd("computer as jsj,english as yy");
		$score->selectAdd("chinese as yw");
		//myMVC的标准方法
		$student->joinAdd('inner',$student,$score,'id','id');
		//获取数据
		//$student->debugLevel(9);
		$student->select();
		$student->debugLevel(0);
		echo "name as newName";
		echo "<br />";
		while ($student->fetch()){
			echo $student->new_name."&nbsp;";
			echo $student->name."&nbsp;";
			echo $student->new_class."&nbsp;";
			echo $student->new_gender."&nbsp;";
			echo $score->yy."&nbsp;";
			echo $score->yw."&nbsp;";
			echo $score->jsj."&nbsp;";
			//echo '$student->jsj'.$student->jsj."&nbsp;";

			echo "<br />";
		}
		echo "<br /><b>演示一对一加一对多三表关联情况下的多表关联的数据读取-$engine_name</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		$student->whereAdd("student.class='三班'");
		$score1=new Tscore1($engine);
		//$score1->whereAdd("score1.english>60");
		//$score1->whereAdd("score1.computer>60");
		//$score1->whereAdd("score1.computer>60 or score1.english>60");
		$score2=new Tscore2($engine);
		//myMVC的标准方法
		$student->joinAdd('inner',$student,$score1,'id','id');
		$student->joinAdd('inner',$student,$score2,'id','id');
		$student->debug(1);
		$student->find();
		while ($student->fetch()){
			echo $student->name."&nbsp;";
			echo $student->class."&nbsp;";
			echo $student->gender."&nbsp;";
			echo $score1->english."&nbsp;";
			echo $score1->chinese."&nbsp;";
			echo $score1->computer."&nbsp;";
			echo $score2->course."&nbsp;";
			echo $score2->score;
			echo "<br />";
		}
		echo "<br /><b>演示更新记录方法一:使用whereAdd</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		$student->whereAdd("uuid='4'");
		$student->name='新人44';
		//修改记录
		$student->debugLevel(9);
		$student->update();
		echo "<br />";
		echo "<br /><b>演示通过转义函数处理值</b><br />";
		//实例化一个表对象
		$student=new Tstudent($engine);
		$student->name=$student->escape('name',"concat(rtrim(name,' '),gender)");
		$student->whereAdd("uuid='4'");
		$student->debugLevel(9);
		$student->update();
		echo "<br /><b>演示新增</b><br />";
		$student=new Tstudent($engine);
		$student->uuid=$student->id='999';
		$student->name='我是新增的测试人';
		$student->insert();
		//显示新增的数据
		$student=new Tstudent($engine);
		$student->whereAdd("id='999'");
		$student->find(true);
		echo $student->name;
		echo "<br /><b>演示删除</b><br />";
		$student=new Tstudent($engine);
		$student->whereAdd("id='999'");
		$student->delete();
		$student=new Tstudent($engine);
		$student->whereAdd("id='999'");
		$student->find(true);
		echo '已被删除'.$student->name;
	}
	/**
	 * 测试同一对象连接不同数据库服务器
	 * $mult1=new Tmult(1);参数１或是空表示连接第一台数据库服务器
	 * $mult2=new Tmult(2);参数２及以上表示连接第二台及更多数据库服务
	 * 这样实现了在同一方法下访问不同数据库服务器的功能
	 *
	 */
	public function test_multAction(){
		echo "<br /><b>测试同一对象连接不同数据库服务器</b><br />";
		require_once __SITEROOT."library/Models/mult.php";
		$mult1=new Tmult();
		//或写成$mult1=new Tmult(1);
		$mult1->find(true);
		echo $mult1->name;
		$mult2=new Tmult(2);
		$mult2->name=$mult1->name;
		$mult2->insert();
	}
	public function test_cacheAction(){

		require_once(__SITEROOT.'library/Models/student.php');
		echo "<br /><b>演示缓存</b><br />";
		//实例化一个表对象
		$student=new Tstudent();
		//$student->whereAdd("name='1'");
		//缓存文件路径默认为空,实际是指向了cache/database_cache这个默认目录，如果要存储到指定地点，请给出路径如e:/ddd/bbb
		$student->setCache(true,'',10);
		//获取数据
		$student->find();
		while ($student->fetch()){
			echo $student->name."&nbsp;";
			echo $student->class."&nbsp;";
			echo $student->gender."&nbsp;";
			echo "<br />";
		}
		//exit();
	}
	//一个比较复杂的多表关联案例 在大多数情况下，看似复杂的查询通过合理的选择主表也能解决
	public function test_joinAction(){
		$engine=1;
		$engine_name='oracle';
		$engine=1;
		$engine_name='mysql';
		require_once(__SITEROOT.'library/Models/test_transaction.php');
		require_once(__SITEROOT.'library/Models/test_jzb.php');
		require_once(__SITEROOT.'library/Models/test_person.php');
		require_once(__SITEROOT.'library/Models/test_doctor.php');
		//直接查询
		echo "<br /><b>直接查询1</b><br />";
		$transaction=new Ttest_transaction($engine);
		//$transaction->query("select * from test_jzb right join test_transaction on test_jzb.jzlsh=test_transaction.jzlsh inner join test_person on test_jzb.kh=test_person.kh where test_person.xm='叶'");
		$transaction->query("select * from test_jzb right join test_transaction on test_jzb.jzlsh=test_transaction.jzlsh inner join test_person on test_jzb.kh=test_person.kh");
		while ($transaction->fetch()){
			echo $transaction->xm;
			echo $transaction->data;
			echo "<br />";
		}
		//直接查询
		echo "<br /><b>直接查询2</b><br />";
		$transaction=new Ttest_transaction($engine);
		//$transaction->query("select * from test_jzb right join test_transaction on test_jzb.jzlsh=test_transaction.jzlsh inner join test_person on test_jzb.kh=test_person.kh where test_person.xm='叶'");
		$transaction->query("select * from test_jzb right join test_transaction on test_jzb.jzlsh=test_transaction.jzlsh inner join test_person on test_jzb.kh=test_person.kh where test_transaction.doctor_id in (select doctor_id from test_doctor where gender='1')");
		while ($transaction->fetch()){
			echo $transaction->xm;
			echo $transaction->data;
			echo "<br />";
		}

		echo "<hr />";
		//面向对象查询
		echo "<br /><b>面向对象查询1</b><br />";
		$transaction=new Ttest_transaction($engine);
		$jzb=new Ttest_jzb($engine);
		$person=new Ttest_person($engine);
		$person->whereAdd("xm='叶'");
		//$person->subquery
		$jzb->joinAdd("right",$jzb,$transaction,'jzlsh','jzlsh');
		$jzb->joinAdd("inner",$jzb,$person,'kh','kh');
		$jzb->debugLevel(9);
		$jzb->find();
		while ($jzb->fetch()){
			echo $person->xm;
			echo $transaction->data;
			echo "<br />";
		}

		echo "<br /><b>面向对象查询2</b><br />";
		$transaction=new Ttest_transaction();
		$jzb=new Ttest_jzb($engine);
		$person=new Ttest_person($engine);
		//$person->whereAdd("xm='叶'");
		//$person->subquery
		$transaction->joinAdd("left",$transaction,$jzb,'jzlsh','jzlsh');
		$transaction->joinAdd("left",$jzb,$person,'kh','kh');
		$transaction->debugLevel(9);
		$transaction->find();
		while ($transaction->fetch()){
			echo $person->xm;
			echo $transaction->data;
			echo "<br />";
		}
		echo "<br /><b>面向对象查询3</b><br />";
		$transaction=new Ttest_transaction();
		$jzb=new Ttest_jzb($engine);
		$person=new Ttest_person($engine);
		$person->whereAdd("xm='叶'");
		//$person->subquery
		$transaction->joinAdd("left",$transaction,$jzb,'jzlsh','jzlsh');
		$transaction->joinAdd("left",$jzb,$person,'kh','kh');
		$transaction->debugLevel(9);
		$transaction->find();
		while ($transaction->fetch()){
			echo $person->xm;
			echo $transaction->data;
			echo "<br />";
		}
		echo "<br /><b>面向对象查询4 四表联查显示业务数据，病员名称，医生姓名</b><br />";
		$transaction=new Ttest_transaction($engine);
		$jzb=new Ttest_jzb($engine);
		$person=new Ttest_person($engine);
		$doctor=new Ttest_doctor($engine);
		//$person->whereAdd("xm='叶'");
		//$person->subquery
		$transaction->joinAdd("left",$transaction,$jzb,'jzlsh','jzlsh');
		$transaction->joinAdd("left",$jzb,$person,'kh','kh');
		$transaction->joinAdd("left",$transaction,$doctor,'doctor_id','doctor_id');
		$transaction->debugLevel(9);
		$transaction->find();
		while ($transaction->fetch()){
			echo $person->xm;
			echo $transaction->data;
			echo $doctor->xm;
			echo "<br />";
		}
		echo "<br /><b>面向对象查询5 带子查询</b><br />";
		$transaction=new Ttest_transaction($engine);
		$jzb=new Ttest_jzb($engine);
		$person=new Ttest_person($engine);
		$doctor=new Ttest_doctor($engine);
		$doctor->whereAdd("gender='1'");
		$transaction->joinAdd("left",$transaction,$jzb,'jzlsh','jzlsh');
		$transaction->joinAdd("left",$jzb,$person,'kh','kh');
		$transaction->whereAdd($transaction->subSelect('in',$doctor,'doctor_id'));
		$transaction->debugLevel(9);
		$transaction->find();
		while ($transaction->fetch()){
			echo $person->xm;
			echo $transaction->data;
			//echo $doctor->xm;
			echo "<br />";
		}
		echo "<br /><b>面向对象查询6 带复杂关联关系的子查询</b><br />";
		echo "<br /><b>查询由叶叶医生所负责的有业务处理的病人姓名</b><br />";
		$transaction=new Ttest_transaction($engine);
		$jzb=new Ttest_jzb($engine);
		$person=new Ttest_person($engine);
		$doctor=new Ttest_doctor($engine);
		$doctor->whereAdd("xm='叶叶'");
		$transaction->joinAdd("inner",$transaction,$doctor,'doctor_id','doctor_id');

		$jzb->whereAdd($jzb->subSelect('in',$transaction,'jzlsh'));

		$person->distinct("test_person.xm,test_jzb.kh");
		$person->joinAdd('inner',$person,$jzb,'kh','kh');
		$person->debugLevel(9);
		$person->find();
		while ($person->fetch()){
			echo $person->xm;
			echo $person->kh;
			//echo $transaction->data;
			//echo $doctor->xm;
			echo "<br />";
		}
		//

	}
	/**
	 测试表与测试数据

	 drop table transaction;
	 drop table jzb;
	 //drop table base_info;

drop table test_transaction;	 
drop table test_jzb;	 
drop table test_person;	 
drop table test_doctor;	 

create table test_transaction(jzlsh char(10),doctor_id char(10),data int);
insert into test_transaction(jzlsh,doctor_id,data) values('1','001',89);
insert into test_transaction(jzlsh,doctor_id,data) values('1','001',45);
insert into test_transaction(jzlsh,doctor_id,data) values('2','001',91);
insert into test_transaction(jzlsh,doctor_id,data) values('3','001',67);
insert into test_transaction(jzlsh,doctor_id,data) values('4','003',76);
insert into test_transaction(jzlsh,doctor_id,data) values('4','004',63);

create table test_jzb(jzlsh char(10),kh char(10));
insert into test_jzb(jzlsh,kh) values('1','001');
insert into test_jzb(jzlsh,kh) values('2','001');
insert into test_jzb(jzlsh,kh) values('3','002');
insert into test_jzb(jzlsh,kh) values('4','003');
insert into test_jzb(jzlsh,kh) values('5','004');

create table test_person(kh char(10),xm char(10));
insert into test_person(kh,xm) values('001','马');
insert into test_person(kh,xm) values('002','罗');
insert into test_person(kh,xm) values('003','万');
insert into test_person(kh,xm) values('004','陈');
insert into test_person(kh,xm) values('005','叶');


create table test_doctor(doctor_id char(10),xm char(10),gender char(6));
insert into test_doctor(doctor_id,xm,gender) values('001','叶叶','1');
insert into test_doctor(doctor_id,xm,gender) values('002','罗罗','1');
insert into test_doctor(doctor_id,xm,gender) values('003','万万','2');
insert into test_doctor(doctor_id,xm,gender) values('004','陈陈','2');		 
insert into test_doctor(doctor_id,xm,gender) values('005','刘刘','1');		 


create table t业务表(c就诊流水号 char(10),c业务数据 int);
insert into t业务表(c就诊流水号,c业务数据) values('1',89);
insert into t业务表(c就诊流水号,c业务数据) values('1',45);
insert into t业务表(c就诊流水号,c业务数据) values('2',89);
insert into t业务表(c就诊流水号,c业务数据) values('3',67);
insert into t业务表(c就诊流水号,c业务数据) values('4',76);
insert into t业务表(c就诊流水号,c业务数据) values('4',63);

create table t就诊表(c就诊流水号 char(10),c卡号 char(10));
insert into t就诊表(c就诊流水号,c卡号) values('1','001');
insert into t就诊表(c就诊流水号,c卡号) values('2','001');
insert into t就诊表(c就诊流水号,c卡号) values('3','002');
insert into t就诊表(c就诊流水号,c卡号) values('4','003');
insert into t就诊表(c就诊流水号,c卡号) values('5','004');

create table t患者基本信息表(c卡号 char(10),c姓名 char(10));
insert into t患者基本信息表(c卡号,c姓名) values('001','叶');
insert into t患者基本信息表(c卡号,c姓名) values('002','罗');
insert into t患者基本信息表(c卡号,c姓名) values('003','万');
insert into t患者基本信息表(c卡号,c姓名) values('004','陈');
正确的写法：
select * from t就诊表 right join t业务表 on t业务表.c就诊流水号=t就诊表.c就诊流水号 left join t患者基本信息表 on t就诊表.c卡号=t患者基本信息表.c卡号

select * from t就诊表 right join t业务表 on t业务表.c就诊流水号=t就诊表.c就诊流水号 left join t患者基本信息表 on t就诊表.c卡号=t患者基本信息表.c卡号 where t患者基本信息表.c姓名='罗'

//正确的
select * from test_transaction inner join  test_jzb on test_transaction.jzlsh=test_jzb.jzlsh  inner join test_person on test_jzb.kh=test_person.kh


	 */
}
