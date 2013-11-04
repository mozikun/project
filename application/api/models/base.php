<?php
class base{
	//信息返回方法
	/*	返回接口操作成功信息
	 *	 参数：msg 提示信息 other_info 其它返回信息
	 *	 返回值:执行成功的提示信息
	 */	
	public function api_success($msg,$other_info=""){
		$message="<?xml version='1.0' encoding='UTF-8'?>
		<message>
			<code>1</code>
			<info>$msg</info>
			$other_info	
		</message>";
		return  $message;
	}
	/*	返回接口操作失败信息信息
	 *	 参数：msg 提示信息
	 *	 返回值:失败的提示信息
	 */	
	public function api_failure($msg){
		$message="<?xml version='1.0' encoding='UTF-8'?>
		<message>
			<code>2</code>
			<info>$msg</info>	
		</message>";
		return  $message;
	}
}