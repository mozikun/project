<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="UTF-8" />
<xsl:template match="/">
<html xmlns="http://www.w3.org/1999/xhtml" charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <head>
        <title>手术记录</title>
      <link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/common.css" />
      <link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/surgeryrecord.css" />
    </head>
    <body>
    <div id="surgeryrecord">
    <table cellpadding="3" cellspacing="0" class="srtable">
        <tr>
            <td class="srtitle">
                <xsl:value-of select="EMR05.01.02/ZLG05.01.02.001/EMR05.01.02.001" />
            </td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" class="srtable">
        <tr>
            <td>&#160;</td>
        </tr>
    </table>
    <table cellpadding="3" cellspacing="0" class="srtable">
        <tr>
            <td class="alignleft" style="width:20%">
                <span class="fontbold">姓名：</span>
                <xsl:value-of select="EMR05.01.02/ZLG05.01.02.002/EMR05.01.02.013" />
            </td>
            <td class="alignleft" style="width:15%">
                <span class="fontbold">性别：</span>
                <xsl:value-of select="EMR05.01.02/ZLG05.01.02.003/EMR05.01.02.021" />
            </td>
            <td class="alignleft" style="width:30%">
                <span class="fontbold">年龄：</span>
                <xsl:value-of select="EMR05.01.02/ZLG05.01.02.003/EMR05.01.02.022" />
            </td>
            <td class="alignleft">
                <span class="fontbold">住院号：</span>
                <xsl:for-each select="EMR05.01.02/ZLG05.01.02.002/ZLG05.01.02.014[EMR05.01.02.014 = '住院病案']">
                    <xsl:value-of select="EMR05.01.02.015" />
                </xsl:for-each>
            </td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" class="srtable">
        <tr>
            <td>&#160;</td>
        </tr>
    </table>
    <table cellpadding="3" cellspacing="0" class="srtable">
        <tr>
            <td class="alignleft" style="width:35%">
                <span class="fontbold">住院机构：</span>
                <xsl:value-of select="EMR05.01.02/ZLG05.01.02.004/EMR05.01.02.041" />
            </td>
            <td class="alignleft" style="width:30%">
                <span class="fontbold">住院日期：</span>
                <xsl:for-each select="EMR05.01.02/ZLG05.01.02.002/ZLG05.01.02.014[EMR05.01.02.014='住院病案']">
                    <xsl:value-of select="concat(substring(string(EMR05.01.02.016),1,4),'年',
                                                substring(string(EMR05.01.02.016),6,2),'月',
                                                substring(string(EMR05.01.02.016),9,2),'日')
                                            " />
                </xsl:for-each>
            </td>
            <td class="alignleft">
                <span class="fontbold">住院科别：</span>
                <xsl:value-of select="EMR05.01.02/ZLG05.01.02.004/EMR05.01.02.045" />
            </td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" class="srtable">
        <tr>
            <td>&#160;</td>
        </tr>
    </table>
    <table cellpadding="3" cellspacing="0" class="srtable">
        <tr>
            <td class="alignleft" style="text-indent:22pt">
            <span class="fontbold">手术时间：</span>
            <xsl:for-each select="EMR05.01.02/ZLG05.01.02.008">
            <xsl:sort select="opt_date" />
                <xsl:if test="position() = 1">
                    <xsl:value-of select="translate(substring(string(EMR05.01.02.159),1,16),'T',' ')" />
                </xsl:if>
            </xsl:for-each>
            </td>
        </tr>
        <tr>
            <td class="alignleft">
            <span class="fontbold">诊断信息：</span>
            </td>
        </tr>
        <!--存在术前诊断数据-->
        <xsl:if test="count(EMR05.01.02/ZLG05.01.02.007[EMR05.01.02.074 = '4']) &gt; 0">
        
        <xsl:for-each select="EMR05.01.02/ZLG05.01.02.007[EMR05.01.02.074 = '4']">
            <xsl:if test="position() = 1">
                <xsl:for-each select="ZLG05.01.02.019">
                    <xsl:if test="position() = 1">
        <tr>
            <td class="alignleft" style="text-indent:22pt">
                <span class="fontbold">术前诊断：</span>
                <xsl:value-of select="substring(string(EMR05.01.02.075),2,1)" />&#160;<xsl:value-of select="EMR05.01.02.076" />
            </td>
        </tr>
                    </xsl:if>
                    <xsl:if test="position() &gt; 1">
        <tr>
            <td class="alignleft" style="text-indent:78pt">
                <xsl:value-of select="substring(string(EMR05.01.02.075),2,1)" />&#160;<xsl:value-of select="EMR05.01.02.076" />
            </td>
        </tr>                   
                    </xsl:if>
                </xsl:for-each>
            </xsl:if>
        </xsl:for-each>
        </xsl:if>
        <xsl:if test="count(EMR05.01.02/ZLG05.01.02.007[EMR05.01.02.074 = '4']) = 0">        
        <tr>
            <td class="alignleft" style="text-indent:22pt">
                <span class="fontbold">术前诊断：</span>
            </td>
        </tr>
        </xsl:if>
        <xsl:if test="count(EMR05.01.02/ZLG05.01.02.007[EMR05.01.02.074 = '5']) &gt; 0">
        
        <xsl:for-each select="EMR05.01.02/ZLG05.01.02.007[EMR05.01.02.074 = '5']">
            <xsl:if test="position() = 1">
                <xsl:for-each select="ZLG05.01.02.019">
                    <xsl:if test="position() = 1">
        <tr>
            <td class="alignleft" style="text-indent:22pt">
                <span class="fontbold">术后诊断：</span>
                <xsl:value-of select="substring(string(EMR05.01.02.075),2,1)" />&#160;<xsl:value-of select="EMR05.01.02.076" />
            </td>
        </tr>
                    </xsl:if>
                    <xsl:if test="position() &gt; 1">
        <tr>
            <td class="alignleft" style="text-indent:78pt">
                <xsl:value-of select="substring(string(EMR05.01.02.075),2,1)" />&#160;<xsl:value-of select="EMR05.01.02.076" />
            </td>
        </tr>
                    </xsl:if>
                </xsl:for-each>
            </xsl:if>
        </xsl:for-each>
        </xsl:if>
        <xsl:if test="count(EMR05.01.02/ZLG05.01.02.007[EMR05.01.02.074 = '5']) = 0">        
        <tr>
            <td class="alignleft" style="text-indent:22pt">
                <span class="fontbold">术后诊断：</span>
            </td>
        </tr>
        </xsl:if>
        <!--手术名称-->
        <xsl:for-each select="EMR05.01.02/ZLG05.01.02.008">
        <xsl:if test="position() = 1">
        <tr>
            <td class="alignleft" style="text-indent:22pt">
                <span class="fontbold">操作/手术名称：</span>
                <xsl:value-of select="position()"/>&#160;<xsl:value-of select="EMR05.01.02.151" />
            </td>
        </tr>
        </xsl:if>
        
        <xsl:if test="position() &gt; 1">
        <tr>
            <td class="alignleft" style="text-indent:106.5pt">               
                <xsl:value-of select="position()"/>&#160;<xsl:value-of select="EMR05.01.02.151" />
            </td>
        </tr>
        </xsl:if>
        </xsl:for-each>
        
        <xsl:if test="EMR05.01.02/ZLG05.01.02.009/ZLE05.01.02.161">
        <tr>
            <td class="alignleft" style="text-indent:22pt">
            <span class="fontbold">手术观察记录：</span>
               <!--<table cellpadding="0" cellspacing="0" style="width:100%;font-size:10.5pt; line-height:18px;">
                <tr>
                    <td valign="top" class="alignleft" style="text-indent:22pt; width:20%">
                    <span class="fontbold">手术观察记录：</span>
                    </td>
                    <td class="alignleft">                    
                    <xsl:value-of select="EMR05.01.02/ZLG05.01.02.009/ZLE05.01.02.161" />
                    </td>
                </tr>
               </table>    -->            
            </td>
        </tr>
        <tr>
            <td class="alignleft" style="text-indent:22pt">
            <xsl:value-of select="EMR05.01.02/ZLG05.01.02.009/ZLE05.01.02.161" />
            </td>
        </tr>
        </xsl:if>
        <xsl:if test="not(EMR05.01.02/ZLG05.01.02.009/ZLE05.01.02.161)">
        <tr>
            <td class="alignleft" style="text-indent:22pt">
               <span class="fontbold">手术观察记录：</span>               
            </td>
        </tr>
        <xsl:for-each select="EMR05.01.02/ZLG05.01.02.022/ZLG05.01.02.009">
        <tr>
            <td class="alignleft" style="text-indent:22pt">
                <xsl:value-of select="EMR05.01.02.101" />：
                <xsl:value-of select="concat(ZLG05.01.02.023/EMR05.01.02.102,
                                            ZLG05.01.02.023/ZLE05.01.02.162,
                                            translate(substring(string(ZLG05.01.02.023/ZLE05.01.02.163),1,16),'T',' '))" />
            </td>
        </tr>
        </xsl:for-each>
        </xsl:if>
        <!--有麻醉信息显示-->
        <xsl:if test="EMR05.01.02/ZLG05.01.02.010">        
        <tr>
            <td class="alignleft" style="text-indent:22pt">
                <span class="fontbold">麻醉信息：</span>
            </td>
        </tr>
        <xsl:for-each select="EMR05.01.02/ZLG05.01.02.010/ZLG05.01.02.021">
        <tr>
            <td class="alignleft" style="text-indent:22pt">
                <xsl:value-of select="EMR05.01.02.101" />：
                <xsl:value-of select="EMR05.01.02.102" />
            </td>
        </tr>
        </xsl:for-each>
        </xsl:if>
        
        <xsl:if test="EMR05.01.02/ZLG05.01.02.013">
        <tr>
            <td class="alignleft" style="text-indent:22pt">
                <span class="fontbold">诊疗过程：</span>
            </td>
        </tr>
        <tr>
            <td class="alignleft" style="text-indent:22pt">
                <xsl:for-each select="EMR05.01.02/ZLG05.01.02.013">
                <xsl:value-of select="EMR05.01.02.141" />：
                <xsl:value-of select="EMR05.01.02.142" />。
                </xsl:for-each>
            </td>
        </tr>
        
        </xsl:if>
        <xsl:for-each select="EMR05.01.02/ZLG05.01.02.005">
        <xsl:sort select="servant_role_code" />
        <tr>
            <td class="alignright">
                <xsl:value-of select="EMR05.01.02.052" />：
                <xsl:value-of select="EMR05.01.02.051" />
            </td>
        </tr>
        </xsl:for-each>
    </table>
    </div>
    </body>
    </html>
</xsl:template>
</xsl:stylesheet><!-- Stylus Studio meta-information - (c) 2004-2009. Progress Software Corporation. 保留所有权力.

<metaInformation>
	<scenarios>
		<scenario default="yes" name="场景1" userelativepaths="yes" externalpreview="no" url="..\xml\手术记录.xml" htmlbaseurl="" outputurl="" processortype="saxon8" useresolver="yes" profilemode="0" profiledepth="" profilelength="" urlprofilexml=""
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
		<MapperInfo srcSchemaPathIsRelative="yes" srcSchemaInterpretAsXML="no" destSchemaPath="" destSchemaRoot="" destSchemaPathIsRelative="yes" destSchemaInterpretAsXML="no"/>
		<MapperBlockPosition></MapperBlockPosition>
		<TemplateContext></TemplateContext>
		<MapperFilter side="source"></MapperFilter>
	</MapperMetaTag>
</metaInformation>
-->