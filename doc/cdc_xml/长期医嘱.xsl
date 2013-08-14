<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="UTF-8" />
<xsl:template match="/">
<html xmlns="http://www.w3.org/1999/xhtml" charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
    <title>长期医嘱</title>
    <link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/longorder.css" />
    <link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/common.css" />
</head>
<body>
    <div id="longorder">
        <table cellpadding="3" cellspacing="0" class="lotable">
            <tr>
                <td class="lotitle">
                    <xsl:value-of select="EMR11.00.01/ZLG11.00.01.001/EMR11.00.01.001" />
                </td>
            </tr>
        </table>
        <xsl:for-each select="EMR11.00.01/ZLG11.00.01.006"> 
        <xsl:sort select="EMR11.00.01.041" />
		<xsl:sort select="ZLE11.00.01.006" />
        <!--当前医嘱序号-->
        <xsl:variable name="currOrderNum">
            <xsl:value-of select="ZLE11.00.01.006" />
        </xsl:variable>
        <!--当前医嘱机构名称和开单科室名称-->
        <xsl:variable name="currOrgDeptName">
        <xsl:for-each select="../ZLG11.00.01.004[ZLE11.00.01.002 = $currOrderNum]">
            <xsl:for-each select="ZLG11.00.01.008[EMR11.00.01.027 = '05']">
                <xsl:if test="position() = 1">
                    <xsl:value-of select="concat(EMR11.00.01.021,'|',EMR11.00.01.025)" />
                </xsl:if>
            </xsl:for-each>
        </xsl:for-each>
        </xsl:variable>
		<!--当前医嘱机构代码和开单科室代码-->
        <xsl:variable name="currOrgDeptCode">
        <xsl:for-each select="../ZLG11.00.01.004[ZLE11.00.01.002 = $currOrderNum]">
            <xsl:for-each select="ZLG11.00.01.008[EMR11.00.01.027 = '05']">
                <xsl:if test="position() = 1">
                    <xsl:value-of select="concat(EMR11.00.01.022,'|',ZLE11.00.01.003)" />
                </xsl:if>
            </xsl:for-each>
        </xsl:for-each>
        </xsl:variable>
        <!--开嘱医师-->
        <xsl:variable name="startDoctor">
            <xsl:for-each select="../ZLG11.00.01.005[ZLE11.00.01.004 = $currOrderNum]">
                <xsl:if test="position() = 1">
                    <xsl:for-each select="ZLG11.00.01.009[EMR11.00.01.033 = '61']">
                        <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR11.00.01.031" />
                        </xsl:if>
                    </xsl:for-each>
                </xsl:if>
            </xsl:for-each>
        </xsl:variable>
        <!--开医嘱校对护士-->
        <xsl:variable name="startNurse">
            <xsl:for-each select="../ZLG11.00.01.005[ZLE11.00.01.004 = $currOrderNum]">
            <xsl:if test="position() = 1">
                <xsl:for-each select="ZLG11.00.01.009[EMR11.00.01.033 = '64']">
                    <xsl:if test="position() = 1">
                    <xsl:value-of select="EMR11.00.01.031" />
                    </xsl:if>
                </xsl:for-each>
            </xsl:if>
            </xsl:for-each>
        </xsl:variable>
        <!--停嘱医师-->
        <xsl:variable name="stopDoctor">
            <xsl:for-each select="../ZLG11.00.01.005[ZLE11.00.01.004 = $currOrderNum]">
            <xsl:if test="position() = 1">
                <xsl:for-each select="ZLG11.00.01.009[EMR11.00.01.033 = '62']">
                    <xsl:if test="position() = 1">
                    <xsl:value-of select="EMR11.00.01.031" />
                    </xsl:if>
                </xsl:for-each>
            </xsl:if>
            </xsl:for-each>
        </xsl:variable>
        <!--停嘱护士-->
        <xsl:variable name="stopNurse">
            <xsl:for-each select="../ZLG11.00.01.005[ZLE11.00.01.004 = $currOrderNum]">
            <xsl:if test="position() = 1">
                <xsl:for-each select="ZLG11.00.01.009[EMR11.00.01.033 = '66']">
                    <xsl:if test="position() = 1">
                    <xsl:value-of select="EMR11.00.01.031" />
                    </xsl:if>
                </xsl:for-each>
            </xsl:if>
            </xsl:for-each>
        </xsl:variable>
        <xsl:if test="position() = 1">        
        <table cellpadding="1" cellspacing="0" class="lotable">
            <tr>
                <td colspan="3">
                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
                </td>
            </tr>
            <tr>
                <td class="alignleft" colspan="2">
                    <span class="fontbold">住院机构：</span>
                    <xsl:value-of select="substring-before($currOrgDeptName,'|')" />
                </td>
                <td class="alignleft">
                    <span class="fontbold">住院日期：</span>
                    <xsl:for-each select="../ZLG11.00.01.002/ZLG11.00.01.007[EMR11.00.01.011='住院病案']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="concat(substring(string(EMR11.00.01.013),1,4),'年',
                                                        substring(string(EMR11.00.01.013),6,2),'月',
                                                        substring(string(EMR11.00.01.013),9,2),'日')
                                                  "/>
                        </xsl:if>
                    </xsl:for-each>
                </td>
                <td class="alignleft">
                    <span class="fontbold">住院科别：</span>
                    <xsl:value-of select="substring-after($currOrgDeptName,'|')" />
                </td>
            </tr>
            <tr>
                <td class="alignleft">
                    <span class="fontbold">姓名：</span>
                    <xsl:value-of select="../ZLG11.00.01.002/EMR11.00.01.018" />
                </td>
                <td class="alignleft">
                    <span class="fontbold">性别：</span>
                    <xsl:value-of select="../ZLG11.00.01.003/ZLE11.00.01.014" />
                </td>
                <td class="alignleft">
                    <span class="fontbold">年龄：</span>
                    <xsl:value-of select="../ZLG11.00.01.003/ZLE11.00.01.013" />
                </td>
                <td class="alignleft">
                    <span class="fontbold">住院号：</span>
                    <xsl:for-each select="../ZLG11.00.01.002/ZLG11.00.01.007[EMR11.00.01.011 = '住院病案']">
                        <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR11.00.01.012" />
                        </xsl:if>
                    </xsl:for-each>
                </td>
            </tr>
        </table>
        <table cellpadding="1" cellspacing="0" class="lotable tableborders">
            <tr>
                <td class="aligncenter" style="width:6%">开始<br />日期</td>
                <td class="aligncenter" style="width:6%">开始<br />时间</td>
                <td class="aligncenter" style="width:52%">医嘱</td>
                <td class="aligncenter" style="width:6%">医师<br />签名</td>
                <td class="aligncenter" style="width:6%">护士<br />签名</td>
                <td class="aligncenter" style="width:6%">停止<br />日期</td>
                <td class="aligncenter" style="width:6%">停止<br />时间</td>
                <td class="aligncenter" style="width:6%">医师<br />签名</td>
                <td class="aligncenter" style="width:6%">护士<br />签名</td>
            </tr>
            <!--同一医嘱序号有多条医嘱记录-->
            <xsl:if test="count(ZLG11.00.01.012) &gt; 1">
            <xsl:for-each select="ZLG11.00.01.012"> 
			<xsl:sort select="ZLE11.00.01.015"/>          
            <xsl:if test="position() = 1 ">
            <tr>
                <td class="aligncenter">
                    <xsl:value-of select="substring(string(../EMR11.00.01.041),6,5)" />                    
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="substring(string(../EMR11.00.01.041),12,5)" />
                </td>
                <td class="alignleft">
                    <table cellpadding="1" cellspacing="0" style="width:100%; border:0; font-size:10.5pt; line-height:18px;">
                        <tr style="border:0">
                            <td style="width:65%;border:0" class="alignleft" >
                            <xsl:value-of select="EMR11.00.01.047" />
                            <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							<xsl:if test="ZLE11.00.01.017!=0">
                            	<xsl:value-of select="ZLE11.00.01.017" />
                            	<xsl:value-of select="ZLE11.00.01.016" />
							</xsl:if>
							</td>
                            <td style="width:3%;border:0" class="alignleft" >┓</td>
                            <td style="width:32%;border:0" class="alignleft" >
								<xsl:if test="string-length(../ZLE11.00.01.007)&gt; 0">
									<xsl:value-of select="../ZLE11.00.01.007" />
                            		<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
								</xsl:if>
								<xsl:if test="string-length(../ZLE11.00.01.008)&gt; 0">
                            		<xsl:value-of select="../ZLE11.00.01.008" />
                            		<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
								</xsl:if>
                            	<xsl:value-of select="../ZLE11.00.01.012" /></td>    
                        </tr>
                    </table>
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="$startDoctor" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="$startNurse" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="substring(string(../EMR11.00.01.042),6,5)" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="substring(string(../EMR11.00.01.042),12,5)" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="$stopDoctor" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="$stopNurse" />
                </td>
            </tr>
            </xsl:if>
            <xsl:if test="position() &lt; last() and position() &gt; 1">
            <tr>
                <td class="alignleft">                  
                </td>
                <td class="alignleft">
                </td>
                <td class="alignleft">
                    <table cellpadding="1" cellspacing="0" style="width:100%;border:0; font-size:10.5pt; line-height:18px;">
                        <tr style="border:0;">
                            <td style="width:65%;border:0;" class="alignleft">
                            <xsl:value-of select="EMR11.00.01.047" />
                            <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							<xsl:if test="ZLE11.00.01.017!=0">
                            	<xsl:value-of select="ZLE11.00.01.017" />
                            	<xsl:value-of select="ZLE11.00.01.016" />
							</xsl:if>
                            </td>
                            <td style="width:3%;border:0" class="alignleft" >┃</td>
							<td style="width:32%;border:0" class="alignleft" ></td>
                        </tr>
                    </table>                   
                </td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
            </tr>
            </xsl:if>
            <xsl:if test="position() = last()">
            <tr>
                <td class="alignleft">                  
                </td>
                <td class="alignleft">
                </td>
                <td class="alignleft">
                    <table cellpadding="1" cellspacing="0" style="width:100%; border:0; font-size:10.5pt; line-height:18px;">
                        <tr style="border:0">
                            <td style="width:65%;border:0" class="alignleft">
                            <xsl:value-of select="EMR11.00.01.047" />
                            <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							<xsl:if test="ZLE11.00.01.017!=0">
                            	<xsl:value-of select="ZLE11.00.01.017" />
                            	<xsl:value-of select="ZLE11.00.01.016" />
							</xsl:if>
							</td>
                            <td style="width:3%;border:0" class="alignleft" >┛</td>
							<td style="width:32%;border:0" class="alignleft" ></td>
                        </tr>
                    </table>
                    
                </td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
            </tr>
            </xsl:if>
            </xsl:for-each>
            </xsl:if>
            <!--同一医嘱序号只有一条医嘱记录-->
            <xsl:if test="count(ZLG11.00.01.012) = 1">
            <tr>
                <td class="aligncenter">
                    <xsl:value-of select="substring(string(EMR11.00.01.041),6,5)" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="substring(string(EMR11.00.01.041),12,5)" />
                </td>
                <td class="alignleft">
                    <table cellpadding="1" cellspacing="0" style="width:100%; border:0; font-size:10.5pt; line-height:18px;">
                        <tr style="border:0">
                            <td style="width:65%;border:0" class="alignleft" >
                            <xsl:value-of select="ZLG11.00.01.012/EMR11.00.01.047" />
                            <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							<xsl:if test="ZLG11.00.01.012/ZLE11.00.01.017!=0">
                            	<xsl:value-of select="ZLG11.00.01.012/ZLE11.00.01.017" />
                            	<xsl:value-of select="ZLG11.00.01.012/ZLE11.00.01.016" />
							</xsl:if>
							</td>
							<td style="width:3%;border:0" class="alignleft" ></td>
                            <td style="width:32%;border:0" class="alignleft" >
							<xsl:if test="string-length(ZLE11.00.01.007)&gt; 0">
                            	<xsl:value-of select="ZLE11.00.01.007" />
                            	<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</xsl:if>
							<xsl:if test="string-length(ZLE11.00.01.008)&gt; 0">
                            	<xsl:value-of select="ZLE11.00.01.008" />
                            	<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</xsl:if>
                            <xsl:value-of select="ZLE11.00.01.012" /></td>    
                        </tr>
                    </table>
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="$startDoctor" />                    
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="$startNurse" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="substring(string(EMR11.00.01.042),6,5)" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="substring(string(EMR11.00.01.042),12,5)" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="$stopDoctor" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="$stopNurse" />
                </td>
            </tr>
            </xsl:if>        
        </table>
        </xsl:if>      
        <xsl:variable name="prePos" select="position()" />  
        <xsl:if test="position() &gt; 1 ">
            <!--上一条医嘱序号-->
            <xsl:variable  name="preOrderNum">
            <xsl:for-each select="../ZLG11.00.01.006">
            <xsl:sort select="EMR11.00.01.041" />
			<xsl:sort select="ZLE11.00.01.006" />
                <xsl:if test="position() = $prePos - 1">
                    <xsl:value-of select="ZLE11.00.01.006" />
                </xsl:if>
            </xsl:for-each>
            </xsl:variable>            
            <!--上一条医嘱机构代码和开单科室代码-->
            <xsl:variable name="preOrgDeptCode">
            <xsl:for-each select="../ZLG11.00.01.004[ZLE11.00.01.002 = $preOrderNum] ">
                <xsl:for-each select="ZLG11.00.01.008[EMR11.00.01.027 = '05']">
                    <xsl:if test="position() = 1">
                    <xsl:value-of select="concat(EMR11.00.01.022,'|',ZLE11.00.01.003)" />
                    </xsl:if>
                </xsl:for-each>   
            </xsl:for-each>
            </xsl:variable>
            <!--当前开单科室与上一次开单科室相同-->
            <xsl:if test="$currOrgDeptCode = $preOrgDeptCode">
            <!--成组医嘱-->
            <xsl:if test="count(ZLG11.00.01.012) &gt; 1">
            <table cellpadding="1" cellspacing="0" class="lotable lobtable">
            <xsl:for-each select="ZLG11.00.01.012">
			<xsl:sort select="ZLE11.00.01.015"/>
                <xsl:if test="position() = 1">
                <tr>
                    <td class="aligncenter" style="width:6%">
                        <xsl:value-of select="substring(string(../EMR11.00.01.041),6,5)" />
                    </td>
                    <td class="aligncenter" style="width:6%">
                        <xsl:value-of select="substring(string(../EMR11.00.01.041),12,5)" />
                    </td>
                    <td class="alignleft">
                    <table cellpadding="1" cellspacing="0" style="width:100%; border:0; font-size:10.5pt; line-height:18px;">
                        <tr style="border:0">
                            <td style="width:65%;border:0" class="alignleft" >
                            <xsl:value-of select="EMR11.00.01.047" />
                            <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							<xsl:if test="ZLE11.00.01.017!=0">
                            	<xsl:value-of select="ZLE11.00.01.017" />
                            	<xsl:value-of select="ZLE11.00.01.016" />
							</xsl:if>
							</td>
                            <td style="width:3%;border:0" class="alignleft" >┓</td>
							<td style="width:32%;border:0" class="alignleft" >
							<xsl:if test="string-length(../ZLE11.00.01.007)&gt; 0">
                            	<xsl:value-of select="../ZLE11.00.01.007" />
                            	<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</xsl:if>
							<xsl:if test="string-length(../ZLE11.00.01.008)&gt; 0">
                            	<xsl:value-of select="../ZLE11.00.01.008" />
                            	<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</xsl:if>
                            <xsl:value-of select="../ZLE11.00.01.012" /></td>    
                        </tr>
                    </table>
                </td>
                    <td class="aligncenter" style="width:6%">
                        <xsl:value-of select="$startDoctor" />
                    </td>
                    <td class="aligncenter" style="width:6%">
                        <xsl:value-of select="$startNurse" />
                    </td>
                    <td class="aligncenter" style="width:6%">
                        <xsl:value-of select="substring(string(../EMR11.00.01.042),6,5)" />
                    </td>
                    <td class="aligncenter" style="width:6%">
                        <xsl:value-of select="substring(string(../EMR11.00.01.042),12,5)" />
                    </td>
                    <td class="aligncenter" style="width:6%">
                        <xsl:value-of select="$stopDoctor" />
                    </td>
                    <td class="aligncenter" style="width:6%">
                        <xsl:value-of select="$stopNurse" />
                    </td>
                </tr>
                </xsl:if>
                <xsl:if test="position() &gt; 1 and position() &lt; last()">
                <tr>
                    <td class="alignleft" style="width:6%"></td>
                    <td class="alignleft" style="width:6%"></td>
                    <td class="alignleft">
                        <table cellpadding="1" cellspacing="0" style="width:100%; border:0;font-size:10.5pt; line-height:18px;">
                            <tr style="border:0" >
                                <td style="border:0;width:65%" class="alignleft" >
                                <xsl:value-of select="EMR11.00.01.047" />
                                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
								<xsl:if test="ZLE11.00.01.017!=0">
                                	<xsl:value-of select="ZLE11.00.01.017" />
                                	<xsl:value-of select="ZLE11.00.01.016" />
								</xsl:if>
                                </td>
                                <td style="width:3%;border:0" class="alignleft" >┃</td>
								<td style="width:32%;border:0" class="alignleft" ></td>
                            </tr>
                        </table>
                    </td>
                    <td class="alignleft" style="width:6%">

                    </td>
                    <td class="alignleft" style="width:6%">

                    </td>
                    <td class="alignleft" style="width:6%">

                    </td>
                    <td class="alignleft" style="width:6%">

                    </td>
                    <td class="alignleft" style="width:6%">

                    </td>
                    <td class="alignleft" style="width:6%">

                    </td>
                </tr>    
                </xsl:if>
                <xsl:if test="position() = last()">
                <tr>
                <td class="alignleft">                  
                </td>
                <td class="alignleft">
                </td>
                <td class="alignleft">
                    <table cellpadding="1" cellspacing="0" style="width:100%; border:0;font-size:10.5pt; line-height:18px;">
                    <tr style="border:0">
                        <td style="border:0; width:65%" >
                        <xsl:value-of select="EMR11.00.01.047" />
                        <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
						<xsl:if test="ZLE11.00.01.017!=0">
                        	<xsl:value-of select="ZLE11.00.01.017" />
                        	<xsl:value-of select="ZLE11.00.01.016" />
						</xsl:if>
                        </td>
                        <td style="width:3%;border:0" class="alignleft" >┛</td>
						<td style="width:32%;border:0" class="alignleft" ></td>
                    </tr>
                    </table>                    
                </td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
            </tr>    
                </xsl:if>
            </xsl:for-each>
            </table>
            </xsl:if>
            <xsl:if test="count(ZLG11.00.01.012) = 1" >
            <table cellpadding="1" cellspacing="0" class="lotable lobtable">
                <tr>
                    <td class="aligncenter" style="width:6%">
                        <xsl:value-of select="substring(string(EMR11.00.01.041),6,5)" />
                    </td>
                    <td class="aligncenter" style="width:6%">
                        <xsl:value-of select="substring(string(EMR11.00.01.041),12,5)" />
                    </td>
                    <td class="alignleft">
                    <table cellpadding="1" cellspacing="0" style="width:100%; border:0; font-size:10.5pt; line-height:18px;">
                        <tr style="border:0">
                            <td style="width:65%;border:0" class="alignleft" >
                            <xsl:value-of select="ZLG11.00.01.012/EMR11.00.01.047" />
                            <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							<xsl:if test="ZLG11.00.01.012/ZLE11.00.01.017!=0">
                            	<xsl:value-of select="ZLG11.00.01.012/ZLE11.00.01.017" />
                            	<xsl:value-of select="ZLG11.00.01.012/ZLE11.00.01.016" />
							</xsl:if>
							</td>
                            <td style="width:3%;border:0" class="alignleft" ></td>
							<td style="width:32%;border:0" class="alignleft" >
							<xsl:if test="string-length(ZLE11.00.01.007)&gt; 0">
                            	<xsl:value-of select="ZLE11.00.01.007" />
                            	<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</xsl:if>
							<xsl:if test="string-length(ZLE11.00.01.008)&gt; 0">
                            	<xsl:value-of select="ZLE11.00.01.008" />
                            	<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</xsl:if>
                            <xsl:value-of select="ZLE11.00.01.012" /></td>    
                        </tr>
                    </table>
                </td>
                    <td class="aligncenter" style="width:6%">
                        <xsl:value-of select="$startDoctor" />
                    </td>
                    <td class="aligncenter" style="width:6%">
                        <xsl:value-of select="$startNurse" />
                    </td>
                    <td class="aligncenter" style="width:6%">
                        <xsl:value-of select="substring(string(EMR11.00.01.042),6,5)" />
                    </td>
                    <td class="aligncenter" style="width:6%">
                        <xsl:value-of select="substring(string(EMR11.00.01.042),12,5)" />
                    </td>
                    <td class="aligncenter" style="width:6%">
                        <xsl:value-of select="$stopDoctor" />
                    </td>
                    <td class="aligncenter" style="width:6%">
                        <xsl:value-of select="$stopNurse" />
                    </td>
                </tr>
            </table>
            </xsl:if>
            </xsl:if>    
            <xsl:if test="$currOrgDeptCode != $preOrgDeptCode">
      <table cellpadding="1" cellspacing="0" class="lotable">
            <tr>
                <td colspan="9"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
            </tr>
            <tr>
                <td class="alignleft" colspan="2">
                    <span class="fontbold">住院机构：</span>
                    <xsl:value-of select="substring-before($currOrgDeptName,'|')" />
                </td>
                <td class="alignleft">
                    <span class="fontbold">住院日期：</span>
                    <xsl:for-each select="../ZLG11.00.01.002/ZLG11.00.01.007[EMR11.00.01.011 = '住院病案']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="concat(substring(string(EMR11.00.01.013),1,4),'年',
                                                        substring(string(EMR11.00.01.013),6,2),'月',
                                                        substring(string(EMR11.00.01.013),9,2),'日')
                                                  "/>
                        </xsl:if>
                    </xsl:for-each>
                </td>
                <td class="alignleft">
                    <span class="fontbold">住院科别：</span>
                    <xsl:value-of select="substring-after($currOrgDeptName,'|')" />
                </td>
            </tr>
            <tr>
                <td class="alignleft">
                    <span class="fontbold">姓名：</span>
                    <xsl:value-of select="../ZLG11.00.01.002/EMR11.00.01.018" />
                </td>
                <td class="alignleft">
                    <span class="fontbold">性别：</span>
                    <xsl:value-of select="../ZLG11.00.01.003/ZLE11.00.01.014" />
                </td>
                <td class="alignleft">
                    <span class="fontbold">年龄：</span>
                    <xsl:value-of select="../ZLG11.00.01.003/ZLE11.00.01.013" />
                </td>
                <td class="alignleft">
                    <span class="fontbold">住院号：</span>
                    <xsl:for-each select="../ZLG11.00.01.002/ZLG11.00.01.007[EMR11.00.01.011 = '住院病案']">
                        <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR11.00.01.012" />
                        </xsl:if>
                    </xsl:for-each>
                </td>
            </tr>
        </table>
      <table cellpadding="1" cellspacing="0" class="lotable tableborders">
            <tr>
                <td class="aligncenter" style="width:6%">开始<br />日期</td>
                <td class="aligncenter" style="width:6%">开始<br />时间</td>
                <td class="aligncenter" style="width:52%">医嘱</td>
                <td class="aligncenter" style="width:6%">医师<br />签名</td>
                <td class="aligncenter" style="width:6%">护士<br />签名</td>
                <td class="aligncenter" style="width:6%">停止<br />日期</td>
                <td class="aligncenter" style="width:6%">停止<br />时间</td>
                <td class="aligncenter" style="width:6%">医师<br />签名</td>
                <td class="aligncenter" style="width:6%">护士<br />签名</td>
            </tr>
            <!--同一医嘱序号有多条医嘱记录-->
            <xsl:if test="count(ZLG11.00.01.012) &gt; 1">
            <xsl:for-each select="ZLG11.00.01.012"> 
			<xsl:sort select="ZLE11.00.01.015"/>           
            <xsl:if test="position() = 1 ">
            <tr>
                <td class="aligncenter">
                    <xsl:value-of select="substring(string(../EMR11.00.01.041),6,5)" />                    
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="substring(string(../EMR11.00.01.041),12,5)" />
                </td>
                <td class="alignleft">
                    <table cellpadding="1" cellspacing="0" style="width:100%; border:0; font-size:10.5pt; line-height:18px;">
                        <tr style="border:0">
                            <td style="width:65%;border:0" class="alignleft" >
                            <xsl:value-of select="EMR11.00.01.047" />
                            <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							<xsl:if test="ZLE11.00.01.017!=0">
                            	<xsl:value-of select="ZLE11.00.01.017" />
                            	<xsl:value-of select="ZLE11.00.01.016" />
							</xsl:if>
							</td>
                            <td style="width:3%;border:0" class="alignleft" >┓</td>
							<td style="width:32%;border:0" class="alignleft" >
							<xsl:if test="string-length(../ZLE11.00.01.007)&gt; 0">
                            	<xsl:value-of select="../ZLE11.00.01.007" />
                            	<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</xsl:if>
							<xsl:if test="string-length(../ZLE11.00.01.008)&gt; 0">
                            	<xsl:value-of select="../ZLE11.00.01.008" />
                            	<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</xsl:if>
                            <xsl:value-of select="../ZLE11.00.01.012" /></td>    
                        </tr>
                    </table>
                </td>    
                <td class="aligncenter">
                    <xsl:value-of select="$startDoctor" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="$startNurse" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="substring(string(../EMR11.00.01.042),6,5)" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="substring(string(../EMR11.00.01.042),12,5)" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="$stopDoctor" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="$stopNurse" />
                </td>
            </tr>
            </xsl:if>
            <xsl:if test="position() &lt; last() and position() &gt; 1">
            <tr>
                <td class="alignleft">                  
                </td>
                <td class="alignleft">
                </td>
                <td class="alignleft">
                    <table cellpadding="1" cellspacing="0" style="width:100%; border:0; font-size:10.5pt; line-height:18px">
                        <tr style="border:0">
                            <td style="border:0; width:65%" class="alignleft">
                            <xsl:value-of select="EMR11.00.01.047" />
                            <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							<xsl:if test="ZLE11.00.01.017!=0">
                            	<xsl:value-of select="ZLE11.00.01.017" />
                            	<xsl:value-of select="ZLE11.00.01.016" />
							</xsl:if>
                            </td>
                            <td style="width:3%;border:0" class="alignleft" >┃</td>
							<td style="width:32%;border:0" class="alignleft" ></td>
                        </tr>
                    </table>

                </td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
            </tr>
            </xsl:if>
            <xsl:if test="position() = last()">
            <tr>
                <td class="alignleft">                  
                </td>
                <td class="alignleft">
                </td>
                <td class="alignleft">
                    <table cellpadding="1" cellspacing="0" style="width:100%; border:0; font-size:10.5pt; line-height:18px">
                        <tr style="border:0">
                            <td style="border:0; width:65%" class="alignleft">
                            <xsl:value-of select="EMR11.00.01.047" />
                            <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							<xsl:if test="ZLE11.00.01.017!=0">
                            	<xsl:value-of select="ZLE11.00.01.017" />
                            	<xsl:value-of select="ZLE11.00.01.016" />
							</xsl:if>
                            </td>
                            <td style="width:3%;border:0" class="alignleft" >┛</td>
							<td style="width:32%;border:0" class="alignleft" ></td>
                    </tr>
                    </table>
                </td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
                <td class="alignleft"></td>
            </tr>
            </xsl:if>
            </xsl:for-each>
            </xsl:if>
            <!--同一医嘱序号只有一条医嘱记录-->
            <xsl:if test="count(ZLG11.00.01.012) = 1">
            <tr>
                <td class="aligncenter">
                    <xsl:value-of select="substring(string(EMR11.00.01.041),6,5)" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="substring(string(EMR11.00.01.041),12,5)" />
                </td>
                <td class="alignleft">
                    <table cellpadding="1" cellspacing="0" style="width:100%; border:0; font-size:10.5pt; line-height:18px;">
                        <tr style="border:0">
                            <td style="width:65%;border:0" class="alignleft" >
                            <xsl:value-of select="ZLG11.00.01.012/EMR11.00.01.047" />
                            <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							<xsl:if test="ZLG11.00.01.012/ZLE11.00.01.017!=0">
                            	<xsl:value-of select="ZLG11.00.01.012/ZLE11.00.01.017" />
                            	<xsl:value-of select="ZLG11.00.01.012/ZLE11.00.01.016" />
							</xsl:if>
							</td>
                            <td style="width:3%;border:0" class="alignleft" ></td>
							<td style="width:32%;border:0" class="alignleft" >
							<xsl:if test="string-length(ZLE11.00.01.007)&gt; 0">
                            	<xsl:value-of select="ZLE11.00.01.007" />
                            	<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</xsl:if>
							<xsl:if test="string-length(ZLE11.00.01.008)&gt; 0">
                            	<xsl:value-of select="ZLE11.00.01.008" />
                            	<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</xsl:if>
                            <xsl:value-of select="ZLE11.00.01.012" /></td>    
                        </tr>
                    </table>
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="$startDoctor" />                    
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="$startNurse" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="substring(string(EMR11.00.01.042),6,5)" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="substring(string(EMR11.00.01.042),12,5)" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="$stopDoctor" />
                </td>
                <td class="aligncenter">
                    <xsl:value-of select="$stopNurse" />
                </td>
            </tr>
            </xsl:if>        
        </table>                          
            </xsl:if>      
        </xsl:if>        
        </xsl:for-each>
    </div>
</body>
</html>
</xsl:template>

</xsl:stylesheet><!-- Stylus Studio meta-information - (c) 2004-2009. Progress Software Corporation. 保留所有权力.

<metaInformation>
	<scenarios>
		<scenario default="yes" name="场景1" userelativepaths="yes" externalpreview="no" url="..\..\xml\长期医嘱1.xml" htmlbaseurl="" outputurl="" processortype="saxon8" useresolver="yes" profilemode="0" profiledepth="" profilelength="" urlprofilexml=""
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