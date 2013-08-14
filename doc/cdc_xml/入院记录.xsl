<?xml version='1.0'?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="UTF-8" />
<xsl:template name="getbr">
    <xsl:param name="string" />
    <xsl:choose>
        <xsl:when test="contains($string,'&#xA;')">
			<xsl:value-of select="substring-before($string,'&#xA;')" />
            <br/>
            <xsl:call-template name="getbr">
            <xsl:with-param name="string" select="substring-after($string,'&#xA;')" />
            </xsl:call-template>
        </xsl:when>
        <xsl:otherwise>
            <xsl:value-of select="$string" />
        </xsl:otherwise>
    </xsl:choose>
</xsl:template>
<xsl:template match="/">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>入院记录</title>
    <link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/common.css" />
    <link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/admission.css" />    
</head>
<body>
    <div id="admission">
        <table cellpadding="3" cellspacing="0" class="admistable">
            <tr>
                <td class="admistitle">
                <xsl:value-of select="EMR09.00.01/ZLG09.00.01.001/EMR09.00.01.001" />
                </td>
            </tr>
        </table>
        <!--空白行-->
        <table cellpadding="0" cellspacing="0" class="admistable">
            <tr>
                <td>
                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                </td>
            </tr>
        </table>
        <!--病人信息-->
        <table cellpadding="3" cellspacing="0" class="admistable">
            <tr>
                <td class="alignleft">
                    <span class="fontbold">姓名：</span>
                    <xsl:value-of select="EMR09.00.01/ZLG09.00.01.002/EMR09.00.01.018" />
                </td>
                <td class="alignleft">
                    <span class="fontbold">性别：</span>
                    <xsl:value-of select="EMR09.00.01/ZLG09.00.01.003/EMR09.00.01.021" />
                </td>
                <td class="alignleft">
                    <span class="fontbold">年龄：</span>
                    <xsl:value-of select="EMR09.00.01/ZLG09.00.01.003/EMR09.00.01.022" />
                </td>
                <td class="alignleft">
                    <span class="fontbold">住院号：</span>
                    <!--<xsl:for-each select="EMR09.00.01/ZLG09.00.01.002/id_item[id_type_code = 14]">-->
                    <xsl:for-each select="EMR09.00.01/ZLG09.00.01.002/ZLG09.00.01.008[EMR09.00.01.011= '住院病案']">
                        <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR09.00.01.012" />
                        </xsl:if>
                    </xsl:for-each>
                </td>
            </tr>
            <tr>
                <td colspan="4"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
            </tr>
            <tr>
                <td colspan="2" class="alignleft">
                    <span class="fontbold">住院机构：</span>
                    <xsl:value-of select="EMR09.00.01/ZLG09.00.01.005/EMR09.00.01.051" />
                </td>
                <td class="alignleft">
                    <span class="fontbold">住院日期：</span>
                    <xsl:for-each select="EMR09.00.01/ZLG09.00.01.002/ZLG09.00.01.008[EMR09.00.01.011='住院病案']">
                        <xsl:if test="position() = 1">
                        <xsl:value-of select="concat(substring(string(EMR09.00.01.013),1,4),'年', 
                                                    substring(string(EMR09.00.01.013),6,2),'月',
                                                    substring(string(EMR09.00.01.013),9,2),'日')
                                   " />
                        </xsl:if>
                    </xsl:for-each>     
                </td>
                <td class="alignleft">
                    <span class="fontbold">住院科别：</span>
                    <xsl:value-of select="EMR09.00.01/ZLG09.00.01.005/EMR09.00.01.055" />
                </td>                    
            </tr>
        </table>
        <table cellpadding="3" cellspacing="0" class="admistable">
            <tr>
                <td><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
            </tr>            
        </table>
        <div style="width:700px; margin:0 auto;font-size:10.5pt;text-align:left; line-height:150%;">            
            <xsl:variable name="SpaceText" select="translate(EMR09.00.01/ZLG09.00.01.017/ZLE09.00.01.001,' ','&#160;')" />
            <xsl:call-template name="getbr">
                <xsl:with-param name="string" select="$SpaceText" />
            </xsl:call-template>
        </div>
        <table cellpadding="3" cellspacing="0" class="admistable">
            <tr>
                <td class="alignright">
                医生：
                <xsl:for-each select="EMR09.00.01/ZLG09.00.01.007[EMR09.00.01.063 = '05']">
                    <xsl:value-of select="EMR09.00.01.061" />
                </xsl:for-each>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
</xsl:template>
</xsl:stylesheet><!-- Stylus Studio meta-information - (c) 2004-2009. Progress Software Corporation. 保留所有权力.

<metaInformation>
	<scenarios>
		<scenario default="yes" name="场景1" userelativepaths="yes" externalpreview="no" url="..\..\入院记录.xml" htmlbaseurl="" outputurl="" processortype="saxon8" useresolver="yes" profilemode="0" profiledepth="" profilelength="" urlprofilexml=""
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