<?php /* Smarty version 2.6.14, created on 2013-05-07 10:31:22
         compiled from add.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/validator.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<title>添加个人档案</title>
<style>
	table
	{
		background:#ffffff;
	}
	input
	{
		border:1px solid blue;
	}
	label
	{
        cursor: pointer;
	}
	.short
	{
		width:15px;
		height:15px;
	}
	.line
	{
		border-top:0px;
		border-left:0px;
		border-right:0px;
	}
	.time
	{
		border-top:0px;
		border-left:0px;
		border-right:0px;
		width:30px;
	}
	#dialog_box_html li{
		border-bottom:1px dashed #ccc;
		line-height:28px;
	}
	.center table{
		margin:0px;
	}
	.center td
	{
		text-align:center;
	}
 h1{margin:0;padding:20px 0;font-size:16px;}
 ol{padding-left:20px;line-height:130%;}
 #box{width:600px;text-align:left;margin:0 auto;padding-top:80px;}
 #suggest,#suggest2{width:200px;}
 .gray{color:gray;}
 .ac_results {background:#fff;border:1px solid #7f9db9;position:absolute;z-index:20000;display: none;}
 .ac_results ul{margin:0;padding:0;list-style:none;}
 .ac_results li a{white-space: nowrap;text-decoration:none;display:block;color:#05a;padding:1px 3px;}
.ac_results li{border:1px solid #fff;}
.ac_over,.ac_results li a:hover {background:#c8e3fc;}
.ac_results li a span{float:right;}
.ac_result_tip{border-bottom:1px dashed #666;padding:3px;}
/*----------------------
	Camera slide up
-----------------------*/


#camera{
	background:url('<?php echo $this->_tpl_vars['basePath']; ?>
views/images/cam_bg.jpg') repeat-y;
	border:1px solid #f0f0f0;
	height:525px;
	width:398px;
	position:fixed;
	bottom: -466px;
	left:50%;
	margin-left:-300px;

	-moz-border-radius:4px 4px 0 0;
	-webkit-border-radius:4px 4px 0 0;
	border-radius:4px 4px 0 0;
	
	-moz-box-shadow:0 0 4px rgba(0,0,0,0.6);
	-webkit-box-shadow:0 0 4px rgba(0,0,0,0.6);
	box-shadow:0 0 4px rgba(0,0,0,0.6);
}

.camTop{
	background:url('<?php echo $this->_tpl_vars['basePath']; ?>
views/images/fancy_close.png') no-repeat center center;
	width:100%;
	height:66px;
	position:absolute;
	top:0;
	left:0;
	cursor:pointer;
}

.settings{
	background:url('<?php echo $this->_tpl_vars['basePath']; ?>
views/images/settings.png') no-repeat;
	cursor: pointer;
	height: 28px;
	position: absolute;
	right: 37px;
	top: 448px;
	width: 30px;
}

.settings:hover{
	background-position:left bottom;
}

#screen{
	width:320px;
	height:370px;
	margin: 66px auto 22px;
	background:#ccc;
	
	line-height: 360px;
    text-align: center;
	color:#666;
}

.buttonPane{
	text-align: center;
}
.blueButton,
.greenButton{
	background:url('<?php echo $this->_tpl_vars['basePath']; ?>
views/images/buttons.png') no-repeat;
	text-shadow:1px 1px 1px #277c9b;
	color:#fff !important;
	width:99px;
	height:38px;
	border:none;
	text-decoration:none;
	display:inline-block;
	font-size: 16px;
	line-height: 32px;
	text-align: center;
	margin: 0 4px;
}

.greenButton{
	background:url('<?php echo $this->_tpl_vars['basePath']; ?>
views/images/buttons.png') no-repeat right top;
	text-shadow:1px 1px 1px #498917;
}

.blueButton:hover,
.greenButton:hover{
	background-position:left bottom;
	text-decoration:none !important;
}

.greenButton:hover{
	background-position:right bottom;
}

.blueButton:active,
.greenButton:active{
	position:relative;
	bottom:-1px;
}

.hidden{
	display:none;
}
<?php echo $this->_tpl_vars['archive_rate_css']; ?>

</style>
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/formValidatorRegex.js" type="text/javascript" charset="UTF-8"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>   <!--时间控件的加载!-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/popup.js" type="text/javascript"></script> 
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/skin/default/datePicker.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/iha_add.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/j.dimensions.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/operation_pinyin.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/j.suggest.js"></script>
<!--摄像头-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/fancybox/jquery.easing-1.3.pack.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/webcam/webcam.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/cam.js"></script>
<script>
$(document).ready(function(){
	$("input[disabled]").css("border-bottom","1px solid #ccc");
	//因为模板无法向文件传值的问题，因此将此代码写在文件中
	//处理医疗支付方式
	$("input[name='charge_style[]']").each(function(){
		$(this).blur(function(){
			$("input[name='charge_style[]']").each(function(){
				//转换过来只是JSON字符串，需要解析一次
				var charge_style_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['charge_style_json']; ?>
');
				var input_val=$(this).val();
				if(input_val!="" && charge_style_array[input_val][0]=="-99")
				{
					$("#charget_comment").attr("disabled",false);
					if($("#charget_comment").val()=="")
					{
						$("#charget_comment").focus();
					}
					return false;//只要出现了其他项，则退出
				}
				else
				{
					$("#charget_comment").attr("disabled",true);
				}
			});
		});
	});
	//处理过敏史
	$("input[name='allergy_history[]']").each(function(){
		$(this).blur(function(){
			$("input[name='allergy_history[]']").each(function(){
				var allergy_history_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['allergy_history_json']; ?>
');
				var input_val=$(this).val();
				if(input_val!="" && allergy_history_array[input_val][0]=="-99")
				{
					$("#allergy_comment").attr("disabled",false);
					if($("#allergy_comment").val()=="")
					{
						$("#allergy_comment").focus();
					}
					return false;//只要出现了其他项，则退出
				}
				else
				{
					$("#allergy_comment").attr("disabled",true);
				}
			});
		});
	});
	//处理疾病史
	$("input[name='disease_history[]']").each(function(){
		$(this).blur(function(){
			$("input[name='disease_history[]']").each(function(){
				var disease_history_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['disease_history_json']; ?>
');
				var input_val=$(this).val();
				if(input_val!="" && disease_history_array[input_val][0]=="-99" && $("#disease_comment").attr("disabled")==true)
				{
					$("#disease_comment").attr("disabled",false);
					if($("#disease_comment").val()=="")
					{
						$("#disease_comment").focus();
					}
					return false;//只要出现了其他项，则退出
				}
				else
				{
					$("#disease_comment").attr("disabled",true);
				}
			});
		});
	});
	//残疾状况
	$("input[name='disability[]']").each(function(){
		$(this).blur(function(){
			$("input[name='disability[]']").each(function(){
				var deformity_type_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['deformity_type_json']; ?>
');
				var input_val=$(this).val();
				if(input_val!="" && deformity_type_array[input_val][0]=="-99")
				{
					$("#deformity_comment").attr("disabled",false);
					if($("#deformity_comment").val()=="")
					{
						$("#deformity_comment").focus();
					}
					return false;//只要出现了其他项，则退出
				}
				else
				{
					$("#deformity_comment").attr("disabled",true);
				}
			});
		});
	});
	//手术史
	$("input[name='surgery_history[]']").each(function(i){$(this).suggest(operation_pinyin,{hot_list:operation_eight,attachObject:"#suggest_"+(i+1)});})
    //
    $(".multi").blur(function(){set_input_order($(this).attr("name"));});
});
    //检验确诊日期
    function chk_qzdate()
    {
        var status=true;
        $("input[name='disease_history[]']").each(function(){
				if($(this).parent().next().html())
                {
                    if($(this).val() && $(this).val()!='1' && !$(this).parent().next("input[name='year[]']").val())
                    {
                        $(this).parent().next("input[name='year[]']").focus();
                        alert('请填写确诊时间');
                        status=false;
                        return false;
                    }
                }
                else
                {
                    if($(this).val() && $(this).val()!='1' && !$(this).next().val())
                    {
                        $(this).next().focus();
                        alert('请填写确诊时间');
                        status=false;
                        return false;
                    }
                }
        });
        if(status)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
</script>
</head>
<body>
	<form name="individual_archive" enctype="multipart/form-data" id="individual_archive" method="post" action="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/index/editin" onsubmit="return chk_qzdate()">
<table border="0" width="100%">
	<thead>
	<tr>
		<th colspan="7" style="font-size:16px;text-align:center;">个人基本信息表<img title="“本表的每一个数据记录都要给体检日期、责任医生联系起来”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" /></th>
    </tr>
    	</thead>
		<tr>
        <td colspan="2" style="width:160px;">
        	姓名
        </td>
        <td style="width:80px;">
        	<input type="hidden" name="uuid" id="uuid" value="<?php echo $this->_tpl_vars['core']->uuid; ?>
" /><?php echo $this->_tpl_vars['core']->name; ?>

        </td>
        
        <td style="width:80px;">
        	编号
        </td>
        <td style="width:440px;" colspan="2">
        	<?php echo $this->_tpl_vars['core']->standard_code_1; ?>

        </td>
        <td style="width:120px;margin: 2px auto;text-align: center;" rowspan="3"><img <?php if ($this->_tpl_vars['headpic']): ?>src="<?php echo $this->_tpl_vars['headpic']; ?>
"<?php else: ?>src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/nopic.gif"<?php endif; ?> id="headpic" style="width:105px;height: 128px;" />
        <br />
        <input type="file" name="headpic" id="headinput" size="15" />
        <br />
        <img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/cam.png" id="cam_img" style="cursor: pointer;" />
           </td>
    </tr>
    <tr>
        <td colspan="2" class="core_sex">
        	性别
        </td>
        <td colspan="2">
        	<?php $_from = $this->_tpl_vars['sex']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','sex')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>
			&nbsp;<input type="text" name="sex" value="<?php echo $this->_tpl_vars['core']->sex; ?>
" class="short" tabindex="3" />&nbsp;
        </td>
        <td class="core_date_of_birth">
        	出生日期<img title="“出生日期：根据居民身份证的出生日期，按照年（4位）、月（2位）、日（2位）顺序填写，如1949-01-01。”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />
        </td>
        <td>
        	<?php echo $this->_tpl_vars['core']->date_of_birth; ?>

		</td>
    </tr>
    <tr>
        <td colspan="2" class="core_identity_number">
        	身份证号
        </td>
        <td colspan="2">
        	<?php echo $this->_tpl_vars['core']->identity_number; ?>

        </td>
        <td class="archive_unit_name">
        	工作单位<img title="“工作单位：应填写目前所在工作单位的全称。离退休者填写最后工作单位的全称；下岗待业或无工作经历者须具体注明。”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />
        </td>
        <td colspan="1">
        	<input type="text" name="unit_name" value="<?php echo $this->_tpl_vars['individual']->unit_name; ?>
" id="unit_name" class="line" size="35" />
        </td>
    </tr>
    <tr>
        <td colspan="2" class="core_phone_number">
        	本人电话
        </td>
        <td>
        	<?php echo $this->_tpl_vars['core']->phone_number; ?>

        </td>
        <td class="archive_contact">
        	联系人姓名<img title="“联系人姓名：填写与建档对象关系紧密的亲友姓名。”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />
        </td>
        <td>
        	<input type="text" name="contact" value="<?php echo $this->_tpl_vars['individual']->contact; ?>
" id="contact" class="line" size="16" />
        </td>
        <td class="archive_contact_number">
        	联系人电话
        </td>
        <td>
        	<input type="text" name="contact_number" value="<?php echo $this->_tpl_vars['individual']->contact_number; ?>
" id="contact_number" class="line" size="16" />
        </td>
    </tr>
    <tr>
        <td colspan="2" class="archive_residence">
        	常住类型
        </td>
        <td colspan="2">
        	<?php $_from = $this->_tpl_vars['registered_permanent_residence']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','registered_permanent_residence')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;
			<input type="text" name="registered_permanent_residence" value="<?php echo $this->_tpl_vars['individual']->residence; ?>
" class="short" />&nbsp;
        </td>
        <td class="core_race">
        	民族
        </td>
        <td colspan="2">
        	<?php $_from = $this->_tpl_vars['race']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','race')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;
			<select name="races" <?php if ($this->_tpl_vars['core']->race != 2): ?> disabled="true"<?php endif; ?>>
			<option value="-9">请选择</option>
			<?php $_from = $this->_tpl_vars['races']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<option <?php if ($this->_tpl_vars['core']->race_detail == $this->_tpl_vars['k']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
			</select>
			&nbsp;
			<input type="text" name="race" value="<?php echo $this->_tpl_vars['core']->race; ?>
" class="short" onblur="chkrace(this)" />
        </td>
    </tr>
	<tr>
        <td colspan="2">
        	血型<img title="“血型：在前一个“□”内填写与ABO血型对应编号的数字；在后一个“□”内填写是否为“RH阴性”对应编号的数字。”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />
        </td>
        <td colspan="5">
        	<?php $_from = $this->_tpl_vars['ABO_bloodtype']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','abo_bloodtype')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;/&nbsp;&nbsp;RH阴性:<?php $_from = $this->_tpl_vars['RH_bloodtype']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','rh_bloodtype')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;<input type="text" name="abo_bloodtype" value="<?php echo $this->_tpl_vars['blood']->abo_bloodtype; ?>
" class="short" />/<input type="text" name="rh_bloodtype" value="<?php echo $this->_tpl_vars['blood']->rh_bloodtype; ?>
" class="short" />
        </td>
    </tr>
	<tr>
        <td colspan="2" class="archive_study_history">
        	文化程度<img title="“文化程度：指截至建档时间，本人接受国内外教育所取得的最高学历或现有水平所相当的学历。”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />
        </td>
        <td colspan="5">
        	<?php $_from = $this->_tpl_vars['school_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','study_history')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;<input type="text" name="study_history" value="<?php echo $this->_tpl_vars['individual']->study_history; ?>
" class="short" />
        </td>
    </tr>
	<tr>
        <td colspan="2" class="archive_occupation">
        	职业
        </td>
        <td colspan="5">
        	<?php $_from = $this->_tpl_vars['occupation']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','occupation')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;<input type="text" name="occupation" value="<?php echo $this->_tpl_vars['individual']->occupation; ?>
" class="short" />
        </td>
    </tr>
	<tr>
        <td colspan="2" class="archive_marriage">
        	婚姻状况
        </td>
        <td colspan="5">
        	<?php $_from = $this->_tpl_vars['marriage']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','marriage')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;<input type="text" name="marriage" value="<?php echo $this->_tpl_vars['individual']->marriage; ?>
" class="short" />
        </td>
    </tr>
	<tr>
        <td colspan="2" class="archive_charge_style">
        	医疗费用支付方式
        </td>
        <td colspan="5">
        	<?php $_from = $this->_tpl_vars['charge_style']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_values('<?php echo $this->_tpl_vars['k']; ?>
','charge_style[]')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;<input type="text" name="charget_comment" value="<?php echo $this->_tpl_vars['charge_comment']; ?>
" id="charget_comment" class="line" <?php if (! $this->_tpl_vars['charge_sign']): ?>  disabled="true"<?php endif; ?> />&nbsp;
			<?php unset($this->_sections['charge']);
$this->_sections['charge']['name'] = 'charge';
$this->_sections['charge']['loop'] = is_array($_loop=3) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['charge']['show'] = true;
$this->_sections['charge']['max'] = $this->_sections['charge']['loop'];
$this->_sections['charge']['step'] = 1;
$this->_sections['charge']['start'] = $this->_sections['charge']['step'] > 0 ? 0 : $this->_sections['charge']['loop']-1;
if ($this->_sections['charge']['show']) {
    $this->_sections['charge']['total'] = $this->_sections['charge']['loop'];
    if ($this->_sections['charge']['total'] == 0)
        $this->_sections['charge']['show'] = false;
} else
    $this->_sections['charge']['total'] = 0;
if ($this->_sections['charge']['show']):

            for ($this->_sections['charge']['index'] = $this->_sections['charge']['start'], $this->_sections['charge']['iteration'] = 1;
                 $this->_sections['charge']['iteration'] <= $this->_sections['charge']['total'];
                 $this->_sections['charge']['index'] += $this->_sections['charge']['step'], $this->_sections['charge']['iteration']++):
$this->_sections['charge']['rownum'] = $this->_sections['charge']['iteration'];
$this->_sections['charge']['index_prev'] = $this->_sections['charge']['index'] - $this->_sections['charge']['step'];
$this->_sections['charge']['index_next'] = $this->_sections['charge']['index'] + $this->_sections['charge']['step'];
$this->_sections['charge']['first']      = ($this->_sections['charge']['iteration'] == 1);
$this->_sections['charge']['last']       = ($this->_sections['charge']['iteration'] == $this->_sections['charge']['total']);
?>
			<input type="text" name="charge_style[]" value="<?php echo $this->_tpl_vars['charge'][$this->_sections['charge']['index']]['display_style']; ?>
" class="short multi" />/&nbsp;
			<?php endfor; endif; ?>
        </td>
    </tr>
	<tr>
        <td colspan="2" class="archive_allergy_history">
        	药物过敏史<img title="“药物过敏史：表中药物过敏主要列出青霉素、磺胺或者链霉素过敏，如有其他药物过敏，请在其他栏中写明名称，可以多选。”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />
        </td>
        <td colspan="5">
        	<?php $_from = $this->_tpl_vars['allergy_history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_values('<?php echo $this->_tpl_vars['k']; ?>
','allergy_history[]')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;<input type="text" name="allergy_comment" id="allergy_comment" value="<?php echo $this->_tpl_vars['allergy_comment']; ?>
" class="line" <?php if (! $this->_tpl_vars['allergy_sign']): ?>  disabled="true"<?php endif; ?> />&nbsp;
			<?php unset($this->_sections['allergy']);
$this->_sections['allergy']['name'] = 'allergy';
$this->_sections['allergy']['loop'] = is_array($_loop=4) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['allergy']['show'] = true;
$this->_sections['allergy']['max'] = $this->_sections['allergy']['loop'];
$this->_sections['allergy']['step'] = 1;
$this->_sections['allergy']['start'] = $this->_sections['allergy']['step'] > 0 ? 0 : $this->_sections['allergy']['loop']-1;
if ($this->_sections['allergy']['show']) {
    $this->_sections['allergy']['total'] = $this->_sections['allergy']['loop'];
    if ($this->_sections['allergy']['total'] == 0)
        $this->_sections['allergy']['show'] = false;
} else
    $this->_sections['allergy']['total'] = 0;
if ($this->_sections['allergy']['show']):

            for ($this->_sections['allergy']['index'] = $this->_sections['allergy']['start'], $this->_sections['allergy']['iteration'] = 1;
                 $this->_sections['allergy']['iteration'] <= $this->_sections['allergy']['total'];
                 $this->_sections['allergy']['index'] += $this->_sections['allergy']['step'], $this->_sections['allergy']['iteration']++):
$this->_sections['allergy']['rownum'] = $this->_sections['allergy']['iteration'];
$this->_sections['allergy']['index_prev'] = $this->_sections['allergy']['index'] - $this->_sections['allergy']['step'];
$this->_sections['allergy']['index_next'] = $this->_sections['allergy']['index'] + $this->_sections['allergy']['step'];
$this->_sections['allergy']['first']      = ($this->_sections['allergy']['iteration'] == 1);
$this->_sections['allergy']['last']       = ($this->_sections['allergy']['iteration'] == $this->_sections['allergy']['total']);
?>
			<input type="text" name="allergy_history[]" value="<?php echo $this->_tpl_vars['allergy'][$this->_sections['allergy']['index']]['code']; ?>
" class="short multi" />/
			<?php endfor; endif; ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="archive_exposure_history">
        	暴露史
        </td>
        <td colspan="5">
        	<?php $_from = $this->_tpl_vars['exposure_history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_values('<?php echo $this->_tpl_vars['k']; ?>
','exposure_history[]')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;
			<?php unset($this->_sections['exposure_history']);
$this->_sections['exposure_history']['name'] = 'exposure_history';
$this->_sections['exposure_history']['loop'] = is_array($_loop=3) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['exposure_history']['show'] = true;
$this->_sections['exposure_history']['max'] = $this->_sections['exposure_history']['loop'];
$this->_sections['exposure_history']['step'] = 1;
$this->_sections['exposure_history']['start'] = $this->_sections['exposure_history']['step'] > 0 ? 0 : $this->_sections['exposure_history']['loop']-1;
if ($this->_sections['exposure_history']['show']) {
    $this->_sections['exposure_history']['total'] = $this->_sections['exposure_history']['loop'];
    if ($this->_sections['exposure_history']['total'] == 0)
        $this->_sections['exposure_history']['show'] = false;
} else
    $this->_sections['exposure_history']['total'] = 0;
if ($this->_sections['exposure_history']['show']):

            for ($this->_sections['exposure_history']['index'] = $this->_sections['exposure_history']['start'], $this->_sections['exposure_history']['iteration'] = 1;
                 $this->_sections['exposure_history']['iteration'] <= $this->_sections['exposure_history']['total'];
                 $this->_sections['exposure_history']['index'] += $this->_sections['exposure_history']['step'], $this->_sections['exposure_history']['iteration']++):
$this->_sections['exposure_history']['rownum'] = $this->_sections['exposure_history']['iteration'];
$this->_sections['exposure_history']['index_prev'] = $this->_sections['exposure_history']['index'] - $this->_sections['exposure_history']['step'];
$this->_sections['exposure_history']['index_next'] = $this->_sections['exposure_history']['index'] + $this->_sections['exposure_history']['step'];
$this->_sections['exposure_history']['first']      = ($this->_sections['exposure_history']['iteration'] == 1);
$this->_sections['exposure_history']['last']       = ($this->_sections['exposure_history']['iteration'] == $this->_sections['exposure_history']['total']);
?>
			<input type="text" name="exposure_history[]" value="<?php echo $this->_tpl_vars['exposure'][$this->_sections['exposure_history']['index']]['code']; ?>
" class="short multi" />/
			<?php endfor; endif; ?>
        </td>
    </tr>
	<tr>
        <td rowspan="4" class="archive_disease_history">
        	既往史
        </td>
		<td>
        	疾病<img title="“疾病  填写现在和过去曾经患过的某种疾病，包括建档时还未治愈的慢性病或某些反复发作的疾病，并写明确诊时间，如有恶性肿瘤，请写明具体的部位或疾病名称,如有职业病，请填写具体名称。对于经医疗单位明确诊断的疾病都应以一级及以上医院的正式诊断为依据，有病史卡的以卡上的疾病名称为准，没有病史卡的应有证据证明是经过医院明确诊断的。可以多选。”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />
        </td>
        <td colspan="5">
        	<?php $_from = $this->_tpl_vars['disease_history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_values('<?php echo $this->_tpl_vars['k']; ?>
','disease_history[]')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;<input type="text" name="disease_comment" id="disease_comment" class="line" value="<?php echo $this->_tpl_vars['clinical_comment']; ?>
" class="line" <?php if (! $this->_tpl_vars['clinical_sign']): ?>  disabled="true"<?php endif; ?> /><br />
			<?php unset($this->_sections['disease_history']);
$this->_sections['disease_history']['name'] = 'disease_history';
$this->_sections['disease_history']['loop'] = is_array($_loop=14) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['disease_history']['show'] = true;
$this->_sections['disease_history']['max'] = $this->_sections['disease_history']['loop'];
$this->_sections['disease_history']['step'] = 1;
$this->_sections['disease_history']['start'] = $this->_sections['disease_history']['step'] > 0 ? 0 : $this->_sections['disease_history']['loop']-1;
if ($this->_sections['disease_history']['show']) {
    $this->_sections['disease_history']['total'] = $this->_sections['disease_history']['loop'];
    if ($this->_sections['disease_history']['total'] == 0)
        $this->_sections['disease_history']['show'] = false;
} else
    $this->_sections['disease_history']['total'] = 0;
if ($this->_sections['disease_history']['show']):

            for ($this->_sections['disease_history']['index'] = $this->_sections['disease_history']['start'], $this->_sections['disease_history']['iteration'] = 1;
                 $this->_sections['disease_history']['iteration'] <= $this->_sections['disease_history']['total'];
                 $this->_sections['disease_history']['index'] += $this->_sections['disease_history']['step'], $this->_sections['disease_history']['iteration']++):
$this->_sections['disease_history']['rownum'] = $this->_sections['disease_history']['iteration'];
$this->_sections['disease_history']['index_prev'] = $this->_sections['disease_history']['index'] - $this->_sections['disease_history']['step'];
$this->_sections['disease_history']['index_next'] = $this->_sections['disease_history']['index'] + $this->_sections['disease_history']['step'];
$this->_sections['disease_history']['first']      = ($this->_sections['disease_history']['iteration'] == 1);
$this->_sections['disease_history']['last']       = ($this->_sections['disease_history']['iteration'] == $this->_sections['disease_history']['total']);
?>
			<?php if ($this->_sections['disease_history']['rownum'] < 7): ?>
			&nbsp;<input type="text" name="disease_history[]" value="<?php echo $this->_tpl_vars['clinical'][$this->_sections['disease_history']['index']]['code']; ?>
" class="short multi" />
			确诊时间:<input type="text" name="year[]" value="<?php echo $this->_tpl_vars['clinical'][$this->_sections['disease_history']['index']]['year']; ?>
" class="time" />年
			<input type="text" name="month[]" value="<?php echo $this->_tpl_vars['clinical'][$this->_sections['disease_history']['index']]['month']; ?>
" class="time" />月
			<input type="text" name="day[]" value="<?php echo $this->_tpl_vars['clinical'][$this->_sections['disease_history']['index']]['day']; ?>
" class="time" />日&nbsp;/
			<?php if ($this->_sections['disease_history']['rownum'] < 7 && $this->_sections['disease_history']['rownum']%3 == 0): ?>
			<br />
			<?php endif; ?>
			<?php elseif ($this->_sections['disease_history']['rownum'] == 7): ?>
			<input type="button" id="disease_popup_button" value="...">
			<div id="disease_popup" style="display:none;">
			<table width="100%" class="center">
				<thead>
					<tr><th>疾病类别</th><th>确诊时间</th></tr>
				</thead>
				<tbody>
					<tr><td><input type="text" name="disease_history[]" value="<?php echo $this->_tpl_vars['clinical'][$this->_sections['disease_history']['index']]['code']; ?>
" class="short" /></td>
					<td><input type="text" name="year[]" value="<?php echo $this->_tpl_vars['clinical'][$this->_sections['disease_history']['index']]['year']; ?>
" class="time" />年
						<input type="text" name="month[]" value="<?php echo $this->_tpl_vars['clinical'][$this->_sections['disease_history']['index']]['month']; ?>
" class="time" />月
						<input type="text" name="day[]" value="<?php echo $this->_tpl_vars['clinical'][$this->_sections['disease_history']['index']]['day']; ?>
" class="time" />日
					</td></tr>
			<?php elseif ($this->_sections['disease_history']['rownum'] > 7): ?>
			<tr><td><input type="text" name="disease_history[]" value="<?php echo $this->_tpl_vars['clinical'][$this->_sections['disease_history']['index']]['code']; ?>
" class="short multi" /></td>
					<td><input type="text" name="year[]" value="<?php echo $this->_tpl_vars['clinical'][$this->_sections['disease_history']['index']]['year']; ?>
" class="time" />年
						<input type="text" name="month[]" value="<?php echo $this->_tpl_vars['clinical'][$this->_sections['disease_history']['index']]['month']; ?>
" class="time" />月
						<input type="text" name="day[]" value="<?php echo $this->_tpl_vars['clinical'][$this->_sections['disease_history']['index']]['day']; ?>
" class="time" />日
					</td></tr>
			<?php endif; ?>
			<?php endfor; endif; ?>
					<tr><td colspan="2">
						<label onclick="pop_add_item('disease_popup')"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/application_cascade.png" title="当上面固定的项不能满足你的添加需求时，可通过本连接添加更多项" class="vtip" />添加行</label>
						&nbsp;<label onclick="pop_del_item('disease_popup')"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/application_delete.png" title="当你添加了错误的行时，可通过本连接删除多余项" class="vtip" />删除行</label>
						
						</td></tr>
				</tbody>
			</table>
			</div>
        </td>
    </tr>
	<tr>
		<td class="archive_surgery_history">
        	手术<img title="“手术  填写曾经接受过的手术治疗。如有，应填写具体手术名称和手术时间。”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />
        </td>
        <td colspan="5">
        	<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','surgery')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;
			<?php unset($this->_sections['surgery_history']);
$this->_sections['surgery_history']['name'] = 'surgery_history';
$this->_sections['surgery_history']['loop'] = is_array($_loop=12) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['surgery_history']['show'] = true;
$this->_sections['surgery_history']['max'] = $this->_sections['surgery_history']['loop'];
$this->_sections['surgery_history']['step'] = 1;
$this->_sections['surgery_history']['start'] = $this->_sections['surgery_history']['step'] > 0 ? 0 : $this->_sections['surgery_history']['loop']-1;
if ($this->_sections['surgery_history']['show']) {
    $this->_sections['surgery_history']['total'] = $this->_sections['surgery_history']['loop'];
    if ($this->_sections['surgery_history']['total'] == 0)
        $this->_sections['surgery_history']['show'] = false;
} else
    $this->_sections['surgery_history']['total'] = 0;
if ($this->_sections['surgery_history']['show']):

            for ($this->_sections['surgery_history']['index'] = $this->_sections['surgery_history']['start'], $this->_sections['surgery_history']['iteration'] = 1;
                 $this->_sections['surgery_history']['iteration'] <= $this->_sections['surgery_history']['total'];
                 $this->_sections['surgery_history']['index'] += $this->_sections['surgery_history']['step'], $this->_sections['surgery_history']['iteration']++):
$this->_sections['surgery_history']['rownum'] = $this->_sections['surgery_history']['iteration'];
$this->_sections['surgery_history']['index_prev'] = $this->_sections['surgery_history']['index'] - $this->_sections['surgery_history']['step'];
$this->_sections['surgery_history']['index_next'] = $this->_sections['surgery_history']['index'] + $this->_sections['surgery_history']['step'];
$this->_sections['surgery_history']['first']      = ($this->_sections['surgery_history']['iteration'] == 1);
$this->_sections['surgery_history']['last']       = ($this->_sections['surgery_history']['iteration'] == $this->_sections['surgery_history']['total']);
?>
			<?php if ($this->_sections['surgery_history']['rownum'] < 3): ?>
			名称<?php echo $this->_sections['surgery_history']['rownum']; ?>
<img title="“手术名称和时间必须填写”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />:<input type="text" name="surgery_history[]" value="<?php echo $this->_tpl_vars['surgical'][$this->_sections['surgery_history']['index']]['code']; ?>
" <?php if ($this->_tpl_vars['individual']->surgery_history == 1): ?>  disabled="true"<?php endif; ?> class="line" size="15" />
			<div id='suggest_<?php echo $this->_sections['surgery_history']['rownum']; ?>
' class="ac_results">
 			</div>
			时间<img title="“手术名称和时间必须填写”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />:<input type="text" name="stime[]" value="<?php echo $this->_tpl_vars['surgical'][$this->_sections['surgery_history']['index']]['year']; ?>
" class="line" size="10" <?php if ($this->_tpl_vars['individual']->surgery_history == 1): ?>  disabled="true"<?php endif; ?> onClick="WdatePicker({firstDayOfWeek:1})" />&nbsp;/&nbsp;
			<?php elseif ($this->_sections['surgery_history']['rownum'] == 3): ?>
			&nbsp;<input type="text" name="surgery" value="<?php echo $this->_tpl_vars['individual']->surgery_history; ?>
"  onblur="surgery_history(this)" class="short" />
			<input type="button" id="surgery_popup_button" <?php if ($this->_tpl_vars['individual']->surgery_history == 1): ?>  disabled="true"<?php endif; ?> value="...">
			<div id="surgery_popup" style="display:none;">
			<table width="100%" class="center">
				<thead>
					<tr><th>手术名称</th><th>手术时间</th></tr>
				</thead>
				<tbody>
					<tr><td>
						<input type="text" name="surgery_history[]" value="<?php echo $this->_tpl_vars['surgical'][$this->_sections['surgery_history']['index']]['code']; ?>
" <?php if ($this->_tpl_vars['individual']->surgery_history == 1): ?>  disabled="true"<?php endif; ?> class="line" size="20" />
						<div id='suggest_<?php echo $this->_sections['surgery_history']['rownum']; ?>
' class="ac_results">
 						</div>
						</td><td><input type="text" name="stime[]" value="<?php echo $this->_tpl_vars['surgical'][$this->_sections['surgery_history']['index']]['year']; ?>
" <?php if ($this->_tpl_vars['individual']->surgery_history == 1): ?>  disabled="true"<?php endif; ?> class="line" size="10" onClick="WdatePicker({firstDayOfWeek:1})" /></td></tr>
					<?php elseif ($this->_sections['surgery_history']['rownum'] > 3): ?>
					<tr><td>
						<input type="text" name="surgery_history[]" value="<?php echo $this->_tpl_vars['surgical'][$this->_sections['surgery_history']['index']]['code']; ?>
" <?php if ($this->_tpl_vars['individual']->surgery_history == 1): ?>  disabled="true"<?php endif; ?> class="line" size="20" />
						<div id='suggest_<?php echo $this->_sections['surgery_history']['rownum']; ?>
' class="ac_results">
 						</div>
						</td><td><input type="text" name="stime[]" value="<?php echo $this->_tpl_vars['surgical'][$this->_sections['surgery_history']['index']]['year']; ?>
" <?php if ($this->_tpl_vars['individual']->surgery_history == 1): ?>  disabled="true"<?php endif; ?> class="line" size="10" onClick="WdatePicker({firstDayOfWeek:1})" /></td></tr>
					<?php endif; ?>
			<?php endfor; endif; ?>
					<!--tr><td colspan="2">
						<label onclick="pop_add_item('surgery_popup')"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/application_cascade.png" title="当上面固定的项不能满足你的添加需求时，可通过本连接添加更多项" class="vtip" />添加行</label>
						&nbsp;<label onclick="pop_del_item('surgery_popup')"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/application_delete.png" title="当你添加了错误的行时，可通过本连接删除多余项" class="vtip" />删除行</label>
						
						</td></tr-->
				</tbody>
			</table>
			</div>
        </td>
    </tr>
	<tr>
		<td class="archive_trauma_history">
        	外伤<img title="“外伤  填写曾经发生的后果比较严重的外伤经历。如有，应填写具体外伤名称和发生时间。”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />
        </td>
        <td colspan="5">
        	<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','trauma_history')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;
			<?php unset($this->_sections['trauma_history']);
$this->_sections['trauma_history']['name'] = 'trauma_history';
$this->_sections['trauma_history']['loop'] = is_array($_loop=10) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['trauma_history']['show'] = true;
$this->_sections['trauma_history']['max'] = $this->_sections['trauma_history']['loop'];
$this->_sections['trauma_history']['step'] = 1;
$this->_sections['trauma_history']['start'] = $this->_sections['trauma_history']['step'] > 0 ? 0 : $this->_sections['trauma_history']['loop']-1;
if ($this->_sections['trauma_history']['show']) {
    $this->_sections['trauma_history']['total'] = $this->_sections['trauma_history']['loop'];
    if ($this->_sections['trauma_history']['total'] == 0)
        $this->_sections['trauma_history']['show'] = false;
} else
    $this->_sections['trauma_history']['total'] = 0;
if ($this->_sections['trauma_history']['show']):

            for ($this->_sections['trauma_history']['index'] = $this->_sections['trauma_history']['start'], $this->_sections['trauma_history']['iteration'] = 1;
                 $this->_sections['trauma_history']['iteration'] <= $this->_sections['trauma_history']['total'];
                 $this->_sections['trauma_history']['index'] += $this->_sections['trauma_history']['step'], $this->_sections['trauma_history']['iteration']++):
$this->_sections['trauma_history']['rownum'] = $this->_sections['trauma_history']['iteration'];
$this->_sections['trauma_history']['index_prev'] = $this->_sections['trauma_history']['index'] - $this->_sections['trauma_history']['step'];
$this->_sections['trauma_history']['index_next'] = $this->_sections['trauma_history']['index'] + $this->_sections['trauma_history']['step'];
$this->_sections['trauma_history']['first']      = ($this->_sections['trauma_history']['iteration'] == 1);
$this->_sections['trauma_history']['last']       = ($this->_sections['trauma_history']['iteration'] == $this->_sections['trauma_history']['total']);
?>
			<?php if ($this->_sections['trauma_history']['rownum'] < 3): ?>
			名称<?php echo $this->_sections['trauma_history']['rownum']; ?>
:<input type="text" name="trauma_name[]" value="<?php echo $this->_tpl_vars['trauma'][$this->_sections['trauma_history']['index']]['name']; ?>
" class="line" size="15" <?php if ($this->_tpl_vars['individual']->trauma_history == 1): ?>  disabled="true"<?php endif; ?> />
			时间:<input type="text" name="trauma_time[]" value="<?php echo $this->_tpl_vars['trauma'][$this->_sections['trauma_history']['index']]['time']; ?>
" class="line" size="10" <?php if ($this->_tpl_vars['individual']->trauma_history == 1): ?>  disabled="true"<?php endif; ?> onClick="WdatePicker({firstDayOfWeek:1})" />&nbsp;/&nbsp;
			<?php elseif ($this->_sections['trauma_history']['rownum'] == 3): ?>
			&nbsp;<input type="text" name="trauma_history" value="<?php echo $this->_tpl_vars['individual']->trauma_history; ?>
" class="short" onblur="chktrauma(this,'trauma')" />
			<input type="button" id="trauma_popup_button" value="..."  <?php if ($this->_tpl_vars['individual']->trauma_history == 1): ?>  disabled="true"<?php endif; ?> />
			<div id="trauma_popup" style="display:none;">
			<table width="100%" class="center">
				<thead>
					<tr><th>外伤名称</th><th>时间</th></tr>
				</thead>
				<tbody>
					<tr><td><input type="text" name="trauma_name[]" value="<?php echo $this->_tpl_vars['trauma'][$this->_sections['trauma_history']['index']]['name']; ?>
" class="line" size="20" <?php if ($this->_tpl_vars['individual']->trauma_history == 1): ?>  disabled="true"<?php endif; ?> /></td>
					<td><input type="text" name="trauma_time[]" value="<?php echo $this->_tpl_vars['trauma'][$this->_sections['trauma_history']['index']]['time']; ?>
" class="line" size="10" <?php if ($this->_tpl_vars['individual']->trauma_history == 1): ?>  disabled="true"<?php endif; ?> onClick="WdatePicker({firstDayOfWeek:1})" /></td>
					</tr>
					<?php elseif ($this->_sections['trauma_history']['rownum'] > 3): ?>
					<tr><td><input type="text" name="trauma_name[]" value="<?php echo $this->_tpl_vars['trauma'][$this->_sections['trauma_history']['index']]['name']; ?>
" class="line" size="20" <?php if ($this->_tpl_vars['individual']->trauma_history == 1): ?>  disabled="true"<?php endif; ?> /></td>
					<td><input type="text" name="trauma_time[]" value="<?php echo $this->_tpl_vars['trauma'][$this->_sections['trauma_history']['index']]['time']; ?>
" class="line" size="10" <?php if ($this->_tpl_vars['individual']->trauma_history == 1): ?>  disabled="true"<?php endif; ?> onClick="WdatePicker({firstDayOfWeek:1})" /></td>
					</tr>
					<?php endif; ?>
			<?php endfor; endif; ?>
					<tr><td colspan="2">
						<label onclick="pop_add_item('trauma_popup')"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/application_cascade.png" title="当上面固定的项不能满足你的添加需求时，可通过本连接添加更多项" class="vtip" />添加行</label>
						&nbsp;<label onclick="pop_del_item('trauma_popup')"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/application_delete.png" title="当你添加了错误的行时，可通过本连接删除多余项" class="vtip" />删除行</label>
						
						</td></tr>
				</tbody>
			</table>
			</div>
        </td>
    </tr>
	<tr>
		<td class="archive_blood_history">
        	输血<img title="“输血  填写曾经接受过的输血。如有，应填写具体输血原因和发生时间。”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />
        </td>
        <td colspan="5">
        	<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','blood_history')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;
			<?php unset($this->_sections['transfusion']);
$this->_sections['transfusion']['name'] = 'transfusion';
$this->_sections['transfusion']['loop'] = is_array($_loop=10) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['transfusion']['show'] = true;
$this->_sections['transfusion']['max'] = $this->_sections['transfusion']['loop'];
$this->_sections['transfusion']['step'] = 1;
$this->_sections['transfusion']['start'] = $this->_sections['transfusion']['step'] > 0 ? 0 : $this->_sections['transfusion']['loop']-1;
if ($this->_sections['transfusion']['show']) {
    $this->_sections['transfusion']['total'] = $this->_sections['transfusion']['loop'];
    if ($this->_sections['transfusion']['total'] == 0)
        $this->_sections['transfusion']['show'] = false;
} else
    $this->_sections['transfusion']['total'] = 0;
if ($this->_sections['transfusion']['show']):

            for ($this->_sections['transfusion']['index'] = $this->_sections['transfusion']['start'], $this->_sections['transfusion']['iteration'] = 1;
                 $this->_sections['transfusion']['iteration'] <= $this->_sections['transfusion']['total'];
                 $this->_sections['transfusion']['index'] += $this->_sections['transfusion']['step'], $this->_sections['transfusion']['iteration']++):
$this->_sections['transfusion']['rownum'] = $this->_sections['transfusion']['iteration'];
$this->_sections['transfusion']['index_prev'] = $this->_sections['transfusion']['index'] - $this->_sections['transfusion']['step'];
$this->_sections['transfusion']['index_next'] = $this->_sections['transfusion']['index'] + $this->_sections['transfusion']['step'];
$this->_sections['transfusion']['first']      = ($this->_sections['transfusion']['iteration'] == 1);
$this->_sections['transfusion']['last']       = ($this->_sections['transfusion']['iteration'] == $this->_sections['transfusion']['total']);
?>
			<?php if ($this->_sections['transfusion']['rownum'] < 3): ?>
			名称<?php echo $this->_sections['transfusion']['rownum']; ?>
:<input type="text" name="trans_name[]" value="<?php echo $this->_tpl_vars['transfusion'][$this->_sections['transfusion']['index']]['reason']; ?>
" class="line" size="15" <?php if ($this->_tpl_vars['individual']->blood_history == 1): ?>  disabled="true"<?php endif; ?> />
			时间:<input type="text" name="trans_time[]" value="<?php echo $this->_tpl_vars['transfusion'][$this->_sections['transfusion']['index']]['time']; ?>
" class="line" size="10" <?php if ($this->_tpl_vars['individual']->blood_history == 1): ?>  disabled="true"<?php endif; ?> onClick="WdatePicker({firstDayOfWeek:1})" />&nbsp;/&nbsp;
			<?php elseif ($this->_sections['transfusion']['rownum'] == 3): ?>
			&nbsp;<input type="text" name="blood_history" value="<?php echo $this->_tpl_vars['individual']->blood_history; ?>
" class="short" onblur="chktrauma(this,'trans')" />
			
			<input type="button" id="trans_popup_button" <?php if ($this->_tpl_vars['individual']->blood_history == 1): ?>  disabled="true"<?php endif; ?> value="..." />
			<div id="trans_popup" style="display:none;">
			<table width="100%" class="center">
				<thead>
					<tr><th>外伤名称</th><th>时间</th></tr>
				</thead>
				<tbody>
					<tr><td><input type="text" name="trans_name[]" value="<?php echo $this->_tpl_vars['transfusion'][$this->_sections['transfusion']['index']]['reason']; ?>
" class="line" size="20" <?php if ($this->_tpl_vars['individual']->blood_history == 1): ?>  disabled="true"<?php endif; ?> /></td>
					<td><input type="text" name="trans_time[]" value="<?php echo $this->_tpl_vars['transfusion'][$this->_sections['transfusion']['index']]['time']; ?>
" class="line" size="10" <?php if ($this->_tpl_vars['individual']->blood_history == 1): ?>  disabled="true"<?php endif; ?> onClick="WdatePicker({firstDayOfWeek:1})" /></td>
					</tr>
					<?php elseif ($this->_sections['transfusion']['rownum'] > 3): ?>
					<tr><td><input type="text" name="trans_name[]" value="<?php echo $this->_tpl_vars['transfusion'][$this->_sections['transfusion']['index']]['reason']; ?>
" class="line" size="20" <?php if ($this->_tpl_vars['individual']->blood_history == 1): ?>  disabled="true"<?php endif; ?> /></td>
					<td><input type="text" name="trans_time[]" value="<?php echo $this->_tpl_vars['transfusion'][$this->_sections['transfusion']['index']]['time']; ?>
" class="line" size="10" <?php if ($this->_tpl_vars['individual']->blood_history == 1): ?>  disabled="true"<?php endif; ?> onClick="WdatePicker({firstDayOfWeek:1})" /></td>
					</tr>
					<?php endif; ?>
			<?php endfor; endif; ?>
					<tr><td colspan="2">
						<label onclick="pop_add_item('trans_popup')"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/application_cascade.png" title="当上面固定的项不能满足你的添加需求时，可通过本连接添加更多项" class="vtip" />添加行</label>
						&nbsp;<label onclick="pop_del_item('trans_popup')"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/application_delete.png" title="当你添加了错误的行时，可通过本连接删除多余项" class="vtip" />删除行</label>
						</td></tr>
				</tbody>
			</table>
			</div>
        </td>
    </tr>
	<tr>
        <td colspan="2" rowspan="3" class="archive_family_history">
        	家族史<img title="“家族史：指直系亲属（父亲、母亲、兄弟姐妹、子女）中是否患过所列出的具有遗传性或遗传倾向的疾病或症状。有则选择具体疾病名称对应编号的数字，没有列出的请在 “——”上写明。可以多选。”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />
        </td>
        <td>
        	父亲
        </td>
		<td>
			<?php unset($this->_sections['farther']);
$this->_sections['farther']['name'] = 'farther';
$this->_sections['farther']['loop'] = is_array($_loop=6) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['farther']['show'] = true;
$this->_sections['farther']['max'] = $this->_sections['farther']['loop'];
$this->_sections['farther']['step'] = 1;
$this->_sections['farther']['start'] = $this->_sections['farther']['step'] > 0 ? 0 : $this->_sections['farther']['loop']-1;
if ($this->_sections['farther']['show']) {
    $this->_sections['farther']['total'] = $this->_sections['farther']['loop'];
    if ($this->_sections['farther']['total'] == 0)
        $this->_sections['farther']['show'] = false;
} else
    $this->_sections['farther']['total'] = 0;
if ($this->_sections['farther']['show']):

            for ($this->_sections['farther']['index'] = $this->_sections['farther']['start'], $this->_sections['farther']['iteration'] = 1;
                 $this->_sections['farther']['iteration'] <= $this->_sections['farther']['total'];
                 $this->_sections['farther']['index'] += $this->_sections['farther']['step'], $this->_sections['farther']['iteration']++):
$this->_sections['farther']['rownum'] = $this->_sections['farther']['iteration'];
$this->_sections['farther']['index_prev'] = $this->_sections['farther']['index'] - $this->_sections['farther']['step'];
$this->_sections['farther']['index_next'] = $this->_sections['farther']['index'] + $this->_sections['farther']['step'];
$this->_sections['farther']['first']      = ($this->_sections['farther']['iteration'] == 1);
$this->_sections['farther']['last']       = ($this->_sections['farther']['iteration'] == $this->_sections['farther']['total']);
?>
        	<input type="text" name="farther[]" value="<?php echo $this->_tpl_vars['family']['farther'][$this->_sections['farther']['index']]['code']; ?>
" class="short" />/
			<?php endfor; endif; ?>
        	&nbsp;<input type="text" name="farther_comment" value="<?php echo $this->_tpl_vars['family_comment']['farther']; ?>
" class="line" size="10" />
		</td>
		<td>
        	母亲
        </td>
		<td colspan="2">
			<?php unset($this->_sections['mother']);
$this->_sections['mother']['name'] = 'mother';
$this->_sections['mother']['loop'] = is_array($_loop=6) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['mother']['show'] = true;
$this->_sections['mother']['max'] = $this->_sections['mother']['loop'];
$this->_sections['mother']['step'] = 1;
$this->_sections['mother']['start'] = $this->_sections['mother']['step'] > 0 ? 0 : $this->_sections['mother']['loop']-1;
if ($this->_sections['mother']['show']) {
    $this->_sections['mother']['total'] = $this->_sections['mother']['loop'];
    if ($this->_sections['mother']['total'] == 0)
        $this->_sections['mother']['show'] = false;
} else
    $this->_sections['mother']['total'] = 0;
if ($this->_sections['mother']['show']):

            for ($this->_sections['mother']['index'] = $this->_sections['mother']['start'], $this->_sections['mother']['iteration'] = 1;
                 $this->_sections['mother']['iteration'] <= $this->_sections['mother']['total'];
                 $this->_sections['mother']['index'] += $this->_sections['mother']['step'], $this->_sections['mother']['iteration']++):
$this->_sections['mother']['rownum'] = $this->_sections['mother']['iteration'];
$this->_sections['mother']['index_prev'] = $this->_sections['mother']['index'] - $this->_sections['mother']['step'];
$this->_sections['mother']['index_next'] = $this->_sections['mother']['index'] + $this->_sections['mother']['step'];
$this->_sections['mother']['first']      = ($this->_sections['mother']['iteration'] == 1);
$this->_sections['mother']['last']       = ($this->_sections['mother']['iteration'] == $this->_sections['mother']['total']);
?>
        	<input type="text" name="mother[]" value="<?php echo $this->_tpl_vars['family']['mother'][$this->_sections['mother']['index']]['code']; ?>
" class="short" />/
			<?php endfor; endif; ?>
        	&nbsp;<input type="text" name="mother_comment" value="<?php echo $this->_tpl_vars['family_comment']['mother']; ?>
" class="line" size="10" />
		</td>
    </tr>
	<tr>
        <td>
        	兄弟姐妹
        </td>
		<td>
			<?php unset($this->_sections['brother']);
$this->_sections['brother']['name'] = 'brother';
$this->_sections['brother']['loop'] = is_array($_loop=6) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['brother']['show'] = true;
$this->_sections['brother']['max'] = $this->_sections['brother']['loop'];
$this->_sections['brother']['step'] = 1;
$this->_sections['brother']['start'] = $this->_sections['brother']['step'] > 0 ? 0 : $this->_sections['brother']['loop']-1;
if ($this->_sections['brother']['show']) {
    $this->_sections['brother']['total'] = $this->_sections['brother']['loop'];
    if ($this->_sections['brother']['total'] == 0)
        $this->_sections['brother']['show'] = false;
} else
    $this->_sections['brother']['total'] = 0;
if ($this->_sections['brother']['show']):

            for ($this->_sections['brother']['index'] = $this->_sections['brother']['start'], $this->_sections['brother']['iteration'] = 1;
                 $this->_sections['brother']['iteration'] <= $this->_sections['brother']['total'];
                 $this->_sections['brother']['index'] += $this->_sections['brother']['step'], $this->_sections['brother']['iteration']++):
$this->_sections['brother']['rownum'] = $this->_sections['brother']['iteration'];
$this->_sections['brother']['index_prev'] = $this->_sections['brother']['index'] - $this->_sections['brother']['step'];
$this->_sections['brother']['index_next'] = $this->_sections['brother']['index'] + $this->_sections['brother']['step'];
$this->_sections['brother']['first']      = ($this->_sections['brother']['iteration'] == 1);
$this->_sections['brother']['last']       = ($this->_sections['brother']['iteration'] == $this->_sections['brother']['total']);
?>
        	<input type="text" name="brother[]" value="<?php echo $this->_tpl_vars['family']['brother'][$this->_sections['brother']['index']]['code']; ?>
" class="short" />/
			<?php endfor; endif; ?>
        	&nbsp;<input type="text" name="brother_comment" value="<?php echo $this->_tpl_vars['family_comment']['brother']; ?>
" class="line" size="10" />
		</td>
		<td>
        	子女
        </td>
		<td colspan="2">
			<?php unset($this->_sections['son']);
$this->_sections['son']['name'] = 'son';
$this->_sections['son']['loop'] = is_array($_loop=6) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['son']['show'] = true;
$this->_sections['son']['max'] = $this->_sections['son']['loop'];
$this->_sections['son']['step'] = 1;
$this->_sections['son']['start'] = $this->_sections['son']['step'] > 0 ? 0 : $this->_sections['son']['loop']-1;
if ($this->_sections['son']['show']) {
    $this->_sections['son']['total'] = $this->_sections['son']['loop'];
    if ($this->_sections['son']['total'] == 0)
        $this->_sections['son']['show'] = false;
} else
    $this->_sections['son']['total'] = 0;
if ($this->_sections['son']['show']):

            for ($this->_sections['son']['index'] = $this->_sections['son']['start'], $this->_sections['son']['iteration'] = 1;
                 $this->_sections['son']['iteration'] <= $this->_sections['son']['total'];
                 $this->_sections['son']['index'] += $this->_sections['son']['step'], $this->_sections['son']['iteration']++):
$this->_sections['son']['rownum'] = $this->_sections['son']['iteration'];
$this->_sections['son']['index_prev'] = $this->_sections['son']['index'] - $this->_sections['son']['step'];
$this->_sections['son']['index_next'] = $this->_sections['son']['index'] + $this->_sections['son']['step'];
$this->_sections['son']['first']      = ($this->_sections['son']['iteration'] == 1);
$this->_sections['son']['last']       = ($this->_sections['son']['iteration'] == $this->_sections['son']['total']);
?>
        	<input type="text" name="son[]" value="<?php echo $this->_tpl_vars['family']['son'][$this->_sections['son']['index']]['code']; ?>
" class="short" />/
			<?php endfor; endif; ?>
        	&nbsp;<input type="text" name="son_comment" value="<?php echo $this->_tpl_vars['family_comment']['son']; ?>
" class="line" size="10" />
		</td>
    </tr>
	<tr>
		<td colspan="5">
        	<?php $_from = $this->_tpl_vars['family_history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;
        </td>
    </tr>
	<tr>
        <td colspan="2" class="archive_genetic_diseases_history">
        	遗传病史
        </td>
        <td colspan="5">
        	<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','genetic_diseases_history')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;疾病名称：<input type="text" name="genetic_name" value="<?php echo $this->_tpl_vars['genetic']->disease_name; ?>
" id="genetic_name" size="55" class="line" />&nbsp;&nbsp;<input type="text" name="genetic_diseases_history" value="<?php echo $this->_tpl_vars['individual']->genetic_diseases_history; ?>
" class="short" />
        </td>
    </tr>
	<tr>
        <td colspan="2" class="archive_disability">
        	残疾状况
        </td>
        <td colspan="5">
        	<?php $_from = $this->_tpl_vars['deformity_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_values('<?php echo $this->_tpl_vars['k']; ?>
','disability[]')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;<input type="text" name="deformity_comment" id="deformity_comment" value="<?php echo $this->_tpl_vars['deformity_comment']; ?>
" class="line" <?php if (! $this->_tpl_vars['deformity_sign']): ?>  disabled="true"<?php endif; ?> />&nbsp;
			<?php unset($this->_sections['deformity']);
$this->_sections['deformity']['name'] = 'deformity';
$this->_sections['deformity']['loop'] = is_array($_loop=6) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['deformity']['show'] = true;
$this->_sections['deformity']['max'] = $this->_sections['deformity']['loop'];
$this->_sections['deformity']['step'] = 1;
$this->_sections['deformity']['start'] = $this->_sections['deformity']['step'] > 0 ? 0 : $this->_sections['deformity']['loop']-1;
if ($this->_sections['deformity']['show']) {
    $this->_sections['deformity']['total'] = $this->_sections['deformity']['loop'];
    if ($this->_sections['deformity']['total'] == 0)
        $this->_sections['deformity']['show'] = false;
} else
    $this->_sections['deformity']['total'] = 0;
if ($this->_sections['deformity']['show']):

            for ($this->_sections['deformity']['index'] = $this->_sections['deformity']['start'], $this->_sections['deformity']['iteration'] = 1;
                 $this->_sections['deformity']['iteration'] <= $this->_sections['deformity']['total'];
                 $this->_sections['deformity']['index'] += $this->_sections['deformity']['step'], $this->_sections['deformity']['iteration']++):
$this->_sections['deformity']['rownum'] = $this->_sections['deformity']['iteration'];
$this->_sections['deformity']['index_prev'] = $this->_sections['deformity']['index'] - $this->_sections['deformity']['step'];
$this->_sections['deformity']['index_next'] = $this->_sections['deformity']['index'] + $this->_sections['deformity']['step'];
$this->_sections['deformity']['first']      = ($this->_sections['deformity']['iteration'] == 1);
$this->_sections['deformity']['last']       = ($this->_sections['deformity']['iteration'] == $this->_sections['deformity']['total']);
?>
			<input type="text" name="disability[]" value="<?php echo $this->_tpl_vars['deformity'][$this->_sections['deformity']['index']]['code']; ?>
" class="short multi" />/
			<?php endfor; endif; ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" rowspan="5">
        	生活环境<img title="生活环境：农村地区在建立居民健康档案时需根据实际情况选择填写此项。" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />
        </td>
        <td class="archive_kitchen_exhaust">厨房排风设施</td>
        <td colspan="4">
        	<?php $_from = $this->_tpl_vars['iha_kitchen_exhaust']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','kitchen_exhaust')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;
			<input type="text" name="kitchen_exhaust" value="<?php echo $this->_tpl_vars['individual']->kitchen_exhaust; ?>
" class="short multi" />
        </td>
    </tr>
    <tr>
    <td class="archive_fuel_type">燃料类型</td>
        <td colspan="4">
        	<?php $_from = $this->_tpl_vars['iha_fuel_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','fuel_type')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;
			<input type="text" name="fuel_type" value="<?php echo $this->_tpl_vars['individual']->fuel_type; ?>
" class="short multi" />
        </td>
    </tr>
    <tr>
    <td class="archive_water">饮水</td>
        <td colspan="4">
        	<?php $_from = $this->_tpl_vars['iha_water']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','water')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;
			<input type="text" name="water" value="<?php echo $this->_tpl_vars['individual']->water; ?>
" class="short multi" />
        </td>
    </tr>
    <tr>
    <td class="archive_toilet">厕所</td>
        <td colspan="4">
        	<?php $_from = $this->_tpl_vars['iha_toilet']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','toilet')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;
			<input type="text" name="toilet" value="<?php echo $this->_tpl_vars['individual']->toilet; ?>
" class="short multi" />
        </td>
    </tr>
    <tr>
    <td class="archive_livestock_column">禽畜栏</td>
        <td colspan="4">
        	<?php $_from = $this->_tpl_vars['iha_livestock_column']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','livestock_column')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>&nbsp;
			<input type="text" name="livestock_column" value="<?php echo $this->_tpl_vars['individual']->livestock_column; ?>
" class="short multi" />
        </td>
    </tr>
	<tr>
        <td colspan="2" class="core_filing_time">
        	建档时间
        </td>
        <td colspan="2">
        	<?php echo $this->_tpl_vars['core']->filing_time; ?>

        </td>
		<td style="width:80px;" class="core_staff_name">
        	建档医生
        </td>
        <td colspan="2" style="width:440px;">
        	<?php echo $this->_tpl_vars['core']->staff_name; ?>

        </td>
    </tr>
	<tr class="endbg"><td colspan="7" style="text-align:center;">
	<!--用于返回的变量-->
	<input type="hidden" id="para_page" name="para_page" value="<?php echo $this->_tpl_vars['page']; ?>
" />
	<input type="hidden" id="opener" name="opener" value="<?php echo $this->_tpl_vars['opener']; ?>
" />
	
	<input type="submit" name="submit" value="保存" <?php echo $this->_tpl_vars['ajax_save_disabled']; ?>
 />
	<input type="button" name="skip" id="skip" value="返回列表" onclick="myskip(2);" />
    <?php if ($this->_tpl_vars['core']->uuid): ?>
    <input type="button" name="print" id="print" value="打印" onclick="window.open('<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/print/uuid/<?php echo $this->_tpl_vars['core']->uuid; ?>
')"; />
    <?php endif; ?>
	</td></tr>
    <tr><td colspan="7">
    <span style="font-weight: bold;">填表说明</span><br />
1．本表用于居民首次建立健康档案时填写。如果居民的个人信息有所变动，可在原条目处修改，并注明修改时间。<br />
2．性别：按照国标分为未知的性别、男、女及未说明的性别。<br />
3．出生日期：根据居民身份证的出生日期，按照年（4位）、月（2位）、日（2位）顺序填写，如19490101。<br />
4．工作单位：应填写目前所在工作单位的全称。离退休者填写最后工作单位的全称；下岗待业或无工作经历者须具体注明。<br />
5．联系人姓名：填写与建档对象关系紧密的亲友姓名。<br />
6．民族：少数民族应填写全称，如彝族、回族等。<br />
7．血型：在前一个“□”内填写与ABO血型对应编号的数字；在后一个“□”内填写是否为“RH阴性”对应编号的数字。<br />
8．文化程度：指截至建档时间，本人接受国内外教育所取得的最高学历或现有水平所相当的学历。<br />
9．药物过敏史：表中药物过敏主要列出青霉素、磺胺或者链霉素过敏，如有其他药物过敏，请在其他栏中写明名称，可以多选。<br />
10．既往史：包括疾病史、手术史、外伤史和输血史。<br />
（1）疾病  填写现在和过去曾经患过的某种疾病，包括建档时还未治愈的慢性病或某些反复发作的疾病，并写明确诊时间，如有恶性肿瘤，请写明具体的部位或疾病名称，如有职业病，请填写具体名称。对于经医疗单位明确诊断的疾病都应以一级及以上医院的正式诊断为依据，有病史卡的以卡上的疾病名称为准，没有病史卡的应有证据证明是经过医院明确诊断的。可以多选。<br />
（2）手术  填写曾经接受过的手术治疗。如有，应填写具体手术名称和手术时间。<br />
（3）外伤  填写曾经发生的后果比较严重的外伤经历。如有，应填写具体外伤名称和发生时间。<br />
（4）输血  填写曾经接受过的输血情况。如有，应填写具体输血原因和发生时间。<br />
11．家族史：指直系亲属（父亲、母亲、兄弟姐妹、子女）中是否患过所列出的具有遗传性或遗传倾向的疾病或症状。有则选择具体疾病名称对应编号的数字，没有列出的请在 “       ”上写明。可以多选。<br />
12.生活环境：农村地区在建立居民健康档案时需根据实际情况选择填写此项。
    </td></tr>
</table>
</form>
<div id="camera" style="display: none;">
	<span class="camTop"></span>
    
    <div id="screen"></div>
    <div id="buttons">
    	<div class="buttonPane">
        	<a id="shootButton" href="" class="blueButton">拍照</a>
        </div>
        <div class="buttonPane hidden">
        	<a id="cancelButton" href="" class="blueButton">取消</a> <a id="uploadButton" href="" class="greenButton">上传</a>
        </div>
    </div>
    
    <span class="settings"></span>
</div>
</body>
</html>
<script type="text/javascript">
function myskip(action){ 

	if(action==2){
		document.location="<?php echo $this->_tpl_vars['basePath']; ?>
iha/<?php echo $this->_tpl_vars['opener']; ?>
/index/page/<?php echo $this->_tpl_vars['page']; ?>
";
	}
  
}
</script>