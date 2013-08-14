<?php /* Smarty version 2.6.14, created on 2013-04-28 09:19:59
         compiled from tianbao.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js"></script>
		<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
       <link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />

        <title><?php echo $this->_tpl_vars['title']; ?>
</title>
	
    </head>
    <body>
        <form method="post" name="form" action="<?php echo $this->_tpl_vars['basePath']; ?>
ya420/jzsyyljzxx/editin">
      
            <table  cellspacing="0" width="100%">
                <thead>

                </thead>
                <tr  class="headbg">
                    <th  colspan="22">门（急）诊伤员医疗救治信息</th>
                </tr>
				<tr><td colspan="11">区县:<span id="menuDropDownBox"></span><input type="hidden" name="org_id" id="org_id" value="<?php echo $this->_tpl_vars['org_id']; ?>
" />填报日期：<input type="text" name="start_time" value="<?php echo $this->_tpl_vars['search']['start_time']; ?>
" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd H:m:s'})" class="Wdate" size="25" />至<input type="text" name="end_time" value="<?php echo $this->_tpl_vars['search']['end_time']; ?>
" class="Wdate" size="25" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd H:m:s'})" /></td></tr>
               

                    <tr class='title'>
						
                        <td  rowspan= '2'  >患者姓名</td>
                        <td  rowspan='2' >性别</td>
                        <td  rowspan='2' >年龄</td>
                        <td  rowspan='2' >患者来源</td>
                        <td  rowspan='2' >联系电话</td>
                        <td  rowspan='2' >地震伤疾病名称</td>
                        <td  rowspan='2' >请注明受伤原因</td>
                        <td  rowspan='2' >非地震伤病员疾病名称</td>
                        <td  rowspan='2' >外伤请注明受伤原因</td>
                        <td  rowspan='2' >是否急诊(是填1)</td>
                        <td  colspan='4'>门诊伤员救治效果</td>
                        <td  rowspan='2'>是否手术(是填1)</td>
                        <td  rowspan='2'>手术名称</td>
                    </tr>
					
					<tr >
                        <td  >转住院(是填1) </td>
                        <td  >转住院医院名称</td>
                        <td  >处理后离开(是填1)</td>
                        <td  >死亡(是填1)</td>
                        
                    </tr>
					<?php $_from = $this->_tpl_vars['mzsyyljz_rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <tr>
					     
                      <td>
       		        				
						<td><?php echo $this->_tpl_vars['item']['xm']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['xb']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['age']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['hzly']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['lxdh']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['dzsjbymc']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['ssyy']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['fdzssbymc']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['fdzssyy']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['sfjz']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['jz_zzy']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['jz_zzymc']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['jz_clhlk']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['jz_sw']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['sfss']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['ssmc']; ?>
</td>

					
					</tr> 
					<?php endforeach; endif; unset($_from); ?>	
				
				<tr>
			    <td colspan="16">
				&nbsp;联系电话：<input type="text" name="lxdh" class="input" />审核人：<select name="staff_id" id="staff_id">
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
    <tr>
		<td style="text-align:center;" colspan="16">
        	<input type="submit" value="上报内容" class="input" style="height: 28px;font-size:14px;"  />
	</tr>
            </table>
       


    </body>

</html>

<script>
$(document).ready(function(){
    //处理地区下拉
    get_region_select_html('<?php echo $this->_tpl_vars['basePath']; ?>
','org_id','menuDropDownBox');
});
</script>