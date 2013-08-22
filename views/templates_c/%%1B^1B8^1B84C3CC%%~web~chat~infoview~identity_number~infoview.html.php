<?php /* Smarty version 2.6.14, created on 2013-08-22 10:23:04
         compiled from infoview.html */ ?>

<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>		
<style>
.chat{
	width:650px;
	
}
.info_display{
	height:250px;
	border:1px solid green;
	margin-top:10px;
	overflow:auto;
}
.info_input textarea{
	width:650px;
	height:100px;
}
.tishi{
	line-height:20px;
	height:20px;
}
.btn{
	float:right;
	height:20px;
	width:100px;
	line-height:20px;
	border:1px solid rgb(220,153,33);
	background-color:rgb(220,153,33);
	margin:5px;
	text-align:center;
}

</style>
  
<div class="list_right">
	<div class="chat">
		<input type="hidden" id="fromuser" value="<?php echo $this->_tpl_vars['sender']; ?>
"/>
		<input type="hidden" id="touser" value="<?php echo $this->_tpl_vars['receiver']; ?>
"/>
		<div class="info_display">
			<ul id="tab">
				
			</ul>
		</div>
		<div class="tishi">
		请输入内容
		</div>
		<div class="info_input">
			<textarea id="info"></textarea>
			<div class="btn" >发送</div>
		</div>
	</div>
			
</div>
	

<script>

$(document).ready(function(){
	$(".btn").click(function(){
		fromuser=$("#fromuser").val();
		touser=$("#touser").val();
		info=$("#info").val();
		if(info==""){
			alert("发送内容不能为空");
			return false;
		}
		
		sendInfo(info,fromuser,touser);
		
	});
})

//发送消息
function sendInfo(info,fromuser,touser){
	$.ajax({
		type:"post",
		url:"<?php echo $this->_tpl_vars['basePath']; ?>
web/chat/send",
		data:"info="+info+"&fromuser="+fromuser+"&touser="+touser,
		
		beforeSend:function(){
			$(".tishi").html("发送中...");
			
		},
		success:function(data){
			if(data=="success"){
			$("#tab").append("<li>我："+info+"</li>");
			
			}
			else{
				alert(data);
				
			}
			$(".tishi").html("请输入内容");
			$("#info").val("");
			//alert(data);
		},
	});
	
//刷新聊天信息
function getInfo(){
	$.ajax({
		type:"post",
		url:"<?php echo $this->_tpl_vars['basePath']; ?>
web/chat/getinfo",
		data:"info="+info+"&fromuser="+fromuser+"&touser="+touser,
		datatype:"json",
		beforeSend:function(){
			
			
		},
		success:function(data){
			for(i=0;i<data.length;i++){
				
			$("#tab").append("<li>"+data.i+"</li>");
			
			}
			
		},
	});
}	
}
</script>