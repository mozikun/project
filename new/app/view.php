<?php
$s=microtime(true);
require_once("../lib/5dview.class.php");

$view=new view();
$view->left_delimiter='<!--{';
$view->right_delimiter='}-->';
//统一目录写法
$view->template_dir='../template/';
$view->compile_dir='../template_c/';

$name='mike';
$view->assign('name',$name);
$age=28;
$view->assign('age',$age);
$student=array('name'=>'rose','age'=>18);
$view->assign('student',$student);

$teacher=array('name'=>'罗维','age'=>18);
$view->assign('teacher',$teacher);

$view->assign('key','mykey');
$students=array(
array('name'=>'tom','sex'=>'男','occupation'=>'教师'),
array('name'=>'mike','sex'=>'男','occupation'=>'php工程师'),
array('name'=>'rose','sex'=>'女','occupation'=>'项目经理')
);
$teachers=array(
array('name'=>'张','sex'=>'男'),
array('name'=>'李','sex'=>'女')
);
/*foreach ($students as $key=>$student){

	foreach ($teachers as $teacher){
		foreach ($teacher as $value){
			echo $value;
			echo "<br />";
		}
	}

	foreach ($student as $value){
		echo $value;
		echo "<br />";
	}
}
echo $student['name'];*/

$view->assign('students',$students);
$view->display('view.html');
echo microtime(true)-$s;
