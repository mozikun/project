<?php
/**
 * 本模块演示myMVC 的db与pearDB的之间的兼容性
 * 此模块的运行需要student数据库中的student score1 score2表的支持
 * http://localhost:8088/compatible/data/test
 * @author www.phpchengdu.com 罗维
 *
 */
class compatible_dataController extends controller {
	//不读取数据表的空动作
	public function list1Action(){
		require_once __SITEROOT."library/Models/individual_core.php";
		$individual=new Tindividual_core();
		$individual->limit(0,100);
		$individual->find();
		$record='';
		while ($individual->fetch()){
			//echo $individual->name;
			//$individual->toArray();
		}
	}
	//读取数据表的动作
	public function list2Action(){
		mysql_pconnect("localhost","root","root");
		mysql_query("use student");
		mysql_query("set names utf8");
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
		$student=new TStudent();
		$student->query('set names utf8');
		//获取数据
		$student->find();
		while ($student->fetch()){
			//$smarty->assign('name',$student->name);
			//echo $student->name."&nbsp";
			//echo "<br>";
		}
	}
	public function testAction(){
		//引入本页面中用到的表对象定义文件
		require_once(__SITEROOT.'model/student.php');
		require_once(__SITEROOT.'model/score1.php');
		require_once(__SITEROOT.'model/score2.php');
		echo "<br><b>演示从表中读取所有数据列表</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		//$student->query('set names utf8');
		//获取数据
		$student->find();
		while ($student->fetch()){
			//$smarty->assign('name',$student->name);
			echo $student->name."&nbsp";
			echo $student->class."&nbsp";
			echo $student->gender."&nbsp";
			echo "<br>";
		}
		echo "<br><b>演示从表中读取男生数据列表</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$student->query('set names utf8');
		//选择运算
		$student->whereAdd("gender='男'");
		//获取数据
		$student->find();
		while ($student->fetch())
		{
			echo $student->name."&nbsp";
			echo $student->class."&nbsp";
			echo $student->gender."&nbsp";
			echo "<br>";
		}

		echo "<br><b>演示从表中读取一条记录的处理方法之whereAdd</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$student->query('set names utf8');
		$student->whereAdd("id='10'");
		//获取数据
		$student->find(true);
		echo $student->id."&nbsp";
		echo $student->name."&nbsp";
		echo $student->class."&nbsp";
		echo $student->gender."&nbsp";
		echo "<br>";

		echo "<br><b>演示从表中读取演示从表中取前二条数据列表 </b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$student->query('set names utf8');
		//指定要获取数据的起始位置与数量
		$student->limit(0,2);
		//获取数据
		$student->find();
		while ($student->fetch())
		{
			echo $student->name."&nbsp";
			echo $student->class."&nbsp";
			echo $student->gender."&nbsp";
			echo "<br>";
		}

		echo "<br><b>演示统计表中的记录数</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$student->query('set names utf8');
		//获取数据
		$student->whereAdd("gender='男'");
		echo $student->count();
		echo "<br />";

		echo "<br><b>演示从表中读取不重复的班级名称 </b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$student->query('set names utf8');
		$student->selectAdd();
		$student->selectAdd("distinct class as distinct_class,gender as distinct_gender");
		//获取数据
		//$student->debugLevel(9);
		$student->find();
		//$student->debugLevel(0);
		while ($student->fetch()){
			echo $student->distinct_class."&nbsp";
			echo $student->distinct_gender."&nbsp";
			echo "<br>";
		}
		echo "<br><b>演示分组统计每班人数</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$student->query('set names utf8');
		$student->groupBy('class');
		//$student->count('*');
		$student->selectAdd();
		//$student->selectAdd("count(*) as classperson,class");
		//$student->selectAdd("max(birthday) as oldperson,class");
		//$student->groupby_columns_define("max(birthday) as oldperson,class as class1");
		//$student->groupby_columns_define("max(birthday) as oldperson,class");
		$student->selectAdd("max(birthday) as oldperson,class");

		//获取数据
		//$student->debugLevel(9);
		$student->find();
		//$student->debugLevel(0);
		while ($student->fetch())
		{
			//echo $student->class1."&nbsp";
			echo $student->class."&nbsp";
			//echo $student->classperson."&nbsp";
			echo date("Y-m-d",$student->oldperson)."&nbsp";
			//echo $student->name."&nbsp";
			echo "<br>";
		}

		echo "<br><b>演示一对一多表关联的数据读取</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		//$student->query('set names utf8');
		//myMVC的标准方法
		//$table1->joinAdd(array(‘table1的关联字段’,’table2表名:table2的关联字段’))
		//兼容pearDB的方法
		//$student->joinAdd(array('id','score1:id'));
		//获取数据
		//$student->debugLevel(9);
		$student->find();
		//$student->debugLevel(0);
		while ($student->fetch()){
			echo $student->name."&nbsp";
			echo $student->class."&nbsp";
			echo $student->gender."&nbsp";
			echo $student->english."&nbsp";
			echo $student->chinese."&nbsp";
			echo $student->computer."&nbsp";
			echo "<br>";
		}
		echo "<br><b>演示一对一三表情况下的多表关联的数据读取</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$student->query('set names utf8');
		//$table1->joinAdd(array(‘table1的关联字段’,’table2表名:table2的关联字段’))
		$student->joinAdd(array('id','score1:id'));
		$student->joinAdd(array('id','score2:id'));
		//获取数据
		//$student->debugLevel(9);
		$student->find();
		//$student->debugLevel(0);
		while ($student->fetch())
		{
			echo $student->name."&nbsp";
			echo $student->class."&nbsp";
			echo $student->gender."&nbsp";
			echo $student->english."&nbsp";
			echo $student->chinese."&nbsp";
			echo $student->computer."&nbsp";
			echo $student->course."&nbsp";
			echo $student->score;
			echo "<br>";
		}

		echo "<br><b>演示更新记录方法二:使用whereAdd</b><br>";
		//实例化一个表对象
		$student=new TStudent();
		$student->query('set names utf8');
		$student->whereAdd("uuid='10'");//注意这句
		$student->name='新人10';
		//修改记录
		//$student->update();
		echo "<br>";
	}
}