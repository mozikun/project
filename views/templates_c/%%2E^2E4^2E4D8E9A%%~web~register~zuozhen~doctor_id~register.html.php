<?php /* Smarty version 2.6.14, created on 2013-09-11 14:45:34
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
			
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bv_tbs">
                  <tbody>
                  
                    <tr>
                      <td align="right">地区：</td>
                      <td><select class="bv_selecd">
                          <option>选择地区</option>
                          <option>雅安</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td align="right">医院：</td>
                      <td><select name="yiyuan" class="bv_text"/>
						  <option>请选择医院</option>
					  </select></td>
                    </tr>
                    <tr>
                      <td align="right">科室：</td>
                      <td><select class="bv_text" name="keshi">
                          <option>请选择科室</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td align="right">医生：</td>
                      <td><select class="bv_text" name="yisheng">
                          <option>请选择医生</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input onclick="zuozhen()" type="image" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_gh.png"></td>
                    </tr>
                  </tbody>
                </table>
              
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
			var input=$("select[name='yiyuan']");
			$("#tips").css("top",input.offset().top+input.height()+5+"px").css("left",input.offset().left);
			$("#tips").css("width","150px").css("height","20px").html("<img src='<?php echo $this->_tpl_vars['basePath']; ?>
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
			$('.hospital-item').mouseout(function(){$(this).css("background-color","").css("color","#005EAC"); });
			$('.hospital-item').click(function(){
				var hospital_id=$(this).attr('hopital-id');
				var hospital_name=$(this).text();
				$("select[name='yiyuan']").html("<option>"+hospital_name+"</option>");
				
				getdepartment(hospital_id);$("#tips").hide();
			});
		}
		
	});
}

//获取科室
function getdepartment(hospital_id){
	$.ajax({
		type:"post",
		url:"<?php echo $this->_tpl_vars['basePath']; ?>
web/register/getdepartment/hospital_id/"+hospital_id,
		beforeSend:function(){
			
		},
		dataType:"json",
		success:function(info){
			var str=''; 
			for(var i=0;i<info.length;i++){
				str+="<option value='"+info[i].id+"'>"+info[i].name+"</option>";
				
			}
			$("select[name='keshi']").html(str);
			//alert(info);
		},
	});	
}		

//获取医生
function getdoctor(department_id){
	$.ajax({
		type:"post",
		url:"<?php echo $this->_tpl_vars['basePath']; ?>
web/register/getdoctor/department_id/"+department_id,
		beforeSend:function(){
			
		},
		dataType:"json",
		success:function(info){
			var str=''; 
			for(var i=0;i<info.length;i++){
				str+="<option value='"+info[i].id+"'>"+info[i].name+"</option>";
				
			}
			$("select[name='yisheng']").html(str);
			
		},
	});	
}

$(document).ready(function(){
	$("select[name='yiyuan']").click(function(){
	
	 gethospital();
	});
	$("select[name='keshi']").change(function(){
	//alert(1);
	 getdoctor($(this).val());
	});
});		
function zuozhen(){
	var doctor_id=$("select[name='yisheng']").val(); 
	window.location.href='<?php echo $this->_tpl_vars['basePath']; ?>
web/register/zuozhen/doctor_id/'+doctor_id;
}
</script>		  