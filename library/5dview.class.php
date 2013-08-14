<?php

class v {

	private $_data;
	private $template;
	private $cache_path;
	private $foreach_in;//当前是否在处理循环内的值，如果是循环内的值，则foreach里的变量替换方式不一样。
	private $foreach_k_v_parm;//用于临时保存foreach中的key val值
	private $foreachelse_in;//记录当前用户是否使用了foreachelse
	private $foreachelse_tmp;//用于临时保存tmp的值，当出现foreachelse子句时有效
	private $foreachelse_code;//用于临时保存离foreachelse最近的foreach，在他之前插入if子句
	public $template_dir;
	public $compile_dir;
	public $left_delimiter;
	public $right_delimiter;
	public $view_path;

	public function __construct($parm = array()) {

		$this->cache_path = empty($parm['cache_path']) ? '' : $parm['cache_path'];
		/**
		 * foreach嵌套的情况，所以定义为数组
		 * 当进入第一层foreach时，foreach_in=array(true)
		 * 第二层时,foreach_in=array(true,true)
		 * 退出第一层时,foreach_in=array(true)
		 * 退出第二层时,foreach_in=array()
		 */
		$this->foreach_in=array();
		$this->foreach_k_v_parm=array();
		$this->left_delimiter="<!--{";
		$this->right_delimiter="}-->";
	}

	public function assign ( $name, $value = '' ) {

		if (is_array($name)) {
			foreach ($name as $k => $v) {
				$this->_data[$k]  =  $v;
			}
		}else {
			$this->_data[$name]  =  $value;
		}
	}

	public function display ($path) {
		$htmlPath = $this->template_dir.'/'.$path;
		$tempCPath = $this->compile_dir.'/'.basename($path,'.html').md5($htmlPath).'.php';
		//如果模板文件最后更新时间 大于 标签替换后的文件，则后新生成一次
		if(!is_file($tempCPath) || filemtime($htmlPath)>=filemtime($tempCPath)) {
			$this->template=file_get_contents($htmlPath);
			preg_match_all('~'.$this->left_delimiter.'([^\}\{\n]*)'.$this->right_delimiter.'~i',$this->template,$var);
/*			echo "<pre>";
			var_dump($var);
			echo "</pre>";*/
			//如果没有标签可替换
			if(empty($var['0']['0'])) {
//				return $this->template;
			}else 
			array_walk($var['1'],array($this,'format'));
			file_put_contents($tempCPath,$this->template);
		}
		include $tempCPath;
	}

	private function format($item,$key) {
		$item = empty($item) ? ' ' : $item;
		switch (trim($item{0})) {
			case '':
				$this->template = str_replace($this->left_delimiter.$this->right_delimiter,'',$this->template);
				break;
			case '$':
				$code = $this -> getVal($item);
				$preg = '~'.addcslashes($this->left_delimiter,'{').addcslashes($item,'$[]').addcslashes($this->right_delimiter,'}').'~is';
				$this->template = preg_replace($preg,$code,$this->template,1);
				break;
			case '/':
				//当最到foreach结束时，应当删除临时变量里的值，为去除foreach状态
				if(strpos($item,'foreach')) {
					!empty($this->foreach_k_v_parm) && array_pop($this->foreach_k_v_parm);
					!empty($this->foreach_k_v_parm) && array_pop($this->foreach_k_v_parm);
					!empty($this->foreach_in) && array_pop($this->foreach_in);
					!empty($this->foreachelse_code) && array_pop($this->foreachelse_code);
					!empty($this->foreachelse_tmp) && array_pop($this->foreachelse_tmp);
					!empty($this->foreachelse_in)  && array_pop($this->foreachelse_in);
				}
				$code = '<?php }?>';
				$this->template = str_replace($this->left_delimiter.$item.$this->right_delimiter,$code,$this->template);
				break;
			default:
				//去除等号左右空格
				$itemCache = $this->delDK($item);
				//以空格分解<!--{}-->里的内容
				$tagAll = explode(' ',$itemCache);
				$tag = array_shift($tagAll);
				switch ($tag) {
					case 'if':
						$code = $this -> _formatIfCode($tagAll);
						$this->template = str_replace($this->left_delimiter.$item.$this->right_delimiter,$code,$this->template);
						break;
					case 'elseif':
						$code = $this -> _formatElseifCode($tagAll);
						$this->template = str_replace($this->left_delimiter.$item.$this->right_delimiter,$code,$this->template);
						break;
					case 'foreach':
						$this->foreach_in[]=true;
						$code = $this->_formatForeachCode($tagAll);
						$this->template = str_replace($this->left_delimiter.$item.$this->right_delimiter,$code,$this->template);
						break;
					case 'foreachelse':
						$code = $this->_formatForeachelseCode($tagAll);
						$this->template = str_replace($this->left_delimiter.$item.$this->right_delimiter,$code,$this->template);
						break;
				}
				break;
		}
	}

	//获取$单值
	private function getVal($val) {

		//当前变量是否在foreach内
		$parm = '';
		if( strpos($val,'[') ) {
			preg_match_all('~\[(.*?)\]~',$val,$arrVal);
//			var_dump($arrVal);
			$val = preg_replace('~\[(.*?)\]~','',$val);
			foreach ( $arrVal['1'] as $v ) {
				$this->replaceBL($v);
				$v=preg_replace('~\'|"~','',$v);
				$parm .= '["'.$v.'"]';
			}
		}
		
		//		var_dump($val);
		if(!empty($this->foreach_in) && in_array(true,$this->foreach_in) && in_array(str_replace('$','',$val),$this->foreach_k_v_parm)) {
			//如果当前在foreach循环内，又如果当前单值为循环内的值，则不替换
		}else {
			$this->replaceBL($val);
		}
		
		return '<?php echo '.$val.$parm.';?>';
	}

	/**
	 * 格式化IF标签
	 * if $a=1
	 * if $a=1 && $b=1
	 */
	private function _formatIfCode($tabAll) {
		//分解串中的变量，并将标签变量替换
		array_walk($tabAll,array($this,'replaceBL'));
		return '<?php if('.implode(' ',$tabAll).') {?>';
	}
	/**
	 * 格式化ELSEIF标签
	 * elseif $a==1
	 * elseif $a==1 && $bb=2
	 */
	private function _formatElseifCode($tabAll) {
		//分解串中的变量，并将标签变量替换
		array_walk($tabAll,array($this,'replaceBL'));
		return '<?php }elseif('.implode(' ',$tabAll).'){?>';
	}

	/**
	 * 格式化foreach标签
	 * <!--{foreach key=k item=v from=$data}--><?php foreach ($data as $key => $val){?>
	 */
	private function _formatForeachCode($tabAll) {
		$key = '';
		$val = '';
		$data_array = '';
		foreach ($tabAll as $tab) {
			list($k,$v) = explode('=',$tab);
			$k == 'key' && $key = $v;
			$k == 'item' && $val = $v;
			$k == 'from' && $data_array = $v;
		}
		//如果只想使用下标或值，另一个值自动赋值
		!$key && $key='key';
		//!$val && $key='val';
		!$val && $val='val';
		if(!empty($this->foreach_in['1'])) {
			//如果foreach_in的下标1有值，表示，当前foreach为内嵌foreach,tmp值不处理
		}else {
			$data_array && $this->replaceBL($data_array);
		}
		//最近一次的foreach $tmp值。保存下来,用于添加if语句时的变量。
		$this->foreachelse_tmp[]=$data_array;
		$foreachStr = '<?php foreach('.$data_array.' as $'.$key.'=>$'.$val.'){?>';
		//将值保存到临时变量中。
		$this->foreach_k_v_parm[]=$key;
		$this->foreach_k_v_parm[]=$val;
		unset($key);
		unset($val);
		unset($data_array);
		//保存foreachStr，用于当出现foreachelse时，在他之前插入if子句
		$this->foreachelse_code[]=$foreachStr;
		return $foreachStr;
	}

	/**
	 * 格式化foreachelse标签
	 */
	private function _formatForeachelseCode() {
		//记录当前是否使用过foreachelse，如果使用，则foreach结束时应多一个if的结否符号}
		$this->foreachelse_in[]=true;
		if( !empty($this->foreachelse_tmp['0']) && !empty($this->foreachelse_code['0']) ) {
			//弹出最后一组数据 code tmp
			$tmp = array_pop($this->foreachelse_tmp);
			$code = array_pop($this->foreachelse_code);
			$code_if = '<?php if(!empty('.$tmp.') && is_array('.$tmp.')){?>'.$code;
			$this->template = str_replace($code,$code_if,$this->template);
		}
		return '<?php }}else{?>';
	}

	//去除比较去算符左右的空格
	private function delDK($item) {
		$item = preg_replace(array('~\s+(=|==|===|!=|<>|!==|<|>|<=|>=)~','~(=|==|===|!=|<>|!==|<|>|<=|>=)\s+~'),'\\1',$item);
		return $item;
	}
	//将模板变量转换为程序变量
	private function replaceBL(&$val) {
		preg_match_all('~\$(\w*)~i',$val,$var);
		if(empty($var['0']['0'])) {
			return false;
		}else {
			foreach ($var['1'] as $v) {
				if(!empty($this->foreach_in) && in_array(true,$this->foreach_in) && in_array($v,$this->foreach_k_v_parm)) {
					
				}else {
					$val = str_replace('$'.$v,'$this->_data[\''.$v.'\']',$val);
				}
			}
		}
	}
}