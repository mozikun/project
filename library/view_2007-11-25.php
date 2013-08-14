<?php
require_once(__SITEROOT."library/view_abstract.php");

/**
 * view class 
 * The main function of view is to replace the paramenter from .html and display it 
 *
 */
class view implements view_abstract 
{
	/**
	 * 用户在界面层定义的动态成员变量 形式如 $view->name... 全部存储到数组中　
	 *
	 * @var unknown_type
	 */
	private $view_variable=array();
	/**
	 * 表现层文件所在的路径
	 *
	 * @var unknown_type
	 */
	public $view_path='';
	/**
	 * 左右边界
	 *
	 * @var unknown_type
	 */
	private $left_delimiter='!--{$';
	private $right_delimiter='}--';
	/**
	 * 确保指定的路径是以/结尾
	 *
	 * @param string $view_path
	 */
	private function check_view_path()
	{
		//确保指定的路径是以/结尾
		if(substr($this->view_path, -1)=='/')
		{
		}
		else 
		{
			$error_message=urlencode('设置视图路径的结尾必须加上/，程序无法执行');
			router::redirect('/controller/index_controller.php/action=error/error_message/'.$error_message);
			exit();
		}
 
	}
	public function display($html)
	{
		//$file=$this->view_path.'/'.$html;

		$this->check_view_path();
		//形成表现层文件的全路径
		$view_file=__SITEROOT.$this->view_path.$html;
		$fp=fopen($view_file,'r+');
		//如果指定的网页不存在，则报错
		if(!$fp)
		{
			//echo "error";
			require_once(__SITEROOT."library/router.php");
			$error_message=urlencode('没有指定正确的视图:'.$this->view_path.$html.'，程序无法执行');
			//router::redirect('/controller/index_controller.php?action=error&error_message='.$error_message);
			router::redirect('/default/index/error/error_message/'.$error_message);
			exit();
		}
		//echo filesize($view_file);
		$view=fread($fp,filesize($view_file));
		fclose($fp);
		//提取超链接的正则
		//$a="<a href='xxx'>xxx</a>dddd<a href='yyy'>yyy</a>dddd<a href='kkk'>kkk</a>";
		//preg_match_all('/<a.*?<\/a>/', $a,$match); //表示以<a开头，后接任意长度任意字符.* ?表示仅一次　然后用 <\/a>结束的字串
		//var_dump($match);

		/**
		 * 原理简介
		 * $a="<table vorder='1'>
		!--{section name=list1}--
		  <tr class='dd'>
		    <td>!--{list1.name}--</td>
		    <td>!--{list1.sex}--</td>
		  </tr>
		  !--{/section}--
		  
		!--{section name=list2}--
		  <tr class='dffd'>
		    <td>!--{list2.name}--</td>
		    <td>!--{list2.sex}--</td>
		  </tr>
		  !--{/section}--
		  </table>
		  ";
		  １。preg_match_all('/\!--\{section[\s\S]*?!--\{\/section\}--/', $view,$match,PREG_SET_ORDER);
			结果：将块（section）取出存入数组match中 [\s\S]表示取所有空或非空的字符，不能用.* 因为取不出 回车符 ?表示匹配０或１次
			因为一个view中可能有多个块，用上述方法可分别取出，存放在$match数组中。
			注意var_dump($match);时看不到<tr> <td>等是正常的，要在源文件里看到完整的$match的内容
	    　２。preg_match_all('/name=(.*)?\}--/', $section_pattern,$match1,PREG_SET_ORDER); //表示以<a开头，后接任意长度任意字符.* ?表示仅一次　然后用 <\/a>结束的字串
            结果：在第一步的结果集中取　块(section)的名字。如list1 list2等
　　　     ３。preg_match_all('/<tr.*?>/', $section_pattern,$match2,PREG_SET_ORDER); //表示以<a开头，后接任意长度任意字符.* ?表示仅一次　然后用 <\/a>结束的字串
			结果：在第一步的结果集中取tr的构成，主要是取tr的定义及其样式定义
 		  ４。$temp_pattern="/<td>\!--\{".$match1['0']['1'].".(.*)?\}--<\/td>/";
			preg_match_all($temp_pattern, $section_pattern,$match3,PREG_SET_ORDER); //表示以<a开头，后接任意长度任意字符.* ?表示仅一次　然后用 <\/a>结束的字串
          	结果：取td中定义的列（字段）
		  ５。	$rows=$this->$section_name;
			结果：按块名取出数据　在运行过程中相当于 $rows=$this->list1 list1是一个数组形式的成员变量，在控制器中生成的(参见控制器中的$view->list1=$temp_array);，生成的格式如下
				$view->list1=array("0"=>array("name"=>"mike","sex"=>"12"),"1"=>array("name"=>"rose","sex"=>"14"),"2"=>array("name"=>"dd","sex"=>"4"));
				$view->list2=array("0"=>array("name"=>"tom","sex"=>"22"),"1"=>array("name"=>"lost","sex"=>"24"));
			相当于表的行记录集
			$rows=$this->$section_name 是通过__get方法来实现的
		  ６。按行进行外循环	for($ii=0;$ii<count($rows);$ii++)
		  ７。按列进行内循环　for($iii=0;$iii<count($match3);$iii++)
          	*/
		
		//以下代码的原理请参见view_bak.php
		preg_match_all('/\!--\{section[\s\S]*?\!--\{\/section\}--/', $view,$match,PREG_SET_ORDER); //表示以<a开头，后接任意长度任意字符.* ?表示仅一次　然后用 <\/a>结束的字串
		//count($match)为块数,根据块数进行循环
		for($i=0;$i<count($match);$i++)
		{
			foreach ($match[$i] as $key=>$section)
			{
				//$section为完整的一块，要显示$section的内容必须加htmlentities
				//echo htmlentities($section)."<br>";
				//取块名字
				preg_match_all('/name=(.*?)\}--/', $section,$match1,PREG_SET_ORDER); //
				$section_name=$match1['0']['1'];
				//取tr
				preg_match_all('/<tr[\s\S]*?\<\/tr>/', $section,$match2,PREG_SET_ORDER); //
				//var_dump($match2);
				$section_tr=$match2['0']['0'];
				//echo htmlentities($section_tr)."<br>";

				//取每行中　形如!--{list1.name}--的数据，表的每一行由多个!--{list1.name}--,!--{list1.age}--组成的td
				$temp_pattern="/\!--\{".$section_name."\.(.*?)\}--/";//形成模板
				preg_match_all($temp_pattern, $section,$match3,PREG_SET_ORDER); //
				
				//通过正则替换形成完成的setion
				//$row是一个数组变量　$this->$section_name中的值来自控制器相应的action
				$rows=$this->$section_name;
				$tr="";
				//按有多少条记录进行循环
				for($ii=0;$ii<count($rows);$ii++)
				{
					//按有多少个在列表table中要出现的字段{列}进行循环　即按　<td>!--{list1.name}--</td>　<td>!--{list1.age}--</td>　<td>!--{list1.marriage}--</td>　循环，每个td循环一次
					//echo count($match3);
					//将前面取出的tr串放进$temp_tr，不能直接使用$section_tr，因为$temp_tr在每一行中都要作为原始的行进行替换
					$temp_tr=$section_tr;
					for($iii=0;$iii<count($match3);$iii++)
					{
/*
替换前
$temp_tr="					<tr>
						<td><a href="#">!--{list1.name}--</a><font color="red">!--{list1.school}--</font></td>
						<td>!--{list1.age}--</td>
						<td>!--{list1.marriage}--</td>
						</tr>
	"					
替换后
$temp_tr="					<tr>
						<td><a href="#">!mike</a><font color="red">!大专</font></td>
						<td>１２</td>
						<td>已婚</td>
						</tr>
	"					
*/
						$filed_pattern=$temp_pattern="/\!--\{".$section_name."\.".$match3[$iii]['1']."\}--/";
						$filed_name=$match3[$iii]['1'];
						$temp_tr=preg_replace($filed_pattern,$rows[$ii][$filed_name],$temp_tr);
					}
					$tr=$tr.$temp_tr;
				}
				$view=str_replace($section,$tr,$view);
			}
		}

		foreach ($this->view_variable as $key=>$value)
		{
			//形成形如!--{$name}--的形式进行替换
			$pattern=$this->left_delimiter.$key.$this->right_delimiter;
			//$view=ereg_replace($pattern,$value,$view);
			$view=str_replace($pattern,$value,$view);
		}
		echo $view;
		
	}
	private function show_variable()
	{
		//$var=get_class_vars(__CLASS__);//可用于模层
		foreach ($this->view_variable as $key=>$value)
		{
			echo $key."->".$value."<br>";
		}
	}
	private function __get($para_key)
	{
		foreach ($this->view_variable as $key=>$value)
		{
			//形成形如!--{$name}--的形式进行替换
			//echo $value;
			if($key==$para_key)
			{
				return $value;
			}
		}
//exit();
		
	}
	private function __set($key,$value)
	{
		$temp=array($key=>$value);
		$this->view_variable=array_merge($temp,$this->view_variable);
		/**
		 * 当用户使用了如下操作 $view->name="mike"，而类里面又没有定义这个name成员变量时就要用到__get方法
		 * 把获取的key=>value放进数组view_variable中，在display中切分这处数据来重新获取键与值。
		 */
	}
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $name//控件名称,基本上就是字段名
	 * @param unknown_type $view
	 * @param unknown_type $select_box
	 * @param unknown_type $current_value
	 */
	public function select_box($name,$view,$select_box,$current_value)
	{
		$i=0;
		foreach ($select_box as $key=>$value)
		{
			$temp_name=$name."_".$i;
			if($key==$current_value)
			{
				$view->$temp_name="selected";
			}
			$view->$temp_name='';
			$i++;
		}
		//var_dump($this->view_variable);
	}
	public function select_option($name,$view,$select_box,$current_value)
	{
		if(empty($current_value))
		{
			$current_value='0';
		}
		$option='';
		foreach ($select_box as $value=>$text)
		{
			if($value==$current_value)
			{
				$option=$option."<option value='".$value."' selected >".$text."</option>";
			}
			else 
			{
				$option=$option."<option value='".$value."'  >".$text."</option>";
			}
		}
		$view->$name=$option;
		//var_dump($this->view_variable);
	}	

	public function radio_box($name,$view,$radio_box,$current_value)
	{
		$i=0;
		//var_dump($radio_box);
		foreach ($radio_box as $key=>$value)
		{
			$temp_name=$name."_".$i;
			if($key==$current_value)
			{
				$view->$temp_name="checked";
			}
			$view->$temp_name='';
			$i++;
		}
		//var_dump($this->view_variable);
	}

	public function check_box($name,$view,$check_box,$current_value)
	{
		//将  0|1|2|3这将的表中的存储的值拆分为数组
		$i=0;
		$current_value_array=explode("|",$current_value);
		//var_dump($current_value);
		//exit();
		foreach ($check_box as $key=>$value)
		{
			//view中框的名称是按 字段名_序号 的形式组合的
			$temp_name=$name."_".$i;
			//如果复选框的值在数组中存在并且$current_value不是一个空值（也就是用户并没有选定任何一项目时），则对复选框是否处于选中状态进行处理
			if(in_array($key,$current_value_array) and trim($current_value)!='')
			{
				$view->$temp_name="checked";
			}
			$view->$temp_name='';
			$i++;
		}
		//var_dump($this->view_variable);
	}	
}