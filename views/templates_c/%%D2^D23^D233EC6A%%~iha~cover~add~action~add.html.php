<?php /* Smarty version 2.6.14, created on 2013-07-25 10:02:07
         compiled from add.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'add.html', 238, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>个人健康档案封面</title>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/region.js"></script>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/cover.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css" rel="stylesheet" type="text/css" />
<style type="text/css">
   div{
     margin-left:auto;
     margin-right:auto;
   }
   img{
    margin:0px;
    padding:0px;
   }
   table{
     margin-left:auto;
     margin-right:auto;
   }
   .maindiv{
       margin-top:30px;
       text-align:center;
   }
   .divcontent{
      border:1px solid black;
      width:70%;
   }
   .line{
        border-top:0px;
		border-left:0px;
		border-right:0px;
		border-bottom:1px solid green;
   }
   .divcontent table tr td{
      height:30px;
   }
  #menuDropDownBox select{
   width:12%;
  }
  .myline{
   border:1px solid blue;
  }
  span,select{
  margin:0px;
  padding:0px;
  }
  <?php echo $this->_tpl_vars['archive_rate_css']; ?>

</style>
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>   <!--时间控件的加载!-->
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/skin/default/datePicker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$(document).ready(function(){
	if('<?php echo $this->_tpl_vars['action']; ?>
'=='add')
	{
		//当对个人档案封面新增的时候  先自动创建一条正常档案状态
	    var status_flag_list = $("#status_flag_list");
	    $("#status_flag").val('1');
       $("#status_flag").find("option:selected").text('正常档案');
		var created = $('<tr><td class="right" width="45%">状态：<span class="description_span">正常档案</span><input type="hidden" name="status_array[]" value="1"  class="description_v"/></td><td align="left" width="45%"><input type="hidden" name="reason_array[]" value="正常" />时间：<input type="text" value="<?php echo $this->_tpl_vars['current_time']; ?>
" style="width:30%" onFocus="WdatePicker({startDate: \'%y-%M-01\' ,dateFmt:\'yyyy-MM-dd\',alwaysUseStartDate: true })" name="status_array_time[]" /></td></tr>');
		created.appendTo(status_flag_list);
	}
});
</script>
</head>
<body>
   <div class="maindiv">
      <p align="center" style="font-size:20px;font-family:宋体;font-weight:bold;">居民健康档案封面</p>
      <div class="divcontent">
		 <table border="0" width="100%" cellspacing="0">
				<tr>
				  <td class="right" width="45%">国标编号：</td>
				  <td  align="left" width="55%"><span id='id_std1'><?php echo $this->_tpl_vars['standard_code_1']; ?>
</span></td>
				</tr>
				<tr>
				  <td class="right" width="45%">省标编号：</td>
				  <td align="left" width="55%"><span id='id_std2'"><?php echo $this->_tpl_vars['standard_code_2']; ?>
</span></td>
				</tr>
				<tr >
				  <td class="right" width="45%" class="core_sn_self_define">自定编号：</td>
				  <td align="left" width="55%"><span id='id_std3'><input type="text" name="standard_code" id="standard_code" size="30" class="line" value="<?php echo $this->_tpl_vars['standard_code']; ?>
"/></span></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: center;">
					<img <?php if ($this->_tpl_vars['headpic']): ?>src="<?php echo $this->_tpl_vars['headpic']; ?>
"<?php else: ?>src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/nopic.gif"<?php endif; ?> id="headpic" style="width:105px;height:128px;border:1px solid black;"/>
					</td>
				</tr>
					<tr>
					<td class="right" width="45%" class="core_name">姓&nbsp;&nbsp;&nbsp;&nbsp;名：</td>
					<td align="left" width="55%"><input type="text" name="name" id="name" size="25" class="line" onkeyup="setName(this.value)" onblur="checkDouble();" value="<?php echo $this->_tpl_vars['name']; ?>
"/>
					</td>
					</tr>
					<tr>
					<td class="right" width="45%" class="core_identity_number">身份证号：</td>
					<td align="left" width="55%"><input type="text" name="identity_number" id="identity_number" size="25" class="line" onblur="checkDouble();" value="<?php echo $this->_tpl_vars['identity_number']; ?>
"  style="ime-mode:disabled" />
					<div id="showDoubleMessage" style="display:none;color:red;"></div>
					</td>
					</tr>
					<tr>
					<td class="right" width="45%" class="core_address">现&nbsp;住&nbsp;址：</td>
					<td align="left" width="55%"><input type="text" name="address" id="address" size="35" class="line" value="<?php echo $this->_tpl_vars['address']; ?>
" onblur="addressSyn(this.value);" /></td>
					</tr>
					<tr>
					<td class="right" width="45%" class="core_residence_address">户籍地址：</td>
					<td align="left" width="55%">
					<input type="text" name="residence_address" id="residence_address" size="35" class="line" value="<?php echo $this->_tpl_vars['residence_address']; ?>
" /></td>
					</tr>
                    <tr>
					<td class="right" width="45%" class="core_residence_address">户籍类型：</td>
					<td align="left" width="55%">
					<?php $_from = $this->_tpl_vars['census']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<input type="radio" name="census" id="census_<?php echo $this->_tpl_vars['k']; ?>
" value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['census_index']): ?>checked="checked" <?php endif; ?>/><label for="census_<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;</td>
					</tr>
					<tr>
					<td class="right" width="45%" class="core_phone_number">联系电话：</td>
					<td align="left" width="55%"><input type="text" name="phone_number" id="phone_number" size="25" class="line" value="<?php echo $this->_tpl_vars['phone_number']; ?>
"  style="ime-mode:disabled" /></td>
					</tr>
					<tr>
					<td colspan="2" style="text-align: center;">
					 <span id="menuDropDownBox"></span>
					</td>
					</tr>
					<tr>
					<td class="right" width="45%" class="core_relation_holder">
					与户主关系：
					</td>
					<td align="left" width="55%">
					<select name="relation_of_householder" id="relation_of_householder" onclick="oldValue=this.value" onchange="setRelationOfHouseholder(this,this.value,oldValue);" <?php echo $this->_tpl_vars['relation_of_householder_disabled']; ?>
 >
						<?php unset($this->_sections['relation']);
$this->_sections['relation']['name'] = 'relation';
$this->_sections['relation']['loop'] = is_array($_loop=$this->_tpl_vars['relation']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['relation']['show'] = true;
$this->_sections['relation']['max'] = $this->_sections['relation']['loop'];
$this->_sections['relation']['step'] = 1;
$this->_sections['relation']['start'] = $this->_sections['relation']['step'] > 0 ? 0 : $this->_sections['relation']['loop']-1;
if ($this->_sections['relation']['show']) {
    $this->_sections['relation']['total'] = $this->_sections['relation']['loop'];
    if ($this->_sections['relation']['total'] == 0)
        $this->_sections['relation']['show'] = false;
} else
    $this->_sections['relation']['total'] = 0;
if ($this->_sections['relation']['show']):

            for ($this->_sections['relation']['index'] = $this->_sections['relation']['start'], $this->_sections['relation']['iteration'] = 1;
                 $this->_sections['relation']['iteration'] <= $this->_sections['relation']['total'];
                 $this->_sections['relation']['index'] += $this->_sections['relation']['step'], $this->_sections['relation']['iteration']++):
$this->_sections['relation']['rownum'] = $this->_sections['relation']['iteration'];
$this->_sections['relation']['index_prev'] = $this->_sections['relation']['index'] - $this->_sections['relation']['step'];
$this->_sections['relation']['index_next'] = $this->_sections['relation']['index'] + $this->_sections['relation']['step'];
$this->_sections['relation']['first']      = ($this->_sections['relation']['iteration'] == 1);
$this->_sections['relation']['last']       = ($this->_sections['relation']['iteration'] == $this->_sections['relation']['total']);
?>
						<option value="<?php echo $this->_tpl_vars['relation'][$this->_sections['relation']['index']]['key']; ?>
" <?php echo $this->_tpl_vars['relation'][$this->_sections['relation']['index']]['selected']; ?>
 ><?php echo $this->_tpl_vars['relation'][$this->_sections['relation']['index']]['value']; ?>
</option>
						<?php endfor; endif; ?>
					</select>
					</td>
					</tr>
					<tr>
					   <td class="right" width="45%" class="core_householder_name">
					     户主姓名：
					   </td>
					   <td align="left" width="55%">
					   <span id="householderName">
					                  <?php echo $this->_tpl_vars['householder_name']; ?>

					   </span>
					   </td>
					</tr>
					<tr style="border:1px solid red;width:100%" >
					<td class="right" style="width: 45%;">家庭成员：</td>
					<td style="width: 55%;text-align: left;"><?php echo $this->_tpl_vars['family_member_list']; ?>
</td>
					</tr>
					<tr >
						<td class="right" width="45%" class="core_status_flag">档案状态：</td>
						<td align="left" width="55%">
							<select name="status_flag" id="status_flag" onchange="setStatusflag(this,this.value,this.value);" <?php echo $this->_tpl_vars['disabled_status']; ?>
>
							<?php unset($this->_sections['status_flag']);
$this->_sections['status_flag']['name'] = 'status_flag';
$this->_sections['status_flag']['loop'] = is_array($_loop=$this->_tpl_vars['status_flag']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['status_flag']['show'] = true;
$this->_sections['status_flag']['max'] = $this->_sections['status_flag']['loop'];
$this->_sections['status_flag']['step'] = 1;
$this->_sections['status_flag']['start'] = $this->_sections['status_flag']['step'] > 0 ? 0 : $this->_sections['status_flag']['loop']-1;
if ($this->_sections['status_flag']['show']) {
    $this->_sections['status_flag']['total'] = $this->_sections['status_flag']['loop'];
    if ($this->_sections['status_flag']['total'] == 0)
        $this->_sections['status_flag']['show'] = false;
} else
    $this->_sections['status_flag']['total'] = 0;
if ($this->_sections['status_flag']['show']):

            for ($this->_sections['status_flag']['index'] = $this->_sections['status_flag']['start'], $this->_sections['status_flag']['iteration'] = 1;
                 $this->_sections['status_flag']['iteration'] <= $this->_sections['status_flag']['total'];
                 $this->_sections['status_flag']['index'] += $this->_sections['status_flag']['step'], $this->_sections['status_flag']['iteration']++):
$this->_sections['status_flag']['rownum'] = $this->_sections['status_flag']['iteration'];
$this->_sections['status_flag']['index_prev'] = $this->_sections['status_flag']['index'] - $this->_sections['status_flag']['step'];
$this->_sections['status_flag']['index_next'] = $this->_sections['status_flag']['index'] + $this->_sections['status_flag']['step'];
$this->_sections['status_flag']['first']      = ($this->_sections['status_flag']['iteration'] == 1);
$this->_sections['status_flag']['last']       = ($this->_sections['status_flag']['iteration'] == $this->_sections['status_flag']['total']);
?>
								<option value="<?php echo $this->_tpl_vars['status_flag'][$this->_sections['status_flag']['index']]['key']; ?>
" <?php echo $this->_tpl_vars['status_flag'][$this->_sections['status_flag']['index']]['selected']; ?>
 ><?php echo $this->_tpl_vars['status_flag'][$this->_sections['status_flag']['index']]['value']; ?>

								</option>
							<?php endfor; endif; ?>
							</select>
						</td>
					</tr>
					<tr>
					 <td colspan="2">
					   <table width="100%" id="status_flag_list" align="center">
					       <?php unset($this->_sections['c']);
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['individual_status_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['show'] = true;
$this->_sections['c']['max'] = $this->_sections['c']['loop'];
$this->_sections['c']['step'] = 1;
$this->_sections['c']['start'] = $this->_sections['c']['step'] > 0 ? 0 : $this->_sections['c']['loop']-1;
if ($this->_sections['c']['show']) {
    $this->_sections['c']['total'] = $this->_sections['c']['loop'];
    if ($this->_sections['c']['total'] == 0)
        $this->_sections['c']['show'] = false;
} else
    $this->_sections['c']['total'] = 0;
if ($this->_sections['c']['show']):

            for ($this->_sections['c']['index'] = $this->_sections['c']['start'], $this->_sections['c']['iteration'] = 1;
                 $this->_sections['c']['iteration'] <= $this->_sections['c']['total'];
                 $this->_sections['c']['index'] += $this->_sections['c']['step'], $this->_sections['c']['iteration']++):
$this->_sections['c']['rownum'] = $this->_sections['c']['iteration'];
$this->_sections['c']['index_prev'] = $this->_sections['c']['index'] - $this->_sections['c']['step'];
$this->_sections['c']['index_next'] = $this->_sections['c']['index'] + $this->_sections['c']['step'];
$this->_sections['c']['first']      = ($this->_sections['c']['iteration'] == 1);
$this->_sections['c']['last']       = ($this->_sections['c']['iteration'] == $this->_sections['c']['total']);
?>
					            <tr id="<?php echo $this->_tpl_vars['individual_status_array'][$this->_sections['c']['index']]['uuid']; ?>
">
						            <td  class="right" width="49%">
						                     状态：<span class="description_span""><?php echo $this->_tpl_vars['individual_status_array'][$this->_sections['c']['index']]['status_name']; ?>
</span><input type="hidden" name="status_array[]" value="<?php echo $this->_tpl_vars['individual_status_array'][$this->_sections['c']['index']]['status_edit']; ?>
" <?php echo $this->_tpl_vars['disabled_status']; ?>
 class="description_v" />
						              <input type="hidden" value="<?php echo $this->_tpl_vars['individual_status_array'][$this->_sections['c']['index']]['created']; ?>
" name="created[]" />
						            </td>
						            <td>
						            备注：<input type="text" value="<?php echo $this->_tpl_vars['individual_status_array'][$this->_sections['c']['index']]['mark']; ?>
" name="reason_array[]" /><br />
						            时间：<input type="text" value="<?php echo $this->_tpl_vars['individual_status_array'][$this->_sections['c']['index']]['status_time']; ?>
"  <?php echo $this->_tpl_vars['disabled_status']; ?>
 onFocus="WdatePicker({startDate:'%y-%M-01' ,dateFmt:'yyyy-MM-dd',alwaysUseStartDate: true })" name="status_array_time[]" /><?php if (! $this->_tpl_vars['die_status'] && $this->_tpl_vars['individual_status_array'][$this->_sections['c']['index']]['status_edit'] != 1): ?>&nbsp;&nbsp;<span><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/unchecked.gif" onclick="return del_item('<?php echo $this->_tpl_vars['individual_status_array'][$this->_sections['c']['index']]['uuid']; ?>
');"/></span><?php endif; ?>
						            </td>
					            </tr>
					       <?php endfor; endif; ?>
					   </table>
					 </td>
					</tr>
					<tr>
					<td class="right" width="45%"><span style="display:<?php echo $this->_tpl_vars['new_org_switch']; ?>
">原</span>建档单位:</td>
					<td align="left" width="55%">
					<?php echo $this->_tpl_vars['organization_zh_name']; ?>

					</td>
					</tr>
					<tr style="display:<?php echo $this->_tpl_vars['new_org_switch']; ?>
">
					<td class="right" width="45%">现建档单位:</td>
					<td align="left" width="55%">
					<?php echo $this->_tpl_vars['new_organization_zh_name']; ?>

					<input type="checkbox" id="confirm_change_org" name="confirm_change_org" value="1" />确定更改为现单位管理
					</td>
					</tr>
					<tr>
					<td class="right" width="45%" class="core_staff_id"><span style="display:<?php echo $this->_tpl_vars['new_org_switch']; ?>
">原</span>建档人:</td>
					<td align="left" width="55%">
					<select name="archive_doctor" id="archive_doctor">
						<?php unset($this->_sections['archive_doctor']);
$this->_sections['archive_doctor']['name'] = 'archive_doctor';
$this->_sections['archive_doctor']['loop'] = is_array($_loop=$this->_tpl_vars['archive_doctor']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['archive_doctor']['show'] = true;
$this->_sections['archive_doctor']['max'] = $this->_sections['archive_doctor']['loop'];
$this->_sections['archive_doctor']['step'] = 1;
$this->_sections['archive_doctor']['start'] = $this->_sections['archive_doctor']['step'] > 0 ? 0 : $this->_sections['archive_doctor']['loop']-1;
if ($this->_sections['archive_doctor']['show']) {
    $this->_sections['archive_doctor']['total'] = $this->_sections['archive_doctor']['loop'];
    if ($this->_sections['archive_doctor']['total'] == 0)
        $this->_sections['archive_doctor']['show'] = false;
} else
    $this->_sections['archive_doctor']['total'] = 0;
if ($this->_sections['archive_doctor']['show']):

            for ($this->_sections['archive_doctor']['index'] = $this->_sections['archive_doctor']['start'], $this->_sections['archive_doctor']['iteration'] = 1;
                 $this->_sections['archive_doctor']['iteration'] <= $this->_sections['archive_doctor']['total'];
                 $this->_sections['archive_doctor']['index'] += $this->_sections['archive_doctor']['step'], $this->_sections['archive_doctor']['iteration']++):
$this->_sections['archive_doctor']['rownum'] = $this->_sections['archive_doctor']['iteration'];
$this->_sections['archive_doctor']['index_prev'] = $this->_sections['archive_doctor']['index'] - $this->_sections['archive_doctor']['step'];
$this->_sections['archive_doctor']['index_next'] = $this->_sections['archive_doctor']['index'] + $this->_sections['archive_doctor']['step'];
$this->_sections['archive_doctor']['first']      = ($this->_sections['archive_doctor']['iteration'] == 1);
$this->_sections['archive_doctor']['last']       = ($this->_sections['archive_doctor']['iteration'] == $this->_sections['archive_doctor']['total']);
?>
						<option value="<?php echo $this->_tpl_vars['archive_doctor'][$this->_sections['archive_doctor']['index']]['id']; ?>
" <?php echo $this->_tpl_vars['archive_doctor'][$this->_sections['archive_doctor']['index']]['selected']; ?>
 ><?php echo $this->_tpl_vars['archive_doctor'][$this->_sections['archive_doctor']['index']]['zh_name']; ?>
</option>
						<?php endfor; endif; ?>
					</select>
					</td>
					</tr>
					<tr style="display:<?php echo $this->_tpl_vars['new_org_switch']; ?>
">
					<td class="right" width="45%">现建档人:</td>
					<td align="left" width="55%">
					<select name="new_archive_doctor" id="new_archive_doctor">
						<?php unset($this->_sections['new_archive_doctor']);
$this->_sections['new_archive_doctor']['name'] = 'new_archive_doctor';
$this->_sections['new_archive_doctor']['loop'] = is_array($_loop=$this->_tpl_vars['new_archive_doctor']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['new_archive_doctor']['show'] = true;
$this->_sections['new_archive_doctor']['max'] = $this->_sections['new_archive_doctor']['loop'];
$this->_sections['new_archive_doctor']['step'] = 1;
$this->_sections['new_archive_doctor']['start'] = $this->_sections['new_archive_doctor']['step'] > 0 ? 0 : $this->_sections['new_archive_doctor']['loop']-1;
if ($this->_sections['new_archive_doctor']['show']) {
    $this->_sections['new_archive_doctor']['total'] = $this->_sections['new_archive_doctor']['loop'];
    if ($this->_sections['new_archive_doctor']['total'] == 0)
        $this->_sections['new_archive_doctor']['show'] = false;
} else
    $this->_sections['new_archive_doctor']['total'] = 0;
if ($this->_sections['new_archive_doctor']['show']):

            for ($this->_sections['new_archive_doctor']['index'] = $this->_sections['new_archive_doctor']['start'], $this->_sections['new_archive_doctor']['iteration'] = 1;
                 $this->_sections['new_archive_doctor']['iteration'] <= $this->_sections['new_archive_doctor']['total'];
                 $this->_sections['new_archive_doctor']['index'] += $this->_sections['new_archive_doctor']['step'], $this->_sections['new_archive_doctor']['iteration']++):
$this->_sections['new_archive_doctor']['rownum'] = $this->_sections['new_archive_doctor']['iteration'];
$this->_sections['new_archive_doctor']['index_prev'] = $this->_sections['new_archive_doctor']['index'] - $this->_sections['new_archive_doctor']['step'];
$this->_sections['new_archive_doctor']['index_next'] = $this->_sections['new_archive_doctor']['index'] + $this->_sections['new_archive_doctor']['step'];
$this->_sections['new_archive_doctor']['first']      = ($this->_sections['new_archive_doctor']['iteration'] == 1);
$this->_sections['new_archive_doctor']['last']       = ($this->_sections['new_archive_doctor']['iteration'] == $this->_sections['new_archive_doctor']['total']);
?>
						<option value="<?php echo $this->_tpl_vars['new_archive_doctor'][$this->_sections['new_archive_doctor']['index']]['id']; ?>
" <?php echo $this->_tpl_vars['new_archive_doctor'][$this->_sections['new_archive_doctor']['index']]['selected']; ?>
 ><?php echo $this->_tpl_vars['new_archive_doctor'][$this->_sections['new_archive_doctor']['index']]['zh_name']; ?>
</option>
						<?php endfor; endif; ?>
					</select>
					</td>
					</tr>
					
					<tr>
					<td class="right" width="45%" class="core_response_doctor"><span style="display:<?php echo $this->_tpl_vars['new_org_switch']; ?>
">原</span>责任医生:</td>
					<td align="left" width="55%">
					<select name="response_doctor" id="response_doctor">
						<?php unset($this->_sections['response_doctor']);
$this->_sections['response_doctor']['name'] = 'response_doctor';
$this->_sections['response_doctor']['loop'] = is_array($_loop=$this->_tpl_vars['response_doctor']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['response_doctor']['show'] = true;
$this->_sections['response_doctor']['max'] = $this->_sections['response_doctor']['loop'];
$this->_sections['response_doctor']['step'] = 1;
$this->_sections['response_doctor']['start'] = $this->_sections['response_doctor']['step'] > 0 ? 0 : $this->_sections['response_doctor']['loop']-1;
if ($this->_sections['response_doctor']['show']) {
    $this->_sections['response_doctor']['total'] = $this->_sections['response_doctor']['loop'];
    if ($this->_sections['response_doctor']['total'] == 0)
        $this->_sections['response_doctor']['show'] = false;
} else
    $this->_sections['response_doctor']['total'] = 0;
if ($this->_sections['response_doctor']['show']):

            for ($this->_sections['response_doctor']['index'] = $this->_sections['response_doctor']['start'], $this->_sections['response_doctor']['iteration'] = 1;
                 $this->_sections['response_doctor']['iteration'] <= $this->_sections['response_doctor']['total'];
                 $this->_sections['response_doctor']['index'] += $this->_sections['response_doctor']['step'], $this->_sections['response_doctor']['iteration']++):
$this->_sections['response_doctor']['rownum'] = $this->_sections['response_doctor']['iteration'];
$this->_sections['response_doctor']['index_prev'] = $this->_sections['response_doctor']['index'] - $this->_sections['response_doctor']['step'];
$this->_sections['response_doctor']['index_next'] = $this->_sections['response_doctor']['index'] + $this->_sections['response_doctor']['step'];
$this->_sections['response_doctor']['first']      = ($this->_sections['response_doctor']['iteration'] == 1);
$this->_sections['response_doctor']['last']       = ($this->_sections['response_doctor']['iteration'] == $this->_sections['response_doctor']['total']);
?>
						<option value="<?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['id']; ?>
" <?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['selected']; ?>
 ><?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['zh_name']; ?>
</option>
						<?php endfor; endif; ?>
					</select>
					</td>
					</tr>
					<tr style="display:<?php echo $this->_tpl_vars['new_org_switch']; ?>
">
					<td class="right" width="45%">现责任医生:</td>
					<td align="left" width="55%">
					<select name="new_response_doctor" id="new_response_doctor">
						<?php unset($this->_sections['new_response_doctor']);
$this->_sections['new_response_doctor']['name'] = 'new_response_doctor';
$this->_sections['new_response_doctor']['loop'] = is_array($_loop=$this->_tpl_vars['new_response_doctor']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['new_response_doctor']['show'] = true;
$this->_sections['new_response_doctor']['max'] = $this->_sections['new_response_doctor']['loop'];
$this->_sections['new_response_doctor']['step'] = 1;
$this->_sections['new_response_doctor']['start'] = $this->_sections['new_response_doctor']['step'] > 0 ? 0 : $this->_sections['new_response_doctor']['loop']-1;
if ($this->_sections['new_response_doctor']['show']) {
    $this->_sections['new_response_doctor']['total'] = $this->_sections['new_response_doctor']['loop'];
    if ($this->_sections['new_response_doctor']['total'] == 0)
        $this->_sections['new_response_doctor']['show'] = false;
} else
    $this->_sections['new_response_doctor']['total'] = 0;
if ($this->_sections['new_response_doctor']['show']):

            for ($this->_sections['new_response_doctor']['index'] = $this->_sections['new_response_doctor']['start'], $this->_sections['new_response_doctor']['iteration'] = 1;
                 $this->_sections['new_response_doctor']['iteration'] <= $this->_sections['new_response_doctor']['total'];
                 $this->_sections['new_response_doctor']['index'] += $this->_sections['new_response_doctor']['step'], $this->_sections['new_response_doctor']['iteration']++):
$this->_sections['new_response_doctor']['rownum'] = $this->_sections['new_response_doctor']['iteration'];
$this->_sections['new_response_doctor']['index_prev'] = $this->_sections['new_response_doctor']['index'] - $this->_sections['new_response_doctor']['step'];
$this->_sections['new_response_doctor']['index_next'] = $this->_sections['new_response_doctor']['index'] + $this->_sections['new_response_doctor']['step'];
$this->_sections['new_response_doctor']['first']      = ($this->_sections['new_response_doctor']['iteration'] == 1);
$this->_sections['new_response_doctor']['last']       = ($this->_sections['new_response_doctor']['iteration'] == $this->_sections['new_response_doctor']['total']);
?>
						<option value="<?php echo $this->_tpl_vars['new_response_doctor'][$this->_sections['new_response_doctor']['index']]['id']; ?>
" <?php echo $this->_tpl_vars['new_response_doctor'][$this->_sections['new_response_doctor']['index']]['selected']; ?>
 ><?php echo $this->_tpl_vars['new_response_doctor'][$this->_sections['new_response_doctor']['index']]['zh_name']; ?>
</option>
						<?php endfor; endif; ?>
					</select>
					</td>
					</tr>
					<tr>
					<td class="right" width="45%" class="core_filing_time">建档日期:</td>
					<td align="left" width="55%"><input type="text" name="updated" id="updated" size="15"  onClick="WdatePicker({firstDayOfWeek:1})" class="line" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['updated'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
" /></td>
					</tr>
					<tr>
					<td colspan="2" style="text-align: center;">
					<input type="button" name="save" id="save" value="保存" onclick="return ajaxSave()" <?php echo $this->_tpl_vars['ajax_save_disabled']; ?>
 />
					<input type="button" name="skip" id="skip" value="进入基本档案编辑" onclick="skip(1);" <?php echo $this->_tpl_vars['disabled']; ?>
 />
                    <input type="button" name="print" id="print" value="打印" onclick="skip(4)" <?php echo $this->_tpl_vars['disabled']; ?>
 /> 
					<input type="button" name="skip" id="skip" value="返回列表" onclick="skip(2);" <?php echo $this->_tpl_vars['disabled']; ?>
 />
					
					</td>
					</tr>
			</table>
      </div>
   </div>
<!--个人档案号-->
<input type="hidden" id="uuid" name="uuid" value="<?php echo $this->_tpl_vars['uuid']; ?>
" />
<input type="hidden" id="org_id" name="org_id" value="<?php echo $this->_tpl_vars['org_id']; ?>
" />
<input type="hidden" id="new_org_id" name="new_org_id" value="<?php echo $this->_tpl_vars['new_org_id']; ?>
" />
<input type="hidden" id="staff_id" name="staff_id" value="<?php echo $this->_tpl_vars['staff_id']; ?>
" />
<!--县以上的行政区域代码通过机构获取，县以下的在建立个人档案的时候选择.region_id_1代表县以的机构代码-->
<input type="hidden" id="region_id_1" name="region_id_1" value="<?php echo $this->_tpl_vars['region_id_1']; ?>
" />
<input type="hidden" id="region_id_1_standard_code" name="region_id_1_standard_code" value="<?php echo $this->_tpl_vars['region_id_1_standard_code']; ?>
" />
<input type="hidden" id="family_number" name="family_number" value="<?php echo $this->_tpl_vars['family_number']; ?>
" />
<input type="hidden" id="family_inner_id" name="family_inner_id" value="<?php echo $this->_tpl_vars['family_inner_id']; ?>
" />
<input type="hidden" id="family_number_old" name="family_number_old" value="<?php echo $this->_tpl_vars['family_number_old']; ?>
" />
<input type="hidden" id="family_inner_id_old" name="family_inner_id_old" value="<?php echo $this->_tpl_vars['family_inner_id_old']; ?>
" />
<input type="hidden" id="individual_inner_id" name="individual_inner_id" value="<?php echo $this->_tpl_vars['individual_inner_id']; ?>
" />
<input type="hidden" id="region_path_inner_id" name="region_path_inner_id" value="<?php echo $this->_tpl_vars['region_path_inner_id']; ?>
" />
<input type="hidden" id="relation_of_householder_old" name="relation_of_householder_old" value="<?php echo $this->_tpl_vars['relation_of_householder_old']; ?>
" />
<input type="hidden" id="action" name="action" value="<?php echo $this->_tpl_vars['action']; ?>
" />
</body>
</html>
<script type="text/javascript">
//alert($("th[id='a.a']").html());
//alert($("div[id='#5']").html());
function skip(action){
	if(action==1){
		var uuid=$('#uuid').val();
		document.location="<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/add/uuid/"+uuid+"/opener/<?php echo $this->_tpl_vars['opener']; ?>
/para_page/<?php echo $this->_tpl_vars['page']; ?>
";
	}
	if(action==2){
		//var uuid=$('#uuid').val();
		//		var statu_f = $('#status_flag').val();
		//		alert(statu_f);
		var url="<?php echo $this->_tpl_vars['basePath']; ?>
iha/<?php echo $this->_tpl_vars['opener']; ?>
/index/page/<?php echo $this->_tpl_vars['page']; ?>
";
		//alert(url);
		document.location=url;
		
		//document.location="<?php echo $this->_tpl_vars['basePath']; ?>
iha/opener/<?php echo $this->_tpl_vars['opener']; ?>
/page/<?php echo $this->_tpl_vars['page']; ?>
";
	}
	if(action==4){
		var uuid=$('#uuid').val();
		window.open( "<?php echo $this->_tpl_vars['basePath']; ?>
iha/cover/print/uuid/"+uuid);
		}



}
//检查身份证号
function checkId(){
	var id=$('#identity_number').val();
	if(id.length!=18 && id.length!=15){
		var message='身份证应该为18位或是15位';
		//alert(message);
		$('#showDoubleMessage').text(message);
		$('#showDoubleMessage').css('display','block');
		return false;
	}
	//简单判断一下日期，规范化后统一处理
	var validDate=true;
	if(id.length==18){
		var inputDate=id.substr(6,8);
	}
	if(id.length==15){
		var inputDate='19'+id.substr(6,6);
	}
	var now=new Date();
	var inputYear=inputDate.substr(0,4);
	var inputMonth=inputDate.substr(4,2);
	var inputday=inputDate.substr(6,2);
	if(parseInt(inputMonth)<0 || parseInt(inputMonth)>12){
		validDate=false;
	}
	if(parseInt(inputday)<0 || parseInt(inputday)>31){
		validDate=false;
	}
	var myDate=new Date()
	//alert(inputDate.substr(0,4)+'|'+inputDate.substr(4,2)+'|'+inputDate.substr(6,2));
	myDate.setFullYear(inputDate.substr(0,4),parseInt(inputDate.substr(4,2))-1,inputDate.substr(6,2));
	//alert(myDate+'|'+now);
	if(myDate<=now){
	}else{
		validDate=false;
	}
	if(validDate){

		return true;
	}else{
		var message='身份证日期段不正确，请检查';
		$('#showDoubleMessage').text(message);
		$('#showDoubleMessage').css('display','block');
		return false;

	}
}
function checkDouble(){
	//检查身份证号
	if(!checkId()){
		$('#identity_number').focus();
		return false;
	}
	//编辑状态下也要检查重档
	//if($('#action').val()=='edit'){
	//	$('#showDoubleMessage').css('display','none');
	//	return true;
	//}
	//当姓名与身份证有一个为空时不检查重档
	if(name=$('#name').val()=='' || $('#identity_number').val()==''){
		$('#showDoubleMessage').css('display','none');
		return false;
	}
	var name=$('#name').val();
	var identity_number=$('#identity_number').val();
    var uuid=$('#uuid').val();
	var string='';
	string="name="+name;
	string=string+'&'+"identity_number="+identity_number+'&'+"uuid="+uuid;;
	$.ajax({
		type: "POST",
		url: "<?php echo $this->_tpl_vars['basePath']; ?>
iha/cover/checkDouble/action/"+$('#action').val(),
		data: string,
        beforeSend:function(msg)
        {
            $('#save').attr('disabled','true');
        },
		success: function(msg){
			//alert( "Data Saved: " + msg );
			if(msg=='double'){
				//alert('档案已存在');
				//$('#showDoubleMessage').html('此档案可能已存在，请检查后，防止重复建档');
				var message='检测到已有此姓名与身份证号的档案存在，请检查是否输入错误，防止重复建档';
				$('#showDoubleMessage').text(message);
				$('#showDoubleMessage').css('display','block');
				$('#save').attr('disabled','true');
                $("#identity_number").focus();
                return false;
				//confirm('档案已存在')
			}else{
				$('#showDoubleMessage').css('display','none');
				$('#save').attr('disabled','');
                return true;
			}
		}
	});
}
function ajaxSave(){
	//编辑的时候取得创建时间
	<?php if ($this->_tpl_vars['action'] == 'edit'): ?>
	   var created_time = $("input[name='created[]']");
	   var created_time_string = '';
	   created_time.each(function(i){
		   created_time_string+=$(this).val()+'|';
	   });   
	<?php endif; ?>
	//取得备注内容
	var reason_array = $("input[name='reason_array[]']");
	var reason_array_string = '';
	reason_array.each(function(i){
		reason_array_string+=$(this).val()+'|';
	});
	//取得状态
	var status_array = $("input[name='status_array[]']");
	var status_array_string = '';
	status_array.each(function(i){
		status_array_string+=$(this).val()+'|';
	});
	//取得状态的时间
	var status_array_time = $("input[name='status_array_time[]']");
	var status_array_time_string = '';
	status_array_time.each(function(i){
		status_array_time_string+=$(this).val()+'|';
	});
	var name=$('#name').val();
	if(name==''){
		alert('姓名不能为空');
		$('#name').focus();
		return;
	}
	var identity_number=$('#identity_number').val();
	if(identity_number==''){
		alert('身份证号不能为空');
		$('#identity_number').focus();
		return;
	}
    
    if($('#region_last_id').val()==undefined || $('#region_last_id').val()==''){
		alert('请选择正确的区域');
		return;
	}
	//alert($('#region_last_id').val());



	var relation_of_householder=$('#relation_of_householder').val();
	var relation_of_householder_old=$('#relation_of_householder_old').val();
	
	if(relation_of_householder=='-9'){
		alert('请选择与户主关系');
		$('#relation_of_householder').focus();
		return;
	}
	var family_number=$('#family_number').val();
	if(family_number=='' && relation_of_householder!='1'){
		alert('家庭档案号为空，请重新选择与户主的关系。');
		$('#relation_of_householder').val('-9');
		$('#relation_of_householder').focus();
		return;
	}
	//档案状态
	var status_flag = $('#status_flag').val();
	if(status_flag=='-9'){
		alert('请选择档案状态');
		$('status_flag').focus();
		return;
	}
	var archive_doctor=$('#archive_doctor').val();
	if(archive_doctor=='-9'){
		alert('请选择建档医生');
		$('#archive_doctor').focus();
		return;
	}
	var response_doctor=$('#response_doctor').val();
	if(response_doctor=='-9'){
		alert('请选择责任医生');
		$('#response_doctor').focus();
		return;
	}
	var confirm_change_org='';
	if($("#confirm_change_org").attr("checked")==true){
		var new_archive_doctor=$('#new_archive_doctor').val();
		if(new_archive_doctor=='-9'){
			alert('请选择建档医生');
			$('#new_archive_doctor').focus();
			return;
		}
		var new_response_doctor=$('#new_response_doctor').val();
		if(new_response_doctor=='-9'){
			alert('请选择责任医生');
			$('#new_response_doctor').focus();
			return;
		}
		var confirm_change_org='1';
	}
    var uuid=$('#uuid').val();
    //验证重复
	var string='';
	string="name="+name;
	string=string+'&'+"identity_number="+identity_number+'&'+"uuid="+uuid;
	$.ajax({
		type: "POST",
		url: "<?php echo $this->_tpl_vars['basePath']; ?>
iha/cover/checkDouble/action/"+$('#action').val(),
		data: string,
        beforeSend:function(msg)
        {
            $('#save').attr('disabled','true');
        },
		success: function(msg){
			//alert( "Data Saved: " + msg );
            msg=$.trim(msg);
			if(msg=='double'){
				//alert('档案已存在');
				//$('#showDoubleMessage').html('此档案可能已存在，请检查后，防止重复建档');
				var message='检测到已有此姓名与身份证号的档案存在，请检查是否输入错误，防止重复建档';
				$('#showDoubleMessage').text(message);
				$('#showDoubleMessage').css('display','block');
				$('#save').attr('disabled','true');
                $("#identity_number").focus();
                identity_status=0;
                return false;
			}else{
				$('#showDoubleMessage').css('display','none');
				$('#save').attr('disabled','');
                
            	//alert(uuid);
            	var family_inner_id=$('#family_inner_id').val();
            	var individual_inner_id=$('#individual_inner_id').val();
            	$('#save').attr('disabled','true');
            	var string='';
            	string="name="+name;
            	string=string+'&'+"uuid="+uuid;
            	string=string+'&'+"identity_number="+identity_number;
            	string=string+'&'+"address="+$('#address').val();
            	string=string+'&'+"residence_address="+$('#residence_address').val();
            	string=string+'&'+"phone_number="+$('#phone_number').val();
            	string=string+'&'+"staff_id="+$('#staff_id').val();
            	string=string+'&'+"org_id="+$('#org_id').val();
            	string=string+'&'+"new_org_id="+$('#new_org_id').val();
            	string=string+'&'+"region_last_id="+$('#region_last_id').val();
            	string=string+'&'+"region_last_id_old="+$('#region_last_id_old').val();
            	string=string+'&'+"standard_code="+$('#standard_code').val();
            	string=string+'&'+"relation_of_householder="+relation_of_householder;
            	string=string+'&'+"relation_of_householder_old="+relation_of_householder_old;
            	string=string+'&'+"status_array="+status_array_string;
            	string=string+'&'+"status_array_time="+status_array_time_string;
            	string=string+'&'+"mark_array="+reason_array_string;
            	string=string+'&'+"family_number="+$('#family_number').val();
            	string=string+'&'+"family_number_old="+$('#family_number_old').val();
            	string=string+'&'+"family_inner_id="+$('#family_inner_id').val();
            	string=string+'&'+"individual_inner_id="+$('#individual_inner_id').val();
            	string=string+'&'+"region_path_inner_id="+$('#region_path_inner_id').val();
            	string=string+'&'+"response_doctor="+response_doctor;
            	string=string+'&'+"archive_doctor="+archive_doctor;
            	string=string+'&'+"new_response_doctor="+new_response_doctor;
            	string=string+'&'+"new_archive_doctor="+new_archive_doctor;
            	string=string+'&'+"confirm_change_org="+confirm_change_org;
            	string=string+'&'+"updated="+$('#updated').val();
            	string=string+'&'+"action="+$('#action').val();
                string=string+'&'+"census="+$('input[name="census"]:checked').val();
            	<?php if ($this->_tpl_vars['action'] == 'edit'): ?>
            	string=string+'&'+"created_time="+created_time_string;
            	<?php endif; ?>
            	//	alert(string);
            	$.ajax({
            		type: "POST",
            		url: "<?php echo $this->_tpl_vars['basePath']; ?>
iha/cover/addsave",
            		data: string,
            		success: function(returnValue){
            			//alert( "Data Saved: " + returnValue );
            			//document.write(returnValue);
            			var values=returnValue.split('|');
            						//alert(values);
            			if(values['0']=='ok'){
            				/*				if($('#action').val()=='add'){
            				$('#family_number_old').val(values['3']);
            				$('#family_inner_id_old').val(values['4']);
            				}*/
            				//echo 'ok|'.$uuid.'|'.$individualInnerId.'|'.$family_number.'|'.$familyInnerId;
            				$('#uuid').val(values['1']);
            				$('#individual_inner_id').val(values['2']);
            				$('#family_number').val(values['3']);
            				$('#family_inner_id').val(values['4']);
            				$('#region_path_inner_id').val(values['5']);
            				if($('#relation_of_householder').val()==1){
            					$('#family_number_old').val(values['3']);
            					$('#family_inner_id_old').val(values['4']);
            				}else{
            					$('#family_number_old').val('');
            					$('#family_inner_id_old').val('');
            				}
            				$('#id_std1').html(values['6']);
            				$('#id_std2').html(values['7']);
            				$('#region_last_id_old').val($('#region_last_id').val());
            
            				//设置显示用的个人档案号
            				if($('#action').val()=='add'){
            					//setStandardCode();
            				}
            
            				//设置session
            				//var url="<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/setsession/uuid/"+uuid;
            				var uuid=$('#uuid').val();
            				var url="<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/setsession/uuid/"+uuid;
            				setSession(url,uuid);
            				alert('数据已保存');
            				//一旦成功添加记录，就把增加状态改为编辑状态
            				$('#action').val('edit');
            
            				//打开通向下一步的按钮
            				$('#skip').attr('disabled','');	
            			}else{	
                			 if(values['0']=='double')
                             {
                				alert('身份证号码重复。');
                             }
                            else
                            {     
                                alert(values['0']);
                                if(values['0']=='tt')   
                                {
                                	alert('同一天中不能多次添加档案');
                                } 
                                else
                                {            	
                               	 alert('数据保存失败，请联系管理员');
                                }
                            }
            			}
            			$('#save').attr('disabled','');
            
            			//alert($('#family_number').val());
            
            		}
            	});
                return true;
			}
		}
	});
	/*	var region_id_2=$('#region_id_2').val();
	if(region_id_2=='-9'){
	alert('请选择正确的乡镇（街道）名称');
	$('#region_id_2').focus();
	return;
	}
	var region_id_3=$('#region_id_3').val();
	if(region_id_3=='-9'){
	alert('请选择正确的村（居委会）名称');
	$('#region_id_3').focus();
	return;
	}
	var region_id_4=$('#region_id_4').val();
	if(region_id_4=='-9'){
	alert('请选择正确的组（小区）名称');
	$('#region_id_4').focus();
	return;
	}*/

	//alert($('#region_last_id').val());
	
}
function addressSyn(address){
	if($('#residence_address').val()==''){
		$('#residence_address').val(address);
	}
}
function setSession(url,uuid)
{
	//alert(url);
	$.ajax({
		type:"GET",
		url:url,
		dataType:"html",
		data:"",
		beforeSend:function(){},
		success:function(){	}
	});
	var name=$('#name').val();
	$(window.top.frames["right_top"].document).find('#patient').html(name);
}
//设置家庭档案相关信息
function setValue(name,family_number,familyInnerId){
	//alert(name);
	$('#householderName').html(name);
	$('#family_number').val(family_number);
	$('#family_inner_id').val(familyInnerId);
}
function setName(name){
	if($('#relation_of_householder').val()=='1'){
		$('#householderName').html(name);
	}
}
function setRelationOfHouseholder(obj,value,oldValue){
	//alert($('#relation_of_householder').val());
	//alert(value+'|'+oldValue);
	//return;
	//如果已是户主，修改为其它，则先提示
	if(oldValue=='1' && value!=oldValue){
		if(confirm('是否确定将改变档案状态。')){
			if(confirm('请再次确认')){
				//判断并且删除家庭档案
				if($('#family_number').val()!='' && !checkHouseHolder()){
					alert('此户主已有家庭成员，不能修改为其他身份。\n如果真需要修改，应先将此家庭的其它成员转出。');
					obj.value=oldValue;
					return;
				}else{
					//$('#family_number_delete').val($('#family_number').val());
					//$('#family_inner_id').val($('#family_inner_id').val());
				}
			}else{
				//alert(value+'|'+oldValue+'540');
				obj.value=oldValue;
				return;
			}
		}else{
			obj.value=oldValue;
			return;
		}
	}
	//把户主改成了非户主又改回来
	//alert(value+'|'+oldValue+'|'+$('#family_number_old').val()+'|'+$('#action').val());
	//if(value=='1' && oldValue!=value && $('#family_number_old').val()!='' && $('#action').val()=='edit'){
	if(value=='1' && oldValue!=value){
		$('#family_number').val('');
		$('#family_inner_id').val('');

		/*		if($('#family_number_delete').val()!=''){
		$('#family_number').val('1');
		$('#family_inner_id').val($('#family_inner_id').val($('#family_inner_id').val()));

		}
		$('#family_number').val($('#family_number_old').val());
		$('#family_inner_id').val($('#family_inner_id_old').val());
		*/

		//alert($('#family_number').val());

	}
	if(value=='1'){
		$('#householderName').html($('#name').val());
	}
	//alert(name);
	//$('#householderName').html(name);
	//$('#family_number').val('');
	//$('#family_inner_id').val('');
	if(value!='1' && value!='-9'){
		var id='1';//此时的id没有什么用，仅用于占位
		var url="<?php echo $this->_tpl_vars['basePath']; ?>
iha/cover/search/id/"+id+'/sid/'+Math.random();
		//alert(url);
		var obj=document.getElementById('householderName');
		window.showModalDialog(url,window,'DialogTop:250px;DialogLeft:350px;DialogWidth:650px;DialogHeight:250px;help:no;status:no');
	}
	if(value=='-9'){
		$('#householderName').html('');
	}
}
function checkHouseHolder(){
	var familyNumber=$('#family_number').val();
	//var string='';
	var string1="familyNumber="+familyNumber;
	//alert(string1);
	var url1="<?php echo $this->_tpl_vars['basePath']; ?>
iha/cover/checkHouseHolder/familyNumber/"+familyNumber+'/rand/'+Math.random();
	var result=true;
	$.ajax({
		async:false,
		type:"POST",
		url:url1,
		data:string1,
		success: function(returnValue){
			if(parseInt(returnValue)>1){
				result=false;
				
			}else{
				result=true;
			}
		}
	});
	
	return result;
}
//生成新的档案状态
function created_input(obj,value)
{
	if(value!=='-9')
	{
		var x=parseInt(Math.random()*(1000000-1))+1;//产生随机数作为创建的ID号
		var obj  = $(obj);
	    var description = obj.find("option:selected").text(); 
		var status_flag_list = $("#status_flag_list");
		var img_string = '<span><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/unchecked.gif" onclick="return del_item('+x+');"/></span>';
		if(value!=='1')
		{
			var reason = '备注：<input type="text" name="reason_array[]"/>';
		}
		else
		{
			var reason = '';
		}
                                     if(value!=='6')
                                    {
                                        var created = $('<tr id="'+x+'" style="height:50px;line-hight:50px;"><td  class="right" width="45%" >状态：<span class="description_span">'+description+'</span><input type="hidden" name="status_array[]" value="'+value+'" class="description_v" /></td><td>'+reason+'<br />时间：<input  type="text" value="<?php echo $this->_tpl_vars['current_time']; ?>
"   onFocus="WdatePicker({startDate: \'%y-%M-01\' ,dateFmt:\'yyyy-MM-dd\',alwaysUseStartDate: true })" name="status_array_time[]" />&nbsp;&nbsp;&nbsp;&nbsp;'+img_string+'</td></tr>');
                                        created.appendTo(status_flag_list);
                                    }
                                    else
                                      {
                                          obj.attr('disabled','disabled');
                                          var created = $('<tr id="'+x+'" style="height:50px;line-hight:50px;"><td  class="right" width="45%" >状态：<span class="description_span">'+description+'</span><input type="hidden" name="status_array[]" value="'+value+'" class="description_v" /></td><td>'+reason+'<br />时间：<input  type="text" value="<?php echo $this->_tpl_vars['current_time']; ?>
"   onFocus="WdatePicker({startDate: \'%y-%M-01\' ,dateFmt:\'yyyy-MM-dd\',alwaysUseStartDate: true })" name="status_array_time[]" />&nbsp;&nbsp;&nbsp;&nbsp;'+img_string+'</td></tr>');
                                          created.appendTo(status_flag_list);
                                      }
		
	}
}              
function del_item(id)
{
	if(window.confirm("确定删除该条状态或重新编辑吗?删除档案记录后请再次保存！"))
	{
       $("#"+id).remove(); 
       //将档案状态的下拉框中的值选中和重新赋值
       var last_description = $(".description_span").last().text();
       var last_input = $(".description_v").last().val();
       $("#status_flag").val(last_input);
       $("#status_flag").find("option:selected").text(last_description);
       var description_v = document.getElementsByName('status_array[]');
      var description_v_len = description_v.length;
      //当有死亡状态的人出现时  下拉框的属性发生变化
      $("#status_flag").attr('disabled','');
      for(var i=0;i<description_v_len;i++)
        {
               if(description_v[i].value=='6')
                {
                    $("#status_flag").attr('disabled','disabled');
                }
        }
            return true;
	}
	else
	{
		return false;
	}
}

function setStatusflag(obj,value,sta_flag){
	if($('#relation_of_householder').val()==1)
	{		
		if($('#family_number').val()!=''&&!checkHouseHolder())
		{
			if($('#status_flag').val()!='1' && $('#status_flag').val()!='-9')
			{
				alert('此户主已有家庭成员，不能将其档案状态修改为临时、死亡、转出。\n如果真需要修改，应先将此家庭的其它成员转出，再修改此人的档案状态。');
				$(obj).val(1);
				$(obj).attr('checked',true);
			}
			else
			{
				obj.value=sta_flag;			
				return;
			}
		}
		else
		{
			//户主的情况 没有其他家庭成员
			created_input(obj,value);
		}
	}
	else
	{
		created_input(obj,value);
	}
}

//生成下一级下拉框
/**
@id 当前对象的值
@obj当前对象
@下级下拉框的id或是名称
*/
var org_region_domain=new Array(<?php echo $this->_tpl_vars['org_region_domain']; ?>
);
</script>

<input type="hidden" id="region_id" name="region_id" value="<?php echo $this->_tpl_vars['region_id_1']; ?>
" />
<input type="hidden" id="region_p_id" name="region_p_id" value="<?php echo $this->_tpl_vars['region_id_1']; ?>
" />
<input type="hidden" id="region_last_id_old" name="region_last_id_old" value="<?php echo $this->_tpl_vars['region_last_id_old']; ?>
" />
<script type="text/javascript">
var region_id=document.getElementById('region_id').value;
var region_p_id=document.getElementById('region_p_id').value;
var relation_of_householder_disabled='<?php echo $this->_tpl_vars['relation_of_householder_disabled']; ?>
';
var xmlHttp;
getDropDownBox();
function getDropDownBox(){
	//alert(parentId+id);
	if(region_p_id=='-9'){
		alert('请选择一项分类');
		return;
	}
	xmlHttp=getXmlHttpObject();
	//url='/management/menu/menuDropDownBox/parentId/'+parentId+'/id/'+id+'/sid/'+Math.random();
	//var url='<?php echo $this->_tpl_vars['basePath']; ?>
region/region/menuDropDownBox1/p_id/'+region_p_id+'/relation_of_householder_disabled/'+relation_of_householder_disabled+'/sid/'+Math.random();
	var url='<?php echo $this->_tpl_vars['basePath']; ?>
region/region/menuDropDownBox1/p_id/'+region_p_id+'/sid/'+Math.random();
	//alert(url);
	xmlHttp.onreadystatechange=processDropDownBox;
	xmlHttp.open('GET',url,true);
	xmlHttp.send(null);

}
function checkValue(){
	//alert(parentId);
	if(document.getElementById('region_p_id').value=='-9'){
		alert('请选择一项分类');
		return false;
	}else{
		return true;
	}
}
function processDropDownBox(){
	//alert(xmlHttp.readyState);
	if(xmlHttp.readyState==4 && xmlHttp.status==200){
		//alert(xmlHttp.readyState);
		//注：firefox不支持innerText
		var objDiv=document.getElementById('menuDropDownBox');
		//alert('1');
		//alert(xmlHttp.responseText);
		objDiv.innerHTML=xmlHttp.responseText;
		//objDiv.style.display='inline';
		//alert('yes');
		//如果不满足条件，则全部灰化
		var objs=document.getElementsByTagName('select');
		//alert(objs.length)
		var length=objs.length;
		for(i=0;i<length;i++){
			//alert(objs[i].getAttribute('myclass'));
			if(objs[i].getAttribute('myclass')!='region_dropdown_box'){
				continue;
			}
			if(relation_of_householder_disabled=='disabled'){
				objs[i].setAttribute('disabled','disabled');
			}
		}
	}
}
function changeValue(obj,oldValue,currentValue){
	var tempValue=currentValue.split("|")
	if(tempValue[0]=='-9'){
		//如果选择了　请选择，则把此级的父级作为当前选定的项目
		region_p_id=tempValue[1];
		document.getElementById('region_p_id').value=tempValue[1];

	}else{
		region_p_id=tempValue[0];
		document.getElementById('region_p_id').value=tempValue[0];

	}
	getDropDownBox();
}
//objDiv=$('categoryDropDownBox');
//objDiv.innerHTML="<select><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";
function getXmlHttpObject()
{
	var xmlHttp;
	try{
		xmlHttp=new ActiveXObject('MSXML2.XMLHTTP.3.0');//IE
	}catch(e){
		try{
			xmlHttp=new XMLHttpRequest();//firefox
		}catch(e){
			alert('不能正常创建xmlhttp对象');
		}
	}
	return xmlHttp;
}
/*if(document.getElementById('error_message').value!=''){
alert(document.getElementById('error_message').value);
}*/
function status_tag_change()
{
	var status_flag = $("#status_flag");
	status_flag.change(function(){
		alert($(this).val());
	});
}
</script>