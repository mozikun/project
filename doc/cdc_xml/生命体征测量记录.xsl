<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="UTF-8" />
<xsl:template match="/">
<html xmlns="http://www.w3.org/1999/xhtml" charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <head>
        <title>生命体征</title>
        <link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/common.css" />
        <link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/temperaturechart.css" />    
    </head>
    <body>
    <div id="temperaturechart">
    <table cellpadding="3" cellspacing="0" class="tctable">
        <tr>
            <td class="tctitle">
            <xsl:value-of select="EMR06.01.04/ZLG06.01.04.001/EMR06.01.04.001" />
            </td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" class="tctable">
        <tr>
            <td>&#160;</td>
        </tr>
    </table>
    <table cellpadding="3" cellspacing="0" class="tctable">
        <tr>
            <td class="alignleft" style="width:20%">
                <span class="fontbold">姓名：</span>
                <xsl:value-of select="EMR06.01.04/ZLG06.01.04.002/EMR06.01.04.013" />
            </td>
            <td class="alignleft" style="width:15%">
                <span class="fontbold">性别：</span>
                <xsl:value-of select="EMR06.01.04/ZLG06.01.04.003/EMR06.01.04.024" />
            </td>
            <td class="alignleft" style="width:30%">
                <span class="fontbold">年龄：</span>
                <xsl:value-of select="EMR06.01.04/ZLG06.01.04.003/EMR06.01.04.023" />
            </td>
            <td class="alignleft">
                <span class="fontbold">住院号：</span>
                <xsl:for-each select="EMR06.01.04/ZLG06.01.04.002/ZLG06.01.04.009[EMR06.01.04.014 = '住院病案']">
                    <xsl:value-of select="EMR06.01.04.015" />
                </xsl:for-each>
            </td>
        </tr>
    </table>
    <xsl:for-each select="EMR06.01.04/ZLG06.01.04.008">
    <xsl:sort select="ZLE06.01.04.011" />
    <!--当前位置-->
    <xsl:variable name="currPos">
        <xsl:value-of select="position()" />
    </xsl:variable>
    <!--当前发生时间-->
    <xsl:variable name="currBbtRecordTime">
        <xsl:value-of select="string(ZLE06.01.04.011)" />
    </xsl:variable>
    <!--当前事件发生科室-->
    <xsl:variable name="currOrgDept">
        <xsl:for-each select="../ZLG06.01.04.004[string(ZLE06.01.04.001) = $currBbtRecordTime]">
            <xsl:if test="position() = 1">
                <xsl:value-of select="concat(EMR06.01.04.041,'|',EMR06.01.04.045)" />
            </xsl:if>
        </xsl:for-each>
    </xsl:variable>
    <!--当前时间服务者-->
    <xsl:variable name="currServant">
    <xsl:for-each select="../ZLG06.01.04.005[string(ZLE06.01.04.003) = $currBbtRecordTime]">
        <xsl:if test="position() = 1">
        <xsl:value-of select="EMR06.01.04.235" />
        </xsl:if>
    </xsl:for-each>
    </xsl:variable>
    <!--上一条记录时间-->
    <xsl:variable name="preBbtRecordTime">
        <xsl:for-each select="../ZLG06.01.04.008">
            <xsl:sort select="ZLE06.01.04.011" />
            <xsl:if test="position() = $currPos - 1">
                <xsl:value-of select="ZLE06.01.04.011" />
            </xsl:if>
        </xsl:for-each>
    </xsl:variable>
    <xsl:variable name="preOrgDept">
        <xsl:for-each select="../ZLG06.01.04.004[string(ZLE06.01.04.001) = $preBbtRecordTime]">
            <xsl:if test="position() = 1">
            <xsl:value-of select="concat(EMR06.01.04.041,'|',EMR06.01.04.045)" />
            </xsl:if>
        </xsl:for-each>
    </xsl:variable>
    <xsl:if test="$currPos = 1">
    <table cellpadding="0" cellspacing="0" class="tctable">
        <tr>
            <td>&#160;</td>
        </tr>
    </table>
    <table cellpadding="3" cellspacing="0" class="tctable">
        <tr>
            <td class="alignleft" style="width:35%">
                <span class="fontbold">住院机构：</span>
                <xsl:value-of select="substring-before($currOrgDept,'|')" />
            </td>
            <td class="alignleft" style="width:30%">
                <span class="fontbold">住院日期：</span>
                <xsl:for-each select="../ZLG06.01.04.002/ZLG06.01.04.009[EMR06.01.04.014='住院病案']">
                    <xsl:value-of select="concat(substring(string(EMR06.01.04.016),1,4),'年',
                                                substring(string(EMR06.01.04.016),6,2),'月',
                                                substring(string(EMR06.01.04.016),9,2),'日')
                                            " />
                </xsl:for-each>
            </td>
            <td class="alignleft">
                <span class="fontbold">住院科别：</span>
                <xsl:value-of select="substring-after($currOrgDept,'|')" />
            </td>
        </tr>
    </table>
    <table cellpadding="3" cellspacing="0" class="tctable tableborders">
        <!--表头-->
        <tr>
            <td class="aligncenter" style="width:6%">
                日期
            </td>
            <td class="aligncenter" style="width:6%">
                时间
            </td>
            <td class="aligncenter" style="width:10%">
                体温/<span style="color:red">降温</span><br/>
                (℃)
            </td>
            <td class="aligncenter" style="width:10%">
                脉搏/<span style="color:red">心率</span><br/>
                (次/分)
            </td>
            <td class="aligncenter" style="width:8%">
                呼吸<br/>
                次/分
            </td>
            <td class="aligncenter" style="width:8%">
                血压<br/>
                (mmHg)
            </td>
            <td class="aligncenter">
                护理事件
            </td>
            <td class="aligncenter" style="width:8%">
                签名
            </td>
        </tr>
        <tr>
            <td class="aligncenter" style="width:6%">
                <xsl:value-of select="substring($currBbtRecordTime,6,5)" />
            </td>
            <td class="aligncenter" style="width:6%">
                <xsl:value-of select="substring($currBbtRecordTime,12,5)" />
            </td>
            <!--体温/降温-->
            <td class="alignleft" style="width:10%">&#160;
                <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='062']">
                    <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR06.01.04.176" />
                    </xsl:if>
                </xsl:for-each>
                <xsl:if test="count(ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='203']) &gt; 0">
                    /
                    <span class="color:red">
                    <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='203']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="EMR06.01.04.176" />
                        </xsl:if>
                    </xsl:for-each>    
                    </span>
                </xsl:if>
            </td>
            <!--脉搏/心率-->
            <td class="alignleft" style="width:10%">&#160;
                <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='103']">
                    <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR06.01.04.176" />
                    </xsl:if>
                </xsl:for-each>
                <xsl:if test="count(ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='040']) &gt; 0">
                    /
                    <span style="color:red">
                    <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='040']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="EMR06.01.04.176" />
                        </xsl:if>
                    </xsl:for-each>    
                    </span>
                </xsl:if>
            </td>
            <!--呼吸-->
            <td class="alignleft" style="width:8%">&#160;
                <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='113']">
                    <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR06.01.04.176" />
                    </xsl:if>
                </xsl:for-each>
            </td>
            <!--血压-->
            <td class="alignleft" style="width:8%">
                <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='032']">
                    <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR06.01.04.176" />
                    </xsl:if>
                </xsl:for-each>
                <xsl:if test="count(ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='033']) &gt; 0">
                    /
                    <span class="color:red">
                    <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='033']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="EMR06.01.04.176" />
                        </xsl:if>
                    </xsl:for-each>    
                    </span>
                </xsl:if>
            </td>
            <!--护理事件-->
            <td class="alignleft">
            <!--S.02:-->
            <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174 !='062' and EMR06.01.04.174 !='203' and EMR06.01.04.174 !='103'
                                       and EMR06.01.04.174 !='040' and EMR06.01.04.174 !='113' and EMR06.01.04.174 !='032'
                                       and EMR06.01.04.174 !='033']">
                <xsl:if test="position() != last()">
                    <xsl:value-of select="EMR06.01.04.162" />：
                    <xsl:value-of select="EMR06.01.04.164" />
                    <xsl:value-of select="EMR06.01.04.176" />
                    <xsl:value-of select="EMR06.01.04.177" />，
                </xsl:if>
                <xsl:if test="position() = last()">
                    <xsl:value-of select="EMR06.01.04.162" />：
                    <xsl:value-of select="EMR06.01.04.164" />
                    <xsl:value-of select="EMR06.01.04.176" />
                    <xsl:value-of select="EMR06.01.04.177" />
                </xsl:if>
            </xsl:for-each>
            <!--H.10-->
            <xsl:for-each select="../ZLG06.01.04.005[string(EMR06.01.04.153) = $currBbtRecordTime]">
                <xsl:if test="position() = 1">
                    <xsl:if test="count(ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174 !='062' and EMR06.01.04.174 !='203' and EMR06.01.04.174 !='103'
                                       and EMR06.01.04.174 !='040' and EMR06.01.04.174 !='113' and EMR06.01.04.174 !='032'
                                       and EMR06.01.04.174 !='033' and EMR06.01.04.174 != '']) &gt; 0">
                    <br/>
                    </xsl:if>
                    <xsl:value-of select="EMR06.01.04.151" />
                    <xsl:if test="EMR06.01.04.159">：
                        <xsl:value-of select="EMR06.01.04.159" />
                    </xsl:if>
                </xsl:if>
                <xsl:if test="position() &gt; 1">
                    <xsl:value-of select="EMR06.01.04.151" />
                    <xsl:if test="EMR06.01.04.159">：
                        <xsl:value-of select="EMR06.01.04.159" />
                    </xsl:if>
                </xsl:if>
                <xsl:if test="position() != last()">
                    ，
                </xsl:if>
            </xsl:for-each>
            <!--S.14-->
            <xsl:for-each select="ZLG06.01.04.017/ZLG06.01.04.020">
                <xsl:if test="position() = 1">
                    <xsl:for-each select="ZLG06.01.04.021">
                        <xsl:if test="position() = 1">
                            <xsl:if test="count(../ZLG06.01.04.006[string(EMR06.01.04.153) = $currBbtRecordTime]) &gt; 0">
                                <br/>
                            </xsl:if>
                            <xsl:value-of select="EMR06.01.04.204" />：
                            <xsl:value-of select="EMR06.01.04.205" />                  
                        </xsl:if>
                        <xsl:if test="position() != last()">
                            ，
                        </xsl:if>
                        <xsl:if test="position() &gt; 1">
                            <xsl:value-of select="EMR06.01.04.204" />：
                            <xsl:value-of select="EMR06.01.04.205" />
                        </xsl:if>
                    </xsl:for-each>
                </xsl:if>
                <xsl:if test="position() != last()">
                    ，
                </xsl:if>
                <xsl:if test="position() &gt; 1">
                    <xsl:for-each select="ZLG06.01.04.021">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="EMR06.01.04.204" />：
                            <xsl:value-of select="EMR06.01.04.205" />                  
                        </xsl:if>
                        <xsl:if test="position() != last()">
                            ，
                        </xsl:if>
                        <xsl:if test="position() &gt; 1">
                            <xsl:value-of select="EMR06.01.04.204" />：
                            <xsl:value-of select="EMR06.01.04.205" />
                        </xsl:if>
                    </xsl:for-each>
                </xsl:if>
            </xsl:for-each>
            </td>
            <td class="alignleft" style="width:8%">
                <xsl:value-of select="$currServant" />
            </td>
        </tr>
    </table>
    </xsl:if>
    <xsl:if test="$currPos &gt; 1">
    <xsl:if test="$currOrgDept = $preOrgDept">
    <table cellpadding="3" cellspacing="0" class="tctable tableordersnotop">
        <tr>
            <td class="aligncenter" style="width:6%">
                <xsl:value-of select="substring($currBbtRecordTime,6,5)" />
            </td>
            <td class="aligncenter" style="width:6%">
                <xsl:value-of select="substring($currBbtRecordTime,12,5)" />
            </td>
            <!--体温/降温-->
            <td class="alignleft" style="width:10%">&#160;
                <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='062']">
                    <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR06.01.04.176" />
                    </xsl:if>
                </xsl:for-each>
                <xsl:if test="count(ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='203']) &gt; 0">
                    /
                    <span style="color:red">
                    <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='203']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="EMR06.01.04.176" />
                        </xsl:if>
                    </xsl:for-each>    
                    </span>
                </xsl:if>
            </td>
            <!--脉搏/心率-->
            <td class="alignleft" style="width:10%">&#160;
                <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='103']">
                    <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR06.01.04.176" />
                    </xsl:if>
                </xsl:for-each>
                <xsl:if test="count(ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='040']) &gt; 0">
                    /
                    <span class="color:red">
                    <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='040']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="EMR06.01.04.176" />
                        </xsl:if>
                    </xsl:for-each>    
                    </span>
                </xsl:if>
            </td>
            <!--呼吸-->
            <td class="alignleft" style="width:8%">&#160;
                <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='113']">
                    <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR06.01.04.176" />
                    </xsl:if>
                </xsl:for-each>
            </td>
            <!--血压-->
            <td class="alignleft" style="width:8%">
                <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='032']">
                    <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR06.01.04.176" />
                    </xsl:if>
                </xsl:for-each>
                <xsl:if test="count(ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='033']) &gt; 0">
                    /
                    <span class="color:red">
                    <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='033']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="EMR06.01.04.176" />
                        </xsl:if>
                    </xsl:for-each>    
                    </span>
                </xsl:if>
            </td>
            <!--护理事件-->
            <td class="alignleft">
            <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174 !='062' and EMR06.01.04.174 !='203' and EMR06.01.04.174 !='103'
                                       and EMR06.01.04.174 !='040' and EMR06.01.04.174 !='113' and EMR06.01.04.174 !='032'
                                       and EMR06.01.04.174 !='033']">
                <xsl:if test="position() != last()">
                    <xsl:value-of select="EMR06.01.04.162" />：
                    <xsl:value-of select="EMR06.01.04.164" />
                    <xsl:value-of select="EMR06.01.04.176" />
                    <xsl:value-of select="EMR06.01.04.177" />，
                </xsl:if>
                <xsl:if test="position() = last()">
                    <xsl:value-of select="EMR06.01.04.162" />：
                    <xsl:value-of select="EMR06.01.04.164" />
                    <xsl:value-of select="EMR06.01.04.176" />
                    <xsl:value-of select="EMR06.01.04.177" />
                </xsl:if>
            </xsl:for-each>
            <xsl:for-each select="../ZLG06.01.04.006[string(EMR06.01.04.153) = $currBbtRecordTime]">
                <xsl:if test="position() = 1">
                    <xsl:if test="count(ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174 !='062' and EMR06.01.04.174 !='203' and EMR06.01.04.174 !='103'
                                       and EMR06.01.04.174 !='040' and EMR06.01.04.174 !='113' and EMR06.01.04.174 !='032'
                                       and EMR06.01.04.174 !='033' and EMR06.01.04.174 != '']) &gt; 0">
                        <br/>
                    </xsl:if>
                    <xsl:value-of select="EMR06.01.04.151" />
                    <xsl:if test="EMR06.01.04.159">：
                        <xsl:value-of select="EMR06.01.04.159" />
                    </xsl:if>
                </xsl:if>
                <xsl:if test="position() &gt; 1">
                    <xsl:value-of select="EMR06.01.04.151" />
                    <xsl:if test="EMR06.01.04.159">：
                        <xsl:value-of select="EMR06.01.04.159" />
                    </xsl:if>
                </xsl:if>
                <xsl:if test="position() != last()">
                    ，
                </xsl:if>
            </xsl:for-each>
            <xsl:for-each select="ZLG06.01.04.017/ZLG06.01.04.020">
                <xsl:if test="position() = 1">
                    <xsl:for-each select="ZLG06.01.04.021">
                        <xsl:if test="position() = 1">
                            <xsl:if test="count(../ZLG06.01.04.006[string(EMR06.01.04.153) = $currBbtRecordTime]) &gt; 0">
                                <br/>
                            </xsl:if>
                            <xsl:value-of select="EMR06.01.04.204" />：
                            <xsl:value-of select="EMR06.01.04.205" />                  
                        </xsl:if>
                        <xsl:if test="position() != last()">
                            ，
                        </xsl:if>
                        <xsl:if test="position() &gt; 1">
                            <xsl:value-of select="EMR06.01.04.204" />：
                            <xsl:value-of select="EMR06.01.04.205" />
                        </xsl:if>
                    </xsl:for-each>
                </xsl:if>
                <xsl:if test="position() != last()">
                    ，
                </xsl:if>
                <xsl:if test="position() &gt; 1">
                    <xsl:for-each select="ZLG06.01.04.021">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="EMR06.01.04.204" />：
                            <xsl:value-of select="EMR06.01.04.205" />                  
                        </xsl:if>
                        <xsl:if test="position() != last()">
                            ，
                        </xsl:if>
                        <xsl:if test="position() &gt; 1">
                            <xsl:value-of select="EMR06.01.04.204" />：
                            <xsl:value-of select="EMR06.01.04.205" />
                        </xsl:if>
                    </xsl:for-each>
                </xsl:if>
            </xsl:for-each>
            </td>
            <td class="alignleft" style="width:8%">
            <xsl:value-of select="$currServant" />
            </td>
        </tr>
    </table>
    </xsl:if>

    <xsl:if test="$currOrgDept != $preOrgDept">
    <table cellpadding="0" cellspacing="0" class="tctable">
        <tr>
            <td>&#160;</td>
        </tr>
    </table>
    <table cellpadding="3" cellspacing="0" class="tctable">
        <tr>
            <td class="alignleft" style="width:35%">
                <span class="fontbold">住院机构：</span>
                <xsl:value-of select="substring-before($currOrgDept,'|')" />
            </td>
            <td class="alignleft" style="width:30%">
                <span class="fontbold">住院日期：</span>
                <xsl:for-each select="../ZLG06.01.04.002/ZLG06.01.04.009[EMR06.01.04.014='住院病案']">
                    <xsl:value-of select="concat(substring(string(EMR06.01.04.016),1,4),'年',
                                                substring(string(EMR06.01.04.016),6,2),'月',
                                                substring(string(EMR06.01.04.016),9,2),'日')
                                            " />
                </xsl:for-each>
            </td>
            <td class="alignleft">
                <span class="fontbold">住院科别：</span>
                <xsl:value-of select="substring-after($currOrgDept,'|')" />
            </td>
        </tr>
    </table>
    <table cellpadding="3" cellspacing="0" class="tctable tableborders">
        <!--表头-->
        <tr>
            <td class="aligncenter" style="width:6%">
                日期
            </td>
            <td class="aligncenter" style="width:6%">
                时间
            </td>
            <td class="aligncenter" style="width:10%">
                体温/<span style="color:red">降温</span><br/>
                (℃)
            </td>
            <td class="aligncenter" style="width:10%">
                脉搏/<span style="color:red">心率</span><br/>
                (次/分)
            </td>
            <td class="aligncenter" style="width:8%">
                呼吸<br/>
                次/分
            </td>
            <td class="aligncenter" style="width:8%">
                血压<br/>
                (mmHg)
            </td>
            <td class="aligncenter">
                护理事件
            </td>
            <td class="aligncenter" style="width:8%">
                签名
            </td>
        </tr>
        <tr>
            <td class="aligncenter" style="width:6%">
                <xsl:value-of select="substring($currBbtRecordTime,6,5)" />
            </td>
            <td class="aligncenter" style="width:6%">
                <xsl:value-of select="substring($currBbtRecordTime,12,5)" />
            </td>
            <!--体温/降温-->
            <td class="alignleft" style="width:10%">&#160;
                <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='062']">
                    <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR06.01.04.176" />
                    </xsl:if>
                </xsl:for-each>
                <xsl:if test="count(ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='203']) &gt; 0">
                    /
                    <span class="color:red">
                    <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='203']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="EMR06.01.04.176" />
                        </xsl:if>
                    </xsl:for-each>    
                    </span>
                </xsl:if>
            </td>
            <!--脉搏/心率-->
            <td class="alignleft" style="width:10%">&#160;
                <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='103']">
                    <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR06.01.04.176" />
                    </xsl:if>
                </xsl:for-each>
                <xsl:if test="count(ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='040']) &gt; 0">
                    /
                    <span style="color:red">
                    <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='040']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="EMR06.01.04.176" />
                        </xsl:if>
                    </xsl:for-each>    
                    </span>
                </xsl:if>
            </td>
            <!--呼吸-->
            <td class="alignleft" style="width:8%">&#160;
                <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='113']">
                    <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR06.01.04.176" />
                    </xsl:if>
                </xsl:for-each>
            </td>
            <!--血压-->
            <td class="alignleft" style="width:8%">
                <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='032']">
                    <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR06.01.04.176" />
                    </xsl:if>
                </xsl:for-each>
                <xsl:if test="count(ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='033']) &gt; 0">
                    /
                    <span class="color:red">
                    <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174='033']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="EMR06.01.04.176" />
                        </xsl:if>
                    </xsl:for-each>    
                    </span>
                </xsl:if>
            </td>
            <!--护理事件-->
            <td class="alignleft">
            <xsl:for-each select="ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174 !='062' and EMR06.01.04.174 !='203' and EMR06.01.04.174 !='103'
                                       and EMR06.01.04.174 !='040' and EMR06.01.04.174 !='113' and EMR06.01.04.174 !='032'
                                       and EMR06.01.04.174 !='033']">
                <xsl:if test="position() != last()">
                    <xsl:value-of select="EMR06.01.04.162" />：
                    <xsl:value-of select="EMR06.01.04.164" />
                    <xsl:value-of select="EMR06.01.04.176" />
                    <xsl:value-of select="EMR06.01.04.177" />，
                </xsl:if>
                <xsl:if test="position() = last()">
                    <xsl:value-of select="EMR06.01.04.162" />：
                    <xsl:value-of select="EMR06.01.04.164" />
                    <xsl:value-of select="EMR06.01.04.176" />
                    <xsl:value-of select="EMR06.01.04.177" />
                </xsl:if>
            </xsl:for-each>
            <xsl:for-each select="../ZLG06.01.04.006[string(EMR06.01.04.153) = $currBbtRecordTime]">
                <xsl:if test="position() = 1">
                    <xsl:if test="count(ZLG06.01.04.016/ZLG06.01.04.019[EMR06.01.04.174 !='062' and EMR06.01.04.174 !='203' and EMR06.01.04.174 !='103'
                                       and EMR06.01.04.174 !='040' and EMR06.01.04.174 !='113' and EMR06.01.04.174 !='032'
                                       and EMR06.01.04.174 !='033' and EMR06.01.04.174 != '']) &gt; 0">
                        <br/>
                    </xsl:if>
                    <xsl:value-of select="EMR06.01.04.151" />
                    <xsl:if test="EMR06.01.04.159">：
                        <xsl:value-of select="EMR06.01.04.159" />
                    </xsl:if>
                </xsl:if>
                <xsl:if test="position() &gt; 1">
                    <xsl:value-of select="EMR06.01.04.151" />
                    <xsl:if test="EMR06.01.04.159">：
                        <xsl:value-of select="EMR06.01.04.159" />
                    </xsl:if>
                </xsl:if>
                <xsl:if test="position() != last()">
                    ，
                </xsl:if>
            </xsl:for-each>
            <xsl:for-each select="ZLG06.01.04.017/ZLG06.01.04.020">
                <xsl:if test="position() = 1">
                    <xsl:for-each select="ZLG06.01.04.021">
                        <xsl:if test="position() = 1">
                            <xsl:if test="count(../ZLG06.01.04.006[string(EMR06.01.04.153) = $currBbtRecordTime]) &gt; 0">
                                <br/>
                            </xsl:if>
                            <xsl:value-of select="EMR06.01.04.204" />：
                            <xsl:value-of select="EMR06.01.04.205" />                  
                        </xsl:if>
                        <xsl:if test="position() != last()">
                            ，
                        </xsl:if>
                        <xsl:if test="position() &gt; 1">
                            <xsl:value-of select="EMR06.01.04.204" />：
                            <xsl:value-of select="EMR06.01.04.205" />
                        </xsl:if>
                    </xsl:for-each>
                </xsl:if>
                <xsl:if test="position() != last()">
                    ，
                </xsl:if>
                <xsl:if test="position() &gt; 1">
                    <xsl:for-each select="ZLG06.01.04.021">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="EMR06.01.04.204" />：
                            <xsl:value-of select="EMR06.01.04.205" />                  
                        </xsl:if>
                        <xsl:if test="position() != last()">
                            ，
                        </xsl:if>
                        <xsl:if test="position() &gt; 1">
                            <xsl:value-of select="EMR06.01.04.204" />：
                            <xsl:value-of select="EMR06.01.04.205" />
                        </xsl:if>
                    </xsl:for-each>
                </xsl:if>
            </xsl:for-each>
            </td>
            <td class="alignleft" style="width:8%">
            <xsl:value-of select="$currServant" />
            </td>
        </tr>
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
		<scenario default="yes" name="场景1" userelativepaths="yes" externalpreview="no" url="..\最终版\xml\生命体征3.xml" htmlbaseurl="" outputurl="" processortype="saxon8" useresolver="yes" profilemode="0" profiledepth="" profilelength="" urlprofilexml=""
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