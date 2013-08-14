<?xml version='1.0' encoding='utf-8' ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" />
    <xsl:variable name="Rows">3</xsl:variable>
    <xsl:template match="/">
        <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>中医处方</title>
          <link rel="StyleSheet" type="text/css" href="/doc/cdc_xml/styles/tcmprescription.css" />
          <link rel="StyleSheet" type="text/css" href="/doc/cdc_xml/styles/common.css" />
        </head>
        <body>
        <div id="tcmprescription">
            <table cellpadding="3" cellspacing="0" class="tptable">
                <tr>
                    <td class="tptitle">
                        <xsl:value-of select="EMR03.00.02/ZLG03.00.02.001/EMR03.00.02.001" />
                    </td>
                </tr>
                <tr>
                    <td style="height: 15px;">
						<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                    </td>
                </tr>
            </table>
            <table cellpadding="3" cellspacing="0" class="tptable" >
                <tr>
                    <td style="width: 150px;" class="alignleft">
                        <span class="fontbold">
                        姓名： 
                        </span>
                        <xsl:value-of select="EMR03.00.02/ZLG03.00.02.002/EMR03.00.02.018" />                        
                    </td>
                    <td style="width: 150px;" class="alignleft">
                        <span class="fontbold">
                        性别： 
                        </span>
                        <xsl:value-of select="EMR03.00.02/ZLG03.00.02.003/EMR03.00.02.021" />                        
                    </td>
                    <td style="width: 150px;" class="alignleft">
                        <span class="fontbold">
                        年龄：
                        </span>                        
                        <xsl:value-of select="EMR03.00.02/ZLG03.00.02.003/EMR03.00.02.022" />                      
                    </td>
                    <td colspan="2" class="alignleft">
                        <span class="fontbold">门诊/住院号：</span>
                    </td>
                </tr>
                <tr>
                    <td class="alignleft">
                        <span class="fontbold">
                        科别： 
                        </span>
                        <xsl:value-of select="EMR03.00.02/ZLG03.00.02.009/EMR03.00.02.085" />                        
                    </td>
                    <td class="alignleft">
                        <span class="fontbold">
                        床号：
                        </span>
                    </td>
                    <td class="alignleft">
                        <span class="fontbold">费别：
                        </span>
                        <xsl:value-of select="EMR03.00.02/ZLG03.00.02.007/EMR03.00.02.075" />
                    </td>
                </tr>
                <tr style="height: 15px;">
					<td colspan="3">
						<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
					</td>
                </tr>
                <tr>
                    <td colspan="3" class="alignleft">
                        <span class="fontbold">诊断：</span>
                        <xsl:for-each select="EMR03.00.02/ZLG03.00.02.012">
						<xsl:sort select="EMR03.00.02.144"/>
						<xsl:if test="position() &lt; last()">
                            <xsl:for-each select="ZLG03.00.02.022">
								<xsl:sort select="EMR03.00.02.145"/>
                                <xsl:value-of select="EMR03.00.02.146" />，
                            </xsl:for-each>
                        </xsl:if>
                        <xsl:if test="position() = last()">
                            <xsl:for-each select="ZLG03.00.02.022">
								<xsl:sort select="EMR03.00.02.145"/>
                                <xsl:if test="position() = last()">
                                    <xsl:value-of select="EMR03.00.02.146" />
                                </xsl:if>
                                <xsl:if test="position() != last()">
                                    <xsl:value-of select="EMR03.00.02.146" />，
                                </xsl:if>
                            </xsl:for-each>
                        </xsl:if>
                    </xsl:for-each>
                    </td>
                </tr>
				<tr>
                    <td style="height: 15px;">
						<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                    </td>
                </tr>
            </table>
            <table cellpadding="3" cellspacing="0" class="tptable">                
                <tr>
                    <td>
                        <img align="middle" src="/doc/cdc_xml/styles/处方图标.png" alt="中医图标" />
                    </td>
                </tr>
                <tr>
					<td>
                    	<table align="center" style="width: 400px">
                        <tr>
                            <xsl:for-each select="EMR03.00.02/ZLG03.00.02.013/ZLG03.00.02.023">
                                <xsl:if test="position() mod 3=1">
                                    <!--<xsl:text disable-output-escaping="yes"><![CDATA[<br />]]></xsl:text>-->
                                    <xsl:text disable-output-escaping="yes"><![CDATA[</tr>
                        <tr>
                            ]]></xsl:text> </xsl:if>
                            <td>
                                <span style="font-size:14pt"><xsl:value-of select="EMR03.00.02.157" /></span>
                                <span style="font-size: 10.5pt">
                                    <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                                    <xsl:value-of select="EMR03.00.02.154" />
                                    <xsl:value-of select="EMR03.00.02.153" />
                                    <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                                    <xsl:value-of select="EMR03.00.02.151" /></span>
                            </td>
                            </xsl:for-each>
                        </tr>
                    </table>
					</td>
                </tr>
            </table><br/>
            <table cellpadding="3" cellspacing="0" class="tptable">
                <tr>
                    <td class="fontbold alignleft">
                        付数：
                    </td>
                    <td class="alignleft">
                        <xsl:value-of select="EMR03.00.02/ZLG03.00.02.013/ZLE03.00.02.009" />付
                        <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                        <xsl:value-of select="EMR03.00.02/ZLG03.00.02.013/EMR03.00.02.152" />
                        <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                        <xsl:value-of select="EMR03.00.02/ZLG03.00.02.013/EMR03.00.02.162" />
                        <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                        <xsl:value-of select="EMR03.00.02/ZLG03.00.02.013/EMR03.00.02.156" />
                    </td>
                </tr>
                <tr>
                    <xsl:if test="string-length(EMR03.00.02/ZLG03.00.02.014/EMR03.00.02.172)> 0">
                        <td style="width: 60px" class="fontbold alignleft">
                            说明：
                        </td>
                        <td class="alignleft">
                            <xsl:value-of select="EMR03.00.02/ZLG03.00.02.014/EMR03.00.02.172" />
                        </td>
                    </xsl:if>
                </tr>
            </table><br />
            <table cellpadding="3" cellspacing="0" class="tptable">
                <tr>
                    <td style="width: 350px; text-align: right;" class="style3">                       
                    </td>
                    <td class="alignleft">
						 <span style="font-weight:bold">医师：</span>
                        <xsl:for-each select="EMR03.00.02/ZLG03.00.02.010">
                            <xsl:if test="EMR03.00.02.092 = '处方医生'">
                                <xsl:value-of select="EMR03.00.02.091" />
                            </xsl:if>
                        </xsl:for-each>
                    </td>
                </tr>
                <tr>
                    <td class="style3" style="text-align: right;">
                        
                    </td>
                    <td class="alignleft">
                        <!--   <xsl:value-of select="translate(tcm_prescription/ZLG03.00.02.001/EMR03.00.02.006,'T',' ')"/>-->
						<span style="font-weight:bold">日期：</span>
                        <xsl:value-of select="substring-before(EMR03.00.02/ZLG03.00.02.001/EMR03.00.02.006, '-')" />年
                        <xsl:value-of select="substring-before(substring-after(EMR03.00.02/ZLG03.00.02.001/EMR03.00.02.006, '-'), '-')" />月
                        <xsl:value-of select="substring-before(substring-after(substring-after(EMR03.00.02/ZLG03.00.02.001/EMR03.00.02.006, '-'), '-'), 'T')" />日
                    </td>
                </tr>
            </table>
            <table cellpadding="3" cellspacing="0" class="tptable">
                <tr style="height: 10px;">
                    <td>
                    </td>
                </tr>
                <tr>
                    <td style="width: 200px" class="alignleft">
                    <span class="fontbold">审核：</span>
                    <span>
                        <xsl:for-each select="EMR03.00.02/ZLG03.00.02.010">
                            <xsl:if test="EMR03.00.02.092 = '处方审核者'">
                                <xsl:value-of select="EMR03.00.02.091" />
                            </xsl:if>
                        </xsl:for-each>
					</span>
                    </td>
                    <td style="width: 200px" class="style3">
                    <span class="fontbold">调配：</span>
                    <span>
                        <xsl:for-each select="EMR03.00.02/ZLG03.00.02.010">
                            <xsl:if test="EMR03.00.02.092 = '配药者'">
                                <xsl:value-of select="EMR03.00.02.091" />
                            </xsl:if>
                        </xsl:for-each>
                    </span>					
                    </td>
                    <td class="style3" style="text-align: left;">
                    <span class="fontbold">发药：</span>
                    <span>
                        <xsl:for-each select="EMR03.00.02/ZLG03.00.02.010">
                            <xsl:if test="EMR03.00.02.092 = '发药者'">
                                <xsl:value-of select="EMR03.00.02.091" />
                            </xsl:if>
                        </xsl:for-each>
                    </span>
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
		<scenario default="yes" name="场景1" userelativepaths="yes" externalpreview="no" url="..\..\xml\中医处方.xml" htmlbaseurl="" outputurl="" processortype="saxon8" useresolver="yes" profilemode="0" profiledepth="" profilelength="" urlprofilexml=""
		          commandline="" additionalpath="" additionalclasspath="" postprocessortype="none" postprocesscommandline="" postprocessadditionalpath="" postprocessgeneratedext="" validateoutput="yes" validator="internal" customvalidator="">
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
			<validatorSchema value="..\..\XSL\西医处方.xsd"/>
		</scenario>
	</scenarios>
	<MapperMetaTag>
		<MapperInfo srcSchemaPathIsRelative="yes" srcSchemaInterpretAsXML="no" destSchemaPath="" destSchemaRoot="" destSchemaPathIsRelative="yes" destSchemaInterpretAsXML="no">
			<SourceSchema srcSchemaPath="西医处方.xml" srcSchemaRoot="western_medicine_prescription" AssociatedInstance="" loaderFunction="document" loaderFunctionUsesURI="no"/>
		</MapperInfo>
		<MapperBlockPosition>
			<template match="/">
				<block path="html/body/div/table/tr[2]/td[1]/xsl:choose" x="220" y="111"/>
				<block path="html/body/div/table/tr[2]/td[1]/xsl:choose/=[0]" x="174" y="105"/>
				<block path="" x="130" y="101"/>
				<block path="html/body/div/table/tr[2]/td[1]/xsl:choose/=[1]" x="174" y="133"/>
				<block path="html/body/div/table/tr[2]/td[1]/xsl:choose/=[2]" x="174" y="141"/>
				<block path="html/body/div[1]/table/tr/td/xsl:for-each" x="170" y="101"/>
				<block path="html/body/div[1]/table/tr[1]/td/table/xsl:for-each" x="90" y="21"/>
				<block path="html/body/div[1]/table/tr[1]/td/table/xsl:for-each/tr/td[2]/xsl:choose" x="50" y="21"/>
				<block path="html/body/div[1]/table/tr[1]/td/table/xsl:for-each/tr/td[2]/xsl:choose/=[0]" x="4" y="15"/>
				<block path="html/body/div[2]/table/tr/td/xsl:for-each" x="220" y="71"/>
				<block path="html/body/div[2]/table/tr/td/xsl:for-each/xsl:if/=[0]" x="44" y="99"/>
				<block path="html/body/div[2]/table/tr/td/xsl:for-each/xsl:if" x="90" y="101"/>
				<block path="html/body/div[2]/table/tr[2]/td/xsl:for-each" x="140" y="31"/>
				<block path="html/body/div[2]/table/tr[2]/td/xsl:for-each/xsl:if/=[0]" x="4" y="99"/>
				<block path="html/body/div[2]/table/tr[2]/td/xsl:for-each/xsl:if" x="50" y="101"/>
				<block path="html/body/div[2]/table/tr[2]/td[1]/xsl:for-each" x="180" y="31"/>
				<block path="html/body/div[2]/table/tr[2]/td[1]/xsl:for-each/xsl:if/=[0]" x="44" y="59"/>
				<block path="html/body/div[2]/table/tr[2]/td[1]/xsl:for-each/xsl:if" x="90" y="61"/>
				<block path="html/body/div[2]/table/tr[2]/td[3]/xsl:for-each" x="220" y="31"/>
				<block path="html/body/div[2]/table/tr[2]/td[3]/xsl:for-each/xsl:if/=[0]" x="4" y="59"/>
				<block path="html/body/div[2]/table/tr[2]/td[3]/xsl:for-each/xsl:if" x="50" y="61"/>
			</template>
		</MapperBlockPosition>
		<TemplateContext></TemplateContext>
		<MapperFilter side="source"></MapperFilter>
	</MapperMetaTag>
</metaInformation>
-->