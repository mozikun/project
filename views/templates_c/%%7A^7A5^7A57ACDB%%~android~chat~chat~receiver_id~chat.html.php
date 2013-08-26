<?php /* Smarty version 2.6.14, created on 2013-08-26 17:20:01
         compiled from chat.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="translated-ltr"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/chat.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<body class="body">
<div id="content">
  <div id="chatbox">
    <div id="chatwnd">
      <h3><font><font><?php echo $this->_tpl_vars['title']; ?>
</font></font></h3>
      <div id="talked"><font id="f">正在加载最新的聊天记录...</font>
	  </div>
      <div id="chatinput" onclick="$(&#39;#sms&#39;).focus();return false">
      <textarea class="in" name="send_content" id="send_content" type="text"></textarea>
      <font>
	  <div id="chatinput" onclick="$(&#39;#sms&#39;).focus();return false"><font>
      </font>
	  </div>
	  </font>
	  <input class="send" type="button" id="send" value="发送">
	  <div class="clear"></div>
       </div>
    </div>
  </div>
</div>
<script type='text/javascript'>
	$("#talked").height($(window).height()-110);
	$("#talked").width($(window).width()-26);
	$("#send_content").width($(window).width()-100);
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#send").click(function(){
			var content=$("#send_content").serialize();
			var receiver_id=$("#receiver_id").val();
			//禁止发送空内容
			if($("#send_content").val()==""){
				$("#send_content").html("发送内容不能为空...");
				setTimeout("clear()",1000);
				return false;
			}
			//加入聊天窗口
			var mydate = new Date();
			var date=mydate.toLocaleDateString(); //获取当前日期
			var mytime=mydate.toLocaleTimeString(); //获取当前时间
			mydate.toLocaleString( ); //获取日期与时间
			$("#talked").append(" <div class='systemitem'>我:<span class='time_tag'><font>"+date+"&nbsp"+mytime+"</font></span><br><span>"+$("#send_content").val()+"</span></div>");
			
			$.post("<?php echo $this->_tpl_vars['basePath']; ?>
android/chat/send/receiver_id/<?php echo $this->_tpl_vars['receiver_id']; ?>
/sender_id/<?php echo $this->_tpl_vars['sender_id']; ?>
",content,function(info){
				//alert(info);
			});
			
			scrollToBottom();
			//发送成功，清空输入框内容
			$("#send_content").attr("value","")
		});
		
	});
	
//滚动条在最下方
 function scrollToBottom() {
            //var scrollTop = $("#talked")[0].scrollHeight;
            $("#talked").scrollTop(5000);
        }

//实时刷新聊天信息		
 setInterval("getinfo('<?php echo $this->_tpl_vars['receiver_id']; ?>
')",3000)
 function getinfo(receiver_id){
	$.get("<?php echo $this->_tpl_vars['basePath']; ?>
android/chat/getinfo/receiver_id/"+receiver_id+"/sender_id/"+"<?php echo $this->_tpl_vars['sender_id']; ?>
",function(info){
		$("#talked").html(info);
		scrollToBottom();
	});
	
 }
 
 function clear(){
	$("#send_content").html("");
 }
</script>
</body>
</html>