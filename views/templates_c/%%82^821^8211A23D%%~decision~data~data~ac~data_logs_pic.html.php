<?php /* Smarty version 2.6.14, created on 2013-08-30 09:33:04
         compiled from data_logs_pic.html */ ?>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<script>
$(document).ready(function(){
    data_pic();
});
function data_pic()
{
    var colors = Highcharts.getOptions().colors,
            categories = [<?php unset($this->_sections['data']);
$this->_sections['data']['name'] = 'data';
$this->_sections['data']['loop'] = is_array($_loop=$this->_tpl_vars['data_logs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['data']['show'] = true;
$this->_sections['data']['max'] = $this->_sections['data']['loop'];
$this->_sections['data']['step'] = 1;
$this->_sections['data']['start'] = $this->_sections['data']['step'] > 0 ? 0 : $this->_sections['data']['loop']-1;
if ($this->_sections['data']['show']) {
    $this->_sections['data']['total'] = $this->_sections['data']['loop'];
    if ($this->_sections['data']['total'] == 0)
        $this->_sections['data']['show'] = false;
} else
    $this->_sections['data']['total'] = 0;
if ($this->_sections['data']['show']):

            for ($this->_sections['data']['index'] = $this->_sections['data']['start'], $this->_sections['data']['iteration'] = 1;
                 $this->_sections['data']['iteration'] <= $this->_sections['data']['total'];
                 $this->_sections['data']['index'] += $this->_sections['data']['step'], $this->_sections['data']['iteration']++):
$this->_sections['data']['rownum'] = $this->_sections['data']['iteration'];
$this->_sections['data']['index_prev'] = $this->_sections['data']['index'] - $this->_sections['data']['step'];
$this->_sections['data']['index_next'] = $this->_sections['data']['index'] + $this->_sections['data']['step'];
$this->_sections['data']['first']      = ($this->_sections['data']['iteration'] == 1);
$this->_sections['data']['last']       = ($this->_sections['data']['iteration'] == $this->_sections['data']['total']);
?>'<?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['org_name']; ?>
'<?php if ($this->_sections['data']['last']):  else: ?>,<?php endif;  endfor; endif; ?>],
            name = '点击柱状图查看详细',
            data = [<?php unset($this->_sections['data']);
$this->_sections['data']['name'] = 'data';
$this->_sections['data']['loop'] = is_array($_loop=$this->_tpl_vars['data_logs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['data']['show'] = true;
$this->_sections['data']['max'] = $this->_sections['data']['loop'];
$this->_sections['data']['step'] = 1;
$this->_sections['data']['start'] = $this->_sections['data']['step'] > 0 ? 0 : $this->_sections['data']['loop']-1;
if ($this->_sections['data']['show']) {
    $this->_sections['data']['total'] = $this->_sections['data']['loop'];
    if ($this->_sections['data']['total'] == 0)
        $this->_sections['data']['show'] = false;
} else
    $this->_sections['data']['total'] = 0;
if ($this->_sections['data']['show']):

            for ($this->_sections['data']['index'] = $this->_sections['data']['start'], $this->_sections['data']['iteration'] = 1;
                 $this->_sections['data']['iteration'] <= $this->_sections['data']['total'];
                 $this->_sections['data']['index'] += $this->_sections['data']['step'], $this->_sections['data']['iteration']++):
$this->_sections['data']['rownum'] = $this->_sections['data']['iteration'];
$this->_sections['data']['index_prev'] = $this->_sections['data']['index'] - $this->_sections['data']['step'];
$this->_sections['data']['index_next'] = $this->_sections['data']['index'] + $this->_sections['data']['step'];
$this->_sections['data']['first']      = ($this->_sections['data']['iteration'] == 1);
$this->_sections['data']['last']       = ($this->_sections['data']['iteration'] == $this->_sections['data']['total']);
?>{
                    y: <?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['nums']; ?>
,
                    color: colors[<?php echo $this->_sections['data']['rownum']; ?>
],
                    drilldown: {
                        name: '<?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['org_name']; ?>
',
                        categories: [<?php unset($this->_sections['org']);
$this->_sections['org']['name'] = 'org';
$this->_sections['org']['loop'] = is_array($_loop=$this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['drilldown']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['org']['show'] = true;
$this->_sections['org']['max'] = $this->_sections['org']['loop'];
$this->_sections['org']['step'] = 1;
$this->_sections['org']['start'] = $this->_sections['org']['step'] > 0 ? 0 : $this->_sections['org']['loop']-1;
if ($this->_sections['org']['show']) {
    $this->_sections['org']['total'] = $this->_sections['org']['loop'];
    if ($this->_sections['org']['total'] == 0)
        $this->_sections['org']['show'] = false;
} else
    $this->_sections['org']['total'] = 0;
if ($this->_sections['org']['show']):

            for ($this->_sections['org']['index'] = $this->_sections['org']['start'], $this->_sections['org']['iteration'] = 1;
                 $this->_sections['org']['iteration'] <= $this->_sections['org']['total'];
                 $this->_sections['org']['index'] += $this->_sections['org']['step'], $this->_sections['org']['iteration']++):
$this->_sections['org']['rownum'] = $this->_sections['org']['iteration'];
$this->_sections['org']['index_prev'] = $this->_sections['org']['index'] - $this->_sections['org']['step'];
$this->_sections['org']['index_next'] = $this->_sections['org']['index'] + $this->_sections['org']['step'];
$this->_sections['org']['first']      = ($this->_sections['org']['iteration'] == 1);
$this->_sections['org']['last']       = ($this->_sections['org']['iteration'] == $this->_sections['org']['total']);
?>'<?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['drilldown'][$this->_sections['org']['index']]['upload_token']; ?>
'<?php if ($this->_sections['org']['last']):  else: ?>,<?php endif;  endfor; endif; ?>],
                        data: [<?php unset($this->_sections['nums']);
$this->_sections['nums']['name'] = 'nums';
$this->_sections['nums']['loop'] = is_array($_loop=$this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['drilldown']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['nums']['show'] = true;
$this->_sections['nums']['max'] = $this->_sections['nums']['loop'];
$this->_sections['nums']['step'] = 1;
$this->_sections['nums']['start'] = $this->_sections['nums']['step'] > 0 ? 0 : $this->_sections['nums']['loop']-1;
if ($this->_sections['nums']['show']) {
    $this->_sections['nums']['total'] = $this->_sections['nums']['loop'];
    if ($this->_sections['nums']['total'] == 0)
        $this->_sections['nums']['show'] = false;
} else
    $this->_sections['nums']['total'] = 0;
if ($this->_sections['nums']['show']):

            for ($this->_sections['nums']['index'] = $this->_sections['nums']['start'], $this->_sections['nums']['iteration'] = 1;
                 $this->_sections['nums']['iteration'] <= $this->_sections['nums']['total'];
                 $this->_sections['nums']['index'] += $this->_sections['nums']['step'], $this->_sections['nums']['iteration']++):
$this->_sections['nums']['rownum'] = $this->_sections['nums']['iteration'];
$this->_sections['nums']['index_prev'] = $this->_sections['nums']['index'] - $this->_sections['nums']['step'];
$this->_sections['nums']['index_next'] = $this->_sections['nums']['index'] + $this->_sections['nums']['step'];
$this->_sections['nums']['first']      = ($this->_sections['nums']['iteration'] == 1);
$this->_sections['nums']['last']       = ($this->_sections['nums']['iteration'] == $this->_sections['nums']['total']);
 echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['drilldown'][$this->_sections['nums']['index']]['nums'];  if ($this->_sections['nums']['last']):  else: ?>,<?php endif;  endfor; endif; ?>],
                        color: colors[<?php echo $this->_sections['data']['rownum']; ?>
]
                    }
                }<?php if ($this->_sections['data']['last']):  else: ?>,<?php endif;  endfor; endif; ?>];
    
        function setChart(name, categories, data, color) {
			chart.xAxis[0].setCategories(categories, false);
			chart.series[0].remove(false);
			chart.addSeries({
				name: name,
				data: data,
				color: color || 'white'
			}, false);
			chart.redraw();
        }
    
        var chart = $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: '雅安市区域卫生信息平台接口数据交换总量统计'
            },
            subtitle: {
                text: '--当前统计区域：四川省雅安市'
            },
            xAxis: {
                categories: categories
            },
            yAxis: {
                title: {
                    text: '接口数据请求总量'
                }
            },
            plotOptions: {
                column: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                var drilldown = this.drilldown;
                                if (drilldown) { // drill down
                                    setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
                                } else { // restore
                                    setChart(name, categories, data);
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        color: colors[0],
                        style: {
                            fontWeight: 'bold'
                        },
                        formatter: function() {
                            return this.y +'次';
                        }
                    }
                }
            },
            tooltip: {
                formatter: function() {
                    var point = this.point,
                        s = this.x +'共交换数据:<b>'+ this.y +'</b>次<br/>';
                    if (point.drilldown) {
                        s += '点击查看 '+ point.category +'数据交换详细数据';
                    } else {
                        s += '点击返回数据交换总量图';
                    }
                    return s;
                }
            },
            series: [{
                name: name,
                data: data,
                color: 'white'
            }],
            exporting: {
                enabled: false
            }
        })
        .highcharts(); // return chart
}
</script>