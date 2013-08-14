<?php
/**
 * 流程：
 * 读进数组
 * 行分析，判断是否含有标签
 * 进行标签有效性检查 包括标签是否闭合 去掉多余空格
 * 开始标签替换
 * 变量型标签 分为普通变量与控制命令（foreach if）内部变量。
 * 普通变量替换成$this->_internal_data['xxx']的形式 内部变量根据实际情况进行处理
 * 生成编译后的文件
 */
class view_2{
	public $left_delimiter='';
	public $right_delimiter='';
	public $template_dir='';
	public $compile_dir='';
	//特殊路径处理
	public $compile_dir_mask='';
	public $cache_time=0;
	public $cache_dir='';
	private $_internal_data=array();
	private $_view_lable=array();
	private $_label_stack=array();
	private $_file_array=array();
	private $_foreach_counter=0;
	private $_foreach_stack=array();
	private $_if_counter=0;
	private $_if_stack=array();
	private $_current_line=null;

	public function assign($lable,$value){
		$this->_internal_data[$lable]=$value;
		return $this;
	}
	public function display($file){
		$view_file=$this->template_dir.'/'.$file;
		$compile_file=$this->compile_dir.'/compile~'.$this->compile_dir_mask.'~'.$file;
		$cache_file=$this->cache_dir.'/cache~'.$this->compile_dir_mask.'~'.$file;
		//这里应该增加对文件是否存在的判断,但从实际情况来看，除否故意，否则不可能出现，增加三次文件io效率太差
		//如果编译文件不存在或是已过期或是代码文件进行了修改
		//优化前if(!is_file($compile_file) or (filemtime($view_file)>filemtime($compile_file)) or (filemtime(__FILE__)>filemtime($compile_file))) {
		if(!$filemtime=@filemtime($compile_file) or (filemtime($view_file)>$filemtime) or (filemtime(__FILE__)>$filemtime)) {
			//下面的测试代码保留用于测试是否开始编译
			//echo "start....";
			$this->_file_array=file($view_file);
			for($i=0;$i<count($this->_file_array);$i++){
				$this->_current_line=$i;
				if($this->isLabel()){
					$this->processLabel();
				}
			}
			//array_walk($this->_file_array,array($this,'convert'));
			/*echo "<pre>";
			var_dump($this->_file_array);
			echo "</pre>";*/
			implode($this->_file_array);
			file_put_contents($compile_file,implode($this->_file_array));
		}

		$filemtime=@filemtime($cache_file);
		if($this->cache_time>0 and $filemtime and (microtime(true)-$filemtime)<=$this->cache_time){
			echo file_get_contents($cache_file);
		}elseif(($this->cache_time>0 and !$filemtime) or ($filemtime and $this->cache_time>0 and (microtime(true)-$filemtime)>$this->cache_time)){
			ob_start();
			require_once($compile_file);
			$ob_content=ob_get_contents();
			file_put_contents($cache_file,$ob_content);
			ob_end_clean();
			echo $ob_content;
		}
		if($this->cache_time==0){
			require_once($compile_file);
		}
	}
	private function processLabel(){
		//变量处理
		foreach ($this->_label_stack as $label){
			$this->covert($label);
		}
		return true;
	}
	//处理普通变量
	private function processNormalVariable($label){
		preg_match_all('~\$(\w*)~i',$label,$var_array);
		foreach ($var_array[1] as $var){
			$normal_var=true;
			//判断是否是foreach循环中的变量
			if($this->_foreach_counter>0){
				//表明处于foreach循环中,下面判断是否是foreach分解得到的变量
				$var_name=$var;
				for($i=1;$i<=$this->_foreach_counter;$i++){
					if(in_array($var_name,$this->_foreach_stack[$i])){
						//是分解高维数组得到的低维数组，则不做任何处理
						$normal_var=false;
						break;
					}
				}
			}
			if($normal_var){
				$code='$this->_internal_data[\''.$var.'\']';
				$label=str_replace('$'.$var,$code,$label);
			}
		}
		return $label;
	}
	private function removeBlank($item) {
		$item = preg_replace(array('~\s+(=|==|===|!=|<>|!==|<|>|<=|>=|\(|\))~','~(=|==|===|!=|<>|!==|<|>|<=|>=|\(|\))\s+~'),'\\1',$item);
		return $item;
	}
	private function removeWordBlank($item) {
		$item = preg_replace('~\s{2,}~',' ',$item);
		return $item;
	}	
	private function processForeach($label){
		$this->_foreach_counter=$this->_foreach_counter+1;
		//增加一个去掉多余空格的功能 有去掉数组元素为空的函数 否则出错
		$label=$this->removeBlank($label);
		$label=$this->removeWordBlank($label);
		
		//得到foreach表达式的第一次分解结果
		$foreach_array=explode(' ',$label);
		
		//得到foreach表达式的第二次分解结果 得到数据变量
		$foreach_var_array=explode('(',$foreach_array[0]);
		//判断foreach变量值的来源<!--{foreach($students as $key=>$student)}-->，有可能来自主程序定义的变量，也有可能来自分解后得到的变量
		if($this->_foreach_counter-1==0){
			//已是顶层，则变量值肯定来源于主程序，所以其值来自于$this->_internal_data
			$var_name=substr($foreach_var_array[1],1,strlen($foreach_var_array[1])-1);
			$foreach_var_array[1]='$this->_internal_data[\''.$var_name.'\']';
		}
		if($this->_foreach_counter-1>0){
			//非顶层，则数据来源于上级分解的结果，但也要分析，有可能出现另一个顶层循环
			//看其上级是否存在相应的分解变量
			$var_name=substr($foreach_var_array[1],1,strlen($foreach_var_array[1])-1);
			if(in_array($var_name,$this->_foreach_stack[$this->_foreach_counter-1])){
				//是上级分解得到的变量
			}else{
				//一个新的循环的开始
				$var_name=substr($foreach_var_array[1],1,strlen($foreach_var_array[1])-1);
				$foreach_var_array[1]='$this->_internal_data[\''.$var_name.'\']';
			}
		}
		//去掉最后的括号
		$foreach_array[2]=rtrim($foreach_array[2],')');
		//是$key=>$value形式
		if(strpos($foreach_array[2],'=>')){
			$key_value_array=explode('=>',$foreach_array[2]);
			$key_name=substr($key_value_array[0],1,strlen($key_value_array[0])-1);
			$var_name=substr($key_value_array[1],1,strlen($key_value_array[1])-1);
			//把得到的key与value的变量名存入堆中
			$this->_foreach_stack[$this->_foreach_counter]=array($key_name,$var_name);
		}else{//仅$value 形式
			$var_name=substr($foreach_array[2],1,strlen($foreach_array[2])-1);
			$this->_foreach_stack[$this->_foreach_counter]=array($var_name);
		}
		$foreach_var_array[]=$foreach_array[2];
		return $foreach_var_array;
	}
	private function covert($label){
		$line_number=$this->_current_line;
		//变量处理
		if(substr($label,0,1)=='$'){
			$code='<?php echo '.$this->processNormalVariable($label).';?>';
			$this->_file_array[$line_number]=str_replace($this->left_delimiter.$label.$this->right_delimiter,$code,$this->_file_array[$line_number]);
		}
		//处理foreach
		if(substr($label,0,7)=='foreach'){
			//***
			$foreach_var_array=$this->processForeach($label);
			$code='<?php '.$foreach_var_array[0].'('.$foreach_var_array[1].' as '.$foreach_var_array[2].'){ ?>';
			$this->_file_array[$line_number]=str_replace($this->left_delimiter.$label.$this->right_delimiter,$code,$this->_file_array[$line_number]);
		}
		if(substr($label,0,8)=='/foreach'){
			unset($this->_foreach_stack[$this->_foreach_counter]);
			$this->_foreach_counter=$this->_foreach_counter-1;
			$code='<?php } ?>';
			$this->_file_array[$line_number]=str_replace($this->left_delimiter.$label.$this->right_delimiter,$code,$this->_file_array[$line_number]);
		}
		//<!--{if($a>10 or $b>20 and())}-->
		//处理if
		if(substr($label,0,2)=='if'){
			$code='<?php '.$this->processNormalVariable($label).' {?>';
			$this->_file_array[$line_number]=str_replace($this->left_delimiter.$label.$this->right_delimiter,$code,$this->_file_array[$line_number]);
		}
		if(substr($label,0,3)=='/if'){
			$code='<?php } ?>';
			$this->_file_array[$line_number]=str_replace($this->left_delimiter.$label.$this->right_delimiter,$code,$this->_file_array[$line_number]);
		}
		if(substr($label,0,4)=='else'){
			$code='<?php }else{ ?>';
			$this->_file_array[$line_number]=str_replace($this->left_delimiter.$label.$this->right_delimiter,$code,$this->_file_array[$line_number]);
		}
		return ;
	}
	/**
	 * 判断一行代码是否含有标签
	 * 并对标签是否闭合，行是否含有多余的空格进行处理(待补充)
	 *
	 * @return unknown
	 */
	private function isLabel(){
		//当前行
		$line_number=$this->_current_line;
		//判断是否含有标签
		$preg='~'.$this->left_delimiter.'([^\}\{\n]*)'.$this->right_delimiter.'~i';
		preg_match_all($preg,$this->_file_array[$line_number],$labels);
		if(empty($labels[0][0])){
			return false;
		}else{
			/*保留用于调试
			echo "<pre>";
			var_dump($labels);
			echo "</pre>";*/
			//将得到的标签放到标签堆栈里
			$this->_label_stack=$labels[1];
			return true;
		}
	}
	private function convertToPHPCode($element){

	}
}