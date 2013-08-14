<?php /* Smarty version 2.6.14, created on 2013-05-02 11:19:46
         compiled from add.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/site.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
<link rel="stylesheet" type="text/css"  href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/default/datepicker.css"/>

<title><?php echo $this->_tpl_vars['title']; ?>
</title>

</head>
<body>
  <form name="frm" id="form" action="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/index/dictionary_add"  method="post">
            <input type="hidden" name="user_id" value="<?php echo $this->_tpl_vars['user_id']; ?>
"/>
            <input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['uuid']; ?>
"/>
            <input type="hidden"name="org_id"value="<?php echo $this->_tpl_vars['org_id']; ?>
"/>
	<table cellspacing="0" width="100%">
    <thead>
	</thead>
    <tr  class="headbg">
	<th  colspan="6">坐诊字典</th>
	</tr>
   
	<tbody id=''>
      <tr><td>医务人员</td>
      <td  colspan="5"><?php echo $this->_tpl_vars['staff_name']; ?>
 </td>
      </tr>
      
      <tr >
			<td width="81"  rowspan="7">坐诊日</td>
            <td width="67" >星期一
             <input type="checkbox" name="week[]" value="1" id="date_1" <?php $_from = $this->_tpl_vars['week']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?> <?php if ($this->_tpl_vars['v']['week'] == 1): ?>checked<?php endif; ?> <?php endforeach; endif; unset($_from); ?>>
            </td>
			<td width="53" > <input type="radio" name="time[1]" value="1"  <?php if ($this->_tpl_vars['week'][1]['time'] == 1): ?>checked<?php endif; ?>>  上午</td>   
			<td width="55"> <input type="radio" name="time[1]" value="2"  <?php if ($this->_tpl_vars['week'][1]['time'] == 2): ?>checked<?php endif; ?>>下午</td>
            <td width="58"><input type="radio" name="time[1]" value="3"   <?php if ($this->_tpl_vars['week'][1]['time'] == 3): ?>checked<?php endif; ?>>全天 </td>
            <td width="699"></td>
		</tr>
	   <tr>
            <td >星期二
             <input type="checkbox" name="week[]" value="2" id="date_2" <?php $_from = $this->_tpl_vars['week']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?> <?php if ($this->_tpl_vars['v']['week'] == 2): ?>checked<?php endif; ?> <?php endforeach; endif; unset($_from); ?>>
            </td>
			<td width="53" > <input type="radio" name="time[2]" value="1"  <?php if ($this->_tpl_vars['week'][2]['time'] == 1): ?>checked<?php endif; ?>>  上午</td>   
			<td width="55"> <input type="radio" name="time[2]" value="2"  <?php if ($this->_tpl_vars['week'][2]['time'] == 2): ?>checked<?php endif; ?>>下午</td>
            <td width="58"><input type="radio" name="time[2]" value="3"   <?php if ($this->_tpl_vars['week'][2]['time'] == 3): ?>checked<?php endif; ?>>全天 </td>
            <td>&nbsp;</td>
       </tr>
        <tr>
            <td >星期三
             <input type="checkbox" name="week[]" value="3" id="date_3" <?php $_from = $this->_tpl_vars['week']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?> <?php if ($this->_tpl_vars['v']['week'] == 3): ?>checked<?php endif; ?> <?php endforeach; endif; unset($_from); ?>>
            </td>
		    <td width="53" > <input type="radio" name="time[3]" value="1"  <?php if ($this->_tpl_vars['week'][3]['time'] == 1): ?>checked<?php endif; ?>>  上午</td>   
			<td width="55"> <input type="radio" name="time[3]" value="2"  <?php if ($this->_tpl_vars['week'][3]['time'] == 2): ?>checked<?php endif; ?>>下午</td>
            <td width="58"><input type="radio" name="time[3]" value="3"   <?php if ($this->_tpl_vars['week'][3]['time'] == 3): ?>checked<?php endif; ?>>全天 </td>
            <td>&nbsp;</td>
       </tr>
        <tr>
            <td >星期四
              <input type="checkbox" name="week[]" value="4" id="date_4" <?php $_from = $this->_tpl_vars['week']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?> <?php if ($this->_tpl_vars['v']['week'] == 4): ?>checked<?php endif; ?> <?php endforeach; endif; unset($_from); ?>>
            </td>
			<td width="53" > <input type="radio" name="time[4]" value="1"  <?php if ($this->_tpl_vars['week'][4]['time'] == 1): ?>checked<?php endif; ?>>  上午</td>   
			<td width="55"> <input type="radio" name="time[4]" value="2"  <?php if ($this->_tpl_vars['week'][4]['time'] == 2): ?>checked<?php endif; ?>>下午</td>
            <td width="58"><input type="radio" name="time[4]" value="3"   <?php if ($this->_tpl_vars['week'][4]['time'] == 3): ?>checked<?php endif; ?>>全天 </td>
            <td>&nbsp;</td>
       </tr>
        <tr>
            <td >星期五
             <input type="checkbox" name="week[]" value="5" id="date_5" <?php $_from = $this->_tpl_vars['week']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?> <?php if ($this->_tpl_vars['v']['week'] == 5): ?>checked<?php endif; ?> <?php endforeach; endif; unset($_from); ?>>
            </td>
			<td width="53" > <input type="radio" name="time[5]" value="1"  <?php if ($this->_tpl_vars['week'][5]['time'] == 1): ?>checked<?php endif; ?>>  上午</td>   
			<td width="55"> <input type="radio" name="time[5]" value="2"  <?php if ($this->_tpl_vars['week'][5]['time'] == 2): ?>checked<?php endif; ?>>下午</td>
            <td width="58"><input type="radio" name="time[5]" value="3"   <?php if ($this->_tpl_vars['week'][5]['time'] == 3): ?>checked<?php endif; ?>>全天 </td>
            <td>&nbsp;</td>
       </tr>
        <tr>
            <td >星期六
             <input type="checkbox" name="week[]" value="6" id="date_6" <?php $_from = $this->_tpl_vars['week']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?> <?php if ($this->_tpl_vars['v']['week'] == 6): ?>checked<?php endif; ?> <?php endforeach; endif; unset($_from); ?>>
            </td>
			<td width="53" > <input type="radio" name="time[6]" value="1"  <?php if ($this->_tpl_vars['week'][6]['time'] == 1): ?>checked<?php endif; ?>>  上午</td>   
			<td width="55"> <input type="radio" name="time[6]" value="2"  <?php if ($this->_tpl_vars['week'][6]['time'] == 2): ?>checked<?php endif; ?>>下午</td>
            <td width="58"><input type="radio" name="time[6]" value="3"   <?php if ($this->_tpl_vars['week'][6]['time'] == 3): ?>checked<?php endif; ?>>全天 </td>
            <td>&nbsp;</td>
       </tr>
        <tr>
            <td >星期日
              <input type="checkbox" name="week[]" value="0" id="date_0" <?php $_from = $this->_tpl_vars['week']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?> <?php if ($this->_tpl_vars['v']['week'] == '0'): ?>checked<?php endif; ?> <?php endforeach; endif; unset($_from); ?>>
            </td>
			<td width="53" > <input type="radio" name="time[0]" value="1"  <?php if ($this->_tpl_vars['week'][0]['time'] == 1): ?>checked<?php endif; ?>>  上午</td>   
			<td width="55"> <input type="radio" name="time[0]" value="2"  <?php if ($this->_tpl_vars['week'][0]['time'] == 2): ?>checked<?php endif; ?>>下午</td>
            <td width="58"><input type="radio" name="time[0]" value="3"   <?php if ($this->_tpl_vars['week'][0]['time'] == 3): ?>checked<?php endif; ?>>全天 </td>
            <td>&nbsp;</td>
       </tr>
       <tr > <td >总挂号数</td>
			<td colspan="4" >&nbsp;<input type="text" name="REGISTER_NUM_TOTAL" id="REGISTER_NUM_TOTAL" value="<?php echo $this->_tpl_vars['row']['register_num_total']; ?>
"></td>	
			<td>&nbsp;</td>
       </tr>
        <tr > <td >网络挂号数</td>
			<td colspan="4" >&nbsp;<input type="text" name="REGISTER_NUM_NET" id="REGISTER_NUM_NET" value="<?php echo $this->_tpl_vars['row']['register_num_net']; ?>
"></td>	
			<td>&nbsp;</td>
       </tr>
        <tr > <td >挂号费</td>
			<td colspan="4" >&nbsp;<input type="text" name="REGISTRATION_FEE" id="REGISTRATION_FEE" value="<?php echo $this->_tpl_vars['row']['registration_fee']; ?>
" ></td>	
			<td>&nbsp;</td>
       </tr>
        <tr > <td >诊疗费</td>
			<td colspan="4" >&nbsp;<input type="text" name="MEDICAL_FEES" id="MEDICAL_FEES" value="<?php echo $this->_tpl_vars['row']['medical_fees']; ?>
" ></td>	
			<td>&nbsp;</td>
       </tr>
        <tr > <td >手续费</td>
			<td colspan="4" >&nbsp;<input type="text" name="FEE" id="FEE" value="<?php echo $this->_tpl_vars['row']['fee']; ?>
" ></td>	
			<td>&nbsp;</td>
       </tr>
       
        <tr > <td >科室</td>
			<td colspan="4" >&nbsp;
            <select name="department" id="department">
            <?php $_from = $this->_tpl_vars['department']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            <option value="<?php echo $this->_tpl_vars['v']['uuid']; ?>
"<?php if ($this->_tpl_vars['v']['uuid'] == $this->_tpl_vars['row']['department']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['v']['department_name']; ?>
 </option>
            <?php endforeach; endif; unset($_from); ?>
            </select>
            
            </td>	
			<td>&nbsp;</td>
       </tr>
       
        <tr > <td >诊室</td>
			<td colspan="4" >&nbsp;
               <select name="clinic" id="clinic">
            <?php $_from = $this->_tpl_vars['clinic']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            <option value="<?php echo $this->_tpl_vars['v']['uuid']; ?>
" <?php if ($this->_tpl_vars['v']['uuid'] == $this->_tpl_vars['row']['clinic']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['v']['clinic_name']; ?>
 </option>
            <?php endforeach; endif; unset($_from); ?>
            </select>
            </td>	
			<td>&nbsp;</td>
       </tr>
       
        <tr > <td >号种</td>
			<td colspan="4" >&nbsp;
             <select name="number_species" id="number_species">
            <?php $_from = $this->_tpl_vars['number_species']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            <option value="<?php echo $this->_tpl_vars['v']['uuid']; ?>
" <?php if ($this->_tpl_vars['v']['uuid'] == $this->_tpl_vars['row']['number_species']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['v']['no_species_name']; ?>
 </option>
            <?php endforeach; endif; unset($_from); ?>
            </select>
            </td>	
			<td>&nbsp;</td>
       </tr>
        <tr > <td >状态</td>
			<td colspan="4" >&nbsp;  <label>
                            <input type="radio" name="flag" value="1" id="flag_0"  <?php if ($this->_tpl_vars['row']['flag'] == 1): ?>checked<?php endif; ?>/>
                                   停用
                    </label>

                    <label>
                        <input type="radio" name="flag" value="2" id="flag_1"  <?php if ($this->_tpl_vars['row']['flag'] == 2): ?>checked<?php endif; ?> />
                               开放
                </label>
                </td>	
			<td>&nbsp;</td>
       </tr>
      
	</tbody>
	
   
    <tr  class="columnbg">
		<td  colspan="6" align="left">
        <input style="cursor:pointer"   type="button" class="b"  name="submit" id="submit" value="保存"  />
        <input class="b"  style="cursor:pointer"   type="button" name="back" id="back" value="返回"  onclick="javascript:history.go(-1);"/>
        <label>*已经生成的坐诊表无法通过修改坐诊字典修改，但可以到坐诊表页面手动修改</label>
        <div style="float:right"><?php echo $this->_tpl_vars['out']; ?>
</div></td>
	</tr>
	</table>
</form>
		<br />
        <script type="text/javascript">
    $("#submit").click(function(){ 
    var weeks =new Array() ;
    weeks[0] = '星期日';  
   weeks[1] = '星期一';
       weeks[2] = '星期二';
     weeks[3] = '星期三';
     weeks[4] = '星期四';
      weeks[5] = '星期五';
      weeks[6] = '星期六'; 
    
     
       var n=0;
        if(!$("input[name='week[]']:checked").val())
        {
            alert("请选择坐诊日期");return false;
        }
        $("input[name=week[]]:checked").each(function(){
        
           var week=($(this).val());
           var time=$("input[name=time["+week+"]]:checked").val(); 
           if(!time){
               n=1;
               alert("你选择了["+weeks[week]+"]但没有选择具体的时间,如:上午、下午或者全天,赶快选上吧！")
               return false;
           }
        }
           );
        
        if(n==1)return false;
        if(!$("#REGISTER_NUM_TOTAL").val()) 
        {
            alert("挂号数不能为空");
            return false;
        }
        else if(!(/^(\+|-)?\d+$/.test($("#REGISTER_NUM_TOTAL").val())))
        {
            alert("挂号数应该为整数");return false;
        }
		
        if(!$("#REGISTER_NUM_NET").val())
        {
            alert("网络挂号数不能为空");return false;
        }
        else if(!(/^(\+|-)?\d+$/.test($("#REGISTER_NUM_NET").val())))
        {
            alert("网络挂号数应该为整数");return false;
        }	
        if(!$("#REGISTRATION_FEE").val())
        {
            alert("请输入挂号费");return false;
        }
        else if(!(/^(\+|-)?\d+$/.test($("#REGISTRATION_FEE").val())))
        {
            alert("挂号费应该为整数");return false;
        }	
        if(!$("#MEDICAL_FEES").val())
        {
            alert("请输入诊疗费");return false;
        }
        else if(!(/^(\+|-)?\d+$/.test($("#MEDICAL_FEES").val())))
        {
            alert("诊疗费应该为整数");return false;
        }	
        if(!$("#FEE").val())
        {
            alert("请输入手续费");return false;
        }
        else if(!(/^(\+|-)?\d+$/.test($("#FEE").val())))
        {
            alert("手续费应该为整数");return false;
        }	
        if(!$("input[name='flag']:checked").val())
        {
            alert("请选择状态");return false;
        }			
      
	  if(!$("select[name='department']").val()){
		  alert("请选择科室");return false;
		  }
	  
        var data=$("#form").serialize();    
        $.post("<?php echo $this->_tpl_vars['basePath']; ?>
appointment/dictionary/save", data, function(info){
            var reinfo=info.split("|");
            alert(reinfo[1]);
            history.go(-1);
        });
         
    })    
   
        
        
</script>	
        
	</body>
</html>