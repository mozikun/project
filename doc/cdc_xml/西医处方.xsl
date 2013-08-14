<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="UTF-8" />
<xsl:template match="/">
<html xmlns="http://www.w3.org/1999/xhtml" charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <head>
	    <title>西医处方</title>
      <link rel="StyleSheet" type="text/css" href="/doc/cdc_xml/styles/doctorsprescription.css" />
      <link rel="StyleSheet" type="text/css" href="/doc/cdc_xml/styles/common.css" />
	</head>
	<body>
    <div id="doctorsprescription">
	    <table cellpadding="3" cellspacing="0" class="dptable">
	        <tr>
	            <td class="aligncenter dptitle">
	                <xsl:value-of select="EMR03.00.01/ZLG03.00.01.001/EMR03.00.01.001" />
	            </td>
	        </tr>
	        <tr>
	            <td>
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
	    </table>
	    <table cellpadding="3" cellspacing="0" class="dptable">
	        <tr>
	            <td style="width: 150px;">
	                <span class="fontbold">姓名：</span>
					<xsl:value-of select="EMR03.00.01/ZLG03.00.01.002/EMR03.00.01.018" />
	            </td>
	            <td style="width: 120px">
	                <span class="fontbold">性别：</span>
					<xsl:value-of select="EMR03.00.01/ZLG03.00.01.003/EMR03.00.01.021" />
	            </td>
	            <td style="width: 120px;">
	                <span class="fontbold">年龄：</span>
					<xsl:value-of select="EMR03.00.01/ZLG03.00.01.003/EMR03.00.01.022" />
	            </td>
	            <td style="width: 210px">
	                <span class="fontbold">门诊/住院号：</span>
	            </td>
	        </tr>
	        <tr>
	            <td colspan="2">
	                <span class="fontbold">科别：</span>
					<xsl:value-of select="EMR03.00.01/ZLG03.00.01.008/EMR03.00.01.085" />
	            </td>
	            <td>
	                <span class="fontbold">床号：</span>
	            </td>
	            <td>
	                <span class="fontbold">费别：</span>
					<xsl:value-of select="EMR03.00.01/ZLG03.00.01.007/EMR03.00.01.075" />
	            </td>
	        </tr>
	        <tr>
	            <td colspan="4">
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
	        <tr>
	            <td colspan="4">
	                <span class="fontbold">诊断：</span>
                    <xsl:for-each select="EMR03.00.01/ZLG03.00.01.012">
						<xsl:sort select="EMR03.00.01.144"/>
						<xsl:if test="position() &lt; last()">
                            <xsl:for-each select="ZLG03.00.01.025">
								<xsl:sort select="EMR03.00.01.145"/>
                                <xsl:value-of select="EMR03.00.01.146" />，
                            </xsl:for-each>
                        </xsl:if>
                        <xsl:if test="position() = last()">
                            <xsl:for-each select="ZLG03.00.01.025">
								<xsl:sort select="EMR03.00.01.145"/>
                                <xsl:if test="position() = last()">
                                    <xsl:value-of select="EMR03.00.01.146" />
                                </xsl:if>
                                <xsl:if test="position() != last()">
                                    <xsl:value-of select="EMR03.00.01.146" />，
                                </xsl:if>
                            </xsl:for-each>
                        </xsl:if>
                    </xsl:for-each>
                    
	            </td>
	        </tr>
	        <tr>
	            <td colspan="4">
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
	    </table>
	    <table cellpadding="3" cellspacing="0" class="dptable">
	        <tr>
	            <td colspan="2">
	                <img src="/doc/cdc_xml/styles/处方图标.png" alt="处方图标" title="处方图标" />
	            </td>
	        </tr>
			<xsl:for-each select="EMR03.00.01/ZLG03.00.01.013/ZLG03.00.01.026">
            <!--当前序号-->
            <xsl:variable name="CurrPos" select="position()" />
            <!--上一条order_no-->
            <xsl:variable name="preOrderNO">
                <xsl:for-each select="../ZLG03.00.01.026[position() = $CurrPos - 1]">
                    <xsl:value-of select="ZLE03.00.01.006" />
                </xsl:for-each>
            </xsl:variable>
            <!--当前order_no-->
            <xsl:variable name="currOrderNO">
                <xsl:value-of select="ZLE03.00.01.006" />
            </xsl:variable>
            <!--下一条order_no-->
            <xsl:variable name="NextOrderNO">
                <xsl:for-each select="../ZLG03.00.01.026[position() = $CurrPos + 1]">
                    <xsl:value-of select="ZLE03.00.01.006" />
                </xsl:for-each>
            </xsl:variable>
            <xsl:if test="$CurrPos = 1">
                <xsl:if test="$NextOrderNO = $currOrderNO">
            <tr>
	            <td width="45px">
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	            <td width="380px">
	                <xsl:value-of select="EMR03.00.01.157" />
					<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
					<xsl:value-of select="ZLE03.00.01.008" />
					×
					<xsl:value-of select="EMR03.00.01.155" />
					<xsl:if test="string-length(string(ZLE03.00.01.009)) &gt; 0">
                        <xsl:value-of select="ZLE03.00.01.009" />
                    </xsl:if>
                    <xsl:if test="string-length(string(ZLE03.00.01.009))=0">
                        <xsl:value-of select="EMR03.00.01.153" />
                    </xsl:if>
                    <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                    <xsl:value-of select="EMR03.00.01.154" />
                    <xsl:value-of select="EMR03.00.01.153" />
	            </td>
                <td class="alignleft">
                    ┓
                </td>
	        </tr>
                </xsl:if>
                <xsl:if test="$NextOrderNO != $currOrderNO">
            <tr>
                <td width="45px"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                </td>
                <td colspan="2">
                    <xsl:value-of select="EMR03.00.01.157" /><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                    <xsl:value-of select="ZLE03.00.01.008" />×                    
                    <xsl:value-of select="EMR03.00.01.155" />
					<xsl:if test="string-length(string(ZLE03.00.01.009)) &gt; 0">
                        <xsl:value-of select="ZLE03.00.01.009" />
                    </xsl:if>
                    <xsl:if test="string-length(string(ZLE03.00.01.009))=0">
                        <xsl:value-of select="EMR03.00.01.153" />
                    </xsl:if>
                </td>
            </tr>
            <tr>
                <td width="45px"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                </td>
                <td class="alignleft" colspan="2" style="text-indent:21pt">
                    用法：
					<xsl:value-of select="EMR03.00.01.154" />
					<xsl:value-of select="EMR03.00.01.153" />
					<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
					<xsl:value-of select="EMR03.00.01.152" /><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
					<xsl:value-of select="EMR03.00.01.156" />
                </td>
            </tr>
                </xsl:if>
            </xsl:if>
            <xsl:if test="$CurrPos &gt; 1">
                <xsl:if test="$currOrderNO = $preOrderNO">
                    <xsl:if test="$currOrderNO = $NextOrderNO">
            <tr>
	            <td width="45px">
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	            <td width="380px">
	                <xsl:value-of select="EMR03.00.01.157" />
					<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
					<xsl:value-of select="ZLE03.00.01.008" />
					×
					<xsl:value-of select="EMR03.00.01.155" />
					<xsl:if test="string-length(string(ZLE03.00.01.009)) &gt; 0">
                        <xsl:value-of select="ZLE03.00.01.009" />
                    </xsl:if>
                    <xsl:if test="string-length(string(ZLE03.00.01.009))=0">
                        <xsl:value-of select="EMR03.00.01.153" />
                    </xsl:if>
                    <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                    <xsl:value-of select="EMR03.00.01.154" />
                    <xsl:value-of select="EMR03.00.01.153" />
	            </td>
                <td class="alignleft">
                    ┃
                </td>
	        </tr>
                    </xsl:if>
                    <xsl:if test="$currOrderNO != $NextOrderNO">
            <tr>
	            <td width="45px">
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	            <td width="380px">
	                <xsl:value-of select="EMR03.00.01.157" />
					<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
					<xsl:value-of select="ZLE03.00.01.008" />
					×
					<xsl:value-of select="EMR03.00.01.155" />
					<xsl:if test="string-length(string(ZLE03.00.01.009)) &gt; 0">
                        <xsl:value-of select="ZLE03.00.01.009" />
                    </xsl:if>
                    <xsl:if test="string-length(string(ZLE03.00.01.009))=0">
                        <xsl:value-of select="EMR03.00.01.153" />
                    </xsl:if>
                    <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                    <xsl:value-of select="EMR03.00.01.154" />
                    <xsl:value-of select="EMR03.00.01.153" />
	            </td>
                <td class="alignleft">
                    ┛
                </td>
	        </tr>
            <tr>
                <td width="45px"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                </td>
                <td colspan="2" class="alignleft" style="text-indent:21pt">
                    用法：<xsl:value-of select="EMR03.00.01.152" /><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                        <xsl:value-of select="EMR03.00.01.156" />
                </td>
            </tr>
                    </xsl:if>
                </xsl:if>
                <xsl:if test="$currOrderNO != $preOrderNO">
                    <xsl:if test="$currOrderNO = $NextOrderNO">
           <tr>
	            <td width="45px">
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	            <td width="380px">
	                <xsl:value-of select="EMR03.00.01.157" />
					<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
					<xsl:value-of select="ZLE03.00.01.008" />
					×
					<xsl:value-of select="EMR03.00.01.155" />
					<xsl:if test="string-length(string(ZLE03.00.01.009)) &gt; 0">
                        <xsl:value-of select="ZLE03.00.01.009" />
                    </xsl:if>
                    <xsl:if test="string-length(string(ZLE03.00.01.009))=0">
                        <xsl:value-of select="EMR03.00.01.153" />
                    </xsl:if>
                    <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                    <xsl:value-of select="EMR03.00.01.154" />
                    <xsl:value-of select="EMR03.00.01.153" />
	            </td>
                <td class="alignleft">
                    ┓
                </td>
	        </tr>
                    </xsl:if>
                    <xsl:if test="$currOrderNO != $NextOrderNO">
            <tr>
                <td width="45px"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                </td>
                <td colspan="2">
                    <xsl:value-of select="EMR03.00.01.157" /><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                    <xsl:value-of select="ZLE03.00.01.008" />×                    
                    <xsl:value-of select="EMR03.00.01.155" />
                    <xsl:if test="string-length(string(ZLE03.00.01.009)) &gt; 0">
                        <xsl:value-of select="ZLE03.00.01.009" />
                    </xsl:if>
                    <xsl:if test="string-length(string(ZLE03.00.01.009))=0">
                        <xsl:value-of select="EMR03.00.01.153" />
                    </xsl:if>
                </td>
            </tr>
            <tr>
                <td width="45px"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                </td>
                <td class="alignleft" colspan="2" style="text-indent:21pt">
                    用法：
					<xsl:value-of select="EMR03.00.01.154" />
					<xsl:value-of select="EMR03.00.01.153" />
					<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
					<xsl:value-of select="EMR03.00.01.152" /><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
					<xsl:value-of select="EMR03.00.01.156" />
                </td>
            </tr>
                    </xsl:if>
                </xsl:if>
            </xsl:if>
			</xsl:for-each>
	        <tr>
	            <td colspan="2">
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
			<xsl:choose>
			<xsl:when  test="normalize-space(EMR03.00.01/ZLG03.00.01.014/EMR03.00.01.172)!=''">			
	        <tr>
	            <td colspan="2">
	                <span class="fontbold">说明：</span>
					<xsl:value-of select="EMR03.00.01/ZLG03.00.01.014/EMR03.00.01.172" />
	            </td>
	        </tr>
			</xsl:when>
			</xsl:choose>
	        <tr>
	            <td colspan="2">
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
	    </table>
	    <table cellpadding="3" cellspacing="0" class="dptable">
	        <tr>
	            <td width="350px">
	            </td>
	            <td>
	                <span class="fontbold">医师：</span>
					<xsl:for-each select="EMR03.00.01/ZLG03.00.01.009[EMR03.00.01.092='处方医生']">
                    <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR03.00.01.091" />
                    </xsl:if>
                    </xsl:for-each>
	            </td>
	        </tr>
	        <tr>
	            <td width="350px">
	            </td>
	            <td>
	                <span class="fontbold">日期：</span>
					<xsl:value-of select="substring-before(EMR03.00.01/ZLG03.00.01.001/EMR03.00.01.006, '-')" /> 年 
					<xsl:value-of select="substring-before(substring-after(EMR03.00.01/ZLG03.00.01.001/EMR03.00.01.006, '-'), '-')" /> 月
					<xsl:value-of select="substring-before(substring-after(substring-after(EMR03.00.01/ZLG03.00.01.001/EMR03.00.01.006, '-'), '-'), 'T')"/> 日
	            </td>
	        </tr>
	        <tr>
	            <td colspan="2">	                
					<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
	    </table>
	    <table cellpadding="3" cellspacing="0" class="dptable">
	        <tr>
	            <td width="200px">
	                <span class="fontbold">审核：</span>
					<xsl:for-each select="EMR03.00.01/ZLG03.00.01.009">
		                <xsl:if test="EMR03.00.01.092 = '处方审核者'">
		                  <xsl:value-of select="EMR03.00.01.091"/>
		                </xsl:if>
	              	</xsl:for-each>
	            </td>
	            <td width="200px">
	                <span class="fontbold">调配：</span>
					<xsl:for-each select="EMR03.00.01/ZLG03.00.01.009">
		                <xsl:if test="EMR03.00.01.092 = '配药者'">
		                  <xsl:value-of select="EMR03.00.01.091"/>
		                </xsl:if>
	              	</xsl:for-each>
	            </td>
	            <td>
	                <span class="fontbold">发药：</span>
					<xsl:for-each select="EMR03.00.01/ZLG03.00.01.009">
		                <xsl:if test="EMR03.00.01.092= '发药者'">
		                  <xsl:value-of select="EMR03.00.01.091"/>
		                </xsl:if>
	              	</xsl:for-each>
	            </td>
	        </tr>
	    </table>
    </div>
	</body>
	</html>
  </xsl:template>
</xsl:stylesheet>
<!-- Stylus Studio meta-information - (c) 2004-2009. Progress Software Corporation. 保留所有权力.

<metaInformation>
	<scenarios>
		<scenario default="yes" name="场景1" userelativepaths="yes" externalpreview="no" url="..\..\xml\西医处方4.xml" htmlbaseurl="" outputurl="" processortype="saxon8" useresolver="yes" profilemode="0" profiledepth="" profilelength="" urlprofilexml=""
		          commandline="" additionalpath="" additionalclasspath="" postprocessortype="custom" postprocesscommandline="fop 西医处方.xml -pdf 西医处方.pdf" postprocessadditionalpath="C:\Users\Administrator\Desktop\" postprocessgeneratedext=".pdf"
		          validateoutput="no" validator="internal" customvalidator="">
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