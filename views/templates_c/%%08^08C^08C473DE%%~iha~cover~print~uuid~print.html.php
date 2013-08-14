<?php /* Smarty version 2.6.14, created on 2013-05-21 10:42:59
         compiled from print.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'print.html', 135, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>个人健康档案封面</title>

<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/region.js"></script>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/cover.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/skin/default/datePicker.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	@media   print{ 
.noprint {display:none} 
	
	}
.standrd{
	font-size:12px;
	display:inline; 
	border:2px solid black;
	margin-left:2px;
	margin-right:2px;
	padding-left:3px;
	padding-right:2px;
	text-decoration:none;
	
	}
	
   img{
    margin:0px;
    padding:0px;
   }
   table{
    
   }
   .maindiv{
       margin-top:30px;
       text-align:center;
   }
   .divcontent{
      border:1px solid black;
      width:600px;
   }
   .line{
        border-top:0px;
		border-left:0px;
		border-right:0px;
		border-bottom:1px solid black;
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
  .divcontent span{
	text-decoration:underline;
  }
</style>
</head>
<body>
   <div class="maindiv">
    
     
      <div class="divcontent">
		 <table border="0" width="96%" cellspacing="0">
				<tr>
				<td height="33" colspan="2"  align="right">编号&nbsp;<?php echo $this->_tpl_vars['stand_code']; ?>
</td>
				</tr>
                <tr><td colspan="2" align="center"></td>
                </tr>
                 <tr><td colspan="2" align="center">  <p align="center" style="font-size:20px;font-family:宋体;">居民健康档案</p></td>
                </tr>
                 <tr><td colspan="2"></td>
                </tr>
					<tr>
					<td align="right" width="50%">姓&nbsp;&nbsp;&nbsp;&nbsp;名：</td>
					<td align="left" width="50%"><input type="text" name="name" id="name" size="25" class="line" onkeyup="setName(this.value)" onblur="checkDouble();" value="<?php echo $this->_tpl_vars['row']['name']; ?>
"/>
					</td>
					</tr>
					
					<tr>
					<td class="right" width="45%" class="core_identity_number">身份证号：</td>
					<td align="left" width="55%"><input type="text" name="identity_number" id="identity_number" size="25" class="line" onblur="checkDouble();" value="<?php echo $this->_tpl_vars['row']['identity_number']; ?>
"  style="ime-mode:disabled" />
					<div id="showDoubleMessage" style="display:none;color:red;"></div>
					</td>
					</tr>
					
					<tr>
					<td align="right" width="50%">现&nbsp;住&nbsp;址：</td>
					<td align="left"><span><?php echo $this->_tpl_vars['row']['address']; ?>
</span></td>
					</tr>
					<tr>
					<td align="right" width="50%">户籍地址：</td>
					<td align="left" width="50%">
					<span ><?php echo $this->_tpl_vars['row']['residence_address']; ?>
</span></td>
					</tr>
					<tr>
					<td align="right" width="50%">联系电话：</td>
					<td align="left" width="50%"><input type="text" name="phone_number" id="phone_number" size="25" class="line" value="<?php echo $this->_tpl_vars['row']['phone_number']; ?>
"  style="ime-mode:disabled" /></td>
					</tr>
                    <tr>
                    <td align="right">乡镇（街道）名称：</td><td align="left" width="50%"><input type="text" name="phone_number" id="phone_number" size="25" class="line" value="<?php echo $this->_tpl_vars['path1']; ?>
"  style="ime-mode:disabled" /></td>
                    </tr>
                     <tr>
                    <td align="right">村（居）委会名称：</td><td align="left" width="50%"><input type="text" name="phone_number" id="phone_number" size="25" class="line" value="<?php echo $this->_tpl_vars['path2']; ?>
"  style="ime-mode:disabled" /></td>
                    </tr>
					<tr>
					<td colspan="2">
					 <span id="menuDropDownBox"></span>
					</td>
					</tr>
					<tr>
					<td align="right" width="50%">建档单位:</td>
					<td align="left" width="50%">
					<?php echo $this->_tpl_vars['organization_zh_name']; ?>

					<input type="text" name="phone_number2" id="phone_number2" size="25" class="line" value="<?php echo $this->_tpl_vars['org']['zh_name']; ?>
"  style="ime-mode:disabled" /></td>
					</tr>
					<tr>
					<td align="right" width="50%">建&nbsp;档&nbsp;人:</td>
					<td align="left" width="50%"><input type="text" name="phone_number3" id="phone_number3" size="25" class="line" value="<?php echo $this->_tpl_vars['staff_creat']['name_login']; ?>
"  style="ime-mode:disabled" /></td>
					</tr>
					
					<tr>
					<td align="right" width="50%">责任医生:</td>
					<td align="left" width="50%"><input type="text" name="phone_number4" id="phone_number4" size="25" class="line" value="<?php echo $this->_tpl_vars['staff_zeren']['name_login']; ?>
"  style="ime-mode:disabled" /></td>
					</tr>
					<tr>
					<td align="right" width="50%">建档日期:</td>
					<td align="left" width="50%"><input type="text" name="updated" id="updated" size="25"  onClick="WdatePicker({firstDayOfWeek:1})" class="line" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['row']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
" /></td>
					</tr>
                       <tr><td colspan='2'></td> </tr>
					<tr>
					<td colspan="2" class="noprint">
                  
					<input class="myline" type="button" name="print" id="print" value="打印" onclick="window.print() ;"  />
			
					<input class="myline" type="button" name="back" id="back" value="取消" onclick="window.close();"  />
					
					</td>
					</tr>
                    <tr><td colspan='2'></td> </tr>
                   
                  
                 
                   
                  
                    <tr><td colspan='2'></td> </tr>
                   
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