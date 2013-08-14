<?php /* Smarty version 2.6.14, created on 2013-06-24 15:15:53
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>个人健康档案列表</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<style>
	table
	{
		background:#ffffff;
	}
	.line
	{
		border-top:0px;
		border-left:0px;
		border-right:0px;
	}
    .status_6{
        color: #ccc;
    }
    .status_6 a{
        color: #ccc;
    }
    span.status_6{
        color: #FFF;
        background-color: #ccc;
    }
    .status_4{
        color: #99CCFF;
    }
    .status_4 a{
        color: #99CCFF;
    }
    span.status_4{
        color: #FFF;
        background-color: #99CCFF;
    }
    .status_8{
        color: #CCCCFF;
    }
    span.status_8{
        color: #FFF;
        background-color: #CCCCFF;
    }
    .status_8 a{
        color: #CCCCFF;
    }
    .flag{
        height: 28px;
        width: 50px;
        line-height: 28px;
        border: 1px solid #ccc;
        padding: 2px;
        margin: 2px;
    }
</style>
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/popup.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/ajax_select_region.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		//定义鼠标经过样式
		//定义搜索样式
		//$("#search_lable").toggle(function(){$("#tbody_search").show();$("#tbody_search input").attr("disabled",false);$("#tbody_search select").attr("disabled",false);$("#search_lable>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_out.png");},function(){$("#tbody_search").hide();$("#tbody_search input").attr("disabled",true);$("#tbody_search select").attr("disabled",true);$("#search_lable>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png");});
		$("#search_lable").toggle(function(){$("#tbody_search").show();$("#search_lable>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_out.png");},function(){$("#tbody_search").hide();$("#search_lable>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png");});
		//当选择全选的时候，把与其名字一样的所有字段全部选中
		$(".all").bind("click",function(){
			var input_name=$(this).attr("name");
			$("input[name='"+input_name+"']").attr("checked",$(this).attr("checked"));
		});
        //处理地区下拉
        get_region_select_html('<?php echo $this->_tpl_vars['basePath']; ?>
','region_p_id','iha_list_region');
	});
	function ajaxload(gurl,obj,tp)
	{
		//移除原来的img标签
		$("th>img").remove();
		$("th").unbind();
		var order=$(obj).attr("class");
		//alert(order);
		if(tp=='undefined')
		{
			tp="POST";
		}
		tp="POST";
		var searchv=$("#searchinput").val();
        searchv=(searchv!=undefined)?searchv:"";
		$.ajax({
			type:tp,
			url:gurl+order+searchv,
			dataType:"html",
			data:$("#search").serialize(),
			beforeSend:function(){
				$("#iha").html("<tr><td colspan='12'>数据查询中，请耐心等待...</td></tr>");
				},
			success:function(data){
				//document.write(data);
				if(order=="asc")
				{
					$(obj).attr("class","desc");
				}
				else
				{
					$(obj).attr("class","asc");
				}
				$(obj).html("<img src='<?php echo $this->_tpl_vars['basePath']; ?>
images/"+order+".png' />"+$(obj).text());
				$("#iha").html(data);
				//增加鼠标移动样式
				$("th").bind("mouseover mouseout",function(){
				var sr=$(this).find("img").attr("src");
				if(sr=="<?php echo $this->_tpl_vars['basePath']; ?>
images/asc.png")
				{
					$(this).find("img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/desc.png");
				}
				else
				{
					$(this).find("img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/asc.png");
				}
				});
			},
			error:function(){
				$("#iha").html("<tr><td colspan='12'>数据查询失败，请刷新页面重试...</td></tr>")
			}
		});
	}
	function ajaxpage(gurl)
	{
		//alert(gurl);
		//alert($("#search").serialize());
		$.ajax({
			type:"POST",
			url:gurl,
			dataType:"html",
			data:$("#search").serialize(),
			beforeSend:function(){$("#iha").html("<tr><td colspan='12'>数据查询中，请耐心等待...</td></tr>")},
			success:function(data){
				//alert(data);
				//document.write(data);
				$("#iha").html(data);
                //初始化提示信息
                vtip();
			},
			error:function(){
				$("#iha").html("<tr><td colspan='12'>数据查询失败，请刷新页面重试...</td></tr>")
			}
		});
	}
	function ajaxsearch(gurl)
	{
		$.ajax({
			type:"POST",
			url:gurl,
			dataType:"html",
			data:$("#search").serialize(),
			beforeSend:function(){$("#iha").html("<tr><td colspan='12'>数据查询中，请耐心等待...</td></tr>")},
			success:function(data){
				//alert(data);
				//document.write(data);
				$("#iha").html(data);
                //初始化提示信息
                vtip();
				return false;
			},
			error:function(){
				$("#iha").html("<tr><td colspan='12'>数据查询失败，请刷新页面重试...</td></tr>");
				return false;
			}
		});
	}
	function set_session(uid)
	{
		$.ajax({
			type:"get",
			url:"<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/setsession/uuid/"+uid,
			dataType:"html",
			data:"",
			success:function(data){
				//alert(data);
				if($.trim(data)=="ok")
				{
					//设置图标
					//移除已经标志为选中状态的数据
					$(".online").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/status_offline.png");
					//将选中用户置为在线状态
					//alert(uid);
					//var obj1=document.getElementById("iha_"+uid);
					//var obj2=obj1.getElementByTagname('img');
					//document.getElementById('')
					var id='img_'+uid;
					$("img[id='"+id+"']").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/status_online.png");
					//设置顶部医生提示
					id=uid+"_name";
					$(window.top.frames["right_top"].document).find('#patient').html($("td[id='"+id+"']").text());
				}
				//return false;
			}
		});
		return true;
	}
	//alert($('#i_4c4ba61e71cc14.67049524_name').text());
    //显示完整率
    function showrate(rateurl)
    {
        $.get(rateurl,function(data){
            $.dialog(500, 500,data,"rate_popup","完整率指标完成情况");
        });
    }
    function getstatus_flag(){
    	var status_flagv = $('#status_flag').val();
    	alert(status_flagv);
    }
    function blank_lsjz(burl)
    {
        var vcard=$("input[name='identity_number']").val();
        $.get("<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/basecard/vcard/"+vcard,function(data)
        {
            vcard=data;
        });
        if(vcard!='' && vcard!=undefined)
        {
            if(confirm('确定要查看历史就诊信息吗？'))
            {
                window.open(burl+'/card/'+vcard);
            }
        }
        else
        {
            alert('请先输入身份证号码');
        }
        
    }
</script>
</head>
<body>
<form action="" id="search" method="post">
<table border="0" width="100%">
			<tr><td><?php echo $this->_tpl_vars['ss']; ?>

				姓名<img title="“可以输入汉字也可以输入姓名拼音的首字母，比如要查找'王高兴',那么可以输入姓名汉字中的“王”，“王高”或者“王高兴”均可，也可以依次输入‘wgx’几个字母进行搜索查找，比如“w”,“wg”，或者“wgx””" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />：<input type="text" name="username" class="line" size="10">&nbsp;
				档案号<img title="“依次输入标准档案号里的全部或者部分数字,比如档案号为“510100-888-888-88-8888-88”，则可以录入“5加任意数字的格式进行查找””" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />:<input type="text" name="standard_code" class="line" size="10">&nbsp;
				身份证号<img title="“可以依次输入完整或者部分身份证号”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />:<input type="text" name="identity_number" class="line" size="12">&nbsp;
				年龄:<input type="text" name="age_start" class="line" style="width:28px" size="6">
				~<input type="text" name="age_end" class="line" style="width:28px" size="6">&nbsp;
				档案状态：
				<select name="status_flag" id="status_flag" onchange="sf=this.value">
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
 > <?php echo $this->_tpl_vars['status_flag'][$this->_sections['status_flag']['index']]['value']; ?>
</option>
					<?php endfor; endif; ?>
				</select>
                发卡状态：
				<select name="card_status">
                    <option value="" >所有状态</option>
					<?php $_from = $this->_tpl_vars['card_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
    				<option value="<?php echo $this->_tpl_vars['v'][0]; ?>
" <?php if ($this->_tpl_vars['v'][0] == $this->_tpl_vars['search']['card_status']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v'][1]; ?>
</option>
    				<?php endforeach; endif; unset($_from); ?>
				</select>
				<?php if ($this->_tpl_vars['searchtable'] == ""): ?>
				身份证类别
                <select name="nocard">
                <option>请选择</option>
                <option value="1" <?php if ($this->_tpl_vars['nocard'] == 1): ?>selected="selected"<?php endif; ?>>身份证号码为空</option>
                <option value="2" <?php if ($this->_tpl_vars['nocard'] == 2): ?>selected="selected"<?php endif; ?>>身份证号码为15位</option>
                <option value="3" <?php if ($this->_tpl_vars['nocard'] == 3): ?>selected="selected"<?php endif; ?>>身份证号码为18位</option>
                <option value="4" <?php if ($this->_tpl_vars['nocard'] == 4): ?>selected="selected"<?php endif; ?>>身份证号码为其他位</option>
                </select>
                &nbsp;
				<?php else: ?>
				档案类型
				<select name="cl_search_type" id="cl_search_type" onchange="return ajaxsearch('<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/list');">
				<option value="0" <?php if ($this->_tpl_vars['cl_search_type'] == '0'): ?>selected<?php endif; ?>>所有居民档案</option>
				<?php $_from = $this->_tpl_vars['table_comment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<option value="<?php echo $this->_tpl_vars['k']+1; ?>
" <?php if ($this->_tpl_vars['cl_search_type'] == $this->_tpl_vars['v']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
				<input type="hidden" name="searchtable" id="searchtable" value="<?php echo $this->_tpl_vars['searchtable']; ?>
" />
				<input type="hidden" name="colum" id="colum" value="<?php echo $this->_tpl_vars['colum']; ?>
" />
				<input type="hidden" name="value" id="value" value="<?php echo $this->_tpl_vars['value']; ?>
" />
				<?php endif; ?>
                开始时间：<input type="text" name="start_time" id="start_time" class="Wdate line" onfocus="WdatePicker({isShowWeek:true,maxDate:'#F{$dp.$D(\'end_time\')||\'2020-10-01\'}'})" value="<?php echo $this->_tpl_vars['search']['start_time']; ?>
" style="border: 0px;border-bottom: 1px solid #999999;width:75px;" />&nbsp;&nbsp;结束时间：<input type="text" name="end_time" id="end_time" class="Wdate line" onfocus="WdatePicker({isShowWeek:true,minDate:'#F{$dp.$D(\'start_time\')}'})" value="<?php echo $this->_tpl_vars['search']['end_time']; ?>
" style="border: 0px;border-bottom: 1px solid #999999;width:75px;" />
                <input type="button" value="搜索" onclick="return ajaxsearch('<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/list');" />&nbsp;&nbsp;
				<input type="button" value="历史就诊" onclick="blank_lsjz('<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/search')">
				
				<label id="search_lable" style="cursor:pointer;"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png" />高级搜索</label><img title="请尽量使用普通搜索，并且限制搜索条件详细一些，否则会耗费过长的时间" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />
				</td>
			</tr>
		<tbody id="tbody_search" style="display:none;">
			<tr>
				<td>
					所属地区:<br /><span id="iha_list_region"></span>	
					<input type="hidden" name="region_id" id="region_id" value="<?php echo $this->_tpl_vars['region_id']; ?>
" />
					<input type="hidden" name="region_p_id" id="region_p_id" value="<?php echo $this->_tpl_vars['region_p_id']; ?>
" />
					
					</td>
			</tr>
		<tr>
				<td>
				建档医生：
		<select name="staff_id" id="staff_id">
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
		</select>&nbsp;联系电话:<input type="text" name="phone_number" class="line" size="10">&nbsp;工作单位：<input type="text" name="unit_name" class="line" size="30">&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				常住类型:<input type="checkbox" class="all" name="residence[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['registered_permanent_residence']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="residence[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				性别:<input type="checkbox" class="all" name="sex[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['sex']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="sex[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				文化程度:<input type="checkbox" class="all" name="school_type[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['school_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="school_type[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				职业:<input type="checkbox" class="all" name="occupation[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['occupation']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="occupation[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				婚姻状况:<input type="checkbox" class="all" name="marriage[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['marriage']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="marriage[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				药物过敏史:<input type="checkbox" class="all" name="allergy_history[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="allergy_history[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				疾病史:<input type="checkbox" class="all" name="disease_history[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="disease_history[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				手术史:<input type="checkbox" class="all" name="surgery_history[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="surgery_history[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				外伤史:<input type="checkbox" class="all" name="trauma_history[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="trauma_history[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				输血史:<input type="checkbox" class="all" name="blood_history[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="blood_history[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				遗传病史:<input type="checkbox" class="all" name="genetic_diseases_history[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="genetic_diseases_history[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				残疾状况:<input type="checkbox" class="all" name="disability[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="disability[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			</tbody>
</table>	
</form>
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
    	<th>&nbsp;
        	
        </th>
        <th title="按档案号排序" style="cursor:pointer;" class="asc" onclick="ajaxload('<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/list/page/<?php echo $this->_tpl_vars['page']; ?>
/order/standard_code/turn/',this)">
        	<img src='<?php echo $this->_tpl_vars['basePath']; ?>
images/asc.png' />档案号
        </th>
		<th title="按姓名排序" style="cursor:pointer;" class="asc" onclick="ajaxload('<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/list/page/<?php echo $this->_tpl_vars['page']; ?>
/order/name_pinyin/turn/',this)">
        	姓名
        </th>
		<th>
        	性别
        </th>
		<th>
        	家庭地址
        </th>
		<th title="按年龄排序" style="cursor:pointer;" class="asc" onclick="ajaxload('<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/list/page/<?php echo $this->_tpl_vars['page']; ?>
/order/date_of_birth/turn/',this)">
        	年龄
        </th>
		<th>
        	联系电话
        </th>
		<th>
        	户主姓名
        </th>
		<th>
        	建档医生
        </th>
		<th title="按完整率排序" style="cursor:pointer;" class="asc" onclick="ajaxload('<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/list/page/<?php echo $this->_tpl_vars['page']; ?>
/order/criteria_rate/turn/',this)">
        	完整率(%)<img title="根据字段：{
			<?php unset($this->_sections['comment']);
$this->_sections['comment']['name'] = 'comment';
$this->_sections['comment']['loop'] = is_array($_loop=$this->_tpl_vars['comment']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['comment']['show'] = true;
$this->_sections['comment']['max'] = $this->_sections['comment']['loop'];
$this->_sections['comment']['step'] = 1;
$this->_sections['comment']['start'] = $this->_sections['comment']['step'] > 0 ? 0 : $this->_sections['comment']['loop']-1;
if ($this->_sections['comment']['show']) {
    $this->_sections['comment']['total'] = $this->_sections['comment']['loop'];
    if ($this->_sections['comment']['total'] == 0)
        $this->_sections['comment']['show'] = false;
} else
    $this->_sections['comment']['total'] = 0;
if ($this->_sections['comment']['show']):

            for ($this->_sections['comment']['index'] = $this->_sections['comment']['start'], $this->_sections['comment']['iteration'] = 1;
                 $this->_sections['comment']['iteration'] <= $this->_sections['comment']['total'];
                 $this->_sections['comment']['index'] += $this->_sections['comment']['step'], $this->_sections['comment']['iteration']++):
$this->_sections['comment']['rownum'] = $this->_sections['comment']['iteration'];
$this->_sections['comment']['index_prev'] = $this->_sections['comment']['index'] - $this->_sections['comment']['step'];
$this->_sections['comment']['index_next'] = $this->_sections['comment']['index'] + $this->_sections['comment']['step'];
$this->_sections['comment']['first']      = ($this->_sections['comment']['iteration'] == 1);
$this->_sections['comment']['last']       = ($this->_sections['comment']['iteration'] == $this->_sections['comment']['total']);
?>
			<?php echo $this->_tpl_vars['comment'][$this->_sections['comment']['index']]['column_zh_name']; ?>
、
			<?php endfor; endif; ?>
			}是否填写值来计算个人档案完整率" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />
        </th>
        <th>
        	健康卡
        </th>
		<th>
        	操作
        </th>
	</tr>
	</thead>
	<tbody id="iha">
	<?php unset($this->_sections['iha']);
$this->_sections['iha']['name'] = 'iha';
$this->_sections['iha']['loop'] = is_array($_loop=$this->_tpl_vars['iha']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iha']['show'] = true;
$this->_sections['iha']['max'] = $this->_sections['iha']['loop'];
$this->_sections['iha']['step'] = 1;
$this->_sections['iha']['start'] = $this->_sections['iha']['step'] > 0 ? 0 : $this->_sections['iha']['loop']-1;
if ($this->_sections['iha']['show']) {
    $this->_sections['iha']['total'] = $this->_sections['iha']['loop'];
    if ($this->_sections['iha']['total'] == 0)
        $this->_sections['iha']['show'] = false;
} else
    $this->_sections['iha']['total'] = 0;
if ($this->_sections['iha']['show']):

            for ($this->_sections['iha']['index'] = $this->_sections['iha']['start'], $this->_sections['iha']['iteration'] = 1;
                 $this->_sections['iha']['iteration'] <= $this->_sections['iha']['total'];
                 $this->_sections['iha']['index'] += $this->_sections['iha']['step'], $this->_sections['iha']['iteration']++):
$this->_sections['iha']['rownum'] = $this->_sections['iha']['iteration'];
$this->_sections['iha']['index_prev'] = $this->_sections['iha']['index'] - $this->_sections['iha']['step'];
$this->_sections['iha']['index_next'] = $this->_sections['iha']['index'] + $this->_sections['iha']['step'];
$this->_sections['iha']['first']      = ($this->_sections['iha']['iteration'] == 1);
$this->_sections['iha']['last']       = ($this->_sections['iha']['iteration'] == $this->_sections['iha']['total']);
?>
	 <tr id="iha_<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
" ondblclick="set_session('<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
')" class="status_<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['status_flag']; ?>
">
	 	<td>
	 		<?php if ($this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid'] == $this->_tpl_vars['individual_current']->uuid): ?>
			<img id="img_<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/status_online.png" class="online" />
			<?php else: ?>
			<img id="img_<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/status_offline.png" class="online" />
			<?php endif; ?> 
	 	</td>
        <td class="vtip" title="档案最后更新时间：<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['updated']; ?>
，建档时间为：<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['filing_time']; ?>
">
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['standard_code']; ?>

        </td>
		<td id="<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
_name">
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/search/username/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['name']; ?>
/card/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['standard_code_base']; ?>
" target="_blank"><?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['name']; ?>
</a>
        </td>
		<td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['sex']; ?>

        </td>
		<td>
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/map/uuid/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
" class="vtip" title="点击在地图上标注家庭地址，同时将修改家庭地址"><?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['address']; ?>
</a>
        </td>
		<td title="生日：<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['date_of_birth']; ?>
">
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['age']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['contact_number']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['householder_name']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['staff_name']; ?>

        </td>
		<td onclick="showrate('<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/showrate/uuid/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
')" style="cursor: pointer;">
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['criteria_rate']; ?>

        </td>
        <td>
        	<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/credit-card_<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['card_status']; ?>
.png" title="<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['card_status_info']; ?>
" alt="<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['card_status_info']; ?>
" />
        </td>
		<td>
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/cover/add/action/edit/uuid/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
/para_page/<?php echo $this->_tpl_vars['para_page']; ?>
/opener/index" onclick="set_session('<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
');">编辑首页</a>
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/add/uuid/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
/para_page/<?php echo $this->_tpl_vars['para_page']; ?>
/opener/index"  onclick="set_session('<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
');">编辑档案</a>
        	<a href="###" onclick="delete_iha('<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/delete/uuid/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
')">删除</a>
        </td>
	</tr>
	<?php endfor; else: ?>
	<tr>
		<td colspan="12">
        	暂时没有符合条件的数据
        </td>
	</tr>
	<?php endif; ?>
    <tr>
		<td colspan="12">
        <img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/status_online.png" />选中状态
		&nbsp;
		<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/status_offline.png" />未选中状态&nbsp;
        <img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/credit-card_1.png" />已发卡&nbsp;
        <img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/credit-card_2.png" />未发卡&nbsp;
        <img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/credit-card_3.png" />补卡&nbsp;
        
    </td>
	</tr>
	<tr>
		<td colspan="12">
        	<span class="flag status_6">死亡</span> <span class="flag status_4">临时</span> <span class="flag status_8">转出</span>&nbsp;<?php echo $this->_tpl_vars['pager']; ?>

        </td>
	</tr>
	</tbody>
</table>
<div id="rate_popup" style="display:none;">
</div>
<input type="hidden" id="error_message" name="error_message" value="<?php echo $this->_tpl_vars['error_message']; ?>
" />
</body>
</html>
<script>
function delete_iha(durl)
{
    if(confirm("确定要删除该档案吗?"))
    {
        $.get(durl,function(res){
            alert(res);
            ajaxpage("<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/list/page/1");
        })
    }
}
</script>