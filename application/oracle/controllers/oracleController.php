<?php
/**
 * 本模块演示5dMVC DB层的具体用法
 * http://localhost:8088/compatible/dataDemo/test
 * @author www.phpchengdu.com 罗维
 *
 */
class oracle_oracleController extends controller {
	public function test1Action(){
				//require_once __SITEROOT."library/Models/organization.php";
				require_once __SITEROOT."library/Models/organization.php";
				$iha=new Torganization(1);
				$iha->debugLevel(9);
				$iha->find();
				echo "ddd";
				while($iha->fetch()){
					echo $iha->id;
					echo "<br />";
				}
				//$iha->whereAdd("region_path like '1%'");
				echo $iha->count();
				//$sql='select * from organization';
				//$rs=orac
				$rs='';
				
	}
	public function testAction(){
		//echo date("Y-m-d h:i:s",'1275897280');
		echo '模块名:'.$this->getModuleName().'<br />';
		echo '控制器名:'.$this->getControllerName().'<br />';
		echo '动作名:'.$this->getActionName().'<br />';
		//echo time();
		set_time_limit(0);
		error_reporting(0);
		//引入本页面中用到的表对象定义文件
		require_once(__SITEROOT.'library/Models/student.php');
		require_once(__SITEROOT.'library/Models/score1.php');
		require_once(__SITEROOT.'library/Models/score2.php');
		require_once(__SITEROOT.'library/Models/teacher.php');
		require_once(__SITEROOT.'library/include/adodb-time.inc.php');


		/*		require_once(__SITEROOT.'model/oracle_student.php');
		require_once(__SITEROOT.'model/oracle_score1.php');
		require_once(__SITEROOT.'model/oracle_score2.php');
		require_once(__SITEROOT.'model/oracle_teacher.php');*/
		//require_once(__SITEROOT.'model/score2.php');

		$student=new Tstudent();
		$student->whereAdd("id='399'");
		if($student->count('*')>0){
			//表示记录存在
			$student->find();
			echo "记录存在";
		}else{
			//表示记录不存在
			echo "记录不存在";
			$student->id='399';
			$student->name='399';
			$student->insert();
			echo $student->oracle_error();

		}


		echo "<br><b>演示从表中读取所有数据列表</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$student->debug(1);
		//获取数据
		$student->find();
		while ($student->fetch()){
			//echo $student->oracle_error();
			echo $student->name."&nbsp;";
			echo $student->class."&nbsp;";
			echo $student->gender."&nbsp;";
			echo $student->class."&nbsp;";
			echo $student->birthday1."&nbsp;";
			echo date("Y-m-d",strtotime($student->birthday1))."&nbsp;";
			echo "<br>";
		}
		echo $student->oracle_error();

		echo "<br><b>演示从表中读取男生数据列表</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		//选择运算
		$student->whereAdd("gender='男'");
		//获取数据
		$student->find();
		while ($student->fetch()){
			echo $student->name."&nbsp;";
			echo $student->class."&nbsp;";
			echo $student->gender."&nbsp;";
			echo "<br>";
		}

		echo "<br><b>演示从表中读取一条记录的处理方法之whereAdd</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		//$student->query('set names utf8');
		$student->whereAdd("id='10'");
		//$student->whereAdd("name='mike'");
		//获取数据
		$student->find(true);
		echo $student->id."&nbsp;";
		echo $student->name."&nbsp;";
		echo $student->class."&nbsp;";
		echo $student->gender."&nbsp;";
		echo "<br>";

		echo "<br><b>演示从表中读取演示从表中取指定位置的数据列表 limit</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		//$student->query('set names utf8');
		//指定要获取数据的起始位置与数量
		//$student->orderby('hometown desc');
		$student->limit(0,4);
		//获取数据
		$student->select();
		while ($student->fetch())
		{
			echo $student->name."&nbsp;";
			echo $student->class."&nbsp;";
			echo $student->gender."&nbsp;";
			echo "<br>";
		}
		echo "<br><b>演示统计表中的记录数</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		//获取数据
		$student->whereAdd("gender='男'");
		echo $student->count();
		echo "<br />";

		echo "<br><b>演示从表中读取不重复的班级名称 </b><br>";
		//实例化一个表对象
		$student=new TStudent();
		//$student->query('set names utf8');
		//$student->selectAdd();
		//$student->selectAdd("distinct class as distinct_class,gender as distinct_gender");
		//$student->selectAdd("distinct class as distinct_class,gender as gender");
		$student->selectAdd("distinct class as distinct_class");
		//获取数据
		//$student->debugLevel(9);
		$student->find();
		//$student->debugLevel(0);
		while ($student->fetch()){
			//echo $student->distinct_class."&nbsp;";
			echo $student->distinct_class."&nbsp;";
			//echo $student->gender."&nbsp;";
			echo "<br>";
		}
		
		echo "<br><b>演示分组统计每班人数</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$student->groupBy('class');
		$student->selectAdd("count(*) as classperson,class as class");
		//$student->debugLevel(9);

		$student->find();

		//$student->debugLevel(0);
		while ($student->fetch())
		{
			echo $student->class."&nbsp;";
			echo $student->classperson."&nbsp;";
			echo "<br>";
		}
		
		echo "<br><b>演示分组统计每班平均成绩</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$student->groupBy('class');
		$student->selectAdd("count(*) as classperson,class as class");
		//$student->debugLevel(9);

		$student->find();

		//$student->debugLevel(0);
		while ($student->fetch())
		{
			echo $student->class."&nbsp;";
			echo $student->classperson."&nbsp;";
			echo "<br>";
		}		
		
		
		echo "<br><b>演示分组统计每班人数，仅显示大于２个以上的班级</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		//$student->orderby('class desc');
		$student->groupBy('class');
		$student->selectAdd("count(*) as classperson,class as class");
		$student->orderby('classperson desc');
		//如果有字段名冲突，请加表名 student.classperson>2
		$student->having("count(*)>2");
		//$student->limit(2,3);
		$student->debugLevel(9);
		$student->find();
		//$student->debugLevel(0);
		while ($student->fetch())
		{
			echo $student->class."&nbsp;";
			echo $student->classperson."&nbsp;";
			echo "<br>";
		}
		echo "<br>";
		echo "<br><b>分组统计班级数1</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		//$student->groupBy('class');
		$student->selectAdd("count(distinct(class)) as classnumber");
		$student->debugLevel(9);
		$student->find(true);
		echo $student->classnumber."&nbsp;";
		echo "<br>";

		echo "<br>";
		echo "<br><b>分组统计班级数2</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		echo $student->count("distinct(class)");

		echo "<br>";

		
		echo "<br><b>演示分组统计每班人数，仅显示大于２个以上的班级</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		//$student->orderby('class desc');
		$student->groupBy('class');
		$student->selectAdd("count(*) as classperson,class as class");
		$student->orderby('classperson desc');
		//如果有字段名冲突，请加表名 student.classperson>2
		$student->having("count(*)>2");
		//$student->limit(2,3);
		$student->debugLevel(9);
		$student->find();
		//$student->debugLevel(0);
		while ($student->fetch())
		{
			echo $student->class."&nbsp;";
			echo $student->classperson."&nbsp;";
			echo "<br>";
		}

		echo "<br><b>演示分组统计每班男生人数，仅显示大于２个以上的班级,按班级人数排序</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$student->whereAdd("gender='男'");;
		$student->orderby('class desc');
		$student->groupBy('class');
		$student->selectAdd("count(*) as classperson,class as class");
		//如果有字段名冲突，请加表名 student.classperson>2
		//注意oralce中只能这样实现了，与mysql有冲突，代码在这里不兼容
		$student->having("count(*)>2");
		//$student->limit(2,3);
		$student->debugLevel(9);
		$student->find();
		//$student->debugLevel(0);
		while ($student->fetch()){
			echo $student->class."&nbsp;";
			echo $student->classperson."&nbsp;";
			echo "<br>";
		}



		echo "<br><b>演示一对一多表关联的数据读取</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$score=new Tscore1();
		//$student->query('set names utf8');
		//myMVC的标准方法
		$student->joinAdd('inner',$student,$score,'id','id');
		//兼容pearDB的方法
		//$student->joinAdd(array('id','score1:id'));
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
			echo "<br>";
		}


		echo "<br><b>演示关联学生基本信息表与成绩表１，分组统计每班男生人数，仅显示大于２个以上的班级</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$score1=new Tscore1();
		//从表的条件必须出现在joinAdd前
		$score1->whereAdd("score1.computer>10");
		//myMVC的标准方法
		$student->joinAdd('inner',$student,$score1,'id','id');
		$student->whereAdd("gender='男'");;
		$student->orderby('class desc');
		$student->groupBy('class');
		$student->selectAdd("count(*) as classperson,class as class");
		//$student->selectAdd("to_char(unixts_to_date(updated),'DD') as day,staff_id as staff_id,count(distinct uuid) as nums");

		//$student->selectAdd("aaaa(class) as new_class,bbbb(dddd(gender)) as new_gender",'add');
		//$student->debugLevel(9);
		//exit();

		//如果有字段名冲突，请加表名 student.classperson>2
		$student->having("count(*)>1");
		$student->debugLevel(9);
		$student->find();
		//$student->debugLevel(0);
		while ($student->fetch()){
			echo $student->class."&nbsp;";
			echo $student->classperson."&nbsp;";
			echo "<br>";
		}


		echo "<br><b>演示一对一加一对多三表关联情况下的多表关联的数据读取一</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		//$student->whereAdd("student.class='三班'");
		$score1=new Tscore1();
		//$score1->whereAdd("score1.english>60");
		//$score1->whereAdd("score1.computer>60");
		$score1->whereAdd("score1.computer>60 or score1.english>60");
		$score2=new Tscore2();
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
			echo "<br>";
		}
		echo "<br><b>演示一对一加一对多三表关联情况下的多表关联的数据读取二</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		//$student->whereAdd("student.class='三班'");
		$score1=new Tscore1();
		$score1->whereAdd("score1.english>60");
		$score1->whereAdd("score1.computer>60");
		//$score1->whereAdd("score1.computer>60 or score1.english>60");
		$score2=new Tscore2();
		//myMVC的标准方法
		$student->joinAdd('inner',$student,$score1,'id','id');
		$student->joinAdd('inner',$student,$score2,'id','id');
		//$a->joinAdd('inner',$a,$b,'id','id');
		//$a->joinAdd('inner',$a,$c,'name','name');
		//select * from a,b,c where a.id='$aa' and a.name='$cc' and c.code='$ff' 
		//$a->joinAdd('inner',$a,$b,'id','id');
		//$b
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
			echo "<br>";
		}

		echo "<br><b>演示学生表，成绩表2，教师表关联一</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$score2=new Tscore2();
		$score2->whereAdd("score2.score>=20");
		$teacher=new Tteacher();
		$teacher->whereAdd("teacher.id='1'");
		//myMVC的标准方法
		$student->joinAdd('inner',$student,$score2,'id','id');
		$student->joinAdd('inner',$score2,$teacher,'teacher_id','id');
		$student->debug(1);
		$student->find();
		while ($student->fetch()){
			echo $student->name."&nbsp;";
			echo $student->class."&nbsp;";
			echo $student->gender."&nbsp;";
			echo $score2->course."&nbsp;";
			echo $score2->score."&nbsp;";
			echo $teacher->name_name_name_name_name_nam;
			echo "<br>";
		}
		
		echo "<br><b>演示成绩表2-学生表关联一</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$score2=new Tscore2();
		$score2->joinAdd('inner',$score2,$student,'id','id');
		$score2->debug(1);
		$score2->find();
		while ($score2->fetch()){
			echo $student->name."&nbsp;";
			echo $student->class."&nbsp;";
			echo $student->gender."&nbsp;";
			echo $score2->course."&nbsp;";
			echo $score2->score."&nbsp;";
			echo "<br>";
		}

		
		
		echo "<br><b>演示学生表，成绩表2，教师表关联统计</b><br>";
		//实例化一个表对象
		$student=new TStudent();

		$score2=new Tscore2();
		$score2->whereAdd("score2.score>=20");
		$teacher=new Tteacher();
		$teacher->whereAdd("teacher.id='1'");
		//myMVC的标准方法
		$student->joinAdd('inner',$student,$score2,'id','id');
		$student->joinAdd('inner',$score2,$teacher,'teacher_id','id');
		$student->debug(1);
		//$student->find();
		echo $student->count('*');

		echo "<br><b>演示别名字段数据读取 oracle字段名不能用大小写混合的方式了</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$student->selectAdd("name  new_name",'add');
		$student->selectAdd("class as new_class,gender as new_gender",'add');
		$student->selectAdd("to_char(birthday1,'yyyy-mm-dd') as birthday_date",'add');
		//to_date('2009-01-01','yyyy-mm-dd  hh24:mi:ss')
		//$student->selectAdd("class as newClass");
		//$student->selectAdd("gender as newGender");

		$score=new Tscore1();
		$score->selectAdd("computer as jsj,english as yy");
		$score->selectAdd("chinese as yw");
		//$student->query('set names utf8');
		//myMVC的标准方法
		$student->joinAdd('inner',$student,$score,'id','id');
		//兼容pearDB的方法
		//$student->joinAdd(array('id','score1:id'));
		//获取数据
		//$student->debugLevel(9);
		$student->debugLevel(9);
		$student->select();
		while ($student->fetch()){
			echo $student->new_name."&nbsp;";
			echo $student->name."&nbsp;";
			echo $student->new_class."&nbsp;";
			echo $student->new_gender."&nbsp;";
			echo $student->birthday_date."&nbsp;";

			echo $score->yy."&nbsp;";
			echo $score->yw."&nbsp;";
			echo $score->jsj."&nbsp;";
			//echo '$student->jsj'.$student->jsj."&nbsp;";

			echo "<br>";
		}


		echo "<br><b>演示子查询1</b><br>";
		//实例化一个表对象
		//$student=new Tstudent();
		$score1=new Tscore1();
		$score1->whereAdd("computer=(select max(computer) from score1)");
		$score1->debugLevel(9);
		$score1->select();
		$score1->fetch();
		echo $score1->id;

		echo "<br><b>演示子查询2</b><br>";
		//实例化一个表对象
		$student=new Tstudent();
		$student->whereAdd("uuid in(select distinct id as uuid from score2)");
		$student->debugLevel(9);
		$student->find();
		while ($student->fetch()){
			echo $student->name;
			echo "<br />";
		}
		exit();

		
		echo "<br>";

		echo "<br><b>演示插入数据的方法</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$student->name='outman';
		$student->uuid='99';
		$student->id='99';
		$student->address='mars';
		$student->class='three';
		$student->gender='男';
		$student->debugLevel(9);
		$student->insert();
		echo $student->oracle_error();
		echo "<br>";

		echo "<br><b>演示读取刚才插入的记录</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		//$student->query('set names utf8');
		$student->whereAdd("id='99'");
		//获取数据
		$student->find(true);
		echo $student->id."&nbsp;";
		echo $student->name."&nbsp;";
		echo $student->class."&nbsp;";
		echo $student->gender."&nbsp;";
		echo "<br>";


		echo "<br><b>演示更新记录 使用whereAdd</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$student->whereAdd("uuid='99'");//注意这句
		$student->debugLevel(9);
		$student->name='奥特曼';
		//$student->name=$student->e
		$student->name=$student->escape('name',"substr('奥特曼',1,2)");
		//$student->name='substr(奥特曼,1,2)';
		//$student->name="name+'1'";
		//修改记录
		$student->debugLevel(9);
		$student->update();
		echo $student->oracle_error();
		echo "<br>";

		echo "<br><b>演示读取刚才更新的记录</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		//$student->query('set names utf8');
		$student->whereAdd("id='99'");
		//获取数据
		$student->find(true);
		echo $student->id."&nbsp;";
		echo $student->name."&nbsp;";
		echo $student->class."&nbsp;";
		echo $student->gender."&nbsp;";
		echo "<br>";



		echo "<br><b>演示删除刚才更新的记录</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		//$student->query('set names utf8');
		$student->whereAdd("id='99'");
		$student->delete();
		echo $student->oracle_error();
		echo "<br>";


		echo "<br><b>演示插入数据的方法,使用教师表，长字段名测试</b><br>";
		//实例化一个表对象
		$teacher=new Tteacher();
		$teacher->uuid=$teacher->id='89';
		$teacher->name_name_name_name_name_nam='孔子';
		$teacher->debugLevel(9);
		$teacher->insert();
		echo $teacher->oracle_error();
		echo "<br>";

		echo "<br><b>演示读取刚才插入的记录</b><br>";
		//实例化一个表对象
		$teacher=new Tteacher();
		$teacher->whereAdd("id='89'");
		//获取数据
		$teacher->find(true);
		echo $teacher->name_name_name_name_name_nam."&nbsp;";
		echo "<br>";


		echo "<br><b>演示更新记录 使用whereAdd使用教师表，长字段名测试</b><br>";
		//实例化一个表对象
		$teacher=new Tteacher();
		$teacher->whereAdd("id='89'");
		//$student->debugLevel(9);
		$teacher->name_name_name_name_name_nam='奥特曼孔子';
		//修改记录
		$teacher->update();
		echo "<br>";

		echo "<br><b>演示读取刚才更新的记录 用whereAdd使用教师表，长字段名测试</b><br>";
		//实例化一个表对象
		$teacher=new Tteacher();
		$teacher->whereAdd("id='89'");
		//获取数据
		$teacher->find(true);
		echo $teacher->name_name_name_name_name_nam."&nbsp;";
		echo "<br>";
		echo "<br><b>演示删除刚才更新的记录</b><br>";
		//实例化一个表对象
		$teacher=new Tteacher();
		//$student->query('set names utf8');
		$teacher->whereAdd("id='89'");
		$teacher->delete();
		echo $teacher->oracle_error();
		echo "<br>";

		echo "<br><b>演示插入数据的方法,测试数字型字段</b><br>";
		//实例化一个表对象
		$score1=new Tscore1();
		$score1->uuid=$score1->id='99';
		$score1->english=99;
		$score1->computer=99;
		$score1->chinese=99;
		$score1->debugLevel(9);
		$score1->insert();

		echo "<br>";

		echo "<br><b>演示读取刚才插入的记录</b><br>";
		//实例化一个表对象
		$score1=new Tscore1();
		$score1->whereAdd("id='99'");
		//获取数据
		$score1->find(true);
		echo $score1->english."&nbsp;";
		echo "<br>";


		echo "<br><b>演示更新记录 测试数字型字段</b><br>";
		//实例化一个表对象
		$score1=new Tscore1();
		$score1->whereAdd("id='99'");
		$score1->english=69;
		$score1->computer=77;
		//$score1->sum=$score1->english+$score1->computer;
		//修改记录 hibernate 也实现不了，我们也就不去自讨苦吃了
		$score1->update();
		//$score1->query("update score1 set sum=computer+english ");
		echo "<br>";



		echo "<br><b>演示读取刚才更新的记录 测试数字型字段</b><br>";
		//实例化一个表对象
		$score1=new Tscore1();
		$score1->whereAdd("id='99'");
		//获取数据
		$score1->find(true);
		echo $score1->english."&nbsp;";

		echo "<br>";
		echo "<br><b>演示删除刚才更新的记录</b><br>";
		//实例化一个表对象
		$score1=new Tscore1();
		//$student->query('set names utf8');
		$score1->whereAdd("id='99'");
		$score1->delete();
		echo $score1->oracle_error();
		echo "<br>";


		echo "<br><b>演示日期型字段的相关操作</b><br>";
		$student=new Tstudent();
		//$student->whereAdd("id='99'");
		//获取数据
		//select * from aa where date1>to_date('2008-08-08','yyyy-mm-dd')
		$student->whereAdd("birthday1>to_date('2009-01-01','yyyy-mm-dd  hh24:mi:ss')");
		$student->find();
		//echo "dd";
		$student->debugLevel(9);
		//echo $student->oracle_error();
		while($student->fetch()){

			echo $student->name.$student->birthday1."<br />";
			//echo $student->oracle_error();
		}

		echo "<br>";


		echo "<br><b>演示插入数据的方法,测试日期型字段</b><br>";
		//实例化一个表对象
		$student=new Tstudent();
		$student->uuid=$student->id='99';
		$student->name='test日期';
		//$student->birthday1='2010-06-06 23:17:23';
		$student->birthday1=$student->escape('birthday1',"to_date('2029-01-01','yyyy-mm-dd  hh24:mi:ss')");
		$student->insert();
		echo $student->oracle_error();
		echo "<br>";

		echo "<br><b>演示读取刚才插入的记录,测试日期型字段</b><br>";
		//实例化一个表对象
		$student=new Tstudent();
		$student->whereAdd("id='99'");
		//获取数据
		$student->find(true);
		echo $student->birthday1."&nbsp;";
		echo "<br>";


		echo "<br><b>演示更新记录 测试日期型字段</b><br>";
		//实例化一个表对象
		$student=new Tstudent();
		$student->whereAdd("id='99'");
		$student->birthday1=$student->escape('birthday1',"to_date('2139-01-01','yyyy-mm-dd  hh24:mi:ss')");
		$student->update();
		echo $student->oracle_error();

		//$score1->query("update score1 set sum=computer+english ");
		echo "<br>";



		echo "<br><b>演示读取刚才插入的记录,测试日期型字段</b><br>";
		//实例化一个表对象
		$student=new Tstudent();
		$student->whereAdd("id='99'");
		//获取数据
		$student->find(true);
		echo $student->birthday1."&nbsp;";
		echo "<br>";


		echo "<br>";
		echo "<br><b>演示删除刚才更新的记录</b><br>";
		$student=new Tstudent();
		$student->whereAdd("id='99'");
		$student->delete();
		echo $student->oracle_error();
		echo "<br>";
		echo "<br><b>演示用number型当作日期型字段的相关操作</b><br>";
		$student=new Tstudent();
		//$student->whereAdd("id='99'");
		//获取数据
		//select * from aa where date1>to_date('2008-08-08','yyyy-mm-dd')
		//$student->whereAdd("birthday1>to_date('2009-01-01','yyyy-mm-dd  hh24:mi:ss')");
		$student->find();
		//echo $student->oracle_error();
		while($student->fetch()){
			//echo $student->name.'&nbsp;&nbsp;&nbsp;'.$student->birthday2.'&nbsp;&nbsp;&nbsp;'.date('Y-m-d H:i:s',$student->birthday2)."<br />";
			echo $student->name.'&nbsp;&nbsp;&nbsp;'.$student->birthday2.'&nbsp;&nbsp;&nbsp;'.adodb_date('Y-m-d H:i:s',$student->birthday2)."<br />";
			//echo $student->oracle_error();
		}
		echo "<br>";

		//echo  "测试adodb time<br />";
		//echo adodb_mktime(23,59,21,11,23,2098);
		//echo adodb_date('Y-m-d H:i:s',adodb_mktime(23,59,21,11,23,2098));
		echo "<br><b>演示插入数据的方法,测试number型当作日期型字段<br />";
		//实例化一个表对象
		$student=new Tstudent();
		$student->uuid=$student->id='99';
		$student->name='日期';
		$student->birthday2=adodb_mktime(23,59,21,11,23,2098);
		//$student->debug(1);
		$student->insert();

		echo $student->oracle_error();
		echo "<br>";



		echo "<br><b>演示读取刚才插入的记录,测试number型当作日期型字段</b><br>";
		//实例化一个表对象
		$student=new Tstudent();
		$student->whereAdd("id='99'");
		//获取数据
		$student->debug(1);
		$student->find(true);
		echo adodb_date('Y-m-d H:i:s',$student->birthday2)."&nbsp;";
		echo "<br>";


		echo "<br><b>演示更新记录 测试number型当作日期型字段</b><br>";
		//实例化一个表对象
		$student=new Tstudent();
		$student->whereAdd("id='99'");
		$student->birthday2=adodb_mktime(23,59,21,11,23,2198);
		$student->update();
		echo $student->oracle_error();

		//$score1->query("update score1 set sum=computer+english ");
		echo "<br>";



		echo "<br><b>演示读取刚才更新的记录,测试number型当作日期型字段</b><br>";
		//实例化一个表对象
		$student=new Tstudent();
		$student->whereAdd("id='99'");
		//获取数据
		$student->find(true);
		echo adodb_date('Y-m-d H:i:s',$student->birthday2)."&nbsp;";
		echo "<br>";
		echo "<br><b>演示删除刚才更新的记录</b><br>";
		$student=new Tstudent();
		$student->whereAdd("id='99'");
		$student->debug(1);
		$student->delete();
		echo $student->oracle_error();
		echo "<br>";

		echo "<br>";
		echo "<br><b>演示事务功能php>5.3</b><br>";
		$student=new Tstudent();
		$student->whereAdd("id='299'");
		$student->delete();
		$score1=new Tscore1();
		$score1->whereAdd("id='299'");
		$score1->delete();

		$ok=true;
		$student=new Tstudent();
		$student->startTransaction();
		$student->uuid=$student->id='299';
		//$student->dsdsdsd=$student->id='199';
		$student->name='299tr';
		//echo $student->oracle_error();

		if($student->insert()){
			//echo "bad-student";
		}else{
			//echo $student->oracle_error();

			$ok=false;
		}
		//$student->rollBack();
		//echo $student->oracle_error();
		//$student->commit();
		//echo $student->oracle_error();
		$score1=new Tscore1();
		$score1->startTransaction();
		//$score1->uuid=$score1->id='199';
		$score1->uuid=$score1->id='299';
		$score1->english=99;
		$score1->computer=99;
		$score1->chinese=99;
		//$score1->debugLevel(9);
		//开打或关闭下面这句可明确看到事务的现实
		//$score1->dddd=99;
		if($score1->insert()){
			//echo "ok";
		}else{
			//echo $score1->oracle_error();
			//echo "bad-score1";
			$ok=false;
		}
		if($ok){
			echo "ok";
			$score1->commit();
		}else{
			echo "bad-rollBack";
			$score1->rollBack();
		}
		//修改刚才插入的数据
		$student=new Tstudent();
		//$score1->whereAdd("id='199'");
		$student->whereAdd("id='299'");
		$student->find(true);
		echo "<br>显示刚才插入的数据<br>";
		echo $student->name;
		echo "<br>";
		//读出事务处理后的数据
		//$score1->commit();
		echo "<br>";

		echo "<br><b>性能测试</b><br>";
		echo "<br><b>创建1k次数据对象并记取数据</b><br>";
		$temStartTime=microtime(true);
		for($i=0;$i<1000;$i++){
			$student=new Tstudent();
			$student->whereAdd("id='79900'");
			$student->find(true);
		}
		$temEndTime=microtime(true);
		$time=$temEndTime-$temStartTime;
		echo "<br><b>创建1k次数据对象并记取数据用时".$time."</b><br>";




	}
	public function createtableAction(){
		set_time_limit(0);
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
		$queryString="drop table student";
		oracl_query($queryString,$conn);

		$queryString="drop table score1";
		oracl_query($queryString,$conn);
		//COMMENT ON TABLE ctable_name IS '对表注释的内容'
		$queryString="drop table score2";
		oracl_query($queryString,$conn);

		$queryString="drop table teacher";
		oracl_query($queryString,$conn);
		$queryString="drop table menu";
		oracl_query($queryString,$conn);

		echo "测试创建新表<br />";

		//无级分类栏目表
		$queryString="create table menu(uuid varchar2(30))";
		oracl_query($queryString,$conn);
		oracl_query("alter table menu add id  int",$conn);
		oracl_query("alter table menu add inner_order  int",$conn);
		oracl_query("alter table menu add parent_id  varchar2(13)",$conn);
		oracl_query("alter table menu add description varchar2(100)",$conn);
		oracl_query("alter table menu add property varchar2(10)",$conn);
		oracl_query("alter table menu add action varchar2(10)",$conn);
		oracl_query("alter table menu add path  varchar2(255)",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('1','1','1','全部栏目','1','1','1')",$conn);
		//一级栏目
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('2','2','1','学院概况','2','1,2','1')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('4','4','1','最新公告','2','1,4','1')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('6','6','1','校院风采','2','1,6','1')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('8','8','1','党群工作','2','1,8','1')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('10','10','1','学科建设','2','1,10','1')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('12','12','1','科学研究','2','1,12','1')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('14','14','1','师资队伍','2','1,14','1')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('16','16','1','教育培养','2','1,16','1')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('18','18','1','招生就业','2','1,18','1')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('20','20','1','学生工作','2','1,20','1')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('22','22','1','精品课程','2','1,22','1')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('24','24','1','实验室建设','2','1,24','1')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('26','26','1','成人教育','2','1,26','1')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('28','28','1','资源下载','2','1,28','1')",$conn);
		//二级栏目
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('50','50','4','最新公告a','3','1,4,50','2')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('52','52','4','最新公告b','3','1,4,52','2')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('54','54','4','最新公告c','3','1,4,54','2')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('60','60','6','校院风采a','3','1,6,60','2')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('62','62','6','校院风采b','3','1,6,62','2')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('64','64','6','校院风采c','3','1,6,64','2')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('80','80','8','党群工作a','3','1,8,80','2')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('82','82','8','党群工作b','3','1,8,82','2')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('84','84','8','党群工作c','3','1,8,84','2')",$conn);
		oracl_query("insert into menu(uuid,id,parent_id,description,property,path,action) values('86','86','8','党群工作d','3','1,8,86','2')",$conn);

		/*

		$queryString="create table region(uuid char(30))";
		oracl_query($queryString,$conn);
		$queryString="alter table region add region_id char(6)";
		oracl_query($queryString,$conn);
		$queryString="alter table region add region_pid char(6)";
		oracl_query($queryString,$conn);
		$queryString="alter table region add region_path char(100)";
		oracl_query($queryString,$conn);
		$queryString="comment on table teacher IS '地区表'";
		oracl_query($queryString,$conn);



		$region=array(
		'1'=>array('1','1','1','中国','10000'),
		'2'=>array('2','1','1,2','四川省','51000'),
		'3'=>array('3','2','1,2,3','成都市','510100'),
		'4'=>array('4','2','1,2,4','攀枝花市','520100'),
		'5'=>array('5','2','1,2,5','绵阳市','530101'),
		'6'=>array('6','3','1,2,3,6','青羊区','510106'),
		'7'=>array('7','3','1,2,3,7','成华区','510104'),
		'8'=>array('8','6','1,2,3,6,8','汪家社区',''),
		'9'=>array('9','6','1,2,3,6,9','小南社区',''),
		'10'=>array('10','7','1,2,3,7,10','五桂桥社区','')
		);
		*/
		$queryString="create table student(uuid char(30))";
		oracl_query($queryString,$conn);
		$queryString="alter table student add id char(10)";
		oracl_query($queryString,$conn);
		$queryString="alter table student add name char(10)";
		oracl_query($queryString,$conn);
		$queryString="alter table student add gender char(2)";
		oracl_query($queryString,$conn);
		$queryString="alter table student add birthday int";
		oracl_query($queryString,$conn);
		$queryString="alter table student add class char(10)";
		oracl_query($queryString,$conn);
		$queryString="alter table student add address char(20)";
		oracl_query($queryString,$conn);
		$queryString="alter table student add hometown char(10)";
		oracl_query($queryString,$conn);
		$queryString="alter table student add birthday1 date";
		oracl_query($queryString,$conn);
		$queryString="alter table student add birthday2 number";
		oracl_query($queryString,$conn);
		//建立索引
		$queryString="create index id on student(id)";
		oracl_query($queryString,$conn);


		//对student表插入数据
		$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown,birthday1,birthday2) values('1','1','李1','男','407635200234','一班','东大街','成都',to_date('1974-12-16 14:23:15','yyyy-mm-dd hh24:mi:ss'),'1235897280')";
		oracl_query($queryString,$conn);
		$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown,birthday1,birthday2) values('2','2','李2','男','348105600','一班','西大街','成都',to_date('2072-12-16 23:59:49','yyyy-mm-dd hh24:mi:ss'),'1271897280')";
		oracl_query($queryString,$conn);
		$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown,birthday1,birthday2) values('3','3','李3','女','67564800','二班','南大街','重庆',to_date('1982-12-16 4:23:15','yyyy-mm-dd hh24:mi:ss'),'1379897280')";
		oracl_query($queryString,$conn);
		$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown,birthday1,birthday2) values('4','4','李4','男','262224000','二班','北大街','成都',to_date('1962-12-16 14:23:15','yyyy-mm-dd hh24:mi:ss'),'1379897280')";
		oracl_query($queryString,$conn);
		$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown,birthday1,birthday2) values('5','5','李5','女','550886400','三班','中大街','德阳',to_date('2002-12-16','yyyy-mm-dd hh24:mi:ss'),'3379897280')";
		oracl_query($queryString,$conn);
		$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown,birthday1,birthday2) values('6','6','李6','男','716169600','四班','步行街','南充',to_date('2012-12-16','yyyy-mm-dd hh24:mi:ss'),'4379897280')";
		oracl_query($queryString,$conn);
		$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown) values('7','7','李7','女','484272000','四班','小南街','自贡')";
		oracl_query($queryString,$conn);
		$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown) values('8','8','李8','男','407635200','一班','东大街','成都')";
		oracl_query($queryString,$conn);
		$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown) values('9','9','李9','男','348105600','一班','西大街','成都')";
		oracl_query($queryString,$conn);
		$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown) values('10','10','李10','女','67564800','二班','南大街','重庆')";
		oracl_query($queryString,$conn);
		$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown) values('11','11','李11','男','262224000','二班','北大街','成都')";
		oracl_query($queryString,$conn);
		$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown) values('12','12','李12','女','550886400','三班','中大街','德阳')";
		oracl_query($queryString,$conn);
		$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown) values('13','13','李13','男','716169600','四班','步行街','南充')";
		oracl_query($queryString,$conn);
		$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown) values('14','14','李14','女','484272000','四班','小南街','自贡')";
		oracl_query($queryString,$conn);
		$queryString="comment on table student IS '学生基本信息表'";
		oracl_query($queryString,$conn);

		//插入10000条
		for($i=100;$i<1;$i++){
			$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown) values('$i','$i','$i','女','484272000','四班','小南街','自贡')";
			oracl_query($queryString,$conn);

		}

		//COMMENT ON COLUMN ctable_name.field1 IS '对field1列注释的内容';/*给列添加注释内容的方式，有多少个列应该写多少个*/
		$queryString="comment on column student.name IS '学生姓名'";
		oracl_query($queryString,$conn);
		$queryString="comment on column student.address IS '地址'";
		oracl_query($queryString,$conn);

		$queryString="create table score1(uuid char(30))";
		oracl_query($queryString,$conn);
		$queryString="alter table score1 add id char(10)";
		oracl_query($queryString,$conn);
		$queryString="alter table score1 add english int";
		oracl_query($queryString,$conn);
		$queryString="alter table score1 add chinese int";
		oracl_query($queryString,$conn);
		$queryString="alter table score1 add computer int";
		oracl_query($queryString,$conn);

		$queryString="comment on table score1 IS '学生成绩表'";
		oracl_query($queryString,$conn);

		$queryString="insert into score1(uuid,id,english,chinese,computer) values('1','1','34','78','45')";
		oracl_query($queryString,$conn);
		$queryString="insert into score1(uuid,id,english,chinese,computer) values('2','2','71','18','96')";
		oracl_query($queryString,$conn);
		$queryString="insert into score1(uuid,id,english,chinese,computer) values('3','3','65','91','87')";
		oracl_query($queryString,$conn);
		$queryString="insert into score1(uuid,id,english,chinese,computer) values('4','4','76','66','45')";
		oracl_query($queryString,$conn);
		$queryString="insert into score1(uuid,id,english,chinese,computer) values('5','5','23','78','88')";
		oracl_query($queryString,$conn);
		$queryString="insert into score1(uuid,id,english,chinese,computer) values('6','6','77','55','77')";
		oracl_query($queryString,$conn);
		$queryString="insert into score1(uuid,id,english,chinese,computer) values('7','7','55','78','56')";
		oracl_query($queryString,$conn);
		//建立索引
		$queryString="create index id on score1(id)";
		oracl_query($queryString,$conn);

		$queryString="create table teacher(uuid char(30))";
		oracl_query($queryString,$conn);
		$queryString="alter table teacher add id char(10)";
		oracl_query($queryString,$conn);
		$queryString="alter table teacher add name_name_name_name_name_nam char(10)";
		oracl_query($queryString,$conn);
		$queryString="comment on table teacher IS '教师表'";
		oracl_query($queryString,$conn);

		$queryString="insert into teacher(uuid,id,name_name_name_name_name_nam) values('1','1','张老师')";
		oracl_query($queryString,$conn);
		$queryString="insert into teacher(uuid,id,name_name_name_name_name_nam) values('2','2','王老师')";
		oracl_query($queryString,$conn);
		$queryString="insert into teacher(uuid,id,name_name_name_name_name_nam) values('3','3','李老师')";
		oracl_query($queryString,$conn);

		$queryString="create table score2(uuid char(30))";
		oracl_query($queryString,$conn);
		$queryString="alter table score2 add id char(10)";
		oracl_query($queryString,$conn);
		$queryString="alter table score2 add course char(10)";
		oracl_query($queryString,$conn);
		$queryString="alter table score2 add score int";
		oracl_query($queryString,$conn);
		$queryString="alter table score2 add teacher_id char(10)";
		oracl_query($queryString,$conn);

		$queryString="comment on table score2 IS '学生成绩表2'";
		oracl_query($queryString,$conn);

		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('1','1','english','78','1')";
		oracl_query($queryString,$conn);
		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('2','1','chinese','48','2')";
		oracl_query($queryString,$conn);
		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('3','1','computer','98','3')";
		oracl_query($queryString,$conn);
		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('4','2','english','38','1')";
		oracl_query($queryString,$conn);
		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('5','2','chinese','88','2')";
		oracl_query($queryString,$conn);
		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('6','2','computer','68','3')";
		oracl_query($queryString,$conn);
		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('7','3','english','38','1')";
		oracl_query($queryString,$conn);
		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('8','3','chinese','58','2')";
		oracl_query($queryString,$conn);
		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('9','3','computer','68','3')";
		oracl_query($queryString,$conn);

		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('10','4','english','76','1')";
		oracl_query($queryString,$conn);
		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('11','4','chinese','71','2')";
		oracl_query($queryString,$conn);
		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('12','4','computer','78','3')";
		oracl_query($queryString,$conn);

		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('13','5','english','98','1')";
		oracl_query($queryString,$conn);
		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('14','5','chinese','92','2')";
		oracl_query($queryString,$conn);
		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('15','5','computer','98','3')";
		oracl_query($queryString,$conn);


		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('16','6','english','88','1')";
		oracl_query($queryString,$conn);
		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('17','6','chinese','82','2')";
		oracl_query($queryString,$conn);
		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('18','6','computer','88','3')";
		oracl_query($queryString,$conn);


		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('19','7','english','45','1')";
		oracl_query($queryString,$conn);
		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('20','7','chinese','71','2')";
		oracl_query($queryString,$conn);
		$queryString="insert into score2(uuid,id,course,score,teacher_id) values('21','7','computer','83','3')";
		oracl_query($queryString,$conn);



	}
}
function oracl_query($queryString,$conn){
	//global $conn;
	$stid = oci_parse($conn, $queryString);
	oci_execute($stid);
	return $stid;
}