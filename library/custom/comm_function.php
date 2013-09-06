<?php
/**\
 * 公共函数库
 */

	/**
	 * @param $outdate 生日，unix时间戳
	 * @param $nowdate 当前日期，unix时间戳
	 * @return 岁数
	 */
	function getBirthday ($outdate, $nowdate)
    {
    	$lessage="";
    	//格式化时间
        $cBirthday = adodb_date('Ymd', $outdate);
        if (empty($cBirthday)) {
            return - 1;
        }
        $iYear = substr($cBirthday, 0, 4); //取得传入参数的年
        $iMonth = substr($cBirthday, 4, 2); //取得传入参数的月
        $iDate = subStr($cBirthday, 6, 2); //取得传入参数的天
        $iCMonth = adodb_date('m', $nowdate); //当前月
        $iCDate = adodb_date('d', $nowdate); //当前日
        $iCYear = adodb_date('Y', $nowdate); //当前年
        if (! checkdate($iMonth, $iDate, $iYear) || (adodb_mktime(0, 0, 0, $iCMonth, $iCDate, $iCYear)) < (adodb_mktime(0, 0, 0, $iMonth, $iDate, $iYear))) {
            return - 1;
        }
        if ($iYear == $iCYear) {
            $iAge = 0;
        } else {
            $iAge = $iCYear - $iYear;
            if (($iMonth > $iCMonth) || (($iCMonth == $iMonth) && ($iCDate < $iDate))) {
                $iAge --;
            }
        }
        if ($iAge == 0) {
            if (($iCMonth < $iMonth) || (($iCMonth == $iMonth) && ($iCDate < $iDate))) {
                $iCMonth += 12;
            }
            if ($iMonth == $iCMonth) {
                $iBMonth = 0;
            } else {
                $iBMonth = $iCMonth - $iMonth;
                if ($iDate > $iCDate) {
                    $iBMonth --;
                }
            }
            //if ($iBMonth == 0) {
                if ($iDate > $iCDate) {
                    $iCDate += 31;
                }
                $iBDate = $iCDate - $iDate;
                if ($iBDate == 0) {
                    $lessage = adodb_date('G', $nowdate) . "个小时";     
            
                } else {
                    if ($iBDate < 7) {
                        $lessage = $iBDate . " 天";
                    } else {
                        $lessage = round(($iBDate / 7), 1) . "周";
                    }
                }
              
           // } else {
           	if($iBDate==0){
           		 $today='';   
           	}else{
           		$today=$iBDate ." 天";
           	}
                $lessage = $iBMonth . "个月".$today;
           // }
        } else {
            //精确到月
            //$myiage = getadodb_date(($outdate);
            //$lessage = $iAge . "." . round($myiage['yday'] / 365) . " 岁";
            
            $lessage=$iAge. "岁";
        }
        
        return $lessage; //返回年龄
    }
    /**
     * @author 我好笨
     * @todo 显示程序执行时间
     * */    
    function showtimer()
    {
        global $s;
        $e=microtime(true);
        echo "<br>程序执行时间";
       	echo round(($e-$s),4);
        exit;
            
    }    
    /**
     * @author 我好笨
     * @param message 提示信息
     * @param url 要跳转的连接数组
     * @param refer 要自动跳转的连接
     * @param target 打开目标
     * @param return 是否显示返回
     * */
    function message($message,$url=array(),$refer="",$target="",$return=0)
    {
    	$html="
    	<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
		<html>
		<head>
    	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
		<style>
		fieldset{
			width:90%;
			border:1px solid green;
			text-align:left;
			color:green;
			font-size:14px;
			padding:8px;
		}
		fieldset legend{
			border:2px solid green;
			color:#FF0000;
			padding:2px;
			margin:2px;
			font-weight:bold;
		}
		
		</style>
        <script type=\"text/javascript\">     
        function countDown(secs,surl){     
        document.getElementById('jumpTo').innerText=secs;     
        if(--secs>0){     
              setTimeout(\"countDown(\"+secs+\",'\"+surl+\"')\",1000);     
              }     
        else{       
             window.location=surl;     
              }     
        }     
        </script>
		</head>
		<body onload=\"".($refer?"countDown(5,'{$refer}')":"")."\">
		<fieldset>
		<legend >信息提示</legend>
		<br />".$message;
        if($refer)
        {
            $html.="<br /><br />程序设定逻辑将在<span id=\"jumpTo\">5</span>秒后自动跳转,如果你要中断跳转，你也可以点下面链接";
        }
    	if(!empty($url))
    	{
    		if ($target)
    		{
    			$target="target='".$target."'";
    		}
    		foreach ($url as $k=>$v)
    		{
    			$html.="<br /><br />
				<a href=\"$v\" $target>$k</a>
				&nbsp;&nbsp;&nbsp;
				";
    		}
    	}
    	if(!$return)
    	{
    		$html.="<a href=\"##\" onclick=\"javascript:history.back(-1)\">返回</a>";
    	}
    	$html.="
		</fieldset>
		</body>
		</html>
		";
    	echo $html;
    	exit;
    }
    //$sourcestr 是要处理的字符串

//$cutlength 为截取的长度(即字数)

function cut_str($sourcestr,$cutlength)

{

	$returnstr='';

	$i=0;

	$n=0;

	$str_length=strlen($sourcestr);//字符串的字节数

	while (($n<$cutlength) and ($i<=$str_length))

	{

		$temp_str=substr($sourcestr,$i,1);

		$ascnum=Ord($temp_str);//得到字符串中第$i位字符的ascii码

		if ($ascnum>=224)    //如果ASCII位高与224，

		{

			$returnstr=$returnstr.substr($sourcestr,$i,3); //根据UTF-8编码规范，将3个连续的字符计为单个字符

			$i=$i+3;            //实际Byte计为3

			$n++;            //字串长度计1

		}

		elseif ($ascnum>=192) //如果ASCII位高与192，

		{

			$returnstr=$returnstr.substr($sourcestr,$i,2); //根据UTF-8编码规范，将2个连续的字符计为单个字符

			$i=$i+2;            //实际Byte计为2

			$n++;            //字串长度计1

		}

		elseif ($ascnum>=65 && $ascnum<=90) //如果是大写字母，

		{

			$returnstr=$returnstr.substr($sourcestr,$i,1);

			$i=$i+1;            //实际的Byte数仍计1个

			$n++;            //但考虑整体美观，大写字母计成一个高位字符

		}

		else                //其他情况下，包括小写字母和半角标点符号，

		{

			$returnstr=$returnstr.substr($sourcestr,$i,1);

			$i=$i+1;            //实际的Byte数计1个

			$n=$n+0.5;        //小写字母和半角标点等与半个高位字符宽...

		}

	}

	if ($str_length>$cutlength){

		$returnstr = $returnstr . "...";//超过长度时在尾处加上省略号

	}

	return $returnstr;



}
    /**
     * 已放弃使用luo 2011-08-31
*函数功能：利用openflash做柱状图，替代之前的pear
*创建时间：Thu Dec 31 05:31:36 GMT 2009
*修改时间：
* $units表示单位
* 参数只需要数组和标题，其他参数均为适应以前的函数
*/
function drawhistogram($array_nums,$title,$title_x='',$title_y='',$width='',$height='',$units='')
{
	@header("Cache-Control:cache,must-revalidate");
	@header("Pragma:public");
	include_once 'php-ofc-library/open-flash-chart.php';
	srand((double)microtime()*1000000);
	$data = array();
	$title = new title( $title.'柱形图' );
	$i=0;
	$data_max=array();
	foreach ($array_nums as $v)
	{
		// make the last bar a different colour:
		$bar = new bar_value($v['nums']);
		$bar->set_colour( '#008000' );
		$bar->set_tooltip( $v['name'].'<br>#val#'.$units );
		$data[$i] = $bar;
		$data_max[$i]=$v['nums'];
		$i++;
	}
	$bar = new bar_3d();
	$bar->set_values( $data );
	$bar->colour = '#D54C78';

	$x_axis = new x_axis();
	$x_axis->set_3d( 5 );
	$x_axis->colour = '#90EE90';


	////////////
	//创建x_axis_labels对象
	$x_labels = new x_axis_labels();
	$x_labels->set_steps( 1 ); //设置每隔N(步阶)个数显示标签
	$x_labels->set_colour( '#008000' ); //设置标签颜色,十六进制
	$x_labels->set_size( 12 ); //标签文字大小
	$tmp = array();
	foreach ($array_nums as $v)
	{
		if (strlen($v['name'])>=24)
		{
			$v['name']=cut_str($v['name'],8);
		}
		$tmp[] =  new x_axis_label(@strip_tags($v['name']), '#008000', 14, 315);
	}
	//////////
	//把$tmp数组传给x_axis_labels对象
	$x_labels->set_labels( $tmp );
	//把x_labels对象的内容转给x_axis对象
	$x_axis->set_labels( $x_labels);
	//设置Y轴
	$y=new y_axis();
	$ymax=@intval(max($data_max));
	$ymax=$ymax?$ymax:10;
	$y->set_range( 0, $ymax, @round($ymax/10) );
	$chart = new open_flash_chart();
	$chart->set_title( $title );
	$chart->add_element( $bar );
	$chart->set_x_axis( $x_axis );
	$chart->set_y_axis( $y );
	return $chart->toPrettyString();
}
/**
*函数功能：此函数利用Openflash画饼图
*创建时间：Thu Dec 31 05:42:11 GMT 2009
*修改时间：
*/
function drawpie($array_nums,$title,$width='',$height='',$units='')
{
	@header("Cache-Control:cache,must-revalidate");
	@header("Pragma:public");
	include_once 'php-ofc-library/open-flash-chart.php';
	$title = new title( $title );
	$pie = new pie();
	$pie->set_alpha(0.6);
	$pie->set_start_angle( 35 );
	$pie->add_animation( new pie_fade() );
	$pie->set_tooltip( '#val#'.$units.' / #total#'.$units.'<br>#percent# / 100%' );
	$data=array();
	$color=array();//存储颜色
	$i=0;
	foreach ($array_nums as $v)
	{
		$v['name']=$v['name']?$v['name']:"未设置的值";
		$data[$i]=new pie_value(@intval($v['nums']),$v['name']."(".$v['nums'].")");
		$color[$i]="#".rcolor();
		$i++;
	}
	$pie->set_colours($color);
	$pie->set_values($data);

	$chart = new open_flash_chart();
	$chart->set_title( $title );
	$chart->add_element( $pie );
	$chart->x_axis = null;

	return $chart->toPrettyString();
}
/**
 * @author 我好笨
 * @todo  使用pchart画线性图
 * @param $data 数据数组，是一个三维数组，$data[0][data]表示数据列，$data[0][serie]表示x对应的说明
 * $data[0][seriename]表示添加注释时标签的对应名称，
 * @param $XAxisName x坐标注释
 * @param $YAxisName Y坐标注释
 * @param $XAxisUnit X单位
 * @param $YAxisUnit Y单位
 * @param $picname   图片标题
 * @param $width     图片宽度
 * @param $height    图片高度
 * @param $xNameAngle x坐标倾斜度
 */
function drawline($data,$x_array,$XAxisName="",$YAxisName="",$XAxisUnit="",$YAxisUnit="",$picname="",$width="700",$height="230",$xNameAngle="0")
{
	require_once(__SITEROOT . "library/custom/pChart/pChart/pData.class");   
 	require_once(__SITEROOT . "library/custom/pChart/pChart/pChart.class");
     if(empty($data))
     {
        exit;
     }   
    // Dataset definition    
 	 $DataSet = new pData;
 	 $i=0;
 	 foreach ($data as $k=>$v)
 	 {
 	 	$DataSet->AddPoint($v['data'],"Serie".$i);
 	 	$DataSet->AddSerie("Serie".$i);//分开设置注释标签
 	 	$DataSet->SetSerieName($v['seriename'],"Serie".$i);
	 	$i++;
 	 }
 	 $DataSet->AddPoint($x_array,"Seriex");
 	 $DataSet->SetAbsciseLabelSerie("Seriex");//设置x坐标标签
	 $DataSet->SetYAxisName($YAxisName);
	 $DataSet->SetYAxisUnit($YAxisUnit);
	  
	 // Initialise the graph   
	 $Test = new pChart($width,$height);
	 $Test->setFontProperties(__SITEROOT . "library/custom/pChart/Fonts/msyh.ttf",8);   
	 $Test->setGraphArea(70,30,$width-20,$height-50);   
	 $Test->drawFilledRoundedRectangle(7,7,$width-7,$height-7,5,240,240,240);   
	 $Test->drawRoundedRectangle(5,5,$width-5,$height-5,5,230,230,230);   
	 $Test->drawGraphArea(255,255,255,TRUE);
	 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,$xNameAngle,2);   
	 $Test->drawGrid(4,TRUE,230,230,230,50);
	  
	 // Draw the 0 line   
	 $Test->setFontProperties(__SITEROOT . "library/custom/pChart/Fonts/msyh.ttf",6);   
	 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);   
	  
	 // Draw the lineline graph
	 $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());   
	 $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);   
	  
	 // Finish the graph   
	 $Test->setFontProperties(__SITEROOT . "library/custom/pChart/Fonts/msyh.ttf",8);   
	 $Test->drawLegend(75,35,$DataSet->GetDataDescription(),255,255,255);   
	 $Test->setFontProperties(__SITEROOT . "library/custom/pChart/Fonts/msyh.ttf",10);   
	 $Test->drawTitle(60,22,$picname,50,50,50,585);   
	 //$Test->Render("example1.png");
	 $Test->Stroke();
}
/**
 * @author 我好笨
 * @todo 画柱状图
 * @param $data  数据数组，同线性图
 * @param $x_array x轴标签数组
 * @param $XAxisName x坐标注释
 * @param $YAxisName Y坐标注释
 * @param $XAxisUnit X单位
 * @param $YAxisUnit Y单位
 * @param $picname   图片标题
 * @param $width     图片宽度
 * @param $height    图片高度
 * @param $xNameAngle x轴标签倾斜度
 */
function drawbar($data,$x_array,$XAxisName="",$YAxisName="",$XAxisUnit="",$YAxisUnit="",$picname="",$width="700",$height="230",$xNameAngle="0")
{
	require_once(__SITEROOT . "library/custom/pChart/pChart/pData.class");   
 	require_once(__SITEROOT . "library/custom/pChart/pChart/pChart.class"); 
     if(empty($data))
     {
        exit;
     }   
 // Dataset definition    
 	 $DataSet = new pData;
 	 $i=0;
 	 foreach ($data as $k=>$v)
 	 {
 	 	$DataSet->AddPoint($v['data'],"Serie".$i);
 	 	$DataSet->AddSerie("Serie".$i);//分开设置注释标签
 	 	if (isset($v['seriename']))
 	 	{
 	 		$DataSet->SetSerieName($v['seriename'],"Serie".$i);
 	 	}
	 	$i++;
 	 }
 	 $DataSet->AddPoint($x_array,"Seriex");
 	 $DataSet->SetAbsciseLabelSerie("Seriex");//设置x坐标标签
	 $DataSet->SetYAxisName($YAxisName);
	 $DataSet->SetYAxisUnit($YAxisUnit);
	  
	 // Initialise the graph   
	 $Test = new pChart($width,$height);
	 $Test->setFontProperties(__SITEROOT . "library/custom/pChart/Fonts/msyh.ttf",8);
	 $Test->setGraphArea(50,30,$width-20,$height-30);//设置图像区域大小，分别为开始的坐标（x,y）和结束的坐标(x,y)
	 $Test->drawFilledRoundedRectangle(7,7,$width-7,$height-7,5,240,240,240);//绘制内层圆角矩形$X1,$Y1,$X2,$Y2,$Radius,$R,$G,$B
	 $Test->drawRoundedRectangle(5,5,$width-5,$height-5,5,230,230,230);//绘制外层圆角矩形
	 $Test->drawGraphArea(255,255,255,TRUE);
	 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,$xNameAngle,2,TRUE);//倒数第三个参数控制x标签注释的方向
	 $Test->drawGrid(4,TRUE,230,230,230,50);
	
	 // Draw the 0 line
	 $Test->setFontProperties(__SITEROOT . "library/custom/pChart/Fonts/msyh.ttf",6);
	 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);
	
	 // Draw the bar graph
	 $Test->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE,80);
	
	
	 // Finish the graph
	 $Test->setFontProperties(__SITEROOT . "library/custom/pChart/Fonts/msyh.ttf",10);
	 $Test->drawLegend(75,35,$DataSet->GetDataDescription(),255,255,255);//控制提示框的位置
	 $Test->setFontProperties(__SITEROOT . "library/custom/pChart/Fonts/msyh.ttf",10);
	 $Test->drawTitle(50,22,$picname,50,50,50,585);
	 $Test->Stroke();
}
/**
 * xml/swf 生成3d柱形图
 * @author 我好笨
 * @param array $data 数据
 * @param array $x_array x轴对应的标签
 * @param string $YAxisName 标签名称
 * @param array $XAxisUnit 单位
 * @param string $picname 图片标题
 * @param string $pic_type 图片类型 3d column为不同柱子对比图 ，默认为在同一根立柱上的对比
 * @param string $width flash宽度
 * @param string $height flash高度
 * @return string
 */
function xml_draw_3d_bar($data,$x_array,$YAxisName="",$XAxisUnit=array(),$picname="",$pic_type="stacked 3d column",$width=600,$height=350)
{
	$x_string="";
	foreach ($x_array as $v)
	{
		$x_string.="<string>$v</string>";
	}
	$y_data="";
	$count=1;
	$Unit=array();
	foreach ($data as $m=>$v)
	{
		if (!is_array($XAxisUnit))
		{
			$Unit[$m]=$XAxisUnit;
		}
		else 
		{
			$Unit=$XAxisUnit;
		}
		$y_data.="<row>
			<string>".$v['axisname']."</string>";
		unset($v['axisname']);
		$count=count($v);
		foreach ($v as $k=>$s)
		{
			if ($k!=="axisname")
			{
				$y_data.="<number tooltip='".$s.$Unit[$m]."'>$s</number>";
			}
		}
		$y_data.="</row>";
	}
	$color=xml_color($count,"bar");
	$xml_string="<chart>
	<license>ITAEZGCTUWIO8WN5CWK-2XOI1X0-7L</license>
	<axis_category shadow='low' size='12' color='000000' alpha='75' font='simsun' orientation='diagonal_down' />
	<axis_ticks value_ticks='true' category_ticks='true' minor_count='1' />
	<axis_value shadow='low' size='12' color='000000' alpha='75' />

	<chart_border top_thickness='0' bottom_thickness='2' left_thickness='2' right_thickness='0' />
	<chart_data>
		<row>
			<null/>
			$x_string
		</row>
		$y_data
	</chart_data>
	<chart_grid_h thickness='1' type='dashed' />
	<chart_grid_v thickness='1' type='dashed' />
	<chart_rect x='".($width*(150/600))."' y='".($height*(60/350))."' width='".($width*(420/600))."' height='".($height*(230/350))."' positive_color='fffffe' positive_alpha='50' />
	<chart_pref rotation_x='".($width*(6/600))."' rotation_y='0' min_x='0' max_x='".($width*(80/600))."' min_y='0' max_y='".($height*(60/350))."' />
	<chart_type>$pic_type</chart_type>
	<chart_transition type='scale' delay='1' duration='2' order='category' />
	<draw>
        <image layer='background' x='0' y='0' width='$width' height='$height' url='".__BASEPATH."images/water_mark.png' />
		<text shadow='high' color='000000' alpha='75' rotation='2' size='14' x='".($width*(15/600))."' y='".($height*(18/350))."' width='".($width*(560/600))."' height='".($height*(400/350))."' h_align='center' font='simsun'>$picname</text>
	</draw>
	<filter>
		<shadow id='high' distance='5' angle='45' alpha='35' blurX='".($width*(15/600))."' blurY='".($height*(15/350))."' />
		<shadow id='low' distance='2' angle='45' alpha='50' blurX='".($width*(5/600))."' blurY='".($height*(5/350))."' />
	</filter>

	<legend bevel='bevel1' transition='dissolve' delay='0' duration='1' x='0' y='".($height*(45/350))."' width='".($width*(50/600))."' height='".($height*(210/350))."' margin='10' fill_color='0' fill_alpha='20' line_color='000000' line_alpha='0' line_thickness='0' layout='horizontal' bullet='circle' size='12' color='000000' alpha='85' font='simsun' />
	<tooltip color='f9f9f9' alpha='80' size='12' background_color_1='f9f9f9' background_alpha='75' shadow='low'  font='simsun' />
	<series_color>
		$color
	</series_color>
	<series bar_gap='0' set_gap='20' />
</chart>";
	return $xml_string;
}
/**
 * xml/swf 生成3d饼形图,参数同柱形图
 * @author 我好笨
 * @param array $data
 * @param array $x_array
 * @param string $YAxisName
 * @param string $XAxisUnit
 * @param string $picname
 * @param string $width
 * @param string $height
 * @return string
 */
function xml_draw_3d_pie($data,$x_array=array(),$YAxisName="",$XAxisUnit="",$picname="",$width=600,$height=350)
{
	set_time_limit(0);
	$x_string="";
	$y_data="";
	foreach ($data as $v)
	{
		foreach ($v as $k=>$s)
		{
			if ($k!=="axisname")
			{
				$v['axisname']=isset($x_array[$k])?$x_array[$k]:$v['axisname'];
				$y_data.="<number tooltip='(".$v['axisname'].")".$s.$XAxisUnit."'>$s</number>";
				$x_string.="<string>".$v['axisname']."</string>";
			}
		}
	}
	$color=xml_color(count($data));
	$xml_string="<chart>
	<license>ITAEZGCTUWIO8WN5CWK-2XOI1X0-7L</license>
	<chart_data>
		<row>
			<null/>
			$x_string
		</row>
		<row>
			<string></string>
			$y_data
		</row>
	</chart_data>
	<chart_label shadow='low' alpha='65' size='14' position='inside' as_percentage='true' font='simsun' />
	<chart_pref select='true' drag='false' rotation_x='50' />
	<chart_rect x='".($width*(150/600))."' y='".($height*(60/350))."' width='".($width*(420/600))."' height='".($height*(230/350))."' positive_alpha='0' />
	<chart_type>3d pie</chart_type>
	<chart_transition type='spin' delay='0' duration='1' order='category' />
	<draw>
        <image layer='background' x='0' y='0' width='$width' height='$height' url='".__BASEPATH."images/water_mark.png' />
		<text shadow='high' color='000000' alpha='75' rotation='2' size='14' x='".($width*(35/600))."' y='".($height*(18/350))."' width='".($width*(560/600))."' height='".($height*(400/350))."' h_align='center' font='simsun'>$picname</text>
	</draw>
	<filter>
		<shadow id='high' distance='3' angle='45' alpha='50' blurX='".($width*(10/600))."' blurY='".($height*(10/350))."' />
		<shadow id='low' distance='2' angle='45' alpha='60' blurX='".($width*(10/600))."' blurY='".($height*(10/350))."' />
		<bevel id='bg' angle='90' blurX='0' blurY='200' distance='50' highlightAlpha='15' shadowAlpha='15' type='inner' font='simsun' />
	</filter>
	<legend bevel='bevel1' transition='dissolve' delay='0' duration='1' x='0' y='".($height*(45/350))."' width='".($width*(50/600))."' height='".($height*(210/350))."' margin='10' fill_color='0' fill_alpha='20' line_color='000000' line_alpha='0' line_thickness='0' layout='horizontal' bullet='circle' size='12' color='000000' alpha='85' font='simsun' />
	<tooltip font='simsun' />
	<series_color>
		$color
	</series_color>
</chart>";
	return $xml_string;
}
/**
 * xml/swf 生成线性图,参数同柱形图
 * @author 我好笨
 * @param array $data
 * @param array $x_array
 * @param string $YAxisName
 * @param string $XAxisUnit
 * @param string $picname
 * @param string $width
 * @param string $height
 * @return string
 */
function xml_draw_line($data,$x_array,$YAxisName="",$XAxisUnit="",$picname="",$width=600,$height=350)
{
	$x_string="";
	foreach ($x_array as $v)
	{
		$x_string.="<string>$v</string>";
	}
	$y_data="";
	foreach ($data as $v)
	{
		$y_data.="<row>
			<string>".$v['axisname']."</string>";
		foreach ($v as $k=>$s)
		{
			if ($k!=="axisname")
			{
				$y_data.="<number tooltip='(".$x_array[$k].$v['axisname'].")".$s.$XAxisUnit."'>$s</number>";
			}
		}
		$y_data.="</row>";
	}
	$color=xml_color(count($data));
	$xml_string="<chart>
	<license>ITAEZGCTUWIO8WN5CWK-2XOI1X0-7L</license>
	<axis_category shadow='low' size='12' color='000000' alpha='75' orientation='diagonal_down' />
	<axis_ticks value_ticks='true' category_ticks='false' major_thickness='2' minor_thickness='1' minor_count='1' minor_color='222222' position='outside' />
	<axis_value shadow='low' min='0' max='120' size='10' color='000000' alpha='50' steps='6' />

	<chart_border top_thickness='2' bottom_thickness='2' left_thickness='2' right_thickness='2' />
	<chart_data>
		<row>
			<null/>
			$x_string
		</row>
		$y_data
	</chart_data>
	<chart_grid_h alpha='10' thickness='1' type='solid' />
	<chart_grid_v alpha='10' thickness='1' type='solid' />
	<chart_guide horizontal='true' thickness='1' color='000000' alpha='50' type='dashed' radius='5' line_color='FFFF00' line_alpha='75' line_thickness='2' text_color='FFFF00' text_h_alpha='90' />	
	<chart_pref line_thickness='2' point_shape='none' fill_shape='false' />
	<chart_rect x='".($width*(160/600))."' y='".($height*(60/350))."' width='".($width*(420/600))."' height='".($height*(230/350))."' positive_color='000000' positive_alpha='30' bevel='bg' font='simsun' />
	<chart_transition type='scale' delay='2' duration='2' order='series' />
	<chart_type>Line</chart_type>

	<draw>
        <image layer='background' x='0' y='0' width='$width' height='$height' url='".__BASEPATH."images/water_mark.png' />
		<text shadow='high' color='000000' alpha='75' rotation='2' size='14' x='".($width*(35/600))."' y='".($height*(18/350))."' width='".($width*(560/600))."' height='".($height*(400/350))."' h_align='center' font='simsun'>$picname</text>
	</draw>
	<filter>
		<shadow id='low' distance='2' angle='45' alpha='50' blurX='".($width*(5/600))."' blurY='".($height*(5/350))."' />
		<shadow id='high' distance='5' angle='45' alpha='25' blurX='".($width*(10/600))."' blurY='".($height*(10/350))."' />
		<bevel id='bg' angle='45' blurX='".($width*(15/600))."' blurY='".($height*(15/350))."' distance='5' highlightAlpha='25' highlightColor='000000' shadowAlpha='50' type='outer' />
	</filter>
	<legend bevel='bevel1' transition='dissolve' delay='0' duration='1' x='0' y='".($height*(45/350))."' width='".($width*(50/600))."' height='".($height*(210/350))."' margin='10' fill_color='0' fill_alpha='20' line_color='000000' line_alpha='0' line_thickness='0' layout='horizontal' bullet='circle' size='12' color='000000' alpha='85' font='simsun' />
	<tooltip font='simsun' />
	<series_color>
		$color
	</series_color>

</chart>";
	return $xml_string;
}


/**
 * xml/swf 生成线性图,参数同柱形图
 * @author 我好笨
 * @param array $data
 * @param array $x_array
 * @param string $YAxisName
 * @param string $XAxisUnit
 * @param string $picname
 * @param string $width
 * @param string $height
 * @return string
 */
function xml_draw_line_children($data,$x_array,$YAxisName="",$XAxisUnit="",$picname="",$width=600,$height=350)
{
	$x_string="";
	foreach ($x_array as $v)
	{
		$x_string.="<string>$v</string>";
	}
	$y_data="";
	foreach ($data as $v)
	{
		$y_data.="<row>
			<string>".$v['axisname']."</string>";
		foreach ($v as $k=>$s)
		{
			if ($k!=="axisname")
			{
				$y_data.="<number tooltip='(".$x_array[$k].$v['axisname'].")".$s.$XAxisUnit."'>$s</number>";
			}
		}
		$y_data.="</row>";
	}
	$xml_string="<chart>
	<license>ITAEZGCTUWIO8WN5CWK-2XOI1X0-7L</license>
	<axis_category shadow='low' size='12' color='000000' alpha='75' orientation='diagonal_down' />
	<axis_ticks value_ticks='true' category_ticks='false' major_thickness='2' minor_thickness='1' minor_count='1' minor_color='222222' position='outside' />
	<axis_value shadow='low' min='0' max='120' size='10' color='000000' alpha='50' steps='6' />

	<chart_border top_thickness='2' bottom_thickness='2' left_thickness='2' right_thickness='2' />
	<chart_data>
		<row>
			<null/>
			$x_string
		</row>
		$y_data
	</chart_data>
	<chart_grid_h alpha='10' thickness='1' type='solid' />
	<chart_grid_v alpha='10' thickness='1' type='solid' />
	<chart_guide horizontal='true' thickness='1' color='000000' alpha='50' type='dashed' radius='5' line_color='FFFF00' line_alpha='75' line_thickness='2' text_color='FFFF00' text_h_alpha='90' />	
	<chart_pref line_thickness='2' point_shape='none' fill_shape='false' />
	<chart_rect x='".($width*(160/600))."' y='".($height*(60/350))."' width='".($width*(420/600))."' height='".($height*(230/350))."' positive_color='000000' positive_alpha='30' bevel='bg' font='simsun' />
	<chart_transition type='scale' delay='2' duration='2' order='series' />
	<chart_type>Line</chart_type>

	<draw>
        <image layer='background' x='0' y='0' width='$width' height='$height' url='".__BASEPATH."images/water_mark.png' />
		<text shadow='high' color='000000' alpha='75' rotation='2' size='14' x='".($width*(35/600))."' y='".($height*(18/350))."' width='".($width*(560/600))."' height='".($height*(400/350))."' h_align='center' font='simsun'>$picname</text>
	</draw>
	<filter>
		<shadow id='low' distance='2' angle='45' alpha='50' blurX='".($width*(5/600))."' blurY='".($height*(5/350))."' />
		<shadow id='high' distance='5' angle='45' alpha='25' blurX='".($width*(10/600))."' blurY='".($height*(10/350))."' />
		<bevel id='bg' angle='45' blurX='".($width*(15/600))."' blurY='".($height*(15/350))."' distance='5' highlightAlpha='25' highlightColor='000000' shadowAlpha='50' type='outer' />
	</filter>
	<legend bevel='bevel1' transition='dissolve' delay='0' duration='1' x='0' y='".($height*(45/350))."' width='".($width*(50/600))."' height='".($height*(210/350))."' margin='10' fill_color='0' fill_alpha='20' line_color='000000' line_alpha='0' line_thickness='0' layout='horizontal' bullet='circle' size='12' color='000000' alpha='85' font='simsun' />
	<tooltip font='simsun' />
	<series_color>
		<color>CC0033</color>
		<color>FF6347</color>
		<color>DCDCDC</color>
		<color>8A2BE2</color>
		<color>00FFFF</color>
		<color>8A2BE2</color>
		<color>DCDCDC</color>
		<color>FF6347</color>
	</series_color>

</chart>";
	return $xml_string;
}

/**
 * xml_draw_donut()
 * 
 * 画环状图
 * 
 * @param mixed $data
 * @param mixed $x_array
 * @param string $YAxisName
 * @param string $XAxisUnit
 * @param string $picname
 * @param integer $width
 * @param integer $height
 * @return
 */
function xml_draw_donut($data,$x_array,$YAxisName="",$XAxisUnit="",$picname="",$width=600,$height=350)
{
    //间隔
    $jg=array();
    $x_string='';
    foreach ($x_array as $v)
	{
		$x_string.="<string>$v</string>";
        $jg[]=0;
	}
    $jg[1]=20;
    $jg_string='';
    foreach($jg as $k=>$v)
    {
        $jg_string.="<number>$v</number>";
    }
	$y_data="<row>
			<string></string>";
	foreach ($data as $v)
	{
		foreach ($v as $k=>$s)
		{
			if ($k!=="axisname")
			{
				$y_data.="<number shadow='high' bevel='data' line_color='FFFFFF' line_thickness='3' line_alpha='75'>$s</number>";
			}
		}
	}
    $y_data.="</row>";
	$color=xml_color(count($data));
    $xml_string="<chart>
<license>ITAEZGCTUWIO8WN5CWK-2XOI1X0-7L</license>
	<chart_data>
		<row>
			<null/>
			$x_string
		</row>
		$y_data
	</chart_data>
	<chart_label shadow='low' color='ffffff' alpha='95' size='10' position='inside' as_percentage='true' />
	<chart_pref select='true' />
	<chart_rect x='90' y='85' width='".($width-100)."' height='".($height-120)."' />
	<chart_transition type='scale' delay='1' duration='0.5' order='category' />
	<chart_type>donut</chart_type>

	<draw>
		<image layer='background' x='0' y='0' width='$width' height='$height' url='".__BASEPATH."images/water_mark.png' />
		<text shadow='high' color='000000' alpha='75' rotation='2' size='14' x='".($width*(35/600))."' y='".($height*(20/350))."' width='".($width*(560/600))."' height='".($height*(400/350))."' h_align='center' font='simsun'>$picname</text>
	</draw>
	<filter>
		<shadow id='low' distance='2' angle='45' color='0' alpha='40' blurX='5' blurY='5' />
		<shadow id='high' distance='5' angle='45' color='0' alpha='40' blurX='10' blurY='10' />
		<shadow id='soft' distance='2' angle='45' color='0' alpha='20' blurX='5' blurY='5' />
		<bevel id='data' angle='45' blurX='5' blurY='5' distance='3' highlightAlpha='15' shadowAlpha='25' type='inner' />
		<bevel id='bg' angle='45' blurX='50' blurY='50' distance='10' highlightAlpha='35' shadowColor='0000ff' shadowAlpha='25' type='full' />
		<blur id='blur1' blurX='75' blurY='75' quality='1' />   
	</filter>
	
	<context_menu full_screen='false' />
	
    <legend bevel='bevel1' transition='dissolve' delay='0' duration='1' x='0' y='".($height*(45/350))."' width='80' height='".($height*(210/350))."' margin='10' fill_color='0' fill_alpha='5' line_color='000000' line_alpha='0' line_thickness='0' layout='horizontal' bullet='circle' size='12' color='000000' alpha='85' font='simsun' />
	<series_color>
		$color
	</series_color>
	<series_explode>
		$jg_string
	</series_explode>
	<series transfer='true' />

</chart>";
    return $xml_string;
}
/**
 * 为xml/swf 专门写的生成颜色的函数
 *
 * @param int $number
 * @param string $type 类型，单柱状图时使用
 * @return string
 */
function xml_color($number=7,$type="")
{
	$color_string="";
	if ($type=="bar")
	{
		$color_array=array("0066CC","d71345","32CD32","6666CC","1E90FF","FFD700","00FFFF","A020F0","A020F0","FF00FF","F5DEB3","FFD700","7FFF00","082E54","00C78C","DA70D6","000000","FAEBD7","DCDCDC","FFDEAD","8A2BE2","FF6347");
	}
	else 
	{
		$color_array=array("CC0033","32CD32","0066CC","FF9900","FFD700","00FFFF","A020F0","FF00FF","F5DEB3","FFD700","7FFF00","082E54","00C78C","DA70D6","000000","FAEBD7","DCDCDC","FFDEAD","8A2BE2","FF6347");
	}
	$i=0;
	while ($i<$number)
	{
		$color_string.="<color>".$color_array[$i]."</color>";
		$i++;
	}
	return $color_string;
}
/**
 * @author 我好笨
 * @param $data 数据数组，饼图中仅支持一组数据
 * @param $x_array x轴标签数组
 * @param $picname 图片标题
 * @param $width 图片宽
 * @param $height 图片高
 * @param $pie_type //标签显示种类
 */
function draw3dpie($data,$x_array,$picname="",$width="700",$height="230",$pie_type="PIE_PERCENTAGE")
{
	require_once(__SITEROOT . "library/custom/pChart/pChart/pData.class");   
 	require_once(__SITEROOT . "library/custom/pChart/pChart/pChart.class");
     if(empty($data))
     {
        exit;
     }    
 // Dataset definition    
 	 $DataSet = new pData;
	 $DataSet->AddPoint($data['data'],"Serie0");
 	 $DataSet->AddPoint($x_array,"Seriex");
 	 $DataSet->AddAllSeries();
 	 $DataSet->SetAbsciseLabelSerie("Seriex");
 	 
	 $Test = new pChart($width,$height);
	 $Test->drawFilledRoundedRectangle(7,7,$width+13,$height-7,5,240,240,240);
	 $Test->drawRoundedRectangle(5,5,$width+15,$height-5,5,230,230,230);
	 $Test->createColorGradientPalette(195,204,56,223,110,41,5);
	
	 // Draw the pie chart
	 $Test->setFontProperties(__SITEROOT . "library/custom/pChart/Fonts/msyh.ttf",8);
	 $Test->AntialiasQuality = 0;
	 $Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),180,130,110,$pie_type,FALSE,50,20,5);//倒数第5个参数控制显示标签
	 $Test->drawPieLegend($width-90,15,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
	
	 // Write the title
	 $Test->setFontProperties(__SITEROOT . "library/custom/pChart/Fonts/msyh.ttf",10);
	 $Test->drawTitle(50,20,$picname,100,100,100);
	
	 $Test->Stroke();
}
/**
 * 枚举两个日期间的日期
 * 年月周，季分别加一表示统计当前月在内，比如8,9月，必须同时统计8和9
 * @param $time_start 开始时间
 * @param $time_end 结束时间
 * @param $serach_type 枚举类型
 */
function list_time($time_start,$time_end,$serach_type)
{
	$result=array();
	$time_i=0;
	switch ($serach_type)
		{
			case 'day':
				{
					//$time_i=abs($time_end-$time_start)/(3600*24);
                    $time_i=datediff("d", $time_start, $time_end, true);
					for ($i=0;$i<=$time_i;$i++)
					{
						$result[$i]=adodb_date("Y-m-d",adodb_mktime(0,0,0,date("n",$time_start),date("j",$time_start)+$i,date("Y",$time_start)));
					}
					break;
				}
			case 'week':
				{
					$time_i=datediff("ww", $time_start, $time_end, true)+1;
					for ($i=0;$i<=$time_i;$i++)
					{
						$result[$i]=adodb_date("Y(W)",adodb_mktime(0,0,0,date("n",$time_start),date("j",$time_start)+$i*7,date("Y",$time_start)));
					}
					break;
				}
			case 'quarter':
				{
					$time_i=datediff("q", $time_start, $time_end, true)+1;
					for ($i=0;$i<=$time_i;$i++)
					{
						$result[$i]=adodb_date("Y(",adodb_mktime(0,0,0,date("n",$time_start)+$i*3,date("j",$time_start),date("Y",$time_start))).ceil(adodb_date("n",adodb_mktime(0,0,0,date("n",$time_start)+$i*3,date("j",$time_start),date("Y",$time_start)))/3).")";
					}
					break;
				}
			case 'month':
				{
					$time_i=datediff("m", $time_start, $time_end, true)+1;
					for ($i=0;$i<=$time_i;$i++)
					{
						$result[$i]=adodb_date("Y-m",adodb_mktime(0,0,0,date("n",$time_start)+$i,date("j",$time_start),date("Y",$time_start)));
					}
					break;
				}
			case 'year':
				{
					$time_i=datediff("yyyy", $time_start, $time_end, true)+1;
					for ($i=0;$i<=$time_i;$i++)
					{
						$result[$i]=adodb_date("Y",adodb_mktime(0,0,0,date("n",$time_start),date("j",$time_start),date("Y",$time_start)+$i));
					}
					break;
				}
			default:
				{
					$time_i=datediff("d", $time_start, $time_end, true);
					for ($i=0;$i<=$time_i;$i++)
					{
						$result[$i]=adodb_date("Y-m-d",adodb_mktime(0,0,0,date("n",$time_start),date("j",$time_start)+$i,date("Y",$time_start)));
					}
					break;
				}
		}
		return $result;
}

function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
    /*
    $interval can be:
    yyyy - Number of full years
    q - Number of full quarters
    m - Number of full months
    y - Difference between day numbers
        (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
    d - Number of full days
    w - Number of full weekdays
    ww - Number of full weeks
    h - Number of full hours
    n - Number of full minutes
    s - Number of full seconds (default)
    */

    if (!$using_timestamps) {
        $datefrom = strtotime($datefrom, 0);
        $dateto = strtotime($dateto, 0);
    }
    
    $difference = $dateto - $datefrom; // Difference in seconds

    switch($interval) {

    case 'yyyy': // Number of full years
        $years_difference = floor($difference / 31536000);
        if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
            $years_difference--;
        }
        if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
            $years_difference++;
        }
        $datediff = $years_difference;
        break;
    case "q": // Number of full quarters
        $quarters_difference = floor($difference / 8035200);
        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
            $quarters_difference++;
            
        }
        $quarters_difference--;
        $datediff = $quarters_difference;
        break;
    case "m": // Number of full months
        $months_difference = floor($difference / 2678400);
        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
            $months_difference++;
        }
        $months_difference--;
        $datediff = $months_difference;
        break;
    case 'y': // Difference between day numbers
        $datediff = date("z", $dateto) - date("z", $datefrom);
        break;
    case "d": // Number of full days
        $datediff = floor($difference / 86400);
        break;
    case "w": // Number of full weekdays
        $days_difference = floor($difference / 86400);
        $weeks_difference = floor($days_difference / 7); // Complete weeks
        $first_day = date("w", $datefrom);
        $days_remainder = floor($days_difference % 7);
        $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
        if ($odd_days > 7) { // Sunday
            $days_remainder--;
        }
        if ($odd_days > 6) { // Saturday
            $days_remainder--;
        }
        $datediff = ($weeks_difference * 5) + $days_remainder;
        break;
    case "ww": // Number of full weeks
        $datediff = floor($difference / 604800);
        break;
    case "h": // Number of full hours
        $datediff = floor($difference / 3600);
        break;
    case "n": // Number of full minutes
        $datediff = floor($difference / 60);
        break;
    default: // Number of full seconds (default)
        $datediff = $difference;
        break;
    }
    return $datediff;
}

/**
*作者:我好笨
*函数功能：生成随机颜色
*创建时间：Thu Dec 31 06:40:29 GMT 2009
*修改时间：
*/
function rcolor()
{
	srand((double)microtime()*10000000);
	return sprintf("%02X",rand(30,170)).sprintf("%02X",rand(30,170)).sprintf("%02X",rand(30,170));
}
/**
 * 用于个人健康档案综合统计的基础统计
 * @author 我好笨
 * @param $table 统计的表名
 * @param $time_start 开始时间
 * @param $time_end 结束时间
 * @param $groupby 
 * @param $selectas
 * @param $arr 代码转换数组，即数据字典数组
 */
function ihaStatistics($table,$org_id,$time_start,$time_end,$groupby,$selectas,$arr,$no_org='')
{
	require_once __SITEROOT . "/library/Models/$table.php";
	$data=array();
	$t="T$table";
	$core=new $t;
	if ($no_org=="")
	{
		$core->whereAdd("$table.org_id='$org_id'");
	}
	else 
	{
		if ($table=="individual_core")
		{
			$core->whereAdd($no_org);
		}
		else 
		{
			require_once __SITEROOT . "/library/Models/individual_core.php";
			$individual_core=new Tindividual_core();
			$individual_core->whereAdd($no_org);
			$core->joinAdd('left',$core,$individual_core,'id','uuid');
		}
	}
	$core->whereAdd("$table.updated>=$time_start");
	$core->whereAdd("$table.updated<=$time_end");
    //2012-02-22 我好笨修改，仅统计正常档案（罗老师QQ回复）
	$core->whereAdd("individual_core.status_flag=1");
	$core->groupBy($groupby);
	$core->selectAdd($selectas);
	$core->find();
	$i=0;
	while ($core->fetch())
	{
		$data['name'][$i]=@$arr[array_search_for_other($core->name,$arr)][1]?@$arr[array_search_for_other($core->name,$arr)][1]:"未填写";
		$data['data'][$i]=@intval($core->nums);
		$data[$i]['name']=$data['name'][$i];
		$data[$i]['nums']=$core->nums;
		$i++;
	}
	return $data;
}
/**
 * @author 我好笨
 * 通过ID获取医生姓名
 * @param char $staff_id
 */
function get_staff_name_byid($staff_id)
{
	require_once __SITEROOT . "/library/Models/staff_core.php";
	$staff_core=new Tstaff_core();
	$staff_core->whereAdd("id='$staff_id'");
	$staff_core->find(true);
    $staff_core->free_statement();
	return $staff_core->name_login?$staff_core->name_login:"";
}
/**
 * @author 我好笨
 * 通过ID获取医生所有信息
 * @param $staff_id
 */
function get_staff_byid($staff_id)
{
	require_once __SITEROOT . "/library/Models/staff_core.php";
	$staff_core=new Tstaff_core();
	$staff_core->whereAdd("id='$staff_id'");
	$staff_core->find(true);
	return $staff_core;
}
/**
 * @author 我好笨
 * 判定给定的值是否为空
 * @param $var string or array()
 */
function is_empty_for_multi($var)
{
	if (is_array($var))
	{
        foreach ($var as $value)
        {
            if (!is_empty_for_multi($value))
            {
                return false;
            }
        }
    }
    elseif (!empty($var))
    {
        return false;
    }
    return true;	
}
/**
 * 在给定的$array数据字典数组中查找$var，并返回其非标准的代码集
 * @author 我好笨
 * @param string $var
 * @param array() $array
 */
function array_search_for_other($var,$array)
{
	if (!is_empty_for_multi($array))
	{
		foreach ($array as $k=>$v)
		{
			if (is_array($v) && in_array($var,$v))
			{
				return $k;
			}
		}
		return "";	
	}
	else 
	{
		return "";
	}
}
/**
 * @author 我好笨
 * 将用户填写的代码通过数据字典转换为内部码
 * @param string $var
 * @param array() $array
 */
function array_code_change($var,$array)
{
	if (!is_empty_for_multi($array) && $var!="")
	{
		foreach ($array as $k=>$v)
		{
			if (@isset($array["$var"]["0"]))
			{
				return $array["$var"]["0"];
			}
		}
	   return "";	
	}
	else 
	{
		return "";
	}
}
/**
 * 根据个人档案的uuid取得一个人的所有信息
 * @author mask
 * @param string $uuid
 * @return object
 */
function get_individual_info($uuid=''){
	if($uuid==''){
		//throw new Exception("参数不正确！");
        return false;
	}
	require_once (__SITEROOT . "/library/Models/individual_core.php");
	$individual_core=new Tindividual_core();
	$individual_core->whereAdd("uuid='{$uuid}'");
	$individual_core->find();
	$individual_core->fetch();
    $individual_core->free_statement();
	return $individual_core;
	
}
function get_househoder_name($uuid="")
{
	if($uuid==''){
		//throw new Exception("参数不正确！");
        return false;
	}
	require_once (__SITEROOT . "/library/Models/family_archive.php");
	$family_archive=new Tfamily_archive();
	$family_archive->whereAdd("uuid='{$uuid}'");
	$family_archive->find(true);
    $family_archive->free_statement();
	return $family_archive->householder_name;
}
/**
 * 根据医生档案号取得医生的所有信息
 *@author mask
 * @param string $user_id
 * @return object
 */
function get_staff_info($user_id=''){
	if($user_id==''){
		//throw new Exception("参数不正确！");
        return false;
	}
	require_once (__SITEROOT . "/library/Models/staff_archive.php");
	require_once (__SITEROOT . "/library/Models/staff_core.php");
	
	$staff_archive=new Tstaff_archive();	
	$staff_core=new Tstaff_core();
	$staff_archive->joinAdd('inner',$staff_archive,$staff_core,'user_id','id');
	$staff_archive->whereAdd("staff_archive.user_id='{$user_id}'");
	//$staff_archive->debugLevel(3);
	$staff_archive->find();
	$staff_archive->fetch();
	$array=array();
	$array[]=$staff_core;
	$array[]=$staff_archive;
	return $array;
}
/**
 * 取得当相应机构的所有医生uuid和医生真实名,如果org_id=''则取得所有医生名字和uuid
 * @author mask
 * @param $org_id string 
 * @return 
 */
function get_all_staff_info($org_id=''){
	
			$staff_core		=	new Tstaff_core();
			$staff_archive	=	new Tstaff_archive();
			$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
			//不指定机构则取出所有医生
			if(!empty($org_id)){
				$staff_core->whereAdd("org_id='{$org_id}'");
			}			
			$staff_core->find();
			$row=array();
			$record_count=0;//记录数;
			while ($staff_core->fetch()) {
				$row[$record_count]['id']			=	$staff_core->id;//id
				$row[$record_count]['standard_code']=	$staff_core->standard_code;//standard_code
				$row[$record_count]['name_login']	=	$staff_core->name_login;//登录名
				$row[$record_count]['name_real']	=	$staff_archive->name_real;//真实名
				//$roles_arr							=	getRoles($staff_core->role_id);//取得角色数组
				//$role								=	$roles_arr[0]['role_zh_name'];//得到角色中文名
				//$row[$record_count]['role_name']	=	$role;//角色名


				$record_count++;
			}
			return $row;
}
/**
 * 插入登录日志
 * @author mask
 * @param string $log_id
 * @param string $user_id
 * @param string $ip_address
 * @param number $login_time
 * @param number $status
 * @param string $remark
 * @return bool
 */
function insert_login_log($log_id='',$user_id='',$ip_address='',$login_time=0,$status=0,$remark=''){
	if(empty($ip_address) || empty($login_time) || empty($status)){
		throw new Exception(__FILE__.__FUNCTION__."参数错误");	
	}	
	require_once (__SITEROOT . "/library/Models/login_log.php");
	$login_log=new Tlogin_log();
	$login_log->uuid=uniqid('log',true);
	$login_log->org_id=$log_id;
	$login_log->user_id=$user_id;
	$login_log->ip_address=$ip_address;
	$login_log->login_time=$login_time;
	$login_log->status=$status;
	$login_log->remark=$remark;
	if($login_log->insert()){
		return true;
	}else{
		return false;
	}
}
/**
 * @author 我好笨
 * @filesource 读取高血压随访的最后一次访问时间、随访医生信息
 * @param string $uuid 随访的用户ID
 */
function get_moreinfo_hypertension($uuid,$follow_next_time_start="",$follow_next_time_end="")
{
	require_once __SITEROOT."library/Models/hypertension_follow_up.php";
	$hypertension_follow_up=new Thypertension_follow_up();
	$hypertension_follow_up->whereAdd("id='$uuid'");
    if ($follow_next_time_start)
	{
		$hypertension_follow_up->whereAdd("follow_next_time >= '".$follow_next_time_start."'");
	}
    if ($follow_next_time_end)
	{
		$hypertension_follow_up->whereAdd("follow_next_time <= '".$follow_next_time_end."'");
	}
	$hypertension_follow_up->orderBy("follow_time DESC");
	$hypertension_follow_up->find(true);
    $hypertension_follow_up->follow_next_time=$hypertension_follow_up->follow_next_time?adodb_date("Y-m-d",$hypertension_follow_up->follow_next_time):"";
	$hypertension_follow_up->follow_time=$hypertension_follow_up->follow_time?adodb_date("Y-m-d",$hypertension_follow_up->follow_time):"";
	$hypertension_follow_up->staff_id=get_staff_name_byid($hypertension_follow_up->staff_id);
    $hypertension_follow_up->free_statement();
	return $hypertension_follow_up;
}
/**
 * @author 我好笨
 * @filesource 读取高血压随访的药品信息
 * @param string $uuid 随访记录的主UUID
 * @param string $module 调用模块
 * @return array $drug_array 药品信息数组
 */
function get_follow_drug($uuid,$module="hypertension")
{
	require_once __SITEROOT."library/Models/follow_up_drugs.php";
	$follow_up_drugs=new Tfollow_up_drugs();
	$follow_up_drugs->whereAdd("follow_uuid='$uuid'");
	$follow_up_drugs->whereAdd("call_module='$module'");
	$follow_up_drugs->find();
	$drug_array=array();
	$i=0;
	while ($follow_up_drugs->fetch())
		{
			$drug_array[$i]['drug_uuid']=$follow_up_drugs->uuid;
			$drug_array[$i]['drug_name']=$follow_up_drugs->drug_name;
			$drug_array[$i]['drug_amount']=$follow_up_drugs->drug_amount;
			$drug_array[$i]['drug_frequency']=$follow_up_drugs->drug_frequency;
			$drug_array[$i]['drugs_uuid']=$follow_up_drugs->uuid;
			$i++;
		}
	return $drug_array;
}
/**
 * @author 我好笨
 * @filesource 读取精神病随访的最后一次访问时间、随访医生信息
 * @param string $uuid 随访的用户ID
 */
function get_moreinfo_schizophrenia($uuid)
{
	require_once __SITEROOT."library/Models/schizophrenia.php";
	$schizophrenia=new Tschizophrenia();
	$schizophrenia->whereAdd("id='$uuid'");
	$schizophrenia->orderBy("fllowup_time DESC");
	$schizophrenia->find(true);
	$schizophrenia->fllowup_time=$schizophrenia->fllowup_time?adodb_date("Y-m-d",$schizophrenia->fllowup_time):"";
	$schizophrenia->staff_id=get_staff_name_byid($schizophrenia->staff_id);
	return $schizophrenia;
}
/**
 * @author 我好笨
 * 用于获取症状信息
 * @param $uuid
 * @param $module
 */
function get_follow_symptom_code($uuid)
{
	require_once __SITEROOT."library/Models/hypertension_symptom.php";
	$hypertension_symptom=new Thypertension_symptom();
	$hypertension_symptom->whereAdd("follow_up_uuid='$uuid'");
	$hypertension_symptom->find();
	$symptom_array=array();
	$i=0;
	while ($hypertension_symptom->fetch())
		{
			$symptom_array[$i]['symptom_code']=$hypertension_symptom->symptom_code;
			$i++;
		}
	return $symptom_array;
}
/*
 *Eric_Zhou
 *
 */
function get_moreinfo_diabetes($uuid)
{
	require_once __SITEROOT."library/Models/diabetes_core.php";
	$diabetes_core=new Tdiabetes_core();
	$diabetes_core->whereAdd("id='$uuid'");
	$diabetes_core->orderBy("followup_time DESC");
	$diabetes_core->find(true);
	$diabetes_core->follow_time=adodb_date("Y-m-d",$diabetes_core->followup_time);
	$diabetes_core->staff_id=get_staff_name_byid($diabetes_core->staff_id);
	return $diabetes_core;
}
function get_moreinfo_premarital($uuid)
{
	require_once __SITEROOT."library/Models/certificate_premartial_exam.php";
	$exam=new Tcertificate_premartial_exam();
	$exam->whereAdd("id='$uuid'");
	//$exam->orderBy("followup_time DESC");
	$exam->find(true);
	$exam->record_time=adodb_date("Y-m-d",$exam->record_time);
	//$exam->staff_id=get_staff_name_byid($diabetes_core->staff_id);
	return $exam;
}
function get_moreinfo_premarital_examination($uuid)
{
	require_once __SITEROOT."library/Models/premarital_examination.php";
	$exam=new Tpremarital_examination();
	$exam->whereAdd("id='$uuid'");
	//$exam->orderBy("followup_time DESC");
	$exam->find(true);
	$exam->fill_time=adodb_date("Y-m-d",$exam->fill_time);
	//var_dump($exam->fill_time);
	//$exam->staff_id=get_staff_name_byid($diabetes_core->staff_id);
	return $exam;
}
/**
 * 过去一年内第一次随访日期
 * @param $id
 */
function get_last_follow_time($id,$time)
{
	require_once __SITEROOT."library/Models/hypertension_follow_up.php";
	if (isset($id) && $id)
	{
		$hypertension_follow_up=new Thypertension_follow_up();
		//$hypertension_follow_up->selectAdd("min(follow_time) as first_time");
		$hypertension_follow_up->whereAdd("id='$id'");
		$hypertension_follow_up->whereAdd("follow_time>='$time'");
        $hypertension_follow_up->orderBy('follow_time desc');
		$hypertension_follow_up->find(true);
        $hypertension_follow_up->free_statement();
		return $hypertension_follow_up->follow_time;
	}
	return 0;
}
function last_diabetes_follow_time($id,$time)
{
	require_once __SITEROOT."library/Models/diabetes_core.php";
	if (isset($id) && $id)
	{
		$diabetes_core=new Tdiabetes_core();
		$diabetes_core->selectAdd("min(followup_time) as first_time");
		$diabetes_core->whereAdd("id='$id'");
		$diabetes_core->whereAdd("followup_time>='$time'");
		$diabetes_core->find(true);
        $diabetes_core->free_statement();
		return $diabetes_core->first_time;
	}
	return 0;
}
/**
 * @author 我好笨
 * @todo 查找指定 用户最后一次随访血压同时满足“收缩压<140 且 舒张压<90mmHg” 的记录数
 */
function calculate_blood_pressure($id)
{
	require_once __SITEROOT."library/Models/hypertension_follow_up.php";
	if (isset($id) && $id)
	{
		$hypertension_follow_up=new Thypertension_follow_up();
		$hypertension_follow_up->whereAdd("id='$id'");
		$hypertension_follow_up->whereAdd("blood_pressure<'140'");
		$hypertension_follow_up->whereAdd("diastolic_blood_pressure<'90'");
		//$hypertension_follow_up->whereAdd("follow_time>='$time'");
		$hypertension_follow_up->orderby("follow_time DESC");
		$hypertension_follow_up->find(true);
        $hypertension_follow_up->free_statement();
		if($hypertension_follow_up->id==$id)
		{
			return 1;
		}
		return 0;
	}
	return 0;
}

/**
	 * 根据机构ID找到与之匹配的所有用户信息,机构上级能看到下一级用户
	 * @author mask
	 * @param string $region_path_domain/$region_path
	 * @return array
	 */
	function region_users($region_path_domain){
		require_once __SITEROOT.'library/Models/staff_core.php';//医生主表
		require_once __SITEROOT.'library/Models/staff_archive.php';//医生扩展表
		$staff_core=new Tstaff_core();
		$staff_archive=new Tstaff_archive();
		$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
		if(strpos($region_path_domain,'|')===FALSE){
			$staff_core->whereAdd("INSTR(staff_core.region_path,'$region_path_domain')>0");
		}else{
			$region_path_domain_arr=explode('|',$region_path_domain);
			$condition ='';
			//foreach ($region_path_domain_arr as $region_id){
			//$region_path_domain形如'0,1,2,5,71,87|0,1,2,5,71,86|'0,1,2,5,71,85'
			$region_path_domain_first_arr= explode(',',$region_path_domain_arr[0]);//region_path_domain第一个单元转成array
			$count=count($region_path_domain_first_arr)-1;//
			unset($region_path_domain_first_arr[$count]);//删除最后一个元素
			$region_id=implode(',',$region_path_domain_first_arr);
			//$condition.=" INSTR(staff_core.region_path,'$region_id')>0 OR";
			$condition.=" INSTR(staff_core.region_path,'$region_id')>0 ";//匹配region_path
			//}
			//$staff_core->whereAdd(trim($condition,"OR"));
			$staff_core->whereAdd($condition);
			//$staff_core->debugLevel(3);
		}
		//$staff_core->debugLevel(3);
		$staff_core->find();
		$i=0;
		$user_array=array();
		while ($staff_core->fetch()) {
			//echo "aaa<br/>";
			
			$org_info_array=get_org_info($staff_core->org_id);//取得当前机构所有信息
			
			//echo "aaa<br/>";
			$org_name						= $org_info_array->zh_name;//机构名
			$user_array[$i]['user_id']		= $staff_core->id;//用户ID
			$user_array[$i]['name_real']	= $org_name.':'.$staff_archive->name_real;//用户真实名
			$user_array[$i]['telephone']	= $staff_archive->telephone_number;//用户电话
			$i++;
		}
		$staff_core->free_statement();
		return $user_array;
		
	}
	/**
	 * 根据机构id取得机构中所有信息
	 * @author mask
	 * @param int $id
	 * @return object
	 */
	function get_org_info($id){
		require_once __SITEROOT.'library/Models/organization.php';//机构表
		$organization=new Torganization();
		$organization->whereAdd("id=$id");
		//$organization->debugLevel(3);
		$organization->find();
		
		$organization->fetch();
		//echo "bbb<br/>";
		//print_r($organization);
		//exit();
		$organization->free_statement();
		return $organization;

	}
//预防接种卡记录
function get_moreinfo_vac($uuid)
{
	require_once __SITEROOT."library/Models/vac_card.php";
	$vac=new Tvac_card();
	$vac->whereAdd("id='$uuid'");
	//$exam->orderBy("followup_time DESC");
	$vac->find(true);
	$vac->created_card_time=@adodb_date("Y-m-d",$vac->created);
	//$exam->staff_id=get_staff_name_byid($diabetes_core->staff_id);
	return $vac;
}
/**
 * 根据当前登录人员的区域获取医生列表
 * author:罗的代码 ，我好笨 整理成公共函数
 * @param $org_region_domain 当前登录的region_path
 * @param $current_doctor 当前登录的医生ID
 */
function get_doctor_list($org_region_domain,$current_doctor)
{
	require_once __SITEROOT."library/Models/staff_core.php";
	require_once __SITEROOT."library/Models/staff_archive.php";
	require_once __SITEROOT."library/Models/organization.php";
	//引入权限
	require_once(__SITEROOT.'library/MyAuth.php');
	$auth = Zend_Auth::getInstance();
	$user = $auth->getIdentity();
	$org_region=$user['current_region_path'];
	$temp=explode("|",$org_region_domain);
	$staff_core_region_path_domain='';
	foreach ($temp as $k1=>$v1){
			$temp1=explode(",",$org_region);
			if(count($temp1)<=4){
				$staff_core_region_path_domain=$staff_core_region_path_domain."INSTR(staff_core.region_path,'".$v1."')>0 or ";
			}else{
				$staff_core_region_path_domain=$staff_core_region_path_domain."staff_core.region_path like '".$v1."%' or ";
			}
		}
	$staff_core_region_path_domain=rtrim($staff_core_region_path_domain,' or ');
	$temp_org_id=$user['org_id'];
	if(!empty($staff_core_region_path_domain)){
		$staff_core_region_path_domain=$staff_core_region_path_domain." or staff_core.org_id='$temp_org_id'";
	}
	else
	{
		$staff_core_region_path_domain="staff_core.org_id='$temp_org_id'";
	}
	$staff_core=new Tstaff_core();
	//$staff_core->setCache(true,_DAO_CACHE_URL,_DAO_CACHE_TIMEOUT);
	//$staff_core->setCache(true,'',60*60*24);
	$staff_archive=new Tstaff_archive();
	$org=new Torganization();
	$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
	$staff_core->joinAdd('inner',$staff_core,$org,'org_id','id');
	$staff_core->whereAdd($staff_core_region_path_domain);
	//$staff_core->debugLevel(9);
	$staff_core->find();
	$responseDoctorArray=array();
	$responseDoctorArray[0]['zh_name']='请选择';
	$responseDoctorArray[0]['id']='-9';
	$counter=1;
	while ($staff_core->fetch()) {
		//生成负责医生下拉框
		$responseDoctorArray[$counter]['zh_name']=$org->zh_name.':'.$staff_archive->name_real;
		$responseDoctorArray[$counter]['id']=$staff_core->id;
		if($current_doctor==$staff_core->id)
		{
			$responseDoctorArray[$counter]['selected']='selected';
		}
		else 
		{
			$responseDoctorArray[$counter]['selected']='';
		}
		$counter++;
	}
	return $responseDoctorArray;
}
/**
 * 根据参数$param返回个人表的$individual_core_region_path_domain或者医生表的$staff_core_region_path_domain
 * 约定：1返回个人表数据，2返回医生表数据
 * @author 根据罗老师代码写的公共函数，防止因为再次修改代码导致出现问题
 * @param param int 1,2
 */
function get_region_path($param,$search="")
{
	//引入权限
	require_once(__SITEROOT.'library/MyAuth.php');
	$auth = Zend_Auth::getInstance();
	$user = $auth->getIdentity();
	$org_region=$user['current_region_path'];
	$org_region_domain=$user['current_region_path_domain'];
    if($search)
    {
        require_once __SITEROOT."library/Models/region.php";
        $region=new Tregion();
        $region->whereAdd("id='$search'");
        $region->find(true);
        $org_region=isset($region->region_path)?$region->region_path:$org_region;
    }
	$temp=explode("|",$org_region_domain);
	$individual_core_region_path_domain='';
	$staff_core_region_path_domain='';
	foreach ($temp as $k1=>$v1){
			/*$temp1=explode(",",$org_region);
			if(count($temp1)<=4){
				$individual_core_region_path_domain=$individual_core_region_path_domain."individual_core.region_path like '".$v1."%' or ";
				$staff_core_region_path_domain=$staff_core_region_path_domain."staff_core.region_path like '".$v1."%' or ";
			}else{
				$individual_core_region_path_domain=$individual_core_region_path_domain."individual_core.region_path like '".$org_region."%' or ";
				$staff_core_region_path_domain=$staff_core_region_path_domain."staff_core.region_path like '".$org_region."%' or ";
			}*/
            //2011年6月2日解决移动管理机构问题，废弃原罗老师的写法。
            $individual_core_region_path_domain=$individual_core_region_path_domain."individual_core.region_path like '".$v1."%' or ";
            $staff_core_region_path_domain=$staff_core_region_path_domain."staff_core.region_path like '".$v1."%' or ";
            //2011年6月2日修改搜索条件
            //2011年8月1日修改，对岩镇这种管理地区有限的问题与搜索条件差异
            if($search)
            {
                $individual_core_region_path_domain=rtrim($individual_core_region_path_domain,' or ');
                $staff_core_region_path_domain=rtrim($staff_core_region_path_domain,' or ');
                $individual_core_region_path_domain.=" and individual_core.region_path like '".$org_region."%' or ";
				$staff_core_region_path_domain.=" and staff_core.region_path like '".$org_region."%' or ";
            }
		}
	$individual_core_region_path_domain=rtrim($individual_core_region_path_domain,' or ');
	$staff_core_region_path_domain=rtrim($staff_core_region_path_domain,' or ');
	$temp_org_id=$user['org_id'];
	if(!empty($staff_core_region_path_domain)){
		$staff_core_region_path_domain=$staff_core_region_path_domain." or staff_core.org_id='$temp_org_id'";
	}
	else
	{
		$staff_core_region_path_domain=$staff_core_region_path_domain." staff_core.org_id='$temp_org_id'";
	}
	if ($param==1)
	{
		return $individual_core_region_path_domain;
	}
	else 
	{
		if ($param==2)
		{
			return $staff_core_region_path_domain;
		}
		return "";
	}
}
/**
 *@author 我好笨
 * @todo 取是否确诊慢病信息，无则返回0
 * @param $id 个人id
 * @param $disease_code 慢病代码(系统码)
 * @param $status 默认状态 1为患者
 * */
function get_status_cd($id,$disease_code='2',$status='1')
{
    require_once __SITEROOT.'/library/Models/clinical_history.php';
	$clinical_history=new Tclinical_history();
	$clinical_history->whereAdd("disease_code='$disease_code'");
    $clinical_history->whereAdd("disease_state='$status'");
    $clinical_history->whereAdd("id='$id'");
	$clinical_history->find(true);
    return $clinical_history;
}
/**
 * @author 我好笨
 * @todo用于确诊慢病
 * @param $id 个人id号
 * @param $disease_code 慢病系统码
 * @param $date 慢病确诊日期，可为空
 * @deprecated 引用前必须包含数据字典，disease_history为疾病史数据字典数组，确定staff_id和org_id，分别为医生ID和机构ID
 */
function diagnose_disease($id,$disease_code="2",$date="",$disease_history,$staff_id,$org_id)
{
    $disease_code_input=array_search_for_other($disease_code,$disease_history);
    require_once __SITEROOT.'/library/Models/clinical_history.php';
	$clinical_history=new Tclinical_history();
	$clinical_history->whereAdd("disease_code='$disease_code'");
    $clinical_history->whereAdd("id='$id'");
	if($clinical_history->count())
    {
        //更新
        $clinical_history->disease_name=$disease_history[$disease_code_input][1];
    	$clinical_history->disease_code=$disease_code;
        $clinical_history->disease_date=$date;
        $clinical_history->disease_state=1;
        $clinical_history->update();
    }
    else
    {
        //新增
        $groupid=uniqid("G_");
        $clinical_history=new Tclinical_history();
    	$clinical_history->id=$id;
    	$clinical_history->created=time();
    	$clinical_history->updated=time();
    	$clinical_history->staff_id=$staff_id;//医生ID
    	$clinical_history->org_id=$org_id;
    	$clinical_history->status_flag=1;
    	$clinical_history->uuid=uniqid("C_");
    	$clinical_history->groupid=$groupid;
    	$clinical_history->life_cycle=time();
    	$clinical_history->disease_name=$disease_history[$disease_code_input][1];
        $clinical_history->disease_state=1;
    	$clinical_history->disease_code=$disease_code;
        $clinical_history->disease_date=$date;
    	$clinical_history->insert();
    }
    $clinical_history->free_statement();
}
/**
 * @todo 生成跳转URL
 * @author 我好笨
 * @param $url 待解析的url
 * @return 返回空或者加密后的URL串
 * */
function create_refer($url)
{
    $postion=strpos($url,"|");
    if($postion===false)
    {
        return "";
    }
    else
    {
        $string_new=substr($url,$postion+1);
        if($string_new!="")
        {
            return base64_encode($string_new);
        }
    }
}
/**
 * @todo 完成工作计划
 * @param $staff_id 医生ID
 * @param $serial_number 随访人ID
 * @param $region_path 随访人所属机构
 * @param $title 计划标题
 * @param $tips_type 计划关键字，比如高血压随访，则在指定数组中查找高血压随访的索引
 * @param $tips_time 计划预定执行时间，即下次随访时间
 * @param $tips_url 查看地址
 * @param $tips_info 计划备注 存放随访结果
 * @param $tips_follow_time 随访时间
 * */
function create_tips($staff_id,$serial_number,$region_path,$title,$tips_type="高血压随访",$tips_time,$tips_url,$tips_info="",$tips_follow_time="")
{
    //取随访ID
    require_once __SITEROOT."/library/planmenu/plan_array.php";
    $tips_id="";
    foreach($plan_array as $k=>$v)
    {
        if($v==$tips_type)
        {
            $tips_id=$k;
            break;
        }
    }
    if($tips_id==="")
    {
        return "error_01";//无法找到所属的计划类型，请省系统管理员添加
    }
    else
    {
        //判定之前是否有未完成的同类随访
        require_once __SITEROOT."library/Models/tips.php";
        $tips=new Ttips();
        $tips->whereAdd("id='$serial_number'");
        $tips->whereAdd("state='0'");
        $tips->whereAdd("tips_time>='$tips_time'");
        $tips->whereAdd("tips_url!='$tips_url'");//排除本次
        $tips->state=1;
        $tips->tips_complete_time=time();
        $tips->tips_complete_person=$staff_id;
        $tips->update(array($staff_id));
        //新增或者编辑随访
        require_once __SITEROOT."/application/tp/models/insert_tips.php";
        update_tips($staff_id,$serial_number,$region_path,$title,$tips_id,$tips_time,$tips_url,$staff_id,$tips_info,$tips_follow_time);
        return true;
    }
}
/**
 * 根据地区的region_path取其机构数组或者字符串
 * @author 我好笨
 * @param string $region_path
 * @param string $array 默认返回字符串，供SQL查询的IN字句使用
 * @return string or array
 */
function get_organization_id($region_path,$array=0)
{
	require_once(__SITEROOT.'library/Models/organization.php');
	$organization=new Torganization();
	$organization->whereAdd("region_path like '$region_path%'");
	$organization->find();
	$i=0;
	$row=array();
	$string=array();
	while ($organization->fetch())
	{
		$row[$i] = $organization->standard_code;
		$string[$i]="'".$row[$i]."'";
		$i++;
	}
	if ($array==0)
	{
		return implode(",",$string);
	}
	else 
	{
		return $row;
	}
}
/**
 * 根据机构标准代码获取机构名称，常用于第三方接口
 *
 * @param string $standard_code
 * @return string
 */
function get_organization_by_standard_code($standard_code)
{
	require_once(__SITEROOT.'library/Models/organization.php');
	$organization=new Torganization();
	$organization->whereAdd("standard_code = '$standard_code'");
	$organization->find(true);
	$zh_name="";
	$zh_name=$organization->zh_name;
	$organization->free_statement();
	return $zh_name;
}
/**
 * get_organization_name()
 * 
 * 根据机构ID获取机构名称
 * 
 * @param mixed $org_id
 * @return
 */
function get_organization_name($org_id)
{
    require_once(__SITEROOT.'library/Models/organization.php');
	$organization=new Torganization();
	$organization->whereAdd("id = '$org_id'");
	$organization->find(true);
	$zh_name="";
	$zh_name=$organization->zh_name;
	$organization->free_statement();
	return $zh_name;
}
/**
 * 创建缓存文件...
 *
 * @param string $filename
 * @param array $data_array
 */
function create_php_cache($filename,$data_array,$cache_time="3600")
{
	if(!file_exists($filename) || (time()-filemtime($filename))>=3600)
	{
		$string="<?php\r\n";
		$string.="\$rows=".var_export($data_array,1).";";
		$string.="\r\n?>";
		$fp=@fopen($filename,"w");
		fwrite($fp,$string);
		@fclose($fp);
	}
}
function create_php_cache_1($filename,$data_array,$cache_time="3600"){
	if(!file_exists($filename) || (time()-filemtime($filename))>=3600)
	{
		file_put_contents($filename,serialize($data_array));
	}	
}
/**
 * 查找上级的所有机构时 针对数组返回数组的值
 * $arrayname   数组名称
 * $nodename    xml所在的节点名称
 * $databaseval 数据库中数据表查询出来的值
 */
function getarrayval($arrayname,$nodename,$databaseval)
	     	{
	     		foreach ($arrayname as $k=>$v)
	     		{
	     			if($k==$databaseval)
	     			{
	     				return '<'.$nodename.'>'.$v.'</'.$nodename.'>';
	     			}
	     		}
}
/**
 * 对应表的数据
 * @author mask
 *
 * @param string $table
 * @param array() $fields
 * @param string $where
 * @param int $debug
 * @return array
 */
function get_fields_content($table,$fields=array(),$where='',$debug=0){
	
	require_once(__SITEROOT."library/Models/{$table}.php");
	$class='T'.$table;
	$t_class=new $class();
	foreach ($fields as $field){
		$t_class->selectAdd($field);
	}
	if($where!=''){
		$t_class->whereAdd($where);
	}
	$t_class->debug(intval($debug));
	$rs_array=array();
	$i=0;
	$t_class->find();		
	
	while ($t_class->fetch()) {
		
			foreach ($fields as $field){
				$rs_array[$i][$field]=$t_class->$field;				
			}
			$i++;
			
	}
	
    $t_class->free_statement();
    
	return $rs_array;
	
}
/**
 * get_region_zhname()
 * 
 * 根据区域的id，返回区域的中文全称
 * 
 * @author 我好笨
 * @param mixed $id
 * @return
 */
function get_region_zhname($id)
{
    $zhname='';
    if($id)
    {
        require_once(__SITEROOT."library/Models/region.php");
        $region=new Tregion();
        $region->whereAdd("id='$id'");
        $region->find(true);
        $region_path=$region->region_path;
        $region->free_statement();
        if($region_path)
        {
            $region=new Tregion();
            $region->whereAdd("id in ($region_path) and id!='0'");
            $region->orderBy("id asc");
            $region->find();
            while($region->fetch())
            {
                $zhname.=$region->zh_name;
            }
            $region->free_statement();
        }
    }
    return $zhname;
}
/**
 * get_sort_path()
 * 
 * 根据栏目ID，获取栏目全路径
 * 
 * @param mixed $sortid
 * @return void
 */
function get_sort_path($sortid)
{
    $tmp=array();
    if($sortid)
    {
        $web_sort=new Tweb_sort();
        $web_sort->whereAdd("uuid='$sortid'");
        $web_sort->find(true);
        $path=$web_sort->path;
        $web_sort->free_statement();
        $tmp_path=@explode('|',$path);
        if(!empty($tmp_path))
        {
            foreach($tmp_path as $k=>$v)
            {
                $web_sort=new Tweb_sort();
                $web_sort->whereAdd("uuid='$v'");
                $web_sort->find(true);
                $tmp[$k]['uuid']=$web_sort->uuid;
                $tmp[$k]['sortname']=$web_sort->sortname;
                $tmp[$k]['py']=$web_sort->sortname_py;
                $web_sort->free_statement();
            }
        }
    }
    return $tmp;
}