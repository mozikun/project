<?php /* Smarty version 2.6.14, created on 2013-09-05 11:13:36
         compiled from ./register.html */ ?>
<style>
 #tips{
	border:10px solid rgb(55,119,188);    
	overflow:auto;
    text-align:left;
    padding:6px;  
	background-color:rgb(255,255,255);
    word-wrap: break-word;
    position:absolute;
    z-index:99;
	color: #005EAC;
	padding:20px;
	
    display:none;    /*使div初始化时隐藏*/
 }
 #tips li{
	width:180px;
	float:left;
	list-style-type : disc;
	padding:2px;
	cursor: pointer;
 }
 
 
 
</style>		


	  <div class="bm_right notright">
            <div class="bv_title"> <span><i><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_12.png" width="25" height="26"></i>预约挂号</span> </div>
            <div class="bv_conts">      
			<form id="form2" action="#">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bv_tbs">
                  <tbody>
                    <tr>
                      <td width="29%" align="right">预约时间：</td>
                      <td width="71%"><input type="text" name="" class="bv_text"></td>
                    </tr>
                    <tr>
                      <td align="right">地区：</td>
                      <td><select class="bv_selecd">
                          <option>选择地区</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td align="right">医院：</td>
                      <td><input name="yiyuan"/></td>
                    </tr>
                    <tr>
                      <td align="right">科室：</td>
                      <td><select class="bv_text">
                          <option>请选择科室</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td align="right">医生：</td>
                      <td><input type="text" name="" class="bv_text"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="image" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_13.png"></td>
                    </tr>
                  </tbody>
                </table>
              </form>
		  </div>
          </div>
<div id="tips"></div>		  
		  
<script>
//获取医院列表
function gethospital(){
	$.ajax({
		type:"post",
		url:"<?php echo $this->_tpl_vars['basePath']; ?>
web/register/gethospital",
		beforeSend:function(){
			var input=$("input[name='yiyuan']");
			$("#tips").css("top",input.offset().top+input.height()+5+"px").css("left",input.offset().left);
			$("#tips").css("width","200px").css("height","25px").html("<img src='<?php echo $this->_tpl_vars['basePath']; ?>
views/images/load.gif'/> ").show();
		},
		dataType:"json",
		success:function(info){
			var str="";
			
			for(i=0;i<info.length;i++){   
				str+="<li class='hospital-item' hopital-id='"+info[i].id+"'>"+info[i].name+"</li>";
			}
			$("#tips").css("width","600px").css("height","300px").html("<ul>"+str+"</ul>");
			$('.hospital-item').mouseover(function(){$(this).css("background-color","rgb(0,94,172)").css("color","white");});
			$('.hospital-item').mouseout(function(){$(this).css("background-color","").css("color","#005EAC");});
		}
		
	});
}
$(document).ready(function(){
	$("input[name='yiyuan']").click(function(){
	
	 gethospital();
	});
	
	$("input[name='yiyuan']").blur(function(){
		$("#tips").hide();
	});
	
});		

sdfsfsdfsdfsdf
</script>		  