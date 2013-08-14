<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="UTF-8" />
<xsl:template match="/">
<html xmlns="http://www.w3.org/1999/xhtml" charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <head>
        <title>一般护理记录</title>
        <link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/common.css" />
        <link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/normalnurserecord.css" />    
    </head>
    <body>
    <div id="normalnurserecord">
        <table cellpadding="3" cellspacing="0" class="nnrtable">
        <tr>
            <td class="nnrtitle">
              <xsl:value-of select="EMR06.01.01/ZLG06.01.01.001/EMR06.01.01.001" />
            </td>
        </tr>
          <tr>
            <td>
              <img src="Common/Styles/体温图标.jpg" alt="体温图标" title="体温图标" />
              <a href="javascript:top.myTab.Cts('体温单浏览','../svg.htm? {EMR06.01.01/ZLG06.01.01.001/EMR06.01.01.001}',true);">体温单展现</a>
            </td>
          </tr>
        </table>
        <table cellpadding="0" cellspacing="0" class="nnrtable">
            <tr>
            <td>
                &#160;
            </td>
            </tr>
        </table>
        <table cellpadding="3" cellspacing="0" class="nnrtable">
            <tr>
                <td class="alignleft" style="width:20%">
                    <span class="fontbold">姓名：</span>
                    <xsl:value-of select="EMR06.01.01/ZLG06.01.01.002/EMR06.01.01.018" />
                </td>
                <td class="alignleft" style="width:15%">
                    <span class="fontbold">性别：</span>
                    <xsl:value-of select="EMR06.01.01/ZLG06.01.01.003/ZLE06.01.01.103" />
                </td>
                <td class="alignleft" style="width:30%">
                    <span class="fontbold">年龄：</span>
                    <xsl:value-of select="EMR06.01.01/ZLG06.01.01.003/ZLE06.01.01.104" />
                </td>
                <td class="alignleft">
                    <span class="fontbold">住院号：</span>
                    <xsl:for-each select="EMR06.01.01/ZLG06.01.01.002/ZLG06.01.01.009[EMR06.01.01.011 = '住院病案']">
                        <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR06.01.01.012" />
                        </xsl:if>
                    </xsl:for-each>
                </td>
            </tr>
            <tr>
                <td colspan="4">&#160;</td>
            </tr>            
        </table>
        <xsl:for-each select="EMR06.01.01/ZLG06.01.01.008">
        <xsl:sort select="ZLE06.01.01.097" />
        <!--当前位置-->
        <xsl:variable name="currPos">
            <xsl:value-of select="position()" />
        </xsl:variable>
        <!--当前记录时间-->
        <xsl:variable name="currNurseDate">
            <xsl:value-of select="string(ZLE06.01.01.097)" />
        </xsl:variable>
        <!--当前住院机构科室-->
        <xsl:variable name="currOrgDept">
            <xsl:for-each select="../ZLG06.01.01.004[string(ZLE06.01.01.091) = $currNurseDate ]">
                <xsl:if test="position() = 1">
                    <xsl:value-of select="concat(EMR06.01.01.021,'|',EMR06.01.01.025)" />
                </xsl:if>
            </xsl:for-each>
        </xsl:variable>
        <!--上一记录时间-->
        <xsl:variable name="preNurseDate">
            <xsl:for-each select="../ZLG06.01.01.008">
                <xsl:sort select="ZLE06.01.01.097" />
                <xsl:if test="position() = $currPos - 1">
                    <xsl:value-of select="ZLE06.01.01.097" />
                </xsl:if>
            </xsl:for-each>
        </xsl:variable>
        <!--上一记录住院机构科室-->
        <xsl:variable name="preOrgDept">
            <xsl:value-of select="concat(../ZLG06.01.01.004[string(ZLE06.01.01.091) = $preNurseDate]/EMR06.01.01.021,
                                    '|',
                                    ../ZLG06.01.01.004[string(ZLE06.01.01.091) = $preNurseDate]/EMR06.01.01.025) "/>
        </xsl:variable>
        <xsl:if test="$currOrgDept != $preOrgDept">
        <table cellpadding="3" cellspacing="0" class="nnrtable">
            <tr>
                <td class="alignleft" style="width:35%">
                    <span class="fontbold">住院机构：</span>
                    <xsl:value-of select="substring-before($currOrgDept,'|')" />
                </td>
                <td class="alignleft" style="width:30%">
                    <span class="fontbold">住院日期：</span>
                    <xsl:for-each select="../ZLG06.01.01.002/ZLG06.01.01.009[EMR06.01.01.011='住院病案']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="concat(substring(string(EMR06.01.01.013),1,4),'年',
                                                        substring(string(EMR06.01.01.013),6,2),'月',
                                                        substring(string(EMR06.01.01.013),9,2),'日')
                                                  "/>
                        </xsl:if>
                    </xsl:for-each>
                </td>
                <td class="alignleft">
                    <span class="fontbold">住院科别：</span>
                    <xsl:value-of select="substring-after($currOrgDept,'|')" />
                </td>                    
            </tr>
        </table>
        <table cellpadding="3" cellspacing="0" class="nnrtable">
            <tr>
                <td class="alignleft">
                    <xsl:value-of select="translate(substring($currNurseDate,1,16),'T',' ')" />
                </td>
            </tr>
            <tr>
                <td class="alignleft" style="text-indent:21pt">
                    体温：
                    <xsl:for-each select="ZLG06.01.01.015/ZLG06.01.01.020[ZLE06.01.01.098='015']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="ZLG06.01.01.028/EMR06.01.01.065" />
                        </xsl:if>
                    </xsl:for-each>
                    ℃
                    &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                    脉搏：
                    <xsl:for-each select="ZLG06.01.01.015/ZLG06.01.01.020[ZLE06.01.01.098='033']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="ZLG06.01.01.028/EMR06.01.01.065" />
                        </xsl:if>
                    </xsl:for-each>
                    次/分
                    &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                    呼吸：
                    <xsl:for-each select="ZLG06.01.01.015/ZLG06.01.01.020[ZLE06.01.01.098='037']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="ZLG06.01.01.028/EMR06.01.01.065" />
                        </xsl:if>
                    </xsl:for-each>
                    次/分
                    &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                    血压：
                    <xsl:for-each select="ZLG06.01.01.015/ZLG06.01.01.020[ZLE06.01.01.098='007']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="ZLG06.01.01.028/EMR06.01.01.065" />
                        </xsl:if>
                    </xsl:for-each>/
                    <xsl:for-each select="ZLG06.01.01.015/ZLG06.01.01.020[ZLE06.01.01.098='008']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="ZLG06.01.01.028/EMR06.01.01.065" />
                        </xsl:if>
                    </xsl:for-each>
                    mmHg
                    </td>
            </tr>
            <tr>
                <td class="alignleft" style="text-indent:21pt">
                    <xsl:value-of select="../ZLG06.01.01.006/EMR06.01.01.048" />
                    <xsl:value-of select="../ZLG06.01.01.006/EMR06.01.01.049" />
                </td>
            </tr>
            <!--皮肤检查描述-->
            <tr>
                <td class="alignleft" style="text-indent:21pt">
                    <xsl:if test="string-length(ZLG06.01.01.016/EMR06.01.01.141) &gt; 0">
                        <xsl:value-of select="ZLG06.01.01.016/EMR06.01.01.141" />   
                    </xsl:if>
                    <xsl:if test="string-length(ZLG06.01.01.016/EMR06.01.01.143) &gt; 0">
                        ，
                        <xsl:value-of select="ZLG06.01.01.016/EMR06.01.01.143" />
                    </xsl:if>
                    <xsl:if test="ZLG06.01.01.016/ZLG06.01.01.022">     
                        <xsl:for-each select="ZLG06.01.01.016/ZLG06.01.01.022">
                            <xsl:if test="position() = 1">
                                ，
                            </xsl:if>
                            <xsl:if test="position() != last()">
                                <xsl:value-of select="EMR06.01.01.144" />
                                <xsl:if test="string-length(ZLG06.01.01.029/EMR06.01.01.145) &gt; 0">
                                    ，<xsl:value-of select="ZLG06.01.01.029/EMR06.01.01.145" />，
                                </xsl:if>
                                <xsl:if test="string-length(ZLG06.01.01.029/EMR06.01.01.145) = 0">
                                    <xsl:if test="string(ZLG06.01.01.029/ZLE06.01.01.106) = 'true'">
                                        是，
                                    </xsl:if>
                                    <xsl:if test="string(ZLG06.01.01.029/ZLE06.01.01.106) = 'false'">
                                        否，
                                    </xsl:if>                                    
                                </xsl:if>
                            </xsl:if>  
                            <xsl:if test="position() = last()">
                                <xsl:value-of select="EMR06.01.01.144" />，
                                <xsl:if test="string-length(ZLG06.01.01.029/EMR06.01.01.145) &gt; 0">
                                    <xsl:value-of select="ZLG06.01.01.029/EMR06.01.01.145" />。
                                </xsl:if>
                                <xsl:if test="string-length(ZLG06.01.01.029/EMR06.01.01.145) = 0">
                                    <xsl:if test="string(ZLG06.01.01.029/ZLE06.01.01.106) = 'true'">
                                        是。
                                    </xsl:if>
                                    <xsl:if test="string(ZLG06.01.01.029/ZLE06.01.01.106) = 'false'">
                                        否。
                                    </xsl:if>                                    
                                </xsl:if>
                            </xsl:if>                   
                        </xsl:for-each>
                    </xsl:if>
                </td>
            </tr>
            <tr>
                <td class="alignleft" style="text-indent:21pt">
                    <xsl:for-each select="ZLG06.01.01.017">
                        <xsl:for-each select="ZLG06.01.01.024">
                            <xsl:value-of select="EMR06.01.01.093" />，
                            <xsl:value-of select="../EMR06.01.01.091" />，
                            <xsl:value-of select="EMR06.01.01.096" />，
                            <xsl:value-of select="EMR06.01.01.097" />                            
                        </xsl:for-each>
                    </xsl:for-each>
                </td>
            </tr>
            <tr>
                <td class="alginleft" style="text-indent:21pt">
                    <span class="fontbold">
                        <xsl:value-of select="ZLG06.01.01.019/EMR06.01.01.132" />：                     
                    </span>
                   <xsl:for-each select="ZLG06.01.01.019/ZLG06.01.01.026">
                        <xsl:value-of select="EMR06.01.01.133" />：
                        <xsl:for-each select="ZLG06.01.01.026">
                            <xsl:value-of select="EMR06.01.01.134" />
                            <xsl:value-of select="EMR06.01.01.135" />。                              
                        </xsl:for-each>                        
                    </xsl:for-each>
                </td>
            </tr>
            <tr>
                <td class="alignright">
                    护士：
                    <xsl:for-each select="../ZLG06.01.01.005[ZLE06.01.01.093 = $currNurseDate]">
                        <xsl:value-of select="EMR06.01.01.031"/>
                    </xsl:for-each>
                </td>
            </tr>
        </table>
        </xsl:if>
        <xsl:if test="$currOrgDept = $preOrgDept">
        <table cellpadding="3" cellspacing="0" class="nnrtable">
            <tr>
                <td class="alignleft">
                    <xsl:value-of select="translate(substring($currNurseDate,1,16),'T',' ')" />
                </td>
            </tr>
            <tr>
                <td class="alignleft" style="text-indent:21pt">
                    体温：
                    <xsl:for-each select="ZLG06.01.01.015/ZLG06.01.01.020[ZLE06.01.01.098='015']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="ZLG06.01.01.028/EMR06.01.01.065" />
                        </xsl:if>
                    </xsl:for-each>
                    ℃
                    &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                    脉搏：
                    <xsl:for-each select="ZLG06.01.01.015/ZLG06.01.01.020[ZLE06.01.01.098='033']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="ZLG06.01.01.028/EMR06.01.01.065" />
                        </xsl:if>
                    </xsl:for-each>
                    次/分
                    &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                    呼吸：
                    <xsl:for-each select="ZLG06.01.01.015/ZLG06.01.01.020[ZLE06.01.01.098='037']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="ZLG06.01.01.028/EMR06.01.01.065" />
                        </xsl:if>
                    </xsl:for-each>
                    次/分
                    &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                    血压：
                    <xsl:for-each select="ZLG06.01.01.015/ZLG06.01.01.020[ZLE06.01.01.098='007']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="ZLG06.01.01.028/EMR06.01.01.065" />
                        </xsl:if>
                    </xsl:for-each>/
                    <xsl:for-each select="ZLG06.01.01.015/ZLG06.01.01.020[ZLE06.01.01.098='008']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="ZLG06.01.01.028/EMR06.01.01.065" />
                        </xsl:if>
                    </xsl:for-each>
                    mmHg
                    </td>
            </tr>
            <tr>
                <td class="alignleft" style="text-indent:21pt">
                    <xsl:value-of select="../ZLG06.01.01.006/EMR06.01.01.048" />
                    <xsl:value-of select="../ZLG06.01.01.006/EMR06.01.01.049" />
                </td>
            </tr>
            <!--皮肤检查描述-->
            <tr>
                <td class="alignleft" style="text-indent:21pt">
                    <xsl:if test="string-length(ZLG06.01.01.016/EMR06.01.01.141) &gt; 0">
                        <xsl:value-of select="ZLG06.01.01.016/EMR06.01.01.141" />   
                    </xsl:if>
                    <xsl:if test="string-length(ZLG06.01.01.016/EMR06.01.01.143) &gt; 0">
                        ，
                        <xsl:value-of select="ZLG06.01.01.016/EMR06.01.01.143" />
                    </xsl:if>
                    <xsl:if test="ZLG06.01.01.016/ZLG06.01.01.022">     
                        <xsl:for-each select="ZLG06.01.01.016/ZLG06.01.01.022">
                            <xsl:if test="position() = 1">
                                ，
                            </xsl:if>
                            <xsl:if test="position() != last()">
                                <xsl:value-of select="EMR06.01.01.144" />
                                <xsl:if test="string-length(ZLG06.01.01.029/EMR06.01.01.145) &gt; 0">
                                    ，<xsl:value-of select="ZLG06.01.01.029/EMR06.01.01.145" />，
                                </xsl:if>
                                <xsl:if test="string-length(ZLG06.01.01.029/EMR06.01.01.145) = 0">
                                    <xsl:if test="string(ZLG06.01.01.029/ZLE06.01.01.106) = 'true'">
                                        是，
                                    </xsl:if>
                                    <xsl:if test="string(ZLG06.01.01.029/ZLE06.01.01.106) = 'false'">
                                        否，
                                    </xsl:if>                                    
                                </xsl:if>
                            </xsl:if>  
                            <xsl:if test="position() = last()">
                                <xsl:value-of select="EMR06.01.01.144" />，
                                <xsl:if test="string-length(ZLG06.01.01.029/EMR06.01.01.145) &gt; 0">
                                    <xsl:value-of select="ZLG06.01.01.029/EMR06.01.01.145" />。
                                </xsl:if>
                                <xsl:if test="string-length(ZLG06.01.01.029/EMR06.01.01.145) = 0">
                                    <xsl:if test="string(ZLG06.01.01.029/ZLE06.01.01.106) = 'true'">
                                        是。
                                    </xsl:if>
                                    <xsl:if test="string(ZLG06.01.01.029/ZLE06.01.01.106) = 'false'">
                                        否。
                                    </xsl:if>                                    
                                </xsl:if>
                            </xsl:if>                   
                        </xsl:for-each>
                    </xsl:if>
                </td>
            </tr>
            <tr>
                <td class="alignleft" style="text-indent:21pt">
                    <xsl:for-each select="ZLG06.01.01.017">
                        <xsl:for-each select="ZLG06.01.01.024">
                            <xsl:value-of select="EMR06.01.01.093" />，
                            <xsl:value-of select="../EMR06.01.01.091" />，
                            <xsl:value-of select="EMR06.01.01.096" />，
                            <xsl:value-of select="EMR06.01.01.097" />                            
                        </xsl:for-each>
                    </xsl:for-each>
                </td>
            </tr>
            <tr>
                <td class="alginleft" style="text-indent:21pt">
                    <span class="fontbold">
                        <xsl:value-of select="ZLG06.01.01.019/EMR06.01.01.132" />：                     
                    </span>
                   <xsl:for-each select="ZLG06.01.01.019/ZLG06.01.01.025">
                        <xsl:value-of select="EMR06.01.01.133" />：
                        <xsl:for-each select="ZLG06.01.01.026">
                            <xsl:value-of select="EMR06.01.01.134" />
                            <xsl:value-of select="EMR06.01.01.135" />。                              
                        </xsl:for-each>                        
                    </xsl:for-each>
                </td>
            </tr>
            <tr>
                <td class="alignright">
                    护士：
                    <xsl:for-each select="../ZLG06.01.01.005[ZLE06.01.01.093 = $currNurseDate]">
                        <xsl:value-of select="EMR06.01.01.031"/>
                    </xsl:for-each>
                </td>
            </tr>
        </table>
        </xsl:if>
        </xsl:for-each>
    </div>
    </body>
</html>
</xsl:template>

</xsl:stylesheet><!-- Stylus Studio meta-information - (c) 2004-2009. Progress Software Corporation. 保留所有权力.

<metaInformation>
	<scenarios>
		<scenario default="yes" name="场景1" userelativepaths="yes" externalpreview="no" url="..\最终版\xml\一般护理记录0106.xml" htmlbaseurl="" outputurl="" processortype="saxon8" useresolver="yes" profilemode="0" profiledepth="" profilelength="" urlprofilexml=""
		          commandline="" additionalpath="" additionalclasspath="" postprocessortype="none" postprocesscommandline="" postprocessadditionalpath="" postprocessgeneratedext="" validateoutput="no" validator="internal" customvalidator="">
			<advancedProp name="sInitialMode" value=""/>
			<advancedProp name="bXsltOneIsOkay" value="true"/>
			<advancedProp name="bSchemaAware" value="true"/>
			<advancedProp name="bXml11" value="false"/>
			<advancedProp name="iValidation" value="0"/>
			<advancedProp name="bExtensions" value="true"/>
			<advancedProp name="iWhitespace" value="0"/>
			<advancedProp name="sInitialTemplate" value=""/>
			<advancedProp name="bTinyTree" value="true"/>
			<advancedProp name="bWarnings" value="true"/>
			<advancedProp name="bUseDTD" value="false"/>
			<advancedProp name="iErrorHandling" value="fatal"/>
		</scenario>
	</scenarios>
	<MapperMetaTag>
		<MapperInfo srcSchemaPathIsRelative="yes" srcSchemaInterpretAsXML="no" destSchemaPath="" destSchemaRoot="" destSchemaPathIsRelative="yes" destSchemaInterpretAsXML="no">
			<SourceSchema srcSchemaPath="..\最终版\xml\一般护理记录.xml" srcSchemaRoot="EMR06.01.01" AssociatedInstance="" loaderFunction="document" loaderFunctionUsesURI="no"/>
		</MapperInfo>
		<MapperBlockPosition>
			<template match="/">
				<block path="html/body/div/table[2]/tr/td[3]/xsl:for-each" x="46" y="49"/>
				<block path="html/body/div/table[2]/tr/td[3]/xsl:for-each/xsl:if" x="116" y="79"/>
				<block path="html/body/div/xsl:for-each" x="246" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if/!=[0]" x="150" y="77"/>
				<block path="html/body/div/xsl:for-each/xsl:if" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr/td/xsl:value-of" x="196" y="39"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr/td[1]/xsl:for-each" x="136" y="19"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr/td[1]/xsl:for-each/xsl:if" x="246" y="89"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr/td[1]/xsl:for-each/xsl:if/xsl:value-of" x="196" y="119"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[0]" x="150" y="113"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[0]/string[0]" x="104" y="107"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[2]" x="150" y="149"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[2]/string[0]" x="104" y="143"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[4]" x="150" y="165"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[4]/string[0]" x="104" y="159"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr/td[2]/xsl:value-of" x="156" y="119"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr/td/xsl:value-of" x="116" y="119"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr/td/xsl:value-of/substring[0]" x="70" y="113"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[1]/td/xsl:for-each" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[1]/td/xsl:for-each/xsl:if" x="76" y="119"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[1]/td/xsl:for-each[1]" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[1]/td/xsl:for-each[1]/xsl:if" x="36" y="119"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[1]/td/xsl:for-each[2]" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[1]/td/xsl:for-each[2]/xsl:if" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[1]/td/xsl:for-each[3]" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[1]/td/xsl:for-each[3]/xsl:if" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[1]/td/xsl:for-each[4]" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[1]/td/xsl:for-each[4]/xsl:if" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[2]/td/xsl:value-of" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[2]/td/xsl:value-of[1]" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if/&gt;[0]" x="150" y="77"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if/&gt;[0]/string-length[0]" x="104" y="71"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[1]/&gt;[0]" x="120" y="47"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[1]/&gt;[0]/string-length[0]" x="74" y="41"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[1]" x="166" y="49"/>
				<block path="" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]" x="186" y="0"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each" x="96" y="19"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if/&gt;[0]" x="120" y="47"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if/&gt;[0]/string-length[0]" x="74" y="41"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]/=[0]" x="90" y="17"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]/=[0]/string-length[0]" x="44" y="11"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]" x="136" y="19"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]/xsl:if/=[0]" x="120" y="47"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]/xsl:if/=[0]/string[0]" x="74" y="41"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]/xsl:if" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]/xsl:if[1]/=[0]" x="120" y="47"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]/xsl:if[1]/=[0]/string[0]" x="74" y="41"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]/xsl:if[1]" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if/&gt;[0]" x="150" y="77"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if/&gt;[0]/string-length[0]" x="104" y="71"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]/=[0]" x="90" y="17"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]/=[0]/string-length[0]" x="44" y="11"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]" x="136" y="19"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]/xsl:if/=[0]" x="120" y="47"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]/xsl:if/=[0]/string[0]" x="74" y="41"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]/xsl:if" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]/xsl:if[1]/=[0]" x="120" y="47"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]/xsl:if[1]/=[0]/string[0]" x="74" y="41"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]/xsl:if[1]" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[4]/td/xsl:for-each" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[4]/td/xsl:for-each/xsl:for-each" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[5]/td/xsl:for-each" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[5]/td/xsl:for-each/xsl:value-of" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[5]/td/xsl:for-each/xsl:for-each" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[5]/td/xsl:for-each/xsl:for-each/xsl:value-of" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[5]/td/xsl:for-each/xsl:for-each/xsl:value-of[1]" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[6]/td/xsl:for-each" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/tr[6]/td/xsl:for-each/xsl:value-of" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/=[0]" x="110" y="77"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]" x="156" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr/td/xsl:value-of" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr/td/xsl:value-of/substring[0]" x="150" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[1]/td/xsl:for-each" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[1]/td/xsl:for-each/xsl:if" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[1]/td/xsl:for-each[1]" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[1]/td/xsl:for-each[1]/xsl:if" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[1]/td/xsl:for-each[2]" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[1]/td/xsl:for-each[2]/xsl:if" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[1]/td/xsl:for-each[3]" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[1]/td/xsl:for-each[3]/xsl:if" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[1]/td/xsl:for-each[4]" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[1]/td/xsl:for-each[4]/xsl:if" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[2]/td/xsl:value-of" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[2]/td/xsl:value-of[1]" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if/&gt;[0]" x="150" y="77"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if/&gt;[0]/string-length[0]" x="104" y="71"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[1]/&gt;[0]" x="120" y="47"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[1]/&gt;[0]/string-length[0]" x="74" y="41"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[1]" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]" x="226" y="0"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each" x="136" y="19"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if/&gt;[0]" x="120" y="47"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if/&gt;[0]/string-length[0]" x="74" y="41"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]/=[0]" x="90" y="17"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]/=[0]/string-length[0]" x="44" y="11"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]" x="136" y="19"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]/xsl:if/=[0]" x="120" y="47"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]/xsl:if/=[0]/string[0]" x="74" y="41"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]/xsl:if" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]/xsl:if[1]/=[0]" x="120" y="47"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]/xsl:if[1]/=[0]/string[0]" x="74" y="41"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[1]/xsl:if[1]/xsl:if[1]" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if/&gt;[0]" x="150" y="77"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if/&gt;[0]/string-length[0]" x="104" y="71"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]/=[0]" x="90" y="17"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]/=[0]/string-length[0]" x="44" y="11"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]" x="136" y="19"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]/xsl:if/=[0]" x="120" y="47"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]/xsl:if/=[0]/string[0]" x="74" y="41"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]/xsl:if" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]/xsl:if[1]/=[0]" x="120" y="47"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]/xsl:if[1]/=[0]/string[0]" x="74" y="41"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[3]/td/xsl:if[2]/xsl:for-each/xsl:if[2]/xsl:if[1]/xsl:if[1]" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[4]/td/xsl:for-each" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[4]/td/xsl:for-each/xsl:for-each" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[5]/td/xsl:for-each" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[5]/td/xsl:for-each/xsl:value-of" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[5]/td/xsl:for-each/xsl:for-each" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[5]/td/xsl:for-each/xsl:for-each/xsl:value-of" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[5]/td/xsl:for-each/xsl:for-each/xsl:value-of[1]" x="196" y="79"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[6]/td/xsl:for-each" x="166" y="49"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/table/tr[6]/td/xsl:for-each/xsl:value-of" x="196" y="79"/>
			</template>
		</MapperBlockPosition>
		<TemplateContext></TemplateContext>
		<MapperFilter side="source"></MapperFilter>
	</MapperMetaTag>
</metaInformation>
-->