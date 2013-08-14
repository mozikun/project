<?php
/**
 * 本模块演示5dview
 * 
 * @author www.phpchengdu.com Lake
 * @copyright 2011-10-27
 *
 */
class compatible_5dviewController extends controller {
	public function test_view2Action(){
		$this->view2->cache_time=10;

		$name='mike';
		$this->view2->assign('name',$name);
		$age=28;
		$this->view2->assign('age',$age);
		$student=array('name'=>'rose','age'=>18);
		$this->view2->assign('student',$student);

		$teacher=array('name'=>'罗维','age'=>18);
		$this->view2->assign('teacher',$teacher);

		$this->view2->assign('key','mykey');
		$students=array(
		array('name'=>'tom','sex'=>'男','occupation'=>'教师'),
		array('name'=>'mike','sex'=>'男','occupation'=>'php工程师'),
		array('name'=>'rose','sex'=>'女','occupation'=>'项目经理')
		);
		$teachers=array(
		array('name'=>'张','sex'=>'男'),
		array('name'=>'李','sex'=>'女')
		);

		$company=array(
		"department_1"=>array(
		array('name'=>'tom','sex'=>'男','occupation'=>'教师'),
		array('name'=>'mike','sex'=>'男','occupation'=>'php工程师'),
		array('name'=>'rose','sex'=>'女','occupation'=>'项目经理')),
		"department_2"=>array(
		array('name'=>'罗','sex'=>'男','occupation'=>'大哥'),
		array('name'=>'叶','sex'=>'男','occupation'=>'web工程师'),
		array('name'=>'万','sex'=>'女','occupation'=>'java项目经理')),		
		);		
		$this->view2->assign('company',$company);
		$ah = array('吃饭'=>'1','打豆豆'=>'3');
		$area = array('四川','北京','上海');
		$data = array(
		0=>array('id'=>'0','title'=>'a'),
		1=>array('id'=>'1','title'=>'b'),
		2=>array('id'=>'2','title'=>'c'),
		3=>array('id'=>'3','title'=>'d'),
		);

		$this->view2->assign('a','ok');
		$this->view2->assign('b','0000');
		$this->view2->assign('sex','2');
		$this->view2->assign('ah',$ah);
		$this->view2->assign('area',$area);
		$this->view2->assign('data',$data);		
		
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

		$this->view2->assign('students',$students);
		
		$this->view2->assign('key1',true);
		$this->view2->assign('key2',false);
		
		$this->view2->display('view.html');
		

				
		
		
		
	}

	public function test_view1Action() {
		//include __SITEROOT.'/config/config_5dview.php';

		//$this->view1->template_dir=dirname(dirname(__FILE__)).'/views/scripts/'.$this->getControllerName();

		$ah = array('吃饭'=>'1','打豆豆'=>'3');
		$area = array('四川','北京','上海');
		$data = array(
		0=>array('id'=>'0','title'=>'a'),
		1=>array('id'=>'1','title'=>'b'),
		2=>array('id'=>'2','title'=>'c'),
		3=>array('id'=>'3','title'=>'d'),
		);

		$this->view1->assign('a','ok');
		$this->view1->assign('b','0000');
		$this->view1->assign('sex','2');
		$this->view1->assign('ah',$ah);
		$this->view1->assign('area',$area);
		$this->view1->assign('data',$data);
		$this->view1->assign('root_path',dirname(__FILE__));
		$students=array(
		array('name'=>'tom','sex'=>'男','occupation'=>'教师'),
		array('name'=>'mike','sex'=>'男','occupation'=>'php工程师'),
		array('name'=>'rose','sex'=>'女','occupation'=>'项目经理')
		);
		$this->view1->assign('data',$data);
		//列表 基于数组
		$this->view1->assign('students',$students);
		$array=array('name'=>'lg','age'=>'18');
		$this->view1->assign('name','luo');
		$this->view1->assign('one',$array);
		$this->view1->assign('value','---------value----------');
		$this->view1->display('index.html');
	}
}