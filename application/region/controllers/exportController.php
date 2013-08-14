<?php
class region_exportController extends controller
{
	public function init()
	{
		require_once(__SITEROOT.'library/Models/region.php');
	}
	public function exportAction()
	{
		$export_string=<<<doc
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 11">
<meta name=Originator content="Microsoft Word 11">
<xml>
 <w:WordDocument>
  <w:View>Print</w:View>
</xml>
</head>
<body>
<table class="MsoTableGrid" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;mso-yfti-tbllook:1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;">
 <tbody><tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;">
  <td width="284" valign="top" style="width:213.05pt;border:solid windowtext 1.0pt;mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;">
  <p class="MsoNormal">区域名称<span lang="EN-US"><o:p></o:p></span></p>
  </td>
  <td width="284" valign="top" style="width:213.05pt;border:solid windowtext 1.0pt;border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt: solid windowtext.5pt;padding:0cm 5.4pt 0cm 5.4pt;">
  <p class="MsoNormal">区域代码<span lang="EN-US"><o:p></o:p></span></p>
  </td>
</tr>
doc;
		$region=new Tregion();
		$region->find();
		$i=0;
		while ($region->fetch())
		{
			$zh_name=$this->get_zh_name($region->region_path);
			$export_string=<<<doc
 <tr style="mso-yfti-irow:1;mso-yfti-lastrow:yes;">
  <td width="284" valign="top" style="width:213.05pt;border:solid windowtext 1.0pt;border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;">
  <p class="MsoNormal"><span lang="EN-US"><o:p>$zh_name</o:p></span></p>
  </td>
  <td width="284" valign="top" style="width:213.05pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;">
  <p class="MsoNormal"><span lang="EN-US"><o:p>{$region->standard_code_path}</o:p></span></p>
  </td>
 </tr>
doc;
			$fp=fopen(__SITEROOT."temp/region.doc","a+");
			fwrite($fp,$export_string);
			fclose($fp);
		}
		$region->free_statement();
		$word_template=<<<doc
</tbody>
</table>
</body>
</html>
doc;
		$fp=fopen(__SITEROOT."temp/region.doc","a+");
		fwrite($fp,$word_template);
		fclose($fp);
	}
	private function get_zh_name($region_path)
	{
		$zh_name="";
		if ($region_path)
		{
			$tmp_array=@explode(",",$region_path);
			if (is_array($tmp_array))
			{
				foreach ($tmp_array as $v)
				{
					$region=new Tregion();
					$region->whereAdd("id='$v'");
					$region->whereAdd("id!='0'");
					$region->find(true);
					if ($region->zh_name)
					{
						$zh_name.=$region->zh_name;
					}
					$region->free_statement();
				}
			}
		}
		return $zh_name;
	}
}
?>