//函数用于js绘图
//xml_path代表xml路径地址
//basePath是模板变量
//width flash的宽
//height flash的高
//swf_name flash的名称和ID
function show_chart(xml_path,basePath,width,height,swf_name)
{
	if (AC_FL_RunContent == 0 || DetectFlashVer == 0)
	{
		alert("This page requires AC_RunActiveContent.js.");
	}
	else
	{
		var hasRightVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);
		if(hasRightVersion) { 
			AC_FL_RunContent(
				'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,45,2',
				'width', width,
				'height', height,
				'scale', 'noscale',
				'salign', 'TL',
				'bgcolor', '#777788',
				'wmode', 'opaque',
				'movie', basePath+'library/charts/charts',
				'src', basePath+'library/charts/charts',
				'FlashVars', 'library_path='+basePath+'library/charts/charts_library&xml_source='+xml_path, 
				'id', swf_name,
				'name', swf_name,
				'menu', 'true',
				'allowFullScreen', 'true',
				'allowScriptAccess','sameDomain',
				'quality', 'high',
				'align', 'middle',
				'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
				'play', 'true',
				'devicefont', 'false'
				); 
		}
		else
		{ 
			var alternateContent = 'This content requires the Adobe Flash Player. '
			+ '<u><a href=http://www.macromedia.com/go/getflash/>Get Flash</a></u>.';
			document.write(alternateContent); 
		}
	}
}